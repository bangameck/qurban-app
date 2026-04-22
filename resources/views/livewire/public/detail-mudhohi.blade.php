<div class="w-full max-w-7xl mx-auto font-sans relative flex flex-col">
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <div class="lg:col-span-5 relative space-y-6">
            
            <div class="relative">
                <div class="absolute -top-4 inset-x-0 flex justify-center z-20">
                    <span class="px-4 py-1.5 bg-emerald-500 text-white text-[10px] font-black uppercase tracking-widest rounded-full shadow-lg border-2 border-white flex items-center gap-1.5 animate-bounce">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        Pendaftaran Berhasil
                    </span>
                </div>

                <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-primary-900/10 overflow-hidden border border-white relative mt-2 print:shadow-none print:bg-white print:border-gray-200">
                    <div class="px-8 pt-12 pb-24 relative text-center overflow-hidden" style="background-color: var(--color-primary-600);">
                        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.8) 1px, transparent 0); background-size: 24px 24px;"></div>
                        <h1 class="text-white text-lg font-black tracking-widest uppercase opacity-95 relative z-10">Tanda Terima & Kupon</h1>
                        <p class="text-white/80 text-[10px] uppercase font-bold tracking-widest mt-1 relative z-10">{{ $appName }} • Qurban {{ $mudhohi->tahun }}</p>
                        <div class="absolute -bottom-1 inset-x-0">
                            <svg viewBox="0 0 1440 120" fill="none" class="w-full h-12 text-white/80 backdrop-blur-md" preserveAspectRatio="none"><path d="M0,120L48,114.7C96,109,192,99,288,85.3C384,72,480,56,576,58.7C672,61,768,80,864,85.3C960,91,1056,83,1152,74.7C1248,67,1344,59,1392,54.7L1440,49.3L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z" fill="currentColor"></path></svg>
                        </div>
                    </div>

                    <div class="px-6 sm:px-8 pb-10 relative z-10 text-center">
                        <div class="flex justify-center -mt-16 mb-4 relative z-20">
                            <div class="w-24 h-24 rounded-full border-4 border-white shadow-xl bg-white overflow-hidden">
                                <img src="{{ $mudhohi->warga->path_img ? asset('storage/'.$mudhohi->warga->path_img) : 'https://ui-avatars.com/api/?name='.urlencode($mudhohi->warga->nama).'&background=random' }}" class="w-full h-full object-cover">
                            </div>
                        </div>

                        <div class="mb-6">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Shohibul Qurban:</p>
                            <h2 class="text-2xl font-black text-gray-900 leading-tight mb-1">{{ $mudhohi->warga->nama }}</h2>
                            <p class="text-xs font-mono text-gray-500 font-bold">{{ $mudhohi->warga->nik }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-[2rem] p-5 border border-gray-100 mb-6 relative overflow-hidden shadow-inner">
                            <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest mb-3">Kupon Jatah Daging (1/3)</p>
                            <div class="bg-white p-3 rounded-2xl shadow-sm inline-block border-2 border-blue-100 mb-2">
                                @if($mudhohi->path_qr_code)
                                    <img src="{{ asset('storage/'.$mudhohi->path_qr_code) }}" alt="QR Code Kupon" class="w-32 h-32 object-contain">
                                @else
                                    <div class="w-32 h-32 bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-400">NO QR</div>
                                @endif
                            </div>
                            <div>
                                <span class="inline-block px-4 py-1.5 bg-blue-100 text-blue-800 font-mono text-sm font-black tracking-widest rounded-lg border border-blue-200">
                                    {{ $mudhohi->kode_unik_kupon ?? 'MDH-XXXXX' }}
                                </span>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-5 border border-gray-200 mb-6 text-left shadow-sm">
                            <div class="flex items-center gap-2 mb-4 pb-3 border-b border-gray-100">
                                <svg class="w-4 h-4" style="color: var(--color-primary-500);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                <h3 class="text-xs font-black text-gray-800 uppercase tracking-wide">Rincian Qurban</h3>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-[11px] font-bold text-gray-500">Tipe Qurban</span>
                                    <span class="text-[11px] font-black px-2 py-0.5 rounded bg-gray-100 text-gray-700 uppercase">{{ $mudhohi->tipe_qurban }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-[11px] font-bold text-gray-500">Grup</span>
                                    <span class="text-[11px] font-black text-gray-800">{{ $mudhohi->kelompokSapi->nama_kelompok ?? 'Menunggu Alokasi' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-[11px] font-bold text-gray-500">Hewan</span>
                                    <div class="text-right">
                                        @if($mudhohi->kelompokSapi && $mudhohi->kelompokSapi->sapi)
                                            <span class="text-[11px] font-black" style="color: var(--color-primary-600);">Sapi {{ $mudhohi->kelompokSapi->sapi->kode_sapi }}</span>
                                        @else
                                            <span class="text-[10px] font-black text-amber-500 bg-amber-50 px-2 py-0.5 rounded">Belum Ditentukan</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('mudhohi.sertifikat', $mudhohi->id) }}" target="_blank" class="print:hidden w-full px-6 py-3.5 text-white font-black rounded-2xl shadow-lg shadow-primary-900/20 transition transform hover:-translate-y-1 flex items-center justify-center gap-2" style="background-color: var(--color-primary-600);">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Unduh / Cetak Sertifikat
                        </a>
                    </div>
                </div>
            </div>

            @if($mudhohi->kelompokSapi && $mudhohi->kelompokSapi->sapi)
            <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-xl shadow-primary-900/10 border border-white p-6 sm:p-8 relative overflow-hidden print:hidden">
                <div class="flex items-center justify-between mb-5 border-b border-gray-100 pb-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-xl text-white shadow-sm" style="background-color: var(--color-primary-500);">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                        </div>
                        <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Informasi Hewan</h3>
                    </div>
                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[9px] font-black uppercase tracking-widest rounded-full border border-emerald-100">Teralokasi</span>
                </div>

                <div class="flex items-center gap-5">
                    @php $sapi = $mudhohi->kelompokSapi->sapi; @endphp
                    <div class="w-24 h-24 rounded-2xl bg-gray-100 overflow-hidden shadow-inner border border-gray-200 shrink-0">
                        @if($sapi->path_foto_sapi)
                            <img src="{{ asset('storage/'.$sapi->path_foto_sapi) }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-4xl">🐄</div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-3xl font-black text-gray-900 leading-none mb-1 font-mono tracking-tight">{{ $sapi->kode_sapi }}</h4>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ $sapi->jenis_sapi ?? 'Sapi Qurban' }} • {{ $sapi->berat ? $sapi->berat.' Kg' : 'TBA' }}</p>
                        <div class="mt-3">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[9px] font-black uppercase tracking-widest rounded-lg border 
                                {{ $sapi->status_proses == 'Selesai' ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 
                                  (in_array($sapi->status_proses, ['Disembelih', 'Dikuliti']) ? 'bg-amber-50 text-amber-600 border-amber-200 animate-pulse' : 'bg-gray-50 text-gray-500 border-gray-200') }}">
                                <div class="w-1.5 h-1.5 rounded-full {{ $sapi->status_proses == 'Selesai' ? 'bg-emerald-500' : (in_array($sapi->status_proses, ['Disembelih', 'Dikuliti']) ? 'bg-amber-500' : 'bg-gray-400') }}"></div>
                                Status: {{ $sapi->status_proses ?? 'Menunggu' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($mudhohi->path_bukti_pendaftaran)
            <div x-data="{ openProof: false }" class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-xl shadow-primary-900/10 border border-white p-6 sm:p-8 relative overflow-hidden print:hidden">
                <div class="flex items-center justify-between mb-5 border-b border-gray-100 pb-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-xl text-white shadow-sm" style="background-color: var(--color-primary-500);">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Bukti Pembayaran</h3>
                    </div>
                </div>

                <div class="relative group cursor-zoom-in rounded-2xl overflow-hidden border-2 border-gray-200 shadow-sm" @click="openProof = true">
                    <img src="{{ asset('storage/'.$mudhohi->path_bukti_pendaftaran) }}" class="w-full h-48 object-cover transition-transform duration-700 group-hover:scale-105 filter grayscale-[10%] group-hover:grayscale-0" alt="Bukti Transfer">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-sm">
                        <span class="px-5 py-2.5 bg-white/20 text-white text-[10px] font-black uppercase tracking-widest rounded-full border border-white/50 shadow-lg flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                            Klik untuk Perbesar
                        </span>
                    </div>
                </div>

                <div x-show="openProof" x-transition.opacity class="fixed inset-0 z-[100] bg-black/95 flex items-center justify-center p-4 md:p-10 backdrop-blur-md" style="display: none;">
                    <div @click.away="openProof = false" class="relative max-w-2xl w-full mx-auto">
                        <button @click="openProof = false" class="absolute -top-12 right-0 text-white/70 hover:text-white transition-colors bg-white/10 p-2 rounded-full hover:bg-white/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                        <img src="{{ asset('storage/'.$mudhohi->path_bukti_pendaftaran) }}" class="w-full rounded-2xl shadow-2xl border border-white/10">
                    </div>
                </div>
            </div>
            @endif

        </div>

        <div class="lg:col-span-7 h-full">
            <div class="sticky top-28 bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-primary-900/10 overflow-hidden border border-white flex flex-col h-[600px] lg:h-[800px] print:hidden">
                <div class="p-5 bg-gray-50/80 border-b border-gray-100 flex justify-between items-center backdrop-blur-md">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-xl bg-amber-100 text-amber-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-black text-gray-800 text-sm tracking-wide uppercase">Sertifikat Qurban</h3>
                            <p class="text-[10px] font-bold text-gray-400 mt-0.5">Dokumen Resmi Kepanitiaan</p>
                        </div>
                    </div>
                </div>

                <div class="flex-grow bg-gray-200/50 p-4 md:p-6 relative">
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-gray-400 z-0">
                        <svg class="animate-spin w-8 h-8 mb-3" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        <p class="text-xs font-bold uppercase tracking-widest animate-pulse">Memuat Sertifikat...</p>
                    </div>
                    <iframe src="{{ route('mudhohi.sertifikat', $mudhohi->id) }}#toolbar=0" class="w-full h-full rounded-2xl shadow-inner border border-gray-300 relative z-10 bg-white" title="Sertifikat Qurban"></iframe>
                </div>
            </div>
        </div>

    </div>
    
    <style>
        @media print {
            body { background: white !important; }
            .bg-gray-50 { background-color: transparent !important; }
            .shadow-2xl { box-shadow: none !important; }
            .print\:hidden { display: none !important; }
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        }
    </style>
</div>