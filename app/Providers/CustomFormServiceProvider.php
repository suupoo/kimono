<?php

namespace App\Providers;

use App\Facades\Utility\CustomFormService;
use Illuminate\Support\ServiceProvider;

class CustomFormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('custom-form', function ($app) {
            return new CustomFormService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
