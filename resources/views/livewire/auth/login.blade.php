<div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
    <div class="text-center mb-8">
        <div
            class="inline-flex items-center justify-center w-16 h-16 bg-emerald-100 text-emerald-700 rounded-full mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-gray-800">Masuk Akun</h2>
        <p class="text-gray-500 mt-2">Sistem Informasi Manajemen Qurban</p>
    </div>

    <form wire:submit="authenticate" class="space-y-5">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Email</label>
            <input type="email" wire:model="email"
                class="w-full px-4 py-3 rounded-xl border @error('email') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"
                placeholder="admin@qurbanapp.com">
            @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
            <input type="password" wire:model="password"
                class="w-full px-4 py-3 rounded-xl border @error('password') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"
                placeholder="••••••••">
            @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
            class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-emerald-200 mt-4 flex justify-center items-center gap-2">

            <span wire:loading.remove wire:target="authenticate">Masuk Sekarang</span>
            <span wire:loading wire:target="authenticate">Memeriksa...</span>
        </button>
    </form>
</div>