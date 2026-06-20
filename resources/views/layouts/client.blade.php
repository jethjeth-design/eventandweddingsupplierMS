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
            --gold:         #C9A84C;
            --gold-light:   #E8C97A;
            --gold-dark:    #8A6A1F;
            --gold-pale:    #F5EDD8;
            --ivory:        #FAF7F2;
            --charcoal:     #1E1B18;
            --warm-grey:    #6B6560;
            --topbar-h:     64px;
            --white:        #FFFFFF;
            --border:       #F0EBE5;
            --border-md:    #E0D8D0;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body:    'DM Sans', sans-serif;
            --ease-out:     cubic-bezier(0.16, 1, 0.3, 1);
        }

        html, body { height: 100%; font-family: var(--font-body); background: var(--ivory); color: var(--charcoal); overflow-x: hidden; }

        /* ════════════════════════════════
           TOP BAR
        ════════════════════════════════ */
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

        .topbar-left { display: flex; align-items: center; gap: 0; flex-shrink: 0; }

        .topbar-logo { font-family: var(--font-display); font-size: 1.25rem; font-weight: 700; color: var(--charcoal); text-decoration: none; white-space: nowrap; flex-shrink: 0; }
        .topbar-logo em { color: var(--gold-dark); font-style: italic; }
        .topbar-logo-divider { width: 1px; height: 22px; background: var(--border-md); margin: 0 1.1rem; flex-shrink: 0; }

        /* Desktop nav */
        .topbar-nav { display: flex; align-items: center; gap: 0.15rem; }
        .topbar-nav-item { display: inline-flex; align-items: center; gap: 0.38rem; padding: 0.42rem 0.85rem; border-radius: 7px; font-family: var(--font-body); font-size: 0.8rem; font-weight: 400; color: var(--warm-grey); text-decoration: none; border-bottom: 2px solid transparent; transition: color 0.18s, background 0.18s, border-color 0.18s; position: relative; white-space: nowrap; }
        .topbar-nav-item svg { width: 14px; height: 14px; flex-shrink: 0; opacity: 0.65; transition: opacity 0.18s; }
        .topbar-nav-item:hover { color: var(--gold-dark); background: rgba(201,168,76,0.07); }
        .topbar-nav-item:hover svg { opacity: 1; }
        .topbar-nav-item.active { color: var(--gold-dark); background: rgba(201,168,76,0.1); font-weight: 500; border-bottom-color: var(--gold); }
        .topbar-nav-item.active svg { opacity: 1; color: var(--gold-dark); }
        .topbar-nav-badge { display: inline-flex; align-items: center; justify-content: center; min-width: 16px; height: 16px; border-radius: 999px; background: var(--gold); color: var(--charcoal); font-size: 0.54rem; font-weight: 700; padding: 0 4px; line-height: 1; }
        .topbar-nav-item.active .topbar-nav-badge { background: var(--gold-dark); color: var(--white); }

        /* Right controls */
        .topbar-right { display: flex; align-items: center; gap: 0.6rem; flex-shrink: 0; }

        /* Search */
        .topbar-search { display: flex; align-items: center; gap: 0.45rem; background: var(--white); border: 1.5px solid var(--border-md); border-radius: 8px; padding: 0.4rem 0.85rem; transition: border-color 0.2s, box-shadow 0.2s; }
        .topbar-search:focus-within { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,0.1); }
        .topbar-search svg { width: 13px; height: 13px; color: #C0B8B0; flex-shrink: 0; }
        .topbar-search input { border: none; outline: none; background: transparent; font-family: var(--font-body); font-size: 0.78rem; color: var(--charcoal); width: 160px; }
        .topbar-search input::placeholder { color: #C0B8B0; }

        /* Icon button */
        .icon-btn { width: 36px; height: 36px; border-radius: 8px; border: 1.5px solid var(--border-md); background: var(--white); display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--warm-grey); transition: border-color 0.2s, color 0.2s, background 0.2s; position: relative; text-decoration: none; flex-shrink: 0; }
        .icon-btn:hover { border-color: var(--gold); color: var(--gold-dark); background: rgba(201,168,76,0.06); }
        .icon-btn svg { width: 16px; height: 16px; }

        /* ════════════════════════════════
           MESSAGE TRIGGER BUTTON
        ════════════════════════════════ */
        .msg-wrap { position: relative; }

        .msg-trigger {
            position: relative; display: inline-flex; align-items: center; justify-content: center;
            width: 36px; height: 36px; border-radius: 9px;
            border: 1.5px solid #E8E0D4; background: #FFFFFF; color: #8C867E;
            cursor: pointer; transition: all .18s; flex-shrink: 0;
        }
        .msg-trigger svg { width: 16px; height: 16px; }
        .msg-trigger:hover, .msg-trigger.is-active { border-color: #B8924A; color: #B8924A; background: rgba(184,146,74,0.10); }

        .msg-badge {
            position: absolute; top: -4px; right: -4px;
            min-width: 17px; height: 17px; border-radius: 999px;
            background: #B8924A; color: #14110E;
            font-size: 0.52rem; font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            border: 2px solid #F8F4EE; padding: 0 3px; pointer-events: none;
        }

        /* ════════════════════════════════
           DESKTOP MESSAGE DROPDOWN (≥769px)
        ════════════════════════════════ */
        .msg-dropdown {
            display: none; position: absolute; top: calc(100% + 10px); right: 0;
            width: 345px; background: #FFFFFF; border: 1.5px solid #E8E0D4;
            border-radius: 16px; box-shadow: 0 20px 60px rgba(20,17,14,.20);
            z-index: 400; overflow: hidden;
        }
        .msg-dropdown.open { display: block; animation: msgPop .2s cubic-bezier(0.34,1.56,0.64,1); }
        @keyframes msgPop { from { opacity:0; transform:translateY(8px) scale(0.97); } to { opacity:1; transform:none; } }

        /* ════════════════════════════════
           SHARED PANEL INNER PARTS
           (desktop dropdown + mobile drawer)
        ════════════════════════════════ */
        .msg-drop-head { display: flex; align-items: center; justify-content: space-between; padding: 0.9rem 1.15rem 0.75rem; border-bottom: 1px solid #E8E0D4; flex-shrink: 0; }
        .msg-drop-title { font-family: var(--font-display); font-size: 1.02rem; font-weight: 700; color: #14110E; line-height: 1; letter-spacing: 0.01em; }
        .msg-drop-title em { font-style: italic; color: #B8924A; }

        /* Close btn — only shows inside mobile drawer */
        .msg-drawer-close {
            display: none; width: 30px; height: 30px; border-radius: 50%;
            border: 1px solid #E8E0D4; background: var(--ivory);
            align-items: center; justify-content: center;
            cursor: pointer; color: var(--warm-grey); flex-shrink: 0;
            transition: background .15s;
        }
        .msg-drawer-close:hover { background: #F0EBE5; }
        .msg-drawer-close svg { width: 14px; height: 14px; }

        .msg-drop-tabs { display: flex; gap: 4px; }
        .msg-drop-tab { padding: 3px 10px; border-radius: 999px; border: 1px solid #E8E0D4; background: transparent; font-family: var(--font-body); font-size: 0.62rem; font-weight: 600; color: #8C867E; cursor: pointer; transition: all .14s; }
        .msg-drop-tab:hover { border-color: #B8924A; color: #B8924A; }
        .msg-drop-tab.active { background: #14110E; border-color: #14110E; color: #D4B06A; }
        .tab-unread-dot { display: inline-block; width: 5px; height: 5px; border-radius: 50%; background: #B8924A; margin-left: 3px; vertical-align: middle; position: relative; top: -1px; }

        .msg-list { overflow-y: auto; flex: 1; scrollbar-width: thin; scrollbar-color: #E8E0D4 transparent; }
        .msg-dropdown .msg-list { max-height: 310px; }
        .msg-list::-webkit-scrollbar { width: 3px; }
        .msg-list::-webkit-scrollbar-thumb { background: #E8E0D4; border-radius: 99px; }

        .msg-item { display: flex; align-items: center; gap: 0.72rem; padding: 0.72rem 1.15rem; text-decoration: none; border-bottom: 1px solid #F0EBE2; transition: background .14s; cursor: pointer; position: relative; }
        .msg-item:last-child { border-bottom: none; }
        .msg-item:hover { background: #F8F4EE; }
        .msg-item.has-unread { background: rgba(184,146,74,0.04); }
        .msg-item.has-unread:hover { background: rgba(184,146,74,0.09); }
        .msg-item.has-unread::before { content: ''; position: absolute; left: 0; top: 20%; bottom: 20%; width: 3px; border-radius: 0 3px 3px 0; background: #B8924A; }

        .msg-ava { width: 38px; height: 38px; border-radius: 50%; flex-shrink: 0; background: linear-gradient(135deg, #B8924A, #7A5C25); display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: 0.84rem; font-weight: 700; color: #FFFFFF; border: 2px solid rgba(184,146,74,0.22); position: relative; }
        .msg-ava.is-group { background: linear-gradient(135deg,#5C4B8A,#3D3060); border-color: rgba(92,75,138,0.25); }
        .msg-ava.is-admin { background: linear-gradient(135deg,#14110E,#3D3530); border-color: rgba(184,146,74,0.3); }
        .msg-ava .ava-online { position: absolute; bottom: 0; right: 0; width: 9px; height: 9px; border-radius: 50%; background: #4CAF7D; border: 2px solid #FFFFFF; }

        .msg-body { flex: 1; min-width: 0; }
        .msg-row-top { display: flex; align-items: center; justify-content: space-between; gap: 4px; margin-bottom: 2px; }
        .msg-name { font-size: 0.8rem; font-weight: 500; color: #14110E; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; flex: 1; }
        .msg-name.bold { font-weight: 700; }
        .msg-time { font-size: 0.6rem; color: #B0AAA2; flex-shrink: 0; }
        .msg-preview { font-size: 0.68rem; color: #8C867E; line-height: 1.4; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .msg-preview.bold { color: #14110E; font-weight: 500; }
        .msg-row-bottom { display: flex; align-items: center; justify-content: space-between; margin-top: 2px; }
        .msg-participants { font-size: 0.62rem; color: #B0AAA2; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; flex: 1; }
        .msg-unread-pill { min-width: 18px; height: 18px; border-radius: 999px; background: #B8924A; color: #14110E; font-size: 0.53rem; font-weight: 700; display: flex; align-items: center; justify-content: center; padding: 0 4px; flex-shrink: 0; }
        .msg-type-badge { font-size: 0.5rem; font-weight: 700; letter-spacing: 0.07em; text-transform: uppercase; padding: 1px 6px; border-radius: 999px; flex-shrink: 0; }
        .msg-type-badge.group { background: rgba(92,75,138,0.1); color: #5C4B8A; border: 1px solid rgba(92,75,138,0.2); }
        .msg-type-badge.admin { background: rgba(20,17,14,0.08); color: #14110E; }

        .msg-empty { padding: 2.5rem 1rem; text-align: center; }
        .msg-empty-icon { width: 48px; height: 48px; border-radius: 50%; background: rgba(184,146,74,0.10); border: 1px solid rgba(184,146,74,0.22); display: flex; align-items: center; justify-content: center; margin: 0 auto 0.6rem; color: #B8924A; }
        .msg-empty-icon svg { width: 22px; height: 22px; }
        .msg-empty-title { font-family: var(--font-display); font-size: 0.92rem; font-weight: 700; color: #14110E; }
        .msg-empty-title em { font-style: italic; color: #B8924A; }
        .msg-empty-sub { font-size: 0.7rem; color: #8C867E; margin-top: 3px; }

        .msg-drop-foot { padding: 0.68rem 1.15rem; border-top: 1px solid #E8E0D4; background: #F8F4EE; display: flex; align-items: center; justify-content: space-between; flex-shrink: 0; }
        .msg-see-all { display: flex; align-items: center; gap: 0.35rem; font-family: var(--font-body); font-size: 0.73rem; font-weight: 500; color: #B8924A; text-decoration: none; transition: color .15s; }
        .msg-see-all:hover { color: #14110E; }
        .msg-see-all svg { width: 11px; height: 11px; }
        .msg-compose-btn { display: inline-flex; align-items: center; gap: 4px; padding: 5px 11px; border-radius: 8px; background: #14110E; color: #D4B06A; border: none; font-family: var(--font-body); font-size: 0.67rem; font-weight: 500; cursor: pointer; text-decoration: none; transition: all .15s; }
        .msg-compose-btn:hover { background: #B8924A; color: #FFFFFF; }
        .msg-compose-btn svg { width: 11px; height: 11px; }

        /* ════════════════════════════════
           MOBILE MESSAGE DRAWER
        ════════════════════════════════ */
        .msg-mobile-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(20,17,14,0.55); z-index: 590;
            backdrop-filter: blur(3px); -webkit-backdrop-filter: blur(3px);
        }
        .msg-mobile-overlay.open { display: block; animation: fadeOvl .22s ease; }
        @keyframes fadeOvl { from { opacity:0; } to { opacity:1; } }

        .msg-mobile-drawer {
            display: none; position: fixed;
            bottom: 0; left: 0; right: 0; max-height: 88vh;
            background: var(--white); border-radius: 20px 20px 0 0;
            z-index: 595; overflow: hidden; flex-direction: column;
            box-shadow: 0 -8px 40px rgba(20,17,14,0.18);
        }
        .msg-mobile-drawer.open { display: flex; animation: drawerUp .3s cubic-bezier(0.34,1.2,0.64,1); }
        @keyframes drawerUp { from { transform:translateY(100%); opacity:.7; } to { transform:translateY(0); opacity:1; } }

        .msg-drawer-handle { display: flex; justify-content: center; padding: 10px 0 2px; flex-shrink: 0; cursor: grab; }
        .msg-drawer-handle span { width: 42px; height: 4px; background: #E0D8D0; border-radius: 99px; }

        /* Inside drawer: show close btn + larger tap targets */
        .msg-mobile-drawer .msg-drawer-close { display: flex; }
        .msg-mobile-drawer .msg-item { padding: 0.9rem 1.15rem; }
        .msg-mobile-drawer .msg-ava { width: 42px; height: 42px; }
        .msg-mobile-drawer .msg-name { font-size: 0.86rem; }
        .msg-mobile-drawer .msg-preview { font-size: 0.74rem; }

        /* ════════════════════════════════
           NOTIFICATION
        ════════════════════════════════ */
        .notif-wrap { position: relative; }

        .notif-count { position: absolute; top: -4px; right: -4px; min-width: 16px; height: 16px; border-radius: 999px; background: var(--gold); color: var(--charcoal); font-size: 0.54rem; font-weight: 700; display: flex; align-items: center; justify-content: center; border: 2px solid var(--ivory); padding: 0 3px; pointer-events: none; }

        .notif-dropdown {
            display: none; position: fixed;
            top: calc(var(--topbar-h) + 8px); right: 1rem;
            width: min(340px, calc(100vw - 2rem));
            background: var(--white); border: 1px solid var(--border-md);
            border-top: 2px solid var(--gold); border-radius: 4px;
            box-shadow: 0 12px 40px rgba(30,27,24,0.13); z-index: 500; overflow: hidden;
            max-height: calc(100dvh - var(--topbar-h) - 2rem);
        }
        .notif-dropdown.open { display: flex; flex-direction: column; animation: dropFadeIn 0.2s var(--ease-out); }
        @keyframes dropFadeIn { from { opacity:0; transform:translateY(6px); } to { opacity:1; transform:none; } }

        .notif-header { display: flex; align-items: center; justify-content: space-between; padding: 0.9rem 1.1rem 0.75rem; border-bottom: 1px solid var(--border); flex-shrink: 0; }
        .notif-header-l { display: flex; align-items: center; gap: 0.5rem; }
        .notif-header-title { font-family: var(--font-display); font-size: 0.95rem; font-weight: 700; color: var(--charcoal); }
        .notif-header-title em { font-style: italic; color: var(--gold-dark); }
        .notif-unread-pill { font-size: 0.56rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; background: rgba(201,168,76,0.12); color: var(--gold-dark); border: 1px solid rgba(201,168,76,0.25); padding: 2px 8px; border-radius: 999px; }
        .notif-mark-all { font-size: 0.68rem; font-weight: 500; color: var(--warm-grey); background: none; border: none; cursor: pointer; font-family: var(--font-body); transition: color 0.2s; }
        .notif-mark-all:hover { color: var(--gold-dark); }
        .notif-list { overflow-y: auto; flex: 1; }
        .notif-item { display: flex; align-items: flex-start; gap: 0.75rem; padding: 0.85rem 1.1rem; text-decoration: none; border-bottom: 1px solid var(--border); transition: background 0.15s; }
        .notif-item:last-child { border-bottom: none; }
        .notif-item:hover { background: #FDFAF6; }
        .notif-item.unread { background: rgba(201,168,76,0.04); }
        .notif-item.unread:hover { background: rgba(201,168,76,0.08); }
        .notif-icon { width: 32px; height: 32px; border-radius: 8px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; }
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
        .notif-footer { padding: 0.7rem 1.1rem; border-top: 1px solid var(--border); flex-shrink: 0; }
        .notif-see-all { display: flex; align-items: center; justify-content: center; gap: 0.35rem; font-size: 0.75rem; font-weight: 500; color: var(--gold-dark); text-decoration: none; transition: color 0.2s; }
        .notif-see-all:hover { color: var(--charcoal); }
        .notif-see-all svg { width: 12px; height: 12px; }

        /* ════════════════════════════════
           USER PILL
        ════════════════════════════════ */
        .user-pill { display: flex; align-items: center; gap: 0.55rem; padding: 0.3rem 0.7rem 0.3rem 0.3rem; background: var(--white); border: 1.5px solid var(--border-md); border-radius: 999px; cursor: pointer; transition: border-color 0.2s, box-shadow 0.2s; position: relative; flex-shrink: 0; }
        .user-pill:hover { border-color: var(--gold); box-shadow: 0 2px 8px rgba(201,168,76,0.12); }
        .user-avatar { width: 28px; height: 28px; border-radius: 50%; background: linear-gradient(135deg, var(--gold), var(--gold-dark)); display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: 0.68rem; font-weight: 700; color: var(--white); flex-shrink: 0; overflow: hidden; }
        .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .user-name { font-size: 0.79rem; font-weight: 500; color: var(--charcoal); max-width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-role-chip { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: var(--gold-dark); background: rgba(201,168,76,0.1); border: 1px solid rgba(201,168,76,0.25); padding: 1px 7px; border-radius: 999px; white-space: nowrap; }
        .user-pill > svg { width: 11px; height: 11px; color: #C0B8B0; }
        .user-dropdown { display: none; position: absolute; top: calc(100% + 8px); right: 0; min-width: 215px; background: var(--white); border: 1px solid var(--border-md); border-top: 2px solid var(--gold); border-radius: 4px; box-shadow: 0 8px 32px rgba(30,27,24,0.12); padding: 0.5rem; z-index: 400; animation: dropFadeIn 0.18s var(--ease-out); }
        .user-pill:hover .user-dropdown, .user-pill:focus-within .user-dropdown { display: block; }
        .dropdown-user-header { display: flex; align-items: center; gap: 0.65rem; padding: 0.6rem 0.75rem 0.75rem; border-bottom: 1px solid var(--border); margin-bottom: 0.4rem; }
        .dropdown-user-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, var(--gold), var(--gold-dark)); display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: 0.85rem; font-weight: 700; color: var(--white); flex-shrink: 0; overflow: hidden; }
        .dropdown-user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .dropdown-user-name { font-size: 0.84rem; font-weight: 600; color: var(--charcoal); }
        .dropdown-user-email { font-size: 0.68rem; color: var(--warm-grey); margin-top: 1px; }
        .dropdown-item { display: flex; align-items: center; gap: 0.6rem; padding: 0.55rem 0.75rem; border-radius: 4px; font-size: 0.81rem; color: var(--charcoal); text-decoration: none; transition: background 0.15s, color 0.15s; cursor: pointer; border: none; background: none; width: 100%; text-align: left; font-family: var(--font-body); }
        .dropdown-item svg { width: 14px; height: 14px; color: var(--warm-grey); flex-shrink: 0; }
        .dropdown-item:hover { background: var(--ivory); color: var(--gold-dark); }
        .dropdown-item:hover svg { color: var(--gold-dark); }
        .dropdown-item.active-page { background: rgba(201,168,76,0.08); color: var(--gold-dark); font-weight: 500; }
        .dropdown-item.active-page svg { color: var(--gold-dark); }
        .dropdown-divider { height: 1px; background: var(--border); margin: 0.35rem 0; }
        .dropdown-item.danger { color: #B91C1C; }
        .dropdown-item.danger svg { color: #B91C1C; }
        .dropdown-item.danger:hover { background: #FEF2F2; }

        /* ════════════════════════════════
           HAMBURGER BUTTON
        ════════════════════════════════ */
        .hamburger-btn { display: none; width: 36px; height: 36px; border-radius: 8px; border: 1.5px solid var(--border-md); background: var(--white); flex-direction: column; align-items: center; justify-content: center; gap: 4.5px; cursor: pointer; padding: 9px; transition: border-color 0.2s; flex-shrink: 0; }
        .hamburger-btn:hover { border-color: var(--gold); }
        .hamburger-btn span { display: block; width: 100%; height: 2px; background: var(--charcoal); border-radius: 2px; transition: transform 0.3s, opacity 0.3s, background 0.2s; }
        .hamburger-btn.open span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); background: var(--gold-dark); }
        .hamburger-btn.open span:nth-child(2) { opacity: 0; }
        .hamburger-btn.open span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); background: var(--gold-dark); }

        /* ════════════════════════════════
           MOBILE NAV DRAWER
           (hamburger → drops from topbar)
        ════════════════════════════════ */
        .mob-overlay { display: none; position: fixed; inset: 0; background: rgba(30,27,24,0.45); z-index: 150; backdrop-filter: blur(2px); }
        .mob-overlay.visible { display: block; }

        .mobile-drawer {
            position: fixed; top: var(--topbar-h); left: 0; right: 0;
            background: var(--white); border-bottom: 2px solid var(--border-md);
            z-index: 200; overflow-y: auto; max-height: calc(100dvh - var(--topbar-h));
            box-shadow: 0 16px 48px rgba(30,27,24,0.14);
            transform: translateY(-12px); opacity: 0; pointer-events: none;
            transition: transform 0.3s var(--ease-out), opacity 0.25s;
            padding-bottom: env(safe-area-inset-bottom, 1.5rem);
        }
        .mobile-drawer.open { transform: translateY(0); opacity: 1; pointer-events: auto; }

        /* User strip */
        .mob-user-strip { display: flex; align-items: center; gap: 0.85rem; padding: 1.1rem 1.25rem 0.9rem; border-bottom: 1px solid var(--border); background: var(--charcoal); }
        .mob-user-avatar { width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, var(--gold), var(--gold-dark)); display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: 0.82rem; font-weight: 700; color: var(--white); flex-shrink: 0; overflow: hidden; border: 2px solid rgba(201,168,76,0.4); }
        .mob-user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .mob-user-info { flex: 1; min-width: 0; }
        .mob-user-name { font-size: 0.88rem; font-weight: 600; color: var(--white); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .mob-user-role { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--gold-light); margin-top: 2px; }

        /* Mobile search */
        .mob-search-wrap { padding: 0.9rem 1.25rem 0.4rem; }
        .mob-search-inner { display: flex; align-items: center; gap: 0.5rem; background: var(--ivory); border: 1.5px solid var(--border-md); border-radius: 8px; padding: 0.52rem 0.9rem; transition: border-color 0.2s, box-shadow 0.2s; }
        .mob-search-inner:focus-within { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,0.1); }
        .mob-search-inner svg { width: 14px; height: 14px; color: #C0B8B0; flex-shrink: 0; }
        .mob-search-inner input { border: none; outline: none; background: transparent; font-family: var(--font-body); font-size: 0.82rem; color: var(--charcoal); width: 100%; }
        .mob-search-inner input::placeholder { color: #C0B8B0; }

        /* Section label */
        .mob-nav-label { font-size: 0.52rem; font-weight: 700; letter-spacing: 0.18em; text-transform: uppercase; color: #C0B8B0; padding: 0.75rem 1.25rem 0.3rem; }

        /* Nav items */
        .mob-nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1.25rem; font-family: var(--font-body); font-size: 0.85rem; font-weight: 400; color: var(--warm-grey); text-decoration: none; transition: background 0.18s, color 0.18s, border-left-color 0.18s; border-left: 3px solid transparent; }
        .mob-nav-item svg { width: 17px; height: 17px; flex-shrink: 0; opacity: 0.6; transition: opacity 0.18s; }
        .mob-nav-item:hover { background: rgba(201,168,76,0.06); color: var(--gold-dark); border-left-color: rgba(201,168,76,0.3); }
        .mob-nav-item:hover svg { opacity: 1; }
        .mob-nav-item.active { background: linear-gradient(90deg, rgba(201,168,76,0.12) 0%, rgba(201,168,76,0.04) 100%); color: var(--gold-dark); font-weight: 600; border-left-color: var(--gold); }
        .mob-nav-item.active svg { opacity: 1; color: var(--gold-dark); }
        .mob-nav-badge { margin-left: auto; background: var(--gold); color: var(--charcoal); font-size: 0.56rem; font-weight: 700; padding: 1px 6px; border-radius: 999px; line-height: 1.6; }
        .mob-nav-item.active .mob-nav-badge { background: var(--gold-dark); color: var(--white); }
        .mob-divider { height: 1px; background: var(--border); margin: 0.4rem 1.25rem; }

        /* Sign out */
        .mob-signout-row { padding: 0.75rem 1.25rem 0.5rem; }
        .mob-signout-btn { display: flex; align-items: center; gap: 0.65rem; width: 100%; padding: 0.7rem 1rem; border-radius: 8px; background: rgba(185,28,28,0.06); border: 1px solid rgba(185,28,28,0.18); font-family: var(--font-body); font-size: 0.82rem; font-weight: 500; color: #B91C1C; cursor: pointer; transition: background 0.2s; }
        .mob-signout-btn:hover { background: rgba(185,28,28,0.12); }
        .mob-signout-btn svg { width: 15px; height: 15px; }

        /* ════════════════════════════════
           MAIN CONTENT
        ════════════════════════════════ */
        .main-wrapper { padding-top: var(--topbar-h); min-height: 100vh; background: var(--ivory); }
        .page-content { padding: 0; }

        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #DDD4C8; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--gold); }

        /* ════════════════════════════════
           RESPONSIVE
        ════════════════════════════════ */
        /* ≤960px: hide desktop nav, show hamburger */
        @media (max-width: 960px) {
            .topbar-nav { display: none; }
            .topbar-logo-divider { display: none; }
            .hamburger-btn { display: flex; }
        }

        /* ≤768px: hide desktop msg dropdown, show mobile drawer instead */
        @media (max-width: 768px) {
            .msg-dropdown { display: none !important; }
        }

        /* ≤640px: hide search & user labels */
        @media (max-width: 640px) {
            .topbar-search { display: none; }
            .user-name, .user-role-chip { display: none; }
            .topbar { padding: 0 1rem; gap: 0.5rem; }
            .topbar-right { gap: 0.4rem; }
        }

        /* ≤400px: tighten spacing */
        @media (max-width: 400px) {
            .topbar { padding: 0 0.75rem; gap: 0.35rem; }
            .topbar-right { gap: 0.3rem; }
            .msg-trigger, .icon-btn, .hamburger-btn { width: 33px; height: 33px; }
        }
    </style>
</head>

<body>

    {{-- ══════════════════════════════════════════════════════
         MOBILE MESSAGE OVERLAY + SLIDE-UP DRAWER
         Placed at body root — never clipped by any parent.
    ══════════════════════════════════════════════════════ --}}
    @auth
        @include('layouts.mobile_responsive')
    @endauth

    {{-- ══════════════════════
         TOP BAR
    ══════════════════════ --}}
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
        /* ═══════════════════════════════
           MOBILE NAV DRAWER (hamburger)
        ═══════════════════════════════ */
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const mobileDrawer = document.getElementById('mobileDrawer');
        const mobOverlay   = document.getElementById('mobOverlay');

        function openMobDrawer() {
            mobileDrawer?.classList.add('open');
            hamburgerBtn?.classList.add('open');
            mobOverlay?.classList.add('visible');
            hamburgerBtn?.setAttribute('aria-expanded', 'true');
            mobileDrawer?.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            closeAllDropdowns();
            closeMobileMsg(); // close msg drawer if open
        }
        function closeMobDrawer() {
            mobileDrawer?.classList.remove('open');
            hamburgerBtn?.classList.remove('open');
            mobOverlay?.classList.remove('visible');
            hamburgerBtn?.setAttribute('aria-expanded', 'false');
            mobileDrawer?.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
        hamburgerBtn?.addEventListener('click', e => {
            e.stopPropagation();
            mobileDrawer?.classList.contains('open') ? closeMobDrawer() : openMobDrawer();
        });
        mobOverlay?.addEventListener('click', closeMobDrawer);

        /* ═══════════════════════════════
           NOTIFICATIONS
        ═══════════════════════════════ */
        function toggleNotif(e) {
            e.stopPropagation();
            const nd      = document.getElementById('notifDropdown');
            const wasOpen = nd?.classList.contains('open');
            closeAllDropdowns(); closeMobDrawer();
            if (!wasOpen) nd?.classList.add('open');
        }

        /* ═══════════════════════════════
           MESSAGES — responsive
           ≤768px → mobile slide-up drawer
           ≥769px → desktop dropdown
        ═══════════════════════════════ */
        function toggleMsg(e) {
            e.stopPropagation();

            if (window.innerWidth <= 768) {
                // Mobile: open slide-up drawer
                closeAllDropdowns();
                closeMobDrawer();
                openMobileMsg();
            } else {
                // Desktop: toggle dropdown
                const md      = document.getElementById('msgDropdown');
                const wasOpen = md?.classList.contains('open');
                closeAllDropdowns();
                if (!wasOpen) md?.classList.add('open');
            }
        }

        /* Mobile message drawer helpers */
        function openMobileMsg() {
            document.getElementById('msgMobileOverlay')?.classList.add('open');
            document.getElementById('msgMobileDrawer')?.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function closeMobileMsg() {
            document.getElementById('msgMobileOverlay')?.classList.remove('open');
            document.getElementById('msgMobileDrawer')?.classList.remove('open');
            document.body.style.overflow = '';
        }

        /* Desktop filter tabs */
        function msgFilter(btn) {
            document.querySelectorAll('#msgDropdown .msg-drop-tab').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const f = btn.dataset.msgFilter;
            document.querySelectorAll('#msgList .msg-item').forEach(item => {
                item.style.display = (f === 'all' || (f === 'unread' && item.dataset.msgUnread === '1') || (f === 'groups' && item.dataset.msgType === 'group')) ? '' : 'none';
            });
        }

        /* Mobile filter tabs */
        function mobileFilter(btn) {
            document.querySelectorAll('#msgMobileDrawer .msg-drop-tab').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const f = btn.dataset.msgFilter;
            document.querySelectorAll('#msgMobileList .msg-item').forEach(item => {
                item.style.display = (f === 'all' || (f === 'unread' && item.dataset.msgUnread === '1') || (f === 'groups' && item.dataset.msgType === 'group')) ? '' : 'none';
            });
        }

        /* ═══════════════════════════════
           GLOBAL CLOSE
        ═══════════════════════════════ */
        function closeAllDropdowns() {
            document.getElementById('notifDropdown')?.classList.remove('open');
            document.getElementById('msgDropdown')?.classList.remove('open');
        }

        document.addEventListener('click', e => {
            if (!e.target.closest('.notif-wrap') && !e.target.closest('.msg-wrap')) closeAllDropdowns();
            if (!e.target.closest('.mobile-drawer') && !e.target.closest('.hamburger-btn')) closeMobDrawer();
        });
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') { closeAllDropdowns(); closeMobDrawer(); closeMobileMsg(); }
        });

        /* ═══════════════════════════════
           NOTIFICATION HELPERS
        ═══════════════════════════════ */
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

        /* ═══════════════════════════════
           SWIPE-DOWN to close msg drawer
        ═══════════════════════════════ */
        (function () {
            const drawer = document.getElementById('msgMobileDrawer');
            if (!drawer) return;
            let startY = 0;
            drawer.addEventListener('touchstart', e => { startY = e.touches[0].clientY; }, { passive: true });
            drawer.addEventListener('touchmove',  e => {
                const diff = e.touches[0].clientY - startY;
                if (diff > 0) { drawer.style.transform = `translateY(${diff}px)`; drawer.style.transition = 'none'; }
            }, { passive: true });
            drawer.addEventListener('touchend', e => {
                const diff = e.changedTouches[0].clientY - startY;
                drawer.style.transform = ''; drawer.style.transition = '';
                if (diff > 90) closeMobileMsg();
            });
        })();
    </script>
</body>
</html>