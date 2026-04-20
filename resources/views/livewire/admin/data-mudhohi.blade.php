<div>
    <style>
        .ts-control { border-radius: 0.75rem; border-width: 2px; border-color: #f3f4f6; padding: 0.75rem 1rem; background-color: #f9fafb; transition: all 0.3s ease; }
        .ts-control.focus { border-color: var(--color-primary-500); box-shadow: none; background-color: #ffffff; }
        .ts-dropdown { border-radius: 0.75rem; border: 1px solid #e5e7eb; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); overflow: hidden; margin-top: 4px; }
        .ts-dropdown .active { background-color: var(--color-primary-50); color: var(--color-primary-700); }
    </style>

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-primary-100 text-primary-700 rounded-xl shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 tracking-wide">Pendaftar (Mudhohi) {{ $tahun_aktif }}</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola data warga pendaftar dan kupon QR qurban tahun ini.</p>
            </div>
        </div>
        <button wire:click="openModal" class="px-5 py-2.5 text-white font-bold rounded-xl shadow-lg shadow-primary-900/20 transition transform hover:-translate-y-0.5 flex items-center gap-2" style="background-color: var(--color-primary-600);">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Pendaftar
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative z-0">
        <div class="p-4 border-b border-gray-100 bg-gray-50/50">
            <input wire:model.live.debounce.300ms="search" type="text" class="w-full md:w-72 pl-4 pr-4 py-2 rounded-xl border border-gray-200 focus:border-primary-500 outline-none transition" placeholder="Cari Nama, NIK, atau Kode Kupon...">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">Mudhohi (Warga)</th>
                        <th class="px-6 py-4">Kelompok & Sapi</th>
                        <th class="px-6 py-4 w-72">Tipe & Kupon QR</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($mudhohis as $mudhohi)
                        <tr class="hover:bg-primary-50/30 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $mudhohi->warga->path_img ? asset('storage/'.$mudhohi->warga->path_img) : 'https://ui-avatars.com/api/?name='.urlencode($mudhohi->warga->nama).'&background=random' }}" class="w-10 h-10 rounded-full object-cover shadow-sm border border-gray-200">
                                    <div>
                                        <div class="font-black text-gray-800">{{ $mudhohi->warga->nama }}</div>
                                        <div class="text-[10px] text-gray-400 font-mono">NIK: {{ $mudhohi->warga->nik }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($mudhohi->kelompokSapi)
                                    <div class="font-bold text-gray-700">{{ $mudhohi->kelompokSapi->nama_kelompok }}</div>
                                    <div class="text-[10px] text-gray-500 flex items-center gap-1 mt-0.5">
                                        <svg class="w-3 h-3 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                        {{ $mudhohi->kelompokSapi->sapi->kode_sapi ?? 'Tidak ada sapi' }}
                                    </div>
                                @else
                                    <span class="text-red-400 italic text-xs font-bold">Kelompok Terhapus</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-start gap-3">
                                    <div class="shrink-0 p-1 bg-white border border-gray-200 rounded-lg shadow-sm">
                                        @if($mudhohi->path_qr_code)
                                            <img src="{{ asset('storage/'.$mudhohi->path_qr_code) }}" class="w-10 h-10 object-contain blur-[3px] hover:blur-none transition-all duration-300 cursor-pointer" title="Hover untuk melihat QR Code">
                                        @else
                                            <div class="w-10 h-10 bg-gray-50 flex items-center justify-center text-[8px] text-gray-400">NO QR</div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex flex-col items-start gap-1">
                                        <span class="px-2 py-0.5 rounded text-[9px] font-black uppercase {{ $mudhohi->tipe_qurban == 'Patungan' ? 'bg-primary-100 text-primary-700' : 'bg-blue-100 text-blue-700' }}">
                                            {{ $mudhohi->tipe_qurban }}
                                        </span>
                                        <span class="font-mono text-xs font-bold text-gray-700">
                                            {{ $mudhohi->kode_unik_kupon ?? '-' }}
                                        </span>
                                        
                                        @if($mudhohi->path_bukti_pendaftaran)
                                            <a href="{{ asset('storage/'.$mudhohi->path_bukti_pendaftaran) }}" target="_blank" class="text-[9px] font-bold text-emerald-600 hover:text-emerald-800 underline mt-1">
                                                Lihat Bukti TF
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('mudhohi.detail', $mudhohi->id) }}" 
                                       target="_blank" 
                                       class="p-2 text-emerald-600 bg-emerald-50 rounded-lg hover:bg-emerald-600 hover:text-white transition" 
                                       title="Lihat Sertifikat & Kupon Publik">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </a>
                                    <button wire:click="openModal({{ $mudhohi->id }})" class="p-2 text-primary-600 bg-primary-50 rounded-lg hover:bg-primary-600 hover:text-white transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $mudhohi->id }})" class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-600 hover:text-white transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada pendaftar qurban tahun ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100 bg-gray-50">
            {{ $mudhohis->links() }}
        </div>
    </div>

    <div x-show="$wire.isModalOpen" style="display: none;" class="relative z-[100]">
        <div x-show="$wire.isModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div @click.away="$wire.closeModal()" class="relative transform overflow-visible rounded-3xl bg-white text-left shadow-2xl transition-all sm:w-full sm:max-w-2xl">
                    <form wire:submit.prevent="save">
                        <div class="p-8">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">{{ $editId ? 'Edit Pendaftar' : 'Input Pendaftar Baru' }}</h3>
                            
                            <div class="mb-6 bg-emerald-50 border border-emerald-100 p-4 rounded-xl flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="p-3 bg-emerald-100 text-emerald-600 rounded-xl">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-emerald-600 uppercase tracking-wider">Biaya Patungan Sapi {{ $tahun_aktif }}</p>
                                        <p class="text-xl font-black text-emerald-800">Rp {{ number_format($harga_patungan_display, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-y-5">
                                @if(!$editId)
                                    <div wire:ignore x-data='{
                                            tomSelectInstance: null,
                                            init() {
                                                this.tomSelectInstance = new TomSelect(this.$refs.wargaSelect, {
                                                    valueField: "id", searchField: ["nama", "nik"], placeholder: "Ketik Nama atau NIK Warga...",
                                                    render: {
                                                        option: function(data, escape) {
                                                            return `<div class="flex items-center gap-3 p-2"><img class="w-8 h-8 rounded-full object-cover" src="${data.img}"><div><div class="font-bold text-gray-800">${escape(data.nama)}</div><div class="text-xs text-gray-400">NIK: ${escape(data.nik)}</div></div></div>`;
                                                        },
                                                        item: function(data, escape) {
                                                            return `<div class="flex items-center gap-2"><img class="w-5 h-5 rounded-full object-cover" src="${data.img}"><span class="font-bold text-sm">${escape(data.nama)}</span></div>`;
                                                        }
                                                    },
                                                    onChange: (value) => { $wire.set("id_warga", value); }
                                                });
                                                $wire.$watch("id_warga", (value) => {
                                                    if (value) { this.tomSelectInstance.setValue(value, true); } 
                                                    else { this.tomSelectInstance.clear(true); }
                                                });
                                            }
                                         }'>
                                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 ml-1">Pilih Warga (Mudhohi)</label>
                                        <select x-ref="wargaSelect" class="w-full">
                                            <option value="">Cari Warga...</option>
                                            @foreach($wargas as $warga)
                                                @php $imgUrl = $warga->path_img ? asset('storage/'.$warga->path_img) : 'https://ui-avatars.com/api/?name='.urlencode($warga->nama).'&background=random'; @endphp
                                                <option value="{{ $warga->id }}" data-nama="{{ $warga->nama }}" data-nik="{{ $warga->nik }}" data-img="{{ $imgUrl }}">{{ $warga->nama }} ({{ $warga->nik }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_warga') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                                @else
                                    @php
                                        $editWarga = \App\Models\Warga::find($id_warga);
                                    @endphp
                                    
                                    @if($editWarga)
                                    <div class="relative animate-fadeIn">
                                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-3 ml-1 tracking-widest flex items-center gap-2">
                                            Identitas Mudhohi
                                            <span class="px-2 py-0.5 bg-gray-200 text-gray-500 rounded text-[8px] metallic-effect">TERKUNCI</span>
                                        </label>
                                        
                                        <div class="relative flex items-center justify-between p-5 bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl shadow-inner cursor-not-allowed border border-gray-100 overflow-hidden">
                                            
                                            <div class="absolute -left-5 -top-5 w-24 h-24 rounded-full bg-primary-100/50"></div>
                                            <div class="absolute -right-5 -bottom-5 w-32 h-32 rounded-full bg-primary-200/40"></div>
                                            <div class="absolute top-1/2 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary-500/10 to-transparent"></div>

                                            <div class="flex items-center gap-5 relative z-10">
                                                <img src="{{ $editWarga->path_img ? asset('storage/'.$editWarga->path_img) : 'https://ui-avatars.com/api/?name='.urlencode($editWarga->nama).'&background=10b981&color=fff&size=150' }}" class="w-14 h-14 rounded-full object-cover border-4 border-white shadow-md shadow-primary-900/10 grayscale-[15%]">
                                                <div>
                                                    <h4 class="font-black text-gray-700 text-lg leading-tight">{{ $editWarga->nama }}</h4>
                                                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-1">NIK: {{ $editWarga->nik }}</p>
                                                </div>
                                            </div>
                                            
                                            <div class="w-12 h-12 rounded-xl metallic-effect bg-gray-200 flex items-center justify-center text-gray-400 shadow-lg relative z-10 border border-gray-100">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                            </div>
                                        </div>
                                        <p class="text-[9px] text-gray-400 font-bold mt-2 ml-1 italic">* Identitas Mudhohi tidak dapat diubah setelah terdaftar.</p>
                                    </div>
                                    @error('id_warga') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                                    @endif
                                @endif

                                <div>
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 ml-1">Tipe Qurban</label>
                                    <div class="grid grid-cols-3 gap-2">
                                        @foreach(['Patungan', 'Individu', 'Kambing'] as $tipe)
                                            <button type="button" wire:click="$set('tipe_qurban', '{{ $tipe }}')" class="py-2.5 text-[11px] font-black rounded-xl border-2 transition-all {{ $tipe_qurban == $tipe ? 'text-white shadow-md scale-[1.02]' : 'border-gray-100 text-gray-400 bg-gray-50 hover:border-gray-300' }}" style="{{ $tipe_qurban == $tipe ? 'background-color: var(--color-primary-600); border-color: var(--color-primary-600);' : '' }}">{{ $tipe }}</button>
                                        @endforeach
                                    </div>
                                    @error('tipe_qurban') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                                </div>

                                @if($tipe_qurban !== 'Individu')
                                <div class="relative animate-fadeIn">
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 ml-1">Pilih Kelompok Sapi</label>
                                    <select wire:model="id_kelompok_sapi" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50 focus:bg-white focus:outline-none focus:ring-0 focus:border-primary-600 transition-all font-bold text-gray-700 cursor-pointer">
                                        <option value="">-- Pilih Kelompok --</option>
                                        @foreach($kelompoks as $kelompok)
                                            <option value="{{ $kelompok->id }}">{{ $kelompok->nama_kelompok }} (Terisi: {{ $kelompok->mudhohis_count }}/7) @if($kelompok->sapi) - {{ $kelompok->sapi->kode_sapi }} @endif</option>
                                        @endforeach
                                    </select>
                                    @error('id_kelompok_sapi') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                                </div>
                                @endif

                                <div class="bg-gray-50 p-5 rounded-2xl border border-gray-200 mt-6 shadow-inner" 
                                     x-data="{
                                        isCompressing: false, progress: 0, originalSize: '...', compressedSize: 'Proses...', previewUrl: null,
                                        formatBytes(bytes) {
                                            if (bytes === 0) return '0 B'; const k = 1024; const sizes = ['B', 'KB', 'MB', 'GB'];
                                            const i = Math.floor(Math.log(bytes) / Math.log(k));
                                            return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
                                        },
                                        processImage(event) {
                                            const file = event.target.files[0]; if (!file) return;
                                            this.isCompressing = true; this.progress = 10; this.originalSize = this.formatBytes(file.size);
                                            this.compressedSize = 'Nge-press...'; this.previewUrl = null;
                                            
                                            const reader = new FileReader(); reader.readAsDataURL(file);
                                            reader.onload = (e) => {
                                                const img = new Image(); img.src = e.target.result;
                                                img.onload = () => {
                                                    this.progress = 30;
                                                    const canvas = document.createElement('canvas'); const ctx = canvas.getContext('2d');
                                                    const MAX_DIM = 800; let w = img.width; let h = img.height;
                                                    if (w > h && w > MAX_DIM) { h *= MAX_DIM / w; w = MAX_DIM; } else if (h > MAX_DIM) { w *= MAX_DIM / h; h = MAX_DIM; }
                                                    canvas.width = w; canvas.height = h;
                                                    ctx.fillStyle = 'white'; ctx.fillRect(0, 0, w, h); ctx.drawImage(img, 0, 0, w, h);
                                                    
                                                    this.progress = 60; let quality = 0.9;
                                                    let base64data = canvas.toDataURL('image/jpeg', quality);
                                                    let calcSize = Math.round((base64data.length - 814) / 1.37);

                                                    while (calcSize > 100000 && quality > 0.1) {
                                                        quality -= 0.1; base64data = canvas.toDataURL('image/jpeg', Math.max(0.1, quality));
                                                        calcSize = Math.round((base64data.length - 814) / 1.37);
                                                    }

                                                    this.progress = 80; this.compressedSize = this.formatBytes(calcSize); this.previewUrl = base64data;
                                                    
                                                    try {
                                                        const byteString = atob(base64data.split(',')[1]);
                                                        const mimeString = base64data.split(',')[0].split(':')[1].split(';')[0];
                                                        const ab = new ArrayBuffer(byteString.length);
                                                        const ia = new Uint8Array(ab);
                                                        for (let i = 0; i < byteString.length; i++) { ia[i] = byteString.charCodeAt(i); }
                                                        const blob = new Blob([ab], { type: mimeString });
                                                        
                                                        const newFilename = file.name.replace(/\.[^/.]+$/, '') + '_compressed.jpg';
                                                        const newFile = new File([blob], newFilename, { type: 'image/jpeg' });
                                                        this.$wire.upload('bukti_pendaftaran', newFile, 
                                                            (u) => { this.progress = 100; setTimeout(() => { this.isCompressing = false; }, 1500); }, 
                                                            () => { this.isCompressing = false; alert('Gagal upload ke server!'); }, 
                                                            (ev) => { this.progress = 80 + (ev.detail.progress * 0.2); }
                                                        );
                                                    } catch (err) {
                                                        console.error(err);
                                                        alert('Terjadi kesalahan saat memproses gambar.');
                                                        this.isCompressing = false;
                                                    }
                                                }
                                            }
                                        }
                                     }" 
                                     x-init="$watch('$wire.isModalOpen', v => { if(!v) { previewUrl=null; progress=0; isCompressing=false; document.getElementById('fileInputBukti').value=''; } })">
                                    
                                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-4">Bukti Pembayaran / Transfer (Opsional)</label>
                                    <div class="flex items-start gap-5">
                                        <div class="shrink-0 relative">
                                            <template x-if="previewUrl">
                                                <img :src="previewUrl" class="w-20 h-20 object-cover rounded-xl border-2 border-emerald-400 shadow-md">
                                            </template>
                                            <template x-if="!previewUrl">
                                                <div>
                                                    @if($existing_bukti && !$bukti_pendaftaran)
                                                        <img src="{{ asset('storage/'.$existing_bukti) }}" class="w-20 h-20 object-cover rounded-xl border border-gray-300 shadow-sm">
                                                    @else
                                                        <div class="w-20 h-20 bg-white rounded-xl border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-300">
                                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                                                        </div>
                                                    @endif
                                                </div>
                                            </template>
                                            <div x-show="progress === 100 && !isCompressing" x-cloak class="absolute -top-2 -right-2 bg-emerald-500 text-white rounded-full p-1 shadow-lg">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            </div>
                                        </div>

                                        <div class="flex-1 w-full pt-1">
                                            <input type="file" accept="image/png, image/jpeg, image/jpg" @change="processImage($event)" id="fileInputBukti" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-wider file:bg-primary-600 file:text-white hover:file:bg-primary-700 cursor-pointer transition shadow-sm mb-2">
                                            
                                            <div x-show="isCompressing" x-cloak class="w-full mt-3">
                                                <div class="flex justify-between text-[10px] font-bold text-primary-600 mb-1.5">
                                                    <span>Ukuran: <span class="text-gray-400 line-through" x-text="originalSize"></span> <span class="text-emerald-600 ml-1" x-text="compressedSize"></span></span>
                                                    <span x-text="Math.round(progress) + '%'"></span>
                                                </div>
                                                <div class="w-full bg-primary-100 rounded-full h-2 overflow-hidden shadow-inner">
                                                    <div class="bg-primary-600 h-2 rounded-full transition-all duration-300 relative" :style="`width: ${progress}%`"></div>
                                                </div>
                                            </div>
                                            
                                            <div x-show="progress === 100 && !isCompressing" x-cloak class="text-[10px] text-emerald-600 mt-2 font-bold flex items-center gap-1 bg-emerald-50 py-1.5 px-3 rounded-lg border border-emerald-100">
                                                Gambar siap disimpan! (<span x-text="compressedSize"></span>)
                                            </div>
                                            @error('bukti_pendaftaran') <span class="text-red-500 text-xs mt-2 block font-bold">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 px-8 py-5 flex flex-row-reverse gap-3 rounded-b-3xl border-t border-gray-100">
                            <button type="submit" class="px-8 py-3 text-white font-black text-sm rounded-xl shadow-lg transition transform hover:-translate-y-0.5 flex items-center gap-2" style="background-color: var(--color-primary-600);">
                                <svg wire:loading wire:target="save" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Simpan Pendaftar
                            </button>
                            <button type="button" @click="$wire.closeModal()" class="px-8 py-3 bg-white text-gray-500 font-bold text-sm rounded-xl border border-gray-200 hover:bg-gray-100 transition">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div x-show="$wire.isDeleteModalOpen" style="display: none;" class="relative z-[150]">
        <div x-show="$wire.isDeleteModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto flex items-center justify-center p-4">
            <div @click.away="$wire.isDeleteModalOpen = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-sm text-center p-6">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-100 mb-4">
                    <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h3 class="text-xl font-black text-gray-800 mb-2">Hapus Pendaftar?</h3>
                <p class="text-sm text-gray-500 mb-6">Data, Kupon, dan QR Code akan dihapus permanen.</p>
                <div class="flex gap-3">
                    <button @click="$wire.isDeleteModalOpen = false" class="flex-1 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl">Batal</button>
                    <button wire:click="executeDelete" class="flex-1 py-3 bg-red-600 text-white font-bold rounded-xl">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>