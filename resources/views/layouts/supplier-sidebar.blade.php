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
        <a href="{{ url('/supplier/dashboard') }}"
           class="nav-item {{ request()->is('supplier/dashboard') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M3 10L10 3l7 7M5 8v8h4v-5h2v5h4V8"/>
            </svg>
            <span>Dashboard</span>
            <span class="nav-tooltip">Dashboard</span>
        </a>

        {{-- My Listings--}} 
        <a href="{{ route('supplier.package.mylistings') }}"
           class="nav-item {{ request()->is('supplier/listings*') || request()->routeIs('supplier.listings*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <rect x="3" y="3" width="6" height="6" rx="1"/>
                <rect x="11" y="3" width="6" height="6" rx="1"/>
                <rect x="3" y="11" width="6" height="6" rx="1"/>
                <rect x="11" y="11" width="6" height="6" rx="1"/>
            </svg>
            <span>My Listings</span>
            <span class="nav-tooltip">My Listings</span>
        </a>

        {{-- Inquiries --}}
        <a href="{{ route('supplier.inquiries.inbox') }}"
           class="nav-item {{ request()->is('supplier/inbox*') || request()->routeIs('supplier.inquiries.*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/>
            </svg>
            <span>Inquiries</span>
            <span class="nav-tooltip">Inquiries</span>
        </a>

        {{-- Bookings --}}
        <a href="{{ route('supplier.bookings') }}"
           class="nav-item {{ request()->is('supplier/bookings*') || request()->routeIs('supplier.bookings*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M9 12l2 2 4-4M7 3H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2h-2"/>
                <rect x="7" y="1" width="6" height="4" rx="1"/>
            </svg>
            <span>Bookings</span>
            <span class="nav-tooltip">Bookings</span>
        </a>

        <div class="sidebar-divider"></div>
        <div class="nav-group-label">Business</div>

        {{-- Packages & Pricing --}}
        <a href="{{ route('supplier.package.index') }}"
           class="nav-item {{ request()->is('supplier/package*') || request()->routeIs('supplier.package*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M16 7H4a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2z"/>
                <path d="M13 7V5a3 3 0 00-6 0v2"/>
            </svg>
            <span>Packages & Pricing</span>
            <span class="nav-tooltip">Packages & Pricing</span>
        </a>

        {{-- Availability --}}
        <a href="{{ route('supplier.availability.index') }}"
           class="nav-item {{ request()->is('supplier/availability*') || request()->routeIs('supplier.availability*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <rect x="3" y="4" width="14" height="13" rx="2"/>
                <path d="M7 2v4M13 2v4M3 9h14M7 13h2M11 13h2"/>
            </svg>
            <span>Availability</span>
            <span class="nav-tooltip">Availability</span>
        </a>

        {{-- Gallery --}}
        <a href="{{ route('supplier.portfolio.gallery') }}"
           class="nav-item {{ request()->is('supplier/gallery*') || request()->routeIs('supplier.portfolio*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <rect x="2" y="4" width="16" height="12" rx="2"/>
                <circle cx="7" cy="9" r="1.5"/>
                <path d="M2 14l4-4 3 3 3-3 6 5"/>
            </svg>
            <span>Gallery</span>
            <span class="nav-tooltip">Gallery</span>
        </a>

        {{-- Reviews --}}
        <a href="{{ route('supplier.ratings.index') }}"
           class="nav-item {{ request()->is('supplier/reviews*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M10 2l1.8 3.6 4 .6-2.9 2.8.7 4-3.6-1.9L6.4 13l.7-4L4.2 6.2l4-.6z"/>
            </svg>
            <span>Reviews</span>
            <span class="nav-tooltip">Reviews</span>
        </a>

        {{-- Assign Teams — grouped under a dropdown --}}
       @php
            $supplier = Auth::user()->supplier;

            $packages = \App\Models\Package::where('supplier_id', $supplier->id ?? null)->get();

            $isAssignTeamsActive = request()->is('supplier/package/*/assign-teams');
        @endphp

        <div class="nav-item-group {{ $isAssignTeamsActive ? 'open' : '' }}" id="navGroupTeams">
            <a href="#" class="nav-item {{ $isAssignTeamsActive ? 'active' : '' }}"
               onclick="event.preventDefault(); toggleNavGroup('navGroupTeams')">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="7" cy="7" r="3"/>
                    <circle cx="14" cy="7" r="3"/>
                    <path d="M1 17c0-3 2.7-5 6-5M8 17c0-3 2.7-5 6-5"/>
                </svg>
                <span>Assign Teams</span>
                <svg class="nav-arrow" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 4l4 4-4 4"/>
                </svg>
                <span class="nav-tooltip">Assign Teams</span>
            </a>
            <div class="nav-submenu">
                @forelse($packages as $package)
                <a href="{{ route('supplier.package.assignTeamsForm', $package->id) }}"
                   class="nav-subitem {{ request()->is('supplier/package/' . $package->id . '/assign-teams') ? 'active' : '' }}">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path d="M12 6H4a1 1 0 00-1 1v5a1 1 0 001 1h8a1 1 0 001-1V7a1 1 0 00-1-1z"/>
                        <path d="M10 6V4a2 2 0 00-4 0v2"/>
                    </svg>
                    {{ $package->name }}
                </a>
                @empty
                <span class="nav-subitem" style="opacity:.5;cursor:default;">No packages yet</span>
                @endforelse
            </div>
        </div>

        <div class="sidebar-divider"></div>
        <div class="nav-group-label">Finance</div>

        {{-- Earnings --}}
        <a href="#"
           class="nav-item {{ request()->is('supplier/earnings*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <line x1="10" y1="2" x2="10" y2="18"/>
                <path d="M14 6H7.5a2.5 2.5 0 000 5h5a2.5 2.5 0 010 5H6"/>
            </svg>
            <span>Earnings</span>
            <span class="nav-tooltip">Earnings</span>
        </a>

        {{-- Payouts --}}
        <a href="#"
           class="nav-item {{ request()->is('supplier/payouts*') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <rect x="2" y="5" width="16" height="11" rx="2"/>
                <path d="M2 9h16M6 13h3"/>
                <path d="M15 13l2 2 2-2M17 15V11"/>
            </svg>
            <span>Payouts</span>
            <span class="nav-tooltip">Payouts</span>
        </a>

        <div class="sidebar-divider"></div>
        <div class="nav-group-label">Account</div>

        {{-- Business Profile --}}
        <a href="{{ route('supplier.supplierprofile') ?? '#' }}"
           class="nav-item {{ request()->is('supplier/profile*') || request()->routeIs('supplier.supplierprofile') ? 'active' : '' }}">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="10" cy="7" r="4"/>
                <path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/>
            </svg>
            <span>Business Profile</span>
            <span class="nav-tooltip">Business Profile</span>
        </a>

        {{-- Settings dropdown --}}
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

            {{--<a href="{{ url('/supplier/settings/notifications') }}"
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
            </a>--}}
            <a href="{{ route('roles.index') ?? '#' }}"
               class="settings-drawer-item {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="5" cy="5" r="2.5"/>
                    <circle cx="11" cy="5" r="2.5"/>
                    <path d="M1 13c0-2.2 1.8-4 4-4M8 13c0-2.2 1.8-4 4-4"/>
                </svg>
                Roles
            </a>
        </div>

    </nav>

    {{-- ── Sidebar footer: photo + name + logout ── --}}
    @php
        $supplierProfile = App\Models\SupplierProfile::where('user_id', Auth::id())->first();
        $displayName     = $supplierProfile
            ? trim(($supplierProfile->first_name ?? '') . ' ' . ($supplierProfile->last_name ?? ''))
            : (Auth::user()->name ?? 'Supplier');
        $initials = strtoupper(
            substr($displayName, 0, 1) .
            (strpos($displayName, ' ') !== false ? substr($displayName, strpos($displayName, ' ') + 1, 1) : '')
        );
    @endphp

    <div class="sidebar-footer">
        <div class="sidebar-user-row">

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
/* ══════════════════════════════════════════
   ACTIVE STATE — gold left bar + tinted bg
══════════════════════════════════════════ */
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

/* ══════════════════════════════════════════
   SETTINGS CHEVRON
══════════════════════════════════════════ */
.nav-item--has-dropdown { cursor: pointer; }
.settings-chevron {
    width: 13px !important; height: 13px !important;
    margin-left: auto; opacity: 0.35 !important; flex-shrink: 0;
    transition: transform 0.22s ease, opacity 0.15s !important;
    order: 99;
}
.nav-item--has-dropdown.open .settings-chevron {
    transform: rotate(180deg);
    opacity: 0.65 !important;
}
.sidebar.collapsed .settings-chevron { display: none; }

/* ══════════════════════════════════════════
   SETTINGS DRAWER
══════════════════════════════════════════ */
.settings-drawer {
    overflow: hidden;
    max-height: 0; opacity: 0;
    transition: max-height 0.3s cubic-bezier(0.4,0,0.2,1), opacity 0.25s ease;
    margin-left: 1.4rem;
    border-left: 1.5px solid rgba(201,168,76,0.18);
    padding-left: 0.6rem;
}
.settings-drawer.open { max-height: 320px; opacity: 1; margin-bottom: 4px; }
.sidebar.collapsed .settings-drawer { display: none; }

.settings-drawer-item {
    display: flex; align-items: center; gap: 0.55rem;
    padding: 0.48rem 0.7rem; border-radius: 6px;
    font-size: 0.78rem; font-weight: 400;
    color: rgba(255,255,255,0.45);
    text-decoration: none; cursor: pointer;
    background: none; border: none;
    width: 100%; text-align: left;
    font-family: inherit;
    transition: background 0.15s, color 0.15s;
    margin-bottom: 1px; position: relative;
}
.settings-drawer-item svg { width:13px; height:13px; flex-shrink:0; opacity:.5; transition:opacity .15s; }
.settings-drawer-item:hover { background: rgba(201,168,76,0.08); color: rgba(255,255,255,0.85); }
.settings-drawer-item:hover svg { opacity: 0.85; }
.settings-drawer-item.active { background: rgba(201,168,76,0.12); color: var(--gold-light); font-weight: 500; }
.settings-drawer-item.active svg { opacity: 1; color: var(--gold-light); }

/* ══════════════════════════════════════════
   ASSIGN TEAMS SUBMENU (re-use nav-submenu)
══════════════════════════════════════════ */
.nav-item-group { position: relative; }
.nav-submenu {
    overflow: hidden; max-height: 0; opacity: 0;
    transition: max-height 0.3s cubic-bezier(0.4,0,0.2,1), opacity 0.25s ease;
    margin-left: 1.4rem;
    border-left: 1.5px solid rgba(201,168,76,0.18);
    padding-left: 0.6rem;
}
.nav-item-group.open .nav-submenu { max-height: 260px; opacity: 1; margin-bottom: 4px; }
.sidebar.collapsed .nav-submenu { display: none; }

.nav-subitem {
    display: flex; align-items: center; gap: 0.55rem;
    padding: 0.48rem 0.7rem; border-radius: 6px;
    font-size: 0.78rem; font-weight: 400;
    color: rgba(255,255,255,0.45);
    text-decoration: none;
    transition: background 0.15s, color 0.15s;
    margin-bottom: 1px;
}
.nav-subitem svg { width:13px; height:13px; flex-shrink:0; opacity:.5; transition:opacity .15s; }
.nav-subitem:hover { background: rgba(201,168,76,0.08); color: rgba(255,255,255,0.85); }
.nav-subitem:hover svg { opacity: 0.85; }
.nav-subitem.active { background: rgba(201,168,76,0.12); color: var(--gold-light); font-weight: 500; }
.nav-subitem.active svg { opacity: 1; }

.nav-arrow {
    width: 13px !important; height: 13px !important;
    margin-left: auto; opacity: 0.35 !important; flex-shrink: 0;
    transition: transform 0.22s ease !important;
    order: 99;
}
.nav-item-group.open > .nav-item .nav-arrow { transform: rotate(90deg); opacity: 0.65 !important; }
.sidebar.collapsed .nav-arrow { display: none; }

/* ══════════════════════════════════════════
   SIDEBAR FOOTER
══════════════════════════════════════════ */
.sidebar-user-row { display:flex; align-items:center; gap:0.5rem; }

.sidebar-user-row .sidebar-user {
    flex:1; min-width:0;
    display:flex; align-items:center; gap:0.75rem;
    padding:0.55rem 0.65rem; border-radius:8px;
    transition:background .2s; cursor:pointer; text-decoration:none;
}
.sidebar-user:hover { background: rgba(201,168,76,0.08); }

.sidebar-user-avatar {
    width:50px; height:50px; flex-shrink:0; border-radius:50%;
    background: linear-gradient(135deg, var(--gold), var(--gold-dark));
    display:flex; align-items:center; justify-content:center;
    font-family:var(--font-display); font-size:0.72rem; font-weight:700;
    color:var(--white); overflow:hidden;
    border:1.5px solid rgba(201,168,76,0.3);
}
.sidebar-user-info { overflow:hidden; transition:opacity .2s,width .3s; min-width:0; }
.sidebar.collapsed .sidebar-user-info { opacity:0; width:0; }

.sidebar-user-name { font-size:0.82rem; font-weight:500; color:rgba(255,255,255,0.88); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.sidebar-user-role { font-size:0.66rem; color:var(--gold-light); white-space:nowrap; }

.sidebar-logout-form { flex-shrink:0; }
.sidebar-logout-btn {
    width:32px; height:32px; border-radius:7px;
    border:1px solid rgba(201,168,76,0.18);
    background:rgba(255,255,255,0.04);
    display:flex; align-items:center; justify-content:center;
    cursor:pointer; color:rgba(255,255,255,0.4);
    transition:background .2s, color .2s, border-color .2s;
}
.sidebar-logout-btn svg { width:15px; height:15px; }
.sidebar-logout-btn:hover { background:rgba(220,38,38,0.12); border-color:rgba(220,38,38,0.35); color:#FCA5A5; }
.sidebar.collapsed .sidebar-logout-form { display:none; }
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
        if (!{{ json_encode(request()->is('supplier/settings*')) }}) {
            if (!drawer.querySelector('.settings-drawer-item.active')) {
                toggle.classList.remove('active');
            }
        }
    }
}

/* ── NAV GROUP (Assign Teams) TOGGLE ── */
function toggleNavGroup(id) {
    const group = document.getElementById(id);
    if (!group) return;
    group.classList.toggle('open');
}

/* ── AUTO-OPEN ON ACTIVE ROUTE ── */
document.addEventListener('DOMContentLoaded', function () {
    /* Settings drawer */
    const drawer = document.getElementById('settingsDrawer');
    const toggle = document.getElementById('settingsToggle');
    if (drawer && (drawer.querySelector('.settings-drawer-item.active') || {{ json_encode(request()->is('supplier/settings*')) }})) {
        drawer.classList.add('open');
        toggle.classList.add('open', 'active');
    }

    /* Assign Teams group */
    const teamsGroup = document.getElementById('navGroupTeams');
    if (teamsGroup) {
        const hasActive = teamsGroup.querySelector('.nav-subitem.active');
        if (hasActive || {{ json_encode(request()->is('supplier/package/*/assign-teams')) }}) {
            teamsGroup.classList.add('open');
        }
    }
});
</script>