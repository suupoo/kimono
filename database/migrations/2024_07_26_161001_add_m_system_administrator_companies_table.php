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
        Schema::create('m_system_administrator_companies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('system_administrator')->unsigned()->foreign('system_administrator')->references('id')->on('m_system_administrators');
            $table->bigInteger('system_company')->unsigned()->foreign('system_company')->references('id')->on('m_system_companies');
            $table->unique(['system_administrator', 'system_company'])
                ->name('m_system_administrator_companies_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_system_administrator_companies');
    }
};
