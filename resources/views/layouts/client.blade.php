<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Bikols Craft') }} — @isset($title){{ $title }}@else Dashboard @endisset</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

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
                --topbar-h:    64px;
                --white:       #FFFFFF;
                --border:      #F0EBE5;
                --border-md:   #E0D8D0;
                --font-display:'Playfair Display', Georgia, serif;
                --font-body:   'DM Sans', sans-serif;
            }

            html, body {
                height: 100%;
                font-family: var(--font-body);
                background: var(--ivory);
                color: var(--charcoal);
                overflow-x: hidden;
            }

            /* ════════════════════════════════
               TOP BAR — nav + controls only
            ════════════════════════════════ */
            .topbar {
                position: fixed;
                top: 0; left: 0; right: 0;
                height: var(--topbar-h);
                z-index: 100;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 1.5rem;
                background: rgba(250,247,242,0.95);
                backdrop-filter: blur(16px);
                border-bottom: 1px solid rgba(201,168,76,0.18);
                gap: 1rem;
            }

            /* Icon buttons (used in navigation include) */
            .icon-btn {
                width: 36px; height: 36px;
                border-radius: 8px;
                border: 1.5px solid var(--border-md);
                background: var(--white);
                display: flex; align-items: center; justify-content: center;
                cursor: pointer;
                color: var(--warm-grey);
                transition: border-color 0.2s, color 0.2s, background 0.2s;
                position: relative;
                text-decoration: none;
                flex-shrink: 0;
            }
            .icon-btn:hover {
                border-color: var(--gold);
                color: var(--gold-dark);
                background: rgba(201,168,76,0.06);
            }
            .icon-btn svg { width: 16px; height: 16px; }

            /* User pill */
            .user-pill {
                display: flex;
                align-items: center;
                gap: 0.55rem;
                padding: 0.3rem 0.7rem 0.3rem 0.3rem;
                background: var(--white);
                border: 1.5px solid var(--border-md);
                border-radius: 999px;
                cursor: pointer;
                transition: border-color 0.2s, box-shadow 0.2s;
                position: relative;
                flex-shrink: 0;
            }
            .user-pill:hover {
                border-color: var(--gold);
                box-shadow: 0 2px 8px rgba(201,168,76,0.12);
            }
            .user-avatar {
                width: 28px; height: 28px;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--gold), var(--gold-dark));
                display: flex; align-items: center; justify-content: center;
                font-family: var(--font-display);
                font-size: 0.68rem; font-weight: 700;
                color: var(--white); flex-shrink: 0;
                overflow: hidden;
            }
            .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
            .user-name {
                font-size: 0.79rem; font-weight: 500;
                color: var(--charcoal);
                max-width: 110px;
                white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            }
            .user-role-chip {
                font-size: 0.6rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase;
                color: var(--gold-dark); background: rgba(201,168,76,0.1);
                border: 1px solid rgba(201,168,76,0.25);
                padding: 1px 7px; border-radius: 999px;
                white-space: nowrap;
            }
            .user-pill > svg { width: 11px; height: 11px; color: #C0B8B0; }

            /* Dropdown */
            .user-dropdown {
                display: none;
                position: absolute;
                top: calc(100% + 8px);
                right: 0;
                min-width: 210px;
                background: var(--white);
                border: 1px solid var(--border-md);
                border-top: 2px solid var(--gold);
                border-radius: 4px;
                box-shadow: 0 8px 32px rgba(30,27,24,0.12);
                padding: 0.5rem;
                z-index: 400;
            }
            .user-pill:hover .user-dropdown,
            .user-pill:focus-within .user-dropdown { display: block; }

            .dropdown-user-header {
                display: flex; align-items: center; gap: 0.65rem;
                padding: 0.6rem 0.75rem 0.75rem;
                border-bottom: 1px solid var(--border);
                margin-bottom: 0.4rem;
            }
            .dropdown-user-avatar {
                width: 36px; height: 36px; border-radius: 50%;
                background: linear-gradient(135deg, var(--gold), var(--gold-dark));
                display: flex; align-items: center; justify-content: center;
                font-family: var(--font-display); font-size: 0.85rem; font-weight: 700;
                color: var(--white); flex-shrink: 0; overflow: hidden;
            }
            .dropdown-user-avatar img { width: 100%; height: 100%; object-fit: cover; }
            .dropdown-user-name { font-size: 0.84rem; font-weight: 600; color: var(--charcoal); }
            .dropdown-user-email { font-size: 0.68rem; color: var(--warm-grey); margin-top: 1px; }

            .dropdown-item {
                display: flex; align-items: center; gap: 0.6rem;
                padding: 0.58rem 0.75rem;
                border-radius: 3px;
                font-size: 0.81rem;
                color: var(--charcoal);
                text-decoration: none;
                transition: background 0.15s, color 0.15s;
                cursor: pointer;
                border: none; background: none; width: 100%; text-align: left;
                font-family: var(--font-body);
            }
            .dropdown-item svg { width: 14px; height: 14px; color: var(--warm-grey); flex-shrink: 0; }
            .dropdown-item:hover { background: var(--ivory); color: var(--gold-dark); }
            .dropdown-item:hover svg { color: var(--gold-dark); }
            .dropdown-divider { height: 1px; background: var(--border); margin: 0.35rem 0; }
            .dropdown-item.danger { color: #B91C1C; }
            .dropdown-item.danger svg { color: #B91C1C; }
            .dropdown-item.danger:hover { background: #FEF2F2; }

            /* ════════════════════════════════
               MAIN CONTENT — full screen
            ════════════════════════════════ */
            .main-wrapper {
                padding-top: var(--topbar-h);
                min-height: 100vh;
                background: var(--ivory);
            }

            .page-content { padding: 0; }

            /* ── Scrollbar ── */
            ::-webkit-scrollbar { width: 4px; height: 4px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { background: #DDD4C8; border-radius: 3px; }
            ::-webkit-scrollbar-thumb:hover { background: var(--gold); }
        </style>
    </head>
    <body>

        {{-- TOP BAR — navigation only, no logo, no heading --}}
        <header class="topbar">
            @auth
                @include('layouts.navigation')
            @endauth
        </header>

        {{-- MAIN --}}
        <div class="main-wrapper">
            <main class="page-content">
                {{ $slot }}
            </main>
        </div>

    </body>
</html>