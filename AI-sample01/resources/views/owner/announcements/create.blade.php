@extends('layouts.owner')

@section('title', 'お知らせ追加')
@section('heading', 'お知らせ追加')

@section('content')
    <form method="POST" action="{{ route('owner.announcements.store') }}" enctype="multipart/form-data">
        @csrf
        @include('owner.announcements._form')
    </form>
@endsection
