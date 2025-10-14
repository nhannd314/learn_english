@extends('layouts.main')

@section('body-class', 'unit')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('course', $unit->course->id) }}">{{ $unit->course->title }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $unit->title }}</li>
            </ol>
        </nav>
        <h1 class="mb-4">{{ $unit->title }}</h1>
        <div class="description">
            {{ $unit->description }}
        </div>
        <div class="lesson-list row">
            @forelse($unit->lessons as $lesson)
                <div class="col-md-3 col-sm-12">
                    <div class="lesson text-center bg-secondary p-4 rounded-2">
                        <a class="text-white fs-5" href="{{ route('lesson', $lesson->id) }}">
                            {{ $lesson->title }}
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-muted">No lesson found.</p>
            @endforelse
        </div>
    </div>
@endsection
