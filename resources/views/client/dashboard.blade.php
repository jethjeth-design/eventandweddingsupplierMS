<x-client-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap');
    :root {
        --gold:#C9A84C; --gold-dark:#8A6A1F; --gold-light:rgba(201,168,76,0.10);
        --ivory:#FAF7F2; --charcoal:#1E1B18; --warm-grey:#706B65;
        --border:#E5DDD5; --border-md:#E0D8D0; --white:#FFFFFF;
        --font-display:'Playfair Display',Georgia,serif;
        --font-body:'DM Sans',sans-serif;
    }

    .cd-page { padding: 1.5rem; max-width: 1100px; margin: 0 auto; }

    /* ── Page header ── */
    .cd-top { display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:.75rem; margin-bottom:1.5rem; }
    .cd-title { font-family:var(--font-display); font-size:1.65rem; font-weight:700; color:var(--charcoal); line-height:1.15; }
    .cd-title em { font-style:italic; color:var(--gold-dark); }
    .cd-subtitle { font-size:.76rem; color:var(--warm-grey); margin-top:.2rem; font-family:var(--font-body); }
    .cd-welcome-chip {
        display:inline-flex; align-items:center; gap:.4rem;
        font-size:.68rem; font-weight:500; letter-spacing:.04em;
        color:var(--gold-dark); background:var(--gold-light);
        border:1px solid rgba(201,168,76,.3); padding:.3rem .85rem;
        border-radius:20px; font-family:var(--font-body); white-space:nowrap;
    }
    .cd-welcome-chip svg { width:11px; height:11px; }

    /* ── Stat cards ── */
    .cd-stats { display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-bottom:1.5rem; }
    @media(max-width:700px) { .cd-stats { grid-template-columns:1fr 1fr; } }
    @media(max-width:420px) { .cd-stats { grid-template-columns:1fr; } }

    .cd-stat {
        background:var(--white); border:1.5px solid var(--border); border-radius:12px;
        padding:1.1rem 1.25rem; position:relative; overflow:hidden;
        transition:box-shadow .2s, border-color .2s;
    }
    .cd-stat:hover { box-shadow:0 4px 18px rgba(30,27,24,.08); border-color:rgba(201,168,76,.35); }
    .cd-stat::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; border-radius:12px 12px 0 0; }
    .cd-stat.total::before  { background:linear-gradient(90deg,var(--gold-dark),var(--gold)); }
    .cd-stat.pending::before{ background:linear-gradient(90deg,#D97706,#FBBF24); }
    .cd-stat.confirmed::before{ background:linear-gradient(90deg,#15803D,#4ADE80); }
    .cd-stat.completed::before{ background:linear-gradient(90deg,#6B6560,#B0A89E); }

    .cd-stat-icon {
        width:34px; height:34px; border-radius:8px; margin-bottom:.75rem;
        display:flex; align-items:center; justify-content:center;
    }
    .cd-stat-icon svg { width:16px; height:16px; }
    .cd-stat.total    .cd-stat-icon { background:var(--gold-light); color:var(--gold-dark); }
    .cd-stat.pending  .cd-stat-icon { background:rgba(251,191,36,.12); color:#D97706; }
    .cd-stat.confirmed .cd-stat-icon{ background:rgba(74,222,128,.12); color:#15803D; }
    .cd-stat.completed .cd-stat-icon{ background:rgba(176,168,158,.12); color:#6B6560; }

    .cd-stat-num { font-family:var(--font-display); font-size:1.9rem; font-weight:700; line-height:1; margin-bottom:.2rem; }
    .cd-stat.total    .cd-stat-num { color:var(--gold-dark); }
    .cd-stat.pending  .cd-stat-num { color:#D97706; }
    .cd-stat.confirmed .cd-stat-num{ color:#15803D; }
    .cd-stat.completed .cd-stat-num{ color:#6B6560; }
    .cd-stat-label { font-size:.62rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--warm-grey); font-family:var(--font-body); }

    /* ── Two-column grid ── */
    .cd-grid { display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; }
    @media(max-width:700px) { .cd-grid { grid-template-columns:1fr; } }

    /* ── Section card ── */
    .cd-card {
        background:var(--white); border:1.5px solid var(--border); border-radius:12px;
        overflow:hidden; box-shadow:0 1px 10px rgba(30,27,24,.05);
    }
    .cd-card-bar { height:3px; background:linear-gradient(90deg,var(--gold-dark),var(--gold),rgba(201,168,76,.25)); }
    .cd-card-head {
        display:flex; align-items:center; gap:.5rem;
        padding:.85rem 1.1rem;
        border-bottom:1px solid var(--border);
        background:rgba(201,168,76,.03);
    }
    .cd-card-head-title {
        font-size:.6rem; font-weight:700; letter-spacing:.16em; text-transform:uppercase;
        color:var(--gold-dark); font-family:var(--font-body);
        display:flex; align-items:center; gap:.4rem;
    }
    .cd-card-head-title svg { width:12px; height:12px; flex-shrink:0; }
    .cd-card-head-title::after { content:''; flex:1; height:1px; background:linear-gradient(90deg,rgba(201,168,76,.35),transparent); }
    .cd-card-body { padding:.85rem 1.1rem; }

    /* ── Booking item ── */
    .cd-item {
        padding:.75rem .9rem; border-radius:8px;
        border:1px solid var(--border); background:var(--ivory);
        margin-bottom:.6rem; transition:background .15s, border-color .15s;
        position:relative;
    }
    .cd-item:last-child { margin-bottom:0; }
    .cd-item:hover { background:rgba(201,168,76,.05); border-color:rgba(201,168,76,.3); }

    .cd-item-name {
        font-family:var(--font-display); font-size:.88rem; font-weight:700;
        color:var(--charcoal); margin-bottom:.25rem; line-height:1.2;
    }
    .cd-item-meta { font-size:.74rem; color:var(--warm-grey); font-family:var(--font-body); line-height:1.6; }
    .cd-item-meta span { display:inline-flex; align-items:center; gap:.28rem; }
    .cd-item-meta svg { width:11px; height:11px; color:var(--gold-dark); opacity:.7; flex-shrink:0; }

    .cd-item-footer { display:flex; align-items:center; justify-content:space-between; margin-top:.45rem; flex-wrap:wrap; gap:.35rem; }
    .cd-item-price { font-family:var(--font-display); font-size:.88rem; font-weight:700; color:var(--gold-dark); }
    .cd-item-price small { font-size:.62rem; font-weight:400; color:var(--warm-grey); font-family:var(--font-body); margin-left:2px; }

    /* ── Status badges ── */
    .cd-badge {
        display:inline-flex; align-items:center; gap:.3rem;
        padding:.2rem .6rem; border-radius:20px;
        font-size:.62rem; font-weight:700; letter-spacing:.04em; text-transform:uppercase;
        font-family:var(--font-body); white-space:nowrap;
    }
    .cd-badge-dot { width:6px; height:6px; border-radius:50%; flex-shrink:0; }
    .cd-badge.pending   { background:#FEF3C7; color:#92400E; border:1px solid #FCD34D; }
    .cd-badge.pending   .cd-badge-dot { background:#F59E0B; }
    .cd-badge.confirmed { background:#F0FDF4; color:#15803D; border:1px solid #BBF7D0; }
    .cd-badge.confirmed .cd-badge-dot { background:#22C55E; }
    .cd-badge.cancelled { background:#FEF2F2; color:#DC2626; border:1px solid #FECACA; }
    .cd-badge.cancelled .cd-badge-dot { background:#DC2626; }
    .cd-badge.completed { background:#F8FAFC; color:#6B6560; border:1px solid var(--border-md); }
    .cd-badge.completed .cd-badge-dot { background:#9CA3AF; }

    /* ── Empty state ── */
    .cd-empty { text-align:center; padding:2rem 1rem; color:var(--warm-grey); font-size:.8rem; font-family:var(--font-body); }
    .cd-empty svg { width:36px; height:36px; color:#DDD4C8; margin:0 auto .6rem; display:block; }
    </style>

    <div class="cd-page">

        {{-- ── Top header ── --}}
        <div class="cd-top">
            <div>
                <h1 class="cd-title">Client <em>Dashboard</em></h1>
                <p class="cd-subtitle">Welcome back — here's what's happening with your events</p>
            </div>
            <div class="cd-welcome-chip">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="8" cy="6" r="3"/><path d="M2 14c0-3 2.7-5 6-5s6 2 6 5"/>
                </svg>
                {{ Auth::user()->name }}
            </div>
        </div>

        {{-- ── Stat cards ── --}}
        <div class="cd-stats">
            <div class="cd-stat total">
                <div class="cd-stat-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M9 12l2 2 4-4M7 3H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2h-2"/>
                        <rect x="7" y="1" width="6" height="4" rx="1"/>
                    </svg>
                </div>
                <div class="cd-stat-num">{{ $totalBookings }}</div>
                <div class="cd-stat-label">Total Bookings</div>
            </div>

            <div class="cd-stat pending">
                <div class="cd-stat-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="10" r="8"/><path d="M10 6v4l3 3"/>
                    </svg>
                </div>
                <div class="cd-stat-num">{{ $pending }}</div>
                <div class="cd-stat-label">Pending</div>
            </div>

            <div class="cd-stat confirmed">
                <div class="cd-stat-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M4 10l5 5 7-8"/>
                    </svg>
                </div>
                <div class="cd-stat-num">{{ $confirmed }}</div>
                <div class="cd-stat-label">Confirmed</div>
            </div>

            <div class="cd-stat completed">
                <div class="cd-stat-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="3" y="4" width="14" height="13" rx="2"/>
                        <path d="M7 2v4M13 2v4M3 9h14"/>
                    </svg>
                </div>
                <div class="cd-stat-num">{{ $completed }}</div>
                <div class="cd-stat-label">Completed</div>
            </div>
        </div>

        {{-- ── Two-column grid ── --}}
        @php
            $now = \Carbon\Carbon::now();
            $upcoming = $bookings->filter(function ($booking) use ($now) {
                return \Carbon\Carbon::parse($booking->event_date)->greaterThanOrEqualTo($now);
            });
        @endphp

        <div class="cd-grid">

            {{-- ── Upcoming Events ── --}}
            <div class="cd-card">
                <div class="cd-card-bar"></div>
                <div class="cd-card-head">
                    <div class="cd-card-head-title">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="1" y="2" width="12" height="11" rx="1.5"/>
                            <path d="M4 1v2M10 1v2M1 6h12"/>
                        </svg>
                        Upcoming Events
                    </div>
                </div>
                <div class="cd-card-body">
                    @forelse($upcoming as $booking)
                    <div class="cd-item">
                        <div class="cd-item-name">
                            {{ $booking->event->event_name ?? 'Unnamed Event' }}
                        </div>
                        <div class="cd-item-meta">
                            <span>
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <rect x="1" y="2" width="12" height="11" rx="1.5"/>
                                    <path d="M4 1v2M10 1v2M1 6h12"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($booking->event_date)->format('M d, Y') }}
                            </span>
                            &nbsp;·&nbsp;
                            <span>
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <rect x="2" y="6" width="10" height="7" rx="1"/>
                                    <path d="M4 6V4a3 3 0 016 0v2"/>
                                </svg>
                                {{ $booking->package->supplier->business_name ?? 'N/A' }}
                            </span>
                        </div>
                        <div class="cd-item-footer">
                            <span></span>
                            <span class="cd-badge {{ $booking->status }}">
                                <span class="cd-badge-dot"></span>
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="cd-empty">
                        <svg viewBox="0 0 40 40" fill="none" stroke="currentColor" stroke-width="1.3">
                            <rect x="5" y="7" width="30" height="27" rx="3"/>
                            <path d="M13 4v6M27 4v6M5 16h30"/>
                        </svg>
                        No upcoming events.
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- ── Recent Bookings ── --}}
            <div class="cd-card">
                <div class="cd-card-bar"></div>
                <div class="cd-card-head">
                    <div class="cd-card-head-title">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M6 9l1.5 1.5L11 6M5 2H3.5A1.5 1.5 0 002 3.5v9A1.5 1.5 0 003.5 14h7A1.5 1.5 0 0012 12.5V3.5A1.5 1.5 0 0010.5 2H9"/>
                            <rect x="5" y="1" width="4" height="2.5" rx=".75"/>
                        </svg>
                        Recent Bookings
                    </div>
                </div>
                <div class="cd-card-body">
                    @forelse($bookings->take(5) as $booking)
                    <div class="cd-item">
                        <div class="cd-item-name">
                            {{ $booking->package->name ?? 'Unnamed Package' }}
                        </div>
                        <div class="cd-item-meta">
                            <span>
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <rect x="1" y="2" width="12" height="11" rx="1.5"/>
                                    <path d="M4 1v2M10 1v2M1 6h12"/>
                                </svg>
                                {{ $booking->event->event_name ?? 'N/A' }}
                            </span>
                        </div>
                        <div class="cd-item-footer">
                            <div class="cd-item-price">
                                ₱{{ number_format($booking->total_price) }}
                                <small>total</small>
                            </div>
                            <span class="cd-badge {{ $booking->status }}">
                                <span class="cd-badge-dot"></span>
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="cd-empty">
                        <svg viewBox="0 0 40 40" fill="none" stroke="currentColor" stroke-width="1.3">
                            <path d="M10 8h20a2 2 0 012 2v20a2 2 0 01-2 2H10a2 2 0 01-2-2V10a2 2 0 012-2z"/>
                            <path d="M14 17h12M14 22h8"/>
                        </svg>
                        No bookings yet.
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

</x-client-layout>