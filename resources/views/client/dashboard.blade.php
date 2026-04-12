<x-client-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap');

    :root {
        --gold:        #C9A84C;
        --gold-light:  #E8C97A;
        --gold-dark:   #8A6A1F;
        --ivory:       #FAF7F2;
        --charcoal:    #1E1B18;
        --warm-grey:   #6B6560;
        --white:       #FFFFFF;
        --border:      #F0EBE5;
        --border-md:   #E0D8D0;
        --font-display:'Playfair Display', Georgia, serif;
        --font-body:   'DM Sans', sans-serif;
    }

    .cd-wrap {
        font-family: var(--font-body);
        padding: 2rem 0 4rem;
        background: var(--ivory);
        min-height: 100vh;
    }
    .cd-inner {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    /* ── Welcome bar ── */
    .cd-welcome {
        background: var(--charcoal);
        border-radius: 14px;
        padding: 1.75rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1.75rem;
        position: relative;
        overflow: hidden;
    }
    .cd-welcome::before {
        content: '';
        position: absolute; inset: 0;
        background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px);
        background-size: 20px 20px;
        pointer-events: none;
    }
    .cd-welcome::after {
        content: '';
        position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }
    .cd-welcome-text { position: relative; z-index: 1; }
    .cd-welcome-eyebrow {
        font-size: 0.62rem; letter-spacing: 0.18em; text-transform: uppercase;
        color: var(--gold); font-weight: 500;
        display: flex; align-items: center; gap: 0.5rem;
        margin-bottom: 0.35rem;
    }
    .cd-welcome-eyebrow::before { content: ''; width: 14px; height: 1px; background: var(--gold); }
    .cd-welcome h1 {
        font-family: var(--font-display);
        font-size: clamp(1.3rem, 2.5vw, 1.9rem);
        font-weight: 700; color: var(--white); line-height: 1.15;
    }
    .cd-welcome h1 em { color: var(--gold-light); font-style: italic; }
    .cd-welcome p {
        font-size: 0.78rem; color: rgba(255,255,255,0.38);
        margin-top: 0.25rem;
    }
    .cd-create-btn {
        position: relative; z-index: 1;
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.7rem 1.4rem;
        background: var(--gold);
        color: var(--charcoal);
        border: none; border-radius: 8px;
        font-family: var(--font-body);
        font-size: 0.82rem; font-weight: 500;
        cursor: pointer;
        transition: background 0.2s, transform 0.15s;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .cd-create-btn:hover { background: var(--gold-light); transform: translateY(-1px); }
    .cd-create-btn svg { width: 15px; height: 15px; }

    /* ── Stat cards ── */
    .cd-stats {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1.75rem;
    }
    .cd-stat {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 1.25rem 1.35rem;
        position: relative;
        overflow: hidden;
    }
    .cd-stat::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, var(--gold), var(--gold-light));
    }
    .cd-stat-label {
        font-size: 0.62rem; font-weight: 600; letter-spacing: 0.1em;
        text-transform: uppercase; color: #C0B8B0;
        margin-bottom: 0.5rem;
        display: flex; align-items: center; gap: 0.4rem;
    }
    .cd-stat-label svg { width: 11px; height: 11px; color: var(--gold-dark); }
    .cd-stat-value {
        font-family: var(--font-display);
        font-size: 2rem; font-weight: 700;
        color: var(--charcoal); line-height: 1;
        margin-bottom: 0.2rem;
    }
    .cd-stat-sub { font-size: 0.72rem; color: var(--warm-grey); }

    /* ── Section heading ── */
    .cd-section-head {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1rem;
    }
    .cd-section-title {
        font-size: 0.62rem; font-weight: 700; letter-spacing: 0.14em;
        text-transform: uppercase; color: var(--gold-dark);
        display: flex; align-items: center; gap: 0.4rem;
    }
    .cd-section-title::after { content: ''; flex: 0 0 30px; height: 1px; background: linear-gradient(90deg, var(--gold), transparent); }

    /* ── Events table / cards ── */
    .cd-events-wrap {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 1.75rem;
    }
    .cd-table { width: 100%; border-collapse: collapse; }
    .cd-table thead tr {
        background: rgba(201,168,76,0.04);
        border-bottom: 1px solid var(--border);
    }
    .cd-table th {
        padding: 0.75rem 1.25rem;
        text-align: left;
        font-size: 0.6rem; font-weight: 700; letter-spacing: 0.1em;
        text-transform: uppercase; color: #C0B8B0;
    }
    .cd-table td {
        padding: 1rem 1.25rem;
        font-size: 0.82rem; color: var(--charcoal);
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
    }
    .cd-table tr:last-child td { border-bottom: none; }
    .cd-table tbody tr { transition: background 0.15s; }
    .cd-table tbody tr:hover { background: rgba(201,168,76,0.025); }

    .cd-event-name { font-weight: 500; color: var(--charcoal); }
    .cd-event-type {
        display: inline-flex; align-items: center;
        padding: 2px 9px; border-radius: 999px;
        font-size: 0.62rem; font-weight: 600;
        background: rgba(201,168,76,0.1); color: var(--gold-dark);
        border: 1px solid rgba(201,168,76,0.2);
    }
    .cd-status {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 2px 9px; border-radius: 999px;
        font-size: 0.62rem; font-weight: 600;
    }
    .cd-status::before { content: ''; width: 5px; height: 5px; border-radius: 50%; }
    .cd-status.upcoming  { background: #EFF6FF; color: #1D4ED8; }
    .cd-status.upcoming::before  { background: #3B82F6; }
    .cd-status.completed { background: #F0FDF4; color: #15803D; }
    .cd-status.completed::before { background: #22C55E; }
    .cd-status.cancelled { background: #FEF2F2; color: #B91C1C; }
    .cd-status.cancelled::before { background: #EF4444; }
    .cd-status.planning  { background: rgba(201,168,76,0.1); color: var(--gold-dark); }
    .cd-status.planning::before  { background: var(--gold); }

    /* Empty state */
    .cd-empty {
        text-align: center; padding: 3.5rem 2rem;
    }
    .cd-empty-icon {
        width: 52px; height: 52px; border-radius: 50%;
        background: rgba(201,168,76,0.08);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 0.9rem; color: var(--gold-dark);
    }
    .cd-empty-icon svg { width: 24px; height: 24px; }
    .cd-empty h3 {
        font-family: var(--font-display);
        font-size: 1rem; font-weight: 700; color: var(--charcoal);
        margin-bottom: 0.3rem;
    }
    .cd-empty p { font-size: 0.78rem; color: var(--warm-grey); }

    /* ── Quick tips card ── */
    .cd-tips {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 1.4rem 1.5rem;
    }
    .cd-tip-list { display: flex; flex-direction: column; gap: 0.65rem; margin-top: 0.85rem; }
    .cd-tip-item {
        display: flex; align-items: flex-start; gap: 0.65rem;
        font-size: 0.8rem; color: var(--warm-grey); line-height: 1.5;
    }
    .cd-tip-dot {
        width: 20px; height: 20px; flex-shrink: 0;
        border-radius: 50%; background: rgba(201,168,76,0.1);
        display: flex; align-items: center; justify-content: center;
        margin-top: 1px;
    }
    .cd-tip-dot svg { width: 11px; height: 11px; color: var(--gold-dark); }

    /* ══════════════════════
       MODAL
    ══════════════════════ */
    .cd-modal-backdrop {
        position: fixed; inset: 0; z-index: 500;
        background: rgba(30,27,24,0.55);
        backdrop-filter: blur(4px);
        display: none; align-items: center; justify-content: center;
        padding: 1rem;
    }
    .cd-modal-backdrop.open { display: flex; }
    .cd-modal {
        background: var(--white);
        border-radius: 16px;
        width: 620px; max-width: 100%;
        border: 1px solid var(--border);
        max-height: 92vh;
        display: flex; flex-direction: column;
    }
    .cd-modal-header {
        flex-shrink: 0;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border);
        display: flex; align-items: center; justify-content: space-between;
        position: relative;
    }
    .cd-modal-header::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, var(--gold), var(--gold-light));
        border-radius: 16px 16px 0 0;
    }
    .cd-modal-header-l { display: flex; align-items: center; gap: 0.65rem; }
    .cd-modal-icon {
        width: 34px; height: 34px; border-radius: 8px;
        background: rgba(201,168,76,0.1);
        display: flex; align-items: center; justify-content: center;
        color: var(--gold-dark); flex-shrink: 0;
    }
    .cd-modal-icon svg { width: 16px; height: 16px; }
    .cd-modal-title {
        font-family: var(--font-display);
        font-size: 1rem; font-weight: 700; color: var(--charcoal);
    }
    .cd-modal-sub { font-size: 0.7rem; color: var(--warm-grey); margin-top: 1px; }
    .cd-modal-close {
        width: 30px; height: 30px; border-radius: 50%;
        background: var(--ivory); border: 1px solid var(--border-md);
        cursor: pointer; font-size: 18px; color: var(--warm-grey);
        display: flex; align-items: center; justify-content: center;
        transition: background 0.15s, color 0.15s;
    }
    .cd-modal-close:hover { background: var(--border); color: var(--charcoal); }

    .cd-modal-body {
        padding: 1.5rem; overflow-y: auto; flex: 1; min-height: 0;
    }
    .cd-modal-footer {
        flex-shrink: 0;
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--border);
        display: flex; gap: 0.65rem; justify-content: flex-end;
        align-items: center;
    }

    /* ── Form fields ── */
    .cd-field { display: flex; flex-direction: column; gap: 5px; margin-bottom: 1rem; }
    .cd-field:last-child { margin-bottom: 0; }
    .cd-field label {
        font-size: 0.68rem; font-weight: 600; letter-spacing: 0.07em;
        text-transform: uppercase; color: var(--warm-grey);
    }
    .cd-field label .req { color: var(--gold); margin-left: 2px; }
    .cd-input {
        width: 100%;
        padding: 0.75rem 0.9rem;
        border: 1.5px solid var(--border-md);
        border-radius: 8px;
        font-family: var(--font-body);
        font-size: 0.875rem; color: var(--charcoal);
        background: var(--ivory);
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }
    .cd-input:focus {
        border-color: var(--gold);
        background: var(--white);
        box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
    }
    .cd-input::placeholder { color: #C0B8B0; }
    textarea.cd-input { resize: vertical; min-height: 80px; }
    select.cd-input { cursor: pointer; }

    .cd-form-row {
        display: grid; grid-template-columns: 1fr 1fr;
        gap: 1rem; margin-bottom: 1rem;
    }
    .cd-form-row .cd-field { margin-bottom: 0; }
    @media (max-width: 520px) { .cd-form-row { grid-template-columns: 1fr; } }

    .cd-form-divider {
        border: none; border-top: 1px solid var(--border);
        margin: 1.25rem 0;
    }
    .cd-form-section-label {
        font-size: 0.6rem; font-weight: 700; letter-spacing: 0.14em;
        text-transform: uppercase; color: var(--gold-dark);
        display: flex; align-items: center; gap: 0.4rem;
        margin-bottom: 1rem;
    }
    .cd-form-section-label::after { content: ''; flex: 1; height: 1px; background: linear-gradient(90deg, var(--gold), transparent); }

    /* Buttons */
    .cd-btn-cancel {
        padding: 0.65rem 1.2rem;
        background: transparent; color: var(--warm-grey);
        border: 1px solid var(--border-md); border-radius: 8px;
        font-family: var(--font-body); font-size: 0.82rem; font-weight: 500;
        cursor: pointer; transition: background 0.15s;
    }
    .cd-btn-cancel:hover { background: var(--ivory); }
    .cd-btn-submit {
        padding: 0.65rem 1.6rem;
        background: var(--charcoal); color: var(--white);
        border: none; border-radius: 8px;
        font-family: var(--font-body); font-size: 0.82rem; font-weight: 500;
        cursor: pointer; transition: background 0.2s, transform 0.15s;
        display: inline-flex; align-items: center; gap: 0.45rem;
        position: relative; overflow: hidden;
    }
    .cd-btn-submit::after {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(135deg, var(--gold-dark), var(--gold));
        opacity: 0; transition: opacity 0.25s;
    }
    .cd-btn-submit:hover::after { opacity: 1; }
    .cd-btn-submit:hover { transform: translateY(-1px); }
    .cd-btn-submit > * { position: relative; z-index: 1; }
    .cd-btn-submit svg { width: 14px; height: 14px; }

    /* Mobile */
    @media (max-width: 640px) {
        .cd-welcome { padding: 1.25rem 1.25rem; }
        .cd-table { display: none; }
        .cd-mobile-events { display: flex; flex-direction: column; }
        .cd-mobile-event-card {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border);
        }
        .cd-mobile-event-card:last-child { border-bottom: none; }
    }
    @media (min-width: 641px) {
        .cd-mobile-events { display: none; }
    }
</style>

<div class="cd-wrap">
<div class="cd-inner">

    {{-- ── Welcome banner ── --}}
    <div class="cd-welcome">
        <div class="cd-welcome-text">
            <div class="cd-welcome-eyebrow">Client Portal</div>
            <h1>Welcome back, <em>{{ Auth::user()->name }}</em></h1>
            <p>Manage your events and track supplier bookings from here.</p>
        </div>
        <button class="cd-create-btn" onclick="openEventModal()">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
                <line x1="10" y1="4" x2="10" y2="16"/><line x1="4" y1="10" x2="16" y2="10"/>
            </svg>
            Create Event
        </button>
    </div>

    {{-- ── Stat cards ── --}}
    <div class="cd-stats">
        <div class="cd-stat">
            <div class="cd-stat-label">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="4" width="16" height="14" rx="2"/><path d="M2 9h16M7 2v4M13 2v4"/></svg>
                Total Events
            </div>
            <div class="cd-stat-value">{{ isset($events) ? count($events) : 0 }}</div>
            <div class="cd-stat-sub">all time</div>
        </div>
        <div class="cd-stat">
            <div class="cd-stat-label">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="10" r="8"/><path d="M10 6v4l2.5 2.5"/></svg>
                Upcoming
            </div>
            <div class="cd-stat-value">{{ isset($events) ? $events->where('status','upcoming')->count() : 0 }}</div>
            <div class="cd-stat-sub">scheduled</div>
        </div>
        <div class="cd-stat">
            <div class="cd-stat-label">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M4 10l4 4 8-8"/></svg>
                Completed
            </div>
            <div class="cd-stat-value">{{ isset($events) ? $events->where('status','completed')->count() : 0 }}</div>
            <div class="cd-stat-sub">finished</div>
        </div>
        <div class="cd-stat">
            <div class="cd-stat-label">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M17 10H3M3 10l4-4M3 10l4 4"/></svg>
                In Planning
            </div>
            <div class="cd-stat-value">{{ isset($events) ? $events->where('status','planning')->count() : 0 }}</div>
            <div class="cd-stat-sub">in progress</div>
        </div>
    </div>

    {{-- ── Events table ── --}}
    <div class="cd-section-head">
        <span class="cd-section-title">My Events</span>
        <button class="cd-create-btn" style="padding:0.5rem 1rem; font-size:0.75rem;" onclick="openEventModal()">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" style="width:13px;height:13px;">
                <line x1="10" y1="4" x2="10" y2="16"/><line x1="4" y1="10" x2="16" y2="10"/>
            </svg>
            New Event
        </button>
    </div>

    <div class="cd-events-wrap">
        @if(isset($events) && count($events))

        {{-- Desktop table --}}
        <table class="cd-table">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Venue</th>
                    <th>Guests</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td class="cd-event-name">{{ $event->name }}</td>
                    <td><span class="cd-event-type">{{ $event->event_type }}</span></td>
                    <td>{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</td>
                    <td>{{ $event->venue ?? '—' }}</td>
                    <td>{{ $event->guest_count ? number_format($event->guest_count) : '—' }}</td>
                    <td><span class="cd-status {{ $event->status ?? 'planning' }}">{{ ucfirst($event->status ?? 'planning') }}</span></td>
                    <td>
                        <a href="{{ route('client.events.show', $event->id) }}"
                           style="font-size:0.72rem; color:var(--gold-dark); text-decoration:none; font-weight:500;">
                            View →
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Mobile cards --}}
        <div class="cd-mobile-events">
            @foreach($events as $event)
            <div class="cd-mobile-event-card">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.4rem;">
                    <span style="font-size:0.88rem;font-weight:500;color:var(--charcoal);">{{ $event->name }}</span>
                    <span class="cd-status {{ $event->status ?? 'planning' }}">{{ ucfirst($event->status ?? 'planning') }}</span>
                </div>
                <div style="display:flex;gap:0.5rem;flex-wrap:wrap;align-items:center;">
                    <span class="cd-event-type">{{ $event->event_type }}</span>
                    <span style="font-size:0.72rem;color:var(--warm-grey);">{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</span>
                    @if($event->venue)<span style="font-size:0.72rem;color:var(--warm-grey);">· {{ $event->venue }}</span>@endif
                </div>
            </div>
            @endforeach
        </div>

        @else
        <div class="cd-empty">
            <div class="cd-empty-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
            </div>
            <h3>No events yet</h3>
            <p>Create your first event to get started.</p>
        </div>
        @endif
    </div>

    {{-- ── Quick tips ── --}}
    <div class="cd-section-head"><span class="cd-section-title">Getting Started</span></div>
    <div class="cd-tips">
        <div class="cd-tip-list">
            <div class="cd-tip-item">
                <div class="cd-tip-dot">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M10 2l2.4 4.9L18 7.6l-4 3.9 1 5.5L10 14.4l-5 2.6 1-5.5L2 7.6l5.6-.7z"/></svg>
                </div>
                <span><strong style="color:var(--charcoal)">Create an event</strong> — click "Create Event" to start planning. Add your event name, date, type, venue and guest count.</span>
            </div>
            <div class="cd-tip-item">
                <div class="cd-tip-dot">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M2 10s3.5-6 8-6 8 6 8 6-3.5 6-8 6-8-6-8-6z"/><circle cx="10" cy="10" r="2.5"/></svg>
                </div>
                <span><strong style="color:var(--charcoal)">Browse suppliers</strong> — explore verified suppliers from Bikol and browse their packages and gallery.</span>
            </div>
            <div class="cd-tip-item">
                <div class="cd-tip-dot">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="4" width="16" height="13" rx="2"/><path d="M2 8h16"/><path d="M6 4V2M14 4V2"/></svg>
                </div>
                <span><strong style="color:var(--charcoal)">Track your bookings</strong> — once suppliers accept your inquiry, your bookings will appear on your event page.</span>
            </div>
        </div>
    </div>

</div>
</div>

{{-- ══════════════ CREATE EVENT MODAL ══════════════ --}}
<div class="cd-modal-backdrop" id="eventModal" onclick="if(event.target===this)closeEventModal()">
    <div class="cd-modal">

        <div class="cd-modal-header">
            <div class="cd-modal-header-l">
                <div class="cd-modal-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="2" y="4" width="16" height="14" rx="2"/>
                        <path d="M2 9h16M7 2v4M13 2v4"/>
                    </svg>
                </div>
                <div>
                    <div class="cd-modal-title">Create a New Event</div>
                    <div class="cd-modal-sub">Fill in the details to start planning your event</div>
                </div>
            </div>
            <button class="cd-modal-close" onclick="closeEventModal()">&#215;</button>
        </div>

        <form action="{{ route('client.events.store') }}" method="POST" class="cd-modal-body" id="createEventForm">
            @csrf

            {{-- Basic info --}}
            <div class="cd-form-section-label">Event Details</div>

            <div class="cd-field">
                <label for="ev_name">Event Name <span class="req">*</span></label>
                <input class="cd-input" type="text" id="ev_name" name="event_name"
                       placeholder="e.g. Sarah & James Wedding" required>
            </div>
             @php
                $eventcategories = \App\Models\Eventcategory::all();
            @endphp
            @if($eventcategories)
            <div class="cd-form-row">
                <div class="cd-field">
                    <label for="ev_type">Event Type <span class="req">*</span></label>
                    <select class="cd-input" id="ev_type" name="event_type" required>
                        <option value="" disabled selected>Select type…</option>
                        @foreach($eventcategories as $eventcategories)
                            <option value="{{ $eventcategories->name }}"
                                {{ old('') == $eventcategories->name? 'selected' : '' }}>
                                {{ $eventcategories->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
         
            
                <div class="cd-field">
                    <label for="ev_date">Event Date <span class="req">*</span></label>
                    <input class="cd-input" type="date" id="ev_date" name="event_date" required>
                </div>
            </div>

            <hr class="cd-form-divider">
            <div class="cd-form-section-label">Venue & Guests</div>

            <div class="cd-field">
                <label for="ev_venue">Venue</label>
                <input class="cd-input" type="text" id="ev_venue" name="venue"
                       placeholder="e.g. Grand Ballroom, Naga City">
            </div>

            <div class="cd-form-row">
                <div class="cd-field">
                    <label for="ev_guests">Guest Count</label>
                    <input class="cd-input" type="number" id="ev_guests" name="guest_count"
                           min="1" placeholder="e.g. 150">
                </div>
                <div class="cd-field">
                    <label for="ev_budget">Estimated Budget (₱)</label>
                    <input class="cd-input" type="number" id="ev_budget" name="budget"
                           min="0" placeholder="e.g. 150000">
                </div>
            </div>

            <hr class="cd-form-divider">
            <div class="cd-form-section-label">Additional Info</div>

            <div class="cd-field">
                <label for="ev_notes">Notes / Special Requests</label>
                <textarea class="cd-input" id="ev_notes" name="description"
                          placeholder="Any details, themes, or special requests…"></textarea>
            </div>

        </form>

        <div class="cd-modal-footer">
            <button type="button" class="cd-btn-cancel" onclick="closeEventModal()">Cancel</button>
            <button type="submit" form="createEventForm" class="cd-btn-submit">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
                    <line x1="10" y1="4" x2="10" y2="16"/><line x1="4" y1="10" x2="16" y2="10"/>
                </svg>
                <span>Create Event</span>
            </button>
        </div>

    </div>
</div>

<script>
    function openEventModal() {
        document.getElementById('eventModal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeEventModal() {
        document.getElementById('eventModal').classList.remove('open');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeEventModal();
    });

    // Set min date to today on the date picker
    document.getElementById('ev_date').min = new Date().toISOString().split('T')[0];
</script>

</x-client-layout>
