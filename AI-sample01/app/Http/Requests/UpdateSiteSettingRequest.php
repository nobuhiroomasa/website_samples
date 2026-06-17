<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return array_merge([
            'site_title' => ['required', 'string', 'max:255'],
            'catch_copy' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
            'instagram_url' => ['nullable', 'url'],
            'facebook_url' => ['nullable', 'url'],
            'x_url' => ['nullable', 'url'],
            'hero_image' => ['nullable', 'image', 'max:4096'],
            'hero_catch_copy' => ['nullable', 'string', 'max:255'],
            'home_concept_heading' => ['nullable', 'string', 'max:255'],
            'home_concept_description' => ['nullable', 'string'],
            'home_primary_button_label' => ['nullable', 'string', 'max:255'],
            'home_secondary_button_label' => ['nullable', 'string', 'max:255'],
            'home_stay_heading' => ['nullable', 'string', 'max:255'],
            'home_stay_link_label' => ['nullable', 'string', 'max:255'],
            'home_news_heading' => ['nullable', 'string', 'max:255'],
            'home_events_heading' => ['nullable', 'string', 'max:255'],
            'home_gallery_heading' => ['nullable', 'string', 'max:255'],
            'home_gallery_link_label' => ['nullable', 'string', 'max:255'],
            'about_heading' => ['nullable', 'string', 'max:255'],
            'about_intro' => ['nullable', 'string'],
            'about_image' => ['nullable', 'image', 'max:4096'],
            'about_story_title' => ['nullable', 'string', 'max:255'],
            'about_renovation_title' => ['nullable', 'string', 'max:255'],
            'about_community_title' => ['nullable', 'string', 'max:255'],
            'about_story' => ['nullable', 'string'],
            'about_renovation' => ['nullable', 'string'],
            'about_community' => ['nullable', 'string'],
            'stay_heading' => ['nullable', 'string', 'max:255'],
            'stay_intro' => ['nullable', 'string'],
            'stay_image' => ['nullable', 'image', 'max:4096'],
            'cafe_heading' => ['nullable', 'string', 'max:255'],
            'cafe_intro' => ['nullable', 'string'],
            'cafe_image' => ['nullable', 'image', 'max:4096'],
            'cafe_day_label' => ['nullable', 'string', 'max:255'],
            'cafe_day_title' => ['nullable', 'string', 'max:255'],
            'cafe_day_description' => ['nullable', 'string'],
            'cafe_day_image' => ['nullable', 'image', 'max:4096'],
            'cafe_night_label' => ['nullable', 'string', 'max:255'],
            'cafe_night_title' => ['nullable', 'string', 'max:255'],
            'cafe_night_description' => ['nullable', 'string'],
            'cafe_night_image' => ['nullable', 'image', 'max:4096'],
            'news_heading' => ['nullable', 'string', 'max:255'],
            'news_intro' => ['nullable', 'string'],
            'news_image' => ['nullable', 'image', 'max:4096'],
            'news_announcements_title' => ['nullable', 'string', 'max:255'],
            'news_events_title' => ['nullable', 'string', 'max:255'],
            'gallery_heading' => ['nullable', 'string', 'max:255'],
            'gallery_intro' => ['nullable', 'string'],
            'gallery_image' => ['nullable', 'image', 'max:4096'],
            'access_heading' => ['nullable', 'string', 'max:255'],
            'access_intro' => ['nullable', 'string'],
            'access_image' => ['nullable', 'image', 'max:4096'],
            'access_address_title' => ['nullable', 'string', 'max:255'],
            'access_station_title' => ['nullable', 'string', 'max:255'],
            'access_tourist_title' => ['nullable', 'string', 'max:255'],
            'access_map_embed' => ['nullable', 'string'],
            'access_station_info' => ['nullable', 'string'],
            'access_tourist_info' => ['nullable', 'string'],
            'contact_heading' => ['nullable', 'string', 'max:255'],
            'contact_description' => ['nullable', 'string'],
            'contact_image' => ['nullable', 'image', 'max:4096'],
            'seo' => ['nullable', 'array'],
            'seo.*.title' => ['nullable', 'string', 'max:255'],
            'seo.*.meta_description' => ['nullable', 'string', 'max:1000'],
            'seo.*.og_image' => ['nullable', 'image', 'max:4096'],
        ], []);
    }
}
