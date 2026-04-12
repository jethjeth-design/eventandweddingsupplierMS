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
 
                <a href="{{ url('/supplier/dashboard') }}"
                   class="nav-item {{ request()->is('supplier/dashboard') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M3 10L10 3l7 7M5 8v8h4v-5h2v5h4V8"/>
                    </svg>
                    <span>Dashboard</span>
                    <span class="nav-tooltip">Dashboard</span>
                </a>
 
                <a href="#" class="nav-item {{ request()->is()? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="3" y="3" width="6" height="6" rx="1"/>
                        <rect x="11" y="3" width="6" height="6" rx="1"/>
                        <rect x="3" y="11" width="6" height="6" rx="1"/>
                        <rect x="11" y="11" width="6" height="6" rx="1"/>
                    </svg>
                    <span>My Listings</span>
                    <span class="nav-tooltip">My Listings</span>
                    <span class="nav-badge">4</span>
                </a>
 
                <a href="{{ route('supplier.inquiries.inbox') }}" class="nav-item {{ request()->is('supplier/inbox*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/>
                    </svg>
                    <span>Inquiries</span>
                    <span class="nav-tooltip">Inquiries</span>
                </a>
 
                <a href="#" class="nav-item {{ request()->is('supplier/bookings*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M9 12l2 2 4-4M7 3H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2h-2"/>
                        <rect x="7" y="1" width="6" height="4" rx="1"/>
                    </svg>
                    <span>Bookings</span>
                    <span class="nav-tooltip">Bookings</span>
                </a>
 
                <div class="sidebar-divider"></div>
                <div class="nav-group-label">Business</div>
 
                <a href="{{route('supplier.package.index')}}" class="nav-item {{ request()->is('supplier/packages*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M10 2l2.4 4.9 5.4.8-3.9 3.8.9 5.3L10 14.3l-4.8 2.5.9-5.3L2.2 7.7l5.4-.8z"/>
                    </svg>
                    <span>Packages & Pricing</span>
                    <span class="nav-tooltip">Packages & Pricing</span>
                </a>
 
                <a href="#" class="nav-item {{ request()->is('supplier/calendar*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="3" y="4" width="14" height="13" rx="2"/>
                        <path d="M7 2v4M13 2v4M3 9h14"/>
                        <path d="M7 13h2M11 13h2"/>
                    </svg>
                    <span>Availability</span>
                    <span class="nav-tooltip">Availability</span>
                </a>
 
                <a href="{{route('supplier.portfolio.gallery')}}" class="nav-item {{ request()->is('supplier/gallery*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="2" y="4" width="16" height="12" rx="2"/>
                        <circle cx="7" cy="9" r="1.5"/>
                        <path d="M2 14l4-4 3 3 3-3 6 5"/>
                    </svg>
                    <span>Gallery</span>
                    <span class="nav-tooltip">Gallery</span>
                </a>
 
                <a href="#" class="nav-item {{ request()->is('supplier/reviews*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M10 2l1.8 3.6 4 .6-2.9 2.8.7 4-3.6-1.9L6.4 13l.7-4L4.2 6.2l4-.6z"/>
                        <path d="M3 17h14"/>
                    </svg>
                    <span>Reviews</span>
                    <span class="nav-tooltip">Reviews</span>
                </a>
 
                <div class="sidebar-divider"></div>
                <div class="nav-group-label">Finance</div>
 
                <a href="#" class="nav-item {{ request()->is('supplier/earnings*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="2" y="5" width="16" height="11" rx="2"/>
                        <path d="M2 9h16"/>
                        <circle cx="10" cy="13" r="1.5"/>
                    </svg>
                    <span>Earnings</span>
                    <span class="nav-tooltip">Earnings</span>
                </a>
 
                <a href="#" class="nav-item {{ request()->is('supplier/payouts*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M3 7h14M3 11h8M3 15h5"/>
                        <path d="M15 13l2 2 2-2M17 15V11"/>
                    </svg>
                    <span>Payouts</span>
                    <span class="nav-tooltip">Payouts</span>
                </a>
 
                <div class="sidebar-divider"></div>
                <div class="nav-group-label">Account</div>
 
                <a href="{{ route('supplier.supplierprofile') ?? '#' }}" class="nav-item {{ request()->is('supplier/profile*') ? 'active' : '' }}">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="7" r="4"/>
                        <path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    <span>Business Profile</span>
                    <span class="nav-tooltip">Business Profile</span>
                </a>
 
                <a href="#" class="nav-item {{ request()->is('supplier/settings*') ? 'active' : '' }}">
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
                <a href="{{ route('supplier.supplierprofile') ?? '#' }}" class="sidebar-user">
                    <div class="sidebar-user-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                    </div>
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-name">{{ Auth::user()->name ?? 'Guest User' }}</div>
                        <div class="sidebar-user-role">Supplier</div>
                    </div>
                </a>
            </div>
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