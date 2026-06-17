<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'site_title',
    'catch_copy',
    'description',
    'phone',
    'address',
    'instagram_url',
    'facebook_url',
    'x_url',
    'hero_image_path',
    'hero_catch_copy',
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
    'about_story',
    'about_renovation',
    'about_community',
    'stay_heading',
    'stay_intro',
    'stay_image_path',
    'cafe_heading',
    'cafe_intro',
    'cafe_image_path',
    'cafe_day_label',
    'cafe_day_title',
    'cafe_day_description',
    'cafe_day_image_path',
    'cafe_night_label',
    'cafe_night_title',
    'cafe_night_description',
    'cafe_night_image_path',
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
    'access_map_embed',
    'access_station_info',
    'access_tourist_info',
    'contact_heading',
    'contact_description',
    'contact_image_path',
])]
class SiteSetting extends Model
{
    public static function current(): self
    {
        $defaults = [
            'site_title' => '宿福 SHUKUFUKU',
            'catch_copy' => '新しいのに懐かしい。人と人がつながる宿。',
            'description' => '大阪・都島の古民家ゲストハウス「宿福 SHUKUFUKU」の公式サイトです。',
            'phone' => '06-0000-0000',
            'address' => '大阪府大阪市都島区',
            'hero_catch_copy' => '新しいのに懐かしい。人と人がつながる宿。',
            'home_concept_heading' => '新しいのに懐かしい。人と人がつながる宿。',
            'home_concept_description' => '築70年の古民家をリノベーションした、地域と旅人がゆるやかにつながる宿です。',
            'home_primary_button_label' => '宿泊を見る',
            'home_secondary_button_label' => 'お問い合わせ',
            'home_stay_heading' => '客室',
            'home_stay_link_label' => 'すべて見る',
            'home_news_heading' => 'お知らせ',
            'home_events_heading' => 'イベント',
            'home_gallery_heading' => 'ギャラリー',
            'home_gallery_link_label' => 'もっと見る',
            'about_heading' => '宿福について',
            'about_intro' => '古民家の落ち着きと、旅人や地域の人が自然につながる空気を大切にしています。',
            'about_story_title' => '宿福の想い',
            'about_renovation_title' => '築70年古民家のリノベーション',
            'about_community_title' => '地域とのつながり',
            'about_story' => '築70年の古民家をリノベーションした、地域と旅人がゆるやかにつながる宿です。',
            'about_renovation' => '囲炉裏や庭園の風景を残しつつ、快適に滞在できる空間へ整えています。',
            'about_community' => '宿泊、カフェ、日本酒、イベントを通じて、出会いが自然に生まれる場所を目指しています。',
            'stay_heading' => '宿泊',
            'stay_intro' => 'カスミ、カエデ、ヒマワリ、キク。個性の異なる4つの客室で、静かな時間を過ごせます。',
            'cafe_heading' => 'カフェ＆バー',
            'cafe_intro' => '昼はやさしいカフェ、夜は日本酒を楽しめる和Barとして、宿福らしい時間を提供します。',
            'cafe_day_label' => '昼',
            'cafe_day_title' => 'にじいろ堂',
            'cafe_day_description' => '昼はやさしい光が差し込むカフェ空間で、ほっと一息つける時間を提供します。',
            'cafe_night_label' => '夜',
            'cafe_night_title' => '福庵',
            'cafe_night_description' => '夜は日本酒と会話を楽しめる和Barとして、旅の余韻を深めます。',
            'news_heading' => 'イベント・お知らせ',
            'news_intro' => '宿福の日々の出来事や、滞在前に知っておきたい最新情報を掲載しています。',
            'news_announcements_title' => 'お知らせ',
            'news_events_title' => 'イベント',
            'gallery_heading' => 'ギャラリー',
            'gallery_intro' => '宿泊、カフェ、福庵、イベント、庭園。宿福で流れる時間を写真で紹介します。',
            'access_heading' => 'アクセス',
            'access_intro' => '大阪・都島の古民家ゲストハウス。観光にもローカル散策にも便利な立地です。',
            'access_address_title' => '住所',
            'access_station_title' => '駅からのアクセス',
            'access_tourist_title' => '周辺観光案内',
            'access_station_info' => '最寄り駅から徒歩圏内。大阪観光の拠点として使いやすい立地です。',
            'access_tourist_info' => '大阪城、梅田エリア、下町散策など周辺観光との相性も良好です。',
            'contact_heading' => 'お問い合わせ',
            'contact_description' => '宿泊やイベント、施設についてのお問い合わせを受け付けています。',
        ];

        $siteSetting = static::query()->firstOrCreate(
            ['id' => 1],
            $defaults,
        );

        $backfillFields = [
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
            'about_story_title',
            'about_renovation_title',
            'about_community_title',
            'stay_heading',
            'stay_intro',
            'cafe_heading',
            'cafe_intro',
            'cafe_day_label',
            'cafe_night_label',
            'news_heading',
            'news_intro',
            'news_announcements_title',
            'news_events_title',
            'gallery_heading',
            'gallery_intro',
            'access_heading',
            'access_intro',
            'access_address_title',
            'access_station_title',
            'access_tourist_title',
        ];

        $missingDefaults = [];

        foreach ($backfillFields as $field) {
            if (is_null($siteSetting->{$field})) {
                $missingDefaults[$field] = $defaults[$field];
            }
        }

        if ($missingDefaults !== []) {
            $siteSetting->fill($missingDefaults);
            $siteSetting->save();
        }

        return $siteSetting;
    }
}
