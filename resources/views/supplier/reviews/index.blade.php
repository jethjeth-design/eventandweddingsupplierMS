<x-supplier-layout>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap');

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
    body { font-family: var(--font-body); background: var(--ivory); color: var(--charcoal); }

    /* ── PAGE WRAP ── */
    .rv-wrap { max-width: 900px; margin: 0 auto; padding: 2rem 1.25rem 4rem; }

    /* ══════════════════════════════
       HEADER BANNER
    ══════════════════════════════ */
    .rv-banner {
        background: var(--charcoal);
        border-radius: 16px;
        padding: 1.6rem 1.85rem;
        margin-bottom: 1.75rem;
        position: relative; overflow: hidden;
    }
    .rv-banner::before {
        content: '';
        position: absolute; inset: 0;
        background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px);
        background-size: 20px 20px; pointer-events: none;
    }
    .rv-banner::after {
        content: '';
        position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }
    .rv-banner-inner {
        position: relative; z-index: 1;
        display: flex; align-items: flex-end; justify-content: space-between;
        flex-wrap: wrap; gap: 1.25rem;
    }
    .rv-eyebrow {
        font-size: 0.6rem; letter-spacing: 0.2em; text-transform: uppercase;
        color: var(--gold); font-weight: 500; margin-bottom: 0.3rem;
        display: flex; align-items: center; gap: 0.4rem; font-family: var(--font-body);
    }
    .rv-eyebrow::before { content: ''; width: 12px; height: 1px; background: var(--gold); }
    .rv-banner h1 {
        font-family: var(--font-display);
        font-size: clamp(1.2rem, 2.5vw, 1.7rem);
        font-weight: 700; color: var(--white); line-height: 1.15;
    }
    .rv-banner h1 em { color: var(--gold-light); font-style: italic; }
    .rv-banner-sub { font-size: 0.78rem; color: rgba(255,255,255,0.42); margin-top: 0.25rem; }

    /* ══════════════════════════════
       SUMMARY CARD
    ══════════════════════════════ */
    .rv-summary {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 1.75rem 1.85rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
        position: relative; overflow: hidden;
    }
    .rv-summary::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, var(--gold), var(--blush-deep));
    }

    /* Big score */
    .rv-score-block { text-align: center; flex-shrink: 0; }
    .rv-score-num {
        font-family: var(--font-display);
        font-size: 3.5rem; font-weight: 700;
        color: var(--charcoal); line-height: 1;
    }
    .rv-score-denom {
        font-size: 1rem; color: var(--warm-grey); font-weight: 400;
        margin-left: 3px;
    }
    .rv-stars-large {
        display: flex; justify-content: center; gap: 3px;
        margin: 0.4rem 0 0.3rem;
    }
    .rv-star-large svg { width: 22px; height: 22px; }
    .rv-score-count {
        font-size: 0.72rem; color: var(--warm-grey); font-family: var(--font-body);
    }

    /* Breakdown bars */
    .rv-breakdown { flex: 1; min-width: 200px; display: flex; flex-direction: column; gap: 0.45rem; }
    .rv-bar-row { display: flex; align-items: center; gap: 0.65rem; }
    .rv-bar-label {
        font-size: 0.7rem; font-weight: 600; color: var(--warm-grey);
        font-family: var(--font-body); width: 14px; text-align: right; flex-shrink: 0;
    }
    .rv-bar-track {
        flex: 1; height: 7px; background: var(--border); border-radius: 999px; overflow: hidden;
    }
    .rv-bar-fill {
        height: 100%; border-radius: 999px;
        background: var(--gold); transition: width 0.5s ease;
    }
    .rv-bar-count {
        font-size: 0.65rem; color: var(--warm-grey); font-family: var(--font-body);
        min-width: 18px; text-align: left; flex-shrink: 0;
    }

    /* ══════════════════════════════
       SECTION HEADING
    ══════════════════════════════ */
    .rv-section-head {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1rem; flex-wrap: wrap; gap: 0.5rem;
    }
    .rv-section-label {
        font-size: 0.62rem; font-weight: 700; letter-spacing: 0.14em;
        text-transform: uppercase; color: var(--gold-dark);
        display: flex; align-items: center; gap: 0.4rem;
    }
    .rv-section-label::after {
        content: ''; width: 30px; height: 1px;
        background: linear-gradient(90deg, var(--gold), transparent);
    }
    .rv-count-pill {
        font-size: 0.65rem; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase;
        color: var(--gold-dark); background: rgba(201,168,76,0.1);
        border: 1px solid rgba(201,168,76,0.25); padding: 3px 10px; border-radius: 999px;
        font-family: var(--font-body);
    }

    /* ══════════════════════════════
       REVIEW CARDS
    ══════════════════════════════ */
    .rv-list { display: flex; flex-direction: column; gap: 0.9rem; }

    .rv-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 1.2rem 1.35rem;
        position: relative; overflow: hidden;
        animation: fadeUp 0.3s ease both;
    }
    .rv-card:nth-child(1) { animation-delay: 0s; }
    .rv-card:nth-child(2) { animation-delay: .05s; }
    .rv-card:nth-child(3) { animation-delay: .1s; }
    .rv-card:nth-child(4) { animation-delay: .15s; }
    .rv-card:nth-child(5) { animation-delay: .2s; }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: none; } }

    /* Score-coloured left border */
    .rv-card::before {
        content: '';
        position: absolute; top: 0; left: 0; bottom: 0; width: 3px;
        border-radius: 0 2px 2px 0;
    }
    .rv-card.score-5::before { background: var(--gold); }
    .rv-card.score-4::before { background: var(--gold-light); }
    .rv-card.score-3::before { background: #F1C40F; }
    .rv-card.score-2::before { background: #E67E22; }
    .rv-card.score-1::before { background: #E74C3C; }

    /* Card header row */
    .rv-card-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 0.75rem; margin-bottom: 0.65rem; }
    .rv-card-head-l { display: flex; align-items: center; gap: 0.65rem; }

    /* User avatar */
    .rv-avatar {
        width: 38px; height: 38px; border-radius: 50%; flex-shrink: 0;
        background: linear-gradient(135deg, var(--gold), var(--gold-dark));
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display); font-size: 0.82rem; font-weight: 700;
        color: var(--white);
    }
    .rv-user-name { font-family: var(--font-display); font-size: 0.9rem; font-weight: 700; color: var(--charcoal); }
    .rv-user-date { font-size: 0.65rem; color: var(--warm-grey); margin-top: 1px; font-family: var(--font-body); }

    /* Star rating (right) */
    .rv-stars { display: flex; align-items: center; gap: 1px; }
    .rv-stars svg { width: 14px; height: 14px; }

    /* Review text */
    .rv-text {
        font-size: 0.82rem; color: var(--warm-grey); line-height: 1.65;
        border-left: 2px solid var(--border); padding-left: 0.75rem;
        font-style: italic;
    }

    /* ── EMPTY STATE ── */
    .rv-empty {
        text-align: center; padding: 4rem 2rem;
        background: var(--white); border: 1px solid var(--border); border-radius: 12px;
    }
    .rv-empty-icon {
        width: 56px; height: 56px; border-radius: 50%;
        background: rgba(201,168,76,0.08);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 0.85rem; color: var(--gold-dark);
    }
    .rv-empty-icon svg { width: 26px; height: 26px; }
    .rv-empty h3 {
        font-family: var(--font-display); font-size: 1rem; font-weight: 700;
        color: var(--charcoal); margin-bottom: 0.3rem;
    }
    .rv-empty p { font-size: 0.8rem; color: var(--warm-grey); line-height: 1.6; }

    /* Mobile */
    @media (max-width: 560px) {
        .rv-wrap { padding: 1rem 0.75rem 3rem; }
        .rv-summary { gap: 1.25rem; padding: 1.35rem 1.25rem; }
        .rv-score-num { font-size: 2.75rem; }
    }
</style>

@php
    $ratings   = $supplier->ratings ?? collect();
    $total     = $ratings->count();
    $average   = $total ? round($ratings->avg('rating'), 1) : 0;

    /* Breakdown: how many per star */
    $breakdown = [];
    for ($s = 5; $s >= 1; $s--) {
        $breakdown[$s] = $ratings->where('rating', $s)->count();
    }
@endphp

<div class="rv-wrap">

    {{-- ── Banner ── --}}
    <div class="rv-banner">
        <div class="rv-banner-inner">
            <div>
                <div class="rv-eyebrow">
                    <svg width="11" height="11" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M10 2l2.4 4.9L18 7.6l-4 3.9.9 5.5L10 14.4l-5 2.6.9-5.5L2 7.6l5.6-.7z"/>
                    </svg>
                    Supplier Reviews
                </div>
                <h1>Customer <em>Reviews</em></h1>
                <p class="rv-banner-sub">What clients say about this supplier.</p>
            </div>
        </div>
    </div>

    {{-- ── Summary card ── --}}
    <div class="rv-summary">

        {{-- Big score --}}
        <div class="rv-score-block">
            <div class="rv-score-num">
                {{ number_format($average, 1) }}<span class="rv-score-denom">/5</span>
            </div>
            <div class="rv-stars-large">
                @for($i = 1; $i <= 5; $i++)
                <svg class="rv-star-large" viewBox="0 0 20 20">
                    @if($i <= floor($average))
                        <path d="M10 2l2.4 4.9L18 7.6l-4 3.9.9 5.5L10 14.4l-5 2.6.9-5.5L2 7.6l5.6-.7z"
                              fill="#C9A84C" stroke="#C9A84C" stroke-width="1"/>
                    @elseif($i == ceil($average) && $average != floor($average))
                        {{-- Half star --}}
                        <defs>
                            <linearGradient id="half{{ $i }}">
                                <stop offset="50%" stop-color="#C9A84C"/>
                                <stop offset="50%" stop-color="#E0D8D0"/>
                            </linearGradient>
                        </defs>
                        <path d="M10 2l2.4 4.9L18 7.6l-4 3.9.9 5.5L10 14.4l-5 2.6.9-5.5L2 7.6l5.6-.7z"
                              fill="url(#half{{ $i }})" stroke="#C9A84C" stroke-width="1"/>
                    @else
                        <path d="M10 2l2.4 4.9L18 7.6l-4 3.9.9 5.5L10 14.4l-5 2.6.9-5.5L2 7.6l5.6-.7z"
                              fill="#E0D8D0" stroke="#E0D8D0" stroke-width="1"/>
                    @endif
                </svg>
                @endfor
            </div>
            <div class="rv-score-count">{{ $total }} {{ $total === 1 ? 'review' : 'reviews' }}</div>
        </div>

        {{-- Breakdown bars --}}
        <div class="rv-breakdown">
            @for($s = 5; $s >= 1; $s--)
            @php $cnt = $breakdown[$s]; $pct = $total ? round($cnt / $total * 100) : 0; @endphp
            <div class="rv-bar-row">
                <span class="rv-bar-label">{{ $s }}</span>
                <svg width="11" height="11" viewBox="0 0 20 20" style="flex-shrink:0;">
                    <path d="M10 2l2.4 4.9L18 7.6l-4 3.9.9 5.5L10 14.4l-5 2.6.9-5.5L2 7.6l5.6-.7z"
                          fill="{{ $s >= 4 ? '#C9A84C' : ($s == 3 ? '#F1C40F' : '#E0D8D0') }}" stroke="none"/>
                </svg>
                <div class="rv-bar-track">
                    <div class="rv-bar-fill" style="width:{{ $pct }}%;
                        background:{{ $s >= 4 ? '#C9A84C' : ($s == 3 ? '#F1C40F' : ($s == 2 ? '#E67E22' : '#E74C3C')) }};"></div>
                </div>
                <span class="rv-bar-count">{{ $cnt }}</span>
            </div>
            @endfor
        </div>

    </div>

    {{-- ── Review list ── --}}
    <div class="rv-section-head">
        <span class="rv-section-label">All Reviews</span>
        @if($total)
        <span class="rv-count-pill">{{ $total }} {{ $total === 1 ? 'review' : 'reviews' }}</span>
        @endif
    </div>

    @if($total)
    <div class="rv-list">
        @foreach($ratings as $rate)
        @php
            $r       = (int) ($rate->rating ?? 0);
            $initials = strtoupper(substr($rate->user->name ?? 'A', 0, 1));
            if (str_contains($rate->user->name ?? '', ' ')) {
                $parts = explode(' ', $rate->user->name);
                $initials = strtoupper(substr($parts[0], 0, 1) . substr(end($parts), 0, 1));
            }
        @endphp
        <div class="rv-card score-{{ min($r, 5) }}">

            <div class="rv-card-head">
                <div class="rv-card-head-l">
                    <div class="rv-avatar">{{ $initials }}</div>
                    <div>
                        <div class="rv-user-name">{{ $rate->user->name ?? 'Anonymous' }}</div>
                        <div class="rv-user-date">{{ $rate->created_at ? $rate->created_at->diffForHumans() : '' }}</div>
                    </div>
                </div>

                {{-- Star rating --}}
                <div class="rv-stars">
                    @for($i = 1; $i <= 5; $i++)
                    <svg viewBox="0 0 20 20">
                        <path d="M10 2l2.4 4.9L18 7.6l-4 3.9.9 5.5L10 14.4l-5 2.6.9-5.5L2 7.6l5.6-.7z"
                              fill="{{ $i <= $r ? '#C9A84C' : '#E0D8D0' }}" stroke="none"/>
                    </svg>
                    @endfor
                </div>
            </div>

            @if($rate->review)
            <p class="rv-text">{{ $rate->review }}</p>
            @endif

        </div>
        @endforeach
    </div>

    @else
    <div class="rv-empty">
        <div class="rv-empty-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                <path d="M12 2l3 6.2L22 9.2l-5 4.9 1.2 6.9L12 17.8l-6.2 3.2L7 14.1 2 9.2l7-.1z"/>
            </svg>
        </div>
        <h3>No reviews yet</h3>
        <p>Clients who have booked this supplier will be able to leave reviews here.</p>
    </div>
    @endif

</div>

</x-supplier-layout>