<x-supplier-layout>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap');

:root {
    --gold:#C9A84C; --gold-dark:#8A6A1F; --gold-light:rgba(201,168,76,0.12);
    --ivory:#FAF7F2; --charcoal:#1E1B18; --warm-grey:#706B65;
    --border:#E5DDD5; --border-md:#E0D8D0;
    --white:#FFFFFF;
    --font-display:'Playfair Display',Georgia,serif;
    --font-body:'DM Sans',sans-serif;
    --radius-card:14px; --radius-btn:8px; --radius-badge:20px;
    --shadow-card:0 2px 16px rgba(30,27,24,.07);
    --shadow-hover:0 6px 28px rgba(30,27,24,.13);
    --shadow-modal:0 8px 40px rgba(30,27,24,.2);
}

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}

/* ── PAGE ── */
.tm-page{max-width:1100px;margin:auto;padding:1.75rem 1.5rem 4rem;}

/* ── ALERTS ── */
.tm-alert{display:flex;align-items:center;gap:.65rem;border-radius:10px;padding:.8rem 1.1rem;font-family:var(--font-body);font-size:.83rem;margin-bottom:1.25rem;}
.tm-alert svg{width:15px;height:15px;flex-shrink:0;}
.tm-alert-ok{background:#F0FDF4;border:1px solid #A7F3D0;color:#065F46;}
.tm-alert-ok svg{color:#10B981;}
.tm-alert-err{background:#FEF2F2;border:1px solid #FCA5A5;color:#991B1B;}
.tm-alert-err svg{color:#EF4444;}

/* ── PAGE HEADER ── */
.tm-page-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;}
.tm-page-title{font-family:var(--font-display);font-size:1.65rem;font-weight:700;color:var(--charcoal);line-height:1.15;}
.tm-page-title em{font-style:italic;color:var(--gold-dark);}
.tm-page-sub{font-size:.76rem;color:var(--warm-grey);margin-top:.2rem;font-family:var(--font-body);}
.tm-btn-add{display:inline-flex;align-items:center;gap:.45rem;padding:.6rem 1.3rem;border-radius:var(--radius-btn);border:none;background:var(--charcoal);font-family:var(--font-body);font-size:.8rem;font-weight:600;color:var(--white);cursor:pointer;transition:background .2s,box-shadow .2s,transform .15s;white-space:nowrap;}
.tm-btn-add svg{width:13px;height:13px;flex-shrink:0;}
.tm-btn-add:hover{background:var(--gold-dark);box-shadow:0 4px 12px rgba(201,168,76,.25);transform:translateY(-1px);}

/* ── MEMBER GRID ── */
.tm-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.25rem;}
@media(max-width:620px){.tm-grid{grid-template-columns:1fr;}}

/* ── MEMBER CARD ── */
.tm-card{background:var(--white);border-radius:var(--radius-card);border:1.5px solid var(--border);box-shadow:var(--shadow-card);overflow:hidden;transition:box-shadow .2s,transform .2s,border-color .2s;display:flex;flex-direction:column;}
.tm-card:hover{box-shadow:var(--shadow-hover);transform:translateY(-3px);border-color:rgba(201,168,76,.4);}
.tm-card-banner{height:72px;background:linear-gradient(135deg,var(--charcoal) 0%,#2a2016 60%,#3d2f14 100%);position:relative;flex-shrink:0;}
.tm-card-banner::after{content:'';position:absolute;bottom:-1px;left:0;right:0;height:28px;background:var(--white);border-radius:50% 50% 0 0 / 28px 28px 0 0;}
.tm-card-avatar-wrap{position:absolute;left:50%;bottom:-30px;transform:translateX(-50%);z-index:2;}
.tm-card-avatar{width:62px;height:62px;border-radius:50%;border:3px solid var(--white);box-shadow:0 3px 12px rgba(30,27,24,.18);overflow:hidden;background:linear-gradient(135deg,var(--gold),var(--gold-dark));display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:1.3rem;font-weight:700;color:var(--white);}
.tm-card-avatar img{width:100%;height:100%;object-fit:cover;display:block;}
.tm-card-body{padding:2.5rem 1.3rem 1rem;text-align:center;flex:1;display:flex;flex-direction:column;align-items:center;}
.tm-card-name{font-family:var(--font-display);font-size:.98rem;font-weight:700;color:var(--charcoal);line-height:1.2;margin-bottom:.2rem;}
.tm-card-role{display:inline-flex;align-items:center;padding:.18rem .62rem;border-radius:var(--radius-badge);background:var(--gold-light);color:var(--gold-dark);font-family:var(--font-body);font-size:.65rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;margin-bottom:.75rem;}
.tm-card-contact{display:flex;flex-direction:column;gap:.22rem;margin-bottom:.85rem;width:100%;}
.tm-card-contact-item{display:flex;align-items:center;justify-content:center;gap:.38rem;font-family:var(--font-body);font-size:.72rem;color:var(--warm-grey);}
.tm-card-contact-item svg{width:11px;height:11px;color:var(--gold-dark);flex-shrink:0;}
.tm-card-bio{font-family:var(--font-body);font-size:.75rem;color:var(--warm-grey);line-height:1.6;text-align:center;margin-bottom:.85rem;background:rgba(201,168,76,.04);border-radius:8px;padding:.55rem .75rem;border:1px solid #F0EBE5;width:100%;}
.tm-card-foot{width:100%;display:flex;gap:.45rem;justify-content:center;padding-top:.75rem;border-top:1px solid #F5EFE8;margin-top:auto;}
.tm-card-btn{display:inline-flex;align-items:center;gap:.3rem;padding:.38rem .82rem;border-radius:6px;border:1.5px solid var(--border-md);background:var(--white);font-family:var(--font-body);font-size:.72rem;font-weight:600;color:var(--warm-grey);cursor:pointer;transition:all .18s;white-space:nowrap;}
.tm-card-btn svg{width:11px;height:11px;}
.tm-card-btn:hover{border-color:var(--gold);color:var(--gold-dark);background:var(--gold-light);}
.tm-card-btn.danger{border-color:#FADBD8;color:#C0392B;}
.tm-card-btn.danger:hover{border-color:#C0392B;background:#FFF5F5;}

/* ── EMPTY STATE ── */
.tm-empty{text-align:center;padding:4rem 1.5rem;background:var(--white);border-radius:var(--radius-card);border:1.5px dashed var(--border);}
.tm-empty-icon{width:56px;height:56px;border-radius:50%;background:var(--gold-light);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;color:var(--gold-dark);}
.tm-empty-icon svg{width:26px;height:26px;}
.tm-empty-title{font-family:var(--font-display);font-size:1.05rem;font-weight:700;color:var(--charcoal);margin-bottom:.35rem;}
.tm-empty-desc{font-family:var(--font-body);font-size:.8rem;color:var(--warm-grey);line-height:1.6;margin-bottom:1.25rem;}

/* ══ SHARED MODAL STYLES ══ */
.mo-overlay{position:fixed;inset:0;z-index:8000;background:rgba(30,27,24,.55);display:none;align-items:flex-start;justify-content:center;padding:1rem;backdrop-filter:blur(3px);overflow-y:auto;}
.mo-overlay.open{display:flex;}
.mo-box{background:var(--white);border-radius:var(--radius-card);border:1px solid var(--border);box-shadow:var(--shadow-modal);width:100%;max-width:540px;margin:auto;flex-shrink:0;animation:moSlide .22s ease;display:flex;flex-direction:column;max-height:calc(100vh - 2rem);overflow:hidden;}
.mo-box.mo-sm{max-width:420px;}
@keyframes moSlide{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
.mo-head{display:flex;align-items:center;justify-content:space-between;padding:1.1rem 1.4rem;border-bottom:1px solid var(--border);flex-shrink:0;}
.mo-head-l{display:flex;align-items:center;gap:.65rem;}
.mo-icon{width:32px;height:32px;border-radius:8px;background:var(--gold-light);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
.mo-icon svg{width:15px;height:15px;}
.mo-icon.danger{background:#FEF2F2;color:#C0392B;}
.mo-title{font-family:var(--font-display);font-size:.95rem;font-weight:700;color:var(--charcoal);}
.mo-close{width:30px;height:30px;border-radius:50%;border:1.5px solid var(--border);background:var(--white);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--warm-grey);transition:border-color .15s,color .15s;}
.mo-close:hover{border-color:var(--gold);color:var(--gold-dark);}
.mo-close svg{width:12px;height:12px;}
.mo-body{padding:1.35rem 1.4rem;overflow-y:auto;flex:1;min-height:0;}
.mo-body::-webkit-scrollbar{width:4px;}
.mo-body::-webkit-scrollbar-thumb{background:var(--border-md);border-radius:99px;}
.mo-foot{padding:.85rem 1.4rem;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:flex-end;gap:.55rem;flex-shrink:0;background:var(--white);}
.mo-field{margin-bottom:.85rem;}
.mo-field:last-child{margin-bottom:0;}
.mo-fg{display:grid;grid-template-columns:repeat(2,1fr);gap:.85rem;margin-bottom:.85rem;}
@media(max-width:480px){.mo-fg{grid-template-columns:1fr;}}
.mo-lbl{display:flex;align-items:center;justify-content:space-between;font-size:.68rem;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:var(--warm-grey);margin-bottom:.35rem;font-family:var(--font-body);}
.mo-req{font-size:.58rem;color:#C0392B;font-weight:500;text-transform:none;letter-spacing:0;}
.mo-opt{font-size:.58rem;color:#C0B8B0;font-weight:400;text-transform:none;letter-spacing:0;}
.mo-inp,.mo-ta{width:100%;padding:.65rem .9rem;background:var(--ivory);border:1.5px solid var(--border);border-radius:8px;font-family:var(--font-body);font-size:.84rem;color:var(--charcoal);outline:none;transition:border-color .2s,box-shadow .2s,background .2s;appearance:none;display:block;}
.mo-inp:focus,.mo-ta:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,.12);background:var(--white);}
.mo-inp::placeholder,.mo-ta::placeholder{color:#C0B8B0;}
.mo-ta{resize:vertical;min-height:80px;}
.mo-iw{position:relative;}
.mo-ico{position:absolute;left:.8rem;top:50%;transform:translateY(-50%);width:14px;height:14px;color:#C0B8B0;pointer-events:none;}
.mo-iw:focus-within .mo-ico{color:var(--gold-dark);}
.mo-iw .mo-inp{padding-left:2.35rem;}
.mo-file-wrap{display:flex;align-items:center;gap:.75rem;}
.mo-file-preview{width:52px;height:52px;border-radius:50%;background:var(--gold-light);border:2px solid var(--border);overflow:hidden;display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
.mo-file-preview img{width:100%;height:100%;object-fit:cover;display:none;}
.mo-file-preview.has-img img{display:block;}
.mo-file-preview.has-img svg{display:none;}
.mo-file-preview svg{width:20px;height:20px;}
.mo-file-inp{flex:1;padding:.55rem .85rem;background:var(--ivory);border:1.5px solid var(--border);border-radius:8px;font-family:var(--font-body);font-size:.78rem;color:var(--warm-grey);cursor:pointer;outline:none;transition:border-color .2s;}
.mo-file-inp:focus{border-color:var(--gold);}
.mo-btn-save{display:inline-flex;align-items:center;gap:.45rem;padding:.62rem 1.5rem;border-radius:var(--radius-btn);border:none;background:var(--charcoal);font-family:var(--font-body);font-size:.82rem;font-weight:600;color:var(--white);cursor:pointer;transition:background .2s,box-shadow .2s,transform .15s;}
.mo-btn-save svg{width:13px;height:13px;}
.mo-btn-save:hover{background:var(--gold-dark);box-shadow:0 4px 12px rgba(201,168,76,.22);transform:translateY(-1px);}
.mo-btn-cancel{display:inline-flex;align-items:center;gap:.4rem;padding:.62rem 1.1rem;border-radius:var(--radius-btn);border:1.5px solid var(--border);background:var(--white);font-family:var(--font-body);font-size:.82rem;font-weight:500;color:var(--warm-grey);cursor:pointer;transition:border-color .2s,color .2s;}
.mo-btn-cancel:hover{border-color:var(--gold);color:var(--charcoal);}
.mo-btn-danger{display:inline-flex;align-items:center;gap:.45rem;padding:.62rem 1.4rem;border-radius:var(--radius-btn);border:none;background:#C0392B;font-family:var(--font-body);font-size:.82rem;font-weight:600;color:var(--white);cursor:pointer;transition:background .2s,box-shadow .2s;}
.mo-btn-danger:hover{background:#9B2335;box-shadow:0 4px 12px rgba(192,57,43,.25);}

/* Delete confirm box */
.mo-confirm-box{display:flex;gap:.9rem;align-items:flex-start;background:#FEF2F2;border:1px solid #FECACA;border-radius:10px;padding:.9rem 1rem;}
.mo-confirm-icon{width:44px;height:44px;border-radius:50%;background:#FEE2E2;display:flex;align-items:center;justify-content:center;color:#C0392B;flex-shrink:0;}
.mo-confirm-icon svg{width:20px;height:20px;}
.mo-confirm-text h4{font-family:var(--font-display);font-size:.9rem;font-weight:700;color:var(--charcoal);margin-bottom:.25rem;}
.mo-confirm-text p{font-family:var(--font-body);font-size:.78rem;color:var(--warm-grey);line-height:1.55;}
.mo-confirm-name{font-weight:600;color:var(--charcoal);}

/* ── STATS ROW ── */
.tm-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.75rem;}
@media(max-width:560px){.tm-stats{grid-template-columns:1fr;}}
.tm-stat-card{background:var(--white);border-radius:12px;border:1.5px solid var(--border);box-shadow:var(--shadow-card);padding:1.1rem 1.3rem;display:flex;align-items:center;gap:.85rem;}
.tm-stat-icon{width:38px;height:38px;border-radius:9px;background:var(--gold-light);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
.tm-stat-icon svg{width:17px;height:17px;}
.tm-stat-label{font-family:var(--font-body);font-size:.62rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#C0B8B0;margin-bottom:.15rem;}
.tm-stat-val{font-family:var(--font-display);font-size:1.3rem;font-weight:700;color:var(--charcoal);line-height:1.1;}
</style>

<div class="tm-page">

    {{-- ALERTS --}}
    @if(session('success'))
    <div class="tm-alert tm-alert-ok">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="tm-alert tm-alert-err">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="10" cy="10" r="8"/><path d="M10 6v4M10 14v.5"/></svg>
        {{ session('error') }}
    </div>
    @endif

    {{-- PAGE HEADER --}}
    <div class="tm-page-header">
        <div>
            <h1 class="tm-page-title">Team <em>Members</em></h1>
            <p class="tm-page-sub">Manage your supplier staff and assistants</p>
        </div>
        <button type="button" class="tm-btn-add" onclick="openAddModal()">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 2v10M2 7h10"/></svg>
            Add Member
        </button>
    </div>

    {{-- STATS --}}
    @php $total = $members->count(); @endphp
    <div class="tm-stats">
        <div class="tm-stat-card">
            <div class="tm-stat-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="7" cy="6" r="3"/><circle cx="14" cy="6" r="3"/>
                    <path d="M1 17c0-3 2.7-5 6-5"/><path d="M10 17c0-3 2.7-5 6-5 3.3 0 3 2 3 5"/>
                </svg>
            </div>
            <div>
                <div class="tm-stat-label">Total Members</div>
                <div class="tm-stat-val">{{ $total }}</div>
            </div>
        </div>
        <div class="tm-stat-card">
            <div class="tm-stat-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M3 9l7-7 7 7v9a1 1 0 01-1 1H4a1 1 0 01-1-1V9z"/>
                    <path d="M8 19V12h4v7"/>
                </svg>
            </div>
            <div>
                <div class="tm-stat-label">With Photo</div>
                <div class="tm-stat-val">{{ $members->filter(fn($m) => $m->photo)->count() }}</div>
            </div>
        </div>
        <div class="tm-stat-card">
            <div class="tm-stat-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="10" cy="10" r="7"/><path d="M10 7v3.5l2 1.5"/>
                </svg>
            </div>
            <div>
                <div class="tm-stat-label">With Contact</div>
                <div class="tm-stat-val">{{ $members->filter(fn($m) => $m->email || $m->phone)->count() }}</div>
            </div>
        </div>
    </div>

    {{-- MEMBER GRID --}}
    @if($members->count())
    <div class="tm-grid">
        @foreach($members as $member)
        @php
            $initials = strtoupper(substr($member->name, 0, 2));
            $payload  = [
                'id'    => $member->id,
                'name'  => $member->name,
                'role'  => $member->role,
                'email' => $member->email,
                'phone' => $member->phone,
                'bio'   => $member->bio,
                'photo' => $member->photo ? asset('storage/'.$member->photo) : null,
                'editUrl'   => route('supplier.team-members.update', $member->id),
                'deleteUrl' => route('supplier.team-members.destroy', $member->id),
            ];
        @endphp
        <div class="tm-card">
            {{-- Banner + avatar --}}
            <div class="tm-card-banner">
                <div class="tm-card-avatar-wrap">
                    <div class="tm-card-avatar">
                        @if($member->photo)
                        <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}">
                        @else
                        <span>{{ $initials }}</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="tm-card-body">
                <div class="tm-card-name">{{ $member->name }}</div>
                <div class="tm-card-role">{{ $member->role }}</div>

                @if($member->email || $member->phone)
                <div class="tm-card-contact">
                    @if($member->email)
                    <div class="tm-card-contact-item">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="3" width="12" height="8" rx="1.5"/><path d="M1 5l6 3.5L13 5"/></svg>
                        {{ $member->email }}
                    </div>
                    @endif
                    @if($member->phone)
                    <div class="tm-card-contact-item">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 3a1.5 1.5 0 011.5-1.5h1L5.5 4 4 5a7 7 0 002 2l1-1.5 2.5 1v1A1.5 1.5 0 018 12C4.7 12 2 9.3 2 6V3z"/></svg>
                        {{ $member->phone }}
                    </div>
                    @endif
                </div>
                @endif

                @if($member->bio)
                <div class="tm-card-bio">{{ $member->bio }}</div>
                @endif

                <div class="tm-card-foot">
                    <button type="button" class="tm-card-btn"
                        onclick='openEditModal({{ json_encode($payload) }})'>
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9.5 1.5l3 3L4 13H1v-3L9.5 1.5z"/></svg>
                        Edit
                    </button>
                    <button type="button" class="tm-card-btn danger"
                        onclick='openDeleteModal({{ $member->id }},{{ json_encode($member->name) }},{{ json_encode(route("supplier.team-members.destroy",$member->id)) }})'>
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 3.5h10M5 3.5V2h4v1.5M5.5 6v5M8.5 6v5M3 3.5l.7 8.5h6.6L11 3.5H3z"/></svg>
                        Delete
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @else
    <div class="tm-empty">
        <div class="tm-empty-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="8" cy="7" r="4"/><path d="M2 21c0-5 2.7-8 6-8"/>
                <circle cx="17" cy="7" r="4"/><path d="M11 21c0-5 2.7-8 6-8 3.3 0 5 3 5 8"/>
            </svg>
        </div>
        <div class="tm-empty-title">No Team Members Yet</div>
        <div class="tm-empty-desc">Add your first team member to start building your supplier team.</div>
        <button type="button" class="tm-btn-add" onclick="openAddModal()">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 2v10M2 7h10"/></svg>
            Add Member
        </button>
    </div>
    @endif

</div>{{-- /tm-page --}}

{{-- ══════════════════════════════════════════
     ADD MEMBER MODAL
══════════════════════════════════════════ --}}
<div class="mo-overlay" id="addOverlay" onclick="if(event.target===this)closeAddModal()">
    <div class="mo-box">
        <div class="mo-head">
            <div class="mo-head-l">
                <div class="mo-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="7" r="4"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7"/>
                        <path d="M15 4v6M12 7h6"/>
                    </svg>
                </div>
                <div class="mo-title">Add Team Member</div>
            </div>
            <button type="button" class="mo-close" onclick="closeAddModal()">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
            </button>
        </div>

        <form action="{{ route('supplier.team-members.store') }}" method="POST" enctype="multipart/form-data" style="display:contents;">
            @csrf
            <div class="mo-body">

                {{-- Photo upload --}}
                <div class="mo-field">
                    <label class="mo-lbl">Photo <span class="mo-opt">Optional</span></label>
                    <div class="mo-file-wrap">
                        <div class="mo-file-preview" id="addPhotoPreview">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="10" cy="7" r="4"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                            <img id="addPhotoImg" src="" alt="">
                        </div>
                        <input type="file" name="photo" class="mo-file-inp" accept="image/*"
                               onchange="previewPhoto(this,'addPhotoPreview','addPhotoImg')">
                    </div>
                </div>

                {{-- Name + Role --}}
                <div class="mo-fg">
                    <div>
                        <label class="mo-lbl">Full Name <span class="mo-req">Required</span></label>
                        <div class="mo-iw">
                            <svg class="mo-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="7" r="4"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                            <input type="text" name="name" id="add_name" class="mo-inp" placeholder="e.g. Juan Dela Cruz" required>
                        </div>
                    </div>
                    <div>
                        <label class="mo-lbl">Role <span class="mo-req">Required</span></label>
                        <div class="mo-iw">
                            <svg class="mo-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="4" width="14" height="13" rx="2"/><path d="M7 4V2h6v2M8 9h4M8 12h2"/></svg>
                            <input type="text" name="role" class="mo-inp" placeholder="e.g. Photographer" required>
                        </div>
                    </div>
                </div>

                {{-- Email + Phone --}}
                <div class="mo-fg">
                    <div>
                        <label class="mo-lbl">Email <span class="mo-opt">Optional</span></label>
                        <div class="mo-iw">
                            <svg class="mo-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="4" width="16" height="12" rx="2"/><path d="M2 7l8 5 8-5"/></svg>
                            <input type="email" name="email" class="mo-inp" placeholder="juan@email.com">
                        </div>
                    </div>
                    <div>
                        <label class="mo-lbl">Phone <span class="mo-opt">Optional</span></label>
                        <div class="mo-iw">
                            <svg class="mo-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M3 5a2 2 0 012-2h1l2 4-1.5 1.5a11 11 0 004 4L12 11l4 2v1a2 2 0 01-2 2C7.5 16 4 12.5 4 7a2 2 0 011-1.7V5z"/></svg>
                            <input type="text" name="phone" class="mo-inp" placeholder="+63 917 000 0000">
                        </div>
                    </div>
                </div>

                {{-- Bio --}}
                <div class="mo-field">
                    <label class="mo-lbl">Bio <span class="mo-opt">Optional</span></label>
                    <textarea name="bio" class="mo-ta" placeholder="Brief description about this team member…"></textarea>
                </div>

            </div>
            <div class="mo-foot">
                <button type="button" class="mo-btn-cancel" onclick="closeAddModal()">Cancel</button>
                <button type="submit" class="mo-btn-save">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 7l4 4 6-6"/></svg>
                    Save Member
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ══════════════════════════════════════════
     EDIT MEMBER MODAL
══════════════════════════════════════════ --}}
<div class="mo-overlay" id="editOverlay" onclick="if(event.target===this)closeEditModal()">
    <div class="mo-box">
        <div class="mo-head">
            <div class="mo-head-l">
                <div class="mo-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M13.5 2.5l4 4L6 18H2v-4L13.5 2.5z"/>
                    </svg>
                </div>
                <div class="mo-title">Edit Team Member</div>
            </div>
            <button type="button" class="mo-close" onclick="closeEditModal()">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
            </button>
        </div>

        <form id="editForm" method="POST" enctype="multipart/form-data" style="display:contents;">
            @csrf @method('PUT')
            <div class="mo-body">

                {{-- Photo --}}
                <div class="mo-field">
                    <label class="mo-lbl">Photo <span class="mo-opt">Optional</span></label>
                    <div class="mo-file-wrap">
                        <div class="mo-file-preview" id="editPhotoPreview">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="10" cy="7" r="4"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                            <img id="editPhotoImg" src="" alt="">
                        </div>
                        <input type="file" name="photo" class="mo-file-inp" accept="image/*"
                               onchange="previewPhoto(this,'editPhotoPreview','editPhotoImg')">
                    </div>
                </div>

                {{-- Name + Role --}}
                <div class="mo-fg">
                    <div>
                        <label class="mo-lbl">Full Name <span class="mo-req">Required</span></label>
                        <div class="mo-iw">
                            <svg class="mo-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="7" r="4"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                            <input type="text" name="name" id="edit_name" class="mo-inp" required>
                        </div>
                    </div>
                    <div>
                        <label class="mo-lbl">Role <span class="mo-req">Required</span></label>
                        <div class="mo-iw">
                            <svg class="mo-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="4" width="14" height="13" rx="2"/><path d="M7 4V2h6v2M8 9h4M8 12h2"/></svg>
                            <input type="text" name="role" id="edit_role" class="mo-inp" required>
                        </div>
                    </div>
                </div>

                {{-- Email + Phone --}}
                <div class="mo-fg">
                    <div>
                        <label class="mo-lbl">Email <span class="mo-opt">Optional</span></label>
                        <div class="mo-iw">
                            <svg class="mo-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="4" width="16" height="12" rx="2"/><path d="M2 7l8 5 8-5"/></svg>
                            <input type="email" name="email" id="edit_email" class="mo-inp">
                        </div>
                    </div>
                    <div>
                        <label class="mo-lbl">Phone <span class="mo-opt">Optional</span></label>
                        <div class="mo-iw">
                            <svg class="mo-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M3 5a2 2 0 012-2h1l2 4-1.5 1.5a11 11 0 004 4L12 11l4 2v1a2 2 0 01-2 2C7.5 16 4 12.5 4 7a2 2 0 011-1.7V5z"/></svg>
                            <input type="text" name="phone" id="edit_phone" class="mo-inp">
                        </div>
                    </div>
                </div>

                {{-- Bio --}}
                <div class="mo-field">
                    <label class="mo-lbl">Bio <span class="mo-opt">Optional</span></label>
                    <textarea name="bio" id="edit_bio" class="mo-ta"></textarea>
                </div>

            </div>
            <div class="mo-foot">
                <button type="button" class="mo-btn-cancel" onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="mo-btn-save">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 7l4 4 6-6"/></svg>
                    Update Member
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ══════════════════════════════════════════
     DELETE CONFIRM MODAL
══════════════════════════════════════════ --}}
<div class="mo-overlay" id="deleteOverlay" onclick="if(event.target===this)closeDeleteModal()">
    <div class="mo-box mo-sm">
        <div class="mo-head">
            <div class="mo-head-l">
                <div class="mo-icon danger">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M3 5.5h14M7 5.5V3.5h6v2M4.5 5.5l.75 11h9.5l.75-11H4.5z"/>
                    </svg>
                </div>
                <div class="mo-title">Remove Member</div>
            </div>
            <button type="button" class="mo-close" onclick="closeDeleteModal()">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
            </button>
        </div>
        <div class="mo-body">
            <div class="mo-confirm-box">
                <div class="mo-confirm-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                </div>
                <div class="mo-confirm-text">
                    <h4>Remove Team Member?</h4>
                    <p>You're about to remove <span class="mo-confirm-name" id="delete_name">"Member"</span> from your team. This cannot be undone.</p>
                </div>
            </div>
        </div>
        <div class="mo-foot">
            <button type="button" class="mo-btn-cancel" onclick="closeDeleteModal()">Keep Member</button>
            <form id="deleteForm" method="POST" style="display:contents;">
                @csrf @method('DELETE')
                <button type="submit" class="mo-btn-danger">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 3.5h10M5 3.5V2h4v1.5M5.5 6v5M8.5 6v5M3 3.5l.7 8.5h6.6L11 3.5H3z"/>
                    </svg>
                    Yes, Remove
                </button>
            </form>
        </div>
    </div>
</div>

<script>
/* ═══ ADD MODAL ═══ */
function openAddModal() {
    document.getElementById('addOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
    setTimeout(function(){ document.getElementById('add_name').focus(); }, 80);
}
function closeAddModal() {
    document.getElementById('addOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

/* ═══ EDIT MODAL ═══ */
function openEditModal(data) {
    document.getElementById('editForm').action = data.editUrl;
    document.getElementById('edit_name').value  = data.name  || '';
    document.getElementById('edit_role').value  = data.role  || '';
    document.getElementById('edit_email').value = data.email || '';
    document.getElementById('edit_phone').value = data.phone || '';
    document.getElementById('edit_bio').value   = data.bio   || '';

    /* Show existing photo in preview */
    var preview = document.getElementById('editPhotoPreview');
    var img     = document.getElementById('editPhotoImg');
    if(data.photo) {
        img.src = data.photo;
        preview.classList.add('has-img');
    } else {
        img.src = '';
        preview.classList.remove('has-img');
    }

    document.getElementById('editOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
    setTimeout(function(){ document.getElementById('edit_name').focus(); }, 80);
}
function closeEditModal() {
    document.getElementById('editOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

/* ═══ DELETE MODAL ═══ */
function openDeleteModal(id, name, url) {
    document.getElementById('delete_name').textContent = '"' + name + '"';
    document.getElementById('deleteForm').action = url;
    document.getElementById('deleteOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeDeleteModal() {
    document.getElementById('deleteOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

/* ═══ PHOTO PREVIEW ═══ */
function previewPhoto(input, wrapId, imgId) {
    if(!input.files || !input.files[0]) return;
    var reader = new FileReader();
    reader.onload = function(e) {
        var img  = document.getElementById(imgId);
        var wrap = document.getElementById(wrapId);
        img.src  = e.target.result;
        wrap.classList.add('has-img');
    };
    reader.readAsDataURL(input.files[0]);
}

/* ═══ ESC KEY ═══ */
document.addEventListener('keydown', function(e) {
    if(e.key !== 'Escape') return;
    closeAddModal();
    closeEditModal();
    closeDeleteModal();
});
</script>

</x-supplier-layout>