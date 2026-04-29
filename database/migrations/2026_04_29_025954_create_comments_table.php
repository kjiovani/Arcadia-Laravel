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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained(
                table: 'games',
                column: 'id',
                indexName: 'fk_comments_game_id_games'
            );
            $table->foreignId('user_id')->constrained(
                table: 'users',
                column: 'id',
                indexName: 'fk_comments_user_id_users'
            );
            $table->text('body');
            $table->enum('status', ['PUBLISHED', 'HIDDEN'])->default('PUBLISHED');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
