<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kupon Mudhohi - {{ $kelompok->nama_kelompok }}</title>
    <style>
        @font-face {
            font-family: 'Work Sans';
            src: url('{{ public_path('assets/fonts/work_sans/WorkSans-Regular.ttf') }}') format('truetype');
            font-weight: normal; font-style: normal;
        }
        @font-face {
            font-family: 'Work Sans';
            src: url('{{ public_path('assets/fonts/work_sans/WorkSans-Bold.ttf') }}') format('truetype');
            font-weight: bold; font-style: normal;
        }

        @page { size: A4 portrait; margin: 10mm 12mm; }
        body { font-family: 'Work Sans', sans-serif; margin: 0; padding: 0; color: #1f2937; line-height: 1.2; }
        .ticket-wrapper { width: 100%; margin-bottom: 8px; page-break-inside: avoid; }
        .ticket-table { width: 100%; border-collapse: collapse; border: 1.5px dashed #1d4ed8; background-color: #eff6ff; }
        .ticket-table td { vertical-align: middle; }
        .ticket-left { width: 72%; padding: 8px 15px; }
        .ticket-right { width: 28%; padding: 8px; text-align: center; border-left: 1.5px dashed #3b82f6; background-color: #dbeafe; }
        .header-title { font-size: 13px; font-weight: bold; color: #1e40af; margin: 0; text-transform: uppercase; }
        .header-subtitle { font-size: 9px; color: #2563eb; margin: 2px 0 0 0; }
        .sesi-badge { font-size: 11px; font-weight: bold; color: #fff; background-color: #1d4ed8; padding: 3px 8px; border-radius: 4px; display: inline-block; }
        .penerima-nama { font-size: 18px; font-weight: bold; color: #111827; margin: 4px 0 2px 0; text-decoration: underline; text-decoration-color: #3b82f6; }
        .penerima-alamat { font-size: 10px; color: #374151; margin: 2px 0; line-height: 1.3; }
        .info-box { background-color: #ffffff; border: 1px solid #bfdbfe; padding: 4px 8px; margin-top: 5px; }
        .qr-box { margin: 0 auto 4px auto; background-color: #fff; padding: 3px; display: inline-block; border: 1px solid #93c5fd; }
        .qr-box img { width: 95px; height: 95px; }
        .kupon-number { font-size: 13px; font-family: 'Courier New', Courier, monospace; font-weight: bold; color: #1e40af; background-color: #fff; padding: 2px 4px; border: 1px solid #93c5fd; margin: 0; }
        .warning-text { font-size: 8px; color: #1e40af; font-weight: bold; margin-top: 3px; }
    </style>
</head>
<body>

    @foreach($kelompok->mudhohis as $mudhohi)
    <div class="ticket-wrapper">
        <table class="ticket-table">
            <tr>
                <td class="ticket-left">
                    <table width="100%" cellpadding="0" cellspacing="0" style="border: none; margin-bottom: 2px;">
                        <tr>
                            <td>
                                <h2 class="header-title">KUPON PENGAMBILAN DAGING (SHOHIBUL QURBAN)</h2>
                                <p class="header-subtitle">{{ $settings['masjid_name'] ?? 'Panitia Qurban' }} - Tahun {{ $kelompok->tahun }}</p>
                            </td>
                            <td style="text-align: right;">
                                <div class="sesi-badge">{{ $kelompok->nama_kelompok }}</div>
                            </td>
                        </tr>
                    </table>
                    
                    <h1 class="penerima-nama">{{ $mudhohi->warga->nama }}</h1>
                    
                    <div class="penerima-alamat">
                        <strong>NIK:</strong> {{ $mudhohi->warga->nik ?? '-' }} &nbsp;|&nbsp; <strong>HP:</strong> {{ $mudhohi->warga->phone_number ?? '-' }}<br>
                        <strong>Alamat:</strong> {{ $mudhohi->warga->alamat ?? '-' }}, RT {{ $mudhohi->warga->rt->nama_rt ?? '-' }} / RW {{ $mudhohi->warga->rt->rw->nama_rw ?? '-' }}
                    </div>

                    <div class="info-box">
                        <table width="100%" style="border:none;">
                            <tr>
                                <td style="font-size:10px; color:#1e40af; font-weight:bold;">
                                    KUPON MUSTAHIQ
                                </td>
                                <td style="font-size:10px; color:#1e40af; font-weight:bold; text-align:right;">
                                    Hewan: Sapi {{ $kelompok->sapi->kode_sapi ?? '-' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <p class="warning-text">* Bawa kupon ini sebagai jatah 1/3 bagian shohibul qurban.</p>
                </td>

                <td class="ticket-right">
                    <div class="qr-box">
                        @if($mudhohi->path_qr_code && file_exists(public_path('storage/'.$mudhohi->path_qr_code)))
                            @php $qrCode = base64_encode(file_get_contents(public_path('storage/'.$mudhohi->path_qr_code))); @endphp
                            <img src="data:image/svg+xml;base64,{{ $qrCode }}">
                        @else
                            <div style="width:95px; height:95px; line-height:95px; font-size:8px; color:#9ca3af; background:#fff;">NO QR</div>
                        @endif
                    </div>
                    <p style="font-size: 8px; margin:0 0 2px 0; color: #1e40af; font-weight: bold;">KODE KUPON</p>
                    <p class="kupon-number">{{ $mudhohi->kode_unik_kupon }}</p>
                </td>
            </tr>
        </table>
    </div>
    @endforeach

</body>
</html>