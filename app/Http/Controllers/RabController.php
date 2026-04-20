<?php

namespace App\Http\Controllers;

use App\Exports\RabExport;
use App\Models\AppSetting;
use App\Models\Rab;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class RabController extends Controller
{
    public function exportPdf()
    {
        $tahun = AppSetting::where('key', 'tahun')->first()?->value ?? date('Y');

        // Ambil data dan urutkan agar Pemasukan di atas, Pengeluaran di bawah
        $rabs = Rab::where('tahun', $tahun)
            ->orderBy('jenis', 'asc') // 'Pemasukan' huruf P duluan baru 'Pengeluaran'
            ->orderBy('kategori', 'asc')
            ->get();

        $totalPemasukan = $rabs->where('jenis', 'Pemasukan')->sum('total');
        $totalPengeluaran = $rabs->where('jenis', 'Pengeluaran')->sum('total');
        $sisaDana = $totalPemasukan - $totalPengeluaran;

        $pdf = Pdf::loadView('pdf.rab', compact('rabs', 'tahun', 'totalPemasukan', 'totalPengeluaran', 'sisaDana'))
            ->setPaper('a4', 'landscape'); // Kertas Landscape biar lega

        return $pdf->stream('Rencana_Anggaran_Belanja_Qurban_'.$tahun.'.pdf');
    }

    public function exportExcel()
    {
        $tahun = AppSetting::where('key', 'tahun')->first()?->value ?? date('Y');

        return Excel::download(new RabExport($tahun), 'Rencana_Anggaran_Belanja_Qurban_'.$tahun.'.xlsx');
    }
}
