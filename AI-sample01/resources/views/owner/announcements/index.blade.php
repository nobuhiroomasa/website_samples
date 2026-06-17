@extends('layouts.owner')

@section('title', 'お知らせ管理')
@section('heading', 'お知らせ管理')

@section('content')
    <div class="flex justify-end">
        <a href="{{ route('owner.announcements.create') }}" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">お知らせを追加</a>
    </div>

    <div class="mt-6 space-y-4">
        @forelse ($announcements as $announcement)
            <article class="rounded-3xl bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                    <div>
                        <p class="text-xs text-slate-400">{{ optional($announcement->published_at)->format('Y-m-d H:i') ?: '公開日時未設定' }}</p>
                        <h3 class="mt-2 text-lg font-semibold">{{ $announcement->title }}</h3>
                        <p class="mt-3 line-clamp-3 whitespace-pre-line text-sm leading-7 text-slate-600">{{ $announcement->body }}</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('owner.announcements.edit', $announcement) }}" class="rounded-xl border border-slate-300 px-4 py-2">編集</a>
                        <form method="POST" action="{{ route('owner.announcements.destroy', $announcement) }}" onsubmit="return confirm('削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-xl border border-rose-300 px-4 py-2 text-rose-700">削除</button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-3xl bg-white p-8 text-center text-slate-500 shadow-sm">お知らせはまだ登録されていません。</div>
        @endforelse
    </div>
@endsection
