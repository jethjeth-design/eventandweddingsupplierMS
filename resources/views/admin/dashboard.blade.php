{{-- resources/views/admin/dashboard.blade.php --}}
<x-app-layout>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=DM+Sans:wght@300;400;500;600&display=swap');

    :root {
        --gold:       #C9A84C;
        --gold-dark:  #A8842A;
        --gold-light: rgba(201,168,76,.11);
        --charcoal:   #1E1B18;
        --warm-grey:  #8C8178;
        --border:     #EDE8E2;
        --soft:       #F7F4F0;
        --white:      #FFFFFF;
        --ivory:      #FAF8F5;
        --danger:     #C0392B;
        --success:    #27AE60;
        --warning:    #E67E22;
        --font-d:     'Playfair Display', Georgia, serif;
        --font-b:     'DM Sans', sans-serif;
        --r-lg:       16px;
        --r-md:       12px;
        --r-sm:       8px;
        --sh-sm:      0 1px 4px rgba(30,27,24,.06);
        --sh-md:      0 4px 16px rgba(30,27,24,.10);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: var(--font-b); color: var(--charcoal); background: #F4F0EA; }

    /* ── WRAPPER ── */
    .ad-wrap {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1.25rem 4rem;
    }

    /* ── PAGE HEADER ── */
    .ad-page-head {
        display: flex; align-items: flex-end; justify-content: space-between;
        margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;
    }
    .ad-page-title {
        font-family: var(--font-d);
        font-size: 2rem; font-weight: 700;
        color: var(--charcoal); line-height: 1.1;
    }
    .ad-page-title em { font-style: italic; color: var(--gold-dark); }
    .ad-page-sub { font-size: .8rem; color: var(--warm-grey); margin-top: .3rem; }
    .ad-date-badge {
        display: inline-flex; align-items: center; gap: .45rem;
        padding: .38rem .9rem; border-radius: 999px;
        background: var(--white); border: 1.5px solid var(--border);
        font-size: .72rem; font-weight: 500; color: var(--warm-grey);
        box-shadow: var(--sh-sm);
    }
    .ad-date-badge svg { width: 12px; height: 12px; color: var(--gold); }

    /* ══════════════════════════════════
       METRIC CARDS
    ══════════════════════════════════ */
    .ad-metrics {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 1.75rem;
    }
    .ad-metric {
        background: var(--white);
        border-radius: var(--r-md);
        border: 1px solid var(--border);
        padding: 1.25rem 1.35rem;
        box-shadow: var(--sh-sm);
        display: flex; flex-direction: column;
        position: relative; overflow: hidden;
        transition: box-shadow .2s, transform .15s;
    }
    .ad-metric:hover { box-shadow: var(--sh-md); transform: translateY(-1px); }
    .ad-metric::after {
        content:'';
        position:absolute; top:0; left:0; right:0;
        height:3px;
    }
    .ad-metric.gold::after   { background: linear-gradient(90deg, var(--gold), var(--gold-dark)); }
    .ad-metric.green::after  { background: linear-gradient(90deg, #27AE60, #1E8449); }
    .ad-metric.yellow::after { background: linear-gradient(90deg, #E67E22, #F39C12); }
    .ad-metric.red::after    { background: linear-gradient(90deg, #C0392B, #E74C3C); }
    .ad-metric.blue::after   { background: linear-gradient(90deg, #2980B9, #3498DB); }
    .ad-metric.purple::after { background: linear-gradient(90deg, #8E44AD, #9B59B6); }
    .ad-metric.teal::after   { background: linear-gradient(90deg, #16A085, #1ABC9C); }

    .ad-metric-head { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: .75rem; }
    .ad-metric-label { font-size: .72rem; font-weight: 600; letter-spacing: .05em; text-transform: uppercase; color: var(--warm-grey); }
    .ad-metric-icon {
        width: 36px; height: 36px; border-radius: 9px;
        background: var(--gold-light);
        display: flex; align-items: center; justify-content: center;
        color: var(--gold-dark); flex-shrink: 0;
    }
    .ad-metric-icon svg { width: 16px; height: 16px; }
    .ad-metric-icon.green  { background: rgba(39,174,96,.1);  color: #1E8449; }
    .ad-metric-icon.yellow { background: rgba(230,126,34,.1); color: #D35400; }
    .ad-metric-icon.red    { background: rgba(192,57,43,.1);  color: var(--danger); }
    .ad-metric-icon.blue   { background: rgba(41,128,185,.1); color: #2471A3; }
    .ad-metric-icon.purple { background: rgba(142,68,173,.1); color: #76448A; }
    .ad-metric-icon.teal   { background: rgba(22,160,133,.1); color: #148F77; }

    .ad-metric-value {
        font-family: var(--font-d);
        font-size: 1.75rem; font-weight: 700;
        color: var(--charcoal); line-height: 1;
        margin-bottom: .25rem;
    }
    .ad-metric-value.green  { color: #1E8449; }
    .ad-metric-value.yellow { color: #D35400; }
    .ad-metric-value.red    { color: var(--danger); }
    .ad-metric-sub { font-size: .68rem; color: var(--warm-grey); }

    /* ══════════════════════════════════
       CHARTS ROW
    ══════════════════════════════════ */
    .ad-charts {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.25rem;
        margin-bottom: 1.75rem;
    }
    .ad-chart-card {
        background: var(--white);
        border-radius: var(--r-md);
        border: 1px solid var(--border);
        box-shadow: var(--sh-sm);
        overflow: hidden;
    }
    .ad-chart-head {
        display: flex; align-items: center; justify-content: space-between;
        padding: 1.1rem 1.5rem;
        border-bottom: 1px solid var(--soft);
        background: linear-gradient(to right, rgba(201,168,76,.03), transparent);
    }
    .ad-chart-head-l { display: flex; align-items: center; gap: .65rem; }
    .ad-chart-icon {
        width: 34px; height: 34px; border-radius: 8px;
        background: var(--gold-light);
        display: flex; align-items: center; justify-content: center;
        color: var(--gold-dark);
    }
    .ad-chart-icon svg { width: 15px; height: 15px; }
    .ad-chart-title { font-family: var(--font-d); font-size: .95rem; font-weight: 700; color: var(--charcoal); }
    .ad-chart-sub   { font-size: .68rem; color: var(--warm-grey); margin-top: .04rem; }
    .ad-chart-body  { padding: 1.35rem 1.5rem; }

    /* ══════════════════════════════════
       TOP LISTS ROW
    ══════════════════════════════════ */
    .ad-lists {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
    }
    .ad-list-card {
        background: var(--white);
        border-radius: var(--r-md);
        border: 1px solid var(--border);
        box-shadow: var(--sh-sm);
        overflow: hidden;
    }
    .ad-list-head {
        display: flex; align-items: center; gap: .65rem;
        padding: 1.1rem 1.5rem;
        border-bottom: 1px solid var(--soft);
        background: linear-gradient(to right, rgba(201,168,76,.03), transparent);
    }
    .ad-list-icon {
        width: 34px; height: 34px; border-radius: 8px;
        background: var(--gold-light);
        display: flex; align-items: center; justify-content: center;
        color: var(--gold-dark);
    }
    .ad-list-icon svg { width: 15px; height: 15px; }
    .ad-list-title { font-family: var(--font-d); font-size: .92rem; font-weight: 700; color: var(--charcoal); }
    .ad-list-body  { padding: .5rem 0; }

    /* List items */
    .ad-list-item {
        display: flex; align-items: center; justify-content: space-between;
        gap: .75rem;
        padding: .72rem 1.4rem;
        border-bottom: 1px solid var(--soft);
        transition: background .15s;
    }
    .ad-list-item:last-child { border-bottom: none; }
    .ad-list-item:hover { background: rgba(201,168,76,.03); }
    .ad-list-rank {
        width: 22px; height: 22px; border-radius: 50%; flex-shrink: 0;
        background: var(--gold-light);
        display: flex; align-items: center; justify-content: center;
        font-size: .62rem; font-weight: 700; color: var(--gold-dark);
    }
    .ad-list-rank.top { background: linear-gradient(135deg, var(--gold), var(--gold-dark)); color: var(--white); }
    .ad-list-name { flex: 1; min-width: 0; font-size: .8rem; font-weight: 500; color: var(--charcoal); }
    .ad-list-name span { font-size: .68rem; color: var(--warm-grey); display: block; }
    .ad-list-count {
        display: inline-flex; align-items: center;
        padding: .2rem .6rem; border-radius: 999px;
        background: var(--gold-light); color: var(--gold-dark);
        font-size: .65rem; font-weight: 700;
        white-space: nowrap; flex-shrink: 0;
    }

    /* empty */
    .ad-list-empty {
        padding: 1.75rem 1.4rem; text-align: center;
        font-size: .78rem; color: var(--warm-grey);
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 1050px) {
        .ad-metrics { grid-template-columns: repeat(2, 1fr); }
        .ad-charts  { grid-template-columns: 1fr; }
    }
    @media (max-width: 700px) {
        .ad-metrics { grid-template-columns: 1fr; }
        .ad-lists   { grid-template-columns: 1fr; }
        .ad-page-title { font-size: 1.6rem; }
    }
</style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Dashboard') }}</h2>
    </x-slot>

    <div class="ad-wrap">

        {{-- ── PAGE HEADER ── --}}
        <div class="ad-page-head">
            <div>
                <h1 class="ad-page-title">Admin <em>Dashboard</em></h1>
                <p class="ad-page-sub">Overview of bookings, revenue and top performers</p>
            </div>
            <div class="ad-date-badge">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="2" y="3" width="12" height="11" rx="2"/>
                    <path d="M5 2v2M11 2v2M2 7h12"/>
                </svg>
                {{ now()->format('F j, Y') }}
            </div>
        </div>

        {{-- ══════════════════════════════════
             METRIC CARDS
        ══════════════════════════════════ --}}
        <div class="ad-metrics">

            {{-- Total Bookings --}}
            <div class="ad-metric gold">
                <div class="ad-metric-head">
                    <div class="ad-metric-label">Total Bookings</div>
                    <div class="ad-metric-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="3" y="4" width="14" height="13" rx="2"/>
                            <path d="M7 2v4M13 2v4M3 9h14"/>
                        </svg>
                    </div>
                </div>
                <div class="ad-metric-value">{{ $totalBookings ?? 0 }}</div>
                <div class="ad-metric-sub">All time bookings</div>
            </div>

            {{-- Confirmed --}}
            <div class="ad-metric green">
                <div class="ad-metric-head">
                    <div class="ad-metric-label">Confirmed</div>
                    <div class="ad-metric-icon green">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <polyline points="4 10 8 14 16 6"/>
                            <circle cx="10" cy="10" r="8"/>
                        </svg>
                    </div>
                </div>
                <div class="ad-metric-value green">{{ $confirmedBookings ?? 0 }}</div>
                <div class="ad-metric-sub">Successfully confirmed</div>
            </div>

            {{-- Pending --}}
            <div class="ad-metric yellow">
                <div class="ad-metric-head">
                    <div class="ad-metric-label">Pending</div>
                    <div class="ad-metric-icon yellow">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="10" cy="10" r="8"/>
                            <path d="M10 6v4l2.5 2.5"/>
                        </svg>
                    </div>
                </div>
                <div class="ad-metric-value yellow">{{ $pendingBookings ?? 0 }}</div>
                <div class="ad-metric-sub">Awaiting confirmation</div>
            </div>

            {{-- Cancelled --}}
            <div class="ad-metric red">
                <div class="ad-metric-head">
                    <div class="ad-metric-label">Cancelled</div>
                    <div class="ad-metric-icon red">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="10" cy="10" r="8"/>
                            <path d="M7 7l6 6M13 7l-6 6"/>
                        </svg>
                    </div>
                </div>
                <div class="ad-metric-value red">{{ $cancelledBookings ?? 0 }}</div>
                <div class="ad-metric-sub">Cancelled bookings</div>
            </div>

            {{-- Confirmed Revenue --}}
            <div class="ad-metric blue">
                <div class="ad-metric-head">
                    <div class="ad-metric-label">Confirmed Revenue</div>
                    <div class="ad-metric-icon blue">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="10" cy="10" r="8"/>
                            <path d="M10 5v1.5M10 13.5V15M7.5 8.5a2.5 2.5 0 015 0c0 1.4-1.2 2-2.5 2s-2.5.6-2.5 2a2.5 2.5 0 005 0"/>
                        </svg>
                    </div>
                </div>
                <div class="ad-metric-value" style="font-size:1.35rem;">₱{{ number_format($confirmedRevenue ?? 0, 0) }}</div>
                <div class="ad-metric-sub">From confirmed bookings</div>
            </div>

            {{-- Pending Value --}}
            <div class="ad-metric yellow">
                <div class="ad-metric-head">
                    <div class="ad-metric-label">Pending Value</div>
                    <div class="ad-metric-icon yellow">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M3 3h14M3 7h14M3 11h8"/>
                            <circle cx="15" cy="14" r="3.5"/>
                            <path d="M15 12.5v1.5l1 1"/>
                        </svg>
                    </div>
                </div>
                <div class="ad-metric-value yellow" style="font-size:1.35rem;">₱{{ number_format($pendingRevenue ?? 0, 0) }}</div>
                <div class="ad-metric-sub">Awaiting confirmation</div>
            </div>

            {{-- Avg Booking --}}
            <div class="ad-metric teal">
                <div class="ad-metric-head">
                    <div class="ad-metric-label">Avg Booking</div>
                    <div class="ad-metric-icon teal">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <polyline points="3 14 7 9 10 12 13 7 17 11"/>
                            <path d="M3 17h14"/>
                        </svg>
                    </div>
                </div>
                <div class="ad-metric-value" style="font-size:1.35rem;">₱{{ number_format($avgBookingValue ?? 0, 0) }}</div>
                <div class="ad-metric-sub">Average booking value</div>
            </div>

        </div>

        {{-- ══════════════════════════════════
             CHARTS
        ══════════════════════════════════ --}}
        <div class="ad-charts">

            {{-- Revenue Line Chart --}}
            <div class="ad-chart-card">
                <div class="ad-chart-head">
                    <div class="ad-chart-head-l">
                        <div class="ad-chart-icon">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <polyline points="3 14 7 9 10 12 13 7 17 11"/>
                                <path d="M3 17h14"/>
                            </svg>
                        </div>
                        <div>
                            <div class="ad-chart-title">Monthly Revenue</div>
                            <div class="ad-chart-sub">Confirmed bookings revenue by month</div>
                        </div>
                    </div>
                </div>
                <div class="ad-chart-body">
                    <canvas id="revenueChart" style="max-height:240px;"></canvas>
                </div>
            </div>

            {{-- Event Type Doughnut --}}
            <div class="ad-chart-card">
                <div class="ad-chart-head">
                    <div class="ad-chart-head-l">
                        <div class="ad-chart-icon">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <circle cx="10" cy="10" r="7"/>
                                <path d="M10 3a7 7 0 017 7"/>
                            </svg>
                        </div>
                        <div>
                            <div class="ad-chart-title">Event Types</div>
                            <div class="ad-chart-sub">Breakdown by event category</div>
                        </div>
                    </div>
                </div>
                <div class="ad-chart-body" style="display:flex;align-items:center;justify-content:center;">
                    <canvas id="eventChart" style="max-height:220px;max-width:220px;"></canvas>
                </div>
            </div>

        </div>

        {{-- ══════════════════════════════════
             TOP LISTS
        ══════════════════════════════════ --}}
        <div class="ad-lists" style="margin-top:1.75rem;">

            {{-- Top Packages --}}
            <div class="ad-list-card">
                <div class="ad-list-head">
                    <div class="ad-list-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="2" y="7" width="16" height="10" rx="2"/>
                            <path d="M6 7V5a4 4 0 018 0v2"/>
                        </svg>
                    </div>
                    <div class="ad-list-title">Top Packages</div>
                </div>
                <div class="ad-list-body">
                    @forelse($topPackages ?? [] as $i => $p)
                    <div class="ad-list-item">
                        <div class="ad-list-rank {{ $i === 0 ? 'top' : '' }}">{{ $i + 1 }}</div>
                        <div class="ad-list-name">
                            {{ $p->name }}
                            @if(!empty($p->supplier->business_name))
                            <span>{{ $p->supplier->business_name }}</span>
                            @endif
                        </div>
                        <div class="ad-list-count">{{ $p->bookings_count ?? 0 }} bookings</div>
                    </div>
                    @empty
                    <div class="ad-list-empty">No data yet</div>
                    @endforelse
                </div>
            </div>

            {{-- Top Popular Packages --}}
            <div class="ad-list-card">
                <div class="ad-list-head">
                    <div class="ad-list-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M11 3L3 11l6 6 8-8-6-6z"/>
                            <path d="M14 7l2-2"/>
                        </svg>
                    </div>
                    <div class="ad-list-title">Top Popular Bundles</div>
                </div>
                <div class="ad-list-body">
                    @forelse($topPopularPackages ?? [] as $i => $p)
                    <div class="ad-list-item">
                        <div class="ad-list-rank {{ $i === 0 ? 'top' : '' }}">{{ $i + 1 }}</div>
                        <div class="ad-list-name">
                            {{ $p->name }}
                            @if(!empty($p->event_type))
                            <span>{{ $p->event_type }}</span>
                            @endif
                        </div>
                        <div class="ad-list-count">{{ $p->bookings_count ?? 0 }} bookings</div>
                    </div>
                    @empty
                    <div class="ad-list-empty">No data yet</div>
                    @endforelse
                </div>
            </div>

            {{-- Top Suppliers --}}
            <div class="ad-list-card">
                <div class="ad-list-head">
                    <div class="ad-list-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="10" cy="7" r="4"/>
                            <path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/>
                        </svg>
                    </div>
                    <div class="ad-list-title">Top Suppliers</div>
                </div>
                <div class="ad-list-body">
                    @forelse($topSuppliers ?? [] as $i => $s)
                    <div class="ad-list-item">
                        <div class="ad-list-rank {{ $i === 0 ? 'top' : '' }}">{{ $i + 1 }}</div>
                        <div class="ad-list-name">
                            {{ $s->business_name ?? ($s->first_name.' '.($s->last_name ?? '')) }}
                            @if(!empty($s->city))
                            <span>{{ $s->city }}{{ !empty($s->province) ? ', '.$s->province : '' }}</span>
                            @endif
                        </div>
                        @if(!empty($s->bookings_count))
                        <div class="ad-list-count">{{ $s->bookings_count }} bookings</div>
                        @endif
                    </div>
                    @empty
                    <div class="ad-list-empty">No data yet</div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>{{-- /ad-wrap --}}

{{-- ══════════════════════════════════
     CHART JS
══════════════════════════════════ --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const goldPalette = [
    '#C9A84C','#A8842A','#1E1B18','#8C8178',
    '#3d2f14','#E8D5A0','#2a2016'
];

Chart.defaults.font.family = "'DM Sans', sans-serif";
Chart.defaults.color = '#8C8178';

/* ── REVENUE CHART ── */
const revenueCtx = document.getElementById('revenueChart');
if (revenueCtx) {
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: @json($monthlyRevenue->pluck('month') ?? []),
            datasets: [{
                label: 'Revenue (₱)',
                data: @json($monthlyRevenue->pluck('revenue') ?? []),
                borderColor: '#C9A84C',
                backgroundColor: 'rgba(201,168,76,.08)',
                pointBackgroundColor: '#C9A84C',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                fill: true,
                tension: 0.42,
                borderWidth: 2.5,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1E1B18',
                    titleColor: '#C9A84C',
                    bodyColor: '#FAF8F5',
                    padding: 10,
                    cornerRadius: 8,
                    callbacks: {
                        label: ctx => ' ₱' + Number(ctx.raw).toLocaleString('en-PH')
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: 'rgba(237,232,226,.5)' },
                    ticks: { font: { size: 11 } }
                },
                y: {
                    grid: { color: 'rgba(237,232,226,.5)' },
                    ticks: {
                        font: { size: 11 },
                        callback: v => '₱' + Number(v).toLocaleString('en-PH', { notation:'compact' })
                    },
                    beginAtZero: true
                }
            }
        }
    });
}

/* ── EVENT TYPE DOUGHNUT ── */
const eventCtx = document.getElementById('eventChart');
if (eventCtx) {
    new Chart(eventCtx, {
        type: 'doughnut',
        data: {
            labels: @json($eventTypes->pluck('event_type') ?? []),
            datasets: [{
                data: @json($eventTypes->pluck('total') ?? []),
                backgroundColor: goldPalette,
                borderColor: '#FAF8F5',
                borderWidth: 3,
                hoverOffset: 6,
            }]
        },
        options: {
            responsive: true,
            cutout: '68%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 14,
                        font: { size: 11, family: "'DM Sans', sans-serif" },
                        usePointStyle: true,
                        pointStyleWidth: 8,
                    }
                },
                tooltip: {
                    backgroundColor: '#1E1B18',
                    titleColor: '#C9A84C',
                    bodyColor: '#FAF8F5',
                    padding: 10,
                    cornerRadius: 8,
                }
            }
        }
    });
}
</script>

</x-app-layout>