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
 
                <div class="nav-group-label">Overview</div>
 
                <a href="{{ url('/client/dashboard') }}"
                   class="nav-item {{ request()->is('client/dashboard') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M3 10L10 3l7 7M5 8v8h4v-5h2v5h4V8"/>
                    </svg>
                    <span>Dashboard</span>
                    <span class="nav-tooltip">Dashboard</span>
                </a>
 
                <a href="{{ route('client.events') }}" class="nav-item {{ request()->is('client/events*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="3" y="4" width="14" height="13" rx="2"/>
                        <path d="M7 2v4M13 2v4M3 9h14"/>
                    </svg>
                    <span>My Events</span>
                    <span class="nav-tooltip">My Events</span>
                    <span class="nav-badge">2</span>
                </a>
 
                <a href="{{ route('client.bookings.index') }}" class="nav-item {{ request()->is('client/bookings*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M9 12l2 2 4-4M7 3H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2h-2"/>
                        <rect x="7" y="1" width="6" height="4" rx="1"/>
                    </svg>
                    <span>My Bookings</span>
                    <span class="nav-tooltip">My Bookings</span>
                    <span class="nav-badge">5</span>
                </a>
 
                <a href="{{ route('client.inbox') }}" class="nav-item {{ request()->is('client/messages*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/>
                    </svg>
                    <span>Messages</span>
                    <span class="nav-tooltip">Messages</span>
                    <span class="nav-badge">3</span>
                </a>
 
                <div class="sidebar-divider"></div>
                <div class="nav-group-label">Planning</div>
 
                <a href="{{route('client.suppliers')}}" class="nav-item {{ request()->is('client/suppliers*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="9" cy="8" r="4"/>
                        <path d="M2 17c0-3.3 3.1-6 7-6M17 14l-3-3-3 3M14 11v6"/>
                    </svg>
                    <span>Browse Suppliers</span>
                    <span class="nav-tooltip">Browse Suppliers</span>
                </a>

                <a href="#" class="nav-item {{ request()->is('client/shows*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="9" cy="8" r="4"/>
                        <path d="M2 17c0-3.3 3.1-6 7-6M17 14l-3-3-3 3M14 11v6"/>
                    </svg>
                    <span>AI Recommendations</span>
                    <span class="nav-tooltip">AI Recommendations</span>
                </a>
 
                <a href="#" class="nav-item {{ request()->is('client/shortlist*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M10 3.5l1.8 3.6 4 .6-2.9 2.8.7 4L10 12.5l-3.6 1.9.7-4L4.2 7.7l4-.6z"/>
                    </svg>
                    <span>Shortlist</span>
                    <span class="nav-tooltip">Shortlist</span>
                </a>
 
                <a href="#" class="nav-item {{ request()->is('client/budget*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="2" y="5" width="16" height="11" rx="2"/>
                        <path d="M2 9h16"/>
                        <circle cx="10" cy="13" r="1.5"/>
                    </svg>
                    <span>Budget Tracker</span>
                    <span class="nav-tooltip">Budget Tracker</span>
                </a>
 
                <a href="{{ route('client.timeline') }}" class="nav-item {{ request()->is('client/timeline*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="10" r="8"/>
                        <path d="M10 6v4l3 3"/>
                    </svg>
                    <span>Timeline</span>
                    <span class="nav-tooltip">Timeline</span>
                </a>
 
                <a href="#" class="nav-item {{ request()->is('client/guests*') ? 'active' : '' }}">
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
 
                <a href="#" class="nav-item {{ request()->is('client/payments*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="2" y="5" width="16" height="11" rx="2"/>
                        <path d="M2 9h16M6 13h3"/>
                    </svg>
                    <span>Payments</span>
                    <span class="nav-tooltip">Payments</span>
                </a>
 
                <a href="#" class="nav-item {{ request()->is('client/invoices*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="4" y="2" width="12" height="16" rx="2"/>
                        <path d="M7 7h6M7 10h6M7 13h4"/>
                    </svg>
                    <span>Invoices</span>
                    <span class="nav-tooltip">Invoices</span>
                </a>
 
                <div class="sidebar-divider"></div>
                <div class="nav-group-label">Account</div>
 
                <a href="{{ route('client.profile') ?? '#' }}" class="nav-item {{ request()->is('client/profile*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="7" r="4"/>
                        <path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    <span>My Profile</span>
                    <span class="nav-tooltip">My Profile</span>
                </a>
 
                <a href="#" class="nav-item {{ request()->is('client/settings*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="10" r="3"/>
                        <path d="M10 1v2M10 17v2M1 10h2M17 10h2M3.2 3.2l1.4 1.4M15.4 15.4l1.4 1.4M3.2 16.8l1.4-1.4M15.4 4.6l1.4-1.4"/>
                    </svg>
                    <span>Settings</span>
                    <span class="nav-tooltip">Settings</span>
                </a>
 
            </nav>
 
            <!-- Footer: current user + logout -->
            <div class="sidebar-footer">
                <a href="{{ route('client.profile') ?? '#' }}" class="sidebar-user">
                    <div class="sidebar-user-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                    </div>
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-name">{{ Auth::user()->name ?? 'Guest User' }}</div>
                        <div class="sidebar-user-role">Event Client</div>
                    </div>
                </a>
                <!-- Logout form
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-logout">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M13 5l4 5-4 5M17 10H8M10 3H5a2 2 0 00-2 2v10a2 2 0 002 2h5"/>
                        </svg>
                        <span>Sign Out</span>
                    </button>
                </form>-->
            </div>
        </aside>