@extends('layouts.public')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="text-sm uppercase tracking-[0.3em] text-amber-700">News & Events</p>
        <h1 class="mt-4 text-4xl font-bold text-stone-900" data-reveal="heading">{{ $siteSetting->news_heading }}</h1>
        <p class="mt-4 max-w-3xl text-base leading-8 text-stone-600" data-reveal data-reveal-delay="80">{{ $siteSetting->news_intro }}</p>
        @if($siteSetting->news_image_path)
            <div class="mt-10 overflow-hidden rounded-[2rem] bg-stone-200 shadow-sm" data-reveal="image">
                <img src="{{ Storage::url($siteSetting->news_image_path) }}" alt="{{ $siteSetting->news_heading }}" class="h-80 w-full object-cover">
            </div>
        @endif
        <div class="mt-12 grid gap-10 lg:grid-cols-2">
            <div>
                <h2 class="text-2xl font-semibold">{{ $siteSetting->news_announcements_title }}</h2>
                <div class="mt-6 space-y-4">
                    @foreach($announcements as $announcement)
                        <article class="public-panel rounded-[2rem]" data-reveal="card">
                            @if($announcement->thumbnail_path)
                                <img src="{{ Storage::url($announcement->thumbnail_path) }}" alt="{{ $announcement->title }}" class="h-56 w-full object-cover">
                            @endif
                            <div class="p-6">
                            <p class="text-xs text-stone-400">{{ optional($announcement->published_at)->format('Y.m.d H:i') }}</p>
                            <h3 class="mt-2 text-xl font-semibold">{{ $announcement->title }}</h3>
                            <p class="mt-3 whitespace-pre-line text-sm leading-8 text-stone-600">{{ $announcement->body }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div>
                <h2 class="text-2xl font-semibold">{{ $siteSetting->news_events_title }}</h2>
                <div class="mt-6 space-y-4">
                    @foreach($events as $event)
                        <article class="public-panel rounded-[2rem]" data-reveal="card" data-reveal-delay="80">
                            @if($event->image_path)
                                <img src="{{ Storage::url($event->image_path) }}" alt="{{ $event->title }}" class="h-56 w-full object-cover">
                            @endif
                            <div class="p-6">
                            <p class="text-xs text-stone-400">{{ optional($event->event_date)->format('Y.m.d') }}</p>
                            <h3 class="mt-2 text-xl font-semibold">{{ $event->title }}</h3>
                            <p class="mt-3 whitespace-pre-line text-sm leading-8 text-stone-600">{{ $event->description }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mt-10 flex flex-wrap gap-3" data-reveal="cta">
            <a href="{{ route('contact') }}" class="rounded-full bg-stone-900 px-5 py-3 text-sm font-semibold text-white">お問い合わせ</a>
            <a href="{{ route('gallery') }}" class="rounded-full border border-stone-300 px-5 py-3 text-sm font-semibold text-stone-700">ギャラリーを見る</a>
        </div>
    </section>
@endsection
