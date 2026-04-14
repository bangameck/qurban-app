<?php

namespace App\Jobs;

use App\Models\Mustahiq;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendWhatsappKuponJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Mustahiq $mustahiq) {}

    public function handle(): void
    {
        $token = cache('global_settings')['fonnte_token'] ?? '';
        if (empty($token) || empty($this->mustahiq->warga->phone_number)) {
            return;
        }

        // Generate URL Kupon (Pastikan route 'kupon.detail' sudah ada nanti)
        $urlKupon = route('kupon.detail', $this->mustahiq->kode_unik_kupon);

        $pesan = 'Assalamualaikum Wr. Wb. Bapak/Ibu *'.$this->mustahiq->warga->nama."*\n\n";
        $pesan .= "Berikut adalah Kupon Digital Qurban Anda:\n";
        $pesan .= '📌 *Kode Kupon:* '.$this->mustahiq->kode_unik_kupon."\n";
        $pesan .= '📅 *Sesi:* '.$this->mustahiq->sesiDistribusi->nama_sesi."\n";
        $pesan .= '⏰ *Jam:* '.Carbon::parse($this->mustahiq->sesiDistribusi->jam_mulai)->format('H:i').' - '.Carbon::parse($this->mustahiq->sesiDistribusi->jam_selesai)->format('H:i')." WIB\n\n";
        $pesan .= "Untuk melihat Detail Kupon dan QR Code Anda, silakan klik link di bawah ini:\n";
        $pesan .= $urlKupon."\n\n";
        $pesan .= 'Tunjukkan Kupon Digital tersebut kepada panitia saat pengambilan daging. Terima kasih.';

        // Kirim via Fonnte tanpa parameter 'url' (attachment)
        Http::withHeaders(['Authorization' => $token])->post('https://api.fonnte.com/send', [
            'target' => $this->mustahiq->warga->phone_number,
            'message' => $pesan,
            'delay' => '2',
        ]);
    }
}
