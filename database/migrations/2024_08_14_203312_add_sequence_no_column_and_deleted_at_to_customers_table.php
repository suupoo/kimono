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
        Schema::table('customers', function (Blueprint $table) {
            $table->integer('owner_sequence_no')->after('id')->nullable();
            $table->unique(['owner_sequence_no', 'owner_system_company'], 'customers_owner_company_sequence_no_unique');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropUnique('customers_owner_company_sequence_no_unique');
            $table->dropColumn('owner_sequence_no');
            $table->dropColumn('deleted_at');
        });
    }
};
