<div class="relative w-full max-w-7xl mx-auto flex flex-col items-center justify-center font-sans mt-4">
    
    <main class="w-full flex flex-col items-center text-center px-4 sm:px-6 lg:px-8">
        
        <div class="inline-flex items-center gap-2 px-5 py-2 bg-white/80 backdrop-blur-md border border-gray-200/50 rounded-full text-xs font-black uppercase tracking-widest text-gray-600 mb-8 shadow-sm">
            <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
            Live Update Transparansi Qurban {{ $tahun_aktif }}
        </div>

        <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-gray-900 tracking-tight leading-[1.1] mb-6">
            Menebar Manfaat,<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r" style="background-image: linear-gradient(to right, var(--color-primary-500), var(--color-primary-800));">
                Meraih Berkah.
            </span>
        </h1>
        
        <p class="text-lg md:text-xl text-gray-600 font-medium max-w-2xl mb-12 leading-relaxed">
            Selamat datang di Portal Informasi Qurban. Pantau progres pemotongan hewan dan distribusi daging warga secara transparan dan real-time.
        </p>

        <div class="w-full max-w-5xl bg-white/70 backdrop-blur-xl border border-white/50 rounded-[2.5rem] p-8 md:p-12 shadow-2xl shadow-primary-900/10 mb-16 relative overflow-hidden group hover:bg-white/90 transition-all duration-500">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-gradient-to-br from-primary-100 to-transparent rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
            
            <div class="grid grid-cols-2 md:grid-cols-5 gap-8 md:gap-4 divide-y md:divide-y-0 md:divide-x divide-gray-200/50 relative z-10">
                
                <div class="px-2 py-4 md:py-0 text-center">
                    <div class="flex items-center justify-center gap-2 mb-3">
                        <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                        </div>
                    </div>
                    <div class="text-4xl md:text-5xl font-black text-gray-800 mb-1">{{ $stats['total_sapi'] }}</div>
                    <div class="text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-widest">Sapi Terkumpul</div>
                </div>

                <div class="px-2 py-4 md:py-0 text-center">
                    <div class="flex items-center justify-center gap-2 mb-3">
                        <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                    <div class="text-4xl md:text-5xl font-black text-gray-800 mb-1">{{ $stats['total_mudhohi'] }}</div>
                    <div class="text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-widest">Warga Berqurban</div>
                </div>

                <div class="px-2 py-4 md:py-0 text-center">
                    <div class="flex items-center justify-center gap-2 mb-3">
                        <div class="p-2 bg-amber-100 text-amber-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                    </div>
                    <div class="text-4xl md:text-5xl font-black" style="color: var(--color-primary-600);">
                        {{ $stats['total_sapi'] > 0 ? round(($stats['sapi_disembelih'] / $stats['total_sapi']) * 100) : 0 }}%
                    </div>
                    <div class="text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-widest">Progress Pemotongan</div>
                </div>

                <div class="px-2 py-4 md:py-0 text-center">
                    <div class="flex items-center justify-center gap-2 mb-3">
                        <div class="p-2 bg-purple-100 text-purple-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                    <div class="text-4xl md:text-5xl font-black flex items-end justify-center gap-1" style="color: var(--color-primary-600);">
                        {{ $stats['kupon_scan'] }}
                        <span class="text-xl md:text-2xl text-gray-400 mb-1">/{{ $stats['kupon_total'] }}</span>
                    </div>
                    <div class="text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-widest mt-1">Kupon Disalurkan</div>
                </div>

                <div class="px-2 py-4 md:py-0 text-center col-span-2 md:col-span-1">
                    <div class="flex items-center justify-center gap-2 mb-3">
                        <div class="p-2 bg-teal-100 text-teal-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                    </div>
                    <div class="text-4xl md:text-5xl font-black" style="color: var(--color-primary-600);">
                        {{ $stats['kupon_total'] > 0 ? round(($stats['kupon_scan'] / $stats['kupon_total']) * 100) : 0 }}%
                    </div>
                    <div class="text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-widest">Progress Distribusi</div>
                </div>

            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-center gap-4 w-full px-4">
            <a href="{{ route('live.tv') }}" class="w-full sm:w-auto px-8 py-4 bg-gray-900 text-white font-bold rounded-2xl shadow-xl shadow-gray-900/20 hover:bg-black hover:-translate-y-1 transition transform flex items-center justify-center gap-3">
                <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Live Display Qurban
            </a>
        </div>

    </main>
</div>