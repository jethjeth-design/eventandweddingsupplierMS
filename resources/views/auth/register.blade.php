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
        padding: 0.85rem 1rem 0.85rem 2.8rem !important;
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

    /* Fields gap */
    .fields-stack { display: flex; flex-direction: column; gap: 1rem; margin-bottom: 1.4rem; }

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

<!-- Heading — same pattern as login "Welcome back" -->
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

        <!-- Email Address -->
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
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

    </div>

    <!-- Register button — full width, matches login -->
    <x-primary-button class="bv-submit">
        {{ __('Register') }}
    </x-primary-button>

    <!-- Divider -->
    <div class="bv-divider"><span>or</span></div>

    <!-- Already registered — centred like login's register link -->
    <div style="text-align:center;">
        <a class="already-link" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>
    </div>

</form>

</x-guest-layout>