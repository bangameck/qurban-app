<div x-show="sidebarOpen" style="display: none;" @click="sidebarOpen = false" x-transition.opacity
  class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-40 lg:hidden">
</div>

<aside :class="{'translate-x-0': sidebarOpen, '-translate-x-[150%]': !sidebarOpen}"
  class="fixed inset-y-0 left-0 z-50 w-72 m-4 transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 lg:m-4 flex flex-col bg-gradient-to-b from-primary-800 to-primary-950 text-white rounded-[2rem] shadow-2xl border border-primary-700/50 overflow-hidden">

  <div
    class="h-20 flex items-center justify-center gap-3 px-6 bg-primary-900/40 backdrop-blur-md border-b border-white/10 shrink-0 relative z-10">
    <img src="{{ asset('logo.png') }}" class="w-10 h-10 rounded-xl shadow-lg ring-2 ring-primary-500/50"
      onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($globalSettings['app_name'] ?? 'Qurban') }}&background=0d9488&color=fff'">
    <span class="font-bold text-xl tracking-wider truncate">{{ $globalSettings['app_name'] ?? 'QURBAN APP' }}</span>
    <button @click="sidebarOpen = false"
      class="lg:hidden absolute right-4 p-2 bg-white/10 rounded-xl text-primary-200 hover:text-white hover:bg-white/20 transition">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>
  </div>

  <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto custom-scrollbar relative z-0 pr-2">

    <a href="{{ route('admin.dashboard') }}" wire:navigate
      class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
      <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-primary-400' : 'text-primary-300' }}"
        fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
        </path>
      </svg>
      <span class="font-medium text-sm">Dashboard</span>
    </a>

    <div class="pt-5 pb-2">
      <p class="px-4 text-[10px] font-black tracking-widest text-primary-300/50 uppercase">Data Master</p>
    </div>
    <a href="{{ route('admin.warga') }}" wire:navigate
      class="flex items-center gap-3 px-4 py-2.5 rounded-2xl transition {{ request()->routeIs('admin.warga') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
      <svg class="w-5 h-5 {{ request()->routeIs('admin.warga') ? 'text-primary-400' : 'text-primary-300' }}" fill="none"
        stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
        </path>
      </svg>
      <span class="font-medium text-sm">Data Warga</span>
    </a>
    <a href="{{ route('admin.panitia') }}" wire:navigate
      class="flex items-center gap-3 px-4 py-2.5 rounded-2xl transition {{ request()->routeIs('admin.panitia') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
      <svg class="w-5 h-5 {{ request()->routeIs('admin.panitia') ? 'text-primary-400' : 'text-primary-300' }}"
        fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
        </path>
      </svg>
      <span class="font-medium text-sm">Tim Panitia</span>
    </a>
    <a href="{{ route('admin.rw') }}" wire:navigate
      class="flex items-center gap-3 px-4 py-2.5 rounded-2xl transition {{ request()->routeIs('admin.rw') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
      <svg class="w-5 h-5 {{ request()->routeIs('admin.rw') ? 'text-primary-400' : 'text-primary-300' }}" fill="none"
        stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
        </path>
      </svg>
      <span class="font-medium text-sm">Area RW</span>
    </a>
    <a href="{{ route('admin.rt') }}" wire:navigate
      class="flex items-center gap-3 px-4 py-2.5 rounded-2xl transition {{ request()->routeIs('admin.rt') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
      <svg class="w-5 h-5 {{ request()->routeIs('admin.rt') ? 'text-primary-400' : 'text-primary-300' }}" fill="none"
        stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
        </path>
      </svg>
      <span class="font-medium text-sm">Area RT</span>
    </a>

    <div class="pt-5 pb-2">
      <p class="px-4 text-[10px] font-black tracking-widest text-primary-300/50 uppercase">Manajemen Qurban</p>
    </div>
    <a href="{{ route('admin.mudhohi') }}" wire:navigate
      class="flex items-center gap-3 px-4 py-2.5 rounded-2xl transition {{ request()->routeIs('admin.mudhohi') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
      <svg class="w-5 h-5 {{ request()->routeIs('admin.mudhohi') ? 'text-primary-400' : 'text-primary-300' }}"
        fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
      </svg>
      <span class="font-medium text-sm">Pendaftar (Mudhohi)</span>
    </a>
    <a href="{{ route('admin.sapi') }}" wire:navigate
      class="flex items-center gap-3 px-4 py-2.5 rounded-2xl transition {{ request()->routeIs('admin.sapi') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
      <svg class="w-5 h-5 {{ request()->routeIs('admin.sapi') ? 'text-primary-400' : 'text-primary-300' }}" fill="none"
        stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z">
        </path>
      </svg>
      <span class="font-medium text-sm">Data Sapi</span>
    </a>
    <a href="{{ route('admin.kelompok-sapi') }}" wire:navigate
      class="flex items-center gap-3 px-4 py-2.5 rounded-2xl transition {{ request()->routeIs('admin.kelompok-sapi') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
      <svg class="w-5 h-5 {{ request()->routeIs('admin.kelompok-sapi') ? 'text-primary-400' : 'text-primary-300' }}"
        fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
        </path>
      </svg>
      <span class="font-medium text-sm">Kelompok Sapi</span>
    </a>

    <div class="pt-5 pb-2">
      <p class="px-4 text-[10px] font-black tracking-widest text-primary-300/50 uppercase">Distribusi Daging</p>
    </div>
    <a href="{{ route('admin.mustahiq') }}" wire:navigate
      class="flex items-center gap-3 px-4 py-2.5 rounded-2xl transition {{ request()->routeIs('admin.mustahiq') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
      <svg class="w-5 h-5 {{ request()->routeIs('admin.mustahiq') ? 'text-primary-400' : 'text-primary-300' }}"
        fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
        </path>
      </svg>
      <span class="font-medium text-sm">Penerima (Mustahiq)</span>
    </a>
    <a href="{{ route('admin.distribusi') }}" wire:navigate
      class="flex items-center gap-3 px-4 py-2.5 rounded-2xl transition {{ request()->routeIs('admin.distribusi') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
      <svg class="w-5 h-5 {{ request()->routeIs('admin.distribusi') ? 'text-primary-400' : 'text-primary-300' }}"
        fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      <span class="font-medium text-sm">Sesi Distribusi</span>
    </a>

    <div class="pt-5 pb-2">
      <p class="px-4 text-[10px] font-black tracking-widest text-primary-300/50 uppercase">Laporan & Kupon</p>
    </div>
    <a href="{{ route('admin.laporan.panitia') }}" wire:navigate
      class="flex items-center gap-3 px-4 py-2.5 rounded-2xl transition {{ request()->routeIs('admin.laporan.panitia') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
      <svg class="w-5 h-5 {{ request()->routeIs('admin.laporan.panitia') ? 'text-primary-400' : 'text-primary-300' }}"
        fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
        </path>
      </svg>
      <span class="font-medium text-sm">Laporan Panitia</span>
    </a>
    <a href="{{ route('admin.laporan.mudhohi') }}" wire:navigate
      class="flex items-center gap-3 px-4 py-2.5 rounded-2xl transition {{ request()->routeIs('admin.laporan.mudhohi') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
      <svg class="w-5 h-5 {{ request()->routeIs('admin.laporan.mudhohi') ? 'text-primary-400' : 'text-primary-300' }}"
        fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
        </path>
      </svg>
      <span class="font-medium text-sm">Laporan Mudhohi</span>
    </a>
    <a href="{{ route('admin.laporan.mustahiq') }}" wire:navigate
      class="flex items-center gap-3 px-4 py-2.5 rounded-2xl transition {{ request()->routeIs('admin.laporan.mustahiq') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
      <svg class="w-5 h-5 {{ request()->routeIs('admin.laporan.mustahiq') ? 'text-primary-400' : 'text-primary-300' }}"
        fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
        </path>
      </svg>
      <span class="font-medium text-sm">Laporan Mustahiq</span>
    </a>

    <div class="pt-6 mt-4 border-t border-white/10">
      <p class="px-4 text-[10px] font-black tracking-widest text-primary-300/50 uppercase mb-2">Operasional</p>

      <a href="{{ route('live.tv') }}" wire:navigate
        class="flex justify-between items-center px-4 py-3 rounded-2xl transition {{ request()->routeIs('live.tv') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
        <div class="flex items-center gap-3">
          <svg class="w-5 h-5 {{ request()->routeIs('live.tv') ? 'text-primary-400' : 'text-primary-300' }}" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125Z" />
          </svg>
          <span class="font-medium text-sm">Live Display</span>
        </div>
        <span
          class="text-[9px] {{ request()->routeIs('admin.scanner') ? 'bg-amber-400 text-amber-900' : 'bg-amber-500/20 text-amber-400' }} font-bold px-2 py-1 rounded-lg">ADMIN</span>
      </a>

      <a href="{{ route('admin.scanner') }}" wire:navigate
        class="flex justify-between items-center px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.scanner') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
        <div class="flex items-center gap-3">
          <svg class="w-5 h-5 {{ request()->routeIs('admin.scanner') ? 'text-primary-400' : 'text-primary-300' }}"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
          </svg>
          <span class="font-medium text-sm">Scan Kupon</span>
        </div>
        <span
          class="text-[9px] {{ request()->routeIs('admin.scanner') ? 'bg-amber-400 text-amber-900' : 'bg-amber-500/20 text-amber-400' }} font-bold px-2 py-1 rounded-lg">ADMIN</span>
      </a>

      <a href="{{ route('admin.settings') }}" wire:navigate
        class="flex justify-between items-center px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.settings') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
        <div class="flex items-center gap-3">
          <svg class="w-5 h-5 {{ request()->routeIs('admin.settings') ? 'text-primary-400' : 'text-primary-300' }}"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
            </path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
            </path>
          </svg>
          <span class="font-medium text-sm">Pengaturan</span>
        </div>
        <span
          class="text-[9px] {{ request()->routeIs('admin.settings') ? 'bg-amber-400 text-amber-900' : 'bg-amber-500/20 text-amber-400' }} font-bold px-2 py-1 rounded-lg">ADMIN</span>
      </a>
    </div>
  </nav>
</aside>

<style>
  /* Webkit Browsers (Chrome, Safari, Edge) */
  .custom-scrollbar::-webkit-scrollbar {
    width: 6px;
  }

  .custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.02);
    border-radius: 10px;
    margin-top: 10px;
    margin-bottom: 10px;
  }

  .custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.15);
    border-radius: 10px;
  }

  .custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.3);
  }

  /* Firefox */
  .custom-scrollbar {
    scrollbar-width: thin;
    scrollbar-color: rgba(255, 255, 255, 0.15) rgba(255, 255, 255, 0.02);
  }
</style>