<x-supplier-layout>
    <style>
        .bv-page-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;}
        .bv-page-title{font-family:var(--font-display);font-size:1.75rem;font-weight:700;color:var(--charcoal);line-height:1.1;}
        .bv-page-title em{font-style:italic;color:var(--gold-dark);}
        .bv-page-sub{font-size:0.8rem;color:var(--warm-grey);margin-top:0.3rem;}

        /* ── Header action buttons ── */
        .bv-header-actions{display:flex;align-items:center;gap:0.65rem;}
        .bv-btn-primary{
            display:inline-flex;align-items:center;gap:0.45rem;
            padding:0.6rem 1.3rem;border-radius:6px;border:none;
            background:var(--charcoal);font-family:var(--font-body);
            font-size:0.8rem;font-weight:500;color:var(--white);
            text-decoration:none;transition:background 0.2s,box-shadow 0.2s,transform 0.15s;
        }
        .bv-btn-primary svg{width:13px;height:13px;}
        .bv-btn-primary:hover{background:var(--gold-dark);box-shadow:0 4px 12px rgba(201,168,76,0.2);transform:translateY(-1px);}
        .bv-btn-secondary{
            display:inline-flex;align-items:center;gap:0.45rem;
            padding:0.6rem 1.2rem;border-radius:6px;
            border:1.5px solid #E5DDD5;background:var(--white);
            font-family:var(--font-body);font-size:0.8rem;font-weight:500;
            color:var(--warm-grey);text-decoration:none;
            transition:border-color 0.2s,color 0.2s,background 0.2s;
        }
        .bv-btn-secondary svg{width:13px;height:13px;}
        .bv-btn-secondary:hover{border-color:var(--gold);color:var(--gold-dark);background:rgba(201,168,76,0.05);}

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

        /* ── Portfolio gallery grid (existing DB items) ── */
        .pf-gallery{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:1rem;}
        .pf-item{border-radius:10px;overflow:hidden;border:1px solid #F0EBE5;background:var(--ivory);position:relative;}
        .pf-item-thumb{aspect-ratio:1;overflow:hidden;background:#F5F0EB;}
        .pf-item-thumb img{width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.3s;}
        .pf-item:hover .pf-item-thumb img{transform:scale(1.05);}
        .pf-item-imgs{display:flex;height:100%;gap:2px;}
        .pf-item-imgs img{flex:1;object-fit:cover;min-width:0;}
        .pf-item-info{padding:0.6rem 0.8rem;}
        .pf-item-title{font-size:0.78rem;font-weight:600;color:var(--charcoal);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-bottom:0.18rem;}
        .pf-item-meta{font-size:0.65rem;color:#C0B8B0;display:flex;align-items:center;gap:0.35rem;}
        .pf-item-meta svg{width:9px;height:9px;color:var(--gold-dark);}
        .pf-item-video{width:100%;display:block;}

        /* empty state */
        .pf-empty{text-align:center;padding:3rem 1.5rem;}
        .pf-empty-icon{width:50px;height:50px;border-radius:50%;background:rgba(201,168,76,0.08);display:flex;align-items:center;justify-content:center;margin:0 auto 0.8rem;color:var(--gold-dark);}
        .pf-empty-icon svg{width:22px;height:22px;}
        .pf-empty p{font-size:0.82rem;color:var(--warm-grey);line-height:1.6;}


        /* ── Layout ── */
        .bv-pi-layout{display:grid;grid-template-columns:260px 1fr;gap:1.5rem;align-items:start;}
        @media(max-width:880px){.bv-pi-layout{grid-template-columns:1fr;}}

        /* ── LEFT: Identity card ── */
        .bv-id-card{background:var(--white);border-radius:14px;border:1px solid #F0EBE5;overflow:hidden;box-shadow:0 2px 8px rgba(30,27,24,0.06);}
        .bv-id-card-banner{height:72px;background:linear-gradient(135deg,var(--charcoal) 0%,#2a2016 60%,#3d2f14 100%);position:relative;}
        .bv-id-card-banner::after{content:'';position:absolute;bottom:0;left:0;right:0;height:32px;background:var(--white);clip-path:ellipse(60% 100% at 50% 100%);}
        .bv-id-avatar-wrap{position:relative;width:80px;height:80px;margin:-40px auto 0;z-index:2;}
        .bv-id-avatar{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--gold) 0%,var(--gold-dark) 100%);display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:1.8rem;font-weight:700;color:var(--white);overflow:hidden;border:3px solid var(--white);box-shadow:0 2px 12px rgba(30,27,24,0.15);}
        .bv-id-avatar img{width:100%;height:100%;object-fit:cover;display:none;}
        .bv-id-avatar.has-photo img{display:block;}
        .bv-id-avatar.has-photo span{display:none;}
        .bv-id-card-body{padding:0.75rem 1.4rem 1.4rem;text-align:center;}
        .bv-id-name{font-family:var(--font-display);font-size:1.05rem;font-weight:700;color:var(--charcoal);margin-bottom:0.15rem;line-height:1.25;}
        .bv-id-category{font-size:0.7rem;color:var(--gold-dark);letter-spacing:0.05em;font-weight:600;text-transform:uppercase;margin-bottom:0.75rem;}
        .bv-id-badge{display:inline-flex;align-items:center;gap:0.35rem;padding:0.22rem 0.75rem;border-radius:999px;background:rgba(201,168,76,0.1);color:var(--gold-dark);font-size:0.65rem;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;margin-bottom:1.1rem;}
        .bv-id-badge::before{content:'';width:5px;height:5px;border-radius:50%;background:var(--gold);}
        .bv-id-divider{height:1px;background:#F0EBE5;margin:0.85rem 0;}
        .bv-id-meta{display:flex;flex-direction:column;gap:0.55rem;text-align:left;}
        .bv-id-meta-row{display:flex;align-items:flex-start;gap:0.6rem;}
        .bv-id-meta-icon{width:14px;height:14px;color:var(--gold-dark);flex-shrink:0;margin-top:1px;}
        .bv-id-meta-text{font-size:0.75rem;color:var(--warm-grey);line-height:1.4;word-break:break-word;}
        .bv-id-meta-text strong{display:block;font-size:0.65rem;text-transform:uppercase;letter-spacing:0.07em;color:#C0B8B0;font-weight:600;margin-bottom:0.08rem;}
        .bv-id-tagline{font-size:0.75rem;color:var(--warm-grey);font-style:italic;line-height:1.55;padding:0.75rem 0.9rem;background:rgba(201,168,76,0.05);border-radius:8px;border-left:2px solid rgba(201,168,76,0.3);text-align:left;margin-top:0.1rem;}
        .bv-completion{margin-top:1rem;}
        .bv-completion-label{display:flex;justify-content:space-between;font-size:0.68rem;color:var(--warm-grey);margin-bottom:0.4rem;}
        .bv-completion-label strong{color:var(--gold-dark);}
        .bv-completion-bar{height:4px;background:#F0EBE5;border-radius:2px;overflow:hidden;}
        .bv-completion-fill{height:100%;background:linear-gradient(90deg,var(--gold),var(--gold-light));border-radius:2px;}

        /* LEFT card quick-action links */
        .bv-id-links{display:flex;flex-direction:column;gap:0.35rem;margin-top:0.75rem;}
        .bv-id-link{
            display:flex;align-items:center;gap:0.55rem;
            padding:0.55rem 0.75rem;border-radius:8px;
            font-family:var(--font-body);font-size:0.78rem;font-weight:500;
            color:var(--warm-grey);text-decoration:none;
            transition:background 0.15s,color 0.15s;
        }
        .bv-id-link svg{width:13px;height:13px;flex-shrink:0;}
        .bv-id-link:hover{background:rgba(201,168,76,0.08);color:var(--gold-dark);}
        .bv-id-link.settings{color:var(--warm-grey);}
        .bv-id-link.settings:hover{background:rgba(201,168,76,0.08);color:var(--gold-dark);}

        /* ── RIGHT: Section cards ── */
        .bv-main-stack{display:flex;flex-direction:column;gap:1.25rem;}
        .bv-sc{background:var(--white);border-radius:12px;border:1px solid #F0EBE5;overflow:hidden;box-shadow:0 1px 4px rgba(30,27,24,0.04);}
        .bv-sc-head{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.4rem;border-bottom:1px solid #F7F3EF;}
        .bv-sc-head-l{display:flex;align-items:center;gap:0.65rem;}
        .bv-sc-icon{width:32px;height:32px;border-radius:8px;background:rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
        .bv-sc-icon svg{width:15px;height:15px;}
        .bv-sc-title{font-family:var(--font-display);font-size:0.9rem;font-weight:700;color:var(--charcoal);}
        .bv-sc-desc{font-size:0.7rem;color:var(--warm-grey);margin-top:0.06rem;}
        .bv-sc-body{padding:1.35rem 1.4rem;}

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

        /* ── Section edit button ── */
        .bv-btn-edit{
            display:inline-flex;align-items:center;gap:0.4rem;
            padding:0.4rem 0.85rem;border-radius:6px;
            border:1.5px solid #E5DDD5;background:var(--white);
            font-family:var(--font-body);font-size:0.74rem;font-weight:500;
            color:var(--warm-grey);text-decoration:none;
            transition:border-color 0.2s,color 0.2s,background 0.2s;
        }
        .bv-btn-edit svg{width:11px;height:11px;}
        .bv-btn-edit:hover{border-color:var(--gold);color:var(--gold-dark);background:rgba(201,168,76,0.05);}

        /* ── Alert ── */
        .bv-alert{display:flex;align-items:center;gap:0.6rem;padding:0.7rem 1rem;border-radius:8px;font-size:0.8rem;margin-bottom:1.1rem;}
        .bv-alert svg{width:14px;height:14px;flex-shrink:0;}
        .bv-alert-ok{background:#F0FDF4;border:1px solid #A7F3D0;color:#065F46;}
        .bv-alert-ok svg{color:#10B981;}

        /* ── Empty state (no profile yet) ── */
        .bv-empty{text-align:center;padding:4rem 2rem;}
        .bv-empty-icon{width:56px;height:56px;border-radius:50%;background:rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;color:var(--gold-dark);}
        .bv-empty-icon svg{width:26px;height:26px;}
        .bv-empty-title{font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--charcoal);margin-bottom:0.4rem;}
        .bv-empty-desc{font-size:0.82rem;color:var(--warm-grey);margin-bottom:1.25rem;line-height:1.6;}

        /* ═══════════════════════════════════════
           FACEBOOK-STYLE PORTFOLIO POST STYLES
           (added — zero existing CSS changed)
        ═══════════════════════════════════════ */

        /* Portfolio feed */
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

        /* Description */
        .pf-post-desc{padding:0 1.1rem 0.75rem;font-size:0.82rem;color:var(--warm-grey);line-height:1.6;}

        /* Facebook-style image mosaics */
        .pf-mosaic{overflow:hidden;background:#F5F0EB;cursor:pointer;}
        .pf-mosaic.count-1{aspect-ratio:16/9;}
        .pf-mosaic.count-1 img{width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.3s;}
        .pf-mosaic.count-1:hover img{transform:scale(1.03);}
        .pf-mosaic.count-2{display:grid;grid-template-columns:1fr 1fr;gap:2px;height:280px;}
        .pf-mosaic.count-3{display:grid;grid-template-columns:2fr 1fr;grid-template-rows:1fr 1fr;gap:2px;height:300px;}
        .pf-mosaic.count-3 .pf-mos-cell:first-child{grid-row:1/3;}
        .pf-mosaic.count-4{display:grid;grid-template-columns:1fr 1fr;grid-template-rows:1fr 1fr;gap:2px;height:320px;}
        .pf-mosaic.count-5plus{display:grid;grid-template-columns:1fr 1fr;grid-template-rows:1fr 1fr;gap:2px;height:320px;}
        .pf-mosaic.count-5plus .pf-mos-cell:first-child{grid-column:1/3;}
        .pf-mos-cell{overflow:hidden;position:relative;}
        .pf-mos-cell img{width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.25s;}
        .pf-mos-cell:hover img{transform:scale(1.04);}
        .pf-mos-more{position:absolute;inset:0;background:rgba(30,27,24,0.55);display:flex;align-items:center;justify-content:center;color:var(--white);font-family:var(--font-display);font-size:1.5rem;font-weight:700;pointer-events:none;}

        /* Video */
        .pf-post-video{background:#000;}
        .pf-post-video video{width:100%;max-height:400px;display:block;object-fit:contain;}

        /* Post footer tags */
        .pf-post-foot{padding:0.6rem 1.1rem;border-top:1px solid #F7F3EF;display:flex;align-items:center;gap:0.4rem;}
        .pf-post-tag{display:inline-flex;align-items:center;gap:0.25rem;padding:0.16rem 0.55rem;border-radius:999px;background:rgba(201,168,76,0.1);color:var(--gold-dark);font-size:0.63rem;font-weight:600;}
        .pf-post-tag::before{content:'';width:4px;height:4px;border-radius:50%;background:var(--gold);}

        /* Empty gallery */
        .pf-gallery-empty{text-align:center;padding:2.5rem 1.5rem;}
        .pf-gallery-empty-icon{width:48px;height:48px;border-radius:50%;background:rgba(201,168,76,0.08);display:flex;align-items:center;justify-content:center;margin:0 auto 0.75rem;color:var(--gold-dark);}
        .pf-gallery-empty-icon svg{width:22px;height:22px;}
        .pf-gallery-empty p{font-size:0.8rem;color:var(--warm-grey);line-height:1.6;}

        /* ═══════════════════════════════
           FACEBOOK-STYLE LIGHTBOX (added)
        ═══════════════════════════════ */
        .fb-lb{position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.96);display:none;flex-direction:column;}
        .fb-lb.open{display:flex;}

        /* Top bar */
        .fb-lb-bar{display:flex;align-items:center;justify-content:space-between;padding:0.7rem 1.1rem;background:rgba(0,0,0,0.6);flex-shrink:0;}
        .fb-lb-bar-title{font-family:var(--font-display);font-size:0.9rem;font-weight:700;color:var(--white);display:flex;flex-direction:column;gap:0.1rem;}
        .fb-lb-bar-date{font-size:0.65rem;color:rgba(255,255,255,0.45);font-family:var(--font-body);font-weight:400;}
        .fb-lb-bar-r{display:flex;align-items:center;gap:0.55rem;}
        .fb-lb-icon-btn{width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.1);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--white);transition:background 0.2s;}
        .fb-lb-icon-btn:hover{background:rgba(255,255,255,0.22);}
        .fb-lb-icon-btn svg{width:16px;height:16px;}

        /* Main viewer */
        .fb-lb-main{flex:1;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;min-height:0;}
        .fb-lb-media-wrap{display:flex;align-items:center;justify-content:center;max-width:100%;max-height:100%;width:100%;height:100%;}
        .fb-lb-media-wrap img{max-width:100%;max-height:100%;object-fit:contain;display:block;border-radius:4px;user-select:none;}
        .fb-lb-media-wrap video{max-width:100%;max-height:100%;width:100%;display:block;object-fit:contain;}

        /* Nav arrows */
        .fb-lb-nav{position:absolute;top:50%;transform:translateY(-50%);width:46px;height:46px;border-radius:50%;background:rgba(255,255,255,0.14);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--white);transition:background 0.2s;z-index:2;}
        .fb-lb-nav:hover{background:rgba(255,255,255,0.28);}
        .fb-lb-nav svg{width:20px;height:20px;}
        .fb-lb-nav.lb-prev{left:14px;}
        .fb-lb-nav.lb-next{right:14px;}
        .fb-lb-nav[style*="display:none"],.fb-lb-nav.lb-hide{display:none !important;}

        /* Bottom strip */
        .fb-lb-bottom{background:rgba(0,0,0,0.65);flex-shrink:0;}
        .fb-lb-counter{text-align:center;font-size:0.7rem;color:rgba(255,255,255,0.45);padding:0.4rem 0 0;}
        .fb-lb-strip{display:flex;align-items:center;justify-content:center;gap:0.35rem;padding:0.55rem 1rem;overflow-x:auto;}
        .fb-lb-strip::-webkit-scrollbar{height:3px;}
        .fb-lb-strip::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.2);border-radius:2px;}
        .fb-lb-thumb{width:50px;height:50px;object-fit:cover;border-radius:5px;cursor:pointer;opacity:0.5;border:2px solid transparent;transition:opacity 0.2s,border-color 0.2s;flex-shrink:0;}
        .fb-lb-thumb.lb-active{opacity:1;border-color:var(--gold);}
        .fb-lb-thumb:hover{opacity:0.85;}
    </style>

    <div class="page-content">

        {{-- Page header --}}
        <div class="bv-page-header">
            <div>
                <h1 class="bv-page-title">Personal <em>Information</em></h1>
                <p class="bv-page-sub">Your supplier profile details</p>
            </div>

            @if($supplierProfile)
            <div class="bv-header-actions">
                <a href="{{ route('supplier.portfolio.index') }}" class="bv-btn-secondary">
                   Add Portfolio
                </a>
               <a href="{{ route('supplier.profile') }}" class="bv-btn-secondary">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="2"/><path d="M7 1v1.2M7 11.8V13M1 7h1.2M11.8 7H13M2.8 2.8l.85.85M10.35 10.35l.85.85M10.35 3.65l-.85.85M3.65 10.35l-.85.85"/></svg>
                  Account Settings
                </a>
                <a href="{{ route('supplier.edit', $supplierProfile->id) }}" class="bv-btn-primary">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2l2 2-7 7H3v-2L10 2z"/></svg>
                    Edit Profile
                </a>
            </div>
            @endif
        </div>

        @if(session('status') === 'personal-updated')
        <div class="bv-alert bv-alert-ok">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
            Personal information updated successfully.
        </div>
        @endif

        @if($supplierProfile)

        <div class="bv-pi-layout">

            {{-- LEFT: Identity card --}}
            <div>
                <div class="bv-id-card">
                    <div class="bv-id-card-banner"></div>

                    <div class="bv-id-avatar-wrap">
                        <div class="bv-id-avatar {{ $supplierProfile->photo ? 'has-photo' : '' }}">
                            @if($supplierProfile->photo)
                                <img src="{{ asset('storage/'.$supplierProfile->photo) }}" alt="">
                            @else
                                <span>{{ strtoupper(substr($supplierProfile->first_name ?? Auth::user()->name, 0, 2)) }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="bv-id-card-body">
                        <div class="bv-id-name">
                            {{ $supplierProfile->business_name ?: trim(($supplierProfile->first_name ?? '').' '.($supplierProfile->last_name ?? '')) ?: Auth::user()->name }}
                        </div>
                        <div class="bv-id-category">{{ $supplierProfile->category ?? 'No Category Set' }}</div>
                        <div class="bv-id-badge">Active Supplier</div>

                        @php
                            $filled = collect([
                                $supplierProfile->first_name, $supplierProfile->last_name,
                                $supplierProfile->phone,      $supplierProfile->city,
                                $supplierProfile->category,   $supplierProfile->bio,
                                $supplierProfile->description,$supplierProfile->photo
                            ])->filter()->count();
                            $pct = round(($filled / 8) * 100);
                            $expLabels = ['less_than_1'=>'< 1 year','1_2'=>'1–2 years','3_5'=>'3–5 years','6_10'=>'6–10 years','10_plus'=>'10+ years'];
                        @endphp

                        <div class="bv-completion">
                            <div class="bv-completion-label">
                                <span>Profile completion</span>
                                <strong>{{ $pct }}%</strong>
                            </div>
                            <div class="bv-completion-bar">
                                <div class="bv-completion-fill" style="width:{{ $pct }}%;"></div>
                            </div>
                        </div>

                        <div class="bv-id-divider"></div>

                        <div class="bv-id-meta">
                            <div class="bv-id-meta-row">
                                <svg class="bv-id-meta-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="1" y="3" width="14" height="10" rx="2"/><path d="M1 6l7 4 7-4"/></svg>
                                <div class="bv-id-meta-text"><strong>Email</strong>{{ Auth::user()->email }}</div>
                            </div>
                            @if($supplierProfile->phone)
                            <div class="bv-id-meta-row">
                                <svg class="bv-id-meta-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M2 4a2 2 0 012-2h1l1.5 3-1 1a7 7 0 003 3l1-1L13 10.5V12a2 2 0 01-2 2C5 14 1 10 1 5a2 2 0 011-1.7V4z"/></svg>
                                <div class="bv-id-meta-text"><strong>Phone</strong>{{ $supplierProfile->phone }}</div>
                            </div>
                            @endif
                            @if($supplierProfile->city || $supplierProfile->province)
                            <div class="bv-id-meta-row">
                                <svg class="bv-id-meta-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M8 1C5.8 1 4 2.8 4 5c0 3.5 4 9 4 9s4-5.5 4-9c0-2.2-1.8-4-4-4z"/><circle cx="8" cy="5" r="1.5"/></svg>
                                <div class="bv-id-meta-text"><strong>Location</strong>{{ implode(', ', array_filter([$supplierProfile->city, $supplierProfile->province])) }}</div>
                            </div>
                            @endif
                            @if($supplierProfile->experience_level)
                            <div class="bv-id-meta-row">
                                <svg class="bv-id-meta-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="8" cy="8" r="6"/><path d="M8 5v3l2 2"/></svg>
                                <div class="bv-id-meta-text"><strong>Experience</strong>{{ $expLabels[$supplierProfile->experience_level] ?? $supplierProfile->experience_level }}</div>
                            </div>
                            @endif
                        </div>

                        @if($supplierProfile->tagline)
                        <div class="bv-id-divider"></div>
                        <div class="bv-id-tagline">"{{ $supplierProfile->tagline }}"</div>
                        @endif

                        {{-- Quick links --}}
                        <div class="bv-id-divider"></div>
                        <div class="bv-id-links">
                            <a href="{{ route('supplier.edit', $supplierProfile->id) }}" class="bv-id-link">
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2l2 2-7 7H3v-2L10 2z"/></svg>
                                Edit Profile
                            </a>
                            <a href="{{ route('supplier.profile') }}" class="bv-id-link settings">
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="2"/><path d="M7 1v1.2M7 11.8V13M1 7h1.2M11.8 7H13M2.8 2.8l.85.85M10.35 10.35l.85.85M10.35 3.65l-.85.85M3.65 10.35l-.85.85"/></svg>
                                Account Settings
                            </a>
                            <a href="{{ route('supplier.portfolio.index', $supplierProfile->id) }}" class="bv-id-link">
                                Portfolio
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            {{-- RIGHT: Info sections --}}
            <div class="bv-main-stack">

                {{-- Personal Identity --}}
                <div class="bv-sc">
                    <div class="bv-sc-head">
                        <div class="bv-sc-head-l">
                            <div class="bv-sc-icon">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="7" r="4"/><path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                            </div>
                            <div>
                                <div class="bv-sc-title">Personal Identity</div>
                                <div class="bv-sc-desc">Name, business identity and category</div>
                            </div>
                        </div>
                        <a href="{{ route('supplier.edit', $supplierProfile->id) }}" class="bv-btn-edit">
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2l2 2-7 7H3v-2L10 2z"/></svg>
                            Edit
                        </a>
                    </div>
                    <div class="bv-sc-body">
                        <div class="bv-row-grid">
                            <div>
                                <div class="bv-info-k"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="6" cy="4" r="2.5"/><path d="M1 11c0-2.8 2.2-5 5-5s5 2.2 5 5"/></svg>First Name</div>
                                <div class="bv-info-v {{ !$supplierProfile->first_name ? 'nil' : '' }}">{{ $supplierProfile->first_name ?: '—' }}</div>
                            </div>
                            <div>
                                <div class="bv-info-k"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="6" cy="4" r="2.5"/><path d="M1 11c0-2.8 2.2-5 5-5s5 2.2 5 5"/></svg>Last Name</div>
                                <div class="bv-info-v {{ !$supplierProfile->last_name ? 'nil' : '' }}">{{ $supplierProfile->last_name ?: '—' }}</div>
                            </div>
                            <div>
                                <div class="bv-info-k"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="1" y="4" width="10" height="7" rx="1.5"/><path d="M3 4V3a3 3 0 016 0v1"/></svg>Business Name</div>
                                <div class="bv-info-v {{ !$supplierProfile->business_name ? 'nil' : '' }}">{{ $supplierProfile->business_name ?: 'Using full name' }}</div>
                            </div>
                            <div>
                                <div class="bv-info-k"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="1" y="1" width="4" height="4" rx="1"/><rect x="7" y="1" width="4" height="4" rx="1"/><rect x="1" y="7" width="4" height="4" rx="1"/><rect x="7" y="7" width="4" height="4" rx="1"/></svg>Category</div>
                                <div class="bv-info-v">
                                    @if($supplierProfile->category)<span class="bv-tag">{{ $supplierProfile->category }}</span>@else<span class="nil">—</span>@endif
                                </div>
                            </div>
                            <div class="bv-row-full">
                                <div class="bv-info-k"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M2 3h8M2 5.5h5M2 8h6"/></svg>Tagline</div>
                                <div class="bv-info-v {{ !$supplierProfile->tagline ? 'nil' : '' }}">{{ $supplierProfile->tagline ?: '—' }}</div>
                            </div>
                            <div>
                                <div class="bv-info-k"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="6" cy="6" r="5"/><path d="M6 4v2.5l1.5 1.5"/></svg>Experience</div>
                                <div class="bv-info-v {{ !$supplierProfile->experience ? 'nil' : '' }}">
                                    {{ isset($expLabels[$supplierProfile->experience]) ? $expLabels[$supplierProfile->experience] : ($supplierProfile->experience ?: '—') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contact & Location --}}
                <div class="bv-sc">
                    <div class="bv-sc-head">
                        <div class="bv-sc-head-l">
                            <div class="bv-sc-icon">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M3 5a2 2 0 012-2h1l2 4-1.5 1.5a11 11 0 004 4L12 11l4 2v1a2 2 0 01-2 2C7.5 16 4 12.5 4 7a2 2 0 011-1.7V5z"/></svg>
                            </div>
                            <div>
                                <div class="bv-sc-title">Contact & Location</div>
                                <div class="bv-sc-desc">Phone, address and location details</div>
                            </div>
                        </div>
                        <a href="{{ route('supplier.edit', $supplierProfile->id) }}" class="bv-btn-edit">
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2l2 2-7 7H3v-2L10 2z"/></svg>
                            Edit
                        </a>
                    </div>
                    <div class="bv-sc-body">
                        <div class="bv-row-grid">
                            <div>
                                <div class="bv-info-k"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="1" y="2" width="10" height="8" rx="1.5"/><path d="M1 4.5l5 3 5-3"/></svg>Email</div>
                                <div class="bv-info-v"><a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a></div>
                            </div>
                            <div>
                                <div class="bv-info-k"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M2 3a1.5 1.5 0 011.5-1.5H4L5.2 4l-.8.8a5.3 5.3 0 002.3 2.3l.8-.8L9.5 7.2v.8A1.5 1.5 0 018 9.5C4 9.5 1 6.5 1 3z"/></svg>Phone</div>
                                <div class="bv-info-v {{ !$supplierProfile->phone ? 'nil' : '' }}">{{ $supplierProfile->phone ?: '—' }}</div>
                            </div>
                            <div>
                                <div class="bv-info-k"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M6 1C4.3 1 3 2.3 3 4c0 2.6 3 6 3 6s3-3.4 3-6c0-1.7-1.3-3-3-3z"/><circle cx="6" cy="4" r="1"/></svg>City</div>
                                <div class="bv-info-v {{ !$supplierProfile->city ? 'nil' : '' }}">{{ $supplierProfile->city ?: '—' }}</div>
                            </div>
                            <div>
                                <div class="bv-info-k"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M1 6h10M6 1l5 5-5 5-5-5 5-5z"/></svg>Province</div>
                                <div class="bv-info-v {{ !$supplierProfile->province ? 'nil' : '' }}">{{ $supplierProfile->province ?: '—' }}</div>
                            </div>
                            <div class="bv-row-full">
                                <div class="bv-info-k"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M1 3h10M1 6h10M2 9h8M4 1h4"/></svg>Full Address</div>
                                <div class="bv-info-v {{ !$supplierProfile->address ? 'nil' : '' }}">{{ $supplierProfile->address ?: '—' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- About & Service --}}
                <div class="bv-sc">
                    <div class="bv-sc-head">
                        <div class="bv-sc-head-l">
                            <div class="bv-sc-icon">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="4" y="2" width="12" height="16" rx="2"/><path d="M7 7h6M7 10h6M7 13h4"/></svg>
                            </div>
                            <div>
                                <div class="bv-sc-title">About & Service</div>
                                <div class="bv-sc-desc">Bio, service description and experience</div>
                            </div>
                        </div>
                        <a href="{{ route('supplier.edit', $supplierProfile->id) }}" class="bv-btn-edit">
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2l2 2-7 7H3v-2L10 2z"/></svg>
                            Edit
                        </a>
                    </div>
                    <div class="bv-sc-body" style="display:flex;flex-direction:column;gap:1rem;">
                        <div>
                            <div class="bv-info-k" style="margin-bottom:0.4rem;"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="6" cy="6" r="5"/><path d="M6 4v2M6 8v.5"/></svg>Bio</div>
                            <div class="bv-prose {{ !$supplierProfile->bio ? 'nil' : '' }}">{{ $supplierProfile->bio ?: 'No bio added yet. Add a bio to help clients understand who you are.' }}</div>
                        </div>
                        <div>
                            <div class="bv-info-k" style="margin-bottom:0.4rem;"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="1" y="1" width="10" height="10" rx="1.5"/><path d="M3 4.5h6M3 7h4"/></svg>Service Description</div>
                            <div class="bv-prose {{ !$supplierProfile->description ? 'nil' : '' }}">{{ $supplierProfile->description ?: 'No service description yet. Describe your services to attract more bookings.' }}</div>
                        </div>
                        @if($supplierProfile->experience)
                        <div>
                            <div class="bv-info-k" style="margin-bottom:0.4rem;"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="1" y="2" width="10" height="8" rx="1.5"/><path d="M3 5h6M3 7h4"/></svg>Experience Notes</div>
                            <div class="bv-prose">{{ $supplierProfile->experience }}</div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- ── Facebook-style portfolio feed ── --}}
                <div class="pf-card" style="margin-bottom:1.25rem;">
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
                                    $shown    = $imgCount >= 5 ? 4 : $imgCount;
                                    $cls      = $imgCount === 1 ? 'count-1'
                                              : ($imgCount === 2 ? 'count-2'
                                              : ($imgCount === 3 ? 'count-3'
                                              : ($imgCount === 4 ? 'count-4' : 'count-5plus')));
                                    $allUrls  = array_map(fn($i) => asset('storage/'.$i), $imgs);
                                    $allJson  = json_encode($allUrls);
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
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="pf-post-delete-btn">
                                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 3.5h10M5 3.5V2.5h4v1M4.5 3.5v7a1 1 0 001 1h3a1 1 0 001-1v-7"/></svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>

                                    {{-- Description --}}
                                    @if($portfolio->description)
                                    <div class="pf-post-desc">{{ $portfolio->description }}</div>
                                    @endif

                                    {{-- Image mosaic --}}
                                    @if($imgCount > 0)
                                    <div class="pf-mosaic {{ $cls }}"
                                         onclick="fbLbOpen({{ $allJson }}, 0, '{{ addslashes($portfolio->title) }}')">
                                        @for($ci = 0; $ci < $shown; $ci++)
                                        <div class="pf-mos-cell">
                                            <img src="{{ asset('storage/'.$imgs[$ci]) }}" alt="" loading="lazy">
                                            @if($ci === $shown - 1 && $imgCount > $shown)
                                                <div class="pf-mos-more">+{{ $imgCount - $shown }}</div>
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

                                    {{-- Footer tags --}}
                                    <div class="pf-post-foot">
                                        @if($imgCount > 0)
                                            <span class="pf-post-tag">{{ $imgCount }} photo{{ $imgCount !== 1 ? 's' : '' }}</span>
                                        @endif
                                        @if($hasVideo)
                                            <span class="pf-post-tag">Video</span>
                                        @endif
                                    </div>

                                </div>
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

            </div>{{-- end main-stack --}}

        </div>{{-- end layout --}}

        @else
        {{-- Empty state: no profile yet --}}
        <div class="bv-sc">
            <div class="bv-sc-body bv-empty">
                <div class="bv-empty-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-8 8-8s8 4 8 8"/></svg>
                </div>
                <div class="bv-empty-title">No Profile Yet</div>
                <div class="bv-empty-desc">You haven't set up your supplier profile. Create one to start receiving bookings from clients.</div>
                <a href="{{ route('supplier.create') }}" class="bv-btn-primary">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 2v10M2 7h10"/></svg>
                    Create Profile
                </a>
            </div>
        </div>
        @endif

    </div>

    {{-- ═══════════════════════════════════════
         FACEBOOK-STYLE LIGHTBOX (added only)
    ═══════════════════════════════════════ --}}
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
    var fbUrls  = [];
    var fbIdx   = 0;
    var fbTitle = '';

    function fbLbOpen(urls, idx, title) {
        fbUrls  = urls;
        fbIdx   = idx;
        fbTitle = title;

        /* build thumbnail strip */
        var strip = document.getElementById('fbLbStrip');
        strip.innerHTML = '';
        if (urls.length > 1) {
            for (var i = 0; i < urls.length; i++) {
                var th = document.createElement('img');
                th.src       = urls[i];
                th.className = 'fb-lb-thumb' + (i === idx ? ' lb-active' : '');
                th.setAttribute('data-i', i);
                th.onclick   = (function(ii){ return function(){ fbLbGo(ii); }; })(i);
                strip.appendChild(th);
            }
        }

        document.getElementById('fbLb').classList.add('open');
        document.body.style.overflow = 'hidden';
        fbLbGo(idx);
    }

    function fbLbGo(idx) {
        fbIdx = idx;
        var img    = document.getElementById('fbLbImg');
        var vid    = document.getElementById('fbLbVideo');
        var title  = document.getElementById('fbLbTitle');
        var ctr    = document.getElementById('fbLbCounter');
        var prev   = document.getElementById('fbLbPrev');
        var next   = document.getElementById('fbLbNext');
        var thumbs = document.querySelectorAll('.fb-lb-thumb');

        title.textContent = fbTitle;
        ctr.textContent   = fbUrls.length > 1 ? (idx + 1) + ' / ' + fbUrls.length : '';

        img.style.display = 'none';
        vid.style.display = 'none';
        vid.pause();

        var url   = fbUrls[idx];
        var isVid = /\.(mp4|mov|webm|ogg|avi)(\?|$)/i.test(url);
        if (isVid) {
            vid.src           = url;
            vid.style.display = 'block';
        } else {
            img.src           = url;
            img.style.display = 'block';
        }

        /* arrow visibility */
        prev.style.display = idx === 0 ? 'none' : '';
        next.style.display = idx === fbUrls.length - 1 ? 'none' : '';

        /* active thumb */
        thumbs.forEach(function(t, i) {
            t.classList.toggle('lb-active', i === idx);
        });

        /* scroll strip to active thumb */
        if (thumbs[idx]) {
            thumbs[idx].scrollIntoView({ block:'nearest', inline:'center', behavior:'smooth' });
        }
    }

    function fbLbNav(dir) {
        var n = fbIdx + dir;
        if (n >= 0 && n < fbUrls.length) fbLbGo(n);
    }

    function fbLbClose() {
        document.getElementById('fbLb').classList.remove('open');
        document.body.style.overflow = '';
        var vid = document.getElementById('fbLbVideo');
        vid.pause();
        vid.src = '';
    }

    document.addEventListener('keydown', function(e) {
        if (!document.getElementById('fbLb').classList.contains('open')) return;
        if (e.key === 'Escape')     fbLbClose();
        if (e.key === 'ArrowLeft')  fbLbNav(-1);
        if (e.key === 'ArrowRight') fbLbNav(1);
    });
    </script>

</x-supplier-layout>
