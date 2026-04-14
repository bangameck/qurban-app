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
            <p class="text-primary-100 text-lg md:text-xl font-medium leading-relaxed">Pantau data pendaftar dan progres
                distribusi daging warga secara real-time dari satu tempat.</p>
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
                <div class="text-xs font-black text-amber-600 tracking-wider uppercase">Total Kupon</div>
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

    <<div x-data="{
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
                // 1. CHART STATUS SAPI (DONUT)
                let optionsSapi = {
                    series: @js($chartStatusSapi['series']),
                    labels: @js($chartStatusSapi['labels']),
                    chart: { type: 'donut', height: 320, fontFamily: 'inherit' },
                    colors: ['#9ca3af', '#ef4444', '#f59e0b', '#10b981'],
                    plotOptions: {
                        pie: {
                            donut: { size: '70%', labels: { show: true, name: { show: true }, value: { show: true, fontSize: '24px', fontWeight: 'bold' } } }
                        }
                    },
                    dataLabels: { enabled: false },
                    legend: { position: 'bottom', fontSize: '12px', fontWeight: 600 },
                    stroke: { show: false }
                };
                new ApexCharts(this.$refs.chartSapi, optionsSapi).render();

                // 2. CHART TIPE QURBAN (HORIZONTAL BAR)
                let optionsTipe = {
                    series: [{ name: 'Jamaah', data: @js($chartTipeQurban['series']) }],
                    chart: { type: 'bar', height: 320, fontFamily: 'inherit', toolbar: { show: false } },
                    plotOptions: {
                        bar: { horizontal: true, borderRadius: 6, dataLabels: { position: 'top' } }
                    },
                    colors: ['#3b82f6'],
                    dataLabels: { enabled: true, offsetX: -6, style: { fontSize: '12px', colors: ['#fff'] } },
                    stroke: { show: true, width: 1, colors: ['#fff'] },
                    xaxis: { categories: @js($chartTipeQurban['labels']) },
                    grid: { strokeDashArray: 4 }
                };
                new ApexCharts(this.$refs.chartTipe, optionsTipe).render();

                // 3. CHART DISTRIBUSI (STACKED BAR)
                let optionsDist = {
                    series: [
                        { name: 'Sudah Diambil', data: @js($chartDistribusi['sudah']) },
                        { name: 'Belum Diambil', data: @js($chartDistribusi['belum']) }
                    ],
                    chart: { type: 'bar', height: 350, stacked: true, fontFamily: 'inherit', toolbar: { show: false } },
                    colors: ['#10b981', '#f43f5e'],
                    plotOptions: { bar: { horizontal: false, borderRadius: 4, columnWidth: '40%' } },
                    xaxis: { 
                        categories: @js($chartDistribusi['labels']),
                        labels: { style: { fontWeight: 600 } }
                    },
                    yaxis: { title: { text: 'Jumlah Warga (Orang)' } },
                    fill: { opacity: 1 },
                    legend: { position: 'top', horizontalAlign: 'right' },
                    grid: { strokeDashArray: 4 }
                };
                new ApexCharts(this.$refs.chartDistribusi, optionsDist).render();
            }
        }" class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
            <div class="mb-4">
                <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Status Proses Sapi</h3>
                <p class="text-xs text-gray-400">Monitoring pemotongan hari ini.</p>
            </div>
            <div x-ref="chartSapi" class="w-full flex justify-center"></div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 lg:col-span-2">
            <div class="mb-4">
                <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Minat Tipe Qurban</h3>
                <p class="text-xs text-gray-400">Perbandingan jamaah berdasarkan jenis qurban.</p>
            </div>
            <div x-ref="chartTipe" class="w-full"></div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 lg:col-span-3 mt-2">
            <div class="mb-4">
                <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Progress Pengambilan Daging per Sesi
                    / RT</h3>
                <p class="text-xs text-gray-400">Gunakan data ini untuk memantau sisa antrean warga.</p>
            </div>
            <div x-ref="chartDistribusi" class="w-full"></div>
        </div>

</div>