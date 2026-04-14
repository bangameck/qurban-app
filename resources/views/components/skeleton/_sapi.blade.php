<div class="animate-pulse">
    <div class="flex justify-between items-center mb-8">
        <div class="flex gap-4">
            <div class="w-12 h-12 bg-gray-200 rounded-xl"></div>
            <div class="space-y-2">
                <div class="h-6 w-48 bg-gray-200 rounded"></div>
                <div class="h-4 w-32 bg-gray-100 rounded"></div>
            </div>
        </div>
        <div class="h-10 w-32 bg-gray-200 rounded-xl"></div>
    </div>
    <div class="grid grid-cols-4 gap-4 mb-8">
        @for($i=0; $i<4; $i++) <div class="h-20 bg-gray-100 rounded-2xl"></div> @endfor
    </div>
    <div class="bg-white rounded-2xl h-96 border border-gray-100"></div>
</div>