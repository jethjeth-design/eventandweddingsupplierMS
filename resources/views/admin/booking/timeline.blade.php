<x-app-layout>

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
        --s-upcoming:  #D97706;
        --s-ongoing:   #2563EB;
        --s-completed: #6B6560;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    .adm-page { padding: 1.75rem 2rem 4rem; max-width: 1040px; font-family: var(--font-body); }

    /* ── PAGE HEADER ── */
    .adm-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem; }
    .adm-page-title  { font-family: var(--font-display); font-size: clamp(1.3rem,2.5vw,1.8rem); font-weight: 700; color: var(--charcoal); line-height: 1.15; }
    .adm-page-title em { color: var(--gold-dark); font-style: italic; }
    .adm-page-sub    { font-size: 0.78rem; color: var(--warm-grey); margin-top: 0.25rem; }

    /* ── STAT CARDS ── */
    .adm-stat-row { display: grid; grid-template-columns: repeat(5,1fr); gap: 0.85rem; margin-bottom: 1.5rem; }
    @media(max-width:760px){ .adm-stat-row { grid-template-columns: 1fr 1fr; } }
    .adm-stat-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; padding: 1rem 1.1rem; position: relative; overflow: hidden; }
    .adm-stat-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; }
    .adm-stat-card.s-all::before       { background: linear-gradient(90deg,var(--gold),var(--blush-deep)); }
    .adm-stat-card.s-pending::before   { background: var(--s-pending); }
    .adm-stat-card.s-confirmed::before { background: var(--s-confirmed); }
    .adm-stat-card.s-cancelled::before { background: var(--s-cancelled); }
    .adm-stat-card.s-completed::before { background: var(--s-completed); }
    .adm-stat-n { font-family: var(--font-display); font-size: 1.65rem; font-weight: 700; color: var(--gold-dark); line-height: 1; }
    .adm-stat-l { font-size: 0.6rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); margin-top: 3px; }

    /* ── FILTER BAR ── */
    .adm-filter-bar { background: var(--white); border: 1px solid var(--border); border-radius: 4px; padding: 0.75rem 1.1rem; display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.5rem; }
    .adm-filter-label { font-size: 0.62rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); margin-right: 0.25rem; }
    .adm-filter-tab { padding: 0.32rem 0.9rem; border-radius: 2px; border: 1px solid var(--border-md); background: var(--ivory); font-size: 0.72rem; color: var(--warm-grey); cursor: pointer; font-family: var(--font-body); transition: all 0.18s; }
    .adm-filter-tab:hover { border-color: var(--gold); color: var(--gold-dark); }
    .adm-filter-tab.active { background: var(--gold); border-color: var(--gold); color: var(--charcoal); font-weight: 600; }
    .adm-search-wrap { position: relative; margin-left: auto; }
    .adm-search-wrap svg { position: absolute; left: 0.6rem; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; color: #C0B8B0; pointer-events: none; }
    .adm-search { padding: 0.32rem 0.85rem 0.32rem 1.9rem; border: 1px solid var(--border-md); border-radius: 3px; font-family: var(--font-body); font-size: 0.75rem; color: var(--charcoal); background: var(--ivory); outline: none; width: 210px; transition: border-color 0.18s,box-shadow 0.18s; }
    .adm-search:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,0.1); background: var(--white); }
    .adm-search::placeholder { color: #C0B8B0; }

    /* ── BOOKING BLOCK ── */
    .adm-booking { margin-bottom: 1.5rem; }

    /* ── BOOKING HEADER ── */
    .adm-booking-header {
        background: var(--charcoal); border-radius: 4px 4px 0 0;
        padding: 1rem 1.35rem;
        display: flex; align-items: flex-start; justify-content: space-between;
        gap: 0.75rem; flex-wrap: wrap;
        position: relative; overflow: hidden;
    }
    .adm-booking-header::before { content:''; position:absolute; inset:0; background-image:radial-gradient(rgba(201,168,76,0.06) 1px,transparent 1px); background-size:18px 18px; pointer-events:none; }
    .adm-booking-header::after  { content:''; position:absolute; bottom:0; left:0; right:0; height:1.5px; background:linear-gradient(90deg,transparent,var(--gold),transparent); }
    .adm-bh-l { position:relative; z-index:1; flex:1; min-width:0; }
    .adm-bh-r { position:relative; z-index:1; display:flex; flex-direction:column; align-items:flex-end; gap:0.35rem; flex-shrink:0; }
    .adm-event-name { font-family:var(--font-display); font-size:1rem; font-weight:700; color:var(--white); }
    .adm-header-meta { display:flex; align-items:center; gap:0.75rem; flex-wrap:wrap; margin-top:0.3rem; }
    .adm-meta-chip { display:inline-flex; align-items:center; gap:0.3rem; font-size:0.68rem; color:rgba(255,255,255,0.52); }
    .adm-meta-chip svg { width:10px; height:10px; color:var(--gold); }
    .adm-client-chip { display:inline-flex; align-items:center; gap:0.3rem; padding:2px 8px; border-radius:999px; font-size:0.62rem; font-weight:600; background:rgba(255,255,255,0.08); color:rgba(255,255,255,0.65); border:1px solid rgba(255,255,255,0.14); }
    .adm-client-chip svg { width:9px; height:9px; }
    .adm-booking-id { font-size:0.6rem; color:rgba(255,255,255,0.28); font-family:var(--font-body); }

    /* Status badge */
    .adm-badge { display:inline-flex; align-items:center; gap:0.3rem; padding:0.22rem 0.7rem; border-radius:2px; font-size:0.62rem; font-weight:700; letter-spacing:0.06em; text-transform:uppercase; font-family:var(--font-body); }
    .adm-badge::before { content:''; width:5px; height:5px; border-radius:50%; flex-shrink:0; }
    .adm-badge.pending   { background:rgba(217,119,6,0.18);  color:#FDE68A; border:1px solid rgba(217,119,6,0.4); }
    .adm-badge.pending::before   { background:#D97706; }
    .adm-badge.confirmed { background:rgba(22,163,74,0.15);  color:#A7F3D0; border:1px solid rgba(22,163,74,0.35); }
    .adm-badge.confirmed::before { background:#16A34A; }
    .adm-badge.cancelled { background:rgba(185,28,28,0.15);  color:#FECACA; border:1px solid rgba(185,28,28,0.35); }
    .adm-badge.cancelled::before { background:#EF4444; }
    .adm-badge.completed { background:rgba(107,101,96,0.25);  color:#D4CFC9; border:1px solid rgba(107,101,96,0.4); }
    .adm-badge.completed::before { background:#9CA3AF; }

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
    .adm-body { background:var(--white); border:1px solid var(--border); border-top:none; border-radius:0 0 4px 4px; display:grid; grid-template-columns:1fr 1fr; }
    @media(max-width:640px){ .adm-body { grid-template-columns:1fr; } }

    /* Left — timeline */
    .adm-body-left { padding:1.35rem 1.5rem; border-right:1px solid var(--border); }
    @media(max-width:640px){ .adm-body-left { border-right:none; border-bottom:1px solid var(--border); } }

    .adm-tl-label { font-size:0.6rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#C0B8B0; margin-bottom:1rem; display:flex; align-items:center; gap:0.4rem; }
    .adm-tl-label svg { width:10px; height:10px; color:var(--gold-dark); }

    .adm-track { position:relative; padding-left:1.85rem; }
    .adm-track::before { content:''; position:absolute; left:9px; top:5px; bottom:5px; width:2px; background:var(--border); }

    .adm-step { position:relative; padding-bottom:1.1rem; }
    .adm-step:last-child { padding-bottom:0; }
    .adm-step::before { content:''; position:absolute; left:-1.85rem; top:4px; width:13px; height:13px; border-radius:50%; background:var(--border-md); border:2px solid var(--white); box-shadow:0 0 0 2px var(--border-md); z-index:1; transition:all 0.2s; }
    .adm-step.step-done::before     { background:var(--s-confirmed); box-shadow:0 0 0 3px rgba(22,163,74,0.18); }
    .adm-step.step-active::before   { background:var(--gold);        box-shadow:0 0 0 3px rgba(201,168,76,0.22); }
    .adm-step.step-cancelled::before{ background:var(--s-cancelled); box-shadow:0 0 0 3px rgba(185,28,28,0.18); }
    .adm-step.step-ongoing::before  { background:var(--s-ongoing);   box-shadow:0 0 0 3px rgba(37,99,235,0.18); }
    .adm-step.step-grey::before     { background:#9CA3AF;             box-shadow:0 0 0 2px rgba(156,163,175,0.2); }

    .adm-step-card { background:var(--ivory); border:1px solid var(--border); border-radius:4px; padding:0.65rem 0.9rem; }
    .adm-step.step-done     .adm-step-card { border-color:rgba(22,163,74,0.22);  background:rgba(22,163,74,0.03); }
    .adm-step.step-active   .adm-step-card { border-color:rgba(201,168,76,0.28); background:rgba(201,168,76,0.04); }
    .adm-step.step-cancelled .adm-step-card{ border-color:rgba(185,28,28,0.18);  background:rgba(185,28,28,0.03); }
    .adm-step.step-ongoing  .adm-step-card { border-color:rgba(37,99,235,0.2);   background:rgba(37,99,235,0.03); }
    .adm-step.step-grey     .adm-step-card { border-color:rgba(156,163,175,0.2); background:rgba(156,163,175,0.03); }

    .adm-step-title { font-size:0.76rem; font-weight:700; color:var(--charcoal); display:flex; align-items:center; gap:0.38rem; margin-bottom:0.15rem; }
    .adm-step-title svg { width:12px; height:12px; flex-shrink:0; }
    .icon-done      { color:var(--s-confirmed); }
    .icon-active    { color:var(--gold-dark); }
    .icon-cancelled { color:var(--s-cancelled); }
    .icon-waiting   { color:#C0B8B0; }
    .icon-ongoing   { color:var(--s-ongoing); }
    .icon-grey      { color:#9CA3AF; }
    .adm-step-sub { font-size:0.7rem; color:var(--warm-grey); line-height:1.45; }

    /* Right — details */
    .adm-body-right { padding:1.35rem 1.5rem; }
    .adm-detail-label { font-size:0.6rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#C0B8B0; margin-bottom:1rem; display:flex; align-items:center; gap:0.4rem; }
    .adm-detail-label svg { width:10px; height:10px; color:var(--gold-dark); }

    .adm-detail-grid { display:flex; flex-direction:column; gap:0.7rem; }
    .adm-detail-k { font-size:0.6rem; font-weight:700; letter-spacing:0.09em; text-transform:uppercase; color:#C0B8B0; margin-bottom:0.18rem; display:flex; align-items:center; gap:0.25rem; }
    .adm-detail-k svg { width:9px; height:9px; color:var(--gold-dark); }
    .adm-detail-v { font-size:0.82rem; color:var(--charcoal); font-weight:500; }
    .adm-detail-v.nil { color:#C0B8B0; font-style:italic; font-size:0.76rem; }
    .adm-price-v { font-family:var(--font-display); font-size:1rem; font-weight:700; color:var(--gold-dark); }

    .adm-client-row { display:flex; align-items:center; gap:0.5rem; }
    .adm-client-avatar { width:26px; height:26px; border-radius:50%; background:linear-gradient(135deg,var(--gold),var(--gold-dark)); display:flex; align-items:center; justify-content:center; font-family:var(--font-display); font-size:0.6rem; font-weight:700; color:var(--white); flex-shrink:0; }
    .adm-client-name { font-size:0.82rem; font-weight:600; color:var(--charcoal); }
    .adm-client-id   { font-size:0.65rem; color:var(--warm-grey); }

    /* Composite status chip */
    .adm-status-row { display:flex; align-items:center; gap:0.4rem; flex-wrap:wrap; }

    /* ── EMPTY ── */
    .adm-empty { text-align:center; padding:4.5rem 2rem; background:var(--white); border:1px solid var(--border); border-radius:4px; }
    .adm-empty svg { width:52px; height:52px; color:var(--gold); opacity:0.25; margin:0 auto 1.1rem; display:block; }
    .adm-empty-title { font-family:var(--font-display); font-size:1.15rem; font-weight:600; color:var(--charcoal); margin-bottom:0.35rem; }
    .adm-empty-sub { font-size:0.83rem; color:var(--warm-grey); line-height:1.65; }

    .reveal { opacity:0; transform:translateY(12px); transition:opacity .45s ease,transform .45s ease; }
    .reveal.visible { opacity:1; transform:none; }
    @media(max-width:700px){ .adm-page { padding:1.25rem 1rem 3rem; } }
</style>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Booking Timeline') }}
    </h2>
</x-slot>

<div class="adm-page">

    {{-- Page Header --}}
    <div class="adm-page-header reveal">
        <div>
            <h1 class="adm-page-title">Booking <em>Timeline</em></h1>
            <p class="adm-page-sub">Admin overview of all bookings with live event status tracking.</p>
        </div>
    </div>

    {{-- Stats --}}
    @php
        $total     = $bookings->count();
        $pending   = $bookings->where('status','pending')->count();
        $confirmed = $bookings->where('status','confirmed')->count();
        $cancelled = $bookings->where('status','cancelled')->count();
        $completed = $bookings->filter(function($b){
            return \Carbon\Carbon::parse($b->event_date)->isPast()
                && $b->status === 'confirmed';
        })->count();
    @endphp

    <div class="adm-stat-row reveal">
        <div class="adm-stat-card s-all">
            <div class="adm-stat-n">{{ $total }}</div>
            <div class="adm-stat-l">Total</div>
        </div>
        <div class="adm-stat-card s-pending">
            <div class="adm-stat-n">{{ $pending }}</div>
            <div class="adm-stat-l">Pending</div>
        </div>
        <div class="adm-stat-card s-confirmed">
            <div class="adm-stat-n">{{ $confirmed }}</div>
            <div class="adm-stat-l">Confirmed</div>
        </div>
        <div class="adm-stat-card s-cancelled">
            <div class="adm-stat-n">{{ $cancelled }}</div>
            <div class="adm-stat-l">Cancelled</div>
        </div>
        <div class="adm-stat-card s-completed">
            <div class="adm-stat-n">{{ $completed }}</div>
            <div class="adm-stat-l">Completed</div>
        </div>
    </div>

    {{-- Filter + Search --}}
    <div class="adm-filter-bar reveal">
        <span class="adm-filter-label">Filter</span>
        <button class="adm-filter-tab active" data-filter="all">All</button>
        <button class="adm-filter-tab" data-filter="pending">Pending</button>
        <button class="adm-filter-tab" data-filter="confirmed">Confirmed</button>
        <button class="adm-filter-tab" data-filter="cancelled">Cancelled</button>
        <button class="adm-filter-tab" data-filter="completed">Completed</button>
        <div class="adm-search-wrap">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="4.5"/><path d="M10.5 10.5l3 3"/></svg>
            <input type="text" id="admSearch" class="adm-search" placeholder="Search event, client, supplier…">
        </div>
    </div>

    {{-- Bookings --}}
    @if($bookings->count())
    <div id="admList">

    @foreach($bookings as $booking)
    @php
        $status      = $booking->status ?? 'pending';
        $eventName   = $booking->event->event_name ?? 'Unnamed Event';
        $eventType   = $booking->event->event_type ?? null;
        $venue       = $booking->event->venue ?? null;
        $eventDate   = $booking->event_date ?? null;
        $pkgName     = $booking->package->name ?? null;
        $price       = $booking->total_price ?? 0;
        $supplierBiz = $booking->package->supplier->business_name
                    ?? $booking->package->supplier->name
                    ?? null;
        $clientName  = $booking->user->name ?? null;
        $clientId    = $booking->user_id ?? null;
        $clientInit  = $clientName ? strtoupper(substr($clientName, 0, 2)) : 'CL';
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
            if ($eventCarbon->isToday())   $eventStatus = 'ongoing';
            elseif ($eventCarbon->isPast()) $eventStatus = 'completed';
        }

        // Composite display status
        $displayStatus = $status;
        if ($status === 'confirmed' && $eventStatus === 'completed') $displayStatus = 'completed';

        // Timeline step classes
        $stepPlaced  = 'step-done';
        $stepConfirm = match($status) {
            'confirmed' => 'step-done',
            'cancelled' => 'step-cancelled',
            default     => 'step-waiting',
        };
        $stepEvent = match(true) {
            $status === 'cancelled'              => 'step-waiting',
            $eventStatus === 'ongoing'           => 'step-ongoing',
            $eventStatus === 'completed'         => 'step-grey',
            $status === 'confirmed'              => 'step-active',
            default                              => 'step-waiting',
        };

        // Data attr for filter/search
        $filterStatus = $displayStatus;
    @endphp

    <div class="adm-booking reveal"
         data-status="{{ $filterStatus }}"
         data-search="{{ strtolower($eventName.' '.($clientName ?? '').' '.($supplierBiz ?? '')) }}">

        {{-- Header --}}
        <div class="adm-booking-header">
            <div class="adm-bh-l">
                <div class="adm-event-name">{{ $eventName }}</div>
                <div class="adm-header-meta">
                    @if($eventType)
                    <span class="adm-meta-chip">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="6" cy="6" r="4.5"/><path d="M6 3v3l2 1"/></svg>
                        {{ $eventType }}
                    </span>
                    @endif
                    <span class="adm-meta-chip">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="2" width="10" height="9" rx="1.5"/><path d="M4 1v2M8 1v2M1 6h10"/></svg>
                        {{ $formattedDate }}
                    </span>
                    @if($clientName)
                    <span class="adm-client-chip">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 10v-1a3 3 0 013-3h2a3 3 0 013 3v1"/><circle cx="6" cy="4" r="2"/></svg>
                        {{ $clientName }}
                    </span>
                    @endif
                </div>
            </div>
            <div class="adm-bh-r">
                <div class="adm-status-row">
                    <span class="adm-badge {{ $status }}">{{ ucfirst($status) }}</span>
                    <span class="ev-badge {{ $eventStatus }}">{{ ucfirst($eventStatus) }}</span>
                </div>
                <span class="adm-booking-id">ID #{{ $booking->id }}</span>
            </div>
        </div>

        {{-- Split body --}}
        <div class="adm-body">

            {{-- LEFT — Timeline --}}
            <div class="adm-body-left">
                <div class="adm-tl-label">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 1v6l3 2"/><circle cx="7" cy="7" r="6"/></svg>
                    Progress Timeline
                </div>
                <div class="adm-track">

                    {{-- Step 1: Booking Created --}}
                    <div class="adm-step {{ $stepPlaced }}">
                        <div class="adm-step-card">
                            <div class="adm-step-title">
                                <svg class="icon-done" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M2 7l3 3 7-6"/></svg>
                                Booking Created
                            </div>
                            <div class="adm-step-sub">{{ $placedAt }}</div>
                        </div>
                    </div>

                    {{-- Step 2: Supplier Response --}}
                    <div class="adm-step {{ $stepConfirm }}">
                        <div class="adm-step-card">
                            <div class="adm-step-title">
                                @if($status === 'confirmed')
                                    <svg class="icon-done" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M2 7l3 3 7-6"/></svg>
                                @elseif($status === 'cancelled')
                                    <svg class="icon-cancelled" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 3l8 8M11 3l-8 8"/></svg>
                                @else
                                    <svg class="icon-waiting" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="5.5"/><path d="M7 4v3l2 1.5"/></svg>
                                @endif
                                Supplier Response
                            </div>
                            <div class="adm-step-sub">
                                @if($status === 'pending')   Awaiting supplier…
                                @elseif($status === 'confirmed') Confirmed by supplier
                                @else Booking was cancelled
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Step 3: Event Status (auto) --}}
                    <div class="adm-step {{ $stepEvent }}">
                        <div class="adm-step-card">
                            <div class="adm-step-title">
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
                            <div class="adm-step-sub">
                                @if($eventStatus === 'upcoming' && $status === 'confirmed')
                                    Scheduled — {{ $formattedDate }}
                                @elseif($eventStatus === 'ongoing')
                                    Happening today · {{ $formattedDate }}
                                @elseif($eventStatus === 'completed')
                                    Completed on {{ $formattedDate }}
                                @else
                                    {{ $formattedDate }}
                                @endif
                            </div>
                        </div>
                    </div>

                </div>{{-- /adm-track --}}
            </div>

            {{-- RIGHT — Details --}}
            <div class="adm-body-right">
                <div class="adm-detail-label">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="10" height="10" rx="2"/><path d="M5 5h4M5 7.5h3M5 10h2"/></svg>
                    Booking Details
                </div>
                <div class="adm-detail-grid">

                    <div>
                        <div class="adm-detail-k">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 10v-1a3 3 0 013-3h2a3 3 0 013 3v1"/><circle cx="6" cy="4" r="2"/></svg>
                            Client
                        </div>
                        <div class="adm-client-row">
                            <div class="adm-client-avatar">{{ $clientInit }}</div>
                            <div>
                                <div class="adm-client-name">{{ $clientName ?? 'Unknown' }}</div>
                                @if($clientId)<div class="adm-client-id">ID #{{ $clientId }}</div>@endif
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="adm-detail-k">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="2" width="10" height="9" rx="1.5"/><path d="M3 5h6M3 7.5h4"/></svg>
                            Package
                        </div>
                        <div class="adm-detail-v {{ !$pkgName ? 'nil' : '' }}">{{ $pkgName ?? '—' }}</div>
                    </div>

                    <div>
                        <div class="adm-detail-k">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 10V6l5-4 5 4v4M4 10V7h4v3"/></svg>
                            Supplier
                        </div>
                        <div class="adm-detail-v {{ !$supplierBiz ? 'nil' : '' }}">{{ $supplierBiz ?? '—' }}</div>
                    </div>

                    <div>
                        <div class="adm-detail-k">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="6" cy="6" r="4.5"/><path d="M6 2v8M4.5 4.5h3a1 1 0 010 2H4.5a1 1 0 000 2H7.5"/></svg>
                            Total Price
                        </div>
                        <div class="adm-price-v">₱{{ number_format($price, 2) }}</div>
                    </div>

                    @if($venue)
                    <div>
                        <div class="adm-detail-k">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 1C4.343 1 3 2.343 3 4c0 2.625 3 7 3 7s3-4.375 3-7c0-1.657-1.343-3-3-3z"/><circle cx="6" cy="4" r="1"/></svg>
                            Venue
                        </div>
                        <div class="adm-detail-v">{{ $venue }}</div>
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
    @endforeach

    </div>

    @else
    <div class="adm-empty reveal">
        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
            <rect x="8" y="10" width="32" height="30" rx="3"/>
            <path d="M16 20h16M16 27h10M24 4v6M18 4l6 6 6-6"/>
        </svg>
        <div class="adm-empty-title">No bookings found</div>
        <p class="adm-empty-sub">There are no booking requests in the system yet.</p>
    </div>
    @endif

</div>

<script>
    const tabs  = document.querySelectorAll('.adm-filter-tab');
    const items = document.querySelectorAll('#admList .adm-booking');

    function applyFilters() {
        const activeTab = document.querySelector('.adm-filter-tab.active');
        const f   = activeTab ? activeTab.dataset.filter : 'all';
        const q   = document.getElementById('admSearch').value.toLowerCase().trim();

        items.forEach(item => {
            const statusMatch  = (f === 'all' || item.dataset.status === f);
            const searchMatch  = !q || item.dataset.search.includes(q);
            item.style.display = (statusMatch && searchMatch) ? '' : 'none';
        });
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            applyFilters();
        });
    });

    document.getElementById('admSearch').addEventListener('input', applyFilters);

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

</x-app-layout>