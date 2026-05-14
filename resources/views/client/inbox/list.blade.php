<x-client-layout>

{{--
    resources/views/client/inbox.blade.php
    Bikol's Craft — gold / ivory / charcoal design system
    FIX: AJAX send (no page reload = chat panel never disappears)
    ADD: "Open Full Chat" button
    REMOVED: Negotiation tab
--}}

@php
    $myUser     = auth()->user();
    $myInitials = strtoupper(
        collect(explode(' ', trim(($myUser->first_name ?? '') . ' ' . ($myUser->last_name ?? '')) ?: ($myUser->name ?? 'Me')))
            ->filter()->map(fn($w) => $w[0])->take(2)->implode('')
    );
    $totalUnread = isset($conversations) ? $conversations->sum('unread_count') : 0;
@endphp

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap');

:root {
    --gold:       #C9A84C;
    --gold-light: #E8C97A;
    --gold-dark:  #8A6A1F;
    --blush:      #D4A090;
    --ivory:      #FAF7F2;
    --charcoal:   #1E1B18;
    --warm-grey:  #6B6560;
    --white:      #FFFFFF;
    --border:     #F0EBE5;
    --border-md:  #E0D8D0;
    --fd: 'Playfair Display', Georgia, serif;
    --fb: 'DM Sans', sans-serif;
}
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: var(--fb); background: var(--ivory); }

/* ── HEADER ───────────────────────────────────── */
.inbox-header {
    background: var(--charcoal);
    padding: 1.75rem 2rem 1.5rem;
    position: relative; overflow: hidden;
}
.inbox-header::before {
    content: ''; position: absolute; inset: 0;
    background-image: radial-gradient(rgba(201,168,76,.07) 1px, transparent 1px);
    background-size: 20px 20px;
}
.inbox-header::after {
    content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
}
.ih-inner {
    position: relative; z-index: 1;
    display: flex; align-items: flex-end;
    justify-content: space-between; flex-wrap: wrap; gap: 1rem;
}
.ih-eyebrow {
    font-size: .62rem; letter-spacing: .2em; text-transform: uppercase;
    color: var(--gold); font-weight: 500; margin-bottom: .35rem;
    display: flex; align-items: center; gap: .5rem;
}
.ih-eyebrow::before { content: ''; display: block; width: 18px; height: 1px; background: var(--gold); }
.ih-title { font-family: var(--fd); font-size: clamp(1.2rem,2.5vw,1.75rem); font-weight: 700; color: var(--white); line-height: 1.15; }
.ih-title em { color: var(--gold-light); font-style: italic; }
.ih-sub { font-size: .78rem; color: rgba(255,255,255,.4); margin-top: .3rem; }
.ih-pill {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: .65rem; font-weight: 600; letter-spacing: .07em; text-transform: uppercase;
    padding: 4px 12px; border-radius: 2px;
    color: var(--gold); background: rgba(201,168,76,.12); border: 1px solid rgba(201,168,76,.28);
}

/* ── LAYOUT ──────────────────────────────────── */
.inbox-body {
    display: grid;
    grid-template-columns: 310px 1fr;
    height: calc(100vh - 148px);
    overflow: hidden;
}

/* ── LEFT: CONVERSATION LIST ─────────────────── */
.conv-list {
    background: var(--white); border-right: 1px solid var(--border);
    display: flex; flex-direction: column; overflow: hidden;
}
.list-search { padding: .75rem 1rem; border-bottom: 1px solid var(--border); flex-shrink: 0; }
.search-inner {
    display: flex; align-items: center; gap: .5rem;
    background: var(--ivory); border: 1px solid var(--border-md);
    border-radius: 3px; padding: .42rem .75rem; transition: border-color .18s;
}
.search-inner:focus-within { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,.08); }
.search-inner svg { color: var(--warm-grey); opacity: .45; flex-shrink: 0; }
.search-inner input {
    flex: 1; border: none; background: transparent; outline: none;
    font-size: .8rem; color: var(--charcoal); font-family: var(--fb);
}
.search-inner input::placeholder { color: #B0A89E; }

.list-head {
    padding: .55rem 1rem .35rem;
    font-size: .58rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
    color: var(--gold-dark); display: flex; align-items: center; gap: .45rem;
    border-bottom: 1px solid var(--border); background: var(--white); flex-shrink: 0;
}
.list-head::after { content: ''; flex: 1; height: 1px; background: linear-gradient(90deg, var(--gold), transparent); }

.list-scroll { overflow-y: auto; flex: 1; }
.list-scroll::-webkit-scrollbar { width: 4px; }
.list-scroll::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }
.list-scroll::-webkit-scrollbar-thumb:hover { background: var(--gold); }

.conv-row {
    display: flex; align-items: center; gap: .75rem;
    padding: .9rem 1rem; border-bottom: .5px solid var(--border);
    cursor: pointer; position: relative; transition: background .15s;
}
.conv-row:hover  { background: rgba(201,168,76,.04); }
.conv-row.active { background: rgba(201,168,76,.09); border-right: 2.5px solid var(--gold); }
.conv-row.unread { background: #FFFDF7; }
.conv-row.unread:hover { background: rgba(201,168,76,.07); }
.conv-row.unread::before {
    content: ''; position: absolute; top: 0; left: 0; bottom: 0; width: 2.5px; background: var(--gold);
}
.c-avatar {
    width: 42px; height: 42px; border-radius: 50%; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-family: var(--fd); font-size: 1rem; font-weight: 700;
    background: var(--charcoal); color: var(--gold);
    border: 2px solid rgba(201,168,76,.2); overflow: hidden;
}
.c-avatar img { width: 100%; height: 100%; object-fit: cover; }
.c-info { flex: 1; min-width: 0; }
.c-row-top { display: flex; align-items: baseline; justify-content: space-between; gap: .3rem; margin-bottom: 2px; }
.c-name { font-family: var(--fd); font-size: .88rem; font-weight: 600; color: var(--charcoal); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.c-time { font-size: .62rem; color: var(--warm-grey); flex-shrink: 0; }
.c-preview { font-size: .72rem; color: var(--warm-grey); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1.4; }
.c-row-foot { display: flex; align-items: center; gap: .35rem; margin-top: 3px; }
.c-badge {
    font-size: .55rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase;
    padding: 1px 6px; border-radius: 2px;
    background: rgba(201,168,76,.1); color: var(--gold-dark); border: 1px solid rgba(201,168,76,.2);
}
.unread-badge {
    min-width: 18px; height: 17px; padding: 0 4px;
    background: var(--gold); color: var(--charcoal);
    font-size: .62rem; font-weight: 700; border-radius: 99px;
    display: inline-flex; align-items: center; justify-content: center; margin-left: auto;
}
.list-empty { text-align: center; padding: 3rem 1.5rem; font-size: .8rem; color: var(--warm-grey); }
.list-empty svg { display: block; margin: 0 auto .75rem; opacity: .25; color: var(--gold-dark); }
.list-empty h4 { font-family: var(--fd); font-size: 1rem; color: var(--charcoal); margin-bottom: .3rem; }

/* ── RIGHT: DETAIL PANEL ─────────────────────── */
.detail-panel { display: flex; flex-direction: column; background: var(--ivory); overflow: hidden; }

.chat-placeholder {
    flex: 1; display: flex; flex-direction: column;
    align-items: center; justify-content: center; text-align: center; padding: 3rem;
}
.chat-placeholder-icon {
    width: 64px; height: 64px; margin: 0 auto 1.25rem;
    background: var(--white); border: 1px solid var(--border-md);
    border-radius: 4px; display: flex; align-items: center; justify-content: center;
}
.chat-placeholder-icon svg { color: var(--gold); opacity: .4; }
.chat-placeholder h3 { font-family: var(--fd); font-size: 1.1rem; font-weight: 600; color: var(--charcoal); margin-bottom: .35rem; }
.chat-placeholder p { font-size: .82rem; color: var(--warm-grey); }

/* hidden by default; JS shows it */
#active-convo { display: none; flex-direction: column; height: 100%; overflow: hidden; }

/* Supplier header */
.dp-head {
    background: var(--white); border-bottom: 1px solid var(--border);
    padding: .9rem 1.25rem; display: flex; align-items: center; gap: .9rem;
    flex-shrink: 0; position: relative;
}
.dp-head::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
    background: linear-gradient(90deg, var(--gold), var(--blush));
}
.dp-avatar {
    width: 46px; height: 46px; border-radius: 50%; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-family: var(--fd); font-size: 1.1rem; font-weight: 700;
    background: var(--charcoal); color: var(--gold);
    border: 2px solid rgba(201,168,76,.22); overflow: hidden;
}
.dp-avatar img { width: 100%; height: 100%; object-fit: cover; }
.dp-info { flex: 1; min-width: 0; }
.dp-name { font-family: var(--fd); font-size: 1rem; font-weight: 600; color: var(--charcoal); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.dp-role { font-size: .7rem; color: var(--warm-grey); margin-top: 1px; }
.dp-actions { display: flex; gap: .4rem; flex-shrink: 0; align-items: center; }

/* Buttons */
.btn-outline {
    padding: .38rem .9rem; background: transparent; color: var(--warm-grey);
    border: 1px solid var(--border-md); border-radius: 2px;
    font-size: .7rem; font-weight: 500; text-transform: uppercase;
    cursor: pointer; font-family: var(--fb); text-decoration: none;
    display: inline-flex; align-items: center; gap: 4px;
    transition: border-color .18s, color .18s; white-space: nowrap;
}
.btn-outline:hover { border-color: var(--gold); color: var(--gold-dark); }

/* Open Full Chat button */
.btn-full-chat {
    padding: .38rem .85rem; background: rgba(201,168,76,.12); color: var(--gold-dark);
    border: 1px solid rgba(201,168,76,.35); border-radius: 2px;
    font-size: .68rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase;
    cursor: pointer; font-family: var(--fb); text-decoration: none;
    display: inline-flex; align-items: center; gap: 5px;
    transition: background .18s, border-color .18s; white-space: nowrap;
}
.btn-full-chat:hover { background: rgba(201,168,76,.22); border-color: var(--gold); }
.btn-full-chat svg { flex-shrink: 0; }

/* Meta strip */
.supplier-strip {
    background: var(--white); border-bottom: 1px solid var(--border);
    padding: .6rem 1.25rem; display: flex; gap: 1rem; flex-wrap: wrap; align-items: center; flex-shrink: 0;
}
.ss-item { display: flex; align-items: center; gap: .35rem; font-size: .72rem; color: var(--warm-grey); }
.ss-item svg { color: var(--gold-dark); opacity: .7; flex-shrink: 0; }
.ss-chip {
    font-size: .6rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase;
    padding: 2px 8px; border-radius: 2px;
    background: rgba(201,168,76,.09); color: var(--gold-dark); border: 1px solid rgba(201,168,76,.22);
}
.ss-avail-yes { background: #F0FDF4; color: #15803D; border: 1px solid #BBF7D0; border-radius: 2px; padding: 2px 8px; font-size: .6rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; }
.ss-avail-no  { background: #FFFBEB; color: #B45309; border: 1px solid #FDE68A; border-radius: 2px; padding: 2px 8px; font-size: .6rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; }

/* Rating */
.rating-strip { display: none; background: var(--white); border-bottom: 1px solid var(--border); padding: .45rem 1.25rem; flex-shrink: 0; align-items: center; gap: .5rem; }
.rating-strip.show { display: flex; }
.star-row { display: inline-flex; gap: 1px; }
.sf { color: var(--gold); font-size: 11px; }
.se { color: #D8D0C8; font-size: 11px; }
.rating-label { font-size: .68rem; color: var(--warm-grey); }
.rating-val   { font-size: .72rem; font-weight: 600; color: var(--charcoal); }

/* ── CHAT PANEL WRAPPERS ─────────────────────── */
/* One per conversation. Hidden by default; JS adds .active */
.chat-panel-wrap { display: none; flex-direction: column; flex: 1; overflow: hidden; }
.chat-panel-wrap.active { display: flex; }

/* Messages scroll area */
.chat-messages {
    flex: 1; overflow-y: auto; padding: 1.25rem;
    display: flex; flex-direction: column; gap: .6rem; background: var(--ivory);
}
.chat-messages::-webkit-scrollbar { width: 4px; }
.chat-messages::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }
.chat-messages::-webkit-scrollbar-thumb:hover { background: var(--gold); }

.msg-date-divider {
    display: flex; align-items: center; gap: .75rem;
    font-size: .6rem; font-weight: 700; letter-spacing: .12em;
    text-transform: uppercase; color: var(--warm-grey); margin: .2rem 0;
}
.msg-date-divider::before,
.msg-date-divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }

.msg-group { display: flex; align-items: flex-end; gap: .5rem; animation: msgIn .22s ease both; }
@keyframes msgIn { from { opacity:0; transform:translateY(5px); } to { opacity:1; transform:none; } }
.msg-group.mine { flex-direction: row-reverse; }

.msg-avatar {
    width: 28px; height: 28px; border-radius: 50%; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-family: var(--fd); font-size: .62rem; font-weight: 700;
}
.msg-avatar.theirs { background: var(--charcoal); color: var(--gold); border: 1.5px solid rgba(201,168,76,.2); }
.msg-avatar.mine   { background: var(--gold); color: var(--charcoal); border: 1.5px solid rgba(201,168,76,.3); }

.bubble-wrap { display: flex; flex-direction: column; gap: 2px; max-width: 65%; }
.msg-group.mine   .bubble-wrap { align-items: flex-end; }
.msg-group.theirs .bubble-wrap { align-items: flex-start; }
.bubble-sender-name { font-size: .62rem; color: var(--warm-grey); font-weight: 500; margin-bottom: 1px; }
.bubble { padding: .62rem .9rem; font-size: .86rem; line-height: 1.58; word-break: break-word; font-family: var(--fb); }
.bubble.theirs { background: var(--white); color: var(--charcoal); border: 1px solid var(--border); border-radius: 12px 12px 12px 3px; }
.bubble.mine   { background: var(--charcoal); color: var(--white); border-radius: 12px 12px 3px 12px; }
.bubble-time { font-size: .6rem; color: var(--warm-grey); padding: 0 .2rem; }

.chat-msgs-empty {
    flex: 1; display: flex; flex-direction: column;
    align-items: center; justify-content: center; text-align: center; gap: .75rem; padding: 2rem;
}
.chat-msgs-empty-icon { width: 56px; height: 56px; background: var(--white); border: 1px solid var(--border-md); border-radius: 4px; display: flex; align-items: center; justify-content: center; }
.chat-msgs-empty-icon svg { color: var(--gold); opacity: .35; }
.chat-msgs-empty h4 { font-family: var(--fd); font-size: 1rem; font-weight: 600; color: var(--charcoal); }
.chat-msgs-empty p  { font-size: .78rem; color: var(--warm-grey); }

/* ── COMPOSE BAR ─────────────────────────────── */
.compose-bar { border-top: 1px solid var(--border); background: var(--white); padding: .85rem 1.25rem; flex-shrink: 0; }
.compose-row { display: flex; gap: .65rem; align-items: flex-end; }
.compose-input {
    flex: 1; border: 1px solid var(--border-md); border-radius: 20px;
    padding: .62rem 1.1rem; font-size: .875rem; font-family: var(--fb);
    color: var(--charcoal); background: var(--ivory); outline: none; resize: none;
    min-height: 42px; max-height: 120px; line-height: 1.5;
    transition: border-color .18s, box-shadow .18s;
}
.compose-input:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,.1); background: var(--white); }
.compose-input::placeholder { color: #B0A89E; }
.compose-send {
    width: 40px; height: 40px; border-radius: 50%; background: var(--gold);
    border: none; cursor: pointer; display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; transition: background .18s, transform .15s;
}
.compose-send:hover  { background: var(--gold-light); transform: scale(1.06); }
.compose-send:active { transform: scale(.96); }
.compose-send:disabled { opacity: .45; cursor: not-allowed; transform: none; }
.compose-send svg { color: var(--charcoal); }
.compose-hint { font-size: .63rem; color: var(--warm-grey); text-align: right; margin-top: .4rem; }

/* ── TOAST ───────────────────────────────────── */
.toast-err {
    position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 9999;
    background: var(--charcoal); color: var(--white);
    border-left: 3px solid #DC2626; padding: .75rem 1.25rem;
    border-radius: 4px; font-size: .8rem; font-family: var(--fb);
    box-shadow: 0 4px 20px rgba(0,0,0,.2); animation: slideUp .25s ease both; max-width: 320px;
}
@keyframes slideUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:none; } }

/* ── SCROLL REVEAL ───────────────────────────── */
.reveal { opacity: 0; transform: translateY(10px); transition: opacity .38s ease, transform .38s ease; }
.reveal.visible { opacity: 1; transform: none; }

/* ── RESPONSIVE ──────────────────────────────── */
@media (max-width: 768px) {
    .inbox-body { grid-template-columns: 1fr; height: auto; }
    .conv-list { max-height: 42vh; border-right: none; border-bottom: 1px solid var(--border); }
    .detail-panel { min-height: 58vh; }
    #active-convo { min-height: 58vh; }
    .bubble-wrap { max-width: 80%; }
    .dp-actions .btn-outline { display: none; }
    .inbox-header { padding: 1.25rem 1rem 1rem; }
    .btn-full-chat span { display: none; }
}
</style>

{{-- ── PAGE HEADER ─────────────────────────── --}}
<div class="inbox-header">
    <div class="ih-inner">
        <div>
            <div class="ih-eyebrow">Client Dashboard</div>
            <div class="ih-title">My <em>Inbox</em></div>
            <div class="ih-sub">Your conversations with suppliers.</div>
        </div>
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

{{-- ── TWO-PANEL BODY ──────────────────────── --}}
<div class="inbox-body">

    {{-- ══ LEFT: CONVERSATION LIST ══ --}}
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

        <div class="list-scroll">
            @forelse($conversations as $conv)
            @php
                $otherUser  = $conv->sender_id == auth()->id() ? $conv->receiver : $conv->sender;
                $supplier   = $otherUser->supplierProfile ?? null;
                $isUnread   = ($conv->unread_count ?? 0) > 0;
                $initials   = strtoupper(
                    collect(explode(' ', trim(($otherUser->first_name ?? '') . ' ' . ($otherUser->last_name ?? '')) ?: ($otherUser->name ?? 'S')))
                        ->filter()->map(fn($w) => $w[0])->take(2)->implode('')
                );
                $convId     = $conv->id ?? $loop->index;
                $otherName  = $supplier->business_name
                              ?? trim(($otherUser->first_name ?? '') . ' ' . ($otherUser->last_name ?? ''))
                              ?: ($otherUser->name ?? 'Supplier');
                $roleLine   = trim(($otherUser->first_name ?? '') . ' ' . ($otherUser->last_name ?? '')) ?: ($otherUser->name ?? '');
                $roleLine  .= ($supplier && $supplier->category ? ' · ' . $supplier->category : '');
                $suppUserId = $otherUser->id;
                $suppId     = $supplier->id ?? 0;
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
                     '{{ addslashes($supplier->phone ?? $otherUser->phone ?? '') }}',
                     {{ (float)($supplier->rating ?? 0) }},
                     {{ $supplier && $supplier->is_available ? 1 : 0 }},
                     {{ (float)($supplier->price ?? 0) }},
                     {{ $conv->unread_count ?? 0 }},
                     '{{ addslashes($initials) }}',
                     '{{ $suppUserId }}',
                     '{{ $suppId }}'
                 )">
                <div class="c-avatar">
                    @if($otherUser->photo ?? false)
                        <img src="{{ asset('storage/'.$otherUser->photo) }}" alt="{{ $otherName }}">
                    @else
                        {{ $initials }}
                    @endif
                </div>
                <div class="c-info">
                    <div class="c-row-top">
                        <div class="c-name">{{ $otherName }}</div>
                        <span class="c-time">{{ $conv->created_at?->diffForHumans(null, true) }}</span>
                    </div>
                    <div class="c-preview">{{ Str::limit($conv->message ?? 'Tap to open chat', 52) }}</div>
                    <div class="c-row-foot">
                        @if($supplier && $supplier->category)
                            <span class="c-badge">{{ $supplier->category }}</span>
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
    </div>{{-- /conv-list --}}

    {{-- ══ RIGHT: DETAIL + CHAT ══ --}}
    <div class="detail-panel" id="detail-panel">

        {{-- Placeholder shown until a conversation is selected --}}
        <div class="chat-placeholder" id="chat-placeholder">
            <div class="chat-placeholder-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
            </div>
            <h3>Select a conversation</h3>
            <p>Choose a supplier from the list to view your messages and their profile details.</p>
        </div>

        {{-- Active conversation wrapper --}}
        <div id="active-convo">

            {{-- Supplier header --}}
            <div class="dp-head">
                <div class="dp-avatar" id="dp-avatar">S</div>
                <div class="dp-info">
                    <div class="dp-name" id="dp-name">Supplier</div>
                    <div class="dp-role" id="dp-role">Event Supplier</div>
                </div>
                <div class="dp-actions">
                    {{-- "Open Full Chat" — href is set dynamically by JS --}}
                    <a href="#" id="btn-full-chat" class="btn-full-chat" title="Open full chat page">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            <polyline points="15 10 20 10 20 15"/>
                            <line x1="14" y1="14" x2="20" y2="10"/>
                        </svg>
                        <span>Open Full Chat</span>
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
            <div class="supplier-strip">
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

            {{-- ══════════════════════════════════════════
                 PER-CONVERSATION CHAT PANELS
                 One .chat-panel-wrap per conversation.
                 All hidden by default — JS adds .active.
            ══════════════════════════════════════════ --}}
            @forelse($conversations as $conv)
            @php
                $ou2    = $conv->sender_id == auth()->id() ? $conv->receiver : $conv->sender;
                $cid2   = $conv->id ?? $loop->index;
                $sup2   = $ou2->supplierProfile ?? null;
                $ini2   = strtoupper(
                    collect(explode(' ', trim(($ou2->first_name ?? '') . ' ' . ($ou2->last_name ?? '')) ?: ($ou2->name ?? 'S')))
                        ->filter()->map(fn($w) => $w[0])->take(2)->implode('')
                );
                $onam2  = $sup2->business_name
                          ?? trim(($ou2->first_name ?? '') . ' ' . ($ou2->last_name ?? ''))
                          ?: ($ou2->name ?? 'Supplier');
                $supId2 = $conv->supplier_id ?? 0;
                $pkgId2 = $conv->package_id  ?? 0;

                // Load chat messages for this conversation
                $chatMsgs = \App\Models\Message::where(function($q) use ($ou2) {
                        $q->where('sender_id', auth()->id())->where('receiver_id', $ou2->id);
                    })->orWhere(function($q) use ($ou2) {
                        $q->where('sender_id', $ou2->id)->where('receiver_id', auth()->id());
                    })
                    ->when($supId2, fn($q) => $q->where('supplier_id', $supId2))
                    ->where(fn($q) => $q->whereNull('type')->orWhere('type', 'message'))
                    ->orderBy('created_at')
                    ->get();
            @endphp

            <div class="chat-panel-wrap"
                 id="chat-panel-{{ $cid2 }}"
                 data-receiver="{{ $ou2->id }}"
                 data-supplier="{{ $supId2 }}"
                 data-package="{{ $pkgId2 }}"
                 data-initials="{{ $ini2 }}"
                 data-myinitials="{{ $myInitials }}">

                {{-- Messages area --}}
                <div class="chat-messages" id="chat-messages-{{ $cid2 }}">
                    @forelse($chatMsgs as $tmsg)
                        {{-- Date divider --}}
                        @if($loop->first || $tmsg->created_at->toDateString() !== $chatMsgs[$loop->index - 1]->created_at->toDateString())
                        <div class="msg-date-divider">
                            <span>
                                @if($tmsg->created_at->isToday()) Today
                                @elseif($tmsg->created_at->isYesterday()) Yesterday
                                @else {{ $tmsg->created_at->format('M d, Y') }}
                                @endif
                            </span>
                        </div>
                        @endif

                        @php
                            $isMe2 = $tmsg->sender_id == auth()->id();
                            $sNm2  = $isMe2
                                ? (trim(($myUser->first_name ?? '') . ' ' . ($myUser->last_name ?? '')) ?: ($myUser->name ?? 'Me'))
                                : $onam2;
                            $sIn2  = $isMe2 ? $myInitials : $ini2;
                        @endphp

                        <div class="msg-group {{ $isMe2 ? 'mine' : 'theirs' }}">
                            @if(!$isMe2)
                                <div class="msg-avatar theirs" title="{{ $sNm2 }}">{{ $sIn2 ?: 'S' }}</div>
                            @endif
                            <div class="bubble-wrap">
                                @if(!$isMe2)
                                    <div class="bubble-sender-name">{{ $sNm2 }}</div>
                                @endif
                                <div class="bubble {{ $isMe2 ? 'mine' : 'theirs' }}">{{ $tmsg->message }}</div>
                                <div class="bubble-time">{{ $tmsg->created_at->format('h:i A') }}</div>
                            </div>
                            @if($isMe2)
                                <div class="msg-avatar mine" title="{{ $sNm2 }}">{{ $myInitials ?: 'Me' }}</div>
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

                {{-- ★ COMPOSE BAR — AJAX only, no <form> submit, page NEVER reloads ★ --}}
                <div class="compose-bar">
                    <div class="compose-row">
                        <textarea
                            class="compose-input panel-compose"
                            data-conv="{{ $cid2 }}"
                            placeholder="Write a message…"
                            rows="1"></textarea>
                        <button type="button"
                                class="compose-send"
                                id="send-btn-{{ $cid2 }}"
                                onclick="sendMessage('{{ $cid2 }}')"
                                title="Send">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"/>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                            </svg>
                        </button>
                    </div>
                    <div class="compose-hint">Enter to send &middot; Shift+Enter for new line</div>
                </div>

            </div>{{-- /chat-panel-wrap --}}
            @empty
            @endforelse

        </div>{{-- #active-convo --}}
    </div>{{-- .detail-panel --}}
</div>{{-- .inbox-body --}}

<script>
/* ──────────────────────────────────────────────
   CSRF token (from meta tag or Blade fallback)
────────────────────────────────────────────── */
const _CSRF      = document.querySelector('meta[name="csrf-token"]')?.content ?? '{{ csrf_token() }}';
const _CHAT_BASE = '{{ url("/chat") }}';   // base for Open Full Chat URL

let _activeConvId = null;

/* ──────────────────────────────────────────────
   OPEN CONVERSATION
   Called when clicking a row in the left list.
   Updates the header/strips then activates the
   matching .chat-panel-wrap — NO page reload.
────────────────────────────────────────────── */
function openConversation(convId, name, role, category, location, phone,
                          rating, isAvail, price, unreadCount, initials,
                          suppUserId, suppId) {

    /* Highlight row */
    document.querySelectorAll('.conv-row').forEach(r => r.classList.remove('active'));
    const row = document.getElementById('conv-row-' + convId);
    if (row) {
        row.classList.add('active');
        row.classList.remove('unread');
        row.querySelector('.unread-badge')?.remove();
    }

    /* Show the panel area */
    document.getElementById('chat-placeholder').style.display = 'none';
    document.getElementById('active-convo').style.display     = 'flex';

    /* Supplier header */
    document.getElementById('dp-avatar').textContent = initials;
    document.getElementById('dp-name').textContent   = name;
    document.getElementById('dp-role').textContent   = role;

    /* Open Full Chat href  →  /chat/{suppUserId}/{suppId} */
    const fullChatBtn = document.getElementById('btn-full-chat');
    if (fullChatBtn && suppUserId && suppId) {
        fullChatBtn.href = _CHAT_BASE + '/' + suppUserId + '/' + suppId;
    }

    /* Location */
    const ssLoc = document.getElementById('ss-location');
    if (location) { document.getElementById('ss-location-text').textContent = location; ssLoc.style.display = ''; }
    else ssLoc.style.display = 'none';

    /* Phone */
    const ssPhone = document.getElementById('ss-phone');
    if (phone) { document.getElementById('ss-phone-text').textContent = phone; ssPhone.style.display = ''; }
    else ssPhone.style.display = 'none';

    /* Category */
    const ssCat = document.getElementById('ss-category');
    if (category) { ssCat.textContent = category; ssCat.style.display = ''; }
    else ssCat.style.display = 'none';

    /* Availability */
    const ssAvail = document.getElementById('ss-avail');
    ssAvail.className   = isAvail ? 'ss-avail-yes' : 'ss-avail-no';
    ssAvail.textContent = isAvail ? '● Available' : '● Unavailable';
    ssAvail.style.display = '';

    /* Price */
    const ssPrice = document.getElementById('ss-price');
    if (price > 0) {
        document.getElementById('ss-price-text').textContent =
            '₱' + price.toLocaleString('en-PH', { minimumFractionDigits: 0 });
        ssPrice.style.display = '';
    } else ssPrice.style.display = 'none';

    /* Rating */
    const ratingStrip = document.getElementById('rating-strip');
    if (rating > 0) {
        let stars = '';
        for (let i = 1; i <= 5; i++)
            stars += `<span class="${i <= Math.round(rating) ? 'sf' : 'se'}">★</span>`;
        document.getElementById('dp-stars').innerHTML = stars;
        document.getElementById('dp-rating-val').textContent = rating.toFixed(1) + ' / 5';
        ratingStrip.classList.add('show');
    } else ratingStrip.classList.remove('show');

    /* Activate the matching chat panel */
    document.querySelectorAll('.chat-panel-wrap').forEach(p => p.classList.remove('active'));
    const panel = document.getElementById('chat-panel-' + convId);
    if (panel) {
        panel.classList.add('active');
        const msgs = panel.querySelector('.chat-messages');
        if (msgs) setTimeout(() => msgs.scrollTop = msgs.scrollHeight, 50);
    }

    _activeConvId = convId;
}

/* ──────────────────────────────────────────────
   CLOSE
────────────────────────────────────────────── */
function closeDetail() {
    document.getElementById('chat-placeholder').style.display = '';
    document.getElementById('active-convo').style.display     = 'none';
    document.querySelectorAll('.conv-row').forEach(r => r.classList.remove('active'));
    document.querySelectorAll('.chat-panel-wrap').forEach(p => p.classList.remove('active'));
    _activeConvId = null;
}

/* ──────────────────────────────────────────────
   SEARCH FILTER
────────────────────────────────────────────── */
function filterConvs(q) {
    const term = q.toLowerCase();
    document.querySelectorAll('.conv-row[data-name]').forEach(row => {
        row.style.display = (!term || (row.dataset.name || '').includes(term)) ? '' : 'none';
    });
}

/* ──────────────────────────────────────────────
   HELPERS
────────────────────────────────────────────── */
function showToast(msg) {
    const t = document.createElement('div');
    t.className = 'toast-err';
    t.textContent = msg;
    document.body.appendChild(t);
    setTimeout(() => t.remove(), 4000);
}

function esc(str) {
    return String(str)
        .replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')
        .replace(/"/g,'&quot;').replace(/'/g,'&#39;');
}

/* ──────────────────────────────────────────────
   AJAX: SEND CHAT MESSAGE
   ★ THE CORE FIX ★
   fetch() → no page reload → panel stays open.
────────────────────────────────────────────── */
async function sendMessage(convId) {
    const panel    = document.getElementById('chat-panel-' + convId);
    const textarea = panel.querySelector('.panel-compose');
    const sendBtn  = document.getElementById('send-btn-' + convId);
    const text     = textarea.value.trim();
    if (!text) return;

    const receiverId = panel.dataset.receiver;
    const supplierId = panel.dataset.supplier;
    const myInits    = panel.dataset.myinitials || 'Me';

    /* Optimistic bubble — appears instantly */
    appendChatBubble(convId, text, true, myInits);
    textarea.value = '';
    textarea.style.height = 'auto';
    sendBtn.disabled = true;

    try {
        const res = await fetch('{{ route("chat.send") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': _CSRF,
                'Accept':       'application/json',
            },
            body: JSON.stringify({
                receiver_id: receiverId,
                supplier_id: supplierId,
                message:     text,
            })
        });
        if (!res.ok) throw new Error('HTTP ' + res.status);
    } catch (err) {
        showToast('Failed to send message. Please try again.');
        console.error(err);
    } finally {
        sendBtn.disabled = false;
        textarea.focus();
    }
}

/* ──────────────────────────────────────────────
   DOM: APPEND CHAT BUBBLE (optimistic)
────────────────────────────────────────────── */
function appendChatBubble(convId, text, isMe, myInits) {
    const container = document.getElementById('chat-messages-' + convId);
    if (!container) return;

    /* Remove empty-state placeholder if present */
    container.querySelector('.chat-msgs-empty')?.remove();

    const time = new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
    const g    = document.createElement('div');
    g.className = 'msg-group ' + (isMe ? 'mine' : 'theirs');
    g.innerHTML = `
        ${!isMe ? `<div class="msg-avatar theirs">${esc(myInits)}</div>` : ''}
        <div class="bubble-wrap">
            <div class="bubble ${isMe ? 'mine' : 'theirs'}">${esc(text)}</div>
            <div class="bubble-time">${time}</div>
        </div>
        ${isMe ? `<div class="msg-avatar mine">${esc(myInits)}</div>` : ''}
    `;
    container.appendChild(g);
    container.scrollTop = container.scrollHeight;
}

/* ──────────────────────────────────────────────
   AUTO-GROW TEXTAREA + ENTER TO SEND
────────────────────────────────────────────── */
document.querySelectorAll('.panel-compose').forEach(ta => {
    ta.addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
    });
    ta.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            const convId = this.dataset.conv;
            if (convId && this.value.trim()) sendMessage(convId);
        }
    });
});

/* ──────────────────────────────────────────────
   SCROLL REVEAL (left list rows)
────────────────────────────────────────────── */
const io = new IntersectionObserver(entries => {
    entries.forEach((e, i) => {
        if (e.isIntersecting) {
            setTimeout(() => e.target.classList.add('visible'), i * 45);
            io.unobserve(e.target);
        }
    });
}, { threshold: 0.05 });
document.querySelectorAll('.reveal').forEach(el => io.observe(el));
</script>

</x-client-layout>