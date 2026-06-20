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
    <div class="msg-mobile-overlay" id="msgMobileOverlay" onclick="closeMobileMsg()"></div>

    <div class="msg-mobile-drawer" id="msgMobileDrawer">
        {{-- Drag handle --}}
        <div class="msg-drawer-handle"><span></span></div>

        {{-- Reuse the same inner content structure --}}
        <div class="msg-drop-head">
            <span class="msg-drop-title">Mess<em>ages</em></span>
            <div style="display:flex;align-items:center;gap:8px;">
                <div class="msg-drop-tabs">
                    <button class="msg-drop-tab active" data-msg-filter="all" onclick="mobileFilter(this)">All</button>
                    <button class="msg-drop-tab" data-msg-filter="unread" onclick="mobileFilter(this)">
                        Unread
                        @if ($unreadMessages > 0)
                            <span class="tab-unread-dot"></span>
                        @endif
                    </button>
                    <button class="msg-drop-tab" data-msg-filter="groups" onclick="mobileFilter(this)">Groups</button>
                </div>
                <button class="msg-drawer-close" onclick="closeMobileMsg()" aria-label="Close messages">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round">
                        <path d="M5 5l10 10M15 5L5 15" />
                    </svg>
                </button>
            </div>
        </div>

        @php
            $convs = \App\Models\Conversation::whereHas('participants', fn($q) => $q->where('user_id', auth()->id()))
                ->with(['participants.user.supplier', 'messages.sender'])
                ->latest()
                ->take(20)
                ->get();
        @endphp

        <div class="msg-list" id="msgMobileList">
            @forelse($convs as $conv)
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

                <a href="{{ route('messages.chat', $conv->id) }}" class="msg-item {{ $hasUnread ? 'has-unread' : '' }}"
                    data-msg-type="{{ $isGroup ? 'group' : 'direct' }}" data-msg-unread="{{ $hasUnread ? '1' : '0' }}">
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
                                    {{ \Illuminate\Support\Str::limit($lastMsg?->message ?? 'No messages yet', 42) }}
                                </span>
                            @endif
                            @if ($hasUnread)
                                <span class="msg-unread-pill">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
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
            <a href="{{ route('messages.inbox') }}" class="msg-compose-btn">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <path d="M7 2h6v6M13 2l-7 7M5 3H3a1 1 0 00-1 1v7a1 1 0 001 1h7a1 1 0 001-1V9" />
                </svg>
                Compose
            </a>
        </div>
    </div>
@elseif(auth()->user()->isSupplier())
    {{-- Backdrop --}}
    <div class="msg-mobile-overlay" id="msgMobileOverlay" onclick="closeMobileMsg()"></div>

    {{-- Slide-up drawer --}}
    <div class="msg-mobile-drawer" id="msgMobileDrawer" role="dialog" aria-modal="true" aria-label="Messages">

        {{-- Drag-handle bar --}}
        <div class="msg-drawer-handle"><span></span></div>

        {{-- Header --}}
        <div class="msg-drop-head">
            <span class="msg-drop-title">Mess<em>ages</em></span>
            <div style="display:flex;align-items:center;gap:8px;">
                {{-- Filter tabs --}}
                <div class="msg-drop-tabs">
                    <button class="msg-drop-tab active" data-msg-filter="all" onclick="mobileFilter(this)">All</button>
                    <button class="msg-drop-tab" data-msg-filter="unread" onclick="mobileFilter(this)">
                        Unread
                        @if (isset($unreadMessages) && $unreadMessages > 0)
                            <span class="tab-unread-dot"></span>
                        @endif
                    </button>
                    <button class="msg-drop-tab" data-msg-filter="groups" onclick="mobileFilter(this)">Groups</button>
                </div>
                {{-- Close button --}}
                <button class="msg-drawer-close" onclick="closeMobileMsg()" aria-label="Close messages">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2"
                        stroke-linecap="round">
                        <path d="M5 5l10 10M15 5L5 15" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Conversation list --}}
        @php
            $mobileConvs = \App\Models\Conversation::whereHas(
                'participants',
                fn($q) => $q->where('user_id', auth()->id()),
            )
                ->with(['participants.user.supplier', 'messages.sender'])
                ->latest()
                ->take(25)
                ->get();
        @endphp

        <div class="msg-list" id="msgMobileList">
            @forelse($mobileConvs as $conv)
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
                                    {{ \Illuminate\Support\Str::limit($lastMsg?->message ?? 'No messages yet', 44) }}
                                </span>
                            @endif
                            @if ($hasUnread)
                                <span class="msg-unread-pill">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
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
            <a href="{{ route('messages.inbox') }}" class="msg-compose-btn">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round">
                    <path d="M7 2h6v6M13 2l-7 7M5 3H3a1 1 0 00-1 1v7a1 1 0 001 1h7a1 1 0 001-1V9" />
                </svg>
                Compose
            </a>
        </div>
    </div>
@else
    <div class="msg-mobile-overlay" id="msgMobileOverlay" onclick="closeMobileMsg()"></div>

    <div class="msg-mobile-drawer" id="msgMobileDrawer" role="dialog" aria-modal="true" aria-label="Messages">

        {{-- Drag handle --}}
        <div class="msg-drawer-handle"><span></span></div>

        {{-- Header --}}
        <div class="msg-drop-head">
            <span class="msg-drop-title">Mess<em>ages</em></span>
            <div style="display:flex;align-items:center;gap:8px;">
                <div class="msg-drop-tabs">
                    <button class="msg-drop-tab active" data-msg-filter="all"
                        onclick="mobileFilter(this)">All</button>
                    <button class="msg-drop-tab" data-msg-filter="unread" onclick="mobileFilter(this)">
                        Unread
                        @if (isset($unreadMessages) && $unreadMessages > 0)
                            <span class="tab-unread-dot"></span>
                        @endif
                    </button>
                    <button class="msg-drop-tab" data-msg-filter="groups"
                        onclick="mobileFilter(this)">Groups</button>
                </div>
                <button class="msg-drawer-close" onclick="closeMobileMsg()" aria-label="Close messages">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2"
                        stroke-linecap="round">
                        <path d="M5 5l10 10M15 5L5 15" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Conversation list --}}
        @php
            $mobileConvs = \App\Models\Conversation::whereHas(
                'participants',
                fn($q) => $q->where('user_id', auth()->id()),
            )
                ->with(['participants.user.supplier', 'messages.sender'])
                ->latest()
                ->take(25)
                ->get();
        @endphp

        <div class="msg-list" id="msgMobileList">
            @forelse($mobileConvs as $conv)
                @php
                    $lastMsg = $conv->messages->last();
                    $isGroup = $conv->type === 'group';
                    if ($isGroup) {
                        $dName = $conv->title ?? 'Group Chat';
                        $aText = 'GR';
                        $aClass = 'is-group';
                        $pPrev = $conv->participants
                            ->take(3)
                            ->map(
                                fn($p) => $p->user->role === 'admin'
                                    ? 'Admin'
                                    : $p->user->supplierProfile->business_name ?? $p->user->name,
                            )
                            ->implode(', ');
                    } else {
                        $other = $conv->participants->where('user_id', '!=', auth()->id())->first()?->user;
                        $dName = $other?->supplierProfile?->business_name ?? ($other?->name ?? 'Unknown');
                        $aText = strtoupper(substr($dName, 0, 2));
                        $aClass = $other?->role === 'admin' ? 'is-admin' : '';
                        $pPrev = null;
                    }
                    $uCount = $conv->messages
                        ->where('sender_id', '!=', auth()->id())
                        ->where('is_read', false)
                        ->count();
                    $lTime = $lastMsg?->created_at;
                    $tStr = $lTime
                        ? ($lTime->isToday()
                            ? $lTime->format('g:i A')
                            : ($lTime->isYesterday()
                                ? 'Yesterday'
                                : $lTime->format('M d')))
                        : '';
                    $hasU = $uCount > 0;
                @endphp
                <a href="{{ route('messages.chat', $conv->id) }}" class="msg-item {{ $hasU ? 'has-unread' : '' }}"
                    data-msg-type="{{ $isGroup ? 'group' : 'direct' }}" data-msg-unread="{{ $hasU ? '1' : '0' }}">
                    <div class="msg-ava {{ $aClass }}">
                        {{ $aText }}
                        @if (!$isGroup)
                            <span class="ava-online"></span>
                        @endif
                    </div>
                    <div class="msg-body">
                        <div class="msg-row-top">
                            <span class="msg-name {{ $hasU ? 'bold' : '' }}">{{ $dName }}</span>
                            @if ($isGroup)
                                <span class="msg-type-badge group">Group</span>
                            @elseif($aClass === 'is-admin')
                                <span class="msg-type-badge admin">Admin</span>
                            @endif
                            @if ($tStr)
                                <span class="msg-time">{{ $tStr }}</span>
                            @endif
                        </div>
                        <div class="msg-row-bottom">
                            @if ($isGroup && $pPrev)
                                <span class="msg-participants">{{ $pPrev }}</span>
                            @else
                                <span class="msg-preview {{ $hasU ? 'bold' : '' }}">
                                    @if ($lastMsg && $lastMsg->sender_id == auth()->id())
                                        <span style="color:#B0AAA2;">You: </span>
                                    @endif
                                    {{ \Illuminate\Support\Str::limit($lastMsg?->message ?? 'No messages yet', 44) }}
                                </span>
                            @endif
                            @if ($hasU)
                                <span class="msg-unread-pill">{{ $uCount > 9 ? '9+' : $uCount }}</span>
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
            <a href="{{ route('messages.inbox') }}" class="msg-compose-btn">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round">
                    <path d="M7 2h6v6M13 2l-7 7M5 3H3a1 1 0 00-1 1v7a1 1 0 001 1h7a1 1 0 001-1V9" />
                </svg>
                Compose
            </a>
        </div>
    </div>
@endif
