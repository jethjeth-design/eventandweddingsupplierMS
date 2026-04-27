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
    .cal-wrap { max-width: 1000px; margin: 0 auto; padding: 2rem 1.25rem 4rem; }

    /* ══════════════════════════════
       HEADER BANNER
    ══════════════════════════════ */
    .cal-banner {
        background: var(--charcoal);
        border-radius: 16px;
        padding: 1.6rem 1.85rem;
        margin-bottom: 1.75rem;
        position: relative; overflow: hidden;
    }
    .cal-banner::before {
        content: '';
        position: absolute; inset: 0;
        background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px);
        background-size: 20px 20px; pointer-events: none;
    }
    .cal-banner::after {
        content: '';
        position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }
    .cal-banner-inner {
        position: relative; z-index: 1;
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 1rem;
    }
    .cal-banner-left {}
    .cal-eyebrow {
        font-size: 0.6rem; letter-spacing: 0.2em; text-transform: uppercase;
        color: var(--gold); font-weight: 500; margin-bottom: 0.3rem;
        display: flex; align-items: center; gap: 0.4rem; font-family: var(--font-body);
    }
    .cal-eyebrow::before { content: ''; width: 12px; height: 1px; background: var(--gold); }
    .cal-banner h1 {
        font-family: var(--font-display);
        font-size: clamp(1.2rem, 2.5vw, 1.7rem);
        font-weight: 700; color: var(--white); line-height: 1.15;
    }
    .cal-banner h1 em { color: var(--gold-light); font-style: italic; }
    .cal-banner-sub { font-size: 0.78rem; color: rgba(255,255,255,0.42); margin-top: 0.25rem; }

    /* Supplier pill in banner */
    .cal-supplier-pill {
        display: flex; align-items: center; gap: 0.7rem;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(201,168,76,0.22);
        border-radius: 999px;
        padding: 0.45rem 1rem 0.45rem 0.45rem;
        flex-shrink: 0;
    }
    .cal-supplier-avatar {
        width: 36px; height: 36px; border-radius: 50%;
        border: 1.5px solid rgba(201,168,76,0.3);
        overflow: hidden; background: var(--charcoal);
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display); font-size: 0.75rem; font-weight: 700;
        color: var(--gold); flex-shrink: 0;
    }
    .cal-supplier-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .cal-supplier-name { font-size: 0.82rem; font-weight: 500; color: rgba(255,255,255,0.88); white-space: nowrap; }
    .cal-supplier-label { font-size: 0.62rem; color: var(--gold-light); }

    /* Back link */
    .cal-back {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-size: 0.72rem; font-weight: 500; color: rgba(255,255,255,0.5);
        text-decoration: none; transition: color 0.18s;
        margin-bottom: 0.6rem;
    }
    .cal-back:hover { color: var(--gold-light); }
    .cal-back svg { width: 13px; height: 13px; }

    /* ══════════════════════════════
       LEGEND + CALENDAR CARD
    ══════════════════════════════ */
    .cal-legend {
        display: flex; align-items: center; gap: 1.25rem; flex-wrap: wrap;
        margin-bottom: 1rem;
    }
    .legend-item {
        display: flex; align-items: center; gap: 0.4rem;
        font-size: 0.72rem; color: var(--warm-grey); font-family: var(--font-body);
    }
    .legend-dot { width: 10px; height: 10px; border-radius: 2px; flex-shrink: 0; }
    .legend-dot.booked    { background: #DC2626; }
    .legend-dot.available { background: #16A34A; }
    .legend-dot.pending   { background: #D97706; }

    /* Calendar wrapper card */
    .cal-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 1px 6px rgba(30,27,24,0.05);
    }

    /* ══════════════════════════════
       FULLCALENDAR OVERRIDES
    ══════════════════════════════ */
    #calendar {
        padding: 1.25rem 1.25rem 1.5rem;
        font-family: var(--font-body) !important;
    }

    /* Toolbar */
    .fc .fc-toolbar-title {
        font-family: var(--font-display) !important;
        font-size: 1.15rem !important;
        font-weight: 700 !important;
        color: var(--charcoal) !important;
    }
    .fc .fc-button-primary {
        background: var(--charcoal) !important;
        border-color: var(--charcoal) !important;
        font-family: var(--font-body) !important;
        font-size: 0.72rem !important;
        font-weight: 500 !important;
        letter-spacing: 0.03em !important;
        border-radius: 6px !important;
        padding: 0.38rem 0.85rem !important;
        transition: background 0.18s !important;
    }
    .fc .fc-button-primary:hover {
        background: var(--gold-dark) !important;
        border-color: var(--gold-dark) !important;
    }
    .fc .fc-button-primary:not(:disabled).fc-button-active,
    .fc .fc-button-primary:not(:disabled):active {
        background: var(--gold) !important;
        border-color: var(--gold) !important;
        color: var(--charcoal) !important;
    }
    .fc .fc-button-group > .fc-button { border-radius: 6px !important; margin: 0 2px !important; }

    /* Column headers */
    .fc .fc-col-header-cell-cushion {
        font-size: 0.65rem !important;
        font-weight: 700 !important;
        letter-spacing: 0.1em !important;
        text-transform: uppercase !important;
        color: var(--warm-grey) !important;
        text-decoration: none !important;
        padding: 0.6rem 0 !important;
    }

    /* Day cells */
    .fc .fc-daygrid-day-number {
        font-size: 0.78rem !important;
        color: var(--charcoal) !important;
        text-decoration: none !important;
        padding: 6px 8px !important;
        font-weight: 500 !important;
    }
    .fc .fc-day-today {
        background: rgba(201,168,76,0.07) !important;
    }
    .fc .fc-day-today .fc-daygrid-day-number {
        background: var(--gold) !important;
        color: var(--charcoal) !important;
        border-radius: 50% !important;
        width: 26px; height: 26px;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700 !important;
        padding: 0 !important;
        margin: 5px !important;
    }

    /* Cell borders */
    .fc .fc-scrollgrid { border-color: var(--border) !important; }
    .fc .fc-scrollgrid td, .fc .fc-scrollgrid th { border-color: var(--border) !important; }

    /* Events */
    .fc .fc-event {
        border: none !important;
        border-radius: 4px !important;
        font-size: 0.68rem !important;
        font-weight: 600 !important;
        font-family: var(--font-body) !important;
        padding: 2px 6px !important;
        cursor: pointer !important;
    }
    .fc .fc-event-title { font-size: 0.68rem !important; }
    .fc .fc-daygrid-event { margin: 1px 3px !important; }

    /* "more" link */
    .fc .fc-more-link {
        font-size: 0.65rem !important;
        color: var(--gold-dark) !important;
        font-weight: 600 !important;
    }

    /* ══════════════════════════════
       EVENT DETAIL POPUP (tooltip)
    ══════════════════════════════ */
    .cal-popup-backdrop {
        display: none; position: fixed; inset: 0;
        background: rgba(30,27,24,0.45); z-index: 300;
        align-items: center; justify-content: center;
        padding: 1.5rem; backdrop-filter: blur(3px);
    }
    .cal-popup-backdrop.open { display: flex; }

    .cal-popup {
        background: var(--white); border-radius: 12px;
        width: 360px; max-width: 100%;
        border-top: 2px solid var(--gold);
        box-shadow: 0 20px 60px rgba(30,27,24,0.22);
        overflow: hidden; margin: auto;
        animation: popIn 0.2s ease both;
    }
    @keyframes popIn { from { opacity: 0; transform: scale(0.96); } to { opacity: 1; transform: scale(1); } }

    .cal-popup-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 1rem 1.25rem; border-bottom: 1px solid var(--border);
    }
    .cal-popup-title { font-family: var(--font-display); font-size: 0.95rem; font-weight: 700; color: var(--charcoal); }
    .cal-popup-close {
        width: 26px; height: 26px; border: 1px solid var(--border);
        background: var(--ivory); border-radius: 5px; cursor: pointer;
        font-size: 14px; color: var(--warm-grey);
        display: flex; align-items: center; justify-content: center;
        transition: border-color 0.15s, color 0.15s;
    }
    .cal-popup-close:hover { border-color: var(--gold); color: var(--gold-dark); }

    .cal-popup-body { padding: 1.1rem 1.25rem; display: flex; flex-direction: column; gap: 0.65rem; }

    .cal-popup-row { display: flex; align-items: center; gap: 0.65rem; }
    .cal-popup-icon {
        width: 30px; height: 30px; border-radius: 7px; flex-shrink: 0;
        background: rgba(201,168,76,0.1);
        display: flex; align-items: center; justify-content: center;
        color: var(--gold-dark);
    }
    .cal-popup-icon svg { width: 14px; height: 14px; }
    .cal-popup-row-label { font-size: 0.62rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: #C0B8B0; font-family: var(--font-body); }
    .cal-popup-row-val { font-size: 0.82rem; color: var(--charcoal); font-family: var(--font-body); font-weight: 500; }

    .cal-status-badge {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 3px 9px; border-radius: 999px;
        font-size: 0.65rem; font-weight: 700; letter-spacing: 0.04em; text-transform: uppercase;
        font-family: var(--font-body);
    }
    .cal-status-badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; }
    .cal-status-badge.booked    { background: #FEF2F2; color: #B91C1C; border: 1px solid #FECACA; }
    .cal-status-badge.booked::before    { background: #EF4444; }
    .cal-status-badge.available { background: #F0FDF4; color: #15803D; border: 1px solid #BBF7D0; }
    .cal-status-badge.available::before { background: #22C55E; }
    .cal-status-badge.pending   { background: #FFFBEB; color: #92400E; border: 1px solid #FDE68A; }
    .cal-status-badge.pending::before   { background: #F59E0B; }

    .cal-popup-footer { padding: 0.75rem 1.25rem; border-top: 1px solid var(--border); display: flex; justify-content: flex-end; }
    .cal-popup-close-btn {
        padding: 0.5rem 1.1rem; border-radius: 6px;
        border: 1px solid var(--border-md); background: var(--white);
        font-size: 0.75rem; font-weight: 500; color: var(--warm-grey);
        cursor: pointer; font-family: var(--font-body);
        transition: border-color 0.15s, color 0.15s;
    }
    .cal-popup-close-btn:hover { border-color: var(--gold); color: var(--charcoal); }

    /* Mobile */
    @media (max-width: 560px) {
        .cal-wrap { padding: 1rem 0.75rem 3rem; }
        .cal-banner { padding: 1.25rem 1.15rem; }
        #calendar { padding: 0.75rem 0.5rem 1rem; }
        .fc .fc-toolbar { flex-direction: column; gap: 0.5rem; }
    }
</style>

{{-- FullCalendar CDN --}}
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<div class="cal-wrap">

    {{-- ── Back link ── --}}
    <a href="{{ url()->previous() }}" class="cal-back">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10 3L5 8l5 5"/>
        </svg>
        Back to supplier
    </a>

    {{-- ── Banner ── --}}
    <div class="cal-banner">
        <div class="cal-banner-inner">
            <div class="cal-banner-left">
                <div class="cal-eyebrow">
                    <svg width="11" height="11" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                        <rect x="3" y="4" width="14" height="13" rx="2"/>
                        <path d="M3 9h14M7 2v4M13 2v4"/>
                    </svg>
                    Supplier Calendar
                </div>
                <h1>Check <em>Availability</em></h1>
                <p class="cal-banner-sub">View booked and available dates before making a booking.</p>
            </div>

            {{-- Supplier pill --}}
            <div class="cal-supplier-pill">
                <div class="cal-supplier-avatar">
                    @if($supplier->photo)
                        <img src="{{ asset('storage/'.$supplier->photo) }}" alt="{{ $supplier->business_name }}">
                    @else
                        {{ strtoupper(substr($supplier->business_name ?? $supplier->first_name ?? 'S', 0, 2)) }}
                    @endif
                </div>
                <div>
                    <div class="cal-supplier-name">{{ $supplier->business_name }}</div>
                    <div class="cal-supplier-label">Supplier</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Legend ── --}}
    <div class="cal-legend">
        <div class="legend-item">
            <span class="legend-dot booked"></span>
            Booked / Unavailable
        </div>
        <div class="legend-item">
            <span class="legend-dot available"></span>
            Available
        </div>
        <div class="legend-item">
            <span class="legend-dot pending"></span>
            Pending / On Hold
        </div>
    </div>

    {{-- ── Calendar card ── --}}
    <div class="cal-card">
        <div id="calendar"></div>
    </div>

</div>{{-- /cal-wrap --}}


{{-- ── Event detail popup ── --}}
<div id="calPopupBackdrop" class="cal-popup-backdrop">
    <div class="cal-popup">
        <div class="cal-popup-header">
            <span class="cal-popup-title">Date Details</span>
            <button class="cal-popup-close" onclick="closePopup()">✕</button>
        </div>
        <div class="cal-popup-body">

            <div class="cal-popup-row">
                <div class="cal-popup-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="3" y="4" width="14" height="13" rx="2"/>
                        <path d="M3 9h14M7 2v4M13 2v4"/>
                    </svg>
                </div>
                <div>
                    <div class="cal-popup-row-label">Date</div>
                    <div class="cal-popup-row-val" id="popup-date">—</div>
                </div>
            </div>

            <div class="cal-popup-row">
                <div class="cal-popup-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="10" r="8"/>
                        <path d="M10 6v4l2.5 2.5"/>
                    </svg>
                </div>
                <div>
                    <div class="cal-popup-row-label">Status</div>
                    <div id="popup-status">—</div>
                </div>
            </div>

            <div class="cal-popup-row" id="popup-note-row" style="display:none;">
                <div class="cal-popup-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/>
                    </svg>
                </div>
                <div>
                    <div class="cal-popup-row-label">Note</div>
                    <div class="cal-popup-row-val" id="popup-note">—</div>
                </div>
            </div>

        </div>
        <div class="cal-popup-footer">
            <button class="cal-popup-close-btn" onclick="closePopup()">Close</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {

        initialView: 'dayGridMonth',
        height: 'auto',

        headerToolbar: {
            left:   'prev,next today',
            center: 'title',
            right:  'dayGridMonth,dayGridWeek'
        },

        /* Colour events by status from the server response */
        eventDataTransform: function(event) {
            const status = (event.status || event.title || '').toLowerCase();
            if (status.includes('book') || status.includes('unavail')) {
                event.backgroundColor = '#DC2626';
                event.borderColor     = '#DC2626';
                event.textColor       = '#fff';
            } else if (status.includes('pend') || status.includes('hold')) {
                event.backgroundColor = '#D97706';
                event.borderColor     = '#D97706';
                event.textColor       = '#fff';
            } else {
                event.backgroundColor = '#16A34A';
                event.borderColor     = '#16A34A';
                event.textColor       = '#fff';
            }
            return event;
        },

        events: "{{ route('client.supplier.calendar.events', $supplier->id) }}",

        eventClick: function(info) {
            const event  = info.event;
            const title  = event.title || 'Unknown';
            const start  = event.startStr || '';
            const note   = event.extendedProps.note || event.extendedProps.description || '';

            /* Format date nicely */
            const dateObj = event.start;
            const dateStr = dateObj
                ? dateObj.toLocaleDateString('en-PH', { weekday:'long', year:'numeric', month:'long', day:'numeric' })
                : start;

            /* Status badge class */
            const lower = title.toLowerCase();
            let badgeClass = 'available';
            if (lower.includes('book') || lower.includes('unavail')) badgeClass = 'booked';
            else if (lower.includes('pend') || lower.includes('hold'))   badgeClass = 'pending';

            document.getElementById('popup-date').textContent = dateStr;
            document.getElementById('popup-status').innerHTML =
                '<span class="cal-status-badge ' + badgeClass + '">' + title + '</span>';

            const noteRow = document.getElementById('popup-note-row');
            if (note) {
                document.getElementById('popup-note').textContent = note;
                noteRow.style.display = 'flex';
            } else {
                noteRow.style.display = 'none';
            }

            document.getElementById('calPopupBackdrop').classList.add('open');
            document.body.style.overflow = 'hidden';
        },

        /* Highlight today */
        dayCellDidMount: function(info) {
            /* handled via CSS .fc-day-today */
        }
    });

    calendar.render();
});

function closePopup() {
    document.getElementById('calPopupBackdrop').classList.remove('open');
    document.body.style.overflow = '';
}

document.getElementById('calPopupBackdrop').addEventListener('click', function(e) {
    if (e.target === this) closePopup();
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closePopup();
});
</script>

</x-client-layout>