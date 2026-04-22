<?php

namespace App\Livewire\Admin;

use App\Models\AppSetting;
use App\Models\KelompokSapi;
use App\Models\Panitia;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Lazy]
#[Title('Laporan & Cetak Kupon Panitia')]
class LaporanPanitia extends Component
{
    public $search = '';

    public $tahun_aktif;

    public function mount()
    {
        $this->tahun_aktif = AppSetting::where('key', 'tahun')->first()?->value ?? date('Y');
    }

    public function placeholder()
    {
        return view('components.skeleton._laporan');
    }

    public function render()
    {
        usleep(200000);
        // Urutan Jabatan sesuai request wak
        $order = [
            'Penanggung Jawab Qurban', 'Ketua Qurban', 'Koordinator',
            'Sekretaris Qurban', 'Bendahara Qurban', 'Ketua Prepare Sapi',
            'Anggota Prepare Sapi', 'Ketua Kelompok Qurban', 'Anggota Kelompok Qurban',
        ];

        // Ambil data panitia
        $query = Panitia::with(['warga', 'kelompokSapi'])
            ->where('tahun', $this->tahun_aktif);

        if ($this->search) {
            $query->whereHas('warga', function ($q) {
                $q->where('nama', 'like', '%'.$this->search.'%');
            });
        }

        $allData = $query->get();

        // Pisahkan Core Panitia dan Kelompok Panitia
        $corePanitia = $allData->whereNotIn('jabatan', ['Ketua Kelompok Qurban', 'Anggota Kelompok Qurban'])
            ->sortBy(function ($item) use ($order) {
                return array_search($item->jabatan, $order);
            });

        // Kelompokkan yang berkaitan dengan Sapi
        $groupPanitia = $allData->whereIn('jabatan', ['Ketua Kelompok Qurban', 'Anggota Kelompok Qurban'])
            ->groupBy('id_kelompok_sapi');

        $kelompoks = KelompokSapi::whereIn('id', $groupPanitia->keys())->get();

        return view('livewire.admin.laporan-panitia', [
            'corePanitia' => $corePanitia,
            'groupPanitia' => $groupPanitia,
            'kelompoks' => $kelompoks,
        ])->title('Laporan Struktur Panitia');
    }
}
