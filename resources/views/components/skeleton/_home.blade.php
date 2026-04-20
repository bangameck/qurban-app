<div class="animate-pulse w-full">
    <!-- Navbar Skeleton -->
    <div class="h-20 bg-white border-b border-gray-100 flex items-center px-8 mb-8">
        <div class="h-8 bg-gray-200 rounded-lg w-40"></div>
        <div class="ml-auto flex gap-6">
            <div class="h-4 bg-gray-100 rounded w-20"></div>
            <div class="h-4 bg-gray-100 rounded w-20"></div>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-6 py-20 text-center">
        <div class="h-12 bg-gray-200 rounded-2xl w-3/4 mx-auto mb-6"></div>
        <div class="h-6 bg-gray-100 rounded-xl w-1/2 mx-auto mb-12"></div>
        <div class="flex justify-center gap-4">
            <div class="h-14 bg-gray-200 rounded-2xl w-48"></div>
            <div class="h-14 bg-gray-100 rounded-2xl w-48"></div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
        @for($i = 0; $i < 3; $i++)
        <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm h-40">
            <div class="h-4 bg-gray-100 rounded w-24 mb-4"></div>
            <div class="h-10 bg-gray-200 rounded-xl w-32"></div>
        </div>
        @endfor
    </div>
</div>
