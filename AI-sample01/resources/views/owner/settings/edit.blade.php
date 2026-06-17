@extends('layouts.owner')

@section('title', 'サイト設定')
@section('heading', 'サイト設定')

@php
    $pageLabels = [
        'home' => 'トップページ',
        'about' => '宿福について',
        'stay' => '宿泊',
        'cafe' => 'カフェ＆バー',
        'news' => 'イベント・お知らせ',
        'gallery' => 'ギャラリー',
        'access' => 'アクセス',
        'contact' => 'お問い合わせ',
    ];
@endphp

@section('content')
    <form method="POST" action="{{ route('owner.settings.update') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <section class="rounded-3xl bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold">基本情報</h3>
            <div class="mt-6 grid gap-6 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold">サイトタイトル</label>
                    <input type="text" name="site_title" value="{{ old('site_title', $siteSetting->site_title) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">サイト全体キャッチコピー</label>
                    <input type="text" name="catch_copy" value="{{ old('catch_copy', $siteSetting->catch_copy) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold">説明文</label>
                    <textarea name="description" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('description', $siteSetting->description) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold">電話番号</label>
                    <input type="text" name="phone" value="{{ old('phone', $siteSetting->phone) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">住所</label>
                    <input type="text" name="address" value="{{ old('address', $siteSetting->address) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">Instagram URL</label>
                    <input type="url" name="instagram_url" value="{{ old('instagram_url', $siteSetting->instagram_url) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">Facebook URL</label>
                    <input type="url" name="facebook_url" value="{{ old('facebook_url', $siteSetting->facebook_url) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">X URL</label>
                    <input type="url" name="x_url" value="{{ old('x_url', $siteSetting->x_url) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
            </div>
        </section>

        <section class="rounded-3xl bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold">トップページ表示設定</h3>
            <div class="mt-6 grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold">ヒーロー画像</label>
                    <input type="file" name="hero_image" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    @if ($siteSetting->hero_image_path)
                        <img src="{{ Storage::url($siteSetting->hero_image_path) }}" alt="ヒーロー画像" class="mt-4 h-52 w-full rounded-2xl object-cover">
                    @endif
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold">ヒーローキャッチコピー</label>
                        <input type="text" name="hero_catch_copy" value="{{ old('hero_catch_copy', $siteSetting->hero_catch_copy) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">コンセプト見出し</label>
                        <input type="text" name="home_concept_heading" value="{{ old('home_concept_heading', $siteSetting->home_concept_heading) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">コンセプト説明</label>
                        <textarea name="home_concept_description" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('home_concept_description', $siteSetting->home_concept_description) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="mt-6 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                <div>
                    <label class="block text-sm font-semibold">宿泊導線ボタン文言</label>
                    <input type="text" name="home_primary_button_label" value="{{ old('home_primary_button_label', $siteSetting->home_primary_button_label) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">お問い合わせ導線ボタン文言</label>
                    <input type="text" name="home_secondary_button_label" value="{{ old('home_secondary_button_label', $siteSetting->home_secondary_button_label) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">客室セクション見出し</label>
                    <input type="text" name="home_stay_heading" value="{{ old('home_stay_heading', $siteSetting->home_stay_heading) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">客室セクションリンク文言</label>
                    <input type="text" name="home_stay_link_label" value="{{ old('home_stay_link_label', $siteSetting->home_stay_link_label) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">お知らせセクション見出し</label>
                    <input type="text" name="home_news_heading" value="{{ old('home_news_heading', $siteSetting->home_news_heading) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">イベントセクション見出し</label>
                    <input type="text" name="home_events_heading" value="{{ old('home_events_heading', $siteSetting->home_events_heading) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">ギャラリーセクション見出し</label>
                    <input type="text" name="home_gallery_heading" value="{{ old('home_gallery_heading', $siteSetting->home_gallery_heading) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">ギャラリーセクションリンク文言</label>
                    <input type="text" name="home_gallery_link_label" value="{{ old('home_gallery_link_label', $siteSetting->home_gallery_link_label) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
            </div>
        </section>

        <section class="rounded-3xl bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold">宿福についてページ</h3>
            <div class="mt-6 grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold">ページ画像</label>
                    <input type="file" name="about_image" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    @if ($siteSetting->about_image_path)
                        <img src="{{ Storage::url($siteSetting->about_image_path) }}" alt="宿福について画像" class="mt-4 h-52 w-full rounded-2xl object-cover">
                    @endif
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold">ページ見出し</label>
                        <input type="text" name="about_heading" value="{{ old('about_heading', $siteSetting->about_heading) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">導入文</label>
                        <textarea name="about_intro" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('about_intro', $siteSetting->about_intro) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="mt-6 grid gap-6 md:grid-cols-3">
                <div>
                    <label class="block text-sm font-semibold">ブロック1見出し</label>
                    <input type="text" name="about_story_title" value="{{ old('about_story_title', $siteSetting->about_story_title) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">ブロック2見出し</label>
                    <input type="text" name="about_renovation_title" value="{{ old('about_renovation_title', $siteSetting->about_renovation_title) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">ブロック3見出し</label>
                    <input type="text" name="about_community_title" value="{{ old('about_community_title', $siteSetting->about_community_title) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
            </div>
            <div class="mt-6 space-y-6">
                <div>
                    <label class="block text-sm font-semibold">宿福の想い</label>
                    <textarea name="about_story" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('about_story', $siteSetting->about_story) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold">古民家リノベーション説明</label>
                    <textarea name="about_renovation" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('about_renovation', $siteSetting->about_renovation) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold">地域・コミュニティ説明</label>
                    <textarea name="about_community" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('about_community', $siteSetting->about_community) }}</textarea>
                </div>
            </div>
        </section>

        <section class="rounded-3xl bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold">宿泊ページ</h3>
            <div class="mt-6 grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold">ページ画像</label>
                    <input type="file" name="stay_image" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    @if ($siteSetting->stay_image_path)
                        <img src="{{ Storage::url($siteSetting->stay_image_path) }}" alt="宿泊画像" class="mt-4 h-52 w-full rounded-2xl object-cover">
                    @endif
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold">ページ見出し</label>
                        <input type="text" name="stay_heading" value="{{ old('stay_heading', $siteSetting->stay_heading) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">導入文</label>
                        <textarea name="stay_intro" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('stay_intro', $siteSetting->stay_intro) }}</textarea>
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-3xl bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold">カフェ＆バー</h3>
            <div class="mt-6 grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold">ページ画像</label>
                    <input type="file" name="cafe_image" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    @if ($siteSetting->cafe_image_path)
                        <img src="{{ Storage::url($siteSetting->cafe_image_path) }}" alt="カフェページ画像" class="mt-4 h-52 w-full rounded-2xl object-cover">
                    @endif
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold">ページ見出し</label>
                        <input type="text" name="cafe_heading" value="{{ old('cafe_heading', $siteSetting->cafe_heading) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">導入文</label>
                        <textarea name="cafe_intro" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('cafe_intro', $siteSetting->cafe_intro) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="mt-6 grid gap-8 lg:grid-cols-2">
                <div class="space-y-4 rounded-2xl border border-slate-200 p-5">
                    <div>
                        <label class="block text-sm font-semibold">昼ラベル</label>
                        <input type="text" name="cafe_day_label" value="{{ old('cafe_day_label', $siteSetting->cafe_day_label) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">昼タイトル</label>
                        <input type="text" name="cafe_day_title" value="{{ old('cafe_day_title', $siteSetting->cafe_day_title) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">昼説明</label>
                        <textarea name="cafe_day_description" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('cafe_day_description', $siteSetting->cafe_day_description) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">昼画像</label>
                        <input type="file" name="cafe_day_image" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                        @if ($siteSetting->cafe_day_image_path)
                            <img src="{{ Storage::url($siteSetting->cafe_day_image_path) }}" alt="昼画像" class="mt-4 h-40 w-full rounded-2xl object-cover">
                        @endif
                    </div>
                </div>
                <div class="space-y-4 rounded-2xl border border-slate-200 p-5">
                    <div>
                        <label class="block text-sm font-semibold">夜ラベル</label>
                        <input type="text" name="cafe_night_label" value="{{ old('cafe_night_label', $siteSetting->cafe_night_label) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">夜タイトル</label>
                        <input type="text" name="cafe_night_title" value="{{ old('cafe_night_title', $siteSetting->cafe_night_title) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">夜説明</label>
                        <textarea name="cafe_night_description" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('cafe_night_description', $siteSetting->cafe_night_description) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">夜画像</label>
                        <input type="file" name="cafe_night_image" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                        @if ($siteSetting->cafe_night_image_path)
                            <img src="{{ Storage::url($siteSetting->cafe_night_image_path) }}" alt="夜画像" class="mt-4 h-40 w-full rounded-2xl object-cover">
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-3xl bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold">イベント・お知らせページ</h3>
            <div class="mt-6 grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold">ページ画像</label>
                    <input type="file" name="news_image" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    @if ($siteSetting->news_image_path)
                        <img src="{{ Storage::url($siteSetting->news_image_path) }}" alt="イベント・お知らせ画像" class="mt-4 h-52 w-full rounded-2xl object-cover">
                    @endif
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold">ページ見出し</label>
                        <input type="text" name="news_heading" value="{{ old('news_heading', $siteSetting->news_heading) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">導入文</label>
                        <textarea name="news_intro" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('news_intro', $siteSetting->news_intro) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">お知らせ見出し</label>
                        <input type="text" name="news_announcements_title" value="{{ old('news_announcements_title', $siteSetting->news_announcements_title) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">イベント見出し</label>
                        <input type="text" name="news_events_title" value="{{ old('news_events_title', $siteSetting->news_events_title) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-3xl bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold">ギャラリーページ</h3>
            <div class="mt-6 grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold">ページ画像</label>
                    <input type="file" name="gallery_image" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    @if ($siteSetting->gallery_image_path)
                        <img src="{{ Storage::url($siteSetting->gallery_image_path) }}" alt="ギャラリー画像" class="mt-4 h-52 w-full rounded-2xl object-cover">
                    @endif
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold">ページ見出し</label>
                        <input type="text" name="gallery_heading" value="{{ old('gallery_heading', $siteSetting->gallery_heading) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">導入文</label>
                        <textarea name="gallery_intro" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('gallery_intro', $siteSetting->gallery_intro) }}</textarea>
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-3xl bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold">アクセスページ</h3>
            <div class="mt-6 grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold">ページ画像</label>
                    <input type="file" name="access_image" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    @if ($siteSetting->access_image_path)
                        <img src="{{ Storage::url($siteSetting->access_image_path) }}" alt="アクセス画像" class="mt-4 h-52 w-full rounded-2xl object-cover">
                    @endif
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold">ページ見出し</label>
                        <input type="text" name="access_heading" value="{{ old('access_heading', $siteSetting->access_heading) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">導入文</label>
                        <textarea name="access_intro" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('access_intro', $siteSetting->access_intro) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="mt-6 grid gap-6 md:grid-cols-3">
                <div>
                    <label class="block text-sm font-semibold">住所ブロック見出し</label>
                    <input type="text" name="access_address_title" value="{{ old('access_address_title', $siteSetting->access_address_title) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">駅からのアクセス見出し</label>
                    <input type="text" name="access_station_title" value="{{ old('access_station_title', $siteSetting->access_station_title) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">周辺観光案内見出し</label>
                    <input type="text" name="access_tourist_title" value="{{ old('access_tourist_title', $siteSetting->access_tourist_title) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                </div>
            </div>
            <div class="mt-6 space-y-6">
                <div>
                    <label class="block text-sm font-semibold">Google Map 埋め込みコード</label>
                    <textarea name="access_map_embed" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('access_map_embed', $siteSetting->access_map_embed) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold">駅からのアクセス</label>
                    <textarea name="access_station_info" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('access_station_info', $siteSetting->access_station_info) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold">周辺観光案内</label>
                    <textarea name="access_tourist_info" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('access_tourist_info', $siteSetting->access_tourist_info) }}</textarea>
                </div>
            </div>
        </section>

        <section class="rounded-3xl bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold">お問い合わせページ</h3>
            <div class="mt-6 grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold">ページ画像</label>
                    <input type="file" name="contact_image" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    @if ($siteSetting->contact_image_path)
                        <img src="{{ Storage::url($siteSetting->contact_image_path) }}" alt="お問い合わせ画像" class="mt-4 h-52 w-full rounded-2xl object-cover">
                    @endif
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold">ページ見出し</label>
                        <input type="text" name="contact_heading" value="{{ old('contact_heading', $siteSetting->contact_heading) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">説明文</label>
                        <textarea name="contact_description" rows="5" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('contact_description', $siteSetting->contact_description) }}</textarea>
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-3xl bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold">SEO設定</h3>
            <div class="mt-6 space-y-6">
                @foreach ($seoSettings as $pageKey => $seoSetting)
                    <div class="rounded-2xl border border-slate-200 p-5">
                        <h4 class="font-semibold">{{ $pageLabels[$pageKey] ?? $pageKey }}</h4>
                        <div class="mt-4 grid gap-6 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-semibold">title</label>
                                <input type="text" name="seo[{{ $pageKey }}][title]" value="{{ old("seo.{$pageKey}.title", $seoSetting->title) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold">OGP画像</label>
                                <input type="file" name="seo[{{ $pageKey }}][og_image]" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                                @if ($seoSetting->og_image_path)
                                    <img src="{{ Storage::url($seoSetting->og_image_path) }}" alt="{{ $pageLabels[$pageKey] ?? $pageKey }}" class="mt-4 h-32 w-full rounded-2xl object-cover">
                                @endif
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold">meta description</label>
                                <textarea name="seo[{{ $pageKey }}][meta_description]" rows="3" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old("seo.{$pageKey}.meta_description", $seoSetting->meta_description) }}</textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <div class="flex justify-end">
            <button type="submit" class="rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-700">設定を保存</button>
        </div>
    </form>
@endsection
