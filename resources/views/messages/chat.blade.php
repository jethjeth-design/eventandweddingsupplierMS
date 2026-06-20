<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap');

    .chatroom * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .chatroom {
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

    /* ══════════════════════════════
            TOP BAR
            ══════════════════════════════ */
    .cr-topbar {
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

    .cr-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 14px;
        border-radius: 9px;
        background: var(--stone);
        border: 1px solid var(--border);
        font-family: 'Outfit', sans-serif;
        font-size: 0.74rem;
        font-weight: 500;
        color: var(--mist);
        text-decoration: none;
        transition: all .18s;
        flex-shrink: 0;
    }

    .cr-back-btn:hover {
        border-color: var(--gold);
        color: var(--gold);
        background: var(--gold-dim);
    }

    .cr-back-btn svg {
        width: 14px;
        height: 14px;
    }

    .cr-topbar-ava {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Cormorant Garamond', serif;
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--white);
        border: 2px solid var(--gold-border);
        flex-shrink: 0;
        position: relative;
    }

    .cr-topbar-ava.is-admin {
        background: linear-gradient(135deg, var(--ink) 0%, #3D3530 100%);
        border-color: rgba(184, 146, 74, 0.3);
    }

    .cr-topbar-ava.is-group {
        background: linear-gradient(135deg, var(--purple) 0%, #3D3060 100%);
        border-color: rgba(92, 75, 138, 0.3);
    }

    .cr-topbar-ava .cr-dot-live {
        position: absolute;
        bottom: 1px;
        right: 1px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--success);
        border: 2px solid var(--white);
    }

    .cr-topbar-info {
        flex: 1;
        min-width: 0;
    }

    .cr-topbar-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--ink);
        line-height: 1.1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .cr-topbar-sub {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.63rem;
        color: var(--mist);
        margin-top: 2px;
    }

    .cr-type-badge {
        display: inline-flex;
        align-items: center;
        padding: 2px 8px;
        border-radius: 999px;
        font-size: 0.55rem;
        font-weight: 700;
        letter-spacing: 0.07em;
        text-transform: uppercase;
    }

    .cr-type-badge.admin {
        background: rgba(20, 17, 14, 0.08);
        color: var(--ink);
    }

    .cr-type-badge.client {
        background: var(--gold-dim);
        color: var(--gold);
        border: 1px solid var(--gold-border);
    }

    .cr-type-badge.supplier {
        background: var(--gold-dim);
        color: var(--gold);
        border: 1px solid var(--gold-border);
    }

    .cr-type-badge.group {
        background: rgba(92, 75, 138, 0.12);
        color: var(--purple);
        border: 1px solid rgba(92, 75, 138, 0.2);
    }

    .cr-topbar-acts {
        display: flex;
        gap: 0.35rem;
        flex-shrink: 0;
    }

    .cr-act-btn {
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

    .cr-act-btn:hover {
        border-color: var(--gold);
        color: var(--gold);
        background: var(--gold-dim);
    }

    .cr-act-btn svg {
        width: 14px;
        height: 14px;
    }

    /* ══════════════════════════════
            GROUP INFO PANEL
            ══════════════════════════════ */
    .cr-group-info {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 1rem 1.25rem;
        box-shadow: 0 2px 14px rgba(20, 17, 14, .04);
    }

    .cr-gi-head {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 0.8rem;
    }

    .cr-gi-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: linear-gradient(135deg, var(--purple) 0%, #3D3060 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .cr-gi-icon svg {
        width: 15px;
        height: 15px;
        color: #fff;
    }

    .cr-gi-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1rem;
        font-weight: 700;
        color: var(--ink);
    }

    .cr-gi-title em {
        font-style: italic;
        color: var(--gold);
    }

    .cr-plabel {
        font-size: 0.55rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--mist-light);
        margin-bottom: 0.5rem;
    }

    .cr-participants {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
    }

    .cr-participant {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px 4px 5px;
        border-radius: 999px;
        background: var(--stone);
        border: 1px solid var(--border);
        font-size: 0.68rem;
        color: var(--ink);
        font-weight: 500;
        transition: border-color .15s;
    }

    .cr-participant:hover {
        border-color: var(--gold);
    }

    .cr-p-ava {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Cormorant Garamond', serif;
        font-size: 0.52rem;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
    }

    .cr-p-ava.is-supplier {
        background: linear-gradient(135deg, var(--purple) 0%, #3D3060 100%);
    }

    .cr-p-ava.is-admin {
        background: linear-gradient(135deg, var(--ink) 0%, #3D3530 100%);
    }

    .cr-p-sub {
        font-size: 0.57rem;
        color: var(--mist);
    }

    /* ══════════════════════════════
            CHAT PANEL
            ══════════════════════════════ */
    .cr-panel {
        flex: 1;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        box-shadow: 0 2px 14px rgba(20, 17, 14, .05);
        min-height: 0;
    }

    /* Messages scroll area */
    .cr-messages {
        flex: 1;
        overflow-y: auto;
        padding: 1.5rem 1.25rem;
        display: flex;
        flex-direction: column;
        gap: 0.55rem;
        background: var(--stone);
        scrollbar-width: thin;
        scrollbar-color: var(--border) transparent;
    }

    .cr-messages::-webkit-scrollbar {
        width: 3px;
    }

    .cr-messages::-webkit-scrollbar-thumb {
        background: var(--border);
        border-radius: 99px;
    }

    /* Date chip */
    .cr-date-sep {
        text-align: center;
        position: relative;
        margin: 0.5rem 0;
        font-size: 0.61rem;
        color: var(--mist-light);
    }

    .cr-date-sep span {
        background: var(--stone-2);
        padding: 3px 12px;
        border-radius: 999px;
        border: 1px solid var(--border);
        position: relative;
        z-index: 1;
    }

    .cr-date-sep::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: var(--border);
    }

    /* Message rows */
    .cr-row {
        display: flex;
        align-items: flex-end;
        gap: 0.48rem;
    }

    .cr-row.me {
        flex-direction: row-reverse;
    }

    .cr-ava {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Cormorant Garamond', serif;
        font-size: 0.66rem;
        font-weight: 700;
        color: var(--white);
        border: 1.5px solid rgba(184, 146, 74, 0.18);
        background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
    }

    .cr-ava.is-admin {
        background: linear-gradient(135deg, var(--ink) 0%, #3D3530 100%);
    }

    .cr-ava.is-supplier {
        background: linear-gradient(135deg, var(--purple) 0%, #3D3060 100%);
    }

    .cr-block {
        display: flex;
        flex-direction: column;
        max-width: 62%;
        gap: 3px;
    }

    .cr-row.me .cr-block {
        align-items: flex-end;
    }

    .cr-sender {
        font-size: 0.6rem;
        font-weight: 600;
        color: var(--mist);
        padding: 0 4px;
        letter-spacing: 0.01em;
    }

    .cr-sender .cr-biz {
        color: var(--gold);
    }

    .cr-bubble {
        padding: 0.62rem 0.95rem;
        border-radius: 16px;
        font-size: 0.8rem;
        line-height: 1.6;
        word-break: break-word;
    }

    .cr-bubble.them {
        background: var(--white);
        color: var(--ink);
        border: 1px solid var(--border);
        border-bottom-left-radius: 4px;
        box-shadow: 0 1px 4px rgba(20, 17, 14, .04);
    }

    .cr-bubble.me {
        background: var(--ink);
        color: var(--gold-pale);
        border-bottom-right-radius: 4px;
    }

    /* Image attachment */
    .cr-img {
        max-width: 240px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border);
        cursor: pointer;
        margin-top: 2px;
        transition: transform .15s, box-shadow .15s;
    }

    .cr-img:hover {
        transform: scale(1.015);
        box-shadow: 0 4px 16px rgba(20, 17, 14, .1);
    }

    .cr-img img {
        width: 100%;
        display: block;
    }

    .cr-meta {
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 0 4px;
    }

    .cr-time {
        font-size: 0.56rem;
        color: var(--mist-light);
    }

    .cr-check svg {
        width: 11px;
        height: 11px;
        opacity: .45;
    }

    /* Empty */
    .cr-empty {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.65rem;
        padding: 3rem;
    }

    .cr-empty-icon {
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

    .cr-empty-icon svg {
        width: 26px;
        height: 26px;
    }

    .cr-empty-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--ink);
    }

    .cr-empty-title em {
        font-style: italic;
        color: var(--gold);
    }

    .cr-empty-sub {
        font-size: 0.72rem;
        color: var(--mist);
        text-align: center;
        line-height: 1.65;
    }

    @keyframes crIn {
        from {
            opacity: 0;
            transform: translateY(6px);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    .cr-row {
        animation: crIn .16s ease both;
    }

    /* ══════════════════════════════
            FOOTER / INPUT
            ══════════════════════════════ */
    .cr-foot {
        background: var(--white);
        border-top: 1px solid var(--border);
        flex-shrink: 0;
        position: relative;
    }

    .cr-file-bar {
        display: none;
        align-items: center;
        gap: 0.6rem;
        padding: 0.6rem 1.25rem;
        background: var(--gold-dim);
        border-bottom: 1px solid var(--gold-border);
    }

    .cr-file-bar.show {
        display: flex;
    }

    .cr-file-thumb {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid var(--gold-border);
        flex-shrink: 0;
    }

    .cr-file-name {
        flex: 1;
        font-size: 0.74rem;
        color: var(--ink);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .cr-file-size {
        font-size: 0.64rem;
        color: var(--mist);
        flex-shrink: 0;
    }

    .cr-file-rm {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: rgba(20, 17, 14, 0.08);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--ink);
        flex-shrink: 0;
        transition: background .15s;
    }

    .cr-file-rm:hover {
        background: rgba(192, 57, 43, 0.15);
        color: var(--danger);
    }

    .cr-file-rm svg {
        width: 12px;
        height: 12px;
    }

    .cr-input-wrap {
        padding: 0.85rem 1.25rem;
    }

    .cr-input-row {
        display: flex;
        align-items: flex-end;
        gap: 0.5rem;
        background: var(--stone);
        border: 1.5px solid var(--border);
        border-radius: 14px;
        padding: 0.5rem 0.65rem 0.5rem 1rem;
        transition: border-color .2s, box-shadow .2s;
    }

    .cr-input-row:focus-within {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(184, 146, 74, 0.08);
    }

    .cr-attach-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        background: transparent;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--mist-light);
        cursor: pointer;
        transition: color .15s;
        position: relative;
    }

    .cr-attach-btn:hover {
        color: var(--gold);
    }

    .cr-attach-btn svg {
        width: 17px;
        height: 17px;
    }

    .cr-attach-btn input[type=file] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .cr-ta {
        flex: 1;
        border: none;
        outline: none;
        background: transparent;
        font-family: 'Outfit', sans-serif;
        font-size: 0.81rem;
        color: var(--ink);
        resize: none;
        line-height: 1.5;
        max-height: 100px;
        min-height: 22px;
    }

    .cr-ta::placeholder {
        color: var(--mist-light);
    }

    .cr-btns {
        display: flex;
        align-items: center;
        gap: 4px;
        flex-shrink: 0;
        position: relative;
    }

    .cr-emoji-btn {
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
        flex-shrink: 0;
        transition: all .18s;
    }

    .cr-emoji-btn:hover {
        border-color: var(--gold);
        background: var(--gold-dim);
        transform: scale(1.08);
    }

    .cr-emoji-btn.active {
        border-color: var(--gold);
        background: var(--gold-dim);
        box-shadow: 0 0 0 3px rgba(184, 146, 74, 0.12);
    }

    .cr-send-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: var(--ink);
        border: none;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gold-light);
        cursor: pointer;
        transition: all .18s;
    }

    .cr-send-btn:hover {
        background: var(--gold);
        color: var(--white);
        transform: scale(1.06);
    }

    .cr-send-btn svg {
        width: 14px;
        height: 14px;
    }

    /* ══════════════════════════════
            EMOJI PICKER
            ══════════════════════════════ */
    .cr-ep {
        display: none;
        position: absolute;
        bottom: calc(100% + 10px);
        right: 0;
        width: 290px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 0.75rem;
        box-shadow: 0 12px 40px rgba(20, 17, 14, .16);
        z-index: 50;
    }

    .cr-ep.open {
        display: block;
        animation: epIn .15s ease;
    }

    @keyframes epIn {
        from {
            opacity: 0;
            transform: translateY(8px) scale(.97);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    .ep-hdr {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--border);
    }

    .ep-hdr-t {
        font-family: 'Cormorant Garamond', serif;
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--ink);
    }

    .ep-hdr-t em {
        font-style: italic;
        color: var(--gold);
    }

    .ep-x {
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
        font-size: 13px;
        transition: all .12s;
    }

    .ep-x:hover {
        background: var(--stone-2);
        color: var(--ink);
    }

    .ep-srch {
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

    .ep-srch:focus-within {
        border-color: var(--gold);
    }

    .ep-srch svg {
        width: 11px;
        height: 11px;
        color: var(--mist-light);
        flex-shrink: 0;
    }

    .ep-srch input {
        border: none;
        outline: none;
        background: transparent;
        font-family: 'Outfit', sans-serif;
        font-size: 0.72rem;
        color: var(--ink);
        width: 100%;
    }

    .ep-srch input::placeholder {
        color: var(--mist-light);
    }

    .ep-cats {
        display: flex;
        gap: 3px;
        margin-bottom: 0.45rem;
    }

    .ep-cat {
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

    .ep-cat:hover {
        border-color: var(--gold);
        background: var(--gold-dim);
    }

    .ep-cat.on {
        border-color: var(--gold);
        background: var(--gold-dim);
        box-shadow: 0 0 0 2px rgba(184, 146, 74, 0.14);
    }

    .ep-grid {
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        gap: 2px;
        max-height: 180px;
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
        font-size: 19px;
        cursor: pointer;
        padding: 4px 3px;
        border-radius: 7px;
        text-align: center;
        transition: background .11s, transform .11s;
        line-height: 1;
    }

    .ep-em:hover {
        background: var(--stone-2);
        transform: scale(1.18);
    }

    /* ══════════════════════════════
            LIGHTBOX
            ══════════════════════════════ */
    .cr-lb {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(20, 17, 14, .9);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    .cr-lb.open {
        display: flex;
    }

    .cr-lb img {
        max-width: 90vw;
        max-height: 88vh;
        border-radius: 12px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .4);
    }

    .cr-lb-x {
        position: absolute;
        top: 1rem;
        right: 1rem;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .12);
        border: 1px solid rgba(255, 255, 255, .18);
        color: #fff;
        font-size: 18px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .15s;
    }

    .cr-lb-x:hover {
        background: rgba(255, 255, 255, .22);
    }

    /* ══════════════════════════════
            RESPONSIVE
            ══════════════════════════════ */
    @media (max-width: 600px) {
        .chatroom {
            padding: 0.5rem;
            gap: 0.65rem;
        }

        .cr-topbar {
            padding: 0.65rem 0.85rem;
        }

        .cr-topbar-acts .cr-act-btn:last-child {
            display: none;
        }

        .cr-messages {
            padding: 1rem 0.75rem;
        }

        .cr-block {
            max-width: 80%;
        }

        .cr-input-wrap {
            padding: 0.6rem 0.75rem;
        }

        .cr-ep {
            width: calc(100vw - 1.5rem);
            right: auto;
            left: 0;
        }

        .cr-group-info {
            padding: 0.85rem 0.9rem;
        }
    }
</style>
@if (auth()->user()->isAdmin())
    <x-app-layout>

        @php
            $authId = auth()->id();
            $isGroup = $conversation->type === 'group';

            if ($isGroup) {
                $chatTitle = $conversation->title ?? 'Group Chat';
                $chatSubtitle = 'group';
                $chatInit = strtoupper(substr($chatTitle, 0, 2));
            } else {
                $otherUser = $conversation->participants->where('user_id', '!=', $authId)->first()?->user;
                $chatTitle = $otherUser?->name ?? 'Chat Room';
                $chatInit = strtoupper(substr($chatTitle, 0, 2));

                if ($otherUser?->role === 'admin') {
                    $chatSubtitle = 'admin';
                } elseif ($otherUser?->role === 'client') {
                    $chatSubtitle = 'client';
                } elseif ($otherUser?->supplierProfile) {
                    $chatSubtitle = 'supplier';
                } else {
                    $chatSubtitle = 'user';
                }
            }
        @endphp

        <div class="chatroom">

            {{-- ══ TOP BAR ══ --}}
            <div class="cr-topbar">

                <a href="{{ route('messages.inbox') }}" class="cr-back-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2.2">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                    Back
                </a>

                <div class="cr-topbar-ava {{ $isGroup ? 'is-group' : ($chatSubtitle === 'admin' ? 'is-admin' : '') }}">
                    {{ $chatInit }}
                    @if (!$isGroup)
                        <span class="cr-dot-live"></span>
                    @endif
                </div>

                <div class="cr-topbar-info">
                    <div class="cr-topbar-name">{{ $chatTitle }}</div>
                    <div class="cr-topbar-sub">
                        @if (!$isGroup)
                            <span
                                style="width:6px;height:6px;border-radius:50%;background:var(--success);display:inline-block;"></span>
                        @endif
                        <span class="cr-type-badge {{ $isGroup ? 'group' : $chatSubtitle }}">
                            @if ($isGroup)
                                Group · {{ $conversation->participants->count() }} members
                            @elseif($chatSubtitle === 'admin')
                                Admin Support
                            @elseif($chatSubtitle === 'supplier' && isset($otherUser))
                                {{ $otherUser->supplierProfile->business_name }} · Supplier
                            @else
                                {{ ucfirst($chatSubtitle) }}
                            @endif
                        </span>
                    </div>
                </div>

                <div class="cr-topbar-acts">
                    <button class="cr-act-btn" title="Search in chat">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="11" cy="11" r="7" />
                            <path d="M17 17l3 3" />
                        </svg>
                    </button>
                    <button class="cr-act-btn" title="Info">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                    </button>
                    <button class="cr-act-btn" title="More options">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="5" cy="12" r="1" />
                            <circle cx="12" cy="12" r="1" />
                            <circle cx="19" cy="12" r="1" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- ══ GROUP INFO ══ --}}
            @if ($isGroup)
                <div class="cr-group-info">
                    <div class="cr-gi-head">
                        <div class="cr-gi-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                            </svg>
                        </div>
                        <div class="cr-gi-title">{{ $conversation->title ?? 'Group' }} <em>Chat</em></div>
                    </div>
                    <div class="cr-plabel">Participants</div>
                    <div class="cr-participants">
                        @foreach ($conversation->participants as $p)
                            @php
                                $pn = $p->user?->name ?? 'Member';
                                $pb = optional($p->user->supplier)->business_name;
                                $pi = strtoupper(substr($pn, 0, 2));
                                $pad = $p->user?->role === 'admin';
                                $psp = (bool) $pb;
                            @endphp
                            <div class="cr-participant">
                                <div class="cr-p-ava {{ $pad ? 'is-admin' : ($psp ? 'is-supplier' : '') }}">
                                    {{ $pi }}</div>
                                <div>
                                    <div>{{ $pn }}</div>
                                    @if ($pb)
                                        <div class="cr-p-sub">{{ $pb }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- ══ CHAT PANEL ══ --}}
            <div class="cr-panel">

                <div class="cr-messages" id="crMessages">

                    @forelse($conversation->messages as $msg)
                        @php
                            $isMe = $msg->sender_id == $authId;
                            $sName = $msg->sender?->name ?? 'Unknown';
                            $sBiz = optional($msg->sender?->supplier)->business_name;
                            $sInit = strtoupper(substr($sName, 0, 2));
                            $sIsAdmin = $msg->sender?->role === 'admin';
                            $sIsSup = (bool) $sBiz;
                            $mDate = $msg->created_at->format('M d, Y');
                            $mTime = $msg->created_at->format('g:i A');
                            $prevDate = isset($prevDate) ? $prevDate : null;
                        @endphp

                        @if ($mDate !== $prevDate)
                            <div class="cr-date-sep"><span>{{ $mDate }}</span></div>
                            @php $prevDate = $mDate; @endphp
                        @endif

                        <div class="cr-row {{ $isMe ? 'me' : '' }}">
                            @if (!$isMe)
                                <div class="cr-ava {{ $sIsAdmin ? 'is-admin' : ($sIsSup ? 'is-supplier' : '') }}">
                                    {{ $sInit }}</div>
                            @endif

                            <div class="cr-block">
                                @if (!$isMe)
                                    <div class="cr-sender">
                                        {{ $sName }}
                                        @if ($sBiz)
                                            <span class="cr-biz">· {{ $sBiz }}</span>
                                        @endif
                                    </div>
                                @endif

                                @if (!empty($msg->file))
                                    <div class="cr-img" onclick="crLbOpen('{{ asset('storage/' . $msg->file) }}')">
                                        <img src="{{ asset('storage/' . $msg->file) }}" alt="attachment">
                                    </div>
                                @endif

                                @if (!empty($msg->message))
                                    <div class="cr-bubble {{ $isMe ? 'me' : 'them' }}">{{ $msg->message }}</div>
                                @endif

                                <div class="cr-meta">
                                    <span class="cr-time">{{ $mTime }}</span>
                                    @if ($isMe)
                                        <span class="cr-check">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2.5">
                                                <path d="M5 12l5 5L20 7" />
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="cr-empty">
                            <div class="cr-empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.4">
                                    <path d="M4 4h16a2 2 0 012 2v8a2 2 0 01-2 2H7l-5 4V6a2 2 0 012-2z" />
                                </svg>
                            </div>
                            <div class="cr-empty-title">No messages <em>yet</em></div>
                            <div class="cr-empty-sub">Start the conversation — say hello! 👋</div>
                        </div>
                    @endforelse

                </div>

                {{-- ══ FOOTER ══ --}}
                <div class="cr-foot">

                    {{-- Emoji picker --}}
                    <div class="cr-ep" id="crEp">
                        <div class="ep-hdr">
                            <div class="ep-hdr-t">Em<em>oji</em></div>
                            <button type="button" class="ep-x" onclick="crEpClose()">✕</button>
                        </div>
                        <div class="ep-srch">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="7" />
                                <path d="M17 17l3 3" />
                            </svg>
                            <input type="text" id="crEpSrch" placeholder="Search emoji…" autocomplete="off"
                                oninput="crEpSearch(this.value)">
                        </div>
                        <div class="ep-cats">
                            <button class="ep-cat on" data-cat="smileys" onclick="crEpCat(this)">😀</button>
                            <button class="ep-cat" data-cat="gestures" onclick="crEpCat(this)">👍</button>
                            <button class="ep-cat" data-cat="hearts" onclick="crEpCat(this)">❤️</button>
                            <button class="ep-cat" data-cat="nature" onclick="crEpCat(this)">🌸</button>
                            <button class="ep-cat" data-cat="food" onclick="crEpCat(this)">🍕</button>
                            <button class="ep-cat" data-cat="travel" onclick="crEpCat(this)">✈️</button>
                            <button class="ep-cat" data-cat="objects" onclick="crEpCat(this)">💡</button>
                            <button class="ep-cat" data-cat="symbols" onclick="crEpCat(this)">🎉</button>
                        </div>
                        <div class="ep-grid" id="crEpGrid"></div>
                    </div>

                    {{-- File preview bar --}}
                    <div class="cr-file-bar" id="crFileBar">
                        <img class="cr-file-thumb" id="crFileThumb" src="" alt="">
                        <div>
                            <div class="cr-file-name" id="crFileName"></div>
                            <div class="cr-file-size" id="crFileSize"></div>
                        </div>
                        <button type="button" class="cr-file-rm" onclick="crFileClear()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                        </button>
                    </div>

                    {{-- Input --}}
                    <div class="cr-input-wrap">
                        <form action="{{ route('messages.send') }}" method="POST" id="crForm"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                            <div class="cr-input-row">

                                <button type="button" class="cr-attach-btn" title="Attach image">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.8">
                                        <path
                                            d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48" />
                                    </svg>
                                    <input type="file" name="file" id="crFileInput" accept="image/*"
                                        onchange="crFilePreview(this)">
                                </button>

                                <textarea name="message" id="crTa" class="cr-ta" placeholder="Type a message…" rows="1"></textarea>

                                <div class="cr-btns">
                                    <button type="button" class="cr-emoji-btn" id="crEmojiBtn"
                                        onclick="crEpToggle(event)" title="Emoji">😊</button>
                                    <button type="submit" class="cr-send-btn" title="Send">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <line x1="22" y1="2" x2="11" y2="13" />
                                            <polygon points="22 2 15 22 11 13 2 9 22 2" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        {{-- Lightbox --}}
        <div class="cr-lb" id="crLb" onclick="crLbClose()">
            <button class="cr-lb-x" onclick="crLbClose()">✕</button>
            <img id="crLbImg" src="" alt="Preview">
        </div>

    </x-app-layout>
@elseif(auth()->user()->isSupplier())
    {{-- resources/views/messages/supplier-chatbox.blade.php --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Outfit:wght@300;400;500;600&display=swap');

        .chatroom * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .chatroom {
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

        /* ══════════════════════════════
            TOP BAR
            ══════════════════════════════ */
        .cr-topbar {
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

        .cr-back-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 14px;
            border-radius: 9px;
            background: var(--stone);
            border: 1px solid var(--border);
            font-family: 'Outfit', sans-serif;
            font-size: 0.74rem;
            font-weight: 500;
            color: var(--mist);
            text-decoration: none;
            transition: all .18s;
            flex-shrink: 0;
        }

        .cr-back-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: var(--gold-dim);
        }

        .cr-back-btn svg {
            width: 14px;
            height: 14px;
        }

        .cr-topbar-ava {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--white);
            border: 2px solid var(--gold-border);
            flex-shrink: 0;
            position: relative;
        }

        .cr-topbar-ava.is-admin {
            background: linear-gradient(135deg, var(--ink) 0%, #3D3530 100%);
            border-color: rgba(184, 146, 74, 0.3);
        }

        .cr-topbar-ava.is-group {
            background: linear-gradient(135deg, var(--purple) 0%, #3D3060 100%);
            border-color: rgba(92, 75, 138, 0.3);
        }

        .cr-topbar-ava .cr-dot-live {
            position: absolute;
            bottom: 1px;
            right: 1px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--success);
            border: 2px solid var(--white);
        }

        .cr-topbar-info {
            flex: 1;
            min-width: 0;
        }

        .cr-topbar-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cr-topbar-sub {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.63rem;
            color: var(--mist);
            margin-top: 2px;
        }

        .cr-type-badge {
            display: inline-flex;
            align-items: center;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 0.55rem;
            font-weight: 700;
            letter-spacing: 0.07em;
            text-transform: uppercase;
        }

        .cr-type-badge.admin {
            background: rgba(20, 17, 14, 0.08);
            color: var(--ink);
        }

        .cr-type-badge.client {
            background: var(--gold-dim);
            color: var(--gold);
            border: 1px solid var(--gold-border);
        }

        .cr-type-badge.supplier {
            background: var(--gold-dim);
            color: var(--gold);
            border: 1px solid var(--gold-border);
        }

        .cr-type-badge.group {
            background: rgba(92, 75, 138, 0.12);
            color: var(--purple);
            border: 1px solid rgba(92, 75, 138, 0.2);
        }

        .cr-topbar-acts {
            display: flex;
            gap: 0.35rem;
            flex-shrink: 0;
        }

        .cr-act-btn {
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

        .cr-act-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: var(--gold-dim);
        }

        .cr-act-btn svg {
            width: 14px;
            height: 14px;
        }

        /* ══════════════════════════════
            GROUP INFO PANEL
            ══════════════════════════════ */
        .cr-group-info {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1rem 1.25rem;
            box-shadow: 0 2px 14px rgba(20, 17, 14, .04);
        }

        .cr-gi-head {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 0.8rem;
        }

        .cr-gi-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--purple) 0%, #3D3060 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .cr-gi-icon svg {
            width: 15px;
            height: 15px;
            color: #fff;
        }

        .cr-gi-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--ink);
        }

        .cr-gi-title em {
            font-style: italic;
            color: var(--gold);
        }

        .cr-plabel {
            font-size: 0.55rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--mist-light);
            margin-bottom: 0.5rem;
        }

        .cr-participants {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
        }

        .cr-participant {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px 4px 5px;
            border-radius: 999px;
            background: var(--stone);
            border: 1px solid var(--border);
            font-size: 0.68rem;
            color: var(--ink);
            font-weight: 500;
            transition: border-color .15s;
        }

        .cr-participant:hover {
            border-color: var(--gold);
        }

        .cr-p-ava {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.52rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .cr-p-ava.is-supplier {
            background: linear-gradient(135deg, var(--purple) 0%, #3D3060 100%);
        }

        .cr-p-ava.is-admin {
            background: linear-gradient(135deg, var(--ink) 0%, #3D3530 100%);
        }

        .cr-p-sub {
            font-size: 0.57rem;
            color: var(--mist);
        }

        /* ══════════════════════════════
            CHAT PANEL
            ══════════════════════════════ */
        .cr-panel {
            flex: 1;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 2px 14px rgba(20, 17, 14, .05);
            min-height: 0;
        }

        /* Messages scroll area */
        .cr-messages {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 0.55rem;
            background: var(--stone);
            scrollbar-width: thin;
            scrollbar-color: var(--border) transparent;
        }

        .cr-messages::-webkit-scrollbar {
            width: 3px;
        }

        .cr-messages::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 99px;
        }

        /* Date chip */
        .cr-date-sep {
            text-align: center;
            position: relative;
            margin: 0.5rem 0;
            font-size: 0.61rem;
            color: var(--mist-light);
        }

        .cr-date-sep span {
            background: var(--stone-2);
            padding: 3px 12px;
            border-radius: 999px;
            border: 1px solid var(--border);
            position: relative;
            z-index: 1;
        }

        .cr-date-sep::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--border);
        }

        /* Message rows */
        .cr-row {
            display: flex;
            align-items: flex-end;
            gap: 0.48rem;
        }

        .cr-row.me {
            flex-direction: row-reverse;
        }

        .cr-ava {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.66rem;
            font-weight: 700;
            color: var(--white);
            border: 1.5px solid rgba(184, 146, 74, 0.18);
            background: linear-gradient(135deg, var(--gold) 0%, #7A5C25 100%);
        }

        .cr-ava.is-admin {
            background: linear-gradient(135deg, var(--ink) 0%, #3D3530 100%);
        }

        .cr-ava.is-supplier {
            background: linear-gradient(135deg, var(--purple) 0%, #3D3060 100%);
        }

        .cr-block {
            display: flex;
            flex-direction: column;
            max-width: 62%;
            gap: 3px;
        }

        .cr-row.me .cr-block {
            align-items: flex-end;
        }

        .cr-sender {
            font-size: 0.6rem;
            font-weight: 600;
            color: var(--mist);
            padding: 0 4px;
            letter-spacing: 0.01em;
        }

        .cr-sender .cr-biz {
            color: var(--gold);
        }

        .cr-bubble {
            padding: 0.62rem 0.95rem;
            border-radius: 16px;
            font-size: 0.8rem;
            line-height: 1.6;
            word-break: break-word;
        }

        .cr-bubble.them {
            background: var(--white);
            color: var(--ink);
            border: 1px solid var(--border);
            border-bottom-left-radius: 4px;
            box-shadow: 0 1px 4px rgba(20, 17, 14, .04);
        }

        .cr-bubble.me {
            background: var(--ink);
            color: var(--gold-pale);
            border-bottom-right-radius: 4px;
        }

        /* Image attachment */
        .cr-img {
            max-width: 240px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border);
            cursor: pointer;
            margin-top: 2px;
            transition: transform .15s, box-shadow .15s;
        }

        .cr-img:hover {
            transform: scale(1.015);
            box-shadow: 0 4px 16px rgba(20, 17, 14, .1);
        }

        .cr-img img {
            width: 100%;
            display: block;
        }

        .cr-meta {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 0 4px;
        }

        .cr-time {
            font-size: 0.56rem;
            color: var(--mist-light);
        }

        .cr-check svg {
            width: 11px;
            height: 11px;
            opacity: .45;
        }

        /* Empty */
        .cr-empty {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.65rem;
            padding: 3rem;
        }

        .cr-empty-icon {
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

        .cr-empty-icon svg {
            width: 26px;
            height: 26px;
        }

        .cr-empty-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--ink);
        }

        .cr-empty-title em {
            font-style: italic;
            color: var(--gold);
        }

        .cr-empty-sub {
            font-size: 0.72rem;
            color: var(--mist);
            text-align: center;
            line-height: 1.65;
        }

        @keyframes crIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .cr-row {
            animation: crIn .16s ease both;
        }

        /* ══════════════════════════════
            FOOTER / INPUT
            ══════════════════════════════ */
        .cr-foot {
            background: var(--white);
            border-top: 1px solid var(--border);
            flex-shrink: 0;
            position: relative;
        }

        .cr-file-bar {
            display: none;
            align-items: center;
            gap: 0.6rem;
            padding: 0.6rem 1.25rem;
            background: var(--gold-dim);
            border-bottom: 1px solid var(--gold-border);
        }

        .cr-file-bar.show {
            display: flex;
        }

        .cr-file-thumb {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--gold-border);
            flex-shrink: 0;
        }

        .cr-file-name {
            flex: 1;
            font-size: 0.74rem;
            color: var(--ink);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cr-file-size {
            font-size: 0.64rem;
            color: var(--mist);
            flex-shrink: 0;
        }

        .cr-file-rm {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: rgba(20, 17, 14, 0.08);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--ink);
            flex-shrink: 0;
            transition: background .15s;
        }

        .cr-file-rm:hover {
            background: rgba(192, 57, 43, 0.15);
            color: var(--danger);
        }

        .cr-file-rm svg {
            width: 12px;
            height: 12px;
        }

        .cr-input-wrap {
            padding: 0.85rem 1.25rem;
        }

        .cr-input-row {
            display: flex;
            align-items: flex-end;
            gap: 0.5rem;
            background: var(--stone);
            border: 1.5px solid var(--border);
            border-radius: 14px;
            padding: 0.5rem 0.65rem 0.5rem 1rem;
            transition: border-color .2s, box-shadow .2s;
        }

        .cr-input-row:focus-within {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(184, 146, 74, 0.08);
        }

        .cr-attach-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            background: transparent;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--mist-light);
            cursor: pointer;
            transition: color .15s;
            position: relative;
        }

        .cr-attach-btn:hover {
            color: var(--gold);
        }

        .cr-attach-btn svg {
            width: 17px;
            height: 17px;
        }

        .cr-attach-btn input[type=file] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .cr-ta {
            flex: 1;
            border: none;
            outline: none;
            background: transparent;
            font-family: 'Outfit', sans-serif;
            font-size: 0.81rem;
            color: var(--ink);
            resize: none;
            line-height: 1.5;
            max-height: 100px;
            min-height: 22px;
        }

        .cr-ta::placeholder {
            color: var(--mist-light);
        }

        .cr-btns {
            display: flex;
            align-items: center;
            gap: 4px;
            flex-shrink: 0;
            position: relative;
        }

        .cr-emoji-btn {
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
            flex-shrink: 0;
            transition: all .18s;
        }

        .cr-emoji-btn:hover {
            border-color: var(--gold);
            background: var(--gold-dim);
            transform: scale(1.08);
        }

        .cr-emoji-btn.active {
            border-color: var(--gold);
            background: var(--gold-dim);
            box-shadow: 0 0 0 3px rgba(184, 146, 74, 0.12);
        }

        .cr-send-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--ink);
            border: none;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-light);
            cursor: pointer;
            transition: all .18s;
        }

        .cr-send-btn:hover {
            background: var(--gold);
            color: var(--white);
            transform: scale(1.06);
        }

        .cr-send-btn svg {
            width: 14px;
            height: 14px;
        }

        /* ══════════════════════════════
            EMOJI PICKER
            ══════════════════════════════ */
        .cr-ep {
            display: none;
            position: absolute;
            bottom: calc(100% + 10px);
            right: 0;
            width: 290px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 0.75rem;
            box-shadow: 0 12px 40px rgba(20, 17, 14, .16);
            z-index: 50;
        }

        .cr-ep.open {
            display: block;
            animation: epIn .15s ease;
        }

        @keyframes epIn {
            from {
                opacity: 0;
                transform: translateY(8px) scale(.97);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .ep-hdr {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border);
        }

        .ep-hdr-t {
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--ink);
        }

        .ep-hdr-t em {
            font-style: italic;
            color: var(--gold);
        }

        .ep-x {
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
            font-size: 13px;
            transition: all .12s;
        }

        .ep-x:hover {
            background: var(--stone-2);
            color: var(--ink);
        }

        .ep-srch {
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

        .ep-srch:focus-within {
            border-color: var(--gold);
        }

        .ep-srch svg {
            width: 11px;
            height: 11px;
            color: var(--mist-light);
            flex-shrink: 0;
        }

        .ep-srch input {
            border: none;
            outline: none;
            background: transparent;
            font-family: 'Outfit', sans-serif;
            font-size: 0.72rem;
            color: var(--ink);
            width: 100%;
        }

        .ep-srch input::placeholder {
            color: var(--mist-light);
        }

        .ep-cats {
            display: flex;
            gap: 3px;
            margin-bottom: 0.45rem;
        }

        .ep-cat {
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

        .ep-cat:hover {
            border-color: var(--gold);
            background: var(--gold-dim);
        }

        .ep-cat.on {
            border-color: var(--gold);
            background: var(--gold-dim);
            box-shadow: 0 0 0 2px rgba(184, 146, 74, 0.14);
        }

        .ep-grid {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 2px;
            max-height: 180px;
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
            font-size: 19px;
            cursor: pointer;
            padding: 4px 3px;
            border-radius: 7px;
            text-align: center;
            transition: background .11s, transform .11s;
            line-height: 1;
        }

        .ep-em:hover {
            background: var(--stone-2);
            transform: scale(1.18);
        }

        /* ══════════════════════════════
            LIGHTBOX
            ══════════════════════════════ */
        .cr-lb {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(20, 17, 14, .9);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .cr-lb.open {
            display: flex;
        }

        .cr-lb img {
            max-width: 90vw;
            max-height: 88vh;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .4);
        }

        .cr-lb-x {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .18);
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .15s;
        }

        .cr-lb-x:hover {
            background: rgba(255, 255, 255, .22);
        }

        /* ══════════════════════════════
            RESPONSIVE
            ══════════════════════════════ */
        @media (max-width: 600px) {
            .chatroom {
                padding: 0.5rem;
                gap: 0.65rem;
            }

            .cr-topbar {
                padding: 0.65rem 0.85rem;
            }

            .cr-topbar-acts .cr-act-btn:last-child {
                display: none;
            }

            .cr-messages {
                padding: 1rem 0.75rem;
            }

            .cr-block {
                max-width: 80%;
            }

            .cr-input-wrap {
                padding: 0.6rem 0.75rem;
            }

            .cr-ep {
                width: calc(100vw - 1.5rem);
                right: auto;
                left: 0;
            }

            .cr-group-info {
                padding: 0.85rem 0.9rem;
            }
        }
    </style>
    <x-supplier-layout>



        @php
            $authId = auth()->id();
            $isGroup = $conversation->type === 'group';

            if ($isGroup) {
                $chatTitle = $conversation->title ?? 'Group Chat';
                $chatSubtitle = 'group';
                $chatInit = strtoupper(substr($chatTitle, 0, 2));
            } else {
                $otherUser = $conversation->participants->where('user_id', '!=', $authId)->first()?->user;
                $chatTitle = $otherUser?->name ?? 'Chat Room';
                $chatInit = strtoupper(substr($chatTitle, 0, 2));

                if ($otherUser?->role === 'admin') {
                    $chatSubtitle = 'admin';
                } elseif ($otherUser?->role === 'client') {
                    $chatSubtitle = 'client';
                } elseif ($otherUser?->supplierProfile) {
                    $chatSubtitle = 'supplier';
                } else {
                    $chatSubtitle = 'user';
                }
            }
        @endphp

        <div class="chatroom">

            {{-- ══ TOP BAR ══ --}}
            <div class="cr-topbar">

                <a href="{{ route('messages.inbox') }}" class="cr-back-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2.2">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                    Back
                </a>

                <div
                    class="cr-topbar-ava {{ $isGroup ? 'is-group' : ($chatSubtitle === 'admin' ? 'is-admin' : '') }}">
                    {{ $chatInit }}
                    @if (!$isGroup)
                        <span class="cr-dot-live"></span>
                    @endif
                </div>

                <div class="cr-topbar-info">
                    <div class="cr-topbar-name">{{ $chatTitle }}</div>
                    <div class="cr-topbar-sub">
                        @if (!$isGroup)
                            <span
                                style="width:6px;height:6px;border-radius:50%;background:var(--success);display:inline-block;"></span>
                        @endif
                        <span class="cr-type-badge {{ $isGroup ? 'group' : $chatSubtitle }}">
                            @if ($isGroup)
                                Group · {{ $conversation->participants->count() }} members
                            @elseif($chatSubtitle === 'admin')
                                Admin Support
                            @elseif($chatSubtitle === 'supplier' && isset($otherUser))
                                {{ $otherUser->supplierProfile->business_name }} · Supplier
                            @else
                                {{ ucfirst($chatSubtitle) }}
                            @endif
                        </span>
                    </div>
                </div>

                <div class="cr-topbar-acts">
                    <button class="cr-act-btn" title="Search in chat">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="7" />
                            <path d="M17 17l3 3" />
                        </svg>
                    </button>
                    <button class="cr-act-btn" title="Info">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                    </button>
                    <button class="cr-act-btn" title="More options">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <circle cx="5" cy="12" r="1" />
                            <circle cx="12" cy="12" r="1" />
                            <circle cx="19" cy="12" r="1" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- ══ GROUP INFO ══ --}}
            @if ($isGroup)
                <div class="cr-group-info">
                    <div class="cr-gi-head">
                        <div class="cr-gi-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                            </svg>
                        </div>
                        <div class="cr-gi-title">{{ $conversation->title ?? 'Group' }} <em>Chat</em></div>
                    </div>
                    <div class="cr-plabel">Participants</div>
                    <div class="cr-participants">
                        @foreach ($conversation->participants as $p)
                            @php
                                $pn = $p->user?->name ?? 'Member';
                                $pb = optional($p->user->supplier)->business_name;
                                $pi = strtoupper(substr($pn, 0, 2));
                                $pad = $p->user?->role === 'admin';
                                $psp = (bool) $pb;
                            @endphp
                            <div class="cr-participant">
                                <div class="cr-p-ava {{ $pad ? 'is-admin' : ($psp ? 'is-supplier' : '') }}">
                                    {{ $pi }}</div>
                                <div>
                                    <div>{{ $pn }}</div>
                                    @if ($pb)
                                        <div class="cr-p-sub">{{ $pb }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- ══ CHAT PANEL ══ --}}
            <div class="cr-panel">

                <div class="cr-messages" id="crMessages">

                    @forelse($conversation->messages as $msg)
                        @php
                            $isMe = $msg->sender_id == $authId;
                            $sName = $msg->sender?->name ?? 'Unknown';
                            $sBiz = optional($msg->sender?->supplier)->business_name;
                            $sInit = strtoupper(substr($sName, 0, 2));
                            $sIsAdmin = $msg->sender?->role === 'admin';
                            $sIsSup = (bool) $sBiz;
                            $mDate = $msg->created_at->format('M d, Y');
                            $mTime = $msg->created_at->format('g:i A');
                            $prevDate = isset($prevDate) ? $prevDate : null;
                        @endphp

                        @if ($mDate !== $prevDate)
                            <div class="cr-date-sep"><span>{{ $mDate }}</span></div>
                            @php $prevDate = $mDate; @endphp
                        @endif

                        <div class="cr-row {{ $isMe ? 'me' : '' }}">
                            @if (!$isMe)
                                <div class="cr-ava {{ $sIsAdmin ? 'is-admin' : ($sIsSup ? 'is-supplier' : '') }}">
                                    {{ $sInit }}</div>
                            @endif

                            <div class="cr-block">
                                @if (!$isMe)
                                    <div class="cr-sender">
                                        {{ $sName }}
                                        @if ($sBiz)
                                            <span class="cr-biz">· {{ $sBiz }}</span>
                                        @endif
                                    </div>
                                @endif

                                @if (!empty($msg->file))
                                    <div class="cr-img" onclick="crLbOpen('{{ asset('storage/' . $msg->file) }}')">
                                        <img src="{{ asset('storage/' . $msg->file) }}" alt="attachment">
                                    </div>
                                @endif

                                @if (!empty($msg->message))
                                    <div class="cr-bubble {{ $isMe ? 'me' : 'them' }}">{{ $msg->message }}</div>
                                @endif

                                <div class="cr-meta">
                                    <span class="cr-time">{{ $mTime }}</span>
                                    @if ($isMe)
                                        <span class="cr-check">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path d="M5 12l5 5L20 7" />
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="cr-empty">
                            <div class="cr-empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.4">
                                    <path d="M4 4h16a2 2 0 012 2v8a2 2 0 01-2 2H7l-5 4V6a2 2 0 012-2z" />
                                </svg>
                            </div>
                            <div class="cr-empty-title">No messages <em>yet</em></div>
                            <div class="cr-empty-sub">Start the conversation — say hello! 👋</div>
                        </div>
                    @endforelse

                </div>

                {{-- ══ FOOTER ══ --}}
                <div class="cr-foot">

                    {{-- Emoji picker --}}
                    <div class="cr-ep" id="crEp">
                        <div class="ep-hdr">
                            <div class="ep-hdr-t">Em<em>oji</em></div>
                            <button type="button" class="ep-x" onclick="crEpClose()">✕</button>
                        </div>
                        <div class="ep-srch">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="7" />
                                <path d="M17 17l3 3" />
                            </svg>
                            <input type="text" id="crEpSrch" placeholder="Search emoji…" autocomplete="off"
                                oninput="crEpSearch(this.value)">
                        </div>
                        <div class="ep-cats">
                            <button class="ep-cat on" data-cat="smileys" onclick="crEpCat(this)">😀</button>
                            <button class="ep-cat" data-cat="gestures" onclick="crEpCat(this)">👍</button>
                            <button class="ep-cat" data-cat="hearts" onclick="crEpCat(this)">❤️</button>
                            <button class="ep-cat" data-cat="nature" onclick="crEpCat(this)">🌸</button>
                            <button class="ep-cat" data-cat="food" onclick="crEpCat(this)">🍕</button>
                            <button class="ep-cat" data-cat="travel" onclick="crEpCat(this)">✈️</button>
                            <button class="ep-cat" data-cat="objects" onclick="crEpCat(this)">💡</button>
                            <button class="ep-cat" data-cat="symbols" onclick="crEpCat(this)">🎉</button>
                        </div>
                        <div class="ep-grid" id="crEpGrid"></div>
                    </div>

                    {{-- File preview bar --}}
                    <div class="cr-file-bar" id="crFileBar">
                        <img class="cr-file-thumb" id="crFileThumb" src="" alt="">
                        <div>
                            <div class="cr-file-name" id="crFileName"></div>
                            <div class="cr-file-size" id="crFileSize"></div>
                        </div>
                        <button type="button" class="cr-file-rm" onclick="crFileClear()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                        </button>
                    </div>

                    {{-- Input --}}
                    <div class="cr-input-wrap">
                        <form action="{{ route('messages.send') }}" method="POST" id="crForm"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                            <div class="cr-input-row">

                                <button type="button" class="cr-attach-btn" title="Attach image">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.8">
                                        <path
                                            d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48" />
                                    </svg>
                                    <input type="file" name="file" id="crFileInput" accept="image/*"
                                        onchange="crFilePreview(this)">
                                </button>

                                <textarea name="message" id="crTa" class="cr-ta" placeholder="Type a message…" rows="1"></textarea>

                                <div class="cr-btns">
                                    <button type="button" class="cr-emoji-btn" id="crEmojiBtn"
                                        onclick="crEpToggle(event)" title="Emoji">😊</button>
                                    <button type="submit" class="cr-send-btn" title="Send">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <line x1="22" y1="2" x2="11" y2="13" />
                                            <polygon points="22 2 15 22 11 13 2 9 22 2" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        {{-- Lightbox --}}
        <div class="cr-lb" id="crLb" onclick="crLbClose()">
            <button class="cr-lb-x" onclick="crLbClose()">✕</button>
            <img id="crLbImg" src="" alt="Preview">
        </div>



    </x-supplier-layout>

    <script>
        /* ── Auto-scroll ── */
        const crMsgs = document.getElementById('crMessages');
        if (crMsgs) crMsgs.scrollTop = crMsgs.scrollHeight;

        /* ── Textarea resize + Enter to send ── */
        const crTa = document.getElementById('crTa');
        if (crTa) {
            crTa.addEventListener('keydown', e => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    document.getElementById('crForm').submit();
                }
            });
            crTa.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 100) + 'px';
            });
        }

        /* ── File preview ── */
        function crFilePreview(input) {
            const file = input.files[0];
            if (!file) return;
            document.getElementById('crFileName').textContent = file.name;
            document.getElementById('crFileSize').textContent = (file.size / 1024).toFixed(1) + ' KB';
            const thumb = document.getElementById('crFileThumb');
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
            document.getElementById('crFileBar').classList.add('show');
        }

        function crFileClear() {
            document.getElementById('crFileInput').value = '';
            document.getElementById('crFileBar').classList.remove('show');
            document.getElementById('crFileThumb').src = '';
        }

        /* ── Lightbox ── */
        function crLbOpen(src) {
            document.getElementById('crLbImg').src = src;
            document.getElementById('crLb').classList.add('open');
        }

        function crLbClose() {
            document.getElementById('crLb').classList.remove('open');
        }

        /* ══ EMOJI PICKER ══ */
        const CR_EP_DATA = {
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
                '🍛', '🍚', '🍙', '🍘', '🍥', '🧁', '🎂'
            ],
            travel: ['✈️', '🚀', '🛸', '🚁', '🛩️', '🚂', '🚃', '🚄', '🚅', '🚇', '🚌', '🚗', '🚕', '🚙', '🛻', '🚚',
                '🚛', '🚜', '🏎️', '🏍️', '🛵', '🚲', '🛴', '🛹', '⛵', '🚤', '🛥️', '🛳', '🚢', '⛽', '🗺', '🧭',
                '🏔', '⛰', '🌋', '🏞', '🌅', '🌄', '🌃', '🏙'
            ],
            objects: ['💡', '🔦', '🕯️', '🖥️', '💻', '⌨️', '🖱️', '📱', '📲', '☎️', '📞', '📟', '📠', '📺', '📻', '⏰',
                '⌚', '📷', '📸', '📹', '🎥', '📡', '🔭', '🔬', '💊', '🩺', '🔧', '🔨', '⚙️', '🔑', '🗝️', '🔐',
                '🔒', '🔓', '💰', '💳', '💸', '📦', '🎒', '🧳'
            ],
            symbols: ['🎉', '🎊', '🎈', '🎀', '🎁', '🏆', '🥇', '🥈', '🥉', '🎯', '🎮', '🎲', '♟️', '🎭', '🎨', '🎬',
                '🎤', '🎧', '🎵', '🎶', '🎼', '🎹', '🥁', '🎷', '🎺', '🎸', '🪕', '🎻', '🔔', '🔕', '💯', '✅', '❌',
                '❓', '❗', '💲', '💱', '‼️', '⁉️', '♾'
            ]
        };
        let crEpCur = 'smileys';

        function crEpRender(arr) {
            const g = document.getElementById('crEpGrid');
            g.innerHTML = '';
            (arr || []).forEach(e => {
                const s = document.createElement('span');
                s.className = 'ep-em';
                s.textContent = e;
                s.onclick = () => crEpInsert(e);
                g.appendChild(s);
            });
        }

        function crEpInsert(e) {
            const ta = document.getElementById('crTa');
            if (!ta) return;
            const s = ta.selectionStart,
                en = ta.selectionEnd;
            ta.value = ta.value.slice(0, s) + e + ta.value.slice(en);
            ta.selectionStart = ta.selectionEnd = s + [...e].length;
            ta.focus();
            ta.dispatchEvent(new Event('input'));
        }

        function crEpCat(btn) {
            document.querySelectorAll('.ep-cat').forEach(b => b.classList.remove('on'));
            btn.classList.add('on');
            crEpCur = btn.dataset.cat;
            document.getElementById('crEpSrch').value = '';
            crEpRender(CR_EP_DATA[crEpCur]);
        }

        function crEpSearch(q) {
            if (!q.trim()) {
                crEpRender(CR_EP_DATA[crEpCur]);
                return;
            }
            const all = Object.values(CR_EP_DATA).flat();
            crEpRender(all.filter(e => e.includes(q) || e.toLowerCase().includes(q.toLowerCase())));
        }

        function crEpToggle(e) {
            e.stopPropagation();
            const p = document.getElementById('crEp');
            const b = document.getElementById('crEmojiBtn');
            const open = p.classList.contains('open');
            p.classList.toggle('open');
            b.classList.toggle('active', !open);
            if (!open) {
                crEpRender(CR_EP_DATA[crEpCur]);
                document.getElementById('crEpSrch').value = '';
            }
        }

        function crEpClose() {
            document.getElementById('crEp').classList.remove('open');
            document.getElementById('crEmojiBtn').classList.remove('active');
        }
        document.addEventListener('click', e => {
            const p = document.getElementById('crEp'),
                b = document.getElementById('crEmojiBtn');
            if (p && p.classList.contains('open') && !p.contains(e.target) && e.target !== b) crEpClose();
        });
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') crEpClose();
        });
        const crEpEl = document.getElementById('crEp');
        if (crEpEl) crEpEl.addEventListener('click', e => e.stopPropagation());
    </script>
@else
    {{-- resources/views/messages/client-chatbox.blade.php --}}
    <x-client-layout>

        @php
            $authId = auth()->id();
            $isGroup = $conversation->type === 'group';

            if ($isGroup) {
                $chatTitle = $conversation->title ?? 'Group Chat';
                $chatSubtitle = 'group';
                $chatInit = strtoupper(substr($chatTitle, 0, 2));
            } else {
                $otherUser = $conversation->participants->where('user_id', '!=', $authId)->first()?->user;
                $chatTitle = $otherUser?->name ?? 'Chat Room';
                $chatInit = strtoupper(substr($chatTitle, 0, 2));

                if ($otherUser?->role === 'admin') {
                    $chatSubtitle = 'admin';
                } elseif ($otherUser?->role === 'client') {
                    $chatSubtitle = 'client';
                } elseif ($otherUser?->supplierProfile) {
                    $chatSubtitle = 'supplier';
                } else {
                    $chatSubtitle = 'user';
                }
            }
        @endphp

        <div class="chatroom">

            {{-- ══ TOP BAR ══ --}}
            <div class="cr-topbar">

                <a href="{{ route('messages.inbox') }}" class="cr-back-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2.2">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                    Back
                </a>

                <div
                    class="cr-topbar-ava {{ $isGroup ? 'is-group' : ($chatSubtitle === 'admin' ? 'is-admin' : '') }}">
                    {{ $chatInit }}
                    @if (!$isGroup)
                        <span class="cr-dot-live"></span>
                    @endif
                </div>

                <div class="cr-topbar-info">
                    <div class="cr-topbar-name">{{ $chatTitle }}</div>
                    <div class="cr-topbar-sub">
                        @if (!$isGroup)
                            <span
                                style="width:6px;height:6px;border-radius:50%;background:var(--success);display:inline-block;"></span>
                        @endif
                        <span class="cr-type-badge {{ $isGroup ? 'group' : $chatSubtitle }}">
                            @if ($isGroup)
                                Group · {{ $conversation->participants->count() }} members
                            @elseif($chatSubtitle === 'admin')
                                Admin Support
                            @elseif($chatSubtitle === 'supplier' && isset($otherUser))
                                {{ $otherUser->supplierProfile->business_name }} · Supplier
                            @else
                                {{ ucfirst($chatSubtitle) }}
                            @endif
                        </span>
                    </div>
                </div>

                <div class="cr-topbar-acts">
                    <button class="cr-act-btn" title="Search in chat">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="7" />
                            <path d="M17 17l3 3" />
                        </svg>
                    </button>
                    <button class="cr-act-btn" title="Info">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                    </button>
                    <button class="cr-act-btn" title="More options">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <circle cx="5" cy="12" r="1" />
                            <circle cx="12" cy="12" r="1" />
                            <circle cx="19" cy="12" r="1" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- ══ GROUP INFO ══ --}}
            @if ($isGroup)
                <div class="cr-group-info">
                    <div class="cr-gi-head">
                        <div class="cr-gi-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                            </svg>
                        </div>
                        <div class="cr-gi-title">{{ $conversation->title ?? 'Group' }} <em>Chat</em></div>
                    </div>
                    <div class="cr-plabel">Participants</div>
                    <div class="cr-participants">
                        @foreach ($conversation->participants as $p)
                            @php
                                $pn = $p->user?->name ?? 'Member';
                                $pb = optional($p->user->supplier)->business_name;
                                $pi = strtoupper(substr($pn, 0, 2));
                                $pad = $p->user?->role === 'admin';
                                $psp = (bool) $pb;
                            @endphp
                            <div class="cr-participant">
                                <div class="cr-p-ava {{ $pad ? 'is-admin' : ($psp ? 'is-supplier' : '') }}">
                                    {{ $pi }}</div>
                                <div>
                                    <div>{{ $pn }}</div>
                                    @if ($pb)
                                        <div class="cr-p-sub">{{ $pb }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- ══ CHAT PANEL ══ --}}
            <div class="cr-panel">

                <div class="cr-messages" id="crMessages">

                    @forelse($conversation->messages as $msg)
                        @php
                            $isMe = $msg->sender_id == $authId;
                            $sName = $msg->sender?->name ?? 'Unknown';
                            $sBiz = optional($msg->sender?->supplier)->business_name;
                            $sInit = strtoupper(substr($sName, 0, 2));
                            $sIsAdmin = $msg->sender?->role === 'admin';
                            $sIsSup = (bool) $sBiz;
                            $mDate = $msg->created_at->format('M d, Y');
                            $mTime = $msg->created_at->format('g:i A');
                            $prevDate = isset($prevDate) ? $prevDate : null;
                        @endphp

                        @if ($mDate !== $prevDate)
                            <div class="cr-date-sep"><span>{{ $mDate }}</span></div>
                            @php $prevDate = $mDate; @endphp
                        @endif

                        <div class="cr-row {{ $isMe ? 'me' : '' }}">
                            @if (!$isMe)
                                <div class="cr-ava {{ $sIsAdmin ? 'is-admin' : ($sIsSup ? 'is-supplier' : '') }}">
                                    {{ $sInit }}</div>
                            @endif

                            <div class="cr-block">
                                @if (!$isMe)
                                    <div class="cr-sender">
                                        {{ $sName }}
                                        @if ($sBiz)
                                            <span class="cr-biz">· {{ $sBiz }}</span>
                                        @endif
                                    </div>
                                @endif

                                @if (!empty($msg->file))
                                    <div class="cr-img" onclick="crLbOpen('{{ asset('storage/' . $msg->file) }}')">
                                        <img src="{{ asset('storage/' . $msg->file) }}" alt="attachment">
                                    </div>
                                @endif

                                @if (!empty($msg->message))
                                    <div class="cr-bubble {{ $isMe ? 'me' : 'them' }}">{{ $msg->message }}</div>
                                @endif

                                <div class="cr-meta">
                                    <span class="cr-time">{{ $mTime }}</span>
                                    @if ($isMe)
                                        <span class="cr-check">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path d="M5 12l5 5L20 7" />
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="cr-empty">
                            <div class="cr-empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.4">
                                    <path d="M4 4h16a2 2 0 012 2v8a2 2 0 01-2 2H7l-5 4V6a2 2 0 012-2z" />
                                </svg>
                            </div>
                            <div class="cr-empty-title">No messages <em>yet</em></div>
                            <div class="cr-empty-sub">Start the conversation — say hello! 👋</div>
                        </div>
                    @endforelse

                </div>

                {{-- ══ FOOTER ══ --}}
                <div class="cr-foot">

                    {{-- Emoji picker --}}
                    <div class="cr-ep" id="crEp">
                        <div class="ep-hdr">
                            <div class="ep-hdr-t">Em<em>oji</em></div>
                            <button type="button" class="ep-x" onclick="crEpClose()">✕</button>
                        </div>
                        <div class="ep-srch">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="7" />
                                <path d="M17 17l3 3" />
                            </svg>
                            <input type="text" id="crEpSrch" placeholder="Search emoji…" autocomplete="off"
                                oninput="crEpSearch(this.value)">
                        </div>
                        <div class="ep-cats">
                            <button class="ep-cat on" data-cat="smileys" onclick="crEpCat(this)">😀</button>
                            <button class="ep-cat" data-cat="gestures" onclick="crEpCat(this)">👍</button>
                            <button class="ep-cat" data-cat="hearts" onclick="crEpCat(this)">❤️</button>
                            <button class="ep-cat" data-cat="nature" onclick="crEpCat(this)">🌸</button>
                            <button class="ep-cat" data-cat="food" onclick="crEpCat(this)">🍕</button>
                            <button class="ep-cat" data-cat="travel" onclick="crEpCat(this)">✈️</button>
                            <button class="ep-cat" data-cat="objects" onclick="crEpCat(this)">💡</button>
                            <button class="ep-cat" data-cat="symbols" onclick="crEpCat(this)">🎉</button>
                        </div>
                        <div class="ep-grid" id="crEpGrid"></div>
                    </div>

                    {{-- File preview bar --}}
                    <div class="cr-file-bar" id="crFileBar">
                        <img class="cr-file-thumb" id="crFileThumb" src="" alt="">
                        <div>
                            <div class="cr-file-name" id="crFileName"></div>
                            <div class="cr-file-size" id="crFileSize"></div>
                        </div>
                        <button type="button" class="cr-file-rm" onclick="crFileClear()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                        </button>
                    </div>

                    {{-- Input --}}
                    <div class="cr-input-wrap">
                        <form action="{{ route('messages.send') }}" method="POST" id="crForm"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                            <div class="cr-input-row">

                                <button type="button" class="cr-attach-btn" title="Attach image">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.8">
                                        <path
                                            d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48" />
                                    </svg>
                                    <input type="file" name="file" id="crFileInput" accept="image/*"
                                        onchange="crFilePreview(this)">
                                </button>

                                <textarea name="message" id="crTa" class="cr-ta" placeholder="Type a message…" rows="1"></textarea>

                                <div class="cr-btns">
                                    <button type="button" class="cr-emoji-btn" id="crEmojiBtn"
                                        onclick="crEpToggle(event)" title="Emoji">😊</button>
                                    <button type="submit" class="cr-send-btn" title="Send">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <line x1="22" y1="2" x2="11" y2="13" />
                                            <polygon points="22 2 15 22 11 13 2 9 22 2" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        {{-- Lightbox --}}
        <div class="cr-lb" id="crLb" onclick="crLbClose()">
            <button class="cr-lb-x" onclick="crLbClose()">✕</button>
            <img id="crLbImg" src="" alt="Preview">
        </div>

    </x-client-layout>

@endif
<script>
    /* ── Auto-scroll ── */
    const crMsgs = document.getElementById('crMessages');
    if (crMsgs) crMsgs.scrollTop = crMsgs.scrollHeight;

    /* ── Textarea resize + Enter to send ── */
    const crTa = document.getElementById('crTa');
    if (crTa) {
        crTa.addEventListener('keydown', e => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                document.getElementById('crForm').submit();
            }
        });
        crTa.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 100) + 'px';
        });
    }

    /* ── File preview ── */
    function crFilePreview(input) {
        const file = input.files[0];
        if (!file) return;
        document.getElementById('crFileName').textContent = file.name;
        document.getElementById('crFileSize').textContent = (file.size / 1024).toFixed(1) + ' KB';
        const thumb = document.getElementById('crFileThumb');
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
        document.getElementById('crFileBar').classList.add('show');
    }

    function crFileClear() {
        document.getElementById('crFileInput').value = '';
        document.getElementById('crFileBar').classList.remove('show');
        document.getElementById('crFileThumb').src = '';
    }

    /* ── Lightbox ── */
    function crLbOpen(src) {
        document.getElementById('crLbImg').src = src;
        document.getElementById('crLb').classList.add('open');
    }

    function crLbClose() {
        document.getElementById('crLb').classList.remove('open');
    }

    /* ══ EMOJI PICKER ══ */
    const CR_EP_DATA = {
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
            '🍛', '🍚', '🍙', '🍘', '🍥', '🧁', '🎂'
        ],
        travel: ['✈️', '🚀', '🛸', '🚁', '🛩️', '🚂', '🚃', '🚄', '🚅', '🚇', '🚌', '🚗', '🚕', '🚙', '🛻', '🚚',
            '🚛', '🚜', '🏎️', '🏍️', '🛵', '🚲', '🛴', '🛹', '⛵', '🚤', '🛥️', '🛳', '🚢', '⛽', '🗺', '🧭',
            '🏔', '⛰', '🌋', '🏞', '🌅', '🌄', '🌃', '🏙'
        ],
        objects: ['💡', '🔦', '🕯️', '🖥️', '💻', '⌨️', '🖱️', '📱', '📲', '☎️', '📞', '📟', '📠', '📺', '📻', '⏰',
            '⌚', '📷', '📸', '📹', '🎥', '📡', '🔭', '🔬', '💊', '🩺', '🔧', '🔨', '⚙️', '🔑', '🗝️', '🔐',
            '🔒', '🔓', '💰', '💳', '💸', '📦', '🎒', '🧳'
        ],
        symbols: ['🎉', '🎊', '🎈', '🎀', '🎁', '🏆', '🥇', '🥈', '🥉', '🎯', '🎮', '🎲', '♟️', '🎭', '🎨', '🎬',
            '🎤', '🎧', '🎵', '🎶', '🎼', '🎹', '🥁', '🎷', '🎺', '🎸', '🪕', '🎻', '🔔', '🔕', '💯', '✅', '❌',
            '❓', '❗', '💲', '💱', '‼️', '⁉️', '♾'
        ]
    };
    let crEpCur = 'smileys';

    function crEpRender(arr) {
        const g = document.getElementById('crEpGrid');
        g.innerHTML = '';
        (arr || []).forEach(e => {
            const s = document.createElement('span');
            s.className = 'ep-em';
            s.textContent = e;
            s.onclick = () => crEpInsert(e);
            g.appendChild(s);
        });
    }

    function crEpInsert(e) {
        const ta = document.getElementById('crTa');
        if (!ta) return;
        const s = ta.selectionStart,
            en = ta.selectionEnd;
        ta.value = ta.value.slice(0, s) + e + ta.value.slice(en);
        ta.selectionStart = ta.selectionEnd = s + [...e].length;
        ta.focus();
        ta.dispatchEvent(new Event('input'));
    }

    function crEpCat(btn) {
        document.querySelectorAll('.ep-cat').forEach(b => b.classList.remove('on'));
        btn.classList.add('on');
        crEpCur = btn.dataset.cat;
        document.getElementById('crEpSrch').value = '';
        crEpRender(CR_EP_DATA[crEpCur]);
    }

    function crEpSearch(q) {
        if (!q.trim()) {
            crEpRender(CR_EP_DATA[crEpCur]);
            return;
        }
        const all = Object.values(CR_EP_DATA).flat();
        crEpRender(all.filter(e => e.includes(q) || e.toLowerCase().includes(q.toLowerCase())));
    }

    function crEpToggle(e) {
        e.stopPropagation();
        const p = document.getElementById('crEp');
        const b = document.getElementById('crEmojiBtn');
        const open = p.classList.contains('open');
        p.classList.toggle('open');
        b.classList.toggle('active', !open);
        if (!open) {
            crEpRender(CR_EP_DATA[crEpCur]);
            document.getElementById('crEpSrch').value = '';
        }
    }

    function crEpClose() {
        document.getElementById('crEp').classList.remove('open');
        document.getElementById('crEmojiBtn').classList.remove('active');
    }
    document.addEventListener('click', e => {
        const p = document.getElementById('crEp'),
            b = document.getElementById('crEmojiBtn');
        if (p && p.classList.contains('open') && !p.contains(e.target) && e.target !== b) crEpClose();
    });
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') crEpClose();
    });
    const crEpEl = document.getElementById('crEp');
    if (crEpEl) crEpEl.addEventListener('click', e => e.stopPropagation());
</script>
