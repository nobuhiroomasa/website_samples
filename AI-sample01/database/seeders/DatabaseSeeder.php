<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Event;
use App\Models\GalleryItem;
use App\Models\Room;
use App\Models\SeoSetting;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        SiteSetting::current();

        foreach (SeoSetting::PAGE_KEYS as $pageKey) {
            SeoSetting::forPage($pageKey);
        }

        User::factory()->admin()->create([
            'name' => 'Owner Admin',
            'email' => 'owner@example.com',
        ]);

        $rooms = [
            ['name' => 'カスミ', 'sort_order' => 1, 'capacity' => 2],
            ['name' => 'カエデ', 'sort_order' => 2, 'capacity' => 4],
            ['name' => 'ヒマワリ', 'sort_order' => 3, 'capacity' => 4],
            ['name' => 'キク', 'sort_order' => 4, 'capacity' => 6],
        ];

        foreach ($rooms as $room) {
            Room::factory()->create([
                'name' => $room['name'],
                'sort_order' => $room['sort_order'],
                'capacity' => $room['capacity'],
            ]);
        }

        Announcement::factory(3)->create();
        Event::factory(3)->create();
        GalleryItem::factory(8)->create();
    }
}
