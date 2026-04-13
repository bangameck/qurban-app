<?php

namespace App\Livewire\Admin;

use App\Models\Rw;
use App\Models\Warga;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Lazy]
class DataRw extends Component
{
    use WithPagination;

    public $search = '';

    public $isModalOpen = false;

    public $isDeleteModalOpen = false;

    public $editId = null;

    public $deleteId = null;

    // Form Properties
    public $nama_rw;

    public $id_pejabat;

    public $kelurahan;

    public $kecamatan;

    public function placeholder()
    {
        return view('components.skeleton._rt_rw'); // Bisa disesuaikan jika ada skeleton khusus
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function messages()
    {
        return [
            'nama_rw.required' => 'Nama/Nomor RW wajib diisi!',
            'kelurahan.required' => 'Kelurahan wajib diisi!',
            'kecamatan.required' => 'Kecamatan wajib diisi!',
            'id_pejabat.exists' => 'Warga yang dipilih tidak valid!',
        ];
    }

    public function openModal($id = null)
    {
        $this->resetForm();
        if ($id) {
            $this->editId = $id;
            $rw = Rw::find($id);
            $this->nama_rw = $rw->nama_rw;
            $this->id_pejabat = $rw->id_pejabat;
            $this->kelurahan = $rw->kelurahan;
            $this->kecamatan = $rw->kecamatan;
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
        $this->nama_rw = '';
        $this->id_pejabat = null;
        $this->kelurahan = '';
        $this->kecamatan = '';
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate([
            'nama_rw' => 'required|string|max:255',
            'id_pejabat' => 'nullable|exists:wargas,id',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
        ]);

        $newPejabatId = empty($this->id_pejabat) ? null : $this->id_pejabat;

        if ($this->editId) {
            $oldRt = Rw::find($this->editId);
            if ($oldRt && $oldRt->id_pejabat !== $newPejabatId) {
                if ($oldRt->id_pejabat) {
                    $mantan = Warga::find($oldRt->id_pejabat);
                    $mantan->update(['jabatan_sosial' => 'Warga']);
                    $mantan->syncUserAccount(); // << Nonaktifkan akun lama
                }
            }
        }

        $rw = Rw::updateOrCreate(['id' => $this->editId], [
            'nama_rw' => $this->nama_rw,
            'id_pejabat' => $newPejabatId,
            'kelurahan' => $this->kelurahan,
            'kecamatan' => $this->kecamatan,
        ]);

        // Aktifkan akun Pejabat baru
        if ($newPejabatId) {
            $pejabatBaru = Warga::find($newPejabatId);
            $pejabatBaru->syncUserAccount();
        }

        $this->dispatch('notify-success', 'Data RW & Akun Pejabat berhasil disinkronkan!');
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function executeDelete()
    {
        $rw = Rw::find($this->deleteId);
        if ($rw) {
            $rw->delete();
            $this->dispatch('notify-success', 'Data RW berhasil dihapus!');
        }
        $this->isDeleteModalOpen = false;
        $this->deleteId = null;
    }

    public function mount()
    {
        // Opsional: Untuk default jika mayoritas RW ada di kelurahan/kecamatan yang sama
        // $this->kelurahan = 'Nama Kelurahan Default';
        // $this->kecamatan = 'Nama Kecamatan Default';
    }

    public function render()
    {
        $rws = Rw::with('pejabat')
            ->where('nama_rw', 'like', '%'.$this->search.'%')
            ->orWhereHas('pejabat', function ($q) {
                $q->where('nama', 'like', '%'.$this->search.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        // 1. Cari ID Warga yang sudah jadi Ketua di RW lain
        $pejabatTerpakai = Rw::whereNotNull('id_pejabat')
            ->when($this->editId, function ($query) {
                // Pengecualian: Kalau lagi mode Edit RW, Ketua RW saat ini tetap dimunculkan di dropdown
                $query->where('id', '!=', $this->editId);
            })
            ->pluck('id_pejabat')
            ->toArray();

        // 2. Filter Dropdown Kandidat: Status harus "RW" DAN belum dipakai di RW lain
        $kandidatPejabat = Warga::where('jabatan_sosial', 'RW')
            ->whereNotIn('id', $pejabatTerpakai)
            ->orderBy('nama', 'asc')
            ->get();

        return view('livewire.admin.data-rw', [
            'rws' => $rws,
            'kandidatPejabat' => $kandidatPejabat,
        ])->title('Data RW | Qurban App');
    }
}
