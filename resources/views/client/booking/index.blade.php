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
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    .mb-page { padding: 1.75rem 2rem 4rem; max-width: 1100px; font-family: var(--font-body); }

    /* ── PAGE HEADER ── */
    .mb-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem; }
    .mb-page-title  { font-family: var(--font-display); font-size: clamp(1.3rem,2.5vw,1.8rem); font-weight: 700; color: var(--charcoal); line-height: 1.15; }
    .mb-page-title em { color: var(--gold-dark); font-style: italic; }
    .mb-page-sub    { font-size: 0.78rem; color: var(--warm-grey); margin-top: 0.25rem; }

    /* ── STAT CARDS ── */
    .mb-stat-row { display: grid; grid-template-columns: repeat(4,1fr); gap: 1rem; margin-bottom: 1.5rem; }
    @media(max-width:760px){ .mb-stat-row { grid-template-columns: 1fr 1fr; } }
    .mb-stat-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; padding: 1.1rem 1.25rem; position: relative; overflow: hidden; }
    .mb-stat-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; }
    .mb-stat-card.s-all::before       { background: linear-gradient(90deg,var(--gold),var(--blush-deep)); }
    .mb-stat-card.s-pending::before   { background: #D97706; }
    .mb-stat-card.s-confirmed::before { background: #16A34A; }
    .mb-stat-card.s-cancelled::before { background: #B91C1C; }
    .mb-stat-n { font-family: var(--font-display); font-size: 1.8rem; font-weight: 700; color: var(--gold-dark); line-height: 1; }
    .mb-stat-l { font-size: 0.62rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); margin-top: 3px; }

    /* ── FILTER BAR ── */
    .mb-filter-bar { background: var(--white); border: 1px solid var(--border); border-radius: 4px; padding: 0.75rem 1.1rem; display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.25rem; }
    .mb-filter-label { font-size: 0.62rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); margin-right: 0.25rem; }
    .mb-filter-tab { padding: 0.32rem 0.9rem; border-radius: 2px; border: 1px solid var(--border-md); background: var(--ivory); font-size: 0.72rem; color: var(--warm-grey); cursor: pointer; font-family: var(--font-body); transition: all 0.18s; }
    .mb-filter-tab:hover { border-color: var(--gold); color: var(--gold-dark); }
    .mb-filter-tab.active { background: var(--gold); border-color: var(--gold); color: var(--charcoal); font-weight: 600; }

    /* ── BOOKING CARDS ── */
    .mb-list { display: flex; flex-direction: column; gap: 1rem; }

    .mb-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; overflow: hidden; position: relative; transition: box-shadow 0.22s; }
    .mb-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background: linear-gradient(90deg,var(--gold),var(--blush-deep)); transform: scaleX(0); transform-origin: left; transition: transform 0.32s ease; z-index:1; }
    .mb-card:hover { box-shadow: 0 4px 20px rgba(30,27,24,0.08); }
    .mb-card:hover::before { transform: scaleX(1); }
    .mb-card.st-pending   { border-left: 3px solid #D97706; }
    .mb-card.st-confirmed { border-left: 3px solid #16A34A; }
    .mb-card.st-cancelled { border-left: 3px solid #B91C1C; }

    .mb-card-inner { padding: 1.25rem 1.4rem; }

    /* Card top row */
    .mb-card-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 0.75rem; margin-bottom: 1rem; flex-wrap: wrap; }
    .mb-card-top-l { display: flex; align-items: center; gap: 0.65rem; flex-wrap: wrap; }
    .mb-event-name { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--charcoal); }

    /* Status badge */
    .mb-badge { display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.2rem 0.65rem; border-radius: 2px; font-size: 0.62rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; font-family: var(--font-body); flex-shrink: 0; }
    .mb-badge::before { content:''; width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }
    .mb-badge.pending   { background: rgba(217,119,6,0.1);  color: #92400E; border: 1px solid rgba(217,119,6,0.25); }
    .mb-badge.pending::before   { background: #D97706; }
    .mb-badge.confirmed { background: rgba(22,163,74,0.08); color: #166534; border: 1px solid rgba(22,163,74,0.22); }
    .mb-badge.confirmed::before { background: #16A34A; }
    .mb-badge.cancelled { background: rgba(185,28,28,0.07); color: #991B1B; border: 1px solid rgba(185,28,28,0.2); }
    .mb-badge.cancelled::before { background: #B91C1C; }

    /* Info grid */
    .mb-info-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 0.55rem 1rem; margin-bottom: 0.85rem; }
    @media(max-width:580px){ .mb-info-grid { grid-template-columns: 1fr 1fr; } }
    .mb-info-k { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.09em; text-transform: uppercase; color: #C0B8B0; margin-bottom: 0.18rem; display: flex; align-items: center; gap: 0.25rem; }
    .mb-info-k svg { width: 9px; height: 9px; color: var(--gold-dark); }
    .mb-info-v { font-size: 0.82rem; color: var(--charcoal); font-weight: 500; }
    .mb-info-v.nil { color: #C0B8B0; font-style: italic; font-size: 0.76rem; }

    /* Supplier + Package strip */
    .mb-strips { display: flex; flex-direction: column; gap: 0.5rem; }
    .mb-strip { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; padding: 0.55rem 0.85rem; border-radius: 3px; }
    .mb-strip.pkg-strip { background: rgba(201,168,76,0.05); border: 1px solid rgba(201,168,76,0.18); }
    .mb-strip.sup-strip { background: rgba(30,27,24,0.03); border: 1px solid var(--border); }
    .mb-strip-dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
    .mb-strip.pkg-strip .mb-strip-dot { background: var(--gold); }
    .mb-strip.sup-strip .mb-strip-dot { background: var(--warm-grey); }
    .mb-strip-label { font-size: 0.58rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: #C0B8B0; }
    .mb-strip-value { font-family: var(--font-display); font-size: 0.82rem; font-weight: 600; color: var(--charcoal); }
    .mb-strip-price { font-size: 0.78rem; color: var(--gold-dark); font-weight: 700; margin-left: auto; font-family: var(--font-display); }

    /* ── EMPTY STATE ── */
    .mb-empty { text-align: center; padding: 4.5rem 2rem; background: var(--white); border: 1px solid var(--border); border-radius: 4px; }
    .mb-empty svg { width: 52px; height: 52px; color: var(--gold); opacity: 0.25; margin: 0 auto 1.1rem; display: block; }
    .mb-empty-title { font-family: var(--font-display); font-size: 1.15rem; font-weight: 600; color: var(--charcoal); margin-bottom: 0.35rem; }
    .mb-empty-sub { font-size: 0.83rem; color: var(--warm-grey); line-height: 1.65; }

    .reveal { opacity:0; transform: translateY(12px); transition: opacity 0.45s ease,transform 0.45s ease; }
    .reveal.visible { opacity:1; transform:none; }
    @media(max-width:700px){ .mb-page { padding: 1.25rem 1rem 3rem; } }
</style>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('My Bookings') }}
    </h2>
</x-slot>

<div class="mb-page">

    {{-- Page Header --}}
    <div class="mb-page-header reveal">
        <div>
            <h1 class="mb-page-title">My <em>Bookings</em></h1>
            <p class="mb-page-sub">Track and manage all your event booking requests.</p>
        </div>
    </div>

    {{-- Stat Cards --}}
    @php
        $total     = $bookings->count();
        $pending   = $bookings->where('status','pending')->count();
        $confirmed = $bookings->where('status','confirmed')->count();
        $cancelled = $bookings->where('status','cancelled')->count();
    @endphp

    <div class="mb-stat-row reveal">
        <div class="mb-stat-card s-all">
            <div class="mb-stat-n">{{ $total }}</div>
            <div class="mb-stat-l">Total Bookings</div>
        </div>
        <div class="mb-stat-card s-pending">
            <div class="mb-stat-n">{{ $pending }}</div>
            <div class="mb-stat-l">Pending</div>
        </div>
        <div class="mb-stat-card s-confirmed">
            <div class="mb-stat-n">{{ $confirmed }}</div>
            <div class="mb-stat-l">Confirmed</div>
        </div>
        <div class="mb-stat-card s-cancelled">
            <div class="mb-stat-n">{{ $cancelled }}</div>
            <div class="mb-stat-l">Cancelled</div>
        </div>
    </div>

    {{-- Filter Tabs --}}
    <div class="mb-filter-bar reveal">
        <span class="mb-filter-label">Filter</span>
        <button class="mb-filter-tab active" data-filter="all">All</button>
        <button class="mb-filter-tab" data-filter="pending">Pending</button>
        <button class="mb-filter-tab" data-filter="confirmed">Confirmed</button>
        <button class="mb-filter-tab" data-filter="cancelled">Cancelled</button>
    </div>

    {{-- Booking List --}}
    @if($bookings->count())
    <div class="mb-list" id="mbList">

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
        @endphp

        <div class="mb-card st-{{ $status }} reveal" data-status="{{ $status }}">
            <div class="mb-card-inner">

                {{-- Top row: event name + badge --}}
                <div class="mb-card-top">
                    <div class="mb-card-top-l">
                        <span class="mb-event-name">{{ $eventName }}</span>
                        <span class="mb-badge {{ $status }}">{{ ucfirst($status) }}</span>
                    </div>
                </div>

                {{-- Info grid --}}
                <div class="mb-info-grid">
                    <div>
                        <div class="mb-info-k">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="6" cy="6" r="4.5"/><path d="M6 3v3l2 1"/></svg>
                            Event Type
                        </div>
                        <div class="mb-info-v {{ !$eventType ? 'nil' : '' }}">{{ $eventType ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="mb-info-k">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 1C4.343 1 3 2.343 3 4c0 2.625 3 7 3 7s3-4.375 3-7c0-1.657-1.343-3-3-3z"/><circle cx="6" cy="4" r="1"/></svg>
                            Venue
                        </div>
                        <div class="mb-info-v {{ !$venue ? 'nil' : '' }}">{{ $venue ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="mb-info-k">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="2" width="10" height="9" rx="1.5"/><path d="M4 1v2M8 1v2M1 6h10"/></svg>
                            Event Date
                        </div>
                        <div class="mb-info-v {{ !$eventDate ? 'nil' : '' }}">
                            {{ $eventDate ? \Carbon\Carbon::parse($eventDate)->format('M d, Y') : '—' }}
                        </div>
                    </div>
                </div>

                {{-- Package + Supplier strips --}}
                <div class="mb-strips">

                    @if($pkgName)
                    <div class="mb-strip pkg-strip">
                        <span class="mb-strip-dot"></span>
                        <span class="mb-strip-label">Package</span>
                        <span class="mb-strip-value">{{ $pkgName }}</span>
                        <span class="mb-strip-price">₱{{ number_format($price, 2) }}</span>
                    </div>
                    @endif

                    @if($supplierBiz)
                    <div class="mb-strip sup-strip">
                        <span class="mb-strip-dot"></span>
                        <span class="mb-strip-label">Supplier</span>
                        <span class="mb-strip-value">{{ $supplierBiz }}</span>
                    </div>
                    @endif

                </div>

            </div>
        </div>
        @endforeach

    </div>

    @else
    <div class="mb-empty reveal">
        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
            <rect x="8" y="10" width="32" height="30" rx="3"/>
            <path d="M16 20h16M16 27h10M24 4v6M18 4l6 6 6-6"/>
        </svg>
        <div class="mb-empty-title">No bookings yet</div>
        <p class="mb-empty-sub">You haven't made any bookings yet.<br>Browse packages to get started.</p>
    </div>
    @endif

</div>

<script>
    /* ── FILTER TABS ── */
    const tabs  = document.querySelectorAll('.mb-filter-tab');
    const cards = document.querySelectorAll('#mbList .mb-card');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            const f = tab.dataset.filter;
            cards.forEach(card => {
                card.style.display = (f === 'all' || card.dataset.status === f) ? '' : 'none';
            });
        });
    });

    /* ── SCROLL REVEAL ── */
    const io = new IntersectionObserver(entries => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 60);
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.06 });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));
</script>

</x-client-layout>