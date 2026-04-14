<div class="animate-pulse">
    <div class="flex justify-between items-center mb-8">
        <div class="flex gap-4">
            <div class="w-12 h-12 bg-gray-200 rounded-xl"></div>
            <div class="space-y-2">
                <div class="h-6 w-48 bg-gray-200 rounded"></div>
                <div class="h-4 w-32 bg-gray-100 rounded"></div>
            </div>
        </div>
        <div class="h-10 w-40 bg-gray-200 rounded-xl"></div>
    </div>
    <div class="bg-white rounded-2xl h-[400px] border border-gray-100 p-4">
        <div class="h-10 bg-gray-100 rounded-xl mb-6 w-72"></div>
        <div class="space-y-4">
            @for($i=0; $i<6; $i++)
                <div class="h-14 bg-gray-50 rounded-xl flex items-center px-4 gap-4">
                    <div class="w-10 h-10 bg-gray-200 rounded-full"></div>
                    <div class="flex-1 space-y-2"><div class="h-4 w-32 bg-gray-200 rounded"></div><div class="h-2 w-20 bg-gray-200 rounded"></div></div>
                </div>
            @endfor
        </div>
    </div>
</div>