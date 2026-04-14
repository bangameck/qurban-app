<?php

namespace App\Jobs;

use App\Models\AppSetting;
use App\Models\KelompokSapi;
use App\Models\Sapi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendWhatsappStatusSapiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Sapi $sapi) {}

    public function handle(): void
    {
        $settings = cache('global_settings') ?? AppSetting::pluck('value', 'key')->toArray();
        $token = $settings['fonnte_token'] ?? '';
        $enable_wa = $settings['enable_wa'] ?? '0';

        if ($enable_wa != '1' || empty($token)) {
            return;
        }

        $appName = $settings['app_name'] ?? 'Panitia Qurban';

        // Susun kalimat berdasarkan status
        $statusText = match ($this->sapi->status_proses) {
            'Disembelih' => 'sedang dalam tahap *Penyembelihan*',
            'Dikuliti' => 'sedang dalam tahap *Pengulitan dan Pencacahan Daging*',
            'Selesai' => 'telah *Selesai Diproses* dan siap untuk didistribusikan',
            default => 'berada pada tahap *'.$this->sapi->status_proses.'*'
        };

        // Cari semua kelompok yang kebagian sapi ini, lalu ambil mudhohi (warga)-nya
        $kelompoks = KelompokSapi::with('mudhohis.warga')->where('id_sapi', $this->sapi->id)->get();

        foreach ($kelompoks as $kelompok) {
            foreach ($kelompok->mudhohis as $mudhohi) {
                if (! empty($mudhohi->warga->phone_number)) {

                    $nama = $mudhohi->warga->nama;

                    // Rangkai Pesan Formal & Sopan
                    $pesan = "*Assalamu’alaikum Warahmatullahi Wabarakatuh*\n\n";
                    $pesan .= "Yth. Bapak/Ibu *$nama*,\n\n";
                    $pesan .= "Kami dari $appName ingin menginformasikan *Update Status* hewan qurban Bapak/Ibu.\n\n";
                    $pesan .= 'Alhamdulillah, saat ini hewan qurban kelompok Bapak/Ibu (*Sapi '.$this->sapi->kode_sapi."*) $statusText.\n\n";

                    if ($this->sapi->status_proses == 'Selesai') {
                        $pesan .= "Silakan persiapkan diri untuk pengambilan/penerimaan daging qurban sesuai jadwal sesi yang telah ditentukan panitia.\n\n";
                    } else {
                        $pesan .= "Panitia sedang bekerja maksimal untuk memastikan proses berjalan lancar dan sesuai syariat. Kami akan terus memberikan informasi terbaik untuk Anda.\n\n";
                    }

                    $pesan .= "Mohon doa agar seluruh rangkaian ibadah qurban ini diridhai oleh Allah Subhanahu Wa Ta'ala.\n\n";
                    $pesan .= '_Jazakumullah Khairan Katsiran_';

                    // Eksekusi API Fonnte per Warga
                    try {
                        Http::withHeaders([
                            'Authorization' => $token,
                        ])->post('https://api.fonnte.com/send', [
                            'target' => $mudhohi->warga->phone_number,
                            'message' => $pesan,
                            'delay' => '2', // Delay 2 detik antar pesan biar gak kena block WhatsApp
                        ]);
                    } catch (\Exception $e) {
                        // Lanjut ke nomor berikutnya kalau error
                        continue;
                    }
                }
            }
        }
    }
}
