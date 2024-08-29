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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_system_company')
                ->nullable();
            $table->text('image')->nullable();
            $table->string('name');
            $table->integer('price');
            $table->integer('quantity');
            $table->datetimes();
            $table->foreign('owner_system_company')->references('id')->on('m_system_companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
