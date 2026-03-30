<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Venues') }}
        </h2>
    </x-slot>
    <style>
        /* ── Page-level variables (inherits from app layout) ── */
        .bv-page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .bv-page-title {
            font-family: var(--font-display);
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--charcoal);
            line-height: 1.1;
        }
        .bv-page-title em { font-style: italic; color: var(--gold-dark); }
        .bv-page-sub {
            font-size: 0.8rem;
            color: var(--warm-grey);
            margin-top: 0.3rem;
            letter-spacing: 0.02em;
        }

        /* ── Add button ── */
        .bv-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--charcoal);
            color: var(--white);
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            padding: 0.65rem 1.4rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            text-decoration: none;
        }
        .bv-btn-primary:hover {
            background: var(--gold-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(201,168,76,0.25);
        }
        .bv-btn-primary svg { width: 15px; height: 15px; }

        /* ── Table card ── */
        .bv-card {
            background: var(--white);
            border-radius: 12px;
            border: 1px solid #F0EBE5;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(30,27,24,0.05);
        }

        /* ── Table ── */
        .bv-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }
        .bv-table thead {
            background: var(--ivory);
            border-bottom: 1px solid #F0EBE5;
        }
        .bv-table thead th {
            padding: 0.9rem 1.5rem;
            text-align: left;
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--warm-grey);
            white-space: nowrap;
        }
        .bv-table thead th:last-child { text-align: right; }
        .bv-table tbody tr {
            border-bottom: 1px solid #F7F3EF;
            transition: background 0.15s;
        }
        .bv-table tbody tr:last-child { border-bottom: none; }
        .bv-table tbody tr:hover { background: rgba(250,247,242,0.7); }
        .bv-table tbody td {
            padding: 1rem 1.5rem;
            color: var(--charcoal);
            vertical-align: middle;
        }
        .bv-table tbody td:last-child { text-align: right; }

        /* Row number badge */
        .bv-row-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px; height: 24px;
            background: var(--ivory);
            border: 1px solid #E5DDD5;
            border-radius: 50%;
            font-size: 0.68rem;
            font-weight: 600;
            color: var(--warm-grey);
        }

        /* Name cell */
        .bv-venue-name {
            font-weight: 600;
            color: var(--charcoal);
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }
        .bv-venue-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--gold);
            flex-shrink: 0;
        }

        /* Description cell */
        .bv-venue-desc {
            color: var(--warm-grey);
            font-size: 0.82rem;
            max-width: 380px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Action buttons */
        .bv-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.5rem;
        }
        .bv-btn-edit {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 0.9rem;
            font-size: 0.76rem;
            font-weight: 500;
            letter-spacing: 0.03em;
            border-radius: 6px;
            border: 1.5px solid #E5DDD5;
            background: var(--white);
            color: var(--charcoal);
            text-decoration: none;
            cursor: pointer;
            font-family: var(--font-body);
            transition: border-color 0.2s, color 0.2s, background 0.2s;
        }
        .bv-btn-edit svg { width: 12px; height: 12px; }
        .bv-btn-edit:hover {
            border-color: var(--gold);
            color: var(--gold-dark);
            background: rgba(201,168,76,0.06);
        }
        .bv-btn-delete {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 0.9rem;
            font-size: 0.76rem;
            font-weight: 500;
            letter-spacing: 0.03em;
            border-radius: 6px;
            border: 1.5px solid #FADBD8;
            background: var(--white);
            color: #C0392B;
            cursor: pointer;
            font-family: var(--font-body);
            transition: border-color 0.2s, background 0.2s;
        }
        .bv-btn-delete svg { width: 12px; height: 12px; }
        .bv-btn-delete:hover { border-color: #C0392B; background: #FFF5F5; }

        /* Empty state */
        .bv-empty {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--warm-grey);
        }
        .bv-empty svg { width: 48px; height: 48px; color: #DDD4C8; margin: 0 auto 1rem; display: block; }
        .bv-empty-title { font-family: var(--font-display); font-size: 1.1rem; color: var(--charcoal); margin-bottom: 0.4rem; }
        .bv-empty-sub { font-size: 0.82rem; }

        /* ── MODAL ── */
        .bv-modal-backdrop {
            position: fixed; inset: 0;
            background: rgba(30,27,24,0.5);
            backdrop-filter: blur(4px);
            z-index: 500;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .bv-modal-backdrop.open {
            display: flex;
            animation: bvFadeIn 0.2s ease;
        }
        .bv-modal {
            background: var(--white);
            border-radius: 14px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 24px 64px rgba(30,27,24,0.2);
            overflow: hidden;
            animation: bvSlideUp 0.25s ease;
        }
        .bv-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.4rem 1.6rem 1.2rem;
            border-bottom: 1px solid #F0EBE5;
        }
        .bv-modal-title {
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--charcoal);
        }
        .bv-modal-title em { font-style: italic; color: var(--gold-dark); }
        .bv-modal-close {
            width: 30px; height: 30px;
            border-radius: 6px;
            border: 1px solid #E5DDD5;
            background: var(--ivory);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            color: var(--warm-grey);
            transition: background 0.2s, color 0.2s;
            font-size: 1rem; line-height: 1;
        }
        .bv-modal-close:hover { background: #F0EBE5; color: var(--charcoal); }
        .bv-modal-body { padding: 1.5rem 1.6rem; }
        .bv-modal-footer {
            padding: 1rem 1.6rem 1.4rem;
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
        }

        /* Form fields */
        .bv-field { margin-bottom: 1.1rem; }
        .bv-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--warm-grey);
            margin-bottom: 0.45rem;
        }
        .bv-input,
        .bv-textarea {
            width: 100%;
            padding: 0.65rem 0.9rem;
            background: var(--ivory);
            border: 1.5px solid #E5DDD5;
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.85rem;
            color: var(--charcoal);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .bv-input:focus,
        .bv-textarea:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.12);
            background: var(--white);
        }
        .bv-input::placeholder,
        .bv-textarea::placeholder { color: #C0B8B0; }
        .bv-textarea { resize: vertical; min-height: 90px; }

        /* Cancel btn */
        .bv-btn-cancel {
            padding: 0.62rem 1.2rem;
            border-radius: 6px;
            border: 1.5px solid #E5DDD5;
            background: var(--white);
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--warm-grey);
            cursor: pointer;
            transition: border-color 0.2s, color 0.2s;
        }
        .bv-btn-cancel:hover { border-color: var(--gold); color: var(--charcoal); }

        /* Save btn */
        .bv-btn-save {
            padding: 0.62rem 1.5rem;
            border-radius: 6px;
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
        .bv-btn-save:hover {
            background: var(--gold-dark);
            box-shadow: 0 4px 12px rgba(201,168,76,0.2);
        }

        @keyframes bvFadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        @keyframes bvSlideUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Success alert */
        .bv-alert-success {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            background: #F0FDF4;
            border: 1px solid #A7F3D0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.82rem;
            color: #065F46;
            margin-bottom: 1.5rem;
        }
        .bv-alert-success svg { width: 16px; height: 16px; color: #10B981; flex-shrink: 0; }
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
                <h1 class="bv-page-title">Event <em>Venues</em></h1>
                <p class="bv-page-sub"></p>
            </div>
            <button onclick="openModal()" class="bv-btn-primary">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
                    <path d="M10 4v12M4 10h12"/>
                </svg>
                Add Venue
            </button>
        </div>

        {{-- Table card --}}
        <div class="bv-card">
            @if(isset($venues) && $venues->count())
            <table class="bv-table">
                <thead>
                    <tr>
                        <th style="width:48px">#</th>
                        <th>venue Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venues as $i => $venues)
                    <tr>
                        <td><span class="bv-row-num">{{ $i + 1 }}</span></td>
                        <td>
                            <div class="bv-venues-name">
                                <span class="bv-venues-dot"></span>
                                {{ $venues->name }}
                            </div>
                        </td>
                        <td>
                            <span class="bv-venues-desc" title="{{ $venues->description }}">
                                {{ $venues->description ?: '—' }}
                            </span>
                        </td>
                        <td>
                            <div class="bv-actions">
                                <a href="{{ route('admin.venue.edit', $venues->id) }}" class="bv-btn-edit">
                                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <path d="M11.5 2.5l2 2L5 13H3v-2L11.5 2.5z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.venue.destroy', $venues->id) }}" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bv-btn-delete"
                                        onclick="return confirm('Delete {{ addslashes($venues->name) }}?')">
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
            @else
            <div class="bv-empty">
                <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
                    <rect x="8" y="12" width="32" height="28" rx="3"/>
                    <path d="M16 22h16M16 28h10"/>
                    <path d="M30 4l8 8M30 4h-6M30 4v6h8"/>
                </svg>
                <div class="bv-empty-title">No Venue yet</div>
                <p class="bv-empty-sub">Click <strong>Add Venue</strong> to create your Venues.</p>
            </div>
            @endif
        </div>

    </div>

    {{-- Add Venue Modal --}}
    <div id="venueModal" class="bv-modal-backdrop">
        <div class="bv-modal">
            <div class="bv-modal-header">
                <span class="bv-modal-title">Add <em>Venues</em></span>
                <button class="bv-modal-close" onclick="closeModal()">✕</button>
            </div>

            <form method="POST" action="{{ route('admin.venue.store') }}">
                @csrf
                <div class="bv-modal-body">

                    <div class="bv-field">
                        <label class="bv-label" for="venueName">Venue Name</label>
                        <input id="venueName" name="name" type="text"
                            class="bv-input" placeholder="e.g. Garden Wedding,"
                            required>
                    </div>

                    <div class="bv-field" style="margin-bottom:0">
                        <label class="bv-label" for="venueDesc">Description</label>
                        <textarea id="venueDesc" name="description"
                                class="bv-textarea"
                                placeholder="Briefly describe this venue"></textarea>
                    </div>

                </div>

                <div class="bv-modal-footer">
                    <button type="button" class="bv-btn-cancel" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="bv-btn-save">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function openModal() {
        const m = document.getElementById('venueModal');
        m.classList.add('open');
        document.body.style.overflow = 'hidden';
        document.getElementById('venueName').focus();
    }
    function closeModal() {
        document.getElementById('venueModal').classList.remove('open');
        document.body.style.overflow = '';
    }
    // Close on backdrop click
    document.getElementById('venueModal').addvenueListener('click', function(e) {
        if (e.target === this) closeModal();
    });
    // Close on Escape
    document.addvenueListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });
    </script>
</x-app-layout>