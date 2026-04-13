<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Lazy]
class AdminDashboard extends Component
{
    public function mount()
    {
        usleep(200000);
    }

    public function placeholder()
    {
        // Panggil view skeleton khusus untuk halaman ini
        return view('components.skeleton._app-setting');
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
            ->title('Dashboard Utama | Qurban App');
    }
}
