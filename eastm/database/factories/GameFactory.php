<?php


namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class GameFactory extends Factory
{
    protected $model = \App\Models\Game::class;


    public function definition()
    {
        $title = $this->faker->unique()->words(3, true);
        return [
            'title' => ucfirst($title),
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1,9999),
            'short_description' => $this->faker->sentence(10),
            'description' => $this->faker->paragraphs(4, true),
            'cover_image' => 'https://via.placeholder.com/600x800?text=' . urlencode($title),
            'hero_image' => 'https://via.placeholder.com/1400x400?text=' . urlencode($title),
            'video_url' => null,
            'price' => $this->faker->randomFloat(2, 0, 59.99),
            'is_featured' => $this->faker->boolean(30),
        ];
    }
}
