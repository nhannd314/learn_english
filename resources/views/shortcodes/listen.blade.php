<div class="audio-block my-4">
    <h3 class="mb-3">{{ $listen->title }}</h3>
    <div class="mb-3">
        <audio style="width: 500px; max-width: 100%" controls src="{{ asset('storage/' . $listen->file) }}"></audio>
    </div>
    @if ($listen->transcript)
        <div class="mb-3">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTranscript" aria-expanded="false" aria-controls="collapseTranscript">
                Show transcript
            </button>
        </div>
        <div class="collapse" id="collapseTranscript">
            <div class="card card-body">
                {{ $listen->transcript }}
            </div>
        </div>
    @endif
</div>
