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
        --s-ongoing:   #2563EB;
        --s-completed: #6B6560;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    .cl-page { padding: 1.75rem 2rem 4rem; max-width: 860px; font-family: var(--font-body); }

    /* ── PAGE HEADER ── */
    .cl-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem; }
    .cl-page-title  { font-family: var(--font-display); font-size: clamp(1.3rem,2.5vw,1.8rem); font-weight: 700; color: var(--charcoal); line-height: 1.15; }
    .cl-page-title em { color: var(--gold-dark); font-style: italic; }
    .cl-page-sub    { font-size: 0.78rem; color: var(--warm-grey); margin-top: 0.25rem; }

    /* ── STAT CARDS ── */
    .cl-stat-row { display: grid; grid-template-columns: repeat(4,1fr); gap: 0.85rem; margin-bottom: 1.5rem; }
    @media(max-width:640px){ .cl-stat-row { grid-template-columns: 1fr 1fr; } }
    .cl-stat-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; padding: 1rem 1.1rem; position: relative; overflow: hidden; }
    .cl-stat-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; }
    .cl-stat-card.s-all::before       { background: linear-gradient(90deg,var(--gold),var(--blush-deep)); }
    .cl-stat-card.s-pending::before   { background: var(--s-pending); }
    .cl-stat-card.s-confirmed::before { background: var(--s-confirmed); }
    .cl-stat-card.s-cancelled::before { background: var(--s-cancelled); }
    .cl-stat-n { font-family: var(--font-display); font-size: 1.65rem; font-weight: 700; color: var(--gold-dark); line-height: 1; }
    .cl-stat-l { font-size: 0.6rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); margin-top: 3px; }

    /* ── FILTER BAR ── */
    .cl-filter-bar { background: var(--white); border: 1px solid var(--border); border-radius: 4px; padding: 0.75rem 1.1rem; display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.5rem; }
    .cl-filter-label { font-size: 0.62rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); margin-right: 0.25rem; }
    .cl-filter-tab { padding: 0.32rem 0.9rem; border-radius: 2px; border: 1px solid var(--border-md); background: var(--ivory); font-size: 0.72rem; color: var(--warm-grey); cursor: pointer; font-family: var(--font-body); transition: all 0.18s; }
    .cl-filter-tab:hover { border-color: var(--gold); color: var(--gold-dark); }
    .cl-filter-tab.active { background: var(--gold); border-color: var(--gold); color: var(--charcoal); font-weight: 600; }

    /* ── BOOKING BLOCK ── */
    .cl-booking { margin-bottom: 1.5rem; }

    /* ── BOOKING HEADER ── */
    .cl-booking-header {
        background: var(--charcoal); border-radius: 4px 4px 0 0;
        padding: 1rem 1.35rem;
        display: flex; align-items: flex-start; justify-content: space-between;
        gap: 0.75rem; flex-wrap: wrap;
        position: relative; overflow: hidden;
    }
    .cl-booking-header::before { content:''; position:absolute; inset:0; background-image:radial-gradient(rgba(201,168,76,0.06) 1px,transparent 1px); background-size:18px 18px; pointer-events:none; }
    .cl-booking-header::after  { content:''; position:absolute; bottom:0; left:0; right:0; height:1.5px; background:linear-gradient(90deg,transparent,var(--gold),transparent); }
    .cl-bh-l { position:relative; z-index:1; flex:1; min-width:0; }
    .cl-bh-r { position:relative; z-index:1; display:flex; flex-direction:column; align-items:flex-end; gap:0.35rem; flex-shrink:0; }
    .cl-event-name { font-family:var(--font-display); font-size:1rem; font-weight:700; color:var(--white); }
    .cl-header-meta { display:flex; align-items:center; gap:0.75rem; flex-wrap:wrap; margin-top:0.3rem; }
    .cl-meta-chip { display:inline-flex; align-items:center; gap:0.3rem; font-size:0.68rem; color:rgba(255,255,255,0.52); }
    .cl-meta-chip svg { width:10px; height:10px; color:var(--gold); }
    .cl-booking-id { font-size:0.6rem; color:rgba(255,255,255,0.28); font-family:var(--font-body); }

    /* Status badge */
    .cl-badge { display:inline-flex; align-items:center; gap:0.3rem; padding:0.22rem 0.7rem; border-radius:2px; font-size:0.62rem; font-weight:700; letter-spacing:0.06em; text-transform:uppercase; font-family:var(--font-body); }
    .cl-badge::before { content:''; width:5px; height:5px; border-radius:50%; flex-shrink:0; }
    .cl-badge.pending   { background:rgba(217,119,6,0.18);  color:#FDE68A; border:1px solid rgba(217,119,6,0.4); }
    .cl-badge.pending::before   { background:#D97706; }
    .cl-badge.confirmed { background:rgba(22,163,74,0.15);  color:#A7F3D0; border:1px solid rgba(22,163,74,0.35); }
    .cl-badge.confirmed::before { background:#16A34A; }
    .cl-badge.cancelled { background:rgba(185,28,28,0.15);  color:#FECACA; border:1px solid rgba(185,28,28,0.35); }
    .cl-badge.cancelled::before { background:#EF4444; }
    .cl-badge.completed { background:rgba(107,101,96,0.25); color:#D4CFC9; border:1px solid rgba(107,101,96,0.4); }
    .cl-badge.completed::before { background:#9CA3AF; }

    /* Event status badge */
    .ev-badge { display:inline-flex; align-items:center; gap:0.3rem; padding:0.22rem 0.65rem; border-radius:2px; font-size:0.6rem; font-weight:700; letter-spacing:0.05em; text-transform:uppercase; font-family:var(--font-body); }
    .ev-badge::before { content:''; width:4px; height:4px; border-radius:50%; }
    .ev-badge.upcoming  { background:rgba(217,119,6,0.12);  color:#FDE68A; border:1px solid rgba(217,119,6,0.3); }
    .ev-badge.upcoming::before  { background:#D97706; }
    .ev-badge.ongoing   { background:rgba(37,99,235,0.15);  color:#BFDBFE; border:1px solid rgba(37,99,235,0.3); }
    .ev-badge.ongoing::before   { background:#3B82F6; }
    .ev-badge.completed { background:rgba(107,101,96,0.2);  color:#D4CFC9; border:1px solid rgba(107,101,96,0.35); }
    .ev-badge.completed::before { background:#9CA3AF; }

    /* ── BODY GRID ── */
    .cl-body { background:var(--white); border:1px solid var(--border); border-top:none; border-radius:0 0 4px 4px; display:grid; grid-template-columns:1fr 1fr; }
    @media(max-width:620px){ .cl-body { grid-template-columns:1fr; } }

    /* Left — timeline */
    .cl-body-left { padding:1.35rem 1.5rem; border-right:1px solid var(--border); }
    @media(max-width:620px){ .cl-body-left { border-right:none; border-bottom:1px solid var(--border); } }

    .cl-tl-label { font-size:0.6rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#C0B8B0; margin-bottom:1rem; display:flex; align-items:center; gap:0.4rem; }
    .cl-tl-label svg { width:10px; height:10px; color:var(--gold-dark); }

    /* Track */
    .cl-track { position:relative; padding-left:1.85rem; }
    .cl-track::before { content:''; position:absolute; left:9px; top:5px; bottom:5px; width:2px; background:var(--border); }

    .cl-step { position:relative; padding-bottom:1.1rem; }
    .cl-step:last-child { padding-bottom:0; }
    .cl-step::before { content:''; position:absolute; left:-1.85rem; top:4px; width:13px; height:13px; border-radius:50%; background:var(--border-md); border:2px solid var(--white); box-shadow:0 0 0 2px var(--border-md); z-index:1; transition:all 0.2s; }
    .cl-step.step-done::before     { background:var(--s-confirmed); box-shadow:0 0 0 3px rgba(22,163,74,0.18); }
    .cl-step.step-active::before   { background:var(--gold);        box-shadow:0 0 0 3px rgba(201,168,76,0.22); }
    .cl-step.step-cancelled::before{ background:var(--s-cancelled); box-shadow:0 0 0 3px rgba(185,28,28,0.18); }
    .cl-step.step-ongoing::before  { background:var(--s-ongoing);   box-shadow:0 0 0 3px rgba(37,99,235,0.18); }
    .cl-step.step-grey::before     { background:#9CA3AF;             box-shadow:0 0 0 2px rgba(156,163,175,0.2); }
    .cl-step.step-waiting::before  { background:var(--border-md);   box-shadow:0 0 0 2px var(--border); }

    .cl-step-card { background:var(--ivory); border:1px solid var(--border); border-radius:4px; padding:0.65rem 0.9rem; }
    .cl-step.step-done     .cl-step-card { border-color:rgba(22,163,74,0.22);  background:rgba(22,163,74,0.03); }
    .cl-step.step-active   .cl-step-card { border-color:rgba(201,168,76,0.28); background:rgba(201,168,76,0.04); }
    .cl-step.step-cancelled .cl-step-card{ border-color:rgba(185,28,28,0.18);  background:rgba(185,28,28,0.03); }
    .cl-step.step-ongoing  .cl-step-card { border-color:rgba(37,99,235,0.2);   background:rgba(37,99,235,0.03); }
    .cl-step.step-grey     .cl-step-card { border-color:rgba(156,163,175,0.2); background:rgba(156,163,175,0.03); }

    .cl-step-title { font-size:0.76rem; font-weight:700; color:var(--charcoal); display:flex; align-items:center; gap:0.38rem; margin-bottom:0.15rem; }
    .cl-step-title svg { width:12px; height:12px; flex-shrink:0; }
    .icon-done      { color:var(--s-confirmed); }
    .icon-active    { color:var(--gold-dark); }
    .icon-cancelled { color:var(--s-cancelled); }
    .icon-waiting   { color:#C0B8B0; }
    .icon-ongoing   { color:var(--s-ongoing); }
    .icon-grey      { color:#9CA3AF; }
    .cl-step-sub { font-size:0.7rem; color:var(--warm-grey); line-height:1.45; }

    /* Right — details */
    .cl-body-right { padding:1.35rem 1.5rem; }
    .cl-detail-label { font-size:0.6rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#C0B8B0; margin-bottom:1rem; display:flex; align-items:center; gap:0.4rem; }
    .cl-detail-label svg { width:10px; height:10px; color:var(--gold-dark); }

    .cl-detail-grid { display:flex; flex-direction:column; gap:0.7rem; }
    .cl-detail-k { font-size:0.6rem; font-weight:700; letter-spacing:0.09em; text-transform:uppercase; color:#C0B8B0; margin-bottom:0.18rem; display:flex; align-items:center; gap:0.25rem; }
    .cl-detail-k svg { width:9px; height:9px; color:var(--gold-dark); }
    .cl-detail-v { font-size:0.82rem; color:var(--charcoal); font-weight:500; }
    .cl-detail-v.nil { color:#C0B8B0; font-style:italic; font-size:0.76rem; }
    .cl-price-v { font-family:var(--font-display); font-size:1rem; font-weight:700; color:var(--gold-dark); }

    /* Supplier strip */
    .cl-supplier-strip { display:flex; align-items:center; gap:0.45rem; padding:0.5rem 0.75rem; background:rgba(201,168,76,0.05); border:1px solid rgba(201,168,76,0.18); border-radius:3px; }
    .cl-supplier-dot { width:6px; height:6px; border-radius:50%; background:var(--gold); flex-shrink:0; }
    .cl-supplier-name { font-family:var(--font-display); font-size:0.82rem; font-weight:600; color:var(--charcoal); }

    /* Status row */
    .cl-status-row { display:flex; align-items:center; gap:0.4rem; flex-wrap:wrap; }

    /* ── EMPTY STATE ── */
    .cl-empty { text-align:center; padding:4.5rem 2rem; background:var(--white); border:1px solid var(--border); border-radius:4px; }
    .cl-empty svg { width:52px; height:52px; color:var(--gold); opacity:0.25; margin:0 auto 1.1rem; display:block; }
    .cl-empty-title { font-family:var(--font-display); font-size:1.15rem; font-weight:600; color:var(--charcoal); margin-bottom:0.35rem; }
    .cl-empty-sub { font-size:0.83rem; color:var(--warm-grey); line-height:1.65; }

    .reveal { opacity:0; transform:translateY(12px); transition:opacity .45s ease,transform .45s ease; }
    .reveal.visible { opacity:1; transform:none; }
    @media(max-width:700px){ .cl-page { padding:1.25rem 1rem 3rem; } }
</style>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('My Booking Timeline') }}
    </h2>
</x-slot>

<div class="cl-page">

    {{-- Page Header --}}
    <div class="cl-page-header reveal">
        <div>
            <h1 class="cl-page-title">My Booking <em>Timeline</em></h1>
            <p class="cl-page-sub">Track the real-time progress of all your event bookings.</p>
        </div>
    </div>

    {{-- Stat Cards --}}
    @php
        $total     = $bookings->count();
        $pending   = $bookings->where('status','pending')->count();
        $confirmed = $bookings->where('status','confirmed')->count();
        $cancelled = $bookings->where('status','cancelled')->count();
    @endphp

    <div class="cl-stat-row reveal">
        <div class="cl-stat-card s-all">
            <div class="cl-stat-n">{{ $total }}</div>
            <div class="cl-stat-l">Total</div>
        </div>
        <div class="cl-stat-card s-pending">
            <div class="cl-stat-n">{{ $pending }}</div>
            <div class="cl-stat-l">Pending</div>
        </div>
        <div class="cl-stat-card s-confirmed">
            <div class="cl-stat-n">{{ $confirmed }}</div>
            <div class="cl-stat-l">Confirmed</div>
        </div>
        <div class="cl-stat-card s-cancelled">
            <div class="cl-stat-n">{{ $cancelled }}</div>
            <div class="cl-stat-l">Cancelled</div>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="cl-filter-bar reveal">
        <span class="cl-filter-label">Filter</span>
        <button class="cl-filter-tab active" data-filter="all">All</button>
        <button class="cl-filter-tab" data-filter="pending">Pending</button>
        <button class="cl-filter-tab" data-filter="confirmed">Confirmed</button>
        <button class="cl-filter-tab" data-filter="cancelled">Cancelled</button>
        <button class="cl-filter-tab" data-filter="completed">Completed</button>
    </div>

    {{-- Bookings --}}
    @if($bookings->count())
    <div id="clList">

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

        // Auto event status
        $eventCarbon = $eventDate ? \Carbon\Carbon::parse($eventDate) : null;
        $eventStatus = 'upcoming';
        if ($eventCarbon) {
            if ($eventCarbon->isToday())    $eventStatus = 'ongoing';
            elseif ($eventCarbon->isPast()) $eventStatus = 'completed';
        }

        // Composite display status for filter
        $displayStatus = $status;
        if ($status === 'confirmed' && $eventStatus === 'completed') $displayStatus = 'completed';

        // Timeline dot classes
        $stepPlaced  = 'step-done';
        $stepConfirm = match($status) {
            'confirmed' => 'step-done',
            'cancelled' => 'step-cancelled',
            default     => 'step-waiting',
        };
        $stepEvent = match(true) {
            $status === 'cancelled'      => 'step-waiting',
            $eventStatus === 'ongoing'   => 'step-ongoing',
            $eventStatus === 'completed' => 'step-grey',
            $status === 'confirmed'      => 'step-active',
            default                      => 'step-waiting',
        };
    @endphp

    <div class="cl-booking reveal" data-status="{{ $displayStatus }}">

        {{-- Header --}}
        <div class="cl-booking-header">
            <div class="cl-bh-l">
                <div class="cl-event-name">{{ $eventName }}</div>
                <div class="cl-header-meta">
                    @if($eventType)
                    <span class="cl-meta-chip">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="6" cy="6" r="4.5"/><path d="M6 3v3l2 1"/></svg>
                        {{ $eventType }}
                    </span>
                    @endif
                    <span class="cl-meta-chip">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="2" width="10" height="9" rx="1.5"/><path d="M4 1v2M8 1v2M1 6h10"/></svg>
                        {{ $formattedDate }}
                    </span>
                </div>
            </div>
            <div class="cl-bh-r">
                <div class="cl-status-row">
                    <span class="cl-badge {{ $status }}">{{ ucfirst($status) }}</span>
                    <span class="ev-badge {{ $eventStatus }}">{{ ucfirst($eventStatus) }}</span>
                </div>
                <span class="cl-booking-id">Booking #{{ $booking->id }}</span>
            </div>
        </div>

        {{-- Body --}}
        <div class="cl-body">

            {{-- LEFT — Timeline --}}
            <div class="cl-body-left">
                <div class="cl-tl-label">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 1v6l3 2"/><circle cx="7" cy="7" r="6"/></svg>
                    Progress Timeline
                </div>
                <div class="cl-track">

                    {{-- Step 1: Booking Placed --}}
                    <div class="cl-step {{ $stepPlaced }}">
                        <div class="cl-step-card">
                            <div class="cl-step-title">
                                <svg class="icon-done" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M2 7l3 3 7-6"/></svg>
                                Booking Placed
                            </div>
                            <div class="cl-step-sub">{{ $placedAt }}</div>
                        </div>
                    </div>

                    {{-- Step 2: Supplier Response --}}
                    <div class="cl-step {{ $stepConfirm }}">
                        <div class="cl-step-card">
                            <div class="cl-step-title">
                                @if($status === 'confirmed')
                                    <svg class="icon-done" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M2 7l3 3 7-6"/></svg>
                                @elseif($status === 'cancelled')
                                    <svg class="icon-cancelled" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 3l8 8M11 3l-8 8"/></svg>
                                @else
                                    <svg class="icon-waiting" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="5.5"/><path d="M7 4v3l2 1.5"/></svg>
                                @endif
                                Supplier Response
                            </div>
                            <div class="cl-step-sub">
                                @if($status === 'pending')   Waiting for supplier…
                                @elseif($status === 'confirmed') Supplier confirmed your booking
                                @else Booking was cancelled
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Step 3: Event Day --}}
                    <div class="cl-step {{ $stepEvent }}">
                        <div class="cl-step-card">
                            <div class="cl-step-title">
                                @if($eventStatus === 'ongoing')
                                    <svg class="icon-ongoing" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="5.5"/><circle cx="7" cy="7" r="2"/></svg>
                                @elseif($eventStatus === 'completed')
                                    <svg class="icon-grey" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 7l3 3 7-6"/></svg>
                                @elseif($status === 'confirmed')
                                    <svg class="icon-active" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="2" width="12" height="11" rx="2"/><path d="M1 6h12M5 2v2M9 2v2"/></svg>
                                @else
                                    <svg class="icon-waiting" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="2" width="12" height="11" rx="2"/><path d="M1 6h12M5 2v2M9 2v2"/></svg>
                                @endif
                                Event Day
                            </div>
                            <div class="cl-step-sub">
                                @if($eventStatus === 'upcoming' && $status === 'confirmed')
                                    Scheduled for {{ $formattedDate }}
                                @elseif($eventStatus === 'upcoming')
                                    {{ $formattedDate }}
                                @elseif($eventStatus === 'ongoing')
                                    Happening today! · {{ $formattedDate }}
                                @else
                                    Completed · {{ $formattedDate }}
                                @endif
                            </div>
                        </div>
                    </div>

                </div>{{-- /cl-track --}}
            </div>

            {{-- RIGHT — Details --}}
            <div class="cl-body-right">
                <div class="cl-detail-label">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="10" height="10" rx="2"/><path d="M5 5h4M5 7.5h3M5 10h2"/></svg>
                    Booking Details
                </div>
                <div class="cl-detail-grid">

                    {{-- Package --}}
                    <div>
                        <div class="cl-detail-k">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="2" width="10" height="9" rx="1.5"/><path d="M3 5h6M3 7.5h4"/></svg>
                            Package
                        </div>
                        <div class="cl-detail-v {{ !$pkgName ? 'nil' : '' }}">{{ $pkgName ?? '—' }}</div>
                    </div>

                    {{-- Supplier --}}
                    @if($supplierBiz)
                    <div>
                        <div class="cl-detail-k">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 10V6l5-4 5 4v4M4 10V7h4v3"/></svg>
                            Supplier
                        </div>
                        <div class="cl-supplier-strip">
                            <span class="cl-supplier-dot"></span>
                            <span class="cl-supplier-name">{{ $supplierBiz }}</span>
                        </div>
                    </div>
                    @endif

                    {{-- Price --}}
                    <div>
                        <div class="cl-detail-k">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="6" cy="6" r="4.5"/><path d="M6 2v8M4.5 4.5h3a1 1 0 010 2H4.5a1 1 0 000 2H7.5"/></svg>
                            Total Price
                        </div>
                        <div class="cl-price-v">₱{{ number_format($price, 2) }}</div>
                    </div>

                    {{-- Venue --}}
                    @if($venue)
                    <div>
                        <div class="cl-detail-k">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 1C4.343 1 3 2.343 3 4c0 2.625 3 7 3 7s3-4.375 3-7c0-1.657-1.343-3-3-3z"/><circle cx="6" cy="4" r="1"/></svg>
                            Venue
                        </div>
                        <div class="cl-detail-v">{{ $venue }}</div>
                    </div>
                    @endif

                </div>
            </div>

        </div>{{-- /cl-body --}}
    </div>{{-- /cl-booking --}}
    @endforeach

    </div>

    @else
    <div class="cl-empty reveal">
        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
            <rect x="8" y="10" width="32" height="30" rx="3"/>
            <path d="M16 20h16M16 27h10M24 4v6M18 4l6 6 6-6"/>
        </svg>
        <div class="cl-empty-title">No bookings yet</div>
        <p class="cl-empty-sub">You haven't made any bookings yet.<br>Browse packages to get started.</p>
    </div>
    @endif

</div>

<script>
    /* ── FILTER TABS ── */
    const tabs  = document.querySelectorAll('.cl-filter-tab');
    const items = document.querySelectorAll('#clList .cl-booking');

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
                setTimeout(() => e.target.classList.add('visible'), i * 65);
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.05 });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));
</script>

</x-client-layout>