<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-primary-100 text-primary-700 rounded-xl shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 tracking-wide">Data Warga</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola data pendaftar dan penerima qurban.</p>
            </div>
        </div>
        
        <div class="flex items-center gap-3">
            <button @click="$wire.isImportModalOpen = true" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl shadow-sm hover:bg-gray-50 transition flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Import CSV
            </button>
            <button wire:click="openModal" class="px-5 py-2.5 bg-primary-600 text-white font-bold rounded-xl shadow-lg shadow-primary-900/20 hover:bg-primary-700 hover:-translate-y-0.5 transition transform flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Warga
            </button>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative z-0">
        <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <div class="relative w-full md:w-72">
                <input wire:model.live.debounce.300ms="search" type="text" class="w-full pl-10 pr-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition" placeholder="Cari NIK atau Nama...">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">Profil</th>
                        <th class="px-6 py-4">No. KK / NIK</th>
                        <th class="px-6 py-4">Nama Lengkap</th>
                        <th class="px-6 py-4">Jabatan</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($wargas as $warga)
                        <tr class="hover:bg-primary-50/30 transition">
                            <td class="px-6 py-3">
                                @php
                                    $imgUrl = $warga->path_img ? asset('storage/'.$warga->path_img).'?v='.time() : 'https://ui-avatars.com/api/?name='.urlencode($warga->nama).'&background=random&color=fff&bold=true';
                                @endphp
                                <img src="{{ $imgUrl }}" class="w-10 h-10 rounded-full object-cover shadow-sm border border-gray-200">
                            </td>
                            <td class="px-6 py-3">
                                <div class="font-medium text-gray-800">{{ $warga->nik }}</div>
                                @if($warga->no_kk) <div class="text-xs text-gray-400">KK: {{ $warga->no_kk }}</div> @endif
                            </td>
                            <td class="px-6 py-3 font-semibold text-primary-700">{{ $warga->nama }}</td>
                            <td class="px-6 py-3">
                                <span class="px-3 py-1 rounded-lg text-xs font-bold 
                                    {{ in_array($warga->jabatan_sosial, ['RT', 'RW', 'Tokoh']) ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $warga->jabatan_sosial }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-right">
                                <div class="flex justify-end gap-2">
                                    <button wire:click="openModal({{ $warga->id }})" class="p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-600 hover:text-white transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $warga->id }})" class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-600 hover:text-white transition" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    Belum ada data warga ditemukan.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100 bg-gray-50">
            {{ $wargas->links() }}
        </div>
    </div>

    <div x-show="$wire.isModalOpen" style="display: none;" class="relative z-[100]" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div x-show="$wire.isModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="$wire.isModalOpen" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     @click.away="$wire.closeModal()"
                     class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-3xl">
                    
                    <form wire:submit.prevent="save">
                        <div class="bg-white px-6 pb-6 pt-8 sm:p-8">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">{{ $editId ? 'Edit Data Warga' : 'Tambah Warga Baru' }}</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <div class="relative">
                                    <input type="text" inputmode="numeric" id="no_kk" wire:model="no_kk" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16);"
                                        class="block px-4 py-3 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 peer transition-all" placeholder=" " />
                                    <label for="no_kk" class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">No. KK (Opsional)</label>
                                    @error('no_kk') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div class="relative">
                                    <input type="text" inputmode="numeric" id="nik" wire:model="nik" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16);"
                                        class="block px-4 py-3 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 peer transition-all" placeholder=" " />
                                    <label for="nik" class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">NIK KTP (Wajib)</label>
                                    @error('nik') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div class="relative">
                                    <input type="text" id="nama" wire:model="nama" class="block px-4 py-3 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 peer transition-all" placeholder=" " />
                                    <label for="nama" class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">Nama Lengkap</label>
                                    @error('nama') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div class="relative">
                                    <input type="text" inputmode="numeric" id="phone" wire:model="phone_number" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 0 && this.value[0] !== '0') this.value = '0' + this.value;"
                                        class="block px-4 py-3 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 peer transition-all" placeholder=" " />
                                    <label for="phone" class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">No. WhatsApp</label>
                                    @error('phone_number') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div class="relative md:col-span-2">
                                    <textarea id="alamat" wire:model="alamat" rows="2" class="block px-4 py-3 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 peer transition-all" placeholder=" "></textarea>
                                    <label for="alamat" class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">Alamat Lengkap</label>
                                    @error('alamat') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Jabatan Sosial</label>
                                    <select wire:model="jabatan_sosial" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50 focus:bg-white focus:outline-none focus:ring-0 focus:border-primary-600 transition">
                                        <option value="Warga">Warga Biasa</option>
                                        <option value="RT">Ketua RT</option>
                                        <option value="RW">Ketua RW</option>
                                        <option value="Tokoh">Tokoh Masyarakat</option>
                                    </select>
                                    @error('jabatan_sosial') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Pilih RT (Opsional)</label>
                                    <select wire:model="id_rt" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-50 focus:bg-white focus:outline-none focus:ring-0 focus:border-primary-600 transition">
                                        <option value="">- Belum Ditentukan -</option>
                                        @foreach($listRt as $rt)
                                            <option value="{{ $rt->id }}">RT {{ $rt->nama_rt }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="md:col-span-2 border-2 border-dashed border-gray-200 bg-gray-50 rounded-2xl p-6"
                                     x-data="{
                                        isCompressing: false,
                                        previewUrl: null,
                                        originalSize: null,
                                        compressedSize: null,
                                        init() {
                                            // Watch perubahan dari Livewire (Solusi bug foto nyangkut)
                                            this.$watch('$wire.existing_image', value => {
                                                this.previewUrl = value ? '/storage/' + value + '?v=' + Date.now() : null;
                                                this.originalSize = null;
                                                this.compressedSize = null;
                                            });
                                            // Set saat pertama kali render
                                            if(this.$wire.existing_image) {
                                                this.previewUrl = '/storage/' + this.$wire.existing_image + '?v=' + Date.now();
                                            }
                                        },
                                        processImage(event) {
                                            const file = event.target.files[0];
                                            if (!file) return;
                                            
                                            // Kalkulasi ukuran asli
                                            let sizeMB = (file.size / (1024*1024)).toFixed(2);
                                            this.originalSize = sizeMB >= 1 ? sizeMB + ' MB' : (file.size / 1024).toFixed(2) + ' KB';
                                            
                                            this.isCompressing = true;
                                            const reader = new FileReader();
                                            reader.readAsDataURL(file);
                                            reader.onload = (e) => {
                                                const img = new Image();
                                                img.src = e.target.result;
                                                img.onload = () => {
                                                    const canvas = document.createElement('canvas');
                                                    const ctx = canvas.getContext('2d');
                                                    
                                                    const minSize = Math.min(img.width, img.height);
                                                    const finalSize = Math.min(minSize, 400); 
                                                    
                                                    canvas.width = finalSize;
                                                    canvas.height = finalSize;
                                                    
                                                    ctx.beginPath();
                                                    ctx.arc(finalSize/2, finalSize/2, finalSize/2, 0, Math.PI * 2, true);
                                                    ctx.closePath();
                                                    ctx.clip();
                                                    
                                                    const startX = (img.width - minSize) / 2;
                                                    const startY = (img.height - minSize) / 2;
                                                    
                                                    ctx.drawImage(img, startX, startY, minSize, minSize, 0, 0, finalSize, finalSize);

                                                    const base64data = canvas.toDataURL('image/png');
                                                    this.previewUrl = base64data;
                                                    $wire.new_image_base64 = base64data;
                                                    
                                                    // Kalkulasi ukuran setelah dikompres (Base64 length * 0.75)
                                                    this.compressedSize = Math.round((base64data.length * 0.75) / 1024).toFixed(2) + ' KB';

                                                    setTimeout(() => { this.isCompressing = false; }, 600);
                                                }
                                            }
                                        }
                                     }">
                                    <label class="block text-sm font-semibold text-gray-700 mb-4">Foto Profil (Auto Crop Circle 1:1)</label>
                                    <div class="flex items-center gap-6">
                                        <div class="w-24 h-24 rounded-full bg-white shadow-sm border border-gray-200 flex items-center justify-center p-1 relative overflow-hidden group">
                                            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 8px 8px;"></div>
                                            <template x-if="previewUrl">
                                                <img :src="previewUrl" class="relative z-10 w-full h-full object-cover rounded-full drop-shadow-sm">
                                            </template>
                                            <template x-if="!previewUrl">
                                                <svg class="w-10 h-10 text-gray-300 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            </template>
                                        </div>

                                        <div class="flex-1">
                                            <input type="file" accept="image/png, image/jpeg, image/webp" @change="processImage($event)"
                                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-gray-200 file:text-gray-700 hover:file:bg-primary-600 hover:file:text-white transition file:cursor-pointer">
                                            
                                            <div class="mt-2 min-h-[24px]">
                                                <p x-show="isCompressing" class="text-xs text-amber-500 font-bold animate-pulse">Memotong & Mengompres...</p>
                                                <p x-show="!isCompressing && compressedSize" class="text-xs text-green-600 font-bold flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    Sukses: <span class="text-gray-400 line-through" x-text="originalSize"></span> <span class="text-gray-800 mx-1">➜</span> <span x-text="compressedSize"></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse sm:px-8 rounded-b-3xl border-t border-gray-100">
                            <button type="submit" class="inline-flex w-full justify-center rounded-xl bg-primary-600 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-primary-700 sm:ml-3 sm:w-auto transition">
                                <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Simpan Warga
                            </button>
                            <button type="button" @click="$wire.closeModal()" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-6 py-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div x-show="$wire.isDeleteModalOpen" style="display: none;" class="relative z-[150]" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div x-show="$wire.isDeleteModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="$wire.isDeleteModalOpen" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     @click.away="$wire.isDeleteModalOpen = false"
                     class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl border border-gray-100 transition-all sm:my-8 sm:w-full sm:max-w-md">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-bold leading-6 text-gray-900">Hapus Data Warga?</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Tindakan ini tidak dapat dibatalkan. Semua data terkait warga ini akan terhapus dari sistem selamanya.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button wire:click="executeDelete" type="button" class="inline-flex w-full justify-center rounded-xl bg-red-600 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto transition">Ya, Hapus Saja</button>
                        <button @click="$wire.isDeleteModalOpen = false" type="button" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-6 py-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="$wire.isImportModalOpen" style="display: none;" class="relative z-[100]">
        <div x-show="$wire.isImportModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center">
                <div x-show="$wire.isImportModalOpen" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                     class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg p-8">
                    
                    <h3 class="text-2xl font-bold text-gray-800 mb-2 text-center">Import Warga per RT</h3>
                    <p class="text-center text-gray-500 mb-6 text-sm">Pilih RT dan upload file warga untuk RT tersebut.</p>

                    <form wire:submit.prevent="importData" x-data="{ uploading: false, progress: 0 }"
                          x-on:livewire-upload-start="uploading = true"
                          x-on:livewire-upload-finish="uploading = false"
                          x-on:livewire-upload-progress="progress = $event.detail.progress">
                        
                        <div class="mb-6">
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-2 ml-1">Pilih RT Tujuan</label>
                            <select wire:model="importRtId" class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 bg-gray-50 focus:bg-white focus:border-primary-600 outline-none transition">
                                <option value="">-- Pilih RT --</option>
                                @foreach($listRt as $rt)
                                    <option value="{{ $rt->id }}">RT {{ $rt->nama_rt }}</option>
                                @endforeach
                            </select>
                            @error('importRtId') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="relative border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center bg-gray-50 hover:bg-primary-50 transition cursor-pointer mb-6 group">
                            <input type="file" wire:model="importFile" accept=".csv, .xlsx, .xls" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            
                            <div class="relative z-0">
                                <svg class="mx-auto h-10 w-10 text-gray-400 mb-2 group-hover:scale-110 transition transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <span class="text-sm font-bold text-gray-700" x-text="$wire.importFile ? 'File Terpilih!' : 'Klik untuk Upload File'"></span>
                                <p class="text-[10px] text-gray-400 mt-1">.xlsx / .csv (Max 5MB)</p>
                            </div>

                            <div x-show="uploading" class="absolute inset-x-0 bottom-0 h-1.5 bg-gray-200">
                                <div class="h-full bg-primary-600" :style="`width: ${progress}%`"></div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3">
                            <button type="submit" 
                                class="w-full py-3 rounded-xl font-bold transition flex items-center justify-center gap-2"
                                :class="($wire.importFile && $wire.importRtId) ? 'bg-primary-600 text-white shadow-lg shadow-primary-900/20' : 'bg-gray-200 text-gray-400 cursor-not-allowed'"
                                :disabled="!$wire.importFile || !$wire.importRtId">
                                <svg wire:loading wire:target="importData" class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Mulai Import Data
                            </button>
                            
                            <button type="button" @click="$wire.isImportModalOpen = false" class="w-full py-3 text-gray-500 font-semibold hover:bg-gray-100 rounded-xl transition">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>