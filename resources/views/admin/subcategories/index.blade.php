{{-- resources/views/admin/subcategories/index.blade.php --}}
<x-app-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap');

    :root {
        --gold:      #C9A84C;
        --gold-dark: #A8842A;
        --gold-light:rgba(201,168,76,.1);
        --charcoal:  #1E1B18;
        --warm-grey: #8C8178;
        --border:    #EDE8E2;
        --soft:      #F7F4F0;
        --white:     #FFFFFF;
        --ivory:     #FAF8F5;
        --danger:    #C0392B;
        --danger-bg: #FFF5F5;
        --font-d:    'Playfair Display', Georgia, serif;
        --font-b:    'DM Sans', sans-serif;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    .sc-wrap {
        font-family: var(--font-b);
        color: var(--charcoal);
        padding: 2rem 1.5rem 4rem;
        max-width: 1000px;
        margin: 0 auto;
    }

    /* ── PAGE HEADER ── */
    .sc-page-head {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .sc-page-title {
        font-family: var(--font-d);
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--charcoal);
        line-height: 1.1;
    }
    .sc-page-title em { font-style: italic; color: var(--gold-dark); }
    .sc-page-sub { font-size: .78rem; color: var(--warm-grey); margin-top: .3rem; }

    /* ── ADD BUTTON ── */
    .sc-add-btn {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .62rem 1.35rem;
        border-radius: 8px;
        border: none;
        background: var(--charcoal);
        font-family: var(--font-b);
        font-size: .82rem;
        font-weight: 600;
        color: var(--white);
        cursor: pointer;
        transition: background .2s, box-shadow .2s, transform .15s;
        text-decoration: none;
    }
    .sc-add-btn svg { width: 14px; height: 14px; flex-shrink: 0; }
    .sc-add-btn:hover {
        background: var(--gold-dark);
        box-shadow: 0 4px 14px rgba(168,132,42,.28);
        transform: translateY(-1px);
    }

    /* ── ALERT ── */
    .sc-alert {
        display: flex;
        align-items: center;
        gap: .65rem;
        padding: .85rem 1.1rem;
        border-radius: 10px;
        font-size: .8rem;
        font-weight: 500;
        margin-bottom: 1.25rem;
        border: 1.5px solid;
    }
    .sc-alert.success { background: #F0FBF4; border-color: #A8D5B5; color: #1E6B3C; }
    .sc-alert.error   { background: var(--danger-bg); border-color: #FADBD8; color: var(--danger); }
    .sc-alert svg { width: 15px; height: 15px; flex-shrink: 0; }

    /* ── CARD ── */
    .sc-card {
        background: var(--white);
        border-radius: 14px;
        border: 1px solid var(--border);
        box-shadow: 0 2px 10px rgba(30,27,24,.06);
        overflow: hidden;
    }
    .sc-card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.1rem 1.5rem;
        border-bottom: 1px solid var(--soft);
        background: linear-gradient(to right, rgba(201,168,76,.03), transparent);
    }
    .sc-card-head-l { display: flex; align-items: center; gap: .65rem; }
    .sc-card-icon {
        width: 34px; height: 34px;
        border-radius: 8px;
        background: var(--gold-light);
        display: flex; align-items: center; justify-content: center;
        color: var(--gold-dark);
    }
    .sc-card-icon svg { width: 15px; height: 15px; }
    .sc-card-title { font-family: var(--font-d); font-size: .95rem; font-weight: 700; color: var(--charcoal); }
    .sc-card-sub   { font-size: .7rem; color: var(--warm-grey); margin-top: .04rem; }
    .sc-badge {
        display: inline-flex;
        align-items: center;
        padding: .22rem .75rem;
        border-radius: 999px;
        background: var(--gold-light);
        color: var(--gold-dark);
        font-size: .68rem;
        font-weight: 700;
        letter-spacing: .04em;
    }

    /* ── TABLE ── */
    .sc-table-wrap { overflow-x: auto; }
    .sc-table {
        width: 100%;
        border-collapse: collapse;
        font-size: .84rem;
    }
    .sc-table thead th {
        padding: .8rem 1.5rem;
        text-align: left;
        font-size: .65rem;
        font-weight: 600;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--warm-grey);
        background: var(--ivory);
        border-bottom: 1.5px solid var(--border);
        white-space: nowrap;
    }
    .sc-table tbody tr {
        border-bottom: 1px solid var(--soft);
        transition: background .15s;
    }
    .sc-table tbody tr:last-child { border-bottom: none; }
    .sc-table tbody tr:hover { background: rgba(201,168,76,.03); }
    .sc-table td {
        padding: .9rem 1.5rem;
        color: var(--charcoal);
        vertical-align: middle;
    }

    /* id col */
    .sc-id-cell {
        font-size: .72rem;
        font-weight: 600;
        color: var(--warm-grey);
        font-variant-numeric: tabular-nums;
    }

    /* category pill */
    .sc-cat-pill {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .22rem .7rem;
        border-radius: 999px;
        background: var(--gold-light);
        color: var(--gold-dark);
        font-size: .7rem;
        font-weight: 600;
    }
    .sc-cat-pill::before {
        content: '';
        width: 5px; height: 5px;
        border-radius: 50%;
        background: var(--gold);
    }

    /* subcat name */
    .sc-name-cell { font-weight: 500; }

    /* action buttons */
    .sc-actions { display: flex; align-items: center; gap: .45rem; }
    .sc-btn-edit {
        display: inline-flex; align-items: center; gap: .32rem;
        padding: .36rem .8rem;
        border-radius: 6px;
        border: 1.5px solid var(--border);
        background: var(--white);
        font-family: var(--font-b); font-size: .72rem; font-weight: 500;
        color: var(--charcoal); cursor: pointer;
        transition: border-color .18s, color .18s, background .18s;
    }
    .sc-btn-edit svg { width: 11px; height: 11px; }
    .sc-btn-edit:hover { border-color: var(--gold); color: var(--gold-dark); background: var(--gold-light); }

    .sc-btn-del {
        display: inline-flex; align-items: center; gap: .32rem;
        padding: .36rem .8rem;
        border-radius: 6px;
        border: 1.5px solid #FADBD8;
        background: var(--danger-bg);
        font-family: var(--font-b); font-size: .72rem; font-weight: 500;
        color: var(--danger); cursor: pointer;
        transition: background .18s, border-color .18s, transform .15s;
    }
    .sc-btn-del svg { width: 11px; height: 11px; }
    .sc-btn-del:hover { background: var(--danger); color: var(--white); border-color: var(--danger); transform: translateY(-1px); }

    /* empty state */
    .sc-empty {
        padding: 3.5rem 1.5rem;
        text-align: center;
        color: var(--warm-grey);
    }
    .sc-empty-icon {
        width: 52px; height: 52px;
        border-radius: 50%;
        background: var(--gold-light);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1rem;
        color: var(--gold-dark);
    }
    .sc-empty-icon svg { width: 22px; height: 22px; }
    .sc-empty-title { font-family: var(--font-d); font-size: 1rem; font-weight: 700; color: var(--charcoal); margin-bottom: .35rem; }
    .sc-empty-desc  { font-size: .78rem; line-height: 1.6; }

    /* ── MODALS ── */
    .sc-overlay {
        position: fixed; inset: 0; z-index: 9000;
        background: rgba(20,17,14,.6);
        backdrop-filter: blur(4px);
        display: none; align-items: center; justify-content: center;
        padding: 1rem;
    }
    .sc-overlay.open { display: flex; }
    .sc-modal {
        background: var(--white);
        border-radius: 16px;
        border: 1px solid var(--border);
        box-shadow: 0 14px 52px rgba(20,17,14,.2);
        width: 100%; max-width: 460px;
        overflow: hidden;
        animation: scSlide .22s ease;
    }
    @keyframes scSlide {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .sc-modal-head {
        display: flex; align-items: center; justify-content: space-between;
        padding: 1.15rem 1.5rem;
        border-bottom: 1px solid var(--soft);
    }
    .sc-modal-head-l { display: flex; align-items: center; gap: .65rem; }
    .sc-modal-icon {
        width: 36px; height: 36px;
        border-radius: 9px;
        background: var(--gold-light);
        display: flex; align-items: center; justify-content: center;
        color: var(--gold-dark);
    }
    .sc-modal-icon svg { width: 16px; height: 16px; }
    .sc-modal-title { font-family: var(--font-d); font-size: 1rem; font-weight: 700; color: var(--charcoal); }
    .sc-modal-sub   { font-size: .68rem; color: var(--warm-grey); margin-top: .04rem; }
    .sc-modal-close {
        width: 32px; height: 32px; border-radius: 50%;
        border: 1.5px solid var(--border); background: var(--white);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: var(--warm-grey);
        transition: border-color .15s, color .15s, background .15s;
    }
    .sc-modal-close:hover { border-color: var(--gold); color: var(--gold-dark); background: var(--gold-light); }
    .sc-modal-close svg { width: 12px; height: 12px; }

    .sc-modal-body { padding: 1.4rem 1.5rem; display: flex; flex-direction: column; gap: 1rem; }
    .sc-modal-foot {
        padding: .9rem 1.5rem;
        border-top: 1px solid var(--soft);
        display: flex; align-items: center; justify-content: flex-end; gap: .55rem;
    }

    /* fields */
    .sc-f { display: flex; flex-direction: column; }
    .sc-lbl {
        font-size: .66rem; font-weight: 600;
        letter-spacing: .08em; text-transform: uppercase;
        color: var(--warm-grey); margin-bottom: .38rem;
        display: flex; align-items: center; justify-content: space-between;
    }
    .sc-req { font-size: .58rem; color: var(--danger); font-weight: 500; text-transform: none; letter-spacing: 0; }
    .sc-inp, .sc-sel {
        width: 100%;
        padding: .7rem 1rem;
        background: var(--ivory);
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-family: var(--font-b); font-size: .84rem; color: var(--charcoal);
        outline: none; appearance: none;
        transition: border-color .2s, box-shadow .2s, background .2s;
    }
    .sc-inp:focus, .sc-sel:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(201,168,76,.14);
        background: var(--white);
    }
    .sc-inp::placeholder { color: #C5BCBA; }
    .sc-sw { position: relative; }
    .sc-sw::after {
        content: '';
        position: absolute; right: .9rem; top: 50%; transform: translateY(-50%);
        border-left: 4px solid transparent; border-right: 4px solid transparent;
        border-top: 5px solid #C5BCBA; pointer-events: none;
    }
    .sc-err { font-size: .68rem; color: var(--danger); margin-top: .28rem; }

    /* modal buttons */
    .sc-btn-cancel {
        display: inline-flex; align-items: center; gap: .4rem;
        padding: .6rem 1.15rem; border-radius: 7px;
        border: 1.5px solid var(--border); background: var(--white);
        font-family: var(--font-b); font-size: .8rem; font-weight: 500;
        color: var(--warm-grey); cursor: pointer;
        transition: border-color .2s, color .2s;
    }
    .sc-btn-cancel:hover { border-color: var(--gold); color: var(--charcoal); }
    .sc-btn-submit {
        display: inline-flex; align-items: center; gap: .45rem;
        padding: .6rem 1.45rem; border-radius: 7px; border: none;
        background: var(--charcoal);
        font-family: var(--font-b); font-size: .8rem; font-weight: 600;
        color: var(--white); cursor: pointer;
        transition: background .22s, box-shadow .22s, transform .15s;
    }
    .sc-btn-submit svg { width: 13px; height: 13px; }
    .sc-btn-submit:hover {
        background: var(--gold-dark);
        box-shadow: 0 4px 14px rgba(168,132,42,.28);
        transform: translateY(-1px);
    }

    /* ── CONFIRM DELETE MODAL ── */
    .sc-confirm-modal { max-width: 380px; }
    .sc-confirm-body  { padding: 1.65rem 1.5rem 1rem; text-align: center; }
    .sc-confirm-ico {
        width: 54px; height: 54px; border-radius: 50%;
        background: var(--danger-bg); border: 1.5px solid #FADBD8;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1rem; color: var(--danger);
    }
    .sc-confirm-ico svg { width: 24px; height: 24px; }
    .sc-confirm-title { font-family: var(--font-d); font-size: 1rem; font-weight: 700; color: var(--charcoal); margin-bottom: .4rem; }
    .sc-confirm-desc  { font-size: .8rem; color: var(--warm-grey); line-height: 1.65; }
    .sc-confirm-foot  { padding: .9rem 1.5rem; border-top: 1px solid var(--soft); display: flex; gap: .55rem; justify-content: center; }
    .sc-btn-danger {
        display: inline-flex; align-items: center; gap: .42rem;
        padding: .6rem 1.45rem; border-radius: 7px; border: none;
        background: var(--danger);
        font-family: var(--font-b); font-size: .8rem; font-weight: 600;
        color: var(--white); cursor: pointer;
        transition: background .2s, transform .15s;
    }
    .sc-btn-danger svg { width: 13px; height: 13px; }
    .sc-btn-danger:hover { background: #a93226; transform: translateY(-1px); }

    @media (max-width: 600px) {
        .sc-page-head { flex-direction: column; align-items: flex-start; }
        .sc-table thead th, .sc-table td { padding: .75rem 1rem; }
    }
</style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Subcategories') }}</h2>
    </x-slot>

    <div class="sc-wrap">

        {{-- ── PAGE HEADER ── --}}
        <div class="sc-page-head">
            <div>
                <h1 class="sc-page-title">Manage <em>Subcategories</em></h1>
                <p class="sc-page-sub">Create and organise subcategories for your event services</p>
            </div>
            <button type="button" class="sc-add-btn" onclick="scOpenCreate()">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.2">
                    <line x1="8" y1="2" x2="8" y2="14"/><line x1="2" y1="8" x2="14" y2="8"/>
                </svg>
                Add Subcategory
            </button>
        </div>

        {{-- ── ALERTS ── --}}
        @if(session('success'))
        <div class="sc-alert success">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="2 8 6 12 14 4"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="sc-alert error">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="8" cy="8" r="6"/><line x1="8" y1="5" x2="8" y2="8"/><circle cx="8" cy="11" r=".5" fill="currentColor"/>
            </svg>
            {{ session('error') }}
        </div>
        @endif

        {{-- ── TABLE CARD ── --}}
        <div class="sc-card">
            <div class="sc-card-head">
                <div class="sc-card-head-l">
                    <div class="sc-card-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="3" y="3" width="14" height="14" rx="2"/>
                            <path d="M7 7h6M7 10h6M7 13h4"/>
                        </svg>
                    </div>
                    <div>
                        <div class="sc-card-title">All Subcategories</div>
                        <div class="sc-card-sub">Linked to their parent category</div>
                    </div>
                </div>
                <span class="sc-badge">{{ $subcategories->count() }} total</span>
            </div>

            <div class="sc-table-wrap">
                <table class="sc-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subcategories as $sub)
                        <tr>
                            <td class="sc-id-cell">{{ $sub->id }}</td>
                            <td><span class="sc-cat-pill">{{ $sub->category->name ?? 'N/A' }}</span></td>
                            <td class="sc-name-cell">{{ $sub->name }}</td>
                            <td>
                                <div class="sc-actions">
                                    {{-- Edit --}}
                                    <button type="button" class="sc-btn-edit"
                                            onclick="scOpenEdit({{ $sub->id }}, '{{ addslashes($sub->name) }}', {{ $sub->category_id }})">
                                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                                            <path d="M9 2l3 3-8 8H1v-3L9 2z"/>
                                        </svg>
                                        Edit
                                    </button>
                                    {{-- Delete --}}
                                    <button type="button" class="sc-btn-del"
                                            onclick="scOpenDelete({{ $sub->id }}, '{{ addslashes($sub->name) }}')">
                                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                                            <path d="M2 3.5h10M5 3.5V2.5h4v1M4.5 3.5v7a1 1 0 001 1h3a1 1 0 001-1v-7"/>
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <div class="sc-empty">
                                    <div class="sc-empty-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <rect x="3" y="3" width="18" height="18" rx="3"/>
                                            <path d="M8 12h8M12 8v8"/>
                                        </svg>
                                    </div>
                                    <div class="sc-empty-title">No subcategories yet</div>
                                    <div class="sc-empty-desc">Click "Add Subcategory" to create your first one.</div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>{{-- /sc-wrap --}}


    {{-- ══ CREATE MODAL ══ --}}
    <div class="sc-overlay" id="scCreateOverlay" onclick="if(event.target===this)scCloseCreate()">
        <div class="sc-modal">
            <div class="sc-modal-head">
                <div class="sc-modal-head-l">
                    <div class="sc-modal-icon">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="8" y1="2" x2="8" y2="14"/><line x1="2" y1="8" x2="14" y2="8"/>
                        </svg>
                    </div>
                    <div>
                        <div class="sc-modal-title">New Subcategory</div>
                        <div class="sc-modal-sub">Add to an existing category</div>
                    </div>
                </div>
                <button type="button" class="sc-modal-close" onclick="scCloseCreate()">
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M1 1l10 10M11 1L1 11"/>
                    </svg>
                </button>
            </div>

            <form method="POST" action="{{ route('subcategories.store') }}">
                @csrf
                <div class="sc-modal-body">

                    <div class="sc-f">
                        <label class="sc-lbl" for="c_cat">Category <span class="sc-req">Required</span></label>
                        <div class="sc-sw">
                            <select id="c_cat" name="category_id" class="sc-sel" required>
                                <option value="">— Select category —</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')<div class="sc-err">{{ $message }}</div>@enderror
                    </div>

                    <div class="sc-f">
                        <label class="sc-lbl" for="c_name">Subcategory Name <span class="sc-req">Required</span></label>
                        <input id="c_name" name="name" type="text" class="sc-inp"
                               placeholder="e.g. Outdoor Venue, Fine Dining…"
                               value="{{ old('name') }}" required>
                        @error('name')<div class="sc-err">{{ $message }}</div>@enderror
                    </div>

                </div>
                <div class="sc-modal-foot">
                    <button type="button" class="sc-btn-cancel" onclick="scCloseCreate()">Cancel</button>
                    <button type="submit" class="sc-btn-submit">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 8l4 4 6-6"/>
                        </svg>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- ══ EDIT MODAL ══ --}}
    <div class="sc-overlay" id="scEditOverlay" onclick="if(event.target===this)scCloseEdit()">
        <div class="sc-modal">
            <div class="sc-modal-head">
                <div class="sc-modal-head-l">
                    <div class="sc-modal-icon">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.9">
                            <path d="M11 2l3 3-9 9H2v-3L11 2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="sc-modal-title">Edit Subcategory</div>
                        <div class="sc-modal-sub" id="scEditSub">Updating subcategory</div>
                    </div>
                </div>
                <button type="button" class="sc-modal-close" onclick="scCloseEdit()">
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M1 1l10 10M11 1L1 11"/>
                    </svg>
                </button>
            </div>

            <form method="POST" id="scEditForm">
                @csrf
                @method('PUT')
                <div class="sc-modal-body">

                    <div class="sc-f">
                        <label class="sc-lbl" for="e_cat">Category <span class="sc-req">Required</span></label>
                        <div class="sc-sw">
                            <select id="e_cat" name="category_id" class="sc-sel" required>
                                <option value="">— Select category —</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="sc-f">
                        <label class="sc-lbl" for="e_name">Subcategory Name <span class="sc-req">Required</span></label>
                        <input id="e_name" name="name" type="text" class="sc-inp"
                               placeholder="Subcategory name" required>
                    </div>

                </div>
                <div class="sc-modal-foot">
                    <button type="button" class="sc-btn-cancel" onclick="scCloseEdit()">Cancel</button>
                    <button type="submit" class="sc-btn-submit">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 8l4 4 6-6"/>
                        </svg>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- ══ DELETE CONFIRM MODAL ══ --}}
    <div class="sc-overlay" id="scDeleteOverlay" onclick="if(event.target===this)scCloseDelete()">
        <div class="sc-modal sc-confirm-modal">
            <div class="sc-confirm-body">
                <div class="sc-confirm-ico">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                        <path d="M10 11v6M14 11v6"/>
                        <path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                    </svg>
                </div>
                <div class="sc-confirm-title">Delete Subcategory?</div>
                <div class="sc-confirm-desc">
                    You are about to delete <strong id="scDeleteName"></strong>.
                    This action cannot be undone.
                </div>
            </div>
            <div class="sc-confirm-foot">
                <button type="button" class="sc-btn-cancel" onclick="scCloseDelete()">Keep It</button>
                <form id="scDeleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="sc-btn-danger">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M2 3.5h10M5 3.5V2.5h4v1M4.5 3.5v7a1 1 0 001 1h3a1 1 0 001-1v-7"/>
                        </svg>
                        Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

<script>
/* ── CREATE ── */
function scOpenCreate()  { document.getElementById('scCreateOverlay').classList.add('open'); document.body.style.overflow = 'hidden'; }
function scCloseCreate() { document.getElementById('scCreateOverlay').classList.remove('open'); document.body.style.overflow = ''; }

/* ── EDIT ── */
function scOpenEdit(id, name, catId) {
    const form = document.getElementById('scEditForm');
    form.action = '/subcategories/' + id; // adjust if your route prefix differs

    document.getElementById('e_name').value = name;
    document.getElementById('scEditSub').textContent = 'Editing: ' + name;

    const sel = document.getElementById('e_cat');
    for (let i = 0; i < sel.options.length; i++) {
        sel.options[i].selected = parseInt(sel.options[i].value) === catId;
    }

    document.getElementById('scEditOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function scCloseEdit() { document.getElementById('scEditOverlay').classList.remove('open'); document.body.style.overflow = ''; }

/* ── DELETE ── */
function scOpenDelete(id, name) {
    document.getElementById('scDeleteName').textContent = '"' + name + '"';
    document.getElementById('scDeleteForm').action = '/subcategories/' + id; // adjust if needed
    document.getElementById('scDeleteOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function scCloseDelete() { document.getElementById('scDeleteOverlay').classList.remove('open'); document.body.style.overflow = ''; }

/* ESC closes all */
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') { scCloseCreate(); scCloseEdit(); scCloseDelete(); }
});

/* Auto-open create modal on validation error */
@if($errors->has('name') || $errors->has('category_id'))
    document.addEventListener('DOMContentLoaded', function() { scOpenCreate(); });
@endif
</script>

</x-app-layout>