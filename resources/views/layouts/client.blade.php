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
            --gold-pale:   #F5EDD8;
            --ivory:       #FAF7F2;
            --charcoal:    #1E1B18;
            --warm-grey:   #6B6560;
            --topbar-h:    64px;
            --white:       #FFFFFF;
            --border:      #F0EBE5;
            --border-md:   #E0D8D0;
            --font-display:'Playfair Display', Georgia, serif;
            --font-body:   'DM Sans', sans-serif;
            --ease-out:    cubic-bezier(0.16, 1, 0.3, 1);
        }

        html, body {
            height: 100%;
            font-family: var(--font-body);
            background: var(--ivory);
            color: var(--charcoal);
            overflow-x: hidden;
        }

        /* ══════════════════════════════════
           TOP BAR
        ══════════════════════════════════ */
        .topbar {
            position: fixed; top: 0; left: 0; right: 0;
            height: var(--topbar-h); z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 1.75rem;
            background: rgba(250,247,242,0.97);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(201,168,76,0.2);
            gap: 1rem;
        }

        /* ── Logo ── */
        .topbar-left { display: flex; align-items: center; gap: 0; }
        .topbar-logo {
            font-family: var(--font-display);
            font-size: 1.25rem; font-weight: 700;
            color: var(--charcoal); text-decoration: none; white-space: nowrap;
            flex-shrink: 0;
        }
        .topbar-logo em { color: var(--gold-dark); font-style: italic; }
        .topbar-logo-divider {
            width: 1px; height: 22px;
            background: var(--border-md);
            margin: 0 1.1rem; flex-shrink: 0;
        }

        /* ══════════════════════════════════
           DESKTOP NAV ITEMS
        ══════════════════════════════════ */
        .topbar-nav {
            display: flex; align-items: center; gap: 0.15rem;
        }

        /* ── Base state ── */
        .topbar-nav-item {
            display: inline-flex; align-items: center; gap: 0.38rem;
            padding: 0.42rem 0.85rem;
            border-radius: 7px;
            font-family: var(--font-body);
            font-size: 0.8rem; font-weight: 400;
            color: var(--warm-grey);
            text-decoration: none;
            border-bottom: 2px solid transparent;
            transition: color 0.18s, background 0.18s, border-color 0.18s;
            position: relative; white-space: nowrap;
        }
        .topbar-nav-item svg { width: 14px; height: 14px; flex-shrink: 0; opacity: 0.65; transition: opacity 0.18s; }
        .topbar-nav-item .label { letter-spacing: 0.01em; }

        /* ── Hover ── */
        .topbar-nav-item:hover {
            color: var(--gold-dark);
            background: rgba(201,168,76,0.07);
        }
        .topbar-nav-item:hover svg { opacity: 1; }

        /* ── ACTIVE ── */
        .topbar-nav-item.active {
            color: var(--gold-dark);
            background: rgba(201,168,76,0.1);
            font-weight: 500;
            border-bottom-color: var(--gold);
        }
        .topbar-nav-item.active svg { opacity: 1; color: var(--gold-dark); }

        /* Badge on nav item */
        .topbar-nav-badge {
            display: inline-flex; align-items: center; justify-content: center;
            min-width: 16px; height: 16px; border-radius: 999px;
            background: var(--gold); color: var(--charcoal);
            font-size: 0.54rem; font-weight: 700; padding: 0 4px; line-height: 1;
        }
        .topbar-nav-item.active .topbar-nav-badge {
            background: var(--gold-dark); color: var(--white);
        }

        /* ── Right controls ── */
        .topbar-right { display: flex; align-items: center; gap: 0.6rem; flex-shrink: 0; }

        /* Search */
        .topbar-search {
            display: flex; align-items: center; gap: 0.45rem;
            background: var(--white); border: 1.5px solid var(--border-md);
            border-radius: 8px; padding: 0.4rem 0.85rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .topbar-search:focus-within {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
        }
        .topbar-search svg { width: 13px; height: 13px; color: #C0B8B0; flex-shrink: 0; }
        .topbar-search input {
            border: none; outline: none; background: transparent;
            font-family: var(--font-body); font-size: 0.78rem;
            color: var(--charcoal); width: 160px;
        }
        .topbar-search input::placeholder { color: #C0B8B0; }

        /* Icon button */
        .icon-btn {
            width: 36px; height: 36px; border-radius: 8px;
            border: 1.5px solid var(--border-md); background: var(--white);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--warm-grey);
            transition: border-color 0.2s, color 0.2s, background 0.2s;
            position: relative; text-decoration: none; flex-shrink: 0;
        }
        .icon-btn:hover { border-color: var(--gold); color: var(--gold-dark); background: rgba(201,168,76,0.06); }
        .icon-btn svg { width: 16px; height: 16px; }
        .icon-btn.active-btn { border-color: rgba(201,168,76,0.45); color: var(--gold-dark); background: rgba(201,168,76,0.08); }

        /* Notification count */
        .notif-wrap { position: relative; }
        .notif-count {
            position: absolute; top: -4px; right: -4px;
            min-width: 16px; height: 16px; border-radius: 999px;
            background: var(--gold); color: var(--charcoal);
            font-size: 0.54rem; font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            border: 2px solid var(--ivory); padding: 0 3px;
        }

        /* ══════════════════════════════════
           NOTIFICATION DROPDOWN
        ══════════════════════════════════ */
        .notif-dropdown {
            display: none; position: absolute;
            top: calc(100% + 10px); right: 0;
            width: 340px; background: var(--white);
            border: 1px solid var(--border-md);
            border-top: 2px solid var(--gold);
            border-radius: 4px;
            box-shadow: 0 12px 40px rgba(30,27,24,0.13);
            z-index: 400; overflow: hidden;
        }
        .notif-dropdown.open { display: block; }

        .notif-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0.9rem 1.1rem 0.75rem;
            border-bottom: 1px solid var(--border);
        }
        .notif-header-l { display: flex; align-items: center; gap: 0.5rem; }
        .notif-header-title {
            font-family: var(--font-display); font-size: 0.95rem; font-weight: 700; color: var(--charcoal);
        }
        .notif-header-title em { font-style: italic; color: var(--gold-dark); }
        .notif-unread-pill {
            font-size: 0.56rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase;
            background: rgba(201,168,76,0.12); color: var(--gold-dark);
            border: 1px solid rgba(201,168,76,0.25); padding: 2px 8px; border-radius: 999px;
        }
        .notif-mark-all {
            font-size: 0.68rem; font-weight: 500; color: var(--warm-grey);
            background: none; border: none; cursor: pointer; font-family: var(--font-body);
            transition: color 0.2s;
        }
        .notif-mark-all:hover { color: var(--gold-dark); }

        .notif-list { max-height: 320px; overflow-y: auto; }
        .notif-item {
            display: flex; align-items: flex-start; gap: 0.75rem;
            padding: 0.85rem 1.1rem; text-decoration: none;
            border-bottom: 1px solid var(--border); transition: background 0.15s;
        }
        .notif-item:last-child { border-bottom: none; }
        .notif-item:hover { background: #FDFAF6; }
        .notif-item.unread { background: rgba(201,168,76,0.04); }
        .notif-item.unread:hover { background: rgba(201,168,76,0.08); }

        .notif-icon {
            width: 32px; height: 32px; border-radius: 8px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
        }
        .notif-icon svg { width: 15px; height: 15px; }
        .notif-icon.icon-booking { background: rgba(201,168,76,0.12); color: var(--gold-dark); }
        .notif-icon.icon-cancel  { background: rgba(184,64,64,0.1);   color: #B84040; }
        .notif-icon.icon-message { background: rgba(45,122,79,0.1);   color: #2D7A4F; }
        .notif-icon.icon-system  { background: rgba(107,101,96,0.1);  color: var(--warm-grey); }

        .notif-content { flex: 1; min-width: 0; }
        .notif-title { font-size: 0.78rem; font-weight: 600; color: var(--charcoal); line-height: 1.3; margin-bottom: 2px; }
        .notif-msg { font-size: 0.72rem; color: var(--warm-grey); line-height: 1.45; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .notif-time { display: flex; align-items: center; gap: 0.25rem; font-size: 0.65rem; color: #C0B8B0; margin-top: 4px; }
        .notif-time svg { width: 10px; height: 10px; }
        .notif-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--gold); flex-shrink: 0; margin-top: 5px; }

        .notif-empty { padding: 2.5rem 1rem; text-align: center; }
        .notif-empty-icon {
            width: 44px; height: 44px; border-radius: 50%;
            background: rgba(201,168,76,0.08);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 0.65rem; color: var(--gold-dark);
        }
        .notif-empty-icon svg { width: 20px; height: 20px; }
        .notif-empty-text { font-family: var(--font-display); font-size: 0.9rem; font-weight: 700; color: var(--charcoal); }
        .notif-empty-sub { font-size: 0.72rem; color: var(--warm-grey); margin-top: 3px; }
        .notif-footer { padding: 0.7rem 1.1rem; border-top: 1px solid var(--border); }
        .notif-see-all {
            display: flex; align-items: center; justify-content: center; gap: 0.35rem;
            font-size: 0.75rem; font-weight: 500; color: var(--gold-dark); text-decoration: none;
            transition: color 0.2s;
        }
        .notif-see-all:hover { color: var(--charcoal); }
        .notif-see-all svg { width: 12px; height: 12px; }

        /* ══════════════════════════════════
           MESSAGES DROPDOWN (custom, no Bootstrap)
        ══════════════════════════════════ */
        .msg-wrap { position: relative; }
        .msg-dropdown {
            display: none; position: absolute;
            top: calc(100% + 10px); right: 0;
            width: 300px; background: var(--white);
            border: 1px solid var(--border-md);
            border-top: 2px solid var(--gold);
            border-radius: 4px;
            box-shadow: 0 12px 40px rgba(30,27,24,0.13);
            z-index: 400; overflow: hidden;
        }
        .msg-dropdown.open { display: block; }

        .msg-dropdown-head {
            padding: 0.85rem 1.1rem 0.65rem;
            border-bottom: 1px solid var(--border);
            font-family: var(--font-display); font-size: 0.92rem; font-weight: 700; color: var(--charcoal);
        }
        .msg-dropdown-head em { font-style: italic; color: var(--gold-dark); }

        .msg-list { max-height: 280px; overflow-y: auto; }
        .msg-item {
            display: flex; align-items: center; gap: 0.65rem;
            padding: 0.75rem 1.1rem; text-decoration: none;
            border-bottom: 1px solid var(--border); transition: background 0.15s;
        }
        .msg-item:last-child { border-bottom: none; }
        .msg-item:hover { background: #FDFAF6; }
        .msg-ava {
            width: 32px; height: 32px; border-radius: 50%; flex-shrink: 0;
            background: var(--charcoal);
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display); font-size: 0.65rem; font-weight: 700;
            color: var(--gold); border: 1.5px solid var(--border-md); overflow: hidden;
        }
        .msg-ava img { width: 100%; height: 100%; object-fit: cover; }
        .msg-biz { font-size: 0.78rem; font-weight: 600; color: var(--charcoal); line-height: 1.2; }
        .msg-name { font-size: 0.67rem; color: var(--warm-grey); }

        .msg-empty { padding: 1.75rem 1rem; text-align: center; font-size: 0.78rem; color: var(--warm-grey); }
        .msg-footer { padding: 0.65rem 1.1rem; border-top: 1px solid var(--border); }
        .msg-see-all {
            display: flex; align-items: center; justify-content: center; gap: 0.35rem;
            font-size: 0.75rem; font-weight: 600; color: var(--gold-dark); text-decoration: none;
            transition: color 0.2s;
        }
        .msg-see-all:hover { color: var(--charcoal); }
        .msg-see-all svg { width: 12px; height: 12px; }

        /* ══════════════════════════════════
           USER PILL + DROPDOWN
        ══════════════════════════════════ */
        .user-pill {
            display: flex; align-items: center; gap: 0.55rem;
            padding: 0.3rem 0.7rem 0.3rem 0.3rem;
            background: var(--white); border: 1.5px solid var(--border-md);
            border-radius: 999px; cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s;
            position: relative; flex-shrink: 0;
        }
        .user-pill:hover { border-color: var(--gold); box-shadow: 0 2px 8px rgba(201,168,76,0.12); }
        .user-avatar {
            width: 28px; height: 28px; border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display); font-size: 0.68rem; font-weight: 700;
            color: var(--white); flex-shrink: 0; overflow: hidden;
        }
        .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .user-name { font-size: 0.79rem; font-weight: 500; color: var(--charcoal); max-width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-role-chip {
            font-size: 0.6rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase;
            color: var(--gold-dark); background: rgba(201,168,76,0.1);
            border: 1px solid rgba(201,168,76,0.25); padding: 1px 7px; border-radius: 999px; white-space: nowrap;
        }
        .user-pill > svg { width: 11px; height: 11px; color: #C0B8B0; }

        .user-dropdown {
            display: none; position: absolute;
            top: calc(100% + 8px); right: 0;
            min-width: 215px; background: var(--white);
            border: 1px solid var(--border-md);
            border-top: 2px solid var(--gold);
            border-radius: 4px;
            box-shadow: 0 8px 32px rgba(30,27,24,0.12);
            padding: 0.5rem; z-index: 400;
        }
        .user-pill:hover .user-dropdown,
        .user-pill:focus-within .user-dropdown { display: block; }

        .dropdown-user-header {
            display: flex; align-items: center; gap: 0.65rem;
            padding: 0.6rem 0.75rem 0.75rem;
            border-bottom: 1px solid var(--border); margin-bottom: 0.4rem;
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
            padding: 0.55rem 0.75rem; border-radius: 4px;
            font-size: 0.81rem; color: var(--charcoal); text-decoration: none;
            transition: background 0.15s, color 0.15s; cursor: pointer;
            border: none; background: none; width: 100%; text-align: left; font-family: var(--font-body);
        }
        .dropdown-item svg { width: 14px; height: 14px; color: var(--warm-grey); flex-shrink: 0; }
        .dropdown-item:hover { background: var(--ivory); color: var(--gold-dark); }
        .dropdown-item:hover svg { color: var(--gold-dark); }

        /* Active item in dropdown */
        .dropdown-item.active-page {
            background: rgba(201,168,76,0.08);
            color: var(--gold-dark); font-weight: 500;
        }
        .dropdown-item.active-page svg { color: var(--gold-dark); }

        .dropdown-divider { height: 1px; background: var(--border); margin: 0.35rem 0; }
        .dropdown-item.danger { color: #B91C1C; }
        .dropdown-item.danger svg { color: #B91C1C; }
        .dropdown-item.danger:hover { background: #FEF2F2; }

        /* Hamburger */
        .hamburger-btn {
            display: none; width: 36px; height: 36px;
            border-radius: 8px; border: 1.5px solid var(--border-md);
            background: var(--white); flex-direction: column;
            align-items: center; justify-content: center; gap: 4.5px;
            cursor: pointer; padding: 9px;
        }
        .hamburger-btn span {
            display: block; width: 100%; height: 2px;
            background: var(--charcoal); border-radius: 2px;
            transition: transform 0.3s, opacity 0.3s, background 0.2s;
        }
        .hamburger-btn.open span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); background: var(--gold-dark); }
        .hamburger-btn.open span:nth-child(2) { opacity: 0; }
        .hamburger-btn.open span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); background: var(--gold-dark); }

        /* ══════════════════════════════════
           MOBILE DROPDOWN MENU
        ══════════════════════════════════ */
        .mob-dropdown-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(30,27,24,0.45); z-index: 150;
            backdrop-filter: blur(2px);
        }
        .mob-dropdown-overlay.visible { display: block; }

        .mobile-dropdown {
            display: none; position: fixed;
            top: var(--topbar-h); left: 0; right: 0;
            background: var(--white);
            border-bottom: 1px solid var(--border-md);
            z-index: 200; overflow-y: auto; max-height: calc(100vh - var(--topbar-h));
            box-shadow: 0 12px 40px rgba(30,27,24,0.12);
            transform: translateY(-8px);
            opacity: 0;
            transition: transform 0.3s var(--ease-out), opacity 0.25s;
            padding-bottom: 1.5rem;
        }
        .mobile-dropdown.open {
            display: block;
            transform: translateY(0);
            opacity: 1;
        }

        /* User strip at top of mobile menu */
        .mob-user-strip {
            display: flex; align-items: center; gap: 0.85rem;
            padding: 1.1rem 1.25rem 0.9rem;
            border-bottom: 1px solid var(--border);
            background: var(--charcoal);
        }
        .mob-user-avatar {
            width: 38px; height: 38px; border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display); font-size: 0.8rem; font-weight: 700;
            color: var(--white); flex-shrink: 0; overflow: hidden;
            border: 2px solid rgba(201,168,76,0.4);
        }
        .mob-user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .mob-user-name { font-size: 0.85rem; font-weight: 600; color: var(--white); }
        .mob-user-role {
            font-size: 0.6rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase;
            color: var(--gold-light); margin-top: 2px;
        }

        /* Mobile search */
        .mob-search-wrap { padding: 0.9rem 1.25rem 0.5rem; }
        .mob-search-inner {
            display: flex; align-items: center; gap: 0.5rem;
            background: var(--ivory); border: 1.5px solid var(--border-md);
            border-radius: 8px; padding: 0.52rem 0.9rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .mob-search-inner:focus-within {
            border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
        }
        .mob-search-inner svg { width: 14px; height: 14px; color: #C0B8B0; flex-shrink: 0; }
        .mob-search-inner input {
            border: none; outline: none; background: transparent;
            font-family: var(--font-body); font-size: 0.82rem; color: var(--charcoal); width: 100%;
        }
        .mob-search-inner input::placeholder { color: #C0B8B0; }

        /* Group label */
        .mob-nav-label {
            font-size: 0.52rem; font-weight: 700; letter-spacing: 0.18em; text-transform: uppercase;
            color: #C0B8B0; padding: 0.75rem 1.25rem 0.3rem;
        }

        /* ══ MOBILE NAV ITEM ══ */
        .mob-nav-item {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.72rem 1.25rem;
            font-family: var(--font-body); font-size: 0.85rem; font-weight: 400;
            color: var(--warm-grey); text-decoration: none;
            transition: background 0.18s, color 0.18s, border-left-color 0.18s;
            border-left: 3px solid transparent;
            position: relative;
        }
        .mob-nav-item svg { width: 17px; height: 17px; flex-shrink: 0; opacity: 0.6; transition: opacity 0.18s; }

        /* Hover */
        .mob-nav-item:hover {
            background: rgba(201,168,76,0.06);
            color: var(--gold-dark);
            border-left-color: rgba(201,168,76,0.3);
        }
        .mob-nav-item:hover svg { opacity: 1; }

        /* ══ ACTIVE ══ */
        .mob-nav-item.active {
            background: linear-gradient(90deg, rgba(201,168,76,0.12) 0%, rgba(201,168,76,0.04) 100%);
            color: var(--gold-dark);
            font-weight: 600;
            border-left-color: var(--gold);
        }
        .mob-nav-item.active svg { opacity: 1; color: var(--gold-dark); }

        /* Badge */
        .mob-nav-badge {
            margin-left: auto; background: var(--gold); color: var(--charcoal);
            font-size: 0.56rem; font-weight: 700; padding: 1px 6px;
            border-radius: 999px; line-height: 1.6;
        }
        .mob-nav-item.active .mob-nav-badge { background: var(--gold-dark); color: var(--white); }

        .mob-divider { height: 1px; background: var(--border); margin: 0.5rem 1.25rem; }

        /* Sign out row */
        .mob-signout-row { padding: 0.75rem 1.25rem 0; }
        .mob-signout-btn {
            display: flex; align-items: center; gap: 0.65rem;
            width: 100%; padding: 0.7rem 1rem; border-radius: 8px;
            background: rgba(185,28,28,0.06); border: 1px solid rgba(185,28,28,0.18);
            font-family: var(--font-body); font-size: 0.82rem; font-weight: 500;
            color: #B91C1C; cursor: pointer;
            transition: background 0.2s;
        }
        .mob-signout-btn:hover { background: rgba(185,28,28,0.12); }
        .mob-signout-btn svg { width: 15px; height: 15px; }

        /* ══════════════════════════════════
           MAIN CONTENT
        ══════════════════════════════════ */
        .main-wrapper { padding-top: var(--topbar-h); min-height: 100vh; background: var(--ivory); }
        .page-content { padding: 0; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #DDD4C8; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--gold); }

        /* ══ Responsive ══ */
        @media (max-width: 960px) {
            .topbar-nav { display: none; }
            .topbar-logo-divider { display: none; }
        }
        @media (max-width: 640px) {
            .topbar-search { display: none; }
            .user-name { display: none; }
            .user-role-chip { display: none; }
            .topbar { padding: 0 1rem; }
        }
        @media (max-width: 960px) {
            .hamburger-btn { display: flex; }
            /* Hide desktop msg icon on mobile since it's in the drawer */
            .msg-wrap { display: none; }
        }
    </style>
</head>
<body>

    {{-- ══════════════════════════════════
         TOP BAR
    ══════════════════════════════════ --}}
    <header class="topbar">
        @auth
           @include('layouts.navigation')
        @endauth
    </header>

    {{-- ══ MAIN ══ --}}
    <div class="main-wrapper">
        <main class="page-content">
            {{ $slot }}
        </main>
    </div>

    <script>
        /* ══ Hamburger / mobile dropdown ══ */
        const hamburgerBtn    = document.getElementById('hamburgerBtn');
        const mobileDropdown  = document.getElementById('mobileDropdown');
        const mobOverlay      = document.getElementById('mobDropdownOverlay');

        hamburgerBtn?.addEventListener('click', () => {
            const isOpen = mobileDropdown.classList.toggle('open');
            hamburgerBtn.classList.toggle('open', isOpen);
            mobOverlay.classList.toggle('visible', isOpen);
            document.body.style.overflow = isOpen ? 'hidden' : '';
        });

        function closeMobDropdown() {
            mobileDropdown?.classList.remove('open');
            hamburgerBtn?.classList.remove('open');
            mobOverlay?.classList.remove('visible');
            document.body.style.overflow = '';
        }

        /* ══ Notification dropdown ══ */
        function toggleNotif(e) {
            e.stopPropagation();
            document.getElementById('msgDropdown')?.classList.remove('open');
            document.getElementById('notifDropdown').classList.toggle('open');
        }

        /* ══ Messages dropdown ══ */
        function toggleMsg(e) {
            e.stopPropagation();
            document.getElementById('notifDropdown')?.classList.remove('open');
            document.getElementById('msgDropdown').classList.toggle('open');
        }

        /* ══ Close all dropdowns on outside click ══ */
        document.addEventListener('click', () => {
            document.getElementById('notifDropdown')?.classList.remove('open');
            document.getElementById('msgDropdown')?.classList.remove('open');
        });

        /* ══ Notification helpers ══ */
        function markAsRead(e, id) {
            fetch(`/notifications/${id}/read`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }
            }).catch(() => {});
        }
        function markAllRead(e) {
            e.stopPropagation();
            fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }
            }).then(() => location.reload()).catch(() => {});
        }
    </script>
</body>
</html>