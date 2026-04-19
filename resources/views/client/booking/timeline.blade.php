<x-client-layout>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap');

    :root {
        --gold:        #C9A84C;
        --gold-light:  #E8C97A;
        --gold-dark:   #8A6A1F;
        --blush-deep:  #D4A090;
        --ivory:       #FAF7F2;
        --charcoal:    #1E1B18;
        --warm-grey:   #6B6560;
        --white:       #FFFFFF;
        --border:      #F0EBE5;
        --border-md:   #E0D8D0;
        --font-display:'Playfair Display', Georgia, serif;
        --font-body:   'DM Sans', sans-serif;
        --s-pending:   #D97706;
        --s-confirmed: #16A34A;
        --s-cancelled: #B91C1C;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    .tl-page { padding: 1.75rem 2rem 4rem; max-width: 860px; font-family: var(--font-body); }

    /* ── PAGE HEADER ── */
    .tl-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem; }
    .tl-page-title  { font-family: var(--font-display); font-size: clamp(1.3rem,2.5vw,1.8rem); font-weight: 700; color: var(--charcoal); line-height: 1.15; }
    .tl-page-title em { color: var(--gold-dark); font-style: italic; }
    .tl-page-sub    { font-size: 0.78rem; color: var(--warm-grey); margin-top: 0.25rem; }

    /* ── STAT CARDS ── */
    .tl-stat-row { display: grid; grid-template-columns: repeat(4,1fr); gap: 1rem; margin-bottom: 2rem; }
    @media(max-width:640px){ .tl-stat-row { grid-template-columns: 1fr 1fr; } }
    .tl-stat-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; padding: 1rem 1.2rem; position: relative; overflow: hidden; }
    .tl-stat-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; }
    .tl-stat-card.s-all::before       { background: linear-gradient(90deg,var(--gold),var(--blush-deep)); }
    .tl-stat-card.s-pending::before   { background: var(--s-pending); }
    .tl-stat-card.s-confirmed::before { background: var(--s-confirmed); }
    .tl-stat-card.s-cancelled::before { background: var(--s-cancelled); }
    .tl-stat-n { font-family: var(--font-display); font-size: 1.8rem; font-weight: 700; color: var(--gold-dark); line-height: 1; }
    .tl-stat-l { font-size: 0.62rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); margin-top: 3px; }

    /* ── BOOKING BLOCK ── */
    .tl-booking { margin-bottom: 2.5rem; }
    .tl-booking:last-child { margin-bottom: 0; }

    /* ── BOOKING HEADER ── */
    .tl-booking-header {
        background: var(--charcoal);
        border-radius: 4px 4px 0 0;
        padding: 1rem 1.35rem;
        display: flex; align-items: flex-start; justify-content: space-between;
        gap: 0.75rem; flex-wrap: wrap;
        position: relative; overflow: hidden;
    }
    .tl-booking-header::before {
        content:''; position:absolute; inset:0;
        background-image: radial-gradient(rgba(201,168,76,0.06) 1px, transparent 1px);
        background-size: 18px 18px; pointer-events: none;
    }
    .tl-booking-header::after {
        content:''; position:absolute; bottom:0; left:0; right:0; height:1.5px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }
    .tl-bh-inner { position: relative; z-index: 1; }
    .tl-event-name { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--white); line-height: 1.2; }
    .tl-event-date { font-size: 0.7rem; color: rgba(255,255,255,0.5); margin-top: 0.2rem; display: flex; align-items: center; gap: 0.3rem; }
    .tl-event-date svg { width: 10px; height: 10px; color: var(--gold); }

    /* Status badge */
    .tl-badge { display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.22rem 0.7rem; border-radius: 2px; font-size: 0.62rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; font-family: var(--font-body); position: relative; z-index: 1; align-self: flex-start; }
    .tl-badge::before { content:''; width:5px; height:5px; border-radius:50%; }
    .tl-badge.pending   { background: rgba(217,119,6,0.18);  color: #FDE68A; border: 1px solid rgba(217,119,6,0.4); }
    .tl-badge.pending::before   { background: #D97706; }
    .tl-badge.confirmed { background: rgba(22,163,74,0.15);  color: #A7F3D0; border: 1px solid rgba(22,163,74,0.35); }
    .tl-badge.confirmed::before { background: #16A34A; }
    .tl-badge.cancelled { background: rgba(185,28,28,0.15);  color: #FECACA; border: 1px solid rgba(185,28,28,0.35); }
    .tl-badge.cancelled::before { background: #EF4444; }

    /* ── TIMELINE BODY ── */
    .tl-body {
        background: var(--white);
        border: 1px solid var(--border); border-top: none;
        border-radius: 0 0 4px 4px;
        padding: 1.5rem 1.5rem 1.5rem 2rem;
    }

    /* ── TIMELINE TRACK ── */
    .tl-track { position: relative; padding-left: 2rem; }
    .tl-track::before {
        content:''; position:absolute; left: 10px; top: 6px;
        width: 2px;
        bottom: 6px;
        background: var(--border);
    }

    /* ── TIMELINE STEP ── */
    .tl-step { position: relative; padding-bottom: 1.35rem; }
    .tl-step:last-child { padding-bottom: 0; }

    /* Dot */
    .tl-step::before {
        content:''; position:absolute;
        left: -2rem; top: 4px;
        width: 14px; height: 14px; border-radius: 50%;
        background: var(--border-md); border: 2px solid var(--white);
        box-shadow: 0 0 0 2px var(--border-md);
        transition: background 0.2s, box-shadow 0.2s;
        z-index: 1;
    }

    /* Active dot — confirmed step */
    .tl-step.step-done::before {
        background: var(--s-confirmed);
        box-shadow: 0 0 0 3px rgba(22,163,74,0.18);
    }
    .tl-step.step-active::before {
        background: var(--gold);
        box-shadow: 0 0 0 3px rgba(201,168,76,0.22);
    }
    .tl-step.step-cancelled::before {
        background: var(--s-cancelled);
        box-shadow: 0 0 0 3px rgba(185,28,28,0.18);
    }
    .tl-step.step-waiting::before {
        background: var(--border-md);
        box-shadow: 0 0 0 2px var(--border);
    }

    /* Step card */
    .tl-step-card {
        background: var(--ivory);
        border: 1px solid var(--border);
        border-radius: 4px;
        padding: 0.75rem 1rem;
        transition: border-color 0.2s;
    }
    .tl-step.step-done   .tl-step-card { border-color: rgba(22,163,74,0.25);  background: rgba(22,163,74,0.03); }
    .tl-step.step-active .tl-step-card { border-color: rgba(201,168,76,0.3);  background: rgba(201,168,76,0.04); }
    .tl-step.step-cancelled .tl-step-card { border-color: rgba(185,28,28,0.2); background: rgba(185,28,28,0.03); }

    .tl-step-title { font-size: 0.78rem; font-weight: 700; color: var(--charcoal); display: flex; align-items: center; gap: 0.4rem; margin-bottom: 0.2rem; }
    .tl-step-title svg { width: 13px; height: 13px; flex-shrink: 0; }
    .tl-step-title .icon-done      { color: var(--s-confirmed); }
    .tl-step-title .icon-active    { color: var(--gold-dark); }
    .tl-step-title .icon-cancelled { color: var(--s-cancelled); }
    .tl-step-title .icon-waiting   { color: #C0B8B0; }
    .tl-step-sub { font-size: 0.72rem; color: var(--warm-grey); line-height: 1.5; }

    /* ── INFO GRID (package / supplier / price) ── */
    .tl-info-section {
        margin-top: 1.25rem;
        padding-top: 1.1rem;
        border-top: 1px solid var(--border);
        display: grid;
        grid-template-columns: repeat(3,1fr);
        gap: 0.7rem 1rem;
    }
    @media(max-width:560px){ .tl-info-section { grid-template-columns: 1fr 1fr; } }
    .tl-info-k { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.09em; text-transform: uppercase; color: #C0B8B0; margin-bottom: 0.18rem; display: flex; align-items: center; gap: 0.25rem; }
    .tl-info-k svg { width: 9px; height: 9px; color: var(--gold-dark); }
    .tl-info-v { font-size: 0.82rem; color: var(--charcoal); font-weight: 500; }
    .tl-info-v.nil { color: #C0B8B0; font-style: italic; font-size: 0.76rem; }
    .tl-price-v { font-family: var(--font-display); font-size: 0.95rem; font-weight: 700; color: var(--gold-dark); }

    /* ── EMPTY STATE ── */
    .tl-empty { text-align: center; padding: 4.5rem 2rem; background: var(--white); border: 1px solid var(--border); border-radius: 4px; }
    .tl-empty svg { width: 52px; height: 52px; color: var(--gold); opacity: 0.25; margin: 0 auto 1.1rem; display: block; }
    .tl-empty-title { font-family: var(--font-display); font-size: 1.15rem; font-weight: 600; color: var(--charcoal); margin-bottom: 0.35rem; }
    .tl-empty-sub { font-size: 0.83rem; color: var(--warm-grey); line-height: 1.65; }

    /* ── FILTER BAR ── */
    .tl-filter-bar { background: var(--white); border: 1px solid var(--border); border-radius: 4px; padding: 0.75rem 1.1rem; display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.5rem; }
    .tl-filter-label { font-size: 0.62rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); margin-right: 0.25rem; }
    .tl-filter-tab { padding: 0.32rem 0.9rem; border-radius: 2px; border: 1px solid var(--border-md); background: var(--ivory); font-size: 0.72rem; color: var(--warm-grey); cursor: pointer; font-family: var(--font-body); transition: all 0.18s; }
    .tl-filter-tab:hover { border-color: var(--gold); color: var(--gold-dark); }
    .tl-filter-tab.active { background: var(--gold); border-color: var(--gold); color: var(--charcoal); font-weight: 600; }

    .reveal { opacity:0; transform: translateY(12px); transition: opacity 0.45s ease,transform 0.45s ease; }
    .reveal.visible { opacity:1; transform:none; }
    @media(max-width:700px){ .tl-page { padding: 1.25rem 1rem 3rem; } }
</style>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('My Bookings') }}
    </h2>
</x-slot>

<div class="tl-page">

    {{-- Page Header --}}
    <div class="tl-page-header reveal">
        <div>
            <h1 class="tl-page-title">My <em>Bookings</em></h1>
            <p class="tl-page-sub">Track the progress of all your event bookings.</p>
        </div>
    </div>

    {{-- Stat Cards --}}
    @php
        $total     = $bookings->count();
        $pending   = $bookings->where('status','pending')->count();
        $confirmed = $bookings->where('status','confirmed')->count();
        $cancelled = $bookings->where('status','cancelled')->count();
    @endphp

    <div class="tl-stat-row reveal">
        <div class="tl-stat-card s-all">
            <div class="tl-stat-n">{{ $total }}</div>
            <div class="tl-stat-l">Total</div>
        </div>
        <div class="tl-stat-card s-pending">
            <div class="tl-stat-n">{{ $pending }}</div>
            <div class="tl-stat-l">Pending</div>
        </div>
        <div class="tl-stat-card s-confirmed">
            <div class="tl-stat-n">{{ $confirmed }}</div>
            <div class="tl-stat-l">Confirmed</div>
        </div>
        <div class="tl-stat-card s-cancelled">
            <div class="tl-stat-n">{{ $cancelled }}</div>
            <div class="tl-stat-l">Cancelled</div>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="tl-filter-bar reveal">
        <span class="tl-filter-label">Filter</span>
        <button class="tl-filter-tab active" data-filter="all">All</button>
        <button class="tl-filter-tab" data-filter="pending">Pending</button>
        <button class="tl-filter-tab" data-filter="confirmed">Confirmed</button>
        <button class="tl-filter-tab" data-filter="cancelled">Cancelled</button>
    </div>

    {{-- Bookings --}}
    @if($bookings->count())
    <div id="tlList">

    @foreach($bookings as $booking)
    @php
        $status      = $booking->status ?? 'pending';
        $eventName   = $booking->event->event_name ?? 'Event';
        $eventType   = $booking->event->event_type ?? null;
        $venue       = $booking->event->venue ?? null;
        $eventDate   = $booking->event_date ?? null;
        $pkgName     = $booking->package->name ?? null;
        $price       = $booking->total_price ?? 0;
        $supplierBiz = $booking->package->supplier->business_name
                    ?? $booking->package->supplier->name
                    ?? null;
        $placedAt    = $booking->created_at
                        ? $booking->created_at->format('M d, Y g:i A')
                        : '—';
        $formattedDate = $eventDate
            ? \Carbon\Carbon::parse($eventDate)->format('M d, Y')
            : '—';

        // Per-step classes
        $stepPlaced    = 'step-done';
        $stepConfirm   = match($status) {
            'confirmed' => 'step-done',
            'cancelled' => 'step-cancelled',
            default     => 'step-waiting',
        };
        $stepEvent     = $status === 'confirmed' ? 'step-active' : 'step-waiting';
    @endphp

    <div class="tl-booking reveal" data-status="{{ $status }}">

        {{-- Booking Header --}}
        <div class="tl-booking-header">
            <div class="tl-bh-inner">
                <div class="tl-event-name">{{ $eventName }}</div>
                <div class="tl-event-date">
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="2" width="10" height="9" rx="1.5"/><path d="M4 1v2M8 1v2M1 6h10"/></svg>
                    {{ $formattedDate }}
                    @if($eventType)
                        &nbsp;·&nbsp;{{ $eventType }}
                    @endif
                </div>
            </div>
            <span class="tl-badge {{ $status }}">{{ ucfirst($status) }}</span>
        </div>

        {{-- Timeline Body --}}
        <div class="tl-body">
            <div class="tl-track">

                {{-- STEP 1 — Booked Placed --}}
                <div class="tl-step {{ $stepPlaced }}">
                    <div class="tl-step-card">
                        <div class="tl-step-title">
                            <svg class="icon-done" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 8l3.5 3.5L13 4"/></svg>
                            Booked Placed
                        </div>
                        <div class="tl-step-sub">{{ $placedAt }}</div>
                    </div>
                </div>

                {{-- STEP 2 — Supplier Confirmation --}}
                <div class="tl-step {{ $stepConfirm }}">
                    <div class="tl-step-card">
                        <div class="tl-step-title">
                            @if($status === 'confirmed')
                                <svg class="icon-done" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 8l3.5 3.5L13 4"/></svg>
                            @elseif($status === 'cancelled')
                                <svg class="icon-cancelled" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M4 4l8 8M12 4l-8 8"/></svg>
                            @else
                                <svg class="icon-waiting" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="8" r="6"/><path d="M8 5v3l2 1.5"/></svg>
                            @endif
                            Supplier Confirmation
                        </div>
                        <div class="tl-step-sub">
                            @if($status === 'pending')
                                Awaiting supplier response…
                            @elseif($status === 'confirmed')
                                Confirmed by supplier
                            @else
                                Booking was cancelled
                            @endif
                        </div>
                    </div>
                </div>

                {{-- STEP 3 — Event Day --}}
                <div class="tl-step {{ $stepEvent }}">
                    <div class="tl-step-card">
                        <div class="tl-step-title">
                            @if($status === 'confirmed')
                                <svg class="icon-active" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="12" height="12" rx="2"/><path d="M2 7h12M6 2v2M10 2v2"/></svg>
                            @else
                                <svg class="icon-waiting" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="12" height="12" rx="2"/><path d="M2 7h12M6 2v2M10 2v2"/></svg>
                            @endif
                            Event Day
                        </div>
                        <div class="tl-step-sub">
                            @if($status === 'confirmed')
                                Scheduled for {{ $formattedDate }}
                            @else
                                Pending confirmation
                            @endif
                        </div>
                    </div>
                </div>

            </div>{{-- /tl-track --}}

            {{-- Info grid --}}
            <div class="tl-info-section">
                <div>
                    <div class="tl-info-k">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="2" width="10" height="9" rx="1.5"/><path d="M3 5h6M3 7.5h4"/></svg>
                        Package
                    </div>
                    <div class="tl-info-v {{ !$pkgName ? 'nil' : '' }}">{{ $pkgName ?? '—' }}</div>
                </div>
                <div>
                    <div class="tl-info-k">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 1C4.343 1 3 2.343 3 4c0 2.625 3 7 3 7s3-4.375 3-7c0-1.657-1.343-3-3-3z"/><circle cx="6" cy="4" r="1"/></svg>
                        Supplier
                    </div>
                    <div class="tl-info-v {{ !$supplierBiz ? 'nil' : '' }}">{{ $supplierBiz ?? '—' }}</div>
                </div>
                <div>
                    <div class="tl-info-k">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="6" cy="6" r="4.5"/><path d="M6 2v8M4.5 4.5h3a1 1 0 010 2H4.5a1 1 0 000 2H7.5"/></svg>
                        Total Price
                    </div>
                    <div class="tl-price-v">₱{{ number_format($price, 2) }}</div>
                </div>
                @if($venue)
                <div>
                    <div class="tl-info-k">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 10V5l4-3 4 3v5M5 10V7h4v3"/></svg>
                        Venue
                    </div>
                    <div class="tl-info-v">{{ $venue }}</div>
                </div>
                @endif
            </div>

        </div>{{-- /tl-body --}}
    </div>{{-- /tl-booking --}}
    @endforeach

    </div>

    @else
    <div class="tl-empty reveal">
        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
            <rect x="8" y="10" width="32" height="30" rx="3"/>
            <path d="M16 20h16M16 27h10M24 4v6M18 4l6 6 6-6"/>
        </svg>
        <div class="tl-empty-title">No bookings yet</div>
        <p class="tl-empty-sub">You haven't made any bookings yet.<br>Browse packages to get started.</p>
    </div>
    @endif

</div>

<script>
    /* ── FILTER TABS ── */
    const tabs  = document.querySelectorAll('.tl-filter-tab');
    const items = document.querySelectorAll('#tlList .tl-booking');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            const f = tab.dataset.filter;
            items.forEach(item => {
                item.style.display = (f === 'all' || item.dataset.status === f) ? '' : 'none';
            });
        });
    });

    /* ── SCROLL REVEAL ── */
    const io = new IntersectionObserver(entries => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 70);
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.05 });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));
</script>

</x-client-layout>