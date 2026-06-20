<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery — WES TEAM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet" />

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

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font-body);
            background: var(--white);
            color: var(--charcoal);
            overflow-x: hidden;
        }

        /* ── NAVBAR ── */
        nav.main-nav {
            position: fixed;
            top: 0; left: 0; right: 0;
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
        }
        .nav-logo span { color: var(--gold); font-style: italic; }

        .nav-links { display: flex; gap: 0.25rem; align-items: center; }

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
        .nav-links a:hover { color: var(--gold-dark); background: rgba(201, 168, 76, 0.07); }

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
        .nav-cta:hover { background: var(--gold-dark) !important; color: var(--white) !important; }
        .nav-cta.nav-active { background: var(--charcoal) !important; border-bottom: 2px solid transparent !important; }

        /* ── SMALL HERO BANNER ── */
        .hero {
            position: relative;
            width: 100%;
            min-height: 38vh;
            display: flex;
            align-items: center;
            background: var(--charcoal);
            overflow: hidden;
            padding-top: 80px;
        }
        .hero::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 70% 80% at 80% 30%, rgba(201,168,76,0.14) 0%, transparent 65%),
                radial-gradient(ellipse 40% 60% at 10% 90%, rgba(242,224,216,0.06) 0%, transparent 60%);
        }
        .hero::after {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, transparent 0%, var(--gold) 40%, var(--gold-light) 60%, transparent 100%);
        }
        .hero-content {
            position: relative; z-index: 2;
            width: 100%;
            padding: 3.5rem 8% 3rem;
            max-width: 860px;
        }
        .hero-tag {
            font-size: 0.7rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--gold-light);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            opacity: 0;
            animation: fadeUp 0.8s 0.3s forwards;
        }
        .hero-tag::before { content: ''; display: block; width: 40px; height: 1px; background: var(--gold); }

        .hero-title {
            font-family: var(--font-display);
            font-size: clamp(2.2rem, 4.5vw, 3.6rem);
            font-weight: 700;
            line-height: 1.1;
            color: var(--white);
            margin-bottom: 0.8rem;
            opacity: 0;
            animation: fadeUp 0.9s 0.5s forwards;
        }
        .hero-title em { color: var(--gold-light); font-style: italic; }

        .hero-subtitle {
            font-size: clamp(0.88rem, 1.4vw, 1rem);
            color: rgba(255, 255, 255, 0.65);
            line-height: 1.7;
            max-width: 520px;
            opacity: 0;
            animation: fadeUp 0.9s 0.7s forwards;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── SECTION SHARED ── */
        .gallery-section {
            background: var(--white);
            padding: 5.5rem 8% 6rem;
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
        .section-eyebrow::after { content: ''; flex: 0 0 32px; height: 1px; background: var(--gold); }

        h2.section-title {
            font-family: var(--font-display);
            font-size: clamp(2rem, 3.5vw, 3rem);
            font-weight: 700;
            line-height: 1.2;
            color: var(--charcoal);
            margin-bottom: 0.8rem;
        }
        h2.section-title em { color: var(--gold-dark); font-style: italic; }

        .section-subtitle {
            font-size: 0.95rem;
            color: var(--warm-grey);
            line-height: 1.7;
            max-width: 560px;
            margin-bottom: 3.5rem;
        }

        /* ── GALLERY GRID (one card per supplier portfolio) ── */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .gallery-card {
            background: var(--white);
            border: 1px solid #F0EBE5;
            border-radius: 6px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .gallery-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, var(--gold), var(--blush-deep));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.35s ease;
            z-index: 2;
        }
        .gallery-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(30, 27, 24, 0.1);
        }
        .gallery-card:hover::before { transform: scaleX(1); }

        /* photo grid inside each card (masonry-like 3-up grid) */
        .gallery-images {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-auto-rows: 110px;
            gap: 4px;
            background: #F0EBE5;
        }
        .gallery-images img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }
        /* make the first image a feature tile spanning 2 columns / 2 rows */
        .gallery-images img:nth-child(1) {
            grid-column: span 2;
            grid-row: span 2;
        }
        .gallery-images:hover img { filter: brightness(0.95); }
        .gallery-images img:hover { transform: scale(1.04); filter: none; z-index: 1; }

        /* placeholder if no images */
        .gallery-images-empty {
            aspect-ratio: 16/7;
            background: linear-gradient(135deg, var(--blush) 0%, var(--gold-light) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .gallery-images-empty svg {
            width: 44px; height: 44px;
            color: rgba(138,106,31,0.45);
        }

        .gallery-content {
            padding: 1.6rem 1.6rem 1.2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }
        .gallery-content .gallery-rule {
            width: 28px; height: 2px;
            background: linear-gradient(90deg, var(--gold), var(--gold-light));
            border-radius: 1px;
        }
        .gallery-content h3 {
            font-family: var(--font-display);
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--charcoal);
            line-height: 1.3;
        }
        .gallery-content p {
            font-size: 0.875rem;
            color: var(--warm-grey);
            line-height: 1.7;
        }

        .gallery-video {
            width: 100%;
            border-radius: 4px;
            margin-top: 0.5rem;
            background: var(--charcoal);
        }

        /* ── VIEW SUPPLIER LINK ── */
        .sp-view-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.6rem;
            padding: 1rem 1.6rem;
            margin-top: auto;
            background: var(--ivory);
            border-top: 1px solid #F0EBE5;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--gold-dark);
            text-decoration: none;
            transition: background 0.2s, color 0.2s, padding-left 0.2s;
        }
        .sp-view-btn::after {
            content: '→';
            font-size: 1rem;
            transition: transform 0.25s ease;
        }
        .sp-view-btn:hover {
            background: var(--charcoal);
            color: var(--gold-light);
            padding-left: 1.9rem;
        }
        .sp-view-btn:hover::after { transform: translateX(4px); }

        /* ── EMPTY STATE ── */
        .gallery-empty {
            grid-column: 1 / -1;
            text-align: center;
            padding: 5rem 2rem;
            border: 1px dashed rgba(201, 168, 76, 0.35);
            border-radius: 6px;
            background: rgba(201, 168, 76, 0.03);
        }
        .gallery-empty p {
            font-family: var(--font-display);
            font-size: 1.3rem;
            color: var(--warm-grey);
            font-style: italic;
        }
        .gallery-empty span {
            display: block;
            font-family: var(--font-body);
            font-size: 0.85rem;
            margin-top: 0.5rem;
            color: #B0A89E;
        }

        /* ── REVEAL ── */
        .reveal {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal.visible { opacity: 1; transform: none; }

        .gallery-grid .gallery-card:nth-child(1) { transition-delay: 0.05s; }
        .gallery-grid .gallery-card:nth-child(2) { transition-delay: 0.12s; }
        .gallery-grid .gallery-card:nth-child(3) { transition-delay: 0.19s; }
        .gallery-grid .gallery-card:nth-child(4) { transition-delay: 0.26s; }
        .gallery-grid .gallery-card:nth-child(5) { transition-delay: 0.33s; }
        .gallery-grid .gallery-card:nth-child(6) { transition-delay: 0.40s; }

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
        .footer-brand span { color: var(--gold); font-style: italic; }
        .footer-copy { font-size: 0.78rem; color: rgba(255, 255, 255, 0.3); }
        .footer-links { display: flex; gap: 1.5rem; }
        .footer-links a {
            font-size: 0.78rem;
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-links a:hover { color: var(--gold-light); }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            nav.main-nav { padding: 1rem 1.5rem; }
            .hero-content { padding: 3rem 6% 2.5rem; }
            .gallery-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 600px) {
            .nav-links { display: none; }
            .gallery-images { grid-auto-rows: 90px; }
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
            transition: transform 0.3s ease, opacity 0.3s ease, width 0.3s ease;
            transform-origin: center;
        }
        .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; width: 0; }
        .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

        /* ── MOBILE DRAWER ── */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 64px;
            left: 0; right: 0;
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
        .mobile-menu.open { transform: translateY(0); }
        .mobile-menu a {
            font-size: 1.05rem;
            font-weight: 400;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--charcoal);
            text-decoration: none;
            padding: 1rem 0.75rem;
            border-bottom: 1px solid rgba(201, 168, 76, 0.15);
            border-left: 3px solid transparent;
            transition: color 0.2s, background 0.2s, border-color 0.2s, padding 0.2s;
        }
        .mobile-menu a:last-child { border-bottom: none; }
        .mobile-menu a:hover { color: var(--gold-dark); background: rgba(201, 168, 76, 0.05); }
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
        .mobile-menu .mob-cta:hover { background: var(--gold-dark) !important; }
        .mobile-menu .mob-cta.mob-active { background: var(--charcoal) !important; border-left: 3px solid transparent !important; }

        @media (max-width: 768px) {
            .hamburger { display: flex; }
            .mobile-menu { display: flex; }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="main-nav">
        <div class="nav-logo">WES<span> TEAM</span></div>
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

    <!-- MOBILE DRAWER -->
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
                <a href="{{ route('login') }}" class="mob-cta {{ request()->routeIs('login') ? 'mob-active' : '' }}">Sign
                    In</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="mob-cta" style="margin-top:0.5rem;">Get Started</a>
                @endif
            @endauth
        @endif
    </div>

    <!-- SMALL HERO BANNER -->
    <header class="hero">
        <div class="hero-content">
            <div class="hero-tag">Our Work</div>
            <h1 class="hero-title">Event <em>Gallery</em></h1>
            <p class="hero-subtitle">
                Explore portfolios and previous event works from our trusted suppliers —
                real moments, real celebrations.
            </p>
        </div>
    </header>

    <!-- GALLERY -->
    <section class="gallery-section" id="gallery">
        <div class="reveal">
            <div class="section-eyebrow">Supplier Portfolios</div>
            <h2 class="section-title">Browse <em>Past Events</em></h2>
            <p class="section-subtitle">
                Each card below is a curated portfolio from one of our suppliers.
                Click through to view their full gallery and business profile.
            </p>
        </div>

        <div class="gallery-grid">
            @forelse ($galleries as $gallery)
                <div class="gallery-card reveal">

                    {{-- Images --}}
                    @if ($gallery->images && count($gallery->images) > 0)
                        <div class="gallery-images">
                            @foreach (collect($gallery->images)->take(5) as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="{{ $gallery->title }}"
                                    class="gallery-image">
                            @endforeach
                        </div>
                    @else
                        <div class="gallery-images-empty">
                            <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="6" y="10" width="36" height="28" rx="2" />
                                <circle cx="17" cy="20" r="4" />
                                <path d="M6 32l10-10 8 8 6-6 12 12" />
                            </svg>
                        </div>
                    @endif

                    <div class="gallery-content">
                        <div class="gallery-rule"></div>
                        <h3>{{ $gallery->title }}</h3>
                        <p>{{ Str::limit($gallery->description, 120) }}</p>

                        {{-- Video --}}
                        @if ($gallery->video)
                            <video controls class="gallery-video">
                                <source src="{{ asset('storage/' . $gallery->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>

                    <a href="{{ route('welcomepage.gallery', $gallery->supplier->id) }}" class="sp-view-btn">
                        View {{ $gallery->supplier->business_name }} Gallery
                    </a>
                </div>
            @empty
                <div class="gallery-empty">
                    <p>No gallery items available yet.</p>
                    <span>Check back soon — supplier portfolios are added regularly.</span>
                </div>
            @endforelse
        </div>
    </section>

    <!-- FOOTER -->
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
        const reveals = document.querySelectorAll('.reveal');
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