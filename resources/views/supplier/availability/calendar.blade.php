<x-supplier-layout>

<!-- FullCalendar CDN -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap');

    :root {
        --gold:          #C9A84C;
        --gold-light:    #E8C97A;
        --gold-dark:     #8A6A1F;
        --blush-deep:    #D4A090;
        --ivory:         #FAF7F2;
        --charcoal:      #1E1B18;
        --warm-grey:     #6B6560;
        --white:         #FFFFFF;
        --border:        #F0EBE5;
        --border-md:     #E0D8D0;
        --font-display: 'Playfair Display', Georgia, serif;
        --font-body:    'DM Sans', sans-serif;

        /* ── STATUS COLORS — solid, high-contrast ── */
        --av-green:      #16A34A;   /* available   */
        --av-green-bg:   #DCFCE7;
        --av-green-bd:   #86EFAC;

        --av-red:        #DC2626;   /* unavailable */
        --av-red-bg:     #FEE2E2;
        --av-red-bd:     #FCA5A5;

        --av-gold:       #B45309;   /* booked      */
        --av-gold-bg:    #FEF3C7;
        --av-gold-bd:    #FCD34D;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    /* ── PAGE SHELL ── */
    .av-page {
        padding: 1.75rem 2rem 4rem;
        max-width: 1360px;
        font-family: var(--font-body);
    }

    /* ── PAGE HEADER ── */
    .av-page-header {
        display: flex; align-items: flex-start; justify-content: space-between;
        flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;
    }
    .av-page-title  { font-family: var(--font-display); font-size: clamp(1.3rem,2.5vw,1.8rem); font-weight: 700; color: var(--charcoal); line-height: 1.15; }
    .av-page-title em { color: var(--gold-dark); font-style: italic; }
    .av-page-sub    { font-size: 0.78rem; color: var(--warm-grey); margin-top: 0.25rem; }

    /* ── LEGEND ── */
    .av-legend {
        display: flex; align-items: center; gap: 1.1rem; flex-wrap: wrap;
        padding: 0.65rem 1rem; background: var(--white);
        border: 1px solid var(--border); border-radius: 6px; align-self: flex-end;
    }
    .av-legend-label { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); }
    .av-legend-item { display: flex; align-items: center; gap: 0.4rem; }
    .av-legend-pill {
        display: inline-flex; align-items: center; gap: 0.35rem;
        padding: 0.18rem 0.65rem; border-radius: 999px;
        font-size: 0.62rem; font-weight: 700; letter-spacing: 0.04em; text-transform: uppercase;
        border: 1.5px solid;
    }
    .av-legend-pill.av  { background: var(--av-green-bg);  color: var(--av-green); border-color: var(--av-green-bd); }
    .av-legend-pill.un  { background: var(--av-red-bg);    color: var(--av-red);   border-color: var(--av-red-bd); }
    .av-legend-pill.bk  { background: var(--av-gold-bg);   color: var(--av-gold);  border-color: var(--av-gold-bd); }
    .av-legend-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
    .av-legend-dot.av { background: var(--av-green); }
    .av-legend-dot.un { background: var(--av-red); }
    .av-legend-dot.bk { background: var(--av-gold); }

    /* ── STAT CARDS ── */
    .av-stat-row { display: grid; grid-template-columns: repeat(3,1fr); gap: 1rem; margin-bottom: 1.5rem; }
    @media(max-width:640px){ .av-stat-row { grid-template-columns: 1fr 1fr; } }
    .av-stat-card {
        background: var(--white); border: 1px solid var(--border); border-radius: 8px;
        padding: 1.1rem 1.25rem; position: relative; overflow: hidden;
        transition: box-shadow 0.2s;
    }
    .av-stat-card:hover { box-shadow: 0 4px 18px rgba(30,27,24,0.08); }
    .av-stat-card::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; border-radius: 8px 8px 0 0; }
    .av-stat-card.s-av::before  { background: var(--av-green); }
    .av-stat-card.s-un::before  { background: var(--av-red); }
    .av-stat-card.s-bk::before  { background: var(--av-gold); }
    .av-stat-n { font-family: var(--font-display); font-size: 2rem; font-weight: 700; line-height: 1; }
    .av-stat-card.s-av .av-stat-n { color: var(--av-green); }
    .av-stat-card.s-un .av-stat-n { color: var(--av-red); }
    .av-stat-card.s-bk .av-stat-n { color: var(--av-gold); }
    .av-stat-l { font-size: 0.62rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); margin-top: 3px; }

    /* ── MAIN LAYOUT: calendar + sidebar ── */
    .av-main-layout {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 1.25rem;
        align-items: start;
    }
    @media(max-width:960px) { .av-main-layout { grid-template-columns: 1fr; } }

    /* ── CALENDAR CARD ── */
    .av-card {
        background: var(--white); border: 1px solid var(--border); border-radius: 8px;
        overflow: hidden;
    }
    .av-card-header {
        padding: 1.1rem 1.5rem; border-bottom: 1px solid var(--border);
        display: flex; align-items: center; gap: 0.75rem;
    }
    .av-card-icon {
        width: 34px; height: 34px; border-radius: 8px;
        background: rgba(201,168,76,0.1); display: flex; align-items: center;
        justify-content: center; color: var(--gold-dark); flex-shrink: 0;
    }
    .av-card-icon svg { width: 16px; height: 16px; }
    .av-card-title { font-family: var(--font-display); font-size: 0.95rem; font-weight: 700; color: var(--charcoal); }
    .av-card-desc  { font-size: 0.72rem; color: var(--warm-grey); margin-top: 0.1rem; }
    .av-card-body  { padding: 1.5rem; }

    /* ══════════════════════════════════════════
       FULLCALENDAR OVERRIDES — SOLID EVENT COLORS
    ══════════════════════════════════════════ */
    .av-cal-wrap .fc { font-family: var(--font-body); }
    .av-cal-wrap .fc-toolbar-title {
        font-family: var(--font-display); font-size: 1.15rem; font-weight: 700; color: var(--charcoal);
    }
    .av-cal-wrap .fc-button {
        background: var(--white) !important; border: 1px solid var(--border-md) !important;
        color: var(--warm-grey) !important; border-radius: 4px !important;
        font-family: var(--font-body) !important; font-size: 0.72rem !important;
        font-weight: 500 !important; letter-spacing: 0.04em !important;
        text-transform: uppercase !important; padding: 0.38rem 0.85rem !important;
        box-shadow: none !important; transition: border-color 0.18s, color 0.18s !important;
    }
    .av-cal-wrap .fc-button:hover { border-color: var(--gold) !important; color: var(--gold-dark) !important; }
    .av-cal-wrap .fc-button-active,
    .av-cal-wrap .fc-button-primary:not(:disabled):active {
        background: var(--charcoal) !important; border-color: var(--charcoal) !important; color: var(--white) !important;
    }
    .av-cal-wrap .fc-col-header-cell { background: rgba(201,168,76,0.04); border-color: var(--border) !important; }
    .av-cal-wrap .fc-col-header-cell-cushion {
        font-size: 0.65rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase;
        color: var(--gold-dark); text-decoration: none; padding: 0.55rem 0;
    }
    .av-cal-wrap .fc-daygrid-day { border-color: var(--border) !important; cursor: pointer; transition: background 0.15s; }
    .av-cal-wrap .fc-daygrid-day:hover { background: rgba(201,168,76,0.04) !important; }
    .av-cal-wrap .fc-daygrid-day-number {
        font-size: 0.78rem; color: var(--warm-grey); text-decoration: none; padding: 6px 8px;
    }
    .av-cal-wrap .fc-day-today { background: rgba(201,168,76,0.07) !important; }
    .av-cal-wrap .fc-day-today .fc-daygrid-day-number { color: var(--gold-dark); font-weight: 700; }

    /* ── EVENT PILLS — high-contrast solid colors ── */
    .av-cal-wrap .fc-event {
        border: none !important; border-radius: 4px !important;
        font-family: var(--font-body) !important; font-size: 0.65rem !important;
        font-weight: 700 !important; letter-spacing: 0.04em !important;
        text-transform: uppercase !important; padding: 3px 7px !important;
        cursor: pointer !important; transition: opacity 0.15s !important;
        margin-bottom: 1px !important;
    }
    .av-cal-wrap .fc-event:hover { opacity: 0.85 !important; }

    /* AVAILABLE — solid green */
    .av-cal-wrap .fc-event.ev-available {
        background-color: var(--av-green) !important;
        color: #FFFFFF !important;
        border-left: 3px solid #15803D !important;
    }
    /* UNAVAILABLE — solid red */
    .av-cal-wrap .fc-event.ev-unavailable {
        background-color: var(--av-red) !important;
        color: #FFFFFF !important;
        border-left: 3px solid #B91C1C !important;
    }
    /* BOOKED — solid amber/gold */
    .av-cal-wrap .fc-event.ev-booked {
        background-color: var(--av-gold) !important;
        color: #FFFFFF !important;
        border-left: 3px solid #92400E !important;
    }

    .av-cal-wrap .fc-scrollgrid,
    .av-cal-wrap .fc-scrollgrid td,
    .av-cal-wrap .fc-scrollgrid th { border-color: var(--border) !important; }

    /* ══════════════════════════════════════════
       UPCOMING EVENTS SIDEBAR
    ══════════════════════════════════════════ */
    .av-sidebar { display: flex; flex-direction: column; gap: 1rem; }

    .av-sidebar-card {
        background: var(--white); border: 1px solid var(--border); border-radius: 8px;
        overflow: hidden;
    }
    .av-sidebar-head {
        padding: 0.85rem 1.1rem; border-bottom: 1px solid var(--border);
        background: var(--ivory); display: flex; align-items: center; gap: 0.55rem;
    }
    .av-sidebar-head-icon {
        width: 28px; height: 28px; border-radius: 6px;
        background: rgba(201,168,76,0.12); display: flex; align-items: center;
        justify-content: center; color: var(--gold-dark); flex-shrink: 0;
    }
    .av-sidebar-head-icon svg { width: 13px; height: 13px; }
    .av-sidebar-title { font-family: var(--font-display); font-size: 0.88rem; font-weight: 700; color: var(--charcoal); }

    /* Upcoming event list */
    .av-upcoming-list { padding: 0.5rem 0; max-height: 420px; overflow-y: auto; scrollbar-width: thin; scrollbar-color: var(--border-md) transparent; }
    .av-upcoming-list::-webkit-scrollbar { width: 3px; }
    .av-upcoming-list::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 2px; }

    .av-upcoming-item {
        display: flex; align-items: stretch; gap: 0;
        padding: 0.7rem 1.1rem; border-bottom: 1px solid var(--border);
        cursor: pointer; transition: background 0.15s;
        position: relative;
    }
    .av-upcoming-item:last-child { border-bottom: none; }
    .av-upcoming-item:hover { background: var(--ivory); }

    /* colored left bar */
    .av-upcoming-bar {
        width: 3px; border-radius: 2px; margin-right: 0.7rem; flex-shrink: 0; align-self: stretch;
    }
    .av-upcoming-bar.av  { background: var(--av-green); }
    .av-upcoming-bar.un  { background: var(--av-red); }
    .av-upcoming-bar.bk  { background: var(--av-gold); }

    .av-upcoming-content { flex: 1; min-width: 0; }
    .av-upcoming-date {
        font-size: 0.72rem; font-weight: 700; color: var(--charcoal); line-height: 1.2;
    }
    .av-upcoming-day {
        font-size: 0.62rem; color: var(--warm-grey); margin-top: 1px;
    }
    .av-upcoming-badge {
        display: inline-flex; align-items: center; gap: 0.25rem;
        padding: 0.12rem 0.5rem; border-radius: 999px;
        font-size: 0.58rem; font-weight: 700; letter-spacing: 0.04em; text-transform: uppercase;
        margin-top: 0.3rem; border: 1px solid;
    }
    .av-upcoming-badge.av { background: var(--av-green-bg); color: var(--av-green); border-color: var(--av-green-bd); }
    .av-upcoming-badge.un { background: var(--av-red-bg);   color: var(--av-red);   border-color: var(--av-red-bd); }
    .av-upcoming-badge.bk { background: var(--av-gold-bg);  color: var(--av-gold);  border-color: var(--av-gold-bd); }

    .av-upcoming-chevron {
        align-self: center; color: var(--border-md); margin-left: 0.35rem; flex-shrink: 0;
    }
    .av-upcoming-chevron svg { width: 12px; height: 12px; }

    .av-upcoming-empty {
        padding: 2rem 1rem; text-align: center;
    }
    .av-upcoming-empty svg { width: 32px; height: 32px; color: var(--gold); opacity: 0.22; margin: 0 auto 0.6rem; display: block; }
    .av-upcoming-empty p { font-size: 0.75rem; color: #C0B8B0; }

    /* Quick-add in sidebar */
    .av-sidebar-quick {
        padding: 0.85rem 1.1rem; background: var(--ivory); border-top: 1px solid var(--border);
    }
    .av-sidebar-quick-label { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); margin-bottom: 0.5rem; }
    .av-quick-btns { display: flex; gap: 0.4rem; }
    .av-quick-btn {
        flex: 1; padding: 0.45rem 0; border-radius: 5px; border: 1.5px solid;
        font-family: var(--font-body); font-size: 0.62rem; font-weight: 700;
        letter-spacing: 0.04em; text-transform: uppercase; cursor: pointer; transition: opacity 0.15s;
        display: flex; align-items: center; justify-content: center; gap: 0.3rem;
    }
    .av-quick-btn:hover { opacity: 0.8; }
    .av-quick-btn.av  { background: var(--av-green); color: var(--white); border-color: var(--av-green); }
    .av-quick-btn.un  { background: var(--av-red);   color: var(--white); border-color: var(--av-red); }
    .av-quick-btn.bk  { background: var(--av-gold);  color: var(--white); border-color: var(--av-gold); }

    /* ── SUCCESS ALERT ── */
    .av-alert {
        display: none; align-items: center; gap: 0.6rem;
        padding: 0.75rem 1.1rem; border-radius: 6px;
        font-size: 0.82rem; margin-bottom: 1.25rem;
    }
    .av-alert.show    { display: flex; }
    .av-alert.success { background: #F0FDF4; color: #15803D; border: 1px solid #BBF7D0; }
    .av-alert.error   { background: #FEF2F2; color: #B91C1C; border: 1px solid #FECACA; }
    .av-alert svg { width: 16px; height: 16px; flex-shrink: 0; }

    /* ══════════════════════════════════════════
       MODAL
    ══════════════════════════════════════════ */
    .av-modal-backdrop {
        display: none; position: fixed; inset: 0;
        background: rgba(30,27,24,0.52); z-index: 9000;
        align-items: center; justify-content: center;
        padding: 1.5rem; backdrop-filter: blur(3px);
    }
    .av-modal-backdrop.open { display: flex; }
    .av-modal {
        background: var(--white); border-radius: 8px;
        width: 420px; max-width: 100%;
        border-top: 3px solid var(--gold);
        display: flex; flex-direction: column; overflow: hidden; margin: auto;
        box-shadow: 0 20px 60px rgba(30,27,24,0.22);
        animation: modalIn 0.22s ease;
    }
    @keyframes modalIn { from{opacity:0;transform:translateY(-12px) scale(0.98);}to{opacity:1;transform:none;} }
    .av-modal-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 1.1rem 1.5rem; border-bottom: 1px solid var(--border);
    }
    .av-modal-title { font-family: var(--font-display); font-size: 1.05rem; font-weight: 600; color: var(--charcoal); }
    .av-modal-title em { font-style: italic; color: var(--gold-dark); }
    .av-modal-close {
        width: 28px; height: 28px; border: 1px solid var(--border); background: var(--ivory);
        border-radius: 4px; cursor: pointer; font-size: 15px; color: var(--warm-grey);
        display: flex; align-items: center; justify-content: center; transition: border-color 0.18s,color 0.18s;
    }
    .av-modal-close:hover { border-color: var(--gold); color: var(--gold-dark); }
    .av-modal-body { padding: 1.4rem 1.5rem; }

    /* Date display */
    .av-date-display {
        display: flex; align-items: center; gap: 0.6rem;
        padding: 0.75rem 1rem; border-radius: 6px;
        background: rgba(201,168,76,0.06); border: 1px solid rgba(201,168,76,0.2); margin-bottom: 1.25rem;
    }
    .av-date-icon {
        width: 30px; height: 30px; border-radius: 6px;
        background: rgba(201,168,76,0.12); display: flex; align-items: center;
        justify-content: center; color: var(--gold-dark); flex-shrink: 0;
    }
    .av-date-icon svg { width: 14px; height: 14px; }
    .av-date-lbl { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: #C0B8B0; }
    .av-date-val { font-family: var(--font-display); font-size: 0.9rem; font-weight: 600; color: var(--charcoal); }

    /* Status options */
    .av-field-label { font-size: 0.65rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--warm-grey); margin-bottom: 0.6rem; display: block; }
    .av-status-options { display: flex; flex-direction: column; gap: 0.5rem; }
    .av-status-opt {
        display: flex; align-items: center; gap: 0.75rem;
        padding: 0.75rem 1rem; border-radius: 6px; border: 1.5px solid var(--border);
        cursor: pointer; transition: border-color 0.18s, background 0.18s; background: var(--white);
    }
    .av-status-opt:hover { border-color: var(--border-md); background: var(--ivory); }
    /* Selected states — solid outlines */
    .av-status-opt.sel-available   { border-color: var(--av-green); background: var(--av-green-bg); }
    .av-status-opt.sel-unavailable { border-color: var(--av-red);   background: var(--av-red-bg); }
    .av-status-opt.sel-booked      { border-color: var(--av-gold);  background: var(--av-gold-bg); }

    .av-stt-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
    .av-stt-dot.av { background: var(--av-green); }
    .av-stt-dot.un { background: var(--av-red); }
    .av-stt-dot.bk { background: var(--av-gold); }
    .av-stt-txt { flex: 1; }
    .av-stt-name { font-size: 0.83rem; font-weight: 600; color: var(--charcoal); }
    .av-stt-desc { font-size: 0.68rem; color: var(--warm-grey); margin-top: 1px; }
    .av-stt-chk {
        width: 18px; height: 18px; border-radius: 50%; border: 1.5px solid var(--border-md);
        display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: background 0.15s, border-color 0.15s;
    }
    .av-status-opt.sel-available   .av-stt-chk { background: var(--av-green); border-color: var(--av-green); }
    .av-status-opt.sel-unavailable .av-stt-chk { background: var(--av-red);   border-color: var(--av-red); }
    .av-status-opt.sel-booked      .av-stt-chk { background: var(--av-gold);  border-color: var(--av-gold); }
    .av-stt-chk svg { width: 10px; height: 10px; color: #fff; display: none; }
    .av-status-opt.sel-available .av-stt-chk svg,
    .av-status-opt.sel-unavailable .av-stt-chk svg,
    .av-status-opt.sel-booked .av-stt-chk svg { display: block; }

    /* Modal footer */
    .av-modal-footer {
        padding: 0.9rem 1.5rem; border-top: 1px solid var(--border);
        display: flex; gap: 0.5rem; justify-content: flex-end; align-items: center;
    }
    .av-btn-cancel {
        padding: 0.6rem 1.1rem; border-radius: 5px; border: 1px solid var(--border-md);
        background: var(--white); font-size: 0.78rem; font-weight: 500; color: var(--warm-grey);
        cursor: pointer; font-family: var(--font-body); transition: border-color 0.18s, color 0.18s;
    }
    .av-btn-cancel:hover { border-color: var(--gold); color: var(--charcoal); }
    .av-btn-save {
        padding: 0.6rem 1.4rem; border-radius: 5px; border: none; background: var(--gold);
        color: var(--charcoal); font-size: 0.78rem; font-weight: 600; letter-spacing: 0.04em;
        text-transform: uppercase; cursor: pointer; font-family: var(--font-body);
        transition: background 0.18s, transform 0.15s;
    }
    .av-btn-save:hover  { background: var(--gold-light); transform: translateY(-1px); }
    .av-btn-save:disabled { opacity: 0.45; cursor: not-allowed; transform: none; }
    .av-btn-remove {
        padding: 0.6rem 1rem; border-radius: 5px; border: 1px solid var(--av-red-bd);
        background: transparent; font-size: 0.78rem; font-weight: 500; color: var(--av-red);
        cursor: pointer; font-family: var(--font-body);
        display: none; align-items: center; gap: 0.35rem; transition: background 0.18s; margin-right: auto;
    }
    .av-btn-remove:hover { background: var(--av-red-bg); }
    .av-btn-remove svg  { width: 12px; height: 12px; }
    .av-btn-remove.show { display: flex; }

    @keyframes spin { to { transform: rotate(360deg); } }
    .av-spinner { width: 13px; height: 13px; border: 2px solid var(--border-md); border-top-color: var(--gold); border-radius: 50%; animation: spin 0.7s linear infinite; display: none; }
    .av-spinner.show { display: inline-block; }

    .reveal { opacity:0; transform:translateY(12px); transition:opacity .45s ease, transform .45s ease; }
    .reveal.visible { opacity:1; transform:none; }
    @media(max-width:700px){ .av-page { padding:1.25rem 1rem 3rem; } }
</style>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Availability') }}
    </h2>
</x-slot>

<div class="av-page">

    {{-- Alert --}}
    <div id="avAlert" class="av-alert success">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
        <span id="avAlertMsg">Done.</span>
    </div>

    {{-- Page Header --}}
    <div class="av-page-header reveal">
        <div>
            <h1 class="av-page-title">Availability <em>Calendar</em></h1>
            <p class="av-page-sub">Click any date to set status · Click an existing event to edit or delete</p>
        </div>
        <div class="av-legend">
            <span class="av-legend-label">Legend</span>
            <span class="av-legend-pill av"><span class="av-legend-dot av"></span>Available</span>
            <span class="av-legend-pill un"><span class="av-legend-dot un"></span>Unavailable</span>
            <span class="av-legend-pill bk"><span class="av-legend-dot bk"></span>Booked</span>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="av-stat-row reveal">
        <div class="av-stat-card s-av">
            <div class="av-stat-n" id="cntAv">0</div>
            <div class="av-stat-l">Available Days</div>
        </div>
        <div class="av-stat-card s-un">
            <div class="av-stat-n" id="cntUn">0</div>
            <div class="av-stat-l">Unavailable Days</div>
        </div>
        <div class="av-stat-card s-bk">
            <div class="av-stat-n" id="cntBk">0</div>
            <div class="av-stat-l">Booked Days</div>
        </div>
    </div>

    {{-- Main layout: Calendar + Sidebar --}}
    <div class="av-main-layout reveal">

        {{-- ── CALENDAR ── --}}
        <div class="av-card">
            <div class="av-card-header">
                <div class="av-card-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="3" y="4" width="14" height="13" rx="2"/><path d="M7 2v4M13 2v4M3 9h14"/>
                    </svg>
                </div>
                <div>
                    <div class="av-card-title">Monthly Schedule</div>
                    <div class="av-card-desc">Manage your day-by-day availability</div>
                </div>
            </div>
            <div class="av-card-body">
                <div class="av-cal-wrap">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

        {{-- ── SIDEBAR ── --}}
        <div class="av-sidebar">

            {{-- Upcoming Events card --}}
            <div class="av-sidebar-card">
                <div class="av-sidebar-head">
                    <div class="av-sidebar-head-icon">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="2" y="3" width="12" height="11" rx="2"/><path d="M5 1v3M11 1v3M2 7h12"/>
                            <circle cx="8" cy="11" r="1"/>
                        </svg>
                    </div>
                    <div class="av-sidebar-title">Upcoming Events</div>
                </div>
                <div class="av-upcoming-list" id="upcomingList">
                    {{-- Populated by JS --}}
                    <div class="av-upcoming-empty">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                            <rect x="3" y="4" width="18" height="18" rx="2"/><path d="M8 2v4M16 2v4M3 10h18"/>
                        </svg>
                        <p>No upcoming events</p>
                    </div>
                </div>
                {{-- Quick-add strip --}}
                <div class="av-sidebar-quick">
                    <div class="av-sidebar-quick-label">Quick-set today</div>
                    <div class="av-quick-btns">
                        <button class="av-quick-btn av" onclick="quickSet('available')">
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>Avail.
                        </button>
                        <button class="av-quick-btn un" onclick="quickSet('unavailable')">
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>Unavail.
                        </button>
                        <button class="av-quick-btn bk" onclick="quickSet('booked')">
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>Booked
                        </button>
                    </div>
                </div>
            </div>

            {{-- Mini stats card --}}
            <div class="av-sidebar-card">
                <div class="av-sidebar-head">
                    <div class="av-sidebar-head-icon">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M2 12l4-4 3 3 5-6"/>
                        </svg>
                    </div>
                    <div class="av-sidebar-title">This Month</div>
                </div>
                <div style="padding: 0.85rem 1.1rem; display: flex; flex-direction: column; gap: 0.6rem;">
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <span style="font-size:0.75rem;color:var(--warm-grey);display:flex;align-items:center;gap:0.4rem;">
                            <span style="width:8px;height:8px;border-radius:50%;background:var(--av-green);display:inline-block;flex-shrink:0;"></span>Available
                        </span>
                        <span id="sideAvCount" style="font-family:var(--font-display);font-size:0.88rem;font-weight:700;color:var(--av-green);">0</span>
                    </div>
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <span style="font-size:0.75rem;color:var(--warm-grey);display:flex;align-items:center;gap:0.4rem;">
                            <span style="width:8px;height:8px;border-radius:50%;background:var(--av-red);display:inline-block;flex-shrink:0;"></span>Unavailable
                        </span>
                        <span id="sideUnCount" style="font-family:var(--font-display);font-size:0.88rem;font-weight:700;color:var(--av-red);">0</span>
                    </div>
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <span style="font-size:0.75rem;color:var(--warm-grey);display:flex;align-items:center;gap:0.4rem;">
                            <span style="width:8px;height:8px;border-radius:50%;background:var(--av-gold);display:inline-block;flex-shrink:0;"></span>Booked
                        </span>
                        <span id="sideBkCount" style="font-family:var(--font-display);font-size:0.88rem;font-weight:700;color:var(--av-gold);">0</span>
                    </div>
                    {{-- Availability bar --}}
                    <div style="margin-top:0.25rem;">
                        <div style="font-size:0.6rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--warm-grey);margin-bottom:0.35rem;">Availability Rate</div>
                        <div style="height:6px;background:var(--border);border-radius:3px;overflow:hidden;">
                            <div id="avBar" style="height:100%;border-radius:3px;background:var(--av-green);transition:width 0.5s;width:0%;"></div>
                        </div>
                        <div id="avRate" style="font-size:0.68rem;color:var(--warm-grey);margin-top:0.3rem;text-align:right;">0%</div>
                    </div>
                </div>
            </div>

        </div>{{-- /sidebar --}}
    </div>{{-- /main-layout --}}

</div>

{{-- ── MODAL ── --}}
<div id="avModal" class="av-modal-backdrop">
    <div class="av-modal">
        <div class="av-modal-header">
            <span class="av-modal-title" id="avModalTitle">Set <em>Availability</em></span>
            <button class="av-modal-close" onclick="closeAvModal()">✕</button>
        </div>
        <div class="av-modal-body">
            <div class="av-date-display">
                <div class="av-date-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="4" width="14" height="13" rx="2"/><path d="M7 2v4M13 2v4M3 9h14"/></svg>
                </div>
                <div>
                    <div class="av-date-lbl">Selected Date</div>
                    <div class="av-date-val" id="avDisplayDate">—</div>
                </div>
            </div>

            <label class="av-field-label">Choose a status</label>
            <div class="av-status-options">
                <div class="av-status-opt" data-value="available" onclick="pickStatus(this)">
                    <span class="av-stt-dot av"></span>
                    <div class="av-stt-txt">
                        <div class="av-stt-name">Available</div>
                        <div class="av-stt-desc">Open for booking on this date</div>
                    </div>
                    <div class="av-stt-chk"><svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 5l2 2 4-4"/></svg></div>
                </div>
                <div class="av-status-opt" data-value="unavailable" onclick="pickStatus(this)">
                    <span class="av-stt-dot un"></span>
                    <div class="av-stt-txt">
                        <div class="av-stt-name">Unavailable</div>
                        <div class="av-stt-desc">Not accepting bookings on this date</div>
                    </div>
                    <div class="av-stt-chk"><svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 5l2 2 4-4"/></svg></div>
                </div>
                <div class="av-status-opt" data-value="booked" onclick="pickStatus(this)">
                    <span class="av-stt-dot bk"></span>
                    <div class="av-stt-txt">
                        <div class="av-stt-name">Booked</div>
                        <div class="av-stt-desc">Already scheduled for an event</div>
                    </div>
                    <div class="av-stt-chk"><svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 5l2 2 4-4"/></svg></div>
                </div>
            </div>
        </div>
        <div class="av-modal-footer">
            <button type="button" class="av-btn-remove" id="avRemoveBtn" onclick="doDelete()">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M3 4h10M6 4V3h4v1M5 4v8a1 1 0 001 1h4a1 1 0 001-1V4"/></svg>
                Delete
            </button>
            <div class="av-spinner" id="avSpinner"></div>
            <button type="button" class="av-btn-cancel" onclick="closeAvModal()">Cancel</button>
            <button type="button" class="av-btn-save" id="avSaveBtn" onclick="doSave()" disabled>Save</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    let pickedStatus = null;
    let editEventId  = null;
    let rawData      = [];

    /* ════════════════════════════════
       STANDALONE STATS FETCHER
       — called on boot AND after every save/delete
    ════════════════════════════════ */
    function fetchStats() {
        fetch("{{ route('supplier.availability.events') }}")
            .then(r => r.json())
            .then(data => {
                rawData = Array.isArray(data) ? data : [];
                refreshStats();
                renderUpcoming();
            })
            .catch(() => {});
    }

    /* ════════════════════════════════
       CALENDAR
    ════════════════════════════════ */
    const cal = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView:   'dayGridMonth',
        headerToolbar: {
            left:   'prev,next today',
            center: 'title',
            right:  'dayGridMonth,dayGridWeek'
        },
        buttonText: { today: 'Today', month: 'Month', week: 'Week' },

        events: {
            url:    "{{ route('supplier.availability.events') }}",
            method: 'GET',
            success: function(data) {
                rawData = Array.isArray(data) ? data : [];
                refreshStats();
                renderUpcoming();
            }
        },

        /* ── Solid event colors via className ── */
        eventDidMount: function(info) {
            const status = info.event.extendedProps.status
                        || info.event.title.toLowerCase();
            ['ev-available','ev-unavailable','ev-booked'].forEach(c => info.el.classList.remove(c));
            info.el.classList.add('ev-' + status);
        },

        dateClick: function(info) {
            openCreateModal(info.dateStr);
        },

        eventClick: function(info) {
            openEditModal(
                info.event.id,
                info.event.startStr,
                info.event.extendedProps.status || info.event.title.toLowerCase()
            );
        }
    });

    cal.render();

    /* Boot: fetch stats independently so counters populate immediately */
    fetchStats();

    /* ════════════════════════════════
       STATS
    ════════════════════════════════ */
    function refreshStats() {
        const c = { available: 0, unavailable: 0, booked: 0 };
        rawData.forEach(ev => {
            const s = ev.status || (ev.extendedProps && ev.extendedProps.status);
            if (s && c[s] !== undefined) c[s]++;
        });
        document.getElementById('cntAv').textContent = c.available;
        document.getElementById('cntUn').textContent = c.unavailable;
        document.getElementById('cntBk').textContent = c.booked;

        /* sidebar month stats */
        const now = new Date();
        const month = now.getMonth();
        const year  = now.getFullYear();
        const mc = { available: 0, unavailable: 0, booked: 0 };
        rawData.forEach(ev => {
            const s = ev.status || (ev.extendedProps && ev.extendedProps.status);
            const d = new Date((ev.date || ev.start || ev.startStr || '').slice(0,10) + 'T00:00:00');
            if (!isNaN(d) && d.getMonth() === month && d.getFullYear() === year && s && mc[s] !== undefined) {
                mc[s]++;
            }
        });
        document.getElementById('sideAvCount').textContent = mc.available;
        document.getElementById('sideUnCount').textContent = mc.unavailable;
        document.getElementById('sideBkCount').textContent = mc.booked;

        const total = mc.available + mc.unavailable + mc.booked;
        const rate  = total > 0 ? Math.round((mc.available / total) * 100) : 0;
        document.getElementById('avBar').style.width = rate + '%';
        document.getElementById('avRate').textContent = rate + '%';
    }

    /* ════════════════════════════════
       UPCOMING EVENTS SIDEBAR
    ════════════════════════════════ */
    function renderUpcoming() {
        const today = new Date(); today.setHours(0,0,0,0);
        const upcoming = rawData
            .filter(ev => {
                const dateKey = (ev.date || ev.start || ev.startStr || '').slice(0,10);
                const d = new Date(dateKey + 'T00:00:00');
                return !isNaN(d) && d >= today;
            })
            .sort((a,b) => {
                const da = new Date((a.date || a.start || a.startStr || '').slice(0,10) + 'T00:00:00');
                const db = new Date((b.date || b.start || b.startStr || '').slice(0,10) + 'T00:00:00');
                return da - db;
            })
            .slice(0, 15);

        const list = document.getElementById('upcomingList');
        if (!upcoming.length) {
            list.innerHTML = `<div class="av-upcoming-empty">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                    <rect x="3" y="4" width="18" height="18" rx="2"/><path d="M8 2v4M16 2v4M3 10h18"/>
                </svg><p>No upcoming events</p></div>`;
            return;
        }

        const abbr  = { available: 'av', unavailable: 'un', booked: 'bk' };
        const label = { available: 'Available', unavailable: 'Unavailable', booked: 'Booked' };

        list.innerHTML = upcoming.map(ev => {
            const status  = ev.status || (ev.extendedProps && ev.extendedProps.status) || 'available';
            const dateKey = (ev.date || ev.start || ev.startStr || '').slice(0,10);
            const d       = new Date(dateKey + 'T00:00:00');
            const cls     = abbr[status] || 'av';
            const isToday = d.toDateString() === today.toDateString();
            const dateStr = d.toLocaleDateString('en-PH', { month: 'short', day: 'numeric', year: 'numeric' });
            const dayStr  = isToday ? '📌 Today' : d.toLocaleDateString('en-PH', { weekday: 'long' });
            return `
            <div class="av-upcoming-item" onclick="upcomingClick('${ev.id}','${dateKey}','${status}')">
                <div class="av-upcoming-bar ${cls}"></div>
                <div class="av-upcoming-content">
                    <div class="av-upcoming-date">${dateStr}</div>
                    <div class="av-upcoming-day">${dayStr}</div>
                    <span class="av-upcoming-badge ${cls}">
                        <span style="width:5px;height:5px;border-radius:50%;background:currentColor;display:inline-block;flex-shrink:0;"></span>
                        ${label[status]}
                    </span>
                </div>
                <div class="av-upcoming-chevron"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 2l4 4-4 4"/></svg></div>
            </div>`;
        }).join('');
    }

    window.upcomingClick = function(id, dateStr, status) {
        openEditModal(id, dateStr, status);
    };

    /* ════════════════════════════════
       QUICK-SET TODAY
    ════════════════════════════════ */
    window.quickSet = function(status) {
        const today   = new Date();
        const dateStr = today.toISOString().slice(0, 10);
        setBusy(true);
        fetch("{{ route('supplier.availability.store') }}", {
            method:  'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body:    JSON.stringify({ date: dateStr, status: status })
        })
        .then(r => { if (!r.ok) throw new Error(r.status); return r.json(); })
        .then(() => { toast('Today set as ' + status + '.'); cal.refetchEvents(); })
        .catch(() => toast('Error saving.', 'error'))
        .finally(() => setBusy(false));
    };

    /* ════════════════════════════════
       MODAL OPEN — CREATE
    ════════════════════════════════ */
    function openCreateModal(dateStr) {
        editEventId  = null; pickedStatus = null;
        document.getElementById('avModal').dataset.date = dateStr;
        document.getElementById('avDisplayDate').textContent  = fmtDate(dateStr);
        document.getElementById('avModalTitle').innerHTML     = 'Set <em>Availability</em>';
        document.querySelectorAll('.av-status-opt').forEach(o => o.className = 'av-status-opt');
        document.getElementById('avSaveBtn').disabled = true;
        document.getElementById('avRemoveBtn').classList.remove('show');
        document.getElementById('avSpinner').classList.remove('show');
        document.getElementById('avModal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    /* ════════════════════════════════
       MODAL OPEN — EDIT
    ════════════════════════════════ */
    function openEditModal(id, dateStr, existingStatus) {
        editEventId = id; pickedStatus = existingStatus;
        document.getElementById('avModal').dataset.date    = dateStr.slice(0,10);
        document.getElementById('avModal').dataset.eventId = id;
        document.getElementById('avDisplayDate').textContent = fmtDate(dateStr.slice(0,10));
        document.getElementById('avModalTitle').innerHTML    = 'Edit <em>Availability</em>';
        document.querySelectorAll('.av-status-opt').forEach(o => o.className = 'av-status-opt');
        const opt = document.querySelector(`.av-status-opt[data-value="${existingStatus}"]`);
        if (opt) opt.classList.add('sel-' + existingStatus);
        document.getElementById('avSaveBtn').disabled = false;
        document.getElementById('avRemoveBtn').classList.add('show');
        document.getElementById('avSpinner').classList.remove('show');
        document.getElementById('avModal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    /* ════════════════════════════════
       PICK STATUS
    ════════════════════════════════ */
    window.pickStatus = function(el) {
        document.querySelectorAll('.av-status-opt').forEach(o => o.className = 'av-status-opt');
        const v = el.dataset.value;
        el.classList.add('sel-' + v);
        pickedStatus = v;
        document.getElementById('avSaveBtn').disabled = false;
    };

    /* ════════════════════════════════
       CLOSE MODAL
    ════════════════════════════════ */
    window.closeAvModal = function() {
        document.getElementById('avModal').classList.remove('open');
        document.body.style.overflow = '';
        pickedStatus = null; editEventId = null;
    };

    /* ════════════════════════════════
       SAVE (create or update)
    ════════════════════════════════ */
    window.doSave = function() {
        if (!pickedStatus) return;
        setBusy(true);

        if (editEventId) {
            fetch("{{ route('supplier.availability.update') }}", {
                method:  'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body:    JSON.stringify({ id: editEventId, status: pickedStatus })
            })
            .then(r => { if (!r.ok) throw new Error(r.status); return r.json(); })
            .then(() => { closeAvModal(); toast('Availability updated.'); cal.refetchEvents(); fetchStats(); })
            .catch(() => { setBusy(false); toast('Error saving.', 'error'); });
        } else {
            fetch("{{ route('supplier.availability.store') }}", {
                method:  'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body:    JSON.stringify({ date: document.getElementById('avModal').dataset.date, status: pickedStatus })
            })
            .then(r => { if (!r.ok) throw new Error(r.status); return r.json(); })
            .then(() => { closeAvModal(); toast('Availability saved.'); cal.refetchEvents(); fetchStats(); })
            .catch(() => { setBusy(false); toast('Error saving.', 'error'); });
        }
    };

    /* ════════════════════════════════
       DELETE
    ════════════════════════════════ */
    window.doDelete = function() {
        const id = document.getElementById('avModal').dataset.eventId;
        setBusy(true);
        fetch('/supplier/availability/' + id, {
            method:  'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(r => { if (!r.ok) throw new Error(r.status); return r.json(); })
        .then(() => { closeAvModal(); toast('Availability removed.'); cal.refetchEvents(); fetchStats(); })
        .catch(() => { setBusy(false); toast('Error deleting.', 'error'); });
    };

    /* ── Override refetchEvents to also refresh stats ── */
    const origRefetch = cal.refetchEvents.bind(cal);
    cal.refetchEvents = function() {
        origRefetch();
        fetchStats();
    };

    /* ── HELPERS ── */
    function setBusy(on) {
        document.getElementById('avSpinner').classList.toggle('show', on);
        document.getElementById('avSaveBtn').disabled = on;
        if (!on) document.getElementById('avRemoveBtn').classList.toggle('show', !!editEventId);
    }

    function fmtDate(str) {
        const d = new Date(str + 'T00:00:00');
        return d.toLocaleDateString('en-PH', { weekday:'long', year:'numeric', month:'long', day:'numeric' });
    }

    function toast(msg, type = 'success') {
        const el = document.getElementById('avAlert');
        el.className = 'av-alert ' + type;
        document.getElementById('avAlertMsg').textContent = msg;
        el.classList.add('show');
        setTimeout(() => el.classList.remove('show'), 3500);
    }

    /* Backdrop click / ESC */
    document.getElementById('avModal').addEventListener('click', e => {
        if (e.target === document.getElementById('avModal')) closeAvModal();
    });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeAvModal(); });

    /* Scroll reveal */
    const io = new IntersectionObserver(entries => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 80);
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.07 });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));
});
</script>

</x-supplier-layout>