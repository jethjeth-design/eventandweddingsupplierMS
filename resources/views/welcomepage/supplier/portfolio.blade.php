<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery — WES TEAM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcomepage/supplier/portfolio.css') }}">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        :root {
            --gold: #C9A84C;
            --gold-lt: #E8C97A;
            --gold-dk: #8A6A1F;
            --blush-deep: #D4A090;
            --ivory: #FAF7F2;
            --charcoal: #1E1B18;
            --warm-grey: #6B6560;
            --white: #FFFFFF;
            --border: #F0EBE5;
            --border-md: #E0D8D0;
            --font-d: 'Playfair Display', Georgia, serif;
            --font-b: 'DM Sans', sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font-b); background: var(--ivory); color: var(--charcoal); overflow-x: hidden; font-size: 14px; line-height: 1.6; }

        /* ══ NAVBAR ══ */
        nav.main-nav { position: fixed; top: 0; left: 0; right: 0; z-index: 200; display: flex; align-items: center; justify-content: space-between; padding: 1.2rem 3rem; background: rgba(255,255,255,0.92); backdrop-filter: blur(16px); border-bottom: 1px solid rgba(201,168,76,0.18); }
        .nav-logo { font-family: var(--font-d); font-size: 1.5rem; font-weight: 700; color: var(--charcoal); letter-spacing: -0.01em; text-decoration: none; }
        .nav-logo span { color: var(--gold); font-style: italic; }
        .nav-links { display: flex; gap: 2rem; align-items: center; }
        .nav-links a { font-size: 0.875rem; font-weight: 400; letter-spacing: 0.04em; text-transform: uppercase; color: var(--warm-grey); text-decoration: none; transition: color 0.2s; }
        .nav-links a:hover, .nav-links a.active { color: var(--gold-dk); }
        .nav-cta { background: var(--charcoal); color: var(--white) !important; padding: 0.55rem 1.4rem; border-radius: 2px; font-size: 0.8rem !important; letter-spacing: 0.06em !important; transition: background 0.2s !important; }
        .nav-cta:hover { background: var(--gold-dk) !important; }

        /* ══ HAMBURGER ══ */
        .hamburger { display: none; flex-direction: column; justify-content: center; gap: 5px; width: 36px; height: 36px; cursor: pointer; background: none; border: none; padding: 4px; }
        .hamburger span { display: block; width: 100%; height: 2px; background: var(--charcoal); border-radius: 2px; transition: transform 0.3s, opacity 0.3s; }
        .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
        .mobile-menu { display: none; position: fixed; top: 64px; left: 0; right: 0; background: var(--white); z-index: 199; padding: 1.5rem 2rem 2.5rem; flex-direction: column; box-shadow: 0 8px 32px rgba(30,27,24,0.1); transform: translateY(-110%); transition: transform 0.38s cubic-bezier(0.4,0,0.2,1); border-top: 2px solid rgba(201,168,76,0.2); }
        .mobile-menu.open { transform: translateY(0); }
        .mobile-menu a { font-size: 1rem; letter-spacing: 0.05em; text-transform: uppercase; color: var(--charcoal); text-decoration: none; padding: 0.9rem 0; border-bottom: 1px solid rgba(201,168,76,0.15); }
        .mobile-menu a:last-child { border-bottom: none; }
        .mobile-menu .mob-cta { margin-top: 1.5rem; background: var(--charcoal); color: var(--white); text-align: center; padding: 0.85rem; border-radius: 2px; border-bottom: none !important; }
        @media(max-width:768px) { .hamburger { display: flex; } .mobile-menu { display: flex; } .nav-links { display: none; } nav.main-nav { padding: 1rem 1.5rem; } }

        /* ══ PAGE HEADER ══ */
        .page-header { margin-top: 64px; background: var(--charcoal); padding: 2.5rem 8% 2rem; position: relative; overflow: hidden; border-bottom: 2px solid rgba(201,168,76,0.35); }
        .page-header::before { content: ''; position: absolute; inset: 0; background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px); background-size: 22px 22px; }
        .page-header::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, var(--gold), transparent); }
        .page-header-inner { position: relative; z-index: 1; display: flex; align-items: flex-end; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
        .ph-eyebrow { font-size: 0.68rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--gold); font-weight: 500; display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.5rem; }
        .ph-eyebrow::before { content: ''; display: block; width: 24px; height: 1px; background: var(--gold); }
        .page-header h1 { font-family: var(--font-d); font-size: clamp(1.5rem, 3vw, 2.2rem); font-weight: 700; color: var(--white); line-height: 1.15; }
        .page-header h1 em { color: var(--gold-lt); font-style: italic; }
        .ph-count { display: inline-flex; align-items: center; gap: 6px; font-size: 0.72rem; font-weight: 500; letter-spacing: 0.08em; text-transform: uppercase; color: var(--gold); background: rgba(201,168,76,0.12); border: 1px solid rgba(201,168,76,0.3); padding: 5px 14px; border-radius: 2px; align-self: flex-end; }

        /* ══ PROFILE HEADER ══ */
        .pf-cover { height: 260px; background: linear-gradient(135deg, var(--charcoal) 0%, #2a2016 50%, #3d2f14 100%); position: relative; overflow: hidden; }
        .pf-cover::before { content: ''; position: absolute; inset: 0; background-image: radial-gradient(rgba(201,168,76,0.08) 1px, transparent 1px); background-size: 24px 24px; }
        .pf-cover::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, var(--gold), transparent); }
        .pf-header-body { background: var(--white); border-bottom: 1px solid var(--border); padding: 0 2rem; }
        .pf-avatar-row { display: flex; align-items: flex-end; gap: 1.25rem; flex-wrap: wrap; margin-top: 5px; padding-bottom: 1rem; position: relative; z-index: 2; }
        .pf-avatar { width: 168px; height: 168px; border-radius: 50%; background: linear-gradient(135deg, var(--gold), var(--gold-dk)); display: flex; align-items: center; justify-content: center; font-family: var(--font-d); font-size: 3.5rem; font-weight: 700; color: var(--white); overflow: hidden; flex-shrink: 0; border: 5px solid var(--white); box-shadow: 0 4px 20px rgba(30,27,24,0.22); }
        .pf-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .pf-header-info { flex: 1; padding-bottom: 0.5rem; min-width: 0; }
        .pf-biz-name { font-family: var(--font-d); font-size: 1.65rem; font-weight: 700; color: var(--charcoal); line-height: 1.15; }
        .pf-tagline { font-size: 0.82rem; color: var(--warm-grey); margin-top: 0.2rem; font-style: italic; }
        .pf-meta-chips { display: flex; flex-wrap: wrap; gap: 0.5rem 1.1rem; margin-top: 0.55rem; }
        .pf-meta-chip { display: flex; align-items: center; gap: 0.35rem; font-size: 0.76rem; color: var(--warm-grey); }
        .pf-meta-chip svg { width: 13px; height: 13px; color: var(--gold-dk); flex-shrink: 0; }
        .pf-meta-chip strong { color: var(--charcoal); font-weight: 600; }

        /* ══ NAV TABS ══ */
        .pf-nav { border-top: 1px solid var(--border); display: flex; align-items: center; padding: 0 2rem; background: var(--white); overflow-x: auto; scrollbar-width: none; }
        .pf-nav::-webkit-scrollbar { display: none; }
        .pf-nav-tab { display: flex; align-items: center; gap: 0.45rem; padding: 0.85rem 1.1rem; font-size: 0.83rem; font-weight: 500; color: var(--warm-grey); border-bottom: 3px solid transparent; cursor: pointer; background: none; border-left: none; border-right: none; border-top: none; font-family: var(--font-b); white-space: nowrap; transition: color 0.18s, border-color 0.18s; }
        .pf-nav-tab svg { width: 14px; height: 14px; flex-shrink: 0; }
        .pf-nav-tab:hover { color: var(--charcoal); }
        .pf-nav-tab.active { color: var(--gold-dk); border-bottom-color: var(--gold); font-weight: 700; }

        /* ══ CONTENT AREA ══ */
        .pf-content { padding: 1.5rem 2rem; display: grid; grid-template-columns: 280px 1fr; gap: 1.25rem; align-items: start; }
        @media(max-width:860px) { .pf-content { grid-template-columns: 1fr; } }

        /* ── About card ── */
        .pf-about-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; overflow: hidden; position: sticky; top: 1rem; }
        .pf-about-head { padding: 0.85rem 1.1rem; border-bottom: 1px solid var(--border); background: var(--ivory); display: flex; align-items: center; gap: 0.55rem; }
        .pf-about-head-icon { width: 28px; height: 28px; border-radius: 6px; background: rgba(201,168,76,0.12); display: flex; align-items: center; justify-content: center; color: var(--gold-dk); flex-shrink: 0; }
        .pf-about-head-icon svg { width: 13px; height: 13px; }
        .pf-about-title { font-family: var(--font-d); font-size: 0.88rem; font-weight: 700; color: var(--charcoal); }
        .pf-about-body { padding: 1rem 1.1rem; display: flex; flex-direction: column; gap: 0.75rem; }
        .pf-about-row { display: flex; align-items: flex-start; gap: 0.55rem; }
        .pf-about-row svg { width: 14px; height: 14px; color: var(--gold-dk); flex-shrink: 0; margin-top: 2px; }
        .pf-about-row-text { font-size: 0.8rem; color: var(--charcoal); line-height: 1.45; }
        .pf-about-row-text small { display: block; font-size: 0.68rem; color: var(--warm-grey); margin-top: 1px; }
        .pf-bio-text { font-size: 0.8rem; color: var(--warm-grey); line-height: 1.6; font-style: italic; padding: 0.65rem 0.85rem; background: rgba(201,168,76,0.04); border: 1px solid rgba(201,168,76,0.15); border-radius: 3px; }

        /* ── Reviews button in sidebar ── */
        .pf-reviews-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 0.75rem 1.1rem;
            background: none;
            border: none;
            border-top: 1px solid var(--border);
            cursor: pointer;
            font-family: var(--font-b);
            transition: background 0.18s;
        }
        .pf-reviews-btn:hover { background: rgba(201,168,76,0.05); }
        .pf-reviews-btn-left { display: flex; align-items: center; gap: 0.55rem; }
        .pf-reviews-btn-left svg { width: 14px; height: 14px; color: var(--gold-dk); flex-shrink: 0; }
        .pf-reviews-btn-label { font-size: 0.8rem; font-weight: 600; color: var(--charcoal); }
        .pf-reviews-btn-right { display: flex; align-items: center; gap: 0.5rem; }
        .pf-reviews-count-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 22px;
            height: 22px;
            padding: 0 6px;
            background: var(--gold);
            color: var(--charcoal);
            font-size: 0.68rem;
            font-weight: 700;
            border-radius: 999px;
            font-family: var(--font-b);
        }
        .pf-reviews-btn-arrow { width: 14px; height: 14px; color: var(--warm-grey); }

        /* ── Panels ── */
        .pf-panel { display: none; }
        .pf-panel.active { display: block; }
        .pf-section-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.85rem; flex-wrap: wrap; gap: 0.5rem; }
        .pf-section-title { font-family: var(--font-d); font-size: 1.1rem; font-weight: 700; color: var(--charcoal); }
        .pf-section-title em { font-style: italic; color: var(--gold-dk); }
        .pf-sub-tabs { display: flex; align-items: center; gap: 0.35rem; margin-bottom: 1rem; flex-wrap: wrap; }
        .pf-sub-tab { padding: 0.3rem 0.9rem; border-radius: 999px; font-size: 0.74rem; font-weight: 500; border: 1.5px solid var(--border-md); background: var(--ivory); color: var(--warm-grey); cursor: pointer; font-family: var(--font-b); transition: all 0.18s; }
        .pf-sub-tab:hover { border-color: var(--gold); color: var(--gold-dk); }
        .pf-sub-tab.active { background: var(--gold); border-color: var(--gold); color: var(--charcoal); font-weight: 600; }

        /* ── Photo grid ── */
        .pf-photo-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 3px; }
        @media(max-width:640px) { .pf-photo-grid { grid-template-columns: repeat(3, 1fr); } }
        .pf-photo-cell { aspect-ratio: 1; overflow: hidden; position: relative; cursor: pointer; background: var(--charcoal); border-radius: 2px; }
        .pf-photo-cell img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.28s ease, opacity 0.2s; }
        .pf-photo-cell:hover img { transform: scale(1.06); opacity: 0.88; }
        .pf-photo-cell::after { content: ''; position: absolute; inset: 0; background: rgba(201,168,76,0); transition: background 0.2s; pointer-events: none; }
        .pf-photo-cell:hover::after { background: rgba(201,168,76,0.08); }
        .pf-portfolio-post-head { display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.65rem; }
        .pf-post-num { width: 28px; height: 28px; border-radius: 50%; flex-shrink: 0; background: rgba(201,168,76,0.12); border: 1px solid rgba(201,168,76,0.3); display: flex; align-items: center; justify-content: center; font-size: 0.65rem; font-weight: 700; color: var(--gold-dk); font-family: var(--font-d); }
        .pf-post-title { font-family: var(--font-d); font-size: 0.88rem; font-weight: 700; color: var(--charcoal); }
        .pf-post-desc { font-size: 0.76rem; color: var(--warm-grey); line-height: 1.45; }
        .pf-post-date { font-size: 0.65rem; color: #C0B8B0; }

        /* ── Video ── */
        .pf-video-grid { display: flex; flex-direction: column; gap: 1rem; }
        .pf-video-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; overflow: hidden; }
        .pf-video-card video { width: 100%; max-height: 400px; display: block; object-fit: contain; background: #000; }
        .pf-video-info { padding: 0.75rem 1rem; border-top: 1px solid var(--border); }
        .pf-video-title { font-family: var(--font-d); font-size: 0.85rem; font-weight: 700; color: var(--charcoal); }
        .pf-video-date { font-size: 0.68rem; color: #C0B8B0; margin-top: 2px; }

        /* ── About panel ── */
        .pf-about-full { display: flex; flex-direction: column; gap: 1rem; }
        .pf-info-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; overflow: hidden; }
        .pf-info-card-head { padding: 0.8rem 1.1rem; border-bottom: 1px solid var(--border); background: var(--ivory); display: flex; align-items: center; gap: 0.5rem; }
        .pf-info-card-head svg { width: 14px; height: 14px; color: var(--gold-dk); }
        .pf-info-card-title { font-family: var(--font-d); font-size: 0.88rem; font-weight: 700; color: var(--charcoal); }
        .pf-info-card-body { padding: 1rem 1.1rem; display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem; }
        @media(max-width:560px) { .pf-info-card-body { grid-template-columns: 1fr; } }
        .pf-info-k { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: #C0B8B0; margin-bottom: 0.2rem; }
        .pf-info-v { font-size: 0.82rem; color: var(--charcoal); font-weight: 500; }
        .pf-info-v.nil { color: #C0B8B0; font-style: italic; font-size: 0.76rem; }
        .pf-full-row { grid-column: 1/-1; }

        /* ── About panel: Reviews summary card ── */
        .pf-reviews-summary-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 4px;
            overflow: hidden;
        }
        .pf-reviews-summary-head {
            padding: 0.8rem 1.1rem;
            border-bottom: 1px solid var(--border);
            background: var(--ivory);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
        }
        .pf-reviews-summary-head-left { display: flex; align-items: center; gap: 0.5rem; }
        .pf-reviews-summary-head-left svg { width: 14px; height: 14px; color: var(--gold-dk); }
        .pf-btn-see-all {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.9rem;
            background: var(--charcoal);
            color: var(--white);
            border: none;
            border-radius: 3px;
            font-size: 0.72rem;
            font-weight: 600;
            font-family: var(--font-b);
            letter-spacing: 0.04em;
            cursor: pointer;
            transition: background 0.18s;
            white-space: nowrap;
        }
        .pf-btn-see-all:hover { background: var(--gold-dk); }
        .pf-btn-see-all svg { width: 11px; height: 11px; }
        .pf-reviews-overview {
            padding: 1rem 1.1rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            border-bottom: 1px solid var(--border);
        }
        .pf-reviews-big-score {
            text-align: center;
            flex-shrink: 0;
        }
        .pf-big-score-num {
            font-family: var(--font-d);
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--charcoal);
            line-height: 1;
        }
        .pf-big-score-label { font-size: 0.65rem; color: var(--warm-grey); letter-spacing: 0.05em; margin-top: 4px; }
        .pf-reviews-preview { padding: 1rem 1.1rem; display: flex; flex-direction: column; gap: 0.75rem; }
        .pf-review-item-mini {
            display: flex;
            gap: 0.65rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border);
        }
        .pf-review-item-mini:last-child { border-bottom: none; padding-bottom: 0; }
        .pf-review-avatar-mini {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            flex-shrink: 0;
            background: linear-gradient(135deg, var(--gold-lt), var(--gold));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--charcoal);
            font-family: var(--font-d);
        }
        .pf-review-content-mini { flex: 1; min-width: 0; }
        .pf-review-meta-mini { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 3px; flex-wrap: wrap; }
        .pf-review-name-mini { font-size: 0.75rem; font-weight: 600; color: var(--charcoal); }
        .pf-review-date-mini { font-size: 0.63rem; color: #C0B8B0; margin-left: auto; }
        .pf-review-text-mini { font-size: 0.76rem; color: var(--warm-grey); line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

        /* ── Empty ── */
        .pf-empty { text-align: center; padding: 3.5rem 2rem; }
        .pf-empty svg { width: 44px; height: 44px; color: var(--gold); opacity: 0.25; margin: 0 auto 0.75rem; display: block; }
        .pf-empty-text { font-size: 0.8rem; color: #C0B8B0; }

        /* ══ LIGHTBOX ══ */
        .pf-lb { position: fixed; inset: 0; z-index: 9999; background: rgba(0,0,0,0.97); display: none; flex-direction: column; }
        .pf-lb.open { display: flex; }
        .pf-lb-bar { display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 1.25rem; background: rgba(0,0,0,0.65); flex-shrink: 0; }
        .pf-lb-title { font-family: var(--font-d); font-size: 0.9rem; font-weight: 700; color: var(--white); }
        .pf-lb-counter { font-size: 0.7rem; color: rgba(255,255,255,0.45); }
        .pf-lb-close { width: 36px; height: 36px; border-radius: 50%; background: rgba(255,255,255,0.1); border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--white); transition: background 0.2s; }
        .pf-lb-close:hover { background: rgba(255,255,255,0.22); }
        .pf-lb-close svg { width: 14px; height: 14px; }
        .pf-lb-main { flex: 1; display: flex; align-items: center; justify-content: center; position: relative; min-height: 0; overflow: hidden; }
        .pf-lb-img { max-width: 100%; max-height: 100%; object-fit: contain; display: block; border-radius: 3px; }
        .pf-lb-nav { position: absolute; top: 50%; transform: translateY(-50%); width: 46px; height: 46px; border-radius: 50%; background: rgba(255,255,255,0.14); border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--white); transition: background 0.2s; z-index: 2; }
        .pf-lb-nav:hover { background: rgba(255,255,255,0.28); }
        .pf-lb-nav svg { width: 20px; height: 20px; }
        .pf-lb-nav.lp { left: 14px; }
        .pf-lb-nav.ln { right: 14px; }
        .pf-lb-strip { display: flex; align-items: center; justify-content: center; gap: 4px; padding: 0.55rem 1rem; background: rgba(0,0,0,0.65); flex-shrink: 0; overflow-x: auto; }
        .pf-lb-strip::-webkit-scrollbar { height: 3px; }
        .pf-lb-strip::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 2px; }
        .pf-lb-thumb { width: 46px; height: 46px; object-fit: cover; border-radius: 4px; cursor: pointer; opacity: 0.5; border: 2px solid transparent; transition: opacity 0.2s, border-color 0.2s; flex-shrink: 0; }
        .pf-lb-thumb.active { opacity: 1; border-color: var(--gold); }
        .pf-lb-thumb:hover { opacity: 0.85; }

        /* ══ FLOATING INQUIRY BUTTON ══ */
        .fab-inq { position: fixed; bottom: 2rem; right: 2rem; z-index: 500; display: flex; align-items: center; gap: 0; background: var(--charcoal); border: none; border-radius: 999px; box-shadow: 0 6px 28px rgba(30,27,24,0.28), 0 0 0 1px rgba(201,168,76,0.25); cursor: pointer; overflow: hidden; transition: box-shadow 0.25s, transform 0.2s; font-family: var(--font-b); text-decoration: none; animation: fabIn 0.55s cubic-bezier(0.34,1.56,0.64,1) forwards; }
        @keyframes fabIn { from { opacity: 0; transform: translateY(24px) scale(0.88); } to { opacity: 1; transform: translateY(0) scale(1); } }
        .fab-inq:hover { box-shadow: 0 10px 36px rgba(30,27,24,0.35), 0 0 0 2px rgba(201,168,76,0.4); transform: translateY(-2px); }
        .fab-logo-pill { display: flex; align-items: center; padding: 0 1rem 0 0.85rem; height: 52px; background: var(--charcoal); gap: 0.4rem; border-right: 1px solid rgba(201,168,76,0.2); flex-shrink: 0; }
        .fab-logo-text { font-family: var(--font-d); font-size: 0.88rem; font-weight: 700; color: var(--white); letter-spacing: -0.01em; white-space: nowrap; }
        .fab-logo-text span { color: var(--gold-lt); font-style: italic; }
        .fab-cta-pill { display: flex; align-items: center; gap: 0.5rem; padding: 0 1.1rem 0 0.9rem; height: 52px; background: linear-gradient(135deg, var(--gold-dk) 0%, var(--gold) 100%); }
        .fab-cta-pill svg { width: 15px; height: 15px; color: var(--charcoal); flex-shrink: 0; }
        .fab-cta-text { font-size: 0.78rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: var(--charcoal); white-space: nowrap; }
        .fab-inq::before { content: ''; position: absolute; inset: 0; border-radius: 999px; box-shadow: 0 0 0 0 rgba(201,168,76,0.5); animation: fabPulse 2.8s ease-out infinite; }
        @keyframes fabPulse { 0% { box-shadow: 0 0 0 0 rgba(201,168,76,0.4); } 60% { box-shadow: 0 0 0 12px rgba(201,168,76,0); } 100% { box-shadow: 0 0 0 0 rgba(201,168,76,0); } }
        @media(max-width:500px) { .fab-logo-pill { padding: 0 0.7rem; gap: 0; } .fab-logo-text { display: none; } .fab-cta-text { display: none; } .fab-cta-pill { padding: 0 0.85rem; } .fab-inq { bottom: 1.25rem; right: 1.25rem; } }

        /* ══ SHARED MODAL BASE ══ */
        .modal-backdrop { position: fixed; inset: 0; z-index: 9000; background: rgba(18,15,12,0.72); backdrop-filter: blur(4px); display: none; align-items: center; justify-content: center; padding: 1rem; overflow: hidden; }
        .modal-backdrop.open { display: flex; }
        .modal-box { width: 100%; max-width: 560px; max-height: 92dvh; max-height: 92vh; background: var(--white); border-radius: 8px; box-shadow: 0 24px 64px rgba(18,15,12,0.32), 0 0 0 1px rgba(201,168,76,0.15); display: flex; flex-direction: column; overflow: visible; animation: boxIn 0.3s cubic-bezier(0.34,1.56,0.64,1); }
        @keyframes boxIn { from { opacity: 0; transform: translateY(24px) scale(0.96); } to { opacity: 1; transform: none; } }
        .modal-hd { display: flex; align-items: flex-start; justify-content: space-between; padding: 1.4rem 1.5rem 1.1rem; background: var(--charcoal); position: relative; overflow: hidden; flex-shrink: 0; border-radius: 8px 8px 0 0; }
        .modal-hd::before { content: ''; position: absolute; inset: 0; background-image: radial-gradient(rgba(201,168,76,0.07) 1px, transparent 1px); background-size: 18px 18px; }
        .modal-hd::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, var(--gold), transparent); }
        .modal-hd-brand { display: flex; align-items: center; gap: 0.6rem; position: relative; z-index: 1; }
        .modal-hd-logo { width: 36px; height: 36px; border-radius: 8px; background: rgba(201,168,76,0.15); border: 1px solid rgba(201,168,76,0.3); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .modal-hd-logo svg { width: 18px; height: 18px; color: var(--gold-lt); }
        .modal-hd-title { font-family: var(--font-d); font-size: 1.05rem; font-weight: 700; color: var(--white); line-height: 1.2; }
        .modal-hd-sub { font-size: 0.72rem; color: rgba(255,255,255,0.45); margin-top: 2px; }
        .modal-x { position: relative; z-index: 1; width: 30px; height: 30px; border-radius: 50%; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); cursor: pointer; font-size: 18px; line-height: 1; color: rgba(255,255,255,0.55); display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-left: 0.75rem; transition: background 0.18s, color 0.18s; }
        .modal-x:hover { background: rgba(255,255,255,0.16); color: var(--white); }
        .modal-supplier-strip { display: flex; align-items: center; gap: 0.75rem; padding: 0.85rem 1.5rem; background: rgba(201,168,76,0.04); border-bottom: 1px solid var(--border); flex-shrink: 0; }
        .modal-sup-avatar { width: 38px; height: 38px; border-radius: 50%; flex-shrink: 0; background: linear-gradient(135deg, var(--gold), var(--gold-dk)); display: flex; align-items: center; justify-content: center; font-family: var(--font-d); font-size: 0.85rem; font-weight: 700; color: var(--white); overflow: hidden; border: 2px solid rgba(201,168,76,0.3); }
        .modal-sup-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .modal-sup-name { font-size: 0.82rem; font-weight: 600; color: var(--charcoal); }
        .modal-sup-cat { font-size: 0.68rem; color: var(--warm-grey); }
        .modal-note { display: flex; align-items: center; gap: 0.55rem; padding: 0.6rem 1.5rem; background: rgba(201,168,76,0.06); border-bottom: 1px solid rgba(201,168,76,0.15); flex-shrink: 0; }
        .modal-note svg { width: 13px; height: 13px; color: var(--gold-dk); flex-shrink: 0; }
        .modal-note span { font-size: 0.71rem; color: var(--warm-grey); line-height: 1.4; }
        .modal-note span strong { color: var(--gold-dk); }
        .modal-body { padding: 1.25rem 1.5rem; display: flex; flex-direction: column; gap: 1rem; overflow-y: auto; flex: 1; scrollbar-width: thin; scrollbar-color: var(--border-md) transparent; }
        .modal-body::-webkit-scrollbar { width: 4px; }
        .modal-body::-webkit-scrollbar-track { background: transparent; }
        .modal-body::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 2px; }
        .modal-body::-webkit-scrollbar-thumb:hover { background: var(--gold); }
        .modal-footer { padding: 1rem 1.5rem 1.25rem; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: flex-end; gap: 0.65rem; flex-shrink: 0; background: var(--ivory); border-radius: 0 0 8px 8px; }
        .btn-cancel { padding: 0.6rem 1.25rem; border: 1.5px solid var(--border-md); border-radius: 5px; background: var(--white); font-family: var(--font-b); font-size: 0.82rem; color: var(--warm-grey); cursor: pointer; transition: all 0.18s; }
        .btn-cancel:hover { border-color: var(--gold); color: var(--gold-dk); }
        .btn-send { padding: 0.6rem 1.6rem; border: none; border-radius: 5px; background: var(--charcoal); font-family: var(--font-b); font-size: 0.82rem; font-weight: 700; letter-spacing: 0.04em; color: var(--white); cursor: pointer; position: relative; overflow: hidden; transition: transform 0.15s; display: flex; align-items: center; gap: 0.4rem; }
        .btn-send::after { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, var(--gold-dk), var(--gold)); opacity: 0; transition: opacity 0.25s; }
        .btn-send:hover::after { opacity: 1; }
        .btn-send:hover { transform: translateY(-1px); }
        .btn-send span, .btn-send svg { position: relative; z-index: 1; }
        .btn-send svg { width: 13px; height: 13px; }

        /* ══ INQUIRY FORM FIELDS ══ */
        .fm-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; }
        @media(max-width:480px) { .fm-grid { grid-template-columns: 1fr; } }
        .fm-field { display: flex; flex-direction: column; gap: 0.3rem; }
        .fm-lbl { font-size: 0.68rem; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: var(--warm-grey); }
        .fm-in { border: 1.5px solid var(--border-md); border-radius: 5px; padding: 0.6rem 0.8rem; font-family: var(--font-b); font-size: 0.83rem; color: var(--charcoal); background: var(--ivory); outline: none; transition: border-color 0.18s, box-shadow 0.18s; }
        .fm-in:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,0.1); background: var(--white); }
        .fm-in::placeholder { color: #C8C0B8; }
        textarea.fm-in { resize: vertical; min-height: 110px; }

        /* ══ REVIEWS MODAL ══ */
        .reviews-modal-box {
            max-width: 680px;
        }

        /* ── White header override (Reviews Modal only) ── */
        .modal-hd.modal-hd-white {
            background: var(--white);
            border-bottom: 1px solid var(--border);
        }
        .modal-hd.modal-hd-white::before { display: none; }
        .modal-hd.modal-hd-white::after {
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            opacity: 0.6;
        }
        .modal-hd-white .modal-hd-logo {
            background: rgba(201,168,76,0.1);
            border: 1px solid rgba(201,168,76,0.25);
        }
        .modal-hd-white .modal-hd-logo svg { color: var(--gold-dk); }
        .modal-hd-white .modal-hd-title { color: var(--charcoal); }
        .modal-hd-white .modal-hd-sub { color: var(--warm-grey); }
        .modal-hd-white .modal-x {
            background: rgba(30,27,24,0.06);
            border: 1px solid rgba(30,27,24,0.1);
            color: var(--warm-grey);
        }
        .modal-hd-white .modal-x:hover {
            background: rgba(30,27,24,0.12);
            color: var(--charcoal);
        }

        .reviews-stats-strip {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
            background: rgba(201,168,76,0.03);
        }
        .reviews-total-label {
            font-size: 0.78rem;
            color: var(--warm-grey);
            letter-spacing: 0.03em;
            text-align: center;
        }
        .reviews-total-label strong {
            font-family: var(--font-d);
            font-size: 1.3rem;
            color: var(--charcoal);
            display: block;
        }

        /* Review items */
        .review-item {
            display: flex;
            gap: 0.85rem;
            padding: 1rem;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: var(--white);
            transition: border-color 0.18s;
        }
        .review-item:hover { border-color: rgba(201,168,76,0.3); }
        .review-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            flex-shrink: 0;
            background: linear-gradient(135deg, var(--gold-lt), var(--gold));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--charcoal);
            font-family: var(--font-d);
            border: 2px solid rgba(201,168,76,0.2);
        }
        .review-body { flex: 1; min-width: 0; }
        .review-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 0.5rem; margin-bottom: 6px; flex-wrap: wrap; }
        .review-name { font-size: 0.82rem; font-weight: 700; color: var(--charcoal); }
        .review-date { font-size: 0.63rem; color: #C0B8B0; }
        .review-text { font-size: 0.78rem; color: var(--warm-grey); line-height: 1.6; }
        .review-booking-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            margin-top: 8px;
            font-size: 0.63rem;
            color: var(--gold-dk);
            background: rgba(201,168,76,0.08);
            border: 1px solid rgba(201,168,76,0.18);
            padding: 2px 8px;
            border-radius: 999px;
        }
        .review-booking-tag svg { width: 9px; height: 9px; }

        /* No reviews empty */
        .reviews-empty {
            text-align: center;
            padding: 2.5rem 1.5rem;
        }
        .reviews-empty svg { width: 40px; height: 40px; color: var(--gold); opacity: 0.2; margin: 0 auto 0.65rem; display: block; }
        .reviews-empty-text { font-size: 0.78rem; color: #C0B8B0; }

        /* ══ TOAST ══ */
        .toast-stack { position: fixed; bottom: 5.5rem; right: 2rem; z-index: 8000; display: flex; flex-direction: column; gap: 0.5rem; pointer-events: none; }
        .toast { display: flex; align-items: center; gap: 0.55rem; padding: 0.65rem 1rem; background: var(--charcoal); color: var(--white); border-left: 3px solid var(--gold); border-radius: 4px; box-shadow: 0 4px 16px rgba(30,27,24,0.18); font-size: 0.78rem; font-family: var(--font-b); animation: toastIn 0.38s cubic-bezier(0.34,1.56,0.64,1) forwards; pointer-events: all; min-width: 220px; max-width: 300px; }
        .toast.success { border-left-color: #6EBF7D; }
        .toast.error { border-left-color: #E07B5A; }
        @keyframes toastIn { from { opacity: 0; transform: translateX(24px); } to { opacity: 1; transform: none; } }
        @keyframes toastOut { to { opacity: 0; transform: translateX(24px); } }
        .toast.out { animation: toastOut 0.3s ease forwards; }
        .toast svg { width: 14px; height: 14px; flex-shrink: 0; }

        /* ══ REVEAL ══ */
        .reveal { opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .reveal.visible { opacity: 1; transform: none; }

        /* ══ FOOTER ══ */
        footer { background: var(--charcoal); border-top: 1px solid rgba(201,168,76,0.2); padding: 2.5rem 8%; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
        .footer-brand { font-family: var(--font-d); font-size: 1.15rem; font-weight: 700; color: var(--white); }
        .footer-brand span { color: var(--gold); font-style: italic; }
        .footer-copy { font-size: 0.78rem; color: rgba(255,255,255,0.3); }
        .footer-links { display: flex; gap: 1.5rem; }
        .footer-links a { font-size: 0.78rem; color: rgba(255,255,255,0.4); text-decoration: none; transition: color 0.2s; }
        .footer-links a:hover { color: var(--gold-lt); }

        @media(max-width:680px) {
            .pf-content { padding: 1rem; }
            .pf-avatar { width: 120px; height: 120px; }
            .pf-biz-name { font-size: 1.3rem; }
            .pf-header-body, .pf-nav { padding-left: 1rem; padding-right: 1rem; }
            .modal-box { max-height: 95dvh; max-height: 95vh; border-radius: 12px 12px 0 0; }
            .modal-backdrop { padding: 0; align-items: flex-end; }
            .modal-hd { border-radius: 12px 12px 0 0; }
            .modal-footer { border-radius: 0; }
            .reviews-stats-strip { flex-direction: column; gap: 0.5rem; }
        }
    </style>
</head>

<body>

    {{-- ══ NAVBAR ══ --}}
    <nav class="main-nav">
        <a href="{{ route('welcomepage.welcome') }}" class="nav-logo">WES<span>TEAM</span></a>
        <div class="nav-links">
            <a href="{{ route('welcomepage.welcome') }}">Home</a>
            <a href="{{ route('welcomepage.profile') }}">Suppliers</a>
            <a href="#">Events</a>
            <a href="{{ route('welcomepage.package') }}">Packages</a>
            @if (Route::has('login'))
                @auth <a href="{{ url('/dashboard') }}" class="nav-cta">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Sign In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-cta">Get Started</a>
                    @endif
                @endauth
            @endif
        </div>
        <button class="hamburger" id="hamburger"><span></span><span></span><span></span></button>
    </nav>

    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('welcomepage.welcome') }}" onclick="closeMenu()">Home</a>
        <a href="{{ route('welcomepage.profile') }}" onclick="closeMenu()">Suppliers</a>
        <a href="#" onclick="closeMenu()">Events</a>
        <a href="{{ route('welcomepage.package') }}" onclick="closeMenu()">Packages</a>
        @if (Route::has('login'))
            @auth <a href="{{ url('/dashboard') }}" class="mob-cta">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="mob-cta">Sign In</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="mob-cta" style="margin-top:.5rem;">Get Started</a>
                @endif
            @endauth
        @endif
    </div>

    {{-- ══ PAGE HEADER ══ --}}
    <div class="page-header">
        <div class="page-header-inner">
            <div>
                <div class="ph-eyebrow">Portfolio</div>
                <h1>Supplier <em>Gallery</em></h1>
            </div>
            @if (isset($portfolios) && count($portfolios))
                <span class="ph-count">{{ count($portfolios) }} post{{ count($portfolios) !== 1 ? 's' : '' }}</span>
            @endif
        </div>
    </div>

    {{-- ══ PROFILE HEADER BODY ══ --}}
    <div class="pf-header-body">
        <div class="pf-avatar-row">
            <div class="pf-avatar">
                @if ($supplier->photo)
                    <img src="{{ asset('storage/' . $supplier->photo) }}" alt="{{ $supplier->business_name }}">
                @else
                    {{ strtoupper(substr($supplier->business_name ?? ($supplier->first_name ?? 'S'), 0, 2)) }}
                @endif
            </div>
            <div class="pf-header-info">
                <div class="pf-biz-name">
                    {{ $supplier->business_name ?? trim(($supplier->first_name ?? '') . ' ' . ($supplier->last_name ?? '')) }}
                </div>
                @if ($supplier->tagline)
                    <div class="pf-tagline">"{{ $supplier->tagline }}"</div>
                @endif
                <div class="pf-meta-chips">
                    @if ($supplier->city || $supplier->province)
                        <span class="pf-meta-chip">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M8 1C5.8 1 4 2.8 4 5c0 3.5 4 9 4 9s4-5.5 4-9c0-2.2-1.8-4-4-4z"/>
                                <circle cx="8" cy="5" r="1.5"/>
                            </svg>
                            {{ implode(', ', array_filter([$supplier->city, $supplier->province])) }}
                        </span>
                    @endif
                    @if ($supplier->phone)
                        <span class="pf-meta-chip">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M2 3a2 2 0 012-2h1l1.5 3-1 1a7 7 0 003 3l1-1L13 9.5V11a2 2 0 01-2 2C5 13 2 10 2 6V3z"/>
                            </svg>
                            {{ $supplier->phone }}
                        </span>
                    @endif
                    @php $cats = $supplier->user->categories ?? collect(); @endphp
                    @foreach ($cats as $cat)
                        <span class="pf-meta-chip">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <rect x="2" y="2" width="5" height="5" rx="1"/>
                                <rect x="9" y="2" width="5" height="5" rx="1"/>
                                <rect x="2" y="9" width="5" height="5" rx="1"/>
                                <rect x="9" y="9" width="5" height="5" rx="1"/>
                            </svg>
                            <strong>{{ $cat->name }}</strong>
                        </span>
                    @endforeach
                    @php $pfCount = $portfolios->count(); @endphp
                    <span class="pf-meta-chip">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="2" y="3" width="12" height="10" rx="1.5"/>
                            <circle cx="6" cy="7" r="1.5"/>
                            <path d="M2 11l3-3 2.5 2.5 2-2L14 11"/>
                        </svg>
                        {{ $pfCount }} portfolio item{{ $pfCount !== 1 ? 's' : '' }}
                    </span>
                    {{-- Reviews chip --}}
                    @php
                        $reviews = $supplier->ratings;
                        $reviewCount = $reviews->count();
                    @endphp
                    @if ($reviewCount)
                        <span class="pf-meta-chip" style="cursor:pointer;" onclick="openReviewsModal()">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M2 5h12M2 8h12M2 11h8"/>
                            </svg>
                            <strong style="color:var(--gold-dk);">{{ $reviewCount }} review{{ $reviewCount !== 1 ? 's' : '' }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ══ NAV TABS ══ --}}
    <div class="pf-nav">
        <button class="pf-nav-tab active" onclick="switchPanel('photos', this)">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                <rect x="2" y="3" width="12" height="10" rx="1.5"/>
                <circle cx="6" cy="7" r="1.5"/>
                <path d="M2 11l3-3 2.5 2.5 2-2L14 11"/>
            </svg>
            Photos
        </button>
        <button class="pf-nav-tab" onclick="switchPanel('videos', this)">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                <polygon points="5 3 13 8 5 13 5 3"/>
                <rect x="2" y="2" width="12" height="12" rx="2"/>
            </svg>
            Videos
        </button>
        <button class="pf-nav-tab" onclick="switchPanel('about', this)">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                <circle cx="8" cy="5" r="3"/>
                <path d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6"/>
            </svg>
            About
        </button>
    </div>

    {{-- ══ CONTENT ══ --}}
    <div class="pf-content">

        {{-- LEFT sidebar --}}
        <div class="pf-about-card">
            <div class="pf-about-head">
                <div class="pf-about-head-icon">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="7" cy="5" r="3"/>
                        <path d="M1 13c0-3 2.7-5 6-5s6 2 6 5"/>
                    </svg>
                </div>
                <div class="pf-about-title">About</div>
            </div>
            <div class="pf-about-body">
                @if ($supplier->bio)
                    <div class="pf-bio-text">"{{ $supplier->bio }}"</div>
                @endif
                @if ($supplier->city || $supplier->province)
                    <div class="pf-about-row">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M8 1C5.8 1 4 2.8 4 5c0 3.5 4 9 4 9s4-5.5 4-9c0-2.2-1.8-4-4-4z"/>
                            <circle cx="8" cy="5" r="1.5"/>
                        </svg>
                        <div class="pf-about-row-text">
                            {{ implode(', ', array_filter([$supplier->city, $supplier->province])) }}<small>Location</small>
                        </div>
                    </div>
                @endif
                @if ($supplier->address)
                    <div class="pf-about-row">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M2 10V6l6-4 6 4v4M5 10V7h6v3"/>
                        </svg>
                        <div class="pf-about-row-text">{{ $supplier->address }}<small>Full Address</small></div>
                    </div>
                @endif
                @if ($supplier->phone)
                    <div class="pf-about-row">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M2 3a2 2 0 012-2h1l1.5 3-1 1a7 7 0 003 3l1-1L13 9.5V11a2 2 0 01-2 2C5 13 2 10 2 6V3z"/>
                        </svg>
                        <div class="pf-about-row-text">{{ $supplier->phone }}<small>Phone</small></div>
                    </div>
                @endif
                @foreach ($cats as $cat)
                    <div class="pf-about-row">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="2" y="2" width="5" height="5" rx="1"/>
                            <rect x="9" y="2" width="5" height="5" rx="1"/>
                            <rect x="2" y="9" width="5" height="5" rx="1"/>
                            <rect x="9" y="9" width="5" height="5" rx="1"/>
                        </svg>
                        <div class="pf-about-row-text">{{ $cat->name }}<small>Category</small></div>
                    </div>
                @endforeach
            </div>

            {{-- ── REVIEWS BUTTON ── --}}
            <button class="pf-reviews-btn" onclick="openReviewsModal()" type="button">
                <div class="pf-reviews-btn-left">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M2 4h12M2 8h12M2 12h8"/>
                    </svg>
                    <span class="pf-reviews-btn-label">Client Reviews</span>
                </div>
                <div class="pf-reviews-btn-right">
                    @if ($reviewCount)
                        <span class="pf-reviews-count-badge">{{ $reviewCount }}</span>
                    @else
                        <span style="font-size:0.68rem;color:#C0B8B0;">No reviews yet</span>
                    @endif
                    <svg class="pf-reviews-btn-arrow" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 3l5 5-5 5"/>
                    </svg>
                </div>
            </button>
        </div>

        {{-- RIGHT panels --}}
        <div>

            {{-- PHOTOS --}}
            <div id="panel-photos" class="pf-panel active">
                <div class="pf-section-head">
                    <div class="pf-section-title"><em>Photos</em></div>
                </div>
                @php
                    $allImages = [];
                    foreach ($portfolios as $pf) {
                        $imgs = $pf->images ?? [];
                        if (is_string($imgs)) { $imgs = json_decode($imgs, true) ?? []; }
                        foreach ($imgs as $img) {
                            $allImages[] = [
                                'url' => asset('storage/' . $img),
                                'title' => $pf->title,
                                'portfolio_id' => $pf->id,
                            ];
                        }
                    }
                    $allImageUrls = array_column($allImages, 'url');
                @endphp
                @if (count($allImages))
                    <div class="pf-sub-tabs" id="pfSubTabs">
                        <button class="pf-sub-tab active" data-target="all" onclick="filterPortfolio(this)">All Photos</button>
                        @foreach ($portfolios as $pf)
                            @php
                                $pfImgs = $pf->images ?? [];
                                if (is_string($pfImgs)) { $pfImgs = json_decode($pfImgs, true) ?? []; }
                            @endphp
                            @if (count($pfImgs))
                                <button class="pf-sub-tab" data-target="pf{{ $pf->id }}" onclick="filterPortfolio(this)">{{ $pf->title }}</button>
                            @endif
                        @endforeach
                    </div>
                    <div id="grid-all" class="pf-portfolio-block">
                        <div class="pf-photo-grid">
                            @foreach ($allImages as $idx => $item)
                                <div class="pf-photo-cell" onclick="lbOpen({{ json_encode($allImageUrls) }}, {{ $idx }}, 'Portfolio')">
                                    <img src="{{ $item['url'] }}" alt="" loading="lazy">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @foreach ($portfolios as $pf)
                        @php
                            $pfImgs = $pf->images ?? [];
                            if (is_string($pfImgs)) { $pfImgs = json_decode($pfImgs, true) ?? []; }
                            $pfUrls = array_map(fn($i) => asset('storage/' . $i), $pfImgs);
                        @endphp
                        @if (count($pfImgs))
                            <div id="grid-pf{{ $pf->id }}" class="pf-portfolio-block" style="display:none;">
                                <div class="pf-portfolio-post-head">
                                    <div class="pf-post-num">{{ $loop->iteration }}</div>
                                    <div>
                                        <div class="pf-post-title">{{ $pf->title }}</div>
                                        @if ($pf->description)
                                            <div class="pf-post-desc">{{ $pf->description }}</div>
                                        @endif
                                        @if ($pf->created_at)
                                            <div class="pf-post-date">{{ $pf->created_at->diffForHumans() }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="pf-photo-grid">
                                    @foreach ($pfImgs as $idx => $img)
                                        <div class="pf-photo-cell" onclick="lbOpen({{ json_encode($pfUrls) }}, {{ $idx }}, '{{ addslashes($pf->title) }}')">
                                            <img src="{{ asset('storage/' . $img) }}" alt="" loading="lazy">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="pf-empty">
                        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
                            <rect x="4" y="4" width="40" height="40" rx="4"/>
                            <circle cx="16" cy="18" r="4"/>
                            <path d="M4 34l12-12 8 8 6-6 14 14"/>
                        </svg>
                        <div class="pf-empty-text">No photos uploaded yet.</div>
                    </div>
                @endif
            </div>

            {{-- VIDEOS --}}
            <div id="panel-videos" class="pf-panel">
                <div class="pf-section-head">
                    <div class="pf-section-title"><em>Videos</em></div>
                </div>
                @php $hasVideos = $portfolios->filter(fn($p) => !empty($p->video))->count(); @endphp
                @if ($hasVideos)
                    <div class="pf-video-grid">
                        @foreach ($portfolios->filter(fn($p) => !empty($p->video)) as $pf)
                            <div class="pf-video-card">
                                <video controls preload="metadata">
                                    <source src="{{ asset('storage/' . $pf->video) }}">
                                </video>
                                <div class="pf-video-info">
                                    <div class="pf-video-title">{{ $pf->title }}</div>
                                    @if ($pf->description)
                                        <div class="pf-post-desc" style="font-size:.76rem;color:var(--warm-grey);margin-top:2px;">{{ $pf->description }}</div>
                                    @endif
                                    @if ($pf->created_at)
                                        <div class="pf-video-date">{{ $pf->created_at->diffForHumans() }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="pf-empty">
                        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
                            <polygon points="10 6 38 24 10 42 10 6"/>
                            <rect x="2" y="2" width="44" height="44" rx="4"/>
                        </svg>
                        <div class="pf-empty-text">No videos uploaded yet.</div>
                    </div>
                @endif
            </div>

            {{-- ABOUT --}}
            <div id="panel-about" class="pf-panel">
                <div class="pf-section-head">
                    <div class="pf-section-title">Supplier <em>Details</em></div>
                </div>
                <div class="pf-about-full">
                    @if ($supplier->bio || $supplier->description)
                        <div class="pf-info-card">
                            <div class="pf-info-card-head">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <rect x="2" y="2" width="12" height="12" rx="2"/>
                                    <path d="M5 6h6M5 9h4"/>
                                </svg>
                                <div class="pf-info-card-title">About & Services</div>
                            </div>
                            <div style="padding:1rem 1.1rem;display:flex;flex-direction:column;gap:.75rem;">
                                @if ($supplier->bio)
                                    <div>
                                        <div class="pf-info-k">Bio</div>
                                        <div class="pf-info-v" style="font-style:italic;color:var(--warm-grey);">{{ $supplier->bio }}</div>
                                    </div>
                                @endif
                                @if ($supplier->description)
                                    <div>
                                        <div class="pf-info-k">Service Description</div>
                                        <div class="pf-info-v" style="color:var(--warm-grey);">{{ $supplier->description }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="pf-info-card">
                        <div class="pf-info-card-head">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M8 1C5.8 1 4 2.8 4 5c0 3.5 4 9 4 9s4-5.5 4-9c0-2.2-1.8-4-4-4z"/>
                                <circle cx="8" cy="5" r="1.5"/>
                            </svg>
                            <div class="pf-info-card-title">Contact & Location</div>
                        </div>
                        <div class="pf-info-card-body">
                            <div>
                                <div class="pf-info-k">Full Name</div>
                                <div class="pf-info-v">{{ trim(($supplier->first_name ?? '') . ' ' . ($supplier->last_name ?? '')) ?: '—' }}</div>
                            </div>
                            <div>
                                <div class="pf-info-k">Phone</div>
                                <div class="pf-info-v {{ !$supplier->phone ? 'nil' : '' }}">{{ $supplier->phone ?? '—' }}</div>
                            </div>
                            <div>
                                <div class="pf-info-k">City</div>
                                <div class="pf-info-v {{ !$supplier->city ? 'nil' : '' }}">{{ $supplier->city ?? '—' }}</div>
                            </div>
                            <div>
                                <div class="pf-info-k">Province</div>
                                <div class="pf-info-v {{ !$supplier->province ? 'nil' : '' }}">{{ $supplier->province ?? '—' }}</div>
                            </div>
                            <div class="pf-full-row">
                                <div class="pf-info-k">Address</div>
                                <div class="pf-info-v {{ !$supplier->address ? 'nil' : '' }}">{{ $supplier->address ?? '—' }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- ── REVIEWS SUMMARY CARD in About panel ── --}}
                    <div class="pf-reviews-summary-card">
                        <div class="pf-reviews-summary-head">
                            <div class="pf-reviews-summary-head-left">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M2 4h12M2 8h12M2 12h8"/>
                                </svg>
                                <div class="pf-info-card-title">Client Reviews</div>
                            </div>
                            @if ($reviewCount)
                                <button class="pf-btn-see-all" onclick="openReviewsModal()" type="button">
                                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="8" cy="8" r="6"/>
                                        <path d="M8 5v3l2 2"/>
                                    </svg>
                                    See all {{ $reviewCount }} review{{ $reviewCount !== 1 ? 's' : '' }}
                                </button>
                            @endif
                        </div>

                        @if ($reviewCount)
                            <div class="pf-reviews-overview" style="justify-content:center;">
                                <div class="pf-reviews-big-score">
                                    <div class="pf-big-score-num">{{ $reviewCount }}</div>
                                    <div class="pf-big-score-label">REVIEW{{ $reviewCount !== 1 ? 'S' : '' }} FROM CLIENTS</div>
                                </div>
                            </div>
                            <div class="pf-reviews-preview">
                                @foreach ($reviews->take(2) as $rev)
                                    @php
                                        $revUser = $rev->user ?? null;
                                        $revName = $revUser ? trim(($revUser->name ?? '')) : 'Client';
                                        $initials = strtoupper(substr($revName, 0, 2));
                                    @endphp
                                    <div class="pf-review-item-mini">
                                        <div class="pf-review-avatar-mini">{{ $initials }}</div>
                                        <div class="pf-review-content-mini">
                                            <div class="pf-review-meta-mini">
                                                <span class="pf-review-name-mini">{{ $revName }}</span>
                                                @if ($rev->created_at)
                                                    <span class="pf-review-date-mini">{{ $rev->created_at->diffForHumans() }}</span>
                                                @endif
                                            </div>
                                            @if ($rev->review)
                                                <div class="pf-review-text-mini">{{ $rev->review }}</div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                @if ($reviewCount > 2)
                                    <button onclick="openReviewsModal()" type="button" style="background:none;border:none;cursor:pointer;font-size:0.76rem;color:var(--gold-dk);font-family:var(--font-b);font-weight:600;text-align:left;padding:0;">
                                        + {{ $reviewCount - 2 }} more review{{ $reviewCount - 2 !== 1 ? 's' : '' }} →
                                    </button>
                                @endif
                            </div>
                        @else
                            <div class="pf-empty" style="padding:2rem;">
                                <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
                                    <path d="M8 14h32v18H20l-8 8V32H8z"/>
                                </svg>
                                <div class="pf-empty-text">No reviews yet. Be the first to leave one!</div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

        </div>{{-- /right --}}
    </div>{{-- /pf-content --}}

    <div class="toast-stack" id="toastStack"></div>

    {{-- ══ REVIEWS MODAL ══ --}}
    <div id="reviewsModal" class="modal-backdrop" onclick="if(event.target===this)closeReviewsModal()">
        <div class="modal-box reviews-modal-box">

            {{-- Header (white) --}}
            <div class="modal-hd modal-hd-white">
                <div class="modal-hd-brand">
                    <div class="modal-hd-logo">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M2 4h12M2 8h12M2 12h8"/>
                        </svg>
                    </div>
                    <div class="modal-hd-info">
                        <div class="modal-hd-title">Client Reviews</div>
                        <div class="modal-hd-sub">
                            {{ $supplier->business_name ?? trim(($supplier->first_name ?? '') . ' ' . ($supplier->last_name ?? '')) }}
                            @if ($reviewCount) · {{ $reviewCount }} review{{ $reviewCount !== 1 ? 's' : '' }} @endif
                        </div>
                    </div>
                </div>
                <button class="modal-x" onclick="closeReviewsModal()">&#215;</button>
            </div>

            @if ($reviewCount)
                {{-- Stats strip --}}
                <div class="reviews-stats-strip">
                    <div class="reviews-total-label">
                        <strong>{{ $reviewCount }}</strong>
                        Total review{{ $reviewCount !== 1 ? 's' : '' }} from clients
                    </div>
                </div>

                {{-- Scrollable list --}}
                <div class="modal-body" id="reviewsList">
                    @foreach ($reviews as $rev)
                        @php
                            $revUser = $rev->user ?? null;
                            $revName = $revUser ? trim(($revUser->name ?? '')) : 'Client';
                            if (empty(trim($revName))) $revName = 'Anonymous Client';
                            $initials = strtoupper(substr($revName, 0, 2));
                        @endphp
                        <div class="review-item">
                            <div class="review-avatar">{{ $initials }}</div>
                            <div class="review-body">
                                <div class="review-top">
                                    <span class="review-name">{{ $revName }}</span>
                                    @if ($rev->created_at)
                                        <span class="review-date">{{ $rev->created_at->format('M d, Y') }}</span>
                                    @endif
                                </div>
                                @if ($rev->review)
                                    <div class="review-text">{{ $rev->review }}</div>
                                @endif
                                @if ($rev->booking_id)
                                    <div class="review-booking-tag">
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                                            <rect x="2" y="3" width="12" height="11" rx="1.5"/>
                                            <path d="M5 1v4M11 1v4M2 7h12"/>
                                        </svg>
                                        Verified booking
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

            @else
                <div class="modal-body">
                    <div class="reviews-empty">
                        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
                            <path d="M8 14h32v18H20l-8 8V32H8z"/>
                        </svg>
                        <div class="reviews-empty-text">No reviews yet for this supplier.</div>
                    </div>
                </div>
            @endif

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeReviewsModal()">Close</button>
            </div>
        </div>
    </div>

    {{-- ══ LIGHTBOX ══ --}}
    <div id="pfLb" class="pf-lb" onclick="if(event.target===this)lbClose()">
        <div class="pf-lb-bar">
            <span class="pf-lb-title" id="lbTitle"></span>
            <div style="display:flex;align-items:center;gap:.6rem;">
                <span class="pf-lb-counter" id="lbCounter"></span>
                <button class="pf-lb-close" onclick="lbClose()">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M2 2l10 10M12 2L2 12"/></svg>
                </button>
            </div>
        </div>
        <div class="pf-lb-main">
            <button class="pf-lb-nav lp" id="lbPrev" onclick="lbNav(-1)">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 2L4 7l5 5"/></svg>
            </button>
            <img class="pf-lb-img" id="lbImg" src="" alt="">
            <button class="pf-lb-nav ln" id="lbNext" onclick="lbNav(1)">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 2l5 5-5 5"/></svg>
            </button>
        </div>
        <div class="pf-lb-strip" id="lbStrip"></div>
    </div>

    {{-- ══ FOOTER ══ --}}
    <footer>
        <div class="footer-brand">WES<span>TEAM</span></div>
        <div class="footer-links">
            <a href="#">Privacy</a><a href="#">Terms</a><a href="#">Support</a><a href="#">Blog</a>
        </div>
        <div class="footer-copy">© {{ date('Y') }} WES TEAM. All rights reserved.</div>
    </footer>

    <script>
        /* ── HAMBURGER ── */
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');
        hamburger?.addEventListener('click', () => {
            const open = mobileMenu.classList.toggle('open');
            hamburger.classList.toggle('open', open);
            document.body.style.overflow = open ? 'hidden' : '';
        });
        document.addEventListener('click', e => {
            if (!hamburger?.contains(e.target) && !mobileMenu?.contains(e.target)) {
                mobileMenu?.classList.remove('open');
                hamburger?.classList.remove('open');
                document.body.style.overflow = '';
            }
        });
        function closeMenu() {
            mobileMenu?.classList.remove('open');
            hamburger?.classList.remove('open');
            document.body.style.overflow = '';
        }

        /* ── PANEL SWITCH ── */
        function switchPanel(id, btn) {
            document.querySelectorAll('.pf-nav-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.pf-panel').forEach(p => p.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById('panel-' + id).classList.add('active');
        }

        /* ── PORTFOLIO SUB-TABS ── */
        function filterPortfolio(btn) {
            document.querySelectorAll('.pf-sub-tab').forEach(t => t.classList.remove('active'));
            btn.classList.add('active');
            const target = btn.dataset.target;
            document.querySelectorAll('.pf-portfolio-block').forEach(b => {
                b.style.display = (target === 'all' || b.id === 'grid-' + target) ? '' : 'none';
            });
        }

        /* ── REVIEWS MODAL ── */
        function openReviewsModal() {
            document.getElementById('reviewsModal').classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function closeReviewsModal() {
            document.getElementById('reviewsModal').classList.remove('open');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                closeReviewsModal();
                lbClose();
            }
        });

        /* ── TOAST ── */
        function showToast(type, msg) {
            const el = document.createElement('div');
            el.className = 'toast ' + type;
            const icons = {
                success: '<svg viewBox="0 0 16 16" fill="none" stroke="#6EBF7D" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg>',
                error:   '<svg viewBox="0 0 16 16" fill="none" stroke="#E07B5A" stroke-width="2"><path d="M4 4l8 8M12 4L4 12"/></svg>'
            };
            el.innerHTML = icons[type] + msg;
            document.getElementById('toastStack').appendChild(el);
            setTimeout(() => {
                el.classList.add('out');
                el.addEventListener('animationend', () => el.remove());
            }, 4200);
        }

        /* ── LIGHTBOX ── */
        let lbUrls = [], lbIdx = 0;
        function lbOpen(urls, idx, title) {
            lbUrls = urls; lbIdx = idx;
            document.getElementById('lbTitle').textContent = title || '';
            const strip = document.getElementById('lbStrip');
            strip.innerHTML = '';
            if (urls.length > 1) {
                urls.forEach((url, i) => {
                    const th = document.createElement('img');
                    th.src = url;
                    th.className = 'pf-lb-thumb' + (i === idx ? ' active' : '');
                    th.onclick = () => lbGo(i);
                    strip.appendChild(th);
                });
            }
            document.getElementById('pfLb').classList.add('open');
            document.body.style.overflow = 'hidden';
            lbGo(idx);
        }
        function lbGo(idx) {
            lbIdx = idx;
            document.getElementById('lbImg').src = lbUrls[idx];
            document.getElementById('lbCounter').textContent = lbUrls.length > 1 ? (idx + 1) + ' / ' + lbUrls.length : '';
            document.getElementById('lbPrev').style.display = idx === 0 ? 'none' : 'flex';
            document.getElementById('lbNext').style.display = idx === lbUrls.length - 1 ? 'none' : 'flex';
            document.querySelectorAll('.pf-lb-thumb').forEach((t, i) => t.classList.toggle('active', i === idx));
            const active = document.querySelectorAll('.pf-lb-thumb')[idx];
            if (active) active.scrollIntoView({ block: 'nearest', inline: 'center', behavior: 'smooth' });
        }
        function lbNav(dir) {
            const n = lbIdx + dir;
            if (n >= 0 && n < lbUrls.length) lbGo(n);
        }
        function lbClose() {
            document.getElementById('pfLb').classList.remove('open');
            if (!document.getElementById('reviewsModal').classList.contains('open'))
                document.body.style.overflow = '';
        }

        /* ── SCROLL REVEAL ── */
        const io = new IntersectionObserver(entries => {
            entries.forEach((e, i) => {
                if (e.isIntersecting) {
                    setTimeout(() => e.target.classList.add('visible'), i * 55);
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.06 });
        document.querySelectorAll('.reveal').forEach(el => io.observe(el));
    </script>
</body>
</html>