<x-client-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- ══════════════════════════════════════════
         EMAIL VERIFICATION BANNER (inline)
    ══════════════════════════════════════════ --}}
    @if(!auth()->user()->hasVerifiedEmail())
        <div class="verify-banner" id="verifyBanner">

            {{-- Dismiss --}}
            <button class="verify-dismiss" onclick="document.getElementById('verifyBanner').style.display='none'" aria-label="Dismiss">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M2 2l8 8M10 2l-8 8"/>
                </svg>
            </button>

            {{-- Left: icon + text --}}
            <div class="verify-banner-left">
                <div class="verify-banner-icon">
                    <svg viewBox="0 0 18 18">
                        <rect x="1" y="4" width="16" height="11" rx="2"/>
                        <polyline points="1,4 9,10 17,4"/>
                        <circle cx="14" cy="13" r="3.5" fill="rgba(201,168,76,0.15)" stroke-width="1.6"/>
                        <path d="M12.5 13l1 1 2-2" stroke-width="1.5"/>
                    </svg>
                </div>
                <div class="verify-banner-text">
                    <div class="verify-banner-title">Email not verified</div>
                    <div class="verify-banner-sub">
                        Verify your email to unlock <strong>booking</strong>, <strong>messaging</strong>, and full access.
                    </div>
                </div>
            </div>

            {{-- Right: resend button --}}
            <div class="verify-banner-right">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="verify-btn">
                        <span class="verify-btn-inner">
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M1 7h10M8 4l3 3-3 3"/>
                            </svg>
                            Resend Email
                        </span>
                    </button>
                </form>
            </div>

        </div>
    @endif

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap');
        :root {
            --gold:#C9A84C; --gold-dark:#8A6A1F; --gold-light:rgba(201,168,76,0.10);
            --ivory:#FAF7F2; --charcoal:#1E1B18; --warm-grey:#706B65;
            --border:#E5DDD5; --border-md:#E0D8D0; --white:#FFFFFF;
            --font-display:'Playfair Display',Georgia,serif;
            --font-body:'DM Sans',sans-serif;
        }

        /* ── VERIFY BANNER ── */
        .verify-banner {
            font-family: var(--font-body);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1rem 1.25rem;
            background: var(--white);
            border: 1px solid rgba(201,168,76,0.3);
            border-radius: 10px;
            box-shadow: 0 2px 16px rgba(30,27,24,0.07);
            overflow: hidden;
            margin-bottom: 1.5rem;
            animation: bannerIn 0.4s cubic-bezier(0.4,0,0.2,1) both;
        }
        @keyframes bannerIn {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: none; }
        }
        .verify-banner::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, var(--gold), #D4A090);
        }
        .verify-banner::after {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(rgba(201,168,76,0.04) 1px, transparent 1px);
            background-size: 18px 18px;
            pointer-events: none;
        }
        .verify-banner-left {
            display: flex; align-items: center; gap: 0.85rem;
            position: relative; z-index: 1; flex: 1; min-width: 0;
        }
        .verify-banner-icon {
            width: 38px; height: 38px; border-radius: 50%;
            background: rgba(201,168,76,0.1); border: 1px solid rgba(201,168,76,0.28);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .verify-banner-icon svg { width: 16px; height: 16px; stroke: var(--gold); fill: none; stroke-width: 1.8; }
        .verify-banner-title { font-family: var(--font-display); font-size: 0.88rem; font-weight: 700; color: var(--charcoal); margin-bottom: 0.1rem; }
        .verify-banner-sub { font-size: 0.74rem; color: var(--warm-grey); line-height: 1.5; }
        .verify-banner-sub strong { color: var(--gold-dark); font-weight: 600; }
        .verify-banner-right { position: relative; z-index: 1; flex-shrink: 0; }
        .verify-btn {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.52rem 1.1rem; background: var(--charcoal); color: var(--white);
            border: none; border-radius: 6px; font-family: var(--font-body);
            font-size: 0.7rem; font-weight: 700; letter-spacing: 0.07em; text-transform: uppercase;
            cursor: pointer; position: relative; overflow: hidden;
            transition: transform 0.15s, box-shadow 0.15s; white-space: nowrap;
        }
        .verify-btn::after { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, var(--gold-dark), var(--gold)); opacity: 0; transition: opacity 0.22s; }
        .verify-btn:hover::after { opacity: 1; }
        .verify-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(201,168,76,0.28); }
        .verify-btn:active { transform: none; }
        .verify-btn-inner { position: relative; z-index: 1; display: flex; align-items: center; gap: 0.38rem; }
        .verify-btn-inner svg { width: 12px; height: 12px; }
        .verify-dismiss {
            position: absolute; top: 0.6rem; right: 0.6rem; z-index: 2;
            width: 22px; height: 22px; border-radius: 50%;
            background: none; border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: #C0B8B0; transition: color 0.15s, background 0.15s; padding: 0;
        }
        .verify-dismiss:hover { color: var(--charcoal); background: rgba(30,27,24,0.06); }
        .verify-dismiss svg { width: 10px; height: 10px; }
        @media (max-width: 540px) {
            .verify-banner { flex-direction: column; align-items: flex-start; }
            .verify-banner-right { width: 100%; }
            .verify-btn { width: 100%; justify-content: center; }
        }

        /* ══════════════════════════════════════
           EMAIL VERIFICATION POPUP MODAL
        ══════════════════════════════════════ */
        .ev-modal-overlay {
            position: fixed; inset: 0; z-index: 9999;
            background: rgba(30,27,24,0.55);
            backdrop-filter: blur(4px);
            display: flex; align-items: center; justify-content: center;
            padding: 1.5rem;
            animation: overlayIn 0.3s ease both;
        }
        @keyframes overlayIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        .ev-modal-overlay.hiding {
            animation: overlayOut 0.25s ease both;
        }
        @keyframes overlayOut {
            from { opacity: 1; }
            to   { opacity: 0; }
        }

        .ev-modal {
            background: var(--white);
            border-radius: 16px;
            width: 100%; max-width: 440px;
            position: relative; overflow: hidden;
            box-shadow: 0 24px 64px rgba(30,27,24,0.22);
            animation: modalIn 0.35s cubic-bezier(0.34,1.56,0.64,1) both;
        }
        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.88) translateY(16px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }
        .ev-modal-overlay.hiding .ev-modal {
            animation: modalOut 0.22s ease both;
        }
        @keyframes modalOut {
            from { opacity: 1; transform: scale(1); }
            to   { opacity: 0; transform: scale(0.94); }
        }

        /* gold top bar */
        .ev-modal-bar {
            height: 3px;
            background: linear-gradient(90deg, var(--gold-dark), var(--gold), rgba(201,168,76,0.3));
        }

        /* dot grid bg */
        .ev-modal-bg {
            position: absolute; top: 3px; left: 0; right: 0;
            height: 120px; pointer-events: none; overflow: hidden;
        }
        .ev-modal-bg::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(rgba(201,168,76,0.06) 1px, transparent 1px);
            background-size: 18px 18px;
        }
        .ev-modal-bg::after {
            content: '';
            position: absolute; bottom: 0; left: 0; right: 0; height: 60px;
            background: linear-gradient(transparent, var(--white));
        }

        /* close btn */
        .ev-modal-close {
            position: absolute; top: 0.85rem; right: 0.85rem; z-index: 10;
            width: 28px; height: 28px; border-radius: 50%;
            background: rgba(30,27,24,0.06); border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: var(--warm-grey); transition: background 0.15s, color 0.15s;
        }
        .ev-modal-close:hover { background: rgba(30,27,24,0.12); color: var(--charcoal); }
        .ev-modal-close svg { width: 12px; height: 12px; }

        /* inner content */
        .ev-modal-inner {
            padding: 1.75rem 1.75rem 2rem;
            position: relative; z-index: 1;
        }

        /* icon */
        .ev-modal-icon {
            width: 56px; height: 56px; border-radius: 50%;
            background: rgba(201,168,76,0.1);
            border: 1.5px solid rgba(201,168,76,0.3);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.25rem;
            position: relative;
        }
        .ev-modal-icon svg { width: 26px; height: 26px; stroke: var(--gold); fill: none; stroke-width: 1.6; }
        /* pulsing ring */
        .ev-modal-icon::before {
            content: '';
            position: absolute; inset: -6px;
            border-radius: 50%; border: 1px solid rgba(201,168,76,0.2);
            animation: iconPulse 2s ease-in-out infinite;
        }
        .ev-modal-icon::after {
            content: '';
            position: absolute; inset: -12px;
            border-radius: 50%; border: 1px solid rgba(201,168,76,0.1);
            animation: iconPulse 2s ease-in-out 0.4s infinite;
        }
        @keyframes iconPulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50%       { transform: scale(1.06); opacity: 0.5; }
        }

        .ev-modal-eyebrow {
            font-size: 0.58rem; font-weight: 700; letter-spacing: 0.18em; text-transform: uppercase;
            color: var(--gold-dark); text-align: center; margin-bottom: 0.4rem;
            display: flex; align-items: center; justify-content: center; gap: 0.45rem;
        }
        .ev-modal-eyebrow::before,
        .ev-modal-eyebrow::after { content: ''; width: 20px; height: 1px; background: linear-gradient(90deg, transparent, var(--gold)); }
        .ev-modal-eyebrow::after { background: linear-gradient(90deg, var(--gold), transparent); }

        .ev-modal-title {
            font-family: var(--font-display);
            font-size: 1.35rem; font-weight: 700;
            color: var(--charcoal); text-align: center;
            line-height: 1.2; margin-bottom: 0.6rem;
        }
        .ev-modal-title em { color: var(--gold-dark); font-style: italic; }

        .ev-modal-desc {
            font-size: 0.8rem; color: var(--warm-grey);
            text-align: center; line-height: 1.65;
            margin-bottom: 1.4rem;
        }

        /* feature chips */
        .ev-modal-chips {
            display: flex; flex-wrap: wrap; justify-content: center; gap: 0.4rem;
            margin-bottom: 1.5rem;
        }
        .ev-chip {
            display: inline-flex; align-items: center; gap: 0.3rem;
            padding: 0.28rem 0.7rem;
            background: var(--gold-light); border: 1px solid rgba(201,168,76,0.25);
            border-radius: 999px; font-size: 0.62rem; font-weight: 600;
            color: var(--gold-dark); font-family: var(--font-body);
        }
        .ev-chip svg { width: 9px; height: 9px; }

        /* resend form button */
        .ev-modal-btn {
            width: 100%;
            padding: 0.82rem 1.5rem;
            background: var(--charcoal); color: var(--white);
            border: none; border-radius: 8px;
            font-family: var(--font-body); font-size: 0.76rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            cursor: pointer; position: relative; overflow: hidden;
            transition: transform 0.15s, box-shadow 0.15s;
            margin-bottom: 0.75rem;
        }
        .ev-modal-btn::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            opacity: 0; transition: opacity 0.22s;
        }
        .ev-modal-btn:hover::after { opacity: 1; }
        .ev-modal-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(201,168,76,0.25); }
        .ev-modal-btn:active { transform: none; }
        .ev-modal-btn-inner {
            position: relative; z-index: 1;
            display: flex; align-items: center; justify-content: center; gap: 0.45rem;
        }
        .ev-modal-btn-inner svg { width: 14px; height: 14px; }

        /* dismiss text link */
        .ev-modal-skip {
            display: block; text-align: center;
            font-size: 0.74rem; color: var(--warm-grey); cursor: pointer;
            transition: color 0.15s; background: none; border: none;
            font-family: var(--font-body); width: 100%;
        }
        .ev-modal-skip:hover { color: var(--charcoal); }

        /* ── Dashboard styles (unchanged) ── */
        .cd-page { padding: 1.5rem; max-width: 1100px; margin: 0 auto; }
        .cd-top { display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:.75rem; margin-bottom:1.5rem; }
        .cd-title { font-family:var(--font-display); font-size:1.65rem; font-weight:700; color:var(--charcoal); line-height:1.15; }
        .cd-title em { font-style:italic; color:var(--gold-dark); }
        .cd-subtitle { font-size:.76rem; color:var(--warm-grey); margin-top:.2rem; font-family:var(--font-body); }
        .cd-welcome-chip {
            display:inline-flex; align-items:center; gap:.4rem;
            font-size:.68rem; font-weight:500; letter-spacing:.04em;
            color:var(--gold-dark); background:var(--gold-light);
            border:1px solid rgba(201,168,76,.3); padding:.3rem .85rem;
            border-radius:20px; font-family:var(--font-body); white-space:nowrap;
        }
        .cd-welcome-chip svg { width:11px; height:11px; }

        .cd-stats { display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-bottom:1.5rem; }
        @media(max-width:700px) { .cd-stats { grid-template-columns:1fr 1fr; } }
        @media(max-width:420px) { .cd-stats { grid-template-columns:1fr; } }

        .cd-stat {
            background:var(--white); border:1.5px solid var(--border); border-radius:12px;
            padding:1.1rem 1.25rem; position:relative; overflow:hidden;
            transition:box-shadow .2s, border-color .2s;
        }
        .cd-stat:hover { box-shadow:0 4px 18px rgba(30,27,24,.08); border-color:rgba(201,168,76,.35); }
        .cd-stat::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; border-radius:12px 12px 0 0; }
        .cd-stat.total::before   { background:linear-gradient(90deg,var(--gold-dark),var(--gold)); }
        .cd-stat.pending::before  { background:linear-gradient(90deg,#D97706,#FBBF24); }
        .cd-stat.confirmed::before{ background:linear-gradient(90deg,#15803D,#4ADE80); }
        .cd-stat.completed::before{ background:linear-gradient(90deg,#6B6560,#B0A89E); }

        .cd-stat-icon { width:34px; height:34px; border-radius:8px; margin-bottom:.75rem; display:flex; align-items:center; justify-content:center; }
        .cd-stat-icon svg { width:16px; height:16px; }
        .cd-stat.total     .cd-stat-icon { background:var(--gold-light); color:var(--gold-dark); }
        .cd-stat.pending   .cd-stat-icon { background:rgba(251,191,36,.12); color:#D97706; }
        .cd-stat.confirmed .cd-stat-icon { background:rgba(74,222,128,.12); color:#15803D; }
        .cd-stat.completed .cd-stat-icon { background:rgba(176,168,158,.12); color:#6B6560; }

        .cd-stat-num { font-family:var(--font-display); font-size:1.9rem; font-weight:700; line-height:1; margin-bottom:.2rem; }
        .cd-stat.total    .cd-stat-num { color:var(--gold-dark); }
        .cd-stat.pending  .cd-stat-num { color:#D97706; }
        .cd-stat.confirmed .cd-stat-num { color:#15803D; }
        .cd-stat.completed .cd-stat-num { color:#6B6560; }
        .cd-stat-label { font-size:.62rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--warm-grey); font-family:var(--font-body); }

        .cd-grid { display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; }
        @media(max-width:700px) { .cd-grid { grid-template-columns:1fr; } }

        .cd-card { background:var(--white); border:1.5px solid var(--border); border-radius:12px; overflow:hidden; box-shadow:0 1px 10px rgba(30,27,24,.05); }
        .cd-card-bar { height:3px; background:linear-gradient(90deg,var(--gold-dark),var(--gold),rgba(201,168,76,.25)); }
        .cd-card-head { display:flex; align-items:center; gap:.5rem; padding:.85rem 1.1rem; border-bottom:1px solid var(--border); background:rgba(201,168,76,.03); }
        .cd-card-head-title { font-size:.6rem; font-weight:700; letter-spacing:.16em; text-transform:uppercase; color:var(--gold-dark); font-family:var(--font-body); display:flex; align-items:center; gap:.4rem; }
        .cd-card-head-title svg { width:12px; height:12px; flex-shrink:0; }
        .cd-card-head-title::after { content:''; flex:1; height:1px; background:linear-gradient(90deg,rgba(201,168,76,.35),transparent); }
        .cd-card-body { padding:.85rem 1.1rem; }

        .cd-item { padding:.75rem .9rem; border-radius:8px; border:1px solid var(--border); background:var(--ivory); margin-bottom:.6rem; transition:background .15s, border-color .15s; position:relative; }
        .cd-item:last-child { margin-bottom:0; }
        .cd-item:hover { background:rgba(201,168,76,.05); border-color:rgba(201,168,76,.3); }
        .cd-item-name { font-family:var(--font-display); font-size:.88rem; font-weight:700; color:var(--charcoal); margin-bottom:.25rem; line-height:1.2; }
        .cd-item-meta { font-size:.74rem; color:var(--warm-grey); font-family:var(--font-body); line-height:1.6; }
        .cd-item-meta span { display:inline-flex; align-items:center; gap:.28rem; }
        .cd-item-meta svg { width:11px; height:11px; color:var(--gold-dark); opacity:.7; flex-shrink:0; }
        .cd-item-footer { display:flex; align-items:center; justify-content:space-between; margin-top:.45rem; flex-wrap:wrap; gap:.35rem; }
        .cd-item-price { font-family:var(--font-display); font-size:.88rem; font-weight:700; color:var(--gold-dark); }
        .cd-item-price small { font-size:.62rem; font-weight:400; color:var(--warm-grey); font-family:var(--font-body); margin-left:2px; }

        .cd-badge { display:inline-flex; align-items:center; gap:.3rem; padding:.2rem .6rem; border-radius:20px; font-size:.62rem; font-weight:700; letter-spacing:.04em; text-transform:uppercase; font-family:var(--font-body); white-space:nowrap; }
        .cd-badge-dot { width:6px; height:6px; border-radius:50%; flex-shrink:0; }
        .cd-badge.pending    { background:#FEF3C7; color:#92400E; border:1px solid #FCD34D; }
        .cd-badge.pending    .cd-badge-dot { background:#F59E0B; }
        .cd-badge.confirmed  { background:#F0FDF4; color:#15803D; border:1px solid #BBF7D0; }
        .cd-badge.confirmed  .cd-badge-dot { background:#22C55E; }
        .cd-badge.cancelled  { background:#FEF2F2; color:#DC2626; border:1px solid #FECACA; }
        .cd-badge.cancelled  .cd-badge-dot { background:#DC2626; }
        .cd-badge.completed  { background:#F8FAFC; color:#6B6560; border:1px solid var(--border-md); }
        .cd-badge.completed  .cd-badge-dot { background:#9CA3AF; }

        .cd-empty { text-align:center; padding:2rem 1rem; color:var(--warm-grey); font-size:.8rem; font-family:var(--font-body); }
        .cd-empty svg { width:36px; height:36px; color:#DDD4C8; margin:0 auto .6rem; display:block; }

        .ev-alert-success { display:flex; align-items:center; gap:.65rem; background:#F0FDF4; border:1px solid #A7F3D0; border-radius:8px; padding:.75rem 1rem; font-size:.82rem; color:#065F46; margin-bottom:1.25rem; }
        .ev-alert-success svg { width:16px; height:16px; color:#10B981; flex-shrink:0; }
        .ev-alert-error { display:flex; align-items:center; gap:.65rem; background:#FEF2F2; border:1px solid #FCA5A5; border-radius:8px; padding:.75rem 1rem; font-size:.82rem; color:#991B1B; margin-bottom:1.25rem; }
        .ev-alert-error svg { width:16px; height:16px; color:#EF4444; flex-shrink:0; }
    </style>

    {{-- ══════════════════════════════════════════
         EMAIL VERIFICATION POPUP MODAL
         Auto-shows on page load if not verified
    ══════════════════════════════════════════ --}}
    @if(!auth()->user()->hasVerifiedEmail())
    <div class="ev-modal-overlay" id="evModalOverlay">
        <div class="ev-modal" id="evModal" role="dialog" aria-modal="true" aria-labelledby="evModalTitle">

            <div class="ev-modal-bar"></div>
            <div class="ev-modal-bg"></div>

            {{-- Close --}}
            <button class="ev-modal-close" id="evModalClose" aria-label="Close">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M2 2l8 8M10 2l-8 8"/>
                </svg>
            </button>

            <div class="ev-modal-inner">

                {{-- Icon --}}
                <div class="ev-modal-icon">
                    <svg viewBox="0 0 28 28">
                        <rect x="2" y="6" width="24" height="17" rx="3"/>
                        <polyline points="2,6 14,16 26,6"/>
                        <circle cx="21" cy="20" r="5" fill="rgba(201,168,76,0.12)" stroke-width="1.6"/>
                        <path d="M18.8 20l1.5 1.5 2.8-2.8" stroke-width="1.5"/>
                    </svg>
                </div>

                {{-- Eyebrow --}}
                <div class="ev-modal-eyebrow">Action Required</div>

                {{-- Title --}}
                <h2 class="ev-modal-title" id="evModalTitle">
                    Verify your <em>email address</em>
                </h2>

                {{-- Description --}}
                <p class="ev-modal-desc">
                    We sent a verification link to <strong style="color:var(--charcoal);">{{ auth()->user()->email }}</strong>. Please check your inbox and click the link to activate your account.
                </p>

                {{-- Feature chips --}}
                <div class="ev-modal-chips">
                    <span class="ev-chip">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="2" width="10" height="8" rx="1.5"/><path d="M1 4l5 3 5-3"/></svg>
                        Booking
                    </span>
                    <span class="ev-chip">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1 9V3a1 1 0 011-1h8a1 1 0 011 1v4a1 1 0 01-1 1H4L1 9z"/></svg>
                        Messaging
                    </span>
                    <span class="ev-chip">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 6l3 3 5-5"/></svg>
                        Full Access
                    </span>
                </div>

                {{-- Resend button --}}
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="ev-modal-btn">
                        <span class="ev-modal-btn-inner">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M1 4l6 4 6-4M1 4v9h14V4"/>
                            </svg>
                            Resend Verification Email
                        </span>
                    </button>
                </form>

                {{-- Dismiss --}}
                <button class="ev-modal-skip" id="evModalSkip">
                    I'll do this later
                </button>

            </div>
        </div>
    </div>
    @endif

    {{-- Alerts --}}
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

    <div class="cd-page">

        {{-- ── Top header ── --}}
        <div class="cd-top">
            <div>
                <h1 class="cd-title">Client <em>Dashboard</em></h1>
                <p class="cd-subtitle">Welcome back — here's what's happening with your events</p>
            </div>
            <div class="cd-welcome-chip">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="8" cy="6" r="3"/><path d="M2 14c0-3 2.7-5 6-5s6 2 6 5"/>
                </svg>
                {{ Auth::user()->name }}
            </div>
        </div>

        {{-- ── Stat cards ── --}}
        <div class="cd-stats">
            <div class="cd-stat total">
                <div class="cd-stat-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M9 12l2 2 4-4M7 3H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2h-2"/>
                        <rect x="7" y="1" width="6" height="4" rx="1"/>
                    </svg>
                </div>
                <div class="cd-stat-num">{{ $totalBookings }}</div>
                <div class="cd-stat-label">Total Bookings</div>
            </div>

            <div class="cd-stat pending">
                <div class="cd-stat-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="10" r="8"/><path d="M10 6v4l3 3"/>
                    </svg>
                </div>
                <div class="cd-stat-num">{{ $pending }}</div>
                <div class="cd-stat-label">Pending</div>
            </div>

            <div class="cd-stat confirmed">
                <div class="cd-stat-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M4 10l5 5 7-8"/>
                    </svg>
                </div>
                <div class="cd-stat-num">{{ $confirmed }}</div>
                <div class="cd-stat-label">Confirmed</div>
            </div>

            <div class="cd-stat completed">
                <div class="cd-stat-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="3" y="4" width="14" height="13" rx="2"/>
                        <path d="M7 2v4M13 2v4M3 9h14"/>
                    </svg>
                </div>
                <div class="cd-stat-num">{{ $completed }}</div>
                <div class="cd-stat-label">Completed</div>
            </div>
        </div>

        {{-- ── Two-column grid ── --}}
        @php
            $now = \Carbon\Carbon::now();
            $upcoming = $bookings->filter(function ($booking) use ($now) {
                return \Carbon\Carbon::parse($booking->event_date)->greaterThanOrEqualTo($now);
            });
        @endphp

        <div class="cd-grid">

            {{-- ── Upcoming Events ── --}}
            <div class="cd-card">
                <div class="cd-card-bar"></div>
                <div class="cd-card-head">
                    <div class="cd-card-head-title">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="1" y="2" width="12" height="11" rx="1.5"/>
                            <path d="M4 1v2M10 1v2M1 6h12"/>
                        </svg>
                        Upcoming Events
                    </div>
                </div>
                <div class="cd-card-body">
                    @forelse($upcoming as $booking)
                    <div class="cd-item">
                        <div class="cd-item-name">
                            {{ $booking->event->event_name ?? 'Unnamed Event' }}
                        </div>
                        <div class="cd-item-meta">
                            <span>
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <rect x="1" y="2" width="12" height="11" rx="1.5"/>
                                    <path d="M4 1v2M10 1v2M1 6h12"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($booking->event_date)->format('M d, Y') }}
                            </span>
                            &nbsp;·&nbsp;
                            <span>
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <rect x="2" y="6" width="10" height="7" rx="1"/>
                                    <path d="M4 6V4a3 3 0 016 0v2"/>
                                </svg>
                                {{ $booking->package->supplier->business_name ?? 'N/A' }}
                            </span>
                        </div>
                        <div class="cd-item-footer">
                            <span></span>
                            <span class="cd-badge {{ $booking->status }}">
                                <span class="cd-badge-dot"></span>
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="cd-empty">
                        <svg viewBox="0 0 40 40" fill="none" stroke="currentColor" stroke-width="1.3">
                            <rect x="5" y="7" width="30" height="27" rx="3"/>
                            <path d="M13 4v6M27 4v6M5 16h30"/>
                        </svg>
                        No upcoming events.
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- ── Recent Bookings ── --}}
            <div class="cd-card">
                <div class="cd-card-bar"></div>
                <div class="cd-card-head">
                    <div class="cd-card-head-title">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M6 9l1.5 1.5L11 6M5 2H3.5A1.5 1.5 0 002 3.5v9A1.5 1.5 0 003.5 14h7A1.5 1.5 0 0012 12.5V3.5A1.5 1.5 0 0010.5 2H9"/>
                            <rect x="5" y="1" width="4" height="2.5" rx=".75"/>
                        </svg>
                        Recent Bookings
                    </div>
                </div>
                <div class="cd-card-body">
                    @forelse($bookings->take(5) as $booking)
                    <div class="cd-item">
                        <div class="cd-item-name">
                            {{ $booking->package->name ?? 'Unnamed Package' }}
                        </div>
                        <div class="cd-item-meta">
                            <span>
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <rect x="1" y="2" width="12" height="11" rx="1.5"/>
                                    <path d="M4 1v2M10 1v2M1 6h12"/>
                                </svg>
                                {{ $booking->event->event_name ?? 'N/A' }}
                            </span>
                        </div>
                        <div class="cd-item-footer">
                            <div class="cd-item-price">
                                ₱{{ number_format($booking->total_price) }}
                                <small>total</small>
                            </div>
                            <span class="cd-badge {{ $booking->status }}">
                                <span class="cd-badge-dot"></span>
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="cd-empty">
                        <svg viewBox="0 0 40 40" fill="none" stroke="currentColor" stroke-width="1.3">
                            <path d="M10 8h20a2 2 0 012 2v20a2 2 0 01-2 2H10a2 2 0 01-2-2V10a2 2 0 012-2z"/>
                            <path d="M14 17h12M14 22h8"/>
                        </svg>
                        No bookings yet.
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    {{-- ── Modal JS ── --}}
    <script>
    (function () {
        const overlay  = document.getElementById('evModalOverlay');
        const closeBtn = document.getElementById('evModalClose');
        const skipBtn  = document.getElementById('evModalSkip');
        if (!overlay) return; // verified users — nothing to do

        // Dismiss with animation
        function closeModal() {
            overlay.classList.add('hiding');
            overlay.addEventListener('animationend', () => overlay.remove(), { once: true });
        }

        // Close on X button
        if (closeBtn) closeBtn.addEventListener('click', closeModal);

        // Close on "I'll do this later"
        if (skipBtn) skipBtn.addEventListener('click', closeModal);

        // Close on overlay click (outside modal card)
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) closeModal();
        });

        // Close on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeModal();
        });
    })();
    </script>

</x-client-layout>