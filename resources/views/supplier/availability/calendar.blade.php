<x-supplier-layout>

<!-- FullCalendar CDN -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap');

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
        --s-available:   #16A34A;
        --s-unavailable: #B91C1C;
        --s-booked:      #8A6A1F;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    /* ── PAGE ── */
    .av-page { padding: 1.75rem 2rem 4rem; max-width: 1100px; font-family: var(--font-body); }

    /* ── PAGE HEADER ── */
    .av-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem; }
    .av-page-title  { font-family: var(--font-display); font-size: clamp(1.3rem,2.5vw,1.8rem); font-weight: 700; color: var(--charcoal); line-height: 1.15; }
    .av-page-title em { color: var(--gold-dark); font-style: italic; }
    .av-page-sub    { font-size: 0.78rem; color: var(--warm-grey); margin-top: 0.25rem; }

    /* ── LEGEND ── */
    .av-legend { display: flex; align-items: center; gap: 1.1rem; flex-wrap: wrap; padding: 0.65rem 1rem; background: var(--white); border: 1px solid var(--border); border-radius: 4px; align-self: flex-end; }
    .av-legend-label { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); }
    .av-legend-item { display: flex; align-items: center; gap: 0.35rem; }
    .av-legend-dot { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; }
    .av-legend-dot.av  { background: var(--s-available); }
    .av-legend-dot.un  { background: var(--s-unavailable); }
    .av-legend-dot.bk  { background: var(--s-booked); }
    .av-legend-text { font-size: 0.72rem; color: var(--warm-grey); }

    /* ── STAT CARDS ── */
    .av-stat-row { display: grid; grid-template-columns: repeat(3,1fr); gap: 1rem; margin-bottom: 1.5rem; }
    @media(max-width:640px){ .av-stat-row { grid-template-columns: 1fr 1fr; } }
    .av-stat-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; padding: 1.1rem 1.25rem; position: relative; overflow: hidden; }
    .av-stat-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; }
    .av-stat-card.s-av::before  { background: var(--s-available); }
    .av-stat-card.s-un::before  { background: var(--s-unavailable); }
    .av-stat-card.s-bk::before  { background: linear-gradient(90deg,var(--gold),var(--blush-deep)); }
    .av-stat-n { font-family: var(--font-display); font-size: 1.8rem; font-weight: 700; color: var(--gold-dark); line-height: 1; }
    .av-stat-l { font-size: 0.62rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); margin-top: 3px; }

    /* ── SUCCESS ALERT ── */
    .av-alert { display: none; align-items: center; gap: 0.6rem; padding: 0.75rem 1.1rem; border-radius: 4px; font-size: 0.82rem; margin-bottom: 1.25rem; }
    .av-alert.show { display: flex; }
    .av-alert.success { background: #F0FDF4; color: #15803D; border: 1px solid #BBF7D0; }
    .av-alert.error   { background: #FEF2F2; color: #B91C1C; border: 1px solid #FECACA; }
    .av-alert svg { width: 16px; height: 16px; flex-shrink: 0; }

    /* ── CALENDAR CARD ── */
    .av-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; overflow: hidden; }
    .av-card-header { padding: 1.1rem 1.5rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 0.75rem; }
    .av-card-icon { width: 34px; height: 34px; border-radius: 8px; background: rgba(201,168,76,0.1); display: flex; align-items: center; justify-content: center; color: var(--gold-dark); flex-shrink: 0; }
    .av-card-icon svg { width: 16px; height: 16px; }
    .av-card-title { font-family: var(--font-display); font-size: 0.95rem; font-weight: 700; color: var(--charcoal); }
    .av-card-desc { font-size: 0.72rem; color: var(--warm-grey); margin-top: 0.1rem; }
    .av-card-body { padding: 1.5rem; }

    /* ── FULLCALENDAR OVERRIDES ── */
    .av-cal-wrap .fc { font-family: var(--font-body); }
    .av-cal-wrap .fc-toolbar-title { font-family: var(--font-display); font-size: 1.15rem; font-weight: 700; color: var(--charcoal); }
    .av-cal-wrap .fc-button { background: var(--white) !important; border: 1px solid var(--border-md) !important; color: var(--warm-grey) !important; border-radius: 3px !important; font-family: var(--font-body) !important; font-size: 0.72rem !important; font-weight: 500 !important; letter-spacing: 0.04em !important; text-transform: uppercase !important; padding: 0.38rem 0.85rem !important; box-shadow: none !important; transition: border-color 0.18s,color 0.18s !important; }
    .av-cal-wrap .fc-button:hover { border-color: var(--gold) !important; color: var(--gold-dark) !important; }
    .av-cal-wrap .fc-button-active, .av-cal-wrap .fc-button-primary:not(:disabled):active { background: var(--charcoal) !important; border-color: var(--charcoal) !important; color: var(--white) !important; }
    .av-cal-wrap .fc-col-header-cell { background: rgba(201,168,76,0.04); border-color: var(--border) !important; }
    .av-cal-wrap .fc-col-header-cell-cushion { font-size: 0.65rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--gold-dark); text-decoration: none; padding: 0.55rem 0; }
    .av-cal-wrap .fc-daygrid-day { border-color: var(--border) !important; cursor: pointer; transition: background 0.15s; }
    .av-cal-wrap .fc-daygrid-day:hover { background: rgba(201,168,76,0.04) !important; }
    .av-cal-wrap .fc-daygrid-day-number { font-size: 0.78rem; color: var(--warm-grey); text-decoration: none; padding: 6px 8px; }
    .av-cal-wrap .fc-day-today { background: rgba(201,168,76,0.06) !important; }
    .av-cal-wrap .fc-day-today .fc-daygrid-day-number { color: var(--gold-dark); font-weight: 700; }
    .av-cal-wrap .fc-event { border: none !important; border-radius: 3px !important; font-family: var(--font-body) !important; font-size: 0.65rem !important; font-weight: 600 !important; letter-spacing: 0.04em !important; text-transform: uppercase !important; padding: 2px 6px !important; cursor: pointer !important; }
    .av-cal-wrap .fc-event.ev-available   { background: rgba(22,163,74,0.12) !important; color: var(--s-available) !important; }
    .av-cal-wrap .fc-event.ev-unavailable { background: rgba(185,28,28,0.1) !important;  color: var(--s-unavailable) !important; }
    .av-cal-wrap .fc-event.ev-booked      { background: rgba(201,168,76,0.15) !important; color: var(--s-booked) !important; }
    .av-cal-wrap .fc-scrollgrid, .av-cal-wrap .fc-scrollgrid td, .av-cal-wrap .fc-scrollgrid th { border-color: var(--border) !important; }

    /* ── MODAL BACKDROP ── */
    .av-modal-backdrop { display: none; position: fixed; inset: 0; background: rgba(30,27,24,0.52); z-index: 200; align-items: center; justify-content: center; padding: 1.5rem; backdrop-filter: blur(3px); }
    .av-modal-backdrop.open { display: flex; }
    .av-modal { background: var(--white); border-radius: 4px; width: 420px; max-width: 100%; border-top: 2px solid var(--gold); display: flex; flex-direction: column; overflow: hidden; margin: auto; box-shadow: 0 20px 60px rgba(30,27,24,0.22); animation: modalIn 0.22s ease; }
    @keyframes modalIn { from{opacity:0;transform:translateY(-12px) scale(0.98);}to{opacity:1;transform:none;} }
    .av-modal-header { display: flex; align-items: center; justify-content: space-between; padding: 1.1rem 1.5rem; border-bottom: 1px solid var(--border); }
    .av-modal-title { font-family: var(--font-display); font-size: 1.05rem; font-weight: 600; color: var(--charcoal); }
    .av-modal-title em { font-style: italic; color: var(--gold-dark); }
    .av-modal-close { width: 28px; height: 28px; border: 1px solid var(--border); background: var(--ivory); border-radius: 3px; cursor: pointer; font-size: 15px; color: var(--warm-grey); display: flex; align-items: center; justify-content: center; transition: border-color 0.18s,color 0.18s; }
    .av-modal-close:hover { border-color: var(--gold); color: var(--gold-dark); }
    .av-modal-body { padding: 1.4rem 1.5rem; }

    /* ── DATE DISPLAY ── */
    .av-date-display { display: flex; align-items: center; gap: 0.6rem; padding: 0.75rem 1rem; border-radius: 4px; background: rgba(201,168,76,0.06); border: 1px solid rgba(201,168,76,0.2); margin-bottom: 1.25rem; }
    .av-date-icon { width: 30px; height: 30px; border-radius: 6px; background: rgba(201,168,76,0.12); display: flex; align-items: center; justify-content: center; color: var(--gold-dark); flex-shrink: 0; }
    .av-date-icon svg { width: 14px; height: 14px; }
    .av-date-lbl { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: #C0B8B0; }
    .av-date-val { font-family: var(--font-display); font-size: 0.9rem; font-weight: 600; color: var(--charcoal); }

    /* ── STATUS OPTIONS ── */
    .av-field-label { font-size: 0.65rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--warm-grey); margin-bottom: 0.6rem; display: block; }
    .av-status-options { display: flex; flex-direction: column; gap: 0.5rem; }
    .av-status-opt { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; border-radius: 4px; border: 1.5px solid var(--border); cursor: pointer; transition: border-color 0.18s,background 0.18s; background: var(--white); }
    .av-status-opt:hover { border-color: var(--border-md); background: var(--ivory); }
    .av-status-opt.sel-available   { border-color: var(--s-available);   background: rgba(22,163,74,0.05); }
    .av-status-opt.sel-unavailable { border-color: var(--s-unavailable); background: rgba(185,28,28,0.04); }
    .av-status-opt.sel-booked      { border-color: var(--gold);          background: rgba(201,168,76,0.06); }
    .av-stt-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
    .av-stt-dot.av { background: var(--s-available); }
    .av-stt-dot.un { background: var(--s-unavailable); }
    .av-stt-dot.bk { background: var(--gold); }
    .av-stt-txt { flex: 1; }
    .av-stt-name { font-size: 0.83rem; font-weight: 600; color: var(--charcoal); }
    .av-stt-desc { font-size: 0.68rem; color: var(--warm-grey); margin-top: 1px; }
    .av-stt-chk { width: 18px; height: 18px; border-radius: 50%; border: 1.5px solid var(--border-md); display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: background 0.15s,border-color 0.15s; }
    .av-status-opt.sel-available   .av-stt-chk { background: var(--s-available);   border-color: var(--s-available); }
    .av-status-opt.sel-unavailable .av-stt-chk { background: var(--s-unavailable); border-color: var(--s-unavailable); }
    .av-status-opt.sel-booked      .av-stt-chk { background: var(--gold);          border-color: var(--gold); }
    .av-stt-chk svg { width: 10px; height: 10px; color: #fff; display: none; }
    .av-status-opt.sel-available .av-stt-chk svg,
    .av-status-opt.sel-unavailable .av-stt-chk svg,
    .av-status-opt.sel-booked .av-stt-chk svg { display: block; }

    /* ── MODAL FOOTER ── */
    .av-modal-footer { padding: 0.9rem 1.5rem; border-top: 1px solid var(--border); display: flex; gap: 0.5rem; justify-content: flex-end; align-items: center; }
    .av-btn-cancel { padding: 0.6rem 1.1rem; border-radius: 4px; border: 1px solid var(--border-md); background: var(--white); font-size: 0.78rem; font-weight: 500; color: var(--warm-grey); cursor: pointer; font-family: var(--font-body); transition: border-color 0.18s,color 0.18s; }
    .av-btn-cancel:hover { border-color: var(--gold); color: var(--charcoal); }
    .av-btn-save { padding: 0.6rem 1.4rem; border-radius: 4px; border: none; background: var(--gold); color: var(--charcoal); font-size: 0.78rem; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase; cursor: pointer; font-family: var(--font-body); transition: background 0.18s,transform 0.15s; }
    .av-btn-save:hover { background: var(--gold-light); transform: translateY(-1px); }
    .av-btn-save:disabled { opacity: 0.45; cursor: not-allowed; transform: none; }
    .av-btn-remove { padding: 0.6rem 1rem; border-radius: 4px; border: 1px solid #FCA5A5; background: transparent; font-size: 0.78rem; font-weight: 500; color: #B91C1C; cursor: pointer; font-family: var(--font-body); display: none; align-items: center; gap: 0.35rem; transition: background 0.18s; margin-right: auto; }
    .av-btn-remove:hover { background: #FEF2F2; }
    .av-btn-remove svg { width: 12px; height: 12px; }
    .av-btn-remove.show { display: flex; }

    /* ── EDIT CONFIRM MODAL ── */
    .av-confirm-modal { background: var(--white); border-radius: 4px; width: 380px; max-width: 100%; border-top: 2px solid var(--gold-dark); display: flex; flex-direction: column; overflow: hidden; margin: auto; box-shadow: 0 20px 60px rgba(30,27,24,0.22); animation: modalIn 0.22s ease; }
    .av-confirm-body { padding: 1.4rem 1.5rem; }
    .av-confirm-title { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--charcoal); margin-bottom: 0.5rem; }
    .av-confirm-sub { font-size: 0.8rem; color: var(--warm-grey); line-height: 1.55; margin-bottom: 1.25rem; }
    .av-confirm-btns { display: flex; gap: 0.5rem; }
    .av-confirm-btn-edit { flex: 1; padding: 0.6rem; border-radius: 4px; border: none; background: var(--gold); color: var(--charcoal); font-size: 0.78rem; font-weight: 600; cursor: pointer; font-family: var(--font-body); transition: background 0.18s; }
    .av-confirm-btn-edit:hover { background: var(--gold-light); }
    .av-confirm-btn-delete { flex: 1; padding: 0.6rem; border-radius: 4px; border: 1px solid #FCA5A5; background: transparent; color: #B91C1C; font-size: 0.78rem; font-weight: 500; cursor: pointer; font-family: var(--font-body); transition: background 0.18s; }
    .av-confirm-btn-delete:hover { background: #FEF2F2; }

    @keyframes spin { to { transform: rotate(360deg); } }
    .av-spinner { width: 13px; height: 13px; border: 2px solid var(--border-md); border-top-color: var(--gold); border-radius: 50%; animation: spin 0.7s linear infinite; display: none; }
    .av-spinner.show { display: inline-block; }

    .reveal { opacity:0; transform:translateY(12px); transition:opacity .45s ease,transform .45s ease; }
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
            <p class="av-page-sub">Click a date to set status. Click an existing event to edit or delete.</p>
        </div>
        <div class="av-legend">
            <span class="av-legend-label">Legend</span>
            <div class="av-legend-item"><span class="av-legend-dot av"></span><span class="av-legend-text">Available</span></div>
            <div class="av-legend-item"><span class="av-legend-dot un"></span><span class="av-legend-text">Unavailable</span></div>
            <div class="av-legend-item"><span class="av-legend-dot bk"></span><span class="av-legend-text">Booked</span></div>
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

    {{-- Calendar Card --}}
    <div class="av-card reveal">
        <div class="av-card-header">
            <div class="av-card-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <rect x="3" y="4" width="14" height="13" rx="2"/>
                    <path d="M7 2v4M13 2v4M3 9h14"/>
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

</div>

{{-- ── CREATE / EDIT MODAL ── --}}
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
                    <div class="av-stt-txt"><div class="av-stt-name">Available</div><div class="av-stt-desc">Open for booking on this date</div></div>
                    <div class="av-stt-chk"><svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 5l2 2 4-4"/></svg></div>
                </div>
                <div class="av-status-opt" data-value="unavailable" onclick="pickStatus(this)">
                    <span class="av-stt-dot un"></span>
                    <div class="av-stt-txt"><div class="av-stt-name">Unavailable</div><div class="av-stt-desc">Not accepting bookings on this date</div></div>
                    <div class="av-stt-chk"><svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 5l2 2 4-4"/></svg></div>
                </div>
                <div class="av-status-opt" data-value="booked" onclick="pickStatus(this)">
                    <span class="av-stt-dot bk"></span>
                    <div class="av-stt-txt"><div class="av-stt-name">Booked</div><div class="av-stt-desc">Already scheduled for an event</div></div>
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
    let editEventId  = null;   // null = create mode, ID = edit mode
    let rawData      = [];

    /* ════════════════════════════════
       CALENDAR
    ════════════════════════════════ */
    const cal = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left:   'prev,next today',
            center: 'title',
            right:  'dayGridMonth,dayGridWeek'
        },
        buttonText: { today: 'Today', month: 'Month', week: 'Week' },

        /* ── Fetch events (original logic preserved) ── */
        events: {
            url:    "{{ route('supplier.availability.events') }}",
            method: 'GET',
            success: function(data) {
                rawData = Array.isArray(data) ? data : [];
                refreshStats();
            }
        },

        /* map className for colour ── new addition */
        eventDidMount: function(info) {
            const s = info.event.extendedProps.status || info.event.title.toLowerCase();
            info.el.classList.add('ev-' + s);
        },

        /* ── dateClick: CREATE (original logic) ── */
        dateClick: function(info) {
            openCreateModal(info.dateStr);
        },

        /* ── eventClick: EDIT / DELETE (original logic kept, styled UI replaces confirm/prompt) ── */
        eventClick: function(info) {
            openEditModal(
                info.event.id,
                info.event.startStr,
                info.event.extendedProps.status || info.event.title.toLowerCase()
            );
        }
    });

    cal.render();

    /* ════════════════════════════════
       STATS
    ════════════════════════════════ */
    function refreshStats() {
        const c = { available: 0, unavailable: 0, booked: 0 };
        rawData.forEach(ev => { const s = ev.status; if (c[s] !== undefined) c[s]++; });
        document.getElementById('cntAv').textContent = c.available;
        document.getElementById('cntUn').textContent = c.unavailable;
        document.getElementById('cntBk').textContent = c.booked;
    }

    /* ════════════════════════════════
       OPEN — CREATE mode
    ════════════════════════════════ */
    function openCreateModal(dateStr) {
        editEventId  = null;
        pickedStatus = null;
        document.getElementById('avModal').dataset.date = dateStr;
        document.getElementById('avDisplayDate').textContent = fmtDate(dateStr);
        document.getElementById('avModalTitle').innerHTML   = 'Set <em>Availability</em>';
        document.querySelectorAll('.av-status-opt').forEach(o => o.className = 'av-status-opt');
        document.getElementById('avSaveBtn').disabled = true;
        document.getElementById('avRemoveBtn').classList.remove('show');
        document.getElementById('avSpinner').classList.remove('show');
        document.getElementById('avModal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    /* ════════════════════════════════
       OPEN — EDIT mode  (replaces confirm+prompt)
    ════════════════════════════════ */
    function openEditModal(id, dateStr, existingStatus) {
        editEventId  = id;
        pickedStatus = existingStatus;
        document.getElementById('avModal').dataset.date     = dateStr.slice(0, 10);
        document.getElementById('avModal').dataset.eventId  = id;
        document.getElementById('avDisplayDate').textContent = fmtDate(dateStr.slice(0, 10));
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
       CLOSE
    ════════════════════════════════ */
    window.closeAvModal = function() {
        document.getElementById('avModal').classList.remove('open');
        document.body.style.overflow = '';
        pickedStatus = null;
        editEventId  = null;
    };

    /* ════════════════════════════════
       SAVE — CREATE or UPDATE (original routes preserved)
    ════════════════════════════════ */
    window.doSave = function() {
        if (!pickedStatus) return;
        setBusy(true);

        if (editEventId) {
            /* ── UPDATE (original route: supplier.availability.update) ── */
            fetch("{{ route('supplier.availability.update') }}", {
                method:  'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body:    JSON.stringify({ id: editEventId, status: pickedStatus })
            })
            .then(r => { if (!r.ok) throw new Error(r.status); return r.json(); })
            .then(() => { closeAvModal(); toast('Availability updated.'); cal.refetchEvents(); })
            .catch(() => setBusy(false));

        } else {
            /* ── CREATE (original route: supplier.availability.store) ── */
            fetch("{{ route('supplier.availability.store') }}", {
                method:  'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body:    JSON.stringify({
                    date:   document.getElementById('avModal').dataset.date,
                    status: pickedStatus
                })
            })
            .then(r => { if (!r.ok) throw new Error(r.status); return r.json(); })
            .then(() => { closeAvModal(); toast('Availability saved.'); cal.refetchEvents(); })
            .catch(() => setBusy(false));
        }
    };

    /* ════════════════════════════════
       DELETE (original route: /supplier/availability/{id})
    ════════════════════════════════ */
    window.doDelete = function() {
        const id = document.getElementById('avModal').dataset.eventId;
        setBusy(true);

        fetch('/supplier/availability/' + id, {
            method:  'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(r => { if (!r.ok) throw new Error(r.status); return r.json(); })
        .then(() => { closeAvModal(); toast('Availability removed.'); cal.refetchEvents(); })
        .catch(() => setBusy(false));
    };

    /* ── HELPERS ── */
    function setBusy(on) {
        document.getElementById('avSpinner').classList.toggle('show', on);
        document.getElementById('avSaveBtn').disabled   = on;
        if (!on) document.getElementById('avRemoveBtn').classList.toggle('show', !!editEventId);
    }

    function fmtDate(str) {
        const d = new Date(str + 'T00:00:00');
        return d.toLocaleDateString('en-PH', { weekday:'long', year:'numeric', month:'long', day:'numeric' });
    }

    function toast(msg, type = 'success') {
        const el  = document.getElementById('avAlert');
        const msg$ = document.getElementById('avAlertMsg');
        el.className = 'av-alert ' + type;
        msg$.textContent = msg;
        el.classList.add('show');
        setTimeout(() => el.classList.remove('show'), 3500);
    }

    document.getElementById('avModal').addEventListener('click', e => {
        if (e.target === document.getElementById('avModal')) closeAvModal();
    });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeAvModal(); });

    /* ── SCROLL REVEAL ── */
    const io = new IntersectionObserver(entries => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) { setTimeout(() => e.target.classList.add('visible'), i * 80); io.unobserve(e.target); }
        });
    }, { threshold: 0.07 });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));
});
</script>

</x-supplier-layout>