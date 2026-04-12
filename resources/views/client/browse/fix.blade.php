<x-client-layout>

{{--
    resources/views/client/browse.blade.php
    Browse Suppliers — Bikol's Craft design system
    Grouped category filters using $cat->slug / $cat->name
    Supplier cards with cover photo, price, rating, "View Details"
    Variables:
        $suppliers   – paginated collection
        $cities      – collection of city strings
        $categories  – collection of objects with ->slug, ->name, ->group (optional)
--}}

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
    body { font-family: var(--font-body); background: var(--ivory); }

    /* ══════════════════════════
       PAGE HEADER
    ══════════════════════════ */
    .dash-header {
        background: var(--charcoal);
        padding: 1.75rem 2rem 1.5rem;
        position: relative; overflow: hidden;
    }
    .dash-header::before {
        content: ''; position: absolute; inset: 0;
        background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px);
        background-size: 20px 20px;
    }
    .dash-header::after {
        content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }
    .dh-inner {
        position: relative; z-index: 1;
        display: flex; align-items: flex-end; justify-content: space-between;
        flex-wrap: wrap; gap: 1rem;
    }
    .dh-eyebrow {
        font-size: 0.62rem; letter-spacing: 0.2em; text-transform: uppercase;
        color: var(--gold); font-weight: 500; margin-bottom: 0.4rem;
        display: flex; align-items: center; gap: 0.5rem; font-family: var(--font-body);
    }
    .dh-eyebrow::before { content: ''; display: block; width: 18px; height: 1px; background: var(--gold); }
    .dh-title { font-family: var(--font-display); font-size: clamp(1.2rem, 2.5vw, 1.8rem); font-weight: 700; color: var(--white); line-height: 1.15; }
    .dh-title em { color: var(--gold-light); font-style: italic; }
    .dh-sub { font-size: 0.78rem; color: rgba(255,255,255,0.42); margin-top: 0.3rem; font-family: var(--font-body); }
    .dh-count { display: inline-flex; align-items: center; gap: 5px; font-size: 0.68rem; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: var(--gold); background: rgba(201,168,76,0.12); border: 1px solid rgba(201,168,76,0.28); padding: 5px 14px; border-radius: 2px; white-space: nowrap; font-family: var(--font-body); align-self: flex-end; }

    /* ══════════════════════════
       TOOLBAR
    ══════════════════════════ */
    .toolbar {
        background: var(--white); border-bottom: 1px solid var(--border);
        padding: 0.75rem 2rem;
        display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;
        position: sticky; top: 0; z-index: 30;
    }

    /* Search */
    .search-wrap {
        flex: 1; min-width: 180px;
        display: flex; align-items: center;
        border: 1px solid var(--border-md); border-radius: 3px;
        background: var(--ivory); overflow: visible; position: relative;
        transition: border-color 0.18s, box-shadow 0.18s;
    }
    .search-wrap:focus-within { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,0.1); }
    .search-wrap svg { margin: 0 0.65rem; flex-shrink: 0; color: var(--warm-grey); opacity: 0.5; }
    .search-wrap input { flex: 1; border: none; background: transparent; padding: 0.58rem 2.2rem 0.58rem 0; font-size: 0.875rem; font-family: var(--font-body); color: var(--charcoal); outline: none; }
    .search-wrap input::placeholder { color: #B0A89E; }
    .search-spinner { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; border: 2px solid var(--border-md); border-top-color: var(--gold); border-radius: 50%; animation: spin .6s linear infinite; display: none; }
    .search-spinner.active { display: block; }
    @keyframes spin { to { transform: translateY(-50%) rotate(360deg); } }
    .search-clear { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--warm-grey); opacity: 0; display: flex; align-items: center; justify-content: center; padding: 2px; transition: opacity .15s; }
    .search-clear.visible { opacity: 0.5; }
    .search-clear:hover { opacity: 1; color: var(--charcoal); }

    /* Mobile filter button */
    .filter-open-btn { display: none; align-items: center; gap: 0.4rem; padding: 0.5rem 0.85rem; background: var(--white); color: var(--charcoal); border: 1px solid var(--border-md); border-radius: 3px; font-size: 0.75rem; font-weight: 500; letter-spacing: 0.04em; text-transform: uppercase; font-family: var(--font-body); cursor: pointer; white-space: nowrap; flex-shrink: 0; transition: border-color .18s, color .18s; }
    .filter-open-btn:hover { border-color: var(--gold); color: var(--gold-dark); }
    .filter-count-badge { background: var(--gold); color: var(--charcoal); font-size: 0.62rem; font-weight: 700; width: 17px; height: 17px; border-radius: 99px; display: inline-flex; align-items: center; justify-content: center; }

    /* Sort tabs */
    .sort-tabs { display: flex; gap: 0.3rem; flex-wrap: wrap; flex-shrink: 0; }
    .sort-tab { padding: 0.38rem 0.85rem; border: 1px solid var(--border-md); border-radius: 2px; font-size: 0.72rem; color: var(--warm-grey); background: var(--ivory); cursor: pointer; font-family: var(--font-body); transition: all 0.18s; white-space: nowrap; text-decoration: none; display: inline-block; }
    .sort-tab:hover { border-color: var(--gold); color: var(--gold-dark); }
    .sort-tab.active { background: var(--gold); border-color: var(--gold); color: var(--charcoal); font-weight: 600; }

    /* ══════════════════════════
       BODY LAYOUT
    ══════════════════════════ */
    .body-layout { display: grid; grid-template-columns: 256px 1fr; gap: 0; padding: 1.75rem 2rem 4rem; align-items: start; max-width: 1400px; margin: 0 auto; }

    /* ══════════════════════════
       SIDEBAR — GROUPED FILTERS
    ══════════════════════════ */
    .sidebar-col { margin-right: 1.5rem; }
    .sidebar-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; overflow: hidden; position: sticky; top: 57px; }

    /* Sidebar header */
    .sb-title-bar {
        padding: 0.85rem 1.25rem;
        background: var(--charcoal);
        border-bottom: 1px solid rgba(201,168,76,0.2);
        display: flex; align-items: center; justify-content: space-between;
        position: relative;
    }
    .sb-title-bar::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, var(--gold), transparent); }
    .sb-title { font-family: var(--font-display); font-size: 0.95rem; font-weight: 600; color: var(--white); }
    .sb-title-icon { color: var(--gold); opacity: 0.8; display: flex; align-items: center; }
    .active-count-badge { min-width: 18px; height: 18px; padding: 0 5px; background: var(--gold); color: var(--charcoal); font-size: 0.62rem; font-weight: 700; border-radius: 99px; display: none; align-items: center; justify-content: center; font-family: var(--font-body); }
    .active-count-badge.show { display: inline-flex; }

    /* Scrollable area */
    .sb-scroll { max-height: calc(100vh - 180px); overflow-y: auto; }
    .sb-scroll::-webkit-scrollbar { width: 3px; }
    .sb-scroll::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }
    .sb-scroll::-webkit-scrollbar-thumb:hover { background: var(--gold); }

    /* Location section */
    .sb-section { padding: 0.9rem 1.25rem; border-bottom: 0.5px solid var(--border); }
    .sb-section:last-child { border-bottom: none; }

    /* Group header (like "Popular Services") */
    .sb-group-head {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 0.65rem; cursor: pointer; user-select: none;
    }
    .sb-group-title {
        font-size: 0.72rem; font-weight: 700; letter-spacing: 0.05em;
        color: var(--charcoal); font-family: var(--font-body);
        text-transform: none;
    }
    .sb-group-chevron { color: var(--warm-grey); transition: transform 0.2s; display: flex; align-items: center; }
    .sb-group-chevron.open { transform: rotate(180deg); }

    /* Category divider line */
    .sb-divider { height: 0.5px; background: var(--border); margin: 0 0 0.8rem; }

    /* Collapsible body */
    .sb-group-body { overflow: hidden; transition: max-height 0.25s ease, opacity 0.2s ease; }
    .sb-group-body.collapsed { max-height: 0 !important; opacity: 0; }

    /* Check items */
    .check-item { display: flex; align-items: center; gap: 0.55rem; margin-bottom: 0.5rem; cursor: pointer; }
    .check-item:last-child { margin-bottom: 0; }
    .check-item input[type="checkbox"] { display: none; }
    .cb { width: 15px; height: 15px; border-radius: 3px; border: 1.5px solid var(--border-md); flex-shrink: 0; display: flex; align-items: center; justify-content: center; transition: all 0.15s; background: var(--white); }
    .check-item input:checked ~ .cb { background: var(--gold); border-color: var(--gold); }
    .check-item input:checked ~ .cb::after { content: ''; display: block; width: 3px; height: 6px; border: 1.8px solid var(--white); border-top: none; border-left: none; transform: rotate(45deg) translateY(-1px); }
    .check-label { font-size: 0.82rem; color: var(--warm-grey); font-family: var(--font-body); line-height: 1; transition: color 0.15s; }
    .check-item:hover .check-label { color: var(--charcoal); }
    .check-item input:checked ~ .check-label { color: var(--charcoal); font-weight: 500; }

    /* Location check items */
    .check-item-loc { display: flex; align-items: center; gap: 0.55rem; margin-bottom: 0.5rem; cursor: pointer; }
    .check-item-loc:last-child { margin-bottom: 0; }
    .check-item-loc input[type="checkbox"] { display: none; }

    /* Rating rows */
    .rating-row { display: flex; align-items: center; gap: 0.45rem; margin-bottom: 0.45rem; cursor: pointer; }
    .rating-row:last-child { margin-bottom: 0; }
    .rating-row input[type="radio"] { display: none; }
    .rdot { width: 13px; height: 13px; border-radius: 50%; border: 1.5px solid var(--border-md); flex-shrink: 0; display: flex; align-items: center; justify-content: center; transition: border-color 0.15s; }
    .rating-row input:checked ~ .rdot { border-color: var(--gold); }
    .rating-row input:checked ~ .rdot::after { content: ''; width: 5px; height: 5px; border-radius: 50%; background: var(--gold); display: block; }
    .star-row { display: flex; gap: 1px; }
    .sf { color: var(--gold); font-size: 12px; }
    .se { color: #D8D0C8; font-size: 12px; }
    .and-up { font-size: 0.72rem; color: var(--warm-grey); font-family: var(--font-body); }

    /* Availability toggle */
    .avail-toggle { display: flex; align-items: center; gap: 0.5rem; cursor: pointer; }
    .avail-toggle input[type="checkbox"] { display: none; }
    .toggle-track { width: 32px; height: 18px; border-radius: 99px; background: var(--border-md); position: relative; transition: background 0.2s; flex-shrink: 0; }
    .avail-toggle input:checked ~ .toggle-track { background: var(--gold); }
    .toggle-thumb { position: absolute; top: 2px; left: 2px; width: 14px; height: 14px; border-radius: 50%; background: var(--white); transition: left 0.2s; box-shadow: 0 1px 4px rgba(0,0,0,0.15); }
    .avail-toggle input:checked ~ .toggle-track .toggle-thumb { left: 16px; }
    .avail-label { font-size: 0.8rem; color: var(--warm-grey); font-family: var(--font-body); }

    /* Apply / Reset buttons */
    .sb-actions { padding: 0.85rem 1.25rem; display: flex; gap: 0.5rem; border-top: 1px solid var(--border); }
    .apply-btn { flex: 1; padding: 0.6rem; background: var(--gold); color: var(--charcoal); border: none; border-radius: 3px; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase; cursor: pointer; font-family: var(--font-body); transition: background 0.18s; }
    .apply-btn:hover { background: var(--gold-light); }
    .reset-btn { padding: 0.6rem 0.85rem; background: transparent; color: var(--warm-grey); border: 1px solid var(--border); border-radius: 3px; font-size: 0.72rem; cursor: pointer; font-family: var(--font-body); transition: border-color 0.2s, color 0.2s; text-align: center; text-decoration: none; display: inline-flex; align-items: center; white-space: nowrap; }
    .reset-btn:hover { border-color: var(--gold); color: var(--gold-dark); }

    /* ══════════════════════════
       CONTENT AREA
    ══════════════════════════ */
    .content-area { min-width: 0; }
    .result-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; flex-wrap: wrap; gap: 0.5rem; }
    .result-count { font-size: 0.78rem; color: var(--warm-grey); font-family: var(--font-body); }
    .result-count strong { color: var(--charcoal); font-weight: 600; }
    .content-title { font-family: var(--font-display); font-size: 1.3rem; font-weight: 600; color: var(--charcoal); }
    .content-title-divider { height: 1px; background: var(--border); margin: 0.5rem 0 1.25rem; }

    /* ══════════════════════════
       SUPPLIER GRID
    ══════════════════════════ */
    .sup-grid { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 1.1rem; }
    @media (max-width: 1200px) { .sup-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 560px)  { .sup-grid { grid-template-columns: 1fr; } }

    /* ── SUPPLIER CARD ── */
    .sup-card { background: var(--white); border: 1px solid var(--border); border-radius: 8px; overflow: hidden; position: relative; transition: box-shadow 0.22s, transform 0.22s, border-color 0.22s; display: flex; flex-direction: column; }
    .sup-card:hover { box-shadow: 0 10px 32px rgba(30,27,24,0.10); transform: translateY(-3px); border-color: rgba(201,168,76,0.3); }
    .sup-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; z-index: 2; background: linear-gradient(90deg, var(--gold), var(--blush-deep)); transform: scaleX(0); transform-origin: left; transition: transform 0.3s ease; }
    .sup-card:hover::before { transform: scaleX(1); }

    /* Cover photo */
    .card-cover { width: 100%; aspect-ratio: 16/9; overflow: hidden; position: relative; background: #E0D8D0; flex-shrink: 0; }
    .card-cover img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; display: block; }
    .sup-card:hover .card-cover img { transform: scale(1.04); }
    /* Fallback when no cover image */
    .cover-fallback { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #1E1B18 0%, #374151 60%, #2D2A27 100%); position: relative; }
    .cover-fallback-dots { position: absolute; inset: 0; opacity: 0.07; background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 16px 16px; }
    .cover-fallback-initials { font-family: var(--font-display); font-size: 2rem; font-weight: 700; color: var(--gold); position: relative; z-index: 1; }
    /* Category badge on cover */
    .cover-badge { position: absolute; top: 10px; left: 12px; z-index: 2; font-size: 0.6rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: var(--white); background: rgba(30,27,24,0.72); border: 1px solid rgba(255,255,255,0.2); padding: 3px 9px; border-radius: 99px; backdrop-filter: blur(4px); font-family: var(--font-body); }
    /* Availability dot on cover */
    .cover-avail { position: absolute; top: 10px; right: 12px; z-index: 2; display: flex; align-items: center; gap: 4px; font-size: 0.58rem; font-weight: 700; text-transform: uppercase; padding: 3px 8px; border-radius: 99px; font-family: var(--font-body); backdrop-filter: blur(4px); }
    .cover-avail.yes { background: rgba(15,80,41,0.85); color: #86EFAC; border: 1px solid rgba(134,239,172,0.3); }
    .cover-avail.no  { background: rgba(120,53,15,0.85); color: #FCD34D; border: 1px solid rgba(252,211,77,0.3); }
    .avail-dot { width: 5px; height: 5px; border-radius: 50%; }
    .cover-avail.yes .avail-dot { background: #22C55E; }
    .cover-avail.no  .avail-dot { background: #F59E0B; }

    /* Card body */
    .card-body { padding: 1rem 1.1rem 1.1rem; flex: 1; display: flex; flex-direction: column; }
    .c-name { font-family: var(--font-display); font-size: 1rem; font-weight: 600; color: var(--charcoal); line-height: 1.25; margin-bottom: 3px; }
    .c-meta { font-size: 0.78rem; color: var(--warm-grey); margin-bottom: 8px; font-family: var(--font-body); display: flex; align-items: center; gap: 0.35rem; flex-wrap: wrap; }
    .c-meta-sep { opacity: 0.4; }
    .c-price-inline { font-weight: 600; color: var(--charcoal); }

    /* Rating row */
    .c-rating-row { display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.9rem; }
    .c-stars { display: flex; gap: 1px; }
    .c-stars .sf { color: var(--gold); font-size: 13px; }
    .c-stars .se { color: #D8D0C8; font-size: 13px; }
    .c-rating-val { font-size: 0.8rem; font-weight: 600; color: var(--charcoal); font-family: var(--font-body); }

    /* Location */
    .c-location { display: flex; align-items: center; gap: 0.25rem; font-size: 0.72rem; color: var(--warm-grey); margin-bottom: 0.9rem; font-family: var(--font-body); }
    .c-location svg { color: var(--gold-dark); opacity: 0.7; flex-shrink: 0; }

    /* View Details button — gold, matches mockup */
    .view-btn {
        display: block; width: 100%; padding: 0.65rem;
        background: var(--gold); color: var(--charcoal);
        border: none; border-radius: 4px;
        font-size: 0.78rem; font-weight: 600; letter-spacing: 0.04em;
        text-transform: uppercase; text-align: center; text-decoration: none;
        font-family: var(--font-body);
        transition: background 0.18s, transform 0.15s;
        margin-top: auto; cursor: pointer;
    }
    .view-btn:hover { background: var(--gold-light); transform: translateY(-1px); }

    /* ── EMPTY STATE ── */
    .empty-state { grid-column: 1 / -1; text-align: center; padding: 4rem 2rem; background: var(--white); border: 1px solid var(--border); border-radius: 8px; }
    .empty-icon { width: 56px; height: 56px; margin: 0 auto 1rem; background: var(--ivory); border: 1px solid var(--border-md); border-radius: 4px; display: flex; align-items: center; justify-content: center; }
    .empty-icon svg { color: var(--gold); opacity: 0.4; }
    .empty-state h3 { font-family: var(--font-display); font-size: 1.1rem; color: var(--charcoal); margin-bottom: 0.4rem; }
    .empty-state p { font-size: 0.83rem; color: var(--warm-grey); font-family: var(--font-body); }

    /* Live search no-results */
    .live-no-results { display: none; grid-column: 1 / -1; text-align: center; padding: 3rem 2rem; background: var(--white); border: 1px solid var(--border); border-radius: 8px; }
    .live-no-results svg { margin: 0 auto 0.75rem; display: block; opacity: .3; color: var(--gold-dark); }
    .live-no-results h3 { font-family: var(--font-display); font-size: 1.1rem; color: var(--charcoal); margin-bottom: .3rem; }
    .live-no-results p { font-size: 0.83rem; color: var(--warm-grey); font-family: var(--font-body); }

    /* ── PAGINATION ── */
    .pagination { display: flex; align-items: center; justify-content: center; gap: 0.3rem; margin-top: 2rem; flex-wrap: wrap; }
    .page-btn { width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; border: 1px solid var(--border); border-radius: 3px; font-size: 0.78rem; color: var(--warm-grey); cursor: pointer; background: var(--white); font-family: var(--font-body); transition: all 0.18s; text-decoration: none; }
    .page-btn:hover { border-color: var(--gold); color: var(--gold-dark); }
    .page-btn.active { background: var(--gold); border-color: var(--gold); color: var(--charcoal); font-weight: 700; }
    .page-btn.disabled { opacity: 0.32; pointer-events: none; }

    /* ── HIDDEN DURING LIVE SEARCH ── */
    .sup-card.ls-hidden { display: none !important; }

    /* ── REVEAL ── */
    .reveal { opacity: 0; transform: translateY(14px); transition: opacity 0.48s ease, transform 0.48s ease; }
    .reveal.visible { opacity: 1; transform: none; }

    /* ══════════════════════════
       MOBILE DRAWER
    ══════════════════════════ */
    .drawer-overlay { display: none; position: fixed; inset: 0; z-index: 1000; background: rgba(30,27,24,0.5); backdrop-filter: blur(2px); }
    .drawer-overlay.open { display: block; }
    .filter-drawer { position: fixed; top: 0; left: 0; bottom: 0; width: min(300px, 88vw); background: var(--white); z-index: 1001; display: flex; flex-direction: column; transform: translateX(-100%); transition: transform .28s cubic-bezier(.4,0,.2,1); overflow: hidden; }
    .filter-drawer.open { transform: translateX(0); }
    .drawer-head { display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.25rem; background: var(--charcoal); flex-shrink: 0; position: relative; }
    .drawer-head::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, var(--gold), transparent); }
    .drawer-head-title { font-family: var(--font-display); font-size: 1rem; font-weight: 600; color: var(--white); }
    .drawer-close { width: 30px; height: 30px; border-radius: 3px; background: rgba(201,168,76,0.1); border: 1px solid rgba(201,168,76,0.2); display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--gold); transition: background .18s; }
    .drawer-close:hover { background: rgba(201,168,76,0.22); }
    .drawer-body { flex: 1; overflow-y: auto; }
    .drawer-body::-webkit-scrollbar { width: 3px; }
    .drawer-body::-webkit-scrollbar-thumb { background: var(--border-md); }
    .drawer-footer { border-top: 1px solid var(--border); padding: 0.85rem 1.25rem; background: var(--white); flex-shrink: 0; display: flex; gap: 0.5rem; }
    .drawer-apply-btn { flex: 1; padding: 0.65rem; background: var(--gold); color: var(--charcoal); border: none; border-radius: 3px; font-size: 0.78rem; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; cursor: pointer; font-family: var(--font-body); transition: background .18s; }
    .drawer-apply-btn:hover { background: var(--gold-light); }

    /* ══════════════════════════
       RESPONSIVE
    ══════════════════════════ */
    @media (max-width: 900px) {
        .sidebar-col { display: none; }
        .filter-open-btn { display: flex; }
        .body-layout { grid-template-columns: 1fr; padding: 1.25rem 1rem 3rem; }
        .sort-tabs { display: none; }
        .toolbar { padding: 0.7rem 1rem; }
    }
    @media (max-width: 540px) {
        .dh-count { display: none; }
        .dash-header { padding: 1.4rem 1rem 1.2rem; }
        .sup-grid { grid-template-columns: 1fr; }
    }
</style>

{{-- ════════════════════ MOBILE DRAWER ════════════════════ --}}
<div class="drawer-overlay" id="drawer-overlay" onclick="closeDrawer()"></div>
<div class="filter-drawer" id="filter-drawer">
    <div class="drawer-head">
        <span class="drawer-head-title">Filter by Category</span>
        <button class="drawer-close" onclick="closeDrawer()">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
    </div>
    <div class="drawer-body">
        <form method="GET" action="{{ request()->url() }}" id="drawer-filter-form">
            @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif
            @if(request('sort'))<input type="hidden" name="sort" value="{{ request('sort') }}">@endif

            {{-- Location --}}
            @if(isset($cities) && $cities->count())
            <div class="sb-section">
                <div class="sb-group-head" onclick="toggleGroup(this)">
                    <span class="sb-group-title">Location</span>
                    <span class="sb-group-chevron open"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg></span>
                </div>
                <div class="sb-divider"></div>
                <div class="sb-group-body">
                    @php $selCities = (array) request('city', []); @endphp
                    @foreach($cities->take(8) as $city)
                    <label class="check-item">
                        <input type="checkbox" name="city[]" value="{{ $city }}" {{ in_array($city, $selCities) ? 'checked' : '' }}>
                        <span class="cb"></span>
                        <span class="check-label">{{ $city }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Categories grouped --}}
            @if(isset($categories) && $categories->count())
            @php
                $grouped = $categories->groupBy('group');
                $selCats = (array) request('category', []);
            @endphp
            @foreach($grouped as $groupName => $cats)
            <div class="sb-section">
                <div class="sb-group-head" onclick="toggleGroup(this)">
                    <span class="sb-group-title">{{ $groupName ?: 'Categories' }}</span>
                    <span class="sb-group-chevron open"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg></span>
                </div>
                <div class="sb-divider"></div>
                <div class="sb-group-body">
                    @foreach($cats as $cat)
                    <label class="check-item">
                        <input type="checkbox" name="category[]" value="{{ $cat->slug }}" {{ in_array($cat->slug, $selCats) ? 'checked' : '' }}>
                        <span class="cb"></span>
                        <span class="check-label">{{ $cat->name }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            @endforeach
            @endif
        </form>
    </div>
    <div class="drawer-footer">
        <a href="{{ request()->url() }}" class="reset-btn">Reset</a>
        <button class="drawer-apply-btn" onclick="document.getElementById('drawer-filter-form').submit()">Apply Filters</button>
    </div>
</div>

{{-- ════════════════════ PAGE ════════════════════ --}}
<div class="dash-header">
    <div class="dh-inner">
        <div>
            <div class="dh-eyebrow">Client Dashboard</div>
            <div class="dh-title">Browse <em>Suppliers</em></div>
            <div class="dh-sub">Find verified event professionals across Bikol and beyond.</div>
        </div>
        <span class="dh-count" id="total-count-badge">
            {{ $suppliers instanceof \Illuminate\Pagination\LengthAwarePaginator ? $suppliers->total() : $suppliers->count() }}
            supplier{{ ($suppliers instanceof \Illuminate\Pagination\LengthAwarePaginator ? $suppliers->total() : $suppliers->count()) !== 1 ? 's' : '' }}
        </span>
    </div>
</div>

{{-- TOOLBAR --}}
<div class="toolbar">
    <button class="filter-open-btn" id="filter-open-btn" onclick="openDrawer()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/></svg>
        Filters
        @php $activeFilters = count((array)request('city',[])) + count((array)request('category',[])) + (request('rating') ? 1 : 0) + (request('available_only') ? 1 : 0); @endphp
        @if($activeFilters)<span class="filter-count-badge">{{ $activeFilters }}</span>@endif
    </button>

    <form method="GET" action="{{ request()->url() }}" id="search-form" style="display:contents;">
        @foreach((array)request('city',[]) as $c)<input type="hidden" name="city[]" value="{{ $c }}">@endforeach
        @foreach((array)request('category',[]) as $c)<input type="hidden" name="category[]" value="{{ $c }}">@endforeach
        @if(request('rating'))<input type="hidden" name="rating" value="{{ request('rating') }}">@endif
        @if(request('available_only'))<input type="hidden" name="available_only" value="1">@endif

        <div class="search-wrap">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
            <input type="text" name="search" id="live-search-input"
                   value="{{ request('search') }}"
                   placeholder="Search by name, category, or location…"
                   autocomplete="off">
            <div class="search-spinner" id="search-spinner"></div>
            <button type="button" class="search-clear" id="search-clear" onclick="clearSearch()">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
    </form>

    <div class="sort-tabs">
        @foreach(['popular'=>'Popular','rating'=>'Highest Rated','price'=>'Lowest Price','latest'=>'Latest'] as $key=>$label)
            <a href="{{ request()->fullUrlWithQuery(['sort'=>$key]) }}"
               class="sort-tab {{ request('sort','popular')===$key ? 'active' : '' }}">{{ $label }}</a>
        @endforeach
    </div>
</div>

{{-- BODY --}}
<div class="body-layout">

    {{-- ═══════════════════ DESKTOP SIDEBAR ═══════════════════ --}}
    <div class="sidebar-col">
        <div class="sidebar-card">
            <div class="sb-title-bar">
                <span class="sb-title">Filter by Category</span>
                <div style="display:flex;align-items:center;gap:0.5rem;">
                    <span class="active-count-badge {{ $activeFilters ? 'show' : '' }}">{{ $activeFilters ?: '' }}</span>
                    <span class="sb-title-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/></svg>
                    </span>
                </div>
            </div>

            <div class="sb-scroll">
                <form method="GET" action="{{ request()->url() }}" id="filter-form">
                    @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif
                    @if(request('sort'))<input type="hidden" name="sort" value="{{ request('sort') }}">@endif

                    {{-- Location --}}
                    @if(isset($cities) && $cities->count())
                    <div class="sb-section">
                        <div class="sb-group-head" onclick="toggleGroup(this)">
                            <span class="sb-group-title">Location</span>
                            <span class="sb-group-chevron open"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg></span>
                        </div>
                        <div class="sb-divider"></div>
                        <div class="sb-group-body">
                            @php $selCities = (array) request('city', []); @endphp
                            @foreach($cities->take(8) as $city)
                            <label class="check-item">
                                <input type="checkbox" name="city[]" value="{{ $city }}"
                                       onchange="this.form.submit()"
                                       {{ in_array($city, $selCities) ? 'checked' : '' }}>
                                <span class="cb"></span>
                                <span class="check-label">{{ $city }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- ── GROUPED CATEGORIES ── --}}
                    @if(isset($categories) && $categories->count())
                    @php
                        $grouped = $categories->groupBy('group');
                        $selCats = (array) request('category', []);
                    @endphp
                    @foreach($grouped as $groupName => $cats)
                    <div class="sb-section">
                        <div class="sb-group-head" onclick="toggleGroup(this)">
                            <span class="sb-group-title">{{ $groupName ?: 'Services' }}</span>
                            <span class="sb-group-chevron open">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                            </span>
                        </div>
                        <div class="sb-divider"></div>
                        <div class="sb-group-body">
                            @foreach($cats as $cat)
                            <label class="check-item">
                                <input type="checkbox" name="category[]" value="{{ $cat->slug }}"
                                       onchange="this.form.submit()"
                                       {{ in_array($cat->slug, $selCats) ? 'checked' : '' }}>
                                <span class="cb"></span>
                                <span class="check-label">{{ $cat->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    @endif

                    {{-- Rating --}}
                    <div class="sb-section">
                        <div class="sb-group-head" onclick="toggleGroup(this)">
                            <span class="sb-group-title">Rating</span>
                            <span class="sb-group-chevron open"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg></span>
                        </div>
                        <div class="sb-divider"></div>
                        <div class="sb-group-body">
                            @foreach([5,4,3,2] as $r)
                            <label class="rating-row">
                                <input type="radio" name="rating" value="{{ $r }}" onchange="this.form.submit()" {{ request('rating')==$r ? 'checked' : '' }}>
                                <span class="rdot"></span>
                                <div class="star-row">@for($s=1;$s<=5;$s++)<span class="{{ $s<=$r ? 'sf' : 'se' }}">★</span>@endfor</div>
                                @if($r < 5)<span class="and-up">& Up</span>@endif
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Availability --}}
                    <div class="sb-section" style="border-bottom:none;">
                        <div class="sb-group-head" onclick="toggleGroup(this)">
                            <span class="sb-group-title">Availability</span>
                            <span class="sb-group-chevron open"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg></span>
                        </div>
                        <div class="sb-divider"></div>
                        <div class="sb-group-body">
                            <label class="avail-toggle">
                                <input type="checkbox" name="available_only" value="1" onchange="this.form.submit()" {{ request('available_only') ? 'checked' : '' }}>
                                <span class="toggle-track"><span class="toggle-thumb"></span></span>
                                <span class="avail-label">Available only</span>
                            </label>
                        </div>
                    </div>

                </form>
            </div>

            {{-- Apply / Reset --}}
            <div class="sb-actions">
                @if($activeFilters)
                    <a href="{{ request()->url() }}{{ request('search') ? '?search='.urlencode(request('search')) : '' }}" class="reset-btn">Reset</a>
                @endif
                <button class="apply-btn" onclick="document.getElementById('filter-form').submit()">Apply Filters</button>
            </div>
        </div>
    </div>

    {{-- ═══════════════════ CONTENT ═══════════════════ --}}
    <div class="content-area">

        <div class="result-row">
            <div class="content-title">Top Suppliers</div>
            <div class="result-count">
                <strong id="result-count-num">{{ $suppliers instanceof \Illuminate\Pagination\LengthAwarePaginator ? $suppliers->total() : $suppliers->count() }}</strong>
                supplier<span id="result-count-plural">{{ ($suppliers instanceof \Illuminate\Pagination\LengthAwarePaginator ? $suppliers->total() : $suppliers->count()) !== 1 ? 's' : '' }}</span> found
            </div>
        </div>
        <div class="content-title-divider"></div>

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
                 ]))) }}">

                {{-- Cover photo --}}
                <div class="card-cover">
                    @if($supplier->cover_photo ?? $supplier->photo ?? null)
                        <img src="{{ asset('storage/'.($supplier->cover_photo ?? $supplier->photo)) }}"
                             alt="{{ $supplier->business_name }}">
                    @else
                        <div class="cover-fallback">
                            <div class="cover-fallback-dots"></div>
                            <span class="cover-fallback-initials">
                                {{ strtoupper(substr($supplier->business_name ?? $supplier->first_name ?? 'S', 0, 2)) }}
                            </span>
                        </div>
                    @endif

                    @if($supplier->category ?? null)
                        <span class="cover-badge">{{ $supplier->category }}</span>
                    @endif

                    @if($supplier->is_available ?? false)
                        <span class="cover-avail yes"><span class="avail-dot"></span>Available</span>
                    @else
                        <span class="cover-avail no"><span class="avail-dot"></span>Unavailable</span>
                    @endif
                </div>

                {{-- Body --}}
                <div class="card-body">
                    <div class="c-name">{{ $supplier->business_name ?? $supplier->name }}</div>

                    <div class="c-meta">
                        @if($supplier->category ?? null)
                            <span>{{ $supplier->category }}</span>
                        @endif
                        @if($supplier->price ?? null)
                            <span class="c-meta-sep">|</span>
                            <span>Starting at <span class="c-price-inline">₱{{ number_format($supplier->price, 0) }}</span></span>
                        @endif
                    </div>

                    @if($supplier->rating)
                    <div class="c-rating-row">
                        <div class="c-stars">
                            @for($s=1;$s<=5;$s++)
                                <span class="{{ $s <= round($supplier->rating) ? 'sf' : 'se' }}">★</span>
                            @endfor
                        </div>
                        <span class="c-rating-val">{{ number_format($supplier->rating, 1) }}</span>
                    </div>
                    @endif

                    @if($supplier->city || $supplier->province)
                    <div class="c-location">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        {{ collect([$supplier->city ?? null, $supplier->province ?? null])->filter()->implode(', ') }}
                    </div>
                    @endif

                    <a href="{{ route('client.suppliers.show', ['id' => $supplier->id]) }}" class="view-btn">
                        View Details
                    </a>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg></div>
                <h3>No suppliers found</h3>
                <p>Try adjusting your filters or search terms.</p>
            </div>
            @endforelse

            <div class="live-no-results" id="live-no-results">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                <h3>No results found</h3>
                <p>Try a different keyword or clear the search.</p>
            </div>
        </div>

        {{-- Pagination --}}
        @if($suppliers instanceof \Illuminate\Pagination\LengthAwarePaginator && $suppliers->hasPages())
        <div class="pagination" id="pagination-wrap">
            <a href="{{ $suppliers->previousPageUrl() ?? '#' }}" class="page-btn {{ $suppliers->onFirstPage() ? 'disabled' : '' }}">‹</a>
            @foreach($suppliers->getUrlRange(1, $suppliers->lastPage()) as $page => $url)
                <a href="{{ $url }}" class="page-btn {{ $page === $suppliers->currentPage() ? 'active' : '' }}">{{ $page }}</a>
            @endforeach
            <a href="{{ $suppliers->nextPageUrl() ?? '#' }}" class="page-btn {{ !$suppliers->hasMorePages() ? 'disabled' : '' }}">›</a>
        </div>
        @endif
    </div>

</div>{{-- end body-layout --}}

<script>
/* ── DRAWER ── */
function openDrawer() { document.getElementById('filter-drawer').classList.add('open'); document.getElementById('drawer-overlay').classList.add('open'); document.body.style.overflow = 'hidden'; }
function closeDrawer() { document.getElementById('filter-drawer').classList.remove('open'); document.getElementById('drawer-overlay').classList.remove('open'); document.body.style.overflow = ''; }
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeDrawer(); });

/* ── COLLAPSIBLE GROUPS ── */
function toggleGroup(head) {
    const body     = head.nextElementSibling.nextElementSibling; /* skip .sb-divider */
    const chevron  = head.querySelector('.sb-group-chevron');
    const isOpen   = !chevron.classList.contains('open');

    if (!isOpen) {
        /* collapse */
        body.style.maxHeight = body.scrollHeight + 'px';
        requestAnimationFrame(() => {
            body.style.maxHeight = '0';
            body.style.opacity   = '0';
        });
        chevron.classList.remove('open');
        body.classList.add('collapsed');
    } else {
        /* expand */
        body.classList.remove('collapsed');
        body.style.maxHeight = 'none';
        body.style.opacity   = '1';
        chevron.classList.add('open');
    }
}
/* Set initial max-height so CSS transition works */
document.querySelectorAll('.sb-group-body').forEach(el => {
    el.style.maxHeight = 'none';
});

/* ── LIVE SEARCH ── */
const liveInput   = document.getElementById('live-search-input');
const clearBtn    = document.getElementById('search-clear');
const spinner     = document.getElementById('search-spinner');
const noResults   = document.getElementById('live-no-results');
const countNum    = document.getElementById('result-count-num');
const countPlural = document.getElementById('result-count-plural');
const pagination  = document.getElementById('pagination-wrap');
let searchTimer   = null;

function updateClearBtn() { clearBtn.classList.toggle('visible', liveInput.value.length > 0); }

function clearSearch() { liveInput.value = ''; updateClearBtn(); runLiveSearch(''); liveInput.focus(); }

function runLiveSearch(term) {
    const cards = document.querySelectorAll('#sup-grid .sup-card[data-search]');
    const q     = term.trim().toLowerCase();
    let visible = 0;

    cards.forEach(card => {
        const match = !q || (card.dataset.search || '').includes(q);
        card.classList.toggle('ls-hidden', !match);
        if (match) visible++;
    });

    noResults.style.display = (visible === 0 && cards.length > 0) ? 'block' : 'none';
    countNum.textContent    = visible;
    countPlural.textContent = visible !== 1 ? 's' : '';
    if (pagination) pagination.style.display = q ? 'none' : '';
    spinner.classList.remove('active');
}

liveInput.addEventListener('input', function () {
    updateClearBtn();
    spinner.classList.add('active');
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => runLiveSearch(this.value), 200);
});

updateClearBtn();

/* ── SCROLL REVEAL ── */
const io = new IntersectionObserver(entries => {
    entries.forEach((e, i) => {
        if (e.isIntersecting) { setTimeout(() => e.target.classList.add('visible'), i * 50); io.unobserve(e.target); }
    });
}, { threshold: 0.06 });
document.querySelectorAll('.reveal').forEach(el => io.observe(el));
</script>

</x-client-layout>