<?php

namespace App\Livewire\Admin;

use App\Models\AppSetting;
use App\Models\KelompokSapi;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Lazy]
class LaporanMudhohi extends Component
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
        $kelompoks = KelompokSapi::with(['mudhohis.warga', 'sapi'])
            ->where('tahun', $this->tahun_aktif)
            ->where(function ($query) {
                $query->where('nama_kelompok', 'like', '%'.$this->search.'%')
                    ->orWhereHas('mudhohis.warga', function ($q) {
                        $q->where('nama', 'like', '%'.$this->search.'%');
                    });
            })
            ->orderBy('nama_kelompok', 'asc')
            ->paginate(10);

        return view('livewire.admin.laporan-mudhohi', [
            'kelompoks' => $kelompoks,
        ])->title('Laporan Mudhohi');
    }
}
