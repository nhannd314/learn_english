@extends('layouts.main')

@section('body-class', 'lesson')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('course', $lesson->unit->course->id) }}">{{ $lesson->unit->course->title }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('unit', $lesson->unit->id) }}">{{ $lesson->unit->title }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $lesson->title }}</li>
            </ol>
        </nav>

        <h1 class="mb-4">{{ $lesson->title }}</h1>
        <div class="description mb-4">
            {{ $lesson->description }}
        </div>
        <div class="vocabulary mb-5">
            <h2 class="mb-4">Vocabulary</h2>
            <table class="table table-striped">

                @forelse($lesson->words as $word)
                    <tr>
                        <td>{{ $word['word'] }}</td>
                        <td>{{ $word['ipa'] }}</td>
                        <td>
                            @foreach($word['meaning'] as $mean)
                                <div>
                                    <strong class="m">{{ $mean[0] }}</strong>
                                    <span>{{ $mean[1] }}</span>
                                </div>
                            @endforeach
                        </td>
                        <td><button class="btn btn-primary" x-data @click="new Audio('{{ asset('storage/words/' . $word['audio']) }}').play()"><i class="fa-solid fa-play"></i></button></td>
                    </tr>
                @empty

                @endforelse

            </table>
        </div>
        <div class="content">
            <h2 class="mb-4">Lesson content</h2>
            {!! $lesson->content !!}
        </div>
    </div>
@endsection
