<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();

            $table->string('developer')->nullable();
            $table->string('publisher')->nullable();
            $table->date('release_date')->nullable();
            $table->string('product_genres')->nullable();

            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            $table->string('cover_image')->nullable();    // small banner or thumbnail
            $table->string('hero_image')->nullable();     // large header / hero image
            $table->string('video_url')->nullable();      // trailer path or YouTube link
            $table->json('screenshots')->nullable();      // array of screenshots (JSON)

            $table->string('tags')->nullable();           // comma-separated tags
            $table->decimal('price', 8, 2)->default(0);
            $table->boolean('is_featured')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
