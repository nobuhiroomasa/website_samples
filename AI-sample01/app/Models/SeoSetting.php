<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['page_key', 'title', 'meta_description', 'og_image_path'])]
class SeoSetting extends Model
{
    public const PAGE_KEYS = [
        'home',
        'about',
        'stay',
        'cafe',
        'news',
        'gallery',
        'access',
        'contact',
    ];

    public static function forPage(string $pageKey): self
    {
        return static::query()->firstOrCreate(
            ['page_key' => $pageKey],
            [
                'title' => '宿福 SHUKUFUKU',
                'meta_description' => '宿福 SHUKUFUKU の公式サイトです。',
            ],
        );
    }
}
