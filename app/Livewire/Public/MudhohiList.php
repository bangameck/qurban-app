<?php

namespace App\Livewire\Public;

use App\Models\AppSetting;
use App\Models\KelompokSapi;
use App\Models\Mudhohi;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Layout('components.layouts.public')]
#[Lazy]
class MudhohiList extends Component
{
    public $tahun_aktif;

    public $search = '';

    public function mount()
    {
        $settings = AppSetting::pluck('value', 'key')->toArray();
        $this->tahun_aktif = $settings['tahun'] ?? date('Y');
    }

    public function placeholder()
    {
        return view('components.skeleton.public._mudhohi-list');
    }

    public function render()
    {
        usleep(200000);
        $searchTerm = $this->search;

        // 1. Ambil Data Kelompok Sapi & Pesertanya
        $kelompoksQuery = KelompokSapi::with(['sapi', 'mudhohis.warga'])
            ->where('tahun', $this->tahun_aktif);

        $kelompoks = $kelompoksQuery->get()->filter(function ($kelompok) use ($searchTerm) {
            // Kalau nggak ada pencarian, tampilkan semua
            if (empty($searchTerm)) {
                return true;
            }

            // Pencarian cerdas: Cari dari Nama Kelompok, Kode Sapi, atau Nama Warga
            $matchKelompok = stripos($kelompok->nama_kelompok, $searchTerm) !== false;
            $matchSapi = $kelompok->sapi && stripos($kelompok->sapi->kode_sapi, $searchTerm) !== false;
            $matchWarga = $kelompok->mudhohis->contains(function ($m) use ($searchTerm) {
                return stripos($m->warga->nama, $searchTerm) !== false;
            });

            return $matchKelompok || $matchSapi || $matchWarga;
        });

        // 2. Ambil Data Mandiri (Kambing / Individu yang tidak masuk kelompok sapi)
        $mandiri = Mudhohi::with('warga')
            ->where('tahun', $this->tahun_aktif)
            ->whereNull('id_kelompok_sapi')
            ->when($searchTerm, function ($query) use ($searchTerm) {
                $query->whereHas('warga', function ($w) use ($searchTerm) {
                    $w->where('nama', 'like', '%'.$searchTerm.'%');
                });
            })
            ->get();

        return view('livewire.public.mudhohi-list', [
            'kelompoks' => $kelompoks,
            'mandiri' => $mandiri,
        ])->title('Daftar Pendaftar Qurban');
    }
}
