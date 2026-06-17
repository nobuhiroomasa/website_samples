@extends('layouts.owner')

@section('title', 'ギャラリー追加')
@section('heading', 'ギャラリー追加')

@section('content')
    <form method="POST" action="{{ route('owner.gallery-items.store') }}" enctype="multipart/form-data">
        @csrf
        @include('owner.gallery-items._form')
    </form>
@endsection
