<div class="animate-pulse w-full">
    <div class="flex items-center gap-4 mb-8">
        <div class="w-14 h-14 bg-gray-200 rounded-2xl"></div>
        <div class="space-y-3">
            <div class="h-6 bg-gray-200 rounded-lg w-48"></div>
            <div class="h-4 bg-gray-100 rounded-lg w-72"></div>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-gray-100 p-8 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @for($i = 0; $i < 6; $i++)
            <div class="space-y-2">
                <div class="h-14 bg-gray-50 rounded-xl border border-gray-100 w-full"></div>
            </div>
            @endfor
            
            <div class="md:col-span-2 space-y-4">
                <div class="h-4 bg-gray-200 rounded w-64 mb-4"></div>
                <div class="flex gap-4">
                    @for($i = 0; $i < 4; $i++)
                    <div class="w-12 h-12 rounded-full bg-gray-100"></div>
                    @endfor
                </div>
            </div>

            <div class="md:col-span-2 mt-4">
                <div class="h-14 bg-gray-200 rounded-2xl w-full"></div>
            </div>
        </div>
    </div>
</div>
