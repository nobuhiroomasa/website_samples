<?php

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Announcement>
 */
class AnnouncementFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'body' => fake()->paragraphs(3, true),
            'published_at' => now()->subDays(fake()->numberBetween(0, 14)),
            'thumbnail_path' => null,
            'is_published' => true,
        ];
    }
}
