<x-client-layout>

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
.ev-top{display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:.75rem;margin-bottom:1.75rem;}
.ev-title{font-family:var(--font-display);font-size:1.65rem;font-weight:700;color:var(--charcoal);line-height:1.15;}
.ev-title em{font-style:italic;color:var(--gold-dark);}
.ev-subtitle{font-size:.76rem;color:var(--warm-grey);margin-top:.2rem;font-family:var(--font-body);}

/* ── BUTTONS ── */
.ev-btn-primary{display:inline-flex;align-items:center;gap:.45rem;padding:.6rem 1.3rem;border-radius:6px;border:none;background:var(--charcoal);font-family:var(--font-body);font-size:.8rem;font-weight:500;color:var(--white);cursor:pointer;text-decoration:none;transition:background .2s,box-shadow .2s,transform .15s;}
.ev-btn-primary svg{width:13px;height:13px;}
.ev-btn-primary:hover{background:var(--gold-dark);box-shadow:0 4px 12px rgba(201,168,76,.2);transform:translateY(-1px);}
.ev-btn-danger{display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .72rem;border-radius:6px;border:1.5px solid #FADBD8;background:transparent;font-family:var(--font-body);font-size:.7rem;font-weight:500;color:#C0392B;cursor:pointer;transition:background .15s,border-color .15s;white-space:nowrap;}
.ev-btn-danger svg{width:10px;height:10px;}
.ev-btn-danger:hover{background:#FFF5F5;border-color:#C0392B;}
.ev-btn-danger:disabled,.ev-btn-danger.ev-btn-disabled{opacity:.45;cursor:not-allowed;pointer-events:none;border-color:#E5DDD5;color:#C0B8B0;}
.ev-btn-complete{display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .72rem;border-radius:6px;border:1.5px solid #A7F3D0;background:transparent;font-family:var(--font-body);font-size:.7rem;font-weight:500;color:#065F46;cursor:pointer;transition:background .15s,border-color .15s;white-space:nowrap;}
.ev-btn-complete svg{width:10px;height:10px;}
.ev-btn-complete:hover{background:#F0FDF4;border-color:#10B981;}
.ev-btn-complete:disabled{opacity:.45;cursor:not-allowed;pointer-events:none;}
.ev-actions{display:flex;flex-direction:column;align-items:center;gap:.35rem;}
.ev-cancelled-tag{font-size:.72rem;color:#C0B8B0;font-style:italic;font-family:var(--font-body);}
.ev-completed-tag{font-size:.72rem;color:#065F46;font-style:italic;font-family:var(--font-body);}

/* ── CARD + TABLE ── */
.ev-card{background:var(--white);border:1.5px solid var(--border);border-radius:14px;overflow:hidden;}
.scroll-hint{display:none;align-items:center;gap:.4rem;font-size:.68rem;color:var(--warm-grey);padding:.55rem 1rem .1rem;font-family:var(--font-body);}
.scroll-hint svg{width:13px;height:13px;flex-shrink:0;}
@media(max-width:640px){.scroll-hint{display:flex;}}
.tbl-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch;scrollbar-width:thin;scrollbar-color:rgba(201,168,76,.4) transparent;}
.tbl-wrap::-webkit-scrollbar{height:4px;}
.tbl-wrap::-webkit-scrollbar-thumb{background:rgba(201,168,76,.45);border-radius:4px;}
.ev-table{width:100%;min-width:720px;border-collapse:collapse;font-family:var(--font-body);}
.ev-table thead{background:var(--ivory);border-bottom:1.5px solid var(--border);}
.ev-table thead th{padding:.8rem 1.1rem;font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--warm-grey);text-align:left;white-space:nowrap;}
.ev-table thead th:first-child{border-left:3px solid var(--gold);}
.ev-table tbody tr{border-bottom:1px solid #F0EBE5;transition:background .15s;}
.ev-table tbody tr:last-child{border-bottom:none;}
.ev-table tbody tr:hover{background:rgba(201,168,76,.04);}
.ev-table td{padding:.9rem 1.1rem;font-size:.83rem;color:var(--charcoal);vertical-align:middle;}
.ev-table tbody td:first-child{border-left:3px solid transparent;}
.ev-table tbody tr:hover td:first-child{border-left-color:rgba(201,168,76,.45);}
.td-num{color:#C0B8B0;font-size:.72rem;width:44px;}
.td-ev-name{font-family:var(--font-display);font-weight:700;font-size:.9rem;color:var(--charcoal);}
.td-ev-desc{font-size:.7rem;color:var(--warm-grey);margin-top:2px;max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.td-ev-type{display:inline-flex;align-items:center;padding:.22rem .62rem;border-radius:20px;font-size:.67rem;font-weight:500;letter-spacing:.04em;background:var(--gold-light);color:var(--gold-dark);border:1px solid rgba(201,168,76,.25);white-space:nowrap;}
.td-date{font-size:.8rem;color:var(--charcoal);white-space:nowrap;}
.td-venue{font-size:.8rem;color:var(--charcoal);max-width:150px;}
.td-guests{display:inline-flex;align-items:center;gap:.38rem;font-size:.82rem;white-space:nowrap;}
.td-guests svg{flex-shrink:0;}
.td-budget{font-weight:700;font-size:.86rem;color:var(--gold-dark);white-space:nowrap;}

/* ── STATUS BADGES — all 5 values from your schema ── */
.ev-status{display:inline-flex;align-items:center;gap:.3rem;padding:.22rem .68rem;border-radius:20px;font-size:.67rem;font-weight:600;letter-spacing:.04em;white-space:nowrap;font-family:var(--font-body);}
.ev-status::before{content:'';width:5px;height:5px;border-radius:50%;flex-shrink:0;}

/* pending — schema default */
.ev-status.pending{background:rgba(251,191,36,.1);color:#92400E;border:1px solid rgba(251,191,36,.3);}
.ev-status.pending::before{background:#F59E0B;}

/* planning */
.ev-status.planning{background:rgba(99,102,241,.1);color:#3730A3;border:1px solid rgba(99,102,241,.22);}
.ev-status.planning::before{background:#6366F1;}

/* confirmed — when supplier accepts */
.ev-status.confirmed{background:rgba(16,185,129,.1);color:#065F46;border:1px solid rgba(16,185,129,.22);}
.ev-status.confirmed::before{background:#10B981;}

/* ongoing */
.ev-status.ongoing{background:rgba(201,168,76,.1);color:var(--gold-dark);border:1px solid rgba(201,168,76,.25);}
.ev-status.ongoing::before{background:var(--gold);}

/* completed */
.ev-status.completed{background:rgba(107,114,128,.1);color:#374151;border:1px solid rgba(107,114,128,.22);}
.ev-status.completed::before{background:#6B7280;}

/* cancelled */
.ev-status.cancelled{background:rgba(239,68,68,.1);color:#991B1B;border:1px solid rgba(239,68,68,.22);}
.ev-status.cancelled::before{background:#EF4444;}

/* Empty state */
.ev-empty{text-align:center;padding:4rem 1.5rem;}
.ev-empty-icon{width:52px;height:52px;border-radius:50%;background:rgba(201,168,76,.08);display:flex;align-items:center;justify-content:center;margin:0 auto .9rem;color:var(--gold-dark);}
.ev-empty-icon svg{width:24px;height:24px;}
.ev-empty-title{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--charcoal);margin-bottom:.35rem;}
.ev-empty-desc{font-size:.8rem;color:var(--warm-grey);line-height:1.6;margin-bottom:1.1rem;}

/* ══ SHARED MODAL STYLES ══ */
.mo-overlay{position:fixed;inset:0;z-index:8000;background:rgba(30,27,24,.55);display:none;align-items:center;justify-content:center;padding:1rem;backdrop-filter:blur(3px);overflow-y:auto;}
.mo-overlay.open{display:flex;}
.mo-box{background:var(--white);border-radius:14px;border:1px solid var(--border);box-shadow:0 8px 40px rgba(30,27,24,.18);width:100%;overflow:hidden;animation:moSlide .22s ease;margin:auto;flex-shrink:0;}
@keyframes moSlide{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
.mo-box.sm{max-width:420px;}
.mo-box.lg{max-width:600px;max-height:calc(100vh - 2rem);display:flex;flex-direction:column;overflow:hidden;}
.mo-head{display:flex;align-items:center;justify-content:space-between;padding:1.1rem 1.4rem;border-bottom:1px solid var(--border);flex-shrink:0;}
.mo-head-l{display:flex;align-items:center;gap:.65rem;}
.mo-icon{width:32px;height:32px;border-radius:8px;background:rgba(201,168,76,.1);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
.mo-icon svg{width:15px;height:15px;}
.mo-icon.danger{background:rgba(239,68,68,.1);color:#DC2626;}
.mo-icon.success{background:rgba(16,185,129,.1);color:#059669;}
.mo-title{font-family:var(--font-display);font-size:.95rem;font-weight:700;color:var(--charcoal);}
.mo-close{width:30px;height:30px;border-radius:50%;border:1.5px solid var(--border);background:var(--white);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--warm-grey);transition:border-color .15s,color .15s;}
.mo-close:hover{border-color:var(--gold);color:var(--gold-dark);}
.mo-close svg{width:12px;height:12px;}
.mo-body{padding:1.35rem 1.4rem;overflow-y:auto;flex:1;min-height:0;}
.mo-body::-webkit-scrollbar{width:4px;}
.mo-body::-webkit-scrollbar-thumb{background:var(--border-md);border-radius:99px;}
.mo-foot{padding:.85rem 1.4rem;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:flex-end;gap:.55rem;flex-shrink:0;background:var(--white);}
.mo-fg{display:grid;grid-template-columns:repeat(2,1fr);gap:.9rem;}
.mo-fg-full{grid-column:1/-1;}
@media(max-width:500px){.mo-fg{grid-template-columns:1fr;}}
.mo-lbl{display:flex;align-items:center;justify-content:space-between;font-size:.68rem;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:var(--warm-grey);margin-bottom:.38rem;}
.mo-req{font-size:.58rem;color:#C0392B;font-weight:500;text-transform:none;letter-spacing:0;}
.mo-opt{font-size:.58rem;color:#C0B8B0;font-weight:400;text-transform:none;letter-spacing:0;}
.mo-inp,.mo-sel,.mo-ta{width:100%;padding:.68rem .9rem;background:var(--ivory);border:1.5px solid var(--border);border-radius:8px;font-family:var(--font-body);font-size:.84rem;color:var(--charcoal);outline:none;transition:border-color .2s,box-shadow .2s,background .2s;appearance:none;display:block;}
.mo-inp:focus,.mo-sel:focus,.mo-ta:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,.12);background:var(--white);}
.mo-inp::placeholder,.mo-ta::placeholder{color:#C0B8B0;}
.mo-ta{resize:vertical;min-height:85px;}
.mo-sw{position:relative;}
.mo-sw::after{content:'';position:absolute;right:.85rem;top:50%;transform:translateY(-50%);width:0;height:0;border-left:4px solid transparent;border-right:4px solid transparent;border-top:5px solid #C0B8B0;pointer-events:none;}
.mo-iw{position:relative;}
.mo-ico{position:absolute;left:.8rem;top:50%;transform:translateY(-50%);width:14px;height:14px;color:#C0B8B0;pointer-events:none;}
.mo-iw:focus-within .mo-ico{color:var(--gold-dark);}
.mo-iw .mo-inp{padding-left:2.35rem;}
.mo-err{font-size:.68rem;color:#C0392B;margin-top:.28rem;}
.mo-hnt{font-size:.68rem;color:#C0B8B0;margin-top:.28rem;}
.mo-btn-save{display:inline-flex;align-items:center;gap:.45rem;padding:.62rem 1.5rem;border-radius:6px;border:none;background:var(--charcoal);font-family:var(--font-body);font-size:.82rem;font-weight:500;color:var(--white);cursor:pointer;transition:background .2s,box-shadow .2s,transform .15s;}
.mo-btn-save svg{width:13px;height:13px;}
.mo-btn-save:hover{background:var(--gold-dark);box-shadow:0 4px 12px rgba(201,168,76,.2);transform:translateY(-1px);}
.mo-btn-cancel{display:inline-flex;align-items:center;gap:.4rem;padding:.62rem 1.1rem;border-radius:6px;border:1.5px solid var(--border);background:var(--white);font-family:var(--font-body);font-size:.82rem;font-weight:500;color:var(--warm-grey);cursor:pointer;transition:border-color .2s,color .2s;}
.mo-btn-cancel:hover{border-color:var(--gold);color:var(--charcoal);}
.mo-btn-danger-confirm{display:inline-flex;align-items:center;gap:.45rem;padding:.62rem 1.3rem;border-radius:6px;border:none;background:#DC2626;font-family:var(--font-body);font-size:.82rem;font-weight:500;color:var(--white);cursor:pointer;transition:background .2s,box-shadow .2s;}
.mo-btn-danger-confirm:hover{background:#B91C1C;box-shadow:0 4px 12px rgba(220,38,38,.25);}
.mo-btn-danger-confirm:disabled{opacity:.55;cursor:not-allowed;background:#DC2626;box-shadow:none;}
.mo-btn-success-confirm{display:inline-flex;align-items:center;gap:.45rem;padding:.62rem 1.3rem;border-radius:6px;border:none;background:#059669;font-family:var(--font-body);font-size:.82rem;font-weight:500;color:var(--white);cursor:pointer;transition:background .2s,box-shadow .2s;}
.mo-btn-success-confirm:hover{background:#047857;box-shadow:0 4px 12px rgba(5,150,105,.25);}
.mo-btn-success-confirm:disabled{opacity:.55;cursor:not-allowed;box-shadow:none;}
.cancel-warning,.complete-warning{display:flex;flex-direction:column;gap:.75rem;}
.warning-icon{width:52px;height:52px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto .25rem;}
.warning-icon.danger{background:rgba(239,68,68,.08);color:#DC2626;}
.warning-icon.success{background:rgba(16,185,129,.08);color:#059669;}
.warning-icon svg{width:24px;height:24px;}
.warning-msg{font-size:.85rem;color:var(--charcoal);line-height:1.6;text-align:center;}
.warning-note{font-size:.75rem;color:var(--warm-grey);border-radius:8px;padding:.65rem .9rem;line-height:1.55;text-align:left;}
.warning-note.danger{background:rgba(239,68,68,.05);border:1px solid rgba(239,68,68,.15);}
.warning-note.danger strong{color:#991B1B;}
.warning-note.success{background:rgba(16,185,129,.05);border:1px solid rgba(16,185,129,.18);}
.warning-note.success strong{color:#065F46;}
.cancel-ev-name,.complete-ev-name{font-family:var(--font-display);font-weight:700;color:var(--charcoal);}
.ev-alert-success{display:flex;align-items:center;gap:.65rem;background:#F0FDF4;border:1px solid #A7F3D0;border-radius:8px;padding:.75rem 1rem;font-size:.82rem;color:#065F46;margin-bottom:1.25rem;}
.ev-alert-success svg{width:16px;height:16px;color:#10B981;flex-shrink:0;}
.ev-alert-error{display:flex;align-items:center;gap:.65rem;background:#FEF2F2;border:1px solid #FCA5A5;border-radius:8px;padding:.75rem 1rem;font-size:.82rem;color:#991B1B;margin-bottom:1.25rem;}
.ev-alert-error svg{width:16px;height:16px;color:#EF4444;flex-shrink:0;}
</style>

<div class="p-6" style="max-width:1100px;margin:auto;">

    @if(session('success'))
    <div class="ev-alert-success">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="ev-alert-error">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="10" cy="10" r="8"/><path d="M10 6v4M10 14v.5"/></svg>
        {{ session('error') }}
    </div>
    @endif

    <div class="ev-top">
        <div>
            <h2 class="ev-title">My <em>Events</em></h2>
            <p class="ev-subtitle">Manage all your upcoming and past events</p>
        </div>
        <button type="button" class="ev-btn-primary" onclick="addEvModal()">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 2v10M2 7h10"/></svg>
            Add Event
        </button>
    </div>

    @if(isset($events) && count($events))
    <div class="ev-card">
        <div class="scroll-hint">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 10h12M10 4l6 6-6 6"/></svg>
            Scroll sideways to see more
        </div>
        <div class="tbl-wrap">
            <table class="ev-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Event</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Venue</th>
                        <th>Guests</th>
                        <th>Budget</th>
                        <th>Status</th>
                        <th style="text-align:center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $i => $event)
                    @php
                        // ── status comes from DB; default in schema is 'pending'
                        $status  = $event->status ?? 'pending';
                        $evtDate = \Carbon\Carbon::parse($event->event_date)->format('M d, Y');
                        $isPast  = \Carbon\Carbon::parse($event->event_date)->isPast();

                        // Show "Mark Complete" when:
                        //  • event date has already passed, OR
                        //  • a supplier has confirmed (status = confirmed / ongoing)
                        // But NOT when already terminal (cancelled / completed)
                        $canComplete = !in_array($status, ['cancelled', 'completed'])
                            && ($isPast || in_array($status, ['confirmed', 'ongoing']));

                        $canCancel = !in_array($status, ['cancelled', 'completed']);

                        $isTerminal = in_array($status, ['cancelled', 'completed']);
                    @endphp
                    <tr>
                        <td class="td-num">{{ $i + 1 }}</td>

                        <td>
                            <div class="td-ev-name">{{ $event->event_name }}</div>
                            @if($event->description)
                            <div class="td-ev-desc">{{ $event->description }}</div>
                            @endif
                        </td>

                        <td><span class="td-ev-type">{{ $event->event_type }}</span></td>
                        <td><div class="td-date">{{ $evtDate }}</div></td>
                        <td><div class="td-venue">{{ $event->venue ?? '—' }}</div></td>

                        <td>
                            <div class="td-guests">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="#706B65" stroke-width="1.6">
                                    <circle cx="7" cy="6" r="3"/><path d="M1 17c0-3 2.7-5 6-5"/>
                                    <circle cx="13" cy="6" r="3"/><path d="M19 17c0-3-2.7-5-6-5s-6 2-6 5"/>
                                </svg>
                                {{ $event->guest_count ? number_format($event->guest_count) : '—' }}
                            </div>
                        </td>

                        <td>
                            <div class="td-budget">
                                @if($event->budget)₱{{ number_format($event->budget) }}@else—@endif
                            </div>
                        </td>

                        <td>
                            {{-- CSS class matches the exact status string from DB --}}
                            <span class="ev-status {{ $status }}"
                                  data-status-id="{{ $event->id }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>

                        <td style="text-align:center;">
                            @if($status === 'cancelled')
                                <span class="ev-cancelled-tag">Cancelled</span>

                            @elseif($status === 'completed')
                                <span class="ev-completed-tag">Completed</span>

                            @else
                                <div class="ev-actions" id="actions-{{ $event->id }}">

                                    @if($canComplete)
                                    <button type="button"
                                        class="ev-btn-complete"
                                        onclick="completeEvModal(
                                            {{ $event->id }},
                                            '{{ addslashes($event->event_name) }}',
                                            '{{ route('client.events.complete', $event->id) }}',
                                            this
                                        )">
                                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                                            <polyline points="2 7 5.5 10.5 12 3"/>
                                        </svg>
                                        Mark Complete
                                    </button>
                                    @endif

                                    @if($canCancel)
                                    <button type="button"
                                        class="ev-btn-danger"
                                        onclick="cancelEvModal(
                                            {{ $event->id }},
                                            '{{ addslashes($event->event_name) }}',
                                            '{{ route('client.events.cancel', $event->id) }}',
                                            this
                                        )">
                                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                                            <circle cx="7" cy="7" r="5.5"/>
                                            <path d="M4.5 4.5l5 5M9.5 4.5l-5 5"/>
                                        </svg>
                                        Cancel
                                    </button>
                                    @endif

                                </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @else
    <div class="ev-card">
        <div class="ev-empty">
            <div class="ev-empty-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="4" width="14" height="13" rx="2"/><path d="M3 8h14M8 4V2M12 4V2"/>
                </svg>
            </div>
            <div class="ev-empty-title">No Events Yet</div>
            <div class="ev-empty-desc">You haven't created any events.<br>Click the button below to add your first event.</div>
            <button type="button" class="ev-btn-primary" onclick="addEvModal()">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 2v10M2 7h10"/></svg>
                Add Event
            </button>
        </div>
    </div>
    @endif

</div>


{{-- ══ ADD EVENT MODAL ══ --}}
<div class="mo-overlay" id="addEvOverlay" onclick="if(event.target===this)closeAddEv()">
    <div class="mo-box lg">
        <div class="mo-head">
            <div class="mo-head-l">
                <div class="mo-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="4" width="14" height="13" rx="2"/><path d="M3 8h14M8 4V2M12 4V2"/></svg>
                </div>
                <div class="mo-title">Add New Event</div>
            </div>
            <button type="button" class="mo-close" onclick="closeAddEv()">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
            </button>
        </div>

        <form action="{{ route('client.events.store') }}" method="POST" style="display:contents;">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

            <div class="mo-body">
                <div class="mo-fg">

                    <div class="mo-fg-full">
                        <label class="mo-lbl" for="ev_name">Event Name <span class="mo-req">Required</span></label>
                        <div class="mo-iw">
                            <svg class="mo-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="4" width="14" height="13" rx="2"/><path d="M3 8h14"/></svg>
                            <input id="ev_name" type="text" name="event_name" class="mo-inp"
                                   placeholder="e.g. Juan & Maria's Wedding"
                                   value="{{ old('event_name') }}" required>
                        </div>
                        @error('event_name')<div class="mo-err">{{ $message }}</div>@enderror
                    </div>

                    @php $eventcategories = \App\Models\Eventcategory::all(); @endphp
                    @if($eventcategories->count())
                    <div>
                        <label class="mo-lbl" for="ev_type">Event Type <span class="mo-req">Required</span></label>
                        <div class="mo-sw">
                            <select id="ev_type" name="event_type" class="mo-sel" required>
                                <option value="" disabled {{ !old('event_type') ? 'selected' : '' }}>Select type…</option>
                                @foreach($eventcategories as $ec)
                                    <option value="{{ $ec->name }}" {{ old('event_type') == $ec->name ? 'selected' : '' }}>{{ $ec->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('event_type')<div class="mo-err">{{ $message }}</div>@enderror
                    </div>
                    @endif

                    <div>
                        <label class="mo-lbl" for="ev_date">Event Date <span class="mo-req">Required</span></label>
                        <div class="mo-iw">
                            <svg class="mo-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="4" width="14" height="13" rx="2"/><path d="M3 8h14M8 4V2M12 4V2"/></svg>
                            <input id="ev_date" type="date" name="event_date" class="mo-inp"
                                   value="{{ old('event_date') }}" required style="padding-right:.9rem;">
                        </div>
                        @error('event_date')<div class="mo-err">{{ $message }}</div>@enderror
                    </div>

                    <div>
                        <label class="mo-lbl" for="ev_budget">Budget <span class="mo-req">Required</span></label>
                        <div class="mo-iw">
                            <svg class="mo-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="10" r="7"/><path d="M10 6v8M7.5 8.5h4a1.5 1.5 0 010 3h-3a1.5 1.5 0 000 3H13"/></svg>
                            <input id="ev_budget" type="number" name="budget" class="mo-inp"
                                   placeholder="e.g. 150000" value="{{ old('budget') }}" min="0" required>
                        </div>
                        <p class="mo-hnt">Enter amount in Philippine Peso (₱)</p>
                        @error('budget')<div class="mo-err">{{ $message }}</div>@enderror
                    </div>

                    <div>
                        <label class="mo-lbl" for="ev_guests">Guest Count <span class="mo-opt">Optional</span></label>
                        <div class="mo-iw">
                            <svg class="mo-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="7" cy="6" r="3"/><path d="M1 17c0-3 2.7-5 6-5"/><circle cx="13" cy="6" r="3"/><path d="M19 17c0-3-2.7-5-6-5s-6 2-6 5"/></svg>
                            <input id="ev_guests" type="number" name="guest_count" class="mo-inp"
                                   placeholder="e.g. 200" value="{{ old('guest_count') }}" min="1">
                        </div>
                        @error('guest_count')<div class="mo-err">{{ $message }}</div>@enderror
                    </div>

                    <div class="mo-fg-full">
                        <label class="mo-lbl" for="ev_venue">Venue <span class="mo-opt">Optional</span></label>
                        <div class="mo-iw">
                            <svg class="mo-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M10 2C7.2 2 5 4.2 5 7c0 4.4 5 11 5 11s5-6.6 5-11c0-2.8-2.2-5-5-5z"/><circle cx="10" cy="7" r="2"/></svg>
                            <input id="ev_venue" type="text" name="venue" class="mo-inp"
                                   placeholder="e.g. Grand Ballroom, Makati" value="{{ old('venue') }}">
                        </div>
                        @error('venue')<div class="mo-err">{{ $message }}</div>@enderror
                    </div>

                    <div class="mo-fg-full">
                        <label class="mo-lbl" for="ev_desc">Description <span class="mo-opt">Optional</span></label>
                        <textarea id="ev_desc" name="description" class="mo-ta"
                                  placeholder="Tell us more about your event…">{{ old('description') }}</textarea>
                        @error('description')<div class="mo-err">{{ $message }}</div>@enderror
                    </div>

                </div>
            </div>

            <div class="mo-foot">
                <button type="button" class="mo-btn-cancel" onclick="closeAddEv()">Cancel</button>
                <button type="submit" class="mo-btn-save">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg>
                    Save Event
                </button>
            </div>
        </form>
    </div>
</div>


{{-- ══ CANCEL CONFIRM MODAL ══ --}}
<div class="mo-overlay" id="cancelEvOverlay" onclick="if(event.target===this)closeCancelEv()">
    <div class="mo-box sm">
        <div class="mo-head">
            <div class="mo-head-l">
                <div class="mo-icon danger">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="10" r="8"/><path d="M10 6v4M10 14v.5"/></svg>
                </div>
                <div class="mo-title">Cancel Event</div>
            </div>
            <button type="button" class="mo-close" onclick="closeCancelEv()">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
            </button>
        </div>
        <div class="mo-body">
            <div class="cancel-warning">
                <div class="warning-icon danger">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                </div>
                <div class="warning-msg">
                    Are you sure you want to cancel<br>
                    <span class="cancel-ev-name" id="cancelEvName"></span>?
                </div>
                <div class="warning-note danger">
                    <strong>⚠ Note:</strong> Cancelling this event will also cancel any pending or confirmed bookings. This action cannot be undone.
                </div>
            </div>
        </div>
        <div class="mo-foot">
            <button type="button" class="mo-btn-cancel" onclick="closeCancelEv()">Keep Event</button>
            <form id="cancelEvForm" method="POST" style="margin:0;">
                @csrf @method('PATCH')
                <button type="submit" class="mo-btn-danger-confirm" id="cancelEvConfirmBtn">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8" style="width:13px;height:13px;">
                        <circle cx="7" cy="7" r="5.5"/><path d="M4.5 4.5l5 5M9.5 4.5l-5 5"/>
                    </svg>
                    Yes, Cancel Event
                </button>
            </form>
        </div>
    </div>
</div>


{{-- ══ COMPLETE CONFIRM MODAL ══ --}}
<div class="mo-overlay" id="completeEvOverlay" onclick="if(event.target===this)closeCompleteEv()">
    <div class="mo-box sm">
        <div class="mo-head">
            <div class="mo-head-l">
                <div class="mo-icon success">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M4 10l4 4 8-8"/><circle cx="10" cy="10" r="8"/></svg>
                </div>
                <div class="mo-title">Mark as Completed</div>
            </div>
            <button type="button" class="mo-close" onclick="closeCompleteEv()">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
            </button>
        </div>
        <div class="mo-body">
            <div class="complete-warning">
                <div class="warning-icon success">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                </div>
                <div class="warning-msg">
                    Mark <span class="complete-ev-name" id="completeEvName"></span><br>as completed?
                </div>
                <div class="warning-note success">
                    <strong>✓ Note:</strong> This marks the event as fully done. Any still-pending bookings will be cancelled automatically.
                </div>
            </div>
        </div>
        <div class="mo-foot">
            <button type="button" class="mo-btn-cancel" onclick="closeCompleteEv()">Not Yet</button>
            <form id="completeEvForm" method="POST" style="margin:0;">
                @csrf @method('PATCH')
                <button type="submit" class="mo-btn-success-confirm" id="completeEvConfirmBtn">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8" style="width:13px;height:13px;">
                        <polyline points="2 7 5.5 10.5 12 3"/>
                    </svg>
                    Yes, Mark Complete
                </button>
            </form>
        </div>
    </div>
</div>


<script>
/* ── ADD EVENT MODAL ── */
function addEvModal() {
    document.getElementById('addEvOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
    setTimeout(function(){ document.getElementById('ev_name').focus(); }, 80);
}
function closeAddEv() {
    document.getElementById('addEvOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

/* ── CANCEL MODAL ── */
var _activeCancelBtn = null, _activeCancelId = null;

function cancelEvModal(id, name, actionUrl, btn) {
    document.getElementById('cancelEvName').textContent = name;
    document.getElementById('cancelEvForm').action = actionUrl;
    var cb = document.getElementById('cancelEvConfirmBtn');
    cb.disabled = false;
    cb.innerHTML = '<svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8" style="width:13px;height:13px;"><circle cx="7" cy="7" r="5.5"/><path d="M4.5 4.5l5 5M9.5 4.5l-5 5"/></svg> Yes, Cancel Event';
    _activeCancelBtn = btn || null;
    _activeCancelId  = id;
    document.getElementById('cancelEvOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeCancelEv() {
    document.getElementById('cancelEvOverlay').classList.remove('open');
    document.body.style.overflow = '';
    _activeCancelBtn = null; _activeCancelId = null;
}
document.getElementById('cancelEvForm').addEventListener('submit', function() {
    var cb = document.getElementById('cancelEvConfirmBtn');
    cb.disabled = true; cb.textContent = '… Cancelling';

    // Update action cell
    if (_activeCancelBtn) {
        var cell = _activeCancelBtn.closest('#actions-' + _activeCancelId) || _activeCancelBtn.closest('td');
        if (cell) cell.innerHTML = '<span class="ev-cancelled-tag">Cancelled</span>';
        _activeCancelBtn = null;
    }
    // Update status badge
    if (_activeCancelId) {
        var badge = document.querySelector('.ev-status[data-status-id="' + _activeCancelId + '"]');
        if (badge) { badge.className = 'ev-status cancelled'; badge.textContent = 'Cancelled'; }
        _activeCancelId = null;
    }
});

/* ── COMPLETE MODAL ── */
var _activeCompleteBtn = null, _activeCompleteId = null;

function completeEvModal(id, name, actionUrl, btn) {
    document.getElementById('completeEvName').textContent = name;
    document.getElementById('completeEvForm').action = actionUrl;
    var cb = document.getElementById('completeEvConfirmBtn');
    cb.disabled = false;
    cb.innerHTML = '<svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8" style="width:13px;height:13px;"><polyline points="2 7 5.5 10.5 12 3"/></svg> Yes, Mark Complete';
    _activeCompleteBtn = btn || null;
    _activeCompleteId  = id;
    document.getElementById('completeEvOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeCompleteEv() {
    document.getElementById('completeEvOverlay').classList.remove('open');
    document.body.style.overflow = '';
    _activeCompleteBtn = null; _activeCompleteId = null;
}
document.getElementById('completeEvForm').addEventListener('submit', function() {
    var cb = document.getElementById('completeEvConfirmBtn');
    cb.disabled = true; cb.textContent = '… Completing';

    // Update action cell
    if (_activeCompleteBtn) {
        var cell = _activeCompleteBtn.closest('#actions-' + _activeCompleteId) || _activeCompleteBtn.closest('td');
        if (cell) cell.innerHTML = '<span class="ev-completed-tag">Completed</span>';
        _activeCompleteBtn = null;
    }
    // Update status badge
    if (_activeCompleteId) {
        var badge = document.querySelector('.ev-status[data-status-id="' + _activeCompleteId + '"]');
        if (badge) { badge.className = 'ev-status completed'; badge.textContent = 'Completed'; }
        _activeCompleteId = null;
    }
});

/* Close on Escape */
document.addEventListener('keydown', function(e) {
    if (e.key !== 'Escape') return;
    closeAddEv(); closeCancelEv(); closeCompleteEv();
});

@if($errors->any())
    addEvModal();
@endif
</script>

</x-client-layout>