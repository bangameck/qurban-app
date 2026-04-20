<div class="bg-white p-8 rounded-3xl shadow-2xl border border-gray-100 relative z-10 overflow-hidden">

    @if(!empty($globalSettings['banner_image']) && file_exists(public_path('storage/'.$globalSettings['banner_image'])))
    <div class="absolute -top-10 -right-10 w-64 h-64 z-0 pointer-events-none opacity-[0.15]"
        style="mask-image: radial-gradient(circle at top right, black, transparent 70%); -webkit-mask-image: radial-gradient(circle at top right, black, transparent 70%);">
        <img src="{{ asset('storage/'.$globalSettings['banner_image']) }}?v={{ time() }}" alt="Watermark Banner"
            class="w-full h-full object-cover rounded-bl-full">
    </div>
    @endif

    <div class="text-center mb-8 flex flex-col items-center relative z-10">
        @if ($logoUrl)
        <div class="mb-4">
            <img src="{{ $logoUrl }}?v={{ time() }}" alt="Logo App"
                class="w-20 h-auto object-contain mx-auto drop-shadow-sm">
        </div>
        @else
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4 shadow-inner"
            style="background-color: var(--color-primary-100); color: var(--color-primary-700);">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
            </svg>
        </div>
        @endif

        <h2 class="text-2xl font-bold text-gray-800">{{ $globalSettings['login_greeting'] ?? 'Masuk Akun' }}</h2>
        <p class="text-gray-500 mt-2 font-medium">{{ $globalSettings['app_name'] ?? 'Sistem Informasi Manajemen Qurban'
            }}</p>
    </div>

    <form wire:submit="authenticate" class="space-y-5 relative z-10">

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                        </path>
                    </svg>
                </span>
                <input type="text" inputmode="numeric" wire:model="phone_number"
                    oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 0 && this.value[0] !== '0') this.value = '0' + this.value;"
                    class="w-full pl-11 pr-4 py-3 rounded-xl border-2 @error('phone_number') border-red-500 @else border-gray-200 @enderror bg-gray-50 focus:bg-white focus:ring-0 outline-none transition-all"
                    style="--tw-ring-color: var(--color-primary-500); border-color: var(--color-primary-500);"
                    placeholder="Contoh: 081234567890">
            </div>
            @error('phone_number') <span class="text-red-500 text-sm mt-1 block font-bold">{{ $message }}</span>
            @enderror
        </div>

        <div x-data="{ show: false }">
            <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                </span>

                <input :type="show ? 'text' : 'password'" wire:model="password"
                    class="w-full pl-11 pr-12 py-3 rounded-xl border-2 @error('password') border-red-500 @else border-gray-200 @enderror bg-gray-50 focus:bg-white focus:ring-0 outline-none transition-all"
                    style="--tw-ring-color: var(--color-primary-500); border-color: var(--color-primary-500);"
                    placeholder="••••••••">

                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-700 focus:outline-none transition">
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                    <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                        </path>
                    </svg>
                </button>
            </div>
            @error('password') <span class="text-red-500 text-sm mt-1 block font-bold">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
            class="w-full text-white font-bold py-3 rounded-xl transition transform hover:-translate-y-0.5 shadow-lg mt-6 flex justify-center items-center gap-2"
            style="background-color: var(--color-primary-600);">

            <span wire:loading.remove wire:target="authenticate">Masuk Sekarang</span>
            <span wire:loading wire:target="authenticate" class="flex items-center gap-2">
                <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                Memeriksa Akses...
            </span>
        </button>
    </form>
</div>