<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\Panitia;
use Barryvdh\DomPDF\Facade\Pdf;

class KuponPanitiaController extends Controller
{
    public function cetakSemua()
    {
        $settings = AppSetting::pluck('value', 'key')->toArray();
        $tahun = $settings['tahun'] ?? date('Y');

        // Ambil semua panitia tahun aktif
        $panitias = Panitia::with(['warga.rt.rw', 'kelompokSapi'])
            ->where('tahun', $tahun)
            ->get();

        $pdf = Pdf::loadView('pdf.kupon-panitia', compact('panitias', 'settings'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Kupon_Panitia_'.$tahun.'.pdf');
    }

    public function cetakIdCard()
    {
        $settings = AppSetting::pluck('value', 'key')->toArray();
        $tahun = $settings['tahun'] ?? date('Y');

        // Ambil semua panitia tahun aktif
        $panitias = Panitia::with(['warga', 'kelompokSapi'])
            ->where('tahun', $tahun)
            ->get();

        $pdf = Pdf::setOption(['isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true])
            ->loadView('pdf.id-card-panitia', compact('panitias', 'settings', 'tahun'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('ID_Card_Panitia_'.$tahun.'.pdf');
    }
}
