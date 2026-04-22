<div class="max-w-6xl mx-auto w-full">
    
    <div class="text-center mb-12 relative z-10">
        <div class="inline-flex items-center justify-center p-3 rounded-2xl shadow-sm mb-4" style="background-color: var(--color-primary-100); color: var(--color-primary-700);">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
        <h2 class="text-3xl md:text-5xl font-black text-gray-900 tracking-tight mb-4">Daftar Shohibul Qurban</h2>
        <p class="text-gray-500 font-medium max-w-2xl mx-auto mb-10 text-lg">Berikut adalah daftar warga jamaah yang telah terdaftar sebagai peserta Qurban untuk pelaksanaan tahun {{ $tahun_aktif }}.</p>
        
        <div class="relative max-w-2xl mx-auto">
            <input wire:model.live.debounce.300ms="search" type="text" 
                class="w-full px-6 py-4 pl-14 rounded-full border-2 border-transparent bg-white shadow-[0_10px_40px_rgba(0,0,0,0.05)] focus:outline-none focus:bg-white transition-all text-gray-700 font-bold" 
                style="--tw-ring-color: var(--color-primary-500); focus:border-color: var(--color-primary-500);"
                placeholder="Cari nama peserta atau kelompok sapi...">
            <div class="absolute left-5 top-1/2 -translate-y-1/2 opacity-50" style="color: var(--color-primary-700);">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            
            <div wire:loading wire:target="search" class="absolute right-5 top-1/2 -translate-y-1/2">
                <svg class="animate-spin h-5 w-5" style="color: var(--color-primary-600);" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($kelompoks as $kelompok)
            <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden flex flex-col h-full hover:-translate-y-1 transition-transform duration-300">
                
                <div class="p-6 relative overflow-hidden" style="background: linear-gradient(135deg, var(--color-primary-50) 0%, var(--color-primary-100) 100%); border-bottom: 1px solid var(--color-primary-200);">
                    <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full opacity-30" style="background-color: var(--color-primary-300);"></div>
                    <div class="absolute -left-10 -bottom-10 w-32 h-32 rounded-full opacity-20" style="background-color: var(--color-primary-400);"></div>
                    
                    <div class="flex justify-between items-start relative z-10">
                        <div>
                            <h3 class="text-2xl font-black text-gray-800">{{ $kelompok->nama_kelompok }}</h3>
                            <p class="text-xs font-bold mt-1 uppercase tracking-widest" style="color: var(--color-primary-700);">
                                <span class="inline-block w-2 h-2 rounded-full mr-1 animate-pulse" style="background-color: var(--color-primary-500);"></span>
                                {{ count($kelompok->mudhohis) }} Peserta Terdaftar
                            </p>
                        </div>
                        @if($kelompok->sapi)
                            <div class="text-right shrink-0">
                                <span class="inline-flex items-center justify-center px-4 py-1.5 rounded-full text-xs font-black tracking-widest shadow-sm bg-white" style="color: var(--color-primary-700); border: 2px solid var(--color-primary-200);">
                                    SAPI {{ $kelompok->sapi->kode_sapi }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="p-6 flex-1 bg-white">
                    <ul class="space-y-3">
                        @php 
                            $isIndividu = $kelompok->mudhohis->first()?->tipe_qurban === 'Individu';
                            $maxSlots = $isIndividu ? 1 : 7; 
                        @endphp

                        @for ($i = 0; $i < $maxSlots; $i++)
                            @php $mudhohi = $kelompok->mudhohis->get($i); @endphp
                            
                            <li class="flex items-center gap-4 p-3 rounded-2xl transition-colors {{ $mudhohi ? 'bg-gray-50 border border-gray-100' : 'border-2 border-dashed border-gray-200 opacity-60 bg-white' }}">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-black shrink-0 shadow-inner" 
                                     style="background-color: {{ $mudhohi ? 'var(--color-primary-100)' : '#f3f4f6' }}; color: {{ $mudhohi ? 'var(--color-primary-700)' : '#9ca3af' }};">
                                    {{ $i + 1 }}
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    @if($mudhohi)
                                        <a wire:navigate href="{{ route('mudhohi.detail', $mudhohi->id) }}" class="block text-base font-bold text-gray-800 truncate hover:underline transition-colors" style="hover:color: var(--color-primary-600);">
                                            {{ $mudhohi->warga->nama }}
                                        </a>
                                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-0.5">Warga Terdaftar</p>
                                    @else
                                        <p class="text-sm font-bold text-gray-400 italic">Slot Tersedia</p>
                                        <p class="text-[10px] font-medium text-gray-400 mt-0.5">Menunggu peserta</p>
                                    @endif
                                </div>

                                @if($mudhohi)
                                    <div class="shrink-0" style="color: var(--color-primary-500);">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                @endif
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
        @empty
            @if($mandiri->isEmpty())
            <div class="col-span-full py-16 text-center bg-white rounded-[2rem] shadow-sm border border-gray-100">
                <div class="w-20 h-20 mx-auto bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </div>
                <h3 class="text-xl font-black text-gray-800">Tidak Ada Data Ditemukan</h3>
                <p class="text-gray-500 mt-2">Data pendaftar qurban tidak tersedia atau tidak sesuai dengan pencarian.</p>
            </div>
            @endif
        @endforelse
    </div>

    @if($mandiri->count() > 0)
        <div class="mt-16 mb-8 text-center">
            <h3 class="inline-block px-6 py-2 rounded-full text-sm font-black uppercase tracking-widest shadow-sm border border-gray-200 bg-white text-gray-700">Qurban Kambing / Individu</h3>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($mandiri as $m)
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center text-2xl shadow-inner shrink-0" style="background-color: var(--color-primary-50);">
                        🐐
                    </div>
                    <div class="flex-1 min-w-0">
                        <a wire:navigate href="{{ route('mudhohi.detail', $m->id) }}" class="block text-sm font-black text-gray-800 truncate hover:underline transition-colors" style="hover:color: var(--color-primary-600);">
                            {{ $m->warga->nama }}
                        </a>
                        <p class="text-[10px] font-bold uppercase tracking-widest mt-1" style="color: var(--color-primary-600);">Qurban {{ $m->tipe_qurban }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>