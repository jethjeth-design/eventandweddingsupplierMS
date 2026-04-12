<x-supplier-layout>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap');

    :root {
        --gold:        #C9A84C;
        --gold-light:  #E8C97A;
        --gold-dark:   #8A6A1F;
        --blush-deep:  #D4A090;
        --ivory:       #FAF7F2;
        --charcoal:    #1E1B18;
        --warm-grey:   #6B6560;
        --white:       #FFFFFF;
        --border:      #F0EBE5;
        --border-md:   #E0D8D0;
        --danger:      #DC2626;
        --font-display:'Playfair Display', Georgia, serif;
        --font-body:   'DM Sans', sans-serif;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: var(--font-body); background: var(--ivory); color: var(--charcoal); }

    /* ══════════════════════════════
       PAGE HEADER
    ══════════════════════════════ */
    .bv-page-header {
        background: var(--charcoal);
        padding: 1.75rem 2rem 1.5rem;
        position: relative; overflow: hidden;
    }
    .bv-page-header::before {
        content: '';
        position: absolute; inset: 0;
        background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px);
        background-size: 20px 20px;
    }
    .bv-page-header::after {
        content: '';
        position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }
    .bv-ph-inner {
        position: relative; z-index: 1;
        max-width: 780px; margin: 0 auto;
    }
    .bv-ph-eyebrow {
        font-size: 0.6rem; letter-spacing: 0.2em; text-transform: uppercase;
        color: var(--gold); font-weight: 500; margin-bottom: 0.35rem;
        display: flex; align-items: center; gap: 0.5rem; font-family: var(--font-body);
    }
    .bv-ph-eyebrow::before { content: ''; display: block; width: 18px; height: 1px; background: var(--gold); }
    .bv-ph-title {
        font-family: var(--font-display);
        font-size: clamp(1.25rem, 2.5vw, 1.75rem);
        font-weight: 700; color: var(--white); line-height: 1.15;
    }
    .bv-ph-title em { color: var(--gold-light); font-style: italic; }
    .bv-ph-sub { font-size: 0.78rem; color: rgba(255,255,255,0.42); margin-top: 0.3rem; font-family: var(--font-body); }

    /* ══════════════════════════════
       STEP PROGRESS BAR
    ══════════════════════════════ */
    .bv-progress-wrap {
        background: var(--white);
        border-bottom: 1px solid var(--border);
        padding: 0;
    }
    .bv-progress-inner {
        max-width: 780px; margin: 0 auto;
        display: flex;
    }
    .bv-step-tab {
        flex: 1; padding: 0.9rem 0.5rem 0.85rem;
        display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        font-size: 0.7rem; font-weight: 500; letter-spacing: 0.04em; text-transform: uppercase;
        color: var(--warm-grey); font-family: var(--font-body);
        border-bottom: 2.5px solid transparent;
        transition: color .2s, border-color .2s;
        cursor: default; position: relative;
    }
    .bv-step-tab.active { color: var(--gold-dark); border-bottom-color: var(--gold); }
    .bv-step-tab.done   { color: var(--gold); border-bottom-color: rgba(201,168,76,0.3); }
    .bv-step-num {
        width: 22px; height: 22px; border-radius: 50%; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.65rem; font-weight: 700;
        background: var(--border); color: var(--warm-grey);
        transition: background .2s, color .2s;
    }
    .bv-step-tab.active .bv-step-num { background: var(--gold); color: var(--charcoal); }
    .bv-step-tab.done   .bv-step-num { background: rgba(201,168,76,0.15); color: var(--gold-dark); }

    /* ══════════════════════════════
       FORM CONTAINER
    ══════════════════════════════ */
    .bv-form-outer { max-width: 780px; margin: 2rem auto; padding: 0 1rem 3rem; }
    form { width: 100%; }

    .bv-step-panel {
        display: none;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 6px;
        overflow: hidden;
        animation: panelIn .3s ease both;
    }
    .bv-step-panel.active { display: block; }
    @keyframes panelIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Section label ── */
    .bv-section-label {
        display: flex; align-items: center; gap: 0.55rem;
        font-size: 0.6rem; font-weight: 700; letter-spacing: 0.18em; text-transform: uppercase;
        color: var(--gold-dark); font-family: var(--font-body);
        padding: 0.85rem 1.5rem;
        background: rgba(201,168,76,0.04);
        border-bottom: 1px solid var(--border);
        position: relative;
    }
    .bv-section-label::after {
        content: ''; flex: 1; height: 1px;
        background: linear-gradient(90deg, var(--gold), transparent);
    }
    .bv-section-label svg { width: 14px; height: 14px; color: var(--gold-dark); opacity: .7; flex-shrink: 0; }

    /* ── Panel body ── */
    .bv-panel-body { padding: 1.5rem; }

    /* ── Field ── */
    .bv-field { margin-bottom: 1.25rem; }
    .bv-field:last-of-type { margin-bottom: 0; }
    .bv-label {
        display: flex; align-items: center; gap: 0.4rem;
        font-size: 0.78rem; font-weight: 500; color: var(--charcoal);
        margin-bottom: 0.45rem; font-family: var(--font-body);
    }
    .bv-label-req {
        font-size: 0.58rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase;
        background: rgba(201,168,76,0.1); color: var(--gold-dark);
        border: 1px solid rgba(201,168,76,0.22); padding: 1px 6px; border-radius: 2px;
    }
    .bv-label-opt {
        font-size: 0.58rem; font-weight: 500; letter-spacing: 0.04em;
        color: var(--warm-grey); background: var(--ivory);
        border: 1px solid var(--border); padding: 1px 6px; border-radius: 2px;
    }
    .bv-hint  { font-size: 0.72rem; color: var(--warm-grey); margin-top: 0.35rem; font-family: var(--font-body); }
    .bv-error { font-size: 0.72rem; color: var(--danger);    margin-top: 0.35rem; font-family: var(--font-body); }

    /* ── Field row ── */
    .bv-field-row {
        display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;
        margin-bottom: 1.25rem;
    }
    .bv-field-row .bv-field { margin-bottom: 0; }
    @media (max-width: 560px) { .bv-field-row { grid-template-columns: 1fr; } }

    /* ── Input ── */
    .bv-input-wrap { position: relative; display: flex; align-items: center; }
    .bv-input-icon {
        position: absolute; left: 0.85rem;
        width: 15px; height: 15px; flex-shrink: 0;
        color: var(--warm-grey); opacity: .5; pointer-events: none;
    }
    .bv-input {
        width: 100%; padding: 0.62rem 0.9rem 0.62rem 2.4rem;
        border: 1px solid var(--border-md); border-radius: 4px;
        font-size: 0.875rem; font-family: var(--font-body);
        color: var(--charcoal); background: var(--ivory);
        outline: none; transition: border-color .18s, box-shadow .18s, background .18s;
        line-height: 1.5;
    }
    .bv-input:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
        background: var(--white);
    }
    .bv-input::placeholder { color: #B0A89E; }

    /* ── Select ── */
    .bv-select-wrap { position: relative; }
    .bv-select-wrap::after {
        content: '';
        position: absolute; right: 0.9rem; top: 50%; transform: translateY(-50%);
        width: 0; height: 0;
        border-left: 4px solid transparent; border-right: 4px solid transparent;
        border-top: 5px solid var(--warm-grey);
        pointer-events: none; opacity: .5;
    }
    .bv-select {
        width: 100%; padding: 0.62rem 2.2rem 0.62rem 0.9rem;
        border: 1px solid var(--border-md); border-radius: 4px;
        font-size: 0.875rem; font-family: var(--font-body);
        color: var(--charcoal); background: var(--ivory);
        outline: none; appearance: none;
        transition: border-color .18s, box-shadow .18s, background .18s;
    }
    .bv-select:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
        background: var(--white);
    }

    /* ── Textarea ── */
    .bv-textarea {
        width: 100%; padding: 0.72rem 0.9rem;
        border: 1px solid var(--border-md); border-radius: 4px;
        font-size: 0.875rem; font-family: var(--font-body);
        color: var(--charcoal); background: var(--ivory);
        outline: none; resize: vertical; min-height: 100px;
        transition: border-color .18s, box-shadow .18s, background .18s; line-height: 1.6;
    }
    .bv-textarea:focus {
        border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
        background: var(--white);
    }
    .bv-textarea::placeholder { color: #B0A89E; }
    .bv-textarea-footer { display: flex; justify-content: flex-end; margin-top: 0.3rem; }
    .bv-char-count { font-size: 0.65rem; color: var(--warm-grey); font-family: var(--font-body); }

    /* ── Photo upload ── */
    .bv-photo-zone { display: flex; align-items: center; gap: 1.25rem; flex-wrap: wrap; }
    .bv-photo-circle {
        width: 80px; height: 80px; border-radius: 50%; flex-shrink: 0;
        border: 2px dashed var(--border-md);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; overflow: hidden; position: relative;
        background: var(--ivory); transition: border-color .2s;
    }
    .bv-photo-circle:hover { border-color: var(--gold); }
    .bv-photo-circle img { width: 100%; height: 100%; object-fit: cover; position: absolute; inset: 0; display: none; }
    .bv-photo-circle-icon {
        display: flex; flex-direction: column; align-items: center; gap: 3px;
        color: var(--warm-grey); opacity: .5;
    }
    .bv-photo-circle-icon svg { width: 22px; height: 22px; }
    .bv-photo-circle-icon span { font-size: 0.55rem; text-transform: uppercase; letter-spacing: .08em; font-family: var(--font-body); }
    .bv-photo-info p { font-size: 0.7rem; color: var(--warm-grey); margin-bottom: 0.5rem; font-family: var(--font-body); }
    .bv-btn-upload {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.42rem 0.9rem;
        background: transparent; color: var(--charcoal);
        border: 1px solid var(--border-md); border-radius: 3px;
        font-size: 0.7rem; font-weight: 500; letter-spacing: 0.04em;
        text-transform: uppercase; font-family: var(--font-body);
        transition: border-color .18s, color .18s; cursor: pointer;
    }
    .bv-btn-upload:hover { border-color: var(--gold); color: var(--gold-dark); }
    .bv-btn-upload svg { width: 13px; height: 13px; }

    /* ══════════════════════════════
       CATEGORY CHIPS  ← NEW
    ══════════════════════════════ */
    .bv-cat-grid {
        display: flex; flex-wrap: wrap; gap: 0.5rem;
        margin-top: 0.1rem;
    }
    /* The real checkbox — visually hidden */
    .bv-cat-check { display: none; }

    /* The visible pill/card */
    .bv-cat-label {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.45rem 0.9rem;
        border: 1.5px solid var(--border-md);
        border-radius: 999px;
        background: var(--ivory);
        font-size: 0.78rem; font-weight: 500;
        color: var(--warm-grey);
        font-family: var(--font-body);
        cursor: pointer;
        user-select: none;
        transition: border-color .18s, background .18s, color .18s, box-shadow .18s;
    }
    .bv-cat-label:hover {
        border-color: var(--gold);
        color: var(--gold-dark);
        background: rgba(201,168,76,0.06);
    }
    /* Checked state */
    .bv-cat-check:checked + .bv-cat-label {
        border-color: var(--gold);
        background: rgba(201,168,76,0.12);
        color: var(--gold-dark);
        box-shadow: 0 0 0 2px rgba(201,168,76,0.18);
        font-weight: 600;
    }
    /* Tick icon inside checked pill */
    .bv-cat-label .bv-cat-tick {
        width: 13px; height: 13px;
        display: none;
        color: var(--gold-dark);
        flex-shrink: 0;
    }
    .bv-cat-check:checked + .bv-cat-label .bv-cat-tick { display: block; }
    /* "None selected" error highlight */
    .bv-cat-grid.error .bv-cat-label { border-color: var(--danger); }
    .bv-cat-grid.error .bv-cat-check:checked + .bv-cat-label { border-color: var(--gold); }

    /* ── Availability toggle ── */
    .bv-avail-row {
        display: flex; align-items: center; gap: 0.75rem;
        padding: 0.85rem 1rem;
        background: var(--ivory); border: 1px solid var(--border); border-radius: 4px;
    }
    .bv-toggle-track {
        width: 38px; height: 22px; border-radius: 99px;
        background: var(--border-md); position: relative;
        flex-shrink: 0; cursor: pointer; transition: background .2s;
    }
    .bv-toggle-track.on { background: var(--gold); }
    .bv-toggle-thumb {
        position: absolute; top: 3px; left: 3px;
        width: 16px; height: 16px; border-radius: 50%;
        background: var(--white); transition: left .2s;
        box-shadow: 0 1px 4px rgba(0,0,0,0.15);
    }
    .bv-toggle-track.on .bv-toggle-thumb { left: 19px; }
    .bv-avail-label { font-size: 0.82rem; font-family: var(--font-body); color: var(--charcoal); flex: 1; }
    .bv-avail-chip {
        font-size: 0.58rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase;
        padding: 2px 8px; border-radius: 2px;
    }
    .bv-avail-chip.yes { background: #F0FDF4; color: #15803D; border: 1px solid #BBF7D0; }
    .bv-avail-chip.no  { background: #FFFBEB; color: #B45309; border: 1px solid #FDE68A; }

    /* ── Divider ── */
    .bv-divider { border: none; border-top: 1px solid var(--border); margin: 1.5rem 0; }

    /* ── Button row ── */
    .bv-btn-row {
        display: flex; align-items: center; justify-content: space-between; gap: 0.75rem;
        padding: 1.1rem 1.5rem;
        border-top: 1px solid var(--border);
        background: rgba(201,168,76,0.02);
    }
    .bv-btn-back {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.55rem 1.1rem;
        background: transparent; color: var(--warm-grey);
        border: 1px solid var(--border-md); border-radius: 3px;
        font-size: 0.75rem; font-weight: 500; letter-spacing: 0.04em; text-transform: uppercase;
        cursor: pointer; font-family: var(--font-body);
        transition: border-color .18s, color .18s;
    }
    .bv-btn-back:hover { border-color: var(--gold); color: var(--gold-dark); }
    .bv-btn-back svg { width: 14px; height: 14px; }
    .bv-btn-next {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.6rem 1.4rem;
        background: var(--gold); color: var(--charcoal);
        border: none; border-radius: 3px;
        font-size: 0.75rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase;
        cursor: pointer; font-family: var(--font-body);
        transition: background .18s, transform .15s;
    }
    .bv-btn-next:hover { background: var(--gold-light); }
    .bv-btn-next:active { transform: scale(.97); }
    .bv-btn-next svg { width: 14px; height: 14px; }
    .bv-btn-submit {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.6rem 1.4rem;
        background: var(--charcoal); color: var(--white);
        border: none; border-radius: 3px;
        font-size: 0.75rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase;
        cursor: pointer; font-family: var(--font-body);
        transition: background .18s, transform .15s;
        position: relative; overflow: hidden;
    }
    .bv-btn-submit:hover { background: #2e2a26; }
    .bv-btn-submit::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(201,168,76,.15), transparent);
        border-radius: 3px;
    }
    .bv-btn-submit svg { width: 14px; height: 14px; }

    /* ── Step intro card ── */
    .bv-step-intro {
        background: rgba(201,168,76,0.04); border: 1px solid rgba(201,168,76,0.18);
        border-radius: 4px; padding: 0.9rem 1rem; margin-bottom: 1.25rem;
        display: flex; align-items: flex-start; gap: 0.6rem;
    }
    .bv-step-intro svg { width: 16px; height: 16px; flex-shrink: 0; color: var(--gold-dark); margin-top: 1px; }
    .bv-step-intro p { font-size: 0.78rem; color: var(--warm-grey); line-height: 1.5; font-family: var(--font-body); }
    .bv-step-intro p strong { color: var(--charcoal); font-weight: 600; }

    /* ── Step 1 welcome ── */
    .bv-welcome-block { text-align: center; padding: 2.5rem 1.5rem 2rem; }
    .bv-welcome-icon {
        width: 64px; height: 64px; border-radius: 50%;
        background: var(--charcoal); margin: 0 auto 1.25rem;
        display: flex; align-items: center; justify-content: center;
        border: 3px solid rgba(201,168,76,0.25);
    }
    .bv-welcome-icon svg { width: 28px; height: 28px; color: var(--gold); }
    .bv-welcome-title {
        font-family: var(--font-display);
        font-size: clamp(1.1rem, 2vw, 1.4rem);
        font-weight: 700; color: var(--charcoal); margin-bottom: 0.5rem;
    }
    .bv-welcome-title em { color: var(--gold-dark); font-style: italic; }
    .bv-welcome-sub {
        font-size: 0.82rem; color: var(--warm-grey); max-width: 400px;
        margin: 0 auto 1.5rem; line-height: 1.6; font-family: var(--font-body);
    }
    .bv-steps-list { display: flex; justify-content: center; gap: 1.25rem; flex-wrap: wrap; margin-bottom: 1.75rem; }
    .bv-steps-list-item {
        display: flex; flex-direction: column; align-items: center; gap: 0.35rem;
        font-size: 0.68rem; color: var(--warm-grey); font-family: var(--font-body);
        text-transform: uppercase; letter-spacing: 0.06em;
    }
    .bv-steps-list-num {
        width: 30px; height: 30px; border-radius: 50%;
        background: var(--ivory); border: 1.5px solid var(--border-md);
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display); font-size: 0.85rem; font-weight: 700; color: var(--gold-dark);
    }

    /* Mobile */
    @media (max-width: 640px) {
        .bv-form-outer { padding: 0 0 3rem; }
        .bv-panel-body { padding: 1.1rem; }
        .bv-btn-row { padding: 1rem 1.1rem; }
        .bv-progress-inner { overflow-x: auto; }
        .bv-step-tab { font-size: 0; gap: 0; padding: 0.75rem 0.5rem; }
        .bv-step-tab .bv-step-num { font-size: 0.65rem; margin: 0 auto; }
    }
</style>

{{-- ── PAGE HEADER ── --}}
<div class="bv-page-header">
    <div class="bv-ph-inner">
        <div class="bv-ph-eyebrow">Supplier Registration</div>
        <div class="bv-ph-title">Become a <em>Supplier</em></div>
        <div class="bv-ph-sub">Complete all steps to set up your supplier profile on Bikol's Craft.</div>
    </div>
</div>

{{-- ── STEP PROGRESS BAR ── --}}
<div class="bv-progress-wrap">
    <div class="bv-progress-inner">
        <div class="bv-step-tab active" id="tab-1"><span class="bv-step-num">1</span><span>Welcome</span></div>
        <div class="bv-step-tab" id="tab-2"><span class="bv-step-num">2</span><span>Personal</span></div>
        <div class="bv-step-tab" id="tab-3"><span class="bv-step-num">3</span><span>Business</span></div>
        <div class="bv-step-tab" id="tab-4"><span class="bv-step-num">4</span><span>Review</span></div>
    </div>
</div>

{{-- ── FORM ── --}}
<div class="bv-form-outer">
    <form method="POST" action="{{ route('supplier.store') }}" enctype="multipart/form-data" id="bv-main-form">
        @csrf

        {{-- ═══════ STEP 1 — Welcome ═══════ --}}
        <div class="bv-step-panel active" id="step1">
            <div class="bv-welcome-block">
                <div class="bv-welcome-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                        <path d="M2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <div class="bv-welcome-title">Join <em>Bikol's Craft</em> as a Supplier</div>
                <p class="bv-welcome-sub">Connect with clients looking for talented event professionals in Bikol and beyond. Complete your profile in just a few steps.</p>
                <div class="bv-steps-list">
                    <div class="bv-steps-list-item"><div class="bv-steps-list-num">1</div>Personal Info</div>
                    <div class="bv-steps-list-item"><div class="bv-steps-list-num">2</div>Business Info</div>
                    <div class="bv-steps-list-item"><div class="bv-steps-list-num">3</div>Review & Submit</div>
                </div>
            </div>
            <div class="bv-btn-row" style="justify-content:flex-end;">
                <button type="button" class="bv-btn-next" onclick="goTo(2)">
                    <span>Get Started</span>
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 3l5 5-5 5"/></svg>
                </button>
            </div>
        </div>

        {{-- ═══════ STEP 2 — Personal Information ═══════ --}}
        <div class="bv-step-panel" id="step2">
            <div class="bv-section-label">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="5" r="3"/><path d="M1 13c0-3 2.7-5 6-5s6 2 6 5"/></svg>
                Personal Information
            </div>
            <div class="bv-panel-body">
                <div class="bv-step-intro">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="10" r="8"/><path d="M10 9v5M10 7h.01"/></svg>
                    <p>Tell us a bit about yourself. Your <strong>name</strong> will appear on your public supplier profile.</p>
                </div>

                {{-- Profile Photo --}}
                <div class="bv-field">
                    <label class="bv-label">Profile Photo <span class="bv-label-opt">Optional</span></label>
                    <div class="bv-photo-zone">
                        <div class="bv-photo-circle" id="photoPreview" onclick="document.getElementById('photo').click()">
                            <img id="photoImg" src="" alt="">
                            <div class="bv-photo-circle-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 16V8M8 12l4-4 4 4"/><path d="M20 16.5A4.5 4.5 0 0015.5 21h-7A4.5 4.5 0 004 16.5"/></svg>
                                <span>Upload</span>
                            </div>
                        </div>
                        <div class="bv-photo-info">
                            <p>JPG, PNG or WEBP · Max 2MB · Min 200×200px recommended</p>
                            <input type="file" id="photo" name="photo" accept="image/jpeg,image/png,image/webp" style="display:none" onchange="handlePhotoUpload(this)">
                            <label for="photo" class="bv-btn-upload">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M8 11V3M5 6l3-3 3 3M3 11v2a1 1 0 001 1h8a1 1 0 001-1v-2"/></svg>
                                Choose Photo
                            </label>
                            <span id="photoFilename" style="font-size:0.65rem;color:#C0B8B0;margin-left:0.5rem;"></span>
                            @error('photo')<div class="bv-error" style="margin-top:0.4rem;">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <hr class="bv-divider">

                <div class="bv-field-row">
                    <div class="bv-field">
                        <label class="bv-label" for="first_name">First Name <span class="bv-label-req">Required</span></label>
                        <div class="bv-input-wrap">
                            <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="7" r="4"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                            <input id="first_name" name="first_name" type="text" class="bv-input" placeholder="e.g. Maria" value="{{ old('first_name') }}" required>
                        </div>
                        @error('first_name')<div class="bv-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="bv-field">
                        <label class="bv-label" for="last_name">Last Name <span class="bv-label-req">Required</span></label>
                        <div class="bv-input-wrap">
                            <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="7" r="4"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                            <input id="last_name" name="last_name" type="text" class="bv-input" placeholder="e.g. Santos" value="{{ old('last_name') }}" required>
                        </div>
                        @error('last_name')<div class="bv-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="bv-field">
                    <label class="bv-label" for="phone">Phone Number <span class="bv-label-opt">Optional</span></label>
                    <div class="bv-input-wrap">
                        <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M3 5a2 2 0 012-2h1l2 4-1.5 1.5a11 11 0 004 4L12 11l4 2v1a2 2 0 01-2 2C7.5 16 4 12.5 4 7a2 2 0 011-1.7V5z"/></svg>
                        <input id="phone" name="phone" type="tel" class="bv-input" placeholder="+63 917 000 0000" value="{{ old('phone') }}">
                    </div>
                    @error('phone')<div class="bv-error">{{ $message }}</div>@enderror
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

        {{-- ═══════ STEP 3 — Business Info ═══════ --}}
        <div class="bv-step-panel" id="step3">
            <div class="bv-section-label">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="7" width="10" height="6" rx="1"/><path d="M4 7V5a3 3 0 016 0v2"/></svg>
                Business Information
            </div>
            <div class="bv-panel-body">
                <div class="bv-step-intro">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="10" r="8"/><path d="M10 9v5M10 7h.01"/></svg>
                    <p>Describe your services so clients can find you. Your <strong>category</strong> and <strong>service description</strong> are required.</p>
                </div>

                <div class="bv-field">
                    <label class="bv-label" for="business_name">Business Name <span class="bv-label-opt">Optional</span></label>
                    <div class="bv-input-wrap">
                        <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="7" width="16" height="10" rx="2"/><path d="M6 7V5a4 4 0 018 0v2"/></svg>
                        <input id="business_name" name="business_name" type="text" class="bv-input" placeholder="e.g. Santos Events Studio" value="{{ old('business_name') }}">
                    </div>
                    <p class="bv-hint">Leave blank to use your full name as the business name.</p>
                    @error('business_name')<div class="bv-error">{{ $message }}</div>@enderror
                </div>

                <div class="bv-field">
                    <label class="bv-label" for="tagline">Tagline <span class="bv-label-opt">Optional</span></label>
                    <div class="bv-input-wrap">
                        <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M4 6h12M4 10h8M4 14h5"/></svg>
                        <input id="tagline" name="tagline" type="text" class="bv-input" placeholder="e.g. Crafting unforgettable moments since 2015" value="{{ old('tagline') }}">
                    </div>
                    @error('tagline')<div class="bv-error">{{ $message }}</div>@enderror
                </div>

                <hr class="bv-divider">

                <div class="bv-field-row">
                    <div class="bv-field">
                        <label class="bv-label" for="city">City <span class="bv-label-opt">Optional</span></label>
                        <div class="bv-input-wrap">
                            <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M10 2C7.2 2 5 4.2 5 7c0 4.4 5 11 5 11s5-6.6 5-11c0-2.8-2.2-5-5-5z"/><circle cx="10" cy="7" r="1.5"/></svg>
                            <input id="city" name="city" type="text" class="bv-input" placeholder="e.g. Naga City" value="{{ old('city') }}">
                        </div>
                        @error('city')<div class="bv-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="bv-field">
                        <label class="bv-label" for="province">Province <span class="bv-label-opt">Optional</span></label>
                        <div class="bv-input-wrap">
                            <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M2 10h16M10 2l8 8-8 8-8-8 8-8z"/></svg>
                            <input id="province" name="province" type="text" class="bv-input" placeholder="e.g. Camarines Sur" value="{{ old('province') }}">
                        </div>
                        @error('province')<div class="bv-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="bv-field">
                    <label class="bv-label" for="address">Full Address <span class="bv-label-opt">Optional</span></label>
                    <div class="bv-input-wrap">
                        <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M3 7h14M3 11h14M5 15h10M7 3h6"/></svg>
                        <input id="address" name="address" type="text" class="bv-input" placeholder="e.g. 123 Magsaysay Ave, Barangay Centro" value="{{ old('address') }}">
                    </div>
                    @error('address')<div class="bv-error">{{ $message }}</div>@enderror
                </div>

                <div class="bv-field">
                    <label class="bv-label" for="price">Starting Price <span class="bv-label-opt">Optional</span></label>
                    <div class="bv-input-wrap">
                        <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><line x1="10" y1="2" x2="10" y2="18"/><path d="M14 6H8.5a2.5 2.5 0 000 5h3a2.5 2.5 0 010 5H6"/></svg>
                        <input id="price" name="price" type="text" class="bv-input" placeholder="e.g. ₱20,000 – ₱50,000" value="{{ old('price') }}">
                    </div>
                    @error('price')<div class="bv-error">{{ $message }}</div>@enderror
                </div>

                <hr class="bv-divider">

                {{-- ══ CATEGORY — clickable chip pills ══ --}}
                <div class="bv-field">
                    <label class="bv-label">
                        Category
                        <span class="bv-label-req">Required</span>
                        <span style="font-size:0.68rem;font-weight:400;color:var(--warm-grey);margin-left:0.25rem;">(select all that apply)</span>
                    </label>

                    <div class="bv-cat-grid" id="catGrid">
                        @foreach($categories as $category)
                        @php $isChecked = in_array($category->id, (array) old('category_id', [])); @endphp
                        <input
                            class="bv-cat-check"
                            type="checkbox"
                            name="category_id[]"
                            id="cat_{{ $category->id }}"
                            value="{{ $category->id }}"
                            {{ $isChecked ? 'checked' : '' }}>
                        <label class="bv-cat-label" for="cat_{{ $category->id }}">
                            {{-- tick appears when checked --}}
                            <svg class="bv-cat-tick" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.2">
                                <path d="M2 7l3.5 3.5L12 3"/>
                            </svg>
                            {{ $category->name }}
                        </label>
                        @endforeach
                    </div>

                    <p class="bv-hint">Determines where your profile appears in search results.</p>
                    @error('category_id')<div class="bv-error">{{ $message }}</div>@enderror
                </div>

                {{-- Experience --}}
                <div class="bv-field">
                    <label class="bv-label" for="experience">Years of Experience <span class="bv-label-req">Required</span></label>
                    <div class="bv-select-wrap">
                        <select id="experience" name="experience" class="bv-select" required>
                            <option value="" disabled {{ old('experience') ? '' : 'selected' }}>Select experience…</option>
                            @foreach(['less_than_1' => 'Less than 1 year', '1_2' => '1–2 years', '3_5' => '3–5 years', '6_10' => '6–10 years', '10_plus' => '10+ years'] as $val => $lbl)
                                <option value="{{ $val }}" {{ old('experience') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('experience')<div class="bv-error">{{ $message }}</div>@enderror
                </div>

                {{-- Availability toggle --}}
                <div class="bv-field">
                    <label class="bv-label">Availability</label>
                    <div class="bv-avail-row">
                        <div class="bv-toggle-track {{ old('is_available', 1) ? 'on' : '' }}" id="availToggle" onclick="toggleAvail()">
                            <div class="bv-toggle-thumb"></div>
                        </div>
                        <input type="hidden" name="is_available" id="availInput" value="{{ old('is_available', 1) }}">
                        <span class="bv-avail-label">I am currently accepting bookings</span>
                        <span class="bv-avail-chip {{ old('is_available', 1) ? 'yes' : 'no' }}" id="availChip">
                            {{ old('is_available', 1) ? 'Available' : 'Unavailable' }}
                        </span>
                    </div>
                </div>

                <hr class="bv-divider">

                <div class="bv-field">
                    <label class="bv-label" for="bio">Short Bio <span class="bv-label-opt">Optional</span></label>
                    <textarea id="bio" name="bio" class="bv-textarea"
                              placeholder="Tell clients about your style, passion, and what makes you unique…"
                              maxlength="500"
                              oninput="updateCount('bioCount', this, 500)">{{ old('bio') }}</textarea>
                    <div class="bv-textarea-footer">
                        <span class="bv-char-count" id="bioCount">0 / 500</span>
                    </div>
                    @error('bio')<div class="bv-error">{{ $message }}</div>@enderror
                </div>

                <div class="bv-field">
                    <label class="bv-label" for="description">Service Description <span class="bv-label-req">Required</span></label>
                    <textarea id="description" name="description" class="bv-textarea"
                              placeholder="Describe the services you offer, pricing range, packages, availability…"
                              maxlength="1000"
                              oninput="updateCount('descCount', this, 1000)"
                              required>{{ old('description') }}</textarea>
                    <div class="bv-textarea-footer">
                        <span class="bv-char-count" id="descCount">0 / 1000</span>
                    </div>
                    @error('description')<div class="bv-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="bv-btn-row">
                <button type="button" class="bv-btn-back" onclick="goTo(2)">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 3L5 8l5 5"/></svg>
                    Back
                </button>
                <button type="button" class="bv-btn-next" onclick="goTo(4)">
                    <span>Review</span>
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 3l5 5-5 5"/></svg>
                </button>
            </div>
        </div>

        {{-- ═══════ STEP 4 — Review & Submit ═══════ --}}
        <div class="bv-step-panel" id="step4">
            <div class="bv-section-label">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 7h10M7 2l5 5-5 5"/></svg>
                Review & Submit
            </div>
            <div class="bv-panel-body">
                <div class="bv-step-intro">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M9 12l2 2 4-4M5 7h10M5 11h6M5 15h4"/></svg>
                    <p>Please review your information before submitting. You can go back and edit any step.</p>
                </div>

                <div style="background:var(--ivory);border:1px solid var(--border);border-radius:4px;overflow:hidden;margin-bottom:1.25rem;">

                    {{-- Personal --}}
                    <div style="padding:0.75rem 1rem;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;background:var(--white);">
                        <div style="font-size:0.62rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--gold-dark);font-family:var(--font-body);display:flex;align-items:center;gap:0.4rem;">
                            <svg width="12" height="12" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="5" r="3"/><path d="M1 13c0-3 2.7-5 6-5s6 2 6 5"/></svg>
                            Personal Info
                        </div>
                        <button type="button" onclick="goTo(2)" style="font-size:0.65rem;color:var(--gold-dark);background:none;border:none;cursor:pointer;font-family:var(--font-body);text-decoration:underline;text-underline-offset:2px;">Edit</button>
                    </div>
                    <div style="padding:0.85rem 1rem;display:grid;grid-template-columns:1fr 1fr;gap:0.5rem 1.5rem;">
                        <div>
                            <div style="font-size:0.6rem;text-transform:uppercase;letter-spacing:.08em;color:var(--warm-grey);font-family:var(--font-body);margin-bottom:2px;">First Name</div>
                            <div style="font-size:0.82rem;color:var(--charcoal);font-family:var(--font-body);" id="r-first_name">—</div>
                        </div>
                        <div>
                            <div style="font-size:0.6rem;text-transform:uppercase;letter-spacing:.08em;color:var(--warm-grey);font-family:var(--font-body);margin-bottom:2px;">Last Name</div>
                            <div style="font-size:0.82rem;color:var(--charcoal);font-family:var(--font-body);" id="r-last_name">—</div>
                        </div>
                        <div>
                            <div style="font-size:0.6rem;text-transform:uppercase;letter-spacing:.08em;color:var(--warm-grey);font-family:var(--font-body);margin-bottom:2px;">Phone</div>
                            <div style="font-size:0.82rem;color:var(--charcoal);font-family:var(--font-body);" id="r-phone">—</div>
                        </div>
                    </div>

                    {{-- Business --}}
                    <div style="padding:0.75rem 1rem;border-top:1px solid var(--border);border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;background:var(--white);">
                        <div style="font-size:0.62rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--gold-dark);font-family:var(--font-body);display:flex;align-items:center;gap:0.4rem;">
                            <svg width="12" height="12" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="7" width="10" height="6" rx="1"/><path d="M4 7V5a3 3 0 016 0v2"/></svg>
                            Business Info
                        </div>
                        <button type="button" onclick="goTo(3)" style="font-size:0.65rem;color:var(--gold-dark);background:none;border:none;cursor:pointer;font-family:var(--font-body);text-decoration:underline;text-underline-offset:2px;">Edit</button>
                    </div>
                    <div style="padding:0.85rem 1rem;display:grid;grid-template-columns:1fr 1fr;gap:0.5rem 1.5rem;">
                        <div>
                            <div style="font-size:0.6rem;text-transform:uppercase;letter-spacing:.08em;color:var(--warm-grey);font-family:var(--font-body);margin-bottom:2px;">Business Name</div>
                            <div style="font-size:0.82rem;color:var(--charcoal);font-family:var(--font-body);" id="r-business_name">—</div>
                        </div>
                        <div>
                            <div style="font-size:0.6rem;text-transform:uppercase;letter-spacing:.08em;color:var(--warm-grey);font-family:var(--font-body);margin-bottom:2px;">Categories</div>
                            <div style="font-size:0.82rem;color:var(--charcoal);font-family:var(--font-body);" id="r-category">—</div>
                        </div>
                        <div>
                            <div style="font-size:0.6rem;text-transform:uppercase;letter-spacing:.08em;color:var(--warm-grey);font-family:var(--font-body);margin-bottom:2px;">City</div>
                            <div style="font-size:0.82rem;color:var(--charcoal);font-family:var(--font-body);" id="r-city">—</div>
                        </div>
                        <div>
                            <div style="font-size:0.6rem;text-transform:uppercase;letter-spacing:.08em;color:var(--warm-grey);font-family:var(--font-body);margin-bottom:2px;">Province</div>
                            <div style="font-size:0.82rem;color:var(--charcoal);font-family:var(--font-body);" id="r-province">—</div>
                        </div>
                        <div>
                            <div style="font-size:0.6rem;text-transform:uppercase;letter-spacing:.08em;color:var(--warm-grey);font-family:var(--font-body);margin-bottom:2px;">Experience</div>
                            <div style="font-size:0.82rem;color:var(--charcoal);font-family:var(--font-body);" id="r-experience">—</div>
                        </div>
                        <div>
                            <div style="font-size:0.6rem;text-transform:uppercase;letter-spacing:.08em;color:var(--warm-grey);font-family:var(--font-body);margin-bottom:2px;">Starting Price</div>
                            <div style="font-size:0.82rem;color:var(--charcoal);font-family:var(--font-body);" id="r-price">—</div>
                        </div>
                        <div style="grid-column:1/-1;">
                            <div style="font-size:0.6rem;text-transform:uppercase;letter-spacing:.08em;color:var(--warm-grey);font-family:var(--font-body);margin-bottom:2px;">Tagline</div>
                            <div style="font-size:0.82rem;color:var(--charcoal);font-family:var(--font-body);font-style:italic;" id="r-tagline">—</div>
                        </div>
                    </div>
                </div>

                <label style="display:flex;align-items:flex-start;gap:0.6rem;cursor:pointer;">
                    <input type="checkbox" id="bv-agree" required style="margin-top:2px;accent-color:var(--gold);">
                    <span style="font-size:0.78rem;color:var(--warm-grey);line-height:1.55;font-family:var(--font-body);">
                        I confirm that all information provided is accurate and I agree to Bikol's Craft
                        <a href="#" style="color:var(--gold-dark);text-decoration:underline;text-underline-offset:2px;">Terms of Service</a>
                        and
                        <a href="#" style="color:var(--gold-dark);text-decoration:underline;text-underline-offset:2px;">Privacy Policy</a>.
                    </span>
                </label>
            </div>

            <div class="bv-btn-row">
                <button type="button" class="bv-btn-back" onclick="goTo(3)">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 3L5 8l5 5"/></svg>
                    Back
                </button>
                <button type="submit" class="bv-btn-submit">
                    <span>Register as Supplier</span>
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg>
                </button>
            </div>
        </div>

    </form>
</div>

<script>
    /* ── STEP NAV ── */
    let currentStep = 1;
    const totalSteps = 4;

    function goTo(n) {
        if (n > currentStep && !validateStep(currentStep)) return;
        for (let i = 1; i <= totalSteps; i++) {
            document.getElementById('step' + i).classList.remove('active');
            const tab = document.getElementById('tab-' + i);
            tab.classList.remove('active', 'done');
            if (i < n) tab.classList.add('done');
        }
        document.getElementById('step' + n).classList.add('active');
        document.getElementById('tab-' + n).classList.add('active');
        currentStep = n;
        window.scrollTo({ top: 0, behavior: 'smooth' });
        if (n === 4) populateReview();
    }

    /* ── VALIDATION ── */
    function validateStep(step) {
        if (step === 2) {
            const fn = document.getElementById('first_name');
            const ln = document.getElementById('last_name');
            if (!fn.value.trim()) { fn.focus(); fn.style.borderColor = 'var(--danger)'; return false; }
            if (!ln.value.trim()) { ln.focus(); ln.style.borderColor = 'var(--danger)'; return false; }
        }
        if (step === 3) {
            /* At least one category must be checked */
            const checked = document.querySelectorAll('input[name="category_id[]"]:checked');
            const grid = document.getElementById('catGrid');
            if (checked.length === 0) {
                grid.classList.add('error');
                grid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return false;
            }
            grid.classList.remove('error');

            const exp  = document.getElementById('experience');
            const desc = document.getElementById('description');
            if (!exp.value)         { exp.focus();  exp.style.borderColor  = 'var(--danger)'; return false; }
            if (!desc.value.trim()) { desc.focus(); desc.style.borderColor = 'var(--danger)'; return false; }
        }
        return true;
    }

    /* Remove error highlight on change */
    document.querySelectorAll('.bv-input, .bv-select, .bv-textarea').forEach(el => {
        el.addEventListener('input',  () => el.style.borderColor = '');
        el.addEventListener('change', () => el.style.borderColor = '');
    });
    document.querySelectorAll('input[name="category_id[]"]').forEach(cb => {
        cb.addEventListener('change', () => {
            if (document.querySelectorAll('input[name="category_id[]"]:checked').length > 0) {
                document.getElementById('catGrid').classList.remove('error');
            }
        });
    });

    /* ── REVIEW SUMMARY ── */
    function populateReview() {
        const get = id => (document.getElementById(id)?.value || '').trim() || '—';
        const sel = id => {
            const el = document.getElementById(id);
            return el?.options[el.selectedIndex]?.text || '—';
        };

        document.getElementById('r-first_name').textContent    = get('first_name');
        document.getElementById('r-last_name').textContent     = get('last_name');
        document.getElementById('r-phone').textContent         = get('phone') || '—';
        document.getElementById('r-business_name').textContent = get('business_name') || '—';
        document.getElementById('r-tagline').textContent       = get('tagline') || '—';
        document.getElementById('r-city').textContent          = get('city') || '—';
        document.getElementById('r-province').textContent      = get('province') || '—';
        document.getElementById('r-price').textContent         = get('price') || '—';
        document.getElementById('r-experience').textContent    = sel('experience');

        /* Collect checked category names */
        const checkedCats = [...document.querySelectorAll('input[name="category_id[]"]:checked')]
            .map(cb => document.querySelector('label[for="' + cb.id + '"]').textContent.trim())
            .join(', ');
        document.getElementById('r-category').textContent = checkedCats || '—';
    }

    /* ── PHOTO UPLOAD ── */
    function handlePhotoUpload(input) {
        const file = input.files[0];
        if (!file) return;
        document.getElementById('photoFilename').textContent = file.name;
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('photoImg');
            img.src = e.target.result;
            img.style.display = 'block';
            document.querySelector('.bv-photo-circle-icon').style.display = 'none';
        };
        reader.readAsDataURL(file);
    }

    /* ── CHAR COUNTER ── */
    function updateCount(counterId, el, max) {
        const n = el.value.length;
        const counter = document.getElementById(counterId);
        counter.textContent = n + ' / ' + max;
        counter.style.color = n >= max * 0.9 ? 'var(--danger)' : 'var(--warm-grey)';
    }
    ['bio', 'description'].forEach(id => {
        const el = document.getElementById(id);
        if (el && el.value) {
            updateCount(id === 'bio' ? 'bioCount' : 'descCount', el, id === 'bio' ? 500 : 1000);
        }
    });

    /* ── AVAILABILITY TOGGLE ── */
    function toggleAvail() {
        const track = document.getElementById('availToggle');
        const input = document.getElementById('availInput');
        const chip  = document.getElementById('availChip');
        const isOn  = track.classList.toggle('on');
        input.value = isOn ? 1 : 0;
        chip.textContent  = isOn ? 'Available' : 'Unavailable';
        chip.className    = 'bv-avail-chip ' + (isOn ? 'yes' : 'no');
    }

    /* ── RESTORE STEP ON ERROR ── */
    @if($errors->any())
        @php
            $step2Fields = ['first_name', 'last_name', 'phone', 'photo'];
            $step3Fields = ['business_name', 'tagline', 'city', 'province', 'address', 'price', 'category_id', 'experience', 'bio', 'description'];
            $targetStep  = 4;
            foreach ($step2Fields as $f) { if ($errors->has($f)) { $targetStep = 2; break; } }
            if ($targetStep === 4) foreach ($step3Fields as $f) { if ($errors->has($f)) { $targetStep = 3; break; } }
        @endphp
        document.addEventListener('DOMContentLoaded', () => goTo({{ $targetStep }}));
    @endif
</script>

</x-supplier-layout>