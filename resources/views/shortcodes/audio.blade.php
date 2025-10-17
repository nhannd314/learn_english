<div class="audio-block my-4">
    <h3 class="mb-3">{{ $audio->title }}</h3>
    <div class="mb-3">
        <audio style="width: 500px" controls src="{{ $url }}"></audio>
    </div>
    @if ($transcript)
        <div class="mb-3">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTranscript" aria-expanded="false" aria-controls="collapseTranscript">
                Show transcript
            </button>
        </div>
        <div class="collapse" id="collapseTranscript">
            <div class="card card-body">
                {{ $transcript }}
            </div>
        </div>
    @endif
</div>
