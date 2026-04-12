<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Packages — Bikol's Craft</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcomepage/supplier/details.css') }}">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
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
            --font-display:'Playfair Display', Georgia, serif;
            --font-body:   'DM Sans', sans-serif;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-body); background: var(--ivory); color: var(--charcoal); }

        /* ── NAVBAR ── */
        nav.main-nav {
            position: sticky; top: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.1rem 3rem;
            background: rgba(255,255,255,0.94); backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(201,168,76,0.18);
        }
        .nav-logo { font-family: var(--font-display); font-size: 1.4rem; font-weight: 700; color: var(--charcoal); text-decoration: none; }
        .nav-logo span { color: var(--gold); font-style: italic; }
        .nav-links { display: flex; gap: 2rem; align-items: center; }
        .nav-links a { font-size: 0.85rem; font-weight: 400; letter-spacing: 0.04em; text-transform: uppercase; color: var(--warm-grey); text-decoration: none; transition: color 0.2s; }
        .nav-links a:hover, .nav-links a.active { color: var(--gold-dark); }
        .nav-cta { background: var(--charcoal); color: var(--white) !important; padding: 0.5rem 1.3rem; border-radius: 2px; font-size: 0.78rem !important; letter-spacing: 0.06em !important; transition: background 0.2s !important; }
        .nav-cta:hover { background: var(--gold-dark) !important; }
        .hamburger { display: none; flex-direction: column; justify-content: center; gap: 5px; width: 36px; height: 36px; cursor: pointer; background: none; border: none; padding: 4px; }
        .hamburger span { display: block; width: 100%; height: 2px; background: var(--charcoal); border-radius: 2px; transition: transform 0.3s, opacity 0.3s, width 0.3s; }
        .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; width: 0; }
        .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
        .mobile-menu { display: none; position: fixed; top: 62px; left: 0; right: 0; background: var(--white); z-index: 99; padding: 1.5rem 2rem 2.5rem; flex-direction: column; gap: 0; box-shadow: 0 8px 32px rgba(30,27,24,0.1); transform: translateY(-110%); transition: transform 0.38s cubic-bezier(0.4,0,0.2,1); border-top: 2px solid rgba(201,168,76,0.2); }
        .mobile-menu.open { transform: translateY(0); }
        .mobile-menu a { font-size: 1rem; letter-spacing: 0.05em; text-transform: uppercase; color: var(--charcoal); text-decoration: none; padding: 0.9rem 0; border-bottom: 1px solid rgba(201,168,76,0.15); transition: color 0.2s; }
        .mobile-menu a:last-child { border-bottom: none; }
        .mobile-menu a:hover { color: var(--gold-dark); }
        .mobile-menu .mob-cta { margin-top: 1.25rem; background: var(--charcoal); color: var(--white) !important; text-align: center; padding: 0.8rem 1.4rem; border-radius: 2px; font-size: 0.82rem !important; border-bottom: none !important; }
        .mobile-menu .mob-cta:hover { background: var(--gold-dark) !important; }
        @media (max-width: 768px) { .hamburger { display: flex; } .mobile-menu { display: flex; } .nav-links { display: none; } nav.main-nav { padding: 1rem 1.25rem; } }

        /* ── PAGE HERO ── */
        .page-hero { background: var(--charcoal); padding: 3rem 3rem 2.75rem; position: relative; overflow: hidden; z-index: 1; }
        .page-hero::before { content: ''; position: absolute; inset: 0; background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px); background-size: 20px 20px; pointer-events: none; }
        .page-hero::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, var(--gold), transparent); pointer-events: none; }
        .hero-inner { position: relative; z-index: 1; max-width: 1100px; margin: 0 auto; }
        .hero-eyebrow { font-size: 0.62rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--gold); font-weight: 500; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem; }
        .hero-eyebrow::before { content: ''; display: block; width: 18px; height: 1px; background: var(--gold); }
        .hero-inner h1 { font-family: var(--font-display); font-size: clamp(1.6rem, 3.5vw, 2.6rem); font-weight: 700; color: var(--white); line-height: 1.15; }
        .hero-inner h1 em { color: var(--gold-light); font-style: italic; }
        .hero-sub { font-size: 0.82rem; color: rgba(255,255,255,0.42); margin-top: 0.4rem; }

        /* ── MAIN LAYOUT ── */
        .main-layout { max-width: 1100px; margin: 2rem auto; padding: 0 1.5rem 4rem; display: grid; grid-template-columns: 230px 1fr; gap: 1.75rem; align-items: start; }
        @media (max-width: 860px) { .main-layout { grid-template-columns: 1fr; padding: 0 1rem 4rem; } .desktop-sidebar { display: none; } }

        /* ── SIDEBAR (desktop) ── */
        .desktop-sidebar .sidebar { background: var(--white); border: 1px solid var(--border); border-radius: 10px; overflow: hidden; position: sticky; top: 80px; box-shadow: 0 1px 6px rgba(30,27,24,0.05); }
        .sidebar-title { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.18em; text-transform: uppercase; color: var(--gold-dark); padding: 0.85rem 1.1rem; border-bottom: 1px solid var(--border); background: rgba(201,168,76,0.03); display: flex; align-items: center; gap: 0.45rem; }
        .sidebar-title::after { content: ''; flex: 1; height: 1px; background: linear-gradient(90deg, var(--gold), transparent); }
        .filter-group { padding: 1rem 1.1rem; border-bottom: 1px solid var(--border); }
        .filter-group:last-child { border-bottom: none; }
        .filter-group-title { font-size: 0.65rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--charcoal); margin-bottom: 0.65rem; }
        .check-item { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.42rem; cursor: pointer; }
        .check-item:last-child { margin-bottom: 0; }
        .check-item input[type="radio"] { display: none; }
        .check-box { width: 14px; height: 14px; border-radius: 50%; border: 1.5px solid var(--border-md); flex-shrink: 0; display: flex; align-items: center; justify-content: center; transition: all 0.15s; }
        .check-item input:checked ~ .check-box { border-color: var(--gold); }
        .check-item input:checked ~ .check-box::after { content: ''; display: block; width: 6px; height: 6px; border-radius: 50%; background: var(--gold); }
        .check-label { font-size: 0.8rem; color: var(--warm-grey); }

        /* ── MOBILE FILTER BUTTON ── */
        .filter-toggle-btn { display: none; width: 100%; padding: 0.6rem 1rem; background: var(--white); border: 1.5px solid var(--border-md); border-radius: 8px; font-family: var(--font-body); font-size: 0.85rem; font-weight: 500; cursor: pointer; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem; color: var(--charcoal); transition: border-color 0.2s; }
        .filter-toggle-btn:hover { border-color: var(--gold); color: var(--gold-dark); }
        @media (max-width: 860px) { .filter-toggle-btn { display: flex; } }

        /* ── MOBILE FILTER DRAWER ── */
        .drawer-overlay { display: none; position: fixed; inset: 0; background: rgba(30,27,24,0.45); z-index: 200; opacity: 0; transition: opacity 0.3s; }
        .drawer-overlay.open { opacity: 1; }
        .filter-drawer { position: fixed; top: 0; left: 0; bottom: 0; width: 290px; background: var(--white); z-index: 201; transform: translateX(-100%); transition: transform 0.35s cubic-bezier(0.4,0,0.2,1); overflow-y: auto; box-shadow: 4px 0 24px rgba(30,27,24,0.12); }
        .filter-drawer.open { transform: translateX(0); }
        .drawer-header { display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.1rem; border-bottom: 1px solid var(--border); position: sticky; top: 0; background: var(--white); z-index: 1; }
        .drawer-header-title { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.18em; text-transform: uppercase; color: var(--gold-dark); display: flex; align-items: center; gap: 0.45rem; }
        .drawer-header-title::after { content: ''; width: 30px; height: 1px; background: linear-gradient(90deg, var(--gold), transparent); }
        .drawer-close-btn { width: 28px; height: 28px; border: 1px solid var(--border-md); border-radius: 6px; background: none; cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--warm-grey); font-size: 14px; line-height: 1; transition: background 0.15s, color 0.15s; }
        .drawer-close-btn:hover { background: var(--border); color: var(--charcoal); }

        /* ── SEARCH BAR ── */
        .search-bar-wrap { background: var(--white); border: 1px solid var(--border-md); border-radius: 10px; padding: 0.75rem 1rem; display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.25rem; box-shadow: 0 1px 4px rgba(30,27,24,0.04); transition: border-color 0.2s, box-shadow 0.2s; }
        .search-bar-wrap:focus-within { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,0.1); }
        .search-bar-wrap svg { color: var(--warm-grey); opacity: 0.45; flex-shrink: 0; }
        .search-input { flex: 1; border: none; background: transparent; font-family: var(--font-body); font-size: 0.875rem; color: var(--charcoal); outline: none; }
        .search-input::placeholder { color: #B0A89E; }

        /* ── SUPPLIER BLOCK ── */
        .supplier-block { background: var(--white); border: 1px solid var(--border); border-radius: 12px; overflow: hidden; margin-bottom: 1.5rem; box-shadow: 0 1px 6px rgba(30,27,24,0.05); animation: fadeUp .35s ease both; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .supplier-header { padding: 1.1rem 1.4rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 1rem; background: rgba(201,168,76,0.02); position: relative; }
        .supplier-header::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, var(--gold), var(--blush-deep)); }
        .supplier-avatar { width: 48px; height: 48px; border-radius: 50%; flex-shrink: 0; background: var(--charcoal); display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: 1.05rem; font-weight: 700; color: var(--gold); border: 2px solid rgba(201,168,76,0.22); overflow: hidden; }
        .supplier-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .supplier-info { flex: 1; min-width: 0; }
        .supplier-name { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--charcoal); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .supplier-tagline { font-size: 0.72rem; color: var(--warm-grey); margin-top: 1px; font-style: italic; }
        .supplier-location { display: flex; align-items: center; gap: 0.3rem; font-size: 0.68rem; color: var(--warm-grey); margin-top: 3px; }
        .supplier-location svg { color: var(--gold-dark); opacity: .7; flex-shrink: 0; }
        .supplier-pkg-count { font-size: 0.62rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; padding: 3px 10px; border-radius: 999px; background: rgba(201,168,76,0.1); color: var(--gold-dark); border: 1px solid rgba(201,168,76,0.22); white-space: nowrap; flex-shrink: 0; }

        /* ── PACKAGE GRID ── */
        .package-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1px; background: var(--border); }

        /* ── PACKAGE CARD ── square with scrollable description ── */
        .package-card {
            background: var(--white);
            padding: 1.25rem 1.35rem;
            display: flex;
            flex-direction: column;
            gap: 0.55rem;
            transition: background 0.18s;
            position: relative;
            overflow: hidden;
            aspect-ratio: 1 / 1;
        }
        .package-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, var(--gold), var(--blush-deep)); transform: scaleX(0); transform-origin: left; transition: transform 0.3s ease; }
        .package-card:hover { background: rgba(201,168,76,0.03); }
        .package-card:hover::before { transform: scaleX(1); }

        .pkg-name { font-family: var(--font-display); font-size: 0.92rem; font-weight: 700; color: var(--charcoal); line-height: 1.25; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; flex-shrink: 0; }

        /* ── SCROLLABLE DESCRIPTION ── only this block changed ── */
        .pkg-desc {
            font-size: 0.78rem;
            color: var(--warm-grey);
            line-height: 1.55;
            flex: 1;                  /* takes up remaining card space */
            overflow-y: auto;         /* scrollable when text overflows */
            overflow-x: hidden;
            /* thin custom scrollbar */
            scrollbar-width: thin;
            scrollbar-color: rgba(201,168,76,0.35) transparent;
            padding-right: 2px;       /* tiny gap so text doesn't touch scrollbar */
        }
        /* Webkit scrollbar styling */
        .pkg-desc::-webkit-scrollbar { width: 3px; }
        .pkg-desc::-webkit-scrollbar-track { background: transparent; }
        .pkg-desc::-webkit-scrollbar-thumb { background: rgba(201,168,76,0.4); border-radius: 999px; }
        .pkg-desc::-webkit-scrollbar-thumb:hover { background: rgba(201,168,76,0.7); }

        .pkg-price { font-family: var(--font-display); font-size: 1.15rem; font-weight: 700; color: var(--gold-dark); flex-shrink: 0; padding-top: 0.2rem; }
        .pkg-meta { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; flex-shrink: 0; }
        .pkg-chip { display: inline-flex; align-items: center; gap: 0.25rem; font-size: 0.63rem; font-weight: 700; letter-spacing: 0.04em; text-transform: uppercase; padding: 2px 8px; border-radius: 999px; background: rgba(201,168,76,0.09); color: var(--gold-dark); border: 1px solid rgba(201,168,76,0.22); }
        .pkg-chip svg { width: 9px; height: 9px; }

        /* ── HIDDEN BY LIVE SEARCH ── */
        .supplier-block[data-hidden="true"] { display: none; }
        .package-card[data-hidden="true"] { display: none; }

        /* ── EMPTY STATE ── */
        .empty-state { text-align: center; padding: 4rem 2rem; background: var(--white); border: 1px solid var(--border); border-radius: 12px; }
        .empty-icon { width: 56px; height: 56px; border-radius: 50%; background: rgba(201,168,76,0.08); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; color: var(--gold-dark); }
        .empty-icon svg { width: 24px; height: 24px; }
        .empty-state h3 { font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; color: var(--charcoal); margin-bottom: 0.4rem; }
        .empty-state p { font-size: 0.82rem; color: var(--warm-grey); }
        #no-results { display: none; }

        /* ── FOOTER ── */
        footer { background: var(--charcoal); border-top: 1px solid rgba(201,168,76,0.2); padding: 2.25rem 3rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
        .footer-brand { font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; color: var(--white); }
        .footer-brand span { color: var(--gold); font-style: italic; }
        .footer-links { display: flex; gap: 1.5rem; }
        .footer-links a { font-size: 0.78rem; color: rgba(255,255,255,0.4); text-decoration: none; transition: color 0.2s; }
        .footer-links a:hover { color: var(--gold-light); }
        .footer-copy { font-size: 0.75rem; color: rgba(255,255,255,0.28); }
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
            <a href="{{route('welcomepage.package')}}" class="active">Packages</a>
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
        <button class="hamburger" id="hamburger"><span></span><span></span><span></span></button>
    </nav>

    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('welcomepage.welcome') }}" onclick="closeMenu()">Home</a>
        <a href="{{ route('welcomepage.profile') }}" onclick="closeMenu()">Suppliers</a>
        <a href="#" onclick="closeMenu()">Events</a>
        <a href="{{route('welcomepage.package')}}" onclick="closeMenu()">Packages</a>
        <a href="{{ route('welcomepage.gallery') }}" onclick="closeMenu()">Gallery</a>
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

    {{-- PAGE HERO --}}
    <div class="page-hero">
        <div class="hero-inner">
            <div class="hero-eyebrow">Explore Offers</div>
            <h1>Browse <em>Event Packages</em></h1>
            <p class="hero-sub">Curated packages from verified suppliers across Bikol.</p>
        </div>
    </div>

    {{-- MOBILE FILTER DRAWER OVERLAY --}}
    <div class="drawer-overlay" id="drawerOverlay"></div>

    {{-- MOBILE FILTER DRAWER --}}
    <div class="filter-drawer" id="filterDrawer">
        <div class="drawer-header">
            <div class="drawer-header-title">Filters</div>
            <button class="drawer-close-btn" id="drawerCloseBtn" aria-label="Close filters">✕</button>
        </div>
        <form method="GET" action="{{ request()->url() }}" id="drawer-filter-form">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
            <div class="filter-group">
                <div class="filter-group-title">Event Type</div>
                @php $selectedType = request('event_type', ''); @endphp
                @foreach(['Wedding', 'Debut', 'Birthday', 'Corporate'] as $type)
                <label class="check-item">
                    <input type="radio" name="event_type" value="{{ $type }}"
                        onchange="this.form.submit()"
                        {{ $selectedType === $type ? 'checked' : '' }}>
                    <span class="check-box"></span>
                    <span class="check-label">{{ $type }}</span>
                </label>
                @endforeach
                @if($selectedType)
                <label class="check-item" style="margin-top:0.4rem;">
                    <input type="radio" name="event_type" value="" onchange="this.form.submit()">
                    <span class="check-box"></span>
                    <span class="check-label" style="color:#b0a89e;font-style:italic;">Clear filter</span>
                </label>
                @endif
            </div>
        </form>
    </div>

    {{-- MAIN LAYOUT --}}
    <div class="main-layout">

        {{-- SIDEBAR (desktop only) --}}
        <aside class="desktop-sidebar">
            <div class="sidebar" id="sidebar">
                <div class="sidebar-title">Filters</div>
                <form method="GET" action="{{ request()->url() }}" id="filter-form">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <div class="filter-group">
                        <div class="filter-group-title">Event Type</div>
                        @php $selectedType = request('event_type', ''); @endphp
                        @foreach(['Wedding', 'Debut', 'Birthday', 'Corporate'] as $type)
                        <label class="check-item">
                            <input type="radio" name="event_type" value="{{ $type }}"
                                onchange="this.form.submit()"
                                {{ $selectedType === $type ? 'checked' : '' }}>
                            <span class="check-box"></span>
                            <span class="check-label">{{ $type }}</span>
                        </label>
                        @endforeach
                        @if($selectedType)
                        <label class="check-item" style="margin-top:0.4rem;">
                            <input type="radio" name="event_type" value="" onchange="this.form.submit()">
                            <span class="check-box"></span>
                            <span class="check-label" style="color:#b0a89e;font-style:italic;">Clear filter</span>
                        </label>
                        @endif
                    </div>
                </form>
            </div>
        </aside>

        {{-- CONTENT --}}
        <div>
            {{-- Mobile filter toggle button --}}
            <button class="filter-toggle-btn" id="filter-toggle-btn" onclick="openDrawer()">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/>
                </svg>
                <span>Show Filters</span>
            </button>

            {{-- Search bar --}}
            <div class="search-bar-wrap">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                </svg>
                <input type="text" id="liveSearchInput" class="search-input"
                    value="{{ request('search') }}"
                    placeholder="Search packages by name or description…"
                    autocomplete="off">
            </div>

            {{-- Supplier + Package blocks --}}
            @forelse($suppliers as $supplier)
                @if($supplier->packages->count())
                <div class="supplier-block" id="supplier-{{ $supplier->id }}">

                    <div class="supplier-header">
                        <div class="supplier-avatar">
                            @if($supplier->photo)
                                <img src="{{ asset('storage/'.$supplier->photo) }}" alt="">
                            @else
                                {{ strtoupper(substr($supplier->business_name ?? $supplier->first_name ?? 'S', 0, 2)) }}
                            @endif
                        </div>
                        <div class="supplier-info">
                            <div class="supplier-name">{{ $supplier->business_name ?? ($supplier->first_name.' '.$supplier->last_name) }}</div>
                            @if($supplier->tagline)
                                <div class="supplier-tagline">"{{ $supplier->tagline }}"</div>
                            @endif
                            @if($supplier->city || $supplier->province)
                            <div class="supplier-location">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                {{ collect([$supplier->city, $supplier->province])->filter()->implode(', ') }}
                            </div>
                            @endif
                        </div>
                        <span class="supplier-pkg-count" id="pkg-count-{{ $supplier->id }}">
                            {{ $supplier->packages->count() }} package{{ $supplier->packages->count() !== 1 ? 's' : '' }}
                        </span>
                    </div>

                    <div class="package-grid" id="pkg-grid-{{ $supplier->id }}">
                        @foreach($supplier->packages as $package)
                        <div class="package-card"
                             data-name="{{ strtolower($package->name) }}"
                             data-desc="{{ strtolower($package->description ?? '') }}">
                            <div class="pkg-name">{{ $package->name }}</div>
                            @if($package->description)
                                <p class="pkg-desc">{{ $package->description }}</p>
                            @endif
                            <div class="pkg-price">₱{{ number_format($package->price, 2) }}</div>
                            <div class="pkg-meta">
                                @if($package->guest_capacity)
                                <span class="pkg-chip">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                    {{ $package->guest_capacity }} guests
                                </span>
                                @endif
                                @if($package->event_type)
                                <span class="pkg-chip">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
                                        <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                                    </svg>
                                    {{ $package->event_type }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
                @endif
            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                            <rect x="2" y="3" width="20" height="14" rx="2"/>
                            <path d="M8 21h8M12 17v4"/>
                        </svg>
                    </div>
                    <h3>No packages found</h3>
                    <p>Try adjusting your filters or search terms.</p>
                </div>
            @endforelse

            <div class="empty-state" id="no-results">
                <div class="empty-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                        <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                    </svg>
                </div>
                <h3>No packages found</h3>
                <p>Try a different search term.</p>
            </div>
        </div>

    </div>{{-- /main-layout --}}

    {{-- FOOTER --}}
    <footer>
        <div class="footer-brand">Bikol's<span>Craft</span></div>
        <div class="footer-links">
            <a href="#">Privacy</a><a href="#">Terms</a><a href="#">Support</a><a href="#">Blog</a>
        </div>
        <div class="footer-copy">© {{ date('Y') }} Bikol'sCraft. All rights reserved.</div>
    </footer>

    <script>
        /* ── NAV HAMBURGER ── */
        const hamburger = document.getElementById('hamburger');
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

        /* ── MOBILE FILTER DRAWER ── */
        const drawerOverlay = document.getElementById('drawerOverlay');
        const filterDrawer  = document.getElementById('filterDrawer');
        function openDrawer() {
            drawerOverlay.style.display = 'block';
            document.body.style.overflow = 'hidden';
            requestAnimationFrame(() => {
                drawerOverlay.classList.add('open');
                filterDrawer.classList.add('open');
            });
        }
        function closeDrawer() {
            drawerOverlay.classList.remove('open');
            filterDrawer.classList.remove('open');
            document.body.style.overflow = '';
            setTimeout(() => { drawerOverlay.style.display = 'none'; }, 350);
        }
        document.getElementById('drawerCloseBtn').addEventListener('click', closeDrawer);
        drawerOverlay.addEventListener('click', closeDrawer);

        /* ── LIVE SEARCH ── */
        const searchInput = document.getElementById('liveSearchInput');
        const noResults   = document.getElementById('no-results');
        const allBlocks   = document.querySelectorAll('.supplier-block');

        searchInput.addEventListener('input', function () {
            const q = this.value.trim().toLowerCase();
            let anyVisible = false;

            allBlocks.forEach(block => {
                const cards = block.querySelectorAll('.package-card');
                let blockVisible = 0;
                cards.forEach(card => {
                    const name = card.dataset.name || '';
                    const desc = card.dataset.desc || '';
                    const match = !q || name.includes(q) || desc.includes(q);
                    card.style.display = match ? '' : 'none';
                    if (match) blockVisible++;
                });
                block.style.display = blockVisible > 0 ? '' : 'none';
                const countEl = block.querySelector('[id^="pkg-count-"]');
                if (countEl) countEl.textContent = blockVisible + ' package' + (blockVisible !== 1 ? 's' : '');
                if (blockVisible > 0) anyVisible = true;
            });

            noResults.style.display = anyVisible ? 'none' : 'block';
        });

        if (searchInput.value) searchInput.dispatchEvent(new Event('input'));
    </script>
</body>
</html>