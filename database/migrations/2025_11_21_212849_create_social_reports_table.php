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
        Schema::create('social_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('social_post_id');
            $table->integer('likes')->nullable();
            $table->integer('comments')->nullable();
            $table->integer('shares')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_reports');
    }
};
