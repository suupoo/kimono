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
        Schema::dropIfExists('m_system_holidays');
        Schema::create('m_system_holidays', function (Blueprint $table) {
            $table->id();
            $table->date('date')->comment('日付');
            $table->string('locale',10)->comment('ロケール');
            $table->string('name', 255)->comment('名称');
            $table->unique(['date', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_system_holidays');
        Schema::create('m_system_holidays', function (Blueprint $table) {
            $table->date('date')->comment('日付');
            $table->string('locale',10)->comment('ロケール');
            $table->string('name', 255)->comment('名称');
            $table->primary(['date', 'locale']);
        });
    }
};
