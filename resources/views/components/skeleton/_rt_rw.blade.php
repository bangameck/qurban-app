<div class="animate-pulse">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-gray-200 rounded-xl"></div>
            <div>
                <div class="h-6 w-48 bg-gray-200 rounded-md mb-2"></div>
                <div class="h-4 w-64 bg-gray-100 rounded-md"></div>
            </div>
        </div>
        <div class="h-10 w-32 bg-gray-200 rounded-xl"></div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-4 border-b border-gray-100 bg-gray-50/50">
            <div class="w-full md:w-72 h-10 bg-gray-200 rounded-xl"></div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100">
                        @for($i = 0; $i < 4; $i++)
                            <th class="px-6 py-4"><div class="h-4 w-24 bg-gray-100 rounded"></div></th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @for($i = 0; $i < 5; $i++)
                        <tr class="border-b border-gray-50">
                            <td class="px-6 py-4"><div class="h-5 w-32 bg-gray-100 rounded"></div></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gray-200"></div>
                                    <div class="h-4 w-28 bg-gray-100 rounded"></div>
                                </div>
                            </td>
                            <td class="px-6 py-4"><div class="h-4 w-40 bg-gray-50 rounded"></div></td>
                            <td class="px-6 py-4 flex justify-end gap-2">
                                <div class="w-8 h-8 bg-gray-100 rounded-lg"></div>
                                <div class="w-8 h-8 bg-gray-100 rounded-lg"></div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>