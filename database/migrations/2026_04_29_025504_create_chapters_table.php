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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('walk_id')->constrained(
                table: 'walkthroughs',
                column: 'id',
                indexName: 'fk_chapters_walk_id_walkthroughs'
            );
            $table->string('title', 150);
            $table->text('content')->nullable();
            $table->integer('order_number')->default(1);
            $table->string('youtube_url')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
