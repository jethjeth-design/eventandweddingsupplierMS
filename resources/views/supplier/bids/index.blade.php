<x-supplier-layout>

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

/* ── PAGE ── */
.bids-page { max-width: 1100px; margin: 0 auto; padding: 1.75rem 1.5rem 4rem; }

/* ── TOP ROW ── */
.bids-top {
    display: flex; align-items: flex-end;
    justify-content: space-between; flex-wrap: wrap;
    gap: 1rem; margin-bottom: 1.75rem;
}
.bids-title {
    font-family: var(--font-display);
    font-size: clamp(1.35rem, 2.5vw, 1.75rem);
    font-weight: 700; color: var(--charcoal); line-height: 1.15;
}
.bids-title em { font-style: italic; color: var(--gold-dark); }
.bids-sub {
    font-size: .76rem; color: var(--warm-grey);
    margin-top: .2rem; font-family: var(--font-body);
}

/* ── TOOLBAR ── */
.bids-toolbar {
    display: flex; align-items: center;
    gap: .65rem; flex-wrap: wrap; margin-bottom: 1.4rem;
}

/* Search */
.tb-search-wrap { position: relative; flex: 1; min-width: 180px; max-width: 300px; }
.tb-search-ico {
    position: absolute; left: .8rem; top: 50%;
    transform: translateY(-50%);
    width: 13px; height: 13px; color: #C0B8B0; pointer-events: none;
}
.tb-search-inp {
    width: 100%; padding: .58rem .9rem .58rem 2.25rem;
    background: var(--white); border: 1.5px solid var(--border);
    border-radius: 8px; font-family: var(--font-body);
    font-size: .82rem; color: var(--charcoal); outline: none;
    transition: border-color .2s, box-shadow .2s;
}
.tb-search-inp:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,.1); }
.tb-search-inp::placeholder { color: #C0B8B0; }
.tb-search-wrap:focus-within .tb-search-ico { color: var(--gold-dark); }

/* Status filter */
.tb-filter-wrap { position: relative; }
.tb-filter-sel {
    appearance: none; padding: .58rem 2.1rem .58rem .9rem;
    background: var(--white); border: 1.5px solid var(--border);
    border-radius: 8px; font-family: var(--font-body);
    font-size: .82rem; color: var(--charcoal); outline: none;
    cursor: pointer; min-width: 145px;
    transition: border-color .2s;
}
.tb-filter-sel:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,.1); }
.tb-filter-wrap::after {
    content: ''; position: absolute; right: .8rem; top: 50%;
    transform: translateY(-50%);
    width: 0; height: 0;
    border-left: 4px solid transparent; border-right: 4px solid transparent;
    border-top: 5px solid #C0B8B0; pointer-events: none;
}

/* Count badge */
.tb-count {
    font-size: .72rem; color: var(--warm-grey);
    font-family: var(--font-body); white-space: nowrap; margin-left: auto;
}

/* ── STATS ROW ── */
.stats-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem; margin-bottom: 1.75rem;
}
@media (max-width: 700px) { .stats-row { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 400px) { .stats-row { grid-template-columns: 1fr 1fr; } }

.stat-card {
    background: var(--white); border: 1.5px solid var(--border);
    border-radius: var(--radius); padding: 1rem 1.15rem;
    position: relative; overflow: hidden;
}
.stat-card::before {
    content: ''; position: absolute;
    top: 0; left: 0; right: 0; height: 2px;
    background: linear-gradient(90deg, var(--gold), #D4A090);
}
.stat-n {
    font-family: var(--font-display);
    font-size: 1.7rem; font-weight: 700; color: var(--gold-dark); line-height: 1;
}
.stat-l {
    font-size: .6rem; font-weight: 700; letter-spacing: .1em;
    text-transform: uppercase; color: var(--warm-grey);
    margin-top: 3px; font-family: var(--font-body);
}

/* ── BID CARDS GRID ── */
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
    animation: fadeUp .3s ease both;
}
.bid-card:hover {
    box-shadow: 0 6px 28px rgba(30,27,24,.11);
    transform: translateY(-2px);
    border-color: rgba(201,168,76,.4);
}
.bid-card[data-hidden="true"] { display: none; }

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Card top accent */
.bid-card-accent {
    height: 3px;
    background: linear-gradient(90deg, var(--gold), #D4A090);
}

/* Card head */
.bid-card-head {
    padding: 1rem 1.2rem .75rem;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: flex-start;
    justify-content: space-between; gap: .75rem;
}
.bid-pkg-name {
    font-family: var(--font-display);
    font-size: .98rem; font-weight: 700; color: var(--charcoal);
    line-height: 1.25; flex: 1;
}
.bid-status {
    display: inline-flex; align-items: center; gap: .28rem;
    font-size: .6rem; font-weight: 700; letter-spacing: .06em;
    text-transform: uppercase; padding: 3px 9px; border-radius: 999px;
    white-space: nowrap; flex-shrink: 0;
}
.bid-status svg { width: 8px; height: 8px; }

/* Status colour variants */
.status-pending  { background: rgba(201,168,76,.1);  color: var(--gold-dark);  border: 1px solid rgba(201,168,76,.3); }
.status-accepted { background: #DCFCE7; color: #15803D; border: 1px solid #BBF7D0; }
.status-rejected { background: #FEF2F2; color: #B91C1C; border: 1px solid #FECACA; }
.status-countered{ background: #EFF6FF; color: #1D4ED8; border: 1px solid #BFDBFE; }
.status-open     { background: rgba(201,168,76,.1);  color: var(--gold-dark);  border: 1px solid rgba(201,168,76,.3); }

/* Card body */
.bid-card-body { padding: .9rem 1.2rem; flex: 1; display: flex; flex-direction: column; gap: .65rem; }

/* Client row */
.bid-client-row { display: flex; align-items: center; gap: .6rem; }
.bid-client-avatar {
    width: 32px; height: 32px; border-radius: 50%; flex-shrink: 0;
    background: var(--charcoal);
    display: flex; align-items: center; justify-content: center;
    font-family: var(--font-display); font-size: .72rem; font-weight: 700;
    color: var(--gold); border: 2px solid var(--border);
    overflow: hidden;
}
.bid-client-avatar img { width: 100%; height: 100%; object-fit: cover; }
.bid-client-name {
    font-size: .82rem; font-weight: 600; color: var(--charcoal);
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.bid-client-label {
    font-size: .62rem; color: var(--warm-grey); margin-top: 1px;
}

/* Offer price block */
.bid-offer-block {
    display: flex; align-items: center; justify-content: space-between;
    background: rgba(201,168,76,.05); border: 1px solid rgba(201,168,76,.18);
    border-radius: 8px; padding: .65rem .9rem;
}
.bid-offer-label {
    font-size: .6rem; font-weight: 700; letter-spacing: .1em;
    text-transform: uppercase; color: var(--warm-grey);
    font-family: var(--font-body);
}
.bid-offer-price {
    font-family: var(--font-display);
    font-size: 1.05rem; font-weight: 700; color: var(--gold-dark);
}

/* Message preview */
.bid-message-wrap { display: flex; gap: .5rem; align-items: flex-start; }
.bid-msg-ico { width: 14px; height: 14px; color: #C0B8B0; flex-shrink: 0; margin-top: 2px; }
.bid-message {
    font-size: .78rem; color: var(--warm-grey); line-height: 1.5;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Meta chips */
.bid-meta { display: flex; flex-wrap: wrap; gap: .4rem; }
.bid-chip {
    display: inline-flex; align-items: center; gap: .25rem;
    font-size: .62rem; color: var(--warm-grey);
    background: var(--ivory); border: 1px solid var(--border);
    padding: 2px 8px; border-radius: 3px; font-family: var(--font-body);
}
.bid-chip svg { width: 10px; height: 10px; color: var(--gold-dark); }

/* Card footer */
.bid-card-foot {
    padding: .75rem 1.2rem;
    border-top: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between; gap: .5rem;
}
.bid-time {
    font-size: .65rem; color: #C0B8B0;
    display: flex; align-items: center; gap: .25rem;
    font-family: var(--font-body);
}
.bid-time svg { width: 10px; height: 10px; }

.bid-open-btn {
    display: inline-flex; align-items: center; gap: .38rem;
    padding: .45rem 1.1rem; border-radius: 6px;
    border: none; background: var(--charcoal);
    font-family: var(--font-body); font-size: .75rem;
    font-weight: 500; letter-spacing: .03em;
    color: var(--white); text-decoration: none;
    cursor: pointer; transition: background .2s, transform .15s;
    white-space: nowrap; flex-shrink: 0; position: relative; overflow: hidden;
}
.bid-open-btn::after {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(135deg, var(--gold-dark), var(--gold));
    opacity: 0; transition: opacity .25s;
}
.bid-open-btn:hover::after { opacity: 1; }
.bid-open-btn:hover { transform: translateY(-1px); }
.bid-open-btn span, .bid-open-btn svg { position: relative; z-index: 1; }
.bid-open-btn svg { width: 12px; height: 12px; }

/* ── EMPTY STATE ── */
.bids-empty {
    grid-column: 1 / -1; text-align: center;
    padding: 4.5rem 2rem;
    background: var(--white); border: 1.5px solid var(--border);
    border-radius: var(--radius);
}
.empty-icon {
    width: 52px; height: 52px; border-radius: 50%;
    background: rgba(201,168,76,.08);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto .9rem; color: var(--gold-dark);
}
.empty-icon svg { width: 24px; height: 24px; }
.empty-title {
    font-family: var(--font-display); font-size: 1rem;
    font-weight: 700; color: var(--charcoal); margin-bottom: .35rem;
}
.empty-desc { font-size: .8rem; color: var(--warm-grey); line-height: 1.6; }

/* ── NO FILTER RESULTS ── */
#bidsNoResults { display: none; }
#bidsNoResults.visible { display: block; }

/* ── RESPONSIVE ── */
@media (max-width: 640px) {
    .bids-top { flex-direction: column; align-items: flex-start; }
    .bids-toolbar { gap: .5rem; }
    .tb-search-wrap { max-width: 100%; width: 100%; }
    .tb-filter-sel { width: 100%; }
    .tb-count { margin-left: 0; }
}
</style>

<div class="bids-page">

    {{-- ── TOP ROW ── --}}
    <div class="bids-top">
        <div>
            <h2 class="bids-title">Incoming <em>Bids</em></h2>
            <p class="bids-sub">Review and respond to client offers on your packages.</p>
        </div>
    </div>

    {{-- ── STATS ROW ── --}}
    @php
        $total    = $bids->count();
        $pending  = $bids->where('status', 'pending')->count();
        $accepted = $bids->where('status', 'accepted')->count();
        $avgOffer = $bids->map(fn($b) => optional($b->latestMessage)->offer_price)->filter()->avg();
    @endphp
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-n">{{ $total }}</div>
            <div class="stat-l">Total Bids</div>
        </div>
        <div class="stat-card">
            <div class="stat-n">{{ $pending }}</div>
            <div class="stat-l">Pending</div>
        </div>
        <div class="stat-card">
            <div class="stat-n">{{ $accepted }}</div>
            <div class="stat-l">Accepted</div>
        </div>
        <div class="stat-card">
            <div class="stat-n">{{ $avgOffer ? '₱'.number_format($avgOffer, 0) : '—' }}</div>
            <div class="stat-l">Avg. Offer</div>
        </div>
    </div>

    {{-- ── TOOLBAR ── --}}
    <div class="bids-toolbar">
        <div class="tb-search-wrap">
            <svg class="tb-search-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                <circle cx="8.5" cy="8.5" r="5.5"/><path d="M15 15l-3.5-3.5"/>
            </svg>
            <input type="text" class="tb-search-inp" id="bidsSearch"
                   placeholder="Search package or client…"
                   oninput="filterBids()" autocomplete="off">
        </div>

        <div class="tb-filter-wrap">
            <select class="tb-filter-sel" id="bidsStatusFilter" onchange="filterBids()">
                <option value="">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="accepted">Accepted</option>
                <option value="rejected">Rejected</option>
                <option value="countered">Countered</option>
            </select>
        </div>

        <span class="tb-count" id="bidsCount">
            {{ $bids->count() }} {{ Str::plural('bid', $bids->count()) }}
        </span>
    </div>

    {{-- ── BID CARDS ── --}}
    @if($bids->count())
    <div class="bids-grid" id="bidsGrid">

        @foreach($bids as $idx => $bid)
        @php
            $status  = strtolower($bid->status ?? 'pending');
            $initials = strtoupper(substr($bid->client->name ?? 'C', 0, 1));
            $pkgName  = $bid->package->name ?? 'Unnamed Package';
            $clientName = $bid->client->name ?? 'Unknown Client';
        @endphp

        <div class="bid-card"
             data-status="{{ $status }}"
             data-pkg="{{ strtolower($pkgName) }}"
             data-client="{{ strtolower($clientName) }}"
             style="animation-delay: {{ $idx * 0.045 }}s;">

            <div class="bid-card-accent"></div>

            {{-- Head: package name + status --}}
            <div class="bid-card-head">
                <div class="bid-pkg-name">{{ $pkgName }}</div>
                <span class="bid-status status-{{ $status }}">
                    @if($status === 'accepted')
                        <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 5l2 2 4-4"/></svg>
                    @elseif($status === 'rejected')
                        <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 2l6 6M8 2L2 8"/></svg>
                    @elseif($status === 'countered')
                        <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 5h8M6 2l3 3-3 3"/></svg>
                    @else
                        <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="2"><circle cx="5" cy="5" r="4"/><path d="M5 3v2.5L7 7"/></svg>
                    @endif
                    {{ ucfirst($status) }}
                </span>
            </div>

            {{-- Body --}}
            <div class="bid-card-body">

                {{-- Client --}}
                <div class="bid-client-row">
                    <div class="bid-client-avatar">
                        @if($bid->client->photo ?? null)
                            <img src="{{ asset('storage/' . $bid->client->photo) }}" alt="{{ $clientName }}">
                        @else
                            {{ $initials }}
                        @endif
                    </div>
                    <div>
                        <div class="bid-client-name">{{ $clientName }}</div>
                        <div class="bid-client-label">Client</div>
                    </div>
                </div>

                {{-- Offer price --}}
                @if($bid->latestMessage?->offer_price)
                <div class="bid-offer-block">
                    <span class="bid-offer-label">Offer Price</span>
                    <span class="bid-offer-price">
                        ₱{{ number_format($bid->latestMessage->offer_price, 2) }}
                    </span>
                </div>
                @endif

                {{-- Message preview --}}
                @if($bid->latestMessage?->message)
                <div class="bid-message-wrap">
                    <svg class="bid-msg-ico" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M2 3h12a1 1 0 011 1v7a1 1 0 01-1 1H5l-3 2V4a1 1 0 011-1z"/>
                    </svg>
                    <p class="bid-message">{{ $bid->latestMessage->message }}</p>
                </div>
                @endif

                {{-- Meta chips --}}
                <div class="bid-meta">
                    @if($bid->package->event_type ?? null)
                    <span class="bid-chip">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="2" y="2" width="10" height="10" rx="2"/>
                            <path d="M5 1v2M9 1v2M2 6h10"/>
                        </svg>
                        {{ $bid->package->event_type }}
                    </span>
                    @endif
                    @if($bid->package->price ?? null)
                    <span class="bid-chip">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="7" cy="7" r="5.5"/>
                            <path d="M7 3.5v7M5.5 5.5h2a1 1 0 010 2H6a1 1 0 000 2H8.5"/>
                        </svg>
                        Listed ₱{{ number_format($bid->package->price, 0) }}
                    </span>
                    @endif
                </div>

            </div>{{-- /body --}}

            {{-- Footer --}}
            <div class="bid-card-foot">
                <span class="bid-time">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="7" cy="7" r="5.5"/>
                        <path d="M7 4.5V7l2 1.5"/>
                    </svg>
                    {{ $bid->updated_at->diffForHumans() }}
                </span>
                <a href="{{ route('supplier.bids.show', $bid) }}" class="bid-open-btn">
                    <span>Open</span>
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 6h8M7 3l3 3-3 3"/>
                    </svg>
                </a>
            </div>

        </div>{{-- /bid-card --}}
        @endforeach

        {{-- No filter results --}}
        <div id="bidsNoResults" class="bids-empty">
            <div class="empty-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="8.5" cy="8.5" r="5.5"/><path d="M15 15l-3.5-3.5"/>
                </svg>
            </div>
            <div class="empty-title">No Results Found</div>
            <p class="empty-desc">Try a different search term or status filter.</p>
        </div>

    </div>{{-- /bids-grid --}}

    @else
    <div class="bids-grid">
        <div class="bids-empty">
            <div class="empty-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
                </svg>
            </div>
            <div class="empty-title">No Incoming Bids</div>
            <p class="empty-desc">You haven't received any bids yet.<br>They'll appear here when clients make offers on your packages.</p>
        </div>
    </div>
    @endif

</div>{{-- /bids-page --}}

<script>
function filterBids() {
    var q      = document.getElementById('bidsSearch').value.toLowerCase().trim();
    var status = document.getElementById('bidsStatusFilter').value.toLowerCase();
    var cards  = document.querySelectorAll('#bidsGrid .bid-card');
    var noRes  = document.getElementById('bidsNoResults');
    var count  = document.getElementById('bidsCount');
    var visible = 0;

    cards.forEach(function(card) {
        var pkg    = card.dataset.pkg    || '';
        var client = card.dataset.client || '';
        var st     = card.dataset.status || '';

        var matchQ  = !q      || pkg.includes(q) || client.includes(q);
        var matchSt = !status || st === status;
        var show    = matchQ && matchSt;

        card.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    if (count) count.textContent = visible + ' ' + (visible === 1 ? 'bid' : 'bids');
    if (noRes) noRes.classList.toggle('visible', visible === 0);
}
</script>

</x-supplier-layout>