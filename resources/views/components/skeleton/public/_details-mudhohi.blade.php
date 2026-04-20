<div class="animate-pulse min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-lg bg-white rounded-[3rem] p-10 border border-gray-100 shadow-xl">
        <div class="text-center mb-10">
            <div class="h-10 bg-gray-200 rounded-xl w-64 mx-auto mb-4"></div>
            <div class="h-4 bg-gray-100 rounded-lg w-40 mx-auto"></div>
        </div>

        <div class="space-y-6">
            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-3xl border border-gray-100">
                <div class="w-16 h-16 bg-gray-200 rounded-2xl"></div>
                <div class="space-y-3">
                    <div class="h-4 bg-gray-200 rounded w-48"></div>
                    <div class="h-2 bg-gray-100 rounded w-32"></div>
                </div>
            </div>

            @for($i = 0; $i < 3; $i++)
            <div class="flex justify-between items-center px-6 py-4 bg-gray-50 rounded-2xl border border-gray-100">
                <div class="h-2 bg-gray-200 rounded w-20"></div>
                <div class="h-2 bg-gray-200 rounded w-32"></div>
            </div>
            @endfor
        </div>

        <div class="mt-10 h-14 bg-gray-200 rounded-2xl w-full"></div>
    </div>
</div>
