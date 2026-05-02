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
    --shadow-modal:0 8px 40px rgba(30,27,24,.18);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

/* ── PAGE WRAPPER ── */
.pp-page { max-width: 1100px; margin: auto; padding: 1.5rem 1.25rem 3rem; }

/* ── TOP ROW ── */
.pp-top { display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: .75rem; margin-bottom: 1.75rem; }
.pp-title { font-family: var(--font-display); font-size: 1.65rem; font-weight: 700; color: var(--charcoal); line-height: 1.15; }
.pp-title em { font-style: italic; color: var(--gold-dark); }
.pp-subtitle { font-size: .76rem; color: var(--warm-grey); margin-top: .2rem; font-family: var(--font-body); }

/* ── TOOLBAR ── */
.pp-toolbar { display: flex; align-items: center; gap: .65rem; flex-wrap: wrap; margin-bottom: 1.4rem; }
.pp-search-wrap { position: relative; flex: 1; min-width: 180px; max-width: 340px; }
.pp-search-ico { position: absolute; left: .82rem; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: #C0B8B0; pointer-events: none; }
.pp-search-inp { width: 100%; padding: .6rem .9rem .6rem 2.35rem; background: var(--white); border: 1.5px solid var(--border); border-radius: var(--radius-btn); font-family: var(--font-body); font-size: .82rem; color: var(--charcoal); outline: none; transition: border-color .2s, box-shadow .2s; }
.pp-search-inp:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,.12); }
.pp-search-inp::placeholder { color: #C0B8B0; }
.pp-search-wrap:focus-within .pp-search-ico { color: var(--gold-dark); }

.pp-cat-wrap { position: relative; }
.pp-cat-sel { appearance: none; padding: .6rem 2.1rem .6rem .9rem; background: var(--white); border: 1.5px solid var(--border); border-radius: var(--radius-btn); font-family: var(--font-body); font-size: .82rem; color: var(--charcoal); outline: none; cursor: pointer; transition: border-color .2s; min-width: 150px; }
.pp-cat-sel:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,.12); }
.pp-cat-wrap::after { content: ''; position: absolute; right: .82rem; top: 50%; transform: translateY(-50%); width: 0; height: 0; border-left: 4px solid transparent; border-right: 4px solid transparent; border-top: 5px solid #C0B8B0; pointer-events: none; }

.pp-count { font-size: .72rem; color: var(--warm-grey); font-family: var(--font-body); white-space: nowrap; margin-left: auto; }

/* ── ADD BUTTON ── */
.pp-btn-add { display: inline-flex; align-items: center; gap: .45rem; padding: .6rem 1.3rem; border-radius: var(--radius-btn); border: none; background: var(--charcoal); font-family: var(--font-body); font-size: .8rem; font-weight: 500; color: var(--white); cursor: pointer; text-decoration: none; transition: background .2s, box-shadow .2s, transform .15s; white-space: nowrap; }
.pp-btn-add svg { width: 13px; height: 13px; flex-shrink: 0; }
.pp-btn-add:hover { background: var(--gold-dark); box-shadow: 0 4px 12px rgba(201,168,76,.2); transform: translateY(-1px); }

/* ── GRID ── */
.pp-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(290px, 1fr)); gap: 1.1rem; }

/* ── PACKAGE CARD ── */
.pp-card { background: var(--white); border: 1.5px solid var(--border); border-radius: var(--radius-card); overflow: hidden; box-shadow: var(--shadow-card); transition: box-shadow .2s, transform .2s, border-color .2s; display: flex; flex-direction: column; }
.pp-card:hover { box-shadow: 0 6px 28px rgba(30,27,24,.12); transform: translateY(-2px); border-color: rgba(201,168,76,.4); }

.pp-card-head { padding: 1.1rem 1.2rem .75rem; border-bottom: 1px solid #F0EBE5; position: relative; }
.pp-card-accent { position: absolute; left: 0; top: 0; bottom: 0; width: 3px; background: var(--gold); border-radius: 3px 0 0 3px; }
.pp-card-name { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--charcoal); line-height: 1.2; padding-right: 1.5rem; }
.pp-card-type { display: inline-flex; align-items: center; margin-top: .4rem; padding: .18rem .58rem; border-radius: var(--radius-badge); font-size: .65rem; font-weight: 500; letter-spacing: .04em; background: var(--gold-light); color: var(--gold-dark); border: 1px solid rgba(201,168,76,.25); }

.pp-card-body { padding: .85rem 1.2rem; flex: 1; }
.pp-card-meta { display: flex; flex-wrap: wrap; gap: .5rem .9rem; margin-bottom: .75rem; }
.pp-card-meta-item { display: flex; align-items: center; gap: .32rem; font-size: .72rem; color: var(--warm-grey); }
.pp-card-meta-item svg { width: 12px; height: 12px; flex-shrink: 0; color: var(--gold-dark); }

.pp-inc-label { font-size: .6rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--warm-grey); margin-bottom: .42rem; }
.pp-inc-list { list-style: none; display: flex; flex-direction: column; gap: .3rem; }
.pp-inc-list li { display: flex; align-items: flex-start; gap: .45rem; font-size: .76rem; color: var(--charcoal); line-height: 1.4; }
.pp-inc-list li::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: var(--gold); flex-shrink: 0; margin-top: .45rem; }
.pp-inc-more { font-size: .68rem; color: var(--gold-dark); margin-top: .35rem; font-style: italic; }

/* ── CARD FOOTER (actions) ── */
.pp-card-foot { display: flex; align-items: center; justify-content: flex-end; gap: .45rem; padding: .7rem 1.2rem; border-top: 1px solid #F0EBE5; }
.pp-action-btn { display: inline-flex; align-items: center; gap: .3rem; padding: .38rem .82rem; border-radius: 6px; border: 1.5px solid var(--border-md); background: var(--white); font-family: var(--font-body); font-size: .72rem; font-weight: 500; color: var(--warm-grey); cursor: pointer; transition: border-color .18s, color .18s, background .18s; white-space: nowrap; }
.pp-action-btn svg { width: 11px; height: 11px; flex-shrink: 0; }
.pp-action-btn:hover { border-color: var(--gold); color: var(--gold-dark); background: var(--gold-light); }
.pp-action-btn.danger { border-color: #FADBD8; color: #C0392B; }
.pp-action-btn.danger:hover { border-color: #C0392B; background: #FFF5F5; }

/* ── EMPTY STATE ── */
.pp-empty { text-align: center; padding: 4rem 1.5rem; background: var(--white); border: 1.5px solid var(--border); border-radius: var(--radius-card); }
.pp-empty-icon { width: 52px; height: 52px; border-radius: 50%; background: rgba(201,168,76,.08); display: flex; align-items: center; justify-content: center; margin: 0 auto .9rem; color: var(--gold-dark); }
.pp-empty-icon svg { width: 24px; height: 24px; }
.pp-empty-title { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--charcoal); margin-bottom: .35rem; }
.pp-empty-desc { font-size: .8rem; color: var(--warm-grey); line-height: 1.6; margin-bottom: 1.1rem; }

/* ── ALERTS ── */
.pp-alert-success { display: flex; align-items: center; gap: .65rem; background: #F0FDF4; border: 1px solid #A7F3D0; border-radius: 8px; padding: .75rem 1rem; font-size: .82rem; color: #065F46; margin-bottom: 1.25rem; font-family: var(--font-body); }
.pp-alert-success svg { width: 16px; height: 16px; color: #10B981; flex-shrink: 0; }
.pp-alert-error { display: flex; align-items: center; gap: .65rem; background: #FEF2F2; border: 1px solid #FCA5A5; border-radius: 8px; padding: .75rem 1rem; font-size: .82rem; color: #991B1B; margin-bottom: 1.25rem; font-family: var(--font-body); }
.pp-alert-error svg { width: 16px; height: 16px; color: #EF4444; flex-shrink: 0; }

/* ══ SHARED MODAL STYLES ══ */
.mo-overlay { position: fixed; inset: 0; z-index: 8000; background: rgba(30,27,24,.55); display: none; align-items: flex-start; justify-content: center; padding: 1rem; backdrop-filter: blur(3px); overflow-y: auto; }
.mo-overlay.open { display: flex; }
.mo-box { background: var(--white); border-radius: var(--radius-card); border: 1px solid var(--border); box-shadow: var(--shadow-modal); width: 100%; max-width: 580px; margin: auto; flex-shrink: 0; animation: moSlide .22s ease; display: flex; flex-direction: column; max-height: calc(100vh - 2rem); overflow: hidden; }
.mo-box.mo-sm { max-width: 420px; }
@keyframes moSlide { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }

.mo-head { display: flex; align-items: center; justify-content: space-between; padding: 1.1rem 1.4rem; border-bottom: 1px solid var(--border); flex-shrink: 0; }
.mo-head-l { display: flex; align-items: center; gap: .65rem; }
.mo-icon { width: 32px; height: 32px; border-radius: 8px; background: rgba(201,168,76,.1); display: flex; align-items: center; justify-content: center; color: var(--gold-dark); flex-shrink: 0; }
.mo-icon svg { width: 15px; height: 15px; }
.mo-icon.danger { background: #FEF2F2; color: #C0392B; }
.mo-title { font-family: var(--font-display); font-size: .95rem; font-weight: 700; color: var(--charcoal); }
.mo-close { width: 30px; height: 30px; border-radius: 50%; border: 1.5px solid var(--border); background: var(--white); display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--warm-grey); transition: border-color .15s, color .15s; }
.mo-close:hover { border-color: var(--gold); color: var(--gold-dark); }
.mo-close svg { width: 12px; height: 12px; }

.mo-body { padding: 1.35rem 1.4rem; overflow-y: auto; flex: 1; min-height: 0; }
.mo-body::-webkit-scrollbar { width: 4px; }
.mo-body::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }

.mo-foot { padding: .85rem 1.4rem; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: flex-end; gap: .55rem; flex-shrink: 0; background: var(--white); }

/* Form fields */
.mo-field { margin-bottom: .9rem; }
.mo-field:last-child { margin-bottom: 0; }
.mo-fg { display: grid; grid-template-columns: repeat(2,1fr); gap: .9rem; }
.mo-fg-full { grid-column: 1/-1; }
.mo-fg-third { display: grid; grid-template-columns: repeat(3,1fr); gap: .9rem; margin-bottom: .9rem; }
@media(max-width:520px) { .mo-fg, .mo-fg-third { grid-template-columns: 1fr; } }

.mo-lbl { display: flex; align-items: center; justify-content: space-between; font-size: .68rem; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: var(--warm-grey); margin-bottom: .38rem; font-family: var(--font-body); }
.mo-req { font-size: .58rem; color: #C0392B; font-weight: 500; text-transform: none; letter-spacing: 0; }
.mo-opt { font-size: .58rem; color: #C0B8B0; font-weight: 400; text-transform: none; letter-spacing: 0; }

.mo-inp, .mo-sel, .mo-ta {
    width: 100%; padding: .68rem .9rem; background: var(--ivory);
    border: 1.5px solid var(--border); border-radius: 8px;
    font-family: var(--font-body); font-size: .84rem; color: var(--charcoal);
    outline: none; transition: border-color .2s, box-shadow .2s, background .2s;
    appearance: none; display: block;
}
.mo-inp:focus, .mo-sel:focus, .mo-ta:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,.12); background: var(--white); }
.mo-inp::placeholder, .mo-ta::placeholder { color: #C0B8B0; }
.mo-ta { resize: vertical; min-height: 80px; }

/* select wrapper */
.mo-sw { position: relative; }
.mo-sw::after { content: ''; position: absolute; right: .85rem; top: 50%; transform: translateY(-50%); width: 0; height: 0; border-left: 4px solid transparent; border-right: 4px solid transparent; border-top: 5px solid #C0B8B0; pointer-events: none; }
.mo-sw .mo-sel { padding-right: 2.1rem; }

.mo-err { font-size: .68rem; color: #C0392B; margin-top: .28rem; font-family: var(--font-body); }
.mo-hnt { font-size: .68rem; color: #C0B8B0; margin-top: .28rem; font-family: var(--font-body); }

/* Modal section divider */
.mo-section { margin-top: 1.1rem; padding-top: 1rem; border-top: 1px dashed var(--border); }
.mo-section-label { font-size: .65rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--warm-grey); margin-bottom: .7rem; display: flex; align-items: center; gap: .5rem; font-family: var(--font-body); }
.mo-section-label::after { content: ''; flex: 1; height: 1px; background: var(--border); }

/* Inclusions list */
.inc-list { display: flex; flex-direction: column; gap: .5rem; margin-bottom: .6rem; }
.inc-row { display: flex; align-items: center; gap: .5rem; }
.inc-row .mo-inp { flex: 1; min-width: 0; }
.inc-row .mo-sw { flex: 0 0 130px; }
.inc-del { width: 32px; height: 32px; flex-shrink: 0; display: inline-flex; align-items: center; justify-content: center; border: 1.5px solid #FADBD8; border-radius: 6px; background: transparent; color: #C0392B; cursor: pointer; transition: background .15s, border-color .15s; }
.inc-del:hover { background: #FFF5F5; border-color: #C0392B; }
.inc-del svg { width: 11px; height: 11px; }
.inc-del:disabled { opacity: .35; cursor: not-allowed; pointer-events: none; }

.btn-add-inc { display: inline-flex; align-items: center; gap: .4rem; padding: .45rem .9rem; border-radius: var(--radius-btn); border: 1.5px dashed rgba(201,168,76,.4); background: var(--gold-light); font-family: var(--font-body); font-size: .75rem; font-weight: 500; color: var(--gold-dark); cursor: pointer; transition: border-color .2s, background .2s; }
.btn-add-inc:hover { border-color: var(--gold); background: rgba(201,168,76,.18); }
.btn-add-inc svg { width: 12px; height: 12px; }

/* Modal buttons */
.mo-btn-save { display: inline-flex; align-items: center; gap: .45rem; padding: .62rem 1.5rem; border-radius: var(--radius-btn); border: none; background: var(--charcoal); font-family: var(--font-body); font-size: .82rem; font-weight: 500; color: var(--white); cursor: pointer; transition: background .2s, box-shadow .2s, transform .15s; }
.mo-btn-save:hover { background: var(--gold-dark); box-shadow: 0 4px 12px rgba(201,168,76,.2); transform: translateY(-1px); }
.mo-btn-cancel { display: inline-flex; align-items: center; gap: .4rem; padding: .62rem 1.1rem; border-radius: var(--radius-btn); border: 1.5px solid var(--border); background: var(--white); font-family: var(--font-body); font-size: .82rem; font-weight: 500; color: var(--warm-grey); cursor: pointer; transition: border-color .2s, color .2s; }
.mo-btn-cancel:hover { border-color: var(--gold); color: var(--charcoal); }
.mo-btn-danger { display: inline-flex; align-items: center; gap: .45rem; padding: .62rem 1.4rem; border-radius: var(--radius-btn); border: none; background: #C0392B; font-family: var(--font-body); font-size: .82rem; font-weight: 500; color: var(--white); cursor: pointer; transition: background .2s, box-shadow .2s; }
.mo-btn-danger:hover { background: #9B2335; box-shadow: 0 4px 12px rgba(192,57,43,.25); }

/* Delete modal confirm box */
.del-confirm-box { display: flex; gap: .9rem; align-items: flex-start; }
.del-confirm-icon { width: 44px; height: 44px; border-radius: 50%; background: #FEF2F2; display: flex; align-items: center; justify-content: center; color: #C0392B; flex-shrink: 0; }
.del-confirm-icon svg { width: 20px; height: 20px; }
.del-confirm-text h4 { font-family: var(--font-display); font-size: .95rem; font-weight: 700; color: var(--charcoal); margin-bottom: .3rem; }
.del-confirm-text p { font-size: .8rem; color: var(--warm-grey); line-height: 1.55; }
.del-pkg-name { font-weight: 600; color: var(--charcoal); }

/* ── RESPONSIVE ── */
@media(max-width:640px) {
    .pp-top { flex-direction: column; align-items: flex-start; }
    .pp-toolbar { gap: .5rem; }
    .pp-search-wrap { max-width: 100%; width: 100%; }
    .pp-cat-sel { width: 100%; }
    .pp-grid { grid-template-columns: 1fr; }
    .pp-count { margin-left: 0; }
    .mo-box { max-height: calc(100vh - 1rem); }
    .inc-row .mo-sw { flex: 0 0 110px; }
}
@media(min-width:641px) and (max-width:900px) {
    .pp-grid { grid-template-columns: repeat(2,1fr); }
}
</style>

<div class="pp-page">

    {{-- ── ALERTS ── --}}
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
            <h2 class="pp-title">Popular <em>Packages</em></h2>
            <p class="pp-subtitle">Manage your curated event packages</p>
        </div>
        <button type="button" class="pp-btn-add" onclick="openAddPkg()">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 2v10M2 7h10"/></svg>
            Add Package
        </button>
    </div>

    {{-- ── TOOLBAR ── --}}
    <div class="pp-toolbar">
        <div class="pp-search-wrap">
            <svg class="pp-search-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                <circle cx="8.5" cy="8.5" r="5.5"/><path d="M15 15l-3.5-3.5"/>
            </svg>
            <input type="text" class="pp-search-inp" id="pkgSearch"
                   placeholder="Search packages…" oninput="filterPackages()" autocomplete="off">
        </div>

        <div class="pp-cat-wrap">
            <select class="pp-cat-sel" id="pkgCategory" onchange="filterPackages()">
                <option value="">All Categories</option>
                @php $cats = $packages->pluck('event_type')->unique()->filter()->sort()->values(); @endphp
                @foreach($cats as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        <span class="pp-count" id="pkgCount">
            {{ $packages->count() }} {{ Str::plural('package', $packages->count()) }}
        </span>
    </div>

    {{-- ── PACKAGE GRID ── --}}
    @if($packages->count())
    <div class="pp-grid" id="pkgGrid">
        @foreach($packages as $package)
        @php
            $inclusions  = $package->inclusions ?? collect();
            $displayInc  = $inclusions->take(4);
            $moreCount   = max(0, $inclusions->count() - 4);
        @endphp
        <div class="pp-card"
             data-id="{{ $package->id }}"
             data-name="{{ strtolower($package->name) }}"
             data-type="{{ strtolower($package->event_type) }}">

            {{-- Head --}}
            <div class="pp-card-head">
                <div class="pp-card-accent"></div>
                <div class="pp-card-name">{{ $package->name }}</div>
                @if($package->event_type)
                    <span class="pp-card-type">{{ $package->event_type }}</span>
                @endif
            </div>

            {{-- Body --}}
            <div class="pp-card-body">
                <div class="pp-card-meta">
                    @if($package->price)
                    <div class="pp-card-meta-item">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="10" r="7"/><path d="M10 6v8M7.5 8.5h4a1.5 1.5 0 010 3h-3a1.5 1.5 0 000 3H13"/></svg>
                        ₱{{ number_format($package->price) }}
                    </div>
                    @endif
                    @if($package->guest_capacity)
                    <div class="pp-card-meta-item">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="7" cy="6" r="3"/><path d="M1 17c0-3 2.7-5 6-5"/><circle cx="13" cy="6" r="3"/><path d="M19 17c0-3-2.7-5-6-5s-6 2-6 5"/></svg>
                        Up to {{ number_format($package->guest_capacity) }} guests
                    </div>
                    @endif
                    @if($package->duration_hours)
                    <div class="pp-card-meta-item">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="10" r="7"/><path d="M10 7v3.5l2.5 1.5"/></svg>
                        {{ $package->duration_hours }}h
                    </div>
                    @endif
                </div>

                @if($inclusions->count())
                <div class="pp-inc-label">Inclusions</div>
                <ul class="pp-inc-list">
                    @foreach($displayInc as $inc)
                        <li>{{ $inc->title }}</li>
                    @endforeach
                </ul>
                @if($moreCount > 0)
                    <div class="pp-inc-more">+{{ $moreCount }} more inclusion{{ $moreCount > 1 ? 's' : '' }}</div>
                @endif
                @endif
            </div>

            {{-- Card Footer: Edit / Delete ── --}}
            <div class="pp-card-foot">
                <button type="button" class="pp-action-btn"
                    onclick="openEditPkg({
                        id: {{ $package->id }},
                        name: {{ json_encode($package->name) }},
                        event_type: {{ json_encode($package->event_type) }},
                        price: {{ json_encode($package->price) }},
                        guest_capacity: {{ json_encode($package->guest_capacity) }},
                        duration_hours: {{ json_encode($package->duration_hours) }},
                        inclusions: {{ json_encode($inclusions->map(fn($i) => ['id' => $i->id, 'title' => $i->title, 'type' => $i->type ?? ''])) }}
                    })">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M9.5 1.5l3 3L4 13H1v-3L9.5 1.5z"/>
                    </svg>
                    Edit
                </button>
                <button type="button" class="pp-action-btn danger"
                    onclick="openDeletePkg({{ $package->id }}, {{ json_encode($package->name) }})">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M2 3.5h10M5 3.5V2h4v1.5M5.5 6v4.5M8.5 6v4.5M3 3.5l.7 8.5h6.6L11 3.5H3z"/>
                    </svg>
                    Delete
                </button>
            </div>

        </div>
        @endforeach
    </div>

    @else
    <div class="pp-empty" id="pkgGrid">
        <div class="pp-empty-icon">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="3" y="3" width="14" height="14" rx="2"/>
                <path d="M7 10h6M10 7v6"/>
            </svg>
        </div>
        <div class="pp-empty-title">No Packages Yet</div>
        <div class="pp-empty-desc">You haven't added any popular packages yet.<br>Click the button below to create your first one.</div>
        <button type="button" class="pp-btn-add" onclick="openAddPkg()">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 2v10M2 7h10"/></svg>
            Add Package
        </button>
    </div>
    @endif

    {{-- No results (shown by JS) --}}
    <div id="pkgNoResults" style="display:none;" class="pp-empty">
        <div class="pp-empty-icon">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="8.5" cy="8.5" r="5.5"/><path d="M15 15l-3.5-3.5"/></svg>
        </div>
        <div class="pp-empty-title">No Results Found</div>
        <div class="pp-empty-desc">Try adjusting your search or category filter.</div>
    </div>

</div>{{-- /pp-page --}}


{{-- ══════════════════════════════════════════
     ADD PACKAGE MODAL
══════════════════════════════════════════ --}}
<div class="mo-overlay" id="addPkgOverlay" onclick="if(event.target===this)closeAddPkg()">
    <div class="mo-box">

        <div class="mo-head">
            <div class="mo-head-l">
                <div class="mo-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="3" y="3" width="14" height="14" rx="2"/>
                        <path d="M7 10h6M10 7v6"/>
                    </svg>
                </div>
                <div class="mo-title">Add New Package</div>
            </div>
            <button type="button" class="mo-close" onclick="closeAddPkg()">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
            </button>
        </div>

        <form action="{{ route('admin.popular.store') }}" method="POST" style="display:contents;">
            @csrf

            <div class="mo-body">

                {{-- Package Name --}}
                <div class="mo-field">
                    <label class="mo-lbl">Package Name <span class="mo-req">Required</span></label>
                    <input type="text" name="name" id="add_name" class="mo-inp"
                           placeholder="e.g. Grand Wedding Elegance"
                           value="{{ old('name') }}" required>
                    @error('name')<div class="mo-err">{{ $message }}</div>@enderror
                </div>

                {{-- Event Type --}}
                <div class="mo-field">
                    <label class="mo-lbl">Event Type <span class="mo-req">Required</span></label>
                    <div class="mo-sw">
                        <select name="event_type" class="mo-sel" required>
                            <option value="" disabled selected>Select type…</option>
                            @foreach(\App\Models\Eventcategory::all() as $ec)
                                <option value="{{ $ec->name }}" {{ old('event_type') == $ec->name ? 'selected' : '' }}>
                                    {{ $ec->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('event_type')<div class="mo-err">{{ $message }}</div>@enderror
                </div>

                {{-- Price / Guests / Duration --}}
                <div class="mo-fg-third">
                    <div>
                        <label class="mo-lbl">Price <span class="mo-opt">Optional</span></label>
                        <input type="number" name="price" class="mo-inp"
                               placeholder="e.g. 50000"
                               value="{{ old('price') }}" min="0" step="0.01">
                        @error('price')<div class="mo-err">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="mo-lbl">Guests <span class="mo-opt">Optional</span></label>
                        <input type="number" name="guest_capacity" class="mo-inp"
                               placeholder="e.g. 200"
                               value="{{ old('guest_capacity') }}" min="1">
                        @error('guest_capacity')<div class="mo-err">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="mo-lbl">Hours <span class="mo-opt">Optional</span></label>
                        <input type="number" name="duration_hours" class="mo-inp"
                               placeholder="e.g. 8"
                               value="{{ old('duration_hours') }}" min="1">
                        @error('duration_hours')<div class="mo-err">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Inclusions --}}
                <div class="mo-section">
                    <div class="mo-section-label">Inclusions</div>
                    <div class="inc-list" id="addIncList">
                        {{-- First row (non-deletable) --}}
                        <div class="inc-row">
                            <input type="text" name="inclusions[]" class="mo-inp"
                                   placeholder="e.g. Floral centrepiece">
                            <div class="mo-sw">
                                <select name="inclusion_types[]" class="mo-sel">
                                    <option value="">— Type —</option>
                                    <option value="photo">Photography</option>
                                    <option value="video">Videography</option>
                                    <option value="styling">Styling</option>
                                    <option value="audio">Sound System</option>
                                    <option value="lighting">Lighting</option>
                                    <option value="catering">Catering</option>
                                    <option value="venue">Venue</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <button type="button" class="inc-del" onclick="removeIncRow(this, 'addIncList')" disabled title="Remove">
                                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn-add-inc" onclick="addIncRow('addIncList')">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 1v10M1 6h10"/></svg>
                        Add Inclusion
                    </button>
                </div>

            </div>{{-- /mo-body --}}

            <div class="mo-foot">
                <button type="button" class="mo-btn-cancel" onclick="closeAddPkg()">Cancel</button>
                <button type="submit" class="mo-btn-save">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 7l4 4 6-6"/></svg>
                    Save Package
                </button>
            </div>

        </form>
    </div>
</div>


{{-- ══════════════════════════════════════════
     EDIT PACKAGE MODAL
══════════════════════════════════════════ --}}
<div class="mo-overlay" id="editPkgOverlay" onclick="if(event.target===this)closeEditPkg()">
    <div class="mo-box">

        <div class="mo-head">
            <div class="mo-head-l">
                <div class="mo-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M13.5 2.5l4 4L6 18H2v-4L13.5 2.5z"/>
                    </svg>
                </div>
                <div class="mo-title">Edit Package</div>
            </div>
            <button type="button" class="mo-close" onclick="closeEditPkg()">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
            </button>
        </div>

        <form id="editPkgForm" method="POST" style="display:contents;">
            @csrf
            @method('PUT')

            <div class="mo-body">

                {{-- Package Name --}}
                <div class="mo-field">
                    <label class="mo-lbl">Package Name <span class="mo-req">Required</span></label>
                    <input type="text" name="name" id="edit_name" class="mo-inp"
                           placeholder="e.g. Grand Wedding Elegance" required>
                </div>

                {{-- Event Type --}}
                <div class="mo-field">
                    <label class="mo-lbl">Event Type <span class="mo-req">Required</span></label>
                    <div class="mo-sw">
                        <select name="event_type" id="edit_event_type" class="mo-sel" required>
                            <option value="" disabled>Select type…</option>
                            @foreach(\App\Models\Eventcategory::all() as $ec)
                                <option value="{{ $ec->name }}">{{ $ec->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Price / Guests / Duration --}}
                <div class="mo-fg-third">
                    <div>
                        <label class="mo-lbl">Price <span class="mo-opt">Optional</span></label>
                        <input type="number" name="price" id="edit_price" class="mo-inp"
                               placeholder="e.g. 50000" min="0" step="0.01">
                    </div>
                    <div>
                        <label class="mo-lbl">Guests <span class="mo-opt">Optional</span></label>
                        <input type="number" name="guest_capacity" id="edit_guests" class="mo-inp"
                               placeholder="e.g. 200" min="1">
                    </div>
                    <div>
                        <label class="mo-lbl">Hours <span class="mo-opt">Optional</span></label>
                        <input type="number" name="duration_hours" id="edit_hours" class="mo-inp"
                               placeholder="e.g. 8" min="1">
                    </div>
                </div>

                {{-- Inclusions --}}
                <div class="mo-section">
                    <div class="mo-section-label">Inclusions</div>
                    <div class="inc-list" id="editIncList">
                        {{-- Populated dynamically by JS --}}
                    </div>
                    <button type="button" class="btn-add-inc" onclick="addIncRow('editIncList')">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 1v10M1 6h10"/></svg>
                        Add Inclusion
                    </button>
                </div>

            </div>{{-- /mo-body --}}

            <div class="mo-foot">
                <button type="button" class="mo-btn-cancel" onclick="closeEditPkg()">Cancel</button>
                <button type="submit" class="mo-btn-save">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 7l4 4 6-6"/></svg>
                    Update Package
                </button>
            </div>

        </form>
    </div>
</div>


{{-- ══════════════════════════════════════════
     DELETE CONFIRM MODAL
══════════════════════════════════════════ --}}
<div class="mo-overlay" id="deletePkgOverlay" onclick="if(event.target===this)closeDeletePkg()">
    <div class="mo-box mo-sm">

        <div class="mo-head">
            <div class="mo-head-l">
                <div class="mo-icon danger">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M3 5.5h14M7 5.5V3.5h6v2M8 9v5.5M12 9v5.5M4.5 5.5l.75 11h9.5l.75-11H4.5z"/>
                    </svg>
                </div>
                <div class="mo-title">Delete Package</div>
            </div>
            <button type="button" class="mo-close" onclick="closeDeletePkg()">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
            </button>
        </div>

        <div class="mo-body">
            <div class="del-confirm-box">
                <div class="del-confirm-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                </div>
                <div class="del-confirm-text">
                    <h4>Are you sure?</h4>
                    <p>You're about to permanently delete <span class="del-pkg-name" id="delPkgName">"Package"</span>. This will also remove all its inclusions and cannot be undone.</p>
                </div>
            </div>
        </div>

        <div class="mo-foot">
            <button type="button" class="mo-btn-cancel" onclick="closeDeletePkg()">Cancel</button>
            <form id="deletePkgForm" method="POST" style="display:contents;">
                @csrf
                @method('DELETE')
                <button type="submit" class="mo-btn-danger">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 3.5h10M5 3.5V2h4v1.5M5.5 6v5M8.5 6v5M3 3.5l.7 8.5h6.6L11 3.5H3z"/>
                    </svg>
                    Yes, Delete
                </button>
            </form>
        </div>

    </div>
</div>

<script>
/* ══════════════════════════════════════════
   INCLUSION HELPERS
══════════════════════════════════════════ */
var TYPE_OPTIONS = [
    { value: '',          label: '— Type —' },
    { value: 'photo',     label: 'Photography' },
    { value: 'video',     label: 'Videography' },
    { value: 'styling',   label: 'Styling' },
    { value: 'audio',     label: 'Sound System' },
    { value: 'lighting',  label: 'Lighting' },
    { value: 'catering',  label: 'Catering' },
    { value: 'venue',     label: 'Venue' },
    { value: 'other',     label: 'Other' },
];

function buildTypeOptions(selected) {
    return TYPE_OPTIONS.map(function(o) {
        var s = (o.value === selected) ? ' selected' : '';
        return '<option value="' + o.value + '"' + s + '>' + o.label + '</option>';
    }).join('');
}

function makeIncRow(listId, titleVal, typeVal) {
    titleVal = titleVal || '';
    typeVal  = typeVal  || '';
    var row  = document.createElement('div');
    row.className = 'inc-row';
    row.innerHTML =
        '<input type="text" name="inclusions[]" class="mo-inp" placeholder="e.g. Floral centrepiece" value="' + escAttr(titleVal) + '">' +
        '<div class="mo-sw"><select name="inclusion_types[]" class="mo-sel">' + buildTypeOptions(typeVal) + '</select></div>' +
        '<button type="button" class="inc-del" onclick="removeIncRow(this,\'' + listId + '\')" title="Remove">' +
            '<svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>' +
        '</button>';
    return row;
}

function addIncRow(listId) {
    var list = document.getElementById(listId);
    var row  = makeIncRow(listId, '', '');
    list.appendChild(row);
    syncDeleteBtns(listId);
    row.querySelector('input').focus();
}

function removeIncRow(btn, listId) {
    btn.closest('.inc-row').remove();
    syncDeleteBtns(listId);
}

function syncDeleteBtns(listId) {
    var rows = document.querySelectorAll('#' + listId + ' .inc-row');
    rows.forEach(function(r) {
        r.querySelector('.inc-del').disabled = (rows.length === 1);
    });
}

function escAttr(str) {
    return String(str).replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/'/g,'&#39;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

/* ══════════════════════════════════════════
   ADD MODAL
══════════════════════════════════════════ */
function openAddPkg() {
    document.getElementById('addPkgOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
    setTimeout(function() { document.getElementById('add_name').focus(); }, 80);
}
function closeAddPkg() {
    document.getElementById('addPkgOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

/* Re-open on validation errors */
@if($errors->any())
    openAddPkg();
@endif

/* ══════════════════════════════════════════
   EDIT MODAL
══════════════════════════════════════════ */
function openEditPkg(pkg) {
    /* Populate basic fields */
    document.getElementById('edit_name').value        = pkg.name        || '';
    document.getElementById('edit_price').value       = pkg.price       || '';
    document.getElementById('edit_guests').value      = pkg.guest_capacity || '';
    document.getElementById('edit_hours').value       = pkg.duration_hours || '';

    /* Event type select */
    var sel = document.getElementById('edit_event_type');
    for (var i = 0; i < sel.options.length; i++) {
        sel.options[i].selected = (sel.options[i].value === pkg.event_type);
    }

    /* Set form action */
    document.getElementById('editPkgForm').action = '/admin/popular/' + pkg.id;

    /* Rebuild inclusions list */
    var list = document.getElementById('editIncList');
    list.innerHTML = '';
    var incs = pkg.inclusions || [];
    if (incs.length === 0) {
        /* Add one blank row */
        list.appendChild(makeIncRow('editIncList', '', ''));
    } else {
        incs.forEach(function(inc) {
            list.appendChild(makeIncRow('editIncList', inc.title, inc.type));
        });
    }
    syncDeleteBtns('editIncList');

    /* Open overlay */
    document.getElementById('editPkgOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
    setTimeout(function() { document.getElementById('edit_name').focus(); }, 80);
}
function closeEditPkg() {
    document.getElementById('editPkgOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

/* ══════════════════════════════════════════
   DELETE MODAL
══════════════════════════════════════════ */
function openDeletePkg(id, name) {
    document.getElementById('delPkgName').textContent = '"' + name + '"';
    document.getElementById('deletePkgForm').action = '/admin/popular/' + id;
    document.getElementById('deletePkgOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeDeletePkg() {
    document.getElementById('deletePkgOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

/* ══════════════════════════════════════════
   GLOBAL ESC KEY
══════════════════════════════════════════ */
document.addEventListener('keydown', function(e) {
    if (e.key !== 'Escape') return;
    closeAddPkg();
    closeEditPkg();
    closeDeletePkg();
});

/* ══════════════════════════════════════════
   LIVE SEARCH + CATEGORY FILTER
══════════════════════════════════════════ */
function filterPackages() {
    var q    = document.getElementById('pkgSearch').value.toLowerCase().trim();
    var cat  = document.getElementById('pkgCategory').value.toLowerCase();
    var grid = document.getElementById('pkgGrid');
    var noRes= document.getElementById('pkgNoResults');

    if (!grid) return;

    var cards   = grid.querySelectorAll('.pp-card');
    var visible = 0;

    cards.forEach(function(card) {
        var name    = card.dataset.name || '';
        var type    = card.dataset.type || '';
        var matchQ  = !q   || name.includes(q) || type.includes(q);
        var matchCat= !cat || type === cat;
        var show    = matchQ && matchCat;
        card.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    document.getElementById('pkgCount').textContent =
        visible + ' ' + (visible === 1 ? 'package' : 'packages');

    if (noRes) noRes.style.display = (visible === 0 && (q || cat)) ? 'block' : 'none';
}
</script>

</x-app-layout>