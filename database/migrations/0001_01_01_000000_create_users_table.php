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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('full_name', 100)->nullable();
            $table->string('username', 50)->nullable();
            $table->string('email', 150);
            $table->string('password');
            $table->enum('role', ['ADMIN', 'USER'])->default('USER');
            $table->string('avatar_url')->nullable();
            $table->string('banner_url')->nullable();
            $table->text('bio')->nullable();
            $table->boolean('is_active')->default(true);
            $table->dateTime('last_login_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
