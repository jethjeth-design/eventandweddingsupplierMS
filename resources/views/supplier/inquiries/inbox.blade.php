<x-supplier-layout>

{{--
    resources/views/supplier/inbox.blade.php
    Supplier Inbox — Bikol's Craft gold / ivory / charcoal design system
    Variables: $conversations (collection), $inquiries (collection)
--}}

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
        display: flex; align-items: flex-end; justify-content: space-between;
        flex-wrap: wrap; gap: 1rem;
    }
    .ih-eyebrow {
        font-size: 0.62rem; letter-spacing: 0.2em; text-transform: uppercase;
        color: var(--gold); font-weight: 500; margin-bottom: 0.35rem;
        display: flex; align-items: center; gap: 0.5rem; font-family: var(--font-body);
    }
    .ih-eyebrow::before { content: ''; display: block; width: 18px; height: 1px; background: var(--gold); }
    .ih-title { font-family: var(--font-display); font-size: clamp(1.2rem, 2.5vw, 1.75rem); font-weight: 700; color: var(--white); line-height: 1.15; }
    .ih-title em { color: var(--gold-light); font-style: italic; }
    .ih-sub { font-size: 0.78rem; color: rgba(255,255,255,0.4); margin-top: 0.3rem; font-family: var(--font-body); }
    .ih-pills { display: flex; gap: 0.45rem; align-items: flex-end; flex-wrap: wrap; }
    .ih-pill { display: inline-flex; align-items: center; gap: 5px; font-size: 0.65rem; font-weight: 600; letter-spacing: 0.07em; text-transform: uppercase; padding: 4px 11px; border-radius: 2px; font-family: var(--font-body); }
    .ih-pill.gold { color: var(--gold); background: rgba(201,168,76,0.12); border: 1px solid rgba(201,168,76,0.28); }
    .ih-pill.blue { color: #93C5FD; background: rgba(147,197,253,0.1); border: 1px solid rgba(147,197,253,0.25); }

    .tab-bar { background: var(--white); border-bottom: 1px solid var(--border); padding: 0 2rem; display: flex; align-items: center; overflow-x: auto; }
    .tab-btn { padding: 0.82rem 1rem; background: none; border: none; border-bottom: 2px solid transparent; font-size: 0.78rem; font-weight: 500; color: var(--warm-grey); cursor: pointer; font-family: var(--font-body); white-space: nowrap; display: flex; align-items: center; gap: 0.45rem; margin-bottom: -1px; transition: color 0.18s, border-color 0.18s; }
    .tab-btn:hover { color: var(--gold-dark); }
    .tab-btn.active { color: var(--gold-dark); border-bottom-color: var(--gold); font-weight: 600; }
    .t-count { min-width: 18px; height: 17px; padding: 0 4px; background: rgba(201,168,76,0.1); border: 1px solid rgba(201,168,76,0.22); color: var(--gold-dark); font-size: 0.6rem; font-weight: 700; border-radius: 99px; display: inline-flex; align-items: center; justify-content: center; font-family: var(--font-body); }
    .tab-btn.active .t-count { background: var(--gold); border-color: var(--gold); color: var(--charcoal); }

    .inbox-body { display: grid; grid-template-columns: 320px 1fr; height: calc(100vh - 155px); overflow: hidden; }

    /* LEFT LIST */
    .inbox-list { border-right: 1px solid var(--border); display: flex; flex-direction: column; overflow: hidden; background: var(--white); }
    .list-search { padding: 0.75rem 1rem; border-bottom: 1px solid var(--border); flex-shrink: 0; }
    .list-search-inner { display: flex; align-items: center; gap: 0.5rem; background: var(--ivory); border: 1px solid var(--border-md); border-radius: 3px; padding: 0.42rem 0.7rem; transition: border-color 0.18s; }
    .list-search-inner:focus-within { border-color: var(--gold); }
    .list-search-inner svg { color: var(--warm-grey); opacity: 0.45; flex-shrink: 0; }
    .list-search-inner input { flex: 1; border: none; background: transparent; outline: none; font-size: 0.8rem; font-family: var(--font-body); color: var(--charcoal); }
    .list-search-inner input::placeholder { color: #B0A89E; }
    .list-scroll { overflow-y: auto; flex: 1; }
    .list-scroll::-webkit-scrollbar { width: 4px; }
    .list-scroll::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }
    .list-scroll::-webkit-scrollbar-thumb:hover { background: var(--gold); }
    .list-section-head { padding: 0.55rem 1rem 0.3rem; font-size: 0.58rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; color: var(--gold-dark); display: flex; align-items: center; gap: 0.45rem; font-family: var(--font-body); position: sticky; top: 0; background: var(--white); z-index: 2; border-bottom: 1px solid var(--border); }
    .list-section-head::after { content: ''; flex: 1; height: 1px; background: linear-gradient(90deg, var(--gold), transparent); }

    .msg-row { display: flex; gap: 0.7rem; align-items: flex-start; padding: 0.85rem 1rem; border-bottom: 0.5px solid var(--border); cursor: pointer; position: relative; transition: background 0.15s; text-decoration: none; }
    .msg-row:hover { background: rgba(201,168,76,0.04); }
    .msg-row.active { background: rgba(201,168,76,0.08); border-right: 2px solid var(--gold); }
    .msg-row.unread { background: #FFFDF7; }
    .msg-row.unread::before { content: ''; position: absolute; top: 0; left: 0; bottom: 0; width: 2.5px; background: var(--gold); }

    .row-avatar { width: 40px; height: 40px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: 0.95rem; font-weight: 700; border: 2px solid rgba(201,168,76,0.18); overflow: hidden; }
    .row-avatar.av-chat  { background: var(--charcoal); color: var(--gold); }
    .row-avatar.av-guest { background: #1D4ED8; color: #BFDBFE; }
    .row-avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }

    .row-body { flex: 1; min-width: 0; }
    .row-head { display: flex; align-items: baseline; justify-content: space-between; gap: 0.3rem; margin-bottom: 2px; }
    .row-name { font-size: 0.85rem; font-weight: 600; color: var(--charcoal); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-family: var(--font-display); }
    .row-time { font-size: 0.62rem; color: var(--warm-grey); flex-shrink: 0; font-family: var(--font-body); }
    .row-subject { font-size: 0.75rem; font-weight: 500; color: var(--charcoal); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 1px; font-family: var(--font-body); }
    .row-preview { font-size: 0.72rem; color: var(--warm-grey); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-family: var(--font-body); }
    .row-foot { display: flex; align-items: center; gap: 0.35rem; margin-top: 4px; flex-wrap: wrap; }
    .row-badge { font-size: 0.55rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; padding: 1px 6px; border-radius: 2px; font-family: var(--font-body); }
    .rb-chat  { background: rgba(201,168,76,0.1); color: var(--gold-dark); border: 1px solid rgba(201,168,76,0.2); }
    .rb-guest { background: #EFF6FF; color: #1D4ED8; border: 1px solid #BFDBFE; }
    .rb-unread { width: 7px; height: 7px; border-radius: 50%; background: var(--gold); display: inline-block; flex-shrink: 0; }
    .list-empty { text-align: center; padding: 2.5rem 1.5rem; font-size: 0.8rem; color: var(--warm-grey); font-family: var(--font-body); }
    .list-empty svg { display: block; margin: 0 auto 0.75rem; opacity: 0.3; color: var(--gold-dark); }

    /* RIGHT DETAIL */
    .inbox-detail { display: flex; flex-direction: column; background: var(--ivory); overflow: hidden; }
    .detail-head { background: var(--white); border-bottom: 1px solid var(--border); padding: 1rem 1.5rem; display: flex; align-items: center; gap: 0.85rem; flex-shrink: 0; flex-wrap: wrap; }
    .detail-head-avatar { width: 44px; height: 44px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; border: 2px solid rgba(201,168,76,0.2); overflow: hidden; }
    .dha-chat  { background: var(--charcoal); color: var(--gold); }
    .dha-guest { background: #1D4ED8; color: #BFDBFE; }
    .detail-head-avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
    .detail-head-info { flex: 1; min-width: 0; }
    .detail-head-name { font-family: var(--font-display); font-size: 1rem; font-weight: 600; color: var(--charcoal); line-height: 1.2; }
    .detail-head-sub { font-size: 0.72rem; color: var(--warm-grey); margin-top: 1px; font-family: var(--font-body); }
    .detail-head-actions { display: flex; gap: 0.4rem; flex-wrap: wrap; flex-shrink: 0; }

    .btn-gold { padding: 0.38rem 0.9rem; background: var(--gold); color: var(--charcoal); border: none; border-radius: 2px; font-size: 0.7rem; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase; cursor: pointer; font-family: var(--font-body); text-decoration: none; display: inline-flex; align-items: center; gap: 4px; transition: background 0.18s; white-space: nowrap; }
    .btn-gold:hover { background: var(--gold-light); }
    .btn-outline { padding: 0.38rem 0.9rem; background: transparent; color: var(--warm-grey); border: 1px solid var(--border-md); border-radius: 2px; font-size: 0.7rem; font-weight: 500; letter-spacing: 0.04em; text-transform: uppercase; cursor: pointer; font-family: var(--font-body); text-decoration: none; display: inline-flex; align-items: center; gap: 4px; transition: border-color 0.18s, color 0.18s; white-space: nowrap; }
    .btn-outline:hover { border-color: var(--gold); color: var(--gold-dark); }
    .btn-danger { padding: 0.38rem 0.9rem; background: transparent; color: #B91C1C; border: 1px solid #FCA5A5; border-radius: 2px; font-size: 0.7rem; font-weight: 500; cursor: pointer; font-family: var(--font-body); text-decoration: none; display: inline-flex; align-items: center; gap: 4px; transition: background 0.18s; white-space: nowrap; }
    .btn-danger:hover { background: #FEF2F2; }

    .detail-scroll { flex: 1; overflow-y: auto; padding: 1.5rem; }
    .detail-scroll::-webkit-scrollbar { width: 4px; }
    .detail-scroll::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }
    .detail-scroll::-webkit-scrollbar-thumb:hover { background: var(--gold); }

    .inquiry-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; overflow: hidden; position: relative; }
    .inquiry-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, var(--gold), var(--blush-deep)); }
    .iq-head { padding: 1.1rem 1.25rem 0.9rem; border-bottom: 1px solid var(--border); display: flex; align-items: flex-start; justify-content: space-between; gap: 0.5rem; flex-wrap: wrap; }
    .iq-subject { font-family: var(--font-display); font-size: 1.05rem; font-weight: 600; color: var(--charcoal); line-height: 1.2; margin-bottom: 2px; }
    .iq-from { font-size: 0.72rem; color: var(--warm-grey); font-family: var(--font-body); }
    .iq-time { font-size: 0.68rem; color: var(--warm-grey); font-family: var(--font-body); white-space: nowrap; }
    .iq-body { padding: 1.1rem 1.25rem; }
    .iq-message { font-size: 0.875rem; color: var(--warm-grey); line-height: 1.8; font-family: var(--font-body); white-space: pre-wrap; }
    .iq-meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; padding: 1rem 1.25rem; border-top: 1px solid var(--border); background: rgba(201,168,76,0.02); }
    .iq-meta-lbl { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--gold-dark); margin-bottom: 2px; font-family: var(--font-body); }
    .iq-meta-val { font-size: 0.82rem; color: var(--charcoal); font-family: var(--font-body); }
    .iq-meta-val a { color: var(--charcoal); text-decoration: underline; text-underline-offset: 3px; }
    .iq-foot { padding: 0.75rem 1.25rem; border-top: 1px solid var(--border); display: flex; gap: 0.5rem; justify-content: flex-end; flex-wrap: wrap; }

    .detail-placeholder { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 3rem; }
    .detail-placeholder-icon { width: 64px; height: 64px; margin: 0 auto 1.25rem; background: var(--white); border: 1px solid var(--border-md); border-radius: 4px; display: flex; align-items: center; justify-content: center; }
    .detail-placeholder-icon svg { color: var(--gold); opacity: 0.4; }
    .detail-placeholder h3 { font-family: var(--font-display); font-size: 1.1rem; font-weight: 600; color: var(--charcoal); margin-bottom: 0.35rem; }
    .detail-placeholder p { font-size: 0.82rem; color: var(--warm-grey); font-family: var(--font-body); }

    .reveal { opacity: 0; transform: translateY(12px); transition: opacity 0.42s ease, transform 0.42s ease; }
    .reveal.visible { opacity: 1; transform: none; }

    @media (max-width: 780px) {
        .inbox-body { display: block; height: auto; }
        .inbox-list { border-right: none; border-bottom: 1px solid var(--border); max-height: 55vh; }
        .inbox-detail { min-height: 50vh; }
        .tab-bar, .inbox-header { padding-left: 1rem; padding-right: 1rem; }
    }
</style>

{{-- HEADER --}}
<div class="inbox-header">
    <div class="ih-inner">
        <div>
            <div class="ih-eyebrow">Supplier Dashboard</div>
            <div class="ih-title">My <em>Inbox</em></div>
            <div class="ih-sub">Client messages and guest inquiries.</div>
        </div>
        <div class="ih-pills">
            @php
                $chatCount  = isset($conversations) ? $conversations->count() : 0;
                $guestCount = isset($inquiries)      ? $inquiries->count()     : 0;
                $totalCount = $chatCount + $guestCount;
            @endphp
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

{{-- TAB BAR --}}
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

{{-- TWO-PANEL --}}
<div class="inbox-body">

    {{-- LEFT: LIST --}}
    <div class="inbox-list">
        <div class="list-search">
            <div class="list-search-inner">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                <input type="text" placeholder="Search messages…" oninput="filterMessages(this.value)">
            </div>
        </div>

        <div class="list-scroll">

            {{-- Client messages section --}}
            <div class="list-section" data-section="clients">
                <div class="list-section-head">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    Client Messages
                </div>
                @if(isset($conversations) && $conversations->count())
                    @foreach($conversations as $msg)
                    @php
                        $other    = $msg->sender_id == auth()->id() ? $msg->receiver : $msg->sender;
                        $initials = strtoupper(substr($other->name ?? 'U', 0, 2));
                        $isUnread = !($msg->read_at ?? true) && $msg->sender_id != auth()->id();
                    @endphp
                    <a class="msg-row reveal {{ $isUnread ? 'unread' : '' }}"
                       href="{{ route('chat', [$other->id, $msg->supplier_id ?? 0]) }}"
                       data-name="{{ strtolower($other->name ?? '') }}" data-section="clients">
                        <div class="row-avatar av-chat">
                            @if($other->photo ?? false)
                                <img src="{{ asset('storage/'.$other->photo) }}" alt="">
                            @else {{ $initials }} @endif
                        </div>
                        <div class="row-body">
                            <div class="row-head">
                                <div class="row-name">{{ $other->name ?? 'Client' }}</div>
                                <span class="row-time">{{ $msg->created_at ? $msg->created_at->diffForHumans(null,true) : '' }}</span>
                            </div>
                            <div class="row-preview">{{ Str::limit($msg->message ?? '', 55) }}</div>
                            <div class="row-foot">
                                <span class="row-badge rb-chat">Chat</span>
                                @if($isUnread)<span class="rb-unread"></span>@endif
                            </div>
                        </div>
                    </a>
                    @endforeach
                @else
                <div class="list-empty">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    No client messages yet.
                </div>
                @endif
            </div>

            {{-- Guest inquiries section --}}
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
                         data-section="guests" id="row-{{ $inquiry->id }}">
                        <div class="row-avatar av-guest">{{ strtoupper(substr($inquiry->first_name ?? 'G', 0, 2)) }}</div>
                        <div class="row-body">
                            <div class="row-head">
                                <div class="row-name">{{ $inquiry->first_name }} {{ $inquiry->last_name }}</div>
                                <span class="row-time">{{ $inquiry->created_at ? $inquiry->created_at->diffForHumans(null,true) : '' }}</span>
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

        </div>
    </div>

    {{-- RIGHT: DETAIL --}}
    <div class="inbox-detail" id="inbox-detail">

        {{-- Placeholder --}}
        <div class="detail-placeholder" id="detail-placeholder">
            <div class="detail-placeholder-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 8l10 6 10-6"/></svg>
            </div>
            <h3>Select a message</h3>
            <p>Choose a conversation or inquiry from the list to view details here.</p>
        </div>
        
        {{--Client Details Panels--}}
        

        {{-- Inquiry detail panels --}}
        @if(isset($inquiries) && $inquiries->count())
        @foreach($inquiries as $inquiry)
        <div id="inquiry-detail-{{ $inquiry->id }}" style="display:none;flex-direction:column;height:100%;">
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
                        <div class="iq-time">{{ $inquiry->created_at ? $inquiry->created_at->format('M d, Y · g:i A') : '' }}</div>
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
                            <div class="iq-meta-val">{{ $inquiry->created_at ? $inquiry->created_at->diffForHumans() : '—' }}</div>
                        </div>
                    </div>
                    <div class="iq-foot">
                        <form method="POST" action="{{ route('inquiry.destroy', $inquiry->id) }}"
                               style="display:contents;">
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
        </div>
        @endforeach
        @endif

    </div>
</div>

<script>
function switchTab(tab, btn) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.list-section').forEach(sec => {
        sec.style.display = (tab === 'all' || sec.dataset.section === tab) ? '' : 'none';
    });
}
function showInquiry(id) {
    document.getElementById('detail-placeholder').style.display = 'none';
    document.querySelectorAll('[id^="inquiry-detail-"]').forEach(el => el.style.display = 'none');
    const panel = document.getElementById('inquiry-detail-' + id);
    if (panel) {
        panel.style.display = 'flex';
        panel.querySelectorAll('.reveal').forEach((el, i) => {
            el.classList.remove('visible');
            setTimeout(() => el.classList.add('visible'), i * 60);
        });
    }
    document.querySelectorAll('.msg-row').forEach(r => r.classList.remove('active'));
    const row = document.getElementById('row-' + id);
    if (row) row.classList.add('active');
}
function filterMessages(q) {
    const term = q.toLowerCase();
    document.querySelectorAll('.msg-row').forEach(row => {
        row.style.display = (row.dataset.name || '').includes(term) || term === '' ? '' : 'none';
    });
}
const io = new IntersectionObserver(entries => {
    entries.forEach((e, i) => {
        if (e.isIntersecting) { setTimeout(() => e.target.classList.add('visible'), i * 45); io.unobserve(e.target); }
    });
}, { threshold: 0.05 });
document.querySelectorAll('.msg-row.reveal').forEach(el => io.observe(el));
</script>

</x-supplier-layout>