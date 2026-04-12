<x-client-layout>
@foreach($recommendations as $package)
    <div class="card">

        <h4>{{ $package->name }}</h4>
        <p>₱{{ $package->price }}</p>

        <form action="{{ route('book.package') }}" method="POST">
            @csrf

            <input type="hidden" name="package_id" value="{{ $package->id }}">
            <input type="hidden" name="event_id" value="{{ $event->id }}">

            <button type="submit" class="btn btn-primary">
                Book Now
            </button>
        </form>

    </div>
@endforeach
<script>
fetch('/book-package', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        package_id: packageId,
        event_id: eventId
    })
});
</script>
</x-client-layout>