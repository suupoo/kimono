<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CustomInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize custom-cms package.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // システムアカウントを追加
        Artisan::call('custom-admin:add', [
            'name' => 'システム',
            'email' => 'system@example.com',
            '--init' => true,
        ]);
    }
}
