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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code', 255)->nullable()->unique();
            $table->string('email')->nullable();
            $table->string('tel')->nullable();
            $table->string('position')->nullable()->comment('役職');
            $table->date('join_date')->nullable()->comment('入社日');
            $table->date('quit_date')->nullable()->comment('退社日');
            $table->datetimes();
        });
        Schema::table('staffs', function (Blueprint $table) {
            $table->bigInteger('created_user')->nullable()->after('created_at');
            $table->bigInteger('updated_user')->nullable()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
