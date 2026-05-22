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
            --charcoal-2:  #252018;
            --warm-grey:   #6B6560;
            --sidebar-w:   260px;
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
           TOP BAR
        ════════════════════════════════ */
        .topbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: var(--topbar-h);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem 0 calc(var(--sidebar-w) + 1.5rem);
            background: rgba(250,247,242,0.96);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(201,168,76,0.18);
            transition: padding 0.3s;
            gap: 1rem;
        }
        .topbar.sidebar-collapsed { padding-left: calc(72px + 1.5rem); }

        .topbar-heading {
            display: flex; flex-direction: column;
            justify-content: center; gap: 0.12rem;
            flex: 1; min-width: 0;
        }
        .topbar-heading h1,
        .topbar-heading h2 {
            font-family: var(--font-display);
            font-size: 1.2rem; font-weight: 700;
            color: var(--charcoal); line-height: 1.2;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            letter-spacing: normal;
        }
        .topbar-heading h1 em,
        .topbar-heading h2 em { color: var(--gold-dark); font-style: italic; }

        .topbar-breadcrumb {
            display: flex; align-items: center; gap: 0.4rem;
            font-size: 0.7rem; color: var(--warm-grey);
            letter-spacing: 0.02em; white-space: nowrap;
        }
        .topbar-breadcrumb .bc-active { color: var(--gold-dark); font-weight: 500; }
        .topbar-breadcrumb svg { width: 9px; height: 9px; color: #C0B8B0; flex-shrink: 0; }

        .topbar-right {
            display: flex; align-items: center; gap: 0.65rem; flex-shrink: 0;
        }

        /* Search */
        .topbar-search {
            display: flex; align-items: center; gap: 0.5rem;
            background: var(--white); border: 1.5px solid var(--border-md);
            border-radius: 8px; padding: 0.42rem 0.9rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .topbar-search:focus-within {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
        }
        .topbar-search svg { width: 13px; height: 13px; color: #C0B8B0; flex-shrink: 0; }
        .topbar-search input {
            border: none; outline: none; background: transparent;
            font-family: var(--font-body); font-size: 0.79rem; color: var(--charcoal); width: 175px;
        }
        .topbar-search input::placeholder { color: #C0B8B0; }

        /* Icon buttons */
        .icon-btn {
            width: 36px; height: 36px; border-radius: 8px;
            border: 1.5px solid var(--border-md); background: var(--white);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--warm-grey);
            transition: border-color 0.2s, color 0.2s, background 0.2s;
            position: relative; text-decoration: none;
        }
        .icon-btn:hover { border-color: var(--gold); color: var(--gold-dark); background: rgba(201,168,76,0.06); }
        .icon-btn svg { width: 16px; height: 16px; }
        .notif-badge {
            position: absolute; top: -3px; right: -3px;
            width: 8px; height: 8px; border-radius: 50%;
            background: var(--gold); border: 2px solid var(--ivory);
        }

        /* Notification wrap */
        .notif-wrap { position: relative; }
        .notif-count {
            position: absolute; top: -4px; right: -4px;
            min-width: 16px; height: 16px; border-radius: 999px;
            background: var(--gold); color: var(--charcoal);
            font-size: 0.55rem; font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            border: 2px solid var(--ivory); padding: 0 3px;
        }

        /* Notification dropdown */
        .notif-dropdown {
            display: none; position: absolute; top: calc(100% + 10px); right: 0;
            width: 340px; background: var(--white);
            border: 1px solid var(--border-md); border-radius: 12px;
            box-shadow: 0 12px 40px rgba(30,27,24,0.14);
            z-index: 200; overflow: hidden;
        }
        .notif-dropdown.open { display: block; }

        .notif-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 1.1rem 0.75rem;
            border-bottom: 1px solid var(--border);
        }
        .notif-header-l { display: flex; align-items: center; gap: 0.5rem; }
        .notif-header-title {
            font-family: var(--font-display); font-size: 0.95rem; font-weight: 700; color: var(--charcoal);
        }
        .notif-header-title em { font-style: italic; color: var(--gold-dark); }
        .notif-unread-pill {
            font-size: 0.58rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase;
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
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
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
        .notif-icon.icon-cancel  { background: rgba(184,64,64,0.1); color: #B84040; }
        .notif-icon.icon-message { background: rgba(45,122,79,0.1); color: #2D7A4F; }
        .notif-icon.icon-system  { background: rgba(107,101,96,0.1); color: var(--warm-grey); }

        .notif-content { flex: 1; min-width: 0; }
        .notif-title { font-size: 0.78rem; font-weight: 600; color: var(--charcoal); line-height: 1.3; margin-bottom: 2px; }
        .notif-msg { font-size: 0.72rem; color: var(--warm-grey); line-height: 1.45; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .notif-time { display: flex; align-items: center; gap: 0.25rem; font-size: 0.65rem; color: #C0B8B0; margin-top: 4px; }
        .notif-time svg { width: 10px; height: 10px; }
        .notif-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--gold); flex-shrink: 0; margin-top: 5px; }

        .notif-empty { padding: 2.5rem 1rem; text-align: center; }
        .notif-empty-icon { width: 44px; height: 44px; border-radius: 50%; background: rgba(201,168,76,0.08); display: flex; align-items: center; justify-content: center; margin: 0 auto 0.65rem; color: var(--gold-dark); }
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

        /* User pill */
        .user-pill {
            display: flex; align-items: center; gap: 0.55rem;
            padding: 0.3rem 0.7rem 0.3rem 0.3rem;
            background: var(--white); border: 1.5px solid var(--border-md);
            border-radius: 999px; cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s;
            position: relative;
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

        /* User dropdown */
        .user-dropdown {
            display: none; position: absolute; top: calc(100% + 8px); right: 0;
            min-width: 210px; background: var(--white);
            border: 1px solid var(--border-md); border-radius: 10px;
            box-shadow: 0 8px 32px rgba(30,27,24,0.12);
            padding: 0.5rem; z-index: 200;
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
            padding: 0.58rem 0.75rem; border-radius: 6px;
            font-size: 0.81rem; color: var(--charcoal); text-decoration: none;
            transition: background 0.15s, color 0.15s; cursor: pointer;
            border: none; background: none; width: 100%; text-align: left; font-family: var(--font-body);
        }
        .dropdown-item svg { width: 14px; height: 14px; color: var(--warm-grey); flex-shrink: 0; }
        .dropdown-item:hover { background: var(--ivory); color: var(--gold-dark); }
        .dropdown-item:hover svg { color: var(--gold-dark); }
        .dropdown-divider { height: 1px; background: var(--border); margin: 0.35rem 0; }
        .dropdown-item.danger { color: #B91C1C; }
        .dropdown-item.danger svg { color: #B91C1C; }
        .dropdown-item.danger:hover { background: #FEF2F2; }

        /* ════════════════════════════════
           SIDEBAR
        ════════════════════════════════ */
        .sidebar {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: var(--sidebar-w); background: var(--charcoal);
            display: flex; flex-direction: column;
            z-index: 110;
            transition: width 0.3s cubic-bezier(0.4,0,0.2,1);
            overflow: hidden;
        }
        .sidebar.collapsed { width: 72px; }

        /* Sidebar header */
        .sidebar-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 1.1rem; height: var(--topbar-h);
            border-bottom: 1px solid rgba(201,168,76,0.12);
            flex-shrink: 0; position: relative;
        }
        .sidebar-header::after {
            content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201,168,76,0.35), transparent);
        }

        .sidebar-logo {
            font-family: var(--font-display); font-size: 1.2rem; font-weight: 700;
            color: var(--white); white-space: nowrap; overflow: hidden;
            opacity: 1; transition: opacity 0.2s; text-decoration: none; line-height: 1.2;
        }
        .sidebar-logo em { color: var(--gold-light); font-style: italic; }
        .sidebar.collapsed .sidebar-logo { opacity: 0; pointer-events: none; }

        .sidebar-toggle {
            width: 28px; height: 28px; border-radius: 6px;
            border: 1px solid rgba(201,168,76,0.2);
            background: rgba(201,168,76,0.08);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: rgba(255,255,255,0.5);
            transition: background 0.2s, color 0.2s; flex-shrink: 0;
        }
        .sidebar-toggle:hover { background: rgba(201,168,76,0.18); color: var(--gold-light); }
        .sidebar-toggle svg { width: 14px; height: 14px; transition: transform 0.3s; }
        .sidebar.collapsed .sidebar-toggle svg { transform: rotate(180deg); }

        /* Nav scroll area */
        .sidebar-nav { flex: 1; overflow-y: auto; overflow-x: hidden; padding: 0.75rem 0; scrollbar-width: none; }
        .sidebar-nav::-webkit-scrollbar { display: none; }

        /* Group label */
        .nav-group-label {
            font-size: 0.55rem; letter-spacing: 0.16em; text-transform: uppercase;
            color: rgba(255,255,255,0.2); padding: 0.85rem 1.25rem 0.3rem;
            white-space: nowrap; overflow: hidden; transition: opacity 0.2s;
            font-weight: 600;
        }
        .sidebar.collapsed .nav-group-label { opacity: 0; }

        /* ══ NAV ITEM — base ══ */
        .nav-item {
            display: flex; align-items: center; gap: 0.85rem;
            padding: 0.65rem 1.1rem;
            color: rgba(255,255,255,0.42);
            text-decoration: none; font-size: 0.82rem;
            font-weight: 400; letter-spacing: 0.01em;
            transition: background 0.18s, color 0.18s, padding 0.3s;
            position: relative; white-space: nowrap;
            cursor: pointer; border: none; background: none;
            width: 100%; text-align: left; font-family: var(--font-body);
            border-left: 3px solid transparent;
        }
        .sidebar.collapsed .nav-item { padding: 0.65rem; justify-content: center; }

        .nav-item svg:first-of-type { width: 17px; height: 17px; flex-shrink: 0; transition: color 0.18s; }
        .nav-item > span:not(.nav-tooltip):not(.nav-badge):not(.nav-arrow) {
            transition: opacity 0.2s, width 0.3s; overflow: hidden; flex: 1;
        }
        .sidebar.collapsed .nav-item > span:not(.nav-tooltip):not(.nav-badge):not(.nav-arrow) { opacity: 0; width: 0; }

        /* ══ HOVER ══ */
        .nav-item:hover {
            background: rgba(201,168,76,0.08);
            color: rgba(255,255,255,0.82);
            border-left-color: rgba(201,168,76,0.3);
        }

        /* ══ ACTIVE ══ */
        .nav-item.active {
            background: linear-gradient(90deg, rgba(201,168,76,0.18) 0%, rgba(201,168,76,0.06) 100%);
            color: var(--gold-light);
            font-weight: 500;
            border-left-color: var(--gold);
        }
        .nav-item.active svg:first-of-type { color: var(--gold); }

        /* Collapsed — active still shows the gold left border */
        .sidebar.collapsed .nav-item.active {
            background: rgba(201,168,76,0.14);
            border-left-color: var(--gold);
        }

        /* Tooltip (collapsed only) */
        .nav-item .nav-tooltip {
            display: none; position: absolute; left: 100%; top: 50%;
            transform: translateY(-50%); margin-left: 10px;
            background: var(--charcoal-2, #252018);
            border: 1px solid rgba(201,168,76,0.22);
            color: var(--white); font-size: 0.74rem;
            padding: 0.3rem 0.7rem; border-radius: 6px;
            white-space: nowrap; pointer-events: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.25); z-index: 300;
        }
        .sidebar.collapsed .nav-item:hover .nav-tooltip { display: block; }

        /* Badge */
        .nav-badge {
            margin-left: auto; background: var(--gold); color: var(--charcoal);
            font-size: 0.56rem; font-weight: 700;
            padding: 0.1rem 0.42rem; border-radius: 999px;
            flex-shrink: 0; transition: opacity 0.2s; line-height: 1.6;
        }
        .sidebar.collapsed .nav-badge { opacity: 0; width: 0; overflow: hidden; padding: 0; }

        /* Divider */
        .sidebar-divider { height: 1px; background: rgba(201,168,76,0.1); margin: 0.5rem 1.1rem; }
        .sidebar.collapsed .sidebar-divider { margin: 0.5rem 0.85rem; }

        /* ══════════════════════════════════
           SETTINGS SUBMENU
        ══════════════════════════════════ */
        .nav-item-group {}

        /* Arrow icon on Settings row */
        .nav-arrow {
            width: 12px !important; height: 12px !important;
            margin-left: auto; flex-shrink: 0;
            transition: transform 0.25s var(--ease-out, ease), opacity 0.2s !important;
            color: rgba(255,255,255,0.3);
        }
        .sidebar.collapsed .nav-arrow { opacity: 0; width: 0 !important; overflow: hidden; }
        .nav-item-group.open > .nav-item .nav-arrow { transform: rotate(90deg); }

        /* Submenu container */
        .nav-submenu {
            max-height: 0; overflow: hidden;
            transition: max-height 0.32s cubic-bezier(0.4,0,0.2,1);
            background: rgba(0,0,0,0.18);
        }
        .nav-item-group.open .nav-submenu { max-height: 600px; }
        .sidebar.collapsed .nav-submenu { display: none; }

        /* ══ SUBMENU ITEM — base ══ */
        .nav-subitem {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.55rem 1.1rem 0.55rem 2.75rem;
            color: rgba(255,255,255,0.35);
            text-decoration: none; font-size: 0.78rem; font-weight: 400;
            transition: background 0.18s, color 0.18s, border-left-color 0.18s;
            white-space: nowrap; border-left: 3px solid transparent;
            position: relative;
        }
        .nav-subitem svg { width: 14px; height: 14px; flex-shrink: 0; transition: color 0.18s; }

        /* connecting line */
        .nav-subitem::before {
            content: '';
            position: absolute; left: 1.55rem; top: 50%;
            width: 8px; height: 1px;
            background: rgba(201,168,76,0.2);
        }

        /* ══ SUBMENU HOVER ══ */
        .nav-subitem:hover {
            background: rgba(201,168,76,0.07);
            color: rgba(255,255,255,0.75);
            border-left-color: rgba(201,168,76,0.25);
        }
        .nav-subitem:hover::before { background: rgba(201,168,76,0.45); }

        /* ══ SUBMENU ACTIVE ══ */
        .nav-subitem.active {
            background: linear-gradient(90deg, rgba(201,168,76,0.15) 0%, rgba(201,168,76,0.05) 100%);
            color: var(--gold-light);
            font-weight: 500;
            border-left-color: var(--gold);
        }
        .nav-subitem.active svg { color: var(--gold); }
        .nav-subitem.active::before { background: var(--gold); }

        /* ══════════════════════════════════
           SIDEBAR FOOTER
        ══════════════════════════════════ */
        .sidebar-footer {
            padding: 0.75rem 0.85rem;
            border-top: 1px solid rgba(201,168,76,0.1);
            flex-shrink: 0;
        }
        .sidebar-user-row {
            display: flex; align-items: center; gap: 0.5rem;
        }
        .sidebar-user {
            display: flex; align-items: center; gap: 0.7rem;
            padding: 0.5rem 0.65rem; border-radius: 8px;
            transition: background 0.2s; cursor: pointer; text-decoration: none; flex: 1; min-width: 0;
        }
        .sidebar-user:hover { background: rgba(201,168,76,0.08); }
        .sidebar-user-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display); font-size: 0.72rem; font-weight: 700;
            color: var(--white); flex-shrink: 0; overflow: hidden;
            border: 1.5px solid rgba(201,168,76,0.35);
        }
        .sidebar-user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .sidebar-user-info { overflow: hidden; transition: opacity 0.2s, width 0.3s; min-width: 0; }
        .sidebar.collapsed .sidebar-user-info { opacity: 0; width: 0; }
        .sidebar-user-name {
            font-size: 0.8rem; font-weight: 500; color: rgba(255,255,255,0.82);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .sidebar-user-role { font-size: 0.62rem; color: var(--gold-light); white-space: nowrap; }

        /* Logout button */
        .sidebar-logout-form { flex-shrink: 0; }
        .sidebar-logout-btn {
            width: 32px; height: 32px; border-radius: 7px;
            border: 1px solid rgba(201,168,76,0.18);
            background: rgba(201,168,76,0.06);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: rgba(255,255,255,0.38);
            transition: background 0.2s, color 0.2s, border-color 0.2s;
        }
        .sidebar-logout-btn:hover {
            background: rgba(184,64,64,0.15); color: #F87171; border-color: rgba(184,64,64,0.3);
        }
        .sidebar-logout-btn svg { width: 14px; height: 14px; }

        /* ════════════════════════════════
           MAIN CONTENT
        ════════════════════════════════ */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            padding-top: var(--topbar-h);
            min-height: 100vh;
            transition: margin-left 0.3s cubic-bezier(0.4,0,0.2,1);
            background: var(--ivory);
        }
        .main-wrapper.sidebar-collapsed { margin-left: 72px; }
        .page-content { padding: 0; }

        /* ════════════════════════════════
           MOBILE
        ════════════════════════════════ */
        .sidebar-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(30,27,24,0.5); z-index: 105;
            backdrop-filter: blur(2px);
        }
        .sidebar-overlay.visible { display: block; }

        @media (max-width: 768px) {
            .topbar { padding-left: 1rem; }
            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-w) !important;
                transition: transform 0.35s cubic-bezier(0.4,0,0.2,1);
            }
            .sidebar.mobile-open { transform: translateX(0); }
            .main-wrapper { margin-left: 0 !important; }
            .topbar-search { display: none; }
            .user-name { display: none; }
            .user-role-chip { display: none; }
        }

        .mobile-menu-btn {
            display: none; width: 36px; height: 36px;
            border-radius: 8px; border: 1.5px solid var(--border-md);
            background: var(--white); align-items: center; justify-content: center;
            cursor: pointer; color: var(--warm-grey);
            flex-direction: column; gap: 4px; padding: 8px;
        }
        .mobile-menu-btn span {
            display: block; width: 100%; height: 2px;
            background: var(--charcoal); border-radius: 2px;
            transition: transform 0.3s, opacity 0.3s;
        }
        @media (max-width: 768px) {
            .mobile-menu-btn { display: flex; }
            .sidebar-toggle  { display: none; }
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #DDD4C8; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--gold); }
    </style>
</head>
<body>

    {{-- ══════════════════════════════════
         SIDEBAR
    ══════════════════════════════════ --}}
    @auth
       @include('layouts.admin-sidebar')
    @endauth

    {{-- Mobile overlay --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- ══════════════════════════════════
         TOP BAR
    ══════════════════════════════════ --}}
    <header class="topbar" id="topbar">

        <button class="mobile-menu-btn" id="mobileSidebarBtn" aria-label="Open sidebar">
            <span></span><span></span><span></span>
        </button>

        <div class="topbar-heading">
            @isset($header)
            @php
                $headerText = trim(strip_tags((string) $header));
                $segments   = array_values(array_filter(explode('/', request()->path())));
                $last       = ucfirst(str_replace(['-','_'], ' ', end($segments) ?: 'Dashboard'));
            @endphp
            <h1>{{ $headerText }}</h1>
            <div class="topbar-breadcrumb">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 2l4 4-4 4"/></svg>
                <span>Dashboard</span>
                @if(count($segments) > 1)
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 2l4 4-4 4"/></svg>
                    <span class="bc-active">{{ $headerText }}</span>
                @endif
            </div>
            @else
            <h1>Dashboard</h1>
            <div class="topbar-breadcrumb">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 2l4 4-4 4"/></svg>
                <span class="bc-active">Home</span>
            </div>
            @endisset
        </div>

        @auth
           @include('layouts.navigation')
        @endauth
    </header>

    {{-- ══════════════════════════════════
         MAIN
    ══════════════════════════════════ --}}
    <div class="main-wrapper" id="mainWrapper">
        <main class="page-content">
            {{ $slot }}
        </main>
    </div>

    <script>
        /* ── Sidebar collapse (desktop) ── */
        const sidebar       = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const topbar        = document.getElementById('topbar');
        const mainWrapper   = document.getElementById('mainWrapper');
        const overlay       = document.getElementById('sidebarOverlay');
        const mobileBtn     = document.getElementById('mobileSidebarBtn');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                const isCollapsed = sidebar.classList.toggle('collapsed');
                mainWrapper.classList.toggle('sidebar-collapsed', isCollapsed);
                topbar.classList.toggle('sidebar-collapsed', isCollapsed);
                localStorage.setItem('sidebarCollapsed', isCollapsed);
            });
        }

        /* Restore state */
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            sidebar?.classList.add('collapsed');
            mainWrapper.classList.add('sidebar-collapsed');
            topbar.classList.add('sidebar-collapsed');
        }

        /* ── Mobile ── */
        mobileBtn?.addEventListener('click', () => {
            sidebar?.classList.toggle('mobile-open');
            overlay.classList.toggle('visible');
            document.body.style.overflow = sidebar?.classList.contains('mobile-open') ? 'hidden' : '';
        });
        overlay.addEventListener('click', closeMobile);
        function closeMobile() {
            sidebar?.classList.remove('mobile-open');
            overlay.classList.remove('visible');
            document.body.style.overflow = '';
        }
        sidebar?.querySelectorAll('.nav-item:not([onclick])').forEach(item => {
            item.addEventListener('click', () => { if (window.innerWidth <= 768) closeMobile(); });
        });

        /* ── Settings submenu toggle ── */
        function toggleNavGroup(id) {
            const group = document.getElementById(id);
            if (!group) return;
            group.classList.toggle('open');
        }

        /* ── Notifications ── */
        function toggleNotif(e) {
            e.stopPropagation();
            document.getElementById('notifDropdown').classList.toggle('open');
        }
        document.addEventListener('click', () => {
            document.getElementById('notifDropdown')?.classList.remove('open');
        });

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