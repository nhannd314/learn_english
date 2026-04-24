@extends('layouts.main')

@section('body-class', 'games')

@section('content')
    <div class="container">
        <h1 class="mb-4">Games</h1>
        <div class="game-list row">
            @forelse($games as $game)
                <div class="col-md-3 col-sm-12">
                    <div class="unit text-center bg-success p-4 rounded-2 mb-4">
                        <a class="text-white" href="{{ route('game.detail', $game) }}">
                            <h3>{{ $game->name }}</h3>
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-muted">No game found.</p>
            @endforelse
        </div>
    </div>
@endsection
