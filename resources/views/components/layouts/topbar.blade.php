@props(['title'])
@php
$user = auth()->user();
$avatarUrl = ($user->warga && $user->warga->path_img)
? asset('storage/' . $user->warga->path_img)
: 'https://ui-avatars.com/api/?name=' . urlencode($user->name ?? 'Admin') . '&background=0d9488&color=fff&bold=true';
@endphp

<header
  class="h-20 mt-4 mx-4 md:mx-6 lg:mx-8 bg-white/70 backdrop-blur-xl shadow-sm shadow-primary-900/5 rounded-[2rem] flex items-center justify-between px-6 z-10 border border-white">

  <div class="flex items-center gap-4">
    <button @click="sidebarOpen = !sidebarOpen"
      class="lg:hidden p-2 text-gray-600 bg-gray-100 rounded-xl hover:bg-primary-100 hover:text-primary-700 transition">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
      </svg>
    </button>

    <h2 x-data="{ pageTitle: '{{ $title ?? 'Dashboard' }}' }" x-init="
            if(document.title) pageTitle = document.title.split(' | ')[0];
            new MutationObserver(() => { 
                pageTitle = document.title.split(' | ')[0]; 
            }).observe(document.querySelector('title'), { childList: true });
        " x-text="pageTitle" class="font-bold text-2xl text-gray-800 tracking-tight hidden md:block">
      {{ $title ?? 'Dashboard' }}
    </h2>
  </div>

  <div class="flex items-center gap-4 md:gap-6">

    <div class="flex items-center gap-2 sm:gap-3 border-r border-gray-200 pr-3 sm:pr-6">

      <a href="/" target="_blank" title="Buka Halaman Utama"
        class="p-2 sm:p-2.5 text-gray-500 bg-gray-50 rounded-xl hover:bg-primary-50 hover:text-primary-600 transition-all duration-300 shadow-sm border border-gray-100 hover:-translate-y-0.5">
        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
          </path>
        </svg>
      </a>

      <a href="{{ route('live.tv') }}" target="_blank" title="Buka Live Display TV"
        class="relative p-2 sm:p-2.5 text-gray-500 bg-gray-50 rounded-xl hover:bg-red-50 hover:text-red-600 transition-all duration-300 shadow-sm border border-gray-100 hover:-translate-y-0.5 group">

        <span class="absolute -top-1 -right-1 flex h-2.5 w-2.5 sm:h-3 sm:w-3">
          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
          <span
            class="relative inline-flex rounded-full h-2.5 w-2.5 sm:h-3 sm:w-3 bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.8)]"></span>
        </span>

        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
          </path>
        </svg>
      </a>
    </div>

    {{-- Profile Dropdown --}}
    <div x-data="{ profileOpen: false }" class="relative flex items-center gap-4">

      <div class="hidden md:flex flex-col items-end">
        <span class="text-sm font-bold text-gray-800">{{ $user->name ?? 'Administrator' }}</span>
        <span class="text-xs text-primary-600 font-medium">{{ $user->roles->first()->name ?? 'Panitia' }}</span>
      </div>

      {{-- Avatar button --}}
      <button @click="profileOpen = !profileOpen" @click.outside="profileOpen = false"
        class="relative focus:outline-none group">
        <img src="{{ $avatarUrl }}" alt="Profile"
          class="h-11 w-11 rounded-full object-cover border-2 border-white shadow-sm ring-2 ring-primary-100 group-hover:ring-primary-400 transition-all">
        {{-- Indikator online --}}
        <span class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-400 border-2 border-white rounded-full"></span>
      </button>

      {{-- Dropdown Menu --}}
      <div x-show="profileOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 translate-y-1"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-1" style="display:none;"
        class="absolute right-0 top-14 w-56 bg-white rounded-2xl shadow-2xl border border-gray-100 z-50 overflow-hidden origin-top-right">

        {{-- Info User --}}
        <div class="px-4 py-3 bg-gray-50 border-b border-gray-100">
          <p class="text-xs text-gray-500">Login sebagai</p>
          <p class="font-black text-gray-800 text-sm truncate">{{ $user->name }}</p>
          <p class="text-[11px] text-primary-600 font-medium truncate">{{ $user->email }}</p>
        </div>

        {{-- Setting Profil --}}
        <button @click="profileOpen = false; $dispatch('open-profile-setting')"
          class="w-full flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition group">
          <span class="p-1.5 bg-gray-100 group-hover:bg-primary-100 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </span>
          <span class="font-semibold">Setting Profil</span>
        </button>

        <div class="border-t border-gray-100 mx-3"></div>

        {{-- Logout --}}
        <button @click="profileOpen = false; logoutModal = true"
          class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition group">
          <span class="p-1.5 bg-red-50 group-hover:bg-red-100 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
          </span>
          <span class="font-semibold">Keluar</span>
        </button>

      </div>
    </div>
  </div>
</header>