<x-client-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            AI Recommendations for Event #{{ $event->id }}
        </h2>
    </x-slot>


    <div class="container">

    {{-- EVENT HEADER --}}
    <div class="mb-4">
        <h2>🎉 Event Details</h2>
    </div>

    {{-- EVENT INFO --}}
    <div class="card p-3 mb-4">
        <p><strong>Event Type:</strong> {{ ucfirst($event->event_type) }}</p>
        <p><strong>Date:</strong> {{ $event->event_date }}</p>
        <p><strong>Location:</strong> {{ $event->location }}</p>
        <p><strong>Guest Count:</strong> {{ $event->guest_count }}</p>
        <p><strong>Budget:</strong> ₱{{ number_format($event->budget) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($event->status) }}</p>
        <p><strong>Theme:</strong> {{ $event->theme ?? 'N/A' }}</p>
        <p><strong>Notes:</strong> {{ $event->notes ?? 'N/A' }}</p>
    </div>

    {{-- AI RECOMMENDATIONS --}}
    <div class="card p-3 mb-4">
        <h3>🤖 AI Recommended Suppliers</h3>

        @if($event->suppliers->count() > 0)

            <div class="row">
                @foreach($event->suppliers as $supplier)
                    <div class="col-md-4 mb-3">
                        <div class="border p-3 rounded shadow-sm">

                            <h5>{{ $supplier->name }}</h5>

                            <p>
                                <strong>Category:</strong> {{ $supplier->category }}
                            </p>

                            <p>
                                <strong>Price:</strong> ₱{{ number_format($supplier->price) }}
                            </p>

                            {{-- OPTIONAL: add rating if exists --}}
                            @if(isset($supplier->rating))
                                <p>
                                    <strong>Rating:</strong> ⭐ {{ $supplier->rating }}
                                </p>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <p class="text-danger">No AI recommendations found.</p>
        @endif
    </div>

    {{-- ACTIONS --}}
    <div class="mt-3">

        {{-- CANCEL EVENT --}}
        @if($event->status === 'pending')
            <form method="POST" action="{{ route('client.events.cancel', $event->id) }}">
                @csrf
                <button type="submit" class="btn btn-danger">
                    Cancel Event
                </button>
            </form>
        @endif

    </div>

</div>
</x-client-layout>
