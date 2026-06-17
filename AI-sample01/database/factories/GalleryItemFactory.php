<?php

namespace Database\Factories;

use App\Models\GalleryItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GalleryItem>
 */
class GalleryItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category' => fake()->randomElement(['宿泊', 'カフェ', '福庵', 'イベント', '庭園']),
            'description' => fake()->sentence(),
            'image_path' => 'gallery/sample.jpg',
            'sort_order' => fake()->numberBetween(1, 50),
            'is_published' => true,
        ];
    }
}
