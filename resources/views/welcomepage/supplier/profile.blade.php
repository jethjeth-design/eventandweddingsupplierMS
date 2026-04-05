<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Suppliers — Bikol's Craft</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/welcomepage/supplier/profile.css') }}">
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
        <a href="{{ route('welcomepage.profile') }}" class="active">Suppliers</a>
        <a href="#">Events</a>
        <a href="#">Packages</a>
        <a href="{{ route('welcomepage.gallery') }}">Gallery</a>
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

{{-- PAGE HERO --}}
<div class="page-hero">
    <div class="hero-inner">
        <div class="hero-eyebrow">Discover Talent</div>
        <h1>Find your perfect <em>event supplier</em></h1>
        <p class="hero-sub">Browse verified professionals across Bikol and beyond.</p>
    </div>
</div>

{{-- SEARCH BAR --}}
<div class="search-bar-wrap">
    <form method="GET" action="{{ route('welcomepage.profile') }}"
          style="display:flex;gap:1rem;align-items:center;flex:1;flex-wrap:wrap;">
        <div class="search-input-wrap">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
            </svg>
            <input type="text" name="search"
                   value="{{ request('search') }}"
                   placeholder="Search by name, category, or location…">
        </div>
        <button type="submit" class="search-btn">Search</button>
    </form>
</div>

{{-- MAIN LAYOUT --}}
<div class="main-layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="sidebar-title">Search Filter</div>

        <form method="GET" action="{{ request()->url() }}" id="filter-form">
            
             @if(request('city'))
                    @foreach((array) request('city') as $c)
                        <input type="hidden" name="city[]" value="{{ $c }}">
                    @endforeach
                @endif
                @if(request('category'))
                    @foreach((array) request('category') as $c)
                        <input type="hidden" name="category[]" value="{{ $c }}">
                    @endforeach
                @endif

            {{-- Location --}}
            <div class="filter-group">
                <div class="filter-group-title">Location</div>

                @php
                    $selectedCities = request()->input('city', []);
                    if (!is_array($selectedCities)) $selectedCities = [$selectedCities];
                @endphp

                @foreach($cities->take(6) as $city)
                <label class="check-item">
                    <input type="checkbox" name="city[]" value="{{ $city }}"
                        onchange="this.form.submit()"
                        {{ in_array($city, $selectedCities) ? 'checked' : '' }}>
                    <span class="check-box"></span>
                    <span class="check-label">{{ $city }}</span>
                </label>
                @endforeach
            </div>

            {{-- Category --}}
            <div class="filter-group">
                <div class="filter-group-title">Category</div>

                @php
                    $selectedCats = request()->input('category', []);
                    if (!is_array($selectedCats)) $selectedCats = [$selectedCats];
                @endphp

                @foreach($categories as $cat)
                <label class="check-item">
                    <input type="checkbox" name="category[]" value="{{ $cat }}"
                        onchange="this.form.submit()"
                        {{ in_array($cat, $selectedCats) ? 'checked' : '' }}>
                    <span class="check-box"></span>
                    <span class="check-label">{{ $cat }}</span>
                </label>
                @endforeach
            </div>

            {{-- Rating 
            <div class="filter-group">
                <div class="filter-group-title">Rating</div>
                @foreach([5,4,3,2] as $r)
                <label class="rating-row">
                    <input type="radio" name="rating" value="{{ $r }}"
                           {{ request('rating') == $r ? 'checked' : '' }}>
                    <span class="r-dot"></span>
                    <div class="stars-display">
                        @for($s=1;$s<=5;$s++)
                            <span class="{{ $s<=$r ? 's' : 'se' }}">★</span>
                        @endfor
                    </div>
                    @if($r < 5)<span class="and-up">& Up</span>@endif
                </label>
                @endforeach
            </div>--}}

            {{-- Price Range 
            <div class="filter-group">
                <div class="filter-group-title">Price Range</div>
                <div class="price-row">
                    <input class="fm-in" type="number" name="price_min"
                           value="{{ request('price_min') }}" placeholder="Min ₱">
                    <input class="fm-in" type="number" name="price_max"
                           value="{{ request('price_max') }}" placeholder="Max ₱">
                </div>
            </div>--}}

            {{-- Availability 
            <div class="filter-group">
                <div class="filter-group-title">Availability</div>
                <label class="check-item">
                    <input type="checkbox" name="available_only" value="1"
                           {{ request('available_only') ? 'checked' : '' }}>
                    <span class="check-box"></span>
                    <span class="check-label">Available only</span>
                </label>
            </div>--}}

            {{--<button type="submit" class="apply-btn">Apply Filters</button>
            <a href="{{ route('welcomepage.profile') }}" style="display:block;">
                <button type="button" class="reset-btn">Reset</button>
            </a>--}}
        </form>
    </aside>

    {{-- CONTENT --}}
    <div class="content-area">

        {{-- SORT BAR 
        <div class="sort-bar">
            <div class="sort-label">
                Showing <strong>{{ $suppliers->count() }}</strong> supplier{{ $suppliers->count() !== 1 ? 's' : '' }}
            </div>
            <div class="sort-tabs">
                @foreach(['popular'=>'Popular','rating'=>'Highest Rated','price'=>'Lowest Price','latest'=>'Latest'] as $key=>$label)
                <a href="{{ request()->fullUrlWithQuery(['sort'=>$key]) }}"
                   class="sort-tab {{ request('sort',$_GET['sort'] ?? 'popular') === $key ? 'active' : '' }}">
                    {{ $label }}
                </a>
                @endforeach
            </div>
        </div>--}}

        {{-- SUPPLIER GRID --}}
        <div class="suppliers-grid">
            @forelse($suppliers as $supplier)
            <div class="sup-card">

                {{-- Card top --}}
                <div class="card-top">
                    @if($supplier->photo)
                        <img class="card-avatar"
                             src="{{ asset('storage/'.$supplier->photo) }}"
                             alt="{{ $supplier->business_name }}">
                    @else
                        <div class="card-avatar-fb">
                            {{ strtoupper(substr($supplier->business_name ?? $supplier->first_name, 0, 2)) }}
                        </div>
                    @endif

                    <div class="card-info">
                        <div class="card-name">{{ $supplier->business_name }}</div>
                        <div class="card-person">{{ $supplier->first_name }} {{ $supplier->last_name }}</div>

                        @if($supplier->city || $supplier->province)
                        <div class="card-location">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            {{ collect([$supplier->city, $supplier->province])->filter()->implode(', ') }}
                        </div>
                        @endif

                        @if($supplier->rating)
                        <div class="card-rating">
                            <div class="card-stars">
                                @for($s=1;$s<=5;$s++)
                                    <span class="{{ $s <= round($supplier->rating) ? 's' : 'se' }}">★</span>
                                @endfor
                            </div>
                            <span class="rating-val">{{ number_format($supplier->rating,1) }}</span>
                            <span class="rating-count">({{ rand(1,40) }} reviews)</span>
                        </div>
                        @endif
                    </div>
                </div>


                {{-- Card body --}}
                <div class="card-body">
                    @if($supplier->tagline)
                        <p class="card-tagline">"{{ $supplier->tagline }}"</p>
                    @elseif($supplier->bio)
                        <p class="card-tagline">{{ $supplier->bio }}</p>
                    @else
                        <p class="card-tagline" style="opacity:0;">&nbsp;</p>
                    @endif

                    <div class="card-tags">
                        @if($supplier->category)
                            <span class="card-tag">{{ $supplier->category }}</span>
                        @endif
                        @if($supplier->is_available)
                            <span class="avail-badge avail-yes">
                                <span class="avail-dot"></span>Available
                            </span>
                        @else
                            <span class="avail-badge avail-no">
                                <span class="avail-dot"></span>Unavailable
                            </span>
                        @endif
                    </div>

                    {{--@if($supplier->price)
                    <div class="card-price">
                        From <strong>₱{{ number_format($supplier->price, 2) }}</strong>
                    </div>
                    @endif--}}

                    <a href="{{ route('welcomepage.profiledetails', ['id' => $supplier->id]) }}" class="view-btn">
                        View Profile
                    </a>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#C8BEB5" stroke-width="1.2"
                     style="margin:0 auto 1rem;display:block;">
                    <circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/>
                </svg>
                <h3>No suppliers found</h3>
                <p>Try adjusting your filters or search terms.</p>
            </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if($suppliers instanceof \Illuminate\Pagination\LengthAwarePaginator && $suppliers->hasPages())
            <div class="pagination">
                <a href="{{ $suppliers->previousPageUrl() ?? '#' }}"
                class="page-btn {{ $suppliers->onFirstPage() ? 'disabled' : '' }}">‹</a>
                @foreach($suppliers->getUrlRange(1, $suppliers->lastPage()) as $page => $url)
                    <a href="{{ $url }}"
                    class="page-btn {{ $page === $suppliers->currentPage() ? 'active' : '' }}">
                        {{ $page }}
                    </a>
                @endforeach
                <a href="{{ $suppliers->nextPageUrl() ?? '#' }}"
                class="page-btn {{ !$suppliers->hasMorePages() ? 'disabled' : '' }}">›</a>
            </div>
        @endif

    </div>{{-- end content --}}
</div>{{-- end main-layout --}}

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
    const hamburger = document.getElementById('hamburger');
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
</script>
</body>
</html>