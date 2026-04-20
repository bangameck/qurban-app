<?php

namespace App\Livewire\Admin;

use App\Models\AppSetting;
use App\Models\SesiDistribusi;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Lazy]
class DataSesiDistribusi extends Component
{
    use WithPagination;

    public $search = '';

    public $isModalOpen = false;

    public $isDeleteModalOpen = false;

    public $isDetailModalOpen = false; // Untuk Modal Daftar Mustahiq

    public $editId = null;

    public $deleteId = null;

    public $detailSesi = null; // Menyimpan data sesi yang sedang di-klik detailnya

    // Form Properties
    public $nama_sesi;

    public $jam_mulai;

    public $jam_selesai;

    public $kuota_maksimal;

    // Multi Tahun
    public $tahun_aktif;

    public function mount()
    {
        $settings = AppSetting::pluck('value', 'key')->toArray();
        $this->tahun_aktif = $settings['tahun'] ?? date('Y');
    }

    public function placeholder()
    {
        return view('components.skeleton._sesi');
    }

    public function messages()
    {
        return [
            'nama_sesi.required' => 'Nama sesi wajib diisi (Contoh: Sesi Warga RT 01)!',
            'jam_mulai.required' => 'Jam mulai wajib diisi!',
            'jam_selesai.required' => 'Jam selesai wajib diisi!',
            'jam_selesai.after' => 'Jam selesai harus lebih dari jam mulai!',
            'kuota_maksimal.required' => 'Kuota maksimal wajib diisi!',
            'kuota_maksimal.min' => 'Kuota minimal 1 orang!',
        ];
    }

    public function openModal($id = null)
    {
        $this->resetForm();
        if ($id) {
            $this->editId = $id;
            $sesi = SesiDistribusi::find($id);
            $this->nama_sesi = $sesi->nama_sesi;
            $this->jam_mulai = Carbon::parse($sesi->jam_mulai)->format('H:i');
            $this->jam_selesai = Carbon::parse($sesi->jam_selesai)->format('H:i');
            $this->kuota_maksimal = $sesi->kuota_maksimal;
        }
        $this->isModalOpen = true;
    }

    // Fungsi Baru untuk Buka Modal Detail Mustahiq
    public function openDetailModal($id)
    {
        // Load relasi mustahiqs dan warganya
        $this->detailSesi = SesiDistribusi::with(['mustahiqs.warga'])->find($id);
        $this->isDetailModalOpen = true;
    }

    public function closeDetailModal()
    {
        $this->isDetailModalOpen = false;
        $this->detailSesi = null;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->editId = null;
        $this->nama_sesi = '';
        $this->jam_mulai = '';
        $this->jam_selesai = '';
        $this->kuota_maksimal = '';
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate([
            'nama_sesi' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kuota_maksimal' => 'required|integer|min:1',
        ]);

        SesiDistribusi::updateOrCreate(
            ['id' => $this->editId],
            [
                'nama_sesi' => $this->nama_sesi,
                'jam_mulai' => $this->jam_mulai,
                'jam_selesai' => $this->jam_selesai,
                'kuota_maksimal' => $this->kuota_maksimal,
                'tahun' => $this->tahun_aktif, // Tambahkan Simpan Tahun Aktif
            ]
        );

        $this->dispatch('notify-success', $this->editId ? 'Sesi distribusi diperbarui!' : 'Sesi distribusi baru berhasil dibuat!');
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function executeDelete()
    {
        $sesi = SesiDistribusi::find($this->deleteId);
        if ($sesi) {
            $sesi->delete();
            $this->dispatch('notify-success', 'Sesi distribusi berhasil dihapus!');
        }
        $this->isDeleteModalOpen = false;
        $this->deleteId = null;
    }

    public function render()
    {
        usleep(200000);
        // Filter tabel pakai Tahun Aktif
        $sesis = SesiDistribusi::withCount('mustahiqs')
            ->where('tahun', $this->tahun_aktif) // FILTER TAHUN
            ->where('nama_sesi', 'like', '%'.$this->search.'%')
            ->orderBy('jam_mulai', 'asc') // Urutkan berdasarkan waktu mulai
            ->paginate(10);

        return view('livewire.admin.data-sesi-distribusi', [
            'sesis' => $sesis,
        ])->title('Sesi Distribusi');
    }
}
