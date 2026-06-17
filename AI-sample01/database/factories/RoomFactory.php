<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Room>
 */
class RoomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['カスミ', 'カエデ', 'ヒマワリ', 'キク']),
            'description' => fake()->paragraphs(2, true),
            'capacity' => fake()->numberBetween(2, 6),
            'amenities' => 'Wi-Fi / エアコン / タオル / ドライヤー',
            'image_path' => null,
            'sort_order' => fake()->numberBetween(1, 10),
            'is_published' => true,
        ];
    }
}
