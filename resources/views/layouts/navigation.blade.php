<style>
        /* ── SEARCH ── */
        .topbar-search {
            display: flex; align-items: center; gap: 0.5rem;
            background: var(--white); border: 1.5px solid var(--border-md);
            border-radius: 8px; padding: 0.42rem 0.9rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .topbar-search:focus-within { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,0.1); }
        .topbar-search svg { width: 13px; height: 13px; color: #C0B8B0; flex-shrink: 0; }
        .topbar-search input { border: none; outline: none; background: transparent; font-family: var(--font-body); font-size: 0.79rem; color: var(--charcoal); width: 170px; }
        .topbar-search input::placeholder { color: #C0B8B0; }

        /* ── ICON BUTTON ── */
        .icon-btn {
            width: 36px; height: 36px; border-radius: 8px;
            border: 1.5px solid var(--border-md); background: var(--white);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--warm-grey);
            transition: border-color 0.2s, color 0.2s, background 0.2s;
            position: relative; text-decoration: none; flex-shrink: 0;
        }
        .icon-btn:hover { border-color: var(--gold); color: var(--gold-dark); background: rgba(201,168,76,0.06); }
        .icon-btn svg { width: 16px; height: 16px; }

        /* ── NOTIFICATION BELL WRAP ── */
        .notif-wrap { position: relative; }

        /* Unread count badge on bell */
        .notif-count {
            position: absolute; top: -5px; right: -5px;
            min-width: 17px; height: 17px;
            background: var(--gold); color: var(--charcoal);
            border: 2px solid var(--ivory);
            border-radius: 999px; font-size: 0.55rem; font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            padding: 0 3px; line-height: 1; font-family: var(--font-body);
            pointer-events: none;
        }

        /* ── NOTIFICATION DROPDOWN ── */
        .notif-dropdown {
            display: none;
            position: absolute; top: calc(100% + 10px); right: 0;
            width: 340px; max-width: 90vw;
            background: var(--white);
            border: 1px solid var(--border);
            border-top: 2px solid var(--gold);
            border-radius: 4px;
            box-shadow: 0 12px 40px rgba(30,27,24,0.14);
            z-index: 500;
            overflow: hidden;
        }
        .notif-dropdown.open { display: block; animation: notifIn 0.2s ease; }
        @keyframes notifIn { from { opacity:0; transform:translateY(-6px); } to { opacity:1; transform:none; } }

        /* Header */
        .notif-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0.85rem 1.1rem 0.75rem;
            border-bottom: 1px solid var(--border);
            background: var(--ivory);
        }
        .notif-header-l { display: flex; align-items: center; gap: 0.55rem; }
        .notif-header-title {
            font-family: var(--font-display); font-size: 0.92rem; font-weight: 700; color: var(--charcoal);
        }
        .notif-header-title em { font-style: italic; color: var(--gold-dark); }
        .notif-unread-pill {
            display: inline-flex; align-items: center; padding: 1px 8px;
            background: rgba(201,168,76,0.12); color: var(--gold-dark);
            border: 1px solid rgba(201,168,76,0.28); border-radius: 999px;
            font-size: 0.6rem; font-weight: 700; letter-spacing: 0.05em;
        }
        .notif-mark-all {
            font-size: 0.68rem; color: var(--gold-dark); font-family: var(--font-body);
            font-weight: 500; background: none; border: none; cursor: pointer;
            padding: 0; transition: color 0.18s; text-decoration: none;
        }
        .notif-mark-all:hover { color: var(--gold); text-decoration: underline; }

        /* List */
        .notif-list { max-height: 320px; overflow-y: auto; }
        .notif-list::-webkit-scrollbar { width: 3px; }
        .notif-list::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }

        /* Individual item */
        .notif-item {
            display: flex; align-items: flex-start; gap: 0.7rem;
            padding: 0.85rem 1.1rem;
            border-bottom: 1px solid var(--border);
            text-decoration: none; color: var(--charcoal);
            transition: background 0.15s;
            position: relative; cursor: pointer;
        }
        .notif-item:last-child { border-bottom: none; }
        .notif-item:hover { background: rgba(201,168,76,0.04); }
        .notif-item.unread { background: rgba(201,168,76,0.05); }
        .notif-item.unread::before {
            content: ''; position: absolute; left: 0; top: 0; bottom: 0;
            width: 3px; background: var(--gold);
        }

        /* Icon circle */
        .notif-icon {
            width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            background: rgba(201,168,76,0.1); color: var(--gold-dark);
            border: 1px solid rgba(201,168,76,0.2);
        }
        .notif-icon svg { width: 15px; height: 15px; }
        .notif-icon.icon-booking  { background: rgba(22,163,74,0.08);  color: #16A34A; border-color: rgba(22,163,74,0.2); }
        .notif-icon.icon-cancel   { background: rgba(185,28,28,0.08);  color: #B91C1C; border-color: rgba(185,28,28,0.2); }
        .notif-icon.icon-message  { background: rgba(37,99,235,0.08);  color: #2563EB; border-color: rgba(37,99,235,0.2); }
        .notif-icon.icon-system   { background: rgba(201,168,76,0.1);  color: var(--gold-dark); border-color: rgba(201,168,76,0.22); }

        /* Content */
        .notif-content { flex: 1; min-width: 0; }
        .notif-title {
            font-size: 0.79rem; font-weight: 600; color: var(--charcoal);
            line-height: 1.3; margin-bottom: 0.2rem;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .notif-msg {
            font-size: 0.72rem; color: var(--warm-grey); line-height: 1.45;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }
        .notif-time {
            font-size: 0.62rem; color: #C0B8B0; margin-top: 0.28rem;
            display: flex; align-items: center; gap: 0.3rem;
        }
        .notif-time svg { width: 9px; height: 9px; }

        /* Unread dot */
        .notif-dot {
            width: 7px; height: 7px; border-radius: 50%;
            background: var(--gold); flex-shrink: 0; margin-top: 5px;
        }

        /* Empty state */
        .notif-empty {
            text-align: center; padding: 2.5rem 1.5rem;
        }
        .notif-empty-icon {
            width: 46px; height: 46px; border-radius: 50%;
            background: rgba(201,168,76,0.08);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 0.75rem; color: var(--gold-dark);
        }
        .notif-empty-icon svg { width: 22px; height: 22px; }
        .notif-empty-text { font-size: 0.8rem; color: var(--warm-grey); }
        .notif-empty-sub  { font-size: 0.7rem; color: #C0B8B0; margin-top: 0.2rem; }

        /* Footer */
        .notif-footer {
            padding: 0.65rem 1.1rem;
            border-top: 1px solid var(--border);
            background: var(--ivory);
            display: flex; align-items: center; justify-content: center;
        }
        .notif-see-all {
            display: inline-flex; align-items: center; gap: 0.35rem;
            font-size: 0.72rem; font-weight: 600; color: var(--gold-dark);
            text-decoration: none; font-family: var(--font-body);
            transition: color 0.18s;
        }
        .notif-see-all:hover { color: var(--gold); }
        .notif-see-all svg { width: 11px; height: 11px; }

        /* ── USER PILL ── */
        .user-pill {
            display: flex; align-items: center; gap: 0.55rem;
            padding: 0.3rem 0.75rem 0.3rem 0.3rem;
            background: var(--white); border: 1.5px solid var(--border-md);
            border-radius: 999px; cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s;
            position: relative; flex-shrink: 0;
        }
        .user-pill:hover { border-color: var(--gold); box-shadow: 0 2px 8px rgba(201,168,76,0.12); }
        .user-avatar {
            width: 28px; height: 28px; border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display); font-size: 0.68rem; font-weight: 700;
            color: var(--white); flex-shrink: 0; overflow: hidden;
        }
        .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .user-name { font-size: 0.79rem; font-weight: 500; color: var(--charcoal); max-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-role-chip {
            font-size: 0.58rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase;
            color: var(--gold-dark); background: rgba(201,168,76,0.1);
            border: 1px solid rgba(201,168,76,0.25); padding: 1px 7px; border-radius: 999px;
        }
        .user-pill > svg { width: 11px; height: 11px; color: #C0B8B0; }

        /* Dropdown */
        .user-dropdown {
            display: none; position: absolute; top: calc(100% + 8px); right: 0;
            min-width: 215px; background: var(--white);
            border: 1px solid var(--border-md); border-top: 2px solid var(--gold);
            border-radius: 4px; box-shadow: 0 8px 32px rgba(30,27,24,0.12);
            padding: 0.5rem; z-index: 400;
        }
        .user-pill:hover .user-dropdown,
        .user-pill:focus-within .user-dropdown { display: block; }

        .dropdown-user-header {
            display: flex; align-items: center; gap: 0.65rem;
            padding: 0.6rem 0.75rem 0.75rem;
            border-bottom: 1px solid var(--border); margin-bottom: 0.4rem;
        }
        .dropdown-user-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display); font-size: 0.85rem; font-weight: 700;
            color: var(--white); flex-shrink: 0; overflow: hidden;
        }
        .dropdown-user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .dropdown-user-name { font-size: 0.84rem; font-weight: 600; color: var(--charcoal); }
        .dropdown-user-email { font-size: 0.68rem; color: var(--warm-grey); margin-top: 1px; }

        .dropdown-item {
            display: flex; align-items: center; gap: 0.6rem;
            padding: 0.58rem 0.75rem; border-radius: 3px;
            font-size: 0.81rem; color: var(--charcoal);
            text-decoration: none; transition: background 0.15s, color 0.15s;
            cursor: pointer; border: none; background: none;
            width: 100%; text-align: left; font-family: var(--font-body);
        }
        .dropdown-item svg { width: 14px; height: 14px; color: var(--warm-grey); flex-shrink: 0; }
        .dropdown-item:hover { background: var(--ivory); color: var(--gold-dark); }
        .dropdown-item:hover svg { color: var(--gold-dark); }
        .dropdown-divider { height: 1px; background: var(--border); margin: 0.35rem 0; }
        .dropdown-item.danger { color: #B91C1C; }
        .dropdown-item.danger svg { color: #B91C1C; }
        .dropdown-item.danger:hover { background: #FEF2F2; }

        @media(max-width:768px){
            .topbar-search { display: none; }
            .user-name, .user-role-chip { display: none; }
            .notif-dropdown { width: 300px; right: -60px; }
        }
</style>

    @php
        $authUser      = Auth::user();
        $notifications = $authUser?->notifications()->latest()->take(8)->get() ?? collect();
        $unreadCount   = $authUser?->unreadNotifications()->count() ?? 0;
        $authName      = $authUser->name ?? 'User';
        $authInitials  = strtoupper(substr($authName, 0, 2));
        $authRole      = ucfirst($authUser->role ?? 'Client');
        $authPhoto     = $authUser->clientProfile->photo
                      ?? $authUser->supplierProfile->photo
                      ?? null;
    @endphp
@if(auth()->user()->isAdmin())
<div class="topbar-right">

    

    {{-- ── SEARCH ── --}}
    <div class="topbar-search">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
            <circle cx="9" cy="9" r="6"/><path d="M15 15l3 3"/>
        </svg>
        <input type="text" placeholder="Search suppliers, events…">
    </div>

    {{-- ── MESSAGES ── --}}
    <a href="#" class="icon-btn" title="Messages">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
            <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/>
        </svg>
    </a>

    {{-- ── NOTIFICATIONS ── --}}
    <div class="notif-wrap">
        <button class="icon-btn" id="notifBtn" onclick="toggleNotif(event)" title="Notifications" aria-label="Notifications">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M10 2a6 6 0 016 6c0 3.5 1 5 2 6H2c1-1 2-2.5 2-6a6 6 0 016-6z"/>
                <path d="M8.5 18a1.5 1.5 0 003 0"/>
            </svg>
            @if($unreadCount > 0)
                <span class="notif-count">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
            @endif
        </button>

        {{-- Dropdown --}}
        <div class="notif-dropdown" id="notifDropdown" onclick="event.stopPropagation()">

            {{-- Header --}}
            <div class="notif-header">
                <div class="notif-header-l">
                    <span class="notif-header-title">Notif<em>ications</em></span>
                    @if($unreadCount > 0)
                        <span class="notif-unread-pill">{{ $unreadCount }} new</span>
                    @endif
                </div>
                @if($unreadCount > 0)
                    <button class="notif-mark-all" onclick="markAllRead(event)">
                        Mark all read
                    </button>
                @endif
            </div>

            {{-- List --}}
            <div class="notif-list">
                @forelse($notifications as $notif)
                @php
                    $isUnread = is_null($notif->read_at);
                    $title    = $notif->data['title']   ?? 'Notification';
                    $message  = $notif->data['message'] ?? '';
                    $url      = $notif->data['url']     ?? '#';
                    $type     = $notif->data['type']    ?? 'system';

                    // Icon class based on type
                    $iconClass = match($type) {
                        'booking','confirmed' => 'icon-booking',
                        'cancelled','rejected' => 'icon-cancel',
                        'message'             => 'icon-message',
                        default               => 'icon-system',
                    };
                @endphp
                <a href="{{ $url }}"
                   class="notif-item {{ $isUnread ? 'unread' : '' }}"
                   onclick="markAsRead(event, '{{ $notif->id }}')">

                    {{-- Icon --}}
                    <div class="notif-icon {{ $iconClass }}">
                        @if($type === 'booking' || $type === 'confirmed')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="4" width="16" height="14" rx="2"/><path d="M2 9h16M7 2v4M13 2v4"/></svg>
                        @elseif($type === 'cancelled' || $type === 'rejected')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="10" r="8"/><path d="M7 7l6 6M13 7l-6 6"/></svg>
                        @elseif($type === 'message')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/></svg>
                        @else
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M10 2a6 6 0 016 6c0 3.5 1 5 2 6H2c1-1 2-2.5 2-6a6 6 0 016-6z"/><path d="M8.5 18a1.5 1.5 0 003 0"/></svg>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="notif-content">
                        <div class="notif-title">{{ $title }}</div>
                        @if($message)
                            <div class="notif-msg">{{ $message }}</div>
                        @endif
                        <div class="notif-time">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="6" cy="6" r="4.5"/><path d="M6 3v3l2 1"/></svg>
                            {{ $notif->created_at->diffForHumans() }}
                        </div>
                    </div>

                    {{-- Unread dot --}}
                    @if($isUnread)
                        <div class="notif-dot"></div>
                    @endif

                </a>
                @empty
                <div class="notif-empty">
                    <div class="notif-empty-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                            <path d="M12 2a7 7 0 017 7c0 4.5 1.5 6 2.5 7H2.5C3.5 15 5 13.5 5 9a7 7 0 017-7z"/>
                            <path d="M9.5 21a2.5 2.5 0 005 0"/>
                            <line x1="12" y1="2" x2="12" y2="0"/>
                        </svg>
                    </div>
                    <div class="notif-empty-text">All caught up!</div>
                    <div class="notif-empty-sub">No notifications right now.</div>
                </div>
                @endforelse
            </div>

            {{-- Footer --}}
            @if($notifications->count() > 0)
            <div class="notif-footer">
                <a href="{{ route('notifications.index') }}" class="notif-see-all">
                    View all notifications
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 2l5 5-5 5"/></svg>
                </a>
            </div>
            @endif

        </div>
    </div>{{-- /notif-wrap --}}

    {{-- ── USER PILL ── --}}
    <div class="user-pill" tabindex="0">
        <div class="user-avatar">
            @if($authPhoto)
                <img src="{{ asset('storage/'.$authPhoto) }}" alt="{{ $authName }}">
            @else
                {{ $authInitials }}
            @endif
        </div>
        <span class="user-name">{{ $authName }}</span>
        <span class="user-role-chip">{{ $authRole }}</span>
        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M2 4l4 4 4-4"/>
        </svg>

        <div class="user-dropdown">
            <div class="dropdown-user-header">
                <div class="dropdown-user-avatar">
                    @if($authPhoto)
                        <img src="{{ asset('storage/'.$authPhoto) }}" alt="{{ $authName }}">
                    @else
                        {{ $authInitials }}
                    @endif
                </div>
                <div>
                    <div class="dropdown-user-name">{{ $authName }}</div>
                    <div class="dropdown-user-email">{{ Auth::user()->email ?? '' }}</div>
                </div>
            </div>

            <a href="{{ route('client.profile') ?? '#' }}" class="dropdown-item">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="8" cy="6" r="3"/><path d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6"/></svg>
                My Profile
            </a>
            <a href="#" class="dropdown-item">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="3" width="12" height="11" rx="1.5"/><path d="M2 7h12M5 2v2M11 2v2"/></svg>
                My Bookings
            </a>
            <a href="#" class="dropdown-item">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="8" cy="8" r="2.5"/><path d="M8 1v2M8 13v2M1 8h2M13 8h2M3.1 3.1l1.4 1.4M11.5 11.5l1.4 1.4M3.1 12.9l1.4-1.4M11.5 4.5l1.4-1.4"/></svg>
                Settings
            </a>
            <div class="dropdown-divider"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item danger">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M11 5l4 3-4 3M7 8h8M7 2H3a1 1 0 00-1 1v10a1 1 0 001 1h4"/></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </div>

</div>{{-- /topbar-right --}}
@elseif(auth()->user()->isSupplier())
<div class="topbar-right">

    

    {{-- ── SEARCH ── --}}
    <div class="topbar-search">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
            <circle cx="9" cy="9" r="6"/><path d="M15 15l3 3"/>
        </svg>
        <input type="text" placeholder="Search suppliers, events…">
    </div>

    {{-- ── MESSAGES ── --}}
    <a href="{{ route('supplier.inquiries.inbox') }}" class="icon-btn" title="Messages">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
            <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/>
        </svg>
    </a>

    {{-- ── NOTIFICATIONS ── --}}
    <div class="notif-wrap">
        <button class="icon-btn" id="notifBtn" onclick="toggleNotif(event)" title="Notifications" aria-label="Notifications">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M10 2a6 6 0 016 6c0 3.5 1 5 2 6H2c1-1 2-2.5 2-6a6 6 0 016-6z"/>
                <path d="M8.5 18a1.5 1.5 0 003 0"/>
            </svg>
            @if($unreadCount > 0)
                <span class="notif-count">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
            @endif
        </button>

        {{-- Dropdown --}}
        <div class="notif-dropdown" id="notifDropdown" onclick="event.stopPropagation()">

            {{-- Header --}}
            <div class="notif-header">
                <div class="notif-header-l">
                    <span class="notif-header-title">Notif<em>ications</em></span>
                    @if($unreadCount > 0)
                        <span class="notif-unread-pill">{{ $unreadCount }} new</span>
                    @endif
                </div>
                @if($unreadCount > 0)
                    <button class="notif-mark-all" onclick="markAllRead(event)">
                        Mark all read
                    </button>
                @endif
            </div>

            {{-- List --}}
            <div class="notif-list">
                @forelse($notifications as $notif)
                @php
                    $isUnread = is_null($notif->read_at);
                    $title    = $notif->data['title']   ?? 'Notification';
                    $message  = $notif->data['message'] ?? '';
                    $url      = $notif->data['url']     ?? '#';
                    $type     = $notif->data['type']    ?? 'system';

                    // Icon class based on type
                    $iconClass = match($type) {
                        'booking','confirmed' => 'icon-booking',
                        'cancelled','rejected' => 'icon-cancel',
                        'message'             => 'icon-message',
                        default               => 'icon-system',
                    };
                @endphp
                <a href="{{ $url }}"
                   class="notif-item {{ $isUnread ? 'unread' : '' }}"
                   onclick="markAsRead(event, '{{ $notif->id }}')">

                    {{-- Icon --}}
                    <div class="notif-icon {{ $iconClass }}">
                        @if($type === 'booking' || $type === 'confirmed')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="4" width="16" height="14" rx="2"/><path d="M2 9h16M7 2v4M13 2v4"/></svg>
                        @elseif($type === 'cancelled' || $type === 'rejected')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="10" r="8"/><path d="M7 7l6 6M13 7l-6 6"/></svg>
                        @elseif($type === 'message')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/></svg>
                        @else
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M10 2a6 6 0 016 6c0 3.5 1 5 2 6H2c1-1 2-2.5 2-6a6 6 0 016-6z"/><path d="M8.5 18a1.5 1.5 0 003 0"/></svg>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="notif-content">
                        <div class="notif-title">{{ $title }}</div>
                        @if($message)
                            <div class="notif-msg">{{ $message }}</div>
                        @endif
                        <div class="notif-time">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="6" cy="6" r="4.5"/><path d="M6 3v3l2 1"/></svg>
                            {{ $notif->created_at->diffForHumans() }}
                        </div>
                    </div>

                    {{-- Unread dot --}}
                    @if($isUnread)
                        <div class="notif-dot"></div>
                    @endif

                </a>
                @empty
                <div class="notif-empty">
                    <div class="notif-empty-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                            <path d="M12 2a7 7 0 017 7c0 4.5 1.5 6 2.5 7H2.5C3.5 15 5 13.5 5 9a7 7 0 017-7z"/>
                            <path d="M9.5 21a2.5 2.5 0 005 0"/>
                            <line x1="12" y1="2" x2="12" y2="0"/>
                        </svg>
                    </div>
                    <div class="notif-empty-text">All caught up!</div>
                    <div class="notif-empty-sub">No notifications right now.</div>
                </div>
                @endforelse
            </div>

            {{-- Footer --}}
            @if($notifications->count() > 0)
            <div class="notif-footer">
                <a href="{{ route('notifications.index') }}" class="notif-see-all">
                    View all notifications
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 2l5 5-5 5"/></svg>
                </a>
            </div>
            @endif

        </div>
    </div>{{-- /notif-wrap --}}

    {{-- ── USER PILL ── --}}
    <div class="user-pill" tabindex="0">
        <div class="user-avatar">
            @if($authPhoto)
                <img src="{{ asset('storage/'.$authPhoto) }}" alt="{{ $authName }}">
            @else
                {{ $authInitials }}
            @endif
        </div>
        <span class="user-name">{{ $authName }}</span>
        <span class="user-role-chip">{{ $authRole }}</span>
        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M2 4l4 4 4-4"/>
        </svg>

        <div class="user-dropdown">
            <div class="dropdown-user-header">
                <div class="dropdown-user-avatar">
                    @if($authPhoto)
                        <img src="{{ asset('storage/'.$authPhoto) }}" alt="{{ $authName }}">
                    @else
                        {{ $authInitials }}
                    @endif
                </div>
                <div>
                    <div class="dropdown-user-name">{{ $authName }}</div>
                    <div class="dropdown-user-email">{{ Auth::user()->email ?? '' }}</div>
                </div>
            </div>

            <a href="{{ route('client.profile') ?? '#' }}" class="dropdown-item">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="8" cy="6" r="3"/><path d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6"/></svg>
                My Profile
            </a>
            <a href="#" class="dropdown-item">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="3" width="12" height="11" rx="1.5"/><path d="M2 7h12M5 2v2M11 2v2"/></svg>
                My Bookings
            </a>
            <a href="#" class="dropdown-item">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="8" cy="8" r="2.5"/><path d="M8 1v2M8 13v2M1 8h2M13 8h2M3.1 3.1l1.4 1.4M11.5 11.5l1.4 1.4M3.1 12.9l1.4-1.4M11.5 4.5l1.4-1.4"/></svg>
                Settings
            </a>
            <div class="dropdown-divider"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item danger">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M11 5l4 3-4 3M7 8h8M7 2H3a1 1 0 00-1 1v10a1 1 0 001 1h4"/></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </div>

</div>{{-- /topbar-right --}}
@else
<div class="topbar-right">

    

    {{-- ── SEARCH ── --}}
    <div class="topbar-search">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
            <circle cx="9" cy="9" r="6"/><path d="M15 15l3 3"/>
        </svg>
        <input type="text" placeholder="Search suppliers, events…">
    </div>

    {{-- ── MESSAGES ── --}}
    <a href="{{ route('client.inbox') }}" class="icon-btn" title="Messages">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
            <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/>
        </svg>
    </a>

    {{-- ── NOTIFICATIONS ── --}}
    <div class="notif-wrap">
        <button class="icon-btn" id="notifBtn" onclick="toggleNotif(event)" title="Notifications" aria-label="Notifications">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M10 2a6 6 0 016 6c0 3.5 1 5 2 6H2c1-1 2-2.5 2-6a6 6 0 016-6z"/>
                <path d="M8.5 18a1.5 1.5 0 003 0"/>
            </svg>
            @if($unreadCount > 0)
                <span class="notif-count">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
            @endif
        </button>

        {{-- Dropdown --}}
        <div class="notif-dropdown" id="notifDropdown" onclick="event.stopPropagation()">

            {{-- Header --}}
            <div class="notif-header">
                <div class="notif-header-l">
                    <span class="notif-header-title">Notif<em>ications</em></span>
                    @if($unreadCount > 0)
                        <span class="notif-unread-pill">{{ $unreadCount }} new</span>
                    @endif
                </div>
                @if($unreadCount > 0)
                    <button class="notif-mark-all" onclick="markAllRead(event)">
                        Mark all read
                    </button>
                @endif
            </div>

            {{-- List --}}
            <div class="notif-list">
                @forelse($notifications as $notif)
                @php
                    $isUnread = is_null($notif->read_at);
                    $title    = $notif->data['title']   ?? 'Notification';
                    $message  = $notif->data['message'] ?? '';
                    $url      = $notif->data['url']     ?? '#';
                    $type     = $notif->data['type']    ?? 'system';

                    // Icon class based on type
                    $iconClass = match($type) {
                        'booking','confirmed' => 'icon-booking',
                        'cancelled','rejected' => 'icon-cancel',
                        'message'             => 'icon-message',
                        default               => 'icon-system',
                    };
                @endphp
                <a href="{{ $url }}"
                   class="notif-item {{ $isUnread ? 'unread' : '' }}"
                   onclick="markAsRead(event, '{{ $notif->id }}')">

                    {{-- Icon --}}
                    <div class="notif-icon {{ $iconClass }}">
                        @if($type === 'booking' || $type === 'confirmed')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="4" width="16" height="14" rx="2"/><path d="M2 9h16M7 2v4M13 2v4"/></svg>
                        @elseif($type === 'cancelled' || $type === 'rejected')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="10" r="8"/><path d="M7 7l6 6M13 7l-6 6"/></svg>
                        @elseif($type === 'message')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/></svg>
                        @else
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M10 2a6 6 0 016 6c0 3.5 1 5 2 6H2c1-1 2-2.5 2-6a6 6 0 016-6z"/><path d="M8.5 18a1.5 1.5 0 003 0"/></svg>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="notif-content">
                        <div class="notif-title">{{ $title }}</div>
                        @if($message)
                            <div class="notif-msg">{{ $message }}</div>
                        @endif
                        <div class="notif-time">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="6" cy="6" r="4.5"/><path d="M6 3v3l2 1"/></svg>
                            {{ $notif->created_at->diffForHumans() }}
                        </div>
                    </div>

                    {{-- Unread dot --}}
                    @if($isUnread)
                        <div class="notif-dot"></div>
                    @endif

                </a>
                @empty
                <div class="notif-empty">
                    <div class="notif-empty-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                            <path d="M12 2a7 7 0 017 7c0 4.5 1.5 6 2.5 7H2.5C3.5 15 5 13.5 5 9a7 7 0 017-7z"/>
                            <path d="M9.5 21a2.5 2.5 0 005 0"/>
                            <line x1="12" y1="2" x2="12" y2="0"/>
                        </svg>
                    </div>
                    <div class="notif-empty-text">All caught up!</div>
                    <div class="notif-empty-sub">No notifications right now.</div>
                </div>
                @endforelse
            </div>

            {{-- Footer --}}
            @if($notifications->count() > 0)
            <div class="notif-footer">
                <a href="{{ route('notifications.index') }}" class="notif-see-all">
                    View all notifications
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 2l5 5-5 5"/></svg>
                </a>
            </div>
            @endif

        </div>
    </div>{{-- /notif-wrap --}}

    {{-- ── USER PILL ── --}}
    <div class="user-pill" tabindex="0">
        <div class="user-avatar">
            @if($authPhoto)
                <img src="{{ asset('storage/'.$authPhoto) }}" alt="{{ $authName }}">
            @else
                {{ $authInitials }}
            @endif
        </div>
        <span class="user-name">{{ $authName }}</span>
        <span class="user-role-chip">{{ $authRole }}</span>
        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M2 4l4 4 4-4"/>
        </svg>

        <div class="user-dropdown">
            <div class="dropdown-user-header">
                <div class="dropdown-user-avatar">
                    @if($authPhoto)
                        <img src="{{ asset('storage/'.$authPhoto) }}" alt="{{ $authName }}">
                    @else
                        {{ $authInitials }}
                    @endif
                </div>
                <div>
                    <div class="dropdown-user-name">{{ $authName }}</div>
                    <div class="dropdown-user-email">{{ Auth::user()->email ?? '' }}</div>
                </div>
            </div>

            <a href="{{ route('client.profile') ?? '#' }}" class="dropdown-item">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="8" cy="6" r="3"/><path d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6"/></svg>
                My Profile
            </a>
            <a href="#" class="dropdown-item">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="3" width="12" height="11" rx="1.5"/><path d="M2 7h12M5 2v2M11 2v2"/></svg>
                My Bookings
            </a>
            <a href="#" class="dropdown-item">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="8" cy="8" r="2.5"/><path d="M8 1v2M8 13v2M1 8h2M13 8h2M3.1 3.1l1.4 1.4M11.5 11.5l1.4 1.4M3.1 12.9l1.4-1.4M11.5 4.5l1.4-1.4"/></svg>
                Settings
            </a>
            <div class="dropdown-divider"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item danger">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M11 5l4 3-4 3M7 8h8M7 2H3a1 1 0 00-1 1v10a1 1 0 001 1h4"/></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </div>

</div>{{-- /topbar-right --}}

@endif            
<script>
    /* ── NOTIFICATION TOGGLE ── */
    function toggleNotif(e) {
        e.stopPropagation();
        const dd = document.getElementById('notifDropdown');
        const isOpen = dd.classList.toggle('open');
        // Close user dropdown if open
        if (isOpen) document.querySelector('.user-pill')?.blur();
    }

    /* ── CLOSE ON OUTSIDE CLICK ── */
    document.addEventListener('click', function (e) {
        const dd  = document.getElementById('notifDropdown');
        const btn = document.getElementById('notifBtn');
        if (dd && !dd.contains(e.target) && !btn.contains(e.target)) {
            dd.classList.remove('open');
        }
    });

    /* ── MARK SINGLE AS READ ── */
    function markAsRead(e, id) {
        e.preventDefault();
        const url = e.currentTarget.href;

        // Visually mark as read immediately
        e.currentTarget.classList.remove('unread');
        const dot = e.currentTarget.querySelector('.notif-dot');
        if (dot) dot.remove();

        fetch('/notifications/' + id + '/read', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).finally(() => {
            window.location.href = url;
        });
    }

    /* ── MARK ALL AS READ ── */
    function markAllRead(e) {
        e.stopPropagation();

        // Visually clear all unread immediately
        document.querySelectorAll('.notif-item.unread').forEach(el => {
            el.classList.remove('unread');
            el.querySelector('.notif-dot')?.remove();
        });
        document.querySelector('.notif-unread-pill')?.remove();
        document.querySelector('.notif-count')?.remove();

        fetch('/notifications/read-all', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).then(() => {
            // Hide mark-all button
            document.querySelector('.notif-mark-all')?.remove();
        });
    }
</script>