<?php

namespace App\Livewire\Admin;

use App\Models\AppSetting as SettingModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app')]
#[Lazy]
class AppSetting extends Component
{
    use WithFileUploads;

    public $app_name;

    public $login_greeting;

    public $masjid_name;

    public $tahun;

    public $harga_patungan;

    public $harga_patungan_tahun;

    public $nama_ketua_panitia;

    public $nama_ketua_masjid;

    public $ttd_panitia;

    public $ttd_masjid;

    public $existing_ttd_panitia;

    public $existing_ttd_masjid;

    public $fonnte_token;

    public $popup_text;

    public $enable_popup = false;

    public $enable_wa = false;

    public $theme_color = 'emerald';

    public $about_us;

    public $privacy_policy;

    // --- VARIABEL GAMBAR BASE64 ---
    public $new_logo_base64;

    public $new_banner_base64; // Tambahan Baru

    public $existing_banner;   // Nampung nama banner lama

    public function mount()
    {
        usleep(200000); // Simulasi loading skeleton (opsional, bisa dihapus)
        $settings = SettingModel::pluck('value', 'key')->toArray();

        $this->app_name = $settings['app_name'] ?? 'Qurban App';
        $this->login_greeting = $settings['login_greeting'] ?? 'Selamat Datang di Sistem Qurban';
        $this->masjid_name = $settings['masjid_name'] ?? 'Masjid Nurul Fitrah';

        $this->tahun = $settings['tahun'] ?? date('Y');
        $this->harga_patungan = $settings['harga_patungan'] ?? 0;
        $this->harga_patungan_tahun = $settings['harga_patungan_tahun'] ?? date('Y');

        $this->nama_ketua_panitia = $settings['nama_ketua_panitia'] ?? '';
        $this->nama_ketua_masjid = $settings['nama_ketua_masjid'] ?? '';
        $this->existing_ttd_panitia = $settings['ttd_panitia'] ?? '';
        $this->existing_ttd_masjid = $settings['ttd_masjid'] ?? '';

        // Load Banner Lama
        $this->existing_banner = $settings['banner_image'] ?? '';

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
            $this->validate([
                'app_name' => 'required|string|max:50',
                'tahun' => 'required|integer|min:2020|max:2099',
                'harga_patungan' => 'required|numeric|min:0',
                'harga_patungan_tahun' => 'required|integer|min:2020|max:2099',
                'nama_ketua_panitia' => 'nullable|string|max:100',
                'nama_ketua_masjid' => 'nullable|string|max:100',
                'ttd_panitia' => 'nullable|image|max:1024',
                'ttd_masjid' => 'nullable|image|max:1024',
            ]);

            // 1. Proses Logo (Tetap seperti semula)
            if ($this->new_logo_base64) {
                $image_parts = explode(';base64,', $this->new_logo_base64);
                if (count($image_parts) == 2) {
                    $image_base64 = base64_decode($image_parts[1]);
                    file_put_contents(storage_path('app/public/logo.png'), $image_base64);
                    file_put_contents(storage_path('app/public/favicon.ico'), $image_base64);
                }
            }

            // 2. Proses Banner Background (Baru)
            $path_banner = $this->existing_banner;
            if ($this->new_banner_base64) {
                $banner_parts = explode(';base64,', $this->new_banner_base64);
                if (count($banner_parts) == 2) {
                    $banner_base64 = base64_decode($banner_parts[1]);
                    // Simpan dengan nama tetap biar gampang dipanggil
                    file_put_contents(storage_path('app/public/banner.webp'), $banner_base64);
                    $path_banner = 'banner.webp';
                }
            }

            // 3. Proses Upload Tanda Tangan
            $path_ttd_panitia = $this->existing_ttd_panitia;
            if ($this->ttd_panitia) {
                $path_ttd_panitia = $this->ttd_panitia->store('ttd_pejabat', 'public');
            }

            $path_ttd_masjid = $this->existing_ttd_masjid;
            if ($this->ttd_masjid) {
                $path_ttd_masjid = $this->ttd_masjid->store('ttd_pejabat', 'public');
            }

            // Simpan ke DB
            $data = [
                'app_name' => $this->app_name,
                'login_greeting' => $this->login_greeting,
                'masjid_name' => $this->masjid_name,
                'tahun' => $this->tahun,
                'harga_patungan' => $this->harga_patungan,
                'harga_patungan_tahun' => $this->harga_patungan_tahun,
                'nama_ketua_panitia' => $this->nama_ketua_panitia,
                'nama_ketua_masjid' => $this->nama_ketua_masjid,
                'ttd_panitia' => $path_ttd_panitia,
                'ttd_masjid' => $path_ttd_masjid,
                'banner_image' => $path_banner, // Tambahan Baru
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

            $this->dispatch('notify-success', 'Mantap! Pengaturan berhasil disimpan.');

            // Reset input base64 biar gak ngeberatin memori
            $this->new_logo_base64 = null;
            $this->new_banner_base64 = null;
            $this->existing_banner = $path_banner;

        } catch (ValidationException $e) {
            foreach ($e->validator->errors()->all() as $error) {
                $this->dispatch('notify-error', $error);
            }
        } catch (\Exception $e) {
            $this->dispatch('notify-error', 'Terjadi kesalahan sistem: '.$e->getMessage());
        }
    }

    public function placeholder()
    {
        return view('components.skeleton._settings');
    }

    public function render()
    {
        usleep(200000); // Simulasi loading skeleton (opsional)

        return view('livewire.admin.app-setting')->title('Pengaturan Aplikasi');
    }
}
