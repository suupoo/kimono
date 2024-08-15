<?php

namespace App\Console\Commands;

use App\Enums\Flag;
use App\Models\MSystemFeature;
use App\ValueObjects\Master\Feature\Enable;
use App\ValueObjects\Master\Feature\Key;
use App\ValueObjects\Master\Feature\Name;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CustomFeatureAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom-feature:add {feature} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a feature master data to custom-cms package.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (! DB::table('m_system_features')->exists()) {
            // テーブルが存在していない場合
            throw new \Exception('m_system_features table is not exists. Please run php artisan migrate first.');
        }

        if (MSystemFeature::where(Key::NAME, $this->argument('feature'))->exists()) {
            // 存在している場合
            throw new \Exception('Feature '.$this->argument('feature').' is already exists.');
        }

        // 追加処理
        MSystemFeature::create([
            Key::NAME => $this->argument('feature'),
            Name::NAME => $this->argument('name'),
            Enable::NAME => Flag::OFF->value, // 初回はOFFで登録
        ]);

    }
}
