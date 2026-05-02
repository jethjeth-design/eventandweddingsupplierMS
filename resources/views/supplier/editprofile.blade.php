<x-supplier-layout>
<style>
/* ── Variables (referenced from layout, ensure fallbacks) ── */
:root{
    --gold:#C9A84C; --gold-dark:#A8842A;
    --charcoal:#1E1B18; --warm-grey:#8C8178;
    --white:#fff; --ivory:#FAF8F5;
}

/* ══ PAGE HEADER ══ */
.bv-page-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;}
.bv-page-title{font-family:var(--font-display);font-size:1.75rem;font-weight:700;color:var(--charcoal);line-height:1.1;}
.bv-page-title em{font-style:italic;color:var(--gold-dark);}
.bv-page-sub{font-size:0.8rem;color:var(--warm-grey);margin-top:0.3rem;}

/* ══ LAYOUT ══ */
.bv-pi-layout{display:flex;flex-direction:column;gap:1.25rem;}
.bv-main-stack{display:flex;flex-direction:column;gap:1.25rem;}

/* ══ IDENTITY CARD ══ */
.bv-id-card{background:var(--white);border-radius:14px;border:1px solid #F0EBE5;overflow:hidden;box-shadow:0 2px 8px rgba(30,27,24,.06);}

/* ── Banner ── */
.bv-id-banner{height:200px;background:linear-gradient(135deg,var(--charcoal) 0%,#2a2016 60%,#3d2f14 100%);position:relative;overflow:hidden;}
.bv-id-banner-img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block;}
.bv-id-banner-overlay{position:absolute;inset:0;background:rgba(30,27,24,.18);pointer-events:none;}
.bv-cover-btn{
    position:absolute;bottom:10px;right:12px;
    display:inline-flex;align-items:center;gap:.4rem;
    padding:.38rem .85rem;border-radius:8px;
    background:rgba(30,27,24,.62);border:1.5px solid rgba(255,255,255,.22);
    backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px);
    font-family:var(--font-body);font-size:.7rem;font-weight:500;
    color:rgba(255,255,255,.92);cursor:pointer;z-index:3;
    transition:background .2s,border-color .2s,transform .15s;
}
.bv-cover-btn svg{width:12px;height:12px;flex-shrink:0;}
.bv-cover-btn:hover{background:rgba(201,168,76,.78);border-color:rgba(201,168,76,.5);transform:translateY(-1px);}

/* ── Card inner ── */
.bv-id-inner{display:flex;align-items:flex-start;gap:1.75rem;padding:0 2rem 1.75rem;flex-wrap:wrap;}

/* ── Avatar ── */
.bv-id-avatar-wrap{position:relative;width:110px;height:110px;margin-top:-55px;flex-shrink:0;z-index:2;}
.bv-id-avatar{
    width:110px;height:110px;border-radius:50%;
    background:linear-gradient(135deg,var(--gold) 0%,var(--gold-dark) 100%);
    display:flex;align-items:center;justify-content:center;
    font-family:var(--font-display);font-size:2.4rem;font-weight:700;
    color:var(--white);overflow:hidden;
    border:4px solid var(--white);box-shadow:0 4px 16px rgba(30,27,24,.18);
}
.bv-id-avatar img{width:100%;height:100%;object-fit:cover;display:none;}
.bv-id-avatar.has-photo img{display:block;}
.bv-id-avatar.has-photo span{display:none;}
.bv-id-photo-badge{
    position:absolute;bottom:4px;right:4px;
    width:28px;height:28px;border-radius:50%;
    background:var(--gold);border:2.5px solid var(--white);
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;box-shadow:0 2px 6px rgba(30,27,24,.15);
    transition:background .2s;
}
.bv-id-photo-badge:hover{background:var(--gold-dark);}
.bv-id-photo-badge svg{width:11px;height:11px;color:var(--charcoal);}

/* ── Info block ── */
.bv-id-info{flex:1;min-width:0;padding-top:.85rem;}
.bv-id-name{font-family:var(--font-display);font-size:1.3rem;font-weight:700;color:var(--charcoal);margin-bottom:.15rem;line-height:1.2;}
.bv-id-category{font-size:.7rem;color:var(--gold-dark);letter-spacing:.05em;font-weight:600;text-transform:uppercase;margin-bottom:.6rem;}
.bv-id-badge{
    display:inline-flex;align-items:center;gap:.35rem;
    padding:.22rem .75rem;border-radius:999px;
    background:rgba(201,168,76,.1);color:var(--gold-dark);
    font-size:.65rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;
}
.bv-id-badge::before{content:'';width:5px;height:5px;border-radius:50%;background:var(--gold);}

/* ── Photo zone ── */
.bv-id-photo-zone{
    display:flex;align-items:center;gap:.9rem;
    padding:.85rem 1rem;margin-top:1rem;
    background:rgba(201,168,76,.04);border:1px dashed rgba(201,168,76,.3);
    border-radius:10px;min-width:240px;align-self:flex-end;flex-shrink:0;
}
.bv-pez-thumb{
    width:56px;height:56px;border-radius:50%;flex-shrink:0;overflow:hidden;
    border:2px solid rgba(201,168,76,.25);
    background:linear-gradient(135deg,var(--gold),var(--gold-dark));
    display:flex;align-items:center;justify-content:center;
    font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--white);
}
.bv-pez-thumb img{width:100%;height:100%;object-fit:cover;display:none;}
.bv-pez-thumb.has-photo img{display:block;}
.bv-pez-thumb.has-photo span{display:none;}
.bv-pez-info p{font-size:.68rem;color:var(--warm-grey);margin-bottom:.4rem;line-height:1.4;}
.bv-ul-btn{
    display:inline-flex;align-items:center;gap:.35rem;
    padding:.38rem .8rem;border-radius:6px;
    border:1.5px solid #E5DDD5;background:var(--white);
    font-family:var(--font-body);font-size:.72rem;font-weight:500;color:var(--charcoal);
    cursor:pointer;transition:border-color .2s,color .2s,background .2s;
}
.bv-ul-btn svg{width:11px;height:11px;}
.bv-ul-btn:hover{border-color:var(--gold);color:var(--gold-dark);background:rgba(201,168,76,.05);}

/* ── Tips strip ── */
.bv-id-tips-strip{display:flex;gap:.6rem;flex-wrap:wrap;padding:.85rem 2rem;border-top:1px solid #F7F3EF;background:rgba(201,168,76,.02);}
.bv-id-tip-pill{display:flex;align-items:flex-start;gap:.4rem;font-size:.7rem;color:var(--warm-grey);line-height:1.4;flex:1;min-width:180px;}
.bv-id-tip-pill::before{content:'';width:4px;height:4px;border-radius:50%;background:var(--gold);flex-shrink:0;margin-top:.45rem;}

/* ══ SECTION CARDS ══ */
.bv-sc{background:var(--white);border-radius:12px;border:1px solid #F0EBE5;overflow:hidden;box-shadow:0 1px 4px rgba(30,27,24,.04);}
.bv-sc-head{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.4rem;border-bottom:1px solid #F7F3EF;}
.bv-sc-head-l{display:flex;align-items:center;gap:.65rem;}
.bv-sc-icon{width:32px;height:32px;border-radius:8px;background:rgba(201,168,76,.1);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
.bv-sc-icon svg{width:15px;height:15px;}
.bv-sc-title{font-family:var(--font-display);font-size:.9rem;font-weight:700;color:var(--charcoal);}
.bv-sc-desc{font-size:.7rem;color:var(--warm-grey);margin-top:.06rem;}
.bv-sc-body{padding:1.35rem 1.4rem;}
.bv-sc-foot{padding:.85rem 1.4rem;border-top:1px solid #F7F3EF;display:flex;align-items:center;justify-content:space-between;gap:.55rem;}

/* ══ FIELDS ══ */
.bv-fg{display:grid;grid-template-columns:repeat(2,1fr);gap:.9rem;}
.bv-fg-full{grid-column:1/-1;}
.bv-f{margin-bottom:0;}
.bv-lbl{display:flex;align-items:center;justify-content:space-between;font-size:.68rem;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:var(--warm-grey);margin-bottom:.38rem;}
.bv-req{font-size:.58rem;color:#C0392B;font-weight:500;text-transform:none;letter-spacing:0;}
.bv-opt{font-size:.58rem;color:#C0B8B0;font-weight:400;text-transform:none;letter-spacing:0;}
.bv-inp,.bv-ta,.bv-sel{
    width:100%;padding:.68rem .9rem;
    background:var(--ivory);border:1.5px solid #E5DDD5;border-radius:8px;
    font-family:var(--font-body);font-size:.84rem;color:var(--charcoal);
    outline:none;appearance:none;display:block;
    transition:border-color .2s,box-shadow .2s,background .2s;
}
.bv-inp:focus,.bv-ta:focus,.bv-sel:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,.12);background:var(--white);}
.bv-inp::placeholder,.bv-ta::placeholder{color:#C0B8B0;}
.bv-ta{resize:vertical;min-height:90px;}
.bv-iw{position:relative;}
.bv-ico{position:absolute;left:.8rem;top:50%;transform:translateY(-50%);width:14px;height:14px;color:#C0B8B0;pointer-events:none;}
.bv-iw:focus-within .bv-ico{color:var(--gold-dark);}
.bv-iw .bv-inp{padding-left:2.35rem;}
.bv-sw{position:relative;}
.bv-sw::after{content:'';position:absolute;right:.85rem;top:50%;transform:translateY(-50%);width:0;height:0;border-left:4px solid transparent;border-right:4px solid transparent;border-top:5px solid #C0B8B0;pointer-events:none;}
.bv-err{font-size:.68rem;color:#C0392B;margin-top:.28rem;}
.bv-hnt{font-size:.68rem;color:#C0B8B0;margin-top:.28rem;}
.bv-cf{display:flex;justify-content:flex-end;margin-top:.22rem;}
.bv-cc{font-size:.63rem;color:#C0B8B0;}

/* ══ CATEGORY CHIPS ══ */
.cat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:.55rem;margin-top:.25rem;}
.cat-chip{
    position:relative;display:flex;align-items:center;gap:.45rem;
    padding:.52rem .75rem;border:1.5px solid #E5DDD5;border-radius:8px;
    background:var(--ivory);cursor:pointer;user-select:none;
    transition:border-color .18s,background .18s,box-shadow .18s;
}
.cat-chip input[type="checkbox"]{position:absolute;opacity:0;width:0;height:0;pointer-events:none;}
.cat-chip:hover{border-color:rgba(201,168,76,.5);background:rgba(201,168,76,.04);}
.cat-chip-icon{width:26px;height:26px;border-radius:6px;flex-shrink:0;background:rgba(201,168,76,.1);display:flex;align-items:center;justify-content:center;transition:background .18s;}
.cat-chip-icon svg{width:13px;height:13px;color:var(--gold-dark);}
.cat-chip-name{font-size:.75rem;font-weight:500;color:var(--charcoal);font-family:var(--font-body);line-height:1.2;flex:1;min-width:0;}
.cat-chip-check{position:absolute;top:5px;right:6px;width:14px;height:14px;border-radius:50%;border:1.5px solid #E5DDD5;background:var(--white);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .18s;}
.cat-chip-check svg{width:7px;height:7px;color:var(--white);opacity:0;transition:opacity .15s;}
.cat-chip.selected{border-color:var(--gold);background:rgba(201,168,76,.08);box-shadow:0 0 0 3px rgba(201,168,76,.12);}
.cat-chip.selected .cat-chip-icon{background:rgba(201,168,76,.2);}
.cat-chip.selected .cat-chip-check{background:var(--gold);border-color:var(--gold);}
.cat-chip.selected .cat-chip-check svg{opacity:1;}
.cat-chip.selected .cat-chip-name{color:var(--gold-dark);font-weight:600;}
.cat-selected-count{font-size:.65rem;color:var(--gold-dark);font-family:var(--font-body);margin-top:.5rem;display:none;}
.cat-selected-count.show{display:block;}

/* ══ BUTTONS ══ */
.bv-btn-save{
    display:inline-flex;align-items:center;gap:.45rem;
    padding:.62rem 1.5rem;border-radius:6px;border:none;
    background:var(--charcoal);font-family:var(--font-body);font-size:.82rem;font-weight:500;color:var(--white);
    cursor:pointer;transition:background .2s,box-shadow .2s,transform .15s;
}
.bv-btn-save svg{width:13px;height:13px;}
.bv-btn-save:hover{background:var(--gold-dark);box-shadow:0 4px 12px rgba(201,168,76,.2);transform:translateY(-1px);}
.bv-btn-back{
    display:inline-flex;align-items:center;gap:.4rem;
    padding:.62rem 1.1rem;border-radius:6px;
    border:1.5px solid #E5DDD5;background:var(--white);
    font-family:var(--font-body);font-size:.82rem;font-weight:500;color:var(--warm-grey);
    text-decoration:none;transition:border-color .2s,color .2s;
}
.bv-btn-back svg{width:12px;height:12px;}
.bv-btn-back:hover{border-color:var(--gold);color:var(--charcoal);}

/* ══ COVER PHOTO MODAL ══ */
.cp-modal-overlay{position:fixed;inset:0;z-index:9000;background:rgba(30,27,24,.6);display:none;align-items:center;justify-content:center;padding:1rem;}
.cp-modal-overlay.open{display:flex;}
.cp-modal{background:var(--white);border-radius:16px;border:1px solid #F0EBE5;box-shadow:0 12px 48px rgba(30,27,24,.22);width:100%;max-width:500px;overflow:hidden;animation:cpSlideIn .22s ease;}
@keyframes cpSlideIn{from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:translateY(0);}}

.cp-modal-head{display:flex;align-items:center;justify-content:space-between;padding:1.1rem 1.4rem;border-bottom:1px solid #F7F3EF;}
.cp-modal-head-l{display:flex;align-items:center;gap:.65rem;}
.cp-modal-icon{width:34px;height:34px;border-radius:9px;background:rgba(201,168,76,.1);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
.cp-modal-icon svg{width:16px;height:16px;}
.cp-modal-title{font-family:var(--font-display);font-size:.98rem;font-weight:700;color:var(--charcoal);}
.cp-modal-sub{font-size:.7rem;color:var(--warm-grey);margin-top:.05rem;}
.cp-modal-close{width:32px;height:32px;border-radius:50%;border:1.5px solid #E5DDD5;background:var(--white);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--warm-grey);flex-shrink:0;transition:border-color .15s,color .15s,background .15s;}
.cp-modal-close:hover{border-color:var(--gold);color:var(--gold-dark);background:rgba(201,168,76,.05);}
.cp-modal-close svg{width:12px;height:12px;}

.cp-modal-body{padding:1.35rem 1.4rem;display:flex;flex-direction:column;gap:1rem;}
.cp-modal-foot{padding:.85rem 1.4rem;border-top:1px solid #F7F3EF;display:flex;align-items:center;justify-content:flex-end;gap:.55rem;}

/* ── Current cover strip ── */
.cp-current-strip{border-radius:10px;overflow:hidden;border:1.5px solid #F0EBE5;position:relative;}
.cp-current-strip img{width:100%;height:110px;object-fit:cover;display:block;}
.cp-current-strip-bar{position:absolute;bottom:0;left:0;right:0;background:rgba(30,27,24,.6);backdrop-filter:blur(3px);padding:.4rem .75rem;display:flex;align-items:center;justify-content:space-between;}
.cp-current-strip-label{font-size:.65rem;color:rgba(255,255,255,.8);display:flex;align-items:center;gap:.35rem;}
.cp-current-strip-label svg{width:11px;height:11px;color:var(--gold);}
.cp-delete-btn{display:inline-flex;align-items:center;gap:.3rem;padding:.28rem .7rem;border-radius:6px;background:rgba(192,57,43,.85);border:none;font-family:var(--font-body);font-size:.68rem;font-weight:500;color:var(--white);cursor:pointer;transition:background .15s;}
.cp-delete-btn svg{width:11px;height:11px;}
.cp-delete-btn:hover{background:#C0392B;}

/* ── Dropzone ── */
.cp-dropzone{border:2px dashed #E5DDD5;border-radius:10px;padding:1.75rem 1.5rem;text-align:center;cursor:pointer;position:relative;background:rgba(201,168,76,.02);transition:border-color .2s,background .2s;}
.cp-dropzone:hover,.cp-dropzone.drag-over{border-color:var(--gold);background:rgba(201,168,76,.06);}
.cp-dropzone input[type="file"]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;}
.cp-dz-icon{width:44px;height:44px;border-radius:50%;background:rgba(201,168,76,.1);display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;color:var(--gold-dark);}
.cp-dz-icon svg{width:20px;height:20px;}
.cp-dz-label{font-size:.82rem;font-weight:600;color:var(--charcoal);margin-bottom:.25rem;}
.cp-dz-sub{font-size:.72rem;color:#C0B8B0;line-height:1.5;}

/* ── Preview inside modal ── */
.cp-preview-wrap{display:none;border-radius:10px;overflow:hidden;border:1.5px solid #F0EBE5;position:relative;}
.cp-preview-wrap.visible{display:block;}
.cp-preview-wrap img{width:100%;height:140px;object-fit:cover;display:block;}
.cp-preview-clear{position:absolute;top:8px;right:8px;width:28px;height:28px;border-radius:50%;background:rgba(30,27,24,.65);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--white);transition:background .2s;}
.cp-preview-clear:hover{background:rgba(192,57,43,.85);}
.cp-preview-clear svg{width:12px;height:12px;}
.cp-preview-name{font-size:.68rem;color:var(--warm-grey);margin-top:.4rem;display:none;}
.cp-preview-name.show{display:block;}

/* ── Modal buttons ── */
.cp-btn-cancel{display:inline-flex;align-items:center;gap:.4rem;padding:.58rem 1.1rem;border-radius:6px;border:1.5px solid #E5DDD5;background:var(--white);font-family:var(--font-body);font-size:.8rem;font-weight:500;color:var(--warm-grey);cursor:pointer;transition:border-color .2s,color .2s;}
.cp-btn-cancel:hover{border-color:var(--gold);color:var(--charcoal);}
.cp-btn-save{display:inline-flex;align-items:center;gap:.45rem;padding:.58rem 1.4rem;border-radius:6px;border:none;background:var(--charcoal);font-family:var(--font-body);font-size:.8rem;font-weight:500;color:var(--white);cursor:pointer;transition:background .2s,box-shadow .2s,transform .15s;}
.cp-btn-save svg{width:13px;height:13px;}
.cp-btn-save:hover{background:var(--gold-dark);box-shadow:0 4px 12px rgba(201,168,76,.2);transform:translateY(-1px);}
.cp-btn-save:disabled{background:#C0B8B0;cursor:not-allowed;transform:none;box-shadow:none;}

/* ══ CONFIRM DELETE MODAL ══ */
.cp-confirm-overlay{position:fixed;inset:0;z-index:9100;background:rgba(30,27,24,.55);display:none;align-items:center;justify-content:center;padding:1rem;}
.cp-confirm-overlay.open{display:flex;}
.cp-confirm-box{background:var(--white);border-radius:14px;border:1px solid #F0EBE5;box-shadow:0 8px 32px rgba(30,27,24,.18);width:100%;max-width:380px;overflow:hidden;animation:cpSlideIn .2s ease;}
.cp-confirm-body{padding:1.5rem 1.4rem 1rem;text-align:center;}
.cp-confirm-ico{width:52px;height:52px;border-radius:50%;background:#FFF5F5;border:1.5px solid #FADBD8;display:flex;align-items:center;justify-content:center;margin:0 auto .9rem;color:#C0392B;}
.cp-confirm-ico svg{width:22px;height:22px;}
.cp-confirm-title{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--charcoal);margin-bottom:.4rem;}
.cp-confirm-desc{font-size:.8rem;color:var(--warm-grey);line-height:1.6;}
.cp-confirm-foot{padding:.85rem 1.4rem;border-top:1px solid #F7F3EF;display:flex;gap:.55rem;justify-content:center;}
.cp-confirm-cancel{display:inline-flex;align-items:center;gap:.4rem;padding:.58rem 1.2rem;border-radius:6px;border:1.5px solid #E5DDD5;background:var(--white);font-family:var(--font-body);font-size:.8rem;font-weight:500;color:var(--warm-grey);cursor:pointer;transition:border-color .2s,color .2s;}
.cp-confirm-cancel:hover{border-color:var(--gold);color:var(--charcoal);}
.cp-confirm-delete{display:inline-flex;align-items:center;gap:.4rem;padding:.58rem 1.4rem;border-radius:6px;border:none;background:#C0392B;font-family:var(--font-body);font-size:.8rem;font-weight:500;color:var(--white);cursor:pointer;transition:background .2s,transform .15s;}
.cp-confirm-delete svg{width:13px;height:13px;}
.cp-confirm-delete:hover{background:#a93226;transform:translateY(-1px);}

/* ══ RESPONSIVE ══ */
@media(max-width:680px){
    .bv-id-inner{gap:1rem;padding:0 1.25rem 1.25rem;}
    .bv-id-photo-zone{min-width:unset;width:100%;align-self:auto;}
    .bv-id-tips-strip{padding:.85rem 1.25rem;}
}
@media(max-width:640px){.bv-fg{grid-template-columns:1fr;}}
@media(max-width:540px){.cat-grid{grid-template-columns:repeat(2,1fr);}}
@media(max-width:480px){
    .cp-modal-body{padding:1rem;}
    .cp-modal-foot{padding:.75rem 1rem;}
}
</style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit') }}
        </h2>
    </x-slot>
<div class="page-content">

    <div class="bv-page-header">
        <div>
            <h1 class="bv-page-title">Edit Personal <em>Information</em></h1>
            <p class="bv-page-sub">Update your supplier profile details</p>
        </div>
        <a href="{{ route('supplier.supplierprofile', $supplierProfile->id) }}" class="bv-btn-back">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 2L4 7l5 5"/></svg>
            Back to View
        </a>
    </div>

    @php
        $currentCatIds = [];
        if (!empty($supplierProfile->category_id)) {
            $currentCatIds = is_array($supplierProfile->category_id)
                ? $supplierProfile->category_id
                : [$supplierProfile->category_id];
        }
        if (old('category_id')) {
            $currentCatIds = (array) old('category_id');
        }

        $catIcons = [
            'venue'   => '<path d="M2 12L12 3l10 9v9a1 1 0 01-1 1H3a1 1 0 01-1-1v-9z"/>',
            'catering'=> '<path d="M18 8h1a4 4 0 010 8h-1"/><path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/>',
            'photo'   => '<path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/><circle cx="12" cy="13" r="4"/>',
            'video'   => '<polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/>',
            'dj'      => '<circle cx="12" cy="12" r="2"/><circle cx="12" cy="12" r="7"/><line x1="12" y1="1" x2="12" y2="3"/>',
            'makeup'  => '<path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>',
            'gown'    => '<path d="M20.38 3.46L16 2a4 4 0 01-8 0L3.62 3.46a2 2 0 00-1.34 2.23l.58 3.57a1 1 0 00.99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 002-2V10h2.15a1 1 0 00.99-.84l.58-3.57a2 2 0 00-1.34-2.23z"/>',
            'band'    => '<path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/>',
            'emcee'   => '<path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/><path d="M19 10v2a7 7 0 01-14 0v-2"/>',
            'flower'  => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
            'light'   => '<circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>',
            'default' => '<rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>',
        ];
        function catIcon($slug, $icons) {
            $s = strtolower($slug);
            foreach ($icons as $key => $path) {
                if (str_contains($s, $key)) return $path;
            }
            return $icons['default'];
        }

        $previewName = $supplierProfile->business_name
                    ?: trim(($supplierProfile->first_name ?? '').' '.($supplierProfile->last_name ?? ''))
                    ?: Auth::user()->name;

        $previewCat = '';
        if ($supplierProfile->category) {
            $previewCat = is_object($supplierProfile->category)
                ? ($supplierProfile->category->name ?? '')
                : $supplierProfile->category;
        }
    @endphp

    <div class="bv-pi-layout">

        {{-- ══ IDENTITY CARD ══ --}}
        <div class="bv-id-card">

            {{-- ── COVER PHOTO BANNER ── --}}
            <div class="bv-id-banner" id="bvBanner">
                @if(!empty($supplierProfile->cover_photo))
                    <img class="bv-id-banner-img" id="bvBannerImg"
                         src="{{ asset('storage/' . $supplierProfile->cover_photo) }}"
                         alt="Cover photo">
                    <div class="bv-id-banner-overlay" id="bvBannerOverlay"></div>
                @else
                    <img class="bv-id-banner-img" id="bvBannerImg" src="" alt="" style="display:none;">
                @endif
                <button type="button" class="bv-cover-btn" id="bvCoverBtn" onclick="cpOpen()">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M1 5a2 2 0 012-2h1.5l1-1.5h5L11.5 3H13a2 2 0 012 2v7a2 2 0 01-2 2H3a2 2 0 01-2-2V5z"/>
                        <circle cx="8" cy="8.5" r="2.5"/>
                    </svg>
                    <span id="bvCoverBtnLabel">{{ empty($supplierProfile->cover_photo) ? 'Add Cover Photo' : 'Change Cover' }}</span>
                </button>
            </div>

            <div class="bv-id-inner">
                {{-- Big avatar with camera badge --}}
                <div class="bv-id-avatar-wrap">
                    <div class="bv-id-avatar {{ $supplierProfile->photo ? 'has-photo' : '' }}" id="sideAvatar">
                        <img src="{{ $supplierProfile->photo ? asset('storage/'.$supplierProfile->photo) : '' }}"
                             alt="" id="sideAvatarImg"
                             style="{{ $supplierProfile->photo ? '' : 'display:none;' }}">
                        <span id="sideAvatarInitials">{{ strtoupper(substr($supplierProfile->first_name ?? Auth::user()->name, 0, 2)) }}</span>
                    </div>
                    <label for="quickPhoto" class="bv-id-photo-badge" title="Change photo">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M8 1.5l2.5 2.5-7 7H1v-2.5L8 1.5z"/>
                        </svg>
                    </label>
                    <input type="file" id="quickPhoto" accept="image/jpeg,image/png,image/webp"
                           style="display:none" onchange="syncPhoto(this)">
                </div>

                {{-- Name + category + badge --}}
                <div class="bv-id-info">
                    <div class="bv-id-name" id="previewName">{{ $previewName }}</div>
                    <div class="bv-id-category" id="previewCategory">{{ $previewCat ?: 'No Category Set' }}</div>
                    <div class="bv-id-badge">Active Supplier</div>
                </div>

                {{-- Photo upload zone on the right --}}
                <div class="bv-id-photo-zone">
                    <div class="bv-pez-thumb {{ $supplierProfile->photo ? 'has-photo' : '' }}" id="editThumb">
                        <img src="{{ $supplierProfile->photo ? asset('storage/'.$supplierProfile->photo) : '' }}"
                             alt="" id="editThumbImg"
                             style="{{ $supplierProfile->photo ? '' : 'display:none;' }}">
                        <span>{{ strtoupper(substr($supplierProfile->first_name ?? 'U', 0, 2)) }}</span>
                    </div>
                    <div class="bv-pez-info">
                        <p>JPG, PNG or WEBP<br>Max 2MB · Square preferred</p>
                        <input type="file" id="editPhotoInput" name="photo"
                               accept="image/jpeg,image/png,image/webp"
                               style="display:none" onchange="previewPhoto(this)">
                        <label for="editPhotoInput" class="bv-ul-btn">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M8 11V3M5 6l3-3 3 3M3 11v2a1 1 0 001 1h8a1 1 0 001-1v-2"/>
                            </svg>
                            Change Photo
                        </label>
                        <span id="photoName" style="font-size:0.65rem;color:#C0B8B0;display:block;margin-top:0.28rem;"></span>
                        @error('photo')<div class="bv-err" style="margin-top:0.3rem;">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- Tips strip --}}
            <div class="bv-id-tips-strip">
                <div class="bv-id-tip-pill">A real business name helps clients find you in search.</div>
                <div class="bv-id-tip-pill">A strong tagline boosts profile clicks by up to 40%.</div>
                <div class="bv-id-tip-pill">Detailed descriptions win more booking inquiries.</div>
                <div class="bv-id-tip-pill">Suppliers with photos get 3× more bookings.</div>
            </div>
        </div>

        {{-- ══ FORM SECTION CARDS ══ --}}
        <div class="bv-main-stack">

            <form method="POST"
                  action="{{ route('supplier.updateidentity', $supplierProfile->id) }}"
                  enctype="multipart/form-data"
                  id="bvMainForm">
                @csrf
                @method('PUT')

                {{-- Hidden cover_photo input — populated by modal --}}
                <input type="file" id="bvCoverField" name="cover_photo"
                       accept="image/jpeg,image/png,image/webp,image/gif" style="display:none;">

                <div class="bv-sc">
                    <div class="bv-sc-head">
                        <div class="bv-sc-head-l">
                            <div class="bv-sc-icon">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <circle cx="10" cy="7" r="4"/><path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/>
                                </svg>
                            </div>
                            <div>
                                <div class="bv-sc-title">Personal Identity</div>
                                <div class="bv-sc-desc">Name, business identity and category</div>
                            </div>
                        </div>
                    </div>

                    <div class="bv-sc-body">
                        <div class="bv-fg" style="margin-bottom:0.9rem;">
                            {{-- First name --}}
                            <div class="bv-f">
                                <label class="bv-lbl" for="fi_fn">First Name <span class="bv-req">Required</span></label>
                                <div class="bv-iw">
                                    <svg class="bv-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="7" r="4"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                                    <input id="fi_fn" name="first_name" type="text" class="bv-inp"
                                           value="{{ old('first_name', $supplierProfile->first_name) }}"
                                           placeholder="e.g. Maria" required oninput="updatePreview()">
                                </div>
                                @error('first_name')<div class="bv-err">{{ $message }}</div>@enderror
                            </div>

                            {{-- Last name --}}
                            <div class="bv-f">
                                <label class="bv-lbl" for="fi_ln">Last Name <span class="bv-req">Required</span></label>
                                <div class="bv-iw">
                                    <svg class="bv-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="10" cy="7" r="4"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                                    <input id="fi_ln" name="last_name" type="text" class="bv-inp"
                                           value="{{ old('last_name', $supplierProfile->last_name) }}"
                                           placeholder="e.g. Santos" required oninput="updatePreview()">
                                </div>
                                @error('last_name')<div class="bv-err">{{ $message }}</div>@enderror
                            </div>

                            {{-- Business name --}}
                            <div class="bv-f">
                                <label class="bv-lbl" for="fi_bn">Business Name <span class="bv-opt">Optional</span></label>
                                <div class="bv-iw">
                                    <svg class="bv-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="7" width="16" height="10" rx="2"/><path d="M6 7V5a4 4 0 018 0v2"/></svg>
                                    <input id="fi_bn" name="business_name" type="text" class="bv-inp"
                                           value="{{ old('business_name', $supplierProfile->business_name) }}"
                                           placeholder="e.g. Santos Events Studio" oninput="updatePreview()">
                                </div>
                                <p class="bv-hnt">Leave blank to use your full name.</p>
                                @error('business_name')<div class="bv-err">{{ $message }}</div>@enderror
                            </div>

                            {{-- Tagline --}}
                            <div class="bv-f">
                                <label class="bv-lbl" for="fi_tl">Tagline <span class="bv-opt">Optional</span></label>
                                <div class="bv-iw">
                                    <svg class="bv-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M4 6h12M4 10h8M4 14h5"/></svg>
                                    <input id="fi_tl" name="tagline" type="text" class="bv-inp"
                                           value="{{ old('tagline', $supplierProfile->tagline) }}"
                                           placeholder="e.g. Crafting unforgettable moments">
                                </div>
                                @error('tagline')<div class="bv-err">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        {{-- ── CATEGORY CHIPS ── --}}
                        <div>
                            <label class="bv-lbl">Category <span class="bv-req">Required</span></label>
                            <p class="bv-hnt" style="margin-bottom:0.65rem;">Select all that apply to your services.</p>

                            <div class="cat-grid" id="cat-grid">
                                @foreach($categories as $category)
                                @php
                                    $isChecked = in_array($category->id, $currentCatIds);
                                    $icon = catIcon($category->slug ?? $category->name, $catIcons);
                                @endphp
                                <label class="cat-chip {{ $isChecked ? 'selected' : '' }}">
                                    <input type="checkbox"
                                           name="category_id[]"
                                           value="{{ $category->id }}"
                                           {{ $isChecked ? 'checked' : '' }}>
                                    <div class="cat-chip-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                            {!! $icon !!}
                                        </svg>
                                    </div>
                                    <span class="cat-chip-name">{{ $category->name }}</span>
                                    <span class="cat-chip-check">
                                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <polyline points="2 6 5 9 10 3"/>
                                        </svg>
                                    </span>
                                </label>
                                @endforeach
                            </div>

                            <div class="cat-selected-count" id="cat-count"></div>
                            @error('category_id')<div class="bv-err" style="margin-top:0.4rem;">{{ $message }}</div>@enderror
                        </div>
                    </div>{{-- /bv-sc-body --}}

                    <div class="bv-sc-foot">
                        <a href="{{ route('supplier.supplierprofile', $supplierProfile->id) }}" class="bv-btn-back">
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 2L4 7l5 5"/></svg>
                            Cancel
                        </a>
                        <button type="submit" class="bv-btn-save">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg>
                            Save All Changes
                        </button>
                    </div>
                </div>{{-- /bv-sc --}}

            </form>
        </div>

    </div>
</div>

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
                <div>
                    <div class="cp-modal-title">Cover Photo</div>
                    <div class="cp-modal-sub">Profile banner image</div>
                </div>
            </div>
            <button type="button" class="cp-modal-close" onclick="cpModalClose()">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
            </button>
        </div>

        <div class="cp-modal-body">
            @if(!empty($supplierProfile->cover_photo))
            <div class="cp-current-strip" id="cpCurrentStrip">
                <img src="{{ asset('storage/' . $supplierProfile->cover_photo) }}" alt="Current cover">
                <div class="cp-current-strip-bar">
                    <span class="cp-current-strip-label">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2"><polyline points="2 6 5 9 10 3"/></svg>
                        Current cover photo
                    </span>
                    <button type="button" class="cp-delete-btn" onclick="cpConfirmDelete()">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 3.5h10M5 3.5V2.5h4v1M4.5 3.5v7a1 1 0 001 1h3a1 1 0 001-1v-7"/></svg>
                        Remove
                    </button>
                </div>
            </div>
            @endif

            <div class="cp-dropzone" id="cpDropzone">
                <input type="file" id="cpFileInput" accept="image/jpeg,image/png,image/webp,image/gif"
                       onchange="cpHandleFile(this)">
                <div class="cp-dz-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                        <polyline points="17 8 12 3 7 8"/>
                        <line x1="12" y1="3" x2="12" y2="15"/>
                    </svg>
                </div>
                <div class="cp-dz-label">Click to upload or drag & drop</div>
                <div class="cp-dz-sub">JPG, PNG, WEBP or GIF &nbsp;·&nbsp; Max 5 MB<br>Recommended: 1200 × 300 px</div>
            </div>

            <div class="cp-preview-wrap" id="cpPreviewWrap">
                <img id="cpPreviewImg" src="" alt="Preview">
                <button type="button" class="cp-preview-clear" onclick="cpClearPreview()" title="Clear">
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>
                </button>
            </div>
            <div class="cp-preview-name" id="cpPreviewName"></div>
        </div>

        <div class="cp-modal-foot">
            <button type="button" class="cp-btn-cancel" onclick="cpModalClose()">Cancel</button>
            <button type="button" class="cp-btn-save" id="cpSaveBtn" disabled onclick="cpApplyToForm()">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l4 4 6-6"/></svg>
                Apply Cover
            </button>
        </div>
    </div>
</div>

{{-- ══ CONFIRM DELETE SUB-MODAL ══ --}}
<div class="cp-confirm-overlay" id="cpConfirmOverlay" onclick="if(event.target===this)cpConfirmClose()">
    <div class="cp-confirm-box">
        <div class="cp-confirm-body">
            <div class="cp-confirm-ico">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                    <path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                </svg>
            </div>
            <div class="cp-confirm-title">Remove Cover Photo?</div>
            <div class="cp-confirm-desc">Your current cover photo will be permanently removed. This action cannot be undone.</div>
        </div>
        <div class="cp-confirm-foot">
            <button type="button" class="cp-confirm-cancel" onclick="cpConfirmClose()">Keep It</button>
            <button type="button" class="cp-confirm-delete" onclick="cpExecuteDelete()">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 3.5h10M5 3.5V2.5h4v1M4.5 3.5v7a1 1 0 001 1h3a1 1 0 001-1v-7"/></svg>
                Yes, Remove
            </button>
        </div>
    </div>
</div>

<form id="cpDeleteForm" action="{{ route('supplier.cover.delete') }}" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<script>
    function updatePreview() {
        const fn   = (document.getElementById('fi_fn')?.value  || '').trim();
        const ln   = (document.getElementById('fi_ln')?.value  || '').trim();
        const bn   = (document.getElementById('fi_bn')?.value  || '').trim();
        const name = bn || ([fn, ln].filter(Boolean).join(' ')) || '{{ addslashes(Auth::user()->name) }}';
        const nameEl  = document.getElementById('previewName');
        const initEl  = document.getElementById('sideAvatarInitials');
        if (nameEl) nameEl.textContent = name;
        if (initEl && !document.getElementById('sideAvatar').classList.contains('has-photo')) {
            initEl.textContent = ((fn[0] || '') + (ln[0] || '')).toUpperCase() || '?';
        }
    }

    function updateCatPreview() {
        const selected = Array.from(document.querySelectorAll('.cat-chip.selected .cat-chip-name'))
                            .map(el => el.textContent.trim());
        const catEl = document.getElementById('previewCategory');
        if (catEl) catEl.textContent = selected.length ? selected.join(', ') : 'No Category Set';
    }

    document.getElementById('cat-grid').addEventListener('change', function(e) {
        if (e.target.type !== 'checkbox') return;
        const chip = e.target.closest('.cat-chip');
        if (!chip) return;
        chip.classList.toggle('selected', e.target.checked);
        updateCatCount();
        updateCatPreview();
    });

    function updateCatCount() {
        const n  = document.querySelectorAll('.cat-chip.selected').length;
        const el = document.getElementById('cat-count');
        if (!el) return;
        if (n === 0) { el.classList.remove('show'); }
        else { el.classList.add('show'); el.textContent = n + ' categor' + (n === 1 ? 'y' : 'ies') + ' selected'; }
    }
    updateCatCount();
    updateCatPreview();

    function syncPhoto(input) {
        const file = input.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            const av  = document.getElementById('sideAvatar');
            const img = document.getElementById('sideAvatarImg');
            img.src = e.target.result; img.style.display = 'block';
            av.classList.add('has-photo');
            const initials = document.getElementById('sideAvatarInitials');
            if (initials) initials.style.display = 'none';
            const et = document.getElementById('editThumb');
            const ei = document.getElementById('editThumbImg');
            if (et && ei) { ei.src = e.target.result; ei.style.display = 'block'; et.classList.add('has-photo'); }
            const pn = document.getElementById('photoName');
            if (pn) pn.textContent = file.name;
        };
        reader.readAsDataURL(file);
        const dt  = new DataTransfer(); dt.items.add(file);
        const epi = document.getElementById('editPhotoInput');
        if (epi) epi.files = dt.files;
    }

    function previewPhoto(input) {
        const file = input.files[0];
        if (!file) return;
        const pn = document.getElementById('photoName');
        if (pn) pn.textContent = file.name;
        const reader = new FileReader();
        reader.onload = function(e) {
            const t = document.getElementById('editThumb');
            const i = document.getElementById('editThumbImg');
            i.src = e.target.result; i.style.display = 'block'; t.classList.add('has-photo');
            const av = document.getElementById('sideAvatar');
            const si = document.getElementById('sideAvatarImg');
            if (av && si) { si.src = e.target.result; si.style.display = 'block'; av.classList.add('has-photo'); }
            const initials = document.getElementById('sideAvatarInitials');
            if (initials) initials.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }

    function bvCt(id, el, max) {
        document.getElementById(id).textContent = el.value.length + ' / ' + max;
    }

    function cpOpen() { document.getElementById('cpModalOverlay').classList.add('open'); document.body.style.overflow = 'hidden'; }
    function cpModalClose() { document.getElementById('cpModalOverlay').classList.remove('open'); document.body.style.overflow = ''; }

    function cpHandleFile(input) {
        if (!input.files || !input.files[0]) return;
        var file = input.files[0];
        if (file.size > 5 * 1024 * 1024) { alert('File size must be under 5 MB.'); input.value = ''; return; }
        var reader = new FileReader();
        reader.onload = function(e) {
            var pw = document.getElementById('cpPreviewWrap');
            var pi = document.getElementById('cpPreviewImg');
            var pn = document.getElementById('cpPreviewName');
            pi.src = e.target.result;
            pw.classList.add('visible');
            document.getElementById('cpDropzone').style.display = 'none';
            pn.textContent = file.name;
            pn.classList.add('show');
            document.getElementById('cpSaveBtn').removeAttribute('disabled');
        };
        reader.readAsDataURL(file);
    }

    function cpClearPreview() {
        document.getElementById('cpFileInput').value = '';
        document.getElementById('cpPreviewImg').src = '';
        document.getElementById('cpPreviewWrap').classList.remove('visible');
        var pn = document.getElementById('cpPreviewName');
        pn.textContent = ''; pn.classList.remove('show');
        document.getElementById('cpDropzone').style.display = '';
        document.getElementById('cpSaveBtn').setAttribute('disabled', 'disabled');
    }

    function cpApplyToForm() {
        var cpInput   = document.getElementById('cpFileInput');
        var mainInput = document.getElementById('bvCoverPhotoField');
        if (!cpInput.files || !cpInput.files[0]) return;
        var dt = new DataTransfer();
        dt.items.add(cpInput.files[0]);
        mainInput.files = dt.files;
        var bannerImg = document.getElementById('bvBannerImg');
        if (bannerImg) { bannerImg.src = document.getElementById('cpPreviewImg').src; bannerImg.style.display = 'block'; }
        var overlay = document.getElementById('bvBannerOverlay');
        if (!overlay) {
            var ov = document.createElement('div');
            ov.id = 'bvBannerOverlay';
            ov.className = 'bv-id-banner-overlay';
            document.getElementById('bvBanner').appendChild(ov);
        }
        var btn = document.querySelector('.bv-cover-btn span');
        if (btn) btn.textContent = 'Change Cover';
        cpModalClose();
    }

    (function() {
        var dz = document.getElementById('cpDropzone');
        if (!dz) return;
        dz.addEventListener('dragover',  function(e) { e.preventDefault(); dz.classList.add('drag-over'); });
        dz.addEventListener('dragleave', function()  { dz.classList.remove('drag-over'); });
        dz.addEventListener('drop', function(e) {
            e.preventDefault(); dz.classList.remove('drag-over');
            var fi = document.getElementById('cpFileInput');
            if (e.dataTransfer.files.length) { fi.files = e.dataTransfer.files; cpHandleFile(fi); }
        });
    })();

    function cpConfirmDelete() {
        document.getElementById('cpModalOverlay').classList.remove('open');
        document.getElementById('cpConfirmOverlay').classList.add('open');
    }
    function cpConfirmClose() { document.getElementById('cpConfirmOverlay').classList.remove('open'); document.body.style.overflow = ''; }
    function cpExecuteDelete() { document.getElementById('cpDeleteForm').submit(); }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') { cpModalClose(); cpConfirmClose(); }
    });
</script>

</x-supplier-layout>