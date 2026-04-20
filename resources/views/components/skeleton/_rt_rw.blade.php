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

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-4 border-b border-gray-100 bg-gray-50/50">
            <div class="h-10 bg-gray-200 rounded-xl w-72"></div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4"><div class="h-3 bg-gray-200 rounded w-24"></div></th>
                        <th class="px-6 py-4"><div class="h-3 bg-gray-200 rounded w-40"></div></th>
                        <th class="px-6 py-4"><div class="h-3 bg-gray-200 rounded w-24 ml-auto"></div></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @for($i = 0; $i < 6; $i++)
                    <tr>
                        <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-32"></div></td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gray-100"></div>
                                <div class="h-4 bg-gray-100 rounded w-48"></div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right"><div class="h-8 bg-gray-50 rounded-lg w-20 ml-auto"></div></td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>