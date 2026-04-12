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

    /* ── Card ── */
    .bv-card { background:var(--white); border:1.5px solid var(--border); border-radius:14px; overflow:hidden; }

    /* ── Scroll hint — mobile only ── */
    .scroll-hint { display:none; align-items:center; gap:.4rem; font-size:.68rem; color:var(--warm-grey); padding:.55rem 1rem .1rem; font-family:var(--font-body); }
    .scroll-hint svg { width:13px; height:13px; flex-shrink:0; }
    @media(max-width:700px) { .scroll-hint { display:flex; } }

    /* ── Scrollable wrapper ── */
    .tbl-wrap { overflow-x:auto; -webkit-overflow-scrolling:touch; scrollbar-width:thin; scrollbar-color:rgba(201,168,76,.4) transparent; }
    .tbl-wrap::-webkit-scrollbar { height:4px; }
    .tbl-wrap::-webkit-scrollbar-track { background:transparent; }
    .tbl-wrap::-webkit-scrollbar-thumb { background:rgba(201,168,76,.45); border-radius:4px; }

    /* ── Table ── */
    .bv-table { width:100%; min-width:780px; border-collapse:collapse; font-family:var(--font-body); }
    .bv-table thead { background:var(--ivory); border-bottom:1.5px solid var(--border); }
    .bv-table thead th { padding:.8rem 1rem; font-size:.6rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--warm-grey); text-align:left; white-space:nowrap; }
    .bv-table thead th:first-child { border-left:3px solid var(--gold); }
    .bv-table thead th:last-child { text-align:right; }
    .bv-table tbody tr { border-bottom:1px solid #F0EBE5; transition:background .15s; }
    .bv-table tbody tr:last-child { border-bottom:none; }
    .bv-table tbody tr:hover { background:rgba(201,168,76,.03); }
    .bv-table tbody td { padding:.85rem 1rem; font-size:.82rem; color:var(--charcoal); vertical-align:middle; }
    .bv-table tbody td:first-child { border-left:3px solid transparent; }
    .bv-table tbody tr:hover td:first-child { border-left-color:rgba(201,168,76,.45); }
    .bv-table tbody td:last-child { text-align:right; }

    /* ── Cells ── */
    .bv-row-num { display:inline-flex; align-items:center; justify-content:center; width:24px; height:24px; background:var(--ivory); border:1px solid var(--border); border-radius:50%; font-size:.65rem; font-weight:700; color:var(--warm-grey); }
    .bv-avatar { width:38px; height:38px; border-radius:8px; background:rgba(201,168,76,.12); border:1.5px solid rgba(201,168,76,.25); display:flex; align-items:center; justify-content:center; font-family:var(--font-display); font-size:.78rem; font-weight:700; color:var(--gold-dark); flex-shrink:0; overflow:hidden; }
    .bv-avatar img { width:100%; height:100%; object-fit:cover; display:block; }
    .bv-cell-name { font-family:var(--font-display); font-weight:700; font-size:.88rem; color:var(--charcoal); white-space:nowrap; }
    .bv-cell-sub { font-size:.72rem; color:var(--warm-grey); margin-top:.1rem; }
    .bv-cell-muted { color:var(--warm-grey); font-size:.8rem; }
    .bv-cell-addr { max-width:160px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; color:var(--warm-grey); font-size:.8rem; }
    .bv-biz-badge { display:inline-flex; padding:.22rem .6rem; border-radius:20px; font-size:.67rem; font-weight:500; background:var(--gold-light); color:var(--gold-dark); border:1px solid rgba(201,168,76,.22); white-space:nowrap; }
    .bv-cell-email { font-size:.78rem; color:var(--warm-grey); font-style:italic; }

    /* ── Action buttons ── */
    .bv-actions { display:inline-flex; align-items:center; gap:.45rem; justify-content:flex-end; }
    .bv-btn-edit { display:inline-flex; align-items:center; gap:.35rem; padding:.35rem .8rem; font-size:.73rem; font-weight:500; border-radius:6px; border:1.5px solid var(--border); background:var(--white); color:var(--charcoal); text-decoration:none; cursor:pointer; font-family:var(--font-body); transition:border-color .18s,color .18s,background .18s; white-space:nowrap; }
    .bv-btn-edit svg { width:11px; height:11px; }
    .bv-btn-edit:hover { border-color:var(--gold); color:var(--gold-dark); background:rgba(201,168,76,.06); }
    .bv-btn-delete { display:inline-flex; align-items:center; gap:.35rem; padding:.35rem .8rem; font-size:.73rem; font-weight:500; border-radius:6px; border:1.5px solid #FADBD8; background:var(--white); color:#C0392B; cursor:pointer; font-family:var(--font-body); transition:border-color .18s,background .18s; white-space:nowrap; }
    .bv-btn-delete svg { width:11px; height:11px; }
    .bv-btn-delete:hover { border-color:#C0392B; background:#FFF5F5; }

    /* ── Empty state ── */
    .bv-empty { text-align:center; padding:4rem 2rem; color:var(--warm-grey); }
    .bv-empty svg { width:44px; height:44px; color:#DDD4C8; margin:0 auto .85rem; display:block; }
    .bv-empty-title { font-family:var(--font-display); font-size:1.05rem; color:var(--charcoal); margin-bottom:.3rem; }
    .bv-empty-sub { font-size:.8rem; }

    /* ── Alert ── */
    .bv-alert { display:flex; align-items:center; gap:.6rem; background:#F0FDF4; border:1px solid #A7F3D0; border-radius:8px; padding:.7rem 1rem; font-size:.8rem; color:#065F46; margin-bottom:1.4rem; font-family:var(--font-body); }
    .bv-alert svg { width:15px; height:15px; color:#10B981; flex-shrink:0; }
    </style>

    <div class="p-6">

        @if(session('success'))
        <div class="bv-alert">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <div class="bv-page-header">
            <div>
                <h1 class="bv-page-title">Supplier <em>Management</em></h1>
                <p class="bv-page-sub">View and manage all registered suppliers</p>
            </div>
            @if(isset($supplierProfiles))
            <span class="bv-badge">{{ $supplierProfiles->count() }} suppliers</span>
            @endif
        </div>

        <div class="bv-card">

            <div class="scroll-hint">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6">
                    <path d="M4 10h12M10 4l6 6-6 6"/>
                </svg>
                Scroll sideways to see more
            </div>

            <div class="tbl-wrap">
                @if(isset($supplierProfiles) && $supplierProfiles->count())
                <table class="bv-table">
                    <thead>
                        <tr>
                            <th style="width:36px">#</th>
                            <th style="width:48px">Photo</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Business</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($supplierProfiles as $i => $supplier)
                        <tr>
                            <td><span class="bv-row-num">{{ $i + 1 }}</span></td>

                            <td>
                                <div class="bv-avatar">
                                    @if($supplier->photo)
                                        <img src="{{ asset('storage/' . $supplier->photo) }}"
                                             alt="{{ $supplier->first_name }}">
                                    @else
                                        {{ strtoupper(substr($supplier->first_name, 0, 1) . substr($supplier->last_name, 0, 1)) }}
                                    @endif
                                </div>
                            </td>

                            <td>
                                <div class="bv-cell-name">{{ $supplier->first_name }} {{ $supplier->last_name }}</div>
                                @if($supplier->categories->count())
                                <div class="bv-cell-sub">{{ $supplier->categories->pluck('name')->join(', ') }}</div>
                                @endif
                            </td>

                            <td class="bv-cell-muted">{{ $supplier->phone ?? '—' }}</td>

                            <td>
                                <div class="bv-cell-addr" title="{{ $supplier->address }}">
                                    {{ $supplier->address ?? '—' }}
                                </div>
                            </td>

                            <td>
                                @if($supplier->business_name)
                                    <span class="bv-biz-badge">{{ $supplier->business_name }}</span>
                                @else
                                    <span class="bv-cell-muted">—</span>
                                @endif
                            </td>

                            <td class="bv-cell-email">{{ $supplier->user->email ?? '—' }}</td>

                            <td>
                                {{--<div class="bv-actions">
                                    <a href="{{ route('admin.supplier.edit', $supplier->id) }}"
                                       class="bv-btn-edit">
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                            <path d="M11.5 2.5l2 2L5 13H3v-2L11.5 2.5z"/>
                                        </svg>
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.supplier.destroy', $supplier->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this supplier?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bv-btn-delete">
                                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                                <path d="M3 4h10M5 4V3h6v1M6 7v5M10 7v5M4 4l1 9h6l1-9"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>--}}
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
                        <circle cx="36" cy="12" r="6"/>
                        <path d="M33 12h6M36 9v6"/>
                    </svg>
                    <div class="bv-empty-title">No suppliers yet</div>
                    <div class="bv-empty-sub">Registered suppliers will appear here</div>
                </div>
                @endif
            </div>
        </div>

    </div>
</x-app-layout>