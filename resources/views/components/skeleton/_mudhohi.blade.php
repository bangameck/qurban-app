<div class="animate-pulse w-full">
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

    <div class="mb-10 max-w-md">
        <div class="h-16 bg-gray-100 rounded-[2rem] w-full border-2 border-gray-50"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @for($i = 0; $i < 8; $i++)
        <div class="bg-white rounded-[2.5rem] p-6 border border-gray-100 shadow-sm flex flex-col items-center">
            <div class="w-24 h-24 rounded-full bg-gray-100 mb-4 border-4 border-white shadow-sm ring-4 ring-gray-50"></div>
            <div class="h-5 bg-gray-200 rounded-lg w-40 mb-3"></div>
            
            <div class="flex gap-4 w-full mb-6">
                <div class="flex-1 h-24 bg-gray-50 rounded-3xl border border-gray-100"></div>
                <div class="flex-1 h-24 bg-gray-50 rounded-3xl border border-gray-100"></div>
            </div>

            <div class="w-full bg-gray-50 p-4 rounded-3xl border border-gray-100 space-y-3 mb-6">
                <div class="flex justify-between items-center"><div class="h-2 bg-gray-200 rounded w-16"></div><div class="h-2 bg-gray-200 rounded w-20"></div></div>
            </div>

            <div class="w-full h-12 bg-gray-100 rounded-2xl"></div>
        </div>
        @endfor
    </div>
</div>