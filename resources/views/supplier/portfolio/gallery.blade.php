<x-supplier-layout>
<style>

        /* ── Cards ── */
        .pf-card{background:var(--white);border-radius:12px;border:1px solid #F0EBE5;box-shadow:0 1px 4px rgba(30,27,24,0.05);overflow:hidden;margin-bottom:1.25rem;}
        .pf-card:last-of-type{margin-bottom:0;}
        .pf-card-header{padding:1.1rem 1.5rem;border-bottom:1px solid #F7F3EF;display:flex;align-items:center;justify-content:space-between;gap:0.75rem;}
        .pf-card-header-l{display:flex;align-items:center;gap:0.75rem;}
        .pf-card-icon{width:34px;height:34px;border-radius:8px;background:rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
        .pf-card-icon svg{width:16px;height:16px;}
        .pf-card-title{font-family:var(--font-display);font-size:0.95rem;font-weight:700;color:var(--charcoal);}
        .pf-card-desc{font-size:0.72rem;color:var(--warm-grey);margin-top:0.1rem;}
        .pf-card-body{padding:1.5rem;}

        /* ── Info grid ── */
        .bv-row-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:0.85rem 1.25rem;}
        .bv-row-full{grid-column:1/-1;}
        @media(max-width:560px){.bv-row-grid{grid-template-columns:1fr;}}
        .bv-info-k{font-size:0.63rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#C0B8B0;margin-bottom:0.28rem;display:flex;align-items:center;gap:0.3rem;}
        .bv-info-k svg{width:10px;height:10px;color:var(--gold-dark);}
        .bv-info-v{font-size:0.85rem;color:var(--charcoal);line-height:1.55;}
        .bv-info-v.nil{color:#C0B8B0;font-style:italic;font-size:0.8rem;}
        .bv-info-v a{color:var(--gold-dark);text-decoration:none;}
        .bv-info-v a:hover{text-decoration:underline;}
        .bv-tag{display:inline-flex;align-items:center;gap:0.3rem;padding:0.18rem 0.65rem;border-radius:999px;background:rgba(201,168,76,0.1);color:var(--gold-dark);font-size:0.68rem;font-weight:600;}
        .bv-tag::before{content:'';width:4px;height:4px;border-radius:50%;background:var(--gold);}
        .bv-prose{font-size:0.83rem;color:var(--warm-grey);line-height:1.65;white-space:pre-wrap;background:rgba(201,168,76,0.03);border:1px solid #F0EBE5;border-radius:8px;padding:0.85rem 1rem;}
        .bv-prose.nil{color:#C0B8B0;font-style:italic;font-size:0.8rem;background:none;border-color:#F7F3EF;}

        /* ── Empty state ── */
        .bv-empty{text-align:center;padding:4rem 2rem;}
        .bv-empty-icon{width:56px;height:56px;border-radius:50%;background:rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;color:var(--gold-dark);}
        .bv-empty-icon svg{width:26px;height:26px;}
        .bv-empty-title{font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--charcoal);margin-bottom:0.4rem;}
        .bv-empty-desc{font-size:0.82rem;color:var(--warm-grey);margin-bottom:1.25rem;line-height:1.6;}

        /* ═══════════════════════════════════════
           FACEBOOK-STYLE POST
        ═══════════════════════════════════════ */
        .pf-portfolio-list{display:flex;flex-direction:column;gap:1.25rem;}
        .pf-post{border-radius:12px;border:1px solid #F0EBE5;overflow:hidden;background:var(--white);box-shadow:0 1px 4px rgba(30,27,24,0.05);}

        /* Post header */
        .pf-post-head{display:flex;align-items:center;justify-content:space-between;padding:0.9rem 1.1rem 0.6rem;}
        .pf-post-head-l{display:flex;align-items:center;gap:0.65rem;}
        .pf-post-avatar{width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,var(--gold),var(--gold-dark));display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:0.95rem;font-weight:700;color:var(--white);flex-shrink:0;overflow:hidden;}
        .pf-post-avatar img{width:100%;height:100%;object-fit:cover;}
        .pf-post-title{font-family:var(--font-display);font-size:0.88rem;font-weight:700;color:var(--charcoal);line-height:1.2;}
        .pf-post-date{font-size:0.65rem;color:#C0B8B0;margin-top:0.06rem;}
        .pf-post-delete-btn{display:inline-flex;align-items:center;gap:0.3rem;padding:0.32rem 0.7rem;border-radius:6px;border:1.5px solid #FADBD8;background:transparent;font-family:var(--font-body);font-size:0.7rem;font-weight:500;color:#C0392B;cursor:pointer;transition:background 0.15s,border-color 0.15s;}
        .pf-post-delete-btn svg{width:10px;height:10px;}
        .pf-post-delete-btn:hover{background:#FFF5F5;border-color:#C0392B;}

        /* Caption */
        .pf-post-desc{padding:0 1.1rem 0.75rem;font-size:0.82rem;color:var(--warm-grey);line-height:1.6;}

        /* ── FACEBOOK MOSAIC ── */
        .pf-mosaic{cursor:pointer;overflow:hidden;background:#F5F0EB;line-height:0;gap:2px;}

        /* 1 photo — full wide 4:3 */
        .pf-mosaic.c1{display:block;aspect-ratio:4/3;}
        .pf-mosaic.c1 .pm{width:100%;height:100%;}

        /* 2 photos — side by side, equal halves */
        .pf-mosaic.c2{display:grid;grid-template-columns:1fr 1fr;height:300px;}

        /* 3 photos — big left, two stacked right */
        .pf-mosaic.c3{display:grid;grid-template-columns:2fr 1fr;grid-template-rows:1fr 1fr;height:320px;}
        .pf-mosaic.c3 .pm:first-child{grid-row:1/3;}

        /* 4 photos — 2×2 grid */
        .pf-mosaic.c4{display:grid;grid-template-columns:1fr 1fr;grid-template-rows:1fr 1fr;height:320px;}

        /* 5 photos — big top spanning full width, 3 below */
        .pf-mosaic.c5{display:grid;grid-template-columns:repeat(3,1fr);grid-template-rows:55% 45%;height:360px;}
        .pf-mosaic.c5 .pm:first-child{grid-column:1/4;}

        /* 6+ photos — big top left, 2 right col stacked; bottom row 3 equal */
        .pf-mosaic.c6plus{display:grid;grid-template-columns:repeat(3,1fr);grid-template-rows:55% 45%;height:360px;}
        .pf-mosaic.c6plus .pm:first-child{grid-column:1/3;}

        /* Cell base */
        .pm{overflow:hidden;position:relative;}
        .pm img{width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.25s;}
        .pm:hover img{transform:scale(1.04);}

        /* "+N" overlay on last visible cell */
        .pm-more{position:absolute;inset:0;background:rgba(30,27,24,0.58);display:flex;align-items:center;justify-content:center;color:#fff;font-family:var(--font-display);font-size:1.6rem;font-weight:700;pointer-events:none;}

        /* Video */
        .pf-post-video{background:#000;}
        .pf-post-video video{width:100%;max-height:420px;display:block;object-fit:contain;}

        /* Footer chips */
        .pf-post-foot{padding:0.6rem 1.1rem;border-top:1px solid #F7F3EF;display:flex;align-items:center;gap:0.4rem;}
        .pf-post-tag{display:inline-flex;align-items:center;gap:0.25rem;padding:0.16rem 0.55rem;border-radius:999px;background:rgba(201,168,76,0.1);color:var(--gold-dark);font-size:0.63rem;font-weight:600;}
        .pf-post-tag::before{content:'';width:4px;height:4px;border-radius:50%;background:var(--gold);}

        .pf-gallery-empty{text-align:center;padding:2.5rem 1.5rem;}
        .pf-gallery-empty-icon{width:48px;height:48px;border-radius:50%;background:rgba(201,168,76,0.08);display:flex;align-items:center;justify-content:center;margin:0 auto 0.75rem;color:var(--gold-dark);}
        .pf-gallery-empty-icon svg{width:22px;height:22px;}
        .pf-gallery-empty p{font-size:0.8rem;color:var(--warm-grey);line-height:1.6;}

        /* ═══════════════════════════════
           LIGHTBOX
        ═══════════════════════════════ */
        .fb-lb{position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.96);display:none;flex-direction:column;}
        .fb-lb.open{display:flex;}
        .fb-lb-bar{display:flex;align-items:center;justify-content:space-between;padding:0.7rem 1.1rem;background:rgba(0,0,0,0.6);flex-shrink:0;}
        .fb-lb-bar-title{font-family:var(--font-display);font-size:0.9rem;font-weight:700;color:var(--white);display:flex;flex-direction:column;gap:0.1rem;}
        .fb-lb-bar-date{font-size:0.65rem;color:rgba(255,255,255,0.45);font-family:var(--font-body);font-weight:400;}
        .fb-lb-bar-r{display:flex;align-items:center;gap:0.55rem;}
        .fb-lb-icon-btn{width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.1);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--white);transition:background 0.2s;}
        .fb-lb-icon-btn:hover{background:rgba(255,255,255,0.22);}
        .fb-lb-icon-btn svg{width:16px;height:16px;}
        .fb-lb-main{flex:1;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;min-height:0;}
        .fb-lb-media-wrap{display:flex;align-items:center;justify-content:center;max-width:100%;max-height:100%;width:100%;height:100%;}
        .fb-lb-media-wrap img{max-width:100%;max-height:100%;object-fit:contain;display:block;border-radius:4px;user-select:none;}
        .fb-lb-media-wrap video{max-width:100%;max-height:100%;width:100%;display:block;object-fit:contain;}
        .fb-lb-nav{position:absolute;top:50%;transform:translateY(-50%);width:46px;height:46px;border-radius:50%;background:rgba(255,255,255,0.14);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--white);transition:background 0.2s;z-index:2;}
        .fb-lb-nav:hover{background:rgba(255,255,255,0.28);}
        .fb-lb-nav svg{width:20px;height:20px;}
        .fb-lb-nav.lb-prev{left:14px;}
        .fb-lb-nav.lb-next{right:14px;}
        .fb-lb-bottom{background:rgba(0,0,0,0.65);flex-shrink:0;}
        .fb-lb-counter{text-align:center;font-size:0.7rem;color:rgba(255,255,255,0.45);padding:0.4rem 0 0;}
        .fb-lb-strip{display:flex;align-items:center;justify-content:center;gap:0.35rem;padding:0.55rem 1rem;overflow-x:auto;}
        .fb-lb-strip::-webkit-scrollbar{height:3px;}
        .fb-lb-strip::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.2);border-radius:2px;}
        .fb-lb-thumb{width:50px;height:50px;object-fit:cover;border-radius:5px;cursor:pointer;opacity:0.5;border:2px solid transparent;transition:opacity 0.2s,border-color 0.2s;flex-shrink:0;}
        .fb-lb-thumb.lb-active{opacity:1;border-color:var(--gold);}
        .fb-lb-thumb:hover{opacity:0.85;}

        /* Success alert */
        .bv-alert-success{display:flex;align-items:center;gap:0.65rem;background:#F0FDF4;border:1px solid #A7F3D0;border-radius:8px;padding:0.75rem 1rem;font-size:0.82rem;color:#065F46;margin-bottom:1.5rem;}
        .bv-alert-success svg{width:16px;height:16px;color:#10B981;flex-shrink:0;}

        /* Mobile */
        @media(max-width:680px){
            .bv-id-card-inner{flex-direction:column;gap:0.75rem;padding:0 1rem 1.25rem;}
            .bv-id-right{min-width:unset;width:100%;padding-top:0;}
            .bv-id-links{gap:0.4rem;}
            .bv-header-actions{flex-wrap:wrap;}
            .pf-mosaic.c3,.pf-mosaic.c4,.pf-mosaic.c5,.pf-mosaic.c6plus{height:240px;}
            .pf-mosaic.c2{height:200px;}
        }
</style>

{{-- Portfolio Feed --}}
<div class="pf-card" style="margin-bottom:0;">
    <div class="pf-card-header">
        <div class="pf-card-header-l">
            <div class="pf-card-icon">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="4" width="16" height="13" rx="2"/><circle cx="7" cy="9" r="1.5"/><path d="M2 14l4-4 3 3 3-3 6 5"/></svg>
            </div>
            <div>
                <div class="pf-card-title">My Gallery</div>
                <div class="pf-card-desc">
                    @php $totalItems = isset($portfolios) ? count($portfolios) : 0; @endphp
                    {{ $totalItems }} {{ $totalItems === 1 ? 'item' : 'items' }}
                </div>
            </div>
        </div>
    </div>
    <div class="pf-card-body">
        @if(isset($portfolios) && count($portfolios))
            <div class="pf-portfolio-list">
                @foreach($portfolios as $portfolio)
                @php
                    $imgs     = $portfolio->images ?? [];
                    $imgCount = count($imgs);
                    $hasVideo = !empty($portfolio->video);
                    $allUrls  = array_map(fn($i) => asset('storage/'.$i), $imgs);
                    $allJson  = json_encode($allUrls);

                    // How many cells to render and which CSS class
                    if ($imgCount === 1) {
                        $cls = 'c1'; $maxShow = 1;
                    } elseif ($imgCount === 2) {
                        $cls = 'c2'; $maxShow = 2;
                    } elseif ($imgCount === 3) {
                        $cls = 'c3'; $maxShow = 3;
                    } elseif ($imgCount === 4) {
                        $cls = 'c4'; $maxShow = 4;
                    } elseif ($imgCount === 5) {
                        $cls = 'c5'; $maxShow = 5;
                    } else {
                        $cls = 'c6plus'; $maxShow = 4; // show 4, last has +N
                    }
                @endphp

                <div class="pf-post">

                    {{-- Post header --}}
                    <div class="pf-post-head">
                        <div class="pf-post-head-l">
                            <div class="pf-post-avatar">
                                @if(!empty($supplierProfile->photo))
                                    <img src="{{ asset('storage/'.$supplierProfile->photo) }}" alt="">
                                @else
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                @endif
                            </div>
                            <div>
                                <div class="pf-post-title">{{ $portfolio->title }}</div>
                                <div class="pf-post-date">{{ $portfolio->created_at ? $portfolio->created_at->diffForHumans() : '' }}</div>
                            </div>
                        </div>
                        <form method="POST"
                              action="{{ route('supplier.portfolio.destroy', $portfolio->id) }}"
                              onsubmit="return confirm('Remove this portfolio item?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="pf-post-delete-btn">
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 3.5h10M5 3.5V2.5h4v1M4.5 3.5v7a1 1 0 001 1h3a1 1 0 001-1v-7"/></svg>
                                Delete
                            </button>
                        </form>
                    </div>

                    {{-- Caption --}}
                    @if($portfolio->description)
                    <div class="pf-post-desc">{{ $portfolio->description }}</div>
                    @endif

                    {{-- Photo mosaic --}}
                    @if($imgCount > 0)
                    <div class="pf-mosaic {{ $cls }}">
                        @for($ci = 0; $ci < $maxShow; $ci++)
                        @php $isLast = ($ci === $maxShow - 1); $remaining = $imgCount - $maxShow; @endphp
                        <div class="pm"
                             onclick="fbLbOpen({{ $allJson }}, {{ $ci }}, '{{ addslashes($portfolio->title) }}')">
                            <img src="{{ asset('storage/'.$imgs[$ci]) }}" alt="" loading="lazy">
                            @if($isLast && $remaining > 0)
                                <div class="pm-more">+{{ $remaining }}</div>
                            @endif
                        </div>
                        @endfor
                    </div>
                    @endif

                    {{-- Video --}}
                    @if($hasVideo)
                    <div class="pf-post-video">
                        <video width="100%" controls preload="metadata">
                            <source src="{{ asset('storage/' . $portfolio->video) }}">
                        </video>
                    </div>
                    @endif

                    {{-- Footer chips --}}
                    <div class="pf-post-foot">
                        @if($imgCount > 0)
                            <span class="pf-post-tag">{{ $imgCount }} photo{{ $imgCount !== 1 ? 's' : '' }}</span>
                        @endif
                        @if($hasVideo)
                            <span class="pf-post-tag">Video</span>
                        @endif
                    </div>

                </div>{{-- /pf-post --}}
                @endforeach
            </div>
        @else
            <div class="pf-gallery-empty">
                <div class="pf-gallery-empty-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                </div>
                <p>No portfolio items yet.<br>Upload your first photos or video below.</p>
            </div>
        @endif
    </div>
</div>

{{-- LIGHTBOX --}}
<div id="fbLb" class="fb-lb" onclick="if(event.target===this)fbLbClose()">
    <div class="fb-lb-bar">
        <div class="fb-lb-bar-title">
            <span id="fbLbTitle"></span>
            <span class="fb-lb-bar-date" id="fbLbCounter"></span>
        </div>
        <div class="fb-lb-bar-r">
            <button type="button" class="fb-lb-icon-btn" onclick="fbLbClose()" title="Close">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M2 2l10 10M12 2L2 12"/></svg>
            </button>
        </div>
    </div>
    <div class="fb-lb-main">
        <button type="button" class="fb-lb-nav lb-prev" id="fbLbPrev" onclick="fbLbNav(-1)">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 2L4 7l5 5"/></svg>
        </button>
        <div class="fb-lb-media-wrap">
            <img id="fbLbImg" src="" alt="" style="display:none;">
            <video id="fbLbVideo" src="" controls preload="metadata" style="display:none;"></video>
        </div>
        <button type="button" class="fb-lb-nav lb-next" id="fbLbNext" onclick="fbLbNav(1)">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 2l5 5-5 5"/></svg>
        </button>
    </div>
    <div class="fb-lb-bottom">
        <div class="fb-lb-strip" id="fbLbStrip"></div>
    </div>
</div>

<script>
var fbUrls=[];var fbIdx=0;var fbTitle='';
function fbLbOpen(urls,idx,title){
    fbUrls=urls;fbIdx=idx;fbTitle=title;
    var strip=document.getElementById('fbLbStrip');
    strip.innerHTML='';
    if(urls.length>1){
        for(var i=0;i<urls.length;i++){
            var th=document.createElement('img');
            th.src=urls[i];
            th.className='fb-lb-thumb'+(i===idx?' lb-active':'');
            th.setAttribute('data-i',i);
            th.onclick=(function(ii){return function(){fbLbGo(ii);};})(i);
            strip.appendChild(th);
        }
    }
    document.getElementById('fbLb').classList.add('open');
    document.body.style.overflow='hidden';
    fbLbGo(idx);
}
function fbLbGo(idx){
    fbIdx=idx;
    var img=document.getElementById('fbLbImg');
    var vid=document.getElementById('fbLbVideo');
    var title=document.getElementById('fbLbTitle');
    var ctr=document.getElementById('fbLbCounter');
    var prev=document.getElementById('fbLbPrev');
    var next=document.getElementById('fbLbNext');
    var thumbs=document.querySelectorAll('.fb-lb-thumb');
    title.textContent=fbTitle;
    ctr.textContent=fbUrls.length>1?(idx+1)+' / '+fbUrls.length:'';
    img.style.display='none';vid.style.display='none';vid.pause();
    var url=fbUrls[idx];
    var isVid=/\.(mp4|mov|webm|ogg|avi)(\?|$)/i.test(url);
    if(isVid){vid.src=url;vid.style.display='block';}
    else{img.src=url;img.style.display='block';}
    prev.style.display=idx===0?'none':'flex';
    next.style.display=idx===fbUrls.length-1?'none':'flex';
    thumbs.forEach(function(t,i){t.classList.toggle('lb-active',i===idx);});
    if(thumbs[idx]){thumbs[idx].scrollIntoView({block:'nearest',inline:'center',behavior:'smooth'});}
}
function fbLbNav(dir){var n=fbIdx+dir;if(n>=0&&n<fbUrls.length)fbLbGo(n);}
function fbLbClose(){
    document.getElementById('fbLb').classList.remove('open');
    document.body.style.overflow='';
    var vid=document.getElementById('fbLbVideo');vid.pause();vid.src='';
}
document.addEventListener('keydown',function(e){
    if(!document.getElementById('fbLb').classList.contains('open'))return;
    if(e.key==='Escape')fbLbClose();
    if(e.key==='ArrowLeft')fbLbNav(-1);
    if(e.key==='ArrowRight')fbLbNav(1);
});
</script>

</x-supplier-layout>