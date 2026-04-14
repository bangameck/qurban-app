<?php

namespace App\Livewire\Public;

use App\Models\AppSetting;
use App\Models\Mudhohi;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.public')] // Menggunakan layout utama yang sudah support CSS Variable Theme Color
class DetailMudhohi extends Component
{
    public $mudhohi;

    public $appName;

    public $themeColor;

    public function mount($id)
    {
        // Cari data mudhohi beserta relasi lengkapnya
        $this->mudhohi = Mudhohi::with([
            'warga',
            'kelompokSapi.sapi',
        ])->findOrFail($id);

        // Ambil pengaturan aplikasi untuk nama & warna tema fallback (jika diperlukan)
        $settings = AppSetting::pluck('value', 'key')->toArray();
        $this->appName = $settings['app_name'] ?? 'Panitia Qurban';
        $this->themeColor = $settings['theme_color'] ?? 'emerald';
    }

    public function render()
    {
        return view('livewire.public.detail-mudhohi')->title('Tanda Terima Qurban - '.$this->mudhohi->warga->nama);
    }
}
