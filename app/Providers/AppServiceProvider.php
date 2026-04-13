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
        }
    }
}
