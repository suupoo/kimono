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
        Schema::create('system_email_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->unsignedBigInteger('models_id');
            $table->string('email');
            $table->text('token');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->unique(['model', 'token']);// モデル名とトークンの組み合わせはユニーク
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_email_verifications');
    }
};
