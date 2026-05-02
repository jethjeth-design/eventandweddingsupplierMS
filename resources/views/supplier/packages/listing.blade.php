<x-supplier-layout>

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
.sp-top{display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:.75rem;margin-bottom:1.75rem;}
.sp-title{font-family:var(--font-display);font-size:1.65rem;font-weight:700;color:var(--charcoal);line-height:1.15;}
.sp-title em{font-style:italic;color:var(--gold-dark);}
.sp-subtitle{font-size:.76rem;color:var(--warm-grey);margin-top:.2rem;font-family:var(--font-body);}

/* ── GRID ── */
.sp-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
    gap:1.25rem;
}

/* ── PACKAGE CARD ── */
.sp-card{
    background:var(--white);
    border:1.5px solid var(--border);
    border-radius:14px;
    overflow:hidden;
    display:flex;
    flex-direction:column;
    transition:box-shadow .2s,transform .2s,border-color .2s;
}
.sp-card:hover{
    box-shadow:0 8px 28px rgba(201,168,76,.13);
    transform:translateY(-2px);
    border-color:rgba(201,168,76,.4);
}

/* Card accent bar */
.sp-card-bar{height:3px;background:linear-gradient(90deg,var(--gold) 0%,rgba(201,168,76,.15) 100%);}

/* Card body */
.sp-card-body{padding:1.15rem 1.2rem;flex:1;display:flex;flex-direction:column;gap:.55rem;}

/* Name */
.sp-card-name{
    font-family:var(--font-display);
    font-weight:700;
    font-size:1rem;
    color:var(--charcoal);
    line-height:1.25;
}

/* Description */
.sp-card-desc{
    font-size:.78rem;
    color:var(--warm-grey);
    line-height:1.6;
    flex:1;
}

/* Meta pills row */
.sp-meta{display:flex;flex-wrap:wrap;gap:.45rem;margin-top:.1rem;}
.sp-meta-pill{
    display:inline-flex;align-items:center;gap:.32rem;
    padding:.22rem .65rem;
    border-radius:20px;
    font-size:.67rem;font-weight:500;letter-spacing:.04em;
    font-family:var(--font-body);
    white-space:nowrap;
}
.sp-meta-pill.price{background:var(--gold-light);color:var(--gold-dark);border:1px solid rgba(201,168,76,.25);}
.sp-meta-pill.guests{background:rgba(99,102,241,.08);color:#3730A3;border:1px solid rgba(99,102,241,.2);}
.sp-meta-pill.type{background:rgba(16,185,129,.08);color:#065F46;border:1px solid rgba(16,185,129,.2);}
.sp-meta-pill svg{width:11px;height:11px;flex-shrink:0;}

/* Divider */
.sp-divider{border:none;border-top:1px solid var(--border);margin:.1rem 0;}

/* Inclusions */
.sp-inc-label{
    font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
    color:var(--warm-grey);font-family:var(--font-body);margin-bottom:.3rem;
}
.sp-inc-list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.22rem;}
.sp-inc-list li{
    display:flex;align-items:flex-start;gap:.45rem;
    font-size:.75rem;color:var(--charcoal);line-height:1.45;
}
.sp-inc-list li::before{
    content:'';flex-shrink:0;
    width:5px;height:5px;border-radius:50%;
    background:var(--gold);margin-top:.38rem;
}
.sp-inc-more{font-size:.7rem;color:#C0B8B0;font-style:italic;margin-top:.25rem;}

/* Card footer */
.sp-card-foot{
    padding:.85rem 1.2rem;
    border-top:1px solid var(--border);
    display:flex;align-items:center;justify-content:space-between;gap:.5rem;
    background:var(--ivory);
}

/* Status badge */
.sp-status{
    display:inline-flex;align-items:center;gap:.3rem;
    padding:.22rem .68rem;border-radius:20px;
    font-size:.67rem;font-weight:600;letter-spacing:.04em;
    white-space:nowrap;font-family:var(--font-body);
}
.sp-status::before{content:'';width:5px;height:5px;border-radius:50%;flex-shrink:0;}
.sp-status.published{background:rgba(16,185,129,.1);color:#065F46;border:1px solid rgba(16,185,129,.22);}
.sp-status.published::before{background:#10B981;}
.sp-status.unpublished{background:rgba(239,68,68,.1);color:#991B1B;border:1px solid rgba(239,68,68,.22);}
.sp-status.unpublished::before{background:#EF4444;}

/* Toggle button */
.sp-toggle-btn{
    display:inline-flex;align-items:center;gap:.38rem;
    padding:.38rem .9rem;border-radius:6px;border:none;
    font-family:var(--font-body);font-size:.72rem;font-weight:500;
    cursor:pointer;transition:background .2s,box-shadow .2s,transform .15s;
    white-space:nowrap;
}
.sp-toggle-btn svg{width:11px;height:11px;}
.sp-toggle-btn.publish{background:var(--charcoal);color:var(--white);}
.sp-toggle-btn.publish:hover{background:var(--gold-dark);box-shadow:0 4px 12px rgba(201,168,76,.2);transform:translateY(-1px);}
.sp-toggle-btn.unpublish{background:transparent;color:#C0392B;border:1.5px solid #FADBD8;}
.sp-toggle-btn.unpublish:hover{background:#FFF5F5;border-color:#C0392B;}

/* ── EMPTY STATE ── */
.sp-empty{
    grid-column:1/-1;
    text-align:center;padding:4rem 1.5rem;
    background:var(--white);border:1.5px solid var(--border);border-radius:14px;
}
.sp-empty-icon{width:52px;height:52px;border-radius:50%;background:rgba(201,168,76,.08);display:flex;align-items:center;justify-content:center;margin:0 auto .9rem;color:var(--gold-dark);}
.sp-empty-icon svg{width:24px;height:24px;}
.sp-empty-title{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--charcoal);margin-bottom:.35rem;}
.sp-empty-desc{font-size:.8rem;color:var(--warm-grey);line-height:1.6;}

/* Alert */
.sp-alert-success{display:flex;align-items:center;gap:.65rem;background:#F0FDF4;border:1px solid #A7F3D0;border-radius:8px;padding:.75rem 1rem;font-size:.82rem;color:#065F46;margin-bottom:1.25rem;font-family:var(--font-body);}
.sp-alert-success svg{width:16px;height:16px;color:#10B981;flex-shrink:0;}
.sp-alert-error{display:flex;align-items:center;gap:.65rem;background:#FEF2F2;border:1px solid #FCA5A5;border-radius:8px;padding:.75rem 1rem;font-size:.82rem;color:#991B1B;margin-bottom:1.25rem;font-family:var(--font-body);}
.sp-alert-error svg{width:16px;height:16px;color:#EF4444;flex-shrink:0;}
</style>

<div class="p-6" style="max-width:1100px;margin:auto;">

    {{-- Alerts --}}
    @if(session('success'))
    <div class="sp-alert-success">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="sp-alert-error">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="10" cy="10" r="8"/><path d="M10 6v4M10 14v.5"/></svg>
        {{ session('error') }}
    </div>
    @endif

    {{-- ── TOP ROW ── --}}
    <div class="sp-top">
        <div>
            <h2 class="sp-title">My <em>Packages</em></h2>
            <p class="sp-subtitle">Manage and publish your event packages</p>
        </div>
    </div>

    {{-- ── GRID ── --}}
    <div class="sp-grid">

        @forelse($packages as $package)

        <div class="sp-card">
            <div class="sp-card-bar"></div>

            <div class="sp-card-body">

                {{-- Name --}}
                <div class="sp-card-name">{{ $package->name }}</div>

                {{-- Description --}}
                @if($package->description)
                <div class="sp-card-desc">{{ Str::limit($package->description, 90) }}</div>
                @endif

                {{-- Meta pills --}}
                <div class="sp-meta">
                    <span class="sp-meta-pill price">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="10" r="7"/><path d="M10 6v8M7.5 8.5h4a1.5 1.5 0 010 3h-3a1.5 1.5 0 000 3H13"/></svg>
                        ₱{{ number_format($package->price) }}
                    </span>
                    <span class="sp-meta-pill guests">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="7" cy="6" r="3"/><path d="M1 17c0-3 2.7-5 6-5"/><circle cx="13" cy="6" r="3"/><path d="M19 17c0-3-2.7-5-6-5s-6 2-6 5"/></svg>
                        {{ number_format($package->guest_capacity) }} guests
                    </span>
                    <span class="sp-meta-pill type">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="4" width="14" height="13" rx="2"/><path d="M3 8h14M8 4V2M12 4V2"/></svg>
                        {{ ucfirst($package->event_type) }}
                    </span>
                </div>

                {{-- Inclusions --}}
                @if($package->inclusions->count())
                <hr class="sp-divider">
                <div class="sp-inc-label">Inclusions</div>
                <ul class="sp-inc-list">
                    @foreach($package->inclusions->take(4) as $inc)
                        <li>{{ $inc->title }}</li>
                    @endforeach
                </ul>
                @if($package->inclusions->count() > 4)
                    <div class="sp-inc-more">+{{ $package->inclusions->count() - 4 }} more included</div>
                @endif
                @endif

            </div>

            {{-- Card footer: status + toggle --}}
            <div class="sp-card-foot">

                @if($package->is_listed)
                    <span class="sp-status published">Published</span>
                @else
                    <span class="sp-status unpublished">Unpublished</span>
                @endif

                <form method="POST" action="{{ route('supplier.package.toggle', $package->id) }}" style="margin:0;">
                    @csrf
                    @if($package->is_listed)
                        <button type="submit" class="sp-toggle-btn unpublish">
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                                <circle cx="7" cy="7" r="5.5"/><path d="M4.5 4.5l5 5M9.5 4.5l-5 5"/>
                            </svg>
                            Unpublish
                        </button>
                    @else
                        <button type="submit" class="sp-toggle-btn publish">
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                                <circle cx="7" cy="7" r="5.5"/><path d="M4.5 9.5l2 2 3-5"/>
                            </svg>
                            Publish
                        </button>
                    @endif
                </form>

            </div>
        </div>

        @empty

        <div class="sp-empty">
            <div class="sp-empty-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="3" width="14" height="14" rx="2"/><path d="M7 8h6M7 11h4"/>
                </svg>
            </div>
            <div class="sp-empty-title">No Packages Yet</div>
            <div class="sp-empty-desc">You haven't added any packages.<br>Create your first package to get started.</div>
        </div>

        @endforelse

    </div>

</div>

</x-supplier-layout>