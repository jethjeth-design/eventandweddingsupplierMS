<x-app-layout>

<div style="max-width:1200px;margin:auto;padding:20px;">

    <h2 style="margin-bottom:20px;">📊 All Bookings</h2>

    {{-- FILTERS --}}
    <div style="margin-bottom:15px;">
        <form method="GET" style="display:flex;gap:10px;flex-wrap:wrap;">
            
            <select name="status">
                <option value="">All Status</option>
                <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ request('status')=='confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ request('status')=='cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>

            <input type="text" name="search" placeholder="Search event or supplier..." value="{{ request('search') }}">

            <button type="submit">Filter</button>

        </form>
    </div>

    {{-- TABLE --}}
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <thead style="background:#f5f5f5;">
            <tr>
                <th>#</th>
                <th>Event</th>
                <th>Client</th>
                <th>Supplier</th>
                <th>Package</th>
                <th>Date</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $booking->event->event_name ?? '-' }} <br>
                        <small>{{ $booking->event->event_type ?? '' }}</small>
                    </td>

                    <td>
                        ID: {{ $booking->user_id }}
                    </td>

                    <td>
                        {{ $booking->package->supplier->business_name ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $booking->package->name ?? '-' }}
                    </td>

                    <td>
                        {{ $booking->event_date }}
                    </td>

                    <td>
                        ₱{{ number_format($booking->total_price ?? 0) }}
                    </td>

                    <td>
                        @if($booking->status == 'pending')
                            <span style="color:orange;">Pending</span>
                        @elseif($booking->status == 'confirmed')
                            <span style="color:green;">Confirmed</span>
                        @else
                            <span style="color:red;">Cancelled</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No bookings found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

</x-app-layout>