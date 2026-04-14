<?php

namespace App\Livewire\Admin;

use App\Models\AppSetting;
use App\Models\KelompokSapi;
use App\Models\Sapi;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Lazy]
class DataKelompokSapi extends Component
{
    use WithPagination;

    public $search = '';

    public $isModalOpen = false;
    public $isDeleteModalOpen = false;
    public $isDetailModalOpen = false; // Modal Detail Anggota

    public $editId = null;
    public $deleteId = null;
    public $detailKelompok = null; // Menyimpan data kelompok yang diklik

    // Form Properties
    public $nama_kelompok;
    public $id_sapi;

    // Multi Tahun
    public $tahun_aktif;

    public function mount()
    {
        $settings = AppSetting::pluck('value', 'key')->toArray();
        $this->tahun_aktif = $settings['tahun'] ?? date('Y');
    }

    public function placeholder()
    {
        return view('components.skeleton._kelompok');
    }

    public function messages()
    {
        return [
            'nama_kelompok.required' => 'Nama kelompok wajib diisi!',
            'id_sapi.required' => 'Wajib memilih Sapi!',
            'id_sapi.unique' => 'Sapi ini sudah terdaftar di kelompok lain!',
        ];
    }

    public function openModal($id = null)
    {
        $this->resetForm();
        if ($id) {
            $this->editId = $id;
            $kelompok = KelompokSapi::find($id);
            $this->nama_kelompok = $kelompok->nama_kelompok;
            $this->id_sapi = $kelompok->id_sapi;
        } else {
            // Auto Generate Nama Kelompok (Filter sesuai tahun aktif)
            $totalKelompok = KelompokSapi::where('tahun', $this->tahun_aktif)->count() + 1;
            $this->nama_kelompok = 'Kelompok '.$totalKelompok;
        }
        $this->isModalOpen = true;
    }

    // Fungsi Baru untuk Buka Modal Detail Peserta
    public function openDetailModal($id)
    {
        $this->detailKelompok = KelompokSapi::with(['sapi', 'mudhohis.warga'])->find($id);
        $this->isDetailModalOpen = true;
    }

    public function closeDetailModal()
    {
        $this->isDetailModalOpen = false;
        $this->detailKelompok = null;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->editId = null;
        $this->nama_kelompok = '';
        $this->id_sapi = '';
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate([
            'nama_kelompok' => 'required|string|max:255',
            'id_sapi' => 'required|exists:sapis,id|unique:kelompok_sapis,id_sapi,'.$this->editId,
        ]);

        KelompokSapi::updateOrCreate(
            ['id' => $this->editId],
            [
                'nama_kelompok' => $this->nama_kelompok,
                'id_sapi' => $this->id_sapi,
                'tahun' => $this->tahun_aktif, // Tambahkan Simpan Tahun Aktif
            ]
        );

        $this->dispatch('notify-success', $this->editId ? 'Data Kelompok diperbarui!' : 'Kelompok baru berhasil dibuat!');
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function executeDelete()
    {
        $kelompok = KelompokSapi::find($this->deleteId);
        if ($kelompok) {
            $kelompok->delete();
            $this->dispatch('notify-success', 'Kelompok berhasil dibubarkan!');
        }
        $this->isDeleteModalOpen = false;
        $this->deleteId = null;
    }

    public function render()
    {
        // 1. Ambil data Kelompok + Relasi Sapi (Filter Tahun Aktif)
        $kelompoks = KelompokSapi::with('sapi')
            ->withCount('mudhohis')
            ->where('tahun', $this->tahun_aktif) // FILTER TAHUN
            ->where(function ($q) {
                $q->where('nama_kelompok', 'like', '%'.$this->search.'%')
                  ->orWhereHas('sapi', function ($sq) {
                      $sq->where('kode_sapi', 'like', '%'.$this->search.'%');
                  });
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        // 2. SMART DROPDOWN SAPI: Ambil sapi di tahun aktif yang belum punya kelompok
        $sapiTersedia = Sapi::where('tahun', $this->tahun_aktif) // FILTER TAHUN
            ->whereDoesntHave('kelompok')
            ->when($this->editId, function ($query) {
                $query->orWhere('id', $this->id_sapi);
            })
            ->orderBy('kode_sapi', 'asc')
            ->get();

        return view('livewire.admin.data-kelompok-sapi', [
            'kelompoks' => $kelompoks,
            'sapiTersedia' => $sapiTersedia,
        ])->title('Kelompok Sapi | Qurban App');
    }
}