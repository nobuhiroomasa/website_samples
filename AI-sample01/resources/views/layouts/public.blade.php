<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $seo['description'] ?? $siteSetting->description }}">
    <meta property="og:title" content="{{ $seo['title'] ?? $siteSetting->site_title }}">
    <meta property="og:description" content="{{ $seo['description'] ?? $siteSetting->description }}">
    @if(!empty($seo['ogImageUrl']))
        <meta property="og:image" content="{{ $seo['ogImageUrl'] }}">
    @endif
    <title>{{ $seo['title'] ?? $siteSetting->site_title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
    $isHome = request()->routeIs('home');
    $navItems = [
        ['label' => '宿福について', 'route' => 'about'],
        ['label' => '宿泊', 'route' => 'stay'],
        ['label' => 'カフェ＆バー', 'route' => 'cafe'],
        ['label' => 'イベント・お知らせ', 'route' => 'news'],
        ['label' => 'ギャラリー', 'route' => 'gallery'],
        ['label' => 'アクセス', 'route' => 'access'],
    ];
@endphp
<body data-page="{{ request()->route()?->getName() }}" class="public-site bg-stone-50 text-stone-800 antialiased">
    @if($isHome)
        <div id="site-loader" class="site-loader">
            <div class="site-loader__mark">
                <p class="site-loader__eyebrow">Guesthouse & Cafe</p>
                <p class="site-loader__title">SHUKUFUKU</p>
            </div>
        </div>
    @endif

    <div class="mobile-nav-backdrop" data-mobile-nav-backdrop hidden></div>

    <header data-site-header class="site-header {{ $isHome ? 'site-header--home' : '' }}">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="site-header__brand">
                <span class="block text-xs uppercase tracking-[0.45em] text-current/60">Shukufuku</span>
                <span class="mt-1 block text-lg font-semibold tracking-[0.2em]">{{ $siteSetting->site_title }}</span>
            </a>

            <nav class="hidden items-center gap-2 lg:flex">
                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}" class="site-header__link {{ request()->routeIs($item['route']) ? 'is-active' : '' }}">{{ $item['label'] }}</a>
                @endforeach
                <a href="{{ route('contact') }}" class="site-header__cta">お問い合わせ</a>
            </nav>

            <button
                type="button"
                class="site-header__menu-button lg:hidden"
                data-mobile-nav-toggle
                aria-controls="mobile-navigation"
                aria-expanded="false"
                aria-label="メニューを開く"
                onclick="document.querySelector('[data-mobile-nav-panel]').hidden = false; document.body.classList.add('overflow-hidden'); this.setAttribute('aria-expanded', 'true');"
            >
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <div id="mobile-navigation" class="mobile-nav-panel" data-mobile-nav-panel hidden>
            <div class="flex items-center justify-between border-b border-white/10 px-5 py-5">
                <div>
                    <p class="text-xs uppercase tracking-[0.35em] text-white/60">Navigation</p>
                    <p class="mt-2 text-lg font-semibold text-white">{{ $siteSetting->site_title }}</p>
                </div>
                <button type="button" class="rounded-full border border-white/15 px-3 py-2 text-sm text-white" data-mobile-nav-close onclick="document.querySelector('[data-mobile-nav-panel]').hidden = true; document.querySelector('[data-mobile-nav-backdrop]').hidden = true; document.body.classList.remove('overflow-hidden'); document.querySelector('[data-mobile-nav-toggle]').setAttribute('aria-expanded', 'false');">閉じる</button>
            </div>
            <nav class="flex flex-col gap-2 px-5 py-6">
                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}" class="mobile-nav-panel__link">{{ $item['label'] }}</a>
                @endforeach
                <a href="{{ route('contact') }}" class="mobile-nav-panel__cta">お問い合わせ</a>
            </nav>
        </div>
    </header>

    @if (session('status'))
        <div class="mx-auto mt-24 max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('status') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="mx-auto mt-24 max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                <ul class="list-disc space-y-1 ps-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <main class="{{ $isHome ? '' : 'pt-24' }}">
        @yield('content')
    </main>

    <footer class="mt-20 border-t border-stone-200 bg-[#f2f2f2]">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-12 sm:grid-cols-2 sm:px-6 lg:grid-cols-4 lg:px-8">
            <div>
                <h2 class="font-serif text-xl font-semibold text-stone-900">宿福 SHUKUFUKU</h2>
                <p class="mt-4 text-sm leading-7 text-stone-600">{{ $siteSetting->catch_copy }}</p>
            </div>
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-stone-500">連絡先</h3>
                <p class="mt-4 text-sm text-stone-700">{{ $siteSetting->phone }}</p>
                <p class="mt-2 text-sm leading-7 text-stone-700">{{ $siteSetting->address }}</p>
            </div>
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-stone-500">Site Map</h3>
                <div class="mt-4 grid gap-2 text-sm text-stone-700">
                    @foreach ($navItems as $item)
                        <a href="{{ route($item['route']) }}" class="transition hover:text-stone-950">{{ $item['label'] }}</a>
                    @endforeach
                </div>
            </div>
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-stone-500">SNS / Owner</h3>
                <div class="mt-4 space-y-2 text-sm text-stone-700">
                    @if($siteSetting->instagram_url)<a class="block transition hover:text-stone-950" href="{{ $siteSetting->instagram_url }}" target="_blank" rel="noreferrer">Instagram</a>@endif
                    @if($siteSetting->facebook_url)<a class="block transition hover:text-stone-950" href="{{ $siteSetting->facebook_url }}" target="_blank" rel="noreferrer">Facebook</a>@endif
                    @if($siteSetting->x_url)<a class="block transition hover:text-stone-950" href="{{ $siteSetting->x_url }}" target="_blank" rel="noreferrer">X</a>@endif
                    <a href="{{ route('owner.login') }}" class="mt-4 inline-flex rounded-full border border-stone-300 px-4 py-2 text-sm font-medium text-stone-700 transition hover:border-stone-900 hover:text-stone-900">管理画面ログイン</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
