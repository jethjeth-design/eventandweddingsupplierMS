<x-supplier-layout>
<style>
    .bv-page-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;}
    .bv-page-title{font-family:var(--font-display);font-size:1.75rem;font-weight:700;color:var(--charcoal);line-height:1.1;}
    .bv-page-title em{font-style:italic;color:var(--gold-dark);}
    .bv-page-sub{font-size:0.8rem;color:var(--warm-grey);margin-top:0.3rem;}

    .bv-btn-back{
        display:inline-flex;align-items:center;gap:0.4rem;
        padding:0.58rem 1.1rem;border-radius:6px;
        border:1.5px solid #E5DDD5;background:var(--white);
        font-family:var(--font-body);font-size:0.8rem;font-weight:500;
        color:var(--warm-grey);text-decoration:none;
        transition:border-color 0.2s,color 0.2s;
    }
    .bv-btn-back svg{width:12px;height:12px;}
    .bv-btn-back:hover{border-color:var(--gold);color:var(--charcoal);}

    /* ── Two-column layout ── */
    .bv-as-layout{display:grid;grid-template-columns:220px 1fr;gap:1.5rem;align-items:start;}
    @media(max-width:820px){.bv-as-layout{grid-template-columns:1fr;}}

    /* ── LEFT: sticky nav ── */
    .bv-as-nav{
        background:var(--white);border-radius:12px;
        border:1px solid #F0EBE5;
        box-shadow:0 1px 4px rgba(30,27,24,0.05);
        overflow:hidden;position:sticky;top:1.5rem;
    }
    .bv-as-nav-head{
        padding:0.9rem 1.1rem 0.7rem;
        border-bottom:1px solid #F7F3EF;
    }
    .bv-as-nav-label{
        font-size:0.63rem;font-weight:700;letter-spacing:0.1em;
        text-transform:uppercase;color:#C0B8B0;
    }
    .bv-as-nav-list{padding:0.45rem;}
    .bv-as-nav-link{
        display:flex;align-items:center;gap:0.55rem;
        padding:0.62rem 0.75rem;border-radius:8px;
        font-family:var(--font-body);font-size:0.8rem;font-weight:400;
        color:var(--warm-grey);text-decoration:none;
        transition:background 0.15s,color 0.15s;
        cursor:pointer;border:none;background:none;width:100%;
    }
    .bv-as-nav-link svg{width:13px;height:13px;flex-shrink:0;}
    .bv-as-nav-link:hover{background:rgba(201,168,76,0.07);color:var(--charcoal);}
    .bv-as-nav-link.active{background:rgba(201,168,76,0.1);color:var(--gold-dark);font-weight:600;position:relative;}
    .bv-as-nav-link.active::before{content:'';position:absolute;left:0;top:20%;bottom:20%;width:3px;background:var(--gold);border-radius:0 2px 2px 0;}
    .bv-as-nav-sep{height:1px;background:#F7F3EF;margin:0.3rem 0.45rem;}
    .bv-as-nav-link.red{color:#C0392B;}
    .bv-as-nav-link.red:hover{background:#FFF5F5;color:#C0392B;}
    .bv-as-nav-link.red.active{background:#FFF5F5;color:#C0392B;}
    .bv-as-nav-link.red.active::before{background:#C0392B;}

    /* ── RIGHT: panels ── */
    .bv-as-panels{display:flex;flex-direction:column;gap:1.25rem;}

    .bv-panel{
        background:var(--white);border-radius:12px;
        border:1px solid #F0EBE5;overflow:hidden;
        box-shadow:0 1px 4px rgba(30,27,24,0.04);
    }
    .bv-panel-head{
        display:flex;align-items:center;gap:0.7rem;
        padding:1.1rem 1.5rem;border-bottom:1px solid #F7F3EF;
    }
    .bv-panel-icon{
        width:34px;height:34px;border-radius:8px;
        background:rgba(201,168,76,0.1);
        display:flex;align-items:center;justify-content:center;
        color:var(--gold-dark);flex-shrink:0;
    }
    .bv-panel-icon svg{width:16px;height:16px;}
    .bv-panel-icon.red{background:#FFF5F5;color:#C0392B;}
    .bv-panel-title{font-family:var(--font-display);font-size:0.92rem;font-weight:700;color:var(--charcoal);}
    .bv-panel-desc{font-size:0.7rem;color:var(--warm-grey);margin-top:0.07rem;}

    /* Override Breeze section headers — hide them, we have our own panel headers */
    .bv-panel section > header h2,
    .bv-panel section > header p { display:none !important; }

    /* Style Breeze form containers */
    .bv-panel section { padding: 0 !important; }
    .bv-panel form { padding: 1.4rem 1.5rem !important; }
    .bv-panel .max-w-xl { max-width: none !important; }

    /* ── Breeze input overrides ── */
    .bv-panel input[type="text"],
    .bv-panel input[type="email"],
    .bv-panel input[type="password"] {
        background: var(--ivory) !important;
        border: 1.5px solid #E5DDD5 !important;
        border-radius: 8px !important;
        font-family: var(--font-body) !important;
        font-size: 0.84rem !important;
        color: var(--charcoal) !important;
        box-shadow: none !important;
        outline: none !important;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s !important;
    }
    .bv-panel input:focus {
        border-color: var(--gold) !important;
        background: var(--white) !important;
        box-shadow: 0 0 0 3px rgba(201,168,76,0.12) !important;
    }
    .bv-panel input::placeholder { color: #C0B8B0 !important; }
    .bv-panel label {
        font-size: 0.7rem !important;
        font-weight: 600 !important;
        letter-spacing: 0.07em !important;
        text-transform: uppercase !important;
        color: var(--warm-grey) !important;
    }

    /* Breeze primary button */
    .bv-panel .mt-4 > button[type="submit"],
    .bv-panel button[type="submit"].inline-flex:not([class*="red"]):not([class*="danger"]) {
        background: var(--charcoal) !important;
        border: none !important;
        border-radius: 6px !important;
        font-family: var(--font-body) !important;
        font-size: 0.82rem !important;
        font-weight: 500 !important;
        color: var(--white) !important;
        padding: 0.62rem 1.4rem !important;
        transition: background 0.2s, box-shadow 0.2s !important;
        box-shadow: none !important;
        cursor: pointer !important;
    }
    .bv-panel .mt-4 > button[type="submit"]:hover,
    .bv-panel button[type="submit"].inline-flex:not([class*="red"]):not([class*="danger"]):hover {
        background: var(--gold-dark) !important;
        box-shadow: 0 4px 12px rgba(201,168,76,0.2) !important;
    }

    /* ── Alert ── */
    .bv-alert{display:flex;align-items:center;gap:0.6rem;padding:0.7rem 1rem;border-radius:8px;font-size:0.8rem;margin-bottom:1.1rem;}
    .bv-alert svg{width:14px;height:14px;flex-shrink:0;}
    .bv-alert-ok{background:#F0FDF4;border:1px solid #A7F3D0;color:#065F46;}
    .bv-alert-ok svg{color:#10B981;}
</style>

<div class="page-content">

    <div class="bv-page-header">
        <div>
            <h1 class="bv-page-title">Account <em>Settings</em></h1>
            <p class="bv-page-sub">Manage your login credentials and account security</p>
        </div>
        <a href="{{ route('supplier.personal.show') }}" class="bv-btn-back">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 2L4 7l5 5"/></svg>
            Back to Profile
        </a>
    </div>

    @if(session('status') === 'profile-updated')
    <div class="bv-alert bv-alert-ok">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
        Account information updated successfully.
    </div>
    @endif
    @if(session('status') === 'password-updated')
    <div class="bv-alert bv-alert-ok">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
        Password updated successfully.
    </div>
    @endif

    <div class="bv-as-layout">

        {{-- LEFT: Nav --}}
        <div>
            <div class="bv-as-nav">
                <div class="bv-as-nav-head">
                    <div class="bv-as-nav-label">Settings</div>
                </div>
                <div class="bv-as-nav-list">
                    <a href="#panel-info" class="bv-as-nav-link active" onclick="bvNavClick(this,'panel-info');return false;">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="5" r="3"/><path d="M1 13c0-3 2.7-5 6-5s6 2 6 5"/></svg>
                        Profile Information
                    </a>
                    <a href="#panel-password" class="bv-as-nav-link" onclick="bvNavClick(this,'panel-password');return false;">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="6" width="10" height="7" rx="2"/><path d="M4 6V4a3 3 0 016 0v2"/><circle cx="7" cy="10" r="1"/></svg>
                        Update Password
                    </a>
                    <div class="bv-as-nav-sep"></div>
                    <a href="#panel-delete" class="bv-as-nav-link red" onclick="bvNavClick(this,'panel-delete');return false;">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 3.5h10M5 3.5V2.5h4v1M4.5 3.5v7a1 1 0 001 1h3a1 1 0 001-1v-7"/></svg>
                        Delete Account
                    </a>
                </div>
            </div>
        </div>

        {{-- RIGHT: Panels --}}
        <div class="bv-as-panels">

            {{-- Panel 1: Profile Information --}}
            <div class="bv-panel" id="panel-info">
                <div class="bv-panel-head">
                    <div class="bv-panel-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="7" r="4"/><path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                    </div>
                    <div>
                        <div class="bv-panel-title">Profile Information</div>
                        <div class="bv-panel-desc">Update your account name and email address</div>
                    </div>
                </div>
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Panel 2: Update Password --}}
            <div class="bv-panel" id="panel-password">
                <div class="bv-panel-head">
                    <div class="bv-panel-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="5" y="9" width="10" height="9" rx="2"/><path d="M7 9V6a3 3 0 016 0v3"/><circle cx="10" cy="14" r="1"/></svg>
                    </div>
                    <div>
                        <div class="bv-panel-title">Update Password</div>
                        <div class="bv-panel-desc">Use a strong, unique password to keep your account secure</div>
                    </div>
                </div>
                @include('profile.partials.update-password-form')
            </div>

            {{-- Panel 3: Delete Account --}}
            <div class="bv-panel" id="panel-delete">
                <div class="bv-panel-head">
                    <div class="bv-panel-icon red">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M10 3l8 14H2L10 3zM10 9v4M10 15v.5"/></svg>
                    </div>
                    <div>
                        <div class="bv-panel-title">Delete Account</div>
                        <div class="bv-panel-desc">Permanently remove your account and all associated data</div>
                    </div>
                </div>
                @include('profile.partials.delete-user-form')
            </div>

        </div>{{-- end panels --}}
    </div>{{-- end layout --}}
</div>

<script>
    function bvNavClick(el, targetId) {
        /* update active nav item */
        document.querySelectorAll('.bv-as-nav-link').forEach(l => l.classList.remove('active'));
        el.classList.add('active');
        /* smooth scroll with offset */
        const target = document.getElementById(targetId);
        if (target) {
            const top = target.getBoundingClientRect().top + window.scrollY - 88;
            window.scrollTo({ top, behavior: 'smooth' });
        }
    }

    /* passive scroll spy */
    window.addEventListener('scroll', function() {
        const panels = ['panel-info', 'panel-password', 'panel-delete'];
        const links  = document.querySelectorAll('.bv-as-nav-link');
        let active = 'panel-info';
        panels.forEach(id => {
            const el = document.getElementById(id);
            if (el && el.getBoundingClientRect().top <= 110) active = id;
        });
        links.forEach(l => {
            const href = l.getAttribute('href')?.replace('#','');
            l.classList.toggle('active', href === active);
        });
    }, { passive: true });
</script>

</x-supplier-layout>