<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-blue-100 text-blue-700 rounded-xl shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 tracking-wide">Laporan Mudhohi {{ $tahun_aktif }}</h2>
                <p class="text-sm text-gray-500 mt-1">Rekapitulasi peserta qurban per kelompok sapi dan cetak kupon jatah mudhohi.</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-8 flex items-center gap-3 relative z-0">
        <svg class="w-5 h-5 text-gray-400 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        <input wire:model.live.debounce.300ms="search" type="text" class="w-full bg-transparent border-none focus:ring-0 text-gray-700 placeholder-gray-400" placeholder="Cari Nama Kelompok atau Nama Mudhohi...">
    </div>

    <div class="space-y-6">
        @forelse ($kelompoks as $kelompok)
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-blue-50/50 border-b border-gray-100 p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-1">
                            <h3 class="text-xl font-black text-gray-800">{{ $kelompok->nama_kelompok }}</h3>
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-[10px] font-black uppercase rounded-lg">
                                {{ $kelompok->mudhohis->count() }} / 7 Peserta
                            </span>
                        </div>
                        <p class="text-xs font-bold text-gray-500 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            Hewan: {{ $kelompok->sapi->kode_sapi ?? 'Belum Alokasi' }} ({{ $kelompok->sapi->jenis_sapi ?? '-' }})
                        </p>
                    </div>
                    
                    @if($kelompok->mudhohis->count() > 0)
                        <a href="{{ route('admin.cetak_kupon_mudhohi', $kelompok->id) }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-blue-900/20 transition transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2 2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Cetak Kupon Shohibul Qurban
                        </a>
                    @endif
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($kelompok->mudhohis as $index => $mudhohi)
                            <a href="{{ route('mudhohi.detail', $mudhohi->id) }}" target="_blank" class="flex items-center gap-3 p-3 rounded-2xl border border-gray-100 hover:border-blue-300 hover:bg-blue-50 transition group">
                                <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 group-hover:bg-blue-200 group-hover:text-blue-700 flex items-center justify-center font-black text-xs shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-gray-800 truncate group-hover:text-blue-700">{{ $mudhohi->warga->nama }}</p>
                                    <p class="text-[10px] text-gray-500 font-mono truncate">{{ $mudhohi->kode_unik_kupon }}</p>
                                </div>
                                @if($mudhohi->status_pengambilan == 'Sudah')
                                    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16 bg-white rounded-3xl border-2 border-dashed border-gray-200 text-gray-400 font-bold">
                Tidak ada data kelompok ditemukan.
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $kelompoks->links() }}
    </div>
</div>