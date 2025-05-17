<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kimono\Core\Models\KimonoAccount;
use Kimono\Core\Models\KimonoConfiguration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kimono_configurations', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('【ID】');
            $table->json('parameters')->nullable()->comment('【設定値】');
        });
        //
        KimonoConfiguration::create([
            'parameters' => json_encode(['installed' => true]),
        ]);
        KimonoConfiguration::create([
            'name' => 'terms_of_service',
            'parameters' => json_encode([
                ['start_at' => '2025-04-01', 'end_at' => '2099-12-31', 'terms' => '利用者向けの利用規約を設定してください。'],
            ]),
        ]);

        Schema::create('kimono_accounts', function (Blueprint $table) {
            $table->uuid('id')->comment('【ID】');
            $table->string('email')->unique()->comment('【メールアドレス】');
            $table->string('password')->comment('【パスワード】');
            $table->boolean('active')->default(true)->comment('【有効フラグ】');
        });

        KimonoAccount::create([
            'email' => config('kimono.admin.login_email', 'kimono@example.com'),
            'password' => bcrypt(config('kimono.admin.login_password', 'japan')),
            'active' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kimono_configurations');
        Schema::dropIfExists('kimono_accounts');
    }
};
