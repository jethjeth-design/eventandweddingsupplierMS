<x-client-layout>

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

    /* ══════════════════════════════════════════
       PAGE HEADER
    ══════════════════════════════════════════ */
    .inbox-header {
        background: var(--charcoal);
        padding: 1.75rem 2rem 1.5rem;
        position: relative; overflow: hidden;
    }
    .inbox-header::before {
        content: '';
        position: absolute; inset: 0;
        background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px);
        background-size: 20px 20px;
    }
    .inbox-header::after {
        content: '';
        position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }
    .ih-inner {
        position: relative; z-index: 1;
        display: flex; align-items: flex-end;
        justify-content: space-between; flex-wrap: wrap; gap: 1rem;
    }
    .ih-eyebrow {
        font-size: 0.62rem; letter-spacing: 0.2em; text-transform: uppercase;
        color: var(--gold); font-weight: 500; margin-bottom: 0.35rem;
        display: flex; align-items: center; gap: 0.5rem; font-family: var(--font-body);
    }
    .ih-eyebrow::before { content: ''; display: block; width: 18px; height: 1px; background: var(--gold); }
    .ih-title {
        font-family: var(--font-display);
        font-size: clamp(1.2rem, 2.5vw, 1.75rem);
        font-weight: 700; color: var(--white); line-height: 1.15;
    }
    .ih-title em { color: var(--gold-light); font-style: italic; }
    .ih-sub { font-size: 0.78rem; color: rgba(255,255,255,0.4); margin-top: 0.3rem; font-family: var(--font-body); }
    .ih-pill {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.65rem; font-weight: 600; letter-spacing: 0.07em; text-transform: uppercase;
        padding: 4px 12px; border-radius: 2px;
        color: var(--gold); background: rgba(201,168,76,0.12);
        border: 1px solid rgba(201,168,76,0.28); font-family: var(--font-body);
    }

    /* ══════════════════════════════════════════
       TWO-PANEL LAYOUT
    ══════════════════════════════════════════ */
    .inbox-body {
        display: grid;
        grid-template-columns: 310px 1fr;
        height: calc(100vh - 148px);
        overflow: hidden;
    }

    /* ══════════════════════════════════════════
       LEFT — CONVERSATION LIST
    ══════════════════════════════════════════ */
    .conv-list {
        background: var(--white);
        border-right: 1px solid var(--border);
        display: flex; flex-direction: column; overflow: hidden;
    }

    /* Search */
    .list-search {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid var(--border); flex-shrink: 0;
    }
    .search-inner {
        display: flex; align-items: center; gap: 0.5rem;
        background: var(--ivory); border: 1px solid var(--border-md);
        border-radius: 3px; padding: 0.42rem 0.75rem;
        transition: border-color 0.18s;
    }
    .search-inner:focus-within { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,0.08); }
    .search-inner svg { color: var(--warm-grey); opacity: 0.45; flex-shrink: 0; }
    .search-inner input {
        flex: 1; border: none; background: transparent; outline: none;
        font-size: 0.8rem; font-family: var(--font-body); color: var(--charcoal);
    }
    .search-inner input::placeholder { color: #B0A89E; }

    /* List header label */
    .list-head {
        padding: 0.55rem 1rem 0.35rem;
        font-size: 0.58rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase;
        color: var(--gold-dark); display: flex; align-items: center; gap: 0.45rem;
        font-family: var(--font-body); border-bottom: 1px solid var(--border);
        background: var(--white); flex-shrink: 0;
    }
    .list-head::after { content: ''; flex: 1; height: 1px; background: linear-gradient(90deg, var(--gold), transparent); }

    /* Scrollable area */
    .list-scroll { overflow-y: auto; flex: 1; }
    .list-scroll::-webkit-scrollbar { width: 4px; }
    .list-scroll::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }
    .list-scroll::-webkit-scrollbar-thumb:hover { background: var(--gold); }

    /* Conversation row */
    .conv-row {
        display: flex; align-items: center; gap: 0.75rem;
        padding: 0.9rem 1rem;
        border-bottom: 0.5px solid var(--border);
        cursor: pointer; position: relative;
        transition: background 0.15s;
    }
    .conv-row:hover { background: rgba(201,168,76,0.04); }
    .conv-row.active {
        background: rgba(201,168,76,0.09);
        border-right: 2.5px solid var(--gold);
    }
    .conv-row.unread { background: #FFFDF7; }
    .conv-row.unread:hover { background: rgba(201,168,76,0.07); }
    .conv-row.unread::before {
        content: '';
        position: absolute; top: 0; left: 0; bottom: 0; width: 2.5px;
        background: var(--gold);
    }

    /* Avatar */
    .c-avatar {
        width: 42px; height: 42px; border-radius: 50%; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display); font-size: 1rem; font-weight: 700;
        background: var(--charcoal); color: var(--gold);
        border: 2px solid rgba(201,168,76,0.2); overflow: hidden;
    }
    .c-avatar img { width: 100%; height: 100%; object-fit: cover; }

    /* Row text */
    .c-info { flex: 1; min-width: 0; }
    .c-row-top {
        display: flex; align-items: baseline;
        justify-content: space-between; gap: 0.3rem; margin-bottom: 2px;
    }
    .c-name {
        font-family: var(--font-display); font-size: 0.88rem; font-weight: 600;
        color: var(--charcoal); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .c-time { font-size: 0.62rem; color: var(--warm-grey); flex-shrink: 0; font-family: var(--font-body); }
    .c-preview {
        font-size: 0.72rem; color: var(--warm-grey);
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        font-family: var(--font-body); line-height: 1.4;
    }
    .c-row-foot { display: flex; align-items: center; gap: 0.35rem; margin-top: 3px; }
    .c-badge-supplier {
        font-size: 0.55rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase;
        padding: 1px 6px; border-radius: 2px;
        background: rgba(201,168,76,0.1); color: var(--gold-dark);
        border: 1px solid rgba(201,168,76,0.2); font-family: var(--font-body);
    }
    .unread-badge {
        min-width: 18px; height: 17px; padding: 0 4px;
        background: var(--gold); color: var(--charcoal);
        font-size: 0.62rem; font-weight: 700; border-radius: 99px;
        display: inline-flex; align-items: center; justify-content: center;
        font-family: var(--font-body); margin-left: auto;
    }

    /* Empty list */
    .list-empty {
        text-align: center; padding: 3rem 1.5rem;
        font-size: 0.8rem; color: var(--warm-grey); font-family: var(--font-body);
    }
    .list-empty svg { display: block; margin: 0 auto 0.75rem; opacity: 0.25; color: var(--gold-dark); }
    .list-empty h4 { font-family: var(--font-display); font-size: 1rem; color: var(--charcoal); margin-bottom: 0.3rem; }

    /* ══════════════════════════════════════════
       RIGHT — DETAIL PANEL
    ══════════════════════════════════════════ */
    .detail-panel {
        display: flex; flex-direction: column;
        background: var(--ivory); overflow: hidden;
    }

    /* ── Placeholder ── */
    .chat-placeholder {
        flex: 1; display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        text-align: center; padding: 3rem;
    }
    .chat-placeholder-icon {
        width: 64px; height: 64px; margin: 0 auto 1.25rem;
        background: var(--white); border: 1px solid var(--border-md);
        border-radius: 4px; display: flex; align-items: center; justify-content: center;
    }
    .chat-placeholder-icon svg { color: var(--gold); opacity: 0.4; }
    .chat-placeholder h3 {
        font-family: var(--font-display); font-size: 1.1rem; font-weight: 600;
        color: var(--charcoal); margin-bottom: 0.35rem;
    }
    .chat-placeholder p { font-size: 0.82rem; color: var(--warm-grey); font-family: var(--font-body); }

    /* ── Active convo wrapper ── */
    #active-convo { display: none; flex-direction: column; height: 100%; overflow: hidden; }

    /* ── Detail header (supplier info) ── */
    .dp-head {
        background: var(--white); border-bottom: 1px solid var(--border);
        padding: 0.9rem 1.25rem;
        display: flex; align-items: center; gap: 0.9rem;
        flex-shrink: 0; position: relative;
    }
    .dp-head::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, var(--gold), var(--blush-deep));
    }
    .dp-avatar {
        width: 46px; height: 46px; border-radius: 50%; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display); font-size: 1.1rem; font-weight: 700;
        background: var(--charcoal); color: var(--gold);
        border: 2px solid rgba(201,168,76,0.22); overflow: hidden;
    }
    .dp-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .dp-info { flex: 1; min-width: 0; }
    .dp-name {
        font-family: var(--font-display); font-size: 1rem; font-weight: 600;
        color: var(--charcoal); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .dp-role { font-size: 0.7rem; color: var(--warm-grey); margin-top: 1px; font-family: var(--font-body); }
    .dp-actions { display: flex; gap: 0.4rem; flex-shrink: 0; }

    /* Buttons */
    .btn-gold {
        padding: 0.38rem 0.9rem; background: var(--gold); color: var(--charcoal);
        border: none; border-radius: 2px; font-size: 0.7rem; font-weight: 600;
        letter-spacing: 0.04em; text-transform: uppercase; cursor: pointer;
        font-family: var(--font-body); text-decoration: none;
        display: inline-flex; align-items: center; gap: 4px;
        transition: background 0.18s; white-space: nowrap;
    }
    .btn-gold:hover { background: var(--gold-light); }
    .btn-outline {
        padding: 0.38rem 0.9rem; background: transparent; color: var(--warm-grey);
        border: 1px solid var(--border-md); border-radius: 2px;
        font-size: 0.7rem; font-weight: 500; text-transform: uppercase;
        cursor: pointer; font-family: var(--font-body); text-decoration: none;
        display: inline-flex; align-items: center; gap: 4px;
        transition: border-color 0.18s, color 0.18s; white-space: nowrap;
    }
    .btn-outline:hover { border-color: var(--gold); color: var(--gold-dark); }

    /* ── Supplier meta strip ── */
    .supplier-strip {
        background: var(--white); border-bottom: 1px solid var(--border);
        padding: 0.6rem 1.25rem;
        display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;
        flex-shrink: 0;
    }
    .ss-item {
        display: flex; align-items: center; gap: 0.35rem;
        font-size: 0.72rem; color: var(--warm-grey); font-family: var(--font-body);
    }
    .ss-item svg { color: var(--gold-dark); opacity: 0.7; flex-shrink: 0; }
    .ss-chip {
        font-size: 0.6rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase;
        padding: 2px 8px; border-radius: 2px;
        background: rgba(201,168,76,0.09); color: var(--gold-dark);
        border: 1px solid rgba(201,168,76,0.22); font-family: var(--font-body);
    }
    .ss-avail-yes { background: #F0FDF4; color: #15803D; border: 1px solid #BBF7D0; border-radius: 2px; padding: 2px 8px; font-size: 0.6rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; font-family: var(--font-body); }
    .ss-avail-no  { background: #FFFBEB; color: #B45309; border: 1px solid #FDE68A; border-radius: 2px; padding: 2px 8px; font-size: 0.6rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; font-family: var(--font-body); }

    /* Rating row */
    .rating-strip {
        display: none;
        background: var(--white); border-bottom: 1px solid var(--border);
        padding: 0.45rem 1.25rem; flex-shrink: 0;
        align-items: center; gap: 0.5rem;
    }
    .rating-strip.show { display: flex; }
    .star-row { display: inline-flex; gap: 1px; }
    .sf { color: var(--gold); font-size: 11px; }
    .se { color: #D8D0C8; font-size: 11px; }
    .rating-label { font-size: 0.68rem; color: var(--warm-grey); font-family: var(--font-body); }
    .rating-val { font-size: 0.72rem; font-weight: 600; color: var(--charcoal); font-family: var(--font-body); }

    /* ══════════════════════════════════════════
       CHAT MESSAGES
    ══════════════════════════════════════════ */
    .chat-messages {
        flex: 1; overflow-y: auto;
        padding: 1.25rem;
        display: flex; flex-direction: column; gap: 0.6rem;
        background: var(--ivory);
    }
    .chat-messages::-webkit-scrollbar { width: 4px; }
    .chat-messages::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }
    .chat-messages::-webkit-scrollbar-thumb:hover { background: var(--gold); }

    /* Date divider */
    .msg-date-divider {
        display: flex; align-items: center; gap: 0.75rem;
        font-size: 0.6rem; font-weight: 700; letter-spacing: 0.12em;
        text-transform: uppercase; color: var(--warm-grey); font-family: var(--font-body);
        margin: 0.2rem 0;
    }
    .msg-date-divider::before,
    .msg-date-divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }

    /* Message group */
    .msg-group {
        display: flex; align-items: flex-end; gap: 0.5rem;
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
    }
    .msg-avatar.theirs { background: var(--charcoal); color: var(--gold); border: 1.5px solid rgba(201,168,76,0.2); }
    .msg-avatar.mine   { background: var(--gold); color: var(--charcoal); border: 1.5px solid rgba(201,168,76,0.3); }

    /* Bubble wrap */
    .bubble-wrap { display: flex; flex-direction: column; gap: 2px; max-width: 65%; }
    .msg-group.mine   .bubble-wrap { align-items: flex-end; }
    .msg-group.theirs .bubble-wrap { align-items: flex-start; }

    /* Bubbles */
    .bubble {
        padding: 0.62rem 0.9rem;
        font-size: 0.86rem; line-height: 1.58;
        font-family: var(--font-body); word-break: break-word;
    }
    .bubble.theirs {
        background: var(--white); color: var(--charcoal);
        border: 1px solid var(--border);
        border-radius: 12px 12px 12px 3px;
    }
    .bubble.mine {
        background: var(--charcoal); color: var(--white);
        border-radius: 12px 12px 3px 12px;
    }
    .bubble-time { font-size: 0.6rem; color: var(--warm-grey); font-family: var(--font-body); padding: 0 0.2rem; }

    /* Chat empty */
    .chat-msgs-empty {
        flex: 1; display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        text-align: center; gap: 0.75rem; padding: 2rem;
    }
    .chat-msgs-empty-icon {
        width: 56px; height: 56px; background: var(--white);
        border: 1px solid var(--border-md); border-radius: 4px;
        display: flex; align-items: center; justify-content: center;
    }
    .chat-msgs-empty-icon svg { color: var(--gold); opacity: 0.35; }
    .chat-msgs-empty h4 { font-family: var(--font-display); font-size: 1rem; font-weight: 600; color: var(--charcoal); margin: 0; }
    .chat-msgs-empty p  { font-size: 0.78rem; color: var(--warm-grey); font-family: var(--font-body); margin: 0; }

    /* ══════════════════════════════════════════
       COMPOSE BAR
    ══════════════════════════════════════════ */
    .compose-bar {
        border-top: 1px solid var(--border);
        background: var(--white);
        padding: 0.85rem 1.25rem;
        flex-shrink: 0;
    }
    .compose-row { display: flex; gap: 0.65rem; align-items: flex-end; }
    .compose-input {
        flex: 1; border: 1px solid var(--border-md); border-radius: 20px;
        padding: 0.62rem 1.1rem;
        font-size: 0.875rem; font-family: var(--font-body);
        color: var(--charcoal); background: var(--ivory);
        outline: none; resize: none;
        min-height: 42px; max-height: 120px; line-height: 1.5;
        transition: border-color 0.18s, box-shadow 0.18s;
    }
    .compose-input:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,0.1); background: var(--white); }
    .compose-input::placeholder { color: #B0A89E; }
    .compose-send {
        width: 40px; height: 40px; border-radius: 50%;
        background: var(--gold); border: none; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; transition: background 0.18s, transform 0.15s;
    }
    .compose-send:hover  { background: var(--gold-light); transform: scale(1.06); }
    .compose-send:active { transform: scale(0.96); }
    .compose-send svg { color: var(--charcoal); }
    .compose-hint { font-size: 0.63rem; color: var(--warm-grey); font-family: var(--font-body); text-align: right; margin-top: 0.4rem; }

    /* ══════════════════════════════════════════
       REVEAL ANIMATION
    ══════════════════════════════════════════ */
    .reveal { opacity: 0; transform: translateY(10px); transition: opacity 0.38s ease, transform 0.38s ease; }
    .reveal.visible { opacity: 1; transform: none; }

    /* ══════════════════════════════════════════
       RESPONSIVE
    ══════════════════════════════════════════ */
    @media (max-width: 768px) {
        .inbox-body { grid-template-columns: 1fr; height: auto; }
        .conv-list { max-height: 42vh; border-right: none; border-bottom: 1px solid var(--border); }
        .detail-panel { min-height: 58vh; }
        #active-convo { min-height: 58vh; }
        .bubble-wrap { max-width: 80%; }
        .dp-actions .btn-outline { display: none; }
        .inbox-header { padding: 1.25rem 1rem 1rem; }
    }
</style>

{{-- ── PAGE HEADER ── --}}
<div class="inbox-header">
    <div class="ih-inner">
        <div>
            <div class="ih-eyebrow">Client Dashboard</div>
            <div class="ih-title">My <em>Inbox</em></div>
            <div class="ih-sub">Your conversations with suppliers.</div>
        </div>
        @php $totalUnread = isset($conversations) ? $conversations->sum('unread_count') : 0; @endphp
        @if($totalUnread)
        <span class="ih-pill">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
            {{ $totalUnread }} unread
        </span>
        @endif
    </div>
</div>

{{-- ── TWO-PANEL BODY ── --}}
<div class="inbox-body">

    {{-- ════════════════════════════
         LEFT: CONVERSATION LIST
    ════════════════════════════ --}}
    <div class="conv-list">

        <div class="list-search">
            <div class="search-inner">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                </svg>
                <input type="text" placeholder="Search suppliers…" oninput="filterConvs(this.value)">
            </div>
        </div>

        <div class="list-head">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
            Conversations
        </div>

        <div class="list-scroll" id="conv-scroll">
            @forelse($conversations as $conv)
            @php
                $otherUser   = $conv->sender_id == auth()->id() ? $conv->receiver : $conv->sender;
                $supplier    = $otherUser->supplierProfile ?? null;
                $isUnread    = ($conv->unread_count ?? 0) > 0;
                $initials    = strtoupper(substr($otherUser->name ?? 'S', 0, 2));
                $convId      = $conv->id ?? $loop->index;
                $chatRoute   = route('chat', [$otherUser->id, $conv->supplier_id]);
                $otherName   = $supplier->business_name ?? $otherUser->name ?? 'Supplier';
                $roleLine    = $otherUser->name . ($supplier && $supplier->category ? ' · ' . $supplier->category : '');
            @endphp
            <div class="conv-row reveal {{ $isUnread ? 'unread' : '' }}"
                 id="conv-row-{{ $convId }}"
                 data-name="{{ strtolower($otherUser->name ?? '') }} {{ strtolower($supplier->business_name ?? '') }}"
                 onclick="openConversation(
                     '{{ $convId }}',
                     '{{ addslashes($otherName) }}',
                     '{{ addslashes($roleLine) }}',
                     '{{ addslashes($supplier->category ?? '') }}',
                     '{{ addslashes(collect([$supplier->city ?? '', $supplier->province ?? ''])->filter()->implode(', ')) }}',
                     '{{ addslashes($supplier->phone ?? '') }}',
                     {{ (float)($supplier->rating ?? 0) }},
                     {{ $supplier && $supplier->is_available ? 1 : 0 }},
                     {{ (float)($supplier->price ?? 0) }},
                     {{ $conv->unread_count ?? 0 }},
                     '{{ $chatRoute }}',
                     '{{ addslashes($initials) }}'
                 )">

                <div class="c-avatar">
                    @if($otherUser->photo ?? false)
                        <img src="{{ asset('storage/'.$otherUser->photo) }}" alt="">
                    @else
                        {{ $initials }}
                    @endif
                </div>
                <div class="c-info">
                    <div class="c-row-top">
                        <div class="c-name">{{ $otherName }}</div>
                        <span class="c-time">{{ $conv->created_at?->diffForHumans(null, true) }}</span>
                    </div>
                    <div class="c-preview">{{ $conv->message ?? 'Tap to open chat' }}</div>
                    <div class="c-row-foot">
                        @if($supplier && $supplier->category)
                            <span class="c-badge-supplier">{{ $supplier->category }}</span>
                        @endif
                        @if($isUnread)
                            <span class="unread-badge">{{ $conv->unread_count }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="list-empty">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
                <h4>No conversations yet</h4>
                <p>Start by browsing suppliers and sending an inquiry.</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- ════════════════════════════
         RIGHT: DETAIL + CHAT
    ════════════════════════════ --}}
    <div class="detail-panel" id="detail-panel">

        {{-- Placeholder --}}
        <div class="chat-placeholder" id="chat-placeholder">
            <div class="chat-placeholder-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
            </div>
            <h3>Select a conversation</h3>
            <p>Choose a supplier from the list to view your messages and their profile details.</p>
        </div>

        {{-- Active conversation --}}
        <div id="active-convo">

            {{-- Supplier header --}}
            <div class="dp-head">
                <div class="dp-avatar" id="dp-avatar">S</div>
                <div class="dp-info">
                    <div class="dp-name" id="dp-name">Supplier</div>
                    <div class="dp-role" id="dp-role">Event Supplier</div>
                </div>
                <div class="dp-actions">
                    <a id="dp-open-chat" href="#" class="btn-gold">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                        Open Chat
                    </a>
                    <button class="btn-outline" onclick="closeDetail()">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                        Close
                    </button>
                </div>
            </div>

            {{-- Supplier meta strip --}}
            <div class="supplier-strip" id="supplier-strip">
                <span class="ss-item" id="ss-location" style="display:none;">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                    </svg>
                    <span id="ss-location-text"></span>
                </span>
                <span class="ss-item" id="ss-phone" style="display:none;">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.71 3.35 2 2 0 0 1 3.68 1.14h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 8.91A16 16 0 0 0 14 14.91l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                    <span id="ss-phone-text"></span>
                </span>
                <span id="ss-category" class="ss-chip" style="display:none;"></span>
                <span id="ss-avail" style="display:none;"></span>
                <span class="ss-item" id="ss-price" style="display:none;">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="1" x2="12" y2="23"/>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                    </svg>
                    From <strong id="ss-price-text" style="margin-left:2px;"></strong>
                </span>
            </div>

            {{-- Rating strip --}}
            <div class="rating-strip" id="rating-strip">
                <span class="rating-label">Rating:</span>
                <span class="star-row" id="dp-stars"></span>
                <span class="rating-val" id="dp-rating-val"></span>
            </div>

            {{-- ── MESSAGES ── --}}
            <div class="chat-messages" id="chat-messages">

                @forelse($messages as $msg)

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
                        @if(!$isMe)
                        <div class="msg-avatar theirs" id="msg-avatar-them">
                            {{ strtoupper(substr($msg->sender->name ?? 'S', 0, 2)) }}
                        </div>
                        @endif
                        <div class="bubble-wrap">
                            <div class="bubble {{ $isMe ? 'mine' : 'theirs' }}">{{ $msg->message }}</div>
                            <div class="bubble-time">{{ $msg->created_at->format('h:i A') }}</div>
                        </div>
                        @if($isMe)
                        <div class="msg-avatar mine">
                            {{ strtoupper(substr(auth()->user()->first_name ?? 'Me', 0, 2)) }}
                        </div>
                        @endif
                    </div>

                @empty
                    <div class="chat-msgs-empty">
                        <div class="chat-msgs-empty-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            </svg>
                        </div>
                        <h4>No messages yet</h4>
                        <p>Start the conversation below.</p>
                    </div>
                @endforelse

            </div>

            {{-- ── COMPOSE BAR ── --}}
            <div class="compose-bar">
                <form method="POST" action="{{ route('chat.send') }}" id="chat-form">
                    @csrf
                    <input type="hidden" name="receiver_id" id="receiver-id-input" value="{{ $userId ?? '' }}">
                    <input type="hidden" name="supplier_id" id="supplier-id-input" value="{{ $supplierId ?? '' }}">
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

        </div>{{-- #active-convo --}}

    </div>{{-- .detail-panel --}}

</div>{{-- .inbox-body --}}

<script>
    /* ════════════════════════════════════
       OPEN CONVERSATION
    ════════════════════════════════════ */
    function openConversation(convId, name, role, category, location, phone, rating, isAvail, price, unreadCount, chatRoute, initials) {

        /* Highlight row */
        document.querySelectorAll('.conv-row').forEach(r => r.classList.remove('active'));
        const row = document.getElementById('conv-row-' + convId);
        if (row) {
            row.classList.add('active');
            row.classList.remove('unread');
            row.querySelector('.unread-badge')?.remove();
        }

        /* Show active panel */
        document.getElementById('chat-placeholder').style.display = 'none';
        document.getElementById('active-convo').style.display = 'flex';

        /* Avatar + header */
        document.getElementById('dp-avatar').textContent = initials;
        document.getElementById('dp-name').textContent   = name;
        document.getElementById('dp-role').textContent   = role;
        document.getElementById('dp-open-chat').href     = chatRoute;

        /* Location */
        const ssLoc = document.getElementById('ss-location');
        if (location) { document.getElementById('ss-location-text').textContent = location; ssLoc.style.display = ''; }
        else { ssLoc.style.display = 'none'; }

        /* Phone */
        const ssPhone = document.getElementById('ss-phone');
        if (phone) { document.getElementById('ss-phone-text').textContent = phone; ssPhone.style.display = ''; }
        else { ssPhone.style.display = 'none'; }

        /* Category */
        const ssCat = document.getElementById('ss-category');
        if (category) { ssCat.textContent = category; ssCat.style.display = ''; }
        else { ssCat.style.display = 'none'; }

        /* Availability */
        const ssAvail = document.getElementById('ss-avail');
        ssAvail.className = isAvail ? 'ss-avail-yes' : 'ss-avail-no';
        ssAvail.textContent = isAvail ? '● Available' : '● Unavailable';
        ssAvail.style.display = '';

        /* Price */
        const ssPrice = document.getElementById('ss-price');
        if (price > 0) {
            document.getElementById('ss-price-text').textContent = '₱' + price.toLocaleString('en-PH', { minimumFractionDigits: 0 });
            ssPrice.style.display = '';
        } else { ssPrice.style.display = 'none'; }

        /* Rating */
        const ratingStrip = document.getElementById('rating-strip');
        if (rating > 0) {
            let stars = '';
            for (let i = 1; i <= 5; i++) stars += `<span class="${i <= Math.round(rating) ? 'sf' : 'se'}">★</span>`;
            document.getElementById('dp-stars').innerHTML = stars;
            document.getElementById('dp-rating-val').textContent = rating.toFixed(1) + ' / 5';
            ratingStrip.classList.add('show');
        } else { ratingStrip.classList.remove('show'); }

        /* Scroll chat to bottom */
        const msgBox = document.getElementById('chat-messages');
        if (msgBox) setTimeout(() => msgBox.scrollTop = msgBox.scrollHeight, 50);
    }

    function closeDetail() {
        document.getElementById('chat-placeholder').style.display = '';
        document.getElementById('active-convo').style.display = 'none';
        document.querySelectorAll('.conv-row').forEach(r => r.classList.remove('active'));
    }

    /* ════════════════════════════════════
       SEARCH FILTER
    ════════════════════════════════════ */
    function filterConvs(q) {
        const term = q.toLowerCase();
        document.querySelectorAll('.conv-row[data-name]').forEach(row => {
            row.style.display = (row.dataset.name || '').includes(term) || !term ? '' : 'none';
        });
    }

    /* ════════════════════════════════════
       COMPOSE — auto-grow + Enter to send
    ════════════════════════════════════ */
    const composeInput = document.getElementById('compose-input');
    if (composeInput) {
        composeInput.addEventListener('input', function () {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        });
        composeInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                if (this.value.trim()) document.getElementById('chat-form').submit();
            }
        });
    }

    /* ════════════════════════════════════
       SCROLL REVEAL
    ════════════════════════════════════ */
    const io = new IntersectionObserver(entries => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 45);
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.05 });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));

    /* Scroll messages on load */
    const msgBox = document.getElementById('chat-messages');
    if (msgBox) msgBox.scrollTop = msgBox.scrollHeight;
</script>

</x-client-layout>