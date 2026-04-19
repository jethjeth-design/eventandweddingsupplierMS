<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery — Bikol's Craft</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcomepage/supplier/portfolio.css') }}">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

   <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --gold:        #C9A84C;
            --gold-light:  #E8C97A;
            --gold-dark:   #8A6A1F;
            --blush:       #F2E0D8;
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

        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-body);
            background: var(--ivory);
            color: var(--charcoal);
            overflow-x: hidden;
            font-size: 14px;
            line-height: 1.6;
        }

        /* ── NAVBAR ── */
        nav.main-nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.2rem 3rem;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(201,168,76,0.18);
        }
        .nav-logo {
            font-family: var(--font-display);
            font-size: 1.5rem; font-weight: 700;
            color: var(--charcoal); letter-spacing: -0.01em;
            text-decoration: none;
        }
        .nav-logo span { color: var(--gold); font-style: italic; }
        .nav-links { display: flex; gap: 2rem; align-items: center; }
        .nav-links a {
            font-size: 0.875rem; font-weight: 400; letter-spacing: 0.04em;
            text-transform: uppercase; color: var(--warm-grey);
            text-decoration: none; transition: color 0.2s;
        }
        .nav-links a:hover { color: var(--gold-dark); }
        .nav-links a.active { color: var(--gold-dark); }
        .nav-cta {
            background: var(--charcoal); color: var(--white) !important;
            padding: 0.55rem 1.4rem; border-radius: 2px;
            font-size: 0.8rem !important; letter-spacing: 0.06em !important;
            transition: background 0.2s !important;
        }
        .nav-cta:hover { background: var(--gold-dark) !important; }

        /* ── HAMBURGER ── */
        .hamburger {
            display: none; flex-direction: column; justify-content: center; gap: 5px;
            width: 36px; height: 36px; cursor: pointer; background: none; border: none; padding: 4px;
        }
        .hamburger span { display: block; width: 100%; height: 2px; background: var(--charcoal); border-radius: 2px; transition: transform 0.3s, opacity 0.3s; }
        .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
        .mobile-menu {
            display: none; position: fixed;
            top: 64px; left: 0; right: 0;
            background: var(--white); z-index: 99;
            padding: 1.5rem 2rem 2.5rem;
            flex-direction: column;
            box-shadow: 0 8px 32px rgba(30,27,24,0.1);
            transform: translateY(-110%);
            transition: transform 0.38s cubic-bezier(0.4,0,0.2,1);
            border-top: 2px solid rgba(201,168,76,0.2);
        }
        .mobile-menu.open { transform: translateY(0); }
        .mobile-menu a {
            font-size: 1rem; letter-spacing: 0.05em; text-transform: uppercase;
            color: var(--charcoal); text-decoration: none; padding: 0.9rem 0;
            border-bottom: 1px solid rgba(201,168,76,0.15);
        }
        .mobile-menu a:last-child { border-bottom: none; }
        .mobile-menu .mob-cta {
            margin-top: 1.5rem; background: var(--charcoal); color: var(--white);
            text-align: center; padding: 0.85rem; border-radius: 2px; border-bottom: none !important;
        }
        @media (max-width: 768px) {
            .hamburger { display: flex; }
            .mobile-menu { display: flex; }
            .nav-links { display: none; }
            nav.main-nav { padding: 1rem 1.5rem; }
        }

        /* ── PAGE HEADER ── */
        .page-header {
            margin-top: 64px;
            background: var(--charcoal);
            padding: 2.5rem 8% 2rem;
            position: relative; overflow: hidden;
            border-bottom: 2px solid rgba(201,168,76,0.35);
        }
        .page-header::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px);
            background-size: 22px 22px;
        }
        .page-header::after {
            content: '';
            position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }
        .page-header-inner {
            position: relative; z-index: 1;
            display: flex; align-items: flex-end; justify-content: space-between;
            flex-wrap: wrap; gap: 1rem;
        }
        .ph-eyebrow {
            font-size: 0.68rem; letter-spacing: 0.2em; text-transform: uppercase;
            color: var(--gold); font-weight: 500;
            display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.5rem;
        }
        .ph-eyebrow::before { content: ''; display: block; width: 24px; height: 1px; background: var(--gold); }
        .page-header h1 {
            font-family: var(--font-display);
            font-size: clamp(1.5rem, 3vw, 2.2rem);
            font-weight: 700; color: var(--white); line-height: 1.15;
        }
        .page-header h1 em { color: var(--gold-light); font-style: italic; }
        .ph-count {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 0.72rem; font-weight: 500; letter-spacing: 0.08em;
            text-transform: uppercase; color: var(--gold);
            background: rgba(201,168,76,0.12); border: 1px solid rgba(201,168,76,0.3);
            padding: 5px 14px; border-radius: 2px;
            align-self: flex-end;
        }

        /* ── FILTER BAR ── */
        .filter-bar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0.85rem 8%;
            display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;
        }
        .filter-label {
            font-size: 0.68rem; font-weight: 600; letter-spacing: 0.1em;
            text-transform: uppercase; color: var(--warm-grey);
        }
        .filter-tabs { display: flex; gap: 0.4rem; flex-wrap: wrap; }
        .filter-tab {
            padding: 0.38rem 1rem;
            border: 1px solid var(--border-md); border-radius: 2px;
            font-size: 0.75rem; color: var(--warm-grey); background: var(--ivory);
            cursor: pointer; font-family: var(--font-body); transition: all 0.2s;
        }
        .filter-tab:hover { border-color: var(--gold); color: var(--gold-dark); }
        .filter-tab.active {
            background: var(--gold); border-color: var(--gold);
            color: var(--charcoal); font-weight: 500;
        }

        /* ── PAGE WRAP ── */
        .page-wrap {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2.5rem 2rem 5rem;
        }

        /* ── PORTFOLIO POST CARD ── */
        .portfolio-list { display: flex; flex-direction: column; gap: 1.5rem; }

        .post-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 4px;
            overflow: hidden;
            position: relative;
            transition: box-shadow 0.25s;
        }
        .post-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, var(--gold), var(--blush-deep), var(--gold));
            transform: scaleX(0); transform-origin: left;
            transition: transform 0.35s ease; z-index: 1;
        }
        .post-card:hover { box-shadow: 0 6px 28px rgba(30,27,24,0.08); }
        .post-card:hover::before { transform: scaleX(1); }

        /* Post header */
        .post-head {
            padding: 1.1rem 1.25rem 0.9rem;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 1px solid var(--border);
        }
        .post-head-l { display: flex; align-items: center; gap: 0.75rem; }
        .post-avatar {
            width: 42px; height: 42px; border-radius: 50%;
            border: 2px solid rgba(201,168,76,0.3);
            overflow: hidden; flex-shrink: 0;
            background: var(--charcoal);
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display); font-size: 1rem;
            font-weight: 700; color: var(--gold);
        }
        .post-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .post-title {
            font-family: var(--font-display);
            font-size: 1rem; font-weight: 600;
            color: var(--charcoal); line-height: 1.2;
        }
        .post-date {
            font-size: 0.72rem; color: var(--warm-grey); margin-top: 1px;
        }
        .post-delete-btn {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 0.38rem 0.9rem;
            border: 1px solid #F5CDD0; border-radius: 2px;
            background: #FEF2F2; color: #B91C1C;
            font-size: 0.72rem; font-weight: 500; letter-spacing: 0.04em;
            cursor: pointer; font-family: var(--font-body); text-transform: uppercase;
            transition: background 0.2s, border-color 0.2s;
        }
        .post-delete-btn:hover { background: #FEE2E2; border-color: #FECACA; }
        .post-delete-btn svg { width: 13px; height: 13px; }

        /* Description */
        .post-desc {
            padding: 0.9rem 1.25rem 0;
            font-size: 0.875rem; color: var(--warm-grey); line-height: 1.7;
        }

        /* ══════════════════════════════════
           FACEBOOK-STYLE MOSAIC
        ══════════════════════════════════ */
        .pf-mosaic {
            margin: 0.9rem 0 0;      /* flush left/right like Facebook */
            overflow: hidden;
            cursor: pointer;
            position: relative;
            background: #EDE8E2;
            line-height: 0;
            gap: 2px;
        }

        /* 1 photo — full width, natural 16:9 */
        .pf-mosaic.count-1 { display: block; aspect-ratio: 16/9; }
        .pf-mosaic.count-1 .pf-mos-cell { width: 100%; height: 100%; }

        /* 2 photos — equal halves */
        .pf-mosaic.count-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            height: 300px;
        }

        /* 3 photos — big left, 2 stacked right */
        .pf-mosaic.count-3 {
            display: grid;
            grid-template-columns: 2fr 1fr;
            grid-template-rows: 1fr 1fr;
            height: 340px;
        }
        .pf-mosaic.count-3 .pf-mos-cell:first-child { grid-row: 1 / 3; }

        /* 4 photos — 2×2 */
        .pf-mosaic.count-4 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            height: 360px;
        }

        /* 5 photos — 1 big top full-width, 4 below in 2×2 */
        .pf-mosaic.count-5 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 55% 45%;
            height: 380px;
        }
        .pf-mosaic.count-5 .pf-mos-cell:first-child { grid-column: 1 / 3; }

        /* 6+ photos — big left spanning 2 rows, right col 2 stacked; bottom row 3 */
        .pf-mosaic.count-6plus {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: 55% 45%;
            height: 380px;
        }
        .pf-mosaic.count-6plus .pf-mos-cell:first-child { grid-column: 1 / 3; }

        /* Cell shared */
        .pf-mos-cell {
            position: relative;
            overflow: hidden;
            background: #EDE8E2;
        }
        .pf-mos-cell img {
            width: 100%; height: 100%;
            object-fit: cover; display: block;
            transition: transform 0.35s ease;
        }
        .pf-mos-cell:hover img { transform: scale(1.04); }

        /* +N overlay */
        .pf-mos-more {
            position: absolute; inset: 0;
            background: rgba(30,27,24,0.62);
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display); font-size: 1.9rem;
            font-weight: 700; color: var(--white);
            pointer-events: none;
        }

        /* Gold tint on hover */
        .pf-mosaic::after {
            content: '';
            position: absolute; inset: 0;
            background: rgba(201,168,76,0.05);
            opacity: 0; transition: opacity 0.2s; pointer-events: none;
        }
        .pf-mosaic:hover::after { opacity: 1; }

        /* "View all" hint */
        .mosaic-view-hint {
            position: absolute; bottom: 10px; right: 12px; z-index: 2;
            background: rgba(30,27,24,0.72); color: var(--gold-light);
            font-size: 0.65rem; font-weight: 500; letter-spacing: 0.08em;
            text-transform: uppercase; padding: 3px 10px; border-radius: 2px;
            pointer-events: none; opacity: 0; transition: opacity 0.2s;
        }
        .pf-mosaic:hover .mosaic-view-hint { opacity: 1; }

        /* Mobile mosaic height adjustments */
        @media (max-width: 600px) {
            .pf-mosaic.count-2 { height: 200px; }
            .pf-mosaic.count-3,
            .pf-mosaic.count-4 { height: 240px; }
            .pf-mosaic.count-5,
            .pf-mosaic.count-6plus { height: 260px; }
        }

        /* Video */
        .post-video {
            margin: 0.9rem 0 0;
            background: var(--charcoal);
        }
        .post-video video { display: block; width: 100%; max-height: 480px; }

        /* Post footer */
        .post-foot {
            padding: 0.8rem 1.25rem;
            display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;
        }
        .post-tag {
            font-size: 0.65rem; font-weight: 600; letter-spacing: 0.06em;
            text-transform: uppercase; color: var(--gold-dark);
            background: rgba(201,168,76,0.09); border: 1px solid rgba(201,168,76,0.22);
            padding: 3px 9px; border-radius: 2px;
        }

        /* ── EMPTY STATE ── */
        .gallery-empty {
            text-align: center; padding: 5rem 2rem;
            background: var(--white); border: 1px solid var(--border); border-radius: 4px;
        }
        .gallery-empty-icon {
            width: 64px; height: 64px;
            margin: 0 auto 1.25rem;
            background: var(--ivory); border: 1px solid var(--border-md);
            border-radius: 4px; display: flex; align-items: center; justify-content: center;
        }
        .gallery-empty-icon svg { width: 28px; height: 28px; color: var(--gold); opacity: 0.5; }
        .gallery-empty h3 {
            font-family: var(--font-display); font-size: 1.2rem;
            font-weight: 600; color: var(--charcoal); margin-bottom: 0.4rem;
        }
        .gallery-empty p { font-size: 0.875rem; color: var(--warm-grey); line-height: 1.7; }

        /* ── LIGHTBOX ── */
        .lb-backdrop {
            position: fixed; inset: 0; z-index: 1000;
            background: rgba(18,15,12,0.95);
            display: none; align-items: center; justify-content: center;
            padding: 1rem;
        }
        .lb-backdrop.open { display: flex; }
        .lb-inner {
            position: relative; width: 100%; max-width: 900px;
            display: flex; flex-direction: column; align-items: center;
        }
        .lb-header {
            width: 100%; display: flex; align-items: center; justify-content: space-between;
            padding: 0 0 0.75rem;
        }
        .lb-title {
            font-family: var(--font-display); font-size: 0.95rem;
            font-weight: 600; color: var(--gold-light);
            letter-spacing: 0.02em;
        }
        .lb-counter { font-size: 0.72rem; color: rgba(255,255,255,0.4); }
        .lb-close {
            width: 34px; height: 34px;
            border: 1px solid rgba(201,168,76,0.35); border-radius: 2px;
            background: rgba(201,168,76,0.08);
            cursor: pointer; font-size: 20px; color: rgba(255,255,255,0.65);
            display: flex; align-items: center; justify-content: center;
            transition: border-color 0.2s, color 0.2s; flex-shrink: 0;
        }
        .lb-close:hover { border-color: var(--gold); color: var(--gold); }
        .lb-img-wrap {
            width: 100%; position: relative;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(201,168,76,0.12);
            border-radius: 3px; overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            min-height: 300px; max-height: 72vh;
        }
        .lb-img {
            max-width: 100%; max-height: 72vh;
            object-fit: contain; display: block;
        }
        .lb-nav-btn {
            position: absolute; top: 50%; transform: translateY(-50%);
            width: 42px; height: 42px;
            border: 1px solid rgba(201,168,76,0.35); border-radius: 2px;
            background: rgba(18,15,12,0.7);
            cursor: pointer; font-size: 20px; color: rgba(255,255,255,0.8);
            display: flex; align-items: center; justify-content: center;
            transition: background 0.2s, border-color 0.2s;
        }
        .lb-nav-btn:hover { background: rgba(201,168,76,0.18); border-color: var(--gold); }
        .lb-prev { left: 10px; }
        .lb-next { right: 10px; }
        .lb-dots {
            display: flex; gap: 6px; margin-top: 0.85rem;
            justify-content: center; flex-wrap: wrap;
        }
        .lb-dot {
            width: 22px; height: 3px; border-radius: 2px;
            background: rgba(255,255,255,0.2); cursor: pointer; transition: all 0.25s;
        }
        .lb-dot.active { background: var(--gold); width: 36px; }

        /* ── REVEAL ── */
        .reveal { opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .reveal.visible { opacity: 1; transform: none; }

        /* ── FOOTER ── */
        footer {
            background: var(--charcoal);
            border-top: 1px solid rgba(201,168,76,0.2);
            padding: 2.5rem 8%;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 1rem;
        }
        .footer-brand { font-family: var(--font-display); font-size: 1.15rem; font-weight: 700; color: var(--white); }
        .footer-brand span { color: var(--gold); font-style: italic; }
        .footer-copy { font-size: 0.78rem; color: rgba(255,255,255,0.3); }
        .footer-links { display: flex; gap: 1.5rem; }
        .footer-links a { font-size: 0.78rem; color: rgba(255,255,255,0.4); text-decoration: none; transition: color 0.2s; }
        .footer-links a:hover { color: var(--gold-light); }
   </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="main-nav">
    <a href="{{ route('welcomepage.welcome') }}" class="nav-logo">Bikol's<span>Craft</span></a>
    <div class="nav-links">
        <a href="{{ route('welcomepage.welcome') }}">Home</a>
        <a href="{{ route('welcomepage.profile') }}">Suppliers</a>
        <a href="#">Events</a>
        <a href="{{ route('welcomepage.package') }}">Packages</a>
        <a href="{{ route('welcomepage.gallery') }}" class="active">Gallery</a>
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="nav-cta">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Sign In</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-cta">Get Started</a>
                @endif
            @endauth
        @endif
    </div>
    <button class="hamburger" id="hamburger"><span></span><span></span><span></span></button>
</nav>

<div class="mobile-menu" id="mobileMenu">
    <a href="{{ route('welcomepage.welcome') }}" onclick="closeMenu()">Home</a>
    <a href="{{ route('welcomepage.profile') }}" onclick="closeMenu()">Suppliers</a>
    <a href="#" onclick="closeMenu()">Events</a>
    <a href="{{ route('welcomepage.package') }}" onclick="closeMenu()">Packages</a>
    <a href="{{route('welcomepage.gallery')}}" onclick="closeMenu()">Gallery</a>
    @if (Route::has('login'))
        @auth
            <a href="{{ url('/dashboard') }}" class="mob-cta">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="mob-cta">Sign In</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="mob-cta" style="margin-top:0.5rem;">Get Started</a>
            @endif
        @endauth
    @endif
</div>

{{-- PAGE HEADER --}}
<div class="page-header">
    <div class="page-header-inner">
        <div>
            <div class="ph-eyebrow">Portfolio</div>
            <h1>Supplier <em>Gallery</em></h1>
        </div>
        @if(isset($portfolios) && count($portfolios))
            <span class="ph-count">{{ count($portfolios) }} post{{ count($portfolios) !== 1 ? 's' : '' }}</span>
        @endif
    </div>
</div>

{{-- FILTER BAR --}}
<div class="filter-bar">
    <span class="filter-label">Filter</span>
    <div class="filter-tabs">
        <button class="filter-tab active" data-filter="all">All</button>
        <button class="filter-tab" data-filter="photos">Photos</button>
        <button class="filter-tab" data-filter="videos">Videos</button>
    </div>
</div>

{{-- MAIN CONTENT --}}
<div class="page-wrap">

    @if(isset($portfolios) && count($portfolios))
    <div class="portfolio-list" id="portfolioList">

        @foreach($portfolios as $portfolio)
        @php
            $imgs     = $portfolio->images ?? [];
            $imgCount = count($imgs);
            $hasVideo = !empty($portfolio->video);
            $allUrls  = array_map(fn($i) => asset('storage/'.$i), $imgs);
            $allJson  = json_encode($allUrls);

            // Facebook mosaic class + how many cells to render
            if ($imgCount === 1) {
                $cls = 'count-1'; $maxShow = 1;
            } elseif ($imgCount === 2) {
                $cls = 'count-2'; $maxShow = 2;
            } elseif ($imgCount === 3) {
                $cls = 'count-3'; $maxShow = 3;
            } elseif ($imgCount === 4) {
                $cls = 'count-4'; $maxShow = 4;
            } elseif ($imgCount === 5) {
                $cls = 'count-5'; $maxShow = 5;
            } else {
                $cls = 'count-6plus'; $maxShow = 4; // last cell shows +N
            }

            $supplierProfile = $portfolio->supplierProfile;
        @endphp

        <div class="post-card reveal"
             data-type="{{ ($imgCount > 0 && $hasVideo) ? 'both' : ($imgCount > 0 ? 'photos' : 'videos') }}">

            {{-- Post header --}}
            <div class="post-head">
                <div class="post-head-l">
                    <div class="post-avatar">
                        @if(!empty($supplierProfile->photo))
                            <img src="{{ asset('storage/'.$supplierProfile->photo) }}" alt="Supplier Photo">
                        @else
                            {{ strtoupper(substr($supplierProfile->business_name ?? 'BC', 0, 2)) }}
                        @endif
                    </div>
                    <div>
                        <div class="post-title">{{ $portfolio->title }}</div>
                        <div class="post-date">
                            {{ $portfolio->created_at ? $portfolio->created_at->diffForHumans() : '' }}
                        </div>
                    </div>
                </div>

                @auth
                    @if(auth()->user()->supplierProfile
                        && auth()->user()->supplierProfile->id === $portfolio->supplier_id)
                    <form method="POST"
                          action="{{ route('supplier.portfolio.destroy', $portfolio->id) }}"
                          onsubmit="return confirm('Remove this portfolio item?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="post-delete-btn">
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 3.5h10M5 3.5V2.5h4v1M4.5 3.5v7a1 1 0 001 1h3a1 1 0 001-1v-7"/></svg>
                            Delete
                        </button>
                    </form>
                    @endif
                @endauth
            </div>

            {{-- Description --}}
            @if($portfolio->description)
            <div class="post-desc">{{ $portfolio->description }}</div>
            @endif

            {{-- Facebook-style image mosaic --}}
            @if($imgCount > 0)
            <div class="pf-mosaic {{ $cls }}">
                @for($ci = 0; $ci < $maxShow; $ci++)
                @php $isLast = ($ci === $maxShow - 1); $remaining = $imgCount - $maxShow; @endphp
                <div class="pf-mos-cell"
                     onclick="lbOpen({{ $allJson }}, {{ $ci }}, '{{ addslashes($portfolio->title) }}')">
                    <img src="{{ asset('storage/'.$imgs[$ci]) }}" alt="" loading="lazy">
                    @if($isLast && $remaining > 0)
                        <div class="pf-mos-more">+{{ $remaining }}</div>
                    @endif
                </div>
                @endfor
                <div class="mosaic-view-hint">View all</div>
            </div>
            @endif

            {{-- Video --}}
            @if($hasVideo)
            <div class="post-video">
                <video controls preload="metadata" style="width:100%; max-height:480px;">
                    <source src="{{ asset('storage/'.$portfolio->video) }}">
                    Your browser does not support video playback.
                </video>
            </div>
            @endif

            {{-- Post footer --}}
            <div class="post-foot">
                @if($imgCount > 0)
                    <span class="post-tag">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:2px;"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                        {{ $imgCount }} photo{{ $imgCount !== 1 ? 's' : '' }}
                    </span>
                @endif
                @if($hasVideo)
                    <span class="post-tag">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:2px;"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        Video
                    </span>
                @endif
                @if($portfolio->supplierProfile->category ?? false)
                    <span class="post-tag">{{ $portfolio->supplierProfile->category }}</span>
                @endif
            </div>

        </div>{{-- /post-card --}}
        @endforeach

    </div>

    @else

    <div class="gallery-empty reveal">
        <div class="gallery-empty-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="3" y="3" width="18" height="18" rx="3"/>
                <circle cx="8.5" cy="8.5" r="1.5"/>
                <path d="M21 15l-5-5L5 21"/>
            </svg>
        </div>
        <h3>No gallery items yet</h3>
        <p>Suppliers haven't uploaded any portfolio photos or videos yet.<br>Check back soon.</p>
    </div>

    @endif

</div>{{-- end page-wrap --}}

{{-- LIGHTBOX --}}
<div class="lb-backdrop" id="lbBackdrop">
    <div class="lb-inner">
        <div class="lb-header">
            <div class="lb-title" id="lbTitle"></div>
            <div style="display:flex;align-items:center;gap:0.75rem;">
                <span class="lb-counter" id="lbCounter"></span>
                <button class="lb-close" onclick="lbClose()">&#215;</button>
            </div>
        </div>
        <div class="lb-img-wrap">
            <button class="lb-nav-btn lb-prev" onclick="lbMove(-1)">&#8249;</button>
            <img class="lb-img" id="lbImg" src="" alt="">
            <button class="lb-nav-btn lb-next" onclick="lbMove(1)">&#8250;</button>
        </div>
        <div class="lb-dots" id="lbDots"></div>
    </div>
</div>

{{-- FOOTER --}}
<footer>
    <div class="footer-brand">Bikol's<span>Craft</span></div>
    <div class="footer-links">
        <a href="#">Privacy</a>
        <a href="#">Terms</a>
        <a href="#">Support</a>
        <a href="#">Blog</a>
    </div>
    <div class="footer-copy">© {{ date('Y') }} Bikol'sCraft. All rights reserved.</div>
</footer>

<script>
    /* ── HAMBURGER ── */
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

    /* ── SCROLL REVEAL ── */
    const reveals = document.querySelectorAll('.reveal');
    const io = new IntersectionObserver(entries => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 60);
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.08 });
    reveals.forEach(el => io.observe(el));

    /* ── FILTER TABS ── */
    const filterTabs = document.querySelectorAll('.filter-tab');
    const cards = document.querySelectorAll('#portfolioList .post-card');
    filterTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            filterTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            const f = tab.dataset.filter;
            cards.forEach(c => {
                const type = c.dataset.type;
                if (f === 'all') {
                    c.style.display = '';
                } else if (f === 'photos') {
                    c.style.display = (type === 'photos' || type === 'both') ? '' : 'none';
                } else if (f === 'videos') {
                    c.style.display = (type === 'videos' || type === 'both') ? '' : 'none';
                }
            });
        });
    });

    /* ── LIGHTBOX ── */
    let lbImages = [], lbIdx = 0;

    function lbOpen(imgs, startIdx, title) {
        lbImages = imgs;
        lbIdx    = startIdx;
        document.getElementById('lbTitle').textContent = title || '';
        document.getElementById('lbBackdrop').classList.add('open');
        document.body.style.overflow = 'hidden';
        lbRender();
    }

    function lbClose() {
        document.getElementById('lbBackdrop').classList.remove('open');
        document.body.style.overflow = '';
    }

    function lbMove(dir) {
        lbIdx = (lbIdx + dir + lbImages.length) % lbImages.length;
        lbRender();
    }

    function lbRender() {
        const img = document.getElementById('lbImg');
        img.src = lbImages[lbIdx];
        document.getElementById('lbCounter').textContent = (lbIdx + 1) + ' / ' + lbImages.length;

        const dotsEl = document.getElementById('lbDots');
        dotsEl.innerHTML = '';
        lbImages.forEach((_, i) => {
            const d = document.createElement('div');
            d.className = 'lb-dot' + (i === lbIdx ? ' active' : '');
            d.onclick = () => { lbIdx = i; lbRender(); };
            dotsEl.appendChild(d);
        });

        document.querySelector('.lb-prev').style.display = lbImages.length > 1 ? '' : 'none';
        document.querySelector('.lb-next').style.display = lbImages.length > 1 ? '' : 'none';
        dotsEl.style.display = lbImages.length > 1 ? '' : 'none';
    }

    document.getElementById('lbBackdrop').addEventListener('click', function(e) {
        if (e.target === this) lbClose();
    });

    document.addEventListener('keydown', e => {
        if (!document.getElementById('lbBackdrop').classList.contains('open')) return;
        if (e.key === 'ArrowRight') lbMove(1);
        if (e.key === 'ArrowLeft')  lbMove(-1);
        if (e.key === 'Escape')     lbClose();
    });

    window.lbOpen = lbOpen;
</script>
</body>
</html>