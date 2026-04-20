<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>RAB Pelaksanaan Qurban</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        .title { text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 20px; text-transform: uppercase; }
        .table-rab { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table-rab th, .table-rab td { border: 1px solid #000; padding: 6px 8px; vertical-align: middle; }
        .table-rab th { background-color: #f3f4f6; text-align: center; font-weight: bold; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .bg-gray { background-color: #f9fafb; }
    </style>
</head>
<body>

    <div class="title">RENCANA ANGGARAN BELANJA PELAKSANAAN QURBAN TAHUN {{ $tahun }}</div>

    <table class="table-rab">
        <thead>
            <tr>
                <th width="5%">NO</th>
                <th width="15%">LIST ITEM (KATEGORI)</th>
                <th width="25%">NAMA BARANG</th>
                <th width="8%">JUMLAH</th>
                <th width="15%">HARGA SATUAN</th>
                <th width="15%">TOTAL</th>
                <th width="17%">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $no = 1; 
                // Group data berdasarkan kategori agar bisa pakai rowspan
                $groupedRabs = $rabs->groupBy('kategori');
            @endphp

            @foreach($groupedRabs as $kategori => $items)
                @foreach($items as $index => $item)
                    <tr>
                        @if($index === 0)
                            <td class="text-center" rowspan="{{ $items->count() }}">{{ $no++ }}</td>
                            <td rowspan="{{ $items->count() }}" style="text-transform: uppercase;">{{ $kategori ?: 'LAIN-LAIN' }}</td>
                        @endif
                        
                        <td>{{ $item->nama_barang }}</td>
                        <td class="text-center">{{ $item->jumlah }}</td>
                        <td class="text-right">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                        <td>{{ $item->keterangan }}</td>
                    </tr>
                @endforeach
            @endforeach

            <tr>
                <td colspan="5" class="font-bold bg-gray" style="text-transform: uppercase;">JUMLAH PEMASUKAN</td>
                <td class="text-right font-bold bg-gray">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
                <td class="bg-gray"></td>
            </tr>
            <tr>
                <td colspan="5" class="font-bold bg-gray" style="text-transform: uppercase;">JUMLAH PENGELUARAN</td>
                <td class="text-right font-bold bg-gray">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
                <td class="bg-gray"></td>
            </tr>
            <tr>
                <td colspan="5" class="font-bold" style="text-transform: uppercase; background-color: #e5e7eb;">SISA ANGGARAN (DANA)</td>
                <td class="text-right font-bold" style="background-color: #e5e7eb;">Rp {{ number_format($sisaDana, 0, ',', '.') }}</td>
                <td style="background-color: #e5e7eb;"></td>
            </tr>
        </tbody>
    </table>

</body>
</html>