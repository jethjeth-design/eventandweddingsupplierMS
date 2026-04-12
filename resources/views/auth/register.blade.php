{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap');

    :root {
        --gold: #C9A84C;
        --gold-dark: #8A6A1F;
        --ivory: #FAF7F2;
        --charcoal: #1E1B18;
        --warm-grey: #706B65;
        --border: #E5DDD5;
        --white: #FFFFFF;
        --font-display: 'Playfair Display', Georgia, serif;
        --font-body: 'DM Sans', sans-serif;
    }

    /* ── Heading ── */
    .reg-heading { margin-bottom: 1.8rem; }
    .reg-heading h2 {
        font-family: var(--font-display);
        font-size: 1.9rem; font-weight: 700;
        color: var(--charcoal); line-height: 1.2;
        margin-bottom: 0.4rem;
    }
    .reg-heading p {
        font-size: 0.875rem;
        color: var(--warm-grey);
        font-family: var(--font-body);
    }

    /* ── Field wrapper ── */
    .bv-field { position: relative; }

    .bv-field label {
        font-family: var(--font-body) !important;
        font-size: 0.75rem !important;
        font-weight: 500 !important;
        letter-spacing: 0.04em !important;
        text-transform: uppercase !important;
        color: var(--warm-grey) !important;
        margin-bottom: 0.4rem !important;
        display: block !important;
    }

    .bv-field input[type="text"],
    .bv-field input[type="email"],
    .bv-field input[type="password"] {
        width: 100% !important;
        padding: 0.85rem 2.6rem 0.85rem 2.8rem !important;
        border: 1.5px solid var(--border) !important;
        border-radius: 8px !important;
        font-family: var(--font-body) !important;
        font-size: 0.9rem !important;
        color: var(--charcoal) !important;
        background: var(--ivory) !important;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s !important;
        outline: none !important;
        box-shadow: none !important;
        margin-top: 0 !important;
    }
    .bv-field input:focus {
        border-color: var(--gold) !important;
        background: var(--white) !important;
        box-shadow: 0 0 0 3px rgba(201,168,76,0.12) !important;
    }
    .bv-field input::placeholder { color: #C0B8B0 !important; }

    .bv-field .mt-2 p,
    .bv-field .mt-2 span {
        font-size: 0.72rem !important;
        color: #C0392B !important;
        font-family: var(--font-body) !important;
    }

    /* Left icon */
    .bv-icon {
        position: absolute;
        left: 0.85rem;
        bottom: 0.85rem;
        width: 18px; height: 18px;
        color: #C0B8B0;
        pointer-events: none;
        transition: color 0.2s;
    }
    .bv-field:focus-within .bv-icon { color: var(--gold-dark); }

    /* Eye toggle (right side of password fields) */
    .bv-eye {
        position: absolute;
        right: 0.85rem;
        bottom: 0.82rem;
        width: 20px; height: 20px;
        color: #C0B8B0;
        cursor: pointer;
        background: none;
        border: none;
        padding: 0;
        display: flex; align-items: center; justify-content: center;
        transition: color 0.2s;
    }
    .bv-eye:hover { color: var(--gold-dark); }
    .bv-eye svg { width: 18px; height: 18px; pointer-events: none; }

    /* Fields gap */
    .fields-stack { display: flex; flex-direction: column; gap: 1rem; margin-bottom: 1.4rem; }

    /* ── PASSWORD STRENGTH ── */
    .pw-strength-wrap { margin-top: 0.55rem; }

    /* Bar track */
    .pw-bar-track {
        display: flex; gap: 4px; margin-bottom: 0.4rem;
    }
    .pw-bar-seg {
        flex: 1; height: 4px; border-radius: 999px;
        background: #EDE8E2;
        transition: background 0.3s;
    }

    /* Strength label row */
    .pw-label-row {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 0.45rem;
    }
    .pw-label {
        font-size: 0.7rem; font-weight: 500; font-family: var(--font-body);
        letter-spacing: 0.04em; text-transform: uppercase;
        transition: color 0.3s;
        color: #C0B8B0;
    }
    .pw-example {
        font-size: 0.65rem; color: #C0B8B0;
        font-family: var(--font-body);
    }

    /* Checklist */
    .pw-checks { display: flex; flex-direction: column; gap: 0.22rem; }
    .pw-check-item {
        display: flex; align-items: center; gap: 0.4rem;
        font-size: 0.72rem; color: #B0A89E;
        font-family: var(--font-body);
        transition: color 0.2s;
    }
    .pw-check-item.met { color: #2E7D32; }
    .pw-check-item.met .pw-check-dot { background: #4CAF50; border-color: #4CAF50; }
    .pw-check-dot {
        width: 12px; height: 12px; border-radius: 50%;
        border: 1.5px solid #D0C8C0;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; transition: all 0.2s;
        background: transparent;
    }
    .pw-check-dot svg { width: 7px; height: 7px; display: none; }
    .pw-check-item.met .pw-check-dot svg { display: block; }

    /* ── PASSWORD MATCH ── */
    .pw-match-msg {
        margin-top: 0.45rem;
        display: flex; align-items: center; gap: 0.4rem;
        font-size: 0.72rem; font-family: var(--font-body);
        min-height: 1.2rem;
        transition: all 0.2s;
    }
    .pw-match-msg.match    { color: #2E7D32; }
    .pw-match-msg.no-match { color: #C0392B; }
    .pw-match-msg svg { width: 13px; height: 13px; flex-shrink: 0; }

    /* Strength colours */
    .seg-weak   { background: #E74C3C !important; }
    .seg-fair   { background: #E67E22 !important; }
    .seg-good   { background: #F1C40F !important; }
    .seg-strong { background: #27AE60 !important; }
    .seg-excel  { background: #1565C0 !important; }

    .label-weak   { color: #E74C3C !important; }
    .label-fair   { color: #E67E22 !important; }
    .label-good   { color: #F1C40F !important; }
    .label-strong { color: #27AE60 !important; }
    .label-excel  { color: #1565C0 !important; }

    /* Submit full-width */
    .bv-submit,
    button.bv-submit,
    .bv-submit[type="submit"] {
        width: 100% !important;
        padding: 0.95rem !important;
        background: linear-gradient(135deg, #1E1B18 0%, #3a2e20 100%) !important;
        color: #fff !important;
        border: none !important;
        border-radius: 8px !important;
        font-family: var(--font-body) !important;
        font-size: 0.9rem !important;
        font-weight: 500 !important;
        letter-spacing: 0.04em !important;
        cursor: pointer !important;
        transition: transform 0.15s, box-shadow 0.2s !important;
        position: relative !important;
        overflow: hidden !important;
        text-transform: none !important;
        margin: 0 !important;
        display: block !important;
        justify-content: center !important;
        margin-bottom: 1.2rem !important;
    }
    .bv-submit::after {
        content: '' !important;
        position: absolute !important; inset: 0 !important;
        background: linear-gradient(135deg, #8A6A1F, #C9A84C) !important;
        opacity: 0 !important; transition: opacity 0.3s !important;
    }
    .bv-submit:hover::after { opacity: 1 !important; }
    .bv-submit:hover {
        transform: translateY(-1px) !important;
        box-shadow: 0 6px 20px rgba(138,106,31,0.22) !important;
    }
    .bv-submit > * { position: relative; z-index: 1; }

    /* Divider */
    .bv-divider {
        display: flex; align-items: center; gap: 0.75rem;
        margin-bottom: 1.2rem;
    }
    .bv-divider::before, .bv-divider::after {
        content: ''; flex: 1; height: 1px; background: var(--border);
    }
    .bv-divider span {
        font-size: 0.7rem; color: #C0B8B0;
        letter-spacing: 0.06em; font-family: var(--font-body);
    }

    /* Already registered link */
    .already-link {
        font-size: 0.8rem; color: var(--warm-grey);
        text-decoration: none; font-family: var(--font-body);
        transition: color 0.2s;
    }
    .already-link:hover { color: var(--gold-dark); text-decoration: underline; }
</style>

<div class="reg-heading">
    <h2>Create an account</h2>
    <p>Sign up to start planning your perfect event</p>
</div>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="fields-stack">

        <!-- Name -->
        <div class="bv-field">
            <x-input-label for="name" :value="__('Name')" />
            <div style="position:relative;">
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                    :value="old('name')" required autofocus autocomplete="name"
                    placeholder="Your full name" />
                <svg class="bv-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="10" cy="7" r="4"/>
                    <path d="M2 18c0-4 3.6-7 8-7s8 3 8 7"/>
                </svg>
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="bv-field">
            <x-input-label for="email" :value="__('Email')" />
            <div style="position:relative;">
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autocomplete="username"
                    placeholder="you@example.com" />
                <svg class="bv-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <rect x="2" y="4" width="16" height="13" rx="2"/>
                    <path d="M2 7l8 5 8-5"/>
                </svg>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="bv-field">
            <x-input-label for="password" :value="__('Password')" />
            <div style="position:relative;">
                <x-text-input id="password" class="block mt-1 w-full"
                    type="password" name="password"
                    required autocomplete="new-password"
                    placeholder="••••••••" />
                <svg class="bv-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <rect x="4" y="9" width="12" height="9" rx="2"/>
                    <path d="M7 9V7a3 3 0 116 0v2"/>
                </svg>
                <button type="button" class="bv-eye" id="eyeBtn1" onclick="toggleEye('password','eyeBtn1')">
                    <svg id="eyeIcon1" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M1 10s3.5-6 9-6 9 6 9 6-3.5 6-9 6-9-6-9-6z"/>
                        <circle cx="10" cy="10" r="2.5"/>
                    </svg>
                </button>
            </div>

            <!-- Live strength meter -->
            <div class="pw-strength-wrap" id="pwStrengthWrap" style="display:none;">
                <div class="pw-bar-track">
                    <div class="pw-bar-seg" id="seg0"></div>
                    <div class="pw-bar-seg" id="seg1"></div>
                    <div class="pw-bar-seg" id="seg2"></div>
                    <div class="pw-bar-seg" id="seg3"></div>
                    <div class="pw-bar-seg" id="seg4"></div>
                </div>
                <div class="pw-label-row">
                    <span class="pw-label" id="pwLabel">—</span>
                    <span class="pw-example" id="pwExample"></span>
                </div>
                <div class="pw-checks">
                    <div class="pw-check-item" id="chk-len">
                        <div class="pw-check-dot">
                            <svg viewBox="0 0 8 8" fill="none" stroke="white" stroke-width="1.8"><path d="M1 4l2 2 4-4"/></svg>
                        </div>
                        At least 8 characters
                    </div>
                    <div class="pw-check-item" id="chk-upper">
                        <div class="pw-check-dot">
                            <svg viewBox="0 0 8 8" fill="none" stroke="white" stroke-width="1.8"><path d="M1 4l2 2 4-4"/></svg>
                        </div>
                        Uppercase letter (A–Z)
                    </div>
                    <div class="pw-check-item" id="chk-lower">
                        <div class="pw-check-dot">
                            <svg viewBox="0 0 8 8" fill="none" stroke="white" stroke-width="1.8"><path d="M1 4l2 2 4-4"/></svg>
                        </div>
                        Lowercase letter (a–z)
                    </div>
                    <div class="pw-check-item" id="chk-num">
                        <div class="pw-check-dot">
                            <svg viewBox="0 0 8 8" fill="none" stroke="white" stroke-width="1.8"><path d="M1 4l2 2 4-4"/></svg>
                        </div>
                        Number (0–9)
                    </div>
                    <div class="pw-check-item" id="chk-sym">
                        <div class="pw-check-dot">
                            <svg viewBox="0 0 8 8" fill="none" stroke="white" stroke-width="1.8"><path d="M1 4l2 2 4-4"/></svg>
                        </div>
                        Special character (!@#$…)
                    </div>
                </div>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="bv-field">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <div style="position:relative;">
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                    type="password" name="password_confirmation"
                    required autocomplete="new-password"
                    placeholder="••••••••" />
                <svg class="bv-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <rect x="4" y="9" width="12" height="9" rx="2"/>
                    <path d="M7 9V7a3 3 0 116 0v2"/>
                </svg>
                <button type="button" class="bv-eye" id="eyeBtn2" onclick="toggleEye('password_confirmation','eyeBtn2')">
                    <svg id="eyeIcon2" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M1 10s3.5-6 9-6 9 6 9 6-3.5 6-9 6-9-6-9-6z"/>
                        <circle cx="10" cy="10" r="2.5"/>
                    </svg>
                </button>
            </div>

            <!-- Live match indicator -->
            <div class="pw-match-msg" id="pwMatchMsg" style="display:none;"></div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

    </div>

    <x-primary-button class="bv-submit">
        {{ __('Register') }}
    </x-primary-button>

    <div class="bv-divider"><span>or</span></div>

    <div style="text-align:center;">
        <a class="already-link" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>
    </div>

</form>

<script>
/* ── EYE TOGGLE ── */
function toggleEye(inputId, btnId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(btnId.replace('eyeBtn', 'eyeIcon'));
    if (!input) return;
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    icon.innerHTML = isHidden
        ? `<path d="M3 3l14 14M8.5 8.6A3 3 0 0111.4 11M6.1 6.2C3.9 7.7 2 10 2 10s3 5 8 5c1.4 0 2.7-.4 3.8-1M9 4.1C9.3 4 9.7 4 10 4c5 0 8 6 8 6s-.7 1.3-2 2.7" stroke="currentColor" stroke-width="1.7" fill="none"/>`
        : `<path d="M1 10s3.5-6 9-6 9 6 9 6-3.5 6-9 6-9-6-9-6z" stroke="currentColor" stroke-width="1.7" fill="none"/><circle cx="10" cy="10" r="2.5" stroke="currentColor" stroke-width="1.7" fill="none"/>`;
}

/* ── STRENGTH ENGINE ── */
const LEVELS = [
    { label: 'Too short',  cls: 'label-weak',   segs: 1, segCls: 'seg-weak',   ex: 'e.g. password123'          },
    { label: 'Weak',       cls: 'label-weak',   segs: 1, segCls: 'seg-weak',   ex: 'e.g. password123'          },
    { label: 'Fair',       cls: 'label-fair',   segs: 2, segCls: 'seg-fair',   ex: 'e.g. Password123'          },
    { label: 'Good',       cls: 'label-good',   segs: 3, segCls: 'seg-good',   ex: 'e.g. Password123!'         },
    { label: 'Strong',     cls: 'label-strong', segs: 4, segCls: 'seg-strong', ex: 'e.g. P@ssw0rd!2024'        },
    { label: 'Excellent',  cls: 'label-excel',  segs: 5, segCls: 'seg-excel',  ex: 'e.g. Tr0ub4dor&3#Secure!'  },
];

function scorePassword(pw) {
    if (!pw) return -1;
    const checks = {
        len:   pw.length >= 8,
        upper: /[A-Z]/.test(pw),
        lower: /[a-z]/.test(pw),
        num:   /[0-9]/.test(pw),
        sym:   /[^A-Za-z0-9]/.test(pw),
    };
    if (pw.length < 8) return { score: 0, checks };
    let s = 0;
    if (checks.upper) s++;
    if (checks.lower) s++;
    if (checks.num)   s++;
    if (checks.sym)   s++;
    if (pw.length >= 16) s++;
    // clamp 1–4 → levels 1–4; s==5 only if long + all criteria
    const score = Math.min(s, 4) + (s === 5 ? 1 : 0);
    return { score: Math.min(score, 5), checks };
}

const pwInput   = document.getElementById('password');
const pwConfirm = document.getElementById('password_confirmation');
const wrap      = document.getElementById('pwStrengthWrap');
const labelEl   = document.getElementById('pwLabel');
const exEl      = document.getElementById('pwExample');
const segs      = [0,1,2,3,4].map(i => document.getElementById('seg'+i));
const chkIds    = { len:'chk-len', upper:'chk-upper', lower:'chk-lower', num:'chk-num', sym:'chk-sym' };
const matchMsg  = document.getElementById('pwMatchMsg');

function updateStrength() {
    const pw = pwInput.value;
    if (!pw) { wrap.style.display = 'none'; updateMatch(); return; }
    wrap.style.display = 'block';

    const result = scorePassword(pw);
    const lvl    = LEVELS[result.score] || LEVELS[0];

    // bars
    segs.forEach((s, i) => {
        s.className = 'pw-bar-seg';
        if (i < lvl.segs) s.classList.add(lvl.segCls);
    });

    // label & example
    labelEl.className = 'pw-label ' + lvl.cls;
    labelEl.textContent = lvl.label;
    exEl.textContent = lvl.ex;

    // checklist
    Object.entries(chkIds).forEach(([key, id]) => {
        const el = document.getElementById(id);
        if (result.checks[key]) el.classList.add('met');
        else                    el.classList.remove('met');
    });

    updateMatch();
}

function updateMatch() {
    const pw  = pwInput.value;
    const pw2 = pwConfirm.value;
    if (!pw2) { matchMsg.style.display = 'none'; return; }
    matchMsg.style.display = 'flex';
    if (pw === pw2) {
        matchMsg.className = 'pw-match-msg match';
        matchMsg.innerHTML = `<svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 7l3.5 3.5L12 3"/></svg> Passwords match`;
    } else {
        matchMsg.className = 'pw-match-msg no-match';
        matchMsg.innerHTML = `<svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 2l10 10M12 2L2 12"/></svg> Passwords do not match`;
    }
}

pwInput.addEventListener('input', updateStrength);
pwConfirm.addEventListener('input', updateMatch);
</script>

</x-guest-layout>