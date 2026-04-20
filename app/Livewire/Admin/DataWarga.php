<?php

namespace App\Livewire\Admin;

use App\Imports\WargaImport;
use App\Models\Rt;
use App\Models\Warga;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

#[Layout('components.layouts.app')]
#[Lazy]
class DataWarga extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search = '';

    public $isModalOpen = false;

    public $isImportModalOpen = false;

    public $isDeleteModalOpen = false; // Modal hapus

    public $editId = null;

    public $deleteId = null;

    // Form Properties
    public $no_kk;

    public $nik;

    public $nama;

    public $phone_number;

    public $alamat;

    public $id_rt;

    public $jabatan_sosial = 'Warga';

    public $new_image_base64;

    public $existing_image;

    // Property untuk file import Excel/CSV
    public $importFile;

    public function placeholder()
    {
        return view('components.skeleton._data-warga');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Custom Pesan Validasi Bahasa Indonesia
    public function messages()
    {
        return [
            'no_kk.numeric' => 'No. KK harus berupa angka!',
            'no_kk.max_digits' => 'No. KK maksimal 16 digit wak!',
            'nik.unique' => 'NIK ini sudah terdaftar di sistem!',
            'nik.numeric' => 'NIK harus berupa angka!',
            'nik.max_digits' => 'NIK maksimal 16 digit wak!',
            'nama.required' => 'Nama lengkap wajib diisi!',
            'alamat.required' => 'Alamat rumah tidak boleh kosong!',
            'phone_number.starts_with' => 'Nomor WA harus diawali dengan angka 0 wak!',
            'phone_number.regex' => 'Nomor WA hanya boleh berisi angka!',
            'phone_number.unique' => 'Nomor WA ini sudah terdaftar di sistem!',
            'jabatan_sosial.required' => 'Jabatan wajib dipilih!',
        ];
    }

    public function openModal($id = null)
    {
        $this->resetForm();
        if ($id) {
            $this->editId = $id;
            $warga = Warga::find($id);
            $this->no_kk = $warga->no_kk ?? ''; // Field opsional baru
            $this->nik = $warga->nik;
            $this->nama = $warga->nama;
            $this->phone_number = $warga->phone_number;
            $this->alamat = $warga->alamat;
            $this->id_rt = $warga->id_rt;
            $this->jabatan_sosial = $warga->jabatan_sosial;
            $this->existing_image = $warga->path_img;
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
        $this->no_kk = '';
        $this->nik = '';
        $this->nama = '';
        $this->phone_number = '';
        $this->alamat = '';
        $this->id_rt = null;
        $this->jabatan_sosial = 'Warga';
        $this->new_image_base64 = null;
        $this->existing_image = null;
        $this->importFile = null;
        $this->resetValidation();
    }

    public function save()
    {
        if (trim((string) $this->nik) === '') {
            $this->nik = null;
        }

        $this->validate([
            'no_kk' => 'nullable|numeric|max_digits:16',
            'nik' => 'nullable|numeric|max_digits:16|unique:wargas,nik,'.$this->editId,
            'nama' => 'required|string|max:255',
            // Validasi string (biar angka 0 di depan ga hilang), diawali 0, dan murni angka
            'phone_number' => 'nullable|string|starts_with:0|regex:/^[0-9]+$/|max:20|unique:wargas,phone_number,'.$this->editId,
            'alamat' => 'required|string',
            'jabatan_sosial' => 'required|in:Warga,RT,RW,Tokoh,Panitia,Admin,Super_Admin',
        ]);

        $imagePath = $this->existing_image;

        // Proses Gambar Base64 1:1 Circle
        if ($this->new_image_base64) {
            $image_parts = explode(';base64,', $this->new_image_base64);
            if (count($image_parts) == 2) {
                $image_base64 = base64_decode($image_parts[1]);
                $fileName = 'warga/'.Str::random(20).'.png';

                if (! File::isDirectory(public_path('storage/warga'))) {
                    File::makeDirectory(public_path('storage/warga'), 0755, true, true);
                }

                file_put_contents(public_path('storage/'.$fileName), $image_base64);

                if ($this->existing_image && File::exists(public_path('storage/'.$this->existing_image))) {
                    File::delete(public_path('storage/'.$this->existing_image));
                }
                $imagePath = $fileName;
            }
        }

        Warga::updateOrCreate(
            ['id' => $this->editId],
            [
                'no_kk' => $this->no_kk,
                'nik' => $this->nik,
                'nama' => $this->nama,
                'phone_number' => $this->phone_number,
                'alamat' => $this->alamat,
                'id_rt' => $this->id_rt,
                'jabatan_sosial' => $this->jabatan_sosial,
                'path_img' => $imagePath,
            ]
        );

        $this->dispatch('notify-success', $this->editId ? 'Data warga berhasil diupdate!' : 'Warga baru berhasil ditambahkan!');
        $this->closeModal();
    }

    // Modal Konfirmasi Hapus
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function executeDelete()
    {
        $warga = Warga::find($this->deleteId);
        if ($warga) {
            if ($warga->path_img && File::exists(public_path('storage/'.$warga->path_img))) {
                File::delete(public_path('storage/'.$warga->path_img));
            }
            $warga->delete();
            $this->dispatch('notify-success', 'Data warga berhasil dihapus selamanya!');
        }
        $this->isDeleteModalOpen = false;
        $this->deleteId = null;
    }

    // Fungsi dummy untuk Import
    public $importRtId = '';

    public function importData()
    {
        $this->validate([
            'importRtId' => 'required',
            'importFile' => 'required|mimes:csv,xlsx,xls|max:5120',
        ], [
            'importRtId.required' => 'Pilih RT tujuan dulu wak!',
            'importFile.required' => 'Pilih filenya dulu!',
        ]);

        try {
            // Kirim $this->importRtId ke Class WargaImport
            Excel::import(new WargaImport($this->importRtId), $this->importFile);

            $this->dispatch('notify-success', 'Mantap! Data warga RT tersebut berhasil di-import.');
            $this->isImportModalOpen = false;
            $this->reset(['importFile', 'importRtId']);

        } catch (ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                $this->dispatch('notify-error', 'Baris '.$failure->row().': '.$failure->errors()[0]);
            }
        } catch (\Exception $e) {
            // Sekarang kita buka error aslinya biar ga bingung
            $this->dispatch('notify-error', 'Waduh Error: '.$e->getMessage());
        }
    }

    public function mount()
    {
        usleep(200000);
    }

    public function render()
    {
        $listRt = Rt::all();

        $wargas = Warga::where('nama', 'like', '%'.$this->search.'%')
            ->orWhere('nik', 'like', '%'.$this->search.'%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.admin.data-warga', [
            'wargas' => $wargas,
            'listRt' => $listRt,
        ])->title('Data Warga');
    }
}
