<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\Mudhohi;
use Barryvdh\DomPDF\Facade\Pdf;

class SertifikatController extends Controller
{
    public function cetak($id)
    {
        $mudhohi = Mudhohi::with(['warga', 'kelompokSapi.sapi'])->findOrFail($id);
        $settings = AppSetting::pluck('value', 'key')->toArray();

        // Load view HTML dan convert jadi PDF format Landscape (Tidur)
        $pdf = Pdf::loadView('pdf.sertifikat', compact('mudhohi', 'settings'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Sertifikat_Qurban_'.$mudhohi->warga->nama.'.pdf');
    }
}
