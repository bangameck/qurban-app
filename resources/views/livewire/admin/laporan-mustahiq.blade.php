<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-emerald-100 text-emerald-700 rounded-xl shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 tracking-wide">Laporan & Cetak Kupon {{ $tahun_aktif }}</h2>
                <p class="text-sm text-gray-500 mt-1">Rekapitulasi pembagian daging per Sesi / RT dan cetak kupon massal.</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-8 flex items-center gap-3 relative z-0">
        <svg class="w-5 h-5 text-gray-400 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        <input wire:model.live.debounce.300ms="search" type="text" class="w-full bg-transparent border-none focus:ring-0 text-gray-700 placeholder-gray-400" placeholder="Cari Nama Sesi (RT) atau Nama Warga...">
    </div>

    <div class="space-y-6">
        @forelse ($sesis as $sesi)
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 border-b border-gray-100 p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-1">
                            <h3 class="text-xl font-black text-gray-800">{{ $sesi->nama_sesi }}</h3>
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase rounded-lg">
                                {{ $sesi->mustahiqs->count() }} Penerima
                            </span>
                        </div>
                        <p class="text-xs font-bold text-gray-500 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Jadwal Ambil: {{ \Carbon\Carbon::parse($sesi->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($sesi->jam_selesai)->format('H:i') }} WIB
                        </p>
                    </div>
                    
                    @if($sesi->mustahiqs->count() > 0)
                        <a href="{{ route('admin.cetak_kupon_sesi', $sesi->id) }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-emerald-900/20 transition transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Cetak Kupon PDF Sesi Ini
                        </a>
                    @endif
                </div>

                <div class="p-6">
                    @if($sesi->mustahiqs->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($sesi->mustahiqs as $index => $mustahiq)
                                <a href="{{ route('kupon.detail', $mustahiq->kode_unik_kupon) }}" target="_blank" class="flex items-center gap-3 p-3 rounded-2xl border border-gray-100 hover:border-emerald-300 hover:bg-emerald-50 transition group">
                                    <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 group-hover:bg-emerald-200 group-hover:text-emerald-700 flex items-center justify-center font-black text-xs shrink-0">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-gray-800 truncate group-hover:text-emerald-700">{{ $mustahiq->warga->nama }}</p>
                                        <p class="text-[10px] text-gray-500 font-mono truncate">{{ $mustahiq->kode_unik_kupon }}</p>
                                    </div>
                                    @if($mustahiq->status_pengambilan == 'Sudah')
                                        <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6 text-gray-400 font-bold text-sm">
                            Belum ada penerima di sesi ini.
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-16 bg-white rounded-3xl border-2 border-dashed border-gray-200">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <p class="text-gray-500 font-bold text-lg">Tidak ada data ditemukan.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $sesis->links() }}
    </div>
</div>