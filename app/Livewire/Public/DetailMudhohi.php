<?php

namespace App\Livewire\Public;

use App\Models\AppSetting;
use App\Models\Mudhohi;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Layout('components.layouts.public')]
#[Lazy]
class DetailMudhohi extends Component
{
    public function placeholder()
    {
        return view('components.skeleton.public._details-mudhohi');
    }

    public $mudhohi;

    public $appName;

    public $themeColor;

    public function mount($id)
    {
        // Cari data mudhohi beserta relasi lengkapnya (Warga, Kelompok Sapi, dan Sapi)
        $this->mudhohi = Mudhohi::with([
            'warga',
            'kelompokSapi.sapi',
        ])->findOrFail($id);

        // Ambil pengaturan aplikasi untuk nama & warna tema
        $settings = AppSetting::pluck('value', 'key')->toArray();
        $this->appName = $settings['app_name'] ?? 'Panitia Qurban';
        $this->themeColor = $settings['theme_color'] ?? 'emerald';
    }

    public function render()
    {
        usleep(200000); // Simulasi efek loading skeleton

        return view('livewire.public.detail-mudhohi')
            ->title('Tanda Terima Qurban - '.$this->mudhohi->warga->nama);
    }
}
