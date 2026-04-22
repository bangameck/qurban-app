<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ $faviconUrl }}">
    <title>{{ $title ?? 'Dashboard' }} | {{ $globalSettings['app_name'] ?? 'Qurban App' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    
    @php
        $theme = $globalSettings['theme_color'] ?? 'emerald';
        $palettes = [
            'emerald' => ['50'=>'#ecfdf5','100'=>'#d1fae5','200'=>'#a7f3d0','300'=>'#6ee7b7','400'=>'#34d399','500'=>'#10b981','600'=>'#059669','700'=>'#047857','800'=>'#065f46','900'=>'#064e3b','950'=>'#022c22'],
            'blue'    => ['50'=>'#eff6ff','100'=>'#dbeafe','200'=>'#bfdbfe','300'=>'#93c5fd','400'=>'#60a5fa','500'=>'#3b82f6','600'=>'#2563eb','700'=>'#1d4ed8','800'=>'#1e40af','900'=>'#1e3a8a','950'=>'#172554'],
            'rose'    => ['50'=>'#fff1f2','100'=>'#ffe4e6','200'=>'#fecdd3','300'=>'#fda4af','400'=>'#fb7185','500'=>'#f43f5e','600'=>'#e11d48','700'=>'#be123c','800'=>'#9f1239','900'=>'#881337','950'=>'#4c0519'],
            'amber'   => ['50'=>'#fffbeb','100'=>'#fef3c7','200'=>'#fde68a','300'=>'#fcd34d','400'=>'#fbbf24','500'=>'#f59e0b','600'=>'#d97706','700'=>'#b45309','800'=>'#92400e','900'=>'#78350f','950'=>'#451a03'],
        ];
        $active = $palettes[$theme];
    @endphp

    <style>
        /* Meng-override root variables Tailwind dengan Hex dari Database */
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

<body class="bg-[#f4f7f6] text-gray-800 font-sans antialiased overflow-hidden"
    x-data="{ sidebarOpen: false, logoutModal: false, ...notificationSystem() }">

    <div class="flex h-screen w-full relative">
        @include('components.layouts.sidebar')

        <div class="flex-1 flex flex-col h-screen overflow-hidden transition-all duration-300 relative z-0">
           @include('components.layouts.topbar', ['title' => $title ?? 'Dashboard'])
            @livewire('admin.profile-setting')

            <main class="flex-1 flex flex-col overflow-x-hidden overflow-y-auto">
                <div class="p-4 md:p-6 lg:p-8 flex-1 relative">
                    
                    {{ $slot }}

                </div>
                
                @include('components.layouts.footer')
            </main>
        </div>
    </div>

    <div x-show="logoutModal" style="display: none;" class="relative z-[200]" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div x-show="logoutModal" x-transition.opacity
            class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="logoutModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    @click.away="logoutModal = false"
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl border border-gray-100 transition-all sm:my-8 sm:w-full sm:max-w-md">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-bold leading-6 text-gray-900" id="modal-title">Konfirmasi Keluar
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Apakah Anda yakin ingin keluar dari aplikasi? Anda
                                        harus login kembali untuk mengakses sistem.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <form action="{{ route('logout') }}" method="POST" class="inline-block w-full sm:w-auto">
                            @csrf
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-xl bg-red-600 px-4 py-2 text-sm font-bold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto transition">Ya,
                                Keluar</button>
                        </form>
                        <button type="button" @click="logoutModal = false"
                            class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.layouts.alert')

    @livewireScripts
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        function notificationSystem() {
            return {
                islandVisible: false, islandMessage: '', toasts: [],
                init() {
                    window.addEventListener('notify-success', (e) => {
                        this.islandMessage = e.detail[0] || e.detail;
                        this.islandVisible = true; setTimeout(() => { this.islandVisible = false; }, 3500);
                    });
                    window.addEventListener('notify-error', (e) => {
                        const id = Date.now() + Math.random();
                        this.toasts.push({ id: id, message: e.detail[0] || e.detail });
                        setTimeout(() => { this.removeToast(id); }, 5000);
                    });
                },
                removeToast(id) { this.toasts = this.toasts.filter(t => t.id !== id); }
            }
        }
    </script>
    @stack('scripts')
</body>

</html>