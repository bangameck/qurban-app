<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>ID Card Premium Panitia Qurban</title>
    <style>
        /* Import Font Premium */
        @import url('https://fonts.googleapis.com/css2?family=El+Messiri:wght@600;700&family=Work+Sans:wght@400;700;900&display=swap');

        @page { 
            size: A4 portrait; 
            margin: 10mm; /* Area print aman */
        }
        
        body { 
            font-family: 'Work Sans', sans-serif; 
            margin: 0; 
            padding: 0; 
            background-color: #ffffff;
        }

        /* TABEL GRID UNTUK DOMPDF (SUPER AMAN 9 PER HALAMAN) */
        .grid-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 5mm; /* Jarak antar kartu */
            table-layout: fixed;
        }

        .grid-td {
            width: 33.333%; /* Pas 3 Kolom */
            padding: 0;
            vertical-align: top;
        }

        /* ID CARD STYLING - PREMIUM SULTANATE */
        .id-card {
            width: 100%;
            height: 85mm; /* Standar ID Card (CR80) */
            border: 2px solid #064e3b; /* Primary Green Dark */
            border-radius: 8px;
            background-color: #ffffff;
            position: relative;
            box-sizing: border-box;
            text-align: center;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* PREMIUM INTEGRATED HEADER & ACCENTS */
        .card-header-integrated {
            background-color: #064e3b;
            color: #ffffff;
            padding: 8px 5px;
            height: 34mm; /* Diperbesar untuk Logo */
            box-sizing: border-box;
            position: relative;
            z-index: 5;
        }

        /* Fluid Gold Accent Lines Flowing Behind Elements */
        .gold-accent-header {
            width: 130%;
            height: 50px;
            background-color: transparent;
            border-radius: 50%;
            position: absolute;
            top: -20px;
            left: -15%;
            border-bottom: 2px solid #fde68a; /* Rich Gold Accent */
            opacity: 0.3;
        }

        .logo-masjid {
            width: 30px;
            height: 30px;
            object-fit: contain;
            margin-bottom: 3px;
            position: relative;
            z-index: 10;
        }

        .header-title {
            font-size: 8.5px;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin: 0 0 2px 0;
            color: #d1fae5;
            position: relative;
            z-index: 10;
        }

        .masjid-name-premium {
            font-family: 'El Messiri', serif;
            font-size: 11.5px;
            font-weight: 700;
            margin: 0;
            line-height: 1.2;
            color: #fde68a; /* Warna Emas Sultanate */
            text-transform: uppercase;
            position: relative;
            z-index: 10;
        }

        /* FLUID PHOTO INTEGRATION - NO BLOCKY SPLIT */
        .photo-area-integrated {
            text-align: center;
            margin-top: -15px; /* Narik foto numpuk di header terintegrasi */
            position: relative;
            z-index: 15;
        }

        .photo-circle-premium {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            border: 4px solid #ffffff;
            background-color: #e5e7eb;
            object-fit: cover;
            box-shadow: 0 3px 6px rgba(0,0,0,0.2);
        }

        /* FLUID DESIGN CONTINUITY */
        .integrated-gold-flow {
            width: 100%;
            height: 30px;
            background-color: #064e3b;
            border-radius: 0 0 50% 50%;
            margin-top: -15px; /* Connects header to photo */
            position: relative;
            z-index: 1;
        }
        
        /* Subtle Gold Fluid Lines across bottom light area */
        .subtle-gold-flow {
            width: 140%;
            height: 60px;
            border-radius: 50%;
            position: absolute;
            bottom: 25px;
            left: -20%;
            border-top: 1px solid #fde68a;
            opacity: 0.15;
            z-index: 2;
        }

        /* INFO PANITIA - INTEGRATED INTO FLOW */
        .details-area-integrated {
            padding: 5px;
            margin-top: 5px;
            position: relative;
            z-index: 10;
        }

        .panitia-name-premium {
            font-size: 14px;
            font-weight: 900;
            color: #111827;
            margin: 0 0 6px 0;
            line-height: 1.1;
            text-transform: capitalize;
        }

        /* PREMIUM METALLIC-EFFECT BADGE */
        .jabatan-badge-metallic {
            display: inline-block;
            background-color: #ecfdf5;
            border: 1px solid #34d399;
            color: #065f46;
            font-size: 8.5px;
            font-weight: 900;
            padding: 4px 10px;
            border-radius: 12px;
            text-transform: uppercase;
            box-shadow: inset 0 2px 3px rgba(255,255,255,0.6), 0 2px 2px rgba(0,0,0,0.1); /* Metallic effect */
        }

        /* PREMIUM INTEGRATED FOOTER */
        .card-footer-integrated {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #064e3b;
            padding: 6px 0;
            border-top: 1px solid #fde68a; /* Gold Border */
        }

        .footer-text-premium {
            font-size: 7px;
            color: #ffffff;
            font-weight: 700;
            margin: 0;
            letter-spacing: 2px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

    {{-- Kita chunk 9 data per Halaman (3 baris x 3 kolom) --}}
    @foreach($panitias->chunk(9) as $pageData)
        <table class="grid-table">
            
            {{-- Tiap halaman di-chunk 3 untuk per baris (<tr>) --}}
            @foreach($pageData->chunk(3) as $rowData)
                <tr>
                    @foreach($rowData as $p)
                        <td class="grid-td">
                            <div class="id-card">
                                
                                <div class="card-header-integrated">
                                    <div class="gold-accent-header"></div>
                                    
                                    {{-- Mengambil logo secara spesifik dari storage atau public --}}
                                    @php
                                        $logoPath = file_exists(public_path('storage/logo.png')) 
                                            ? public_path('storage/logo.png') 
                                            : (file_exists(public_path('logo.png')) ? public_path('logo.png') : null);
                                    @endphp

                                    @if($logoPath)
                                        <img src="{{ $logoPath }}" class="logo-masjid">
                                    @else
                                        <div style="font-size: 22px; color: #fde68a; margin-bottom: 2px; position: relative; z-index: 10;">⚔️🕌</div>
                                    @endif
                                    
                                    <p class="header-title">PANITIA QURBAN TAHUN {{ $tahun }}</p>
                                    <h1 class="masjid-name-premium">{{ $settings['masjid_name'] ?? 'Masjid Sultan Qurban' }}</h1>
                                </div>
                                <div class="integrated-gold-flow"></div>
                                <div class="subtle-gold-flow"></div>

                                <div class="photo-area-integrated">
                                    @php 
                                        $photoPath = $p->warga->path_img && file_exists(public_path('storage/'.$p->warga->path_img)) 
                                            ? public_path('storage/'.$p->warga->path_img) 
                                            : 'https://ui-avatars.com/api/?name='.urlencode($p->warga->nama).'&background=10b981&color=fff&size=150';
                                    @endphp
                                    <img src="{{ $photoPath }}" class="photo-circle-premium">
                                </div>

                                <div class="details-area-integrated">
                                    <h2 class="panitia-name-premium">{{ $p->warga->nama }}</h2>
                                    
                                    <div class="jabatan-badge-metallic">
                                        {{ $p->jabatan }}
                                    </div>
                                </div>

                                <div class="card-footer-integrated">
                                    <p class="footer-text-premium">OFFICIAL CREW</p>
                                </div>

                            </div>
                        </td>
                    @endforeach

                    {{-- Inject <td> kosong jika sisa data kurang dari 3 di baris terakhir --}}
                    @for($i = $rowData->count(); $i < 3; $i++)
                        <td class="grid-td"></td>
                    @endfor
                </tr>
            @endforeach
            
        </table>

        {{-- Page Break tiap 9 kartu --}}
        @if(!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

</body>
</html>