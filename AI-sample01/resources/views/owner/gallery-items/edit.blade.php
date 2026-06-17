@extends('layouts.owner')

@section('title', 'ギャラリー編集')
@section('heading', 'ギャラリー編集')

@section('content')
    <form method="POST" action="{{ route('owner.gallery-items.update', $galleryItem) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('owner.gallery-items._form')
    </form>
@endsection
