<x-client-layout>

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

    .rec-wrap { max-width: 960px; margin: 0 auto; padding: 2rem 1.25rem 4rem; }

    .rec-banner {
        background: var(--charcoal);
        border-radius: 14px;
        padding: 1.6rem 1.85rem;
        margin-bottom: 1.75rem;
        position: relative; overflow: hidden;
    }
    .rec-banner::before {
        content: '';
        position: absolute; inset: 0;
        background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px);
        background-size: 20px 20px; pointer-events: none;
    }
    .rec-banner::after {
        content: '';
        position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }
    .rec-banner-inner { position: relative; z-index: 1; }
    .rec-eyebrow {
        font-size: 0.6rem; letter-spacing: 0.2em; text-transform: uppercase;
        color: var(--gold); font-weight: 500; margin-bottom: 0.35rem;
        display: flex; align-items: center; gap: 0.45rem; font-family: var(--font-body);
    }
    .rec-eyebrow::before { content: ''; width: 14px; height: 1px; background: var(--gold); }
    .rec-banner h1 {
        font-family: var(--font-display);
        font-size: clamp(1.3rem, 2.5vw, 1.85rem);
        font-weight: 700; color: var(--white); line-height: 1.15;
    }
    .rec-banner h1 em { color: var(--gold-light); font-style: italic; }
    .rec-banner-meta {
        display: flex; align-items: center; gap: 0.75rem;
        margin-top: 0.75rem; flex-wrap: wrap;
    }
    .rec-meta-chip {
        display: inline-flex; align-items: center; gap: 0.35rem;
        padding: 4px 10px; border-radius: 999px; font-size: 0.7rem; font-weight: 500;
        background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.72);
        border: 1px solid rgba(255,255,255,0.14); font-family: var(--font-body);
    }
    .rec-meta-chip svg { width: 12px; height: 12px; }
    .rec-ai-badge {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 3px 10px; border-radius: 999px;
        font-size: 0.62rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase;
        background: rgba(201,168,76,0.15); color: var(--gold-light);
        border: 1px solid rgba(201,168,76,0.3); font-family: var(--font-body);
    }
    .rec-ai-badge svg { width: 11px; height: 11px; }

    .rec-list { display: flex; flex-direction: column; gap: 1.1rem; }

    .rec-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        animation: fadeUp 0.3s ease both;
    }
    .rec-card:nth-child(1) { animation-delay: 0s; }
    .rec-card:nth-child(2) { animation-delay: .07s; }
    .rec-card:nth-child(3) { animation-delay: .14s; }
    .rec-card:nth-child(4) { animation-delay: .21s; }
    .rec-card:nth-child(5) { animation-delay: .28s; }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: none; } }

    .rec-card-accent {
        position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, var(--gold), var(--gold-light));
    }
    .rec-card.top-pick { border: 2px solid var(--gold); }
    .rec-card.top-pick .rec-card-accent { display: none; }

    .rec-card-main { padding: 1.2rem 1.35rem; display: flex; align-items: flex-start; gap: 1rem; }

    .rec-rank {
        width: 38px; height: 38px; border-radius: 50%; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display); font-size: 1rem; font-weight: 700;
    }
    .rank-1 { background: rgba(201,168,76,0.15); color: var(--gold-dark); border: 1.5px solid rgba(201,168,76,0.4); }
    .rank-2 { background: rgba(107,101,96,0.08); color: var(--warm-grey); border: 1.5px solid var(--border-md); }
    .rank-other { background: rgba(107,101,96,0.05); color: #C0B8B0; border: 1.5px solid var(--border); }

    .rec-info { flex: 1; min-width: 0; }

    .rec-top-row {
        display: flex; align-items: flex-start; justify-content: space-between;
        gap: 0.75rem; margin-bottom: 0.35rem; flex-wrap: wrap;
    }
    .rec-name {
        font-family: var(--font-display); font-size: 1rem; font-weight: 700;
        color: var(--charcoal); line-height: 1.2;
    }
    .rec-price {
        font-family: var(--font-display); font-size: 1.1rem; font-weight: 700;
        color: var(--gold-dark); white-space: nowrap;
    }

    /* ── SUPPLIER NAME ROW ── (only new CSS added) */
    .rec-supplier-row {
        display: flex; align-items: center; gap: 0.4rem;
        margin-bottom: 0.45rem;
    }
    .rec-supplier-avatar {
        width: 40px; height: 40px; border-radius: 50%;
        background: linear-gradient(135deg, var(--gold), var(--gold-dark));
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display); font-size: 0.55rem; font-weight: 700;
        color: var(--white); flex-shrink: 0; overflow: hidden;
    }
    .rec-supplier-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .rec-supplier-name {
        font-size: 0.72rem; color: var(--warm-grey);
        font-family: var(--font-body); font-weight: 500;
    }
    .rec-supplier-name strong {
        color: var(--charcoal); font-weight: 600;
    }
    .rec-supplier-sep {
        width: 3px; height: 3px; border-radius: 50%;
        background: var(--border-md); flex-shrink: 0;
    }
    .rec-supplier-category {
        font-size: 0.65rem; color: var(--gold-dark);
        font-family: var(--font-body); font-weight: 500;
    }

    .rec-desc {
        font-size: 0.78rem; color: var(--warm-grey); line-height: 1.55;
        margin-bottom: 0.65rem;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }

    .rec-score-row { display: flex; align-items: center; gap: 0.65rem; margin-bottom: 0.65rem; }
    .score-label { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: #C0B8B0; white-space: nowrap; font-family: var(--font-body); }
    .score-track { flex: 1; height: 5px; background: var(--border); border-radius: 999px; overflow: hidden; min-width: 60px; }
    .score-fill { height: 100%; border-radius: 999px; background: var(--gold); transition: width .5s ease; }
    .score-fill.high { background: var(--gold); }
    .score-fill.mid  { background: var(--gold-light); }
    .score-fill.low  { background: var(--border-md); }
    .score-val { font-size: 0.72rem; font-weight: 700; color: var(--gold-dark); min-width: 32px; text-align: right; font-family: var(--font-display); }

    .rec-pills { display: flex; flex-wrap: wrap; gap: 0.35rem; margin-bottom: 0.65rem; }
    .pill {
        display: inline-flex; align-items: center; gap: 0.25rem;
        padding: 2px 8px; border-radius: 999px; font-size: 0.62rem; font-weight: 600;
        letter-spacing: 0.03em; font-family: var(--font-body);
    }
    .pill svg { width: 9px; height: 9px; }
    .pill-type  { background: rgba(201,168,76,0.1); color: var(--gold-dark); border: 1px solid rgba(201,168,76,0.25); }
    .pill-guest { background: var(--ivory); color: var(--warm-grey); border: 1px solid var(--border-md); }

    .rec-inclusions {
        border-top: 1px solid var(--border);
        padding: 0.85rem 1.35rem;
        background: rgba(201,168,76,0.02);
    }
    .incl-head {
        font-size: 0.6rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase;
        color: #C0B8B0; margin-bottom: 0.55rem; font-family: var(--font-body);
        display: flex; align-items: center; gap: 0.4rem;
    }
    .incl-head svg { width: 10px; height: 10px; color: var(--gold-dark); }
    .incl-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 0.4rem;
    }
    .incl-item {
        display: flex; align-items: center; gap: 0.45rem;
        font-size: 0.75rem; color: var(--charcoal); font-family: var(--font-body); line-height: 1.35;
    }
    .incl-dot {
        width: 6px; height: 6px; border-radius: 50%; background: var(--gold);
        flex-shrink: 0; box-shadow: 0 0 0 2px rgba(201,168,76,0.18);
    }

    .rec-card-foot {
        border-top: 1px solid var(--border);
        padding: 0.75rem 1.35rem;
        display: flex; align-items: center; justify-content: space-between;
        gap: 0.75rem; flex-wrap: wrap;
        background: var(--white);
    }
    .foot-left { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; }

    .top-pick-badge {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 3px 9px; border-radius: 999px;
        font-size: 0.6rem; font-weight: 700; letter-spacing: 0.04em; text-transform: uppercase;
        background: rgba(201,168,76,0.12); color: var(--gold-dark);
        border: 1px solid rgba(201,168,76,0.3); font-family: var(--font-body);
    }
    .top-pick-badge svg { width: 10px; height: 10px; }

    .btn-book {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.55rem 1.35rem;
        background: var(--charcoal); color: var(--white);
        border: none; border-radius: 6px;
        font-family: var(--font-body); font-size: 0.78rem; font-weight: 600;
        letter-spacing: 0.04em; text-transform: uppercase;
        cursor: pointer;
        position: relative; overflow: hidden;
        transition: transform 0.15s;
    }
    .btn-book::after {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(135deg, var(--gold-dark), var(--gold));
        opacity: 0; transition: opacity 0.25s;
    }
    .btn-book:hover::after { opacity: 1; }
    .btn-book:hover { transform: translateY(-1px); }
    .btn-book span, .btn-book svg { position: relative; z-index: 1; }
    .btn-book svg { width: 13px; height: 13px; }

    .rec-empty {
        text-align: center; padding: 4rem 2rem;
        background: var(--white); border: 1px solid var(--border); border-radius: 12px;
    }
    .rec-empty-icon {
        width: 56px; height: 56px; border-radius: 50%;
        background: rgba(201,168,76,0.08);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 0.9rem; color: var(--gold-dark);
    }
    .rec-empty-icon svg { width: 26px; height: 26px; }
    .rec-empty h3 {
        font-family: var(--font-display); font-size: 1.05rem; font-weight: 700;
        color: var(--charcoal); margin-bottom: 0.3rem;
    }
    .rec-empty p { font-size: 0.8rem; color: var(--warm-grey); line-height: 1.6; }

    @media (max-width: 560px) {
        .rec-wrap { padding: 1rem 0.75rem 3rem; }
        .rec-card-main { gap: 0.65rem; }
        .rec-rank { width: 32px; height: 32px; font-size: 0.85rem; }
        .incl-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="rec-wrap">

    {{-- ── Banner ── --}}
    <div class="rec-banner">
        <div class="rec-banner-inner">
            <div class="rec-eyebrow">
                <svg width="11" height="11" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M10 2l2.4 4.9L18 7.6l-4 3.9.9 5.5L10 14.4l-5 2.6.9-5.5L2 7.6l5.6-.7z"/>
                </svg>
                Smart Matching
            </div>
            <h1>Recommended <em>Packages</em></h1>
            <div class="rec-banner-meta">
                <span class="rec-ai-badge">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M12 2a3 3 0 013 3v1a3 3 0 01-3 3H8a3 3 0 01-3-3V5a3 3 0 013-3h4z"/>
                        <path d="M2 15a3 3 0 013-3h10a3 3 0 013 3v1a2 2 0 01-2 2H4a2 2 0 01-2-2v-1z"/>
                    </svg>
                    AI Matched
                </span>
                @if(isset($event))
                <span class="rec-meta-chip">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="4" width="16" height="14" rx="2"/><path d="M2 9h16M7 2v4M13 2v4"/></svg>
                    {{ $event->event_type ?? 'Your Event' }}
                </span>
                @if($event->budget)
                <span class="rec-meta-chip">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><line x1="10" y1="2" x2="10" y2="18"/><path d="M14 6H8.5a2.5 2.5 0 000 5h3a2.5 2.5 0 010 5H6"/></svg>
                    Budget: ₱{{ number_format($event->budget) }}
                </span>
                @endif
                @endif
                <span class="rec-meta-chip">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M9 12l2 2 4-4M5 7h10M5 11h6M5 15h4"/></svg>
                    {{ count($recommendations) }} match{{ count($recommendations) !== 1 ? 'es' : '' }} found
                </span>
            </div>
        </div>
    </div>

    {{-- ── Results ── --}}
    @forelse($recommendations as $index => $package)
    @php
        $rank      = $index + 1;
        $rankClass = $rank === 1 ? 'rank-1' : ($rank === 2 ? 'rank-2' : 'rank-other');
        $isTop     = $rank === 1;

        $rawScore  = $package->score ?? 0;
        $scorePct  = $rawScore > 1 ? (int) round($rawScore) : (int) round($rawScore * 100);
        $scoreFill = $scorePct >= 75 ? 'high' : ($scorePct >= 45 ? 'mid' : 'low');

        $inclusions = is_array($package->inclusions)
            ? $package->inclusions
            : (method_exists($package->inclusions ?? null, 'all') ? $package->inclusions->all() : []);

        // ✅ Supplier info
        $supplier         = $package->supplier ?? $package->supplierProfile ?? null;
        $supplierName     = $supplier?->business_name
                         ?? $supplier?->name
                         ?? $supplier?->user?->name
                         ?? 'Unknown Supplier';
        $supplierCategory = $supplier?->category ?? $supplier?->supplierProfile?->category ?? null;
        $supplierPhoto    = $supplier?->photo
                         ?? $supplier?->supplierProfile?->photo
                         ?? null;
        $supplierInitials = strtoupper(substr($supplierName, 0, 2));
    @endphp

    <div class="rec-card {{ $isTop ? 'top-pick' : '' }}">
        @if(!$isTop)<div class="rec-card-accent"></div>@endif

        {{-- Main body --}}
        <div class="rec-card-main">
            <div class="rec-rank {{ $rankClass }}">{{ $rank }}</div>

            <div class="rec-info">
                <div class="rec-top-row">
                    <div class="rec-name">{{ $package->name }}</div>
                    <div class="rec-price">₱{{ number_format($package->price) }}</div>
                </div>

                {{-- ✅ SUPPLIER NAME ROW — only addition to the original design --}}
                <div class="rec-supplier-row">
                    <div class="rec-supplier-avatar">
                        @if($supplierPhoto)
                            <img src="{{ asset('storage/' . $supplierPhoto) }}" alt="{{ $supplierName }}">
                        @else
                            {{ $supplierInitials }}
                        @endif
                    </div>
                    <span class="rec-supplier-name">by <strong>{{ $supplierName }}</strong></span>
                    @if($supplierCategory)
                        <span class="rec-supplier-sep"></span>
                        <span class="rec-supplier-category">{{ $supplierCategory }}</span>
                    @endif
                </div>

                @if($package->description)
                <p class="rec-desc">{{ $package->description }}</p>
                @endif

                {{-- Score bar --}}
                <div class="rec-score-row">
                    <span class="score-label">Match</span>
                    <div class="score-track">
                        <div class="score-fill {{ $scoreFill }}" style="width:{{ $scorePct }}%"></div>
                    </div>
                    <span class="score-val">{{ $scorePct }}%</span>
                </div>

                {{-- Pills --}}
                <div class="rec-pills">
                    @if($package->guest_capacity)
                    <span class="pill pill-guest">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M14 17v-1a4 4 0 00-4-4H6a4 4 0 00-4 4v1"/><circle cx="8" cy="7" r="4"/>
                            <path d="M18 17v-1a4 4 0 00-3-3.87M14 3.13a4 4 0 010 7.75"/>
                        </svg>
                        Up to {{ number_format($package->guest_capacity) }} guests
                    </span>
                    @endif
                    @if(isset($event) && $event->budget)
                        @if($package->price <= $event->budget)
                            <span class="pill" style="background:#F0FDF4;color:#15803D;border:1px solid #BBF7D0;">Within budget</span>
                        @elseif($package->price <= $event->budget * 1.2)
                            <span class="pill" style="background:#FEF9EC;color:#92400E;border:1px solid #FDE68A;">Near budget</span>
                        @else
                            <span class="pill" style="background:#FEF2F2;color:#B91C1C;border:1px solid #FECACA;">Over budget</span>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        {{-- Inclusions --}}
        @if(count($inclusions))
        <div class="rec-inclusions">
            <div class="incl-head">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M2 4h10M2 7h10M2 10h6"/>
                </svg>
                What's included
            </div>
            <div class="incl-grid">
                @foreach($inclusions as $inc)
                <div class="incl-item">
                    <span class="incl-dot"></span>
                    {{ is_string($inc) ? $inc : ($inc->title ?? $inc->name ?? '') }}
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Footer --}}
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
            </div>

            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="event_id"   value="{{ $event->id }}">
                <input type="hidden" name="package_id" value="{{ $package->id }}">
                <button type="submit" class="btn-book">
                    <span>Book This Package</span>
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 3l5 5-5 5"/>
                    </svg>
                </button>
            </form>
        </div>

    </div>
    @empty

    <div class="rec-empty">
        <div class="rec-empty-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                <path d="M12 2l3 6.2L22 9.2l-5 4.9 1.2 6.9L12 17.8l-6.2 3.2L7 14.1 2 9.2l7-.1z"/>
            </svg>
        </div>
        <h3>No recommendations found</h3>
        <p>We couldn't find packages matching your event.<br>Try adjusting your event details or browse all packages.</p>
    </div>

    @endforelse

</div>

</x-client-layout>