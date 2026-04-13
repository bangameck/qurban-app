@php
$user = auth()->user();
// Logic Avatar: Jika punya relasi warga & ada path_img, pakai storage. Jika tidak, pakai UI Avatar.
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
    <h2 class="font-bold text-2xl text-gray-800 tracking-tight hidden md:block">{{ $title ?? 'Dashboard' }}</h2>
  </div>

  <div class="flex items-center gap-4">
    <div class="flex flex-col items-end">
      <span class="text-sm font-bold text-gray-800">{{ $user->name ?? 'Administrator' }}</span>
      <span class="text-xs text-primary-600 font-medium">{{ $user->roles->first()->name ?? 'Panitia' }}</span>
    </div>

    <img src="{{ $avatarUrl }}" alt="Profile"
      class="h-11 w-11 rounded-full object-cover border-2 border-white shadow-sm ring-2 ring-primary-100">

    <div class="w-px h-8 bg-gray-200 mx-2 hidden md:block"></div>

    <button @click="logoutModal = true" type="button"
      class="p-2.5 text-red-400 bg-red-50 rounded-xl hover:bg-red-500 hover:text-white transition group shadow-sm"
      title="Logout">
      <svg class="w-5 h-5 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
      </svg>
    </button>
  </div>
</header>