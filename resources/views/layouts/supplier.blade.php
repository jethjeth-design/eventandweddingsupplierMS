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
/* ════════════════════════════════════════════════════
   RESET & TOKENS
════════════════════════════════════════════════════ */
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

/* ════════════════════════════════════════════════════
   TOP BAR
════════════════════════════════════════════════════ */
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
    backdrop-filter: blur(18px);
    border-bottom: 1px solid rgba(201,168,76,0.18);
    transition: padding 0.3s cubic-bezier(0.4,0,0.2,1);
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
.topbar-heading h1 em, .topbar-heading h2 em { color: var(--gold-dark); font-style: italic; }

.topbar-breadcrumb {
    display: flex; align-items: center; gap: 0.4rem;
    font-size: 0.7rem; color: var(--warm-grey);
    letter-spacing: 0.02em; white-space: nowrap;
}
.topbar-breadcrumb .bc-active { color: var(--gold-dark); font-weight: 500; }
.topbar-breadcrumb svg { width: 9px; height: 9px; color: #C0B8B0; flex-shrink: 0; }

.topbar-right {
    display: flex; align-items: center;
    gap: 0.65rem; flex-shrink: 0;
}

/* Search */
.topbar-search {
    display: flex; align-items: center; gap: 0.5rem;
    background: var(--white); border: 1.5px solid var(--border-md);
    border-radius: 8px; padding: 0.42rem 0.9rem;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.topbar-search:focus-within { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,0.1); }
.topbar-search svg { width: 13px; height: 13px; color: #C0B8B0; flex-shrink: 0; }
.topbar-search input {
    border: none; outline: none; background: transparent;
    font-family: var(--font-body); font-size: 0.79rem;
    color: var(--charcoal); width: 175px;
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

/* ── Notification wrap ── */
.notif-wrap { position: relative; }
.notif-count {
    position: absolute; top: -5px; right: -5px;
    min-width: 17px; height: 17px;
    background: var(--gold); color: var(--charcoal);
    border: 2px solid var(--ivory); border-radius: 999px;
    font-size: 0.55rem; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    padding: 0 3px; line-height: 1; font-family: var(--font-body);
    pointer-events: none;
}

/* Notification dropdown */
.notif-dropdown {
    display: none;
    position: absolute; top: calc(100% + 10px); right: 0;
    width: 340px; max-width: 90vw;
    background: var(--white);
    border: 1px solid var(--border); border-top: 2px solid var(--gold);
    border-radius: 4px;
    box-shadow: 0 12px 40px rgba(30,27,24,0.14);
    z-index: 500; overflow: hidden;
}
.notif-dropdown.open { display: block; animation: notifIn 0.2s ease; }
@keyframes notifIn { from { opacity:0; transform:translateY(-6px); } to { opacity:1; transform:none; } }
.notif-header { display: flex; align-items: center; justify-content: space-between; padding: 0.85rem 1.1rem 0.75rem; border-bottom: 1px solid var(--border); background: var(--ivory); }
.notif-header-l { display: flex; align-items: center; gap: 0.55rem; }
.notif-header-title { font-family: var(--font-display); font-size: 0.92rem; font-weight: 700; color: var(--charcoal); }
.notif-header-title em { font-style: italic; color: var(--gold-dark); }
.notif-unread-pill { display: inline-flex; align-items: center; padding: 1px 8px; background: rgba(201,168,76,0.12); color: var(--gold-dark); border: 1px solid rgba(201,168,76,0.28); border-radius: 999px; font-size: 0.6rem; font-weight: 700; letter-spacing: 0.05em; }
.notif-mark-all { font-size: 0.68rem; color: var(--gold-dark); font-family: var(--font-body); font-weight: 500; background: none; border: none; cursor: pointer; padding: 0; transition: color 0.18s; }
.notif-mark-all:hover { color: var(--gold); text-decoration: underline; }
.notif-list { max-height: 320px; overflow-y: auto; }
.notif-list::-webkit-scrollbar { width: 3px; }
.notif-list::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }
.notif-item { display: flex; align-items: flex-start; gap: 0.7rem; padding: 0.85rem 1.1rem; border-bottom: 1px solid var(--border); text-decoration: none; color: var(--charcoal); transition: background 0.15s; position: relative; cursor: pointer; }
.notif-item:last-child { border-bottom: none; }
.notif-item:hover { background: rgba(201,168,76,0.04); }
.notif-item.unread { background: rgba(201,168,76,0.05); }
.notif-item.unread::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 3px; background: var(--gold); }
.notif-icon { width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; background: rgba(201,168,76,0.1); color: var(--gold-dark); border: 1px solid rgba(201,168,76,0.2); }
.notif-icon svg { width: 15px; height: 15px; }
.notif-icon.icon-booking  { background: rgba(22,163,74,0.08);  color: #16A34A; border-color: rgba(22,163,74,0.2); }
.notif-icon.icon-cancel   { background: rgba(185,28,28,0.08);  color: #B91C1C; border-color: rgba(185,28,28,0.2); }
.notif-icon.icon-message  { background: rgba(37,99,235,0.08);  color: #2563EB; border-color: rgba(37,99,235,0.2); }
.notif-icon.icon-system   { background: rgba(201,168,76,0.1);  color: var(--gold-dark); border-color: rgba(201,168,76,0.22); }
.notif-content { flex: 1; min-width: 0; }
.notif-title { font-size: 0.79rem; font-weight: 600; color: var(--charcoal); line-height: 1.3; margin-bottom: 0.2rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.notif-msg { font-size: 0.72rem; color: var(--warm-grey); line-height: 1.45; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.notif-time { font-size: 0.62rem; color: #C0B8B0; margin-top: 0.28rem; display: flex; align-items: center; gap: 0.3rem; }
.notif-time svg { width: 9px; height: 9px; }
.notif-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--gold); flex-shrink: 0; margin-top: 5px; }
.notif-empty { text-align: center; padding: 2.5rem 1.5rem; }
.notif-empty-icon { width: 46px; height: 46px; border-radius: 50%; background: rgba(201,168,76,0.08); display: flex; align-items: center; justify-content: center; margin: 0 auto 0.75rem; color: var(--gold-dark); }
.notif-empty-icon svg { width: 22px; height: 22px; }
.notif-empty-text { font-size: 0.8rem; color: var(--warm-grey); }
.notif-empty-sub  { font-size: 0.7rem; color: #C0B8B0; margin-top: 0.2rem; }
.notif-footer { padding: 0.65rem 1.1rem; border-top: 1px solid var(--border); background: var(--ivory); display: flex; align-items: center; justify-content: center; }
.notif-see-all { display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.72rem; font-weight: 600; color: var(--gold-dark); text-decoration: none; font-family: var(--font-body); transition: color 0.18s; }
.notif-see-all:hover { color: var(--gold); }
.notif-see-all svg { width: 11px; height: 11px; }

/* User pill */
.user-pill {
    display: flex; align-items: center; gap: 0.55rem;
    padding: 0.3rem 0.7rem 0.3rem 0.3rem;
    background: var(--white); border: 1.5px solid var(--border-md);
    border-radius: 999px; cursor: pointer;
    transition: border-color 0.2s, box-shadow 0.2s; position: relative;
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
.user-role-chip { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: var(--gold-dark); background: rgba(201,168,76,0.1); border: 1px solid rgba(201,168,76,0.25); padding: 1px 7px; border-radius: 999px; white-space: nowrap; }
.user-pill > svg { width: 11px; height: 11px; color: #C0B8B0; }

/* Dropdown */
.user-dropdown {
    display: none; position: absolute; top: calc(100% + 8px); right: 0;
    min-width: 210px; background: var(--white);
    border: 1px solid var(--border-md);
    border-top: 2px solid var(--gold);
    border-radius: 4px; box-shadow: 0 8px 32px rgba(30,27,24,0.12);
    padding: 0.5rem; z-index: 200;
}
.user-pill:hover .user-dropdown,
.user-pill:focus-within .user-dropdown { display: block; }
.dropdown-user-header { display: flex; align-items: center; gap: 0.65rem; padding: 0.6rem 0.75rem 0.75rem; border-bottom: 1px solid var(--border); margin-bottom: 0.4rem; }
.dropdown-user-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, var(--gold), var(--gold-dark)); display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: 0.85rem; font-weight: 700; color: var(--white); flex-shrink: 0; overflow: hidden; }
.dropdown-user-avatar img { width: 100%; height: 100%; object-fit: cover; }
.dropdown-user-name { font-size: 0.84rem; font-weight: 600; color: var(--charcoal); }
.dropdown-user-email { font-size: 0.68rem; color: var(--warm-grey); margin-top: 1px; }
.dropdown-item { display: flex; align-items: center; gap: 0.6rem; padding: 0.58rem 0.75rem; border-radius: 3px; font-size: 0.81rem; color: var(--charcoal); text-decoration: none; transition: background 0.15s, color 0.15s; cursor: pointer; border: none; background: none; width: 100%; text-align: left; font-family: var(--font-body); }
.dropdown-item svg { width: 14px; height: 14px; color: var(--warm-grey); flex-shrink: 0; }
.dropdown-item:hover { background: var(--ivory); color: var(--gold-dark); }
.dropdown-item:hover svg { color: var(--gold-dark); }
.dropdown-divider { height: 1px; background: var(--border); margin: 0.35rem 0; }
.dropdown-item.danger { color: #B91C1C; }
.dropdown-item.danger svg { color: #B91C1C; }
.dropdown-item.danger:hover { background: #FEF2F2; }

/* ════════════════════════════════════════════════════
   SIDEBAR
════════════════════════════════════════════════════ */
.sidebar {
    position: fixed; top: 0; left: 0; bottom: 0;
    width: var(--sidebar-w);
    background: var(--charcoal);
    display: flex; flex-direction: column;
    z-index: 110;
    transition: width 0.3s cubic-bezier(0.4,0,0.2,1);
    overflow: hidden;
}
.sidebar.collapsed { width: 72px; }

/* Header */
.sidebar-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 1.1rem; height: var(--topbar-h);
    border-bottom: 1px solid rgba(201,168,76,0.12);
    flex-shrink: 0; position: relative;
}
.sidebar-header::after {
    content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 1px;
    background: linear-gradient(90deg, transparent, rgba(201,168,76,0.3), transparent);
}
.sidebar-logo { font-family: var(--font-display); font-size: 1.2rem; font-weight: 700; color: var(--white); white-space: nowrap; overflow: hidden; opacity: 1; transition: opacity 0.2s; text-decoration: none; line-height: 1.2; }
.sidebar-logo em { color: var(--gold-light); font-style: italic; }
.sidebar.collapsed .sidebar-logo { opacity: 0; pointer-events: none; }
.sidebar-toggle { width: 28px; height: 28px; border-radius: 6px; border: 1px solid rgba(201,168,76,0.2); background: rgba(201,168,76,0.08); display: flex; align-items: center; justify-content: center; cursor: pointer; color: rgba(255,255,255,0.5); transition: background 0.2s, color 0.2s; flex-shrink: 0; }
.sidebar-toggle:hover { background: rgba(201,168,76,0.18); color: var(--gold-light); }
.sidebar-toggle svg { width: 14px; height: 14px; transition: transform 0.3s; }
.sidebar.collapsed .sidebar-toggle svg { transform: rotate(180deg); }

/* Nav */
.sidebar-nav { flex: 1; overflow-y: auto; overflow-x: hidden; padding: 0.75rem 0; scrollbar-width: none; }
.sidebar-nav::-webkit-scrollbar { display: none; }

.nav-group-label { font-size: 0.58rem; letter-spacing: 0.14em; text-transform: uppercase; color: rgba(255,255,255,0.22); padding: 0.7rem 1.2rem 0.3rem; white-space: nowrap; overflow: hidden; transition: opacity 0.2s; }
.sidebar.collapsed .nav-group-label { opacity: 0; }

/* ── NAV ITEM ── */
.nav-item {
    display: flex; align-items: center; gap: 0.85rem;
    padding: 0.7rem 1.2rem;
    color: rgba(255,255,255,0.5);
    text-decoration: none; font-size: 0.84rem; font-weight: 400;
    transition: background 0.18s, color 0.18s, padding 0.3s;
    position: relative; white-space: nowrap;
    cursor: pointer; border: none; background: none;
    width: 100%; text-align: left; font-family: var(--font-body);
    border-left: 3px solid transparent;
}
.sidebar.collapsed .nav-item { padding: 0.7rem; justify-content: center; border-left: none; }
.nav-item svg { width: 17px; height: 17px; flex-shrink: 0; transition: color 0.18s; }
.nav-item span.nav-label { transition: opacity 0.2s, width 0.3s; overflow: hidden; flex: 1; }
.sidebar.collapsed .nav-item span.nav-label { opacity: 0; width: 0; }

/* Hover */
.nav-item:hover {
    background: rgba(201,168,76,0.08);
    color: rgba(255,255,255,0.85);
    border-left-color: rgba(201,168,76,0.25);
}
.sidebar.collapsed .nav-item:hover { border-left-color: transparent; }

/* ✅ ACTIVE — gold left bar + gold text + subtle gold bg */
.nav-item.active {
    background: rgba(201,168,76,0.13);
    color: var(--gold-light);
    font-weight: 600;
    border-left-color: var(--gold);
}
.sidebar.collapsed .nav-item.active {
    border-left-color: transparent;
    background: rgba(201,168,76,0.18);
}
.nav-item.active svg { color: var(--gold-light); }

/* Tooltip (collapsed only) */
.nav-tooltip {
    display: none; position: absolute; left: calc(100% + 8px); top: 50%;
    transform: translateY(-50%);
    background: #2A2620; border: 1px solid rgba(201,168,76,0.2);
    color: var(--white); font-size: 0.74rem;
    padding: 0.28rem 0.65rem; border-radius: 6px;
    white-space: nowrap; pointer-events: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25); z-index: 300;
    font-family: var(--font-body);
}
.sidebar.collapsed .nav-item:hover .nav-tooltip { display: block; }

/* Badge */
.nav-badge {
    margin-left: auto; background: var(--gold); color: var(--charcoal);
    font-size: 0.58rem; font-weight: 700;
    padding: 0.1rem 0.42rem; border-radius: 999px;
    flex-shrink: 0; transition: opacity 0.2s; line-height: 1.5;
}
.sidebar.collapsed .nav-badge { display: none; }

/* Divider */
.sidebar-divider { height: 1px; background: rgba(201,168,76,0.1); margin: 0.45rem 1.2rem; }
.sidebar.collapsed .sidebar-divider { margin: 0.45rem 0.8rem; }

/* ════════════════════════════════════════════════════
   SETTINGS DRAWER (sub-menu)
════════════════════════════════════════════════════ */
.nav-item--has-dropdown {
    user-select: none;
}
.settings-chevron {
    width: 13px !important; height: 13px !important;
    margin-left: auto; flex-shrink: 0;
    transition: transform 0.28s ease;
    color: rgba(255,255,255,0.3);
}
.nav-item--has-dropdown.drawer-open .settings-chevron { transform: rotate(90deg); }
.sidebar.collapsed .settings-chevron { display: none; }

.settings-drawer {
    overflow: hidden;
    max-height: 0;
    transition: max-height 0.32s cubic-bezier(0.4,0,0.2,1);
    background: rgba(0,0,0,0.15);
}
.settings-drawer.open { max-height: 400px; }
.sidebar.collapsed .settings-drawer { display: none; }

.settings-drawer-item {
    display: flex; align-items: center; gap: 0.7rem;
    padding: 0.6rem 1.2rem 0.6rem 2.85rem;
    color: rgba(255,255,255,0.4);
    text-decoration: none; font-size: 0.8rem;
    transition: background 0.15s, color 0.15s;
    position: relative; font-family: var(--font-body);
    border-left: 3px solid transparent;
}
.settings-drawer-item svg { width: 14px; height: 14px; flex-shrink: 0; }
.settings-drawer-item:hover { background: rgba(201,168,76,0.07); color: rgba(255,255,255,0.75); }

/* ✅ ACTIVE sub-item */
.settings-drawer-item.active {
    color: var(--gold-light);
    background: rgba(201,168,76,0.1);
    font-weight: 600;
    border-left-color: var(--gold);
}
.settings-drawer-item.active svg { color: var(--gold-light); }

/* ════════════════════════════════════════════════════
   SIDEBAR FOOTER
════════════════════════════════════════════════════ */
.sidebar-footer { padding: 0.85rem; border-top: 1px solid rgba(201,168,76,0.12); flex-shrink: 0; }

.sidebar-user-row {
    display: flex; align-items: center; gap: 0.5rem;
}
.sidebar-user {
    display: flex; align-items: center; gap: 0.65rem;
    padding: 0.55rem 0.65rem; border-radius: 8px;
    transition: background 0.2s; cursor: pointer; text-decoration: none;
    flex: 1; min-width: 0;
}
.sidebar-user:hover { background: rgba(201,168,76,0.08); }
.sidebar-user-avatar {
    width: 32px; height: 32px; border-radius: 50%;
    background: linear-gradient(135deg, var(--gold), var(--gold-dark));
    display: flex; align-items: center; justify-content: center;
    font-family: var(--font-display); font-size: 0.72rem; font-weight: 700;
    color: var(--white); flex-shrink: 0; overflow: hidden;
}
.sidebar-user-avatar img { width: 100%; height: 100%; object-fit: cover; }
.sidebar-user-info { overflow: hidden; transition: opacity 0.2s, width 0.3s; }
.sidebar.collapsed .sidebar-user-info { opacity: 0; width: 0; }
.sidebar-user-name { font-size: 0.81rem; font-weight: 500; color: rgba(255,255,255,0.85); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.sidebar-user-role { font-size: 0.64rem; color: var(--gold-light); white-space: nowrap; }

.sidebar-logout-form { flex-shrink: 0; }
.sidebar-logout-btn {
    width: 34px; height: 34px; border-radius: 7px;
    border: 1px solid rgba(201,168,76,0.18);
    background: rgba(201,168,76,0.06);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: rgba(255,255,255,0.4);
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}
.sidebar-logout-btn:hover { background: rgba(185,28,28,0.15); color: #FCA5A5; border-color: rgba(185,28,28,0.3); }
.sidebar-logout-btn svg { width: 15px; height: 15px; }

/* ════════════════════════════════════════════════════
   MAIN CONTENT
════════════════════════════════════════════════════ */
.main-wrapper {
    margin-left: var(--sidebar-w);
    padding-top: var(--topbar-h);
    min-height: 100vh;
    transition: margin-left 0.3s cubic-bezier(0.4,0,0.2,1);
    background: var(--ivory);
}
.main-wrapper.sidebar-collapsed { margin-left: 72px; }
.page-content { padding: 0; }

/* ════════════════════════════════════════════════════
   MOBILE
════════════════════════════════════════════════════ */
.sidebar-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(30,27,24,0.5); z-index: 105;
    backdrop-filter: blur(2px);
}
.sidebar-overlay.visible { display: block; animation: fadeIn 0.2s ease; }
@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

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
    .user-name, .user-role-chip { display: none; }
}

.mobile-menu-btn {
    display: none; width: 36px; height: 36px;
    border-radius: 8px; border: 1.5px solid var(--border-md);
    background: var(--white);
    align-items: center; justify-content: center;
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

{{-- ════════════════════════════════════════════════════
     SIDEBAR
════════════════════════════════════════════════════ --}}
@auth
@php
    /* ── Compute active states once ── */
    $r = request();

    $navActive = [
        'dashboard'     => $r->routeIs('supplier.dashboard') || $r->is('supplier/dashboard'),
        'listings'      => $r->routeIs('supplier.package.mylistings') || $r->is('supplier/listings*'),
        'inquiries'     => $r->routeIs('supplier.inquiries.*') || $r->is('supplier/inbox*'),
        'bookings'      => $r->routeIs('supplier.bookings*') || $r->is('supplier/bookings*'),
        'packages'      => $r->routeIs('supplier.package*') || $r->is('supplier/package*'),
        'collaborations'=> $r->routeIs('collaborations.*') || $r->is('supplier/collaborations*'),
        'availability'  => $r->routeIs('supplier.availability*') || $r->is('supplier/availability*'),
        'team'          => $r->routeIs('supplier.team-members*') || $r->is('supplier/team-members*'),
        'gallery'       => $r->routeIs('supplier.portfolio*') || $r->is('supplier/gallery*'),
        'reviews'       => $r->routeIs('supplier.ratings*') || $r->is('supplier/reviews*'),
        'earnings'      => $r->is('supplier/earnings*'),
        'payouts'       => $r->is('supplier/payouts*'),
        'profile'       => $r->routeIs('supplier.supplierprofile') || $r->is('supplier/profile*'),
        'settings'      => $r->is('supplier/settings*') || $r->routeIs('roles.*'),
        'roles'         => $r->routeIs('roles.*'),
        'account'       => $r->is('supplier/settings/account'),
    ];

    /* Settings parent is active if any child is */
    $settingsParentActive = $navActive['settings'];
    $settingsDrawerOpen   = $settingsParentActive;

    /* Supplier profile for footer */
    $supplierProfile = App\Models\SupplierProfile::where('user_id', Auth::id())->first();
    $displayName     = $supplierProfile
        ? trim(($supplierProfile->first_name ?? '') . ' ' . ($supplierProfile->last_name ?? ''))
        : (Auth::user()->name ?? 'Supplier');
    $initials = strtoupper(
        substr($displayName, 0, 1) .
        (strpos($displayName, ' ') !== false
            ? substr($displayName, strpos($displayName, ' ') + 1, 1)
            : '')
    );
@endphp
    @include('layouts.supplier-sidebar')
@endauth

{{-- Mobile overlay --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- ════════════════════════════════════════════════════
     TOP BAR
════════════════════════════════════════════════════ --}}
<header class="topbar" id="topbar">

    <button class="mobile-menu-btn" id="mobileSidebarBtn" aria-label="Open sidebar">
        <span></span><span></span><span></span>
    </button>

    <div class="topbar-heading">
        @isset($header)
            @php
                $headerHtml = (string) $header;
                $headerText = trim(strip_tags($headerHtml));
                $segments   = array_filter(explode('/', request()->path()));
            @endphp
            <h1>{{ $headerText }}</h1>
            <div class="topbar-breadcrumb">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 6h8M6 2l4 4-4 4"/></svg>
                <span>Dashboard</span>
                @if(count($segments) > 1)
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 2l4 4-4 4"/></svg>
                    <span class="bc-active">{{ $headerText }}</span>
                @endif
            </div>
        @else
            <h1>Dashboard</h1>
            <div class="topbar-breadcrumb">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 6h8M6 2l4 4-4 4"/></svg>
                <span class="bc-active">Home</span>
            </div>
        @endisset
    </div>

    @auth
        @include('layouts.navigation')
    @endauth
</header>

{{-- ════════════════════════════════════════════════════
     MAIN
════════════════════════════════════════════════════ --}}
<div class="main-wrapper" id="mainWrapper">
    <main class="page-content">
        {{ $slot }}
    </main>
</div>

<script>
/* ── Sidebar collapse ── */
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

sidebar?.querySelectorAll('a.nav-item, a.settings-drawer-item').forEach(item => {
    item.addEventListener('click', () => {
        if (window.innerWidth <= 768) closeMobile();
    });
});

/* ── Settings drawer toggle ── */
function toggleSettings() {
    const toggle  = document.getElementById('settingsToggle');
    const drawer  = document.getElementById('settingsDrawer');
    const isOpen  = drawer.classList.toggle('open');
    toggle.classList.toggle('drawer-open', isOpen);
}

/* ── Notification dropdown ── */
function toggleNotif(e) {
    e.stopPropagation();
    document.getElementById('notifDropdown').classList.toggle('open');
}
document.addEventListener('click', function(e) {
    const dd  = document.getElementById('notifDropdown');
    const btn = document.getElementById('notifBtn');
    if (dd && !dd.contains(e.target) && btn && !btn.contains(e.target)) {
        dd.classList.remove('open');
    }
});
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') document.getElementById('notifDropdown')?.classList.remove('open');
});

/* ── Mark notification read ── */
function markAsRead(e, id) {
    e.preventDefault();
    const url = e.currentTarget.href;
    e.currentTarget.classList.remove('unread');
    e.currentTarget.querySelector('.notif-dot')?.remove();
    fetch('/notifications/' + id + '/read', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    }).finally(() => { window.location.href = url; });
}
function markAllRead(e) {
    e.stopPropagation();
    document.querySelectorAll('.notif-item.unread').forEach(el => {
        el.classList.remove('unread');
        el.querySelector('.notif-dot')?.remove();
    });
    document.querySelector('.notif-unread-pill')?.remove();
    document.querySelector('.notif-count')?.remove();
    fetch('/notifications/read-all', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    }).then(() => { document.querySelector('.notif-mark-all')?.remove(); });
}
</script>
</body>
</html>