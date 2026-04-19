<x-app-layout>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap');

:root {
    --gold:#C9A84C; --gold-dark:#8A6A1F; --gold-light:rgba(201,168,76,0.12);
    --ivory:#FAF7F2; --charcoal:#1E1B18; --warm-grey:#706B65;
    --border:#E5DDD5; --border-md:#E0D8D0;
    --white:#FFFFFF; --danger:#DC2626;
    --font-display:'Playfair Display',Georgia,serif;
    --font-body:'DM Sans',sans-serif;
}

/* ── TOP ROW ── */
.pkg-top { display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:.75rem; margin-bottom:1.4rem; }
.pkg-title { font-family:var(--font-display); font-size:1.65rem; font-weight:700; color:var(--charcoal); line-height:1.15; }
.pkg-title em { font-style:italic; color:var(--gold-dark); }
.pkg-subtitle { font-size:.76rem; color:var(--warm-grey); margin-top:.2rem; font-family:var(--font-body); }
.pkg-badge { font-size:.65rem; font-weight:500; letter-spacing:.07em; text-transform:uppercase; color:var(--gold-dark); background:var(--gold-light); border:1px solid rgba(201,168,76,.3); padding:.28rem .75rem; border-radius:20px; white-space:nowrap; font-family:var(--font-body); }

/* ── SEARCH / FILTER BAR ── */
.pkg-toolbar { display:flex; align-items:center; gap:.65rem; flex-wrap:wrap; margin-bottom:1rem; }
.pkg-search-wrap { display:flex; align-items:center; gap:.5rem; flex:1; min-width:180px; background:var(--white); border:1.5px solid var(--border); border-radius:8px; padding:.42rem .85rem; transition:border-color .2s,box-shadow .2s; }
.pkg-search-wrap:focus-within { border-color:var(--gold); box-shadow:0 0 0 3px rgba(201,168,76,.1); }
.pkg-search-wrap svg { width:13px; height:13px; color:#C0B8B0; flex-shrink:0; }
.pkg-search-wrap input { border:none; outline:none; background:transparent; font-family:var(--font-body); font-size:.8rem; color:var(--charcoal); width:100%; }
.pkg-search-wrap input::placeholder { color:#C0B8B0; }
.pkg-filter-select { padding:.42rem .85rem; border:1.5px solid var(--border); border-radius:8px; font-family:var(--font-body); font-size:.8rem; color:var(--charcoal); background:var(--white); outline:none; cursor:pointer; transition:border-color .2s; appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' fill='none' stroke='%23C0B8B0' stroke-width='1.5'%3E%3Cpath d='M1 1l4 4 4-4'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right .6rem center; padding-right:1.8rem; }
.pkg-filter-select:focus { border-color:var(--gold); box-shadow:0 0 0 3px rgba(201,168,76,.1); }

/* ── CARD SHELL ── */
.pkg-card { background:var(--white); border:1.5px solid var(--border); border-radius:14px; overflow:hidden; }

/* ── SCROLL HINT ── */
.scroll-hint { display:none; align-items:center; gap:.4rem; font-size:.68rem; color:var(--warm-grey); padding:.55rem 1rem .1rem; font-family:var(--font-body); }
.scroll-hint svg { width:13px; height:13px; flex-shrink:0; }
@media(max-width:640px) { .scroll-hint { display:flex; } }

.tbl-wrap { overflow-x:auto; -webkit-overflow-scrolling:touch; scrollbar-width:thin; scrollbar-color:rgba(201,168,76,.4) transparent; }
.tbl-wrap::-webkit-scrollbar { height:4px; }
.tbl-wrap::-webkit-scrollbar-thumb { background:rgba(201,168,76,.45); border-radius:4px; }

/* ── TABLE ── */
.pkg-table { width:100%; min-width:700px; border-collapse:collapse; font-family:var(--font-body); }
.pkg-table thead { background:var(--ivory); border-bottom:1.5px solid var(--border); }
.pkg-table thead th { padding:.8rem 1.1rem; font-size:.6rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--warm-grey); text-align:left; white-space:nowrap; }
.pkg-table thead th:first-child { border-left:3px solid var(--gold); }
.pkg-table tbody tr { border-bottom:1px solid #F0EBE5; transition:background .15s; }
.pkg-table tbody tr:last-child { border-bottom:none; }
.pkg-table tbody tr:hover { background:rgba(201,168,76,.04); }
.pkg-table td { padding:.9rem 1.1rem; font-size:.83rem; color:var(--charcoal); vertical-align:middle; }
.pkg-table tbody td:first-child { border-left:3px solid transparent; }
.pkg-table tbody tr:hover td:first-child { border-left-color:rgba(201,168,76,.45); }

/* ── CELL TYPES ── */
.td-name { font-family:var(--font-display); font-weight:700; font-size:.9rem; color:var(--charcoal); white-space:nowrap; }
.td-supplier { font-size:.72rem; color:var(--warm-grey); margin-top:2px; white-space:nowrap; }
.td-desc { color:var(--warm-grey); font-size:.78rem; line-height:1.45; min-width:140px; max-width:200px; }
.td-price { font-weight:700; font-size:.9rem; color:var(--gold-dark); white-space:nowrap; }
.td-price small { font-size:.66rem; color:var(--warm-grey); font-weight:400; margin-left:2px; }
.td-cap { display:inline-flex; align-items:center; gap:.38rem; white-space:nowrap; }
.td-cap svg { flex-shrink:0; }
.td-event { display:inline-flex; align-items:center; padding:.25rem .65rem; border-radius:20px; font-size:.68rem; font-weight:500; letter-spacing:.04em; background:var(--gold-light); color:var(--gold-dark); border:1px solid rgba(201,168,76,.25); white-space:nowrap; }

/* Inclusions pill button */
.incl-btn { display:inline-flex; align-items:center; gap:.3rem; padding:.25rem .7rem; border-radius:20px; font-size:.68rem; font-weight:600; background:rgba(201,168,76,.08); color:var(--gold-dark); border:1px solid rgba(201,168,76,.22); cursor:pointer; transition:background .15s,border-color .15s; white-space:nowrap; font-family:var(--font-body); }
.incl-btn svg { width:10px; height:10px; }
.incl-btn:hover { background:rgba(201,168,76,.16); border-color:var(--gold); }
.incl-none { font-size:.75rem; color:#C0B8B0; }

.empty-state { text-align:center; padding:3rem 1rem; color:var(--warm-grey); font-size:.83rem; }

/* ── MODAL BACKDROP ── */
.bv-modal-backdrop { display:none; position:fixed; inset:0; background:rgba(30,27,24,.52); z-index:300; align-items:center; justify-content:center; padding:1.5rem; backdrop-filter:blur(3px); }
.bv-modal-backdrop.open { display:flex; }

/* ── MODAL BOX ── */
.bv-modal { background:var(--white); border-radius:12px; width:480px; max-width:100%; border-top:2px solid var(--gold); max-height:calc(100vh - 3rem); display:flex; flex-direction:column; overflow:hidden; margin:auto; flex-shrink:0; box-shadow:0 20px 60px rgba(30,27,24,.22); }
.bv-modal-header { flex-shrink:0; display:flex; align-items:center; justify-content:space-between; padding:1.1rem 1.4rem; border-bottom:1px solid var(--border); background:var(--white); }
.bv-modal-title { font-family:var(--font-display); font-size:1.05rem; font-weight:700; color:var(--charcoal); }
.bv-modal-title em { font-style:italic; color:var(--gold-dark); }
.bv-modal-close { width:28px; height:28px; border:1px solid var(--border); background:var(--ivory); border-radius:6px; cursor:pointer; font-size:15px; color:var(--warm-grey); display:flex; align-items:center; justify-content:center; transition:border-color .18s,color .18s; }
.bv-modal-close:hover { border-color:var(--gold); color:var(--gold-dark); }
.bv-modal-body { padding:1.3rem 1.4rem; overflow-y:auto; flex:1; min-height:0; }
.bv-modal-body::-webkit-scrollbar { width:4px; }
.bv-modal-body::-webkit-scrollbar-thumb { background:var(--border-md); border-radius:99px; }
.bv-modal-footer { flex-shrink:0; padding:.85rem 1.4rem; border-top:1px solid var(--border); display:flex; justify-content:flex-end; background:var(--white); }
.bv-btn-close { padding:.55rem 1.2rem; border-radius:6px; border:1px solid var(--border-md); background:var(--white); font-size:.78rem; font-weight:500; color:var(--warm-grey); cursor:pointer; font-family:var(--font-body); transition:border-color .18s,color .18s; }
.bv-btn-close:hover { border-color:var(--gold); color:var(--charcoal); }

/* Inclusions inside modal */
.incl-pkg-name { font-family:var(--font-display); font-size:.95rem; font-weight:700; color:var(--charcoal); margin-bottom:.25rem; }
.incl-pkg-meta { font-size:.72rem; color:var(--warm-grey); margin-bottom:1.1rem; font-family:var(--font-body); }
.incl-list { display:flex; flex-direction:column; gap:.45rem; }
.incl-list-item { display:flex; align-items:flex-start; gap:.65rem; padding:.6rem .85rem; border-radius:6px; background:var(--ivory); border:1px solid var(--border); font-size:.82rem; color:var(--charcoal); font-family:var(--font-body); line-height:1.4; }
.incl-num { width:20px; height:20px; border-radius:50%; background:rgba(201,168,76,.12); border:1px solid rgba(201,168,76,.25); display:flex; align-items:center; justify-content:center; font-size:.58rem; font-weight:700; color:var(--gold-dark); flex-shrink:0; margin-top:1px; }
.incl-empty { text-align:center; padding:2rem; font-size:.82rem; color:#C0B8B0; font-family:var(--font-body); }

/* ── PAGINATION ── */
.pkg-pagination { display:flex; justify-content:flex-end; margin-top:1rem; }
</style>

<div class="p-6">

    <div class="pkg-top">
        <div>
            <h2 class="pkg-title">All <em>Packages</em></h2>
            <p class="pkg-subtitle">Browse event packages with inclusions from all suppliers</p>
        </div>
         
 
        @if(isset($packages))
            <span class="pkg-badge">{{ $packages->total() }} package{{ $packages->total() !== 1 ? 's' : '' }}</span>
        @endif
    </div>

    {{-- Toolbar: search + filter --}}
    <form method="GET" action="{{ request()->url() }}" class="pkg-toolbar">
        <div class="pkg-search-wrap">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="9" cy="9" r="6"/><path d="M15 15l3 3"/>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search packages by name…">
        </div>
        <select name="event_type" class="pkg-filter-select" onchange="this.form.submit()">
            <option value="">All event types</option>
            @foreach(['Wedding','Debut','Birthday','Corporate','Anniversary','Baptism','Other'] as $et)
                <option value="{{ $et }}" {{ request('event_type') === $et ? 'selected' : '' }}>{{ $et }}</option>
            @endforeach
        </select>
        <button type="submit" style="display:none;"></button>
    </form>

    <div class="pkg-card">

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
                        <th>#</th>
                        <th>Package Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Guests</th>
                        <th>Event Type</th>
                        <th>Inclusions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($packages as $i => $package)
                    @php
                        $inclusions = $package->inclusions ?? collect();
                        $inclCount  = count($inclusions);
                    @endphp
                    <tr>
                        {{-- Row number --}}
                        <td style="color:#C0B8B0;font-size:.72rem;width:40px;">
                            {{ $packages->firstItem() + $i }}
                        </td>

                        {{-- Name + supplier --}}
                        <td>
                            <div class="td-name">{{ $package->name }}</div>
                            @if($package->supplier)
                                <div class="td-supplier">
                                    {{ $package->supplier->business_name
                                        ?? trim(($package->supplier->first_name ?? '') . ' ' . ($package->supplier->last_name ?? ''))
                                        ?: 'Unknown Supplier' }}
                                </div>
                            @endif
                        </td>

                        {{-- Description --}}
                        <td>
                            <div class="td-desc">{{ Str::limit($package->description, 55) }}</div>
                        </td>

                        {{-- Price --}}
                        <td>
                            <div class="td-price">
                                ₱{{ number_format($package->price, 2) }}
                                <small>starting</small>
                            </div>
                        </td>

                        {{-- Guest capacity --}}
                        <td>
                            <div class="td-cap">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="#706B65" stroke-width="1.6">
                                    <circle cx="7" cy="6" r="3"/>
                                    <path d="M1 17c0-3 2.7-5 6-5"/>
                                    <circle cx="13" cy="6" r="3"/>
                                    <path d="M19 17c0-3-2.7-5-6-5s-6 2-6 5"/>
                                </svg>
                                {{ number_format($package->guest_capacity) }}
                            </div>
                        </td>

                        {{-- Event type --}}
                        <td>
                            <span class="td-event">{{ $package->event_type }}</span>
                        </td>

                        {{-- Inclusions --}}
                        <td>
                            @if($inclCount > 0)
                                <button type="button" class="incl-btn"
                                    onclick="openInclModal(
                                        '{{ addslashes($package->name) }}',
                                        '{{ addslashes($package->event_type ?? '') }}',
                                        {{ json_encode($inclusions->pluck('title')->toArray()) }}
                                    )">
                                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path d="M2 4h10M2 7h10M2 10h6"/>
                                    </svg>
                                    {{ $inclCount }} item{{ $inclCount !== 1 ? 's' : '' }}
                                </button>
                            @else
                                <span class="incl-none">None</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="empty-state">
                            No packages found
                            @if(request('search') || request('event_type'))
                                for your current filters.
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if(isset($packages) && $packages->hasPages())
    <div class="pkg-pagination">
        {{ $packages->withQueryString()->links() }}
    </div>
    @endif

</div>

{{-- ════════════════════════════════
     INCLUSIONS MODAL
════════════════════════════════ --}}
<div id="inclModal" class="bv-modal-backdrop">
    <div class="bv-modal">
        <div class="bv-modal-header">
            <span class="bv-modal-title"><em>Package</em> Inclusions</span>
            <button class="bv-modal-close" onclick="closeInclModal()">✕</button>
        </div>
        <div class="bv-modal-body">
            <div class="incl-pkg-name" id="modal-pkg-name"></div>
            <div class="incl-pkg-meta" id="modal-pkg-meta"></div>
            <div class="incl-list" id="modal-incl-list"></div>
        </div>
        <div class="bv-modal-footer">
            <button type="button" class="bv-btn-close" onclick="closeInclModal()">Close</button>
        </div>
    </div>
</div>

<script>
function openInclModal(name, eventType, inclusions) {
    document.getElementById('modal-pkg-name').textContent = name;
    document.getElementById('modal-pkg-meta').textContent = eventType ? eventType + ' package' : 'Package';

    const list = document.getElementById('modal-incl-list');
    list.innerHTML = '';

    const items = Array.isArray(inclusions) ? inclusions.filter(Boolean) : [];

    if (items.length === 0) {
        list.innerHTML = '<div class="incl-empty">No inclusions listed for this package.</div>';
    } else {
        items.forEach(function(item, idx) {
            const el = document.createElement('div');
            el.className = 'incl-list-item';
            el.innerHTML =
                '<span class="incl-num">' + (idx + 1) + '</span>' +
                '<span>' + escHtml(item) + '</span>';
            list.appendChild(el);
        });
    }

    document.getElementById('inclModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeInclModal() {
    document.getElementById('inclModal').classList.remove('open');
    document.body.style.overflow = '';
}

document.getElementById('inclModal').addEventListener('click', function(e) {
    if (e.target === this) closeInclModal();
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeInclModal();
});

function escHtml(str) {
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}

/* Live search on keyup — optional enhancement */
document.querySelector('.pkg-search-wrap input').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') this.closest('form').submit();
});
</script>

</x-app-layout>