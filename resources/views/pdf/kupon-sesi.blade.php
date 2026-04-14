<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kupon Qurban - {{ $sesi->nama_sesi }}</title>
    <style>
        /* Registrasi Font Work Sans */
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

        /* Margin Kertas Tipis biar muat 5 kupon */
        @page {
            size: A4 portrait;
            margin: 10mm 12mm;
        }
        
        body {
            font-family: 'Work Sans', sans-serif;
            margin: 0; padding: 0;
            color: #1f2937;
            line-height: 1.2;
        }
        
        /* Wrapper Kupon */
        .ticket-wrapper {
            width: 100%;
            margin-bottom: 8px;
            page-break-inside: avoid; 
        }

        /* Tabel Utama - Border Hijau Emerald */
        .ticket-table {
            width: 100%;
            border-collapse: collapse;
            border: 1.5px dashed #059669;
            background-color: #f0fdf4;
        }

        .ticket-table td { vertical-align: middle; }

        /* Sisi Kiri (Informasi) */
        .ticket-left {
            width: 72%;
            padding: 8px 15px;
        }

        /* Sisi Kanan (QR & Kode) */
        .ticket-right {
            width: 28%;
            padding: 8px;
            text-align: center;
            border-left: 1.5px dashed #34d399;
            background-color: #d1fae5;
        }

        /* Tipografi Kiri */
        .header-title {
            font-size: 13px;
            font-weight: bold;
            color: #065f46;
            margin: 0;
            text-transform: uppercase;
        }
        .header-subtitle {
            font-size: 9px;
            color: #047857;
            margin: 2px 0 0 0;
        }
        
        .sesi-badge {
            font-size: 11px;
            font-weight: bold;
            color: #fff;
            background-color: #059669;
            padding: 3px 8px;
            border-radius: 4px;
            display: inline-block;
        }

        .penerima-nama {
            font-size: 18px;
            font-weight: bold;
            color: #111827;
            margin: 4px 0 2px 0;
            text-decoration: underline;
            text-decoration-color: #34d399;
        }
        
        .penerima-alamat {
            font-size: 10px;
            color: #374151;
            margin: 2px 0;
            line-height: 1.3;
        }

        .info-box {
            background-color: #ffffff;
            border: 1px solid #a7f3d0;
            padding: 4px 8px;
            margin-top: 5px;
        }
        
        .info-text {
            font-size: 10px;
            color: #065f46;
            margin: 0;
            font-weight: bold;
        }
        
        /* Tipografi Kanan (QR Code Besar & Kode Kecil) */
        .qr-box {
            margin: 0 auto 4px auto;
            background-color: #fff;
            padding: 3px;
            display: inline-block;
            border: 1px solid #6ee7b7;
        }
        .qr-box img {
            width: 95px; /* DIBESARKAN WAK! */
            height: 95px;
        }
        
        .kupon-number {
            font-size: 13px; /* DIKECILKAN WAK! */
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
            color: #065f46;
            background-color: #fff;
            padding: 2px 4px;
            border: 1px solid #6ee7b7;
            margin: 0;
        }

        .warning-text {
            font-size: 8px;
            color: #dc2626;
            font-weight: bold;
            margin-top: 3px;
        }
    </style>
</head>
<body>

    @foreach($sesi->mustahiqs as $index => $mustahiq)
    <div class="ticket-wrapper">
        <table class="ticket-table">
            <tr>
                <td class="ticket-left">
                    <table width="100%" cellpadding="0" cellspacing="0" style="border: none; margin-bottom: 2px;">
                        <tr>
                            <td style="vertical-align: top;">
                                <h2 class="header-title">KUPON PENGAMBILAN DAGING QURBAN</h2>
                                <p class="header-subtitle">{{ $settings['masjid_name'] ?? 'Panitia Qurban' }} - Tahun {{ $sesi->tahun }}</p>
                            </td>
                            <td style="vertical-align: top; text-align: right;">
                                <div class="sesi-badge">{{ $sesi->nama_sesi }}</div>
                            </td>
                        </tr>
                    </table>
                    
                    <h1 class="penerima-nama">{{ $mustahiq->warga->nama }}</h1>
                    
                    <div class="penerima-alamat">
                        <strong>NIK:</strong> {{ $mustahiq->warga->nik ?? '-' }} &nbsp;|&nbsp; <strong>HP:</strong> {{ $mustahiq->warga->phone_number ?? '-' }}<br>
                        <strong>Alamat:</strong> {{ $mustahiq->warga->alamat ?? '-' }}, 
                        RT {{ str_pad($mustahiq->warga->rt->nama_rt ?? '-', 2, '0', STR_PAD_LEFT) }} / RW {{ str_pad($mustahiq->warga->rt->rw->nama_rw ?? '-', 2, '0', STR_PAD_LEFT) }}, 
                        Kel. {{ $mustahiq->warga->rt->rw->kelurahan ?? '-' }}
                    </div>

                    <div class="info-box">
                        <table width="100%" style="border:none;">
                            <tr>
                                <td style="font-size:10px; color:#065f46; font-weight:bold;">
                                    Kategori: {{ strtoupper($mustahiq->kategori_penerima) }}
                                </td>
                                <td style="font-size:10px; color:#065f46; font-weight:bold; text-align:right;">
                                    Jam: {{ \Carbon\Carbon::parse($sesi->jam_mulai)->format('H:i') }}-{{ \Carbon\Carbon::parse($sesi->jam_selesai)->format('H:i') }} WIB
                                </td>
                            </tr>
                        </table>
                    </div>
                    <p class="warning-text">* Bawa kupon ini sebagai bukti sah pengambilan daging.</p>
                </td>

                <td class="ticket-right">
                    <div class="qr-box">
                        @if($mustahiq->path_qr_code && file_exists(public_path('storage/'.$mustahiq->path_qr_code)))
                            @php $qrCode = base64_encode(file_get_contents(public_path('storage/'.$mustahiq->path_qr_code))); @endphp
                            <img src="data:image/svg+xml;base64,{{ $qrCode }}">
                        @else
                            <div style="width:95px; height:95px; line-height:95px; font-size:8px; color:#9ca3af; background:#fff;">NO QR</div>
                        @endif
                    </div>
                    
                    <p style="font-size: 8px; margin:0 0 2px 0; color: #065f46; font-weight: bold;">KODE KUPON</p>
                    <p class="kupon-number">{{ $mustahiq->kode_unik_kupon }}</p>
                </td>
            </tr>
        </table>
    </div>
    @endforeach

</body>
</html>