<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Concerns\HandlesUploadedFiles;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventController extends Controller
{
    use HandlesUploadedFiles;

    public function index(): View
    {
        return view('owner.events.index', [
            'events' => Event::query()->orderByDesc('event_date')->get(),
        ]);
    }

    public function create(): View
    {
        return view('owner.events.create');
    }

    public function store(StoreEventRequest $request): RedirectResponse
    {
        $event = Event::create([
            ...$request->safe()->except(['image']),
            'image_path' => $this->storeUploadedFile($request->file('image'), 'events'),
            'is_published' => $request->boolean('is_published', true),
        ]);

        return redirect()->route('owner.events.edit', $event)->with('status', 'イベントを追加しました。');
    }

    public function edit(Event $event): View
    {
        return view('owner.events.edit', compact('event'));
    }

    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $event->update([
            ...$request->safe()->except(['image']),
            'image_path' => $this->replaceUploadedFile($event->image_path, $request->file('image'), 'events'),
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('owner.events.edit', $event)->with('status', 'イベントを更新しました。');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $this->deleteUploadedFile($event->image_path);
        $event->delete();

        return redirect()->route('owner.events.index')->with('status', 'イベントを削除しました。');
    }
}
