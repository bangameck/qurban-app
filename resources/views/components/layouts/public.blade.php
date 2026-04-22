<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ $faviconUrl }}">
    <title>{{ $title ?? 'Kupon Qurban' }} | {{ $globalSettings['app_name'] ?? 'Qurban App' }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    @php
        // Logika Dynamic Theme
        $theme = $globalSettings['theme_color'] ?? 'emerald';
        $palettes = [
            'emerald' => ['50'=>'#ecfdf5','100'=>'#d1fae5','200'=>'#a7f3d0','300'=>'#6ee7b7','400'=>'#34d399','500'=>'#10b981','600'=>'#059669','700'=>'#047857','800'=>'#065f46','900'=>'#064e3b','950'=>'#022c22'],
            'blue'    => ['50'=>'#eff6ff','100'=>'#dbeafe','200'=>'#bfdbfe','300'=>'#93c5fd','400'=>'#60a5fa','500'=>'#3b82f6','600'=>'#2563eb','700'=>'#1d4ed8','800'=>'#1e40af','900'=>'#1e3a8a','950'=>'#172554'],
            'rose'    => ['50'=>'#fff1f2','100'=>'#ffe4e6','200'=>'#fecdd3','300'=>'#fda4af','400'=>'#fb7185','500'=>'#f43f5e','600'=>'#e11d48','700'=>'#be123c','800'=>'#9f1239','900'=>'#881337','950'=>'#4c0519'],
            'amber'   => ['50'=>'#fffbeb','100'=>'#fef3c7','200'=>'#fde68a','300'=>'#fcd34d','400'=>'#fbbf24','500'=>'#f59e0b','600'=>'#d97706','700'=>'#b45309','800'=>'#92400e','900'=>'#78350f','950'=>'#451a03'],
        ];
        $active = $palettes[$theme] ?? $palettes['emerald'];
    @endphp

    <style>
        :root {
            --color-primary-50: {{ $active['50'] }};
            --color-primary-100: {{ $active['100'] }};
            --color-primary-200: {{ $active['200'] }};
            --color-primary-300: {{ $active['300'] }};
            --color-primary-400: {{ $active['400'] }};
            --color-primary-500: {{ $active['500'] }};
            --color-primary-600: {{ $active['600'] }};
            --color-primary-700: {{ $active['700'] }};
            --color-primary-800: {{ $active['800'] }};
            --color-primary-900: {{ $active['900'] }};
            --color-primary-950: {{ $active['950'] }};
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased flex flex-col min-h-screen selection:bg-primary-500 selection:text-white relative">

    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full blur-[120px] opacity-30" style="background-color: var(--color-primary-400);"></div>
        <div class="absolute top-[20%] -right-[10%] w-[40%] h-[50%] rounded-full blur-[100px] opacity-20" style="background-color: var(--color-primary-600);"></div>
        <div class="absolute -bottom-[20%] left-[20%] w-[60%] h-[60%] rounded-full blur-[150px] opacity-20 bg-blue-400"></div>
    </div>

    <header x-data="{ mobileMenuOpen: false }" class="fixed top-0 left-0 w-full z-50 transition-all duration-300 shadow-sm border-b" style="border-color: var(--color-primary-200);">
    <div class="absolute inset-0 backdrop-blur-xl" style="background-color: var(--color-primary-50); opacity: 0.85;"></div>
    
    <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        
       <a wire:navigate href="/" class="flex items-center gap-3 shrink-0 group hover:opacity-90 transition-opacity duration-300">
            @if ($logoUrl)
                <img src="{{ $logoUrl }}?v={{ time() }}" alt="Logo App" class="w-10 h-10 object-contain drop-shadow-sm group-hover:scale-105 transition-transform duration-300">
            @else
                <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-inner text-white group-hover:scale-105 transition-transform duration-300" style="background-color: var(--color-primary-600);">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                </div>
            @endif
            <div>
                <h1 class="text-lg font-black tracking-tight text-gray-900 leading-none">{{ $globalSettings['app_name'] ?? 'Qurban App' }}</h1>
                <p class="text-[10px] font-bold uppercase tracking-wider mt-0.5" style="color: var(--color-primary-700);">Sistem Informasi Qurban</p>
            </div>
        </a>

        <nav class="hidden md:flex flex-1 items-center justify-center gap-8">
            <a wire:navigate href="{{ route('public.mudhohi') }}" 
               class="text-sm font-black uppercase tracking-wider transition-all duration-300 {{ request()->routeIs('public.mudhohi') ? 'border-b-2 pb-1' : 'text-gray-500 hover:text-gray-900' }}"
               style="{{ request()->routeIs('public.mudhohi') ? 'color: var(--color-primary-700); border-color: var(--color-primary-500);' : '' }}">
                Peserta Qurban
            </a>
            
            <a wire:navigate href="/live-tv" 
               class="flex items-center gap-2 text-sm font-black uppercase tracking-wider transition-all duration-300 {{ request()->is('live-tv') ? 'border-b-2 pb-1' : 'text-gray-500 hover:text-gray-900' }}"
               style="{{ request()->is('live-tv') ? 'color: var(--color-primary-700); border-color: var(--color-primary-500);' : '' }}">
                <span class="relative flex h-2.5 w-2.5">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.8)]"></span>
                </span>
                Live TV
            </a>
        </nav>

        <div class="flex items-center gap-3 shrink-0">
            
            <div class="hidden sm:block">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-200 text-gray-800 font-bold text-xs uppercase tracking-wide rounded-xl shadow-sm transition transform hover:-translate-y-0.5 hover:shadow-md hover:border-primary-300">
                        <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard Panitia
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-900 hover:bg-black text-white font-bold text-xs uppercase tracking-wide rounded-xl shadow-lg transition transform hover:-translate-y-0.5 shadow-gray-900/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        Login Panitia
                    </a>
                @endauth
            </div>

            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-xl bg-white/50 text-gray-700 hover:text-primary-700 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary-500/20 transition-colors">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                <svg x-show="mobileMenuOpen" style="display: none;" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

        </div>
    </div>

    <div x-show="mobileMenuOpen" x-transition.opacity.duration.200ms style="display: none;" class="md:hidden absolute top-[100%] left-0 w-full bg-white/95 backdrop-blur-xl border-b border-gray-200 shadow-2xl">
        <div class="px-4 py-6 space-y-3">
            <a wire:navigate href="{{ route('public.mudhohi') }}" 
               class="block px-5 py-3.5 rounded-2xl text-sm font-black uppercase tracking-wider transition-colors {{ request()->routeIs('public.mudhohi') ? 'bg-primary-50 text-primary-700' : 'text-gray-600 hover:bg-gray-50' }}">
                Peserta Qurban
            </a>
            <a wire:navigate href="/live-tv" 
               class="flex items-center gap-3 px-5 py-3.5 rounded-2xl text-sm font-black uppercase tracking-wider transition-colors {{ request()->is('live-tv') ? 'bg-primary-50 text-primary-700' : 'text-gray-600 hover:bg-gray-50' }}">
                <span class="relative flex h-2.5 w-2.5">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                </span>
                Live TV
            </a>
            
            <div class="pt-4 mt-2 border-t border-gray-100 sm:hidden">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center gap-2 w-full px-5 py-3.5 bg-white border-2 border-gray-200 text-gray-800 font-bold text-sm uppercase tracking-wide rounded-2xl">
                        Dashboard Panitia
                    </a>
                @else
                    <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full px-5 py-3.5 bg-gray-900 text-white font-bold text-sm uppercase tracking-wide rounded-2xl shadow-lg">
                        Login Panitia
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

    <main class="flex-grow pt-28 pb-12 px-4 relative z-10 flex flex-col justify-center">
        {{ $slot }}
    </main>

    <footer class="relative z-10 py-6 border-t" style="background-color: var(--color-primary-50); border-color: var(--color-primary-100);">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <p class="text-xs font-bold" style="color: var(--color-primary-700);">
                &copy; {{ date('Y') }} {{ $globalSettings['app_name'] ?? 'Qurban App' }}. All rights reserved.
            </p>
            <p class="text-[10px] mt-1" style="color: var(--color-primary-600);">Dibangun dengan ❤️ untuk kelancaran ibadah qurban.</p>
        </div>
    </footer>

    @livewireScripts
</body>

</html>