@extends('layouts.public')

@section('content')
    @php
        $categories = $galleryItems->keys()->values();
    @endphp

    <section class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="text-sm uppercase tracking-[0.3em] text-amber-700">Gallery</p>
        <h1 class="mt-4 text-4xl font-bold text-stone-900">{{ $siteSetting->gallery_heading }}</h1>
        <p class="mt-4 max-w-3xl text-base leading-8 text-stone-600">{{ $siteSetting->gallery_intro }}</p>
        @if($siteSetting->gallery_image_path)
            <div class="mt-10 overflow-hidden rounded-[2rem] bg-stone-200 shadow-sm" data-reveal>
                <img src="{{ Storage::url($siteSetting->gallery_image_path) }}" alt="{{ $siteSetting->gallery_heading }}" class="h-80 w-full object-cover">
            </div>
        @endif
        <div class="mt-10 flex flex-wrap gap-3">
            <button type="button" class="gallery-filter is-active" data-gallery-filter="all">すべて</button>
            @foreach($categories as $category)
                <button type="button" class="gallery-filter" data-gallery-filter="{{ $category }}">{{ $category }}</button>
            @endforeach
        </div>
        <div class="mt-12 grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
            @foreach($galleryItems as $category => $items)
                @foreach($items as $item)
                    <figure class="gallery-card" data-gallery-item="{{ $category }}" data-reveal>
                        <button
                            type="button"
                            class="block w-full text-left"
                            data-gallery-open
                            data-gallery-image="{{ Storage::url($item->image_path) }}"
                            data-gallery-category="{{ $category }}"
                            data-gallery-description="{{ $item->description }}"
                        >
                            <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->description }}" class="gallery-card__image">
                            <figcaption class="p-5">
                                <p class="text-xs uppercase tracking-[0.25em] text-stone-400">{{ $category }}</p>
                                <p class="mt-3 text-sm leading-7 text-stone-600">{{ $item->description }}</p>
                            </figcaption>
                        </button>
                    </figure>
                @endforeach
            @endforeach
        </div>
    </section>

    <div class="gallery-modal" data-gallery-modal hidden>
        <div class="gallery-modal__inner">
            <div class="flex items-center justify-between border-b border-white/10 px-5 py-4">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-white/50" data-gallery-modal-category></p>
                    <p class="mt-2 font-serif text-2xl text-white">SHUKUFUKU Gallery</p>
                </div>
                <button type="button" class="rounded-full border border-white/15 px-4 py-2 text-sm text-white" data-gallery-modal-close>閉じる</button>
            </div>
            <img src="" alt="" class="gallery-modal__image" data-gallery-modal-image>
            <div class="gallery-modal__meta">
                <p class="text-sm leading-8 text-white/80" data-gallery-modal-description></p>
            </div>
        </div>
    </div>
@endsection
