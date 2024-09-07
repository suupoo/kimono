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
            $table->text('conoha_tenant_username')->nullable()->comment('Conohaユーザ名')->after('name');
            $table->text('conoha_tenant_password')->nullable()->comment('Conohaテナントパスワード')->after('conoha_tenant_username');
            $table->text('conoha_tenant_name')->nullable()->comment('Conohaテナント名')->after('conoha_tenant_password');
            $table->text('conoha_tenant_id')->nullable()->comment('ConohaテナントID')->after('conoha_tenant_name');
            $table->text('conoha_tenant_temporary_url_key')->nullable()->comment('Conohaテナント名')->after('conoha_tenant_id');
            $table->text('conoha_container_name')->nullable()->comment('Conohaコンテナ名')->after('conoha_tenant_temporary_url_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('m_system_companies', function (Blueprint $table) {
            $table->dropColumn('conoha_tenant_username');
            $table->dropColumn('conoha_tenant_password');
            $table->dropColumn('conoha_tenant_name');
            $table->dropColumn('conoha_tenant_id');
            $table->dropColumn('conoha_tenant_temporary_url_key');
            $table->dropColumn('conoha_container_name');
        });
    }
};
