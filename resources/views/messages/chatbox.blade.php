<style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap');
    
        :root {
            --gold:        #C9A84C;
            --gold-light:  #E8C97A;
            --gold-dark:   #8A6A1F;
            --blush-deep:  #D4A090;
            --ivory:       #FAF7F2;
            --charcoal:    #1E1B18;
            --warm-grey:   #6B6560;
            --white:       #FFFFFF;
            --border:      #F0EBE5;
            --border-md:   #E0D8D0;
            --font-display:'Playfair Display', Georgia, serif;
            --font-body:   'DM Sans', sans-serif;
        }
    
        * { box-sizing: border-box; }
        body { font-family: var(--font-body); background: var(--ivory); }
    
        /* ══════════════════════════════
        PAGE HEADER
        ══════════════════════════════ */
        .chat-page-header {
            background: var(--charcoal);
            padding: 1.5rem 2rem 1.25rem;
            position: relative; overflow: hidden;
        }
        .chat-page-header::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        .chat-page-header::after {
            content: '';
            position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }
        .cph-inner {
            position: relative; z-index: 1;
            display: flex; align-items: center; gap: 1rem;
        }
        .cph-back {
            width: 34px; height: 34px; border-radius: 3px;
            background: rgba(201,168,76,0.1); border: 1px solid rgba(201,168,76,0.2);
            display: flex; align-items: center; justify-content: center;
            color: var(--gold); cursor: pointer; text-decoration: none;
            transition: background 0.18s; flex-shrink: 0;
        }
        .cph-back:hover { background: rgba(201,168,76,0.2); }
        .cph-text { flex: 1; min-width: 0; }
        .cph-eyebrow {
            font-size: 0.6rem; letter-spacing: 0.18em; text-transform: uppercase;
            color: var(--gold); font-weight: 500; margin-bottom: 0.2rem;
            display: flex; align-items: center; gap: 0.45rem;
            font-family: var(--font-body);
        }
        .cph-eyebrow::before { content: ''; display: block; width: 14px; height: 1px; background: var(--gold); }
        .cph-title {
            font-family: var(--font-display);
            font-size: clamp(1rem, 2vw, 1.4rem);
            font-weight: 700; color: var(--white); line-height: 1.15;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .cph-title em { color: var(--gold-light); font-style: italic; }
        .cph-sub { font-size: 0.72rem; color: rgba(255,255,255,0.4); margin-top: 0.2rem; font-family: var(--font-body); }
    
        /* ══════════════════════════════
        CHAT WINDOW
        ══════════════════════════════ */
        .chat-window {
            max-width: 860px;
            margin: 1.5rem auto;
            background: var(--white);
            border: 1px solid var(--border-md);
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            height: calc(100vh - 200px);
            min-height: 500px;
            overflow: hidden;
            box-shadow: 0 2px 24px rgba(30,27,24,0.07);
            animation: fadeUp .38s ease both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    
        /* ── Chat header ── */
        .chat-win-head {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0.9rem 1.25rem;
            display: flex; align-items: center; gap: 0.85rem;
            flex-shrink: 0; position: relative;
        }
        .chat-win-head::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, var(--gold), var(--blush-deep));
        }
        .cwh-avatar {
            width: 44px; height: 44px; border-radius: 50%; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display); font-size: 1.05rem; font-weight: 700;
            background: var(--charcoal); color: var(--gold);
            border: 2px solid rgba(201,168,76,0.25); overflow: hidden;
        }
        .cwh-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .cwh-info { flex: 1; min-width: 0; }
        .cwh-name {
            font-family: var(--font-display); font-size: 0.98rem; font-weight: 600;
            color: var(--charcoal); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .cwh-sub { font-size: 0.7rem; color: var(--warm-grey); margin-top: 2px; font-family: var(--font-body); }
        .cwh-badge {
            font-size: 0.58rem; font-weight: 700; letter-spacing: 0.07em; text-transform: uppercase;
            padding: 3px 10px; border-radius: 2px;
            background: rgba(201,168,76,0.09); color: var(--gold-dark);
            border: 1px solid rgba(201,168,76,0.22); font-family: var(--font-body);
            white-space: nowrap; flex-shrink: 0;
        }
    
        /* ── Messages area ── */
        .chat-messages {
            flex: 1; overflow-y: auto;
            padding: 1.5rem 1.25rem;
            display: flex; flex-direction: column; gap: 0.65rem;
            background: var(--ivory);
        }
        .chat-messages::-webkit-scrollbar { width: 4px; }
        .chat-messages::-webkit-scrollbar-track { background: transparent; }
        .chat-messages::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }
        .chat-messages::-webkit-scrollbar-thumb:hover { background: var(--gold); }
    
        /* Date divider */
        .msg-date-divider {
            display: flex; align-items: center; gap: 0.75rem;
            font-size: 0.6rem; font-weight: 700; letter-spacing: 0.12em;
            text-transform: uppercase; color: var(--warm-grey); font-family: var(--font-body);
            margin: 0.25rem 0;
        }
        .msg-date-divider::before,
        .msg-date-divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }
    
        /* Message group */
        .msg-group {
            display: flex; align-items: flex-end; gap: 0.55rem;
            animation: msgIn .22s ease both;
        }
        @keyframes msgIn {
            from { opacity: 0; transform: translateY(5px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .msg-group.mine { flex-direction: row-reverse; }
    
        /* Mini avatar */
        .msg-avatar {
            width: 28px; height: 28px; border-radius: 50%; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display); font-size: 0.62rem; font-weight: 700;
            overflow: hidden;
        }
        .msg-avatar.theirs {
            background: var(--charcoal); color: var(--gold);
            border: 1.5px solid rgba(201,168,76,0.2);
        }
        .msg-avatar.mine {
            background: var(--gold); color: var(--charcoal);
            border: 1.5px solid rgba(201,168,76,0.3);
        }
        .msg-avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
    
        /* Bubble wrap */
        .bubble-wrap { display: flex; flex-direction: column; gap: 2px; max-width: 65%; }
        .msg-group.mine .bubble-wrap { align-items: flex-end; }
        .msg-group.theirs .bubble-wrap { align-items: flex-start; }
    
        /* Bubbles */
        .bubble {
            padding: 0.6rem 0.9rem;
            font-size: 0.865rem; line-height: 1.58;
            font-family: var(--font-body); word-break: break-word;
        }
        .bubble.theirs {
            background: var(--white);
            color: var(--charcoal);
            border: 1px solid var(--border);
            border-radius: 12px 12px 12px 3px;
        }
        .bubble.mine {
            background: var(--charcoal);
            color: var(--white);
            border-radius: 12px 12px 3px 12px;
        }
        .bubble-time {
            font-size: 0.6rem; color: var(--warm-grey);
            font-family: var(--font-body); padding: 0 0.2rem;
        }
    
        /* Empty state */
        .chat-empty {
            flex: 1; display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            text-align: center; padding: 3rem; gap: 0.75rem;
        }
        .chat-empty-icon {
            width: 60px; height: 60px; margin: 0 auto;
            background: var(--white); border: 1px solid var(--border-md);
            border-radius: 4px; display: flex; align-items: center; justify-content: center;
        }
        .chat-empty-icon svg { color: var(--gold); opacity: 0.4; }
        .chat-empty h4 {
            font-family: var(--font-display); font-size: 1.05rem;
            font-weight: 600; color: var(--charcoal); margin: 0;
        }
        .chat-empty p { font-size: 0.8rem; color: var(--warm-grey); font-family: var(--font-body); margin: 0; }
    
        /* ── Compose bar ── */
        .compose-bar {
            border-top: 1px solid var(--border);
            background: var(--white);
            padding: 0.85rem 1.25rem;
            flex-shrink: 0;
        }
        .compose-row {
            display: flex; gap: 0.65rem; align-items: flex-end;
        }
        .compose-input {
            flex: 1; border: 1px solid var(--border-md);
            border-radius: 20px;
            padding: 0.62rem 1.1rem;
            font-size: 0.875rem; font-family: var(--font-body);
            color: var(--charcoal); background: var(--ivory);
            outline: none; resize: none;
            min-height: 42px; max-height: 120px;
            line-height: 1.5;
            transition: border-color 0.18s, box-shadow 0.18s;
        }
        .compose-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
            background: var(--white);
        }
        .compose-input::placeholder { color: #B0A89E; }
    
        .compose-send {
            width: 40px; height: 40px; border-radius: 50%;
            background: var(--gold); border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            transition: background 0.18s, transform 0.15s;
        }
        .compose-send:hover { background: var(--gold-light); transform: scale(1.06); }
        .compose-send:active { transform: scale(0.96); }
        .compose-send svg { color: var(--charcoal); }
    
        .compose-hint {
            font-size: 0.63rem; color: var(--warm-grey);
            font-family: var(--font-body); text-align: right;
            margin-top: 0.4rem;
        }
    
        /* ── Mobile ── */
        @media (max-width: 640px) {
            .chat-window { margin: 0; border-radius: 0; border: none; height: 100dvh; min-height: unset; }
            .bubble-wrap { max-width: 80%; }
            .cwh-badge { display: none; }
            .chat-page-header { padding: 1.1rem 1rem; }
        }
    </style>

@if(auth()->user()->isSupplier())
<x-supplier-layout>
    
 
{{-- PAGE HEADER --}}
<div class="chat-page-header">
    <div class="cph-inner">
        <a href="javascript:history.back()" class="cph-back">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
        </a>
        <div class="cph-text">
            <div class="cph-eyebrow">
                @if(auth()->user()->isSupplier()) Supplier Dashboard @else Client Dashboard @endif
            </div>
            <div class="cph-title">
                Chat with <em>{{ $otherUserName ?? 'Supplier' }}</em>
            </div>
            <div class="cph-sub">
                @if(auth()->user()->isSupplier()) Replying as supplier @else Conversation with your supplier @endif
            </div>
        </div>
        <span class="cwh-badge">
            @if(auth()->user()->isSupplier()) Supplier View @else Client View @endif
        </span>
    </div>
</div>
 
{{-- CHAT WINDOW --}}
<div class="chat-window">
 
    {{-- HEADER --}}
    <div class="chat-win-head">
        <div class="cwh-avatar">
            {{ strtoupper(substr($otherUserName ?? 'S', 0, 2)) }}
        </div>
        <div class="cwh-info">
            <div class="cwh-name">{{ $otherUserName ?? 'Supplier' }}</div>
            <div class="cwh-sub">
                @if(auth()->user()->isSupplier()) Client @else Event Supplier @endif
            </div>
        </div>
        <span class="cwh-badge">Conversation</span>
    </div>
 
    {{-- MESSAGES --}}
    <div class="chat-messages" id="chat-messages">
 
        @forelse($messages as $msg)
 
            {{-- Date divider on day change --}}
            @if($loop->first || $msg->created_at->toDateString() !== $messages[$loop->index - 1]->created_at->toDateString())
                <div class="msg-date-divider">
                    <span>
                        @if($msg->created_at->isToday()) Today
                        @elseif($msg->created_at->isYesterday()) Yesterday
                        @else {{ $msg->created_at->format('M d, Y') }}
                        @endif
                    </span>
                </div>
            @endif
 
            @php $isMe = $msg->sender_id == auth()->id(); @endphp
 
            <div class="msg-group {{ $isMe ? 'mine' : 'theirs' }}">
 
                {{-- Avatar (theirs: left) --}}
                @if(!$isMe)
                <div class="msg-avatar theirs">
                    {{ strtoupper(substr($otherUserName ?? 'S', 0, 2)) }}
                </div>
                @endif
 
                <div class="bubble-wrap">
                    <div class="bubble {{ $isMe ? 'mine' : 'theirs' }}">{{ $msg->message }}</div>
                    <div class="bubble-time">{{ $msg->created_at->format('h:i A') }}</div>
                </div>
 
                {{-- Avatar (mine: right) --}}
                @if($isMe)
                <div class="msg-avatar mine">
                    {{ strtoupper(substr(auth()->user()->first_name ?? 'Me', 0, 2)) }}
                </div>
                @endif
 
            </div>
 
        @empty
            <div class="chat-empty">
                <div class="chat-empty-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                </div>
                <h4>No messages yet</h4>
                <p>Start the conversation below.</p>
            </div>
        @endforelse
 
    </div>
 
    {{-- COMPOSE BAR --}}
    <div class="compose-bar">
        <form method="POST" action="{{ route('chat.send') }}" id="chat-form">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $userId }}">
            <input type="hidden" name="supplier_id" value="{{ $supplierId }}">
 
            <div class="compose-row">
                <textarea
                    class="compose-input"
                    name="message"
                    id="compose-input"
                    placeholder="Write a message…"
                    rows="1"
                    required></textarea>
                <button type="submit" class="compose-send" title="Send">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"/>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                    </svg>
                </button>
            </div>
            <div class="compose-hint">Enter to send &middot; Shift+Enter for new line</div>
        </form>
    </div>
 
</div>
 

</x-supplier-layout>
@elseif(auth()->user()->isClient())
<x-client-layout>
    {{-- PAGE HEADER --}}
<div class="chat-page-header">
    <div class="cph-inner">
        <a href="javascript:history.back()" class="cph-back">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
        </a>
        <div class="cph-text">
            <div class="cph-eyebrow">
                @if(auth()->user()->isSupplier()) Supplier Dashboard @else Client Dashboard @endif
            </div>
            <div class="cph-title">
                Chat with <em>{{ $otherUserName ?? 'Supplier' }}</em>
            </div>
            <div class="cph-sub">
                @if(auth()->user()->isSupplier()) Replying as supplier @else Conversation with your supplier @endif
            </div>
        </div>
        <span class="cwh-badge">
            @if(auth()->user()->isSupplier()) Supplier View @else Client View @endif
        </span>
    </div>
</div>
 
{{-- CHAT WINDOW --}}
<div class="chat-window">
 
    {{-- HEADER --}}
    <div class="chat-win-head">
        <div class="cwh-avatar">
            {{ strtoupper(substr($otherUserName ?? 'S', 0, 2)) }}
        </div>
        <div class="cwh-info">
            <div class="cwh-name">{{ $otherUserName ?? 'Supplier' }}</div>
            <div class="cwh-sub">
                @if(auth()->user()->isSupplier()) Client @else Event Supplier @endif
            </div>
        </div>
        <span class="cwh-badge">Conversation</span>
    </div>
 
    {{-- MESSAGES --}}
    <div class="chat-messages" id="chat-messages">
 
        @forelse($messages as $msg)
 
            {{-- Date divider on day change --}}
            @if($loop->first || $msg->created_at->toDateString() !== $messages[$loop->index - 1]->created_at->toDateString())
                <div class="msg-date-divider">
                    <span>
                        @if($msg->created_at->isToday()) Today
                        @elseif($msg->created_at->isYesterday()) Yesterday
                        @else {{ $msg->created_at->format('M d, Y') }}
                        @endif
                    </span>
                </div>
            @endif
 
            @php $isMe = $msg->sender_id == auth()->id(); @endphp
 
            <div class="msg-group {{ $isMe ? 'mine' : 'theirs' }}">
 
                {{-- Avatar (theirs: left) --}}
                @if(!$isMe)
                <div class="msg-avatar theirs">
                    {{ strtoupper(substr($otherUserName ?? 'S', 0, 2)) }}
                </div>
                @endif
 
                <div class="bubble-wrap">
                    <div class="bubble {{ $isMe ? 'mine' : 'theirs' }}">{{ $msg->message }}</div>
                    <div class="bubble-time">{{ $msg->created_at->format('h:i A') }}</div>
                </div>
 
                {{-- Avatar (mine: right) --}}
                @if($isMe)
                <div class="msg-avatar mine">
                    {{ strtoupper(substr(auth()->user()->first_name ?? 'Me', 0, 2)) }}
                </div>
                @endif
 
            </div>
 
        @empty
            <div class="chat-empty">
                <div class="chat-empty-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                </div>
                <h4>No messages yet</h4>
                <p>Start the conversation below.</p>
            </div>
        @endforelse
 
    </div>
 
    {{-- COMPOSE BAR --}}
    <div class="compose-bar">
        <form method="POST" action="{{ route('chat.send') }}" id="chat-form">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $userId }}">
            <input type="hidden" name="supplier_id" value="{{ $supplierId }}">
 
            <div class="compose-row">
                <textarea
                    class="compose-input"
                    name="message"
                    id="compose-input"
                    placeholder="Write a message…"
                    rows="1"
                    required></textarea>
                <button type="submit" class="compose-send" title="Send">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"/>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                    </svg>
                </button>
            </div>
            <div class="compose-hint">Enter to send &middot; Shift+Enter for new line</div>
        </form>
    </div>
 
</div>
</x-client-layout>
@endif

<script>
    /* Auto-scroll to bottom */
    const msgBox = document.getElementById('chat-messages');
    if (msgBox) msgBox.scrollTop = msgBox.scrollHeight;
 
    /* Auto-grow textarea */
    const input = document.getElementById('compose-input');
    input.addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
    });
 
    /* Enter = send, Shift+Enter = new line */
    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            if (this.value.trim()) document.getElementById('chat-form').submit();
        }
    });
</script>