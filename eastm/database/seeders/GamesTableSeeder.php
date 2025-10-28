<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Game;


class GamesTableSeeder extends Seeder
{
    public function run()
    {
// สร้าง 12 เกมตัวอย่าง
        Game::factory()->count(12)->create();


// ตัวอย่างเกมจริงแบบกำหนดเอง
        Game::create([
            'title' => 'Resident Evil 4',
            'slug' => 'resident-evil-4',
            'short_description' => 'Remake of the classic horror action.',
            'description' => 'Full description here...',
            'cover_image' => 'https://via.placeholder.com/600x800?text=Resident+Evil+4',
            'hero_image' => 'https://via.placeholder.com/1400x400?text=Resident+Evil+4',
            'video_url' => null,
            'price' => 19.99,
            'is_featured' => true,
        ]);
    }
}
