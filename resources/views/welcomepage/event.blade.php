<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Events — WES TEAM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --gold: #C9A84C;
            --gold-light: #E8C97A;
            --gold-dark: #8A6A1F;
            --blush: #F2E0D8;
            --blush-deep: #D4A090;
            --ivory: #FAF7F2;
            --charcoal: #1E1B18;
            --warm-grey: #6B6560;
            --white: #FFFFFF;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body: 'DM Sans', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-body);
            background: var(--white);
            color: var(--charcoal);
            overflow-x: hidden;
        }

        /* ── NAVBAR ── */
        nav.main-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.2rem 3rem;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(201, 168, 76, 0.18);
            transition: background 0.3s;
        }

        .nav-logo {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--charcoal);
            letter-spacing: -0.01em;
            text-decoration: none;
        }

        .nav-logo span {
            color: var(--gold);
            font-style: italic;
        }

        .nav-links {
            display: flex;
            gap: 0.25rem;
            align-items: center;
        }

        .nav-links a {
            font-size: 0.875rem;
            font-weight: 400;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--warm-grey);
            text-decoration: none;
            padding: 0.45rem 0.85rem;
            border-radius: 3px;
            border-bottom: 2px solid transparent;
            transition: color 0.2s, background 0.2s, border-color 0.2s;
        }

        .nav-links a:hover {
            color: var(--gold-dark);
            background: rgba(201, 168, 76, 0.07);
        }

        .nav-links a.nav-active {
            color: var(--gold-dark);
            background: rgba(201, 168, 76, 0.12);
            border-bottom: 2px solid var(--gold);
            font-weight: 500;
        }

        .nav-cta {
            background: var(--charcoal);
            color: var(--white) !important;
            padding: 0.55rem 1.4rem;
            border-radius: 2px;
            font-size: 0.8rem !important;
            letter-spacing: 0.06em !important;
            border-bottom: 2px solid transparent !important;
            transition: background 0.2s !important;
        }

        .nav-cta:hover {
            background: var(--gold-dark) !important;
        }

        .nav-cta.nav-active {
            background: var(--charcoal) !important;
            border-bottom: 2px solid transparent !important;
        }

        /* ── HAMBURGER ── */
        .hamburger {
            display: none;
            flex-direction: column;
            justify-content: center;
            gap: 5px;
            width: 36px;
            height: 36px;
            cursor: pointer;
            background: none;
            border: none;
            padding: 4px;
            z-index: 200;
        }

        .hamburger span {
            display: block;
            width: 100%;
            height: 2px;
            background: var(--charcoal);
            border-radius: 2px;
            transition: transform 0.3s, opacity 0.3s, width 0.3s;
            transform-origin: center;
        }

        .hamburger.open span:nth-child(1) {
            transform: translateY(7px) rotate(45deg);
        }

        .hamburger.open span:nth-child(2) {
            opacity: 0;
            width: 0;
        }

        .hamburger.open span:nth-child(3) {
            transform: translateY(-7px) rotate(-45deg);
        }

        /* ── MOBILE DRAWER ── */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 64px;
            left: 0;
            right: 0;
            background: var(--white);
            z-index: 99;
            padding: 1.5rem 2rem 2.5rem;
            flex-direction: column;
            gap: 0;
            box-shadow: 0 8px 32px rgba(30, 27, 24, 0.1);
            transform: translateY(-110%);
            transition: transform 0.38s cubic-bezier(0.4, 0, 0.2, 1);
            border-top: 2px solid rgba(201, 168, 76, 0.2);
        }

        .mobile-menu.open {
            transform: translateY(0);
        }

        .mobile-menu a {
            font-size: 1.05rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--charcoal);
            text-decoration: none;
            padding: 1rem 0.75rem;
            border-bottom: 1px solid rgba(201, 168, 76, 0.15);
            border-left: 3px solid transparent;
            transition: color 0.2s, background 0.2s, border-color 0.2s, padding 0.2s;
        }

        .mobile-menu a:last-child {
            border-bottom: none;
        }

        .mobile-menu a:hover {
            color: var(--gold-dark);
            background: rgba(201, 168, 76, 0.05);
        }

        .mobile-menu a.mob-active {
            color: var(--gold-dark);
            background: rgba(201, 168, 76, 0.10);
            border-left: 3px solid var(--gold);
            padding-left: calc(0.75rem + 2px);
            font-weight: 500;
        }

        .mobile-menu .mob-cta {
            margin-top: 1.5rem;
            background: var(--charcoal);
            color: var(--white) !important;
            text-align: center;
            padding: 0.85rem 1.4rem;
            border-radius: 2px;
            font-size: 0.85rem !important;
            letter-spacing: 0.08em !important;
            border-bottom: none !important;
            border-left: 3px solid transparent !important;
        }

        .mobile-menu .mob-cta:hover {
            background: var(--gold-dark) !important;
        }

        @media (max-width: 768px) {
            .hamburger {
                display: flex;
            }

            .mobile-menu {
                display: flex;
            }

            nav.main-nav {
                padding: 1rem 1.5rem;
            }

            .nav-links {
                display: none;
            }
        }

        /* ── HERO ── */
        .hero {
            position: relative;
            width: 100%;
            min-height: 30vh;
            display: flex;
            align-items: center;
            background: var(--charcoal);
            overflow: hidden;
            padding-top: 50px;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 80% at 80% 50%, rgba(201, 168, 76, 0.12) 0%, transparent 65%),
                radial-gradient(ellipse 40% 60% at 10% 80%, rgba(242, 224, 216, 0.06) 0%, transparent 60%);
        }

        /* decorative gold rule top */
        .hero::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent 0%, var(--gold) 40%, var(--gold-light) 60%, transparent 100%);
        }

        .hero-inner {
            position: relative;
            z-index: 2;
            width: 100%;
            padding: 5rem 8% 4.5rem;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 1.2rem;
            max-width: 2000px;
        }

        .hero-eyebrow {
            font-size: 0.7rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--gold-light);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            opacity: 0;
            animation: fadeUp 0.8s 0.3s forwards;
        }

        .hero-eyebrow::before {
            content: '';
            display: block;
            width: 40px;
            height: 1px;
            background: var(--gold);
        }

        .hero h1 {
            font-family: var(--font-display);
            font-size: clamp(2.6rem, 5.5vw, 5rem);
            font-weight: 700;
            line-height: 1.08;
            color: var(--white);
            opacity: 0;
            animation: fadeUp 0.9s 0.5s forwards;
        }

        .hero h1 em {
            color: var(--gold-light);
            font-style: italic;
        }

        .hero-sub {
            font-size: clamp(0.9rem, 1.5vw, 1.05rem);
            color: rgba(255, 255, 255, 0.62);
            line-height: 1.75;
            max-width: 500px;
            opacity: 0;
            animation: fadeUp 0.9s 0.7s forwards;
        }

        /* ── BREADCRUMB ── */
        .breadcrumb {
            background: var(--ivory);
            border-bottom: 1px solid #F0EBE5;
            padding: 0.8rem 8%;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            letter-spacing: 0.04em;
            color: var(--warm-grey);
        }

        .breadcrumb a {
            color: var(--warm-grey);
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumb a:hover {
            color: var(--gold-dark);
        }

        .breadcrumb .sep {
            color: var(--gold);
        }

        .breadcrumb .current {
            color: var(--gold-dark);
            font-weight: 500;
        }

        /* ── EVENTS SECTION ── */
        .events-section {
            padding: 5.5rem 8%;
            background: var(--white);
        }

        .section-head {
            margin-bottom: 3.5rem;
        }

        .section-eyebrow {
            font-size: 0.7rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--gold-dark);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 1rem;
        }

        .section-eyebrow::after {
            content: '';
            flex: 0 0 32px;
            height: 1px;
            background: var(--gold);
        }

        h2.section-title {
            font-family: var(--font-display);
            font-size: clamp(2rem, 3.5vw, 3rem);
            font-weight: 700;
            line-height: 1.2;
            color: var(--charcoal);
        }

        h2.section-title em {
            color: var(--gold-dark);
            font-style: italic;
        }

        /* ── EVENT GRID ── */
        .event-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .event-card {
            position: relative;
            border-radius: 6px;
            overflow: hidden;
            background: var(--ivory);
            border: 1px solid #F0EBE5;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: default;
        }

        .event-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(30, 27, 24, 0.1);
        }

        /* gold top accent on hover */
        .event-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--gold), var(--blush-deep));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.35s ease;
            z-index: 2;
        }

        .event-card:hover::before {
            transform: scaleX(1);
        }

        /* image wrapper with fixed ratio */
        .event-img-wrap {
            position: relative;
            width: 100%;
            aspect-ratio: 16/9;
            overflow: hidden;
            background: #E8E2DC;
        }

        .event-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.45s ease;
            display: block;
        }

        .event-card:hover .event-img-wrap img {
            transform: scale(1.06);
        }

        /* subtle dark gradient over image bottom */
        .event-img-wrap::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40%;
            background: linear-gradient(0deg, rgba(30, 27, 24, 0.35) 0%, transparent 100%);
            pointer-events: none;
        }

        /* no-image placeholder */
        .event-img-placeholder {
            width: 100%;
            aspect-ratio: 16/9;
            background: linear-gradient(135deg, var(--blush) 0%, var(--gold-light) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .event-img-placeholder svg {
            width: 48px;
            height: 48px;
            color: rgba(138, 106, 31, 0.45);
        }

        .event-info {
            padding: 1.6rem 1.6rem 1.8rem;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
            flex: 1;
        }

        .event-info h3 {
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 600;
            line-height: 1.3;
            color: var(--charcoal);
        }

        .event-info p {
            font-size: 0.855rem;
            color: var(--warm-grey);
            line-height: 1.7;
        }

        /* gold rule divider under title */
        .event-rule {
            width: 28px;
            height: 2px;
            background: linear-gradient(90deg, var(--gold), var(--gold-light));
            border-radius: 1px;
            flex-shrink: 0;
        }

        /* ── EMPTY STATE ── */
        .no-events {
            grid-column: 1 / -1;
            text-align: center;
            padding: 5rem 2rem;
            border: 1px dashed rgba(201, 168, 76, 0.35);
            border-radius: 6px;
            background: rgba(201, 168, 76, 0.03);
        }

        .no-events p {
            font-family: var(--font-display);
            font-size: 1.3rem;
            color: var(--warm-grey);
            font-style: italic;
        }

        .no-events span {
            display: block;
            font-family: var(--font-body);
            font-size: 0.85rem;
            margin-top: 0.5rem;
            color: #B0A89E;
        }

        /* ── REVEAL ANIMATIONS ── */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.visible,
        .reveal-left.visible,
        .reveal-right.visible {
            opacity: 1;
            transform: none;
        }

        /* stagger children */
        .event-grid .event-card:nth-child(1) {
            transition-delay: 0.05s;
        }

        .event-grid .event-card:nth-child(2) {
            transition-delay: 0.12s;
        }

        .event-grid .event-card:nth-child(3) {
            transition-delay: 0.19s;
        }

        .event-grid .event-card:nth-child(4) {
            transition-delay: 0.26s;
        }

        .event-grid .event-card:nth-child(5) {
            transition-delay: 0.33s;
        }

        .event-grid .event-card:nth-child(6) {
            transition-delay: 0.40s;
        }

        .event-grid .event-card:nth-child(7) {
            transition-delay: 0.47s;
        }

        .event-grid .event-card:nth-child(8) {
            transition-delay: 0.54s;
        }

        .event-grid .event-card:nth-child(9) {
            transition-delay: 0.61s;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(28px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── CTA BAND ── */
        .cta-band {
            background: var(--charcoal);
            padding: 4rem 8%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap;
            border-top: 1px solid rgba(201, 168, 76, 0.2);
        }

        .cta-band-text h3 {
            font-family: var(--font-display);
            font-size: clamp(1.4rem, 2.5vw, 2rem);
            font-weight: 700;
            color: var(--white);
            margin-bottom: 0.4rem;
        }

        .cta-band-text h3 em {
            color: var(--gold-light);
            font-style: italic;
        }

        .cta-band-text p {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.5);
            line-height: 1.6;
            max-width: 420px;
        }

        .btn-primary {
            background: var(--gold);
            color: var(--charcoal);
            padding: 0.85rem 2rem;
            border-radius: 2px;
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            text-decoration: none;
            transition: background 0.2s, transform 0.2s;
            display: inline-block;
            white-space: nowrap;
        }

        .btn-primary:hover {
            background: var(--gold-light);
            transform: translateY(-2px);
        }

        /* ── FOOTER ── */
        footer {
            background: var(--charcoal);
            border-top: 1px solid rgba(201, 168, 76, 0.2);
            padding: 2.5rem 8%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-brand {
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--white);
        }

        .footer-brand span {
            color: var(--gold);
            font-style: italic;
        }

        .footer-copy {
            font-size: 0.78rem;
            color: rgba(255, 255, 255, 0.3);
        }

        .footer-links {
            display: flex;
            gap: 1.5rem;
        }

        .footer-links a {
            font-size: 0.78rem;
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--gold-light);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 960px) {
            .event-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 580px) {
            .event-grid {
                grid-template-columns: 1fr;
            }

            .cta-band {
                flex-direction: column;
                text-align: center;
            }

            .cta-band-text p {
                max-width: 100%;
            }

            footer {
                flex-direction: column;
                text-align: center;
            }

            .hero-inner {
                padding: 4rem 6% 3.5rem;
            }
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="main-nav">
        <a href="{{ route('welcomepage.welcome') }}" class="nav-logo">WES<span> TEAM</span></a>
        <div class="nav-links">
            <a href="{{ route('welcomepage.welcome') }}"
                class="{{ request()->routeIs('welcomepage.welcome') ? 'nav-active' : '' }}">Home</a>
            <a href="{{ route('welcomepage.profile') }}"
                class="{{ request()->routeIs('welcomepage.profile') ? 'nav-active' : '' }}">Suppliers</a>
            <a href="{{ route('welcomepage.event') }}"
                class="{{ request()->routeIs('welcomepage.event') ? 'nav-active' : '' }}">Events</a>
            <a href="{{ route('welcomepage.package') }}"
                class="{{ request()->routeIs('welcomepage.package') ? 'nav-active' : '' }}">Packages</a>
            <a href="{{ route('welcomepage.galleries') }}"
                class="{{ request()->routeIs('welcomepage.galleries') ? 'nav-active' : '' }}">Gallery</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-cta">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'nav-active' : '' }}">Sign
                        In</a>
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

    {{-- MOBILE DRAWER --}}
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('welcomepage.welcome') }}"
            class="{{ request()->routeIs('welcomepage.welcome') ? 'mob-active' : '' }}" onclick="closeMenu()">Home</a>
        <a href="{{ route('welcomepage.profile') }}"
            class="{{ request()->routeIs('welcomepage.profile') ? 'mob-active' : '' }}"
            onclick="closeMenu()">Suppliers</a>
        <a href="{{ route('welcomepage.event') }}"
            class="{{ request()->routeIs('welcomepage.event') ? 'mob-active' : '' }}" onclick="closeMenu()">Events</a>
        <a href="{{ route('welcomepage.package') }}"
            class="{{ request()->routeIs('welcomepage.package') ? 'mob-active' : '' }}"
            onclick="closeMenu()">Packages</a>
        <a href="{{ route('welcomepage.galleries') }}"
            class="{{ request()->routeIs('welcomepage.galleries') ? 'mob-active' : '' }}"
            onclick="closeMenu()">Gallery</a>
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

    {{-- HERO --}}
    <header class="hero">
        <div class="hero-inner">
            <div class="hero-eyebrow">Event Categories</div>
            <h1>Discover Your<br><em>Perfect Event</em></h1>
            <p class="hero-sub">
                Explore our curated selection of event categories — from intimate gatherings
                to grand celebrations — and find the ideal setting for your special occasion.
            </p>
        </div>
    </header>

    {{-- EVENTS SECTION --}}
    <section class="events-section" id="events">
        <div class="section-head reveal">
            <div class="section-eyebrow">Browse by Type</div>
            <h2 class="section-title">Event <em>Categories</em></h2>
        </div>

        <div class="event-grid">
            @forelse ($events as $event)
                <div class="event-card reveal">

                    {{-- Image --}}
                    @if ($event->photo)
                        <div class="event-img-wrap">
                            <img src="{{ asset('storage/' . $event->photo) }}" alt="{{ $event->name }}">
                        </div>
                    @else
                        <div class="event-img-placeholder">
                            {{-- calendar icon --}}
                            <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="6" y="10" width="36" height="32" rx="3" />
                                <path d="M16 6v8M32 6v8M6 20h36" />
                                <rect x="14" y="26" width="6" height="6" rx="1" />
                                <rect x="28" y="26" width="6" height="6" rx="1" />
                            </svg>
                        </div>
                    @endif

                    <div class="event-info">
                        <h3>{{ $event->name }}</h3>
                        <div class="event-rule"></div>
                        <p>{{ Str::limit($event->description, 110) }}</p>
                    </div>

                </div>

            @empty

                <div class="no-events">
                    <p>No event categories available yet.</p>
                    <span>Check back soon — we're adding new categories regularly.</span>
                </div>
            @endforelse
        </div>
    </section>

    {{-- CTA BAND --}}
    <div class="cta-band reveal">
        <div class="cta-band-text">
            <h3>Ready to plan your <em>perfect event?</em></h3>
            <p>Join thousands of couples and planners who trust WES TEAM to bring their vision to life.</p>
        </div>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn-primary">Create Free Account</a>
        @endif
    </div>

    {{-- FOOTER --}}
    <footer>
        <div class="footer-brand">WES<span> TEAM</span></div>
        <div class="footer-links">
            <a href="#">Privacy</a>
            <a href="#">Terms</a>
            <a href="#">Support</a>
            <a href="#">Blog</a>
        </div>
        <div class="footer-copy">© {{ date('Y') }} WES TEAM. All rights reserved.</div>
    </footer>

    <script>
        /* ── Hamburger ── */
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');

        hamburger.addEventListener('click', () => {
            const open = mobileMenu.classList.toggle('open');
            hamburger.classList.toggle('open', open);
            document.body.style.overflow = open ? 'hidden' : '';
        });

        function closeMenu() {
            mobileMenu.classList.remove('open');
            hamburger.classList.remove('open');
            document.body.style.overflow = '';
        }

        document.addEventListener('click', e => {
            if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) closeMenu();
        });

        /* ── Scroll Reveal ── */
        const allReveals = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
        const io = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    io.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.1
        });
        allReveals.forEach(el => io.observe(el));
    </script>
</body>

</html>
