<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap');

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

        /* ── WRAPPER ── */
        .fp-wrap {
            width: 100%;
            font-family: var(--font-body);
        }

        /* ── HEADER ── */
        .fp-form-header { margin-bottom: 1.75rem; }

        .fp-form-eyebrow {
            font-size: 0.6rem; letter-spacing: 0.2em; text-transform: uppercase;
            color: var(--gold-dark); font-weight: 700;
            display: flex; align-items: center; gap: 0.5rem;
            margin-bottom: 0.55rem;
        }
        .fp-form-eyebrow::before {
            content: ''; width: 18px; height: 1px; background: var(--gold);
        }

        .fp-form-title {
            font-family: var(--font-display);
            font-size: 1.6rem; font-weight: 700;
            color: var(--charcoal); line-height: 1.18;
            margin-bottom: 0.45rem;
        }
        .fp-form-title em { color: var(--gold-dark); font-style: italic; }

        .fp-form-sub {
            font-size: 0.8rem;
            color: var(--warm-grey);
            line-height: 1.65;
        }

        /* ── CARD ── */
        .fp-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.85rem;
            box-shadow: 0 4px 28px rgba(30,27,24,0.07);
            position: relative;
            overflow: hidden;
            animation: cardIn 0.45s cubic-bezier(0.4,0,0.2,1) both;
        }
        @keyframes cardIn {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: none; }
        }
        .fp-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, var(--gold), var(--blush-deep));
        }

        /* ── SESSION STATUS ── */
        .fp-status {
            background: rgba(201,168,76,0.08);
            border: 1px solid rgba(201,168,76,0.28);
            border-radius: 8px;
            padding: 0.7rem 0.9rem;
            font-size: 0.78rem;
            color: var(--gold-dark);
            margin-bottom: 1.2rem;
            display: flex; align-items: flex-start; gap: 0.5rem;
            line-height: 1.5;
        }
        .fp-status svg {
            width: 14px; height: 14px; flex-shrink: 0;
            margin-top: 1px; stroke: var(--gold); fill: none; stroke-width: 1.8;
        }

        /* ── FIELD ── */
        .fp-field { margin-bottom: 1.1rem; }

        .fp-label {
            display: block;
            font-size: 0.68rem; font-weight: 700;
            letter-spacing: 0.08em; text-transform: uppercase;
            color: var(--warm-grey);
            margin-bottom: 0.42rem;
        }

        .fp-input-wrap {
            position: relative;
            display: flex; align-items: center;
        }

        .fp-input-icon {
            position: absolute; left: 0.8rem;
            display: flex; align-items: center;
            pointer-events: none; color: #C8C1BA;
        }
        .fp-input-icon svg {
            width: 14px; height: 14px;
            stroke: currentColor; fill: none; stroke-width: 1.7;
        }

        .fp-input {
            width: 100%;
            padding: 0.72rem 0.9rem 0.72rem 2.5rem;
            border: 1.5px solid var(--border-md);
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.84rem;
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
        .fp-input.is-error {
            border-color: #E07070;
            box-shadow: 0 0 0 3px rgba(224,112,112,0.09);
        }

        .fp-error {
            margin-top: 0.38rem;
            font-size: 0.7rem; color: #C94444;
            display: flex; align-items: center; gap: 0.3rem;
        }
        .fp-error svg { width: 11px; height: 11px; flex-shrink: 0; }

        /* ── BUTTON ── */
        .fp-btn {
            width: 100%;
            padding: 0.78rem 1.5rem;
            background: var(--charcoal);
            color: var(--white);
            border: none; border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.76rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            cursor: pointer;
            position: relative; overflow: hidden;
            transition: transform 0.15s, box-shadow 0.15s;
            margin-top: 0.25rem;
        }
        .fp-btn::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            opacity: 0; transition: opacity 0.22s;
        }
        .fp-btn:hover::after  { opacity: 1; }
        .fp-btn:hover         { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(201,168,76,0.22); }
        .fp-btn:active        { transform: none; }
        .fp-btn-inner {
            position: relative; z-index: 1;
            display: flex; align-items: center; justify-content: center; gap: 0.45rem;
        }
        .fp-btn-inner svg { width: 13px; height: 13px; }

        /* ── DIVIDER ── */
        .fp-divider {
            display: flex; align-items: center; gap: 0.7rem;
            margin: 1.2rem 0;
        }
        .fp-divider::before,
        .fp-divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }
        .fp-divider span {
            font-size: 0.6rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase; color: #D0CAC3;
        }

        /* ── BACK LINK ── */
        .fp-back { text-align: center; }
        .fp-back a {
            font-size: 0.78rem; color: var(--warm-grey);
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 0.35rem;
            transition: color 0.2s;
        }
        .fp-back a:hover { color: var(--gold-dark); }
        .fp-back a svg { width: 11px; height: 11px; }
    </style>

    <div class="fp-wrap">

        {{-- Header --}}
        <div class="fp-form-header">
            <div class="fp-form-eyebrow">Forgot Password</div>
            <h2 class="fp-form-title">Recover your <em>account</em></h2>
            <p class="fp-form-sub">
                No problem — enter your email address and we'll send you a secure reset link right away.
            </p>
        </div>

        {{-- Card --}}
        <div class="fp-card">

            {{-- Session Status --}}
            @if (session('status'))
            <div class="fp-status">
                <svg viewBox="0 0 14 14">
                    <path d="M7 1L2 3.5v4C2 10.5 4.5 13 7 13s5-2.5 5-5.5v-4L7 1z"/>
                    <polyline points="4.5,7 6.5,9 9.5,5" stroke-width="1.6"/>
                </svg>
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
                            required autofocus autocomplete="email"
                            class="fp-input {{ $errors->get('email') ? 'is-error' : '' }}"
                            placeholder="you@example.com"
                        >
                    </div>
                    @foreach ($errors->get('email') as $message)
                    <div class="fp-error">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="6" cy="6" r="5"/>
                            <path d="M6 4v3M6 8.5v.5"/>
                        </svg>
                        {{ $message }}
                    </div>
                    @endforeach
                </div>

                {{-- Submit --}}
                <button type="submit" class="fp-btn">
                    <span class="fp-btn-inner">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M1 4l6 4 6-4M1 4v8h14V4"/>
                        </svg>
                        Email Password Reset Link
                    </span>
                </button>
            </form>
        </div>

        {{-- Divider --}}
        <div class="fp-divider"><span>or</span></div>

        {{-- Back to login --}}
        <div class="fp-back">
            <a href="{{ route('login') }}">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M8 1L3 6l5 5"/>
                </svg>
                Back to Sign In
            </a>
        </div>

    </div>

</x-guest-layout>