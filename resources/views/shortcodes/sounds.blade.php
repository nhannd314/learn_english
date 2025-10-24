<div class="sounds-block my-4">
    <h3 class="mb-4">Select the pictures to hear the words</h3>
    <div class="row">

        @forelse($sounds as $sound)
            <div class="col-md-3 col-sm-6">
                <a class="text-center d-block border p-2 mb-3 rounded-2" href="javascript:void(0)" onclick="new Audio('{{ asset('storage/' . $sound->file) }}').play()">
                    <img src="{{ asset('storage/' . $sound->img) }}" alt="{{ $sound->title }}" />
                    <h4 class="text-center">{{ $sound->title }}</h4>
                </a>
            </div>
        @empty
        @endforelse

    </div>
</div>
