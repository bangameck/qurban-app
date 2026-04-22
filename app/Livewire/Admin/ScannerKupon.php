<?php

namespace App\Livewire\Admin;

use App\Models\Mudhohi;
use App\Models\Mustahiq;
use App\Models\Panitia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Lazy]
#[Title('Scanner Kupon Cerdas')]
class ScannerKupon extends Component
{
    public function placeholder()
    {
        return view('components.skeleton._scanner');
    }

    public $scannedCode = '';

    public $result = null; // Menyimpan data yang ditemukan

    public $resultType = ''; // 'Panitia', 'Mudhohi', 'Mustahiq'

    public $status = ''; // success, error, warning

    public $message = '';

    public function submitManual()
    {
        $this->processCode($this->scannedCode);
    }

    public function processCode($code)
    {
        $code = trim(strtoupper($code));
        $this->scannedCode = $code;
        $this->result = null;
        $this->resultType = '';

        // Menggunakan helper Str::startsWith untuk menyortir berdasarkan Prefix Kode
        if (Str::startsWith($code, ['PQN', 'PQR'])) {

            // LOGIKA PANITIA
            $this->result = Panitia::with(['warga', 'kelompokSapi'])->where('kode_unik_kupon', $code)->first();
            $this->resultType = 'Panitia';

        } elseif (Str::startsWith($code, 'MDH')) {

            // LOGIKA MUDHOHI
            $this->result = Mudhohi::with(['warga', 'kelompokSapi'])->where('kode_unik_kupon', $code)->first();
            $this->resultType = 'Mudhohi';

        } elseif (Str::startsWith($code, 'QBN')) {

            // LOGIKA MUSTAHIQ
            $this->result = Mustahiq::with(['warga', 'sesiDistribusi'])->where('kode_unik_kupon', $code)->first();
            $this->resultType = 'Mustahiq';

        }

        // Eksekusi jika data ditemukan di salah satu tabel sesuai Prefix-nya
        if ($this->result) {
            return $this->handleResult();
        }

        // JIKA TIDAK DITEMUKAN / PREFIX NGACO
        $this->status = 'error';
        $this->message = 'KODE TIDAK DIKENALI! Pastikan QR Code benar / terdaftar.';
        $this->dispatch('play-audio', ['type' => 'error']);
    }

    private function handleResult()
    {
        // Cek apakah sudah pernah diambil
        if ($this->result->status_pengambilan === 'Sudah') {
            $this->status = 'warning';
            $this->message = 'KUPON SUDAH DIGUNAKAN!';
            $this->dispatch('play-audio', ['type' => 'warning']);

            return;
        }

        // Proses Berhasil Ambil
        // Kita gunakan save() agar fleksibel jika ada field yang berbeda di tiap tabel
        $this->result->status_pengambilan = 'Sudah';
        $this->result->waktu_diambil = now();

        // Cek jika tabel punya field id_panitia_scanner, update juga
        if (Schema::hasColumn($this->result->getTable(), 'id_panitia_scanner')) {
            $this->result->id_panitia_scanner = Auth::id();
        }

        $this->result->save();

        $this->status = 'success';
        $this->message = 'BERHASIL! Silakan berikan daging jatah '.$this->resultType.'.';
        $this->dispatch('play-audio', ['type' => 'success']);
    }

    public function resetScanner()
    {
        $this->reset(['scannedCode', 'result', 'resultType', 'status', 'message']);
    }

    public function render()
    {
        usleep(200000);

        return view('livewire.admin.scanner-kupon')
            ->title('Scanner Kupon Cerdas');
    }
}
