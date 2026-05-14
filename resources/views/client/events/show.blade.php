{{-- resources/views/client/recommendations/index.blade.php --}}
<x-client-layout>

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
        --font-d:     'Playfair Display', Georgia, serif;
        --font-b:     'DM Sans', sans-serif;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: var(--font-b); color: var(--charcoal); background: #F4F0EA; }

    .ai-wrap {
        max-width: 1140px;
        margin: 0 auto;
        padding: 2rem 1.25rem 4rem;
        display: grid;
        grid-template-columns: 260px 1fr;
        gap: 1.75rem;
        align-items: start;
    }

    /* ── ALERTS ── */
    .ai-alert {
        display: flex; align-items: center; gap: .65rem;
        padding: .9rem 1.15rem; border-radius: 10px;
        font-size: .8rem; font-weight: 500;
        margin-bottom: 1.25rem; border: 1.5px solid;
        grid-column: 1/-1;
        animation: aiFade .3s ease;
    }
    @keyframes aiFade{from{opacity:0;transform:translateY(-6px);}to{opacity:1;transform:translateY(0);}}
    .ai-alert svg { width:15px; height:15px; flex-shrink:0; }
    .ai-alert.success { background:#F0FBF4; border-color:#A8D5B5; color:#1E6B3C; }
    .ai-alert.error   { background:#FFF5F5; border-color:#FADBD8; color:var(--danger); }

    /* ══════════════════════════════════
       SIDEBAR
    ══════════════════════════════════ */
    .ai-sidebar { display: flex; flex-direction: column; gap: 1.1rem; position: sticky; top: 1.5rem; }

    /* Event card */
    .ai-event-card {
        background: linear-gradient(135deg, var(--charcoal) 0%, #2a2016 55%, #3d2f14 100%);
        border-radius: 14px;
        padding: 1.5rem 1.35rem;
        position: relative; overflow: hidden;
        box-shadow: 0 4px 18px rgba(30,27,24,.16);
    }
    .ai-event-card::before {
        content:'';
        position:absolute;inset:0;
        background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23C9A84C' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
        pointer-events:none;
    }
    .ai-event-badge {
        display: inline-flex; align-items: center; gap: .38rem;
        padding: .22rem .72rem; border-radius: 999px;
        background: rgba(201,168,76,.18);
        border: 1px solid rgba(201,168,76,.3);
        font-size: .62rem; font-weight: 700;
        letter-spacing: .08em; text-transform: uppercase;
        color: var(--gold); margin-bottom: .75rem;
    }
    .ai-event-badge::before { content:''; width:5px; height:5px; border-radius:50%; background:var(--gold); animation:aiPulse 2s ease-in-out infinite; }
    @keyframes aiPulse{0%,100%{opacity:1;transform:scale(1);}50%{opacity:.5;transform:scale(.75);}}
    .ai-event-name {
        font-family: var(--font-d);
        font-size: 1.1rem; font-weight: 700; color: var(--white);
        line-height: 1.25; margin-bottom: .35rem;
    }
    .ai-event-type {
        font-size: .72rem; color: rgba(255,255,255,.58);
        font-weight: 500; letter-spacing: .04em;
    }
    .ai-event-divider { border: none; border-top: 1px solid rgba(255,255,255,.1); margin: 1rem 0; }
    .ai-event-meta { display: flex; flex-direction: column; gap: .5rem; }
    .ai-event-meta-row {
        display: flex; align-items: center; gap: .5rem;
        font-size: .72rem; color: rgba(255,255,255,.65);
    }
    .ai-event-meta-row svg { width: 12px; height: 12px; color: var(--gold); flex-shrink: 0; }

    /* Stat cards */
    .ai-stat-card {
        background: var(--white);
        border-radius: 12px;
        border: 1px solid var(--border);
        padding: 1.1rem 1.25rem;
        box-shadow: 0 1px 4px rgba(30,27,24,.05);
        display: flex; align-items: center; gap: .9rem;
        cursor: pointer;
        transition: border-color .2s, box-shadow .2s, transform .15s;
        text-decoration: none;
    }
    .ai-stat-card:hover {
        border-color: var(--gold);
        box-shadow: 0 4px 14px rgba(201,168,76,.14);
        transform: translateY(-1px);
    }
    .ai-stat-card.active { border-color: var(--gold); background: rgba(201,168,76,.05); }
    .ai-stat-icon {
        width: 42px; height: 42px; border-radius: 10px; flex-shrink: 0;
        background: var(--gold-light);
        display: flex; align-items: center; justify-content: center;
        color: var(--gold-dark);
    }
    .ai-stat-icon svg { width: 18px; height: 18px; }
    .ai-stat-info { flex: 1; min-width: 0; }
    .ai-stat-label { font-size: .68rem; color: var(--warm-grey); font-weight: 500; margin-bottom: .18rem; }
    .ai-stat-count {
        font-family: var(--font-d);
        font-size: 1.5rem; font-weight: 700; color: var(--charcoal); line-height: 1;
    }
    .ai-stat-sub { font-size: .64rem; color: var(--warm-grey); margin-top: .18rem; }

    /* AI badge */
    .ai-powered-badge {
        display: flex; align-items: center; gap: .55rem;
        padding: .75rem 1rem;
        background: var(--white);
        border-radius: 10px; border: 1px solid var(--border);
        font-size: .7rem; color: var(--warm-grey); line-height: 1.45;
        box-shadow: 0 1px 4px rgba(30,27,24,.04);
    }
    .ai-powered-badge-icon {
        width: 32px; height: 32px; border-radius: 8px; flex-shrink: 0;
        background: linear-gradient(135deg, #6B3FA0, #A0522D);
        display: flex; align-items: center; justify-content: center;
    }
    .ai-powered-badge-icon svg { width: 15px; height: 15px; color: var(--white); }

    /* ══════════════════════════════════
       MAIN CONTENT
    ══════════════════════════════════ */
    .ai-main { display: flex; flex-direction: column; gap: 2rem; }

    /* Section header */
    .ai-sec-head {
        display: flex; align-items: flex-end; justify-content: space-between;
        margin-bottom: 1.15rem; flex-wrap: wrap; gap: .65rem;
    }
    .ai-sec-title { font-family: var(--font-d); font-size: 1.25rem; font-weight: 700; color: var(--charcoal); }
    .ai-sec-title em { font-style: italic; color: var(--gold-dark); }
    .ai-sec-sub { font-size: .74rem; color: var(--warm-grey); margin-top: .18rem; }
    .ai-count-pill {
        display: inline-flex; align-items: center; gap: .35rem;
        padding: .26rem .82rem; border-radius: 999px;
        background: var(--gold-light); color: var(--gold-dark);
        font-size: .7rem; font-weight: 700;
    }
    .ai-count-pill::before { content:''; width:5px; height:5px; border-radius:50%; background:var(--gold); }

    /* Section anchor target offset */
    .ai-sec-anchor { scroll-margin-top: 1.5rem; }

    /* ── CARD GRID ── */
    .ai-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.1rem;
    }

    /* ── PACKAGE CARD ── */
    .ai-card {
        background: var(--white);
        border-radius: 14px;
        border: 1px solid var(--border);
        overflow: hidden;
        display: flex; flex-direction: column;
        box-shadow: 0 1px 6px rgba(30,27,24,.06);
        transition: border-color .2s, box-shadow .2s, transform .18s;
    }
    .ai-card:hover {
        border-color: rgba(201,168,76,.4);
        box-shadow: 0 6px 22px rgba(30,27,24,.1);
        transform: translateY(-2px);
    }

    /* Card top */
    .ai-card-top {
        padding: 1.15rem 1.2rem .85rem;
        flex: 1;
    }
    .ai-card-supplier {
        font-size: .62rem; font-weight: 700;
        letter-spacing: .09em; text-transform: uppercase;
        color: var(--gold-dark); margin-bottom: .3rem;
    }
    .ai-card-name {
        font-family: var(--font-d);
        font-size: .98rem; font-weight: 700; color: var(--charcoal);
        line-height: 1.25; margin-bottom: .65rem;
    }

    /* Score badge */
    .ai-score {
        display: inline-flex; align-items: center; gap: .38rem;
        padding: .22rem .7rem; border-radius: 999px;
        background: rgba(39,174,96,.1);
        border: 1px solid rgba(39,174,96,.2);
        font-size: .64rem; font-weight: 700; color: #1E6B3C;
        margin-bottom: .85rem;
    }
    .ai-score svg { width: 10px; height: 10px; color: #27AE60; }

    /* Inclusions */
    .ai-inc { list-style: none; display: flex; flex-direction: column; gap: .3rem; margin-bottom: .85rem; }
    .ai-inc li {
        display: flex; align-items: flex-start; gap: .4rem;
        font-size: .74rem; color: var(--charcoal); line-height: 1.4;
    }
    .ai-inc li::before {
        content:'';
        width:14px; height:14px; border-radius:50%; flex-shrink:0;
        background: var(--gold-light)
            url("data:image/svg+xml,%3Csvg viewBox='0 0 10 10' fill='none' stroke='%23A8842A' stroke-width='2' xmlns='http://www.w3.org/2000/svg'%3E%3Cpolyline points='2 5 4.5 7.5 8 3'/%3E%3C/svg%3E")
            center / 9px no-repeat;
        border:1px solid rgba(201,168,76,.28);
        margin-top:.1rem;
    }

    /* Bundle items */
    .ai-bundle-item {
        display: flex; align-items: flex-start; gap: .5rem;
        font-size: .74rem; color: var(--charcoal); line-height: 1.4;
        padding: .35rem 0;
        border-bottom: 1px solid var(--soft);
    }
    .ai-bundle-item:last-child { border-bottom: none; }
    .ai-bundle-dot {
        width: 8px; height: 8px; border-radius: 50%;
        background: var(--gold); flex-shrink: 0; margin-top: .35rem;
    }
    .ai-bundle-supplier { font-size: .63rem; color: var(--warm-grey); }

    .ai-bundle-list { margin-bottom: .85rem; }

    /* Card footer */
    .ai-card-foot {
        display: flex; align-items: center; justify-content: space-between;
        padding: .85rem 1.2rem;
        border-top: 1px solid var(--soft);
        background: var(--ivory);
    }
    .ai-price {
        font-family: var(--font-d);
        font-size: 1.05rem; font-weight: 700; color: var(--charcoal);
    }
    .ai-price small { font-family:var(--font-b); font-size:.68rem; font-weight:400; color:var(--warm-grey); margin-left:.25rem; }

    .ai-book-btn {
        display: inline-flex; align-items: center; gap: .4rem;
        padding: .5rem 1.1rem;
        border-radius: 8px; border: none;
        background: var(--charcoal);
        font-family: var(--font-b); font-size: .76rem; font-weight: 600;
        color: var(--white); cursor: pointer;
        transition: background .22s, box-shadow .22s, transform .15s;
        white-space: nowrap;
    }
    .ai-book-btn svg { width: 12px; height: 12px; }
    .ai-book-btn:hover {
        background: var(--gold-dark);
        box-shadow: 0 4px 12px rgba(168,132,42,.28);
        transform: translateY(-1px);
    }

    /* empty state */
    .ai-empty {
        grid-column: 1/-1;
        text-align: center;
        padding: 3rem 1.5rem;
        background: var(--white);
        border-radius: 14px;
        border: 1.5px dashed var(--border);
    }
    .ai-empty-ico {
        width: 50px; height: 50px; border-radius: 50%;
        background: var(--gold-light);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto .85rem; color: var(--gold-dark);
    }
    .ai-empty-ico svg { width: 20px; height: 20px; }
    .ai-empty-title { font-family:var(--font-d); font-size:.95rem; font-weight:700; color:var(--charcoal); margin-bottom:.3rem; }
    .ai-empty-sub   { font-size:.76rem; color:var(--warm-grey); line-height:1.6; }

    /* section divider */
    .ai-divider {
        height: 1px; background: var(--border);
        margin: .25rem 0;
    }

    @media (max-width: 860px) {
        .ai-wrap { grid-template-columns: 1fr; }
        .ai-sidebar { position: static; flex-direction: row; flex-wrap: wrap; }
        .ai-event-card { flex: 1 1 100%; }
        .ai-stat-card  { flex: 1 1 calc(50% - .55rem); }
        .ai-powered-badge { flex: 1 1 100%; }
        .ai-alert { grid-column: 1; }
    }
    @media (max-width: 520px) {
        .ai-stat-card { flex: 1 1 100%; }
        .ai-grid { grid-template-columns: 1fr; }
    }
</style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('AI Recommendations') }}</h2>
    </x-slot>

    <div class="ai-wrap">

        {{-- ── ALERTS ── --}}
        @if(session('success'))
        <div class="ai-alert success">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="2 8 6 12 14 4"/></svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="ai-alert error">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="8" cy="8" r="6"/>
                <line x1="8" y1="5" x2="8" y2="8"/>
                <circle cx="8" cy="11" r=".6" fill="currentColor" stroke="none"/>
            </svg>
            {{ session('error') }}
        </div>
        @endif

        {{-- ══════════════════════════════════
             SIDEBAR
        ══════════════════════════════════ --}}
        <aside class="ai-sidebar">

            {{-- Event info --}}
            <div class="ai-event-card">
                <div class="ai-event-badge">Your Event</div>
                <div class="ai-event-name">{{ $event->event_name }}</div>
                <div class="ai-event-type">{{ $event->event_type }}</div>
                <hr class="ai-event-divider">
                <div class="ai-event-meta">
                    @if(!empty($event->event_date))
                    <div class="ai-event-meta-row">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="2" y="3" width="12" height="11" rx="2"/>
                            <path d="M5 2v2M11 2v2M2 7h12"/>
                        </svg>
                        {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}
                    </div>
                    @endif
                    @if(!empty($event->location))
                    <div class="ai-event-meta-row">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M8 2C5.8 2 4 3.8 4 6c0 3.5 4 8 4 8s4-4.5 4-8c0-2.2-1.8-4-4-4z"/>
                            <circle cx="8" cy="6" r="1.5"/>
                        </svg>
                        {{ $event->location }}
                    </div>
                    @endif
                    @if(!empty($event->guest_count))
                    <div class="ai-event-meta-row">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="6" cy="5" r="2.5"/>
                            <circle cx="11" cy="5" r="2"/>
                            <path d="M1 13c0-2.8 2.2-5 5-5s5 2.2 5 5"/>
                            <path d="M11 8c1.7.3 3 1.8 3 3.5"/>
                        </svg>
                        {{ $event->guest_count }} guests
                    </div>
                    @endif
                </div>
            </div>

            {{-- Supplier packages count --}}
            <a href="#supplier-section" class="ai-stat-card" id="statSupplier">
                <div class="ai-stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <rect x="2" y="7" width="20" height="14" rx="2"/>
                        <path d="M16 7V5a4 4 0 00-8 0v2"/>
                    </svg>
                </div>
                <div class="ai-stat-info">
                    <div class="ai-stat-label">Supplier Packages</div>
                    <div class="ai-stat-count">{{ count($supplierPackages) }}</div>
                    <div class="ai-stat-sub">AI-matched for your event</div>
                </div>
            </a>

            {{-- Popular bundles count --}}
            <a href="#bundle-section" class="ai-stat-card" id="statBundle">
                <div class="ai-stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                        <line x1="12" y1="22.08" x2="12" y2="12"/>
                    </svg>
                </div>
                <div class="ai-stat-info">
                    <div class="ai-stat-label">Bundle Packages</div>
                    <div class="ai-stat-count">{{ count($popularPackages) }}</div>
                    <div class="ai-stat-sub">Popular curated bundles</div>
                </div>
            </a>

            {{-- AI note --}}
            <div class="ai-powered-badge">
                <div class="ai-powered-badge-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                        <path d="M2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <span>Recommendations are AI-ranked based on your event type, date, and guest count.</span>
            </div>

        </aside>

        {{-- ══════════════════════════════════
             MAIN CONTENT
        ══════════════════════════════════ --}}
        <main class="ai-main">

            {{-- ── SUPPLIER PACKAGES ── --}}
            <section id="supplier-section" class="ai-sec-anchor">
                <div class="ai-sec-head">
                    <div>
                        <h2 class="ai-sec-title">Supplier <em>Packages</em></h2>
                        <p class="ai-sec-sub">Individual packages matched to your event</p>
                    </div>
                    <span class="ai-count-pill">{{ count($supplierPackages) }} found</span>
                </div>

                <div class="ai-grid">
                    @forelse($supplierPackages as $package)
                    <div class="ai-card">
                        <div class="ai-card-top">
                            <div class="ai-card-supplier">
                                {{ $package->supplier->business_name ?? ($package->supplier->first_name ?? 'Unknown Supplier') }}
                            </div>
                            <div class="ai-card-name">{{ $package->name }}</div>

                            @if(!empty($package->score))
                            <div class="ai-score">
                                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="2 6 5 9 10 3"/>
                                </svg>
                                Match score: {{ $package->score }}
                            </div>
                            @endif

                            @if($package->inclusions && count($package->inclusions) > 0)
                            <ul class="ai-inc">
                                @foreach($package->inclusions as $inc)
                                <li>{{ is_object($inc) ? $inc->title : $inc }}</li>
                                @endforeach
                            </ul>
                            @endif
                        </div>

                        <div class="ai-card-foot">
                            <div class="ai-price">
                                ₱{{ number_format($package->price, 2) }}
                                <small>/ package</small>
                            </div>
                            <form action="{{ route('bookings.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="event_id"   value="{{ $event->id }}">
                                <input type="hidden" name="package_id" value="{{ $package->id }}">
                                <button type="submit" class="ai-book-btn">
                                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 7l3 3 5-5"/>
                                    </svg>
                                    Book
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="ai-empty">
                        <div class="ai-empty-ico">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="2" y="7" width="20" height="14" rx="2"/>
                                <path d="M16 7V5a4 4 0 00-8 0v2"/>
                            </svg>
                        </div>
                        <div class="ai-empty-title">No supplier packages found</div>
                        <div class="ai-empty-sub">We couldn't find matching packages for this event type yet.</div>
                    </div>
                    @endforelse
                </div>
            </section>

            <div class="ai-divider"></div>

            {{-- ── POPULAR BUNDLE PACKAGES ── --}}
            <section id="bundle-section" class="ai-sec-anchor">
                <div class="ai-sec-head">
                    <div>
                        <h2 class="ai-sec-title">Popular <em>Bundles</em></h2>
                        <p class="ai-sec-sub">Curated all-in-one packages for your event</p>
                    </div>
                    <span class="ai-count-pill">{{ count($popularPackages) }} found</span>
                </div>

                <div class="ai-grid">
                    @forelse($popularPackages as $bundle)
                    <div class="ai-card">
                        <div class="ai-card-top">
                            <div class="ai-card-supplier">{{ $bundle->event_type }}</div>
                            <div class="ai-card-name">{{ $bundle->name }}</div>

                            @if(!empty($bundle->score))
                            <div class="ai-score">
                                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="2 6 5 9 10 3"/>
                                </svg>
                                Match score: {{ $bundle->score }}
                            </div>
                            @endif

                            @if($bundle->items && count($bundle->items) > 0)
                            <div class="ai-bundle-list">
                                @foreach($bundle->items as $item)
                                <div class="ai-bundle-item">
                                    <div class="ai-bundle-dot"></div>
                                    <div>
                                        <div>{{ $item->package->name ?? 'Package' }}</div>
                                        <div class="ai-bundle-supplier">{{ $item->supplier->business_name ?? 'Supplier' }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        <div class="ai-card-foot">
                            <div class="ai-price">
                                ₱{{ number_format($bundle->price, 2) }}
                                <small>/ bundle</small>
                            </div>
                            <form action="{{ route('bookings.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="event_id"          value="{{ $event->id }}">
                                <input type="hidden" name="popular_package_id" value="{{ $bundle->id }}">
                                <button type="submit" class="ai-book-btn">
                                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 7l3 3 5-5"/>
                                    </svg>
                                    Book Bundle
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="ai-empty">
                        <div class="ai-empty-ico">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/>
                            </svg>
                        </div>
                        <div class="ai-empty-title">No bundle packages found</div>
                        <div class="ai-empty-sub">No popular bundles match this event type yet.</div>
                    </div>
                    @endforelse
                </div>
            </section>

        </main>

    </div>{{-- /ai-wrap --}}

<script>
    /* Highlight active sidebar stat card on scroll */
    const sections = [
        { id: 'supplier-section', stat: 'statSupplier' },
        { id: 'bundle-section',   stat: 'statBundle'   },
    ];

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const match = sections.find(s => s.id === entry.target.id);
                if (!match) return;
                sections.forEach(s => document.getElementById(s.stat)?.classList.remove('active'));
                document.getElementById(match.stat)?.classList.add('active');
            }
        });
    }, { threshold: 0.35 });

    sections.forEach(s => {
        const el = document.getElementById(s.id);
        if (el) observer.observe(el);
    });
</script>

</x-client-layout>