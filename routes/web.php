<?php

use App\Http\Controllers\KuponMudhohiController;
use App\Http\Controllers\KuponMustahiqController;
use App\Http\Controllers\KuponPanitiaController;
use App\Http\Controllers\RabController;
use App\Http\Controllers\SertifikatController;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\AppSetting;
use App\Livewire\Admin\DataKelompokSapi;
use App\Livewire\Admin\DataMudhohi;
use App\Livewire\Admin\DataMustahiq;
use App\Livewire\Admin\DataPanitia;
use App\Livewire\Admin\DataRab;
use App\Livewire\Admin\DataRt;
use App\Livewire\Admin\DataRw;
use App\Livewire\Admin\DataSapi;
use App\Livewire\Admin\DataSesiDistribusi;
use App\Livewire\Admin\DataWarga;
use App\Livewire\Admin\LaporanMudhohi;
use App\Livewire\Admin\LaporanMustahiq;
use App\Livewire\Admin\LaporanPanitia;
use App\Livewire\Admin\ManajemenUser;
use App\Livewire\Admin\ScannerKupon;
use App\Livewire\Auth\Login;
use App\Livewire\Display\LiveScreen;
use App\Livewire\Public\DetailKupon;
use App\Livewire\Public\DetailMudhohi;
use App\Livewire\Public\Home;
use App\Livewire\Public\MudhohiList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Root langsung diarahkan ke login (nanti bisa diganti ke landing page warga)
Route::get('/', Home::class)->name('home');

Route::get('/live-tv', LiveScreen::class)->name('live.tv');

// Route Login (Hanya bisa diakses kalau belum login / guest)
Route::get('/login', Login::class)->name('login')->middleware('guest');

// Public
Route::get('/kupon/{kode}', DetailKupon::class)->name('kupon.detail');
Route::get('/pendaftar/{id}', DetailMudhohi::class)->name('mudhohi.detail');
Route::get('/sertifikat/{id}/pdf', [SertifikatController::class, 'cetak'])->name('mudhohi.sertifikat');
Route::get('/peserta-qurban', MudhohiList::class)->name('public.mudhohi');

// Route khusus Admin (Harus login dulu)
Route::middleware('auth')->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/admin/settings', AppSetting::class)->name('admin.settings');

    // CRUD User
    Route::get('/admin/warga', DataWarga::class)->name('admin.warga');
    Route::get('/admin/panitia', DataPanitia::class)->name('admin.panitia');
    Route::get('/admin/rw', DataRw::class)->name('admin.rw');
    Route::get('/admin/rt', DataRt::class)->name('admin.rt');
    Route::get('/admin/sapi', DataSapi::class)->name('admin.sapi');
    Route::get('/admin/kelompok-sapi', DataKelompokSapi::class)->name('admin.kelompok-sapi');
    Route::get('/admin/mudhohi', DataMudhohi::class)->name('admin.mudhohi');
    Route::get('/admin/distribusi', DataSesiDistribusi::class)->name('admin.distribusi');
    Route::get('/admin/mustahiq', DataMustahiq::class)->name('admin.mustahiq');
    Route::get('/admin/scanner', ScannerKupon::class)->name('admin.scanner');
    Route::get('/admin/users', ManajemenUser::class)->name('admin.users');
    Route::get('/laporan/mustahiq', LaporanMustahiq::class)->name('admin.laporan.mustahiq');
    Route::get('/laporan/cetak-kupon-sesi/{id_sesi}', [KuponMustahiqController::class, 'cetakPerSesi'])->name('admin.cetak_kupon_sesi');
    Route::get('/laporan/mudhohi', LaporanMudhohi::class)->name('admin.laporan.mudhohi');
    Route::get('/laporan/mudhohi/cetak-kupon/{id_kelompok}', [KuponMudhohiController::class, 'cetakPerKelompok'])->name('admin.cetak_kupon_mudhohi');
    Route::get('/laporan/panitia', LaporanPanitia::class)->name('admin.laporan.panitia');
    Route::get('/laporan/panitia/cetak-pdf', [KuponPanitiaController::class, 'cetakSemua'])->name('admin.cetak_kupon_panitia');
    Route::get('/laporan/panitia/cetak-id-card', [KuponPanitiaController::class, 'cetakIdCard'])->name('admin.cetak_idcard_panitia');
    Route::get('/laporan/rab', DataRab::class)->name('admin.laporan.rab');
    Route::get('/admin/rab/export-pdf', [RabController::class, 'exportPdf'])->name('admin.rab.pdf');
    Route::get('/admin/rab/export-excel', [RabController::class, 'exportExcel'])->name('admin.rab.excel');

    // Route Logout
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');

});
