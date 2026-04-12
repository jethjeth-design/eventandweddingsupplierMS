<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Suppliers — Bikol's Craft</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/welcomepage/supplier/profile.css') }}">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

<style>
        :root {
            --gold:#C9A84C;--gold-light:#E8C97A;--gold-dark:#8A6A1F;--blush:#D4A090;
            --ivory:#FAF7F2;--charcoal:#1E1B18;--warm-grey:#6B6560;
            --white:#FFFFFF;--border:#F0EBE5;--border-md:#E0D8D0;
            --fd:'Playfair Display',Georgia,serif;--fb:'DM Sans',sans-serif;
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        body{font-family:var(--fb);background:var(--ivory);color:var(--charcoal);}

        /* ── HERO ── */
        .page-hero{background:var(--charcoal);padding:3rem 8% 2.75rem;position:relative;overflow:hidden;}
        .page-hero::before{content:'';position:absolute;inset:0;background-image:radial-gradient(rgba(201,168,76,.07) 1px,transparent 1px);background-size:20px 20px;}
        .page-hero::after{content:'';position:absolute;bottom:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,var(--gold),transparent);}
        .hero-inner{position:relative;z-index:1;max-width:900px;}
        .hero-eyebrow{font-size:.62rem;letter-spacing:.2em;text-transform:uppercase;color:var(--gold);font-weight:500;margin-bottom:.5rem;display:flex;align-items:center;gap:.5rem;}
        .hero-eyebrow::before{content:'';display:block;width:18px;height:1px;background:var(--gold);}
        .hero-inner h1{font-family:var(--fd);font-size:clamp(1.6rem,3.5vw,2.5rem);font-weight:700;color:var(--white);line-height:1.15;}
        .hero-inner h1 em{color:var(--gold-light);font-style:italic;}
        .hero-sub{font-size:.82rem;color:rgba(255,255,255,.42);margin-top:.4rem;}

        /* ── TOOLBAR ── */
        .toolbar{background:var(--white);border-bottom:1px solid var(--border);padding:.8rem 8%;display:flex;align-items:center;gap:.75rem;flex-wrap:wrap;position:sticky;top:0;z-index:50;}
        .filter-open-btn{display:none;align-items:center;gap:.4rem;padding:.5rem .9rem;background:var(--white);color:var(--charcoal);border:1.5px solid var(--border-md);border-radius:5px;font-size:.78rem;font-weight:500;font-family:var(--fb);cursor:pointer;white-space:nowrap;flex-shrink:0;transition:border-color .18s,color .18s;}
        .filter-open-btn:hover{border-color:var(--gold);color:var(--gold-dark);}
        .filter-count-badge{background:var(--gold);color:var(--charcoal);font-size:.6rem;font-weight:700;min-width:17px;height:17px;border-radius:99px;display:inline-flex;align-items:center;justify-content:center;padding:0 4px;}
        .search-wrap{flex:1;min-width:180px;display:flex;align-items:center;border:1.5px solid var(--border-md);border-radius:5px;background:var(--ivory);position:relative;overflow:visible;transition:border-color .18s,box-shadow .18s;}
        .search-wrap:focus-within{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,.12);}
        .search-wrap>svg{margin:0 .65rem;flex-shrink:0;color:var(--warm-grey);opacity:.5;}
        .search-wrap input{flex:1;border:none;background:transparent;outline:none;padding:.62rem 2.2rem .62rem 0;font-size:.875rem;font-family:var(--fb);color:var(--charcoal);}
        .search-wrap input::placeholder{color:#C0B8B0;}
        .search-spinner{position:absolute;right:10px;top:50%;transform:translateY(-50%);width:14px;height:14px;border:2px solid var(--border-md);border-top-color:var(--gold);border-radius:50%;animation:spn .6s linear infinite;display:none;}
        .search-spinner.active{display:block;}
        @keyframes spn{to{transform:translateY(-50%) rotate(360deg);}}
        .search-clear{position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--warm-grey);display:none;align-items:center;padding:2px;transition:color .15s;opacity:.6;}
        .search-clear.show{display:flex;}
        .search-clear:hover{opacity:1;color:var(--charcoal);}

        /* ── LAYOUT ── */
        .browse-wrap{background:var(--ivory);}
        .body-layout{display:grid;grid-template-columns:230px 1fr;gap:0;padding:1.75rem 8% 4rem;align-items:start;}

        /* ── DESKTOP SIDEBAR ── */
        .sidebar-col{margin-right:1.5rem;}
        .bv-id-card{background:var(--white);border:1px solid var(--border);border-radius:8px;overflow:hidden;position:sticky;top:57px;}
        .sb-head{padding:.8rem 1.1rem;border-bottom:1px solid var(--border);font-size:.58rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:var(--gold-dark);display:flex;align-items:center;gap:.4rem;font-family:var(--fb);background:rgba(201,168,76,.03);}
        .sb-head::after{content:'';flex:1;height:1px;background:linear-gradient(90deg,var(--gold),transparent);}
        .sb-icon{width:18px;height:18px;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:var(--gold-dark);opacity:.7;}
        .sb-section{padding:.9rem 1.1rem;border-bottom:1px solid var(--border);}
        .sb-section:last-of-type{border-bottom:none;}
        .sb-section-title{font-size:.62rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--charcoal);margin-bottom:.6rem;font-family:var(--fb);}
        .check-item{display:flex;align-items:center;gap:.5rem;margin-bottom:.42rem;cursor:pointer;}
        .check-item:last-child{margin-bottom:0;}
        .check-item input[type="checkbox"]{display:none;}
        .cb{width:14px;height:14px;border-radius:3px;border:1.5px solid var(--border-md);flex-shrink:0;display:flex;align-items:center;justify-content:center;transition:all .15s;background:var(--white);}
        .check-item input:checked~.cb{background:var(--gold);border-color:var(--gold);}
        .check-item input:checked~.cb::after{content:'';display:block;width:3px;height:5px;border:1.8px solid var(--white);border-top:none;border-left:none;transform:rotate(45deg) translateY(-1px);}
        .check-label{font-size:.8rem;color:var(--warm-grey);font-family:var(--fb);line-height:1;}
        .check-item input:checked~.check-label{color:var(--charcoal);font-weight:500;}
        .sb-reset{padding:.75rem 1.1rem;}
        .reset-btn{font-size:.72rem;color:var(--gold-dark);text-decoration:underline;text-underline-offset:3px;font-family:var(--fb);}

        /* ── MOBILE DRAWER ── */
        .drawer-overlay{display:none;position:fixed;inset:0;z-index:200;background:rgba(30,27,24,.5);backdrop-filter:blur(2px);}
        .drawer-overlay.open{display:block;}
        .filter-drawer{position:fixed;top:0;left:0;bottom:0;width:min(300px,88vw);background:var(--white);z-index:201;display:flex;flex-direction:column;transform:translateX(-100%);transition:transform .28s cubic-bezier(.4,0,.2,1);overflow:hidden;}
        .filter-drawer.open{transform:translateX(0);}
        .drawer-head{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;background:var(--charcoal);flex-shrink:0;position:relative;}
        .drawer-head::after{content:'';position:absolute;bottom:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,var(--gold),transparent);}
        .drawer-head-title{display:flex;align-items:center;gap:.5rem;font-size:.65rem;font-weight:700;letter-spacing:.16em;text-transform:uppercase;color:var(--gold);font-family:var(--fb);}
        .drawer-close{width:30px;height:30px;border-radius:3px;background:rgba(201,168,76,.1);border:1px solid rgba(201,168,76,.2);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--gold);transition:background .18s;}
        .drawer-close:hover{background:rgba(201,168,76,.22);}
        .drawer-body{flex:1;overflow-y:auto;}
        .drawer-body::-webkit-scrollbar{width:3px;}
        .drawer-body::-webkit-scrollbar-thumb{background:var(--border-md);}
        .drawer-body .sb-section{padding:.9rem 1.25rem;border-bottom:.5px solid var(--border);}
        .drawer-body .sb-section:last-of-type{border-bottom:none;}
        .drawer-footer{border-top:1px solid var(--border);padding:.85rem 1.25rem;background:var(--white);flex-shrink:0;display:flex;gap:.5rem;}
        .drawer-apply-btn{flex:1;padding:.65rem;background:var(--gold);color:var(--charcoal);border:none;border-radius:3px;font-size:.78rem;font-weight:600;letter-spacing:.05em;text-transform:uppercase;cursor:pointer;font-family:var(--fb);transition:background .18s;}
        .drawer-apply-btn:hover{background:var(--gold-light);}
        .drawer-reset-link{padding:.65rem 1rem;background:transparent;color:var(--warm-grey);border:1px solid var(--border);border-radius:3px;font-size:.75rem;cursor:pointer;font-family:var(--fb);text-decoration:none;display:flex;align-items:center;white-space:nowrap;transition:border-color .18s;}
        .drawer-reset-link:hover{border-color:var(--gold);color:var(--gold-dark);}

        /* ── RESULT COUNT ── */
        .result-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.1rem;flex-wrap:wrap;gap:.5rem;}
        .result-count{font-size:.8rem;color:var(--warm-grey);font-family:var(--fb);}
        .result-count strong{color:var(--charcoal);font-weight:600;}

        /* ════════════════════════════════
        MEDIUM SUPPLIER CARDS
        16/9 cover + avatar overlap + info body
        ════════════════════════════════ */
        .sup-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:1.1rem;}
        .sup-card{background:var(--white);border:1px solid var(--border);border-radius:10px;overflow:hidden;position:relative;display:flex;flex-direction:column;transition:box-shadow .22s,transform .22s,border-color .22s;}
        .sup-card:hover{box-shadow:0 8px 30px rgba(30,27,24,.09);transform:translateY(-3px);border-color:rgba(201,168,76,.35);}
        .sup-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;z-index:1;background:linear-gradient(90deg,var(--gold),var(--blush));transform:scaleX(0);transform-origin:left;transition:transform .3s ease;}
        .sup-card:hover::before{transform:scaleX(1);}
        .sup-card.ls-hidden{display:none!important;}

        /* 16:9 cover */
        .card-cover{width:100%;aspect-ratio:16/9;overflow:hidden;position:relative;background:var(--charcoal);flex-shrink:0;}
        .card-cover img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .4s ease;}
        .sup-card:hover .card-cover img{transform:scale(1.04);}
        .cover-fb{width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#1E1B18 0%,#374151 60%,#2D2A27 100%);position:relative;}
        .cover-dots{position:absolute;inset:0;opacity:.07;background-image:radial-gradient(#fff 1px,transparent 1px);background-size:16px 16px;}
        .cover-init{font-family:var(--fd);font-size:2rem;font-weight:700;color:var(--gold);position:relative;z-index:1;}
        .cover-cat{position:absolute;bottom:8px;left:10px;z-index:2;font-size:.6rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:#fff;background:rgba(30,27,24,.72);border:1px solid rgba(255,255,255,.15);padding:3px 9px;border-radius:99px;backdrop-filter:blur(4px);font-family:var(--fb);}
        .cover-avail{position:absolute;top:8px;right:8px;z-index:2;display:flex;align-items:center;gap:4px;font-size:.58rem;font-weight:700;text-transform:uppercase;padding:3px 8px;border-radius:99px;font-family:var(--fb);backdrop-filter:blur(4px);}
        .cover-avail.yes{background:rgba(15,80,41,.85);color:#86EFAC;border:1px solid rgba(134,239,172,.3);}
        .cover-avail.no{background:rgba(120,53,15,.85);color:#FCD34D;border:1px solid rgba(252,211,77,.3);}
        .avail-dot{width:5px;height:5px;border-radius:50%;}
        .cover-avail.yes .avail-dot{background:#22C55E;}
        .cover-avail.no .avail-dot{background:#F59E0B;}

        /* Avatar overlap */
        .card-top{padding:0 1.1rem;display:flex;gap:.75rem;align-items:flex-end;margin-top:-22px;position:relative;z-index:2;padding-bottom:.85rem;border-bottom:1px solid var(--border);}
        .c-avatar{width:52px;height:52px;border-radius:50%;object-fit:cover;flex-shrink:0;border:2.5px solid var(--white);box-shadow:0 2px 8px rgba(30,27,24,.12);background:#E0D8D0;}
        .c-avatar-fb{width:52px;height:52px;border-radius:50%;background:var(--charcoal);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-family:var(--fd);font-size:1.1rem;font-weight:700;color:var(--gold);border:2.5px solid var(--white);box-shadow:0 2px 8px rgba(30,27,24,.12);}
        .c-info{flex:1;min-width:0;padding-top:28px;}
        .c-name{font-family:var(--fd);font-size:1rem;font-weight:700;color:var(--charcoal);line-height:1.2;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
        .c-person{font-size:.72rem;color:var(--warm-grey);margin-top:1px;font-family:var(--fb);}
        .c-location{display:flex;align-items:center;gap:3px;font-size:.7rem;color:var(--warm-grey);margin-top:3px;font-family:var(--fb);}
        .c-location svg{color:var(--gold-dark);opacity:.7;flex-shrink:0;}
        .c-rating{display:flex;align-items:center;gap:.25rem;font-size:.7rem;margin-top:3px;font-family:var(--fb);}
        .c-stars{display:flex;gap:1px;}
        .c-stars .sf{color:var(--gold);font-size:11px;}
        .c-stars .se{color:#D8D0C8;font-size:11px;}
        .c-rating-val{font-weight:600;color:var(--charcoal);}

        /* Body */
        .card-body{padding:.85rem 1.1rem 1.1rem;flex:1;display:flex;flex-direction:column;}
        .c-tagline{font-size:.8rem;color:var(--warm-grey);font-style:italic;line-height:1.55;margin-bottom:.7rem;font-family:var(--fb);display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;min-height:2.4em;}
        .c-tags{display:flex;gap:.35rem;flex-wrap:wrap;margin-bottom:.85rem;}
        .c-tag{font-size:.6rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--gold-dark);background:rgba(201,168,76,.09);border:1px solid rgba(201,168,76,.22);padding:2px 8px;border-radius:2px;font-family:var(--fb);}
        .c-avail{font-size:.6rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:2px 8px;border-radius:2px;display:inline-flex;align-items:center;gap:3px;font-family:var(--fb);}
        .c-avail.yes{background:#F0FDF4;color:#15803D;border:1px solid #BBF7D0;}
        .c-avail.no{background:#FFFBEB;color:#B45309;border:1px solid #FDE68A;}
        .c-avail-dot{width:5px;height:5px;border-radius:50%;}
        .c-avail.yes .c-avail-dot{background:#22C55E;}
        .c-avail.no .c-avail-dot{background:#F59E0B;}
        .view-btn{display:block;width:100%;padding:.62rem;background:var(--gold);color:var(--charcoal);border:none;border-radius:4px;font-size:.74rem;font-weight:600;letter-spacing:.04em;text-transform:uppercase;text-align:center;text-decoration:none;font-family:var(--fb);cursor:pointer;margin-top:auto;transition:background .18s;}
        .view-btn:hover{background:var(--gold-light);}

        /* ── NAVBAR (same as welcome) ── */
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
                .nav-links a:hover, .nav-links a.active { color: var(--gold-dark); }
                .nav-cta {
                    background: var(--charcoal); color: var(--white) !important;
                    padding: 0.55rem 1.4rem; border-radius: 2px;
                    font-size: 0.8rem !important; letter-spacing: 0.06em !important;
                    transition: background 0.2s !important;
                }
                .nav-cta:hover { background: var(--gold-dark) !important; }

        /* ── PAGE HERO (slim) ── */
                .page-hero {
                    margin-top: 64px;
                    background: var(--charcoal);
                    padding: 3.5rem 8% 3rem;
                    position: relative; overflow: hidden;
                }
                .page-hero::before {
                    content: '';
                    position: absolute; inset: 0;
                    background-image: radial-gradient(rgba(201,168,76,0.08) 1px, transparent 1px);
                    background-size: 24px 24px;
                }
                .page-hero::after {
                    content: '';
                    position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
                    background: linear-gradient(90deg, transparent, var(--gold), transparent);
                }
                .hero-inner { position: relative; z-index: 1; }
                .hero-eyebrow {
                    font-size: 0.7rem; letter-spacing: 0.2em; text-transform: uppercase;
                    color: var(--gold); font-weight: 500;
                    display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.8rem;
                }
                .hero-eyebrow::before { content: ''; display: block; width: 32px; height: 1px; background: var(--gold); }
                .page-hero h1 {
                    font-family: var(--font-display);
                    font-size: clamp(1.8rem, 3.5vw, 2.8rem);
                    font-weight: 700; color: var(--white); line-height: 1.15;
                }
                .page-hero h1 em { color: var(--gold-light); font-style: italic; }
                .hero-sub {
                    font-size: 0.9rem; color: rgba(255,255,255,0.55);
                    margin-top: 0.5rem; line-height: 1.6;
                }

        /* Empty */
        .empty-state,.live-no-results{grid-column:1/-1;text-align:center;padding:4rem 2rem;background:var(--white);border:1px solid var(--border);border-radius:8px;}
        .empty-state svg,.live-no-results svg{display:block;margin:0 auto .85rem;opacity:.22;}
        .empty-state h3,.live-no-results h3{font-family:var(--fd);font-size:1.1rem;color:var(--charcoal);margin-bottom:.35rem;}
        .empty-state p,.live-no-results p{font-size:.83rem;color:var(--warm-grey);font-family:var(--fb);}
        .live-no-results{display:none;}

        /* Pagination */
        .pagination{display:flex;align-items:center;justify-content:center;gap:.3rem;margin-top:2rem;flex-wrap:wrap;}
        .page-btn{width:32px;height:32px;display:flex;align-items:center;justify-content:center;border:1px solid var(--border);border-radius:3px;font-size:.78rem;color:var(--warm-grey);cursor:pointer;background:var(--white);font-family:var(--fb);transition:all .18s;text-decoration:none;}
        .page-btn:hover{border-color:var(--gold);color:var(--gold-dark);}
        .page-btn.active{background:var(--gold);border-color:var(--gold);color:var(--charcoal);font-weight:700;}
        .page-btn.disabled{opacity:.32;pointer-events:none;}

        /* Reveal */
        .reveal{opacity:0;transform:translateY(14px);transition:opacity .48s ease,transform .48s ease;}
        .reveal.visible{opacity:1;transform:none;}

        /* Footer */
        footer{background:var(--charcoal);border-top:1px solid rgba(201,168,76,.2);padding:2.25rem 8%;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;}
        .footer-brand{font-family:var(--fd);font-size:1.1rem;font-weight:700;color:var(--white);}
        .footer-brand span{color:var(--gold);font-style:italic;}
        .footer-links{display:flex;gap:1.5rem;}
        .footer-links a{font-size:.78rem;color:rgba(255,255,255,.4);text-decoration:none;transition:color .2s;}
        .footer-links a:hover{color:var(--gold-light);}
        .footer-copy{font-size:.75rem;color:rgba(255,255,255,.28);}


</style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="main-nav">
    <a href="{{ route('welcomepage.welcome') }}" class="nav-logo">Bikol's<span>Craft</span></a>
    <div class="nav-links">
        <a href="{{ route('welcomepage.welcome') }}">Home</a>
        <a href="{{ route('welcomepage.profile') }}" class="active">Suppliers</a>
        <a href="#">Events</a>
        <a href="{{ route('welcomepage.package') }}">Packages</a>
        <a href="{{ route('welcomepage.gallery') }}">Gallery</a>
        @if (Route::has('login'))
            @auth <a href="{{ url('/dashboard') }}" class="nav-cta">Dashboard</a>
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
    <a href="{{ route('welcomepage.gallery') }}" onclick="closeMenu()">Gallery</a>
    @if (Route::has('login'))
        @auth <a href="{{ url('/dashboard') }}" class="mob-cta">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="mob-cta">Sign In</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="mob-cta" style="margin-top:.5rem;">Get Started</a>
            @endif
        @endauth
    @endif
</div>

{{-- PAGE HERO --}}
<div class="page-hero">
    <div class="hero-inner">
        <div class="hero-eyebrow">Discover Talent</div>
        <h1>Find your perfect <em>event supplier</em></h1>
        <p class="hero-sub">Browse verified professionals across Bikol and beyond.</p>
    </div>
</div>

{{-- MOBILE DRAWER --}}
<div class="drawer-overlay" id="drawer-overlay" onclick="closeDrawer()"></div>
<div class="filter-drawer" id="filter-drawer">
    <div class="drawer-head">
        <div class="drawer-head-title">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/>
            </svg>
            Filters
        </div>
        <button class="drawer-close" onclick="closeDrawer()">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>
    <div class="drawer-body">
        <form method="GET" action="{{ request()->url() }}" id="drawer-filter-form">
            @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif

            @if(isset($cities) && $cities->count())
            <div class="sb-section">
                <div class="sb-section-title">Location</div>
                @php $selCities = (array) request('city', []); @endphp
                @foreach($cities->take(7) as $city)
                <label class="check-item">
                    <input type="checkbox" name="city[]" value="{{ $city }}"
                           {{ in_array($city, $selCities) ? 'checked' : '' }}>
                    <span class="cb"></span>
                    <span class="check-label">{{ $city }}</span>
                </label>
                @endforeach
            </div>
            @endif

            @if(isset($categories) && $categories->count())
            <div class="sb-section">
                <div class="sb-section-title">Category</div>
                @php $selCats = (array) request('category', []); @endphp
                @foreach($categories as $cat)
                <label class="check-item">
                    <input type="checkbox" name="category[]" value="{{ $cat->slug }}"
                           {{ in_array($cat->slug, $selCats) ? 'checked' : '' }}>
                    <span class="cb"></span>
                    <span class="check-label">{{ $cat->name }}</span>
                </label>
                @endforeach
            </div>
            @endif
        </form>
    </div>
    <div class="drawer-footer">
        <a href="{{ request()->url() }}" class="drawer-reset-link">Reset</a>
        <button class="drawer-apply-btn" onclick="document.getElementById('drawer-filter-form').submit()">
            Apply Filters
        </button>
    </div>
</div>

{{-- BROWSE WRAP --}}
<div class="browse-wrap">

    {{-- TOOLBAR --}}
    <div class="toolbar">
        <button class="filter-open-btn" id="filter-open-btn" onclick="openDrawer()">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/>
            </svg>
            Filters
            @php $activeFilters = count((array)request('city',[])) + count((array)request('category',[])); @endphp
            @if($activeFilters > 0)
                <span class="filter-count-badge">{{ $activeFilters }}</span>
            @endif
        </button>

        <form method="GET" action="{{ request()->url() }}" id="search-form" style="display:contents;">
            @foreach((array)request('city',[]) as $c)<input type="hidden" name="city[]" value="{{ $c }}">@endforeach
            @foreach((array)request('category',[]) as $c)<input type="hidden" name="category[]" value="{{ $c }}">@endforeach
            @if(request('rating'))<input type="hidden" name="rating" value="{{ request('rating') }}">@endif
            @if(request('available_only'))<input type="hidden" name="available_only" value="1">@endif

            <div class="search-wrap">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                </svg>
                <input type="text" name="search" id="live-search-input"
                       value="{{ request('search') }}"
                       placeholder="Search by name, category, or location…"
                       autocomplete="off">
                <div class="search-spinner" id="search-spinner"></div>
                <button type="button" class="search-clear" id="search-clear" onclick="clearSearch()">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    {{-- BODY --}}
    <div class="body-layout">

        {{-- DESKTOP SIDEBAR --}}
        <div class="sidebar-col">
            <div class="bv-id-card">
                <div class="sb-head">
                    <div class="sb-icon">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/>
                        </svg>
                    </div>
                    Filters
                </div>

                <form method="GET" action="{{ url()->current() }}" id="filter-form">
                    @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif

                    @if(isset($cities) && $cities->count())
                    <div class="sb-section">
                        <div class="sb-section-title">Location</div>
                        @php $selCities = (array) request('city', []); @endphp
                        @foreach($cities->take(7) as $city)
                        <label class="check-item">
                            <input type="checkbox" name="city[]" value="{{ $city }}"
                                   onchange="this.form.submit()"
                                   {{ in_array($city, $selCities) ? 'checked' : '' }}>
                            <span class="cb"></span>
                            <span class="check-label">{{ $city }}</span>
                        </label>
                        @endforeach
                    </div>
                    @endif

                    @if(isset($categories) && $categories->count())
                    <div class="sb-section">
                        <div class="sb-section-title">Category</div>
                        @php $selCats = (array) request('category', []); @endphp
                        @foreach($categories as $cat)
                        <label class="check-item">
                            <input type="checkbox" name="category[]" value="{{ $cat->slug }}"
                                   onchange="this.form.submit()"
                                   {{ in_array($cat->slug, $selCats) ? 'checked' : '' }}>
                            <span class="cb"></span>
                            <span class="check-label">{{ $cat->name }}</span>
                        </label>
                        @endforeach
                    </div>
                    @endif

                    @if($activeFilters)
                    <div class="sb-reset">
                        <a href="{{ request()->url() }}{{ request('search') ? '?search='.urlencode(request('search')) : '' }}"
                           class="reset-btn">Reset filters</a>
                    </div>
                    @endif
                </form>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="content-area">
            <div class="result-row">
                <div class="result-count">
                    Showing
                    <strong id="result-count-num">{{ $suppliers instanceof \Illuminate\Pagination\LengthAwarePaginator ? $suppliers->total() : $suppliers->count() }}</strong>
                    supplier<span id="result-count-plural">{{ ($suppliers instanceof \Illuminate\Pagination\LengthAwarePaginator ? $suppliers->total() : $suppliers->count()) !== 1 ? 's' : '' }}</span>
                </div>
            </div>

            <div class="sup-grid" id="sup-grid">
                @forelse($suppliers as $supplier)
                @php
                    /*
                     * FIX: $supplier->category can be a Category object (if loaded via relation)
                     * OR a plain string (if stored as text in SupplierProfile).
                     * Handle both gracefully.
                     */
                    $catName = is_object($supplier->category)
                             ? ($supplier->category->name ?? null)
                             : ($supplier->category ?? null);
                @endphp
                <div class="sup-card reveal"
                     data-search="{{ strtolower(implode(' ', array_filter([
                         $supplier->business_name ?? '',
                         $supplier->first_name ?? '',
                         $supplier->last_name ?? '',
                         $catName ?? '',
                         $supplier->city ?? '',
                         $supplier->province ?? '',
                         $supplier->tagline ?? '',
                         $supplier->bio ?? '',
                     ]))) }}">

                    {{-- 16:9 cover --}}
                    {{--<div class="card-cover">
                        @if($supplier->photo)
                            <img src="{{ asset('storage/'.$supplier->phot) }}"
                                 alt="{{ $supplier->business_name }}">
                        @else
                            <div class="cover-fb">
                                <div class="cover-dots"></div>
                                <span class="cover-init">{{ strtoupper(substr($supplier->business_name ?? $supplier->first_name ?? 'S', 0, 2)) }}</span>
                            </div>
                        @endif
                        @if($catName)
                            <span class="cover-cat">{{ $catName }}</span>
                        @endif
                        @if($supplier->is_available)
                            <span class="cover-avail yes"><span class="avail-dot"></span>Available</span>
                        @else
                            <span class="cover-avail no"><span class="avail-dot"></span>Unavailable</span>
                        @endif
                    </div>--}}

                    {{-- Avatar overlap + info --}}
                    <div class="card-top">
                        @if($supplier->photo)
                            <img class="c-avatar"
                                 src="{{ asset('storage/'.$supplier->photo) }}"
                                 alt="{{ $supplier->business_name }}">
                        @else
                            <div class="c-avatar-fb">
                                {{ strtoupper(substr($supplier->business_name ?? $supplier->first_name ?? 'S', 0, 2)) }}
                            </div>
                        @endif

                        <div class="c-info">
                            <div class="c-name">
                                {{ $supplier->business_name ?? trim(($supplier->first_name ?? '').' '.($supplier->last_name ?? '')) ?: 'Supplier' }}
                            </div>
                            @if($supplier->first_name || $supplier->last_name)
                            <div class="c-person">{{ trim($supplier->first_name.' '.$supplier->last_name) }}</div>
                            @endif

                            @if($supplier->city || $supplier->province)
                            <div class="c-location">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                {{ collect([$supplier->city,$supplier->province])->filter()->implode(', ') }}
                            </div>
                            @endif

                            @if($supplier->rating)
                            <div class="c-rating">
                                <div class="c-stars">
                                    @for($s=1;$s<=5;$s++)
                                        <span class="{{ $s<=round($supplier->rating)?'sf':'se' }}">★</span>
                                    @endfor
                                </div>
                                <span class="c-rating-val">{{ number_format($supplier->rating,1) }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Card body --}}
                    <div class="card-body">
                        @if($supplier->tagline)
                            <p class="c-tagline">"{{ $supplier->tagline }}"</p>
                        @elseif($supplier->bio)
                            <p class="c-tagline">{{ $supplier->bio }}</p>
                        @else
                            <p class="c-tagline" style="opacity:0;">&nbsp;</p>
                        @endif

                        <div class="c-tags">
                            @if($catName)
                                <span class="c-tag">{{ $catName }}</span>
                            @endif
                            @if($supplier->is_available)
                                <span class="c-avail yes"><span class="c-avail-dot"></span>Available</span>
                            @else
                                <span class="c-avail no"><span class="c-avail-dot"></span>Unavailable</span>
                            @endif
                        </div>

                        <a href="{{ route('welcomepage.profiledetails', ['id' => $supplier->id]) }}"
                           class="view-btn">View Profile</a>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#C8BEB5" stroke-width="1.2">
                        <circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/>
                    </svg>
                    <h3>No suppliers found</h3>
                    <p>Try adjusting your filters or search terms.</p>
                </div>
                @endforelse

                <div class="live-no-results" id="live-no-results">
                    <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="#C8BEB5" stroke-width="1.2">
                        <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                    </svg>
                    <h3>No results found</h3>
                    <p>Try a different keyword or clear the search.</p>
                </div>
            </div>

            @if($suppliers instanceof \Illuminate\Pagination\LengthAwarePaginator && $suppliers->hasPages())
            <div class="pagination" id="pagination-wrap">
                <a href="{{ $suppliers->previousPageUrl() ?? '#' }}"
                   class="page-btn {{ $suppliers->onFirstPage() ? 'disabled' : '' }}">‹</a>
                @foreach($suppliers->getUrlRange(1, $suppliers->lastPage()) as $page => $url)
                    <a href="{{ $url }}"
                       class="page-btn {{ $page === $suppliers->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                @endforeach
                <a href="{{ $suppliers->nextPageUrl() ?? '#' }}"
                   class="page-btn {{ !$suppliers->hasMorePages() ? 'disabled' : '' }}">›</a>
            </div>
            @endif
        </div>

    </div>
</div>

<footer>
    <div class="footer-brand">Bikol's<span>Craft</span></div>
    <div class="footer-links">
        <a href="#">Privacy</a><a href="#">Terms</a><a href="#">Support</a><a href="#">Blog</a>
    </div>
    <div class="footer-copy">© {{ date('Y') }} Bikol'sCraft. All rights reserved.</div>
</footer>

<script>
/* ── HAMBURGER ── */
const hamburger=document.getElementById('hamburger'),mobileMenu=document.getElementById('mobileMenu');
hamburger.addEventListener('click',()=>{const o=mobileMenu.classList.toggle('open');hamburger.classList.toggle('open',o);document.body.style.overflow=o?'hidden':'';});
document.addEventListener('click',e=>{if(!hamburger.contains(e.target)&&!mobileMenu.contains(e.target)){mobileMenu.classList.remove('open');hamburger.classList.remove('open');document.body.style.overflow='';}});
function closeMenu(){mobileMenu.classList.remove('open');hamburger.classList.remove('open');document.body.style.overflow='';}

/* ── MOBILE DRAWER ── */
function openDrawer(){document.getElementById('filter-drawer').classList.add('open');document.getElementById('drawer-overlay').classList.add('open');document.body.style.overflow='hidden';document.getElementById('filter-open-btn').classList.add('active');}
function closeDrawer(){document.getElementById('filter-drawer').classList.remove('open');document.getElementById('drawer-overlay').classList.remove('open');document.body.style.overflow='';document.getElementById('filter-open-btn').classList.remove('active');}
document.addEventListener('keydown',e=>{if(e.key==='Escape')closeDrawer();});

/* ── LIVE SEARCH ── */
const liveInput=document.getElementById('live-search-input'),clearBtn=document.getElementById('search-clear'),spinner=document.getElementById('search-spinner'),noResults=document.getElementById('live-no-results'),countNum=document.getElementById('result-count-num'),countPlural=document.getElementById('result-count-plural'),pagination=document.getElementById('pagination-wrap'),allCards=Array.from(document.querySelectorAll('#sup-grid .sup-card[data-search]'));
let searchTimer=null;

function updateClearBtn(){clearBtn.classList.toggle('show',liveInput.value.length>0);}
function clearSearch(){liveInput.value='';updateClearBtn();runLiveSearch('');liveInput.focus();}

function runLiveSearch(term){
    const q=term.trim().toLowerCase();let vis=0;
    allCards.forEach(c=>{const m=!q||(c.dataset.search||'').includes(q);c.classList.toggle('ls-hidden',!m);if(m)vis++;});
    noResults.style.display=(vis===0&&allCards.length>0&&q)?'block':'none';
    countNum.textContent=vis;countPlural.textContent=vis!==1?'s':'';
    if(pagination)pagination.style.display=q?'none':'';
    spinner.classList.remove('active');
}

liveInput.addEventListener('input',function(){
    updateClearBtn();
    runLiveSearch(this.value);
    clearTimeout(searchTimer);
    if(!this.value.trim())return;
    spinner.classList.add('active');
    searchTimer=setTimeout(()=>document.getElementById('search-form').submit(),650);
});

updateClearBtn();
if(liveInput.value)runLiveSearch(liveInput.value);

/* ── SCROLL REVEAL ── */
const io=new IntersectionObserver(entries=>{entries.forEach((e,i)=>{if(e.isIntersecting){setTimeout(()=>e.target.classList.add('visible'),i*50);io.unobserve(e.target);}});},{threshold:0.07});
document.querySelectorAll('.reveal').forEach(el=>io.observe(el));
</script>

</body>
</html>