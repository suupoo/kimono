<?php

namespace App\Providers;

use App\Enums\Flag;
use App\Models\MSystemFeature;
use App\ValueObjects\Master\Feature\Enable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Pennant\Feature;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // カスタムディレクティブを登録
        Blade::if('breadcrumbs', function () {
            return config('custom.breadcrumbs.use');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $enabledMFeatures = MSystemFeature::where(Enable::NAME, Flag::ON->value)->get();
        // 有効になっている機能のみをキーで定義して有効化
        foreach ($enabledMFeatures as $enabledMFeature) {
            Feature::define($enabledMFeature->key, fn () => true);
        }
    }
}
