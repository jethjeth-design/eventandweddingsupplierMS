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
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: var(--font-body); background: var(--ivory); color: var(--charcoal); }

    /* ── PAGE WRAP ── */
    .sp-wrap { max-width: 1000px; margin: 0 auto; padding: 2rem 1.25rem 6rem; }

    /* ══════════════════════════════
       SUPPLIER HERO CARD
    ══════════════════════════════ */
    .sp-hero {
        background: var(--charcoal);
        border-radius: 16px;
        padding: 2rem 2rem 1.75rem;
        margin-bottom: 1.75rem;
        position: relative; overflow: hidden;
    }
    .sp-hero::before {
        content: '';
        position: absolute; inset: 0;
        background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px);
        background-size: 20px 20px; pointer-events: none;
    }
    .sp-hero::after {
        content: '';
        position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }

    .sp-hero-inner {
        position: relative; z-index: 1;
        display: flex; align-items: flex-start; gap: 1.5rem; flex-wrap: wrap;
    }

    .sp-avatar {
        width: 96px; height: 96px; border-radius: 50%; flex-shrink: 0;
        border: 3px solid rgba(201,168,76,0.35);
        overflow: hidden; background: var(--charcoal);
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display); font-size: 1.6rem; font-weight: 700;
        color: var(--gold);
    }
    .sp-avatar img { width: 100%; height: 100%; object-fit: cover; }

    .sp-hero-info { flex: 1; min-width: 0; }
    .sp-eyebrow {
        font-size: 0.6rem; letter-spacing: 0.2em; text-transform: uppercase;
        color: var(--gold); font-weight: 500; margin-bottom: 0.3rem;
        display: flex; align-items: center; gap: 0.4rem; font-family: var(--font-body);
    }
    .sp-eyebrow::before { content: ''; width: 12px; height: 1px; background: var(--gold); }
    .sp-business-name {
        font-family: var(--font-display);
        font-size: clamp(1.2rem, 2.5vw, 1.7rem);
        font-weight: 700; color: var(--white); line-height: 1.15;
        margin-bottom: 0.25rem;
    }
    .sp-tagline { font-size: 0.8rem; color: rgba(255,255,255,0.45); font-style: italic; margin-bottom: 0.85rem; }

    .sp-meta-chips { display: flex; flex-wrap: wrap; gap: 0.5rem; }
    .sp-chip {
        display: inline-flex; align-items: center; gap: 0.35rem;
        padding: 4px 10px; border-radius: 999px; font-size: 0.7rem; font-weight: 500;
        background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.72);
        border: 1px solid rgba(255,255,255,0.14); font-family: var(--font-body);
    }
    .sp-chip svg { width: 12px; height: 12px; }

    .sp-bio {
        margin-top: 1rem; padding-top: 1rem;
        border-top: 1px solid rgba(201,168,76,0.15);
        font-size: 0.8rem; color: rgba(255,255,255,0.5);
        line-height: 1.65; max-width: 680px;
    }

    /* ══════════════════════════════
       SECTION HEADER (shared)
    ══════════════════════════════ */
    .sp-section-head {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1rem;
    }
    .sp-section-label {
        font-size: 0.62rem; font-weight: 700; letter-spacing: 0.14em;
        text-transform: uppercase; color: var(--gold-dark);
        display: flex; align-items: center; gap: 0.4rem;
    }
    .sp-section-label::after {
        content: ''; width: 30px; height: 1px;
        background: linear-gradient(90deg, var(--gold), transparent);
    }
    .sp-pkg-count {
        font-size: 0.65rem; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase;
        color: var(--gold-dark); background: rgba(201,168,76,0.1);
        border: 1px solid rgba(201,168,76,0.25); padding: 3px 10px; border-radius: 999px;
        font-family: var(--font-body);
    }

    /* ══════════════════════════════
       PACKAGES — NEW LAYOUT
       Left sidebar list + Right detail panel
    ══════════════════════════════ */
    .sp-pkg-layout {
        display: grid;
        grid-template-columns: 260px 1fr;
        gap: 1rem;
        align-items: start;
        margin-bottom: 2.5rem;
    }

    /* Left: package list */
    .sp-pkg-sidebar {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        position: sticky;
        top: 1rem;
    }
    .sp-pkg-sidebar-head {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid var(--border);
        font-size: 0.6rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase;
        color: #C0B8B0; font-family: var(--font-body);
    }
    .sp-pkg-list-item {
        display: flex; align-items: center; gap: 0.65rem;
        padding: 0.85rem 1rem;
        border-bottom: 1px solid var(--border);
        cursor: pointer;
        transition: background 0.15s;
        position: relative;
    }
    .sp-pkg-list-item:last-child { border-bottom: none; }
    .sp-pkg-list-item:hover { background: var(--ivory); }
    .sp-pkg-list-item.active { background: rgba(201,168,76,0.06); }
    .sp-pkg-list-item.active::before {
        content: '';
        position: absolute; left: 0; top: 0; bottom: 0; width: 3px;
        background: var(--gold); border-radius: 0 2px 2px 0;
    }
    .sp-pkg-list-dot {
        width: 8px; height: 8px; border-radius: 50%;
        background: var(--border-md); flex-shrink: 0;
        transition: background 0.15s;
    }
    .sp-pkg-list-item.active .sp-pkg-list-dot { background: var(--gold); }
    .sp-pkg-list-name {
        font-size: 0.82rem; font-weight: 600; color: var(--charcoal); line-height: 1.2;
        font-family: var(--font-body);
    }
    .sp-pkg-list-price {
        font-size: 0.7rem; color: var(--gold-dark); font-weight: 700;
        margin-left: auto; flex-shrink: 0; font-family: var(--font-display);
    }

    /* Right: detail panel */
    .sp-pkg-detail { display: flex; flex-direction: column; gap: 0; }

    .sp-pkg-panel {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        display: none;
        animation: fadeIn 0.22s ease;
    }
    .sp-pkg-panel.active { display: flex; flex-direction: column; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: none; } }

    /* Gold accent top */
    .sp-pkg-panel::before {
        content: '';
        display: block; height: 2px;
        background: linear-gradient(90deg, var(--gold), var(--blush-deep));
    }

    .sp-pkg-panel-body { padding: 1.5rem 1.5rem 1.25rem; }

    .sp-pkg-panel-name {
        font-family: var(--font-display); font-size: 1.25rem; font-weight: 700;
        color: var(--charcoal); line-height: 1.2; margin-bottom: 0.5rem;
    }
    .sp-pkg-panel-price {
        font-family: var(--font-display); font-size: 1.55rem; font-weight: 700;
        color: var(--gold-dark); margin-bottom: 0.85rem;
    }

    .sp-pkg-panel-chips { display: flex; flex-wrap: wrap; gap: 0.4rem; margin-bottom: 1rem; }
    .sp-pkg-chip {
        display: inline-flex; align-items: center; gap: 0.25rem;
        font-size: 0.62rem; font-weight: 600; letter-spacing: 0.03em; text-transform: uppercase;
        padding: 3px 10px; border-radius: 999px;
        background: rgba(201,168,76,0.09); color: var(--gold-dark);
        border: 1px solid rgba(201,168,76,0.22); font-family: var(--font-body);
    }
    .sp-pkg-chip svg { width: 9px; height: 9px; }

    .sp-pkg-panel-desc {
        font-size: 0.82rem; color: var(--warm-grey); line-height: 1.65;
        padding-bottom: 1rem; border-bottom: 1px solid var(--border);
        margin-bottom: 1rem;
    }

    /* Inclusions inside panel — 2-col grid */
    .sp-incl-label {
        font-size: 0.58rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase;
        color: #C0B8B0; margin-bottom: 0.65rem; font-family: var(--font-body);
        display: flex; align-items: center; gap: 0.35rem;
    }
    .sp-incl-label svg { width: 10px; height: 10px; color: var(--gold-dark); }
    .sp-incl-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.4rem 1rem;
    }
    .sp-incl-item {
        display: flex; align-items: center; gap: 0.45rem;
        font-size: 0.78rem; color: var(--charcoal); font-family: var(--font-body);
    }
    .sp-incl-dot {
        width: 5px; height: 5px; border-radius: 50%; background: var(--gold);
        flex-shrink: 0; box-shadow: 0 0 0 2px rgba(201,168,76,0.18);
    }

    /* Panel footer */
    .sp-pkg-panel-foot {
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--border);
        background: var(--ivory);
    }
    .btn-book {
        width: 100%;
        display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem;
        padding: 0.7rem 1rem;
        background: var(--charcoal); color: var(--white);
        border: none; border-radius: 6px;
        font-family: var(--font-body); font-size: 0.78rem; font-weight: 600;
        letter-spacing: 0.04em; text-transform: uppercase;
        cursor: pointer; position: relative; overflow: hidden;
        transition: transform 0.15s;
    }
    .btn-book::after {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, var(--gold-dark), var(--gold));
        opacity: 0; transition: opacity 0.25s;
    }
    .btn-book:hover::after { opacity: 1; }
    .btn-book:hover { transform: translateY(-1px); }
    .btn-book span, .btn-book svg { position: relative; z-index: 1; }
    .btn-book svg { width: 13px; height: 13px; }

    /* Empty packages */
    .sp-pkg-empty {
        text-align: center; padding: 3rem 2rem;
        background: var(--white); border: 1px solid var(--border); border-radius: 12px;
        margin-bottom: 2.5rem;
    }
    .sp-pkg-empty svg { width: 48px; height: 48px; color: var(--gold); opacity: 0.25; margin: 0 auto 0.85rem; display: block; }
    .sp-pkg-empty p { font-size: 0.82rem; color: var(--warm-grey); font-family: var(--font-body); }

    /* ══════════════════════════════
       REVIEWS — NEW LAYOUT
    ══════════════════════════════ */
    .sp-reviews-wrap { margin-bottom: 2.5rem; }

    /* Summary bar */
    .sp-reviews-summary {
        background: var(--charcoal);
        border-radius: 12px;
        padding: 1.5rem 1.75rem;
        margin-bottom: 1rem;
        display: flex; align-items: center; gap: 2rem; flex-wrap: wrap;
        position: relative; overflow: hidden;
    }
    .sp-reviews-summary::before {
        content: '';
        position: absolute; inset: 0;
        background-image: radial-gradient(rgba(201,168,76,0.05) 1px, transparent 1px);
        background-size: 18px 18px; pointer-events: none;
    }
    .sp-reviews-summary::after {
        content: '';
        position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }
    .sp-rev-avg-block { position: relative; z-index: 1; text-align: center; }
    .sp-rev-avg-num {
        font-family: var(--font-display); font-size: 3rem; font-weight: 700;
        color: var(--gold); line-height: 1;
    }
    .sp-rev-avg-stars {
        display: flex; gap: 3px; justify-content: center; margin: 0.3rem 0 0.2rem;
    }
    .sp-rev-avg-stars svg { width: 14px; height: 14px; }
    .sp-rev-avg-label { font-size: 0.65rem; color: rgba(255,255,255,0.4); font-family: var(--font-body); letter-spacing: 0.05em; }

    /* Rating bar breakdown */
    .sp-rev-bars { flex: 1; min-width: 160px; position: relative; z-index: 1; }
    .sp-rev-bar-row {
        display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.35rem;
    }
    .sp-rev-bar-row:last-child { margin-bottom: 0; }
    .sp-rev-bar-num { font-size: 0.65rem; color: rgba(255,255,255,0.5); font-family: var(--font-body); width: 8px; text-align: right; flex-shrink: 0; }
    .sp-rev-bar-star svg { width: 9px; height: 9px; flex-shrink: 0; }
    .sp-rev-bar-track {
        flex: 1; height: 5px; background: rgba(255,255,255,0.1);
        border-radius: 99px; overflow: hidden;
    }
    .sp-rev-bar-fill {
        height: 100%; background: var(--gold); border-radius: 99px;
        transition: width 0.6s ease;
    }
    .sp-rev-bar-count { font-size: 0.62rem; color: rgba(255,255,255,0.35); font-family: var(--font-body); width: 18px; flex-shrink: 0; }

    /* Review cards grid */
    .sp-rev-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1rem;
    }

    .sp-rev-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 1.1rem 1.25rem;
        display: flex; flex-direction: column; gap: 0.65rem;
        position: relative; overflow: hidden;
        transition: box-shadow 0.2s;
        animation: fadeUp 0.3s ease both;
    }
    .sp-rev-card:hover { box-shadow: 0 4px 20px rgba(30,27,24,0.08); }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: none; } }
    .sp-rev-card:nth-child(1) { animation-delay: 0s; }
    .sp-rev-card:nth-child(2) { animation-delay: .05s; }
    .sp-rev-card:nth-child(3) { animation-delay: .10s; }
    .sp-rev-card:nth-child(4) { animation-delay: .15s; }

    /* Top accent only for high ratings */
    .sp-rev-card.rating-5::before,
    .sp-rev-card.rating-4::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, var(--gold), var(--blush-deep));
    }

    .sp-rev-card-top { display: flex; align-items: center; gap: 0.6rem; }
    .sp-rev-initials {
        width: 36px; height: 36px; border-radius: 50%; flex-shrink: 0;
        background: rgba(201,168,76,0.1);
        border: 1.5px solid rgba(201,168,76,0.22);
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display); font-size: 0.78rem; font-weight: 700;
        color: var(--gold-dark);
    }
    .sp-rev-user { flex: 1; min-width: 0; }
    .sp-rev-name { font-size: 0.82rem; font-weight: 600; color: var(--charcoal); }
    .sp-rev-date { font-size: 0.65rem; color: #C0B8B0; margin-top: 1px; }

    /* Star display */
    .sp-rev-stars { display: flex; gap: 2px; align-items: center; }
    .sp-rev-stars svg { width: 13px; height: 13px; }
    .sp-rev-stars-label {
        font-size: 0.65rem; font-weight: 700; color: var(--gold-dark);
        margin-left: 4px; font-family: var(--font-display);
    }

    .sp-rev-text {
        font-size: 0.8rem; color: var(--warm-grey); line-height: 1.6;
        font-style: italic;
    }
    .sp-rev-text::before { content: '"'; color: var(--gold); font-family: var(--font-display); font-size: 1rem; }
    .sp-rev-text::after  { content: '"'; color: var(--gold); font-family: var(--font-display); font-size: 1rem; }

    /* Rating pill */
    .sp-rev-pill {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 2px 9px; border-radius: 999px;
        font-size: 0.62rem; font-weight: 700; letter-spacing: 0.04em;
        font-family: var(--font-body); align-self: flex-start;
    }
    .sp-rev-pill.r5, .sp-rev-pill.r4 { background: rgba(22,163,74,0.08); color: #166534; border: 1px solid rgba(22,163,74,0.2); }
    .sp-rev-pill.r3                   { background: rgba(202,138,4,0.08);  color: #92400E; border: 1px solid rgba(202,138,4,0.2); }
    .sp-rev-pill.r2, .sp-rev-pill.r1  { background: rgba(185,28,28,0.07); color: #991B1B; border: 1px solid rgba(185,28,28,0.18); }

    /* No reviews */
    .sp-rev-empty {
        text-align: center; padding: 2.5rem 2rem;
        background: var(--white); border: 1px solid var(--border); border-radius: 12px;
    }
    .sp-rev-empty svg { width: 44px; height: 44px; color: var(--gold); opacity: 0.22; margin: 0 auto 0.75rem; display: block; }
    .sp-rev-empty p { font-size: 0.82rem; color: var(--warm-grey); }

    /* ══════════════════════════════
       FLOATING ACTION BUTTONS
    ══════════════════════════════ */
    .sp-fab-group {
        position: fixed;
        bottom: 2rem; right: 1.75rem;
        display: flex; flex-direction: column; align-items: flex-end; gap: 0.65rem;
        z-index: 150;
    }
    .sp-fab-item { display: flex; align-items: center; gap: 0.6rem; }
    .sp-fab-note {
        background: var(--charcoal); color: rgba(255,255,255,0.88);
        font-family: var(--font-body); font-size: 0.72rem; font-weight: 500;
        padding: 5px 12px; border-radius: 6px;
        white-space: nowrap;
        opacity: 0; transform: translateX(8px);
        transition: opacity 0.2s, transform 0.2s;
        pointer-events: none;
        box-shadow: 0 4px 12px rgba(30,27,24,0.18);
        border: 1px solid rgba(201,168,76,0.18);
    }
    .sp-fab-note::after {
        content: '';
        position: absolute; right: -6px; top: 50%; transform: translateY(-50%);
        border-width: 5px 0 5px 6px; border-style: solid;
        border-color: transparent transparent transparent var(--charcoal);
    }
    .sp-fab-item:hover .sp-fab-note { opacity: 1; transform: translateX(0); }
    .sp-fab-btn {
        width: 50px; height: 50px; border-radius: 50%; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        border: none; cursor: pointer;
        box-shadow: 0 4px 16px rgba(30,27,24,0.22);
        transition: transform 0.18s, box-shadow 0.18s;
        text-decoration: none;
    }
    .sp-fab-btn:hover { transform: scale(1.1); box-shadow: 0 6px 24px rgba(30,27,24,0.28); }
    .sp-fab-btn svg { width: 20px; height: 20px; }
    .sp-fab-btn.fab-msg { background: var(--gold); color: var(--charcoal); }
    .sp-fab-btn.fab-cal { background: var(--charcoal); color: var(--gold-light); border: 1.5px solid rgba(201,168,76,0.25); }

    /* ══════════════════════════════
       BOOKING MODAL
    ══════════════════════════════ */
    .bv-modal-backdrop {
        display: none; position: fixed; inset: 0;
        background: rgba(30,27,24,0.52); z-index: 300;
        align-items: center; justify-content: center;
        padding: 1.5rem; backdrop-filter: blur(3px);
    }
    .bv-modal-backdrop.open { display: flex; }
    .bv-modal {
        background: var(--white); border-radius: 12px;
        width: 480px; max-width: 100%;
        border-top: 2px solid var(--gold);
        max-height: calc(100vh - 3rem);
        display: flex; flex-direction: column; overflow: hidden;
        margin: auto; flex-shrink: 0;
        box-shadow: 0 20px 60px rgba(30,27,24,0.22);
    }
    .bv-modal-header {
        flex-shrink: 0; display: flex; align-items: center; justify-content: space-between;
        padding: 1.1rem 1.4rem; border-bottom: 1px solid var(--border); background: var(--white);
    }
    .bv-modal-title { font-family: var(--font-display); font-size: 1.05rem; font-weight: 700; color: var(--charcoal); }
    .bv-modal-title em { font-style: italic; color: var(--gold-dark); }
    .bv-modal-close {
        width: 28px; height: 28px; border: 1px solid var(--border);
        background: var(--ivory); border-radius: 6px; cursor: pointer;
        font-size: 15px; color: var(--warm-grey);
        display: flex; align-items: center; justify-content: center;
        transition: border-color 0.18s, color 0.18s;
    }
    .bv-modal-close:hover { border-color: var(--gold); color: var(--gold-dark); }
    .bv-modal-body { padding: 1.3rem 1.4rem; overflow-y: auto; flex: 1; min-height: 0; }
    .bv-modal-body::-webkit-scrollbar { width: 4px; }
    .bv-modal-body::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }
    .bv-modal-footer {
        flex-shrink: 0; padding: 0.85rem 1.4rem; border-top: 1px solid var(--border);
        display: flex; gap: 0.5rem; justify-content: flex-end; background: var(--white);
    }
    .bv-field { margin-bottom: 1rem; }
    .bv-field:last-child { margin-bottom: 0; }
    .bv-label {
        display: block; font-size: 0.65rem; font-weight: 700; letter-spacing: 0.08em;
        text-transform: uppercase; color: var(--warm-grey); margin-bottom: 0.4rem;
        font-family: var(--font-body);
    }
    .bv-select {
        width: 100%; padding: 0.65rem 2rem 0.65rem 0.85rem;
        border: 1.5px solid var(--border); border-radius: 6px;
        font-family: var(--font-body); font-size: 0.84rem; color: var(--charcoal);
        background: var(--ivory); outline: none; appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' fill='none' stroke='%23C0B8B0' stroke-width='1.5'%3E%3Cpath d='M1 1l4 4 4-4'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 0.8rem center;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .bv-select:focus { border-color: var(--gold); background-color: var(--white); box-shadow: 0 0 0 3px rgba(201,168,76,0.12); }
    .bv-alert-warn {
        display: flex; align-items: flex-start; gap: 0.55rem;
        background: #FFFBEB; color: #92400E;
        border: 1px solid #FDE68A; border-radius: 6px;
        padding: 0.75rem 1rem; font-size: 0.78rem; font-family: var(--font-body);
        line-height: 1.5; margin-top: 0.85rem;
    }
    .bv-alert-warn svg { width: 15px; height: 15px; flex-shrink: 0; margin-top: 1px; }
    .btn-confirm {
        padding: 0.6rem 1.4rem; border-radius: 6px; border: none;
        background: var(--gold); color: var(--charcoal);
        font-size: 0.78rem; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase;
        cursor: pointer; font-family: var(--font-body);
        transition: background 0.18s, transform 0.15s;
    }
    .btn-confirm:disabled { opacity: 0.45; cursor: not-allowed; transform: none !important; }
    .btn-confirm:not(:disabled):hover { background: var(--gold-light); transform: translateY(-1px); }
    .btn-cancel-modal {
        padding: 0.6rem 1.1rem; border-radius: 6px;
        border: 1px solid var(--border-md); background: var(--white);
        font-size: 0.78rem; font-weight: 500; color: var(--warm-grey);
        cursor: pointer; font-family: var(--font-body); transition: border-color 0.18s;
    }
    .btn-cancel-modal:hover { border-color: var(--gold); color: var(--charcoal); }
    .modal-pkg-info {
        background: var(--ivory); border: 1px solid var(--border); border-radius: 8px;
        padding: 0.85rem 1rem; margin-bottom: 1.1rem;
        display: flex; align-items: center; gap: 0.75rem;
    }
    .modal-pkg-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--gold); flex-shrink: 0; }
    .modal-pkg-name { font-family: var(--font-display); font-size: 0.9rem; font-weight: 700; color: var(--charcoal); }
    .modal-pkg-price { font-size: 0.75rem; color: var(--gold-dark); font-weight: 600; margin-top: 2px; font-family: var(--font-body); }
    
    /* ══════════════════════════════
     EMAIL VERIFICATION MODAL
══════════════════════════════ */
    .ev-modal-backdrop {
        display: none; position: fixed; inset: 0;
        background: rgba(30,27,24,0.52); z-index: 400;
        align-items: center; justify-content: center;
        padding: 1.5rem; backdrop-filter: blur(3px);
    }
    .ev-modal-backdrop.open { display: flex; }
    .ev-modal {
        background: var(--white); border-radius: 12px;
        width: 440px; max-width: 100%;
        border-top: 2px solid var(--gold);
        display: flex; flex-direction: column; overflow: hidden;
        margin: auto; flex-shrink: 0;
        box-shadow: 0 20px 60px rgba(30,27,24,0.22);
        animation: evSlideIn 0.25s ease;
    }
    @keyframes evSlideIn {
        from { opacity: 0; transform: translateY(12px) scale(0.98); }
        to   { opacity: 1; transform: none; }
    }
    .ev-modal-header {
        flex-shrink: 0; display: flex; align-items: center; justify-content: space-between;
        padding: 1.1rem 1.4rem; border-bottom: 1px solid var(--border); background: var(--white);
    }
    .ev-modal-title { font-family: var(--font-display); font-size: 1.05rem; font-weight: 700; color: var(--charcoal); }
    .ev-modal-title em { font-style: italic; color: var(--gold-dark); }
    .ev-modal-close {
        width: 28px; height: 28px; border: 1px solid var(--border);
        background: var(--ivory); border-radius: 6px; cursor: pointer;
        font-size: 15px; color: var(--warm-grey);
        display: flex; align-items: center; justify-content: center;
        transition: border-color 0.18s, color 0.18s;
    }
    .ev-modal-close:hover { border-color: var(--gold); color: var(--gold-dark); }
    .ev-modal-body {
        padding: 1.75rem 1.4rem;
        display: flex; flex-direction: column; align-items: center; gap: 1.1rem;
    }
    .ev-icon-ring {
        width: 72px; height: 72px; border-radius: 50%;
        background: rgba(201,168,76,0.1);
        border: 2px solid rgba(201,168,76,0.25);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .ev-icon-ring svg { width: 32px; height: 32px; }
    .ev-modal-copy { text-align: center; }
    .ev-modal-copy-head {
        font-family: var(--font-display); font-size: 1.1rem; font-weight: 700;
        color: var(--charcoal); margin-bottom: 0.4rem;
    }
    .ev-modal-copy-body {
        font-size: 0.82rem; color: var(--warm-grey); line-height: 1.65; margin: 0;
        font-family: var(--font-body);
    }
    .ev-modal-copy-body strong { color: var(--charcoal); font-weight: 600; }
    .ev-info-box {
        background: var(--ivory); border: 1px solid var(--border);
        border-radius: 8px; padding: 0.85rem 1rem; width: 100%;
        display: flex; align-items: flex-start; gap: 0.6rem;
    }
    .ev-info-box svg { width: 15px; height: 15px; flex-shrink: 0; margin-top: 1px; }
    .ev-info-box span {
        font-size: 0.77rem; color: var(--warm-grey); line-height: 1.55;
        font-family: var(--font-body);
    }
    .ev-info-box strong { color: var(--gold-dark); font-weight: 600; }
    .ev-modal-footer {
        flex-shrink: 0; padding: 0.85rem 1.4rem; border-top: 1px solid var(--border);
        display: flex; gap: 0.5rem; justify-content: flex-end; background: var(--white);
    }
    .ev-status-msg {
        font-size: 0.75rem; font-family: var(--font-body);
        display: none; align-items: center; gap: 0.4rem;
        margin-right: auto; color: #166534;
    }
    .ev-status-msg.show { display: flex; }
    .ev-status-msg svg { width: 13px; height: 13px; }
    .btn-ev-resend {
        padding: 0.6rem 1.4rem; border-radius: 6px; border: none;
        background: var(--gold); color: var(--charcoal);
        font-size: 0.78rem; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase;
        cursor: pointer; font-family: var(--font-body);
        transition: background 0.18s, transform 0.15s;
        display: flex; align-items: center; gap: 0.4rem;
    }
    .btn-ev-resend:disabled { opacity: 0.5; cursor: not-allowed; transform: none !important; }
    .btn-ev-resend:not(:disabled):hover { background: var(--gold-light); transform: translateY(-1px); }
    .btn-ev-resend svg { width: 13px; height: 13px; }
    .btn-ev-close-modal {
        padding: 0.6rem 1.1rem; border-radius: 6px;
        border: 1px solid var(--border-md); background: var(--white);
        font-size: 0.78rem; font-weight: 500; color: var(--warm-grey);
        cursor: pointer; font-family: var(--font-body); transition: border-color 0.18s;
    }
    .btn-ev-close-modal:hover { border-color: var(--gold); color: var(--charcoal); }

    /* Pulse ring animation on icon */
    .ev-icon-ring { position: relative; }
    .ev-icon-ring::before {
        content: '';
        position: absolute; inset: -6px; border-radius: 50%;
        border: 1.5px solid rgba(201,168,76,0.18);
        animation: evPulse 2.4s ease-in-out infinite;
    }
    @keyframes evPulse {
        0%, 100% { transform: scale(1); opacity: 0.6; }
        50% { transform: scale(1.08); opacity: 0.15; }
    }

    /* Mobile */
    @media (max-width: 720px) {
        .sp-wrap { padding: 1rem 0.75rem 6rem; }
        .sp-hero { padding: 1.35rem 1.25rem 1.25rem; }
        .sp-pkg-layout { grid-template-columns: 1fr; }
        .sp-pkg-sidebar { position: static; }
        .sp-rev-grid { grid-template-columns: 1fr; }
        .sp-fab-group { bottom: 1.25rem; right: 1.1rem; }
    }
</style>

<div class="sp-wrap">

    {{-- ══════════════════════
         SUPPLIER HERO
    ══════════════════════ --}}
    <div class="sp-hero">
        <div class="sp-hero-inner">

            <div class="sp-avatar">
                @if($supplier->photo)
                    <img src="{{ asset('storage/'.$supplier->photo) }}" alt="{{ $supplier->business_name }}">
                @else
                    {{ strtoupper(substr($supplier->business_name ?? $supplier->first_name ?? 'S', 0, 2)) }}
                @endif
            </div>

            <div class="sp-hero-info">
                <div class="sp-eyebrow">Verified Supplier</div>
                <div class="sp-business-name">{{ $supplier->business_name }}</div>
                @if($supplier->tagline)
                    <div class="sp-tagline">"{{ $supplier->tagline }}"</div>
                @endif

                <div class="sp-meta-chips">
                    <span class="sp-chip">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="10" cy="7" r="4"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7"/>
                        </svg>
                        {{ $supplier->first_name }} {{ $supplier->last_name }}
                    </span>
                    @if($supplier->city || $supplier->province)
                    <span class="sp-chip">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M10 2C7.2 2 5 4.2 5 7c0 4.4 5 11 5 11s5-6.6 5-11c0-2.8-2.2-5-5-5z"/>
                            <circle cx="10" cy="7" r="1.5"/>
                        </svg>
                        {{ collect([$supplier->city, $supplier->province])->filter()->implode(', ') }}
                    </span>
                    @endif
                    @if($supplier->phone)
                    <span class="sp-chip">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M3 5a2 2 0 012-2h1l2 4-1.5 1.5a11 11 0 004 4L12 11l4 2v1a2 2 0 01-2 2C7.5 16 4 12.5 4 7a2 2 0 011-1.7V5z"/>
                        </svg>
                        {{ $supplier->phone }}
                    </span>
                    @endif
                    @if($supplier->address)
                    <span class="sp-chip">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M3 7h14M3 11h14M5 15h10M7 3h6"/>
                        </svg>
                        {{ Str::limit($supplier->address, 32) }}
                    </span>
                    @endif
                </div>

                @if($supplier->bio)
                <div class="sp-bio">{{ $supplier->bio }}</div>
                @endif
            </div>

        </div>
    </div>

    {{-- ══════════════════════
         PACKAGES
         Layout: left sidebar list + right detail panel
    ══════════════════════ --}}
    <div class="sp-section-head">
        <span class="sp-section-label">Packages</span>
        <span class="sp-pkg-count">{{ count($packages) }} package{{ count($packages) !== 1 ? 's' : '' }}</span>
    </div>

    @if(count($packages))
    <div class="sp-pkg-layout">

        {{-- Left: package list --}}
        <div class="sp-pkg-sidebar">
            <div class="sp-pkg-sidebar-head">Choose a package</div>
            @foreach($packages as $index => $package)
            <div class="sp-pkg-list-item {{ $index === 0 ? 'active' : '' }}"
                 onclick="selectPackage({{ $package->id }}, this)">
                <span class="sp-pkg-list-dot"></span>
                <span class="sp-pkg-list-name">{{ $package->name }}</span>
                <span class="sp-pkg-list-price">₱{{ number_format($package->price) }}</span>
            </div>
            @endforeach
        </div>

        {{-- Right: detail panels (one per package) --}}
        <div class="sp-pkg-detail">
            @foreach($packages as $index => $package)
            @php $inclusions = $package->inclusions ?? collect(); @endphp

            <div class="sp-pkg-panel {{ $index === 0 ? 'active' : '' }}" id="pkg-panel-{{ $package->id }}">

                {{-- Gold accent top (via ::before) --}}

                <div class="sp-pkg-panel-body">
                    <div class="sp-pkg-panel-name">{{ $package->name }}</div>
                    <div class="sp-pkg-panel-price">₱{{ number_format($package->price) }}</div>

                    <div class="sp-pkg-panel-chips">
                        @if($package->guest_capacity)
                        <span class="sp-pkg-chip">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M14 17v-1a4 4 0 00-4-4H6a4 4 0 00-4 4v1"/><circle cx="8" cy="7" r="4"/>
                                <path d="M18 17v-1a4 4 0 00-3-3.87M14 3.13a4 4 0 010 7.75"/>
                            </svg>
                            {{ number_format($package->guest_capacity) }} guests
                        </span>
                        @endif
                        @if($package->event_type)
                        <span class="sp-pkg-chip">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <rect x="2" y="4" width="16" height="14" rx="2"/><path d="M2 9h16M7 2v4M13 2v4"/>
                            </svg>
                            {{ $package->event_type }}
                        </span>
                        @endif
                    </div>

                    @if($package->description)
                    <p class="sp-pkg-panel-desc">{{ $package->description }}</p>
                    @endif

                    @if(count($inclusions))
                    <div class="sp-incl-label">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M2 4h10M2 7h10M2 10h6"/>
                        </svg>
                        What's included
                    </div>
                    <div class="sp-incl-grid">
                        @foreach($inclusions as $inc)
                        <div class="sp-incl-item">
                            <span class="sp-incl-dot"></span>
                            {{ $inc->title }}
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                {{-- Footer with booking button (only if email verified) --}}
                @if(auth()->user()->hasVerifiedEmail())
                <div class="sp-pkg-panel-foot">
                    <button type="button" class="btn-book"
                        onclick="openBookingModal({{ $package->id }}, '{{ addslashes($package->name) }}', '{{ number_format($package->price) }}')">
                        <span>Book This Package</span>
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 3l5 5-5 5"/>
                        </svg>
                    </button>
                    
                </div>
                @else
                    <button type="button" class="btn-book opacity-50 cursor-not-allowed"
                        onclick="openEmailVerificationModal()">

                        <span>Verify Email to Book</span>
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 3l5 5-5 5"/>
                        </svg>
                    </button>

                @endif
            </div>
            @endforeach
        </div>

    </div>

    @else
    <div class="sp-pkg-empty">
        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
            <rect x="8" y="10" width="32" height="30" rx="3"/>
            <path d="M16 20h16M16 27h10M24 4v6"/>
        </svg>
        <p>This supplier hasn't added any packages yet.</p>
    </div>
    @endif


    {{-- ══════════════════════
         REVIEWS
    ══════════════════════ --}}
    @php
        $ratings      = $supplier->ratings ?? collect();
        $ratingCount  = $ratings->count();
        $avgRating    = $ratingCount ? round($ratings->avg('rating'), 1) : 0;

        /* count per star */
        $starCounts = [];
        for ($s = 5; $s >= 1; $s--) {
            $starCounts[$s] = $ratings->where('rating', $s)->count();
        }
    @endphp

    <div class="sp-reviews-wrap">

        <div class="sp-section-head">
            <span class="sp-section-label">Reviews</span>
            <span class="sp-pkg-count">{{ $ratingCount }} review{{ $ratingCount !== 1 ? 's' : '' }}</span>
        </div>

        {{-- Summary bar --}}
        @if($ratingCount)
        <div class="sp-reviews-summary">

            {{-- Big average --}}
            <div class="sp-rev-avg-block">
                <div class="sp-rev-avg-num">{{ number_format($avgRating, 1) }}</div>
                <div class="sp-rev-avg-stars">
                    @for($s = 1; $s <= 5; $s++)
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                        style="fill:{{ $s <= round($avgRating) ? '#C9A84C' : 'rgba(255,255,255,0.15)' }};
                               stroke:{{ $s <= round($avgRating) ? '#C9A84C' : 'rgba(255,255,255,0.2)' }};
                               stroke-width:1.4; stroke-linejoin:round;">
                        <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/>
                    </svg>
                    @endfor
                </div>
                <div class="sp-rev-avg-label">{{ $ratingCount }} review{{ $ratingCount !== 1 ? 's' : '' }}</div>
            </div>

            {{-- Bar breakdown --}}
            <div class="sp-rev-bars">
                @for($s = 5; $s >= 1; $s--)
                @php $pct = $ratingCount ? round(($starCounts[$s] / $ratingCount) * 100) : 0; @endphp
                <div class="sp-rev-bar-row">
                    <span class="sp-rev-bar-num">{{ $s }}</span>
                    <span class="sp-rev-bar-star">
                        <svg viewBox="0 0 24 24" style="fill:#C9A84C;stroke:#C9A84C;stroke-width:1.4;stroke-linejoin:round;">
                            <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/>
                        </svg>
                    </span>
                    <div class="sp-rev-bar-track">
                        <div class="sp-rev-bar-fill" style="width:{{ $pct }}%;"></div>
                    </div>
                    <span class="sp-rev-bar-count">{{ $starCounts[$s] }}</span>
                </div>
                @endfor
            </div>

        </div>
        @endif
        <div class="sp-section-head">
            <span class="sp-section-label">What Our Clients Say</span>
        </div>
        {{-- Review cards --}}
        @if($ratingCount)
        <div class="sp-rev-grid">
            @foreach($ratings as $rate)
            @php
                $rVal     = (int)($rate->rating ?? 0);
                $initials = strtoupper(substr($rate->user->name ?? 'U', 0, 1));
                $nameParts= explode(' ', $rate->user->name ?? '');
                if (count($nameParts) > 1) $initials = strtoupper($nameParts[0][0] . $nameParts[1][0]);
                $pillClass = 'r' . $rVal;
                $sentiments = [1=>'Bad', 2=>'Poor', 3=>'Average', 4=>'Good', 5=>'Excellent'];
            @endphp

            <div class="sp-rev-card rating-{{ $rVal }}">

                {{-- Top: user + stars --}}
                <div class="sp-rev-card-top">
                    <div class="sp-rev-initials">{{ $initials }}</div>
                    <div class="sp-rev-user">
                        <div class="sp-rev-name">{{ $rate->user->name ?? 'Anonymous' }}</div>
                        @if($rate->created_at)
                        <div class="sp-rev-date">{{ \Carbon\Carbon::parse($rate->created_at)->format('M d, Y') }}</div>
                        @endif
                    </div>
                </div>

                {{-- Stars + sentiment pill --}}
                <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:0.4rem;">
                    <div class="sp-rev-stars">
                        @for($s = 1; $s <= 5; $s++)
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            style="fill:{{ $s <= $rVal ? '#F97316' : '#EDE8E3' }};
                                   stroke:{{ $s <= $rVal ? '#EA580C' : '#D4C8BC' }};
                                   stroke-width:1.4; stroke-linejoin:round;">
                            <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/>
                        </svg>
                        @endfor
                        <span class="sp-rev-stars-label">{{ $rVal }}.0</span>
                    </div>
                    <span class="sp-rev-pill {{ $pillClass }}">{{ $sentiments[$rVal] ?? '' }}</span>
                </div>

                {{-- Review text --}}
                @if($rate->review)
                <div class="sp-rev-text">{{ $rate->review }}</div>
                @endif

            </div>
            @endforeach
        </div>

        @else
        <div class="sp-rev-empty">
            <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
                <path d="M24 4C13 4 4 13 4 24s9 20 20 20 20-9 20-20S35 4 24 4z"/>
                <path d="M16 22h16M16 28h8"/>
            </svg>
            <p>No reviews yet. Be the first to review this supplier!</p>
        </div>
        @endif

    </div>{{-- /sp-reviews-wrap --}}

</div>{{-- /sp-wrap --}}


{{-- ══════════════════════════════
     FLOATING ACTION BUTTONS
══════════════════════════════ --}}
<div class="sp-fab-group">
    {{-- Only allow messaging if user's email is verified, otherwise show an alert prompting verification--}}
    @if(auth()->user()->hasVerifiedEmail())
    <div class="sp-fab-item" style="position:relative;">
        <span class="sp-fab-note">Send a message</span>
        <a href="{{ route('chat', [$supplier->user_id, $supplier->id]) }}"
           class="sp-fab-btn fab-msg" title="Send Message">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
            </svg>
        </a>
    </div>
    @else
    <div class="sp-fab-item" style="position:relative;">
        <span class="sp-fab-note">Send a message</span>
        <a href="javascript:void(0)" onclick="openEmailVerificationModal()"
           class="sp-fab-btn fab-msg" title="Send Message">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
            </svg>
        </a>
    </div>
    @endif
    <div class="sp-fab-item" style="position:relative;">
        <span class="sp-fab-note">Check availability</span>
        <a href="{{ route('client.supplier.calendar', $supplier->id) }}"
           class="sp-fab-btn fab-cal" title="Check Availability">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <path d="M3 9h18M8 2v4M16 2v4M9 14l2 2 4-4"/>
            </svg>
        </a>
    </div>
    
</div>

{{-- ══════════════════════════════
     EMAIL VERIFICATION MODAL
══════════════════════════════ --}}
<div id="emailVerificationModal" class="ev-modal-backdrop">
    <div class="ev-modal">

        <div class="ev-modal-header">
            <span class="ev-modal-title">Verify your <em>Email</em></span>
            <button class="ev-modal-close" onclick="closeEmailVerificationModal()">✕</button>
        </div>

        <div class="ev-modal-body">

            <div class="ev-icon-ring">
                <svg viewBox="0 0 24 24" fill="none" stroke="{{ '#C9A84C' }}" stroke-width="1.7">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
            </div>

            <div class="ev-modal-copy">
                <div class="ev-modal-copy-head">Check your inbox</div>
                <p class="ev-modal-copy-body">
                    We sent a verification link to
                    <strong>{{ auth()->user()->email }}</strong>.
                    Please verify your email to unlock booking and messaging features.
                </p>
            </div>

            <div class="ev-info-box">
                <svg viewBox="0 0 20 20" fill="none" stroke="var(--gold)" stroke-width="1.8">
                    <circle cx="10" cy="10" r="8"/>
                    <path d="M10 6v4M10 14h.01"/>
                </svg>
                <span>
                    Didn't receive the email? Check your spam folder or click
                    <strong>Resend</strong> below to get a new link.
                </span>
            </div>

        </div>

        <div class="ev-modal-footer">
            <span class="ev-status-msg" id="ev-sent-msg">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 8l3.5 3.5L13 4"/>
                </svg>
                Email sent!
            </span>

            <button type="button" class="btn-ev-close-modal" onclick="closeEmailVerificationModal()">Close</button>

            <form method="POST" action="{{ route('verification.send') }}" id="ev-resend-form" style="margin:0;">
                @csrf
                <button type="submit" class="btn-ev-resend" id="ev-resend-btn"
                        onclick="handleEvResend(event)">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 4l7 5 7-5M1 4v8a1 1 0 001 1h12a1 1 0 001-1V4"/>
                    </svg>
                    <span>Resend Verification</span>
                </button>
            </form>
        </div>

    </div>
</div>
{{-- ══════════════════════════════
     BOOKING MODAL
══════════════════════════════ --}}
<div id="bookingModal" class="bv-modal-backdrop">
    <div class="bv-modal">

        <div class="bv-modal-header">
            <span class="bv-modal-title">Book a <em>Package</em></span>
            <button class="bv-modal-close" onclick="closeBookingModal()">✕</button>
        </div>

        <form method="POST" action="{{ route('client.bookings.store') }}" style="display:contents;">
            @csrf
            <input type="hidden" name="package_id" id="modal_package_id">

            <div class="bv-modal-body">

                <div class="modal-pkg-info">
                    <span class="modal-pkg-dot"></span>
                    <div>
                        <div class="modal-pkg-name" id="modal_pkg_name">—</div>
                        <div class="modal-pkg-price" id="modal_pkg_price">—</div>
                    </div>
                </div>

                <div class="bv-field">
                    <label class="bv-label" for="modal_event_id">Select your event</label>
                    <select name="event_id" id="modal_event_id" class="bv-select" required
                            {{ $events->isEmpty() ? 'disabled' : '' }}>
                        @forelse($events as $event)
                            <option value="{{ $event->id }}">
                                {{ $event->event_name }} — {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}
                            </option>
                        @empty
                            <option value="" disabled selected>No events available</option>
                        @endforelse
                    </select>
                </div>

                @if($events->isEmpty())
                <div class="bv-alert-warn">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M10 2l8 16H2L10 2z"/>
                        <path d="M10 9v4M10 15h.01"/>
                    </svg>
                    <span>You need to create an event first before you can make a booking. Go to your dashboard and create an event.</span>
                </div>
                @endif

            </div>

            <div class="bv-modal-footer">
                <button type="button" class="btn-cancel-modal" onclick="closeBookingModal()">Cancel</button>
                <button type="submit" class="btn-confirm" {{ $events->isEmpty() ? 'disabled' : '' }}>
                    Confirm Booking
                </button>
            </div>
        </form>

    </div>
</div>


<script>
    /* ── PACKAGE SIDEBAR SWITCHER ── */
    function selectPackage(packageId, listItem) {
        /* Deactivate all list items */
        document.querySelectorAll('.sp-pkg-list-item').forEach(el => el.classList.remove('active'));
        /* Deactivate all panels */
        document.querySelectorAll('.sp-pkg-panel').forEach(el => el.classList.remove('active'));

        /* Activate clicked item and matching panel */
        listItem.classList.add('active');
        const panel = document.getElementById('pkg-panel-' + packageId);
        if (panel) panel.classList.add('active');
    }

    /* ── BOOKING MODAL ── */
    function openBookingModal(packageId, name, price) {
        document.getElementById('modal_package_id').value = packageId;
        document.getElementById('modal_pkg_name').textContent  = name;
        document.getElementById('modal_pkg_price').textContent = '₱' + price;
        document.getElementById('bookingModal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeBookingModal() {
        document.getElementById('bookingModal').classList.remove('open');
        document.body.style.overflow = '';
    }
    document.getElementById('bookingModal').addEventListener('click', function(e) {
        if (e.target === this) closeBookingModal();
    });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeBookingModal(); });

    /* ── EMAIL VERIFICATION MODAL ── */
     function openEmailVerificationModal() {
        document.getElementById('emailVerificationModal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeEmailVerificationModal() {
        document.getElementById('emailVerificationModal').classList.remove('open');
        document.body.style.overflow = '';
    }

    /* Close on backdrop click */
    document.getElementById('emailVerificationModal').addEventListener('click', function(e) {
        if (e.target === this) closeEmailVerificationModal();
    });

    /* Close on Escape — chain with existing booking modal handler */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeEmailVerificationModal();
            closeBookingModal();
        }
    });

    /* Resend with cooldown feedback */
    function handleEvResend(e) {
        e.preventDefault();
        const btn = document.getElementById('ev-resend-btn');
        const msg = document.getElementById('ev-sent-msg');

        btn.disabled = true;
        msg.classList.add('show');

        /* Submit the form */
        document.getElementById('ev-resend-form').submit();

        /* Re-enable button after 60s cooldown */
        setTimeout(() => {
            btn.disabled = false;
            msg.classList.remove('show');
        }, 60000);
    }
</script>

</x-client-layout>