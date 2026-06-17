<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Concerns\HandlesUploadedFiles;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryItemRequest;
use App\Http\Requests\UpdateGalleryItemRequest;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryItemController extends Controller
{
    use HandlesUploadedFiles;

    public function index(): View
    {
        return view('owner.gallery-items.index', [
            'galleryItems' => GalleryItem::query()->orderBy('sort_order')->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('owner.gallery-items.create');
    }

    public function store(StoreGalleryItemRequest $request): RedirectResponse
    {
        $galleryItem = GalleryItem::create([
            ...$request->safe()->except(['image']),
            'image_path' => $this->storeUploadedFile($request->file('image'), 'gallery'),
            'sort_order' => $request->integer('sort_order'),
            'is_published' => $request->boolean('is_published', true),
        ]);

        return redirect()->route('owner.gallery-items.edit', $galleryItem)->with('status', 'ギャラリー写真を追加しました。');
    }

    public function edit(GalleryItem $galleryItem): View
    {
        return view('owner.gallery-items.edit', compact('galleryItem'));
    }

    public function update(UpdateGalleryItemRequest $request, GalleryItem $galleryItem): RedirectResponse
    {
        $galleryItem->update([
            ...$request->safe()->except(['image']),
            'image_path' => $this->replaceUploadedFile($galleryItem->image_path, $request->file('image'), 'gallery'),
            'sort_order' => $request->integer('sort_order'),
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('owner.gallery-items.edit', $galleryItem)->with('status', 'ギャラリー写真を更新しました。');
    }

    public function destroy(GalleryItem $galleryItem): RedirectResponse
    {
        $this->deleteUploadedFile($galleryItem->image_path);
        $galleryItem->delete();

        return redirect()->route('owner.gallery-items.index')->with('status', 'ギャラリー写真を削除しました。');
    }
}
