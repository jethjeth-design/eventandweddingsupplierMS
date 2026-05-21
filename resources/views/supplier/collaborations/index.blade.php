<x-supplier-layout>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap');

:root {
    --gold:#C9A84C; --gold-dark:#8A6A1F; --gold-light:rgba(201,168,76,0.12);
    --ivory:#FAF7F2; --charcoal:#1E1B18; --warm-grey:#706B65;
    --border:#E5DDD5; --border-md:#E0D8D0;
    --white:#FFFFFF;
    --font-display:'Playfair Display',Georgia,serif;
    --font-body:'DM Sans',sans-serif;
    --radius-card:14px; --radius-btn:8px; --radius-badge:20px;
    --shadow-card:0 2px 16px rgba(30,27,24,.07);
    --shadow-hover:0 6px 28px rgba(30,27,24,.13);
    --shadow-modal:0 8px 40px rgba(30,27,24,.2);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}

/* ── PAGE ── */
.co-page{max-width:1100px;margin:auto;padding:1.75rem 1.5rem 4rem;}

/* ── ALERTS ── */
.co-alert{display:flex;align-items:center;gap:.65rem;border-radius:10px;padding:.8rem 1.1rem;font-family:var(--font-body);font-size:.83rem;margin-bottom:1.25rem;}
.co-alert svg{width:15px;height:15px;flex-shrink:0;}
.co-alert-ok{background:#F0FDF4;border:1px solid #A7F3D0;color:#065F46;}
.co-alert-ok svg{color:#10B981;}
.co-alert-err{background:#FEF2F2;border:1px solid #FCA5A5;color:#991B1B;}
.co-alert-err svg{color:#EF4444;}

/* ── PAGE HEADER ── */
.co-page-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;}
.co-page-title{font-family:var(--font-display);font-size:1.65rem;font-weight:700;color:var(--charcoal);line-height:1.15;}
.co-page-title em{font-style:italic;color:var(--gold-dark);}
.co-page-sub{font-size:.76rem;color:var(--warm-grey);margin-top:.2rem;font-family:var(--font-body);}
.co-header-btns{display:flex;align-items:center;gap:.6rem;flex-wrap:wrap;}
.co-btn-primary{display:inline-flex;align-items:center;gap:.45rem;padding:.6rem 1.3rem;border-radius:var(--radius-btn);border:none;background:var(--charcoal);font-family:var(--font-body);font-size:.8rem;font-weight:600;color:var(--white);cursor:pointer;transition:background .2s,box-shadow .2s,transform .15s;white-space:nowrap;}
.co-btn-primary svg{width:13px;height:13px;flex-shrink:0;}
.co-btn-primary:hover{background:var(--gold-dark);box-shadow:0 4px 12px rgba(201,168,76,.25);transform:translateY(-1px);}
.co-btn-secondary{display:inline-flex;align-items:center;gap:.45rem;padding:.6rem 1.2rem;border-radius:var(--radius-btn);border:1.5px solid var(--border);background:var(--white);font-family:var(--font-body);font-size:.8rem;font-weight:600;color:var(--warm-grey);cursor:pointer;transition:border-color .2s,color .2s,background .2s;white-space:nowrap;position:relative;}
.co-btn-secondary svg{width:13px;height:13px;flex-shrink:0;}
.co-btn-secondary:hover{border-color:var(--gold);color:var(--gold-dark);background:var(--gold-light);}
.co-notif-dot{position:absolute;top:-5px;right:-5px;min-width:17px;height:17px;border-radius:999px;background:#F59E0B;border:2px solid var(--white);display:flex;align-items:center;justify-content:center;font-family:var(--font-body);font-size:.5rem;font-weight:700;color:var(--white);padding:0 .25rem;}

/* ── STATUS TABS ── */
.co-tabs{display:flex;align-items:center;gap:.5rem;margin-bottom:1.75rem;flex-wrap:wrap;background:var(--white);border-radius:var(--radius-card);border:1.5px solid var(--border);padding:.5rem;box-shadow:var(--shadow-card);}
.co-tab{display:inline-flex;align-items:center;gap:.5rem;padding:.52rem 1.15rem;border-radius:10px;border:none;background:transparent;font-family:var(--font-body);font-size:.78rem;font-weight:600;color:var(--warm-grey);cursor:pointer;transition:all .18s;white-space:nowrap;}
.co-tab-count{display:inline-flex;align-items:center;justify-content:center;min-width:18px;height:18px;border-radius:999px;font-size:.6rem;font-weight:700;padding:0 .35rem;background:var(--border);color:var(--warm-grey);}
.co-tab:hover{background:var(--gold-light);color:var(--gold-dark);}
.co-tab.tab-upcoming.active{background:rgba(245,158,11,.1);color:#92400E;}
.co-tab.tab-upcoming.active .co-tab-count{background:rgba(245,158,11,.25);color:#92400E;}
.co-tab.tab-ongoing.active{background:rgba(59,130,246,.08);color:#1E40AF;}
.co-tab.tab-ongoing.active .co-tab-count{background:rgba(59,130,246,.2);color:#1E40AF;}
.co-tab.tab-completed.active{background:#F0FDF4;color:#065F46;}
.co-tab.tab-completed.active .co-tab-count{background:rgba(16,185,129,.2);color:#065F46;}

/* ── PROJECT CARD ── */
.co-card{background:var(--white);border-radius:var(--radius-card);border:1.5px solid var(--border);box-shadow:var(--shadow-card);overflow:hidden;transition:box-shadow .2s,transform .2s,border-color .2s;margin-bottom:1.1rem;}
.co-card:hover{box-shadow:var(--shadow-hover);transform:translateY(-2px);border-color:rgba(201,168,76,.35);}
.co-card-accent{height:3px;}
.co-card-accent.upcoming{background:linear-gradient(90deg,#F59E0B,#D97706);}
.co-card-accent.ongoing{background:linear-gradient(90deg,#3B82F6,#6366F1);}
.co-card-accent.completed{background:linear-gradient(90deg,#10B981,#059669);}

/* Card body: two-column: info (left) + chat panel (right) */
.co-card-inner{display:grid;grid-template-columns:1fr auto;gap:0;align-items:stretch;}
@media(max-width:640px){.co-card-inner{grid-template-columns:1fr;}}

/* LEFT: main info */
.co-card-body{padding:1.2rem 1.4rem;}
.co-card-top{display:flex;align-items:flex-start;justify-content:space-between;gap:.75rem;margin-bottom:.6rem;}
.co-card-name{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--charcoal);line-height:1.25;}
.co-card-desc{font-family:var(--font-body);font-size:.78rem;color:var(--warm-grey);line-height:1.6;margin-bottom:.8rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.co-card-meta{display:flex;flex-wrap:wrap;gap:.45rem .9rem;margin-bottom:.9rem;}
.co-meta-item{display:flex;align-items:center;gap:.32rem;font-family:var(--font-body);font-size:.72rem;color:var(--warm-grey);}
.co-meta-item svg{width:12px;height:12px;color:var(--gold-dark);flex-shrink:0;}
.co-card-foot{display:flex;align-items:center;justify-content:space-between;gap:.5rem;padding-top:.85rem;border-top:1px solid #F5EFE8;flex-wrap:wrap;}
.co-card-actions{display:flex;gap:.45rem;flex-wrap:wrap;}
.co-action-btn{display:inline-flex;align-items:center;gap:.32rem;padding:.38rem .82rem;border-radius:6px;border:1.5px solid var(--border-md);background:var(--white);font-family:var(--font-body);font-size:.72rem;font-weight:600;color:var(--warm-grey);cursor:pointer;transition:all .18s;white-space:nowrap;text-decoration:none;}
.co-action-btn svg{width:11px;height:11px;}
.co-action-btn:hover{border-color:var(--gold);color:var(--gold-dark);background:var(--gold-light);}
.co-action-btn.danger{border-color:#FADBD8;color:#C0392B;}
.co-action-btn.danger:hover{border-color:#C0392B;background:#FFF5F5;}
.co-action-btn.success{border-color:#A7F3D0;color:#065F46;}
.co-action-btn.success:hover{border-color:#10B981;background:#F0FDF4;}

/* RIGHT: chat panel */
.co-chat-panel{
    width:180px;flex-shrink:0;
    border-left:1px solid #F5EFE8;
    padding:1.1rem 1.1rem;
    display:flex;flex-direction:column;gap:.5rem;
    background:var(--ivory);
}
@media(max-width:640px){
    .co-chat-panel{
        width:100%;border-left:none;border-top:1px solid #F5EFE8;
        flex-direction:row;flex-wrap:wrap;
        padding:.75rem 1.1rem;
    }
}
.co-chat-label{font-family:var(--font-body);font-size:.58rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#C0B8B0;margin-bottom:.15rem;}
@media(max-width:640px){.co-chat-label{width:100%;margin-bottom:.25rem;}}
.co-chat-btn{
    display:flex;align-items:center;gap:.5rem;
    padding:.42rem .75rem;border-radius:8px;
    background:var(--white);border:1.5px solid var(--border);
    font-family:var(--font-body);font-size:.73rem;font-weight:600;
    color:var(--charcoal);text-decoration:none;
    transition:border-color .18s,background .18s,color .18s,transform .15s;
    white-space:nowrap;
}
.co-chat-btn svg{width:13px;height:13px;flex-shrink:0;color:var(--gold-dark);}
.co-chat-btn:hover{border-color:var(--gold);background:var(--gold-light);color:var(--gold-dark);transform:translateY(-1px);}
.co-chat-supplier-name{font-family:var(--font-body);font-size:.65rem;color:var(--warm-grey);margin-top:.08rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:140px;}
.co-chat-no-members{font-family:var(--font-body);font-size:.72rem;color:#C0B8B0;font-style:italic;text-align:center;padding:.75rem 0;}

/* Status badges */
.co-badge{display:inline-flex;align-items:center;gap:.3rem;padding:.2rem .72rem;border-radius:999px;font-family:var(--font-body);font-size:.65rem;font-weight:700;white-space:nowrap;}
.co-badge::before{content:'';width:5px;height:5px;border-radius:50%;flex-shrink:0;}
.co-badge.upcoming{background:rgba(245,158,11,.1);border:1px solid rgba(245,158,11,.3);color:#92400E;}
.co-badge.upcoming::before{background:#F59E0B;}
.co-badge.ongoing{background:rgba(59,130,246,.08);border:1px solid rgba(59,130,246,.3);color:#1E40AF;}
.co-badge.ongoing::before{background:#3B82F6;}
.co-badge.completed{background:#F0FDF4;border:1px solid #A7F3D0;color:#065F46;}
.co-badge.completed::before{background:#10B981;}
.co-badge.pending{background:#FFFBEB;border:1px solid #FDE68A;color:#92400E;}
.co-badge.pending::before{background:#F59E0B;}
.co-badge.accepted{background:#F0FDF4;border:1px solid #A7F3D0;color:#065F46;}
.co-badge.accepted::before{background:#10B981;}
.co-badge.rejected{background:#FEF2F2;border:1px solid #FCA5A5;color:#991B1B;}
.co-badge.rejected::before{background:#EF4444;}

/* Member chips */
.co-members-row{display:flex;flex-wrap:wrap;gap:.4rem;margin-top:.55rem;}
.co-member-chip{display:inline-flex;align-items:center;gap:.28rem;padding:.14rem .52rem;border-radius:999px;background:var(--ivory);border:1px solid var(--border);font-family:var(--font-body);font-size:.63rem;font-weight:600;color:var(--warm-grey);}
.co-member-chip.accepted{background:rgba(16,185,129,.07);border-color:#A7F3D0;color:#065F46;}
.co-member-chip.pending{background:#FFFBEB;border-color:#FDE68A;color:#92400E;}
.co-member-chip.rejected{background:#FEF2F2;border-color:#FCA5A5;color:#991B1B;}

/* ── EMPTY STATE ── */
.co-empty{text-align:center;padding:4rem 1.5rem;background:var(--white);border-radius:var(--radius-card);border:1.5px dashed var(--border);}
.co-empty-icon{width:52px;height:52px;border-radius:50%;background:var(--gold-light);display:flex;align-items:center;justify-content:center;margin:0 auto .9rem;color:var(--gold-dark);}
.co-empty-icon svg{width:24px;height:24px;}
.co-empty-title{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--charcoal);margin-bottom:.35rem;}
.co-empty-desc{font-family:var(--font-body);font-size:.8rem;color:var(--warm-grey);line-height:1.6;}

/* ══ SHARED MODAL STYLES ══ */
.mo-overlay{position:fixed;inset:0;z-index:9000;background:rgba(30,27,24,.55);display:none;align-items:flex-start;justify-content:center;padding:1rem;backdrop-filter:blur(3px);overflow-y:auto;}
.mo-overlay.open{display:flex;}
.mo-box{background:var(--white);border-radius:var(--radius-card);border:1px solid var(--border);box-shadow:var(--shadow-modal);width:100%;max-width:580px;margin:auto;flex-shrink:0;animation:moSlide .22s ease;display:flex;flex-direction:column;max-height:calc(100vh - 2rem);overflow:hidden;}
.mo-box.mo-sm{max-width:440px;}
.mo-box.mo-md{max-width:520px;}
@keyframes moSlide{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
.mo-head{display:flex;align-items:center;justify-content:space-between;padding:1.1rem 1.4rem;border-bottom:1px solid var(--border);flex-shrink:0;}
.mo-head-l{display:flex;align-items:center;gap:.65rem;}
.mo-icon{width:32px;height:32px;border-radius:8px;background:var(--gold-light);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
.mo-icon svg{width:15px;height:15px;}
.mo-icon.danger{background:#FEF2F2;color:#C0392B;}
.mo-icon.success{background:#F0FDF4;color:#065F46;}
.mo-icon.warning{background:#FFFBEB;color:#D97706;}
.mo-title{font-family:var(--font-display);font-size:.95rem;font-weight:700;color:var(--charcoal);}
.mo-close{width:30px;height:30px;border-radius:50%;border:1.5px solid var(--border);background:var(--white);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--warm-grey);transition:border-color .15s,color .15s;}
.mo-close:hover{border-color:var(--gold);color:var(--gold-dark);}
.mo-close svg{width:12px;height:12px;}
.mo-body{padding:1.35rem 1.4rem;overflow-y:auto;flex:1;min-height:0;}
.mo-body::-webkit-scrollbar{width:4px;}
.mo-body::-webkit-scrollbar-thumb{background:var(--border-md);border-radius:99px;}
.mo-foot{padding:.85rem 1.4rem;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:flex-end;gap:.55rem;flex-shrink:0;background:var(--white);}
.mo-field{margin-bottom:.85rem;}
.mo-field:last-child{margin-bottom:0;}
.mo-fg{display:grid;grid-template-columns:repeat(2,1fr);gap:.85rem;margin-bottom:.85rem;}
.mo-fg-full{grid-column:1/-1;}
@media(max-width:480px){.mo-fg{grid-template-columns:1fr;}.mo-fg-full{grid-column:1/-1;}}
.mo-lbl{display:flex;align-items:center;justify-content:space-between;font-size:.68rem;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:var(--warm-grey);margin-bottom:.35rem;font-family:var(--font-body);}
.mo-req{font-size:.58rem;color:#C0392B;font-weight:500;text-transform:none;letter-spacing:0;}
.mo-opt{font-size:.58rem;color:#C0B8B0;font-weight:400;text-transform:none;letter-spacing:0;}
.mo-inp,.mo-sel,.mo-ta{width:100%;padding:.65rem .9rem;background:var(--ivory);border:1.5px solid var(--border);border-radius:8px;font-family:var(--font-body);font-size:.84rem;color:var(--charcoal);outline:none;transition:border-color .2s,box-shadow .2s,background .2s;appearance:none;display:block;}
.mo-inp:focus,.mo-sel:focus,.mo-ta:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,.12);background:var(--white);}
.mo-inp::placeholder,.mo-ta::placeholder{color:#C0B8B0;}
.mo-ta{resize:vertical;min-height:80px;}
.mo-sw{position:relative;}
.mo-sw::after{content:'';position:absolute;right:.85rem;top:50%;transform:translateY(-50%);border-left:4px solid transparent;border-right:4px solid transparent;border-top:5px solid #C0B8B0;pointer-events:none;}
.mo-sw .mo-sel{padding-right:2rem;}
.mo-sep{height:1px;background:var(--border);margin:1.1rem 0;}
.mo-sep-lbl{font-size:.63rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--warm-grey);margin-bottom:.7rem;display:flex;align-items:center;gap:.5rem;font-family:var(--font-body);}
.mo-sep-lbl::after{content:'';flex:1;height:1px;background:var(--border);}
.mo-hnt{font-size:.66rem;color:#C0B8B0;margin-top:.25rem;}
.mo-btn-save{display:inline-flex;align-items:center;gap:.45rem;padding:.62rem 1.5rem;border-radius:var(--radius-btn);border:none;background:var(--charcoal);font-family:var(--font-body);font-size:.82rem;font-weight:600;color:var(--white);cursor:pointer;transition:background .2s,box-shadow .2s,transform .15s;}
.mo-btn-save svg{width:13px;height:13px;}
.mo-btn-save:hover{background:var(--gold-dark);box-shadow:0 4px 12px rgba(201,168,76,.22);transform:translateY(-1px);}
.mo-btn-save:disabled{opacity:.55;cursor:not-allowed;transform:none;}
.mo-btn-cancel{display:inline-flex;align-items:center;gap:.4rem;padding:.62rem 1.1rem;border-radius:var(--radius-btn);border:1.5px solid var(--border);background:var(--white);font-family:var(--font-body);font-size:.82rem;font-weight:500;color:var(--warm-grey);cursor:pointer;transition:border-color .2s,color .2s;}
.mo-btn-cancel:hover{border-color:var(--gold);color:var(--charcoal);}
.mo-btn-danger{display:inline-flex;align-items:center;gap:.45rem;padding:.62rem 1.4rem;border-radius:var(--radius-btn);border:none;background:#C0392B;font-family:var(--font-body);font-size:.82rem;font-weight:600;color:var(--white);cursor:pointer;transition:background .2s,box-shadow .2s;}
.mo-btn-danger:hover{background:#9B2335;box-shadow:0 4px 12px rgba(192,57,43,.25);}
.mo-btn-danger:disabled{opacity:.55;cursor:not-allowed;}
.mo-btn-complete{display:inline-flex;align-items:center;gap:.45rem;padding:.62rem 1.4rem;border-radius:var(--radius-btn);border:none;background:#10B981;font-family:var(--font-body);font-size:.82rem;font-weight:600;color:var(--white);cursor:pointer;transition:background .2s,box-shadow .2s;}
.mo-btn-complete:hover{background:#059669;}
.mo-btn-complete:disabled{opacity:.55;cursor:not-allowed;}
.mo-btn-accept{display:inline-flex;align-items:center;gap:.4rem;padding:.52rem 1.1rem;border-radius:var(--radius-btn);border:none;background:#059669;font-family:var(--font-body);font-size:.78rem;font-weight:600;color:var(--white);cursor:pointer;transition:background .2s;}
.mo-btn-accept:hover{background:#047857;}
.mo-btn-reject{display:inline-flex;align-items:center;gap:.4rem;padding:.52rem 1.1rem;border-radius:var(--radius-btn);border:1.5px solid #FADBD8;background:transparent;font-family:var(--font-body);font-size:.78rem;font-weight:600;color:#C0392B;cursor:pointer;transition:background .15s,border-color .15s;}
.mo-btn-reject:hover{background:#FFF5F5;border-color:#C0392B;}
.mo-confirm-box{display:flex;gap:.9rem;align-items:flex-start;padding:.9rem 1rem;border-radius:10px;margin-bottom:.5rem;}
.mo-confirm-box.danger{background:#FEF2F2;border:1px solid #FECACA;}
.mo-confirm-box.success{background:#F0FDF4;border:1px solid #A7F3D0;}
.mo-confirm-icon{width:42px;height:42px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.mo-confirm-icon.danger{background:#FEE2E2;color:#C0392B;}
.mo-confirm-icon.success{background:#DCFCE7;color:#065F46;}
.mo-confirm-icon svg{width:19px;height:19px;}
.mo-confirm-text h4{font-family:var(--font-display);font-size:.9rem;font-weight:700;color:var(--charcoal);margin-bottom:.25rem;}
.mo-confirm-text p{font-family:var(--font-body);font-size:.78rem;color:var(--warm-grey);line-height:1.55;}
.mv-grid{display:grid;grid-template-columns:1fr 1fr;gap:.65rem 1.1rem;margin-bottom:.75rem;}
@media(max-width:480px){.mv-grid{grid-template-columns:1fr;}}
.mv-full{grid-column:1/-1;}
.mv-field{padding:.65rem .85rem;background:var(--ivory);border-radius:10px;border:1px solid #F0EBE5;}
.mv-key{font-family:var(--font-body);font-size:.57rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#C0B8B0;margin-bottom:.2rem;}
.mv-val{font-family:var(--font-body);font-size:.83rem;color:var(--charcoal);line-height:1.5;}
.mv-member-row{display:flex;align-items:center;justify-content:space-between;padding:.5rem .75rem;border-radius:8px;background:var(--ivory);border:1px solid #F0EBE5;margin-bottom:.4rem;gap:.5rem;}
.mv-member-name{font-family:var(--font-body);font-size:.8rem;font-weight:600;color:var(--charcoal);}
.mv-member-role{font-family:var(--font-body);font-size:.68rem;color:var(--warm-grey);}
.mv-del-btn{display:inline-flex;align-items:center;gap:.25rem;padding:.25rem .6rem;border-radius:6px;border:1.5px solid #FADBD8;background:transparent;font-family:var(--font-body);font-size:.65rem;font-weight:600;color:#C0392B;cursor:pointer;transition:background .15s;flex-shrink:0;}
.mv-del-btn:hover{background:#FFF5F5;border-color:#C0392B;}
.mv-del-btn svg{width:9px;height:9px;}
.inv-item{background:var(--ivory);border-radius:10px;border:1px solid #F0EBE5;padding:.85rem 1rem;margin-bottom:.65rem;}
.inv-item:last-child{margin-bottom:0;}
.inv-item-title{font-family:var(--font-display);font-size:.9rem;font-weight:700;color:var(--charcoal);margin-bottom:.2rem;}
.inv-item-owner{font-family:var(--font-body);font-size:.72rem;color:var(--warm-grey);margin-bottom:.35rem;}
.inv-item-meta{font-family:var(--font-body);font-size:.73rem;color:var(--warm-grey);line-height:1.65;}
.inv-item-meta strong{color:var(--charcoal);}
.inv-item-foot{display:flex;align-items:center;justify-content:space-between;gap:.5rem;flex-wrap:wrap;margin-top:.6rem;padding-top:.55rem;border-top:1px solid #F0EBE5;}
.inv-item-actions{display:flex;gap:.4rem;}
.inv-empty{text-align:center;padding:2.5rem 1.5rem;}
.inv-empty-icon{width:46px;height:46px;border-radius:50%;background:var(--gold-light);display:flex;align-items:center;justify-content:center;margin:0 auto .65rem;color:var(--gold-dark);}
.inv-empty-icon svg{width:20px;height:20px;}
.inv-empty p{font-family:var(--font-body);font-size:.8rem;color:var(--warm-grey);line-height:1.6;}
</style>

<div class="co-page">

    {{-- ALERTS --}}
    @if(session('success'))
    <div class="co-alert co-alert-ok">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="co-alert co-alert-err">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="10" cy="10" r="8"/><path d="M10 6v4M10 14v.5"/></svg>
        {{ session('error') }}
    </div>
    @endif

    @php
        $upcoming        = $projects->where('status','upcoming');
        $ongoing         = $projects->where('status','ongoing');
        $completed       = $projects->where('status','completed');
        $pendingInvCount = $invites->where('status','pending')->count();
    @endphp

    {{-- PAGE HEADER --}}
    <div class="co-page-header">
        <div>
            <h1 class="co-page-title">Collaboration <em>Projects</em></h1>
            <p class="co-page-sub">Manage your event collaboration projects with other suppliers</p>
        </div>
        <div class="co-header-btns">
            <button type="button" class="co-btn-secondary" onclick="openModal('invitationsOverlay')">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                    <rect x="2" y="4" width="16" height="12" rx="2"/><path d="M2 7l8 5 8-5"/>
                </svg>
                Invitations
                @if($pendingInvCount)
                <span class="co-notif-dot">{{ $pendingInvCount }}</span>
                @endif
            </button>
            <button type="button" class="co-btn-primary" onclick="openModal('createOverlay')">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 2v10M2 7h10"/></svg>
                New Project
            </button>
        </div>
    </div>

    {{-- STATUS TABS --}}
    <div class="co-tabs">
        <button class="co-tab tab-upcoming active" id="tab-upcoming" onclick="switchTab('upcoming',this)">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8" width="13" height="13"><rect x="1" y="2.5" width="12" height="10" rx="1.5"/><path d="M1 6h12M4.5 1v2.5M9.5 1v2.5"/></svg>
            Upcoming <span class="co-tab-count">{{ $upcoming->count() }}</span>
        </button>
        <button class="co-tab tab-ongoing" id="tab-ongoing" onclick="switchTab('ongoing',this)">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8" width="13" height="13"><circle cx="7" cy="7" r="5.5"/><path d="M7 4.5v2.5l1.5 1.5"/></svg>
            Ongoing <span class="co-tab-count">{{ $ongoing->count() }}</span>
        </button>
        <button class="co-tab tab-completed" id="tab-completed" onclick="switchTab('completed',this)">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8" width="13" height="13"><path d="M2 7l4 4 6-6"/><circle cx="7" cy="7" r="5.5"/></svg>
            Completed <span class="co-tab-count">{{ $completed->count() }}</span>
        </button>
    </div>

    {{-- ═══════════════════════════════
         UPCOMING PANEL
    ═══════════════════════════════ --}}
    <div id="panel-upcoming">
        @forelse($upcoming as $project)
        @php
            $members = $project->members ?? collect();
            $p = ['id'=>$project->id,'title'=>$project->title,'description'=>$project->description,'event_date'=>$project->event_date,'location'=>$project->location,'budget'=>$project->budget,'status'=>$project->status,
                  'members'=>$members->map(fn($m)=>['id'=>$m->id,'name'=>$m->supplier->business_name??'Supplier','role'=>$m->role,'price'=>$m->agreed_price,'status'=>$m->status,'deleteUrl'=>route('collaboration.members.destroy',$m->id)])->values()->toArray(),
                  'editUrl'=>route('collaborations.update',$project->id),'completeUrl'=>route('collaborations.complete',$project->id),'deleteUrl'=>route('collaborations.destroy',$project->id),'showUrl'=>route('collaborations.show',$project->id)];
        @endphp
        <div class="co-card">
            <div class="co-card-accent {{ $project->status }}"></div>
            <div class="co-card-inner">
                {{-- LEFT: info --}}
                <div class="co-card-body">
                    <div class="co-card-top">
                        <div class="co-card-name">{{ $project->title }}</div>
                        <span class="co-badge {{ $project->status }}">{{ ucfirst($project->status) }}</span>
                    </div>
                    @if($project->description)<div class="co-card-desc">{{ $project->description }}</div>@endif
                    <div class="co-card-meta">
                        @if($project->event_date)<div class="co-meta-item"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="2.5" width="12" height="10" rx="1.5"/><path d="M1 6h12M4.5 1v2.5M9.5 1v2.5"/></svg>{{ \Carbon\Carbon::parse($project->event_date)->format('M d, Y') }}</div>@endif
                        @if($project->location)<div class="co-meta-item"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 1C4.8 1 3 2.8 3 5c0 3.5 4 8 4 8s4-4.5 4-8c0-2.2-1.8-4-4-4z"/><circle cx="7" cy="5" r="1.5"/></svg>{{ $project->location }}</div>@endif
                        @if($project->budget)<div class="co-meta-item"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="5"/><path d="M7 4.5v5M5.5 6h3a1 1 0 010 2H6a1 1 0 000 2h3"/></svg>₱{{ number_format($project->budget,2) }}</div>@endif
                    </div>
                    @if($members->count())
                    <div class="co-members-row">
                        @foreach($members as $m)<span class="co-member-chip {{ $m->status }}">{{ $m->supplier->business_name??'Supplier' }}</span>@endforeach
                    </div>
                    @endif
                    <div class="co-card-foot">
                        <div class="co-card-actions">
                            <button type="button" class="co-action-btn" onclick='openViewModal({{ json_encode($p) }})'>
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="5.5"/><path d="M4.5 7c.8-1.5 1.4-2 2.5-2s1.7.5 2.5 2c-.8 1.5-1.4 2-2.5 2s-1.7-.5-2.5-2z"/><circle cx="7" cy="7" r="1.2"/></svg>View
                            </button>
                            <button type="button" class="co-action-btn" onclick='openEditModal({{ json_encode($p) }})'>
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9.5 1.5l3 3L4 13H1v-3L9.5 1.5z"/></svg>Edit
                            </button>
                            <button type="button" class="co-action-btn success" onclick='openCompleteModal({{ $project->id }},{{ json_encode($project->title) }},{{ json_encode(route("collaborations.complete",$project->id)) }})'>
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 7l4 4 6-6"/></svg>Complete
                            </button>
                            <button type="button" class="co-action-btn danger" onclick='openDeleteModal({{ $project->id }},{{ json_encode($project->title) }},{{ json_encode(route("collaborations.destroy",$project->id)) }})'>
                                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 3.5h10M5 3.5V2h4v1.5M5.5 6v5M8.5 6v5M3 3.5l.7 8.5h6.6L11 3.5H3z"/></svg>Delete
                            </button>
                        </div>
                        
                    </div>
                </div>
                {{-- RIGHT: chat panel --}}
                <div class="co-chat-panel">
                    <div class="co-chat-label">Chat with</div>
                    @php $chatMembers = $members->filter(fn($m) => $m->supplier && $m->supplier->user_id != auth()->id() && $m->status === 'accepted'); @endphp
                    @if($chatMembers->count())
                        @foreach($chatMembers as $m)
                        <div>
                            <a href="{{ route('messages.open', $m->supplier->user_id) }}" class="co-chat-btn">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M2 2h16a1 1 0 011 1v10a1 1 0 01-1 1H5l-4 4V3a1 1 0 011-1z"/>
                                </svg>
                                Chat
                            </a>
                            <div class="co-chat-supplier-name">{{ $m->supplier->business_name }}</div>
                        </div>
                        @endforeach
                    @else
                        <div class="co-chat-no-members">No accepted collaborators yet</div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="co-empty">
            <div class="co-empty-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="14" height="14" rx="2"/><path d="M7 10h6M10 7v6"/></svg></div>
            <div class="co-empty-title">No Upcoming Projects</div>
            <div class="co-empty-desc">Click <strong>New Project</strong> above to create your first collaboration.</div>
        </div>
        @endforelse
    </div>

    {{-- ═══════════════════════════════
         ONGOING PANEL
    ═══════════════════════════════ --}}
    <div id="panel-ongoing" style="display:none;">
        @forelse($ongoing as $project)
        @php
            $members = $project->members ?? collect();
            $p = ['id'=>$project->id,'title'=>$project->title,'description'=>$project->description,'event_date'=>$project->event_date,'location'=>$project->location,'budget'=>$project->budget,'status'=>$project->status,
                  'members'=>$members->map(fn($m)=>['id'=>$m->id,'name'=>$m->supplier->business_name??'Supplier','role'=>$m->role,'price'=>$m->agreed_price,'status'=>$m->status,'deleteUrl'=>route('collaboration.members.destroy',$m->id)])->values()->toArray(),
                  'editUrl'=>route('collaborations.update',$project->id),'completeUrl'=>route('collaborations.complete',$project->id),'deleteUrl'=>route('collaborations.destroy',$project->id),'showUrl'=>route('collaborations.show',$project->id)];
        @endphp
        <div class="co-card">
            <div class="co-card-accent {{ $project->status }}"></div>
            <div class="co-card-inner">
                <div class="co-card-body">
                    <div class="co-card-top">
                        <div class="co-card-name">{{ $project->title }}</div>
                        <span class="co-badge {{ $project->status }}">{{ ucfirst($project->status) }}</span>
                    </div>
                    @if($project->description)<div class="co-card-desc">{{ $project->description }}</div>@endif
                    <div class="co-card-meta">
                        @if($project->event_date)<div class="co-meta-item"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="2.5" width="12" height="10" rx="1.5"/><path d="M1 6h12M4.5 1v2.5M9.5 1v2.5"/></svg>{{ \Carbon\Carbon::parse($project->event_date)->format('M d, Y') }}</div>@endif
                        @if($project->location)<div class="co-meta-item"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 1C4.8 1 3 2.8 3 5c0 3.5 4 8 4 8s4-4.5 4-8c0-2.2-1.8-4-4-4z"/><circle cx="7" cy="5" r="1.5"/></svg>{{ $project->location }}</div>@endif
                        @if($project->budget)<div class="co-meta-item"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="5"/><path d="M7 4.5v5M5.5 6h3a1 1 0 010 2H6a1 1 0 000 2h3"/></svg>₱{{ number_format($project->budget,2) }}</div>@endif
                    </div>
                    @if($members->count())<div class="co-members-row">@foreach($members as $m)<span class="co-member-chip {{ $m->status }}">{{ $m->supplier->business_name??'Supplier' }}</span>@endforeach</div>@endif
                    <div class="co-card-foot">
                        <div class="co-card-actions">
                            <button type="button" class="co-action-btn" onclick='openViewModal({{ json_encode($p) }})'><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="5.5"/><path d="M4.5 7c.8-1.5 1.4-2 2.5-2s1.7.5 2.5 2c-.8 1.5-1.4 2-2.5 2s-1.7-.5-2.5-2z"/><circle cx="7" cy="7" r="1.2"/></svg>View</button>
                            <button type="button" class="co-action-btn" onclick='openEditModal({{ json_encode($p) }})'><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9.5 1.5l3 3L4 13H1v-3L9.5 1.5z"/></svg>Edit</button>
                            <button type="button" class="co-action-btn success" onclick='openCompleteModal({{ $project->id }},{{ json_encode($project->title) }},{{ json_encode(route("collaborations.complete",$project->id)) }})'><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 7l4 4 6-6"/></svg>Complete</button>
                            <button type="button" class="co-action-btn danger" onclick='openDeleteModal({{ $project->id }},{{ json_encode($project->title) }},{{ json_encode(route("collaborations.destroy",$project->id)) }})'><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 3.5h10M5 3.5V2h4v1.5M5.5 6v5M8.5 6v5M3 3.5l.7 8.5h6.6L11 3.5H3z"/></svg>Delete</button>
                        </div>
                    </div>
                </div>
                <div class="co-chat-panel">
                    <div class="co-chat-label">Chat with</div>
                    @php $chatMembers = $members->filter(fn($m) => $m->supplier && $m->supplier->user_id != auth()->id() && $m->status === 'accepted'); @endphp
                    @if($chatMembers->count())
                        @foreach($chatMembers as $m)
                        <div>
                            <a href="{{ route('messages.open', $m->supplier->user_id) }}" class="co-chat-btn">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M2 2h16a1 1 0 011 1v10a1 1 0 01-1 1H5l-4 4V3a1 1 0 011-1z"/></svg>
                                Chat
                            </a>
                            <div class="co-chat-supplier-name">{{ $m->supplier->business_name }}</div>
                        </div>
                        @endforeach
                    @else
                        <div class="co-chat-no-members">No accepted collaborators yet</div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="co-empty"><div class="co-empty-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="10" cy="10" r="7"/><path d="M10 7v3.5l2 1.5"/></svg></div><div class="co-empty-title">No Ongoing Projects</div><div class="co-empty-desc">No projects are currently in progress.</div></div>
        @endforelse
    </div>

    {{-- ═══════════════════════════════
         COMPLETED PANEL
    ═══════════════════════════════ --}}
    <div id="panel-completed" style="display:none;">
        @forelse($completed as $project)
        @php
            $members = $project->members ?? collect();
            $p = ['id'=>$project->id,'title'=>$project->title,'description'=>$project->description,'event_date'=>$project->event_date,'location'=>$project->location,'budget'=>$project->budget,'status'=>$project->status,
                  'members'=>$members->map(fn($m)=>['id'=>$m->id,'name'=>$m->supplier->business_name??'Supplier','role'=>$m->role,'price'=>$m->agreed_price,'status'=>$m->status,'deleteUrl'=>route('collaboration.members.destroy',$m->id)])->values()->toArray(),
                  'editUrl'=>'','completeUrl'=>'','deleteUrl'=>route('collaborations.destroy',$project->id),'showUrl'=>route('collaborations.show',$project->id)];
        @endphp
        <div class="co-card">
            <div class="co-card-accent {{ $project->status }}"></div>
            <div class="co-card-inner">
                <div class="co-card-body">
                    <div class="co-card-top">
                        <div class="co-card-name">{{ $project->title }}</div>
                        <span class="co-badge {{ $project->status }}">{{ ucfirst($project->status) }}</span>
                    </div>
                    @if($project->description)<div class="co-card-desc">{{ $project->description }}</div>@endif
                    <div class="co-card-meta">
                        @if($project->event_date)<div class="co-meta-item"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="2.5" width="12" height="10" rx="1.5"/><path d="M1 6h12M4.5 1v2.5M9.5 1v2.5"/></svg>{{ \Carbon\Carbon::parse($project->event_date)->format('M d, Y') }}</div>@endif
                        @if($project->location)<div class="co-meta-item"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 1C4.8 1 3 2.8 3 5c0 3.5 4 8 4 8s4-4.5 4-8c0-2.2-1.8-4-4-4z"/><circle cx="7" cy="5" r="1.5"/></svg>{{ $project->location }}</div>@endif
                        @if($project->budget)<div class="co-meta-item"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="5"/><path d="M7 4.5v5M5.5 6h3a1 1 0 010 2H6a1 1 0 000 2h3"/></svg>₱{{ number_format($project->budget,2) }}</div>@endif
                    </div>
                    @if($members->count())<div class="co-members-row">@foreach($members as $m)<span class="co-member-chip {{ $m->status }}">{{ $m->supplier->business_name??'Supplier' }}</span>@endforeach</div>@endif
                    <div class="co-card-foot">
                        <div class="co-card-actions">
                            <button type="button" class="co-action-btn" onclick='openViewModal({{ json_encode($p) }})'><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="5.5"/><path d="M4.5 7c.8-1.5 1.4-2 2.5-2s1.7.5 2.5 2c-.8 1.5-1.4 2-2.5 2s-1.7-.5-2.5-2z"/><circle cx="7" cy="7" r="1.2"/></svg>View</button>
                            <button type="button" class="co-action-btn danger" onclick='openDeleteModal({{ $project->id }},{{ json_encode($project->title) }},{{ json_encode(route("collaborations.destroy",$project->id)) }})'><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 3.5h10M5 3.5V2h4v1.5M5.5 6v5M8.5 6v5M3 3.5l.7 8.5h6.6L11 3.5H3z"/></svg>Delete</button>
                        </div>
                    </div>
                </div>
                <div class="co-chat-panel">
                    <div class="co-chat-label">Chat with</div>
                    @php $chatMembers = $members->filter(fn($m) => $m->supplier && $m->supplier->user_id != auth()->id() && $m->status === 'accepted'); @endphp
                    @if($chatMembers->count())
                        @foreach($chatMembers as $m)
                        <div>
                            <a href="{{ route('messages.open', $m->supplier->user_id) }}" class="co-chat-btn">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M2 2h16a1 1 0 011 1v10a1 1 0 01-1 1H5l-4 4V3a1 1 0 011-1z"/></svg>
                                Chat
                            </a>
                            <div class="co-chat-supplier-name">{{ $m->supplier->business_name }}</div>
                        </div>
                        @endforeach
                    @else
                        <div class="co-chat-no-members">No collaborators</div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="co-empty"><div class="co-empty-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="7"/></svg></div><div class="co-empty-title">No Completed Projects</div><div class="co-empty-desc">Completed projects will appear here.</div></div>
        @endforelse
    </div>

</div>{{-- /co-page --}}

{{-- ════════ MODAL: CREATE ════════ --}}
<div class="mo-overlay" id="createOverlay" onclick="if(event.target===this)closeModal('createOverlay')">
    <div class="mo-box">
        <div class="mo-head">
            <div class="mo-head-l">
                <div class="mo-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="3" width="14" height="14" rx="2"/><path d="M7 10h6M10 7v6"/></svg></div>
                <div class="mo-title">New Collaboration Project</div>
            </div>
            <button type="button" class="mo-close" onclick="closeModal('createOverlay')"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg></button>
        </div>
        <form action="{{ route('collaborations.store') }}" method="POST" style="display:contents;">
            @csrf
            <div class="mo-body">
                <div class="mo-sep-lbl">Project Details</div>
                <div class="mo-fg">
                    <div class="mo-fg-full">
                        <label class="mo-lbl">Project Title <span class="mo-req">Required</span></label>
                        <input type="text" name="title" class="mo-inp" placeholder="e.g. Grand Wedding Collab 2025" required value="{{ old('title') }}">
                    </div>
                    <div>
                        <label class="mo-lbl">Event Date <span class="mo-opt">Optional</span></label>
                        <input type="date" name="event_date" class="mo-inp" value="{{ old('event_date') }}">
                    </div>
                    <div>
                        <label class="mo-lbl">Location <span class="mo-opt">Optional</span></label>
                        <input type="text" name="location" class="mo-inp" placeholder="e.g. Cebu City" value="{{ old('location') }}">
                    </div>
                    <div class="mo-fg-full">
                        <label class="mo-lbl">Description <span class="mo-opt">Optional</span></label>
                        <textarea name="description" class="mo-ta" placeholder="Describe the project scope and goals…">{{ old('description') }}</textarea>
                    </div>
                    <div class="mo-fg-full">
                        <label class="mo-lbl">Budget <span class="mo-opt">Optional</span></label>
                        <input type="number" step="0.01" min="0" name="budget" class="mo-inp" placeholder="e.g. 50000" value="{{ old('budget') }}">
                        <div class="mo-hnt">Amount in Philippine Peso (₱)</div>
                    </div>
                </div>
                <div class="mo-sep"></div>
                <div class="mo-sep-lbl">Invite Supplier <span style="font-size:.55rem;color:#C0B8B0;font-weight:400;text-transform:none;letter-spacing:0;margin-left:.3rem;">Optional</span></div>
                <div class="mo-fg">
                    <div class="mo-fg-full">
                        <label class="mo-lbl">Select Supplier</label>
                        <div class="mo-sw">
                            <select name="supplier_profile_id" class="mo-sel">
                                <option value="">— Choose Supplier —</option>
                                @foreach($suppliers as $s)
                                <option value="{{ $s->id }}" {{ old('supplier_profile_id')==$s->id?'selected':'' }}>{{ $s->business_name }} ({{ $s->first_name }} {{ $s->last_name }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="mo-lbl">Role</label>
                        <input type="text" name="role" class="mo-inp" placeholder="e.g. Photographer" value="{{ old('role') }}">
                    </div>
                    <div>
                        <label class="mo-lbl">Agreed Price</label>
                        <input type="number" step="0.01" min="0" name="agreed_price" class="mo-inp" placeholder="e.g. 10000" value="{{ old('agreed_price') }}">
                    </div>
                    <div class="mo-fg-full">
                        <label class="mo-lbl">Responsibilities</label>
                        <textarea name="responsibilities" class="mo-ta" style="min-height:65px;" placeholder="Tasks and responsibilities…">{{ old('responsibilities') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="mo-foot">
                <button type="button" class="mo-btn-cancel" onclick="closeModal('createOverlay')">Cancel</button>
                <button type="submit" class="mo-btn-save"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 7h10M8 3l4 4-4 4"/></svg>Create &amp; Send Invitation</button>
            </div>
        </form>
    </div>
</div>

{{-- ════════ MODAL: INVITATIONS ════════ --}}
<div class="mo-overlay" id="invitationsOverlay" onclick="if(event.target===this)closeModal('invitationsOverlay')">
    <div class="mo-box mo-md">
        <div class="mo-head">
            <div class="mo-head-l">
                <div class="mo-icon warning"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="4" width="16" height="12" rx="2"/><path d="M2 7l8 5 8-5"/></svg></div>
                <div class="mo-title">Incoming Invitations</div>
            </div>
            <button type="button" class="mo-close" onclick="closeModal('invitationsOverlay')"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg></button>
        </div>
        <div class="mo-body">
            @forelse($invites as $invite)
            <div class="inv-item">
                <div class="inv-item-title">{{ $invite->collaboration->title ?? 'Untitled Project' }}</div>
                <div class="inv-item-owner">From <strong>{{ $invite->collaboration->owner->business_name ?? 'Unknown Supplier' }}</strong></div>
                <div class="inv-item-meta">
                    @if($invite->role)<strong>Role:</strong> {{ $invite->role }}<br>@endif
                    @if($invite->responsibilities)<strong>Tasks:</strong> {{ $invite->responsibilities }}<br>@endif
                    @if($invite->agreed_price)<strong>Price:</strong> ₱{{ number_format($invite->agreed_price,2) }}<br>@endif
                </div>
                <div class="inv-item-foot">
                    <span class="co-badge {{ $invite->status }}">{{ ucfirst($invite->status) }}</span>
                    @if($invite->status === 'pending')
                    <div class="inv-item-actions">
                        <form action="{{ route('collaboration.members.accept',$invite->id) }}" method="POST" style="display:contents;">
                            @csrf @method('PATCH')
                            <button type="submit" class="mo-btn-accept"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 7l4 4 6-6"/></svg>Accept</button>
                        </form>
                        <form action="{{ route('collaboration.members.reject',$invite->id) }}" method="POST" style="display:contents;">
                            @csrf @method('PATCH')
                            <button type="submit" class="mo-btn-reject"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 2l10 10M12 2L2 12"/></svg>Reject</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="inv-empty">
                <div class="inv-empty-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="16" height="12" rx="2"/><path d="M2 7l8 5 8-5"/></svg></div>
                <p>No incoming invitations yet.<br>Invitations from other suppliers will appear here.</p>
            </div>
            @endforelse
        </div>
        <div class="mo-foot"><button type="button" class="mo-btn-cancel" onclick="closeModal('invitationsOverlay')">Close</button></div>
    </div>
</div>

{{-- ════════ MODAL: VIEW ════════ --}}
<div class="mo-overlay" id="viewOverlay" onclick="if(event.target===this)closeModal('viewOverlay')">
    <div class="mo-box">
        <div class="mo-head">
            <div class="mo-head-l">
                <div class="mo-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="3" width="14" height="14" rx="2"/><path d="M7 7h6M7 10h6M7 13h4"/></svg></div>
                <div class="mo-title" id="vm_title">Project Details</div>
            </div>
            <button type="button" class="mo-close" onclick="closeModal('viewOverlay')"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg></button>
        </div>
        <div class="mo-body">
            <div style="margin-bottom:1rem;"><span class="co-badge" id="vm_badge"></span></div>
            <div class="mv-grid">
                <div class="mv-field"><div class="mv-key">Title</div><div class="mv-val" id="vm_name">—</div></div>
                <div class="mv-field"><div class="mv-key">Event Date</div><div class="mv-val" id="vm_date">—</div></div>
                <div class="mv-field"><div class="mv-key">Location</div><div class="mv-val" id="vm_location">—</div></div>
                <div class="mv-field"><div class="mv-key">Budget</div><div class="mv-val" id="vm_budget">—</div></div>
                <div class="mv-field mv-full" id="vm_desc_wrap" style="display:none;"><div class="mv-key">Description</div><div class="mv-val" id="vm_desc" style="white-space:pre-wrap;font-size:.8rem;color:var(--warm-grey);"></div></div>
            </div>
            <div style="margin-top:.75rem;"><div class="mo-sep-lbl" style="margin-bottom:.55rem;">Members</div><div id="vm_members"></div></div>
            <div id="vm_actions" style="display:flex;gap:.5rem;flex-wrap:wrap;margin-top:1rem;padding-top:1rem;border-top:1px dashed var(--border);"></div>
        </div>
        <div class="mo-foot">
            <button type="button" class="mo-btn-cancel" onclick="closeModal('viewOverlay')">Close</button>
            <button type="button" class="mo-btn-save" id="vm_edit_btn"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M9.5 1.5l3 3L4 13H1v-3L9.5 1.5z"/></svg>Edit Project</button>
        </div>
    </div>
</div>

{{-- ════════ MODAL: EDIT ════════ --}}
<div class="mo-overlay" id="editOverlay" onclick="if(event.target===this)closeModal('editOverlay')">
    <div class="mo-box">
        <div class="mo-head">
            <div class="mo-head-l">
                <div class="mo-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M13.5 2.5l4 4L6 18H2v-4L13.5 2.5z"/></svg></div>
                <div class="mo-title">Edit Project</div>
            </div>
            <button type="button" class="mo-close" onclick="closeModal('editOverlay')"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg></button>
        </div>
        <form id="editForm" method="POST" style="display:contents;">
            @csrf @method('PUT')
            <div class="mo-body">
                <div class="mo-fg">
                    <div class="mo-fg-full"><label class="mo-lbl">Project Title <span class="mo-req">Required</span></label><input type="text" name="title" id="edit_title" class="mo-inp" required></div>
                    <div><label class="mo-lbl">Event Date <span class="mo-opt">Optional</span></label><input type="date" name="event_date" id="edit_date" class="mo-inp"></div>
                    <div><label class="mo-lbl">Status</label><div class="mo-sw"><select name="status" id="edit_status" class="mo-sel"><option value="upcoming">Upcoming</option><option value="ongoing">Ongoing</option><option value="completed">Completed</option></select></div></div>
                    <div><label class="mo-lbl">Location <span class="mo-opt">Optional</span></label><input type="text" name="location" id="edit_location" class="mo-inp" placeholder="e.g. Cebu City"></div>
                    <div><label class="mo-lbl">Budget <span class="mo-opt">Optional</span></label><input type="number" step="0.01" min="0" name="budget" id="edit_budget" class="mo-inp" placeholder="0.00"></div>
                    <div class="mo-fg-full"><label class="mo-lbl">Description <span class="mo-opt">Optional</span></label><textarea name="description" id="edit_desc" class="mo-ta" placeholder="Project description…"></textarea></div>
                </div>
            </div>
            <div class="mo-foot">
                <button type="button" class="mo-btn-cancel" onclick="closeModal('editOverlay')">Cancel</button>
                <button type="submit" class="mo-btn-save" id="editSaveBtn"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 7l4 4 6-6"/></svg>Update Project</button>
            </div>
        </form>
    </div>
</div>

{{-- ════════ MODAL: COMPLETE ════════ --}}
<div class="mo-overlay" id="completeOverlay" onclick="if(event.target===this)closeModal('completeOverlay')">
    <div class="mo-box mo-sm">
        <div class="mo-head">
            <div class="mo-head-l"><div class="mo-icon success"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="7"/></svg></div><div class="mo-title">Mark as Complete</div></div>
            <button type="button" class="mo-close" onclick="closeModal('completeOverlay')"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg></button>
        </div>
        <div class="mo-body">
            <div class="mo-confirm-box success">
                <div class="mo-confirm-icon success"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M5 13l4 4L19 7"/></svg></div>
                <div class="mo-confirm-text"><h4>Mark as Completed?</h4><p>You're marking <strong id="complete_name"></strong> as completed. It will move to the Completed tab.</p></div>
            </div>
        </div>
        <div class="mo-foot">
            <button type="button" class="mo-btn-cancel" onclick="closeModal('completeOverlay')">Not Yet</button>
            <form id="completeForm" method="POST" style="display:contents;">
                @csrf @method('PATCH')
                <button type="submit" class="mo-btn-complete" id="completeBtn"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 7l4 4 6-6"/></svg>Yes, Complete</button>
            </form>
        </div>
    </div>
</div>

{{-- ════════ MODAL: DELETE ════════ --}}
<div class="mo-overlay" id="deleteOverlay" onclick="if(event.target===this)closeModal('deleteOverlay')">
    <div class="mo-box mo-sm">
        <div class="mo-head">
            <div class="mo-head-l"><div class="mo-icon danger"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M3 5.5h14M7 5.5V3.5h6v2M4.5 5.5l.75 11h9.5l.75-11H4.5z"/></svg></div><div class="mo-title">Delete Project</div></div>
            <button type="button" class="mo-close" onclick="closeModal('deleteOverlay')"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg></button>
        </div>
        <div class="mo-body">
            <div class="mo-confirm-box danger">
                <div class="mo-confirm-icon danger"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>
                <div class="mo-confirm-text"><h4>Delete Project?</h4><p>Permanently deleting <strong id="delete_name"></strong>. All members and invitations will be removed. This cannot be undone.</p></div>
            </div>
        </div>
        <div class="mo-foot">
            <button type="button" class="mo-btn-cancel" onclick="closeModal('deleteOverlay')">Keep It</button>
            <form id="deleteForm" method="POST" style="display:contents;">
                @csrf @method('DELETE')
                <button type="submit" class="mo-btn-danger" id="deleteBtn"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3.5h10M5 3.5V2h4v1.5M5.5 6v5M8.5 6v5M3 3.5l.7 8.5h6.6L11 3.5H3z"/></svg>Yes, Delete</button>
            </form>
        </div>
    </div>
</div>

<script>
function openModal(id)  { document.getElementById(id).classList.add('open');    document.body.style.overflow='hidden'; }
function closeModal(id) { document.getElementById(id).classList.remove('open'); document.body.style.overflow=''; }
document.addEventListener('keydown',function(e){ if(e.key!=='Escape')return; ['createOverlay','invitationsOverlay','viewOverlay','editOverlay','completeOverlay','deleteOverlay'].forEach(closeModal); });

function switchTab(tab,btn){
    ['upcoming','ongoing','completed'].forEach(function(t){
        document.getElementById('panel-'+t).style.display=t===tab?'':'none';
        var b=document.getElementById('tab-'+t);
        b.className='co-tab tab-'+t+(t===tab?' active':'');
    });
}

function openViewModal(data){
    var s=(data.status||'upcoming').toLowerCase();
    document.getElementById('vm_title').textContent   = data.title||'Project Details';
    document.getElementById('vm_name').textContent    = data.title||'—';
    document.getElementById('vm_date').textContent    = data.event_date ? fmtDate(data.event_date) : '—';
    document.getElementById('vm_location').textContent= data.location||'—';
    document.getElementById('vm_budget').textContent  = data.budget ? '₱'+Number(data.budget).toLocaleString('en-PH',{minimumFractionDigits:2}) : '—';
    var dw=document.getElementById('vm_desc_wrap');
    if(data.description){document.getElementById('vm_desc').textContent=data.description;dw.style.display='';}else{dw.style.display='none';}
    var badge=document.getElementById('vm_badge'); badge.className='co-badge '+s; badge.textContent=ucFirst(s);
    var mEl=document.getElementById('vm_members');
    if(data.members&&data.members.length){
        mEl.innerHTML=data.members.map(function(m){
            return '<div class="mv-member-row"><div class="mv-member-info"><div class="mv-member-name">'+escH(m.name)+'</div><div class="mv-member-role">'+escH(m.role||'')+(m.price?' · ₱'+Number(m.price).toLocaleString('en-PH'):'')+'</div></div>'+
            '<div style="display:flex;align-items:center;gap:.4rem;"><span class="co-badge '+m.status+'" style="font-size:.58rem;padding:.1rem .48rem;">'+ucFirst(m.status)+'</span>'+
            '<form method="POST" action="'+m.deleteUrl+'" style="display:contents;"><input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="DELETE">'+
            '<button type="submit" class="mv-del-btn"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3.5h10M5 3.5V2h4v1.5M5.5 6v5M8.5 6v5M3 3.5l.7 8.5h6.6L11 3.5H3z"/></svg>Remove</button></form></div></div>';
        }).join('');
    }else{mEl.innerHTML='<div style="font-size:.78rem;color:var(--warm-grey);font-style:italic;">No members invited yet.</div>';}
    var acts=document.getElementById('vm_actions'); acts.innerHTML='';
    if(s!=='completed'&&data.completeUrl){var bc=document.createElement('button');bc.type='button';bc.className='mo-btn-complete';bc.innerHTML='<svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 7l4 4 6-6"/></svg> Mark Complete';bc.onclick=function(){closeModal('viewOverlay');openCompleteModal(data.id,data.title,data.completeUrl);};acts.appendChild(bc);}
    if(data.deleteUrl){var bd=document.createElement('button');bd.type='button';bd.className='mo-btn-danger';bd.innerHTML='<svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3.5h10M5 3.5V2h4v1.5M5.5 6v5M8.5 6v5M3 3.5l.7 8.5h6.6L11 3.5H3z"/></svg> Delete';bd.onclick=function(){closeModal('viewOverlay');openDeleteModal(data.id,data.title,data.deleteUrl);};acts.appendChild(bd);}
    document.getElementById('vm_edit_btn').onclick=function(){closeModal('viewOverlay');openEditModal(data);};
    openModal('viewOverlay');
}

function openEditModal(data){
    document.getElementById('editForm').action=data.editUrl||'';
    document.getElementById('edit_title').value=data.title||'';
    document.getElementById('edit_date').value=data.event_date||'';
    document.getElementById('edit_desc').value=data.description||'';
    document.getElementById('edit_location').value=data.location||'';
    document.getElementById('edit_budget').value=data.budget||'';
    var sel=document.getElementById('edit_status');
    for(var i=0;i<sel.options.length;i++) sel.options[i].selected=(sel.options[i].value===(data.status||'upcoming'));
    openModal('editOverlay');
    setTimeout(function(){document.getElementById('edit_title').focus();},80);
}
document.getElementById('editForm').addEventListener('submit',function(){var b=document.getElementById('editSaveBtn');b.disabled=true;b.textContent='Saving…';});

function openCompleteModal(id,name,url){
    document.getElementById('complete_name').textContent='"'+name+'"';
    document.getElementById('completeForm').action=url;
    var b=document.getElementById('completeBtn');b.disabled=false;
    b.innerHTML='<svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 7l4 4 6-6"/></svg> Yes, Complete';
    openModal('completeOverlay');
}
document.getElementById('completeForm').addEventListener('submit',function(){var b=document.getElementById('completeBtn');b.disabled=true;b.textContent='Completing…';});

function openDeleteModal(id,name,url){
    document.getElementById('delete_name').textContent='"'+name+'"';
    document.getElementById('deleteForm').action=url;
    var b=document.getElementById('deleteBtn');b.disabled=false;
    b.innerHTML='<svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3.5h10M5 3.5V2h4v1.5M5.5 6v5M8.5 6v5M3 3.5l.7 8.5h6.6L11 3.5H3z"/></svg> Yes, Delete';
    openModal('deleteOverlay');
}
document.getElementById('deleteForm').addEventListener('submit',function(){var b=document.getElementById('deleteBtn');b.disabled=true;b.textContent='Deleting…';});

function fmtDate(s){if(!s)return'—';try{var d=new Date(s+'T00:00:00');return d.toLocaleDateString('en-PH',{year:'numeric',month:'long',day:'numeric'});}catch(e){return s;}}
function ucFirst(s){return s?s.charAt(0).toUpperCase()+s.slice(1):s;}
function escH(s){return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');}

@if($errors->any()) openModal('createOverlay'); @endif
</script>

</x-supplier-layout>