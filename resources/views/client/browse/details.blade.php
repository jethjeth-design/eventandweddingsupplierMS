<x-client-layout>

{{-- ═══════════════════════════════════════════════════════════
     resources/views/client/supplier/show.blade.php
     Bikol's Craft — gold / ivory / charcoal design system
     $suppliers  = collection (loop below)
     $supplier   = last item reference used outside loop (modal)
════════════════════════════════════════════════════════════════ --}}

    <style>
        /* ── CSS VARIABLES ── */
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

        /* ── GOOGLE FONTS (if not already loaded by layout) ── */
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap');

        /* ── PAGE ── */
        .page-wrap {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2rem 1.5rem 5rem;
            font-family: var(--font-body);
        }

        /* ── SLIM PAGE HEADER ── */
        .client-page-header {
            background: var(--charcoal);
            padding: 2rem 1.5rem 1.75rem;
            margin: -2rem -1.5rem 2rem;
            position: relative; overflow: hidden;
            border-bottom: 2px solid rgba(201,168,76,0.3);
        }
        .client-page-header::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px);
            background-size: 22px 22px;
        }
        .client-page-header::after {
            content: '';
            position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }
        .cph-inner { position: relative; z-index: 1; }
        .cph-eyebrow {
            font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase;
            color: var(--gold); font-weight: 500;
            display: flex; align-items: center; gap: 0.55rem; margin-bottom: 0.5rem;
        }
        .cph-eyebrow::before { content: ''; display: block; width: 22px; height: 1px; background: var(--gold); }
        .client-page-header h1 {
            font-family: var(--font-display);
            font-size: clamp(1.4rem, 3vw, 2rem);
            font-weight: 700; color: var(--white); line-height: 1.15;
        }
        .client-page-header h1 em { color: var(--gold-light); font-style: italic; }

        /* ── SUCCESS ALERT ── */
        .alert-success {
            background: #F0FDF4; color: #15803D;
            border: 1px solid #BBF7D0; border-radius: 3px;
            padding: 0.85rem 1.25rem; font-size: 0.875rem;
            margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;
            font-family: var(--font-body);
        }

        /* ══════════════════════════════
        PROFILE CARD
        ══════════════════════════════ */
        .profile-card {
            background: var(--white);
            border: 1px solid var(--border); border-radius: 4px;
            margin-bottom: 1.5rem; overflow: hidden; position: relative;
        }
        .profile-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, var(--gold), var(--blush-deep), var(--gold));
        }

        /* Mini banner inside card */
        .profile-banner {
            height: 130px; background: var(--charcoal); position: relative; overflow: hidden;
        }
        .profile-banner-grad {
            position: absolute; inset: 0;
            background: linear-gradient(135deg, #1E1B18 0%, #374151 55%, #2D2A27 100%);
        }
        .profile-banner-dots {
            position: absolute; inset: 0; opacity: 0.06;
            background-image: radial-gradient(#fff 1px, transparent 1px);
            background-size: 22px 22px;
        }

        /* Top row */
        .profile-top {
            padding: 0 1.75rem 1.5rem;
            display: flex; gap: 1.5rem;
            align-items: flex-end; flex-wrap: wrap;
            margin-top: -40px; position: relative; z-index: 2;
        }
        .profile-photo {
            width: 84px; height: 84px; border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--white);
            box-shadow: 0 4px 16px rgba(30,27,24,0.15);
            flex-shrink: 0; background: #E0D8D0;
        }
        .profile-photo-fb {
            width: 84px; height: 84px; border-radius: 50%;
            border: 3px solid var(--white);
            box-shadow: 0 4px 16px rgba(30,27,24,0.15);
            flex-shrink: 0; background: var(--charcoal);
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display); font-size: 1.8rem;
            font-weight: 700; color: var(--gold);
        }
        .profile-title-group { flex: 1; min-width: 180px; padding-top: 46px; }
        .profile-name {
            font-family: var(--font-display);
            font-size: 1.5rem; font-weight: 700;
            color: var(--charcoal); letter-spacing: -0.01em; line-height: 1.15;
        }
        .profile-person { font-size: 0.8rem; color: var(--warm-grey); margin-top: 1px; }
        .profile-tagline { font-size: 0.85rem; color: var(--warm-grey); font-style: italic; margin-top: 5px; }
        .profile-location {
            display: flex; align-items: center; gap: 0.32rem;
            font-size: 0.75rem; color: var(--warm-grey); margin-top: 5px;
        }
        .profile-location svg { color: var(--gold-dark); opacity: 0.8; }
        .profile-aside {
            display: flex; flex-direction: column; gap: 7px;
            align-items: flex-end; padding-top: 46px; flex-shrink: 0;
        }

        /* Pills */
        .pill-star {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 0.82rem; font-weight: 500; color: var(--charcoal);
            background: #FFFBEB; border: 1px solid #FDE68A;
            padding: 5px 12px; border-radius: 2px;
            font-family: var(--font-body);
        }
        .star-icon { color: var(--gold); }
        .pill-price {
            display: inline-flex; align-items: center; gap: 4px;
            font-size: 0.8rem; font-weight: 500; color: var(--charcoal);
            background: var(--ivory); border: 1px solid var(--border-md);
            padding: 5px 12px; border-radius: 2px;
            font-family: var(--font-body);
        }
        .pill-price span { font-size: 0.68rem; color: var(--warm-grey); font-weight: 400; }
        .pill-avail {
            font-size: 0.65rem; font-weight: 600; letter-spacing: 0.05em;
            text-transform: uppercase; padding: 4px 10px; border-radius: 2px;
            display: inline-flex; align-items: center; gap: 5px;
            font-family: var(--font-body);
        }
        .pill-avail.yes { background: #F0FDF4; color: #15803D; border: 1px solid #BBF7D0; }
        .pill-avail.no  { background: #FFFBEB; color: #B45309; border: 1px solid #FDE68A; }
        .avail-dot { width: 6px; height: 6px; border-radius: 50%; }
        .pill-avail.yes .avail-dot { background: #22C55E; }
        .pill-avail.no  .avail-dot { background: #F59E0B; }
        .contact-btn {
            padding: 0.58rem 1.35rem;
            background: var(--gold); color: var(--charcoal);
            border: none; border-radius: 2px;
            font-size: 0.78rem; font-weight: 500; letter-spacing: 0.05em;
            text-transform: uppercase; cursor: pointer; font-family: var(--font-body);
            transition: background 0.2s; white-space: nowrap;
        }
        .contact-btn:hover { background: var(--gold-light); }

        /* Tags row */
        .profile-tags {
            padding: 1rem 1.75rem 1.25rem;
            display: flex; gap: 0.45rem; flex-wrap: wrap;
            border-top: 1px solid var(--border);
        }
        .chip {
            font-size: 0.62rem; font-weight: 600; letter-spacing: 0.07em;
            text-transform: uppercase; color: var(--gold-dark);
            background: rgba(201,168,76,0.09); border: 1px solid rgba(201,168,76,0.25);
            padding: 3px 10px; border-radius: 2px; font-family: var(--font-body);
        }

        /* ══════════════════════════════
        STATS STRIP
        ══════════════════════════════ */
        .stats-strip {
            display: grid; grid-template-columns: repeat(4, 1fr);
            background: var(--white);
            border: 1px solid var(--border); border-radius: 4px;
            overflow: hidden; margin-bottom: 1.5rem;
        }
        .stat-cell {
            padding: 1.25rem 0.75rem; text-align: center;
            border-right: 1px solid var(--border); transition: background 0.2s;
        }
        .stat-cell:last-child { border-right: none; }
        .stat-cell:hover { background: rgba(201,168,76,0.03); }
        .stat-n {
            font-family: var(--font-display);
            font-size: 1.6rem; font-weight: 700; color: var(--gold-dark);
            display: block; line-height: 1;
        }
        .stat-l {
            font-size: 0.62rem; letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--warm-grey); margin-top: 4px; font-family: var(--font-body);
        }

        /* ══════════════════════════════
        TWO-COL LAYOUT
        ══════════════════════════════ */
        .two-col {
            display: grid;
            grid-template-columns: 1fr 290px;
            gap: 1.5rem; align-items: start;
        }

        /* ══════════════════════════════
        SECTION CARDS (left col)
        ══════════════════════════════ */
        .sec-card {
            background: var(--white);
            border: 1px solid var(--border); border-radius: 4px;
            margin-bottom: 1.5rem; overflow: hidden; position: relative;
        }
        .sec-card:last-child { margin-bottom: 0; }
        .sec-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, var(--gold), var(--blush-deep));
            transform: scaleX(0); transform-origin: left;
            transition: transform 0.3s ease;
        }
        .sec-card:hover::before { transform: scaleX(1); }
        .sec-header {
            padding: 1rem 1.5rem 0.9rem;
            border-bottom: 1px solid var(--border);
        }
        .sec-eyebrow {
            font-size: 0.62rem; font-weight: 600; letter-spacing: 0.18em;
            text-transform: uppercase; color: var(--gold-dark);
            display: flex; align-items: center; gap: 0.5rem;
            margin-bottom: 2px; font-family: var(--font-body);
        }
        .sec-eyebrow::after { content: ''; display: inline-block; width: 18px; height: 1px; background: var(--gold); vertical-align: middle; }
        .sec-title {
            font-family: var(--font-display);
            font-size: 1rem; font-weight: 600; color: var(--charcoal);
        }
        .sec-body { padding: 1.4rem 1.5rem; }
        .sec-text { font-size: 0.875rem; color: var(--warm-grey); line-height: 1.8; font-family: var(--font-body); }

        /* Experience highlight box */
        .exp-box {
            background: var(--ivory); border: 1px solid var(--border);
            border-radius: 3px; padding: 1rem 1.25rem; margin-top: 1rem;
        }
        .exp-label {
            font-size: 0.62rem; font-weight: 600; text-transform: uppercase;
            letter-spacing: 0.1em; color: var(--gold-dark); margin-bottom: 4px;
            font-family: var(--font-body);
        }
        .exp-text { font-size: 0.875rem; color: var(--warm-grey); line-height: 1.7; font-family: var(--font-body); }

        /* Detail list */
        .detail-list { list-style: none; }
        .detail-item {
            display: flex; gap: 0.85rem; align-items: flex-start;
            padding: 0.8rem 0; border-bottom: 1px solid var(--border);
        }
        .detail-item:first-child { padding-top: 0; }
        .detail-item:last-child  { border-bottom: none; padding-bottom: 0; }
        .detail-icon {
            width: 30px; height: 30px; flex-shrink: 0;
            background: var(--ivory); border: 1px solid var(--border-md);
            border-radius: 3px; display: flex; align-items: center; justify-content: center;
        }
        .detail-icon svg { color: var(--gold-dark); opacity: 0.8; }
        .detail-lbl {
            font-size: 0.62rem; font-weight: 600; text-transform: uppercase;
            letter-spacing: 0.07em; color: var(--warm-grey); margin-bottom: 2px;
            font-family: var(--font-body);
        }
        .detail-val { font-size: 0.875rem; color: var(--charcoal); font-family: var(--font-body); }
        .detail-val a { color: var(--charcoal); text-decoration: underline; text-underline-offset: 3px; }

        /* Rating */
        .rating-summary { display: flex; gap: 1.5rem; align-items: center; }
        .rating-big {
            font-family: var(--font-display);
            font-size: 2.8rem; font-weight: 700; color: var(--charcoal); line-height: 1; flex-shrink: 0;
        }
        .rating-stars { display: flex; gap: 2px; margin: 5px 0; }
        .rating-stars .s  { color: var(--gold); font-size: 14px; }
        .rating-stars .se { color: #D8D0C8; font-size: 14px; }
        .rating-count { font-size: 0.72rem; color: var(--warm-grey); font-family: var(--font-body); }
        .bar-rows { flex: 1; }
        .bar-row {
            display: flex; align-items: center; gap: 6px;
            font-size: 0.7rem; color: var(--warm-grey); margin-bottom: 4px;
            font-family: var(--font-body);
        }
        .bar-row span:first-child { width: 8px; text-align: right; flex-shrink: 0; }
        .bar-track {
            flex: 1; height: 5px; background: var(--ivory);
            border: 1px solid var(--border); border-radius: 99px; overflow: hidden;
        }
        .bar-fill { height: 100%; background: var(--gold); border-radius: 99px; }

        /* ══════════════════════════════
        SIDEBAR CARDS (right col)
        ══════════════════════════════ */
        .sidebar-card {
            background: var(--white);
            border: 1px solid var(--border); border-radius: 4px;
            margin-bottom: 1.5rem; overflow: hidden;
        }
        .sidebar-card:last-child { margin-bottom: 0; }
        .sc-header {
            padding: 0.85rem 1.25rem;
            border-bottom: 1px solid var(--border);
            font-size: 0.62rem; font-weight: 600; letter-spacing: 0.16em;
            text-transform: uppercase; color: var(--gold-dark);
            display: flex; align-items: center; gap: 0.5rem;
            font-family: var(--font-body);
        }
        .sc-header::after { content: ''; flex: 1; height: 1px; background: linear-gradient(90deg, var(--gold), transparent); }
        .sc-body { padding: 1.1rem 1.25rem; }

        /* Contact rows */
        .contact-row {
            display: flex; gap: 9px; align-items: flex-start;
            padding: 8px 0; border-bottom: 1px solid var(--border);
        }
        .contact-row:first-child { padding-top: 0; }
        .contact-row:last-child  { border-bottom: none; padding-bottom: 0; }
        .c-icon {
            width: 28px; height: 28px; flex-shrink: 0;
            background: var(--ivory); border: 1px solid var(--border-md);
            border-radius: 3px; display: flex; align-items: center; justify-content: center;
        }
        .c-icon svg { color: var(--gold-dark); opacity: 0.75; }
        .c-lbl {
            font-size: 0.6rem; font-weight: 600; text-transform: uppercase;
            letter-spacing: 0.07em; color: var(--warm-grey); margin-bottom: 1px;
            font-family: var(--font-body);
        }
        .c-val { font-size: 0.82rem; color: var(--charcoal); font-family: var(--font-body); }
        .c-val a { color: var(--charcoal); text-decoration: underline; text-underline-offset: 3px; }

        /* Pricing */
        .price-display { text-align: center; padding: 0.25rem 0 0.5rem; }
        .price-from {
            font-size: 0.62rem; text-transform: uppercase; letter-spacing: 0.1em;
            color: var(--warm-grey); margin-bottom: 4px; font-family: var(--font-body);
        }
        .price-amount {
            font-family: var(--font-display);
            font-size: 2rem; font-weight: 700; color: var(--charcoal); line-height: 1;
        }
        .price-note { font-size: 0.7rem; color: var(--warm-grey); margin-top: 4px; font-family: var(--font-body); }

        /* Buttons */
        .full-btn {
            display: block; width: 100%; margin-top: 1rem; padding: 0.68rem;
            text-align: center; background: var(--gold); color: var(--charcoal);
            border: none; border-radius: 2px;
            font-size: 0.75rem; font-weight: 500; letter-spacing: 0.05em;
            text-transform: uppercase; cursor: pointer; font-family: var(--font-body);
            transition: background 0.2s; text-decoration: none;
        }
        .full-btn:hover { background: var(--gold-light); }
        .outline-btn {
            display: block; width: 100%; margin-top: 0.5rem; padding: 0.65rem;
            text-align: center; background: transparent; color: var(--charcoal);
            border: 1px solid rgba(30,27,24,0.18); border-radius: 2px;
            font-size: 0.75rem; font-weight: 500; letter-spacing: 0.05em;
            text-transform: uppercase; cursor: pointer; font-family: var(--font-body);
            transition: border-color 0.2s, color 0.2s; text-decoration: none;
        }
        .outline-btn:hover { border-color: var(--gold); color: var(--gold-dark); }

        /* ══════════════════════════════
        INQUIRY MODAL
        ══════════════════════════════ */
        .modal-backdrop {
            position: fixed; inset: 0;
            background: rgba(30,27,24,0.55); z-index: 200;
            display: flex; align-items: center; justify-content: center;
            padding: 1.5rem; overflow-y: auto;
        }
        .modal-box {
            background: var(--white); border-radius: 4px;
            width: 520px; max-width: 100%;
            border-top: 2px solid var(--gold);
            max-height: 92vh; display: flex; flex-direction: column;
            margin: auto; flex-shrink: 0;
            box-shadow: 0 16px 48px rgba(30,27,24,0.2);
        }
        .modal-hd {
            flex-shrink: 0; display: flex; align-items: center; justify-content: space-between;
            padding: 1.1rem 1.5rem; border-bottom: 1px solid var(--border);
        }
        .modal-hd-title {
            font-family: var(--font-display);
            font-size: 1.05rem; font-weight: 600; color: var(--charcoal);
        }
        .modal-hd-sub { font-size: 0.72rem; color: var(--warm-grey); margin-top: 1px; font-family: var(--font-body); }
        .modal-x {
            width: 28px; height: 28px;
            border: 1px solid var(--border); background: var(--ivory); border-radius: 2px;
            cursor: pointer; font-size: 18px; color: var(--warm-grey);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
            transition: border-color 0.2s;
        }
        .modal-x:hover { border-color: var(--gold); color: var(--gold-dark); }
        .modal-body { padding: 1.35rem 1.5rem; overflow-y: auto; flex: 1; min-height: 0; }
        .modal-footer {
            flex-shrink: 0; padding: 0.85rem 1.5rem;
            border-top: 1px solid var(--border);
            display: flex; gap: 0.65rem; justify-content: flex-end;
        }
        .fm-field { display: flex; flex-direction: column; gap: 5px; margin-bottom: 1rem; }
        .fm-field:last-child { margin-bottom: 0; }
        .fm-lbl {
            font-size: 0.7rem; font-weight: 500; color: var(--warm-grey);
            letter-spacing: 0.04em; font-family: var(--font-body);
        }
        .fm-in {
            width: 100%; padding: 0.58rem 0.85rem;
            border: 1px solid var(--border-md); border-radius: 3px;
            font-size: 0.875rem; color: var(--charcoal);
            background: var(--ivory); outline: none;
            font-family: var(--font-body);
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .fm-in:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,0.12); }
        .fm-in:disabled { opacity: 0.55; cursor: not-allowed; background: #F5F0EB; }
        textarea.fm-in { resize: vertical; min-height: 90px; }
        .fm-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem; }

        /* User info preview box in modal */
        .user-info-box {
            background: var(--ivory); border: 1px solid var(--border);
            border-radius: 3px; padding: 0.9rem 1rem; margin-bottom: 1rem;
            display: flex; align-items: center; gap: 0.75rem;
        }
        .user-info-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--charcoal); flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display); font-size: 0.9rem;
            font-weight: 700; color: var(--gold);
            border: 1.5px solid rgba(201,168,76,0.25);
        }
        .user-info-name { font-size: 0.875rem; font-weight: 500; color: var(--charcoal); font-family: var(--font-body); }
        .user-info-email { font-size: 0.75rem; color: var(--warm-grey); font-family: var(--font-body); }
        .user-info-note {
            font-size: 0.65rem; color: var(--gold-dark); letter-spacing: 0.05em;
            text-transform: uppercase; font-weight: 600;
            background: rgba(201,168,76,0.09); border: 1px solid rgba(201,168,76,0.2);
            padding: 2px 8px; border-radius: 2px; margin-left: auto; flex-shrink: 0;
            font-family: var(--font-body);
        }

        /* ── REVEAL ── */
        .reveal { opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .reveal.visible { opacity: 1; transform: none; }

        /* ── RESPONSIVE ── */
        @media (max-width: 860px) {
            .two-col { grid-template-columns: 1fr; }
            .profile-aside { align-items: flex-start; flex-direction: row; flex-wrap: wrap; padding-top: 0; }
            .profile-title-group { padding-top: 0; }
            .stats-strip { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 480px) {
            .profile-top { flex-direction: column; align-items: flex-start; }
            .fm-grid { grid-template-columns: 1fr; }
        }
    </style>

    <div class="page-wrap">

        {{-- Slim page header --}}
        <div class="client-page-header">
            <div class="cph-inner">
                <div class="cph-eyebrow">Supplier Profile</div>
                <h1>View <em>Supplier</em></h1>
            </div>
        </div>

        @if(session('inquiry_success'))
            <div class="alert-success">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                {{ session('inquiry_success') }}
            </div>
        @endif


        {{-- ══ PROFILE CARD ══ --}}
        <div class="profile-card reveal">
            <div class="profile-banner">
                <div class="profile-banner-grad"></div>
                <div class="profile-banner-dots"></div>
            </div>

            <div class="profile-top">
                {{-- Photo --}}
                @if($supplier->photo)
                    <img class="profile-photo"
                        src="{{ asset('storage/'.$supplier->photo) }}"
                        alt="{{ $supplier->business_name }}">
                @else
                    <div class="profile-photo-fb">
                        {{ strtoupper(substr($supplier->business_name ?? $supplier->first_name, 0, 2)) }}
                    </div>
                @endif

                {{-- Name / tagline / location --}}
                <div class="profile-title-group">
                    <div class="profile-name">{{ $supplier->business_name }}</div>
                    <div class="profile-person">{{ $supplier->first_name }} {{ $supplier->last_name }}</div>
                    @if($supplier->tagline)
                        <div class="profile-tagline">"{{ $supplier->tagline }}"</div>
                    @endif
                    @if($supplier->city || $supplier->province)
                        <div class="profile-location">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            {{ collect([$supplier->city, $supplier->province])->filter()->implode(', ') }}
                        </div>
                    @endif
                </div>

                {{-- Pills + CTA --}}
                <div class="profile-aside">
                    @if($supplier->rating)
                        <div class="pill-star">
                            <span class="star-icon">★</span>
                            {{ number_format($supplier->rating, 1) }}
                            <span style="font-size:0.72rem;color:var(--warm-grey);font-weight:400;">/ 5.0</span>
                        </div>
                    @endif
                    @if($supplier->price)
                        <div class="pill-price">
                            <span>From</span>
                            ₱{{ number_format($supplier->price, 2) }}
                        </div>
                    @endif
                    @if($supplier->is_available)
                        <div class="pill-avail yes">
                            <span class="avail-dot"></span>Available
                        </div>
                    @else
                        <div class="pill-avail no">
                            <span class="avail-dot"></span>Unavailable
                        </div>
                    @endif
                 
                    <a href="{{ route('chat', [$supplier->user_id, $supplier->id]) }}" class="contact-btn">Send Inquiry</a>
                </div>
            </div>

            {{-- Chips --}}
            <div class="profile-tags">
                @if($supplier->category)
                    <span class="chip">{{ $supplier->category }}</span>
                @endif
                @if($supplier->experience)
                    <span class="chip">{{ $supplier->experience }}</span>
                @endif
                @if($supplier->city)
                    <span class="chip">{{ $supplier->city }}</span>
                @endif
            </div>
        </div>

        {{-- ══ STATS STRIP ══ --}}
        <div class="stats-strip reveal">
            <div class="stat-cell">
                <span class="stat-n">{{ $supplier->rating ? number_format($supplier->rating, 1) : '—' }}</span>
                <div class="stat-l">Rating</div>
            </div>
            <div class="stat-cell">
                <span class="stat-n" style="font-size:{{ $supplier->price ? '1.2rem' : '1.6rem' }};">
                    {{ $supplier->price ? '₱'.number_format($supplier->price, 0) : '—' }}
                </span>
                <div class="stat-l">Base Price</div>
            </div>
            <div class="stat-cell">
                <span class="stat-n" style="font-size:1rem;font-family:var(--font-body);font-weight:600;">
                    {{ $supplier->category ?? '—' }}
                </span>
                <div class="stat-l">Category</div>
            </div>
            <div class="stat-cell">
                <span class="stat-n" style="font-size:1rem;font-family:var(--font-body);font-weight:600;color:{{ $supplier->is_available ? '#15803D' : '#B45309' }};">
                    {{ $supplier->is_available ? 'Open' : 'Closed' }}
                </span>
                <div class="stat-l">Status</div>
            </div>
        </div>

        {{-- ══ TWO-COL ══ --}}
        <div class="two-col">

            {{-- ── LEFT ── --}}
            <div>
                {{-- About --}}
                @if($supplier->bio)
                <div class="sec-card reveal">
                    <div class="sec-header">
                        <div class="sec-eyebrow">About</div>
                        <div class="sec-title">Who they are</div>
                    </div>
                    <div class="sec-body">
                        <p class="sec-text">{{ $supplier->bio }}</p>
                        @if($supplier->experience)
                        <div class="exp-box">
                            <div class="exp-label">Experience</div>
                            <p class="exp-text">{{ $supplier->experience }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                {{-- Description --}}
                @if($supplier->description)
                <div class="sec-card reveal">
                    <div class="sec-header">
                        <div class="sec-eyebrow">Services</div>
                        <div class="sec-title">What they offer</div>
                    </div>
                    <div class="sec-body">
                        <p class="sec-text">{{ $supplier->description }}</p>
                    </div>
                </div>
                @endif

                {{-- Details list --}}
                <div class="sec-card reveal">
                    <div class="sec-header">
                        <div class="sec-eyebrow">Details</div>
                        <div class="sec-title">Supplier information</div>
                    </div>
                    <div class="sec-body">
                        <ul class="detail-list">
                            @if($supplier->phone)
                            <li class="detail-item">
                                <div class="detail-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 11.63 19a19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 3.12 4.18 2 2 0 0 1 5.08 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L9.09 9.91A16 16 0 0 0 15 15.91l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>
                                <div><div class="detail-lbl">Phone</div><div class="detail-val"><a href="tel:{{ $supplier->phone }}">{{ $supplier->phone }}</a></div></div>
                            </li>
                            @endif
                            @if($supplier->category)
                            <li class="detail-item">
                                <div class="detail-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg></div>
                                <div><div class="detail-lbl">Category</div><div class="detail-val">{{ $supplier->category }}</div></div>
                            </li>
                            @endif
                            @if($supplier->address)
                            <li class="detail-item">
                                <div class="detail-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
                                <div><div class="detail-lbl">Address</div><div class="detail-val">{{ $supplier->address }}</div></div>
                            </li>
                            @endif
                            @if($supplier->city || $supplier->province)
                            <li class="detail-item">
                                <div class="detail-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
                                <div><div class="detail-lbl">Location</div><div class="detail-val">{{ collect([$supplier->city, $supplier->province])->filter()->implode(', ') }}</div></div>
                            </li>
                            @endif
                            <li class="detail-item">
                                <div class="detail-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
                                <div>
                                    <div class="detail-lbl">Availability</div>
                                    <div class="detail-val" style="color:{{ $supplier->is_available ? '#15803D' : '#B45309' }};font-weight:500;">
                                        {{ $supplier->is_available ? '● Available now' : '● Currently unavailable' }}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Rating --}}
                @if($supplier->rating)
                <div class="sec-card reveal">
                    <div class="sec-header">
                        <div class="sec-eyebrow">Rating</div>
                        <div class="sec-title">Overall score</div>
                    </div>
                    <div class="sec-body">
                        <div class="rating-summary">
                            <div>
                                <div class="rating-big">{{ number_format($supplier->rating, 1) }}</div>
                                <div class="rating-stars">
                                    @for($s = 1; $s <= 5; $s++)
                                        <span class="{{ $s <= round($supplier->rating) ? 's' : 'se' }}">★</span>
                                    @endfor
                                </div>
                                <div class="rating-count">out of 5.0</div>
                            </div>
                            <div class="bar-rows">
                                @foreach([5,4,3,2,1] as $b)
                                    @php $pct = $b <= round($supplier->rating) ? min(96, $b * 17 + rand(0,10)) : rand(2,18); @endphp
                                    <div class="bar-row">
                                        <span>{{ $b }}</span>
                                        <span style="color:var(--gold);font-size:10px;">★</span>
                                        <div class="bar-track"><div class="bar-fill" style="width:{{ $pct }}%;"></div></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            {{-- ── RIGHT SIDEBAR ── --}}
            <div>
                {{-- Contact --}}
                <div class="sidebar-card reveal">
                    <div class="sc-header">Contact Details</div>
                    <div class="sc-body">
                        @if($supplier->phone)
                        <div class="contact-row">
                            <div class="c-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 11.63 19a19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 3.12 4.18 2 2 0 0 1 5.08 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L9.09 9.91A16 16 0 0 0 15 15.91l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>
                            <div><div class="c-lbl">Phone</div><div class="c-val"><a href="tel:{{ $supplier->phone }}">{{ $supplier->phone }}</a></div></div>
                        </div>
                        @endif
                        @if($supplier->city || $supplier->province)
                        <div class="contact-row">
                            <div class="c-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
                            <div><div class="c-lbl">City / Province</div><div class="c-val">{{ collect([$supplier->city, $supplier->province])->filter()->implode(', ') }}</div></div>
                        </div>
                        @endif
                        @if($supplier->address)
                        <div class="contact-row">
                            <div class="c-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
                            <div><div class="c-lbl">Address</div><div class="c-val">{{ $supplier->address }}</div></div>
                        </div>
                        @endif
                        @if($supplier->category)
                        <div class="contact-row">
                            <div class="c-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg></div>
                            <div><div class="c-lbl">Category</div><div class="c-val">{{ $supplier->category }}</div></div>
                        </div>
                        @endif
                        <div class="contact-row">
                            <div class="c-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
                            <div>
                                <div class="c-lbl">Status</div>
                                <div class="c-val" style="font-weight:500;color:{{ $supplier->is_available ? '#15803D' : '#B45309' }};">
                                    {{ $supplier->is_available ? '● Available' : '● Unavailable' }}
                                </div>
                            </div>
                        </div>
                        <button class="full-btn" onclick="openModal({{ $supplier->id }})">Send Inquiry</button>
                        <a href="{{ route('client.suppliers') }}" class="outline-btn">← Back to Suppliers</a>
                    </div>
                </div>

                {{-- Pricing --}}
                @if($supplier->price)
                <div class="sidebar-card reveal">
                    <div class="sc-header">Pricing</div>
                    <div class="sc-body">
                        <div class="price-display">
                            <div class="price-from">Starting price</div>
                            <div class="price-amount">₱{{ number_format($supplier->price, 2) }}</div>
                            <div class="price-note">Final price may vary by scope</div>
                        </div>
                        <button class="full-btn" onclick="openModal({{ $supplier->id }})">Request a Quote</button>
                    </div>
                </div>
                @endif
            </div>

        </div>{{-- end two-col --}}

        {{-- ══ INQUIRY MODAL (per supplier) ══ --}}
        <div id="inq-modal-{{ $supplier->id }}" class="modal-backdrop" style="display:none;">
            <div class="modal-box">
                <div class="modal-hd">
                    <div>
                        <div class="modal-hd-title">Contact {{ $supplier->business_name }}</div>
                        <div class="modal-hd-sub">{{ $supplier->first_name }} {{ $supplier->last_name }}{{ $supplier->category ? ' · '.$supplier->category : '' }}</div>
                    </div>
                    <button class="modal-x" onclick="closeModal({{ $supplier->id }})">&#215;</button>
                </div>

                <form method="POST" action="{{ route('chat.send') }}">
                    @csrf

                    <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">

                    <input type="text" name="message" placeholder="Type message..." required>

                    <button type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>{{-- end page-wrap --}}

    <script>
        /* ── MODAL (per-supplier ID) ── */
        function openModal(id) {
            document.getElementById('inq-modal-' + id).style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        function closeModal(id) {
            document.getElementById('inq-modal-' + id).style.display = 'none';
            document.body.style.overflow = '';
        }
        document.querySelectorAll('.modal-backdrop').forEach(el => {
            el.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.style.display = 'none';
                    document.body.style.overflow = '';
                }
            });
        });

        /* ── SCROLL REVEAL ── */
        const reveals = document.querySelectorAll('.reveal');
        const io = new IntersectionObserver(entries => {
            entries.forEach((e, i) => {
                if (e.isIntersecting) {
                    setTimeout(() => e.target.classList.add('visible'), i * 50);
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.08 });
        reveals.forEach(el => io.observe(el));
    </script>

</x-client-layout>