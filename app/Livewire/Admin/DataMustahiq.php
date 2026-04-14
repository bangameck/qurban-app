<?php

namespace App\Livewire\Admin;

use App\Jobs\SendWhatsappKuponJob;
use App\Models\Mudhohi;
use App\Models\Mustahiq;
use App\Models\SesiDistribusi;
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
class DataMustahiq extends Component
{
    use WithPagination;

    public $search = '';

    public $isModalOpen = false;

    public $isDeleteModalOpen = false;

    public $isDetailModalOpen = false;

    public $deleteId = null;

    // Form Properties
    public $id_warga;

    public $id_sesi_distribusi;

    public $kategori_penerima = 'Mustahiq';

    // Detail Properties
    public $detailData = null;

    public $detailSapi = null; // Khusus kalau dia Mudhohi

    public function placeholder()
    {
        return view('components.skeleton._sesi'); // Pakai skeleton sesi aja karena mirip tabelnya
    }

    public function generateUniqueCode()
    {
        do {
            // Format QBN-XXX (3 Karakter Acak)
            $code = 'QBN-'.strtoupper(Str::random(3));
        } while (Mustahiq::where('kode_unik_kupon', $code)->exists());

        return $code;
    }

    public function openModal()
    {
        $this->resetForm();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    public function closeDetailModal()
    {
        // Tutup modal
        $this->isDetailModalOpen = false;

        // Bersihkan data biar memori enteng
        $this->detailData = null;
        $this->detailSapi = null;

        // Karena ini lari ke server, Livewire otomatis akan menjalankan fungsi render() lagi
        // yang artinya tabel di belakang layar langsung nge-refresh narik data terbaru!
    }

    public function resetForm()
    {
        $this->id_warga = '';
        $this->id_sesi_distribusi = '';
        $this->kategori_penerima = 'Mustahiq';
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate([
            'id_warga' => 'required|exists:wargas,id|unique:mustahiqs,id_warga', // Pastikan warga belum dapat kupon
            'id_sesi_distribusi' => 'required|exists:sesi_distribusis,id',
            'kategori_penerima' => 'required|in:Mustahiq,Mudhohi,Panitia',
        ], [
            'id_warga.unique' => 'Warga ini sudah menerima kupon!',
        ]);

        $sesi = SesiDistribusi::withCount('mustahiqs')->find($this->id_sesi_distribusi);
        if ($sesi->mustahiqs_count >= $sesi->kuota_maksimal) {
            $this->addError('id_sesi_distribusi', 'Kuota sesi ini sudah penuh wak!');

            return;
        }

        $kode = $this->generateUniqueCode();
        // UBAH KE SVG BIAR AMAN DAN ANTI GAGAL WAK!
        $qrPath = 'qrcodes/'.$kode.'.svg';

        $image = QrCode::format('svg')
            ->size(500)->margin(2)
            ->eye('circle')
            ->style('round')
            ->color(4, 120, 87) // Warna Primary
            ->generate($kode);

        Storage::disk('public')->put($qrPath, $image, 'public');

        $mustahiq = Mustahiq::create([
            'id_warga' => $this->id_warga,
            'id_sesi_distribusi' => $this->id_sesi_distribusi,
            'kategori_penerima' => $this->kategori_penerima,
            'kode_unik_kupon' => $kode,
            'path_qr_code' => $qrPath,
            'status_pengambilan' => 'Belum',
        ]);

        // Blast WA via Queue
        SendWhatsappKuponJob::dispatch($mustahiq);

        $this->dispatch('notify-success', 'Kupon Berhasil Dibuat & Dikirim via WA!');
        $this->closeModal();
    }

    // --- FITUR DETAIL ---
    public function openDetailModal($id)
    {
        $this->detailData = Mustahiq::with(['warga', 'sesiDistribusi', 'panitiaScanner'])->find($id);

        // Cek apakah dia Mudhohi, kalau iya cari data Sapinya
        $this->detailSapi = null;
        if ($this->detailData->kategori_penerima == 'Mudhohi') {
            $mudhohiRecord = Mudhohi::with('kelompokSapi.sapi')->where('id_warga', $this->detailData->id_warga)->first();
            if ($mudhohiRecord && $mudhohiRecord->kelompokSapi) {
                $this->detailSapi = $mudhohiRecord->kelompokSapi->sapi;
            }
        }

        $this->isDetailModalOpen = true;
    }

    // --- FITUR DELETE ---
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function executeDelete()
    {
        $mustahiq = Mustahiq::find($this->deleteId);
        if ($mustahiq) {
            // Hapus file QR Code-nya sekalian biar storage nggak penuh
            if ($mustahiq->path_qr_code && Storage::disk('public')->exists($mustahiq->path_qr_code)) {
                Storage::disk('public')->delete($mustahiq->path_qr_code);
            }
            $mustahiq->delete();
            $this->dispatch('notify-success', 'Kupon Mustahiq berhasil dibatalkan/dihapus!');
        }
        $this->isDeleteModalOpen = false;
        $this->deleteId = null;
    }

    public function render()
    {
        $mustahiqs = Mustahiq::with(['warga', 'sesiDistribusi'])
            ->whereHas('warga', function ($q) {
                $q->where('nama', 'like', "%{$this->search}%")
                    ->orWhere('kode_unik_kupon', 'like', "%{$this->search}%");
            })
            ->latest()->paginate(10);

        // FILTER WARGA: Hanya ambil warga yang BELUM ADA di tabel mustahiqs
        $wargaSudahDapat = Mustahiq::pluck('id_warga')->toArray();
        $wargas = Warga::whereNotIn('id', $wargaSudahDapat)->orderBy('nama')->get();

        $sesis = SesiDistribusi::withCount('mustahiqs')->get();

        return view('livewire.admin.data-mustahiq', [
            'mustahiqs' => $mustahiqs,
            'wargas' => $wargas,
            'sesis' => $sesis,
        ])->title('Manajemen Kupon | Qurban App');
    }
}
