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

        /* ══ OUTER LAYOUT: sidebar + content ══ */
        .bv-outer-layout{display:grid;grid-template-columns:220px 1fr;gap:1.5rem;align-items:start;}
        @media(max-width:860px){
            .bv-outer-layout{grid-template-columns:1fr;}
        }

        /* ══ LEFT TAB SIDEBAR ══ */
        .bv-profile-sidebar{
            background:var(--white);border-radius:12px;border:1px solid #F0EBE5;
            box-shadow:0 1px 4px rgba(30,27,24,0.05);overflow:hidden;
            position:sticky;top:1.5rem;
        }
        /* On mobile, sidebar becomes horizontal scrollable tab bar */
        @media(max-width:860px){
            .bv-profile-sidebar{
                position:static;
                display:flex;
                flex-direction:row;
                overflow-x:auto;
                border-radius:10px;
                padding:0.25rem 0.5rem;
                gap:0;
                -webkit-overflow-scrolling:touch;
                scrollbar-width:none;
            }
            .bv-profile-sidebar::-webkit-scrollbar{display:none;}
            .bv-sidebar-label{display:none;}
            .bv-sidebar-divider{display:none;}
        }

        .bv-sidebar-label{font-size:0.6rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#C0B8B0;padding:1rem 1.1rem 0.5rem;}
        .bv-tab{
            display:flex;align-items:center;gap:0.65rem;
            width:100%;padding:0.75rem 1.1rem;
            border:none;background:transparent;
            font-family:var(--font-body);font-size:0.82rem;font-weight:500;
            color:var(--warm-grey);cursor:pointer;text-align:left;
            transition:background 0.15s,color 0.15s;
            border-left:3px solid transparent;
            white-space:nowrap;
        }
        .bv-tab svg{width:16px;height:16px;flex-shrink:0;opacity:0.6;transition:opacity 0.15s;}
        .bv-tab:hover{background:rgba(201,168,76,0.05);color:var(--charcoal);}
        .bv-tab:hover svg{opacity:0.85;}
        .bv-tab.active{background:rgba(201,168,76,0.08);color:var(--gold-dark);border-left-color:var(--gold);font-weight:600;}
        .bv-tab.active svg{opacity:1;color:var(--gold-dark);}

        /* Mobile tab overrides — horizontal pill style */
        @media(max-width:860px){
            .bv-tab{
                width:auto;flex-shrink:0;
                border-left:none;border-bottom:3px solid transparent;
                border-radius:8px 8px 0 0;
                padding:0.65rem 1rem;
                font-size:0.78rem;
            }
            .bv-tab.active{
                border-left:none;
                border-bottom-color:var(--gold);
                background:rgba(201,168,76,0.08);
            }
        }

        .bv-sidebar-divider{height:1px;background:#F7F3EF;margin:0.4rem 0;}

        /* ══ TAB PANELS ══ */
        .bv-tab-panel{display:none;}
        .bv-tab-panel.active{display:flex;flex-direction:column;gap:1.25rem;}

        /* ══ IDENTITY CARD ══ */
        .bv-id-card{background:var(--white);border-radius:14px;border:1px solid #F0EBE5;overflow:hidden;box-shadow:0 2px 8px rgba(30,27,24,0.06);}
        .bv-id-card-banner{height:120px;background:linear-gradient(135deg,var(--charcoal) 0%,#2a2016 60%,#3d2f14 100%);position:relative;}
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

        /* ══ PORTFOLIO ══ */
        .pf-card{background:var(--white);border-radius:12px;border:1px solid #F0EBE5;box-shadow:0 1px 4px rgba(30,27,24,0.05);overflow:hidden;}
        .pf-card-header{padding:1.1rem 1.5rem;border-bottom:1px solid #F7F3EF;display:flex;align-items:center;justify-content:space-between;gap:0.75rem;}
        .pf-card-header-l{display:flex;align-items:center;gap:0.75rem;}
        .pf-card-icon{width:34px;height:34px;border-radius:8px;background:rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
        .pf-card-icon svg{width:16px;height:16px;}
        .pf-card-title{font-family:var(--font-display);font-size:0.95rem;font-weight:700;color:var(--charcoal);}
        .pf-card-desc{font-size:0.72rem;color:var(--warm-grey);margin-top:0.1rem;}
        .pf-card-body{padding:1.5rem;}
        .pf-portfolio-list{display:flex;flex-direction:column;gap:1.25rem;}
        .pf-post{border-radius:12px;border:1px solid #F0EBE5;overflow:hidden;background:var(--white);box-shadow:0 1px 4px rgba(30,27,24,0.05);}
        .pf-post-head{display:flex;align-items:center;justify-content:space-between;padding:0.9rem 1.1rem 0.6rem;}
        .pf-post-head-l{display:flex;align-items:center;gap:0.65rem;}
        .pf-post-avatar{width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,var(--gold),var(--gold-dark));display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:0.95rem;font-weight:700;color:var(--white);flex-shrink:0;overflow:hidden;}
        .pf-post-avatar img{width:100%;height:100%;object-fit:cover;}
        .pf-post-title{font-family:var(--font-display);font-size:0.88rem;font-weight:700;color:var(--charcoal);line-height:1.2;}
        .pf-post-date{font-size:0.65rem;color:#C0B8B0;margin-top:0.06rem;}
        .pf-post-delete-btn{display:inline-flex;align-items:center;gap:0.3rem;padding:0.32rem 0.7rem;border-radius:6px;border:1.5px solid #FADBD8;background:transparent;font-family:var(--font-body);font-size:0.7rem;font-weight:500;color:#C0392B;cursor:pointer;transition:background 0.15s,border-color 0.15s;}
        .pf-post-delete-btn svg{width:10px;height:10px;}
        .pf-post-delete-btn:hover{background:#FFF5F5;border-color:#C0392B;}
        .pf-post-desc{padding:0 1.1rem 0.75rem;font-size:0.82rem;color:var(--warm-grey);line-height:1.6;}
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
        .pf-post-video{background:#000;}
        .pf-post-video video{width:100%;max-height:400px;display:block;object-fit:contain;}
        .pf-post-foot{padding:0.6rem 1.1rem;border-top:1px solid #F7F3EF;display:flex;align-items:center;gap:0.4rem;}
        .pf-post-tag{display:inline-flex;align-items:center;gap:0.25rem;padding:0.16rem 0.55rem;border-radius:999px;background:rgba(201,168,76,0.1);color:var(--gold-dark);font-size:0.63rem;font-weight:600;}
        .pf-post-tag::before{content:'';width:4px;height:4px;border-radius:50%;background:var(--gold);}
        .pf-gallery-empty{text-align:center;padding:2.5rem 1.5rem;}
        .pf-gallery-empty-icon{width:48px;height:48px;border-radius:50%;background:rgba(201,168,76,0.08);display:flex;align-items:center;justify-content:center;margin:0 auto 0.75rem;color:var(--gold-dark);}
        .pf-gallery-empty-icon svg{width:22px;height:22px;}
        .pf-gallery-empty p{font-size:0.8rem;color:var(--warm-grey);line-height:1.6;}

        /* ══ TEAMS PANEL ══ */
        .tm-card{background:var(--white);border-radius:12px;border:1px solid #F0EBE5;overflow:hidden;box-shadow:0 1px 4px rgba(30,27,24,0.04);}
        .tm-card-head{display:flex;align-items:center;justify-content:space-between;gap:0.65rem;padding:1rem 1.4rem;border-bottom:1px solid #F7F3EF;flex-wrap:wrap;}
        .tm-card-head-l{display:flex;align-items:center;gap:0.65rem;}
        .tm-card-icon{width:32px;height:32px;border-radius:8px;background:rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
        .tm-card-icon svg{width:15px;height:15px;}
        .tm-card-title{font-family:var(--font-display);font-size:0.9rem;font-weight:700;color:var(--charcoal);}
        .tm-card-desc{font-size:0.7rem;color:var(--warm-grey);margin-top:0.06rem;}

        /* Teams table */
        .tm-table-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch;}
        .tm-table{width:100%;border-collapse:collapse;}
        .tm-table thead tr{border-bottom:1px solid #F0EBE5;}
        .tm-table th{padding:0.7rem 1rem;font-size:0.62rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#C0B8B0;text-align:left;white-space:nowrap;}
        .tm-table tbody tr{border-bottom:1px solid #F7F3EF;transition:background 0.15s;}
        .tm-table tbody tr:last-child{border-bottom:none;}
        .tm-table tbody tr:hover{background:rgba(201,168,76,0.03);}
        .tm-table td{padding:0.85rem 1rem;font-size:0.83rem;color:var(--charcoal);vertical-align:middle;}
        @media(max-width:600px){
            .tm-table th,.tm-table td{padding:0.65rem 0.75rem;font-size:0.78rem;}
        }

        .tm-row-avatar{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--gold) 0%,var(--gold-dark) 100%);display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:0.85rem;font-weight:700;color:var(--white);flex-shrink:0;}
        .tm-name-cell{display:flex;align-items:center;gap:0.75rem;}
        .tm-name-text{font-weight:600;color:var(--charcoal);font-size:0.84rem;}
        .tm-role-badge{display:inline-flex;align-items:center;gap:0.25rem;padding:0.18rem 0.6rem;border-radius:999px;background:rgba(201,168,76,0.1);color:var(--gold-dark);font-size:0.65rem;font-weight:600;}
        .tm-role-badge::before{content:'';width:4px;height:4px;border-radius:50%;background:var(--gold);}
        .tm-contact-text{font-size:0.78rem;color:var(--warm-grey);}
        .tm-contact-text span{display:block;line-height:1.5;}

        .tm-del-btn{display:inline-flex;align-items:center;gap:0.3rem;padding:0.28rem 0.65rem;border-radius:6px;border:1.5px solid #FADBD8;background:transparent;font-family:var(--font-body);font-size:0.7rem;font-weight:500;color:#C0392B;cursor:pointer;transition:background 0.15s,border-color 0.15s;}
        .tm-del-btn svg{width:10px;height:10px;}
        .tm-del-btn:hover{background:#FFF5F5;border-color:#C0392B;}

        .tm-empty{text-align:center;padding:2.5rem 1.5rem;}
        .tm-empty-icon{width:46px;height:46px;border-radius:50%;background:rgba(201,168,76,0.08);display:flex;align-items:center;justify-content:center;margin:0 auto 0.75rem;color:var(--gold-dark);}
        .tm-empty-icon svg{width:20px;height:20px;}
        .tm-empty p{font-size:0.8rem;color:var(--warm-grey);line-height:1.6;}

        /* ══ ADD TEAM MODAL ══ */
        .tm-modal-overlay{position:fixed;inset:0;z-index:8000;background:rgba(30,27,24,0.55);display:none;align-items:center;justify-content:center;padding:1rem;}
        .tm-modal-overlay.open{display:flex;}
        .tm-modal{background:var(--white);border-radius:14px;border:1px solid #F0EBE5;box-shadow:0 8px 40px rgba(30,27,24,0.18);width:100%;max-width:520px;overflow:hidden;animation:tmSlideIn 0.22s ease;}
        @keyframes tmSlideIn{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
        .tm-modal-head{display:flex;align-items:center;justify-content:space-between;padding:1.1rem 1.4rem;border-bottom:1px solid #F7F3EF;}
        .tm-modal-head-l{display:flex;align-items:center;gap:0.65rem;}
        .tm-modal-icon{width:32px;height:32px;border-radius:8px;background:rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
        .tm-modal-icon svg{width:15px;height:15px;}
        .tm-modal-title{font-family:var(--font-display);font-size:0.95rem;font-weight:700;color:var(--charcoal);}
        .tm-modal-close{width:30px;height:30px;border-radius:50%;border:1.5px solid #E5DDD5;background:var(--white);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--warm-grey);transition:border-color 0.15s,color 0.15s,background 0.15s;}
        .tm-modal-close:hover{border-color:var(--gold);color:var(--gold-dark);background:rgba(201,168,76,0.05);}
        .tm-modal-close svg{width:12px;height:12px;}
        .tm-modal-body{padding:1.35rem 1.4rem;}
        .tm-modal-foot{padding:0.85rem 1.4rem;border-top:1px solid #F7F3EF;display:flex;align-items:center;justify-content:flex-end;gap:0.55rem;}

        .tm-fg{display:grid;grid-template-columns:repeat(2,1fr);gap:0.9rem;}
        @media(max-width:480px){.tm-fg{grid-template-columns:1fr;}}
        .tm-lbl{display:flex;align-items:center;justify-content:space-between;font-size:0.68rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:var(--warm-grey);margin-bottom:0.38rem;}
        .tm-req{font-size:0.58rem;color:#C0392B;font-weight:500;text-transform:none;letter-spacing:0;}
        .tm-opt{font-size:0.58rem;color:#C0B8B0;font-weight:400;text-transform:none;letter-spacing:0;}
        .tm-inp,.tm-sel{width:100%;padding:0.68rem 0.9rem;background:var(--ivory);border:1.5px solid #E5DDD5;border-radius:8px;font-family:var(--font-body);font-size:0.84rem;color:var(--charcoal);outline:none;transition:border-color 0.2s,box-shadow 0.2s,background 0.2s;appearance:none;display:block;}
        .tm-inp:focus,.tm-sel:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,0.12);background:var(--white);}
        .tm-inp::placeholder{color:#C0B8B0;}
        .tm-sw{position:relative;}
        .tm-sw::after{content:'';position:absolute;right:0.85rem;top:50%;transform:translateY(-50%);width:0;height:0;border-left:4px solid transparent;border-right:4px solid transparent;border-top:5px solid #C0B8B0;pointer-events:none;}
        .tm-iw{position:relative;}
        .tm-ico{position:absolute;left:0.8rem;top:50%;transform:translateY(-50%);width:14px;height:14px;color:#C0B8B0;pointer-events:none;}
        .tm-iw:focus-within .tm-ico{color:var(--gold-dark);}
        .tm-iw .tm-inp{padding-left:2.35rem;}
        .tm-btn-save{display:inline-flex;align-items:center;gap:0.45rem;padding:0.62rem 1.5rem;border-radius:6px;border:none;background:var(--charcoal);font-family:var(--font-body);font-size:0.82rem;font-weight:500;color:var(--white);cursor:pointer;transition:background 0.2s,box-shadow 0.2s,transform 0.15s;}
        .tm-btn-save svg{width:13px;height:13px;}
        .tm-btn-save:hover{background:var(--gold-dark);box-shadow:0 4px 12px rgba(201,168,76,0.2);transform:translateY(-1px);}
        .tm-btn-cancel{display:inline-flex;align-items:center;gap:0.4rem;padding:0.62rem 1.1rem;border-radius:6px;border:1.5px solid #E5DDD5;background:var(--white);font-family:var(--font-body);font-size:0.82rem;font-weight:500;color:var(--warm-grey);cursor:pointer;transition:border-color 0.2s,color 0.2s;}
        .tm-btn-cancel:hover{border-color:var(--gold);color:var(--charcoal);}

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
        .fb-lb-counter{text-align:center;font-size:0.7rem;color:rgba(255,255,255,0.45);padding:0.4rem 0 0;}
        .fb-lb-strip{display:flex;align-items:center;justify-content:center;gap:0.35rem;padding:0.55rem 1rem;overflow-x:auto;}
        .fb-lb-strip::-webkit-scrollbar{height:3px;}
        .fb-lb-strip::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.2);border-radius:2px;}
        .fb-lb-thumb{width:50px;height:50px;object-fit:cover;border-radius:5px;cursor:pointer;opacity:0.5;border:2px solid transparent;transition:opacity 0.2s,border-color 0.2s;flex-shrink:0;}
        .fb-lb-thumb.lb-active{opacity:1;border-color:var(--gold);}
        .fb-lb-thumb:hover{opacity:0.85;}

        /* ══ MOBILE RESPONSIVE EXTRAS ══ */
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
            .tm-modal-body{padding:1rem;}
            .tm-modal-foot{padding:0.75rem 1rem;}
        }

        /* Assign panel: role-in-package input responsive */
        .at-role-inp{
            width:100%;max-width:200px;
            padding:0.42rem 0.75rem;
            font-size:0.8rem;
        }
        @media(max-width:600px){
            .at-role-inp{max-width:130px;font-size:0.75rem;}
            /* Hide contact column on very small screens */
            .tm-hide-sm{display:none;}
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile Information') }}
        </h2>
    </x-slot>
    {{-- ══ SESSION ALERTS ══ --}}
    @if(session('success'))
    <div class="bv-alert-success">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="page-content">

        {{-- ══ PAGE HEADER ══ --}}
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
                $supplierProfile->first_name, $supplierProfile->last_name,
                $supplierProfile->phone,      $supplierProfile->city,
                $supplierProfile->categories->isNotEmpty() ? true : null,
                $supplierProfile->bio,        $supplierProfile->description,
                $supplierProfile->photo
            ])->filter()->count();
            $pct = round(($filled / 8) * 100);
            $expLabels = ['less_than_1'=>'< 1 year','1_2'=>'1–2 years','3_5'=>'3–5 years','6_10'=>'6–10 years','10_plus'=>'10+ years'];
        @endphp

        <div class="bv-outer-layout">

            {{-- ══ LEFT: TAB SIDEBAR ══ --}}
            <div class="bv-profile-sidebar">
                <div class="bv-sidebar-label">Navigation</div>

                <button class="bv-tab active" onclick="switchTab('info', this)">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="7" r="4"/><path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    Profile Info
                </button>

                <div class="bv-sidebar-divider"></div>

                <button class="bv-tab" onclick="switchTab('teams', this)">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="7" cy="7" r="3"/><circle cx="14" cy="7" r="3"/>
                        <path d="M1 17c0-3 2.7-5 6-5"/><path d="M10 17c0-3 2.7-5 6-5 3.3 0 3 2 3 5"/>
                    </svg>
                    Teams
                </button>

                <button class="bv-tab" onclick="switchTab('assignteams', this)">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="2" y="7" width="10" height="9" rx="1.5"/>
                        <path d="M8 7V5a4 4 0 018 0v2"/><path d="M15 11v4"/>
                        <path d="M13 13h4"/>
                    </svg>
                    Assign Teams
                </button>
            </div>

            {{-- ══ RIGHT: CONTENT PANELS ══ --}}
            <div>

                {{-- ── PANEL: Profile Info ── --}}
                <div id="panel-info" class="bv-tab-panel active">

                    {{-- Identity Hero Card --}}
                    <div class="bv-id-card">
                        <div class="bv-id-card-banner"></div>
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
                                <div class="bv-id-name">{{ $supplierProfile->business_name ?: trim(($supplierProfile->first_name ?? '').' '.($supplierProfile->last_name ?? '')) ?: Auth::user()->name }}</div>
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
                                    
                                </div>
                                @if($supplierProfile->tagline)
                                <div class="bv-id-tagline">"{{ $supplierProfile->tagline }}"</div>
                                @endif
                                <div class="bv-id-links">
                                    <a href="{{ route('supplier.edit', $supplierProfile->id) }}" class="bv-id-link">
                                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2l2 2-7 7H3v-2L10 2z"/></svg>Edit Profile
                                    </a>
                                    <a href="{{ route('supplier.profile') }}" class="bv-id-link">
                                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="2"/><path d="M7 1v1.2M7 11.8V13M1 7h1.2M11.8 7H13M2.8 2.8l.85.85M10.35 10.35l.85.85M10.35 3.65l-.85.85M3.65 10.35l-.85.85"/></svg>Account Settings
                                    </a>
                                    <a href="{{ route('supplier.portfolio.index', $supplierProfile->id) }}" class="bv-id-link">
                                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="3" width="12" height="9" rx="1.5"/><circle cx="5" cy="6.5" r="1"/><path d="M1 10l3-3 2.5 2.5 2-2 3.5 3.5"/></svg>Portfolio
                                    </a>
                                </div>
                            </div>
                            <div class="bv-id-right">
                                <div>
                                    <div class="bv-completion-label"><span>Profile completion</span><strong>{{ $pct }}%</strong></div>
                                    <div class="bv-completion-bar"><div class="bv-completion-fill" style="width:{{ $pct }}%;"></div></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Personal Identity --}}
                    <div class="bv-sc">
                        <div class="bv-sc-head">
                            <div class="bv-sc-head-l">
                                <div class="bv-sc-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="7" r="4"/><path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/></svg></div>
                                <div><div class="bv-sc-title">Personal Identity</div><div class="bv-sc-desc">Name, business identity and category</div></div>
                            </div>
                            <a href="{{ route('supplier.editidentity', $supplierProfile->id) }}" class="bv-btn-edit">
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2l2 2-7 7H3v-2L10 2z"/></svg>Edit
                            </a>
                        </div>
                        <div class="bv-sc-body">
                            <div class="bv-row-grid">
                                <div><div class="bv-info-k">First Name</div><div class="bv-info-v {{ !$supplierProfile->first_name ? 'nil' : '' }}">{{ $supplierProfile->first_name ?: '—' }}</div></div>
                                <div><div class="bv-info-k">Last Name</div><div class="bv-info-v {{ !$supplierProfile->last_name ? 'nil' : '' }}">{{ $supplierProfile->last_name ?: '—' }}</div></div>
                                <div><div class="bv-info-k">Business Name</div><div class="bv-info-v {{ !$supplierProfile->business_name ? 'nil' : '' }}">{{ $supplierProfile->business_name ?: 'Using full name' }}</div></div>
                                <div>
                                    <div class="bv-info-k">Category</div>
                                    <div class="bv-info-v">
                                        @foreach($supplierProfile->categories as $cat)
                                            <span class="bv-tag">{{ $cat->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="bv-row-full"><div class="bv-info-k">Tagline</div><div class="bv-info-v {{ !$supplierProfile->tagline ? 'nil' : '' }}">{{ $supplierProfile->tagline ?: '—' }}</div></div>
                            </div>
                        </div>
                    </div>

                    {{-- Contact & Location --}}
                    <div class="bv-sc">
                        <div class="bv-sc-head">
                            <div class="bv-sc-head-l">
                                <div class="bv-sc-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M3 5a2 2 0 012-2h1l2 4-1.5 1.5a11 11 0 004 4L12 11l4 2v1a2 2 0 01-2 2C7.5 16 4 12.5 4 7a2 2 0 011-1.7V5z"/></svg></div>
                                <div><div class="bv-sc-title">Contact & Location</div><div class="bv-sc-desc">Phone, address and location details</div></div>
                            </div>
                            <a href="{{ route('supplier.edit', $supplierProfile->id) }}" class="bv-btn-edit">
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2l2 2-7 7H3v-2L10 2z"/></svg>Edit
                            </a>
                        </div>
                        <div class="bv-sc-body">
                            <div class="bv-row-grid">
                                <div><div class="bv-info-k">Email</div><div class="bv-info-v"><a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a></div></div>
                                <div><div class="bv-info-k">Phone</div><div class="bv-info-v {{ !$supplierProfile->phone ? 'nil' : '' }}">{{ $supplierProfile->phone ?: '—' }}</div></div>
                                <div><div class="bv-info-k">City</div><div class="bv-info-v {{ !$supplierProfile->city ? 'nil' : '' }}">{{ $supplierProfile->city ?: '—' }}</div></div>
                                <div><div class="bv-info-k">Province</div><div class="bv-info-v {{ !$supplierProfile->province ? 'nil' : '' }}">{{ $supplierProfile->province ?: '—' }}</div></div>
                                <div class="bv-row-full"><div class="bv-info-k">Full Address</div><div class="bv-info-v {{ !$supplierProfile->address ? 'nil' : '' }}">{{ $supplierProfile->address ?: '—' }}</div></div>
                            </div>
                        </div>
                    </div>

                    {{-- About & Service --}}
                    <div class="bv-sc">
                        <div class="bv-sc-head">
                            <div class="bv-sc-head-l">
                                <div class="bv-sc-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="4" y="2" width="12" height="16" rx="2"/><path d="M7 7h6M7 10h6M7 13h4"/></svg></div>
                                <div><div class="bv-sc-title">About & Service</div><div class="bv-sc-desc">Bio, service description and experience</div></div>
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

                    {{-- Portfolio / Gallery --}}
                    <div class="pf-card">
                        <div class="pf-card-header">
                            <div class="pf-card-header-l">
                                <div class="pf-card-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="4" width="16" height="13" rx="2"/><circle cx="7" cy="9" r="1.5"/><path d="M2 14l4-4 3 3 3-3 6 5"/></svg></div>
                                <div>
                                    <div class="pf-card-title">My Gallery</div>
                                    @php $totalItems = isset($portfolios) ? count($portfolios) : 0; @endphp
                                    <div class="pf-card-desc">{{ $totalItems }} {{ $totalItems === 1 ? 'item' : 'items' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="pf-card-body">
                            @if(isset($portfolios) && count($portfolios))
                                <div class="pf-portfolio-list">
                                    @foreach($portfolios as $portfolio)
                                    @php
                                        $imgs=$portfolio->images??[];$imgCount=count($imgs);$hasVideo=!empty($portfolio->video);
                                        $shown=$imgCount>=5?4:$imgCount;
                                        $cls=$imgCount===1?'count-1':($imgCount===2?'count-2':($imgCount===3?'count-3':($imgCount===4?'count-4':'count-5plus')));
                                        $allUrls=array_map(fn($i)=>asset('storage/'.$i),$imgs);$allJson=json_encode($allUrls);
                                    @endphp
                                    <div class="pf-post">
                                        <div class="pf-post-head">
                                            <div class="pf-post-head-l">
                                                <div class="pf-post-avatar">
                                                    @if(!empty($supplierProfile->photo))
                                                        <img src="{{ asset('storage/'.$supplierProfile->photo) }}" alt="">
                                                    @else
                                                        {{ strtoupper(substr(Auth::user()->name,0,2)) }}
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="pf-post-title">{{ $portfolio->title }}</div>
                                                    <div class="pf-post-date">{{ $portfolio->created_at ? $portfolio->created_at->diffForHumans() : '' }}</div>
                                                </div>
                                            </div>
                                            <form method="POST" action="{{ route('supplier.portfolio.destroy',$portfolio->id) }}" onsubmit="return confirm('Remove this portfolio item?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="pf-post-delete-btn">
                                                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 3.5h10M5 3.5V2.5h4v1M4.5 3.5v7a1 1 0 001 1h3a1 1 0 001-1v-7"/></svg>Delete
                                                </button>
                                            </form>
                                        </div>
                                        @if($portfolio->description)<div class="pf-post-desc">{{ $portfolio->description }}</div>@endif
                                        @if($imgCount>0)
                                        <div class="pf-mosaic {{ $cls }}" onclick="fbLbOpen({{ $allJson }},0,'{{ addslashes($portfolio->title) }}')">
                                            @for($ci=0;$ci<$shown;$ci++)
                                            <div class="pf-mos-cell">
                                                <img src="{{ asset('storage/'.$imgs[$ci]) }}" alt="" loading="lazy">
                                                @if($ci===$shown-1&&$imgCount>$shown)<div class="pf-mos-more">+{{ $imgCount-$shown }}</div>@endif
                                            </div>
                                            @endfor
                                        </div>
                                        @endif
                                        @if($hasVideo)
                                        <div class="pf-post-video"><video width="100%" controls preload="metadata"><source src="{{ asset('storage/'.$portfolio->video) }}"></video></div>
                                        @endif
                                        <div class="pf-post-foot">
                                            @if($imgCount>0)<span class="pf-post-tag">{{ $imgCount }} photo{{ $imgCount!==1?'s':'' }}</span>@endif
                                            @if($hasVideo)<span class="pf-post-tag">Video</span>@endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="pf-gallery-empty">
                                    <div class="pf-gallery-empty-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg></div>
                                    <p>No portfolio items yet.<br>Upload your first photos or video below.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>{{-- /panel-info --}}

                {{-- ── PANEL: Teams ── --}}
                <div id="panel-teams" class="bv-tab-panel">

                    <div class="tm-card">
                        <div class="tm-card-head">
                            <div class="tm-card-head-l">
                                <div class="tm-card-icon">
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <circle cx="7" cy="7" r="3"/><circle cx="14" cy="7" r="3"/>
                                        <path d="M1 17c0-3 2.7-5 6-5"/><path d="M10 17c0-3 2.7-5 6-5 3.3 0 3 2 3 5"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="tm-card-title">Team Members</div>
                                    <div class="tm-card-desc">
                                        @php $teamCount = isset($teams) ? count($teams) : 0; @endphp
                                        {{ $teamCount }} {{ $teamCount === 1 ? 'member' : 'members' }}
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="bv-btn-primary" onclick="tmModalOpen()">
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 2v10M2 7h10"/></svg>
                                Add Member
                            </button>
                        </div>

                        @if(isset($teams) && count($teams))
                        <div class="tm-table-wrap">
                            <table class="tm-table">
                                <thead>
                                    <tr>
                                        <th>Member</th>
                                        <th>Role</th>
                                        <th class="tm-hide-sm">Contact</th>
                                        <th style="width:80px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teams as $team)
                                    <tr>
                                        <td>
                                            <div class="tm-name-cell">
                                                <div class="tm-row-avatar">{{ strtoupper(substr($team->name, 0, 2)) }}</div>
                                                <span class="tm-name-text">{{ $team->name }}</span>
                                            </div>
                                        </td>
                                        <td><span class="tm-role-badge">{{ $team->role }}</span></td>
                                        <td class="tm-hide-sm">
                                            <div class="tm-contact-text">
                                                @if($team->email)<span>{{ $team->email }}</span>@endif
                                                @if($team->phone)<span>{{ $team->phone }}</span>@endif
                                                @if(!$team->email && !$team->phone)<span style="color:#C0B8B0;font-style:italic;">—</span>@endif
                                            </div>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('teams.destroy', $team->id) }}"
                                                  onsubmit="return confirm('Remove {{ addslashes($team->name) }} from your team?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="tm-del-btn">
                                                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 3.5h10M5 3.5V2.5h4v1M4.5 3.5v7a1 1 0 001 1h3a1 1 0 001-1v-7"/></svg>
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="tm-empty">
                            <div class="tm-empty-icon">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <circle cx="7" cy="7" r="3"/><circle cx="14" cy="7" r="3"/>
                                    <path d="M1 17c0-3 2.7-5 6-5"/><path d="M10 17c0-3 2.7-5 6-5 3.3 0 3 2 3 5"/>
                                </svg>
                            </div>
                            <p>No team members yet.<br>Click <strong>Add Member</strong> to get started.</p>
                        </div>
                        @endif
                    </div>

                </div>{{-- /panel-teams --}}

                {{-- ── PANEL: Assign Teams to Package ── --}}
                <div id="panel-assignteams" class="bv-tab-panel">

                    <div class="tm-card">
                        <div class="tm-card-head">
                            <div class="tm-card-head-l">
                                <div class="tm-card-icon">
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <rect x="2" y="7" width="10" height="9" rx="1.5"/>
                                        <path d="M8 7V5a4 4 0 018 0v2"/>
                                        <path d="M15 11v4"/><path d="M13 13h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="tm-card-title">Assign Teams to Package</div>
                                    <div class="tm-card-desc">Select members and define their role in this package</div>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('supplier.package.store') }}">
                            @csrf

                            @if(isset($teams) && count($teams))
                            <div class="tm-table-wrap">
                                <table class="tm-table">
                                    <thead>
                                        <tr>
                                            <th style="width:44px;text-align:center;">
                                                {{-- Select All --}}
                                                <input type="checkbox" id="at_select_all"
                                                    style="width:15px;height:15px;accent-color:var(--gold-dark);cursor:pointer;"
                                                    title="Select all">
                                            </th>
                                            <th>Member</th>
                                            <th>Role</th>
                                            <th>Role in Package</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teams as $team)
                                        <tr>
                                            {{-- Checkbox --}}
                                            <td style="text-align:center;">
                                                <input
                                                    type="checkbox"
                                                    name="teams[]"
                                                    value="{{ $team->id }}"
                                                    id="assign_team_{{ $team->id }}"
                                                    class="at-team-cb"
                                                    {{ isset($package) && $package->teams->contains($team->id) ? 'checked' : '' }}
                                                    style="width:15px;height:15px;accent-color:var(--gold-dark);cursor:pointer;">
                                            </td>

                                            {{-- Name --}}
                                            <td>
                                                <div class="tm-name-cell">
                                                    <div class="tm-row-avatar">{{ strtoupper(substr($team->name, 0, 2)) }}</div>
                                                    <label for="assign_team_{{ $team->id }}" class="tm-name-text" style="cursor:pointer;">
                                                        {{ $team->name }}
                                                    </label>
                                                </div>
                                            </td>

                                            {{-- Existing role badge --}}
                                            <td><span class="tm-role-badge">{{ $team->role }}</span></td>

                                            {{-- Role in this package --}}
                                            <td>
                                                <input
                                                    type="text"
                                                    name="roles[{{ $team->id }}]"
                                                    placeholder="e.g. Lead Photographer"
                                                    value="{{ isset($package) ? optional($package->teams->find($team->id))->pivot->role_in_package : '' }}"
                                                    class="tm-inp at-role-inp">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Form footer --}}
                            <div style="padding:1rem 1.4rem;border-top:1px solid #F7F3EF;display:flex;align-items:center;justify-content:flex-end;gap:0.55rem;flex-wrap:wrap;">
                                <button type="submit" class="tm-btn-save">
                                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg>
                                    Save Package Teams
                                </button>
                            </div>

                            @else
                            <div class="tm-empty">
                                <div class="tm-empty-icon">
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="7" cy="7" r="3"/><circle cx="14" cy="7" r="3"/>
                                        <path d="M1 17c0-3 2.7-5 6-5"/>
                                        <path d="M10 17c0-3 2.7-5 6-5 3.3 0 3 2 3 5"/>
                                    </svg>
                                </div>
                                <p>No team members yet.<br>Go to <strong>Teams</strong> tab and add members first.</p>
                            </div>
                            @endif

                        </form>
                    </div>

                </div>{{-- /panel-assignteams --}}

            </div>{{-- /right content --}}
        </div>{{-- /bv-outer-layout --}}

        @else
        {{-- No profile state --}}
        <div class="bv-sc">
            <div class="bv-sc-body bv-empty">
                <div class="bv-empty-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-8 8-8s8 4 8 8"/></svg></div>
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

    {{-- ══ ADD TEAM MEMBER MODAL ══ --}}
    <div class="tm-modal-overlay" id="tmModalOverlay" onclick="if(event.target===this)tmModalClose()">
        <div class="tm-modal">
            <div class="tm-modal-head">
                <div class="tm-modal-head-l">
                    <div class="tm-modal-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="7" cy="7" r="3"/><circle cx="14" cy="7" r="3"/>
                            <path d="M1 17c0-3 2.7-5 6-5"/><path d="M10 17c0-3 2.7-5 6-5 3.3 0 3 2 3 5"/>
                        </svg>
                    </div>
                    <div class="tm-modal-title">Add Team Member</div>
                </div>
                <button type="button" class="tm-modal-close" onclick="tmModalClose()">
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
                </button>
            </div>

            <form action="{{ route('teams.store') }}" method="POST">
                @csrf
                <div class="tm-modal-body">
                    <div class="tm-fg">

                        {{-- Name --}}
                        <div>
                            <label class="tm-lbl" for="tm_name">Name <span class="tm-req">Required</span></label>
                            <div class="tm-iw">
                                <svg class="tm-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="7" r="4"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                                <input id="tm_name" type="text" name="name" class="tm-inp" placeholder="e.g. Juan Dela Cruz" required>
                            </div>
                        </div>

                        {{-- Role --}}
                        <div>
                            <label class="tm-lbl" for="tm_role">Role <span class="tm-req">Required</span></label>
                            <div class="tm-sw">
                                <select id="tm_role" name="role" class="tm-sel" required>
                                    <option value="" disabled selected>Select role...</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="tm-lbl" for="tm_email">Email <span class="tm-opt">Optional</span></label>
                            <div class="tm-iw">
                                <svg class="tm-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="4" width="16" height="12" rx="2"/><path d="M2 7l8 5 8-5"/></svg>
                                <input id="tm_email" type="email" name="email" class="tm-inp" placeholder="e.g. juan@email.com">
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label class="tm-lbl" for="tm_phone">Phone <span class="tm-opt">Optional</span></label>
                            <div class="tm-iw">
                                <svg class="tm-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M3 5a2 2 0 012-2h1l2 4-1.5 1.5a11 11 0 004 4L12 11l4 2v1a2 2 0 01-2 2C7.5 16 4 12.5 4 7a2 2 0 011-1.7V5z"/></svg>
                                <input id="tm_phone" type="text" name="phone" class="tm-inp" placeholder="+63 917 000 0000">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tm-modal-foot">
                    <button type="button" class="tm-btn-cancel" onclick="tmModalClose()">Cancel</button>
                    <button type="submit" class="tm-btn-save">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg>
                        Save Member
                    </button>
                </div>
            </form>
        </div>
    </div>{{-- /tmModalOverlay --}}

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

    /* ── ASSIGN TEAMS: Select All checkbox ── */
    var atSelectAll = document.getElementById('at_select_all');
    if (atSelectAll) {
        atSelectAll.addEventListener('change', function() {
            document.querySelectorAll('.at-team-cb').forEach(function(cb) {
                cb.checked = atSelectAll.checked;
            });
        });
        // Sync select-all state when individual boxes change
        document.querySelectorAll('.at-team-cb').forEach(function(cb) {
            cb.addEventListener('change', function() {
                var all = document.querySelectorAll('.at-team-cb');
                var checked = document.querySelectorAll('.at-team-cb:checked');
                atSelectAll.indeterminate = checked.length > 0 && checked.length < all.length;
                atSelectAll.checked = checked.length === all.length;
            });
        });
    }

    /* ── TEAM MODAL ── */
    function tmModalOpen() {
        document.getElementById('tmModalOverlay').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function tmModalClose() {
        document.getElementById('tmModalOverlay').classList.remove('open');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') { tmModalClose(); fbLbClose(); }
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
        prev.style.display=idx===0?'none':'';
        next.style.display=idx===fbUrls.length-1?'none':'';
        thumbs.forEach(function(t,i){t.classList.toggle('lb-active',i===idx);});
        if(thumbs[idx]){thumbs[idx].scrollIntoView({block:'nearest',inline:'center',behavior:'smooth'});}
    }
    function fbLbNav(dir){var n=fbIdx+dir;if(n>=0&&n<fbUrls.length)fbLbGo(n);}
    function fbLbClose(){
        document.getElementById('fbLb').classList.remove('open');
        document.body.style.overflow='';
        var vid=document.getElementById('fbLbVideo');
        vid.pause();vid.src='';
    }
    document.addEventListener('keydown',function(e){
        if(!document.getElementById('fbLb').classList.contains('open'))return;
        if(e.key==='ArrowLeft')fbLbNav(-1);
        if(e.key==='ArrowRight')fbLbNav(1);
    });
    </script>

</x-supplier-layout>