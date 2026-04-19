<x-supplier-layout>
<style>
    .bv-page-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;}
    .bv-page-title{font-family:var(--font-display);font-size:1.75rem;font-weight:700;color:var(--charcoal);line-height:1.1;}
    .bv-page-title em{font-style:italic;color:var(--gold-dark);}
    .bv-page-sub{font-size:0.8rem;color:var(--warm-grey);margin-top:0.3rem;}

    /* ── Buttons ── */
    .bv-btn-primary{display:inline-flex;align-items:center;gap:0.45rem;padding:0.6rem 1.3rem;border-radius:6px;border:none;background:var(--charcoal);font-family:var(--font-body);font-size:0.8rem;font-weight:500;color:var(--white);cursor:pointer;text-decoration:none;transition:background 0.2s,box-shadow 0.2s,transform 0.15s;}
    .bv-btn-primary svg{width:13px;height:13px;}
    .bv-btn-primary:hover{background:var(--gold-dark);box-shadow:0 4px 12px rgba(201,168,76,0.2);transform:translateY(-1px);}
    .bv-btn-edit{display:inline-flex;align-items:center;gap:0.35rem;padding:0.32rem 0.75rem;border-radius:6px;border:1.5px solid #E5DDD5;background:var(--white);font-family:var(--font-body);font-size:0.72rem;font-weight:500;color:var(--warm-grey);text-decoration:none;transition:border-color 0.2s,color 0.2s,background 0.2s;}
    .bv-btn-edit svg{width:10px;height:10px;}
    .bv-btn-edit:hover{border-color:var(--gold);color:var(--gold-dark);background:rgba(201,168,76,0.05);}
    .bv-btn-del{display:inline-flex;align-items:center;gap:0.35rem;padding:0.32rem 0.75rem;border-radius:6px;border:1.5px solid #FADBD8;background:transparent;font-family:var(--font-body);font-size:0.72rem;font-weight:500;color:#C0392B;cursor:pointer;transition:background 0.15s,border-color 0.15s;}
    .bv-btn-del svg{width:10px;height:10px;}
    .bv-btn-del:hover{background:#FFF5F5;border-color:#C0392B;}

    /* ── Alert ── */
    .bv-alert-success{display:flex;align-items:center;gap:0.65rem;background:#F0FDF4;border:1px solid #A7F3D0;border-radius:8px;padding:0.75rem 1rem;font-size:0.82rem;color:#065F46;margin-bottom:1.5rem;}
    .bv-alert-success svg{width:16px;height:16px;color:#10B981;flex-shrink:0;}

    /* ══ ROLES GRID ══ */
    .rl-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1rem;}

    /* Role card */
    .rl-card{
        background:var(--white);border-radius:12px;
        border:1px solid #F0EBE5;
        box-shadow:0 1px 4px rgba(30,27,24,0.05);
        overflow:hidden;
        transition:box-shadow 0.2s,border-color 0.2s,transform 0.15s;
    }
    .rl-card:hover{box-shadow:0 4px 14px rgba(30,27,24,0.09);border-color:rgba(201,168,76,0.3);transform:translateY(-2px);}

    .rl-card-top{
        padding:1.1rem 1.2rem 0.85rem;
        border-bottom:1px solid #F7F3EF;
    }
    .rl-card-icon-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:0.75rem;}
    .rl-card-icon{
        width:36px;height:36px;border-radius:9px;
        background:rgba(201,168,76,0.1);
        display:flex;align-items:center;justify-content:center;
        color:var(--gold-dark);flex-shrink:0;
    }
    .rl-card-icon svg{width:16px;height:16px;}
    .rl-card-badge{
        display:inline-flex;align-items:center;gap:0.25rem;
        padding:0.15rem 0.55rem;border-radius:999px;
        background:rgba(201,168,76,0.1);color:var(--gold-dark);
        font-size:0.62rem;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;
    }
    .rl-card-badge::before{content:'';width:4px;height:4px;border-radius:50%;background:var(--gold);}
    .rl-card-name{font-family:var(--font-display);font-size:0.95rem;font-weight:700;color:var(--charcoal);margin-bottom:0.35rem;line-height:1.25;}
    .rl-card-desc{font-size:0.78rem;color:var(--warm-grey);line-height:1.55;}
    .rl-card-desc.nil{color:#C0B8B0;font-style:italic;}

    .rl-card-foot{
        display:flex;align-items:center;justify-content:flex-end;
        gap:0.45rem;padding:0.65rem 1.2rem;
    }

    /* Empty state */
    .rl-empty{
        grid-column:1/-1;text-align:center;
        padding:3.5rem 1.5rem;
        border:1.5px dashed #E5DDD5;border-radius:12px;
        background:rgba(201,168,76,0.02);
    }
    .rl-empty-icon{width:52px;height:52px;border-radius:50%;background:rgba(201,168,76,0.08);display:flex;align-items:center;justify-content:center;margin:0 auto 0.85rem;color:var(--gold-dark);}
    .rl-empty-icon svg{width:24px;height:24px;}
    .rl-empty-title{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--charcoal);margin-bottom:0.35rem;}
    .rl-empty-desc{font-size:0.8rem;color:var(--warm-grey);line-height:1.6;}

    /* ══ MODAL ══ */
    .rl-modal-overlay{
        position:fixed;inset:0;z-index:8000;
        background:rgba(30,27,24,0.55);
        display:none;align-items:center;justify-content:center;
        padding:1rem;
    }
    .rl-modal-overlay.open{display:flex;}
    .rl-modal{
        background:var(--white);border-radius:14px;
        border:1px solid #F0EBE5;
        box-shadow:0 8px 40px rgba(30,27,24,0.18);
        width:100%;max-width:480px;
        overflow:hidden;
        animation:rlSlideIn 0.22s ease;
    }
    @keyframes rlSlideIn{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}

    .rl-modal-head{display:flex;align-items:center;justify-content:space-between;padding:1.1rem 1.4rem;border-bottom:1px solid #F7F3EF;}
    .rl-modal-head-l{display:flex;align-items:center;gap:0.65rem;}
    .rl-modal-icon{width:32px;height:32px;border-radius:8px;background:rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
    .rl-modal-icon svg{width:15px;height:15px;}
    .rl-modal-title{font-family:var(--font-display);font-size:0.95rem;font-weight:700;color:var(--charcoal);}
    .rl-modal-close{width:30px;height:30px;border-radius:50%;border:1.5px solid #E5DDD5;background:var(--white);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--warm-grey);transition:border-color 0.15s,color 0.15s,background 0.15s;}
    .rl-modal-close:hover{border-color:var(--gold);color:var(--gold-dark);background:rgba(201,168,76,0.05);}
    .rl-modal-close svg{width:12px;height:12px;}

    .rl-modal-body{padding:1.35rem 1.4rem;display:flex;flex-direction:column;gap:0.9rem;}
    .rl-modal-foot{padding:0.85rem 1.4rem;border-top:1px solid #F7F3EF;display:flex;align-items:center;justify-content:flex-end;gap:0.55rem;}

    /* Modal fields */
    .rl-lbl{display:flex;align-items:center;justify-content:space-between;font-size:0.68rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:var(--warm-grey);margin-bottom:0.38rem;}
    .rl-req{font-size:0.58rem;color:#C0392B;font-weight:500;text-transform:none;letter-spacing:0;}
    .rl-opt{font-size:0.58rem;color:#C0B8B0;font-weight:400;text-transform:none;letter-spacing:0;}
    .rl-inp,.rl-ta{width:100%;padding:0.68rem 0.9rem;background:var(--ivory);border:1.5px solid #E5DDD5;border-radius:8px;font-family:var(--font-body);font-size:0.84rem;color:var(--charcoal);outline:none;transition:border-color 0.2s,box-shadow 0.2s,background 0.2s;appearance:none;display:block;}
    .rl-inp:focus,.rl-ta:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,0.12);background:var(--white);}
    .rl-inp::placeholder,.rl-ta::placeholder{color:#C0B8B0;}
    .rl-ta{resize:vertical;min-height:90px;}
    .rl-iw{position:relative;}
    .rl-ico{position:absolute;left:0.8rem;top:50%;transform:translateY(-50%);width:14px;height:14px;color:#C0B8B0;pointer-events:none;}
    .rl-iw:focus-within .rl-ico{color:var(--gold-dark);}
    .rl-iw .rl-inp{padding-left:2.35rem;}

    .rl-btn-save{display:inline-flex;align-items:center;gap:0.45rem;padding:0.62rem 1.5rem;border-radius:6px;border:none;background:var(--charcoal);font-family:var(--font-body);font-size:0.82rem;font-weight:500;color:var(--white);cursor:pointer;transition:background 0.2s,box-shadow 0.2s,transform 0.15s;}
    .rl-btn-save svg{width:13px;height:13px;}
    .rl-btn-save:hover{background:var(--gold-dark);box-shadow:0 4px 12px rgba(201,168,76,0.2);transform:translateY(-1px);}
    .rl-btn-cancel{display:inline-flex;align-items:center;gap:0.4rem;padding:0.62rem 1.1rem;border-radius:6px;border:1.5px solid #E5DDD5;background:var(--white);font-family:var(--font-body);font-size:0.82rem;font-weight:500;color:var(--warm-grey);cursor:pointer;transition:border-color 0.2s,color 0.2s;}
    .rl-btn-cancel:hover{border-color:var(--gold);color:var(--charcoal);}
</style>

{{-- Success alert --}}
@if(session('success'))
<div class="bv-alert-success">
    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
    {{ session('success') }}
</div>
@endif

<div class="page-content">

    {{-- ── Page header ── --}}
    <div class="bv-page-header">
        <div>
            <h1 class="bv-page-title">My <em>Roles</em></h1>
            <p class="bv-page-sub">Manage the roles available for your supplier profile</p>
        </div>
        <button type="button" class="bv-btn-primary" onclick="rlModalOpen()">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 2v10M2 7h10"/></svg>
            Add Role
        </button>
    </div>

    {{-- ── Roles grid ── --}}
    <div class="rl-grid">

        @forelse($roles as $role)
        <div class="rl-card">
            <div class="rl-card-top">
                <div class="rl-card-icon-row">
                    <div class="rl-card-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="3" y="3" width="14" height="14" rx="3"/>
                            <path d="M7 10h6M7 7h4M7 13h3"/>
                        </svg>
                    </div>
                    <span class="rl-card-badge">Role</span>
                </div>
                <div class="rl-card-name">{{ $role->name }}</div>
                <div class="rl-card-desc {{ !$role->description ? 'nil' : '' }}">
                    {{ $role->description ?? 'No description added.' }}
                </div>
            </div>
            <div class="rl-card-foot">
                <a href="{{ route('roles.edit', $role->id) }}" class="bv-btn-edit">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2l2 2-7 7H3v-2L10 2z"/></svg>
                    Edit
                </a>
                <form method="POST"
                      action="{{ route('roles.destroy', $role->id) }}"
                      onsubmit="return confirm('Delete the role \'{{ addslashes($role->name) }}\'?')"
                      style="margin:0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bv-btn-del">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 3.5h10M5 3.5V2.5h4v1M4.5 3.5v7a1 1 0 001 1h3a1 1 0 001-1v-7"/></svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="rl-empty">
            <div class="rl-empty-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="3" width="14" height="14" rx="3"/>
                    <path d="M7 10h6M7 7h4M7 13h3"/>
                </svg>
            </div>
            <div class="rl-empty-title">No Roles Yet</div>
            <div class="rl-empty-desc">Click <strong>Add Role</strong> to create your first role.</div>
        </div>
        @endforelse

    </div>

</div>{{-- /page-content --}}

{{-- ══ ADD ROLE MODAL ══ --}}
<div class="rl-modal-overlay" id="rlModalOverlay" onclick="if(event.target===this)rlModalClose()">
    <div class="rl-modal">

        <div class="rl-modal-head">
            <div class="rl-modal-head-l">
                <div class="rl-modal-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="3" y="3" width="14" height="14" rx="3"/>
                        <path d="M7 10h6M7 7h4M7 13h3"/>
                    </svg>
                </div>
                <div class="rl-modal-title">Add Role</div>
            </div>
            <button type="button" class="rl-modal-close" onclick="rlModalClose()">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
            </button>
        </div>

        <form method="POST" action="{{ route('roles.store') }}">
            @csrf
            <div class="rl-modal-body">

                {{-- Role Name --}}
                <div>
                    <label class="rl-lbl" for="rl_name">
                        Role Name <span class="rl-req">Required</span>
                    </label>
                    <div class="rl-iw">
                        <svg class="rl-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="3" y="3" width="14" height="14" rx="3"/>
                            <path d="M7 10h6M7 7h4"/>
                        </svg>
                        <input id="rl_name"
                               type="text"
                               name="name"
                               class="rl-inp"
                               placeholder="e.g. Lead Photographer"
                               required
                               value="{{ old('name') }}">
                    </div>
                    @error('name')<div style="font-size:0.68rem;color:#C0392B;margin-top:0.28rem;">{{ $message }}</div>@enderror
                </div>

                {{-- Description --}}
                <div>
                    <label class="rl-lbl" for="rl_desc">
                        Description <span class="rl-opt">Optional</span>
                    </label>
                    <textarea id="rl_desc"
                              name="description"
                              class="rl-ta"
                              placeholder="Briefly describe what this role does...">{{ old('description') }}</textarea>
                    @error('description')<div style="font-size:0.68rem;color:#C0392B;margin-top:0.28rem;">{{ $message }}</div>@enderror
                </div>

            </div>

            <div class="rl-modal-foot">
                <button type="button" class="rl-btn-cancel" onclick="rlModalClose()">Cancel</button>
                <button type="submit" class="rl-btn-save">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg>
                    Save Role
                </button>
            </div>
        </form>

    </div>
</div>

<script>
function rlModalOpen() {
    document.getElementById('rlModalOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
    /* Auto-focus the name input */
    setTimeout(function(){ document.getElementById('rl_name').focus(); }, 80);
}

function rlModalClose() {
    document.getElementById('rlModalOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

/* Close on Escape */
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') rlModalClose();
});

/* Re-open modal automatically if validation errors exist (e.g. after failed POST) */
@if($errors->any())
    rlModalOpen();
@endif

/* Auto-close after successful save via session flash */
@if(session('success'))
    rlModalClose();
@endif
</script>

</x-supplier-layout>