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

        * { box-sizing: border-box; }

        /* ── PAGE WRAPPER ── */
        .browse-wrap {
            font-family: var(--font-body);
            background: var(--ivory);
            min-height: 100vh;
            padding-bottom: 4rem;
        }

        /* ── DASHBOARD PAGE HEADER ── */
        .dash-header {
            background: var(--charcoal);
            padding: 2rem 2rem 1.75rem;
            position: relative; overflow: hidden;
            margin-bottom: 0;
        }
        .dash-header::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        .dash-header::after {
            content: '';
            position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }
        .dh-inner {
            position: relative; z-index: 1;
            display: flex; align-items: flex-end; justify-content: space-between;
            flex-wrap: wrap; gap: 1rem;
        }
        .dh-left {}
        .dh-eyebrow {
            font-size: 0.62rem; letter-spacing: 0.2em; text-transform: uppercase;
            color: var(--gold); font-weight: 500;
            display: flex; align-items: center; gap: 0.5rem;
            margin-bottom: 0.4rem; font-family: var(--font-body);
        }
        .dh-eyebrow::before { content: ''; display: block; width: 20px; height: 1px; background: var(--gold); }
        .dh-title {
            font-family: var(--font-display);
            font-size: clamp(1.3rem, 2.5vw, 1.9rem);
            font-weight: 700; color: var(--white); line-height: 1.15;
        }
        .dh-title em { color: var(--gold-light); font-style: italic; }
        .dh-sub { font-size: 0.8rem; color: rgba(255,255,255,0.42); margin-top: 0.3rem; font-family: var(--font-body); }
        .dh-count {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 0.7rem; font-weight: 600; letter-spacing: 0.08em;
            text-transform: uppercase; color: var(--gold);
            background: rgba(201,168,76,0.12); border: 1px solid rgba(201,168,76,0.28);
            padding: 5px 14px; border-radius: 2px; white-space: nowrap;
            font-family: var(--font-body); align-self: flex-end;
        }

        /* ── TOOLBAR (search + sort) ── */
        .toolbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0.85rem 2rem;
            display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;
        }

        /* ── LIVE SEARCH ── */
        .search-wrap {
            flex: 1; min-width: 200px;
            display: flex; align-items: center;
            border: 1px solid var(--border-md); border-radius: 3px;
            background: var(--ivory); overflow: hidden;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .search-wrap:focus-within {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
        }
        .search-wrap svg { margin: 0 0.7rem; flex-shrink: 0; color: var(--warm-grey); opacity: 0.5; }
        .search-wrap input {
            flex: 1; border: none; background: transparent;
            padding: 0.58rem 0.75rem 0.58rem 0;
            font-size: 0.875rem; font-family: var(--font-body);
            color: var(--charcoal); outline: none;
        }
        .search-wrap input::placeholder { color: #B0A89E; }

        /* Spinner inside search */
        .search-spinner {
            width: 14px; height: 14px; border-radius: 50%;
            border: 2px solid var(--border-md);
            border-top-color: var(--gold);
            animation: spin .6s linear infinite;
            margin-right: 0.7rem; display: none; flex-shrink: 0;
        }
        .search-spinner.active { display: block; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Clear X button inside search */
        .search-clear {
            background: none; border: none; cursor: pointer;
            color: var(--warm-grey); opacity: 0; padding: 0 0.6rem;
            font-size: 1rem; line-height: 1; transition: opacity .15s;
            display: flex; align-items: center;
        }
        .search-clear.visible { opacity: 0.5; }
        .search-clear:hover { opacity: 1; color: var(--charcoal); }

        .search-btn {
            background: var(--gold); color: var(--charcoal);
            border: none; padding: 0.58rem 1.25rem;
            font-size: 0.75rem; font-weight: 500; letter-spacing: 0.05em;
            text-transform: uppercase; cursor: pointer; border-radius: 3px;
            font-family: var(--font-body); transition: background 0.2s; white-space: nowrap;
        }
        .search-btn:hover { background: var(--gold-light); }

        /* Mobile filter open button (toolbar) */
        .filter-open-btn {
            display: none;
            align-items: center; gap: 0.4rem;
            padding: 0.5rem 0.85rem;
            background: var(--white); color: var(--charcoal);
            border: 1px solid var(--border-md); border-radius: 3px;
            font-size: 0.75rem; font-weight: 500; letter-spacing: 0.04em;
            text-transform: uppercase; font-family: var(--font-body);
            cursor: pointer; white-space: nowrap; flex-shrink: 0;
            transition: border-color .18s, color .18s;
        }
        .filter-open-btn:hover { border-color: var(--gold); color: var(--gold-dark); }
        .filter-open-btn .filter-count-badge {
            background: var(--gold); color: var(--charcoal);
            font-size: 0.62rem; font-weight: 700;
            width: 17px; height: 17px; border-radius: 99px;
            display: inline-flex; align-items: center; justify-content: center;
        }

        /* Sort tabs inline */
        .sort-tabs { display: flex; gap: 0.3rem; flex-wrap: wrap; flex-shrink: 0; }
        .sort-tab {
            padding: 0.38rem 0.9rem;
            border: 1px solid var(--border-md); border-radius: 2px;
            font-size: 0.72rem; color: var(--warm-grey); background: var(--ivory);
            cursor: pointer; font-family: var(--font-body);
            transition: all 0.18s; white-space: nowrap; text-decoration: none; display: inline-block;
        }
        .sort-tab:hover { border-color: var(--gold); color: var(--gold-dark); }
        .sort-tab.active {
            background: var(--gold); border-color: var(--gold);
            color: var(--charcoal); font-weight: 600;
        }

        /* ── BODY LAYOUT ── */
        .body-layout {
            display: grid;
            grid-template-columns: 236px 1fr;
            gap: 0;
            padding: 1.75rem 2rem 0;
            align-items: start;
        }
        @media (max-width: 860px) {
            .body-layout { grid-template-columns: 1fr; padding: 1.25rem 1rem 0; }
            .sidebar-col { display: none; } /* hidden — replaced by drawer on mobile */
            .filter-open-btn { display: flex; }
            .toolbar { padding: 0.75rem 1rem; }
        }

        /* ── SIDEBAR (desktop) ── */
        .sidebar-col {
            margin-right: 1.5rem;
        }

        /* White card wrapper — CHANGED from original bg */
        .bv-id-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 4px;
            overflow: hidden;
            position: sticky; top: 80px;
        }

        .sb-head {
            padding: 0.85rem 1.1rem;
            border-bottom: 1px solid var(--border);
            font-size: 0.6rem; font-weight: 700; letter-spacing: 0.18em;
            text-transform: uppercase; color: var(--gold-dark);
            display: flex; align-items: center; gap: 0.45rem;
            font-family: var(--font-body);
            background: rgba(201,168,76,0.03);
        }
        .sb-head::after { content: ''; flex: 1; height: 1px; background: linear-gradient(90deg, var(--gold), transparent); }
        .sb-icon {
            width: 20px; height: 20px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            color: var(--gold-dark); opacity: 0.7;
        }
        .sb-section { padding: 1rem 1.1rem; border-bottom: 1px solid var(--border); background: var(--white); }
        .sb-section:last-child { border-bottom: none; }
        .sb-section-title {
            font-size: 0.65rem; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase; color: var(--charcoal);
            margin-bottom: 0.65rem; font-family: var(--font-body);
        }

        /* Checkboxes */
        .check-item {
            display: flex; align-items: center; gap: 0.5rem;
            margin-bottom: 0.45rem; cursor: pointer;
        }
        .check-item:last-child { margin-bottom: 0; }
        .check-item input[type="checkbox"] { display: none; }
        .cb {
            width: 14px; height: 14px; border-radius: 2px;
            border: 1.5px solid var(--border-md); flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.15s;
        }
        .check-item input:checked ~ .cb {
            background: var(--gold); border-color: var(--gold);
        }
        .check-item input:checked ~ .cb::after {
            content: ''; display: block;
            width: 3px; height: 5px;
            border: 1.8px solid var(--white);
            border-top: none; border-left: none;
            transform: rotate(45deg) translateY(-1px);
        }
        .check-label { font-size: 0.8rem; color: var(--warm-grey); font-family: var(--font-body); line-height: 1; }

        /* Radio rating */
        .rating-row {
            display: flex; align-items: center; gap: 0.45rem;
            margin-bottom: 0.45rem; cursor: pointer;
        }
        .rating-row:last-child { margin-bottom: 0; }
        .rating-row input[type="radio"] { display: none; }
        .rdot {
            width: 13px; height: 13px; border-radius: 50%;
            border: 1.5px solid var(--border-md); flex-shrink: 0;
            display: flex; align-items: center; justify-content: center; transition: border-color 0.15s;
        }
        .rating-row input:checked ~ .rdot { border-color: var(--gold); }
        .rating-row input:checked ~ .rdot::after {
            content: ''; width: 5px; height: 5px; border-radius: 50%; background: var(--gold); display: block;
        }
        .star-row { display: flex; gap: 1px; }
        .sf  { color: var(--gold); font-size: 11px; }
        .se  { color: #D8D0C8; font-size: 11px; }
        .and-up { font-size: 0.7rem; color: var(--warm-grey); font-family: var(--font-body); }

        /* Avail toggle */
        .avail-toggle {
            display: flex; align-items: center; gap: 0.5rem; cursor: pointer;
        }
        .avail-toggle input[type="checkbox"] { display: none; }
        .toggle-track {
            width: 32px; height: 18px; border-radius: 99px;
            background: var(--border-md); position: relative;
            transition: background 0.2s; flex-shrink: 0;
        }
        .avail-toggle input:checked ~ .toggle-track { background: var(--gold); }
        .toggle-thumb {
            position: absolute; top: 2px; left: 2px;
            width: 14px; height: 14px; border-radius: 50%;
            background: var(--white); transition: left 0.2s;
            box-shadow: 0 1px 4px rgba(0,0,0,0.15);
        }
        .avail-toggle input:checked ~ .toggle-track .toggle-thumb { left: 16px; }
        .avail-label { font-size: 0.8rem; color: var(--warm-grey); font-family: var(--font-body); }

        /* Reset */
        .sb-reset { padding: 0.85rem 1.1rem; background: var(--white); }
        .reset-btn {
            width: 100%; padding: 0.58rem;
            background: transparent; color: var(--warm-grey);
            border: 1px solid var(--border); border-radius: 3px;
            font-size: 0.72rem; cursor: pointer; font-family: var(--font-body);
            transition: border-color 0.2s, color 0.2s; text-align: center;
            text-decoration: none; display: block;
        }
        .reset-btn:hover { border-color: var(--gold); color: var(--gold-dark); }

        /* ════════════════════════════════
           MOBILE DRAWER FILTER
        ════════════════════════════════ */
        /* Overlay */
        .drawer-overlay {
            display: none;
            position: fixed; inset: 0; z-index: 1000;
            background: rgba(30,27,24,0.5);
            backdrop-filter: blur(2px);
            animation: fadeOverlay .2s ease;
        }
        .drawer-overlay.open { display: block; }
        @keyframes fadeOverlay { from { opacity:0; } to { opacity:1; } }

        /* Drawer panel */
        .filter-drawer {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: min(300px, 88vw);
            background: var(--white);
            z-index: 1001;
            display: flex; flex-direction: column;
            transform: translateX(-100%);
            transition: transform .28s cubic-bezier(.4,0,.2,1);
            overflow: hidden;
        }
        .filter-drawer.open { transform: translateX(0); }

        /* Drawer header */
        .drawer-head {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 1.1rem;
            background: var(--charcoal);
            border-bottom: 1px solid rgba(201,168,76,0.2);
            flex-shrink: 0;
            position: relative;
        }
        .drawer-head::after {
            content: '';
            position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }
        .drawer-head-title {
            display: flex; align-items: center; gap: 0.5rem;
            font-size: 0.65rem; font-weight: 700; letter-spacing: 0.16em;
            text-transform: uppercase; color: var(--gold); font-family: var(--font-body);
        }
        .drawer-head-title svg { opacity: .7; }
        .drawer-close {
            width: 30px; height: 30px; border-radius: 3px;
            background: rgba(201,168,76,0.1); border: 1px solid rgba(201,168,76,0.2);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--gold); transition: background .18s;
        }
        .drawer-close:hover { background: rgba(201,168,76,0.22); }

        /* Drawer scrollable body */
        .drawer-body {
            flex: 1; overflow-y: auto; background: var(--white);
        }
        .drawer-body::-webkit-scrollbar { width: 3px; }
        .drawer-body::-webkit-scrollbar-thumb { background: var(--border-md); }

        /* Drawer footer */
        .drawer-footer {
            border-top: 1px solid var(--border);
            padding: 0.85rem 1.1rem;
            background: var(--white); flex-shrink: 0;
        }
        .drawer-apply-btn {
            width: 100%; padding: 0.65rem;
            background: var(--gold); color: var(--charcoal);
            border: none; border-radius: 3px;
            font-size: 0.78rem; font-weight: 600; letter-spacing: 0.05em;
            text-transform: uppercase; cursor: pointer; font-family: var(--font-body);
            transition: background .18s;
        }
        .drawer-apply-btn:hover { background: var(--gold-light); }

        /* ── CONTENT AREA ── */
        .content-area { min-width: 0; }

        /* Result count row */
        .result-row {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 1rem; flex-wrap: wrap; gap: 0.5rem;
        }
        .result-count { font-size: 0.8rem; color: var(--warm-grey); font-family: var(--font-body); }
        .result-count strong { color: var(--charcoal); font-weight: 600; }

        /* Live search no-results inline */
        .live-no-results {
            display: none;
            grid-column: 1 / -1;
            text-align: center; padding: 3rem 2rem;
            background: var(--white);
            border: 1px solid var(--border); border-radius: 4px;
        }
        .live-no-results svg { margin: 0 auto 0.75rem; display: block; opacity: .3; color: var(--gold-dark); }
        .live-no-results h3 { font-family: var(--font-display); font-size: 1.1rem; color: var(--charcoal); margin-bottom: .3rem; }
        .live-no-results p { font-size: 0.83rem; color: var(--warm-grey); font-family: var(--font-body); }

        /* ── SUPPLIER GRID ── */
        .sup-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
        }
        @media (max-width: 1100px) { .sup-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 560px)  { .sup-grid { grid-template-columns: 1fr; } }

        /* ── SUPPLIER CARD ── */
        .sup-card {
            background: var(--white);
            border: 1px solid var(--border); border-radius: 4px;
            overflow: hidden; position: relative;
            transition: box-shadow 0.22s, transform 0.22s, border-color 0.22s;
            display: flex; flex-direction: column;
        }
        .sup-card:hover {
            box-shadow: 0 8px 28px rgba(30,27,24,0.09);
            transform: translateY(-3px);
            border-color: rgba(201,168,76,0.35);
        }
        .sup-card::before {
            content: ''; position: absolute;
            top: 0; left: 0; right: 0; height: 2px; z-index: 1;
            background: linear-gradient(90deg, var(--gold), var(--blush-deep));
            transform: scaleX(0); transform-origin: left;
            transition: transform 0.3s ease;
        }
        .sup-card:hover::before { transform: scaleX(1); }

        /* Mini banner */
        .card-banner {
            height: 48px; background: var(--charcoal);
            position: relative; overflow: hidden; flex-shrink: 0;
        }
        .cb-grad {
            position: absolute; inset: 0;
            background: linear-gradient(135deg, #1E1B18 0%, #374151 60%, #2D2A27 100%);
        }
        .cb-dots {
            position: absolute; inset: 0; opacity: 0.07;
            background-image: radial-gradient(#fff 1px, transparent 1px);
            background-size: 14px 14px;
        }

        /* Card top */
        .card-top {
            padding: 0 1rem;
            display: flex; gap: 0.75rem; align-items: flex-end;
            margin-top: -10px; position: relative; z-index: 2;
            padding-bottom: 0.85rem;
            border-bottom: 1px solid var(--border);
        }
        .c-avatar {
            width: 48px; height: 48px; border-radius: 50%;
            object-fit: cover; flex-shrink: 0;
            border: 2.5px solid var(--white);
            box-shadow: 0 2px 8px rgba(30,27,24,0.12);
            background: #E0D8D0;
        }
        .c-avatar-fb {
            width: 48px; height: 48px; border-radius: 50%;
            background: var(--charcoal); flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display); font-size: 1rem;
            font-weight: 700; color: var(--gold);
            border: 2.5px solid var(--white);
            box-shadow: 0 2px 8px rgba(30,27,24,0.12);
        }
        .c-info { flex: 1; min-width: 0; padding-top: 26px; }
        .c-name {
            font-family: var(--font-display);
            font-size: 0.92rem; font-weight: 600;
            color: var(--charcoal); line-height: 1.2;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .c-person { font-size: 0.7rem; color: var(--warm-grey); margin-top: 1px; font-family: var(--font-body); }
        .c-location {
            display: flex; align-items: center; gap: 0.25rem;
            font-size: 0.68rem; color: var(--warm-grey); margin-top: 3px;
            font-family: var(--font-body);
        }
        .c-location svg { color: var(--gold-dark); opacity: 0.7; flex-shrink: 0; }
        .c-rating {
            display: flex; align-items: center; gap: 0.25rem;
            font-size: 0.7rem; margin-top: 3px; font-family: var(--font-body);
        }
        .c-stars { display: flex; gap: 1px; }
        .c-stars .sf { color: var(--gold); font-size: 10px; }
        .c-stars .se { color: #D8D0C8; font-size: 10px; }
        .c-rating-val { font-weight: 600; color: var(--charcoal); font-size: 0.7rem; }

        /* Stats strip inside card */
        .c-stats {
            display: grid; grid-template-columns: repeat(3, 1fr);
            border-bottom: 1px solid var(--border);
        }
        .c-stat {
            padding: 0.65rem 0.4rem; text-align: center;
            border-right: 1px solid var(--border);
        }
        .c-stat:last-child { border-right: none; }
        .c-stat-n {
            font-family: var(--font-display);
            font-size: 1rem; font-weight: 700;
            color: var(--gold-dark); display: block; line-height: 1;
        }
        .c-stat-l {
            font-size: 0.58rem; letter-spacing: 0.08em; text-transform: uppercase;
            color: var(--warm-grey); margin-top: 2px; font-family: var(--font-body);
        }

        /* Card body */
        .card-body { padding: 0.8rem 1rem 1rem; flex: 1; display: flex; flex-direction: column; }
        .c-tagline {
            font-size: 0.75rem; color: var(--warm-grey); font-style: italic;
            line-height: 1.5; margin-bottom: 0.65rem;
            display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden;
            min-height: 2.25em; font-family: var(--font-body);
        }
        .c-tags { display: flex; gap: 0.35rem; flex-wrap: wrap; margin-bottom: 0.75rem; }
        .c-tag {
            font-size: 0.58rem; font-weight: 700; letter-spacing: 0.06em;
            text-transform: uppercase; color: var(--gold-dark);
            background: rgba(201,168,76,0.09); border: 1px solid rgba(201,168,76,0.22);
            padding: 2px 7px; border-radius: 2px; font-family: var(--font-body);
        }
        .c-avail {
            font-size: 0.58rem; font-weight: 700; letter-spacing: 0.04em;
            text-transform: uppercase; padding: 2px 7px; border-radius: 2px;
            display: inline-flex; align-items: center; gap: 3px;
            font-family: var(--font-body);
        }
        .c-avail.yes { background: #F0FDF4; color: #15803D; border: 1px solid #BBF7D0; }
        .c-avail.no  { background: #FFFBEB; color: #B45309; border: 1px solid #FDE68A; }
        .c-avail-dot { width: 5px; height: 5px; border-radius: 50%; }
        .c-avail.yes .c-avail-dot { background: #22C55E; }
        .c-avail.no  .c-avail-dot { background: #F59E0B; }

        .c-price {
            font-size: 0.72rem; color: var(--warm-grey); margin-bottom: 0.75rem;
            font-family: var(--font-body); margin-top: auto; padding-top: 0.5rem;
        }
        .c-price strong {
            font-family: var(--font-display); font-size: 0.92rem;
            color: var(--charcoal); font-weight: 700;
        }

        /* View profile button */
        .view-btn {
            display: block; width: 100%; padding: 0.6rem;
            background: transparent; color: var(--charcoal);
            border: 1px solid rgba(30,27,24,0.18); border-radius: 2px;
            font-size: 0.7rem; font-weight: 500; letter-spacing: 0.06em;
            text-transform: uppercase; text-align: center; text-decoration: none;
            font-family: var(--font-body);
            transition: background 0.18s, border-color 0.18s, color 0.18s;
        }
        .view-btn:hover { background: var(--charcoal); color: var(--white); border-color: var(--charcoal); }

        /* ── EMPTY STATE ── */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center; padding: 4rem 2rem;
            background: var(--white);
            border: 1px solid var(--border); border-radius: 4px;
        }
        .empty-icon {
            width: 56px; height: 56px; margin: 0 auto 1rem;
            background: var(--ivory); border: 1px solid var(--border-md);
            border-radius: 4px; display: flex; align-items: center; justify-content: center;
        }
        .empty-icon svg { color: var(--gold); opacity: 0.45; }
        .empty-state h3 {
            font-family: var(--font-display); font-size: 1.15rem;
            color: var(--charcoal); margin-bottom: 0.4rem;
        }
        .empty-state p { font-size: 0.85rem; color: var(--warm-grey); font-family: var(--font-body); }

        /* ── PAGINATION ── */
        .pagination {
            display: flex; align-items: center; justify-content: center;
            gap: 0.3rem; margin-top: 2rem; flex-wrap: wrap;
        }
        .page-btn {
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            border: 1px solid var(--border); border-radius: 2px;
            font-size: 0.78rem; color: var(--warm-grey);
            cursor: pointer; background: var(--white);
            font-family: var(--font-body); transition: all 0.18s; text-decoration: none;
        }
        .page-btn:hover { border-color: var(--gold); color: var(--gold-dark); }
        .page-btn.active { background: var(--gold); border-color: var(--gold); color: var(--charcoal); font-weight: 700; }
        .page-btn.disabled { opacity: 0.32; pointer-events: none; }

        /* ── REVEAL ── */
        .reveal { opacity: 0; transform: translateY(16px); transition: opacity 0.5s ease, transform 0.5s ease; }
        .reveal.visible { opacity: 1; transform: none; }

        /* Live-search hidden card */
        .sup-card.ls-hidden { display: none !important; }
    </style>

    {{-- ════════════════════════════════════════
         MOBILE FILTER DRAWER
    ════════════════════════════════════════ --}}
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
            {{-- same form contents mirrored for mobile --}}
            <form method="GET" action="{{ request()->url() }}" id="drawer-filter-form">
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                @if(request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif

                @if(isset($cities) && $cities->count())
                <div class="sb-section">
                    <div class="sb-section-title">Location</div>
                    @php
                        $selCities = request()->input('city', []);
                        if (!is_array($selCities)) $selCities = [$selCities];
                    @endphp
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

                        @php
                            $selCats = request()->input('category', []);
                            if (!is_array($selCats)) $selCats = [$selCats];
                        @endphp

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

                <div class="sb-reset">
                    <a href="{{ request()->url() }}" class="reset-btn">Reset Filters</a>
                </div>
            </form>
        </div>

        <div class="drawer-footer">
            <button class="drawer-apply-btn" onclick="document.getElementById('drawer-filter-form').submit()">
                Apply Filters
            </button>
        </div>
    </div>

    {{-- ════════════════════════════════════════
         MAIN PAGE
    ════════════════════════════════════════ --}}
    <div class="browse-wrap">

        {{-- TOOLBAR --}}
        <div class="toolbar">

            {{-- Mobile filter button --}}
            <button class="filter-open-btn" id="filter-open-btn" onclick="openDrawer()">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/>
                </svg>
                Filters
                @php
                    $activeFilters = count((array) request('city', [])) + count((array) request('category', []));
                @endphp
                @if($activeFilters > 0)
                    <span class="filter-count-badge">{{ $activeFilters }}</span>
                @endif
            </button>

            <form method="GET" action="{{ request()->url() }}" id="search-form" style="display:contents;">
                @if(request('city'))
                    @foreach((array) request('city') as $c)
                        <input type="hidden" name="city[]" value="{{ $c }}">
                    @endforeach
                @endif
                @if(request('category'))
                    @foreach((array) request('category') as $c)
                        <input type="hidden" name="category[]" value="{{ $c }}">
                    @endforeach
                @endif
                @if(request('rating'))
                    <input type="hidden" name="rating" value="{{ request('rating') }}">
                @endif
                @if(request('available_only'))
                    <input type="hidden" name="available_only" value="1">
                @endif

                <div class="search-wrap">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                    </svg>
                    <input type="text" name="search" id="live-search-input"
                        value="{{ request('search') }}"
                        placeholder="Search by name, category, or location…"
                        autocomplete="off">
                    <div class="search-spinner" id="search-spinner"></div>
                    <button type="button" class="search-clear" id="search-clear" onclick="clearSearch()" title="Clear search">✕</button>
                </div>
                
            </form>
        </div>

        {{-- BODY --}}
        <div class="body-layout">

            {{-- LEFT: Sidebar (desktop only) --}}
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
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        @if(request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif

                        {{-- Location --}}
                        @if(isset($cities) && $cities->count())
                        <div class="sb-section">
                            <div class="sb-section-title">Location</div>
                            @php
                                $selCities = request()->input('city', []);
                                if (!is_array($selCities)) $selCities = [$selCities];
                            @endphp
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

                        {{-- Category --}}
                        @if(isset($categories) && $categories->count())
                        <div class="sb-section">
                            <div class="sb-section-title">Category</div>

                            @php
                                $selCats = request()->input('category', []);
                                if (!is_array($selCats)) $selCats = [$selCats];
                            @endphp

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

                        {{-- Rating 
                        <div class="sb-section">
                            <div class="sb-section-title">Rating</div>
                            @foreach([5,4,3,2] as $r)
                            <label class="rating-row">
                                <input type="radio" name="rating" value="{{ $r }}"
                                    onchange="this.form.submit()"
                                    {{ request('rating') == $r ? 'checked' : '' }}>
                                <span class="rdot"></span>
                                <div class="star-row">
                                    @for($s=1;$s<=5;$s++)
                                        <span class="{{ $s<=$r ? 'sf' : 'se' }}">★</span>
                                    @endfor
                                </div>
                                @if($r < 5)<span class="and-up">& Up</span>@endif
                            </label>
                            @endforeach
                        </div>--}}

                        {{-- Availability 
                        <div class="sb-section">
                            <div class="sb-section-title">Availability</div>
                            <label class="avail-toggle">
                                <input type="checkbox" name="available_only" value="1"
                                    onchange="this.form.submit()"
                                    {{ request('available_only') ? 'checked' : '' }}>
                                <span class="toggle-track">
                                    <span class="toggle-thumb"></span>
                                </span>
                                <span class="avail-label">Available only</span>
                            </label>
                        </div>--}}

                        {{-- Reset 
                        <div class="sb-reset">
                            <a href="{{ request()->url() }}" class="reset-btn">Reset Filters</a>
                        </div>--}}
                    </form>
                </div>
            </div>

            {{-- GRID --}}
            <div class="content-area">
                <div class="result-row">
                    <div class="result-count" id="result-count">
                        Showing
                        <strong id="result-count-num">{{ $suppliers instanceof \Illuminate\Pagination\LengthAwarePaginator ? $suppliers->total() : $suppliers->count() }}</strong>
                        supplier<span id="result-count-plural">{{ ($suppliers instanceof \Illuminate\Pagination\LengthAwarePaginator ? $suppliers->total() : $suppliers->count()) !== 1 ? 's' : '' }}</span>
                    </div>
                </div>

                <div class="sup-grid" id="sup-grid">
                    @forelse($suppliers as $supplier)
                    <div class="sup-card reveal"
                         data-search="{{ strtolower(implode(' ', array_filter([
                             $supplier->business_name ?? '',
                             $supplier->first_name ?? '',
                             $supplier->last_name ?? '',
                             $supplier->name ?? '',
                             $supplier->category ?? '',
                             $supplier->city ?? '',
                             $supplier->province ?? '',
                             $supplier->tagline ?? '',
                             $supplier->bio ?? '',
                         ]))) }}">

                        {{-- Top: avatar + info --}}
                        <div class="card-top">
                            @if($supplier->photo)
                                <img class="c-avatar"
                                    src="{{ asset('storage/'.$supplier->photo) }}"
                                    alt="{{ $supplier->business_name }}">
                            @else
                                <div class="c-avatar-fb">
                                    {{ strtoupper(substr($supplier->business_name ?? $supplier->first_name ?? $supplier->name ?? 'S', 0, 2)) }}
                                </div>
                            @endif

                            <div class="c-info">
                                <div class="c-name">{{ $supplier->business_name ?? $supplier->name }}</div>
                                <div class="c-person">{{ $supplier->first_name ?? '' }} {{ $supplier->last_name ?? '' }}</div>

                                @if($supplier->city || $supplier->province)
                                <div class="c-location">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/>
                                        <circle cx="12" cy="10" r="3"/>
                                    </svg>
                                    {{ collect([$supplier->city ?? null, $supplier->province ?? null])->filter()->implode(', ') }}
                                </div>
                                @endif

                                @if($supplier->rating)
                                <div class="c-rating">
                                    <div class="c-stars">
                                        @for($s=1;$s<=5;$s++)
                                            <span class="{{ $s <= round($supplier->rating) ? 'sf' : 'se' }}">★</span>
                                        @endfor
                                    </div>
                                    <span class="c-rating-val">{{ number_format($supplier->rating, 1) }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        {{-- Body --}}
                        <div class="card-body">
                            @if($supplier->tagline ?? null)
                                <p class="c-tagline">"{{ $supplier->tagline }}"</p>
                            @elseif($supplier->bio ?? null)
                                <p class="c-tagline">{{ $supplier->bio }}</p>
                            @else
                                <p class="c-tagline" style="opacity:0;">&nbsp;</p>
                            @endif

                            <div class="c-tags">
                                @if($supplier->category ?? null)
                                    <span class="c-tag">{{ $supplier->category->name }}</span>
                                @endif
                                @if($supplier->is_available ?? false)
                                    <span class="c-avail yes">
                                        <span class="c-avail-dot"></span>Available
                                    </span>
                                @else
                                    <span class="c-avail no">
                                        <span class="c-avail-dot"></span>Unavailable
                                    </span>
                                @endif
                            </div>

                            <a href="{{ route('client.suppliers.show', ['id' => $supplier->id]) }}"
                            class="view-btn">
                                View Profile
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="empty-state">
                        <div class="empty-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M20 21a8 8 0 1 0-16 0"/>
                            </svg>
                        </div>
                        <h3>No suppliers found</h3>
                        <p>Try adjusting your filters or search terms.</p>
                    </div>
                    @endforelse

                    {{-- Live-search no results (shown by JS) --}}
                    <div class="live-no-results" id="live-no-results">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3">
                            <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                        </svg>
                        <h3>No results found</h3>
                        <p>Try a different keyword or clear the search.</p>
                    </div>
                </div>

                {{-- PAGINATION --}}
                @if($suppliers instanceof \Illuminate\Pagination\LengthAwarePaginator && $suppliers->hasPages())
                <div class="pagination" id="pagination-wrap">
                    <a href="{{ $suppliers->previousPageUrl() ?? '#' }}"
                    class="page-btn {{ $suppliers->onFirstPage() ? 'disabled' : '' }}">‹</a>
                    @foreach($suppliers->getUrlRange(1, $suppliers->lastPage()) as $page => $url)
                        <a href="{{ $url }}"
                        class="page-btn {{ $page === $suppliers->currentPage() ? 'active' : '' }}">
                            {{ $page }}
                        </a>
                    @endforeach
                    <a href="{{ $suppliers->nextPageUrl() ?? '#' }}"
                    class="page-btn {{ !$suppliers->hasMorePages() ? 'disabled' : '' }}">›</a>
                </div>
                @endif
            </div>

        </div>{{-- end body-layout --}}
    </div>{{-- end browse-wrap --}}

    <script>
        /* ════════════════════════════════════════
           MOBILE DRAWER
        ════════════════════════════════════════ */
        function openDrawer() {
            document.getElementById('filter-drawer').classList.add('open');
            document.getElementById('drawer-overlay').classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function closeDrawer() {
            document.getElementById('filter-drawer').classList.remove('open');
            document.getElementById('drawer-overlay').classList.remove('open');
            document.body.style.overflow = '';
        }

        /* ════════════════════════════════════════
           LIVE SEARCH
        ════════════════════════════════════════ */
        const liveInput   = document.getElementById('live-search-input');
        const clearBtn    = document.getElementById('search-clear');
        const spinner     = document.getElementById('search-spinner');
        const grid        = document.getElementById('sup-grid');
        const noResults   = document.getElementById('live-no-results');
        const countNum    = document.getElementById('result-count-num');
        const countPlural = document.getElementById('result-count-plural');
        const pagination  = document.getElementById('pagination-wrap');
        let searchTimer   = null;

        function updateClearBtn() {
            clearBtn.classList.toggle('visible', liveInput.value.length > 0);
        }

        function clearSearch() {
            liveInput.value = '';
            updateClearBtn();
            runLiveSearch('');
            liveInput.focus();
        }

        function runLiveSearch(term) {
            const cards = grid.querySelectorAll('.sup-card[data-search]');
            const q = term.trim().toLowerCase();
            let visible = 0;

            cards.forEach(card => {
                const haystack = card.dataset.search || '';
                const match = !q || haystack.includes(q);
                card.classList.toggle('ls-hidden', !match);
                if (match) visible++;
            });

            /* No results message */
            noResults.style.display = (visible === 0 && cards.length > 0) ? 'block' : 'none';

            /* Update count */
            countNum.textContent    = visible;
            countPlural.textContent = visible !== 1 ? 's' : '';

            /* Hide pagination during live search */
            if (pagination) pagination.style.display = q ? 'none' : '';

            spinner.classList.remove('active');
        }

        liveInput.addEventListener('input', function () {
            updateClearBtn();
            spinner.classList.add('active');
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => runLiveSearch(this.value), 220);
        });

        /* init clear button state */
        updateClearBtn();

        /* ════════════════════════════════════════
           SCROLL REVEAL
        ════════════════════════════════════════ */
        const io = new IntersectionObserver(entries => {
            entries.forEach((e, i) => {
                if (e.isIntersecting) {
                    setTimeout(() => e.target.classList.add('visible'), i * 50);
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.07 });
        document.querySelectorAll('.reveal').forEach(el => io.observe(el));
    </script>

</x-client-layout>