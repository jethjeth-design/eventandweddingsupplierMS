<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $supplier->business_name }} — Bikol's Craft</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/welcomepage/supplier/details.css') }}">
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
    <a href="{{ route('welcomepage.gallery') }}" onclick="closeMenu()">Gallery</a>
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



<div class="page-wrap">

    @if(session('inquiry_success'))
        <div class="alert-success">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('inquiry_success') }}
        </div>
    @endif

    {{-- PROFILE CARD --}}
    <div class="profile-card reveal">

        <div class="profile-top">
            @if($supplier->photo)
                <img class="profile-photo"
                     src="{{ asset('storage/'.$supplier->photo) }}"
                     alt="{{ $supplier->business_name }}">
            @else
                <div class="profile-photo-fb">
                    {{ strtoupper(substr($supplier->business_name ?? $supplier->first_name, 0, 2)) }}
                </div>
            @endif

            <div class="profile-title-group">
                <div class="profile-name">{{ $supplier->business_name }}</div>
                <div class="profile-person">{{ $supplier->first_name }} {{ $supplier->last_name }}</div>
                @if($supplier->tagline)
                    <div class="profile-tagline">"{{ $supplier->tagline }}"</div>
                @endif
                @if($supplier->city || $supplier->province)
                    <div class="profile-location">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        {{ collect([$supplier->city, $supplier->province])->filter()->implode(', ') }}
                    </div>
                @endif
            </div>

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
                <button class="contact-btn" onclick="openModal()">Send Inquiry</button>
            </div>
        </div>

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

    {{-- STATS STRIP --}}
    <div class="stats-strip reveal">
        <div class="stat-cell">
            <span class="stat-n">{{ $supplier->rating ? number_format($supplier->rating, 1) : '—' }}</span>
            <div class="stat-l">Rating</div>
        </div>
        <div class="stat-cell">
            <span class="stat-n">{{ $supplier->price ? '₱'.number_format($supplier->price, 0) : '—' }}</span>
            <div class="stat-l">Base Price</div>
        </div>
        <div class="stat-cell">
            <span class="stat-n">{{ $supplier->category ?? '—' }}</span>
            <div class="stat-l">Category</div>
        </div>
        <div class="stat-cell">
            <span class="stat-n" style="font-size:1.1rem;font-family:var(--font-body);font-weight:600;color:{{ $supplier->is_available ? '#15803D' : '#B45309' }};">
                {{ $supplier->is_available ? 'Open' : 'Closed' }}
            </span>
            <div class="stat-l">Status</div>
        </div>
    </div>

    {{-- TWO-COL --}}
    <div class="two-col">

        {{-- LEFT --}}
        <div>
            {{-- About --}}
            @if($supplier->bio)
            <div class="sec-card reveal">
                <div class="sec-header">
                    <div>
                        <div class="sec-eyebrow">About</div>
                        <div class="sec-title">Who they are</div>
                    </div>
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
                    <div>
                        <div class="sec-eyebrow">Services</div>
                        <div class="sec-title">What they offer</div>
                    </div>
                </div>
                <div class="sec-body">
                    <p class="sec-text">{{ $supplier->description }}</p>
                </div>
            </div>
            @endif

            {{-- Details --}}
            <div class="sec-card reveal">
                <div class="sec-header">
                    <div>
                        <div class="sec-eyebrow">Details</div>
                        <div class="sec-title">Supplier information</div>
                    </div>
                </div>
                <div class="sec-body">
                    <ul class="detail-list">
                        @if($supplier->phone)
                        <li class="detail-item">
                            <div class="detail-icon">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 11.63 19a19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 3.12 4.18 2 2 0 0 1 5.08 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L9.09 9.91A16 16 0 0 0 15 15.91l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </div>
                            <div>
                                <div class="detail-lbl">Phone</div>
                                <div class="detail-val"><a href="tel:{{ $supplier->phone }}">{{ $supplier->phone }}</a></div>
                            </div>
                        </li>
                        @endif

                        @if($supplier->category)
                        <li class="detail-item">
                            <div class="detail-icon">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                            </div>
                            <div>
                                <div class="detail-lbl">Category</div>
                                <div class="detail-val">{{ $supplier->category }}</div>
                            </div>
                        </li>
                        @endif

                        @if($supplier->address)
                        <li class="detail-item">
                            <div class="detail-icon">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                            </div>
                            <div>
                                <div class="detail-lbl">Address</div>
                                <div class="detail-val">{{ $supplier->address }}</div>
                            </div>
                        </li>
                        @endif

                        @if($supplier->city || $supplier->province)
                        <li class="detail-item">
                            <div class="detail-icon">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <div class="detail-lbl">Location</div>
                                <div class="detail-val">{{ collect([$supplier->city, $supplier->province])->filter()->implode(', ') }}</div>
                            </div>
                        </li>
                        @endif

                        <li class="detail-item">
                            <div class="detail-icon">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
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

            {{-- Rating visual --}}
            @if($supplier->rating)
            <div class="sec-card reveal">
                <div class="sec-header">
                    <div>
                        <div class="sec-eyebrow">Rating</div>
                        <div class="sec-title">Overall score</div>
                    </div>
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
                                    <div class="bar-track">
                                        <div class="bar-fill" style="width:{{ $pct }}%;"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        {{-- RIGHT SIDEBAR --}}
        <div>

            {{-- Contact card --}}
            <div class="sidebar-card reveal">
                <div class="sc-header">Contact Details</div>
                <div class="sc-body">
                    @if($supplier->phone)
                    <div class="contact-row">
                        <div class="c-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 11.63 19a19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 3.12 4.18 2 2 0 0 1 5.08 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L9.09 9.91A16 16 0 0 0 15 15.91l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <div>
                            <div class="c-lbl">Phone</div>
                            <div class="c-val"><a href="tel:{{ $supplier->phone }}">{{ $supplier->phone }}</a></div>
                        </div>
                    </div>
                    @endif

                    @if($supplier->city || $supplier->province)
                    <div class="contact-row">
                        <div class="c-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <div class="c-lbl">City / Province</div>
                            <div class="c-val">{{ collect([$supplier->city, $supplier->province])->filter()->implode(', ') }}</div>
                        </div>
                    </div>
                    @endif

                    @if($supplier->address)
                    <div class="contact-row">
                        <div class="c-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                        </div>
                        <div>
                            <div class="c-lbl">Address</div>
                            <div class="c-val">{{ $supplier->address }}</div>
                        </div>
                    </div>
                    @endif

                    @if($supplier->category)
                    <div class="contact-row">
                        <div class="c-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                        </div>
                        <div>
                            <div class="c-lbl">Category</div>
                            <div class="c-val">{{ $supplier->category }}</div>
                        </div>
                    </div>
                    @endif

                    <div class="contact-row">
                        <div class="c-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div>
                            <div class="c-lbl">Status</div>
                            <div class="c-val" style="font-weight:500;color:{{ $supplier->is_available ? '#15803D' : '#B45309' }};">
                                {{ $supplier->is_available ? '● Available' : '● Unavailable' }}
                            </div>
                        </div>
                    </div>

                    <button class="full-btn" onclick="openModal()">Send Inquiry</button>
                    <a href="{{ route('welcomepage.profile') }}" class="outline-btn">← Back to Suppliers</a>
                </div>
            </div>

            {{-- Pricing card --}}
            @if($supplier->price)
            <div class="sidebar-card reveal">
                <div class="sc-header">Pricing</div>
                <div class="sc-body">
                    <div class="price-display">
                        <div class="price-from">Starting price</div>
                        <div class="price-amount">₱{{ number_format($supplier->price, 2) }}</div>
                        <div class="price-note">Final price may vary by scope</div>
                    </div>
                    <button class="full-btn" onclick="openModal()">Request a Quote</button>
                </div>
            </div>
            @endif

            {{-- Quick stats card 
            <div class="sidebar-card reveal">
                <div class="sc-header">At a Glance</div>
                <div class="sc-body" style="display:grid;grid-template-columns:1fr 1fr;gap:1px;background:var(--border);border-radius:3px;overflow:hidden;">
                    <div style="background:var(--white);padding:0.9rem;text-align:center;">
                        <p style="font-family:var(--font-display);font-size:1.4rem;font-weight:700;color:var(--gold-dark);line-height:1;">
                            {{ $supplier->rating ? number_format($supplier->rating,1) : '—' }}
                        </p>
                        <p style="font-size:0.65rem;text-transform:uppercase;letter-spacing:.08em;color:var(--warm-grey);margin-top:3px;">Rating</p>
                    </div>
                    <div style="background:var(--white);padding:0.9rem;text-align:center;">
                        <p style="font-family:var(--font-display);font-size:1.4rem;font-weight:700;color:var(--gold-dark);line-height:1;">
                            {{ $supplier->price ? '₱'.number_format($supplier->price,0) : '—' }}
                        </p>
                        <p style="font-size:0.65rem;text-transform:uppercase;letter-spacing:.08em;color:var(--warm-grey);margin-top:3px;">Base Price</p>
                    </div>
                    <div style="background:var(--white);padding:0.9rem;text-align:center;border-top:1px solid var(--border);">
                        <p style="font-family:var(--font-display);font-size:0.9rem;font-weight:700;color:var(--gold-dark);line-height:1.2;">
                            {{ $supplier->category ?? '—' }}
                        </p>
                        <p style="font-size:0.65rem;text-transform:uppercase;letter-spacing:.08em;color:var(--warm-grey);margin-top:3px;">Category</p>
                    </div>
                    <div style="background:var(--white);padding:0.9rem;text-align:center;border-top:1px solid var(--border);">
                        <p style="font-size:0.85rem;font-weight:600;color:{{ $supplier->is_available ? '#15803D' : '#B45309' }};line-height:1.2;">
                            {{ $supplier->is_available ? 'Open' : 'Closed' }}
                        </p>
                        <p style="font-size:0.65rem;text-transform:uppercase;letter-spacing:.08em;color:var(--warm-grey);margin-top:3px;">Status</p>
                    </div>
                </div>
            </div>--}}

        </div>
    </div>{{-- end two-col --}}
</div>{{-- end page-wrap --}}

{{-- INQUIRY MODAL --}}
<div id="inq-modal" class="modal-backdrop" style="display:none;">
    <div class="modal-box">
        <div class="modal-hd">
            <div>
                <div class="modal-hd-title">Contact {{ $supplier->business_name }}</div>
                <div class="modal-hd-sub">{{ $supplier->first_name }} {{ $supplier->last_name }}{{ $supplier->category ? ' · '.$supplier->category : '' }}</div>
            </div>
            <button class="modal-x" onclick="closeModal()">&#215;</button>
        </div>
        <form action="{{route('inquiry.store')}}" method="POST" style="display:contents;">
            @csrf
            <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">
            <div class="modal-body">
                <div class="fm-grid">
                    <div class="fm-field" style="margin-bottom:0;">
                        <label class="fm-lbl">First name</label>
                        <input class="fm-in" type="text" name="first_name" placeholder="Maria" required>
                    </div>
                    <div class="fm-field" style="margin-bottom:0;">
                        <label class="fm-lbl">Last name</label>
                        <input class="fm-in" type="text" name="last_name" placeholder="Santos" required>
                    </div>
                </div>
                <div class="fm-grid">
                    <div class="fm-field" style="margin-bottom:0;">
                        <label class="fm-lbl">Email</label>
                        <input class="fm-in" type="email" name="email" placeholder="you@email.com" required>
                    </div>
                    <div class="fm-field" style="margin-bottom:0;">
                        <label class="fm-lbl">Phone <span style="font-weight:300;color:#B0A89E;">(optional)</span></label>
                        <input class="fm-in" type="tel" name="phone" placeholder="+63 912 345 6789">
                    </div>
                </div>
                <div class="fm-field">
                    <label class="fm-lbl">Subject</label>
                    <input class="fm-in" type="text" name="subject" placeholder="What do you need help with?" required>
                </div>
                <div class="fm-field">
                    <label class="fm-lbl">Message</label>
                    <textarea class="fm-in" name="message" placeholder="Tell us about your event, date, and requirements…" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="outline-btn" style="width:auto;padding:0.6rem 1.2rem;margin:0;" onclick="closeModal()">Cancel</button>
                <button type="submit" class="full-btn" style="width:auto;padding:0.6rem 1.6rem;margin:0;">Send Message</button>
            </div>
        </form>
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
    /* Modal */
    function openModal()  { document.getElementById('inq-modal').style.display='flex'; document.body.style.overflow='hidden'; }
    function closeModal() { document.getElementById('inq-modal').style.display='none';  document.body.style.overflow=''; }
    document.getElementById('inq-modal').addEventListener('click', function(e){ if(e.target===this) closeModal(); });

    /* Hamburger */
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

    /* Reveal on scroll */
    const reveals = document.querySelectorAll('.reveal');
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('visible'); io.unobserve(e.target); } });
    }, { threshold: 0.1 });
    reveals.forEach(el => io.observe(el));
</script>
</body>
</html>