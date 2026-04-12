<x-supplier-layout>

    {{--
        resources/views/supplier/packages/index.blade.php
        Supplier Package Management — Bikol's Craft bv- admin design system
        Model fields: supplier_id, name, description, price, guest_capacity, event_type
    --}}

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap');

        :root {
            --gold:        #C9A84C;
            --gold-light:  #E8C97A;
            --gold-dark:   #8A6A1F;
            --blush-deep:  #D4A090;
            --ivory:       #FAF7F2;
            --charcoal:    #1E1B18;
            --warm-grey:   #6B6560;
            --white:       #FFFFFF;
            --border:      #F0EBE5;
            --border-md:   #E0D8D0;
            --font-display:'Playfair Display', Georgia, serif;
            --font-body:   'DM Sans', sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-body); background: var(--ivory); color: var(--charcoal); }

        /* ── SUCCESS / ERROR ALERT ── */
        .bv-alert-success {
            display: flex; align-items: center; gap: 0.6rem;
            background: #F0FDF4; color: #15803D;
            border: 1px solid #BBF7D0; border-radius: 4px;
            padding: 0.75rem 1.1rem; font-size: 0.83rem;
            margin: 1.25rem 2rem 0; font-family: var(--font-body);
        }
        .bv-alert-success svg { width: 16px; height: 16px; flex-shrink: 0; }

        /* ── PAGE LAYOUT ── */
        .page-content { padding: 1.75rem 2rem 4rem; max-width: 1200px; }

        /* ── PAGE HEADER ── */
        .bv-page-header {
            display: flex; align-items: flex-start; justify-content: space-between;
            flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;
        }
        .bv-page-title {
            font-family: var(--font-display);
            font-size: clamp(1.3rem, 2.5vw, 1.8rem);
            font-weight: 700; color: var(--charcoal); line-height: 1.15;
        }
        .bv-page-title em { color: var(--gold-dark); font-style: italic; }
        .bv-page-sub { font-size: 0.78rem; color: var(--warm-grey); margin-top: 0.25rem; font-family: var(--font-body); }

        /* ── PRIMARY BUTTON ── */
        .bv-btn-primary {
            display: inline-flex; align-items: center; gap: 0.45rem;
            padding: 0.62rem 1.25rem;
            background: var(--charcoal); color: var(--white);
            border: none; border-radius: 4px;
            font-size: 0.78rem; font-weight: 500; letter-spacing: 0.04em;
            text-transform: uppercase; cursor: pointer; font-family: var(--font-body);
            transition: background 0.18s, transform 0.15s; white-space: nowrap;
            position: relative; overflow: hidden;
        }
        .bv-btn-primary::after { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, #8A6A1F, #C9A84C); opacity: 0; transition: opacity 0.25s; }
        .bv-btn-primary:hover::after { opacity: 1; }
        .bv-btn-primary:hover { transform: translateY(-1px); }
        .bv-btn-primary span, .bv-btn-primary svg { position: relative; z-index: 1; }
        .bv-btn-primary svg { width: 14px; height: 14px; }

        /* ── TABLE CARD ── */
        .bv-card {
            background: var(--white);
            border: 1px solid var(--border); border-radius: 4px;
            overflow: hidden;
        }

        /* ── TABLE ── */
        .bv-table { width: 100%; border-collapse: collapse; font-size: 0.83rem; font-family: var(--font-body); }
        .bv-table thead tr {
            background: rgba(201,168,76,0.04);
            border-bottom: 1px solid var(--border);
        }
        .bv-table thead th {
            padding: 0.75rem 1.1rem;
            font-size: 0.62rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase;
            color: var(--gold-dark); text-align: left; white-space: nowrap;
        }
        .bv-table tbody tr {
            border-bottom: 0.5px solid var(--border);
            transition: background 0.15s;
        }
        .bv-table tbody tr:last-child { border-bottom: none; }
        .bv-table tbody tr:hover { background: rgba(201,168,76,0.03); }
        .bv-table td { padding: 0.85rem 1.1rem; vertical-align: middle; }

        /* Row number */
        .bv-row-num {
            display: inline-flex; align-items: center; justify-content: center;
            width: 24px; height: 24px; border-radius: 3px;
            background: var(--ivory); border: 1px solid var(--border-md);
            font-size: 0.65rem; font-weight: 700; color: var(--warm-grey);
        }

        /* Package name cell */
        .bv-pkg-name {
            display: flex; align-items: center; gap: 0.55rem;
        }
        .bv-pkg-dot {
            width: 7px; height: 7px; border-radius: 50%;
            background: var(--gold); flex-shrink: 0;
            box-shadow: 0 0 0 2px rgba(201,168,76,0.18);
        }
        .bv-pkg-label {
            font-weight: 600; color: var(--charcoal);
            font-family: var(--font-display); font-size: 0.9rem;
        }

        /* Description cell */
        .bv-pkg-desc {
            font-size: 0.78rem; color: var(--warm-grey); max-width: 260px;
            display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden;
        }

        /* Price cell */
        .bv-price-badge {
            display: inline-flex; align-items: center;
            font-family: var(--font-display); font-size: 0.92rem; font-weight: 700;
            color: var(--gold-dark);
        }
        .bv-price-badge .peso { font-size: 0.72rem; font-weight: 500; margin-right: 1px; font-family: var(--font-body); }

        /* Capacity badge */
        .bv-cap-badge {
            display: inline-flex; align-items: center; gap: 4px;
            font-size: 0.72rem; font-weight: 500; color: var(--warm-grey);
            background: var(--ivory); border: 1px solid var(--border-md);
            padding: 3px 9px; border-radius: 2px;
        }
        .bv-cap-badge svg { width: 11px; height: 11px; color: var(--gold-dark); opacity: 0.7; }

        /* Event type chip */
        .bv-event-chip {
            display: inline-flex; align-items: center; gap: 4px;
            font-size: 0.62rem; font-weight: 700; letter-spacing: 0.05em;
            text-transform: uppercase; color: var(--gold-dark);
            background: rgba(201,168,76,0.09); border: 1px solid rgba(201,168,76,0.22);
            padding: 3px 9px; border-radius: 2px; font-family: var(--font-body);
        }

        /* Actions */
        .bv-actions { display: flex; gap: 0.4rem; align-items: center; }
        .bv-btn-edit {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 0.35rem 0.8rem; border-radius: 3px;
            border: 1px solid var(--border-md); background: var(--white);
            font-size: 0.68rem; font-weight: 500; letter-spacing: 0.03em;
            color: var(--warm-grey); cursor: pointer; font-family: var(--font-body);
            text-decoration: none; transition: border-color 0.18s, color 0.18s;
        }
        .bv-btn-edit svg { width: 12px; height: 12px; }
        .bv-btn-edit:hover { border-color: var(--gold); color: var(--gold-dark); }

        .bv-btn-delete {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 0.35rem 0.8rem; border-radius: 3px;
            border: 1px solid #FCA5A5; background: transparent;
            font-size: 0.68rem; font-weight: 500; letter-spacing: 0.03em;
            color: #B91C1C; cursor: pointer; font-family: var(--font-body);
            transition: background 0.18s;
        }
        .bv-btn-delete svg { width: 12px; height: 12px; }
        .bv-btn-delete:hover { background: #FEF2F2; }

        /* ── EMPTY STATE ── */
        .bv-empty {
            text-align: center; padding: 4.5rem 2rem;
        }
        .bv-empty svg { width: 52px; height: 52px; color: var(--gold); opacity: 0.25; margin: 0 auto 1.1rem; display: block; }
        .bv-empty-title { font-family: var(--font-display); font-size: 1.15rem; font-weight: 600; color: var(--charcoal); margin-bottom: 0.35rem; }
        .bv-empty-sub { font-size: 0.83rem; color: var(--warm-grey); font-family: var(--font-body); line-height: 1.65; }

        /* ── MODAL BACKDROP ── */
        .bv-modal-backdrop {
            display: none;
            position: fixed; inset: 0;
            background: rgba(30,27,24,0.52);
            z-index: 200;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            backdrop-filter: blur(3px);
        }
        .bv-modal-backdrop.open { display: flex; }

        /* ── MODAL BOX — KEY FIX ──
           Use a fixed max-height with overflow hidden on the box itself,
           so the footer is always visible and never gets pushed off screen.
        ── */
        .bv-modal {
            background: var(--white);
            border-radius: 4px;
            width: 540px;
            max-width: 100%;
            border-top: 2px solid var(--gold);
            /* Fixed height so flex children can calculate correctly */
            height: auto;
            max-height: calc(100vh - 3rem);
            display: flex;
            flex-direction: column;
            /* overflow: hidden keeps the rounded corners and
               prevents the box itself from growing past max-height */
            overflow: hidden;
            margin: auto;
            flex-shrink: 0;
            box-shadow: 0 20px 60px rgba(30,27,24,0.22);
        }
        .bv-modal-header {
            /* flex-shrink: 0 ensures header never collapses */
            flex-shrink: 0;
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid var(--border);
            background: var(--white);
        }
        .bv-modal-title {
            font-family: var(--font-display); font-size: 1.1rem; font-weight: 600; color: var(--charcoal);
        }
        .bv-modal-title em { font-style: italic; color: var(--gold-dark); }
        .bv-modal-close {
            width: 28px; height: 28px; border: 1px solid var(--border); background: var(--ivory);
            border-radius: 3px; cursor: pointer; font-size: 15px; color: var(--warm-grey);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
            transition: border-color 0.18s, color 0.18s;
        }
        .bv-modal-close:hover { border-color: var(--gold); color: var(--gold-dark); }

        /* ── MODAL BODY — scrolls independently ── */
        .bv-modal-body {
            padding: 1.4rem 1.5rem;
            overflow-y: auto;   /* only this region scrolls */
            flex: 1;            /* takes all space between header and footer */
            min-height: 0;      /* required for flex children to shrink below natural height */
            background: var(--white);
        }
        .bv-modal-body::-webkit-scrollbar { width: 4px; }
        .bv-modal-body::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }

        /* ── FORM FIELDS ── */
        .bv-field { margin-bottom: 1rem; }
        .bv-field:last-child { margin-bottom: 0; }
        .bv-field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem; }
        @media (max-width: 480px) { .bv-field-row { grid-template-columns: 1fr; } }

        .bv-label {
            display: flex; align-items: center; justify-content: space-between;
            font-size: 0.65rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase;
            color: var(--warm-grey); margin-bottom: 0.4rem; font-family: var(--font-body);
        }
        .bv-label-req { font-size: 0.6rem; color: #C0392B; font-weight: 500; text-transform: none; letter-spacing: 0; }
        .bv-label-opt { font-size: 0.6rem; color: #C0B8B0; font-weight: 400; text-transform: none; letter-spacing: 0; }

        .bv-input-wrap { position: relative; }
        .bv-input-icon {
            position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%);
            width: 13px; height: 13px; color: #C0B8B0; pointer-events: none; transition: color 0.2s;
        }
        .bv-input-wrap:focus-within .bv-input-icon { color: var(--gold-dark); }

        .bv-input, .bv-select, .bv-textarea {
            width: 100%; border: 1.5px solid var(--border); border-radius: 6px;
            font-family: var(--font-body); font-size: 0.84rem; color: var(--charcoal);
            background: var(--ivory); outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }
        .bv-input { padding: 0.65rem 0.85rem 0.65rem 2.4rem; display: block; }
        .bv-input.no-icon { padding-left: 0.85rem; }
        .bv-input:focus, .bv-select:focus, .bv-textarea:focus {
            border-color: var(--gold); background: var(--white);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.12);
        }
        .bv-input::placeholder, .bv-textarea::placeholder { color: #C0B8B0; }

        .bv-select {
            padding: 0.65rem 2.2rem 0.65rem 0.85rem;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' fill='none' stroke='%23C0B8B0' stroke-width='1.5'%3E%3Cpath d='M1 1l4 4 4-4'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 0.8rem center;
        }

        .bv-textarea { padding: 0.65rem 0.85rem; resize: vertical; min-height: 85px; }

        .bv-hint  { font-size: 0.65rem; color: #C0B8B0; margin-top: 0.25rem; font-family: var(--font-body); }
        .bv-error { font-size: 0.65rem; color: #C0392B; margin-top: 0.25rem; font-family: var(--font-body); }

        /* Section divider inside modal */
        .bv-modal-section {
            font-size: 0.58rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase;
            color: #C0B8B0; padding-bottom: 0.5rem; border-bottom: 1px solid var(--border);
            margin-bottom: 1rem; display: flex; align-items: center; gap: 0.4rem;
            font-family: var(--font-body);
        }
        .bv-modal-section svg { width: 10px; height: 10px; color: var(--gold-dark); }

        /* ── MODAL FOOTER — KEY FIX ──
           flex-shrink: 0 pins the footer so it never gets squeezed out.
           explicit background ensures it's never transparent.
        ── */
        .bv-modal-footer {
            flex-shrink: 0;
            padding: 0.9rem 1.5rem;
            border-top: 1px solid var(--border);
            display: flex; gap: 0.5rem; justify-content: flex-end;
            background: var(--white);  /* explicit — prevents transparency bleed */
        }
        .bv-btn-cancel {
            padding: 0.6rem 1.1rem; border-radius: 4px;
            border: 1px solid var(--border-md); background: var(--white);
            font-size: 0.78rem; font-weight: 500; color: var(--warm-grey);
            cursor: pointer; font-family: var(--font-body);
            transition: border-color 0.18s, color 0.18s;
        }
        .bv-btn-cancel:hover { border-color: var(--gold); color: var(--charcoal); }
        .bv-btn-save {
            padding: 0.6rem 1.4rem; border-radius: 4px;
            border: none; background: var(--gold); color: var(--charcoal);
            font-size: 0.78rem; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase;
            cursor: pointer; font-family: var(--font-body);
            transition: background 0.18s, transform 0.15s;
        }
        .bv-btn-save:hover { background: var(--gold-light); transform: translateY(-1px); }

        /* ── SUMMARY STAT CARDS ── */
        .bv-stat-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem; }
        @media (max-width: 640px) { .bv-stat-row { grid-template-columns: 1fr 1fr; } }
        .bv-stat-card {
            background: var(--white); border: 1px solid var(--border); border-radius: 4px;
            padding: 1.1rem 1.25rem; position: relative; overflow: hidden;
        }
        .bv-stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, var(--gold), var(--blush-deep)); }
        .bv-stat-n { font-family: var(--font-display); font-size: 1.8rem; font-weight: 700; color: var(--gold-dark); line-height: 1; }
        .bv-stat-l { font-size: 0.62rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); margin-top: 3px; font-family: var(--font-body); }

        /* Responsive table scroll */
        .bv-table-wrap { overflow-x: auto; }

        /* Reveal */
        .reveal { opacity: 0; transform: translateY(12px); transition: opacity 0.45s ease, transform 0.45s ease; }
        .reveal.visible { opacity: 1; transform: none; }

        @media (max-width: 700px) {
            .page-content { padding: 1.25rem 1rem 3rem; }
            .bv-alert-success { margin: 1rem 1rem 0; }
        }
    </style>

    {{-- Success message --}}
    @if(session('success'))
    <div class="bv-alert-success">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M5 10l4 4 6-6"/>
            <circle cx="10" cy="10" r="8"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

<div class="page-content">

    {{-- Page header --}}
    <div class="bv-page-header">
        <div>
            <h1 class="bv-page-title">My <em>Packages</em></h1>
            <p class="bv-page-sub">Create and manage your service packages for clients.</p>
        </div>
        <button onclick="openModal('add')" class="bv-btn-primary">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
                <path d="M10 4v12M4 10h12"/>
            </svg>
            <span>Add Package</span>
        </button>
    </div>

    {{-- Stat cards --}}
    @if(isset($packages) && $packages->count())
    <div class="bv-stat-row reveal">
        <div class="bv-stat-card">
            <div class="bv-stat-n">{{ $packages->count() }}</div>
            <div class="bv-stat-l">Total Packages</div>
        </div>
        <div class="bv-stat-card">
            <div class="bv-stat-n">₱{{ number_format($packages->avg('price') ?? 0, 0) }}</div>
            <div class="bv-stat-l">Avg. Price</div>
        </div>
        <div class="bv-stat-card">
            <div class="bv-stat-n">{{ number_format($packages->avg('guest_capacity') ?? 0, 0) }}</div>
            <div class="bv-stat-l">Avg. Capacity</div>
        </div>
    </div>
    @endif

    {{-- Table card --}}
    <div class="bv-card reveal">
        @if(isset($packages) && $packages->count())
        <div class="bv-table-wrap">
        <table class="bv-table">
            <thead>
                <tr>
                    <th style="width:48px">#</th>
                    <th>Package Name</th>
                    <th>Event Type</th>
                    <th>Price</th>
                    <th>Guest Capacity</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $i => $package)
                <tr>
                    <td><span class="bv-row-num">{{ $i + 1 }}</span></td>

                    <td>
                        <div class="bv-pkg-name">
                            <span class="bv-pkg-dot"></span>
                            <span class="bv-pkg-label">{{ $package->name }}</span>
                        </div>
                    </td>

                    <td>
                        @if($package->event_type)
                            <span class="bv-event-chip">{{ $package->event_type }}</span>
                        @else
                            <span style="color:#C0B8B0;font-size:0.75rem;">—</span>
                        @endif
                    </td>

                    <td>
                        @if($package->price)
                            <span class="bv-price-badge">
                                <span class="peso">₱</span>{{ number_format($package->price, 2) }}
                            </span>
                        @else
                            <span style="color:#C0B8B0;font-size:0.75rem;">—</span>
                        @endif
                    </td>

                    <td>
                        @if($package->guest_capacity)
                            <span class="bv-cap-badge">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                                </svg>
                                {{ number_format($package->guest_capacity) }} guests
                            </span>
                        @else
                            <span style="color:#C0B8B0;font-size:0.75rem;">—</span>
                        @endif
                    </td>

                    <td>
                        <span class="bv-pkg-desc" title="{{ $package->description }}">
                            {{ $package->description ? Str::limit($package->description, 60) : '—' }}
                        </span>
                    </td>

                    <td>
                        <div class="bv-actions">
                            <button type="button" class="bv-btn-edit"
                                onclick="openEditModal(
                                    {{ $package->id }},
                                    '{{ addslashes($package->name) }}',
                                    '{{ addslashes($package->description ?? '') }}',
                                    '{{ $package->price ?? '' }}',
                                    '{{ $package->guest_capacity ?? '' }}',
                                    '{{ addslashes($package->event_type ?? '') }}'
                                )">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M11.5 2.5l2 2L5 13H3v-2L11.5 2.5z"/>
                                </svg>
                                Edit
                            </button>

                            <form method="POST"
                                  action="{{ route('supplier.package.destroy', $package->id) }}"
                                  style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bv-btn-delete"
                                    onclick="return confirm('Delete package \'{{ addslashes($package->name) }}\'? This cannot be undone.')">
                                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <path d="M3 4h10M6 4V3h4v1M5 4v8a1 1 0 001 1h4a1 1 0 001-1V4"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>

        @else
        <div class="bv-empty">
            <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
                <rect x="8" y="10" width="32" height="30" rx="3"/>
                <path d="M16 20h16M16 27h10M24 4v6M18 4l6 6 6-6"/>
            </svg>
            <div class="bv-empty-title">No packages yet</div>
            <p class="bv-empty-sub">
                Click <strong>Add Package</strong> to create your first service package for clients.
            </p>
        </div>
        @endif
    </div>

</div>{{-- end page-content --}}


{{-- ════════════════════════════════
     ADD / EDIT PACKAGE MODAL
════════════════════════════════ --}}
<div id="packageModal" class="bv-modal-backdrop">
    <div class="bv-modal">

        <div class="bv-modal-header">
            <span class="bv-modal-title" id="modal-title">Add <em>Package</em></span>
            <button class="bv-modal-close" onclick="closeModal()">✕</button>
        </div>

        {{-- form wraps only body+footer; display:contents keeps flex layout intact --}}
        <form method="POST" id="package-form" action="{{ route('supplier.package.store') }}"
              style="display:contents;">
            @csrf
            <span id="method-field"></span>{{-- filled by JS for PUT --}}

            <div class="bv-modal-body">

                {{-- ─ Basic Info ─ --}}
                <div class="bv-modal-section">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                        <rect x="2" y="2" width="10" height="10" rx="2"/>
                        <path d="M5 7h4M7 5v4"/>
                    </svg>
                    Package Details
                </div>

                {{-- Name --}}
                <div class="bv-field">
                    <label class="bv-label" for="pkg_name">
                        Package Name <span class="bv-label-req">Required</span>
                    </label>
                    <div class="bv-input-wrap">
                        <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="3" y="5" width="14" height="11" rx="2"/>
                            <path d="M7 9h6M7 12h4"/>
                        </svg>
                        <input id="pkg_name" name="name" type="text" class="bv-input"
                               placeholder="e.g. Gold Wedding Package, Debut Deluxe…" required>
                    </div>
                    @error('name')<div class="bv-error">{{ $message }}</div>@enderror
                </div>

                {{-- Event Type --}}
                <div class="bv-field">
                    <label class="bv-label" for="pkg_event_type">
                        Event Type <span class="bv-label-opt">Optional</span>
                    </label>
                    <div class="bv-input-wrap">
                        <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="3" y="4" width="14" height="13" rx="2"/>
                            <path d="M7 2v4M13 2v4M3 9h14"/>
                        </svg>
                        <select id="pkg_event_type" name="event_type" class="bv-input" required>
                            <option value="" disabled {{ old('event_type') ? '' : 'selected' }}>Select a Event type...</option>
                                @foreach($eventcategories as $eventcategories)
                                    <option value="{{ $eventcategories->name }}"
                                        {{ old('') == $eventcategories->name? 'selected' : '' }}>
                                        {{ $eventcategories->name }}
                                    </option>
                                @endforeach
                        </select>
                    </div>
                    <p class="bv-hint">The type of event this package is designed for.</p>
                    @error('event_type')<div class="bv-error">{{ $message }}</div>@enderror
                </div>

                {{-- ─ Pricing & Capacity ─ --}}
                <div class="bv-modal-section" style="margin-top:1.25rem;">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="7" cy="7" r="5.5"/>
                        <path d="M7 3v8M5 5.5h3a1 1 0 010 2H5.5a1 1 0 000 2H9"/>
                    </svg>
                    Pricing & Capacity
                </div>

                <div class="bv-field-row">
                    {{-- Price --}}
                    <div class="bv-field" style="margin-bottom:0;">
                        <label class="bv-label" for="pkg_price">
                            Price (₱) <span class="bv-label-opt">Optional</span>
                        </label>
                        <div class="bv-input-wrap">
                            <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <line x1="10" y1="2" x2="10" y2="18"/>
                                <path d="M14 6H8a2 2 0 000 4h4a2 2 0 010 4H6"/>
                            </svg>
                            <input id="pkg_price" name="price" type="number" step="0.01" min="0"
                                   class="bv-input" placeholder="e.g. 25000">
                        </div>
                        @error('price')<div class="bv-error">{{ $message }}</div>@enderror
                    </div>

                    {{-- Guest Capacity --}}
                    <div class="bv-field" style="margin-bottom:0;">
                        <label class="bv-label" for="pkg_capacity">
                            Guest Capacity <span class="bv-label-opt">Optional</span>
                        </label>
                        <div class="bv-input-wrap">
                            <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M13 17v-1a4 4 0 00-4-4H5a4 4 0 00-4 4v1"/>
                                <circle cx="7" cy="7" r="4"/>
                                <path d="M18 17v-1a4 4 0 00-3-3.87M15 3.13a4 4 0 010 7.75"/>
                            </svg>
                            <input id="pkg_capacity" name="guest_capacity" type="number" min="1"
                                   class="bv-input" placeholder="e.g. 150">
                        </div>
                        @error('guest_capacity')<div class="bv-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- ─ Description ─ --}}
                <div class="bv-modal-section" style="margin-top:1.25rem;">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M2 4h10M2 7h8M2 10h6"/>
                    </svg>
                    Description
                </div>

                <div class="bv-field" style="margin-bottom:0;">
                    <label class="bv-label" for="pkg_desc">
                        Package Description <span class="bv-label-opt">Optional</span>
                    </label>
                    <textarea id="pkg_desc" name="description" class="bv-textarea"
                              placeholder="Describe what's included — catering, decor, hours, add-ons…"
                              maxlength="1000" oninput="updateCount(this)"></textarea>
                    <div style="display:flex;justify-content:flex-end;margin-top:4px;">
                        <span id="desc-count" style="font-size:0.62rem;color:#C0B8B0;font-family:var(--font-body);">0 / 1000</span>
                    </div>
                    @error('description')<div class="bv-error">{{ $message }}</div>@enderror
                </div>

            </div>{{-- end modal-body --}}

            <div class="bv-modal-footer">
                <button type="button" class="bv-btn-cancel" onclick="closeModal()">Cancel</button>
                <button type="submit" class="bv-btn-save">Save Package</button>
            </div>

        </form>
    </div>
</div>

<script>
    /* ── MODAL OPEN / CLOSE ── */
    function openModal(mode) {
        const modal = document.getElementById('packageModal');
        const form  = document.getElementById('package-form');
        const title = document.getElementById('modal-title');
        const mf    = document.getElementById('method-field');

        // Reset form
        form.action = '{{ route('supplier.package.store') }}';
        form.reset();
        mf.innerHTML = '';
        title.innerHTML = 'Add <em>Package</em>';
        document.getElementById('desc-count').textContent = '0 / 1000';

        modal.classList.add('open');
        document.body.style.overflow = 'hidden';
        setTimeout(() => document.getElementById('pkg_name').focus(), 80);
    }

    function openEditModal(id, name, desc, price, capacity, eventType) {
        const modal = document.getElementById('packageModal');
        const form  = document.getElementById('package-form');
        const title = document.getElementById('modal-title');
        const mf    = document.getElementById('method-field');

        // Set form action to update route
        form.action = '/supplier/packages/' + id;
        mf.innerHTML = '<input type="hidden" name="_method" value="PUT">';
        title.innerHTML = 'Edit <em>Package</em>';

        // Populate fields
        document.getElementById('pkg_name').value       = name;
        document.getElementById('pkg_desc').value       = desc;
        document.getElementById('pkg_price').value      = price;
        document.getElementById('pkg_capacity').value   = capacity;
        document.getElementById('pkg_event_type').value = eventType;
        document.getElementById('desc-count').textContent = desc.length + ' / 1000';

        modal.classList.add('open');
        document.body.style.overflow = 'hidden';
        setTimeout(() => document.getElementById('pkg_name').focus(), 80);
    }

    function closeModal() {
        document.getElementById('packageModal').classList.remove('open');
        document.body.style.overflow = '';
    }

    // Close on backdrop click
    document.getElementById('packageModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    // Close on Esc
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

    /* ── CHAR COUNTER ── */
    function updateCount(el) {
        document.getElementById('desc-count').textContent = el.value.length + ' / 1000';
    }

    /* ── AUTO-OPEN MODAL ON VALIDATION ERROR ── */
    @if($errors->has('name') || $errors->has('description') || $errors->has('price') || $errors->has('guest_capacity') || $errors->has('event_type'))
        window.addEventListener('DOMContentLoaded', () => openModal('add'));
    @endif

    // Re-populate on error (old values)
    @if($errors->any() && old('name'))
        window.addEventListener('DOMContentLoaded', () => {
            document.getElementById('pkg_name').value       = '{{ addslashes(old('name', '')) }}';
            document.getElementById('pkg_desc').value       = '{{ addslashes(old('description', '')) }}';
            document.getElementById('pkg_price').value      = '{{ old('price', '') }}';
            document.getElementById('pkg_capacity').value   = '{{ old('guest_capacity', '') }}';
            document.getElementById('pkg_event_type').value = '{{ addslashes(old('event_type', '')) }}';
            const ta = document.getElementById('pkg_desc');
            document.getElementById('desc-count').textContent = ta.value.length + ' / 1000';
        });
    @endif

    /* ── SCROLL REVEAL ── */
    const io = new IntersectionObserver(entries => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 60);
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.07 });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));
</script>

</x-supplier-layout>