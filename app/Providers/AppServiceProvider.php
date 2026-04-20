<?php

namespace App\Providers;

use App\Models\AppSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Pastikan tabel sudah ada (biar nggak error saat php artisan migrate:fresh)
        if (Schema::hasTable('app_settings')) {
            // Caching data setting selamanya, cache akan dihapus saat admin nyimpan setting baru
            $globalSettings = Cache::rememberForever('global_settings', function () {
                return AppSetting::pluck('value', 'key')->toArray();
            });

            // Bagikan ke semua view Blade
            View::share('globalSettings', $globalSettings);

            // Logika Logo & Favicon fleksibel (Cek storage dulu baru public)
            $logoUrl = file_exists(public_path('storage/logo.png')) ? asset('storage/logo.png') : asset('logo.png');
            $faviconUrl = file_exists(public_path('storage/favicon.ico')) ? asset('storage/favicon.ico') : asset('favicon.ico');
            
            View::share('logoUrl', $logoUrl);
            View::share('faviconUrl', $faviconUrl);
        }
        if (config('app.env') !== 'local' || isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
