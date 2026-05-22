<x-supplier-layout>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500;600&display=swap');

:root {
    --gold:#C9A84C; --gold-dark:#8A6A1F; --gold-light:rgba(201,168,76,0.12);
    --ivory:#FAF7F2; --charcoal:#1E1B18; --warm-grey:#706B65;
    --border:#E5DDD5; --border-soft:#F0EBE5;
    --white:#FFFFFF;
    --font-display:'Playfair Display',Georgia,serif;
    --font-body:'DM Sans',sans-serif;
}

/* ── WRAPPER ── */
.sd-wrap { max-width:1100px; margin:0 auto; padding:2rem 1.5rem 4rem; }

/* ── PAGE HEADER ── */
.sd-top { display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:.75rem; margin-bottom:2rem; }
.sd-title { font-family:var(--font-display); font-size:1.75rem; font-weight:700; color:var(--charcoal); line-height:1.1; }
.sd-title em { font-style:italic; color:var(--gold-dark); }
.sd-subtitle { font-size:.76rem; color:var(--warm-grey); margin-top:.2rem; font-family:var(--font-body); }

/* ── STAT CARDS ── */
.sd-stats { display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-bottom:2rem; }
@media(max-width:900px){ .sd-stats { grid-template-columns:repeat(2,1fr); } }
@media(max-width:480px){ .sd-stats { grid-template-columns:1fr; } }

.sd-stat {
    background:var(--white);
    border:1.5px solid var(--border);
    border-radius:14px;
    padding:1.25rem 1.35rem;
    position:relative;
    overflow:hidden;
    transition:box-shadow .2s, transform .15s;
}
.sd-stat:hover { box-shadow:0 6px 24px rgba(30,27,24,.09); transform:translateY(-2px); }
.sd-stat::before {
    content:'';
    position:absolute; top:0; left:0; right:0;
    height:3px;
    background:linear-gradient(90deg, var(--gold), var(--gold-dark));
    opacity:0;
    transition:opacity .2s;
}
.sd-stat:hover::before { opacity:1; }

.sd-stat-icon {
    width:36px; height:36px; border-radius:9px;
    background:var(--gold-light);
    display:flex; align-items:center; justify-content:center;
    color:var(--gold-dark); margin-bottom:.85rem;
}
.sd-stat-icon svg { width:17px; height:17px; }
.sd-stat-label { font-size:.62rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--warm-grey); margin-bottom:.35rem; }
.sd-stat-value { font-family:var(--font-display); font-size:1.55rem; font-weight:700; color:var(--charcoal); line-height:1; }
.sd-stat-value.revenue { color:var(--gold-dark); }

/* ── SECTION HEADER ── */
.sd-section-head {
    display:flex; align-items:center; justify-content:space-between;
    margin-bottom:1rem; flex-wrap:wrap; gap:.5rem;
}
.sd-section-title {
    display:flex; align-items:center; gap:.65rem;
    font-family:var(--font-display); font-size:1.05rem; font-weight:700; color:var(--charcoal);
}
.sd-section-icon {
    width:30px; height:30px; border-radius:8px;
    background:var(--gold-light);
    display:flex; align-items:center; justify-content:center;
    color:var(--gold-dark); flex-shrink:0;
}
.sd-section-icon svg { width:14px; height:14px; }

.sd-view-all {
    display:inline-flex; align-items:center; gap:.35rem;
    font-size:.75rem; font-weight:500; color:var(--warm-grey);
    text-decoration:none; padding:.3rem .75rem; border-radius:6px;
    border:1.5px solid var(--border); background:var(--white);
    transition:border-color .15s, color .15s, background .15s;
}
.sd-view-all svg { width:11px; height:11px; }
.sd-view-all:hover { border-color:var(--gold); color:var(--gold-dark); background:var(--gold-light); }

/* ── CARD SHELL ── */
.sd-card { background:var(--white); border:1.5px solid var(--border); border-radius:14px; overflow:hidden; margin-bottom:1.75rem; }

/* ── BOOKINGS TABLE ── */
.sd-tbl-scroll { overflow-x:auto; -webkit-overflow-scrolling:touch; scrollbar-width:thin; scrollbar-color:rgba(201,168,76,.4) transparent; }
.sd-tbl-scroll::-webkit-scrollbar { height:4px; }
.sd-tbl-scroll::-webkit-scrollbar-thumb { background:rgba(201,168,76,.45); border-radius:4px; }

.scroll-hint { display:none; align-items:center; gap:.4rem; font-size:.68rem; color:var(--warm-grey); padding:.55rem 1rem .1rem; }
.scroll-hint svg { width:13px; height:13px; }
@media(max-width:640px){ .scroll-hint { display:flex; } }

.sd-table { width:100%; min-width:640px; border-collapse:collapse; font-family:var(--font-body); }
.sd-table thead { background:var(--ivory); border-bottom:1.5px solid var(--border); }
.sd-table thead th {
    padding:.8rem 1.1rem; font-size:.6rem; font-weight:700;
    letter-spacing:.1em; text-transform:uppercase; color:var(--warm-grey);
    text-align:left; white-space:nowrap;
}
.sd-table thead th:first-child { border-left:3px solid var(--gold); }
.sd-table tbody tr { border-bottom:1px solid var(--border-soft); transition:background .15s; }
.sd-table tbody tr:last-child { border-bottom:none; }
.sd-table tbody tr:hover { background:rgba(201,168,76,.04); }
.sd-table td { padding:.88rem 1.1rem; font-size:.83rem; color:var(--charcoal); vertical-align:middle; }
.sd-table tbody td:first-child { border-left:3px solid transparent; }
.sd-table tbody tr:hover td:first-child { border-left-color:rgba(201,168,76,.45); }

/* Table cell types */
.td-client { display:flex; align-items:center; gap:.65rem; }
.td-avatar {
    width:32px; height:32px; border-radius:50%; flex-shrink:0;
    background:linear-gradient(135deg,var(--gold),var(--gold-dark));
    display:flex; align-items:center; justify-content:center;
    font-family:var(--font-display); font-size:.75rem; font-weight:700; color:var(--white);
}
.td-client-name { font-weight:600; font-size:.84rem; color:var(--charcoal); }
.td-event { font-size:.82rem; color:var(--charcoal); }
.td-package { font-size:.78rem; color:var(--warm-grey); max-width:140px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.td-price { font-weight:700; font-size:.86rem; color:var(--gold-dark); white-space:nowrap; }

/* Status badges */
.bk-status { display:inline-flex; align-items:center; gap:.28rem; padding:.2rem .65rem; border-radius:20px; font-size:.67rem; font-weight:600; letter-spacing:.04em; white-space:nowrap; }
.bk-status::before { content:''; width:5px; height:5px; border-radius:50%; flex-shrink:0; }
.bk-status.pending   { background:rgba(251,191,36,.1); color:#92400E; border:1px solid rgba(251,191,36,.3); }
.bk-status.pending::before { background:#F59E0B; }
.bk-status.confirmed { background:rgba(16,185,129,.1); color:#065F46; border:1px solid rgba(16,185,129,.22); }
.bk-status.confirmed::before { background:#10B981; }
.bk-status.cancelled { background:rgba(239,68,68,.1); color:#991B1B; border:1px solid rgba(239,68,68,.22); }
.bk-status.cancelled::before { background:#EF4444; }

/* Empty state */
.sd-empty { text-align:center; padding:3rem 1.5rem; }
.sd-empty-icon { width:46px; height:46px; border-radius:50%; background:rgba(201,168,76,.08); display:flex; align-items:center; justify-content:center; margin:0 auto .75rem; color:var(--gold-dark); }
.sd-empty-icon svg { width:20px; height:20px; }
.sd-empty p { font-size:.8rem; color:var(--warm-grey); line-height:1.6; }

/* ── PACKAGES GRID ── */
.sd-pkg-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1rem; padding:1.25rem; }
@media(max-width:860px){ .sd-pkg-grid { grid-template-columns:repeat(2,1fr); } }
@media(max-width:500px){ .sd-pkg-grid { grid-template-columns:1fr; } }

.sd-pkg {
    border:1.5px solid var(--border);
    border-radius:12px;
    padding:1.1rem 1.15rem;
    background:var(--ivory);
    position:relative;
    transition:border-color .2s, box-shadow .2s, transform .15s;
    overflow:hidden;
}
.sd-pkg:hover { border-color:rgba(201,168,76,.5); box-shadow:0 4px 16px rgba(30,27,24,.07); transform:translateY(-2px); }
.sd-pkg-status-dot {
    position:absolute; top:.85rem; right:.85rem;
    width:8px; height:8px; border-radius:50%;
}
.sd-pkg-status-dot.listed { background:#10B981; box-shadow:0 0 0 3px rgba(16,185,129,.18); }
.sd-pkg-status-dot.hidden { background:#C0B8B0; }

.sd-pkg-name { font-family:var(--font-display); font-size:.95rem; font-weight:700; color:var(--charcoal); margin-bottom:.4rem; padding-right:1.2rem; line-height:1.25; }
.sd-pkg-price { font-size:1.1rem; font-weight:700; color:var(--gold-dark); font-family:var(--font-display); margin-bottom:.55rem; }
.sd-pkg-price span { font-size:.72rem; color:var(--warm-grey); font-family:var(--font-body); font-weight:400; margin-left:.2rem; }
.sd-pkg-badge {
    display:inline-flex; align-items:center; gap:.28rem;
    padding:.18rem .6rem; border-radius:20px;
    font-size:.65rem; font-weight:600; letter-spacing:.04em;
}
.sd-pkg-badge.listed { background:rgba(16,185,129,.1); color:#065F46; border:1px solid rgba(16,185,129,.2); }
.sd-pkg-badge.listed::before { content:''; width:4px; height:4px; border-radius:50%; background:#10B981; }
.sd-pkg-badge.hidden { background:rgba(107,114,128,.1); color:#374151; border:1px solid rgba(107,114,128,.2); }
.sd-pkg-badge.hidden::before { content:''; width:4px; height:4px; border-radius:50%; background:#9CA3AF; }

/* Alerts */
.sd-alert-success { display:flex; align-items:center; gap:.65rem; background:#F0FDF4; border:1px solid #A7F3D0; border-radius:8px; padding:.75rem 1rem; font-size:.82rem; color:#065F46; margin-bottom:1.5rem; }
.sd-alert-success svg { width:16px; height:16px; color:#10B981; flex-shrink:0; }
.sd-alert-error { display:flex; align-items:center; gap:.65rem; background:#FEF2F2; border:1px solid #FCA5A5; border-radius:8px; padding:.75rem 1rem; font-size:.82rem; color:#991B1B; margin-bottom:1.5rem; }
.sd-alert-error svg { width:16px; height:16px; color:#EF4444; flex-shrink:0; }
</style>

<div class="sd-wrap">

    {{-- Alerts --}}
    @if(session('success'))
    <div class="sd-alert-success">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="sd-alert-error">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="10" cy="10" r="8"/><path d="M10 6v4M10 14v.5"/></svg>
        {{ session('error') }}
    </div>
    @endif

    {{-- ── PAGE HEADER ── --}}
    <div class="sd-top">
        <div>
            <h1 class="sd-title">Supplier <em>Dashboard</em></h1>
            <p class="sd-subtitle">Welcome back — here's your business at a glance</p>
        </div>
    </div>

    {{-- ══ STAT CARDS ══ --}}
    <div class="sd-stats">

        {{-- Revenue --}}
        <div class="sd-stat">
            <div class="sd-stat-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="10" cy="10" r="7"/>
                    <path d="M10 6v8M7.5 8.5h4a1.5 1.5 0 010 3h-3a1.5 1.5 0 000 3H13"/>
                </svg>
            </div>
            <div class="sd-stat-label">Total Revenue</div>
            <div class="sd-stat-value revenue">₱{{ number_format($revenue, 2) }}</div>
        </div>

        {{-- Pending --}}
        <div class="sd-stat">
            <div class="sd-stat-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <rect x="3" y="4" width="14" height="13" rx="2"/>
                    <path d="M3 8h14M8 4V2M12 4V2"/>
                </svg>
            </div>
            <div class="sd-stat-label">Pending Bookings</div>
            <div class="sd-stat-value">{{ $pending }}</div>
        </div>

        {{-- Cancelled --}}
        <div class="sd-stat">
            <div class="sd-stat-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="10" cy="10" r="7"/>
                    <path d="M7 7l6 6M13 7l-6 6"/>
                </svg>
            </div>
            <div class="sd-stat-label">Cancelled</div>
            <div class="sd-stat-value">{{ $cancelled }}</div>
        </div>

        {{-- Unread Messages --}}
        <div class="sd-stat">
            <div class="sd-stat-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M3 4a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H7l-4 4V4z"/>
                </svg>
            </div>
            <div class="sd-stat-label">Unread Messages</div>
            <div class="sd-stat-value">{{--$unreadMessages --}}</div>
        </div>

    </div>

    {{-- ══ RECENT BOOKINGS ══ --}}
    <div class="sd-section-head">
        <div class="sd-section-title">
            <div class="sd-section-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <rect x="3" y="4" width="14" height="13" rx="2"/>
                    <path d="M3 8h14M8 4V2M12 4V2"/>
                </svg>
            </div>
            Recent Bookings
        </div>
        <a href="{{ route('supplier.bookings') }}" class="sd-view-all">
            View all
            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M2 6h8M7 3l3 3-3 3"/>
            </svg>
        </a>
    </div>

    <div class="sd-card">
        <div class="scroll-hint">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 10h12M10 4l6 6-6 6"/></svg>
            Scroll sideways to see more
        </div>
        <div class="sd-tbl-scroll">
            <table class="sd-table">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Event</th>
                        <th>Package</th>
                        <th>Status</th>
                        <th style="text-align:right;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td>
                            <div class="td-client">
                                <div class="td-avatar">{{ strtoupper(substr($booking->user->name ?? 'U', 0, 2)) }}</div>
                                <span class="td-client-name">{{ $booking->user->name ?? '—' }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="td-event">{{ $booking->event->event_name ?? '—' }}</div>
                        </td>
                        <td>
                            <div class="td-package">{{ $booking->package->name ?? '—' }}</div>
                        </td>
                        <td>
                            @php $st = $booking->status ?? 'pending'; @endphp
                            <span class="bk-status {{ $st }}">{{ ucfirst($st) }}</span>
                        </td>
                        <td style="text-align:right;">
                            <div class="td-price">₱{{ number_format($booking->total_price, 2) }}</div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="sd-empty">
                                <div class="sd-empty-icon">
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect x="3" y="4" width="14" height="13" rx="2"/><path d="M3 8h14"/>
                                    </svg>
                                </div>
                                <p>No bookings yet.<br>They'll appear here once clients start booking.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ══ MY PACKAGES ══ --}}
    <div class="sd-section-head">
        <div class="sd-section-title">
            <div class="sd-section-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <rect x="3" y="5" width="14" height="12" rx="2"/>
                    <path d="M7 5V4a3 3 0 016 0v1"/>
                </svg>
            </div>
            My Packages
        </div>
        <a href="#" class="sd-view-all">
            Manage packages
            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M2 6h8M7 3l3 3-3 3"/>
            </svg>
        </a>
    </div>

    <div class="sd-card">
        @if(isset($packages) && count($packages))
        <div class="sd-pkg-grid">
            @foreach($packages as $package)
            @php $listed = $package->is_listed; @endphp
            <div class="sd-pkg">
                <div class="sd-pkg-status-dot {{ $listed ? 'listed' : 'hidden' }}" title="{{ $listed ? 'Listed' : 'Hidden' }}"></div>
                <div class="sd-pkg-name">{{ $package->name }}</div>
                <div class="sd-pkg-price">
                    ₱{{ number_format($package->price, 2) }}
                    <span>/ package</span>
                </div>
                <span class="sd-pkg-badge {{ $listed ? 'listed' : 'hidden' }}">
                    {{ $listed ? 'Listed' : 'Hidden' }}
                </span>
            </div>
            @endforeach
        </div>
        @else
        <div class="sd-empty">
            <div class="sd-empty-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="5" width="14" height="12" rx="2"/><path d="M7 5V4a3 3 0 016 0v1"/>
                </svg>
            </div>
            <p>No packages yet.<br>Create your first package to start receiving bookings.</p>
        </div>
        @endif
    </div>

</div>

</x-supplier-layout>