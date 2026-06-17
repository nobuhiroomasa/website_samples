@extends('layouts.owner')

@section('title', 'お問い合わせ詳細')
@section('heading', 'お問い合わせ詳細')

@section('content')
    <div class="rounded-3xl bg-white p-6 shadow-sm">
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <p class="text-sm text-slate-500">受信日時</p>
                <p class="mt-2 font-semibold">{{ $inquiry->created_at->format('Y-m-d H:i') }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">名前</p>
                <p class="mt-2 font-semibold">{{ $inquiry->name }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">メールアドレス</p>
                <p class="mt-2 font-semibold">{{ $inquiry->email }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">電話番号</p>
                <p class="mt-2 font-semibold">{{ $inquiry->phone ?: '未入力' }}</p>
            </div>
        </div>
        <div class="mt-6">
            <p class="text-sm text-slate-500">お問い合わせ内容</p>
            <div class="mt-2 rounded-2xl bg-slate-50 p-5 whitespace-pre-line leading-8 text-slate-700">{{ $inquiry->message }}</div>
        </div>
    </div>
    <div class="mt-6">
        <a href="{{ route('owner.inquiries.index') }}" class="rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700">一覧へ戻る</a>
    </div>
@endsection
