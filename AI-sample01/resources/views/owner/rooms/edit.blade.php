@extends('layouts.owner')

@section('title', '客室編集')
@section('heading', '客室編集')

@section('content')
    <form method="POST" action="{{ route('owner.rooms.update', $room) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('owner.rooms._form')
    </form>
@endsection
