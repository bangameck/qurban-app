<?php

namespace App\Livewire\Public;

use App\Models\AppSetting;
use App\Models\Mudhohi;
use App\Models\Mustahiq;
use App\Models\Sapi;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.public')] // Pastikan sampeyan punya layout guest, atau pakai 'components.layouts.app' jika desain headernya nyambung
class Home extends Component
{
    public $tahun_aktif;

    public $app_name;

    public $theme_color;

    public $stats = [];

    public function mount()
    {
        $settings = AppSetting::pluck('value', 'key')->toArray();
        $this->tahun_aktif = $settings['tahun'] ?? date('Y');
        $this->app_name = $settings['app_name'] ?? 'Sistem Qurban';
        $this->theme_color = $settings['theme_color'] ?? 'emerald';

        // Tarik data Transparansi Publik
        $this->stats['total_sapi'] = Sapi::where('tahun', $this->tahun_aktif)->count();
        $this->stats['sapi_disembelih'] = Sapi::where('tahun', $this->tahun_aktif)->where('status_proses', 'Selesai')->count();
        $this->stats['total_mudhohi'] = Mudhohi::where('tahun', $this->tahun_aktif)->count();
        $this->stats['daging_tersalurkan'] = Mustahiq::where('tahun', $this->tahun_aktif)->where('status_pengambilan', 'Sudah')->count();
    }

    public function render()
    {
        return view('livewire.public.home')->title('Beranda | '.$this->app_name);
    }
}
