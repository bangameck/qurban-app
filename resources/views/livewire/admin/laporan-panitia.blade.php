<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-rose-100 text-rose-700 rounded-xl shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 tracking-wide">Laporan Struktur Panitia {{ $tahun_aktif }}</h2>
                <p class="text-sm text-gray-500 mt-1">Hierarki kepanitiaan dan jatah kupon operasional.</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.cetak_kupon_panitia') }}" target="_blank" class="px-5 py-2.5 bg-rose-50 text-rose-600 font-bold rounded-xl border border-rose-200 hover:bg-rose-100 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 14a3 3 0 10-6 0m6 0a3 3 0 10-6 0m6 0v4a2 2 0 01-2 2H9a2 2 0 01-2-2v-4m14-3a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h14a2 2 0 002-2v-6z"></path></svg>
                Cetak Kupon Panitia
            </a>
            
            <a href="{{ route('admin.cetak_idcard_panitia') }}" target="_blank" class="px-5 py-2.5 text-white font-bold rounded-xl shadow-lg transition transform hover:-translate-y-0.5 flex items-center gap-2" style="background-color: var(--color-primary-600);">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                Cetak ID Card Panitia
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-8 flex items-center gap-3">
        <input wire:model.live.debounce.300ms="search" type="text" class="w-full bg-transparent border-none focus:ring-0 text-gray-700 font-bold" placeholder="Cari nama panitia...">
    </div>

    <div class="grid grid-cols-1 gap-8">
        
        <div class="space-y-4">
            <h3 class="text-sm font-black text-gray-400 uppercase tracking-widest ml-1">Struktur Inti & Operasional</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($corePanitia as $p)
                    <div class="bg-white p-4 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-4">
                        <img src="{{ $p->warga->path_img ? asset('storage/'.$p->warga->path_img) : 'https://ui-avatars.com/api/?name='.urlencode($p->warga->nama) }}" class="w-12 h-12 rounded-2xl object-cover border border-gray-100">
                        <div class="flex-1 min-w-0">
                            <p class="text-[10px] font-black text-rose-600 uppercase">{{ $p->jabatan }}</p>
                            <p class="text-sm font-bold text-gray-800 truncate">{{ $p->warga->nama }}</p>
                        </div>
                        <div class="shrink-0 text-right">
                            <p class="text-[9px] font-mono font-bold text-gray-400">{{ $p->kode_unik_kupon }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="space-y-6">
            <h3 class="text-sm font-black text-gray-400 uppercase tracking-widest ml-1">Tim Kelompok Sapi</h3>
            @foreach($kelompoks as $klp)
                <div class="bg-white rounded-[2rem] border border-gray-100 overflow-hidden shadow-sm">
                    <div class="bg-rose-50/50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h4 class="font-black text-gray-700">{{ $klp->nama_kelompok }}</h4>
                        <span class="text-[10px] font-bold text-rose-600 bg-white px-3 py-1 rounded-full border border-rose-100 uppercase">Sapi: {{ $klp->sapi->kode_sapi ?? '-' }}</span>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($groupPanitia[$klp->id] as $p)
                            <div class="flex items-center gap-3 p-3 rounded-2xl border border-gray-50 bg-gray-50/30">
                                <div class="w-8 h-8 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center font-black text-[10px]">
                                    {{ $p->jabatan == 'Ketua Kelompok Qurban' ? 'KT' : 'AG' }}
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs font-bold text-gray-800">{{ $p->warga->nama }}</p>
                                    <p class="text-[9px] text-gray-400 font-bold uppercase">{{ $p->jabatan }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>