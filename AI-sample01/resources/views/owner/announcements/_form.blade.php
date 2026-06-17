<div class="space-y-6 rounded-3xl bg-white p-6 shadow-sm">
    <div class="space-y-6">
        <div>
            <label class="block text-sm font-semibold">タイトル</label>
            <input type="text" name="title" value="{{ old('title', $announcement->title ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
        </div>
        <div>
            <label class="block text-sm font-semibold">本文</label>
            <textarea name="body" rows="8" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">{{ old('body', $announcement->body ?? '') }}</textarea>
        </div>
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <label class="block text-sm font-semibold">公開日時</label>
                <input type="datetime-local" name="published_at" value="{{ old('published_at', isset($announcement?->published_at) ? $announcement->published_at->format('Y-m-d\TH:i') : '') }}" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
            </div>
            <div>
                <label class="block text-sm font-semibold">サムネイル</label>
                <input type="file" name="thumbnail" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3">
                @if (!empty($announcement?->thumbnail_path))
                    <img src="{{ Storage::url($announcement->thumbnail_path) }}" alt="{{ $announcement->title }}" class="mt-4 h-40 w-full rounded-2xl object-cover">
                @endif
            </div>
        </div>
        <label class="flex items-center gap-3 text-sm text-slate-600">
            <input type="hidden" name="is_published" value="0">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $announcement->is_published ?? true)) class="rounded border-slate-300">
            公開する
        </label>
    </div>
</div>
<div class="mt-6 flex justify-end gap-3">
    <a href="{{ route('owner.announcements.index') }}" class="rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700">一覧へ戻る</a>
    <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">保存する</button>
</div>
