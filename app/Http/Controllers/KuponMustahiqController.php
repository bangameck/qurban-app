<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\SesiDistribusi;
use Barryvdh\DomPDF\Facade\Pdf;

class KuponMustahiqController extends Controller
{
    public function cetakPerSesi($id_sesi)
    {
        // Tarik data Sesi -> Mustahiq -> Warga -> RT -> RW (Nested Eager Loading)
        $sesi = SesiDistribusi::with(['mustahiqs.warga.rt.rw'])->findOrFail($id_sesi);
        $settings = AppSetting::pluck('value', 'key')->toArray();

        // Load view PDF dan setting kertas A4 Portrait
        $pdf = Pdf::loadView('pdf.kupon-sesi', compact('sesi', 'settings'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Kupon_Qurban_'.str_replace(' ', '_', $sesi->nama_sesi).'.pdf');
    }
}
