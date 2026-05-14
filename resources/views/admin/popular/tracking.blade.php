<x-app-layout>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500;600&display=swap');

:root {
    --gold:#C9A84C; --gold-dark:#8A6A1F; --gold-light:rgba(201,168,76,0.12);
    --ivory:#FAF7F2; --charcoal:#1E1B18; --warm-grey:#706B65;
    --border:#E5DDD5; --border-md:#E0D8D0;
    --white:#FFFFFF;
    --font-display:'Playfair Display',Georgia,serif;
    --font-body:'DM Sans',sans-serif;
}

/* ── PAGE WRAPPER ── */
.pp-wrap { max-width:1100px; margin:0 auto; padding:2rem 1.5rem 4rem; }

/* ── TOP ROW ── */
.pp-top { display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:.75rem; margin-bottom:1.75rem; }
.pp-title { font-family:var(--font-display); font-size:1.65rem; font-weight:700; color:var(--charcoal); line-height:1.15; }
.pp-title em { font-style:italic; color:var(--gold-dark); }
.pp-subtitle { font-size:.76rem; color:var(--warm-grey); margin-top:.2rem; font-family:var(--font-body); }

/* ── STAT PILLS ── */
.pp-stats { display:flex; gap:.75rem; flex-wrap:wrap; margin-bottom:1.75rem; }
.pp-stat {
    flex:1; min-width:140px;
    background:var(--white);
    border:1.5px solid var(--border);
    border-radius:12px;
    padding:.9rem 1.1rem;
    display:flex; flex-direction:column; gap:.2rem;
}
.pp-stat-label { font-size:.62rem; font-weight:600; letter-spacing:.1em; text-transform:uppercase; color:var(--warm-grey); }
.pp-stat-value { font-family:var(--font-display); font-size:1.3rem; font-weight:700; color:var(--charcoal); line-height:1.1; }
.pp-stat-value span { font-size:.78rem; color:var(--gold-dark); font-family:var(--font-body); font-weight:500; margin-left:.25rem; }

/* ── CARD ── */
.pp-card { background:var(--white); border:1.5px solid var(--border); border-radius:14px; overflow:hidden; }

/* ── SCROLL HINT ── */
.scroll-hint { display:none; align-items:center; gap:.4rem; font-size:.68rem; color:var(--warm-grey); padding:.55rem 1rem .1rem; font-family:var(--font-body); }
.scroll-hint svg { width:13px; height:13px; flex-shrink:0; }
@media(max-width:640px){ .scroll-hint { display:flex; } }

/* ── TABLE ── */
.tbl-wrap { overflow-x:auto; -webkit-overflow-scrolling:touch; scrollbar-width:thin; scrollbar-color:rgba(201,168,76,.4) transparent; }
.tbl-wrap::-webkit-scrollbar { height:4px; }
.tbl-wrap::-webkit-scrollbar-thumb { background:rgba(201,168,76,.45); border-radius:4px; }

.pp-table { width:100%; min-width:700px; border-collapse:collapse; font-family:var(--font-body); }

.pp-table thead { background:var(--ivory); border-bottom:1.5px solid var(--border); }
.pp-table thead th {
    padding:.8rem 1.1rem;
    font-size:.6rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase;
    color:var(--warm-grey); text-align:left; white-space:nowrap;
}
.pp-table thead th:first-child { border-left:3px solid var(--gold); }
.pp-table thead th.right { text-align:right; }

.pp-table tbody tr { border-bottom:1px solid #F0EBE5; transition:background .15s; }
.pp-table tbody tr:last-child { border-bottom:none; }
.pp-table tbody tr:hover { background:rgba(201,168,76,.04); }

.pp-table td { padding:.9rem 1.1rem; font-size:.83rem; color:var(--charcoal); vertical-align:middle; }
.pp-table tbody td:first-child { border-left:3px solid transparent; }
.pp-table tbody tr:hover td:first-child { border-left-color:rgba(201,168,76,.45); }
.pp-table td.right { text-align:right; }

/* Cell types */
.td-rank { color:#C0B8B0; font-size:.72rem; width:40px; font-weight:600; }

.td-pkg-name { font-family:var(--font-display); font-weight:700; font-size:.92rem; color:var(--charcoal); }
.td-pkg-supplier { font-size:.7rem; color:var(--warm-grey); margin-top:2px; }

.td-type {
    display:inline-flex; align-items:center;
    padding:.22rem .62rem; border-radius:20px;
    font-size:.67rem; font-weight:500; letter-spacing:.04em;
    background:var(--gold-light); color:var(--gold-dark);
    border:1px solid rgba(201,168,76,.25); white-space:nowrap;
}

.td-count { font-weight:700; font-size:.9rem; color:var(--charcoal); white-space:nowrap; }
.td-count small { font-size:.68rem; color:var(--warm-grey); font-weight:400; margin-left:.2rem; }

.td-revenue { font-weight:700; font-size:.9rem; color:var(--gold-dark); white-space:nowrap; }

/* Trend bar */
.td-bar-wrap { display:flex; align-items:center; gap:.55rem; min-width:100px; }
.td-bar-track { flex:1; height:5px; background:#F0EBE5; border-radius:99px; overflow:hidden; }
.td-bar-fill { height:100%; border-radius:99px; background:linear-gradient(90deg, var(--gold) 0%, var(--gold-dark) 100%); transition:width .5s ease; }

/* Rank badge for top 3 */
.rank-badge {
    display:inline-flex; align-items:center; justify-content:center;
    width:22px; height:22px; border-radius:50%;
    font-size:.65rem; font-weight:700; flex-shrink:0;
}
.rank-badge.gold   { background:rgba(201,168,76,.18); color:#8A6A1F; border:1.5px solid rgba(201,168,76,.4); }
.rank-badge.silver { background:rgba(180,180,180,.15); color:#666; border:1.5px solid rgba(180,180,180,.35); }
.rank-badge.bronze { background:rgba(180,120,60,.12); color:#8B5E3C; border:1.5px solid rgba(180,120,60,.3); }
.rank-badge.plain  { background:transparent; color:#C0B8B0; border:none; font-size:.72rem; }

/* View button */
.pp-view-btn {
    display:inline-flex; align-items:center; gap:.38rem;
    padding:.32rem .82rem; border-radius:6px;
    border:1.5px solid var(--border);
    background:var(--white);
    font-family:var(--font-body); font-size:.72rem; font-weight:500;
    color:var(--warm-grey); text-decoration:none;
    transition:border-color .15s, color .15s, background .15s;
    white-space:nowrap;
}
.pp-view-btn svg { width:11px; height:11px; flex-shrink:0; }
.pp-view-btn:hover { border-color:var(--gold); color:var(--gold-dark); background:var(--gold-light); }

/* Empty state */
.pp-empty { text-align:center; padding:4rem 1.5rem; }
.pp-empty-icon { width:52px; height:52px; border-radius:50%; background:rgba(201,168,76,.08); display:flex; align-items:center; justify-content:center; margin:0 auto .9rem; color:var(--gold-dark); }
.pp-empty-icon svg { width:24px; height:24px; }
.pp-empty-title { font-family:var(--font-display); font-size:1rem; font-weight:700; color:var(--charcoal); margin-bottom:.35rem; }
.pp-empty-desc { font-size:.8rem; color:var(--warm-grey); line-height:1.6; }

/* Alerts */
.pp-alert-success { display:flex; align-items:center; gap:.65rem; background:#F0FDF4; border:1px solid #A7F3D0; border-radius:8px; padding:.75rem 1rem; font-size:.82rem; color:#065F46; margin-bottom:1.25rem; }
.pp-alert-success svg { width:16px; height:16px; color:#10B981; flex-shrink:0; }
.pp-alert-error { display:flex; align-items:center; gap:.65rem; background:#FEF2F2; border:1px solid #FCA5A5; border-radius:8px; padding:.75rem 1rem; font-size:.82rem; color:#991B1B; margin-bottom:1.25rem; }
.pp-alert-error svg { width:16px; height:16px; color:#EF4444; flex-shrink:0; }

@media(max-width:600px) {
    .pp-stat { min-width:120px; }
    .pp-title { font-size:1.35rem; }
}
</style>

<div class="pp-wrap">

    {{-- Alerts --}}
    @if(session('success'))
    <div class="pp-alert-success">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="pp-alert-error">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="10" cy="10" r="8"/><path d="M10 6v4M10 14v.5"/></svg>
        {{ session('error') }}
    </div>
    @endif

    {{-- ── TOP ROW ── --}}
    <div class="pp-top">
        <div>
            <h2 class="pp-title">Popular Package <em>Tracking</em></h2>
            <p class="pp-subtitle">Most booked packages ranked by booking volume and revenue</p>
        </div>
    </div>

    {{-- ── STAT PILLS ── --}}
    @if(isset($popularPackages) && count($popularPackages))
    @php
        $totalBookings = $popularPackages->sum('bookings_count');
        $totalRevenue  = $popularPackages->sum('revenue');
        $topPackage    = $popularPackages->first();
        $maxBookings   = $popularPackages->max('bookings_count') ?: 1;
    @endphp
    <div class="pp-stats">
        <div class="pp-stat">
            <div class="pp-stat-label">Total Packages</div>
            <div class="pp-stat-value">{{ $popularPackages->count() }}</div>
        </div>
        <div class="pp-stat">
            <div class="pp-stat-label">Total Bookings</div>
            <div class="pp-stat-value">{{ number_format($totalBookings) }}</div>
        </div>
        <div class="pp-stat">
            <div class="pp-stat-label">Total Revenue</div>
            <div class="pp-stat-value">₱{{ number_format($totalRevenue, 0) }}</div>
        </div>
        <div class="pp-stat">
            <div class="pp-stat-label">Top Package</div>
            <div class="pp-stat-value" style="font-size:.95rem;">
                {{ Str::limit($topPackage->name, 20) }}
                <span>{{ number_format($topPackage->bookings_count) }} bookings</span>
            </div>
        </div>
    </div>
    @endif

    {{-- ── TABLE CARD ── --}}
    @if(isset($popularPackages) && count($popularPackages))
    <div class="pp-card">
        <div class="scroll-hint">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 10h12M10 4l6 6-6 6"/></svg>
            Scroll sideways to see more
        </div>
        <div class="tbl-wrap">
            <table class="pp-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Package</th>
                        <th>Event Type</th>
                        <th class="right">Bookings</th>
                        <th>Volume</th>
                        <th class="right">Total Revenue</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($popularPackages as $i => $package)
                    @php
                        $rank = $i + 1;
                        $badgeClass = match($rank) { 1 => 'gold', 2 => 'silver', 3 => 'bronze', default => 'plain' };
                        $barPct = $maxBookings > 0 ? round(($package->bookings_count / $maxBookings) * 100) : 0;
                    @endphp
                    <tr>
                        <td class="td-rank">
                            <span class="rank-badge {{ $badgeClass }}">{{ $rank }}</span>
                        </td>

                        <td>
                            <div class="td-pkg-name">{{ $package->name }}</div>
                            @if(!empty($package->supplier->business_name))
                            <div class="td-pkg-supplier">{{ $package->supplier->business_name }}</div>
                            @elseif(!empty($package->supplier->first_name))
                            <div class="td-pkg-supplier">{{ $package->supplier->first_name }} {{ $package->supplier->last_name }}</div>
                            @endif
                        </td>

                        <td>
                            <span class="td-type">{{ $package->event_type }}</span>
                        </td>

                        <td class="right">
                            <div class="td-count">
                                {{ number_format($package->bookings_count) }}
                                <small>bookings</small>
                            </div>
                        </td>

                        <td>
                            <div class="td-bar-wrap">
                                <div class="td-bar-track">
                                    <div class="td-bar-fill" style="width:{{ $barPct }}%"></div>
                                </div>
                                <span style="font-size:.68rem;color:var(--warm-grey);width:28px;text-align:right;flex-shrink:0;">{{ $barPct }}%</span>
                            </div>
                        </td>

                        <td class="right">
                            <div class="td-revenue">₱{{ number_format($package->revenue, 2) }}</div>
                        </td>

                        <td style="text-align:center;">
                            <a href="{{ route('admin.popular.tracking.show', $package->id) }}" class="pp-view-btn">
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M7 2.5C4 2.5 1.5 7 1.5 7S4 11.5 7 11.5 12.5 7 12.5 7 10 2.5 7 2.5z"/>
                                    <circle cx="7" cy="7" r="1.8"/>
                                </svg>
                                View Details
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @else
    <div class="pp-card">
        <div class="pp-empty">
            <div class="pp-empty-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M9 2H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V9"/>
                    <path d="M13 2l4 4-8 8H5v-4l8-8z"/>
                </svg>
            </div>
            <div class="pp-empty-title">No Packages Yet</div>
            <div class="pp-empty-desc">No popular package data is available yet.<br>Bookings will appear here once clients start booking.</div>
        </div>
    </div>
    @endif

</div>

</x-app-layout>