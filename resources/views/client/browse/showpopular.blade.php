<x-client-layout>
    <style>
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
            --green:       #16A34A;
            --green-light: #DCFCE7;
            --green-border:#BBF7D0;
            --font-display:'Playfair Display', Georgia, serif;
            --font-body:   'DM Sans', sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-body); background: var(--ivory); color: var(--charcoal); }

        /* ════════════ HERO ════════════ */
        .page-hero { background: var(--charcoal); padding: 3rem 3rem 2.75rem; position: relative; overflow: hidden; }
        .page-hero::before { content: ''; position: absolute; inset: 0; background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px); background-size: 20px 20px; pointer-events: none; }
        .page-hero::after  { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, var(--gold), transparent); pointer-events: none; }
        .hero-inner { position: relative; z-index: 1; max-width: 1200px; margin: 0 auto; display: flex; align-items: flex-end; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
        .hero-text { flex: 1; }
        .hero-eyebrow { font-size: 0.62rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--gold); font-weight: 500; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem; }
        .hero-eyebrow::before { content: ''; display: block; width: 18px; height: 1px; background: var(--gold); }
        .hero-inner h1 { font-family: var(--font-display); font-size: clamp(1.5rem, 3vw, 2.4rem); font-weight: 700; color: var(--white); line-height: 1.15; }
        .hero-inner h1 em { color: var(--gold-light); font-style: italic; }
        .hero-sub { font-size: 0.82rem; color: rgba(255,255,255,0.42); margin-top: 0.4rem; }
        .hero-back { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 1.1rem; border-radius: 4px; border: 1px solid rgba(201,168,76,0.35); color: rgba(255,255,255,0.65); font-size: 0.75rem; font-weight: 500; text-decoration: none; transition: border-color 0.2s, color 0.2s; white-space: nowrap; }
        .hero-back:hover { border-color: var(--gold); color: var(--gold-light); }
        .hero-back svg { width: 13px; height: 13px; }

        /* ════════════ MAIN LAYOUT ════════════ */
        .main-wrap { max-width: 1200px; margin: 0 auto; padding: 2.5rem 1.5rem 5rem; display: grid; grid-template-columns: 320px 1fr; gap: 2rem; align-items: start; }
        @media (max-width: 960px) { .main-wrap { grid-template-columns: 1fr; } }
        @media (max-width: 640px) { .main-wrap { padding: 1.5rem 1rem 4rem; } }

        /* ════════════ POPULAR PACKAGE CARD (sidebar) ════════════ */
        .popular-sidebar { position: sticky; top: 90px; }
        .popular-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 20px rgba(30,27,24,0.07);
        }
        .popular-card-head {
            padding: 1.25rem 1.4rem 1rem;
            border-bottom: 1px solid var(--border);
            position: relative;
            background: linear-gradient(135deg, rgba(201,168,76,0.04) 0%, transparent 60%);
        }
        .popular-card-head::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, var(--gold), var(--blush-deep)); }
        .popular-eyebrow { font-size: 0.58rem; font-weight: 700; letter-spacing: 0.16em; text-transform: uppercase; color: var(--gold-dark); margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.4rem; }
        .popular-eyebrow svg { width: 10px; height: 10px; }
        .popular-pkg-name { font-family: var(--font-display); font-size: 1.15rem; font-weight: 700; color: var(--charcoal); line-height: 1.2; margin-bottom: 0.5rem; }
        .popular-event-chip { display: inline-flex; align-items: center; gap: 0.3rem; font-size: 0.62rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; padding: 3px 10px; border-radius: 999px; background: rgba(201,168,76,0.1); color: var(--gold-dark); border: 1px solid rgba(201,168,76,0.28); }

        .popular-meta { display: flex; gap: 1.1rem; padding: 0.9rem 1.4rem; border-bottom: 1px solid var(--border); background: var(--ivory); }
        .popular-meta-item { display: flex; flex-direction: column; gap: 0.15rem; }
        .popular-meta-val { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--charcoal); }
        .popular-meta-lbl { font-size: 0.58rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); }

        .popular-card-body { padding: 1rem 1.4rem 1.25rem; }
        .incl-section-label { font-size: 0.58rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; color: var(--warm-grey); margin-bottom: 0.65rem; display: flex; align-items: center; gap: 0.45rem; }
        .incl-section-label::after { content: ''; flex: 1; height: 1px; background: linear-gradient(90deg, var(--border-md), transparent); }

        .popular-incl-list { display: flex; flex-direction: column; gap: 0.45rem; }
        .popular-incl-item { display: flex; align-items: center; gap: 0.6rem; padding: 0.5rem 0.75rem; border-radius: 6px; background: var(--ivory); border: 1px solid var(--border); }
        .popular-incl-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--gold); flex-shrink: 0; }
        .popular-incl-title { font-size: 0.8rem; color: var(--charcoal); flex: 1; line-height: 1.35; }
        .popular-incl-type { font-size: 0.58rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; padding: 2px 7px; border-radius: 999px; background: rgba(201,168,76,0.1); color: var(--gold-dark); border: 1px solid rgba(201,168,76,0.22); white-space: nowrap; flex-shrink: 0; }

        /* Type tags summary */
        .type-tags { display: flex; flex-wrap: wrap; gap: 0.4rem; padding: 0.9rem 1.4rem; border-top: 1px solid var(--border); }
        .type-tag { display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.62rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; padding: 3px 9px; border-radius: 999px; background: var(--charcoal); color: var(--gold-light); border: 1px solid rgba(201,168,76,0.22); }
        .type-tag svg { width: 8px; height: 8px; }

        /* ════════════ RESULTS SECTION ════════════ */
        .results-wrap { min-width: 0; }

        .results-head { display: flex; align-items: flex-end; justify-content: space-between; gap: 1rem; margin-bottom: 1.4rem; flex-wrap: wrap; }
        .results-title { font-family: var(--font-display); font-size: 1.2rem; font-weight: 700; color: var(--charcoal); line-height: 1.2; }
        .results-title em { font-style: italic; color: var(--gold-dark); }
        .results-count { font-size: 0.72rem; color: var(--warm-grey); background: var(--white); border: 1px solid var(--border-md); padding: 0.3rem 0.8rem; border-radius: 999px; white-space: nowrap; }

        /* filter tabs */
        .filter-row { display: flex; align-items: center; gap: 0.4rem; flex-wrap: wrap; margin-bottom: 1.35rem; }
        .filter-tab { padding: 0.38rem 1rem; border-radius: 20px; border: 1.5px solid var(--border-md); background: var(--white); font-family: var(--font-body); font-size: 0.73rem; font-weight: 500; color: var(--warm-grey); cursor: pointer; transition: all 0.2s; white-space: nowrap; }
        .filter-tab:hover { border-color: var(--gold); color: var(--gold-dark); }
        .filter-tab.active { background: var(--charcoal); border-color: var(--charcoal); color: var(--white); }

        /* ════════════ MATCHED PACKAGE CARDS ════════════ */
        .match-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
        @media (max-width: 760px) { .match-grid { grid-template-columns: 1fr; } }

        .match-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.22s, transform 0.22s, border-color 0.22s;
            animation: fadeUp 0.3s ease both;
        }
        .match-card:hover { box-shadow: 0 6px 28px rgba(30,27,24,0.11); transform: translateY(-2px); border-color: rgba(201,168,76,0.4); }
        .match-card.mc-hidden { display: none; }

        @keyframes fadeUp { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }

        /* Match score bar at top */
        .mc-score-bar { height: 3px; background: var(--border); }
        .mc-score-fill { height: 100%; background: linear-gradient(90deg, var(--gold), var(--blush-deep)); border-radius: 0 999px 999px 0; transition: width 0.6s ease; }

        .mc-head { padding: 1rem 1.1rem 0.75rem; border-bottom: 1px solid var(--border); position: relative; }
        .mc-supplier-row { display: flex; align-items: center; gap: 0.55rem; margin-bottom: 0.7rem; }
        .mc-avatar { width: 34px; height: 34px; border-radius: 50%; object-fit: cover; border: 2px solid var(--border); flex-shrink: 0; }
        .mc-avatar-init { width: 34px; height: 34px; border-radius: 50%; background: var(--charcoal); display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: 0.75rem; font-weight: 700; color: var(--gold); flex-shrink: 0; border: 2px solid var(--border); }
        .mc-supplier-info { flex: 1; min-width: 0; }
        .mc-supplier-name { font-size: 0.78rem; font-weight: 600; color: var(--charcoal); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .mc-supplier-loc { font-size: 0.65rem; color: var(--warm-grey); display: flex; align-items: center; gap: 0.2rem; margin-top: 1px; }
        .mc-supplier-loc svg { width: 9px; height: 9px; color: var(--gold-dark); flex-shrink: 0; }
        .mc-match-badge { display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.6rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; padding: 3px 8px; border-radius: 999px; background: var(--green-light); color: var(--green); border: 1px solid var(--green-border); white-space: nowrap; flex-shrink: 0; }
        .mc-match-badge svg { width: 9px; height: 9px; }

        .mc-pkg-name { font-family: var(--font-display); font-size: 0.92rem; font-weight: 700; color: var(--charcoal); line-height: 1.2; margin-bottom: 0.4rem; }
        .mc-price-event { display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap; }
        .mc-price { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--gold-dark); }
        .mc-event-chip { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; padding: 2px 8px; border-radius: 999px; background: rgba(201,168,76,0.09); color: var(--gold-dark); border: 1px solid rgba(201,168,76,0.22); }

        .mc-body { padding: 0.8rem 1.1rem; flex: 1; }
        .mc-incl-label { font-size: 0.57rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--warm-grey); margin-bottom: 0.45rem; }
        .mc-incl-list { display: flex; flex-direction: column; gap: 0.3rem; }
        .mc-incl-item { display: flex; align-items: flex-start; gap: 0.45rem; font-size: 0.76rem; color: var(--charcoal); line-height: 1.38; }
        .mc-incl-item svg { width: 11px; height: 11px; flex-shrink: 0; margin-top: 0.15rem; }
        .mc-incl-item.matched svg { color: var(--green); }
        .mc-incl-item.unmatched svg { color: var(--border-md); }
        .mc-match-tag { font-size: 0.55rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; padding: 1px 5px; border-radius: 3px; background: var(--green-light); color: var(--green); border: 1px solid var(--green-border); flex-shrink: 0; margin-left: auto; }

        .mc-foot { padding: 0.7rem 1.1rem; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; gap: 0.5rem; }
        .mc-duration { display: flex; align-items: center; gap: 0.25rem; font-size: 0.68rem; color: var(--warm-grey); }
        .mc-duration svg { width: 11px; height: 11px; color: var(--gold-dark); }
        .mc-guests { display: flex; align-items: center; gap: 0.25rem; font-size: 0.68rem; color: var(--warm-grey); }
        .mc-guests svg { width: 11px; height: 11px; color: var(--gold-dark); }

        /* ════════════ EMPTY STATE ════════════ */
        .empty-state { grid-column: 1 / -1; text-align: center; padding: 4rem 2rem; background: var(--white); border: 1.5px solid var(--border); border-radius: 14px; }
        .empty-state svg { width: 40px; height: 40px; color: rgba(201,168,76,0.35); margin: 0 auto 1rem; display: block; }
        .empty-state h3 { font-family: var(--font-display); font-size: 1.05rem; font-weight: 700; color: var(--charcoal); margin-bottom: 0.35rem; }
        .empty-state p { font-size: 0.8rem; color: var(--warm-grey); line-height: 1.6; }

        /* ════════════ FOOTER ════════════ */
        footer { background: var(--charcoal); border-top: 1px solid rgba(201,168,76,0.2); padding: 2.25rem 3rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
        .footer-brand { font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; color: var(--white); }
        .footer-brand span { color: var(--gold); font-style: italic; }
        .footer-links { display: flex; gap: 1.5rem; }
        .footer-links a { font-size: 0.78rem; color: rgba(255,255,255,0.4); text-decoration: none; transition: color 0.2s; }
        .footer-links a:hover { color: var(--gold-light); }
        .footer-copy { font-size: 0.75rem; color: rgba(255,255,255,0.28); }
        @media (max-width: 640px) { footer { padding: 2rem 1.25rem; } }
    </style>

{{-- ── PAGE HERO ── --}}
<div class="page-hero">
    <div class="hero-inner">
        <div class="hero-text">
            <div class="hero-eyebrow">Package Match</div>
            <h1>{{ $popular->name }}<br><em>Matched Suppliers</em></h1>
            <p class="hero-sub">
                Supplier packages that match the inclusions in this curated package.
            </p>
        </div>
        <a href="{{ route('client.browse.suppliers') }}" class="hero-back">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 3L5 7l4 4"/></svg>
            Back to Packages
        </a>
    </div>
</div>

{{-- ── MAIN CONTENT ── --}}
<div class="main-wrap">

    {{-- ════ LEFT: POPULAR PACKAGE SIDEBAR ════ --}}
    <aside class="popular-sidebar">
        <div class="popular-card">

            {{-- Head --}}
            <div class="popular-card-head">
                <div class="popular-eyebrow">
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M6 1l1.35 2.73L10.5 4.2 8.25 6.4l.525 3.1L6 7.98 3.225 9.5l.525-3.1L1.5 4.2l3.15-.47z"/>
                    </svg>
                    Popular Package
                </div>
                <div class="popular-pkg-name">{{ $popular->name }}</div>
                @if($popular->event_type)
                    <span class="popular-event-chip">{{ $popular->event_type }}</span>
                @endif
            </div>

            {{-- Meta: price / guests / hours --}}
            @if($popular->price || $popular->guest_capacity || $popular->duration_hours)
            <div class="popular-meta">
                @if($popular->price)
                <div class="popular-meta-item">
                    <div class="popular-meta-val">₱{{ number_format($popular->price, 0) }}</div>
                    <div class="popular-meta-lbl">Price</div>
                </div>
                @endif
                @if($popular->guest_capacity)
                <div class="popular-meta-item">
                    <div class="popular-meta-val">{{ number_format($popular->guest_capacity) }}</div>
                    <div class="popular-meta-lbl">Guests</div>
                </div>
                @endif
                @if($popular->duration_hours)
                <div class="popular-meta-item">
                    <div class="popular-meta-val">{{ $popular->duration_hours }}h</div>
                    <div class="popular-meta-lbl">Duration</div>
                </div>
                @endif
            </div>
            @endif

            {{-- Inclusions list --}}
            <div class="popular-card-body">
                <div class="incl-section-label">Inclusions</div>
                @if($popular->inclusions->count())
                <div class="popular-incl-list">
                    @foreach($popular->inclusions as $inc)
                    <div class="popular-incl-item">
                        <span class="popular-incl-dot"></span>
                        <span class="popular-incl-title">{{ $inc->title }}</span>
                        @if($inc->type)
                            <span class="popular-incl-type">{{ $inc->type }}</span>
                        @endif
                    </div>
                    @endforeach
                </div>
                @else
                    <p style="font-size:0.8rem;color:var(--warm-grey);">No inclusions listed.</p>
                @endif
            </div>

            {{-- Type tags ─ what we're matching against --}}
            @if(!empty($targetTypes))
            <div class="type-tags">
                @foreach($targetTypes as $t)
                <span class="type-tag">
                    <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 5l2 2 4-4"/></svg>
                    {{ ucfirst($t) }}
                </span>
                @endforeach
            </div>
            @endif

        </div>{{-- /popular-card --}}
    </aside>

    {{-- ════ RIGHT: MATCHED RESULTS ════ --}}
    <div class="results-wrap">

        <div class="results-head">
            <div>
                <div class="results-title">Matching <em>Supplier Packages</em></div>
            </div>
            <span class="results-count" id="matchCount">
                {{ $matchedPackages->count() }} {{ Str::plural('result', $matchedPackages->count()) }}
            </span>
        </div>

        {{-- Filter tabs by matched type --}}
        @if($matchedPackages->count() > 0)
        <div class="filter-row">
            <button class="filter-tab active" onclick="filterCards(this, 'all')">All</button>
            @foreach($targetTypes as $t)
                <button class="filter-tab" onclick="filterCards(this, '{{ $t }}')">
                    {{ ucfirst($t) }}
                </button>
            @endforeach
        </div>
        @endif

        {{-- Match cards grid --}}
        <div class="match-grid" id="matchGrid">

            @forelse($matchedPackages as $idx => $package)
            @php
                /* count how many inclusions match a target type */
                $matchCount = $package->inclusions->filter(
                    fn($inc) => in_array(strtolower(trim($inc->type ?? '')), $targetTypes)
                )->count();
                $totalInc   = $package->inclusions->count();
                $matchPct   = $totalInc > 0 ? round(($matchCount / max($totalInc, count($targetTypes))) * 100) : 0;
                $matchPct   = min($matchPct, 100);

                /* data-types: pipe-separated list of matched types for JS filtering */
                $cardTypes = $package->inclusions
                    ->filter(fn($inc) => in_array(strtolower(trim($inc->type ?? '')), $targetTypes))
                    ->pluck('type')
                    ->map(fn($t) => strtolower(trim($t)))
                    ->unique()
                    ->implode('|');
            @endphp
            <div class="match-card"
                 data-types="{{ $cardTypes }}"
                 style="animation-delay: {{ $idx * 0.05 }}s;">

                {{-- Match score bar --}}
                <div class="mc-score-bar">
                    <div class="mc-score-fill" style="width: {{ $matchPct }}%;"></div>
                </div>

                {{-- Card head --}}
                <div class="mc-head">

                    {{-- Supplier row --}}
                    @if($package->supplier ?? null)
                    <div class="mc-supplier-row">
                        @if($package->supplier->photo)
                            <img class="mc-avatar"
                                 src="{{ asset('storage/' . $package->supplier->photo) }}"
                                 alt="{{ $package->supplier->business_name }}">
                        @else
                            <div class="mc-avatar-init">
                                {{ strtoupper(substr($package->supplier->business_name ?? 'S', 0, 1)) }}
                            </div>
                        @endif
                        <div class="mc-supplier-info">
                            <div class="mc-supplier-name">{{ $package->supplier->business_name }}</div>
                            @if($package->supplier->city || $package->supplier->province)
                            <div class="mc-supplier-loc">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M8 1.5C5.51 1.5 3.5 3.51 3.5 6c0 3.5 4.5 8.5 4.5 8.5S12.5 9.5 12.5 6c0-2.49-2.01-4.5-4.5-4.5z"/>
                                    <circle cx="8" cy="6" r="1.5"/>
                                </svg>
                                {{ collect([$package->supplier->city, $package->supplier->province])->filter()->implode(', ') }}
                            </div>
                            @endif
                        </div>
                        <span class="mc-match-badge">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M2 6l3 3 5-5"/>
                            </svg>
                            {{ $matchCount }} match{{ $matchCount !== 1 ? 'es' : '' }}
                        </span>
                    </div>
                    @endif

                    {{-- Package name + price --}}
                    <div class="mc-pkg-name">{{ $package->name }}</div>
                    <div class="mc-price-event">
                        @if($package->event_type)
                            <span class="mc-event-chip">{{ $package->event_type }}</span>
                        @endif
                    </div>

                </div>{{-- /mc-head --}}

                {{-- Inclusions --}}
                <div class="mc-body">
                    @if($package->inclusions->count())
                    <div class="mc-incl-label">Inclusions</div>
                    <div class="mc-incl-list">
                        @foreach($package->inclusions as $inc)
                        @php
                            $isMatch = in_array(strtolower(trim($inc->type ?? '')), $targetTypes);
                        @endphp
                        <div class="mc-incl-item {{ $isMatch ? 'matched' : 'unmatched' }}">
                            @if($isMatch)
                                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M2 6l3 3 5-5"/></svg>
                            @else
                                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2"><circle cx="6" cy="6" r="5"/><path d="M4 6h4"/></svg>
                            @endif
                            <span>{{ $inc->title }}</span>
                            @if($inc->type)
                                <span style="font-size:0.6rem;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;padding:1px 5px;border-radius:3px;background:{{ $isMatch ? 'var(--green-light)' : 'var(--ivory)' }};color:{{ $isMatch ? 'var(--green)' : 'var(--warm-grey)' }};border:1px solid {{ $isMatch ? 'var(--green-border)' : 'var(--border-md)' }};flex-shrink:0;margin-left:auto;white-space:nowrap;">
                                    {{ ucfirst($inc->type) }}
                                </span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- Footer --}}
                <div class="mc-foot">
                    <div style="display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap;">
                        @if($package->duration_hours)
                        <span class="mc-duration">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <circle cx="8" cy="8" r="6.5"/><path d="M8 4.5v4l2.5 1.5"/>
                            </svg>
                            {{ $package->duration_hours }}h
                        </span>
                        @endif
                        @if($package->guest_capacity)
                        <span class="mc-guests">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <circle cx="6" cy="5" r="2.5"/>
                                <path d="M1.5 14c0-2.5 2-4.5 4.5-4.5s4.5 2 4.5 4.5"/>
                                <circle cx="12" cy="5" r="2"/>
                                <path d="M14.5 13.5c0-1.93-1.34-3.5-3-3.5"/>
                            </svg>
                            {{ number_format($package->guest_capacity) }} guests
                        </span>
                        @endif
                    </div>
                    <a href="{{ route('client.show.supplier', $package->supplier->id) }}" class="pp-view-btn" style="display:inline-flex;align-items:center;gap:0.3rem;padding:0.38rem 0.85rem;border-radius:6px;border:1.5px solid var(--border-md);background:var(--white);font-family:var(--font-body);font-size:0.72rem;font-weight:500;color:var(--charcoal);text-decoration:none;transition:border-color 0.2s,background 0.2s,color 0.2s;white-space:nowrap;">
                        View
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 6h8M7 3l3 3-3 3"/></svg>
                    </a>
                </div>

            </div>{{-- /match-card --}}
            @empty
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                </svg>
                <h3>No Matching Packages Found</h3>
                <p>No supplier packages match the inclusion types of this popular package yet.<br>Check back soon as suppliers add more offerings.</p>
            </div>
            @endforelse

        </div>{{-- /match-grid --}}

        {{-- JS no-results placeholder --}}
        <div id="filterEmpty" style="display:none;" class="empty-state" style="margin-top:1rem;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
            </svg>
            <h3>No Packages for this Type</h3>
            <p>Try selecting a different inclusion type above.</p>
        </div>

    </div>{{-- /results-wrap --}}

</div>{{-- /main-wrap --}}

<script>
    /* ── NAV ── */
    const hamburger  = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');
    hamburger.addEventListener('click', () => {
        const open = mobileMenu.classList.toggle('open');
        hamburger.classList.toggle('open', open);
        document.body.style.overflow = open ? 'hidden' : '';
    });
    document.addEventListener('click', e => {
        if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) {
            mobileMenu.classList.remove('open');
            hamburger.classList.remove('open');
            document.body.style.overflow = '';
        }
    });
    function closeMenu() {
        mobileMenu.classList.remove('open');
        hamburger.classList.remove('open');
        document.body.style.overflow = '';
    }

    /* ── FILTER TABS ── */
    function filterCards(btn, type) {
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
        btn.classList.add('active');

        const cards  = document.querySelectorAll('#matchGrid .match-card');
        const empty  = document.getElementById('filterEmpty');
        const count  = document.getElementById('matchCount');
        let visible  = 0;

        cards.forEach(card => {
            const types = (card.dataset.types || '').split('|').filter(Boolean);
            const show  = type === 'all' || types.includes(type);
            card.classList.toggle('mc-hidden', !show);
            if (show) visible++;
        });

        if (count) count.textContent = visible + ' ' + (visible === 1 ? 'result' : 'results');
        if (empty) empty.style.display = (visible === 0) ? 'block' : 'none';
    }
</script>
</x-client-layout>