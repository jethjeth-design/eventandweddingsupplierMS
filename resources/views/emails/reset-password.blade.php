<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Bikol's Craft</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', Arial, sans-serif;
            background-color: #F0EBE3;
            padding: 32px 16px;
            -webkit-font-smoothing: antialiased;
        }

        .email-shell {
            max-width: 580px;
            margin: 0 auto;
        }

        /* ── PRE-HEADER LOGO ── */
        .email-preheader {
            text-align: center;
            padding-bottom: 20px;
        }
        .email-logo-text {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: #1E1B18;
            letter-spacing: 0.02em;
            text-decoration: none;
        }
        .email-logo-text em {
            color: #C9A84C;
            font-style: italic;
        }

        /* ── CARD ── */
        .email-card {
            background: #FFFFFF;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 40px rgba(30,27,24,0.12);
            border: 1px solid rgba(201,168,76,0.15);
        }

        /* ── HERO HEADER ── */
        .email-hero {
            background: #1E1B18;
            padding: 36px 40px 32px;
            position: relative;
            overflow: hidden;
        }
        /* dot-grid texture */
        .email-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px);
            background-size: 18px 18px;
            pointer-events: none;
        }
        /* gold line at bottom */
        .email-hero::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, transparent, #C9A84C, transparent);
        }

        .email-hero-eyebrow {
            font-size: 0.6rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: #C9A84C;
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            z-index: 1;
        }
        .email-hero-eyebrow::before {
            content: '';
            display: inline-block;
            width: 18px; height: 1px;
            background: #C9A84C;
            flex-shrink: 0;
        }

        .email-hero-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: #FFFFFF;
            line-height: 1.18;
            position: relative;
            z-index: 1;
        }
        .email-hero-title em {
            color: #E8C97A;
            font-style: italic;
        }

        .email-hero-sub {
            font-size: 0.76rem;
            color: rgba(255,255,255,0.38);
            margin-top: 0.4rem;
            position: relative;
            z-index: 1;
        }

        /* ── BODY ── */
        .email-body {
            padding: 36px 40px;
        }

        /* Greeting */
        .email-greeting {
            font-size: 1rem;
            font-weight: 500;
            color: #1E1B18;
            margin-bottom: 1rem;
        }
        .email-greeting strong {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 700;
            font-style: italic;
            color: #8A6A1F;
        }

        /* Message block */
        .email-message {
            background: #FAF7F2;
            border-left: 3px solid #C9A84C;
            border-radius: 0 10px 10px 0;
            padding: 1.1rem 1.25rem;
            margin: 1.25rem 0;
        }
        .email-message p {
            font-size: 0.88rem;
            color: #3D3830;
            line-height: 1.7;
        }

        /* Divider */
        .email-divider {
            border: none;
            border-top: 1px solid #F0EBE5;
            margin: 1.5rem 0;
        }

        /* CTA Button */
        .email-cta-wrap {
            text-align: center;
            margin: 1.5rem 0;
        }
        .email-cta {
            display: inline-block;
            padding: 14px 36px;
            background: #1E1B18;
            color: #FAF7F2 !important;
            text-decoration: none;
            border-radius: 6px;
            font-family: 'DM Sans', Arial, sans-serif;
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            border: 1.5px solid rgba(201,168,76,0.2);
            transition: background 0.2s;
        }
        .email-cta:hover {
            background: #8A6A1F !important;
        }

        /* Or-link fallback */
        .email-url-fallback {
            text-align: center;
            margin-top: 0.75rem;
        }
        .email-url-fallback p {
            font-size: 0.68rem;
            color: #6B6560;
        }
        .email-url-fallback a {
            color: #8A6A1F;
            word-break: break-all;
            font-size: 0.68rem;
        }

        /* Security notice */
        .email-notice {
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
            background: rgba(201,168,76,0.06);
            border: 1px solid rgba(201,168,76,0.18);
            border-radius: 9px;
            padding: 0.8rem 1rem;
            margin-top: 1.25rem;
        }
        .email-notice-icon {
            width: 18px; height: 18px;
            flex-shrink: 0; color: #C9A84C;
            margin-top: 1px;
        }
        .email-notice p {
            font-size: 0.72rem;
            color: #6B6560;
            line-height: 1.55;
        }

        /* Signature */
        .email-signature {
            margin-top: 1.75rem;
            padding-top: 1.25rem;
            border-top: 1px solid #F0EBE5;
        }
        .email-signature p {
            font-size: 0.82rem;
            color: #6B6560;
            line-height: 1.7;
        }
        .email-signature strong {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 0.88rem;
            font-weight: 700;
            color: #1E1B18;
        }
        .email-signature em {
            color: #C9A84C;
            font-style: italic;
        }

        /* ── FOOTER ── */
        .email-footer {
            padding: 20px 40px 24px;
            background: #1E1B18;
            text-align: center;
        }
        .email-footer-logo {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 0.95rem;
            font-weight: 700;
            color: #FFFFFF;
            margin-bottom: 0.5rem;
        }
        .email-footer-logo em { color: #C9A84C; font-style: italic; }

        .email-footer-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 0.75rem;
            flex-wrap: wrap;
        }
        .email-footer-links a {
            font-size: 0.68rem;
            color: rgba(255,255,255,0.35);
            text-decoration: none;
            letter-spacing: 0.04em;
            transition: color 0.2s;
        }
        .email-footer-links a:hover { color: #E8C97A; }

        .email-footer-copy {
            font-size: 0.62rem;
            color: rgba(255,255,255,0.2);
        }

        /* ── RESPONSIVE ── */
        @media only screen and (max-width: 600px) {
            body { padding: 16px 10px; }
            .email-hero { padding: 28px 24px 26px; }
            .email-body { padding: 28px 24px; }
            .email-footer { padding: 18px 24px 20px; }
            .email-hero-title { font-size: 1.4rem; }
            .email-footer-links { gap: 1rem; }
        }
    </style>
</head>
<body>

<div class="email-shell">

    {{-- ── PRE-HEADER ── --}}
    <div class="email-preheader">
        <span class="email-logo-text">EWS<em>TEAM</em></span>
    </div>

    <div class="email-card">

        {{-- ── HERO ── --}}
        <div class="email-hero">
            <div class="email-hero-eyebrow">Event &amp; Wedding Supplier System</div>
            <div class="email-hero-title">Reset Your Password </div>
            <div class="email-hero-sub">EWS TEAM · Official Communication</div>
        </div>

        {{-- ── BODY ── --}}
        <div class="email-body">

            {{-- Greeting --}}
            <p class="email-greeting">
                Hello, <strong>{{ $user->name }}</strong> 👋
            </p>

            <hr class="email-divider">

            {{-- CTA --}}
            <div class="email-cta-wrap">
                <a href="{{ $url }}" class="email-cta">
                    Reset Your Password
                </a>
            </div>

            {{-- URL fallback --}}
            <div class="email-url-fallback">
                <p>Or copy and paste this link into your browser:</p>
                <a href="{{ $url }}">{{ $url }}</a>
            </div>

            {{-- Security notice --}}
            <div class="email-notice">
                <svg class="email-notice-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6">
                    <path d="M10 2l7 3v5c0 4.4-3 8.4-7 9.5C6 18.4 3 14.4 3 10V5l7-3z"/>
                </svg>
                <p>If you did not request this email, no action is needed — you can safely ignore it. This link will expire in <strong>60 minutes</strong>.</p>
            </div>

            {{-- Signature --}}
            <div class="email-signature">
                <p>
                    Warm regards,<br>
                    <strong>EWS<em>TEAM</em></strong><br>
                    <span style="font-size:0.72rem;color:#C0B8B0;">Event &amp; Wedding Supplier System</span>
                </p>
            </div>

        </div>

        {{-- ── FOOTER ── --}}
        <div class="email-footer">
            <div class="email-footer-logo">EWS<em>TEAM</em></div>
            <div class="email-footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Support</a>
            </div>
            <div class="email-footer-copy">
                © {{ date('Y') }} EWS TEAM. All rights reserved.<br>
                Negros Occidental Region, Philippines
            </div>
        </div>

    </div>

</div>

</body>
</html>