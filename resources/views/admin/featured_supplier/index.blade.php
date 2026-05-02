<x-app-layout>
    <style>
        :root {
            --gold:        #C9A84C;
            --gold-light:  #E8C97A;
            --gold-dark:   #8A6A1F;
            --ivory:       #FAF7F2;
            --charcoal:    #1E1B18;
            --charcoal-2:  #2A2620;
            --warm-grey:   #6B6560;
            --border:      #F0EBE5;
            --border-md:   #E0D8D0;
            --white:       #FFFFFF;
            --success:     #2D7A4F;
            --success-bg:  #EAF5EE;
            --danger:      #B84040;
            --danger-bg:   #FAEAEA;
            --font-display:'Playfair Display', Georgia, serif;
            --font-body:   'DM Sans', sans-serif;
        }

        /* ── fonts ── */
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap');

        /* ── page wrapper ── */
        .fs-page {
            font-family: var(--font-body);
            background: #F5F2ED;
            min-height: 100vh;
            color: var(--charcoal);
        }

        /* ── top bar ── */
        .fs-topbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0.85rem 1.75rem;
            display: flex; align-items: center; justify-content: space-between;
            gap: 1rem; flex-wrap: wrap;
            position: sticky; top: 0; z-index: 40;
        }
        .fs-crumb { font-size: 0.72rem; color: var(--warm-grey); }
        .fs-crumb a { color: var(--warm-grey); text-decoration: none; }
        .fs-crumb a:hover { color: var(--gold-dark); }
        .fs-crumb span { color: var(--charcoal); font-weight: 500; }
        .fs-crumb-sep { margin: 0 0.35rem; color: var(--border-md); }

        .fs-topbar-right { display: flex; align-items: center; gap: 0.75rem; }
        .fs-stat-pill {
            display: flex; align-items: center; gap: 0.4rem;
            font-size: 0.72rem; color: var(--warm-grey);
            background: #F5F2ED; padding: 0.35rem 0.85rem;
            border-radius: 20px; border: 1px solid var(--border-md);
        }
        .fs-stat-pill strong { color: var(--charcoal); }
        .fs-stat-pill .dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: var(--gold); flex-shrink: 0;
        }

        /* ── content area ── */
        .fs-content { padding: 2rem 1.75rem; max-width: 1300px; margin: 0 auto; }
        @media (max-width: 640px) { .fs-content { padding: 1.25rem 1rem; } }

        /* ── heading ── */
        .fs-heading { margin-bottom: 1.75rem; }
        .fs-title {
            font-family: var(--font-display);
            font-size: clamp(1.3rem, 2.5vw, 1.7rem);
            font-weight: 700; color: var(--charcoal); line-height: 1.2;
        }
        .fs-title em { color: var(--gold-dark); font-style: italic; }
        .fs-desc { font-size: 0.78rem; color: var(--warm-grey); margin-top: 0.3rem; line-height: 1.6; }

        /* ── stats row ── */
        .fs-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.75rem; }
        @media (max-width: 860px) { .fs-stats { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 540px) { .fs-stats { grid-template-columns: 1fr; } }

        .fs-stat-card {
            background: var(--white); border: 1.5px solid var(--border);
            border-radius: 10px; padding: 1.1rem 1.3rem;
            display: flex; align-items: center; gap: 1rem;
        }
        .fs-stat-icon {
            width: 42px; height: 42px; border-radius: 10px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
        }
        .fs-stat-icon svg { width: 18px; height: 18px; }
        .fs-stat-icon.gold  { background: rgba(201,168,76,0.1); color: var(--gold-dark); }
        .fs-stat-icon.dark  { background: rgba(30,27,24,0.07);  color: var(--charcoal); }
        .fs-stat-icon.green { background: rgba(45,122,79,0.1);  color: var(--success); }
        .fs-stat-num   { font-family: var(--font-display); font-size: 1.6rem; font-weight: 700; color: var(--charcoal); line-height: 1; }
        .fs-stat-label { font-size: 0.7rem; color: var(--warm-grey); margin-top: 0.15rem; }

        /* ── filter bar ── */
        .fs-filter-bar {
            display: flex; align-items: center; gap: 0.75rem;
            margin-bottom: 1.25rem; flex-wrap: wrap;
        }
        .fs-search-wrap { position: relative; flex: 1; min-width: 200px; max-width: 320px; }
        .fs-search-wrap svg {
            position: absolute; left: 0.75rem; top: 50%;
            transform: translateY(-50%); width: 14px; height: 14px;
            color: var(--warm-grey); pointer-events: none;
        }
        .fs-search {
            width: 100%; padding: 0.55rem 0.9rem 0.55rem 2.2rem;
            border: 1.5px solid var(--border-md); border-radius: 7px;
            background: var(--white); font-family: var(--font-body);
            font-size: 0.78rem; color: var(--charcoal); outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .fs-search:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,0.1); }
        .fs-search::placeholder { color: rgba(107,101,96,0.5); }

        .fs-tabs { display: flex; gap: 0.35rem; flex-wrap: wrap; }
        .fs-tab {
            padding: 0.45rem 1rem; border-radius: 6px;
            border: 1.5px solid var(--border-md); background: var(--white);
            font-family: var(--font-body); font-size: 0.72rem; font-weight: 500;
            color: var(--warm-grey); cursor: pointer; transition: all 0.18s;
            white-space: nowrap;
        }
        .fs-tab:hover { border-color: var(--gold); color: var(--gold-dark); }
        .fs-tab.active { background: var(--charcoal); border-color: var(--charcoal); color: var(--white); }

        .fs-filter-count { margin-left: auto; font-size: 0.72rem; color: var(--warm-grey); white-space: nowrap; }

        /* ── table card ── */
        .fs-table-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 12px; overflow: hidden;
        }

        .fs-table { width: 100%; border-collapse: collapse; }
        .fs-table thead tr { border-bottom: 1.5px solid var(--border); background: #FDFAF6; }
        .fs-table th {
            padding: 0.75rem 1.1rem;
            font-size: 0.58rem; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase; color: var(--warm-grey);
            text-align: left; white-space: nowrap;
        }
        .fs-table th.tc { text-align: center; }

        .fs-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }
        .fs-table tbody tr:last-child { border-bottom: none; }
        .fs-table tbody tr:hover { background: #FDFAF6; }
        .fs-table tbody tr.feat-row { background: rgba(201,168,76,0.04); }
        .fs-table tbody tr.feat-row:hover { background: rgba(201,168,76,0.08); }
        .fs-table tbody tr.row-hidden { display: none; }
        .fs-table td { padding: 0.85rem 1.1rem; vertical-align: middle; }

        /* supplier cell */
        .sp-cell { display: flex; align-items: center; gap: 0.75rem; }
        .sp-avatar {
            width: 40px; height: 40px; border-radius: 50%; flex-shrink: 0;
            background: var(--charcoal); overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display); font-size: 0.85rem;
            font-weight: 700; color: var(--gold);
            border: 2px solid var(--border-md);
        }
        .sp-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .sp-name  { font-size: 0.82rem; font-weight: 600; color: var(--charcoal); line-height: 1.2; }
        .sp-owner { font-size: 0.68rem; color: var(--warm-grey); }

        /* cat chips */
        .cat-chips { display: flex; flex-wrap: wrap; gap: 0.25rem; }
        .cat-chip {
            font-size: 0.58rem; font-weight: 600; letter-spacing: 0.05em;
            text-transform: uppercase; padding: 2px 7px; border-radius: 20px;
            background: rgba(201,168,76,0.1); color: var(--gold-dark);
            border: 1px solid rgba(201,168,76,0.2);
        }

        .loc-cell { font-size: 0.75rem; color: var(--warm-grey); }

        /* rating */
        .rating-cell { display: flex; align-items: center; gap: 0.3rem; font-size: 0.75rem; }
        .rating-cell svg { width: 12px; height: 12px; fill: var(--gold); }
        .rating-val { font-weight: 600; }
        .rating-ct  { color: var(--warm-grey); font-size: 0.68rem; }

        /* status badge */
        .status-badge {
            display: inline-flex; align-items: center; gap: 0.3rem;
            font-size: 0.62rem; font-weight: 700; letter-spacing: 0.06em;
            text-transform: uppercase; padding: 3px 9px; border-radius: 999px;
        }
        .status-badge .dot { width: 5px; height: 5px; border-radius: 50%; }
        .status-badge.featured { background: rgba(201,168,76,0.12); color: var(--gold-dark); border: 1px solid rgba(201,168,76,0.3); }
        .status-badge.featured .dot { background: var(--gold); }
        .status-badge.regular   { background: #F4F4F4; color: var(--warm-grey); border: 1px solid var(--border-md); }
        .status-badge.regular .dot { background: var(--warm-grey); }

        /* action */
        .action-cell { display: flex; align-items: center; justify-content: center; gap: 0.4rem; }
        .toggle-btn {
            display: inline-flex; align-items: center; gap: 0.35rem;
            padding: 0.4rem 0.9rem; border-radius: 6px;
            font-family: var(--font-body); font-size: 0.7rem; font-weight: 600;
            border: 1.5px solid; cursor: pointer; transition: all 0.18s;
            text-decoration: none; white-space: nowrap; background: none;
        }
        .toggle-btn svg { width: 11px; height: 11px; }
        .toggle-btn.feature  { color: var(--gold-dark); border-color: rgba(201,168,76,0.35); background: rgba(201,168,76,0.08); }
        .toggle-btn.feature:hover  { background: var(--gold); color: var(--charcoal); border-color: var(--gold); }
        .toggle-btn.unfeature { color: var(--danger); border-color: rgba(184,64,64,0.3); background: rgba(184,64,64,0.06); }
        .toggle-btn.unfeature:hover { background: var(--danger); color: var(--white); border-color: var(--danger); }

        /* empty */
        .fs-empty { text-align: center; padding: 3.5rem 1rem; }
        .fs-empty svg { width: 36px; height: 36px; color: rgba(201,168,76,0.35); margin-bottom: 0.75rem; }
        .fs-empty h3 { font-family: var(--font-display); font-size: 1rem; font-weight: 700; margin-bottom: 0.3rem; }
        .fs-empty p  { font-size: 0.78rem; color: var(--warm-grey); }

        /* toast */
        .toast-area { position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 999; display: flex; flex-direction: column; gap: 0.5rem; pointer-events: none; }
        .toast {
            display: flex; align-items: center; gap: 0.6rem;
            padding: 0.75rem 1.1rem; border-radius: 8px;
            color: var(--white); font-size: 0.78rem; font-weight: 500;
            box-shadow: 0 4px 20px rgba(0,0,0,0.18);
            animation: slideIn 0.3s ease, fadeOut 0.4s ease 2.8s forwards;
            min-width: 220px; pointer-events: auto;
        }
        .toast.success { background: var(--success); }
        .toast.danger  { background: var(--danger); }
        .toast svg { width: 14px; height: 14px; flex-shrink: 0; }
        @keyframes slideIn { from { opacity:0; transform:translateX(20px); } to { opacity:1; transform:translateX(0); } }
        @keyframes fadeOut { from { opacity:1; } to { opacity:0; pointer-events:none; } }

        /* responsive hide */
        @media (max-width: 900px) { .col-hide { display: none; } }
    </style>

    <div class="fs-page">

        {{-- ── Main content ── --}}
        <div class="fs-content">

            {{-- Flash toasts --}}
            @if(session('success'))
            <div class="toast-area" id="toastArea">
                <div class="toast success">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 8l4 4 8-8"/></svg>
                    {{ session('success') }}
                </div>
            </div>
            @endif
            @if(session('error'))
            <div class="toast-area" id="toastArea">
                <div class="toast danger">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4l8 8M12 4l-8 8"/></svg>
                    {{ session('error') }}
                </div>
            </div>
            @endif

            {{-- Heading --}}
            <div class="fs-heading">
                <div class="fs-title">Featured <em>Suppliers</em></div>
                <div class="fs-desc">Toggle which suppliers appear in the featured section on the public Packages page.</div>
            </div>
            
            {{-- Stats --}}
            <div class="fs-stats">
                <div class="fs-stat-card">
                    <div class="fs-stat-icon gold">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M10 1l2.4 4.9L18 6.9l-4 3.9 1 5.5L10 13.8l-5.1 2.5 1-5.5-4-3.9 5.6-.7z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="fs-stat-num">{{ $featuredCount }}</div>
                        <div class="fs-stat-label">Featured suppliers</div>
                    </div>
                </div>
                <div class="fs-stat-card">
                    <div class="fs-stat-icon dark">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="8" cy="7" r="4"/><path d="M2 18c0-4 2.7-7 6-7s6 3 6 7"/>
                            <circle cx="16" cy="6" r="3"/><path d="M18 17c0-3-1.8-5.3-4.5-5.8"/>
                        </svg>
                    </div>
                    <div>
                        <div class="fs-stat-num">{{ $totalCount }}</div>
                        <div class="fs-stat-label">Total suppliers</div>
                    </div>
                </div>
                <div class="fs-stat-card">
                    <div class="fs-stat-icon green">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="10" cy="10" r="8"/><path d="M10 6v8M6 10h8"/>
                        </svg>
                    </div>
                    <div>
                        <div class="fs-stat-num">{{ $totalCount - $featuredCount }}</div>
                        <div class="fs-stat-label">Available to feature</div>
                    </div>
                </div>
            </div>

            {{-- Filter bar --}}
            <div class="fs-filter-bar">
                <div class="fs-search-wrap">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="7" cy="7" r="5"/><path d="M12 12l3 3"/>
                    </svg>
                    <input type="text" class="fs-search" id="fsSearch"
                           placeholder="Search by name or location…">
                </div>

                <div class="fs-tabs">
                    <button class="fs-tab active" onclick="fsFilter(this,'all')">All</button>
                    <button class="fs-tab" onclick="fsFilter(this,'featured')">Featured</button>
                    <button class="fs-tab" onclick="fsFilter(this,'regular')">Not Featured</button>
                </div>

                <div class="fs-filter-count" id="fsCount">
                    Showing {{ $suppliers->count() }} suppliers
                </div>
            </div>

            {{-- Table --}}
            <div class="fs-table-card">
                @if($suppliers->count())
                <table class="fs-table" id="fsTable">
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th class="col-hide">Categories</th>
                            <th class="col-hide">Location</th>
                            <th class="col-hide">Rating</th>
                            <th class="tc">Status</th>
                            <th class="tc">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $supplier)
                        @php
                            $bizName  = $supplier->business_name ?? trim(($supplier->first_name ?? '') . ' ' . ($supplier->last_name ?? ''));
                            $fullName = trim(($supplier->first_name ?? '') . ' ' . ($supplier->last_name ?? ''));
                            $initials = strtoupper(substr($bizName, 0, 2));
                            $photo    = $supplier->photo ?? null;
                            $city     = $supplier->city ?? null;
                            $province = $supplier->province ?? null;
                            $location = implode(', ', array_filter([$city, $province]));
                            $cats     = $supplier->categories ?? collect();
                            $avg      = $supplier->ratings ? round($supplier->ratings->avg('rating'), 1) : 0;
                            $rCount   = $supplier->ratings ? $supplier->ratings->count() : 0;
                            $isFeat   = (bool) $supplier->is_featured;
                        @endphp
                        <tr class="{{ $isFeat ? 'feat-row' : '' }}"
                            data-name="{{ strtolower($bizName) }} {{ strtolower($fullName) }}"
                            data-location="{{ strtolower($location) }}"
                            data-featured="{{ $isFeat ? '1' : '0' }}">

                            {{-- Supplier --}}
                            <td>
                                <div class="sp-cell">
                                    <div class="sp-avatar">
                                        @if($photo)
                                            <img src="{{ asset('storage/'.$photo) }}" alt="{{ $bizName }}">
                                        @else
                                            {{ $initials }}
                                        @endif
                                    </div>
                                    <div>
                                        <div class="sp-name">{{ $bizName }}</div>
                                        @if($fullName && $fullName !== $bizName)
                                            <div class="sp-owner">{{ $fullName }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Categories --}}
                            <td class="col-hide">
                                <div class="cat-chips">
                                    @foreach($cats->take(3) as $cat)
                                        <span class="cat-chip">{{ $cat->name }}</span>
                                    @endforeach
                                    @if($cats->count() > 3)
                                        <span class="cat-chip">+{{ $cats->count() - 3 }}</span>
                                    @endif
                                </div>
                            </td>

                            {{-- Location --}}
                            <td class="col-hide">
                                <div class="loc-cell">{{ $location ?: '—' }}</div>
                            </td>

                            {{-- Rating --}}
                            <td class="col-hide">
                                <div class="rating-cell">
                                    <svg viewBox="0 0 24 24"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>
                                    <span class="rating-val">{{ $avg > 0 ? number_format($avg,1) : '—' }}</span>
                                    <span class="rating-ct">({{ $rCount }})</span>
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="tc">
                                @if($isFeat)
                                    <span class="status-badge featured">
                                        <span class="dot"></span> Featured
                                    </span>
                                @else
                                    <span class="status-badge regular">
                                        <span class="dot"></span> Regular
                                    </span>
                                @endif
                            </td>

                            {{-- Action --}}
                            <td>
                                <div class="action-cell">
                                    <form method="POST"
                                          action="{{ route('featured-suppliers.toggle', $supplier->id) }}"
                                          onsubmit="return confirmToggle('{{ $bizName }}', {{ $isFeat ? 'true' : 'false' }})">
                                        @csrf
                                        @method('PATCH')
                                        @if($isFeat)
                                            <button type="submit" class="toggle-btn unfeature">
                                                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M2 6h8"/>
                                                </svg>
                                                Remove
                                            </button>
                                        @else
                                            <button type="submit" class="toggle-btn feature">
                                                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
                                                    <path d="M6 1l1.2 2.4L10 3.8 8 5.7l.5 2.8L6 7.2 3.5 8.5l.5-2.8-2-1.9 2.8-.4z"/>
                                                </svg>
                                                Feature
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @else
                <div class="fs-empty">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
                        <circle cx="24" cy="20" r="10"/><path d="M4 44c0-8 9-14 20-14s20 6 20 14"/>
                    </svg>
                    <h3>No suppliers found</h3>
                    <p>Suppliers will appear here once they register and complete their profile.</p>
                </div>
                @endif
            </div>

        </div>{{-- /fs-content --}}
    </div>{{-- /fs-page --}}

    {{-- Toasts + Search + Filter --}}
    <script>
        /* auto-dismiss toast */
        setTimeout(() => {
            const area = document.getElementById('toastArea');
            if (area) area.remove();
        }, 3500);

        /* confirm on remove only */
        function confirmToggle(name, isFeatured) {
            if (isFeatured) return confirm(`Remove "${name}" from featured suppliers?`);
            return true;
        }

        /* live search + tab filter */
        const fsSearch = document.getElementById('fsSearch');
        let currentTab = 'all';

        function fsFilter(btn, tab) {
            document.querySelectorAll('.fs-tab').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentTab = tab;
            applyFilters();
        }

        function applyFilters() {
            const query = (fsSearch?.value ?? '').toLowerCase().trim();
            const rows  = document.querySelectorAll('#fsTable tbody tr');
            let visible = 0;

            rows.forEach(row => {
                const name     = row.dataset.name     ?? '';
                const location = row.dataset.location ?? '';
                const featured = row.dataset.featured;

                const matchSearch = !query || name.includes(query) || location.includes(query);
                const matchTab    = currentTab === 'all'
                    || (currentTab === 'featured' && featured === '1')
                    || (currentTab === 'regular'  && featured === '0');

                const show = matchSearch && matchTab;
                row.classList.toggle('row-hidden', !show);
                if (show) visible++;
            });

            const el = document.getElementById('fsCount');
            if (el) el.textContent = `Showing ${visible} supplier${visible !== 1 ? 's' : ''}`;
        }

        fsSearch?.addEventListener('input', applyFilters);
    </script>
</x-app-layout>