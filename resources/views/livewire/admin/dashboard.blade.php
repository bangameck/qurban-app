<div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <div class="relative rounded-[2.5rem] p-8 sm:p-10 mb-8 shadow-xl overflow-hidden flex items-center justify-between"
        style="background: linear-gradient(135deg, var(--color-primary-600) 0%, var(--color-primary-800) 100%);">

        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;">
        </div>

        <div class="relative z-10 text-white w-full md:w-2/3">
            <div
                class="inline-flex items-center gap-2 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-[10px] font-black uppercase tracking-widest mb-4 border border-white/20">
                <div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
                Sistem Qurban {{ $tahun_aktif }} Online
            </div>

            <h2 class="text-3xl md:text-5xl font-black mb-3 leading-tight">{{ $greeting }},<br>{{ $nama_admin }}! 👋
            </h2>
            <p class="text-primary-100 text-lg md:text-xl font-medium leading-relaxed mb-8">Pantau data pendaftar dan progres
                distribusi daging warga secara real-time dari satu tempat.</p>

            <a wire:navigate href="{{ route('admin.scanner') }}" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-white text-primary-800 font-black rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.15)] hover:bg-gray-50 hover:-translate-y-1 transition-all uppercase tracking-widest text-sm border-2 border-white/50 ring-4 ring-primary-500/20 active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                Buka Scanner Kupon
            </a>
        </div>

        <div class="hidden md:block absolute right-0 top-1/2 transform -translate-y-1/2 opacity-20 pointer-events-none">
            <svg class="w-80 h-80 text-white transform translate-x-16" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                </path>
            </svg>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div
            class="bg-gradient-to-br from-emerald-50 to-white rounded-3xl p-6 border border-emerald-100 shadow-sm relative overflow-hidden transition transform hover:-translate-y-1 hover:shadow-md">
            <div class="absolute right-0 top-0 w-24 h-24 bg-emerald-500 opacity-5 rounded-bl-full"></div>
            <div class="flex items-center justify-between mb-4">
                <div class="text-xs font-black text-emerald-600 tracking-wider uppercase">Total Sapi</div>
                <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="text-4xl font-black text-gray-800">{{ $kpi['sapi'] }} <span
                    class="text-base text-gray-400 font-bold">Ekor</span></div>
        </div>

        <div
            class="bg-gradient-to-br from-blue-50 to-white rounded-3xl p-6 border border-blue-100 shadow-sm relative overflow-hidden transition transform hover:-translate-y-1 hover:shadow-md">
            <div class="absolute right-0 top-0 w-24 h-24 bg-blue-500 opacity-5 rounded-bl-full"></div>
            <div class="flex items-center justify-between mb-4">
                <div class="text-xs font-black text-blue-600 tracking-wider uppercase">Pendaftar</div>
                <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="text-4xl font-black text-gray-800">{{ $kpi['mudhohi'] }} <span
                    class="text-base text-gray-400 font-bold">Orang</span></div>
        </div>

        <div
            class="bg-gradient-to-br from-amber-50 to-white rounded-3xl p-6 border border-amber-100 shadow-sm relative overflow-hidden transition transform hover:-translate-y-1 hover:shadow-md">
            <div class="absolute right-0 top-0 w-24 h-24 bg-amber-500 opacity-5 rounded-bl-full"></div>
            <div class="flex items-center justify-between mb-4">
                <div class="text-xs font-black text-amber-600 tracking-wider uppercase">Semua Kupon Digital</div>
                <div class="p-2 bg-amber-100 text-amber-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="text-4xl font-black text-gray-800">{{ $kpi['kupon_total'] }} <span
                    class="text-base text-gray-400 font-bold">Tiket</span></div>
            <div class="mt-3 flex items-center gap-3 text-[9px] font-black uppercase tracking-wider text-gray-400">
                <span class="flex items-center gap-1">
                    <div class="w-2 h-2 rounded-full bg-amber-400"></div> Umum: {{ $chartKategoriKupon['series'][0] ?? 0
                    }}
                </span>
                <span class="flex items-center gap-1">
                    <div class="w-2 h-2 rounded-full bg-blue-400"></div> Mdhi: {{ $chartKategoriKupon['series'][1] ?? 0
                    }}
                </span>
                <span class="flex items-center gap-1">
                    <div class="w-2 h-2 rounded-full bg-rose-400"></div> Pnt: {{ $chartKategoriKupon['series'][2] ?? 0
                    }}
                </span>
            </div>
        </div>

        <div
            class="bg-gradient-to-br from-purple-50 to-white rounded-3xl p-6 border border-purple-100 shadow-sm relative overflow-hidden transition transform hover:-translate-y-1 hover:shadow-md">
            <div class="absolute right-0 top-0 w-24 h-24 bg-purple-500 opacity-5 rounded-bl-full"></div>
            <div class="flex items-center justify-between mb-4">
                <div class="text-xs font-black text-purple-600 tracking-wider uppercase">Selesai Ambil</div>
                <div class="p-2 bg-purple-100 text-purple-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            <div class="text-4xl font-black text-gray-800">{{ $kpi['kupon_scan'] }} <span
                    class="text-base text-gray-400 font-bold">/ {{ $kpi['kupon_total'] }}</span></div>
        </div>
    </div>

    <div x-data="{
            init() {
                // Karena ini Lazy Component, kita inject script ApexCharts secara dinamis
                if (typeof ApexCharts === 'undefined') {
                    let script = document.createElement('script');
                    script.src = 'https://cdn.jsdelivr.net/npm/apexcharts';
                    script.onload = () => { this.renderSemuaGrafik(); };
                    document.head.appendChild(script);
                } else {
                    // Beri jeda dikit biar DOM siap
                    setTimeout(() => { this.renderSemuaGrafik(); }, 150);
                }
            },
            renderSemuaGrafik() {
                // 1. CHART STATUS SAPI (DONUT) - PREMIUM
                let optionsSapi = {
                    series: @js($chartStatusSapi['series']),
                    labels: @js($chartStatusSapi['labels']),
                    chart: { type: 'donut', height: 320, fontFamily: 'inherit', dropShadow: { enabled: true, top: 2, left: 0, blur: 4, opacity: 0.15 } },
                    colors: ['#9ca3af', '#ef4444', '#f59e0b', '#10b981'],
                    fill: { type: 'gradient', gradient: { shade: 'light', type: 'vertical', shadeIntensity: 0.5, gradientToColors: ['#d1d5db', '#f87171', '#fbbf24', '#34d399'], inverseColors: true, opacityFrom: 1, opacityTo: 1, stops: [0, 100] } },
                    plotOptions: {
                        pie: {
                            donut: { size: '75%', labels: { show: true, name: { show: true, offsetY: -10 }, value: { show: true, fontSize: '28px', fontWeight: 900, offsetY: 5 } } }
                        }
                    },
                    dataLabels: { enabled: false },
                    legend: { position: 'bottom', fontSize: '12px', fontWeight: 700, markers: { radius: 12 } },
                    stroke: { show: true, width: 2, colors: ['#ffffff'] }
                };
                new ApexCharts(this.$refs.chartSapi, optionsSapi).render();

                // 2. CHART KOMPOSISI KUPON GABUNGAN (PIE) - PREMIUM
                let optionsKategori = {
                    series: @js($chartKategoriKupon['series']),
                    labels: @js($chartKategoriKupon['labels']),
                    chart: { type: 'pie', height: 320, fontFamily: 'inherit', dropShadow: { enabled: true, top: 2, left: 0, blur: 4, opacity: 0.15 } },
                    colors: ['#f59e0b', '#3b82f6', '#f43f5e'],
                    fill: { type: 'gradient', gradient: { shade: 'light', type: 'vertical', shadeIntensity: 0.5, gradientToColors: ['#fbbf24', '#60a5fa', '#fb7185'], inverseColors: true, opacityFrom: 1, opacityTo: 1, stops: [0, 100] } },
                    dataLabels: { enabled: true, style: { fontSize: '14px', fontWeight: 800, colors: ['#fff'] }, dropShadow: { enabled: true } },
                    legend: { position: 'bottom', fontSize: '12px', fontWeight: 700, markers: { radius: 12 } },
                    stroke: { show: true, width: 3, colors: ['#ffffff'] }
                };
                new ApexCharts(this.$refs.chartKategori, optionsKategori).render();

                // 3. CHART TIPE QURBAN (BAR) - PREMIUM
                let optionsTipe = {
                    series: [{ name: 'Jamaah', data: @js($chartTipeQurban['series']) }],
                    chart: { type: 'bar', height: 320, fontFamily: 'inherit', toolbar: { show: false } },
                    plotOptions: {
                        bar: { horizontal: false, borderRadius: 8, columnWidth: '45%', dataLabels: { position: 'top' } }
                    },
                    colors: ['#8b5cf6'],
                    fill: { type: 'gradient', gradient: { shade: 'light', type: 'vertical', shadeIntensity: 0.5, gradientToColors: ['#a78bfa'], inverseColors: true, opacityFrom: 1, opacityTo: 1, stops: [0, 100] } },
                    dataLabels: { enabled: true, offsetY: -20, style: { fontSize: '14px', fontWeight: 900, colors: ['#6b7280'] } },
                    stroke: { show: false },
                    xaxis: { categories: @js($chartTipeQurban['labels']), labels: { style: { fontWeight: 700, fontSize: '12px' } } },
                    yaxis: { show: false },
                    grid: { strokeDashArray: 4, padding: { top: 20 } }
                };
                new ApexCharts(this.$refs.chartTipe, optionsTipe).render();

                // 4. CHART DISTRIBUSI (STACKED BAR) - PREMIUM
                let optionsDist = {
                    series: [
                        { name: 'Sudah Diambil', data: @js($chartDistribusi['sudah']) },
                        { name: 'Belum Diambil', data: @js($chartDistribusi['belum']) }
                    ],
                    chart: { type: 'bar', height: 400, stacked: true, fontFamily: 'inherit', toolbar: { show: false } },
                    colors: ['#10b981', '#f43f5e'],
                    fill: { type: 'gradient', gradient: { shade: 'light', type: 'vertical', shadeIntensity: 0.3, gradientToColors: ['#34d399', '#fb7185'], inverseColors: false, opacityFrom: 1, opacityTo: 1, stops: [0, 100] } },
                    plotOptions: { bar: { horizontal: false, borderRadius: 6, columnWidth: '50%' } },
                    xaxis: { 
                        categories: @js($chartDistribusi['labels']),
                        labels: { style: { fontWeight: 700, fontSize: '12px' } }
                    },
                    yaxis: { title: { text: 'Jumlah Warga (Orang)', style: { fontWeight: 700 } }, labels: { style: { fontWeight: 600 } } },
                    dataLabels: { enabled: true, style: { fontWeight: 800, fontSize: '13px' }, dropShadow: { enabled: true } },
                    legend: { position: 'top', horizontalAlign: 'right', fontWeight: 700, markers: { radius: 12 } },
                    grid: { strokeDashArray: 4, borderColor: '#f3f4f6' }
                };
                new ApexCharts(this.$refs.chartDistribusi, optionsDist).render();
            }
        }" class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div
            class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 hover:shadow-lg transition duration-300">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Sapi Tracker</h3>
                    <p class="text-xs text-gray-400 mt-1 font-medium">Status pemotongan (%)</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400">🐮</div>
            </div>
            <div x-ref="chartSapi" class="w-full flex justify-center"></div>
        </div>

        <div
            class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 hover:shadow-lg transition duration-300">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Komposisi Kupon</h3>
                    <p class="text-xs text-gray-400 mt-1 font-medium">Distribusi seluruh tipe kupon</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-500"><svg
                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                        </path>
                    </svg></div>
            </div>
            <div x-ref="chartKategori" class="w-full flex justify-center"></div>
        </div>

        <div
            class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 hover:shadow-lg transition duration-300">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Tipe Qurban</h3>
                    <p class="text-xs text-gray-400 mt-1 font-medium">Minat pendaftar tahun ini</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-500"><svg
                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg></div>
            </div>
            <div x-ref="chartTipe" class="w-full mt-4"></div>
        </div>

        <div
            class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 lg:col-span-3 hover:shadow-lg transition duration-300 mt-2">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-black text-gray-800 uppercase tracking-widest">Distribusi Real-time per Sesi
                    </h3>
                    <p class="text-sm text-gray-400 mt-1 font-medium">Pantau arus penukaran kupon daging qurban secara
                        komprehensif.</p>
                </div>
                <div class="p-3 rounded-2xl bg-primary-50 text-primary-600 font-bold flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-primary-500 animate-pulse"></div>
                    Sistem Online
                </div>
            </div>
            <div x-ref="chartDistribusi" class="w-full"></div>
        </div>

    </div>