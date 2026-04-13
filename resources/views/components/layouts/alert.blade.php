<div x-show="islandVisible" style="display: none;" x-transition:enter="transition ease-out duration-300"
  x-transition:enter-start="opacity-0 transform -translate-y-10 scale-90"
  x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
  x-transition:leave="transition ease-in duration-200"
  x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
  x-transition:leave-end="opacity-0 transform -translate-y-10 scale-90"
  class="fixed top-6 left-1/2 transform -translate-x-1/2 z-[100] flex items-center gap-3 px-6 py-3 bg-black/90 backdrop-blur-md text-white rounded-full shadow-2xl">
  <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
  </svg>
  <span class="font-medium text-sm tracking-wide" x-text="islandMessage"></span>
</div>

<div class="fixed bottom-6 right-6 z-[100] flex flex-col gap-3 pointer-events-none">
  <template x-for="toast in toasts" :key="toast.id">
    <div x-show="true" x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0 transform translate-x-10"
      x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-200"
      x-transition:leave-start="opacity-100 transform translate-x-0"
      x-transition:leave-end="opacity-0 transform translate-x-10"
      class="pointer-events-auto flex items-start gap-3 w-80 p-4 bg-white border-l-4 border-red-500 rounded-xl shadow-xl">
      <svg class="w-6 h-6 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      <div class="flex-1">
        <h4 class="font-bold text-gray-800 text-sm">Gagal!</h4>
        <p class="text-xs text-gray-600 mt-1" x-text="toast.message"></p>
      </div>
      <button @click="removeToast(toast.id)" class="text-gray-400 hover:text-red-500">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
  </template>
</div>