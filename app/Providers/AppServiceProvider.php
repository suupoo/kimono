<?php

namespace App\Providers;

use App\Enums\Flag;
use App\Models\MSystemFeature;
use App\ValueObjects\Master\Feature\Enable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
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
        // テーブルがあるかどうかを確認
        if (DB::getSchemaBuilder()->hasTable((new MSystemFeature())->getTable()) ) {
            $enabledMFeatures = MSystemFeature::where(Enable::NAME, Flag::ON->value)->get();
            // 有効になっている機能のみをキーで定義��て有効化
            foreach ($enabledMFeatures as $enabledMFeature) {
                Feature::define($enabledMFeature->key, fn () => true);
            }
        }
    }
}
