<div class="fixed inset-0 z-[9999] bg-gray-950 text-white overflow-hidden font-sans flex flex-col"
     wire:poll.2s="checkLiveEvents" 
     x-data="liveDisplayData()">

    <div class="h-24 bg-gray-900 border-b border-gray-800 flex items-center justify-between px-10 shadow-2xl relative z-20 shrink-0">
        <div class="flex items-center gap-5">
            @if(isset($settings['logo']) && file_exists(public_path('storage/'.$settings['logo'])))
                <img src="{{ asset('storage/'.$settings['logo']) }}" class="w-14 h-14 object-contain">
            @else
                <div class="text-4xl">🕌</div>
            @endif
            <div>
                <h1 class="text-2xl font-black text-amber-400 tracking-widest uppercase" style="font-family: 'El Messiri', serif;">{{ $settings['app_name'] ?? 'QURBAN APP' }}</h1>
                <p class="text-sm text-gray-400 font-bold tracking-widest">{{ $settings['masjid_name'] ?? 'Masjid Raya' }} - Tahun {{ $tahun_aktif }}</p>
            </div>
        </div>
        
        <div class="flex items-center gap-8">
            <button @click="soundActivated = !soundActivated" 
                    :class="soundActivated ? 'bg-emerald-500/20 text-emerald-400 border-emerald-500/50' : 'bg-red-500/20 text-red-400 border-red-500/50'"
                    class="px-4 py-2 rounded-full border flex items-center gap-2 transition cursor-pointer">
                <svg x-show="soundActivated" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5 10v4a2 2 0 002 2h2l5 5V3l-5 5H7a2 2 0 00-2 2z"></path></svg>
                <svg x-show="!soundActivated" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"></path></svg>
                <span class="text-xs font-black tracking-widest uppercase" x-text="soundActivated ? 'AUDIO ON' : 'KLIK UNTUK AUDIO'"></span>
            </button>

            <div class="flex flex-col items-end">
                <h2 class="text-4xl font-black text-emerald-400 font-mono tracking-wider" 
                    x-data="{ time: new Date().toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false}) }" 
                    x-init="setInterval(() => time = new Date().toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false}), 1000)" 
                    x-text="time"></h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-3 h-3 rounded-full bg-red-500 animate-pulse"></span>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">LIVE DISPLAY</span>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-1 relative bg-gradient-to-br from-gray-900 to-gray-950 overflow-hidden z-0">
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-emerald-600 rounded-full blur-[150px] opacity-20 pointer-events-none"></div>

        <div x-show="activeSlide === 1" x-transition.opacity.duration.800ms class="absolute inset-0 flex flex-col h-full">
            <h2 class="text-3xl font-black text-white m-8 mb-4 border-l-8 border-emerald-500 pl-4 shrink-0">STATUS PEMOTONGAN HEWAN</h2>
            <div id="slide-container-1" class="flex-1 overflow-y-auto px-8 pb-10 hide-scrollbar" wire:ignore.self>
                <div class="grid grid-cols-4 gap-6">
                    @forelse($sapis as $sapi)
                        <div class="bg-gray-800/80 backdrop-blur-md rounded-3xl p-6 border-2 transition-colors duration-500 {{ in_array($sapi->status_proses, ['Disembelih', 'Dikuliti']) ? 'border-amber-500 shadow-[0_0_30px_rgba(245,158,11,0.2)]' : 'border-gray-700' }}">
                            <div class="flex justify-between items-start mb-4">
                                
                                <div class="flex items-center gap-3">
                                    @if(isset($sapi->path_foto_sapi) && $sapi->path_foto_sapi)
                                        <img src="{{ asset('storage/'.$sapi->path_foto_sapi) }}" class="w-14 h-14 rounded-xl object-cover border border-gray-600 shadow-lg">
                                    @else
                                        <div class="w-14 h-14 rounded-xl bg-gray-700/50 flex items-center justify-center text-3xl border border-gray-600 shadow-inner">🐄</div>
                                    @endif
                                    <span class="text-4xl font-black text-white font-mono">{{ $sapi->kode_sapi }}</span>
                                </div>

                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest transition-colors duration-500
                                    {{ $sapi->status_proses == 'Menunggu' ? 'bg-gray-700 text-gray-300' : '' }}
                                    {{ in_array($sapi->status_proses, ['Disembelih', 'Dikuliti']) ? 'bg-amber-500 text-black animate-pulse' : '' }}
                                    {{ $sapi->status_proses == 'Selesai' ? 'bg-emerald-500 text-white' : '' }}">
                                    {{ $sapi->status_proses ?? 'Menunggu' }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-400 font-bold ml-[4.5rem]">{{ $sapi->jenis_sapi }} • {{ $sapi->berat }} Kg</p>
                        </div>
                    @empty
                        <div class="col-span-4 text-center py-20 text-gray-500 text-xl font-bold">Belum ada data sapi terdaftar.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div x-show="activeSlide === 2" x-transition.opacity.duration.800ms class="absolute inset-0 flex flex-col h-full" style="display: none;">
            <h2 class="text-3xl font-black text-white m-8 mb-4 border-l-8 border-amber-500 pl-4 shrink-0">DATA PENDAFTAR (MUDHOHI) PER KELOMPOK</h2>
            <div id="slide-container-2" class="flex-1 overflow-y-auto px-8 pb-10 hide-scrollbar" wire:ignore.self>
                <div class="grid grid-cols-3 gap-8">
                    @forelse($kelompoks as $klp)
                        <div class="bg-gray-800/80 backdrop-blur-md rounded-[2.5rem] p-6 border-t-4 border-amber-500 flex flex-col h-full">
                            <div class="flex justify-between items-center mb-6 border-b border-gray-700 pb-4">
                                <div>
                                    <h3 class="text-xl font-black text-amber-400">{{ $klp->nama_kelompok }}</h3>
                                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">{{ count($klp->mudhohis) }} Peserta Qurban</p>
                                </div>
                                <span class="text-lg font-bold bg-gray-900 border border-gray-700 text-white px-4 py-2 rounded-xl font-mono">SAPI {{ $klp->sapi->kode_sapi ?? '-' }}</span>
                            </div>
                            
                            <ul class="space-y-3 flex-1">
                                @forelse($klp->mudhohis as $index => $mdh)
                                    <li class="flex items-center gap-3 bg-gray-900/50 p-3 rounded-2xl">
                                        <div class="w-8 h-8 rounded-full bg-amber-500/20 text-amber-400 flex items-center justify-center font-black text-xs shrink-0 border border-amber-500/30">{{ $index + 1 }}</div>
                                        <span class="font-bold text-gray-200 truncate">{{ $mdh->warga->nama ?? 'Hamba Allah' }}</span>
                                    </li>
                                @empty
                                    <li class="text-center text-sm text-gray-500 py-4 font-bold">Belum ada peserta di kelompok ini.</li>
                                @endforelse
                            </ul>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-20 text-gray-500 text-xl font-bold">Belum ada kelompok qurban.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div x-show="activeSlide === 3" x-transition.opacity.duration.800ms class="absolute inset-0 flex flex-col h-full" style="display: none;">
            @php
                $scanCount = $semuaKupon->where('status', 'Sudah')->count();
                $totalCount = $semuaKupon->count();
                $percent = $totalCount > 0 ? round(($scanCount / $totalCount) * 100) : 0;
            @endphp
            <div class="flex items-center justify-between m-8 mb-4 shrink-0">
                <div class="flex items-center gap-4 bg-gray-900/50 backdrop-blur-sm border border-gray-700 p-3 pr-6 rounded-2xl shadow-xl">
                    <div class="bg-blue-500/20 text-blue-400 p-3 rounded-xl border border-blue-500/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] items-center gap-1 font-black text-gray-500 uppercase tracking-widest flex"><span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span> PROGRESS DISTRIBUSI</span>
                        <div class="flex items-baseline gap-2 mt-1">
                            <span class="text-3xl font-black text-white font-mono">{{ $scanCount }}</span>
                            <span class="text-xl font-bold text-gray-500 font-mono">/ {{ $totalCount }}</span>
                        </div>
                    </div>
                    <div class="ml-4 pl-6 py-2 border-l border-gray-700">
                        <div class="text-4xl font-black text-blue-500">{{ $percent }}%</div>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-white border-r-8 border-blue-500 pr-4 text-right">DAFTAR DISTRIBUSI DAGING (LIVE)</h2>
            </div>
            <div id="slide-container-3" class="flex-1 overflow-y-auto px-8 pb-10 hide-scrollbar" wire:ignore.self>
                <div class="bg-gray-800/50 rounded-[2.5rem] overflow-hidden border border-gray-700 shadow-2xl">
                    <table class="w-full text-left">
                        <thead class="bg-gray-900 text-gray-400 uppercase text-xs tracking-widest font-black sticky top-0 z-10 shadow-md">
                            <tr>
                                <th class="px-8 py-6">Waktu Ambil</th>
                                <th class="px-8 py-6">Jenis Kupon</th>
                                <th class="px-8 py-6">Nama Warga</th>
                                <th class="px-8 py-6 text-right">Status Distribusi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                            @forelse($semuaKupon as $riwayat)
                                <tr class="bg-gray-800/50 hover:bg-gray-700/50 transition">
                                    <td class="px-8 py-5 font-mono text-xl font-black {{ $riwayat->status == 'Sudah' ? 'text-emerald-400' : 'text-gray-600' }} w-48">
                                        {{ $riwayat->status == 'Sudah' ? \Carbon\Carbon::parse($riwayat->waktu)->format('H:i:s') : '--:--:--' }}
                                    </td>
                                    <td class="px-8 py-5">
                                        @if($riwayat->tipe == 'Panitia')
                                            <span class="px-3 py-1.5 bg-rose-500/20 text-rose-400 border border-rose-500/30 rounded-xl text-[10px] font-black uppercase tracking-widest">Panitia (PQR)</span>
                                        @elseif($riwayat->tipe == 'Mudhohi')
                                            <span class="px-3 py-1.5 bg-blue-500/20 text-blue-400 border border-blue-500/30 rounded-xl text-[10px] font-black uppercase tracking-widest">Mudhohi (MDH)</span>
                                        @else
                                            <span class="px-3 py-1.5 bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-xl text-[10px] font-black uppercase tracking-widest">Mustahiq (QBN)</span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="text-xl font-black {{ $riwayat->status == 'Sudah' ? 'text-white' : 'text-gray-400' }}">{{ $riwayat->nama }}</div>
                                        <div class="text-sm font-bold text-gray-500 mt-1 truncate max-w-xs xl:max-w-md">{{ $riwayat->alamat }}</div>
                                    </td>
                                    
                                    <td class="px-8 py-5 text-right">
                                        @if($riwayat->status == 'Sudah')
                                            <div class="inline-flex items-center gap-2 text-emerald-400 bg-emerald-900/40 px-4 py-2 rounded-full border border-emerald-500/30">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                <span class="text-xs font-black uppercase tracking-widest">Telah Diterima</span>
                                            </div>
                                        @else
                                            <div class="inline-flex items-center gap-2 text-gray-500 bg-gray-900 px-4 py-2 rounded-full border border-gray-700">
                                                <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                <span class="text-xs font-black uppercase tracking-widest">Menunggu</span>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-8 py-16 text-center text-gray-500 text-lg font-bold">Belum ada data distribusi daging.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="h-16 bg-gray-900 flex items-center justify-center gap-4 relative z-20 border-t border-gray-800 shrink-0">
        <template x-for="i in totalSlides">
            <div class="w-16 h-2 rounded-full transition-all duration-500"
                 :class="activeSlide === i ? 'bg-emerald-500 shadow-[0_0_10px_#10b981]' : 'bg-gray-700'"></div>
        </template>
    </div>

    <div x-show="scanPopup" style="display: none;" 
         x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-300 transform" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-50"
         class="fixed inset-0 z-[10000] bg-black/90 backdrop-blur-lg flex items-center justify-center p-10">
        <template x-if="scanPopup">
            <div :class="{
                    'bg-gradient-to-b from-rose-600 to-rose-800 shadow-[0_0_100px_rgba(225,29,72,0.5)]': scanPopup?.tipe === 'Panitia',
                    'bg-gradient-to-b from-blue-600 to-blue-800 shadow-[0_0_100px_rgba(37,99,235,0.5)]': scanPopup?.tipe === 'Mudhohi',
                    'bg-gradient-to-b from-emerald-500 to-emerald-700 shadow-[0_0_100px_rgba(16,185,129,0.5)]': scanPopup?.tipe === 'Mustahiq'
                 }"
                 class="rounded-[3rem] p-16 text-center w-full max-w-4xl border-4 border-white/20 relative overflow-hidden">
                 
                <!-- Walking Progress Bar -->
                <div class="absolute bottom-0 left-0 h-4 bg-white/50 animate-progress-modal-6s" style="box-shadow: 0 0 20px rgba(255,255,255,0.8)"></div>

                <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center mx-auto mb-8 shadow-2xl relative z-10">
                    <svg class="w-16 h-16 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h2 class="relative z-10 text-4xl font-black text-white/80 tracking-widest uppercase mb-4">KUPON BERHASIL DI-SCAN</h2>
                <h1 class="relative z-10 text-7xl font-black text-white mb-6 uppercase" x-text="scanPopup?.nama"></h1>
                <div class="relative z-10 inline-block bg-black/40 px-8 py-3 rounded-full border border-white/20 shadow-inner">
                    <p class="text-3xl font-bold text-white tracking-widest font-mono"><span x-text="scanPopup?.tipe" class="font-sans"></span> • <span x-text="scanPopup?.waktu"></span></p>
                </div>
            </div>
        </template>
    </div>

    <div x-show="sapiPopup" style="display: none;" 
         x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-full" x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300 transform" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-full"
         class="fixed inset-0 z-[10000] bg-black/90 backdrop-blur-lg flex items-center justify-center p-10">
        <template x-if="sapiPopup">
            <div :class="{
                    'bg-gradient-to-b from-gray-500 to-gray-700 shadow-[0_0_100px_rgba(107,114,128,0.5)]': sapiPopup?.status === 'Menunggu',
                    'bg-gradient-to-b from-blue-600 to-blue-800 shadow-[0_0_100px_rgba(37,99,235,0.5)]': sapiPopup?.status === 'Disembelih',
                    'bg-gradient-to-b from-amber-500 to-amber-700 shadow-[0_0_100px_rgba(245,158,11,0.5)]': sapiPopup?.status === 'Dikuliti',
                    'bg-gradient-to-b from-emerald-500 to-emerald-700 shadow-[0_0_100px_rgba(16,185,129,0.5)]': sapiPopup?.status === 'Selesai',
                 }"
                 class="rounded-[3rem] p-16 text-center w-full max-w-4xl border-4 border-white/20 relative overflow-hidden">
                 
                <!-- Walking Progress Bar -->
                <div class="absolute bottom-0 left-0 h-4 bg-white/50 animate-progress-modal-5s" style="box-shadow: 0 0 20px rgba(255,255,255,0.8)"></div>

                <div class="relative z-10 w-full flex flex-col items-center">
                    <template x-if="sapiPopup?.foto">
                        <div class="w-48 h-48 rounded-[2rem] overflow-hidden mx-auto mb-8 shadow-2xl border-4 border-white/30 bg-black/30">
                            <img :src="sapiPopup.foto" class="w-full h-full object-cover">
                        </div>
                    </template>
                    <template x-if="!sapiPopup?.foto">
                        <div class="w-32 h-32 bg-black/30 rounded-full flex items-center justify-center mx-auto mb-8 shadow-2xl border border-white/20"><span class="text-6xl">🐄</span></div>
                    </template>
                    <h2 class="text-3xl font-black text-white tracking-widest uppercase mb-4 opacity-90">INFO UPDATE SAPI</h2>
                    <h1 class="text-8xl font-black text-white mb-2 font-mono" x-text="sapiPopup?.kode"></h1>
                    <template x-if="sapiPopup?.kelompok">
                        <p class="text-2xl font-bold text-gray-300 mb-6 uppercase tracking-widest" x-text="'Milik ' + sapiPopup.kelompok"></p>
                    </template>
                    <template x-if="!sapiPopup?.kelompok">
                        <div class="mb-6"></div>
                    </template>
                    <div class="inline-block bg-white text-gray-900 px-10 py-4 rounded-full shadow-2xl" :class="{
                        'text-gray-700': sapiPopup?.status === 'Menunggu',
                        'text-blue-700': sapiPopup?.status === 'Disembelih',
                        'text-amber-700': sapiPopup?.status === 'Dikuliti',
                        'text-emerald-700': sapiPopup?.status === 'Selesai'
                    }">
                        <p class="text-3xl font-black tracking-widest uppercase" x-text="sapiPopup?.status"></p>
                    </div>
                </div>
            </div>
        </template>
    </div>

</div>

<script>
    function liveDisplayData() {
        return {
            activeSlide: 1, 
            totalSlides: 3,
            scanPopup: null,
            sapiPopup: null,
            soundActivated: false,
            waitingAtBottom: false,
            scrollLoopCount: 0,
            frameCount: 0,
            timeoutId: null,

            init() {
                const scrollLoop = () => {
                    if (!this.scanPopup && !this.sapiPopup) {
                        let container = document.getElementById('slide-container-' + this.activeSlide);
                        
                        if (container) {
                            let maxScroll = container.scrollHeight - container.clientHeight;

                            if (maxScroll > 1) {
                                if (container.scrollTop >= maxScroll - 2) {
                                    // Sudah di paling bawah
                                    if (!this.waitingAtBottom) {
                                        this.waitingAtBottom = true;
                                        
                                        // Waktu baca saat posisi paling bawah sebelum gulir/ganti (diperlama)
                                        // Slide 2 dan 3 ditunggu 6 detik, sisanya 5 detik
                                        let waitTime = (this.activeSlide === 3 || this.activeSlide === 2) ? 6000 : 5000;
                                        
                                        if (this.activeSlide === 3 && this.scrollLoopCount < 1) {
                                            this.timeoutId = setTimeout(() => { 
                                                container.scrollTop = 0; 
                                                this.waitingAtBottom = false;
                                                this.scrollLoopCount++;
                                                this.timeoutId = null;
                                            }, waitTime);
                                        } else {
                                            // Slide 1 dan 2 (dan slide 3 yang ke-2) akan langsung call nextSlide
                                            this.timeoutId = setTimeout(() => { this.nextSlide(); }, waitTime);
                                        }
                                    }
                                } else {
                                    // Batal nunggu bila Livewire nge-update DOM dan nambahin isi list di bawah
                                    if (this.waitingAtBottom) {
                                        if (this.timeoutId) {
                                            clearTimeout(this.timeoutId);
                                            this.timeoutId = null;
                                        }
                                        this.waitingAtBottom = false;
                                    }

                                    // Memperlambat gulir tanpa memecah angka pecahan:
                                    // Update nilai scrollTop setiap 2 frame sekali (menjadi setengah kecepatan awal)
                                    this.frameCount++;
                                    if (this.frameCount % 2 === 0) {
                                        container.scrollTop += 0.5;
                                    }
                                }
                            } else {
                                // Konten tidak butuh scroll karena muat di satu layar
                                if (!this.waitingAtBottom) {
                                    this.waitingAtBottom = true;
                                    // Slide 2 dan 3 kita beri 16 detik sebelum ganti slide jika tak ada guliran
                                    let waitTime = (this.activeSlide === 3 || this.activeSlide === 2) ? 16000 : 8000;
                                    this.timeoutId = setTimeout(() => { this.nextSlide(); }, waitTime);
                                }
                            }
                        }
                    }
                    requestAnimationFrame(scrollLoop);
                };
                
                requestAnimationFrame(scrollLoop);

                window.addEventListener('show-scan-popup', (e) => {
                    this.scanPopup = e.detail[0];
                    new Audio('https://assets.mixkit.co/active/mixkit-positive-notification-951.wav').play().catch(()=>{});
                    if (this.soundActivated && 'speechSynthesis' in window) {
                        window.speechSynthesis.cancel();
                        let text = this.scanPopup.tipe === 'Panitia' ? 'Perhatian. Kupon Panitia ' : (this.scanPopup.tipe === 'Mudhohi' ? 'Alhamdulillah. Kupon Mudhohi ' : 'Pemberitahuan. Kupon Mustahik ');
                        text += 'atas nama ' + this.scanPopup.nama + ', berhasil di-scan.';
                        let utterance = new SpeechSynthesisUtterance(text);
                        utterance.lang = 'id-ID'; utterance.rate = 0.9;
                        window.speechSynthesis.speak(utterance);
                    }
                    setTimeout(() => { this.scanPopup = null; }, 6000);
                });

                window.addEventListener('show-sapi-popup', (e) => {
                    this.sapiPopup = e.detail[0];
                    new Audio('https://assets.mixkit.co/active/mixkit-software-interface-start-2574.wav').play().catch(()=>{});
                    if (this.soundActivated && 'speechSynthesis' in window) {
                        window.speechSynthesis.cancel();
                        let utterance = new SpeechSynthesisUtterance('Informasi Qurban. Sapi kode ' + this.sapiPopup.kode + ', status saat ini: ' + this.sapiPopup.status + '.');
                        utterance.lang = 'id-ID'; utterance.rate = 0.9;
                        window.speechSynthesis.speak(utterance);
                    }
                    setTimeout(() => { this.sapiPopup = null; }, 5000);
                });
            },

            nextSlide() {
                if (this.timeoutId) {
                    clearTimeout(this.timeoutId);
                    this.timeoutId = null;
                }
                this.activeSlide = this.activeSlide >= this.totalSlides ? 1 : this.activeSlide + 1;
                this.waitingAtBottom = false;
                this.scrollLoopCount = 0;
                for(let i=1; i<=this.totalSlides; i++) {
                    let c = document.getElementById('slide-container-' + i);
                    if(c) c.scrollTop = 0;
                }
            }
        }
    }
</script>

<style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    @keyframes progressBarWalking {
        0% { width: 100%; }
        100% { width: 0%; }
    }
    .animate-progress-modal-6s { animation: progressBarWalking 6.3s linear forwards; }
    .animate-progress-modal-5s { animation: progressBarWalking 5.3s linear forwards; }
</style>