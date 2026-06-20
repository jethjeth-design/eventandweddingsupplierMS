@if (auth()->user()->isAdmin())
    <x-app-layout>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap');

            .msg-page * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            .msg-page {
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

                background: var(--stone);
                height: calc(100vh - 58px);
                display: flex;
                overflow: hidden;
                padding: 1rem;
                gap: 1rem;
            }

            /* ══════════════════════════════
           SIDEBAR
        ══════════════════════════════ */
            .msg-sidebar {
                width: 305px;
                flex-shrink: 0;
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: 16px;
                display: flex;
                flex-direction: column;
                overflow: hidden;
                box-shadow: 0 2px 14px rgba(20, 17, 14, .05);
            }

            .sb-head {
                padding: 1rem 1.1rem 0.85rem;
                border-bottom: 1px solid var(--border);
                flex-shrink: 0;
            }

            .sb-top-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 0.72rem;
            }

            .sb-title {
                font-family: 'Cormorant Garamond', Georgia, serif;
                font-size: 1.18rem;
                font-weight: 700;
                color: var(--ink);
                line-height: 1;
                letter-spacing: 0.01em;
            }

            .sb-title em {
                font-style: italic;
                color: var(--gold);
            }

            .sb-badge {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 4px 11px;
                background: var(--gold-dim);
                color: var(--gold);
                border: 1px solid var(--gold-border);
                border-radius: 999px;
                font-size: 0.68rem;
                font-weight: 600;
                letter-spacing: 0.04em;
                font-family: 'Outfit', sans-serif;
            }

            .sb-search {
                display: flex;
                align-items: center;
                gap: 0.4rem;
                background: var(--stone);
                border: 1px solid var(--border);
                border-radius: 9px;
                padding: 0.4rem 0.75rem;
                margin-bottom: 0.72rem;
                transition: border-color .2s, box-shadow .2s;
            }

            .sb-search:focus-within {
                border-color: var(--gold);
                box-shadow: 0 0 0 3px rgba(184, 146, 74, 0.08);
            }

            .sb-search svg {
                width: 12px;
                height: 12px;
                color: var(--mist-light);
                flex-shrink: 0;
            }

            .sb-search input {
                border: none;
                outline: none;
                background: transparent;
                font-family: 'Outfit', sans-serif;
                font-size: 0.77rem;
                color: var(--ink);
                width: 100%;
            }

            .sb-search input::placeholder {
                color: var(--mist-light);
            }

            /* ── Filter tabs ── */
            .sb-tabs {
                display: flex;
                gap: 5px;
            }

            .sb-tab {
                flex: 1;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 4px;
                padding: 6px 4px;
                border: 1.5px solid var(--border);
                border-radius: 10px;
                background: var(--stone);
                font-family: 'Outfit', sans-serif;
                font-size: 0.67rem;
                font-weight: 600;
                color: var(--mist);
                cursor: pointer;
                transition: all .18s;
                white-space: nowrap;
                letter-spacing: 0.03em;
            }

            .sb-tab:hover {
                border-color: var(--gold);
                color: var(--gold);
                background: var(--gold-dim);
            }

            .sb-tab.active {
                background: var(--ink);
                border-color: var(--ink);
                color: var(--gold-light);
                box-shadow: 0 2px 8px rgba(20, 17, 14, 0.18);
            }

            .sb-tab.active .tab-badge {
                background: var(--gold);
                color: var(--ink);
            }

            .tab-badge {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 16px;
                height: 16px;
                padding: 0 4px;
                border-radius: 999px;
                background: rgba(184, 146, 74, 0.18);
                color: var(--gold);
                font-size: 0.52rem;
                font-weight: 700;
                line-height: 1;
            }

            .sb-tab svg {
                width: 11px;
                height: 11px;
                flex-shrink: 0;
            }

            /* Scroll */
            .sb-scroll {
                flex: 1;
                overflow-y: auto;
                padding: 0.45rem 0 0.75rem;
                scrollbar-width: thin;
                scrollbar-color: var(--border) transparent;
            }

            .sb-scroll::-webkit-scrollbar {
                width: 3px;
            }

            .sb-scroll::-webkit-scrollbar-thumb {
                background: var(--border);
                border-radius: 99px;
            }

            .sb-group-label {
                font-size: 0.53rem;
                font-weight: 700;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                color: var(--mist-light);
                padding: 0.7rem 1.1rem 0.28rem;
            }

            .sb-divider {
                height: 1px;
                background: linear-gradient(90deg, transparent, var(--border), transparent);
                margin: 0.35rem 0.9rem;
            }

            /* Conversation row */
            .sb-item {
                display: flex;
                align-items: center;
                gap: 0.6rem;
                padding: 0.58rem 0.9rem;
                margin: 0.04rem 0.4rem;
                border-radius: 10px;
                cursor: pointer;
                border: none;
                background: none;
                width: calc(100% - 0.8rem);
                text-align: left;
                font-family: 'Outfit', sans-serif;
                transition: background .15s;
                position: relative;
                text-decoration: none;
                color: inherit;
            }

            .sb-item:hover {
                background: var(--stone);
            }

            .sb-item.is-active {
                background: linear-gradient(135deg, rgba(184, 146, 74, 0.15) 0%, rgba(184, 146, 74, 0.05) 100%);
            }

            .sb-item.is-active::before {
                content: '';
                position: absolute;
                left: -0.4rem;
                top: 22%;
                bottom: 22%;
                width: 3px;
                border-radius: 0 3px 3px 0;
                background: linear-gradient(to bottom, var(--gold-light), var(--gold));
            }

            /* Avatar */
            .sb-ava {
                width: 38px;
                height: 38px;
                border-radius: 50%;
                flex-shrink: 0;
                background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Cormorant Garamond', serif;
                font-size: 0.85rem;
                font-weight: 700;
                color: var(--white);
                border: 1.5px solid rgba(184, 146, 74, 0.2);
                position: relative;
                flex-shrink: 0;
            }

            .sb-ava.is-group {
                background: linear-gradient(135deg, #5C4B8A 0%, #3D3060 100%);
                border-color: rgba(92, 75, 138, 0.3);
            }

            .sb-ava.is-direct {
                background: linear-gradient(135deg, var(--ink) 0%, #3D3530 100%);
                border-color: rgba(184, 146, 74, 0.28);
            }

            .online-dot {
                position: absolute;
                bottom: 0;
                right: 0;
                width: 9px;
                height: 9px;
                border-radius: 50%;
                background: var(--success);
                border: 2px solid var(--white);
            }

            .sb-info {
                flex: 1;
                min-width: 0;
            }

            .sb-name {
                font-size: 0.8rem;
                font-weight: 500;
                color: var(--ink);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .sb-name.has-unread {
                font-weight: 700;
            }

            .sb-sub {
                font-size: 0.66rem;
                color: var(--mist);
                margin-top: 1px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .sb-meta {
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                gap: 4px;
                flex-shrink: 0;
            }

            .sb-time {
                font-size: 0.59rem;
                color: var(--mist-light);
            }

            .sb-pill {
                font-size: 0.52rem;
                font-weight: 700;
                letter-spacing: 0.07em;
                text-transform: uppercase;
                padding: 2px 7px;
                border-radius: 999px;
                white-space: nowrap;
            }

            .sb-pill.group {
                background: rgba(92, 75, 138, 0.1);
                color: #5C4B8A;
                border: 1px solid rgba(92, 75, 138, 0.2);
            }

            .sb-pill.direct {
                background: var(--gold-dim);
                color: #8A6A2C;
                border: 1px solid var(--gold-border);
            }

            .sb-unread-badge {
                min-width: 17px;
                height: 17px;
                border-radius: 999px;
                background: var(--gold);
                color: var(--ink);
                font-size: 0.52rem;
                font-weight: 700;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 0 4px;
            }

            .sb-empty {
                padding: 2rem 1rem;
                text-align: center;
                font-size: 0.75rem;
                color: var(--mist);
            }

            .sb-empty svg {
                width: 30px;
                height: 30px;
                display: block;
                margin: 0 auto 0.5rem;
                opacity: .25;
            }

            /* ══════════════════════════════
           MAIN CHAT PANEL
        ══════════════════════════════ */
            .msg-main {
                flex: 1;
                min-width: 0;
                display: flex;
                flex-direction: column;
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 2px 14px rgba(20, 17, 14, .05);
            }

            /* Chat header */
            .chat-head {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.85rem 1.25rem;
                border-bottom: 1px solid var(--border);
                flex-shrink: 0;
                background: var(--white);
            }

            .chat-head-ava {
                width: 42px;
                height: 42px;
                border-radius: 50%;
                flex-shrink: 0;
                background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Cormorant Garamond', serif;
                font-size: 1rem;
                font-weight: 700;
                color: var(--white);
                border: 2px solid rgba(184, 146, 74, 0.22);
                position: relative;
            }

            .chat-head-ava.is-group {
                background: linear-gradient(135deg, #5C4B8A 0%, #3D3060 100%);
            }

            .chat-head-ava.is-direct {
                background: linear-gradient(135deg, var(--ink) 0%, #3D3530 100%);
            }

            .chat-head-ava .online-dot {
                position: absolute;
                bottom: 1px;
                right: 1px;
                width: 10px;
                height: 10px;
                border: 2px solid var(--white);
            }

            .chat-head-info {
                flex: 1;
                min-width: 0;
            }

            .chat-head-name {
                font-family: 'Cormorant Garamond', serif;
                font-size: 1.08rem;
                font-weight: 700;
                color: var(--ink);
                line-height: 1.1;
            }

            .chat-head-sub {
                font-size: 0.65rem;
                color: var(--mist);
                margin-top: 2px;
                display: flex;
                align-items: center;
                gap: 0.28rem;
            }

            .dot-online {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background: var(--success);
                display: inline-block;
            }

            .chat-head-acts {
                display: flex;
                gap: 0.38rem;
            }

            .ch-btn {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                border: 1px solid var(--border);
                background: var(--stone);
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--mist);
                cursor: pointer;
                transition: all .15s;
            }

            .ch-btn:hover {
                border-color: var(--gold);
                color: var(--gold);
                background: var(--gold-dim);
            }

            .ch-btn svg {
                width: 14px;
                height: 14px;
            }

            /* Back button — mobile only */
            .ch-back-btn {
                display: none;
                width: 32px;
                height: 32px;
                border-radius: 8px;
                border: 1px solid var(--border);
                background: var(--stone);
                align-items: center;
                justify-content: center;
                color: var(--mist);
                cursor: pointer;
                transition: all .15s;
                text-decoration: none;
                flex-shrink: 0;
            }

            .ch-back-btn svg {
                width: 16px;
                height: 16px;
            }

            .ch-back-btn:hover {
                border-color: var(--gold);
                color: var(--gold);
                background: var(--gold-dim);
            }

            /* Messages area */
            .chat-body {
                flex: 1;
                overflow-y: auto;
                padding: 1.25rem;
                display: flex;
                flex-direction: column;
                gap: 0.65rem;
                background: var(--stone);
                scrollbar-width: thin;
                scrollbar-color: var(--border) transparent;
            }

            .chat-body::-webkit-scrollbar {
                width: 3px;
            }

            .chat-body::-webkit-scrollbar-thumb {
                background: var(--border);
                border-radius: 99px;
            }

            /* Date chip */
            .chat-date {
                text-align: center;
                font-size: 0.63rem;
                color: var(--mist-light);
                margin: 0.35rem 0;
                position: relative;
            }

            .chat-date span {
                background: var(--stone-2);
                padding: 2px 10px;
                border-radius: 999px;
                border: 1px solid var(--border);
                position: relative;
                z-index: 1;
            }

            .chat-date::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 0;
                right: 0;
                height: 1px;
                background: var(--border);
            }

            /* Bubble */
            .brow {
                display: flex;
                align-items: flex-end;
                gap: 0.48rem;
            }

            .brow.me {
                flex-direction: row-reverse;
            }

            .bava {
                width: 28px;
                height: 28px;
                border-radius: 50%;
                flex-shrink: 0;
                background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Cormorant Garamond', serif;
                font-size: 0.64rem;
                font-weight: 700;
                color: var(--white);
                border: 1.5px solid rgba(184, 146, 74, 0.18);
            }

            .bava.is-me {
                background: linear-gradient(135deg, var(--ink) 0%, #3D3530 100%);
            }

            .bblock {
                display: flex;
                flex-direction: column;
                max-width: 65%;
                gap: 2px;
            }

            .brow.me .bblock {
                align-items: flex-end;
            }

            .bsender {
                font-size: 0.61rem;
                font-weight: 600;
                color: var(--mist);
                padding: 0 3px;
            }

            .bubble {
                padding: 0.6rem 0.9rem;
                border-radius: 14px;
                font-size: 0.81rem;
                line-height: 1.55;
                word-break: break-word;
            }

            .bubble.them {
                background: var(--white);
                color: var(--ink);
                border: 1px solid var(--border);
                border-bottom-left-radius: 4px;
            }

            .bubble.me {
                background: var(--ink);
                color: var(--gold-pale);
                border-bottom-right-radius: 4px;
            }

            .btime {
                font-size: 0.58rem;
                color: var(--mist-light);
                padding: 0 3px;
            }

            /* Image attachment */
            .bubble-img {
                max-width: 220px;
                border-radius: 10px;
                overflow: hidden;
                margin-top: 2px;
                border: 1px solid var(--border);
                cursor: pointer;
            }

            .bubble-img img {
                width: 100%;
                display: block;
            }

            @keyframes bubbleIn {
                from {
                    opacity: 0;
                    transform: translateY(5px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .brow {
                animation: bubbleIn .15s ease both;
            }

            /* ══════════════════════════════
           CHAT FOOTER
        ══════════════════════════════ */
            .chat-foot {
                border-top: 1px solid var(--border);
                flex-shrink: 0;
                background: var(--white);
            }

            /* File preview */
            .file-preview-bar {
                display: none;
                align-items: center;
                gap: 0.6rem;
                padding: 0.6rem 1.1rem;
                background: var(--gold-dim);
                border-bottom: 1px solid var(--gold-border);
            }

            .file-preview-bar.show {
                display: flex;
            }

            .fp-thumb {
                width: 40px;
                height: 40px;
                border-radius: 8px;
                object-fit: cover;
                border: 1px solid var(--gold-border);
                flex-shrink: 0;
            }

            .fp-name {
                flex: 1;
                font-size: 0.75rem;
                color: var(--ink);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .fp-size {
                font-size: 0.67rem;
                color: var(--mist);
                flex-shrink: 0;
            }

            .fp-remove {
                width: 22px;
                height: 22px;
                border-radius: 50%;
                background: rgba(20, 17, 14, 0.1);
                border: none;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                color: var(--ink);
                flex-shrink: 0;
                transition: background .15s;
            }

            .fp-remove:hover {
                background: rgba(192, 57, 43, 0.15);
                color: var(--danger);
            }

            .fp-remove svg {
                width: 12px;
                height: 12px;
            }

            /* Input row */
            .chat-input-wrap {
                padding: 0.75rem 1.1rem;
            }

            .chat-input-row {
                display: flex;
                align-items: flex-end;
                gap: 0.5rem;
                background: var(--stone);
                border: 1.5px solid var(--border);
                border-radius: 14px;
                padding: 0.5rem 0.6rem 0.5rem 0.95rem;
                transition: border-color .2s, box-shadow .2s;
            }

            .chat-input-row:focus-within {
                border-color: var(--gold);
                box-shadow: 0 0 0 3px rgba(184, 146, 74, 0.08);
            }

            .chat-attach-btn {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                flex-shrink: 0;
                border: none;
                background: transparent;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--mist-light);
                cursor: pointer;
                transition: color .15s;
                position: relative;
            }

            .chat-attach-btn:hover {
                color: var(--gold);
            }

            .chat-attach-btn svg {
                width: 17px;
                height: 17px;
            }

            .chat-attach-btn input[type=file] {
                position: absolute;
                inset: 0;
                opacity: 0;
                cursor: pointer;
                width: 100%;
                height: 100%;
            }

            .chat-ta {
                flex: 1;
                border: none;
                outline: none;
                background: transparent;
                font-family: 'Outfit', sans-serif;
                font-size: 0.81rem;
                color: var(--ink);
                resize: none;
                line-height: 1.5;
                max-height: 96px;
                min-height: 22px;
            }

            .chat-ta::placeholder {
                color: var(--mist-light);
            }

            .chat-foot-btns {
                display: flex;
                align-items: center;
                gap: 4px;
                flex-shrink: 0;
                position: relative;
            }

            /* Emoji button */
            .chat-emoji-btn {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                border: 1.5px solid var(--border);
                background: var(--stone);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                cursor: pointer;
                line-height: 1;
                transition: all .18s;
                flex-shrink: 0;
            }

            .chat-emoji-btn:hover {
                border-color: var(--gold);
                background: var(--gold-dim);
                transform: scale(1.08);
            }

            .chat-emoji-btn.is-open {
                border-color: var(--gold);
                background: var(--gold-dim);
                box-shadow: 0 0 0 3px rgba(184, 146, 74, 0.12);
            }

            /* Emoji picker */
            .emoji-picker {
                display: none;
                position: absolute;
                bottom: calc(100% + 10px);
                right: 0;
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: 16px;
                padding: 0.75rem;
                box-shadow: 0 10px 40px rgba(20, 17, 14, .18);
                width: 280px;
                z-index: 50;
                animation: popIn .15s ease;
            }

            .emoji-picker.open {
                display: block;
            }

            @keyframes popIn {
                from {
                    opacity: 0;
                    transform: translateY(8px) scale(0.97);
                }

                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }

            .ep-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 0.55rem;
                padding-bottom: 0.5rem;
                border-bottom: 1px solid var(--border);
            }

            .ep-header-title {
                font-family: 'Cormorant Garamond', serif;
                font-size: 0.88rem;
                font-weight: 700;
                color: var(--ink);
            }

            .ep-header-title em {
                font-style: italic;
                color: var(--gold);
            }

            .ep-close {
                width: 22px;
                height: 22px;
                border-radius: 6px;
                border: none;
                background: var(--stone);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                color: var(--mist);
                transition: all .12s;
                font-size: 13px;
                line-height: 1;
            }

            .ep-close:hover {
                background: var(--stone-2);
                color: var(--ink);
            }

            .ep-search {
                display: flex;
                align-items: center;
                gap: 5px;
                background: var(--stone);
                border: 1px solid var(--border);
                border-radius: 8px;
                padding: 4px 8px;
                margin-bottom: 0.5rem;
                transition: border-color .18s;
            }

            .ep-search:focus-within {
                border-color: var(--gold);
            }

            .ep-search svg {
                width: 11px;
                height: 11px;
                color: var(--mist-light);
                flex-shrink: 0;
            }

            .ep-search input {
                border: none;
                outline: none;
                background: transparent;
                font-family: 'Outfit', sans-serif;
                font-size: 0.72rem;
                color: var(--ink);
                width: 100%;
            }

            .ep-search input::placeholder {
                color: var(--mist-light);
            }

            .ep-cats {
                display: flex;
                gap: 3px;
                margin-bottom: 0.5rem;
            }

            .ep-cat-btn {
                flex: 1;
                padding: 4px 2px;
                border: 1.5px solid var(--border);
                border-radius: 7px;
                background: transparent;
                font-size: 14px;
                cursor: pointer;
                transition: all .14s;
                text-align: center;
                line-height: 1;
            }

            .ep-cat-btn:hover {
                border-color: var(--gold);
                background: var(--gold-dim);
            }

            .ep-cat-btn.ep-cat-active {
                border-color: var(--gold);
                background: var(--gold-dim);
                box-shadow: 0 0 0 2px rgba(184, 146, 74, 0.14);
            }

            .ep-label {
                font-size: 0.55rem;
                font-weight: 700;
                letter-spacing: 0.13em;
                text-transform: uppercase;
                color: var(--mist-light);
                margin-bottom: 5px;
                margin-top: 2px;
            }

            .ep-section {
                display: none;
            }

            .ep-section.ep-active {
                display: block;
            }

            .ep-grid {
                display: grid;
                grid-template-columns: repeat(8, 1fr);
                gap: 2px;
            }

            .ep-emoji {
                font-size: 19px;
                cursor: pointer;
                padding: 4px 3px;
                border-radius: 7px;
                text-align: center;
                transition: background .11s, transform .11s;
                line-height: 1;
            }

            .ep-emoji:hover {
                background: var(--stone-2);
                transform: scale(1.18);
            }

            .ep-search-results {
                display: none;
            }

            .ep-search-results.show {
                display: block;
            }

            /* Send button */
            .chat-send-btn {
                width: 34px;
                height: 34px;
                border-radius: 9px;
                flex-shrink: 0;
                background: var(--ink);
                border: none;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--gold-light);
                cursor: pointer;
                transition: all .18s;
            }

            .chat-send-btn:hover {
                background: var(--gold);
                color: var(--white);
                transform: scale(1.05);
            }

            .chat-send-btn svg {
                width: 14px;
                height: 14px;
            }

            /* Welcome / empty state */
            .chat-welcome {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 0.75rem;
                padding: 2rem;
                background: var(--stone);
            }

            .cw-icon {
                width: 64px;
                height: 64px;
                border-radius: 50%;
                background: var(--gold-dim);
                border: 1px solid var(--gold-border);
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--gold);
            }

            .cw-icon svg {
                width: 28px;
                height: 28px;
            }

            .cw-title {
                font-family: 'Cormorant Garamond', serif;
                font-size: 1.15rem;
                font-weight: 700;
                color: var(--ink);
            }

            .cw-title em {
                font-style: italic;
                color: var(--gold);
            }

            .cw-sub {
                font-size: 0.75rem;
                color: var(--mist);
                text-align: center;
                line-height: 1.65;
            }

            /* Lightbox */
            .lb-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(20, 17, 14, .88);
                z-index: 9999;
                align-items: center;
                justify-content: center;
            }

            .lb-overlay.open {
                display: flex;
            }

            .lb-overlay img {
                max-width: 90vw;
                max-height: 88vh;
                border-radius: 12px;
            }

            .lb-close {
                position: absolute;
                top: 1rem;
                right: 1rem;
                width: 36px;
                height: 36px;
                border-radius: 50%;
                background: rgba(255, 255, 255, .12);
                border: none;
                color: #fff;
                font-size: 20px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* ══════════════════════════════
           MOBILE RESPONSIVE
           ≤ 768px: show ONLY sidebar
           (conversation list). Chat panel
           is hidden unless a conversation
           is active — then sidebar hides
           and chat shows full-screen.
        ══════════════════════════════ */
            @media (max-width: 768px) {
                .msg-page {
                    padding: 0;
                    gap: 0;
                    height: 100dvh;
                    border-radius: 0;
                    flex-direction: column;
                    overflow: hidden;
                }

                /* Sidebar takes full screen on mobile */
                .msg-sidebar {
                    width: 100%;
                    flex: 1;
                    border-radius: 0;
                    border: none;
                    border-bottom: 1px solid var(--border);
                    box-shadow: none;
                    min-height: 0;
                }

                /* Mobile sidebar header tweaks */
                .sb-head {
                    padding: 0.9rem 1rem 0.75rem;
                    /* Safe area for notch */
                    padding-top: calc(0.9rem + env(safe-area-inset-top, 0px));
                }

                /* Larger touch targets for conversation rows */
                .sb-item {
                    padding: 0.75rem 1rem;
                    margin: 0.06rem 0.5rem;
                }

                .sb-ava {
                    width: 44px;
                    height: 44px;
                    font-size: 0.95rem;
                }

                .sb-name {
                    font-size: 0.88rem;
                }

                .sb-sub {
                    font-size: 0.72rem;
                }

                .sb-time {
                    font-size: 0.65rem;
                }

                /* On mobile, main chat panel hides when no active conversation */
                .msg-main {
                    display: none;
                }

                /* ── When a conversation IS open on mobile:
               hide sidebar, show chat full-screen ── */
                .msg-page.mobile-chat-open .msg-sidebar {
                    display: none;
                }

                .msg-page.mobile-chat-open .msg-main {
                    display: flex;
                    flex: 1;
                    border-radius: 0;
                    border: none;
                    box-shadow: none;
                    min-height: 0;
                    width: 100%;
                }

                /* Mobile chat header tweaks */
                .chat-head {
                    padding: 0.75rem 1rem;
                    padding-top: calc(0.75rem + env(safe-area-inset-top, 0px));
                }

                .chat-head-ava {
                    width: 38px;
                    height: 38px;
                    font-size: 0.9rem;
                }

                .chat-head-name {
                    font-size: 1rem;
                }

                /* Show the back button on mobile */
                .ch-back-btn {
                    display: flex;
                }

                /* Wider bubbles on small screens */
                .bblock {
                    max-width: 80%;
                }

                .bubble {
                    font-size: 0.85rem;
                }

                /* Emoji picker — full width on mobile */
                .emoji-picker {
                    width: calc(100vw - 2rem);
                    right: -1rem;
                    left: auto;
                    max-width: 320px;
                }

                /* Input wrap bottom safe area */
                .chat-input-wrap {
                    padding: 0.6rem 0.85rem;
                    padding-bottom: calc(0.6rem + env(safe-area-inset-bottom, 0px));
                }

                /* Chat body padding */
                .chat-body {
                    padding: 1rem 0.85rem;
                }
            }

            /* Very small phones */
            @media (max-width: 380px) {
                .sb-tabs {
                    gap: 3px;
                }

                .sb-tab {
                    font-size: 0.6rem;
                    padding: 5px 2px;
                }
            }
        </style>

        @php
            $authId = auth()->id();
            $authName = auth()->user()->name ?? 'Admin';
            $activeId = $conversation?->id ?? null;

            $unreadCount = $conversations
                ->filter(function ($c) use ($authId) {
                    $last = $c->messages->last();
                    return $last && $last->sender_id != $authId;
                })
                ->count();

            $groupCount = $conversations->filter(fn($c) => $c->type === 'group')->count();
        @endphp

        {{-- Add class to trigger mobile chat view when a conversation is open --}}
        <div class="msg-page {{ $activeId ? 'mobile-chat-open' : '' }}">

            {{-- ═══════════════════════════════
            SIDEBAR
        ═══════════════════════════════ --}}
            <aside class="msg-sidebar">

                <div class="sb-head">
                    <div class="sb-top-row">
                        <div class="sb-title">Chats</div>
                        <span class="sb-badge">{{ $conversations->count() }} chats</span>
                    </div>

                    <div class="sb-search">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="11" cy="11" r="7" />
                            <path d="M17 17l3 3" />
                        </svg>
                        <input type="text" id="sbSearch" placeholder="Search conversations…" autocomplete="off">
                    </div>

                    <div class="sb-tabs">
                        {{-- ALL --}}
                        <button class="sb-tab active" data-filter="all" onclick="setTab(this)" title="All">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16a2 2 0 012 2v8a2 2 0 01-2 2H7l-5 4V6a2 2 0 012-2z" />
                            </svg>
                            All
                        </button>
                        {{-- UNREAD --}}
                        <button class="sb-tab" data-filter="unread" onclick="setTab(this)" title="Unread">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0" />
                            </svg>
                            Unread
                            @if ($unreadCount > 0)
                                <span class="tab-badge">{{ $unreadCount }}</span>
                            @endif
                        </button>
                        {{-- GROUPS --}}
                        <button class="sb-tab" data-filter="groups" onclick="setTab(this)" title="Groups">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                            </svg>
                            Groups
                            @if ($groupCount > 0)
                                <span class="tab-badge">{{ $groupCount }}</span>
                            @endif
                        </button>
                    </div>
                </div>

                <div class="sb-scroll">

                    <div class="sb-group-label" id="lbl-all">Conversations</div>

                    @forelse($conversations as $conv)
                        @php
                            $other = $conv->participants->where('user_id', '!=', auth()->id())->first()?->user;
                            $dname = $conv->title ?? ($other?->name ?? ucfirst($conv->type ?? 'Chat'));
                            $ini = strtoupper(substr($dname, 0, 2));
                            $last = optional($conv->messages->last())->message ?? 'No messages yet';
                            $time = $conv->messages->last()?->created_at;
                            $isGrp = $conv->type === 'group';
                            $isUnrd = $conv->messages->last() && $conv->messages->last()->sender_id != $authId;
                            $isA = $activeId == $conv->id;
                        @endphp
                        <a href="{{ route('messages.inbox', ['conversation_id' => $conv->id]) }}"
                            class="sb-item {{ $isA ? 'is-active' : '' }}" data-name="{{ strtolower($dname) }}"
                            data-is-unread="{{ $isUnrd ? '1' : '0' }}" data-is-group="{{ $isGrp ? '1' : '0' }}">
                            <div class="sb-ava {{ $isGrp ? 'is-group' : 'is-direct' }}">
                                {{ $ini }}
                                @if (!$isGrp)
                                    <span class="online-dot"></span>
                                @endif
                            </div>
                            <div class="sb-info">
                                <div class="sb-name {{ $isUnrd ? 'has-unread' : '' }}">{{ $dname }}</div>
                                <div class="sb-sub">{{ \Illuminate\Support\Str::limit($last, 36) }}</div>
                            </div>
                            <div class="sb-meta">
                                @if ($time)
                                    <div class="sb-time">{{ $time->diffForHumans(null, true) }}</div>
                                @endif
                                @if ($isGrp)
                                    <span class="sb-pill group">Group</span>
                                @elseif($isUnrd)
                                    <span class="sb-unread-badge">!</span>
                                @endif
                            </div>
                        </a>
                    @empty
                        <div class="sb-empty">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5">
                                <path d="M4 4h16a2 2 0 012 2v8a2 2 0 01-2 2H7l-5 4V6a2 2 0 012-2z" />
                            </svg>
                            No conversations yet.
                        </div>
                    @endforelse

                </div>
            </aside>

            {{-- ═══════════════════════════════
            MAIN CHAT PANEL
        ═══════════════════════════════ --}}
            <section class="msg-main">

                @if (isset($conversation))

                    @php
                        $chatOther = $conversation->participants->where('user_id', '!=', auth()->id())->first()?->user;
                        $chatName =
                            $conversation->title ?? ($chatOther?->name ?? ucfirst($conversation->type ?? 'Chat'));
                        $chatInit = strtoupper(substr($chatName, 0, 2));
                        $chatIsGrp = $conversation->type === 'group';
                        $chatSub = $chatIsGrp
                            ? 'Group · ' . $conversation->participants->count() . ' members'
                            : $chatOther?->email ?? 'Direct message';
                    @endphp

                    <div class="chat-head">
                        {{-- Back button (mobile only) --}}
                        <a href="{{ route('messages.inbox') }}" class="ch-back-btn" title="Back to conversations">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <polyline points="15 18 9 12 15 6" />
                            </svg>
                        </a>

                        <div class="chat-head-ava {{ $chatIsGrp ? 'is-group' : 'is-direct' }}">
                            {{ $chatInit }}
                            @if (!$chatIsGrp)
                                <span class="online-dot"></span>
                            @endif
                        </div>
                        <div class="chat-head-info">
                            <div class="chat-head-name">{{ $chatName }}</div>
                            <div class="chat-head-sub">
                                @if (!$chatIsGrp)
                                    <span class="dot-online"></span>
                                @endif
                                {{ $chatSub }}
                            </div>
                        </div>
                        <div class="chat-head-acts">
                            <button class="ch-btn" title="Participant info">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                                </svg>
                            </button>
                            <button class="ch-btn" title="Search messages">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="7" />
                                    <path d="M17 17l3 3" />
                                </svg>
                            </button>
                            <button class="ch-btn" title="More options">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="5" cy="12" r="1" />
                                    <circle cx="12" cy="12" r="1" />
                                    <circle cx="19" cy="12" r="1" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Messages --}}
                    <div class="chat-body" id="chatBody">
                        @php $prevDate = null; @endphp
                        @forelse($conversation->messages as $message)
                            @php
                                $isMe = $message->sender_id == $authId;
                                $mDate = $message->created_at->format('M d, Y');
                                $mTime = $message->created_at->format('g:i A');
                                $sName = $message->sender?->name ?? 'Unknown';
                                $sInit = strtoupper(substr($sName, 0, 2));
                            @endphp

                            @if ($mDate !== $prevDate)
                                <div class="chat-date"><span>{{ $mDate }}</span></div>
                                @php $prevDate = $mDate; @endphp
                            @endif

                            <div class="brow {{ $isMe ? 'me' : '' }}">
                                @if (!$isMe)
                                    <div class="bava">{{ $sInit }}</div>
                                @else
                                    <div class="bava is-me">{{ strtoupper(substr($authName, 0, 2)) }}</div>
                                @endif
                                <div class="bblock">
                                    @if (!$isMe)
                                        <div class="bsender">{{ $sName }}</div>
                                    @endif

                                    @if ($message->file)
                                        <div class="bubble-img"
                                            onclick="openLightbox('{{ asset('storage/' . $message->file) }}')">
                                            <img src="{{ asset('storage/' . $message->file) }}" alt="attachment">
                                        </div>
                                    @endif

                                    @if (!empty($message->message))
                                        <div class="bubble {{ $isMe ? 'me' : 'them' }}">{{ $message->message }}</div>
                                    @endif

                                    <div class="btime">{{ $mTime }}</div>
                                </div>
                            </div>
                        @empty
                            <div
                                style="flex:1;display:flex;align-items:center;justify-content:center;font-size:.78rem;color:var(--mist);">
                                No messages yet — say hello! 👋
                            </div>
                        @endforelse
                    </div>

                    {{-- Footer --}}
                    <div class="chat-foot">

                        {{-- File preview bar --}}
                        <div class="file-preview-bar" id="filePreviewBar">
                            <img class="fp-thumb" id="fpThumb" src="" alt="">
                            <div>
                                <div class="fp-name" id="fpName"></div>
                                <div class="fp-size" id="fpSize"></div>
                            </div>
                            <button type="button" class="fp-remove" onclick="clearFile()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <line x1="18" y1="6" x2="6" y2="18" />
                                    <line x1="6" y1="6" x2="18" y2="18" />
                                </svg>
                            </button>
                        </div>

                        <div class="chat-input-wrap">
                            <form method="POST" action="{{ route('messages.send') }}" id="chatForm"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                                <div class="chat-input-row">

                                    {{-- Attach --}}
                                    <button type="button" class="chat-attach-btn" title="Attach file">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.8">
                                            <path
                                                d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48" />
                                        </svg>
                                        <input type="file" name="file" id="fileInput" accept="image/*"
                                            onchange="previewFile(this)">
                                    </button>

                                    {{-- Textarea --}}
                                    <textarea name="message" id="chatTa" class="chat-ta" placeholder="Type a message…" rows="1"></textarea>

                                    <div class="chat-foot-btns">

                                        {{-- Emoji trigger --}}
                                        <button type="button" class="chat-emoji-btn" id="emojiBtn"
                                            onclick="toggleEmoji(event)" title="Insert emoji">😊</button>

                                        {{-- Emoji picker --}}
                                        <div class="emoji-picker" id="emojiPicker">
                                            <div class="ep-header">
                                                <div class="ep-header-title">Em<em>oji</em></div>
                                                <button type="button" class="ep-close"
                                                    onclick="closeEmoji()">✕</button>
                                            </div>
                                            <div class="ep-search">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <circle cx="11" cy="11" r="7" />
                                                    <path d="M17 17l3 3" />
                                                </svg>
                                                <input type="text" id="emojiSearch" placeholder="Search emoji…"
                                                    oninput="searchEmoji(this.value)" autocomplete="off">
                                            </div>
                                            <div class="ep-search-results" id="epSearchResults">
                                                <div class="ep-grid" id="epSearchGrid"></div>
                                            </div>
                                            <div class="ep-cats" id="epCats">
                                                <button type="button" class="ep-cat-btn ep-cat-active"
                                                    data-cat="smileys" onclick="switchCat(this)"
                                                    title="Smileys">😀</button>
                                                <button type="button" class="ep-cat-btn" data-cat="gestures"
                                                    onclick="switchCat(this)" title="Gestures">👍</button>
                                                <button type="button" class="ep-cat-btn" data-cat="hearts"
                                                    onclick="switchCat(this)" title="Hearts">❤️</button>
                                                <button type="button" class="ep-cat-btn" data-cat="nature"
                                                    onclick="switchCat(this)" title="Nature">🌸</button>
                                                <button type="button" class="ep-cat-btn" data-cat="food"
                                                    onclick="switchCat(this)" title="Food">🍕</button>
                                                <button type="button" class="ep-cat-btn" data-cat="travel"
                                                    onclick="switchCat(this)" title="Travel">✈️</button>
                                                <button type="button" class="ep-cat-btn" data-cat="objects"
                                                    onclick="switchCat(this)" title="Objects">💡</button>
                                                <button type="button" class="ep-cat-btn" data-cat="symbols"
                                                    onclick="switchCat(this)" title="Symbols">🎉</button>
                                            </div>
                                            <div class="ep-section ep-active" id="cat-smileys">
                                                <div class="ep-label">Smileys & Emotion</div>
                                                <div class="ep-grid" id="epSmileys"></div>
                                            </div>
                                            <div class="ep-section" id="cat-gestures">
                                                <div class="ep-label">Gestures & People</div>
                                                <div class="ep-grid" id="epGestures"></div>
                                            </div>
                                            <div class="ep-section" id="cat-hearts">
                                                <div class="ep-label">Hearts & Stars</div>
                                                <div class="ep-grid" id="epHearts"></div>
                                            </div>
                                            <div class="ep-section" id="cat-nature">
                                                <div class="ep-label">Animals & Nature</div>
                                                <div class="ep-grid" id="epNature"></div>
                                            </div>
                                            <div class="ep-section" id="cat-food">
                                                <div class="ep-label">Food & Drink</div>
                                                <div class="ep-grid" id="epFood"></div>
                                            </div>
                                            <div class="ep-section" id="cat-travel">
                                                <div class="ep-label">Travel & Places</div>
                                                <div class="ep-grid" id="epTravel"></div>
                                            </div>
                                            <div class="ep-section" id="cat-objects">
                                                <div class="ep-label">Objects</div>
                                                <div class="ep-grid" id="epObjects"></div>
                                            </div>
                                            <div class="ep-section" id="cat-symbols">
                                                <div class="ep-label">Symbols & Activities</div>
                                                <div class="ep-grid" id="epSymbols"></div>
                                            </div>
                                        </div>

                                        {{-- Send --}}
                                        <button type="submit" class="chat-send-btn" title="Send">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <line x1="22" y1="2" x2="11" y2="13" />
                                                <polygon points="22 2 15 22 11 13 2 9 22 2" />
                                            </svg>
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="chat-welcome">
                        <div class="cw-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.4">
                                <path d="M4 4h16a2 2 0 012 2v8a2 2 0 01-2 2H7l-5 4V6a2 2 0 012-2z" />
                            </svg>
                        </div>
                        <div class="cw-title">Select a convers<em>ation</em></div>
                        <div class="cw-sub">Choose any conversation from the left panel<br>to open and reply here.
                        </div>
                    </div>
                @endif

            </section>
        </div>

        {{-- Lightbox --}}
        <div class="lb-overlay" id="lbOverlay" onclick="closeLightbox()">
            <button class="lb-close" onclick="closeLightbox()">✕</button>
            <img id="lbImg" src="" alt="Preview">
        </div>

        <script>
            /* ── Auto-scroll to bottom ── */
            const chatBody = document.getElementById('chatBody');
            if (chatBody) chatBody.scrollTop = chatBody.scrollHeight;

            /* ── Textarea: auto-resize + Enter to send ── */
            const ta = document.getElementById('chatTa');
            if (ta) {
                ta.addEventListener('keydown', e => {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        document.getElementById('chatForm').submit();
                    }
                });
                ta.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = Math.min(this.scrollHeight, 96) + 'px';
                });
            }

            /* ── File preview ── */
            function previewFile(input) {
                const file = input.files[0];
                if (!file) return;
                const bar = document.getElementById('filePreviewBar');
                const fname = document.getElementById('fpName');
                const fsize = document.getElementById('fpSize');
                const thumb = document.getElementById('fpThumb');
                fname.textContent = file.name;
                fsize.textContent = (file.size / 1024).toFixed(1) + ' KB';
                if (file.type.startsWith('image/')) {
                    const r = new FileReader();
                    r.onload = e => {
                        thumb.src = e.target.result;
                        thumb.style.display = '';
                    };
                    r.readAsDataURL(file);
                } else {
                    thumb.style.display = 'none';
                }
                bar.classList.add('show');
            }

            function clearFile() {
                document.getElementById('fileInput').value = '';
                document.getElementById('filePreviewBar').classList.remove('show');
                document.getElementById('fpThumb').src = '';
            }

            /* ── Lightbox ── */
            function openLightbox(src) {
                document.getElementById('lbImg').src = src;
                document.getElementById('lbOverlay').classList.add('open');
            }

            function closeLightbox() {
                document.getElementById('lbOverlay').classList.remove('open');
            }

            /* ── Sidebar search ── */
            document.getElementById('sbSearch').addEventListener('input', function() {
                const q = this.value.toLowerCase();
                document.querySelectorAll('.sb-item[data-name]').forEach(el => {
                    el.style.display = el.dataset.name.includes(q) ? '' : 'none';
                });
            });

            /* ── Filter tabs ── */
            let activeFilter = 'all';

            function setTab(btn) {
                document.querySelectorAll('.sb-tab').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                activeFilter = btn.dataset.filter;
                applyFilter();
            }

            function applyFilter() {
                document.querySelectorAll('.sb-item').forEach(el => {
                    if (activeFilter === 'all') {
                        el.style.display = '';
                    } else if (activeFilter === 'unread') {
                        el.style.display = el.dataset.isUnread === '1' ? '' : 'none';
                    } else if (activeFilter === 'groups') {
                        el.style.display = el.dataset.isGroup === '1' ? '' : 'none';
                    }
                });
            }

            /* ══════════════════════════════
               EMOJI PICKER
            ══════════════════════════════ */
            const EMOJI_DATA = {
                smileys: ['😀', '😃', '😄', '😁', '😆', '😅', '😂', '🤣', '😊', '😇', '🥰', '😍', '🤩', '😘', '😗', '😙',
                    '😚', '🙂', '🤗', '🤭', '😏', '😒', '😞', '😔', '😟', '😕', '🙁', '☹️', '😣', '😖', '😫', '😩',
                    '🥺', '😢', '😭', '😤', '😠', '😡', '🤬', '😈'
                ],
                gestures: ['👍', '👎', '👌', '🤌', '✌️', '🤞', '🤙', '👋', '🙌', '👏', '🤝', '🙏', '💪', '🫶', '🤜', '🤛',
                    '☝️', '👆', '👇', '👉', '👈', '🤏', '✋', '🖖', '🫱', '🫲', '🫳', '🫴', '🖐️', '👐', '🤲', '🙆',
                    '🙅', '💁', '🙋', '🧏', '🤷', '🤦'
                ],
                hearts: ['❤️', '🧡', '💛', '💚', '💙', '💜', '🖤', '🤍', '🤎', '💔', '❤️‍🔥', '❤️‍🩹', '💕', '💞', '💓',
                    '💗', '💖', '💝', '💘', '💟', '☮️', '⭐', '🌟', '💫', '✨', '⚡', '🌈', '🎊', '🎉', '🥳', '🎈', '🎀',
                    '🎁', '🏆', '🥇', '👑', '💎', '🔮', '🌙'
                ],
                nature: ['🌸', '🌺', '🌻', '🌹', '🌷', '💐', '🍀', '🌿', '🌱', '🌲', '🌳', '🌴', '🍃', '🍂', '🍁', '🌾',
                    '🍄', '🌊', '❄️', '☃️', '⛄', '🌈', '🌤️', '⛅', '🌦️', '🌧️', '⛈️', '🌩️', '🌪️', '🦋', '🐝', '🐞',
                    '🦊', '🐶', '🐱', '🐼', '🐨', '🦁', '🐯'
                ],
                food: ['🍕', '🍔', '🌮', '🌯', '🥙', '🧆', '🥗', '🍜', '🍝', '🍣', '🍱', '🥟', '🍤', '🍗', '🍖', '🥩', '🍳',
                    '🥚', '🧇', '🥞', '🧈', '🥓', '🥐', '🍞', '🥨', '🥯', '🧀', '🍟', '🌭', '🥪', '🥣', '🍲', '🥘',
                    '🍛', '🍚', '🍙', '🍘', '🍥', '🧁'
                ],
                travel: ['✈️', '🚀', '🛸', '🚁', '🛩️', '🚂', '🚄', '🚇', '🚌', '🚗', '🛻', '🚚', '🚜', '🏎️', '🏍️', '🛵',
                    '🚲', '🛴', '🛹', '🛺', '⛵', '🛥️', '🚢', '🏗️', '🏠', '🏰', '🗼', '🗽', '⛩️', '🕌', '🕍', '🛕',
                    '🗺️', '🧭', '🏔️', '🗻', '🌋', '🏕️', '🏖️'
                ],
                objects: ['💡', '🔦', '🕯️', '🖥️', '💻', '⌨️', '🖱️', '📱', '📲', '☎️', '📺', '📻', '⏰', '⌚', '📷', '📹',
                    '🎥', '📡', '🔭', '🔬', '💊', '🩺', '🔧', '🔨', '⚙️', '🗜️', '🔑', '🗝️', '🔐', '🔒', '🔓', '🧲',
                    '🧪', '🧫', '🧬', '💰', '💳', '🪙', '💵', '📦'
                ],
                symbols: ['🎉', '🎊', '🎈', '🎀', '🎁', '🏆', '🥇', '🥈', '🥉', '🎯', '🎮', '🎲', '♟️', '🎭', '🎨', '🖼️',
                    '🎬', '🎤', '🎧', '🎵', '🎶', '🎼', '🎹', '🥁', '🎷', '🎺', '🎸', '🎻', '🪗', '🔔', '🔕', '💯', '✅',
                    '❌', '❓', '❗', '💬', '💭', '🗯️'
                ]
            };

            const gridMap = {
                smileys: 'epSmileys',
                gestures: 'epGestures',
                hearts: 'epHearts',
                nature: 'epNature',
                food: 'epFood',
                travel: 'epTravel',
                objects: 'epObjects',
                symbols: 'epSymbols'
            };
            Object.entries(gridMap).forEach(([cat, gid]) => {
                const grid = document.getElementById(gid);
                if (!grid) return;
                grid.innerHTML = EMOJI_DATA[cat].map(e =>
                    `<span class="ep-emoji" onclick="insertEmoji('${e}')">${e}</span>`).join('');
            });

            function toggleEmoji(e) {
                e.stopPropagation();
                const picker = document.getElementById('emojiPicker');
                const btn = document.getElementById('emojiBtn');
                const isOpen = picker.classList.contains('open');
                picker.classList.toggle('open');
                btn.classList.toggle('is-open', !isOpen);
                if (!isOpen) {
                    document.getElementById('emojiSearch').value = '';
                    searchEmoji('');
                }
            }

            function closeEmoji() {
                document.getElementById('emojiPicker').classList.remove('open');
                document.getElementById('emojiBtn').classList.remove('is-open');
            }

            function switchCat(btn) {
                document.querySelectorAll('.ep-cat-btn').forEach(b => b.classList.remove('ep-cat-active'));
                btn.classList.add('ep-cat-active');
                document.querySelectorAll('.ep-section').forEach(s => s.classList.remove('ep-active'));
                const sec = document.getElementById('cat-' + btn.dataset.cat);
                if (sec) sec.classList.add('ep-active');
            }

            function searchEmoji(q) {
                const sr = document.getElementById('epSearchResults');
                const cats = document.getElementById('epCats');
                const grid = document.getElementById('epSearchGrid');
                const sections = document.querySelectorAll('.ep-section');
                if (!q.trim()) {
                    sr.classList.remove('show');
                    cats.style.display = '';
                    sections.forEach(s => s.style.display = '');
                    return;
                }
                cats.style.display = 'none';
                sections.forEach(s => s.style.display = 'none');
                const all = Object.values(EMOJI_DATA).flat();
                grid.innerHTML = all.slice(0, 80).map(e => `<span class="ep-emoji" onclick="insertEmoji('${e}')">${e}</span>`)
                    .join('');
                sr.classList.add('show');
            }

            function insertEmoji(emoji) {
                const ta = document.getElementById('chatTa');
                if (!ta) return;
                const s = ta.selectionStart,
                    e = ta.selectionEnd;
                ta.value = ta.value.substring(0, s) + emoji + ta.value.substring(e);
                ta.selectionStart = ta.selectionEnd = s + [...emoji].length;
                ta.focus();
                ta.dispatchEvent(new Event('input'));
            }
            document.addEventListener('click', e => {
                const picker = document.getElementById('emojiPicker');
                const btn = document.getElementById('emojiBtn');
                if (picker && picker.classList.contains('open') && !picker.contains(e.target) && e.target !== btn) {
                    closeEmoji();
                }
            });
        </script>

    </x-app-layout>
@elseif(auth()->user()->isSupplier())
    {{-- resources/views/messages/supplier-chatbox.blade.php --}}

    <x-supplier-layout>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap');

            .msg-page * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            .msg-page {
                font-family: 'Outfit', system-ui, sans-serif;
                --ink: #14110E;
                --ink-2: #1C1916;
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

                background: var(--stone);
                height: calc(100vh - 58px);
                display: flex;
                overflow: hidden;
                padding: 1rem;
                gap: 1rem;
            }

            /* ══════════════════════════════
        SIDEBAR
        ══════════════════════════════ */
            .msg-sidebar {
                width: 305px;
                flex-shrink: 0;
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: 16px;
                display: flex;
                flex-direction: column;
                overflow: hidden;
                box-shadow: 0 2px 14px rgba(20, 17, 14, .05);
            }

            .sb-head {
                padding: 1rem 1.1rem 0.85rem;
                border-bottom: 1px solid var(--border);
                flex-shrink: 0;
            }

            .sb-top-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 0.72rem;
            }

            .sb-title {
                font-family: 'Cormorant Garamond', Georgia, serif;
                font-size: 1.18rem;
                font-weight: 700;
                color: var(--ink);
                line-height: 1;
                letter-spacing: 0.01em;
            }

            .sb-title em {
                font-style: italic;
                color: var(--gold);
            }

            .sb-new-group {
                display: inline-flex;
                align-items: center;
                gap: 5px;
                padding: 5px 11px;
                background: var(--ink);
                color: var(--gold-light);
                border: none;
                border-radius: 8px;
                font-family: 'Outfit', sans-serif;
                font-size: 0.7rem;
                font-weight: 500;
                cursor: pointer;
                transition: all .15s;
                white-space: nowrap;
            }

            .sb-new-group:hover {
                background: var(--gold);
                color: var(--white);
            }

            .sb-new-group svg {
                width: 12px;
                height: 12px;
            }

            .sb-search {
                display: flex;
                align-items: center;
                gap: 0.4rem;
                background: var(--stone);
                border: 1px solid var(--border);
                border-radius: 9px;
                padding: 0.4rem 0.75rem;
                margin-bottom: 0.72rem;
                transition: border-color .2s, box-shadow .2s;
            }

            .sb-search:focus-within {
                border-color: var(--gold);
                box-shadow: 0 0 0 3px rgba(184, 146, 74, 0.08);
            }

            .sb-search svg {
                width: 12px;
                height: 12px;
                color: var(--mist-light);
                flex-shrink: 0;
            }

            .sb-search input {
                border: none;
                outline: none;
                background: transparent;
                font-family: 'Outfit', sans-serif;
                font-size: 0.77rem;
                color: var(--ink);
                width: 100%;
            }

            .sb-search input::placeholder {
                color: var(--mist-light);
            }

            .sb-tabs {
                display: flex;
                gap: 5px;
            }

            .sb-tab {
                flex: 1;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 4px;
                padding: 6px 4px;
                border: 1.5px solid var(--border);
                border-radius: 10px;
                background: var(--stone);
                font-family: 'Outfit', sans-serif;
                font-size: 0.67rem;
                font-weight: 600;
                color: var(--mist);
                cursor: pointer;
                transition: all .18s;
                text-align: center;
                white-space: nowrap;
                letter-spacing: 0.03em;
                position: relative;
            }

            .sb-tab:hover {
                border-color: var(--gold);
                color: var(--gold);
                background: var(--gold-dim);
            }

            .sb-tab.active {
                background: var(--ink);
                border-color: var(--ink);
                color: var(--gold-light);
                box-shadow: 0 2px 8px rgba(20, 17, 14, 0.18);
            }

            .sb-tab.active .tab-badge {
                background: var(--gold);
                color: var(--ink);
            }

            .tab-badge {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 16px;
                height: 16px;
                padding: 0 4px;
                border-radius: 999px;
                background: rgba(184, 146, 74, 0.18);
                color: var(--gold);
                font-size: 0.52rem;
                font-weight: 700;
                line-height: 1;
            }

            .sb-tab svg {
                width: 11px;
                height: 11px;
                flex-shrink: 0;
            }

            .sb-scroll {
                flex: 1;
                overflow-y: auto;
                padding: 0.45rem 0 0.75rem;
                scrollbar-width: thin;
                scrollbar-color: var(--border) transparent;
            }

            .sb-scroll::-webkit-scrollbar {
                width: 3px;
            }

            .sb-scroll::-webkit-scrollbar-thumb {
                background: var(--border);
                border-radius: 99px;
            }

            .sb-group-label {
                font-size: 0.53rem;
                font-weight: 700;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                color: var(--mist-light);
                padding: 0.7rem 1.1rem 0.28rem;
            }

            .sb-divider {
                height: 1px;
                background: linear-gradient(90deg, transparent, var(--border), transparent);
                margin: 0.35rem 0.9rem;
            }

            .sb-item {
                display: flex;
                align-items: center;
                gap: 0.6rem;
                padding: 0.58rem 0.9rem;
                margin: 0.04rem 0.4rem;
                border-radius: 10px;
                cursor: pointer;
                border: none;
                background: none;
                width: calc(100% - 0.8rem);
                text-align: left;
                font-family: 'Outfit', sans-serif;
                transition: background .15s;
                position: relative;
                text-decoration: none;
                color: inherit;
            }

            .sb-item:hover {
                background: var(--stone);
            }

            .sb-item.is-active {
                background: linear-gradient(135deg, rgba(184, 146, 74, 0.15) 0%, rgba(184, 146, 74, 0.05) 100%);
            }

            .sb-item.is-active::before {
                content: '';
                position: absolute;
                left: -0.4rem;
                top: 22%;
                bottom: 22%;
                width: 3px;
                border-radius: 0 3px 3px 0;
                background: linear-gradient(to bottom, var(--gold-light), var(--gold));
            }

            .sb-ava {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                flex-shrink: 0;
                background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Cormorant Garamond', serif;
                font-size: 0.82rem;
                font-weight: 700;
                color: var(--white);
                border: 1.5px solid rgba(184, 146, 74, 0.2);
                position: relative;
            }

            .sb-ava.is-admin {
                background: linear-gradient(135deg, var(--ink) 0%, #3D3530 100%);
                border-color: rgba(184, 146, 74, 0.3);
            }

            .sb-ava.is-group {
                background: linear-gradient(135deg, var(--purple) 0%, #3D3060 100%);
                border-color: rgba(92, 75, 138, 0.3);
            }

            .sb-ava.is-collab {
                background: linear-gradient(135deg, #1E7850 0%, #0F4028 100%);
                border-color: rgba(30, 120, 80, 0.3);
            }

            .online-dot {
                position: absolute;
                bottom: 0;
                right: 0;
                width: 9px;
                height: 9px;
                border-radius: 50%;
                background: var(--success);
                border: 2px solid var(--white);
            }

            .sb-info {
                flex: 1;
                min-width: 0;
            }

            .sb-name {
                font-size: 0.79rem;
                font-weight: 500;
                color: var(--ink);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .sb-name.has-unread {
                font-weight: 700;
            }

            .sb-sub {
                font-size: 0.66rem;
                color: var(--mist);
                margin-top: 1px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .sb-meta {
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                gap: 4px;
                flex-shrink: 0;
            }

            .sb-time {
                font-size: 0.59rem;
                color: var(--mist-light);
            }

            .sb-pill {
                font-size: 0.52rem;
                font-weight: 700;
                letter-spacing: 0.07em;
                text-transform: uppercase;
                padding: 2px 7px;
                border-radius: 999px;
                white-space: nowrap;
            }

            .sb-pill.admin {
                background: rgba(20, 17, 14, 0.08);
                color: var(--ink);
            }

            .sb-pill.collab {
                background: rgba(30, 120, 80, 0.1);
                color: #1E7850;
                border: 1px solid rgba(30, 120, 80, 0.2);
            }

            .sb-pill.group {
                background: rgba(92, 75, 138, 0.1);
                color: var(--purple);
                border: 1px solid rgba(92, 75, 138, 0.2);
            }

            .sb-unread-badge {
                min-width: 17px;
                height: 17px;
                border-radius: 999px;
                background: var(--gold);
                color: var(--ink);
                font-size: 0.52rem;
                font-weight: 700;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 0 4px;
            }

            .sb-empty {
                padding: 1.5rem 1rem;
                text-align: center;
                font-size: 0.73rem;
                color: var(--mist);
            }

            .sb-empty svg {
                width: 28px;
                height: 28px;
                display: block;
                margin: 0 auto 0.4rem;
                opacity: .28;
            }

            /* ══════════════════════════════
        MAIN CHAT PANEL
        ══════════════════════════════ */
            .msg-main {
                flex: 1;
                min-width: 0;
                display: flex;
                flex-direction: column;
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 2px 14px rgba(20, 17, 14, .05);
            }

            .chat-head {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.82rem 1.25rem;
                border-bottom: 1px solid var(--border);
                flex-shrink: 0;
                background: var(--white);
            }

            /* Mobile back button — desktop hidden */
            .mob-back-btn {
                display: none;
                width: 32px;
                height: 32px;
                border-radius: 8px;
                border: 1px solid var(--border);
                background: var(--stone);
                align-items: center;
                justify-content: center;
                color: var(--mist);
                cursor: pointer;
                flex-shrink: 0;
                transition: all .15s;
                text-decoration: none;
            }

            .mob-back-btn svg {
                width: 16px;
                height: 16px;
            }

            .chat-head-ava {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                flex-shrink: 0;
                background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Cormorant Garamond', serif;
                font-size: 0.9rem;
                font-weight: 700;
                color: var(--white);
                border: 2px solid rgba(184, 146, 74, 0.22);
                position: relative;
            }

            .chat-head-ava.is-admin {
                background: linear-gradient(135deg, var(--ink) 0%, #3D3530 100%);
            }

            .chat-head-ava.is-group {
                background: linear-gradient(135deg, var(--purple) 0%, #3D3060 100%);
            }

            .chat-head-ava.is-collab {
                background: linear-gradient(135deg, #1E7850 0%, #0F4028 100%);
            }

            .chat-head-ava .online-dot {
                position: absolute;
                bottom: 1px;
                right: 1px;
                width: 10px;
                height: 10px;
                border: 2px solid var(--white);
            }

            .chat-head-info {
                flex: 1;
                min-width: 0;
            }

            .chat-head-name {
                font-family: 'Cormorant Garamond', serif;
                font-size: 1.06rem;
                font-weight: 700;
                color: var(--ink);
                line-height: 1.1;
            }

            .chat-head-role {
                font-size: 0.64rem;
                color: var(--mist);
                margin-top: 2px;
                display: flex;
                align-items: center;
                gap: 0.28rem;
            }

            .dot-online {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background: var(--success);
                display: inline-block;
            }

            .chat-head-acts {
                display: flex;
                gap: 0.38rem;
            }

            .ch-btn {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                border: 1px solid var(--border);
                background: var(--stone);
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--mist);
                cursor: pointer;
                transition: all .15s;
            }

            .ch-btn:hover {
                border-color: var(--gold);
                color: var(--gold);
                background: var(--gold-dim);
            }

            .ch-btn svg {
                width: 14px;
                height: 14px;
            }

            .chat-body {
                flex: 1;
                overflow-y: auto;
                padding: 1.25rem;
                display: flex;
                flex-direction: column;
                gap: 0.65rem;
                background: var(--stone);
                scrollbar-width: thin;
                scrollbar-color: var(--border) transparent;
            }

            .chat-body::-webkit-scrollbar {
                width: 3px;
            }

            .chat-body::-webkit-scrollbar-thumb {
                background: var(--border);
                border-radius: 99px;
            }

            .chat-date {
                text-align: center;
                font-size: 0.63rem;
                color: var(--mist-light);
                margin: 0.35rem 0;
                position: relative;
            }

            .chat-date span {
                background: var(--stone-2);
                padding: 2px 10px;
                border-radius: 999px;
                border: 1px solid var(--border);
                position: relative;
                z-index: 1;
            }

            .chat-date::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 0;
                right: 0;
                height: 1px;
                background: var(--border);
            }

            .brow {
                display: flex;
                align-items: flex-end;
                gap: 0.48rem;
            }

            .brow.me {
                flex-direction: row-reverse;
            }

            .bava {
                width: 28px;
                height: 28px;
                border-radius: 50%;
                flex-shrink: 0;
                background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Cormorant Garamond', serif;
                font-size: 0.64rem;
                font-weight: 700;
                color: var(--white);
                border: 1.5px solid rgba(184, 146, 74, 0.18);
            }

            .bava.is-admin {
                background: linear-gradient(135deg, var(--ink) 0%, #3D3530 100%);
            }

            .bblock {
                display: flex;
                flex-direction: column;
                max-width: 65%;
                gap: 2px;
            }

            .brow.me .bblock {
                align-items: flex-end;
            }

            .bsender {
                font-size: 0.61rem;
                font-weight: 600;
                color: var(--mist);
                padding: 0 3px;
            }

            .bubble {
                padding: 0.6rem 0.9rem;
                border-radius: 14px;
                font-size: 0.81rem;
                line-height: 1.55;
                word-break: break-word;
            }

            .bubble.them {
                background: var(--white);
                color: var(--ink);
                border: 1px solid var(--border);
                border-bottom-left-radius: 4px;
            }

            .bubble.me {
                background: var(--ink);
                color: var(--gold-pale);
                border-bottom-right-radius: 4px;
            }

            .btime {
                font-size: 0.58rem;
                color: var(--mist-light);
                padding: 0 3px;
            }

            .bubble-img {
                max-width: 220px;
                border-radius: 10px;
                overflow: hidden;
                margin-top: 2px;
                border: 1px solid var(--border);
                cursor: pointer;
            }

            .bubble-img img {
                width: 100%;
                display: block;
            }

            @keyframes bubbleIn {
                from {
                    opacity: 0;
                    transform: translateY(5px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .brow {
                animation: bubbleIn .15s ease both;
            }

            /* ══ FOOTER ══ */
            .chat-foot {
                border-top: 1px solid var(--border);
                flex-shrink: 0;
                background: var(--white);
            }

            .file-preview-bar {
                display: none;
                align-items: center;
                gap: 0.6rem;
                padding: 0.6rem 1.1rem;
                background: var(--gold-dim);
                border-bottom: 1px solid var(--gold-border);
            }

            .file-preview-bar.show {
                display: flex;
            }

            .fp-thumb {
                width: 40px;
                height: 40px;
                border-radius: 8px;
                object-fit: cover;
                border: 1px solid var(--gold-border);
                flex-shrink: 0;
            }

            .fp-name {
                flex: 1;
                font-size: 0.75rem;
                color: var(--ink);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .fp-size {
                font-size: 0.67rem;
                color: var(--mist);
                flex-shrink: 0;
            }

            .fp-remove {
                width: 22px;
                height: 22px;
                border-radius: 50%;
                background: rgba(20, 17, 14, 0.1);
                border: none;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                color: var(--ink);
                flex-shrink: 0;
                transition: background .15s;
            }

            .fp-remove:hover {
                background: rgba(192, 57, 43, 0.15);
                color: var(--danger);
            }

            .fp-remove svg {
                width: 12px;
                height: 12px;
            }

            .chat-input-wrap {
                padding: 0.75rem 1.1rem;
            }

            .chat-input-row {
                display: flex;
                align-items: flex-end;
                gap: 0.5rem;
                background: var(--stone);
                border: 1.5px solid var(--border);
                border-radius: 14px;
                padding: 0.5rem 0.6rem 0.5rem 0.95rem;
                transition: border-color .2s, box-shadow .2s;
            }

            .chat-input-row:focus-within {
                border-color: var(--gold);
                box-shadow: 0 0 0 3px rgba(184, 146, 74, 0.08);
            }

            .chat-attach-btn {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                flex-shrink: 0;
                border: none;
                background: transparent;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--mist-light);
                cursor: pointer;
                transition: color .15s;
                position: relative;
            }

            .chat-attach-btn:hover {
                color: var(--gold);
            }

            .chat-attach-btn svg {
                width: 17px;
                height: 17px;
            }

            .chat-attach-btn input[type=file] {
                position: absolute;
                inset: 0;
                opacity: 0;
                cursor: pointer;
                width: 100%;
                height: 100%;
            }

            .chat-ta {
                flex: 1;
                border: none;
                outline: none;
                background: transparent;
                font-family: 'Outfit', sans-serif;
                font-size: 0.81rem;
                color: var(--ink);
                resize: none;
                line-height: 1.5;
                max-height: 96px;
                min-height: 22px;
            }

            .chat-ta::placeholder {
                color: var(--mist-light);
            }

            .chat-foot-btns {
                display: flex;
                align-items: center;
                gap: 4px;
                flex-shrink: 0;
                position: relative;
            }

            .chat-emoji-btn {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                border: 1.5px solid var(--border);
                background: var(--stone);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                cursor: pointer;
                line-height: 1;
                transition: all .18s;
                flex-shrink: 0;
            }

            .chat-emoji-btn:hover {
                border-color: var(--gold);
                background: var(--gold-dim);
                transform: scale(1.08);
            }

            .chat-emoji-btn.is-open {
                border-color: var(--gold);
                background: var(--gold-dim);
                box-shadow: 0 0 0 3px rgba(184, 146, 74, 0.12);
            }

            .emoji-picker {
                display: none;
                position: absolute;
                bottom: calc(100% + 10px);
                right: 0;
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: 16px;
                padding: 0.75rem;
                box-shadow: 0 10px 40px rgba(20, 17, 14, .18);
                width: 280px;
                z-index: 50;
                animation: popIn .15s ease;
            }

            .emoji-picker.open {
                display: block;
            }

            @keyframes popIn {
                from {
                    opacity: 0;
                    transform: translateY(8px) scale(0.97);
                }

                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }

            .ep-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 0.55rem;
                padding-bottom: 0.5rem;
                border-bottom: 1px solid var(--border);
            }

            .ep-header-title {
                font-family: 'Cormorant Garamond', serif;
                font-size: 0.88rem;
                font-weight: 700;
                color: var(--ink);
            }

            .ep-header-title em {
                font-style: italic;
                color: var(--gold);
            }

            .ep-close {
                width: 22px;
                height: 22px;
                border-radius: 6px;
                border: none;
                background: var(--stone);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                color: var(--mist);
                transition: all .12s;
                font-size: 13px;
                line-height: 1;
            }

            .ep-close:hover {
                background: var(--stone-2);
                color: var(--ink);
            }

            .ep-cats {
                display: flex;
                gap: 3px;
                margin-bottom: 0.5rem;
            }

            .ep-cat-btn {
                flex: 1;
                padding: 4px 2px;
                border: 1.5px solid var(--border);
                border-radius: 7px;
                background: transparent;
                font-size: 14px;
                cursor: pointer;
                transition: all .14s;
                text-align: center;
                line-height: 1;
            }

            .ep-cat-btn:hover {
                border-color: var(--gold);
                background: var(--gold-dim);
            }

            .ep-cat-btn.ep-cat-active {
                border-color: var(--gold);
                background: var(--gold-dim);
                box-shadow: 0 0 0 2px rgba(184, 146, 74, 0.14);
            }

            .ep-label {
                font-size: 0.55rem;
                font-weight: 700;
                letter-spacing: 0.13em;
                text-transform: uppercase;
                color: var(--mist-light);
                margin-bottom: 5px;
                margin-top: 2px;
            }

            .ep-section {
                display: none;
            }

            .ep-section.ep-active {
                display: block;
            }

            .ep-grid {
                display: grid;
                grid-template-columns: repeat(8, 1fr);
                gap: 2px;
            }

            .ep-emoji {
                font-size: 19px;
                cursor: pointer;
                padding: 4px 3px;
                border-radius: 7px;
                text-align: center;
                transition: background .11s, transform .11s;
                line-height: 1;
            }

            .ep-emoji:hover {
                background: var(--stone-2);
                transform: scale(1.18);
            }

            .ep-search {
                display: flex;
                align-items: center;
                gap: 5px;
                background: var(--stone);
                border: 1px solid var(--border);
                border-radius: 8px;
                padding: 4px 8px;
                margin-bottom: 0.5rem;
                transition: border-color .18s;
            }

            .ep-search:focus-within {
                border-color: var(--gold);
            }

            .ep-search svg {
                width: 11px;
                height: 11px;
                color: var(--mist-light);
                flex-shrink: 0;
            }

            .ep-search input {
                border: none;
                outline: none;
                background: transparent;
                font-family: 'Outfit', sans-serif;
                font-size: 0.72rem;
                color: var(--ink);
                width: 100%;
            }

            .ep-search input::placeholder {
                color: var(--mist-light);
            }

            .ep-search-results {
                display: none;
            }

            .ep-search-results.show {
                display: block;
            }

            .chat-send-btn {
                width: 34px;
                height: 34px;
                border-radius: 9px;
                flex-shrink: 0;
                background: var(--ink);
                border: none;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--gold-light);
                cursor: pointer;
                transition: all .18s;
            }

            .chat-send-btn:hover {
                background: var(--gold);
                color: var(--white);
                transform: scale(1.05);
            }

            .chat-send-btn svg {
                width: 14px;
                height: 14px;
            }

            .chat-welcome {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 0.75rem;
                padding: 2rem;
                background: var(--stone);
            }

            .cw-icon {
                width: 64px;
                height: 64px;
                border-radius: 50%;
                background: var(--gold-dim);
                border: 1px solid var(--gold-border);
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--gold);
            }

            .cw-icon svg {
                width: 28px;
                height: 28px;
            }

            .cw-title {
                font-family: 'Cormorant Garamond', serif;
                font-size: 1.15rem;
                font-weight: 700;
                color: var(--ink);
            }

            .cw-title em {
                font-style: italic;
                color: var(--gold);
            }

            .cw-sub {
                font-size: 0.75rem;
                color: var(--mist);
                text-align: center;
                line-height: 1.65;
            }

            /* ══ LIGHTBOX ══ */
            .lb-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(20, 17, 14, .88);
                z-index: 9999;
                align-items: center;
                justify-content: center;
            }

            .lb-overlay.open {
                display: flex;
            }

            .lb-overlay img {
                max-width: 90vw;
                max-height: 88vh;
                border-radius: 12px;
            }

            .lb-close {
                position: absolute;
                top: 1rem;
                right: 1rem;
                width: 36px;
                height: 36px;
                border-radius: 50%;
                background: rgba(255, 255, 255, .12);
                border: none;
                color: #fff;
                font-size: 20px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* ══ GROUP MODAL ══ */
            .gc-modal-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(20, 17, 14, .5);
                z-index: 500;
                align-items: center;
                justify-content: center;
                padding: 1rem;
            }

            .gc-modal-overlay.open {
                display: flex;
            }

            .gc-modal {
                background: var(--white);
                border-radius: 16px;
                width: 100%;
                max-width: 500px;
                max-height: 90vh;
                overflow-y: auto;
                box-shadow: 0 20px 60px rgba(20, 17, 14, .22);
            }

            .gc-head {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 1.1rem 1.3rem;
                border-bottom: 1px solid var(--border);
                position: sticky;
                top: 0;
                background: var(--white);
                border-radius: 16px 16px 0 0;
            }

            .gc-head h2 {
                font-family: 'Cormorant Garamond', serif;
                font-size: 1.05rem;
                font-weight: 700;
                color: var(--ink);
            }

            .gc-head h2 em {
                font-style: italic;
                color: var(--gold);
            }

            .gc-close {
                width: 28px;
                height: 28px;
                border-radius: 7px;
                border: none;
                background: var(--stone);
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--mist);
                transition: all .15s;
            }

            .gc-close:hover {
                background: var(--stone-2);
                color: var(--ink);
            }

            .gc-close svg {
                width: 16px;
                height: 16px;
            }

            .gc-body {
                padding: 1.2rem 1.3rem;
            }

            .gc-foot {
                padding: 1rem 1.3rem;
                border-top: 1px solid var(--border);
                display: flex;
                justify-content: flex-end;
                gap: 8px;
            }

            .gc-label {
                font-size: 0.72rem;
                font-weight: 600;
                color: var(--mist);
                margin-bottom: 5px;
                display: block;
            }

            .gc-input {
                width: 100%;
                padding: 8px 11px;
                border: 1px solid var(--border);
                border-radius: 9px;
                font-family: 'Outfit', sans-serif;
                font-size: 0.8rem;
                color: var(--ink);
                background: var(--white);
                margin-bottom: 1rem;
                transition: border-color .18s, box-shadow .18s;
            }

            .gc-input:focus {
                outline: none;
                border-color: var(--gold);
                box-shadow: 0 0 0 3px rgba(184, 146, 74, 0.08);
            }

            .gc-select {
                appearance: none;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%238C867E' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 10px center;
                padding-right: 28px;
            }

            .gc-section-title {
                font-size: 0.65rem;
                font-weight: 700;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: var(--mist-light);
                padding: 0.5rem 0 0.4rem;
                border-top: 1px solid var(--border);
                margin-bottom: 0.5rem;
            }

            .gc-check-row {
                display: flex;
                align-items: center;
                gap: 0.6rem;
                padding: 0.5rem 0.65rem;
                border-radius: 9px;
                transition: background .12s;
                cursor: pointer;
                margin-bottom: 2px;
            }

            .gc-check-row:hover {
                background: var(--stone);
            }

            .gc-check-row input[type=checkbox] {
                width: 16px;
                height: 16px;
                border-radius: 5px;
                cursor: pointer;
                accent-color: var(--gold);
            }

            .gc-check-ava {
                width: 28px;
                height: 28px;
                border-radius: 50%;
                flex-shrink: 0;
                background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Cormorant Garamond', serif;
                font-size: 0.65rem;
                font-weight: 700;
                color: var(--white);
            }

            .gc-check-ava.adm {
                background: linear-gradient(135deg, var(--ink) 0%, #3D3530 100%);
            }

            .gc-check-name {
                font-size: 0.78rem;
                color: var(--ink);
            }

            .gc-check-sub {
                font-size: 0.65rem;
                color: var(--mist);
            }

            .btn-gc-cancel {
                padding: 8px 18px;
                border-radius: 8px;
                background: var(--stone);
                color: var(--ink);
                border: 1px solid var(--border);
                font-family: 'Outfit', sans-serif;
                font-size: 0.8rem;
                cursor: pointer;
                transition: background .15s;
            }

            .btn-gc-cancel:hover {
                background: var(--stone-2);
            }

            .btn-gc-create {
                padding: 8px 18px;
                border-radius: 8px;
                background: var(--ink);
                color: var(--gold-light);
                border: none;
                font-family: 'Outfit', sans-serif;
                font-size: 0.8rem;
                font-weight: 500;
                cursor: pointer;
                transition: all .15s;
            }

            .btn-gc-create:hover {
                background: var(--gold);
                color: var(--white);
            }

            /* ══════════════════════════════
        MOBILE RESPONSIVE — ≤ 768px
        On mobile:
        • Only show the sidebar (conversation list) by default
        • Conversation list takes full screen
        • Chat panel is hidden unless ?conversation_id is set
        • No input box shown on mobile when viewing the list
        • When a conversation IS open, full-screen chat with back button, no sidebar
        ══════════════════════════════ */
            @media (max-width: 768px) {

                .msg-page {
                    padding: 0;
                    gap: 0;
                    height: calc(100vh - 58px);
                    position: relative;
                }

                /* ── Sidebar: full-screen on mobile, hidden when chat open ── */
                .msg-sidebar {
                    width: 100%;
                    border-radius: 0;
                    border: none;
                    border-bottom: 1px solid var(--border);
                    box-shadow: none;
                    height: 100%;
                    /* Shown by default on mobile */
                }

                /* When a conversation is active (body has .mob-chat-open), hide sidebar */
                body.mob-chat-open .msg-sidebar {
                    display: none;
                }

                /* ── Chat panel: hidden by default, full-screen when active ── */
                .msg-main {
                    display: none;
                    border-radius: 0;
                    border: none;
                    position: absolute;
                    inset: 0;
                    z-index: 10;
                }

                body.mob-chat-open .msg-main {
                    display: flex;
                }

                /* Show back button on mobile */
                .mob-back-btn {
                    display: flex;
                }

                /* Bubble max-width wider on small screens */
                .bblock {
                    max-width: 80%;
                }

                /* Smaller chat header on mobile */
                .chat-head {
                    padding: 0.7rem 0.9rem;
                    gap: 0.55rem;
                }

                .chat-head-name {
                    font-size: 0.95rem;
                }

                /* Emoji picker full-width on mobile */
                .emoji-picker {
                    width: calc(100vw - 2rem);
                    right: auto;
                    left: 50%;
                    transform: translateX(-50%);
                    bottom: calc(100% + 8px);
                }

                /* Input wrap tighter */
                .chat-input-wrap {
                    padding: 0.55rem 0.75rem;
                }

                /* Sidebar head tighter */
                .sb-head {
                    padding: 0.85rem 0.9rem 0.7rem;
                }

                /* Slightly larger touch targets for list items */
                .sb-item {
                    padding: 0.75rem 0.9rem;
                }

                .sb-ava {
                    width: 40px;
                    height: 40px;
                }

                /* Remove the floating active-indicator bar on mobile */
                .sb-item.is-active::before {
                    display: none;
                }
            }

            @media (max-width: 420px) {
                .sb-tab {
                    font-size: 0.62rem;
                    padding: 5px 3px;
                }

                .chat-head-acts .ch-btn:last-child {
                    display: none;
                }

                /* hide 3rd button on tiny screens */
            }
        </style>

        @php
            $authId = auth()->id();
            $authName = auth()->user()->name ?? 'Me';
            $activeConvId = $conversation?->id ?? null;

            $unreadCount = $conversations
                ->filter(function ($c) use ($authId) {
                    $last = $c->messages->last();
                    return $last && $last->sender_id != $authId;
                })
                ->count();

            $groupCount = $conversations->filter(fn($c) => $c->type === 'group')->count();

            /* On mobile, if a conversation is open we add a body class via JS */
            $hasMobChat = $activeConvId ? 'true' : 'false';
        @endphp

        {{-- Add body class for mobile chat state --}}
        <script>
            if ({{ $hasMobChat }} && window.innerWidth <= 768) {
                document.body.classList.add('mob-chat-open');
            }
        </script>

        <div class="msg-page">

            {{-- ═══════════════════════════════
            SIDEBAR
        ═══════════════════════════════ --}}
            <aside class="msg-sidebar">

                <div class="sb-head">
                    <div class="sb-top-row">
                        <div class="sb-title">Chats</div>
                        <button class="sb-new-group" onclick="openGroupModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2.5">
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            New Group
                        </button>
                    </div>

                    <div class="sb-search">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="7" />
                            <path d="M17 17l3 3" />
                        </svg>
                        <input type="text" id="sbSearch" placeholder="Search contacts, chats…"
                            autocomplete="off">
                    </div>

                    <div class="sb-tabs">
                        <button class="sb-tab active" data-filter="all" onclick="setTab(this)"
                            title="All conversations">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16a2 2 0 012 2v8a2 2 0 01-2 2H7l-5 4V6a2 2 0 012-2z" />
                            </svg>
                            All
                        </button>

                        <button class="sb-tab" data-filter="unread" onclick="setTab(this)" title="Unread messages">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0" />
                            </svg>
                            Unread
                            @if ($unreadCount > 0)
                                <span class="tab-badge">{{ $unreadCount }}</span>
                            @endif
                        </button>

                        <button class="sb-tab" data-filter="groups" onclick="setTab(this)" title="Group chats">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                            </svg>
                            Groups
                            @if ($groupCount > 0)
                                <span class="tab-badge">{{ $groupCount }}</span>
                            @endif
                        </button>
                    </div>
                </div>

                <div class="sb-scroll">

                    {{-- ── ADMIN SUPPORT ── --}}
                    <div class="sb-group-label" id="lbl-support">Support</div>

                    @forelse($admins as $admin)
                        @php
                            $ini = strtoupper(substr($admin->name, 0, 2));
                            $isActive = $activeConvId && $conversation->participants->contains('user_id', $admin->id);
                        @endphp
                        <a href="{{ route('messages.start', $admin->id) }}"
                            class="sb-item {{ $isActive ? 'is-active' : '' }}"
                            data-name="{{ strtolower($admin->name) }}" data-section="support"
                            data-filter-group="all">
                            <div class="sb-ava is-admin">{{ $ini }}<span class="online-dot"></span></div>
                            <div class="sb-info">
                                <div class="sb-name">{{ $admin->name }}</div>
                                <div class="sb-sub">Admin support</div>
                            </div>
                            <div class="sb-meta"><span class="sb-pill admin">Admin</span></div>
                        </a>
                    @empty
                        <div class="sb-empty" data-section="support">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="8" r="4" />
                                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                            </svg>
                            No admin available.
                        </div>
                    @endforelse

                    {{-- ── COLLABORATORS ── --}}
                    @if (isset($collaborators) && $collaborators->count())
                        <div class="sb-divider" id="div-collab"></div>
                        <div class="sb-group-label" id="lbl-collab">Project Collaborators</div>

                        @foreach ($collaborators as $cconv)
                            @php
                                $cother = $cconv->participants->where('user_id', '!=', auth()->id())->first()?->user;
                                $cname =
                                    $cother?->supplierProfile?->business_name ?? ($cother?->name ?? 'Collaborator');
                                $cini = strtoupper(substr($cname, 0, 2));
                                $clast = optional($cconv->messages->last())->message ?? 'No messages yet';
                                $isA = $activeConvId == $cconv->id;
                            @endphp
                            <a href="{{ route('messages.inbox', ['conversation_id' => $cconv->id]) }}"
                                class="sb-item {{ $isA ? 'is-active' : '' }}" data-name="{{ strtolower($cname) }}"
                                data-section="collab" data-filter-group="all">
                                <div class="sb-ava is-collab">{{ $cini }}</div>
                                <div class="sb-info">
                                    <div class="sb-name">{{ $cname }}</div>
                                    <div class="sb-sub">{{ \Illuminate\Support\Str::limit($clast, 34) }}</div>
                                </div>
                                <div class="sb-meta"><span class="sb-pill collab">Collab</span></div>
                            </a>
                        @endforeach
                    @endif

                    <div class="sb-divider" id="div-chats"></div>

                    {{-- ── RECENT CHATS ── --}}
                    <div class="sb-group-label" id="lbl-chats">Recent Chats</div>

                    @forelse($conversations as $conv)
                        @php
                            $other = $conv->participants->where('user_id', '!=', auth()->id())->first()?->user;
                            $dname =
                                $conv->type === 'group'
                                    ? $conv->title ?? 'Group Chat'
                                    : $other?->supplierProfile?->business_name ?? ($other?->name ?? 'Chat');
                            $ini = strtoupper(substr($dname, 0, 2));
                            $last = optional($conv->messages->last())->message ?? 'No messages yet';
                            $time = $conv->messages->last()?->created_at;
                            $isAdm = $other?->role === 'admin';
                            $isGrp = $conv->type === 'group';
                            $isUnrd = $conv->messages->last() && $conv->messages->last()->sender_id != $authId;
                            $isA = $activeConvId == $conv->id;
                        @endphp
                        <a href="{{ route('messages.inbox', ['conversation_id' => $conv->id]) }}"
                            class="sb-item {{ $isA ? 'is-active' : '' }}" data-name="{{ strtolower($dname) }}"
                            data-section="chats"
                            data-filter-group="{{ $isGrp ? 'groups' : ($isUnrd ? 'unread' : 'all') }}"
                            data-is-unread="{{ $isUnrd ? '1' : '0' }}" data-is-group="{{ $isGrp ? '1' : '0' }}">
                            <div class="sb-ava {{ $isAdm ? 'is-admin' : ($isGrp ? 'is-group' : '') }}">
                                {{ $ini }}</div>
                            <div class="sb-info">
                                <div class="sb-name {{ $isUnrd ? 'has-unread' : '' }}">{{ $dname }}</div>
                                <div class="sb-sub">{{ \Illuminate\Support\Str::limit($last, 36) }}</div>
                            </div>
                            <div class="sb-meta">
                                @if ($time)
                                    <div class="sb-time">{{ $time->diffForHumans(null, true) }}</div>
                                @endif
                                @if ($isGrp)
                                    <span class="sb-pill group">Group</span>
                                @elseif($isUnrd)
                                    <span class="sb-unread-badge">!</span>
                                @endif
                            </div>
                        </a>
                    @empty
                        <div class="sb-empty" data-section="chats">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5">
                                <path d="M4 4h16a2 2 0 012 2v8a2 2 0 01-2 2H7l-5 4V6a2 2 0 012-2z" />
                            </svg>
                            No conversations yet.
                        </div>
                    @endforelse

                </div>
            </aside>

            {{-- ═══════════════════════════════
            MAIN CHAT PANEL
        ═══════════════════════════════ --}}
            <section class="msg-main">

                @if ($conversation)

                    @php
                        $chatOther = $conversation->participants->where('user_id', '!=', auth()->id())->first()?->user;
                        $chatName =
                            $conversation->type === 'group'
                                ? $conversation->title ?? 'Group Chat'
                                : $chatOther?->supplierProfile?->business_name ?? ($chatOther?->name ?? 'Chat');
                        $chatInit = strtoupper(substr($chatName, 0, 2));
                        $chatIsAdmin = $chatOther?->role === 'admin';
                        $chatIsGroup = $conversation->type === 'group';
                        $chatIsCollab =
                            str_starts_with($conversation->type ?? '', 'collab') ||
                            (isset($collaborators) && $collaborators->contains('id', $conversation->id));
                        $chatRole = $chatIsAdmin
                            ? 'Admin Support'
                            : ($chatIsGroup
                                ? 'Group · ' . $conversation->participants->count() . ' members'
                                : ($chatIsCollab
                                    ? 'Project Collaborator'
                                    : ($chatOther?->supplier?->business_name
                                        ? 'Supplier'
                                        : 'Client')));
                    @endphp

                    <div class="chat-head">
                        {{-- Mobile back button — returns to conversation list --}}
                        <a href="{{ route('messages.inbox') }}" class="mob-back-btn" title="Back to chats"
                            id="mobBackBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2.2">
                                <path d="M15 18l-6-6 6-6" />
                            </svg>
                        </a>

                        <div
                            class="chat-head-ava {{ $chatIsAdmin ? 'is-admin' : ($chatIsGroup ? 'is-group' : ($chatIsCollab ? 'is-collab' : '')) }}">
                            {{ $chatInit }}
                            @if (!$chatIsGroup)
                                <span class="online-dot"></span>
                            @endif
                        </div>
                        <div class="chat-head-info">
                            <div class="chat-head-name">{{ $chatName }}</div>
                            <div class="chat-head-role">
                                @if (!$chatIsGroup)
                                    <span class="dot-online"></span>
                                @endif
                                {{ $chatRole }}
                            </div>
                        </div>
                        <div class="chat-head-acts">
                            <button class="ch-btn" title="Info">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                                </svg>
                            </button>
                            <button class="ch-btn" title="Search">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="7" />
                                    <path d="M17 17l3 3" />
                                </svg>
                            </button>
                            <button class="ch-btn" title="More">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="5" cy="12" r="1" />
                                    <circle cx="12" cy="12" r="1" />
                                    <circle cx="19" cy="12" r="1" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Messages --}}
                    <div class="chat-body" id="chatBody">
                        @php $prevDate = null; @endphp
                        @forelse($conversation->messages as $msg)
                            @php
                                $isMe = $msg->sender_id == $authId;
                                $mDate = $msg->created_at->format('M d, Y');
                                $mTime = $msg->created_at->format('g:i A');
                                $sName = $msg->sender?->name ?? 'Unknown';
                                $sInit = strtoupper(substr($sName, 0, 2));
                                $sAdmin = $msg->sender?->role === 'admin';
                            @endphp

                            @if ($mDate !== $prevDate)
                                <div class="chat-date"><span>{{ $mDate }}</span></div>
                                @php $prevDate = $mDate; @endphp
                            @endif

                            <div class="brow {{ $isMe ? 'me' : '' }}">
                                @if (!$isMe)
                                    <div class="bava {{ $sAdmin ? 'is-admin' : '' }}">{{ $sInit }}</div>
                                @endif
                                <div class="bblock">
                                    @if (!$isMe)
                                        <div class="bsender">{{ $sName }}</div>
                                    @endif

                                    @if (!empty($msg->file))
                                        <div class="bubble-img"
                                            onclick="openLightbox('{{ asset('storage/' . $msg->file) }}')">
                                            <img src="{{ asset('storage/' . $msg->file) }}" alt="attachment">
                                        </div>
                                    @endif

                                    @if (!empty($msg->message))
                                        <div class="bubble {{ $isMe ? 'me' : 'them' }}">{{ $msg->message }}</div>
                                    @endif

                                    <div class="btime">{{ $mTime }}</div>
                                </div>
                            </div>
                        @empty
                            <div
                                style="flex:1;display:flex;align-items:center;justify-content:center;font-size:.78rem;color:var(--mist);">
                                No messages yet — say hello! 👋
                            </div>
                        @endforelse
                    </div>

                    {{-- Footer — hidden on mobile via CSS override below if needed, but we keep it;
                    on mobile the footer IS shown because you're inside a chat --}}
                    <div class="chat-foot">
                        <div class="file-preview-bar" id="filePreviewBar">
                            <img class="fp-thumb" id="fpThumb" src="" alt="">
                            <div>
                                <div class="fp-name" id="fpName"></div>
                                <div class="fp-size" id="fpSize"></div>
                            </div>
                            <button type="button" class="fp-remove" onclick="clearFile()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <line x1="18" y1="6" x2="6" y2="18" />
                                    <line x1="6" y1="6" x2="18" y2="18" />
                                </svg>
                            </button>
                        </div>

                        <div class="chat-input-wrap">
                            <form action="{{ route('messages.send') }}" method="POST" id="chatForm"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                                <div class="chat-input-row">
                                    <button type="button" class="chat-attach-btn" title="Attach">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.8">
                                            <path
                                                d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48" />
                                        </svg>
                                        <input type="file" name="file" id="fileInput"
                                            accept="image/*,application/pdf,.doc,.docx" onchange="previewFile(this)">
                                    </button>

                                    <textarea name="message" id="chatTa" class="chat-ta" placeholder="Type a message…" rows="1"></textarea>

                                    <div class="chat-foot-btns">
                                        <button type="button" class="chat-emoji-btn" id="emojiBtn"
                                            onclick="toggleEmoji(event)" title="Insert emoji">😊</button>

                                        <div class="emoji-picker" id="emojiPicker">
                                            <div class="ep-header">
                                                <div class="ep-header-title">Em<em>oji</em></div>
                                                <button type="button" class="ep-close"
                                                    onclick="closeEmoji()">✕</button>
                                            </div>

                                            <div class="ep-search">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <circle cx="11" cy="11" r="7" />
                                                    <path d="M17 17l3 3" />
                                                </svg>
                                                <input type="text" id="emojiSearch" placeholder="Search emoji…"
                                                    oninput="searchEmoji(this.value)" autocomplete="off">
                                            </div>
                                            <div class="ep-search-results" id="epSearchResults">
                                                <div class="ep-grid" id="epSearchGrid"></div>
                                            </div>

                                            <div class="ep-cats" id="epCats">
                                                <button type="button" class="ep-cat-btn ep-cat-active"
                                                    data-cat="smileys" onclick="switchCat(this)"
                                                    title="Smileys">😀</button>
                                                <button type="button" class="ep-cat-btn" data-cat="gestures"
                                                    onclick="switchCat(this)" title="Gestures">👍</button>
                                                <button type="button" class="ep-cat-btn" data-cat="hearts"
                                                    onclick="switchCat(this)" title="Hearts">❤️</button>
                                                <button type="button" class="ep-cat-btn" data-cat="nature"
                                                    onclick="switchCat(this)" title="Nature">🌸</button>
                                                <button type="button" class="ep-cat-btn" data-cat="food"
                                                    onclick="switchCat(this)" title="Food">🍕</button>
                                                <button type="button" class="ep-cat-btn" data-cat="travel"
                                                    onclick="switchCat(this)" title="Travel">✈️</button>
                                                <button type="button" class="ep-cat-btn" data-cat="objects"
                                                    onclick="switchCat(this)" title="Objects">💡</button>
                                                <button type="button" class="ep-cat-btn" data-cat="symbols"
                                                    onclick="switchCat(this)" title="Symbols">🎉</button>
                                            </div>

                                            <div class="ep-section ep-active" id="cat-smileys">
                                                <div class="ep-label">Smileys & Emotion</div>
                                                <div class="ep-grid" id="epSmileys"></div>
                                            </div>
                                            <div class="ep-section" id="cat-gestures">
                                                <div class="ep-label">Gestures & People</div>
                                                <div class="ep-grid" id="epGestures"></div>
                                            </div>
                                            <div class="ep-section" id="cat-hearts">
                                                <div class="ep-label">Hearts & Stars</div>
                                                <div class="ep-grid" id="epHearts"></div>
                                            </div>
                                            <div class="ep-section" id="cat-nature">
                                                <div class="ep-label">Animals & Nature</div>
                                                <div class="ep-grid" id="epNature"></div>
                                            </div>
                                            <div class="ep-section" id="cat-food">
                                                <div class="ep-label">Food & Drink</div>
                                                <div class="ep-grid" id="epFood"></div>
                                            </div>
                                            <div class="ep-section" id="cat-travel">
                                                <div class="ep-label">Travel & Places</div>
                                                <div class="ep-grid" id="epTravel"></div>
                                            </div>
                                            <div class="ep-section" id="cat-objects">
                                                <div class="ep-label">Objects</div>
                                                <div class="ep-grid" id="epObjects"></div>
                                            </div>
                                            <div class="ep-section" id="cat-symbols">
                                                <div class="ep-label">Symbols & Activities</div>
                                                <div class="ep-grid" id="epSymbols"></div>
                                            </div>
                                        </div>

                                        <button type="submit" class="chat-send-btn" title="Send">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <line x1="22" y1="2" x2="11" y2="13" />
                                                <polygon points="22 2 15 22 11 13 2 9 22 2" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    {{-- Welcome state — desktop only; mobile never reaches this since no conversation is open --}}
                    <div class="chat-welcome">
                        <div class="cw-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.4">
                                <path d="M4 4h16a2 2 0 012 2v8a2 2 0 01-2 2H7l-5 4V6a2 2 0 012-2z" />
                            </svg>
                        </div>
                        <div class="cw-title">Select a convers<em>ation</em></div>
                        <div class="cw-sub">Tap any admin, collaborator, or chat<br>on the left to open it here.</div>
                    </div>
                @endif

            </section>
        </div>

        {{-- ══════════════════════════════════
        GROUP CHAT MODAL
         ══════════════════════════════════ --}}
        <div class="gc-modal-overlay" id="gcOverlay" onclick="if(event.target===this)closeGroupModal()">
            <div class="gc-modal">
                <div class="gc-head">
                    <h2>Create Group <em>Chat</em></h2>
                    <button class="gc-close" onclick="closeGroupModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                </div>
                <form action="{{ route('group.chat.store') }}" method="POST">
                    @csrf
                    <div class="gc-body">

                        <label class="gc-label">Group Name *</label>
                        <input type="text" name="title" class="gc-input" placeholder="e.g. Wedding Team Chat"
                            required>

                        <div class="gc-section-title">Add Client (Optional)</div>
                        <select name="client_id" class="gc-input gc-select">
                            <option value="">-- Select Client --</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>

                        <div class="gc-section-title">Add Admin / Event Planner</div>
                        @foreach ($admins as $admin)
                            @if ($admin->id != auth()->id())
                                <label class="gc-check-row">
                                    <input type="checkbox" name="participants[]" value="{{ $admin->id }}">
                                    <div class="gc-check-ava adm">{{ strtoupper(substr($admin->name, 0, 2)) }}</div>
                                    <div>
                                        <div class="gc-check-name">{{ $admin->name }}</div>
                                        <div class="gc-check-sub">Admin</div>
                                    </div>
                                </label>
                            @endif
                        @endforeach

                        <div class="gc-section-title">Add Suppliers</div>
                        @foreach ($suppliers as $sup)
                            @if ($sup->id != auth()->id() && $sup?->supplier)
                                @php $sbn = optional($sup->supplier)->business_name; @endphp
                                <label class="gc-check-row">
                                    <input type="checkbox" name="participants[]" value="{{ $sup->id }}">
                                    <div class="gc-check-ava">{{ strtoupper(substr($sbn, 0, 2)) }}</div>
                                    <div>
                                        <div class="gc-check-name">{{ $sbn }}</div>
                                        <div class="gc-check-sub">Supplier</div>
                                    </div>
                                </label>
                            @endif
                        @endforeach

                    </div>
                    <div class="gc-foot">
                        <button type="button" class="btn-gc-cancel" onclick="closeGroupModal()">Cancel</button>
                        <button type="submit" class="btn-gc-create">Create Group</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Lightbox --}}
        <div class="lb-overlay" id="lbOverlay" onclick="closeLightbox()">
            <button class="lb-close" onclick="closeLightbox()">✕</button>
            <img id="lbImg" src="" alt="Preview">
        </div>

        <script>
            /* ── Auto-scroll ── */
            const chatBody = document.getElementById('chatBody');
            if (chatBody) chatBody.scrollTop = chatBody.scrollHeight;

            /* ── Textarea resize + Enter send ── */
            const ta = document.getElementById('chatTa');
            if (ta) {
                ta.addEventListener('keydown', e => {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        document.getElementById('chatForm').submit();
                    }
                });
                ta.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = Math.min(this.scrollHeight, 96) + 'px';
                });
            }

            /* ── File preview ── */
            function previewFile(input) {
                const file = input.files[0];
                if (!file) return;
                const bar = document.getElementById('filePreviewBar');
                const name = document.getElementById('fpName');
                const size = document.getElementById('fpSize');
                const thumb = document.getElementById('fpThumb');
                name.textContent = file.name;
                size.textContent = (file.size / 1024).toFixed(1) + ' KB';
                if (file.type.startsWith('image/')) {
                    const r = new FileReader();
                    r.onload = e => {
                        thumb.src = e.target.result;
                        thumb.style.display = '';
                    };
                    r.readAsDataURL(file);
                } else {
                    thumb.style.display = 'none';
                }
                bar.classList.add('show');
            }

            function clearFile() {
                document.getElementById('fileInput').value = '';
                document.getElementById('filePreviewBar').classList.remove('show');
                document.getElementById('fpThumb').src = '';
            }

            /* ── Lightbox ── */
            function openLightbox(src) {
                document.getElementById('lbImg').src = src;
                document.getElementById('lbOverlay').classList.add('open');
            }

            function closeLightbox() {
                document.getElementById('lbOverlay').classList.remove('open');
            }

            /* ── Group modal ── */
            function openGroupModal() {
                document.getElementById('gcOverlay').classList.add('open');
            }

            function closeGroupModal() {
                document.getElementById('gcOverlay').classList.remove('open');
            }

            /* ── Sidebar search ── */
            document.getElementById('sbSearch').addEventListener('input', function() {
                const q = this.value.toLowerCase();
                document.querySelectorAll('.sb-item[data-name]').forEach(el => {
                    el.style.display = el.dataset.name.includes(q) ? '' : 'none';
                });
            });

            /* ── Filter tabs ── */
            let activeFilter = 'all';

            function setTab(btn) {
                document.querySelectorAll('.sb-tab').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                activeFilter = btn.dataset.filter;
                applyFilter();
            }

            function applyFilter() {
                const supportItems = document.querySelectorAll('.sb-item[data-section="support"]');
                const collabItems = document.querySelectorAll('.sb-item[data-section="collab"]');
                const chatItems = document.querySelectorAll('.sb-item[data-section="chats"]');
                const lblSupport = document.getElementById('lbl-support');
                const lblCollab = document.getElementById('lbl-collab');
                const lblChats = document.getElementById('lbl-chats');
                const divCollab = document.getElementById('div-collab');
                const divChats = document.getElementById('div-chats');

                if (activeFilter === 'all') {
                    [supportItems, collabItems, chatItems].forEach(g => g.forEach(el => el.style.display = ''));
                    [lblSupport, lblCollab, lblChats, divCollab, divChats].forEach(el => {
                        if (el) el.style.display = '';
                    });
                } else {
                    supportItems.forEach(el => el.style.display = 'none');
                    collabItems.forEach(el => el.style.display = 'none');
                    if (lblSupport) lblSupport.style.display = 'none';
                    if (lblCollab) lblCollab.style.display = 'none';
                    if (divCollab) divCollab.style.display = 'none';
                    if (divChats) divChats.style.display = 'none';
                    if (lblChats) lblChats.style.display = 'none';

                    chatItems.forEach(el => {
                        if (activeFilter === 'unread') el.style.display = el.dataset.isUnread === '1' ? '' : 'none';
                        if (activeFilter === 'groups') el.style.display = el.dataset.isGroup === '1' ? '' : 'none';
                    });
                }
            }

            /* ── Mobile: add body class when a conversation opens ── */
            document.querySelectorAll('.sb-item').forEach(item => {
                item.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        document.body.classList.add('mob-chat-open');
                    }
                });
            });

            /* ── Mobile back button: remove body class so sidebar reappears ── */
            const mobBack = document.getElementById('mobBackBtn');
            if (mobBack) {
                mobBack.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768) {
                        document.body.classList.remove('mob-chat-open');
                        /* Let the link navigate normally — it goes to messages.inbox without conversation_id */
                    }
                });
            }

            /* ── Handle resize: ensure correct panel visibility ── */
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    document.body.classList.remove('mob-chat-open');
                }
            });

            /* ══════════════════════════════
            EMOJI PICKER
            ══════════════════════════════ */
            const EMOJI_DATA = {
                smileys: ['😀', '😃', '😄', '😁', '😆', '😅', '😂', '🤣', '😊', '😇', '🥰', '😍', '🤩', '😘', '😗', '😙',
                    '😚', '🙂', '🤗', '🤭', '😏', '😒', '😞', '😔', '😟', '😕', '🙁', '☹️', '😣', '😖', '😫', '😩',
                    '🥺', '😢', '😭', '😤', '😠', '😡', '🤬', '😈'
                ],
                gestures: ['👍', '👎', '👌', '🤌', '✌️', '🤞', '🤙', '👋', '🙌', '👏', '🤝', '🙏', '💪', '🫶', '🤜', '🤛',
                    '☝️', '👆', '👇', '👉', '👈', '🤏', '✋', '🖖', '🫱', '🫲', '🫳', '🫴', '🖐️', '👐', '🤲', '🙆',
                    '🙅', '💁', '🙋', '🧏', '🤷', '🤦'
                ],
                hearts: ['❤️', '🧡', '💛', '💚', '💙', '💜', '🖤', '🤍', '🤎', '💔', '❤️‍🔥', '❤️‍🩹', '💕', '💞', '💓',
                    '💗', '💖', '💝', '💘', '💟', '☮️', '✝️', '⭐', '🌟', '💫', '✨', '⚡', '🌈', '🎊', '🎉', '🥳', '🎈',
                    '🎀', '🎁', '🏆', '🥇', '👑', '💎', '🔮', '🌙'
                ],
                nature: ['🌸', '🌺', '🌻', '🌹', '🌷', '💐', '🍀', '🌿', '🌱', '🌲', '🌳', '🌴', '🍃', '🍂', '🍁', '🌾',
                    '🍄', '🌊', '🌬️', '❄️', '☃️', '⛄', '🌈', '🌤️', '⛅', '🌦️', '🌧️', '⛈️', '🌩️', '🌪️', '🦋', '🐝',
                    '🐞', '🦊', '🐶', '🐱', '🐼', '🐨', '🦁', '🐯'
                ],
                food: ['🍕', '🍔', '🌮', '🌯', '🥙', '🧆', '🥗', '🍜', '🍝', '🍣', '🍱', '🥟', '🦪', '🍤', '🍗', '🍖', '🥩',
                    '🍳', '🥚', '🧇', '🥞', '🧈', '🥓', '🥐', '🍞', '🥨', '🥯', '🧀', '🍟', '🌭', '🥪', '🥣', '🍲',
                    '🥘', '🍛', '🍚', '🍙', '🍘', '🍥', '🧁'
                ],
                travel: ['✈️', '🚀', '🛸', '🚁', '🛩️', '🚂', '🚃', '🚄', '🚅', '🚆', '🚇', '🚊', '🚝', '🚞', '🚋', '🚌',
                    '🚍', '🚎', '🚐', '🚑', '🚒', '🚓', '🚔', '🚕', '🚖', '🚗', '🚘', '🚙', '🛻', '🚚', '🚛', '🚜',
                    '🏎️', '🏍️', '🛵', '🚲', '🛴', '🛹', '🛼', '🛺'
                ],
                objects: ['💡', '🔦', '🕯️', '🖥️', '💻', '⌨️', '🖱️', '🖨️', '📱', '📲', '☎️', '📞', '📟', '📠', '📺',
                    '📻', '🧭', '⏰', '⌚', '📷', '📸', '📹', '🎥', '📽️', '🎞️', '📡', '🔭', '🔬', '💊', '🩺', '🩻',
                    '🔧', '🔨', '⚙️', '🗜️', '🔑', '🗝️', '🔐', '🔒', '🔓'
                ],
                symbols: ['🎉', '🎊', '🎈', '🎀', '🎁', '🏆', '🥇', '🥈', '🥉', '🎯', '🎮', '🎲', '♟️', '🎭', '🎨', '🖼️',
                    '🎬', '🎤', '🎧', '🎵', '🎶', '🎼', '🎹', '🥁', '🎷', '🎺', '🎸', '🪕', '🎻', '🪗', '🎲', '🃏',
                    '🀄', '🎴', '🔔', '🔕', '💯', '✅', '❌', '❓'
                ]
            };

            const gridMap = {
                smileys: 'epSmileys',
                gestures: 'epGestures',
                hearts: 'epHearts',
                nature: 'epNature',
                food: 'epFood',
                travel: 'epTravel',
                objects: 'epObjects',
                symbols: 'epSymbols'
            };

            Object.entries(gridMap).forEach(([cat, gridId]) => {
                const grid = document.getElementById(gridId);
                if (!grid) return;
                grid.innerHTML = EMOJI_DATA[cat].map(e =>
                    `<span class="ep-emoji" onclick="insertEmoji('${e}')">${e}</span>`
                ).join('');
            });

            function toggleEmoji(e) {
                e.stopPropagation();
                const picker = document.getElementById('emojiPicker');
                const btn = document.getElementById('emojiBtn');
                const isOpen = picker.classList.contains('open');
                picker.classList.toggle('open');
                btn.classList.toggle('is-open', !isOpen);
                if (!isOpen) {
                    document.getElementById('emojiSearch').value = '';
                    searchEmoji('');
                }
            }

            function closeEmoji() {
                document.getElementById('emojiPicker').classList.remove('open');
                document.getElementById('emojiBtn').classList.remove('is-open');
            }

            function switchCat(btn) {
                document.querySelectorAll('.ep-cat-btn').forEach(b => b.classList.remove('ep-cat-active'));
                btn.classList.add('ep-cat-active');
                const cat = btn.dataset.cat;
                document.querySelectorAll('.ep-section').forEach(s => s.classList.remove('ep-active'));
                const sec = document.getElementById('cat-' + cat);
                if (sec) sec.classList.add('ep-active');
            }

            function searchEmoji(q) {
                const sr = document.getElementById('epSearchResults');
                const cats = document.getElementById('epCats');
                const grid = document.getElementById('epSearchGrid');
                const sections = document.querySelectorAll('.ep-section');
                if (!q.trim()) {
                    sr.classList.remove('show');
                    cats.style.display = '';
                    sections.forEach(s => s.style.display = '');
                    return;
                }
                cats.style.display = 'none';
                sections.forEach(s => s.style.display = 'none');
                const allEmoji = Object.values(EMOJI_DATA).flat();
                grid.innerHTML = allEmoji.slice(0, 80).map(e =>
                    `<span class="ep-emoji" onclick="insertEmoji('${e}')">${e}</span>`
                ).join('');
                sr.classList.add('show');
            }

            function insertEmoji(emoji) {
                const ta = document.getElementById('chatTa');
                if (!ta) return;
                const s = ta.selectionStart,
                    e = ta.selectionEnd;
                ta.value = ta.value.substring(0, s) + emoji + ta.value.substring(e);
                ta.selectionStart = ta.selectionEnd = s + [...emoji].length;
                ta.focus();
                ta.dispatchEvent(new Event('input'));
            }

            document.addEventListener('click', e => {
                const picker = document.getElementById('emojiPicker');
                const btn = document.getElementById('emojiBtn');
                if (picker && picker.classList.contains('open')) {
                    if (!picker.contains(e.target) && e.target !== btn) {
                        closeEmoji();
                    }
                }
            });
        </script>

    </x-supplier-layout>
@else
    {{-- resources/views/messages/client-chatbox.blade.php --}}

    <x-client-layout>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap');

            .msg-page * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            .msg-page {
                font-family: 'Outfit', system-ui, sans-serif;
                --ink: #14110E;
                --ink-2: #1C1916;
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

                background: var(--stone);
                height: calc(100vh - 58px);
                display: flex;
                overflow: hidden;
                padding: 1rem;
                gap: 1rem;
            }

            /* ════════════════════════════════
    SIDEBAR
    ════════════════════════════════ */
            .msg-sidebar {
                width: 300px;
                flex-shrink: 0;
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: 16px;
                display: flex;
                flex-direction: column;
                overflow: hidden;
                box-shadow: 0 2px 14px rgba(20, 17, 14, .05);
            }

            .sb-head {
                padding: 1rem 1.1rem 0.85rem;
                border-bottom: 1px solid var(--border);
                flex-shrink: 0;
            }

            .sb-title {
                font-family: 'Cormorant Garamond', Georgia, serif;
                font-size: 1.18rem;
                font-weight: 700;
                color: var(--ink);
                line-height: 1;
                letter-spacing: 0.01em;
                margin-bottom: 0.7rem;
            }

            .sb-title em {
                font-style: italic;
                color: var(--gold);
            }

            .sb-search {
                display: flex;
                align-items: center;
                gap: 0.4rem;
                background: var(--stone);
                border: 1px solid var(--border);
                border-radius: 9px;
                padding: 0.4rem 0.75rem;
                margin-bottom: 0.75rem;
                transition: border-color .2s, box-shadow .2s;
            }

            .sb-search:focus-within {
                border-color: var(--gold);
                box-shadow: 0 0 0 3px rgba(184, 146, 74, 0.08);
            }

            .sb-search svg {
                width: 12px;
                height: 12px;
                color: var(--mist-light);
                flex-shrink: 0;
            }

            .sb-search input {
                border: none;
                outline: none;
                background: transparent;
                font-family: 'Outfit', sans-serif;
                font-size: 0.77rem;
                color: var(--ink);
                width: 100%;
            }

            .sb-search input::placeholder {
                color: var(--mist-light);
            }

            .sb-tabs {
                display: flex;
                gap: 4px;
            }

            .sb-tab {
                flex: 1;
                padding: 5px 0;
                border: 1px solid var(--border);
                border-radius: 8px;
                background: transparent;
                font-family: 'Outfit', sans-serif;
                font-size: 0.67rem;
                font-weight: 600;
                color: var(--mist);
                cursor: pointer;
                transition: all .15s;
                text-align: center;
                position: relative;
            }

            .sb-tab:hover {
                border-color: var(--gold);
                color: var(--gold);
            }

            .sb-tab.active {
                background: var(--ink);
                border-color: var(--ink);
                color: var(--gold-light);
            }

            .sb-tab .tab-dot {
                display: inline-block;
                width: 5px;
                height: 5px;
                border-radius: 50%;
                background: var(--gold);
                margin-left: 3px;
                vertical-align: middle;
                position: relative;
                top: -1px;
            }

            .sb-scroll {
                flex: 1;
                overflow-y: auto;
                padding: 0.45rem 0 0.75rem;
                scrollbar-width: thin;
                scrollbar-color: var(--border) transparent;
            }

            .sb-scroll::-webkit-scrollbar {
                width: 3px;
            }

            .sb-scroll::-webkit-scrollbar-thumb {
                background: var(--border);
                border-radius: 99px;
            }

            .sb-group-label {
                font-size: 0.54rem;
                font-weight: 700;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                color: var(--mist-light);
                padding: 0.7rem 1.1rem 0.28rem;
            }

            .sb-divider {
                height: 1px;
                background: linear-gradient(90deg, transparent, var(--border), transparent);
                margin: 0.35rem 0.9rem;
            }

            .sb-item {
                display: flex;
                align-items: center;
                gap: 0.6rem;
                padding: 0.58rem 0.9rem;
                margin: 0.04rem 0.4rem;
                border-radius: 10px;
                cursor: pointer;
                border: none;
                background: none;
                width: calc(100% - 0.8rem);
                text-align: left;
                font-family: 'Outfit', sans-serif;
                transition: background .15s;
                position: relative;
                text-decoration: none;
                color: inherit;
            }

            .sb-item:hover {
                background: var(--stone);
            }

            .sb-item.is-active {
                background: linear-gradient(135deg, rgba(184, 146, 74, 0.15) 0%, rgba(184, 146, 74, 0.05) 100%);
            }

            .sb-item.is-active::before {
                content: '';
                position: absolute;
                left: -0.4rem;
                top: 22%;
                bottom: 22%;
                width: 3px;
                border-radius: 0 3px 3px 0;
                background: linear-gradient(to bottom, var(--gold-light), var(--gold));
            }

            .sb-ava {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                flex-shrink: 0;
                background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Cormorant Garamond', serif;
                font-size: 0.82rem;
                font-weight: 700;
                color: var(--white);
                border: 1.5px solid rgba(184, 146, 74, 0.2);
                position: relative;
            }

            .sb-ava.is-admin {
                background: linear-gradient(135deg, var(--ink) 0%, #3D3530 100%);
                border-color: rgba(184, 146, 74, 0.3);
            }

            .sb-ava.is-group {
                background: linear-gradient(135deg, #5C4B8A 0%, #3D3060 100%);
                border-color: rgba(92, 75, 138, 0.3);
            }

            .sb-ava .online-dot {
                position: absolute;
                bottom: 0;
                right: 0;
                width: 9px;
                height: 9px;
                border-radius: 50%;
                background: var(--success);
                border: 2px solid var(--white);
            }

            .sb-info {
                flex: 1;
                min-width: 0;
            }

            .sb-name {
                font-size: 0.79rem;
                font-weight: 500;
                color: var(--ink);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .sb-name.has-unread {
                font-weight: 700;
            }

            .sb-sub {
                font-size: 0.66rem;
                color: var(--mist);
                margin-top: 1px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .sb-meta {
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                gap: 4px;
                flex-shrink: 0;
            }

            .sb-time {
                font-size: 0.59rem;
                color: var(--mist-light);
            }

            .sb-pill {
                font-size: 0.52rem;
                font-weight: 700;
                letter-spacing: 0.07em;
                text-transform: uppercase;
                padding: 2px 7px;
                border-radius: 999px;
                white-space: nowrap;
            }

            .sb-pill.admin {
                background: rgba(20, 17, 14, 0.08);
                color: var(--ink);
            }

            .sb-pill.supplier {
                background: var(--gold-dim);
                color: var(--gold);
                border: 1px solid var(--gold-border);
            }

            .sb-pill.group {
                background: rgba(92, 75, 138, 0.1);
                color: #5C4B8A;
                border: 1px solid rgba(92, 75, 138, 0.2);
            }

            .sb-unread-badge {
                min-width: 17px;
                height: 17px;
                border-radius: 999px;
                background: var(--gold);
                color: var(--ink);
                font-size: 0.52rem;
                font-weight: 700;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 0 4px;
                line-height: 1;
            }

            .sb-empty {
                padding: 1.5rem 1rem;
                text-align: center;
                font-size: 0.73rem;
                color: var(--mist);
            }

            .sb-empty svg {
                width: 28px;
                height: 28px;
                display: block;
                margin: 0 auto 0.4rem;
                opacity: .28;
            }

            /* ════════════════════════════════
    MAIN CHAT PANEL
    ════════════════════════════════ */
            .msg-main {
                flex: 1;
                min-width: 0;
                display: flex;
                flex-direction: column;
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 2px 14px rgba(20, 17, 14, .05);
            }

            /* Mobile back button — hidden on desktop */
            .mob-back-btn {
                display: none;
                width: 32px;
                height: 32px;
                border-radius: 8px;
                border: 1px solid var(--border);
                background: var(--stone);
                align-items: center;
                justify-content: center;
                color: var(--mist);
                cursor: pointer;
                flex-shrink: 0;
                transition: all .15s;
                text-decoration: none;
            }

            .mob-back-btn svg {
                width: 16px;
                height: 16px;
            }

            .mob-back-btn:hover {
                border-color: var(--gold);
                color: var(--gold);
                background: var(--gold-dim);
            }

            .chat-head {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.82rem 1.25rem;
                border-bottom: 1px solid var(--border);
                flex-shrink: 0;
                background: var(--white);
            }

            .chat-head-ava {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                flex-shrink: 0;
                background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Cormorant Garamond', serif;
                font-size: 0.9rem;
                font-weight: 700;
                color: var(--white);
                border: 2px solid rgba(184, 146, 74, 0.22);
                position: relative;
            }

            .chat-head-ava.is-admin {
                background: linear-gradient(135deg, var(--ink) 0%, #3D3530 100%);
            }

            .chat-head-ava.is-group {
                background: linear-gradient(135deg, #5C4B8A 0%, #3D3060 100%);
            }

            .chat-head-ava .online-dot {
                position: absolute;
                bottom: 1px;
                right: 1px;
                width: 10px;
                height: 10px;
                border-radius: 50%;
                background: var(--success);
                border: 2px solid var(--white);
            }

            .chat-head-info {
                flex: 1;
                min-width: 0;
            }

            .chat-head-name {
                font-family: 'Cormorant Garamond', serif;
                font-size: 1.06rem;
                font-weight: 700;
                color: var(--ink);
                line-height: 1.1;
            }

            .chat-head-role {
                font-size: 0.64rem;
                color: var(--mist);
                margin-top: 2px;
                display: flex;
                align-items: center;
                gap: 0.28rem;
            }

            .dot-online {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background: var(--success);
                display: inline-block;
            }

            .chat-head-acts {
                display: flex;
                gap: 0.38rem;
            }

            .ch-btn {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                border: 1px solid var(--border);
                background: var(--stone);
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--mist);
                cursor: pointer;
                transition: all .15s;
            }

            .ch-btn:hover {
                border-color: var(--gold);
                color: var(--gold);
                background: var(--gold-dim);
            }

            .ch-btn svg {
                width: 14px;
                height: 14px;
            }

            .chat-body {
                flex: 1;
                overflow-y: auto;
                padding: 1.25rem;
                display: flex;
                flex-direction: column;
                gap: 0.65rem;
                background: var(--stone);
                scrollbar-width: thin;
                scrollbar-color: var(--border) transparent;
            }

            .chat-body::-webkit-scrollbar {
                width: 3px;
            }

            .chat-body::-webkit-scrollbar-thumb {
                background: var(--border);
                border-radius: 99px;
            }

            .chat-date {
                text-align: center;
                font-size: 0.63rem;
                color: var(--mist-light);
                margin: 0.35rem 0;
                position: relative;
            }

            .chat-date span {
                background: var(--stone-2);
                padding: 2px 10px;
                border-radius: 999px;
                border: 1px solid var(--border);
                position: relative;
                z-index: 1;
            }

            .chat-date::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 0;
                right: 0;
                height: 1px;
                background: var(--border);
            }

            .brow {
                display: flex;
                align-items: flex-end;
                gap: 0.48rem;
            }

            .brow.me {
                flex-direction: row-reverse;
            }

            .bava {
                width: 28px;
                height: 28px;
                border-radius: 50%;
                flex-shrink: 0;
                background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Cormorant Garamond', serif;
                font-size: 0.64rem;
                font-weight: 700;
                color: var(--white);
                border: 1.5px solid rgba(184, 146, 74, 0.18);
            }

            .bava.is-admin {
                background: linear-gradient(135deg, var(--ink) 0%, #3D3530 100%);
            }

            .bblock {
                display: flex;
                flex-direction: column;
                max-width: 65%;
                gap: 2px;
            }

            .brow.me .bblock {
                align-items: flex-end;
            }

            .bsender {
                font-size: 0.61rem;
                font-weight: 600;
                color: var(--mist);
                padding: 0 3px;
            }

            .bubble {
                padding: 0.6rem 0.9rem;
                border-radius: 14px;
                font-size: 0.81rem;
                line-height: 1.55;
                word-break: break-word;
            }

            .bubble.them {
                background: var(--white);
                color: var(--ink);
                border: 1px solid var(--border);
                border-bottom-left-radius: 4px;
            }

            .bubble.me {
                background: var(--ink);
                color: var(--gold-pale);
                border-bottom-right-radius: 4px;
            }

            .btime {
                font-size: 0.58rem;
                color: var(--mist-light);
                padding: 0 3px;
            }

            .bubble-img {
                max-width: 220px;
                border-radius: 10px;
                overflow: hidden;
                margin-top: 2px;
                border: 1px solid var(--border);
            }

            .bubble-img img {
                width: 100%;
                display: block;
                cursor: pointer;
            }

            @keyframes bubbleIn {
                from {
                    opacity: 0;
                    transform: translateY(5px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .brow {
                animation: bubbleIn .15s ease both;
            }

            /* ════════════════════════════════
    CHAT FOOTER
    ════════════════════════════════ */
            .chat-foot {
                border-top: 1px solid var(--border);
                flex-shrink: 0;
                background: var(--white);
                position: relative;
            }

            .file-preview-bar {
                display: none;
                align-items: center;
                gap: 0.6rem;
                padding: 0.6rem 1.1rem;
                background: var(--gold-dim);
                border-bottom: 1px solid var(--gold-border);
            }

            .file-preview-bar.show {
                display: flex;
            }

            .fp-thumb {
                width: 40px;
                height: 40px;
                border-radius: 8px;
                object-fit: cover;
                border: 1px solid var(--gold-border);
                flex-shrink: 0;
            }

            .fp-name {
                flex: 1;
                font-size: 0.75rem;
                color: var(--ink);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .fp-size {
                font-size: 0.67rem;
                color: var(--mist);
                flex-shrink: 0;
            }

            .fp-remove {
                width: 22px;
                height: 22px;
                border-radius: 50%;
                background: rgba(20, 17, 14, 0.1);
                border: none;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                color: var(--ink);
                flex-shrink: 0;
                transition: background .15s;
            }

            .fp-remove:hover {
                background: rgba(192, 57, 43, 0.15);
                color: var(--danger);
            }

            .fp-remove svg {
                width: 12px;
                height: 12px;
            }

            .chat-input-wrap {
                padding: 0.75rem 1.1rem;
            }

            .chat-input-row {
                display: flex;
                align-items: flex-end;
                gap: 0.5rem;
                background: var(--stone);
                border: 1.5px solid var(--border);
                border-radius: 14px;
                padding: 0.5rem 0.6rem 0.5rem 0.95rem;
                transition: border-color .2s, box-shadow .2s;
            }

            .chat-input-row:focus-within {
                border-color: var(--gold);
                box-shadow: 0 0 0 3px rgba(184, 146, 74, 0.08);
            }

            .chat-attach-btn {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                flex-shrink: 0;
                border: none;
                background: transparent;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--mist-light);
                cursor: pointer;
                transition: color .15s;
                position: relative;
            }

            .chat-attach-btn:hover {
                color: var(--gold);
            }

            .chat-attach-btn svg {
                width: 17px;
                height: 17px;
            }

            .chat-attach-btn input[type=file] {
                position: absolute;
                inset: 0;
                opacity: 0;
                cursor: pointer;
                width: 100%;
                height: 100%;
            }

            .chat-ta {
                flex: 1;
                border: none;
                outline: none;
                background: transparent;
                font-family: 'Outfit', sans-serif;
                font-size: 0.81rem;
                color: var(--ink);
                resize: none;
                line-height: 1.5;
                max-height: 96px;
                min-height: 22px;
            }

            .chat-ta::placeholder {
                color: var(--mist-light);
            }

            .chat-foot-btns {
                display: flex;
                align-items: center;
                gap: 4px;
                flex-shrink: 0;
            }

            .chat-emoji-btn {
                width: 30px;
                height: 30px;
                border-radius: 8px;
                border: none;
                background: transparent;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--mist-light);
                cursor: pointer;
                font-size: 16px;
                transition: color .15s, background .15s;
                position: relative;
            }

            .chat-emoji-btn:hover {
                color: var(--gold);
                background: var(--gold-dim);
            }

            .chat-emoji-btn.picker-open {
                color: var(--gold);
                background: var(--gold-dim);
            }

            .chat-send-btn {
                width: 34px;
                height: 34px;
                border-radius: 9px;
                flex-shrink: 0;
                background: var(--ink);
                border: none;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--gold-light);
                cursor: pointer;
                transition: all .18s;
            }

            .chat-send-btn:hover {
                background: var(--gold);
                color: var(--white);
                transform: scale(1.05);
            }

            .chat-send-btn svg {
                width: 14px;
                height: 14px;
            }

            /* ════════════════════════════════
    EMOJI PICKER
    ════════════════════════════════ */
            .emoji-picker {
                display: none;
                position: absolute;
                bottom: calc(100% + 8px);
                right: 1.1rem;
                width: 300px;
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: 14px;
                box-shadow: 0 8px 32px rgba(20, 17, 14, 0.14);
                z-index: 500;
                overflow: hidden;
                animation: emojiIn .18s ease;
            }

            .emoji-picker.open {
                display: flex;
                flex-direction: column;
            }

            @keyframes emojiIn {
                from {
                    opacity: 0;
                    transform: translateY(6px) scale(.97);
                }

                to {
                    opacity: 1;
                    transform: none;
                }
            }

            .ep-tabs {
                display: flex;
                border-bottom: 1px solid var(--border);
                background: var(--stone);
                overflow-x: auto;
                scrollbar-width: none;
                flex-shrink: 0;
            }

            .ep-tabs::-webkit-scrollbar {
                display: none;
            }

            .ep-tab {
                flex-shrink: 0;
                padding: 0.5rem 0.65rem;
                font-size: 1rem;
                border: none;
                background: transparent;
                cursor: pointer;
                opacity: 0.45;
                transition: opacity .15s, background .15s;
                border-bottom: 2px solid transparent;
            }

            .ep-tab:hover {
                opacity: 0.8;
            }

            .ep-tab.active {
                opacity: 1;
                border-bottom-color: var(--gold);
                background: rgba(184, 146, 74, 0.06);
            }

            .ep-search {
                display: flex;
                align-items: center;
                gap: 0.4rem;
                padding: 0.5rem 0.75rem;
                border-bottom: 1px solid var(--border);
                flex-shrink: 0;
            }

            .ep-search svg {
                width: 12px;
                height: 12px;
                color: var(--mist-light);
                flex-shrink: 0;
            }

            .ep-search input {
                flex: 1;
                border: none;
                outline: none;
                background: transparent;
                font-family: 'Outfit', sans-serif;
                font-size: 0.75rem;
                color: var(--ink);
            }

            .ep-search input::placeholder {
                color: var(--mist-light);
            }

            .ep-grid {
                display: grid;
                grid-template-columns: repeat(8, 1fr);
                gap: 1px;
                padding: 0.5rem;
                max-height: 200px;
                overflow-y: auto;
                scrollbar-width: thin;
                scrollbar-color: var(--border) transparent;
            }

            .ep-grid::-webkit-scrollbar {
                width: 3px;
            }

            .ep-grid::-webkit-scrollbar-thumb {
                background: var(--border);
                border-radius: 99px;
            }

            .ep-em {
                font-size: 1.2rem;
                padding: 4px;
                border: none;
                background: transparent;
                cursor: pointer;
                border-radius: 6px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: background .12s, transform .1s;
                line-height: 1;
            }

            .ep-em:hover {
                background: var(--gold-dim);
                transform: scale(1.2);
            }

            .ep-empty {
                text-align: center;
                padding: 1rem;
                font-size: 0.73rem;
                color: var(--mist);
                grid-column: 1/-1;
            }

            /* ════════════════════════════════
    WELCOME STATE
    ════════════════════════════════ */
            .chat-welcome {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 0.75rem;
                padding: 2rem;
                background: var(--stone);
            }

            .cw-icon {
                width: 64px;
                height: 64px;
                border-radius: 50%;
                background: var(--gold-dim);
                border: 1px solid var(--gold-border);
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--gold);
            }

            .cw-icon svg {
                width: 28px;
                height: 28px;
            }

            .cw-title {
                font-family: 'Cormorant Garamond', serif;
                font-size: 1.15rem;
                font-weight: 700;
                color: var(--ink);
            }

            .cw-title em {
                font-style: italic;
                color: var(--gold);
            }

            .cw-sub {
                font-size: 0.75rem;
                color: var(--mist);
                text-align: center;
                line-height: 1.65;
            }

            /* ════════════════════════════════
    LIGHTBOX
    ════════════════════════════════ */
            .lb-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(20, 17, 14, .85);
                z-index: 9999;
                align-items: center;
                justify-content: center;
            }

            .lb-overlay.open {
                display: flex;
            }

            .lb-overlay img {
                max-width: 90vw;
                max-height: 88vh;
                border-radius: 12px;
            }

            .lb-close {
                position: absolute;
                top: 1rem;
                right: 1rem;
                width: 36px;
                height: 36px;
                border-radius: 50%;
                background: rgba(255, 255, 255, .12);
                border: none;
                color: #fff;
                font-size: 20px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* ════════════════════════════════
    MOBILE RESPONSIVE — ≤ 768px
    • Default view: full-screen conversation list
    • When a chat is open (body.mob-chat-open): full-screen chat panel
    • No sidebar + no chat panel shown simultaneously
    • Back button navigates from chat → list
    ════════════════════════════════ */
            @media (max-width: 768px) {

                .msg-page {
                    padding: 0;
                    gap: 0;
                    height: calc(100vh - 58px);
                    position: relative;
                }

                /* Sidebar fills full screen on mobile by default */
                .msg-sidebar {
                    width: 100%;
                    border-radius: 0;
                    border: none;
                    box-shadow: none;
                    height: 100%;
                }

                /* Hide sidebar when chat is open */
                body.mob-chat-open .msg-sidebar {
                    display: none;
                }

                /* Chat panel hidden by default on mobile */
                .msg-main {
                    display: none;
                    position: absolute;
                    inset: 0;
                    z-index: 10;
                    border-radius: 0;
                    border: none;
                }

                /* Show chat panel when a conversation is active */
                body.mob-chat-open .msg-main {
                    display: flex;
                }

                /* Reveal mobile back button */
                .mob-back-btn {
                    display: flex;
                }

                /* Wider bubbles on small screens */
                .bblock {
                    max-width: 80%;
                }

                /* Tighter header on mobile */
                .chat-head {
                    padding: 0.7rem 0.9rem;
                    gap: 0.55rem;
                }

                .chat-head-name {
                    font-size: 0.95rem;
                }

                /* Emoji picker — centered on mobile */
                .emoji-picker {
                    width: calc(100vw - 1.8rem);
                    right: 0.9rem;
                    bottom: calc(100% + 6px);
                }

                /* Tighter input area */
                .chat-input-wrap {
                    padding: 0.55rem 0.75rem;
                }

                /* Larger touch targets in sidebar */
                .sb-item {
                    padding: 0.75rem 0.9rem;
                }

                .sb-ava {
                    width: 40px;
                    height: 40px;
                    font-size: 0.9rem;
                }

                /* Hide active indicator bar — not needed on full-screen mobile list */
                .sb-item.is-active::before {
                    display: none;
                }

                /* Sidebar head spacing */
                .sb-head {
                    padding: 0.85rem 0.9rem 0.7rem;
                }
            }

            @media (max-width: 420px) {
                .sb-tab {
                    font-size: 0.62rem;
                    padding: 5px 2px;
                }

                .chat-head-acts .ch-btn:last-child {
                    display: none;
                }
            }
        </style>

        @php
            $authId = auth()->id();
            $authName = auth()->user()->name ?? 'Me';
            $activeConvId = $conversation?->id ?? null;

            $unreadCount = $conversations
                ->filter(function ($c) use ($authId) {
                    $last = $c->messages->last();
                    return $last && $last->sender_id != $authId;
                })
                ->count();

            $groupCount = $conversations->where('type', 'group')->count();

            $hasMobChat = $activeConvId ? 'true' : 'false';
        @endphp

        {{-- Inject body class immediately on mobile if a conversation is active --}}
        <script>
            if ({{ $hasMobChat }} && window.innerWidth <= 768) {
                document.body.classList.add('mob-chat-open');
            }
        </script>

        <div class="msg-page">

            {{-- ══ SIDEBAR ══ --}}
            <aside class="msg-sidebar">

                <div class="sb-head">
                    <div class="sb-title">Chats</div>

                    <div class="sb-search">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="7" />
                            <path d="M17 17l3 3" />
                        </svg>
                        <input type="text" id="sbSearch" placeholder="Search contacts, chats…"
                            autocomplete="off">
                    </div>

                    <div class="sb-tabs">
                        <button class="sb-tab active" data-filter="all" onclick="setTab(this)">All</button>
                        <button class="sb-tab" data-filter="unread" onclick="setTab(this)">
                            Unread
                            @if ($unreadCount > 0)
                                <span class="tab-dot"></span>
                            @endif
                        </button>
                        <button class="sb-tab" data-filter="groups" onclick="setTab(this)">Groups</button>
                    </div>
                </div>

                <div class="sb-scroll" id="sbScroll">

                    <div class="sb-group-label" data-section="support">Support</div>

                    @forelse($admins as $admin)
                        @php
                            $ini = strtoupper(substr($admin->name, 0, 2));
                            $isActive = $activeConvId && $conversation->participants->contains('user_id', $admin->id);
                        @endphp
                        <a href="{{ route('messages.start', $admin->id) }}"
                            class="sb-item {{ $isActive ? 'is-active' : '' }}"
                            data-name="{{ strtolower($admin->name) }}" data-section="support"
                            data-filter-group="all">
                            <div class="sb-ava is-admin">{{ $ini }}<span class="online-dot"></span></div>
                            <div class="sb-info">
                                <div class="sb-name">{{ $admin->name }}</div>
                                <div class="sb-sub">Admin support</div>
                            </div>
                            <div class="sb-meta"><span class="sb-pill admin">Admin</span></div>
                        </a>
                    @empty
                        <div class="sb-empty" data-section="support">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="8" r="4" />
                                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                            </svg>
                            No admin available.
                        </div>
                    @endforelse

                    <div class="sb-divider" data-section="suppliers-div"></div>
                    <div class="sb-group-label" data-section="suppliers">Suppliers</div>

                    @forelse($suppliers as $sup)
                        @if ($sup?->supplier)
                            @php
                                $biz = $sup->supplier->business_name;
                                $ini = strtoupper(substr($biz, 0, 2));
                                $isActive = $activeConvId && $conversation->participants->contains('user_id', $sup->id);
                            @endphp
                            <a href="{{ route('messages.start', $sup->id) }}"
                                class="sb-item {{ $isActive ? 'is-active' : '' }}"
                                data-name="{{ strtolower($biz) }}" data-section="suppliers" data-filter-group="all">
                                <div class="sb-ava">{{ $ini }}</div>
                                <div class="sb-info">
                                    <div class="sb-name">{{ $biz }}</div>
                                    <div class="sb-sub">Start conversation</div>
                                </div>
                                <div class="sb-meta"><span class="sb-pill supplier">Supplier</span></div>
                            </a>
                        @endif
                    @empty
                        <div class="sb-empty" data-section="suppliers">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5">
                                <path d="M3 9h13v10H3zM16 13h4l3 3v3h-7z" />
                                <circle cx="7" cy="19" r="2" />
                                <circle cx="20" cy="19" r="2" />
                            </svg>
                            No suppliers found.
                        </div>
                    @endforelse

                    <div class="sb-divider" data-section="chats-div"></div>
                    <div class="sb-group-label" data-section="chats">Recent Chats</div>

                    @forelse($conversations as $conv)
                        @php
                            $other = $conv->participants->where('user_id', '!=', auth()->id())->first()?->user;
                            $dname =
                                $conv->type === 'group'
                                    ? $conv->title ?? 'Group Chat'
                                    : $other?->supplierProfile?->business_name ?? ($other?->name ?? 'Chat');
                            $ini = strtoupper(substr($dname, 0, 2));
                            $last = optional($conv->messages->last())->message ?? 'No messages yet';
                            $time = $conv->messages->last()?->created_at;
                            $isAdm = $other?->role === 'admin';
                            $isGrp = $conv->type === 'group';
                            $isUnrd = $conv->messages->last() && $conv->messages->last()->sender_id != $authId;
                            $isA = $activeConvId == $conv->id;
                            $fg = $isGrp ? 'groups' : ($isUnrd ? 'unread' : 'all');
                        @endphp
                        <a href="{{ route('messages.inbox', ['conversation_id' => $conv->id]) }}"
                            class="sb-item {{ $isA ? 'is-active' : '' }}" data-name="{{ strtolower($dname) }}"
                            data-section="chats" data-filter-group="{{ $fg }}"
                            data-is-unread="{{ $isUnrd ? '1' : '0' }}" data-is-group="{{ $isGrp ? '1' : '0' }}">
                            <div class="sb-ava {{ $isAdm ? 'is-admin' : ($isGrp ? 'is-group' : '') }}">
                                {{ $ini }}</div>
                            <div class="sb-info">
                                <div class="sb-name {{ $isUnrd ? 'has-unread' : '' }}">{{ $dname }}</div>
                                <div class="sb-sub">{{ \Illuminate\Support\Str::limit($last, 36) }}</div>
                            </div>
                            <div class="sb-meta">
                                @if ($time)
                                    <div class="sb-time">{{ $time->diffForHumans(null, true) }}</div>
                                @endif
                                @if ($isGrp)
                                    <span class="sb-pill group">Group</span>
                                @elseif($isUnrd)
                                    <span class="sb-unread-badge">!</span>
                                @endif
                            </div>
                        </a>
                    @empty
                        <div class="sb-empty" data-section="chats">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5">
                                <path d="M4 4h16a2 2 0 012 2v8a2 2 0 01-2 2H7l-5 4V6a2 2 0 012-2z" />
                            </svg>
                            No conversations yet.
                        </div>
                    @endforelse

                </div>
            </aside>

            {{-- ══ MAIN CHAT PANEL ══ --}}
            <section class="msg-main">

                @if ($conversation)

                    @php
                        $chatOther = $conversation->participants->where('user_id', '!=', auth()->id())->first()?->user;
                        $chatName =
                            $conversation->type === 'group'
                                ? $conversation->title ?? 'Group Chat'
                                : $chatOther?->supplierProfile?->business_name ?? ($chatOther?->name ?? 'Chat');
                        $chatInit = strtoupper(substr($chatName, 0, 2));
                        $chatIsAdmin = $chatOther?->role === 'admin';
                        $chatIsGroup = $conversation->type === 'group';
                        $chatRole = $chatIsAdmin
                            ? 'Admin Support'
                            : ($chatIsGroup
                                ? 'Group · ' . $conversation->participants->count() . ' members'
                                : ($chatOther?->supplier?->business_name
                                    ? 'Supplier'
                                    : 'Client'));
                    @endphp

                    <div class="chat-head">
                        {{-- Back button (mobile only) --}}
                        <a href="{{ route('messages.inbox') }}" class="mob-back-btn" id="mobBackBtn"
                            title="Back">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2.2">
                                <path d="M15 18l-6-6 6-6" />
                            </svg>
                        </a>

                        <div
                            class="chat-head-ava {{ $chatIsAdmin ? 'is-admin' : ($chatIsGroup ? 'is-group' : '') }}">
                            {{ $chatInit }}
                            @if (!$chatIsGroup)
                                <span class="online-dot"></span>
                            @endif
                        </div>
                        <div class="chat-head-info">
                            <div class="chat-head-name">{{ $chatName }}</div>
                            <div class="chat-head-role">
                                @if (!$chatIsGroup)
                                    <span class="dot-online"></span>
                                @endif
                                {{ $chatRole }}
                            </div>
                        </div>
                        <div class="chat-head-acts">
                            <button class="ch-btn" title="Info">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                                </svg>
                            </button>
                            <button class="ch-btn" title="Search in chat">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="7" />
                                    <path d="M17 17l3 3" />
                                </svg>
                            </button>
                            <button class="ch-btn" title="More">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="5" cy="12" r="1" />
                                    <circle cx="12" cy="12" r="1" />
                                    <circle cx="19" cy="12" r="1" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="chat-body" id="chatBody">
                        @php $prevDate = null; @endphp

                        @forelse($conversation->messages as $msg)
                            @php
                                $isMe = $msg->sender_id == $authId;
                                $mDate = $msg->created_at->format('M d, Y');
                                $mTime = $msg->created_at->format('g:i A');
                                $sName = $msg->sender?->name ?? 'Unknown';
                                $sInit = strtoupper(substr($sName, 0, 2));
                                $sAdmin = $msg->sender?->role === 'admin';
                            @endphp

                            @if ($mDate !== $prevDate)
                                <div class="chat-date"><span>{{ $mDate }}</span></div>
                                @php $prevDate = $mDate; @endphp
                            @endif

                            <div class="brow {{ $isMe ? 'me' : '' }}">
                                @if (!$isMe)
                                    <div class="bava {{ $sAdmin ? 'is-admin' : '' }}">{{ $sInit }}</div>
                                @endif
                                <div class="bblock">
                                    @if (!$isMe)
                                        <div class="bsender">{{ $sName }}</div>
                                    @endif

                                    @if (!empty($msg->file))
                                        <div class="bubble-img">
                                            <img src="{{ asset('storage/' . $msg->file) }}" alt="attachment"
                                                onclick="openLightbox('{{ asset('storage/' . $msg->file) }}')">
                                        </div>
                                    @endif

                                    @if (!empty($msg->message))
                                        <div class="bubble {{ $isMe ? 'me' : 'them' }}">{{ $msg->message }}</div>
                                    @endif

                                    <div class="btime">{{ $mTime }}</div>
                                </div>
                            </div>
                        @empty
                            <div
                                style="flex:1;display:flex;align-items:center;justify-content:center;font-size:.78rem;color:var(--mist);">
                                No messages yet — say hello! 👋
                            </div>
                        @endforelse
                    </div>

                    <div class="chat-foot">

                        {{-- Emoji picker --}}
                        <div class="emoji-picker" id="emojiPicker">
                            <div class="ep-tabs" id="epTabs">
                                <button class="ep-tab active" data-cat="smileys" onclick="epSetCat(this)">😀</button>
                                <button class="ep-tab" data-cat="people" onclick="epSetCat(this)">👋</button>
                                <button class="ep-tab" data-cat="animals" onclick="epSetCat(this)">🐶</button>
                                <button class="ep-tab" data-cat="food" onclick="epSetCat(this)">🍎</button>
                                <button class="ep-tab" data-cat="travel" onclick="epSetCat(this)">✈️</button>
                                <button class="ep-tab" data-cat="activities" onclick="epSetCat(this)">⚽</button>
                                <button class="ep-tab" data-cat="objects" onclick="epSetCat(this)">💡</button>
                                <button class="ep-tab" data-cat="symbols" onclick="epSetCat(this)">❤️</button>
                            </div>
                            <div class="ep-search">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="7" />
                                    <path d="M17 17l3 3" />
                                </svg>
                                <input type="text" id="epSearch" placeholder="Search emoji…" autocomplete="off"
                                    oninput="epSearch(this.value)">
                            </div>
                            <div class="ep-grid" id="epGrid"></div>
                        </div>

                        {{-- File preview --}}
                        <div class="file-preview-bar" id="filePreviewBar">
                            <img class="fp-thumb" id="fpThumb" src="" alt="">
                            <div>
                                <div class="fp-name" id="fpName"></div>
                                <div class="fp-size" id="fpSize"></div>
                            </div>
                            <button type="button" class="fp-remove" onclick="clearFile()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <line x1="18" y1="6" x2="6" y2="18" />
                                    <line x1="6" y1="6" x2="18" y2="18" />
                                </svg>
                            </button>
                        </div>

                        {{-- Input row --}}
                        <div class="chat-input-wrap">
                            <form action="{{ route('messages.send') }}" method="POST" id="chatForm"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                                <div class="chat-input-row">
                                    <button type="button" class="chat-attach-btn" title="Attach">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.8">
                                            <path
                                                d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48" />
                                        </svg>
                                        <input type="file" name="file" id="fileInput"
                                            accept="image/*,application/pdf,.doc,.docx"
                                            onchange="previewFile(this)">
                                    </button>

                                    <textarea name="message" id="chatTa" class="chat-ta" placeholder="Type a message…" rows="1"></textarea>

                                    <div class="chat-foot-btns">
                                        <button type="button" class="chat-emoji-btn" id="emojiToggleBtn"
                                            title="Emoji" onclick="toggleEmojiPicker(event)">😊</button>
                                        <button type="submit" class="chat-send-btn" title="Send">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <line x1="22" y1="2" x2="11"
                                                    y2="13" />
                                                <polygon points="22 2 15 22 11 13 2 9 22 2" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="chat-welcome">
                        <div class="cw-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.4">
                                <path d="M4 4h16a2 2 0 012 2v8a2 2 0 01-2 2H7l-5 4V6a2 2 0 012-2z" />
                            </svg>
                        </div>
                        <div class="cw-title">Select a convers<em>ation</em></div>
                        <div class="cw-sub">Tap any admin, supplier, or existing chat<br>on the left to open it here.
                        </div>
                    </div>
                @endif

            </section>
        </div>

        {{-- Lightbox --}}
        <div class="lb-overlay" id="lbOverlay" onclick="closeLightbox()">
            <button class="lb-close" onclick="closeLightbox()">✕</button>
            <img id="lbImg" src="" alt="Preview">
        </div>

        <script>
            /* ── Auto-scroll ── */
            const chatBody = document.getElementById('chatBody');
            if (chatBody) chatBody.scrollTop = chatBody.scrollHeight;

            /* ── Textarea resize + Enter send ── */
            const ta = document.getElementById('chatTa');
            if (ta) {
                ta.addEventListener('keydown', e => {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        document.getElementById('chatForm').submit();
                    }
                });
                ta.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = Math.min(this.scrollHeight, 96) + 'px';
                });
            }

            /* ── File preview ── */
            function previewFile(input) {
                const file = input.files[0];
                if (!file) return;
                const bar = document.getElementById('filePreviewBar');
                const thumb = document.getElementById('fpThumb');
                const name = document.getElementById('fpName');
                const size = document.getElementById('fpSize');
                name.textContent = file.name;
                size.textContent = (file.size / 1024).toFixed(1) + ' KB';
                if (file.type.startsWith('image/')) {
                    const r = new FileReader();
                    r.onload = e => {
                        thumb.src = e.target.result;
                        thumb.style.display = '';
                    };
                    r.readAsDataURL(file);
                } else {
                    thumb.style.display = 'none';
                }
                bar.classList.add('show');
            }

            function clearFile() {
                document.getElementById('fileInput').value = '';
                document.getElementById('filePreviewBar').classList.remove('show');
                document.getElementById('fpThumb').src = '';
            }

            /* ── Lightbox ── */
            function openLightbox(src) {
                document.getElementById('lbImg').src = src;
                document.getElementById('lbOverlay').classList.add('open');
            }

            function closeLightbox() {
                document.getElementById('lbOverlay').classList.remove('open');
            }

            /* ── Sidebar search ── */
            document.getElementById('sbSearch').addEventListener('input', function() {
                const q = this.value.toLowerCase();
                document.querySelectorAll('.sb-item[data-name]').forEach(el => {
                    el.style.display = el.dataset.name.includes(q) ? '' : 'none';
                });
            });

            /* ── Filter tabs ── */
            let activeFilter = 'all';

            function setTab(btn) {
                document.querySelectorAll('.sb-tab').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                activeFilter = btn.dataset.filter;
                applyFilter();
            }

            function applyFilter() {
                const items = document.querySelectorAll('.sb-item[data-section="chats"]');
                const suppDiv = document.querySelector('[data-section="suppliers-div"]');
                const suppLbl = document.querySelector('[data-section="suppliers"]');
                const suppItms = document.querySelectorAll('.sb-item[data-section="suppliers"]');
                const suppEmp = document.querySelector('.sb-empty[data-section="suppliers"]');
                const supAdm = document.querySelectorAll('.sb-item[data-section="support"]');
                const supLbl = document.querySelector('[data-section="support"]');
                const chatDiv = document.querySelector('[data-section="chats-div"]');
                const chatLbl = document.querySelector('[data-section="chats"]');

                if (activeFilter === 'all') {
                    document.querySelectorAll('.sb-item, .sb-group-label, .sb-divider, .sb-empty').forEach(el => el.style
                        .display = '');
                    return;
                }

                /* Unread / Groups — hide support and suppliers, only show matching chats */
                supAdm.forEach(el => el.style.display = 'none');
                if (supLbl) supLbl.style.display = 'none';
                if (suppDiv) suppDiv.style.display = 'none';
                if (suppLbl) suppLbl.style.display = 'none';
                suppItms.forEach(el => el.style.display = 'none');
                if (suppEmp) suppEmp.style.display = 'none';
                if (chatDiv) chatDiv.style.display = 'none';
                if (chatLbl) chatLbl.style.display = 'none';

                items.forEach(el => {
                    if (activeFilter === 'unread') el.style.display = el.dataset.isUnread === '1' ? '' : 'none';
                    if (activeFilter === 'groups') el.style.display = el.dataset.isGroup === '1' ? '' : 'none';
                });
            }

            /* ── Mobile: mark body when a conversation link is tapped ── */
            document.querySelectorAll('.sb-item').forEach(item => {
                item.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        document.body.classList.add('mob-chat-open');
                    }
                });
            });

            /* ── Mobile back button: return to conversation list ── */
            const mobBack = document.getElementById('mobBackBtn');
            if (mobBack) {
                mobBack.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        document.body.classList.remove('mob-chat-open');
                        /* Link navigates to messages.inbox without conversation_id */
                    }
                });
            }

            /* ── Resize guard ── */
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    document.body.classList.remove('mob-chat-open');
                }
            });

            /* ════════════════════════════════════════════
               EMOJI PICKER
            ════════════════════════════════════════════ */
            const EMOJI_DATA = {
                smileys: ['😀', '😁', '😂', '🤣', '😃', '😄', '😅', '😆', '😇', '😉', '😊', '🙂', '🙃', '😋', '😌', '😍',
                    '🥰', '😘', '😗', '😙', '😚', '😜', '🤪', '😝', '😛', '🤑', '🤗', '🤭', '🤫', '🤔', '🤐', '🤨',
                    '😐', '😑', '😶', '😏', '😒', '🙄', '😬', '🤥', '😔', '😪', '🤤', '😴', '😷', '🤒', '🤕', '🤢',
                    '🤧', '🥵', '🥶', '🥴', '😵', '🤯', '🤠', '🥳', '😎', '🤓', '🧐', '😕', '😟', '🙁', '☹️', '😮',
                    '😯', '😲', '😳', '🥺', '😦', '😧', '😨', '😰', '😥', '😢', '😭', '😱', '😖', '😣', '😞', '😓',
                    '😩', '😫', '🥱', '😤', '😡', '😠', '🤬', '😈', '👿'
                ],
                people: ['👋', '🤚', '🖐', '✋', '🖖', '👌', '🤌', '🤏', '✌️', '🤞', '🤟', '🤘', '🤙', '👈', '👉', '👆',
                    '👇', '☝️', '👍', '👎', '✊', '👊', '🤛', '🤜', '👏', '🙌', '👐', '🤲', '🤝', '🙏', '✍️', '💅', '💪',
                    '🦵', '🦶', '👶', '🧒', '👦', '👧', '🧑', '👱', '👨', '🧔', '👩', '🧓', '👴', '👵', '🙍', '🙎',
                    '🙅', '🙆', '💁', '🙋', '🧏', '🙇', '🤦', '🤷', '👮', '👷', '🤴', '👸', '🧙', '🧚', '🧛', '🧜',
                    '🧝', '🧞', '🧟', '💆', '💇', '🚶', '🏃', '💃', '🕺'
                ],
                animals: ['🐶', '🐱', '🐭', '🐹', '🐰', '🦊', '🐻', '🐼', '🐨', '🐯', '🦁', '🐮', '🐷', '🐸', '🐵', '🙈',
                    '🙉', '🙊', '🐔', '🐧', '🐦', '🦆', '🦅', '🦉', '🦇', '🐺', '🐗', '🐴', '🦄', '🐝', '🐛', '🦋',
                    '🐌', '🐞', '🐜', '🦟', '🦗', '🦂', '🐢', '🐍', '🦎', '🐙', '🦑', '🦐', '🦀', '🐡', '🐠', '🐟',
                    '🐬', '🐳', '🐋', '🦈', '🐊', '🐅', '🐆', '🦓', '🐘', '🦏', '🦛', '🐪', '🐫', '🦒', '🦘', '🐃',
                    '🐂', '🐄', '🐎', '🐖', '🐏', '🐑', '🦙', '🐐', '🦌', '🐕', '🐩', '🐈', '🐓', '🦃', '🦚', '🦜',
                    '🦢', '🦩', '🕊', '🐇', '🦝', '🦨', '🦡', '🦦', '🦥', '🐁', '🐀', '🐿', '🦔'
                ],
                food: ['🍎', '🍐', '🍊', '🍋', '🍌', '🍉', '🍇', '🍓', '🫐', '🍈', '🍒', '🍑', '🥭', '🍍', '🥥', '🥝', '🍅',
                    '🍆', '🥑', '🥦', '🥬', '🥒', '🌶', '🧄', '🧅', '🥔', '🍠', '🌰', '🥜', '🍞', '🥐', '🥖', '🥨',
                    '🥯', '🧀', '🥚', '🍳', '🧈', '🥞', '🧇', '🥓', '🥩', '🍗', '🍖', '🌭', '🍔', '🍟', '🍕', '🌮',
                    '🌯', '🥙', '🧆', '🍝', '🍜', '🍲', '🍛', '🍣', '🍱', '🥟', '🍤', '🍙', '🍚', '🍘', '🍥', '🍢',
                    '🧁', '🍰', '🎂', '🍮', '🍭', '🍬', '🍫', '🍿', '🍩', '🍪', '🍯', '🧃', '🥤', '🧋', '🍵', '☕', '🍶',
                    '🍺', '🍻', '🥂', '🍷', '🥃', '🍸', '🍹', '🧉', '🍾'
                ],
                travel: ['✈️', '🛫', '🛬', '🚀', '🛸', '🚁', '🚗', '🚕', '🚙', '🚌', '🏎', '🚓', '🚑', '🚒', '🚐', '🚚',
                    '🚛', '🚜', '🛵', '🏍', '🚲', '🛴', '🛹', '⛵', '🚤', '🛥', '🛳', '⛴', '🚢', '🛩', '🚂', '🚃', '🚄',
                    '🚅', '🚆', '🚇', '🚈', '🚉', '🚊', '🚝', '🚞', '🚋', '🏗', '🌁', '🏘', '🏠', '🏡', '🏢', '🏣',
                    '🏥', '🏦', '🏨', '🏪', '🏫', '🏬', '🏭', '🏯', '🏰', '💒', '🗼', '🗽', '⛪', '🕌', '🛕', '🕍', '⛩',
                    '🕋', '⛲', '⛺', '🏕', '🌄', '🌅', '🌠', '🌌', '🌉', '🌃', '🏙', '🌆', '🌇', '🗺', '🧭', '🌋', '🏔',
                    '⛰', '🏞'
                ],
                activities: ['⚽', '🏀', '🏈', '⚾', '🥎', '🎾', '🏐', '🏉', '🥏', '🎱', '🏓', '🏸', '🏒', '🏑', '🥍', '🏏',
                    '🥅', '⛳', '🎣', '🤿', '🎽', '🎿', '🛷', '🥌', '🪀', '🪆', '🎯', '🎮', '🕹', '🎰', '🃏', '🀄', '🎲',
                    '🎭', '🎨', '🖼', '🎪', '🎤', '🎧', '🎼', '🎵', '🎶', '🎷', '🪗', '🎸', '🎹', '🎺', '🎻', '🥁',
                    '🪘', '🎬', '🎥', '📽', '🎞', '📷', '📸', '🔭', '🔬', '🎠', '🎡', '🎢', '🎪'
                ],
                objects: ['💡', '🔦', '🕯', '🔑', '🗝', '🔐', '🔒', '🔓', '🔨', '⛏', '⚒', '🛠', '⚔️', '🛡', '🔫', '🧲',
                    '🪜', '🧪', '🧫', '🧬', '💊', '💉', '🩹', '🩺', '🩻', '👓', '🕶', '🥽', '🌂', '🧵', '🧶', '👔',
                    '👕', '👖', '🧣', '🧤', '🧥', '🧦', '👗', '👘', '🥻', '👙', '👚', '👛', '👜', '👝', '🎒', '🧳',
                    '👒', '🎩', '🧢', '💄', '💍', '💎', '📱', '💻', '⌨️', '🖥', '🖨', '🖱', '💾', '💿', '📀', '📷',
                    '📸', '📹', '📼', '📞', '☎️', '📺', '📻', '🧭', '⏰', '⌚', '📡', '🔋', '🔌'
                ],
                symbols: ['❤️', '🧡', '💛', '💚', '💙', '💜', '🖤', '🤍', '🤎', '💔', '❤️‍🔥', '❤️‍🩹', '💕', '💞', '💓',
                    '💗', '💖', '💘', '💝', '💟', '☮️', '✝️', '☪️', '🕉', '☸️', '✡️', '☯️', '☦️', '⛎', '♈', '♉', '♊',
                    '♋', '♌', '♍', '♎', '♏', '♐', '♑', '♒', '♓', '🆔', '☢️', '☣️', '📴', '📳', '🈶', '🈚', '🈸', '🈺',
                    '🈷️', '✴️', '🆚', '✅', '☑️', '✔️', '❎', '➕', '➖', '➗', '✖️', '♾', '💲', '💱', '‼️', '⁉️', '❓', '❔',
                    '❕', '❗', '〰️', '➰', '➿', '🔚', '🔙', '🔛', '🔝', '🔜', '⏩', '⏪', '⏫', '⏬', '⏭', '⏮', '🔀', '🔁',
                    '🔂', '▶️', '⏸', '⏹', '⏺', '🎦', '🔅', '🔆', '📶', '🔇', '🔈', '🔉', '🔊', '📢', '📣', '🔔', '🔕',
                    '💯', '⬛', '⬜', '🟥', '🟧', '🟨', '🟩', '🟦', '🟪', '🟫'
                ]
            };

            let epCurrentCat = 'smileys';
            let epPickerOpen = false;

            function epRender(emojis) {
                const grid = document.getElementById('epGrid');
                grid.innerHTML = '';
                if (!emojis || emojis.length === 0) {
                    grid.innerHTML = '<div class="ep-empty">No emoji found</div>';
                    return;
                }
                emojis.forEach(function(em) {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'ep-em';
                    btn.textContent = em;
                    btn.title = em;
                    btn.addEventListener('click', function() {
                        insertEmoji(em);
                    });
                    grid.appendChild(btn);
                });
            }

            function insertEmoji(em) {
                const ta = document.getElementById('chatTa');
                if (!ta) return;
                const start = ta.selectionStart,
                    end = ta.selectionEnd;
                ta.value = ta.value.slice(0, start) + em + ta.value.slice(end);
                ta.selectionStart = ta.selectionEnd = start + em.length;
                ta.focus();
                ta.style.height = 'auto';
                ta.style.height = Math.min(ta.scrollHeight, 96) + 'px';
            }

            function epSetCat(btn) {
                document.querySelectorAll('.ep-tab').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                epCurrentCat = btn.dataset.cat;
                document.getElementById('epSearch').value = '';
                epRender(EMOJI_DATA[epCurrentCat] || []);
            }

            function epSearch(q) {
                if (!q.trim()) {
                    epRender(EMOJI_DATA[epCurrentCat] || []);
                    return;
                }
                const all = Object.values(EMOJI_DATA).flat();
                const results = all.filter(e => e.includes(q));
                epRender(results.length ? results : all.filter(e => e.toLowerCase().includes(q.toLowerCase())));
            }

            function toggleEmojiPicker(e) {
                e.stopPropagation();
                epPickerOpen = !epPickerOpen;
                const picker = document.getElementById('emojiPicker');
                const btn = document.getElementById('emojiToggleBtn');
                if (epPickerOpen) {
                    picker.classList.add('open');
                    btn.classList.add('picker-open');
                    epRender(EMOJI_DATA[epCurrentCat] || []);
                    setTimeout(function() {
                        document.getElementById('epSearch').focus();
                    }, 80);
                } else {
                    picker.classList.remove('open');
                    btn.classList.remove('picker-open');
                }
            }

            document.addEventListener('click', function(e) {
                const picker = document.getElementById('emojiPicker');
                const btn = document.getElementById('emojiToggleBtn');
                if (!picker) return;
                if (!picker.contains(e.target) && btn && !btn.contains(e.target)) {
                    picker.classList.remove('open');
                    if (btn) btn.classList.remove('picker-open');
                    epPickerOpen = false;
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const picker = document.getElementById('emojiPicker');
                    const btn = document.getElementById('emojiToggleBtn');
                    if (picker) picker.classList.remove('open');
                    if (btn) btn.classList.remove('picker-open');
                    epPickerOpen = false;
                }
            });

            const pickerEl = document.getElementById('emojiPicker');
            if (pickerEl) {
                pickerEl.addEventListener('click', e => e.stopPropagation());
            }
        </script>

    </x-client-layout>
@endif
