<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class ProfileSetting extends Component
{
    public bool $isOpen = false;

    // Form fields
    public string $name = '';
    public string $email = '';
    public string $phone_number = '';
    public string $new_image_base64 = '';
    public string $existing_image = '';

    // Password fields
    public string $current_password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

    public function mount()
    {
        $this->loadProfile();
    }

    public function loadProfile()
    {
        $user = Auth::user();
        $this->name = $user->name ?? '';
        $this->email = $user->email ?? '';
        $this->phone_number = $user->warga?->phone_number ?? '';
        $this->existing_image = $user->warga?->path_img ?? '';
        $this->new_image_base64 = '';
        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';
        $this->resetValidation();
    }

    public function open()
    {
        $this->loadProfile();
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
        $this->loadProfile();
    }

    protected function messages(): array
    {
        return [
            'name.required'                      => 'Nama wajib diisi.',
            'name.min'                           => 'Nama minimal 2 karakter.',
            'email.required'                     => 'Email wajib diisi.',
            'email.email'                        => 'Format email tidak valid.',
            'email.unique'                       => 'Email sudah digunakan oleh akun lain.',
            'phone_number.min'                   => 'Nomor telepon minimal 9 digit.',
            'phone_number.max'                   => 'Nomor telepon maksimal 15 digit.',
            'current_password.required_with'     => 'Password lama wajib diisi untuk mengganti password.',
            'new_password.min'                   => 'Password baru minimal 6 karakter.',
            'new_password.confirmed'             => 'Konfirmasi password baru tidak cocok.',
            'new_password.different'             => 'Password baru harus berbeda dari password lama.',
        ];
    }

    public function saveProfile()
    {
        $user = Auth::user();

        $this->validate([
            'name'         => 'required|string|min:2|max:255',
            'email'        => 'required|email|unique:users,email,'.$user->id,
            'phone_number' => 'nullable|string|min:9|max:15',
        ]);

        // Handle gambar
        if ($this->new_image_base64) {
            $parts = explode(';base64,', $this->new_image_base64);
            if (count($parts) === 2) {
                $imageData = base64_decode($parts[1]);
                $fileName = 'profile-photos/'.Str::uuid().'.png';

                // Hapus foto lama
                if ($this->existing_image && File::exists(public_path('storage/'.$this->existing_image))) {
                    File::delete(public_path('storage/'.$this->existing_image));
                }

                File::ensureDirectoryExists(public_path('storage/profile-photos'));
                file_put_contents(public_path('storage/'.$fileName), $imageData);

                // Update warga jika ada
                if ($user->warga) {
                    $user->warga->update(['path_img' => $fileName]);
                }

                $this->existing_image = $fileName;
                $this->new_image_base64 = '';
            }
        }

        // Update nama & email di tabel users
        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();

        // Update phone_number & nama di warga jika ada
        if ($user->warga) {
            $user->warga->update([
                'nama'         => $this->name,
                'phone_number' => $this->phone_number,
            ]);
        }

        $this->dispatch('notify-success', 'Profil berhasil diperbarui!');
        $this->isOpen = false;
    }

    public function savePassword()
    {
        $user = Auth::user();

        $this->validate([
            'current_password'          => 'required',
            'new_password'              => 'required|min:6|confirmed|different:current_password',
        ]);

        if (! Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'Password lama yang Anda masukkan salah.');
            return;
        }

        $user->password = Hash::make($this->new_password);
        $user->save();

        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';

        $this->dispatch('notify-success', 'Password berhasil diubah!');
    }

    public function render()
    {
        return view('livewire.admin.profile-setting');
    }
}
