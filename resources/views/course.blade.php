@extends('layouts.main')

@section('body-class', 'course')

@section('content')
    <div class="container">
        <h1 class="mb-4">{{ $course->title }}</h1>
        <div class="description mb-4">
            {{ $course->description }}
        </div>
        <div class="unit-list row">
            @forelse($course->units as $unit)
                <div class="col-md-3 col-sm-12">
                    <div class="unit text-center bg-success p-4 rounded-2 mb-4">
                        <a class="text-white" href="{{ route('unit', $unit) }}">
                            <h3>{{ $unit->title }}</h3>
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-muted">No unit found.</p>
            @endforelse
        </div>
    </div>
@endsection
