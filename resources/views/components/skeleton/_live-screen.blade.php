<div class="animate-pulse w-full h-screen bg-gray-900 flex flex-col p-8 overflow-hidden">
    <!-- Top Header -->
    <div class="flex items-center justify-between mb-8">
        <div class="h-10 bg-gray-800 rounded-xl w-64"></div>
        <div class="h-10 bg-gray-800 rounded-xl w-48"></div>
    </div>

    <!-- Main Grid -->
    <div class="flex-1 grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Section (Sapi Grid) -->
        <div class="lg:col-span-1 bg-gray-800/50 rounded-[2.5rem] p-6 border border-gray-700/50 flex flex-col gap-4">
            @for($i = 0; $i < 4; $i++)
            <div class="h-32 bg-gray-800 rounded-3xl border border-gray-700/30"></div>
            @endfor
        </div>

        <!-- Center/Right Section (Table) -->
        <div class="lg:col-span-2 bg-gray-800/50 rounded-[2.5rem] p-8 border border-gray-700/50">
            <div class="h-10 bg-gray-800 rounded-xl w-72 mb-8"></div>
            <div class="space-y-4">
                @for($i = 0; $i < 8; $i++)
                <div class="h-14 bg-gray-800/80 rounded-2xl border border-gray-700/20"></div>
                @endfor
            </div>
        </div>
    </div>
</div>
