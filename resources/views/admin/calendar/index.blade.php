<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Supplier Calendar') }}
        </h2>
    </x-slot>

    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap');
    :root {
        --gold:#C9A84C;--gold-dark:#8A6A1F;--gold-light:rgba(201,168,76,0.1);
        --ivory:#FAF7F2;--charcoal:#1E1B18;--warm-grey:#706B65;
        --border:#E5DDD5;--white:#FFFFFF;
        --font-display:'Playfair Display',Georgia,serif;
        --font-body:'DM Sans',sans-serif;
    }

    /* ── Page wrapper ── */
    .bv-cal-page { padding: 1.5rem; }

    /* ── Page header ── */
    .bv-page-header { display:flex; align-items:flex-end; justify-content:space-between; margin-bottom:1.5rem; flex-wrap:wrap; gap:.75rem; }
    .bv-page-title { font-family:var(--font-display); font-size:1.65rem; font-weight:700; color:var(--charcoal); line-height:1.15; }
    .bv-page-title em { font-style:italic; color:var(--gold-dark); }
    .bv-page-sub { font-size:.76rem; color:var(--warm-grey); margin-top:.2rem; }

    /* ── Filter bar ── */
    .bv-filter-bar {
        display: flex; align-items: center; gap: .75rem;
        background: var(--white); border: 1.5px solid var(--border);
        border-radius: 10px; padding: .75rem 1.1rem;
        margin-bottom: 1.25rem; flex-wrap: wrap;
    }
    .bv-filter-label {
        font-size: .6rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
        color: var(--gold-dark); font-family: var(--font-body);
        white-space: nowrap; display: flex; align-items: center; gap: .4rem;
    }
    .bv-filter-label svg { width: 12px; height: 12px; }
    .bv-filter-divider { width: 1px; height: 20px; background: var(--border); flex-shrink: 0; }
    .bv-select-wrap { position: relative; display: inline-flex; align-items: center; }
    .bv-select-wrap::after {
        content: ''; pointer-events: none;
        position: absolute; right: .7rem; top: 50%; transform: translateY(-50%);
        width: 0; height: 0;
        border-left: 4px solid transparent; border-right: 4px solid transparent;
        border-top: 5px solid var(--warm-grey); opacity: .5;
    }
    .bv-filter-select {
        appearance: none; padding: .45rem 2rem .45rem .8rem;
        border: 1.5px solid var(--border); border-radius: 7px;
        font-size: .8rem; font-family: var(--font-body); color: var(--charcoal);
        background: var(--ivory); outline: none; min-width: 200px;
        transition: border-color .18s, box-shadow .18s;
        cursor: pointer;
    }
    .bv-filter-select:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(201,168,76,.12);
        background: var(--white);
    }

    /* ── Legend ── */
    .bv-legend { display: flex; align-items: center; gap: 1rem; flex-wrap: wrap; margin-left: auto; }
    .bv-legend-item { display: flex; align-items: center; gap: .35rem; font-size: .68rem; color: var(--warm-grey); font-family: var(--font-body); }
    .bv-legend-dot { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; }

    /* ── Calendar card ── */
    .bv-cal-card {
        background: var(--white);
        border: 1.5px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(30,27,24,.06);
    }
    .bv-cal-card-bar {
        height: 4px;
        background: linear-gradient(90deg, var(--gold-dark), var(--gold), rgba(201,168,76,.25));
    }
    .bv-cal-inner { padding: 1.25rem 1.25rem 1.5rem; }

    /* ── FullCalendar overrides ── */
    .fc { font-family: var(--font-body) !important; }

    /* Toolbar */
    .fc .fc-toolbar { margin-bottom: 1rem !important; gap: .5rem; flex-wrap: wrap; }
    .fc .fc-toolbar-title {
        font-family: var(--font-display) !important;
        font-size: 1.15rem !important; font-weight: 700 !important;
        color: var(--charcoal) !important;
    }

    /* Buttons */
    .fc .fc-button {
        background: var(--ivory) !important;
        border: 1.5px solid var(--border) !important;
        color: var(--charcoal) !important;
        font-family: var(--font-body) !important;
        font-size: .72rem !important; font-weight: 600 !important;
        letter-spacing: .04em !important; text-transform: uppercase !important;
        border-radius: 7px !important;
        padding: .38rem .85rem !important;
        transition: border-color .18s, color .18s, background .18s !important;
        box-shadow: none !important;
    }
    .fc .fc-button:hover {
        border-color: var(--gold) !important;
        color: var(--gold-dark) !important;
        background: rgba(201,168,76,.07) !important;
    }
    .fc .fc-button-active,
    .fc .fc-button-primary:not(:disabled).fc-button-active {
        background: var(--charcoal) !important;
        border-color: var(--charcoal) !important;
        color: var(--white) !important;
    }
    .fc .fc-button:focus { box-shadow: 0 0 0 3px rgba(201,168,76,.2) !important; }

    /* Column headers */
    .fc .fc-col-header-cell {
        background: var(--ivory) !important;
        border-color: var(--border) !important;
    }
    .fc .fc-col-header-cell-cushion {
        font-size: .62rem !important; font-weight: 700 !important;
        letter-spacing: .1em !important; text-transform: uppercase !important;
        color: var(--warm-grey) !important;
        padding: .55rem .25rem !important;
        text-decoration: none !important;
    }

    /* Day cells */
    .fc .fc-daygrid-day { border-color: #F0EBE5 !important; }
    .fc .fc-daygrid-day:hover .fc-daygrid-day-bg { background: rgba(201,168,76,.03) !important; }
    .fc .fc-daygrid-day-number {
        font-size: .75rem !important; font-weight: 600 !important;
        color: var(--warm-grey) !important; text-decoration: none !important;
        padding: .4rem .55rem !important;
    }
    .fc .fc-day-today { background: rgba(201,168,76,.06) !important; }
    .fc .fc-day-today .fc-daygrid-day-number {
        color: var(--gold-dark) !important;
        background: var(--gold) !important;
        width: 26px; height: 26px;
        display: flex !important; align-items: center; justify-content: center;
        border-radius: 50% !important;
        font-size: .7rem !important;
    }

    /* Events */
    .fc .fc-event {
        border-radius: 5px !important;
        border: none !important;
        font-size: .7rem !important;
        font-weight: 500 !important;
        font-family: var(--font-body) !important;
        cursor: pointer !important;
        padding: 1px 5px !important;
        transition: opacity .15s, transform .12s !important;
    }
    .fc .fc-event:hover { opacity: .88 !important; transform: scale(1.02) !important; }
    .fc .fc-event-title { font-family: var(--font-body) !important; }

    /* Table borders */
    .fc-theme-standard td, .fc-theme-standard th { border-color: #F0EBE5 !important; }
    .fc-theme-standard .fc-scrollgrid { border-color: var(--border) !important; border-radius: 8px; overflow: hidden; }

    /* More link */
    .fc .fc-daygrid-more-link {
        font-size: .65rem !important; font-weight: 600 !important;
        color: var(--gold-dark) !important; text-decoration: none !important;
    }
    .fc .fc-daygrid-more-link:hover { color: var(--charcoal) !important; }

    /* Popover */
    .fc .fc-popover {
        border: 1.5px solid var(--border) !important;
        border-radius: 10px !important;
        box-shadow: 0 8px 28px rgba(30,27,24,.12) !important;
        font-family: var(--font-body) !important;
    }
    .fc .fc-popover-header {
        background: var(--ivory) !important;
        font-size: .7rem !important; font-weight: 700 !important;
        letter-spacing: .06em !important; text-transform: uppercase !important;
        color: var(--warm-grey) !important;
        border-bottom: 1px solid var(--border) !important;
        border-radius: 10px 10px 0 0 !important;
    }

    /* ── Event detail modal ── */
    .bv-modal-overlay {
        display: none; position: fixed; inset: 0; z-index: 1000;
        background: rgba(30,27,24,.5); backdrop-filter: blur(3px);
        align-items: center; justify-content: center; padding: 1rem;
    }
    .bv-modal-overlay.open { display: flex; animation: overlayIn .2s ease both; }
    @keyframes overlayIn { from { opacity:0; } to { opacity:1; } }

    .bv-modal {
        background: var(--white); border-radius: 14px;
        width: 100%; max-width: 420px;
        box-shadow: 0 24px 60px rgba(30,27,24,.2);
        overflow: hidden;
        animation: modalIn .22s ease both;
    }
    @keyframes modalIn { from { opacity:0; transform:translateY(16px) scale(.97); } to { opacity:1; transform:none; } }

    .bv-modal-bar { height: 4px; background: linear-gradient(90deg, var(--gold-dark), var(--gold), rgba(201,168,76,.25)); }

    .bv-modal-head {
        display: flex; align-items: flex-start; justify-content: space-between; gap: .75rem;
        padding: 1.1rem 1.25rem .85rem;
        border-bottom: 1px solid var(--border);
    }
    .bv-modal-title { font-family:var(--font-display); font-size:1.05rem; font-weight:700; color:var(--charcoal); line-height:1.2; }
    .bv-modal-date { font-size:.72rem; color:var(--warm-grey); margin-top:.2rem; font-family:var(--font-body); }

    .bv-modal-close {
        width:28px; height:28px; border-radius:50%;
        background:var(--ivory); border:1px solid var(--border);
        display:flex; align-items:center; justify-content:center;
        cursor:pointer; flex-shrink:0;
        transition: background .15s, border-color .15s;
    }
    .bv-modal-close:hover { background:#FEE2E2; border-color:#FECACA; }
    .bv-modal-close svg { width:12px; height:12px; color:var(--warm-grey); }

    .bv-modal-body { padding: .9rem 1.25rem 1.25rem; display:flex; flex-direction:column; gap:.65rem; }
    .bv-modal-row { display:flex; align-items:flex-start; gap:.6rem; }
    .bv-modal-row svg { width:14px; height:14px; flex-shrink:0; color:var(--gold-dark); opacity:.8; margin-top:1px; }
    .bv-modal-row-label { font-size:.58rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:var(--warm-grey); font-family:var(--font-body); }
    .bv-modal-row-val { font-size:.82rem; color:var(--charcoal); font-family:var(--font-body); margin-top:.1rem; }
    .bv-status-pill {
        display:inline-flex; align-items:center; gap:.3rem;
        padding:.22rem .65rem; border-radius:20px;
        font-size:.68rem; font-weight:600; font-family:var(--font-body);
    }
    .bv-status-dot { width:7px; height:7px; border-radius:50%; }
    </style>

    <div class="bv-cal-page">

        {{-- ── Page header ── --}}
        <div class="bv-page-header">
            <div>
                <h1 class="bv-page-title">Supplier <em>Calendar</em></h1>
                <p class="bv-page-sub">View all supplier bookings and availability across the month</p>
            </div>
        </div>

        {{-- ── Filter bar ── --}}
        <div class="bv-filter-bar">
            <span class="bv-filter-label">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 3h12M3 7h8M5 11h4"/></svg>
                Filter
            </span>
            <div class="bv-filter-divider"></div>
            <div class="bv-select-wrap">
                <select class="bv-filter-select" id="supplierFilter">
                    <option value="">All Suppliers</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->business_name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Legend --}}
            <div class="bv-legend">
                <div class="bv-legend-item">
                    <div class="bv-legend-dot" style="background:#15803D;"></div>
                    Confirmed
                </div>
                <div class="bv-legend-item">
                    <div class="bv-legend-dot" style="background:#C9A84C;"></div>
                    Pending
                </div>
                <div class="bv-legend-item">
                    <div class="bv-legend-dot" style="background:#DC2626;"></div>
                    Cancelled
                </div>
            </div>
        </div>

        {{-- ── Calendar card ── --}}
        <div class="bv-cal-card">
            <div class="bv-cal-card-bar"></div>
            <div class="bv-cal-inner">
                <div id="calendar"></div>
            </div>
        </div>

    </div>

    {{-- ── Event detail modal ── --}}
    <div class="bv-modal-overlay" id="eventModal" onclick="closeOnBackdrop(event)">
        <div class="bv-modal" role="dialog" aria-modal="true">
            <div class="bv-modal-bar"></div>
            <div class="bv-modal-head">
                <div>
                    <div class="bv-modal-title" id="modal-title">—</div>
                    <div class="bv-modal-date" id="modal-date">—</div>
                </div>
                <button class="bv-modal-close" onclick="closeModal()" aria-label="Close">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 2l10 10M12 2L2 12"/>
                    </svg>
                </button>
            </div>
            <div class="bv-modal-body">
                <div class="bv-modal-row">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="8" width="12" height="7" rx="1"/><path d="M5 8V6a3 3 0 016 0v2"/></svg>
                    <div>
                        <div class="bv-modal-row-label">Supplier</div>
                        <div class="bv-modal-row-val" id="modal-supplier">—</div>
                    </div>
                </div>
                <div class="bv-modal-row">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="8" cy="8" r="6"/><path d="M8 5v4l2.5 2"/></svg>
                    <div>
                        <div class="bv-modal-row-label">Status</div>
                        <div class="bv-modal-row-val" id="modal-status">—</div>
                    </div>
                </div>
                <div class="bv-modal-row" id="modal-notes-row" style="display:none;">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M3 4h10M3 7h10M3 10h6"/></svg>
                    <div>
                        <div class="bv-modal-row-label">Notes</div>
                        <div class="bv-modal-row-val" id="modal-notes">—</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const statusStyles = {
            confirmed: { bg:'#F0FDF4', color:'#15803D', dot:'#15803D', label:'Confirmed' },
            pending:   { bg:'rgba(201,168,76,.12)', color:'#8A6A1F', dot:'#C9A84C', label:'Pending' },
            cancelled: { bg:'#FEF2F2', color:'#DC2626', dot:'#DC2626', label:'Cancelled' },
        };

        let calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left:   'prev,next today',
                center: 'title',
                right:  'dayGridMonth,timeGridWeek,listWeek'
            },
            buttonText: {
                today: 'Today',
                month: 'Month',
                week:  'Week',
                list:  'List'
            },
            events: "{{ route('admin.calendar.events') }}",
            eventDidMount: function(info) {
                // Colour-code by status
                const status = (info.event.extendedProps.status || '').toLowerCase();
                const style = statusStyles[status];
                if (style) {
                    info.el.style.backgroundColor = style.dot;
                    info.el.style.color = '#fff';
                }
            },
            eventClick: function(info) {
                const status = (info.event.extendedProps.status || '').toLowerCase();
                const style  = statusStyles[status] || { bg:'var(--gold-light)', color:'var(--gold-dark)', dot:'var(--gold)', label: info.event.extendedProps.status };

                // Populate modal
                document.getElementById('modal-title').textContent    = info.event.title || '—';
                document.getElementById('modal-supplier').textContent = info.event.extendedProps.supplier || '—';

                // Format date range
                const start = info.event.start ? info.event.start.toLocaleDateString('en-US', { weekday:'long', year:'numeric', month:'long', day:'numeric' }) : '—';
                const end   = info.event.end   ? ' – ' + info.event.end.toLocaleDateString('en-US', { month:'long', day:'numeric' }) : '';
                document.getElementById('modal-date').textContent = start + end;

                // Status pill
                document.getElementById('modal-status').innerHTML =
                    `<span class="bv-status-pill" style="background:${style.bg};color:${style.color};">
                        <span class="bv-status-dot" style="background:${style.dot};"></span>
                        ${style.label}
                    </span>`;

                // Notes (optional)
                const notes = info.event.extendedProps.notes;
                const notesRow = document.getElementById('modal-notes-row');
                if (notes) {
                    document.getElementById('modal-notes').textContent = notes;
                    notesRow.style.display = 'flex';
                } else {
                    notesRow.style.display = 'none';
                }

                openModal();
            },
            dayMaxEvents: 3,
            height: 'auto',
        });

        calendar.render();

        // ── Filter by supplier ──
        document.getElementById('supplierFilter').addEventListener('change', function () {
            const supplierId = this.value;
            calendar.getEventSources().forEach(src => src.remove());
            calendar.addEventSource({
                url: "{{ route('admin.calendar.events') }}",
                extraParams: { supplier_id: supplierId }
            });
        });
    });

    function openModal() {
        document.getElementById('eventModal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        document.getElementById('eventModal').classList.remove('open');
        document.body.style.overflow = '';
    }
    function closeOnBackdrop(event) {
        if (event.target === event.currentTarget) closeModal();
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });
    </script>

</x-app-layout>