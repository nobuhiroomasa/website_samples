<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'event_date' => now()->addDays(fake()->numberBetween(1, 60)),
            'description' => fake()->paragraphs(2, true),
            'image_path' => null,
            'is_published' => true,
        ];
    }
}
