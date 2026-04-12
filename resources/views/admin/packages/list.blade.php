<x-app-layout>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap');
:root {
    --gold:#C9A84C;--gold-dark:#8A6A1F;--gold-light:rgba(201,168,76,0.12);
    --ivory:#FAF7F2;--charcoal:#1E1B18;--warm-grey:#706B65;
    --border:#E5DDD5;--font-display:'Playfair Display',Georgia,serif;
    --font-body:'DM Sans',sans-serif;
}
.pkg-top { display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:.75rem; margin-bottom:1.4rem; }
.pkg-title { font-family:var(--font-display); font-size:1.65rem; font-weight:700; color:var(--charcoal); line-height:1.15; }
.pkg-title em { font-style:italic; color:var(--gold-dark); }
.pkg-subtitle { font-size:.76rem; color:var(--warm-grey); margin-top:.2rem; font-family:var(--font-body); }
.pkg-badge { font-size:.65rem; font-weight:500; letter-spacing:.07em; text-transform:uppercase; color:var(--gold-dark); background:var(--gold-light); border:1px solid rgba(201,168,76,.3); padding:.28rem .75rem; border-radius:20px; white-space:nowrap; font-family:var(--font-body); }
.pkg-card { background:#fff; border:1.5px solid var(--border); border-radius:14px; overflow:hidden; }

/* ── Scroll hint — mobile only ── */
.scroll-hint { display:none; align-items:center; gap:.4rem; font-size:.68rem; color:var(--warm-grey); padding:.55rem 1rem .1rem; font-family:var(--font-body); }
.scroll-hint svg { width:13px; height:13px; flex-shrink:0; }
@media(max-width:640px) { .scroll-hint { display:flex; } }

/* ── Scrollable wrapper ── */
.tbl-wrap {
    overflow-x:auto;
    -webkit-overflow-scrolling:touch;
    scrollbar-width:thin;
    scrollbar-color:rgba(201,168,76,.4) transparent;
}
.tbl-wrap::-webkit-scrollbar { height:4px; }
.tbl-wrap::-webkit-scrollbar-track { background:transparent; }
.tbl-wrap::-webkit-scrollbar-thumb { background:rgba(201,168,76,.45); border-radius:4px; }

/* ── Table ── */
.pkg-table { width:100%; min-width:600px; border-collapse:collapse; font-family:var(--font-body); }
.pkg-table thead { background:var(--ivory); border-bottom:1.5px solid var(--border); }
.pkg-table thead th { padding:.8rem 1.1rem; font-size:.6rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--warm-grey); text-align:left; white-space:nowrap; }
.pkg-table thead th:first-child { border-left:3px solid var(--gold); }
.pkg-table tbody tr { border-bottom:1px solid #F0EBE5; transition:background .15s; }
.pkg-table tbody tr:last-child { border-bottom:none; }
.pkg-table tbody tr:hover { background:rgba(201,168,76,.04); }
.pkg-table td { padding:.9rem 1.1rem; font-size:.83rem; color:var(--charcoal); vertical-align:middle; }
.pkg-table tbody td:first-child { border-left:3px solid transparent; }
.pkg-table tbody tr:hover td:first-child { border-left-color:rgba(201,168,76,.45); }

/* ── Cell types ── */
.td-name { font-family:var(--font-display); font-weight:700; font-size:.9rem; color:var(--charcoal); white-space:nowrap; }
.td-desc { color:var(--warm-grey); font-size:.78rem; line-height:1.45; min-width:140px; max-width:200px; }
.td-price { font-weight:700; font-size:.9rem; color:var(--gold-dark); white-space:nowrap; }
.td-price small { font-size:.66rem; color:var(--warm-grey); font-weight:400; margin-left:2px; }
.td-cap { display:inline-flex; align-items:center; gap:.38rem; white-space:nowrap; }
.td-cap svg { flex-shrink:0; }
.td-event { display:inline-flex; align-items:center; padding:.25rem .65rem; border-radius:20px; font-size:.68rem; font-weight:500; letter-spacing:.04em; background:var(--gold-light); color:var(--gold-dark); border:1px solid rgba(201,168,76,.25); white-space:nowrap; }
.empty-state { text-align:center; padding:3rem 1rem; color:var(--warm-grey); font-size:.83rem; }
</style>

<div class="p-6">

    <div class="pkg-top">
        <div>
            <h2 class="pkg-title">Our <em>Packages</em></h2>
            <p class="pkg-subtitle">Browse available event packages from our suppliers</p>
        </div>
        @if(isset($packages))
        <span class="pkg-badge">{{ $packages->count() }} packages</span>
         @endif
    </div>

    <div class="pkg-card">

        {{-- Mobile scroll hint --}}
        <div class="scroll-hint">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6">
                <path d="M4 10h12M10 4l6 6-6 6"/>
            </svg>
            Scroll sideways to see more
        </div>

        <div class="tbl-wrap">
            <table class="pkg-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Guests</th>
                        <th>Event Type</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($packages as $package)
                    <tr>
                        <td><div class="td-name">{{ $package->name }}</div></td>
                        <td><div class="td-desc">{{ Str::limit($package->description, 50) }}</div></td>
                        <td>
                            <div class="td-price">
                                ₱{{ number_format($package->price, 2) }}
                                <small>starting</small>
                            </div>
                        </td>
                        <td>
                            <div class="td-cap">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="#706B65" stroke-width="1.6">
                                    <circle cx="7" cy="6" r="3"/>
                                    <path d="M1 17c0-3 2.7-5 6-5"/>
                                    <circle cx="13" cy="6" r="3"/>
                                    <path d="M19 17c0-3-2.7-5-6-5s-6 2-6 5"/>
                                </svg>
                                {{ $package->guest_capacity }}
                            </div>
                        </td>
                        <td><span class="td-event">{{ $package->event_type }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-state">No packages found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{--@if($packages->hasPages())
    <div class="mt-4">{{ $packages->links() }}</div>
    @endif--}}

</div>
</x-app-layout>