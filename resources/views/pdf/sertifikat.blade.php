<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat Qurban - {{ $mudhohi->warga->nama }}</title>
    <style>
        /* Mendaftarkan Font Lokal */
        @font-face {
            font-family: 'El Messiri';
            src: url('{{ public_path('assets/fonts/el_messiri/ElMessiri-Regular.ttf') }}') format('truetype');
            font-weight: normal; 
            font-style: normal;
        }
        @font-face {
            font-family: 'El Messiri';
            src: url('{{ public_path('assets/fonts/el_messiri/ElMessiri-Bold.ttf') }}') format('truetype');
            font-weight: bold; 
            font-style: normal;
        }

        /* Set Kertas A4 Landscape tanpa margin */
        @page {
            size: A4 landscape;
            margin: 0;
        }
        
        body {
            font-family: 'El Messiri', sans-serif;
            margin: 0;
            padding: 0;
            color: #1f2937;
            background-color: #fdfbf7; 
        }

        /* Bingkai */
        .bingkai-luar {
            position: absolute;
            top: 25px; /* Margin kertas dikurangi biar lega */
            bottom: 25px; 
            left: 25px; 
            right: 25px;
            border: 6px solid #b48600; 
            padding: 0;
        }
        
        .bingkai-dalam {
            position: absolute;
            top: 5px; 
            bottom: 5px; 
            left: 5px; 
            right: 5px;
            border: 2px solid #d4af37; 
            text-align: center;
            padding-top: 25px; /* Padding atas dipepetin */
        }

        /* Tipografi */
        .judul-sertifikat {
            font-size: 36px; /* Dikecilin 2px */
            font-weight: bold;
            color: #b48600;
            text-transform: uppercase;
            letter-spacing: 4px;
            margin: 0 0 5px 0;
        }

        .sub-judul {
            font-size: 14px;
            font-weight: normal;
            color: #4b5563;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin: 0 0 15px 0; /* Margin bawah dikurangi */
            border-bottom: 1px solid #d1d5db;
            display: inline-block;
            padding-bottom: 5px;
        }

        .teks-pengantar {
            font-size: 15px;
            color: #4b5563;
            margin: 0 0 2px 0;
        }

        .nama-mudhohi {
            font-size: 40px; /* Dikecilin 2px */
            font-weight: bold;
            color: #111827;
            margin: 0 0 10px 0; /* Margin atas bawah dipepetin */
            text-decoration: underline;
            text-decoration-color: #b48600;
        }

        .teks-deskripsi {
            font-size: 17px; /* Dikecilin 1px */
            color: #374151;
            margin: 5px auto 10px auto;
            line-height: 1.4;
            width: 90%; 
            text-align: center;
        }

        /* Area Tanda Tangan */
        .tabel-ttd {
            width: 90%;
            margin: 5px auto 0 auto; /* Dipepetin ke atas */
            border: none;
        }
        .tabel-ttd td {
            text-align: center;
            vertical-align: bottom;
            border: none;
            width: 33%;
        }
        .jabatan {
            font-size: 13px; /* Dikecilin 1px */
            color: #4b5563;
            margin: 0 0 2px 0; 
        }
        .lokasi-tanggal {
            font-size: 13px;
            color: #111827;
            margin-bottom: 5px;
        }
        .nama-pejabat {
            font-size: 15px;
            font-weight: bold;
            text-decoration: underline;
            margin: 0;
            color: #111827;
        }
        
        /* KUNCIAN GAMBAR TTD BIAR GAK NGEMBANG */
        .ttd-box {
            height: 65px; 
            width: 100%;
            margin: 5px 0;
            overflow: hidden; /* Potong kalau kebesaran */
        }
        .ttd-img {
            height: 65px; /* Kunci tinggi maksimal */
            width: auto;
        }
    </style>
</head>
<body>

    <div class="bingkai-luar">
        <div class="bingkai-dalam">
            
            <h1 class="judul-sertifikat">Tanda Terima Qurban</h1>
            <p class="sub-judul">{{ $settings['app_name'] ?? 'Panitia Qurban' }} • Tahun {{ $mudhohi->tahun }}</p>

            <p class="teks-pengantar">Jazakumullah Khairan Katsiran Kepada:</p>
            <h2 class="nama-mudhohi">{{ $mudhohi->warga->nama }}</h2>
            
            <div class="teks-deskripsi">
                Telah terdaftar dan menyerahkan niat ibadah qurban (<strong>{{ $mudhohi->tipe_qurban }}</strong>) pada tahun {{ $mudhohi->tahun }}. 
                
                @if($mudhohi->kelompokSapi && $mudhohi->kelompokSapi->sapi)
                    Beliau tergabung dalam kelompok <strong>{{ $mudhohi->kelompokSapi->nama_kelompok }}</strong> dengan alokasi hewan <strong>Sapi {{ $mudhohi->kelompokSapi->sapi->kode_sapi }} ({{ $mudhohi->kelompokSapi->sapi->berat }} Kg)</strong>.
                @else
                    Beliau tergabung dalam kelompok <strong>{{ $mudhohi->kelompokSapi->nama_kelompok ?? 'Reguler' }}</strong> dan saat ini masih menunggu alokasi hewan qurban dari panitia.
                @endif
                
                Semoga Allah Subhanahu Wa Ta'ala menerima amal ibadah qurban ini, mengampuni dosa-dosa kita, dan menjadikannya sebagai kendaraan yang tangguh di Yaumil Akhir kelak. Aamiin.
            </div>

            <table class="tabel-ttd">
                <tr>
                    <td>
                        <p class="jabatan">Mengetahui,</p>
                        <p class="jabatan"><strong>Ketua DKM / Masjid</strong></p>
                        
                        <div class="ttd-box">
                            @if(!empty($settings['ttd_masjid']) && file_exists(public_path('storage/'.$settings['ttd_masjid'])))
                                @php $imgMasjid = base64_encode(file_get_contents(public_path('storage/'.$settings['ttd_masjid']))); @endphp
                                <img src="data:image/png;base64,{{ $imgMasjid }}" class="ttd-img">
                            @endif
                        </div>
                        
                        <p class="nama-pejabat">{{ $settings['nama_ketua_masjid'] ?? '...........................' }}</p>
                    </td>

                    <td></td>

                    <td>
                        <p class="lokasi-tanggal">Pekanbaru, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                        <p class="jabatan">Mengesahkan,</p>
                        <p class="jabatan"><strong>Ketua Panitia Qurban</strong></p>
                        
                        <div class="ttd-box">
                            @if(!empty($settings['ttd_panitia']) && file_exists(public_path('storage/'.$settings['ttd_panitia'])))
                                @php $imgPanitia = base64_encode(file_get_contents(public_path('storage/'.$settings['ttd_panitia']))); @endphp
                                <img src="data:image/png;base64,{{ $imgPanitia }}" class="ttd-img">
                            @endif
                        </div>
                        
                        <p class="nama-pejabat">{{ $settings['nama_ketua_panitia'] ?? '...........................' }}</p>
                    </td>
                </tr>
            </table>

        </div>
    </div>

</body>
</html>