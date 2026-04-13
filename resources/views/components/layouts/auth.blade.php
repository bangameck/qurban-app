<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>{{ $title ?? ($globalSettings['app_name'] ?? 'Login | Qurban App') }}</title>
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
        /* Override Root Variables Tailwind */
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

<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex items-center justify-center relative overflow-hidden">
    
    <div class="absolute top-0 left-0 w-full h-[400px] rounded-b-[100px] z-0 shadow-lg" style="background-color: var(--color-primary-700);"></div>

    <div class="absolute top-10 left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl z-0"></div>
    <div class="absolute top-40 right-20 w-48 h-48 bg-black/10 rounded-full blur-3xl z-0"></div>

    <div class="z-10 w-full max-w-md px-6">
        {{ $slot }}
    </div>

    @livewireScripts
</body>

</html>