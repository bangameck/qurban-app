<div class="animate-pulse w-full">
    <!-- 3 Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        @for($i = 0; $i < 3; $i++)
        <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex items-center justify-between h-28">
            <div class="space-y-3">
                <div class="h-3 bg-gray-100 rounded w-24"></div>
                <div class="h-8 bg-gray-200 rounded-lg w-32"></div>
            </div>
            <div class="w-12 h-12 rounded-full bg-gray-100"></div>
        </div>
        @endfor
    </div>

    <!-- Toolbar -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div class="h-6 bg-gray-200 rounded w-48"></div>
        <div class="flex items-center gap-3">
            <div class="h-12 bg-gray-100 rounded-xl w-36"></div>
            <div class="h-12 bg-gray-100 rounded-xl w-40"></div>
            <div class="h-12 bg-gray-100 rounded-xl w-32"></div>
        </div>
    </div>

    <!-- Table Content -->
    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        @for($i = 0; $i < 8; $i++)
                        <th class="p-4"><div class="h-3 bg-gray-200 rounded w-16"></div></th>
                        @endfor
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @for($i = 0; $i < 6; $i++)
                    <tr class="hover:bg-gray-50/50">
                        @for($j = 0; $j < 8; $j++)
                        <td class="p-4"><div class="h-4 bg-gray-100 rounded w-full"></div></td>
                        @endfor
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
