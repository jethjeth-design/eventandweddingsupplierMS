<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in for admin!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="container">

    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

    {{-- =========================
        📊 METRIC CARDS
    ========================== --}}
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">

        <div class="card">
            <h3>Total Bookings</h3>
            <p class="value">{{ $totalBookings ?? 0 }}</p>
        </div>

        <div class="card">
            <h3>Confirmed</h3>
            <p class="value text-green-600">{{ $confirmedBookings ?? 0 }}</p>
        </div>

        <div class="card">
            <h3>Pending</h3>
            <p class="value text-yellow-600">{{ $pendingBookings ?? 0 }}</p>
        </div>

        <div class="card">
            <h3>Cancelled</h3>
            <p class="value text-red-600">{{ $cancelledBookings ?? 0 }}</p>
        </div>

        <div class="card">
            <h3>Revenue (Confirmed Only)</h3>
            <p class="value">₱{{ number_format($confirmedRevenue ?? 0, 2) }}</p>
        </div>

        <div class="card">
            <h3>Pending Value</h3>
            <p class="value">₱{{ number_format($pendingRevenue ?? 0, 2) }}</p>
        </div>

        <div class="card">
            <h3>Avg Booking</h3>
            <p class="value">₱{{ number_format($avgBookingValue ?? 0, 2) }}</p>
        </div>

    </div>

    {{-- =========================
        📈 CHARTS
    ========================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="chart-card">
            <h3>Monthly Revenue</h3>
            <canvas id="revenueChart"></canvas>
        </div>

        <div class="chart-card">
            <h3>Event Types</h3>
            <canvas id="eventChart"></canvas>
        </div>

    </div>

    <hr class="my-8">

    {{-- =========================
        🔥 TOP LISTS
    ========================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div>
            <h3 class="font-bold mb-2">Top Packages</h3>
            <ul>
                @forelse($topPackages ?? [] as $p)
                    <li>{{ $p->name }} ({{ $p->bookings_count ?? 0 }})</li>
                @empty
                    <li>No data</li>
                @endforelse
            </ul>
        </div>

        <div>
            <h3 class="font-bold mb-2">Top Popular Packages</h3>
            <ul>
                @forelse($topPopularPackages ?? [] as $p)
                    <li>{{ $p->name }} ({{ $p->bookings_count ?? 0 }})</li>
                @empty
                    <li>No data</li>
                @endforelse
            </ul>
        </div>

        <div>
            <h3 class="font-bold mb-2">Top Suppliers</h3>
            <ul>
                @forelse($topSuppliers ?? [] as $s)
                    <li>{{ $s->business_name ?? 'N/A' }}</li>
                @empty
                    <li>No data</li>
                @endforelse
            </ul>
        </div>

    </div>

</div>

{{-- =========================
    🎨 STYLES
========================== --}}
<style>
.card {
    background: white;
    padding: 18px;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
}

.card h3 {
    font-size: 14px;
    color: #6b7280;
}

.card .value {
    font-size: 22px;
    font-weight: bold;
    margin-top: 6px;
}

.chart-card {
    background: white;
    padding: 20px;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
}
</style>

{{-- =========================
    📊 CHART JS
========================== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/*
|------------------------------------------------------------------
| 📈 REVENUE CHART
|------------------------------------------------------------------
*/
const revenueCtx = document.getElementById('revenueChart');

if (revenueCtx) {
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: @json($monthlyRevenue->pluck('month') ?? []),
            datasets: [{
                label: 'Revenue',
                data: @json($monthlyRevenue->pluck('revenue') ?? []),
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37,99,235,0.1)',
                fill: true,
                tension: 0.4
            }]
        }
    });
}

/*
|------------------------------------------------------------------
| 📊 EVENT TYPE CHART
|------------------------------------------------------------------
*/
const eventCtx = document.getElementById('eventChart');

if (eventCtx) {
    new Chart(eventCtx, {
        type: 'doughnut',
        data: {
            labels: @json($eventTypes->pluck('event_type') ?? []),
            datasets: [{
                data: @json($eventTypes->pluck('total') ?? []),
                backgroundColor: [
                    '#2563eb',
                    '#10b981',
                    '#f59e0b',
                    '#ef4444',
                    '#8b5cf6'
                ]
            }]
        }
    });
}
</script>
</x-app-layout>
