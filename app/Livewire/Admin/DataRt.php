<?php

namespace App\Livewire\Admin;

use App\Models\Rt;
use App\Models\Rw;
use App\Models\Warga;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Lazy]
class DataRt extends Component
{
    use WithPagination;

    public $search = '';

    public $isModalOpen = false;

    public $isDeleteModalOpen = false;

    public $editId = null;

    public $deleteId = null;

    // Form Properties
    public $nama_rt;

    public $id_rw;

    public $id_pejabat;

    public function placeholder()
    {
        return view('components.skeleton._rt_rw'); // Pakai skeleton yang sama dengan RW biar hemat
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function messages()
    {
        return [
            'nama_rt.required' => 'Nama/Nomor wilayah RT wajib diisi!',
            'id_rw.required' => 'Wajib memilih RW Induk!',
            'id_rw.exists' => 'RW yang dipilih tidak ditemukan di sistem!',
            'id_pejabat.exists' => 'Kandidat ketua tidak valid!',
        ];
    }

    public function openModal($id = null)
    {
        $this->resetForm();
        if ($id) {
            $this->editId = $id;
            $rt = Rt::find($id);
            $this->nama_rt = $rt->nama_rt;
            $this->id_rw = $rt->id_rw;
            $this->id_pejabat = $rt->id_pejabat;
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
        $this->nama_rt = '';
        $this->id_rw = '';
        $this->id_pejabat = null;
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate([
            'nama_rt' => 'required|string|max:255',
            'id_rw' => 'required|exists:rws,id',
            'id_pejabat' => 'nullable|exists:wargas,id',
        ]);

        $newPejabatId = empty($this->id_pejabat) ? null : $this->id_pejabat;

        if ($this->editId) {
            $oldRt = Rt::find($this->editId);
            if ($oldRt && $oldRt->id_pejabat !== $newPejabatId) {
                if ($oldRt->id_pejabat) {
                    $mantan = Warga::find($oldRt->id_pejabat);
                    $mantan->update(['jabatan_sosial' => 'Warga']);
                    $mantan->syncUserAccount(); // << Nonaktifkan akun lama
                }
            }
        }

        $rt = Rt::updateOrCreate(['id' => $this->editId], [
            'nama_rt' => $this->nama_rt,
            'id_rw' => $this->id_rw,
            'id_pejabat' => $newPejabatId,
        ]);

        // Aktifkan akun Pejabat baru
        if ($newPejabatId) {
            $pejabatBaru = Warga::find($newPejabatId);
            $pejabatBaru->syncUserAccount();
        }

        $this->dispatch('notify-success', 'Data RT & Akun Pejabat berhasil disinkronkan!');
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function executeDelete()
    {
        $rt = Rt::find($this->deleteId);
        if ($rt) {
            $rt->delete();
            $this->dispatch('notify-success', 'Data RT berhasil dihapus secara permanen!');
        }
        $this->isDeleteModalOpen = false;
        $this->deleteId = null;
    }

    public function render()
    {
        $rts = Rt::with(['rw', 'pejabat'])
            ->where('nama_rt', 'like', '%'.$this->search.'%')
            ->orWhereHas('rw', function ($q) {
                $q->where('nama_rw', 'like', '%'.$this->search.'%');
            })
            ->orWhereHas('pejabat', function ($q) {
                $q->where('nama', 'like', '%'.$this->search.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        $listRw = Rw::orderBy('nama_rw', 'asc')->get();

        // 1. Cari ID Warga yang sudah jadi Ketua di RT lain
        $pejabatTerpakai = Rt::whereNotNull('id_pejabat')
            ->when($this->editId, function ($query) {
                // Pengecualian: Kalau lagi mode Edit RT, Ketua RT saat ini tetap dimunculkan di dropdown
                $query->where('id', '!=', $this->editId);
            })
            ->pluck('id_pejabat')
            ->toArray();

        // 2. Filter Dropdown Kandidat: Status harus "RT" DAN belum dipakai di RT lain
        $kandidatPejabat = Warga::where('jabatan_sosial', 'RT')
            ->whereNotIn('id', $pejabatTerpakai)
            ->orderBy('nama', 'asc')
            ->get();

        return view('livewire.admin.data-rt', [
            'rts' => $rts,
            'listRw' => $listRw,
            'kandidatPejabat' => $kandidatPejabat,
        ])->title('Data RT');
    }
}
