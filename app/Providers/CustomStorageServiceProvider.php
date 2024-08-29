<?php

namespace App\Providers;

use App\Facades\Utility\CustomStorageService;
use Illuminate\Support\ServiceProvider;

class CustomStorageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('custom-storage', function ($app) {
            return new CustomStorageService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
