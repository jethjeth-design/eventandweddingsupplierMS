<x-supplier-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Availability Calendar') }}
        </h2>
    </x-slot>

    <!-- FullCalendar CDN -->
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

    /* ── Legend bar ── */
    .bv-legend-bar {
        display: flex; align-items: center; gap: 1rem;
        background: var(--white); border: 1.5px solid var(--border);
        border-radius: 10px; padding: .7rem 1.1rem;
        margin-bottom: 1.25rem; flex-wrap: wrap;
    }
    .bv-legend-label {
        font-size: .6rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
        color: var(--gold-dark); font-family: var(--font-body);
        display: flex; align-items: center; gap: .4rem; margin-right: .25rem;
    }
    .bv-legend-label svg { width: 12px; height: 12px; }
    .bv-legend-divider { width: 1px; height: 18px; background: var(--border); flex-shrink: 0; }
    .bv-legend-item { display: flex; align-items: center; gap: .4rem; font-size: .72rem; color: var(--warm-grey); font-family: var(--font-body); }
    .bv-legend-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
    .bv-hint-text { margin-left: auto; font-size: .68rem; color: var(--warm-grey); font-family: var(--font-body); display: flex; align-items: center; gap: .35rem; }
    .bv-hint-text svg { width: 12px; height: 12px; color: var(--gold-dark); opacity: .7; }

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
    .fc .fc-toolbar { margin-bottom: 1rem !important; flex-wrap: wrap; gap: .5rem; }
    .fc .fc-toolbar-title {
        font-family: var(--font-display) !important;
        font-size: 1.15rem !important; font-weight: 700 !important;
        color: var(--charcoal) !important;
    }
    .fc .fc-button {
        background: var(--ivory) !important;
        border: 1.5px solid var(--border) !important;
        color: var(--charcoal) !important;
        font-family: var(--font-body) !important;
        font-size: .72rem !important; font-weight: 600 !important;
        letter-spacing: .04em !important; text-transform: uppercase !important;
        border-radius: 7px !important; padding: .38rem .85rem !important;
        box-shadow: none !important;
        transition: border-color .18s, color .18s, background .18s !important;
    }
    .fc .fc-button:hover {
        border-color: var(--gold) !important; color: var(--gold-dark) !important;
        background: rgba(201,168,76,.07) !important;
    }
    .fc .fc-button-active,
    .fc .fc-button-primary:not(:disabled).fc-button-active {
        background: var(--charcoal) !important;
        border-color: var(--charcoal) !important;
        color: var(--white) !important;
    }
    .fc .fc-button:focus { box-shadow: 0 0 0 3px rgba(201,168,76,.2) !important; }
    .fc .fc-col-header-cell { background: var(--ivory) !important; border-color: var(--border) !important; }
    .fc .fc-col-header-cell-cushion {
        font-size: .62rem !important; font-weight: 700 !important;
        letter-spacing: .1em !important; text-transform: uppercase !important;
        color: var(--warm-grey) !important; padding: .55rem .25rem !important;
        text-decoration: none !important;
    }
    .fc .fc-daygrid-day { border-color: #F0EBE5 !important; cursor: pointer; }
    .fc .fc-daygrid-day:hover { background: rgba(201,168,76,.04) !important; }
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
        border-radius: 50% !important; font-size: .7rem !important;
    }
    .fc .fc-event {
        border-radius: 5px !important; border: none !important;
        font-size: .7rem !important; font-weight: 500 !important;
        font-family: var(--font-body) !important;
        cursor: pointer !important; padding: 1px 5px !important;
        transition: opacity .15s, transform .12s !important;
    }
    .fc .fc-event:hover { opacity: .85 !important; transform: scale(1.02) !important; }
    .fc-theme-standard td, .fc-theme-standard th { border-color: #F0EBE5 !important; }
    .fc-theme-standard .fc-scrollgrid { border-color: var(--border) !important; }
    .fc .fc-daygrid-more-link {
        font-size: .65rem !important; font-weight: 600 !important;
        color: var(--gold-dark) !important; text-decoration: none !important;
    }

    /* ── Toast notification ── */
    .bv-toast {
        position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 2000;
        background: var(--charcoal); color: var(--white);
        border-radius: 9px; padding: .7rem 1.1rem;
        font-size: .78rem; font-family: var(--font-body);
        display: flex; align-items: center; gap: .5rem;
        box-shadow: 0 8px 28px rgba(30,27,24,.22);
        transform: translateY(20px); opacity: 0;
        transition: transform .25s ease, opacity .25s ease;
        pointer-events: none;
    }
    .bv-toast.show { transform: translateY(0); opacity: 1; }
    .bv-toast svg { width: 14px; height: 14px; color: var(--gold); flex-shrink: 0; }

    /* ── Modal overlay ── */
    .bv-modal-overlay {
        display: none; position: fixed; inset: 0; z-index: 1000;
        background: rgba(30,27,24,.5); backdrop-filter: blur(3px);
        align-items: center; justify-content: center; padding: 1rem;
    }
    .bv-modal-overlay.open { display: flex; animation: overlayIn .2s ease both; }
    @keyframes overlayIn { from { opacity:0; } to { opacity:1; } }

    .bv-modal {
        background: var(--white); border-radius: 14px;
        width: 100%; max-width: 380px;
        box-shadow: 0 24px 60px rgba(30,27,24,.2);
        overflow: hidden;
        animation: modalIn .22s ease both;
    }
    @keyframes modalIn { from { opacity:0; transform:translateY(16px) scale(.97); } to { opacity:1; transform:none; } }

    .bv-modal-bar { height: 4px; background: linear-gradient(90deg, var(--gold-dark), var(--gold), rgba(201,168,76,.25)); }

    .bv-modal-head {
        display: flex; align-items: center; justify-content: space-between; gap: .75rem;
        padding: 1.1rem 1.25rem .9rem;
        border-bottom: 1px solid var(--border);
    }
    .bv-modal-head-left {}
    .bv-modal-title { font-family:var(--font-display); font-size:1.05rem; font-weight:700; color:var(--charcoal); }
    .bv-modal-subtitle { font-size:.72rem; color:var(--warm-grey); margin-top:.15rem; font-family:var(--font-body); }

    .bv-modal-close {
        width:28px; height:28px; border-radius:50%;
        background:var(--ivory); border:1px solid var(--border);
        display:flex; align-items:center; justify-content:center;
        cursor:pointer; flex-shrink:0;
        transition: background .15s, border-color .15s;
    }
    .bv-modal-close:hover { background:#FEE2E2; border-color:#FECACA; }
    .bv-modal-close svg { width:12px; height:12px; color:var(--warm-grey); }

    .bv-modal-body { padding: 1.1rem 1.25rem 1.25rem; }

    /* Status options as radio cards */
    .bv-status-grid { display: flex; flex-direction: column; gap: .5rem; margin-bottom: 1.1rem; }
    .bv-status-opt { display: none; }
    .bv-status-card {
        display: flex; align-items: center; gap: .75rem;
        padding: .75rem .9rem; border-radius: 8px;
        border: 1.5px solid var(--border); background: var(--ivory);
        cursor: pointer; transition: border-color .18s, background .18s;
        font-family: var(--font-body);
    }
    .bv-status-card:hover { border-color: var(--gold); background: rgba(201,168,76,.05); }
    .bv-status-opt:checked + .bv-status-card {
        border-color: var(--gold);
        background: rgba(201,168,76,.1);
        box-shadow: 0 0 0 2px rgba(201,168,76,.18);
    }
    .bv-status-icon {
        width: 32px; height: 32px; border-radius: 8px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
    }
    .bv-status-icon svg { width: 15px; height: 15px; }
    .bv-status-text-wrap {}
    .bv-status-text-name { font-size: .82rem; font-weight: 600; color: var(--charcoal); }
    .bv-status-text-desc { font-size: .68rem; color: var(--warm-grey); margin-top: .05rem; }

    /* Radio indicator */
    .bv-status-radio {
        width: 16px; height: 16px; border-radius: 50%;
        border: 1.5px solid var(--border-md, var(--border)); background: var(--white);
        margin-left: auto; flex-shrink: 0; position: relative;
        transition: border-color .15s;
    }
    .bv-status-opt:checked + .bv-status-card .bv-status-radio {
        border-color: var(--gold);
    }
    .bv-status-opt:checked + .bv-status-card .bv-status-radio::after {
        content: ''; position: absolute; inset: 3px; border-radius: 50%;
        background: var(--gold);
    }

    /* Action buttons */
    .bv-modal-actions { display: flex; gap: .6rem; }
    .bv-btn-cancel {
        flex: 1; padding: .55rem 1rem;
        background: transparent; color: var(--warm-grey);
        border: 1.5px solid var(--border); border-radius: 7px;
        font-size: .75rem; font-weight: 600; letter-spacing: .04em; text-transform: uppercase;
        cursor: pointer; font-family: var(--font-body);
        transition: border-color .18s, color .18s;
    }
    .bv-btn-cancel:hover { border-color: var(--gold); color: var(--gold-dark); }
    .bv-btn-save {
        flex: 2; padding: .58rem 1rem;
        background: var(--charcoal); color: var(--white);
        border: none; border-radius: 7px;
        font-size: .75rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase;
        cursor: pointer; font-family: var(--font-body);
        display: flex; align-items: center; justify-content: center; gap: .4rem;
        transition: background .18s; position: relative; overflow: hidden;
    }
    .bv-btn-save::before {
        content:''; position:absolute; inset:0;
        background:linear-gradient(135deg, rgba(201,168,76,.18), transparent);
    }
    .bv-btn-save:hover { background: #2e2a26; }
    .bv-btn-save svg { width: 13px; height: 13px; }
    .bv-btn-save.loading { opacity: .7; pointer-events: none; }
    </style>

    <div class="bv-cal-page">

        {{-- ── Page header ── --}}
        <div class="bv-page-header">
            <div>
                <h1 class="bv-page-title">Availability <em>Calendar</em></h1>
                <p class="bv-page-sub">Tap any date to set your availability status</p>
            </div>
        </div>

        {{-- ── Legend bar ── --}}
        <div class="bv-legend-bar">
            <span class="bv-legend-label">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="5"/><path d="M7 4v3l2 2"/></svg>
                Legend
            </span>
            <div class="bv-legend-divider"></div>
            <div class="bv-legend-item">
                <div class="bv-legend-dot" style="background:#15803D;"></div>
                Available
            </div>
            <div class="bv-legend-item">
                <div class="bv-legend-dot" style="background:#DC2626;"></div>
                Unavailable
            </div>
            <div class="bv-legend-item">
                <div class="bv-legend-dot" style="background:#C9A84C;"></div>
                Booked
            </div>
            <span class="bv-hint-text">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="5"/><path d="M7 6v4M7 4h.01"/></svg>
                Click any date to set status
            </span>
        </div>

        {{-- ── Calendar card ── --}}
        <div class="bv-cal-card">
            <div class="bv-cal-card-bar"></div>
            <div class="bv-cal-inner">
                <div id="calendar"></div>
            </div>
        </div>

    </div>

    {{-- ── Set Availability Modal ── --}}
    <div class="bv-modal-overlay" id="statusModal" onclick="closeOnBackdrop(event)">
        <div class="bv-modal" role="dialog" aria-modal="true">
            <div class="bv-modal-bar"></div>

            <div class="bv-modal-head">
                <div class="bv-modal-head-left">
                    <div class="bv-modal-title">Set Availability</div>
                    <div class="bv-modal-subtitle" id="modal-date-label">—</div>
                </div>
                <button class="bv-modal-close" onclick="closeForm()" aria-label="Close">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 2l10 10M12 2L2 12"/>
                    </svg>
                </button>
            </div>

            <div class="bv-modal-body">
                <input type="hidden" id="selectedDate">

                <div class="bv-status-grid">
                    {{-- Available --}}
                    <input class="bv-status-opt" type="radio" name="bv-status" id="opt-available" value="available" checked>
                    <label class="bv-status-card" for="opt-available">
                        <div class="bv-status-icon" style="background:#F0FDF4;">
                            <svg viewBox="0 0 16 16" fill="none" stroke="#15803D" stroke-width="1.8"><path d="M3 8l4 4 6-6"/></svg>
                        </div>
                        <div class="bv-status-text-wrap">
                            <div class="bv-status-text-name" style="color:#15803D;">Available</div>
                            <div class="bv-status-text-desc">Open for bookings on this date</div>
                        </div>
                        <div class="bv-status-radio"></div>
                    </label>

                    {{-- Unavailable --}}
                    <input class="bv-status-opt" type="radio" name="bv-status" id="opt-unavailable" value="unavailable">
                    <label class="bv-status-card" for="opt-unavailable">
                        <div class="bv-status-icon" style="background:#FEF2F2;">
                            <svg viewBox="0 0 16 16" fill="none" stroke="#DC2626" stroke-width="1.8"><path d="M4 4l8 8M12 4L4 12"/></svg>
                        </div>
                        <div class="bv-status-text-wrap">
                            <div class="bv-status-text-name" style="color:#DC2626;">Unavailable</div>
                            <div class="bv-status-text-desc">Not accepting bookings this date</div>
                        </div>
                        <div class="bv-status-radio"></div>
                    </label>

                    {{-- Booked --}}
                    <input class="bv-status-opt" type="radio" name="bv-status" id="opt-booked" value="booked">
                    <label class="bv-status-card" for="opt-booked">
                        <div class="bv-status-icon" style="background:rgba(201,168,76,.12);">
                            <svg viewBox="0 0 16 16" fill="none" stroke="#8A6A1F" stroke-width="1.8"><rect x="2" y="3" width="12" height="11" rx="1"/><path d="M5 3V1M11 3V1M2 7h12"/></svg>
                        </div>
                        <div class="bv-status-text-wrap">
                            <div class="bv-status-text-name" style="color:#8A6A1F;">Booked</div>
                            <div class="bv-status-text-desc">Already committed to a booking</div>
                        </div>
                        <div class="bv-status-radio"></div>
                    </label>
                </div>

                <div class="bv-modal-actions">
                    <button class="bv-btn-cancel" onclick="closeForm()">Cancel</button>
                    <button class="bv-btn-save" id="saveBtn" onclick="saveStatus()">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Toast ── --}}
    <div class="bv-toast" id="bvToast">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg>
        <span id="bvToastMsg">Availability saved.</span>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const statusColors = {
            available:   '#15803D',
            unavailable: '#DC2626',
            booked:      '#C9A84C',
        };

        let calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left:   'prev,next today',
                center: 'title',
                right:  'dayGridMonth,listWeek'
            },
            buttonText: { today:'Today', month:'Month', list:'List' },
            height: 'auto',
            dayMaxEvents: 3,

            events: "{{ route('supplier.availability.events') }}",

            eventDidMount: function(info) {
                const status = (info.event.extendedProps.status || info.event.title || '').toLowerCase();
                const color = statusColors[status];
                if (color) {
                    info.el.style.backgroundColor = color;
                    info.el.style.color = '#fff';
                    info.el.style.border = 'none';
                }
            },

            dateClick: function(info) {
                // Format date nicely for the modal subtitle
                const d = new Date(info.dateStr + 'T00:00:00');
                const label = d.toLocaleDateString('en-US', { weekday:'long', year:'numeric', month:'long', day:'numeric' });
                document.getElementById('selectedDate').value    = info.dateStr;
                document.getElementById('modal-date-label').textContent = label;

                // Reset to "available" each time
                document.getElementById('opt-available').checked = true;

                openModal();
            }
        });

        calendar.render();

        // expose globally for button handlers
        window._fcCalendar = calendar;
    });

    /* ── Modal helpers ── */
    function openModal() {
        document.getElementById('statusModal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeForm() {
        document.getElementById('statusModal').classList.remove('open');
        document.body.style.overflow = '';
    }
    function closeOnBackdrop(event) {
        if (event.target === event.currentTarget) closeForm();
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeForm();
    });

    /* ── Toast helper ── */
    function showToast(msg, isError) {
        const t = document.getElementById('bvToast');
        document.getElementById('bvToastMsg').textContent = msg || 'Saved.';
        t.style.background = isError ? '#DC2626' : 'var(--charcoal)';
        t.classList.add('show');
        setTimeout(() => t.classList.remove('show'), 3000);
    }

    /* ── Save availability (AJAX) ── */
    function saveStatus() {
        const date   = document.getElementById('selectedDate').value;
        const status = document.querySelector('input[name="bv-status"]:checked')?.value;
        const btn    = document.getElementById('saveBtn');

        if (!date || !status) return;

        btn.classList.add('loading');
        btn.textContent = 'Saving…';

        fetch("{{ route('supplier.availability.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ date, status })
        })
        .then(res => res.json())
        .then(() => {
            closeForm();
            showToast('Availability saved for ' + date);
            // Refresh calendar events without full page reload
            window._fcCalendar.getEventSources().forEach(src => src.refetch());
        })
        .catch(() => {
            showToast('Something went wrong. Please try again.', true);
        })
        .finally(() => {
            btn.classList.remove('loading');
            btn.innerHTML = `<svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg> Save`;
        });
    }
    </script>

</x-supplier-layout>