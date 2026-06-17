<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Concerns\HandlesUploadedFiles;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSiteSettingRequest;
use App\Models\SeoSetting;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    use HandlesUploadedFiles;

    public function edit(): View
    {
        return view('owner.settings.edit', [
            'siteSetting' => SiteSetting::current(),
            'seoSettings' => collect(SeoSetting::PAGE_KEYS)
                ->mapWithKeys(fn (string $pageKey) => [$pageKey => SeoSetting::forPage($pageKey)]),
        ]);
    }

    public function update(UpdateSiteSettingRequest $request): RedirectResponse
    {
        $siteSetting = SiteSetting::current();
        $imageFields = [
            'hero_image' => 'hero_image_path',
            'about_image' => 'about_image_path',
            'stay_image' => 'stay_image_path',
            'cafe_image' => 'cafe_image_path',
            'cafe_day_image' => 'cafe_day_image_path',
            'cafe_night_image' => 'cafe_night_image_path',
            'news_image' => 'news_image_path',
            'gallery_image' => 'gallery_image_path',
            'access_image' => 'access_image_path',
            'contact_image' => 'contact_image_path',
        ];

        $siteSetting->fill($request->safe()->except([
            ...array_keys($imageFields),
            'seo',
        ]));

        foreach ($imageFields as $inputName => $columnName) {
            $siteSetting->{$columnName} = $this->replaceUploadedFile(
                $siteSetting->{$columnName},
                $request->file($inputName),
                'site',
            );
        }

        $siteSetting->save();

        foreach (SeoSetting::PAGE_KEYS as $pageKey) {
            $seoSetting = SeoSetting::forPage($pageKey);
            $seoData = $request->input("seo.{$pageKey}", []);
            $seoSetting->fill([
                'title' => $seoData['title'] ?? $seoSetting->title,
                'meta_description' => $seoData['meta_description'] ?? $seoSetting->meta_description,
            ]);
            $seoSetting->og_image_path = $this->replaceUploadedFile(
                $seoSetting->og_image_path,
                $request->file("seo.{$pageKey}.og_image"),
                'seo',
            );
            $seoSetting->save();
        }

        return redirect()->route('owner.settings.edit')->with('status', 'サイト設定を更新しました。');
    }
}
