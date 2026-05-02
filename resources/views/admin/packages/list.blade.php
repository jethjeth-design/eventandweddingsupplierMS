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
}

/* ── TOP ROW ── */
.pk-top{display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:.75rem;margin-bottom:1.75rem;}
.pk-title{font-family:var(--font-display);font-size:1.65rem;font-weight:700;color:var(--charcoal);line-height:1.15;}
.pk-title em{font-style:italic;color:var(--gold-dark);}
.pk-subtitle{font-size:.76rem;color:var(--warm-grey);margin-top:.2rem;font-family:var(--font-body);}

/* ── FILTER BAR ── */
.pk-filter-bar{display:flex;align-items:center;gap:.65rem;flex-wrap:wrap;margin-bottom:1.5rem;}
.pk-search-wrap{position:relative;flex:1;min-width:200px;max-width:320px;}
.pk-search-ico{position:absolute;left:.8rem;top:50%;transform:translateY(-50%);width:14px;height:14px;color:#C0B8B0;pointer-events:none;transition:color .2s;}
.pk-search-wrap:focus-within .pk-search-ico{color:var(--gold-dark);}
.pk-search-input{width:100%;padding:.62rem .9rem .62rem 2.35rem;background:var(--white);border:1.5px solid var(--border);border-radius:8px;font-family:var(--font-body);font-size:.82rem;color:var(--charcoal);outline:none;transition:border-color .2s,box-shadow .2s;}
.pk-search-input:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,.12);}
.pk-search-input::placeholder{color:#C0B8B0;}
.pk-sel-wrap{position:relative;}
.pk-sel-wrap::after{content:'';position:absolute;right:.85rem;top:50%;transform:translateY(-50%);width:0;height:0;border-left:4px solid transparent;border-right:4px solid transparent;border-top:5px solid #C0B8B0;pointer-events:none;}
.pk-select{padding:.62rem 2.2rem .62rem .9rem;background:var(--white);border:1.5px solid var(--border);border-radius:8px;font-family:var(--font-body);font-size:.82rem;color:var(--charcoal);outline:none;appearance:none;cursor:pointer;transition:border-color .2s,box-shadow .2s;}
.pk-select:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,.12);}
.pk-count-badge{font-size:.72rem;color:var(--warm-grey);font-family:var(--font-body);white-space:nowrap;margin-left:auto;}
.pk-count-badge span{font-weight:500;color:var(--gold-dark);}
.pk-search-clear{position:absolute;right:.7rem;top:50%;transform:translateY(-50%);width:16px;height:16px;display:none;align-items:center;justify-content:center;cursor:pointer;color:#C0B8B0;border:none;background:transparent;padding:0;}
.pk-search-clear:hover{color:var(--charcoal);}
.pk-search-clear svg{width:10px;height:10px;}
.pk-search-clear.visible{display:flex;}

/* ── CARD + TABLE ── */
.pk-card{background:var(--white);border:1.5px solid var(--border);border-radius:14px;overflow:hidden;}
.scroll-hint{display:none;align-items:center;gap:.4rem;font-size:.68rem;color:var(--warm-grey);padding:.55rem 1rem .1rem;font-family:var(--font-body);}
.scroll-hint svg{width:13px;height:13px;flex-shrink:0;}
@media(max-width:640px){.scroll-hint{display:flex;}}
.tbl-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch;scrollbar-width:thin;scrollbar-color:rgba(201,168,76,.4) transparent;}
.tbl-wrap::-webkit-scrollbar{height:4px;}
.tbl-wrap::-webkit-scrollbar-thumb{background:rgba(201,168,76,.45);border-radius:4px;}

.pk-table{width:100%;min-width:760px;border-collapse:collapse;font-family:var(--font-body);}
.pk-table thead{background:var(--ivory);border-bottom:1.5px solid var(--border);}
.pk-table thead th{padding:.8rem 1.1rem;font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--warm-grey);text-align:left;white-space:nowrap;}
.pk-table thead th:first-child{border-left:3px solid var(--gold);}
.pk-table tbody tr{border-bottom:1px solid #F0EBE5;transition:background .15s;}
.pk-table tbody tr:last-child{border-bottom:none;}
.pk-table tbody tr:hover{background:rgba(201,168,76,.04);}
.pk-table tbody tr.pk-hidden{display:none;}
.pk-table td{padding:.9rem 1.1rem;font-size:.83rem;color:var(--charcoal);vertical-align:middle;}
.pk-table tbody td:first-child{border-left:3px solid transparent;}
.pk-table tbody tr:hover td:first-child{border-left-color:rgba(201,168,76,.45);}

/* Cell types */
.td-pkg-name{font-family:var(--font-display);font-weight:700;font-size:.9rem;color:var(--charcoal);}
.td-supplier{font-size:.8rem;color:var(--warm-grey);}
.td-price{font-weight:700;font-size:.86rem;color:var(--gold-dark);white-space:nowrap;}
.td-type{display:inline-flex;align-items:center;padding:.22rem .62rem;border-radius:20px;font-size:.67rem;font-weight:500;letter-spacing:.04em;background:var(--gold-light);color:var(--gold-dark);border:1px solid rgba(201,168,76,.25);white-space:nowrap;}
.td-inclusions{padding-left:1rem;margin:0;list-style:disc;}
.td-inclusions li{font-size:.75rem;color:var(--warm-grey);line-height:1.55;}
.td-inclusions li::marker{color:var(--gold);}

/* View inclusions btn */
.inc-view-btn{display:inline-flex;align-items:center;gap:.35rem;padding:.28rem .72rem;border-radius:6px;border:1.5px solid var(--border);background:transparent;font-family:var(--font-body);font-size:.7rem;font-weight:500;color:var(--warm-grey);cursor:pointer;transition:border-color .15s,color .15s,background .15s;white-space:nowrap;}
.inc-view-btn svg{width:11px;height:11px;flex-shrink:0;}
.inc-view-btn:hover{border-color:var(--gold);color:var(--gold-dark);background:var(--gold-light);}

/* Status badges */
.pk-status{display:inline-flex;align-items:center;gap:.3rem;padding:.22rem .68rem;border-radius:20px;font-size:.67rem;font-weight:600;letter-spacing:.04em;white-space:nowrap;font-family:var(--font-body);}
.pk-status::before{content:'';width:5px;height:5px;border-radius:50%;flex-shrink:0;}
.pk-status.published{background:rgba(16,185,129,.1);color:#065F46;border:1px solid rgba(16,185,129,.22);}
.pk-status.published::before{background:#10B981;}
.pk-status.hidden{background:rgba(239,68,68,.1);color:#991B1B;border:1px solid rgba(239,68,68,.22);}
.pk-status.hidden::before{background:#EF4444;}

/* Empty state */
.pk-empty{text-align:center;padding:4rem 1.5rem;}
.pk-empty-icon{width:52px;height:52px;border-radius:50%;background:rgba(201,168,76,.08);display:flex;align-items:center;justify-content:center;margin:0 auto .9rem;color:var(--gold-dark);}
.pk-empty-icon svg{width:24px;height:24px;}
.pk-empty-title{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--charcoal);margin-bottom:.35rem;}
.pk-empty-desc{font-size:.8rem;color:var(--warm-grey);line-height:1.6;}

/* Live-search no-results row */
.pk-no-results{display:none;text-align:center;padding:3rem 1.5rem;}
.pk-no-results.visible{display:table-row;}

/* Pagination */
.pk-pagination{padding:1rem 1.25rem;border-top:1px solid var(--border);display:flex;justify-content:flex-end;}

/* Highlight match */
mark.pk-hl{background:rgba(201,168,76,.22);color:var(--gold-dark);border-radius:2px;padding:0 1px;}

/* ══════════════════════════════════════════
   INCLUSIONS MODAL
══════════════════════════════════════════ */
.mo-overlay{
    position:fixed;inset:0;z-index:8000;
    background:rgba(30,27,24,.55);
    display:none;align-items:center;justify-content:center;
    padding:1rem;
    backdrop-filter:blur(3px);
    overflow-y:auto;
}
.mo-overlay.open{display:flex;}

.mo-box{
    background:var(--white);border-radius:14px;border:1px solid var(--border);
    box-shadow:0 8px 40px rgba(30,27,24,.18);
    width:100%;max-width:480px;
    animation:moSlide .22s ease;
    margin:auto;flex-shrink:0;
    display:flex;flex-direction:column;
    max-height:calc(100vh - 2rem);
    overflow:hidden;
}
@keyframes moSlide{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}

.mo-head{
    display:flex;align-items:center;justify-content:space-between;
    padding:1.1rem 1.4rem;border-bottom:1px solid var(--border);
    flex-shrink:0;
}
.mo-head-l{display:flex;align-items:center;gap:.65rem;}
.mo-icon{width:32px;height:32px;border-radius:8px;background:rgba(201,168,76,.1);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
.mo-icon svg{width:15px;height:15px;}
.mo-title{font-family:var(--font-display);font-size:.95rem;font-weight:700;color:var(--charcoal);}
.mo-close{width:30px;height:30px;border-radius:50%;border:1.5px solid var(--border);background:var(--white);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--warm-grey);transition:border-color .15s,color .15s;}
.mo-close:hover{border-color:var(--gold);color:var(--gold-dark);}
.mo-close svg{width:12px;height:12px;}

.mo-meta{
    display:flex;align-items:center;flex-wrap:wrap;gap:.5rem;
    padding:.8rem 1.4rem;background:var(--ivory);border-bottom:1px solid var(--border);
    flex-shrink:0;
}
.mo-meta-pill{
    display:inline-flex;align-items:center;gap:.3rem;
    padding:.2rem .6rem;border-radius:20px;
    font-size:.67rem;font-weight:500;letter-spacing:.04em;
    font-family:var(--font-body);white-space:nowrap;
}
.mo-meta-pill.price{background:var(--gold-light);color:var(--gold-dark);border:1px solid rgba(201,168,76,.25);}
.mo-meta-pill.type{background:rgba(16,185,129,.08);color:#065F46;border:1px solid rgba(16,185,129,.2);}
.mo-meta-pill.status-pub{background:rgba(16,185,129,.1);color:#065F46;border:1px solid rgba(16,185,129,.22);}
.mo-meta-pill.status-hid{background:rgba(239,68,68,.1);color:#991B1B;border:1px solid rgba(239,68,68,.22);}
.mo-meta-pill svg{width:10px;height:10px;flex-shrink:0;}
.mo-meta-dot{width:5px;height:5px;border-radius:50%;flex-shrink:0;}

.mo-body{
    padding:1.2rem 1.4rem;
    overflow-y:auto;flex:1;min-height:0;
}
.mo-body::-webkit-scrollbar{width:4px;}
.mo-body::-webkit-scrollbar-thumb{background:var(--border-md);border-radius:99px;}
.mo-body::-webkit-scrollbar-thumb:hover{background:var(--gold);}

/* Supplier row */
.mo-supplier-row{
    display:flex;align-items:center;gap:.6rem;
    padding:.65rem .9rem;background:var(--ivory);
    border:1px solid var(--border);border-radius:8px;
    margin-bottom:1.1rem;
    font-family:var(--font-body);
}
.mo-supplier-row svg{width:14px;height:14px;color:var(--gold-dark);flex-shrink:0;}
.mo-supplier-label{font-size:.62rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--warm-grey);}
.mo-supplier-name{font-size:.82rem;font-weight:500;color:var(--charcoal);}

/* Inclusions section */
.mo-inc-header{
    display:flex;align-items:center;justify-content:space-between;
    margin-bottom:.7rem;
}
.mo-inc-label{font-size:.62rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--warm-grey);font-family:var(--font-body);}
.mo-inc-count{font-size:.7rem;color:var(--gold-dark);font-weight:500;font-family:var(--font-body);}

.mo-inc-list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.55rem;}
.mo-inc-item{
    display:flex;align-items:flex-start;gap:.75rem;
    padding:.7rem .9rem;
    background:var(--ivory);
    border:1px solid var(--border);
    border-radius:8px;
    transition:border-color .15s,background .15s;
}
.mo-inc-item:hover{border-color:rgba(201,168,76,.35);background:rgba(201,168,76,.04);}
.mo-inc-dot{
    width:7px;height:7px;border-radius:50%;
    background:var(--gold);flex-shrink:0;margin-top:.38rem;
}
.mo-inc-text{font-size:.82rem;color:var(--charcoal);line-height:1.5;font-family:var(--font-body);}

/* Empty inclusions */
.mo-inc-empty{
    text-align:center;padding:2rem 1rem;
    background:var(--ivory);border:1.5px dashed var(--border);
    border-radius:10px;
}
.mo-inc-empty svg{width:22px;height:22px;color:#C0B8B0;margin-bottom:.5rem;}
.mo-inc-empty p{font-size:.78rem;color:var(--warm-grey);font-family:var(--font-body);}

.mo-foot{
    padding:.85rem 1.4rem;border-top:1px solid var(--border);
    display:flex;align-items:center;justify-content:flex-end;
    flex-shrink:0;background:var(--white);
}
.mo-btn-close{display:inline-flex;align-items:center;gap:.4rem;padding:.62rem 1.3rem;border-radius:6px;border:1.5px solid var(--border);background:var(--white);font-family:var(--font-body);font-size:.82rem;font-weight:500;color:var(--warm-grey);cursor:pointer;transition:border-color .2s,color .2s;}
.mo-btn-close:hover{border-color:var(--gold);color:var(--charcoal);}
</style>

<div class="p-6" style="max-width:1100px;margin:auto;">

    {{-- ── TOP ROW ── --}}
    <div class="pk-top">
        <div>
            <h2 class="pk-title">Package <em>Management</em></h2>
            <p class="pk-subtitle">Browse and manage all supplier packages</p>
        </div>
    </div>

    {{-- ── FILTER BAR ── --}}
    <div class="pk-filter-bar">

        <div class="pk-search-wrap">
            <svg class="pk-search-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                <circle cx="8.5" cy="8.5" r="5.5"/><path d="M15 15l-3-3"/>
            </svg>
            <input
                id="pkSearch"
                type="text"
                class="pk-search-input"
                placeholder="Search package or supplier…"
                autocomplete="off"
                value="{{ request('search') }}"
            >
            <button type="button" class="pk-search-clear" id="pkSearchClear" title="Clear search">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
            </button>
        </div>

        <div class="pk-sel-wrap">
            <select id="pkStatus" class="pk-select">
                <option value="">All Statuses</option>
                <option value="published" {{ request('status') === '1' ? 'selected' : '' }}>Published</option>
                <option value="hidden"    {{ request('status') === '0' ? 'selected' : '' }}>Hidden</option>
            </select>
        </div>

        <div class="pk-sel-wrap">
            <select id="pkType" class="pk-select">
                <option value="">All Types</option>
                @foreach($packages->pluck('event_type')->unique()->filter()->sort()->values() as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <div class="pk-count-badge" id="pkCount">
            Showing <span id="pkCountNum">{{ $packages->count() }}</span> of {{ $packages->total() }} packages
        </div>

    </div>

    {{-- ── TABLE CARD ── --}}
    @if($packages->count())
    <div class="pk-card">
        <div class="scroll-hint">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 10h12M10 4l6 6-6 6"/></svg>
            Scroll sideways to see more
        </div>
        <div class="tbl-wrap">
            <table class="pk-table" id="pkTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Package</th>
                        <th>Supplier</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th style="text-align:center;">Inclusions</th>
                    </tr>
                </thead>
                <tbody id="pkTbody">
                    @foreach($packages as $package)
                    <tr
                        data-name="{{ strtolower($package->name) }}"
                        data-supplier="{{ strtolower($package->supplier->business_name ?? '') }}"
                        data-status="{{ $package->is_listed ? 'published' : 'hidden' }}"
                        data-type="{{ strtolower($package->event_type) }}"
                    >
                        <td style="color:#C0B8B0;font-size:.72rem;width:44px;">{{ $loop->iteration }}</td>

                        <td>
                            <div class="td-pkg-name" data-field="name">{{ $package->name }}</div>
                        </td>

                        <td>
                            <div class="td-supplier" data-field="supplier">
                                {{ $package->supplier->business_name ?? 'N/A' }}
                            </div>
                        </td>

                        <td>
                            <div class="td-price">₱{{ number_format($package->price) }}</div>
                        </td>

                        <td>
                            <span class="td-type">{{ $package->event_type }}</span>
                        </td>

                        <td>
                            @if($package->is_listed)
                                <span class="pk-status published">Published</span>
                            @else
                                <span class="pk-status hidden">Hidden</span>
                            @endif
                        </td>

                        <td style="text-align:center;">
                            {{-- View Inclusions button — passes all data via data attributes --}}
                            <button
                                type="button"
                                class="inc-view-btn"
                                onclick="openIncModal(this)"
                                data-pkg-name="{{ $package->name }}"
                                data-pkg-price="₱{{ number_format($package->price) }}"
                                data-pkg-type="{{ $package->event_type }}"
                                data-pkg-status="{{ $package->is_listed ? 'published' : 'hidden' }}"
                                data-pkg-supplier="{{ $package->supplier->business_name ?? 'N/A' }}"
                                data-pkg-count="{{ $package->inclusions->count() }}"
                                data-pkg-inclusions="{{ $package->inclusions->pluck('title')->toJson() }}"
                            >
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <circle cx="7" cy="7" r="5.5"/>
                                    <path d="M7 5v4M7 9.5v.5"/>
                                </svg>
                                {{ $package->inclusions->count() }}
                                {{ Str::plural('item', $package->inclusions->count()) }}
                            </button>
                        </td>
                    </tr>
                    @endforeach

                    {{-- Live-search no-results row --}}
                    <tr class="pk-no-results" id="pkNoResults">
                        <td colspan="7" style="padding:3rem 1.5rem;">
                            <div style="text-align:center;">
                                <div class="pk-empty-icon" style="margin:0 auto .9rem;">
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="8.5" cy="8.5" r="5.5"/><path d="M15 15l-3-3"/>
                                    </svg>
                                </div>
                                <div class="pk-empty-title">No packages match your search</div>
                                <div class="pk-empty-desc">Try a different name or clear the filters.</div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="pk-pagination">
            {{ $packages->appends(request()->query())->links() }}
        </div>
    </div>

    @else
    <div class="pk-card">
        <div class="pk-empty">
            <div class="pk-empty-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="3" width="14" height="14" rx="2"/><path d="M7 8h6M7 11h4"/>
                </svg>
            </div>
            <div class="pk-empty-title">No Packages Found</div>
            <div class="pk-empty-desc">There are no packages matching your current filters.</div>
        </div>
    </div>
    @endif

</div>

{{-- ══════════════════════════════════════════
     INCLUSIONS MODAL
══════════════════════════════════════════ --}}
<div class="mo-overlay" id="incOverlay" onclick="if(event.target===this)closeIncModal()">
    <div class="mo-box">

        {{-- Header --}}
        <div class="mo-head">
            <div class="mo-head-l">
                <div class="mo-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="3" y="3" width="14" height="14" rx="2"/><path d="M7 8h6M7 11h4"/>
                    </svg>
                </div>
                <div>
                    <div class="mo-title" id="moTitle">Package Inclusions</div>
                </div>
            </div>
            <button type="button" class="mo-close" onclick="closeIncModal()">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
            </button>
        </div>

        {{-- Meta strip --}}
        <div class="mo-meta" id="moMeta">
            {{-- Populated by JS --}}
        </div>

        {{-- Body --}}
        <div class="mo-body">

            {{-- Supplier --}}
            <div class="mo-supplier-row" id="moSupplierRow">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M3 9l7-7 7 7v9a1 1 0 01-1 1H4a1 1 0 01-1-1z"/>
                    <rect x="7" y="13" width="6" height="6" rx="1"/>
                </svg>
                <div>
                    <div class="mo-supplier-label">Supplier</div>
                    <div class="mo-supplier-name" id="moSupplierName"></div>
                </div>
            </div>

            {{-- Inclusions list --}}
            <div class="mo-inc-header">
                <div class="mo-inc-label">Inclusions</div>
                <div class="mo-inc-count" id="moIncCount"></div>
            </div>

            <ul class="mo-inc-list" id="moIncList">
                {{-- Populated by JS --}}
            </ul>

        </div>

        {{-- Footer --}}
        <div class="mo-foot">
            <button type="button" class="mo-btn-close" onclick="closeIncModal()">Close</button>
        </div>

    </div>
</div>

<script>
/* ═══════════════════════════════════════
   INCLUSIONS MODAL
═══════════════════════════════════════ */
function openIncModal(btn) {
    var name        = btn.dataset.pkgName;
    var price       = btn.dataset.pkgPrice;
    var type        = btn.dataset.pkgType;
    var status      = btn.dataset.pkgStatus;
    var supplier    = btn.dataset.pkgSupplier;
    var count       = parseInt(btn.dataset.pkgCount, 10);
    var inclusions  = JSON.parse(btn.dataset.pkgInclusions || '[]');

    /* Title */
    document.getElementById('moTitle').textContent = name;

    /* Meta strip */
    var statusClass = status === 'published' ? 'status-pub' : 'status-hid';
    var statusDot   = status === 'published' ? '#10B981' : '#EF4444';
    var statusLabel = status === 'published' ? 'Published' : 'Hidden';
    document.getElementById('moMeta').innerHTML =
        '<span class="mo-meta-pill price">' +
            '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="10" r="7"/><path d="M10 6v8M7.5 8.5h4a1.5 1.5 0 010 3h-3a1.5 1.5 0 000 3H13"/></svg>' +
            price +
        '</span>' +
        '<span class="mo-meta-pill type">' +
            '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="4" width="14" height="13" rx="2"/><path d="M3 8h14M8 4V2M12 4V2"/></svg>' +
            type +
        '</span>' +
        '<span class="mo-meta-pill ' + statusClass + '">' +
            '<span class="mo-meta-dot" style="background:' + statusDot + '"></span>' +
            statusLabel +
        '</span>';

    /* Supplier */
    document.getElementById('moSupplierName').textContent = supplier;

    /* Count */
    document.getElementById('moIncCount').textContent =
        count + (count === 1 ? ' inclusion' : ' inclusions');

    /* List */
    var list = document.getElementById('moIncList');
    list.innerHTML = '';

    if (inclusions.length === 0) {
        list.innerHTML =
            '<li><div class="mo-inc-empty">' +
                '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="14" height="14" rx="2"/><path d="M7 8h6M7 11h4"/></svg>' +
                '<p>No inclusions added for this package.</p>' +
            '</div></li>';
    } else {
        inclusions.forEach(function(title, idx) {
            var li = document.createElement('li');
            li.className = 'mo-inc-item';
            li.innerHTML =
                '<div class="mo-inc-dot"></div>' +
                '<div class="mo-inc-text">' + escHtml(title) + '</div>';
            list.appendChild(li);
        });
    }

    /* Open */
    document.getElementById('incOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeIncModal() {
    document.getElementById('incOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

/* Escape HTML to prevent XSS */
function escHtml(str) {
    return String(str)
        .replace(/&/g,'&amp;')
        .replace(/</g,'&lt;')
        .replace(/>/g,'&gt;')
        .replace(/"/g,'&quot;');
}

/* Close on Escape */
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeIncModal();
});

/* ═══════════════════════════════════════
   LIVE SEARCH + FILTERS
═══════════════════════════════════════ */
(function () {
    var searchInput  = document.getElementById('pkSearch');
    var clearBtn     = document.getElementById('pkSearchClear');
    var statusSelect = document.getElementById('pkStatus');
    var typeSelect   = document.getElementById('pkType');
    var tbody        = document.getElementById('pkTbody');
    var noResults    = document.getElementById('pkNoResults');
    var countNum     = document.getElementById('pkCountNum');

    if (!tbody) return;

    var rows = Array.from(tbody.querySelectorAll('tr[data-name]'));

    rows.forEach(function (row) {
        row.querySelectorAll('[data-field]').forEach(function (el) {
            el.dataset.original = el.textContent.trim();
        });
    });

    function highlight(el, term) {
        var orig = el.dataset.original;
        if (!term) { el.innerHTML = orig; return; }
        var escaped = term.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        el.innerHTML = orig.replace(new RegExp('(' + escaped + ')', 'gi'),
            '<mark class="pk-hl">$1</mark>');
    }

    function applyFilters() {
        var term    = searchInput.value.trim().toLowerCase();
        var status  = statusSelect.value;
        var type    = typeSelect.value.toLowerCase();
        var visible = 0;

        rows.forEach(function (row) {
            var matchSearch = !term ||
                row.dataset.name.includes(term) ||
                row.dataset.supplier.includes(term);
            var matchStatus = !status || row.dataset.status === status;
            var matchType   = !type   || row.dataset.type   === type;
            var show = matchSearch && matchStatus && matchType;

            row.classList.toggle('pk-hidden', !show);
            if (show) {
                visible++;
                row.querySelectorAll('[data-field]').forEach(function (el) {
                    highlight(el, term);
                });
            }
        });

        noResults.classList.toggle('visible', visible === 0);
        if (countNum) countNum.textContent = visible;
        clearBtn.classList.toggle('visible', searchInput.value.length > 0);
    }

    var _timer;
    searchInput.addEventListener('input', function () {
        clearTimeout(_timer);
        _timer = setTimeout(applyFilters, 180);
    });
    clearBtn.addEventListener('click', function () {
        searchInput.value = '';
        applyFilters();
        searchInput.focus();
    });
    statusSelect.addEventListener('change', applyFilters);
    typeSelect.addEventListener('change', applyFilters);
    applyFilters();
})();
</script>

</x-app-layout>