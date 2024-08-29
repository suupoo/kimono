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
        Schema::table('staffs', function (Blueprint $table) {
            $table->string('tags')->after('quit_date')->nullable();
            $table->integer('owner_sequence_no')->after('id')->nullable();
            $table->unique(['owner_sequence_no', 'owner_system_company'], 'staffs_owner_company_sequence_no_unique');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staffs', function (Blueprint $table) {
            $table->dropColumn('tags');
            $table->dropUnique('staffs_owner_company_sequence_no_unique');
            $table->dropColumn('owner_sequence_no');
            $table->dropColumn('deleted_at');
        });
    }
};
