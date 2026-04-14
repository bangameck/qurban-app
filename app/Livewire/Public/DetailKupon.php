<?php

namespace App\Livewire\Public;

use App\Models\Mudhohi;
use App\Models\Mustahiq;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
#[Layout('components.layouts.public')] // Pakai layout Auth biar tampilannya fokus di tengah
class DetailKupon extends Component
{
    public $kode;

    public function mount($kode)
    {
        usleep(200000);
        $this->kode = $kode;
    }

    public function placeholder()
    {
        return view('components.skeleton.public._details-kupon');
    }

    public function render()
    {
        // Tambahkan relasi pejabat (asumsi di model RT ada public function pejabat() { return $this->belongsTo(Warga::class, 'id_pejabat'); })
        $mustahiq = Mustahiq::with(['warga.rt.rw', 'warga.rt.pejabat', 'sesiDistribusi'])
            ->where('kode_unik_kupon', $this->kode)
            ->firstOrFail();

        // Ambil nama pejabat RT dari relasi berjenjang
        $pejabatRT = 'Belum Ada RT';
        if ($mustahiq->warga && $mustahiq->warga->rt && $mustahiq->warga->rt->pejabat) {
            $pejabatRT = $mustahiq->warga->rt->pejabat->nama;
        }

        $sapi = null;
        if ($mustahiq->kategori_penerima == 'Mudhohi') {
            $mudhohiRecord = Mudhohi::with('kelompokSapi.sapi')->where('id_warga', $mustahiq->id_warga)->first();
            if ($mudhohiRecord && $mudhohiRecord->kelompokSapi) {
                $sapi = $mudhohiRecord->kelompokSapi->sapi;
            }
        }

        return view('livewire.public.detail-kupon', [
            'mustahiq' => $mustahiq,
            'sapi' => $sapi,
            'pejabatRT' => $pejabatRT, // Lempar ke view
        ])->title('Kupon Qurban | '.$this->kode);
    }
}
