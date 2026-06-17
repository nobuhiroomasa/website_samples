<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('home_concept_heading')->nullable()->after('hero_catch_copy');
            $table->text('home_concept_description')->nullable()->after('home_concept_heading');
            $table->string('home_primary_button_label')->nullable()->after('home_concept_description');
            $table->string('home_secondary_button_label')->nullable()->after('home_primary_button_label');
            $table->string('home_stay_heading')->nullable()->after('home_secondary_button_label');
            $table->string('home_stay_link_label')->nullable()->after('home_stay_heading');
            $table->string('home_news_heading')->nullable()->after('home_stay_link_label');
            $table->string('home_events_heading')->nullable()->after('home_news_heading');
            $table->string('home_gallery_heading')->nullable()->after('home_events_heading');
            $table->string('home_gallery_link_label')->nullable()->after('home_gallery_heading');

            $table->string('about_heading')->nullable()->after('home_gallery_link_label');
            $table->text('about_intro')->nullable()->after('about_heading');
            $table->string('about_image_path')->nullable()->after('about_intro');
            $table->string('about_story_title')->nullable()->after('about_image_path');
            $table->string('about_renovation_title')->nullable()->after('about_story_title');
            $table->string('about_community_title')->nullable()->after('about_renovation_title');

            $table->string('stay_heading')->nullable()->after('about_community_title');
            $table->text('stay_intro')->nullable()->after('stay_heading');
            $table->string('stay_image_path')->nullable()->after('stay_intro');

            $table->string('cafe_heading')->nullable()->after('stay_image_path');
            $table->text('cafe_intro')->nullable()->after('cafe_heading');
            $table->string('cafe_image_path')->nullable()->after('cafe_intro');
            $table->string('cafe_day_label')->nullable()->after('cafe_image_path');
            $table->string('cafe_night_label')->nullable()->after('cafe_day_label');

            $table->string('news_heading')->nullable()->after('cafe_night_label');
            $table->text('news_intro')->nullable()->after('news_heading');
            $table->string('news_image_path')->nullable()->after('news_intro');
            $table->string('news_announcements_title')->nullable()->after('news_image_path');
            $table->string('news_events_title')->nullable()->after('news_announcements_title');

            $table->string('gallery_heading')->nullable()->after('news_events_title');
            $table->text('gallery_intro')->nullable()->after('gallery_heading');
            $table->string('gallery_image_path')->nullable()->after('gallery_intro');

            $table->string('access_heading')->nullable()->after('gallery_image_path');
            $table->text('access_intro')->nullable()->after('access_heading');
            $table->string('access_image_path')->nullable()->after('access_intro');
            $table->string('access_address_title')->nullable()->after('access_image_path');
            $table->string('access_station_title')->nullable()->after('access_address_title');
            $table->string('access_tourist_title')->nullable()->after('access_station_title');

            $table->string('contact_image_path')->nullable()->after('contact_description');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'home_concept_heading',
                'home_concept_description',
                'home_primary_button_label',
                'home_secondary_button_label',
                'home_stay_heading',
                'home_stay_link_label',
                'home_news_heading',
                'home_events_heading',
                'home_gallery_heading',
                'home_gallery_link_label',
                'about_heading',
                'about_intro',
                'about_image_path',
                'about_story_title',
                'about_renovation_title',
                'about_community_title',
                'stay_heading',
                'stay_intro',
                'stay_image_path',
                'cafe_heading',
                'cafe_intro',
                'cafe_image_path',
                'cafe_day_label',
                'cafe_night_label',
                'news_heading',
                'news_intro',
                'news_image_path',
                'news_announcements_title',
                'news_events_title',
                'gallery_heading',
                'gallery_intro',
                'gallery_image_path',
                'access_heading',
                'access_intro',
                'access_image_path',
                'access_address_title',
                'access_station_title',
                'access_tourist_title',
                'contact_image_path',
            ]);
        });
    }
};
