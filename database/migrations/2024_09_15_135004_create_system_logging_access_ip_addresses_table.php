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
        Schema::create('system_logging_access_ip_addresses', function (Blueprint $table) {
            $table->uuid('uuid')->primary('uuid');
            $table->foreignId('m_system_administrator_id')->constrained()->name('m_system_administrators_id_foreign');
            $table->string('ip_address', 255)->comment('IPアドレス');
            $table->text('user_agent')->nullable()->comment('ユーザーエージェント');
            $table->dateTimes();

            $table->unique(['m_system_administrators_id', 'ip_address'])->name('system_logging_access_ip_addresses_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_logging_access_ip_addresses');
    }
};
