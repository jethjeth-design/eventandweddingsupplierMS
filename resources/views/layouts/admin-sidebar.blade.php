<aside class="sidebar" id="sidebar">
    <!-- Header -->
    <div class="sidebar-header">
        <a href="{{ url('/') }}" class="sidebar-logo">Bikol's<em>Craft</em></a>
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Collapse sidebar">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 18l-6-6 6-6"/>
            </svg>
        </button>
    </div>

    <!-- Nav -->
    <nav class="sidebar-nav">

        <div class="nav-group-label">Main</div>

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7" rx="1"/>
                <rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/>
                <rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg>
            <span>Dashboard</span>
            <span class="nav-tooltip">Dashboard</span>
        </a>

        {{-- My Events --}}
        <a href="{{ route('admin.events.index') }}"
           class="nav-item {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z"/>
            </svg>
            <span>My Events</span>
            <span class="nav-tooltip">My Events</span>
            <span class="nav-badge">3</span>
        </a>

        {{-- Suppliers --}}
        <a href="{{ route('admin.suppliers.index') }}"
           class="nav-item {{ request()->routeIs('admin.suppliers.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 3h15v13H1zM16 8h4l3 3v5h-7V8z"/>
                <circle cx="5.5" cy="18.5" r="2.5"/>
                <circle cx="18.5" cy="18.5" r="2.5"/>
            </svg>
            <span>Suppliers</span>
            <span class="nav-tooltip">Suppliers</span>
        </a>

        {{-- Bookings --}}
        <a href="{{ route('admin.bookings') }}"
           class="nav-item {{ request()->routeIs('admin.bookings') || request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                <rect x="9" y="3" width="6" height="4" rx="1"/>
                <path d="M9 12l2 2 4-4"/>
            </svg>
            <span>Bookings</span>
            <span class="nav-tooltip">Bookings</span>
            <span class="nav-badge">5</span>
        </a>

        {{-- Packages --}}
        <a href="{{ route('admin.package.list') }}"
           class="nav-item {{ request()->routeIs('admin.package.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                <line x1="12" y1="22.08" x2="12" y2="12"/>
            </svg>
            <span>Packages</span>
            <span class="nav-tooltip">Packages</span>
        </a>

        <a href="{{ route('admin.popular.index') }}"
           class="nav-item {{ request()->routeIs('admin.popular.index*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <!-- Box -->
                <path d="M21 8l-9-5-9 5 9 5 9-5z"/>
                <path d="M3 8v8l9 5 9-5V8"/>
                <path d="M12 13v8"/>

                <!-- Star (popular badge) -->
                <path d="M12 6l.9 1.9 2.1.3-1.5 1.4.4 2.1-1.9-1-1.9 1 .4-2.1-1.5-1.4 2.1-.3L12 6z"/>
            </svg>
            <span>Popular Packages</span>
            <span class="nav-tooltip">Popular Packages</span>
        </a>

        <a href="{{ route('featured-suppliers') }}"
           class="nav-item {{ request()->routeIs('featured-suppliers*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 17.3l-5.4 3 1.1-6.1L3 9.8l6.2-.9L12 3.5l2.8 5.4 6.2.9-4.7 4.4 1.1 6.1z"/>
            </svg>
            <span>Feature Suppliers</span>
            <span class="nav-tooltip">Featured Suppliers</span>
        </a>

        <div class="sidebar-divider"></div>
        <div class="nav-group-label">Planning</div>

        {{-- Calendar --}}
        <a href="{{ route('admin.calendar.index') }}"
           class="nav-item {{ request()->routeIs('admin.calendar.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <path d="M16 2v4M8 2v4M3 10h18"/>
                <path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01"/>
            </svg>
            <span>Calendar</span>
            <span class="nav-tooltip">Calendar</span>
        </a>

        <a href="{{ route('admin.popular.tracking') }}"
           class="nav-item {{ request()->routeIs('dmin.popular.tracking') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <path d="M16 2v4M8 2v4M3 10h18"/>
                <path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01"/>
            </svg>
            <span>Calendar</span>
            <span class="nav-tooltip">Calendar</span>
        </a>

        {{-- Timeline --}}
        <a href="{{ route('admin.timeline') }}"
           class="nav-item {{ request()->routeIs('admin.timeline') || request()->routeIs('admin.timeline.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <line x1="4" y1="6" x2="14" y2="6"/>
                <line x1="4" y1="10" x2="20" y2="10"/>
                <line x1="4" y1="14" x2="11" y2="14"/>
                <line x1="4" y1="18" x2="17" y2="18"/>
                <circle cx="16" cy="6" r="2"/>
                <circle cx="22" cy="10" r="2"/>
                <circle cx="13" cy="14" r="2"/>
                <circle cx="19" cy="18" r="2"/>
            </svg>
            <span>Timeline</span>
            <span class="nav-tooltip">Timeline</span>
        </a>

        {{-- Budget Planner
        <a href="#"
           class="nav-item {{ request()->routeIs('admin.budget') || request()->routeIs('admin.budget.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 12V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2v-5z"/>
                <path d="M16 12h3v4h-3a2 2 0 010-4z"/>
            </svg>
            <span>Budget Planner</span>
            <span class="nav-tooltip">Budget Planner</span>
        </a> --}}

        {{-- Guest List 
        <a href="#"
           class="nav-item {{ request()->routeIs('admin.guests') || request()->routeIs('admin.guests.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
            </svg>
            <span>Guest List</span>
            <span class="nav-tooltip">Guest List</span>
        </a>--}}

        <div class="sidebar-divider"></div>
        <div class="nav-group-label">Account</div>

        {{-- Profile --}}
        <a href="{{ route('admin.profile') ?? '#' }}"
           class="nav-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
            <span>Profile</span>
            <span class="nav-tooltip">Profile</span>
        </a>

        {{-- Activity Logs --}}
        <a href="{{ route('admin.logs.index') }}"
           class="nav-item {{ request()->routeIs('admin.logs.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
            </svg>
            <span>Activity Logs</span>
            <span class="nav-tooltip">Activity Logs</span>
        </a>

        {{-- Settings with dropdown --}}
        @php
            $settingsActive = request()->routeIs('admin.user')
                || request()->routeIs('admin.homepage.*')
                || request()->routeIs('admin.categories.*')
                || request()->routeIs('admin.event.list')
                || request()->routeIs('admin.venue.*')
                || request()->routeIs('admin.themes.*')
                || request()->routeIs('admin.location.*')
                || request()->is('settings*');
        @endphp

        <div class="nav-item-group {{ $settingsActive ? 'open' : '' }}" id="navGroupSettings">
            <a href="#"
               class="nav-item {{ $settingsActive ? 'active' : '' }}"
               onclick="event.preventDefault(); toggleNavGroup('navGroupSettings')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="4" y1="6" x2="20" y2="6"/>
                    <line x1="4" y1="12" x2="20" y2="12"/>
                    <line x1="4" y1="18" x2="20" y2="18"/>
                    <circle cx="8" cy="6" r="2" fill="currentColor" stroke="none"/>
                    <circle cx="16" cy="12" r="2" fill="currentColor" stroke="none"/>
                    <circle cx="10" cy="18" r="2" fill="currentColor" stroke="none"/>
                </svg>
                <span>Settings</span>
                <svg class="nav-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18l6-6-6-6"/>
                </svg>
                <span class="nav-tooltip">Settings</span>
            </a>
            <div class="nav-submenu">

                {{--<a href="#"
                   class="nav-subitem {{ request()->is('settings/general*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
                    </svg>
                    General
                </a>--}}

                <a href="{{ route('admin.user') }}"
                   class="nav-subitem {{ request()->routeIs('admin.user') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                    User Roles
                </a>

                {{--<a href="#"
                   class="nav-subitem {{ request()->is('settings/payments*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="4" width="22" height="16" rx="2"/>
                        <line x1="1" y1="10" x2="23" y2="10"/>
                    </svg>
                    Payments
                </a>--}}

                <a href="{{ route('admin.homepage.banners') }}"
                   class="nav-subitem {{ request()->routeIs('admin.homepage.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="14" rx="2"/>
                        <path d="M8 21h8M12 17v4"/>
                    </svg>
                    Homepage Banners
                </a>

                <a href="{{ route('admin.categories.list') }}"
                   class="nav-subitem {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16M4 10h10M4 14h7"/>
                        <circle cx="19" cy="14" r="3"/>
                    </svg>
                    Supplier Categories
                </a>

                <a href="{{ route('subcategories.list') }}"
                   class="nav-subitem {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16M4 10h10M4 14h7"/>
                        <circle cx="19" cy="14" r="3"/>
                    </svg>
                    Supplier Categories
                </a>

                <a href="{{ route('admin.event.list') }}"
                   class="nav-subitem {{ request()->routeIs('admin.event.list') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <path d="M16 2v4M8 2v4M3 10h18"/>
                        <path d="M8 14h.01M12 14h.01M16 14h.01"/>
                    </svg>
                    Event Categories
                </a>

                <a href="{{ route('admin.venue.list') }}"
                   class="nav-subitem {{ request()->routeIs('admin.venue.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Venue's
                </a>

                <a href="{{ route('admin.themes.list') }}"
                   class="nav-subitem {{ request()->routeIs('admin.themes.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 8c-2.2 0-4 1.8-4 4s1.8 4 4 4 4-1.8 4-4"/>
                        <path d="M12 2v2M12 20v2M2 12h2M20 12h2"/>
                    </svg>
                    Themes
                </a>

                <a href="{{ route('admin.location.list') }}"
                   class="nav-subitem {{ request()->routeIs('admin.location.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                    Locations
                </a>

            </div>
        </div>

    </nav>

    <!-- Footer: avatar + name/role + logout icon side by side -->
    <div class="sidebar-footer">
        <div class="sidebar-user-row">
            <a href="{{ route('admin.profile') ?? '#' }}" class="sidebar-user">
                <div class="sidebar-user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                </div>
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name">{{ Auth::user()->name ?? 'Guest User' }}</div>
                    <div class="sidebar-user-role">Event Planner</div>
                </div>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="sidebar-logout-form">
                @csrf
                <button type="submit" class="sidebar-logout-btn" title="Sign Out">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>

<style>
    /* ── Footer layout ── */
    .sidebar-footer {
        padding: 0.75rem 0.85rem;
        border-top: 1px solid rgba(201,168,76,0.12);
        flex-shrink: 0;
    }

    .sidebar-user-row {
        display: flex;
        align-items: center;
        gap: 0.4rem;
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
        overflow: hidden;
    }
    .sidebar-user:hover { background: rgba(255,255,255,0.05); }

    .sidebar-user-avatar {
        width: 32px; height: 32px;
        border-radius: 8px;
        background: rgba(201,168,76,0.18);
        border: 1.5px solid rgba(201,168,76,0.3);
        display: flex; align-items: center; justify-content: center;
        font-size: 0.65rem; font-weight: 700;
        color: #C9A84C; flex-shrink: 0;
        font-family: 'DM Sans', sans-serif;
    }

    .sidebar-user-info {
        min-width: 0; flex: 1; overflow: hidden;
        transition: opacity 0.2s, max-width 0.3s;
        max-width: 160px;
    }
    .sidebar-user-name {
        font-size: 0.78rem; font-weight: 600;
        color: rgba(255,255,255,0.88);
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        font-family: 'DM Sans', sans-serif;
    }
    .sidebar-user-role {
        font-size: 0.62rem;
        color: #E8C97A;
        font-family: 'DM Sans', sans-serif;
        margin-top: 1px;
    }

    /* Logout button */
    .sidebar-logout-form { flex-shrink: 0; }
    .sidebar-logout-btn {
        width: 32px; height: 32px;
        border-radius: 8px;
        background: transparent;
        border: 1px solid rgba(255,255,255,0.08);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        transition: background 0.18s, border-color 0.18s;
    }
    .sidebar-logout-btn svg {
        width: 15px; height: 15px;
        color: rgba(255,255,255,0.35);
        transition: color 0.18s;
    }
    .sidebar-logout-btn:hover {
        background: rgba(220,38,38,0.12);
        border-color: rgba(220,38,38,0.3);
    }
    .sidebar-logout-btn:hover svg { color: #F87171; }

    /* Collapsed sidebar footer */
    .sidebar.collapsed .sidebar-user-info { opacity: 0; max-width: 0; overflow: hidden; }
    .sidebar.collapsed .sidebar-user { flex: unset; justify-content: center; padding: 0.45rem; }
    .sidebar.collapsed .sidebar-user-row { justify-content: center; flex-direction: column; gap: 0.35rem; }
    .sidebar.collapsed .sidebar-logout-form { display: none; }

    /* ── Settings submenu ── */
    .nav-item-group { position: relative; }

    .nav-arrow {
        margin-left: auto;
        width: 14px; height: 14px;
        color: rgba(255,255,255,0.28);
        flex-shrink: 0;
        transition: transform 0.25s ease, opacity 0.2s;
    }
    .sidebar.collapsed .nav-arrow { opacity: 0; width: 0; overflow: hidden; }
    .nav-item-group.open > .nav-item .nav-arrow { transform: rotate(90deg); }
    .nav-item-group.open > .nav-item {
        color: rgba(255,255,255,0.85);
        background: rgba(201,168,76,0.08);
    }

    .nav-submenu {
        display: none;
        flex-direction: column;
        margin: 0 0.6rem 0.25rem 2.6rem;
        border-left: 2px solid rgba(201,168,76,0.18);
    }
    .nav-item-group.open .nav-submenu { display: flex; }
    .sidebar.collapsed .nav-submenu { display: none !important; }

    .nav-subitem {
        display: flex; align-items: center; gap: 0.6rem;
        padding: 0.46rem 0.85rem;
        font-size: 0.79rem; font-weight: 400;
        color: rgba(255,255,255,0.38);
        text-decoration: none; border-radius: 4px;
        transition: background 0.15s, color 0.15s;
        white-space: nowrap;
        font-family: 'DM Sans', sans-serif;
    }
    .nav-subitem svg { width: 13px; height: 13px; flex-shrink: 0; color: rgba(255,255,255,0.2); transition: color 0.15s; }
    .nav-subitem:hover { background: rgba(201,168,76,0.08); color: rgba(255,255,255,0.85); }
    .nav-subitem:hover svg { color: #E8C97A; }
    .nav-subitem.active { color: #E8C97A; font-weight: 500; }
    .nav-subitem.active svg { color: #E8C97A; }
</style>

<script>
    function toggleNavGroup(id) {
        document.getElementById(id).classList.toggle('open');
    }
</script>