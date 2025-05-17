<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kimono_configuration_histories', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('【ID】');
            $table->json('before')->nullable()->comment('【現行値】');
            $table->json('after')->nullable()->comment('【新規値】');
            $table->json('diff')->nullable()->comment('【差分】');
            $table->dateTime('created_at')->comment('【作成日時】');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kimono_configuration_histories');
    }
};
