<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Load Google Maps key from settings table, if present
        try {
            $key = \App\Models\Setting::where('key', 'google_maps_api_key')->value('value');
            if ($key) {
                config(['services.google_maps.key' => $key]);
            }
        } catch (\Throwable $e) {
            // Ignore if settings table not yet migrated
        }
    }
}
