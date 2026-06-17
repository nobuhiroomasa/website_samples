<div class="space-y-6 rounded-3xl bg-white p-6 shadow-sm">
    <div class="space-y-6">
        <div>
            <label class="block text-sm font-semibold">タイトル</label>
            <input type="text" name="title" value="{{ old('title', $event->title ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
        </div>
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <label class="block text-sm font-semibold">開催日</label>
                <input type="date" name="event_date" value="{{ old('event_date', isset($event?->event_date) ? $event->event_date->format('Y-m-d') : '') }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
            </div>
            <div>
                <label class="block text-sm font-semibold">写真</label>
                <input type="file" name="image" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                @if (!empty($event?->image_path))
                    <img src="{{ Storage::url($event->image_path) }}" alt="{{ $event->title }}" class="mt-4 h-40 w-full rounded-2xl object-cover">
                @endif
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold">説明</label>
            <textarea name="description" rows="8" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('description', $event->description ?? '') }}</textarea>
        </div>
        <label class="flex items-center gap-3 text-sm text-slate-600">
            <input type="hidden" name="is_published" value="0">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $event->is_published ?? true)) class="rounded border-slate-300">
            公開する
        </label>
    </div>
</div>
<div class="mt-6 flex justify-end gap-3">
    <a href="{{ route('owner.events.index') }}" class="rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700">一覧へ戻る</a>
    <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">保存する</button>
</div>
