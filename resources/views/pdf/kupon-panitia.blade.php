<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
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
        .ticket-table { width: 100%; border-collapse: collapse; border: 1.5px dashed #e11d48; background-color: #fff1f2; }
        .ticket-left { width: 72%; padding: 8px 15px; }
        .ticket-right { width: 28%; padding: 8px; text-align: center; border-left: 1.5px dashed #fb7185; background-color: #ffe4e6; }
        .header-title { font-size: 13px; font-weight: bold; color: #9f1239; margin: 0; text-transform: uppercase; }
        .header-subtitle { font-size: 9px; color: #be123c; margin: 2px 0 0 0; }
        .sesi-badge { font-size: 11px; font-weight: bold; color: #fff; background-color: #e11d48; padding: 3px 8px; border-radius: 4px; display: inline-block; }
        .penerima-nama { font-size: 18px; font-weight: bold; color: #111827; margin: 4px 0 2px 0; text-decoration: underline; text-decoration-color: #fb7185; }
        .penerima-alamat { font-size: 10px; color: #374151; margin: 2px 0; line-height: 1.3; }
        .info-box { background-color: #ffffff; border: 1px solid #fecdd3; padding: 4px 8px; margin-top: 5px; }
        .qr-box { margin: 0 auto 4px auto; background-color: #fff; padding: 3px; display: inline-block; border: 1px solid #fda4af; }
        .qr-box img { width: 95px; height: 95px; }
        .kupon-number { font-size: 13px; font-family: 'Courier New', Courier, monospace; font-weight: bold; color: #9f1239; background-color: #fff; padding: 2px 4px; border: 1px solid #fda4af; margin: 0; }
        .warning-text { font-size: 8px; color: #9f1239; font-weight: bold; margin-top: 3px; }
    </style>
</head>
<body>
    @foreach($panitias as $p)
    <div class="ticket-wrapper">
        <table class="ticket-table" width="100%">
            <tr>
                <td class="ticket-left">
                    <table width="100%" cellpadding="0" cellspacing="0" style="border: none; margin-bottom: 2px;">
                        <tr>
                            <td>
                                <h2 class="header-title">KUPON JATAH KONSUMSI PANITIA</h2>
                                <p class="header-subtitle">{{ $settings['masjid_name'] ?? 'Panitia Qurban' }} - {{ $p->tahun }}</p>
                            </td>
                            <td style="text-align: right;">
                                <div class="sesi-badge">TIM PANITIA</div>
                            </td>
                        </tr>
                    </table>
                    <h1 class="penerima-nama">{{ $p->warga->nama }}</h1>
                    <div class="penerima-alamat">
                        <strong>NIK:</strong> {{ $p->warga->nik ?? '-' }} &nbsp;|&nbsp; <strong>Jabatan:</strong> {{ $p->jabatan }}<br>
                        <strong>Unit:</strong> {{ $p->kelompokSapi->nama_kelompok ?? 'Struktur Inti' }}
                    </div>
                    <div class="info-box">
                        <table width="100%" style="border:none;">
                            <tr>
                                <td style="font-size:10px; color:#9f1239; font-weight:bold;">KUPON KHUSUS OPERASIONAL</td>
                                <td style="font-size:10px; color:#9f1239; font-weight:bold; text-align:right;">BERLAKU: HARI-H</td>
                            </tr>
                        </table>
                    </div>
                    <p class="warning-text">* Bawa kupon ini sebagai tanda pengenal resmi panitia di lapangan.</p>
                </td>
                <td class="ticket-right">
                    <div class="qr-box">
                        @if($p->path_qr_code && file_exists(public_path('storage/'.$p->path_qr_code)))
                            @php $qrCode = base64_encode(file_get_contents(public_path('storage/'.$p->path_qr_code))); @endphp
                            <img src="data:image/svg+xml;base64,{{ $qrCode }}">
                        @else
                            <div style="width:95px; height:95px; line-height:95px; font-size:8px; color:#9ca3af; background:#fff;">NO QR</div>
                        @endif
                    </div>
                    <p style="font-size: 8px; margin:0 0 2px 0; color: #9f1239; font-weight: bold;">KODE KUPON</p>
                    <p class="kupon-number">{{ $p->kode_unik_kupon }}</p>
                </td>
            </tr>
        </table>
    </div>
    @endforeach
</body>
</html>