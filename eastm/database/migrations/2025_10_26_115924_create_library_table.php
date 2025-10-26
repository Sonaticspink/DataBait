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
        Schema::create('library', function (Blueprint $table) {
            $table->id('library_id');
            $table->foreignId('owner_id')->unique()->constrained('users', 'user_id');
            $table->foreignId('game_id')->constrained('products', 'product_id');
            $table->string('game_icon')->nullable(); // image type → store as string (path)
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library');
    }
};
