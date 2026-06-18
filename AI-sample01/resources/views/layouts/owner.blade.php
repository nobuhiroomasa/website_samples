<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '宿福 CMS')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
    $ownerNavItems = [
        ['label' => 'ダッシュボード', 'route' => route('owner.dashboard')],
        ['label' => 'サイト設定', 'route' => route('owner.settings.edit')],
        ['label' => '客室管理', 'route' => route('owner.rooms.index')],
        ['label' => 'お知らせ管理', 'route' => route('owner.announcements.index')],
        ['label' => 'イベント管理', 'route' => route('owner.events.index')],
        ['label' => 'ギャラリー管理', 'route' => route('owner.gallery-items.index')],
        ['label' => 'お問い合わせ', 'route' => route('owner.inquiries.index')],
    ];
@endphp
<body class="min-h-screen bg-slate-100 text-slate-900">
    <div class="flex min-h-screen">
        <aside class="hidden w-72 shrink-0 border-r border-slate-200 bg-slate-950 text-slate-100 lg:block">
            <div class="sticky top-0 flex h-screen flex-col">
                <div class="border-b border-slate-800 px-6 py-5">
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Owner CMS</p>
                    <h1 class="mt-2 text-lg font-semibold">宿福 SHUKUFUKU</h1>
                </div>
                <nav class="flex-1 space-y-1 overflow-y-auto px-4 py-6 text-sm">
                    @foreach ($ownerNavItems as $item)
                        <a href="{{ $item['route'] }}" class="block rounded-xl px-4 py-3 hover:bg-slate-900">{{ $item['label'] }}</a>
                    @endforeach
                </nav>
                <div class="border-t border-slate-800 px-4 py-4 text-sm">
                    <a href="{{ route('home') }}" class="mb-3 block rounded-xl px-4 py-3 hover:bg-slate-900">公開サイトを見る</a>
                    <form method="POST" action="{{ route('owner.logout') }}">
                        @csrf
                        <button type="submit" class="w-full rounded-xl border border-slate-700 px-4 py-3 text-left hover:bg-slate-900">ログアウト</button>
                    </form>
                </div>
            </div>
        </aside>
        <div class="min-w-0 flex-1">
            <header class="border-b border-slate-200 bg-white">
                <div class="mx-auto flex max-w-6xl flex-col gap-3 px-4 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
                    <div class="min-w-0">
                        <p class="text-xs uppercase tracking-[0.25em] text-slate-400">宿福 CMS</p>
                        <h2 class="mt-1 text-xl font-semibold">@yield('heading', '管理画面')</h2>
                    </div>
                    <p class="max-w-full truncate text-sm text-slate-500">ログイン中: {{ auth()->user()->name }}</p>
                </div>
            </header>
            <div class="border-b border-slate-200 bg-white lg:hidden">
                <div class="mx-auto max-w-6xl px-4 py-3 sm:px-6">
                    <nav class="flex min-w-0 gap-2 overflow-x-auto pb-1 text-sm [-webkit-overflow-scrolling:touch]">
                        @foreach ($ownerNavItems as $item)
                            <a href="{{ $item['route'] }}" class="inline-flex h-10 shrink-0 items-center whitespace-nowrap rounded-full border border-slate-200 bg-slate-50 px-4 text-slate-700 hover:bg-slate-100">{{ $item['label'] }}</a>
                        @endforeach
                        <a href="{{ route('home') }}" class="inline-flex h-10 shrink-0 items-center whitespace-nowrap rounded-full border border-slate-200 bg-slate-50 px-4 text-slate-700 hover:bg-slate-100">公開サイトを見る</a>
                    </nav>
                    <form method="POST" action="{{ route('owner.logout') }}" class="mt-3">
                        @csrf
                        <button type="submit" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-100">ログアウト</button>
                    </form>
                </div>
            </div>
            <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
                @if (session('status'))
                    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('status') }}</div>
                @endif
                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                        <ul class="list-disc space-y-1 ps-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
