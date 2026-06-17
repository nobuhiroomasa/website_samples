<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '宿福 CMS')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <div class="flex min-h-screen">
        <aside class="hidden w-72 flex-col border-r border-slate-200 bg-slate-950 text-slate-100 lg:flex">
            <div class="border-b border-slate-800 px-6 py-5">
                <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Owner CMS</p>
                <h1 class="mt-2 text-lg font-semibold">宿福 SHUKUFUKU</h1>
            </div>
            <nav class="flex-1 space-y-1 px-4 py-6 text-sm">
                <a href="{{ route('owner.dashboard') }}" class="block rounded-xl px-4 py-3 hover:bg-slate-900">ダッシュボード</a>
                <a href="{{ route('owner.settings.edit') }}" class="block rounded-xl px-4 py-3 hover:bg-slate-900">サイト設定</a>
                <a href="{{ route('owner.rooms.index') }}" class="block rounded-xl px-4 py-3 hover:bg-slate-900">客室管理</a>
                <a href="{{ route('owner.announcements.index') }}" class="block rounded-xl px-4 py-3 hover:bg-slate-900">お知らせ管理</a>
                <a href="{{ route('owner.events.index') }}" class="block rounded-xl px-4 py-3 hover:bg-slate-900">イベント管理</a>
                <a href="{{ route('owner.gallery-items.index') }}" class="block rounded-xl px-4 py-3 hover:bg-slate-900">ギャラリー管理</a>
                <a href="{{ route('owner.inquiries.index') }}" class="block rounded-xl px-4 py-3 hover:bg-slate-900">お問い合わせ</a>
            </nav>
            <div class="border-t border-slate-800 px-4 py-4 text-sm">
                <a href="{{ route('home') }}" class="mb-3 block rounded-xl px-4 py-3 hover:bg-slate-900">公開サイトを見る</a>
                <form method="POST" action="{{ route('owner.logout') }}">
                    @csrf
                    <button type="submit" class="w-full rounded-xl border border-slate-700 px-4 py-3 text-left hover:bg-slate-900">ログアウト</button>
                </form>
            </div>
        </aside>
        <div class="flex-1">
            <header class="border-b border-slate-200 bg-white">
                <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                    <div>
                        <p class="text-xs uppercase tracking-[0.25em] text-slate-400">宿福 CMS</p>
                        <h2 class="mt-1 text-xl font-semibold">@yield('heading', '管理画面')</h2>
                    </div>
                    <p class="text-sm text-slate-500">ログイン中: {{ auth()->user()->name }}</p>
                </div>
            </header>
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
