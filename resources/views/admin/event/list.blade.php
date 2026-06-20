<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event Categories') }}
        </h2>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap');

        :root {
            --charcoal:   #1E1B18;
            --ivory:      #FAF7F2;
            --white:      #FFFFFF;
            --gold:       #C9A84C;
            --gold-dark:  #A8832A;
            --gold-light: #F2E4BC;
            --warm-grey:  #8A7F72;
            --border:     #EDE8E1;
            --font-display: 'Cormorant Garamond', Georgia, serif;
            --font-body:    'DM Sans', sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body, .page-content { font-family: var(--font-body); }

        /* ── Page wrapper ── */
        .ec-wrap {
            padding: 2rem 2.5rem;
            min-height: 100vh;
            background: var(--ivory);
        }

        /* ── Page header ── */
        .ec-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 2.2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .ec-title {
            font-family: var(--font-display);
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--charcoal);
            line-height: 1.1;
        }
        .ec-title em { font-style: italic; color: var(--gold-dark); }
        .ec-sub {
            font-size: 0.78rem;
            color: var(--warm-grey);
            margin-top: 0.35rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        /* ── Add button ── */
        .ec-btn-add {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--charcoal);
            color: var(--white);
            font-family: var(--font-body);
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            text-decoration: none;
        }
        .ec-btn-add:hover {
            background: var(--gold-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(168,131,42,0.3);
        }
        .ec-btn-add svg { width: 14px; height: 14px; }

        /* ── Alert ── */
        .ec-alert {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            background: #F0FDF4;
            border: 1px solid #A7F3D0;
            border-radius: 8px;
            padding: 0.8rem 1rem;
            font-size: 0.82rem;
            color: #065F46;
            margin-bottom: 1.8rem;
        }
        .ec-alert svg { width: 16px; height: 16px; color: #10B981; flex-shrink: 0; }

        /* ── Stats bar ── */
        .ec-stats {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.78rem;
            color: var(--warm-grey);
        }
        .ec-stats-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--gold-light);
            color: var(--gold-dark);
            font-weight: 600;
            font-size: 0.72rem;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            letter-spacing: 0.03em;
        }

        /* ── Card grid ── */
        .ec-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
            gap: 1.4rem;
        }

        /* ── Individual card ── */
        .ec-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--border);
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(30,27,24,0.05);
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            flex-direction: column;
        }
        .ec-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(30,27,24,0.1);
        }

        /* Photo area */
        .ec-card-photo {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
            background: var(--ivory);
        }
        .ec-card-photo-placeholder {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, #F2EBE0 0%, #EDE4D5 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            color: #C0B0A0;
        }
        .ec-card-photo-placeholder svg { width: 36px; height: 36px; }
        .ec-card-photo-placeholder span {
            font-size: 0.7rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 500;
        }

        /* Card body */
        .ec-card-body {
            padding: 1.1rem 1.2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .ec-card-row-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px; height: 22px;
            background: var(--gold-light);
            border-radius: 50%;
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--gold-dark);
            flex-shrink: 0;
        }
        .ec-card-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .ec-card-name {
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--charcoal);
            line-height: 1.2;
            flex: 1;
        }
        .ec-card-desc {
            font-size: 0.8rem;
            color: var(--warm-grey);
            line-height: 1.55;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Card footer actions */
        .ec-card-footer {
            display: flex;
            gap: 0.5rem;
            padding: 0.85rem 1.2rem;
            border-top: 1px solid var(--border);
            background: var(--ivory);
        }
        .ec-btn-edit {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.5rem 0.8rem;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.03em;
            border-radius: 7px;
            border: 1.5px solid var(--border);
            background: var(--white);
            color: var(--charcoal);
            text-decoration: none;
            cursor: pointer;
            font-family: var(--font-body);
            transition: border-color 0.2s, color 0.2s, background 0.2s;
        }
        .ec-btn-edit svg { width: 12px; height: 12px; }
        .ec-btn-edit:hover {
            border-color: var(--gold);
            color: var(--gold-dark);
            background: rgba(201,168,76,0.06);
        }
        .ec-btn-delete {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.5rem 0.8rem;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.03em;
            border-radius: 7px;
            border: 1.5px solid #FADBD8;
            background: var(--white);
            color: #C0392B;
            cursor: pointer;
            font-family: var(--font-body);
            transition: border-color 0.2s, background 0.2s;
        }
        .ec-btn-delete svg { width: 12px; height: 12px; }
        .ec-btn-delete:hover { border-color: #C0392B; background: #FFF5F5; }

        /* ── Empty state ── */
        .ec-empty {
            grid-column: 1/-1;
            text-align: center;
            padding: 5rem 2rem;
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--border);
        }
        .ec-empty svg { width: 52px; height: 52px; color: #D8CFC5; margin: 0 auto 1.2rem; display: block; }
        .ec-empty-title {
            font-family: var(--font-display);
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--charcoal);
            margin-bottom: 0.4rem;
        }
        .ec-empty-sub { font-size: 0.82rem; color: var(--warm-grey); }

        /* ── MODAL shared ── */
        .ec-backdrop {
            position: fixed; inset: 0;
            background: rgba(20,17,14,0.55);
            backdrop-filter: blur(5px);
            z-index: 600;
            display: none;
            align-items: flex-start;       /* top-align so tall content isn't clipped */
            justify-content: center;
            padding: 1.5rem 1rem;
            overflow-y: auto;              /* backdrop scrolls, not the modal */
        }
        .ec-backdrop.open {
            display: flex;
            animation: ecFadeIn 0.2s ease;
        }
        .ec-modal {
            background: var(--white);
            border-radius: 16px;
            width: 100%;
            max-width: 490px;
            box-shadow: 0 28px 72px rgba(20,17,14,0.22);
            /* NO overflow:hidden — let content grow naturally */
            animation: ecSlideUp 0.25s ease;
            display: flex;
            flex-direction: column;
            margin: auto;                  /* vertically centers when content is short */
        }

        /* Sticky header stays visible while body scrolls */
        .ec-modal-header {
            position: sticky;
            top: 0;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.4rem 1.6rem 1.2rem;
            border-bottom: 1px solid var(--border);
            background: var(--white);
            border-radius: 16px 16px 0 0;
        }
        .ec-modal-title {
            font-family: var(--font-display);
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--charcoal);
        }
        .ec-modal-title em { font-style: italic; color: var(--gold-dark); }
        .ec-modal-close {
            width: 30px; height: 30px;
            border-radius: 7px;
            border: 1px solid var(--border);
            background: var(--ivory);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            color: var(--warm-grey);
            font-size: 1rem; line-height: 1;
            transition: background 0.2s, color 0.2s;
            flex-shrink: 0;
        }
        .ec-modal-close:hover { background: #F0EBE5; color: var(--charcoal); }

        /* Scrollable body area */
        .ec-modal-body {
            padding: 1.5rem 1.6rem;
            overflow: visible;             /* backdrop handles scrolling */
        }

        /* Sticky footer stays visible while body scrolls */
        .ec-modal-footer {
            position: sticky;
            bottom: 0;
            z-index: 10;
            padding: 1rem 1.6rem 1.4rem;
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            background: var(--white);
            border-top: 1px solid var(--border);
            border-radius: 0 0 16px 16px;
        }

        /* Form */
        .ec-field { margin-bottom: 1.1rem; }
        .ec-field:last-child { margin-bottom: 0; }
        .ec-label {
            display: block;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            color: var(--warm-grey);
            margin-bottom: 0.45rem;
        }
        .ec-input,
        .ec-textarea {
            width: 100%;
            padding: 0.65rem 0.9rem;
            background: var(--ivory);
            border: 1.5px solid #E5DDD5;
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.85rem;
            color: var(--charcoal);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }
        .ec-input:focus,
        .ec-textarea:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.13);
            background: var(--white);
        }
        .ec-input::placeholder,
        .ec-textarea::placeholder { color: #C0B8B0; }
        .ec-textarea { resize: vertical; min-height: 90px; }

        /* Photo preview in modal */
        .ec-photo-preview-wrap {
            margin-top: 0.65rem;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid var(--border);
            background: var(--ivory);
        }
        .ec-photo-preview {
            width: 100%;
            height: 130px;
            object-fit: cover;
            display: block;
        }

        /* Buttons */
        .ec-btn-cancel {
            padding: 0.62rem 1.2rem;
            border-radius: 7px;
            border: 1.5px solid var(--border);
            background: var(--white);
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--warm-grey);
            cursor: pointer;
            transition: border-color 0.2s, color 0.2s;
        }
        .ec-btn-cancel:hover { border-color: var(--gold); color: var(--charcoal); }
        .ec-btn-save {
            padding: 0.62rem 1.6rem;
            border-radius: 7px;
            border: none;
            background: var(--charcoal);
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.03em;
            color: var(--white);
            cursor: pointer;
            transition: background 0.2s, box-shadow 0.2s;
        }
        .ec-btn-save:hover {
            background: var(--gold-dark);
            box-shadow: 0 4px 14px rgba(168,131,42,0.25);
        }

        /* Delete modal specific */
        .ec-delete-icon {
            width: 54px; height: 54px;
            background: #FFF0EE;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }
        .ec-delete-icon svg { width: 24px; height: 24px; color: #C0392B; }
        .ec-delete-text { text-align: center; }
        .ec-delete-text h3 {
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--charcoal);
            margin-bottom: 0.4rem;
        }
        .ec-delete-text p { font-size: 0.82rem; color: var(--warm-grey); line-height: 1.5; }
        .ec-delete-text strong { color: var(--charcoal); }
        .ec-btn-confirm-delete {
            padding: 0.62rem 1.6rem;
            border-radius: 7px;
            border: none;
            background: #C0392B;
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--white);
            cursor: pointer;
            transition: background 0.2s, box-shadow 0.2s;
        }
        .ec-btn-confirm-delete:hover {
            background: #A93226;
            box-shadow: 0 4px 14px rgba(192,57,43,0.3);
        }

        /* Divider in delete modal */
        .ec-delete-divider {
            height: 1px;
            background: var(--border);
            margin: 1.2rem 0;
        }

        @keyframes ecFadeIn  { from { opacity: 0; } to { opacity: 1; } }
        @keyframes ecSlideUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 640px) {
            .ec-wrap { padding: 1.2rem 1rem; }
            .ec-grid { grid-template-columns: 1fr 1fr; gap: 1rem; }
            .ec-title { font-size: 1.7rem; }
        }
        @media (max-width: 420px) {
            .ec-grid { grid-template-columns: 1fr; }
        }
    </style>

    <div class="ec-wrap">

        {{-- Alert --}}
        @if(session('success'))
        <div class="ec-alert">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        {{-- Page header --}}
        <div class="ec-header">
            <div>
                <h1 class="ec-title">Event <em>Categories</em></h1>
                <p class="ec-sub">Manage your event types &amp; categories</p>
            </div>
            <button onclick="openAddModal()" class="ec-btn-add">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
                    <path d="M10 4v12M4 10h12"/>
                </svg>
                Add Category
            </button>
        </div>

        {{-- Stats --}}
        @if(isset($eventcategories) && $eventcategories->count())
        <div class="ec-stats">
            <span class="ec-stats-count">{{ $eventcategories->count() }}</span>
            <span>{{ $eventcategories->count() === 1 ? 'category' : 'categories' }} total</span>
        </div>
        @endif

        {{-- Card grid --}}
        <div class="ec-grid">
            @if(isset($eventcategories) && $eventcategories->count())
                @foreach($eventcategories as $i => $category)
                <div class="ec-card">

                    {{-- Photo --}}
                    @if($category->photo)
                        <img src="{{ asset('storage/' . $category->photo) }}"
                             alt="{{ $category->name }}"
                             class="ec-card-photo">
                    @else
                        <div class="ec-card-photo-placeholder">
                            <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
                                <rect x="4" y="10" width="40" height="28" rx="4"/>
                                <circle cx="18" cy="22" r="5"/>
                                <path d="M4 32l10-8 8 6 6-5 16 11"/>
                            </svg>
                            <span>No Photo</span>
                        </div>
                    @endif

                    {{-- Body --}}
                    <div class="ec-card-body">
                        <div class="ec-card-header">
                            <span class="ec-card-row-num">{{ $i + 1 }}</span>
                            <span class="ec-card-name">{{ $category->name }}</span>
                        </div>
                        <p class="ec-card-desc">{{ $category->description ?: 'No description provided.' }}</p>
                    </div>

                    {{-- Actions --}}
                    <div class="ec-card-footer">
                        {{-- Edit triggers modal --}}
                        <button class="ec-btn-edit"
                            onclick="openEditModal(
                                {{ $category->id }},
                                '{{ addslashes($category->name) }}',
                                '{{ addslashes($category->description ?? '') }}',
                                '{{ $category->photo ? asset('storage/' . $category->photo) : '' }}'
                            )">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M11.5 2.5l2 2L5 13H3v-2L11.5 2.5z"/>
                            </svg>
                            Edit
                        </button>

                        {{-- Delete triggers modal --}}
                        <button class="ec-btn-delete"
                            onclick="openDeleteModal(
                                {{ $category->id }},
                                '{{ addslashes($category->name) }}'
                            )">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M3 4h10M6 4V3h4v1M5 4v8a1 1 0 001 1h4a1 1 0 001-1V4"/>
                            </svg>
                            Delete
                        </button>
                    </div>
                </div>
                @endforeach
            @else
                <div class="ec-empty">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
                        <rect x="8" y="12" width="32" height="28" rx="3"/>
                        <path d="M16 22h16M16 28h10"/>
                        <path d="M30 4l8 8M30 4h-6M30 4v6h8"/>
                    </svg>
                    <div class="ec-empty-title">No categories yet</div>
                    <p class="ec-empty-sub">Click <strong>Add Category</strong> to create your first event category.</p>
                </div>
            @endif
        </div>

    </div><!-- /ec-wrap -->


    {{-- ══════════════ ADD MODAL ══════════════ --}}
    <div id="addModal" class="ec-backdrop">
        <div class="ec-modal">
            <div class="ec-modal-header">
                <span class="ec-modal-title">Add <em>Category</em></span>
                <button class="ec-modal-close" onclick="closeModal('addModal')">✕</button>
            </div>
            <form method="POST" action="{{ route('admin.event.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="ec-modal-body">

                    <div class="ec-field">
                        <label class="ec-label" for="add_photo">Photo <span style="font-weight:400;text-transform:none;font-size:.7rem">(optional)</span></label>
                        <input id="add_photo" name="photo" type="file" accept="image/*"
                               class="ec-input" onchange="previewPhoto(this,'add_preview_wrap','add_preview')">
                        <div id="add_preview_wrap" class="ec-photo-preview-wrap" style="display:none">
                            <img id="add_preview" class="ec-photo-preview" src="" alt="Preview">
                        </div>
                    </div>

                    <div class="ec-field">
                        <label class="ec-label" for="add_name">Category Name <span style="color:#C0392B">*</span></label>
                        <input id="add_name" name="name" type="text"
                               class="ec-input" placeholder="e.g. Garden Wedding, Corporate Gala…" required>
                    </div>

                    <div class="ec-field">
                        <label class="ec-label" for="add_desc">Description</label>
                        <textarea id="add_desc" name="description"
                                  class="ec-textarea"
                                  placeholder="Briefly describe this category…"></textarea>
                    </div>

                </div>
                <div class="ec-modal-footer">
                    <button type="button" class="ec-btn-cancel" onclick="closeModal('addModal')">Cancel</button>
                    <button type="submit" class="ec-btn-save">
                        <svg style="width:13px;height:13px;margin-right:5px;display:inline" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 8l4 4 6-6"/>
                        </svg>
                        Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- ══════════════ EDIT MODAL ══════════════ --}}
    <div id="editModal" class="ec-backdrop">
        <div class="ec-modal">
            <div class="ec-modal-header">
                <span class="ec-modal-title">Edit <em>Category</em></span>
                <button class="ec-modal-close" onclick="closeModal('editModal')">✕</button>
            </div>
            <form id="editForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="ec-modal-body">

                    <div class="ec-field">
                        <label class="ec-label" for="edit_photo">Replace Photo <span style="font-weight:400;text-transform:none;font-size:.7rem">(leave blank to keep current)</span></label>
                        <input id="edit_photo" name="photo" type="file" accept="image/*"
                               class="ec-input" onchange="previewPhoto(this,'edit_preview_wrap','edit_preview')">
                        <div id="edit_preview_wrap" class="ec-photo-preview-wrap" style="display:none">
                            <img id="edit_preview" class="ec-photo-preview" src="" alt="Preview">
                        </div>
                        {{-- current photo --}}
                        <div id="edit_current_photo_wrap" style="display:none;margin-top:.6rem">
                            <p style="font-size:.7rem;color:var(--warm-grey);margin-bottom:.4rem;letter-spacing:.04em;text-transform:uppercase;font-weight:600">Current Photo</p>
                            <div class="ec-photo-preview-wrap">
                                <img id="edit_current_photo" class="ec-photo-preview" src="" alt="Current">
                            </div>
                        </div>
                    </div>

                    <div class="ec-field">
                        <label class="ec-label" for="edit_name">Category Name <span style="color:#C0392B">*</span></label>
                        <input id="edit_name" name="name" type="text" class="ec-input" required>
                    </div>

                    <div class="ec-field">
                        <label class="ec-label" for="edit_desc">Description</label>
                        <textarea id="edit_desc" name="description" class="ec-textarea"></textarea>
                    </div>

                </div>
                <div class="ec-modal-footer">
                    <button type="button" class="ec-btn-cancel" onclick="closeModal('editModal')">Cancel</button>
                    <button type="submit" class="ec-btn-save">
                        <svg style="width:13px;height:13px;margin-right:5px;display:inline" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 8l4 4 6-6"/>
                        </svg>
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- ══════════════ DELETE MODAL ══════════════ --}}
    <div id="deleteModal" class="ec-backdrop">
        <div class="ec-modal">
            <div class="ec-modal-header">
                <span class="ec-modal-title">Delete <em>Category</em></span>
                <button class="ec-modal-close" onclick="closeModal('deleteModal')">✕</button>
            </div>
            <div class="ec-modal-body" style="padding-top:1.8rem">
                <div class="ec-delete-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                        <path d="M10 11v6M14 11v6"/>
                        <path d="M9 6V4h6v2"/>
                    </svg>
                </div>
                <div class="ec-delete-text">
                    <h3>Are you sure?</h3>
                    <p>You are about to permanently delete <strong id="delete_name_display"></strong>. This action cannot be undone.</p>
                </div>
                <div class="ec-delete-divider"></div>
            </div>
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="ec-modal-footer">
                    <button type="button" class="ec-btn-cancel" onclick="closeModal('deleteModal')">Cancel</button>
                    <button type="submit" class="ec-btn-confirm-delete">
                        <svg style="width:13px;height:13px;margin-right:5px;display:inline" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="2 4 4 4 14 4"/>
                            <path d="M13 4l-.7 9a1 1 0 01-1 1H4.7a1 1 0 01-1-1L3 4"/>
                        </svg>
                        Yes, Delete
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
    // ── Open / close helpers ──
    function openModal(id) {
        const m = document.getElementById(id);
        m.classList.add('open');
        m.scrollTop = 0;                    // always start at top
        document.body.style.overflow = 'hidden';
    }
    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
        document.body.style.overflow = '';
    }

    // Click on backdrop to close
    ['addModal','editModal','deleteModal'].forEach(id => {
        document.getElementById(id).addEventListener('click', function(e) {
            if (e.target === this) closeModal(id);
        });
    });

    // Escape key
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            ['addModal','editModal','deleteModal'].forEach(id => {
                document.getElementById(id).classList.remove('open');
            });
            document.body.style.overflow = '';
        }
    });

    // ── Add modal ──
    function openAddModal() {
        // Reset form
        document.querySelector('#addModal form').reset();
        document.getElementById('add_preview_wrap').style.display = 'none';
        openModal('addModal');
        setTimeout(() => document.getElementById('add_name').focus(), 250);
    }

    // ── Edit modal ──
    const updateRouteTemplate = "{{ route('admin.event.update', ':id') }}";
    function openEditModal(id, name, description, photoUrl) {
        // Set action using named route
        document.getElementById('editForm').action = updateRouteTemplate.replace(':id', id);
        // Fill fields
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_desc').value = description;
        // Reset new photo input
        document.getElementById('edit_photo').value = '';
        document.getElementById('edit_preview_wrap').style.display = 'none';
        // Show current photo if exists
        const currentWrap = document.getElementById('edit_current_photo_wrap');
        if (photoUrl) {
            document.getElementById('edit_current_photo').src = photoUrl;
            currentWrap.style.display = 'block';
        } else {
            currentWrap.style.display = 'none';
        }
        openModal('editModal');
        setTimeout(() => document.getElementById('edit_name').focus(), 250);
    }

    // ── Delete modal ──
    const deleteRouteTemplate = "{{ route('admin.event.destroy', ':id') }}";
    function openDeleteModal(id, name) {
        document.getElementById('deleteForm').action = deleteRouteTemplate.replace(':id', id);
        document.getElementById('delete_name_display').textContent = `"${name}"`;
        openModal('deleteModal');
    }

    // ── Photo preview helper ──
    function previewPhoto(input, wrapId, imgId) {
        const wrap = document.getElementById(wrapId);
        const img  = document.getElementById(imgId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                img.src = e.target.result;
                wrap.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            wrap.style.display = 'none';
        }
    }
    </script>

</x-app-layout>