<div class="animate-pulse">
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="h-10 bg-gray-200 rounded-xl w-64 mb-3"></div>
            <div class="h-4 bg-gray-100 rounded-lg w-80"></div>
        </div>
        <div class="h-12 bg-gray-200 rounded-xl w-48"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @for($i = 0; $i < 4; $i++)
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm relative overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="h-3 bg-gray-200 rounded w-24"></div>
                <div class="w-10 h-10 bg-gray-100 rounded-lg"></div>
            </div>
            <div class="h-10 bg-gray-200 rounded-xl w-20 mb-1"></div>
        </div>
        @endfor
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 h-80">
            <div class="h-4 bg-gray-200 rounded w-32 mb-2"></div>
            <div class="h-3 bg-gray-100 rounded w-48 mb-8"></div>
            <div class="w-48 h-48 bg-gray-100 rounded-full mx-auto border-[16px] border-gray-50"></div>
        </div>
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 h-80 lg:col-span-2">
            <div class="h-4 bg-gray-200 rounded w-40 mb-2"></div>
            <div class="h-3 bg-gray-100 rounded w-56 mb-8"></div>
            <div class="space-y-4 mt-10">
                <div class="h-8 bg-gray-100 rounded-r-xl w-3/4"></div>
                <div class="h-8 bg-gray-100 rounded-r-xl w-1/2"></div>
                <div class="h-8 bg-gray-100 rounded-r-xl w-1/4"></div>
            </div>
        </div>
    </div>
</div>