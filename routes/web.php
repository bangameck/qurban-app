<?php

use App\Livewire\Admin\AdminDashboard; // Pastikan nama class-nya benar sesuai yang kita buat (Dashboard, bukan AdminDashboard)
use App\Livewire\Admin\AppSetting;
use App\Livewire\Admin\DataRt;
use App\Livewire\Admin\DataRw;
use App\Livewire\Admin\DataWarga;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Root langsung diarahkan ke login (nanti bisa diganti ke landing page warga)
Route::get('/', function () {
    return redirect()->route('login');
});

// Route Login (Hanya bisa diakses kalau belum login / guest)
Route::get('/login', Login::class)->name('login')->middleware('guest');

// Route khusus Admin (Harus login dulu)
Route::middleware('auth')->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/admin/settings', AppSetting::class)->name('admin.settings');

    // CRUD User
    Route::get('/admin/warga', DataWarga::class)->name('admin.warga');
    Route::get('/admin/rw', DataRw::class)->name('admin.rw');
    Route::get('/admin/rt', DataRt::class)->name('admin.rt');

    // Route Logout
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');

});
