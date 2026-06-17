@extends('layouts.owner')

@section('title', 'イベント追加')
@section('heading', 'イベント追加')

@section('content')
    <form method="POST" action="{{ route('owner.events.store') }}" enctype="multipart/form-data">
        @csrf
        @include('owner.events._form')
    </form>
@endsection
