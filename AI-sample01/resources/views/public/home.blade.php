@extends('layouts.public')

@section('content')
    <section class="relative min-h-screen overflow-hidden bg-stone-950 text-white">
        <div class="hero-zoom absolute inset-0 bg-cover bg-center" style="background-image: linear-gradient(rgba(17, 14, 11, 0.38), rgba(17, 14, 11, 0.72)), url('{{ $siteSetting->hero_image_path ? Storage::url($siteSetting->hero_image_path) : '' }}');"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.08),transparent_38%)]"></div>
        <div class="relative mx-auto flex min-h-screen max-w-7xl items-end px-4 pb-20 pt-32 sm:px-6 lg:px-8 lg:pb-24">
            <div class="max-w-4xl" data-reveal="heading">
                <p class="text-sm uppercase tracking-[0.45em] text-stone-300">Shukufuku Guesthouse</p>
                <h1 class="mt-6 max-w-4xl text-4xl font-bold leading-tight sm:text-5xl lg:text-7xl">{{ $siteSetting->hero_catch_copy ?: $siteSetting->catch_copy }}</h1>
                <p class="mt-6 max-w-2xl text-base leading-8 text-stone-200 sm:text-lg">{{ $siteSetting->description }}</p>
                <div class="mt-10 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('stay') }}" class="rounded-full bg-white px-6 py-3 text-sm font-semibold text-stone-900 transition hover:-translate-y-0.5">{{ $siteSetting->home_primary_button_label }}</a>
                    <a href="{{ route('contact') }}" class="rounded-full border border-white/40 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">{{ $siteSetting->home_secondary_button_label }}</a>
                </div>
            </div>
            <div class="absolute bottom-8 right-4 hidden items-center gap-4 lg:flex">
                <span class="text-xs uppercase tracking-[0.35em] text-white/60">Scroll</span>
                <span class="h-14 w-px bg-white/30"></span>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-[1.2fr_0.8fr]">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-amber-700">Concept</p>
                <h2 class="mt-4 max-w-2xl text-3xl font-bold text-stone-900 sm:text-4xl" data-reveal="heading">{{ $siteSetting->home_concept_heading }}</h2>
            </div>
            <p class="text-base leading-8 text-stone-600" data-reveal data-reveal-delay="80">{{ $siteSetting->home_concept_description }}</p>
        </div>
        <div class="mt-12 grid gap-6 md:grid-cols-3">
            <article class="public-panel rounded-[1.75rem] p-6" data-reveal="card">
                <span class="public-pill">01</span>
                <h3 class="mt-5 text-2xl text-stone-900">古民家で過ごす</h3>
                <p class="mt-4 text-sm leading-7 text-stone-600">{{ $siteSetting->about_renovation }}</p>
            </article>
            <article class="public-panel rounded-[1.75rem] p-6" data-reveal="card" data-reveal-delay="80">
                <span class="public-pill">02</span>
                <h3 class="mt-5 text-2xl text-stone-900">人とつながる</h3>
                <p class="mt-4 text-sm leading-7 text-stone-600">{{ $siteSetting->about_community }}</p>
            </article>
            <article class="public-panel rounded-[1.75rem] p-6" data-reveal="card" data-reveal-delay="160">
                <span class="public-pill">03</span>
                <h3 class="mt-5 text-2xl text-stone-900">食とお酒を楽しむ</h3>
                <p class="mt-4 text-sm leading-7 text-stone-600">{{ $siteSetting->cafe_intro ?: $siteSetting->cafe_night_description }}</p>
            </article>
        </div>
    </section>

    <section class="py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-amber-700">Stay</p>
                    <h2 class="mt-3 text-3xl font-bold text-stone-900" data-reveal="heading">{{ $siteSetting->home_stay_heading }}</h2>
                </div>
                <a href="{{ route('stay') }}" class="text-sm font-semibold text-stone-700">{{ $siteSetting->home_stay_link_label }}</a>
            </div>
            <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                @foreach($rooms as $room)
                    @php
                        $amenities = collect(preg_split('/\r\n|\r|\n/', (string) $room->amenities))
                            ->filter()
                            ->take(3);
                    @endphp
                    <article class="room-card" data-reveal="card">
                        @if($room->image_path)
                            <img src="{{ Storage::url($room->image_path) }}" alt="{{ $room->name }}" class="room-card__image">
                        @else
                            <div class="room-card__image bg-stone-700"></div>
                        @endif
                        <div class="room-card__overlay"></div>
                        <div class="room-card__content">
                            <p class="text-xs uppercase tracking-[0.35em] text-white/70">Room</p>
                            <h3 class="mt-3 text-3xl">{{ $room->name }}</h3>
                            <div class="room-card__meta">
                                <span class="room-card__badge">定員 {{ $room->capacity }} 名</span>
                                @foreach ($amenities as $amenity)
                                    <span class="room-card__badge">{{ $amenity }}</span>
                                @endforeach
                            </div>
                            <p class="mt-4 line-clamp-3 text-sm leading-7 text-white/80">{{ $room->description }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-2">
                <div class="public-panel rounded-[2rem] bg-stone-900 p-8 text-white" data-reveal="slide-left">
                <p class="text-sm uppercase tracking-[0.3em] text-stone-300">{{ $siteSetting->cafe_day_label }}</p>
                <h2 class="mt-3 text-3xl font-bold">{{ $siteSetting->cafe_day_title }}</h2>
                <p class="mt-4 text-sm leading-8 text-stone-200">{{ $siteSetting->cafe_day_description }}</p>
            </div>
            <div class="public-panel rounded-[2rem] bg-amber-100 p-8 text-stone-900" data-reveal="slide-right" data-reveal-delay="80">
                <p class="text-sm uppercase tracking-[0.3em] text-amber-800">{{ $siteSetting->cafe_night_label }}</p>
                <h2 class="mt-3 text-3xl font-bold">{{ $siteSetting->cafe_night_title }}</h2>
                <p class="mt-4 text-sm leading-8 text-stone-700">{{ $siteSetting->cafe_night_description }}</p>
            </div>
        </div>
    </section>

    <section class="bg-white/60 py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-2">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-amber-700">News</p>
                    <h2 class="mt-3 text-3xl font-bold text-stone-900" data-reveal="heading">{{ $siteSetting->home_news_heading }}</h2>
                    <div class="mt-6 space-y-4">
                        @foreach($announcements as $announcement)
                            <article class="public-panel rounded-[1.5rem]" data-reveal="card">
                                @if($announcement->thumbnail_path)
                                    <img src="{{ Storage::url($announcement->thumbnail_path) }}" alt="{{ $announcement->title }}" class="h-44 w-full object-cover">
                                @endif
                                <div class="p-4">
                                <p class="text-xs text-stone-400">{{ optional($announcement->published_at)->format('Y.m.d') }}</p>
                                <h3 class="mt-2 font-semibold">{{ $announcement->title }}</h3>
                                <p class="mt-2 text-sm leading-7 text-stone-600">{{ Str::limit($announcement->body, 100) }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-amber-700">Events</p>
                    <h2 class="mt-3 text-3xl font-bold text-stone-900" data-reveal="heading">{{ $siteSetting->home_events_heading }}</h2>
                    <div class="mt-6 space-y-4">
                        @foreach($events as $event)
                            <article class="public-panel rounded-[1.5rem]" data-reveal="card" data-reveal-delay="80">
                                @if($event->image_path)
                                    <img src="{{ Storage::url($event->image_path) }}" alt="{{ $event->title }}" class="h-44 w-full object-cover">
                                @endif
                                <div class="p-4">
                                <p class="text-xs text-stone-400">{{ optional($event->event_date)->format('Y.m.d') }}</p>
                                <h3 class="mt-2 font-semibold">{{ $event->title }}</h3>
                                <p class="mt-2 text-sm leading-7 text-stone-600">{{ Str::limit($event->description, 100) }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-amber-700">Gallery</p>
                <h2 class="mt-3 text-3xl font-bold text-stone-900" data-reveal="heading">{{ $siteSetting->home_gallery_heading }}</h2>
            </div>
            <a href="{{ route('gallery') }}" class="text-sm font-semibold text-stone-700">{{ $siteSetting->home_gallery_link_label }}</a>
        </div>
        <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($galleryItems as $galleryItem)
                <figure class="gallery-card" data-reveal="card">
                    @if($galleryItem->image_path)
                        <img src="{{ Storage::url($galleryItem->image_path) }}" alt="{{ $galleryItem->description }}" class="gallery-card__image h-72">
                    @endif
                </figure>
            @endforeach
        </div>
    </section>
@endsection
