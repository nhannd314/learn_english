@extends('layouts.main')

@section('body-class', 'lesson')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('course', $lesson->unit->course) }}">{{ $lesson->unit->course->title }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('unit', $lesson->unit) }}">{{ $lesson->unit->title }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $lesson->title }}</li>
            </ol>
        </nav>

        <h1 class="mb-4">{{ $lesson->title }}</h1>
        <div class="description mb-4">
            {{ $lesson->description }}
        </div>

        @if ($lesson->words)
            <div class="vocabulary mb-5">
                <h2 class="mb-4">Vocabulary</h2>
                <table class="table table-striped align-middle fs-5">

                    @foreach($lesson->words as $word)
                        <tr>
                            <td>{{ $word->source }}</td>
                            <td>{{ $word->ipa }}</td>
                            <td>
                                @foreach($word->mean as $mean)
                                    <div>
                                        <strong class="m">{{ $mean['pos'] }}</strong>
                                        <span>{{ $mean['vn'] }}</span>
                                    </div>
                                @endforeach
                            </td>
                            <td>
                                <button
                                    class="btn btn-primary"
                                    onClick="new Audio('{{ asset('storage/' . $word->file) }}').play()">
                                    <i class="fa-solid fa-play"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
        @endif

        <div class="content">
            <h2 class="mb-4">Lesson content</h2>
            {!! \App\Helpers\ShortcodeHelper::parse($lesson->content) !!}
        </div>
    </div>
@endsection
