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
        Schema::create('walkthroughs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained(
                table: 'games',
                column: 'id',
                indexName: 'fk_walkthroughs_game_id_games'
            );
            $table->string('title', 150);
            $table->text('overview')->nullable();
            $table->enum('difficulty', ['Easy', 'Medium', 'Hard'])->default('Medium');
            $table->string('cover_url')->nullable();
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
        Schema::dropIfExists('walkthroughs');
    }
};
