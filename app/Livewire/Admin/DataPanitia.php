<?php

namespace App\Livewire\Admin;

use App\Models\AppSetting;
use App\Models\KelompokSapi;
use App\Models\Panitia;
use App\Models\Warga;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

#[Layout('components.layouts.app')]
#[Lazy]
class DataPanitia extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 12;

    public $isModalOpen = false;

    public $isDeleteModalOpen = false;

    public $editId = null;

    public $deleteId = null;

    public $isListModalOpen = false;

    public $selectedKelompok = null;

    public $panitiaKelompok = [];

    // Form Properties
    public $id_warga;

    public $jabatan;

    public $id_kelompok_sapi;

    public $tahun_aktif;

    public function mount()
    {
        $settings = AppSetting::pluck('value', 'key')->toArray();
        $this->tahun_aktif = $settings['tahun'] ?? date('Y');
    }

    public function placeholder()
    {
        return view('components.skeleton._panitia');
    }

    public function updatingSearch()
    {
        $this->perPage = 12;
        $this->resetPage();
    }

    public function loadMore()
    {
        $this->perPage += 12;
    }

    public function openModal($id = null)
    {
        $this->resetForm();
        if ($id) {
            $data = Panitia::find($id);
            
            // Proteksi: Jika sudah diambil, tidak boleh edit
            if ($data && $data->status_pengambilan == 'Sudah') {
                $this->dispatch('notify-error', 'Maaf, data yang sudah mengambil jatah tidak dapat diubah!');
                return;
            }

            $this->editId = $id;
            $this->id_warga = $data->id_warga;
            $this->jabatan = $data->jabatan;
            $this->id_kelompok_sapi = $data->id_kelompok_sapi;
        }
        $this->isModalOpen = true;
    }

    public function resetForm()
    {
        $this->reset(['editId', 'id_warga', 'jabatan', 'id_kelompok_sapi']);
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate([
            'id_warga' => 'required|exists:wargas,id',
            'jabatan' => 'required',
            'id_kelompok_sapi' => 'required_if:jabatan,Ketua Kelompok Qurban,Anggota Kelompok Qurban',
        ]);

        $panitia = Panitia::find($this->editId);

        // Generate Kode & QR hanya jika data baru
        $kode = $panitia ? $panitia->kode_unik_kupon : 'PQN-'.strtoupper(Str::random(3));
        $qrPath = $panitia ? $panitia->path_qr_code : 'qrcodes/'.$kode.'.svg';

        if (! $panitia) {
            $qrContent = QrCode::format('svg')->size(500)->margin(2)->eye('circle')->style('round')
                ->color(225, 29, 72) // Tetap Rose/Merah untuk Kupon Panitia
                ->generate($kode);
            Storage::disk('public')->put($qrPath, $qrContent);
        }

        Panitia::updateOrCreate(['id' => $this->editId], [
            'tahun' => $this->tahun_aktif,
            'id_warga' => $this->id_warga,
            'jabatan' => $this->jabatan,
            'id_kelompok_sapi' => in_array($this->jabatan, ['Ketua Kelompok Qurban', 'Anggota Kelompok Qurban']) ? $this->id_kelompok_sapi : null,
            'kode_unik_kupon' => $kode,
            'path_qr_code' => $qrPath,
        ]);

        $this->dispatch('notify-success', 'Data Tim Panitia Berhasil Disimpan!');
        $this->isModalOpen = false;
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function executeDelete()
    {
        $data = Panitia::find($this->deleteId);
        if ($data) {
            // Proteksi: Jika sudah diambil, tidak boleh hapus
            if ($data->status_pengambilan == 'Sudah') {
                $this->dispatch('notify-error', 'Gagal! Data panitia yang sudah mengambil jatah tidak boleh dihapus.');
                $this->isDeleteModalOpen = false;
                return;
            }

            if ($data->path_qr_code) {
                Storage::disk('public')->delete($data->path_qr_code);
            }
            $data->delete();
            $this->dispatch('notify-success', 'Panitia berhasil dihapus!');
        }
        $this->isDeleteModalOpen = false;
    }

    public function openListModal($id_kelompok)
    {
        $this->selectedKelompok = KelompokSapi::find($id_kelompok);
        
        $allPanitia = Panitia::with('warga')
            ->where('id_kelompok_sapi', $id_kelompok)
            ->where('tahun', $this->tahun_aktif)
            ->get();

        // Pisahkan Ketua dan Anggota
        $this->panitiaKelompok = [
            'ketua' => $allPanitia->where('jabatan', 'Ketua Kelompok Qurban'),
            'anggota' => $allPanitia->where('jabatan', 'Anggota Kelompok Qurban')
        ];

        $this->isListModalOpen = true;
    }

    public function render()
    {
        usleep(200000);
        // 1. Load Data Panitia
        $panitias = Panitia::with(['warga.rt.rw', 'kelompokSapi'])
            ->where('tahun', $this->tahun_aktif)
            ->whereHas('warga', function ($q) {
                $q->where('nama', 'like', '%'.$this->search.'%')
                    ->orWhere('nik', 'like', '%'.$this->search.'%')
                    ->orWhere('phone_number', 'like', '%'.$this->search.'%');
            })
            ->orWhere('kode_unik_kupon', 'like', '%'.$this->search.'%')
            ->latest()
            ->paginate($this->perPage);

        // 2. Filter Warga: Jangan munculkan yang sudah jadi panitia di tahun ini
        // Tapi kalau lagi EDIT, id_warga yang sedang diedit harus tetap muncul biar tidak kosong
        $idWargaTerdaftar = Panitia::where('tahun', $this->tahun_aktif)
            ->when($this->editId, function ($q) {
                $q->where('id', '!=', $this->editId);
            })
            ->pluck('id_warga');

        $wargas = Warga::whereNotIn('id', $idWargaTerdaftar)
            ->orderBy('nama', 'asc')
            ->get();

        // 3. Load Kelompok Sapi & Cari Nama Ketua
        $kelompoks = KelompokSapi::with('ketuaPanitia.warga')->where('tahun', $this->tahun_aktif)->get();

        $namaKetua = 'Belum ada ketua terdaftar';
        if ($this->id_kelompok_sapi) {
            $klp = $kelompoks->where('id', $this->id_kelompok_sapi)->first();
            if ($klp && $klp->ketuaPanitia) {
                $namaKetua = $klp->ketuaPanitia->warga->nama;
            }
        }

        return view('livewire.admin.data-panitia', [
            'panitias' => $panitias,
            'wargas' => $wargas,
            'kelompoks' => $kelompoks,
            'namaKetua' => $namaKetua,
        ])->title('Manajemen Panitia');
    }
}
