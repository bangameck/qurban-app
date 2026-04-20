<?php

namespace App\Livewire\Auth;

use App\Models\Warga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Layout('components.layouts.auth')]
#[Lazy]
class Login extends Component
{
    public function placeholder()
    {
        return view('components.skeleton._login');
    }

    public $phone_number = '';

    public $password = '';

    protected function rules()
    {
        return [
            'phone_number' => 'required|numeric|starts_with:0',
            'password' => 'required',
        ];
    }

    protected function messages()
    {
        return [
            'phone_number.required' => 'Nomor WhatsApp wajib diisi wak!',
            'phone_number.numeric' => 'Nomor WA harus berupa angka!',
            'phone_number.starts_with' => 'Nomor WA harus diawali dengan angka 0!',
            'password.required' => 'Password wajib diisi wak!',
        ];
    }

    public function authenticate()
    {
        $this->validate();

        // 1. Cari Warga berdasarkan Nomor WA
        $warga = Warga::with('user')->where('phone_number', $this->phone_number)->first();

        // 2. Jika Warga tidak ketemu atau tidak punya akun User
        if (! $warga || ! $warga->user) {
            $this->addError('phone_number', 'Nomor WA ini belum terdaftar sebagai panitia/pejabat!');

            return;
        }

        // 3. Jika Akun User dinonaktifkan (Misal: Mantan RT)
        if (! $warga->user->status) {
            $this->addError('phone_number', 'Akun Anda dinonaktifkan karena pergantian jabatan. Hubungi Admin!');

            return;
        }

        // 4. Cek Kecocokan Password
        if (Hash::check($this->password, $warga->user->password)) {
            // Login sukses!
            Auth::login($warga->user);
            request()->session()->regenerate();

            // Kirim pesan sukses untuk Dynamic Island di halaman tujuan
            session()->flash('notify-success', 'Selamat datang kembali, '.$warga->nama.'!');

            // 5. Redirect Berdasarkan Role Spatie
            $user = Auth::user();
            if ($user->hasRole('superadmin') || $user->hasRole('admin')) {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->hasRole('panitia')) {
                // Pastikan route ini ada nanti wak
                return redirect()->intended(route('panitia.dashboard'));
            } elseif ($user->hasRole('rt') || $user->hasRole('rw')) {
                return redirect()->intended(route('pejabat.dashboard'));
            }

            return redirect()->intended('/dashboard');
        }

        // Jika password salah
        $this->addError('password', 'Password salah wak! Coba ingat-ingat lagi.');
    }

    public function render()
    {
        usleep(200000);
        return view('livewire.auth.login')->title('Login Masuk');
    }
}
