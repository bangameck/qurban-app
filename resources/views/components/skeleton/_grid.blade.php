<div class="animate-pulse w-full">
    {{-- Header Placeholder --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-gray-200 rounded-2xl w-14 h-14"></div>
            <div class="space-y-3">
                <div class="h-6 bg-gray-200 rounded-lg w-64"></div>
                <div class="h-4 bg-gray-100 rounded-lg w-80"></div>
            </div>
        </div>
        <div class="h-12 bg-gray-200 rounded-2xl w-48"></div>
    </div>

    {{-- Search Placeholder --}}
    <div class="mb-10 max-w-md">
        <div class="h-16 bg-gray-100 rounded-[2rem] w-full border-2 border-gray-50"></div>
    </div>

    {{-- Grid Card Placeholder --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @for($i = 0; $i < 8; $i++)
        <div class="bg-white rounded-[2.5rem] p-6 border border-gray-100 shadow-sm flex flex-col items-center">
            <div class="w-24 h-24 rounded-full bg-gray-100 mb-4 border-4 border-white shadow-sm ring-4 ring-gray-50"></div>
            <div class="h-5 bg-gray-200 rounded-lg w-40 mb-3"></div>
            <div class="flex gap-2 mb-8">
                <div class="h-4 bg-gray-100 rounded-full w-24"></div>
                <div class="h-4 bg-gray-100 rounded-full w-20"></div>
            </div>
            <div class="w-32 h-32 bg-gray-50 rounded-[2.5rem] border-2 border-dashed border-gray-100 mb-6"></div>
            <div class="w-full h-12 bg-gray-50 rounded-2xl border border-gray-100 mb-4"></div>
            <div class="w-full h-10 bg-gray-50 rounded-2xl border border-gray-100"></div>
        </div>
        @endfor
    </div>
</div>
