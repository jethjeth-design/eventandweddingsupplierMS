<x-client-layout>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap');

        :root {
            --gold: #C9A84C;
            --gold-dark: #8A6A1F;
            --gold-light: rgba(201, 168, 76, 0.12);
            --ivory: #FAF7F2;
            --charcoal: #1E1B18;
            --warm-grey: #706B65;
            --border: #E5DDD5;
            --border-md: #E0D8D0;
            --white: #FFFFFF;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body: 'DM Sans', sans-serif;
            --radius-card: 14px;
            --radius-btn: 6px;
            --radius-badge: 20px;
            --shadow-card: 0 2px 16px rgba(30, 27, 24, .07);
            --shadow-hover: 0 8px 32px rgba(30, 27, 24, .14);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* ── PAGE ── */
        .rc-page {
            max-width: 1200px;
            margin: auto;
            padding: 2rem 1.5rem 4rem;
        }

        /* ── ALERTS ── */
        .rc-alert {
            display: flex;
            align-items: center;
            gap: .65rem;
            border-radius: 10px;
            padding: .8rem 1.1rem;
            font-family: var(--font-body);
            font-size: .83rem;
            margin-bottom: 1.25rem;
        }

        .rc-alert svg {
            width: 15px;
            height: 15px;
            flex-shrink: 0;
        }

        .rc-alert-ok {
            background: #F0FDF4;
            border: 1px solid #A7F3D0;
            color: #065F46;
        }

        .rc-alert-ok svg {
            color: #10B981;
        }

        .rc-alert-err {
            background: #FEF2F2;
            border: 1px solid #FCA5A5;
            color: #991B1B;
        }

        .rc-alert-err svg {
            color: #EF4444;
        }

        /* ── HERO ── */
        .rc-hero {
            background: linear-gradient(135deg, var(--charcoal) 0%, #2a2016 55%, #3d2f14 100%);
            border-radius: 18px;
            padding: 2.5rem 2.5rem 2rem;
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .rc-hero::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201, 168, 76, .18) 0%, transparent 70%);
            pointer-events: none;
        }

        .rc-hero::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: 60px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201, 168, 76, .1) 0%, transparent 70%);
            pointer-events: none;
        }

        .rc-hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .28rem .85rem;
            border-radius: 999px;
            background: rgba(201, 168, 76, .15);
            border: 1px solid rgba(201, 168, 76, .3);
            color: var(--gold);
            font-family: var(--font-body);
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .rc-hero-eyebrow::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--gold);
        }

        .rc-hero-title {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 700;
            color: var(--white);
            line-height: 1.2;
            margin-bottom: .75rem;
        }

        .rc-hero-title em {
            font-style: italic;
            color: var(--gold);
        }

        .rc-hero-sub {
            font-family: var(--font-body);
            font-size: .88rem;
            color: rgba(255, 255, 255, .65);
            line-height: 1.65;
            max-width: 560px;
        }

        .rc-hero-chips {
            display: flex;
            flex-wrap: wrap;
            gap: .55rem;
            margin-top: 1.35rem;
        }

        .rc-hero-chip {
            display: inline-flex;
            align-items: center;
            gap: .42rem;
            padding: .38rem .9rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, .07);
            border: 1px solid rgba(255, 255, 255, .14);
            font-family: var(--font-body);
            font-size: .75rem;
            font-weight: 500;
            color: rgba(255, 255, 255, .8);
        }

        .rc-hero-chip svg {
            width: 12px;
            height: 12px;
            opacity: .7;
        }

        /* ── SECTION HEADER ── */
        .rc-section-hd {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.35rem;
            gap: .75rem;
            flex-wrap: wrap;
        }

        .rc-section-hd-l {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .rc-section-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--gold-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-dark);
            flex-shrink: 0;
        }

        .rc-section-icon svg {
            width: 18px;
            height: 18px;
        }

        .rc-section-title {
            font-family: var(--font-display);
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--charcoal);
        }

        .rc-section-title em {
            font-style: italic;
            color: var(--gold-dark);
        }

        .rc-section-count {
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .07em;
            text-transform: uppercase;
            padding: .2rem .7rem;
            border-radius: 999px;
            background: var(--gold-light);
            color: var(--gold-dark);
            font-family: var(--font-body);
        }

        .rc-section-divider {
            height: 1px;
            background: linear-gradient(90deg, var(--gold-light) 0%, transparent 100%);
            margin-bottom: 1.75rem;
        }

        /* ── GRID ── */
        .rc-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.25rem;
            margin-bottom: 3rem;
        }

        @media(max-width:680px) {
            .rc-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ── CARD ── */
        .rc-card {
            background: var(--white);
            border-radius: var(--radius-card);
            border: 1.5px solid var(--border);
            box-shadow: var(--shadow-card);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: box-shadow .22s, transform .22s, border-color .22s;
            animation: cardFadeUp .4s ease both;
        }

        .rc-card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-3px);
            border-color: rgba(201, 168, 76, .45);
        }

        .rc-card:nth-child(2) {
            animation-delay: .06s;
        }

        .rc-card:nth-child(3) {
            animation-delay: .12s;
        }

        .rc-card:nth-child(4) {
            animation-delay: .18s;
        }

        .rc-card:nth-child(5) {
            animation-delay: .24s;
        }

        .rc-card:nth-child(6) {
            animation-delay: .30s;
        }

        @keyframes cardFadeUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .rc-card-accent {
            height: 3px;
            background: linear-gradient(90deg, var(--gold), #e6c84a, var(--gold-dark));
            width: 100%;
        }

        .rc-card-head {
            padding: 1.15rem 1.3rem .85rem;
            border-bottom: 1px solid #F5EFE8;
        }

        .rc-card-type {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            padding: .2rem .6rem;
            border-radius: var(--radius-badge);
            background: var(--gold-light);
            color: var(--gold-dark);
            font-family: var(--font-body);
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
            margin-bottom: .4rem;
        }

        .rc-card-name {
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--charcoal);
            line-height: 1.25;
            margin-bottom: .28rem;
        }

        .rc-card-supplier {
            display: flex;
            align-items: center;
            gap: .4rem;
            font-family: var(--font-body);
            font-size: .74rem;
            color: var(--warm-grey);
        }

        .rc-card-supplier svg {
            width: 11px;
            height: 11px;
            color: var(--gold-dark);
        }

        .rc-card-price-row {
            display: flex;
            align-items: baseline;
            gap: .35rem;
            margin-top: .55rem;
        }

        .rc-card-price {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--charcoal);
        }

        .rc-card-price-label {
            font-family: var(--font-body);
            font-size: .7rem;
            color: var(--warm-grey);
        }

        .rc-score {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .3rem .85rem;
            border-radius: 999px;
            font-family: var(--font-body);
            font-size: .72rem;
            font-weight: 700;
            width: max-content;
            margin: .75rem 1.3rem .6rem;
        }

        .rc-score-high {
            background: rgba(16, 185, 129, .1);
            border: 1px solid rgba(16, 185, 129, .25);
            color: #065F46;
        }

        .rc-score-mid {
            background: var(--gold-light);
            border: 1px solid rgba(201, 168, 76, .3);
            color: var(--gold-dark);
        }

        .rc-score-low {
            background: #F1F5F9;
            border: 1px solid #E2E8F0;
            color: #475569;
        }

        .rc-score-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .rc-score-high .rc-score-dot {
            background: #10B981;
        }

        .rc-score-mid .rc-score-dot {
            background: var(--gold);
        }

        .rc-score-low .rc-score-dot {
            background: #94A3B8;
        }

        .rc-card-body {
            padding: .75rem 1.3rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: .85rem;
        }

        .rc-box-label {
            font-family: var(--font-body);
            font-size: .6rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: #C0B8B0;
            margin-bottom: .5rem;
        }

        .rc-inc-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: .32rem;
        }

        .rc-inc-list li {
            display: flex;
            align-items: flex-start;
            gap: .45rem;
            font-family: var(--font-body);
            font-size: .78rem;
            color: var(--charcoal);
            line-height: 1.45;
        }

        .rc-inc-list li::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--gold);
            flex-shrink: 0;
            margin-top: .42rem;
        }

        /* Card footer */
        .rc-card-foot {
            padding: .85rem 1.3rem;
            border-top: 1px solid #F5EFE8;
            display: flex;
            flex-direction: column;
            gap: .55rem;
        }

        /* Negotiate / Bid button */
        .rc-negotiate-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: .72rem 1rem;
            border-radius: var(--radius-btn);
            border: none;
            background: linear-gradient(135deg, var(--gold-dark) 0%, #a07c28 100%);
            font-family: var(--font-body);
            font-size: .82rem;
            font-weight: 700;
            color: var(--white);
            cursor: pointer;
            text-decoration: none;
            transition: opacity .2s, box-shadow .2s, transform .15s;
        }

        .rc-negotiate-btn svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }

        .rc-negotiate-btn:hover {
            opacity: .9;
            box-shadow: 0 4px 14px rgba(138, 106, 31, .35);
            transform: translateY(-1px);
        }

        /* Book direct button */
        .rc-book-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: .62rem 1rem;
            border-radius: var(--radius-btn);
            border: 1.5px solid var(--charcoal);
            background: transparent;
            font-family: var(--font-body);
            font-size: .78rem;
            font-weight: 600;
            color: var(--charcoal);
            cursor: pointer;
            transition: background .2s, color .2s, border-color .2s;
        }

        .rc-book-btn svg {
            width: 13px;
            height: 13px;
            flex-shrink: 0;
        }

        .rc-book-btn:hover {
            background: var(--charcoal);
            color: var(--white);
        }

        /* Empty */
        .rc-empty {
            text-align: center;
            padding: 3.5rem 1.5rem;
            background: var(--white);
            border-radius: var(--radius-card);
            border: 1.5px dashed var(--border);
        }

        .rc-empty-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--gold-light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto .85rem;
            color: var(--gold-dark);
        }

        .rc-empty-icon svg {
            width: 22px;
            height: 22px;
        }

        .rc-empty-title {
            font-family: var(--font-display);
            font-size: .95rem;
            font-weight: 700;
            color: var(--charcoal);
            margin-bottom: .3rem;
        }

        .rc-empty-desc {
            font-family: var(--font-body);
            font-size: .8rem;
            color: var(--warm-grey);
        }

        @media(max-width:520px) {
            .rc-hero {
                padding: 1.75rem 1.35rem 1.5rem;
            }

            .rc-hero-title {
                font-size: 1.5rem;
            }

            .rc-page {
                padding: 1.25rem 1rem 3rem;
            }
        }

        /* ══════════════════════════════
       BID MODAL
    ══════════════════════════════ */
        .bid-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(30, 27, 24, 0.6);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 1.25rem;
            backdrop-filter: blur(4px);
        }

        .bid-overlay.open {
            display: flex;
        }

        .bid-modal {
            background: var(--white);
            border-radius: 16px;
            width: 100%;
            max-width: 500px;
            overflow: hidden;
            box-shadow: 0 28px 72px rgba(30, 27, 24, 0.26);
            display: flex;
            flex-direction: column;
            max-height: calc(100vh - 2.5rem);
            animation: bidIn 0.24s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes bidIn {
            from {
                opacity: 0;
                transform: translateY(22px) scale(0.96);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        /* Gold top bar */
        .bid-modal-bar {
            height: 3px;
            background: linear-gradient(90deg, var(--gold), #e6c84a, var(--gold-dark));
            flex-shrink: 0;
        }

        /* Header */
        .bid-modal-header {
            padding: 1.2rem 1.4rem 1rem;
            border-bottom: 1px solid #F0EBE5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .bid-modal-header-l {
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }

        .bid-modal-icon-wrap {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            flex-shrink: 0;
            background: var(--gold-light);
            border: 1px solid rgba(201, 168, 76, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-dark);
        }

        .bid-modal-icon-wrap svg {
            width: 18px;
            height: 18px;
        }

        .bid-modal-eyebrow {
            font-size: 0.58rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--gold-dark);
            font-family: var(--font-body);
            margin-bottom: 1px;
        }

        .bid-modal-title {
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--charcoal);
        }

        .bid-modal-title em {
            font-style: italic;
            color: var(--gold-dark);
        }

        .bid-modal-close {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1.5px solid var(--border-md);
            background: var(--ivory);
            cursor: pointer;
            font-size: 16px;
            color: var(--warm-grey);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border-color 0.15s, color 0.15s, background 0.15s;
            font-family: var(--font-body);
            flex-shrink: 0;
        }

        .bid-modal-close:hover {
            border-color: var(--gold);
            color: var(--gold-dark);
            background: var(--gold-light);
        }

        /* Body */
        .bid-modal-body {
            padding: 1.3rem 1.4rem;
            overflow-y: auto;
            flex: 1;
        }

        .bid-modal-body::-webkit-scrollbar {
            width: 4px;
        }

        .bid-modal-body::-webkit-scrollbar-thumb {
            background: var(--border-md);
            border-radius: 99px;
        }

        /* Package info strip */
        .bid-pkg-strip {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: linear-gradient(135deg, var(--charcoal) 0%, #2a2016 100%);
            border-radius: 10px;
            padding: 0.9rem 1.1rem;
            margin-bottom: 1.3rem;
            position: relative;
            overflow: hidden;
        }

        .bid-pkg-strip::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1.5px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .bid-pkg-avatar {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            flex-shrink: 0;
            background: rgba(201, 168, 76, 0.15);
            border: 1px solid rgba(201, 168, 76, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
        }

        .bid-pkg-avatar svg {
            width: 18px;
            height: 18px;
        }

        .bid-pkg-name {
            font-family: var(--font-display);
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--white);
            line-height: 1.2;
        }

        .bid-pkg-meta {
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.5);
            margin-top: 2px;
            font-family: var(--font-body);
        }

        .bid-pkg-price-badge {
            margin-left: auto;
            flex-shrink: 0;
            background: rgba(201, 168, 76, 0.18);
            border: 1px solid rgba(201, 168, 76, 0.3);
            border-radius: 6px;
            padding: 4px 10px;
            font-family: var(--font-display);
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--gold);
        }

        /* Form fields */
        .bid-field {
            margin-bottom: 1.1rem;
        }

        .bid-field:last-child {
            margin-bottom: 0;
        }

        .bid-label {
            display: block;
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            color: var(--warm-grey);
            margin-bottom: 0.42rem;
            font-family: var(--font-body);
        }

        .bid-label span {
            font-weight: 400;
            text-transform: none;
            letter-spacing: 0;
            color: #C0B8B0;
            font-size: 0.6rem;
        }

        .bid-input,
        .bid-textarea {
            width: 100%;
            padding: 0.65rem 0.95rem;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: 0.85rem;
            color: var(--charcoal);
            background: var(--ivory);
            outline: none;
            transition: border-color 0.18s, box-shadow 0.18s, background 0.18s;
        }

        .bid-input:focus,
        .bid-textarea:focus {
            border-color: var(--gold);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.12);
        }

        .bid-input[readonly] {
            color: var(--warm-grey);
            background: #F8F4EF;
            cursor: default;
        }

        .bid-textarea {
            resize: vertical;
            min-height: 90px;
            line-height: 1.6;
        }

        .bid-textarea::placeholder {
            color: #C0B8B0;
        }

        /* Offer input with prefix */
        .bid-input-wrap {
            position: relative;
        }

        .bid-input-prefix {
            position: absolute;
            left: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            font-family: var(--font-display);
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--gold-dark);
            pointer-events: none;
        }

        .bid-input-wrap .bid-input {
            padding-left: 1.85rem;
        }

        /* Range hint */
        .bid-range-hint {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.45rem;
            padding: 0.5rem 0.85rem;
            background: var(--gold-light);
            border-radius: 6px;
            border: 1px solid rgba(201, 168, 76, 0.2);
            font-size: 0.68rem;
            color: var(--gold-dark);
            font-family: var(--font-body);
        }

        .bid-range-hint svg {
            width: 11px;
            height: 11px;
            flex-shrink: 0;
        }

        .bid-range-hint strong {
            font-weight: 700;
        }

        /* Modal footer */
        .bid-modal-footer {
            padding: 0.95rem 1.4rem;
            border-top: 1px solid #F0EBE5;
            background: var(--ivory);
            display: flex;
            gap: 0.65rem;
            justify-content: flex-end;
            flex-shrink: 0;
        }

        .bid-btn-cancel {
            padding: 0.62rem 1.25rem;
            border-radius: var(--radius-btn);
            border: 1.5px solid var(--border-md);
            background: var(--white);
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--warm-grey);
            cursor: pointer;
            font-family: var(--font-body);
            transition: border-color 0.15s, color 0.15s, background 0.15s;
        }

        .bid-btn-cancel:hover {
            border-color: var(--charcoal);
            color: var(--charcoal);
            background: #F5EFE8;
        }

        .bid-btn-submit {
            padding: 0.62rem 1.5rem;
            border-radius: var(--radius-btn);
            border: none;
            background: linear-gradient(135deg, var(--gold-dark) 0%, #a07c28 100%);
            color: var(--white);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            cursor: pointer;
            font-family: var(--font-body);
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            transition: opacity 0.18s, box-shadow 0.18s, transform 0.14s;
        }

        .bid-btn-submit:hover {
            opacity: 0.9;
            box-shadow: 0 4px 14px rgba(138, 106, 31, .35);
            transform: translateY(-1px);
        }

        .bid-btn-submit svg {
            width: 13px;
            height: 13px;
        }

        @media (max-width: 520px) {
            .bid-modal {
                border-radius: 16px 16px 0 0;
                max-height: 92dvh;
            }

            .bid-pkg-price-badge {
                display: none;
            }
        }
    </style>

    <div class="rc-page">

        {{-- ── ALERTS ── --}}
        @if (session('success'))
            <div class="rc-alert rc-alert-ok">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 10l4 4 6-6" />
                    <circle cx="10" cy="10" r="8" />
                </svg>
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="rc-alert rc-alert-err">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="10" cy="10" r="8" />
                    <path d="M10 6v4M10 14v.5" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- ── HERO ── --}}
        <div class="rc-hero">
            <div class="rc-hero-eyebrow">AI-Powered Recommendations</div>
            <h1 class="rc-hero-title">Negotiate & <em>Bid</em> On Packages</h1>
            <p class="rc-hero-sub">
                Our AI matched the best packages to your event. Chat directly with suppliers,
                negotiate pricing, or place a bid to secure the best deal.
            </p>
            <div class="rc-hero-chips">
                @if (isset($event))
                    <div class="rc-hero-chip">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M7 1l1.5 3.5L12 5l-2.5 2.5.6 3.5L7 9.5l-3.1 1.5.6-3.5L2 5l3.5-.5z" />
                        </svg>
                        {{ $event->event_type ?? 'Event' }}
                    </div>
                    <div class="rc-hero-chip">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="7" cy="7" r="5" />
                            <path d="M7 4v3.5l2 1.5" />
                        </svg>
                        ₱{{ number_format($event->budget ?? 0, 2) }} Budget
                    </div>
                    <div class="rc-hero-chip">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="5" cy="5" r="2.5" />
                            <path d="M1 12c0-2.5 1.8-4 4-4" />
                            <circle cx="10" cy="5" r="2.5" />
                            <path d="M7.5 12c0-2.5 1.8-4 4.5-4" />
                        </svg>
                        {{ $event->guest_count ?? 0 }} Guests
                    </div>
                @endif
            </div>
        </div>

        {{-- ── SECTION HEADER ── --}}
        <div class="rc-section-hd">
            <div class="rc-section-hd-l">
                <div class="rc-section-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path d="M3 7h14M3 7V5a2 2 0 012-2h10a2 2 0 012 2v2M3 7l2 9a2 2 0 002 2h6a2 2 0 002-2l2-9" />
                        <path d="M8 11h4" />
                    </svg>
                </div>
                <div>
                    <div class="rc-section-title">Supplier <em>Packages</em></div>
                </div>
            </div>
            <span class="rc-section-count">{{ count($supplierPackages) }} matches</span>
        </div>
        <div class="rc-section-divider"></div>

        {{-- ── PACKAGE GRID ── --}}
        @if (count($supplierPackages))
            <div class="rc-grid">
                @foreach ($supplierPackages as $package)
                    @php
                        $score = $package->score ?? 0;
                        $scoreClass = $score >= 80 ? 'rc-score-high' : ($score >= 50 ? 'rc-score-mid' : 'rc-score-low');
                        $scoreLabel =
                            $score >= 80 ? 'Excellent Match' : ($score >= 50 ? 'Good Match' : 'Possible Match');
                    @endphp

                    <div class="rc-card">
                        <div class="rc-card-accent"></div>

                        {{-- Head --}}
                        <div class="rc-card-head">
                            @if ($package->event_type)
                                <div class="rc-card-type">{{ $package->event_type }}</div>
                            @endif
                            <div class="rc-card-name">{{ $package->name }}</div>
                            <div class="rc-card-supplier">
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <circle cx="7" cy="5" r="3" />
                                    <path d="M1 13c0-3 2.7-5 6-5s6 2 6 5" />
                                </svg>
                                {{ $package->supplier->business_name ?? 'Supplier' }}
                            </div>
                            <div class="rc-card-price-row">
                                <span class="rc-card-price">₱{{ number_format($package->price, 2) }}</span>
                                <span class="rc-card-price-label">listed price</span>
                            </div>
                        </div>

                        {{-- AI Score --}}
                        <div class="rc-score {{ $scoreClass }}">
                            <span class="rc-score-dot"></span>
                            {{ $scoreLabel }} &mdash; {{ $score }}
                        </div>

                        {{-- Body --}}
                        <div class="rc-card-body">
                            @if ($package->inclusions && $package->inclusions->count())
                                <div>
                                    <div class="rc-box-label">Inclusions</div>
                                    <ul class="rc-inc-list">
                                        @foreach ($package->inclusions->take(5) as $inc)
                                            <li>{{ $inc->title }}</li>
                                        @endforeach
                                        @if ($package->inclusions->count() > 5)
                                            <li style="color:var(--gold-dark);font-style:italic;">
                                                +{{ $package->inclusions->count() - 5 }} more
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                        </div>

                        {{-- Footer --}}
                        <div class="rc-card-foot">

                            {{-- BID button — opens custom modal --}}
                            @if ($package->is_negotiable)
                                <button type="button" class="rc-negotiate-btn"
                                    onclick="openBidModal(
                                        {{ $package->id }},
                                        '{{ addslashes($package->name) }}',
                                        '{{ number_format($package->price, 2) }}',
                                        {{ $package->min_price ?? 0 }},
                                        {{ $package->price }},
                                        '{{ addslashes($package->supplier->business_name ?? 'Supplier') }}'
                                    )">
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h5" />
                                        <path d="M13 15h4m0 0v-4m0 4l-4-4" />
                                    </svg>
                                        Make a Bid
                                </button>
                            @endif

                            {{-- BOOK button --}}
                            <form action="{{ route('bookings.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="event_id" value="{{ $event->id ?? '' }}">
                                <input type="hidden" name="package_id" value="{{ $package->id }}">
                                <button type="submit" class="rc-book-btn">
                                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="2" y="1.5" width="10" height="11" rx="1.5" />
                                        <path d="M5 5h4M5 7.5h4M5 10h2" />
                                    </svg>
                                    Book at Listed Price
                                </button>
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="rc-empty" style="margin-bottom:3rem;">
                <div class="rc-empty-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M3 7h14M3 7V5a2 2 0 012-2h10a2 2 0 012 2v2M3 7l2 9a2 2 0 002 2h6a2 2 0 002-2l2-9" />
                    </svg>
                </div>
                <div class="rc-empty-title">No Supplier Packages Found</div>
                <div class="rc-empty-desc">No supplier packages matched your event criteria at this time.</div>
            </div>
        @endif

    </div>{{-- /rc-page --}}


    {{-- ══════════════════════════════════════════
     BID MODAL — Custom (no Bootstrap)
══════════════════════════════════════════ --}}
    <div class="bid-overlay" id="bidOverlay" onclick="bidOverlayClick(event)">
        <div class="bid-modal" role="dialog" aria-modal="true" aria-labelledby="bidModalTitle">

            <div class="bid-modal-bar"></div>

            {{-- Header --}}
            <div class="bid-modal-header">
                <div class="bid-modal-header-l">
                    <div class="bid-modal-icon-wrap">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h5" />
                            <path d="M13 15h4m0 0v-4m0 4l-4-4" />
                        </svg>
                    </div>
                    <div>
                        <div class="bid-modal-eyebrow">Negotiation</div>
                        <div class="bid-modal-title" id="bidModalTitle">Send an <em>Offer</em></div>
                    </div>
                </div>
                <button class="bid-modal-close" onclick="closeBidModal()" aria-label="Close">&times;</button>
            </div>

            {{-- Body --}}
            <div class="bid-modal-body">

                {{-- Package strip --}}
                <div class="bid-pkg-strip">
                    <div class="bid-pkg-avatar">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path
                                d="M3 7h14M3 7V5a2 2 0 012-2h10a2 2 0 012 2v2M3 7l2 9a2 2 0 002 2h6a2 2 0 002-2l2-9" />
                        </svg>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div class="bid-pkg-name" id="bidPkgName">—</div>
                        <div class="bid-pkg-meta" id="bidPkgMeta">—</div>
                    </div>
                    <div class="bid-pkg-price-badge" id="bidPkgBadge">—</div>
                </div>

                {{-- Form --}}
                <form method="POST" id="bidForm">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event->id ?? '' }}">

                    <div class="bid-field">
                        <label class="bid-label">Your Offer</label>
                        <div class="bid-input-wrap">
                            <span class="bid-input-prefix">₱</span>
                            <input type="number" class="bid-input" name="offer_price" id="bidOfferInput"
                                step="0.01" required placeholder="0.00">
                        </div>
                        <div class="bid-range-hint" id="bidRangeHint">
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                                <circle cx="7" cy="7" r="5.5" />
                                <path d="M7 5v3M7 9.5h.01" />
                            </svg>
                            <span id="bidRangeText">—</span>
                        </div>
                    </div>

                    <div class="bid-field">
                        <label class="bid-label">
                            Message <span>(optional)</span>
                        </label>
                        <textarea class="bid-textarea" name="message" placeholder="e.g. Can we negotiate this package price?"></textarea>
                    </div>
                </form>

            </div>

            {{-- Footer --}}
            <div class="bid-modal-footer">
                <button type="button" class="bid-btn-cancel" onclick="closeBidModal()">Cancel</button>
                <button type="button" class="bid-btn-submit" onclick="submitBid()">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="20" y1="2" x2="10" y2="12" />
                        <polygon points="20 2 13 20 10 12 2 9 20 2" />
                    </svg>
                    Send Offer
                </button>
            </div>

        </div>
    </div>

    <script>
        /* ══════════════════════════════
           BID MODAL
            ══════════════════════════════ */
        function openBidModal(packageId, pkgName, pkgPrice, minPrice, maxPrice, supplierName) {

            /* Populate package strip */
            document.getElementById('bidPkgName').textContent = pkgName;
            document.getElementById('bidPkgMeta').textContent = supplierName + ' · Listed Price';
            document.getElementById('bidPkgBadge').textContent = '₱' + pkgPrice;

            /* Offer input constraints */
            const input = document.getElementById('bidOfferInput');
            input.min = minPrice > 0 ? minPrice : 0.01;
            input.max = maxPrice;
            input.value = '';

            /* Range hint */
            const hint = document.getElementById('bidRangeText');
            if (minPrice > 0) {
                hint.innerHTML = 'Accepted range: <strong>₱' + Number(minPrice).toLocaleString() + '</strong> – <strong>₱' +
                    Number(maxPrice).toLocaleString() + '</strong>';
            } else {
                hint.innerHTML = 'Your offer must not exceed <strong>₱' + Number(maxPrice).toLocaleString() + '</strong>';
            }

            /* Point form to correct route */
            // FIXED
            document.getElementById('bidForm').action =
                "{{ url('/client/bids/package') }}/" + packageId;

            /* Show */
            document.getElementById('bidOverlay').classList.add('open');
            document.body.style.overflow = 'hidden';
            setTimeout(() => input.focus(), 120);
        }

        function closeBidModal() {
            document.getElementById('bidOverlay').classList.remove('open');
            document.body.style.overflow = '';
        }

        function bidOverlayClick(e) {
            if (e.target === document.getElementById('bidOverlay')) closeBidModal();
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeBidModal();
        });

        function submitBid() {
            const form = document.getElementById('bidForm');
            if (form.reportValidity()) form.submit();
        }
    </script>

</x-client-layout>
