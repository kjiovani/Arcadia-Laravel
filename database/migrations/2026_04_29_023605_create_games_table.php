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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('genre', 80)->nullable();
            $table->string('platform', 80)->nullable();
            $table->integer('release_year')->nullable();
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->string('image_original_url')->nullable();
            $table->integer('cover_focus_x')->default(50);
            $table->integer('cover_focus_y')->default(50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
