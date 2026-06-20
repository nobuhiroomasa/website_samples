@extends('layouts.public')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="text-sm uppercase tracking-[0.3em] text-amber-700">Access</p>
        <h1 class="mt-4 text-4xl font-bold text-stone-900" data-reveal="heading">{{ $siteSetting->access_heading }}</h1>
        <p class="mt-4 max-w-3xl text-base leading-8 text-stone-600" data-reveal data-reveal-delay="80">{{ $siteSetting->access_intro }}</p>
        @if($siteSetting->access_image_path)
            <div class="mt-10 overflow-hidden rounded-[2rem] bg-stone-200 shadow-sm" data-reveal="image">
                <img src="{{ Storage::url($siteSetting->access_image_path) }}" alt="{{ $siteSetting->access_heading }}" class="h-80 w-full object-cover">
            </div>
        @endif
        <div class="mt-12 grid gap-8 lg:grid-cols-[1.4fr_1fr]">
            <div class="public-panel rounded-[2rem]" data-reveal="slide-left">
                @if($siteSetting->access_map_embed)
                    <div class="aspect-[16/10] [&_iframe]:h-full [&_iframe]:w-full">{!! $siteSetting->access_map_embed !!}</div>
                @else
                    <div class="flex aspect-[16/10] items-center justify-center bg-stone-200 text-stone-500">Google Map を設定してください</div>
                @endif
            </div>
            <div class="space-y-6">
                <article class="public-panel rounded-[1.75rem] p-6" data-reveal="card" data-reveal-delay="80">
                    <h2 class="text-xl font-semibold">{{ $siteSetting->access_address_title }}</h2>
                    <p class="mt-3 text-sm leading-8 text-stone-600">{{ $siteSetting->address }}</p>
                </article>
                <article class="public-panel rounded-[1.75rem] p-6" data-reveal="card" data-reveal-delay="120">
                    <h2 class="text-xl font-semibold">{{ $siteSetting->access_station_title }}</h2>
                    <p class="mt-3 whitespace-pre-line text-sm leading-8 text-stone-600">{{ $siteSetting->access_station_info }}</p>
                </article>
                <article class="public-panel rounded-[1.75rem] p-6" data-reveal="card" data-reveal-delay="160">
                    <h2 class="text-xl font-semibold">{{ $siteSetting->access_tourist_title }}</h2>
                    <p class="mt-3 whitespace-pre-line text-sm leading-8 text-stone-600">{{ $siteSetting->access_tourist_info }}</p>
                </article>
            </div>
        </div>
        <div class="mt-10 flex flex-wrap gap-3" data-reveal="cta">
            <a href="{{ route('contact') }}" class="rounded-full bg-stone-900 px-5 py-3 text-sm font-semibold text-white">お問い合わせ</a>
        </div>
    </section>
@endsection
