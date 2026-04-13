<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.auth')] // Gunakan layout auth yang baru kita buat
class Login extends Component
{
    #[Validate('required|email', message: 'Format email tidak valid wak!')]
    public $email = '';

    #[Validate('required', message: 'Password wajib diisi wak!')]
    public $password = '';

    public function authenticate()
    {
        $this->validate();

        // Coba login
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            request()->session()->regenerate();

            // Arahkan ke dashboard admin
            return redirect()->intended(route('admin.dashboard'));
        }

        // Kalau gagal
        $this->addError('email', 'Email atau password salah, coba cek lagi!');
    }

    public function render()
    {
        return view('livewire.auth.login')->title('Login Masuk | Qurban App');
    }
}
