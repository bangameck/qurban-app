<?php

namespace App\Livewire\Admin;

use App\Jobs\SendWhatsappStatusSapiJob;
use App\Models\AppSetting;
use App\Models\Sapi;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Lazy]
#[Title('Data Sapi')]
class DataSapi extends Component
{
    use WithFileUploads, WithPagination;

    public $search = '';

    public $isModalOpen = false;

    public $isDeleteModalOpen = false;

    public $editId = null;

    public $deleteId = null;

    // Form Properties
    public $kode_sapi;

    public $jenis_sapi;

    public $berat;

    public $jenis_kelamin = 'Jantan';

    public $nama_peternakan;

    public $status_proses = 'Menunggu';

    public $new_image_base64;

    public $existing_image;

    // Multi Tahun
    public $tahun_aktif;

    public function mount()
    {
        $settings = AppSetting::pluck('value', 'key')->toArray();
        $this->tahun_aktif = $settings['tahun'] ?? date('Y');
    }

    public function placeholder()
    {
        return view('components.skeleton._sapi');
    }

    public function messages()
    {
        return [
            'kode_sapi.required' => 'Kode sapi wajib diisi!',
            'kode_sapi.unique' => 'Kode sapi sudah ada, gunakan kode lain!',
            'jenis_sapi.required' => 'Jenis sapi (cth: Limousin) wajib diisi!',
            'berat.required' => 'Estimasi berat wajib diisi!',
        ];
    }

    public function generateKode()
    {
        // Kode pakai Tahun Aktif biar rapi tiap tahun
        $prefix = 'SP-'.$this->tahun_aktif;
        $lastSapi = Sapi::where('kode_sapi', 'like', $prefix.'%')
            ->where('tahun', $this->tahun_aktif) // Pastikan cek di tahun ini aja
            ->orderBy('kode_sapi', 'desc')
            ->first();

        if (! $lastSapi) {
            return $prefix.'-001';
        }

        $lastNumber = (int) substr($lastSapi->kode_sapi, -3);

        return $prefix.'-'.str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    }

    public function openModal($id = null)
    {
        $this->resetForm();
        if ($id) {
            $this->editId = $id;
            $sapi = Sapi::find($id);
            $this->kode_sapi = $sapi->kode_sapi;
            $this->jenis_sapi = $sapi->jenis_sapi;
            $this->berat = $sapi->berat;
            $this->jenis_kelamin = $sapi->jenis_kelamin;
            $this->nama_peternakan = $sapi->nama_peternakan;
            $this->status_proses = $sapi->status_proses;
            $this->existing_image = $sapi->path_foto_sapi;
        } else {
            $this->kode_sapi = $this->generateKode();
        }
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->editId = null;
        $this->kode_sapi = '';
        $this->jenis_sapi = '';
        $this->berat = '';
        $this->jenis_kelamin = 'Jantan';
        $this->nama_peternakan = '';
        $this->status_proses = 'Menunggu';
        $this->new_image_base64 = null;
        $this->existing_image = null;
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate([
            'kode_sapi' => 'required|string|unique:sapis,kode_sapi,'.$this->editId,
            'jenis_sapi' => 'required|string',
            'berat' => 'required|numeric',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'status_proses' => 'required|in:Menunggu,Disembelih,Dikuliti,Selesai',
        ]);

        $imagePath = $this->existing_image;

        if ($this->new_image_base64) {
            $image_parts = explode(';base64,', $this->new_image_base64);
            if (count($image_parts) == 2) {
                $image_base64 = base64_decode($image_parts[1]);
                $fileName = 'sapi/'.Str::random(20).'.jpg'; // Extensi kita samakan dengan .jpg dari AlpineJS

                // 1. Simpan menggunakan jalur resmi Laravel (Disk Public)
                Storage::disk('public')->put($fileName, $image_base64);

                // 2. Hapus gambar lama (jika ada) menggunakan jalur resmi juga
                if ($this->existing_image && Storage::disk('public')->exists($this->existing_image)) {
                    Storage::disk('public')->delete($this->existing_image);
                }

                $imagePath = $fileName;
            }
        }

        // Logika Deteksi Perubahan Status
        $isStatusChanged = false;
        $waktuSembelih = null;

        if ($this->editId) {
            $oldData = Sapi::find($this->editId);
            $waktuSembelih = $oldData->waktu_sembelih;

            // Cek apakah panitia merubah statusnya (dan bukan berubah ke 'Menunggu')
            if ($oldData && $oldData->status_proses !== $this->status_proses && $this->status_proses !== 'Menunggu') {
                $isStatusChanged = true;
            }
        }

        if ($this->status_proses !== 'Menunggu' && ! $waktuSembelih) {
            $waktuSembelih = now();
        }

        $sapi = Sapi::updateOrCreate(
            ['id' => $this->editId],
            [
                'kode_sapi' => $this->kode_sapi,
                'jenis_sapi' => $this->jenis_sapi,
                'berat' => $this->berat,
                'jenis_kelamin' => $this->jenis_kelamin,
                'nama_peternakan' => $this->nama_peternakan,
                'status_proses' => $this->status_proses,
                'path_foto_sapi' => $imagePath,
                'waktu_sembelih' => $waktuSembelih,
                'tahun' => $this->tahun_aktif, // Simpan ke tahun aktif
            ]
        );

        // --- DISPATCH JOB JIKA STATUS BERUBAH ---
        if ($isStatusChanged) {
            SendWhatsappStatusSapiJob::dispatch($sapi);
        }

        $this->dispatch('notify-success', 'Data Sapi Berhasil Disimpan!');
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function executeDelete()
    {
        $sapi = Sapi::find($this->deleteId);
        if ($sapi) {
            if ($sapi->path_foto_sapi && File::exists(public_path('storage/'.$sapi->path_foto_sapi))) {
                File::delete(public_path('storage/'.$sapi->path_foto_sapi));
            }
            $sapi->delete();
            $this->dispatch('notify-success', 'Data Sapi berhasil dihapus!');
        }
        $this->isDeleteModalOpen = false;
        $this->deleteId = null;
    }

    public function render()
    {
        usleep(200000);
        // Filter tabel pakai Tahun Aktif
        $sapis = Sapi::withCount('kelompok')
            ->where('tahun', $this->tahun_aktif)
            ->where(function ($q) {
                $q->where('kode_sapi', 'like', '%'.$this->search.'%')
                    ->orWhere('jenis_sapi', 'like', '%'.$this->search.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.admin.data-sapi', ['sapis' => $sapis])->title('Data Sapi');
    }
}
