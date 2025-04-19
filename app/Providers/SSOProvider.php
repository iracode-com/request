<?php

namespace App\Providers;

use App\Services\AuthService;
use Illuminate\Support\ServiceProvider;

class SSOProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AuthService::class, function ($app) {
            return new AuthService(
                config('sso.base_url'),
                config('sso.client_id'),
                config('sso.client_secret')
            );
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/sso.php' => config_path('sso.php'),
        ]);
    }
}
