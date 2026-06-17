@extends('layouts.owner')

@section('title', '客室追加')
@section('heading', '客室追加')

@section('content')
    <form method="POST" action="{{ route('owner.rooms.store') }}" enctype="multipart/form-data">
        @csrf
        @include('owner.rooms._form')
    </form>
@endsection
