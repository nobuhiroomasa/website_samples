<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>管理者ログイン | 宿福 SHUKUFUKU</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-950 text-stone-100">
    <div class="mx-auto flex min-h-screen max-w-6xl flex-col justify-center gap-10 px-4 py-12 lg:flex-row lg:items-center lg:gap-16">
        <section class="max-w-xl">
            <p class="text-sm uppercase tracking-[0.3em] text-stone-400">Owner Login</p>
            <h1 class="mt-4 text-4xl font-bold leading-tight">宿福 SHUKUFUKU<br>管理画面</h1>
            <p class="mt-6 text-base leading-8 text-stone-300">写真、客室、お知らせ、イベント、ギャラリー、サイト設定を更新できます。</p>
        </section>
        <section class="w-full max-w-md rounded-3xl bg-white p-8 text-stone-900 shadow-2xl">
            <h2 class="text-2xl font-semibold">管理者ログイン</h2>
            <form method="POST" action="{{ route('owner.login.store') }}" class="mt-8 space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold">メールアドレス</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="mt-2 w-full rounded-2xl border border-stone-300 px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold">パスワード</label>
                    <input type="password" name="password" class="mt-2 w-full rounded-2xl border border-stone-300 px-4 py-3">
                </div>
                <label class="flex items-center gap-2 text-sm text-stone-600">
                    <input type="checkbox" name="remember" value="1" class="rounded border-stone-300">
                    ログイン状態を保持する
                </label>
                <button type="submit" class="w-full rounded-2xl bg-stone-900 px-4 py-3 text-sm font-semibold text-white hover:bg-stone-700">ログインする</button>
            </form>
        </section>
    </div>
</body>
</html>
