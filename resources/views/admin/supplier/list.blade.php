<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Suppliers') }}
        </h2>
    </x-slot>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap');
    :root {
        --gold:#C9A84C;--gold-dark:#8A6A1F;--gold-light:rgba(201,168,76,0.1);
        --ivory:#FAF7F2;--charcoal:#1E1B18;--warm-grey:#706B65;
        --border:#E5DDD5;--white:#FFFFFF;
        --font-display:'Playfair Display',Georgia,serif;
        --font-body:'DM Sans',sans-serif;
    }

    /* ── Header ── */
    .bv-page-header { display:flex; align-items:flex-end; justify-content:space-between; margin-bottom:1.5rem; flex-wrap:wrap; gap:.75rem; }
    .bv-page-title { font-family:var(--font-display); font-size:1.65rem; font-weight:700; color:var(--charcoal); line-height:1.15; }
    .bv-page-title em { font-style:italic; color:var(--gold-dark); }
    .bv-page-sub { font-size:.76rem; color:var(--warm-grey); margin-top:.2rem; }
    .bv-badge { font-size:.65rem; font-weight:500; letter-spacing:.07em; text-transform:uppercase; color:var(--gold-dark); background:var(--gold-light); border:1px solid rgba(201,168,76,.3); padding:.28rem .75rem; border-radius:20px; white-space:nowrap; }

    /* ── Cards Grid ── */
    .bv-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.25rem;
    }

    /* ── Supplier Card ── */
    .bv-sup-card {
        background: var(--white);
        border: 1.5px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow .2s, border-color .2s, transform .18s;
        position: relative;
    }
    .bv-sup-card:hover {
        box-shadow: 0 8px 28px rgba(30,27,24,.09);
        border-color: rgba(201,168,76,.45);
        transform: translateY(-2px);
    }

    /* Card top accent bar */
    .bv-sup-card-bar {
        height: 4px;
        background: linear-gradient(90deg, var(--gold-dark), var(--gold), var(--gold-light));
    }

    /* Card body */
    .bv-sup-card-body { padding: 1.25rem 1.25rem .85rem; flex: 1; }

    /* Avatar */
    .bv-sup-avatar {
        width: 58px; height: 58px; border-radius: 12px;
        background: rgba(201,168,76,.12);
        border: 2px solid rgba(201,168,76,.3);
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display); font-size: 1.1rem; font-weight: 700;
        color: var(--gold-dark); overflow: hidden; flex-shrink: 0;
        margin-bottom: .9rem;
    }
    .bv-sup-avatar img { width:100%; height:100%; object-fit:cover; display:block; }

    /* Name & meta */
    .bv-sup-name { font-family:var(--font-display); font-weight:700; font-size:1rem; color:var(--charcoal); line-height:1.2; }
    .bv-sup-tagline { font-size:.72rem; color:var(--warm-grey); margin-top:.18rem; font-style:italic; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }

    /* Chips row */
    .bv-sup-chips { display:flex; flex-wrap:wrap; gap:.35rem; margin-top:.7rem; }
    .bv-chip-cat {
        display:inline-flex; align-items:center; gap:.25rem;
        padding:.2rem .55rem; border-radius:20px; font-size:.62rem; font-weight:600;
        background:var(--gold-light); color:var(--gold-dark);
        border:1px solid rgba(201,168,76,.25); white-space:nowrap;
    }
    .bv-chip-avail-yes {
        display:inline-flex; align-items:center; gap:.25rem;
        padding:.2rem .55rem; border-radius:20px; font-size:.62rem; font-weight:600;
        background:#F0FDF4; color:#15803D; border:1px solid #BBF7D0;
    }
    .bv-chip-avail-no {
        display:inline-flex; align-items:center; gap:.25rem;
        padding:.2rem .55rem; border-radius:20px; font-size:.62rem; font-weight:600;
        background:#FFFBEB; color:#B45309; border:1px solid #FDE68A;
    }

    /* Info rows inside card */
    .bv-sup-info { margin-top:.85rem; display:flex; flex-direction:column; gap:.38rem; }
    .bv-sup-info-row { display:flex; align-items:center; gap:.5rem; font-size:.76rem; color:var(--warm-grey); }
    .bv-sup-info-row svg { width:13px; height:13px; flex-shrink:0; color:var(--gold-dark); opacity:.7; }
    .bv-sup-info-val { color:var(--charcoal); font-weight:500; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }

    /* Rating stars */
    .bv-stars { display:inline-flex; align-items:center; gap:2px; }
    .bv-star-fill { color:var(--gold); font-size:.78rem; }
    .bv-star-empty { color:#DDD4C8; font-size:.78rem; }
    .bv-rating-val { font-size:.72rem; color:var(--warm-grey); margin-left:.3rem; }

    /* Card footer */
    .bv-sup-card-footer {
        padding: .7rem 1.25rem 1rem;
        border-top: 1px solid var(--border);
        background: rgba(201,168,76,.02);
    }
    .bv-btn-view {
        display: inline-flex; align-items: center; gap: .4rem;
        width: 100%; justify-content: center;
        padding: .55rem 1rem;
        background: var(--charcoal); color: var(--white);
        border: none; border-radius: 7px;
        font-size: .73rem; font-weight: 600; letter-spacing: .04em; text-transform: uppercase;
        cursor: pointer; font-family: var(--font-body);
        transition: background .18s;
        position: relative; overflow: hidden;
    }
    .bv-btn-view::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(201,168,76,.18), transparent);
    }
    .bv-btn-view:hover { background: #2e2a26; }
    .bv-btn-view svg { width: 13px; height: 13px; }

    /* ── Row number badge ── */
    .bv-card-num {
        position: absolute; top: .7rem; right: .85rem;
        width: 22px; height: 22px; border-radius: 50%;
        background: var(--ivory); border: 1px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        font-size: .6rem; font-weight: 700; color: var(--warm-grey);
        font-family: var(--font-body);
    }

    /* ── Empty state ── */
    .bv-empty { text-align:center; padding:4rem 2rem; color:var(--warm-grey); background:var(--white); border:1.5px solid var(--border); border-radius:14px; }
    .bv-empty svg { width:44px; height:44px; color:#DDD4C8; margin:0 auto .85rem; display:block; }
    .bv-empty-title { font-family:var(--font-display); font-size:1.05rem; color:var(--charcoal); margin-bottom:.3rem; }
    .bv-empty-sub { font-size:.8rem; }

    /* ── Alert ── */
    .bv-alert { display:flex; align-items:center; gap:.6rem; background:#F0FDF4; border:1px solid #A7F3D0; border-radius:8px; padding:.7rem 1rem; font-size:.8rem; color:#065F46; margin-bottom:1.4rem; font-family:var(--font-body); }
    .bv-alert svg { width:15px; height:15px; color:#10B981; flex-shrink:0; }

    /* ══════════════════════════════
       MODAL
    ══════════════════════════════ */
    .bv-modal-overlay {
        display: none;
        position: fixed; inset: 0; z-index: 1000;
        background: rgba(30,27,24,.55);
        backdrop-filter: blur(3px);
        align-items: center; justify-content: center;
        padding: 1rem;
        animation: overlayIn .2s ease both;
    }
    .bv-modal-overlay.open { display: flex; }
    @keyframes overlayIn { from { opacity:0; } to { opacity:1; } }

    .bv-modal {
        background: var(--white);
        border-radius: 16px;
        width: 100%; max-width: 620px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 24px 64px rgba(30,27,24,.22);
        animation: modalIn .25s ease both;
        scrollbar-width: thin;
        scrollbar-color: rgba(201,168,76,.35) transparent;
        position: relative;
    }
    .bv-modal::-webkit-scrollbar { width: 4px; }
    .bv-modal::-webkit-scrollbar-thumb { background: rgba(201,168,76,.4); border-radius: 4px; }
    @keyframes modalIn { from { opacity:0; transform:translateY(20px) scale(.97); } to { opacity:1; transform:none; } }

    /* Modal top bar */
    .bv-modal-bar {
        height: 5px;
        background: linear-gradient(90deg, var(--gold-dark), var(--gold), var(--gold-light));
        border-radius: 16px 16px 0 0;
    }

    /* Modal header */
    .bv-modal-header {
        display: flex; align-items: flex-start; gap: 1rem;
        padding: 1.4rem 1.5rem 1rem;
        border-bottom: 1px solid var(--border);
    }
    .bv-modal-avatar {
        width: 70px; height: 70px; border-radius: 14px; flex-shrink: 0;
        background: rgba(201,168,76,.12); border: 2px solid rgba(201,168,76,.3);
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display); font-size: 1.4rem; font-weight: 700;
        color: var(--gold-dark); overflow: hidden;
    }
    .bv-modal-avatar img { width:100%; height:100%; object-fit:cover; display:block; }
    .bv-modal-id { flex: 1; min-width: 0; }
    .bv-modal-name { font-family:var(--font-display); font-size:1.25rem; font-weight:700; color:var(--charcoal); line-height:1.2; }
    .bv-modal-email { font-size:.76rem; color:var(--warm-grey); margin-top:.15rem; }
    .bv-modal-tagline { font-size:.78rem; color:var(--warm-grey); font-style:italic; margin-top:.25rem; }
    .bv-modal-chips { display:flex; flex-wrap:wrap; gap:.35rem; margin-top:.55rem; }

    /* Close btn */
    .bv-modal-close {
        width: 30px; height: 30px; border-radius: 50%;
        background: var(--ivory); border: 1px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; flex-shrink: 0;
        transition: background .15s, border-color .15s;
    }
    .bv-modal-close:hover { background: #FEE2E2; border-color: #FECACA; }
    .bv-modal-close svg { width: 13px; height: 13px; color: var(--warm-grey); }

    /* Modal body */
    .bv-modal-body { padding: 1.25rem 1.5rem 1.5rem; }

    /* Section heading inside modal */
    .bv-modal-section-title {
        font-size: .58rem; font-weight: 700; letter-spacing: .16em; text-transform: uppercase;
        color: var(--gold-dark); font-family: var(--font-body);
        display: flex; align-items: center; gap: .5rem;
        margin-bottom: .85rem; margin-top: 1.25rem;
    }
    .bv-modal-section-title:first-child { margin-top: 0; }
    .bv-modal-section-title::after { content:''; flex:1; height:1px; background:linear-gradient(90deg, rgba(201,168,76,.4), transparent); }
    .bv-modal-section-title svg { width:12px; height:12px; flex-shrink:0; }

    /* Info grid inside modal */
    .bv-modal-grid { display:grid; grid-template-columns:1fr 1fr; gap:.65rem 1.25rem; }
    @media(max-width:480px) { .bv-modal-grid { grid-template-columns:1fr; } }
    .bv-modal-field {}
    .bv-modal-field-label { font-size:.58rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:var(--warm-grey); margin-bottom:.2rem; font-family:var(--font-body); }
    .bv-modal-field-val { font-size:.83rem; color:var(--charcoal); font-family:var(--font-body); word-break:break-word; }
    .bv-modal-field-val.muted { color:var(--warm-grey); }

    /* Full-width field */
    .bv-modal-field.full { grid-column: 1 / -1; }

    /* Bio / description text block */
    .bv-modal-text-block {
        background: var(--ivory); border: 1px solid var(--border);
        border-radius: 8px; padding: .75rem .9rem;
        font-size: .82rem; color: var(--charcoal); line-height: 1.65;
        font-family: var(--font-body);
    }

    /* Rating display */
    .bv-modal-rating { display:flex; align-items:center; gap:.4rem; }
    .bv-modal-stars { display:flex; gap:2px; }
    .bv-modal-star { font-size:.9rem; }
    .bv-modal-star.fill { color:var(--gold); }
    .bv-modal-star.empty { color:#DDD4C8; }
    .bv-modal-rating-num { font-size:.78rem; color:var(--warm-grey); }

    /* Availability pill in modal */
    .bv-modal-avail-yes { display:inline-flex; align-items:center; gap:.3rem; padding:.25rem .65rem; border-radius:20px; font-size:.72rem; font-weight:600; background:#F0FDF4; color:#15803D; border:1px solid #BBF7D0; }
    .bv-modal-avail-no  { display:inline-flex; align-items:center; gap:.3rem; padding:.25rem .65rem; border-radius:20px; font-size:.72rem; font-weight:600; background:#FFFBEB; color:#B45309; border:1px solid #FDE68A; }
    .bv-modal-avail-dot { width:7px; height:7px; border-radius:50%; flex-shrink:0; }
    .bv-modal-avail-yes .bv-modal-avail-dot { background:#15803D; }
    .bv-modal-avail-no  .bv-modal-avail-dot { background:#B45309; }
    </style>

    <div class="p-6">

        <div class="bv-page-header">
            <div>
                <h1 class="bv-page-title">Supplier <em>Management</em></h1>
                <p class="bv-page-sub">View and manage all registered suppliers</p>
            </div>
            @if(isset($supplierProfiles))
            <span class="bv-badge">{{ $supplierProfiles->count() }} suppliers</span>
            @endif
        </div>

        @if(session('success'))
        <div class="bv-alert">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
            {{ session('success') }}
        </div>
        @endif

        @if(isset($supplierProfiles) && $supplierProfiles->count())
        <div class="bv-cards-grid">
            @foreach($supplierProfiles as $i => $supplier)
            <div class="bv-sup-card">
                <div class="bv-sup-card-bar"></div>
                <span class="bv-card-num">{{ $i + 1 }}</span>

                <div class="bv-sup-card-body">
                    {{-- Avatar --}}
                    <div class="bv-sup-avatar">
                        @if($supplier->photo)
                            <img src="{{ asset('storage/' . $supplier->photo) }}" alt="{{ $supplier->first_name }}">
                        @else
                            {{ strtoupper(substr($supplier->first_name, 0, 1) . substr($supplier->last_name, 0, 1)) }}
                        @endif
                    </div>

                    {{-- Name --}}
                    <div class="bv-sup-name">{{ $supplier->first_name }} {{ $supplier->last_name }}</div>
                    @if($supplier->tagline)
                        <div class="bv-sup-tagline" title="{{ $supplier->tagline }}">{{ $supplier->tagline }}</div>
                    @endif

                    {{-- Chips --}}
                    <div class="bv-sup-chips">
                        @if($supplier->is_available)
                            <span class="bv-chip-avail-yes">● Available</span>
                        @else
                            <span class="bv-chip-avail-no">● Unavailable</span>
                        @endif
                        @foreach($supplier->categories->take(2) as $cat)
                            <span class="bv-chip-cat">{{ $cat->name }}</span>
                        @endforeach
                        @if($supplier->categories->count() > 2)
                            <span class="bv-chip-cat">+{{ $supplier->categories->count() - 2 }}</span>
                        @endif
                    </div>

                    {{-- Info rows --}}
                    <div class="bv-sup-info">
                        @if($supplier->business_name)
                        <div class="bv-sup-info-row">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="8" width="12" height="7" rx="1"/><path d="M5 8V6a3 3 0 016 0v2"/></svg>
                            <span class="bv-sup-info-val">{{ $supplier->business_name }}</span>
                        </div>
                        @endif
                        @if($supplier->city || $supplier->province)
                        <div class="bv-sup-info-row">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M8 1.5C5.5 1.5 3.5 3.5 3.5 6c0 3.5 4.5 8.5 4.5 8.5S12.5 9.5 12.5 6c0-2.5-2-4.5-4.5-4.5z"/><circle cx="8" cy="6" r="1.5"/></svg>
                            <span class="bv-sup-info-val">{{ collect([$supplier->city, $supplier->province])->filter()->join(', ') }}</span>
                        </div>
                        @endif
                        @if($supplier->phone)
                        <div class="bv-sup-info-row">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M2 4a1.5 1.5 0 011.5-1.5H5l1.5 3-1.5 1a8 8 0 003.5 3.5l1-1.5 3 1.5v1.5A1.5 1.5 0 0112 13C7 13 2 8.5 2 4z"/></svg>
                            <span class="bv-sup-info-val">{{ $supplier->phone }}</span>
                        </div>
                        @endif
                        @if($supplier->rating)
                        <div class="bv-sup-info-row">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M8 1l2 4.5H15l-4 3 1.5 5L8 11l-4.5 2.5L5 8.5 1 5.5h5z"/></svg>
                            <span class="bv-sup-info-val">{{ number_format($supplier->rating, 1) }} / 5</span>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="bv-sup-card-footer">
                    <button
                        type="button"
                        class="bv-btn-view"
                        onclick="openModal({{ $supplier->id }})"
                    >
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="8" r="3"/><path d="M1 8s2.5-5 7-5 7 5 7 5-2.5 5-7 5-7-5-7-5z"/></svg>
                        View Full Profile
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        @else
        <div class="bv-empty">
            <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
                <rect x="8" y="12" width="32" height="28" rx="3"/>
                <path d="M16 22h16M16 28h10"/>
                <circle cx="36" cy="12" r="6"/>
                <path d="M33 12h6M36 9v6"/>
            </svg>
            <div class="bv-empty-title">No suppliers yet</div>
            <div class="bv-empty-sub">Registered suppliers will appear here</div>
        </div>
        @endif

    </div>

    {{-- ══════════════════════════════
         SUPPLIER MODALS
    ══════════════════════════════ --}}
    @if(isset($supplierProfiles) && $supplierProfiles->count())
        @foreach($supplierProfiles as $supplier)
        <div class="bv-modal-overlay" id="modal-{{ $supplier->id }}" onclick="closeOnBackdrop(event, {{ $supplier->id }})">
            <div class="bv-modal" role="dialog" aria-modal="true">
                <div class="bv-modal-bar"></div>

                {{-- Modal Header --}}
                <div class="bv-modal-header">
                    <div class="bv-modal-avatar">
                        @if($supplier->photo)
                            <img src="{{ asset('storage/' . $supplier->photo) }}" alt="{{ $supplier->first_name }}">
                        @else
                            {{ strtoupper(substr($supplier->first_name, 0, 1) . substr($supplier->last_name, 0, 1)) }}
                        @endif
                    </div>

                    <div class="bv-modal-id">
                        <div class="bv-modal-name">{{ $supplier->first_name }} {{ $supplier->last_name }}</div>
                        @if($supplier->user)
                            <div class="bv-modal-email">{{ $supplier->user->email }}</div>
                        @endif
                        @if($supplier->tagline)
                            <div class="bv-modal-tagline">"{{ $supplier->tagline }}"</div>
                        @endif
                        <div class="bv-modal-chips">
                            @if($supplier->is_available)
                                <span class="bv-chip-avail-yes">● Available</span>
                            @else
                                <span class="bv-chip-avail-no">● Unavailable</span>
                            @endif
                            @foreach($supplier->categories as $cat)
                                <span class="bv-chip-cat">{{ $cat->name }}</span>
                            @endforeach
                        </div>
                    </div>

                    <button class="bv-modal-close" onclick="closeModal({{ $supplier->id }})" aria-label="Close">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 2l10 10M12 2L2 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Modal Body --}}
                <div class="bv-modal-body">

                    {{-- Personal Info --}}
                    <div class="bv-modal-section-title">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="5" r="3"/><path d="M1 13c0-3 2.7-5 6-5s6 2 6 5"/></svg>
                        Personal Information
                    </div>
                    <div class="bv-modal-grid">
                        <div class="bv-modal-field">
                            <div class="bv-modal-field-label">First Name</div>
                            <div class="bv-modal-field-val">{{ $supplier->first_name }}</div>
                        </div>
                        <div class="bv-modal-field">
                            <div class="bv-modal-field-label">Last Name</div>
                            <div class="bv-modal-field-val">{{ $supplier->last_name }}</div>
                        </div>
                        <div class="bv-modal-field">
                            <div class="bv-modal-field-label">Phone</div>
                            <div class="bv-modal-field-val {{ $supplier->phone ? '' : 'muted' }}">{{ $supplier->phone ?? '—' }}</div>
                        </div>
                        <div class="bv-modal-field">
                            <div class="bv-modal-field-label">Email</div>
                            <div class="bv-modal-field-val {{ $supplier->user?->email ? '' : 'muted' }}">{{ $supplier->user?->email ?? '—' }}</div>
                        </div>
                    </div>

                    {{-- Business Info --}}
                    <div class="bv-modal-section-title">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="7" width="10" height="6" rx="1"/><path d="M4 7V5a3 3 0 016 0v2"/></svg>
                        Business Information
                    </div>
                    <div class="bv-modal-grid">
                        <div class="bv-modal-field">
                            <div class="bv-modal-field-label">Business Name</div>
                            <div class="bv-modal-field-val {{ $supplier->business_name ? '' : 'muted' }}">{{ $supplier->business_name ?? '—' }}</div>
                        </div>
                        <div class="bv-modal-field">
                            <div class="bv-modal-field-label">Availability</div>
                            <div class="bv-modal-field-val">
                                @if($supplier->is_available)
                                    <span class="bv-modal-avail-yes"><span class="bv-modal-avail-dot"></span>Available</span>
                                @else
                                    <span class="bv-modal-avail-no"><span class="bv-modal-avail-dot"></span>Unavailable</span>
                                @endif
                            </div>
                        </div>
                        <div class="bv-modal-field">
                            <div class="bv-modal-field-label">Rating</div>
                            <div class="bv-modal-field-val">
                                @if($supplier->rating)
                                    <div class="bv-modal-rating">
                                        <div class="bv-modal-stars">
                                            @for($s = 1; $s <= 5; $s++)
                                                <span class="bv-modal-star {{ $s <= round($supplier->rating) ? 'fill' : 'empty' }}">★</span>
                                            @endfor
                                        </div>
                                        <span class="bv-modal-rating-num">{{ number_format($supplier->rating, 1) }}</span>
                                    </div>
                                @else
                                    <span class="muted">No rating yet</span>
                                @endif
                            </div>
                        </div>
                        <div class="bv-modal-field">
                            <div class="bv-modal-field-label">Categories</div>
                            <div class="bv-modal-field-val {{ $supplier->categories->count() ? '' : 'muted' }}">
                                {{ $supplier->categories->count() ? $supplier->categories->pluck('name')->join(', ') : '—' }}
                            </div>
                        </div>
                    </div>

                    {{-- Location --}}
                    <div class="bv-modal-section-title">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 1C4.8 1 3 2.8 3 5c0 3.2 4 8 4 8s4-4.8 4-8c0-2.2-1.8-4-4-4z"/><circle cx="7" cy="5" r="1.5"/></svg>
                        Location
                    </div>
                    <div class="bv-modal-grid">
                        <div class="bv-modal-field">
                            <div class="bv-modal-field-label">City</div>
                            <div class="bv-modal-field-val {{ $supplier->city ? '' : 'muted' }}">{{ $supplier->city ?? '—' }}</div>
                        </div>
                        <div class="bv-modal-field">
                            <div class="bv-modal-field-label">Province</div>
                            <div class="bv-modal-field-val {{ $supplier->province ? '' : 'muted' }}">{{ $supplier->province ?? '—' }}</div>
                        </div>
                        <div class="bv-modal-field full">
                            <div class="bv-modal-field-label">Full Address</div>
                            <div class="bv-modal-field-val {{ $supplier->address ? '' : 'muted' }}">{{ $supplier->address ?? '—' }}</div>
                        </div>
                    </div>

                    {{-- About --}}
                    @if($supplier->bio || $supplier->description)
                    <div class="bv-modal-section-title">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 4h10M2 7h10M2 10h6"/></svg>
                        About
                    </div>
                    @if($supplier->bio)
                    <div class="bv-modal-field" style="margin-bottom:.75rem;">
                        <div class="bv-modal-field-label" style="margin-bottom:.35rem;">Short Bio</div>
                        <div class="bv-modal-text-block">{{ $supplier->bio }}</div>
                    </div>
                    @endif
                    @if($supplier->description)
                    <div class="bv-modal-field">
                        <div class="bv-modal-field-label" style="margin-bottom:.35rem;">Service Description</div>
                        <div class="bv-modal-text-block">{{ $supplier->description }}</div>
                    </div>
                    @endif
                    @endif

                </div>
            </div>
        </div>
        @endforeach
    @endif

    <script>
    function openModal(id) {
        document.getElementById('modal-' + id).classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeModal(id) {
        document.getElementById('modal-' + id).classList.remove('open');
        document.body.style.overflow = '';
    }
    function closeOnBackdrop(event, id) {
        if (event.target === event.currentTarget) closeModal(id);
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.bv-modal-overlay.open').forEach(el => {
                const id = el.id.replace('modal-', '');
                closeModal(id);
            });
        }
    });
    </script>

</x-app-layout>