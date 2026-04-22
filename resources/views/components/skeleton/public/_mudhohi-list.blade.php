<div class="max-w-6xl mx-auto w-full animate-pulse relative z-10">
    
    <div class="text-center mb-12 flex flex-col items-center">
        <div class="w-14 h-14 bg-gray-200 rounded-2xl mb-4"></div>
        
        <div class="w-3/4 md:w-1/2 h-10 md:h-12 bg-gray-200 rounded-xl mb-4"></div>
        
        <div class="w-5/6 md:w-2/3 h-5 bg-gray-200 rounded-lg mb-2"></div>
        <div class="w-4/6 md:w-1/2 h-5 bg-gray-200 rounded-lg mb-10"></div>
        
        <div class="w-full max-w-2xl h-[68px] bg-white rounded-full border-2 border-gray-100 shadow-[0_10px_40px_rgba(0,0,0,0.05)] flex items-center px-6">
            <div class="w-6 h-6 bg-gray-200 rounded-full mr-4"></div>
            <div class="flex-1 h-4 bg-gray-200 rounded-lg"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @for($j = 0; $j < 3; $j++)
            <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/30 border border-gray-100 overflow-hidden flex flex-col h-full">
                
                <div class="p-6 bg-gray-100 border-b border-gray-200 h-[104px] flex justify-between items-start">
                    <div class="space-y-3">
                        <div class="w-32 h-6 bg-gray-300 rounded-lg"></div>
                        <div class="w-24 h-3 bg-gray-300 rounded"></div>
                    </div>
                    <div class="w-20 h-6 bg-gray-300 rounded-full shrink-0"></div>
                </div>

                <div class="p-6 flex-1 bg-white">
                    <ul class="space-y-3">
                        @for ($i = 0; $i < 7; $i++)
                            <li class="flex items-center gap-4 p-3 rounded-2xl bg-gray-50 border border-gray-100">
                                <div class="w-10 h-10 rounded-full bg-gray-200 shrink-0"></div>
                                
                                <div class="flex-1 space-y-2">
                                    <div class="w-32 h-4 bg-gray-300 rounded"></div>
                                    <div class="w-20 h-3 bg-gray-200 rounded"></div>
                                </div>

                                <div class="w-5 h-5 rounded-full bg-gray-200 shrink-0"></div>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
        @endfor
    </div>

    <div class="mt-16 mb-8 flex justify-center">
        <div class="w-56 h-9 bg-gray-200 rounded-full shadow-sm"></div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @for($k = 0; $k < 4; $k++)
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-gray-100 shrink-0"></div>
                <div class="flex-1 space-y-2">
                    <div class="w-24 h-4 bg-gray-300 rounded"></div>
                    <div class="w-16 h-3 bg-gray-200 rounded"></div>
                </div>
            </div>
        @endfor
    </div>

</div>