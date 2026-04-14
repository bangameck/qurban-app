<?php

namespace App\Livewire\Display;

use App\Models\AppSetting;
use App\Models\KelompokSapi;
use App\Models\Mudhohi;
use App\Models\Mustahiq;
use App\Models\Panitia;
use App\Models\Sapi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.blank')]
class LiveScreen extends Component
{
    public $tahun_aktif;

    public string $lastScanTime;

    public string $lastSapiTime;

    public function mount()
    {
        $this->tahun_aktif = AppSetting::where('key', 'tahun')->first()?->value ?? date('Y');
        $this->lastScanTime = now()->format('Y-m-d H:i:s');
        $this->lastSapiTime = now()->format('Y-m-d H:i:s');
    }

    public function checkLiveEvents()
    {
        try {
            // 1. CEK SCAN KUPON TERBARU (GABUNGAN)
            $scans = collect();

            try {
                $m = Mustahiq::with('warga')->whereNotNull('waktu_diambil')->where('waktu_diambil', '>', $this->lastScanTime)->latest('waktu_diambil')->first();
                if ($m) {
                    $scans->push($m);
                }
            } catch (\Exception $e) {
            }

            try {
                $md = Mudhohi::with('warga')->whereNotNull('waktu_diambil')->where('waktu_diambil', '>', $this->lastScanTime)->latest('waktu_diambil')->first();
                if ($md) {
                    $scans->push($md);
                }
            } catch (\Exception $e) {
            }

            try {
                $p = Panitia::with('warga')->whereNotNull('waktu_diambil')->where('waktu_diambil', '>', $this->lastScanTime)->latest('waktu_diambil')->first();
                if ($p) {
                    $scans->push($p);
                }
            } catch (\Exception $e) {
            }

            $latestScan = $scans->sortByDesc('waktu_diambil')->first();

            if ($latestScan) {
                $this->lastScanTime = Carbon::parse($latestScan->waktu_diambil)->format('Y-m-d H:i:s');

                $type = 'Warga';
                if ($latestScan instanceof Panitia) {
                    $type = 'Panitia';
                }
                if ($latestScan instanceof Mudhohi) {
                    $type = 'Mudhohi';
                }
                if ($latestScan instanceof Mustahiq) {
                    $type = 'Mustahiq';
                }

                $this->dispatch('show-scan-popup', [
                    'nama' => $latestScan->warga->nama ?? 'Hamba Allah',
                    'tipe' => $type,
                    'waktu' => Carbon::parse($latestScan->waktu_diambil)->format('H:i:s'),
                ]);
            }

            // 2. CEK STATUS SAPI TERBARU
            $latestSapi = Sapi::where('updated_at', '>', $this->lastSapiTime)->latest('updated_at')->first();
            if ($latestSapi) {
                $this->lastSapiTime = Carbon::parse($latestSapi->updated_at)->format('Y-m-d H:i:s');
                $this->dispatch('show-sapi-popup', [
                    'kode' => $latestSapi->kode_sapi,
                    // UBAH KE status_proses
                    'status' => $latestSapi->status_proses ?? 'Telah Diupdate',
                ]);
            }

        } catch (\Exception $e) {
            Log::error('LiveScreen Polling Error: '.$e->getMessage());
        }
    }

    public function render()
    {
        // AMBIL SEMUA DATA KUPON (YANG SUDAH DAN BELUM MENGAMBIL)
        $allKupon = collect();

        $mapKupon = function ($i, $tipe) {
            $alamatParts = [];
            if ($i->warga) {
                if ($i->warga->alamat) $alamatParts[] = $i->warga->alamat;
                if ($i->warga->rt) {
                    $alamatParts[] = 'RT ' . $i->warga->rt->nama_rt;
                    if ($i->warga->rt->rw) {
                        $alamatParts[] = 'RW ' . $i->warga->rt->rw->nama_rw;
                        if ($i->warga->rt->rw->kelurahan) $alamatParts[] = $i->warga->rt->rw->kelurahan;
                        if ($i->warga->rt->rw->kecamatan) $alamatParts[] = $i->warga->rt->rw->kecamatan;
                    }
                }
            }
            return (object) [
                'waktu' => $i->waktu_diambil,
                'nama' => $i->warga->nama ?? 'Hamba Allah',
                'tipe' => $tipe,
                'status' => $i->status_pengambilan ?? 'Belum',
                'alamat' => count($alamatParts) > 0 ? implode(', ', $alamatParts) : '-'
            ];
        };

        try {
            $allKupon = $allKupon->concat(
                Mustahiq::with('warga.rt.rw')->where('tahun', $this->tahun_aktif)->get()
                    ->map(fn ($i) => $mapKupon($i, 'Mustahiq'))
            );
        } catch (\Exception $e) {
        }

        try {
            $allKupon = $allKupon->concat(
                Mudhohi::with('warga.rt.rw')->where('tahun', $this->tahun_aktif)->get()
                    ->map(fn ($i) => $mapKupon($i, 'Mudhohi'))
            );
        } catch (\Exception $e) {
        }

        try {
            $allKupon = $allKupon->concat(
                Panitia::with('warga.rt.rw')->where('tahun', $this->tahun_aktif)->get()
                    ->map(fn ($i) => $mapKupon($i, 'Panitia'))
            );
        } catch (\Exception $e) {
        }

        // SORTIR CERDAS:
        // 1. Yang "Sudah" diurutkan dari yang paling baru di-scan.
        // 2. Yang "Belum" diurutkan berdasarkan Abjad Nama.
        $sudahDiambil = $allKupon->where('status', 'Sudah')->sortByDesc('waktu');
        $belumDiambil = $allKupon->where('status', '!=', 'Sudah')->sortBy('nama');

        // Gabungkan kembali
        $daftarDistribusi = $sudahDiambil->concat($belumDiambil)->values();

        return view('livewire.display.live-screen', [
            'sapis' => Sapi::where('tahun', $this->tahun_aktif)->get(),
            'kelompoks' => KelompokSapi::with(['sapi', 'mudhohis.warga'])->where('tahun', $this->tahun_aktif)->get(),
            'semuaKupon' => $daftarDistribusi,
            'settings' => AppSetting::pluck('value', 'key')->toArray(),
        ])->title('Live Display TV | Qurban App');
    }
}
