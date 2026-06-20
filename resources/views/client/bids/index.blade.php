<x-client-layout>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap');

:root {
    --gold:#C9A84C; --gold-dark:#8A6A1F; --gold-light:rgba(201,168,76,0.12);
    --ivory:#FAF7F2; --charcoal:#1E1B18; --warm-grey:#706B65;
    --border:#E5DDD5; --border-md:#E0D8D0; --white:#FFFFFF;
    --font-display:'Playfair Display',Georgia,serif;
    --font-body:'DM Sans',sans-serif;
    --radius:12px; --shadow:0 2px 16px rgba(30,27,24,.07);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

/* ── PAGE WRAP ── */
.bd-page { max-width: 1100px; margin: 0 auto; padding: 1.75rem 1.5rem 4rem; }

/* ── TOP ROW ── */
.bd-top {
    display: flex; justify-content: space-between;
    align-items: flex-end; flex-wrap: wrap;
    gap: .75rem; margin-bottom: 1.4rem;
}
.bd-title {
    font-family: var(--font-display);
    font-size: clamp(1.35rem, 2.5vw, 1.75rem);
    font-weight: 700; color: var(--charcoal); line-height: 1.15;
}
.bd-title em { font-style: italic; color: var(--gold-dark); }
.bd-subtitle { font-size: .76rem; color: var(--warm-grey); margin-top: .2rem; font-family: var(--font-body); }
.bd-count-badge {
    font-size: .65rem; font-weight: 700; letter-spacing: .07em;
    text-transform: uppercase; color: var(--gold-dark);
    background: var(--gold-light); border: 1px solid rgba(201,168,76,.3);
    padding: .28rem .85rem; border-radius: 20px; white-space: nowrap;
    font-family: var(--font-body); flex-shrink: 0;
}

/* ── STATS ROW ── */
.bd-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: .85rem; margin-bottom: 1.5rem;
}
@media (max-width: 640px) { .bd-stats { grid-template-columns: repeat(2, 1fr); } }

.bd-stat {
    background: var(--white); border: 1.5px solid var(--border);
    border-radius: var(--radius); padding: 1rem 1.1rem;
    position: relative; overflow: hidden;
}
.bd-stat::before {
    content: ''; position: absolute;
    top: 0; left: 0; right: 0; height: 2px;
}
.bd-stat.s-all::before     { background: linear-gradient(90deg, var(--gold), #D4A090); }
.bd-stat.s-pending::before  { background: #D97706; }
.bd-stat.s-accepted::before { background: #10B981; }
.bd-stat.s-rejected::before { background: #EF4444; }
.bd-stat-val {
    font-family: var(--font-display);
    font-size: 1.6rem; font-weight: 700; color: var(--charcoal); line-height: 1;
}
.bd-stat.s-all .bd-stat-val     { color: var(--gold-dark); }
.bd-stat.s-pending .bd-stat-val  { color: #92400E; }
.bd-stat.s-accepted .bd-stat-val { color: #065F46; }
.bd-stat.s-rejected .bd-stat-val { color: #991B1B; }
.bd-stat-lbl {
    font-size: .62rem; font-weight: 700; letter-spacing: .1em;
    text-transform: uppercase; color: var(--warm-grey);
    margin-top: .28rem; font-family: var(--font-body);
}

/* ── TOOLBAR ── */
.bd-toolbar {
    display: flex; align-items: center;
    gap: .65rem; flex-wrap: wrap; margin-bottom: 1.35rem;
}
.bd-search-wrap {
    display: flex; align-items: center; gap: .5rem;
    flex: 1; min-width: 180px; max-width: 320px;
    background: var(--white); border: 1.5px solid var(--border);
    border-radius: 8px; padding: .48rem .85rem;
    transition: border-color .2s, box-shadow .2s;
}
.bd-search-wrap:focus-within { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,.1); }
.bd-search-wrap svg { width: 13px; height: 13px; color: #C0B8B0; flex-shrink: 0; }
.bd-search-wrap input {
    border: none; outline: none; background: transparent;
    font-family: var(--font-body); font-size: .8rem;
    color: var(--charcoal); width: 100%;
}
.bd-search-wrap input::placeholder { color: #C0B8B0; }
.bd-select {
    padding: .48rem 2rem .48rem .85rem;
    border: 1.5px solid var(--border); border-radius: 8px;
    font-family: var(--font-body); font-size: .8rem;
    color: var(--charcoal); background: var(--white);
    outline: none; cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' fill='none' stroke='%23C0B8B0' stroke-width='1.5'%3E%3Cpath d='M1 1l4 4 4-4'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right .7rem center;
    transition: border-color .2s;
}
.bd-select:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,.1); }
.bd-result-count {
    font-size: .72rem; color: var(--warm-grey);
    font-family: var(--font-body); margin-left: auto; white-space: nowrap;
}

/* ════════════════════════════════
   BID CARDS GRID
════════════════════════════════ */
.bids-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.1rem;
}
@media (max-width: 680px) { .bids-grid { grid-template-columns: 1fr; } }

/* ── SINGLE BID CARD ── */
.bid-card {
    background: var(--white);
    border: 1.5px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    display: flex; flex-direction: column;
    transition: box-shadow .22s, transform .22s, border-color .22s;
    animation: bdFadeUp .3s ease both;
}
.bid-card:hover {
    box-shadow: 0 6px 28px rgba(30,27,24,.11);
    transform: translateY(-2px);
    border-color: rgba(201,168,76,.4);
}
.bid-card[data-hidden="true"] { display: none; }

@keyframes bdFadeUp {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Top accent bar (status-coloured) */
.bid-accent { height: 3px; flex-shrink: 0; }
.bid-accent.pending   { background: #D97706; }
.bid-accent.accepted  { background: #10B981; }
.bid-accent.confirmed { background: #10B981; }
.bid-accent.rejected  { background: #EF4444; }
.bid-accent.cancelled { background: #EF4444; }

/* Card head */
.bid-head {
    padding: 1rem 1.15rem .8rem;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: flex-start;
    justify-content: space-between; gap: .65rem;
}
.bid-pkg-name {
    font-family: var(--font-display);
    font-size: .96rem; font-weight: 700;
    color: var(--charcoal); line-height: 1.25; flex: 1;
}
.bid-pkg-supplier {
    font-size: .68rem; color: var(--warm-grey);
    margin-top: 3px; display: flex; align-items: center; gap: .25rem;
}
.bid-pkg-supplier svg { width: 10px; height: 10px; color: var(--gold-dark); flex-shrink: 0; }

/* Status badge */
.bid-status {
    display: inline-flex; align-items: center; gap: .28rem;
    font-size: .6rem; font-weight: 700; letter-spacing: .06em;
    text-transform: uppercase; padding: 3px 9px; border-radius: 999px;
    white-space: nowrap; flex-shrink: 0;
}
.bid-status svg { width: 8px; height: 8px; }
.bid-status.pending   { background: rgba(234,179,8,.1);   color: #92400E; border: 1px solid rgba(234,179,8,.3); }
.bid-status.accepted  { background: rgba(16,185,129,.1);  color: #065F46; border: 1px solid rgba(16,185,129,.3); }
.bid-status.confirmed { background: rgba(16,185,129,.1);  color: #065F46; border: 1px solid rgba(16,185,129,.3); }
.bid-status.rejected  { background: rgba(239,68,68,.1);   color: #991B1B; border: 1px solid rgba(239,68,68,.3); }
.bid-status.cancelled { background: rgba(239,68,68,.1);   color: #991B1B; border: 1px solid rgba(239,68,68,.3); }

/* Card body */
.bid-body { padding: .85rem 1.15rem; flex: 1; display: flex; flex-direction: column; gap: .6rem; }

/* Price block */
.bid-price-block {
    display: flex; align-items: center; justify-content: space-between;
    background: rgba(201,168,76,.05);
    border: 1px solid rgba(201,168,76,.18); border-radius: 8px;
    padding: .6rem .9rem;
}
.bid-price-label {
    font-size: .58rem; font-weight: 700; letter-spacing: .1em;
    text-transform: uppercase; color: var(--warm-grey); font-family: var(--font-body);
}
.bid-price-val {
    font-family: var(--font-display);
    font-size: 1.08rem; font-weight: 700; color: var(--gold-dark);
}

/* Meta row */
.bid-meta { display: flex; flex-wrap: wrap; gap: .4rem; }
.bid-chip {
    display: inline-flex; align-items: center; gap: .25rem;
    font-size: .62rem; color: var(--warm-grey);
    background: var(--ivory); border: 1px solid var(--border);
    padding: 2px 8px; border-radius: 3px; font-family: var(--font-body);
}
.bid-chip svg { width: 10px; height: 10px; color: var(--gold-dark); }

/* Card footer */
.bid-foot {
    padding: .7rem 1.15rem;
    border-top: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between; gap: .5rem;
}
.bid-date {
    display: flex; align-items: center; gap: .25rem;
    font-size: .65rem; color: #C0B8B0; font-family: var(--font-body);
}
.bid-date svg { width: 10px; height: 10px; }
.bid-view-btn {
    display: inline-flex; align-items: center; gap: .38rem;
    padding: .45rem 1.1rem; border-radius: 7px;
    border: none; background: var(--charcoal);
    font-family: var(--font-body); font-size: .75rem;
    font-weight: 500; color: var(--white); text-decoration: none;
    cursor: pointer; transition: background .2s, transform .15s;
    position: relative; overflow: hidden; white-space: nowrap; flex-shrink: 0;
}
.bid-view-btn::after {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(135deg, var(--gold-dark), var(--gold));
    opacity: 0; transition: opacity .25s;
}
.bid-view-btn:hover::after { opacity: 1; }
.bid-view-btn:hover { transform: translateY(-1px); }
.bid-view-btn span, .bid-view-btn svg { position: relative; z-index: 1; }
.bid-view-btn svg { width: 11px; height: 11px; }

/* ── EMPTY STATE ── */
.bd-empty {
    grid-column: 1 / -1; text-align: center;
    padding: 4.5rem 2rem;
    background: var(--white); border: 1.5px solid var(--border);
    border-radius: var(--radius);
}
.bd-empty-icon {
    width: 52px; height: 52px; border-radius: 50%;
    background: rgba(201,168,76,.08);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto .9rem; color: var(--gold-dark);
}
.bd-empty-icon svg { width: 24px; height: 24px; }
.bd-empty-title {
    font-family: var(--font-display); font-size: 1rem;
    font-weight: 700; color: var(--charcoal); margin-bottom: .35rem;
}
.bd-empty-desc { font-size: .8rem; color: var(--warm-grey); line-height: 1.6; }

/* ── RESPONSIVE TWEAKS ── */
@media (max-width: 640px) {
    .bd-top { flex-direction: column; align-items: flex-start; }
    .bd-toolbar { gap: .5rem; }
    .bd-search-wrap { max-width: 100%; min-width: 0; width: 100%; }
    .bd-select { width: 100%; }
    .bd-result-count { margin-left: 0; }
}
</style>

<div class="bd-page">

    {{-- ── TOP ROW ── --}}
    <div class="bd-top">
        <div>
            <h2 class="bd-title">My <em>Bids</em></h2>
            <p class="bd-subtitle">Track and manage all your package bid requests.</p>
        </div>
        <span class="bd-count-badge">
            {{ $bids->count() }} {{ Str::plural('bid', $bids->count()) }}
        </span>
    </div>

    {{-- ── STATS ── --}}
    @php
        $total    = $bids->count();
        $pending  = $bids->where('status', 'pending')->count();
        $accepted = $bids->whereIn('status', ['accepted', 'confirmed'])->count();
        $rejected = $bids->whereIn('status', ['rejected', 'cancelled'])->count();
    @endphp
    <div class="bd-stats">
        <div class="bd-stat s-all">
            <div class="bd-stat-val">{{ $total }}</div>
            <div class="bd-stat-lbl">Total Bids</div>
        </div>
        <div class="bd-stat s-pending">
            <div class="bd-stat-val">{{ $pending }}</div>
            <div class="bd-stat-lbl">Pending</div>
        </div>
        <div class="bd-stat s-accepted">
            <div class="bd-stat-val">{{ $accepted }}</div>
            <div class="bd-stat-lbl">Accepted</div>
        </div>
        <div class="bd-stat s-rejected">
            <div class="bd-stat-val">{{ $rejected }}</div>
            <div class="bd-stat-lbl">Rejected</div>
        </div>
    </div>

    {{-- ── TOOLBAR ── --}}
    <div class="bd-toolbar">
        <div class="bd-search-wrap">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                <circle cx="8.5" cy="8.5" r="5.5"/><path d="M15 15l-3.5-3.5"/>
            </svg>
            <input type="text" id="bdSearch"
                   placeholder="Search package or supplier…"
                   oninput="filterBids()" autocomplete="off">
        </div>

        <select id="bdStatus" class="bd-select" onchange="filterBids()">
            <option value="">All Status</option>
            <option value="pending">Pending</option>
            <option value="accepted">Accepted</option>
            <option value="confirmed">Confirmed</option>
            <option value="rejected">Rejected</option>
            <option value="cancelled">Cancelled</option>
        </select>

        <span class="bd-result-count" id="bdResultCount">
            {{ $bids->count() }} {{ Str::plural('bid', $bids->count()) }}
        </span>
    </div>

    {{-- ── CARDS GRID ── --}}
    @if($bids->count())
    <div class="bids-grid" id="bidsGrid">

        @foreach($bids as $idx => $bid)
        @php
            $pkgName  = $bid->package->name ?? '—';
            $supName  = $bid->package->supplier->business_name
                     ?? $bid->package->supplier->name
                     ?? null;
            $price    = $bid->package->price ?? null;
            $evtType  = $bid->package->event_type ?? null;
            $placed   = $bid->created_at ? $bid->created_at->format('M d, Y') : '—';
            $status   = strtolower($bid->status ?? 'pending');
        @endphp

        <div class="bid-card"
             data-search="{{ strtolower($pkgName . ' ' . ($supName ?? '')) }}"
             data-status="{{ $status }}"
             style="animation-delay: {{ $idx * 0.045 }}s;">

            {{-- Status accent bar --}}
            <div class="bid-accent {{ $status }}"></div>

            {{-- Head --}}
            <div class="bid-head">
                <div>
                    <div class="bid-pkg-name">{{ $pkgName }}</div>
                    @if($supName)
                    <div class="bid-pkg-supplier">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="7" cy="5" r="2.5"/>
                            <path d="M2 12c0-2.5 2.2-4.5 5-4.5s5 2 5 4.5"/>
                        </svg>
                        {{ $supName }}
                    </div>
                    @endif
                </div>

                <span class="bid-status {{ $status }}">
                    @if(in_array($status, ['accepted', 'confirmed']))
                        <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 5l2 2 4-4"/>
                        </svg>
                    @elseif(in_array($status, ['rejected', 'cancelled']))
                        <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 2l6 6M8 2L2 8"/>
                        </svg>
                    @else
                        <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="5" cy="5" r="4"/><path d="M5 3v2.5L7 7"/>
                        </svg>
                    @endif
                    {{ ucfirst($status) }}
                </span>
            </div>

            {{-- Body --}}
            <div class="bid-body">

                {{-- Listed price --}}
                @if($price)
                <div class="bid-price-block">
                    <span class="bid-price-label">Listed Price</span>
                    <span class="bid-price-val">₱{{ number_format($price, 2) }}</span>
                </div>
                @endif

                {{-- Meta chips --}}
                <div class="bid-meta">
                    @if($evtType)
                    <span class="bid-chip">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="2" y="2" width="10" height="10" rx="2"/>
                            <path d="M5 1v2M9 1v2M2 6h10"/>
                        </svg>
                        {{ $evtType }}
                    </span>
                    @endif
                    @if($bid->package->guest_capacity ?? null)
                    <span class="bid-chip">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="5" cy="4" r="2"/>
                            <path d="M1 12c0-2 1.8-3.5 4-3.5s4 1.5 4 3.5"/>
                            <circle cx="11" cy="4" r="1.5"/>
                            <path d="M13 11.5c0-1.5-1-2.5-2.5-2.5"/>
                        </svg>
                        {{ number_format($bid->package->guest_capacity) }} guests
                    </span>
                    @endif
                    @if($bid->package->duration_hours ?? null)
                    <span class="bid-chip">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="7" cy="7" r="5.5"/>
                            <path d="M7 4.5V7l2 1.5"/>
                        </svg>
                        {{ $bid->package->duration_hours }}h
                    </span>
                    @endif
                </div>

            </div>{{-- /bid-body --}}

            {{-- Footer --}}
            <div class="bid-foot">
                <span class="bid-date">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="2" y="2" width="10" height="10" rx="2"/>
                        <path d="M5 1v2M9 1v2M2 6h10"/>
                    </svg>
                    {{ $placed }}
                </span>
                <a href="{{ route('client.bids.show', $bid) }}" class="bid-view-btn">
                    <span>View</span>
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 6h8M7 3l3 3-3 3"/>
                    </svg>
                </a>
            </div>

        </div>{{-- /bid-card --}}
        @endforeach

        {{-- JS-injected no-results --}}
        <div id="bdNoResults" class="bd-empty" style="display:none;">
            <div class="bd-empty-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="8.5" cy="8.5" r="5.5"/><path d="M15 15l-3.5-3.5"/>
                </svg>
            </div>
            <div class="bd-empty-title">No Matching Bids</div>
            <p class="bd-empty-desc">Try adjusting your search or status filter.</p>
        </div>

    </div>{{-- /bids-grid --}}

    @else
    <div class="bids-grid">
        <div class="bd-empty">
            <div class="bd-empty-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
                </svg>
            </div>
            <div class="bd-empty-title">No Bids Yet</div>
            <p class="bd-empty-desc">You haven't submitted any bids yet.<br>Browse packages to get started.</p>
        </div>
    </div>
    @endif

</div>{{-- /bd-page --}}

<script>
function filterBids() {
    var q      = document.getElementById('bdSearch').value.trim().toLowerCase();
    var status = document.getElementById('bdStatus').value.toLowerCase();
    var cards  = document.querySelectorAll('#bidsGrid .bid-card');
    var noRes  = document.getElementById('bdNoResults');
    var cnt    = document.getElementById('bdResultCount');
    var visible = 0;

    cards.forEach(function(card) {
        var matchQ  = !q      || (card.dataset.search || '').includes(q);
        var matchSt = !status || (card.dataset.status || '') === status;
        var show    = matchQ && matchSt;
        card.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    if (cnt) cnt.textContent = visible + ' ' + (visible === 1 ? 'bid' : 'bids');
    if (noRes) noRes.style.display = (visible === 0 && cards.length > 0) ? 'block' : 'none';
}
</script>

</x-client-layout>