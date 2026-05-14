<x-client-layout>

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
            --sidebar-w:   268px;
            --nav-h:       60px;
        }

        html { scroll-behavior: smooth; }
        body { font-family: var(--font-body); background: var(--ivory); color: var(--charcoal); overflow-x: hidden; }

        /* ══════════════════════════════
           PAGE HERO
        ══════════════════════════════ */
        .page-hero {
            margin-top: 0rem;
            background: var(--charcoal);
            position: relative; overflow: hidden;
            padding: 2.5rem 5% 2rem;
        }
        .page-hero::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px);
            background-size: 22px 22px;
        }
        .page-hero::after {
            content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }
        .hero-inner { position: relative; z-index: 1; }
        .hero-eyebrow {
            font-size: 0.62rem; letter-spacing: 0.22em; text-transform: uppercase;
            color: var(--gold); font-weight: 600; margin-bottom: 0.4rem;
            display: flex; align-items: center; gap: 0.6rem;
        }
        .hero-eyebrow::before { content: ''; width: 24px; height: 1px; background: var(--gold); }
        .page-hero h1 { font-family: var(--font-display); font-size: clamp(1.5rem, 3vw, 2.2rem); font-weight: 700; color: var(--white); line-height: 1.12; margin-bottom: 0.4rem; }
        .page-hero h1 em { color: var(--gold-light); font-style: italic; }
        .hero-sub { font-size: 0.82rem; color: rgba(255,255,255,0.45); line-height: 1.6; margin-bottom: 1.25rem; }

        /* ── TOP SEARCH BAR (inside hero) ── */
        .hero-search-bar {
            display: flex; align-items: center; gap: 0;
            background: var(--white);
            border-radius: 8px;
            max-width: 680px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,0,0,0.18);
            border: 1px solid rgba(201,168,76,0.25);
        }
        .hero-search-icon {
            padding: 0 0.85rem 0 1rem;
            display: flex; align-items: center;
            color: var(--gold);
            flex-shrink: 0;
        }
        .hero-search-icon svg { width: 17px; height: 17px; }
        .hero-search-input {
            flex: 1;
            border: none; outline: none;
            font-family: var(--font-body);
            font-size: 0.9rem;
            color: var(--charcoal);
            background: transparent;
            padding: 0.85rem 0.5rem 0.85rem 0;
        }
        .hero-search-input::placeholder { color: #C0B8B0; }
        .hero-search-btn {
            background: var(--gold);
            border: none;
            padding: 0 1.4rem;
            font-family: var(--font-body);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--charcoal);
            cursor: pointer;
            transition: background 0.2s;
            white-space: nowrap;
            align-self: stretch;
        }
        .hero-search-btn:hover { background: var(--gold-light); }

        /* ── POPULAR CATEGORIES ROW ── */
        .popular-cats-bar {
            margin-top: 2rem 5% 0;
            padding: 0 5% 0;
            background: var(--charcoal);
            position: relative; z-index: 1;
            padding-bottom: 1.5rem;
        }
        .popular-cats-label {
            font-size: 0.58rem; font-weight: 700; letter-spacing: 0.14em;
            text-transform: uppercase; color: rgba(255,255,255,0.35);
            margin-bottom: 0.65rem;
        }
        .popular-cats-row {
            display: flex; flex-wrap: wrap; gap: 0.5rem;
        }
        .pop-cat-chip {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.38rem 0.85rem;
            border-radius: 999px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(201,168,76,0.2);
            font-size: 0.72rem; font-weight: 500;
            color: rgba(255,255,255,0.7);
            cursor: pointer;
            transition: background 0.18s, border-color 0.18s, color 0.18s;
            text-decoration: none;
        }
        .pop-cat-chip:hover,
        .pop-cat-chip.active {
            background: rgba(201,168,76,0.18);
            border-color: var(--gold);
            color: var(--gold-light);
        }
        .pop-cat-chip .chip-count {
            font-size: 0.6rem;
            background: rgba(201,168,76,0.22);
            color: var(--gold);
            border-radius: 999px;
            padding: 0 5px;
            font-weight: 700;
        }

        /* ══════════════════════════════
           MAIN LAYOUT
        ══════════════════════════════ */
        .sp-layout {
            display: grid;
            grid-template-columns: var(--sidebar-w) 1fr;
            gap: 1.5rem;
            max-width: 1320px;
            margin: 0 auto;
            padding: 2rem 1.5rem 5rem;
            align-items: start;
        }

        /* ══════════════════════════════
           FILTER SIDEBAR
        ══════════════════════════════ */
        .sp-sidebar {
            position: sticky;
            top: calc(var(--nav-h) + 16px);
            display: flex; flex-direction: column; gap: 1rem;
        }

        /* Mobile filter drawer overlay */
        .sp-sidebar-overlay {
            display: none;
            position: fixed; inset: 0; z-index: 399;
            background: rgba(30,27,24,0.45);
            backdrop-filter: blur(2px);
        }
        .sp-sidebar-overlay.active { display: block; }

        /* Mobile: sidebar becomes a drawer */
        .sp-sidebar-drawer {
            display: flex; flex-direction: column; gap: 1rem;
        }

        .sp-sidebar-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
        }

        .sp-sidebar-head {
            padding: 0.8rem 1rem;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            background: linear-gradient(135deg, rgba(201,168,76,0.04), transparent);
        }
        .sp-sidebar-head-title {
            font-size: 0.6rem; font-weight: 700; letter-spacing: 0.14em;
            text-transform: uppercase; color: var(--gold-dark);
            display: flex; align-items: center; gap: 0.4rem;
        }
        .sp-sidebar-head-title svg { width: 12px; height: 12px; }
        .sp-sidebar-clear {
            font-size: 0.65rem; color: var(--warm-grey); cursor: pointer;
            border: none; background: none; font-family: var(--font-body);
            transition: color 0.15s; padding: 2px 6px; border-radius: 3px;
        }
        .sp-sidebar-clear:hover { color: var(--gold-dark); background: rgba(201,168,76,0.07); }

        /* Filter groups */
        .sp-filter-group { padding: 0.85rem 1rem; }
        .sp-filter-group + .sp-filter-group { border-top: 1px solid var(--border); }
        .sp-filter-group-label { font-size: 0.58rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: #C0B8B0; margin-bottom: 0.6rem; }

        /* Checkbox list */
        .sp-check-list { display: flex; flex-direction: column; gap: 0.35rem; }
        .sp-check-item { display: flex; align-items: center; gap: 0.5rem; cursor: pointer; padding: 4px 5px; border-radius: 5px; transition: background 0.15s; }
        .sp-check-item:hover { background: rgba(201,168,76,0.05); }
        .sp-check-item input { display: none; }
        .sp-check-box {
            width: 15px; height: 15px; border-radius: 3px; border: 1.5px solid var(--border-md); background: var(--white);
            flex-shrink: 0; display: flex; align-items: center; justify-content: center; transition: all 0.15s;
        }
        .sp-check-item input:checked + .sp-check-box { background: var(--gold); border-color: var(--gold); }
        .sp-check-item input:checked + .sp-check-box svg { display: block; }
        .sp-check-box svg { display: none; width: 9px; height: 9px; stroke: var(--charcoal); stroke-width: 2.5; fill: none; }
        .sp-check-name { font-size: 0.8rem; color: var(--charcoal); flex: 1; }
        .sp-check-count { font-size: 0.62rem; color: #C0B8B0; }

        /* Select */
        .sp-select {
            width: 100%; padding: 0.52rem 2rem 0.52rem 0.75rem;
            border: 1px solid var(--border-md); border-radius: 7px;
            font-family: var(--font-body); font-size: 0.8rem; color: var(--charcoal);
            background: var(--ivory); outline: none; appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' fill='none' stroke='%23C0B8B0' stroke-width='1.5'%3E%3Cpath d='M1 1l4 4 4-4'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 0.7rem center;
            transition: border-color 0.2s; cursor: pointer;
        }
        .sp-select:focus { border-color: var(--gold); }

        /* Rating radio */
        .sp-rating-list { display: flex; flex-direction: column; gap: 0.3rem; }
        .sp-rating-item { display: flex; align-items: center; gap: 0.5rem; cursor: pointer; padding: 4px 5px; border-radius: 5px; transition: background 0.15s; }
        .sp-rating-item:hover { background: rgba(201,168,76,0.05); }
        .sp-rating-item input { display: none; }
        .sp-radio-dot {
            width: 14px; height: 14px; border-radius: 50%; border: 1.5px solid var(--border-md); background: var(--white);
            flex-shrink: 0; display: flex; align-items: center; justify-content: center; transition: border-color 0.15s;
        }
        .sp-rating-item input:checked ~ .sp-radio-dot { border-color: var(--gold); }
        .sp-rating-item input:checked ~ .sp-radio-dot::after { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--gold); display: block; }
        .sp-stars { display: flex; gap: 2px; }
        .sp-stars svg { width: 11px; height: 11px; }
        .sp-stars svg.filled { fill: #F97316; stroke: #EA580C; stroke-width: 1.2; stroke-linejoin: round; }
        .sp-stars svg.empty { fill: var(--border); stroke: var(--border-md); stroke-width: 1.2; stroke-linejoin: round; }
        .sp-rating-label { font-size: 0.74rem; color: var(--warm-grey); }

        /* Active filter tags */
        .sp-active-tags { display: flex; flex-wrap: wrap; gap: 0.4rem; padding: 0.65rem 1rem; border-top: 1px solid var(--border); }
        .sp-active-tags:empty { display: none; }
        .sp-tag {
            display: inline-flex; align-items: center; gap: 0.28rem;
            padding: 3px 9px 3px 8px; border-radius: 999px;
            background: rgba(201,168,76,0.1); border: 1px solid rgba(201,168,76,0.25);
            font-size: 0.63rem; font-weight: 600; color: var(--gold-dark);
            cursor: pointer; transition: background 0.15s;
        }
        .sp-tag svg { width: 8px; height: 8px; }
        .sp-tag:hover { background: rgba(201,168,76,0.2); }

        /* ══════════════════════════════
           CONTENT AREA
        ══════════════════════════════ */
        .sp-content { display: flex; flex-direction: column; gap: 1.25rem; min-width: 0; }

        /* Top bar */
        .sp-topbar {
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 0.75rem;
            background: var(--white); border: 1px solid var(--border);
            border-radius: 8px; padding: 0.75rem 1rem;
        }
        .sp-topbar-left { display: flex; align-items: center; gap: 0.75rem; }
        .sp-filter-btn-mobile {
            display: none;
            align-items: center; gap: 0.4rem;
            background: var(--charcoal); color: var(--white);
            border: none; border-radius: 5px;
            padding: 0.42rem 0.9rem;
            font-family: var(--font-body); font-size: 0.72rem; font-weight: 600;
            letter-spacing: 0.04em; text-transform: uppercase;
            cursor: pointer; transition: background 0.2s;
        }
        .sp-filter-btn-mobile svg { width: 13px; height: 13px; }
        .sp-filter-btn-mobile:hover { background: var(--gold-dark); }
        .sp-result-count { font-size: 0.8rem; color: var(--warm-grey); }
        .sp-result-count strong { color: var(--charcoal); font-weight: 700; }
        .sp-sort-wrap { display: flex; align-items: center; gap: 0.5rem; }
        .sp-sort-label { font-size: 0.62rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: #C0B8B0; white-space: nowrap; }
        .sp-sort-sel {
            padding: 0.42rem 2rem 0.42rem 0.7rem;
            border: 1px solid var(--border-md); border-radius: 6px;
            font-family: var(--font-body); font-size: 0.78rem; color: var(--charcoal);
            background: var(--ivory); outline: none; appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' fill='none' stroke='%23C0B8B0' stroke-width='1.5'%3E%3Cpath d='M1 1l4 4 4-4'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 0.6rem center;
            cursor: pointer; transition: border-color 0.2s;
        }
        .sp-sort-sel:focus { border-color: var(--gold); }

        /* ══════════════════════════════
           SUPPLIER GRID
        ══════════════════════════════ */
        .sp-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1rem;
        }

        /* ── SUPPLIER CARD ── */
        .sp-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            display: flex; flex-direction: column;
            position: relative;
            transition: box-shadow 0.22s, transform 0.22s;
            cursor: pointer;
        }
        .sp-card:hover { box-shadow: 0 8px 32px rgba(30,27,24,0.1); transform: translateY(-3px); }
        .sp-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, var(--gold), var(--blush-deep));
            transform: scaleX(0); transform-origin: left; transition: transform 0.3s; z-index: 1;
        }
        .sp-card:hover::before { transform: scaleX(1); }

        /* Medium square photo */
        .sp-card-photo {
            width: 100%;
            aspect-ratio: 4 / 3;
            background: linear-gradient(135deg, var(--charcoal), #2D2820);
            position: relative; overflow: hidden; flex-shrink: 0;
        }
        .sp-card-photo img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.4s ease; }
        .sp-card:hover .sp-card-photo img { transform: scale(1.04); }
        .sp-card-photo-placeholder {
            width: 100%; height: 100%;
            background: linear-gradient(135deg, var(--charcoal) 0%, #2D2820 100%);
            display: flex; align-items: center; justify-content: center;
            position: relative;
        }
        .sp-card-photo-placeholder::before {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px);
            background-size: 14px 14px;
        }
        .sp-card-photo-initials {
            font-family: var(--font-display); font-size: 2.5rem; font-weight: 700;
            color: rgba(201,168,76,0.35); position: relative; z-index: 1;
            letter-spacing: -0.02em;
        }

        /* Overlay category badge */
        .sp-photo-badge {
            position: absolute; top: 0.6rem; left: 0.6rem; z-index: 2;
            display: flex; flex-wrap: wrap; gap: 0.25rem;
        }
        .sp-photo-cat {
            padding: 2px 8px; border-radius: 999px;
            font-size: 0.58rem; font-weight: 700; letter-spacing: 0.04em;
            background: rgba(201,168,76,0.88); color: var(--charcoal);
            backdrop-filter: blur(6px);
        }

        /* Logo badge overlapping photo bottom */
        .sp-card-logo-row {
            display: flex; align-items: flex-end; justify-content: space-between;
            padding: 0 1rem;
            margin-top: -18px;
            position: relative; z-index: 3;
        }
        .sp-logo {
            width: 50px; height: 50px; border-radius: 50%;
            border: 2.5px solid var(--white);
            background: var(--charcoal);
            overflow: hidden; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display); font-size: 0.75rem; font-weight: 700; color: var(--gold);
            box-shadow: 0 2px 8px rgba(30,27,24,0.18);
        }
        .sp-logo img { width: 100%; height: 100%; object-fit: cover; }

        .sp-card-rating {
            display: flex; align-items: center; gap: 3px;
            background: var(--white); border: 1px solid var(--border);
            padding: 2px 7px; border-radius: 999px;
            box-shadow: 0 1px 4px rgba(30,27,24,0.08);
        }
        .sp-card-rating svg { width: 10px; height: 10px; fill: #F97316; stroke: #EA580C; stroke-width: 1.2; stroke-linejoin: round; }
        .sp-card-rating-val { font-size: 0.7rem; font-weight: 700; color: var(--charcoal); font-family: var(--font-display); }
        .sp-card-rating-ct { font-size: 0.6rem; color: #C0B8B0; }

        /* Card body */
        .sp-card-body {
            padding: 0.55rem 1rem 0.85rem;
            display: flex; flex-direction: column; gap: 0.3rem; flex: 1;
        }
        .sp-biz-name { font-family: var(--font-display); font-size: 0.92rem; font-weight: 700; color: var(--charcoal); line-height: 1.2; }
        .sp-owner-name { font-size: 0.68rem; color: var(--warm-grey); }
        .sp-tagline { font-size: 0.7rem; color: var(--gold-dark); font-style: italic; line-height: 1.45; }
        .sp-location { display: flex; align-items: center; gap: 0.3rem; font-size: 0.7rem; color: var(--warm-grey); margin-top: 0.05rem; }
        .sp-location svg { width: 9px; height: 9px; flex-shrink: 0; color: var(--gold-dark); }

        .sp-card-divider { height: 1px; background: var(--border); margin: 0.45rem 0 0.1rem; }

        .sp-view-btn {
            display: flex; align-items: center; justify-content: center; gap: 0.4rem;
            padding: 0.5rem 1rem;
            background: var(--charcoal); color: var(--white);
            border: none; border-radius: 5px;
            font-family: var(--font-body); font-size: 0.7rem; font-weight: 600;
            letter-spacing: 0.05em; text-transform: uppercase;
            text-decoration: none; cursor: pointer;
            position: relative; overflow: hidden; width: 100%;
            transition: transform 0.15s;
        }
        .sp-view-btn::after { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, var(--gold-dark), var(--gold)); opacity: 0; transition: opacity 0.22s; }
        .sp-view-btn:hover::after { opacity: 1; }
        .sp-view-btn:hover { transform: translateY(-1px); }
        .sp-view-btn span, .sp-view-btn svg { position: relative; z-index: 1; }
        .sp-view-btn svg { width: 11px; height: 11px; }

        .sv-view-btn {
            display: flex; align-items: center; justify-content: center; gap: 0.4rem;
            padding: 0.5rem 1rem;
            background: var(--charcoal); color: var(--white);
            border: none; border-radius: 5px;
            font-family: var(--font-body); font-size: 0.7rem; font-weight: 600;
            letter-spacing: 0.05em; text-transform: uppercase;
            text-decoration: none; cursor: pointer;
            position: relative; overflow: hidden; width: 100%;
            transition: transform 0.15s;
        }
        .sv-view-btn::after { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, var(--gold-dark), var(--gold)); opacity: 0; transition: opacity 0.22s; }
        .sv-view-btn:hover::after { opacity: 1; }
        .sv-view-btn:hover { transform: translateY(-1px); }
        .sv-view-btn span, .sv-view-btn svg { position: relative; z-index: 1; }
        .sv-view-btn svg { width: 11px; height: 11px; }

        /* No results */
        .sp-no-results { display: none; text-align: center; padding: 3rem 2rem; background: var(--white); border: 1px solid var(--border); border-radius: 10px; grid-column: 1/-1; }
        .sp-no-results svg { width: 44px; height: 44px; color: var(--gold); opacity: 0.2; margin: 0 auto 0.75rem; display: block; }
        .sp-no-results-title { font-family: var(--font-display); font-size: 1rem; font-weight: 600; color: var(--charcoal); margin-bottom: 0.25rem; }
        .sp-no-results-sub { font-size: 0.8rem; color: var(--warm-grey); }

        /* Empty state */
        .sp-empty { text-align: center; padding: 4rem 2rem; background: var(--white); border: 1px solid var(--border); border-radius: 10px; }
        .sp-empty svg { width: 52px; height: 52px; color: var(--gold); opacity: 0.2; margin: 0 auto 0.85rem; display: block; }
        .sp-empty-title { font-family: var(--font-display); font-size: 1.1rem; font-weight: 600; color: var(--charcoal); margin-bottom: 0.3rem; }
        .sp-empty-sub { font-size: 0.82rem; color: var(--warm-grey); }

        /* Section head */
        .sp-section-head {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 0.8rem;
        }
        .sp-section-label {
            font-size: 0.6rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase;
            color: var(--gold-dark); display: flex; align-items: center; gap: 0.4rem;
        }
        .sp-section-label::after { content: ''; width: 26px; height: 1px; background: linear-gradient(90deg, var(--gold), transparent); }

        /* ══════════════════════════════
           MOBILE SIDEBAR DRAWER
        ══════════════════════════════ */
        .sp-mobile-sidebar {
            display: none;
            position: fixed; top: 0; right: 0; bottom: 0; z-index: 400;
            width: 300px; max-width: 85vw;
            background: var(--white);
            box-shadow: -4px 0 32px rgba(30,27,24,0.15);
            flex-direction: column;
            transform: translateX(100%);
            transition: transform 0.32s cubic-bezier(0.4,0,0.2,1);
            overflow-y: auto;
        }
        .sp-mobile-sidebar.open {
            transform: translateX(0);
        }
        .sp-mobile-sidebar-header {
            position: sticky; top: 0; z-index: 1;
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 1.1rem;
            background: var(--white);
            border-bottom: 1px solid var(--border);
        }
        .sp-mobile-sidebar-title {
            font-size: 0.62rem; font-weight: 700; letter-spacing: 0.14em;
            text-transform: uppercase; color: var(--gold-dark);
            display: flex; align-items: center; gap: 0.4rem;
        }
        .sp-mobile-sidebar-close {
            width: 30px; height: 30px; border-radius: 50%;
            background: var(--border); border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: background 0.15s;
        }
        .sp-mobile-sidebar-close:hover { background: var(--border-md); }
        .sp-mobile-sidebar-close svg { width: 13px; height: 13px; }
        .sp-mobile-sidebar-body {
            padding: 1rem;
            display: flex; flex-direction: column; gap: 1rem;
        }
        .sp-mobile-sidebar-footer {
            padding: 1rem;
            border-top: 1px solid var(--border);
            display: flex; gap: 0.6rem;
        }
        .sp-mob-apply-btn {
            flex: 1; padding: 0.65rem;
            background: var(--charcoal); color: var(--white);
            border: none; border-radius: 6px;
            font-family: var(--font-body); font-size: 0.78rem; font-weight: 600;
            letter-spacing: 0.05em; text-transform: uppercase;
            cursor: pointer; transition: background 0.2s;
        }
        .sp-mob-apply-btn:hover { background: var(--gold-dark); }
        .sp-mob-clear-btn {
            padding: 0.65rem 1rem;
            background: transparent; color: var(--warm-grey);
            border: 1px solid var(--border-md); border-radius: 6px;
            font-family: var(--font-body); font-size: 0.78rem; font-weight: 500;
            cursor: pointer; transition: color 0.2s, border-color 0.2s;
        }
        .sp-mob-clear-btn:hover { color: var(--gold-dark); border-color: var(--gold); }

        /* ══════════════════════════════
           FOOTER
        ══════════════════════════════ */
        footer {
            background: var(--charcoal); border-top: 1px solid rgba(201,168,76,0.2);
            padding: 2.25rem 5%;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 1rem;
        }
        .footer-brand { font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; color: var(--white); }
        .footer-brand span { color: var(--gold); font-style: italic; }
        .footer-copy { font-size: 0.75rem; color: rgba(255,255,255,0.3); }
        .footer-links { display: flex; gap: 1.25rem; }
        .footer-links a { font-size: 0.75rem; color: rgba(255,255,255,0.4); text-decoration: none; transition: color 0.2s; }
        .footer-links a:hover { color: var(--gold-light); }

        /* ══════════════════════════════
           ANIMATIONS
        ══════════════════════════════ */
        .reveal { opacity: 0; transform: translateY(18px); transition: opacity 0.55s ease, transform 0.55s ease; }
        .reveal.visible { opacity: 1; transform: none; }

        /* ══════════════════════════════
           RESPONSIVE
        ══════════════════════════════ */
        @media (max-width: 900px) {
            nav.main-nav { padding: 0.9rem 1.25rem; }
            .hamburger { display: flex; }
            .nav-links { display: none; }
            .mobile-menu { display: flex; }

            /* Hide desktop sidebar; enable mobile drawer */
            .sp-layout { grid-template-columns: 1fr; padding: 1rem 1rem 4rem; gap: 1rem; }
            .sp-sidebar { display: none; } /* hidden on mobile, replaced by drawer */
            .sp-filter-btn-mobile { display: flex; }
            .sp-mobile-sidebar { display: flex; }
        }

        @media (max-width: 600px) {
            .page-hero { padding: 2rem 1.25rem 0; }
            .popular-cats-bar { padding: 0 1.25rem 1.25rem; }
            .hero-search-bar { max-width: 100%; }
            .sp-layout { padding: 0.75rem 0.75rem 3rem; }
            .sp-grid { grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
            .sp-topbar { flex-direction: row; align-items: center; gap: 0.5rem; }
        }

        @media (max-width: 420px) {
            .sp-grid { grid-template-columns: 1fr; }
        }
</style>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Browse Suppliers') }}
    </h2>
</x-slot>

{{-- PAGE HERO WITH LIVE SEARCH --}}
<div class="page-hero">
    <div class="hero-inner">
        <div class="hero-eyebrow">Discover Talent</div>
        <h1>Find your perfect <em>event supplier</em></h1>
        <p class="hero-sub">Browse verified professionals across Bikol and beyond.</p>
        <div class="hero-search-bar">
            <span class="hero-search-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="9" cy="9" r="6"/><path d="M15 15l3 3"/>
                </svg>
            </span>
            <input
                type="text"
                id="spSearch"
                class="hero-search-input"
                placeholder="Search by supplier name, city, category…"
                autocomplete="off"
            >
            <button class="hero-search-btn" onclick="applyFilters()">Search</button>
        </div>
    </div>
</div>

@php
    $allCatsList    = $suppliers->flatMap(fn($s) => $s->categories ?? collect())->unique('id')->sortBy('name');
    $totalSuppliers = $suppliers->count();
    $cities         = $suppliers->map(fn($s) => ($s->supplierProfile->city ?? $s->city ?? null))->filter()->unique()->sort()->values();
@endphp

{{-- POPULAR CATEGORIES BAR --}}
<div class="popular-cats-bar">
    <div class="popular-cats-label">Popular Categories</div>
    <div class="popular-cats-row" id="popCatsRow">
        @foreach($allCatsList as $cat)
        @php $catCount = $suppliers->filter(fn($s) => ($s->categories ?? collect())->pluck('id')->contains($cat->id))->count(); @endphp
        <button
            class="pop-cat-chip"
            data-cat="{{ strtolower($cat->name) }}"
            onclick="togglePopCat(this)"
        >
            {{ $cat->name }}
            <span class="chip-count">{{ $catCount }}</span>
        </button>
        @endforeach
    </div>
</div>

{{-- ═══════════════════════════════════
     MOBILE SIDEBAR FILTER DRAWER
═══════════════════════════════════ --}}
<div class="sp-sidebar-overlay" id="spOverlay" onclick="closeMobileSidebar()"></div>
<div class="sp-mobile-sidebar" id="spMobileSidebar">
    <div class="sp-mobile-sidebar-header">
        <span class="sp-mobile-sidebar-title">
            <svg width="12" height="12" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 3h12M3 7h8M5 11h4"/></svg>
            Filters
        </span>
        <button class="sp-mobile-sidebar-close" onclick="closeMobileSidebar()">
            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 2l8 8M10 2l-8 8"/></svg>
        </button>
    </div>
    <div class="sp-mobile-sidebar-body">

        {{-- Categories --}}
        @if($allCatsList->count())
        <div class="sp-sidebar-card">
            <div class="sp-sidebar-head">
                <span class="sp-sidebar-head-title">Categories</span>
            </div>
            <div class="sp-filter-group">
                <div class="sp-check-list" id="mobCatList">
                    @foreach($allCatsList as $cat)
                    @php $catCount = $suppliers->filter(fn($s) => ($s->categories ?? collect())->pluck('id')->contains($cat->id))->count(); @endphp
                    <label class="sp-check-item">
                        <input type="checkbox" class="sp-cat-check-mob sp-cat-check" value="{{ strtolower($cat->name) }}" onchange="applyFilters()">
                        <span class="sp-check-box">
                            <svg viewBox="0 0 12 10"><polyline points="1,5 4,8 11,1"/></svg>
                        </span>
                        <span class="sp-check-name">{{ $cat->name }}</span>
                        <span class="sp-check-count">{{ $catCount }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- Location --}}
        @if($cities->count())
        <div class="sp-sidebar-card">
            <div class="sp-sidebar-head">
                <span class="sp-sidebar-head-title">Location</span>
            </div>
            <div class="sp-filter-group">
                <select id="spFilterCityMob" class="sp-select" onchange="syncCityAndFilter()">
                    <option value="">All Cities</option>
                    @foreach($cities as $city)
                        <option value="{{ strtolower($city) }}">{{ $city }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif

        {{-- Rating --}}
        <div class="sp-sidebar-card">
            <div class="sp-sidebar-head">
                <span class="sp-sidebar-head-title">Minimum Rating</span>
            </div>
            <div class="sp-filter-group">
                <div class="sp-rating-list">
                    <label class="sp-rating-item">
                        <input type="radio" name="spRatingMob" value="" checked onchange="applyFilters()">
                        <span class="sp-radio-dot"></span>
                        <span class="sp-rating-label" style="font-size:0.78rem;color:var(--warm-grey);">Any rating</span>
                    </label>
                    @foreach([4,3,2,1] as $minR)
                    <label class="sp-rating-item">
                        <input type="radio" name="spRatingMob" value="{{ $minR }}" onchange="applyFilters()">
                        <span class="sp-radio-dot"></span>
                        <div class="sp-stars">
                            @for($s=1;$s<=5;$s++)
                            <svg viewBox="0 0 24 24" class="{{ $s <= $minR ? 'filled' : 'empty' }}">
                                <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/>
                            </svg>
                            @endfor
                        </div>
                        <span class="sp-rating-label">& up</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Active tags --}}
        <div class="sp-active-tags" id="spActiveTagsMob"></div>

    </div>
    <div class="sp-mobile-sidebar-footer">
        <button class="sp-mob-clear-btn" onclick="clearAllFilters()">Clear</button>
        <button class="sp-mob-apply-btn" onclick="closeMobileSidebar()">Apply Filters</button>
    </div>
</div>

{{-- MAIN LAYOUT --}}
<div class="sp-layout">

    {{-- ════════════════════
         DESKTOP FILTER SIDEBAR
    ════════════════════ --}}
    <aside class="sp-sidebar">
        <div class="sp-sidebar-drawer">

            {{-- Filters --}}
            <div class="sp-sidebar-card">
                <div class="sp-sidebar-head">
                    <span class="sp-sidebar-head-title">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 3h12M3 7h8M5 11h4"/></svg>
                        Filters
                    </span>
                    <button class="sp-sidebar-clear" onclick="clearAllFilters()">Clear all</button>
                </div>

                {{-- Categories --}}
                @if($allCatsList->count())
                <div class="sp-filter-group">
                    <div class="sp-filter-group-label">Categories</div>
                    <div class="sp-check-list">
                        @foreach($allCatsList as $cat)
                        @php $catCount = $suppliers->filter(fn($s) => ($s->categories ?? collect())->pluck('id')->contains($cat->id))->count(); @endphp
                        <label class="sp-check-item">
                            <input type="checkbox" class="sp-cat-check-desk sp-cat-check" value="{{ strtolower($cat->name) }}" onchange="applyFilters()">
                            <span class="sp-check-box">
                                <svg viewBox="0 0 12 10"><polyline points="1,5 4,8 11,1"/></svg>
                            </span>
                            <span class="sp-check-name">{{ $cat->name }}</span>
                            <span class="sp-check-count">{{ $catCount }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Location --}}
                @if($cities->count())
                <div class="sp-filter-group">
                    <div class="sp-filter-group-label">Location</div>
                    <select id="spFilterCity" class="sp-select" onchange="syncCityAndFilter()">
                        <option value="">All Cities</option>
                        @foreach($cities as $city)
                            <option value="{{ strtolower($city) }}">{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                {{-- Rating --}}
                <div class="sp-filter-group">
                    <div class="sp-filter-group-label">Minimum Rating</div>
                    <div class="sp-rating-list">
                        <label class="sp-rating-item">
                            <input type="radio" name="spRating" value="" checked onchange="applyFilters()">
                            <span class="sp-radio-dot"></span>
                            <span class="sp-rating-label" style="font-size:0.78rem;color:var(--warm-grey);">Any rating</span>
                        </label>
                        @foreach([4,3,2,1] as $minR)
                        <label class="sp-rating-item">
                            <input type="radio" name="spRating" value="{{ $minR }}" onchange="applyFilters()">
                            <span class="sp-radio-dot"></span>
                            <div class="sp-stars">
                                @for($s=1;$s<=5;$s++)
                                <svg viewBox="0 0 24 24" class="{{ $s <= $minR ? 'filled' : 'empty' }}">
                                    <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/>
                                </svg>
                                @endfor
                            </div>
                            <span class="sp-rating-label">& up</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Active tags --}}
                <div class="sp-active-tags" id="spActiveTags"></div>
            </div>

        </div>
    </aside>

    {{-- ════════════════════
         CONTENT AREA
    ════════════════════ --}}
    <div class="sp-content">

        {{-- Top bar --}}
        <div class="sp-topbar reveal">
            <div class="sp-topbar-left">
                {{-- Mobile filter button (only shows on mobile via CSS) --}}
                <button class="sp-filter-btn-mobile" onclick="openMobileSidebar()">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 3.5h14M3.5 8h9M6 12.5h4"/></svg>
                    Filters
                </button>
                <div class="sp-result-count">
                    Showing <strong id="spVisibleCount">{{ $totalSuppliers }}</strong>
                    of {{ $totalSuppliers }} supplier{{ $totalSuppliers !== 1 ? 's' : '' }}
                </div>
            </div>
            <div class="sp-sort-wrap">
                <span class="sp-sort-label">Sort</span>
                <select id="spSortSelect" class="sp-sort-sel" onchange="applyFilters()">
                    <option value="popular">Most Popular</option>
                    <option value="rating_high">Highest Rated</option>
                    <option value="rating_low">Lowest Rated</option>
                    <option value="reviews">Most Reviews</option>
                    <option value="name_az">Name A–Z</option>
                    <option value="name_za">Name Z–A</option>
                </select>
            </div>
        </div>

        {{-- Supplier Grid --}}
        <div class="sp-grid-section">
            <div class="sp-section-head">
                <span class="sp-section-label">All Suppliers</span>
            </div>

            @if($suppliers->count())
            <div class="sp-grid" id="spGrid">
                @foreach($suppliers as $supplier)
                @php
                    $profile  = $supplier->supplierProfile ?? $supplier;
                    $bizName  = $profile->business_name ?? trim(($profile->first_name ?? '') . ' ' . ($profile->last_name ?? '')) ?: $supplier->name;
                    $fullName = trim(($profile->first_name ?? '') . ' ' . ($profile->last_name ?? ''));
                    $city     = $profile->city     ?? null;
                    $province = $profile->province ?? null;
                    $photo    = $profile->photo    ?? null;
                    $cover_photo    = $profile->cover_photo    ?? null;
                    $tagline  = $profile->tagline  ?? null;
                    $initials = strtoupper(substr($bizName, 0, 2));
                    $cats     = $supplier->categories ?? collect();
                    $catNames = $cats->pluck('name')->map(fn($c) => strtolower($c))->implode(' ');
                    $location = implode(', ', array_filter([$city, $province]));
                    $avg      = $supplier->ratings->avg('rating');
                    $rCount   = $supplier->ratings->count();
                    $avgR     = $avg ? round($avg, 1) : 0;
                @endphp

                <div class="sp-card reveal"
                     data-name="{{ strtolower($bizName) }} {{ strtolower($fullName) }}"
                     data-city="{{ strtolower($city ?? '') }}"
                     data-cat="{{ $catNames }}"
                     data-rating="{{ $avgR }}"
                     data-reviews="{{ $rCount }}"
                     data-bizname="{{ strtolower($bizName) }}">

                    {{-- Medium photo (4:3 ratio) --}}
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

                    {{-- Logo + rating row --}}
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

                        <a href="{{ route('client.show.supplier', $supplier->id) }}" class="sp-view-btn">
                             <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 2l5 5-5 5"/></svg>
                            <span>View Packages</span>
                        </a>
                        <a href="{{ route('client.portfolio', $supplier->id) }}" class="sv-view-btn">
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 2l5 5-5 5"/></svg>
                            <span>View Profile</span>
                        </a>
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

    </div>{{-- /sp-content --}}
</div>{{-- /sp-layout --}}

<script>
    /* ══════════════════════════════════════
    ELEMENTS
    ══════════════════════════════════════ */
    const spSearch      = document.getElementById('spSearch');
    const spFilterCity  = document.getElementById('spFilterCity');
    const spFilterCityMob = document.getElementById('spFilterCityMob');
    const spSortSelect  = document.getElementById('spSortSelect');
    const spGrid        = document.getElementById('spGrid');
    const spCountEl     = document.getElementById('spVisibleCount');
    const spNoResults   = document.getElementById('spNoResults');
    const spActiveTags  = document.getElementById('spActiveTags');
    const spActiveTagsMob = document.getElementById('spActiveTagsMob');

    /* ══════════════════════════════════════
    POPULAR CAT CHIP TOGGLE
    ══════════════════════════════════════ */
    function togglePopCat(chip) {
        const cat = chip.dataset.cat;
        const isActive = chip.classList.toggle('active');

        // Sync both desktop + mobile checkboxes
        document.querySelectorAll(`.sp-cat-check[value="${cat}"]`).forEach(cb => {
            cb.checked = isActive;
        });
        applyFilters();
    }

    /* ══════════════════════════════════════
    CITY SELECT SYNC (desktop <-> mobile)
    ══════════════════════════════════════ */
    function syncCityAndFilter() {
        const val = (document.activeElement === spFilterCityMob)
            ? (spFilterCityMob ? spFilterCityMob.value : '')
            : (spFilterCity ? spFilterCity.value : '');

        if (spFilterCity)    spFilterCity.value    = val;
        if (spFilterCityMob) spFilterCityMob.value = val;
        applyFilters();
    }

    /* ══════════════════════════════════════
    FILTER + SORT ENGINE
    ══════════════════════════════════════ */
    function getCards() {
        return Array.from(document.querySelectorAll('#spGrid .sp-card'));
    }
    function getActiveCats() {
        // Use desk checkboxes on desktop, mob on mobile — both share same values
        const allChecked = Array.from(document.querySelectorAll('.sp-cat-check:checked'));
        return [...new Set(allChecked.map(c => c.value))];
    }
    function getActiveRating() {
        // Check desktop first, then mobile
        const deskChecked = document.querySelector('input[name="spRating"]:checked');
        const mobChecked  = document.querySelector('input[name="spRatingMob"]:checked');
        const checked = deskChecked || mobChecked;
        return checked ? parseFloat(checked.value) || 0 : 0;
    }

    function applyFilters() {
        const q      = (spSearch ? spSearch.value || '' : '').toLowerCase().trim();
        const city   = (spFilterCity ? spFilterCity.value || '' : (spFilterCityMob ? spFilterCityMob.value || '' : '')).toLowerCase();
        const cats   = getActiveCats();
        const minRat = getActiveRating();
        const sort   = spSortSelect ? spSortSelect.value : 'popular';

        let cards = getCards();
        let visible = 0;

        cards.forEach(card => {
            const nameMatch   = !q    || (card.dataset.name || '').includes(q) || (card.dataset.city || '').includes(q) || (card.dataset.cat || '').includes(q);
            const cityMatch   = !city || (card.dataset.city || '').includes(city);
            const catMatch    = cats.length === 0 || cats.some(c => (card.dataset.cat || '').includes(c));
            const ratingMatch = minRat === 0 || (parseFloat(card.dataset.rating) || 0) >= minRat;
            const show = nameMatch && cityMatch && catMatch && ratingMatch;
            card.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        if (spCountEl) spCountEl.textContent = visible;
        if (spNoResults) spNoResults.style.display = visible === 0 ? 'block' : 'none';

        const visibleCards = cards.filter(c => c.style.display !== 'none');
        visibleCards.sort((a, b) => {
            const rA = parseFloat(a.dataset.rating)  || 0;
            const rB = parseFloat(b.dataset.rating)  || 0;
            const vA = parseInt(a.dataset.reviews)   || 0;
            const vB = parseInt(b.dataset.reviews)   || 0;
            const nA = (a.dataset.bizname || '').trim();
            const nB = (b.dataset.bizname || '').trim();
            switch (sort) {
                case 'popular':     return (rB * Math.log(vB + 1)) - (rA * Math.log(vA + 1));
                case 'rating_high': return rB - rA;
                case 'rating_low':  return rA - rB;
                case 'reviews':     return vB - vA;
                case 'name_az':     return nA.localeCompare(nB);
                case 'name_za':     return nB.localeCompare(nA);
                default:            return 0;
            }
        });
        visibleCards.forEach(card => spGrid.appendChild(card));
        if (spNoResults) spGrid.appendChild(spNoResults);

        updateActiveTags(q, city, cats, minRat);
        syncPopCatChips(cats);
    }

    function updateActiveTags(q, city, cats, minRat) {
        [spActiveTags, spActiveTagsMob].forEach(container => {
            if (!container) return;
            container.innerHTML = '';
            if (q)      addTag(container, 'Search: ' + q,  () => { if(spSearch) spSearch.value = ''; applyFilters(); });
            if (city) {
                const cityOpt = spFilterCity ? spFilterCity.querySelector(`option[value="${city}"]`) : null;
                const label = cityOpt ? cityOpt.textContent : city;
                addTag(container, 'City: ' + label, () => {
                    if(spFilterCity)    spFilterCity.value    = '';
                    if(spFilterCityMob) spFilterCityMob.value = '';
                    applyFilters();
                });
            }
            cats.forEach(cat => addTag(container, 'Cat: ' + cat, () => {
                document.querySelectorAll(`.sp-cat-check[value="${cat}"]`).forEach(cb => cb.checked = false);
                applyFilters();
            }));
            if (minRat) addTag(container, minRat + '★ & up', () => {
                document.querySelectorAll('input[name="spRating"][value=""], input[name="spRatingMob"][value=""]').forEach(r => r.checked = true);
                applyFilters();
            });
        });
    }

    function addTag(container, text, onRemove) {
        const tag = document.createElement('button');
        tag.className = 'sp-tag';
        tag.innerHTML = text + `<svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 2l8 8M10 2l-8 8"/></svg>`;
        tag.addEventListener('click', onRemove);
        container.appendChild(tag);
    }

    function syncPopCatChips(activeCats) {
        document.querySelectorAll('.pop-cat-chip').forEach(chip => {
            chip.classList.toggle('active', activeCats.includes(chip.dataset.cat));
        });
    }

    function clearAllFilters() {
        if (spSearch) spSearch.value = '';
        if (spFilterCity)    spFilterCity.value    = '';
        if (spFilterCityMob) spFilterCityMob.value = '';
        document.querySelectorAll('.sp-cat-check').forEach(c => c.checked = false);
        document.querySelectorAll('input[name="spRating"][value=""], input[name="spRatingMob"][value=""]').forEach(r => r.checked = true);
        if (spSortSelect) spSortSelect.value = 'popular';
        applyFilters();
    }

    if (spSearch) spSearch.addEventListener('input', applyFilters);
    applyFilters();

    /* ══════════════════════════════════════
    MOBILE FILTER SIDEBAR DRAWER
    ══════════════════════════════════════ */
    const spMobileSidebar = document.getElementById('spMobileSidebar');
    const spOverlay       = document.getElementById('spOverlay');

    function openMobileSidebar() {
        spMobileSidebar.classList.add('open');
        spOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeMobileSidebar() {
        spMobileSidebar.classList.remove('open');
        spOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    /* ══════════════════════════════════════
    SCROLL REVEAL
    ══════════════════════════════════════ */
    const io = new IntersectionObserver(entries => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 45);
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.05 });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));

</script>

</x-client-layout>