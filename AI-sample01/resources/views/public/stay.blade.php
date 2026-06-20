@extends('layouts.public')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="text-sm uppercase tracking-[0.3em] text-amber-700">Stay</p>
        <h1 class="mt-4 text-4xl font-bold text-stone-900" data-reveal="heading">{{ $siteSetting->stay_heading }}</h1>
        <p class="mt-4 max-w-3xl text-base leading-8 text-stone-600">{{ $siteSetting->stay_intro }}</p>
        @if($siteSetting->stay_image_path)
            <div class="mt-10 overflow-hidden rounded-[2rem] bg-stone-200 shadow-sm" data-reveal="image">
                <img src="{{ Storage::url($siteSetting->stay_image_path) }}" alt="{{ $siteSetting->stay_heading }}" class="h-80 w-full object-cover">
            </div>
        @endif
        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('contact') }}" class="rounded-full bg-stone-900 px-5 py-3 text-sm font-semibold text-white">お問い合わせ</a>
            <a href="{{ route('access') }}" class="rounded-full border border-stone-300 px-5 py-3 text-sm font-semibold text-stone-700">アクセスを見る</a>
        </div>
        <div class="mt-12 grid gap-8 lg:grid-cols-2">
            @foreach($rooms as $room)
                @php
                    $amenities = collect(preg_split('/\r\n|\r|\n/', (string) $room->amenities))->filter();
                @endphp
                <article class="public-panel rounded-[2rem]" data-reveal="card">
                    <div class="relative">
                        <div class="h-[22rem] bg-stone-200">
                            @if($room->image_path)
                                <img src="{{ Storage::url($room->image_path) }}" alt="{{ $room->name }}" class="h-full w-full object-cover">
                            @endif
                        </div>
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                            <div class="flex items-center justify-between gap-4">
                                <h2 class="text-3xl font-semibold text-white">{{ $room->name }}</h2>
                                <span class="rounded-full bg-white/15 px-3 py-1 text-sm text-white">定員 {{ $room->capacity }} 名</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        <p class="mt-4 text-sm leading-8 text-stone-600">{{ $room->description }}</p>
                        <div class="mt-6">
                            <h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-stone-500">設備</h3>
                            <div class="mt-4 flex flex-wrap gap-2">
                                @foreach($amenities as $amenity)
                                    <span class="public-pill">{{ $amenity }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
