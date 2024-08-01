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
        Schema::table('m_system_companies', function (Blueprint $table) {
            $table->uuid('uuid')->nullable()->after('id')->unique()->comment('UUID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('m_system_companies', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
};
