    @php

        $adminBookingCount = \App\Models\Booking::where('status', 'pending')
            ->count();
        
        $eventCount = \App\Models\Event::where('status', '!=', 'cancelled')
        ->count();
    @endphp
    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header">
            <a href="{{ url('/') }}" class="sidebar-logo">WES<em>TEAM</em></a>
            <button class="sidebar-toggle" id="sidebarToggle" aria-label="Collapse sidebar">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <path d="M15 18l-6-6 6-6"/>
                </svg>
            </button>
        </div>

        <nav class="sidebar-nav">

            <div class="nav-group-label">Main</div>

            <a href="{{ route('admin.dashboard') }}"
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>
                <span>Dashboard</span>
                <span class="nav-tooltip">Dashboard</span>
            </a>

            <a href="{{ route('admin.events.index') }}"
               class="nav-item {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <rect x="3" y="4" width="14" height="13" rx="2" />
                    <path d="M7 2v4M13 2v4M3 9h14" />
                </svg>
                <span>Events List</span>
                <span class="nav-tooltip">Events List</span>
                {{-- EVENT COUNT BADGE --}}
                @if($eventCount > 0)

                    <span class="nav-badge">

                        {{ $eventCount > 99 ? '99+' : $eventCount }}

                    </span>

                @endif
            </a>

            <a href="{{ route('admin.suppliers.index') }}"
               class="nav-item {{ request()->routeIs('admin.suppliers.*') ? 'active' : '' }}">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="10" cy="7" r="4" />
                    <path d="M2 17c0-4 3.6-7 8-7s8 3 8 7" />
                </svg>
                <span>Suppliers</span>
                <span class="nav-tooltip">Suppliers</span>
            </a>

            <a href="{{ route('admin.bookings') }}"
               class="nav-item {{ request()->routeIs('admin.bookings') || request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                    <rect x="9" y="3" width="6" height="4" rx="1"/>
                    <path d="M9 12l2 2 4-4"/>
                </svg>
                <span>Bookings</span>
                <span class="nav-tooltip">Bookings</span>
                {{-- BADGE --}}
                @if($adminBookingCount > 0)

                    <span class="nav-badge">

                        {{ $adminBookingCount > 99 ? '99+' : $adminBookingCount }}

                    </span>

                @endif
            </a>

            <a href="{{ route('admin.package.list') }}"
               class="nav-item {{ request()->routeIs('admin.package.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                    <line x1="12" y1="22.08" x2="12" y2="12"/>
                </svg>
                <span>Packages</span>
                <span class="nav-tooltip">Packages</span>
            </a>

            {{--<a href="{{ route('admin.popular.index') }}"
               class="nav-item {{ request()->routeIs('admin.popular.index*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <path d="M12 2l2.4 4.9L18 7.6l-4 3.9.9 5.5L10 14.4l-5 2.6.9-5.5L2 7.6l5.6-.7z"/>
                </svg>
                <span>Popular Packages</span>
                <span class="nav-tooltip">Popular Packages</span>
            </a>--}}

            <a href="{{ route('featured-suppliers') }}"
               class="nav-item {{ request()->routeIs('featured-suppliers*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <path d="M12 17.3l-5.4 3 1.1-6.1L3 9.8l6.2-.9L12 3.5l2.8 5.4 6.2.9-4.7 4.4 1.1 6.1z"/>
                </svg>
                <span>Feature Suppliers</span>
                <span class="nav-tooltip">Featured Suppliers</span>
            </a>

            <div class="sidebar-divider"></div>
            <div class="nav-group-label">Planning</div>

            <a href="{{ route('admin.calendar.index') }}"
               class="nav-item {{ request()->routeIs('admin.calendar.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <path d="M16 2v4M8 2v4M3 10h18"/>
                    <path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01"/>
                </svg>
                <span>Calendar</span>
                <span class="nav-tooltip">Calendar</span>
            </a>

            {{--<a href="{{ route('admin.popular.tracking') }}"
               class="nav-item {{ request()->routeIs('admin.popular.tracking') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                </svg>
                <span>Tracking</span>
                <span class="nav-tooltip">Tracking</span>
            </a>--}}

            <a href="{{ route('admin.timeline') }}"
               class="nav-item {{ request()->routeIs('admin.timeline') || request()->routeIs('admin.timeline.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
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

            <div class="sidebar-divider"></div>
            <div class="nav-group-label">Account</div>

            <a href="{{ route('admin.profile') ?? '#' }}"
               class="nav-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                <span>Profile</span>
                <span class="nav-tooltip">Profile</span>
            </a>

            <a href="{{ route('admin.logs.index') }}"
               class="nav-item {{ request()->routeIs('admin.logs.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                </svg>
                <span>Activity Logs</span>
                <span class="nav-tooltip">Activity Logs</span>
            </a>

            {{-- SETTINGS GROUP --}}
            @php
                $settingsActive =
                    request()->routeIs('admin.user') ||
                    request()->routeIs('admin.homepage.*') ||
                    request()->routeIs('admin.categories.*') ||
                    request()->routeIs('categories.*') ||
                    request()->routeIs('admin.event.list') ||
                    request()->routeIs('admin.venue.*') ||
                    request()->routeIs('admin.themes.*') ||
                    request()->routeIs('admin.location.*') ||
                    request()->is('settings*');
            @endphp

            <div class="nav-item-group {{ $settingsActive ? 'open' : '' }}" id="navGroupSettings">
                <a href="#"
                   class="nav-item {{ $settingsActive ? 'active' : '' }}"
                   onclick="event.preventDefault(); toggleNavGroup('navGroupSettings')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"/>
                    </svg>
                    <span>Settings</span>
                    <svg class="nav-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <path d="M9 18l6-6-6-6"/>
                    </svg>
                    <span class="nav-tooltip">Settings</span>
                </a>

                <div class="nav-submenu">

                    <a href="{{ route('admin.user') }}"
                       class="nav-subitem {{ request()->routeIs('admin.user') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                        User Roles
                    </a>

                    <a href="{{ route('admin.homepage.banners') }}"
                       class="nav-subitem {{ request()->routeIs('admin.homepage.*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><rect x="3" y="3" width="18" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                        Homepage Banners
                    </a>

                    <a href="{{ route('admin.categories.list') }}"
                       class="nav-subitem {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><path d="M4 6h16M4 10h10M4 14h7"/><circle cx="19" cy="14" r="3"/></svg>
                        Supplier Categories
                    </a>

                    <a href="{{ route('subcategories.list') }}"
                       class="nav-subitem {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><path d="M4 6h16M4 10h8M4 14h5"/><circle cx="17" cy="14" r="3"/></svg>
                        Sub-Categories
                    </a>

                    <a href="{{ route('admin.event.list') }}"
                       class="nav-subitem {{ request()->routeIs('admin.event.list') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/><path d="M8 14h.01M12 14h.01M16 14h.01"/></svg>
                        Event Categories
                    </a>

                    <a href="{{ route('admin.venue.list') }}"
                       class="nav-subitem {{ request()->routeIs('admin.venue.*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        Venues
                    </a>

                    <a href="{{ route('admin.themes.list') }}"
                       class="nav-subitem {{ request()->routeIs('admin.themes.*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M12 8c-2.2 0-4 1.8-4 4s1.8 4 4 4 4-1.8 4-4"/></svg>
                        Themes
                    </a>

                    <a href="{{ route('admin.location.list') }}"
                       class="nav-subitem {{ request()->routeIs('admin.location.*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        Locations
                    </a>

                </div>
            </div>

        </nav>

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
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                            <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

    </aside>