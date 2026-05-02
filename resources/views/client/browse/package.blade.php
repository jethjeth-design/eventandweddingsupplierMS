<x-client-layout>
    <style>
        :root {
            --gold:         #C9A84C;
            --gold-light:   #E8C97A;
            --gold-dark:    #8A6A1F;
            --blush-deep:   #D4A090;
            --ivory:        #FAF7F2;
            --charcoal:     #1E1B18;
            --warm-grey:    #6B6560;
            --white:        #FFFFFF;
            --border:       #F0EBE5;
            --border-md:    #E0D8D0;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body:    'DM Sans', sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-body); background: var(--ivory); color: var(--charcoal); }

        /* ── PAGE HERO ── */
        .page-hero { background: var(--charcoal); padding: 3rem 3rem 2.75rem; position: relative; overflow: hidden; }
        .page-hero::before { content: ''; position: absolute; inset: 0; background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px); background-size: 20px 20px; pointer-events: none; }
        .page-hero::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, var(--gold), transparent); pointer-events: none; }
        .hero-inner { position: relative; z-index: 1; max-width: 1100px; margin: 0 auto; }
        .hero-eyebrow { font-size: 0.62rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--gold); font-weight: 500; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem; }
        .hero-eyebrow::before { content: ''; display: block; width: 18px; height: 1px; background: var(--gold); }
        .hero-inner h1 { font-family: var(--font-display); font-size: clamp(1.6rem, 3.5vw, 2.6rem); font-weight: 700; color: var(--white); line-height: 1.15; }
        .hero-inner h1 em { color: var(--gold-light); font-style: italic; }
        .hero-sub { font-size: 0.82rem; color: rgba(255,255,255,0.42); margin-top: 0.4rem; }

        /* ── MAIN WRAPPER ── */
        .main-wrap { max-width: 1200px; margin: 0 auto; padding: 2.5rem 1.5rem 4rem; }
        @media (max-width: 640px) { .main-wrap { padding: 1.5rem 1rem 3rem; } }

        /* ── SECTION HEADERS ── */
        .hs-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
        .hs-head-l { display: flex; align-items: center; gap: 0.75rem; }
        .hs-icon { width: 38px; height: 38px; border-radius: 50%; background: rgba(201,168,76,0.1); border: 1.5px solid rgba(201,168,76,0.28); display: flex; align-items: center; justify-content: center; color: var(--gold-dark); flex-shrink: 0; }
        .hs-icon svg { width: 17px; height: 17px; }
        .hs-title { font-family: var(--font-display); font-size: 1.22rem; font-weight: 700; color: var(--charcoal); line-height: 1.2; }
        .hs-title em { font-style: italic; color: var(--gold-dark); }
        .hs-sub { font-size: 0.73rem; color: var(--warm-grey); margin-top: 0.12rem; }
        .hs-link { display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.78rem; font-weight: 500; color: var(--gold-dark); text-decoration: none; white-space: nowrap; transition: color 0.2s; }
        .hs-link:hover { color: var(--charcoal); }
        .hs-link svg { width: 14px; height: 14px; transition: transform 0.2s; }
        .hs-link:hover svg { transform: translateX(3px); }

        /* ── DIVIDER ── */
        .section-divider { border: none; border-top: 1px solid var(--border); margin: 2.75rem 0; }

        /* ════════════════════════════════════════
           SUPPLIER GRID  — full styles including
           the FIX: logo centered on cover line
        ════════════════════════════════════════ */
        .sp-grid-section { margin-bottom: 0; }
        .sp-section-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; }
        .sp-section-label { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; color: var(--gold-dark); display: flex; align-items: center; gap: 0.45rem; }
        .sp-section-label::after { content: ''; flex: 1; height: 1px; background: linear-gradient(90deg, var(--gold), transparent); width: 60px; display: inline-block; }

        .sp-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.1rem;
        }
        @media (max-width: 1100px) { .sp-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 720px)  { .sp-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 440px)  { .sp-grid { grid-template-columns: 1fr; } }

        .sp-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.22s, transform 0.22s, border-color 0.22s;
            animation: fadeUp 0.35s ease both;
        }
        .sp-card:hover {
            box-shadow: 0 8px 32px rgba(30,27,24,0.12);
            transform: translateY(-3px);
            border-color: rgba(201,168,76,0.45);
        }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        /* ── Cover photo (4:3 ratio) ── */
        .sp-card-photo {
            position: relative;
            width: 100%;
            aspect-ratio: 4 / 3;
            overflow: hidden;
            background: linear-gradient(135deg, var(--charcoal) 0%, #2a2016 60%, #3d2f14 100%);
            flex-shrink: 0;
        }
        .sp-card-photo img {
            width: 100%; height: 100%;
            object-fit: cover; display: block;
            transition: transform 0.35s;
        }
        .sp-card:hover .sp-card-photo img { transform: scale(1.05); }

        .sp-card-photo-placeholder {
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
        }
        .sp-card-photo-initials {
            font-family: var(--font-display);
            font-size: 2rem; font-weight: 700;
            color: rgba(201,168,76,0.25);
            letter-spacing: 0.04em;
        }

        /* Category badges on photo */
        .sp-photo-badge {
            position: absolute; top: 0.55rem; right: 0.55rem;
            display: flex; flex-wrap: wrap; gap: 0.3rem; justify-content: flex-end;
        }
        .sp-photo-cat {
            font-size: 0.58rem; font-weight: 700; letter-spacing: 0.06em;
            text-transform: uppercase; padding: 0.18rem 0.52rem;
            border-radius: 20px;
            background: rgba(30,27,24,0.72); color: var(--gold-light);
            backdrop-filter: blur(4px);
        }

        /* ────────────────────────────────────────
           FIX: Logo row — logo perfectly centered
           on the cover/body dividing line
        ──────────────────────────────────────── */
        .sp-card-logo-row {
            display: flex; align-items: flex-end; justify-content: space-between;
            padding: 0 1rem;
            margin-top: -18px;
            position: relative; z-index: 3;
        }

        .sp-logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid var(--white);
            box-shadow: 0 2px 10px rgba(30,27,24,0.18);
            background: var(--charcoal);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 700;
            color: var(--gold);
            overflow: hidden;
            flex-shrink: 0;
        }
        .sp-logo img {
            width: 100%; height: 100%;
            object-fit: cover; display: block;
        }

        /* Rating badge — sits on the right side of the logo row */
        .sp-card-rating {
            position: absolute;
            right: 1rem;
             background: var(--white); border: 1px solid var(--border);
            padding: 2px 7px; border-radius: 999px;
            box-shadow: 0 1px 4px rgba(30,27,24,0.08);
        }
        .sp-card-rating {
            display: flex; align-items: center; gap: 3px;
            background: var(--white); border: 1px solid var(--border);
            padding: 2px 7px; border-radius: 999px;
            box-shadow: 0 1px 4px rgba(30,27,24,0.08);
        }
        .sp-card-rating svg {
            width: 11px; height: 11px;
            fill: var(--gold); stroke: var(--gold-dark); stroke-width: 1;
        }
        .sp-card-rating-val { font-size: 0.72rem; font-weight: 700; }
        .sp-card-rating-ct  { font-size: 0.63rem; color: var(--warm-grey); font-weight: 400; }

        /* ── Card body ── */
        .sp-card-body {
            padding: 0.65rem 1rem 1rem;
            display: flex; flex-direction: column; gap: 0.25rem;
            flex: 1;
        }
        .sp-biz-name { font-family: var(--font-display); font-size: 0.92rem; font-weight: 700; color: var(--charcoal); line-height: 1.2; }
        .sp-owner-name { font-size: 0.68rem; color: var(--warm-grey); }
        .sp-tagline { font-size: 0.7rem; color: var(--gold-dark); font-style: italic; line-height: 1.45; }
        .sp-location { display: flex; align-items: center; gap: 0.3rem; font-size: 0.7rem; color: var(--warm-grey); margin-top: 0.05rem; }
        .sp-location svg { width: 9px; height: 9px; flex-shrink: 0; color: var(--gold-dark); }
        .sp-card-divider { border: none; border-top: 1px solid var(--border); margin-top: 0.5rem; }

        /* Empty / no-results states */
        .sp-no-results {
            display: none; grid-column: 1 / -1; text-align: center;
            padding: 3rem 1rem; background: var(--white);
            border: 1px solid var(--border); border-radius: 12px;
        }
        .sp-no-results.visible { display: block; }
        .sp-no-results svg { width: 36px; height: 36px; color: rgba(201,168,76,0.4); margin-bottom: 0.75rem; }
        .sp-no-results-title { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--charcoal); margin-bottom: 0.3rem; }
        .sp-no-results-sub { font-size: 0.8rem; color: var(--warm-grey); }

        .sp-empty { text-align: center; padding: 4rem 1rem; }
        .sp-empty svg { width: 40px; height: 40px; color: rgba(201,168,76,0.35); margin-bottom: 0.75rem; }
        .sp-empty-title { font-family: var(--font-display); font-size: 1.05rem; font-weight: 700; color: var(--charcoal); margin-bottom: 0.35rem; }
        .sp-empty-sub { font-size: 0.8rem; color: var(--warm-grey); line-height: 1.6; }

        /* ════════════════════════════════
           POPULAR PACKAGES
        ════════════════════════════════ */
        .pp-section { margin-top: 0; }

        .pp-tab-row { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.4rem; }
        .pp-tab { padding: 0.4rem 1.1rem; border-radius: 20px; border: 1.5px solid var(--border-md); background: var(--white); font-family: var(--font-body); font-size: 0.75rem; font-weight: 500; color: var(--warm-grey); cursor: pointer; transition: all 0.2s; white-space: nowrap; }
        .pp-tab:hover { border-color: var(--gold); color: var(--gold-dark); }
        .pp-tab.pp-active { background: var(--charcoal); border-color: var(--charcoal); color: var(--white); }

        .pp-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; }
        @media (max-width: 1100px) { .pp-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 768px)  { .pp-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 480px)  { .pp-grid { grid-template-columns: 1fr; } }

        .pp-card { background: var(--white); border: 1.5px solid var(--border); border-radius: 12px; overflow: hidden; display: flex; flex-direction: column; transition: box-shadow 0.22s, transform 0.22s, border-color 0.22s; animation: fadeUp 0.35s ease both; }
        .pp-card:hover { box-shadow: 0 6px 26px rgba(30,27,24,0.12); transform: translateY(-3px); border-color: rgba(201,168,76,0.45); }
        .pp-card.pp-hidden { display: none; }

        .pp-badge-wrap { padding: 1rem 1.1rem 0; }
        .pp-badge { display: inline-flex; align-items: center; gap: 0.3rem; font-size: 0.58rem; font-weight: 700; letter-spacing: 0.07em; text-transform: uppercase; padding: 3px 9px; border-radius: 999px; background: rgba(201,168,76,0.1); color: var(--gold-dark); border: 1px solid rgba(201,168,76,0.25); }
        .pp-badge svg { width: 9px; height: 9px; }

        .pp-body { padding: 0.7rem 1.1rem 0.9rem; flex: 1; display: flex; flex-direction: column; gap: 0.5rem; }
        .pp-title-row { display: flex; align-items: flex-start; justify-content: space-between; gap: 0.4rem; }
        .pp-pkg-name { font-family: var(--font-display); font-size: 0.95rem; font-weight: 700; color: var(--charcoal); line-height: 1.25; flex: 1; }
        .pp-price { font-family: var(--font-display); font-size: 0.95rem; font-weight: 700; color: var(--gold-dark); white-space: nowrap; }

        .pp-meta { display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap; }
        .pp-chip { display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.65rem; color: var(--warm-grey); }
        .pp-chip svg { width: 11px; height: 11px; flex-shrink: 0; }

        .pp-inc-label { font-size: 0.57rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); }
        .pp-inc-list { list-style: none; display: flex; flex-direction: column; gap: 0.25rem; }
        .pp-inc-list li { display: flex; align-items: flex-start; gap: 0.38rem; font-size: 0.72rem; color: var(--charcoal); line-height: 1.4; }
        .pp-inc-list li svg { width: 10px; height: 10px; color: var(--gold-dark); flex-shrink: 0; margin-top: 0.2rem; }

        .pp-foot { padding: 0.65rem 1.1rem; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; gap: 0.5rem; }
        .pp-supplier-micro { display: flex; align-items: center; gap: 0.4rem; min-width: 0; }
        .pp-supplier-micro img { width: 22px; height: 22px; border-radius: 50%; object-fit: cover; border: 1px solid var(--border-md); flex-shrink: 0; }
        .pp-supplier-micro-init { width: 22px; height: 22px; border-radius: 50%; background: var(--charcoal); display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: 0.6rem; font-weight: 700; color: var(--gold); flex-shrink: 0; }
        .pp-supplier-name { font-size: 0.68rem; color: var(--warm-grey); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .pp-view-btn { display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.38rem 0.85rem; border-radius: 6px; border: 1.5px solid var(--border-md); background: var(--white); font-family: var(--font-body); font-size: 0.72rem; font-weight: 500; color: var(--charcoal); text-decoration: none; cursor: pointer; transition: border-color 0.2s, background 0.2s, color 0.2s; white-space: nowrap; flex-shrink: 0; }
        .pp-view-btn:hover { border-color: var(--gold-dark); background: rgba(201,168,76,0.08); color: var(--gold-dark); }
        .pp-view-btn svg { width: 12px; height: 12px; }

        .pp-no-results { display: none; grid-column: 1 / -1; text-align: center; padding: 3rem 1rem; background: var(--white); border: 1px solid var(--border); border-radius: 12px; }
        .pp-no-results.visible { display: block; }
        .pp-no-results svg { width: 36px; height: 36px; color: rgba(201,168,76,0.4); margin-bottom: 0.75rem; }
        .pp-no-results h3 { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--charcoal); margin-bottom: 0.3rem; }
        .pp-no-results p { font-size: 0.8rem; color: var(--warm-grey); }

        /* ── FOOTER ── */
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
            <div class="hero-eyebrow">Explore Offers</div>
            <h1>Browse <em>Event Packages</em></h1>
            <p class="hero-sub">Curated packages from verified suppliers across Bikol.</p>
        </div>
    </div>

    {{-- ── MAIN CONTENT ── --}}
    <div class="main-wrap">

        {{-- ════════════════════════
             FEATURED SUPPLIERS
        ════════════════════════ --}}
        <div class="hs-head">
            <div class="hs-head-l">
                <div class="hs-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path d="M12 2l2.4 4.9L20 7.6l-4 3.9 1 5.5L12 14.4 6.9 17l1-5.5-4-3.9 5.6-.7z"/>
                    </svg>
                </div>
                <div>
                    <div class="hs-title">Featured <em>Suppliers</em></div>
                    <div class="hs-sub">Trusted suppliers for your special events</div>
                </div>
            </div>
            <a href="{{ route('client.all.suppliers') }}" class="hs-link">
                View all suppliers
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 8h10M9 4l4 4-4 4"/>
                </svg>
            </a>
        </div>

        <div class="sp-grid-section">
            <div class="sp-section-head">
                <span class="sp-section-label">All Suppliers</span>
            </div>

            @if($suppliers->count())
            <div class="sp-grid" id="spGrid">
                @foreach($suppliers as $supplier)
                @php
                    $profile     = $supplier->supplierProfile ?? $supplier;
                    $bizName     = $profile->business_name ?? trim(($profile->first_name ?? '') . ' ' . ($profile->last_name ?? '')) ?: $supplier->name;
                    $fullName    = trim(($profile->first_name ?? '') . ' ' . ($profile->last_name ?? ''));
                    $city        = $profile->city        ?? null;
                    $province    = $profile->province    ?? null;
                    $photo       = $profile->photo       ?? null;
                    $cover_photo = $profile->cover_photo ?? null;
                    $tagline     = $profile->tagline     ?? null;
                    $initials    = strtoupper(substr($bizName, 0, 2));
                    $cats        = $supplier->categories ?? collect();
                    $catNames    = $cats->pluck('name')->map(fn($c) => strtolower($c))->implode(' ');
                    $location    = implode(', ', array_filter([$city, $province]));
                    $avg         = $supplier->ratings->avg('rating');
                    $rCount      = $supplier->ratings->count();
                    $avgR        = $avg ? round($avg, 1) : 0;
                @endphp

                <div class="sp-card reveal"
                     data-name="{{ strtolower($bizName) }} {{ strtolower($fullName) }}"
                     data-city="{{ strtolower($city ?? '') }}"
                     data-cat="{{ $catNames }}"
                     data-rating="{{ $avgR }}"
                     data-reviews="{{ $rCount }}"
                     data-bizname="{{ strtolower($bizName) }}">

                    {{-- Cover photo (4:3 ratio) --}}
                    <div class="sp-card-photo">
                        @if($cover_photo)
                            <img src="{{ asset('storage/'.$cover_photo) }}" alt="{{ $bizName }}" loading="lazy">
                        @else
                            <div class="sp-card-photo-placeholder">
                                <span class="sp-card-photo-initials">{{ $initials }}</span>
                            </div>
                        @endif

                        {{-- Category badges --}}
                        @if($cats->count())
                        <div class="sp-photo-badge">
                            @foreach($cats->take(2) as $cat)
                                <span class="sp-photo-cat">{{ $cat->name }}</span>
                            @endforeach
                            @if($cats->count() > 2)
                                <span class="sp-photo-cat">+{{ $cats->count() - 2 }}</span>
                            @endif
                        </div>
                        @endif
                    </div>

                    {{-- ── Logo row: profile logo centered on the cover/body dividing line ── --}}
                    <div class="sp-card-logo-row">
                        <div class="sp-logo">
                            @if($photo)
                                <img src="{{ asset('storage/'.$photo) }}" alt="{{ $bizName }}">
                            @else
                                {{ $initials }}
                            @endif
                        </div>
                        <div class="sp-card-rating">
                            <svg viewBox="0 0 24 24"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>
                            <span class="sp-card-rating-val">{{ $avgR > 0 ? number_format($avgR,1) : '—' }}</span>
                            <span class="sp-card-rating-ct">({{ $rCount }})</span>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="sp-card-body">
                        <div class="sp-biz-name">{{ $bizName }}</div>

                        @if($fullName && $fullName !== $bizName)
                            <div class="sp-owner-name">{{ $fullName }}</div>
                        @endif

                        @if($tagline)
                            <div class="sp-tagline">"{{ $tagline }}"</div>
                        @endif

                        @if($location)
                        <div class="sp-location">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M6 1C4.343 1 3 2.343 3 4c0 2.625 3 7 3 7s3-4.375 3-7c0-1.657-1.343-3-3-3z"/>
                                <circle cx="6" cy="4" r="1"/>
                            </svg>
                            {{ $location }}
                        </div>
                        @endif

                        <div class="sp-card-divider"></div>

                    </div>
                </div>
                @endforeach

                <div class="sp-no-results" id="spNoResults">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="22" cy="22" r="14"/><path d="M34 34l8 8M18 22h8M22 18v8"/></svg>
                    <div class="sp-no-results-title">No suppliers found</div>
                    <p class="sp-no-results-sub">Try adjusting your search or filters.</p>
                </div>
            </div>

            @else
            <div class="sp-empty reveal">
                <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="24" cy="20" r="10"/><path d="M4 44c0-8 9-14 20-14s20 6 20 14"/></svg>
                <div class="sp-empty-title">No suppliers yet</div>
                <p class="sp-empty-sub">No verified suppliers in the directory yet.<br>Check back soon.</p>
            </div>
            @endif
        </div>

        <hr class="section-divider">

        {{-- ════════════════════════
             POPULAR PACKAGES
        ════════════════════════ --}}
        <div class="pp-section">
            <div class="hs-head">
                <div class="hs-head-l">
                    <div class="hs-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6">
                            <path d="M3 5h14M3 10h14M3 15h10"/>
                        </svg>
                    </div>
                    <div>
                        <div class="hs-title">Popular <em>Packages</em></div>
                        <div class="hs-sub">Curated selections from our top suppliers</div>
                    </div>
                </div>
            </div>

            {{-- Tab filter row --}}
            <div class="pp-tab-row">
                <button class="pp-tab pp-active" onclick="ppFilter(this,'all')">All</button>
                @foreach($curatedPackages->pluck('event_type')->unique()->filter() as $type)
                    <button class="pp-tab" onclick="ppFilter(this,'{{ $type }}')">{{ $type }}</button>
                @endforeach
            </div>

            {{-- Package grid --}}
            <div class="pp-grid" id="ppGrid">

                @forelse($curatedPackages as $package)
                    <div class="pp-card" data-cat="{{ $package->event_type }}">

                        {{-- Badge --}}
                        <div class="pp-badge-wrap">
                            <span class="pp-badge">
                                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M6 1l1.35 2.73L10.5 4.2 8.25 6.4l.525 3.1L6 7.98 3.225 9.5l.525-3.1L1.5 4.2l3.15-.47z"/>
                                </svg>
                                {{ $package->event_type ?? 'Package' }}
                            </span>
                        </div>

                        {{-- Body --}}
                        <div class="pp-body">
                            <div class="pp-title-row">
                                <div class="pp-pkg-name">{{ $package->name }}</div>
                                <div class="pp-price">
                                    ₱{{ number_format($package->price, 0) }}
                                </div>
                            </div>

                            <div class="pp-meta">
                                @if($package->guest_capacity)
                                    <span class="pp-chip">
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6">
                                            <circle cx="6" cy="5" r="2.5"/>
                                            <path d="M1.5 14c0-2.5 2-4.5 4.5-4.5s4.5 2 4.5 4.5"/>
                                            <circle cx="12" cy="5" r="2"/>
                                            <path d="M14.5 13.5c0-1.93-1.34-3.5-3-3.5"/>
                                        </svg>
                                        {{ $package->guest_capacity }} guests
                                    </span>
                                @endif
                                @if($package->duration_hours)
                                    <span class="pp-chip">
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6">
                                            <circle cx="8" cy="8" r="6.5"/>
                                            <path d="M8 4.5v4l2.5 1.5"/>
                                        </svg>
                                        {{ $package->duration_hours }}h
                                    </span>
                                @endif
                            </div>

                            {{-- Inclusions --}}
                            @if($package->inclusions && $package->inclusions->count())
                                <div class="pp-inc-label">Inclusions</div>
                                <ul class="pp-inc-list">
                                    @foreach($package->inclusions->take(4) as $inc)
                                        <li>
                                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M2 6l3 3 5-5"/>
                                            </svg>
                                            {{ $inc->title }}
                                        </li>
                                    @endforeach
                                    @if($package->inclusions->count() > 4)
                                        <li style="color: var(--warm-grey); font-style: italic;">
                                            + {{ $package->inclusions->count() - 4 }} more
                                        </li>
                                    @endif
                                </ul>
                            @endif
                        </div>

                        {{-- Footer --}}
                        <div class="pp-foot">
                            @if($package->supplier ?? null)
                                <div class="pp-supplier-micro">
                                    @if($package->supplier->photo)
                                        <img src="{{ asset('storage/' . $package->supplier->photo) }}"
                                             alt="{{ $package->supplier->business_name }}">
                                    @else
                                        <div class="pp-supplier-micro-init">
                                            {{ strtoupper(substr($package->supplier->business_name ?? 'S', 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="pp-supplier-name">
                                        {{ $package->supplier->business_name ?? '' }}
                                    </span>
                                </div>
                            @else
                                <span></span>
                            @endif

                            <a href="{{ route('popular.packages.show', $package->id) }}" class="pp-view-btn">
                                View
                                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M2 6h8M7 3l3 3-3 3"/>
                                </svg>
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="pp-no-results visible">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                        </svg>
                        <h3>No packages found</h3>
                        <p>Check back soon — suppliers are adding new packages.</p>
                    </div>
                @endforelse

                <div class="pp-no-results" id="ppNoResults">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                    </svg>
                    <h3>No packages found</h3>
                    <p>Try selecting a different event type.</p>
                </div>
            </div>

        </div>{{-- /pp-section --}}

    </div>{{-- /main-wrap --}}

    <script>
        /* ── HAMBURGER / MOBILE DRAWER ── */
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

        /* ── POPULAR PACKAGES TAB FILTER ── */
        function ppFilter(btn, cat) {
            document.querySelectorAll('.pp-tab').forEach(t => t.classList.remove('pp-active'));
            btn.classList.add('pp-active');

            const cards = document.querySelectorAll('#ppGrid .pp-card');
            let visible = 0;

            cards.forEach(card => {
                const show = (cat === 'all') || (card.dataset.cat === cat);
                card.classList.toggle('pp-hidden', !show);
                if (show) visible++;
            });

            const noRes = document.getElementById('ppNoResults');
            if (noRes) noRes.classList.toggle('visible', visible === 0);
        }
    </script>

</x-client-layout>