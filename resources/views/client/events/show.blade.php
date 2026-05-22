<x-client-layout>

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
    --shadow-hover:0 8px 32px rgba(30,27,24,.14);
}

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}

/* ── PAGE ── */
.rc-page{max-width:1200px;margin:auto;padding:2rem 1.5rem 4rem;}

/* ── ALERTS ── */
.rc-alert{display:flex;align-items:center;gap:.65rem;border-radius:10px;padding:.8rem 1.1rem;font-family:var(--font-body);font-size:.83rem;margin-bottom:1.25rem;}
.rc-alert svg{width:15px;height:15px;flex-shrink:0;}
.rc-alert-ok{background:#F0FDF4;border:1px solid #A7F3D0;color:#065F46;}
.rc-alert-ok svg{color:#10B981;}
.rc-alert-err{background:#FEF2F2;border:1px solid #FCA5A5;color:#991B1B;}
.rc-alert-err svg{color:#EF4444;}

/* ── HERO ── */
.rc-hero{
    background:linear-gradient(135deg,var(--charcoal) 0%,#2a2016 55%,#3d2f14 100%);
    border-radius:18px;padding:2.5rem 2.5rem 2rem;
    margin-bottom:2.5rem;position:relative;overflow:hidden;
}
.rc-hero::before{
    content:'';position:absolute;top:-60px;right:-60px;width:260px;height:260px;
    border-radius:50%;background:radial-gradient(circle,rgba(201,168,76,.18) 0%,transparent 70%);
    pointer-events:none;
}
.rc-hero::after{
    content:'';position:absolute;bottom:-80px;left:60px;width:200px;height:200px;
    border-radius:50%;background:radial-gradient(circle,rgba(201,168,76,.1) 0%,transparent 70%);
    pointer-events:none;
}
.rc-hero-eyebrow{
    display:inline-flex;align-items:center;gap:.5rem;
    padding:.28rem .85rem;border-radius:999px;
    background:rgba(201,168,76,.15);border:1px solid rgba(201,168,76,.3);
    color:var(--gold);font-family:var(--font-body);font-size:.68rem;
    font-weight:700;letter-spacing:.1em;text-transform:uppercase;margin-bottom:1rem;
}
.rc-hero-eyebrow::before{content:'';width:5px;height:5px;border-radius:50%;background:var(--gold);}
.rc-hero-title{
    font-family:var(--font-display);font-size:2rem;font-weight:700;
    color:var(--white);line-height:1.2;margin-bottom:.75rem;
}
.rc-hero-title em{font-style:italic;color:var(--gold);}
.rc-hero-sub{font-family:var(--font-body);font-size:.88rem;color:rgba(255,255,255,.65);line-height:1.65;max-width:560px;}
.rc-hero-chips{display:flex;flex-wrap:wrap;gap:.55rem;margin-top:1.35rem;}
.rc-hero-chip{
    display:inline-flex;align-items:center;gap:.42rem;
    padding:.38rem .9rem;border-radius:999px;
    background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.14);
    font-family:var(--font-body);font-size:.75rem;font-weight:500;color:rgba(255,255,255,.8);
}
.rc-hero-chip svg{width:12px;height:12px;opacity:.7;}

/* ── SECTION HEADER ── */
.rc-section-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.35rem;gap:.75rem;flex-wrap:wrap;}
.rc-section-hd-l{display:flex;align-items:center;gap:.75rem;}
.rc-section-icon{width:38px;height:38px;border-radius:10px;background:var(--gold-light);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
.rc-section-icon svg{width:18px;height:18px;}
.rc-section-title{font-family:var(--font-display);font-size:1.35rem;font-weight:700;color:var(--charcoal);}
.rc-section-title em{font-style:italic;color:var(--gold-dark);}
.rc-section-count{font-size:.7rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;padding:.2rem .7rem;border-radius:999px;background:var(--gold-light);color:var(--gold-dark);font-family:var(--font-body);}
.rc-section-divider{height:1px;background:linear-gradient(90deg,var(--gold-light) 0%,transparent 100%);margin-bottom:1.75rem;}

/* ── GRID ── */
.rc-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.25rem;margin-bottom:3rem;}
@media(max-width:680px){.rc-grid{grid-template-columns:1fr;}}

/* ── CARD ── */
.rc-card{
    background:var(--white);border-radius:var(--radius-card);
    border:1.5px solid var(--border);box-shadow:var(--shadow-card);
    display:flex;flex-direction:column;overflow:hidden;
    transition:box-shadow .22s,transform .22s,border-color .22s;
    animation:cardFadeUp .4s ease both;
}
.rc-card:hover{box-shadow:var(--shadow-hover);transform:translateY(-3px);border-color:rgba(201,168,76,.45);}
.rc-card:nth-child(2){animation-delay:.06s;}
.rc-card:nth-child(3){animation-delay:.12s;}
.rc-card:nth-child(4){animation-delay:.18s;}
.rc-card:nth-child(5){animation-delay:.24s;}
.rc-card:nth-child(6){animation-delay:.30s;}
@keyframes cardFadeUp{from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:translateY(0);}}

.rc-card-accent{height:3px;background:linear-gradient(90deg,var(--gold),#e6c84a,var(--gold-dark));width:100%;}

/* Card head */
.rc-card-head{padding:1.15rem 1.3rem .85rem;border-bottom:1px solid #F5EFE8;}
.rc-card-type{display:inline-flex;align-items:center;gap:.3rem;padding:.2rem .6rem;border-radius:var(--radius-badge);background:var(--gold-light);color:var(--gold-dark);font-family:var(--font-body);font-size:.62rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;margin-bottom:.4rem;}
.rc-card-name{font-family:var(--font-display);font-size:1.05rem;font-weight:700;color:var(--charcoal);line-height:1.25;margin-bottom:.28rem;}
.rc-card-supplier{display:flex;align-items:center;gap:.4rem;font-family:var(--font-body);font-size:.74rem;color:var(--warm-grey);}
.rc-card-supplier svg{width:11px;height:11px;color:var(--gold-dark);}
.rc-card-price-row{display:flex;align-items:baseline;gap:.35rem;margin-top:.55rem;}
.rc-card-price{font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:var(--charcoal);}
.rc-card-price-label{font-family:var(--font-body);font-size:.7rem;color:var(--warm-grey);}

/* AI Score */
.rc-score{
    display:inline-flex;align-items:center;gap:.45rem;
    padding:.3rem .85rem;border-radius:999px;
    font-family:var(--font-body);font-size:.72rem;font-weight:700;
    width:max-content;margin:.75rem 1.3rem .6rem;
}
.rc-score-high{background:rgba(16,185,129,.1);border:1px solid rgba(16,185,129,.25);color:#065F46;}
.rc-score-mid{background:var(--gold-light);border:1px solid rgba(201,168,76,.3);color:var(--gold-dark);}
.rc-score-low{background:#F1F5F9;border:1px solid #E2E8F0;color:#475569;}
.rc-score-dot{width:7px;height:7px;border-radius:50%;flex-shrink:0;}
.rc-score-high .rc-score-dot{background:#10B981;}
.rc-score-mid .rc-score-dot{background:var(--gold);}
.rc-score-low .rc-score-dot{background:#94A3B8;}

/* Card body */
.rc-card-body{padding:.75rem 1.3rem;flex:1;display:flex;flex-direction:column;gap:.85rem;}

/* Inclusions */
.rc-box-label{font-family:var(--font-body);font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#C0B8B0;margin-bottom:.5rem;}
.rc-inc-list{list-style:none;display:flex;flex-direction:column;gap:.32rem;}
.rc-inc-list li{display:flex;align-items:flex-start;gap:.45rem;font-family:var(--font-body);font-size:.78rem;color:var(--charcoal);line-height:1.45;}
.rc-inc-list li::before{content:'';width:5px;height:5px;border-radius:50%;background:var(--gold);flex-shrink:0;margin-top:.42rem;}

/* Bundle items box */
.rc-bundle-box{background:var(--ivory);border-radius:10px;padding:.85rem 1rem;border:1px solid #F0EBE5;}
.rc-bundle-item{display:flex;align-items:center;justify-content:space-between;padding:.38rem 0;border-bottom:1px solid #F0EBE5;gap:.5rem;}
.rc-bundle-item:last-child{border-bottom:none;padding-bottom:0;}
.rc-bundle-item-name{font-family:var(--font-body);font-size:.78rem;font-weight:600;color:var(--charcoal);}
.rc-bundle-item-pkg{font-family:var(--font-body);font-size:.7rem;color:var(--warm-grey);text-align:right;max-width:55%;}

/* Card footer — TWO BUTTONS */
.rc-card-foot{padding:.85rem 1.3rem;border-top:1px solid #F5EFE8;display:flex;flex-direction:column;gap:.55rem;}

/* Negotiate / Bid button (primary gold) */
.rc-negotiate-btn{
    width:100%;display:flex;align-items:center;justify-content:center;gap:.5rem;
    padding:.72rem 1rem;border-radius:var(--radius-btn);
    border:none;background:linear-gradient(135deg,var(--gold-dark) 0%,#a07c28 100%);
    font-family:var(--font-body);font-size:.82rem;font-weight:700;color:var(--white);
    cursor:pointer;text-decoration:none;
    transition:opacity .2s,box-shadow .2s,transform .15s;
}
.rc-negotiate-btn svg{width:14px;height:14px;flex-shrink:0;}
.rc-negotiate-btn:hover{opacity:.9;box-shadow:0 4px 14px rgba(138,106,31,.35);transform:translateY(-1px);}

/* Book direct button (secondary charcoal outline) */
.rc-book-btn{
    width:100%;display:flex;align-items:center;justify-content:center;gap:.5rem;
    padding:.62rem 1rem;border-radius:var(--radius-btn);
    border:1.5px solid var(--charcoal);background:transparent;
    font-family:var(--font-body);font-size:.78rem;font-weight:600;color:var(--charcoal);
    cursor:pointer;text-decoration:none;
    transition:background .2s,color .2s,border-color .2s;
}
.rc-book-btn svg{width:13px;height:13px;flex-shrink:0;}
.rc-book-btn:hover{background:var(--charcoal);color:var(--white);}

/* ── EMPTY ── */
.rc-empty{text-align:center;padding:3.5rem 1.5rem;background:var(--white);border-radius:var(--radius-card);border:1.5px dashed var(--border);}
.rc-empty-icon{width:50px;height:50px;border-radius:50%;background:var(--gold-light);display:flex;align-items:center;justify-content:center;margin:0 auto .85rem;color:var(--gold-dark);}
.rc-empty-icon svg{width:22px;height:22px;}
.rc-empty-title{font-family:var(--font-display);font-size:.95rem;font-weight:700;color:var(--charcoal);margin-bottom:.3rem;}
.rc-empty-desc{font-family:var(--font-body);font-size:.8rem;color:var(--warm-grey);}

/* ── RESPONSIVE ── */
@media(max-width:520px){
    .rc-hero{padding:1.75rem 1.35rem 1.5rem;}
    .rc-hero-title{font-size:1.5rem;}
    .rc-page{padding:1.25rem 1rem 3rem;}
}
</style>

<div class="rc-page">

    {{-- ── ALERTS ── --}}
    @if(session('success'))
    <div class="rc-alert rc-alert-ok">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="rc-alert rc-alert-err">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="10" cy="10" r="8"/><path d="M10 6v4M10 14v.5"/></svg>
        {{ session('error') }}
    </div>
    @endif

    {{-- ── HERO ── --}}
    <div class="rc-hero">
        <div class="rc-hero-eyebrow">AI-Powered Recommendations</div>
        <h1 class="rc-hero-title">Negotiate & <em>Bid</em> On Packages</h1>
        <p class="rc-hero-sub">
            Our AI matched the best packages to your event. Chat directly with suppliers,
            negotiate pricing, or place a bid to secure the best deal.
        </p>
        <div class="rc-hero-chips">
            @if(isset($event))
            <div class="rc-hero-chip">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 1l1.5 3.5L12 5l-2.5 2.5.6 3.5L7 9.5l-3.1 1.5.6-3.5L2 5l3.5-.5z"/></svg>
                {{ $event->event_type ?? 'Event' }}
            </div>
            <div class="rc-hero-chip">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="5"/><path d="M7 4v3.5l2 1.5"/></svg>
                ₱{{ number_format($event->budget ?? 0, 2) }} Budget
            </div>
            <div class="rc-hero-chip">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="5" cy="5" r="2.5"/><path d="M1 12c0-2.5 1.8-4 4-4"/><circle cx="10" cy="5" r="2.5"/><path d="M7.5 12c0-2.5 1.8-4 4.5-4"/></svg>
                {{ $event->guest_count ?? 0 }} Guests
            </div>
            @endif
            <div class="rc-hero-chip">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 10l2.5-2.5 2 2L10 6M12 2l-3 1 1 3"/></svg>
                Live Bidding Available
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         SUPPLIER PACKAGES
    ═══════════════════════════════════════ --}}
    <div class="rc-section-hd">
        <div class="rc-section-hd-l">
            <div class="rc-section-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6">
                    <path d="M3 7h14M3 7V5a2 2 0 012-2h10a2 2 0 012 2v2M3 7l2 9a2 2 0 002 2h6a2 2 0 002-2l2-9"/>
                    <path d="M8 11h4"/>
                </svg>
            </div>
            <div>
                <div class="rc-section-title">Supplier <em>Packages</em></div>
            </div>
        </div>
        <span class="rc-section-count">{{ count($supplierPackages) }} matches</span>
    </div>
    <div class="rc-section-divider"></div>

    @if(count($supplierPackages))
    <div class="rc-grid">
        @foreach($supplierPackages as $package)
        @php
            $score = $package->score ?? 0;
            $scoreClass = $score >= 80 ? 'rc-score-high' : ($score >= 50 ? 'rc-score-mid' : 'rc-score-low');
            $scoreLabel = $score >= 80 ? 'Excellent Match' : ($score >= 50 ? 'Good Match' : 'Possible Match');
        @endphp
        <div class="rc-card">
            <div class="rc-card-accent"></div>

            {{-- Head --}}
            <div class="rc-card-head">
                @if($package->event_type)
                    <div class="rc-card-type">{{ $package->event_type }}</div>
                @endif
                <div class="rc-card-name">{{ $package->name }}</div>
                <div class="rc-card-supplier">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="5" r="3"/><path d="M1 13c0-3 2.7-5 6-5s6 2 6 5"/></svg>
                    {{ $package->supplier->business_name ?? 'Supplier' }}
                </div>
                <div class="rc-card-price-row">
                    <span class="rc-card-price">₱{{ number_format($package->price, 2) }}</span>
                    <span class="rc-card-price-label">listed price</span>
                </div>
            </div>

            {{-- AI Score --}}
            <div class="rc-score {{ $scoreClass }}">
                <span class="rc-score-dot"></span>
                {{ $scoreLabel }} &mdash; {{ $score }}
            </div>

            {{-- Body --}}
            <div class="rc-card-body">

                {{-- Inclusions --}}
                @if($package->inclusions && $package->inclusions->count())
                <div>
                    <div class="rc-box-label">Inclusions</div>
                    <ul class="rc-inc-list">
                        @foreach($package->inclusions->take(5) as $inc)
                        <li>{{ $inc->title }}</li>
                        @endforeach
                        @if($package->inclusions->count() > 5)
                        <li style="color:var(--gold-dark);font-style:italic;">
                            +{{ $package->inclusions->count() - 5 }} more
                        </li>
                        @endif
                    </ul>
                </div>
                @endif

            </div>

            {{-- Footer: two action buttons --}}
            <div class="rc-card-foot">
                {{-- Primary: Negotiate / Bid --}}
                <a href="{{ route('chat', [
                        'userId'     => $package->supplier->user->id ?? null,
                        'supplierId' => $package->supplier_id,
                        'packageId'  => $package->id,
                        'eventId'    => request()->event_id,
                    ]) }}"
                   class="rc-negotiate-btn">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 2h10a1 1 0 011 1v6a1 1 0 01-1 1H5l-3 2V3a1 1 0 011-1z"/>
                    </svg>
                    Negotiate / Bid Now
                </a>
                {{-- Secondary: direct book --}}
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="event_id"   value="{{ $event->id ?? '' }}">
                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                    <button type="submit" class="rc-book-btn">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="1.5" width="10" height="11" rx="1.5"/>
                            <path d="M5 5h4M5 7.5h4M5 10h2"/>
                        </svg>
                        Book at Listed Price
                    </button>
                </form>
            </div>

        </div>
        @endforeach
    </div>

    @else
    <div class="rc-empty" style="margin-bottom:3rem;">
        <div class="rc-empty-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 7h14M3 7V5a2 2 0 012-2h10a2 2 0 012 2v2M3 7l2 9a2 2 0 002 2h6a2 2 0 002-2l2-9"/></svg></div>
        <div class="rc-empty-title">No Supplier Packages Found</div>
        <div class="rc-empty-desc">No supplier packages matched your event criteria at this time.</div>
    </div>
    @endif


    {{-- ═══════════════════════════════════════
         POPULAR BUNDLE PACKAGES
    ═══════════════════════════════════════ --}}
    <div class="rc-section-hd">
        <div class="rc-section-hd-l">
            <div class="rc-section-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6">
                    <rect x="2" y="3" width="16" height="14" rx="2"/>
                    <path d="M6 3v14M10 9h5M10 12h3"/>
                </svg>
            </div>
            <div>
                <div class="rc-section-title">Popular <em>Bundle Packages</em></div>
            </div>
        </div>
        <span class="rc-section-count">{{ count($popularPackages) }} matches</span>
    </div>
    <div class="rc-section-divider"></div>

    @if(count($popularPackages))
    <div class="rc-grid">
        @foreach($popularPackages as $package)
        @php
            $score = $package->score ?? 0;
            $scoreClass = $score >= 80 ? 'rc-score-high' : ($score >= 50 ? 'rc-score-mid' : 'rc-score-low');
            $scoreLabel = $score >= 80 ? 'Excellent Match' : ($score >= 50 ? 'Good Match' : 'Possible Match');
            $firstItem  = $package->items->first();
        @endphp
        <div class="rc-card">
            <div class="rc-card-accent"></div>

            {{-- Head --}}
            <div class="rc-card-head">
                @if($package->event_type)
                    <div class="rc-card-type">{{ $package->event_type }}</div>
                @endif
                <div class="rc-card-name">{{ $package->name }}</div>
                <div class="rc-card-price-row">
                    <span class="rc-card-price">₱{{ number_format($package->price, 2) }}</span>
                    <span class="rc-card-price-label">bundle price</span>
                </div>
            </div>

            {{-- AI Score --}}
            <div class="rc-score {{ $scoreClass }}">
                <span class="rc-score-dot"></span>
                {{ $scoreLabel }} &mdash; {{ $score }}
            </div>

            {{-- Body --}}
            <div class="rc-card-body">

                {{-- Bundle suppliers --}}
                @if($package->items && $package->items->count())
                <div>
                    <div class="rc-box-label">Included Suppliers</div>
                    <div class="rc-bundle-box">
                        @foreach($package->items as $item)
                        <div class="rc-bundle-item">
                            <span class="rc-bundle-item-name">
                                {{ optional($item->supplier)->business_name ?? '—' }}
                            </span>
                            <span class="rc-bundle-item-pkg">
                                {{ optional($item->package)->name ?? '' }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Inclusions --}}
                @if($package->inclusions && $package->inclusions->count())
                <div>
                    <div class="rc-box-label">Package Inclusions</div>
                    <ul class="rc-inc-list">
                        @foreach($package->inclusions->take(5) as $inc)
                        <li>{{ $inc->title }}</li>
                        @endforeach
                        @if($package->inclusions->count() > 5)
                        <li style="color:var(--gold-dark);font-style:italic;">
                            +{{ $package->inclusions->count() - 5 }} more
                        </li>
                        @endif
                    </ul>
                </div>
                @endif

            </div>

            {{-- Footer: two action buttons --}}
            <div class="rc-card-foot">
                {{-- Primary: Negotiate Bundle --}}
                <a href="{{ route('chat', [
                        'userId'     => auth()->id(),
                        'supplierId' => $firstItem->supplier_id ?? null,
                        'packageId'  => $firstItem->package_id  ?? null,
                        'eventId'    => request()->event_id,
                    ]) }}"
                   class="rc-negotiate-btn">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2l-3 1 1 3M2 12l3-1-1-3M9 5L5 9"/>
                    </svg>
                    Negotiate Bundle
                </a>
                {{-- Secondary: Book bundle --}}
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="event_id"          value="{{ $event->id ?? '' }}">
                    <input type="hidden" name="popular_package_id" value="{{ $package->id }}">
                    <button type="submit" class="rc-book-btn">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="1.5" y="2" width="11" height="10" rx="1.5"/>
                            <path d="M5 2V1M9 2V1M1.5 5.5h11"/>
                            <path d="M5 8l1.5 1.5L9 7"/>
                        </svg>
                        Book Bundle Package
                    </button>
                </form>
            </div>

        </div>
        @endforeach
    </div>

    @else
    <div class="rc-empty">
        <div class="rc-empty-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="16" height="14" rx="2"/><path d="M6 3v14M10 9h5M10 12h3"/></svg></div>
        <div class="rc-empty-title">No Bundle Packages Found</div>
        <div class="rc-empty-desc">No popular bundles matched your event criteria at this time.</div>
    </div>
    @endif

</div>

</x-client-layout>