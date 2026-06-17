@extends('layouts.owner')

@section('title', 'イベント管理')
@section('heading', 'イベント管理')

@section('content')
    <div class="flex justify-end">
        <a href="{{ route('owner.events.create') }}" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">イベントを追加</a>
    </div>

    <div class="mt-6 space-y-4">
        @forelse ($events as $event)
            <article class="rounded-3xl bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                    <div>
                        <p class="text-xs text-slate-400">{{ optional($event->event_date)->format('Y-m-d') ?: '開催日未設定' }}</p>
                        <h3 class="mt-2 text-lg font-semibold">{{ $event->title }}</h3>
                        <p class="mt-3 line-clamp-3 whitespace-pre-line text-sm leading-7 text-slate-600">{{ $event->description }}</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('owner.events.edit', $event) }}" class="rounded-xl border border-slate-300 px-4 py-2">編集</a>
                        <form method="POST" action="{{ route('owner.events.destroy', $event) }}" onsubmit="return confirm('削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-xl border border-rose-300 px-4 py-2 text-rose-700">削除</button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-3xl bg-white p-8 text-center text-slate-500 shadow-sm">イベントはまだ登録されていません。</div>
        @endforelse
    </div>
@endsection
