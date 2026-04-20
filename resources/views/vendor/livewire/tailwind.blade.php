@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div class="py-4">
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
            {{-- Mobile View --}}
            <div class="flex justify-between flex-1 sm:hidden">
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-bold text-gray-400 bg-gray-50 border border-gray-200 cursor-default rounded-xl">
                        {!! __('pagination.previous') !!}
                    </span>
                @else
                    <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="relative inline-flex items-center px-4 py-2 text-sm font-bold text-primary-700 bg-white border border-primary-100 rounded-xl hover:bg-primary-50 transition shadow-sm active:scale-95">
                        {!! __('pagination.previous') !!}
                    </button>
                @endif

                @if ($paginator->hasMorePages())
                    <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="relative inline-flex items-center px-4 py-2 text-sm font-bold text-primary-700 bg-white border border-primary-100 rounded-xl hover:bg-primary-50 transition shadow-sm active:scale-95">
                        {!! __('pagination.next') !!}
                    </button>
                @else
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-bold text-gray-400 bg-gray-50 border border-gray-200 cursor-default rounded-xl">
                        {!! __('pagination.next') !!}
                    </span>
                @endif
            </div>

            {{-- Desktop View --}}
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between gap-4">
                <div>
                    <p class="text-sm text-gray-500 font-medium">
                        {!! __('Menampilkan') !!}
                        <span class="font-black text-gray-800">{{ $paginator->firstItem() }}</span>
                        {!! __('sampai') !!}
                        <span class="font-black text-gray-800">{{ $paginator->lastItem() }}</span>
                        {!! __('dari') !!}
                        <span class="font-black text-primary-600">{{ $paginator->total() }}</span>
                        {!! __('data') !!}
                    </p>
                </div>

                <div class="flex items-center gap-1.5">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 border border-gray-100 text-gray-300 cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </span>
                    @else
                        <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-500 hover:border-primary-500 hover:text-primary-600 hover:bg-primary-50 transition shadow-sm active:scale-90">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                    @endif

                    {{-- Pagination Elements --}}
                    <div class="flex items-center gap-1">
                        @foreach ($elements as $element)
                            @if (is_string($element))
                                <span class="w-10 h-10 flex items-center justify-center text-gray-400 font-black">...</span>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <div wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                        @if ($page == $paginator->currentPage())
                                            <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-primary-600 text-white font-black shadow-lg shadow-primary-900/20 ring-4 ring-primary-600/10">
                                                {{ $page }}
                                            </span>
                                        @else
                                            <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-600 font-bold hover:border-primary-500 hover:text-primary-600 hover:bg-primary-50 transition shadow-sm active:scale-90">
                                                {{ $page }}
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    </div>

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-500 hover:border-primary-500 hover:text-primary-600 hover:bg-primary-50 transition shadow-sm active:scale-90">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    @else
                        <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 border border-gray-100 text-gray-300 cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </span>
                    @endif
                </div>
            </div>
        </nav>
    @endif
</div>

