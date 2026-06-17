@extends('layouts.owner')

@section('title', 'ギャラリー管理')
@section('heading', 'ギャラリー管理')

@section('content')
    <div class="flex justify-end">
        <a href="{{ route('owner.gallery-items.create') }}" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">写真を追加</a>
    </div>

    <div class="mt-6 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($galleryItems as $galleryItem)
            <article class="overflow-hidden rounded-3xl bg-white shadow-sm">
                @if ($galleryItem->image_path)
                    <img src="{{ Storage::url($galleryItem->image_path) }}" alt="{{ $galleryItem->description }}" class="h-56 w-full object-cover">
                @endif
                <div class="p-5">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">{{ $galleryItem->category }}</p>
                    <p class="mt-3 text-sm leading-7 text-slate-600">{{ $galleryItem->description }}</p>
                    <div class="mt-5 flex justify-between gap-3">
                        <span class="text-xs text-slate-400">表示順: {{ $galleryItem->sort_order }}</span>
                        <div class="flex gap-3">
                            <a href="{{ route('owner.gallery-items.edit', $galleryItem) }}" class="rounded-xl border border-slate-300 px-4 py-2 text-sm">編集</a>
                            <form method="POST" action="{{ route('owner.gallery-items.destroy', $galleryItem) }}" onsubmit="return confirm('削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-xl border border-rose-300 px-4 py-2 text-sm text-rose-700">削除</button>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-3xl bg-white p-8 text-center text-slate-500 shadow-sm md:col-span-2 xl:col-span-3">ギャラリー画像はまだ登録されていません。</div>
        @endforelse
    </div>
@endsection
