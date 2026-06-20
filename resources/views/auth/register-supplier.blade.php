{{-- resources/views/auth/register-supplier.blade.php --}}
<x-guest-layout>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap');

    :root {
        --gold:       #C9A84C;
        --gold-light: #E8C97A;
        --gold-dark:  #8A6A1F;
        --ivory:      #FAF7F2;
        --charcoal:   #1E1B18;
        --warm-grey:  #706B65;
        --border:     #E5DDD5;
        --border-md:  #E0D8D0;
        --white:      #FFFFFF;
        --font-display:'Playfair Display', Georgia, serif;
        --font-body:  'DM Sans', sans-serif;
    }

    /* ── SCROLLABLE WRAPPER ── */
    .reg-scroll-outer {
        max-height: 76vh;
        overflow-y: auto;
        overflow-x: hidden;
        padding-right: 0.35rem;
        scroll-behavior: smooth;
    }
    .reg-scroll-outer::-webkit-scrollbar { width: 4px; }
    .reg-scroll-outer::-webkit-scrollbar-track { background: transparent; }
    .reg-scroll-outer::-webkit-scrollbar-thumb { background: var(--border); border-radius: 99px; }
    .reg-scroll-outer::-webkit-scrollbar-thumb:hover { background: rgba(201,168,76,0.4); }

    /* ── STEP PROGRESS ── */
    .bv-steps {
        display: flex;
        align-items: center;
        margin-bottom: 1.8rem;
        gap: 0;
    }
    .bv-step-item { display:flex; align-items:center; gap:0.45rem; flex:1; min-width:0; }
    .bv-step-item:last-child { flex:none; }

    .bv-step-circle {
        width: 28px; height: 28px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display); font-size: 0.74rem; font-weight: 700;
        border: 2px solid var(--border); background: var(--white); color: #C0B8B0;
        flex-shrink: 0; transition: all 0.3s; line-height: 1;
    }
    .bv-step-circle.active { border-color:var(--gold); background:var(--gold); color:var(--white); }
    .bv-step-circle.done   { border-color:var(--gold-dark); background:var(--gold-dark); color:var(--white); }

    .bv-step-label {
        font-size: 0.66rem; font-weight: 500; letter-spacing: 0.03em;
        color: #C0B8B0; font-family: var(--font-body); white-space: nowrap;
        overflow: hidden; text-overflow: ellipsis;
    }
    .bv-step-label.active { color: var(--gold-dark); }

    .bv-step-connector { flex:1; height:1px; background:var(--border); margin:0 0.3rem; min-width:12px; }
    .bv-step-connector.done { background:var(--gold-dark); }

    /* ── HEADING ── */
    .reg-heading { margin-bottom:1.5rem; }
    .reg-heading h2 {
        font-family:var(--font-display); font-size:1.75rem; font-weight:700;
        color:var(--charcoal); line-height:1.2; margin-bottom:0.3rem;
    }
    .reg-heading h2 em { font-style:italic; color:var(--gold-dark); }
    .reg-heading p { font-size:0.83rem; color:var(--warm-grey); font-family:var(--font-body); line-height:1.5; }

    /* ── STEP PANELS ── */
    .bv-step-panel { display:none; }
    .bv-step-panel.active { display:block; animation:bvIn 0.28s ease; }
    @keyframes bvIn { from{opacity:0;transform:translateX(10px);}to{opacity:1;transform:translateX(0);} }

    /* ── SECTION LABEL ── */
    .bv-section-label {
        font-size:0.62rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase;
        color:#C0B8B0; padding-bottom:0.65rem; border-bottom:1px solid #F0EBE5;
        margin-bottom:1.1rem; display:flex; align-items:center; gap:0.45rem;
    }
    .bv-section-label svg { width:11px; height:11px; color:var(--gold-dark); }

    /* ── FIELDS ── */
    .bv-field { margin-bottom:1rem; }
    .bv-field:last-child { margin-bottom:0; }
    .bv-field-row { display:grid; grid-template-columns:1fr 1fr; gap:0.85rem; }
    @media(max-width:480px) { .bv-field-row { grid-template-columns:1fr; } }

    .bv-label {
        display:flex; align-items:center; justify-content:space-between;
        font-family:var(--font-body); font-size:0.68rem; font-weight:600;
        letter-spacing:0.08em; text-transform:uppercase; color:var(--warm-grey); margin-bottom:0.4rem;
    }
    .bv-label-req { font-size:0.58rem; color:#C0392B; font-weight:500; text-transform:none; letter-spacing:0; }
    .bv-label-opt { font-size:0.58rem; color:#C0B8B0; font-weight:400; text-transform:none; letter-spacing:0; }

    .bv-input-wrap { position:relative; }
    .bv-input-icon {
        position:absolute; left:0.8rem; top:50%; transform:translateY(-50%);
        width:14px; height:14px; color:#C0B8B0; pointer-events:none; transition:color 0.2s;
    }
    .bv-input-wrap:focus-within .bv-input-icon { color:var(--gold-dark); }

    .bv-input {
        width:100%; padding:0.72rem 0.92rem 0.72rem 2.5rem;
        border:1.5px solid var(--border); border-radius:8px;
        font-family:var(--font-body); font-size:0.84rem; color:var(--charcoal);
        background:var(--ivory); outline:none; display:block;
        transition:border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }
    .bv-input:focus {
        border-color:var(--gold); background:var(--white);
        box-shadow:0 0 0 3px rgba(201,168,76,0.12);
    }
    .bv-input::placeholder { color:#C0B8B0; }

    .pw-eye {
        position:absolute; right:0.75rem; top:50%; transform:translateY(-50%);
        background:none; border:none; cursor:pointer; color:#C0B8B0;
        display:flex; align-items:center; padding:2px; transition:color 0.18s;
    }
    .pw-eye:hover { color:var(--gold-dark); }

    .bv-error { font-size:0.68rem; color:#C0392B; margin-top:0.28rem; }
    .bv-hint  { font-size:0.68rem; color:#C0B8B0; margin-top:0.28rem; }

    /* ── PASSWORD STRENGTH ── */
    .pw-strength-wrap { margin-top:0.55rem; }
    .pw-bars { display:grid; grid-template-columns:repeat(4,1fr); gap:3px; margin-bottom:0.35rem; }
    .pw-bar { height:4px; border-radius:99px; background:#E5DDD5; transition:background 0.25s; }
    .pw-bar.fill-weak    { background:#E74C3C; }
    .pw-bar.fill-fair    { background:#F39C12; }
    .pw-bar.fill-good    { background:#F1C40F; }
    .pw-bar.fill-strong  { background:#27AE60; }
    .pw-bar.fill-vstrong { background:#16A085; }
    .pw-feedback { font-size:0.65rem; font-family:var(--font-body); }
    .pw-label-text { font-weight:600; color:#C0B8B0; transition:color 0.2s; }
    .pw-label-text.weak    { color:#E74C3C; }
    .pw-label-text.fair    { color:#E67E22; }
    .pw-label-text.good    { color:#D4AC0D; }
    .pw-label-text.strong  { color:#27AE60; }
    .pw-label-text.vstrong { color:#16A085; }
    .pw-rules { display:flex; gap:0.5rem; flex-wrap:wrap; margin-top:0.3rem; }
    .pw-rule { display:inline-flex; align-items:center; gap:3px; font-size:0.62rem; font-family:var(--font-body); color:#C0B8B0; transition:color 0.2s; }
    .pw-rule.met { color:#27AE60; }
    .pw-rule .rule-dot { width:5px; height:5px; border-radius:50%; background:#C0B8B0; flex-shrink:0; transition:background 0.2s; }
    .pw-rule.met .rule-dot { background:#27AE60; }

    /* ── CATEGORY GRID ── */
    .cat-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:0.55rem; margin-top:0.25rem; }
    @media(max-width:480px) { .cat-grid { grid-template-columns:repeat(2,1fr); } }

    .cat-chip {
        position:relative; display:flex; align-items:center; gap:0.45rem;
        padding:0.52rem 0.75rem; border:1.5px solid var(--border); border-radius:8px;
        background:var(--ivory); cursor:pointer; user-select:none;
        transition:border-color 0.18s, background 0.18s, box-shadow 0.18s; overflow:hidden;
    }
    .cat-chip:hover { border-color:rgba(201,168,76,0.5); background:rgba(201,168,76,0.04); }
    .cat-chip input[type="checkbox"] { display:none; }
    .cat-chip-icon {
        width:26px; height:26px; border-radius:6px; flex-shrink:0;
        background:rgba(201,168,76,0.1); display:flex; align-items:center; justify-content:center;
        transition:background 0.18s;
    }
    .cat-chip-icon svg { width:13px; height:13px; color:var(--gold-dark); }
    .cat-chip-name { font-size:0.75rem; font-weight:500; color:var(--charcoal); font-family:var(--font-body); line-height:1.2; flex:1; min-width:0; }
    .cat-chip-check {
        position:absolute; top:5px; right:6px; width:14px; height:14px; border-radius:50%;
        border:1.5px solid var(--border); background:var(--white);
        display:flex; align-items:center; justify-content:center; transition:all 0.18s;
    }
    .cat-chip-check svg { width:7px; height:7px; color:var(--white); opacity:0; transition:opacity 0.15s; }
    .cat-chip.selected { border-color:var(--gold); background:rgba(201,168,76,0.08); box-shadow:0 0 0 3px rgba(201,168,76,0.12); }
    .cat-chip.selected .cat-chip-icon { background:rgba(201,168,76,0.2); }
    .cat-chip.selected .cat-chip-check { background:var(--gold); border-color:var(--gold); }
    .cat-chip.selected .cat-chip-check svg { opacity:1; }
    .cat-chip.selected .cat-chip-name { color:var(--gold-dark); font-weight:600; }
    .cat-selected-count { font-size:0.62rem; color:var(--gold-dark); font-family:var(--font-body); margin-top:0.4rem; display:none; }
    .cat-selected-count.show { display:block; }

    /* ── DONE CARD (Step 4) ── */
    .done-card { text-align:center; padding:2rem 0.5rem 1.5rem; }
    .done-icon {
        width:64px; height:64px; border-radius:50%;
        background:rgba(201,168,76,0.1); border:1.5px solid rgba(201,168,76,0.28);
        display:flex; align-items:center; justify-content:center;
        margin:0 auto 1.1rem; color:var(--gold-dark);
    }
    .done-icon svg { width:28px; height:28px; }
    .done-title {
        font-family:var(--font-display); font-size:1.35rem; font-weight:700;
        color:var(--charcoal); line-height:1.2; margin-bottom:0.4rem;
    }
    .done-title em { font-style:italic; color:var(--gold-dark); }
    .done-sub { font-size:0.82rem; color:var(--warm-grey); line-height:1.6; margin-bottom:1.5rem; }

    /* ── LOGIN CARD ── */
    .login-card {
        background:var(--ivory); border:1.5px solid var(--border-md);
        border-radius:12px; padding:1.25rem 1.35rem; text-align:left; margin-bottom:1.1rem;
    }
    .login-card-label {
        font-size:0.58rem; font-weight:700; letter-spacing:0.14em; text-transform:uppercase;
        color:#C0B8B0; margin-bottom:0.9rem;
        display:flex; align-items:center; gap:0.4rem;
    }
    .login-card-label::after { content:''; flex:1; height:1px; background:var(--border); }
    .login-card-label svg { width:10px; height:10px; color:var(--gold-dark); }
    .login-btn {
        display:flex; align-items:center; justify-content:center; gap:0.5rem;
        width:100%; padding:0.75rem 1.4rem; border-radius:8px; border:none;
        background:var(--charcoal);
        font-family:var(--font-body); font-size:0.84rem; font-weight:500;
        color:var(--white); text-decoration:none; cursor:pointer;
        letter-spacing:0.03em; position:relative; overflow:hidden;
        transition:transform 0.15s, box-shadow 0.2s;
    }
    .login-btn::after { content:''; position:absolute; inset:0; background:linear-gradient(135deg,#8A6A1F,#C9A84C); opacity:0; transition:opacity 0.3s; }
    .login-btn:hover::after { opacity:1; }
    .login-btn:hover { transform:translateY(-1px); box-shadow:0 6px 20px rgba(138,106,31,0.22); }
    .login-btn span,.login-btn svg { position:relative; z-index:1; }
    .login-btn svg { width:15px; height:15px; }

    /* ── STEP INFO BADGE ── */
    .step-badge {
        display:inline-flex; align-items:center; gap:0.35rem;
        font-size:0.62rem; font-weight:600; letter-spacing:0.06em;
        text-transform:uppercase; color:var(--gold-dark);
        background:rgba(201,168,76,0.08); border:1px solid rgba(201,168,76,0.2);
        padding:0.22rem 0.65rem; border-radius:999px;
        margin-bottom:0.9rem; display:inline-flex;
    }

    /* ── BUTTONS ── */
    .bv-btn-row { display:flex; gap:0.65rem; align-items:center; margin-top:1.35rem; }
    .bv-btn-back {
        display:inline-flex; align-items:center; gap:0.35rem;
        padding:0.7rem 1.1rem; border-radius:8px;
        border:1.5px solid var(--border); background:var(--white);
        font-family:var(--font-body); font-size:0.8rem; font-weight:500;
        color:var(--warm-grey); cursor:pointer; transition:border-color 0.2s, color 0.2s; flex-shrink:0;
    }
    .bv-btn-back svg { width:12px; height:12px; }
    .bv-btn-back:hover { border-color:var(--gold); color:var(--charcoal); }
    .bv-btn-next {
        flex:1; padding:0.72rem 1.4rem; border-radius:8px; border:none;
        background:var(--charcoal);
        font-family:var(--font-body); font-size:0.84rem; font-weight:500;
        color:var(--white); cursor:pointer; letter-spacing:0.03em;
        display:inline-flex; align-items:center; justify-content:center; gap:0.45rem;
        position:relative; overflow:hidden; transition:transform 0.15s, box-shadow 0.2s;
    }
    .bv-btn-next::after { content:''; position:absolute; inset:0; background:linear-gradient(135deg,#8A6A1F,#C9A84C); opacity:0; transition:opacity 0.3s; }
    .bv-btn-next:hover::after { opacity:1; }
    .bv-btn-next:hover { transform:translateY(-1px); box-shadow:0 6px 20px rgba(138,106,31,0.22); }
    .bv-btn-next span,.bv-btn-next svg { position:relative; z-index:1; }
    .bv-btn-next svg { width:13px; height:13px; }

    /* ── DIVIDER + LOGIN LINK ── */
    .bv-divider { display:flex; align-items:center; gap:0.65rem; margin:0.9rem 0; }
    .bv-divider::before,.bv-divider::after { content:''; flex:1; height:1px; background:var(--border); }
    .bv-divider span { font-size:0.68rem; color:#C0B8B0; letter-spacing:0.06em; font-family:var(--font-body); }
    .bv-login-link { text-align:center; font-size:0.78rem; color:var(--warm-grey); font-family:var(--font-body); }
    .bv-login-link a { color:var(--gold-dark); text-decoration:none; font-weight:500; }
    .bv-login-link a:hover { text-decoration:underline; }
</style>

{{-- ── HEADING ── --}}
<div class="reg-heading">
    <h2>Register as a <em>Supplier</em></h2>
    <p>Complete 4 quick steps to start receiving bookings.</p>
</div>

{{-- ── STEP PROGRESS ── --}}
<div class="bv-steps">
    <div class="bv-step-item">
        <div class="bv-step-circle active" id="sc1">1</div>
        <span class="bv-step-label active" id="sl1">Name</span>
    </div>
    <div class="bv-step-connector" id="sconn1"></div>
    <div class="bv-step-item">
        <div class="bv-step-circle" id="sc2">2</div>
        <span class="bv-step-label" id="sl2">Account</span>
    </div>
    <div class="bv-step-connector" id="sconn2"></div>
    <div class="bv-step-item">
        <div class="bv-step-circle" id="sc3">3</div>
        <span class="bv-step-label" id="sl3">Category</span>
    </div>
    <div class="bv-step-connector" id="sconn3"></div>
    <div class="bv-step-item">
        <div class="bv-step-circle" id="sc4">4</div>
        <span class="bv-step-label" id="sl4">Done</span>
    </div>
</div>

{{-- ── SCROLLABLE WRAPPER ── --}}
<div class="reg-scroll-outer" id="regScrollOuter">

<form method="POST"
      action="{{ route('supplier.register.store') }}"
      id="supplierRegForm"
      enctype="multipart/form-data">
    @csrf

    {{-- ══════════════════════════════════
         STEP 1 — Name
    ══════════════════════════════════ --}}
    <div class="bv-step-panel active" id="step1">

        <div class="bv-section-label">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="5" r="3"/><path d="M1 13c0-3 2.7-5 6-5s6 2 6 5"/></svg>
            Personal Information
        </div>

        {{-- First + Last Name --}}
        <div class="bv-field-row">
            <div class="bv-field">
                <label class="bv-label" for="first_name">
                    First Name <span class="bv-label-req">Required</span>
                </label>
                <div class="bv-input-wrap">
                    <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="7" r="4"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    <input id="first_name" name="first_name" type="text" class="bv-input"
                           placeholder="e.g. Maria"
                           value="{{ old('first_name') }}" required>
                </div>
                @error('first_name')<div class="bv-error">{{ $message }}</div>@enderror
            </div>

            <div class="bv-field">
                <label class="bv-label" for="last_name">
                    Last Name <span class="bv-label-req">Required</span>
                </label>
                <div class="bv-input-wrap">
                    <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="7" r="4"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    <input id="last_name" name="last_name" type="text" class="bv-input"
                           placeholder="e.g. Santos"
                           value="{{ old('last_name') }}" required>
                </div>
                @error('last_name')<div class="bv-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="bv-btn-row">
            <button type="button" class="bv-btn-next" onclick="goTo(2)">
                <span>Continue</span>
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 3l5 5-5 5"/></svg>
            </button>
        </div>

        <div class="bv-divider" style="margin-top:1rem;"><span>already have an account?</span></div>
        <div class="bv-login-link"><a href="{{ route('login') }}">Sign in instead</a></div>
    </div>


    {{-- ══════════════════════════════════
         STEP 2 — Business + Account Credentials
    ══════════════════════════════════ --}}
    <div class="bv-step-panel" id="step2">

        {{-- Business Name --}}
        <div class="bv-section-label">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="7" width="10" height="6" rx="1"/><path d="M4 7V5a3 3 0 016 0v2"/></svg>
            Business Details
        </div>

        <div class="bv-field">
            <label class="bv-label" for="business_name">
                Business Name <span class="bv-label-opt">Optional</span>
            </label>
            <div class="bv-input-wrap">
                <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <rect x="2" y="7" width="16" height="10" rx="2"/>
                    <path d="M6 7V5a4 4 0 018 0v2"/>
                </svg>
                <input id="business_name" name="business_name" type="text" class="bv-input"
                       placeholder="e.g. Santos Events Studio"
                       value="{{ old('business_name') }}">
            </div>
            <p class="bv-hint">Leave blank to use your full name.</p>
            @error('business_name')<div class="bv-error">{{ $message }}</div>@enderror
        </div>

        {{-- Account Credentials --}}
        <div class="bv-section-label" style="margin-top:1.25rem;">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                <rect x="1" y="3" width="12" height="9" rx="2"/><path d="M1 6l6 4 6-4"/>
            </svg>
            Account Credentials
        </div>

        {{-- Username --}}
        <div class="bv-field">
            <label class="bv-label" for="name">
                Username <span class="bv-label-req">Required</span>
            </label>
            <div class="bv-input-wrap">
                <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="10" cy="7" r="4"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7"/>
                </svg>
                <input id="name" name="name" type="text" class="bv-input"
                       placeholder="Your username"
                       value="{{ old('name') }}" required autocomplete="username">
            </div>
            @error('name')<div class="bv-error">{{ $message }}</div>@enderror
        </div>

        {{-- Email --}}
        <div class="bv-field">
            <label class="bv-label" for="email">
                Email Address <span class="bv-label-req">Required</span>
            </label>
            <div class="bv-input-wrap">
                <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <rect x="2" y="4" width="16" height="13" rx="2"/><path d="M2 7l8 5 8-5"/>
                </svg>
                <input id="email" name="email" type="email" class="bv-input"
                       placeholder="you@example.com"
                       value="{{ old('email') }}" required autocomplete="email">
            </div>
            @error('email')<div class="bv-error">{{ $message }}</div>@enderror
        </div>

        {{-- Password + Confirm --}}
        <div class="bv-field-row">
            <div class="bv-field">
                <label class="bv-label" for="password">
                    Password <span class="bv-label-req">Required</span>
                </label>
                <div class="bv-input-wrap">
                    <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="4" y="9" width="12" height="9" rx="2"/><path d="M7 9V7a3 3 0 116 0v2"/>
                    </svg>
                    <input id="password" name="password" type="password" class="bv-input"
                           placeholder="Min. 8 characters"
                           required autocomplete="new-password"
                           oninput="checkPasswordStrength(this.value)">
                    <button type="button" class="pw-eye" onclick="togglePw('password','eyeIcon1')">
                        <svg id="eyeIcon1" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
                <div class="pw-strength-wrap" id="pw-strength-wrap" style="display:none;">
                    <div class="pw-bars">
                        <div class="pw-bar" id="bar1"></div>
                        <div class="pw-bar" id="bar2"></div>
                        <div class="pw-bar" id="bar3"></div>
                        <div class="pw-bar" id="bar4"></div>
                    </div>
                    <div class="pw-feedback">
                        <span class="pw-label-text" id="pw-label">Too short</span>
                    </div>
                    <div class="pw-rules">
                        <span class="pw-rule" id="rule-len"><span class="rule-dot"></span>8+ chars</span>
                        <span class="pw-rule" id="rule-upper"><span class="rule-dot"></span>Uppercase</span>
                        <span class="pw-rule" id="rule-num"><span class="rule-dot"></span>Number</span>
                        <span class="pw-rule" id="rule-sym"><span class="rule-dot"></span>Symbol</span>
                    </div>
                </div>
                @error('password')<div class="bv-error">{{ $message }}</div>@enderror
            </div>

            <div class="bv-field">
                <label class="bv-label" for="password_confirmation">
                    Confirm Password <span class="bv-label-req">Required</span>
                </label>
                <div class="bv-input-wrap">
                    <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="4" y="9" width="12" height="9" rx="2"/><path d="M7 9V7a3 3 0 116 0v2"/><path d="M8 14l2 2 4-4"/>
                    </svg>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                           class="bv-input" placeholder="Repeat password"
                           required autocomplete="new-password"
                           oninput="checkConfirm(this.value)">
                    <button type="button" class="pw-eye" onclick="togglePw('password_confirmation','eyeIcon2')">
                        <svg id="eyeIcon2" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
                <div class="bv-hint" id="confirm-hint" style="display:none;"></div>
                @error('password_confirmation')<div class="bv-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="bv-btn-row">
            <button type="button" class="bv-btn-back" onclick="goTo(1)">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 3L5 8l5 5"/></svg>
                Back
            </button>
            <button type="button" class="bv-btn-next" onclick="goTo(3)">
                <span>Continue</span>
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 3l5 5-5 5"/></svg>
            </button>
        </div>
    </div>


    {{-- ══════════════════════════════════
         STEP 3 — Category
    ══════════════════════════════════ --}}
    <div class="bv-step-panel" id="step3">

        <div class="bv-section-label">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                <rect x="2" y="2" width="4" height="4" rx="1"/><rect x="8" y="2" width="4" height="4" rx="1"/>
                <rect x="2" y="8" width="4" height="4" rx="1"/><rect x="8" y="8" width="4" height="4" rx="1"/>
            </svg>
            Service Category
        </div>

        <p class="bv-hint" style="margin-bottom:0.8rem;font-size:0.76rem;color:var(--warm-grey);">
            Select all service categories that apply to your business.
        </p>

        <div class="cat-grid" id="cat-grid">
            @php
                $oldCats = (array) old('category_id', []);
                $catIcons = [
                    'venue'    => '<path d="M2 12L12 3l10 9v9a1 1 0 01-1 1H3a1 1 0 01-1-1v-9z"/>',
                    'catering' => '<path d="M18 8h1a4 4 0 010 8h-1"/><path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/>',
                    'photo'    => '<path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/><circle cx="12" cy="13" r="4"/>',
                    'video'    => '<polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/>',
                    'dj'       => '<circle cx="12" cy="12" r="2"/><circle cx="12" cy="12" r="7"/><line x1="12" y1="1" x2="12" y2="3"/>',
                    'flor'     => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
                    'emc'      => '<path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/><path d="M19 10v2a7 7 0 01-14 0v-2"/>',
                    'makeup'   => '<path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>',
                    'gown'     => '<path d="M20.38 3.46L16 2a4 4 0 01-8 0L3.62 3.46a2 2 0 00-1.34 2.23l.58 3.57a1 1 0 00.99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 002-2V10h2.15a1 1 0 00.99-.84l.58-3.57a2 2 0 00-1.34-2.23z"/>',
                    'band'     => '<path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/>',
                    'booth'    => '<rect x="2" y="2" width="20" height="20" rx="2"/><path d="M2 9h20"/><circle cx="12" cy="15" r="3"/>',
                    'light'    => '<circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>',
                    'default'  => '<rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>',
                ];
                function getCatIconReg($slug, $icons) {
                    foreach ($icons as $key => $path) {
                        if (str_contains(strtolower($slug), $key)) return $path;
                    }
                    return $icons['default'];
                }
            @endphp

            @foreach($categories as $category)
            @php
                $isOld = in_array($category->id, $oldCats);
                $icon  = getCatIconReg(strtolower($category->slug ?? $category->name), $catIcons);
            @endphp
            <label class="cat-chip {{ $isOld ? 'selected' : '' }}" onclick="toggleCat(this,event)">
                <input type="checkbox" name="category_id[]" value="{{ $category->id }}" {{ $isOld ? 'checked' : '' }}>
                <div class="cat-chip-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">{!! $icon !!}</svg>
                </div>
                <span class="cat-chip-name">{{ $category->name }}</span>
                <span class="cat-chip-check">
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg>
                </span>
            </label>
            @endforeach
        </div>

        <div class="cat-selected-count" id="cat-count"></div>
        @error('category_id')<div class="bv-error" style="margin-top:0.4rem;">{{ $message }}</div>@enderror

        <div class="bv-btn-row">
            <button type="button" class="bv-btn-back" onclick="goTo(2)">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 3L5 8l5 5"/></svg>
                Back
            </button>
            <button type="submit" class="bv-btn-next">
                <span>Create Account</span>
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg>
            </button>
        </div>
    </div>


    {{-- ══════════════════════════════════
         STEP 4 — Done + Login
    ══════════════════════════════════ --}}
    <div class="bv-step-panel" id="step4">
        <div class="done-card">

            <div class="done-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
            </div>

            <div class="done-title">You're all <em>set!</em></div>
            <p class="done-sub">
                Your supplier account has been created successfully.<br>
                Sign in now to complete your profile and start receiving bookings.
            </p>

            <div class="login-card">
                <div class="login-card-label">
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
                        <rect x="1" y="3" width="10" height="7" rx="1.5"/><path d="M1 5l5 3.5L11 5"/>
                    </svg>
                    Sign in to your account
                </div>
                <a href="{{ route('login') }}" class="login-btn">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M3 10h14M11 5l5 5-5 5"/>
                    </svg>
                    <span>Go to Login</span>
                </a>
            </div>

            <p style="font-size:0.72rem;color:#C0B8B0;line-height:1.6;">
                A verification email has been sent to your inbox.<br>
                Please verify your email before signing in.
            </p>
        </div>
    </div>

</form>
</div>{{-- /reg-scroll-outer --}}

<script>
    const TOTAL_STEPS = 4;

    /* ── STEP NAVIGATION ── */
    function goTo(n) {
        document.querySelectorAll('.bv-step-panel').forEach(p => p.classList.remove('active'));
        document.getElementById('step' + n).classList.add('active');

        for (let i = 1; i <= TOTAL_STEPS; i++) {
            const c = document.getElementById('sc' + i);
            const l = document.getElementById('sl' + i);
            c.classList.remove('active', 'done');
            l.classList.remove('active');
            if (i < n)        { c.classList.add('done');   c.textContent = '✓'; }
            else if (i === n) { c.classList.add('active'); c.textContent = i;  l.classList.add('active'); }
            else              { c.textContent = i; }
        }
        for (let i = 1; i <= TOTAL_STEPS - 1; i++) {
            document.getElementById('sconn' + i)?.classList.toggle('done', i < n);
        }

        const outer = document.getElementById('regScrollOuter');
        if (outer) outer.scrollTo({ top: 0, behavior: 'smooth' });
    }

    /* ── PASSWORD TOGGLE ── */
    function togglePw(inputId, iconId) {
        const input  = document.getElementById(inputId);
        const icon   = document.getElementById(iconId);
        const isText = input.type === 'text';
        input.type = isText ? 'password' : 'text';
        icon.innerHTML = isText
            ? '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>'
            : '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
    }

    /* ── PASSWORD STRENGTH ── */
    function checkPasswordStrength(val) {
        const wrap  = document.getElementById('pw-strength-wrap');
        const label = document.getElementById('pw-label');
        const bars  = ['bar1','bar2','bar3','bar4'].map(id => document.getElementById(id));
        const rules = {
            len:   document.getElementById('rule-len'),
            upper: document.getElementById('rule-upper'),
            num:   document.getElementById('rule-num'),
            sym:   document.getElementById('rule-sym')
        };

        if (!val) { wrap.style.display = 'none'; return; }
        wrap.style.display = 'block';

        const hasLen   = val.length >= 8;
        const hasUpper = /[A-Z]/.test(val);
        const hasLower = /[a-z]/.test(val);
        const hasNum   = /[0-9]/.test(val);
        const hasSym   = /[^A-Za-z0-9]/.test(val);

        rules.len.classList.toggle('met',   hasLen);
        rules.upper.classList.toggle('met', hasUpper);
        rules.num.classList.toggle('met',   hasNum);
        rules.sym.classList.toggle('met',   hasSym);

        let score = 0;
        if (hasLen)               score++;
        if (hasUpper && hasLower) score++;
        if (hasNum)               score++;
        if (hasSym)               score++;
        if (val.length >= 12)     score = Math.min(score + 0.5, 4);

        const levels = [
            { bars:1, cls:'fill-weak',    label:'Weak',        labelCls:'weak'    },
            { bars:2, cls:'fill-fair',    label:'Fair',        labelCls:'fair'    },
            { bars:3, cls:'fill-good',    label:'Good',        labelCls:'good'    },
            { bars:4, cls:'fill-strong',  label:'Strong',      labelCls:'strong'  },
            { bars:4, cls:'fill-vstrong', label:'Very Strong', labelCls:'vstrong' },
        ];
        const lv = levels[val.length < 4 ? 0 : Math.min(Math.floor(score), 4)];
        bars.forEach((b, i) => { b.className = 'pw-bar'; if (i < lv.bars) b.classList.add(lv.cls); });
        label.className   = 'pw-label-text ' + lv.labelCls;
        label.textContent = lv.label;
    }

    /* ── CONFIRM PASSWORD ── */
    function checkConfirm(val) {
        const hint = document.getElementById('confirm-hint');
        const pw   = document.getElementById('password').value;
        if (!val) { hint.style.display = 'none'; return; }
        hint.style.display = 'block';
        if (val === pw) { hint.style.color = '#27AE60'; hint.textContent = '✓ Passwords match'; }
        else            { hint.style.color = '#C0392B'; hint.textContent = '✗ Passwords do not match'; }
    }

    /* ── CATEGORY TOGGLE ── */
    function toggleCat(label, event) {
        event.preventDefault();
        label.classList.toggle('selected');
        label.querySelector('input[type="checkbox"]').checked = label.classList.contains('selected');
        updateCatCount();
    }
    function updateCatCount() {
        const n  = document.querySelectorAll('.cat-chip.selected').length;
        const el = document.getElementById('cat-count');
        if (n === 0) { el.classList.remove('show'); }
        else { el.classList.add('show'); el.textContent = n + ' categor' + (n === 1 ? 'y' : 'ies') + ' selected'; }
    }
    updateCatCount();

    /* ── AUTO-JUMP ON VALIDATION ERRORS ── */
    @if($errors->has('first_name') || $errors->has('last_name'))
        goTo(1);
    @elseif($errors->has('business_name') || $errors->has('name') || $errors->has('email') || $errors->has('password') || $errors->has('password_confirmation'))
        goTo(2);
    @elseif($errors->has('category_id'))
        goTo(3);
    @endif
</script>

</x-guest-layout>