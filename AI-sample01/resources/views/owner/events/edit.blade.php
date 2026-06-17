@extends('layouts.owner')

@section('title', 'イベント編集')
@section('heading', 'イベント編集')

@section('content')
    <form method="POST" action="{{ route('owner.events.update', $event) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('owner.events._form')
    </form>
@endsection
