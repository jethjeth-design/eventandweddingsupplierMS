<x-client-layout>

    {{-- resources/views/bids/client-bid-negotiation.blade.php --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap');

    .bidroom * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .bidroom {
        font-family: 'Outfit', system-ui, sans-serif;
        --ink: #14110E;
        --gold: #B8924A;
        --gold-light: #D4B06A;
        --gold-pale: #F5EDD8;
        --gold-dim: rgba(184, 146, 74, 0.10);
        --gold-border: rgba(184, 146, 74, 0.22);
        --stone: #F8F4EE;
        --stone-2: #EFE9DF;
        --mist: #8C867E;
        --mist-light: #B0AAA2;
        --white: #FFFFFF;
        --border: #E8E0D4;
        --danger: #C0392B;
        --success: #4CAF7D;
        --purple: #5C4B8A;

        min-height: 100vh;
        background: var(--stone);
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    /* ══ TOP BAR ══ */
    .br-topbar {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 0.8rem 1.25rem;
        box-shadow: 0 2px 14px rgba(20, 17, 14, .05);
        flex-shrink: 0;
    }

    .br-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 14px;
        border-radius: 9px;
        background: var(--stone);
        border: 1px solid var(--border);
        font-size: 0.74rem;
        font-weight: 500;
        color: var(--mist);
        text-decoration: none;
        transition: all .18s;
        flex-shrink: 0;
    }

    .br-back-btn:hover {
        border-color: var(--gold);
        color: var(--gold);
        background: var(--gold-dim);
    }

    .br-back-btn svg {
        width: 14px;
        height: 14px;
    }

    .br-topbar-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        flex-shrink: 0;
    }

    .br-topbar-icon svg {
        width: 19px;
        height: 19px;
    }

    .br-topbar-info {
        flex: 1;
        min-width: 0;
    }

    .br-topbar-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--ink);
        line-height: 1.1;
    }

    .br-topbar-name em {
        font-style: italic;
        color: var(--gold);
    }

    .br-topbar-sub {
        font-size: 0.68rem;
        color: var(--mist);
        margin-top: 2px;
    }

    .br-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        flex-shrink: 0;
    }

    .br-status-badge .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .br-status-badge.pending {
        background: var(--gold-dim);
        color: var(--gold);
        border: 1px solid var(--gold-border);
    }

    .br-status-badge.pending .dot {
        background: var(--gold);
    }

    .br-status-badge.accepted {
        background: rgba(76, 175, 125, 0.12);
        color: var(--success);
        border: 1px solid rgba(76, 175, 125, 0.25);
    }

    .br-status-badge.accepted .dot {
        background: var(--success);
    }

    .br-status-badge.rejected {
        background: rgba(192, 57, 43, 0.1);
        color: var(--danger);
        border: 1px solid rgba(192, 57, 43, 0.2);
    }

    .br-status-badge.rejected .dot {
        background: var(--danger);
    }

    /* ══ PANEL ══ */
    .br-panel {
        flex: 1;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        box-shadow: 0 2px 14px rgba(20, 17, 14, .05);
        min-height: -2;
    }

    .br-thread {
        flex: 1;
        overflow-y: auto;
        padding: 1.5rem 1.25rem;
        display: flex;
        flex-direction: column;
        gap: 0.7rem;
        background: var(--stone);
        scrollbar-width: thin;
        scrollbar-color: var(--border) transparent;
    }

    .br-thread::-webkit-scrollbar {
        width: 3px;
    }

    .br-thread::-webkit-scrollbar-thumb {
        background: var(--border);
        border-radius: 99px;
    }

    .br-row {
        display: flex;
        align-items: flex-end;
        gap: 0.5rem;
        animation: brIn .16s ease both;
    }

    @keyframes brIn {
        from {
            opacity: 0;
            transform: translateY(6px);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    .br-row.me {
        flex-direction: row-reverse;
    }

    .br-ava {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Cormorant Garamond', serif;
        font-size: 0.68rem;
        font-weight: 700;
        color: #fff;
        border: 1.5px solid rgba(184, 146, 74, 0.18);
        background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
    }

    .br-row.me .br-ava {
        background: linear-gradient(135deg, var(--ink) 0%, #3D3530 100%);
    }

    .br-card {
        max-width: 66%;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .br-row.me .br-card {
        align-items: flex-end;
    }

    .br-sender {
        font-size: 0.62rem;
        font-weight: 600;
        color: var(--mist);
        padding: 0 4px;
    }

    .br-offer-bubble {
        border-radius: 16px;
        border: 1px solid var(--border);
        background: var(--white);
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(20, 17, 14, .04);
        width: 100%;
    }

    .br-row.me .br-offer-bubble {
        background: var(--ink);
        border-color: var(--ink);
    }

    .br-offer-head {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        gap: 0.5rem;
        padding: 0.7rem 0.95rem 0.4rem;
    }

    .br-offer-label {
        font-size: 0.6rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--mist-light);
    }

    .br-row.me .br-offer-label {
        color: rgba(245, 237, 216, 0.55);
    }

    .br-offer-amount {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gold);
        line-height: 1;
    }

    .br-row.me .br-offer-amount {
        color: var(--gold-light);
    }

    .br-offer-msg {
        padding: 0 0.95rem 0.85rem;
        font-size: 0.8rem;
        line-height: 1.6;
        color: var(--ink);
    }

    .br-row.me .br-offer-msg {
        color: var(--gold-pale);
    }

    .br-meta {
        font-size: 0.58rem;
        color: var(--mist-light);
        padding: 0 4px;
    }

    .br-empty {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.65rem;
        padding: 3rem;
    }

    .br-empty-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--gold-dim);
        border: 1px solid var(--gold-border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gold);
    }

    .br-empty-icon svg {
        width: 26px;
        height: 26px;
    }

    .br-empty-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--ink);
    }

    .br-empty-title em {
        font-style: italic;
        color: var(--gold);
    }

    .br-empty-sub {
        font-size: 0.72rem;
        color: var(--mist);
        text-align: center;
        line-height: 1.65;
    }

    /* ══ FOOTER ACTIONS ══ */
    .br-foot {
        background: var(--white);
        border-top: 1px solid var(--border);
        flex-shrink: 0;
        padding: 1rem 1.25rem;
    }

    .br-accept-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        background: rgba(76, 175, 125, 0.07);
        border: 1px solid rgba(76, 175, 125, 0.22);
        border-radius: 12px;
        padding: 0.75rem 1rem;
        margin-bottom: 0.9rem;
    }

    .br-accept-bar-text {
        font-size: 0.78rem;
        color: var(--ink);
    }

    .br-accept-bar-text strong {
        color: var(--success);
    }

    .br-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 0.55rem 1.1rem;
        border-radius: 10px;
        border: none;
        font-family: 'Outfit', sans-serif;
        font-size: 0.78rem;
        font-weight: 600;
        cursor: pointer;
        transition: all .18s;
        white-space: nowrap;
    }

    .br-btn svg {
        width: 14px;
        height: 14px;
    }

    .br-btn-success {
        background: var(--success);
        color: #fff;
    }

    .br-btn-success:hover {
        background: #3d9268;
        transform: translateY(-1px);
    }

    .br-btn-primary {
        background: var(--ink);
        color: var(--gold-pale);
    }

    .br-btn-primary:hover {
        background: var(--gold);
        color: var(--white);
        transform: translateY(-1px);
    }

    .br-form-row {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .br-field {
        flex: 1;
        min-width: 160px;
    }

    .br-field.grow {
        flex: 2;
        min-width: 220px;
    }

    .br-flabel {
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--mist-light);
        margin-bottom: 0.35rem;
        display: block;
    }

    .br-input,
    .br-textarea {
        width: 100%;
        border: 1.5px solid var(--border);
        background: var(--stone);
        border-radius: 10px;
        padding: 0.6rem 0.8rem;
        font-family: 'Outfit', sans-serif;
        font-size: 0.8rem;
        color: var(--ink);
        outline: none;
        transition: border-color .18s, box-shadow .18s;
    }

    .br-input:focus,
    .br-textarea:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(184, 146, 74, 0.08);
    }

    .br-textarea {
        resize: none;
        min-height: 44px;
    }

    .br-currency-prefix {
        position: relative;
    }

    .br-currency-prefix .br-input {
        padding-left: 1.7rem;
    }

    .br-currency-prefix::before {
        content: '₱';
        position: absolute;
        left: 0.8rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--mist);
        font-size: 0.8rem;
        font-weight: 600;
        pointer-events: none;
    }

    .br-counter-form {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .br-counter-actions {
        display: flex;
        justify-content: flex-end;
    }

    .br-closed-banner {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0.9rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .br-closed-banner.accepted {
        background: rgba(76, 175, 125, 0.1);
        color: var(--success);
        border: 1px solid rgba(76, 175, 125, 0.25);
    }

    .br-closed-banner.rejected {
        background: rgba(192, 57, 43, 0.08);
        color: var(--danger);
        border: 1px solid rgba(192, 57, 43, 0.2);
    }

    .br-closed-banner svg {
        width: 16px;
        height: 16px;
    }

    @media (max-width: 600px) {
        .bidroom {
            padding: 0.5rem;
            gap: 0.65rem;
        }

        .br-topbar {
            padding: 0.65rem 0.85rem;
        }

        .br-thread {
            padding: 1rem 0.75rem;
        }

        .br-card {
            max-width: 84%;
        }

        .br-foot {
            padding: 0.85rem 0.9rem;
        }

        .br-form-row {
            flex-direction: column;
        }
    }
</style>

<x-client-layout>

    @php
        $authId = auth()->id();
        $statusKey = strtolower($bid->status);
        $isClosed = in_array($statusKey, ['accepted', 'rejected']);
        $latestMessage = $bid->messages->last();
        $canAccept = !$isClosed && $latestMessage && $latestMessage->sender_id != $authId;
    @endphp

    <div class="bidroom">

        {{-- ══ PANEL ══ --}}
        <div class="br-panel">

            <div class="br-thread" id="brThread">

                @forelse($bid->messages as $msg)
                    @php
                        $isMe = $msg->sender_id == $authId;
                        $sName = $msg->sender?->name ?? 'Unknown';
                        $sInit = strtoupper(substr($sName, 0, 2));
                    @endphp

                    <div class="br-row {{ $isMe ? 'me' : '' }}">
                        <div class="br-ava">{{ $sInit }}</div>

                        <div class="br-card">
                            <div class="br-sender">{{ $isMe ? 'You' : $sName }}</div>

                            <div class="br-offer-bubble">
                                <div class="br-offer-head">
                                    <span class="br-offer-label">Offer</span>
                                    <span class="br-offer-amount">₱{{ number_format($msg->offer_price, 2) }}</span>
                                </div>
                                @if($msg->message)
                                    <div class="br-offer-msg">{{ $msg->message }}</div>
                                @endif
                            </div>

                            <div class="br-meta">{{ $msg->created_at->format('M d, Y · g:i A') }}</div>
                        </div>
                    </div>

                @empty
                    <div class="br-empty">
                        <div class="br-empty-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.4">
                                <path d="M12 1v22M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                            </svg>
                        </div>
                        <div class="br-empty-title">No offers <em>yet</em></div>
                        <div class="br-empty-sub">Once an offer is made, it'll appear here for negotiation.</div>
                    </div>
                @endforelse

            </div>

            {{-- ══ FOOTER ══ --}}
            <div class="br-foot">

                @if($isClosed)

                    <div class="br-closed-banner {{ $statusKey }}">
                        @if($statusKey === 'accepted')
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path d="M5 12l5 5L20 7" />
                            </svg>
                            Bid Accepted
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                            Bid Rejected
                        @endif
                    </div>

                @else

                    @if($canAccept)
                        <div class="br-accept-bar">
                            <div class="br-accept-bar-text">
                                Latest offer is <strong>₱{{ number_format($latestMessage->offer_price, 2) }}</strong> from {{ $latestMessage->sender->name }}
                            </div>
                            <form method="POST" action="{{ route('client.bids.accept', $bid) }}">
                                @csrf
                                <button type="submit" class="br-btn br-btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path d="M5 12l5 5L20 7" />
                                    </svg>
                                    Accept Offer
                                </button>
                            </form>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('client.bids.reply', $bid) }}" class="br-counter-form">
                        @csrf
                        <div class="br-form-row">
                            <div class="br-field">
                                <label class="br-flabel">Your Counter Offer</label>
                                <div class="br-currency-prefix">
                                    <input type="number" name="offer_price" step="0.01" class="br-input" placeholder="0.00" required>
                                </div>
                            </div>
                            <div class="br-field grow">
                                <label class="br-flabel">Message <span style="font-weight:400;text-transform:none;letter-spacing:0;">(optional)</span></label>
                                <textarea name="message" class="br-textarea" rows="1" placeholder="Add a note about your offer…"></textarea>
                            </div>
                        </div>
                        <div class="br-counter-actions">
                            <button type="submit" class="br-btn br-btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <line x1="22" y1="2" x2="11" y2="13" />
                                    <polygon points="22 2 15 22 11 13 2 9 22 2" />
                                </svg>
                                Send Counter Offer
                            </button>
                        </div>
                    </form>

                @endif

            </div>

        </div>

    </div>

</x-client-layout>

<script>
    const brThread = document.getElementById('brThread');
    if (brThread) brThread.scrollTop = brThread.scrollHeight;
</script>

</x-client-layout>