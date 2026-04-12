<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bikol's Craft – Event & Wedding Supplier Management</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

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
                --font-display:'Playfair Display', Georgia, serif;
                --font-body:   'DM Sans', sans-serif;
            }

            html { scroll-behavior: smooth; }

            body {
                font-family: var(--font-body);
                background: var(--white);
                color: var(--charcoal);
                overflow-x: hidden;
            }

            /* ── NAVBAR ── */
            nav.main-nav {
                position: fixed; top: 0; left: 0; right: 0; z-index: 100;
                display: flex; align-items: center; justify-content: space-between;
                padding: 1.2rem 3rem;
                background: rgba(255,255,255,0.92);
                backdrop-filter: blur(16px);
                border-bottom: 1px solid rgba(201,168,76,0.18);
                transition: background 0.3s;
            }
            .nav-logo {
                font-family: var(--font-display);
                font-size: 1.5rem; font-weight: 700;
                color: var(--charcoal); letter-spacing: -0.01em;
            }
            .nav-logo span { color: var(--gold); font-style: italic; }
            .nav-links { display: flex; gap: 2rem; align-items: center; }
            .nav-links a {
                font-size: 0.875rem; font-weight: 400; letter-spacing: 0.04em;
                text-transform: uppercase; color: var(--warm-grey);
                text-decoration: none; transition: color 0.2s;
            }
            .nav-links a:hover { color: var(--gold-dark); }
            .nav-cta {
                background: var(--charcoal); color: var(--white) !important;
                padding: 0.55rem 1.4rem; border-radius: 2px;
                font-size: 0.8rem !important; letter-spacing: 0.06em !important;
                transition: background 0.2s !important;
            }
            .nav-cta:hover { background: var(--gold-dark) !important; color: var(--white) !important; }

            /* ── HERO BANNER ── */
            .hero {
                position: relative; width: 100%; height: 120vh; min-height: 640px;
                overflow: hidden;
            }
            .banner-slides { position: absolute; inset: 0; }
            .slide {
                position: absolute; inset: 0;
                background-size: cover; background-position: center;
                opacity: 0; transition: opacity 1.2s ease-in-out;
            }
            .slide.active { opacity: 1; }
            .slide::after {
                content: ''; position: absolute; inset: 0;
                background: linear-gradient(135deg,rgba(30,27,24,0.65) 0%,rgba(30,27,24,0.3) 50%,rgba(201,168,76,0.15) 100%);
            }

            /* ── SLIDE BACKGROUND IMAGES REMOVED FROM CSS — now inline style on each .slide ── */

            .hero-content {
                position: relative; z-index: 2;
                height: 120%; display: flex; flex-direction: column;
                align-items: flex-start; justify-content: center;
                padding: 0 10% 4rem; max-width: 860px;
            }
            .hero-tag {
                font-size: 0.72rem; letter-spacing: 0.18em; text-transform: uppercase;
                color: var(--gold-light); font-weight: 500;
                display: flex; align-items: center; gap: 0.75rem;
                margin-bottom: 1.4rem; opacity: 0;
                animation: fadeUp 0.8s 0.4s forwards;
            }
            .hero-tag::before { content: ''; display: block; width: 40px; height: 1px; background: var(--gold); }
            .hero-title {
                font-family: var(--font-display);
                font-size: clamp(2.8rem, 6vw, 5.5rem);
                font-weight: 700; line-height: 1.08; color: var(--white);
                margin-bottom: 1.4rem; opacity: 0;
                animation: fadeUp 0.9s 0.6s forwards;
            }
            .hero-title em { color: var(--gold-light); font-style: italic; }
            .hero-subtitle {
                font-size: clamp(0.95rem, 1.6vw, 1.1rem);
                color: rgba(255,255,255,0.72); line-height: 1.7;
                max-width: 480px; margin-bottom: 2.5rem;
                opacity: 0; animation: fadeUp 0.9s 0.8s forwards;
            }
            .hero-actions {
                display: flex; gap: 1rem; flex-wrap: wrap;
                opacity: 0; animation: fadeUp 0.9s 1s forwards;
            }
            .btn-primary {
                background: var(--gold); color: var(--charcoal);
                padding: 0.85rem 2rem; border-radius: 2px;
                font-size: 0.82rem; font-weight: 500; letter-spacing: 0.06em;
                text-transform: uppercase; text-decoration: none;
                transition: background 0.2s, transform 0.2s; display: inline-block;
            }
            .btn-primary:hover { background: var(--gold-light); transform: translateY(-2px); }
            .btn-ghost {
                background: transparent; color: var(--white);
                padding: 0.85rem 2rem; border-radius: 2px;
                font-size: 0.82rem; font-weight: 500; letter-spacing: 0.06em;
                text-transform: uppercase; text-decoration: none;
                border: 1px solid rgba(255,255,255,0.4);
                transition: border-color 0.2s, background 0.2s, transform 0.2s; display: inline-block;
            }
            .btn-ghost:hover { border-color: var(--gold); background: rgba(201,168,76,0.12); transform: translateY(-2px); }

            .slide-dots {
                position: absolute; bottom: 2.5rem; left: 10%;
                z-index: 3; display: flex; gap: 0.5rem; align-items: center;
            }
            .dot {
                width: 24px; height: 3px; border-radius: 2px;
                background: rgba(255,255,255,0.35); cursor: pointer;
                transition: background 0.3s, width 0.3s;
            }
            .dot.active { background: var(--gold); width: 40px; }
            .slide-counter {
                position: absolute; bottom: 2.5rem; right: 5%;
                z-index: 3; color: rgba(255,255,255,0.45);
                font-size: 0.75rem; letter-spacing: 0.08em;
            }
            .slide-counter .current { color: var(--gold-light); font-size: 1.1rem; }
            .progress-bar {
                position: absolute; bottom: 0; left: 0;
                height: 2px; background: var(--gold); width: 0%; z-index: 4;
                transition: width linear;
            }

            /* ── STATS BAR ── */
            .stats-bar {
                background: var(--white);
                display: grid; grid-template-columns: repeat(4, 1fr);
                border-bottom: 2px solid var(--gold-dark);
                border-top: 1px solid #F0EBE5;
            }
            .stat-item {
                padding: 1.8rem 2rem; text-align: center;
                border-right: 1px solid #F0EBE5;
                transition: background 0.2s;
            }
            .stat-item:last-child { border-right: none; }
            .stat-item:hover { background: rgba(201,168,76,0.05); }
            .stat-num {
                font-family: var(--font-display); font-size: 2rem;
                font-weight: 700; color: var(--gold-dark); display: block;
            }
            .stat-label {
                font-size: 0.72rem; letter-spacing: 0.1em; text-transform: uppercase;
                color: var(--warm-grey); margin-top: 0.2rem;
            }

            /* ── SECTION SHARED ── */
            section { padding: 6rem 8%; }
            .section-eyebrow {
                font-size: 0.7rem; letter-spacing: 0.2em; text-transform: uppercase;
                color: var(--gold-dark); font-weight: 500;
                display: flex; align-items: center; gap: 0.6rem; margin-bottom: 1rem;
            }
            .section-eyebrow::after { content: ''; flex: 0 0 32px; height: 1px; background: var(--gold); }
            h2.section-title {
                font-family: var(--font-display); font-size: clamp(2rem, 3.5vw, 3rem);
                font-weight: 700; line-height: 1.2; color: var(--charcoal);
            }
            h2.section-title em { color: var(--gold-dark); font-style: italic; }

            /* ── FEATURES ── */
            .features-section { background: var(--white); }
            .features-grid {
                display: grid; grid-template-columns: repeat(3, 1fr);
                gap: 1px; margin-top: 3.5rem;
                background: #F0EBE5;
                border: 1px solid #F0EBE5;
                border-radius: 4px;
                overflow: hidden;
            }
            .feature-card {
                background: var(--white); padding: 2.5rem 2rem;
                border: none; position: relative; overflow: hidden;
                transition: background 0.3s;
            }
            .feature-card::before {
                content: ''; position: absolute;
                top: 0; left: 0; right: 0; height: 2px;
                background: linear-gradient(90deg, var(--gold), var(--blush-deep));
                transform: scaleX(0); transform-origin: left;
                transition: transform 0.35s ease;
            }
            .feature-card:hover { background: rgba(201,168,76,0.04); }
            .feature-card:hover::before { transform: scaleX(1); }
            .feature-icon { width: 48px; height: 48px; margin-bottom: 1.4rem; color: var(--gold-dark); }
            .feature-title {
                font-family: var(--font-display); font-size: 1.2rem;
                font-weight: 600; margin-bottom: 0.7rem; color: var(--charcoal);
            }
            .feature-desc { font-size: 0.875rem; color: var(--warm-grey); line-height: 1.7; }

            /* ── CATEGORIES ── */
            .categories-section {
                background: var(--white);
                padding-bottom: 5rem;
                border-top: 1px solid #F0EBE5;
                border-bottom: 1px solid #F0EBE5;
            }
            .cats-grid {
                display: grid; grid-template-columns: repeat(6, 1fr);
                gap: 1rem; margin-top: 3rem;
            }
            .cat-card {
                position: relative; aspect-ratio: 3/4;
                border-radius: 6px; overflow: hidden;
                cursor: pointer; background: #F5F0EB;
                display: flex; align-items: flex-end;
                transition: transform 0.3s, box-shadow 0.3s;
                border: 1px solid #F0EBE5;
            }
            .cat-card:hover { transform: translateY(-6px); box-shadow: 0 12px 32px rgba(30,27,24,0.12); }
            .cat-bg {
                position: absolute; inset: 0; background-size: cover;
                background-position: center; opacity: 0.55;
                transition: opacity 0.3s, transform 0.4s;
            }
            .cat-card:hover .cat-bg { opacity: 0.7; transform: scale(1.06); }

            /* ── CATEGORY BACKGROUND IMAGES REMOVED FROM CSS — now inline style on each .cat-bg ── */

            .cat-info {
                position: relative; z-index: 1; padding: 1rem 0.8rem;
                width: 100%;
                background: linear-gradient(0deg, rgba(30,27,24,0.9) 0%, transparent 100%);
            }
            .cat-name { font-family: var(--font-display); font-size: 0.95rem; font-weight: 600; color: var(--white); line-height: 1.2; }
            .cat-count { font-size: 0.68rem; color: var(--gold-light); letter-spacing: 0.06em; margin-top: 0.15rem; }

            /* ── HOW IT WORKS ── */
            .how-section {
                background: var(--white);
                border-top: 1px solid #F0EBE5;
            }
            .steps-row {
                display: grid; grid-template-columns: repeat(4, 1fr);
                gap: 0; margin-top: 3.5rem; position: relative;
            }
            .steps-row::before {
                content: ''; position: absolute;
                top: 28px; left: 12%; right: 12%; height: 1px;
                background: linear-gradient(90deg, #F0EBE5, var(--gold), #F0EBE5);
                z-index: 0;
            }
            .step { text-align: center; padding: 0 1.5rem; position: relative; z-index: 1; }
            .step-num {
                width: 56px; height: 56px; border-radius: 50%;
                background: var(--white); border: 2px solid var(--gold);
                font-family: var(--font-display); font-size: 1.3rem;
                font-weight: 700; color: var(--gold-dark);
                display: flex; align-items: center; justify-content: center;
                margin: 0 auto 1.2rem;
                box-shadow: 0 4px 16px rgba(201,168,76,0.15);
            }
            .step-title { font-family: var(--font-display); font-size: 1.05rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--charcoal); }
            .step-desc { font-size: 0.83rem; color: var(--warm-grey); line-height: 1.65; }

            /* ── CTA ── */
            .cta-section {
                background: var(--white);
                text-align: center; padding: 7rem 8%;
                position: relative; overflow: hidden;
                border-top: 1px solid #F0EBE5;
                border-bottom: 1px solid #F0EBE5;
            }
            .cta-section::before {
                content: '';
                position: absolute;
                top: 0; left: 8%; right: 8%; height: 1px;
                background: linear-gradient(90deg, transparent, var(--gold), transparent);
            }
            .cta-section::after {
                content: '';
                position: absolute; inset: 0;
                background: radial-gradient(ellipse 60% 60% at 50% 50%, rgba(201,168,76,0.06) 0%, transparent 70%);
                pointer-events: none;
            }
            .cta-section h2 {
                font-family: var(--font-display); font-size: clamp(2rem,4vw,3.2rem);
                font-weight: 700; color: var(--charcoal);
                position: relative; z-index: 1; margin-bottom: 1rem;
            }
            .cta-section h2 em { color: var(--gold-dark); font-style: italic; }
            .cta-section p {
                color: var(--warm-grey); font-size: 1rem;
                max-width: 480px; margin: 0 auto 2.5rem; line-height: 1.7;
                position: relative; z-index: 1;
            }
            .cta-btns { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; position: relative; z-index: 1; }
            .cta-section .btn-primary { background: var(--gold); color: var(--charcoal); }
            .cta-section .btn-primary:hover { background: var(--gold-dark); color: var(--white); }
            .cta-section .btn-ghost {
                color: var(--charcoal); border: 1.5px solid rgba(30,27,24,0.2);
            }
            .cta-section .btn-ghost:hover { border-color: var(--gold); color: var(--gold-dark); background: rgba(201,168,76,0.06); }

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
            .footer-links a {
                font-size: 0.78rem; color: rgba(255,255,255,0.4);
                text-decoration: none; transition: color 0.2s;
            }
            .footer-links a:hover { color: var(--gold-light); }

            /* ── ANIMATIONS ── */
            @keyframes fadeUp {
                from { opacity: 0; transform: translateY(28px); }
                to   { opacity: 1; transform: translateY(0); }
            }
            .reveal { opacity: 0; transform: translateY(32px); transition: opacity 0.7s ease, transform 0.7s ease; }
            .reveal.visible { opacity: 1; transform: none; }

            /* ── RESPONSIVE ── */
            @media (max-width: 900px) {
                nav.main-nav { padding: 1rem 1.5rem; }
                .hero-content { padding: 0 6% 4rem; }
                .features-grid { grid-template-columns: 1fr 1fr; }
                .cats-grid { grid-template-columns: repeat(3, 1fr); }
                .steps-row { grid-template-columns: 1fr 1fr; gap: 2rem; }
                .steps-row::before { display: none; }
                .stats-bar { grid-template-columns: 1fr 1fr; }
            }
            @media (max-width: 600px) {
                .features-grid { grid-template-columns: 1fr; }
                .cats-grid { grid-template-columns: repeat(2, 1fr); }
                .steps-row { grid-template-columns: 1fr; }
                .stats-bar { grid-template-columns: 1fr 1fr; }
                .nav-links { display: none; }
            }

            /* ── HAMBURGER ── */
            .hamburger {
                display: none; flex-direction: column; justify-content: center; gap: 5px;
                width: 36px; height: 36px; cursor: pointer; background: none; border: none; padding: 4px; z-index: 200;
            }
            .hamburger span {
                display: block; width: 100%; height: 2px; background: var(--charcoal);
                border-radius: 2px; transition: transform 0.3s ease, opacity 0.3s ease, width 0.3s ease; transform-origin: center;
            }
            .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
            .hamburger.open span:nth-child(2) { opacity: 0; width: 0; }
            .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

            /* ── MOBILE DRAWER ── */
            .mobile-menu {
                display: none; position: fixed;
                top: 64px; left: 0; right: 0;
                background: var(--white); z-index: 99;
                padding: 1.5rem 2rem 2.5rem;
                flex-direction: column; gap: 0;
                box-shadow: 0 8px 32px rgba(30,27,24,0.1);
                transform: translateY(-110%);
                transition: transform 0.38s cubic-bezier(0.4,0,0.2,1);
                border-top: 2px solid rgba(201,168,76,0.2);
            }
            .mobile-menu.open { transform: translateY(0); }
            .mobile-menu a {
                font-size: 1.05rem; font-weight: 400; letter-spacing: 0.05em; text-transform: uppercase;
                color: var(--charcoal); text-decoration: none; padding: 1rem 0;
                border-bottom: 1px solid rgba(201,168,76,0.15); transition: color 0.2s;
            }
            .mobile-menu a:last-child { border-bottom: none; }
            .mobile-menu a:hover { color: var(--gold-dark); }
            .mobile-menu .mob-cta {
                margin-top: 1.5rem; background: var(--charcoal); color: var(--white) !important;
                text-align: center; padding: 0.85rem 1.4rem; border-radius: 2px;
                font-size: 0.85rem !important; letter-spacing: 0.08em !important; border-bottom: none !important;
            }
            .mobile-menu .mob-cta:hover { background: var(--gold-dark) !important; }

            @media (max-width: 768px) {
                .hamburger { display: flex; }
                .mobile-menu { display: flex; }
            }
        </style>
    </head>
    <body>

        <!-- NAVBAR -->
        <nav class="main-nav">
            <div class="nav-logo">Bikol's<span>Craft</span></div>
            <div class="nav-links">
                <a href="{{ route('welcomepage.welcome') }} " class="active">Home</a>
                <a href="{{ route('welcomepage.profile') }}">Suppliers</a>
                <a href="#">Events</a>
                <a href="{{route('welcomepage.package')}}">Packages</a>
                <a href="{{ route('welcomepage.gallery') }}">Gallery</a>
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
            <button class="hamburger" id="hamburger" aria-label="Toggle navigation">
                <span></span><span></span><span></span>
            </button>
        </nav>

        <!-- MOBILE DRAWER -->
        <div class="mobile-menu" id="mobileMenu">
            <a href="{{ route('welcomepage.welcome') }}" onclick="closeMenu()">Home</a>
            <a href="{{ route('welcomepage.profile') }}" onclick="closeMenu()">Suppliers</a>
            <a href="#" onclick="closeMenu()">Events</a>
            <a href="{{route('welcomepage.package')}}" onclick="closeMenu()">Packages</a>
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

        <!-- HERO BANNER -->
        <section class="hero">
            {{-- ════════════════════════════════════════════════════════
                 BANNER SLIDES — background images set via inline style
                 Replace the URL values below to change slide photos.
            ════════════════════════════════════════════════════════ --}}
            <div class="banner-slides">
                @for ($i = 1; $i <= 5; $i++)
                    <div class="slide {{ $i == 1 ? 'active' : '' }}"
                        style="background-image: url('{{ isset($banner) && $banner->{'slide_'.$i} 
                            ? asset('storage/'.$banner->{'slide_'.$i}) 
                            : asset('images/default.jpg') }}');">
                    </div>
                @endfor
            </div>

            <div class="hero-content">
                <div class="hero-tag">{{ $banner->hero_tag ?? 'Premium Supplier Platform' }}</div>
                <h1 class="hero-title">{{ $banner->hero_title_1 ?? 'Your Perfect Event,' }}<br><em>{{ $banner->hero_title_2 ?? 'Beautifully Managed' }}</em></h1>
                <p class="hero-subtitle">{{ $banner->hero_subtitle ?? 'Connect with the finest venues, caterers, photographers, and decorators. ' }}</p>
                <div class="hero-actions">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-primary">Start Planning Free</a>
                    @else
                        <a href="#features" class="btn-primary">Explore Platform</a>
                    @endif
                    <a href="#categories" class="btn-ghost">Browse Suppliers</a>
                </div>
            </div>
            <div class="slide-dots" id="slideDots"></div>
            <div class="slide-counter">
                <span class="current" id="currentSlide">01</span> / <span id="totalSlides">05</span>
            </div>
            <div class="progress-bar" id="progressBar"></div>
        </section>

        <!-- STATS BAR -->
        <div class="stats-bar">
            <div class="stat-item">
                <span class="stat-num">2,400+</span>
                <div class="stat-label">Verified Suppliers</div>
            </div>
            <div class="stat-item">
                <span class="stat-num">18,000+</span>
                <div class="stat-label">Events Managed</div>
            </div>
            <div class="stat-item">
                <span class="stat-num">98%</span>
                <div class="stat-label">Client Satisfaction</div>
            </div>
            <div class="stat-item">
                <span class="stat-num">150+</span>
                <div class="stat-label">Cities Covered</div>
            </div>
        </div>

        <!-- FEATURES -->
        <section class="features-section" id="features">
            <div class="reveal">
                <div class="section-eyebrow">Why Bikol's Craft</div>
                <h2 class="section-title">{{ $section->section_title ?? 'Default' }}<br><em>{{ $section->section_subtitle ?? 'Default' }}</em></h2>
            </div>
            <div class="features-grid reveal">
                <div class="feature-card">
                    <svg class="feature-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="8" y="14" width="32" height="26" rx="2"/>
                        <path d="M16 14V10M32 14V10M8 22h32"/>
                        <path d="M17 30l4 4 10-10"/>
                    </svg>
                    <div class="feature-title">{{ $section->feature_title ?? 'Default' }}</div>
                    <p class="feature-desc">{{ $section->feature_desc ?? 'Default' }}</p>
                </div>
                <div class="feature-card">
                    <svg class="feature-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="24" cy="20" r="8"/>
                        <path d="M8 40c0-8.837 7.163-16 16-16s16 7.163 16 16"/>
                        <path d="M30 14l8-8M34 10l4 4"/>
                    </svg>
                    <div class="feature-title">{{ $section->feature_title2 ?? 'Default' }}</div>
                    <p class="feature-desc">{{ $section->feature_desc2 ?? 'Default' }}</p>
                </div>
                <div class="feature-card">
                    <svg class="feature-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M6 24L24 6l18 18v18H30V30H18v12H6z"/>
                        <circle cx="24" cy="30" r="3"/>
                    </svg>
                    <div class="feature-title">{{ $section->feature_title3 ?? 'Default' }}</div>
                    <p class="feature-desc">{{ $section->feature_desc3 ?? 'Default' }}</p>
                </div>
                <div class="feature-card">
                    <svg class="feature-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="6" y="8" width="36" height="28" rx="2"/>
                        <path d="M18 36v4M30 36v4M12 40h24"/>
                        <path d="M14 20h20M14 26h12"/>
                    </svg>
                    <div class="feature-title">{{ $section->feature_title4 ?? 'Default' }}</div>
                    <p class="feature-desc">{{ $section->feature_desc4 ?? 'Default' }}</p>
                </div>
                <div class="feature-card">
                    <svg class="feature-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M40 12H8a2 2 0 00-2 2v20a2 2 0 002 2h32a2 2 0 002-2V14a2 2 0 00-2-2z"/>
                        <path d="M24 20v8M20 24h8"/>
                        <circle cx="24" cy="24" r="10"/>
                    </svg>
                    <div class="feature-title">{{ $section->feature_title5 ?? 'Default' }}</div>
                    <p class="feature-desc">{{ $section->feature_desc5 ?? 'Default' }}</p>
                </div>
                <div class="feature-card">
                    <svg class="feature-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M24 4l4.5 9 10 1.5-7.25 7 1.75 10L24 27l-9 4.5 1.75-10L9.5 14.5l10-1.5z"/>
                        <circle cx="24" cy="24" r="6"/>
                    </svg>
                    <div class="feature-title">{{ $section->feature_title6 ?? 'Default' }}</div>
                    <p class="feature-desc">{{ $section->feature_desc6 ?? 'Default' }}</p>
                </div>
            </div>
        </section>

        <!-- SUPPLIER CATEGORIES -->
        <section class="categories-section" id="categories">
            <div class="reveal">
                <div class="section-eyebrow">Browse by Category</div>
                <h2 class="section-title">Find every supplier<br><em>for your dream event</em></h2>
            </div>

            {{-- ════════════════════════════════════════════════════════
                 CATEGORY CARDS — background images set via inline style
                 Replace the URL values below to change category photos.
            ════════════════════════════════════════════════════════ --}}
            <div class="cats-grid reveal">
                <div class="cat-card">
                    <div class="cat-bg"
                         style="background-image: url('https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=400&q=70');"></div>
                    <div class="cat-info">
                        <div class="cat-name">Venues</div>
                        <div class="cat-count">480 Listings</div>
                    </div>
                </div>
                <div class="cat-card">
                    <div class="cat-bg"
                         style="background-image: url('https://images.unsplash.com/photo-1555244162-803834f70033?w=400&q=70');"></div>
                    <div class="cat-info">
                        <div class="cat-name">Catering</div>
                        <div class="cat-count">324 Listings</div>
                    </div>
                </div>
                <div class="cat-card">
                    <div class="cat-bg"
                         style="background-image: url('https://images.unsplash.com/photo-1500541374084-6b26a9d1e5c9?w=400&q=70');"></div>
                    <div class="cat-info">
                        <div class="cat-name">Photography</div>
                        <div class="cat-count">612 Listings</div>
                    </div>
                </div>
                <div class="cat-card">
                    <div class="cat-bg"
                         style="background-image: url('https://images.unsplash.com/photo-1487530811015-780a5b16f8c1?w=400&q=70');"></div>
                    <div class="cat-info">
                        <div class="cat-name">Florals</div>
                        <div class="cat-count">290 Listings</div>
                    </div>
                </div>
                <div class="cat-card">
                    <div class="cat-bg"
                         style="background-image: url('https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=400&q=70');"></div>
                    <div class="cat-info">
                        <div class="cat-name">Music & DJ</div>
                        <div class="cat-count">218 Listings</div>
                    </div>
                </div>
                <div class="cat-card">
                    <div class="cat-bg"
                         style="background-image: url('https://images.unsplash.com/photo-1478146059778-26028b07395a?w=400&q=70');"></div>
                    <div class="cat-info">
                        <div class="cat-name">Décor</div>
                        <div class="cat-count">376 Listings</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- HOW IT WORKS -->
        <section class="how-section">
            <div class="reveal" style="text-align:center">
                <div class="section-eyebrow" style="justify-content:center">Simple Process</div>
                <h2 class="section-title">How it <em>works</em></h2>
            </div>
            <div class="steps-row reveal">
                <div class="step">
                    <div class="step-num">01</div>
                    <div class="step-title">Create Your Event</div>
                    <p class="step-desc">Set your date, guest count, style, and budget to get a personalised supplier match.</p>
                </div>
                <div class="step">
                    <div class="step-num">02</div>
                    <div class="step-title">Browse & Compare</div>
                    <p class="step-desc">Explore curated suppliers, view portfolios, read reviews, and compare quotes side-by-side.</p>
                </div>
                <div class="step">
                    <div class="step-num">03</div>
                    <div class="step-title">Book Securely</div>
                    <p class="step-desc">Confirm bookings with digital contracts, secure deposits, and automated reminders.</p>
                </div>
                <div class="step">
                    <div class="step-num">04</div>
                    <div class="step-title">Celebrate Perfectly</div>
                    <p class="step-desc">Relax on your big day knowing every supplier is coordinated and confirmed.</p>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="cta-section">
            <h2>Ready to plan your <em>perfect event?</em></h2>
            <p>Join thousands of couples and event planners who trust Bikol's Craft to bring their vision to life.</p>
            <div class="cta-btns">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-primary">Create Free Account</a>
                @endif
                <a href="#features" class="btn-ghost">See All Features</a>
            </div>
        </section>

        <!-- FOOTER -->
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
            (function () {
                const slides = document.querySelectorAll('.slide');
                const dotsContainer = document.getElementById('slideDots');
                const currentEl = document.getElementById('currentSlide');
                const totalEl = document.getElementById('totalSlides');
                const progressBar = document.getElementById('progressBar');
                const INTERVAL = 5000;
                let current = 0, timer;

                totalEl.textContent = String(slides.length).padStart(2, '0');

                slides.forEach((_, i) => {
                    const d = document.createElement('div');
                    d.className = 'dot' + (i === 0 ? ' active' : '');
                    d.addEventListener('click', () => goTo(i));
                    dotsContainer.appendChild(d);
                });

                function goTo(idx) {
                    slides[current].classList.remove('active');
                    dotsContainer.children[current].classList.remove('active');
                    current = idx % slides.length;
                    slides[current].classList.add('active');
                    dotsContainer.children[current].classList.add('active');
                    currentEl.textContent = String(current + 1).padStart(2, '0');
                    resetProgress();
                }

                function resetProgress() {
                    progressBar.style.transition = 'none';
                    progressBar.style.width = '0%';
                    requestAnimationFrame(() => {
                        requestAnimationFrame(() => {
                            progressBar.style.transition = `width ${INTERVAL}ms linear`;
                            progressBar.style.width = '100%';
                        });
                    });
                }

                function startAuto() {
                    clearInterval(timer);
                    timer = setInterval(() => goTo(current + 1), INTERVAL);
                    resetProgress();
                }

                startAuto();
            })();

            const reveals = document.querySelectorAll('.reveal');
            const io = new IntersectionObserver(entries => {
                entries.forEach(e => {
                    if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
                });
            }, { threshold: 0.15 });
            reveals.forEach(el => io.observe(el));

            const hamburger = document.getElementById('hamburger');
            const mobileMenu = document.getElementById('mobileMenu');

            hamburger.addEventListener('click', () => {
                const isOpen = mobileMenu.classList.toggle('open');
                hamburger.classList.toggle('open', isOpen);
                document.body.style.overflow = isOpen ? 'hidden' : '';
            });

            function closeMenu() {
                mobileMenu.classList.remove('open');
                hamburger.classList.remove('open');
                document.body.style.overflow = '';
            }

            document.addEventListener('click', (e) => {
                if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) closeMenu();
            });
        </script>
    </body>
</html>