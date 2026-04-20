<?php

namespace App\Livewire\Public;

use App\Models\AppSetting;
use App\Models\Mudhohi;
use App\Models\Mustahiq;
use App\Models\Panitia;
use App\Models\Sapi;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Layout('components.layouts.public')]
#[Lazy]
class Home extends Component
{
    public function placeholder()
    {
        return view('components.skeleton._home');
    }

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

        // Hitung total kupon secara keseluruhan (Mustahiq + Mudhohi + Panitia)
        $countMustahiq = Mustahiq::where('tahun', $this->tahun_aktif)->count();
        $countMudhohi = Mudhohi::where('tahun', $this->tahun_aktif)->whereNotNull('kode_unik_kupon')->count();
        $countPanitia = Panitia::where('tahun', $this->tahun_aktif)->whereNotNull('kode_unik_kupon')->count();
        $this->stats['kupon_total'] = $countMustahiq + $countMudhohi + $countPanitia;

        // Hitung kupon yang sudah diambil
        $scanMustahiq = Mustahiq::where('tahun', $this->tahun_aktif)->where('status_pengambilan', 'Sudah')->count();
        $scanMudhohi = Mudhohi::where('tahun', $this->tahun_aktif)->where('status_pengambilan', 'Sudah')->count();
        $scanPanitia = Panitia::where('tahun', $this->tahun_aktif)->where('status_pengambilan', 'Sudah')->count();
        $this->stats['kupon_scan'] = $scanMustahiq + $scanMudhohi + $scanPanitia;
    }

    public function render()
    {
        usleep(200000);
        return view('livewire.public.home')->title('Beranda Publik');
    }
}
