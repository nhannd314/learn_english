<div class="listen-block my-4">
    <h3 class="mb-3">{{ $listen->title }}</h3>
    <div class="mb-3">
        <audio style="width: 500px; max-width: 100%" controls src="{{ asset('storage/' . $listen->file) }}"></audio>
    </div>
    @if ($listen->transcript)
        <div class="mb-4 listen-content">
            {!! $listen->transcript !!}
        </div>
    @endif
</div>
