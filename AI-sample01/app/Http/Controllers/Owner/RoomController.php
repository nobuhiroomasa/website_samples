<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Concerns\HandlesUploadedFiles;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoomController extends Controller
{
    use HandlesUploadedFiles;

    public function index(): View
    {
        return view('owner.rooms.index', [
            'rooms' => Room::query()->orderBy('sort_order')->get(),
        ]);
    }

    public function create(): View
    {
        return view('owner.rooms.create');
    }

    public function store(StoreRoomRequest $request): RedirectResponse
    {
        $room = Room::create([
            ...$request->safe()->except(['image']),
            'image_path' => $this->storeUploadedFile($request->file('image'), 'rooms'),
            'sort_order' => $request->integer('sort_order'),
            'is_published' => $request->boolean('is_published', true),
        ]);

        return redirect()->route('owner.rooms.edit', $room)->with('status', '客室を追加しました。');
    }

    public function edit(Room $room): View
    {
        return view('owner.rooms.edit', compact('room'));
    }

    public function update(UpdateRoomRequest $request, Room $room): RedirectResponse
    {
        $room->update([
            ...$request->safe()->except(['image']),
            'image_path' => $this->replaceUploadedFile($room->image_path, $request->file('image'), 'rooms'),
            'sort_order' => $request->integer('sort_order'),
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('owner.rooms.edit', $room)->with('status', '客室を更新しました。');
    }

    public function destroy(Room $room): RedirectResponse
    {
        $this->deleteUploadedFile($room->image_path);
        $room->delete();

        return redirect()->route('owner.rooms.index')->with('status', '客室を削除しました。');
    }
}
