@extends('layouts.owner')

@section('title', 'お知らせ編集')
@section('heading', 'お知らせ編集')

@section('content')
    <form method="POST" action="{{ route('owner.announcements.update', $announcement) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('owner.announcements._form')
    </form>
@endsection
