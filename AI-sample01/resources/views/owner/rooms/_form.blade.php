<div class="space-y-6 rounded-3xl bg-white p-6 shadow-sm">
    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label class="block text-sm font-semibold">部屋名</label>
            <input type="text" name="name" value="{{ old('name', $room->name ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
        </div>
        <div>
            <label class="block text-sm font-semibold">定員</label>
            <input type="number" name="capacity" min="1" value="{{ old('capacity', $room->capacity ?? 1) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-semibold">説明</label>
            <textarea name="description" rows="5" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('description', $room->description ?? '') }}</textarea>
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-semibold">設備</label>
            <textarea name="amenities" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('amenities', $room->amenities ?? '') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-semibold">画像</label>
            <input type="file" name="image" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
            @if (!empty($room?->image_path))
                <img src="{{ Storage::url($room->image_path) }}" alt="{{ $room->name }}" class="mt-4 h-40 w-full rounded-2xl object-cover">
            @endif
        </div>
        <div>
            <label class="block text-sm font-semibold">表示順</label>
            <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $room->sort_order ?? 0) }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
            <label class="mt-4 flex items-center gap-3 text-sm text-slate-600">
                <input type="hidden" name="is_published" value="0">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $room->is_published ?? true)) class="rounded border-slate-300">
                公開する
            </label>
        </div>
    </div>
</div>
<div class="mt-6 flex justify-end gap-3">
    <a href="{{ route('owner.rooms.index') }}" class="rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700">一覧へ戻る</a>
    <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">保存する</button>
</div>
