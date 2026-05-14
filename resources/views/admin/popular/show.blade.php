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
    --radius-card:14px; --radius-btn:6px; --radius-badge:20px;
    --shadow-card:0 2px 16px rgba(30,27,24,.07);
    --shadow-hover:0 6px 28px rgba(30,27,24,.13);
}

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}

/* ── PAGE ── */
.pd-page{max-width:1100px;margin:auto;padding:2rem 1.5rem 4rem;}

/* ── BACK LINK ── */
.pd-back{
    display:inline-flex;align-items:center;gap:.45rem;
    font-family:var(--font-body);font-size:.78rem;font-weight:500;
    color:var(--warm-grey);text-decoration:none;
    padding:.38rem .75rem;border-radius:var(--radius-btn);
    border:1.5px solid var(--border);background:var(--white);
    transition:border-color .18s,color .18s,background .18s;
    margin-bottom:1.5rem;
}
.pd-back svg{width:13px;height:13px;}
.pd-back:hover{border-color:var(--gold);color:var(--gold-dark);background:var(--gold-light);}

/* ── HERO ── */
.pd-hero{
    background:linear-gradient(135deg,var(--charcoal) 0%,#2a2016 55%,#3d2f14 100%);
    border-radius:18px;padding:2.25rem 2.5rem 2rem;
    margin-bottom:2rem;position:relative;overflow:hidden;
}
.pd-hero::before{
    content:'';position:absolute;top:-50px;right:-50px;
    width:240px;height:240px;border-radius:50%;
    background:radial-gradient(circle,rgba(201,168,76,.2) 0%,transparent 70%);
    pointer-events:none;
}
.pd-hero::after{
    content:'';position:absolute;bottom:-70px;left:40px;
    width:180px;height:180px;border-radius:50%;
    background:radial-gradient(circle,rgba(201,168,76,.1) 0%,transparent 70%);
    pointer-events:none;
}
.pd-hero-eyebrow{
    display:inline-flex;align-items:center;gap:.5rem;
    padding:.26rem .82rem;border-radius:999px;
    background:rgba(201,168,76,.15);border:1px solid rgba(201,168,76,.3);
    color:var(--gold);font-family:var(--font-body);font-size:.65rem;
    font-weight:700;letter-spacing:.1em;text-transform:uppercase;
    margin-bottom:.9rem;
}
.pd-hero-eyebrow::before{content:'';width:5px;height:5px;border-radius:50%;background:var(--gold);}
.pd-hero-row{display:flex;align-items:flex-start;justify-content:space-between;gap:1.5rem;flex-wrap:wrap;}
.pd-hero-name{
    font-family:var(--font-display);font-size:1.9rem;font-weight:700;
    color:var(--white);line-height:1.2;margin-bottom:.45rem;
}
.pd-hero-name em{font-style:italic;color:var(--gold);}
.pd-hero-type{
    display:inline-flex;align-items:center;gap:.35rem;
    padding:.22rem .75rem;border-radius:999px;
    background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.18);
    font-family:var(--font-body);font-size:.72rem;font-weight:600;color:rgba(255,255,255,.8);
}
.pd-hero-price{
    text-align:right;flex-shrink:0;
}
.pd-hero-price-label{font-family:var(--font-body);font-size:.65rem;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:rgba(255,255,255,.45);margin-bottom:.2rem;}
.pd-hero-price-val{font-family:var(--font-display);font-size:2.1rem;font-weight:700;color:var(--gold);line-height:1;}

/* ── STAT ROW ── */
.pd-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:2rem;}
@media(max-width:640px){.pd-stats{grid-template-columns:repeat(2,1fr);}}
@media(max-width:380px){.pd-stats{grid-template-columns:1fr;}}

.pd-stat-card{
    background:var(--white);border-radius:12px;
    border:1.5px solid var(--border);box-shadow:var(--shadow-card);
    padding:1.1rem 1.3rem;
    display:flex;flex-direction:column;gap:.35rem;
    transition:box-shadow .2s,transform .2s,border-color .2s;
}
.pd-stat-card:hover{box-shadow:var(--shadow-hover);transform:translateY(-2px);border-color:rgba(201,168,76,.4);}
.pd-stat-icon{
    width:32px;height:32px;border-radius:8px;
    background:var(--gold-light);display:flex;align-items:center;justify-content:center;
    color:var(--gold-dark);margin-bottom:.2rem;
}
.pd-stat-icon svg{width:15px;height:15px;}
.pd-stat-label{font-family:var(--font-body);font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#C0B8B0;}
.pd-stat-val{font-family:var(--font-display);font-size:1.35rem;font-weight:700;color:var(--charcoal);line-height:1.2;}
.pd-stat-sub{font-family:var(--font-body);font-size:.68rem;color:var(--warm-grey);}

/* ── TWO-COL LAYOUT ── */
.pd-cols{display:grid;grid-template-columns:1fr 340px;gap:1.5rem;align-items:start;}
@media(max-width:860px){.pd-cols{grid-template-columns:1fr;}}

/* ── SECTION CARD ── */
.pd-sc{
    background:var(--white);border-radius:var(--radius-card);
    border:1.5px solid var(--border);box-shadow:var(--shadow-card);
    overflow:hidden;
}
.pd-sc-head{
    display:flex;align-items:center;justify-content:space-between;
    padding:1rem 1.4rem;border-bottom:1px solid #F5EFE8;
}
.pd-sc-head-l{display:flex;align-items:center;gap:.65rem;}
.pd-sc-icon{
    width:32px;height:32px;border-radius:8px;
    background:var(--gold-light);display:flex;align-items:center;justify-content:center;
    color:var(--gold-dark);flex-shrink:0;
}
.pd-sc-icon svg{width:15px;height:15px;}
.pd-sc-title{font-family:var(--font-display);font-size:.92rem;font-weight:700;color:var(--charcoal);}
.pd-sc-desc{font-family:var(--font-body);font-size:.68rem;color:var(--warm-grey);margin-top:.05rem;}
.pd-sc-body{padding:1.2rem 1.4rem;}
.pd-badge-count{
    padding:.18rem .6rem;border-radius:999px;
    background:var(--gold-light);color:var(--gold-dark);
    font-family:var(--font-body);font-size:.66rem;font-weight:700;
}

/* ── SUPPLIER ITEMS ── */
.pd-supplier-list{display:flex;flex-direction:column;gap:.6rem;}
.pd-supplier-item{
    display:flex;align-items:center;gap:.75rem;
    padding:.7rem .9rem;border-radius:10px;
    background:var(--ivory);border:1px solid #F0EBE5;
    transition:border-color .18s;
}
.pd-supplier-item:hover{border-color:rgba(201,168,76,.35);}
.pd-supplier-avatar{
    width:36px;height:36px;border-radius:50%;flex-shrink:0;
    background:linear-gradient(135deg,var(--gold),var(--gold-dark));
    display:flex;align-items:center;justify-content:center;
    font-family:var(--font-display);font-size:.85rem;font-weight:700;color:var(--white);
}
.pd-supplier-name{font-family:var(--font-body);font-size:.83rem;font-weight:600;color:var(--charcoal);}
.pd-supplier-pkg{font-family:var(--font-body);font-size:.72rem;color:var(--warm-grey);margin-top:.06rem;}

/* ── BOOKINGS TABLE ── */
.pd-table-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch;}
.pd-table{width:100%;border-collapse:collapse;}
.pd-table thead tr{border-bottom:1px solid #F0EBE5;}
.pd-table th{
    padding:.7rem 1rem;
    font-family:var(--font-body);font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
    color:#C0B8B0;text-align:left;white-space:nowrap;
}
.pd-table tbody tr{border-bottom:1px solid #F7F3EF;transition:background .15s;}
.pd-table tbody tr:last-child{border-bottom:none;}
.pd-table tbody tr:hover{background:rgba(201,168,76,.03);}
.pd-table td{
    padding:.85rem 1rem;
    font-family:var(--font-body);font-size:.8rem;color:var(--charcoal);
    vertical-align:middle;
}

/* Name cell with avatar */
.pd-client-cell{display:flex;align-items:center;gap:.6rem;}
.pd-client-av{
    width:30px;height:30px;border-radius:50%;flex-shrink:0;
    background:linear-gradient(135deg,var(--gold),var(--gold-dark));
    display:flex;align-items:center;justify-content:center;
    font-family:var(--font-display);font-size:.68rem;font-weight:700;color:var(--white);
}
.pd-client-name{font-weight:600;color:var(--charcoal);}

/* Status badges */
.pd-status{
    display:inline-flex;align-items:center;gap:.3rem;
    padding:.22rem .65rem;border-radius:999px;
    font-family:var(--font-body);font-size:.67rem;font-weight:700;
    text-transform:capitalize;white-space:nowrap;
}
.pd-status::before{content:'';width:5px;height:5px;border-radius:50%;flex-shrink:0;}
.pd-status-confirmed{background:#F0FDF4;border:1px solid #A7F3D0;color:#065F46;}
.pd-status-confirmed::before{background:#10B981;}
.pd-status-cancelled{background:#FEF2F2;border:1px solid #FCA5A5;color:#991B1B;}
.pd-status-cancelled::before{background:#EF4444;}
.pd-status-pending{background:#FFFBEB;border:1px solid #FDE68A;color:#92400E;}
.pd-status-pending::before{background:#F59E0B;}
.pd-status-other{background:var(--gold-light);border:1px solid rgba(201,168,76,.3);color:var(--gold-dark);}
.pd-status-other::before{background:var(--gold);}

/* Price cell */
.pd-price-cell{font-family:var(--font-display);font-weight:700;color:var(--charcoal);}

/* ── EMPTY ── */
.pd-empty{
    text-align:center;padding:3rem 1.5rem;
}
.pd-empty-icon{
    width:46px;height:46px;border-radius:50%;background:var(--gold-light);
    display:flex;align-items:center;justify-content:center;
    margin:0 auto .75rem;color:var(--gold-dark);
}
.pd-empty-icon svg{width:20px;height:20px;}
.pd-empty-title{font-family:var(--font-display);font-size:.92rem;font-weight:700;color:var(--charcoal);margin-bottom:.3rem;}
.pd-empty-desc{font-family:var(--font-body);font-size:.78rem;color:var(--warm-grey);}

/* ── RESPONSIVE ── */
@media(max-width:600px){
    .pd-table th:nth-child(4),
    .pd-table td:nth-child(4){display:none;}
    .pd-hero-name{font-size:1.45rem;}
    .pd-hero-price-val{font-size:1.6rem;}
    .pd-page{padding:1.25rem 1rem 3rem;}
}
</style>

<div class="pd-page">

    {{-- ── BACK ── --}}
    <a href="{{ url()->previous() }}" class="pd-back">
        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 2L4 7l5 5"/>
        </svg>
        Back
    </a>

    {{-- ── HERO ── --}}
    <div class="pd-hero">
        <div class="pd-hero-eyebrow">Package Analytics</div>
        <div class="pd-hero-row">
            <div>
                <div class="pd-hero-name">{{ $package->name }}</div>
                @if($package->event_type)
                <div class="pd-hero-type">{{ $package->event_type }}</div>
                @endif
            </div>
            @if($package->price)
            <div class="pd-hero-price">
                <div class="pd-hero-price-label">Package Price</div>
                <div class="pd-hero-price-val">₱{{ number_format($package->price, 2) }}</div>
            </div>
            @endif
        </div>
    </div>

    {{-- ── STAT CARDS ── --}}
    @php
        $totalBookings   = $package->bookings->count();
        $confirmedCount  = $package->bookings->where('status','confirmed')->count();
        $cancelledCount  = $package->bookings->where('status','cancelled')->count();
        $pendingCount    = $package->bookings->whereNotIn('status',['confirmed','cancelled'])->count();
        $totalRevenue    = $package->bookings->where('status','confirmed')->sum('total_price');
        $conversionRate  = $totalBookings > 0 ? round(($confirmedCount / $totalBookings) * 100) : 0;
    @endphp

    <div class="pd-stats">

        <div class="pd-stat-card">
            <div class="pd-stat-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <rect x="2" y="4" width="16" height="13" rx="2"/>
                    <path d="M2 8h16M6 2v3M14 2v3"/>
                </svg>
            </div>
            <div class="pd-stat-label">Total Bookings</div>
            <div class="pd-stat-val">{{ $totalBookings }}</div>
            <div class="pd-stat-sub">All time</div>
        </div>

        <div class="pd-stat-card">
            <div class="pd-stat-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="10" cy="10" r="7"/>
                    <path d="M10 6v8M7.5 8.5h4a1.5 1.5 0 010 3h-3a1.5 1.5 0 000 3H13"/>
                </svg>
            </div>
            <div class="pd-stat-label">Total Revenue</div>
            <div class="pd-stat-val" style="font-size:1.1rem;">₱{{ number_format($totalRevenue, 2) }}</div>
            <div class="pd-stat-sub">Confirmed only</div>
        </div>

        <div class="pd-stat-card">
            <div class="pd-stat-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M5 10l4 4 6-6"/>
                    <circle cx="10" cy="10" r="7"/>
                </svg>
            </div>
            <div class="pd-stat-label">Confirmed</div>
            <div class="pd-stat-val" style="color:#065F46;">{{ $confirmedCount }}</div>
            <div class="pd-stat-sub">{{ $conversionRate }}% conversion</div>
        </div>

        <div class="pd-stat-card">
            <div class="pd-stat-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="10" cy="10" r="7"/>
                    <path d="M10 7v3M10 13v.5"/>
                </svg>
            </div>
            <div class="pd-stat-label">Pending</div>
            <div class="pd-stat-val" style="color:#92400E;">{{ $pendingCount }}</div>
            <div class="pd-stat-sub">{{ $cancelledCount }} cancelled</div>
        </div>

    </div>

    {{-- ── TWO-COL CONTENT ── --}}
    <div class="pd-cols">

        {{-- LEFT: Bookings Table --}}
        <div class="pd-sc">
            <div class="pd-sc-head">
                <div class="pd-sc-head-l">
                    <div class="pd-sc-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="2" y="4" width="16" height="13" rx="2"/>
                            <path d="M2 8h16M6 2v3M14 2v3"/>
                        </svg>
                    </div>
                    <div>
                        <div class="pd-sc-title">Bookings</div>
                        <div class="pd-sc-desc">All client bookings for this package</div>
                    </div>
                </div>
                <span class="pd-badge-count">{{ $totalBookings }}</span>
            </div>

            @if($package->bookings->count())
            <div class="pd-table-wrap">
                <table class="pd-table">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Event</th>
                            <th>Supplier</th>
                            <th>Status</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($package->bookings as $booking)
                        @php
                            $status = strtolower($booking->status ?? 'pending');
                            $statusClass = match($status) {
                                'confirmed' => 'pd-status-confirmed',
                                'cancelled' => 'pd-status-cancelled',
                                'pending'   => 'pd-status-pending',
                                default     => 'pd-status-other',
                            };
                        @endphp
                        <tr>
                            <td>
                                <div class="pd-client-cell">
                                    <div class="pd-client-av">
                                        {{ strtoupper(substr($booking->user->name ?? 'U', 0, 2)) }}
                                    </div>
                                    <span class="pd-client-name">{{ $booking->user->name ?? '—' }}</span>
                                </div>
                            </td>
                            <td>{{ $booking->event->event_name ?? '—' }}</td>
                            <td>{{ $booking->package->supplier->business_name ?? '—' }}</td>
                            <td>
                                <span class="pd-status {{ $statusClass }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="pd-price-cell">₱{{ number_format($booking->total_price, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @else
            <div class="pd-empty">
                <div class="pd-empty-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="2" y="4" width="16" height="13" rx="2"/>
                        <path d="M2 8h16M6 2v3M14 2v3"/>
                    </svg>
                </div>
                <div class="pd-empty-title">No Bookings Yet</div>
                <div class="pd-empty-desc">No clients have booked this package yet.</div>
            </div>
            @endif
        </div>

        {{-- RIGHT: Included Suppliers --}}
        <div style="display:flex;flex-direction:column;gap:1.25rem;">

            <div class="pd-sc">
                <div class="pd-sc-head">
                    <div class="pd-sc-head-l">
                        <div class="pd-sc-icon">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <circle cx="7" cy="7" r="3"/>
                                <path d="M1 17c0-3 2.7-5 6-5"/>
                                <circle cx="14" cy="7" r="3"/>
                                <path d="M10 17c0-3 2.7-5 6-5 3.3 0 3 2 3 5"/>
                            </svg>
                        </div>
                        <div>
                            <div class="pd-sc-title">Included Suppliers</div>
                            <div class="pd-sc-desc">Bundled into this package</div>
                        </div>
                    </div>
                    <span class="pd-badge-count">{{ $package->items->count() }}</span>
                </div>

                <div class="pd-sc-body">
                    @if($package->items->count())
                    <div class="pd-supplier-list">
                        @foreach($package->items as $item)
                        @php
                            $bizName = optional($item->supplier)->business_name ?? 'Unknown Supplier';
                            $initials = strtoupper(substr($bizName, 0, 2));
                        @endphp
                        <div class="pd-supplier-item">
                            <div class="pd-supplier-avatar">{{ $initials }}</div>
                            <div style="min-width:0;">
                                <div class="pd-supplier-name">{{ $bizName }}</div>
                                @if(optional($item->package)->name)
                                <div class="pd-supplier-pkg">{{ $item->package->name }}</div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @else
                    <div class="pd-empty" style="padding:2rem 1rem;">
                        <div class="pd-empty-icon">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="7" cy="7" r="3"/><path d="M1 17c0-3 2.7-5 6-5"/>
                                <circle cx="14" cy="7" r="3"/><path d="M10 17c0-3 2.7-5 6-5 3.3 0 3 2 3 5"/>
                            </svg>
                        </div>
                        <div class="pd-empty-title">No Suppliers</div>
                        <div class="pd-empty-desc">No suppliers bundled yet.</div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Booking Status Breakdown mini card --}}
            <div class="pd-sc">
                <div class="pd-sc-head">
                    <div class="pd-sc-head-l">
                        <div class="pd-sc-icon">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M3 17V8l7-5 7 5v9"/>
                                <rect x="7" y="12" width="6" height="5"/>
                            </svg>
                        </div>
                        <div>
                            <div class="pd-sc-title">Status Breakdown</div>
                            <div class="pd-sc-desc">Booking status summary</div>
                        </div>
                    </div>
                </div>
                <div class="pd-sc-body" style="display:flex;flex-direction:column;gap:.7rem;">

                    {{-- Confirmed --}}
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:.75rem;">
                        <div style="display:flex;align-items:center;gap:.5rem;">
                            <span style="width:8px;height:8px;border-radius:50%;background:#10B981;flex-shrink:0;display:block;"></span>
                            <span style="font-family:var(--font-body);font-size:.78rem;color:var(--warm-grey);">Confirmed</span>
                        </div>
                        <div style="flex:1;height:5px;background:#F0EBE5;border-radius:3px;overflow:hidden;">
                            <div style="height:100%;width:{{ $totalBookings > 0 ? ($confirmedCount/$totalBookings)*100 : 0 }}%;background:#10B981;border-radius:3px;transition:width .6s ease;"></div>
                        </div>
                        <span style="font-family:var(--font-display);font-size:.82rem;font-weight:700;color:var(--charcoal);min-width:20px;text-align:right;">{{ $confirmedCount }}</span>
                    </div>

                    {{-- Pending --}}
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:.75rem;">
                        <div style="display:flex;align-items:center;gap:.5rem;">
                            <span style="width:8px;height:8px;border-radius:50%;background:#F59E0B;flex-shrink:0;display:block;"></span>
                            <span style="font-family:var(--font-body);font-size:.78rem;color:var(--warm-grey);">Pending</span>
                        </div>
                        <div style="flex:1;height:5px;background:#F0EBE5;border-radius:3px;overflow:hidden;">
                            <div style="height:100%;width:{{ $totalBookings > 0 ? ($pendingCount/$totalBookings)*100 : 0 }}%;background:#F59E0B;border-radius:3px;transition:width .6s ease;"></div>
                        </div>
                        <span style="font-family:var(--font-display);font-size:.82rem;font-weight:700;color:var(--charcoal);min-width:20px;text-align:right;">{{ $pendingCount }}</span>
                    </div>

                    {{-- Cancelled --}}
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:.75rem;">
                        <div style="display:flex;align-items:center;gap:.5rem;">
                            <span style="width:8px;height:8px;border-radius:50%;background:#EF4444;flex-shrink:0;display:block;"></span>
                            <span style="font-family:var(--font-body);font-size:.78rem;color:var(--warm-grey);">Cancelled</span>
                        </div>
                        <div style="flex:1;height:5px;background:#F0EBE5;border-radius:3px;overflow:hidden;">
                            <div style="height:100%;width:{{ $totalBookings > 0 ? ($cancelledCount/$totalBookings)*100 : 0 }}%;background:#EF4444;border-radius:3px;transition:width .6s ease;"></div>
                        </div>
                        <span style="font-family:var(--font-display);font-size:.82rem;font-weight:700;color:var(--charcoal);min-width:20px;text-align:right;">{{ $cancelledCount }}</span>
                    </div>

                </div>
            </div>

        </div>{{-- /right col --}}

    </div>{{-- /pd-cols --}}

</div>{{-- /pd-page --}}

</x-app-layout>