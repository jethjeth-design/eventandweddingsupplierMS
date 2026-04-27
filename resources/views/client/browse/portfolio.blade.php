<x-client-layout>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap');

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

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    .pf-page { max-width: 1100px; margin: 0 auto; font-family: var(--font-body); padding-bottom: 4rem; }

    /* ══════════════════════════════
       PROFILE HEADER (Facebook-style)
    ══════════════════════════════ */
    .pf-cover {
        height: 260px;
        background: linear-gradient(135deg, var(--charcoal) 0%, #2a2016 50%, #3d2f14 100%);
        position: relative; overflow: hidden; border-radius: 0 0 4px 4px;
    }
    .pf-cover::before {
        content: ''; position: absolute; inset: 0;
        background-image: radial-gradient(rgba(201,168,76,0.08) 1px, transparent 1px);
        background-size: 24px 24px;
    }
    .pf-cover::after {
        content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }

    /* Header content area */
    .pf-header-body {
        background: var(--white);
        border-bottom: 1px solid var(--border);
        padding: 0 2rem 0;
        position: relative;
    }

    /* Avatar overlapping cover */
    .pf-avatar-row {
        display: flex; align-items: flex-end; gap: 1.25rem;
        flex-wrap: wrap;
        margin-top: 5px;
        padding-bottom: 1rem;
        position: relative; z-index: 2;
    }
    .pf-avatar {
        width: 168px; height: 168px; border-radius: 50%;
        background: linear-gradient(135deg, var(--gold), var(--gold-dark));
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display); font-size: 3.5rem; font-weight: 700;
        color: var(--white); overflow: hidden; flex-shrink: 0;
        border: 5px solid var(--white);
        box-shadow: 0 4px 20px rgba(30,27,24,0.22);
    }
    .pf-avatar img { width: 100%; height: 100%; object-fit: cover; }

    .pf-header-info { flex: 1; padding-bottom: 0.5rem; min-width: 0; }
    .pf-biz-name { font-family: var(--font-display); font-size: 1.65rem; font-weight: 700; color: var(--charcoal); line-height: 1.15; }
    .pf-tagline { font-size: 0.82rem; color: var(--warm-grey); margin-top: 0.2rem; font-style: italic; }
    .pf-meta-chips { display: flex; flex-wrap: wrap; gap: 0.5rem 1.1rem; margin-top: 0.55rem; }
    .pf-meta-chip { display: flex; align-items: center; gap: 0.35rem; font-size: 0.76rem; color: var(--warm-grey); }
    .pf-meta-chip svg { width: 13px; height: 13px; color: var(--gold-dark); flex-shrink: 0; }
    .pf-meta-chip strong { color: var(--charcoal); font-weight: 600; }

    /* Nav tabs (like Facebook: All / Portfolio / About) */
    .pf-nav {
        border-top: 1px solid var(--border);
        display: flex; align-items: center; gap: 0;
        padding: 0 2rem;
        background: var(--white);
        overflow-x: auto; scrollbar-width: none;
    }
    .pf-nav::-webkit-scrollbar { display: none; }
    .pf-nav-tab {
        display: flex; align-items: center; gap: 0.45rem;
        padding: 0.85rem 1.1rem;
        font-size: 0.83rem; font-weight: 500; color: var(--warm-grey);
        border-bottom: 3px solid transparent;
        cursor: pointer; background: none; border-left: none; border-right: none; border-top: none;
        font-family: var(--font-body); white-space: nowrap;
        transition: color 0.18s, border-color 0.18s;
    }
    .pf-nav-tab svg { width: 14px; height: 14px; flex-shrink: 0; }
    .pf-nav-tab:hover { color: var(--charcoal); }
    .pf-nav-tab.active { color: var(--gold-dark); border-bottom-color: var(--gold); font-weight: 700; }

    /* ══════════════════════════════
       CONTENT AREA
    ══════════════════════════════ */
    .pf-content { padding: 1.5rem 2rem; display: grid; grid-template-columns: 280px 1fr; gap: 1.25rem; align-items: start; }
    @media(max-width:860px){ .pf-content { grid-template-columns: 1fr; } }

    /* ── LEFT: About card ── */
    .pf-about-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; overflow: hidden; position: sticky; top: 1rem; }
    .pf-about-head { padding: 0.85rem 1.1rem; border-bottom: 1px solid var(--border); background: var(--ivory); display: flex; align-items: center; gap: 0.55rem; }
    .pf-about-head-icon { width: 28px; height: 28px; border-radius: 6px; background: rgba(201,168,76,0.12); display: flex; align-items: center; justify-content: center; color: var(--gold-dark); flex-shrink: 0; }
    .pf-about-head-icon svg { width: 13px; height: 13px; }
    .pf-about-title { font-family: var(--font-display); font-size: 0.88rem; font-weight: 700; color: var(--charcoal); }
    .pf-about-body { padding: 1rem 1.1rem; display: flex; flex-direction: column; gap: 0.75rem; }
    .pf-about-row { display: flex; align-items: flex-start; gap: 0.55rem; }
    .pf-about-row svg { width: 14px; height: 14px; color: var(--gold-dark); flex-shrink: 0; margin-top: 2px; }
    .pf-about-row-text { font-size: 0.8rem; color: var(--charcoal); line-height: 1.45; }
    .pf-about-row-text small { display: block; font-size: 0.68rem; color: var(--warm-grey); margin-top: 1px; }
    .pf-bio-text { font-size: 0.8rem; color: var(--warm-grey); line-height: 1.6; font-style: italic; padding: 0.65rem 0.85rem; background: rgba(201,168,76,0.04); border: 1px solid rgba(201,168,76,0.15); border-radius: 3px; }

    /* ── RIGHT: Portfolio panels ── */
    .pf-panel { display: none; }
    .pf-panel.active { display: block; }

    /* Photos section header (like Facebook "Photos") */
    .pf-section-head {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 0.85rem; flex-wrap: wrap; gap: 0.5rem;
    }
    .pf-section-title { font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; color: var(--charcoal); }
    .pf-section-title em { font-style: italic; color: var(--gold-dark); }

    /* Sub-tabs (Your photos / Videos) */
    .pf-sub-tabs { display: flex; align-items: center; gap: 0.35rem; margin-bottom: 1rem; flex-wrap: wrap; }
    .pf-sub-tab { padding: 0.3rem 0.9rem; border-radius: 999px; font-size: 0.74rem; font-weight: 500; border: 1.5px solid var(--border-md); background: var(--ivory); color: var(--warm-grey); cursor: pointer; font-family: var(--font-body); transition: all 0.18s; }
    .pf-sub-tab:hover { border-color: var(--gold); color: var(--gold-dark); }
    .pf-sub-tab.active { background: var(--gold); border-color: var(--gold); color: var(--charcoal); font-weight: 600; }

    /* ── FACEBOOK-STYLE PHOTO GRID ── */
    .pf-photo-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 3px;
    }
    @media(max-width:640px){ .pf-photo-grid { grid-template-columns: repeat(3,1fr); } }

    .pf-photo-cell {
        aspect-ratio: 1;
        overflow: hidden;
        position: relative;
        cursor: pointer;
        background: var(--charcoal);
        border-radius: 2px;
    }
    .pf-photo-cell img {
        width: 100%; height: 100%; object-fit: cover; display: block;
        transition: transform 0.28s ease, opacity 0.2s;
    }
    .pf-photo-cell:hover img { transform: scale(1.06); opacity: 0.88; }
    .pf-photo-cell::after {
        content: '';
        position: absolute; inset: 0;
        background: rgba(201,168,76,0);
        transition: background 0.2s;
        pointer-events: none;
    }
    .pf-photo-cell:hover::after { background: rgba(201,168,76,0.08); }

    /* Portfolio post separator */
    .pf-portfolio-post { margin-bottom: 1.5rem; }
    .pf-portfolio-post-head { display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.65rem; }
    .pf-post-num {
        width: 28px; height: 28px; border-radius: 50%; flex-shrink: 0;
        background: rgba(201,168,76,0.12); border: 1px solid rgba(201,168,76,0.3);
        display: flex; align-items: center; justify-content: center;
        font-size: 0.65rem; font-weight: 700; color: var(--gold-dark); font-family: var(--font-display);
    }
    .pf-post-title { font-family: var(--font-display); font-size: 0.88rem; font-weight: 700; color: var(--charcoal); }
    .pf-post-desc { font-size: 0.76rem; color: var(--warm-grey); line-height: 1.45; }
    .pf-post-date { font-size: 0.65rem; color: #C0B8B0; }

    /* ── VIDEO SECTION ── */
    .pf-video-grid { display: flex; flex-direction: column; gap: 1rem; }
    .pf-video-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; overflow: hidden; }
    .pf-video-card video { width: 100%; max-height: 400px; display: block; object-fit: contain; background: #000; }
    .pf-video-info { padding: 0.75rem 1rem; border-top: 1px solid var(--border); }
    .pf-video-title { font-family: var(--font-display); font-size: 0.85rem; font-weight: 700; color: var(--charcoal); }
    .pf-video-date  { font-size: 0.68rem; color: #C0B8B0; margin-top: 2px; }

    /* ── ABOUT PANEL ── */
    .pf-about-full { display: flex; flex-direction: column; gap: 1rem; }
    .pf-info-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; overflow: hidden; }
    .pf-info-card-head { padding: 0.8rem 1.1rem; border-bottom: 1px solid var(--border); background: var(--ivory); display: flex; align-items: center; gap: 0.5rem; }
    .pf-info-card-head svg { width: 14px; height: 14px; color: var(--gold-dark); }
    .pf-info-card-title { font-family: var(--font-display); font-size: 0.88rem; font-weight: 700; color: var(--charcoal); }
    .pf-info-card-body { padding: 1rem 1.1rem; display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem; }
    @media(max-width:560px){ .pf-info-card-body { grid-template-columns: 1fr; } }
    .pf-info-k { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: #C0B8B0; margin-bottom: 0.2rem; }
    .pf-info-v { font-size: 0.82rem; color: var(--charcoal); font-weight: 500; }
    .pf-info-v.nil { color: #C0B8B0; font-style: italic; font-size: 0.76rem; }
    .pf-full-row { grid-column: 1/-1; }

    /* ── EMPTY STATE ── */
    .pf-empty { text-align: center; padding: 3.5rem 2rem; }
    .pf-empty svg { width: 44px; height: 44px; color: var(--gold); opacity: 0.25; margin: 0 auto 0.75rem; display: block; }
    .pf-empty-text { font-size: 0.8rem; color: #C0B8B0; }

    /* ══════════════════════════════
       LIGHTBOX
    ══════════════════════════════ */
    .pf-lb { position: fixed; inset: 0; z-index: 9999; background: rgba(0,0,0,0.97); display: none; flex-direction: column; }
    .pf-lb.open { display: flex; }
    .pf-lb-bar { display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 1.25rem; background: rgba(0,0,0,0.65); flex-shrink: 0; }
    .pf-lb-title { font-family: var(--font-display); font-size: 0.9rem; font-weight: 700; color: var(--white); }
    .pf-lb-counter { font-size: 0.7rem; color: rgba(255,255,255,0.45); }
    .pf-lb-close { width: 36px; height: 36px; border-radius: 50%; background: rgba(255,255,255,0.1); border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--white); transition: background 0.2s; }
    .pf-lb-close:hover { background: rgba(255,255,255,0.22); }
    .pf-lb-close svg { width: 14px; height: 14px; }
    .pf-lb-main { flex: 1; display: flex; align-items: center; justify-content: center; position: relative; min-height: 0; overflow: hidden; }
    .pf-lb-img { max-width: 100%; max-height: 100%; object-fit: contain; display: block; border-radius: 3px; }
    .pf-lb-nav { position: absolute; top: 50%; transform: translateY(-50%); width: 46px; height: 46px; border-radius: 50%; background: rgba(255,255,255,0.14); border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--white); transition: background 0.2s; z-index: 2; }
    .pf-lb-nav:hover { background: rgba(255,255,255,0.28); }
    .pf-lb-nav svg { width: 20px; height: 20px; }
    .pf-lb-nav.lp { left: 14px; } .pf-lb-nav.ln { right: 14px; }
    .pf-lb-strip { display: flex; align-items: center; justify-content: center; gap: 4px; padding: 0.55rem 1rem; background: rgba(0,0,0,0.65); flex-shrink: 0; overflow-x: auto; }
    .pf-lb-strip::-webkit-scrollbar { height: 3px; }
    .pf-lb-strip::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 2px; }
    .pf-lb-thumb { width: 46px; height: 46px; object-fit: cover; border-radius: 4px; cursor: pointer; opacity: 0.5; border: 2px solid transparent; transition: opacity 0.2s, border-color 0.2s; flex-shrink: 0; }
    .pf-lb-thumb.active { opacity: 1; border-color: var(--gold); }
    .pf-lb-thumb:hover { opacity: 0.85; }

    @media(max-width:680px){
        .pf-content { padding: 1rem; }
        .pf-avatar { width: 120px; height: 120px; }
        .pf-biz-name { font-size: 1.3rem; }
        .pf-header-body, .pf-nav { padding-left: 1rem; padding-right: 1rem; }
        .pf-avatar-row { margin-top: 5px; }
    }
</style>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Supplier Portfolio') }}
    </h2>
</x-slot>

<div class="pf-page">

    {{-- ══ COVER ══ 
    <div class="pf-cover"></div>--}}

    {{-- ══ HEADER BODY ══ --}}
    <div class="pf-header-body">
        <div class="pf-avatar-row">

            {{-- Avatar --}}
            <div class="pf-avatar">
                @if($supplier->photo)
                    <img src="{{ asset('storage/'.$supplier->photo) }}" alt="{{ $supplier->business_name }}">
                @else
                    {{ strtoupper(substr($supplier->business_name ?? $supplier->first_name ?? 'S', 0, 2)) }}
                @endif
            </div>

            {{-- Name + meta --}}
            <div class="pf-header-info">
                <div class="pf-biz-name">{{ $supplier->business_name ?? trim(($supplier->first_name ?? '').' '.($supplier->last_name ?? '')) }}</div>
                @if($supplier->tagline)
                    <div class="pf-tagline">"{{ $supplier->tagline }}"</div>
                @endif
                <div class="pf-meta-chips">
                    @if($supplier->city || $supplier->province)
                    <span class="pf-meta-chip">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M8 1C5.8 1 4 2.8 4 5c0 3.5 4 9 4 9s4-5.5 4-9c0-2.2-1.8-4-4-4z"/><circle cx="8" cy="5" r="1.5"/></svg>
                        {{ implode(', ', array_filter([$supplier->city, $supplier->province])) }}
                    </span>
                    @endif
                    @if($supplier->phone)
                    <span class="pf-meta-chip">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M2 3a2 2 0 012-2h1l1.5 3-1 1a7 7 0 003 3l1-1L13 9.5V11a2 2 0 01-2 2C5 13 2 10 2 6V3z"/></svg>
                        {{ $supplier->phone }}
                    </span>
                    @endif
                    @php $cats = $supplier->user->categories ?? collect(); @endphp
                    @foreach($cats as $cat)
                    <span class="pf-meta-chip">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="2" width="5" height="5" rx="1"/><rect x="9" y="2" width="5" height="5" rx="1"/><rect x="2" y="9" width="5" height="5" rx="1"/><rect x="9" y="9" width="5" height="5" rx="1"/></svg>
                        <strong>{{ $cat->name }}</strong>
                    </span>
                    @endforeach
                    @php $pfCount = $portfolios->count(); @endphp
                    <span class="pf-meta-chip">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="3" width="12" height="10" rx="1.5"/><circle cx="6" cy="7" r="1.5"/><path d="M2 11l3-3 2.5 2.5 2-2L14 11"/></svg>
                        {{ $pfCount }} portfolio item{{ $pfCount !== 1 ? 's' : '' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ NAV TABS ══ --}}
    <div class="pf-nav">
        <button class="pf-nav-tab active" onclick="switchPanel('photos', this)">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="3" width="12" height="10" rx="1.5"/><circle cx="6" cy="7" r="1.5"/><path d="M2 11l3-3 2.5 2.5 2-2L14 11"/></svg>
            Photos
        </button>
        <button class="pf-nav-tab" onclick="switchPanel('videos', this)">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><polygon points="5 3 13 8 5 13 5 3"/><rect x="2" y="2" width="12" height="12" rx="2"/></svg>
            Videos
        </button>
        <button class="pf-nav-tab" onclick="switchPanel('about', this)">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="8" cy="5" r="3"/><path d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6"/></svg>
            About
        </button>
    </div>

    {{-- ══ CONTENT ══ --}}
    <div class="pf-content">

        {{-- LEFT SIDEBAR: About card --}}
        <div class="pf-about-card">
            <div class="pf-about-head">
                <div class="pf-about-head-icon">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="5" r="3"/><path d="M1 13c0-3 2.7-5 6-5s6 2 6 5"/></svg>
                </div>
                <div class="pf-about-title">About</div>
            </div>
            <div class="pf-about-body">
                @if($supplier->bio)
                <div class="pf-bio-text">"{{ $supplier->bio }}"</div>
                @endif
                @if($supplier->city || $supplier->province)
                <div class="pf-about-row">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M8 1C5.8 1 4 2.8 4 5c0 3.5 4 9 4 9s4-5.5 4-9c0-2.2-1.8-4-4-4z"/><circle cx="8" cy="5" r="1.5"/></svg>
                    <div class="pf-about-row-text">
                        {{ implode(', ', array_filter([$supplier->city, $supplier->province])) }}
                        <small>Location</small>
                    </div>
                </div>
                @endif
                @if($supplier->address)
                <div class="pf-about-row">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M2 10V6l6-4 6 4v4M5 10V7h6v3"/></svg>
                    <div class="pf-about-row-text">
                        {{ $supplier->address }}
                        <small>Full Address</small>
                    </div>
                </div>
                @endif
                @if($supplier->phone)
                <div class="pf-about-row">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M2 3a2 2 0 012-2h1l1.5 3-1 1a7 7 0 003 3l1-1L13 9.5V11a2 2 0 01-2 2C5 13 2 10 2 6V3z"/></svg>
                    <div class="pf-about-row-text">
                        {{ $supplier->phone }}
                        <small>Phone</small>
                    </div>
                </div>
                @endif
                @foreach($cats as $cat)
                <div class="pf-about-row">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="2" width="5" height="5" rx="1"/><rect x="9" y="2" width="5" height="5" rx="1"/><rect x="2" y="9" width="5" height="5" rx="1"/><rect x="9" y="9" width="5" height="5" rx="1"/></svg>
                    <div class="pf-about-row-text">{{ $cat->name }}<small>Service Category</small></div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- RIGHT: Panels --}}
        <div>

            {{-- ── PHOTOS PANEL ── --}}
            <div id="panel-photos" class="pf-panel active">

                <div class="pf-section-head">
                    <div class="pf-section-title">Portfolio <em>Photos</em></div>
                </div>

                @php
                    // Collect all images grouped by portfolio
                    $allImages = [];
                    foreach($portfolios as $pf) {
                        $imgs = $pf->images ?? [];
                        if (is_string($imgs)) $imgs = json_decode($imgs, true) ?? [];
                        foreach($imgs as $img) {
                            $allImages[] = ['url' => asset('storage/'.$img), 'title' => $pf->title, 'portfolio_id' => $pf->id];
                        }
                    }
                    $allImageUrls = array_column($allImages, 'url');
                @endphp

                @if(count($allImages))

                {{-- Sub-tabs per portfolio --}}
                <div class="pf-sub-tabs" id="pfSubTabs">
                    <button class="pf-sub-tab active" data-target="all" onclick="filterPortfolio(this)">All Photos</button>
                    @foreach($portfolios as $pf)
                        @php $pfImgs = $pf->images ?? []; if(is_string($pfImgs)) $pfImgs = json_decode($pfImgs,true)??[]; @endphp
                        @if(count($pfImgs))
                        <button class="pf-sub-tab" data-target="pf{{ $pf->id }}" onclick="filterPortfolio(this)">{{ $pf->title }}</button>
                        @endif
                    @endforeach
                </div>

                {{-- ALL PHOTOS grid --}}
                <div id="grid-all" class="pf-portfolio-block">
                    <div class="pf-photo-grid">
                        @foreach($allImages as $idx => $item)
                        <div class="pf-photo-cell" onclick="lbOpen({{ json_encode($allImageUrls) }}, {{ $idx }}, 'Portfolio')">
                            <img src="{{ $item['url'] }}" alt="" loading="lazy">
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Per-portfolio grids --}}
                @foreach($portfolios as $pf)
                @php
                    $pfImgs = $pf->images ?? [];
                    if(is_string($pfImgs)) $pfImgs = json_decode($pfImgs, true) ?? [];
                    $pfUrls = array_map(fn($i) => asset('storage/'.$i), $pfImgs);
                @endphp
                @if(count($pfImgs))
                <div id="grid-pf{{ $pf->id }}" class="pf-portfolio-block" style="display:none;">
                    <div class="pf-portfolio-post-head">
                        <div class="pf-post-num">{{ $loop->iteration }}</div>
                        <div>
                            <div class="pf-post-title">{{ $pf->title }}</div>
                            @if($pf->description)<div class="pf-post-desc">{{ $pf->description }}</div>@endif
                            @if($pf->created_at)<div class="pf-post-date">{{ $pf->created_at->diffForHumans() }}</div>@endif
                        </div>
                    </div>
                    <div class="pf-photo-grid">
                        @foreach($pfImgs as $idx => $img)
                        <div class="pf-photo-cell" onclick="lbOpen({{ json_encode($pfUrls) }}, {{ $idx }}, '{{ addslashes($pf->title) }}')">
                            <img src="{{ asset('storage/'.$img) }}" alt="" loading="lazy">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @endforeach

                @else
                <div class="pf-empty">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4"><rect x="4" y="4" width="40" height="40" rx="4"/><circle cx="16" cy="18" r="4"/><path d="M4 34l12-12 8 8 6-6 14 14"/></svg>
                    <div class="pf-empty-text">No photos uploaded yet.</div>
                </div>
                @endif
            </div>

            {{-- ── VIDEOS PANEL ── --}}
            <div id="panel-videos" class="pf-panel">

                <div class="pf-section-head">
                    <div class="pf-section-title">Portfolio <em>Videos</em></div>
                </div>

                @php $hasVideos = $portfolios->filter(fn($p) => !empty($p->video))->count(); @endphp

                @if($hasVideos)
                <div class="pf-video-grid">
                    @foreach($portfolios->filter(fn($p) => !empty($p->video)) as $pf)
                    <div class="pf-video-card">
                        <video controls preload="metadata">
                            <source src="{{ asset('storage/'.$pf->video) }}">
                        </video>
                        <div class="pf-video-info">
                            <div class="pf-video-title">{{ $pf->title }}</div>
                            @if($pf->description)<div class="pf-post-desc" style="font-size:0.76rem;color:var(--warm-grey);margin-top:2px;">{{ $pf->description }}</div>@endif
                            @if($pf->created_at)<div class="pf-video-date">{{ $pf->created_at->diffForHumans() }}</div>@endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="pf-empty">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4"><polygon points="10 6 38 24 10 42 10 6"/><rect x="2" y="2" width="44" height="44" rx="4"/></svg>
                    <div class="pf-empty-text">No videos uploaded yet.</div>
                </div>
                @endif
            </div>

            {{-- ── ABOUT PANEL ── --}}
            <div id="panel-about" class="pf-panel">

                <div class="pf-section-head">
                    <div class="pf-section-title">Supplier <em>Details</em></div>
                </div>

                <div class="pf-about-full">

                    @if($supplier->bio || $supplier->description)
                    <div class="pf-info-card">
                        <div class="pf-info-card-head">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="2" width="12" height="12" rx="2"/><path d="M5 6h6M5 9h4"/></svg>
                            <div class="pf-info-card-title">About & Services</div>
                        </div>
                        <div style="padding:1rem 1.1rem;display:flex;flex-direction:column;gap:0.75rem;">
                            @if($supplier->bio)
                            <div>
                                <div class="pf-info-k">Bio</div>
                                <div class="pf-info-v" style="font-style:italic;color:var(--warm-grey);">{{ $supplier->bio }}</div>
                            </div>
                            @endif
                            @if($supplier->description)
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
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M8 1C5.8 1 4 2.8 4 5c0 3.5 4 9 4 9s4-5.5 4-9c0-2.2-1.8-4-4-4z"/><circle cx="8" cy="5" r="1.5"/></svg>
                            <div class="pf-info-card-title">Contact & Location</div>
                        </div>
                        <div class="pf-info-card-body">
                            <div>
                                <div class="pf-info-k">Full Name</div>
                                <div class="pf-info-v">{{ trim(($supplier->first_name ?? '').' '.($supplier->last_name ?? '')) ?: '—' }}</div>
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

                </div>
            </div>

        </div>{{-- /right --}}
    </div>{{-- /pf-content --}}

</div>{{-- /pf-page --}}

{{-- LIGHTBOX --}}
<div id="pfLb" class="pf-lb" onclick="if(event.target===this)lbClose()">
    <div class="pf-lb-bar">
        <span class="pf-lb-title" id="lbTitle"></span>
        <div style="display:flex;align-items:center;gap:0.6rem;">
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

    <script>
        /* ── NAV TABS ── */
        function switchPanel(id, btn) {
            document.querySelectorAll('.pf-nav-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.pf-panel').forEach(p => p.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById('panel-' + id).classList.add('active');
        }

        /* ── PHOTO SUB-TABS (per portfolio) ── */
        function filterPortfolio(btn) {
            document.querySelectorAll('.pf-sub-tab').forEach(t => t.classList.remove('active'));
            btn.classList.add('active');
            const target = btn.dataset.target;
            document.querySelectorAll('.pf-portfolio-block').forEach(b => {
                b.style.display = (target === 'all' || b.id === 'grid-' + target) ? '' : 'none';
            });
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
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', e => {
            if (!document.getElementById('pfLb').classList.contains('open')) return;
            if (e.key === 'Escape')     lbClose();
            if (e.key === 'ArrowLeft')  lbNav(-1);
            if (e.key === 'ArrowRight') lbNav(1);
        });
    </script>

</x-client-layout>