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
        Schema::create('walktags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('walk_id')->constrained(
                table: 'walkthroughs',
                column: 'id',
                indexName: 'fk_walktags_walk_id_walkthroughs'
            );
            $table->foreignId('tag_id')->constrained(
                table: 'tags',
                column: 'id',
                indexName: 'fk_walktags_tag_id_tags'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('walktags');
    }
};
