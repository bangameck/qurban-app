<?php

namespace App\Livewire\Admin;

use App\Models\AppSetting as SettingModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithFileUploads; // PENTING: Tambahkan ini wak!

#[Layout('components.layouts.app')]
#[Lazy]
class AppSetting extends Component
{
    use WithFileUploads; // PENTING: Aktifkan trait di sini!

    public $app_name;

    public $login_greeting;

    public $masjid_name;

    // Variabel Multi-Tahun
    public $tahun;

    public $harga_patungan;

    public $harga_patungan_tahun;

    // --- VARIABEL BARU TANDA TANGAN & PEJABAT ---
    public $nama_ketua_panitia;

    public $nama_ketua_masjid;

    public $ttd_panitia; // Untuk file upload baru

    public $ttd_masjid; // Untuk file upload baru

    public $existing_ttd_panitia; // Nampung foto lama

    public $existing_ttd_masjid; // Nampung foto lama
    // --------------------------------------------

    public $fonnte_token;

    public $popup_text;

    public $enable_popup = false;

    public $enable_wa = false;

    public $theme_color = 'emerald';

    public $about_us;

    public $privacy_policy;

    public $new_logo_base64;

    public function mount()
    {
        usleep(200000);
        $settings = SettingModel::pluck('value', 'key')->toArray();

        $this->app_name = $settings['app_name'] ?? 'Qurban App';
        $this->login_greeting = $settings['login_greeting'] ?? 'Selamat Datang di Sistem Qurban';
        $this->masjid_name = $settings['masjid_name'] ?? 'Masjid Nurul Fitrah';

        $this->tahun = $settings['tahun'] ?? date('Y');
        $this->harga_patungan = $settings['harga_patungan'] ?? 0;
        $this->harga_patungan_tahun = $settings['harga_patungan_tahun'] ?? date('Y');

        // --- AMBIL DATA PEJABAT ---
        $this->nama_ketua_panitia = $settings['nama_ketua_panitia'] ?? '';
        $this->nama_ketua_masjid = $settings['nama_ketua_masjid'] ?? '';
        $this->existing_ttd_panitia = $settings['ttd_panitia'] ?? '';
        $this->existing_ttd_masjid = $settings['ttd_masjid'] ?? '';
        // --------------------------

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
                'tahun' => 'required|integer|min:2020|max:2099',
                'harga_patungan' => 'required|numeric|min:0',
                'harga_patungan_tahun' => 'required|integer|min:2020|max:2099',
                // Validasi Tanda Tangan
                'nama_ketua_panitia' => 'nullable|string|max:100',
                'nama_ketua_masjid' => 'nullable|string|max:100',
                'ttd_panitia' => 'nullable|image|max:1024', // Maksimal 1MB
                'ttd_masjid' => 'nullable|image|max:1024',
            ]);

            // Proses Gambar Base64 (Logo)
            if ($this->new_logo_base64) {
                $image_parts = explode(';base64,', $this->new_logo_base64);
                if (count($image_parts) == 2) {
                    $image_base64 = base64_decode($image_parts[1]);
                    file_put_contents(public_path('logo.png'), $image_base64);
                    file_put_contents(public_path('favicon.ico'), $image_base64);
                }
            }

            // --- PROSES UPLOAD TANDA TANGAN ---
            $path_ttd_panitia = $this->existing_ttd_panitia;
            if ($this->ttd_panitia) {
                $path_ttd_panitia = $this->ttd_panitia->store('ttd_pejabat', 'public');
            }

            $path_ttd_masjid = $this->existing_ttd_masjid;
            if ($this->ttd_masjid) {
                $path_ttd_masjid = $this->ttd_masjid->store('ttd_pejabat', 'public');
            }
            // ----------------------------------

            // Kumpulkan Data untuk disimpan ke tabel app_settings
            $data = [
                'app_name' => $this->app_name,
                'login_greeting' => $this->login_greeting,
                'masjid_name' => $this->masjid_name,
                'tahun' => $this->tahun,
                'harga_patungan' => $this->harga_patungan,
                'harga_patungan_tahun' => $this->harga_patungan_tahun,

                // --- SIMPAN DATA PEJABAT ---
                'nama_ketua_panitia' => $this->nama_ketua_panitia,
                'nama_ketua_masjid' => $this->nama_ketua_masjid,
                'ttd_panitia' => $path_ttd_panitia,
                'ttd_masjid' => $path_ttd_masjid,
                // ---------------------------

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
            $this->new_logo_base64 = null;

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
        return view('components.skeleton._app-setting');
    }

    public function render()
    {
        return view('livewire.admin.app-setting')->title('Pengaturan Aplikasi');
    }
}
