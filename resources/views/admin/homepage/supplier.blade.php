<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $supplier->business_name }} — Supplier Profile</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --color-bg:        #f5f5f4;
            --color-surface:   #ffffff;
            --color-border:    #e5e7eb;
            --color-border-md: #d1d5db;
            --color-text-1:    #111827;
            --color-text-2:    #374151;
            --color-text-3:    #6b7280;
            --color-text-4:    #9ca3af;
            --color-accent:    #111827;
            --color-star:      #f59e0b;
            --color-tag-bg:    #f3f4f6;
            --radius-sm:  6px;
            --radius-md:  10px;
            --radius-lg:  14px;
            --radius-xl:  18px;
        }

        body {
            font-family: 'Georgia', serif;
            background: var(--color-bg);
            color: var(--color-text-1);
            font-size: 15px;
            line-height: 1.6;
            min-height: 100vh;
        }

        /* ── NAV ── */
        .nav {
            position: sticky; top: 0; z-index: 40;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(12px);
            border-bottom: 0.5px solid var(--color-border);
            padding: 0 2rem;
            display: flex; align-items: center; justify-content: space-between;
            height: 56px;
        }
        .nav-logo {
            font-size: 15px; font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--color-text-1);
            text-decoration: none;
            font-family: 'Georgia', serif;
        }
        .nav-actions { display: flex; gap: 10px; align-items: center; }
        .nav-link {
            font-size: 13px; color: var(--color-text-3);
            text-decoration: none;
            padding: 6px 12px;
            border-radius: var(--radius-sm);
            transition: background 0.15s, color 0.15s;
            font-family: Arial, sans-serif;
        }
        .nav-link:hover { background: var(--color-tag-bg); color: var(--color-text-1); }
        .nav-btn {
            font-size: 13px; font-weight: 500;
            padding: 7px 16px;
            background: var(--color-accent); color: #fff;
            border: none; border-radius: var(--radius-sm);
            cursor: pointer; text-decoration: none;
            font-family: Arial, sans-serif;
            transition: opacity 0.15s;
        }
        .nav-btn:hover { opacity: 0.8; }

        /* ── HERO BANNER ── */
        .hero {
            position: relative;
            height: 260px;
            background: #1f2937;
            overflow: hidden;
        }
        .hero-img {
            width: 100%; height: 100%;
            object-fit: cover;
            opacity: 0.55;
        }
        .hero-gradient {
            position: absolute; inset: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.55) 100%);
        }

        /* ── LAYOUT ── */
        .page-wrap {
            max-width: 1080px;
            margin: 0 auto;
            padding: 0 1.5rem 4rem;
        }

        /* ── PROFILE CARD (overlaps hero) ── */
        .profile-card {
            background: var(--color-surface);
            border: 0.5px solid var(--color-border);
            border-radius: var(--radius-xl);
            padding: 1.5rem 2rem;
            margin-top: -64px;
            position: relative;
            display: flex;
            gap: 1.5rem;
            align-items: flex-start;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }
        .profile-avatar {
            width: 88px; height: 88px;
            border-radius: var(--radius-lg);
            border: 3px solid #fff;
            object-fit: cover;
            background: #e5e7eb;
            flex-shrink: 0;
            box-shadow: 0 2px 12px rgba(0,0,0,0.10);
        }
        .profile-avatar-placeholder {
            width: 88px; height: 88px;
            border-radius: var(--radius-lg);
            border: 3px solid #fff;
            background: #1f2937;
            flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 28px; font-weight: 700;
            color: #fff;
            box-shadow: 0 2px 12px rgba(0,0,0,0.10);
            font-family: Arial, sans-serif;
        }
        .profile-info { flex: 1; min-width: 200px; }
        .profile-name {
            font-size: 22px; font-weight: 700;
            color: var(--color-text-1);
            letter-spacing: -0.02em;
            margin-bottom: 4px;
        }
        .profile-category {
            display: inline-block;
            font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.07em;
            color: var(--color-text-3);
            background: var(--color-tag-bg);
            border: 0.5px solid var(--color-border-md);
            padding: 3px 10px; border-radius: 99px;
            margin-bottom: 10px;
            font-family: Arial, sans-serif;
        }
        .profile-desc {
            font-size: 13.5px; color: var(--color-text-2);
            line-height: 1.65; max-width: 520px;
        }
        .profile-meta {
            display: flex; gap: 1.5rem; margin-top: 14px; flex-wrap: wrap;
        }
        .profile-meta-item {
            display: flex; align-items: center; gap: 5px;
            font-size: 12px; color: var(--color-text-3);
            font-family: Arial, sans-serif;
        }
        .profile-meta-item svg { flex-shrink: 0; opacity: 0.6; }
        .profile-stats {
            display: flex; flex-direction: column; gap: 6px;
            align-items: flex-end; flex-shrink: 0;
        }
        .verified-badge {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 11px; font-weight: 600;
            color: #15803d;
            background: #f0fdf4;
            border: 0.5px solid #bbf7d0;
            padding: 4px 10px; border-radius: 99px;
            font-family: Arial, sans-serif;
        }
        .rating-pill {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 13px; font-weight: 600;
            color: var(--color-text-1);
            background: #fffbeb;
            border: 0.5px solid #fde68a;
            padding: 5px 12px; border-radius: 99px;
            font-family: Arial, sans-serif;
        }
        .star { color: var(--color-star); font-size: 13px; }

        /* ── SECTION LABEL ── */
        .section-label {
            font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.08em;
            color: var(--color-text-4);
            margin-bottom: 1rem;
            font-family: Arial, sans-serif;
        }

        /* ── TWO-COL LAYOUT ── */
        .two-col {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 1.5rem;
            align-items: start;
        }
        @media (max-width: 768px) {
            .two-col { grid-template-columns: 1fr; }
            .profile-stats { align-items: flex-start; flex-direction: row; flex-wrap: wrap; }
        }

        /* ── CARD ── */
        .card {
            background: var(--color-surface);
            border: 0.5px solid var(--color-border);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .card:last-child { margin-bottom: 0; }

        /* ── PRODUCT GRID ── */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }
        @media (max-width: 640px) {
            .product-grid { grid-template-columns: repeat(2, 1fr); }
        }
        .product-card {
            background: var(--color-surface);
            border: 0.5px solid var(--color-border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: box-shadow 0.2s, transform 0.2s;
            cursor: pointer;
        }
        .product-card:hover {
            box-shadow: 0 6px 24px rgba(0,0,0,0.09);
            transform: translateY(-2px);
        }
        .product-img-wrap {
            aspect-ratio: 4 / 3;
            background: #f3f4f6;
            overflow: hidden;
            position: relative;
        }
        .product-img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .product-card:hover .product-img { transform: scale(1.04); }
        .product-img-placeholder {
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
            background: #f3f4f6;
        }
        .product-body { padding: 12px 14px 14px; }
        .product-name {
            font-size: 13.5px; font-weight: 600;
            color: var(--color-text-1);
            margin-bottom: 3px;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            font-family: Arial, sans-serif;
        }
        .product-desc {
            font-size: 12px; color: var(--color-text-3);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 10px;
            font-family: Arial, sans-serif;
            line-height: 1.5;
        }
        .product-footer {
            display: flex; align-items: center; justify-content: space-between;
        }
        .product-price {
            font-size: 14px; font-weight: 700;
            color: var(--color-text-1);
            font-family: Arial, sans-serif;
        }
        .product-tag {
            font-size: 10px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.06em;
            color: var(--color-text-3);
            background: var(--color-tag-bg);
            border: 0.5px solid var(--color-border-md);
            padding: 2px 8px; border-radius: 99px;
            font-family: Arial, sans-serif;
        }
        .product-inquiry-btn {
            width: 100%; margin-top: 10px;
            padding: 7px;
            background: var(--color-accent); color: #fff;
            border: none; border-radius: var(--radius-sm);
            font-size: 12px; font-weight: 500;
            cursor: pointer; font-family: Arial, sans-serif;
            transition: opacity 0.15s;
        }
        .product-inquiry-btn:hover { opacity: 0.8; }

        /* ── CONTACT CARD ── */
        .contact-row {
            display: flex; align-items: flex-start; gap: 12px;
            padding: 12px 0;
            border-bottom: 0.5px solid var(--color-border);
        }
        .contact-row:first-child { padding-top: 0; }
        .contact-row:last-child { border-bottom: none; padding-bottom: 0; }
        .contact-icon {
            width: 34px; height: 34px; flex-shrink: 0;
            background: var(--color-tag-bg);
            border: 0.5px solid var(--color-border-md);
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
        }
        .contact-label {
            font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.06em;
            color: var(--color-text-4);
            margin-bottom: 2px;
            font-family: Arial, sans-serif;
        }
        .contact-value {
            font-size: 13px; color: var(--color-text-1);
            font-family: Arial, sans-serif;
        }
        .contact-value a {
            color: var(--color-text-1);
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        /* ── REVIEWS ── */
        .review-summary {
            display: flex; gap: 1.5rem; align-items: center;
            padding-bottom: 1.25rem;
            border-bottom: 0.5px solid var(--color-border);
            margin-bottom: 1.25rem;
        }
        .review-big-score {
            font-size: 42px; font-weight: 700; line-height: 1;
            color: var(--color-text-1);
            font-family: Arial, sans-serif;
        }
        .review-stars { display: flex; gap: 2px; margin: 4px 0; }
        .review-count {
            font-size: 12px; color: var(--color-text-3);
            font-family: Arial, sans-serif;
        }
        .rating-bars { flex: 1; display: flex; flex-direction: column; gap: 5px; }
        .rating-bar-row {
            display: flex; align-items: center; gap: 8px;
            font-size: 11px; color: var(--color-text-3);
            font-family: Arial, sans-serif;
        }
        .rating-bar-row span:first-child { width: 10px; text-align: right; flex-shrink: 0; }
        .bar-track {
            flex: 1; height: 6px;
            background: var(--color-tag-bg);
            border-radius: 99px; overflow: hidden;
        }
        .bar-fill {
            height: 100%; background: var(--color-star); border-radius: 99px;
        }
        .review-item {
            padding: 1rem 0;
            border-bottom: 0.5px solid var(--color-border);
        }
        .review-item:last-child { border-bottom: none; padding-bottom: 0; }
        .review-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 6px;
        }
        .reviewer {
            display: flex; align-items: center; gap: 8px;
        }
        .reviewer-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: #e5e7eb;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700; color: #6b7280;
            font-family: Arial, sans-serif;
            flex-shrink: 0;
        }
        .reviewer-name {
            font-size: 13px; font-weight: 600; color: var(--color-text-1);
            font-family: Arial, sans-serif;
        }
        .reviewer-date {
            font-size: 11px; color: var(--color-text-4);
            font-family: Arial, sans-serif;
        }
        .review-stars-sm { display: flex; gap: 2px; margin-bottom: 5px; }
        .review-text {
            font-size: 13px; color: var(--color-text-2);
            line-height: 1.65;
            font-family: Arial, sans-serif;
        }

        /* ── INQUIRY MODAL ── */
        .modal-backdrop {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 50;
            display: flex; align-items: center; justify-content: center;
            padding: 1.5rem;
            overflow-y: auto;
        }
        .modal-box {
            background: #fff;
            border-radius: 16px;
            width: 480px; max-width: 100%;
            border: 0.5px solid var(--color-border);
            max-height: 92vh;
            display: flex; flex-direction: column;
            margin: auto; flex-shrink: 0;
        }
        .modal-header {
            flex-shrink: 0;
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.25rem 1.5rem;
            border-bottom: 0.5px solid var(--color-border);
        }
        .modal-title { font-size: 15px; font-weight: 600; color: var(--color-text-1); font-family: Arial, sans-serif; }
        .modal-subtitle { font-size: 12px; color: var(--color-text-3); font-family: Arial, sans-serif; margin-top: 2px; }
        .modal-close {
            width: 28px; height: 28px;
            border: none; background: #f3f4f6; border-radius: 50%;
            cursor: pointer; font-size: 18px; color: var(--color-text-3);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .modal-body { padding: 1.5rem; overflow-y: auto; flex: 1; min-height: 0; }
        .modal-footer {
            flex-shrink: 0;
            padding: 1rem 1.5rem;
            border-top: 0.5px solid var(--color-border);
            display: flex; gap: 10px; justify-content: flex-end;
        }
        .form-field { display: flex; flex-direction: column; gap: 5px; margin-bottom: 1rem; }
        .form-field:last-child { margin-bottom: 0; }
        .fm-label { font-size: 12px; font-weight: 500; color: var(--color-text-3); font-family: Arial, sans-serif; }
        .fm-input {
            width: 100%; padding: 8px 12px;
            border: 0.5px solid var(--color-border-md); border-radius: var(--radius-md);
            font-size: 13px; color: var(--color-text-1); background: #fff;
            outline: none; font-family: Arial, sans-serif;
            transition: border-color 0.15s, box-shadow 0.15s;
        }
        .fm-input:focus { border-color: #6b7280; box-shadow: 0 0 0 3px rgba(0,0,0,0.06); }
        textarea.fm-input { resize: vertical; min-height: 90px; }
        .btn-primary {
            padding: 8px 18px; background: var(--color-accent); color: #fff;
            border: none; border-radius: var(--radius-sm);
            font-size: 13px; font-weight: 500; cursor: pointer;
            font-family: Arial, sans-serif; transition: opacity 0.15s;
        }
        .btn-primary:hover { opacity: 0.8; }
        .btn-outline {
            padding: 8px 18px; background: transparent; color: var(--color-text-2);
            border: 0.5px solid var(--color-border-md); border-radius: var(--radius-sm);
            font-size: 13px; font-weight: 500; cursor: pointer;
            font-family: Arial, sans-serif; transition: background 0.15s;
        }
        .btn-outline:hover { background: var(--color-tag-bg); }

        /* ── EMPTY / FALLBACK ── */
        .empty-box {
            text-align: center; padding: 3rem 1rem;
            color: var(--color-text-4);
            font-size: 13px; font-family: Arial, sans-serif;
        }

        /* ── FOOTER ── */
        .site-footer {
            border-top: 0.5px solid var(--color-border);
            background: var(--color-surface);
            padding: 1.5rem 2rem;
            text-align: center;
            font-size: 12px; color: var(--color-text-4);
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>

    {{-- ── NAV ── --}}
    <nav class="nav">
        <a href="{{ url('/') }}" class="nav-logo">YourStore</a>
        <div class="nav-actions">
            <a href="{{ url('/suppliers') }}" class="nav-link">Browse Suppliers</a>
            <a href="{{ route('login') }}" class="nav-link">Sign in</a>
            <a href="{{ route('register') }}" class="nav-btn">Get started</a>
        </div>
    </nav>

    {{-- ── HERO BANNER ── --}}
    <div class="hero">
        @if($supplier->banner_image)
            <img class="hero-img" src="{{ asset('storage/' . $supplier->banner_image) }}" alt="Banner">
        @endif
        <div class="hero-gradient"></div>
    </div>

    <div class="page-wrap">

        {{-- ── PROFILE CARD ── --}}
        <div class="profile-card">
            {{-- Avatar --}}
            @if($supplier->logo)
                <img class="profile-avatar"
                     src="{{ asset('storage/' . $supplier->logo) }}"
                     alt="{{ $supplier->business_name }}">
            @else
                <div class="profile-avatar-placeholder">
                    {{ strtoupper(substr($supplier->business_name, 0, 2)) }}
                </div>
            @endif

            {{-- Info --}}
            <div class="profile-info">
                <p class="profile-name">{{ $supplier->business_name }}</p>
                @if($supplier->category)
                    <span class="profile-category">{{ $supplier->category }}</span>
                @endif
                @if($supplier->description)
                    <p class="profile-desc">{{ $supplier->description }}</p>
                @endif
                <div class="profile-meta">
                    @if($supplier->location)
                    <span class="profile-meta-item">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        {{ $supplier->location }}
                    </span>
                    @endif
                    @if($supplier->year_established)
                    <span class="profile-meta-item">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        Est. {{ $supplier->year_established }}
                    </span>
                    @endif
                    @if($supplier->products_count ?? 0)
                    <span class="profile-meta-item">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        {{ $supplier->products_count }} products
                    </span>
                    @endif
                </div>
            </div>

            {{-- Stats --}}
            <div class="profile-stats">
                @if($supplier->is_verified)
                <span class="verified-badge">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                    Verified
                </span>
                @endif
                @php $avgRating = $reviews->avg('rating') ?? 0; @endphp
                @if($reviews->count() > 0)
                <span class="rating-pill">
                    <span class="star">★</span>
                    {{ number_format($avgRating, 1) }}
                    <span style="font-weight:400; color:#9ca3af; font-size:11px;">({{ $reviews->count() }})</span>
                </span>
                @endif
                <button class="btn-primary" onclick="openInquiry()">Send Inquiry</button>
            </div>
        </div>

        {{-- ── TWO-COL ── --}}
        <div class="two-col">

            {{-- LEFT: products + reviews --}}
            <div>

                {{-- Products --}}
                <p class="section-label">Products & Services</p>
                @if($products->count())
                <div class="product-grid" style="margin-bottom:1.5rem;">
                    @foreach($products as $product)
                    <div class="product-card">
                        <div class="product-img-wrap">
                            @if($product->image)
                                <img class="product-img"
                                     src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}">
                            @else
                                <div class="product-img-placeholder">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                         stroke="#d1d5db" stroke-width="1.5">
                                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                                        <circle cx="8.5" cy="8.5" r="1.5"/>
                                        <path d="M21 15l-5-5L5 21"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="product-body">
                            <p class="product-name">{{ $product->name }}</p>
                            @if($product->description)
                                <p class="product-desc">{{ $product->description }}</p>
                            @endif
                            <div class="product-footer">
                                @if($product->price)
                                    <span class="product-price">₱{{ number_format($product->price, 2) }}</span>
                                @else
                                    <span class="product-price" style="font-size:12px; font-weight:400; color:#9ca3af;">Price on request</span>
                                @endif
                                @if($product->category)
                                    <span class="product-tag">{{ $product->category }}</span>
                                @endif
                            </div>
                            <button class="product-inquiry-btn"
                                    onclick="openInquiry('{{ $product->name }}')">
                                Inquire
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="card">
                    <div class="empty-box">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="1.2" style="margin:0 auto 10px;display:block;"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                        No products listed yet.
                    </div>
                </div>
                @endif

                {{-- Reviews --}}
                <p class="section-label">Customer Reviews</p>
                <div class="card">
                    @if($reviews->count())
                    <div class="review-summary">
                        <div>
                            <p class="review-big-score">{{ number_format($avgRating, 1) }}</p>
                            <div class="review-stars">
                                @for($s = 1; $s <= 5; $s++)
                                    <span class="star" style="{{ $s <= round($avgRating) ? '' : 'opacity:0.2;' }}">★</span>
                                @endfor
                            </div>
                            <p class="review-count">{{ $reviews->count() }} review{{ $reviews->count() !== 1 ? 's' : '' }}</p>
                        </div>
                        <div class="rating-bars">
                            @foreach([5,4,3,2,1] as $star)
                                @php $count = $reviews->where('rating', $star)->count(); $pct = $reviews->count() ? round($count/$reviews->count()*100) : 0; @endphp
                                <div class="rating-bar-row">
                                    <span>{{ $star }}</span>
                                    <span class="star" style="font-size:10px;">★</span>
                                    <div class="bar-track"><div class="bar-fill" style="width:{{ $pct }}%;"></div></div>
                                    <span style="width:24px;">{{ $count }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @foreach($reviews as $review)
                    <div class="review-item">
                        <div class="review-header">
                            <div class="reviewer">
                                <div class="reviewer-avatar">
                                    {{ strtoupper(substr($review->reviewer_name ?? 'A', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="reviewer-name">{{ $review->reviewer_name ?? 'Anonymous' }}</p>
                                    <p class="reviewer-date">{{ \Carbon\Carbon::parse($review->created_at)->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <div class="review-stars-sm">
                                @for($s = 1; $s <= 5; $s++)
                                    <span class="star" style="font-size:12px; {{ $s <= $review->rating ? '' : 'opacity:0.2;' }}">★</span>
                                @endfor
                            </div>
                        </div>
                        @if($review->comment)
                            <p class="review-text">{{ $review->comment }}</p>
                        @endif
                    </div>
                    @endforeach

                    @else
                    <div class="empty-box">
                        No reviews yet. Be the first to leave one!
                    </div>
                    @endif
                </div>

            </div>

            {{-- RIGHT sidebar: contact --}}
            <div>
                <p class="section-label">Contact Information</p>
                <div class="card">
                    @if($supplier->email)
                    <div class="contact-row">
                        <div class="contact-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 8l10 6 10-6"/></svg>
                        </div>
                        <div>
                            <p class="contact-label">Email</p>
                            <p class="contact-value">
                                <a href="mailto:{{ $supplier->email }}">{{ $supplier->email }}</a>
                            </p>
                        </div>
                    </div>
                    @endif

                    @if($supplier->phone)
                    <div class="contact-row">
                        <div class="contact-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 11.63 19a19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 3.12 4.18 2 2 0 0 1 5.08 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L9.09 9.91A16 16 0 0 0 15 15.91l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <div>
                            <p class="contact-label">Phone</p>
                            <p class="contact-value">
                                <a href="tel:{{ $supplier->phone }}">{{ $supplier->phone }}</a>
                            </p>
                        </div>
                    </div>
                    @endif

                    @if($supplier->website)
                    <div class="contact-row">
                        <div class="contact-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        </div>
                        <div>
                            <p class="contact-label">Website</p>
                            <p class="contact-value">
                                <a href="{{ $supplier->website }}" target="_blank" rel="noopener">
                                    {{ parse_url($supplier->website, PHP_URL_HOST) ?? $supplier->website }}
                                </a>
                            </p>
                        </div>
                    </div>
                    @endif

                    @if($supplier->address)
                    <div class="contact-row">
                        <div class="contact-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <p class="contact-label">Address</p>
                            <p class="contact-value">{{ $supplier->address }}</p>
                        </div>
                    </div>
                    @endif

                    @if($supplier->business_hours)
                    <div class="contact-row">
                        <div class="contact-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div>
                            <p class="contact-label">Business Hours</p>
                            <p class="contact-value">{{ $supplier->business_hours }}</p>
                        </div>
                    </div>
                    @endif

                    <div style="margin-top:1rem;">
                        <button class="btn-primary" style="width:100%;" onclick="openInquiry()">
                            Send Inquiry
                        </button>
                    </div>
                </div>

                {{-- Quick stats card --}}
                <p class="section-label" style="margin-top:1.5rem;">At a Glance</p>
                <div class="card" style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                    <div style="text-align:center;">
                        <p style="font-size:22px; font-weight:700; color:var(--color-text-1); font-family:Arial,sans-serif; line-height:1;">
                            {{ $reviews->count() }}
                        </p>
                        <p style="font-size:11px; color:var(--color-text-4); font-family:Arial,sans-serif; margin-top:3px;">Reviews</p>
                    </div>
                    <div style="text-align:center;">
                        <p style="font-size:22px; font-weight:700; color:var(--color-text-1); font-family:Arial,sans-serif; line-height:1;">
                            {{ $reviews->count() ? number_format($avgRating,1) : '—' }}
                        </p>
                        <p style="font-size:11px; color:var(--color-text-4); font-family:Arial,sans-serif; margin-top:3px;">Avg. Rating</p>
                    </div>
                    <div style="text-align:center;">
                        <p style="font-size:22px; font-weight:700; color:var(--color-text-1); font-family:Arial,sans-serif; line-height:1;">
                            {{ $products->count() }}
                        </p>
                        <p style="font-size:11px; color:var(--color-text-4); font-family:Arial,sans-serif; margin-top:3px;">Products</p>
                    </div>
                    <div style="text-align:center;">
                        <p style="font-size:22px; font-weight:700; color:var(--color-text-1); font-family:Arial,sans-serif; line-height:1;">
                            {{ $supplier->year_established ? now()->year - $supplier->year_established : '—' }}
                        </p>
                        <p style="font-size:11px; color:var(--color-text-4); font-family:Arial,sans-serif; margin-top:3px;">Yrs in Business</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ── INQUIRY MODAL ── --}}
    <div id="inquiry-modal" class="modal-backdrop" style="display:none;">
        <div class="modal-box">
            <div class="modal-header">
                <div>
                    <p class="modal-title">Send an Inquiry</p>
                    <p class="modal-subtitle" id="inquiry-subtitle">to {{ $supplier->business_name }}</p>
                </div>
                <button type="button" class="modal-close" onclick="closeInquiry()">&#215;</button>
            </div>
            <form action="{{ route('supplier.inquiry', $supplier->id) }}" method="POST"
                  style="display:contents;">
                @csrf
                <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">
                <input type="hidden" name="product_name" id="inquiry-product-name" value="">

                <div class="modal-body">
                    <div class="form-field">
                        <label class="fm-label" for="inq_name">Your name</label>
                        <input class="fm-input" type="text" name="name" id="inq_name"
                               placeholder="e.g. Maria Santos" required>
                    </div>
                    <div class="form-field">
                        <label class="fm-label" for="inq_email">Email address</label>
                        <input class="fm-input" type="email" name="email" id="inq_email"
                               placeholder="you@example.com" required>
                    </div>
                    <div class="form-field">
                        <label class="fm-label" for="inq_phone">Phone <span style="font-weight:400;color:#9ca3af;">(optional)</span></label>
                        <input class="fm-input" type="tel" name="phone" id="inq_phone"
                               placeholder="+63 912 345 6789">
                    </div>
                    <div class="form-field">
                        <label class="fm-label" for="inq_subject">Subject</label>
                        <input class="fm-input" type="text" name="subject" id="inq_subject"
                               placeholder="What are you inquiring about?" required>
                    </div>
                    <div class="form-field">
                        <label class="fm-label" for="inq_message">Message</label>
                        <textarea class="fm-input" name="message" id="inq_message"
                                  placeholder="Tell the supplier what you need…" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-outline" onclick="closeInquiry()">Cancel</button>
                    <button type="submit" class="btn-primary">Send Inquiry</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="site-footer">
        &copy; {{ date('Y') }} YourStore. All rights reserved.
        &nbsp;·&nbsp;
        <a href="{{ url('/') }}" style="color:inherit; text-decoration:underline; text-underline-offset:3px;">Home</a>
        &nbsp;·&nbsp;
        <a href="{{ url('/suppliers') }}" style="color:inherit; text-decoration:underline; text-underline-offset:3px;">Suppliers</a>
    </footer>

    <script>
        function openInquiry(productName) {
            const modal    = document.getElementById('inquiry-modal');
            const subtitle = document.getElementById('inquiry-subtitle');
            const hidden   = document.getElementById('inquiry-product-name');
            const subject  = document.getElementById('inq_subject');

            if (productName) {
                subtitle.textContent = 'Inquiring about: ' + productName;
                hidden.value = productName;
                subject.value = 'Inquiry about ' + productName;
            } else {
                subtitle.textContent = 'to {{ $supplier->business_name }}';
                hidden.value = '';
                subject.value = '';
            }

            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        function closeInquiry() {
            document.getElementById('inquiry-modal').style.display = 'none';
            document.body.style.overflow = '';
        }
        document.getElementById('inquiry-modal').addEventListener('click', function (e) {
            if (e.target === this) closeInquiry();
        });
    </script>

</body>
</html>