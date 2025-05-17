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
        Schema::create('kimono_archetypes', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('【ID】');
            $table->string('name')->unique()->comment('【リソース名】');
            $table->boolean('active')->default(false)->comment('【有効フラグ】');
            $table->dateTime('start_at')->nullable()->comment('【開始日時】');
            $table->dateTime('end_at')->nullable()->comment('【終了日時】');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kimono_archetypes');
    }
};
