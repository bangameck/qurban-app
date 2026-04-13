<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Login | Qurban App' }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>

<body
  class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex items-center justify-center relative overflow-hidden">
  <div class="absolute top-0 left-0 w-full h-96 bg-emerald-700 rounded-b-[100px] z-0"></div>

  <div class="z-10 w-full max-w-md px-6">
    {{ $slot }}
  </div>

  @livewireScripts
</body>

</html>