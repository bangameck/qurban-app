<div class="max-w-xl mx-auto pb-20 relative min-h-screen">
    <div class="text-center mb-8 pt-6">
        <h2 class="text-2xl font-black text-gray-800 tracking-tight">Smart Scanner Qurban</h2>
        <p class="text-sm text-gray-500 mt-1 flex items-center justify-center gap-2">
            <span class="w-2 h-2 rounded-full bg-rose-500"></span> Panitia
            <span class="w-2 h-2 rounded-full bg-blue-500 ml-2"></span> Mudhohi
            <span class="w-2 h-2 rounded-full bg-emerald-500 ml-2"></span> Mustahiq
        </p>
    </div>

    <div class="relative group px-4" wire:ignore>
        <div id="reader" style="width: 100%; min-height: 300px; background-color: black;" class="overflow-hidden rounded-[2.5rem] border-4 border-white shadow-2xl"></div>
        
        <div class="absolute inset-0 pointer-events-none flex flex-col items-center justify-center">
            <div class="w-64 h-64 border-2 border-primary-500/50 rounded-3xl relative">
                <div class="absolute -top-1 -left-1 w-8 h-8 border-t-4 border-l-4 border-primary-500 rounded-tl-lg"></div>
                <div class="absolute -top-1 -right-1 w-8 h-8 border-t-4 border-r-4 border-primary-500 rounded-tr-lg"></div>
                <div class="absolute -bottom-1 -left-1 w-8 h-8 border-b-4 border-l-4 border-primary-500 rounded-bl-lg"></div>
                <div class="absolute -bottom-1 -right-1 w-8 h-8 border-b-4 border-r-4 border-primary-500 rounded-br-lg"></div>
            </div>
            <div class="mt-8 px-4 py-2 bg-black/50 backdrop-blur-md rounded-full text-white text-[10px] font-black uppercase tracking-widest animate-pulse">
                Kamera Aktif
            </div>
        </div>
    </div>

    @if(!$status)
    <div class="mt-8 px-4">
        <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm text-center">
            <p class="text-xs font-bold text-gray-400 uppercase mb-4 tracking-widest">Kamera error? Input Manual:</p>
            <div class="flex gap-2">
                <input type="text" wire:model="scannedCode" placeholder="KODE-KUPON" class="flex-1 px-4 py-3 bg-gray-50 rounded-xl border-2 border-gray-100 focus:border-primary-500 outline-none text-center font-mono font-black text-lg uppercase">
                <button wire:click="processCode($scannedCode)" class="px-6 py-3 bg-primary-600 text-white rounded-xl font-black shadow-lg">GAS</button>
            </div>
        </div>
    </div>
    @endif

    @if($status)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md transition-opacity">
        
        @php
            // Logic Warna Berdasarkan Role & Status
            $bgColor = 'bg-gray-800'; 
            $shadowColor = '';
            $textColor = 'text-white';
            
            if ($status == 'success') {
                if ($resultType == 'Panitia') {
                    $bgColor = 'bg-rose-600';
                    $shadowColor = 'shadow-[0_0_50px_rgba(225,29,72,0.6)]';
                } elseif ($resultType == 'Mudhohi') {
                    $bgColor = 'bg-blue-600';
                    $shadowColor = 'shadow-[0_0_50px_rgba(37,99,235,0.6)]';
                } else {
                    $bgColor = 'bg-emerald-500';
                    $shadowColor = 'shadow-[0_0_50px_rgba(16,185,129,0.6)]';
                }
            } elseif ($status == 'warning') {
                $bgColor = 'bg-amber-500';
                $shadowColor = 'shadow-[0_0_80px_rgba(245,158,11,0.8)]';
            } elseif ($status == 'error') {
                $bgColor = 'bg-gray-900 border-2 border-red-500/50';
                $textColor = 'text-gray-100';
            }
        @endphp

        <div class="relative w-full max-w-sm p-8 rounded-[2.5rem] shadow-2xl text-center transform transition-all scale-100 animate-bounce-short {{ $bgColor }} {{ $textColor }} {{ $shadowColor }}">
            
            <div class="flex justify-center mb-6">
                <div class="w-24 h-24 rounded-full flex items-center justify-center bg-white/20 backdrop-blur-sm border-2 border-white/40 shadow-inner">
                    @if($status == 'success') 
                        <svg class="w-12 h-12 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> 
                    @endif
                    @if($status == 'warning') 
                        <svg class="w-12 h-12 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg> 
                    @endif
                    @if($status == 'error') 
                        <svg class="w-12 h-12 text-rose-400 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg> 
                    @endif
                </div>
            </div>

            <h2 class="text-3xl font-black uppercase tracking-wider mb-2 drop-shadow-sm">
                {{ $status == 'success' ? 'BERHASIL' : ($status == 'warning' ? 'SUDAH DIAMBIL' : 'DITOLAK') }}
            </h2>
            <p class="text-sm font-bold opacity-90 mb-6 px-4">{{ $message }}</p>

            @if($result)
            <div class="bg-black/20 backdrop-blur-md rounded-3xl p-5 flex items-center gap-4 text-left border border-white/20 mb-8 shadow-inner">
                <img src="{{ $result->warga->path_img ? asset('storage/'.$result->warga->path_img) : 'https://ui-avatars.com/api/?name='.urlencode($result->warga->nama) }}" class="w-16 h-16 rounded-2xl object-cover shadow-md border-2 border-white/50">
                <div class="flex-1 min-w-0">
                    <span class="inline-block px-2 py-0.5 bg-white/20 rounded text-[9px] font-black uppercase tracking-widest mb-1">{{ $resultType }}</span>
                    <p class="font-black text-lg leading-tight truncate drop-shadow-sm">{{ $result->warga->nama }}</p>
                    
                    <p class="text-[10px] font-bold uppercase tracking-widest opacity-80 mt-1">
                        @if($resultType == 'Panitia')
                            {{ $result->jabatan }}
                        @elseif($resultType == 'Mudhohi')
                            {{ $result->tipe_qurban }}
                        @elseif($resultType == 'Mustahiq')
                            {{ $result->sesiDistribusi->nama_sesi ?? 'Umum' }}
                        @endif
                    </p>
                </div>
            </div>
            @endif

            <button x-data @click="$wire.resetScanner(); window.resumeScanner();" class="w-full py-4 bg-white text-gray-900 hover:bg-gray-100 font-black text-lg rounded-2xl shadow-xl transition transform active:scale-95 flex justify-center items-center gap-2 group">
                <svg class="w-6 h-6 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                LANJUT SCAN
            </button>
        </div>
    </div>
    @endif

    @push('scripts')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
    let html5QrCode;
    window.isScanningPaused = false; 

    async function startScanner() {
        try {
            const devices = await Html5Qrcode.getCameras();
            
            if (devices && devices.length) {
                const cameraId = devices[devices.length - 1].id;
                
                if (html5QrCode) {
                    await html5QrCode.stop();
                }

                html5QrCode = new Html5Qrcode("reader");
                
                await html5QrCode.start(
                    cameraId, 
                    {
                        fps: 15, // Dibuat lebih responsif
                        qrbox: { width: 250, height: 250 },
                        aspectRatio: 1.0
                    },
                    (decodedText) => {
                        if (window.isScanningPaused) return;
                        window.isScanningPaused = true; 
                        
                        // Nge-Freeze (Pause) Kamera saat dapat kode
                        if(html5QrCode.getState() === 2) { 
                            html5QrCode.pause();
                        }

                        // Kirim ke Backend
                        @this.processCode(decodedText); 
                    },
                    (errorMessage) => { /* Ignore minor frame errors */ }
                );
            } else {
                alert("Kamera tidak terdeteksi di perangkat ini!");
            }
        } catch (err) {
            console.error("Error Kamera:", err);
        }
    }

    // Melanjutkan scan dari pause
    window.resumeScanner = function() {
        window.isScanningPaused = false;
        if (html5QrCode && html5QrCode.getState() === 3) { // 3 = PAUSED
            html5QrCode.resume();
        }
    };

    // Auto-start scanner saat Livewire Pjax / Navigation selesai load
    document.addEventListener('livewire:navigated', () => {
        setTimeout(startScanner, 800); 
    });
    </script>
    @endpush
</div>