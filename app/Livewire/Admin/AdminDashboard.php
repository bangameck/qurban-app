<?php

namespace App\Livewire\Admin;

use App\Models\AppSetting;
use App\Models\Mudhohi;
use App\Models\Mustahiq;
use App\Models\Panitia;
use App\Models\Sapi;
use App\Models\SesiDistribusi;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Lazy]
#[Title('Dashboard')]
class AdminDashboard extends Component
{
    public $tahun_aktif;

    public $greeting;

    public $nama_admin;

    // Data untuk Card KPI
    public $kpi = [];

    // Data untuk ApexCharts
    public $chartStatusSapi = [];

    public $chartTipeQurban = [];

    public $chartDistribusi = [];

    // Data Gabungan Semua Kupon (Mustahiq, Mudhohi, Panitia)
    public $chartKategoriKupon = [];

    public function mount()
    {
        // 1. Ambil Setting Tahun Aktif
        $settings = AppSetting::pluck('value', 'key')->toArray();
        $this->tahun_aktif = $settings['tahun'] ?? date('Y');
        usleep(200000);

        // 2. Setup Greeting Card Otomatis
        $hour = date('H');
        if ($hour >= 5 && $hour < 11) {
            $this->greeting = 'Selamat Pagi';
        } elseif ($hour >= 11 && $hour < 15) {
            $this->greeting = 'Selamat Siang';
        } elseif ($hour >= 15 && $hour < 18) {
            $this->greeting = 'Selamat Sore';
        } else {
            $this->greeting = 'Selamat Malam';
        }

        $this->nama_admin = Auth::user()->name ?? 'Panitia';

        // 3. Load Data Chart & KPI
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        // 1. Data KPI Ringkasan
        $this->kpi['sapi'] = Sapi::where('tahun', $this->tahun_aktif)->count();
        $this->kpi['mudhohi'] = Mudhohi::where('tahun', $this->tahun_aktif)->count();

        // Hitung total kupon dari ketiga tabel
        $countMustahiq = Mustahiq::where('tahun', $this->tahun_aktif)->count();
        $countMudhohi = Mudhohi::where('tahun', $this->tahun_aktif)->whereNotNull('kode_unik_kupon')->count();
        $countPanitia = Panitia::where('tahun', $this->tahun_aktif)->whereNotNull('kode_unik_kupon')->count();
        $this->kpi['kupon_total'] = $countMustahiq + $countMudhohi + $countPanitia;

        // Hitung total kupon yang sudah diambil dari ketiga tabel
        $scanMustahiq = Mustahiq::where('tahun', $this->tahun_aktif)->where('status_pengambilan', 'Sudah')->count();
        $scanMudhohi = Mudhohi::where('tahun', $this->tahun_aktif)->where('status_pengambilan', 'Sudah')->count();
        $scanPanitia = Panitia::where('tahun', $this->tahun_aktif)->where('status_pengambilan', 'Sudah')->count();
        $this->kpi['kupon_scan'] = $scanMustahiq + $scanMudhohi + $scanPanitia;

        // 2. Data Chart Status Sapi (Donut Chart)
        $sapiStats = Sapi::where('tahun', $this->tahun_aktif)
            ->selectRaw('status_proses, count(*) as total')
            ->groupBy('status_proses')
            ->pluck('total', 'status_proses')
            ->toArray();

        $this->chartStatusSapi = [
            'labels' => ['Menunggu', 'Disembelih', 'Dikuliti', 'Selesai'],
            'series' => [
                $sapiStats['Menunggu'] ?? 0,
                $sapiStats['Disembelih'] ?? 0,
                $sapiStats['Dikuliti'] ?? 0,
                $sapiStats['Selesai'] ?? 0,
            ],
        ];

        // 3. Data Chart Tipe Qurban (Bar Chart)
        $tipeStats = Mudhohi::where('tahun', $this->tahun_aktif)
            ->selectRaw('tipe_qurban, count(*) as total')
            ->groupBy('tipe_qurban')
            ->pluck('total', 'tipe_qurban')
            ->toArray();

        $this->chartTipeQurban = [
            'labels' => ['Patungan', 'Individu', 'Kambing'],
            'series' => [
                $tipeStats['Patungan'] ?? 0,
                $tipeStats['Individu'] ?? 0,
                $tipeStats['Kambing'] ?? 0,
            ],
        ];

        // 4. Data Chart Progress Distribusi per Sesi (Stacked Bar Chart)
        $sesis = SesiDistribusi::where('tahun', $this->tahun_aktif)->orderBy('jam_mulai', 'asc')->get();
        $sesiLabels = [];
        $sudahAmbil = [];
        $belumAmbil = [];

        foreach ($sesis as $sesi) {
            $sesiLabels[] = $sesi->nama_sesi;

            // PERBAIKAN: Menggunakan id_sesi_distribusi
            $sudah = Mustahiq::where('id_sesi_distribusi', $sesi->id)->where('status_pengambilan', 'Sudah')->count();
            $belum = Mustahiq::where('id_sesi_distribusi', $sesi->id)->where('status_pengambilan', 'Belum')->count();

            $sudahAmbil[] = $sudah;
            $belumAmbil[] = $belum;
        }

        $this->chartDistribusi = [
            'labels' => empty($sesiLabels) ? ['Belum ada sesi'] : $sesiLabels,
            'sudah' => empty($sudahAmbil) ? [0] : $sudahAmbil,
            'belum' => empty($belumAmbil) ? [0] : $belumAmbil,
        ];

        // 5. Data Chart Komposisi Kategori Kupon Premium
        $this->chartKategoriKupon = [
            'labels' => ['Peserta (Mustahiq)', 'Kupon Mudhohi', 'Kupon Panitia'],
            'series' => [
                $countMustahiq,
                $countMudhohi,
                $countPanitia,
            ],
            'total' => $countMustahiq + $countMudhohi + $countPanitia,
        ];
    }

    public function placeholder()
    {
        return view('components.skeleton._dashboard');
    }

    public function render()
    {

        return view('livewire.admin.dashboard')->title('Dashboard');
    }
}
