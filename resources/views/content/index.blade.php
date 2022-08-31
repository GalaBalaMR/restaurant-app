<x-guest-layout>
    <div class="mb-3 mt-3 d-flex justify-content-between  flex-wrap">
        @foreach($contents as $content)
        <div class="card m-auto mt-0 text-center" style="width: 18rem;" id="content-card{{ $content->id }}">
            <div class="card-body">
            <h5 class="card-title"><strong>{{ $content->name }}</strong></h5>
            <h6 class="card-subtitle mb-2 text-muted">Dátum vzniku: {{ \Carbon\Carbon::parse($content->created_at)->translatedFormat('F d, H') }}:00</h6>
            <h6 class="card-subtitle mb-2 text-muted">Dátum upravenia: {{ \Carbon\Carbon::parse($content->updated_at)->translatedFormat('F d, H') }}:00</h6>
            <p class="card-text">{{ $content->content }}</p>
            <div class="d-flex justify-content-center">
                <a href="{{ route('contents.edit', $content->id) }}" class="btn btn-warning me-2">Editovať</a>
                <form action="{{ route('contents.destroy', $content->id) }}"
                    class="content-form-delete"
                    method="POST"
                    onsubmit="return confirm('Určite chceš vymazať?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Vymazať</button>
                </form>
            </div>
            </div>
        </div>
        @endforeach
    </div>
</x-guest-layout>