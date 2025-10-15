@extends('layouts.main')

@section('body-class', 'home')

@section('content')
    <div class="container">
        <h2 class="mb-4">Courses List</h2>
        <div class="row">
            @forelse($courses as $course)
                <div class="col-md-4 col-sm-12">
                    <div class="course-item mb-4">
                        <div class="mb-2">
                            <a href="{{ route('course', $course->id) }}">
                                <img src="{{ asset('storage/' . $course->thumbnail) }}"  alt="{{ $course->title }}"/>
                            </a>
                        </div>
                        <div class="">
                            <a href="{{ route('course', $course) }}">
                                <h3 class="title">{{ $course->title }}</h3>
                            </a>
                            <p class="description">{{ $course->description }}</p>
                            <a href="{{ route('course', $course) }}" class="btn btn-outline-danger">View detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No course found.</p>
            @endforelse
        </div>
    </div>
@endsection
