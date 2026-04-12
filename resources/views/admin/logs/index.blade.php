<x-app-layout>
<style>
    :root {
        --gold:        #C9A84C;
        --gold-light:  #E8C97A;
        --gold-dark:   #8A6A1F;
        --ivory:       #FAF7F2;
        --charcoal:    #1E1B18;
        --warm-grey:   #6B6560;
        --white:       #FFFFFF;
        --border:      #F0EBE5;
        --border-md:   #E0D8D0;
        --font-display:'Playfair Display', Georgia, serif;
        --font-body:   'DM Sans', sans-serif;
        --danger:      #C0392B;
    }

    /* ── Page header ── */
    .bv-page-header {
        display: flex; align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;
    }
    .bv-page-title {
        font-family: var(--font-display);
        font-size: 1.75rem; font-weight: 700;
        color: var(--charcoal); line-height: 1.1;
    }
    .bv-page-title em { font-style: italic; color: var(--gold-dark); }
    .bv-page-sub { font-size: 0.8rem; color: var(--warm-grey); margin-top: 0.3rem; }

    /* ── Toolbar ── */
    .bv-toolbar {
        display: flex; align-items: center; gap: 0.75rem;
        flex-wrap: wrap; margin-bottom: 1.25rem;
    }
    .bv-search-wrap {
        flex: 1; min-width: 220px;
        display: flex; align-items: center;
        border: 1.5px solid var(--border-md); border-radius: 8px;
        background: var(--ivory); overflow: hidden;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .bv-search-wrap:focus-within {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
        background: var(--white);
    }
    .bv-search-wrap svg { margin: 0 0.65rem; flex-shrink: 0; color: var(--warm-grey); opacity: 0.45; }
    .bv-search-input {
        flex: 1; border: none; background: transparent;
        padding: 0.58rem 0.5rem 0.58rem 0;
        font-size: 0.855rem; font-family: var(--font-body);
        color: var(--charcoal); outline: none;
    }
    .bv-search-input::placeholder { color: #B0A89E; }
    .bv-search-spinner {
        width: 14px; height: 14px; border-radius: 50%;
        border: 2px solid var(--border-md); border-top-color: var(--gold);
        animation: bvSpin .55s linear infinite;
        margin-right: 0.65rem; display: none; flex-shrink: 0;
    }
    .bv-search-spinner.on { display: block; }
    @keyframes bvSpin { to { transform: rotate(360deg); } }
    .bv-search-clear {
        background: none; border: none; cursor: pointer;
        color: var(--warm-grey); opacity: 0; padding: 0 0.6rem;
        font-size: 1rem; line-height: 1; transition: opacity .15s;
        display: flex; align-items: center;
    }
    .bv-search-clear.show { opacity: 0.45; }
    .bv-search-clear:hover { opacity: 1; }

    /* Role filter select */
    .bv-filter-sel {
        padding: 0.58rem 2rem 0.58rem 0.85rem;
        border: 1.5px solid var(--border-md); border-radius: 8px;
        background: var(--ivory); font-family: var(--font-body);
        font-size: 0.83rem; color: var(--charcoal);
        outline: none; appearance: none; cursor: pointer;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%23B0A89E'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 0.7rem center;
        transition: border-color .2s;
    }
    .bv-filter-sel:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,0.1); }

    /* Result count */
    .bv-result-count {
        font-size: 0.78rem; color: var(--warm-grey);
        font-family: var(--font-body); white-space: nowrap;
    }
    .bv-result-count strong { color: var(--charcoal); font-weight: 600; }

    /* ── Table card ── */
    .bv-sc {
        background: var(--white);
        border-radius: 12px; border: 1px solid var(--border);
        overflow: hidden; box-shadow: 0 1px 4px rgba(30,27,24,0.04);
    }

    /* ── Table ── */
    .bv-table { width: 100%; border-collapse: collapse; }
    .bv-table thead tr {
        background: rgba(201,168,76,0.04);
        border-bottom: 1px solid var(--border);
    }
    .bv-table thead th {
        padding: 0.75rem 1.25rem;
        font-size: 0.6rem; font-weight: 700; letter-spacing: 0.12em;
        text-transform: uppercase; color: var(--gold-dark);
        font-family: var(--font-body); text-align: left;
        white-space: nowrap;
    }
    .bv-table thead th:first-child { padding-left: 1.5rem; }
    .bv-table thead th:last-child  { padding-right: 1.5rem; text-align: right; }

    .bv-table tbody tr {
        border-bottom: 0.5px solid var(--border);
        transition: background 0.15s;
    }
    .bv-table tbody tr:last-child { border-bottom: none; }
    .bv-table tbody tr:hover { background: rgba(201,168,76,0.03); }
    .bv-table tbody tr.ls-hidden { display: none; }

    .bv-table td {
        padding: 0.85rem 1.25rem;
        font-size: 0.83rem; color: var(--charcoal);
        font-family: var(--font-body); vertical-align: middle;
    }
    .bv-table td:first-child { padding-left: 1.5rem; }
    .bv-table td:last-child  { padding-right: 1.5rem; text-align: right; }

    /* User cell */
    .bv-user-cell { display: flex; align-items: center; gap: 0.65rem; }
    .bv-user-av {
        width: 32px; height: 32px; border-radius: 50%; flex-shrink: 0;
        background: var(--charcoal);
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display); font-size: 0.7rem; font-weight: 700;
        color: var(--gold); border: 1.5px solid rgba(201,168,76,0.2);
    }
    .bv-user-name { font-weight: 600; color: var(--charcoal); font-size: 0.83rem; }
    .bv-user-guest { color: #C0B8B0; font-style: italic; font-size: 0.8rem; }

    /* Role badge */
    .bv-role-badge {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 0.18rem 0.65rem; border-radius: 999px;
        font-size: 0.63rem; font-weight: 700; letter-spacing: 0.04em;
        text-transform: uppercase; font-family: var(--font-body);
    }
    .bv-role-badge::before { content: ''; width: 4px; height: 4px; border-radius: 50%; }
    .bv-role-admin  { background: rgba(201,168,76,0.1); color: var(--gold-dark); border: 1px solid rgba(201,168,76,0.25); }
    .bv-role-admin::before  { background: var(--gold); }
    .bv-role-supplier { background: rgba(30,27,24,0.06); color: var(--charcoal); border: 1px solid rgba(30,27,24,0.12); }
    .bv-role-supplier::before { background: var(--charcoal); }
    .bv-role-client { background: #F0FDF4; color: #15803D; border: 1px solid #BBF7D0; }
    .bv-role-client::before { background: #22C55E; }
    .bv-role-guest  { background: var(--ivory); color: #C0B8B0; border: 1px solid var(--border-md); }
    .bv-role-guest::before { background: #C0B8B0; }

    /* Action text */
    .bv-action-text { font-size: 0.82rem; color: var(--warm-grey); }

    /* IP address */
    .bv-ip {
        font-size: 0.75rem; color: var(--warm-grey);
        font-family: 'Courier New', monospace; letter-spacing: 0.02em;
        background: var(--ivory); border: 1px solid var(--border);
        padding: 0.18rem 0.55rem; border-radius: 4px;
        display: inline-block;
    }

    /* Date */
    .bv-date-cell { display: flex; flex-direction: column; align-items: flex-end; gap: 1px; }
    .bv-date { font-size: 0.78rem; color: var(--charcoal); font-weight: 500; }
    .bv-time { font-size: 0.68rem; color: #C0B8B0; }

    /* ── Live search no results ── */
    .bv-no-results {
        display: none;
        text-align: center; padding: 3.5rem 2rem;
    }
    .bv-no-results-icon {
        width: 50px; height: 50px; border-radius: 50%;
        background: rgba(201,168,76,0.08);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 0.85rem; color: var(--gold-dark);
    }
    .bv-no-results-icon svg { width: 22px; height: 22px; }
    .bv-no-results h4 {
        font-family: var(--font-display); font-size: 1rem;
        font-weight: 700; color: var(--charcoal); margin-bottom: 0.3rem;
    }
    .bv-no-results p { font-size: 0.8rem; color: var(--warm-grey); }

    /* ── Pagination ── */
    .bv-pagination {
        display: flex; align-items: center; justify-content: space-between;
        padding: 0.85rem 1.5rem; border-top: 1px solid var(--border);
        flex-wrap: wrap; gap: 0.75rem;
    }
    .bv-pagination-info { font-size: 0.75rem; color: var(--warm-grey); font-family: var(--font-body); }
    .bv-pagination-info strong { color: var(--charcoal); }
    .bv-pagination-links { display: flex; gap: 0.3rem; flex-wrap: wrap; }
    .bv-pagination-links a,
    .bv-pagination-links span {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 32px; height: 32px; padding: 0 0.4rem;
        border: 1px solid var(--border); border-radius: 6px;
        font-size: 0.78rem; font-family: var(--font-body);
        color: var(--warm-grey); background: var(--white);
        text-decoration: none; transition: all 0.18s;
    }
    .bv-pagination-links a:hover { border-color: var(--gold); color: var(--gold-dark); }
    .bv-pagination-links span[aria-current] {
        background: var(--gold); border-color: var(--gold);
        color: var(--charcoal); font-weight: 700;
    }
    .bv-pagination-links span.disabled { opacity: 0.35; pointer-events: none; }

    /* ── Mobile scroll ── */
    .bv-table-wrap { overflow-x: auto; }
    .bv-table-wrap::-webkit-scrollbar { height: 4px; }
    .bv-table-wrap::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 4px; }

    @media (max-width: 640px) {
        .bv-page-title { font-size: 1.35rem; }
        .bv-toolbar { flex-direction: column; align-items: stretch; }
        .bv-search-wrap { min-width: unset; }
    }
</style>

<div class="page-content">

    {{-- ── Page header ── --}}
    <div class="bv-page-header">
        <div>
            <h1 class="bv-page-title">Activity <em>Logs</em></h1>
            <p class="bv-page-sub">A record of all user actions across the platform.</p>
        </div>
    </div>

    {{-- ── Toolbar: search + role filter + count ── --}}
    <div class="bv-toolbar">
        {{-- Live search --}}
        <div class="bv-search-wrap">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
            </svg>
            <input type="text" id="bv-search" class="bv-search-input"
                   placeholder="Search by user, action, role, or IP…"
                   autocomplete="off">
            <div class="bv-search-spinner" id="bv-spinner"></div>
            <button class="bv-search-clear" id="bv-clear" onclick="clearSearch()" title="Clear">✕</button>
        </div>

        {{-- Role filter --}}
        <select class="bv-filter-sel" id="bv-role-filter" onchange="applyFilters()">
            <option value="">All Roles</option>
            <option value="admin">Admin</option>
            <option value="supplier">Supplier</option>
            <option value="client">Client</option>
            <option value="guest">Guest</option>
        </select>

        {{-- Result count --}}
        <div class="bv-result-count">
            Showing <strong id="bv-count">{{ $logs->total() }}</strong> log<span id="bv-plural">{{ $logs->total() !== 1 ? 's' : '' }}</span>
        </div>
    </div>

    {{-- ── Table card ── --}}
    <div class="bv-sc">
        <div class="bv-table-wrap">
            <table class="bv-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Action</th>
                        <th>IP Address</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody id="bv-tbody">
                    @forelse($logs as $log)
                    <tr data-search="{{ strtolower(implode(' ', array_filter([
                            $log->user->name ?? 'guest',
                            $log->role ?? '',
                            $log->action ?? '',
                            $log->ip_address ?? '',
                        ]))) }}"
                        data-role="{{ strtolower($log->role ?? 'guest') }}">

                        {{-- User --}}
                        <td>
                            <div class="bv-user-cell">
                                @if($log->user)
                                    <div class="bv-user-av">
                                        {{ strtoupper(substr($log->user->name, 0, 2)) }}
                                    </div>
                                    <span class="bv-user-name">{{ $log->user->name }}</span>
                                @else
                                    <div class="bv-user-av" style="background:var(--ivory);color:#C0B8B0;border-color:var(--border);">
                                        <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="7" r="4"/><path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                                    </div>
                                    <span class="bv-user-guest">Guest</span>
                                @endif
                            </div>
                        </td>

                        {{-- Role --}}
                        <td>
                            @php $role = strtolower($log->role ?? 'guest'); @endphp
                            <span class="bv-role-badge bv-role-{{ in_array($role, ['admin','supplier','client','guest']) ? $role : 'guest' }}">
                                {{ ucfirst($log->role ?? 'Guest') }}
                            </span>
                        </td>

                        {{-- Action --}}
                        <td>
                            <span class="bv-action-text">{{ $log->action }}</span>
                        </td>

                        {{-- IP --}}
                        <td>
                            <span class="bv-ip">{{ $log->ip_address ?? '—' }}</span>
                        </td>

                        {{-- Date --}}
                        <td>
                            <div class="bv-date-cell">
                                <span class="bv-date">{{ $log->created_at->format('M d, Y') }}</span>
                                <span class="bv-time">{{ $log->created_at->format('h:i A') }}</span>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="bv-no-results" style="display:block;">
                                <div class="bv-no-results-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 12h6M9 16h4M17 3H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2z"/></svg>
                                </div>
                                <h4>No logs yet</h4>
                                <p>Activity will appear here once users start taking actions.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Live search no results --}}
            <div class="bv-no-results" id="bv-no-results">
                <div class="bv-no-results-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                    </svg>
                </div>
                <h4>No results found</h4>
                <p>Try a different keyword or clear your search.</p>
            </div>
        </div>

        {{-- Pagination --}}
        @if($logs->hasPages())
        <div class="bv-pagination" id="bv-pagination">
            <div class="bv-pagination-info">
                Showing <strong>{{ $logs->firstItem() }}</strong>–<strong>{{ $logs->lastItem() }}</strong>
                of <strong>{{ $logs->total() }}</strong> logs
            </div>
            <div class="bv-pagination-links">
                {{-- Previous --}}
                @if($logs->onFirstPage())
                    <span class="disabled">‹</span>
                @else
                    <a href="{{ $logs->previousPageUrl() }}">‹</a>
                @endif

                {{-- Page numbers --}}
                @foreach($logs->getUrlRange(1, $logs->lastPage()) as $page => $url)
                    @if($page == $logs->currentPage())
                        <span aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if($logs->hasMorePages())
                    <a href="{{ $logs->nextPageUrl() }}">›</a>
                @else
                    <span class="disabled">›</span>
                @endif
            </div>
        </div>
        @endif

    </div>{{-- /bv-sc --}}

</div>

<script>
    const searchInput  = document.getElementById('bv-search');
    const clearBtn     = document.getElementById('bv-clear');
    const spinner      = document.getElementById('bv-spinner');
    const roleFilter   = document.getElementById('bv-role-filter');
    const noResults    = document.getElementById('bv-no-results');
    const countEl      = document.getElementById('bv-count');
    const pluralEl     = document.getElementById('bv-plural');
    const pagination   = document.getElementById('bv-pagination');
    const rows         = document.querySelectorAll('#bv-tbody tr[data-search]');
    let searchTimer    = null;

    function applyFilters() {
        const q    = searchInput.value.trim().toLowerCase();
        const role = roleFilter.value.toLowerCase();
        let visible = 0;

        rows.forEach(row => {
            const haystack = row.dataset.search || '';
            const rowRole  = row.dataset.role   || '';
            const matchQ   = !q    || haystack.includes(q);
            const matchR   = !role || rowRole === role;
            const show     = matchQ && matchR;
            row.classList.toggle('ls-hidden', !show);
            if (show) visible++;
        });

        noResults.style.display   = (visible === 0 && rows.length > 0) ? 'block' : 'none';
        countEl.textContent        = visible;
        pluralEl.textContent       = visible !== 1 ? 's' : '';
        if (pagination) pagination.style.display = (q || role) ? 'none' : '';
        spinner.classList.remove('on');
    }

    searchInput.addEventListener('input', function () {
        clearBtn.classList.toggle('show', this.value.length > 0);
        spinner.classList.add('on');
        clearTimeout(searchTimer);
        searchTimer = setTimeout(applyFilters, 200);
    });

    function clearSearch() {
        searchInput.value = '';
        clearBtn.classList.remove('show');
        applyFilters();
        searchInput.focus();
    }
</script>

</x-app-layout>