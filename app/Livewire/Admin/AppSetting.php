<?php

namespace App\Livewire\Admin;

use App\Models\AppSetting as SettingModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Lazy]
class AppSetting extends Component
{
    public $app_name;

    public $login_greeting;

    public $fonnte_token;

    public $popup_text;

    public $enable_popup = false;

    public $enable_wa = false;

    public $theme_color = 'emerald';

    public $about_us;

    public $privacy_policy;

    // Properti baru untuk menerima hasil kompresi Base64 dari JS
    public $new_logo_base64;

    public function mount()
    {
        usleep(200000);
        $settings = SettingModel::pluck('value', 'key')->toArray();
        $this->app_name = $settings['app_name'] ?? 'Qurban App';
        $this->login_greeting = $settings['login_greeting'] ?? 'Selamat Datang di Sistem Qurban';
        $this->fonnte_token = $settings['fonnte_token'] ?? '';
        $this->popup_text = $settings['popup_text'] ?? '';
        $this->enable_popup = ($settings['enable_popup'] ?? '0') == '1';
        $this->enable_wa = ($settings['enable_wa'] ?? '0') == '1';
        $this->theme_color = $settings['theme_color'] ?? 'emerald';
        $this->about_us = $settings['about_us'] ?? '';
        $this->privacy_policy = $settings['privacy_policy'] ?? '';
    }

    public function save()
    {
        try {
            // Validasi Input
            $this->validate([
                'app_name' => 'required|string|max:50',
            ], [
                'app_name.required' => 'Nama Aplikasi wajib diisi wak!',
            ]);

            // 1. Proses Gambar Base64 (Jika ada)
            if ($this->new_logo_base64) {
                // Pecah string Base64 (contoh: data:image/jpeg;base64,.....)
                $image_parts = explode(';base64,', $this->new_logo_base64);
                if (count($image_parts) == 2) {
                    $image_base64 = base64_decode($image_parts[1]);
                    // Simpan ke public folder
                    file_put_contents(public_path('logo.png'), $image_base64);
                    file_put_contents(public_path('favicon.ico'), $image_base64);
                }
            }

            // 2. Kumpulkan & Simpan Data
            $data = [
                'app_name' => $this->app_name,
                'login_greeting' => $this->login_greeting,
                'fonnte_token' => $this->fonnte_token,
                'popup_text' => $this->popup_text,
                'enable_popup' => $this->enable_popup ? '1' : '0',
                'enable_wa' => $this->enable_wa ? '1' : '0',
                'theme_color' => $this->theme_color,
                'about_us' => $this->about_us,
                'privacy_policy' => $this->privacy_policy,
            ];

            foreach ($data as $key => $value) {
                SettingModel::updateOrCreate(['key' => $key], ['value' => $value]);
            }

            Cache::forget('global_settings');

            // Trigger Notifikasi Dynamic Island (Success)
            $this->dispatch('notify-success', 'Mantap! Pengaturan berhasil disimpan.');

            // Kosongkan form base64 biar ga dikirim ulang kalau save dua kali
            $this->new_logo_base64 = null;

        } catch (ValidationException $e) {
            // Trigger Notifikasi Toastr (Error)
            foreach ($e->validator->errors()->all() as $error) {
                $this->dispatch('notify-error', $error);
            }
        } catch (\Exception $e) {
            $this->dispatch('notify-error', 'Terjadi kesalahan sistem: '.$e->getMessage());
        }
    }

    public function placeholder()
    {
        // Panggil view skeleton khusus untuk halaman ini
        return view('components.skeleton._app-setting');
    }

    public function render()
    {
        return view('livewire.admin.app-setting')->title('Pengaturan Aplikasi');
    }
}
