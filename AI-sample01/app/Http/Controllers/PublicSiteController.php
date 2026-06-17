<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Event;
use App\Models\GalleryItem;
use App\Models\Room;
use App\Models\SeoSetting;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PublicSiteController extends Controller
{
    public function home(): View
    {
        $siteSetting = SiteSetting::current();

        return view('public.home', [
            'siteSetting' => $siteSetting,
            'seo' => $this->resolveSeo('home', $siteSetting),
            'rooms' => Room::query()->where('is_published', true)->orderBy('sort_order')->limit(4)->get(),
            'announcements' => Announcement::query()->where('is_published', true)->latest('published_at')->limit(3)->get(),
            'events' => Event::query()->where('is_published', true)->orderBy('event_date')->limit(3)->get(),
            'galleryItems' => GalleryItem::query()->where('is_published', true)->orderBy('sort_order')->limit(6)->get(),
        ]);
    }

    public function about(): View
    {
        $siteSetting = SiteSetting::current();

        return view('public.about', [
            'siteSetting' => $siteSetting,
            'seo' => $this->resolveSeo('about', $siteSetting),
        ]);
    }

    public function stay(): View
    {
        $siteSetting = SiteSetting::current();

        return view('public.stay', [
            'siteSetting' => $siteSetting,
            'seo' => $this->resolveSeo('stay', $siteSetting),
            'rooms' => Room::query()->where('is_published', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function cafe(): View
    {
        $siteSetting = SiteSetting::current();

        return view('public.cafe', [
            'siteSetting' => $siteSetting,
            'seo' => $this->resolveSeo('cafe', $siteSetting),
        ]);
    }

    public function news(): View
    {
        $siteSetting = SiteSetting::current();

        return view('public.news', [
            'siteSetting' => $siteSetting,
            'seo' => $this->resolveSeo('news', $siteSetting),
            'announcements' => Announcement::query()->where('is_published', true)->latest('published_at')->get(),
            'events' => Event::query()->where('is_published', true)->orderBy('event_date')->get(),
        ]);
    }

    public function gallery(): View
    {
        $siteSetting = SiteSetting::current();

        return view('public.gallery', [
            'siteSetting' => $siteSetting,
            'seo' => $this->resolveSeo('gallery', $siteSetting),
            'galleryItems' => GalleryItem::query()->where('is_published', true)->orderBy('sort_order')->get()->groupBy('category'),
        ]);
    }

    public function access(): View
    {
        $siteSetting = SiteSetting::current();

        return view('public.access', [
            'siteSetting' => $siteSetting,
            'seo' => $this->resolveSeo('access', $siteSetting),
        ]);
    }

    public function contact(): View
    {
        $siteSetting = SiteSetting::current();

        return view('public.contact', [
            'siteSetting' => $siteSetting,
            'seo' => $this->resolveSeo('contact', $siteSetting),
        ]);
    }

    private function resolveSeo(string $pageKey, SiteSetting $siteSetting): array
    {
        $seo = SeoSetting::forPage($pageKey);

        return [
            'title' => $seo->title ?: $siteSetting->site_title,
            'description' => $seo->meta_description ?: $siteSetting->description,
            'ogImageUrl' => $seo->og_image_path
                ? Storage::url($seo->og_image_path)
                : ($siteSetting->hero_image_path ? Storage::url($siteSetting->hero_image_path) : null),
        ];
    }
}
