@extends('layouts.owner')

@section('title', 'お問い合わせ一覧')
@section('heading', 'お問い合わせ一覧')

@section('content')
    <div class="overflow-hidden rounded-3xl bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold">受信日時</th>
                    <th class="px-6 py-4 text-left font-semibold">名前</th>
                    <th class="px-6 py-4 text-left font-semibold">メールアドレス</th>
                    <th class="px-6 py-4 text-left font-semibold">電話番号</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($inquiries as $inquiry)
                    <tr>
                        <td class="px-6 py-4">{{ $inquiry->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-6 py-4">{{ $inquiry->name }}</td>
                        <td class="px-6 py-4">{{ $inquiry->email }}</td>
                        <td class="px-6 py-4">{{ $inquiry->phone ?: '未入力' }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('owner.inquiries.show', $inquiry) }}" class="rounded-xl border border-slate-300 px-4 py-2">詳細</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500">お問い合わせはまだありません。</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
