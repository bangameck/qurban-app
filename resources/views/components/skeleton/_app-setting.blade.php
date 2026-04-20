<div class="space-y-8 pb-10 w-full animate-pulse">
    
    <!-- Identitas & Tampilan -->
    <div class="bg-white p-8 md:p-10 rounded-[2rem] shadow-sm border border-gray-100 w-full">
        <div class="flex items-center gap-3 mb-8 border-b border-gray-100 pb-4">
            <div class="w-10 h-10 bg-gray-200 rounded-xl"></div>
            <div class="h-6 bg-gray-200 rounded-lg w-48"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="h-12 bg-gray-100 rounded-xl w-full"></div>
            <div class="h-12 bg-gray-100 rounded-xl w-full"></div>
            <div class="space-y-3">
                <div class="h-3 bg-gray-200 rounded w-40"></div>
                <div class="flex gap-4">
                    @for($i=0; $i<4; $i++) <div class="w-10 h-10 bg-gray-100 rounded-full"></div> @endfor
                </div>
            </div>

            <!-- Logo Section -->
            <div class="md:col-span-2 border-2 border-dashed border-gray-100 bg-gray-50/50 rounded-2xl p-6">
                <div class="h-4 bg-gray-200 rounded w-72 mb-4"></div>
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-gray-200 rounded-2xl"></div>
                    <div class="flex-1 space-y-4">
                        <div class="h-10 bg-gray-100 rounded-xl w-full"></div>
                        <div class="h-2 bg-gray-100 rounded-full w-full"></div>
                    </div>
                </div>
            </div>

            <!-- Banner Section (Baru) -->
            <div class="md:col-span-3 border-2 border-dashed border-gray-100 bg-gray-50/50 rounded-2xl p-6">
                <div class="h-4 bg-gray-200 rounded w-72 mb-4"></div>
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="w-full md:w-64 h-32 bg-gray-200 rounded-2xl"></div>
                    <div class="flex-1 w-full space-y-4">
                        <div class="h-10 bg-gray-100 rounded-xl w-full"></div>
                        <div class="h-2 bg-gray-100 rounded-full w-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Anggaran & Tahun -->
    <div class="bg-white p-8 md:p-10 rounded-[2rem] shadow-sm border border-gray-100 w-full">
        <div class="flex items-center gap-3 mb-8 border-b border-gray-100 pb-4">
            <div class="w-10 h-10 bg-gray-200 rounded-xl"></div>
            <div class="h-6 bg-gray-200 rounded-lg w-56"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="h-14 bg-gray-100 rounded-xl w-full"></div>
            <div class="h-14 bg-gray-100 rounded-xl w-full"></div>
            <div class="h-14 bg-gray-100 rounded-xl w-full"></div>
        </div>
    </div>

</div>