<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Bikols Craft') }} — @isset($title){{ $title }}@else Dashboard @endisset</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

        <!-- Scripts -->
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
                --sidebar-w:   260px;
                --topbar-h:    64px;
                --white:       #FFFFFF;
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
                background: rgba(250,247,242,0.92);
                backdrop-filter: blur(16px);
                border-bottom: 1px solid rgba(201,168,76,0.18);
                transition: padding 0.3s;
            }
            .topbar.sidebar-collapsed {
                padding-left: calc(72px + 1.5rem);
            }

            /* Page heading area */
            .topbar-heading {
                display: flex;
                flex-direction: column;
                gap: 0.1rem;
            }
            .topbar-heading h1 {
                font-family: var(--font-display);
                font-size: 1.25rem;
                font-weight: 700;
                color: var(--charcoal);
                line-height: 1.2;
            }
            .topbar-breadcrumb {
                display: flex;
                align-items: center;
                gap: 0.4rem;
                font-size: 0.72rem;
                color: var(--warm-grey);
                letter-spacing: 0.03em;
            }
            .topbar-breadcrumb span { color: var(--gold-dark); }
            .topbar-breadcrumb svg { width: 10px; height: 10px; color: #C0B8B0; }

            /* Right controls */
            .topbar-right {
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }

            /* Search bar */
            .topbar-search {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                background: var(--white);
                border: 1.5px solid #E5DDD5;
                border-radius: 8px;
                padding: 0.42rem 0.9rem;
                transition: border-color 0.2s, box-shadow 0.2s;
            }
            .topbar-search:focus-within {
                border-color: var(--gold);
                box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
            }
            .topbar-search svg { width: 14px; height: 14px; color: #C0B8B0; flex-shrink: 0; }
            .topbar-search input {
                border: none; outline: none;
                background: transparent;
                font-family: var(--font-body);
                font-size: 0.8rem;
                color: var(--charcoal);
                width: 180px;
            }
            .topbar-search input::placeholder { color: #C0B8B0; }

            /* Icon buttons */
            .icon-btn {
                width: 36px; height: 36px;
                border-radius: 8px;
                border: 1.5px solid #E5DDD5;
                background: var(--white);
                display: flex; align-items: center; justify-content: center;
                cursor: pointer;
                color: var(--warm-grey);
                transition: border-color 0.2s, color 0.2s, background 0.2s;
                position: relative;
                text-decoration: none;
            }
            .icon-btn:hover {
                border-color: var(--gold);
                color: var(--gold-dark);
                background: rgba(201,168,76,0.06);
            }
            .icon-btn svg { width: 16px; height: 16px; }
            .notif-badge {
                position: absolute;
                top: -3px; right: -3px;
                width: 8px; height: 8px;
                border-radius: 50%;
                background: var(--gold);
                border: 2px solid var(--ivory);
            }

            /* Avatar / User dropdown */
            .user-pill {
                display: flex;
                align-items: center;
                gap: 0.6rem;
                padding: 0.32rem 0.75rem 0.32rem 0.32rem;
                background: var(--white);
                border: 1.5px solid #E5DDD5;
                border-radius: 999px;
                cursor: pointer;
                transition: border-color 0.2s, box-shadow 0.2s;
                position: relative;
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
                font-size: 0.7rem;
                font-weight: 700;
                color: var(--white);
                flex-shrink: 0;
            }
            .user-name {
                font-size: 0.8rem;
                font-weight: 500;
                color: var(--charcoal);
                max-width: 100px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .user-pill svg { width: 12px; height: 12px; color: #C0B8B0; }

            /* Dropdown menu */
            .user-dropdown {
                display: none;
                position: absolute;
                top: calc(100% + 8px);
                right: 0;
                min-width: 200px;
                background: var(--white);
                border: 1px solid #E5DDD5;
                border-radius: 10px;
                box-shadow: 0 8px 32px rgba(30,27,24,0.12);
                padding: 0.5rem;
                z-index: 200;
            }
            .user-pill:hover .user-dropdown,
            .user-pill:focus-within .user-dropdown { display: block; }
            .dropdown-item {
                display: flex; align-items: center; gap: 0.6rem;
                padding: 0.6rem 0.75rem;
                border-radius: 6px;
                font-size: 0.82rem;
                color: var(--charcoal);
                text-decoration: none;
                transition: background 0.15s, color 0.15s;
                cursor: pointer;
                border: none; background: none; width: 100%; text-align: left;
                font-family: var(--font-body);
            }
            .dropdown-item svg { width: 14px; height: 14px; color: var(--warm-grey); }
            .dropdown-item:hover { background: var(--ivory); color: var(--gold-dark); }
            .dropdown-item:hover svg { color: var(--gold-dark); }
            .dropdown-divider {
                height: 1px; background: #F0EBE5;
                margin: 0.4rem 0;
            }
            .dropdown-item.danger { color: #C0392B; }
            .dropdown-item.danger svg { color: #C0392B; }
            .dropdown-item.danger:hover { background: #FFF5F5; }

            /* ════════════════════════════════
               SIDEBAR
            ════════════════════════════════ */
            .sidebar {
                position: fixed;
                top: 0; left: 0; bottom: 0;
                width: var(--sidebar-w);
                background: var(--charcoal);
                display: flex;
                flex-direction: column;
                z-index: 110;
                transition: width 0.3s cubic-bezier(0.4,0,0.2,1);
                overflow: hidden;
            }
            .sidebar.collapsed {
                width: 72px;
            }

            /* Sidebar top: logo + toggle */
            .sidebar-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 1.1rem;
                height: var(--topbar-h);
                border-bottom: 1px solid rgba(201,168,76,0.12);
                flex-shrink: 0;
            }
            .sidebar-logo {
                font-family: var(--font-display);
                font-size: 1.2rem;
                font-weight: 700;
                color: var(--white);
                white-space: nowrap;
                overflow: hidden;
                opacity: 1;
                transition: opacity 0.2s;
                text-decoration: none;
            }
            .sidebar-logo em { color: var(--gold-light); font-style: italic; }
            .sidebar.collapsed .sidebar-logo { opacity: 0; pointer-events: none; }

            /* Collapse toggle button */
            .sidebar-toggle {
                width: 28px; height: 28px;
                border-radius: 6px;
                border: 1px solid rgba(201,168,76,0.2);
                background: rgba(201,168,76,0.08);
                display: flex; align-items: center; justify-content: center;
                cursor: pointer;
                color: rgba(255,255,255,0.5);
                transition: background 0.2s, color 0.2s;
                flex-shrink: 0;
            }
            .sidebar-toggle:hover { background: rgba(201,168,76,0.18); color: var(--gold-light); }
            .sidebar-toggle svg { width: 14px; height: 14px; transition: transform 0.3s; }
            .sidebar.collapsed .sidebar-toggle svg { transform: rotate(180deg); }

            /* Navigation groups */
            .sidebar-nav {
                flex: 1;
                overflow-y: auto;
                overflow-x: hidden;
                padding: 1rem 0;
                scrollbar-width: none;
            }
            .sidebar-nav::-webkit-scrollbar { display: none; }

            .nav-group-label {
                font-size: 0.6rem;
                letter-spacing: 0.14em;
                text-transform: uppercase;
                color: rgba(255,255,255,0.25);
                padding: 0.6rem 1.2rem 0.3rem;
                white-space: nowrap;
                overflow: hidden;
                transition: opacity 0.2s;
            }
            .sidebar.collapsed .nav-group-label { opacity: 0; }

            /* Nav items */
            .nav-item {
                display: flex;
                align-items: center;
                gap: 0.85rem;
                padding: 0.7rem 1.2rem;
                color: rgba(255,255,255,0.5);
                text-decoration: none;
                font-size: 0.85rem;
                font-weight: 400;
                letter-spacing: 0.01em;
                transition: background 0.2s, color 0.2s, padding 0.3s;
                position: relative;
                white-space: nowrap;
                cursor: pointer;
                border: none;
                background: none;
                width: 100%;
                text-align: left;
                font-family: var(--font-body);
            }
            .sidebar.collapsed .nav-item { padding: 0.7rem; justify-content: center; }
            .nav-item svg {
                width: 18px; height: 18px;
                flex-shrink: 0;
                transition: color 0.2s;
            }
            .nav-item span {
                transition: opacity 0.2s, width 0.3s;
                overflow: hidden;
            }
            .sidebar.collapsed .nav-item span { opacity: 0; width: 0; }

            .nav-item:hover {
                background: rgba(201,168,76,0.08);
                color: rgba(255,255,255,0.85);
            }
            .nav-item.active {
                background: rgba(201,168,76,0.12);
                color: var(--gold-light);
                font-weight: 500;
            }
            .nav-item.active::before {
                content: '';
                position: absolute;
                left: 0; top: 0; bottom: 0;
                width: 3px;
                background: var(--gold);
                border-radius: 0 2px 2px 0;
            }

            /* Tooltip for collapsed state */
            .nav-item .nav-tooltip {
                display: none;
                position: absolute;
                left: 100%;
                top: 50%;
                transform: translateY(-50%);
                margin-left: 8px;
                background: var(--charcoal);
                border: 1px solid rgba(201,168,76,0.2);
                color: var(--white);
                font-size: 0.75rem;
                padding: 0.3rem 0.65rem;
                border-radius: 6px;
                white-space: nowrap;
                pointer-events: none;
                box-shadow: 0 4px 12px rgba(0,0,0,0.2);
                z-index: 300;
            }
            .sidebar.collapsed .nav-item:hover .nav-tooltip { display: block; }

            /* Badge on nav item */
            .nav-badge {
                margin-left: auto;
                background: var(--gold);
                color: var(--charcoal);
                font-size: 0.6rem;
                font-weight: 700;
                padding: 0.1rem 0.42rem;
                border-radius: 999px;
                flex-shrink: 0;
                transition: opacity 0.2s;
            }
            .sidebar.collapsed .nav-badge { opacity: 0; }

            /* Sidebar divider */
            .sidebar-divider {
                height: 1px;
                background: rgba(201,168,76,0.1);
                margin: 0.5rem 1.2rem;
            }
            .sidebar.collapsed .sidebar-divider { margin: 0.5rem 0.8rem; }

            /* Sidebar footer */
            .sidebar-footer {
                padding: 1rem;
                border-top: 1px solid rgba(201,168,76,0.12);
                flex-shrink: 0;
            }
            .sidebar-user {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.6rem 0.75rem;
                border-radius: 8px;
                transition: background 0.2s;
                cursor: pointer;
                text-decoration: none;
            }
            .sidebar-user:hover { background: rgba(201,168,76,0.08); }
            .sidebar-user-avatar {
                width: 32px; height: 32px;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--gold), var(--gold-dark));
                display: flex; align-items: center; justify-content: center;
                font-family: var(--font-display);
                font-size: 0.75rem; font-weight: 700;
                color: var(--white); flex-shrink: 0;
            }
            .sidebar-user-info { overflow: hidden; transition: opacity 0.2s, width 0.3s; }
            .sidebar.collapsed .sidebar-user-info { opacity: 0; width: 0; }
            .sidebar-user-name {
                font-size: 0.82rem; font-weight: 500;
                color: rgba(255,255,255,0.85);
                white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            }
            .sidebar-user-role {
                font-size: 0.68rem;
                color: var(--gold-light);
                white-space: nowrap;
            }

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
            .main-wrapper.sidebar-collapsed {
                margin-left: 72px;
            }

            /* Page header band (below topbar) */
            .page-header {
                background: var(--white);
                border-bottom: 1px solid #F0EBE5;
                padding: 1.25rem 2rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 1rem;
            }
            .page-header h1 {
                font-family: var(--font-display);
                font-size: 1.5rem;
                font-weight: 700;
                color: var(--charcoal);
            }
            .page-header h1 em { font-style: italic; color: var(--gold-dark); }

            /* Slot content area */
            .page-content {
                padding: 2rem;
            }

            /* ════════════════════════════════
               MOBILE SIDEBAR OVERLAY
            ════════════════════════════════ */
            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(30,27,24,0.45);
                z-index: 105;
                backdrop-filter: blur(2px);
            }
            .sidebar-overlay.visible { display: block; }

            /* Mobile topbar adjustments */
            @media (max-width: 768px) {
                .topbar {
                    padding-left: 1rem;
                }
                .sidebar {
                    transform: translateX(-100%);
                    width: var(--sidebar-w) !important;
                    transition: transform 0.35s cubic-bezier(0.4,0,0.2,1);
                }
                .sidebar.mobile-open {
                    transform: translateX(0);
                }
                .main-wrapper {
                    margin-left: 0 !important;
                }
                .topbar-search { display: none; }
                .user-name { display: none; }
            }

            /* Mobile toggle in topbar */
            .mobile-menu-btn {
                display: none;
                width: 36px; height: 36px;
                border-radius: 8px;
                border: 1.5px solid #E5DDD5;
                background: var(--white);
                align-items: center; justify-content: center;
                cursor: pointer;
                color: var(--warm-grey);
                flex-direction: column;
                gap: 4px;
                padding: 8px;
            }
            .mobile-menu-btn span {
                display: block; width: 100%; height: 2px;
                background: var(--charcoal); border-radius: 2px;
                transition: transform 0.3s, opacity 0.3s;
            }
            @media (max-width: 768px) {
                .mobile-menu-btn { display: flex; }
                .sidebar-toggle { display: none; }
            }

            /* ════════════════════════════════
               SCROLLBAR
            ════════════════════════════════ */
            ::-webkit-scrollbar { width: 5px; height: 5px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { background: #DDD4C8; border-radius: 3px; }
            ::-webkit-scrollbar-thumb:hover { background: var(--gold); }
            
        </style>
    </head>
    <body>
        <!-- ════ SIDEBAR ════ -->
        
        @auth
            @include('layouts.supplier-sidebar')
        @endauth
        

        <!-- Mobile overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- ════ TOP BAR ════ -->
        <header class="topbar" id="topbar">
            <!-- Mobile hamburger -->
            <button class="mobile-menu-btn" id="mobileSidebarBtn" aria-label="Open sidebar">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <!-- Page heading / breadcrumb -->
            <div class="topbar-heading">
                @isset($header)
                    {{ $header }}
                @else
                    <h1>Dashboard</h1>
                    <div class="topbar-breadcrumb">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 6h8M6 2l4 4-4 4"/></svg>
                        <span>Home</span>
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 2l4 4-4 4"/></svg>
                        <span>Dashboard</span>
                    </div>
                @endisset
            </div>

            <!-- Right controls -->
            @auth
                @include('layouts.navigation')
            @endauth
        </header>

        <!-- ════ MAIN ════ -->
        <div class="main-wrapper" id="mainWrapper">

            <!-- Page content slot -->
            <main class="page-content">
                {{ $slot }}
            </main>

        </div>

        <script>
            const sidebar        = document.getElementById('sidebar');
            const sidebarToggle  = document.getElementById('sidebarToggle');
            const topbar         = document.getElementById('topbar');
            const mainWrapper    = document.getElementById('mainWrapper');
            const overlay        = document.getElementById('sidebarOverlay');
            const mobileBtn      = document.getElementById('mobileSidebarBtn');

            /* ── Desktop collapse ── */
            sidebarToggle.addEventListener('click', () => {
                const isCollapsed = sidebar.classList.toggle('collapsed');
                mainWrapper.classList.toggle('sidebar-collapsed', isCollapsed);
                topbar.classList.toggle('sidebar-collapsed', isCollapsed);
                localStorage.setItem('sidebarCollapsed', isCollapsed);
            });

            /* Restore state */
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                sidebar.classList.add('collapsed');
                mainWrapper.classList.add('sidebar-collapsed');
                topbar.classList.add('sidebar-collapsed');
            }

            /* ── Mobile open/close ── */
            mobileBtn.addEventListener('click', () => {
                sidebar.classList.toggle('mobile-open');
                overlay.classList.toggle('visible');
                document.body.style.overflow = sidebar.classList.contains('mobile-open') ? 'hidden' : '';
            });

            overlay.addEventListener('click', closeMobile);

            function closeMobile() {
                sidebar.classList.remove('mobile-open');
                overlay.classList.remove('visible');
                document.body.style.overflow = '';
            }

            /* Close on nav link click (mobile) */
            sidebar.querySelectorAll('.nav-item').forEach(item => {
                item.addEventListener('click', () => {
                    if (window.innerWidth <= 768) closeMobile();
                });
            });
        </script>
    </body>
</html>