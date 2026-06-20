@extends('layouts.public')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="text-sm uppercase tracking-[0.3em] text-amber-700">About</p>
        <h1 class="mt-4 text-4xl font-bold text-stone-900" data-reveal="heading">{{ $siteSetting->about_heading }}</h1>
        <p class="mt-4 max-w-3xl text-base leading-8 text-stone-600" data-reveal data-reveal-delay="80">{{ $siteSetting->about_intro }}</p>
        @if($siteSetting->about_image_path)
            <div class="mt-10 overflow-hidden rounded-[2rem] bg-stone-200 shadow-sm" data-reveal="image">
                <img src="{{ Storage::url($siteSetting->about_image_path) }}" alt="{{ $siteSetting->about_heading }}" class="h-80 w-full object-cover">
            </div>
        @endif
        <div class="mt-12 grid gap-8 lg:grid-cols-3">
            <article class="public-panel rounded-[1.75rem] p-8" data-reveal="card">
                <h2 class="text-xl font-semibold">{{ $siteSetting->about_story_title }}</h2>
                <p class="mt-4 text-sm leading-8 text-stone-600">{{ $siteSetting->about_story }}</p>
            </article>
            <article class="public-panel rounded-[1.75rem] p-8" data-reveal="card" data-reveal-delay="80">
                <h2 class="text-xl font-semibold">{{ $siteSetting->about_renovation_title }}</h2>
                <p class="mt-4 text-sm leading-8 text-stone-600">{{ $siteSetting->about_renovation }}</p>
            </article>
            <article class="public-panel rounded-[1.75rem] p-8" data-reveal="card" data-reveal-delay="160">
                <h2 class="text-xl font-semibold">{{ $siteSetting->about_community_title }}</h2>
                <p class="mt-4 text-sm leading-8 text-stone-600">{{ $siteSetting->about_community }}</p>
            </article>
        </div>
        <div class="mt-10 flex flex-wrap gap-3" data-reveal="cta">
            <a href="{{ route('stay') }}" class="rounded-full bg-stone-900 px-5 py-3 text-sm font-semibold text-white">宿泊を見る</a>
            <a href="{{ route('contact') }}" class="rounded-full border border-stone-300 px-5 py-3 text-sm font-semibold text-stone-700">お問い合わせ</a>
        </div>
    </section>
@endsection
