<x-app-layout>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap');

:root {
    --gold:#C9A84C; --gold-dark:#8A6A1F; --gold-light:rgba(201,168,76,0.12);
    --ivory:#FAF7F2; --charcoal:#1E1B18; --warm-grey:#706B65;
    --border:#E5DDD5; --border-md:#E0D8D0;
    --white:#FFFFFF;
    --font-display:'Playfair Display',Georgia,serif;
    --font-body:'DM Sans',sans-serif;
}

/* ── TOP ROW ── */
.ev-top{display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:.75rem;margin-bottom:1.4rem;}
.ev-title{font-family:var(--font-display);font-size:1.65rem;font-weight:700;color:var(--charcoal);line-height:1.15;}
.ev-title em{font-style:italic;color:var(--gold-dark);}
.ev-subtitle{font-size:.76rem;color:var(--warm-grey);margin-top:.2rem;font-family:var(--font-body);}
.ev-badge{font-size:.65rem;font-weight:500;letter-spacing:.07em;text-transform:uppercase;color:var(--gold-dark);background:var(--gold-light);border:1px solid rgba(201,168,76,.3);padding:.28rem .75rem;border-radius:20px;white-space:nowrap;font-family:var(--font-body);}

/* ── STATS ── */
.ev-stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:.75rem;margin-bottom:1.25rem;}
.ev-stat{background:var(--white);border:1.5px solid var(--border);border-radius:10px;padding:.85rem 1rem;}
.ev-stat-val{font-family:var(--font-display);font-size:1.35rem;font-weight:700;color:var(--charcoal);line-height:1;}
.ev-stat-lbl{font-size:.68rem;color:var(--warm-grey);margin-top:.28rem;font-family:var(--font-body);}
.ev-stat.gold .ev-stat-val{color:var(--gold-dark);}

/* ── TOOLBAR ── */
.ev-toolbar{display:flex;align-items:center;gap:.65rem;flex-wrap:wrap;margin-bottom:1rem;}
.ev-search-wrap{display:flex;align-items:center;gap:.5rem;flex:1;min-width:200px;background:var(--white);border:1.5px solid var(--border);border-radius:8px;padding:.42rem .85rem;transition:border-color .2s,box-shadow .2s;}
.ev-search-wrap:focus-within{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,.1);}
.ev-search-wrap svg{width:13px;height:13px;color:#C0B8B0;flex-shrink:0;}
.ev-search-wrap input{border:none;outline:none;background:transparent;font-family:var(--font-body);font-size:.8rem;color:var(--charcoal);width:100%;}
.ev-search-wrap input::placeholder{color:#C0B8B0;}
.ev-select{padding:.42rem .85rem;border:1.5px solid var(--border);border-radius:8px;font-family:var(--font-body);font-size:.8rem;color:var(--charcoal);background:var(--white);outline:none;cursor:pointer;transition:border-color .2s;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' fill='none' stroke='%23C0B8B0' stroke-width='1.5'%3E%3Cpath d='M1 1l4 4 4-4'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right .6rem center;padding-right:1.8rem;}
.ev-select:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,.1);}

/* Filter pills */
.ev-pills{display:flex;align-items:center;gap:.4rem;flex-wrap:wrap;margin-bottom:.65rem;}
.ev-pill{display:inline-flex;align-items:center;gap:.35rem;padding:.22rem .65rem;border-radius:999px;background:rgba(201,168,76,.1);border:1px solid rgba(201,168,76,.3);color:var(--gold-dark);font-size:.68rem;font-weight:600;font-family:var(--font-body);}
.ev-pill-x{background:none;border:none;cursor:pointer;color:var(--gold-dark);padding:0 0 0 .15rem;line-height:1;font-size:.8rem;opacity:.7;display:inline-flex;align-items:center;}
.ev-pill-x:hover{opacity:1;}

/* Loading */
.ev-loading{display:none;align-items:center;gap:.5rem;font-size:.75rem;color:var(--warm-grey);font-family:var(--font-body);padding:.3rem 0;}
.ev-loading.show{display:flex;}
.ev-spinner{width:13px;height:13px;border:2px solid rgba(201,168,76,.3);border-top-color:var(--gold);border-radius:50%;animation:spin .6s linear infinite;flex-shrink:0;}
@keyframes spin{to{transform:rotate(360deg);}}

.ev-result-info{font-size:.72rem;color:var(--warm-grey);font-family:var(--font-body);padding:.4rem 0 .6rem;}

/* ── CARD + TABLE ── */
.ev-card{background:var(--white);border:1.5px solid var(--border);border-radius:14px;overflow:hidden;}
.scroll-hint{display:none;align-items:center;gap:.4rem;font-size:.68rem;color:var(--warm-grey);padding:.55rem 1rem .1rem;font-family:var(--font-body);}
.scroll-hint svg{width:13px;height:13px;flex-shrink:0;}
@media(max-width:640px){.scroll-hint{display:flex;}}
.tbl-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch;scrollbar-width:thin;scrollbar-color:rgba(201,168,76,.4) transparent;}
.tbl-wrap::-webkit-scrollbar{height:4px;}
.tbl-wrap::-webkit-scrollbar-thumb{background:rgba(201,168,76,.45);border-radius:4px;}

/* min-width bumped to fit new columns */
.ev-table{width:100%;min-width:1060px;border-collapse:collapse;font-family:var(--font-body);}
.ev-table thead{background:var(--ivory);border-bottom:1.5px solid var(--border);}
.ev-table thead th{padding:.8rem 1.1rem;font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--warm-grey);text-align:left;white-space:nowrap;}
.ev-table thead th:first-child{border-left:3px solid var(--gold);}
.ev-table tbody tr{border-bottom:1px solid #F0EBE5;transition:background .15s;}
.ev-table tbody tr:last-child{border-bottom:none;}
.ev-table tbody tr:hover{background:rgba(201,168,76,.04);}
.ev-table td{padding:.9rem 1.1rem;font-size:.83rem;color:var(--charcoal);vertical-align:middle;}
.ev-table tbody td:first-child{border-left:3px solid transparent;}
.ev-table tbody tr:hover td:first-child{border-left-color:rgba(201,168,76,.45);}

/* Cell types */
.td-num{color:#C0B8B0;font-size:.72rem;width:50px;}
.td-client-name{font-weight:600;font-size:.84rem;color:var(--charcoal);}
.td-client-sub{font-size:.68rem;color:var(--warm-grey);margin-top:2px;}
.td-ev-name{font-family:var(--font-display);font-weight:700;font-size:.9rem;color:var(--charcoal);}
.td-ev-type{display:inline-flex;align-items:center;padding:.22rem .62rem;border-radius:20px;font-size:.67rem;font-weight:500;letter-spacing:.04em;background:var(--gold-light);color:var(--gold-dark);border:1px solid rgba(201,168,76,.25);white-space:nowrap;}
.td-budget{font-weight:700;font-size:.9rem;color:var(--gold-dark);white-space:nowrap;}
.td-guests{display:inline-flex;align-items:center;gap:.38rem;font-size:.82rem;white-space:nowrap;}
.td-guests svg{flex-shrink:0;}
.td-venue{font-size:.8rem;color:var(--charcoal);max-width:160px;line-height:1.4;}
.td-date{font-size:.8rem;color:var(--charcoal);white-space:nowrap;}

/* NEW: time + location cell */
.td-time-loc{font-size:.78rem;color:var(--charcoal);white-space:nowrap;}
.td-time-loc small{display:block;font-size:.67rem;color:var(--warm-grey);margin-top:2px;white-space:normal;max-width:130px;}

/* ── STATUS BADGES ── */
.ev-status{display:inline-flex;align-items:center;gap:.3rem;padding:.22rem .68rem;border-radius:20px;font-size:.67rem;font-weight:600;letter-spacing:.04em;white-space:nowrap;font-family:var(--font-body);}
.ev-status::before{content:'';width:5px;height:5px;border-radius:50%;flex-shrink:0;}
.ev-status.planning{background:rgba(99,102,241,.1);color:#3730A3;border:1px solid rgba(99,102,241,.22);}
.ev-status.planning::before{background:#6366F1;}
.ev-status.confirmed{background:rgba(16,185,129,.1);color:#065F46;border:1px solid rgba(16,185,129,.22);}
.ev-status.confirmed::before{background:#10B981;}
.ev-status.ongoing{background:rgba(201,168,76,.1);color:var(--gold-dark);border:1px solid rgba(201,168,76,.25);}
.ev-status.ongoing::before{background:var(--gold);}
.ev-status.completed{background:rgba(107,114,128,.1);color:#374151;border:1px solid rgba(107,114,128,.22);}
.ev-status.completed::before{background:#6B7280;}
.ev-status.cancelled{background:rgba(239,68,68,.1);color:#991B1B;border:1px solid rgba(239,68,68,.22);}
.ev-status.cancelled::before{background:#EF4444;}

/* Empty state */
.ev-empty{text-align:center;padding:3.5rem 1rem;}
.ev-empty-icon{width:48px;height:48px;border-radius:50%;background:rgba(201,168,76,.08);display:flex;align-items:center;justify-content:center;margin:0 auto .8rem;color:var(--gold-dark);}
.ev-empty-icon svg{width:22px;height:22px;}
.ev-empty-title{font-family:var(--font-display);font-size:.95rem;font-weight:700;color:var(--charcoal);margin-bottom:.3rem;}
.ev-empty-desc{font-size:.78rem;color:var(--warm-grey);}

/* Pagination */
.ev-pagination{display:flex;justify-content:flex-end;margin-top:1rem;}
</style>

<div class="p-6">

    {{-- ── TOP ROW ── --}}
    <div class="ev-top">
        <div>
            <h2 class="ev-title">All <em>Events</em></h2>
            <p class="ev-subtitle">Monitor and manage all client events across the platform</p>
        </div>
        <span class="ev-badge">{{ $events->total() }} event{{ $events->total() !== 1 ? 's' : '' }}</span>
    </div>

    {{-- ── STATS ── --}}
    @php
        $typeLabels = ['Wedding','Debut','Birthday','Corporate','Anniversary','Baptism','Other'];
    @endphp
    <div class="ev-stats">
        <div class="ev-stat">
            <div class="ev-stat-val">{{ number_format($stats['total'] ?? 0) }}</div>
            <div class="ev-stat-lbl">Total Events</div>
        </div>
        <div class="ev-stat gold">
            <div class="ev-stat-val">₱{{ number_format($stats['avg_budget'] ?? 0) }}</div>
            <div class="ev-stat-lbl">Avg. Budget</div>
        </div>
        <div class="ev-stat">
            <div class="ev-stat-val">{{ number_format($stats['avg_guests'] ?? 0) }}</div>
            <div class="ev-stat-lbl">Avg. Guests</div>
        </div>
        <div class="ev-stat">
            <div class="ev-stat-val">{{ number_format($stats['this_month'] ?? 0) }}</div>
            <div class="ev-stat-lbl">This Month</div>
        </div>
        <div class="ev-stat gold">
            <div class="ev-stat-val">₱{{ number_format($stats['total_budget'] ?? 0) }}</div>
            <div class="ev-stat-lbl">Total Budget</div>
        </div>
    </div>

    {{-- ── TOOLBAR ── --}}
    <div class="ev-toolbar">
        <div class="ev-search-wrap">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="9" cy="9" r="6"/><path d="M15 15l3 3"/>
            </svg>
            <input type="text"
                   id="searchInput"
                   placeholder="Search event name, client, venue, location…"
                   value="{{ request('search') }}"
                   autocomplete="off">
        </div>

        <select id="typeFilter" class="ev-select">
            <option value="">All Event Types</option>
            @foreach($typeLabels as $et)
                <option value="{{ $et }}" {{ request('event_type') === $et ? 'selected' : '' }}>{{ $et }}</option>
            @endforeach
        </select>

        <select id="statusFilter" class="ev-select">
            <option value="">All Status</option>
            @foreach(['planning','confirmed','ongoing','completed','cancelled'] as $st)
                <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
            @endforeach
        </select>

        <input type="date" id="dateFrom" class="ev-select" value="{{ request('date_from') }}" title="From date" style="padding-right:.85rem;">
        <input type="date" id="dateTo"   class="ev-select" value="{{ request('date_to') }}"   title="To date"   style="padding-right:.85rem;">
    </div>

    {{-- Active filter pills --}}
    <div class="ev-pills" id="filterPills"></div>

    {{-- Loading --}}
    <div class="ev-loading" id="loadingBar">
        <div class="ev-spinner"></div>
        Filtering…
    </div>

    <div class="ev-result-info" id="resultInfo"></div>

    {{-- ── TABLE CARD ── --}}
    <div class="ev-card">
        <div class="scroll-hint">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6">
                <path d="M4 10h12M10 4l6 6-6 6"/>
            </svg>
            Scroll sideways to see more
        </div>
        <div class="tbl-wrap">
            <table class="ev-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Client</th>
                        <th>Event Name</th>
                        <th>Type</th>
                        <th>Budget</th>
                        <th>Guests</th>
                        <th>Venue</th>
                        <th>Time &amp; Location</th>{{-- NEW --}}
                        <th>Event Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="eventsTbody">
                    @forelse($events as $i => $event)
                    @php
                        $clientName = $event->user->name    ?? 'N/A';
                        $evtDate    = $event->event_date
                                        ? \Carbon\Carbon::parse($event->event_date)->format('M d, Y')
                                        : '—';
                        $evtType    = $event->event_type    ?? '';
                        $evtStatus  = $event->status        ?? 'planning';
                        $evtTime    = $event->event_time    ?? null;
                        $evtLoc     = $event->location      ?? null;

                        /* Format event_time HH:MM → 12-hour */
                        $evtTimeFmt = null;
                        if ($evtTime) {
                            $tp = explode(':', $evtTime);
                            $h  = (int) $tp[0];
                            $m  = $tp[1] ?? '00';
                            $ap = $h >= 12 ? 'PM' : 'AM';
                            $h  = $h % 12 ?: 12;
                            $evtTimeFmt = $h . ':' . $m . ' ' . $ap;
                        }
                    @endphp
                    <tr data-search="{{ strtolower($clientName.' '.$event->event_name.' '.($event->venue ?? '').' '.$evtType.' '.($evtLoc ?? '')) }}"
                        data-type="{{ strtolower($evtType) }}"
                        data-status="{{ strtolower($evtStatus) }}"
                        data-date="{{ $event->event_date }}">

                        <td class="td-num">{{ $events->firstItem() + $i }}</td>

                        <td>
                            <div class="td-client-name">{{ $clientName }}</div>
                            <div class="td-client-sub">ID: {{ $event->user_id }}</div>
                        </td>

                        <td>
                            <div class="td-ev-name">{{ $event->event_name }}</div>
                        </td>

                        <td>
                            @if($evtType)
                                <span class="td-ev-type">{{ $evtType }}</span>
                            @else
                                <span style="color:#C0B8B0;font-size:.78rem;">—</span>
                            @endif
                        </td>

                        <td>
                            <div class="td-budget">₱{{ number_format($event->budget) }}</div>
                        </td>

                        <td>
                            <div class="td-guests">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="#706B65" stroke-width="1.6">
                                    <circle cx="7" cy="6" r="3"/>
                                    <path d="M1 17c0-3 2.7-5 6-5"/>
                                    <circle cx="13" cy="6" r="3"/>
                                    <path d="M19 17c0-3-2.7-5-6-5s-6 2-6 5"/>
                                </svg>
                                {{ number_format($event->guest_count) }}
                            </div>
                        </td>

                        <td>
                            <div class="td-venue">{{ $event->venue ?? '—' }}</div>
                        </td>

                        {{-- NEW: Time & Location column --}}
                        <td>
                            <div class="td-time-loc">
                                @if($evtTimeFmt)
                                    {{ $evtTimeFmt }}
                                @else
                                    <span style="color:#C0B8B0;font-style:italic;font-size:.75rem;">—</span>
                                @endif
                                @if($evtLoc)
                                    <small>{{ $evtLoc }}</small>
                                @else
                                    <small style="color:#C0B8B0;font-style:italic;">No location</small>
                                @endif
                            </div>
                        </td>

                        <td>
                            <div class="td-date">{{ $evtDate }}</div>
                        </td>

                        <td>
                            <span class="ev-status {{ strtolower($evtStatus) }}">
                                {{ ucfirst($evtStatus) }}
                            </span>
                        </td>

                    </tr>
                    @empty
                    <tr id="staticEmpty">
                        <td colspan="10">
                            <div class="ev-empty">
                                <div class="ev-empty-icon">
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect x="3" y="4" width="14" height="13" rx="2"/>
                                        <path d="M3 8h14M8 4V2M12 4V2"/>
                                    </svg>
                                </div>
                                <div class="ev-empty-title">No Events Found</div>
                                <div class="ev-empty-desc">No events have been added yet.</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($events->hasPages())
    <div class="ev-pagination">
        {{ $events->withQueryString()->links() }}
    </div>
    @endif

</div>

<script>
const searchInput  = document.getElementById('searchInput');
const typeFilter   = document.getElementById('typeFilter');
const statusFilter = document.getElementById('statusFilter');
const dateFrom     = document.getElementById('dateFrom');
const dateTo       = document.getElementById('dateTo');
const tbody        = document.getElementById('eventsTbody');
const loadingBar   = document.getElementById('loadingBar');
const resultInfo   = document.getElementById('resultInfo');
const filterPills  = document.getElementById('filterPills');

let debounceTimer;

/* ── Client-side live filter ── */
function applyFilters() {
    const q      = searchInput.value.trim().toLowerCase();
    const type   = typeFilter.value.toLowerCase();
    const status = statusFilter.value.toLowerCase();
    const from   = dateFrom.value;
    const to     = dateTo.value;

    let visible = 0;
    const rows = tbody.querySelectorAll('tr[data-search]');

    rows.forEach(function(row) {
        const matchQ      = !q      || (row.dataset.search  || '').includes(q);
        const matchType   = !type   || (row.dataset.type    || '') === type;
        const matchStatus = !status || (row.dataset.status  || '') === status;
        const rowDate     = row.dataset.date || '';
        const matchFrom   = !from   || rowDate >= from;
        const matchTo     = !to     || rowDate <= to;

        const show = matchQ && matchType && matchStatus && matchFrom && matchTo;
        row.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    /* Dynamic no-results row */
    let liveEmpty = document.getElementById('liveEmpty');
    if (visible === 0 && rows.length > 0) {
        if (!liveEmpty) {
            liveEmpty = document.createElement('tr');
            liveEmpty.id = 'liveEmpty';
            liveEmpty.innerHTML = '<td colspan="10">'
                + '<div class="ev-empty">'
                + '<div class="ev-empty-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="9" cy="9" r="6"/><path d="M15 15l3 3"/></svg></div>'
                + '<div class="ev-empty-title">No Matching Events</div>'
                + '<div class="ev-empty-desc">Try adjusting your search or filters.</div>'
                + '</div></td>';
            tbody.appendChild(liveEmpty);
        }
        liveEmpty.style.display = '';
    } else if (liveEmpty) {
        liveEmpty.style.display = 'none';
    }

    resultInfo.textContent = rows.length
        ? 'Showing ' + visible + ' of ' + rows.length + ' events on this page'
        : '';

    renderPills();
}

/* ── Render pills ── */
function renderPills() {
    filterPills.innerHTML = '';

    function addPill(labelHtml, clearKey) {
        const p = document.createElement('div');
        p.className = 'ev-pill';

        const span = document.createElement('span');
        span.innerHTML = labelHtml;

        const btn = document.createElement('button');
        btn.className = 'ev-pill-x';
        btn.title = 'Clear filter';
        btn.textContent = '✕';
        btn.addEventListener('click', function() { clearF(clearKey); });

        p.appendChild(span);
        p.appendChild(btn);
        filterPills.appendChild(p);
    }

    if (searchInput.value.trim()) addPill('Search: <strong>' + esc(searchInput.value.trim()) + '</strong>', 'search');
    if (typeFilter.value)         addPill('Type: <strong>'   + esc(typeFilter.value)           + '</strong>', 'type');
    if (statusFilter.value)       addPill('Status: <strong>' + esc(ucFirst(statusFilter.value)) + '</strong>', 'status');
    if (dateFrom.value)           addPill('From: <strong>'   + esc(dateFrom.value)              + '</strong>', 'from');
    if (dateTo.value)             addPill('To: <strong>'     + esc(dateTo.value)                + '</strong>', 'to');
}

/* ── Clear filter ── */
function clearF(which) {
    if (which === 'search') searchInput.value  = '';
    if (which === 'type')   typeFilter.value   = '';
    if (which === 'status') statusFilter.value = '';
    if (which === 'from')   dateFrom.value     = '';
    if (which === 'to')     dateTo.value       = '';
    applyFilters();
    debouncedFetch();
}
window.clearF = clearF;

/* ── Debounced server reload ── */
function debouncedFetch() {
    clearTimeout(debounceTimer);
    loadingBar.classList.add('show');
    debounceTimer = setTimeout(function() {
        const p = new URLSearchParams();
        if (searchInput.value.trim())  p.set('search',     searchInput.value.trim());
        if (typeFilter.value)          p.set('event_type', typeFilter.value);
        if (statusFilter.value)        p.set('status',     statusFilter.value);
        if (dateFrom.value)            p.set('date_from',  dateFrom.value);
        if (dateTo.value)              p.set('date_to',    dateTo.value);
        window.location.href = window.location.pathname + (p.toString() ? '?' + p : '');
    }, 700);
}

/* ── Bindings ── */
searchInput.addEventListener('input',   function(){ applyFilters(); debouncedFetch(); });
typeFilter.addEventListener('change',   function(){ applyFilters(); debouncedFetch(); });
statusFilter.addEventListener('change', function(){ applyFilters(); debouncedFetch(); });
dateFrom.addEventListener('change',     function(){ applyFilters(); debouncedFetch(); });
dateTo.addEventListener('change',       function(){ applyFilters(); debouncedFetch(); });

/* ── Init ── */
applyFilters();

/* ── Helpers ── */
function esc(s){ return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }
function ucFirst(s){ return s ? s.charAt(0).toUpperCase() + s.slice(1) : s; }
</script>

</x-app-layout>