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
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between items-center gap-4">
            <span>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-6 py-2.5 text-sm font-bold text-gray-400 bg-gray-50 border border-gray-200 cursor-default rounded-xl transition">
                        {!! __('pagination.previous') !!}
                    </span>
                @else
                    @if(method_exists($paginator,'getCursorName'))
                        <button type="button" dusk="previousPage" wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->previousCursor()->encode() }}" wire:click="setPage('{{$paginator->previousCursor()->encode()}}','{{ $paginator->getCursorName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="relative inline-flex items-center px-6 py-2.5 text-sm font-bold text-primary-700 bg-white border border-primary-100 rounded-xl hover:bg-primary-50 transition shadow-sm active:scale-95">
                                {!! __('pagination.previous') !!}
                        </button>
                    @else
                        <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="relative inline-flex items-center px-6 py-2.5 text-sm font-bold text-primary-700 bg-white border border-primary-100 rounded-xl hover:bg-primary-50 transition shadow-sm active:scale-95">
                                {!! __('pagination.previous') !!}
                        </button>
                    @endif
                @endif
            </span>

            <span class="text-sm font-bold text-gray-500 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">
                Halaman ke-{{ $paginator->currentPage() }}
            </span>

            <span>
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    @if(method_exists($paginator,'getCursorName'))
                        <button type="button" dusk="nextPage" wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->nextCursor()->encode() }}" wire:click="setPage('{{$paginator->nextCursor()->encode()}}','{{ $paginator->getCursorName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="relative inline-flex items-center px-6 py-2.5 text-sm font-bold text-primary-700 bg-white border border-primary-100 rounded-xl hover:bg-primary-50 transition shadow-sm active:scale-95">
                                {!! __('pagination.next') !!}
                        </button>
                    @else
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="relative inline-flex items-center px-6 py-2.5 text-sm font-bold text-primary-700 bg-white border border-primary-100 rounded-xl hover:bg-primary-50 transition shadow-sm active:scale-95">
                                {!! __('pagination.next') !!}
                        </button>
                    @endif
                @else
                    <span class="relative inline-flex items-center px-6 py-2.5 text-sm font-bold text-gray-400 bg-gray-50 border border-gray-200 cursor-default rounded-xl transition">
                        {!! __('pagination.next') !!}
                    </span>
                @endif
            </span>
        </nav>
    @endif
</div>

