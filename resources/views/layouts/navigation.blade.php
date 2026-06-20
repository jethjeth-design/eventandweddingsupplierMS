@php
    $authUser = Auth::user();
    $notifications = $authUser?->notifications()->latest()->take(8)->get() ?? collect();
    $unreadCount = $authUser?->unreadNotifications()->count() ?? 0;
    $authName = $authUser->name ?? 'User';
    $authInitials = strtoupper(substr($authName, 0, 2));
    $authRole = ucfirst($authUser->role ?? 'Client');
    $authPhoto = $authUser->clientProfile->photo ?? ($authUser->supplierProfile->photo ?? null);

    use App\Models\Message;

    $user = auth()->user();

    $unreadMessages = Message::whereHas('conversation.participants', function ($q) use ($user) {
        $q->where('user_id', $user->id);
    })
        ->where('sender_id', '!=', $user->id)
        ->where('is_read', false)
        ->count();
@endphp
@if (auth()->user()->isAdmin())
    <div class="topbar-right">

        {{-- Search --}}
        <div class="topbar-search">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="9" cy="9" r="6" />
                <path d="M15 15l3 3" />
            </svg>
            <input type="text" placeholder="Search suppliers, events…">
        </div>

        {{-- Messages --}}
        <div class="msg-wrap">

            {{-- Trigger button --}}
            <button class="msg-trigger {{ request()->routeIs('messages.*') ? 'is-active' : '' }}" id="msgBtn"
                onclick="toggleMsg(event)" title="Messages">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z" />
                </svg>

                @if ($unreadMessages > 0)
                    <span class="msg-badge">
                        {{ $unreadMessages > 99 ? '99+' : $unreadMessages }}
                    </span>
                @endif
            </button>

            {{-- Dropdown panel --}}
            <div class="msg-dropdown" id="msgDropdown" onclick="event.stopPropagation()">

                {{-- Head --}}
                <div class="msg-drop-head">
                    <span class="msg-drop-title">Mess<em>ages</em></span>
                    <div class="msg-drop-tabs">
                        <button class="msg-drop-tab active" data-msg-filter="all" onclick="msgFilter(this)">All</button>
                        <button class="msg-drop-tab" data-msg-filter="unread" onclick="msgFilter(this)">
                            Unread
                            @if ($unreadMessages > 0)
                                <span class="tab-unread-dot"></span>
                            @endif
                        </button>
                        <button class="msg-drop-tab" data-msg-filter="groups" onclick="msgFilter(this)">Groups</button>
                    </div>
                </div>

                {{-- Conversation list --}}
                @php
                    $conversations = \App\Models\Conversation::whereHas('participants', function ($q) {
                        $q->where('user_id', auth()->id());
                    })
                        ->with(['participants.user.supplier', 'messages.sender'])
                        ->latest()
                        ->take(12)
                        ->get();
                @endphp

                <div class="msg-list" id="msgList">

                    @forelse($conversations as $conv)
                        @php
                            $lastMsg = $conv->messages->last();
                            $isGroup = $conv->type === 'group';

                            if ($isGroup) {
                                $displayName = $conv->title ?? 'Group Chat';
                                $avaText = 'GR';
                                $avaClass = 'is-group';
                                $participantsPreview = $conv->participants
                                    ->take(3)
                                    ->map(function ($p) {
                                        $u = $p->user;
                                        if ($u->role === 'admin') {
                                            return 'Admin';
                                        }
                                        return $u->supplierProfile->business_name ?? $u->name;
                                    })
                                    ->implode(', ');
                            } else {
                                $other = $conv->participants->where('user_id', '!=', auth()->id())->first()?->user;
                                $displayName = $other?->supplierProfile?->business_name ?? ($other?->name ?? 'Unknown');
                                $avaText = strtoupper(substr($displayName, 0, 2));
                                $avaClass = $other?->role === 'admin' ? 'is-admin' : '';
                                $participantsPreview = null;
                            }

                            $unreadCount = $conv->messages
                                ->where('sender_id', '!=', auth()->id())
                                ->where('is_read', false)
                                ->count();

                            $lastTime = $lastMsg?->created_at;
                            $timeStr = $lastTime
                                ? ($lastTime->isToday()
                                    ? $lastTime->format('g:i A')
                                    : ($lastTime->isYesterday()
                                        ? 'Yesterday'
                                        : $lastTime->format('M d')))
                                : '';

                            $hasUnread = $unreadCount > 0;
                        @endphp

                        <a href="{{ route('messages.chat', $conv->id) }}"
                            class="msg-item {{ $hasUnread ? 'has-unread' : '' }}"
                            data-msg-type="{{ $isGroup ? 'group' : 'direct' }}"
                            data-msg-unread="{{ $hasUnread ? '1' : '0' }}">

                            {{-- Avatar --}}
                            <div class="msg-ava {{ $avaClass }}">
                                {{ $avaText }}
                                @if (!$isGroup)
                                    <span class="ava-online"></span>
                                @endif
                            </div>

                            {{-- Body --}}
                            <div class="msg-body">
                                <div class="msg-row-top">
                                    <span class="msg-name {{ $hasUnread ? 'bold' : '' }}">{{ $displayName }}</span>
                                    @if ($isGroup)
                                        <span class="msg-type-badge group">Group</span>
                                    @elseif($avaClass === 'is-admin')
                                        <span class="msg-type-badge admin">Admin</span>
                                    @endif
                                    @if ($timeStr)
                                        <span class="msg-time">{{ $timeStr }}</span>
                                    @endif
                                </div>

                                <div class="msg-row-bottom">
                                    @if ($isGroup && $participantsPreview)
                                        <span class="msg-participants">{{ $participantsPreview }}</span>
                                    @else
                                        <span class="msg-preview {{ $hasUnread ? 'bold' : '' }}">
                                            @if ($lastMsg && $lastMsg->sender_id == auth()->id())
                                                <span style="color:#B0AAA2;">You: </span>
                                            @endif
                                            {{ \Illuminate\Support\Str::limit($lastMsg?->message ?? 'No messages yet', 38) }}
                                        </span>
                                    @endif

                                    @if ($hasUnread)
                                        <span
                                            class="msg-unread-pill">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                                    @endif
                                </div>
                            </div>

                        </a>

                    @empty

                        <div class="msg-empty">
                            <div class="msg-empty-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                                    <path d="M4 4h16a2 2 0 012 2v8a2 2 0 01-2 2H7l-5 4V6a2 2 0 012-2z" />
                                </svg>
                            </div>
                            <div class="msg-empty-title">No convers<em>ations</em></div>
                            <div class="msg-empty-sub">Start a new chat to get going.</div>
                        </div>
                    @endforelse

                </div>

                {{-- Footer --}}
                <div class="msg-drop-foot">
                    <a href="{{ route('messages.inbox') }}" class="msg-see-all">
                        Open full inbox
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 2l5 5-5 5" />
                        </svg>
                    </a>
                
                </div>

            </div>
        </div>


        {{-- Notifications --}}
        <div class="notif-wrap">
            <button class="icon-btn" id="notifBtn" onclick="toggleNotif(event)" title="Notifications">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M10 2a6 6 0 016 6c0 3.5 1 5 2 6H2c1-1 2-2.5 2-6a6 6 0 016-6z" />
                    <path d="M8.5 18a1.5 1.5 0 003 0" />
                </svg>
                @if ($unreadCount > 0)
                    <span class="notif-count">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                @endif
            </button>

            <div class="notif-dropdown" id="notifDropdown" onclick="event.stopPropagation()">
                <div class="notif-header">
                    <div class="notif-header-l">
                        <span class="notif-header-title">Notif<em>ications</em></span>
                        @if ($unreadCount > 0)
                            <span class="notif-unread-pill">{{ $unreadCount }} new</span>
                        @endif
                    </div>
                    @if ($unreadCount > 0)
                        <button class="notif-mark-all" onclick="markAllRead(event)">Mark all read</button>
                    @endif
                </div>

                <div class="notif-list">
                    @forelse($notifications as $notif)
                        @php
                            $isUnread = is_null($notif->read_at);
                            $title = $notif->data['title'] ?? 'Notification';
                            $message = $notif->data['message'] ?? '';
                            $url = $notif->data['url'] ?? '#';
                            $type = $notif->data['type'] ?? 'system';
                            $iconClass = match ($type) {
                                'booking', 'confirmed' => 'icon-booking',
                                'cancelled', 'rejected' => 'icon-cancel',
                                'message' => 'icon-message',
                                default => 'icon-system',
                            };
                        @endphp
                        <a href="{{ $url }}" class="notif-item {{ $isUnread ? 'unread' : '' }}"
                            onclick="markAsRead(event, '{{ $notif->id }}')">
                            <div class="notif-icon {{ $iconClass }}">
                                @if ($type === 'booking' || $type === 'confirmed')
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                        stroke-width="1.7">
                                        <rect x="2" y="4" width="16" height="14" rx="2" />
                                        <path d="M2 9h16M7 2v4M13 2v4" />
                                    </svg>
                                @elseif($type === 'cancelled' || $type === 'rejected')
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                        stroke-width="1.7">
                                        <circle cx="10" cy="10" r="8" />
                                        <path d="M7 7l6 6M13 7l-6 6" />
                                    </svg>
                                @elseif($type === 'message')
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                        stroke-width="1.7">
                                        <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z" />
                                    </svg>
                                @else
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                        stroke-width="1.7">
                                        <path d="M10 2a6 6 0 016 6c0 3.5 1 5 2 6H2c1-1 2-2.5 2-6a6 6 0 016-6z" />
                                        <path d="M8.5 18a1.5 1.5 0 003 0" />
                                    </svg>
                                @endif
                            </div>
                            <div class="notif-content">
                                <div class="notif-title">{{ $title }}</div>
                                @if ($message)
                                    <div class="notif-msg">{{ $message }}</div>
                                @endif
                                <div class="notif-time">
                                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <circle cx="6" cy="6" r="4.5" />
                                        <path d="M6 3v3l2 1" />
                                    </svg>
                                    {{ $notif->created_at->diffForHumans() }}
                                </div>
                            </div>
                            @if ($isUnread)
                                <div class="notif-dot"></div>
                            @endif
                        </a>
                    @empty
                        <div class="notif-empty">
                            <div class="notif-empty-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                                    <path d="M12 2a7 7 0 017 7c0 4.5 1.5 6 2.5 7H2.5C3.5 15 5 13.5 5 9a7 7 0 017-7z" />
                                    <path d="M9.5 21a2.5 2.5 0 005 0" />
                                </svg>
                            </div>
                            <div class="notif-empty-text">All caught up!</div>
                            <div class="notif-empty-sub">No notifications right now.</div>
                        </div>
                    @endforelse
                </div>

                @if ($notifications->count() > 0)
                    <div class="notif-footer">
                        <a href="{{ route('notifications.index') }}" class="notif-see-all">
                            View all notifications
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 2l5 5-5 5" />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- User pill --}}
        <div class="user-pill" tabindex="0">
            <div class="user-avatar">
                @if ($authPhoto)
                    <img src="{{ asset('storage/' . $authPhoto) }}" alt="{{ $authName }}">
                @else
                    {{ $authInitials }}
                @endif
            </div>
            <span class="user-name">{{ $authName }}</span>
            <span class="user-role-chip">{{ $authRole }}</span>
            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M2 4l4 4 4-4" />
            </svg>

            <div class="user-dropdown">
                <div class="dropdown-user-header">
                    <div class="dropdown-user-avatar">
                        @if ($authPhoto)
                            <img src="{{ asset('storage/' . $authPhoto) }}" alt="{{ $authName }}">
                        @else
                            {{ $authInitials }}
                        @endif
                    </div>
                    <div>
                        <div class="dropdown-user-name">{{ $authName }}</div>
                        <div class="dropdown-user-email">{{ Auth::user()->email ?? '' }}</div>
                    </div>
                </div>
                <a href="{{ route('admin.profile') ?? '#' }}" class="dropdown-item">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="8" cy="6" r="3" />
                        <path d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6" />
                    </svg>
                    My Profile
                </a>
                <a href="{{ route('admin.bookings') }}" class="dropdown-item">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="2" y="3" width="12" height="11" rx="1.5" />
                        <path d="M2 7h12M5 2v2M11 2v2" />
                    </svg>
                    My Bookings
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item danger">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M11 5l4 3-4 3M7 8h8M7 2H3a1 1 0 00-1 1v10a1 1 0 001 1h4" />
                        </svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </div>

    </div>
@elseif(auth()->user()->isSupplier())
    <div class="topbar-right">

        {{-- Search --}}
        <div class="topbar-search">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="9" cy="9" r="6" />
                <path d="M15 15l3 3" />
            </svg>
            <input type="text" placeholder="Search…">
        </div>

        <div class="msg-wrap">

            {{-- Trigger button --}}
            <button class="msg-trigger {{ request()->routeIs('messages.*') ? 'is-active' : '' }}" id="msgBtn"
                onclick="toggleMsg(event)" title="Messages">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z" />
                </svg>

                @if ($unreadMessages > 0)
                    <span class="msg-badge">
                        {{ $unreadMessages > 99 ? '99+' : $unreadMessages }}
                    </span>
                @endif
            </button>

            {{-- Dropdown panel --}}
            <div class="msg-dropdown" id="msgDropdown" onclick="event.stopPropagation()">

                {{-- Head --}}
                <div class="msg-drop-head">
                    <span class="msg-drop-title">Mess<em>ages</em></span>
                    <div class="msg-drop-tabs">
                        <button class="msg-drop-tab active" data-msg-filter="all"
                            onclick="msgFilter(this)">All</button>
                        <button class="msg-drop-tab" data-msg-filter="unread" onclick="msgFilter(this)">
                            Unread
                            @if ($unreadMessages > 0)
                                <span class="tab-unread-dot"></span>
                            @endif
                        </button>
                        <button class="msg-drop-tab" data-msg-filter="groups"
                            onclick="msgFilter(this)">Groups</button>
                    </div>
                </div>

                {{-- Conversation list --}}
                @php
                    $conversations = \App\Models\Conversation::whereHas('participants', function ($q) {
                        $q->where('user_id', auth()->id());
                    })
                        ->with(['participants.user.supplier', 'messages.sender'])
                        ->latest()
                        ->take(12)
                        ->get();
                @endphp

                <div class="msg-list" id="msgList">

                    @forelse($conversations as $conv)
                        @php
                            $lastMsg = $conv->messages->last();
                            $isGroup = $conv->type === 'group';

                            if ($isGroup) {
                                $displayName = $conv->title ?? 'Group Chat';
                                $avaText = 'GR';
                                $avaClass = 'is-group';
                                $participantsPreview = $conv->participants
                                    ->take(3)
                                    ->map(function ($p) {
                                        $u = $p->user;
                                        if ($u->role === 'admin') {
                                            return 'Admin';
                                        }
                                        return $u->supplierProfile->business_name ?? $u->name;
                                    })
                                    ->implode(', ');
                            } else {
                                $other = $conv->participants->where('user_id', '!=', auth()->id())->first()?->user;
                                $displayName = $other?->supplierProfile?->business_name ?? ($other?->name ?? 'Unknown');
                                $avaText = strtoupper(substr($displayName, 0, 2));
                                $avaClass = $other?->role === 'admin' ? 'is-admin' : '';
                                $participantsPreview = null;
                            }

                            $unreadCount = $conv->messages
                                ->where('sender_id', '!=', auth()->id())
                                ->where('is_read', false)
                                ->count();

                            $lastTime = $lastMsg?->created_at;
                            $timeStr = $lastTime
                                ? ($lastTime->isToday()
                                    ? $lastTime->format('g:i A')
                                    : ($lastTime->isYesterday()
                                        ? 'Yesterday'
                                        : $lastTime->format('M d')))
                                : '';

                            $hasUnread = $unreadCount > 0;
                        @endphp

                        <a href="{{ route('messages.chat', $conv->id) }}"
                            class="msg-item {{ $hasUnread ? 'has-unread' : '' }}"
                            data-msg-type="{{ $isGroup ? 'group' : 'direct' }}"
                            data-msg-unread="{{ $hasUnread ? '1' : '0' }}">

                            {{-- Avatar --}}
                            <div class="msg-ava {{ $avaClass }}">
                                {{ $avaText }}
                                @if (!$isGroup)
                                    <span class="ava-online"></span>
                                @endif
                            </div>

                            {{-- Body --}}
                            <div class="msg-body">
                                <div class="msg-row-top">
                                    <span class="msg-name {{ $hasUnread ? 'bold' : '' }}">{{ $displayName }}</span>
                                    @if ($isGroup)
                                        <span class="msg-type-badge group">Group</span>
                                    @elseif($avaClass === 'is-admin')
                                        <span class="msg-type-badge admin">Admin</span>
                                    @endif
                                    @if ($timeStr)
                                        <span class="msg-time">{{ $timeStr }}</span>
                                    @endif
                                </div>

                                <div class="msg-row-bottom">
                                    @if ($isGroup && $participantsPreview)
                                        <span class="msg-participants">{{ $participantsPreview }}</span>
                                    @else
                                        <span class="msg-preview {{ $hasUnread ? 'bold' : '' }}">
                                            @if ($lastMsg && $lastMsg->sender_id == auth()->id())
                                                <span style="color:#B0AAA2;">You: </span>
                                            @endif
                                            {{ \Illuminate\Support\Str::limit($lastMsg?->message ?? 'No messages yet', 38) }}
                                        </span>
                                    @endif

                                    @if ($hasUnread)
                                        <span
                                            class="msg-unread-pill">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                                    @endif
                                </div>
                            </div>

                        </a>

                    @empty

                        <div class="msg-empty">
                            <div class="msg-empty-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                                    <path d="M4 4h16a2 2 0 012 2v8a2 2 0 01-2 2H7l-5 4V6a2 2 0 012-2z" />
                                </svg>
                            </div>
                            <div class="msg-empty-title">No convers<em>ations</em></div>
                            <div class="msg-empty-sub">Start a new chat to get going.</div>
                        </div>
                    @endforelse

                </div>

                {{-- Footer --}}
                <div class="msg-drop-foot">
                    <a href="{{ route('messages.inbox') }}" class="msg-see-all">
                        Open full inbox
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 2l5 5-5 5" />
                        </svg>
                    </a>
                
                </div>

            </div>
        </div>

        {{-- Notifications --}}
        <div class="notif-wrap">
            <button class="icon-btn" id="notifBtn" onclick="toggleNotif(event)" title="Notifications">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M10 2a6 6 0 016 6c0 3.5 1 5 2 6H2c1-1 2-2.5 2-6a6 6 0 016-6z" />
                    <path d="M8.5 18a1.5 1.5 0 003 0" />
                </svg>
                @if ($unreadCount > 0)
                    <span class="notif-count">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                @endif
            </button>

            <div class="notif-dropdown" id="notifDropdown" onclick="event.stopPropagation()">
                <div class="notif-header">
                    <div class="notif-header-l">
                        <span class="notif-header-title">Notif<em>ications</em></span>
                        @if ($unreadCount > 0)
                            <span class="notif-unread-pill">{{ $unreadCount }} new</span>
                        @endif
                    </div>
                    @if ($unreadCount > 0)
                        <button class="notif-mark-all" onclick="markAllRead(event)">Mark all read</button>
                    @endif
                </div>

                <div class="notif-list">
                    @forelse($notifications as $notif)
                        @php
                            $isUnread = is_null($notif->read_at);
                            $title = $notif->data['title'] ?? 'Notification';
                            $message = $notif->data['message'] ?? '';
                            $url = $notif->data['url'] ?? '#';
                            $type = $notif->data['type'] ?? 'system';
                            $iconClass = match ($type) {
                                'booking', 'confirmed' => 'icon-booking',
                                'cancelled', 'rejected' => 'icon-cancel',
                                'message' => 'icon-message',
                                default => 'icon-system',
                            };
                        @endphp
                        <a href="{{ $url }}" class="notif-item {{ $isUnread ? 'unread' : '' }}"
                            onclick="markAsRead(event, '{{ $notif->id }}')">
                            <div class="notif-icon {{ $iconClass }}">
                                @if ($type === 'booking' || $type === 'confirmed')
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                        stroke-width="1.7">
                                        <rect x="2" y="4" width="16" height="14" rx="2" />
                                        <path d="M2 9h16M7 2v4M13 2v4" />
                                    </svg>
                                @elseif($type === 'cancelled' || $type === 'rejected')
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                        stroke-width="1.7">
                                        <circle cx="10" cy="10" r="8" />
                                        <path d="M7 7l6 6M13 7l-6 6" />
                                    </svg>
                                @elseif($type === 'message')
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                        stroke-width="1.7">
                                        <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z" />
                                    </svg>
                                @else
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                        stroke-width="1.7">
                                        <path d="M10 2a6 6 0 016 6c0 3.5 1 5 2 6H2c1-1 2-2.5 2-6a6 6 0 016-6z" />
                                        <path d="M8.5 18a1.5 1.5 0 003 0" />
                                    </svg>
                                @endif
                            </div>
                            <div class="notif-content">
                                <div class="notif-title">{{ $title }}</div>
                                @if ($message)
                                    <div class="notif-msg">{{ $message }}</div>
                                @endif
                                <div class="notif-time">
                                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <circle cx="6" cy="6" r="4.5" />
                                        <path d="M6 3v3l2 1" />
                                    </svg>
                                    {{ $notif->created_at->diffForHumans() }}
                                </div>
                            </div>
                            @if ($isUnread)
                                <div class="notif-dot"></div>
                            @endif
                        </a>
                    @empty
                        <div class="notif-empty">
                            <div class="notif-empty-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                                    <path d="M12 2a7 7 0 017 7c0 4.5 1.5 6 2.5 7H2.5C3.5 15 5 13.5 5 9a7 7 0 017-7z" />
                                    <path d="M9.5 21a2.5 2.5 0 005 0" />
                                </svg>
                            </div>
                            <div class="notif-empty-text">All caught up!</div>
                            <div class="notif-empty-sub">No notifications right now.</div>
                        </div>
                    @endforelse
                </div>

                @if ($notifications->count() > 0)
                    <div class="notif-footer">
                        <a href="{{ route('notifications.index') }}" class="notif-see-all">
                            View all notifications
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 2l5 5-5 5" />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- User pill --}}
        <div class="user-pill" tabindex="0">
            <div class="user-avatar">
                @if ($authPhoto)
                    <img src="{{ asset('storage/' . $authPhoto) }}" alt="{{ $authName }}">
                @else
                    {{ $authInitials }}
                @endif
            </div>
            <span class="user-name">{{ $authName }}</span>
            <span class="user-role-chip">{{ $authRole }}</span>
            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M2 4l4 4 4-4" />
            </svg>

            <div class="user-dropdown">
                <div class="dropdown-user-header">
                    <div class="dropdown-user-avatar">
                        @if ($authPhoto)
                            <img src="{{ asset('storage/' . $authPhoto) }}" alt="{{ $authName }}">
                        @else
                            {{ $authInitials }}
                        @endif
                    </div>
                    <div>
                        <div class="dropdown-user-name">{{ $authName }}</div>
                        <div class="dropdown-user-email">{{ Auth::user()->email ?? '' }}</div>
                    </div>
                </div>
                <a href="{{ route('supplier.supplierprofile') ?? '#' }}" class="dropdown-item">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="8" cy="6" r="3" />
                        <path d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6" />
                    </svg>
                    My Profile
                </a>
                <a href="{{ route('supplier.bookings') }}" class="dropdown-item">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="2" y="3" width="12" height="11" rx="1.5" />
                        <path d="M2 7h12M5 2v2M11 2v2" />
                    </svg>
                    My Bookings
                </a>
                <a href="#" class="dropdown-item">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="8" cy="8" r="2.5" />
                        <path
                            d="M8 1v2M8 13v2M1 8h2M13 8h2M3.1 3.1l1.4 1.4M11.5 11.5l1.4 1.4M3.1 12.9l1.4-1.4M11.5 4.5l1.4-1.4" />
                    </svg>
                    Settings
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item danger">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M11 5l4 3-4 3M7 8h8M7 2H3a1 1 0 00-1 1v10a1 1 0 001 1h4" />
                        </svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </div>

    </div>{{-- /topbar-right --}}
@else
    {{-- Left: logo + desktop nav --}}
    <div class="topbar-left">
        <a href="{{ url('/') }}" class="topbar-logo">WES<em>TEAM</em></a>
        <div class="topbar-logo-divider"></div>
        <nav class="topbar-nav">
            <a href="{{ route('client.dashboard') }}"
                class="topbar-nav-item {{ request()->routeIs('client.dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M3 10L10 3l7 7M5 8v8h4v-5h2v5h4V8" />
                </svg>
                <span class="label">Dashboard</span>
            </a>

            <a href="{{ route('client.browse.suppliers') }}"
                class="topbar-nav-item {{ request()->routeIs('client.browse.suppliers') ? 'active' : '' }}">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="9" cy="8" r="4" />
                    <path d="M2 17c0-3.3 3.1-6 7-6" />
                    <path d="M17 14l-3-3-3 3M14 11v6" />
                </svg>
                <span class="label">Explore</span>
            </a>

            <a href="{{ route('client.events') }}"
                class="topbar-nav-item {{ request()->routeIs('client.events') ? 'active' : '' }}">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <rect x="3" y="4" width="14" height="13" rx="2" />
                    <path d="M7 2v4M13 2v4M3 9h14" />
                </svg>
                <span class="label">Events</span>
            </a>
            <a href="{{ route('client.bookings.index') }}"
                class="topbar-nav-item {{ request()->routeIs('client.bookings.index') ? 'active' : '' }}">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M9 12l2 2 4-4M7 3H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2h-2" />
                    <rect x="7" y="1" width="6" height="4" rx="1" />
                </svg>
                <span class="label">Bookings</span>
            </a>

            <a href="{{ route('client.bids.index') }}"
                class="topbar-nav-item {{ request()->routeIs('client.bids.index') ? 'active' : '' }}">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h5" />
                    <path d="M13 15h4m0 0v-4m0 4l-4-4" />
                </svg>
                <span class="label">Bids</span>
            </a>

            <a href="{{ route('client.timeline') }}"
                class="topbar-nav-item {{ request()->routeIs('client.timeline') ? 'active' : '' }}">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <circle cx="10" cy="10" r="8" />
                    <path d="M10 6v4l3 3" />
                </svg>
                <span class="label">Timeline</span>
            </a>

        </nav>
    </div>

    {{-- Right: search · messages · notifications · user pill · hamburger --}}
    <div class="topbar-right">

        <div class="topbar-search">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                <circle cx="9" cy="9" r="6" />
                <path d="M15 15l3 3" />
            </svg>
            <input type="text" placeholder="Search…" aria-label="Search">
        </div>

        {{-- ══ MESSAGES ══ --}}
        <div class="msg-wrap">
            <button class="msg-trigger {{ request()->routeIs('messages.*') ? 'is-active' : '' }}" id="msgBtn"
                onclick="toggleMsg(event)" title="Messages" aria-label="Messages">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z" />
                </svg>
                @if ($unreadMessages > 0)
                    <span class="msg-badge">{{ $unreadMessages > 99 ? '99+' : $unreadMessages }}</span>
                @endif
            </button>

            {{-- Desktop dropdown (hidden on mobile via CSS) --}}
            <div class="msg-dropdown" id="msgDropdown" onclick="event.stopPropagation()">
                <div class="msg-drop-head">
                    <span class="msg-drop-title">Mess<em>ages</em></span>
                    <div class="msg-drop-tabs">
                        <button class="msg-drop-tab active" data-msg-filter="all"
                            onclick="msgFilter(this)">All</button>
                        <button class="msg-drop-tab" data-msg-filter="unread" onclick="msgFilter(this)">
                            Unread
                            @if ($unreadMessages > 0)
                                <span class="tab-unread-dot"></span>
                            @endif
                        </button>
                        <button class="msg-drop-tab" data-msg-filter="groups"
                            onclick="msgFilter(this)">Groups</button>
                    </div>
                </div>

                @php
                    $conversations = \App\Models\Conversation::whereHas(
                        'participants',
                        fn($q) => $q->where('user_id', auth()->id()),
                    )
                        ->with(['participants.user.supplier', 'messages.sender'])
                        ->latest()
                        ->take(12)
                        ->get();
                @endphp

                <div class="msg-list" id="msgList">
                    @forelse($conversations as $conv)
                        @php
                            $lastMsg = $conv->messages->last();
                            $isGroup = $conv->type === 'group';
                            if ($isGroup) {
                                $displayName = $conv->title ?? 'Group Chat';
                                $avaText = 'GR';
                                $avaClass = 'is-group';
                                $participantsPreview = $conv->participants
                                    ->take(3)
                                    ->map(
                                        fn($p) => $p->user->role === 'admin'
                                            ? 'Admin'
                                            : $p->user->supplierProfile->business_name ?? $p->user->name,
                                    )
                                    ->implode(', ');
                            } else {
                                $other = $conv->participants->where('user_id', '!=', auth()->id())->first()?->user;
                                $displayName = $other?->supplierProfile?->business_name ?? ($other?->name ?? 'Unknown');
                                $avaText = strtoupper(substr($displayName, 0, 2));
                                $avaClass = $other?->role === 'admin' ? 'is-admin' : '';
                                $participantsPreview = null;
                            }
                            $unreadCount = $conv->messages
                                ->where('sender_id', '!=', auth()->id())
                                ->where('is_read', false)
                                ->count();
                            $lastTime = $lastMsg?->created_at;
                            $timeStr = $lastTime
                                ? ($lastTime->isToday()
                                    ? $lastTime->format('g:i A')
                                    : ($lastTime->isYesterday()
                                        ? 'Yesterday'
                                        : $lastTime->format('M d')))
                                : '';
                            $hasUnread = $unreadCount > 0;
                        @endphp
                        <a href="{{ route('messages.chat', $conv->id) }}"
                            class="msg-item {{ $hasUnread ? 'has-unread' : '' }}"
                            data-msg-type="{{ $isGroup ? 'group' : 'direct' }}"
                            data-msg-unread="{{ $hasUnread ? '1' : '0' }}">
                            <div class="msg-ava {{ $avaClass }}">
                                {{ $avaText }}
                                @if (!$isGroup)
                                    <span class="ava-online"></span>
                                @endif
                            </div>
                            <div class="msg-body">
                                <div class="msg-row-top">
                                    <span class="msg-name {{ $hasUnread ? 'bold' : '' }}">{{ $displayName }}</span>
                                    @if ($isGroup)
                                        <span class="msg-type-badge group">Group</span>
                                    @elseif($avaClass === 'is-admin')
                                        <span class="msg-type-badge admin">Admin</span>
                                    @endif
                                    @if ($timeStr)
                                        <span class="msg-time">{{ $timeStr }}</span>
                                    @endif
                                </div>
                                <div class="msg-row-bottom">
                                    @if ($isGroup && $participantsPreview)
                                        <span class="msg-participants">{{ $participantsPreview }}</span>
                                    @else
                                        <span class="msg-preview {{ $hasUnread ? 'bold' : '' }}">
                                            @if ($lastMsg && $lastMsg->sender_id == auth()->id())
                                                <span style="color:#B0AAA2;">You: </span>
                                            @endif
                                            {{ \Illuminate\Support\Str::limit($lastMsg?->message ?? 'No messages yet', 38) }}
                                        </span>
                                    @endif
                                    @if ($hasUnread)
                                        <span
                                            class="msg-unread-pill">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="msg-empty">
                            <div class="msg-empty-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                                    <path d="M4 4h16a2 2 0 012 2v8a2 2 0 01-2 2H7l-5 4V6a2 2 0 012-2z" />
                                </svg>
                            </div>
                            <div class="msg-empty-title">No convers<em>ations</em></div>
                            <div class="msg-empty-sub">Start a new chat to get going.</div>
                        </div>
                    @endforelse
                </div>

                <div class="msg-drop-foot">
                    <a href="{{ route('messages.inbox') }}" class="msg-see-all">
                        Open full inbox
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 2l5 5-5 5" />
                        </svg>
                    </a>
                
                </div>
            </div>
        </div>

        {{-- ══ NOTIFICATIONS ══ --}}
        <div class="notif-wrap">
            <button class="icon-btn" id="notifBtn" onclick="toggleNotif(event)" title="Notifications"
                aria-label="Notifications">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M10 2a6 6 0 016 6c0 3.5 1 5 2 6H2c1-1 2-2.5 2-6a6 6 0 016-6z" />
                    <path d="M8.5 18a1.5 1.5 0 003 0" />
                </svg>
                @if ($unreadCount > 0)
                    <span class="notif-count">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                @endif
            </button>

            <div class="notif-dropdown" id="notifDropdown" onclick="event.stopPropagation()">
                <div class="notif-header">
                    <div class="notif-header-l">
                        <span class="notif-header-title">Notif<em>ications</em></span>
                        @if ($unreadCount > 0)
                            <span class="notif-unread-pill">{{ $unreadCount }} new</span>
                        @endif
                    </div>
                    @if ($unreadCount > 0)
                        <button class="notif-mark-all" onclick="markAllRead(event)">Mark all read</button>
                    @endif
                </div>
                <div class="notif-list">
                    @forelse($notifications as $notif)
                        @php
                            $isUnread = is_null($notif->read_at);
                            $title = $notif->data['title'] ?? 'Notification';
                            $message = $notif->data['message'] ?? '';
                            $url = $notif->data['url'] ?? '#';
                            $type = $notif->data['type'] ?? 'system';
                            $iconClass = match ($type) {
                                'booking', 'confirmed' => 'icon-booking',
                                'cancelled', 'rejected' => 'icon-cancel',
                                'message' => 'icon-message',
                                default => 'icon-system',
                            };
                        @endphp
                        <a href="{{ $url }}" class="notif-item {{ $isUnread ? 'unread' : '' }}"
                            onclick="markAsRead(event, '{{ $notif->id }}')">
                            <div class="notif-icon {{ $iconClass }}">
                                @if ($type === 'booking' || $type === 'confirmed')
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                        stroke-width="1.7">
                                        <rect x="2" y="4" width="16" height="14" rx="2" />
                                        <path d="M2 9h16M7 2v4M13 2v4" />
                                    </svg>
                                @elseif($type === 'cancelled' || $type === 'rejected')
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                        stroke-width="1.7">
                                        <circle cx="10" cy="10" r="8" />
                                        <path d="M7 7l6 6M13 7l-6 6" />
                                    </svg>
                                @elseif($type === 'message')
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                        stroke-width="1.7">
                                        <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z" />
                                    </svg>
                                @else<svg viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                        stroke-width="1.7">
                                        <path d="M10 2a6 6 0 016 6c0 3.5 1 5 2 6H2c1-1 2-2.5 2-6a6 6 0 016-6z" />
                                        <path d="M8.5 18a1.5 1.5 0 003 0" />
                                    </svg>
                                @endif
                            </div>
                            <div class="notif-content">
                                <div class="notif-title">{{ $title }}</div>
                                @if ($message)
                                    <div class="notif-msg">{{ $message }}</div>
                                @endif
                                <div class="notif-time">
                                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <circle cx="6" cy="6" r="4.5" />
                                        <path d="M6 3v3l2 1" />
                                    </svg>
                                    {{ $notif->created_at->diffForHumans() }}
                                </div>
                            </div>
                            @if ($isUnread)
                                <div class="notif-dot"></div>
                            @endif
                        </a>
                    @empty
                        <div class="notif-empty">
                            <div class="notif-empty-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                                    <path d="M12 2a7 7 0 017 7c0 4.5 1.5 6 2.5 7H2.5C3.5 15 5 13.5 5 9a7 7 0 017-7z" />
                                    <path d="M9.5 21a2.5 2.5 0 005 0" />
                                </svg>
                            </div>
                            <div class="notif-empty-text">All caught up!</div>
                            <div class="notif-empty-sub">No notifications right now.</div>
                        </div>
                    @endforelse
                </div>
                @if ($notifications->count() > 0)
                    <div class="notif-footer">
                        <a href="{{ route('notifications.index') }}" class="notif-see-all">
                            View all notifications
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 2l5 5-5 5" />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- User pill --}}
        <div class="user-pill" tabindex="0">
            <div class="user-avatar">
                @if ($authPhoto)
                    <img src="{{ asset('storage/' . $authPhoto) }}"
                        alt="{{ $authName }}">@else{{ $authInitials }}
                @endif
            </div>
            <span class="user-name">{{ $authName }}</span>
            <span class="user-role-chip">{{ $authRole }}</span>
            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M2 4l4 4 4-4" />
            </svg>
            <div class="user-dropdown">
                <div class="dropdown-user-header">
                    <div class="dropdown-user-avatar">
                        @if ($authPhoto)
                            <img src="{{ asset('storage/' . $authPhoto) }}"
                                alt="{{ $authName }}">@else{{ $authInitials }}
                        @endif
                    </div>
                    <div>
                        <div class="dropdown-user-name">{{ $authName }}</div>
                        <div class="dropdown-user-email">{{ Auth::user()->email ?? '' }}</div>
                    </div>
                </div>
                <a href="{{ route('client.profile') ?? '#' }}"
                    class="dropdown-item {{ request()->routeIs('client.profile') ? 'active-page' : '' }}">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="8" cy="6" r="3" />
                        <path d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6" />
                    </svg>
                    My Profile
                </a>
                <a href="{{ route('client.bookings.index') }}"
                    class="dropdown-item {{ request()->is('client/bookings*') ? 'active-page' : '' }}">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="2" y="3" width="12" height="11" rx="1.5" />
                        <path d="M2 7h12M5 2v2M11 2v2" />
                    </svg>
                    My Bookings
                </a>
                <a href="#" class="dropdown-item">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="8" cy="8" r="2.5" />
                        <path
                            d="M8 1v2M8 13v2M1 8h2M13 8h2M3.1 3.1l1.4 1.4M11.5 11.5l1.4 1.4M3.1 12.9l1.4-1.4M11.5 4.5l1.4-1.4" />
                    </svg>
                    Settings
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item danger">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M11 5l4 3-4 3M7 8h8M7 2H3a1 1 0 00-1 1v10a1 1 0 001 1h4" />
                        </svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </div>

        {{-- Hamburger --}}
        <button class="hamburger-btn" id="hamburgerBtn" aria-label="Open menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>

    </div>{{-- /topbar-right --}}

    {{-- Mobile nav overlay + drawer (inside header for scoping) --}}
    <div class="mob-overlay" id="mobOverlay"></div>

    <div class="mobile-drawer" id="mobileDrawer" aria-hidden="true">

        <div class="mob-user-strip">
            <div class="mob-user-avatar">
                @if ($authPhoto)
                    <img src="{{ asset('storage/' . $authPhoto) }}"
                        alt="{{ $authName }}">@else{{ $authInitials }}
                @endif
            </div>
            <div class="mob-user-info">
                <div class="mob-user-name">{{ $authName }}</div>
                <div class="mob-user-role">{{ $authRole }}</div>
            </div>
        </div>

        <div class="mob-search-wrap">
            <div class="mob-search-inner">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="9" cy="9" r="6" />
                    <path d="M15 15l3 3" />
                </svg>
                <input type="text" placeholder="Search suppliers, events…" aria-label="Search">
            </div>
        </div>

        <div class="mob-nav-label">Navigation</div>

        <a href="{{ route('client.dashboard') }}"
            class="mob-nav-item {{ request()->routeIs('client.dashboard') ? 'active' : '' }}"
            onclick="closeMobDrawer()">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M3 10L10 3l7 7M5 8v8h4v-5h2v5h4V8" />
            </svg>
            Dashboard
        </a>
        <a href="{{ route('client.events') }}"
            class="mob-nav-item {{ request()->is('client/events*') ? 'active' : '' }}" onclick="closeMobDrawer()">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <rect x="3" y="4" width="14" height="13" rx="2" />
                <path d="M7 2v4M13 2v4M3 9h14" />
            </svg>
            Events <span class="mob-nav-badge">2</span>
        </a>
        <a href="{{ route('client.bookings.index') }}"
            class="mob-nav-item {{ request()->is('client/bookings*') ? 'active' : '' }}" onclick="closeMobDrawer()">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M9 12l2 2 4-4M7 3H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2h-2" />
                <rect x="7" y="1" width="6" height="4" rx="1" />
            </svg>
            Bookings <span class="mob-nav-badge">5</span>
        </a>
        <a href="{{ route('client.browse.suppliers') }}"
            class="mob-nav-item {{ request()->is('client/browse/suppliers*') ? 'active' : '' }}"
            onclick="closeMobDrawer()">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="9" cy="8" r="4" />
                <path d="M2 17c0-3.3 3.1-6 7-6" />
                <path d="M17 14l-3-3-3 3M14 11v6" />
            </svg>
            Explore Suppliers
        </a>
        <a href="{{ route('client.timeline') }}"
            class="mob-nav-item {{ request()->routeIs('client.timeline') ? 'active' : '' }}"
            onclick="closeMobDrawer()">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="10" cy="10" r="8" />
                <path d="M10 6v4l3 3" />
            </svg>
            Timeline
        </a>

        <div class="mob-divider"></div>
        <div class="mob-nav-label">Account</div>

        <a href="{{ route('client.profile') ?? '#' }}"
            class="mob-nav-item {{ request()->routeIs('client.profile') ? 'active' : '' }}"
            onclick="closeMobDrawer()">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                <path d="M3 18c0-3.3 3.1-6 7-6s7 2.7 7 6" />
            </svg>
            My Profile
        </a>
        <a href="#" class="mob-nav-item" onclick="closeMobDrawer()">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="10" cy="10" r="3" />
                <path
                    d="M10 2v2M10 16v2M2 10h2M16 10h2M4.2 4.2l1.4 1.4M14.4 14.4l1.4 1.4M4.2 15.8l1.4-1.4M14.4 5.6l1.4-1.4" />
            </svg>
            Settings
        </a>

        <div class="mob-divider"></div>
        <div class="mob-signout-row">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mob-signout-btn">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M13 5l4 5-4 5M8 10h9M8 3H5a1 1 0 00-1 1v12a1 1 0 001 1h3" />
                    </svg>
                    Sign Out
                </button>
            </form>
        </div>

    </div>{{-- /mobile-drawer --}}
@endif
