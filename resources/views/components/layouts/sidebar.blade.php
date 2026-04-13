<div x-show="sidebarOpen" style="display: none;" @click="sidebarOpen = false" x-transition.opacity
  class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-40 lg:hidden">
</div>

<aside :class="{'translate-x-0': sidebarOpen, '-translate-x-[150%]': !sidebarOpen}"
  class="fixed inset-y-0 left-0 z-50 w-72 m-4 transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 lg:m-4 flex flex-col bg-gradient-to-b from-primary-800 to-primary-950 text-white rounded-[2rem] shadow-2xl border border-primary-700/50 overflow-hidden">

  <div
    class="h-20 flex items-center justify-center gap-3 px-6 bg-primary-900/40 backdrop-blur-md border-b border-white/10">
    <img src="{{ asset('logo.png') }}" class="w-10 h-10 rounded-xl shadow-lg ring-2 ring-primary-500/50"
      onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($globalSettings['app_name'] ?? 'Qurban') }}&background=0d9488&color=fff'">
    <span class="font-bold text-xl tracking-wider truncate">{{ $globalSettings['app_name'] ?? 'QURBAN APP' }}</span>
    <button @click="sidebarOpen = false" class="lg:hidden absolute right-4 text-primary-300 hover:text-white">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>
  </div>

  <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto custom-scrollbar">
    <a href="{{ route('admin.dashboard') }}" wire:navigate
      class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
      <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-primary-400' : 'text-primary-300' }}"
        fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
        </path>
      </svg>
      <span class="font-medium">Dashboard</span>
    </a>

    <a href="{{ route('admin.warga') }}" wire:navigate
      class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.warga') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
      <svg class="w-5 h-5 {{ request()->routeIs('admin.warga') ? 'text-primary-400' : 'text-primary-300' }}" fill="none"
        stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
        </path>
      </svg>
      <span class="font-medium">Data Warga</span>
    </a>

    <a href="{{ route('admin.rw') }}" wire:navigate
      class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.rw') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
      <svg class="w-5 h-5 {{ request()->routeIs('admin.rw') ? 'text-primary-400' : 'text-primary-300' }}" fill="none"
        stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
        </path>
      </svg>
      <span class="font-medium">Data RW</span>
    </a>

    <a href="{{ route('admin.rt') }}" wire:navigate
      class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.rt') ? 'bg-white/10 text-primary-50 shadow-inner border border-white/5 backdrop-blur-sm' : 'hover:bg-white/5 text-primary-100 hover:text-white' }}">
      <svg class="w-5 h-5 {{ request()->routeIs('admin.rt') ? 'text-primary-400' : 'text-primary-300' }}" fill="none"
        stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
        </path>
      </svg>
      <span class="font-medium">Data RT</span>
    </a>

    <div class="pt-4 mt-4 border-t border-white/10">
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
          <span class="font-medium">Pengaturan</span>
        </div>
        <span
          class="text-[10px] {{ request()->routeIs('admin.settings') ? 'bg-amber-400 text-amber-900' : 'bg-amber-500/20 text-amber-400' }} font-bold px-2 py-1 rounded-lg">ADMIN</span>
      </a>
    </div>
  </nav>
</aside>