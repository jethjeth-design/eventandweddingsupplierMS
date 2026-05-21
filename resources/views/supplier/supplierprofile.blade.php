<x-supplier-layout>
    <style>
        .bv-page-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;}
        .bv-page-title{font-family:var(--font-display);font-size:1.75rem;font-weight:700;color:var(--charcoal);line-height:1.1;}
        .bv-page-title em{font-style:italic;color:var(--gold-dark);}
        .bv-page-sub{font-size:0.8rem;color:var(--warm-grey);margin-top:0.3rem;}

        .bv-header-actions{display:flex;align-items:center;gap:0.65rem;}
        .bv-btn-primary{display:inline-flex;align-items:center;gap:0.45rem;padding:0.6rem 1.3rem;border-radius:6px;border:none;background:var(--charcoal);font-family:var(--font-body);font-size:0.8rem;font-weight:500;color:var(--white);text-decoration:none;transition:background 0.2s,box-shadow 0.2s,transform 0.15s;}
        .bv-btn-primary svg{width:13px;height:13px;}
        .bv-btn-primary:hover{background:var(--gold-dark);box-shadow:0 4px 12px rgba(201,168,76,0.2);transform:translateY(-1px);}
        .bv-btn-secondary{display:inline-flex;align-items:center;gap:0.45rem;padding:0.6rem 1.2rem;border-radius:6px;border:1.5px solid #E5DDD5;background:var(--white);font-family:var(--font-body);font-size:0.8rem;font-weight:500;color:var(--warm-grey);text-decoration:none;transition:border-color 0.2s,color 0.2s,background 0.2s;}
        .bv-btn-secondary svg{width:13px;height:13px;}
        .bv-btn-secondary:hover{border-color:var(--gold);color:var(--gold-dark);background:rgba(201,168,76,0.05);}

        /* ══ OUTER LAYOUT ══ */
        .bv-outer-layout{display:grid;grid-template-columns:220px 1fr;gap:1.5rem;align-items:start;}
        @media(max-width:860px){.bv-outer-layout{grid-template-columns:1fr;}}

        /* ══ LEFT TAB SIDEBAR ══ */
        .bv-profile-sidebar{background:var(--white);border-radius:12px;border:1px solid #F0EBE5;box-shadow:0 1px 4px rgba(30,27,24,0.05);overflow:hidden;position:sticky;top:1.5rem;}
        @media(max-width:860px){
            .bv-profile-sidebar{position:static;display:flex;flex-direction:row;overflow-x:auto;border-radius:10px;padding:0.25rem 0.5rem;gap:0;-webkit-overflow-scrolling:touch;scrollbar-width:none;}
            .bv-profile-sidebar::-webkit-scrollbar{display:none;}
            .bv-sidebar-label{display:none;}
            .bv-sidebar-divider{display:none;}
        }
        .bv-sidebar-label{font-size:0.6rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#C0B8B0;padding:1rem 1.1rem 0.5rem;}
        .bv-tab{display:flex;align-items:center;gap:0.65rem;width:100%;padding:0.75rem 1.1rem;border:none;background:transparent;font-family:var(--font-body);font-size:0.82rem;font-weight:500;color:var(--warm-grey);cursor:pointer;text-align:left;transition:background 0.15s,color 0.15s;border-left:3px solid transparent;white-space:nowrap;}
        .bv-tab svg{width:16px;height:16px;flex-shrink:0;opacity:0.6;transition:opacity 0.15s;}
        .bv-tab:hover{background:rgba(201,168,76,0.05);color:var(--charcoal);}
        .bv-tab:hover svg{opacity:0.85;}
        .bv-tab.active{background:rgba(201,168,76,0.08);color:var(--gold-dark);border-left-color:var(--gold);font-weight:600;}
        .bv-tab.active svg{opacity:1;color:var(--gold-dark);}
        @media(max-width:860px){
            .bv-tab{width:auto;flex-shrink:0;border-left:none;border-bottom:3px solid transparent;border-radius:8px 8px 0 0;padding:0.65rem 1rem;font-size:0.78rem;}
            .bv-tab.active{border-left:none;border-bottom-color:var(--gold);background:rgba(201,168,76,0.08);}
        }
        .bv-sidebar-divider{height:1px;background:#F7F3EF;margin:0.4rem 0;}

        /* ══ TAB PANELS ══ */
        .bv-tab-panel{display:none;}
        .bv-tab-panel.active{display:flex;flex-direction:column;gap:1.25rem;}

        /* ══ IDENTITY CARD ══ */
        .bv-id-card{background:var(--white);border-radius:14px;border:1px solid #F0EBE5;overflow:hidden;box-shadow:0 2px 8px rgba(30,27,24,0.06);}
        .bv-id-card-banner{height:200px;background:linear-gradient(135deg,var(--charcoal) 0%,#2a2016 60%,#3d2f14 100%);position:relative;overflow:hidden;}
        .bv-id-card-banner-img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block;}
        .bv-id-card-banner-overlay{position:absolute;inset:0;background:rgba(30,27,24,0.18);pointer-events:none;}
        .bv-cover-btn{position:absolute;bottom:10px;right:12px;display:inline-flex;align-items:center;gap:0.4rem;padding:0.4rem 0.85rem;border-radius:8px;background:rgba(30,27,24,0.62);backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px);border:1.5px solid rgba(255,255,255,0.22);font-family:var(--font-body);font-size:0.72rem;font-weight:500;color:rgba(255,255,255,0.9);cursor:pointer;transition:background 0.2s,border-color 0.2s,transform 0.15s;z-index:3;}
        .bv-cover-btn svg{width:13px;height:13px;flex-shrink:0;}
        .bv-cover-btn:hover{background:rgba(201,168,76,0.75);border-color:rgba(201,168,76,0.5);transform:translateY(-1px);}
        .bv-id-card-inner{display:flex;align-items:flex-start;gap:1.75rem;padding:0 2rem 1.75rem;flex-wrap:wrap;}
        .bv-id-avatar-wrap{position:relative;width:120px;height:120px;margin-top:-60px;flex-shrink:0;z-index:2;}
        .bv-id-avatar{width:120px;height:120px;border-radius:50%;background:linear-gradient(135deg,var(--gold) 0%,var(--gold-dark) 100%);display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:2.6rem;font-weight:700;color:var(--white);overflow:hidden;border:5px solid var(--white);box-shadow:0 4px 18px rgba(30,27,24,0.2);}
        .bv-id-avatar img{width:100%;height:100%;object-fit:cover;display:none;}
        .bv-id-avatar.has-photo img{display:block;}
        .bv-id-avatar.has-photo span{display:none;}
        .bv-id-main{flex:1;min-width:200px;padding-top:1rem;}
        .bv-id-name{font-family:var(--font-display);font-size:1.45rem;font-weight:700;color:var(--charcoal);margin-bottom:0.2rem;line-height:1.2;}
        .bv-id-category{font-size:0.72rem;color:var(--gold-dark);letter-spacing:0.05em;font-weight:600;text-transform:uppercase;margin-bottom:0.65rem;display:flex;flex-wrap:wrap;gap:0.4rem;}
        .bv-id-badge{display:inline-flex;align-items:center;gap:0.35rem;padding:0.22rem 0.75rem;border-radius:999px;background:rgba(201,168,76,0.1);color:var(--gold-dark);font-size:0.65rem;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;margin-bottom:0.9rem;}
        .bv-id-badge::before{content:'';width:5px;height:5px;border-radius:50%;background:var(--gold);}
        .bv-id-meta{display:flex;flex-wrap:wrap;gap:0.55rem 1.5rem;margin-bottom:0.85rem;}
        .bv-id-meta-row{display:flex;align-items:center;gap:0.45rem;}
        .bv-id-meta-icon{width:13px;height:13px;color:var(--gold-dark);flex-shrink:0;}
        .bv-id-meta-text{font-size:0.78rem;color:var(--warm-grey);line-height:1.4;}
        .bv-id-meta-text strong{display:inline;font-size:0.67rem;text-transform:uppercase;letter-spacing:0.06em;color:#C0B8B0;font-weight:600;margin-right:0.25rem;}
        .bv-id-tagline{font-size:0.78rem;color:var(--warm-grey);font-style:italic;line-height:1.6;padding:0.65rem 0.9rem;background:rgba(201,168,76,0.05);border-radius:8px;border-left:2px solid rgba(201,168,76,0.3);margin-top:0.5rem;}
        .bv-id-links{display:flex;gap:0.5rem;flex-wrap:wrap;margin-top:1rem;}
        .bv-id-link{display:inline-flex;align-items:center;gap:0.45rem;padding:0.45rem 0.85rem;border-radius:8px;font-family:var(--font-body);font-size:0.76rem;font-weight:500;color:var(--warm-grey);text-decoration:none;border:1.5px solid #E5DDD5;background:var(--white);transition:border-color 0.15s,color 0.15s,background 0.15s;}
        .bv-id-link svg{width:12px;height:12px;flex-shrink:0;}
        .bv-id-link:hover{background:rgba(201,168,76,0.07);color:var(--gold-dark);border-color:var(--gold);}
        .bv-id-right{display:flex;flex-direction:column;gap:0.6rem;padding-top:1.25rem;min-width:180px;align-self:flex-start;}
        .bv-completion-label{display:flex;justify-content:space-between;font-size:0.68rem;color:var(--warm-grey);margin-bottom:0.45rem;}
        .bv-completion-label strong{color:var(--gold-dark);}
        .bv-completion-bar{height:5px;background:#F0EBE5;border-radius:3px;overflow:hidden;}
        .bv-completion-fill{height:100%;background:linear-gradient(90deg,var(--gold),#e6c84a);border-radius:3px;transition:width 0.6s ease;}

        /* ── Section cards ── */
        .bv-sc{background:var(--white);border-radius:12px;border:1px solid #F0EBE5;overflow:hidden;box-shadow:0 1px 4px rgba(30,27,24,0.04);}
        .bv-sc-head{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.4rem;border-bottom:1px solid #F7F3EF;}
        .bv-sc-head-l{display:flex;align-items:center;gap:0.65rem;}
        .bv-sc-icon{width:32px;height:32px;border-radius:8px;background:rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
        .bv-sc-icon svg{width:15px;height:15px;}
        .bv-sc-title{font-family:var(--font-display);font-size:0.9rem;font-weight:700;color:var(--charcoal);}
        .bv-sc-desc{font-size:0.7rem;color:var(--warm-grey);margin-top:0.06rem;}
        .bv-sc-body{padding:1.35rem 1.4rem;}
        .bv-row-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:0.85rem 1.25rem;}
        .bv-row-full{grid-column:1/-1;}
        @media(max-width:560px){.bv-row-grid{grid-template-columns:1fr;}.bv-row-full{grid-column:1/-1;}}
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
        .bv-btn-edit{display:inline-flex;align-items:center;gap:0.4rem;padding:0.4rem 0.85rem;border-radius:6px;border:1.5px solid #E5DDD5;background:var(--white);font-family:var(--font-body);font-size:0.74rem;font-weight:500;color:var(--warm-grey);text-decoration:none;transition:border-color 0.2s,color 0.2s,background 0.2s;}
        .bv-btn-edit svg{width:11px;height:11px;}
        .bv-btn-edit:hover{border-color:var(--gold);color:var(--gold-dark);background:rgba(201,168,76,0.05);}
        .bv-alert{display:flex;align-items:center;gap:0.6rem;padding:0.7rem 1rem;border-radius:8px;font-size:0.8rem;margin-bottom:1.1rem;}
        .bv-alert svg{width:14px;height:14px;flex-shrink:0;}
        .bv-alert-ok{background:#F0FDF4;border:1px solid #A7F3D0;color:#065F46;}
        .bv-alert-ok svg{color:#10B981;}
        .bv-alert-success{display:flex;align-items:center;gap:0.65rem;background:#F0FDF4;border:1px solid #A7F3D0;border-radius:8px;padding:0.75rem 1rem;font-size:0.82rem;color:#065F46;margin-bottom:1.5rem;}
        .bv-alert-success svg{width:16px;height:16px;color:#10B981;flex-shrink:0;}
        .bv-empty{text-align:center;padding:4rem 2rem;}
        .bv-empty-icon{width:56px;height:56px;border-radius:50%;background:rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;color:var(--gold-dark);}
        .bv-empty-icon svg{width:26px;height:26px;}
        .bv-empty-title{font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--charcoal);margin-bottom:0.4rem;}
        .bv-empty-desc{font-size:0.82rem;color:var(--warm-grey);margin-bottom:1.25rem;line-height:1.6;}

        /* ══ PRICING ══ */
        .pr-price-hero{display:flex;align-items:center;gap:1.5rem;flex-wrap:wrap;padding:1.5rem;background:linear-gradient(135deg,rgba(201,168,76,0.06) 0%,rgba(201,168,76,0.02) 100%);border-radius:10px;border:1px solid rgba(201,168,76,0.18);margin-bottom:1.1rem;}
        .pr-price-icon{width:52px;height:52px;border-radius:12px;flex-shrink:0;background:rgba(201,168,76,0.12);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);}
        .pr-price-icon svg{width:24px;height:24px;}
        .pr-price-label{font-size:0.62rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#C0B8B0;margin-bottom:0.3rem;}
        .pr-price-display{display:flex;align-items:baseline;gap:0.3rem;}
        .pr-currency{font-size:1.05rem;font-weight:700;color:var(--gold-dark);font-family:var(--font-display);}
        .pr-amount{font-size:1.8rem;font-weight:700;color:var(--charcoal);font-family:var(--font-display);line-height:1;}
        .pr-price-note{font-size:0.72rem;color:var(--warm-grey);margin-top:0.25rem;}
        .pr-nil{display:flex;align-items:center;gap:0.5rem;padding:1rem 1.1rem;background:#F9F7F4;border-radius:8px;border:1px dashed #E5DDD5;}
        .pr-nil svg{width:16px;height:16px;color:#C0B8B0;flex-shrink:0;}
        .pr-nil span{font-size:0.8rem;color:#C0B8B0;font-style:italic;}

        /* ══ COVER PHOTO MODAL ══ */
        .cp-modal-overlay{position:fixed;inset:0;z-index:8100;background:rgba(30,27,24,0.6);display:none;align-items:center;justify-content:center;padding:1rem;}
        .cp-modal-overlay.open{display:flex;}
        .cp-modal{background:var(--white);border-radius:14px;border:1px solid #F0EBE5;box-shadow:0 8px 40px rgba(30,27,24,0.2);width:100%;max-width:480px;overflow:hidden;animation:cpSlideIn 0.22s ease;}
        @keyframes cpSlideIn{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
        .cp-modal-head{display:flex;align-items:center;justify-content:space-between;padding:1.1rem 1.4rem;border-bottom:1px solid #F7F3EF;}
        .cp-modal-head-l{display:flex;align-items:center;gap:0.65rem;}
        .cp-modal-icon{width:32px;height:32px;border-radius:8px;background:rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
        .cp-modal-icon svg{width:15px;height:15px;}
        .cp-modal-title{font-family:var(--font-display);font-size:0.95rem;font-weight:700;color:var(--charcoal);}
        .cp-modal-close{width:30px;height:30px;border-radius:50%;border:1.5px solid #E5DDD5;background:var(--white);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--warm-grey);transition:border-color 0.15s,color 0.15s,background 0.15s;}
        .cp-modal-close:hover{border-color:var(--gold);color:var(--gold-dark);background:rgba(201,168,76,0.05);}
        .cp-modal-close svg{width:12px;height:12px;}
        .cp-modal-body{padding:1.35rem 1.4rem;display:flex;flex-direction:column;gap:1rem;}
        .cp-modal-foot{padding:0.85rem 1.4rem;border-top:1px solid #F7F3EF;display:flex;align-items:center;justify-content:flex-end;gap:0.55rem;}
        .cp-dropzone{border:2px dashed #E5DDD5;border-radius:10px;padding:2rem 1.5rem;text-align:center;cursor:pointer;transition:border-color 0.2s,background 0.2s;background:rgba(201,168,76,0.02);position:relative;}
        .cp-dropzone:hover,.cp-dropzone.drag-over{border-color:var(--gold);background:rgba(201,168,76,0.06);}
        .cp-dropzone input[type="file"]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;}
        .cp-dropzone-icon{width:44px;height:44px;border-radius:50%;background:rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 0.75rem;color:var(--gold-dark);}
        .cp-dropzone-icon svg{width:20px;height:20px;}
        .cp-dropzone-label{font-size:0.82rem;font-weight:600;color:var(--charcoal);margin-bottom:0.25rem;}
        .cp-dropzone-sub{font-size:0.72rem;color:#C0B8B0;line-height:1.5;}
        .cp-preview-wrap{display:none;border-radius:10px;overflow:hidden;border:1.5px solid #F0EBE5;position:relative;}
        .cp-preview-wrap.visible{display:block;}
        .cp-preview-wrap img{width:100%;height:160px;object-fit:cover;display:block;}
        .cp-preview-remove{position:absolute;top:8px;right:8px;width:28px;height:28px;border-radius:50%;background:rgba(30,27,24,0.65);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--white);transition:background 0.2s;}
        .cp-preview-remove:hover{background:rgba(192,57,43,0.8);}
        .cp-preview-remove svg{width:12px;height:12px;}
        .cp-remove-row{display:flex;align-items:center;justify-content:space-between;padding:0.65rem 0.9rem;background:#FFF5F5;border:1px solid #FADBD8;border-radius:8px;}
        .cp-remove-row span{font-size:0.78rem;color:#C0392B;}
        .cp-remove-btn{display:inline-flex;align-items:center;gap:0.3rem;padding:0.3rem 0.75rem;border-radius:6px;border:1.5px solid #FADBD8;background:transparent;font-family:var(--font-body);font-size:0.72rem;font-weight:500;color:#C0392B;cursor:pointer;transition:background 0.15s,border-color 0.15s;}
        .cp-remove-btn svg{width:11px;height:11px;}
        .cp-remove-btn:hover{background:#FFF5F5;border-color:#C0392B;}
        .cp-btn-save{display:inline-flex;align-items:center;gap:0.45rem;padding:0.62rem 1.5rem;border-radius:6px;border:none;background:var(--charcoal);font-family:var(--font-body);font-size:0.82rem;font-weight:500;color:var(--white);cursor:pointer;transition:background 0.2s,box-shadow 0.2s,transform 0.15s;}
        .cp-btn-save svg{width:13px;height:13px;}
        .cp-btn-save:hover{background:var(--gold-dark);box-shadow:0 4px 12px rgba(201,168,76,0.2);transform:translateY(-1px);}
        .cp-btn-save:disabled{opacity:0.45;cursor:not-allowed;transform:none;}
        .cp-btn-cancel{display:inline-flex;align-items:center;gap:0.4rem;padding:0.62rem 1.1rem;border-radius:6px;border:1.5px solid #E5DDD5;background:var(--white);font-family:var(--font-body);font-size:0.82rem;font-weight:500;color:var(--warm-grey);cursor:pointer;transition:border-color 0.2s,color 0.2s;}
        .cp-btn-cancel:hover{border-color:var(--gold);color:var(--charcoal);}

        /* ══ LIGHTBOX ══ */
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
        .fb-lb-strip{display:flex;align-items:center;justify-content:center;gap:0.35rem;padding:0.55rem 1rem;overflow-x:auto;}
        .fb-lb-strip::-webkit-scrollbar{height:3px;}
        .fb-lb-strip::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.2);border-radius:2px;}
        .fb-lb-thumb{width:50px;height:50px;object-fit:cover;border-radius:5px;cursor:pointer;opacity:0.5;border:2px solid transparent;transition:opacity 0.2s,border-color 0.2s;flex-shrink:0;}
        .fb-lb-thumb.lb-active{opacity:1;border-color:var(--gold);}
        .fb-lb-thumb:hover{opacity:0.85;}

        /* ══ RESPONSIVE ══ */
        @media(max-width:680px){
            .bv-id-card-inner{flex-direction:column;gap:1rem;padding:0 1.25rem 1.25rem;}
            .bv-id-right{min-width:unset;width:100%;padding-top:0;}
            .bv-header-actions{flex-wrap:wrap;}
            .bv-page-title{font-size:1.4rem;}
            .bv-sc-head{flex-wrap:wrap;gap:0.5rem;}
        }
        @media(max-width:480px){
            .bv-header-actions .bv-btn-secondary span,
            .bv-header-actions .bv-btn-primary span{display:none;}
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile Information') }}
        </h2>
    </x-slot>

    @if(session('success'))
    <div class="bv-alert-success">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="page-content">

        {{-- PAGE HEADER --}}
        <div class="bv-page-header">
            <div>
                <h1 class="bv-page-title">Personal <em>Information</em></h1>
                <p class="bv-page-sub">Your supplier profile details</p>
            </div>
            @if($supplierProfile)
            <div class="bv-header-actions">
                <a href="{{ route('supplier.portfolio.index') }}" class="bv-btn-secondary">Add Portfolio</a>
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

        @php
            $filled = collect([
                $supplierProfile->first_name,
                $supplierProfile->last_name,
                $supplierProfile->phone,
                $supplierProfile->city,
                $supplierProfile->categories->isNotEmpty() ? true : null,
                $supplierProfile->bio,
                $supplierProfile->description,
                $supplierProfile->photo,
                $supplierProfile->starting_price,
            ])->filter()->count();
            $pct = round(($filled / 9) * 100);
            $startingPrice = $supplierProfile->starting_price ?? null;
        @endphp

        <div class="bv-outer-layout">

            {{-- ══ LEFT: TAB SIDEBAR (2 tabs only) ══ --}}
            <div class="bv-profile-sidebar">
                <div class="bv-sidebar-label">Navigation</div>

                <button class="bv-tab active" onclick="switchTab('info', this)">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="7" r="4"/><path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    Profile Info
                </button>

                <div class="bv-sidebar-divider"></div>

                <button class="bv-tab" onclick="switchTab('pricing', this)">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="10" r="7"/>
                        <path d="M10 6v8M7.5 8.5h4a1.5 1.5 0 010 3h-3a1.5 1.5 0 000 3H13"/>
                    </svg>
                    Pricing
                </button>
            </div>

            {{-- ══ RIGHT: CONTENT PANELS ══ --}}
            <div>

                {{-- ── PANEL: Profile Info ── --}}
                <div id="panel-info" class="bv-tab-panel active">

                    {{-- Identity Hero Card --}}
                    <div class="bv-id-card">
                        <div class="bv-id-card-banner">
                            @if(!empty($supplierProfile->cover_photo))
                                <img class="bv-id-card-banner-img"
                                     src="{{ asset('storage/' . $supplierProfile->cover_photo) }}"
                                     alt="Cover photo">
                                <div class="bv-id-card-banner-overlay"></div>
                            @endif
                            <button type="button" class="bv-cover-btn" onclick="cpModalOpen()">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M1 5a2 2 0 012-2h1.5l1-1.5h5L11.5 3H13a2 2 0 012 2v7a2 2 0 01-2 2H3a2 2 0 01-2-2V5z"/>
                                    <circle cx="8" cy="8.5" r="2.5"/>
                                </svg>
                                {{ empty($supplierProfile->cover_photo) ? 'Add Cover Photo' : 'Change Cover' }}
                            </button>
                        </div>

                        <div class="bv-id-card-inner">
                            <div class="bv-id-avatar-wrap">
                                <div class="bv-id-avatar {{ $supplierProfile->photo ? 'has-photo' : '' }}">
                                    @if($supplierProfile->photo)
                                        <img src="{{ asset('storage/'.$supplierProfile->photo) }}" alt="">
                                    @else
                                        <span>{{ strtoupper(substr($supplierProfile->first_name ?? Auth::user()->name, 0, 2)) }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="bv-id-main">
                                <div class="bv-id-name">
                                    {{ $supplierProfile->business_name ?: trim(($supplierProfile->first_name ?? '').' '.($supplierProfile->last_name ?? '')) ?: Auth::user()->name }}
                                </div>
                                <div class="bv-id-category">
                                    @forelse($supplierProfile->categories as $cat)
                                        <span class="bv-tag">{{ $cat->name }}</span>
                                    @empty
                                        <span style="color:#C0B8B0;font-style:italic;">No Category Set</span>
                                    @endforelse
                                </div>
                                <div class="bv-id-badge">Active Supplier</div>

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
                                    @if($startingPrice)
                                    <div class="bv-id-meta-row">
                                        <svg class="bv-id-meta-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="8" cy="8" r="6"/><path d="M8 5v6M6 7h3a1 1 0 010 2H7a1 1 0 000 2h3"/></svg>
                                        <div class="bv-id-meta-text"><strong>Starting Price</strong>₱{{ number_format($startingPrice) }}</div>
                                    </div>
                                    @endif
                                </div>

                                @if($supplierProfile->tagline)
                                <div class="bv-id-tagline">"{{ $supplierProfile->tagline }}"</div>
                                @endif

                                <div class="bv-id-links">
                                    <a href="{{ route('supplier.edit', $supplierProfile->id) }}" class="bv-id-link">
                                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2l2 2-7 7H3v-2L10 2z"/></svg>
                                        Edit Profile
                                    </a>
                                    <a href="{{ route('supplier.profile') }}" class="bv-id-link">
                                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="2"/><path d="M7 1v1.2M7 11.8V13M1 7h1.2M11.8 7H13M2.8 2.8l.85.85M10.35 10.35l.85.85M10.35 3.65l-.85.85M3.65 10.35l-.85.85"/></svg>
                                        Account Settings
                                    </a>
                                    <a href="{{ route('supplier.portfolio.index', $supplierProfile->id) }}" class="bv-id-link">
                                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="3" width="12" height="9" rx="1.5"/><circle cx="5" cy="6.5" r="1"/><path d="M1 10l3-3 2.5 2.5 2-2 3.5 3.5"/></svg>
                                        Portfolio
                                    </a>
                                </div>
                            </div>

                            <div class="bv-id-right">
                                <div>
                                    <div class="bv-completion-label">
                                        <span>Profile completion</span>
                                        <strong>{{ $pct }}%</strong>
                                    </div>
                                    <div class="bv-completion-bar">
                                        <div class="bv-completion-fill" style="width:{{ $pct }}%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
                            <a href="{{ route('supplier.editidentity', $supplierProfile->id) }}" class="bv-btn-edit">
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2l2 2-7 7H3v-2L10 2z"/></svg>Edit
                            </a>
                        </div>
                        <div class="bv-sc-body">
                            <div class="bv-row-grid">
                                <div>
                                    <div class="bv-info-k">First Name</div>
                                    <div class="bv-info-v {{ !$supplierProfile->first_name ? 'nil' : '' }}">{{ $supplierProfile->first_name ?: '—' }}</div>
                                </div>
                                <div>
                                    <div class="bv-info-k">Last Name</div>
                                    <div class="bv-info-v {{ !$supplierProfile->last_name ? 'nil' : '' }}">{{ $supplierProfile->last_name ?: '—' }}</div>
                                </div>
                                <div>
                                    <div class="bv-info-k">Business Name</div>
                                    <div class="bv-info-v {{ !$supplierProfile->business_name ? 'nil' : '' }}">{{ $supplierProfile->business_name ?: 'Using full name' }}</div>
                                </div>
                                <div>
                                    <div class="bv-info-k">Category</div>
                                    <div class="bv-info-v">
                                        @foreach($supplierProfile->categories as $cat)
                                            <span class="bv-tag">{{ $cat->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="bv-row-full">
                                    <div class="bv-info-k">Tagline</div>
                                    <div class="bv-info-v {{ !$supplierProfile->tagline ? 'nil' : '' }}">{{ $supplierProfile->tagline ?: '—' }}</div>
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
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2l2 2-7 7H3v-2L10 2z"/></svg>Edit
                            </a>
                        </div>
                        <div class="bv-sc-body">
                            <div class="bv-row-grid">
                                <div>
                                    <div class="bv-info-k">Email</div>
                                    <div class="bv-info-v"><a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a></div>
                                </div>
                                <div>
                                    <div class="bv-info-k">Phone</div>
                                    <div class="bv-info-v {{ !$supplierProfile->phone ? 'nil' : '' }}">{{ $supplierProfile->phone ?: '—' }}</div>
                                </div>
                                <div>
                                    <div class="bv-info-k">City</div>
                                    <div class="bv-info-v {{ !$supplierProfile->city ? 'nil' : '' }}">{{ $supplierProfile->city ?: '—' }}</div>
                                </div>
                                <div>
                                    <div class="bv-info-k">Province</div>
                                    <div class="bv-info-v {{ !$supplierProfile->province ? 'nil' : '' }}">{{ $supplierProfile->province ?: '—' }}</div>
                                </div>
                                <div class="bv-row-full">
                                    <div class="bv-info-k">Full Address</div>
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
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2l2 2-7 7H3v-2L10 2z"/></svg>Edit
                            </a>
                        </div>
                        <div class="bv-sc-body" style="display:flex;flex-direction:column;gap:1rem;">
                            <div>
                                <div class="bv-info-k" style="margin-bottom:0.4rem;">Bio</div>
                                <div class="bv-prose {{ !$supplierProfile->bio ? 'nil' : '' }}">{{ $supplierProfile->bio ?: 'No bio added yet. Add a bio to help clients understand who you are.' }}</div>
                            </div>
                            <div>
                                <div class="bv-info-k" style="margin-bottom:0.4rem;">Service Description</div>
                                <div class="bv-prose {{ !$supplierProfile->description ? 'nil' : '' }}">{{ $supplierProfile->description ?: 'No service description yet. Describe your services to attract more bookings.' }}</div>
                            </div>
                        </div>
                    </div>

                </div>{{-- /panel-info --}}


                {{-- ── PANEL: Pricing ── --}}
                <div id="panel-pricing" class="bv-tab-panel">

                    <div class="bv-sc">
                        <div class="bv-sc-head">
                            <div class="bv-sc-head-l">
                                <div class="bv-sc-icon">
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <circle cx="10" cy="10" r="7"/>
                                        <path d="M10 6v8M7.5 8.5h4a1.5 1.5 0 010 3h-3a1.5 1.5 0 000 3H13"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="bv-sc-title">Pricing</div>
                                    <div class="bv-sc-desc">Your starting price visible to clients</div>
                                </div>
                            </div>
                            <a href="{{ route('supplier.editPricing', $supplierProfile->id) }}" class="bv-btn-edit">
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2l2 2-7 7H3v-2L10 2z"/></svg>Edit
                            </a>
                        </div>
                        <div class="bv-sc-body">
                            @if($startingPrice)
                            <div class="pr-price-hero">
                                <div class="pr-price-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="12" cy="12" r="9"/>
                                        <path d="M12 7v10M9.5 10h4a2 2 0 010 4h-3a2 2 0 000 4H14"/>
                                    </svg>
                                </div>
                                <div class="pr-price-body">
                                    <div class="pr-price-label">Starting Price</div>
                                    <div class="pr-price-display">
                                        <span class="pr-currency">₱</span>
                                        <span class="pr-amount">{{ number_format($startingPrice) }}</span>
                                    </div>
                                    <div class="pr-price-note">Clients will see this as your base rate</div>
                                </div>
                            </div>
                            @else
                            <div class="pr-nil">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <circle cx="10" cy="10" r="7"/>
                                    <path d="M10 6v8M7.5 8.5h4a1.5 1.5 0 010 3h-3a1.5 1.5 0 000 3H13"/>
                                </svg>
                                <span>No starting price set yet. Click <strong>Edit</strong> to add your pricing.</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Tip card --}}
                    <div class="bv-sc" style="border-color:rgba(201,168,76,0.25);background:rgba(201,168,76,0.03);">
                        <div class="bv-sc-body" style="display:flex;gap:1rem;align-items:flex-start;padding:1.1rem 1.4rem;">
                            <div style="width:34px;height:34px;border-radius:8px;background:rgba(201,168,76,0.12);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="10" r="7"/><path d="M10 9v5M10 7v.5"/></svg>
                            </div>
                            <div>
                                <div style="font-size:0.8rem;font-weight:700;color:var(--charcoal);margin-bottom:0.25rem;font-family:var(--font-display);">Pricing Tip</div>
                                <div style="font-size:0.76rem;color:var(--warm-grey);line-height:1.65;">
                                    Setting a starting price helps clients understand your value before reaching out. It sets clear expectations and attracts more qualified inquiries.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>{{-- /panel-pricing --}}

            </div>{{-- /right content --}}
        </div>{{-- /bv-outer-layout --}}

        @else
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

    </div>{{-- /page-content --}}

    {{-- ══ COVER PHOTO MODAL ══ --}}
    <div class="cp-modal-overlay" id="cpModalOverlay" onclick="if(event.target===this)cpModalClose()">
        <div class="cp-modal">
            <div class="cp-modal-head">
                <div class="cp-modal-head-l">
                    <div class="cp-modal-icon">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M1 5a2 2 0 012-2h1.5l1-1.5h5L11.5 3H13a2 2 0 012 2v7a2 2 0 01-2 2H3a2 2 0 01-2-2V5z"/>
                            <circle cx="8" cy="8.5" r="2.5"/>
                        </svg>
                    </div>
                    <div class="cp-modal-title">Cover Photo</div>
                </div>
                <button type="button" class="cp-modal-close" onclick="cpModalClose()">
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
                </button>
            </div>

            <form id="cpUploadForm" action="{{ route('supplier.cover.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="cp-modal-body">
                    <div class="cp-dropzone" id="cpDropzone">
                        <input type="file" id="cpFileInput" name="cover_photo"
                               accept="image/jpeg,image/png,image/webp,image/gif"
                               onchange="cpHandleFile(this)">
                        <div class="cp-dropzone-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" y1="3" x2="12" y2="15"/>
                            </svg>
                        </div>
                        <div class="cp-dropzone-label">Click to upload or drag & drop</div>
                        <div class="cp-dropzone-sub">JPG, PNG, WEBP or GIF · Max 5 MB<br>Recommended: 1200 × 300 px</div>
                    </div>

                    <div class="cp-preview-wrap" id="cpPreviewWrap">
                        <img id="cpPreviewImg" src="" alt="Preview">
                        <button type="button" class="cp-preview-remove" onclick="cpClearPreview()" title="Remove">
                            <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
                        </button>
                    </div>

                    @if(!empty($supplierProfile->cover_photo))
                    <div class="cp-remove-row" id="cpRemoveRow">
                        <span>Remove current cover photo</span>
                        <button type="button" class="cp-remove-btn" onclick="cpConfirmRemove()">
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 3.5h10M5 3.5V2.5h4v1M4.5 3.5v7a1 1 0 001 1h3a1 1 0 001-1v-7"/></svg>
                            Remove
                        </button>
                    </div>
                    @endif
                </div>

                <div class="cp-modal-foot">
                    <button type="button" class="cp-btn-cancel" onclick="cpModalClose()">Cancel</button>
                    <button type="submit" class="cp-btn-save" id="cpSaveBtn" disabled>
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg>
                        Save Cover
                    </button>
                </div>
            </form>

            <form id="cpRemoveForm" action="{{ route('supplier.cover.delete') }}" method="POST" style="display:none;">
                @csrf @method('DELETE')
            </form>
        </div>
    </div>

    {{-- ══ LIGHTBOX ══ --}}
    <div id="fbLb" class="fb-lb" onclick="if(event.target===this)fbLbClose()">
        <div class="fb-lb-bar">
            <div class="fb-lb-bar-title">
                <span id="fbLbTitle"></span>
                <span class="fb-lb-bar-date" id="fbLbCounter"></span>
            </div>
            <div class="fb-lb-bar-r">
                <button type="button" class="fb-lb-icon-btn" onclick="fbLbClose()">
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
        /* ── TAB SWITCHER ── */
        function switchTab(panelId, btn) {
            document.querySelectorAll('.bv-tab').forEach(function(t){ t.classList.remove('active'); });
            document.querySelectorAll('.bv-tab-panel').forEach(function(p){ p.classList.remove('active'); });
            btn.classList.add('active');
            var panel = document.getElementById('panel-' + panelId);
            if (panel) panel.classList.add('active');
        }

        /* ── COVER PHOTO MODAL ── */
        function cpModalOpen() {
            document.getElementById('cpModalOverlay').classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function cpModalClose() {
            document.getElementById('cpModalOverlay').classList.remove('open');
            document.body.style.overflow = '';
        }
        function cpHandleFile(input) {
            if (!input.files || !input.files[0]) return;
            var file = input.files[0];
            if (file.size > 5 * 1024 * 1024) { alert('File size must be under 5 MB.'); input.value = ''; return; }
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('cpPreviewImg').src = e.target.result;
                document.getElementById('cpPreviewWrap').classList.add('visible');
                document.getElementById('cpDropzone').style.display = 'none';
                document.getElementById('cpSaveBtn').removeAttribute('disabled');
            };
            reader.readAsDataURL(file);
        }
        function cpClearPreview() {
            document.getElementById('cpFileInput').value = '';
            document.getElementById('cpPreviewImg').src = '';
            document.getElementById('cpPreviewWrap').classList.remove('visible');
            document.getElementById('cpDropzone').style.display = '';
            document.getElementById('cpSaveBtn').setAttribute('disabled', 'disabled');
        }
        function cpConfirmRemove() {
            if (confirm('Remove your current cover photo?')) {
                document.getElementById('cpRemoveForm').submit();
            }
        }
        (function() {
            var dz = document.getElementById('cpDropzone');
            if (!dz) return;
            dz.addEventListener('dragover',  function(e){ e.preventDefault(); dz.classList.add('drag-over'); });
            dz.addEventListener('dragleave', function(){ dz.classList.remove('drag-over'); });
            dz.addEventListener('drop', function(e){
                e.preventDefault(); dz.classList.remove('drag-over');
                var fi = document.getElementById('cpFileInput');
                if (e.dataTransfer.files.length){ fi.files = e.dataTransfer.files; cpHandleFile(fi); }
            });
        })();

        /* ── ESC key closes modals ── */
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') { cpModalClose(); fbLbClose(); }
        });

        /* ── LIGHTBOX ── */
        var fbUrls=[],fbIdx=0,fbTitle='';
        function fbLbOpen(urls,idx,title){
            fbUrls=urls;fbIdx=idx;fbTitle=title;
            var strip=document.getElementById('fbLbStrip');
            strip.innerHTML='';
            if(urls.length>1){
                for(var i=0;i<urls.length;i++){
                    var th=document.createElement('img');
                    th.src=urls[i];th.className='fb-lb-thumb'+(i===idx?' lb-active':'');
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
            prev.style.display=idx===0?'none':'';
            next.style.display=idx===fbUrls.length-1?'none':'';
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
            if(e.key==='ArrowLeft')fbLbNav(-1);
            if(e.key==='ArrowRight')fbLbNav(1);
        });
    </script>

</x-supplier-layout>