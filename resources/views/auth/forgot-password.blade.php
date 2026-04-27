<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password — Bikol's Craft</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --gold:        #C9A84C;
            --gold-light:  #E8C97A;
            --gold-dark:   #8A6A1F;
            --blush:       #F2E0D8;
            --blush-deep:  #D4A090;
            --ivory:       #FAF7F2;
            --charcoal:    #1E1B18;
            --warm-grey:   #6B6560;
            --white:       #FFFFFF;
            --border:      #F0EBE5;
            --border-md:   #E0D8D0;
            --font-display:'Playfair Display', Georgia, serif;
            --font-body:   'DM Sans', sans-serif;
        }

        html, body {
            min-height: 100vh;
            font-family: var(--font-body);
            background: var(--charcoal);
            color: var(--charcoal);
            overflow-x: hidden;
        }

        /* ── PAGE WRAPPER ── */
        .fp-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            position: relative;
        }

        /* ── LEFT PANEL (decorative) ── */
        .fp-left {
            background: var(--charcoal);
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            padding: 3rem 4rem;
            overflow: hidden;
        }

        /* dot grid */
        .fp-left::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(rgba(201,168,76,0.08) 1px, transparent 1px);
            background-size: 22px 22px;
        }

        /* gold line accent bottom */
        .fp-left::after {
            content: '';
            position: absolute; top: 0; right: 0; bottom: 0; width: 1px;
            background: linear-gradient(180deg, transparent, var(--gold), transparent);
        }

        /* floating decorative ring */
        .fp-ring {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(201,168,76,0.12);
            pointer-events: none;
        }
        .fp-ring-1 { width: 340px; height: 340px; bottom: -80px; right: -80px; }
        .fp-ring-2 { width: 200px; height: 200px; bottom: -20px; right: -20px; border-color: rgba(201,168,76,0.2); }
        .fp-ring-3 { width: 480px; height: 480px; top: -160px; left: -140px; }

        .fp-left-inner { position: relative; z-index: 1; }

        .fp-brand {
            font-family: var(--font-display);
            font-size: 1.75rem; font-weight: 700;
            color: var(--white);
            text-decoration: none;
            display: inline-block;
            margin-bottom: 3rem;
        }
        .fp-brand span { color: var(--gold); font-style: italic; }

        .fp-eyebrow {
            font-size: 0.6rem; letter-spacing: 0.22em; text-transform: uppercase;
            color: var(--gold); font-weight: 600; margin-bottom: 0.75rem;
            display: flex; align-items: center; gap: 0.6rem;
        }
        .fp-eyebrow::before { content: ''; width: 24px; height: 1px; background: var(--gold); }

        .fp-headline {
            font-family: var(--font-display);
            font-size: clamp(1.8rem, 3vw, 2.6rem);
            font-weight: 700;
            color: var(--white);
            line-height: 1.15;
            margin-bottom: 1.1rem;
        }
        .fp-headline em { color: var(--gold-light); font-style: italic; }

        .fp-desc {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.42);
            line-height: 1.7;
            max-width: 320px;
            margin-bottom: 2.5rem;
        }

        /* trust badges */
        .fp-badges { display: flex; flex-direction: column; gap: 0.7rem; }
        .fp-badge {
            display: flex; align-items: center; gap: 0.65rem;
            font-size: 0.76rem; color: rgba(255,255,255,0.5);
        }
        .fp-badge-dot {
            width: 24px; height: 24px; border-radius: 50%;
            background: rgba(201,168,76,0.12);
            border: 1px solid rgba(201,168,76,0.25);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .fp-badge-dot svg { width: 11px; height: 11px; stroke: var(--gold); fill: none; stroke-width: 1.8; }

        /* ── RIGHT PANEL (form) ── */
        .fp-right {
            background: var(--ivory);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            position: relative;
        }

        .fp-form-wrap {
            width: 100%;
            max-width: 420px;
        }

        /* form header */
        .fp-form-header {
            margin-bottom: 2rem;
        }
        .fp-form-eyebrow {
            font-size: 0.6rem; letter-spacing: 0.2em; text-transform: uppercase;
            color: var(--gold-dark); font-weight: 700;
            display: flex; align-items: center; gap: 0.5rem;
            margin-bottom: 0.6rem;
        }
        .fp-form-eyebrow::before { content: ''; width: 18px; height: 1px; background: var(--gold); }
        .fp-form-title {
            font-family: var(--font-display);
            font-size: 1.65rem; font-weight: 700;
            color: var(--charcoal); line-height: 1.18;
            margin-bottom: 0.5rem;
        }
        .fp-form-title em { color: var(--gold-dark); font-style: italic; }
        .fp-form-sub {
            font-size: 0.8rem;
            color: var(--warm-grey);
            line-height: 1.65;
        }

        /* card */
        .fp-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 2rem;
            box-shadow: 0 4px 28px rgba(30,27,24,0.07);
            position: relative;
            overflow: hidden;
            animation: cardIn 0.5s cubic-bezier(0.4,0,0.2,1) both;
        }
        @keyframes cardIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: none; }
        }
        .fp-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, var(--gold), var(--blush-deep));
        }

        /* ── SESSION STATUS ── */
        .fp-status {
            background: rgba(201,168,76,0.1);
            border: 1px solid rgba(201,168,76,0.3);
            border-radius: 7px;
            padding: 0.7rem 1rem;
            font-size: 0.78rem;
            color: var(--gold-dark);
            margin-bottom: 1.2rem;
            display: flex; align-items: flex-start; gap: 0.5rem;
        }
        .fp-status svg { width: 14px; height: 14px; flex-shrink: 0; margin-top: 1px; stroke: var(--gold); fill: none; stroke-width: 1.8; }

        /* ── FORM FIELDS ── */
        .fp-field { margin-bottom: 1.2rem; }
        .fp-label {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--warm-grey);
            margin-bottom: 0.45rem;
        }
        .fp-input-wrap {
            position: relative;
            display: flex; align-items: center;
        }
        .fp-input-icon {
            position: absolute; left: 0.85rem;
            display: flex; align-items: center;
            pointer-events: none;
            color: #C0B8B0;
        }
        .fp-input-icon svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 1.7; }
        .fp-input {
            width: 100%;
            padding: 0.75rem 0.9rem 0.75rem 2.6rem;
            border: 1.5px solid var(--border-md);
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.85rem;
            color: var(--charcoal);
            background: var(--ivory);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }
        .fp-input::placeholder { color: #C8C1BA; }
        .fp-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.12);
            background: var(--white);
        }
        .fp-input.is-error { border-color: #E07070; box-shadow: 0 0 0 3px rgba(224,112,112,0.1); }

        /* error text */
        .fp-error {
            margin-top: 0.4rem;
            font-size: 0.72rem;
            color: #C94444;
            display: flex; align-items: center; gap: 0.3rem;
        }
        .fp-error svg { width: 11px; height: 11px; flex-shrink: 0; }

        /* ── SUBMIT BUTTON ── */
        .fp-btn {
            width: 100%;
            padding: 0.8rem 1.5rem;
            background: var(--charcoal);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform 0.15s, box-shadow 0.15s;
            margin-top: 0.4rem;
        }
        .fp-btn::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            opacity: 0;
            transition: opacity 0.22s;
        }
        .fp-btn:hover::after { opacity: 1; }
        .fp-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(201,168,76,0.25); }
        .fp-btn:active { transform: none; }
        .fp-btn-inner { position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; gap: 0.5rem; }
        .fp-btn svg { width: 14px; height: 14px; }

        /* ── BACK LINK ── */
        .fp-back {
            text-align: center;
            margin-top: 1.4rem;
        }
        .fp-back a {
            font-size: 0.78rem;
            color: var(--warm-grey);
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 0.35rem;
            transition: color 0.2s;
        }
        .fp-back a:hover { color: var(--gold-dark); }
        .fp-back a svg { width: 12px; height: 12px; }

        /* ── DIVIDER ── */
        .fp-divider {
            display: flex; align-items: center; gap: 0.75rem;
            margin: 1.25rem 0;
        }
        .fp-divider::before, .fp-divider::after {
            content: ''; flex: 1; height: 1px; background: var(--border);
        }
        .fp-divider span {
            font-size: 0.62rem; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase; color: #D0CAC3;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .fp-page { grid-template-columns: 1fr; }
            .fp-left  { display: none; }
            .fp-right { padding: 2rem 1.25rem; min-height: 100vh; }
            .fp-form-wrap { max-width: 100%; }
        }
    </style>
</head>
<body>

<div class="fp-page">

    {{-- ── LEFT DECORATIVE PANEL ── --}}
    <div class="fp-left">
        <div class="fp-ring fp-ring-3"></div>
        <div class="fp-ring fp-ring-1"></div>
        <div class="fp-ring fp-ring-2"></div>

        <div class="fp-left-inner">
            <a href="{{ route('welcomepage.welcome') }}" class="fp-brand">
                Bikol's<span>Craft</span>
            </a>

            <div class="fp-eyebrow">Account Recovery</div>
            <h1 class="fp-headline">
                Reset your<br><em>password</em> safely
            </h1>
            <p class="fp-desc">
                We'll send a secure link to your email so you can create a new password and get back to discovering amazing event suppliers.
            </p>

            <div class="fp-badges">
                <div class="fp-badge">
                    <div class="fp-badge-dot">
                        <svg viewBox="0 0 14 14"><path d="M7 1L2 3.5v4C2 10.5 4.5 13 7 13s5-2.5 5-5.5v-4L7 1z"/></svg>
                    </div>
                    Secure encrypted reset link
                </div>
                <div class="fp-badge">
                    <div class="fp-badge-dot">
                        <svg viewBox="0 0 14 14"><circle cx="7" cy="7" r="5.5"/><path d="M7 4.5v3l2 1.5"/></svg>
                    </div>
                    Link expires in 60 minutes
                </div>
                <div class="fp-badge">
                    <div class="fp-badge-dot">
                        <svg viewBox="0 0 14 14"><path d="M1 4l6 4 6-4M1 4v7h12V4"/></svg>
                    </div>
                    Sent to your registered email
                </div>
            </div>
        </div>
    </div>

    {{-- ── RIGHT FORM PANEL ── --}}
    <div class="fp-right">
        <div class="fp-form-wrap">

            {{-- Mobile brand --}}
            <div style="display:none;margin-bottom:2rem;" class="mob-brand">
                <a href="{{ route('welcomepage.welcome') }}" style="font-family:var(--font-display);font-size:1.4rem;font-weight:700;color:var(--charcoal);text-decoration:none;">
                    Bikol's<span style="color:var(--gold);font-style:italic;">Craft</span>
                </a>
            </div>

            <div class="fp-form-header">
                <div class="fp-form-eyebrow">Forgot Password</div>
                <h2 class="fp-form-title">Recover your <em>account</em></h2>
                <p class="fp-form-sub">
                    No problem — enter your email address and we'll send you a reset link right away.
                </p>
            </div>

            <div class="fp-card">

                {{-- Session Status --}}
                @if (session('status'))
                <div class="fp-status">
                    <svg viewBox="0 0 14 14"><path d="M7 1L2 3.5v4C2 10.5 4.5 13 7 13s5-2.5 5-5.5v-4L7 1z"/><polyline points="4.5,7 6.5,9 9.5,5" stroke-width="1.6"/></svg>
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="fp-field">
                        <label class="fp-label" for="email">Email Address</label>
                        <div class="fp-input-wrap">
                            <span class="fp-input-icon">
                                <svg viewBox="0 0 16 16">
                                    <rect x="1" y="3" width="14" height="10" rx="2"/>
                                    <polyline points="1,3 8,9 15,3"/>
                                </svg>
                            </span>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="email"
                                class="fp-input {{ $errors->get('email') ? 'is-error' : '' }}"
                                placeholder="you@example.com"
                            >
                        </div>
                        @foreach ($errors->get('email') as $message)
                        <div class="fp-error">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="6" cy="6" r="5"/><path d="M6 4v3M6 8.5v.5"/></svg>
                            {{ $message }}
                        </div>
                        @endforeach
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="fp-btn">
                        <span class="fp-btn-inner">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M1 8l4 4 10-10"/>
                            </svg>
                            Email Password Reset Link
                        </span>
                    </button>
                </form>
            </div>

            <div class="fp-divider"><span>or</span></div>

            <div class="fp-back">
                <a href="{{ route('login') }}">
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M8 1L3 6l5 5"/>
                    </svg>
                    Back to Sign In
                </a>
            </div>

        </div>
    </div>

</div>

<style>
@media (max-width: 768px) {
    .mob-brand { display: block !important; }
}
</style>

</body>
</html>