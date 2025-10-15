@extends('layouts.main')

@section('body-class', 'page')

@section('content')
    <div class="container">
        <h1 class="mb-4">{{ $page->title }}</h1>

        <div class="content mb-4">
            {!! $page->content !!}
        </div>
    </div>
@endsection
