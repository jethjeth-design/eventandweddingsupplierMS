<x-supplier-layout>

{{--
    resources/views/supplier/inbox.blade.php
    Supplier Inbox — Bikol's Craft gold / ivory / charcoal design system
    FIX: AJAX send so the chat panel NEVER disappears after sending
    Combined: conversation list + inline chat panel + guest inquiry detail
--}}

@php
    $myUser     = auth()->user();
    $myInitials = strtoupper(
        collect(explode(' ', trim(($myUser->first_name ?? '') . ' ' . ($myUser->last_name ?? '')) ?: ($myUser->name ?? 'Me')))
            ->filter()->map(fn($w) => $w[0])->take(2)->implode('')
    );
    $isSupplierView = method_exists($myUser, 'isSupplier') && $myUser->isSupplier();

    $chatCount  = isset($conversations) ? $conversations->count() : 0;
    $guestCount = isset($inquiries)     ? $inquiries->count()     : 0;
    $totalCount = $chatCount + $guestCount;
@endphp

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap');

:root {
    --gold:         #C9A84C;
    --gold-light:   #E8C97A;
    --gold-dark:    #8A6A1F;
    --blush-deep:   #D4A090;
    --ivory:        #FAF7F2;
    --charcoal:     #1E1B18;
    --warm-grey:    #6B6560;
    --white:        #FFFFFF;
    --border:       #F0EBE5;
    --border-md:    #E0D8D0;
    --font-display: 'Playfair Display', Georgia, serif;
    --font-body:    'DM Sans', sans-serif;
}
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: var(--font-body); background: var(--ivory); }

/* ─── HEADER ─────────────────────────────────────────── */
.inbox-header { background: var(--charcoal); padding: 1.75rem 2rem 1.5rem; position: relative; overflow: hidden; }
.inbox-header::before { content: ''; position: absolute; inset: 0; background-image: radial-gradient(rgba(201,168,76,.07) 1px,transparent 1px); background-size: 20px 20px; }
.inbox-header::after  { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg,transparent,var(--gold),transparent); }
.ih-inner { position: relative; z-index: 1; display: flex; align-items: flex-end; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
.ih-eyebrow { font-size: .62rem; letter-spacing: .2em; text-transform: uppercase; color: var(--gold); font-weight: 500; margin-bottom: .35rem; display: flex; align-items: center; gap: .5rem; }
.ih-eyebrow::before { content: ''; display: block; width: 18px; height: 1px; background: var(--gold); }
.ih-title { font-family: var(--font-display); font-size: clamp(1.2rem,2.5vw,1.75rem); font-weight: 700; color: var(--white); line-height: 1.15; }
.ih-title em { color: var(--gold-light); font-style: italic; }
.ih-sub { font-size: .78rem; color: rgba(255,255,255,.4); margin-top: .3rem; }
.ih-pills { display: flex; gap: .45rem; align-items: flex-end; flex-wrap: wrap; }
.ih-pill { display: inline-flex; align-items: center; gap: 5px; font-size: .65rem; font-weight: 600; letter-spacing: .07em; text-transform: uppercase; padding: 4px 11px; border-radius: 2px; }
.ih-pill.gold { color: var(--gold); background: rgba(201,168,76,.12); border: 1px solid rgba(201,168,76,.28); }
.ih-pill.blue { color: #93C5FD; background: rgba(147,197,253,.1); border: 1px solid rgba(147,197,253,.25); }

/* ─── TAB BAR ────────────────────────────────────────── */
.tab-bar { background: var(--white); border-bottom: 1px solid var(--border); padding: 0 2rem; display: flex; align-items: center; overflow-x: auto; }
.tab-btn { padding: .82rem 1rem; background: none; border: none; border-bottom: 2px solid transparent; font-size: .78rem; font-weight: 500; color: var(--warm-grey); cursor: pointer; font-family: var(--font-body); white-space: nowrap; display: flex; align-items: center; gap: .45rem; margin-bottom: -1px; transition: color .18s,border-color .18s; }
.tab-btn:hover { color: var(--gold-dark); }
.tab-btn.active { color: var(--gold-dark); border-bottom-color: var(--gold); font-weight: 600; }
.t-count { min-width: 18px; height: 17px; padding: 0 4px; background: rgba(201,168,76,.1); border: 1px solid rgba(201,168,76,.22); color: var(--gold-dark); font-size: .6rem; font-weight: 700; border-radius: 99px; display: inline-flex; align-items: center; justify-content: center; }
.tab-btn.active .t-count { background: var(--gold); border-color: var(--gold); color: var(--charcoal); }

/* ─── LAYOUT ─────────────────────────────────────────── */
.inbox-body { display: grid; grid-template-columns: 320px 1fr; height: calc(100vh - 155px); overflow: hidden; }

/* ─── LEFT LIST ──────────────────────────────────────── */
.inbox-list { border-right: 1px solid var(--border); display: flex; flex-direction: column; overflow: hidden; background: var(--white); }
.list-search { padding: .75rem 1rem; border-bottom: 1px solid var(--border); flex-shrink: 0; }
.list-search-inner { display: flex; align-items: center; gap: .5rem; background: var(--ivory); border: 1px solid var(--border-md); border-radius: 3px; padding: .42rem .7rem; transition: border-color .18s; }
.list-search-inner:focus-within { border-color: var(--gold); }
.list-search-inner svg { color: var(--warm-grey); opacity: .45; flex-shrink: 0; }
.list-search-inner input { flex: 1; border: none; background: transparent; outline: none; font-size: .8rem; font-family: var(--font-body); color: var(--charcoal); }
.list-search-inner input::placeholder { color: #B0A89E; }
.list-scroll { overflow-y: auto; flex: 1; }
.list-scroll::-webkit-scrollbar { width: 4px; }
.list-scroll::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }
.list-scroll::-webkit-scrollbar-thumb:hover { background: var(--gold); }
.list-section-head { padding: .55rem 1rem .3rem; font-size: .58rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; color: var(--gold-dark); display: flex; align-items: center; gap: .45rem; position: sticky; top: 0; background: var(--white); z-index: 2; border-bottom: 1px solid var(--border); }
.list-section-head::after { content: ''; flex: 1; height: 1px; background: linear-gradient(90deg,var(--gold),transparent); }

.msg-row { display: flex; gap: .7rem; align-items: flex-start; padding: .85rem 1rem; border-bottom: .5px solid var(--border); cursor: pointer; position: relative; transition: background .15s; }
.msg-row:hover { background: rgba(201,168,76,.04); }
.msg-row.active { background: rgba(201,168,76,.08); border-right: 2px solid var(--gold); }
.msg-row.unread { background: #FFFDF7; }
.msg-row.unread::before { content: ''; position: absolute; top: 0; left: 0; bottom: 0; width: 2.5px; background: var(--gold); }

.row-avatar { width: 40px; height: 40px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: .95rem; font-weight: 700; border: 2px solid rgba(201,168,76,.18); overflow: hidden; }
.row-avatar.av-chat  { background: var(--charcoal); color: var(--gold); }
.row-avatar.av-guest { background: #1D4ED8; color: #BFDBFE; }
.row-avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }

.row-body { flex: 1; min-width: 0; }
.row-head { display: flex; align-items: baseline; justify-content: space-between; gap: .3rem; margin-bottom: 2px; }
.row-name { font-size: .85rem; font-weight: 600; color: var(--charcoal); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-family: var(--font-display); }
.row-time { font-size: .62rem; color: var(--warm-grey); flex-shrink: 0; }
.row-subject { font-size: .75rem; font-weight: 500; color: var(--charcoal); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 1px; }
.row-preview { font-size: .72rem; color: var(--warm-grey); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.row-foot { display: flex; align-items: center; gap: .35rem; margin-top: 4px; flex-wrap: wrap; }
.row-badge { font-size: .55rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; padding: 1px 6px; border-radius: 2px; }
.rb-chat  { background: rgba(201,168,76,.1); color: var(--gold-dark); border: 1px solid rgba(201,168,76,.2); }
.rb-guest { background: #EFF6FF; color: #1D4ED8; border: 1px solid #BFDBFE; }
.rb-unread { width: 7px; height: 7px; border-radius: 50%; background: var(--gold); display: inline-block; flex-shrink: 0; }
.list-empty { text-align: center; padding: 2.5rem 1.5rem; font-size: .8rem; color: var(--warm-grey); }
.list-empty svg { display: block; margin: 0 auto .75rem; opacity: .3; color: var(--gold-dark); }

/* ─── RIGHT PANEL ────────────────────────────────────── */
.inbox-detail { display: flex; flex-direction: column; background: var(--ivory); overflow: hidden; }

.detail-placeholder { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 3rem; }
.detail-placeholder-icon { width: 64px; height: 64px; margin: 0 auto 1.25rem; background: var(--white); border: 1px solid var(--border-md); border-radius: 4px; display: flex; align-items: center; justify-content: center; }
.detail-placeholder-icon svg { color: var(--gold); opacity: .4; }
.detail-placeholder h3 { font-family: var(--font-display); font-size: 1.1rem; font-weight: 600; color: var(--charcoal); margin-bottom: .35rem; }
.detail-placeholder p { font-size: .82rem; color: var(--warm-grey); }

/* ─── BUTTONS ────────────────────────────────────────── */
.btn-gold    { padding: .38rem .9rem; background: var(--gold); color: var(--charcoal); border: none; border-radius: 2px; font-size: .7rem; font-weight: 600; letter-spacing: .04em; text-transform: uppercase; cursor: pointer; font-family: var(--font-body); text-decoration: none; display: inline-flex; align-items: center; gap: 4px; transition: background .18s; white-space: nowrap; }
.btn-gold:hover    { background: var(--gold-light); }
.btn-outline { padding: .38rem .9rem; background: transparent; color: var(--warm-grey); border: 1px solid var(--border-md); border-radius: 2px; font-size: .7rem; font-weight: 500; text-transform: uppercase; cursor: pointer; font-family: var(--font-body); text-decoration: none; display: inline-flex; align-items: center; gap: 4px; transition: border-color .18s,color .18s; white-space: nowrap; }
.btn-outline:hover { border-color: var(--gold); color: var(--gold-dark); }
.btn-danger  { padding: .38rem .9rem; background: transparent; color: #B91C1C; border: 1px solid #FCA5A5; border-radius: 2px; font-size: .7rem; font-weight: 500; cursor: pointer; font-family: var(--font-body); text-decoration: none; display: inline-flex; align-items: center; gap: 4px; transition: background .18s; white-space: nowrap; }
.btn-danger:hover  { background: #FEF2F2; }

/* ─── GUEST INQUIRY ──────────────────────────────────── */
.detail-head { background: var(--white); border-bottom: 1px solid var(--border); padding: 1rem 1.5rem; display: flex; align-items: center; gap: .85rem; flex-shrink: 0; flex-wrap: wrap; }
.detail-head-avatar { width: 44px; height: 44px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; border: 2px solid rgba(201,168,76,.2); overflow: hidden; }
.dha-guest { background: #1D4ED8; color: #BFDBFE; }
.detail-head-info { flex: 1; min-width: 0; }
.detail-head-name { font-family: var(--font-display); font-size: 1rem; font-weight: 600; color: var(--charcoal); }
.detail-head-sub { font-size: .72rem; color: var(--warm-grey); margin-top: 1px; }
.detail-head-actions { display: flex; gap: .4rem; flex-wrap: wrap; flex-shrink: 0; }

.detail-scroll { flex: 1; overflow-y: auto; padding: 1.5rem; }
.detail-scroll::-webkit-scrollbar { width: 4px; }
.detail-scroll::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }

.inquiry-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; overflow: hidden; position: relative; }
.inquiry-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg,var(--gold),var(--blush-deep)); }
.iq-head { padding: 1.1rem 1.25rem .9rem; border-bottom: 1px solid var(--border); display: flex; align-items: flex-start; justify-content: space-between; gap: .5rem; flex-wrap: wrap; }
.iq-subject { font-family: var(--font-display); font-size: 1.05rem; font-weight: 600; color: var(--charcoal); margin-bottom: 2px; }
.iq-from { font-size: .72rem; color: var(--warm-grey); }
.iq-time { font-size: .68rem; color: var(--warm-grey); white-space: nowrap; }
.iq-body { padding: 1.1rem 1.25rem; }
.iq-message { font-size: .875rem; color: var(--warm-grey); line-height: 1.8; white-space: pre-wrap; }
.iq-meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; padding: 1rem 1.25rem; border-top: 1px solid var(--border); background: rgba(201,168,76,.02); }
.iq-meta-lbl { font-size: .6rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--gold-dark); margin-bottom: 2px; }
.iq-meta-val { font-size: .82rem; color: var(--charcoal); }
.iq-meta-val a { color: var(--charcoal); text-decoration: underline; text-underline-offset: 3px; }
.iq-foot { padding: .75rem 1.25rem; border-top: 1px solid var(--border); display: flex; gap: .5rem; justify-content: flex-end; flex-wrap: wrap; }

/* ─── CHAT PANEL ─────────────────────────────────────── */
/* hidden by default — JS adds .active */
.chat-panel { display: none; flex-direction: column; height: 100%; overflow: hidden; }
.chat-panel.active { display: flex; }

.chat-win-head { background: var(--white); border-bottom: 1px solid var(--border); padding: .9rem 1.5rem; display: flex; align-items: center; gap: .85rem; flex-shrink: 0; }
.cwh-avatar { width: 44px; height: 44px; border-radius: 50%; background: var(--charcoal); color: var(--gold); display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: 1.05rem; font-weight: 700; border: 2px solid rgba(201,168,76,.22); flex-shrink: 0; overflow: hidden; }
.cwh-avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
.cwh-info { flex: 1; min-width: 0; }
.cwh-name { font-family: var(--font-display); font-size: 1rem; font-weight: 600; color: var(--charcoal); }
.cwh-sub  { font-size: .72rem; color: var(--warm-grey); margin-top: 1px; }
.cwh-badge { font-size: .6rem; font-weight: 700; letter-spacing: .07em; text-transform: uppercase; padding: 3px 9px; border-radius: 2px; color: var(--gold-dark); background: rgba(201,168,76,.1); border: 1px solid rgba(201,168,76,.22); white-space: nowrap; flex-shrink: 0; }

/* Messages area */
.chat-messages { flex: 1; overflow-y: auto; padding: 1.25rem 1.5rem; display: flex; flex-direction: column; gap: .5rem; }
.chat-messages::-webkit-scrollbar { width: 4px; }
.chat-messages::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }
.chat-messages::-webkit-scrollbar-thumb:hover { background: var(--gold); }

.msg-date-divider { display: flex; align-items: center; gap: .75rem; margin: .6rem 0; font-size: .65rem; color: var(--warm-grey); letter-spacing: .05em; text-transform: uppercase; }
.msg-date-divider::before, .msg-date-divider::after { content: ''; flex: 1; height: 1px; background: var(--border-md); }

.msg-group { display: flex; align-items: flex-end; gap: .55rem; animation: bubbleIn .28s ease forwards; }
.msg-group.mine   { flex-direction: row-reverse; }
.msg-group.theirs { flex-direction: row; }
@keyframes bubbleIn { from { opacity:0; transform:translateY(6px); } to { opacity:1; transform:none; } }

.msg-avatar { width: 32px; height: 32px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: .75rem; font-weight: 700; border: 2px solid rgba(201,168,76,.15); }
.msg-avatar.mine   { background: var(--charcoal); color: var(--gold); }
.msg-avatar.theirs { background: #DBEAFE; color: #1D4ED8; }

.bubble-wrap { display: flex; flex-direction: column; max-width: 68%; }
.msg-group.mine   .bubble-wrap { align-items: flex-end; }
.msg-group.theirs .bubble-wrap { align-items: flex-start; }
.bubble-sender-name { font-size: .62rem; color: var(--warm-grey); margin-bottom: 2px; font-weight: 500; }
.bubble { padding: .6rem .9rem; border-radius: 16px; font-size: .85rem; line-height: 1.55; word-break: break-word; }
.bubble.mine   { background: var(--charcoal); color: var(--white); border-bottom-right-radius: 4px; }
.bubble.theirs { background: var(--white); color: var(--charcoal); border: 1px solid var(--border); border-bottom-left-radius: 4px; }
.bubble-time { font-size: .6rem; color: var(--warm-grey); margin-top: 3px; padding: 0 2px; }

.chat-empty { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 2rem; }
.chat-empty-icon { width: 56px; height: 56px; margin: 0 auto 1rem; background: var(--white); border: 1px solid var(--border-md); border-radius: 4px; display: flex; align-items: center; justify-content: center; }
.chat-empty-icon svg { color: var(--gold); opacity: .35; }
.chat-empty h4 { font-family: var(--font-display); font-size: 1rem; font-weight: 600; color: var(--charcoal); margin-bottom: .3rem; }
.chat-empty p  { font-size: .8rem; color: var(--warm-grey); }

/* ─── COMPOSE BAR ────────────────────────────────────── */
.compose-bar { background: var(--white); border-top: 1px solid var(--border); padding: .85rem 1.5rem; flex-shrink: 0; }
.compose-row { display: flex; align-items: flex-end; gap: .6rem; background: var(--ivory); border: 1px solid var(--border-md); border-radius: 8px; padding: .55rem .65rem; transition: border-color .18s; }
.compose-row:focus-within { border-color: var(--gold); }
.compose-input { flex: 1; border: none; background: transparent; outline: none; font-size: .875rem; font-family: var(--font-body); color: var(--charcoal); resize: none; min-height: 22px; max-height: 120px; line-height: 1.5; }
.compose-input::placeholder { color: #B0A89E; }
.compose-send { width: 34px; height: 34px; border-radius: 6px; background: var(--gold); color: var(--charcoal); border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: background .18s; }
.compose-send:hover    { background: var(--gold-light); }
.compose-send:disabled { opacity: .45; cursor: not-allowed; }
.compose-hint { font-size: .62rem; color: var(--warm-grey); margin-top: .4rem; }

/* ─── TOAST ──────────────────────────────────────────── */
.toast-err { position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 9999; background: var(--charcoal); color: var(--white); border-left: 3px solid #DC2626; padding: .75rem 1.25rem; border-radius: 4px; font-size: .8rem; box-shadow: 0 4px 20px rgba(0,0,0,.2); animation: slideUp .25s ease both; max-width: 320px; }
@keyframes slideUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:none; } }

/* ─── ANIMATIONS ─────────────────────────────────────── */
.reveal { opacity: 0; transform: translateY(12px); transition: opacity .42s ease, transform .42s ease; }
.reveal.visible { opacity: 1; transform: none; }

/* ─── RESPONSIVE ─────────────────────────────────────── */
@media (max-width: 780px) {
    .inbox-body { display: block; height: auto; }
    .inbox-list { border-right: none; border-bottom: 1px solid var(--border); max-height: 55vh; }
    .inbox-detail { min-height: 50vh; }
    .tab-bar, .inbox-header { padding-left: 1rem; padding-right: 1rem; }
}
</style>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Inbox') }}</h2>
</x-slot>

{{-- ── HEADER ─────────────────────────────────────────── --}}
<div class="inbox-header">
    <div class="ih-inner">
        <div>
            <div class="ih-eyebrow">Supplier Dashboard</div>
            <div class="ih-title">My <em>Inbox</em></div>
            <div class="ih-sub">Client messages and guest inquiries.</div>
        </div>
        <div class="ih-pills">
            @if($chatCount)
            <span class="ih-pill gold">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                {{ $chatCount }} client{{ $chatCount !== 1 ? 's' : '' }}
            </span>
            @endif
            @if($guestCount)
            <span class="ih-pill blue">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 8l10 6 10-6"/></svg>
                {{ $guestCount }} inquir{{ $guestCount !== 1 ? 'ies' : 'y' }}
            </span>
            @endif
        </div>
    </div>
</div>

{{-- ── TAB BAR ─────────────────────────────────────────── --}}
<div class="tab-bar">
    <button class="tab-btn active" onclick="switchTab('all',this)">
        All @if($totalCount)<span class="t-count">{{ $totalCount }}</span>@endif
    </button>
    <button class="tab-btn" onclick="switchTab('clients',this)">
        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        Clients @if($chatCount)<span class="t-count">{{ $chatCount }}</span>@endif
    </button>
    <button class="tab-btn" onclick="switchTab('guests',this)">
        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 8l10 6 10-6"/></svg>
        Guest Inquiries @if($guestCount)<span class="t-count">{{ $guestCount }}</span>@endif
    </button>
</div>

{{-- ── TWO-PANEL BODY ──────────────────────────────────── --}}
<div class="inbox-body">

    {{-- LEFT: MESSAGE LIST --}}
    <div class="inbox-list">
        <div class="list-search">
            <div class="list-search-inner">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                <input type="text" placeholder="Search messages…" oninput="filterMessages(this.value)">
            </div>
        </div>

        <div class="list-scroll">

            {{-- Client conversations --}}
            <div class="list-section" data-section="clients">
                <div class="list-section-head">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    Client Messages
                </div>

                @if(isset($conversations) && $conversations->count())
                    @foreach($conversations as $msg)
                    @php
                        $other       = $msg->sender_id == auth()->id() ? $msg->receiver : $msg->sender;
                        $otherName   = trim(($other->first_name ?? '') . ' ' . ($other->last_name ?? '')) ?: ($other->name ?? $other->email ?? 'Client');
                        $otherInits  = strtoupper(collect(explode(' ', $otherName))->filter()->map(fn($w)=>$w[0])->take(2)->implode(''));
                        $isUnread    = !($msg->read_at ?? true) && $msg->sender_id != auth()->id();
                        $supId       = $msg->supplier_id ?? 0;
                    @endphp
                    <div class="msg-row reveal {{ $isUnread ? 'unread' : '' }}"
                         onclick="showChat({{ $other->id }}, {{ $supId }}, '{{ addslashes($otherName) }}', '{{ $otherInits }}')"
                         data-name="{{ strtolower($otherName) }}"
                         data-section="clients"
                         id="client-row-{{ $other->id }}">
                        <div class="row-avatar av-chat">
                            @if($other->photo ?? false)
                                <img src="{{ asset('storage/'.$other->photo) }}" alt="">
                            @else {{ $otherInits }} @endif
                        </div>
                        <div class="row-body">
                            <div class="row-head">
                                <div class="row-name">{{ $otherName }}</div>
                                <span class="row-time">{{ $msg->created_at?->diffForHumans(null,true) }}</span>
                            </div>
                            <div class="row-preview">{{ Str::limit($msg->message ?? '', 55) }}</div>
                            <div class="row-foot">
                                <span class="row-badge rb-chat">Chat</span>
                                @if($isUnread)<span class="rb-unread"></span>@endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="list-empty">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    No client messages yet.
                </div>
                @endif
            </div>

            {{-- Guest inquiries --}}
            <div class="list-section" data-section="guests">
                <div class="list-section-head">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 8l10 6 10-6"/></svg>
                    Guest Inquiries
                </div>

                @if(isset($inquiries) && $inquiries->count())
                    @foreach($inquiries as $inquiry)
                    @php $isUnread = !($inquiry->read_at ?? true); @endphp
                    <div class="msg-row reveal {{ $isUnread ? 'unread' : '' }}"
                         onclick="showInquiry({{ $inquiry->id }})"
                         data-name="{{ strtolower(($inquiry->first_name ?? '').' '.($inquiry->last_name ?? '')) }}"
                         data-section="guests"
                         id="row-{{ $inquiry->id }}">
                        <div class="row-avatar av-guest">{{ strtoupper(substr($inquiry->first_name ?? 'G', 0, 2)) }}</div>
                        <div class="row-body">
                            <div class="row-head">
                                <div class="row-name">{{ $inquiry->first_name }} {{ $inquiry->last_name }}</div>
                                <span class="row-time">{{ $inquiry->created_at?->diffForHumans(null,true) }}</span>
                            </div>
                            @if($inquiry->subject)<div class="row-subject">{{ $inquiry->subject }}</div>@endif
                            <div class="row-preview">{{ Str::limit($inquiry->message ?? '', 52) }}</div>
                            <div class="row-foot">
                                <span class="row-badge rb-guest">Guest</span>
                                @if($isUnread)<span class="rb-unread"></span>@endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="list-empty">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 8l10 6 10-6"/></svg>
                    No guest inquiries yet.
                </div>
                @endif
            </div>

        </div>{{-- /list-scroll --}}
    </div>{{-- /inbox-list --}}

    {{-- RIGHT: DETAIL PANEL --}}
    <div class="inbox-detail" id="inbox-detail">

        {{-- Default placeholder --}}
        <div class="detail-placeholder" id="detail-placeholder">
            <div class="detail-placeholder-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 8l10 6 10-6"/></svg>
            </div>
            <h3>Select a message</h3>
            <p>Choose a conversation or inquiry from the list to view details here.</p>
        </div>

        {{-- ════════════════════════════════════════
             CHAT PANELS (one per client)
             All hidden by default. JS adds .active.
             Compose uses AJAX — NO page reload.
        ════════════════════════════════════════ --}}
        @if(isset($conversations) && $conversations->count())
        @foreach($conversations as $msg)
        @php
            $other      = $msg->sender_id == auth()->id() ? $msg->receiver : $msg->sender;
            $otherName  = trim(($other->first_name ?? '') . ' ' . ($other->last_name ?? '')) ?: ($other->name ?? $other->email ?? 'Client');
            $otherInits = strtoupper(collect(explode(' ', $otherName))->filter()->map(fn($w)=>$w[0])->take(2)->implode(''));
            $supId      = $msg->supplier_id ?? 0;

            // Load the full message thread for this conversation
            $threadMessages = \App\Models\Message::where(function($q) use ($other, $msg) {
                    $q->where('sender_id', auth()->id())->where('receiver_id', $other->id);
                })->orWhere(function($q) use ($other, $msg) {
                    $q->where('sender_id', $other->id)->where('receiver_id', auth()->id());
                })
                ->when($supId, fn($q) => $q->where('supplier_id', $supId))
                ->orderBy('created_at')
                ->get();
        @endphp

        {{-- chat-panel hidden by default; JS toggles .active --}}
        <div class="chat-panel"
             id="chat-panel-{{ $other->id }}"
             data-receiver="{{ $other->id }}"
             data-supplier="{{ $supId }}"
             data-myinitials="{{ $myInitials }}">

            {{-- Chat header --}}
            <div class="chat-win-head">
                <div class="cwh-avatar">
                    @if($other->photo ?? false)
                        <img src="{{ asset('storage/'.$other->photo) }}" alt="{{ $otherName }}">
                    @else {{ $otherInits ?: 'US' }} @endif
                </div>
                <div class="cwh-info">
                    <div class="cwh-name">{{ $otherName }}</div>
                    <div class="cwh-sub">Client</div>
                </div>
                <span class="cwh-badge">Conversation</span>
            </div>

            {{-- Messages --}}
            <div class="chat-messages" id="chat-messages-{{ $other->id }}">
                @forelse($threadMessages as $tmsg)
                    @if($loop->first || $tmsg->created_at->toDateString() !== $threadMessages[$loop->index - 1]->created_at->toDateString())
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
                        $isMe          = $tmsg->sender_id == auth()->id();
                        $senderName    = $isMe ? (trim(($myUser->first_name??'').' '.($myUser->last_name??'')) ?: ($myUser->name??'Me')) : $otherName;
                        $senderInitials = $isMe ? $myInitials : $otherInits;
                    @endphp
                    <div class="msg-group {{ $isMe ? 'mine' : 'theirs' }}">
                        @if(!$isMe)<div class="msg-avatar theirs" title="{{ $senderName }}">{{ $senderInitials ?: 'US' }}</div>@endif
                        <div class="bubble-wrap">
                            @if(!$isMe)<div class="bubble-sender-name">{{ $senderName }}</div>@endif
                            <div class="bubble {{ $isMe ? 'mine' : 'theirs' }}">{{ $tmsg->message }}</div>
                            <div class="bubble-time">{{ $tmsg->created_at->format('h:i A') }}</div>
                        </div>
                        @if($isMe)<div class="msg-avatar mine" title="{{ $senderName }}">{{ $myInitials ?: 'ME' }}</div>@endif
                    </div>
                @empty
                    <div class="chat-empty">
                        <div class="chat-empty-icon">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        </div>
                        <h4>No messages yet</h4>
                        <p>Start the conversation below.</p>
                    </div>
                @endforelse
            </div>

            {{-- ★ COMPOSE — AJAX only, NO <form> submit, NO page reload ★ --}}
            <div class="compose-bar">
                <div class="compose-row">
                    <textarea
                        class="compose-input supplier-compose"
                        data-userid="{{ $other->id }}"
                        placeholder="Write a message…"
                        rows="1"></textarea>
                    <button type="button"
                            class="compose-send"
                            id="send-btn-{{ $other->id }}"
                            onclick="sendMessage({{ $other->id }})"
                            title="Send">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"/>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                        </svg>
                    </button>
                </div>
                <div class="compose-hint">Enter to send &middot; Shift+Enter for new line</div>
            </div>

        </div>{{-- /chat-panel --}}
        @endforeach
        @endif

        {{-- GUEST INQUIRY PANELS --}}
        @if(isset($inquiries) && $inquiries->count())
        @foreach($inquiries as $inquiry)
        <div id="inquiry-detail-{{ $inquiry->id }}" style="display:none; flex-direction:column; height:100%;">

            <div class="detail-head">
                <div class="detail-head-avatar dha-guest">{{ strtoupper(substr($inquiry->first_name ?? 'G', 0, 2)) }}</div>
                <div class="detail-head-info">
                    <div class="detail-head-name">{{ $inquiry->first_name }} {{ $inquiry->last_name }}</div>
                    <div class="detail-head-sub">{{ $inquiry->email }}@if($inquiry->phone) &middot; {{ $inquiry->phone }}@endif</div>
                </div>
                <div class="detail-head-actions">
                    <a href="mailto:{{ $inquiry->email }}?subject=Re: {{ urlencode($inquiry->subject ?? 'Your Inquiry') }}" class="btn-gold">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 8l10 6 10-6"/></svg>
                        Reply
                    </a>
                    <form method="POST" action="{{ route('supplier.inquiry.read', $inquiry->id) }}" style="display:contents;">
                        @csrf
                        <button type="submit" class="btn-outline">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                            Mark Read
                        </button>
                    </form>
                </div>
            </div>

            <div class="detail-scroll">
                <div class="inquiry-card reveal">
                    <div class="iq-head">
                        <div>
                            @if($inquiry->subject)<div class="iq-subject">{{ $inquiry->subject }}</div>@endif
                            <div class="iq-from">From: {{ $inquiry->first_name }} {{ $inquiry->last_name }}</div>
                        </div>
                        <div class="iq-time">{{ $inquiry->created_at?->format('M d, Y · g:i A') }}</div>
                    </div>
                    <div class="iq-body">
                        <p class="iq-message">{{ $inquiry->message }}</p>
                    </div>
                    <div class="iq-meta-grid">
                        <div>
                            <div class="iq-meta-lbl">Email</div>
                            <div class="iq-meta-val"><a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></div>
                        </div>
                        @if($inquiry->phone)
                        <div>
                            <div class="iq-meta-lbl">Phone</div>
                            <div class="iq-meta-val"><a href="tel:{{ $inquiry->phone }}">{{ $inquiry->phone }}</a></div>
                        </div>
                        @endif
                        @if($inquiry->subject)
                        <div>
                            <div class="iq-meta-lbl">Subject</div>
                            <div class="iq-meta-val">{{ $inquiry->subject }}</div>
                        </div>
                        @endif
                        <div>
                            <div class="iq-meta-lbl">Received</div>
                            <div class="iq-meta-val">{{ $inquiry->created_at?->diffForHumans() ?? '—' }}</div>
                        </div>
                    </div>
                    <div class="iq-foot">
                        <form method="POST" action="{{ route('inquiry.destroy', $inquiry->id) }}" style="display:contents;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-danger">
                                <svg width="11" height="11" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 3.5h10M5 3.5V2.5h4v1M4.5 3.5v7a1 1 0 001 1h3a1 1 0 001-1v-7"/></svg>
                                Delete
                            </button>
                        </form>
                        <form method="POST" action="{{ route('supplier.inquiry.read', $inquiry->id) }}" style="display:contents;">
                            @csrf
                            <button type="submit" class="btn-outline">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                Mark Read
                            </button>
                        </form>
                        <a href="mailto:{{ $inquiry->email }}?subject=Re: {{ urlencode($inquiry->subject ?? 'Your Inquiry') }}" class="btn-gold">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 8l10 6 10-6"/></svg>
                            Reply via Email
                        </a>
                    </div>
                </div>
            </div>

        </div>{{-- /inquiry-detail --}}
        @endforeach
        @endif

    </div>{{-- /inbox-detail --}}
</div>{{-- /inbox-body --}}

<script>
/* ─────────────────────────────────────────────────
   CSRF token
───────────────────────────────────────────────── */
const _CSRF = document.querySelector('meta[name="csrf-token"]')?.content
           ?? '{{ csrf_token() }}';

/* ─────────────────────────────────────────────────
   TAB SWITCHING
───────────────────────────────────────────────── */
function switchTab(tab, btn) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.list-section').forEach(sec => {
        sec.style.display = (tab === 'all' || sec.dataset.section === tab) ? '' : 'none';
    });
}

/* ─────────────────────────────────────────────────
   PANEL HELPERS
───────────────────────────────────────────────── */
function hideAllPanels() {
    document.getElementById('detail-placeholder').style.display = 'none';
    document.querySelectorAll('.chat-panel').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('[id^="inquiry-detail-"]').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.msg-row').forEach(r => r.classList.remove('active'));
}

/* ─────────────────────────────────────────────────
   SHOW INLINE CHAT
   Called when clicking a client row.
   The panel is already rendered — we just toggle
   visibility. No data fetch, no page reload.
───────────────────────────────────────────────── */
function showChat(userId, supplierId, name, initials) {
    hideAllPanels();

    const panel = document.getElementById('chat-panel-' + userId);
    if (panel) {
        panel.classList.add('active');
        const msgs = panel.querySelector('.chat-messages');
        if (msgs) setTimeout(() => msgs.scrollTop = msgs.scrollHeight, 50);
    }

    const row = document.getElementById('client-row-' + userId);
    if (row) row.classList.add('active');
}

/* ─────────────────────────────────────────────────
   SHOW GUEST INQUIRY
───────────────────────────────────────────────── */
function showInquiry(id) {
    hideAllPanels();

    const panel = document.getElementById('inquiry-detail-' + id);
    if (panel) {
        panel.style.display = 'flex';
        panel.querySelectorAll('.reveal').forEach((el, i) => {
            el.classList.remove('visible');
            setTimeout(() => el.classList.add('visible'), i * 60);
        });
    }

    const row = document.getElementById('row-' + id);
    if (row) row.classList.add('active');
}

/* ─────────────────────────────────────────────────
   SEARCH / FILTER
───────────────────────────────────────────────── */
function filterMessages(q) {
    const term = q.toLowerCase();
    document.querySelectorAll('.msg-row').forEach(row => {
        row.style.display = (!term || (row.dataset.name || '').includes(term)) ? '' : 'none';
    });
}

/* ─────────────────────────────────────────────────
   TOAST
───────────────────────────────────────────────── */
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

/* ─────────────────────────────────────────────────
   AJAX: SEND MESSAGE
   ★ THE CORE FIX ★
   fetch() → zero page reload → panel stays open
   every single time the supplier hits Send.
───────────────────────────────────────────────── */
async function sendMessage(userId) {
    const panel    = document.getElementById('chat-panel-' + userId);
    const textarea = panel.querySelector('.supplier-compose');
    const sendBtn  = document.getElementById('send-btn-' + userId);
    const text     = textarea.value.trim();
    if (!text) return;

    const supplierId = panel.dataset.supplier;
    const myInits    = panel.dataset.myinitials || 'ME';

    /* Optimistic bubble — appears instantly */
    appendBubble(userId, text, true, myInits);
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
                receiver_id: userId,
                supplier_id: supplierId,
                message:     text,
            })
        });
        if (!res.ok) throw new Error('HTTP ' + res.status);
    } catch (err) {
        showToast('Failed to send. Please try again.');
        console.error(err);
    } finally {
        sendBtn.disabled = false;
        textarea.focus();
    }
}

/* ─────────────────────────────────────────────────
   DOM: APPEND BUBBLE (optimistic)
───────────────────────────────────────────────── */
function appendBubble(userId, text, isMe, myInits) {
    const container = document.getElementById('chat-messages-' + userId);
    if (!container) return;

    /* Remove empty-state if present */
    container.querySelector('.chat-empty')?.remove();

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

/* ─────────────────────────────────────────────────
   AUTO-RESIZE TEXTAREA + ENTER TO SEND
───────────────────────────────────────────────── */
document.querySelectorAll('.supplier-compose').forEach(ta => {
    ta.addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
    });
    ta.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            const userId = this.dataset.userid;
            if (userId && this.value.trim()) sendMessage(userId);
        }
    });
});

/* ─────────────────────────────────────────────────
   INTERSECTION OBSERVER (reveal animations)
───────────────────────────────────────────────── */
const io = new IntersectionObserver(entries => {
    entries.forEach((e, i) => {
        if (e.isIntersecting) {
            setTimeout(() => e.target.classList.add('visible'), i * 45);
            io.unobserve(e.target);
        }
    });
}, { threshold: 0.05 });
document.querySelectorAll('.msg-row.reveal').forEach(el => io.observe(el));
</script>

</x-supplier-layout>