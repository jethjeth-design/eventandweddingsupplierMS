<x-client-layout>
    <style>
        /* ── Page ── */
        .bv-page-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;}
        .bv-page-title{font-family:var(--font-display);font-size:1.75rem;font-weight:700;color:var(--charcoal);line-height:1.1;}
        .bv-page-title em{font-style:italic;color:var(--gold-dark);}
        .bv-page-sub{font-size:0.8rem;color:var(--warm-grey);margin-top:0.3rem;}

        /* ── Status badges ── */
        .ev-badge{display:inline-flex;align-items:center;gap:0.35rem;padding:0.25rem 0.75rem;border-radius:999px;font-size:0.68rem;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;}
        .ev-badge::before{content:'';width:5px;height:5px;border-radius:50%;}
        .ev-badge.pending   {background:rgba(234,179,8,0.1);  color:#92400E; } .ev-badge.pending::before   {background:#F59E0B;}
        .ev-badge.approved  {background:rgba(16,185,129,0.1); color:#065F46; } .ev-badge.approved::before  {background:#10B981;}
        .ev-badge.rejected  {background:rgba(239,68,68,0.1);  color:#991B1B; } .ev-badge.rejected::before  {background:#EF4444;}
        .ev-badge.cancelled {background:rgba(107,114,128,0.1);color:#374151; } .ev-badge.cancelled::before {background:#9CA3AF;}

        /* ── Layout ── */
        .ev-layout{display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start;}
        @media(max-width:960px){.ev-layout{grid-template-columns:1fr;}}

        /* ── Cards ── */
        .ev-card{background:var(--white);border-radius:12px;border:1px solid #F0EBE5;box-shadow:0 1px 4px rgba(30,27,24,0.05);overflow:hidden;margin-bottom:1.25rem;}
        .ev-card:last-of-type{margin-bottom:0;}
        .ev-card-header{padding:1.1rem 1.5rem;border-bottom:1px solid #F7F3EF;display:flex;align-items:center;justify-content:space-between;gap:0.75rem;}
        .ev-card-header-l{display:flex;align-items:center;gap:0.75rem;}
        .ev-card-icon{width:34px;height:34px;border-radius:8px;background:rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
        .ev-card-icon svg{width:16px;height:16px;}
        .ev-card-title{font-family:var(--font-display);font-size:0.95rem;font-weight:700;color:var(--charcoal);}
        .ev-card-desc{font-size:0.72rem;color:var(--warm-grey);margin-top:0.1rem;}
        .ev-card-body{padding:1.5rem;}

        /* ── Event post cards ── */
        .ev-list{display:flex;flex-direction:column;gap:1rem;}
        .ev-post{border-radius:12px;border:1px solid #F0EBE5;background:var(--white);box-shadow:0 1px 4px rgba(30,27,24,0.04);overflow:hidden;transition:box-shadow 0.2s;}
        .ev-post:hover{box-shadow:0 4px 16px rgba(30,27,24,0.09);}
        .ev-post-head{display:flex;align-items:flex-start;justify-content:space-between;padding:1rem 1.25rem 0.65rem;gap:0.75rem;}
        .ev-post-head-l{flex:1;min-width:0;}
        .ev-post-type{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--charcoal);margin-bottom:0.22rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
        .ev-post-date-loc{display:flex;flex-wrap:wrap;gap:0.65rem;font-size:0.72rem;color:var(--warm-grey);}
        .ev-post-date-loc span{display:flex;align-items:center;gap:0.3rem;}
        .ev-post-date-loc svg{width:11px;height:11px;color:var(--gold-dark);flex-shrink:0;}

        /* Detail grid */
        .ev-post-body{padding:0 1.25rem 0.9rem;display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:0.6rem 1rem;}
        .ev-detail-k{font-size:0.62rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#C0B8B0;margin-bottom:0.18rem;display:flex;align-items:center;gap:0.25rem;}
        .ev-detail-k svg{width:9px;height:9px;color:var(--gold-dark);}
        .ev-detail-v{font-size:0.82rem;color:var(--charcoal);line-height:1.4;}
        .ev-detail-v.nil{color:#C0B8B0;font-style:italic;}

        /* Notes */
        .ev-post-notes{margin:0 1.25rem 0.9rem;padding:0.7rem 0.9rem;background:rgba(201,168,76,0.04);border-radius:8px;border-left:2px solid rgba(201,168,76,0.3);font-size:0.8rem;color:var(--warm-grey);line-height:1.55;}

        /* Footer */
        .ev-post-foot{padding:0.65rem 1.25rem;border-top:1px solid #F7F3EF;display:flex;align-items:center;justify-content:space-between;gap:0.5rem;flex-wrap:wrap;}
        .ev-post-created{font-size:0.65rem;color:#C0B8B0;}

        /* Cancel button */
        .ev-btn-cancel{display:inline-flex;align-items:center;gap:0.3rem;padding:0.35rem 0.8rem;border-radius:6px;border:1.5px solid #FADBD8;background:transparent;font-family:var(--font-body);font-size:0.72rem;font-weight:500;color:#C0392B;cursor:pointer;transition:background 0.15s,border-color 0.15s;}
        .ev-btn-cancel svg{width:10px;height:10px;}
        .ev-btn-cancel:hover{background:#FFF5F5;border-color:#C0392B;}
        .ev-btn-cancel:disabled{opacity:0.4;cursor:not-allowed;}

        /* ── Empty state ── */
        .ev-empty{text-align:center;padding:3.5rem 2rem;}
        .ev-empty-icon{width:64px;height:64px;border-radius:50%;background:rgba(201,168,76,0.08);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;color:var(--gold-dark);}
        .ev-empty-icon svg{width:28px;height:28px;}
        .ev-empty-title{font-family:var(--font-display);font-size:1.15rem;font-weight:700;color:var(--charcoal);margin-bottom:0.4rem;}
        .ev-empty-desc{font-size:0.82rem;color:var(--warm-grey);margin-bottom:1.35rem;line-height:1.6;max-width:320px;margin-left:auto;margin-right:auto;}

        /* ── Form fields ── */
        .ev-field{margin-bottom:1.1rem;}
        .ev-field:last-child{margin-bottom:0;}
        .ev-label{display:flex;align-items:center;justify-content:space-between;font-size:0.68rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:var(--warm-grey);margin-bottom:0.4rem;}
        .ev-label-req{font-size:0.6rem;color:#C0392B;font-weight:500;text-transform:none;letter-spacing:0;}
        .ev-label-opt{font-size:0.6rem;color:#C0B8B0;font-weight:400;text-transform:none;letter-spacing:0;}
        .ev-iw{position:relative;}
        .ev-ico{position:absolute;left:0.8rem;top:50%;transform:translateY(-50%);width:14px;height:14px;color:#C0B8B0;pointer-events:none;transition:color 0.2s;}
        .ev-iw:focus-within .ev-ico{color:var(--gold-dark);}
        .ev-input,.ev-textarea,.ev-select{width:100%;padding:0.7rem 0.92rem;background:var(--ivory);border:1.5px solid #E5DDD5;border-radius:8px;font-family:var(--font-body);font-size:0.84rem;color:var(--charcoal);outline:none;transition:border-color 0.2s,box-shadow 0.2s,background 0.2s;appearance:none;}
        .ev-iw .ev-input{padding-left:2.5rem;}
        .ev-input:focus,.ev-textarea:focus,.ev-select:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,0.12);background:var(--white);}
        .ev-input::placeholder,.ev-textarea::placeholder{color:#C0B8B0;}
        .ev-textarea{resize:vertical;min-height:88px;}
        .ev-select-w{position:relative;}
        .ev-select-w::after{content:'';position:absolute;right:0.85rem;top:50%;transform:translateY(-50%);width:0;height:0;border-left:4px solid transparent;border-right:4px solid transparent;border-top:5px solid #C0B8B0;pointer-events:none;}
        .ev-hint{font-size:0.68rem;color:#C0B8B0;margin-top:0.28rem;}
        .ev-err{font-size:0.68rem;color:#C0392B;margin-top:0.28rem;}
        .ev-field-row{display:grid;grid-template-columns:1fr 1fr;gap:0.85rem;}
        @media(max-width:480px){.ev-field-row{grid-template-columns:1fr;}}

        /* ── Form submit ── */
        .ev-form-footer{display:flex;align-items:center;justify-content:flex-end;padding:1rem 1.5rem;border-top:1px solid #F7F3EF;}
        .ev-btn-submit{display:inline-flex;align-items:center;gap:0.45rem;padding:0.68rem 1.75rem;border-radius:6px;border:none;background:var(--charcoal);font-family:var(--font-body);font-size:0.84rem;font-weight:500;color:var(--white);cursor:pointer;transition:background 0.2s,box-shadow 0.2s,transform 0.15s;letter-spacing:0.02em;}
        .ev-btn-submit svg{width:14px;height:14px;}
        .ev-btn-submit:hover{background:var(--gold-dark);box-shadow:0 4px 14px rgba(201,168,76,0.22);transform:translateY(-1px);}

        /* Primary button */
        .bv-btn-primary{display:inline-flex;align-items:center;gap:0.45rem;padding:0.6rem 1.3rem;border-radius:6px;border:none;background:var(--charcoal);font-family:var(--font-body);font-size:0.8rem;font-weight:500;color:var(--white);text-decoration:none;cursor:pointer;transition:background 0.2s,box-shadow 0.2s,transform 0.15s;}
        .bv-btn-primary svg{width:13px;height:13px;}
        .bv-btn-primary:hover{background:var(--gold-dark);box-shadow:0 4px 12px rgba(201,168,76,0.2);transform:translateY(-1px);}

        /* ── Alert ── */
        .bv-alert{display:flex;align-items:center;gap:0.6rem;padding:0.75rem 1rem;border-radius:8px;font-size:0.8rem;margin-bottom:1.1rem;}
        .bv-alert svg{width:14px;height:14px;flex-shrink:0;}
        .bv-alert-ok{background:#F0FDF4;border:1px solid #A7F3D0;color:#065F46;}
        .bv-alert-ok svg{color:#10B981;}
        .bv-alert-err{background:#FEF2F2;border:1px solid #FECACA;color:#991B1B;}
        .bv-alert-err svg{color:#EF4444;}

        /* ── Stats sidebar ── */
        .ev-stats{display:flex;flex-direction:column;gap:0.65rem;padding:1rem 1.2rem;}
        .ev-stat{display:flex;align-items:center;justify-content:space-between;}
        .ev-stat-lbl{font-size:0.72rem;color:var(--warm-grey);display:flex;align-items:center;gap:0.35rem;}
        .ev-stat-lbl svg{width:12px;height:12px;color:var(--gold-dark);}
        .ev-stat-val{font-family:var(--font-display);font-size:0.92rem;font-weight:700;color:var(--charcoal);}

        /* Tip items */
        .ev-tip-body{padding:1rem 1.2rem;}
        .ev-tip-item{font-size:0.74rem;color:var(--warm-grey);line-height:1.55;padding:0.4rem 0;border-bottom:1px solid #F7F3EF;display:flex;gap:0.5rem;}
        .ev-tip-item:last-child{border-bottom:none;padding-bottom:0;}
        .ev-tip-item::before{content:'';width:5px;height:5px;border-radius:50%;background:var(--gold);flex-shrink:0;margin-top:0.44rem;}
        .ev-tip-header{display:flex;align-items:center;gap:0.55rem;padding:0.9rem 1.2rem;border-bottom:1px solid #F7F3EF;font-size:0.72rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:var(--warm-grey);}
        .ev-tip-header svg{width:14px;height:14px;color:var(--gold-dark);flex-shrink:0;}

        /* ── Timeline track ── */
        .ev-timeline{display:flex;flex-direction:column;gap:0;}
        .ev-tl-item{display:flex;gap:0.9rem;padding:0.6rem 0;}
        .ev-tl-left{display:flex;flex-direction:column;align-items:center;width:28px;flex-shrink:0;}
        .ev-tl-dot{width:12px;height:12px;border-radius:50%;flex-shrink:0;border:2px solid;}
        .ev-tl-dot.pending   {background:#FEF3C7;border-color:#F59E0B;}
        .ev-tl-dot.approved  {background:#D1FAE5;border-color:#10B981;}
        .ev-tl-dot.rejected  {background:#FEE2E2;border-color:#EF4444;}
        .ev-tl-dot.cancelled {background:#F3F4F6;border-color:#9CA3AF;}
        .ev-tl-line{flex:1;width:1px;background:#F0EBE5;margin-top:2px;}
        .ev-tl-item:last-child .ev-tl-line{display:none;}
        .ev-tl-content{padding-bottom:0.2rem;}
        .ev-tl-label{font-size:0.75rem;font-weight:600;color:var(--charcoal);margin-bottom:0.08rem;}
        .ev-tl-meta{font-size:0.65rem;color:#C0B8B0;}

        /* Modal */
        .ev-modal-bg{position:fixed;inset:0;background:rgba(30,27,24,0.5);z-index:999;display:none;align-items:center;justify-content:center;padding:1rem;}
        .ev-modal-bg.open{display:flex;}
        .ev-modal{background:var(--white);border-radius:14px;width:100%;max-width:420px;overflow:hidden;box-shadow:0 20px 60px rgba(30,27,24,0.2);}
        .ev-modal-head{padding:1.25rem 1.5rem;border-bottom:1px solid #F0EBE5;}
        .ev-modal-head-title{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--charcoal);margin-bottom:0.15rem;}
        .ev-modal-head-sub{font-size:0.75rem;color:var(--warm-grey);}
        .ev-modal-body{padding:1.25rem 1.5rem;font-size:0.84rem;color:var(--warm-grey);line-height:1.6;}
        .ev-modal-foot{display:flex;gap:0.65rem;padding:1rem 1.5rem;border-top:1px solid #F0EBE5;justify-content:flex-end;}
        .ev-modal-close{padding:0.62rem 1.1rem;border-radius:6px;border:1.5px solid #E5DDD5;background:var(--white);font-family:var(--font-body);font-size:0.82rem;font-weight:500;color:var(--warm-grey);cursor:pointer;transition:border-color 0.2s;}
        .ev-modal-close:hover{border-color:var(--gold);}
        .ev-modal-confirm{padding:0.62rem 1.35rem;border-radius:6px;border:none;background:#C0392B;font-family:var(--font-body);font-size:0.82rem;font-weight:500;color:var(--white);cursor:pointer;transition:background 0.2s;}
        .ev-modal-confirm:hover{background:#992D22;}
    </style>

    <div class="page-content">

        <div class="bv-page-header">
            <div>
                <h1 class="bv-page-title">My <em>Events</em></h1>
                <p class="bv-page-sub">Track and manage your event bookings</p>
            </div>
            <button type="button" class="bv-btn-primary" onclick="evOpenForm()">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 2v10M2 7h10"/></svg>
                Create Event
            </button>
        </div>

        @if(session('status') === 'event-created')
        <div class="bv-alert bv-alert-ok">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
            Your event request has been submitted. We'll notify you once it's reviewed.
        </div>
        @endif
        @if(session('status') === 'event-cancelled')
        <div class="bv-alert bv-alert-err">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l8 8M14 6l-8 8"/><circle cx="10" cy="10" r="8"/></svg>
            Event cancelled successfully.
        </div>
        @endif

        <div class="ev-layout">

            {{-- ════ LEFT: Event list ════ --}}
            <div>
                @if(isset($events) && $events->count())

                    <div class="ev-list">
                        @foreach($events as $event)
                        <div class="ev-post">

                            {{-- Post header --}}
                            <div class="ev-post-head">
                                <div class="ev-post-head-l">
                                    <div class="ev-post-type">{{ $event->event_type }}</div>
                                    <div class="ev-post-date-loc">
                                        <span>
                                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="1" y="2" width="10" height="9" rx="1.5"/><path d="M1 5h10M4 1v2M8 1v2"/></svg>
                                            {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}
                                        </span>
                                        @if($event->location)
                                        <span>
                                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M6 1C4.3 1 3 2.3 3 4c0 2.6 3 7 3 7s3-4.4 3-7c0-1.7-1.3-3-3-3z"/><circle cx="6" cy="4" r="1"/></svg>
                                            {{ $event->location }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                {{-- Status badge --}}
                                @php
                                    $st = strtolower($event->status ?? 'pending');
                                @endphp
                                <span class="ev-badge {{ $st }}">{{ ucfirst($st) }}</span>
                            </div>

                            {{-- Detail grid --}}
                            <div class="ev-post-body">
                                <div>
                                    <div class="ev-detail-k"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M6 1l1.2 2.4 2.7.4-1.95 1.9.46 2.68L6 7.25 3.57 8.42 4.03 5.74 2.1 3.84l2.7-.4z"/></svg>Theme</div>
                                    <div class="ev-detail-v {{ !$event->theme ? 'nil' : '' }}">{{ $event->theme ?: '—' }}</div>
                                </div>
                                <div>
                                    <div class="ev-detail-k"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M1 10l2-6 3 3 3-5 2 3"/></svg>Budget</div>
                                    <div class="ev-detail-v {{ !$event->budget ? 'nil' : '' }}">{{ $event->budget ? '₱'.number_format($event->budget) : '—' }}</div>
                                </div>
                                <div>
                                    <div class="ev-detail-k"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="4" cy="4" r="2.5"/><circle cx="9" cy="4" r="2.5"/><path d="M1 10c0-1.7 1.3-3 3-3M6 10c0-1.7 1.3-3 3-3"/></svg>Guests</div>
                                    <div class="ev-detail-v {{ !$event->guest_count ? 'nil' : '' }}">{{ $event->guest_count ? number_format($event->guest_count).' pax' : '—' }}</div>
                                </div>
                                <div>
                                    <div class="ev-detail-k"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="6" cy="6" r="5"/><path d="M6 4v2.5l1.5 1.5"/></svg>Submitted</div>
                                    <div class="ev-detail-v">{{ $event->created_at ? $event->created_at->diffForHumans() : '—' }}</div>
                                </div>
                            </div>

                            {{-- Notes --}}
                            @if($event->notes)
                            <div class="ev-post-notes">{{ $event->notes }}</div>
                            @endif

                            {{-- Footer --}}
                            <div class="ev-post-foot">
                                <span class="ev-post-created">
                                    ID #{{ $event->id }} · {{ $event->created_at ? $event->created_at->format('M d, Y') : '' }}
                                </span>
                                

                                {{-- Cancel only if pending --}}
                                @if($st === 'pending')
                                
                                <button type="button" class="ev-btn-cancel"
                                        onclick="evOpenCancel({{ $event->id }}, '{{ addslashes($event->event_type) }}')">
                                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 2l8 8M10 2L2 10"/></svg>
                                    Cancel Event
                                </button>
                                @elseif($st === 'approved')
                                <span style="font-size:0.7rem;color:#10B981;font-weight:500;display:flex;align-items:center;gap:0.3rem;">
                                    <svg width="11" height="11" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 6l3 3 5-5"/></svg>
                                    Approved by admin
                                </span>
                                @elseif($st === 'rejected')
                                <span style="font-size:0.7rem;color:#EF4444;font-weight:500;display:flex;align-items:center;gap:0.3rem;">
                                    <svg width="11" height="11" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 2l8 8M10 2L2 10"/></svg>
                                    Rejected by admin
                                </span>
                                @elseif($st === 'cancelled')
                                <span style="font-size:0.7rem;color:#9CA3AF;font-weight:500;">Cancelled</span>
                                @endif
                            </div>

                        </div>
                        @endforeach
                    </div>

                @else
                    {{-- ── Empty state ── --}}
                    <div class="ev-card">
                        <div class="ev-card-body ev-empty">
                            <div class="ev-empty-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="17" rx="3"/><path d="M3 9h18M8 2v4M16 2v4M8 13h3M8 17h5"/></svg>
                            </div>
                            <div class="ev-empty-title">No Events Yet</div>
                            <div class="ev-empty-desc">You haven't submitted any event requests. Create your first event and our team will review it shortly.</div>
                            <button type="button" class="bv-btn-primary" onclick="evOpenForm()">
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 2v10M2 7h10"/></svg>
                                Create My First Event
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            {{-- ════ RIGHT SIDEBAR ════ --}}
            <div>

                {{-- Stats --}}
                <div class="ev-card">
                    <div class="ev-card-header">
                        <div class="ev-card-header-l">
                            <div class="ev-card-icon">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="1" y="8" width="3" height="11"/><rect x="6" y="4" width="3" height="15"/><rect x="11" y="1" width="3" height="18"/></svg>
                            </div>
                            <div><div class="ev-card-title">Overview</div></div>
                        </div>
                    </div>
                    <div class="ev-stats">
                        @php
                            $evts = $events ?? collect();
                            $countAll      = $evts->count();
                            $countPending  = $evts->where('status','pending')->count();
                            $countApproved = $evts->where('status','approved')->count();
                            $countRejected = $evts->where('status','rejected')->count();
                            $countCancelled= $evts->where('status','cancelled')->count();
                        @endphp
                        <div class="ev-stat">
                            <span class="ev-stat-lbl"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="1" y="2" width="10" height="9" rx="1.5"/><path d="M1 5h10"/></svg>Total Events</span>
                            <span class="ev-stat-val">{{ $countAll }}</span>
                        </div>
                        <div class="ev-stat">
                            <span class="ev-stat-lbl" style="color:#92400E;">
                                <svg viewBox="0 0 12 12" fill="none" stroke="#F59E0B" stroke-width="1.7"><circle cx="6" cy="6" r="5"/><path d="M6 4v2M6 8v.5"/></svg>
                                Pending
                            </span>
                            <span class="ev-stat-val" style="color:#92400E;">{{ $countPending }}</span>
                        </div>
                        <div class="ev-stat">
                            <span class="ev-stat-lbl" style="color:#065F46;">
                                <svg viewBox="0 0 12 12" fill="none" stroke="#10B981" stroke-width="1.7"><path d="M2 6l3 3 5-5"/><circle cx="6" cy="6" r="5"/></svg>
                                Approved
                            </span>
                            <span class="ev-stat-val" style="color:#065F46;">{{ $countApproved }}</span>
                        </div>
                        <div class="ev-stat">
                            <span class="ev-stat-lbl" style="color:#991B1B;">
                                <svg viewBox="0 0 12 12" fill="none" stroke="#EF4444" stroke-width="1.7"><path d="M2 2l8 8M10 2L2 10"/><circle cx="6" cy="6" r="5"/></svg>
                                Rejected
                            </span>
                            <span class="ev-stat-val" style="color:#991B1B;">{{ $countRejected }}</span>
                        </div>
                        <div class="ev-stat">
                            <span class="ev-stat-lbl" style="color:#374151;">
                                <svg viewBox="0 0 12 12" fill="none" stroke="#9CA3AF" stroke-width="1.7"><circle cx="6" cy="6" r="5"/><path d="M4 6h4"/></svg>
                                Cancelled
                            </span>
                            <span class="ev-stat-val" style="color:#374151;">{{ $countCancelled }}</span>
                        </div>
                    </div>
                </div>

                {{-- Status guide --}}
                <div class="ev-card">
                    <div class="ev-tip-header">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="8" cy="8" r="6"/><path d="M8 5v3M8 10v.5"/></svg>
                        Status Guide
                    </div>
                    <div class="ev-timeline">
                        <div class="ev-tl-item" style="padding:0.75rem 1.2rem 0.4rem;">
                            <div class="ev-tl-left"><div class="ev-tl-dot pending"></div><div class="ev-tl-line"></div></div>
                            <div class="ev-tl-content"><div class="ev-tl-label">Pending</div><div class="ev-tl-meta">Awaiting admin review</div></div>
                        </div>
                        <div class="ev-tl-item" style="padding:0.4rem 1.2rem;">
                            <div class="ev-tl-left"><div class="ev-tl-dot approved"></div><div class="ev-tl-line"></div></div>
                            <div class="ev-tl-content"><div class="ev-tl-label">Approved</div><div class="ev-tl-meta">Admin accepted your request</div></div>
                        </div>
                        <div class="ev-tl-item" style="padding:0.4rem 1.2rem;">
                            <div class="ev-tl-left"><div class="ev-tl-dot rejected"></div><div class="ev-tl-line"></div></div>
                            <div class="ev-tl-content"><div class="ev-tl-label">Rejected</div><div class="ev-tl-meta">Admin declined your request</div></div>
                        </div>
                        <div class="ev-tl-item" style="padding:0.4rem 1.2rem 0.75rem;">
                            <div class="ev-tl-left"><div class="ev-tl-dot cancelled"></div></div>
                            <div class="ev-tl-content"><div class="ev-tl-label">Cancelled</div><div class="ev-tl-meta">You cancelled this event</div></div>
                        </div>
                    </div>
                </div>

                {{-- Tips --}}
                <div class="ev-card">
                    <div class="ev-tip-header">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M8 2a4 4 0 014 4c0 1.7-.9 3.2-2.2 4L9 14H7l-.8-4A4 4 0 018 2z"/><path d="M6.5 14.5h3"/></svg>
                        Tips
                    </div>
                    <div class="ev-tip-body">
                        <div class="ev-tip-item">Be as specific as possible with your event details for a faster review.</div>
                        <div class="ev-tip-item">You can only cancel events that are still <strong>Pending</strong>.</div>
                        <div class="ev-tip-item">Once approved, our team will reach out to confirm arrangements.</div>
                        <div class="ev-tip-item">Include your budget range to help us match the right suppliers.</div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ════════════════════════
        CREATE EVENT MODAL
    ════════════════════════ --}}
    <div class="ev-modal-bg" id="evFormModal" onclick="if(event.target===this)evCloseForm()">
        <div class="ev-modal" style="max-width:560px;">
            <div class="ev-modal-head">
                <div class="ev-modal-head-title">Create New Event</div>
                <div class="ev-modal-head-sub">Fill in the details and submit for admin review</div>
            </div>

            <form method="POST" action="{{ route('client.events.store') }}" id="evCreateForm">
                @csrf

                <div class="ev-card-body" style="padding:1.35rem 1.5rem;max-height:65vh;overflow-y:auto;">

                    {{-- Event Type --}}
                    <div class="ev-field">
                        <label class="ev-label" for="event_type">Event Type <span class="ev-label-req">Required</span></label>
                        <div class="ev-select-w">
                            <select id="event_type" name="event_type" class="ev-select" required>
                                <option value="" disabled {{ old('event_type') ? '' : 'selected' }}>Select a Event type...</option>
                                    @foreach($categories as $categories)
                                        <option value="{{ $categories->name }}"
                                            {{ old('') == $categories->name? 'selected' : '' }}>
                                            {{ $categories->name }}
                                        </option>
                                    @endforeach
                            </select>
                        </div>
                        @error('event_type')<div class="ev-err">{{ $message }}</div>@enderror
                    </div>

                    {{-- Event Date --}}
                    <div class="ev-field">
                        <label class="ev-label" for="event_date">Event Date <span class="ev-label-req">Required</span></label>
                        <div class="ev-iw">
                            <svg class="ev-ico" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="1" y="2" width="14" height="13" rx="2"/><path d="M1 6h14M5 1v2M11 1v2"/></svg>
                            <input id="event_date" name="event_date" type="date" class="ev-input"
                                value="{{ old('event_date') }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                        </div>
                        @error('event_date')<div class="ev-err">{{ $message }}</div>@enderror
                    </div>

                    {{-- Location --}}
                    <div class="ev-field">
                        <label class="ev-label" for="location">Location <span class="ev-label-opt">Optional</span></label>
                        <div class="ev-iw">
                            <svg class="ev-ico" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M8 1C5.8 1 4 2.8 4 5c0 4.4 4 10 4 10s4-5.6 4-10c0-2.2-1.8-4-4-4z"/><circle cx="8" cy="5" r="1.5"/></svg>
                            <input id="location" name="location" type="text" class="ev-input"
                                placeholder="e.g. Grand Ballroom, Naga City"
                                value="{{ old('location') }}">
                        </div>
                        @error('location')<div class="ev-err">{{ $message }}</div>@enderror
                    </div>

                    {{-- Budget + Guests --}}
                    <div class="ev-field-row">
                        <div class="ev-field" style="margin-bottom:0;">
                            <label class="ev-label" for="budget">Budget (₱) <span class="ev-label-opt">Optional</span></label>
                            <div class="ev-iw">
                                <svg class="ev-ico" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="8" cy="8" r="6"/><path d="M8 5v6M6 6.5h3a1.5 1.5 0 010 3H6"/></svg>
                                <input id="budget" name="budget" type="number" class="ev-input"
                                    placeholder="e.g. 50000"
                                    value="{{ old('budget') }}" min="0" step="100">
                            </div>
                            @error('budget')<div class="ev-err">{{ $message }}</div>@enderror
                        </div>
                        <div class="ev-field" style="margin-bottom:0;">
                            <label class="ev-label" for="guest_count">Guests <span class="ev-label-opt">Optional</span></label>
                            <div class="ev-iw">
                                <svg class="ev-ico" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="5" cy="5" r="2.5"/><circle cx="11" cy="5" r="2.5"/><path d="M1 13c0-2.2 1.8-4 4-4M8 13c0-2.2 1.8-4 4-4"/></svg>
                                <input id="guest_count" name="guest_count" type="number" class="ev-input"
                                    placeholder="e.g. 150"
                                    value="{{ old('guest_count') }}" min="1">
                            </div>
                            @error('guest_count')<div class="ev-err">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- Theme --}}
                    <div class="ev-field" style="margin-top:1.1rem;">
                        <label class="ev-label" for="theme">Theme / Motif <span class="ev-label-opt">Optional</span></label>
                        <div class="ev-iw">
                            <svg class="ev-ico" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M8 1l1.5 3 3.5.5-2.5 2.5.6 3.5L8 9 5 10.5l.6-3.5L3 4.5 6.5 4z"/></svg>
                            <select id="theme" name="theme" class="ev-select" required>
                                <option value="" disabled {{ old('theme') ? '' : 'selected' }}>Select a Event type...</option>
                                    @foreach($themes as $themes)
                                        <option value="{{ $themes->name }}"
                                            {{ old('') == $themes->name? 'selected' : '' }}>
                                            {{ $themes->name }}
                                        </option>
                                    @endforeach
                            </select>
                        </div>
                        @error('themes')<div class="ev-err">{{ $message }}</div>@enderror
                    </div>

                    {{-- Notes --}}
                    <div class="ev-field">
                        <label class="ev-label" for="notes">Additional Notes <span class="ev-label-opt">Optional</span></label>
                        <textarea id="notes" name="notes" class="ev-textarea"
                                placeholder="Any special requirements, preferences, or details you want to share..."
                                maxlength="600"
                                oninput="evCount(this)">{{ old('notes') }}</textarea>
                        <div style="display:flex;justify-content:flex-end;margin-top:0.22rem;">
                            <span style="font-size:0.63rem;color:#C0B8B0;" id="evNoteCount">{{ strlen(old('notes','')) }} / 600</span>
                        </div>
                        @error('notes')<div class="ev-err">{{ $message }}</div>@enderror
                    </div>

                </div>

                <div class="ev-form-footer">
                    <button type="button" class="ev-modal-close" onclick="evCloseForm()">Cancel</button>
                    <button type="submit" class="ev-btn-submit">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg>
                        Submit Event
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- ════════════════════════
        CANCEL CONFIRM MODAL
    ════════════════════════ --}}
    <div class="ev-modal-bg" id="evCancelModal" onclick="if(event.target===this)evCloseCancel()">
        <div class="ev-modal">
            <div class="ev-modal-head">
                <div class="ev-modal-head-title">Cancel Event</div>
                <div class="ev-modal-head-sub" id="evCancelSubtitle">Are you sure you want to cancel this event?</div>
            </div>
            <div class="ev-modal-body">
                This action <strong>cannot be undone</strong>. Your event request will be marked as <span class="ev-badge cancelled" style="font-size:0.65rem;">Cancelled</span> and will no longer be reviewed by the admin.
            </div>
            <div class="ev-modal-foot">
                <button type="button" class="ev-modal-close" onclick="evCloseCancel()">Keep Event</button>
                <form id="evCancelForm" method="POST" action="#" style="display:inline;">
                    @csrf
                    <button type="submit" class="ev-modal-confirm">Yes, Cancel Event</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        /* ── Form modal ── */
        function evOpenForm() {
            document.getElementById('evFormModal').classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function evCloseForm() {
            document.getElementById('evFormModal').classList.remove('open');
            document.body.style.overflow = '';
        }

        /* ── Cancel modal ── */
        function evOpenCancel(id, title) {
            document.getElementById('evCancelSubtitle').textContent = 'Cancel "' + title + '"?';
            document.getElementById('evCancelForm').action = '/client/events/' + id + '/cancel';
            document.getElementById('evCancelModal').classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function evCloseCancel() {
            document.getElementById('evCancelModal').classList.remove('open');
            document.body.style.overflow = '';
        }

        /* ── Notes char counter ── */
        function evCount(el) {
            document.getElementById('evNoteCount').textContent = el.value.length + ' / 600';
        }

        /* ── Auto-open form if validation errors ── */
        @if($errors->any())
            evOpenForm();
        @endif

        /* ── Keyboard close ── */
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') { evCloseForm(); evCloseCancel(); }
        });
    </script>

</x-client-layout>