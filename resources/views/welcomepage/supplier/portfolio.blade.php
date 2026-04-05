<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery — Bikol's Craft</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcomepage/supplier/portfolio.css') }}">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

   
</head>
<body>

{{-- NAVBAR --}}
<nav class="main-nav">
    <a href="{{ route('welcomepage.welcome') }}" class="nav-logo">Bikol's<span>Craft</span></a>
    <div class="nav-links">
        <a href="{{ route('welcomepage.welcome') }}">Home</a>
        <a href="{{ route('welcomepage.profile') }}">Suppliers</a>
        <a href="#">Events</a>
        <a href="#">Packages</a>
        <a href="#" class="active">Gallery</a>
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="nav-cta">Dashboard</a>
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
    <a href="#" onclick="closeMenu()">Packages</a>
    <a href="{{route('welcomepage.gallery')}}" onclick="closeMenu()">Gallery</a>
    @if (Route::has('login'))
        @auth
            <a href="{{ url('/dashboard') }}" class="mob-cta">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="mob-cta">Sign In</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="mob-cta" style="margin-top:0.5rem;">Get Started</a>
            @endif
        @endauth
    @endif
</div>

{{-- PAGE HEADER (slim — no banner) --}}
<div class="page-header">
    <div class="page-header-inner">
        <div>
            <div class="ph-eyebrow">Portfolio</div>
            <h1>Supplier <em>Gallery</em></h1>
        </div>
        @if(isset($portfolios) && count($portfolios))
            <span class="ph-count">{{ count($portfolios) }} post{{ count($portfolios) !== 1 ? 's' : '' }}</span>
        @endif
    </div>
</div>

{{-- FILTER BAR --}}
<div class="filter-bar">
    <span class="filter-label">Filter</span>
    <div class="filter-tabs">
        <button class="filter-tab active" data-filter="all">All</button>
        <button class="filter-tab" data-filter="photos">Photos</button>
        <button class="filter-tab" data-filter="videos">Videos</button>
    </div>
</div>

{{-- MAIN CONTENT --}}
<div class="page-wrap">

    @if(isset($portfolios) && count($portfolios))
    <div class="portfolio-list" id="portfolioList">

        @foreach($portfolios as $portfolio)
        @php
            $imgs     = $portfolio->images ?? [];
            $imgCount = count($imgs);
            $hasVideo = !empty($portfolio->video);

            $cls     = $imgCount === 1 ? 'count-1'
                     : ($imgCount === 2 ? 'count-2'
                     : ($imgCount === 3 ? 'count-3'
                     : ($imgCount === 4 ? 'count-4' : 'count-5plus')));
            $shown   = min($imgCount, $imgCount >= 5 ? 4 : $imgCount);
            $allUrls = array_map(fn($i) => asset('storage/'.$i), $imgs);
            $allJson = json_encode($allUrls);
        @endphp

        <div class="post-card reveal"
             data-type="{{ ($imgCount > 0 && $hasVideo) ? 'both' : ($imgCount > 0 ? 'photos' : 'videos') }}">

            {{-- Post header --}}
            <div class="post-head">
                <div class="post-head-l">
                    <div class="post-avatar">
                        @php
                            $supplier = $portfolio->supplier;
                        @endphp

                        @if($supplier && $supplier->photo)
                            <img src="{{ asset('storage/'.$supplier->photo) }}" alt="Supplier Photo">
                        @else
                            <div class="avatar-fallback">
                                {{ strtoupper(substr($supplier->business_name ?? 'BC', 0, 2)) }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <div class="post-title">{{ $portfolio->$title }}</div>
                        <div class="post-date">
                            {{ $portfolio->created_at ? $portfolio->created_at->diffForHumans() : '' }}
                        </div>
                    </div>
                </div>

                @auth
                    @if(auth()->user()->supplierProfile 
                        && auth()->user()->supplierProfile->id === $portfolio->supplier_id)

                    <form method="POST"
                        action="{{ route('supplier.portfolio.destroy', $portfolio->id) }}"
                        onsubmit="return confirm('Remove this portfolio item?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit">Delete</button>
                    </form>

                    @endif
                @endauth
            </div>

            {{-- Description --}}
            @if($portfolio->description)
            <div class="post-desc">{{ $portfolio->description }}</div>
            @endif

            {{-- Image mosaic --}}
            @if($imgCount > 0)
            <div class="pf-mosaic {{ $cls }}"
                 onclick="lbOpen({{ $allJson }}, 0, '{{ addslashes($portfolio->title) }}')">
                @for($ci = 0; $ci < $shown; $ci++)
                <div class="pf-mos-cell">
                    <img src="{{ asset('storage/'.$imgs[$ci]) }}" alt="" loading="lazy">
                    @if($ci === $shown - 1 && $imgCount > $shown)
                        <div class="pf-mos-more">+{{ $imgCount - $shown }}</div>
                    @endif
                </div>
                @endfor
                <div class="mosaic-view-hint">View all</div>
            </div>
            @endif

            {{-- Video --}}
            @if($hasVideo)
            <div class="post-video">
                <video controls preload="metadata" style="width:100%; max-height:480px;">
                    <source src="{{ asset('storage/'.$portfolio->video) }}">
                    Your browser does not support video playback.
                </video>
            </div>
            @endif

            {{-- Post footer --}}
            <div class="post-foot">
                @if($imgCount > 0)
                    <span class="post-tag">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:2px;"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                        {{ $imgCount }} photo{{ $imgCount !== 1 ? 's' : '' }}
                    </span>
                @endif
                @if($hasVideo)
                    <span class="post-tag">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:2px;"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        Video
                    </span>
                @endif
                @if($portfolio->supplierProfile->category ?? false)
                    <span class="post-tag">{{ $portfolio->supplierProfile->category }}</span>
                @endif
            </div>
        </div>
        @endforeach

    </div>

    @else

    {{-- Empty state --}}
    <div class="gallery-empty reveal">
        <div class="gallery-empty-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="3" y="3" width="18" height="18" rx="3"/>
                <circle cx="8.5" cy="8.5" r="1.5"/>
                <path d="M21 15l-5-5L5 21"/>
            </svg>
        </div>
        <h3>No gallery items yet</h3>
        <p>Suppliers haven't uploaded any portfolio photos or videos yet.<br>Check back soon.</p>
    </div>

    @endif

</div>{{-- end page-wrap --}}

{{-- LIGHTBOX --}}
<div class="lb-backdrop" id="lbBackdrop">
    <div class="lb-inner">
        <div class="lb-header">
            <div class="lb-title" id="lbTitle"></div>
            <div style="display:flex;align-items:center;gap:0.75rem;">
                <span class="lb-counter" id="lbCounter"></span>
                <button class="lb-close" onclick="lbClose()">&#215;</button>
            </div>
        </div>
        <div class="lb-img-wrap">
            <button class="lb-nav-btn lb-prev" onclick="lbMove(-1)">&#8249;</button>
            <img class="lb-img" id="lbImg" src="" alt="">
            <button class="lb-nav-btn lb-next" onclick="lbMove(1)">&#8250;</button>
        </div>
        <div class="lb-dots" id="lbDots"></div>
    </div>
</div>

{{-- FOOTER --}}
<footer>
    <div class="footer-brand">Bikol's<span>Craft</span></div>
    <div class="footer-links">
        <a href="#">Privacy</a>
        <a href="#">Terms</a>
        <a href="#">Support</a>
        <a href="#">Blog</a>
    </div>
    <div class="footer-copy">© {{ date('Y') }} Bikol'sCraft. All rights reserved.</div>
</footer>

<script>
    /* ── HAMBURGER ── */
    const hamburger  = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');
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

    /* ── SCROLL REVEAL ── */
    const reveals = document.querySelectorAll('.reveal');
    const io = new IntersectionObserver(entries => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 60);
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.08 });
    reveals.forEach(el => io.observe(el));

    /* ── FILTER TABS ── */
    const filterTabs = document.querySelectorAll('.filter-tab');
    const cards = document.querySelectorAll('#portfolioList .post-card');
    filterTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            filterTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            const f = tab.dataset.filter;
            cards.forEach(c => {
                const type = c.dataset.type;
                if (f === 'all') {
                    c.style.display = '';
                } else if (f === 'photos') {
                    c.style.display = (type === 'photos' || type === 'both') ? '' : 'none';
                } else if (f === 'videos') {
                    c.style.display = (type === 'videos' || type === 'both') ? '' : 'none';
                }
            });
        });
    });

    /* ── LIGHTBOX ── */
    let lbImages = [], lbIdx = 0;

    function lbOpen(imgs, startIdx, title) {
        lbImages = imgs;
        lbIdx    = startIdx;
        document.getElementById('lbTitle').textContent = title || '';
        document.getElementById('lbBackdrop').classList.add('open');
        document.body.style.overflow = 'hidden';
        lbRender();
    }

    function lbClose() {
        document.getElementById('lbBackdrop').classList.remove('open');
        document.body.style.overflow = '';
    }

    function lbMove(dir) {
        lbIdx = (lbIdx + dir + lbImages.length) % lbImages.length;
        lbRender();
    }

    function lbRender() {
        const img = document.getElementById('lbImg');
        img.src = lbImages[lbIdx];
        document.getElementById('lbCounter').textContent = (lbIdx + 1) + ' / ' + lbImages.length;

        // Dots
        const dotsEl = document.getElementById('lbDots');
        dotsEl.innerHTML = '';
        lbImages.forEach((_, i) => {
            const d = document.createElement('div');
            d.className = 'lb-dot' + (i === lbIdx ? ' active' : '');
            d.onclick = () => { lbIdx = i; lbRender(); };
            dotsEl.appendChild(d);
        });

        // Hide nav if only 1 image
        document.querySelector('.lb-prev').style.display = lbImages.length > 1 ? '' : 'none';
        document.querySelector('.lb-next').style.display = lbImages.length > 1 ? '' : 'none';
        dotsEl.style.display = lbImages.length > 1 ? '' : 'none';
    }

    // Close lightbox on backdrop click
    document.getElementById('lbBackdrop').addEventListener('click', function(e) {
        if (e.target === this) lbClose();
    });

    // Keyboard navigation
    document.addEventListener('keydown', e => {
        if (!document.getElementById('lbBackdrop').classList.contains('open')) return;
        if (e.key === 'ArrowRight') lbMove(1);
        if (e.key === 'ArrowLeft')  lbMove(-1);
        if (e.key === 'Escape')     lbClose();
    });

    // Expose lbOpen globally (used in inline onclick)
    window.lbOpen = lbOpen;
</script>
</body>
</html>