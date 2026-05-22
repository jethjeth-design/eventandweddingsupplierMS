<aside class="sidebar" id="sidebar">

    {{-- Header --}}
    <div class="sidebar-header">
        <a href="{{ url('/') }}" class="sidebar-logo">Bikol's<em>Craft</em></a>
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Collapse sidebar">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M13 5l-5 5 5 5"/>
            </svg>
        </button>
    </div>

    {{-- Nav --}}
    <nav class="sidebar-nav">

        <div class="nav-group-label">Overview</div>

        <a href="{{ route('supplier.dashboard') }}"
           class="nav-item {{ $navActive['dashboard'] ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M3 10L10 3l7 7M5 8v8h4v-5h2v5h4V8"/>
            </svg>
            <span class="nav-label">Dashboard</span>
            <span class="nav-tooltip">Dashboard</span>
        </a>

        <a href="{{ route('supplier.package.mylistings') }}"
           class="nav-item {{ $navActive['listings'] ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <rect x="3" y="3" width="6" height="6" rx="1"/>
                <rect x="11" y="3" width="6" height="6" rx="1"/>
                <rect x="3" y="11" width="6" height="6" rx="1"/>
                <rect x="11" y="11" width="6" height="6" rx="1"/>
            </svg>
            <span class="nav-label">My Listings</span>
            <span class="nav-tooltip">My Listings</span>
        </a>

        <a href="{{ route('supplier.inquiries.inbox') }}"
           class="nav-item {{ $navActive['inquiries'] ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/>
            </svg>
            <span class="nav-label">Inquiries</span>
            <span class="nav-tooltip">Inquiries</span>
        </a>

        <a href="{{ route('supplier.bookings') }}"
           class="nav-item {{ $navActive['bookings'] ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M9 12l2 2 4-4M7 3H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2h-2"/>
                <rect x="7" y="1" width="6" height="4" rx="1"/>
            </svg>
            <span class="nav-label">Bookings</span>
            <span class="nav-tooltip">Bookings</span>
        </a>

        <div class="sidebar-divider"></div>
        <div class="nav-group-label">Business</div>

        <a href="{{ route('supplier.package.index') }}"
           class="nav-item {{ $navActive['packages'] ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M16 7H4a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2z"/>
                <path d="M13 7V5a3 3 0 00-6 0v2"/>
            </svg>
            <span class="nav-label">Packages &amp; Pricing</span>
            <span class="nav-tooltip">Packages</span>
        </a>

        <a href="{{ route('collaborations.index') }}"
           class="nav-item {{ $navActive['collaborations'] ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="7" cy="7" r="3"/>
                <circle cx="14" cy="7" r="3"/>
                <path d="M1 16c0-2.8 2.7-5 6-5"/>
                <path d="M9 16c0-2.8 2.2-5 5-5 3 0 5 2 5 5"/>
            </svg>
            <span class="nav-label">Collaborations</span>
            <span class="nav-tooltip">Collaborations</span>
        </a>

        <a href="{{ route('supplier.availability.index') }}"
           class="nav-item {{ $navActive['availability'] ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <rect x="3" y="4" width="14" height="13" rx="2"/>
                <path d="M7 2v4M13 2v4M3 9h14M7 13h2M11 13h2"/>
            </svg>
            <span class="nav-label">Availability</span>
            <span class="nav-tooltip">Availability</span>
        </a>

        <a href="{{ route('supplier.team-members.index') }}"
           class="nav-item {{ $navActive['team'] ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="6" cy="7" r="3"/>
                <circle cx="14" cy="7" r="3"/>
                <path d="M2 15c0-2.2 1.8-4 4-4M8 15c0-2.2 1.8-4 4-4"/>
            </svg>
            <span class="nav-label">Team</span>
            <span class="nav-tooltip">Team</span>
        </a>

        <a href="{{ route('supplier.portfolio.gallery') }}"
           class="nav-item {{ $navActive['gallery'] ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <rect x="2" y="4" width="16" height="12" rx="2"/>
                <circle cx="7" cy="9" r="1.5"/>
                <path d="M2 14l4-4 3 3 3-3 6 5"/>
            </svg>
            <span class="nav-label">Gallery</span>
            <span class="nav-tooltip">Gallery</span>
        </a>

        <a href="{{ route('supplier.ratings.index') }}"
           class="nav-item {{ $navActive['reviews'] ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M10 2l1.8 3.6 4 .6-2.9 2.8.7 4-3.6-1.9L6.4 13l.7-4L4.2 6.2l4-.6z"/>
            </svg>
            <span class="nav-label">Reviews</span>
            <span class="nav-tooltip">Reviews</span>
        </a>

        <div class="sidebar-divider"></div>
        <div class="nav-group-label">Finance</div>

        <a href="#"
           class="nav-item {{ $navActive['earnings'] ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <line x1="10" y1="2" x2="10" y2="18"/>
                <path d="M14 6H7.5a2.5 2.5 0 000 5h5a2.5 2.5 0 010 5H6"/>
            </svg>
            <span class="nav-label">Earnings</span>
            <span class="nav-tooltip">Earnings</span>
        </a>

        <a href="#"
           class="nav-item {{ $navActive['payouts'] ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <rect x="2" y="5" width="16" height="11" rx="2"/>
                <path d="M2 9h16M6 13h3"/>
                <path d="M15 13l2 2 2-2M17 15V11"/>
            </svg>
            <span class="nav-label">Payouts</span>
            <span class="nav-tooltip">Payouts</span>
        </a>

        <div class="sidebar-divider"></div>
        <div class="nav-group-label">Account</div>

        <a href="{{ route('supplier.supplierprofile') ?? '#' }}"
           class="nav-item {{ $navActive['profile'] ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="10" cy="7" r="4"/>
                <path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/>
            </svg>
            <span class="nav-label">Business Profile</span>
            <span class="nav-tooltip">Profile</span>
        </a>

        {{-- Settings with collapsible drawer --}}
        <div class="nav-item nav-item--has-dropdown {{ $settingsParentActive ? 'active' : '' }} {{ $settingsDrawerOpen ? 'drawer-open' : '' }}"
             id="settingsToggle"
             onclick="toggleSettings()">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="10" cy="10" r="3"/>
                <path d="M10 1v2M10 17v2M1 10h2M17 10h2M3.2 3.2l1.4 1.4M15.4 15.4l1.4 1.4M3.2 16.8l1.4-1.4M15.4 4.6l1.4-1.4"/>
            </svg>
            <span class="nav-label">Settings</span>
            <span class="nav-tooltip">Settings</span>
            <svg class="settings-chevron" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.2">
                <path d="M4 6l4 4 4-4"/>
            </svg>
        </div>

        <div class="settings-drawer {{ $settingsDrawerOpen ? 'open' : '' }}" id="settingsDrawer">

            <a href="{{ route('client.profile') ?? '#' }}"
               class="settings-drawer-item {{ $navActive['account'] ? 'active' : '' }}">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="8" cy="5.5" r="3"/>
                    <path d="M2 14c0-3 2.7-5 6-5s6 2 6 5"/>
                </svg>
                Account
            </a>

            <a href="{{ route('roles.index') ?? '#' }}"
               class="settings-drawer-item {{ $navActive['roles'] ? 'active' : '' }}">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="5" cy="5" r="2.5"/>
                    <circle cx="11" cy="5" r="2.5"/>
                    <path d="M1 13c0-2.2 1.8-4 4-4M8 13c0-2.2 1.8-4 4-4"/>
                </svg>
                Roles
            </a>

        </div>

    </nav>

    {{-- Footer --}}
    <div class="sidebar-footer">
        <div class="sidebar-user-row">
            <a href="{{ route('supplier.supplierprofile') ?? '#' }}" class="sidebar-user">
                <div class="sidebar-user-avatar">
                    @if($supplierProfile && $supplierProfile->photo)
                        <img src="{{ asset('storage/' . $supplierProfile->photo) }}" alt="{{ $displayName }}">
                    @else
                        {{ $initials ?: 'S' }}
                    @endif
                </div>
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name">{{ $displayName }}</div>
                    <div class="sidebar-user-role">Supplier</div>
                </div>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="sidebar-logout-form">
                @csrf
                <button type="submit" class="sidebar-logout-btn" title="Sign out">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M13 5l4 5-4 5M17 10H8M10 3H5a2 2 0 00-2 2v10a2 2 0 002 2h5"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>

</aside>