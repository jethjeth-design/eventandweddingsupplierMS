<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email — Bikol's Craft</title>
</head>
<body style="margin:0; padding:0; background-color:#FAF7F2; font-family:'DM Sans', Arial, sans-serif;">

    {{-- Preheader (hidden preview text in inbox) --}}
    <div style="display:none; max-height:0; overflow:hidden; color:#FAF7F2;">
        Verify your email to start booking suppliers and exploring packages on Bikol's Craft.
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#FAF7F2; padding:40px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;">

                    {{-- ── HEADER / BRAND ── --}}
                    <tr>
                        <td style="
                            background-color:#1E1B18;
                            border-radius:10px 10px 0 0;
                            padding:32px 40px 28px;
                            text-align:center;
                            position:relative;
                        ">
                            {{-- Top gold line --}}
                            <div style="
                                height:2px;
                                background:linear-gradient(90deg, transparent, #C9A84C, transparent);
                                margin:-32px -40px 28px;
                            "></div>

                            {{-- Logo --}}
                            <div style="
                                font-family:Georgia, serif;
                                font-size:28px;
                                font-weight:700;
                                color:#FFFFFF;
                                letter-spacing:-0.01em;
                                margin-bottom:6px;
                            ">
                                Bikol's<span style="color:#C9A84C; font-style:italic;">Craft</span>
                            </div>

                            {{-- Eyebrow --}}
                            <div style="
                                font-size:10px;
                                letter-spacing:0.2em;
                                text-transform:uppercase;
                                color:#C9A84C;
                                font-weight:500;
                            ">Verified Supplier Marketplace</div>

                            {{-- Bottom gold line --}}
                            <div style="
                                height:1px;
                                background:linear-gradient(90deg, transparent, rgba(201,168,76,0.4), transparent);
                                margin:24px -40px -28px;
                            "></div>
                        </td>
                    </tr>

                    {{-- ── MAIN CARD ── --}}
                    <tr>
                        <td style="
                            background-color:#FFFFFF;
                            padding:40px 40px 32px;
                            border-left:1px solid #F0EBE5;
                            border-right:1px solid #F0EBE5;
                        ">
                            {{-- Icon badge --}}
                            <div style="text-align:center; margin-bottom:28px;">
                                <div style="
                                    display:inline-block;
                                    width:64px; height:64px;
                                    background:rgba(201,168,76,0.1);
                                    border:1.5px solid rgba(201,168,76,0.3);
                                    border-radius:50%;
                                    line-height:64px;
                                    text-align:center;
                                    font-size:28px;
                                ">✉️</div>
                            </div>

                            {{-- Eyebrow label --}}
                            <div style="
                                font-size:10px;
                                letter-spacing:0.18em;
                                text-transform:uppercase;
                                color:#8A6A1F;
                                font-weight:600;
                                margin-bottom:10px;
                                display:flex;
                                align-items:center;
                                gap:8px;
                            ">
                                — Email Verification
                            </div>

                            {{-- Heading --}}
                            <h1 style="
                                font-family:Georgia, serif;
                                font-size:26px;
                                font-weight:700;
                                color:#1E1B18;
                                line-height:1.2;
                                margin:0 0 8px;
                            ">
                                Confirm your <span style="color:#8A6A1F; font-style:italic;">email address</span>
                            </h1>

                            {{-- Divider line --}}
                            <div style="
                                width:40px; height:2px;
                                background:linear-gradient(90deg, #C9A84C, #E8C97A);
                                margin:0 0 24px;
                                border-radius:99px;
                            "></div>

                            {{-- Greeting --}}
                            <p style="
                                font-size:15px;
                                color:#1E1B18;
                                line-height:1.65;
                                margin:0 0 12px;
                            ">
                                Hello <strong>{{ $user->name }}</strong>,
                            </p>

                            {{-- Body copy --}}
                            <p style="
                                font-size:14px;
                                color:#6B6560;
                                line-height:1.75;
                                margin:0 0 28px;
                            ">
                                Thank you for joining <strong style="color:#1E1B18;">Bikol's Craft</strong> — the trusted marketplace for event suppliers in the Bicol region. To activate your account and start booking suppliers or exploring packages, please verify your email address.
                            </p>

                            {{-- CTA Button --}}
                            <div style="text-align:center; margin-bottom:32px;">
                                <a href="{{ $url }}"
                                   style="
                                       display:inline-block;
                                       background-color:#C9A84C;
                                       color:#1E1B18;
                                       text-decoration:none;
                                       font-size:13px;
                                       font-weight:700;
                                       letter-spacing:0.08em;
                                       text-transform:uppercase;
                                       padding:14px 36px;
                                       border-radius:3px;
                                   "
                                >
                                    Verify My Email
                                </a>
                            </div>

                            {{-- Expiry notice --}}
                            <div style="
                                background:#FAF7F2;
                                border:1px solid #F0EBE5;
                                border-left:3px solid #C9A84C;
                                border-radius:4px;
                                padding:12px 16px;
                                margin-bottom:28px;
                            ">
                                <p style="
                                    font-size:12px;
                                    color:#6B6560;
                                    margin:0;
                                    line-height:1.6;
                                ">
                                    ⏱ This link will expire in <strong style="color:#1E1B18;">60 minutes</strong>. If it expires, you can request a new verification email from the login page.
                                </p>
                            </div>

                            {{-- Fallback URL --}}
                            <p style="font-size:12px; color:#6B6560; line-height:1.6; margin:0 0 6px;">
                                If the button above doesn't work, copy and paste this link into your browser:
                            </p>
                            <p style="
                                font-size:11px;
                                color:#C9A84C;
                                word-break:break-all;
                                margin:0;
                                line-height:1.6;
                            ">{{ $url }}</p>
                        </td>
                    </tr>

                    {{-- ── DIVIDER ── --}}
                    <tr>
                        <td style="
                            background:#FFFFFF;
                            padding:0 40px;
                            border-left:1px solid #F0EBE5;
                            border-right:1px solid #F0EBE5;
                        ">
                            <div style="height:1px; background:linear-gradient(90deg, transparent, #E0D8D0, transparent);"></div>
                        </td>
                    </tr>

                    {{-- ── SECURITY NOTE ── --}}
                    <tr>
                        <td style="
                            background:#FFFFFF;
                            padding:24px 40px;
                            border-left:1px solid #F0EBE5;
                            border-right:1px solid #F0EBE5;
                        ">
                            <p style="
                                font-size:12px;
                                color:#6B6560;
                                line-height:1.65;
                                margin:0;
                            ">
                                🔒 <strong style="color:#1E1B18;">Didn't create an account?</strong>
                                No action is needed — you can safely ignore this email. Your inbox will not receive any further emails from us.
                            </p>
                        </td>
                    </tr>

                    {{-- ── FOOTER ── --}}
                    <tr>
                        <td style="
                            background:#1E1B18;
                            border-radius:0 0 10px 10px;
                            padding:28px 40px;
                            text-align:center;
                            border-top:2px solid rgba(201,168,76,0.2);
                        ">
                            {{-- Brand --}}
                            <div style="
                                font-family:Georgia, serif;
                                font-size:16px;
                                font-weight:700;
                                color:#FFFFFF;
                                margin-bottom:12px;
                            ">
                                Bikol's<span style="color:#C9A84C; font-style:italic;">Craft</span>
                            </div>

                            {{-- Links --}}
                            <div style="margin-bottom:16px;">
                                <a href="#" style="font-size:11px; color:rgba(255,255,255,0.4); text-decoration:none; margin:0 10px;">Privacy</a>
                                <a href="#" style="font-size:11px; color:rgba(255,255,255,0.4); text-decoration:none; margin:0 10px;">Terms</a>
                                <a href="#" style="font-size:11px; color:rgba(255,255,255,0.4); text-decoration:none; margin:0 10px;">Support</a>
                            </div>

                            {{-- Gold line --}}
                            <div style="
                                height:1px;
                                background:linear-gradient(90deg, transparent, rgba(201,168,76,0.25), transparent);
                                margin:0 0 16px;
                            "></div>

                            <p style="
                                font-size:11px;
                                color:rgba(255,255,255,0.25);
                                margin:0;
                                line-height:1.6;
                            ">
                                &copy; {{ date('Y') }} Bikol's Craft. All rights reserved.<br>
                                Bicol Region, Philippines
                            </p>
                        </td>
                    </tr>

                    {{-- Bottom spacer --}}
                    <tr><td style="height:32px;"></td></tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>