@php
    $notifications = auth()->user()->notifications()->latest()->paginate(15);
@endphp
<style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap');
        :root {
            --gold:#C9A84C; --gold-dark:#8A6A1F; --gold-light:rgba(201,168,76,0.10);
            --ivory:#FAF7F2; --charcoal:#1E1B18; --warm-grey:#706B65;
            --border:#E5DDD5; --border-md:#E0D8D0; --white:#FFFFFF;
            --unread-bg:rgba(201,168,76,0.06); --unread-bar:#C9A84C;
            --font-display:'Playfair Display',Georgia,serif;
            --font-body:'DM Sans',sans-serif;
        }

        /* ── Page wrapper ── */
        .notif-page { padding: 1.5rem; max-width: 820px; margin: 0 auto; }

        /* ── Top row ── */
        .notif-top { display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:.75rem; margin-bottom:1.4rem; }
        .notif-title { font-family:var(--font-display); font-size:1.65rem; font-weight:700; color:var(--charcoal); line-height:1.15; }
        .notif-title em { font-style:italic; color:var(--gold-dark); }
        .notif-subtitle { font-size:.76rem; color:var(--warm-grey); margin-top:.2rem; font-family:var(--font-body); }

        /* ── Toolbar ── */
        .notif-toolbar { display:flex; align-items:center; gap:.65rem; flex-wrap:wrap; margin-bottom:1rem; }
        .notif-badge { font-size:.65rem; font-weight:500; letter-spacing:.07em; text-transform:uppercase; color:var(--gold-dark); background:var(--gold-light); border:1px solid rgba(201,168,76,.3); padding:.28rem .75rem; border-radius:20px; white-space:nowrap; font-family:var(--font-body); }
        .notif-badge.unread { background:#FFF7E6; color:#92400E; border-color:#FCD34D; }

        .btn-mark-all {
            display:inline-flex; align-items:center; gap:.4rem;
            padding:.5rem 1.1rem;
            background:var(--charcoal); color:var(--white);
            border:none; border-radius:7px;
            font-size:.75rem; font-weight:600; letter-spacing:.04em; text-transform:uppercase;
            cursor:pointer; font-family:var(--font-body);
            transition:background .18s; position:relative; overflow:hidden;
            margin-left:auto;
        }
        .btn-mark-all::before {
            content:''; position:absolute; inset:0;
            background:linear-gradient(135deg,rgba(201,168,76,.18),transparent);
        }
        .btn-mark-all:hover { background:#2e2a26; }
        .btn-mark-all svg { width:13px; height:13px; position:relative; z-index:1; }
        .btn-mark-all span { position:relative; z-index:1; }
        .btn-mark-all.loading { opacity:.65; pointer-events:none; }

        /* ── Card shell ── */
        .notif-card {
            background:var(--white);
            border:1.5px solid var(--border);
            border-radius:14px;
            overflow:hidden;
            box-shadow:0 2px 14px rgba(30,27,24,.06);
        }
        .notif-card-bar {
            height:4px;
            background:linear-gradient(90deg,var(--gold-dark),var(--gold),rgba(201,168,76,.25));
        }

        /* ── Notification row ── */
        .notif-item {
            display:block;
            text-decoration:none;
            color:inherit;
            padding:1rem 1.25rem 1rem 1.4rem;
            border-bottom:1px solid var(--border);
            background:var(--white);
            position:relative;
            transition:background .15s;
        }
        .notif-item:last-child { border-bottom:none; }
        .notif-item:hover { background:rgba(201,168,76,.04); }

        /* Unread state */
        .notif-item.unread {
            background:var(--unread-bg);
        }
        .notif-item.unread::before {
            content:'';
            position:absolute; left:0; top:0; bottom:0;
            width:3px;
            background:var(--unread-bar);
            border-radius:0 2px 2px 0;
        }
        .notif-item.unread:hover { background:rgba(201,168,76,.1); }

        /* Inner layout */
        .notif-item-inner { display:flex; align-items:flex-start; gap:.9rem; }

        /* Icon bubble */
        .notif-icon {
            width:38px; height:38px; border-radius:10px; flex-shrink:0;
            display:flex; align-items:center; justify-content:center;
            background:var(--gold-light);
            border:1.5px solid rgba(201,168,76,.22);
            margin-top:1px;
        }
        .notif-icon svg { width:16px; height:16px; color:var(--gold-dark); }
        .notif-item.unread .notif-icon { background:rgba(201,168,76,.16); border-color:rgba(201,168,76,.35); }

        /* Content */
        .notif-content { flex:1; min-width:0; }
        .notif-item-title {
            font-family:var(--font-display); font-size:.92rem; font-weight:700;
            color:var(--charcoal); line-height:1.3; margin-bottom:.18rem;
        }
        .notif-item.unread .notif-item-title { color:var(--charcoal); }
        .notif-item-msg {
            font-size:.78rem; color:var(--warm-grey); line-height:1.55;
            font-family:var(--font-body); margin-bottom:.35rem;
        }
        .notif-item-time {
            display:inline-flex; align-items:center; gap:.3rem;
            font-size:.65rem; color:#B0A89E; font-family:var(--font-body);
        }
        .notif-item-time svg { width:10px; height:10px; flex-shrink:0; }

        /* Unread dot */
        .notif-unread-dot {
            width:8px; height:8px; border-radius:50%;
            background:var(--gold); flex-shrink:0; margin-top:6px;
        }

        /* ── Empty state ── */
        .notif-empty {
            text-align:center; padding:4rem 2rem;
            color:var(--warm-grey); font-family:var(--font-body);
        }
        .notif-empty svg { width:52px; height:52px; color:#DDD4C8; margin:0 auto 1rem; display:block; }
        .notif-empty-title { font-family:var(--font-display); font-size:1.1rem; color:var(--charcoal); margin-bottom:.3rem; font-weight:700; }
        .notif-empty-sub { font-size:.8rem; }

        /* ── Pagination ── */
        .notif-pagination { margin-top:1rem; display:flex; justify-content:flex-end; }

        /* ── Toast ── */
        .bv-toast {
            position:fixed; bottom:1.5rem; right:1.5rem; z-index:2000;
            background:var(--charcoal); color:var(--white);
            border-radius:9px; padding:.7rem 1.1rem;
            font-size:.78rem; font-family:var(--font-body);
            display:flex; align-items:center; gap:.5rem;
            box-shadow:0 8px 28px rgba(30,27,24,.22);
            transform:translateY(20px); opacity:0;
            transition:transform .25s ease, opacity .25s ease;
            pointer-events:none;
        }
        .bv-toast.show { transform:translateY(0); opacity:1; }
        .bv-toast svg { width:14px; height:14px; color:var(--gold); flex-shrink:0; }
    </style>
@if(auth()->user()->isAdmin())
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="notif-page">

        {{-- ── Top row ── --}}
        <div class="notif-top">
            <div>
                <h1 class="notif-title">My <em>Notifications</em></h1>
                <p class="notif-subtitle">Stay up to date with your bookings, messages, and updates</p>
            </div>
        </div>

        {{-- ── Toolbar ── --}}
        <div class="notif-toolbar">
            @php
                $unreadCount = $notifications->where('read_at', null)->count();
                $totalCount  = $notifications->total();
            @endphp

            <span class="notif-badge">
                {{ $totalCount }} notification{{ $totalCount !== 1 ? 's' : '' }}
            </span>

            @if($unreadCount > 0)
                <span class="notif-badge unread">
                    {{ $unreadCount }} unread
                </span>
            @endif

            <button class="btn-mark-all" id="markAllBtn" onclick="markAllRead()">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M2 8l4 4 8-8"/>
                </svg>
                <span>Mark all as read</span>
            </button>
        </div>

        {{-- ── Notifications card ── --}}
        <div class="notif-card">
            <div class="notif-card-bar"></div>

            @forelse($notifications as $notif)
            <a href="{{ $notif->data['url'] ?? '#' }}"
               id="notif-{{ $notif->id }}"
               onclick="markAsRead('{{ $notif->id }}', this)"
               class="notif-item {{ is_null($notif->read_at) ? 'unread' : '' }}">

                <div class="notif-item-inner">

                    {{-- Icon bubble --}}
                    <div class="notif-icon">
                        @php
                            $type = $notif->data['type'] ?? 'general';
                        @endphp
                        @if($type === 'booking')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M9 12l2 2 4-4M7 3H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2h-2"/>
                                <rect x="7" y="1" width="6" height="4" rx="1"/>
                            </svg>
                        @elseif($type === 'message')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/>
                            </svg>
                        @elseif($type === 'payment')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <rect x="2" y="5" width="16" height="11" rx="2"/>
                                <path d="M2 9h16M6 13h3"/>
                            </svg>
                        @elseif($type === 'event')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <rect x="3" y="4" width="14" height="13" rx="2"/>
                                <path d="M7 2v4M13 2v4M3 9h14"/>
                            </svg>
                        @else
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M10 2a6 6 0 016 6v2.5l1.5 2.5H2.5L4 10.5V8a6 6 0 016-6zM8.5 16a1.5 1.5 0 003 0"/>
                            </svg>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="notif-content">
                        <div class="notif-item-title">
                            {{ $notif->data['title'] ?? 'Notification' }}
                        </div>
                        @if(!empty($notif->data['message']))
                            <div class="notif-item-msg">
                                {{ $notif->data['message'] }}
                            </div>
                        @endif
                        <div class="notif-item-time">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <circle cx="8" cy="8" r="6"/>
                                <path d="M8 5v3.5l2 2"/>
                            </svg>
                            {{ $notif->created_at->diffForHumans() }}
                        </div>
                    </div>

                    {{-- Unread dot --}}
                    @if(is_null($notif->read_at))
                        <div class="notif-unread-dot" id="dot-{{ $notif->id }}"></div>
                    @endif

                </div>
            </a>
            @empty
            <div class="notif-empty">
                <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
                    <path d="M24 6a14 14 0 0114 14v6l3 5H7l3-5v-6A14 14 0 0124 6zM20 37a4 4 0 008 0"/>
                    <path d="M24 6V3"/>
                </svg>
                <div class="notif-empty-title">No notifications yet</div>
                <div class="notif-empty-sub">You're all caught up! Check back later for updates.</div>
            </div>
            @endforelse
        </div>

        {{-- ── Pagination ── --}}
        @if($notifications->hasPages())
        <div class="notif-pagination">
            {{ $notifications->links() }}
        </div>
        @endif

    </div>

    {{-- ── Toast ── --}}
    <div class="bv-toast" id="bvToast">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg>
        <span id="bvToastMsg">All notifications marked as read.</span>
    </div>

</x-app-layout>

@elseif(auth()->user()->isSupplier())
<x-supplier-layout>

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="notif-page">

        {{-- ── Top row ── --}}
        <div class="notif-top">
            <div>
                <h1 class="notif-title">My <em>Notifications</em></h1>
                <p class="notif-subtitle">Stay up to date with your bookings, messages, and updates</p>
            </div>
        </div>

        {{-- ── Toolbar ── --}}
        <div class="notif-toolbar">
            @php
                $unreadCount = $notifications->where('read_at', null)->count();
                $totalCount  = $notifications->total();
            @endphp

            <span class="notif-badge">
                {{ $totalCount }} notification{{ $totalCount !== 1 ? 's' : '' }}
            </span>

            @if($unreadCount > 0)
                <span class="notif-badge unread">
                    {{ $unreadCount }} unread
                </span>
            @endif

            <button class="btn-mark-all" id="markAllBtn" onclick="markAllRead()">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M2 8l4 4 8-8"/>
                </svg>
                <span>Mark all as read</span>
            </button>
        </div>

        {{-- ── Notifications card ── --}}
        <div class="notif-card">
            <div class="notif-card-bar"></div>

            @forelse($notifications as $notif)
            <a href="{{ $notif->data['url'] ?? '#' }}"
               id="notif-{{ $notif->id }}"
               onclick="markAsRead('{{ $notif->id }}', this)"
               class="notif-item {{ is_null($notif->read_at) ? 'unread' : '' }}">

                <div class="notif-item-inner">

                    {{-- Icon bubble --}}
                    <div class="notif-icon">
                        @php
                            $type = $notif->data['type'] ?? 'general';
                        @endphp
                        @if($type === 'booking')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M9 12l2 2 4-4M7 3H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2h-2"/>
                                <rect x="7" y="1" width="6" height="4" rx="1"/>
                            </svg>
                        @elseif($type === 'message')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/>
                            </svg>
                        @elseif($type === 'payment')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <rect x="2" y="5" width="16" height="11" rx="2"/>
                                <path d="M2 9h16M6 13h3"/>
                            </svg>
                        @elseif($type === 'event')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <rect x="3" y="4" width="14" height="13" rx="2"/>
                                <path d="M7 2v4M13 2v4M3 9h14"/>
                            </svg>
                        @else
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M10 2a6 6 0 016 6v2.5l1.5 2.5H2.5L4 10.5V8a6 6 0 016-6zM8.5 16a1.5 1.5 0 003 0"/>
                            </svg>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="notif-content">
                        <div class="notif-item-title">
                            {{ $notif->data['title'] ?? 'Notification' }}
                        </div>
                        @if(!empty($notif->data['message']))
                            <div class="notif-item-msg">
                                {{ $notif->data['message'] }}
                            </div>
                        @endif
                        <div class="notif-item-time">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <circle cx="8" cy="8" r="6"/>
                                <path d="M8 5v3.5l2 2"/>
                            </svg>
                            {{ $notif->created_at->diffForHumans() }}
                        </div>
                    </div>

                    {{-- Unread dot --}}
                    @if(is_null($notif->read_at))
                        <div class="notif-unread-dot" id="dot-{{ $notif->id }}"></div>
                    @endif

                </div>
            </a>
            @empty
            <div class="notif-empty">
                <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
                    <path d="M24 6a14 14 0 0114 14v6l3 5H7l3-5v-6A14 14 0 0124 6zM20 37a4 4 0 008 0"/>
                    <path d="M24 6V3"/>
                </svg>
                <div class="notif-empty-title">No notifications yet</div>
                <div class="notif-empty-sub">You're all caught up! Check back later for updates.</div>
            </div>
            @endforelse
        </div>

        {{-- ── Pagination ── --}}
        @if($notifications->hasPages())
        <div class="notif-pagination">
            {{ $notifications->links() }}
        </div>
        @endif

    </div>

    {{-- ── Toast ── --}}
    <div class="bv-toast" id="bvToast">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg>
        <span id="bvToastMsg">All notifications marked as read.</span>
    </div>

</x-supplier-layout>

@else
<x-client-layout>

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="notif-page">

        {{-- ── Top row ── --}}
        <div class="notif-top">
            <div>
                <h1 class="notif-title">My <em>Notifications</em></h1>
                <p class="notif-subtitle">Stay up to date with your bookings, messages, and updates</p>
            </div>
        </div>

        {{-- ── Toolbar ── --}}
        <div class="notif-toolbar">
            @php
                $unreadCount = $notifications->where('read_at', null)->count();
                $totalCount  = $notifications->total();
            @endphp

            <span class="notif-badge">
                {{ $totalCount }} notification{{ $totalCount !== 1 ? 's' : '' }}
            </span>

            @if($unreadCount > 0)
                <span class="notif-badge unread">
                    {{ $unreadCount }} unread
                </span>
            @endif

            <button class="btn-mark-all" id="markAllBtn" onclick="markAllRead()">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M2 8l4 4 8-8"/>
                </svg>
                <span>Mark all as read</span>
            </button>
        </div>

        {{-- ── Notifications card ── --}}
        <div class="notif-card">
            <div class="notif-card-bar"></div>

            @forelse($notifications as $notif)
            <a href="{{ $notif->data['url'] ?? '#' }}"
               id="notif-{{ $notif->id }}"
               onclick="markAsRead('{{ $notif->id }}', this)"
               class="notif-item {{ is_null($notif->read_at) ? 'unread' : '' }}">

                <div class="notif-item-inner">

                    {{-- Icon bubble --}}
                    <div class="notif-icon">
                        @php
                            $type = $notif->data['type'] ?? 'general';
                        @endphp
                        @if($type === 'booking')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M9 12l2 2 4-4M7 3H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2h-2"/>
                                <rect x="7" y="1" width="6" height="4" rx="1"/>
                            </svg>
                        @elseif($type === 'message')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/>
                            </svg>
                        @elseif($type === 'payment')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <rect x="2" y="5" width="16" height="11" rx="2"/>
                                <path d="M2 9h16M6 13h3"/>
                            </svg>
                        @elseif($type === 'event')
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <rect x="3" y="4" width="14" height="13" rx="2"/>
                                <path d="M7 2v4M13 2v4M3 9h14"/>
                            </svg>
                        @else
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M10 2a6 6 0 016 6v2.5l1.5 2.5H2.5L4 10.5V8a6 6 0 016-6zM8.5 16a1.5 1.5 0 003 0"/>
                            </svg>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="notif-content">
                        <div class="notif-item-title">
                            {{ $notif->data['title'] ?? 'Notification' }}
                        </div>
                        @if(!empty($notif->data['message']))
                            <div class="notif-item-msg">
                                {{ $notif->data['message'] }}
                            </div>
                        @endif
                        <div class="notif-item-time">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <circle cx="8" cy="8" r="6"/>
                                <path d="M8 5v3.5l2 2"/>
                            </svg>
                            {{ $notif->created_at->diffForHumans() }}
                        </div>
                    </div>

                    {{-- Unread dot --}}
                    @if(is_null($notif->read_at))
                        <div class="notif-unread-dot" id="dot-{{ $notif->id }}"></div>
                    @endif

                </div>
            </a>
            @empty
            <div class="notif-empty">
                <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
                    <path d="M24 6a14 14 0 0114 14v6l3 5H7l3-5v-6A14 14 0 0124 6zM20 37a4 4 0 008 0"/>
                    <path d="M24 6V3"/>
                </svg>
                <div class="notif-empty-title">No notifications yet</div>
                <div class="notif-empty-sub">You're all caught up! Check back later for updates.</div>
            </div>
            @endforelse
        </div>

        {{-- ── Pagination ── --}}
        @if($notifications->hasPages())
        <div class="notif-pagination">
            {{ $notifications->links() }}
        </div>
        @endif

    </div>

    {{-- ── Toast ── --}}
    <div class="bv-toast" id="bvToast">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg>
        <span id="bvToastMsg">All notifications marked as read.</span>
    </div>

</x-client-layout>

@endif    

<script>
        /* ── Mark single notification as read ── */
        function markAsRead(id, el) {
            // Visual: remove unread styling immediately (optimistic UI)
            if (el) {
                el.classList.remove('unread');
                var dot = document.getElementById('dot-' + id);
                if (dot) dot.remove();
            }

            fetch('/notifications/read/' + id, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            }).catch(function() {
                // silently fail — navigation will happen anyway
            });
        }

        /* ── Mark all as read ── */
        function markAllRead() {
            var btn = document.getElementById('markAllBtn');
            btn.classList.add('loading');
            btn.querySelector('span').textContent = 'Marking…';

            fetch('/notifications/read-all', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(function() {
                // Remove all unread styles immediately
                document.querySelectorAll('.notif-item.unread').forEach(function(el) {
                    el.classList.remove('unread');
                });
                document.querySelectorAll('.notif-unread-dot').forEach(function(d) { d.remove(); });

                // Update unread badge
                var unreadBadge = document.querySelector('.notif-badge.unread');
                if (unreadBadge) unreadBadge.remove();

                // Reset button
                btn.classList.remove('loading');
                btn.querySelector('span').textContent = 'Mark all as read';

                // Show toast
                showToast('All notifications marked as read.');
            })
            .catch(function() {
                btn.classList.remove('loading');
                btn.querySelector('span').textContent = 'Mark all as read';
                showToast('Something went wrong. Please try again.');
            });
        }

        /* ── Toast helper ── */
        function showToast(msg) {
            var t = document.getElementById('bvToast');
            document.getElementById('bvToastMsg').textContent = msg;
            t.classList.add('show');
            setTimeout(function() { t.classList.remove('show'); }, 3000);
        }
    </script>