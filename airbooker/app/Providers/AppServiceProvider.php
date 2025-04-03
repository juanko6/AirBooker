<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Forzar HTTPS solo si estamos en producción o usando ngrok
        if (str_contains(config('app.url'), 'ngrok') || config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
