<?php

namespace App\Jobs;

use App\Models\AppSetting;
use App\Models\Mudhohi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendWhatsappMudhohiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Mudhohi $mudhohi) {}

    public function handle(): void
    {
        // 1. Ambil settingan langsung dari DB biar gak pusing masalah cache
        $settings = AppSetting::pluck('value', 'key')->toArray();
        $token = $settings['fonnte_token'] ?? '';
        $enable_wa = $settings['enable_wa'] ?? '0';

        // 2. Kalau WA dimatikan, token kosong, atau nomor HP kosong -> Batalkan
        if ($enable_wa != '1' || empty($token) || empty($this->mudhohi->warga->phone_number)) {
            return;
        }

        // 3. Pastikan relasi terbaca
        $this->mudhohi->load(['warga', 'kelompokSapi']);

        $nama = $this->mudhohi->warga->nama;
        $kelompok = $this->mudhohi->kelompokSapi->nama_kelompok ?? 'Menunggu Alokasi';
        $tipe = $this->mudhohi->tipe_qurban;
        $appName = $settings['app_name'] ?? 'Panitia Qurban';

        // 4. Generate URL Sertifikat
        $urlSertifikat = route('mudhohi.detail', $this->mudhohi->id);

        // 5. Rangkai Pesan
        $pesan = "*Assalamu’alaikum Warahmatullahi Wabarakatuh*\n\n";
        $pesan .= "Alhamdulillah, Bapak/Ibu *$nama* yang dimuliakan Allah.\n\n";
        $pesan .= "Niat suci Bapak/Ibu untuk menunaikan ibadah qurban ($tipe) pada tahun ini telah kami terima dan catat dengan penuh rasa syukur.\n\n";
        $pesan .= "Sebagai informasi, Bapak/Ibu saat ini tergabung di dalam *$kelompok*.\n\n";
        $pesan .= "Untuk melihat *Tanda Terima Pendaftaran* dan status hewan qurban Bapak/Ibu, silakan klik link eksklusif di bawah ini:\n";
        $pesan .= $urlSertifikat."\n\n";
        $pesan .= "Semoga Allah Subhanahu Wa Ta'ala menerima amal ibadah qurban ini, memberkahi rezeki keluarga, dan menjadikannya kendaraan yang tangguh di Yaumil Akhir kelak. Aamiin Ya Rabbal Alamin. 🤲✨\n\n";
        $pesan .= "_Jazakumullah Khairan Katsiran_\n*$appName*";

        // 6. Eksekusi API Fonnte
        Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/send', [
            'target' => $this->mudhohi->warga->phone_number,
            'message' => $pesan,
            'delay' => '2',
        ]);
    }
}
