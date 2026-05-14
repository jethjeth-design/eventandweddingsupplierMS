<x-supplier-layout>

<style>
/* ══════════════════════════════════════════
   VARIABLES & RESET
══════════════════════════════════════════ */
:root {
    --gold:        #C9A84C;
    --gold-dark:   #A8842A;
    --gold-light:  rgba(201,168,76,.12);
    --charcoal:    #1E1B18;
    --warm-grey:   #8C8178;
    --border:      #EDE8E2;
    --border-soft: #F5F1EC;
    --white:       #FFFFFF;
    --ivory:       #FAF8F5;
    --danger:      #C0392B;
    --font-display:'Playfair Display', Georgia, serif;
    --font-body:   'DM Sans', sans-serif;
    --radius-lg:   16px;
    --radius-md:   12px;
    --radius-sm:   8px;
    --shadow-sm:   0 1px 4px rgba(30,27,24,.06);
    --shadow-md:   0 4px 16px rgba(30,27,24,.10);
    --shadow-lg:   0 12px 48px rgba(30,27,24,.18);
}

/* Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=DM+Sans:wght@300;400;500;600&display=swap');

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body { font-family: var(--font-body); color: var(--charcoal); background: #F4F0EA; }

/* ══════════════════════════════════════════
   PAGE WRAPPER & HEADER
══════════════════════════════════════════ */
.page-content { max-width: 900px; margin: 0 auto; padding: 2rem 1.25rem 4rem; }

.bv-page-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}
.bv-page-title {
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 700;
    color: var(--charcoal);
    line-height: 1.1;
}
.bv-page-title em { font-style: italic; color: var(--gold-dark); }
.bv-page-sub { font-size: .8rem; color: var(--warm-grey); margin-top: .35rem; letter-spacing: .02em; }

/* ══════════════════════════════════════════
   IDENTITY CARD
══════════════════════════════════════════ */
.bv-id-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    margin-bottom: 1.5rem;
}

/* Banner */
.bv-id-banner {
    height: 210px;
    background: linear-gradient(135deg, #1E1B18 0%, #2a2016 55%, #3d2f14 100%);
    position: relative;
    overflow: hidden;
}
.bv-id-banner::after {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23C9A84C' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 0;
}
.bv-id-banner-img {
    position: absolute; inset: 0;
    width: 100%; height: 100%;
    object-fit: cover; display: block; z-index: 1;
}
.bv-id-banner-overlay {
    position: absolute; inset: 0;
    background: rgba(30,27,24,.22);
    pointer-events: none; z-index: 2;
}
.bv-cover-btn {
    position: absolute; bottom: 12px; right: 14px; z-index: 4;
    display: inline-flex; align-items: center; gap: .45rem;
    padding: .42rem 1rem;
    border-radius: var(--radius-sm);
    background: rgba(20,18,15,.65);
    border: 1.5px solid rgba(255,255,255,.2);
    backdrop-filter: blur(6px);
    font-family: var(--font-body); font-size: .72rem; font-weight: 500;
    color: rgba(255,255,255,.92); cursor: pointer;
    transition: background .2s, border-color .2s, transform .15s;
}
.bv-cover-btn svg { width: 13px; height: 13px; flex-shrink: 0; }
.bv-cover-btn:hover {
    background: rgba(201,168,76,.8);
    border-color: rgba(201,168,76,.4);
    transform: translateY(-1px);
}

/* Card inner */
.bv-id-inner {
    display: flex;
    align-items: flex-start;
    gap: 1.75rem;
    padding: 0 2rem 1.75rem;
    flex-wrap: wrap;
}

/* Avatar */
.bv-id-avatar-wrap {
    position: relative;
    width: 112px; height: 112px;
    margin-top: -56px;
    flex-shrink: 0; z-index: 3;
}
.bv-id-avatar {
    width: 112px; height: 112px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    display: flex; align-items: center; justify-content: center;
    font-family: var(--font-display); font-size: 2.4rem; font-weight: 700;
    color: var(--white); overflow: hidden;
    border: 4px solid var(--white);
    box-shadow: 0 4px 18px rgba(30,27,24,.18);
    transition: box-shadow .2s;
}
.bv-id-avatar img { width: 100%; height: 100%; object-fit: cover; display: none; }
.bv-id-avatar.has-photo img  { display: block; }
.bv-id-avatar.has-photo span { display: none; }
.bv-id-photo-badge {
    position: absolute; bottom: 4px; right: 4px;
    width: 30px; height: 30px; border-radius: 50%;
    background: var(--gold);
    border: 2.5px solid var(--white);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(30,27,24,.18);
    transition: background .2s, transform .15s;
}
.bv-id-photo-badge:hover { background: var(--gold-dark); transform: scale(1.08); }
.bv-id-photo-badge svg { width: 12px; height: 12px; color: var(--white); }

/* Info */
.bv-id-info { flex: 1; min-width: 0; padding-top: .9rem; }
.bv-id-name {
    font-family: var(--font-display);
    font-size: 1.35rem; font-weight: 700;
    color: var(--charcoal); line-height: 1.2; margin-bottom: .18rem;
}
.bv-id-category {
    font-size: .72rem; color: var(--gold-dark);
    letter-spacing: .06em; font-weight: 600;
    text-transform: uppercase; margin-bottom: .65rem;
}
.bv-id-badge {
    display: inline-flex; align-items: center; gap: .38rem;
    padding: .24rem .82rem; border-radius: 999px;
    background: rgba(201,168,76,.1); color: var(--gold-dark);
    font-size: .65rem; font-weight: 700;
    letter-spacing: .05em; text-transform: uppercase;
}
.bv-id-badge::before {
    content: ''; width: 6px; height: 6px;
    border-radius: 50%; background: var(--gold);
    animation: pulse 2s ease-in-out infinite;
}
@keyframes pulse {
    0%,100% { opacity: 1; transform: scale(1); }
    50%      { opacity: .6; transform: scale(.85); }
}

/* Photo upload zone */
.bv-id-photo-zone {
    display: flex; align-items: center; gap: .95rem;
    padding: .9rem 1.1rem; margin-top: 1rem;
    background: rgba(201,168,76,.04);
    border: 1.5px dashed rgba(201,168,76,.32);
    border-radius: var(--radius-md);
    min-width: 245px; align-self: flex-end; flex-shrink: 0;
    transition: border-color .2s, background .2s;
}
.bv-id-photo-zone:hover { border-color: var(--gold); background: rgba(201,168,76,.07); }
.bv-pez-thumb {
    width: 58px; height: 58px; border-radius: 50%; flex-shrink: 0;
    overflow: hidden; border: 2px solid rgba(201,168,76,.28);
    background: linear-gradient(135deg, var(--gold), var(--gold-dark));
    display: flex; align-items: center; justify-content: center;
    font-family: var(--font-display); font-size: 1.15rem;
    font-weight: 700; color: var(--white);
}
.bv-pez-thumb img { width: 100%; height: 100%; object-fit: cover; display: none; }
.bv-pez-thumb.has-photo img  { display: block; }
.bv-pez-thumb.has-photo span { display: none; }
.bv-pez-info p { font-size: .68rem; color: var(--warm-grey); margin-bottom: .42rem; line-height: 1.5; }
.bv-ul-btn {
    display: inline-flex; align-items: center; gap: .38rem;
    padding: .4rem .85rem; border-radius: 6px;
    border: 1.5px solid var(--border);
    background: var(--white);
    font-family: var(--font-body); font-size: .73rem;
    font-weight: 500; color: var(--charcoal);
    cursor: pointer; transition: border-color .2s, color .2s, background .2s;
}
.bv-ul-btn svg { width: 12px; height: 12px; }
.bv-ul-btn:hover { border-color: var(--gold); color: var(--gold-dark); background: var(--gold-light); }

/* Tips strip */
.bv-id-tips-strip {
    display: flex; gap: .7rem; flex-wrap: wrap;
    padding: .9rem 2rem;
    border-top: 1px solid var(--border-soft);
    background: rgba(201,168,76,.025);
}
.bv-id-tip-pill {
    display: flex; align-items: flex-start; gap: .45rem;
    font-size: .7rem; color: var(--warm-grey); line-height: 1.45;
    flex: 1; min-width: 175px;
}
.bv-id-tip-pill::before {
    content: ''; width: 5px; height: 5px; border-radius: 50%;
    background: var(--gold); flex-shrink: 0; margin-top: .42rem;
}

/* ══════════════════════════════════════════
   SECTION CARDS
══════════════════════════════════════════ */
.bv-sc {
    background: var(--white);
    border-radius: var(--radius-md);
    border: 1px solid var(--border);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    margin-bottom: 1.25rem;
}
.bv-sc-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 1.1rem 1.5rem;
    border-bottom: 1px solid var(--border-soft);
    background: linear-gradient(to right, rgba(201,168,76,.03), transparent);
}
.bv-sc-head-l { display: flex; align-items: center; gap: .7rem; }
.bv-sc-icon {
    width: 36px; height: 36px; border-radius: 9px;
    background: var(--gold-light);
    display: flex; align-items: center; justify-content: center;
    color: var(--gold-dark); flex-shrink: 0;
}
.bv-sc-icon svg { width: 16px; height: 16px; }
.bv-sc-title {
    font-family: var(--font-display);
    font-size: .98rem; font-weight: 700; color: var(--charcoal);
}
.bv-sc-desc { font-size: .7rem; color: var(--warm-grey); margin-top: .05rem; }
.bv-sc-body { padding: 1.5rem; }

/* ══════════════════════════════════════════
   FORM FIELDS
══════════════════════════════════════════ */
.bv-fg {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 1.25rem;
}
.bv-fg-full { grid-column: 1 / -1; }
.bv-f { display: flex; flex-direction: column; }
.bv-lbl {
    display: flex; align-items: center; justify-content: space-between;
    font-size: .68rem; font-weight: 600;
    letter-spacing: .08em; text-transform: uppercase;
    color: var(--warm-grey); margin-bottom: .4rem;
}
.bv-req { font-size: .58rem; color: var(--danger); font-weight: 500; text-transform: none; letter-spacing: 0; }
.bv-opt { font-size: .58rem; color: #C0B0A8; font-weight: 400; text-transform: none; letter-spacing: 0; }
.bv-inp, .bv-ta, .bv-sel {
    width: 100%; padding: .72rem 1rem;
    background: var(--ivory);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-sm);
    font-family: var(--font-body); font-size: .85rem; color: var(--charcoal);
    outline: none; appearance: none; display: block;
    transition: border-color .2s, box-shadow .2s, background .2s;
}
.bv-inp:focus, .bv-ta:focus, .bv-sel:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(201,168,76,.14);
    background: var(--white);
}
.bv-inp::placeholder, .bv-ta::placeholder { color: #C5BCBA; }
.bv-ta { resize: vertical; min-height: 95px; line-height: 1.6; }
.bv-iw { position: relative; }
.bv-ico {
    position: absolute; left: .9rem; top: 50%;
    transform: translateY(-50%);
    width: 15px; height: 15px;
    color: #C5BCBA; pointer-events: none;
    transition: color .2s;
}
.bv-iw:focus-within .bv-ico { color: var(--gold-dark); }
.bv-iw .bv-inp { padding-left: 2.55rem; }
.bv-sw { position: relative; }
.bv-sw::after {
    content: '';
    position: absolute; right: .9rem; top: 50%;
    transform: translateY(-50%);
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 5px solid #C5BCBA;
    pointer-events: none;
}
.bv-err { font-size: .68rem; color: var(--danger); margin-top: .3rem; }
.bv-hnt { font-size: .68rem; color: #C0B0A8; margin-top: .3rem; line-height: 1.5; }
.bv-cf { display: flex; justify-content: flex-end; margin-top: .25rem; }
.bv-cc { font-size: .64rem; color: #C0B0A8; }

/* ══════════════════════════════════════════
   CATEGORY CHIPS
══════════════════════════════════════════ */
.cat-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: .6rem;
    margin-top: .35rem;
}
.cat-chip {
    position: relative;
    display: flex; align-items: center; gap: .5rem;
    padding: .58rem .8rem;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-sm);
    background: var(--ivory);
    cursor: pointer; user-select: none;
    transition: border-color .18s, background .18s, box-shadow .18s, transform .15s;
}
.cat-chip input[type="checkbox"] {
    position: absolute; opacity: 0; width: 0; height: 0; pointer-events: none;
}
.cat-chip:hover {
    border-color: rgba(201,168,76,.5);
    background: rgba(201,168,76,.04);
    transform: translateY(-1px);
}
.cat-chip-icon {
    width: 28px; height: 28px; border-radius: 7px; flex-shrink: 0;
    background: var(--gold-light);
    display: flex; align-items: center; justify-content: center;
    transition: background .18s;
}
.cat-chip-icon svg { width: 14px; height: 14px; color: var(--gold-dark); }
.cat-chip-name {
    font-size: .76rem; font-weight: 500;
    color: var(--charcoal); flex: 1; min-width: 0;
    line-height: 1.2; font-family: var(--font-body);
}
.cat-chip-check {
    position: absolute; top: 5px; right: 6px;
    width: 15px; height: 15px; border-radius: 50%;
    border: 1.5px solid var(--border); background: var(--white);
    display: flex; align-items: center; justify-content: center;
    transition: all .18s;
}
.cat-chip-check svg { width: 8px; height: 8px; color: var(--white); opacity: 0; transition: opacity .15s; }
.cat-chip.selected {
    border-color: var(--gold);
    background: rgba(201,168,76,.08);
    box-shadow: 0 0 0 3px rgba(201,168,76,.14);
}
.cat-chip.selected .cat-chip-icon  { background: rgba(201,168,76,.22); }
.cat-chip.selected .cat-chip-check { background: var(--gold); border-color: var(--gold); }
.cat-chip.selected .cat-chip-check svg { opacity: 1; }
.cat-chip.selected .cat-chip-name  { color: var(--gold-dark); font-weight: 600; }
.cat-selected-count { font-size: .66rem; color: var(--gold-dark); margin-top: .55rem; display: none; }
.cat-selected-count.show { display: block; }

/* ══════════════════════════════════════════
   FORM FOOTER BUTTONS
══════════════════════════════════════════ */
.bv-sc-foot {
    display: flex; align-items: center; justify-content: space-between;
    gap: .6rem;
    padding: 1rem 1.5rem;
    border-top: 1px solid var(--border-soft);
    background: rgba(201,168,76,.02);
}
.bv-btn-save {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: .68rem 1.65rem;
    border-radius: var(--radius-sm); border: none;
    background: var(--charcoal);
    font-family: var(--font-body); font-size: .84rem;
    font-weight: 600; color: var(--white);
    cursor: pointer; transition: background .22s, box-shadow .22s, transform .15s;
    letter-spacing: .02em;
}
.bv-btn-save svg { width: 14px; height: 14px; }
.bv-btn-save:hover {
    background: var(--gold-dark);
    box-shadow: 0 4px 14px rgba(168,132,42,.3);
    transform: translateY(-1px);
}
.bv-btn-back {
    display: inline-flex; align-items: center; gap: .42rem;
    padding: .68rem 1.2rem; border-radius: var(--radius-sm);
    border: 1.5px solid var(--border); background: var(--white);
    font-family: var(--font-body); font-size: .84rem;
    font-weight: 500; color: var(--warm-grey);
    text-decoration: none; transition: border-color .2s, color .2s, background .2s;
}
.bv-btn-back svg { width: 13px; height: 13px; }
.bv-btn-back:hover { border-color: var(--gold); color: var(--charcoal); background: var(--ivory); }

/* ══════════════════════════════════════════
   COVER PHOTO MODAL
══════════════════════════════════════════ */
.cp-modal-overlay {
    position: fixed; inset: 0; z-index: 9000;
    background: rgba(20,17,14,.65);
    backdrop-filter: blur(4px);
    display: none; align-items: center; justify-content: center; padding: 1rem;
}
.cp-modal-overlay.open { display: flex; }
.cp-modal {
    background: var(--white);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-lg);
    width: 100%; max-width: 510px; overflow: hidden;
    animation: slideUp .22s ease;
}
@keyframes slideUp {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
}
.cp-modal-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 1.2rem 1.5rem;
    border-bottom: 1px solid var(--border-soft);
}
.cp-modal-head-l { display: flex; align-items: center; gap: .7rem; }
.cp-modal-icon {
    width: 36px; height: 36px; border-radius: 9px;
    background: var(--gold-light);
    display: flex; align-items: center; justify-content: center;
    color: var(--gold-dark); flex-shrink: 0;
}
.cp-modal-icon svg { width: 17px; height: 17px; }
.cp-modal-title { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--charcoal); }
.cp-modal-sub   { font-size: .7rem; color: var(--warm-grey); margin-top: .05rem; }
.cp-modal-close {
    width: 34px; height: 34px; border-radius: 50%;
    border: 1.5px solid var(--border); background: var(--white);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--warm-grey); flex-shrink: 0;
    transition: border-color .15s, color .15s, background .15s;
}
.cp-modal-close:hover { border-color: var(--gold); color: var(--gold-dark); background: var(--gold-light); }
.cp-modal-close svg { width: 12px; height: 12px; }
.cp-modal-body {
    padding: 1.4rem 1.5rem;
    display: flex; flex-direction: column; gap: 1rem;
}
.cp-modal-foot {
    padding: .9rem 1.5rem;
    border-top: 1px solid var(--border-soft);
    display: flex; align-items: center; justify-content: flex-end; gap: .6rem;
}

/* Current strip */
.cp-current-strip {
    border-radius: var(--radius-sm);
    overflow: hidden; border: 1.5px solid var(--border);
    position: relative;
}
.cp-current-strip img { width: 100%; height: 115px; object-fit: cover; display: block; }
.cp-current-strip-bar {
    position: absolute; bottom: 0; left: 0; right: 0;
    background: rgba(20,17,14,.62); backdrop-filter: blur(4px);
    padding: .45rem .8rem;
    display: flex; align-items: center; justify-content: space-between;
}
.cp-current-strip-label {
    font-size: .66rem; color: rgba(255,255,255,.85);
    display: flex; align-items: center; gap: .38rem;
}
.cp-current-strip-label svg { width: 11px; height: 11px; color: var(--gold); }
.cp-delete-btn {
    display: inline-flex; align-items: center; gap: .32rem;
    padding: .3rem .72rem; border-radius: 6px;
    background: rgba(192,57,43,.88); border: none;
    font-family: var(--font-body); font-size: .68rem; font-weight: 500;
    color: var(--white); cursor: pointer; transition: background .15s;
}
.cp-delete-btn svg { width: 11px; height: 11px; }
.cp-delete-btn:hover { background: var(--danger); }

/* Dropzone */
.cp-dropzone {
    border: 2px dashed var(--border);
    border-radius: var(--radius-md);
    padding: 1.9rem 1.5rem;
    text-align: center; cursor: pointer; position: relative;
    background: rgba(201,168,76,.02);
    transition: border-color .2s, background .2s;
}
.cp-dropzone:hover, .cp-dropzone.drag-over {
    border-color: var(--gold);
    background: rgba(201,168,76,.07);
}
.cp-dropzone input[type="file"] {
    position: absolute; inset: 0; opacity: 0;
    cursor: pointer; width: 100%; height: 100%;
}
.cp-dz-icon {
    width: 48px; height: 48px; border-radius: 50%;
    background: var(--gold-light);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto .8rem; color: var(--gold-dark);
}
.cp-dz-icon svg { width: 22px; height: 22px; }
.cp-dz-label  { font-size: .84rem; font-weight: 600; color: var(--charcoal); margin-bottom: .28rem; }
.cp-dz-sub    { font-size: .72rem; color: #C0B0A8; line-height: 1.6; }

/* Preview */
.cp-preview-wrap { display: none; border-radius: var(--radius-sm); overflow: hidden; border: 1.5px solid var(--border); position: relative; }
.cp-preview-wrap.visible { display: block; }
.cp-preview-wrap img { width: 100%; height: 145px; object-fit: cover; display: block; }
.cp-preview-clear {
    position: absolute; top: 8px; right: 8px;
    width: 30px; height: 30px; border-radius: 50%;
    background: rgba(20,17,14,.68); border: none;
    cursor: pointer; display: flex; align-items: center; justify-content: center;
    color: var(--white); transition: background .2s;
}
.cp-preview-clear:hover { background: rgba(192,57,43,.88); }
.cp-preview-clear svg { width: 12px; height: 12px; }
.cp-preview-name      { font-size: .68rem; color: var(--warm-grey); margin-top: .4rem; display: none; }
.cp-preview-name.show { display: block; }

/* Modal buttons */
.cp-btn-cancel {
    display: inline-flex; align-items: center; gap: .42rem;
    padding: .6rem 1.2rem; border-radius: var(--radius-sm);
    border: 1.5px solid var(--border); background: var(--white);
    font-family: var(--font-body); font-size: .8rem; font-weight: 500;
    color: var(--warm-grey); cursor: pointer; transition: border-color .2s, color .2s;
}
.cp-btn-cancel:hover { border-color: var(--gold); color: var(--charcoal); }
.cp-btn-save {
    display: inline-flex; align-items: center; gap: .48rem;
    padding: .6rem 1.5rem; border-radius: var(--radius-sm); border: none;
    background: var(--charcoal);
    font-family: var(--font-body); font-size: .8rem; font-weight: 600;
    color: var(--white); cursor: pointer;
    transition: background .22s, box-shadow .22s, transform .15s;
}
.cp-btn-save svg { width: 13px; height: 13px; }
.cp-btn-save:hover { background: var(--gold-dark); box-shadow: 0 4px 12px rgba(168,132,42,.28); transform: translateY(-1px); }
.cp-btn-save:disabled { background: #C5BCBA; cursor: not-allowed; transform: none; box-shadow: none; }

/* ══════════════════════════════════════════
   CONFIRM DELETE MODAL
══════════════════════════════════════════ */
.cp-confirm-overlay {
    position: fixed; inset: 0; z-index: 9100;
    background: rgba(20,17,14,.55);
    backdrop-filter: blur(4px);
    display: none; align-items: center; justify-content: center; padding: 1rem;
}
.cp-confirm-overlay.open { display: flex; }
.cp-confirm-box {
    background: var(--white); border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-lg);
    width: 100%; max-width: 390px;
    overflow: hidden; animation: slideUp .2s ease;
}
.cp-confirm-body { padding: 1.65rem 1.5rem 1.1rem; text-align: center; }
.cp-confirm-ico {
    width: 56px; height: 56px; border-radius: 50%;
    background: #FFF5F5; border: 1.5px solid #FADBD8;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 1rem; color: var(--danger);
}
.cp-confirm-ico svg { width: 24px; height: 24px; }
.cp-confirm-title { font-family: var(--font-display); font-size: 1.05rem; font-weight: 700; color: var(--charcoal); margin-bottom: .45rem; }
.cp-confirm-desc  { font-size: .8rem; color: var(--warm-grey); line-height: 1.65; }
.cp-confirm-foot  { padding: .9rem 1.5rem; border-top: 1px solid var(--border-soft); display: flex; gap: .6rem; justify-content: center; }
.cp-confirm-cancel {
    display: inline-flex; align-items: center; gap: .42rem;
    padding: .6rem 1.3rem; border-radius: var(--radius-sm);
    border: 1.5px solid var(--border); background: var(--white);
    font-family: var(--font-body); font-size: .8rem; font-weight: 500;
    color: var(--warm-grey); cursor: pointer; transition: border-color .2s, color .2s;
}
.cp-confirm-cancel:hover { border-color: var(--gold); color: var(--charcoal); }
.cp-confirm-delete {
    display: inline-flex; align-items: center; gap: .42rem;
    padding: .6rem 1.5rem; border-radius: var(--radius-sm); border: none;
    background: var(--danger);
    font-family: var(--font-body); font-size: .8rem; font-weight: 600;
    color: var(--white); cursor: pointer; transition: background .2s, transform .15s;
}
.cp-confirm-delete svg { width: 13px; height: 13px; }
.cp-confirm-delete:hover { background: #a93226; transform: translateY(-1px); }

/* ══════════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════════ */
@media (max-width: 720px) {
    .bv-id-inner      { gap: 1rem; padding: 0 1.25rem 1.4rem; }
    .bv-id-photo-zone { min-width: unset; width: 100%; align-self: auto; }
    .bv-id-tips-strip { padding: .85rem 1.25rem; }
    .bv-sc-body       { padding: 1.25rem; }
    .bv-sc-foot       { padding: .9rem 1.25rem; }
}
@media (max-width: 580px) {
    .bv-fg   { grid-template-columns: 1fr; }
    .cat-grid { grid-template-columns: repeat(2, 1fr); }
    .bv-page-title { font-size: 1.6rem; }
}
@media (max-width: 420px) {
    .cat-grid { grid-template-columns: 1fr; }
    .bv-id-avatar-wrap { width: 90px; height: 90px; margin-top: -45px; }
    .bv-id-avatar      { width: 90px; height: 90px; font-size: 2rem; }
}
</style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Supplier Profile') }}
        </h2>
    </x-slot>

<div class="page-content">

    {{-- ── PAGE HEADER ── --}}
    <div class="bv-page-header">
        <div>
            <h1 class="bv-page-title">Edit Personal <em>Information</em></h1>
            <p class="bv-page-sub">Update your supplier profile details</p>
        </div>
        <a href="{{ route('supplier.supplierprofile', $supplierProfile->id) }}" class="bv-btn-back">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 2L4 7l5 5"/>
            </svg>
            Back to Profile
        </a>
    </div>

    @php
        /* ── Helpers ── */
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
            'venue'    => '<path d="M2 12L12 3l10 9v9a1 1 0 01-1 1H3a1 1 0 01-1-1v-9z"/>',
            'catering' => '<path d="M18 8h1a4 4 0 010 8h-1"/><path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/>',
            'photo'    => '<path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/><circle cx="12" cy="13" r="4"/>',
            'video'    => '<polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/>',
            'dj'       => '<circle cx="12" cy="12" r="2"/><circle cx="12" cy="12" r="7"/><line x1="12" y1="1" x2="12" y2="3"/>',
            'makeup'   => '<path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>',
            'gown'     => '<path d="M20.38 3.46L16 2a4 4 0 01-8 0L3.62 3.46a2 2 0 00-1.34 2.23l.58 3.57a1 1 0 00.99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 002-2V10h2.15a1 1 0 00.99-.84l.58-3.57a2 2 0 00-1.34-2.23z"/>',
            'band'     => '<path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/>',
            'emcee'    => '<path d="M12 1a3 3 0 00-3 3v8a3 3 0 006 0V4a3 3 0 00-3-3z"/><path d="M19 10v2a7 7 0 01-14 0v-2"/>',
            'flower'   => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
            'light'    => '<circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>',
            'default'  => '<rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>',
        ];
        function catIcon($slug, $icons) {
            $s = strtolower($slug);
            foreach ($icons as $key => $path) {
                if (str_contains($s, $key)) return $path;
            }
            return $icons['default'];
        }

        $previewName = $supplierProfile->business_name
                    ?: trim(($supplierProfile->first_name ?? '') . ' ' . ($supplierProfile->last_name ?? ''))
                    ?: Auth::user()->name;

        $previewCat = '';
        if ($supplierProfile->category) {
            $previewCat = is_object($supplierProfile->category)
                ? ($supplierProfile->category->name ?? '')
                : $supplierProfile->category;
        }

        $initials = strtoupper(
            substr($supplierProfile->first_name ?? Auth::user()->name, 0, 1) .
            substr($supplierProfile->last_name  ?? '', 0, 1)
        );
    @endphp

    {{-- ══ IDENTITY CARD (preview) ══ --}}
    <div class="bv-id-card">

        {{-- Banner --}}
        <div class="bv-id-banner" id="bvBanner">
            @if(!empty($supplierProfile->cover_photo))
                <img class="bv-id-banner-img" id="bvBannerImg"
                     src="{{ asset('storage/' . $supplierProfile->cover_photo) }}"
                     alt="Cover photo">
                <div class="bv-id-banner-overlay"></div>
            @else
                <img class="bv-id-banner-img" id="bvBannerImg" src="" alt="" style="display:none;">
            @endif
            <button type="button" class="bv-cover-btn" onclick="cpOpen()">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M1 5a2 2 0 012-2h1.5l1-1.5h5L11.5 3H13a2 2 0 012 2v7a2 2 0 01-2 2H3a2 2 0 01-2-2V5z"/>
                    <circle cx="8" cy="8.5" r="2.5"/>
                </svg>
                <span id="bvCoverBtnLabel">{{ empty($supplierProfile->cover_photo) ? 'Add Cover Photo' : 'Change Cover' }}</span>
            </button>
        </div>

        {{-- Card inner --}}
        <div class="bv-id-inner">

            {{-- Avatar --}}
            <div class="bv-id-avatar-wrap">
                <div class="bv-id-avatar {{ $supplierProfile->photo ? 'has-photo' : '' }}" id="sideAvatar">
                    <img src="{{ $supplierProfile->photo ? asset('storage/'.$supplierProfile->photo) : '' }}"
                         alt="" id="sideAvatarImg">
                    <span id="sideAvatarInitials">{{ $initials ?: '?' }}</span>
                </div>
                <label for="quickPhoto" class="bv-id-photo-badge" title="Change photo">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 2.5l2.5 2.5-9 9H2v-2.5l9-9z"/>
                    </svg>
                </label>
                <input type="file" id="quickPhoto" accept="image/jpeg,image/png,image/webp"
                       style="display:none" onchange="syncPhoto(this)">
            </div>

            {{-- Name / badge --}}
            <div class="bv-id-info">
                <div class="bv-id-name"     id="previewName">{{ $previewName }}</div>
                <div class="bv-id-category" id="previewCategory">{{ $previewCat ?: 'No Category Set' }}</div>
                <div class="bv-id-badge">Active Supplier</div>
            </div>

            {{-- Photo upload zone --}}
            <div class="bv-id-photo-zone">
                <div class="bv-pez-thumb {{ $supplierProfile->photo ? 'has-photo' : '' }}" id="editThumb">
                    <img src="{{ $supplierProfile->photo ? asset('storage/'.$supplierProfile->photo) : '' }}"
                         alt="" id="editThumbImg">
                    <span>{{ strtoupper(substr($supplierProfile->first_name ?? 'U', 0, 2)) }}</span>
                </div>
                <div class="bv-pez-info">
                    <p>JPG, PNG or WEBP<br>Max 2 MB · Square preferred</p>
                    {{-- This label triggers the hidden file input INSIDE the form --}}
                    <label for="editPhotoInput" class="bv-ul-btn">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M8 11V3M5 6l3-3 3 3M3 11v2a1 1 0 001 1h8a1 1 0 001-1v-2"/>
                        </svg>
                        Change Photo
                    </label>
                    <span id="photoName" style="font-size:.65rem;color:#C0B0A8;display:block;margin-top:.28rem;"></span>
                    @error('photo')<div class="bv-err" style="margin-top:.3rem;">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Tips --}}
        <div class="bv-id-tips-strip">
            <div class="bv-id-tip-pill">A real business name helps clients find you in search.</div>
            <div class="bv-id-tip-pill">A strong tagline boosts profile clicks by up to 40%.</div>
            <div class="bv-id-tip-pill">Detailed descriptions win more booking inquiries.</div>
            <div class="bv-id-tip-pill">Suppliers with photos get 3× more bookings.</div>
        </div>
    </div>{{-- /bv-id-card --}}


    {{-- ══ MAIN FORM ══ --}}
    <form method="POST"
          action="{{ route('supplier.updateidentity', $supplierProfile->id) }}"
          enctype="multipart/form-data"
          id="bvMainForm">
        @csrf
        @method('PUT')

        {{-- ▸ Hidden inputs that live inside the form --}}
        {{-- Profile photo (synced from outside label via JS) --}}
        <input type="file" id="editPhotoInput" name="photo"
               accept="image/jpeg,image/png,image/webp"
               style="display:none" onchange="previewPhoto(this)">

        {{-- Cover photo (synced from modal via JS) --}}
        <input type="file" id="bvCoverField" name="cover_photo"
               accept="image/jpeg,image/png,image/webp,image/gif" style="display:none;">


        {{-- ── Section 1: Personal Identity ── --}}
        <div class="bv-sc">
            <div class="bv-sc-head">
                <div class="bv-sc-head-l">
                    <div class="bv-sc-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="10" cy="7" r="4"/>
                            <path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/>
                        </svg>
                    </div>
                    <div>
                        <div class="bv-sc-title">Personal Identity</div>
                        <div class="bv-sc-desc">Name, business identity and category</div>
                    </div>
                </div>
            </div>
            <div class="bv-sc-body">

                {{-- Name row --}}
                <div class="bv-fg">
                    <div class="bv-f">
                        <label class="bv-lbl" for="fi_fn">
                            First Name <span class="bv-req">Required</span>
                        </label>
                        <div class="bv-iw">
                            <svg class="bv-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <circle cx="10" cy="7" r="4"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7"/>
                            </svg>
                            <input id="fi_fn" name="first_name" type="text" class="bv-inp"
                                   value="{{ old('first_name', $supplierProfile->first_name) }}"
                                   placeholder="e.g. Maria" required oninput="updatePreview()">
                        </div>
                        @error('first_name')<div class="bv-err">{{ $message }}</div>@enderror
                    </div>

                    <div class="bv-f">
                        <label class="bv-lbl" for="fi_ln">
                            Last Name <span class="bv-req">Required</span>
                        </label>
                        <div class="bv-iw">
                            <svg class="bv-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <circle cx="10" cy="7" r="4"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7"/>
                            </svg>
                            <input id="fi_ln" name="last_name" type="text" class="bv-inp"
                                   value="{{ old('last_name', $supplierProfile->last_name) }}"
                                   placeholder="e.g. Santos" required oninput="updatePreview()">
                        </div>
                        @error('last_name')<div class="bv-err">{{ $message }}</div>@enderror
                    </div>

                    <div class="bv-f">
                        <label class="bv-lbl" for="fi_bn">
                            Business Name <span class="bv-opt">Optional</span>
                        </label>
                        <div class="bv-iw">
                            <svg class="bv-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <rect x="2" y="7" width="16" height="10" rx="2"/>
                                <path d="M6 7V5a4 4 0 018 0v2"/>
                            </svg>
                            <input id="fi_bn" name="business_name" type="text" class="bv-inp"
                                   value="{{ old('business_name', $supplierProfile->business_name) }}"
                                   placeholder="e.g. Santos Events Studio" oninput="updatePreview()">
                        </div>
                        <p class="bv-hnt">Leave blank to use your full name.</p>
                        @error('business_name')<div class="bv-err">{{ $message }}</div>@enderror
                    </div>

                    <div class="bv-f">
                        <label class="bv-lbl" for="fi_tl">
                            Tagline <span class="bv-opt">Optional</span>
                        </label>
                        <div class="bv-iw">
                            <svg class="bv-ico" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M4 6h12M4 10h8M4 14h5"/>
                            </svg>
                            <input id="fi_tl" name="tagline" type="text" class="bv-inp"
                                   value="{{ old('tagline', $supplierProfile->tagline) }}"
                                   placeholder="e.g. Crafting unforgettable moments">
                        </div>
                        @error('tagline')<div class="bv-err">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Category chips --}}
                <div style="margin-bottom:1.25rem;">
                    <label class="bv-lbl">Category <span class="bv-req">Required</span></label>
                    <p class="bv-hnt" style="margin-bottom:.7rem;">Select all that apply to your services.</p>
                    <div class="cat-grid" id="cat-grid">
                        @foreach($categories as $category)
                            @php
                                $isChecked = in_array($category->id, $currentCatIds);
                                $icon      = catIcon($category->slug ?? $category->name, $catIcons);
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
                    @error('category_id')<div class="bv-err" style="margin-top:.4rem;">{{ $message }}</div>@enderror
                </div>
            </div>{{-- /bv-sc-body --}}
        </div>{{-- /bv-sc --}}

        <div class="bv-sc">
    
            {{-- Form footer --}}
            <div class="bv-sc-foot">
                <a href="{{ route('supplier.supplierprofile', $supplierProfile->id) }}" class="bv-btn-back">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 2L4 7l5 5"/>
                    </svg>
                    Cancel
                </a>
                <button type="submit" class="bv-btn-save">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 8l4 4 6-6"/>
                    </svg>
                    Save All Changes
                </button>
            </div>
        </div>{{-- /bv-sc --}}

    </form>

</div>{{-- /page-content --}}


{{-- ══════════════════════════════════════════
     COVER PHOTO MODAL
══════════════════════════════════════════ --}}
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
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2">
                    <path d="M1 1l10 10M11 1L1 11"/>
                </svg>
            </button>
        </div>

        <div class="cp-modal-body">
            @if(!empty($supplierProfile->cover_photo))
            <div class="cp-current-strip" id="cpCurrentStrip">
                <img src="{{ asset('storage/' . $supplierProfile->cover_photo) }}" alt="Current cover">
                <div class="cp-current-strip-bar">
                    <span class="cp-current-strip-label">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="2 6 5 9 10 3"/>
                        </svg>
                        Current cover photo
                    </span>
                    <button type="button" class="cp-delete-btn" onclick="cpConfirmDelete()">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M2 3.5h10M5 3.5V2.5h4v1M4.5 3.5v7a1 1 0 001 1h3a1 1 0 001-1v-7"/>
                        </svg>
                        Remove
                    </button>
                </div>
            </div>
            @endif

            <div class="cp-dropzone" id="cpDropzone">
                <input type="file" id="cpFileInput"
                       accept="image/jpeg,image/png,image/webp,image/gif"
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
                <button type="button" class="cp-preview-clear" onclick="cpClearPreview()" title="Clear selection">
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M1 1l10 10M11 1L1 11"/>
                    </svg>
                </button>
            </div>
            <div class="cp-preview-name" id="cpPreviewName"></div>
        </div>

        <div class="cp-modal-foot">
            <button type="button" class="cp-btn-cancel" onclick="cpModalClose()">Cancel</button>
            <button type="button" class="cp-btn-save" id="cpSaveBtn" disabled onclick="cpApplyToForm()">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 8l4 4 6-6"/>
                </svg>
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
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                    <path d="M10 11v6M14 11v6"/>
                    <path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                </svg>
            </div>
            <div class="cp-confirm-title">Remove Cover Photo?</div>
            <div class="cp-confirm-desc">Your current cover photo will be permanently removed. This action cannot be undone.</div>
        </div>
        <div class="cp-confirm-foot">
            <button type="button" class="cp-confirm-cancel" onclick="cpConfirmClose()">Keep It</button>
            <button type="button" class="cp-confirm-delete" onclick="cpExecuteDelete()">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M2 3.5h10M5 3.5V2.5h4v1M4.5 3.5v7a1 1 0 001 1h3a1 1 0 001-1v-7"/>
                </svg>
                Yes, Remove
            </button>
        </div>
    </div>
</div>

{{-- Hidden delete form --}}
<form id="cpDeleteForm" action="{{ route('supplier.cover.delete') }}" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>


{{-- ══════════════════════════════════════════
     JAVASCRIPT
══════════════════════════════════════════ --}}
<script>
/* ── Preview: name / category ── */
function updatePreview() {
    const fn   = (document.getElementById('fi_fn')?.value || '').trim();
    const ln   = (document.getElementById('fi_ln')?.value || '').trim();
    const bn   = (document.getElementById('fi_bn')?.value || '').trim();
    const name = bn || [fn, ln].filter(Boolean).join(' ') || '{{ addslashes(Auth::user()->name) }}';

    const nameEl = document.getElementById('previewName');
    if (nameEl) nameEl.textContent = name;

    const initEl = document.getElementById('sideAvatarInitials');
    if (initEl && !document.getElementById('sideAvatar').classList.contains('has-photo')) {
        initEl.textContent = ((fn[0] || '') + (ln[0] || '')).toUpperCase() || '?';
    }
}

function updateCatPreview() {
    const selected = Array.from(
        document.querySelectorAll('.cat-chip.selected .cat-chip-name')
    ).map(el => el.textContent.trim());

    const catEl = document.getElementById('previewCategory');
    if (catEl) catEl.textContent = selected.length ? selected.join(', ') : 'No Category Set';
}

/* ── Category chips ── */
document.getElementById('cat-grid').addEventListener('change', function (e) {
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
    if (n === 0) {
        el.classList.remove('show');
    } else {
        el.classList.add('show');
        el.textContent = n + ' categor' + (n === 1 ? 'y' : 'ies') + ' selected';
    }
}
updateCatCount();
updateCatPreview();

/* ── Character counters ── */
function bvCt(id, el, max) {
    document.getElementById(id).textContent = el.value.length + ' / ' + max;
}

/* ── Photo sync helpers ── */
function _applyPhotoPreview(dataUrl, fileName) {
    /* Big avatar */
    const av  = document.getElementById('sideAvatar');
    const img = document.getElementById('sideAvatarImg');
    img.src = dataUrl;
    img.style.display = 'block';
    av.classList.add('has-photo');
    const initials = document.getElementById('sideAvatarInitials');
    if (initials) initials.style.display = 'none';
    /* Thumb */
    const et = document.getElementById('editThumb');
    const ei = document.getElementById('editThumbImg');
    if (et && ei) { ei.src = dataUrl; ei.style.display = 'block'; et.classList.add('has-photo'); }
    /* Name label */
    const pn = document.getElementById('photoName');
    if (pn) pn.textContent = fileName;
}

/* Called by the quick camera badge (label for="quickPhoto") */
function syncPhoto(input) {
    const file = input.files[0];
    if (!file) return;
    /* Transfer file to the form's hidden input */
    const dt = new DataTransfer();
    dt.items.add(file);
    document.getElementById('editPhotoInput').files = dt.files;

    const reader = new FileReader();
    reader.onload = e => _applyPhotoPreview(e.target.result, file.name);
    reader.readAsDataURL(file);
}

/* Called by the form's editPhotoInput (label inside photo zone) */
function previewPhoto(input) {
    const file = input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => _applyPhotoPreview(e.target.result, file.name);
    reader.readAsDataURL(file);
}

/* ── Cover photo modal ── */
function cpOpen()       { document.getElementById('cpModalOverlay').classList.add('open'); document.body.style.overflow = 'hidden'; }
function cpModalClose() { document.getElementById('cpModalOverlay').classList.remove('open'); document.body.style.overflow = ''; }

function cpHandleFile(input) {
    if (!input.files || !input.files[0]) return;
    const file = input.files[0];
    if (file.size > 5 * 1024 * 1024) { alert('File size must be under 5 MB.'); input.value = ''; return; }

    const reader = new FileReader();
    reader.onload = function (e) {
        const pw = document.getElementById('cpPreviewWrap');
        const pi = document.getElementById('cpPreviewImg');
        const pn = document.getElementById('cpPreviewName');
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
    const pn = document.getElementById('cpPreviewName');
    pn.textContent = ''; pn.classList.remove('show');
    document.getElementById('cpDropzone').style.display = '';
    document.getElementById('cpSaveBtn').setAttribute('disabled', 'disabled');
}

function cpApplyToForm() {
    const cpInput   = document.getElementById('cpFileInput');
    const mainInput = document.getElementById('bvCoverField'); /* ← FIXED: was bvCoverPhotoField */
    if (!cpInput.files || !cpInput.files[0]) return;

    const dt = new DataTransfer();
    dt.items.add(cpInput.files[0]);
    mainInput.files = dt.files;

    /* Update banner preview */
    const bannerImg = document.getElementById('bvBannerImg');
    if (bannerImg) {
        bannerImg.src = document.getElementById('cpPreviewImg').src;
        bannerImg.style.display = 'block';
    }
    /* Ensure overlay exists */
    if (!document.getElementById('bvBannerOverlay')) {
        const ov = document.createElement('div');
        ov.id = 'bvBannerOverlay';
        ov.className = 'bv-id-banner-overlay';
        document.getElementById('bvBanner').appendChild(ov);
    }
    const lbl = document.getElementById('bvCoverBtnLabel');
    if (lbl) lbl.textContent = 'Change Cover';

    cpModalClose();
}

/* Drag-and-drop on dropzone */
(function () {
    const dz = document.getElementById('cpDropzone');
    if (!dz) return;
    dz.addEventListener('dragover',  e => { e.preventDefault(); dz.classList.add('drag-over'); });
    dz.addEventListener('dragleave', () => dz.classList.remove('drag-over'));
    dz.addEventListener('drop', e => {
        e.preventDefault(); dz.classList.remove('drag-over');
        const fi = document.getElementById('cpFileInput');
        if (e.dataTransfer.files.length) { fi.files = e.dataTransfer.files; cpHandleFile(fi); }
    });
})();

/* ── Delete confirm ── */
function cpConfirmDelete() {
    document.getElementById('cpModalOverlay').classList.remove('open');
    document.getElementById('cpConfirmOverlay').classList.add('open');
}
function cpConfirmClose() {
    document.getElementById('cpConfirmOverlay').classList.remove('open');
    document.body.style.overflow = '';
}
function cpExecuteDelete() { document.getElementById('cpDeleteForm').submit(); }

/* Global escape key */
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') { cpModalClose(); cpConfirmClose(); }
});
</script>

</x-supplier-layout>