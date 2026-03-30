<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BloomVenue') }} – Sign In</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

            :root {
                --gold: #C9A84C;
                --gold-light: #E8C97A;
                --gold-dark: #8A6A1F;
                --blush: #F5ECE6;
                --ivory: #FAF7F2;
                --charcoal: #1E1B18;
                --warm-grey: #706B65;
                --border: #E5DDD5;
                --white: #FFFFFF;
                --font-display: 'Playfair Display', Georgia, serif;
                --font-body: 'DM Sans', sans-serif;
            }

            html, body {
                height: 100%;
                font-family: var(--font-body);
                background: var(--ivory);
                color: var(--charcoal);
            }

            /* ── LAYOUT: Left panel + Right form ── */
            .auth-wrapper {
                display: grid;
                grid-template-columns: 1fr 1fr;
                min-height: 100vh;
            }

            /* ── LEFT PANEL ── */
            .auth-left {
                position: relative;
                background: var(--charcoal);
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 4rem 5%;
                overflow: hidden;
            }

            /* Decorative bg circles */
            .auth-left::before {
                content: '';
                position: absolute;
                width: 700px; height: 700px;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(201,168,76,0.12) 0%, transparent 70%);
                top: -200px; left: -200px;
                pointer-events: none;
            }
            .auth-left::after {
                content: '';
                position: absolute;
                width: 500px; height: 500px;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(201,168,76,0.08) 0%, transparent 70%);
                bottom: -150px; right: -150px;
                pointer-events: none;
            }

            /* Logo */
            .left-logo {
                display: flex; align-items: center; gap: 0.75rem;
                margin-bottom: 3.5rem; position: relative; z-index: 1;
            }
            .logo-icon {
                width: 48px; height: 48px; border-radius: 12px;
                background: linear-gradient(135deg, var(--gold), var(--gold-dark));
                display: flex; align-items: center; justify-content: center;
                flex-shrink: 0;
            }
            .logo-icon svg { width: 26px; height: 26px; color: #fff; }
            .logo-text {
                font-family: var(--font-display);
                font-size: 1.45rem; font-weight: 700; color: var(--white);
            }
            .logo-text em { color: var(--gold-light); font-style: italic; }

            /* Headline */
            .left-headline {
                position: relative; z-index: 1; margin-bottom: 2.5rem;
            }
            .left-headline h1 {
                font-family: var(--font-display);
                font-size: clamp(2.4rem, 4vw, 3.6rem);
                font-weight: 700; line-height: 1.1;
                color: var(--white); margin-bottom: 1rem;
            }
            .left-headline h1 em {
                color: var(--gold-light); font-style: italic; display: block;
            }
            .left-headline p {
                font-size: 1rem; color: rgba(255,255,255,0.5);
                line-height: 1.7; max-width: 380px;
            }

            /* Floating cards */
            .cards-showcase {
                position: relative; z-index: 1;
                display: flex; flex-direction: column; gap: 0.9rem;
                max-width: 380px;
            }
            .showcase-card {
                background: rgba(255,255,255,0.06);
                border: 1px solid rgba(201,168,76,0.18);
                border-radius: 12px;
                padding: 1rem 1.2rem;
                display: flex; align-items: center; gap: 1rem;
                backdrop-filter: blur(8px);
                animation: floatCard 6s ease-in-out infinite;
            }
            .showcase-card:nth-child(2) { animation-delay: -2s; }
            .showcase-card:nth-child(3) { animation-delay: -4s; }
            @keyframes floatCard {
                0%, 100% { transform: translateY(0px); }
                50%       { transform: translateY(-5px); }
            }
            .card-icon-wrap {
                width: 40px; height: 40px; border-radius: 10px; flex-shrink: 0;
                display: flex; align-items: center; justify-content: center;
            }
            .card-icon-wrap.gold { background: rgba(201,168,76,0.2); color: var(--gold-light); }
            .card-icon-wrap.blush { background: rgba(242,224,216,0.15); color: #F2C4B0; }
            .card-icon-wrap.green { background: rgba(100,200,140,0.15); color: #80E0A0; }
            .card-text strong {
                display: block; font-size: 0.85rem; font-weight: 500;
                color: var(--white); line-height: 1.3;
            }
            .card-text span {
                font-size: 0.72rem; color: rgba(255,255,255,0.38);
            }

            /* Bottom stat chips */
            .stat-chips {
                position: relative; z-index: 1;
                display: flex; gap: 0.8rem; margin-top: 2.5rem; flex-wrap: wrap;
            }
            .chip {
                background: rgba(201,168,76,0.12);
                border: 1px solid rgba(201,168,76,0.25);
                border-radius: 999px;
                padding: 0.35rem 0.9rem;
                font-size: 0.72rem; letter-spacing: 0.04em;
                color: var(--gold-light);
            }

            /* ── RIGHT PANEL ── */
            .auth-right {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 3rem 2rem;
                background: var(--white);
                position: relative;
            }

            /* Subtle top border accent */
            .auth-right::before {
                content: '';
                position: absolute;
                top: 0; left: 10%; right: 10%;
                height: 2px;
                background: linear-gradient(90deg, transparent, var(--gold), transparent);
            }

            .form-container {
                width: 100%; max-width: 400px;
            }

            /* Back link */
            .back-link {
                display: inline-flex; align-items: center; gap: 0.4rem;
                font-size: 0.8rem; color: var(--warm-grey);
                text-decoration: none; margin-bottom: 2rem;
                transition: color 0.2s;
            }
            .back-link:hover { color: var(--gold-dark); }
            .back-link svg { width: 14px; height: 14px; }

            /* Form heading */
            .form-heading {
                margin-bottom: 2rem;
            }
            .form-heading h2 {
                font-family: var(--font-display);
                font-size: 1.9rem; font-weight: 700;
                color: var(--charcoal); line-height: 1.2;
                margin-bottom: 0.4rem;
            }
            .form-heading p {
                font-size: 0.875rem; color: var(--warm-grey);
            }

            /* Form fields */
            .field-group { display: flex; flex-direction: column; gap: 0.9rem; margin-bottom: 1.2rem; }

            .field-wrap { position: relative; }
            .field-wrap label {
                display: block; font-size: 0.75rem; font-weight: 500;
                letter-spacing: 0.04em; color: var(--warm-grey);
                margin-bottom: 0.4rem; text-transform: uppercase;
            }
            .field-wrap input {
                width: 100%;
                padding: 0.85rem 1rem 0.85rem 2.8rem;
                border: 1.5px solid var(--border);
                border-radius: 8px;
                font-family: var(--font-body);
                font-size: 0.9rem;
                color: var(--charcoal);
                background: var(--ivory);
                transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
                outline: none;
            }
            .field-wrap input::placeholder { color: #B8B0A8; }
            .field-wrap input:focus {
                border-color: var(--gold);
                background: var(--white);
                box-shadow: 0 0 0 3px rgba(201,168,76,0.12);
            }
            .field-icon {
                position: absolute; left: 0.85rem; bottom: 0.85rem;
                width: 18px; height: 18px; color: #C0B8B0;
                pointer-events: none;
            }
            .field-wrap input:focus + .field-icon,
            .field-wrap:focus-within .field-icon {
                color: var(--gold-dark);
            }

            /* Forgot */
            .forgot-row {
                display: flex; justify-content: flex-end;
                margin-bottom: 1.4rem;
            }
            .forgot-row a {
                font-size: 0.8rem; color: var(--warm-grey);
                text-decoration: none; transition: color 0.2s;
            }
            .forgot-row a:hover { color: var(--gold-dark); text-decoration: underline; }

            /* Submit button */
            .btn-login {
                width: 100%; padding: 0.95rem;
                background: linear-gradient(135deg, var(--charcoal) 0%, #3a2e20 100%);
                color: var(--white);
                border: none; border-radius: 8px;
                font-family: var(--font-body);
                font-size: 0.9rem; font-weight: 500;
                letter-spacing: 0.04em;
                cursor: pointer;
                transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
                position: relative; overflow: hidden;
                margin-bottom: 1.2rem;
            }
            .btn-login::after {
                content: '';
                position: absolute; inset: 0;
                background: linear-gradient(135deg, var(--gold-dark), var(--gold));
                opacity: 0; transition: opacity 0.3s;
            }
            .btn-login:hover::after { opacity: 1; }
            .btn-login:hover { transform: translateY(-1px); box-shadow: 0 8px 24px rgba(138,106,31,0.25); }
            .btn-login span { position: relative; z-index: 1; }

            /* Divider */
            .divider {
                display: flex; align-items: center; gap: 0.8rem;
                margin: 1.2rem 0;
            }
            .divider::before, .divider::after {
                content: ''; flex: 1; height: 1px; background: var(--border);
            }
            .divider span { font-size: 0.72rem; color: #C0B8B0; letter-spacing: 0.06em; }

            /* Create account button */
            .btn-register {
                width: 100%; padding: 0.9rem;
                background: transparent;
                color: var(--gold-dark);
                border: 1.5px solid var(--gold);
                border-radius: 8px;
                font-family: var(--font-body);
                font-size: 0.88rem; font-weight: 500;
                letter-spacing: 0.04em;
                cursor: pointer;
                transition: background 0.2s, color 0.2s, transform 0.15s;
                text-align: center; text-decoration: none;
                display: block;
            }
            .btn-register:hover {
                background: var(--gold);
                color: var(--charcoal);
                transform: translateY(-1px);
            }

            /* Brand footer */
            .form-brand {
                display: flex; align-items: center; justify-content: center;
                gap: 0.4rem; margin-top: 2.5rem;
            }
            .form-brand svg { width: 60px; opacity: 0.25; }
            .form-brand span { font-size: 0.72rem; color: #C0B8B0; letter-spacing: 0.06em; }

            /* Error messages (for validation) */
            .field-error {
                font-size: 0.75rem; color: #C0392B;
                margin-top: 0.3rem; display: block;
            }

            /* ── RESPONSIVE ── */
            @media (max-width: 768px) {
                .auth-wrapper { grid-template-columns: 1fr; }
                .auth-left { display: none; }
                .auth-right { padding: 2rem 1.5rem; }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="auth-wrapper">

            <!-- ── LEFT PANEL ── -->
            <div class="auth-left">
                <!-- Logo -->
                <div class="left-logo">
                    <!--<div class="logo-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                            <path d="M2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>-->
                    <div class="logo-text">Bikol's<em>Craft</em></div>
                </div>

                <!-- Headline -->
                <div class="left-headline">
                    <h1>Plan your<br><em>perfect event.</em></h1>
                    <p>Discover and manage the finest wedding & event suppliers — venues, caterers, photographers, and more — all in one elegant platform.</p>
                </div>

                <!-- Floating Feature Cards -->
                <div class="cards-showcase">
                    <div class="showcase-card">
                        <div class="card-icon-wrap gold">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>
                            </svg>
                        </div>
                        <div class="card-text">
                            <strong>Smart Event Calendar</strong>
                            <span>Track every booking & deadline</span>
                        </div>
                    </div>
                    <div class="showcase-card">
                        <div class="card-icon-wrap blush">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                            </svg>
                        </div>
                        <div class="card-text">
                            <strong>2,400+ Verified Suppliers</strong>
                            <span>Reviewed & ready to book</span>
                        </div>
                    </div>
                    <div class="showcase-card">
                        <div class="card-icon-wrap green">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <div class="card-text">
                            <strong>98% Client Satisfaction</strong>
                            <span>Trusted by 18,000+ events</span>
                        </div>
                    </div>
                </div>

                <!-- Chips -->
                <div class="stat-chips">
                    <span class="chip">Weddings</span>
                    <span class="chip">Corporate Events</span>
                    <span class="chip">Debuts</span>
                    <span class="chip">Birthdays</span>
                </div>
            </div>

            <!-- ── RIGHT PANEL ── -->
            <div class="auth-right">
                <div class="form-container">

                    <!-- Back link -->
                    <a href="{{ url('/') }}" class="back-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 5l-7 7 7 7"/>
                        </svg>
                        Back to home
                    </a>

                    <!-- THE SLOT (Jetstream / Breeze injects form here) -->
                    {{ $slot }}

                    <!-- Brand footer -->
                    <div class="form-brand">
                        <span>Bikol'sCraft &copy; {{ date('Y') }}</span>
                    </div>

                </div>
            </div>

        </div>
    </body>
</html>