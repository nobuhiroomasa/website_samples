<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Concerns\HandlesUploadedFiles;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    use HandlesUploadedFiles;

    public function index(): View
    {
        return view('owner.announcements.index', [
            'announcements' => Announcement::query()->latest('published_at')->get(),
        ]);
    }

    public function create(): View
    {
        return view('owner.announcements.create');
    }

    public function store(StoreAnnouncementRequest $request): RedirectResponse
    {
        $announcement = Announcement::create([
            ...$request->safe()->except(['thumbnail']),
            'thumbnail_path' => $this->storeUploadedFile($request->file('thumbnail'), 'announcements'),
            'is_published' => $request->boolean('is_published', true),
        ]);

        return redirect()->route('owner.announcements.edit', $announcement)->with('status', 'お知らせを追加しました。');
    }

    public function edit(Announcement $announcement): View
    {
        return view('owner.announcements.edit', compact('announcement'));
    }

    public function update(UpdateAnnouncementRequest $request, Announcement $announcement): RedirectResponse
    {
        $announcement->update([
            ...$request->safe()->except(['thumbnail']),
            'thumbnail_path' => $this->replaceUploadedFile($announcement->thumbnail_path, $request->file('thumbnail'), 'announcements'),
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('owner.announcements.edit', $announcement)->with('status', 'お知らせを更新しました。');
    }

    public function destroy(Announcement $announcement): RedirectResponse
    {
        $this->deleteUploadedFile($announcement->thumbnail_path);
        $announcement->delete();

        return redirect()->route('owner.announcements.index')->with('status', 'お知らせを削除しました。');
    }
}
