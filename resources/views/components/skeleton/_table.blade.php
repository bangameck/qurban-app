<div class="animate-pulse w-full">
    {{-- Header Placeholder --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-gray-200 rounded-xl w-14 h-14"></div>
            <div class="space-y-3">
                <div class="h-6 bg-gray-200 rounded-lg w-56"></div>
                <div class="h-4 bg-gray-100 rounded-lg w-72"></div>
            </div>
        </div>
        <div class="h-12 bg-gray-200 rounded-xl w-48"></div>
    </div>

    {{-- Table Container Placeholder --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-4 border-b border-gray-100 bg-gray-50/50">
            <div class="h-10 bg-gray-200 rounded-xl w-64"></div>
        </div>
        <div class="overflow-x-auto">
            <div class="h-12 bg-gray-50 w-full border-b border-gray-100"></div>
            @for($i = 0; $i < 6; $i++)
            <div class="flex items-center px-6 py-4 border-b border-gray-50 gap-6">
                <div class="h-4 bg-gray-200 rounded w-1/4"></div>
                <div class="h-4 bg-gray-100 rounded w-1/4"></div>
                <div class="h-4 bg-gray-100 rounded w-1/4"></div>
                <div class="ml-auto h-8 bg-gray-50 rounded-lg w-20"></div>
            </div>
            @endfor
        </div>
        <div class="p-4 bg-gray-50 flex justify-end">
            <div class="h-8 bg-gray-200 rounded-lg w-32"></div>
        </div>
    </div>
</div>
