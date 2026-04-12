<x-client-layout>

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

    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: var(--font-body); background: var(--ivory); color: var(--charcoal); }

    /* ── Page wrap ── */
    .ai-wrap { max-width: 860px; margin: 0 auto; padding: 2rem 1.25rem 4rem; }

    /* ══════════════════════════════
       AI HEADER BANNER
    ══════════════════════════════ */
    .ai-header {
        background: var(--charcoal);
        border-radius: 14px;
        padding: 1.5rem 1.75rem;
        margin-bottom: 1.5rem;
        position: relative; overflow: hidden;
    }
    .ai-header::before {
        content: '';
        position: absolute; inset: 0;
        background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px);
        background-size: 20px 20px; pointer-events: none;
    }
    .ai-header::after {
        content: '';
        position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }
    .ai-eyebrow {
        font-size: 0.6rem; letter-spacing: 0.2em; text-transform: uppercase;
        color: var(--gold); font-weight: 500; margin-bottom: 0.35rem;
        display: flex; align-items: center; gap: 0.45rem; font-family: var(--font-body);
        position: relative; z-index: 1;
    }
    .ai-eyebrow::before { content: ''; width: 14px; height: 1px; background: var(--gold); }
    .ai-eyebrow svg { width: 11px; height: 11px; }
    .ai-header h1 {
        font-family: var(--font-display);
        font-size: clamp(1.3rem, 2.5vw, 1.8rem);
        font-weight: 700; color: var(--white); line-height: 1.15;
        position: relative; z-index: 1;
    }
    .ai-header h1 em { color: var(--gold-light); font-style: italic; }
    .ai-meta {
        display: flex; align-items: center; gap: 0.85rem;
        margin-top: 0.75rem; flex-wrap: wrap;
        position: relative; z-index: 1;
    }
    .ai-meta-chip {
        display: inline-flex; align-items: center; gap: 0.35rem;
        padding: 4px 10px; border-radius: 999px; font-size: 0.7rem; font-weight: 500;
        background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.75);
        border: 1px solid rgba(255,255,255,0.15); font-family: var(--font-body);
    }
    .ai-meta-chip svg { width: 12px; height: 12px; }
    .ai-badge-ai {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 3px 10px; border-radius: 999px;
        font-size: 0.65rem; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase;
        background: rgba(201,168,76,0.15); color: var(--gold-light);
        border: 1px solid rgba(201,168,76,0.3); font-family: var(--font-body);
    }
    .ai-badge-ai svg { width: 11px; height: 11px; }

    /* ══════════════════════════════
       EMPTY STATE
    ══════════════════════════════ */
    .ai-empty {
        text-align: center; padding: 4rem 2rem;
        background: var(--white); border: 1px solid var(--border); border-radius: 12px;
    }
    .ai-empty-icon {
        width: 56px; height: 56px; border-radius: 50%;
        background: rgba(201,168,76,0.08);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 0.9rem; color: var(--gold-dark);
    }
    .ai-empty-icon svg { width: 26px; height: 26px; }
    .ai-empty h3 {
        font-family: var(--font-display); font-size: 1rem; font-weight: 700;
        color: var(--charcoal); margin-bottom: 0.3rem;
    }
    .ai-empty p { font-size: 0.78rem; color: var(--warm-grey); line-height: 1.6; }

    /* ══════════════════════════════
       RECOMMENDATION CARDS
    ══════════════════════════════ */
    .rec-list { display: flex; flex-direction: column; gap: 1rem; }

    .rec-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px; overflow: hidden;
        position: relative;
        animation: cardIn .3s ease both;
    }
    .rec-card.top-pick { border: 2px solid var(--gold); }
    @keyframes cardIn {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    /* Stagger each card */
    .rec-card:nth-child(1) { animation-delay: 0s; }
    .rec-card:nth-child(2) { animation-delay: .07s; }
    .rec-card:nth-child(3) { animation-delay: .14s; }
    .rec-card:nth-child(4) { animation-delay: .21s; }
    .rec-card:nth-child(5) { animation-delay: .28s; }

    .rec-card-accent {
        position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, var(--gold), var(--gold-light));
    }
    .rec-card.top-pick .rec-card-accent { display: none; }

    /* Card body */
    .rec-card-body {
        padding: 1.1rem 1.25rem;
        display: flex; align-items: flex-start; gap: 1rem; flex-wrap: wrap;
    }

    /* Rank circle */
    .rec-rank {
        width: 36px; height: 36px; border-radius: 50%; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display); font-size: 1rem; font-weight: 700;
    }
    .rank-1 { background: rgba(201,168,76,0.15); color: var(--gold-dark); border: 1.5px solid rgba(201,168,76,0.4); }
    .rank-2 { background: rgba(107,101,96,0.08); color: var(--warm-grey); border: 1.5px solid var(--border-md); }
    .rank-other { background: rgba(107,101,96,0.05); color: #B0A89E; border: 1.5px solid var(--border); }

    /* Info block */
    .rec-info { flex: 1; min-width: 0; }
    .rec-top-row {
        display: flex; align-items: flex-start; justify-content: space-between;
        gap: 0.75rem; margin-bottom: 0.35rem; flex-wrap: wrap;
    }
    .rec-name {
        font-family: var(--font-display); font-size: 0.95rem; font-weight: 700;
        color: var(--charcoal); line-height: 1.2;
    }
    .rec-price {
        font-family: var(--font-display); font-size: 1.1rem; font-weight: 700;
        color: var(--gold-dark); white-space: nowrap;
    }
    .rec-desc {
        font-size: 0.78rem; color: var(--warm-grey); line-height: 1.55;
        margin-bottom: 0.6rem;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }

    /* Pills */
    .rec-pills { display: flex; flex-wrap: wrap; gap: 0.35rem; margin-bottom: 0.6rem; }
    .pill {
        display: inline-flex; align-items: center; gap: 0.25rem;
        padding: 2px 8px; border-radius: 999px;
        font-size: 0.62rem; font-weight: 600; letter-spacing: 0.03em;
        font-family: var(--font-body);
    }
    .pill-type   { background: rgba(201,168,76,0.1); color: var(--gold-dark); border: 1px solid rgba(201,168,76,0.25); }
    .pill-best   { background: #F0FDF4; color: #15803D; border: 1px solid #BBF7D0; }
    .pill-near   { background: #FEF9EC; color: #92400E; border: 1px solid #FDE68A; }
    .pill-over   { background: #FEF2F2; color: #B91C1C; border: 1px solid #FECACA; }

    /* Match score bar */
    .rec-score-row { display: flex; align-items: center; gap: 0.65rem; }
    .score-label {
        font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em;
        color: #C0B8B0; font-weight: 600; white-space: nowrap; font-family: var(--font-body);
    }
    .score-bar-track {
        flex: 1; height: 5px; background: var(--border); border-radius: 999px;
        overflow: hidden; min-width: 60px;
    }
    .score-bar-fill {
        height: 100%; border-radius: 999px; background: var(--gold);
        transition: width 0.6s ease;
    }
    .score-bar-fill.low  { background: #E0D8D0; }
    .score-bar-fill.mid  { background: var(--gold-light); }
    .score-bar-fill.high { background: var(--gold); }
    .score-val {
        font-size: 0.72rem; font-weight: 700; color: var(--gold-dark);
        white-space: nowrap; min-width: 28px; text-align: right; font-family: var(--font-display);
    }

    /* Card footer */
    .rec-card-foot {
        padding: 0.65rem 1.25rem;
        border-top: 1px solid var(--border);
        display: flex; align-items: center; justify-content: space-between;
        gap: 0.75rem; flex-wrap: wrap;
    }
    .foot-left { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; }

    .top-pick-badge {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 3px 9px; border-radius: 999px;
        font-size: 0.6rem; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase;
        background: rgba(201,168,76,0.12); color: var(--gold-dark);
        border: 1px solid rgba(201,168,76,0.3); font-family: var(--font-body);
    }
    .top-pick-badge svg { width: 10px; height: 10px; }

    .guest-chip {
        display: inline-flex; align-items: center; gap: 0.25rem;
        font-size: 0.62rem; color: var(--warm-grey); font-family: var(--font-body);
    }
    .guest-chip svg { width: 11px; height: 11px; color: #C0B8B0; }

    /* Buttons */
    .btn-select {
        display: inline-flex; align-items: center; gap: 0.35rem;
        padding: 0.45rem 1rem; border-radius: 6px;
        font-size: 0.72rem; font-weight: 600; letter-spacing: 0.03em; text-transform: uppercase;
        background: var(--charcoal); color: var(--white);
        border: none; cursor: pointer; font-family: var(--font-body);
        transition: background 0.15s, transform 0.12s;
        text-decoration: none;
    }
    .btn-select:hover { background: var(--gold-dark); transform: translateY(-1px); }
    .btn-select svg { width: 12px; height: 12px; }

    .btn-view {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 0.45rem 1rem; border-radius: 6px;
        font-size: 0.72rem; font-weight: 500;
        background: transparent; color: var(--warm-grey);
        border: 1px solid var(--border-md); cursor: pointer; font-family: var(--font-body);
        transition: border-color 0.15s, color 0.15s;
        text-decoration: none;
    }
    .btn-view:hover { border-color: var(--gold); color: var(--gold-dark); }

    /* Mobile */
    @media (max-width: 560px) {
        .ai-wrap { padding: 1rem 0.75rem 3rem; }
        .rec-card-body { gap: 0.65rem; }
        .rec-rank { width: 30px; height: 30px; font-size: 0.85rem; }
    }
</style>

<div class="ai-wrap">

    {{-- ── AI Header Banner ── --}}
    <div class="ai-header">
        <div class="ai-eyebrow">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M10 2l2.4 4.9L18 7.6l-4 3.9.9 5.5L10 14.4l-5 2.6.9-5.5L2 7.6l5.6-.7z"/>
            </svg>
            Bikol's Craft
        </div>
        <h1>AI-Recommended <em>Packages</em></h1>
        <div class="ai-meta">
            <span class="ai-badge-ai">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M12 2a3 3 0 013 3v1a3 3 0 01-3 3H8a3 3 0 01-3-3V5a3 3 0 013-3h4z"/>
                    <path d="M2 15a3 3 0 013-3h10a3 3 0 013 3v1a2 2 0 01-2 2H4a2 2 0 01-2-2v-1z"/>
                </svg>
                AI Matched
            </span>
            <span class="ai-meta-chip">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <rect x="2" y="4" width="16" height="14" rx="2"/>
                    <path d="M2 9h16M7 2v4M13 2v4"/>
                </svg>
                {{ $event->event_type }}
            </span>
            @if($event->budget)
            <span class="ai-meta-chip">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <line x1="10" y1="2" x2="10" y2="18"/>
                    <path d="M14 6H8.5a2.5 2.5 0 000 5h3a2.5 2.5 0 010 5H6"/>
                </svg>
                Budget: ₱{{ number_format($event->budget) }}
            </span>
            @endif
            <span class="ai-meta-chip">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M9 12l2 2 4-4M5 7h10M5 11h6M5 15h4"/>
                </svg>
                {{ count($recommendations) }} match{{ count($recommendations) !== 1 ? 'es' : '' }} found
            </span>
        </div>
    </div>

    {{-- ── Results ── --}}
    @if(count($recommendations))

    <div class="rec-list">
        @foreach($recommendations as $index => $package)
        @php
            $rank      = $index + 1;
            $rankClass = $rank === 1 ? 'rank-1' : ($rank === 2 ? 'rank-2' : 'rank-other');
            $isTop     = $rank === 1;
            $score     = $package->match_score ?? 0; /* 0–100 */
            $scoreFill = $score >= 80 ? 'high' : ($score >= 50 ? 'mid' : 'low');

            /* Budget pill */
            $budget = $event->budget ?? null;
            $price  = $package->price ?? 0;
            if ($budget) {
                if ($price <= $budget)            { $budgetCls = 'pill-best'; $budgetLbl = 'Within budget'; }
                elseif ($price <= $budget * 1.2)  { $budgetCls = 'pill-near'; $budgetLbl = 'Near budget'; }
                else                               { $budgetCls = 'pill-over'; $budgetLbl = 'Over budget'; }
            } else {
                $budgetCls = null; $budgetLbl = null;
            }
        @endphp

        <div class="rec-card {{ $isTop ? 'top-pick' : '' }}">
            @if(!$isTop)<div class="rec-card-accent"></div>@endif

            <div class="rec-card-body">
                {{-- Rank badge --}}
                <div class="rec-rank {{ $rankClass }}">{{ $rank }}</div>

                <div class="rec-info">
                    <div class="rec-top-row">
                        <div class="rec-name">{{ $package->event_name ?? $package->name }}</div>
                        <div class="rec-price">₱{{ number_format($package->price, 2) }}</div>
                    </div>

                    @if($package->description)
                        <p class="rec-desc">{{ $package->description }}</p>
                    @endif

                    <div class="rec-pills">
                        @if($package->tag ?? false)
                            <span class="pill pill-type">{{ $package->tag }}</span>
                        @endif
                        @if($budgetLbl)
                            <span class="pill {{ $budgetCls }}">{{ $budgetLbl }}</span>
                        @endif
                    </div>

                    {{-- Match score bar --}}
                    <div class="rec-score-row">
                        <span class="score-label">Match</span>
                        <div class="score-bar-track">
                            <div class="score-bar-fill {{ $scoreFill }}"
                                 style="width:{{ $score }}%"></div>
                        </div>
                        <span class="score-val">{{ $score }}%</span>
                    </div>
                </div>
            </div>

            <div class="rec-card-foot">
                <div class="foot-left">
                    @if($isTop)
                        <span class="top-pick-badge">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M10 2l2.4 4.9L18 7.6l-4 3.9.9 5.5L10 14.4l-5 2.6.9-5.5L2 7.6l5.6-.7z"/>
                            </svg>
                            Top pick
                        </span>
                    @endif
                    @if($package->guest_capacity ?? false)
                        <span class="guest-chip">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M14 17v-1a4 4 0 00-4-4H6a4 4 0 00-4 4v1"/>
                                <circle cx="8" cy="7" r="4"/>
                                <path d="M18 17v-1a4 4 0 00-3-3.87M14 3.13a4 4 0 010 7.75"/>
                            </svg>
                            Up to {{ number_format($package->guest_capacity) }} guests
                        </span>
                    @endif
                </div>

                <div style="display:flex;gap:0.5rem;align-items:center;">
                    @if(isset($package->supplier_id))
                        <a href="#"
                           class="btn-view">View details</a>
                    @endif
                    @foreach($recommendations as $package)

                    <a href="#" class="btn-select"
                    onclick="event.preventDefault(); document.getElementById('book-{{ $package->id }}').submit();">
                        Select
                    </a>

                    <form id="book-{{ $package->id }}" action="{{ route('book.package') }}" method="POST" style="display:none;">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                    </form>

                @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @else

    {{-- Empty state --}}
    <div class="ai-empty">
        <div class="ai-empty-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                <path d="M12 2l3 6.2L22 9.2l-5 4.9 1.2 6.9L12 17.8l-6.2 3.2L7 14.1 2 9.2l7-.1z"/>
            </svg>
        </div>
        <h3>No recommendations yet</h3>
        <p>We couldn't find packages matching your event type and budget.<br>Try adjusting your event details or browse all packages.</p>
    </div>

    @endif

</div>

</x-client-layout>