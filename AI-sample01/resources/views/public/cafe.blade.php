@extends('layouts.public')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="text-sm uppercase tracking-[0.3em] text-amber-700">Cafe & Bar</p>
        <h1 class="mt-4 text-4xl font-bold text-stone-900" data-reveal="heading">{{ $siteSetting->cafe_heading }}</h1>
        <p class="mt-4 max-w-3xl text-base leading-8 text-stone-600" data-reveal data-reveal-delay="80">{{ $siteSetting->cafe_intro }}</p>
        @if($siteSetting->cafe_image_path)
            <div class="mt-10 overflow-hidden rounded-[2rem] bg-stone-200 shadow-sm" data-reveal="image">
                <img src="{{ Storage::url($siteSetting->cafe_image_path) }}" alt="{{ $siteSetting->cafe_heading }}" class="h-80 w-full object-cover">
            </div>
        @endif
        <div class="mt-10 grid gap-8 lg:grid-cols-2">
            <article class="public-panel rounded-[2rem]" data-reveal="slide-left">
                <div class="h-80 bg-amber-100">@if($siteSetting->cafe_day_image_path)<img src="{{ Storage::url($siteSetting->cafe_day_image_path) }}" alt="{{ $siteSetting->cafe_day_title }}" class="h-full w-full object-cover">@endif</div>
                <div class="p-8">
                    <p class="text-sm uppercase tracking-[0.3em] text-amber-700">{{ $siteSetting->cafe_day_label }}</p>
                    <h2 class="mt-3 text-3xl font-semibold">{{ $siteSetting->cafe_day_title }}</h2>
                    <p class="mt-4 text-sm leading-8 text-stone-600">{{ $siteSetting->cafe_day_description }}</p>
                </div>
            </article>
            <article class="public-panel rounded-[2rem]" data-reveal="slide-right" data-reveal-delay="80">
                <div class="h-80 bg-stone-200">@if($siteSetting->cafe_night_image_path)<img src="{{ Storage::url($siteSetting->cafe_night_image_path) }}" alt="{{ $siteSetting->cafe_night_title }}" class="h-full w-full object-cover">@endif</div>
                <div class="p-8">
                    <p class="text-sm uppercase tracking-[0.3em] text-amber-700">{{ $siteSetting->cafe_night_label }}</p>
                    <h2 class="mt-3 text-3xl font-semibold">{{ $siteSetting->cafe_night_title }}</h2>
                    <p class="mt-4 text-sm leading-8 text-stone-600">{{ $siteSetting->cafe_night_description }}</p>
                </div>
            </article>
        </div>
        <div class="mt-10 flex flex-wrap gap-3" data-reveal="cta">
            <a href="{{ route('contact') }}" class="rounded-full bg-stone-900 px-5 py-3 text-sm font-semibold text-white">お問い合わせ</a>
            <a href="{{ route('access') }}" class="rounded-full border border-stone-300 px-5 py-3 text-sm font-semibold text-stone-700">アクセスを見る</a>
        </div>
    </section>
@endsection
