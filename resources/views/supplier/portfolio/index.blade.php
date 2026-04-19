<x-supplier-layout>
    <style>
        /* ── Page ── */
        .bv-page-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;}
        .bv-page-title{font-family:var(--font-display);font-size:1.75rem;font-weight:700;color:var(--charcoal);line-height:1.1;}
        .bv-page-title em{font-style:italic;color:var(--gold-dark);}
        .bv-page-sub{font-size:0.8rem;color:var(--warm-grey);margin-top:0.3rem;}

        /* ── Layout ── */
        .pf-layout{display:grid;grid-template-columns:1fr 280px;gap:1.5rem;align-items:start;}
        @media(max-width:900px){.pf-layout{grid-template-columns:1fr;}}

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

        /* ════════════════════════════
        FACEBOOK-STYLE PORTFOLIO GRID
        ════════════════════════════ */
        .pf-portfolio-list{display:flex;flex-direction:column;gap:1.5rem;}

        .pf-post{border-radius:12px;border:1px solid #F0EBE5;overflow:hidden;background:var(--white);box-shadow:0 1px 6px rgba(30,27,24,0.06);transition:box-shadow 0.2s;}
        .pf-post:hover{box-shadow:0 4px 18px rgba(30,27,24,0.1);}

        /* Post header */
        .pf-post-head{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem 0.75rem;}
        .pf-post-head-l{display:flex;align-items:center;gap:0.75rem;}
        .pf-post-avatar{width:42px;height:42px;border-radius:50%;background:linear-gradient(135deg,var(--gold),var(--gold-dark));display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--white);flex-shrink:0;overflow:hidden;}
        .pf-post-avatar img{width:100%;height:100%;object-fit:cover;}
        .pf-post-meta{}
        .pf-post-title{font-family:var(--font-display);font-size:0.95rem;font-weight:700;color:var(--charcoal);line-height:1.2;}
        .pf-post-date{font-size:0.68rem;color:#C0B8B0;margin-top:0.08rem;}
        .pf-post-delete-btn{
            display:inline-flex;align-items:center;gap:0.3rem;
            padding:0.35rem 0.75rem;border-radius:6px;
            border:1.5px solid #FADBD8;background:transparent;
            font-family:var(--font-body);font-size:0.72rem;font-weight:500;
            color:#C0392B;cursor:pointer;transition:background 0.15s,border-color 0.15s;
        }
        .pf-post-delete-btn svg{width:11px;height:11px;}
        .pf-post-delete-btn:hover{background:#FFF5F5;border-color:#C0392B;}

        /* Description */
        .pf-post-desc{padding:0 1.25rem 0.85rem;font-size:0.84rem;color:var(--warm-grey);line-height:1.6;}

        /* ── Facebook-style image mosaic ── */
        .pf-mosaic{overflow:hidden;background:#F5F0EB;cursor:pointer;}

        /* 1 image */
        .pf-mosaic.count-1{aspect-ratio:16/9;}
        .pf-mosaic.count-1 img{width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.3s;}
        .pf-mosaic.count-1:hover img{transform:scale(1.03);}

        /* 2 images */
        .pf-mosaic.count-2{display:grid;grid-template-columns:1fr 1fr;gap:2px;height:300px;}
        .pf-mosaic.count-2 .pf-mos-cell{overflow:hidden;}
        .pf-mosaic.count-2 .pf-mos-cell img{width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.3s;}
        .pf-mosaic.count-2 .pf-mos-cell:hover img{transform:scale(1.04);}

        /* 3 images */
        .pf-mosaic.count-3{display:grid;grid-template-columns:2fr 1fr;grid-template-rows:1fr 1fr;gap:2px;height:320px;}
        .pf-mosaic.count-3 .pf-mos-cell{overflow:hidden;}
        .pf-mosaic.count-3 .pf-mos-cell:first-child{grid-row:1/3;}
        .pf-mosaic.count-3 .pf-mos-cell img{width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.3s;}
        .pf-mosaic.count-3 .pf-mos-cell:hover img{transform:scale(1.04);}

        /* 4 images */
        .pf-mosaic.count-4{display:grid;grid-template-columns:1fr 1fr;grid-template-rows:1fr 1fr;gap:2px;height:340px;}
        .pf-mosaic.count-4 .pf-mos-cell{overflow:hidden;}
        .pf-mosaic.count-4 .pf-mos-cell img{width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.3s;}
        .pf-mosaic.count-4 .pf-mos-cell:hover img{transform:scale(1.04);}

        /* 5+ images */
        .pf-mosaic.count-5plus{display:grid;grid-template-columns:1fr 1fr;grid-template-rows:1fr 1fr;gap:2px;height:340px;}
        .pf-mosaic.count-5plus .pf-mos-cell{overflow:hidden;position:relative;}
        .pf-mosaic.count-5plus .pf-mos-cell:first-child{grid-column:1/3;}
        .pf-mosaic.count-5plus .pf-mos-cell img{width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.3s;}
        .pf-mosaic.count-5plus .pf-mos-cell:hover img{transform:scale(1.04);}
        .pf-mos-more{position:absolute;inset:0;background:rgba(30,27,24,0.55);display:flex;align-items:center;justify-content:center;color:var(--white);font-family:var(--font-display);font-size:1.6rem;font-weight:700;pointer-events:none;}

        /* Video post */
        .pf-post-video{background:#000;position:relative;}
        .pf-post-video video{width:100%;max-height:420px;display:block;object-fit:contain;}

        /* Post footer */
        .pf-post-foot{padding:0.7rem 1.25rem;border-top:1px solid #F7F3EF;display:flex;align-items:center;gap:0.5rem;}
        .pf-post-tag{display:inline-flex;align-items:center;gap:0.25rem;padding:0.18rem 0.6rem;border-radius:999px;background:rgba(201,168,76,0.1);color:var(--gold-dark);font-size:0.65rem;font-weight:600;}
        .pf-post-tag::before{content:'';width:4px;height:4px;border-radius:50%;background:var(--gold);}

        /* Empty state */
        .pf-gallery-empty{text-align:center;padding:3rem 1.5rem;}
        .pf-gallery-empty-icon{width:52px;height:52px;border-radius:50%;background:rgba(201,168,76,0.08);display:flex;align-items:center;justify-content:center;margin:0 auto 0.85rem;color:var(--gold-dark);}
        .pf-gallery-empty-icon svg{width:24px;height:24px;}
        .pf-gallery-empty p{font-size:0.82rem;color:var(--warm-grey);line-height:1.6;}

        /* ── Upload form fields ── */
        .pf-field{margin-bottom:1.15rem;}
        .pf-field:last-child{margin-bottom:0;}
        .pf-label{display:flex;align-items:center;justify-content:space-between;font-size:0.7rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:var(--warm-grey);margin-bottom:0.42rem;}
        .pf-label-opt{font-size:0.62rem;color:#C0B8B0;font-weight:400;letter-spacing:0.02em;text-transform:none;}
        .pf-label-req{font-size:0.62rem;color:#C0392B;font-weight:500;letter-spacing:0.03em;text-transform:none;}
        .pf-input,.pf-textarea{width:100%;padding:0.68rem 0.92rem;background:var(--ivory);border:1.5px solid #E5DDD5;border-radius:8px;font-family:var(--font-body);font-size:0.84rem;color:var(--charcoal);outline:none;transition:border-color 0.2s,box-shadow 0.2s,background 0.2s;}
        .pf-input:focus,.pf-textarea:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,0.12);background:var(--white);}
        .pf-input::placeholder,.pf-textarea::placeholder{color:#C0B8B0;}
        .pf-textarea{resize:vertical;min-height:90px;}
        .pf-err{font-size:0.7rem;color:#C0392B;margin-top:0.32rem;}

        /* ── Drop zone ── */
        #dropZone{
            border:2px dashed #E5DDD5 !important;
            border-radius:10px !important;
            background:var(--ivory) !important;
            padding:2.5rem 1.5rem !important;
            text-align:center !important;
            cursor:pointer !important;
            transition:border-color 0.2s,background 0.2s !important;
            display:flex !important;
            flex-direction:column !important;
            align-items:center !important;
            gap:0.55rem !important;
            margin-bottom:0 !important;
        }
        #dropZone.drag-over,#dropZone:hover{border-color:var(--gold) !important;background:rgba(201,168,76,0.04) !important;}
        .pf-dz-icon{width:48px;height:48px;border-radius:50%;background:rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);margin-bottom:0.2rem;}
        .pf-dz-icon svg{width:21px;height:21px;}
        .pf-dz-title{font-size:0.85rem;font-weight:500;color:var(--warm-grey);}
        .pf-dz-title span{color:var(--gold-dark);font-weight:600;text-decoration:underline;}
        .pf-dz-hint{font-size:0.68rem;color:#C0B8B0;}

        /* ── Preview grid ── */
        #preview{
            display:grid !important;
            grid-template-columns:repeat(auto-fill,minmax(86px,1fr)) !important;
            gap:0.6rem !important;
            margin-top:0.9rem !important;
        }
        #preview > div{position:relative;aspect-ratio:1;border-radius:8px;overflow:hidden;border:1.5px solid #F0EBE5;}
        #preview > div img{width:100%;height:100%;object-fit:cover;display:block;border-radius:0;}
        #preview > div button{
            position:absolute !important;top:3px !important;right:3px !important;
            width:20px !important;height:20px !important;border-radius:50% !important;
            background:rgba(30,27,24,0.72) !important;border:none !important;
            cursor:pointer !important;display:flex !important;align-items:center !important;
            justify-content:center !important;color:var(--white) !important;
            font-size:0 !important;line-height:0 !important;
            transition:background 0.15s !important;
        }
        #preview > div button:hover{background:#C0392B !important;}
        #count{font-size:0.7rem;color:var(--warm-grey);margin-top:0.4rem;}

        /* ── Video zone ── */
        .pf-video-zone{display:flex;align-items:center;gap:0.9rem;padding:0.9rem 1rem;background:rgba(201,168,76,0.04);border-radius:10px;border:1.5px dashed rgba(201,168,76,0.3);cursor:pointer;transition:border-color 0.2s,background 0.2s;}
        .pf-video-zone:hover{border-color:var(--gold);background:rgba(201,168,76,0.07);}
        .pf-video-icon{width:40px;height:40px;border-radius:50%;background:rgba(201,168,76,0.1);flex-shrink:0;display:flex;align-items:center;justify-content:center;color:var(--gold-dark);}
        .pf-video-icon svg{width:17px;height:17px;}
        .pf-video-info{flex:1;}
        .pf-video-info h4{font-family:var(--font-display);font-size:0.82rem;font-weight:700;color:var(--charcoal);margin-bottom:0.1rem;}
        .pf-video-info p{font-size:0.68rem;color:var(--warm-grey);line-height:1.35;}
        .pf-browse-btn{display:inline-flex;align-items:center;gap:0.3rem;padding:0.4rem 0.85rem;border-radius:6px;border:1.5px solid #E5DDD5;background:var(--white);font-family:var(--font-body);font-size:0.74rem;font-weight:500;color:var(--charcoal);cursor:pointer;transition:border-color 0.2s,color 0.2s,background 0.2s;flex-shrink:0;}
        .pf-browse-btn svg{width:10px;height:10px;}
        .pf-browse-btn:hover{border-color:var(--gold);color:var(--gold-dark);background:rgba(201,168,76,0.05);}

        /* Video preview strip */
        .pf-video-preview-wrap{display:none;margin-top:0.85rem;border-radius:9px;overflow:hidden;border:1.5px solid #F0EBE5;background:#000;position:relative;}
        .pf-video-preview-wrap video{width:100%;max-height:180px;object-fit:contain;display:block;}
        .pf-video-preview-rm{position:absolute;top:7px;right:7px;width:26px;height:26px;border-radius:50%;background:rgba(30,27,24,0.75);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--white);transition:background 0.15s;}
        .pf-video-preview-rm:hover{background:#C0392B;}
        .pf-video-preview-rm svg{width:11px;height:11px;}
        .pf-video-name{font-size:0.68rem;color:var(--gold-dark);font-weight:500;margin-top:0.35rem;display:none;}

        /* ── Submit ── */
        .pf-footer{display:flex;align-items:center;justify-content:flex-end;gap:0.65rem;padding:1rem 1.5rem;border-top:1px solid #F7F3EF;}
        .pf-btn-submit{display:inline-flex;align-items:center;gap:0.45rem;padding:0.65rem 1.65rem;border-radius:6px;border:none;background:var(--charcoal);font-family:var(--font-body);font-size:0.84rem;font-weight:500;color:var(--white);cursor:pointer;transition:background 0.2s,box-shadow 0.2s,transform 0.15s;letter-spacing:0.02em;}
        .pf-btn-submit svg{width:14px;height:14px;}
        .pf-btn-submit:hover{background:var(--gold-dark);box-shadow:0 4px 14px rgba(201,168,76,0.22);transform:translateY(-1px);}

        /* ── Sidebar ── */
        .pf-tip-card{background:var(--white);border-radius:12px;border:1px solid #F0EBE5;box-shadow:0 1px 4px rgba(30,27,24,0.05);overflow:hidden;margin-bottom:1.25rem;}
        .pf-tip-card:last-of-type{margin-bottom:0;}
        .pf-tip-header{display:flex;align-items:center;gap:0.55rem;padding:0.9rem 1.2rem;border-bottom:1px solid #F7F3EF;font-size:0.72rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:var(--warm-grey);}
        .pf-tip-header svg{width:14px;height:14px;color:var(--gold-dark);flex-shrink:0;}
        .pf-tip-body{padding:1rem 1.2rem;}
        .pf-tip-item{font-size:0.74rem;color:var(--warm-grey);line-height:1.55;padding:0.42rem 0;border-bottom:1px solid #F7F3EF;display:flex;gap:0.5rem;}
        .pf-tip-item:last-child{border-bottom:none;padding-bottom:0;}
        .pf-tip-item::before{content:'';width:5px;height:5px;border-radius:50%;background:var(--gold);flex-shrink:0;margin-top:0.44rem;}
        .pf-stats{display:flex;flex-direction:column;gap:0.65rem;padding:1rem 1.2rem;}
        .pf-stat{display:flex;align-items:center;justify-content:space-between;}
        .pf-stat-lbl{font-size:0.72rem;color:var(--warm-grey);display:flex;align-items:center;gap:0.35rem;}
        .pf-stat-lbl svg{width:12px;height:12px;color:var(--gold-dark);}
        .pf-stat-val{font-family:var(--font-display);font-size:0.9rem;font-weight:700;color:var(--charcoal);}

        /* ── Alert ── */
        .bv-alert{display:flex;align-items:center;gap:0.6rem;padding:0.7rem 1rem;border-radius:8px;font-size:0.8rem;margin-bottom:1.1rem;}
        .bv-alert svg{width:14px;height:14px;flex-shrink:0;}
        .bv-alert-ok{background:#F0FDF4;border:1px solid #A7F3D0;color:#065F46;}
        .bv-alert-ok svg{color:#10B981;}

        /* ════════════════════
        FACEBOOK LIGHTBOX
        ════════════════════ */
        .fb-lb{position:fixed;inset:0;z-index:1000;background:rgba(0,0,0,0.95);display:none;flex-direction:column;}
        .fb-lb.open{display:flex;}

        /* Top bar */
        .fb-lb-topbar{display:flex;align-items:center;justify-content:space-between;padding:0.75rem 1.25rem;background:rgba(0,0,0,0.7);flex-shrink:0;}
        .fb-lb-title{font-family:var(--font-display);font-size:0.95rem;font-weight:700;color:var(--white);}
        .fb-lb-close{width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.12);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--white);transition:background 0.2s;}
        .fb-lb-close:hover{background:rgba(255,255,255,0.22);}
        .fb-lb-close svg{width:16px;height:16px;}

        /* Main media area */
        .fb-lb-main{flex:1;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;min-height:0;}
        .fb-lb-main img,.fb-lb-main video{max-width:100%;max-height:100%;object-fit:contain;display:block;}
        .fb-lb-main video{width:100%;max-height:100%;}

        /* Arrow navigation */
        .fb-lb-nav{position:absolute;top:50%;transform:translateY(-50%);width:44px;height:44px;border-radius:50%;background:rgba(255,255,255,0.15);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--white);transition:background 0.2s;z-index:2;}
        .fb-lb-nav:hover{background:rgba(255,255,255,0.28);}
        .fb-lb-nav svg{width:18px;height:18px;}
        .fb-lb-nav.prev{left:12px;}
        .fb-lb-nav.next{right:12px;}
        .fb-lb-nav.hidden{display:none;}

        /* Bottom strip (thumbnails) */
        .fb-lb-strip{background:rgba(0,0,0,0.7);padding:0.65rem 1rem;display:flex;align-items:center;justify-content:center;gap:0.4rem;flex-shrink:0;overflow-x:auto;}
        .fb-lb-strip-img{width:52px;height:52px;border-radius:6px;object-fit:cover;cursor:pointer;opacity:0.55;border:2px solid transparent;transition:opacity 0.2s,border-color 0.2s;flex-shrink:0;}
        .fb-lb-strip-img.active{opacity:1;border-color:var(--gold);}
        .fb-lb-strip-img:hover{opacity:0.85;}
        .fb-lb-counter{font-size:0.72rem;color:rgba(255,255,255,0.5);text-align:center;padding:0.3rem 0 0.5rem;flex-shrink:0;}
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Portfolio') }}
        </h2>
    </x-slot>
    <div class="page-content">

        <div class="bv-page-header">
            <div>
                <h1 class="bv-page-title">Portfolio <em>&amp; Gallery</em></h1>
                <p class="bv-page-sub">Manage and showcase your work</p>
            </div>
        </div>

        @if(session('status') === 'portfolio-uploaded')
        <div class="bv-alert bv-alert-ok">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
            Portfolio uploaded successfully.
        </div>
        @endif

        <div class="pf-layout">

            {{-- ════ LEFT COLUMN ════ --}}
            <div>

                

                {{-- ── Upload form (original fields preserved) ── --}}
                <div class="pf-card">
                    <div class="pf-card-header">
                        <div class="pf-card-header-l">
                            <div class="pf-card-icon">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M10 14V4M6 8l4-4 4 4"/><path d="M4 16h12"/></svg>
                            </div>
                            <div>
                                <div class="pf-card-title">Upload New Item</div>
                                <div class="pf-card-desc">Add photos or a video to your portfolio</div>
                            </div>
                        </div>
                    </div>

                    <form method="POST"
                        action="{{ route('supplier.portfolio.store') }}"
                        enctype="multipart/form-data"
                        id="pfUploadForm">
                        @csrf

                        <div class="pf-card-body">

                            {{-- Title --}}
                            <div class="pf-field">
                                <label class="pf-label" for="title">Title <span class="pf-label-req">Required</span></label>
                                <input type="text" id="title" name="title" class="pf-input"
                                    placeholder="Title" value="{{ old('title') }}" required>
                                @error('title')<div class="pf-err">{{ $message }}</div>@enderror
                            </div>

                            {{-- Description --}}
                            <div class="pf-field">
                                <label class="pf-label" for="description">Description <span class="pf-label-opt">Optional</span></label>
                                <textarea id="description" name="description" class="pf-textarea"
                                        placeholder="Description">{{ old('description') }}</textarea>
                                @error('description')<div class="pf-err">{{ $message }}</div>@enderror
                            </div>

                            {{-- DROP ZONE (original id kept) --}}
                            <div class="pf-field">
                                <label class="pf-label">Photos <span class="pf-label-opt">Optional · Max 5 images</span></label>
                                <div id="dropZone">
                                    <div class="pf-dz-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                                    </div>
                                    <p class="pf-dz-title">Drag &amp; Drop Images Here or <span>Click to Upload</span></p>
                                    <p class="pf-dz-hint">JPG, PNG, WEBP · Max 5MB each · Up to 5 images</p>
                                    <input type="file" id="imageInput" name="images[]" multiple hidden>
                                </div>
                                <p id="count"></p>
                                <div id="preview"></div>
                                @error('images')<div class="pf-err">{{ $message }}</div>@enderror
                                @error('images.*')<div class="pf-err">{{ $message }}</div>@enderror
                            </div>

                            {{-- Video --}}
                            <div class="pf-field" style="margin-bottom:0;">
                                <label class="pf-label">Video <span class="pf-label-opt">Optional · MP4, MOV, WEBM</span></label>
                                <div class="pf-video-zone" onclick="document.getElementById('videoInput').click()">
                                    <div class="pf-video-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="5" width="14" height="14" rx="2.5"/><path d="M16 9l6-3v12l-6-3V9z"/></svg>
                                    </div>
                                    <div class="pf-video-info">
                                        <h4>Upload Video</h4>
                                        <p>MP4, MOV or WEBM · One file</p>
                                    </div>
                                    <label class="pf-browse-btn" onclick="event.stopPropagation();" style="cursor:pointer;">
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M8 11V3M5 6l3-3 3 3M3 11v2a1 1 0 001 1h8a1 1 0 001-1v-2"/></svg>
                                        Browse
                                    </label>
                                </div>
                                <input type="file" id="videoInput" name="video" accept="video/*"
                                    style="display:none" onchange="pfVideoSelect(this)">
                                <div class="pf-video-preview-wrap" id="pfVideoPrev">
                                    <video id="pfVideoEl" controls preload="metadata"></video>
                                    <button type="button" class="pf-video-preview-rm" onclick="pfVideoRemove()">
                                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 2l8 8M10 2L2 10"/></svg>
                                    </button>
                                </div>
                                <p id="pfVideoName" class="pf-video-name"></p>
                                @error('video')<div class="pf-err">{{ $message }}</div>@enderror
                            </div>

                        </div>

                        <div class="pf-footer">
                            <button type="submit" class="pf-btn-submit">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg>
                                Upload
                            </button>
                        </div>

                    </form>
                </div>
            </div>{{-- end left --}}
            
            {{-- ════ SIDEBAR ════ --}}
            <div>
                {{--<div class="pf-tip-card">
                    <div class="pf-tip-header">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="1" y="8" width="3" height="7"/><rect x="6" y="4" width="3" height="11"/><rect x="11" y="1" width="3" height="14"/></svg>
                        Gallery Stats
                    </div>
                    <div class="pf-stats">
                        <div class="pf-stat">
                            <span class="pf-stat-lbl"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="1" y="1" width="10" height="10" rx="1.5"/><circle cx="4" cy="4" r="1"/><path d="M1 8.5l3-3 2 2 2-2 4 4"/></svg>Total Items</span>
                            <span class="pf-stat-val">{{ $totalItems }}</span>
                        </div>
                        <div class="pf-stat">
                            <span class="pf-stat-lbl"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="1" y="2.5" width="8" height="7" rx="1.5"/><path d="M9 4.5l3-1.5v5.5L9 7"/></svg>With Video</span>
                            <span class="pf-stat-val">
                                @php $withVideo = isset($portfolios) ? collect($portfolios)->filter(function($p){ return !empty($p->video); })->count() : 0; @endphp
                                {{ $withVideo }}
                            </span>
                        </div>
                    </div>
                </div>--}}

                <div class="pf-tip-card">
                    <div class="pf-tip-header">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M8 2a4 4 0 014 4c0 1.7-.9 3.2-2.2 4L9 14H7l-.8-4A4 4 0 018 2z"/><path d="M6.5 14.5h3"/></svg>
                        Tips
                    </div>
                    <div class="pf-tip-body">
                        <div class="pf-tip-item">Upload high-quality photos for the best client impression.</div>
                        <div class="pf-tip-item">A video highlight increases profile engagement by up to 60%.</div>
                        <div class="pf-tip-item">Describe each item so clients understand what services you provided.</div>
                        <div class="pf-tip-item">5+ photos per item creates a stronger portfolio presence.</div>
                    </div>
                </div>

                <div class="pf-tip-card">
                    <div class="pf-tip-header">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="1" width="12" height="14" rx="2"/><path d="M5 5h6M5 8h6M5 11h4"/></svg>
                        File Requirements
                    </div>
                    <div class="pf-tip-body">
                        <div class="pf-tip-item"><strong style="color:var(--charcoal);">Images:</strong> JPG, PNG, WEBP · Max 5MB · Up to 5 per item</div>
                        <div class="pf-tip-item"><strong style="color:var(--charcoal);">Video:</strong> MP4, MOV, WEBM · Max 100MB · 1 per item</div>
                    </div>
                </div>
            </div>
        
        </div>{{-- end layout --}}
    </div>

    {{-- ════════════════════════════
        FACEBOOK-STYLE LIGHTBOX
    ════════════════════════════ --}}
    <div id="fbLb" class="fb-lb">
        <div class="fb-lb-topbar">
            <span class="fb-lb-title" id="fbLbTitle"></span>
            <button type="button" class="fb-lb-close" onclick="fbLbClose()">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 2l10 10M12 2L2 12"/></svg>
            </button>
        </div>
        <div class="fb-lb-main">
            <button type="button" class="fb-lb-nav prev" id="fbLbPrev" onclick="fbLbNav(-1)">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 2L4 7l5 5"/></svg>
            </button>
            <img id="fbLbImg" src="" alt="" style="display:none;">
            <video id="fbLbVideo" src="" controls style="display:none;max-height:80vh;width:100%;"></video>
            <button type="button" class="fb-lb-nav next" id="fbLbNext" onclick="fbLbNav(1)">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 2l5 5-5 5"/></svg>
            </button>
        </div>
        <div class="fb-lb-counter" id="fbLbCounter"></div>
        <div class="fb-lb-strip" id="fbLbStrip"></div>
    </div>

    <script>
        /* ════════════════════════════════════
        ORIGINAL DROP ZONE SCRIPT (unchanged)
        ════════════════════════════════════ */
        var dropZone    = document.getElementById('dropZone');
        var input       = document.getElementById('imageInput');
        var preview     = document.getElementById('preview');
        var count       = document.getElementById('count');
        var filesArray  = [];
        var MAX_FILES   = 5;

        dropZone.addEventListener('click', function() { input.click(); });

        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropZone.classList.add('drag-over');
        });
        dropZone.addEventListener('dragleave', function() {
            dropZone.classList.remove('drag-over');
        });
        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropZone.classList.remove('drag-over');
            handleFiles(e.dataTransfer.files);
        });

        input.addEventListener('change', function() {
            handleFiles(input.files);
        });

        function handleFiles(files) {
            var newFiles = Array.from ? Array.from(files) : [].slice.call(files);
            if (filesArray.length + newFiles.length > MAX_FILES) {
                alert('Max 5 images only!');
                return;
            }
            filesArray = filesArray.concat(newFiles);
            updatePreview();
        }

        function updatePreview() {
            preview.innerHTML = '';
            filesArray.forEach(function(file, index) {
                var reader = new FileReader();
                reader.onload = (function(i) {
                    return function(e) {
                        var div = document.createElement('div');
                        div.style.position = 'relative';
                        /* ── DESIGN: styled remove button icon instead of raw × ── */
                        div.innerHTML =
                            '<img src="' + e.target.result + '" style="width:100%; border-radius:8px;">' +
                            '<button type="button" onclick="removeImage(' + i + ')" ' +
                            'style="position:absolute;top:3px;right:3px;width:20px;height:20px;' +
                            'border-radius:50%;background:rgba(30,27,24,0.72);border:none;cursor:pointer;' +
                            'display:flex;align-items:center;justify-content:center;color:#fff;' +
                            'font-size:12px;line-height:1;font-weight:700;transition:background 0.15s;" ' +
                            'onmouseenter="this.style.background=\'#C0392B\'" ' +
                            'onmouseleave="this.style.background=\'rgba(30,27,24,0.72)\'">×</button>';
                        preview.appendChild(div);
                    };
                })(index);
                reader.readAsDataURL(file);
            });
            var dt = new DataTransfer();
            filesArray.forEach(function(f) { dt.items.add(f); });
            input.files = dt.files;
            count.innerText = filesArray.length + ' image(s) selected';
        }

        function removeImage(index) {
            filesArray.splice(index, 1);
            updatePreview();
        }

        /* ════════════════════════════
        VIDEO PREVIEW (added)
        ════════════════════════════ */
        function pfVideoSelect(inp) {
            var file = inp.files[0];
            if (!file) return;
            var wrap = document.getElementById('pfVideoPrev');
            var vid  = document.getElementById('pfVideoEl');
            var nm   = document.getElementById('pfVideoName');
            vid.src = URL.createObjectURL(file);
            wrap.style.display = 'block';
            nm.textContent     = file.name;
            nm.style.display   = 'block';
        }
        function pfVideoRemove() {
            var inp  = document.getElementById('videoInput');
            var wrap = document.getElementById('pfVideoPrev');
            var vid  = document.getElementById('pfVideoEl');
            var nm   = document.getElementById('pfVideoName');
            inp.value = '';
            vid.src   = '';
            wrap.style.display = 'none';
            nm.style.display   = 'none';
        }

        /* ════════════════════════════
        FACEBOOK-STYLE LIGHTBOX
        ════════════════════════════ */
        var fbUrls  = [];
        var fbIndex = 0;
        var fbTitle = '';

        function fbLbOpen(urls, idx, title) {
            fbUrls  = urls;
            fbIndex = idx;
            fbTitle = title;
            document.getElementById('fbLb').classList.add('open');
            document.body.style.overflow = 'hidden';

            /* build strip */
            var strip = document.getElementById('fbLbStrip');
            strip.innerHTML = '';
            if (urls.length > 1) {
                fbUrls.forEach(function(u, i) {
                    var img = document.createElement('img');
                    img.src       = u;
                    img.className = 'fb-lb-strip-img' + (i === idx ? ' active' : '');
                    img.onclick   = (function(ii){ return function(){ fbLbGo(ii); }; })(i);
                    strip.appendChild(img);
                });
            }

            fbLbGo(idx);
        }

        function fbLbGo(idx) {
            fbIndex = idx;
            var img    = document.getElementById('fbLbImg');
            var video  = document.getElementById('fbLbVideo');
            var title  = document.getElementById('fbLbTitle');
            var ctr    = document.getElementById('fbLbCounter');
            var prev   = document.getElementById('fbLbPrev');
            var next   = document.getElementById('fbLbNext');
            var strips = document.querySelectorAll('.fb-lb-strip-img');

            title.textContent = fbTitle;
            img.style.display = video.style.display = 'none';
            video.pause();

            var url = fbUrls[idx];
            var isVid = /\.(mp4|mov|webm|ogg)(\?|$)/i.test(url);
            if (isVid) {
                video.src           = url;
                video.style.display = 'block';
            } else {
                img.src           = url;
                img.style.display = 'block';
            }

            ctr.textContent = fbUrls.length > 1 ? (idx + 1) + ' / ' + fbUrls.length : '';
            prev.classList.toggle('hidden', idx === 0);
            next.classList.toggle('hidden', idx === fbUrls.length - 1);

            strips.forEach(function(s, i) { s.classList.toggle('active', i === idx); });
        }

        function fbLbNav(dir) {
            var next = fbIndex + dir;
            if (next >= 0 && next < fbUrls.length) fbLbGo(next);
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