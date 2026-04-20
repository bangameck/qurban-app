<div class="pb-10 w-full">
    <form wire:submit.prevent="save" class="space-y-8 w-full">

        <div class="bg-white p-8 md:p-10 rounded-[2rem] shadow-sm border border-primary-50 relative z-10 w-full">
            <div class="flex items-center gap-3 mb-8 border-b border-gray-100 pb-4">
                <div class="p-2 bg-primary-100 text-primary-700 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Identitas & Tampilan</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="relative">
                    <input type="text" id="app_name" wire:model="app_name"
                        class="block px-4 py-3 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 peer transition-all"
                        placeholder=" " />
                    <label for="app_name"
                        class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">
                        Nama Aplikasi
                    </label>
                </div>

                <div class="relative">
                    <input type="text" id="login_greeting" wire:model="login_greeting"
                        class="block px-4 py-3 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 peer transition-all"
                        placeholder=" " />
                    <label for="login_greeting"
                        class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">
                        Kalimat Sapaan Login
                    </label>
                </div>

                <div class="relative">
                    <input type="text" id="masjid_name" wire:model="masjid_name"
                        class="block px-4 py-3 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 peer transition-all"
                        placeholder=" " />
                    <label for="masjid_name"
                        class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">
                        Nama Masjid
                    </label>
                </div>

                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Warna Tema Aplikasi (Auto)</label>
                    <div class="flex gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" wire:model="theme_color" value="emerald" class="peer sr-only">
                            <div
                                class="w-10 h-10 rounded-full bg-[#10b981] ring-offset-2 peer-checked:ring-2 peer-checked:ring-[#10b981] flex items-center justify-center transition-all">
                                <svg class="w-5 h-5 text-white opacity-0 peer-checked:opacity-100" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" wire:model="theme_color" value="blue" class="peer sr-only">
                            <div
                                class="w-10 h-10 rounded-full bg-[#3b82f6] ring-offset-2 peer-checked:ring-2 peer-checked:ring-[#3b82f6] flex items-center justify-center transition-all">
                                <svg class="w-5 h-5 text-white opacity-0 peer-checked:opacity-100" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" wire:model="theme_color" value="rose" class="peer sr-only">
                            <div
                                class="w-10 h-10 rounded-full bg-[#f43f5e] ring-offset-2 peer-checked:ring-2 peer-checked:ring-[#f43f5e] flex items-center justify-center transition-all">
                                <svg class="w-5 h-5 text-white opacity-0 peer-checked:opacity-100" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" wire:model="theme_color" value="amber" class="peer sr-only">
                            <div
                                class="w-10 h-10 rounded-full bg-[#f59e0b] ring-offset-2 peer-checked:ring-2 peer-checked:ring-[#f59e0b] flex items-center justify-center transition-all">
                                <svg class="w-5 h-5 text-white opacity-0 peer-checked:opacity-100" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </label>
                    </div>
                </div>

                <div x-data="imageUploader('new_logo_base64', 400, null)"
                    class="md:col-span-2 border-2 border-dashed border-primary-100 bg-primary-50/30 rounded-2xl p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-4">Logo Aplikasi & Favicon (Auto Compress
                        < 100KB)</label>
                            <div class="flex items-center gap-6">
                                <div
                                    class="relative w-20 h-20 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex items-center justify-center p-2 shrink-0">
                                    <template x-if="previewUrl">
                                        <img :src="previewUrl" class="w-full h-full object-contain">
                                    </template>
                                    <template x-if="!previewUrl">
                                        <img src="{{ asset('storage/logo.png') }}?v={{ time() }}"
                                            onerror="this.style.display='none'" class="w-full h-full object-contain">
                                    </template>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <input type="file" accept="image/png, image/jpeg, image/webp"
                                        @change="processImage($event)"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-primary-600 file:text-white hover:file:bg-primary-700 transition file:cursor-pointer truncate">
                                    <div x-show="isCompressing"
                                        class="mt-3 w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                                        <div class="bg-primary-600 h-2.5 rounded-full transition-all duration-300"
                                            :style="`width: ${progress}%`"></div>
                                    </div>
                                    <p x-show="isCompressing" class="text-xs mt-1 text-primary-600 font-medium">
                                        Memampatkan gambar... <span x-text="progress + '%'"></span></p>
                                    <p x-show="compressionResult && !isCompressing"
                                        class="text-[11px] mt-1 text-emerald-600 font-black tracking-wide"
                                        x-text="'Sukses: ' + compressionResult"></p>
                                </div>
                            </div>
                </div>

                <div x-data="imageUploader('new_banner_base64', 1200, 3.5)"
                    class="md:col-span-3 border-2 border-dashed border-primary-100 bg-primary-50/30 rounded-2xl p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-4">Banner Background Login & Dashboard
                        (Auto Crop Memanjang)</label>
                    <div class="flex flex-col md:flex-row items-center gap-6">
                        <div
                            class="relative w-full md:w-64 h-32 bg-gray-200 rounded-2xl shadow-inner border border-gray-300 overflow-hidden flex items-center justify-center shrink-0">
                            <template x-if="previewUrl">
                                <img :src="previewUrl" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!previewUrl">
                                <img src="{{ $existing_banner ? asset('storage/'.$existing_banner).'?v='.time() : '' }}"
                                    onerror="this.style.display='none'" class="w-full h-full object-cover">
                            </template>
                            <div x-show="!previewUrl && !'{{ $existing_banner }}'"
                                class="text-gray-400 font-bold text-xs uppercase tracking-widest absolute">Belum ada
                                banner</div>
                        </div>
                        <div class="flex-1 w-full min-w-0">
                            <input type="file" accept="image/png, image/jpeg, image/webp" @change="processImage($event)"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-primary-600 file:text-white hover:file:bg-primary-700 transition file:cursor-pointer truncate">
                            <div x-show="isCompressing"
                                class="mt-3 w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-primary-600 h-2.5 rounded-full transition-all duration-300"
                                    :style="`width: ${progress}%`"></div>
                            </div>
                            <p x-show="isCompressing" class="text-xs mt-1 text-primary-600 font-medium">Memotong &
                                Memampatkan Banner... <span x-text="progress + '%'"></span></p>
                            <p x-show="compressionResult && !isCompressing"
                                class="text-[11px] mt-1 text-emerald-600 font-black tracking-wide"
                                x-text="'Sukses: ' + compressionResult"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 md:p-10 rounded-[2rem] shadow-sm border border-primary-50 relative z-10 w-full">
            <div class="flex items-center gap-3 mb-8 border-b border-gray-100 pb-4">
                <div class="p-2 bg-amber-100 text-amber-700 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Sistem Multi-Tahun & Biaya</h3>
                    <p class="text-xs font-semibold text-gray-500 mt-1">Atur tahun aktif dan biaya patungan qurban</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="relative">
                    <input type="number" id="tahun" wire:model="tahun" min="2020" max="2099"
                        class="block px-4 py-3 w-full text-lg font-black text-primary-700 bg-primary-50 rounded-xl border-2 border-primary-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 peer transition-all text-center tracking-widest"
                        placeholder=" " />
                    <label for="tahun"
                        class="absolute text-sm font-bold text-primary-600 bg-primary-50 px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text rounded-md">
                        Tahun Aktif Aplikasi
                    </label>
                    <p class="text-[10px] text-gray-400 mt-2 font-semibold">Tahun berjalan untuk semua data baru.</p>
                </div>

                <div class="relative">
                    <input type="number" id="harga_patungan_tahun" wire:model="harga_patungan_tahun" min="2020"
                        max="2099"
                        class="block px-4 py-3 w-full text-lg font-black text-gray-700 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 peer transition-all text-center tracking-widest"
                        placeholder=" " />
                    <label for="harga_patungan_tahun"
                        class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">
                        Tahun Target Patungan
                    </label>
                    <p class="text-[10px] text-gray-400 mt-2 font-semibold">Berlaku untuk perhitungan biaya sapi.</p>
                </div>

                <div class="relative" x-data="{ 
                        rawPrice: @entangle('harga_patungan'), 
                        formattedPrice: '',
                        init() {
                            this.formatNumber();
                            this.$watch('rawPrice', value => { this.formatNumber(); });
                        },
                        formatNumber() {
                            if(!this.rawPrice) { this.formattedPrice = ''; return; }
                            this.formattedPrice = parseInt(this.rawPrice, 10).toLocaleString('id-ID');
                        },
                        updateRaw(event) {
                            let numericValue = event.target.value.replace(/[^0-9]/g, '');
                            event.target.value = numericValue ? parseInt(numericValue, 10).toLocaleString('id-ID') : '';
                            this.rawPrice = numericValue ? parseInt(numericValue, 10) : 0;
                        }
                    }">
                    <div class="flex items-center">
                        <span class="absolute left-4 font-black text-gray-400">Rp</span>
                        <input type="text" id="harga_patungan" x-bind:value="formattedPrice" @input="updateRaw($event)"
                            class="block pl-12 pr-4 py-3 w-full text-lg font-black text-emerald-600 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-emerald-500 peer transition-all"
                            placeholder="0" />
                    </div>
                    <label for="harga_patungan"
                        class="absolute text-sm text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-emerald-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">
                        Harga Patungan (1 Orang)
                    </label>
                    <p class="text-[10px] text-gray-400 mt-2 font-semibold">Otomatis diformat ribuan.</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 w-full">

            <div
                class="bg-white p-8 md:p-10 rounded-[2rem] shadow-sm border border-primary-50 relative z-10 w-full flex flex-col">
                <div class="flex items-center gap-3 mb-8 border-b border-gray-100 pb-4">
                    <div class="p-2 bg-indigo-100 text-indigo-700 rounded-xl shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Pejabat & Tanda Tangan</h3>
                        <p class="text-xs font-semibold text-gray-500 mt-1 line-clamp-1">Digunakan untuk pengesahan
                            Sertifikat</p>
                    </div>
                </div>

                <div class="space-y-8 flex-1">
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 shadow-inner">
                        <div class="relative mb-6">
                            <input type="text" id="nama_ketua_panitia" wire:model="nama_ketua_panitia"
                                class="block px-4 py-3 w-full text-sm font-bold text-gray-800 bg-white rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 peer transition-all"
                                placeholder=" " />
                            <label for="nama_ketua_panitia"
                                class="absolute text-sm font-bold text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">
                                Nama Ketua Panitia Qurban
                            </label>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase mb-3">Tanda Tangan
                                Panitia</label>
                            <div class="flex items-center gap-4">
                                @if ($ttd_panitia)
                                <img src="{{ $ttd_panitia->temporaryUrl() }}"
                                    class="w-16 h-16 object-contain rounded-xl border border-gray-200 shadow-sm bg-white p-1 shrink-0">
                                @elseif($existing_ttd_panitia)
                                <img src="{{ asset('storage/'.$existing_ttd_panitia) }}?v={{ time() }}"
                                    class="w-16 h-16 object-contain rounded-xl border border-gray-200 shadow-sm bg-white p-1 shrink-0">
                                @else
                                <div
                                    class="w-16 h-16 bg-white rounded-xl border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-300 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <input type="file" wire:model="ttd_panitia" accept="image/png, image/jpeg"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-wider file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200 cursor-pointer transition truncate">
                                    <div wire:loading wire:target="ttd_panitia"
                                        class="text-[10px] text-indigo-600 mt-2 font-bold animate-pulse">Sedang
                                        mengunggah...</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 shadow-inner">
                        <div class="relative mb-6">
                            <input type="text" id="nama_ketua_masjid" wire:model="nama_ketua_masjid"
                                class="block px-4 py-3 w-full text-sm font-bold text-gray-800 bg-white rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 peer transition-all"
                                placeholder=" " />
                            <label for="nama_ketua_masjid"
                                class="absolute text-sm font-bold text-gray-500 bg-white px-2 duration-300 transform -translate-y-1/2 scale-75 top-0 z-10 origin-[0] left-3 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:top-0 peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-75 cursor-text">
                                Nama Ketua DKM / Masjid
                            </label>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase mb-3">Tanda Tangan
                                DKM</label>
                            <div class="flex items-center gap-4">
                                @if ($ttd_masjid)
                                <img src="{{ $ttd_masjid->temporaryUrl() }}"
                                    class="w-16 h-16 object-contain rounded-xl border border-gray-200 shadow-sm bg-white p-1 shrink-0">
                                @elseif($existing_ttd_masjid)
                                <img src="{{ asset('storage/'.$existing_ttd_masjid) }}?v={{ time() }}"
                                    class="w-16 h-16 object-contain rounded-xl border border-gray-200 shadow-sm bg-white p-1 shrink-0">
                                @else
                                <div
                                    class="w-16 h-16 bg-white rounded-xl border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-300 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <input type="file" wire:model="ttd_masjid" accept="image/png, image/jpeg"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-wider file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200 cursor-pointer transition truncate">
                                    <div wire:loading wire:target="ttd_masjid"
                                        class="text-[10px] text-indigo-600 mt-2 font-bold animate-pulse">Sedang
                                        mengunggah...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-white p-8 md:p-10 rounded-[2rem] shadow-sm border border-primary-50 relative z-0 w-full flex flex-col">
                <div class="flex items-center gap-3 mb-8 border-b border-gray-100 pb-4">
                    <div class="p-2 bg-blue-100 text-blue-700 rounded-xl shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Notifikasi & Informasi</h3>
                        <p class="text-xs font-semibold text-gray-500 mt-1 line-clamp-1">Koneksi WA Gateway & Pop-up
                            warga</p>
                    </div>
                </div>

                <div class="space-y-8 flex-1">
                    <div x-data="{ show: false }">
                        <div class="flex justify-between items-center mb-3">
                            <label class="block text-sm font-semibold text-gray-700">Token Fonnte (WA Gateway)</label>
                            <label class="relative inline-flex items-center cursor-pointer shrink-0">
                                <input type="checkbox" wire:model="enable_wa" class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-500">
                                </div>
                                <span class="ml-2 text-xs font-bold text-gray-500">AKTIF</span>
                            </label>
                        </div>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" wire:model="fonnte_token"
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-transparent focus:bg-white focus:outline-none focus:ring-0 focus:border-primary-600 pr-12 transition">
                            <button type="button" @click="show = !show"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-primary-600">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <label class="block text-sm font-semibold text-gray-700">Teks Modal Pop-up (Untuk
                                Warga)</label>
                            <label class="relative inline-flex items-center cursor-pointer shrink-0">
                                <input type="checkbox" wire:model="enable_popup" class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500">
                                </div>
                                <span class="ml-2 text-xs font-bold text-gray-500">TAMPIL</span>
                            </label>
                        </div>
                        <textarea wire:model="popup_text" rows="5"
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-transparent focus:bg-white focus:outline-none focus:ring-0 focus:border-primary-600 transition"
                            placeholder="Tulis pengumuman penting di sini..."></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 md:p-10 rounded-[2rem] shadow-sm border border-primary-50 relative z-0 w-full">
            <div class="flex items-center gap-3 mb-8 border-b border-gray-100 pb-4">
                <div class="p-2 bg-purple-100 text-purple-700 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3m0 0l3-3m-3 3V8">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Halaman Statis Web</h3>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="mb-4" wire:ignore x-data x-init="
                    const qAbout = new Quill($refs.editorAbout, {
                        theme: 'snow',
                        placeholder: 'Tuliskan tentang masjid/panitia...',
                        modules: { toolbar: [['bold', 'italic', 'underline'], [{ 'list': 'ordered'}, { 'list': 'bullet' }], ['clean']] }
                    });
                    qAbout.root.innerHTML = $wire.get('about_us') || '';
                    qAbout.on('text-change', () => { $wire.set('about_us', qAbout.root.innerHTML, false); });
                ">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Tentang Kami (About Us)</label>
                    <div
                        class="border-2 border-gray-200 rounded-xl overflow-hidden focus-within:border-primary-600 transition-colors">
                        <div x-ref="editorAbout" class="bg-white h-48"></div>
                    </div>
                </div>

                <div class="mb-4" wire:ignore x-data x-init="
                    const qPrivacy = new Quill($refs.editorPrivacy, {
                        theme: 'snow',
                        placeholder: 'Tuliskan kebijakan privasi...',
                        modules: { toolbar: [['bold', 'italic', 'underline'], [{ 'list': 'ordered'}, { 'list': 'bullet' }], ['clean']] }
                    });
                    qPrivacy.root.innerHTML = $wire.get('privacy_policy') || '';
                    qPrivacy.on('text-change', () => { $wire.set('privacy_policy', qPrivacy.root.innerHTML, false); });
                ">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Kebijakan Privasi</label>
                    <div
                        class="border-2 border-gray-200 rounded-xl overflow-hidden focus-within:border-primary-600 transition-colors">
                        <div x-ref="editorPrivacy" class="bg-white h-48"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sticky bottom-6 z-50 flex justify-end">
            <button type="submit"
                class="w-full md:w-auto px-10 py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-2xl shadow-xl shadow-primary-900/20 transition transform hover:-translate-y-1 flex items-center justify-center gap-3">
                <svg wire:loading wire:target="save" class="animate-spin h-5 w-5 text-white" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <span wire:loading.remove wire:target="save">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                        </path>
                    </svg>
                </span>
                <span>Simpan Pengaturan</span>
            </button>
        </div>
    </form>

    @script
    <script>
        window.imageUploader = (livewireProperty, maxDimension = 400, targetRatio = null) => {
            return {
                isCompressing: false,
                progress: 0,
                previewUrl: null,
                compressionResult: '',
                
                processImage(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    // Hitung ukuran asli
                    let origSizeKB = file.size / 1024;
                    let origSizeStr = origSizeKB > 1024 ? (origSizeKB / 1024).toFixed(2) + 'MB' : origSizeKB.toFixed(2) + 'KB';

                    this.isCompressing = true;
                    this.progress = 10;
                    this.compressionResult = '';

                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = (e) => {
                        const img = new Image();
                        img.src = e.target.result;
                        img.onload = () => {
                            this.progress = 30;
                            const canvas = document.createElement('canvas');
                            const ctx = canvas.getContext('2d');
                            
                            // LOGIKA AUTO CROP (CENTER CROP)
                            let sourceX = 0, sourceY = 0;
                            let sourceWidth = img.width;
                            let sourceHeight = img.height;

                            if (targetRatio) {
                                const currentRatio = img.width / img.height;
                                if (currentRatio > targetRatio) {
                                    sourceWidth = img.height * targetRatio;
                                    sourceX = (img.width - sourceWidth) / 2;
                                } else {
                                    sourceHeight = img.width / targetRatio;
                                    sourceY = (img.height - sourceHeight) / 3; 
                                }
                            }
                            this.progress = 50;

                            let finalWidth = sourceWidth;
                            let finalHeight = sourceHeight;
                            
                            if (finalWidth > maxDimension) {
                                finalHeight *= maxDimension / finalWidth;
                                finalWidth = maxDimension;
                            }

                            canvas.width = finalWidth;
                            canvas.height = finalHeight;
                            
                            ctx.drawImage(img, sourceX, sourceY, sourceWidth, sourceHeight, 0, 0, finalWidth, finalHeight);
                            this.progress = 70;

                            let quality = 0.9;
                            let base64data = canvas.toDataURL('image/webp', quality);

                            // Paksa kompres sampai di bawah 100KB
                            while (Math.round((base64data.length - 814) / 1.37) > 100000 && quality > 0.1) {
                                quality -= 0.15;
                                base64data = canvas.toDataURL('image/webp', Math.max(quality, 0.1));
                            }

                            this.progress = 100;
                            this.previewUrl = base64data;
                            
                            let compSizeKB = Math.round((base64data.length - 814) / 1.37) / 1024;
                            this.compressionResult = origSizeStr + ' ➔ ' + compSizeKB.toFixed(2) + 'KB';
                            
                            $wire.set(livewireProperty, base64data);

                            setTimeout(() => { this.isCompressing = false; }, 800);
                        }
                    }
                }
            };
        };
    </script>
    @endscript

    <style>
        .ql-toolbar.ql-snow,
        .ql-container.ql-snow {
            border: none !important;
        }

        .ql-toolbar.ql-snow {
            border-bottom: 2px solid #e5e7eb !important;
            background-color: #f9fafb;
        }
    </style>
</div>