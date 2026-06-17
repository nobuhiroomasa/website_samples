<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title');
            $table->string('catch_copy');
            $table->text('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('x_url')->nullable();
            $table->string('hero_image_path')->nullable();
            $table->string('hero_catch_copy')->nullable();
            $table->text('about_story')->nullable();
            $table->text('about_renovation')->nullable();
            $table->text('about_community')->nullable();
            $table->string('cafe_day_title')->nullable();
            $table->text('cafe_day_description')->nullable();
            $table->string('cafe_day_image_path')->nullable();
            $table->string('cafe_night_title')->nullable();
            $table->text('cafe_night_description')->nullable();
            $table->string('cafe_night_image_path')->nullable();
            $table->longText('access_map_embed')->nullable();
            $table->text('access_station_info')->nullable();
            $table->text('access_tourist_info')->nullable();
            $table->string('contact_heading')->nullable();
            $table->text('contact_description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
