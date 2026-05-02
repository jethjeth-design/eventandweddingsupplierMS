<x-guest-layout>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap');

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
        --font-display:'Playfair Display', Georgia, serif;
        --font-body:   'DM Sans', sans-serif;
    }

    .vf-wrap {
        font-family: var(--font-body);
        width: 100%;
    }

    /* ── Top icon badge ── */
    .vf-icon-row {
        display: flex;
        justify-content: center;
        margin-bottom: 1.5rem;
    }
    .vf-icon {
        width: 68px; height: 68px;
        border-radius: 50%;
        background: rgba(201,168,76,0.1);
        border: 1.5px solid rgba(201,168,76,0.28);
        display: flex; align-items: center; justify-content: center;
    }
    .vf-icon svg { width: 30px; height: 30px; color: var(--gold); }

    /* ── Eyebrow ── */
    .vf-eyebrow {
        font-size: 0.6rem; letter-spacing: 0.2em; text-transform: uppercase;
        color: var(--gold-dark); font-weight: 600;
        display: flex; align-items: center; gap: 0.5rem;
        margin-bottom: 0.5rem; font-family: var(--font-body);
    }
    .vf-eyebrow::before { content: ''; width: 16px; height: 1px; background: var(--gold); }

    /* ── Heading ── */
    .vf-heading {
        font-family: var(--font-display);
        font-size: 1.45rem; font-weight: 700;
        color: var(--charcoal); line-height: 1.2;
        margin-bottom: 6px;
    }
    .vf-heading em { color: var(--gold-dark); font-style: italic; }

    /* ── Gold underline ── */
    .vf-rule {
        width: 36px; height: 2px;
        background: linear-gradient(90deg, var(--gold), var(--gold-light));
        border-radius: 99px; margin-bottom: 1.2rem;
    }

    /* ── Body text ── */
    .vf-body {
        font-size: 0.85rem; color: var(--warm-grey); line-height: 1.75;
        margin-bottom: 1.25rem;
    }
    .vf-body strong { color: var(--charcoal); }

    /* ── Success alert ── */
    .vf-alert {
        display: flex; align-items: flex-start; gap: 0.55rem;
        background: rgba(22,163,74,0.07);
        border: 1px solid rgba(22,163,74,0.2);
        border-left: 3px solid #16A34A;
        border-radius: 5px;
        padding: 0.75rem 1rem;
        font-size: 0.8rem; color: #166534; line-height: 1.55;
        margin-bottom: 1.25rem;
        font-family: var(--font-body);
    }
    .vf-alert svg { width: 15px; height: 15px; flex-shrink: 0; margin-top: 1px; color: #16A34A; }

    /* ── Info strip ── */
    .vf-info-strip {
        background: var(--ivory);
        border: 1px solid var(--border);
        border-left: 3px solid var(--gold);
        border-radius: 5px;
        padding: 0.75rem 1rem;
        font-size: 0.78rem; color: var(--warm-grey); line-height: 1.6;
        margin-bottom: 1.5rem;
        display: flex; align-items: flex-start; gap: 0.5rem;
    }
    .vf-info-strip svg { width: 14px; height: 14px; flex-shrink: 0; margin-top: 2px; color: var(--gold-dark); }

    /* ── Divider ── */
    .vf-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--border-md), transparent);
        margin-bottom: 1.25rem;
    }

    /* ── Actions row ── */
    .vf-actions {
        display: flex; align-items: center; justify-content: space-between; gap: 1rem;
        flex-wrap: wrap;
    }

    /* Primary button */
    .vf-btn-primary {
        display: inline-flex; align-items: center; gap: 0.45rem;
        padding: 0.65rem 1.4rem;
        background: var(--gold); color: var(--charcoal);
        border: none; border-radius: 4px;
        font-family: var(--font-body); font-size: 0.78rem; font-weight: 700;
        letter-spacing: 0.05em; text-transform: uppercase;
        cursor: pointer; transition: background 0.18s, transform 0.14s;
    }
    .vf-btn-primary:hover { background: var(--gold-light); transform: translateY(-1px); }
    .vf-btn-primary:active { transform: translateY(0); }
    .vf-btn-primary svg { width: 14px; height: 14px; }

    /* Ghost logout button */
    .vf-btn-logout {
        display: inline-flex; align-items: center; gap: 0.4rem;
        background: none; border: none;
        font-family: var(--font-body); font-size: 0.78rem;
        color: var(--warm-grey); cursor: pointer;
        padding: 0.65rem 0.5rem; border-radius: 4px;
        transition: color 0.18s;
    }
    .vf-btn-logout:hover { color: var(--charcoal); }
    .vf-btn-logout svg { width: 13px; height: 13px; }

    /* ── Steps hint ── */
    .vf-steps {
        margin-top: 1.5rem;
        padding-top: 1.25rem;
        border-top: 1px solid var(--border);
        display: flex; flex-direction: column; gap: 0.6rem;
    }
    .vf-step {
        display: flex; align-items: center; gap: 0.65rem;
        font-size: 0.75rem; color: var(--warm-grey);
    }
    .vf-step-num {
        width: 22px; height: 22px; border-radius: 50%; flex-shrink: 0;
        background: rgba(201,168,76,0.1); border: 1px solid rgba(201,168,76,0.25);
        font-size: 0.62rem; font-weight: 700; color: var(--gold-dark);
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display);
    }
</style>

<div class="vf-wrap">

    {{-- Icon --}}
    <div class="vf-icon-row">
        <div class="vf-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
    </div>

    {{-- Eyebrow + Heading --}}
    <div class="vf-eyebrow">Email Verification</div>
    <div class="vf-heading">Check your <em>inbox</em></div>
    <div class="vf-rule"></div>

    {{-- Body --}}
    <p class="vf-body">
        Thanks for signing up! We've sent a verification link to your registered email address.
        Click the link to activate your account and start exploring <strong>Bikol's Craft</strong>.
    </p>

    {{-- Success flash --}}
    @if (session('status') == 'verification-link-sent')
    <div class="vf-alert">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M9 12l2 2 4-4M5 10a5 5 0 1010 0A5 5 0 005 10z"/>
        </svg>
        <span>A new verification link has been sent to your email address.</span>
    </div>
    @endif

    {{-- Info strip --}}
    <div class="vf-info-strip">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <circle cx="10" cy="10" r="8"/><path d="M10 9v5M10 7h.01"/>
        </svg>
        <span>Didn't receive it? Check your spam folder, or click <strong>Resend</strong> below to get a fresh link.</span>
    </div>

    <div class="vf-divider"></div>

    {{-- Actions --}}
    <div class="vf-actions">

        {{-- Resend form --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="vf-btn-primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"/>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
                Resend Verification Email
            </button>
        </form>

        {{-- Logout form --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="vf-btn-logout">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/>
                </svg>
                Log Out
            </button>
        </form>

    </div>

    {{-- Steps hint --}}
    <div class="vf-steps">
        <div class="vf-step">
            <span class="vf-step-num">1</span>
            Open your email inbox
        </div>
        <div class="vf-step">
            <span class="vf-step-num">2</span>
            Find the email from Bikol's Craft
        </div>
        <div class="vf-step">
            <span class="vf-step-num">3</span>
            Click "Verify My Email" to activate your account
        </div>
    </div>

</div>

</x-guest-layout>