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
        Schema::create('friendships', function (Blueprint $table) {
                $table->id();
                $table->foreignId('first_user')->constrained('users')->cascadeOnDelete();
                $table->foreignId('second_user')->constrained('users')->cascadeOnDelete();
                $table->integer('acted_user')->index();
                $table->enum('status', ['pending', 'confirmed', 'blocked']);
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friendships');
    }
};
