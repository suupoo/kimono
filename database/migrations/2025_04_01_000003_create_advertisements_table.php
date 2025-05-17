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
        Schema::create('kimono_advertisements', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('【ID】');
            $table->string('identifier')->unique()->comment('【識別名】');
            $table->string('type')->comment('【広告タイプ】');
            $table->string('name')->comment('【広告名】');
            $table->text('description')->nullable()->comment('【広告説明】');
            $table->text('url')->nullable()->comment('【URL】');
            $table->text('image')->nullable()->comment('【画像】');
            $table->tinyInteger('priority')->nullable()->comment('【優先順】');
            $table->boolean('active')->default(false)->comment('【有効フラグ】');
            $table->dateTime('start_at')->nullable()->comment('【開始日時】');
            $table->dateTime('end_at')->nullable()->comment('【終了日時】');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kimono_advertisements');
    }
};
