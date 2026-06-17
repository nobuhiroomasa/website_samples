@extends('layouts.owner')

@section('title', '客室管理')
@section('heading', '客室管理')

@section('content')
    <div class="flex justify-end">
        <a href="{{ route('owner.rooms.create') }}" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">客室を追加</a>
    </div>

    <div class="mt-6 overflow-hidden rounded-3xl bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold">部屋名</th>
                    <th class="px-6 py-4 text-left font-semibold">定員</th>
                    <th class="px-6 py-4 text-left font-semibold">公開</th>
                    <th class="px-6 py-4 text-left font-semibold">表示順</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($rooms as $room)
                    <tr>
                        <td class="px-6 py-4">{{ $room->name }}</td>
                        <td class="px-6 py-4">{{ $room->capacity }}名</td>
                        <td class="px-6 py-4">{{ $room->is_published ? '公開中' : '非公開' }}</td>
                        <td class="px-6 py-4">{{ $room->sort_order }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('owner.rooms.edit', $room) }}" class="rounded-xl border border-slate-300 px-4 py-2">編集</a>
                                <form method="POST" action="{{ route('owner.rooms.destroy', $room) }}" onsubmit="return confirm('削除しますか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-xl border border-rose-300 px-4 py-2 text-rose-700">削除</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500">客室はまだ登録されていません。</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
