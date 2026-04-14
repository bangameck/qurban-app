<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\KelompokSapi;
use Barryvdh\DomPDF\Facade\Pdf;

class KuponMudhohiController extends Controller
{
    public function cetakPerKelompok($id_kelompok)
    {
        // Tarik data Kelompok -> Mudhohi -> Warga -> RT -> RW
        $kelompok = KelompokSapi::with(['mudhohis.warga.rt.rw', 'sapi'])->findOrFail($id_kelompok);
        $settings = AppSetting::pluck('value', 'key')->toArray();

        $pdf = Pdf::loadView('pdf.kupon-mudhohi', compact('kelompok', 'settings'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Kupon_Mudhohi_'.str_replace(' ', '_', $kelompok->nama_kelompok).'.pdf');
    }
}
