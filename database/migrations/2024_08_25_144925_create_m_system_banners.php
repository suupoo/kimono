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
        Schema::create('m_system_banners', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('text')->nullable();
            $table->string('url')->nullable();
            $table->smallInteger('priority')->nullable();
            $table->datetimes();
        });
        Schema::table('m_system_banners', function (Blueprint $table) {
            $table->bigInteger('created_user')->nullable()->after('created_at');
            $table->bigInteger('updated_user')->nullable()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_system_banners');
    }
};
