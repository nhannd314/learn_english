@extends('layouts.main')

@section('body-class', 'home')

@section('content')
    <div class="container">
        <!-- recent lessons -->
        <div class="mb-5">
            <h2 class="mb-4">Recent Lessons</h2>
            <div class="row">
                @forelse($recent_lessons as $lesson)
                    <div class="col-md-4 col-sm-12">
                        <div class="lesson text-center bg-success p-4 rounded-2 mb-4">
                            <a class="text-white fs-5" href="{{ route('lesson', $lesson) }}">
                                {{ $lesson->title }}
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No lessons found.</p>
                @endforelse
            </div>
        </div>

        <!-- courses list -->
        <div class="mb-5">
            <h2 class="mb-4">Courses List</h2>
            <div class="row">
                @forelse($courses as $course)
                    <div class="col-md-3 col-sm-12">
                        <div class="course-item mb-4">
                            <div class="mb-2">
                                <a href="{{ route('course', $course) }}">
                                    <img src="{{ asset('storage/' . $course->thumbnail) }}"  alt="{{ $course->title }}"/>
                                </a>
                            </div>
                            <div class="">
                                <a href="{{ route('course', $course) }}">
                                    <h3 class="title fs-4">{{ $course->title }}</h3>
                                </a>
                                <p class="description">{{ $course->description }}</p>
                                <a href="{{ route('course', $course) }}" class="btn btn-danger">View detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No course found.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
