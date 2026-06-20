<x-app-layout>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap');

:root {
    --gold:#C9A84C; --gold-dark:#8A6A1F; --gold-light:rgba(201,168,76,0.12);
    --ivory:#FAF7F2; --charcoal:#1E1B18; --warm-grey:#706B65;
    --border:#E5DDD5; --border-md:#E0D8D0; --white:#FFFFFF;
    --font-display:'Playfair Display',Georgia,serif;
    --font-body:'DM Sans',sans-serif;
    --radius:13px; --shadow:0 2px 16px rgba(30,27,24,.07);
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

/* ── PAGE ── */
.pk-page { max-width: 1150px; margin: 0 auto; padding: 1.75rem 1.5rem 4rem; }

/* ── TOP ROW ── */
.pk-top {
    display: flex; justify-content: space-between;
    align-items: flex-end; flex-wrap: wrap;
    gap: .75rem; margin-bottom: 1.5rem;
}
.pk-title { font-family: var(--font-display); font-size: clamp(1.35rem,2.5vw,1.75rem); font-weight: 700; color: var(--charcoal); line-height: 1.15; }
.pk-title em { font-style: italic; color: var(--gold-dark); }
.pk-subtitle { font-size: .76rem; color: var(--warm-grey); margin-top: .2rem; font-family: var(--font-body); }

/* ── STATS ── */
.pk-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: .85rem; margin-bottom: 1.5rem;
}
@media (max-width: 640px) { .pk-stats { grid-template-columns: repeat(2,1fr); } }

.pk-stat {
    background: var(--white); border: 1.5px solid var(--border);
    border-radius: var(--radius); padding: 1rem 1.1rem;
    position: relative; overflow: hidden;
}
.pk-stat::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; }
.pk-stat.s-all::before      { background: linear-gradient(90deg, var(--gold), #D4A090); }
.pk-stat.s-pub::before      { background: #10B981; }
.pk-stat.s-hid::before      { background: #EF4444; }
.pk-stat.s-types::before    { background: #6366F1; }
.pk-stat-val { font-family: var(--font-display); font-size: 1.6rem; font-weight: 700; line-height: 1; color: var(--charcoal); }
.pk-stat.s-all .pk-stat-val   { color: var(--gold-dark); }
.pk-stat.s-pub .pk-stat-val   { color: #065F46; }
.pk-stat.s-hid .pk-stat-val   { color: #991B1B; }
.pk-stat.s-types .pk-stat-val { color: #4338CA; }
.pk-stat-lbl { font-size: .62rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--warm-grey); margin-top: .28rem; font-family: var(--font-body); }

/* ── FILTER BAR ── */
.pk-filter-bar {
    display: flex; align-items: center;
    gap: .65rem; flex-wrap: wrap; margin-bottom: 1.4rem;
}
.pk-search-wrap {
    position: relative; flex: 1; min-width: 200px; max-width: 320px;
}
.pk-search-ico {
    position: absolute; left: .8rem; top: 50%; transform: translateY(-50%);
    width: 13px; height: 13px; color: #C0B8B0; pointer-events: none; transition: color .2s;
}
.pk-search-wrap:focus-within .pk-search-ico { color: var(--gold-dark); }
.pk-search-input {
    width: 100%; padding: .58rem .9rem .58rem 2.3rem;
    background: var(--white); border: 1.5px solid var(--border);
    border-radius: 8px; font-family: var(--font-body);
    font-size: .82rem; color: var(--charcoal); outline: none;
    transition: border-color .2s, box-shadow .2s;
}
.pk-search-input:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,.12); }
.pk-search-input::placeholder { color: #C0B8B0; }
.pk-search-clear {
    position: absolute; right: .7rem; top: 50%; transform: translateY(-50%);
    width: 16px; height: 16px; display: none; align-items: center; justify-content: center;
    cursor: pointer; color: #C0B8B0; border: none; background: transparent; padding: 0;
}
.pk-search-clear:hover { color: var(--charcoal); }
.pk-search-clear svg { width: 10px; height: 10px; }
.pk-search-clear.visible { display: flex; }

.pk-sel-wrap { position: relative; }
.pk-sel-wrap::after {
    content: ''; position: absolute; right: .75rem; top: 50%;
    transform: translateY(-50%); width: 0; height: 0;
    border-left: 4px solid transparent; border-right: 4px solid transparent;
    border-top: 5px solid #C0B8B0; pointer-events: none;
}
.pk-select {
    padding: .58rem 2.1rem .58rem .85rem;
    background: var(--white); border: 1.5px solid var(--border);
    border-radius: 8px; font-family: var(--font-body);
    font-size: .82rem; color: var(--charcoal);
    outline: none; appearance: none; cursor: pointer;
    transition: border-color .2s;
}
.pk-select:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,.12); }

.pk-count-badge {
    font-size: .72rem; color: var(--warm-grey);
    font-family: var(--font-body); white-space: nowrap; margin-left: auto;
}
.pk-count-badge span { font-weight: 600; color: var(--gold-dark); }

/* ════════════════════════════
   PACKAGE CARDS GRID
════════════════════════════ */
.pk-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(295px, 1fr));
    gap: 1.1rem;
}
@media (max-width: 680px) { .pk-grid { grid-template-columns: 1fr; } }

/* ── SINGLE CARD ── */
.pk-card {
    background: var(--white);
    border: 1.5px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    display: flex; flex-direction: column;
    transition: box-shadow .22s, transform .22s, border-color .22s;
    animation: pkFade .32s ease both;
}
.pk-card:hover {
    box-shadow: 0 6px 28px rgba(30,27,24,.11);
    transform: translateY(-2px);
    border-color: rgba(201,168,76,.42);
}
.pk-card[data-hidden="true"] { display: none; }

@keyframes pkFade {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Status accent bar */
.pk-accent { height: 3px; flex-shrink: 0; }
.pk-accent.published { background: linear-gradient(90deg, var(--gold), #D4A090); }
.pk-accent.hidden    { background: linear-gradient(90deg, #EF4444, #F87171); }

/* Card head */
.pk-card-head {
    padding: 1rem 1.2rem .8rem;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: flex-start;
    justify-content: space-between; gap: .65rem;
}
.pk-card-name {
    font-family: var(--font-display);
    font-size: .96rem; font-weight: 700;
    color: var(--charcoal); line-height: 1.25; flex: 1;
}
.pk-card-supplier {
    font-size: .68rem; color: var(--warm-grey);
    margin-top: 3px; display: flex; align-items: center; gap: .22rem;
}
.pk-card-supplier svg { width: 10px; height: 10px; color: var(--gold-dark); flex-shrink: 0; }

/* Status badge */
.pk-status {
    display: inline-flex; align-items: center; gap: .28rem;
    font-size: .6rem; font-weight: 700; letter-spacing: .06em;
    text-transform: uppercase; padding: 3px 9px; border-radius: 999px;
    white-space: nowrap; flex-shrink: 0;
}
.pk-status::before { content: ''; width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }
.pk-status.published { background: rgba(16,185,129,.1); color: #065F46; border: 1px solid rgba(16,185,129,.25); }
.pk-status.published::before { background: #10B981; }
.pk-status.hidden    { background: rgba(239,68,68,.1);  color: #991B1B; border: 1px solid rgba(239,68,68,.25); }
.pk-status.hidden::before    { background: #EF4444; }

/* Card body */
.pk-card-body { padding: .9rem 1.2rem; flex: 1; display: flex; flex-direction: column; gap: .6rem; }

/* Price block */
.pk-price-block {
    display: flex; align-items: center; justify-content: space-between;
    background: rgba(201,168,76,.05); border: 1px solid rgba(201,168,76,.18);
    border-radius: 8px; padding: .6rem .9rem;
}
.pk-price-lbl { font-size: .58rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--warm-grey); }
.pk-price-val { font-family: var(--font-display); font-size: 1.05rem; font-weight: 700; color: var(--gold-dark); }

/* Type + meta chips */
.pk-chips { display: flex; flex-wrap: wrap; gap: .4rem; }
.pk-chip {
    display: inline-flex; align-items: center; gap: .25rem;
    font-size: .62rem; color: var(--warm-grey);
    background: var(--ivory); border: 1px solid var(--border);
    padding: 2px 8px; border-radius: 3px; font-family: var(--font-body);
}
.pk-chip svg { width: 10px; height: 10px; color: var(--gold-dark); }
.pk-type-chip {
    display: inline-flex; align-items: center; gap: .25rem;
    font-size: .62rem; font-weight: 700; letter-spacing: .04em;
    text-transform: uppercase; padding: 3px 9px; border-radius: 999px;
    background: var(--gold-light); color: var(--gold-dark);
    border: 1px solid rgba(201,168,76,.25);
}

/* Card footer */
.pk-card-foot {
    padding: .75rem 1.2rem;
    border-top: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between; gap: .5rem;
}
.pk-inc-label { font-size: .65rem; color: var(--warm-grey); display: flex; align-items: center; gap: .25rem; }
.pk-inc-label svg { width: 11px; height: 11px; color: var(--gold-dark); }

.pk-inc-btn {
    display: inline-flex; align-items: center; gap: .38rem;
    padding: .42rem 1rem; border-radius: 7px;
    border: 1.5px solid var(--border-md); background: var(--white);
    font-family: var(--font-body); font-size: .74rem;
    font-weight: 500; color: var(--warm-grey); cursor: pointer;
    transition: border-color .18s, color .18s, background .18s, transform .15s;
    white-space: nowrap; flex-shrink: 0;
}
.pk-inc-btn svg { width: 11px; height: 11px; flex-shrink: 0; }
.pk-inc-btn:hover { border-color: var(--gold); color: var(--gold-dark); background: var(--gold-light); transform: translateY(-1px); }

/* ── EMPTY / NO RESULTS ── */
.pk-empty {
    grid-column: 1 / -1; text-align: center;
    padding: 4.5rem 2rem;
    background: var(--white); border: 1.5px solid var(--border); border-radius: var(--radius);
}
.pk-empty-icon {
    width: 52px; height: 52px; border-radius: 50%;
    background: rgba(201,168,76,.08);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto .9rem; color: var(--gold-dark);
}
.pk-empty-icon svg { width: 24px; height: 24px; }
.pk-empty-title { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--charcoal); margin-bottom: .35rem; }
.pk-empty-desc  { font-size: .8rem; color: var(--warm-grey); line-height: 1.6; }

/* Highlight */
mark.pk-hl { background: rgba(201,168,76,.22); color: var(--gold-dark); border-radius: 2px; padding: 0 1px; }

/* Pagination */
.pk-pagination { margin-top: 1.5rem; display: flex; justify-content: flex-end; }

/* ════════════════════════════
   INCLUSIONS MODAL
════════════════════════════ */
.mo-overlay {
    position: fixed; inset: 0; z-index: 8000;
    background: rgba(30,27,24,.55);
    display: none; align-items: center; justify-content: center;
    padding: 1rem; backdrop-filter: blur(3px); overflow-y: auto;
}
.mo-overlay.open { display: flex; }

.mo-box {
    background: var(--white); border-radius: 14px; border: 1px solid var(--border);
    box-shadow: 0 8px 40px rgba(30,27,24,.18);
    width: 100%; max-width: 480px;
    animation: moSlide .22s ease;
    margin: auto; flex-shrink: 0;
    display: flex; flex-direction: column;
    max-height: calc(100vh - 2rem); overflow: hidden;
}
@keyframes moSlide { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }

.mo-head { display: flex; align-items: center; justify-content: space-between; padding: 1.1rem 1.4rem; border-bottom: 1px solid var(--border); flex-shrink: 0; }
.mo-head-l { display: flex; align-items: center; gap: .65rem; }
.mo-icon { width: 32px; height: 32px; border-radius: 8px; background: rgba(201,168,76,.1); display: flex; align-items: center; justify-content: center; color: var(--gold-dark); flex-shrink: 0; }
.mo-icon svg { width: 15px; height: 15px; }
.mo-title { font-family: var(--font-display); font-size: .95rem; font-weight: 700; color: var(--charcoal); }
.mo-close { width: 30px; height: 30px; border-radius: 50%; border: 1.5px solid var(--border); background: var(--white); display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--warm-grey); transition: border-color .15s, color .15s; }
.mo-close:hover { border-color: var(--gold); color: var(--gold-dark); }
.mo-close svg { width: 12px; height: 12px; }

.mo-meta { display: flex; align-items: center; flex-wrap: wrap; gap: .5rem; padding: .8rem 1.4rem; background: var(--ivory); border-bottom: 1px solid var(--border); flex-shrink: 0; }
.mo-meta-pill { display: inline-flex; align-items: center; gap: .3rem; padding: .2rem .6rem; border-radius: 20px; font-size: .67rem; font-weight: 500; letter-spacing: .04em; font-family: var(--font-body); white-space: nowrap; }
.mo-meta-pill.price { background: var(--gold-light); color: var(--gold-dark); border: 1px solid rgba(201,168,76,.25); }
.mo-meta-pill.type  { background: rgba(16,185,129,.08); color: #065F46; border: 1px solid rgba(16,185,129,.2); }
.mo-meta-pill.status-pub { background: rgba(16,185,129,.1); color: #065F46; border: 1px solid rgba(16,185,129,.22); }
.mo-meta-pill.status-hid { background: rgba(239,68,68,.1);  color: #991B1B; border: 1px solid rgba(239,68,68,.22); }
.mo-meta-pill svg { width: 10px; height: 10px; flex-shrink: 0; }
.mo-meta-dot { width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }

.mo-body { padding: 1.2rem 1.4rem; overflow-y: auto; flex: 1; min-height: 0; }
.mo-body::-webkit-scrollbar { width: 4px; }
.mo-body::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }
.mo-body::-webkit-scrollbar-thumb:hover { background: var(--gold); }

.mo-supplier-row { display: flex; align-items: center; gap: .6rem; padding: .65rem .9rem; background: var(--ivory); border: 1px solid var(--border); border-radius: 8px; margin-bottom: 1.1rem; font-family: var(--font-body); }
.mo-supplier-row svg { width: 14px; height: 14px; color: var(--gold-dark); flex-shrink: 0; }
.mo-supplier-label { font-size: .62rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--warm-grey); }
.mo-supplier-name  { font-size: .82rem; font-weight: 500; color: var(--charcoal); }

.mo-inc-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: .7rem; }
.mo-inc-label { font-size: .62rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--warm-grey); font-family: var(--font-body); }
.mo-inc-count { font-size: .7rem; color: var(--gold-dark); font-weight: 500; font-family: var(--font-body); }

.mo-inc-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: .55rem; }
.mo-inc-item { display: flex; align-items: flex-start; gap: .75rem; padding: .7rem .9rem; background: var(--ivory); border: 1px solid var(--border); border-radius: 8px; transition: border-color .15s, background .15s; }
.mo-inc-item:hover { border-color: rgba(201,168,76,.35); background: rgba(201,168,76,.04); }
.mo-inc-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--gold); flex-shrink: 0; margin-top: .38rem; }
.mo-inc-text { font-size: .82rem; color: var(--charcoal); line-height: 1.5; font-family: var(--font-body); }

.mo-inc-empty { text-align: center; padding: 2rem 1rem; background: var(--ivory); border: 1.5px dashed var(--border); border-radius: 10px; }
.mo-inc-empty svg { width: 22px; height: 22px; color: #C0B8B0; margin-bottom: .5rem; }
.mo-inc-empty p { font-size: .78rem; color: var(--warm-grey); font-family: var(--font-body); }

.mo-foot { padding: .85rem 1.4rem; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: flex-end; flex-shrink: 0; background: var(--white); }
.mo-btn-close { display: inline-flex; align-items: center; gap: .4rem; padding: .62rem 1.3rem; border-radius: 6px; border: 1.5px solid var(--border); background: var(--white); font-family: var(--font-body); font-size: .82rem; font-weight: 500; color: var(--warm-grey); cursor: pointer; transition: border-color .2s, color .2s; }
.mo-btn-close:hover { border-color: var(--gold); color: var(--charcoal); }

/* ── RESPONSIVE ── */
@media (max-width: 640px) {
    .pk-filter-bar { gap: .5rem; }
    .pk-search-wrap { max-width: 100%; min-width: 0; width: 100%; }
    .pk-select { width: 100%; }
    .pk-top { flex-direction: column; align-items: flex-start; }
    .pk-count-badge { margin-left: 0; }
}
</style>

<div class="pk-page">

    {{-- ── TOP ROW ── --}}
    <div class="pk-top">
        <div>
            <h2 class="pk-title">Package <em>Management</em></h2>
            <p class="pk-subtitle">Browse and manage all supplier packages.</p>
        </div>
    </div>

    {{-- ── STATS ── --}}
    @php
        $totalAll  = $packages->total();
        $pubCount  = $packages->where('is_listed', true)->count();
        $hidCount  = $packages->where('is_listed', false)->count();
        $typeCount = $packages->pluck('event_type')->unique()->filter()->count();
    @endphp
    <div class="pk-stats">
        <div class="pk-stat s-all">
            <div class="pk-stat-val">{{ $totalAll }}</div>
            <div class="pk-stat-lbl">Total Packages</div>
        </div>
        <div class="pk-stat s-pub">
            <div class="pk-stat-val">{{ $pubCount }}</div>
            <div class="pk-stat-lbl">Published</div>
        </div>
        <div class="pk-stat s-hid">
            <div class="pk-stat-val">{{ $hidCount }}</div>
            <div class="pk-stat-lbl">Hidden</div>
        </div>
        <div class="pk-stat s-types">
            <div class="pk-stat-val">{{ $typeCount }}</div>
            <div class="pk-stat-lbl">Event Types</div>
        </div>
    </div>

    {{-- ── FILTER BAR ── --}}
    <div class="pk-filter-bar">

        <div class="pk-search-wrap">
            <svg class="pk-search-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                <circle cx="8.5" cy="8.5" r="5.5"/><path d="M15 15l-3-3"/>
            </svg>
            <input id="pkSearch" type="text" class="pk-search-input"
                   placeholder="Search package or supplier…"
                   autocomplete="off" value="{{ request('search') }}">
            <button type="button" class="pk-search-clear" id="pkSearchClear" title="Clear">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2">
                    <path d="M1 1l10 10M11 1L1 11"/>
                </svg>
            </button>
        </div>

        <div class="pk-sel-wrap">
            <select id="pkStatus" class="pk-select">
                <option value="">All Statuses</option>
                <option value="published">Published</option>
                <option value="hidden">Hidden</option>
            </select>
        </div>

        <div class="pk-sel-wrap">
            <select id="pkType" class="pk-select">
                <option value="">All Types</option>
                @foreach($packages->pluck('event_type')->unique()->filter()->sort()->values() as $type)
                    <option value="{{ strtolower($type) }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <div class="pk-count-badge">
            Showing <span id="pkCountNum">{{ $packages->count() }}</span> of {{ $packages->total() }} packages
        </div>

    </div>

    {{-- ── CARDS GRID ── --}}
    @if($packages->count())

    <div class="pk-grid" id="pkGrid">

        @foreach($packages as $idx => $package)
        @php
            $statusKey = $package->is_listed ? 'published' : 'hidden';
            $inclusions = $package->inclusions ?? collect();
        @endphp

        <div class="pk-card"
             data-name="{{ strtolower($package->name) }}"
             data-supplier="{{ strtolower($package->supplier->business_name ?? '') }}"
             data-status="{{ $statusKey }}"
             data-type="{{ strtolower($package->event_type) }}"
             style="animation-delay: {{ $idx * 0.04 }}s;">

            {{-- Status accent --}}
            <div class="pk-accent {{ $statusKey }}"></div>

            {{-- Head --}}
            <div class="pk-card-head">
                <div>
                    <div class="pk-card-name" data-field="name">{{ $package->name }}</div>
                    @if($package->supplier->business_name ?? null)
                    <div class="pk-card-supplier">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M2 6l5-5 5 5v6a1 1 0 01-1 1H3a1 1 0 01-1-1V6z"/>
                            <rect x="4" y="8" width="3" height="5" rx=".5"/>
                            <rect x="8" y="8" width="2" height="3" rx=".5"/>
                        </svg>
                        <span data-field="supplier">{{ $package->supplier->business_name }}</span>
                    </div>
                    @endif
                </div>
                <span class="pk-status {{ $statusKey }}">
                    {{ ucfirst($statusKey) }}
                </span>
            </div>

            {{-- Body --}}
            <div class="pk-card-body">

                {{-- Price --}}
                @if($package->price)
                <div class="pk-price-block">
                    <span class="pk-price-lbl">Price</span>
                    <span class="pk-price-val">₱{{ number_format($package->price) }}</span>
                </div>
                @endif

                {{-- Type + meta chips --}}
                <div class="pk-chips">
                    @if($package->event_type)
                    <span class="pk-type-chip">{{ $package->event_type }}</span>
                    @endif
                    @if($package->guest_capacity ?? null)
                    <span class="pk-chip">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="5" cy="4" r="2"/>
                            <path d="M1 12c0-2.2 1.8-3.5 4-3.5s4 1.3 4 3.5"/>
                            <circle cx="11" cy="4" r="1.5"/>
                            <path d="M13 11.5c0-1.5-1-2.5-2.5-2.5"/>
                        </svg>
                        {{ number_format($package->guest_capacity) }} guests
                    </span>
                    @endif
                    @if($package->duration_hours ?? null)
                    <span class="pk-chip">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="7" cy="7" r="5.5"/>
                            <path d="M7 4.5V7l2 1.5"/>
                        </svg>
                        {{ $package->duration_hours }}h
                    </span>
                    @endif
                </div>

            </div>

            {{-- Footer: inclusions btn --}}
            <div class="pk-card-foot">
                <span class="pk-inc-label">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M2 4h10M2 7h10M2 10h7"/>
                    </svg>
                    {{ $inclusions->count() }} {{ Str::plural('inclusion', $inclusions->count()) }}
                </span>
                <button type="button" class="pk-inc-btn"
                    onclick="openIncModal(this)"
                    data-pkg-name="{{ $package->name }}"
                    data-pkg-price="₱{{ number_format($package->price ?? 0) }}"
                    data-pkg-type="{{ $package->event_type }}"
                    data-pkg-status="{{ $statusKey }}"
                    data-pkg-supplier="{{ $package->supplier->business_name ?? 'N/A' }}"
                    data-pkg-count="{{ $inclusions->count() }}"
                    data-pkg-inclusions="{{ $inclusions->pluck('title')->toJson() }}">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="7" cy="7" r="5.5"/>
                        <circle cx="7" cy="7" r="2"/>
                    </svg>
                    View
                </button>
            </div>

        </div>{{-- /pk-card --}}
        @endforeach

        {{-- No-results empty (JS shows this) --}}
        <div id="pkNoResults" class="pk-empty" style="display:none;">
            <div class="pk-empty-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="8.5" cy="8.5" r="5.5"/><path d="M15 15l-3-3"/>
                </svg>
            </div>
            <div class="pk-empty-title">No packages match your search</div>
            <p class="pk-empty-desc">Try a different name or clear the filters.</p>
        </div>

    </div>{{-- /pk-grid --}}

    {{-- Pagination --}}
    <div class="pk-pagination">
        {{ $packages->appends(request()->query())->links() }}
    </div>

    @else

    <div class="pk-grid">
        <div class="pk-empty">
            <div class="pk-empty-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="3" width="14" height="14" rx="2"/><path d="M7 8h6M7 11h4"/>
                </svg>
            </div>
            <div class="pk-empty-title">No Packages Found</div>
            <p class="pk-empty-desc">There are no packages matching your current filters.</p>
        </div>
    </div>

    @endif

</div>{{-- /pk-page --}}


{{-- ════════════════════════════
     INCLUSIONS MODAL
════════════════════════════ --}}
<div class="mo-overlay" id="incOverlay" onclick="if(event.target===this)closeIncModal()">
    <div class="mo-box">

        <div class="mo-head">
            <div class="mo-head-l">
                <div class="mo-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="3" y="3" width="14" height="14" rx="2"/><path d="M7 8h6M7 11h4"/>
                    </svg>
                </div>
                <div class="mo-title" id="moTitle">Package Inclusions</div>
            </div>
            <button type="button" class="mo-close" onclick="closeIncModal()">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2">
                    <path d="M1 1l10 10M11 1L1 11"/>
                </svg>
            </button>
        </div>

        <div class="mo-meta" id="moMeta"></div>

        <div class="mo-body">
            <div class="mo-supplier-row">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M3 9l7-7 7 7v9a1 1 0 01-1 1H4a1 1 0 01-1-1z"/>
                    <rect x="7" y="13" width="6" height="6" rx="1"/>
                </svg>
                <div>
                    <div class="mo-supplier-label">Supplier</div>
                    <div class="mo-supplier-name" id="moSupplierName"></div>
                </div>
            </div>
            <div class="mo-inc-header">
                <div class="mo-inc-label">Inclusions</div>
                <div class="mo-inc-count" id="moIncCount"></div>
            </div>
            <ul class="mo-inc-list" id="moIncList"></ul>
        </div>

        <div class="mo-foot">
            <button type="button" class="mo-btn-close" onclick="closeIncModal()">Close</button>
        </div>

    </div>
</div>

<script>
/* ── MODAL ── */
function openIncModal(btn) {
    var name       = btn.dataset.pkgName;
    var price      = btn.dataset.pkgPrice;
    var type       = btn.dataset.pkgType;
    var status     = btn.dataset.pkgStatus;
    var supplier   = btn.dataset.pkgSupplier;
    var count      = parseInt(btn.dataset.pkgCount, 10);
    var inclusions = JSON.parse(btn.dataset.pkgInclusions || '[]');

    document.getElementById('moTitle').textContent = name;

    var sClass = status === 'published' ? 'status-pub' : 'status-hid';
    var sDot   = status === 'published' ? '#10B981' : '#EF4444';
    var sLabel = status === 'published' ? 'Published' : 'Hidden';

    document.getElementById('moMeta').innerHTML =
        '<span class="mo-meta-pill price">' +
            '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="10" r="7"/><path d="M10 6v8M7.5 8.5h4a1.5 1.5 0 010 3h-3a1.5 1.5 0 000 3H13"/></svg>' +
            price + '</span>' +
        '<span class="mo-meta-pill type">' +
            '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="4" width="14" height="13" rx="2"/><path d="M3 8h14M8 4V2M12 4V2"/></svg>' +
            (type || '—') + '</span>' +
        '<span class="mo-meta-pill ' + sClass + '">' +
            '<span class="mo-meta-dot" style="background:' + sDot + '"></span>' +
            sLabel + '</span>';

    document.getElementById('moSupplierName').textContent = supplier;
    document.getElementById('moIncCount').textContent = count + (count === 1 ? ' inclusion' : ' inclusions');

    var list = document.getElementById('moIncList');
    list.innerHTML = '';

    if (inclusions.length === 0) {
        list.innerHTML = '<li><div class="mo-inc-empty">' +
            '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="14" height="14" rx="2"/><path d="M7 8h6M7 11h4"/></svg>' +
            '<p>No inclusions added for this package.</p></div></li>';
    } else {
        inclusions.forEach(function(title) {
            var li = document.createElement('li');
            li.className = 'mo-inc-item';
            li.innerHTML = '<div class="mo-inc-dot"></div><div class="mo-inc-text">' + escHtml(title) + '</div>';
            list.appendChild(li);
        });
    }

    document.getElementById('incOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeIncModal() {
    document.getElementById('incOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

function escHtml(str) {
    return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeIncModal(); });

/* ── LIVE FILTER ── */
(function () {
    var searchInput  = document.getElementById('pkSearch');
    var clearBtn     = document.getElementById('pkSearchClear');
    var statusSelect = document.getElementById('pkStatus');
    var typeSelect   = document.getElementById('pkType');
    var grid         = document.getElementById('pkGrid');
    var noResults    = document.getElementById('pkNoResults');
    var countNum     = document.getElementById('pkCountNum');

    if (!grid) return;

    var cards = Array.from(grid.querySelectorAll('.pk-card[data-name]'));

    /* Store originals for highlight */
    cards.forEach(function(card) {
        card.querySelectorAll('[data-field]').forEach(function(el) {
            el.dataset.original = el.textContent.trim();
        });
    });

    function highlight(el, term) {
        var orig = el.dataset.original;
        if (!term) { el.textContent = orig; return; }
        var esc = term.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        el.innerHTML = orig.replace(new RegExp('(' + esc + ')', 'gi'), '<mark class="pk-hl">$1</mark>');
    }

    function applyFilters() {
        var term   = searchInput.value.trim().toLowerCase();
        var status = statusSelect.value;
        var type   = typeSelect.value.toLowerCase();
        var visible = 0;

        cards.forEach(function(card) {
            var matchQ  = !term   || card.dataset.name.includes(term) || card.dataset.supplier.includes(term);
            var matchSt = !status || card.dataset.status === status;
            var matchTy = !type   || card.dataset.type   === type;
            var show    = matchQ && matchSt && matchTy;

            card.style.display = show ? '' : 'none';
            if (show) {
                visible++;
                card.querySelectorAll('[data-field]').forEach(function(el) { highlight(el, term); });
            }
        });

        if (noResults) noResults.style.display = (visible === 0 && cards.length > 0) ? 'block' : 'none';
        if (countNum)  countNum.textContent = visible;
        clearBtn.classList.toggle('visible', searchInput.value.length > 0);
    }

    var _t;
    searchInput.addEventListener('input', function() { clearTimeout(_t); _t = setTimeout(applyFilters, 180); });
    clearBtn.addEventListener('click', function() { searchInput.value = ''; applyFilters(); searchInput.focus(); });
    statusSelect.addEventListener('change', applyFilters);
    typeSelect.addEventListener('change', applyFilters);
    applyFilters();
})();
</script>

</x-app-layout>