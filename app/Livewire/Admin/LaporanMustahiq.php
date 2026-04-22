<?php

namespace App\Livewire\Admin;

use App\Models\AppSetting;
use App\Models\SesiDistribusi;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Lazy]
#[Title('Laporan & Cetak Kupon Mustahiq')]
class LaporanMustahiq extends Component
{
    use WithPagination;

    public $search = '';

    public $tahun_aktif;

    public function mount()
    {
        $settings = AppSetting::pluck('value', 'key')->toArray();
        $this->tahun_aktif = $settings['tahun'] ?? date('Y');
    }

    public function placeholder()
    {
        return view('components.skeleton._laporan');
    }

    public function render()
    {
        usleep(200000);
        // Cari Sesi, atau cari Warga di dalam Sesi tersebut
        $sesis = SesiDistribusi::with(['mustahiqs.warga'])
            ->where('tahun', $this->tahun_aktif)
            ->where(function ($query) {
                $query->where('nama_sesi', 'like', '%'.$this->search.'%')
                    ->orWhereHas('mustahiqs.warga', function ($q) {
                        $q->where('nama', 'like', '%'.$this->search.'%');
                    });
            })
            ->orderBy('jam_mulai', 'asc')
            ->paginate(10);

        return view('livewire.admin.laporan-mustahiq', [
            'sesis' => $sesis,
        ])->title('Laporan & Cetak Kupon');
    }
}
