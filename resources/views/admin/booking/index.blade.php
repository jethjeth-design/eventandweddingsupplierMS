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
    --status-pending-bg:rgba(234,179,8,0.1); --status-pending-c:#92400E;
    --status-confirmed-bg:rgba(16,185,129,0.1); --status-confirmed-c:#065F46;
    --status-cancelled-bg:rgba(239,68,68,0.1); --status-cancelled-c:#991B1B;
}

/* ── TOP ROW ── */
.bk-top{display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:.75rem;margin-bottom:1.4rem;}
.bk-title{font-family:var(--font-display);font-size:1.65rem;font-weight:700;color:var(--charcoal);line-height:1.15;}
.bk-title em{font-style:italic;color:var(--gold-dark);}
.bk-subtitle{font-size:.76rem;color:var(--warm-grey);margin-top:.2rem;font-family:var(--font-body);}
.bk-badge{font-size:.65rem;font-weight:500;letter-spacing:.07em;text-transform:uppercase;color:var(--gold-dark);background:var(--gold-light);border:1px solid rgba(201,168,76,.3);padding:.28rem .75rem;border-radius:20px;white-space:nowrap;font-family:var(--font-body);}

/* ── TOOLBAR ── */
.bk-toolbar{display:flex;align-items:center;gap:.65rem;flex-wrap:wrap;margin-bottom:1rem;}
.bk-search-wrap{display:flex;align-items:center;gap:.5rem;flex:1;min-width:200px;background:var(--white);border:1.5px solid var(--border);border-radius:8px;padding:.42rem .85rem;transition:border-color .2s,box-shadow .2s;}
.bk-search-wrap:focus-within{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,.1);}
.bk-search-wrap svg{width:13px;height:13px;color:#C0B8B0;flex-shrink:0;}
.bk-search-wrap input{border:none;outline:none;background:transparent;font-family:var(--font-body);font-size:.8rem;color:var(--charcoal);width:100%;}
.bk-search-wrap input::placeholder{color:#C0B8B0;}

.bk-select{padding:.42rem .85rem;border:1.5px solid var(--border);border-radius:8px;font-family:var(--font-body);font-size:.8rem;color:var(--charcoal);background:var(--white);outline:none;cursor:pointer;transition:border-color .2s;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' fill='none' stroke='%23C0B8B0' stroke-width='1.5'%3E%3Cpath d='M1 1l4 4 4-4'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right .6rem center;padding-right:1.8rem;}
.bk-select:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,.1);}

/* Active filter pill */
.bk-filter-pills{display:flex;align-items:center;gap:.4rem;flex-wrap:wrap;margin-bottom:.65rem;}
.bk-pill{display:inline-flex;align-items:center;gap:.35rem;padding:.22rem .65rem;border-radius:999px;background:rgba(201,168,76,.1);border:1px solid rgba(201,168,76,.3);color:var(--gold-dark);font-size:.68rem;font-weight:600;font-family:var(--font-body);}
.bk-pill button{background:none;border:none;cursor:pointer;color:var(--gold-dark);padding:0;line-height:1;font-size:.75rem;opacity:.7;}
.bk-pill button:hover{opacity:1;}

/* Loading overlay */
.bk-loading{display:none;align-items:center;gap:.5rem;font-size:.75rem;color:var(--warm-grey);font-family:var(--font-body);padding:.3rem 0;}
.bk-loading.show{display:flex;}
.bk-spinner{width:13px;height:13px;border:2px solid rgba(201,168,76,.3);border-top-color:var(--gold);border-radius:50%;animation:spin .6s linear infinite;flex-shrink:0;}
@keyframes spin{to{transform:rotate(360deg);}}

/* ── CARD SHELL ── */
.bk-card{background:var(--white);border:1.5px solid var(--border);border-radius:14px;overflow:hidden;}
.scroll-hint{display:none;align-items:center;gap:.4rem;font-size:.68rem;color:var(--warm-grey);padding:.55rem 1rem .1rem;font-family:var(--font-body);}
.scroll-hint svg{width:13px;height:13px;flex-shrink:0;}
@media(max-width:640px){.scroll-hint{display:flex;}}

.tbl-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch;scrollbar-width:thin;scrollbar-color:rgba(201,168,76,.4) transparent;}
.tbl-wrap::-webkit-scrollbar{height:4px;}
.tbl-wrap::-webkit-scrollbar-thumb{background:rgba(201,168,76,.45);border-radius:4px;}

/* ── TABLE ── */
.bk-table{width:100%;min-width:780px;border-collapse:collapse;font-family:var(--font-body);}
.bk-table thead{background:var(--ivory);border-bottom:1.5px solid var(--border);}
.bk-table thead th{padding:.8rem 1.1rem;font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--warm-grey);text-align:left;white-space:nowrap;}
.bk-table thead th:first-child{border-left:3px solid var(--gold);}
.bk-table tbody tr{border-bottom:1px solid #F0EBE5;transition:background .15s;}
.bk-table tbody tr:last-child{border-bottom:none;}
.bk-table tbody tr:hover{background:rgba(201,168,76,.04);}
.bk-table td{padding:.9rem 1.1rem;font-size:.83rem;color:var(--charcoal);vertical-align:middle;}
.bk-table tbody td:first-child{border-left:3px solid transparent;}
.bk-table tbody tr:hover td:first-child{border-left-color:rgba(201,168,76,.45);}

/* ── CELL TYPES ── */
.td-num{color:#C0B8B0;font-size:.72rem;width:40px;}
.td-event-name{font-family:var(--font-display);font-weight:700;font-size:.88rem;color:var(--charcoal);white-space:nowrap;}
.td-event-type{font-size:.68rem;color:var(--warm-grey);margin-top:2px;}
.td-event-type span{display:inline-flex;align-items:center;padding:.15rem .55rem;border-radius:20px;background:var(--gold-light);border:1px solid rgba(201,168,76,.22);color:var(--gold-dark);font-size:.65rem;font-weight:500;}
.td-client{font-size:.82rem;color:var(--charcoal);}
.td-client small{display:block;font-size:.68rem;color:var(--warm-grey);}
.td-supplier{font-size:.82rem;font-weight:600;color:var(--charcoal);white-space:nowrap;}
.td-supplier small{display:block;font-size:.68rem;color:var(--warm-grey);font-weight:400;}
.td-package{font-size:.82rem;color:var(--charcoal);max-width:160px;}
.td-date{font-size:.8rem;color:var(--charcoal);white-space:nowrap;}
.td-date small{display:block;font-size:.68rem;color:var(--warm-grey);}
.td-price{font-weight:700;font-size:.9rem;color:var(--gold-dark);white-space:nowrap;}
.td-price small{font-size:.66rem;color:var(--warm-grey);font-weight:400;margin-left:2px;}

/* Status badges */
.bk-status{display:inline-flex;align-items:center;gap:.3rem;padding:.25rem .7rem;border-radius:20px;font-size:.68rem;font-weight:600;letter-spacing:.04em;white-space:nowrap;font-family:var(--font-body);}
.bk-status::before{content:'';width:5px;height:5px;border-radius:50%;flex-shrink:0;}
.bk-status.pending{background:var(--status-pending-bg);color:var(--status-pending-c);border:1px solid rgba(234,179,8,.25);}
.bk-status.pending::before{background:#D97706;}
.bk-status.confirmed{background:var(--status-confirmed-bg);color:var(--status-confirmed-c);border:1px solid rgba(16,185,129,.25);}
.bk-status.confirmed::before{background:#10B981;}
.bk-status.cancelled{background:var(--status-cancelled-bg);color:var(--status-cancelled-c);border:1px solid rgba(239,68,68,.25);}
.bk-status.cancelled::before{background:#EF4444;}

/* Empty / no results */
.bk-empty{text-align:center;padding:3.5rem 1rem;}
.bk-empty-icon{width:48px;height:48px;border-radius:50%;background:rgba(201,168,76,.08);display:flex;align-items:center;justify-content:center;margin:0 auto .8rem;color:var(--gold-dark);}
.bk-empty-icon svg{width:22px;height:22px;}
.bk-empty-title{font-family:var(--font-display);font-size:.95rem;font-weight:700;color:var(--charcoal);margin-bottom:.3rem;}
.bk-empty-desc{font-size:.78rem;color:var(--warm-grey);}

/* Stats row */
.bk-stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:.75rem;margin-bottom:1.25rem;}
.bk-stat{background:var(--white);border:1.5px solid var(--border);border-radius:10px;padding:.85rem 1rem;}
.bk-stat-val{font-family:var(--font-display);font-size:1.35rem;font-weight:700;color:var(--charcoal);line-height:1;}
.bk-stat-lbl{font-size:.68rem;color:var(--warm-grey);margin-top:.28rem;font-family:var(--font-body);}
.bk-stat.gold .bk-stat-val{color:var(--gold-dark);}

/* Pagination */
.bk-pagination{display:flex;justify-content:flex-end;margin-top:1rem;}

/* Result count */
.bk-result-info{font-size:.72rem;color:var(--warm-grey);font-family:var(--font-body);padding:.4rem 0 .6rem;}
</style>

<div class="p-6">

    {{-- ── TOP ROW ── --}}
    <div class="bk-top">
        <div>
            <h2 class="bk-title">All <em>Bookings</em></h2>
            <p class="bk-subtitle">Manage and monitor bookings across all suppliers and clients</p>
        </div>
        <span class="bk-badge" id="totalBadge">
            {{ $bookings->total() }} booking{{ $bookings->total() !== 1 ? 's' : '' }}
        </span>
    </div>

    {{-- ── STATS ROW ── --}}
    @php
        $statPending   = $allStats['pending']   ?? 0;
        $statConfirmed = $allStats['confirmed'] ?? 0;
        $statCancelled = $allStats['cancelled'] ?? 0;
        $statTotal     = $statPending + $statConfirmed + $statCancelled;
        $statRevenue   = $allStats['revenue']   ?? 0;
    @endphp
    <div class="bk-stats">
        <div class="bk-stat">
            <div class="bk-stat-val">{{ number_format($statTotal) }}</div>
            <div class="bk-stat-lbl">Total Bookings</div>
        </div>
        <div class="bk-stat" style="border-left:3px solid #D97706;">
            <div class="bk-stat-val" style="color:#92400E;">{{ number_format($statPending) }}</div>
            <div class="bk-stat-lbl">Pending</div>
        </div>
        <div class="bk-stat" style="border-left:3px solid #10B981;">
            <div class="bk-stat-val" style="color:#065F46;">{{ number_format($statConfirmed) }}</div>
            <div class="bk-stat-lbl">Confirmed</div>
        </div>
        <div class="bk-stat" style="border-left:3px solid #EF4444;">
            <div class="bk-stat-val" style="color:#991B1B;">{{ number_format($statCancelled) }}</div>
            <div class="bk-stat-lbl">Cancelled</div>
        </div>
        <div class="bk-stat gold">
            <div class="bk-stat-val">₱{{ number_format($statRevenue) }}</div>
            <div class="bk-stat-lbl">Total Revenue</div>
        </div>
    </div>

    {{-- ── TOOLBAR ── --}}
    <div class="bk-toolbar" id="toolbar">
        {{-- Live search --}}
        <div class="bk-search-wrap">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="9" cy="9" r="6"/><path d="M15 15l3 3"/>
            </svg>
            <input type="text"
                   id="searchInput"
                   placeholder="Search event, client, supplier, package…"
                   value="{{ request('search') }}"
                   autocomplete="off">
        </div>

        {{-- Status filter --}}
        <select id="statusFilter" class="bk-select">
            <option value="">All Status</option>
            <option value="pending"   {{ request('status')   === 'pending'   ? 'selected' : '' }}>Pending</option>
            <option value="confirmed" {{ request('status')   === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="cancelled" {{ request('status')   === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>

        {{-- Event type filter --}}
        <select id="eventTypeFilter" class="bk-select">
            <option value="">All Event Types</option>
            @foreach(['Wedding','Debut','Birthday','Corporate','Anniversary','Baptism','Other'] as $et)
                <option value="{{ $et }}" {{ request('event_type') === $et ? 'selected' : '' }}>{{ $et }}</option>
            @endforeach
        </select>

        {{-- Date range --}}
        <input type="date" id="dateFrom" class="bk-select" value="{{ request('date_from') }}" title="From date" style="padding-right:.85rem;">
        <input type="date" id="dateTo"   class="bk-select" value="{{ request('date_to') }}"   title="To date"   style="padding-right:.85rem;">
    </div>

    {{-- Active filter pills --}}
    <div class="bk-filter-pills" id="filterPills"></div>

    {{-- Loading indicator --}}
    <div class="bk-loading" id="loadingBar">
        <div class="bk-spinner"></div>
        Filtering…
    </div>

    {{-- Result info --}}
    <div class="bk-result-info" id="resultInfo"></div>

    {{-- ── CARD + TABLE ── --}}
    <div class="bk-card">
        <div class="scroll-hint">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6">
                <path d="M4 10h12M10 4l6 6-6 6"/>
            </svg>
            Scroll sideways to see more
        </div>
        <div class="tbl-wrap">
            <table class="bk-table" id="bookingsTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Event</th>
                        <th>Client</th>
                        <th>Supplier</th>
                        <th>Package</th>
                        <th>Event Date</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="bookingsTbody">
                    @forelse($bookings as $i => $booking)
                    @php
                        $evtName   = $booking->event->event_name ?? '—';
                        $evtType   = $booking->event->event_type ?? '';
                        $clientId  = $booking->user_id ?? '—';
                        $clientName= $booking->user->name ?? null;
                        $supName   = $booking->package->supplier->business_name
                                  ?? trim(($booking->package->supplier->first_name ?? '').' '.($booking->package->supplier->last_name ?? ''))
                                  ?: 'N/A';
                        $pkgName   = $booking->package->name ?? '—';
                        $evtDate   = $booking->event_date ? \Carbon\Carbon::parse($booking->event_date)->format('M d, Y') : '—';
                        $price     = $booking->total_price ?? 0;
                        $status    = $booking->status ?? 'pending';
                    @endphp
                    <tr data-search="{{ strtolower($evtName.' '.$evtType.' '.($clientName ?? $clientId).' '.$supName.' '.$pkgName) }}"
                        data-status="{{ $status }}"
                        data-event-type="{{ strtolower($evtType) }}"
                        data-date="{{ $booking->event_date }}">
                        <td class="td-num">{{ $bookings->firstItem() + $i }}</td>
                        <td>
                            <div class="td-event-name">{{ $evtName }}</div>
                            @if($evtType)
                            <div class="td-event-type"><span>{{ $evtType }}</span></div>
                            @endif
                        </td>
                        <td>
                            <div class="td-client">
                                {{ $clientName ?? 'User #'.$clientId }}
                                @if($clientName)<small>ID: {{ $clientId }}</small>@endif
                            </div>
                        </td>
                        <td>
                            <div class="td-supplier">
                                {{ $supName }}
                                @if($booking->package->supplier->city ?? false)
                                <small>{{ $booking->package->supplier->city }}</small>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="td-package">{{ $pkgName }}</div>
                        </td>
                        <td>
                            <div class="td-date">
                                {{ $evtDate }}
                            </div>
                        </td>
                        <td>
                            <div class="td-price">
                                ₱{{ number_format($price) }}
                                <small>total</small>
                            </div>
                        </td>
                        <td>
                            <span class="bk-status {{ $status }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr id="emptyRow">
                        <td colspan="8">
                            <div class="bk-empty">
                                <div class="bk-empty-icon">
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect x="3" y="4" width="14" height="13" rx="2"/>
                                        <path d="M3 8h14M8 4V2M12 4V2"/>
                                    </svg>
                                </div>
                                <div class="bk-empty-title">No Bookings Found</div>
                                <div class="bk-empty-desc">No bookings match your current filters.</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($bookings->hasPages())
    <div class="bk-pagination">
        {{ $bookings->withQueryString()->links() }}
    </div>
    @endif

</div>

<script>
/* ══════════════════════════════════════════════════════
   LIVE FILTER — client-side for current page rows
   + URL update (debounced) to reload from server
══════════════════════════════════════════════════════ */

const searchInput     = document.getElementById('searchInput');
const statusFilter    = document.getElementById('statusFilter');
const eventTypeFilter = document.getElementById('eventTypeFilter');
const dateFrom        = document.getElementById('dateFrom');
const dateTo          = document.getElementById('dateTo');
const tbody           = document.getElementById('bookingsTbody');
const loadingBar      = document.getElementById('loadingBar');
const resultInfo      = document.getElementById('resultInfo');
const totalBadge      = document.getElementById('totalBadge');
const filterPills     = document.getElementById('filterPills');

let debounceTimer;

/* ── Apply filters client-side on current page rows ── */
function applyFilters() {
    const q       = searchInput.value.trim().toLowerCase();
    const status  = statusFilter.value.toLowerCase();
    const evtType = eventTypeFilter.value.toLowerCase();
    const from    = dateFrom.value;
    const to      = dateTo.value;

    let visible = 0;
    const rows = tbody.querySelectorAll('tr[data-search]');

    rows.forEach(function(row) {
        const rowSearch  = row.dataset.search  || '';
        const rowStatus  = row.dataset.status  || '';
        const rowEvtType = row.dataset.eventType || '';
        const rowDate    = row.dataset.date    || '';

        const matchQ    = !q       || rowSearch.includes(q);
        const matchSt   = !status  || rowStatus === status;
        const matchEt   = !evtType || rowEvtType === evtType;
        const matchFrom = !from    || rowDate >= from;
        const matchTo   = !to      || rowDate <= to;

        const show = matchQ && matchSt && matchEt && matchFrom && matchTo;
        row.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    /* Show/hide empty message */
    let emptyRow = document.getElementById('liveEmptyRow');
    if (visible === 0 && rows.length > 0) {
        if (!emptyRow) {
            emptyRow = document.createElement('tr');
            emptyRow.id = 'liveEmptyRow';
            emptyRow.innerHTML = `<td colspan="8">
                <div class="bk-empty">
                    <div class="bk-empty-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="9" cy="9" r="6"/><path d="M15 15l3 3"/>
                        </svg>
                    </div>
                    <div class="bk-empty-title">No Matching Bookings</div>
                    <div class="bk-empty-desc">Try adjusting your search or filters.</div>
                </div>
            </td>`;
            tbody.appendChild(emptyRow);
        }
        emptyRow.style.display = '';
    } else if (emptyRow) {
        emptyRow.style.display = 'none';
    }

    resultInfo.textContent = rows.length > 0
        ? 'Showing ' + visible + ' of ' + rows.length + ' bookings on this page'
        : '';

    renderPills();
}

/* ── Render active filter pills ── */
function renderPills() {
    filterPills.innerHTML = '';
    function addPill(label, clearFn) {
        const p = document.createElement('div');
        p.className = 'bk-pill';
        p.innerHTML = label + '<button onclick="' + clearFn + '" title="Remove filter">✕</button>';
        filterPills.appendChild(p);
    }
    if (searchInput.value.trim())  addPill('Search: <strong>' + esc(searchInput.value.trim()) + '</strong>', 'clearFilter("search")');
    if (statusFilter.value)        addPill('Status: <strong>' + esc(ucFirst(statusFilter.value)) + '</strong>', 'clearFilter("status")');
    if (eventTypeFilter.value)     addPill('Type: <strong>' + esc(eventTypeFilter.value) + '</strong>', 'clearFilter("eventType")');
    if (dateFrom.value)            addPill('From: <strong>' + dateFrom.value + '</strong>', 'clearFilter("dateFrom")');
    if (dateTo.value)              addPill('To: <strong>' + dateTo.value + '</strong>', 'clearFilter("dateTo")');
}

window.clearFilter = function(which) {
    if (which === 'search')    { searchInput.value = ''; }
    if (which === 'status')    { statusFilter.value = ''; }
    if (which === 'eventType') { eventTypeFilter.value = ''; }
    if (which === 'dateFrom')  { dateFrom.value = ''; }
    if (which === 'dateTo')    { dateTo.value = ''; }
    applyFilters();
    debouncedServerFetch();
};

/* ── Debounced server fetch (updates URL + reloads for pagination) ── */
function debouncedServerFetch() {
    clearTimeout(debounceTimer);
    loadingBar.classList.add('show');
    debounceTimer = setTimeout(function() {
        const params = new URLSearchParams();
        if (searchInput.value.trim())  params.set('search',     searchInput.value.trim());
        if (statusFilter.value)        params.set('status',     statusFilter.value);
        if (eventTypeFilter.value)     params.set('event_type', eventTypeFilter.value);
        if (dateFrom.value)            params.set('date_from',  dateFrom.value);
        if (dateTo.value)              params.set('date_to',    dateTo.value);

        const newUrl = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
        window.location.href = newUrl;
    }, 700);
}

/* ── Event bindings ── */
searchInput.addEventListener('input', function() {
    applyFilters();
    debouncedServerFetch();
});

[statusFilter, eventTypeFilter, dateFrom, dateTo].forEach(function(el) {
    el.addEventListener('change', function() {
        applyFilters();
        debouncedServerFetch();
    });
});

/* ── Init ── */
applyFilters();

/* ── Helpers ── */
function esc(s) {
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}
function ucFirst(s) {
    return s ? s.charAt(0).toUpperCase() + s.slice(1) : s;
}
</script>

</x-app-layout>