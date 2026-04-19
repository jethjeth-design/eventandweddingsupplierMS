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

        <a href="{{ url('/supplier/dashboard') }}"
           class="nav-item {{ request()->is('supplier/dashboard') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M3 10L10 3l7 7M5 8v8h4v-5h2v5h4V8"/>
            </svg>
            <span>Dashboard</span>
            <span class="nav-tooltip">Dashboard</span>
        </a>

        <a href="#" class="nav-item">
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

        <a href="{{ route('supplier.inquiries.inbox') }}"
           class="nav-item {{ request()->is('supplier/inbox*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/>
            </svg>
            <span>Inquiries</span>
            <span class="nav-tooltip">Inquiries</span>
        </a>

        <a href="{{ route('supplier.bookings') }}"
           class="nav-item {{ request()->is('supplier/bookings*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M9 12l2 2 4-4M7 3H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2h-2"/>
                <rect x="7" y="1" width="6" height="4" rx="1"/>
            </svg>
            <span>Bookings</span>
            <span class="nav-tooltip">Bookings</span>
        </a>

        <div class="sidebar-divider"></div>
        <div class="nav-group-label">Business</div>

        <a href="{{ route('supplier.package.index') }}"
           class="nav-item {{ request()->is('supplier/packages*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M10 2l2.4 4.9 5.4.8-3.9 3.8.9 5.3L10 14.3l-4.8 2.5.9-5.3L2.2 7.7l5.4-.8z"/>
            </svg>
            <span>Packages & Pricing</span>
            <span class="nav-tooltip">Packages & Pricing</span>
        </a>

        <a href="{{ route('supplier.availability.index') }}"
           class="nav-item {{ request()->is('supplier/availability*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <rect x="3" y="4" width="14" height="13" rx="2"/>
                <path d="M7 2v4M13 2v4M3 9h14M7 13h2M11 13h2"/>
            </svg>
            <span>Availability</span>
            <span class="nav-tooltip">Availability</span>
        </a>

        <a href="{{ route('supplier.portfolio.gallery') }}"
           class="nav-item {{ request()->is('supplier/gallery*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <rect x="2" y="4" width="16" height="12" rx="2"/>
                <circle cx="7" cy="9" r="1.5"/>
                <path d="M2 14l4-4 3 3 3-3 6 5"/>
            </svg>
            <span>Gallery</span>
            <span class="nav-tooltip">Gallery</span>
        </a>

        <a href="{{ route('teams.create') }}"
           class="nav-item {{ request()->is('supplier/reviews*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M10 2l1.8 3.6 4 .6-2.9 2.8.7 4-3.6-1.9L6.4 13l.7-4L4.2 6.2l4-.6z"/>
                <path d="M3 17h14"/>
            </svg>
            <span>Reviews</span>
            <span class="nav-tooltip">Reviews</span>
        </a>

        <div class="sidebar-divider"></div>
        <div class="nav-group-label">Finance</div>

        <a href="#"
           class="nav-item {{ request()->is('supplier/earnings*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <rect x="2" y="5" width="16" height="11" rx="2"/>
                <path d="M2 9h16"/>
                <circle cx="10" cy="13" r="1.5"/>
            </svg>
            <span>Earnings</span>
            <span class="nav-tooltip">Earnings</span>
        </a>

        <a href="#"
           class="nav-item {{ request()->is('supplier/payouts*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M3 7h14M3 11h8M3 15h5M15 13l2 2 2-2M17 15V11"/>
            </svg>
            <span>Payouts</span>
            <span class="nav-tooltip">Payouts</span>
        </a>

        <div class="sidebar-divider"></div>
        <div class="nav-group-label">Account</div>

        <a href="{{ route('supplier.supplierprofile') ?? '#' }}"
           class="nav-item {{ request()->is('supplier/profile*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="10" cy="7" r="4"/>
                <path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/>
            </svg>
            <span>Business Profile</span>
            <span class="nav-tooltip">Business Profile</span>
        </a>

        {{-- ── SETTINGS with dropdown drawer ── --}}
        <div class="nav-item nav-item--has-dropdown {{ request()->is('supplier/settings*') ? 'active' : '' }}"
             id="settingsToggle"
             onclick="toggleSettings(event)">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="10" cy="10" r="3"/>
                <path d="M10 1v2M10 17v2M1 10h2M17 10h2M3.2 3.2l1.4 1.4M15.4 15.4l1.4 1.4M3.2 16.8l1.4-1.4M15.4 4.6l1.4-1.4"/>
            </svg>
            <span>Settings</span>
            <span class="nav-tooltip">Settings</span>
            <svg class="settings-chevron" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 6l4 4 4-4"/>
            </svg>
        </div>

        <div class="settings-drawer" id="settingsDrawer">
            <a href="{{ route('client.profile') ?? '#' }}"
               class="settings-drawer-item {{ request()->is('supplier/settings/account') ? 'active' : '' }}">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="8" cy="5.5" r="3"/>
                    <path d="M2 14c0-3 2.7-5 6-5s6 2 6 5"/>
                </svg>
                Account
            </a>
            <a href="{{ url('/supplier/settings/notifications') }}"
               class="settings-drawer-item {{ request()->is('supplier/settings/notifications') ? 'active' : '' }}">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M8 2a5 5 0 015 5v3l1.5 2h-13L3 10V7a5 5 0 015-5zM6.5 13a1.5 1.5 0 003 0"/>
                </svg>
                Notifications
            </a>
            <a href="{{ url('/supplier/settings/security') }}"
               class="settings-drawer-item {{ request()->is('supplier/settings/security') ? 'active' : '' }}">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M8 1l5 2v5c0 3-2.5 5.5-5 7-2.5-1.5-5-4-5-7V3l5-2z"/>
                </svg>
                Security & Password
            </a>
            <a href="{{ url('/supplier/settings/billing') }}"
               class="settings-drawer-item {{ request()->is('supplier/settings/billing') ? 'active' : '' }}">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                    <rect x="1" y="3" width="14" height="10" rx="2"/>
                    <path d="M1 7h14M4 11h3"/>
                </svg>
                Billing
            </a>
            <a href="{{route('roles.index') ?? '#'}}"
               class="settings-drawer-item {{ request()->is('supplier/settings/roles/index') ? 'active' : '' }}">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M8 2a5 5 0 015 5v3l1.5 2h-13L3 10V7a5 5 0 015-5zM6.5 13a1.5 1.5 0 003 0"/>
                </svg>
                Roles
            </a>
        </div>

    </nav>

    {{-- ── SIDEBAR FOOTER with photo + name + logout ── --}}
    @php
        $supplierProfile = App\Models\SupplierProfile::where('user_id', Auth::id())->first();
        $displayName     = $supplierProfile
            ? trim(($supplierProfile->first_name ?? '') . ' ' . ($supplierProfile->last_name ?? ''))
            : (Auth::user()->name ?? 'Supplier');
        $initials        = strtoupper(substr($displayName, 0, 1) . (strpos($displayName,' ') !== false ? substr($displayName, strpos($displayName,' ')+1, 1) : ''));
    @endphp

    <div class="sidebar-footer">
        <div class="sidebar-user-row">

            {{-- Profile link --}}
            <a href="{{ route('supplier.supplierprofile') ?? '#' }}" class="sidebar-user">
                <div class="sidebar-user-avatar">
                    @if($supplierProfile && $supplierProfile->photo)
                        <img src="{{ asset('storage/' . $supplierProfile->photo) }}"
                             alt="{{ $displayName }}"
                             style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                    @else
                        {{ $initials ?: 'S' }}
                    @endif
                </div>
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name">{{ $displayName }}</div>
                    <div class="sidebar-user-role">Supplier</div>
                </div>
            </a>

            {{-- Logout button --}}
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

<style>
    /* ═══════════════════════════════════════════
    ACTIVE STATE — gold left bar + tinted bg
    (works on charcoal sidebar background)
    ═══════════════════════════════════════════ */
    .nav-item.active {
        background: rgba(201,168,76,0.12);
        color: var(--gold-light) !important;
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
    .nav-item.active svg:first-child {
        color: var(--gold-light) !important;
        opacity: 1 !important;
    }

    /* ═══════════════════════════════════════════
    SETTINGS DROPDOWN CHEVRON
    ═══════════════════════════════════════════ */
    .nav-item--has-dropdown {
        cursor: pointer;
    }
    .settings-chevron {
        width: 13px !important;
        height: 13px !important;
        margin-left: auto;
        opacity: 0.35 !important;
        flex-shrink: 0;
        transition: transform 0.22s ease, opacity 0.15s !important;
        /* push to end, after badge if any */
        order: 99;
    }
    .nav-item--has-dropdown.open .settings-chevron {
        transform: rotate(180deg);
        opacity: 0.65 !important;
    }
    /* hide chevron when sidebar is collapsed */
    .sidebar.collapsed .settings-chevron { display: none; }

    /* ═══════════════════════════════════════════
    SETTINGS DRAWER
    ═══════════════════════════════════════════ */
    .settings-drawer {
        overflow: hidden;
        max-height: 0;
        opacity: 0;
        transition: max-height 0.3s cubic-bezier(0.4,0,0.2,1), opacity 0.25s ease;
        margin-left: 1.4rem;
        border-left: 1.5px solid rgba(201,168,76,0.18);
        padding-left: 0.6rem;
    }
    .settings-drawer.open {
        max-height: 280px;
        opacity: 1;
        margin-bottom: 4px;
    }
    /* hide drawer content when sidebar is collapsed */
    .sidebar.collapsed .settings-drawer { display: none; }

    .settings-drawer-item {
        display: flex;
        align-items: center;
        gap: 0.55rem;
        padding: 0.48rem 0.7rem;
        border-radius: 6px;
        font-size: 0.78rem;
        font-weight: 400;
        color: rgba(255,255,255,0.45);
        text-decoration: none;
        cursor: pointer;
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        font-family: inherit;
        transition: background 0.15s, color 0.15s;
        margin-bottom: 1px;
        position: relative;
    }
    .settings-drawer-item svg {
        width: 13px; height: 13px; flex-shrink: 0;
        opacity: 0.5; transition: opacity 0.15s;
    }
    .settings-drawer-item:hover {
        background: rgba(201,168,76,0.08);
        color: rgba(255,255,255,0.85);
    }
    .settings-drawer-item:hover svg { opacity: 0.85; }
    .settings-drawer-item.active {
        background: rgba(201,168,76,0.12);
        color: var(--gold-light);
        font-weight: 500;
    }
    .settings-drawer-item.active svg { opacity: 1; color: var(--gold-light); }

    /* ═══════════════════════════════════════════
    SIDEBAR FOOTER — profile + logout row
    ═══════════════════════════════════════════ */
    .sidebar-user-row {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    /* Profile link fills remaining space */
    .sidebar-user-row .sidebar-user {
        flex: 1;
        min-width: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.55rem 0.65rem;
        border-radius: 8px;
        transition: background 0.2s;
        cursor: pointer;
        text-decoration: none;
    }
    .sidebar-user:hover { background: rgba(201,168,76,0.08); }

    /* Avatar circle */
    .sidebar-user-avatar {
        width: 50px; height: 50px; flex-shrink: 0;
        border-radius: 100%;
        background: linear-gradient(135deg, var(--gold), var(--gold-dark));
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display);
        font-size: 0.72rem; font-weight: 700;
        color: var(--white);
        overflow: hidden;
        border: 1.5px solid rgba(201,168,76,0.3);
    }
    .sidebar-user-info {
        overflow: hidden;
        transition: opacity 0.2s, width 0.3s;
        min-width: 0;
    }
    .sidebar.collapsed .sidebar-user-info { opacity: 0; width: 0; }

    .sidebar-user-name {
        font-size: 0.82rem; font-weight: 500;
        color: rgba(255,255,255,0.88);
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .sidebar-user-role {
        font-size: 0.66rem;
        color: var(--gold-light);
        white-space: nowrap;
    }

    /* Logout button */
    .sidebar-logout-form { flex-shrink: 0; }
    .sidebar-logout-btn {
        width: 32px; height: 32px; flex-shrink: 0;
        border-radius: 7px;
        border: 1px solid rgba(201,168,76,0.18);
        background: rgba(255,255,255,0.04);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        color: rgba(255,255,255,0.4);
        transition: background 0.2s, color 0.2s, border-color 0.2s;
        position: relative;
    }
    .sidebar-logout-btn svg { width: 15px; height: 15px; }
    .sidebar-logout-btn:hover {
        background: rgba(220,38,38,0.12);
        border-color: rgba(220,38,38,0.35);
        color: #FCA5A5;
    }
    /* hide logout label text when collapsed — show tooltip only */
    .sidebar.collapsed .sidebar-logout-form { display: none; }
</style>

<script>
    /* ── SETTINGS DROPDOWN ── */
    function toggleSettings(e) {
        e.stopPropagation();
        const toggle = document.getElementById('settingsToggle');
        const drawer = document.getElementById('settingsDrawer');
        const isOpen = drawer.classList.contains('open');

        drawer.classList.toggle('open', !isOpen);
        toggle.classList.toggle('open', !isOpen);

        if (!isOpen) {
            toggle.classList.add('active');
        } else {
            if (!drawer.querySelector('.settings-drawer-item.active')) {
                /* only remove active if not on a settings sub-page */
                if (!{{ json_encode(request()->is('supplier/settings*')) }}) {
                    toggle.classList.remove('active');
                }
            }
        }
    }

    /* Auto-open drawer if a settings sub-route is currently active */
    document.addEventListener('DOMContentLoaded', function () {
        const drawer = document.getElementById('settingsDrawer');
        const toggle = document.getElementById('settingsToggle');
        if (drawer && (drawer.querySelector('.settings-drawer-item.active') || {{ json_encode(request()->is('supplier/settings*')) }})) {
            drawer.classList.add('open');
            toggle.classList.add('open', 'active');
        }
    });
</script>