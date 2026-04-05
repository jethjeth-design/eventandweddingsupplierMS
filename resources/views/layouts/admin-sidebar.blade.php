<aside class="sidebar" id="sidebar">
            <!-- Header -->
            <div class="sidebar-header">
                <a href="{{ url('/') }}" class="sidebar-logo">Bloom<em>Venue</em></a>
                <button class="sidebar-toggle" id="sidebarToggle" aria-label="Collapse sidebar">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M13 5l-5 5 5 5"/>
                    </svg>
                </button>
            </div>

            <!-- Nav -->
            <nav class="sidebar-nav">

                <div class="nav-group-label">Main</div>

                <a href="{{ route('dashboard') }}"
                   class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M3 10L10 3l7 7M5 8v8h4v-5h2v5h4V8"/>
                    </svg>
                    <span>Dashboard</span>
                    <span class="nav-tooltip">Dashboard</span>
                </a>

                <a href="{{ route('admin.events.index') }}" class="nav-item {{ request()->is('events*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="3" y="4" width="14" height="13" rx="2"/>
                        <path d="M7 2v4M13 2v4M3 9h14"/>
                    </svg>
                    <span>My Events</span>
                    <span class="nav-tooltip">My Events</span>
                    <span class="nav-badge">3</span>
                </a>

                <a href="{{ route('admin.suppliers.index') }}" class="nav-item {{ request()->is('suppliers*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="9" cy="8" r="4"/>
                        <path d="M2 17c0-3.3 3.1-6 7-6M17 14l-3-3-3 3M14 11v6"/>
                    </svg>
                    <span>Suppliers</span>
                    <span class="nav-tooltip">Suppliers</span>
                </a>

                <a href="#" class="nav-item {{ request()->is('bookings*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M9 12l2 2 4-4M7 3H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2h-2"/>
                        <rect x="7" y="1" width="6" height="4" rx="1"/>
                    </svg>
                    <span>Bookings</span>
                    <span class="nav-tooltip">Bookings</span>
                    <span class="nav-badge">5</span>
                </a>

                <a href="#" class="nav-item {{ request()->is('packages*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z" transform="scale(0.85) translate(1.5,1.5)"/>
                        <path d="M16 7V5a4 4 0 00-8 0v2"/>
                    </svg>
                    <span>Packages</span>
                    <span class="nav-tooltip">Packages</span>
                </a>

                <div class="sidebar-divider"></div>
                <div class="nav-group-label">Planning</div>

                <a href="#" class="nav-item {{ request()->is('timeline*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="10" r="8"/>
                        <path d="M10 6v4l3 3"/>
                    </svg>
                    <span>Timeline</span>
                    <span class="nav-tooltip">Timeline</span>
                </a>

                <a href="#" class="nav-item {{ request()->is('budget*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M3 3h14v14H3zM8 3v14M3 8h14"/>
                    </svg>
                    <span>Budget Planner</span>
                    <span class="nav-tooltip">Budget Planner</span>
                </a>

                <a href="#" class="nav-item {{ request()->is('guests*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M4 6h12M4 10h8M4 14h10"/>
                    </svg>
                    <span>Guest List</span>
                    <span class="nav-tooltip">Guest List</span>
                </a>

                <a href="{{ route('admin.themes.list') }}" class="nav-item {{ request()->routeIs('admin.themes.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M3 5h14M3 9h10M3 13h7"/>
                        <circle cx="15" cy="13" r="3"/>
                    </svg>
                    <span>Theme</span>
                    <span class="nav-tooltip">Themes</span>
                </a>

                <a href="{{ route('admin.location.list') }}" class="nav-item {{ request()->routeIs('admin.location.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M3 5h14M3 9h10M3 13h7"/>
                        <circle cx="15" cy="13" r="3"/>
                    </svg>
                    <span>Locations</span>
                    <span class="nav-tooltip">Location</span>
                </a>

                <div class="sidebar-divider"></div>
                <div class="nav-group-label">Account</div>

                <a href="{{ route('admin.profile') ?? '#' }}" class="nav-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="7" r="4"/>
                        <path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    <span>Profile</span>
                    <span class="nav-tooltip">Profile</span>
                </a>

                <a href="#" class="nav-item {{ request()->is('activity-logs*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M4 6h12M4 10h8M4 14h10"/>
                        <circle cx="16" cy="14" r="3.5" fill="none"/>
                        <path d="M16 12.5v1.5l1 1"/>
                    </svg>
                    <span>Activity Logs</span>
                    <span class="nav-tooltip">Activity Logs</span>
                </a>

                {{-- Settings with dropdown --}}
                <div class="nav-item-group {{ request()->is('settings*') ? 'open' : '' }}" id="navGroupSettings">
                    <a href="#" class="nav-item {{ request()->is('settings*') ? 'active' : '' }}"
                       onclick="event.preventDefault(); toggleNavGroup('navGroupSettings')">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="10" cy="10" r="3"/>
                            <path d="M10 1v2M10 17v2M1 10h2M17 10h2M3.2 3.2l1.4 1.4M15.4 15.4l1.4 1.4M3.2 16.8l1.4-1.4M15.4 4.6l1.4-1.4"/>
                        </svg>
                        <span>Settings</span>
                        <svg class="nav-arrow" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 4l4 4-4 4"/>
                        </svg>
                        <span class="nav-tooltip">Settings</span>
                    </a>
                    <div class="nav-submenu">
                        <a href="#" class="nav-subitem {{ request()->is('settings/general*') ? 'active' : '' }}">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6">
                                <circle cx="8" cy="8" r="2"/>
                                <path d="M8 1v2M8 13v2M1 8h2M13 8h2M2.9 2.9l1.4 1.4M11.7 11.7l1.4 1.4M2.9 13.1l1.4-1.4M11.7 4.3l1.4-1.4"/>
                            </svg>
                            General
                        </a>
                        <a href="{{ route('admin.user') }}" class="nav-subitem {{ request()->is('settings/roles*') ? 'active' : '' }}">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6">
                                <circle cx="5" cy="5" r="2"/>
                                <circle cx="11" cy="5" r="2"/>
                                <path d="M1 13c0-2.2 1.8-4 4-4M8 13c0-2.2 1.8-4 4-4"/>
                            </svg>
                            User Roles
                        </a>
                        <a href="#" class="nav-subitem {{ request()->is('settings/payments*') ? 'active' : '' }}">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6">
                                <rect x="1" y="4" width="14" height="9" rx="2"/>
                                <path d="M1 7h14M4 11h3"/>
                            </svg>
                            Payments
                        </a>
                        <a href="{{ route('admin.homepage.banners') }}" class="nav-subitem {{ request()->is('settings/admin.*') ? 'active' : '' }}">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6">
                                <path d="M8 2a4 4 0 014 4v2.5l1.5 2H2.5L4 8.5V6a4 4 0 014-4zM6.5 12.5a1.5 1.5 0 003 0"/>
                            </svg>
                            Homepage Banners
                        </a>
                        <!--<a href="#" class="nav-subitem {{ request()->is('settings/appearance*') ? 'active' : '' }}">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6">
                                <path d="M2 14c3-6 9-6 12 0"/>
                                <path d="M8 4a2 2 0 100 4 2 2 0 000-4z"/>
                            </svg>
                            Appearance
                        </a>-->
                        <a href="{{route('admin.categories.list')}}" class="nav-subitem {{ request()->is('admin.categories.list*') ? 'active' : '' }}">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M3 5h14M3 9h10M3 13h7"/>
                                <circle cx="15" cy="13" r="3"/>
                            </svg>
                           Supplier Categories
                        </a>

                        <a href="{{route('admin.event.list')}}" class="nav-subitem {{ request()->is('admin.event.list*') ? 'active' : '' }}">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M3 5h14M3 9h10M3 13h7"/>
                                <circle cx="15" cy="13" r="3"/>
                            </svg>
                           Event Categories
                        </a>

                        <a href="{{route('admin.venue.list')}}" class="nav-subitem {{ request()->is('admin.venue.list*') ? 'active' : '' }}">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M3 5h14M3 9h10M3 13h7"/>
                                <circle cx="15" cy="13" r="3"/>
                            </svg>
                           Venue's
                        </a>

                        
                    </div>
                </div>

            </nav>

            <!-- Footer: current user + logout -->
            <div class="sidebar-footer">
                <a href="{{ route('admin.profile') ?? '#' }}" class="sidebar-user">
                    <div class="sidebar-user-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                    </div>
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-name">{{ Auth::user()->name ?? 'Guest User' }}</div>
                        <div class="sidebar-user-role">Event Planner</div>
                    </div>
                    <svg style="width:14px;height:14px;flex-shrink:0;color:rgba(255,255,255,0.25);margin-left:auto;" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M6 4l4 4-4 4"/>
                    </svg>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-logout">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M13 5l4 5-4 5M17 10H8M10 3H5a2 2 0 00-2 2v10a2 2 0 002 2h5"/>
                        </svg>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </aside>