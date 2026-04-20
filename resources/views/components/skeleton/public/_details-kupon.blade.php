<div class="animate-pulse min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-lg bg-white rounded-[3rem] p-10 border border-gray-100 shadow-xl">
        <div class="flex flex-col items-center mb-10">
            <div class="w-24 h-24 bg-gray-200 rounded-full mb-6"></div>
            <div class="h-8 bg-gray-200 rounded-lg w-48 mb-3"></div>
            <div class="h-4 bg-gray-100 rounded-lg w-32"></div>
        </div>

        <div class="space-y-6">
            @for($i = 0; $i < 4; $i++)
            <div class="flex justify-between items-center px-6 py-4 bg-gray-50 rounded-2xl border border-gray-100">
                <div class="h-2 bg-gray-200 rounded w-20"></div>
                <div class="h-2 bg-gray-200 rounded w-32"></div>
            </div>
            @endfor
        </div>

        <div class="mt-10 h-14 bg-gray-200 rounded-2xl w-full"></div>
    </div>
</div>