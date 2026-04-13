<footer
  class="mt-4 mx-4 md:mx-6 lg:mx-8 mb-4 bg-white/70 backdrop-blur-xl shadow-sm border border-white rounded-2xl p-4 flex flex-col md:flex-row items-center justify-between text-sm text-gray-500 z-10">
  <div>
    &copy; {{ date('Y') }} <span class="font-bold text-primary-700">{{ $globalSettings['app_name'] ?? 'Qurban App'
      }}</span>. All rights reserved.
  </div>
  <div class="mt-2 md:mt-0 flex gap-4">
    <a href="#" class="hover:text-primary-600 transition">Tentang Kami</a>
    <a href="#" class="hover:text-primary-600 transition">Kebijakan Privasi</a>
  </div>
</footer>