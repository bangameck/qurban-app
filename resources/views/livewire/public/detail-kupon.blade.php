<div class="relative z-10 w-full max-w-md mx-auto py-10">
    <div class="mb-6 flex justify-center">
        <div class="px-4 py-2 bg-white/20 backdrop-blur-md rounded-full text-white text-sm font-bold shadow-sm border border-white/30 flex items-center gap-2" style="background-color: var(--color-primary-600);">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Kupon Digital Qurban
        </div>
    </div>

    <div class="bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-gray-100 relative">
        
        <div class="relative h-32 p-6 flex flex-col justify-between overflow-hidden" style="background-color: var(--color-primary-600);">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 20px 20px;"></div>
            
            <div class="relative z-10 flex justify-between items-start text-white">
                <div>
                    <p class="text-xs font-bold opacity-80 uppercase tracking-widest mb-1">Kode Tiket</p>
                    <h2 class="text-2xl font-black font-mono tracking-widest drop-shadow-md">{{ $mustahiq->kode_unik_kupon }}</h2>
                </div>
                @if($mustahiq->status_pengambilan == 'Sudah')
                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md border border-white/50 text-white text-[10px] font-black uppercase rounded-lg shadow-sm">Sudah Diambil</span>
                @else
                    <span class="px-3 py-1 bg-amber-400 text-amber-900 border border-amber-300 text-[10px] font-black uppercase rounded-lg shadow-sm animate-pulse">Belum Diambil</span>
                @endif
            </div>
        </div>

        <div class="relative flex justify-between items-center -mt-4 z-20">
            <div class="w-8 h-8 bg-gray-50 rounded-full -ml-4 shadow-inner"></div>
            <div class="flex-1 border-t-2 border-dashed border-gray-200 mx-2"></div>
            <div class="w-8 h-8 bg-gray-50 rounded-full -mr-4 shadow-inner"></div>
        </div>

        <div class="px-8 pb-8 pt-2">
            <div class="flex flex-col items-center justify-center -mt-16 mb-6 relative z-30">
                <img src="{{ $mustahiq->warga->path_img ? asset('storage/'.$mustahiq->warga->path_img) : 'https://ui-avatars.com/api/?name='.urlencode($mustahiq->warga->nama).'&background=random' }}" class="w-24 h-24 rounded-2xl object-cover border-4 border-white shadow-lg bg-white">
                <h3 class="text-xl font-black text-gray-800 mt-3 text-center">{{ $mustahiq->warga->nama }}</h3>
                <p class="text-xs text-gray-400 font-mono mt-1">NIK: {{ substr($mustahiq->warga->nik, 0, 10) }}******</p>
            </div>

            <div class="flex justify-center mb-6">
                <div class="p-3 bg-white border-2 border-dashed border-gray-200 rounded-2xl shadow-sm relative group">
                    @if($mustahiq->status_pengambilan == 'Sudah')
                        <div class="absolute inset-0 bg-white/80 backdrop-blur-[2px] z-10 flex items-center justify-center rounded-2xl">
                            <div class="bg-emerald-100 text-emerald-700 p-2 rounded-full border border-emerald-200 shadow-sm transform -rotate-12">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                    @endif
                    <img src="{{ asset('storage/'.$mustahiq->path_qr_code) }}" class="w-48 h-48">
                </div>
            </div>

            <p class="text-center text-[10px] text-gray-400 uppercase font-bold mb-6">Tunjukkan QR Code ini kepada panitia</p>

            <div class="bg-primary-50 rounded-2xl p-4 border border-primary-100 mb-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-white text-primary-700 flex items-center justify-center shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-primary-400 uppercase">Jadwal Pengambilan</p>
                        <p class="font-black text-gray-800 leading-none">{{ $mustahiq->sesiDistribusi->nama_sesi }}</p>
                        <p class="text-xs font-bold text-primary-600 mt-1">{{ \Carbon\Carbon::parse($mustahiq->sesiDistribusi->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($mustahiq->sesiDistribusi->jam_selesai)->format('H:i') }} WIB</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100 mb-6">
                <p class="text-[10px] font-bold text-gray-400 uppercase mb-3 tracking-widest text-center">Data Wilayah Penerima</p>
                
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="mt-1 text-primary-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Alamat Lengkap</p>
                            <p class="text-sm font-bold text-gray-800 leading-relaxed">{{ $mustahiq->warga->alamat }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 border-t border-gray-100 pt-3 mt-4">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase">RT / RW</p>
                            <p class="text-sm font-bold text-gray-800">
                                RT {{ $mustahiq->warga->rt->nama_rt ?? '-' }} / 
                                RW {{ $mustahiq->warga->rt->rw->nama_rw ?? '-' }}
                            </p>
                        </div>
                        <div>
                            <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Penanggung Jawab</p>
                            <div class="flex items-center gap-1.5 mt-0.5">
                                <svg class="w-3 h-3 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                <p class="text-sm font-bold text-primary-700">Bpk. {{ $pejabatRT }}</p>
                            </div>
                        </div>
                        </div>
                        <div class="border-t border-gray-100 pt-3">
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Kelurahan</p>
                            <p class="text-sm font-bold text-gray-800">{{ $mustahiq->warga->rt->rw->kelurahan ?? '-' }}</p>
                        </div>
                        <div class="border-t border-gray-100 pt-3">
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Kecamatan</p>
                            <p class="text-sm font-bold text-gray-800">{{ $mustahiq->warga->rt->rw->kecamatan ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($mustahiq->kategori_penerima == 'Mudhohi' && $sapi)
            <div class="border-t border-dashed border-gray-200 pt-5">
                <p class="text-[10px] font-bold text-gray-400 uppercase mb-3 text-center">Informasi Hak Qurban (Shohibul Qurban)</p>
                <div class="flex items-center gap-3 bg-primary-50 p-3 rounded-xl border border-primary-100">
                    <div class="w-12 h-12 rounded-xl bg-white text-primary-700 flex flex-col items-center justify-center font-black shadow-sm">
                        <span class="text-xs">SAPI</span>
                    </div>
                    <div>
                        <p class="font-black text-gray-800 text-sm">{{ $sapi->kode_sapi }}</p>
                        <p class="text-xs text-gray-500">{{ $sapi->jenis_sapi }} • {{ $sapi->berat }} KG</p>
                        <p class="text-[9px] text-primary-600 font-bold uppercase mt-1">Status: {{ $sapi->status_proses }}</p>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>