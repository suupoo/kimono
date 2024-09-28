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
        Schema::create('m_system_company_dashboards', function (Blueprint $table) {
            $table->foreignId('m_system_company_id')
                ->constrained('m_system_companies')
                ->unique();
            $table->longText('dashboard');
            $table->dateTimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_system_company_dashboards');
    }
};
