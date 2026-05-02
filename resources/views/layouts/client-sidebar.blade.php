<aside class="sidebar" id="sidebar">
    <!-- Header -->
    <div class="sidebar-header">
        <a href="{{ url('/') }}" class="sidebar-logo">Bikol's<em>Craft</em></a>
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Collapse sidebar">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M13 5l-5 5 5 5"/>
            </svg>
        </button>
    </div>

    <!-- Nav -->
    <nav class="sidebar-nav">

        <div class="nav-group-label">Overview</div>

        {{-- Dashboard --}}
        <a href="{{ route('client.dashboard') }}"
           class="nav-item {{ request()->is('client/dashboard') || request()->routeIs('client.dashboard') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M3 10L10 3l7 7M5 8v8h4v-5h2v5h4V8"/>
            </svg>
            <span>Dashboard</span>
            <span class="nav-tooltip">Dashboard</span>
        </a>

        {{-- My Events --}}
        <a href="{{ route('client.events') }}"
           class="nav-item {{ request()->is('client/events*') || request()->routeIs('client.events*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <rect x="3" y="4" width="14" height="13" rx="2"/>
                <path d="M7 2v4M13 2v4M3 9h14"/>
            </svg>
            <span>My Events</span>
            <span class="nav-tooltip">My Events</span>
            <span class="nav-badge">2</span>
        </a>

        {{-- My Bookings --}}
        <a href="{{ route('client.bookings.index') }}"
           class="nav-item {{ request()->is('client/bookings*') || request()->routeIs('client.bookings*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M9 12l2 2 4-4M7 3H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2h-2"/>
                <rect x="7" y="1" width="6" height="4" rx="1"/>
            </svg>
            <span>My Bookings</span>
            <span class="nav-tooltip">My Bookings</span>
            <span class="nav-badge">5</span>
        </a>

        {{-- Messages --}}
        <a href="{{ route('client.inbox') }}"
           class="nav-item {{ request()->is('client/messages*') || request()->is('client/inbox*') || request()->routeIs('client.inbox*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/>
            </svg>
            <span>Messages</span>
            <span class="nav-tooltip">Messages</span>
            <span class="nav-badge">3</span>
        </a>

        <div class="sidebar-divider"></div>
        <div class="nav-group-label">Planning</div>

        <a href="{{ route('client.browse.suppliers') }}"
           class="nav-item {{ request()->is('client/browse/suppliers*') || request()->routeIs('client.browse.suppliers*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="9" cy="8" r="4"/>
                <path d="M2 17c0-3.3 3.1-6 7-6"/>
                <path d="M17 14l-3-3-3 3M14 11v6"/>
            </svg>
            <span>Explore</span>
            <span class="nav-tooltip">Explore</span>
        </a>
        

        {{-- AI Recommendations 
        <a href="#"
           class="nav-item {{ request()->is('client/shows*') || request()->is('client/recommendations*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M10 2a2 2 0 012 2c0 .8-.4 1.5-1 1.9V7h2a1 1 0 011 1v1a3 3 0 01-3 3v1.1c.6.4 1 1.1 1 1.9a2 2 0 01-4 0c0-.8.4-1.5 1-1.9V12a3 3 0 01-3-3V8a1 1 0 011-1h2V5.9A2 2 0 0110 2z"/>
                <circle cx="10" cy="2" r="0"/>
                <path d="M6 17h8"/>
            </svg>
            <span>AI Recommendations</span>
            <span class="nav-tooltip">AI Recommendations</span>
        </a>--}}

        {{-- Shortlist 
        <a href="#"
           class="nav-item {{ request()->is('client/shortlist*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M10 3.5l1.8 3.6 4 .6-2.9 2.8.7 4L10 12.5l-3.6 1.9.7-4L4.2 7.7l4-.6z"/>
            </svg>
            <span>Shortlist</span>
            <span class="nav-tooltip">Shortlist</span>
        </a>--}}

        {{-- Budget Tracker 
        <a href="#"
           class="nav-item {{ request()->is('client/budget*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <line x1="10" y1="2" x2="10" y2="18"/>
                <path d="M14 6H7.5a2.5 2.5 0 000 5h5a2.5 2.5 0 010 5H6"/>
            </svg>
            <span>Budget Tracker</span>
            <span class="nav-tooltip">Budget Tracker</span>
        </a>--}}

        {{-- Timeline --}}
        <a href="{{ route('client.timeline') }}"
           class="nav-item {{ request()->is('client/timeline*') || request()->routeIs('client.timeline*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="10" cy="10" r="8"/>
                <path d="M10 6v4l3 3"/>
            </svg>
            <span>Timeline</span>
            <span class="nav-tooltip">Timeline</span>
        </a>

        {{-- Guest List --}}
        <a href="#"
           class="nav-item {{ request()->is('client/guests*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="7" cy="7" r="3"/>
                <circle cx="14" cy="7" r="3"/>
                <path d="M1 17c0-3 2.7-5 6-5M9 17c0-3 2.7-5 6-5"/>
            </svg>
            <span>Guest List</span>
            <span class="nav-tooltip">Guest List</span>
        </a>

        <div class="sidebar-divider"></div>
        <div class="nav-group-label">Payments</div>

        {{-- Payments --}}
        <a href="#"
           class="nav-item {{ request()->is('client/payments*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <rect x="2" y="5" width="16" height="11" rx="2"/>
                <path d="M2 9h16M6 13h3"/>
            </svg>
            <span>Payments</span>
            <span class="nav-tooltip">Payments</span>
        </a>

        {{-- Invoices --}}
        <a href="#"
           class="nav-item {{ request()->is('client/invoices*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <rect x="4" y="2" width="12" height="16" rx="2"/>
                <path d="M7 7h6M7 10h6M7 13h4"/>
            </svg>
            <span>Invoices</span>
            <span class="nav-tooltip">Invoices</span>
        </a>
 
        {{--<div class="sidebar-divider"></div>
        <div class="nav-group-label">Account</div>--}}

        {{-- My Profile 
        <a href="{{ route('client.profile') ?? '#' }}"
           class="nav-item {{ request()->is('client/profile*') || request()->routeIs('client.profile*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="10" cy="7" r="4"/>
                <path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/>
            </svg>
            <span>My Profile</span>
            <span class="nav-tooltip">My Profile</span>
        </a>--}}

        {{-- Settings 
        <a href="#"
           class="nav-item {{ request()->is('client/settings*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="10" cy="10" r="3"/>
                <path d="M10 1v2M10 17v2M1 10h2M17 10h2M3.2 3.2l1.4 1.4M15.4 15.4l1.4 1.4M3.2 16.8l1.4-1.4M15.4 4.6l1.4-1.4"/>
            </svg>
            <span>Settings</span>
            <span class="nav-tooltip">Settings</span>
        </a>--}}

    </nav>

    <!-- Footer: user info + logout icon side by side -->
    <div class="sidebar-footer">
        <div class="sidebar-user-row">
            <a href="{{ route('client.profile') ?? '#' }}" class="sidebar-user">
                <div class="sidebar-user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                </div>
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name">{{ Auth::user()->name ?? 'Guest User' }}</div>
                    <div class="sidebar-user-role">Event Client</div>
                </div>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="sidebar-logout-form">
                @csrf
                <button type="submit" class="sidebar-logout-btn" title="Sign Out">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M13 5l4 5-4 5M17 10H8M10 3H5a2 2 0 00-2 2v10a2 2 0 002 2h5"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>

    <style>
        /* ── Sidebar footer: user + logout inline ── */
        .sidebar-footer {
            padding: 0.75rem 1rem;
            border-top: 1px solid rgba(255,255,255,0.07);
            flex-shrink: 0;
        }

        .sidebar-user-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            flex: 1;
            min-width: 0;
            text-decoration: none;
            border-radius: 8px;
            padding: 0.45rem 0.5rem;
            transition: background 0.18s;
        }
        .sidebar-user:hover { background: rgba(255,255,255,0.06); }

        .sidebar-user-avatar {
            width: 32px; height: 32px; border-radius: 8px;
            background: rgba(201,168,76,0.22);
            border: 1.5px solid rgba(201,168,76,0.35);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.65rem; font-weight: 700; color: #C9A84C;
            flex-shrink: 0; font-family: 'DM Sans', sans-serif;
        }

        .sidebar-user-info { min-width: 0; overflow: hidden; }
        .sidebar-user-name {
            font-size: 0.78rem; font-weight: 600;
            color: rgba(255,255,255,0.88);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            font-family: 'DM Sans', sans-serif;
        }
        .sidebar-user-role {
            font-size: 0.62rem; color: rgba(255,255,255,0.38);
            font-family: 'DM Sans', sans-serif; margin-top: 1px;
        }

        .sidebar-logout-form { flex-shrink: 0; }
        .sidebar-logout-btn {
            width: 32px; height: 32px; border-radius: 8px;
            background: transparent; border: 1px solid rgba(255,255,255,0.1);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: background 0.18s, border-color 0.18s;
        }
        .sidebar-logout-btn svg {
            width: 15px; height: 15px;
            color: rgba(255,255,255,0.45); transition: color 0.18s;
        }
        .sidebar-logout-btn:hover { background: rgba(220,38,38,0.12); border-color: rgba(220,38,38,0.35); }
        .sidebar-logout-btn:hover svg { color: #F87171; }

        /* ── Brand name ── */
        .sidebar-logo {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 700; font-size: 1.15rem;
            color: #FFFFFF; text-decoration: none; letter-spacing: -0.01em;
        }
        .sidebar-logo em { font-style: italic; color: #C9A84C; }

        /* ── Active nav item ── */
        .nav-item.active {
            background: rgba(201,168,76,0.12);
            color: var(--gold-light, #E8C97A) !important;
            font-weight: 500;
        }
        .nav-item.active::before {
            content: '';
            position: absolute; left: 0; top: 0; bottom: 0; width: 3px;
            background: #C9A84C; border-radius: 0 2px 2px 0;
        }
        .nav-item.active svg:first-child {
            color: var(--gold-light, #E8C97A) !important;
            opacity: 1 !important;
        }

        /* ── Collapsed state ── */
        .sidebar.collapsed .sidebar-user-info { display: none; }
        .sidebar.collapsed .sidebar-user { flex: unset; justify-content: center; }
        .sidebar.collapsed .sidebar-user-row { justify-content: center; gap: 0.4rem; }
    </style>