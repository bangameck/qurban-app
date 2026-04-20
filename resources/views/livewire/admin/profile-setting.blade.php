<div @open-profile-setting.window="$wire.open()">
    {{-- ===== MODAL SETTING PROFIL ===== --}}
    <div x-cloak x-show="$wire.isOpen" class="relative z-[200]">
        <div x-show="$wire.isOpen"
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto flex items-center justify-center p-4">
            <div @click.away="$wire.close()" class="bg-white rounded-[2.5rem] w-full max-w-2xl shadow-2xl overflow-hidden">

                {{-- Header --}}
                <div class="px-8 py-6 bg-gradient-to-r from-primary-700 to-primary-900 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        @php
                            $u = auth()->user();
                            $av = ($u->warga && $u->warga->path_img)
                                ? asset('storage/'.$u->warga->path_img)
                                : 'https://ui-avatars.com/api/?name='.urlencode($u->name ?? 'U').'&background=ffffff&color=0d9488&bold=true';
                        @endphp
                        <img src="{{ $av }}" class="w-14 h-14 rounded-2xl object-cover border-4 border-white/20 shadow-lg">
                        <div>
                            <h3 class="text-xl font-black text-white">Pengaturan Profil</h3>
                            <p class="text-primary-200 text-xs mt-0.5">{{ $u->email }}</p>
                        </div>
                    </div>
                    <button wire:click="close" class="p-2 bg-white/10 hover:bg-white/20 rounded-xl text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="p-8 space-y-8 max-h-[75vh] overflow-y-auto">

                    {{-- ===== SECTION: INFO PROFIL ===== --}}
                    <form wire:submit.prevent="saveProfile">
                        <h4 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-5 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Informasi Akun
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- Nama --}}
                            <div class="relative">
                                <input type="text" id="profile_name" wire:model="name"
                                    class="peer block px-4 py-3 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 transition-all"
                                    placeholder=" "/>
                                <label for="profile_name" class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">Nama Lengkap</label>
                                @error('name') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>

                            {{-- Email --}}
                            <div class="relative">
                                <input type="email" id="profile_email" wire:model="email"
                                    class="peer block px-4 py-3 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 transition-all"
                                    placeholder=" "/>
                                <label for="profile_email" class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">Email Login</label>
                                @error('email') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>

                            {{-- No. HP --}}
                            <div class="relative md:col-span-2">
                                <input type="text" inputmode="numeric" id="profile_phone" wire:model="phone_number"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                    class="peer block px-4 py-3 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 transition-all"
                                    placeholder=" "/>
                                <label for="profile_phone" class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">No. Telepon / WhatsApp</label>
                                @error('phone_number') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>

                            {{-- Foto Profil (compress) --}}
                            <div class="md:col-span-2 border-2 border-dashed border-gray-200 bg-gray-50 rounded-2xl p-5"
                                 x-data="{
                                    isCompressing: false,
                                    previewUrl: null,
                                    originalSize: null,
                                    compressedSize: null,
                                    init() {
                                        this.$watch('$wire.existing_image', value => {
                                            this.previewUrl = value ? '/storage/' + value + '?v=' + Date.now() : null;
                                            this.originalSize = null; this.compressedSize = null;
                                        });
                                        if (this.$wire.existing_image) {
                                            this.previewUrl = '/storage/' + this.$wire.existing_image + '?v=' + Date.now();
                                        }
                                    },
                                    processImage(event) {
                                        const file = event.target.files[0];
                                        if (!file) return;
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
                                                canvas.width = finalSize; canvas.height = finalSize;
                                                ctx.beginPath();
                                                ctx.arc(finalSize/2, finalSize/2, finalSize/2, 0, Math.PI * 2, true);
                                                ctx.closePath(); ctx.clip();
                                                const startX = (img.width - minSize) / 2;
                                                const startY = (img.height - minSize) / 2;
                                                ctx.drawImage(img, startX, startY, minSize, minSize, 0, 0, finalSize, finalSize);
                                                const base64data = canvas.toDataURL('image/png');
                                                this.previewUrl = base64data;
                                                $wire.new_image_base64 = base64data;
                                                this.compressedSize = Math.round((base64data.length * 0.75) / 1024).toFixed(2) + ' KB';
                                                setTimeout(() => { this.isCompressing = false; }, 600);
                                            }
                                        }
                                    }
                                 }">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Foto Profil (Auto Crop Lingkaran 1:1)</label>
                                <div class="flex items-center gap-6">
                                    <div class="w-20 h-20 rounded-full bg-white shadow-sm border border-gray-200 flex items-center justify-center relative overflow-hidden shrink-0">
                                        <template x-if="previewUrl">
                                            <img :src="previewUrl" class="w-full h-full object-cover rounded-full">
                                        </template>
                                        <template x-if="!previewUrl">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        </template>
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" accept="image/png, image/jpeg, image/webp" @change="processImage($event)"
                                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-gray-200 file:text-gray-700 hover:file:bg-primary-600 hover:file:text-white transition file:cursor-pointer">
                                        <div class="mt-2 min-h-[20px]">
                                            <p x-show="isCompressing" class="text-xs text-amber-500 font-bold animate-pulse">Memotong & Mengompres...</p>
                                            <p x-show="!isCompressing && compressedSize" class="text-xs text-green-600 font-bold flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                Sukses: <span class="text-gray-400 line-through" x-text="originalSize"></span> <span class="text-gray-800 mx-1">➜</span> <span x-text="compressedSize"></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit" class="px-8 py-3 bg-primary-600 text-white font-black text-sm rounded-2xl shadow-lg shadow-primary-900/20 hover:bg-primary-700 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                                <svg wire:loading wire:target="saveProfile" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>

                    <div class="border-t border-dashed border-gray-200"></div>

                    {{-- ===== SECTION: GANTI PASSWORD ===== --}}
                    <form wire:submit.prevent="savePassword" x-data="{ showPass: { old: false, new: false, confirm: false } }">
                        <h4 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-5 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                            Ganti Password
                        </h4>

                        <div class="grid grid-cols-1 gap-5">
                            {{-- Password Lama --}}
                            <div class="relative">
                                <input :type="showPass.old ? 'text' : 'password'" id="current_password" wire:model="current_password"
                                    class="peer block px-4 py-3 pr-12 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 transition-all"
                                    placeholder=" "/>
                                <label for="current_password" class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">Password Lama</label>
                                <button type="button" @click="showPass.old = !showPass.old" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600 transition">
                                    <svg x-show="!showPass.old" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <svg x-show="showPass.old" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                </button>
                                @error('current_password') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>

                            {{-- Password Baru --}}
                            <div class="relative">
                                <input :type="showPass.new ? 'text' : 'password'" id="new_password" wire:model="new_password"
                                    class="peer block px-4 py-3 pr-12 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 transition-all"
                                    placeholder=" "/>
                                <label for="new_password" class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">Password Baru</label>
                                <button type="button" @click="showPass.new = !showPass.new" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600 transition">
                                    <svg x-show="!showPass.new" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <svg x-show="showPass.new" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                </button>
                                @error('new_password') <span class="text-red-500 text-xs mt-1 block font-bold">{{ $message }}</span> @enderror
                            </div>

                            {{-- Konfirmasi Password Baru --}}
                            <div class="relative">
                                <input :type="showPass.confirm ? 'text' : 'password'" id="new_password_confirmation" wire:model="new_password_confirmation"
                                    class="peer block px-4 py-3 pr-12 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 transition-all"
                                    placeholder=" "/>
                                <label for="new_password_confirmation" class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">Konfirmasi Password Baru</label>
                                <button type="button" @click="showPass.confirm = !showPass.confirm" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600 transition">
                                    <svg x-show="!showPass.confirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <svg x-show="showPass.confirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit" class="px-8 py-3 bg-rose-600 text-white font-black text-sm rounded-2xl shadow-lg shadow-rose-900/20 hover:bg-rose-700 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                                <svg wire:loading wire:target="savePassword" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Ubah Password
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
