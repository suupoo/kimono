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
        Schema::create('stores_staffs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('store_id')->unsigned()->foreign('store_id')->references('id')->on('stores');
            $table->bigInteger('staff_id')->unsigned()->foreign('staff_id')->references('id')->on('staffs');

            $table->unique(['store_id', 'staff_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores_staffs');
    }
};
