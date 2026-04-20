<?php

namespace App\Exports;

use App\Models\Rab;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RabExport implements FromView, ShouldAutoSize, WithStyles, WithColumnWidths
{
    protected $tahun;

    public function __construct($tahun)
    {
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        $rabs = Rab::where('tahun', $this->tahun)
            ->orderBy('jenis', 'asc')
            ->orderBy('kategori', 'asc')
            ->get();

        $totalPemasukan = $rabs->where('jenis', 'Pemasukan')->sum('total');
        $totalPengeluaran = $rabs->where('jenis', 'Pengeluaran')->sum('total');
        $sisaDana = $totalPemasukan - $totalPengeluaran;

        // Kita gunakan view yang sama persis dengan PDF!
        return view('pdf.rab', [
            'rabs' => $rabs,
            'tahun' => $this->tahun,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'sisaDana' => $sisaDana,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 18,
            'C' => 30,
            'D' => 10,
            'E' => 18,
            'F' => 18,
            'G' => 25,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();

        // Merge Title Row
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        // Deteksi baris Header (bisa Row 2 atau 3 dari parsing HTML view)
        $headerRow = ($sheet->getCell('A3')->getValue() == 'NO') ? 3 : 2;

        // Tabel Borders (Dari Header sampai Akhir Data)
        $sheet->getStyle('A'.$headerRow.':G'.$highestRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Style Header
        $sheet->getStyle('A'.$headerRow.':G'.$headerRow)->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFE5E7EB'], // bg-gray-200
            ],
        ]);

        // Wrap text untuk kolom yang panjang
        $sheet->getStyle('C')->getAlignment()->setWrapText(true);
        $sheet->getStyle('G')->getAlignment()->setWrapText(true);

        // Style 3 Baris Terakhir (Summary)
        $summaryStartRow = $highestRow - 2;
        $sheet->getStyle('A'.$summaryStartRow.':G'.$highestRow)->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFF9FAFB'], // bg-gray-50
            ],
        ]);

        // Style Baris Paling Akhir (Sisa Dana) - Lebih gelap sedikit
        $sheet->getStyle('A'.$highestRow.':G'.$highestRow)->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFD1D5DB'], // bg-gray-300
            ],
        ]);

        return [
            1 => ['font' => ['bold' => true, 'size' => 14]], // Judul
        ];
    }
}
