<x-app-layout>
<style>
    /* ── Page ── */
    .bv-page-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;}
    .bv-page-title{font-family:var(--font-display);font-size:1.75rem;font-weight:700;color:var(--charcoal);line-height:1.1;}
    .bv-page-title em{font-style:italic;color:var(--gold-dark);}
    .bv-page-sub{font-size:0.8rem;color:var(--warm-grey);margin-top:0.3rem;}

    /* ── Status badges ── */
    .ev-badge{display:inline-flex;align-items:center;gap:0.35rem;padding:0.25rem 0.75rem;border-radius:999px;font-size:0.68rem;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;white-space:nowrap;}
    .ev-badge::before{content:'';width:5px;height:5px;border-radius:50%;flex-shrink:0;}
    .ev-badge.pending   {background:rgba(234,179,8,0.1);  color:#92400E;} .ev-badge.pending::before   {background:#F59E0B;}
    .ev-badge.approved  {background:rgba(16,185,129,0.1); color:#065F46;} .ev-badge.approved::before  {background:#10B981;}
    .ev-badge.rejected  {background:rgba(239,68,68,0.1);  color:#991B1B;} .ev-badge.rejected::before  {background:#EF4444;}
    .ev-badge.cancelled {background:rgba(107,114,128,0.1);color:#374151;} .ev-badge.cancelled::before {background:#9CA3AF;}

    /* ── Outer card ── */
    .ev-card{background:var(--white);border-radius:12px;border:1px solid #F0EBE5;box-shadow:0 1px 4px rgba(30,27,24,0.05);overflow:hidden;}

    /* ── Toolbar ── */
    .ev-toolbar{display:flex;align-items:center;justify-content:space-between;gap:0.75rem;padding:1rem 1.5rem;border-bottom:1px solid #F7F3EF;flex-wrap:wrap;}
    .ev-search-wrap{position:relative;flex:1;min-width:180px;max-width:280px;}
    .ev-search-ico{position:absolute;left:0.75rem;top:50%;transform:translateY(-50%);width:13px;height:13px;color:#C0B8B0;pointer-events:none;}
    .ev-search{width:100%;padding:0.52rem 0.9rem 0.52rem 2.2rem;background:var(--ivory);border:1.5px solid #E5DDD5;border-radius:7px;font-family:var(--font-body);font-size:0.8rem;color:var(--charcoal);outline:none;transition:border-color 0.2s,box-shadow 0.2s;}
    .ev-search:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,0.1);}
    .ev-search::placeholder{color:#C0B8B0;}
    .ev-filters{display:flex;align-items:center;gap:0.45rem;flex-wrap:wrap;}
    .ev-filter{padding:0.4rem 0.75rem;border-radius:6px;border:1.5px solid #E5DDD5;background:var(--white);font-family:var(--font-body);font-size:0.75rem;font-weight:500;color:var(--warm-grey);cursor:pointer;transition:border-color 0.2s,color 0.2s,background 0.2s;white-space:nowrap;}
    .ev-filter:hover{border-color:var(--gold);color:var(--gold-dark);}
    .ev-filter.active{border-color:var(--gold-dark);background:rgba(201,168,76,0.08);color:var(--gold-dark);font-weight:600;}
    .ev-toolbar-r{display:flex;align-items:center;gap:0.65rem;}
    .ev-count-badge{display:inline-flex;align-items:center;gap:0.3rem;padding:0.28rem 0.7rem;border-radius:999px;background:rgba(201,168,76,0.08);color:var(--gold-dark);font-size:0.7rem;font-weight:600;white-space:nowrap;}
    .ev-count-badge::before{content:'';width:5px;height:5px;border-radius:50%;background:var(--gold);}

    /* ── Datatable ── */
    .ev-dt-wrap{overflow-x:auto;}
    .ev-dt{width:100%;border-collapse:collapse;}
    .ev-dt thead tr{border-bottom:2px solid #F0EBE5;}
    .ev-dt thead th{
        padding:0.72rem 1rem;
        font-size:0.62rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;
        color:#C0B8B0;text-align:left;white-space:nowrap;
        cursor:pointer;user-select:none;transition:color 0.2s;
    }
    .ev-dt thead th:hover{color:var(--gold-dark);}
    .ev-dt thead th .sv{display:inline-flex;flex-direction:column;gap:1px;margin-left:0.3rem;vertical-align:middle;}
    .ev-dt thead th .sv span{width:0;height:0;border-left:3px solid transparent;border-right:3px solid transparent;opacity:0.3;}
    .ev-dt thead th .sv .sa{border-bottom:4px solid currentColor;}
    .ev-dt thead th .sv .sd{border-top:4px solid currentColor;}
    .ev-dt thead th.s-asc .sv .sa,.ev-dt thead th.s-desc .sv .sd{opacity:1;color:var(--gold-dark);}
    .ev-dt tbody tr{border-bottom:1px solid #F7F3EF;transition:background 0.15s;}
    .ev-dt tbody tr:last-child{border-bottom:none;}
    .ev-dt tbody tr:hover{background:rgba(201,168,76,0.025);}
    .ev-dt td{padding:0.9rem 1rem;font-size:0.82rem;color:var(--charcoal);vertical-align:middle;}

    /* Cell types */
    .ev-dt-id{font-size:0.72rem;color:#C0B8B0;font-variant-numeric:tabular-nums;}
    .ev-dt-name{font-family:var(--font-display);font-size:0.88rem;font-weight:700;color:var(--charcoal);}
    .ev-dt-sub{font-size:0.7rem;color:var(--warm-grey);margin-top:0.1rem;}
    .ev-dt-type{font-size:0.82rem;color:var(--charcoal);}
    .ev-dt-date{font-size:0.78rem;color:var(--warm-grey);white-space:nowrap;}
    .ev-dt-nil{color:#C0B8B0;font-style:italic;}

    /* Expand toggle */
    .ev-expand-btn{width:26px;height:26px;border-radius:6px;border:1.5px solid #E5DDD5;background:var(--white);cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--warm-grey);transition:border-color 0.2s,color 0.2s;}
    .ev-expand-btn svg{width:11px;height:11px;transition:transform 0.2s;}
    .ev-expand-btn:hover{border-color:var(--gold);color:var(--gold-dark);}
    .ev-expand-btn.open svg{transform:rotate(180deg);}
    .ev-detail-row{display:none;background:rgba(250,247,242,0.6);}
    .ev-detail-row.open{display:table-row;}
    .ev-detail-inner{padding:0.85rem 1rem 1rem 3.2rem;display:flex;flex-wrap:wrap;gap:1.25rem 2rem;}
    .ev-detail-block .ev-dk{font-size:0.6rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#C0B8B0;margin-bottom:0.2rem;}
    .ev-detail-block .ev-dv{font-size:0.8rem;color:var(--charcoal);}
    .ev-detail-block .ev-dv.nil{color:#C0B8B0;font-style:italic;}
    .ev-notes-block{width:100%;}
    .ev-notes-text{margin-top:0.55rem;padding:0.65rem 0.9rem;background:rgba(201,168,76,0.05);border-left:2px solid rgba(201,168,76,0.3);border-radius:6px;font-size:0.78rem;color:var(--warm-grey);line-height:1.55;max-width:520px;}

    /* Action buttons */
    .ev-actions{display:flex;align-items:center;gap:0.4rem;justify-content:flex-end;flex-wrap:nowrap;}
    .ev-btn-approve{display:inline-flex;align-items:center;gap:0.3rem;padding:0.38rem 0.85rem;border-radius:6px;border:1.5px solid rgba(16,185,129,0.35);background:rgba(16,185,129,0.07);font-family:var(--font-body);font-size:0.74rem;font-weight:600;color:#065F46;cursor:pointer;transition:background 0.15s,border-color 0.15s;white-space:nowrap;}
    .ev-btn-approve svg{width:11px;height:11px;}
    .ev-btn-approve:hover{background:rgba(16,185,129,0.15);border-color:#10B981;}
    .ev-btn-reject{display:inline-flex;align-items:center;gap:0.3rem;padding:0.38rem 0.85rem;border-radius:6px;border:1.5px solid #FADBD8;background:rgba(239,68,68,0.05);font-family:var(--font-body);font-size:0.74rem;font-weight:600;color:#991B1B;cursor:pointer;transition:background 0.15s,border-color 0.15s;white-space:nowrap;}
    .ev-btn-reject svg{width:11px;height:11px;}
    .ev-btn-reject:hover{background:rgba(239,68,68,0.12);border-color:#EF4444;}
    .ev-no-action{font-size:0.72rem;color:#C0B8B0;font-style:italic;}

    /* ── No results ── */
    .ev-empty-row td{text-align:center;padding:3rem 1rem;color:#C0B8B0;font-size:0.82rem;}
    .ev-empty-icon{width:44px;height:44px;border-radius:50%;background:rgba(201,168,76,0.07);display:flex;align-items:center;justify-content:center;margin:0 auto 0.7rem;color:var(--gold-dark);}
    .ev-empty-icon svg{width:20px;height:20px;}

    /* ── Pagination ── */
    .ev-foot{display:flex;align-items:center;justify-content:space-between;padding:0.85rem 1.5rem;border-top:1px solid #F7F3EF;flex-wrap:wrap;gap:0.5rem;}
    .ev-foot-info{font-size:0.72rem;color:#C0B8B0;}
    .ev-pager{display:flex;align-items:center;gap:0.3rem;}
    .ev-pg-btn{width:30px;height:30px;border-radius:6px;border:1.5px solid #E5DDD5;background:var(--white);font-family:var(--font-body);font-size:0.75rem;font-weight:500;color:var(--warm-grey);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:border-color 0.2s,color 0.2s,background 0.2s;}
    .ev-pg-btn:hover:not(:disabled){border-color:var(--gold);color:var(--gold-dark);}
    .ev-pg-btn.active{border-color:var(--gold-dark);background:rgba(201,168,76,0.1);color:var(--gold-dark);font-weight:700;}
    .ev-pg-btn:disabled{opacity:0.35;cursor:not-allowed;}
    .ev-pg-btn svg{width:11px;height:11px;}

    /* ── Stats row ── */
    .ev-stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.5rem;}
    @media(max-width:700px){.ev-stats-row{grid-template-columns:repeat(2,1fr);}}
    @media(max-width:400px){.ev-stats-row{grid-template-columns:1fr 1fr;}}
    .ev-stat-card{background:var(--white);border-radius:10px;border:1px solid #F0EBE5;padding:1rem 1.25rem;box-shadow:0 1px 3px rgba(30,27,24,0.04);}
    .ev-stat-label{font-size:0.65rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#C0B8B0;margin-bottom:0.35rem;display:flex;align-items:center;gap:0.3rem;}
    .ev-stat-label svg{width:11px;height:11px;}
    .ev-stat-val{font-family:var(--font-display);font-size:1.5rem;font-weight:700;color:var(--charcoal);line-height:1;}

    /* ── Alert ── */
    .bv-alert{display:flex;align-items:center;gap:0.6rem;padding:0.75rem 1rem;border-radius:8px;font-size:0.8rem;margin-bottom:1.25rem;}
    .bv-alert svg{width:14px;height:14px;flex-shrink:0;}
    .bv-alert-ok{background:#F0FDF4;border:1px solid #A7F3D0;color:#065F46;}
    .bv-alert-ok svg{color:#10B981;}
    .bv-alert-err{background:#FEF2F2;border:1px solid #FECACA;color:#991B1B;}
    .bv-alert-err svg{color:#EF4444;}

    /* ── Confirm modal ── */
    .ev-modal-bg{position:fixed;inset:0;background:rgba(30,27,24,0.5);z-index:999;display:none;align-items:center;justify-content:center;padding:1rem;}
    .ev-modal-bg.open{display:flex;}
    .ev-modal{background:var(--white);border-radius:14px;width:100%;max-width:400px;overflow:hidden;box-shadow:0 20px 60px rgba(30,27,24,0.2);}
    .ev-modal-head{padding:1.2rem 1.5rem;border-bottom:1px solid #F0EBE5;}
    .ev-modal-head-title{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--charcoal);margin-bottom:0.12rem;}
    .ev-modal-head-sub{font-size:0.75rem;color:var(--warm-grey);}
    .ev-modal-body{padding:1.1rem 1.5rem;font-size:0.84rem;color:var(--warm-grey);line-height:1.6;}
    .ev-modal-foot{display:flex;gap:0.6rem;padding:1rem 1.5rem;border-top:1px solid #F0EBE5;justify-content:flex-end;}
    .ev-modal-close{padding:0.6rem 1.1rem;border-radius:6px;border:1.5px solid #E5DDD5;background:var(--white);font-family:var(--font-body);font-size:0.82rem;font-weight:500;color:var(--warm-grey);cursor:pointer;transition:border-color 0.2s;}
    .ev-modal-close:hover{border-color:var(--gold);}
    .ev-modal-approve{padding:0.6rem 1.3rem;border-radius:6px;border:none;background:#10B981;font-family:var(--font-body);font-size:0.82rem;font-weight:600;color:var(--white);cursor:pointer;transition:background 0.2s;}
    .ev-modal-approve:hover{background:#059669;}
    .ev-modal-reject{padding:0.6rem 1.3rem;border-radius:6px;border:none;background:#EF4444;font-family:var(--font-body);font-size:0.82rem;font-weight:600;color:var(--white);cursor:pointer;transition:background 0.2s;}
    .ev-modal-reject:hover{background:#DC2626;}
</style>

<div class="page-content">

    <div class="bv-page-header">
        <div>
            <h1 class="bv-page-title">Events <em>Management</em></h1>
            <p class="bv-page-sub">Review and approve or reject client event requests</p>
        </div>
    </div>

    @if(session('success'))
    <div class="bv-alert bv-alert-ok">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bv-alert bv-alert-err">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l8 8M14 6l-8 8"/><circle cx="10" cy="10" r="8"/></svg>
        {{ session('error') }}
    </div>
    @endif

    {{-- ── Stats row ── --}}
    @php
        $evts         = $events ?? collect();
        $cAll         = $evts->count();
        $cPending     = $evts->where('status','pending')->count();
        $cApproved    = $evts->where('status','approved')->count();
        $cRejected    = $evts->where('status','rejected')->count();
    @endphp
    <div class="ev-stats-row">
        <div class="ev-stat-card">
            <div class="ev-stat-label">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="1" y="2" width="10" height="9" rx="1.5"/><path d="M1 5h10"/></svg>
                Total
            </div>
            <div class="ev-stat-val">{{ $cAll }}</div>
        </div>
        <div class="ev-stat-card">
            <div class="ev-stat-label" style="color:#F59E0B;">
                <svg viewBox="0 0 12 12" fill="none" stroke="#F59E0B" stroke-width="1.7"><circle cx="6" cy="6" r="5"/><path d="M6 4v2M6 8v.5"/></svg>
                Pending
            </div>
            <div class="ev-stat-val" style="color:#92400E;">{{ $cPending }}</div>
        </div>
        <div class="ev-stat-card">
            <div class="ev-stat-label" style="color:#10B981;">
                <svg viewBox="0 0 12 12" fill="none" stroke="#10B981" stroke-width="1.7"><path d="M2 6l3 3 5-5"/><circle cx="6" cy="6" r="5"/></svg>
                Approved
            </div>
            <div class="ev-stat-val" style="color:#065F46;">{{ $cApproved }}</div>
        </div>
        <div class="ev-stat-card">
            <div class="ev-stat-label" style="color:#EF4444;">
                <svg viewBox="0 0 12 12" fill="none" stroke="#EF4444" stroke-width="1.7"><path d="M2 2l8 8M10 2L2 10"/><circle cx="6" cy="6" r="5"/></svg>
                Rejected
            </div>
            <div class="ev-stat-val" style="color:#991B1B;">{{ $cRejected }}</div>
        </div>
    </div>

    {{-- ── Datatable card ── --}}
    @if(!$events->isEmpty())

    <div class="ev-card">

        {{-- Toolbar --}}
        <div class="ev-toolbar">
            <div class="ev-search-wrap">
                <svg class="ev-search-ico" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="5"/><path d="M12 12l-2.5-2.5"/></svg>
                <input type="text" id="evSearch" class="ev-search" placeholder="Search client, type, location…" oninput="evApply()">
            </div>
            <div class="ev-filters">
                <button class="ev-filter active" data-f="all"       onclick="evSetFilter(this)">All</button>
                <button class="ev-filter"        data-f="pending"   onclick="evSetFilter(this)">Pending</button>
                <button class="ev-filter"        data-f="approved"  onclick="evSetFilter(this)">Approved</button>
                <button class="ev-filter"        data-f="rejected"  onclick="evSetFilter(this)">Rejected</button>
                <button class="ev-filter"        data-f="cancelled" onclick="evSetFilter(this)">Cancelled</button>
            </div>
            <div class="ev-toolbar-r">
                <span class="ev-count-badge" id="evCount">{{ $cAll }} events</span>
            </div>
        </div>

        {{-- Table --}}
        <div class="ev-dt-wrap">
            <table class="ev-dt">
                <thead>
                    <tr>
                        <th style="width:28px;"></th>
                        <th onclick="evSort('id')"     id="thId">
                            ID <span class="sv"><span class="sa"></span><span class="sd"></span></span>
                        </th>
                        <th onclick="evSort('client')" id="thClient">
                            Client <span class="sv"><span class="sa"></span><span class="sd"></span></span>
                        </th>
                        <th onclick="evSort('type')"   id="thType">
                            Event Type <span class="sv"><span class="sa"></span><span class="sd"></span></span>
                        </th>
                        <th onclick="evSort('date')"   id="thDate">
                            Event Date <span class="sv"><span class="sa"></span><span class="sd"></span></span>
                        </th>
                        <th onclick="evSort('status')" id="thStatus">
                            Status <span class="sv"><span class="sa"></span><span class="sd"></span></span>
                        </th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody id="evBody">
                    @foreach($events as $event)
                    @php $st = strtolower($event->status ?? 'pending'); @endphp

                    {{-- Main row --}}
                    <tr class="ev-row"
                        data-id="{{ $event->id }}"
                        data-client="{{ strtolower($event->client->name ?? '') }}"
                        data-type="{{ strtolower($event->event_type) }}"
                        data-date="{{ $event->event_date }}"
                        data-status="{{ $st }}"
                        data-search="{{ strtolower(($event->client->name ?? '').' '.$event->event_type.' '.($event->location ?? '').' '.$st) }}">

                        <td>
                            <button type="button" class="ev-expand-btn" id="xbtn-{{ $event->id }}"
                                    onclick="evToggle({{ $event->id }})">
                                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 4l4 4 4-4"/></svg>
                            </button>
                        </td>
                        <td><span class="ev-dt-id">#{{ $event->id }}</span></td>
                        <td>
                            <div class="ev-dt-name">{{ $event->client->name ?? 'No Client' }}</div>
                            @if($event->client && $event->client->email)
                            <div class="ev-dt-sub">{{ $event->client->email }}</div>
                            @endif
                        </td>
                        <td><span class="ev-dt-type">{{ $event->event_type }}</span></td>
                        <td><span class="ev-dt-date">{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</span></td>
                        <td><span class="ev-badge {{ $st }}">{{ ucfirst($st) }}</span></td>
                        <td>
                            <div class="ev-actions">
                                @if($event->status === 'pending')
                                    <button type="button" class="ev-btn-approve"
                                            onclick="evOpenModal('approve', {{ $event->id }}, '{{ addslashes($event->client->name ?? 'this client') }}', '{{ addslashes($event->event_type) }}')">
                                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 6l3 3 5-5"/></svg>
                                        Approve
                                    </button>
                                    <button type="button" class="ev-btn-reject"
                                            onclick="evOpenModal('reject', {{ $event->id }}, '{{ addslashes($event->client->name ?? 'this client') }}', '{{ addslashes($event->event_type) }}')">
                                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 2l8 8M10 2L2 10"/></svg>
                                        Reject
                                    </button>
                                @else
                                    <span class="ev-no-action">—</span>
                                @endif
                            </div>
                        </td>
                    </tr>

                    {{-- Expandable detail row --}}
                    <tr class="ev-detail-row" id="xrow-{{ $event->id }}">
                        <td colspan="7">
                            <div class="ev-detail-inner">
                                <div class="ev-detail-block">
                                    <div class="ev-dk">Location</div>
                                    <div class="ev-dv {{ !$event->location ? 'nil' : '' }}">{{ $event->location ?: 'Not specified' }}</div>
                                </div>
                                <div class="ev-detail-block">
                                    <div class="ev-dk">Budget</div>
                                    <div class="ev-dv {{ !$event->budget ? 'nil' : '' }}">{{ $event->budget ? '₱'.number_format($event->budget) : 'Not specified' }}</div>
                                </div>
                                <div class="ev-detail-block">
                                    <div class="ev-dk">Guests</div>
                                    <div class="ev-dv {{ !$event->guest_count ? 'nil' : '' }}">{{ $event->guest_count ? number_format($event->guest_count).' pax' : 'Not specified' }}</div>
                                </div>
                                <div class="ev-detail-block">
                                    <div class="ev-dk">Theme / Motif</div>
                                    <div class="ev-dv {{ !$event->theme ? 'nil' : '' }}">{{ $event->theme ?: 'Not specified' }}</div>
                                </div>
                                <div class="ev-detail-block">
                                    <div class="ev-dk">Submitted</div>
                                    <div class="ev-dv">{{ $event->created_at ? $event->created_at->format('M d, Y · h:i A') : '—' }}</div>
                                </div>
                                @if($event->notes)
                                <div class="ev-notes-block">
                                    <div class="ev-dk">Client Notes</div>
                                    <div class="ev-notes-text">{{ $event->notes }}</div>
                                </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    {{-- no-results row (shown by JS) --}}
                    <tr class="ev-empty-row" id="evEmptyRow" style="display:none;">
                        <td colspan="7">
                            <div class="ev-empty-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4-4"/></svg>
                            </div>
                            No events match your search or filter.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Footer / Pagination --}}
        <div class="ev-foot">
            <span class="ev-foot-info" id="evInfo"></span>
            <div class="ev-pager" id="evPager"></div>
        </div>
    </div>

    @else
    <div class="ev-card">
        <div style="text-align:center;padding:4rem 2rem;">
            <div style="width:60px;height:60px;border-radius:50%;background:rgba(201,168,76,0.08);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;color:var(--gold-dark);">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="17" rx="3"/><path d="M3 9h18M8 2v4M16 2v4"/></svg>
            </div>
            <p style="font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--charcoal);margin-bottom:0.4rem;">No Events Yet</p>
            <p style="font-size:0.82rem;color:var(--warm-grey);">Client event requests will appear here once submitted.</p>
        </div>
    </div>
    @endif

</div>

{{-- ════ APPROVE MODAL ════ --}}
<div class="ev-modal-bg" id="evApproveModal" onclick="if(event.target===this)evCloseModals()">
    <div class="ev-modal">
        <div class="ev-modal-head">
            <div class="ev-modal-head-title">Approve Event</div>
            <div class="ev-modal-head-sub" id="evApproveSubtitle"></div>
        </div>
        <div class="ev-modal-body">
            Approving this event will notify the client and mark it as confirmed. Are you sure you want to proceed?
        </div>
        <div class="ev-modal-foot">
            <button type="button" class="ev-modal-close" onclick="evCloseModals()">Cancel</button>
            <form id="evApproveForm" method="POST" action="" style="display:inline;">
                @csrf
                <button type="submit" class="ev-modal-approve">
                    <svg width="13" height="13" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:0.3rem;"><path d="M2 6l3 3 5-5"/></svg>
                    Yes, Approve
                </button>
            </form>
        </div>
    </div>
</div>

{{-- ════ REJECT MODAL ════ --}}
<div class="ev-modal-bg" id="evRejectModal" onclick="if(event.target===this)evCloseModals()">
    <div class="ev-modal">
        <div class="ev-modal-head">
            <div class="ev-modal-head-title">Reject Event</div>
            <div class="ev-modal-head-sub" id="evRejectSubtitle"></div>
        </div>
        <div class="ev-modal-body">
            Rejecting this event will notify the client that their request was not approved. This action cannot be undone.
        </div>
        <div class="ev-modal-foot">
            <button type="button" class="ev-modal-close" onclick="evCloseModals()">Cancel</button>
            <form id="evRejectForm" method="POST" action="" style="display:inline;">
                @csrf
                <button type="submit" class="ev-modal-reject">
                    <svg width="13" height="13" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:0.3rem;"><path d="M2 2l8 8M10 2L2 10"/></svg>
                    Yes, Reject
                </button>
            </form>
        </div>
    </div>
</div>

<script>
/* ════════════════════════════
   MODAL
════════════════════════════ */
function evOpenModal(type, id, client, eventType) {
    var subtitle = client + ' — ' + eventType;
    if (type === 'approve') {
        document.getElementById('evApproveSubtitle').textContent = subtitle;
        document.getElementById('evApproveForm').action = '/admin/events/' + id + '/approve';
        document.getElementById('evApproveModal').classList.add('open');
    } else {
        document.getElementById('evRejectSubtitle').textContent = subtitle;
        document.getElementById('evRejectForm').action = '/admin/events/' + id + '/reject';
        document.getElementById('evRejectModal').classList.add('open');
    }
    document.body.style.overflow = 'hidden';
}
function evCloseModals() {
    document.getElementById('evApproveModal').classList.remove('open');
    document.getElementById('evRejectModal').classList.remove('open');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') evCloseModals();
});

/* ════════════════════════════
   EXPAND / COLLAPSE
════════════════════════════ */
function evToggle(id) {
    var row = document.getElementById('xrow-' + id);
    var btn = document.getElementById('xbtn-' + id);
    if (!row) return;
    var open = row.classList.contains('open');
    row.classList.toggle('open', !open);
    row.style.display = open ? 'none' : 'table-row';
    if (btn) btn.classList.toggle('open', !open);
}

/* ════════════════════════════
   DATATABLE ENGINE
════════════════════════════ */
var evRows     = [];
var evFiltered = [];
var evSortCol  = 'date';
var evSortDir  = 'asc';
var evFilter   = 'all';
var evPage     = 1;
var evPerPage  = 10;

(function init() {
    var body = document.getElementById('evBody');
    if (!body) return;
    body.querySelectorAll('tr.ev-row').forEach(function(r) {
        var rid = r.getAttribute('data-id');
        evRows.push({
            main:   r,
            detail: document.getElementById('xrow-' + rid),
            id:     parseInt(rid),
            client: r.getAttribute('data-client'),
            type:   r.getAttribute('data-type'),
            date:   r.getAttribute('data-date'),
            status: r.getAttribute('data-status'),
            search: r.getAttribute('data-search')
        });
    });
    evApply();
})();

function evSetFilter(btn) {
    document.querySelectorAll('.ev-filter').forEach(function(b){ b.classList.remove('active'); });
    btn.classList.add('active');
    evFilter = btn.getAttribute('data-f');
    evPage   = 1;
    evApply();
}

function evSort(col) {
    if (evSortCol === col) { evSortDir = evSortDir === 'asc' ? 'desc' : 'asc'; }
    else                   { evSortCol = col; evSortDir = 'asc'; }
    var map = {id:'thId',client:'thClient',type:'thType',date:'thDate',status:'thStatus'};
    Object.values(map).forEach(function(id){ var t=document.getElementById(id);if(t)t.className=''; });
    var th = document.getElementById(map[col]);
    if (th) th.className = 's-' + evSortDir;
    evApply();
}

function evApply() {
    var q = (document.getElementById('evSearch').value || '').toLowerCase().trim();
    evFiltered = evRows.filter(function(r) {
        return (evFilter === 'all' || r.status === evFilter) && (!q || r.search.indexOf(q) > -1);
    });
    evFiltered.sort(function(a, b) {
        var av, bv;
        if      (evSortCol==='id')     { av=a.id;     bv=b.id;     }
        else if (evSortCol==='client') { av=a.client; bv=b.client; }
        else if (evSortCol==='type')   { av=a.type;   bv=b.type;   }
        else if (evSortCol==='date')   { av=a.date;   bv=b.date;   }
        else if (evSortCol==='status') { av=a.status; bv=b.status; }
        if (av<bv) return evSortDir==='asc'?-1:1;
        if (av>bv) return evSortDir==='asc'?1:-1;
        return 0;
    });

    /* hide all */
    evRows.forEach(function(r) {
        r.main.style.display   = 'none';
        if (r.detail) r.detail.style.display = 'none';
    });

    var total = evFiltered.length;
    var start = (evPage - 1) * evPerPage;
    var end   = Math.min(start + evPerPage, total);

    evFiltered.slice(start, end).forEach(function(r) { r.main.style.display = ''; });

    /* empty row */
    var emRow = document.getElementById('evEmptyRow');
    if (emRow) emRow.style.display = total === 0 ? 'table-row' : 'none';

    /* count badge */
    var cEl = document.getElementById('evCount');
    if (cEl) cEl.textContent = total + (total===1?' event':' events');

    /* info */
    var iEl = document.getElementById('evInfo');
    if (iEl) iEl.textContent = total===0 ? 'No results' : 'Showing '+(start+1)+'–'+end+' of '+total;

    /* pager */
    evRenderPager(total);
}

function evRenderPager(total) {
    var pager = document.getElementById('evPager');
    if (!pager) return;
    var pages = Math.ceil(total / evPerPage);
    if (pages <= 1) { pager.innerHTML = ''; return; }
    var h = '';
    h += '<button class="ev-pg-btn" onclick="evGoPage('+(evPage-1)+')"'+(evPage===1?' disabled':'')+'>';
    h += '<svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 2L4 6l4 4"/></svg></button>';
    for (var i = 1; i <= pages; i++) {
        if (i===1||i===pages||(i>=evPage-1&&i<=evPage+1)) {
            h += '<button class="ev-pg-btn'+(i===evPage?' active':'')+'" onclick="evGoPage('+i+')">'+i+'</button>';
        } else if (i===evPage-2||i===evPage+2) {
            h += '<span style="font-size:0.75rem;color:#C0B8B0;padding:0 0.15rem;">…</span>';
        }
    }
    h += '<button class="ev-pg-btn" onclick="evGoPage('+(evPage+1)+')"'+(evPage===pages?' disabled':'')+'>';
    h += '<svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 2l4 4-4 4"/></svg></button>';
    pager.innerHTML = h;
}

function evGoPage(n) {
    var pages = Math.ceil(evFiltered.length / evPerPage);
    if (n<1||n>pages) return;
    evPage = n;
    evApply();
}
</script>

</x-app-layout>