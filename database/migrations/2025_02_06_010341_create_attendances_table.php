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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->integer('owner_sequence_no')->nullable();
            $table->unsignedBigInteger('owner_system_company')->nullable();
            $table->unsignedBigInteger('staff_id');
            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date');
            $table->time('end_time');
            $table->datetimes();
            $table->softDeletes();
            $table->foreign('owner_system_company')->references('id')->on('m_system_companies');
            $table->foreign('staff_id')->references('id')->on('staffs');
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->bigInteger('created_user')->nullable()->after('created_at');
            $table->bigInteger('updated_user')->nullable()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
