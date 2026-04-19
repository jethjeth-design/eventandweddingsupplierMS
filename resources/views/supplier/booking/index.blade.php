<x-supplier-layout>

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

    .bk-page { padding: 1.75rem 2rem 4rem; max-width: 1100px; font-family: var(--font-body); }

    /* ── PAGE HEADER ── */
    .bk-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem; }
    .bk-page-title  { font-family: var(--font-display); font-size: clamp(1.3rem,2.5vw,1.8rem); font-weight: 700; color: var(--charcoal); line-height: 1.15; }
    .bk-page-title em { color: var(--gold-dark); font-style: italic; }
    .bk-page-sub    { font-size: 0.78rem; color: var(--warm-grey); margin-top: 0.25rem; }

    /* ── STAT CARDS ── */
    .bk-stat-row { display: grid; grid-template-columns: repeat(4,1fr); gap: 1rem; margin-bottom: 1.5rem; }
    @media(max-width:760px){ .bk-stat-row { grid-template-columns: 1fr 1fr; } }
    .bk-stat-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; padding: 1.1rem 1.25rem; position: relative; overflow: hidden; }
    .bk-stat-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; }
    .bk-stat-card.s-all::before     { background: linear-gradient(90deg,var(--gold),var(--blush-deep)); }
    .bk-stat-card.s-pending::before { background: #D97706; }
    .bk-stat-card.s-confirmed::before { background: #16A34A; }
    .bk-stat-card.s-cancelled::before { background: #B91C1C; }
    .bk-stat-n { font-family: var(--font-display); font-size: 1.8rem; font-weight: 700; color: var(--gold-dark); line-height: 1; }
    .bk-stat-l { font-size: 0.62rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); margin-top: 3px; }

    /* ── FILTER BAR ── */
    .bk-filter-bar { background: var(--white); border: 1px solid var(--border); border-radius: 4px; padding: 0.75rem 1.1rem; display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.25rem; }
    .bk-filter-label { font-size: 0.62rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); margin-right: 0.25rem; }
    .bk-filter-tab { padding: 0.32rem 0.9rem; border-radius: 2px; border: 1px solid var(--border-md); background: var(--ivory); font-size: 0.72rem; color: var(--warm-grey); cursor: pointer; font-family: var(--font-body); transition: all 0.18s; }
    .bk-filter-tab:hover { border-color: var(--gold); color: var(--gold-dark); }
    .bk-filter-tab.active { background: var(--gold); border-color: var(--gold); color: var(--charcoal); font-weight: 600; }

    /* ── BOOKING CARDS ── */
    .bk-list { display: flex; flex-direction: column; gap: 1rem; }

    .bk-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; overflow: hidden; position: relative; transition: box-shadow 0.22s; }
    .bk-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background: linear-gradient(90deg,var(--gold),var(--blush-deep)); transform: scaleX(0); transform-origin: left; transition: transform 0.32s ease; }
    .bk-card:hover { box-shadow: 0 4px 20px rgba(30,27,24,0.08); }
    .bk-card:hover::before { transform: scaleX(1); }

    /* Status left border accent */
    .bk-card.st-pending   { border-left: 3px solid #D97706; }
    .bk-card.st-confirmed { border-left: 3px solid #16A34A; }
    .bk-card.st-cancelled { border-left: 3px solid #B91C1C; }

    .bk-card-inner { padding: 1.25rem 1.4rem; display: grid; grid-template-columns: 1fr auto; gap: 1rem; align-items: start; }
    @media(max-width:600px){ .bk-card-inner { grid-template-columns: 1fr; } }

    /* Left column */
    .bk-card-left {}
    .bk-card-top { display: flex; align-items: center; gap: 0.65rem; margin-bottom: 0.65rem; flex-wrap: wrap; }
    .bk-event-name { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--charcoal); }

    /* Status badge */
    .bk-badge { display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.2rem 0.65rem; border-radius: 2px; font-size: 0.62rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; font-family: var(--font-body); }
    .bk-badge::before { content:''; width: 5px; height: 5px; border-radius: 50%; }
    .bk-badge.pending   { background: rgba(217,119,6,0.1);  color: #92400E; border: 1px solid rgba(217,119,6,0.25); }
    .bk-badge.pending::before   { background: #D97706; }
    .bk-badge.confirmed { background: rgba(22,163,74,0.08); color: #166534; border: 1px solid rgba(22,163,74,0.22); }
    .bk-badge.confirmed::before { background: #16A34A; }
    .bk-badge.cancelled { background: rgba(185,28,28,0.07); color: #991B1B; border: 1px solid rgba(185,28,28,0.2); }
    .bk-badge.cancelled::before { background: #B91C1C; }

    /* Info grid */
    .bk-info-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 0.55rem 1rem; margin-bottom: 0.85rem; }
    @media(max-width:580px){ .bk-info-grid { grid-template-columns: 1fr 1fr; } }
    .bk-info-item {}
    .bk-info-k { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.09em; text-transform: uppercase; color: #C0B8B0; margin-bottom: 0.18rem; display: flex; align-items: center; gap: 0.25rem; }
    .bk-info-k svg { width: 9px; height: 9px; color: var(--gold-dark); }
    .bk-info-v { font-size: 0.82rem; color: var(--charcoal); font-weight: 500; }
    .bk-info-v.nil { color: #C0B8B0; font-style: italic; font-size: 0.76rem; }

    /* Package strip */
    .bk-pkg-strip { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; padding: 0.55rem 0.85rem; background: rgba(201,168,76,0.05); border: 1px solid rgba(201,168,76,0.18); border-radius: 3px; }
    .bk-pkg-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--gold); flex-shrink: 0; }
    .bk-pkg-name { font-family: var(--font-display); font-size: 0.82rem; font-weight: 600; color: var(--charcoal); }
    .bk-pkg-price { font-size: 0.75rem; color: var(--gold-dark); font-weight: 700; margin-left: auto; font-family: var(--font-display); }
    .bk-pkg-date { font-size: 0.68rem; color: var(--warm-grey); display: flex; align-items: center; gap: 0.25rem; }
    .bk-pkg-date svg { width: 10px; height: 10px; color: var(--gold-dark); }

    /* Right column — actions */
    .bk-card-right { display: flex; flex-direction: column; gap: 0.45rem; align-items: flex-end; min-width: 120px; }
    .bk-btn-approve { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.52rem 1rem; border-radius: 3px; border: none; background: var(--gold); color: var(--charcoal); font-size: 0.72rem; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase; cursor: pointer; font-family: var(--font-body); transition: background 0.18s,transform 0.15s; white-space: nowrap; width: 100%; justify-content: center; }
    .bk-btn-approve:hover { background: var(--gold-light); transform: translateY(-1px); }
    .bk-btn-approve svg { width: 12px; height: 12px; }
    .bk-btn-reject { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.5rem 1rem; border-radius: 3px; border: 1px solid #FCA5A5; background: transparent; color: #B91C1C; font-size: 0.72rem; font-weight: 500; letter-spacing: 0.04em; text-transform: uppercase; cursor: pointer; font-family: var(--font-body); transition: background 0.18s; white-space: nowrap; width: 100%; justify-content: center; }
    .bk-btn-reject:hover { background: #FEF2F2; }
    .bk-btn-reject svg { width: 12px; height: 12px; }

    /* ── EMPTY STATE ── */
    .bk-empty { text-align: center; padding: 4.5rem 2rem; background: var(--white); border: 1px solid var(--border); border-radius: 4px; }
    .bk-empty svg { width: 52px; height: 52px; color: var(--gold); opacity: 0.25; margin: 0 auto 1.1rem; display: block; }
    .bk-empty-title { font-family: var(--font-display); font-size: 1.15rem; font-weight: 600; color: var(--charcoal); margin-bottom: 0.35rem; }
    .bk-empty-sub { font-size: 0.83rem; color: var(--warm-grey); line-height: 1.65; }

    /* ── SUCCESS ALERT ── */
    .bk-alert { display: none; align-items: center; gap: 0.6rem; padding: 0.75rem 1.1rem; border-radius: 4px; font-size: 0.82rem; margin-bottom: 1.25rem; background: #F0FDF4; color: #15803D; border: 1px solid #BBF7D0; }
    .bk-alert.show { display: flex; }
    .bk-alert svg { width: 16px; height: 16px; flex-shrink: 0; }

    .reveal { opacity:0; transform: translateY(12px); transition: opacity 0.45s ease,transform 0.45s ease; }
    .reveal.visible { opacity:1; transform:none; }
    @media(max-width:700px){ .bk-page { padding: 1.25rem 1rem 3rem; } }
</style>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Booking Requests') }}
    </h2>
</x-slot>

<div class="bk-page">

    @if(session('success'))
    <div class="bk-alert show">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Page Header --}}
    <div class="bk-page-header reveal">
        <div>
            <h1 class="bk-page-title">Booking <em>Requests</em></h1>
            <p class="bk-page-sub">Manage and respond to client booking requests.</p>
        </div>
    </div>

    {{-- Stat Cards --}}
    @php
        $total     = $bookings->count();
        $pending   = $bookings->where('status','pending')->count();
        $confirmed = $bookings->where('status','confirmed')->count();
        $cancelled = $bookings->where('status','cancelled')->count();
    @endphp

    <div class="bk-stat-row reveal">
        <div class="bk-stat-card s-all">
            <div class="bk-stat-n">{{ $total }}</div>
            <div class="bk-stat-l">Total</div>
        </div>
        <div class="bk-stat-card s-pending">
            <div class="bk-stat-n">{{ $pending }}</div>
            <div class="bk-stat-l">Pending</div>
        </div>
        <div class="bk-stat-card s-confirmed">
            <div class="bk-stat-n">{{ $confirmed }}</div>
            <div class="bk-stat-l">Confirmed</div>
        </div>
        <div class="bk-stat-card s-cancelled">
            <div class="bk-stat-n">{{ $cancelled }}</div>
            <div class="bk-stat-l">Cancelled</div>
        </div>
    </div>

    {{-- Filter Tabs --}}
    <div class="bk-filter-bar reveal">
        <span class="bk-filter-label">Filter</span>
        <button class="bk-filter-tab active" data-filter="all">All</button>
        <button class="bk-filter-tab" data-filter="pending">Pending</button>
        <button class="bk-filter-tab" data-filter="confirmed">Confirmed</button>
        <button class="bk-filter-tab" data-filter="cancelled">Cancelled</button>
    </div>

    {{-- Booking List --}}
    @if($bookings->count())
    <div class="bk-list" id="bkList">

        @foreach($bookings as $booking)
        @php
            $status    = $booking->status ?? 'pending';
            $eventName = $booking->event->event_name ?? 'No Event';
            $eventType = $booking->event->event_type ?? null;
            $venue     = $booking->event->venue ?? null;
            $guests    = $booking->event->guest_count ?? null;
            $budget    = $booking->event->budget ?? null;
            $pkgName   = $booking->package->name ?? null;
            $price     = $booking->total_price ?? 0;
            $eventDate = $booking->event_date ?? null;
        @endphp

        <div class="bk-card st-{{ $status }} reveal" data-status="{{ $status }}">
            <div class="bk-card-inner">

                {{-- LEFT --}}
                <div class="bk-card-left">

                    <div class="bk-card-top">
                        <span class="bk-event-name">{{ $eventName }}</span>
                        <span class="bk-badge {{ $status }}">{{ ucfirst($status) }}</span>
                    </div>

                    {{-- Info grid --}}
                    <div class="bk-info-grid">
                        <div class="bk-info-item">
                            <div class="bk-info-k">
                                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="6" cy="6" r="4.5"/><path d="M6 3v3l2 1"/></svg>
                                Event Type
                            </div>
                            <div class="bk-info-v {{ !$eventType ? 'nil' : '' }}">{{ $eventType ?? '—' }}</div>
                        </div>
                        <div class="bk-info-item">
                            <div class="bk-info-k">
                                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 1C4.343 1 3 2.343 3 4c0 2.625 3 7 3 7s3-4.375 3-7c0-1.657-1.343-3-3-3z"/><circle cx="6" cy="4" r="1"/></svg>
                                Venue
                            </div>
                            <div class="bk-info-v {{ !$venue ? 'nil' : '' }}">{{ $venue ?? '—' }}</div>
                        </div>
                        <div class="bk-info-item">
                            <div class="bk-info-k">
                                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 10v-1a3 3 0 00-3-3H3a3 3 0 00-3 3v1"/><circle cx="4.5" cy="4" r="2.5"/><path d="M12 10v-1a3 3 0 00-2-2.83M8 1.17a3 3 0 010 5.66"/></svg>
                                Guests
                            </div>
                            <div class="bk-info-v {{ !$guests ? 'nil' : '' }}">{{ $guests ? number_format($guests) : '—' }}</div>
                        </div>
                        <div class="bk-info-item">
                            <div class="bk-info-k">
                                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="6" cy="6" r="4.5"/><path d="M6 2v8M4 4.5h3a1 1 0 010 2H4.5a1 1 0 000 2H8"/></svg>
                                Budget
                            </div>
                            <div class="bk-info-v {{ !$budget ? 'nil' : '' }}">{{ $budget ? '₱'.number_format($budget) : '—' }}</div>
                        </div>
                        <div class="bk-info-item">
                            <div class="bk-info-k">
                                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="2" width="10" height="9" rx="1.5"/><path d="M4 1v2M8 1v2M1 6h10"/></svg>
                                Event Date
                            </div>
                            <div class="bk-info-v {{ !$eventDate ? 'nil' : '' }}">
                                {{ $eventDate ? \Carbon\Carbon::parse($eventDate)->format('M d, Y') : '—' }}
                            </div>
                        </div>
                    </div>

                    {{-- Package strip --}}
                    @if($pkgName)
                    <div class="bk-pkg-strip">
                        <span class="bk-pkg-dot"></span>
                        <span class="bk-pkg-name">{{ $pkgName }}</span>
                        <span class="bk-pkg-price">₱{{ number_format($price, 2) }}</span>
                    </div>
                    @endif

                </div>{{-- /left --}}

                {{-- RIGHT — Actions --}}
                <div class="bk-card-right">
                    @if($status === 'pending')

                        <form method="POST" action="{{ route('supplier.bookings.approve', $booking->id) }}">
                            @csrf
                            <button type="submit" class="bk-btn-approve">
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M2 7l3.5 3.5L12 3"/></svg>
                                Approve
                            </button>
                        </form>

                        <form method="POST" action="{{ route('supplier.bookings.cancel', $booking->id) }}"
                              onsubmit="return confirm('Reject this booking request?')">
                            @csrf
                            <button type="submit" class="bk-btn-reject">
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 3l8 8M11 3l-8 8"/></svg>
                                Reject
                            </button>
                        </form>

                    @elseif($status === 'confirmed')
                        <span class="bk-badge confirmed" style="font-size:0.7rem;">
                            Confirmed
                        </span>

                    @elseif($status === 'cancelled')
                        <span class="bk-badge cancelled" style="font-size:0.7rem;">
                            Cancelled
                        </span>
                    @endif
                </div>

            </div>
        </div>
        @endforeach

    </div>

    @else
    <div class="bk-empty reveal">
        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
            <rect x="8" y="10" width="32" height="30" rx="3"/>
            <path d="M16 20h16M16 27h10M24 4v6M18 4l6 6 6-6"/>
        </svg>
        <div class="bk-empty-title">No booking requests yet</div>
        <p class="bk-empty-sub">When clients book your services, requests will appear here.</p>
    </div>
    @endif

</div>

<script>
    /* ── FILTER TABS ── */
    const tabs  = document.querySelectorAll('.bk-filter-tab');
    const cards = document.querySelectorAll('#bkList .bk-card');

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

</x-supplier-layout>