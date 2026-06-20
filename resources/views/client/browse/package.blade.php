<x-client-layout>
    <style>
        :root {
            --gold: #C9A84C;
            --gold-light: #E8C97A;
            --gold-dark: #8A6A1F;
            --blush-deep: #D4A090;
            --ivory: #FAF7F2;
            --charcoal: #1E1B18;
            --warm-grey: #6B6560;
            --white: #FFFFFF;
            --border: #F0EBE5;
            --border-md: #E0D8D0;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body: 'DM Sans', sans-serif;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-body);
            background: var(--ivory);
            color: var(--charcoal);
        }

        /* ── PAGE HERO ── */
        .page-hero {
            background: var(--charcoal);
            padding: 3rem 3rem 2.75rem;
            position: relative;
            overflow: hidden;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(201, 168, 76, 0.07) 1px, transparent 1px);
            background-size: 20px 20px;
            pointer-events: none;
        }

        .page-hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            pointer-events: none;
        }

        .hero-inner {
            position: relative;
            z-index: 1;
            max-width: 1100px;
            margin: 0 auto;
        }

        .hero-eyebrow {
            font-size: 0.62rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--gold);
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .hero-eyebrow::before {
            content: '';
            display: block;
            width: 18px;
            height: 1px;
            background: var(--gold);
        }

        .hero-inner h1 {
            font-family: var(--font-display);
            font-size: clamp(1.6rem, 3.5vw, 2.6rem);
            font-weight: 700;
            color: var(--white);
            line-height: 1.15;
        }

        .hero-inner h1 em {
            color: var(--gold-light);
            font-style: italic;
        }

        .hero-sub {
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.42);
            margin-top: 0.4rem;
        }

        /* ── MAIN WRAPPER ── */
        .main-wrap {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 4rem;
        }

        @media (max-width: 640px) {
            .main-wrap {
                padding: 1.5rem 1rem 3rem;
            }
        }

        /* ── SECTION HEADERS ── */
        .hs-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .hs-head-l {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .hs-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(201, 168, 76, 0.1);
            border: 1.5px solid rgba(201, 168, 76, 0.28);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-dark);
            flex-shrink: 0;
        }

        .hs-icon svg {
            width: 17px;
            height: 17px;
        }

        .hs-title {
            font-family: var(--font-display);
            font-size: 1.22rem;
            font-weight: 700;
            color: var(--charcoal);
            line-height: 1.2;
        }

        .hs-title em {
            font-style: italic;
            color: var(--gold-dark);
        }

        .hs-sub {
            font-size: 0.73rem;
            color: var(--warm-grey);
            margin-top: 0.12rem;
        }

        .hs-link {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--gold-dark);
            text-decoration: none;
            white-space: nowrap;
            transition: color 0.2s;
        }

        .hs-link:hover {
            color: var(--charcoal);
        }

        .hs-link svg {
            width: 14px;
            height: 14px;
            transition: transform 0.2s;
        }

        .hs-link:hover svg {
            transform: translateX(3px);
        }

        /* ── DIVIDER ── */
        .section-divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 2.75rem 0;
        }

        /* ════════════════════════════════════════
           SUPPLIER GRID
        ════════════════════════════════════════ */
        .sp-grid-section {
            margin-bottom: 0;
        }

        .sp-section-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .sp-section-label {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--gold-dark);
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }

        .sp-section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, var(--gold), transparent);
            width: 60px;
            display: inline-block;
        }

        .sp-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.1rem;
        }

        @media (max-width: 1100px) {
            .sp-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 720px) {
            .sp-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 440px) {
            .sp-grid {
                grid-template-columns: 1fr;
            }
        }

        .sp-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.22s, transform 0.22s, border-color 0.22s;
            animation: fadeUp 0.35s ease both;
        }

        .sp-card:hover {
            box-shadow: 0 8px 32px rgba(30, 27, 24, 0.12);
            transform: translateY(-3px);
            border-color: rgba(201, 168, 76, 0.45);
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .sp-card-photo {
            position: relative;
            width: 100%;
            aspect-ratio: 4 / 3;
            overflow: hidden;
            background: linear-gradient(135deg, var(--charcoal) 0%, #2a2016 60%, #3d2f14 100%);
            flex-shrink: 0;
        }

        .sp-card-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.35s;
        }

        .sp-card:hover .sp-card-photo img {
            transform: scale(1.05);
        }

        .sp-card-photo-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sp-card-photo-initials {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 700;
            color: rgba(201, 168, 76, 0.25);
            letter-spacing: 0.04em;
        }

        .sp-photo-badge {
            position: absolute;
            top: 0.55rem;
            right: 0.55rem;
            display: flex;
            flex-wrap: wrap;
            gap: 0.3rem;
            justify-content: flex-end;
        }

        .sp-photo-cat {
            font-size: 0.58rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.18rem 0.52rem;
            border-radius: 20px;
            background: rgba(30, 27, 24, 0.72);
            color: var(--gold-light);
            backdrop-filter: blur(4px);
        }

        .sp-card-logo-row {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            padding: 0 1rem;
            margin-top: -18px;
            position: relative;
            z-index: 3;
        }

        .sp-logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid var(--white);
            box-shadow: 0 2px 10px rgba(30, 27, 24, 0.18);
            background: var(--charcoal);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 700;
            color: var(--gold);
            overflow: hidden;
            flex-shrink: 0;
        }

        .sp-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .sp-card-rating {
            position: absolute;
            right: 1rem;
            display: flex;
            align-items: center;
            gap: 3px;
            background: var(--white);
            border: 1px solid var(--border);
            padding: 2px 7px;
            border-radius: 999px;
            box-shadow: 0 1px 4px rgba(30, 27, 24, 0.08);
        }

        .sp-card-rating svg {
            width: 11px;
            height: 11px;
            fill: var(--gold);
            stroke: var(--gold-dark);
            stroke-width: 1;
        }

        .sp-card-rating-val {
            font-size: 0.72rem;
            font-weight: 700;
        }

        .sp-card-rating-ct {
            font-size: 0.63rem;
            color: var(--warm-grey);
            font-weight: 400;
        }

        .sp-card-body {
            padding: 0.65rem 1rem 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            flex: 1;
        }

        .sp-biz-name {
            font-family: var(--font-display);
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--charcoal);
            line-height: 1.2;
        }

        .sp-owner-name {
            font-size: 0.68rem;
            color: var(--warm-grey);
        }

        .sp-tagline {
            font-size: 0.7rem;
            color: var(--gold-dark);
            font-style: italic;
            line-height: 1.45;
        }

        .sp-location {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.7rem;
            color: var(--warm-grey);
            margin-top: 0.05rem;
        }

        .sp-location svg {
            width: 9px;
            height: 9px;
            flex-shrink: 0;
            color: var(--gold-dark);
        }

        .sp-card-divider {
            border: none;
            border-top: 1px solid var(--border);
            margin-top: 0.5rem;
        }

        .sp-no-results {
            display: none;
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem 1rem;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .sp-no-results.visible {
            display: block;
        }

        .sp-no-results svg {
            width: 36px;
            height: 36px;
            color: rgba(201, 168, 76, 0.4);
            margin-bottom: 0.75rem;
        }

        .sp-no-results-title {
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 700;
            color: var(--charcoal);
            margin-bottom: 0.3rem;
        }

        .sp-no-results-sub {
            font-size: 0.8rem;
            color: var(--warm-grey);
        }

        .sp-empty {
            text-align: center;
            padding: 4rem 1rem;
        }

        .sp-empty svg {
            width: 40px;
            height: 40px;
            color: rgba(201, 168, 76, 0.35);
            margin-bottom: 0.75rem;
        }

        .sp-empty-title {
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--charcoal);
            margin-bottom: 0.35rem;
        }

        .sp-empty-sub {
            font-size: 0.8rem;
            color: var(--warm-grey);
            line-height: 1.6;
        }

        /* ════════════════════════════════════
           POPULAR PACKAGES
        ════════════════════════════════════ */
        .pp-section {
            margin-top: 0;
        }

        .pp-tab-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 1.4rem;
        }

        .pp-tab {
            padding: 0.4rem 1.1rem;
            border-radius: 20px;
            border: 1.5px solid var(--border-md);
            background: var(--white);
            font-family: var(--font-body);
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--warm-grey);
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .pp-tab:hover {
            border-color: var(--gold);
            color: var(--gold-dark);
        }

        .pp-tab.pp-active {
            background: var(--charcoal);
            border-color: var(--charcoal);
            color: var(--white);
        }

        .pp-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }

        @media (max-width: 1100px) {
            .pp-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .pp-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .pp-grid {
                grid-template-columns: 1fr;
            }
        }

        .pp-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.22s, transform 0.22s, border-color 0.22s;
            animation: fadeUp 0.35s ease both;
        }

        .pp-card:hover {
            box-shadow: 0 6px 26px rgba(30, 27, 24, 0.12);
            transform: translateY(-3px);
            border-color: rgba(201, 168, 76, 0.45);
        }

        .pp-card.pp-hidden {
            display: none;
        }

        .pp-badge-wrap {
            padding: 1rem 1.1rem 0;
        }

        .pp-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.58rem;
            font-weight: 700;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            padding: 3px 9px;
            border-radius: 999px;
            background: rgba(201, 168, 76, 0.1);
            color: var(--gold-dark);
            border: 1px solid rgba(201, 168, 76, 0.25);
        }

        .pp-badge svg {
            width: 9px;
            height: 9px;
        }

        .pp-body {
            padding: 0.7rem 1.1rem 0.9rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .pp-title-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 0.4rem;
        }

        .pp-pkg-name {
            font-family: var(--font-display);
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--charcoal);
            line-height: 1.25;
            flex: 1;
        }

        .pp-price {
            font-family: var(--font-display);
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--gold-dark);
            white-space: nowrap;
        }

        .pp-meta {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            flex-wrap: wrap;
        }

        .pp-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.65rem;
            color: var(--warm-grey);
        }

        .pp-chip svg {
            width: 11px;
            height: 11px;
            flex-shrink: 0;
        }

        .pp-inc-label {
            font-size: 0.57rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--warm-grey);
        }

        .pp-inc-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .pp-inc-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.38rem;
            font-size: 0.72rem;
            color: var(--charcoal);
            line-height: 1.4;
        }

        .pp-inc-list li svg {
            width: 10px;
            height: 10px;
            color: var(--gold-dark);
            flex-shrink: 0;
            margin-top: 0.2rem;
        }

        /* ── Package card footer ── */
        .pp-foot {
            padding: 0.75rem 1.1rem;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.6rem;
            background: rgba(250, 247, 242, 0.5);
        }

        .pp-supplier-micro {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            min-width: 0;
            flex: 1;
        }

        .pp-supplier-micro img {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid var(--border-md);
            flex-shrink: 0;
        }

        .pp-supplier-micro-init {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--charcoal);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-display);
            font-size: 0.6rem;
            font-weight: 700;
            color: var(--gold);
            flex-shrink: 0;
        }

        .pp-supplier-name {
            font-size: 0.68rem;
            color: var(--warm-grey);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ── Book Now button ── */
        .btn-book {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.45rem 1rem;
            border-radius: 6px;
            border: none;
            background: var(--charcoal);
            font-family: var(--font-body);
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 0.03em;
            color: var(--white);
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            white-space: nowrap;
            flex-shrink: 0;
            line-height: 1;
        }

        .btn-book:hover {
            background: var(--gold-dark);
            box-shadow: 0 3px 12px rgba(138, 106, 31, 0.35);
            transform: translateY(-1px);
            color: var(--white);
        }

        .btn-book:active {
            transform: translateY(0);
            box-shadow: none;
        }

        .btn-book svg {
            width: 12px;
            height: 12px;
            transition: transform 0.2s;
            flex-shrink: 0;
        }

        .btn-book:hover svg {
            transform: translateX(2px);
        }

        .pp-no-results {
            display: none;
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem 1rem;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .pp-no-results.visible {
            display: block;
        }

        .pp-no-results svg {
            width: 36px;
            height: 36px;
            color: rgba(201, 168, 76, 0.4);
            margin-bottom: 0.75rem;
        }

        .pp-no-results h3 {
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 700;
            color: var(--charcoal);
            margin-bottom: 0.3rem;
        }

        .pp-no-results p {
            font-size: 0.8rem;
            color: var(--warm-grey);
        }

        /* ════════════════════════════════════
           BOOKING MODAL
        ════════════════════════════════════ */
        .bv-modal-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 1000;
            background: rgba(30, 27, 24, 0.55);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .bv-modal-backdrop.open {
            display: flex;
        }

        .bv-modal {
            background: var(--white);
            border-radius: 16px;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 24px 64px rgba(30, 27, 24, 0.22), 0 2px 8px rgba(30, 27, 24, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            animation: modalIn 0.26s cubic-bezier(0.34, 1.3, 0.64, 1) both;
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: translateY(18px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .bv-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 1.5rem 1.1rem;
            background: var(--white);
            border-bottom: 1px solid var(--border);
        }

        .bv-modal-header-inner {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .bv-modal-header-accent {
            width: 4px;
            height: 36px;
            border-radius: 4px;
            background: linear-gradient(180deg, var(--gold) 0%, var(--gold-dark) 100%);
            flex-shrink: 0;
        }

        .bv-modal-title-wrap {}

        .bv-modal-eyebrow {
            font-size: 0.58rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--gold-dark);
            margin-bottom: 0.2rem;
        }

        .bv-modal-title {
            font-family: var(--font-display);
            font-size: 1.12rem;
            font-weight: 700;
            color: var(--charcoal);
            line-height: 1.2;
        }

        .bv-modal-title em {
            color: var(--gold-dark);
            font-style: italic;
        }

        .bv-modal-close {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1.5px solid var(--border-md);
            background: var(--white);
            color: var(--warm-grey);
            font-size: 0.82rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s, color 0.2s, border-color 0.2s;
            line-height: 1;
            flex-shrink: 0;
        }

        .bv-modal-close:hover {
            background: var(--ivory);
            border-color: var(--charcoal);
            color: var(--charcoal);
        }

        .bv-modal-body {
            padding: 1.4rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
        }

        .modal-pkg-info {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            background: rgba(201, 168, 76, 0.07);
            border: 1px solid rgba(201, 168, 76, 0.22);
            border-radius: 10px;
            padding: 0.85rem 1rem;
        }

        .modal-pkg-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--gold);
            flex-shrink: 0;
            margin-top: 3px;
        }

        .modal-pkg-name {
            font-family: var(--font-display);
            font-size: 0.98rem;
            font-weight: 700;
            color: var(--charcoal);
            line-height: 1.25;
        }

        .modal-pkg-price {
            font-size: 0.8rem;
            color: var(--gold-dark);
            font-weight: 600;
            margin-top: 0.15rem;
        }

        .bv-field {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .bv-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--warm-grey);
        }

        .bv-select {
            width: 100%;
            padding: 0.65rem 0.9rem;
            border: 1.5px solid var(--border-md);
            border-radius: 8px;
            background: var(--white);
            color: var(--charcoal);
            font-family: var(--font-body);
            font-size: 0.85rem;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath d='M2 4l4 4 4-4' fill='none' stroke='%236B6560' stroke-width='1.6' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.85rem center;
            padding-right: 2.25rem;
            cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .bv-select:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.15);
        }

        .bv-select:disabled {
            background-color: #f5f3f0;
            color: var(--warm-grey);
            cursor: not-allowed;
        }

        .bv-alert-warn {
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
            background: #fff8ed;
            border: 1px solid #f5d98a;
            border-radius: 8px;
            padding: 0.75rem 0.9rem;
            font-size: 0.78rem;
            color: #7a5a10;
            line-height: 1.5;
        }

        .bv-alert-warn svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            color: #c9900c;
            margin-top: 1px;
        }

        /* ── Add Event button inside warning ── */
        .date-hero-add {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.52rem 1.1rem;
            border-radius: 8px;
            border: 1.5px solid var(--gold-dark);
            background: var(--charcoal);
            font-family: var(--font-body);
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--gold-light);
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s, color 0.2s, transform 0.15s;
            white-space: nowrap;
            letter-spacing: 0.02em;
        }

        .date-hero-add:hover {
            background: var(--gold-dark);
            border-color: var(--gold-dark);
            color: var(--white);
            transform: translateY(-1px);
        }

        .date-hero-add:active {
            transform: translateY(0);
        }

        .date-hero-add svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }

        .bv-modal-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.65rem;
            padding: 1rem 1.5rem 1.25rem;
            border-top: 1px solid var(--border);
        }

        .btn-cancel-modal {
            padding: 0.55rem 1.2rem;
            border-radius: 8px;
            border: 1.5px solid var(--border-md);
            background: var(--white);
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--warm-grey);
            cursor: pointer;
            transition: border-color 0.2s, color 0.2s;
        }

        .btn-cancel-modal:hover {
            border-color: var(--charcoal);
            color: var(--charcoal);
        }

        .btn-confirm {
            padding: 0.58rem 1.4rem;
            border-radius: 8px;
            border: none;
            background: var(--charcoal);
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--gold-light);
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .btn-confirm:hover:not(:disabled) {
            background: var(--gold-dark);
            color: var(--white);
        }

        .btn-confirm:disabled {
            background: #d4d0cb;
            color: #a09a93;
            cursor: not-allowed;
        }

        .btn-confirm .btn-spinner {
            display: none;
            width: 14px;
            height: 14px;
            border: 2px solid rgba(255, 255, 255, 0.4);
            border-top-color: var(--white);
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        .btn-confirm.loading .btn-spinner {
            display: block;
        }

        .btn-confirm.loading span {
            opacity: 0.7;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ── Toast ── */
        .bv-toast {
            display: none;
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 1100;
            background: var(--charcoal);
            color: var(--white);
            border-left: 4px solid var(--gold);
            border-radius: 10px;
            padding: 0.85rem 1.2rem;
            font-size: 0.82rem;
            max-width: 320px;
            box-shadow: 0 8px 24px rgba(30, 27, 24, 0.2);
            animation: toastIn 0.3s ease both;
        }

        .bv-toast.visible {
            display: block;
        }

        .bv-toast.bv-toast-error {
            border-left-color: #e06b5a;
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ════════════════════════════════════
           CREATE EVENT MODAL  (mo-*)
        ════════════════════════════════════ */
        .mo-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 1200;
            background: rgba(30, 27, 24, 0.6);
            backdrop-filter: blur(5px);
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .mo-overlay.open {
            display: flex;
        }

        .mo-box {
            background: var(--white);
            border-radius: 16px;
            width: 100%;
            max-width: 560px;
            max-height: 92vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 28px 72px rgba(30, 27, 24, 0.26), 0 2px 8px rgba(30, 27, 24, 0.1);
            overflow: hidden;
            animation: moIn 0.27s cubic-bezier(0.34, 1.25, 0.64, 1) both;
        }

        @keyframes moIn {
            from {
                opacity: 0;
                transform: translateY(22px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .mo-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.2rem 1.5rem 1rem;
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
            background: var(--charcoal);
        }

        .mo-head-l {
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }

        .mo-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(201, 168, 76, 0.15);
            border: 1.5px solid rgba(201, 168, 76, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-light);
            flex-shrink: 0;
        }

        .mo-icon svg {
            width: 16px;
            height: 16px;
        }

        .mo-title {
            font-family: var(--font-display);
            font-size: 1.08rem;
            font-weight: 700;
            color: var(--white);
            line-height: 1.2;
        }

        .mo-close {
            width: 30px;
            height: 30px;
            border-radius: 7px;
            border: 1.5px solid rgba(255, 255, 255, 0.18);
            background: rgba(255, 255, 255, 0.07);
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s, color 0.2s, border-color 0.2s;
            flex-shrink: 0;
        }

        .mo-close:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
            color: var(--white);
        }

        .mo-close svg {
            width: 11px;
            height: 11px;
        }

        .mo-body {
            padding: 1.35rem 1.5rem;
            overflow-y: auto;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .mo-date-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(201, 168, 76, 0.1);
            border: 1px solid rgba(201, 168, 76, 0.28);
            border-radius: 20px;
            padding: 0.3rem 0.85rem;
            font-size: 0.73rem;
            font-weight: 600;
            color: var(--gold-dark);
            margin-bottom: 1.1rem;
            width: fit-content;
        }

        .mo-date-chip svg {
            width: 12px;
            height: 12px;
            flex-shrink: 0;
            color: var(--gold-dark);
        }

        .mo-field {
            display: flex;
            flex-direction: column;
            gap: 0.38rem;
            margin-bottom: 0.85rem;
        }

        .mo-fg {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }

        @media (max-width: 480px) {
            .mo-fg {
                grid-template-columns: 1fr;
            }
        }

        .mo-lbl {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            color: var(--warm-grey);
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .mo-req {
            font-size: 0.58rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--white);
            background: var(--gold-dark);
            padding: 1px 6px;
            border-radius: 4px;
        }

        .mo-opt {
            font-size: 0.58rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--warm-grey);
            background: var(--border);
            padding: 1px 6px;
            border-radius: 4px;
        }

        .mo-inp,
        .mo-sel,
        .mo-ta {
            width: 100%;
            padding: 0.62rem 0.9rem;
            border: 1.5px solid var(--border-md);
            border-radius: 8px;
            background: var(--white);
            color: var(--charcoal);
            font-family: var(--font-body);
            font-size: 0.84rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .mo-inp:focus,
        .mo-sel:focus,
        .mo-ta:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.14);
        }

        .mo-inp::placeholder,
        .mo-ta::placeholder {
            color: #b0aa9f;
        }

        .mo-sw {
            position: relative;
        }

        .mo-sw::after {
            content: '';
            position: absolute;
            right: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 5px solid var(--warm-grey);
            pointer-events: none;
        }

        .mo-sel {
            appearance: none;
            padding-right: 2.2rem;
            cursor: pointer;
        }

        .mo-ta {
            resize: vertical;
            min-height: 80px;
            line-height: 1.55;
        }

        .mo-foot {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.65rem;
            padding: 1rem 1.5rem 1.25rem;
            border-top: 1px solid var(--border);
            flex-shrink: 0;
        }

        .mo-btn-cancel {
            padding: 0.55rem 1.2rem;
            border-radius: 8px;
            border: 1.5px solid var(--border-md);
            background: var(--white);
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--warm-grey);
            cursor: pointer;
            transition: border-color 0.2s, color 0.2s;
        }

        .mo-btn-cancel:hover {
            border-color: var(--charcoal);
            color: var(--charcoal);
        }

        .mo-btn-save {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.58rem 1.4rem;
            border-radius: 8px;
            border: none;
            background: var(--charcoal);
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--gold-light);
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }

        .mo-btn-save:hover {
            background: var(--gold-dark);
            color: var(--white);
        }

        .mo-btn-save svg {
            width: 13px;
            height: 13px;
            flex-shrink: 0;
        }

        /* ════════════════════════════════════
           BID MODAL — redesigned white header
        ════════════════════════════════════ */

        /* Backdrop — matches booking modal z-index layer */
        .bid-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 1000;
            background: rgba(30, 27, 24, 0.55);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .bid-overlay.open {
            display: flex;
        }

        /* Modal box */
        .bid-modal {
            background: var(--white);
            border-radius: 16px;
            width: 100%;
            max-width: 460px;
            max-height: 92vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 24px 64px rgba(30, 27, 24, 0.22), 0 2px 8px rgba(30, 27, 24, 0.1);
            animation: bidIn 0.26s cubic-bezier(0.34, 1.3, 0.64, 1) both;
        }

        @keyframes bidIn {
            from {
                opacity: 0;
                transform: translateY(18px) scale(0.97);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* ── Header — white, matches booking modal exactly ── */
        .bid-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 1.5rem 1.1rem;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
        }

        .bid-modal-header-l {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Gold left-accent bar — identical to booking modal */
        .bid-modal-accent {
            width: 4px;
            height: 36px;
            border-radius: 4px;
            background: linear-gradient(180deg, var(--gold) 0%, var(--gold-dark) 100%);
            flex-shrink: 0;
        }

        .bid-modal-eyebrow {
            font-size: 0.58rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--gold-dark);
            margin-bottom: 0.2rem;
        }

        .bid-modal-title {
            font-family: var(--font-display);
            font-size: 1.12rem;
            font-weight: 700;
            color: var(--charcoal);
            line-height: 1.2;
        }

        .bid-modal-title em {
            color: var(--gold-dark);
            font-style: italic;
        }

        /* Close button — matches booking modal */
        .bid-modal-close {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1.5px solid var(--border-md);
            background: var(--white);
            color: var(--warm-grey);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s, color 0.2s, border-color 0.2s;
            flex-shrink: 0;
            line-height: 1;
        }

        .bid-modal-close:hover {
            background: var(--ivory);
            border-color: var(--charcoal);
            color: var(--charcoal);
        }

        .bid-modal-close svg {
            width: 14px;
            height: 14px;
        }

        /* ── Body ── */
        .bid-modal-body {
            padding: 1.4rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
            overflow-y: auto;
            flex: 1;
        }

        /* Package info strip — mirrors booking modal's .modal-pkg-info */
        .bid-pkg-strip {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            background: rgba(201, 168, 76, 0.07);
            border: 1px solid rgba(201, 168, 76, 0.22);
            border-radius: 10px;
            padding: 0.85rem 1rem;
        }

        .bid-pkg-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(201, 168, 76, 0.12);
            border: 1.5px solid rgba(201, 168, 76, 0.28);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-dark);
            flex-shrink: 0;
        }

        .bid-pkg-icon svg {
            width: 16px;
            height: 16px;
        }

        .bid-pkg-info {
            flex: 1;
            min-width: 0;
        }

        .bid-pkg-name {
            font-family: var(--font-display);
            font-size: 0.96rem;
            font-weight: 700;
            color: var(--charcoal);
            line-height: 1.25;
        }

        .bid-pkg-meta {
            font-size: 0.72rem;
            color: var(--warm-grey);
            margin-top: 0.15rem;
        }

        .bid-pkg-price-badge {
            font-family: var(--font-display);
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--gold-dark);
            white-space: nowrap;
            flex-shrink: 0;
            align-self: center;
        }

        /* ── Form fields ── */
        .bid-field {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .bid-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--warm-grey);
        }

        /* Offer input with peso prefix */
        .bid-input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .bid-input-prefix {
            position: absolute;
            left: 0.9rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--warm-grey);
            pointer-events: none;
            user-select: none;
        }

        .bid-input {
            width: 100%;
            padding: 0.65rem 0.9rem 0.65rem 1.9rem;
            border: 1.5px solid var(--border-md);
            border-radius: 8px;
            background: var(--white);
            color: var(--charcoal);
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 600;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .bid-input:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.15);
        }

        .bid-input::placeholder {
            color: #b0aa9f;
            font-weight: 400;
        }

        /* Range hint pill */
        .bid-range-hint {
            display: flex;
            align-items: flex-start;
            gap: 0.4rem;
            background: #fff8ed;
            border: 1px solid #f5d98a;
            border-radius: 7px;
            padding: 0.5rem 0.75rem;
            font-size: 0.74rem;
            color: #7a5a10;
            line-height: 1.5;
        }

        .bid-range-hint svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
            color: #c9900c;
            margin-top: 1px;
        }

        /* Textarea */
        .bid-textarea {
            width: 100%;
            padding: 0.62rem 0.9rem;
            border: 1.5px solid var(--border-md);
            border-radius: 8px;
            background: var(--white);
            color: var(--charcoal);
            font-family: var(--font-body);
            font-size: 0.84rem;
            resize: vertical;
            min-height: 80px;
            line-height: 1.55;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .bid-textarea:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.14);
        }

        .bid-textarea::placeholder {
            color: #b0aa9f;
        }

        /* ── Footer ── */
        .bid-modal-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.65rem;
            padding: 1rem 1.5rem 1.25rem;
            border-top: 1px solid var(--border);
            flex-shrink: 0;
        }

        .bid-btn-cancel {
            padding: 0.55rem 1.2rem;
            border-radius: 8px;
            border: 1.5px solid var(--border-md);
            background: var(--white);
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--warm-grey);
            cursor: pointer;
            transition: border-color 0.2s, color 0.2s;
        }

        .bid-btn-cancel:hover {
            border-color: var(--charcoal);
            color: var(--charcoal);
        }

        .bid-btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.58rem 1.4rem;
            border-radius: 8px;
            border: none;
            background: var(--charcoal);
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--gold-light);
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }

        .bid-btn-submit:hover {
            background: var(--gold-dark);
            color: var(--white);
        }

        .bid-btn-submit svg {
            width: 13px;
            height: 13px;
            flex-shrink: 0;
        }

        /* Negotiate button on pp-card footer */
        .rc-negotiate-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.45rem 0.9rem;
            border-radius: 6px;
            border: 1.5px solid rgba(201, 168, 76, 0.4);
            background: rgba(201, 168, 76, 0.08);
            font-family: var(--font-body);
            font-size: 0.72rem;
            font-weight: 500;
            color: var(--gold-dark);
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s, color 0.2s, transform 0.15s;
            white-space: nowrap;
            flex-shrink: 0;
            line-height: 1;
        }

        .rc-negotiate-btn:hover {
            background: rgba(201, 168, 76, 0.18);
            border-color: var(--gold-dark);
            color: var(--gold-dark);
            transform: translateY(-1px);
        }

        .rc-negotiate-btn:active {
            transform: translateY(0);
        }

        .rc-negotiate-btn svg {
            width: 12px;
            height: 12px;
            flex-shrink: 0;
        }

        /* ── FOOTER ── */
        footer {
            background: var(--charcoal);
            border-top: 1px solid rgba(201, 168, 76, 0.2);
            padding: 2.25rem 3rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-brand {
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--white);
        }

        .footer-brand span {
            color: var(--gold);
            font-style: italic;
        }

        .footer-links {
            display: flex;
            gap: 1.5rem;
        }

        .footer-links a {
            font-size: 0.78rem;
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--gold-light);
        }

        .footer-copy {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.28);
        }

        @media (max-width: 640px) {
            footer {
                padding: 2rem 1.25rem;
            }
        }
    </style>

    {{-- ── PAGE HERO ── --}}
    <div class="page-hero">
        <div class="hero-inner">
            <div class="hero-eyebrow">Explore Offers</div>
            <h1>Browse <em>Event Packages</em></h1>
            <p class="hero-sub">Curated packages from verified suppliers across WES TEAM.</p>
        </div>
    </div>

    {{-- ── MAIN CONTENT ── --}}
    <div class="main-wrap">

        {{-- ════════════════════════
             FEATURED SUPPLIERS
        ════════════════════════ --}}
        <div class="hs-head">
            <div class="hs-head-l">
                <div class="hs-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path d="M12 2l2.4 4.9L20 7.6l-4 3.9 1 5.5L12 14.4 6.9 17l1-5.5-4-3.9 5.6-.7z" />
                    </svg>
                </div>
                <div>
                    <div class="hs-title">Featured <em>Suppliers</em></div>
                    <div class="hs-sub">Trusted suppliers for your special events</div>
                </div>
            </div>
            <a href="{{ route('client.all.suppliers') }}" class="hs-link">
                View all suppliers
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 8h10M9 4l4 4-4 4" />
                </svg>
            </a>
        </div>

        <div class="sp-grid-section">
            <div class="sp-section-head">
                <span class="sp-section-label">All Suppliers</span>
            </div>

            @if ($suppliers->count())
                <div class="sp-grid" id="spGrid">
                    @foreach ($suppliers as $supplier)
                        @php
                            $profile = $supplier->supplierProfile ?? $supplier;
                            $bizName =
                                $profile->business_name ??
                                trim(($profile->first_name ?? '') . ' ' . ($profile->last_name ?? '')) ?:
                                $supplier->name;
                            $fullName = trim(($profile->first_name ?? '') . ' ' . ($profile->last_name ?? ''));
                            $city = $profile->city ?? null;
                            $province = $profile->province ?? null;
                            $photo = $profile->photo ?? null;
                            $cover_photo = $profile->cover_photo ?? null;
                            $tagline = $profile->tagline ?? null;
                            $initials = strtoupper(substr($bizName, 0, 2));
                            $cats = $supplier->categories ?? collect();
                            $catNames = $cats->pluck('name')->map(fn($c) => strtolower($c))->implode(' ');
                            $location = implode(', ', array_filter([$city, $province]));
                            $avg = $supplier->ratings->avg('rating');
                            $rCount = $supplier->ratings->count();
                            $avgR = $avg ? round($avg, 1) : 0;
                        @endphp

                        <div class="sp-card reveal" data-name="{{ strtolower($bizName) }} {{ strtolower($fullName) }}"
                            data-city="{{ strtolower($city ?? '') }}" data-cat="{{ $catNames }}"
                            data-rating="{{ $avgR }}" data-reviews="{{ $rCount }}"
                            data-bizname="{{ strtolower($bizName) }}">

                            <div class="sp-card-photo">
                                @if ($cover_photo)
                                    <img src="{{ asset('storage/' . $cover_photo) }}" alt="{{ $bizName }}"
                                        loading="lazy">
                                @else
                                    <div class="sp-card-photo-placeholder">
                                        <span class="sp-card-photo-initials">{{ $initials }}</span>
                                    </div>
                                @endif

                                @if ($cats->count())
                                    <div class="sp-photo-badge">
                                        @foreach ($cats->take(2) as $cat)
                                            <span class="sp-photo-cat">{{ $cat->name }}</span>
                                        @endforeach
                                        @if ($cats->count() > 2)
                                            <span class="sp-photo-cat">+{{ $cats->count() - 2 }}</span>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="sp-card-logo-row">
                                <div class="sp-logo">
                                    @if ($photo)
                                        <img src="{{ asset('storage/' . $photo) }}" alt="{{ $bizName }}">
                                    @else
                                        {{ $initials }}
                                    @endif
                                </div>
                                <div class="sp-card-rating">
                                    <svg viewBox="0 0 24 24">
                                        <polygon
                                            points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26" />
                                    </svg>
                                    <span
                                        class="sp-card-rating-val">{{ $avgR > 0 ? number_format($avgR, 1) : '—' }}</span>
                                    <span class="sp-card-rating-ct">({{ $rCount }})</span>
                                </div>
                            </div>

                            <div class="sp-card-body">
                                <div class="sp-biz-name">{{ $bizName }}</div>

                                @if ($fullName && $fullName !== $bizName)
                                    <div class="sp-owner-name">{{ $fullName }}</div>
                                @endif

                                @if ($tagline)
                                    <div class="sp-tagline">"{{ $tagline }}"</div>
                                @endif

                                @if ($location)
                                    <div class="sp-location">
                                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor"
                                            stroke-width="1.8">
                                            <path
                                                d="M6 1C4.343 1 3 2.343 3 4c0 2.625 3 7 3 7s3-4.375 3-7c0-1.657-1.343-3-3-3z" />
                                            <circle cx="6" cy="4" r="1" />
                                        </svg>
                                        {{ $location }}
                                    </div>
                                @endif

                                <div class="sp-card-divider"></div>
                            </div>
                        </div>
                    @endforeach

                    <div class="sp-no-results" id="spNoResults">
                        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
                            <circle cx="22" cy="22" r="14" />
                            <path d="M34 34l8 8M18 22h8M22 18v8" />
                        </svg>
                        <div class="sp-no-results-title">No suppliers found</div>
                        <p class="sp-no-results-sub">Try adjusting your search or filters.</p>
                    </div>
                </div>
            @else
                <div class="sp-empty reveal">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
                        <circle cx="24" cy="20" r="10" />
                        <path d="M4 44c0-8 9-14 20-14s20 6 20 14" />
                    </svg>
                    <div class="sp-empty-title">No suppliers yet</div>
                    <p class="sp-empty-sub">No verified suppliers in the directory yet.<br>Check back soon.</p>
                </div>
            @endif
        </div>

        <hr class="section-divider">

        {{-- ════════════════════════
             SUPPLIER PACKAGES
        ════════════════════════ --}}
        <div class="pp-section">
            <div class="hs-head">
                <div class="hs-head-l">
                    <div class="hs-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6">
                            <path d="M3 5h14M3 10h14M3 15h10" />
                        </svg>
                    </div>
                    <div>
                        <div class="hs-title"><em>Packages</em></div>
                        <div class="hs-sub">Supplier Packages</div>
                    </div>
                </div>
            </div>

            {{-- Tab filter row --}}
            <div class="pp-tab-row">
                <button class="pp-tab pp-active" onclick="ppFilter(this,'all')">All</button>
                @foreach ($curatedPackages->pluck('event_type')->unique()->filter() as $type)
                    <button class="pp-tab"
                        onclick="ppFilter(this,'{{ $type }}')">{{ $type }}</button>
                @endforeach
            </div>

            {{-- Package grid --}}
            <div class="pp-grid" id="ppGrid">

                @forelse($curatedPackages as $package)
                    <div class="pp-card" data-cat="{{ $package->event_type }}">

                        <div class="pp-badge-wrap">
                            <span class="pp-badge">
                                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path
                                        d="M6 1l1.35 2.73L10.5 4.2 8.25 6.4l.525 3.1L6 7.98 3.225 9.5l.525-3.1L1.5 4.2l3.15-.47z" />
                                </svg>
                                {{ $package->event_type ?? 'Package' }}
                            </span>
                        </div>

                        <div class="pp-body">
                            <div class="pp-title-row">
                                <div class="pp-pkg-name">{{ $package->name }}</div>
                                <div class="pp-price">₱{{ number_format($package->price, 0) }}</div>
                            </div>

                            <div class="pp-meta">
                                @if ($package->guest_capacity)
                                    <span class="pp-chip">
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor"
                                            stroke-width="1.6">
                                            <circle cx="6" cy="5" r="2.5" />
                                            <path d="M1.5 14c0-2.5 2-4.5 4.5-4.5s4.5 2 4.5 4.5" />
                                            <circle cx="12" cy="5" r="2" />
                                            <path d="M14.5 13.5c0-1.93-1.34-3.5-3-3.5" />
                                        </svg>
                                        {{ $package->guest_capacity }} guests
                                    </span>
                                @endif
                                @if ($package->duration_hours)
                                    <span class="pp-chip">
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor"
                                            stroke-width="1.6">
                                            <circle cx="8" cy="8" r="6.5" />
                                            <path d="M8 4.5v4l2.5 1.5" />
                                        </svg>
                                        {{ $package->duration_hours }}h
                                    </span>
                                @endif
                            </div>

                            @if ($package->inclusions && $package->inclusions->count())
                                <div class="pp-inc-label">Inclusions</div>
                                <ul class="pp-inc-list">
                                    @foreach ($package->inclusions->take(4) as $inc)
                                        <li>
                                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor"
                                                stroke-width="2">
                                                <path d="M2 6l3 3 5-5" />
                                            </svg>
                                            {{ $inc->title }}
                                        </li>
                                    @endforeach
                                    @if ($package->inclusions->count() > 4)
                                        <li style="color: var(--warm-grey); font-style: italic;">
                                            + {{ $package->inclusions->count() - 4 }} more
                                        </li>
                                    @endif
                                </ul>
                            @endif
                        </div>

                        <div class="pp-foot">
                            @if ($package->supplier ?? null)
                                <div class="pp-supplier-micro">
                                    @if ($package->supplier->photo)
                                        <img src="{{ asset('storage/' . $package->supplier->photo) }}"
                                            alt="{{ $package->supplier->business_name }}">
                                    @else
                                        <div class="pp-supplier-micro-init">
                                            {{ strtoupper(substr($package->supplier->business_name ?? 'S', 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="pp-supplier-name">
                                        {{ $package->supplier->business_name ?? '' }}
                                    </span>
                                </div>
                            @else
                                <span></span>
                            @endif

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
                                    Bid
                                </button>
                            @endif

                            <button type="button" class="btn-book"
                                onclick="openBookingModal(
                                    {{ $package->id }},
                                    '{{ addslashes($package->name) }}',
                                    '{{ number_format($package->price, 0) }}'
                                )">
                                <span>Book Now</span>
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6 3l5 5-5 5" />
                                </svg>
                            </button>
                        </div>

                    </div>
                @empty
                    <div class="pp-no-results visible">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="11" cy="11" r="8" />
                            <path d="M21 21l-4.35-4.35" />
                        </svg>
                        <h3>No packages found</h3>
                        <p>Check back soon — suppliers are adding new packages.</p>
                    </div>
                @endforelse

                <div class="pp-no-results" id="ppNoResults">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="11" cy="11" r="8" />
                        <path d="M21 21l-4.35-4.35" />
                    </svg>
                    <h3>No packages found</h3>
                    <p>Try selecting a different event type.</p>
                </div>
            </div>

        </div>{{-- /pp-section --}}

    </div>{{-- /main-wrap --}}

    {{-- ══════════════════════════════
         BOOKING MODAL
    ══════════════════════════════ --}}
    <div id="bookingModal" class="bv-modal-backdrop" role="dialog" aria-modal="true"
        aria-labelledby="bvModalTitle">
        <div class="bv-modal">

            <div class="bv-modal-header">
                <div class="bv-modal-header-inner">
                    <div class="bv-modal-header-accent"></div>
                    <div class="bv-modal-title-wrap">
                        <div class="bv-modal-eyebrow">Reservation</div>
                        <div class="bv-modal-title" id="bvModalTitle">Book a <em>Package</em></div>
                    </div>
                </div>
                <button class="bv-modal-close" onclick="closeBookingModal()" aria-label="Close modal">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" width="14"
                        height="14">
                        <path d="M3 3l10 10M13 3L3 13" />
                    </svg>
                </button>
            </div>

            <form id="bookingForm" method="POST" action="{{ route('client.bookings.store') }}"
                style="display:contents;">
                @csrf
                <input type="hidden" name="package_id" id="modal_package_id">

                <div class="bv-modal-body">

                    <div class="modal-pkg-info">
                        <span class="modal-pkg-dot"></span>
                        <div>
                            <div class="modal-pkg-name" id="modal_pkg_name">—</div>
                            <div class="modal-pkg-price" id="modal_pkg_price">—</div>
                        </div>
                    </div>

                    @php
                        /**
                         * IMPORTANT: Only show events that are still bookable.
                         * Events that have been "cancelled" or "completed" are
                         * intentionally excluded from this dropdown — a client
                         * cannot attach a new package booking to an event that
                         * is already finished or no longer happening. If they
                         * only have cancelled/completed events (or none at all),
                         * they'll see the "no events available" warning below
                         * and can create a brand new event instead.
                         */
                        $events = App\Models\Event::where('user_id', auth()->id())
                            ->whereNotIn('status', ['cancelled', 'completed'])
                            ->orderBy('event_date', 'asc')
                            ->get();
                    @endphp

                    <div class="bv-field">
                        <label class="bv-label" for="modal_event_id">Select your event</label>
                        <select name="event_id" id="modal_event_id" class="bv-select" required
                            {{ $events->isEmpty() ? 'disabled' : '' }}>
                            @forelse($events as $event)
                                <option value="{{ $event->id }}">
                                    {{ $event->event_name }} —
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}
                                </option>
                            @empty
                                <option value="" disabled selected>No events available</option>
                            @endforelse
                        </select>
                    </div>

                    @if ($events->isEmpty())
                        <div class="bv-alert-warn">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M10 2l8 16H2L10 2z" />
                                <path d="M10 9v4M10 15h.01" />
                            </svg>
                            <div>
                                <div style="margin-bottom:.55rem; font-size:.78rem; color:#7a5a10; line-height:1.5;">
                                    You don't have any active events yet. Create one first, then come back to book
                                    this package.
                                </div>
                                <button type="button" class="date-hero-add" onclick="openCreate(null)">
                                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="7" cy="7" r="6" stroke-width="1.5" />
                                        <path d="M7 4v6M4 7h6" />
                                    </svg>
                                    Add Event
                                </button>
                            </div>
                        </div>
                    @endif

                </div>

                <div class="bv-modal-footer">
                    <button type="button" class="btn-cancel-modal" onclick="closeBookingModal()">Cancel</button>
                    <button type="submit" id="btnConfirm" class="btn-confirm"
                        {{ $events->isEmpty() ? 'disabled' : '' }}>
                        <div class="btn-spinner"></div>
                        <span>Confirm Booking</span>
                    </button>
                </div>
            </form>

        </div>
    </div>

    {{-- ══════════════════════════════
         CREATE EVENT MODAL
    ══════════════════════════════ --}}
    <div class="mo-overlay" id="createOverlay" onclick="if(event.target===this)closeCreate()">
        <div class="mo-box">

            <div class="mo-head">
                <div class="mo-head-l">
                    <div class="mo-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="2" y="4" width="16" height="13" rx="2" />
                            <path d="M2 8h16M6 2v3M14 2v3M10 11v4M8 13h4" />
                        </svg>
                    </div>
                    <div class="mo-title">Create New Event</div>
                </div>
                <button type="button" class="mo-close" onclick="closeCreate()" aria-label="Close">
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M1 1l10 10M11 1L1 11" />
                    </svg>
                </button>
            </div>

            <form method="POST" action="{{ route('client.events.store') }}" style="display:contents;">
                @csrf

                <div class="mo-body">

                    <div class="mo-date-chip" id="createDateChip" style="display:none;">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="1" y="2.5" width="12" height="10" rx="1.5" />
                            <path d="M1 6h12M4.5 1v2.5M9.5 1v2.5" />
                        </svg>
                        <span id="createDateChipText"></span>
                    </div>

                    <div class="mo-field">
                        <label class="mo-lbl">
                            Event Name
                            <span class="mo-req">Required</span>
                        </label>
                        <input type="text" name="event_name" id="cr_name" class="mo-inp"
                            placeholder="e.g. Grand Wedding Reception" required>
                    </div>

                    <div class="mo-fg" style="margin-bottom:.85rem;">
                        <div>
                            @php
                                $eventcategories = App\Models\Eventcategory::all();
                            @endphp
                            <label class="mo-lbl">
                                Event Type
                                <span class="mo-req">Required</span>
                            </label>
                            <div class="mo-sw">
                                <select name="event_type" class="mo-sel" required>
                                    <option value="" disabled selected>Select type…</option>
                                    @foreach ($eventcategories as $ec)
                                        <option value="{{ $ec->name }}"
                                            {{ old('event_type') == $ec->name ? 'selected' : '' }}>
                                            {{ $ec->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="mo-lbl">
                                Date
                                <span class="mo-req">Required</span>
                            </label>
                            <input type="date" name="event_date" id="cr_date" class="mo-inp" required>
                        </div>
                    </div>

                    <div class="mo-fg" style="margin-bottom:.85rem;">
                        <div>
                            <label class="mo-lbl">
                                Event Time
                                <span class="mo-opt">Optional</span>
                            </label>
                            <input type="time" name="event_time" class="mo-inp">
                        </div>
                        <div>
                            <label class="mo-lbl">
                                Location
                                <span class="mo-opt">Optional</span>
                            </label>
                            <input type="text" name="location" class="mo-inp" placeholder="e.g. Cebu City">
                        </div>
                    </div>

                    <div class="mo-fg" style="margin-bottom:.85rem;">
                        <div>
                            <label class="mo-lbl">
                                Budget
                                <span class="mo-req">Required</span>
                            </label>
                            <input type="number" name="budget" class="mo-inp" placeholder="e.g. 150000"
                                min="0" step="0.01" required>
                        </div>
                        <div>
                            <label class="mo-lbl">
                                Guests
                                <span class="mo-opt">Optional</span>
                            </label>
                            <input type="number" name="guest_count" class="mo-inp" placeholder="e.g. 200"
                                min="1">
                        </div>
                    </div>

                    <div class="mo-field">
                        <label class="mo-lbl">
                            Venue
                            <span class="mo-opt">Optional</span>
                        </label>
                        <input type="text" name="venue" class="mo-inp"
                            placeholder="e.g. Grand Ballroom, Cebu City">
                    </div>

                    <div class="mo-field">
                        <label class="mo-lbl">
                            Description
                            <span class="mo-opt">Optional</span>
                        </label>
                        <textarea name="description" class="mo-ta" placeholder="Any extra details about your event…"></textarea>
                    </div>

                </div>{{-- /mo-body --}}

                <div class="mo-foot">
                    <button type="button" class="mo-btn-cancel" onclick="closeCreate()">Cancel</button>
                    <button type="submit" class="mo-btn-save">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 7l4 4 6-6" />
                        </svg>
                        Save Event
                    </button>
                </div>
            </form>

        </div>
    </div>

    {{-- ══════════════════════════════════════════
         BID MODAL — white header design
    ══════════════════════════════════════════ --}}
    <div class="bid-overlay" id="bidOverlay" onclick="bidOverlayClick(event)">
        <div class="bid-modal" role="dialog" aria-modal="true" aria-labelledby="bidModalTitle">

            {{-- Header — white, matching booking modal --}}
            <div class="bid-modal-header">
                <div class="bid-modal-header-l">
                    <div class="bid-modal-accent"></div>
                    <div>
                        <div class="bid-modal-eyebrow">Negotiation</div>
                        <div class="bid-modal-title" id="bidModalTitle">Send an <em>Offer</em></div>
                    </div>
                </div>
                <button class="bid-modal-close" onclick="closeBidModal()" aria-label="Close modal">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 3l10 10M13 3L3 13" />
                    </svg>
                </button>
            </div>

            {{-- Body --}}
            <div class="bid-modal-body">

                {{-- Package summary strip --}}
                <div class="bid-pkg-strip">
                    <div class="bid-pkg-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M3 7h14M3 7V5a2 2 0 012-2h10a2 2 0 012 2v2M3 7l2 9a2 2 0 002 2h6a2 2 0 002-2l2-9" />
                        </svg>
                    </div>
                    <div class="bid-pkg-info">
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

                    <div class="bid-field" style="margin-top: 0.2rem;">
                        <label class="bid-label">
                            Message
                            <span style="font-size:0.58rem; font-weight:600; letter-spacing:0.05em; text-transform:uppercase; color:var(--warm-grey); background:var(--border); padding:1px 6px; border-radius:4px;">Optional</span>
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

    {{-- Toast --}}
    <div id="bvToast" class="bv-toast" role="status" aria-live="polite"></div>

    <script>
        /* ── HAMBURGER / MOBILE DRAWER ── */
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');

        if (hamburger && mobileMenu) {
            hamburger.addEventListener('click', () => {
                const open = mobileMenu.classList.toggle('open');
                hamburger.classList.toggle('open', open);
                document.body.style.overflow = open ? 'hidden' : '';
            });

            document.addEventListener('click', e => {
                if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) {
                    mobileMenu.classList.remove('open');
                    hamburger.classList.remove('open');
                    document.body.style.overflow = '';
                }
            });
        }

        function closeMenu() {
            if (mobileMenu) mobileMenu.classList.remove('open');
            if (hamburger) hamburger.classList.remove('open');
            document.body.style.overflow = '';
        }

        /* ── PACKAGE TAB FILTER ── */
        function ppFilter(btn, cat) {
            document.querySelectorAll('.pp-tab').forEach(t => t.classList.remove('pp-active'));
            btn.classList.add('pp-active');

            const cards = document.querySelectorAll('#ppGrid .pp-card');
            let visible = 0;

            cards.forEach(card => {
                const show = (cat === 'all') || (card.dataset.cat === cat);
                card.classList.toggle('pp-hidden', !show);
                if (show) visible++;
            });

            const noRes = document.getElementById('ppNoResults');
            if (noRes) noRes.classList.toggle('visible', visible === 0);
        }

        /* ════════════════════════════════
           BOOKING MODAL
        ════════════════════════════════ */
        const bookingModal = document.getElementById('bookingModal');

        function openBookingModal(pkgId, pkgName, pkgPrice) {
            document.getElementById('modal_package_id').value = pkgId;
            document.getElementById('modal_pkg_name').textContent = pkgName;
            document.getElementById('modal_pkg_price').textContent = '₱' + pkgPrice;

            const btn = document.getElementById('btnConfirm');
            btn.classList.remove('loading');

            bookingModal.classList.add('open');
            document.body.style.overflow = 'hidden';

            const sel = document.getElementById('modal_event_id');
            if (sel && !sel.disabled) {
                setTimeout(() => sel.focus(), 120);
            }
        }

        function closeBookingModal() {
            bookingModal.classList.remove('open');
            document.body.style.overflow = '';
        }

        bookingModal.addEventListener('click', function(e) {
            if (e.target === this) closeBookingModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (document.getElementById('createOverlay').classList.contains('open')) {
                    closeCreate();
                } else if (document.getElementById('bidOverlay').classList.contains('open')) {
                    closeBidModal();
                } else if (bookingModal.classList.contains('open')) {
                    closeBookingModal();
                }
            }
        });

        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('btnConfirm');
            if (btn.classList.contains('loading')) {
                e.preventDefault();
                return;
            }
            btn.classList.add('loading');
        });

        /* ════════════════════════════════
           CREATE EVENT MODAL
        ════════════════════════════════ */
        const createOverlay = document.getElementById('createOverlay');

        function openCreate(dateStr) {
            const chipWrap = document.getElementById('createDateChip');
            const chipText = document.getElementById('createDateChipText');
            const dateInput = document.getElementById('cr_date');

            if (dateStr) {
                if (dateInput) dateInput.value = dateStr;
                const d = new Date(dateStr + 'T00:00:00');
                const friendly = d.toLocaleDateString('en-PH', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                chipText.textContent = friendly;
                chipWrap.style.display = 'inline-flex';
            } else {
                chipWrap.style.display = 'none';
                chipText.textContent = '';
                if (dateInput) dateInput.value = '';
            }

            createOverlay.classList.add('open');
            document.body.style.overflow = 'hidden';

            setTimeout(() => {
                const first = document.getElementById('cr_name');
                if (first) first.focus();
            }, 120);
        }

        function closeCreate() {
            createOverlay.classList.remove('open');
            if (!bookingModal.classList.contains('open')) {
                document.body.style.overflow = '';
            }
        }

        /* ── Toast helper ── */
        function showToast(message, isError = false) {
            const toast = document.getElementById('bvToast');
            toast.textContent = message;
            toast.classList.toggle('bv-toast-error', isError);
            toast.classList.add('visible');
            setTimeout(() => toast.classList.remove('visible'), 4000);
        }

        @if (session('success'))
            showToast(@json(session('success')));
        @endif
        @if (session('error'))
            showToast(@json(session('error')), true);
        @endif

        /* ════════════════════════════════
           BID MODAL
        ════════════════════════════════ */
        function openBidModal(packageId, pkgName, pkgPrice, minPrice, maxPrice, supplierName) {
            document.getElementById('bidPkgName').textContent = pkgName;
            document.getElementById('bidPkgMeta').textContent = supplierName + ' · Listed Price';
            document.getElementById('bidPkgBadge').textContent = '₱' + pkgPrice;

            const input = document.getElementById('bidOfferInput');
            input.min = minPrice > 0 ? minPrice : 0.01;
            input.max = maxPrice;
            input.value = '';

            const hint = document.getElementById('bidRangeText');
            if (minPrice > 0) {
                hint.innerHTML = 'Accepted range: <strong>₱' + Number(minPrice).toLocaleString() +
                    '</strong> – <strong>₱' + Number(maxPrice).toLocaleString() + '</strong>';
            } else {
                hint.innerHTML = 'Your offer must not exceed <strong>₱' +
                    Number(maxPrice).toLocaleString() + '</strong>';
            }

            document.getElementById('bidForm').action =
                "{{ url('/client/bids/package') }}/" + packageId;

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

        function submitBid() {
            const form = document.getElementById('bidForm');
            if (form.reportValidity()) form.submit();
        }
    </script>

</x-client-layout>