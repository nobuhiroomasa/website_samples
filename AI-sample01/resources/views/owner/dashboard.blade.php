@extends('layouts.owner')

@section('title', 'ダッシュボード')
@section('heading', 'ダッシュボード')

@section('content')
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-3xl bg-white p-6 shadow-sm"><p class="text-sm text-slate-500">客室</p><p class="mt-3 text-4xl font-bold">{{ $roomCount }}</p></div>
        <div class="rounded-3xl bg-white p-6 shadow-sm"><p class="text-sm text-slate-500">お知らせ</p><p class="mt-3 text-4xl font-bold">{{ $announcementCount }}</p></div>
        <div class="rounded-3xl bg-white p-6 shadow-sm"><p class="text-sm text-slate-500">イベント</p><p class="mt-3 text-4xl font-bold">{{ $eventCount }}</p></div>
        <div class="rounded-3xl bg-white p-6 shadow-sm"><p class="text-sm text-slate-500">ギャラリー</p><p class="mt-3 text-4xl font-bold">{{ $galleryCount }}</p></div>
    </div>
    <section class="mt-10 rounded-3xl bg-white p-6 shadow-sm">
        <h3 class="text-lg font-semibold">最新のお問い合わせ</h3>
        <div class="mt-4 space-y-3">
            @forelse($recentInquiries as $inquiry)
                <a href="{{ route('owner.inquiries.show', $inquiry) }}" class="block rounded-2xl border border-slate-200 px-4 py-3 hover:bg-slate-50">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="font-medium">{{ $inquiry->name }}</p>
                            <p class="text-sm text-slate-500">{{ $inquiry->email }}</p>
                        </div>
                        <p class="text-sm text-slate-400">{{ $inquiry->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                </a>
            @empty
                <p class="text-sm text-slate-500">お問い合わせはまだありません。</p>
            @endforelse
        </div>
    </section>
@endsection
