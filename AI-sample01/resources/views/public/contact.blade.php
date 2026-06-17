@extends('layouts.public')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <p class="text-sm uppercase tracking-[0.3em] text-amber-700">Contact</p>
        <h1 class="mt-4 text-4xl font-bold text-stone-900" data-reveal>{{ $siteSetting->contact_heading }}</h1>
        <p class="mt-4 text-base leading-8 text-stone-600" data-reveal data-reveal-delay="80">{{ $siteSetting->contact_description }}</p>
        @if($siteSetting->contact_image_path)
            <div class="mt-10 overflow-hidden rounded-[2rem] bg-stone-200 shadow-sm" data-reveal>
                <img src="{{ Storage::url($siteSetting->contact_image_path) }}" alt="{{ $siteSetting->contact_heading }}" class="h-80 w-full object-cover">
            </div>
        @endif
        <div class="mt-10 public-panel rounded-[2rem] p-8" data-reveal>
            <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                @csrf
                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold">お名前</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="mt-2 w-full rounded-2xl border border-stone-300 px-4 py-3">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">メールアドレス</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="mt-2 w-full rounded-2xl border border-stone-300 px-4 py-3">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold">電話番号</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="mt-2 w-full rounded-2xl border border-stone-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">お問い合わせ内容</label>
                    <textarea name="message" rows="6" class="mt-2 w-full rounded-2xl border border-stone-300 px-4 py-3">{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="rounded-full bg-stone-900 px-6 py-3 text-sm font-semibold text-white">送信する</button>
            </form>
        </div>
    </section>
@endsection
