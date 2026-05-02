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
        .rp-wrap {
            width: 100%;
            font-family: var(--font-body);
        }

        /* ── HEADER ── */
        .rp-form-header { margin-bottom: 1.75rem; }

        .rp-form-eyebrow {
            font-size: 0.6rem; letter-spacing: 0.2em; text-transform: uppercase;
            color: var(--gold-dark); font-weight: 700;
            display: flex; align-items: center; gap: 0.5rem;
            margin-bottom: 0.55rem;
        }
        .rp-form-eyebrow::before {
            content: ''; width: 18px; height: 1px; background: var(--gold);
        }

        .rp-form-title {
            font-family: var(--font-display);
            font-size: 1.6rem; font-weight: 700;
            color: var(--charcoal); line-height: 1.18;
            margin-bottom: 0.45rem;
        }
        .rp-form-title em { color: var(--gold-dark); font-style: italic; }

        .rp-form-sub {
            font-size: 0.8rem;
            color: var(--warm-grey);
            line-height: 1.65;
        }

        /* ── CARD ── */
        .rp-card {
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
        .rp-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, var(--gold), var(--blush-deep));
        }

        /* ── FIELD ── */
        .rp-field { margin-bottom: 1.1rem; }

        .rp-label {
            display: block;
            font-size: 0.68rem; font-weight: 700;
            letter-spacing: 0.08em; text-transform: uppercase;
            color: var(--warm-grey);
            margin-bottom: 0.42rem;
        }

        .rp-input-wrap {
            position: relative;
            display: flex; align-items: center;
        }

        .rp-input-icon {
            position: absolute; left: 0.8rem;
            display: flex; align-items: center;
            pointer-events: none; color: #C8C1BA;
        }
        .rp-input-icon svg {
            width: 14px; height: 14px;
            stroke: currentColor; fill: none; stroke-width: 1.7;
        }

        .rp-input {
            width: 100%;
            padding: 0.72rem 2.8rem 0.72rem 2.5rem;
            border: 1.5px solid var(--border-md);
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.84rem;
            color: var(--charcoal);
            background: var(--ivory);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }
        .rp-input::placeholder { color: #C8C1BA; }
        .rp-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.12);
            background: var(--white);
        }
        .rp-input.is-error {
            border-color: #E07070;
            box-shadow: 0 0 0 3px rgba(224,112,112,0.09);
        }

        /* eye toggle */
        .rp-eye-btn {
            position: absolute; right: 0.8rem;
            background: none; border: none; cursor: pointer;
            color: #C0B8B0; display: flex; align-items: center;
            padding: 0; transition: color 0.18s;
        }
        .rp-eye-btn:hover { color: var(--gold-dark); }
        .rp-eye-btn svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 1.7; }

        /* field divider */
        .rp-field-divider {
            height: 1px; background: var(--border);
            margin: 0.5rem 0 1rem;
        }

        /* strength meter */
        .rp-strength { margin-top: 0.5rem; display: flex; flex-direction: column; gap: 0.28rem; }
        .rp-strength-bars { display: flex; gap: 4px; }
        .rp-strength-bar {
            flex: 1; height: 3px; border-radius: 999px;
            background: var(--border); transition: background 0.3s;
        }
        .rp-strength-bar.active-weak   { background: #E07070; }
        .rp-strength-bar.active-fair   { background: #E0A84C; }
        .rp-strength-bar.active-good   { background: var(--gold); }
        .rp-strength-bar.active-strong { background: #6DBF82; }
        .rp-strength-label { font-size: 0.63rem; color: var(--warm-grey); }

        /* match indicator */
        .rp-match {
            margin-top: 0.38rem; font-size: 0.63rem;
            display: flex; align-items: center; gap: 0.3rem;
            opacity: 0; transition: opacity 0.2s;
        }
        .rp-match.visible { opacity: 1; }
        .rp-match.ok  { color: #6DBF82; }
        .rp-match.bad { color: #E07070; }
        .rp-match svg { width: 10px; height: 10px; }

        /* error text */
        .rp-error {
            margin-top: 0.38rem; font-size: 0.7rem; color: #C94444;
            display: flex; align-items: center; gap: 0.3rem;
        }
        .rp-error svg { width: 11px; height: 11px; flex-shrink: 0; }

        /* ── BUTTON ── */
        .rp-btn {
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
            margin-top: 0.3rem;
        }
        .rp-btn::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            opacity: 0; transition: opacity 0.22s;
        }
        .rp-btn:hover::after  { opacity: 1; }
        .rp-btn:hover         { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(201,168,76,0.22); }
        .rp-btn:active        { transform: none; }
        .rp-btn-inner {
            position: relative; z-index: 1;
            display: flex; align-items: center; justify-content: center; gap: 0.45rem;
        }
        .rp-btn-inner svg { width: 13px; height: 13px; }

        /* ── BACK LINK ── */
        .rp-back { text-align: center; margin-top: 1.25rem; }
        .rp-back a {
            font-size: 0.78rem; color: var(--warm-grey);
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 0.35rem;
            transition: color 0.2s;
        }
        .rp-back a:hover { color: var(--gold-dark); }
        .rp-back a svg { width: 11px; height: 11px; }
    </style>

    <div class="rp-wrap">

        {{-- Header --}}
        <div class="rp-form-header">
            <div class="rp-form-eyebrow">Reset Password</div>
            <h2 class="rp-form-title">Create your <em>new password</em></h2>
            <p class="rp-form-sub">
                Enter your email and choose a new secure password to regain access to your account.
            </p>
        </div>

        {{-- Card --}}
        <div class="rp-card">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                {{-- Hidden token --}}
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                {{-- Email --}}
                <div class="rp-field">
                    <label class="rp-label" for="email">Email Address</label>
                    <div class="rp-input-wrap">
                        <span class="rp-input-icon">
                            <svg viewBox="0 0 16 16">
                                <rect x="1" y="3" width="14" height="10" rx="2"/>
                                <polyline points="1,3 8,9 15,3"/>
                            </svg>
                        </span>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email', $request->email) }}"
                            required autofocus autocomplete="username"
                            class="rp-input {{ $errors->get('email') ? 'is-error' : '' }}"
                            placeholder="you@example.com"
                        >
                    </div>
                    @foreach ($errors->get('email') as $message)
                    <div class="rp-error">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="6" cy="6" r="5"/><path d="M6 4v3M6 8.5v.5"/>
                        </svg>
                        {{ $message }}
                    </div>
                    @endforeach
                </div>

                <div class="rp-field-divider"></div>

                {{-- New Password --}}
                <div class="rp-field">
                    <label class="rp-label" for="password">New Password</label>
                    <div class="rp-input-wrap">
                        <span class="rp-input-icon">
                            <svg viewBox="0 0 16 16">
                                <rect x="3" y="7" width="10" height="8" rx="1.5"/>
                                <path d="M5 7V5a3 3 0 0 1 6 0v2"/>
                            </svg>
                        </span>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            class="rp-input {{ $errors->get('password') ? 'is-error' : '' }}"
                            placeholder="Min. 8 characters"
                            oninput="checkStrength(this.value); checkMatch()"
                        >
                        <button type="button" class="rp-eye-btn" onclick="toggleVis('password')" aria-label="Show password">
                            <svg id="eye-password" viewBox="0 0 16 16">
                                <path d="M1 8s3-5 7-5 7 5 7 5-3 5-7 5-7-5-7-5z"/>
                                <circle cx="8" cy="8" r="2"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Strength meter --}}
                    <div class="rp-strength">
                        <div class="rp-strength-bars">
                            <div class="rp-strength-bar" id="sb1"></div>
                            <div class="rp-strength-bar" id="sb2"></div>
                            <div class="rp-strength-bar" id="sb3"></div>
                            <div class="rp-strength-bar" id="sb4"></div>
                        </div>
                        <span class="rp-strength-label" id="strengthLabel"></span>
                    </div>

                    @foreach ($errors->get('password') as $message)
                    <div class="rp-error">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="6" cy="6" r="5"/><path d="M6 4v3M6 8.5v.5"/>
                        </svg>
                        {{ $message }}
                    </div>
                    @endforeach
                </div>

                {{-- Confirm Password --}}
                <div class="rp-field">
                    <label class="rp-label" for="password_confirmation">Confirm Password</label>
                    <div class="rp-input-wrap">
                        <span class="rp-input-icon">
                            <svg viewBox="0 0 16 16">
                                <rect x="3" y="7" width="10" height="8" rx="1.5"/>
                                <path d="M5 7V5a3 3 0 0 1 6 0v2"/>
                            </svg>
                        </span>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required autocomplete="new-password"
                            class="rp-input {{ $errors->get('password_confirmation') ? 'is-error' : '' }}"
                            placeholder="Re-enter your password"
                            oninput="checkMatch()"
                        >
                        <button type="button" class="rp-eye-btn" onclick="toggleVis('password_confirmation')" aria-label="Show confirm password">
                            <svg id="eye-password_confirmation" viewBox="0 0 16 16">
                                <path d="M1 8s3-5 7-5 7 5 7 5-3 5-7 5-7-5-7-5z"/>
                                <circle cx="8" cy="8" r="2"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Match indicator --}}
                    <div class="rp-match" id="matchIndicator">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" id="matchIcon"></svg>
                        <span id="matchText"></span>
                    </div>

                    @foreach ($errors->get('password_confirmation') as $message)
                    <div class="rp-error">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="6" cy="6" r="5"/><path d="M6 4v3M6 8.5v.5"/>
                        </svg>
                        {{ $message }}
                    </div>
                    @endforeach
                </div>

                {{-- Submit --}}
                <button type="submit" class="rp-btn">
                    <span class="rp-btn-inner">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M7 1L2 3.5v4C2 10.5 4.5 13 7 13s5-2.5 5-5.5v-4L7 1z"/>
                            <polyline points="4.5,7 6.5,9 9.5,5" stroke-width="1.6"/>
                        </svg>
                        Reset Password
                    </span>
                </button>
            </form>
        </div>

        {{-- Back link --}}
        <div class="rp-back">
            <a href="{{ route('login') }}">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M8 1L3 6l5 5"/>
                </svg>
                Back to Sign In
            </a>
        </div>

    </div>

    <script>
    /* ── VISIBILITY TOGGLE ── */
    function toggleVis(fieldId) {
        const input = document.getElementById(fieldId);
        const isText = input.type === 'text';
        input.type = isText ? 'password' : 'text';
        const icon = document.getElementById('eye-' + fieldId);
        icon.innerHTML = isText
            ? '<path d="M1 8s3-5 7-5 7 5 7 5-3 5-7 5-7-5-7-5z"/><circle cx="8" cy="8" r="2"/>'
            : '<path d="M1 8s3-5 7-5 7 5 7 5-3 5-7 5-7-5-7-5z"/><line x1="1" y1="1" x2="15" y2="15"/>';
    }

    /* ── STRENGTH METER ── */
    function checkStrength(val) {
        let score = 0;
        if (val.length >= 8)           score++;
        if (/[A-Z]/.test(val))         score++;
        if (/[0-9]/.test(val))         score++;
        if (/[^A-Za-z0-9]/.test(val))  score++;

        const bars   = ['sb1','sb2','sb3','sb4'].map(id => document.getElementById(id));
        const labels = ['', 'Weak', 'Fair', 'Good', 'Strong'];
        const cls    = ['', 'active-weak', 'active-fair', 'active-good', 'active-strong'];

        bars.forEach((bar, i) => {
            bar.className = 'rp-strength-bar' + (val.length > 0 && i < score ? ' ' + cls[score] : '');
        });
        document.getElementById('strengthLabel').textContent = val.length > 0 ? labels[score] : '';
    }

    /* ── CONFIRM MATCH ── */
    function checkMatch() {
        const pw   = document.getElementById('password').value;
        const conf = document.getElementById('password_confirmation').value;
        const el   = document.getElementById('matchIndicator');
        const icon = document.getElementById('matchIcon');
        const text = document.getElementById('matchText');

        if (!conf.length) { el.classList.remove('visible', 'ok', 'bad'); return; }

        const match = pw === conf;
        el.classList.add('visible');
        el.classList.toggle('ok',  match);
        el.classList.toggle('bad', !match);
        icon.innerHTML = match
            ? '<path d="M2 6l3 3 5-5"/>'
            : '<path d="M2 2l8 8M10 2l-8 8"/>';
        text.textContent = match ? 'Passwords match' : 'Passwords do not match';
    }
    </script>

</x-guest-layout>