<?php

namespace App\Livewire\Admin;

use App\Jobs\SendWhatsappMudhohiJob;
use App\Models\AppSetting;
use App\Models\KelompokSapi;
use App\Models\Mudhohi;
use App\Models\Warga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

#[Layout('components.layouts.app')]
#[Lazy]
#[Title('Data Peserta (Mudhohi)')]
class DataMudhohi extends Component
{
    use WithFileUploads, WithPagination;

    public $search = '';

    public $perPage = 12;

    public $isModalOpen = false;

    public $isDeleteModalOpen = false;

    public $editId = null;

    public $deleteId = null;

    // Form Properties
    public $id_warga;

    public $id_kelompok_sapi;

    public $tipe_qurban = 'Patungan';

    public $bukti_pendaftaran;

    public $existing_bukti;

    // Info Setting
    public $tahun_aktif;

    public $harga_patungan_display = 0;

    public function mount()
    {
        $settings = AppSetting::pluck('value', 'key')->toArray();
        $this->tahun_aktif = $settings['tahun'] ?? date('Y');
        $this->harga_patungan_display = $settings['harga_patungan'] ?? 0;
    }

    public function placeholder()
    {
        return view('components.skeleton._mudhohi');
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

    public function messages()
    {
        return [
            'id_warga.required' => 'Pilih warga (pendaftar) terlebih dahulu!',
            'id_warga.unique' => 'Warga ini sudah terdaftar sebagai Mudhohi!',
            'id_kelompok_sapi.required' => 'Pilih kelompok sapi!',
            'tipe_qurban.required' => 'Pilih tipe qurban!',
            'bukti_pendaftaran.image' => 'File harus berupa gambar (JPG/PNG)!',
            'bukti_pendaftaran.max' => 'Ukuran gambar maksimal 2MB!',
        ];
    }

    public function openModal($id = null)
    {
        $this->resetForm();
        if ($id) {
            $mudhohi = Mudhohi::find($id);

            // Proteksi: Jika sudah diambil, tidak boleh edit
            if ($mudhohi && $mudhohi->status_pengambilan == 'Sudah') {
                $this->dispatch('notify-error', 'Maaf, data yang sudah diambil tidak dapat diubah!');

                return;
            }

            $this->editId = $id;
            $this->id_warga = $mudhohi->id_warga;
            $this->id_kelompok_sapi = $mudhohi->id_kelompok_sapi;
            $this->tipe_qurban = $mudhohi->tipe_qurban;
            $this->existing_bukti = $mudhohi->path_bukti_pendaftaran;
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
        $this->id_warga = '';
        $this->id_kelompok_sapi = '';
        $this->tipe_qurban = 'Patungan';
        $this->bukti_pendaftaran = null;
        $this->existing_bukti = null;
        $this->resetValidation();
    }

    public function save()
    {
        if ($this->tipe_qurban === 'Individu') {
            $this->id_kelompok_sapi = null;
        }

        $this->validate([
            'id_warga' => 'required|exists:wargas,id|unique:mudhohis,id_warga,'.$this->editId,
            'id_kelompok_sapi' => $this->tipe_qurban === 'Individu' ? 'nullable' : 'required|exists:kelompok_sapis,id',
            'tipe_qurban' => 'required|in:Patungan,Individu,Kambing',
            'bukti_pendaftaran' => 'nullable|image|max:2048',
        ]);

        if ($this->id_kelompok_sapi) {
            $kelompok = KelompokSapi::withCount('mudhohis')->find($this->id_kelompok_sapi);
            if (! $this->editId && $kelompok && $kelompok->mudhohis_count >= 7) {
                $this->addError('id_kelompok_sapi', 'Maaf, kelompok ini sudah penuh (7 Orang)!');

                return;
            }
        }

        // Proses Upload Gambar Bukti
        $path = $this->existing_bukti;
        if ($this->bukti_pendaftaran) {
            $path = $this->bukti_pendaftaran->store('bukti_qurban', 'public');
        }

        $kode_unik = null;
        $qrPath = null;

        if ($this->editId) {
            $existing = Mudhohi::find($this->editId);
            $kode_unik = $existing->kode_unik_kupon;
            $qrPath = $existing->path_qr_code;
        } else {
            // Format: MDH-XXXXX
            $kode_unik = 'MDH-'.strtoupper(Str::random(3));
            $qrPath = 'qr_codes/mudhohi/'.$kode_unik.'.svg';

            // PERBAIKAN: Generate hanya $kode_unik agar QR Code-nya montok dan premium!
            $qrContent = QrCode::format('svg')
                ->size(500)
                ->margin(2)
                ->eye('circle')
                ->style('round')
                ->color(29, 78, 216) // RGB Biru Premium
                ->generate($kode_unik); // <--- INI BIANG KEROKNYA WAK, KITA GANTI JADI KODE AJA!

            Storage::disk('public')->put($qrPath, $qrContent, 'public');
        }

        $mudhohi = Mudhohi::updateOrCreate(
            ['id' => $this->editId],
            [
                'id_warga' => $this->id_warga,
                'id_kelompok_sapi' => $this->id_kelompok_sapi,
                'id_panitia' => Auth::id(),
                'tipe_qurban' => $this->tipe_qurban,
                'tahun' => $this->tahun_aktif,
                'path_bukti_pendaftaran' => $path,
                'kode_unik_kupon' => $kode_unik,
                'path_qr_code' => $qrPath,
            ]
        );

        // Kirim WA jika data baru
        if (! $this->editId) {
            $mudhohi->load(['warga', 'kelompokSapi']);
            if ($mudhohi->warga->phone_number) {
                SendWhatsappMudhohiJob::dispatch($mudhohi);
            }
        }

        $this->dispatch('notify-success', $this->editId ? 'Data Mudhohi diperbarui!' : 'Pendaftar berhasil ditambahkan! QR Code Biru Ter-generate.');
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function executeDelete()
    {
        $mudhohi = Mudhohi::find($this->deleteId);
        if ($mudhohi) {
            // Proteksi: Jika sudah diambil, tidak boleh hapus
            if ($mudhohi->status_pengambilan == 'Sudah') {
                $this->dispatch('notify-error', 'Gagal! Data yang sudah diambil tidak boleh dihapus.');
                $this->isDeleteModalOpen = false;

                return;
            }

            // Hapus Bukti & QR Code dari Storage
            if ($mudhohi->path_bukti_pendaftaran && Storage::disk('public')->exists($mudhohi->path_bukti_pendaftaran)) {
                Storage::disk('public')->delete($mudhohi->path_bukti_pendaftaran);
            }
            if ($mudhohi->path_qr_code && Storage::disk('public')->exists($mudhohi->path_qr_code)) {
                Storage::disk('public')->delete($mudhohi->path_qr_code);
            }

            $mudhohi->delete();
            $this->dispatch('notify-success', 'Data Mudhohi berhasil dihapus!');
        }
        $this->isDeleteModalOpen = false;
        $this->deleteId = null;
    }

    public function render()
    {
        usleep(200000);
        $mudhohis = Mudhohi::with(['warga.rt.rw', 'kelompokSapi.sapi', 'panitia'])
            ->where('tahun', $this->tahun_aktif)
            ->where(function ($q) {
                $q->whereHas('warga', function ($sq) {
                    $sq->where('nama', 'like', '%'.$this->search.'%')
                        ->orWhere('nik', 'like', '%'.$this->search.'%')
                        ->orWhere('phone_number', 'like', '%'.$this->search.'%');
                })
                    ->orWhere('kode_unik_kupon', 'like', '%'.$this->search.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);

        $wargas = Warga::whereNotIn('id', function ($query) {
            $query->select('id_warga')
                ->from('mudhohis')
                ->where('tahun', $this->tahun_aktif)
                ->whereNotNull('id_warga');
        })->orderBy('nama', 'asc')->get();

        $kelompoks = KelompokSapi::with('sapi')
            ->where('tahun', $this->tahun_aktif)
            ->withCount('mudhohis')
            ->get()
            ->filter(function ($kelompok) {
                return $kelompok->mudhohis_count < 7 || $kelompok->id == $this->id_kelompok_sapi;
            });

        return view('livewire.admin.data-mudhohi', [
            'mudhohis' => $mudhohis,
            'wargas' => $wargas,
            'kelompoks' => $kelompoks,
        ])->title('Data Pendaftar (Mudhohi)');
    }
}
