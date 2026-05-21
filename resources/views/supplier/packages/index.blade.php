<x-supplier-layout>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap');

        :root {
            --gold:        #C9A84C;
            --gold-light:  #E8C97A;
            --gold-dark:   #8A6A1F;
            --blush-deep:  #D4A090;
            --ivory:       #FAF7F2;
            --charcoal:    #1E1B18;
            --warm-grey:   #6B6560;
            --white:       #FFFFFF;
            --border:      #F0EBE5;
            --border-md:   #E0D8D0;
            --font-display:'Playfair Display', Georgia, serif;
            --font-body:   'DM Sans', sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-body); background: var(--ivory); color: var(--charcoal); }

        /* ── ALERT ── */
        .bv-alert-success {
            display: flex; align-items: center; gap: 0.6rem;
            background: #F0FDF4; color: #15803D;
            border: 1px solid #BBF7D0; border-radius: 4px;
            padding: 0.75rem 1.1rem; font-size: 0.83rem;
            margin: 1.25rem 2rem 0; font-family: var(--font-body);
        }
        .bv-alert-success svg { width: 16px; height: 16px; flex-shrink: 0; }

        /* ── PAGE ── */
        .page-content { padding: 1.75rem 2rem 4rem; max-width: 1200px; }
        .bv-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem; }
        .bv-page-title { font-family: var(--font-display); font-size: clamp(1.3rem, 2.5vw, 1.8rem); font-weight: 700; color: var(--charcoal); line-height: 1.15; }
        .bv-page-title em { color: var(--gold-dark); font-style: italic; }
        .bv-page-sub { font-size: 0.78rem; color: var(--warm-grey); margin-top: 0.25rem; font-family: var(--font-body); }

        /* ── PRIMARY BUTTON ── */
        .bv-btn-primary {
            display: inline-flex; align-items: center; gap: 0.45rem;
            padding: 0.62rem 1.25rem; background: var(--charcoal); color: var(--white);
            border: none; border-radius: 4px; font-size: 0.78rem; font-weight: 500;
            letter-spacing: 0.04em; text-transform: uppercase; cursor: pointer;
            font-family: var(--font-body); transition: background 0.18s, transform 0.15s;
            white-space: nowrap; position: relative; overflow: hidden;
        }
        .bv-btn-primary::after { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, #8A6A1F, #C9A84C); opacity: 0; transition: opacity 0.25s; }
        .bv-btn-primary:hover::after { opacity: 1; }
        .bv-btn-primary:hover { transform: translateY(-1px); }
        .bv-btn-primary span, .bv-btn-primary svg { position: relative; z-index: 1; }
        .bv-btn-primary svg { width: 14px; height: 14px; }

        /* ── CARD / TABLE ── */
        .bv-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; overflow: hidden; }
        .bv-table { width: 100%; border-collapse: collapse; font-size: 0.83rem; font-family: var(--font-body); }
        .bv-table thead tr { background: rgba(201,168,76,0.04); border-bottom: 1px solid var(--border); }
        .bv-table thead th { padding: 0.75rem 1.1rem; font-size: 0.62rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--gold-dark); text-align: left; white-space: nowrap; }
        .bv-table tbody tr { border-bottom: 0.5px solid var(--border); transition: background 0.15s; }
        .bv-table tbody tr:last-child { border-bottom: none; }
        .bv-table tbody tr:hover { background: rgba(201,168,76,0.03); }
        .bv-table td { padding: 0.85rem 1.1rem; vertical-align: middle; }

        .bv-row-num { display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; border-radius: 3px; background: var(--ivory); border: 1px solid var(--border-md); font-size: 0.65rem; font-weight: 700; color: var(--warm-grey); }
        .bv-pkg-name { display: flex; align-items: center; gap: 0.55rem; }
        .bv-pkg-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--gold); flex-shrink: 0; box-shadow: 0 0 0 2px rgba(201,168,76,0.18); }
        .bv-pkg-label { font-weight: 600; color: var(--charcoal); font-family: var(--font-display); font-size: 0.9rem; }
        .bv-pkg-desc { font-size: 0.78rem; color: var(--warm-grey); max-width: 200px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .bv-price-badge { display: inline-flex; align-items: center; font-family: var(--font-display); font-size: 0.92rem; font-weight: 700; color: var(--gold-dark); }
        .bv-price-badge .peso { font-size: 0.72rem; font-weight: 500; margin-right: 1px; font-family: var(--font-body); }
        .bv-cap-badge { display: inline-flex; align-items: center; gap: 4px; font-size: 0.72rem; font-weight: 500; color: var(--warm-grey); background: var(--ivory); border: 1px solid var(--border-md); padding: 3px 9px; border-radius: 2px; }
        .bv-cap-badge svg { width: 11px; height: 11px; color: var(--gold-dark); opacity: 0.7; }
        .bv-event-chip { display: inline-flex; align-items: center; gap: 4px; font-size: 0.62rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; color: var(--gold-dark); background: rgba(201,168,76,0.09); border: 1px solid rgba(201,168,76,0.22); padding: 3px 9px; border-radius: 2px; font-family: var(--font-body); }
        .bv-incl-pill { display: inline-flex; align-items: center; gap: 0.3rem; padding: 3px 9px; border-radius: 2px; font-size: 0.62rem; font-weight: 600; letter-spacing: 0.04em; background: rgba(201,168,76,0.07); color: var(--gold-dark); border: 1px solid rgba(201,168,76,0.2); cursor: pointer; font-family: var(--font-body); transition: background 0.15s, border-color 0.15s; white-space: nowrap; }
        .bv-incl-pill:hover { background: rgba(201,168,76,0.15); border-color: var(--gold); }
        .bv-incl-pill svg { width: 10px; height: 10px; }
        .bv-incl-none { font-size: 0.75rem; color: #C0B8B0; }

        .bv-actions { display: flex; gap: 0.4rem; align-items: center; }
        .bv-btn-edit { display: inline-flex; align-items: center; gap: 4px; padding: 0.35rem 0.8rem; border-radius: 3px; border: 1px solid var(--border-md); background: var(--white); font-size: 0.68rem; font-weight: 500; letter-spacing: 0.03em; color: var(--warm-grey); cursor: pointer; font-family: var(--font-body); text-decoration: none; transition: border-color 0.18s, color 0.18s; }
        .bv-btn-edit svg { width: 12px; height: 12px; }
        .bv-btn-edit:hover { border-color: var(--gold); color: var(--gold-dark); }
        .bv-btn-delete { display: inline-flex; align-items: center; gap: 4px; padding: 0.35rem 0.8rem; border-radius: 3px; border: 1px solid #FCA5A5; background: transparent; font-size: 0.68rem; font-weight: 500; letter-spacing: 0.03em; color: #B91C1C; cursor: pointer; font-family: var(--font-body); transition: background 0.18s; }
        .bv-btn-delete svg { width: 12px; height: 12px; }
        .bv-btn-delete:hover { background: #FEF2F2; }

        /* ── EMPTY ── */
        .bv-empty { text-align: center; padding: 4.5rem 2rem; }
        .bv-empty svg { width: 52px; height: 52px; color: var(--gold); opacity: 0.25; margin: 0 auto 1.1rem; display: block; }
        .bv-empty-title { font-family: var(--font-display); font-size: 1.15rem; font-weight: 600; color: var(--charcoal); margin-bottom: 0.35rem; }
        .bv-empty-sub { font-size: 0.83rem; color: var(--warm-grey); font-family: var(--font-body); line-height: 1.65; }

        /* ── STATS ── */
        .bv-stat-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem; }
        @media (max-width: 640px) { .bv-stat-row { grid-template-columns: 1fr 1fr; } }
        .bv-stat-card { background: var(--white); border: 1px solid var(--border); border-radius: 4px; padding: 1.1rem 1.25rem; position: relative; overflow: hidden; }
        .bv-stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, var(--gold), var(--blush-deep)); }
        .bv-stat-n { font-family: var(--font-display); font-size: 1.8rem; font-weight: 700; color: var(--gold-dark); line-height: 1; }
        .bv-stat-l { font-size: 0.62rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: var(--warm-grey); margin-top: 3px; font-family: var(--font-body); }
        .bv-table-wrap { overflow-x: auto; }
        .reveal { opacity: 0; transform: translateY(12px); transition: opacity 0.45s ease, transform 0.45s ease; }
        .reveal.visible { opacity: 1; transform: none; }

        /* ── TOGGLE ── */
        .bv-negotiable-toggle { display: flex; align-items: flex-start; gap: 0.85rem; padding: 0.85rem 1rem; border: 1.5px solid var(--border); border-radius: 6px; background: var(--ivory); cursor: pointer; transition: border-color 0.2s, background 0.2s; }
        .bv-negotiable-toggle:hover { border-color: var(--gold); background: rgba(201,168,76,0.04); }
        .bv-toggle-track { position: relative; width: 36px; height: 20px; flex-shrink: 0; margin-top: 2px; }
        .bv-toggle-track input { opacity: 0; width: 0; height: 0; position: absolute; }
        .bv-toggle-knob { position: absolute; inset: 0; background: var(--border-md); border-radius: 999px; transition: background 0.2s; cursor: pointer; }
        .bv-toggle-knob::after { content: ''; position: absolute; left: 3px; top: 3px; width: 14px; height: 14px; background: var(--white); border-radius: 50%; transition: transform 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.18); }
        .bv-toggle-track input:checked + .bv-toggle-knob { background: var(--gold); }
        .bv-toggle-track input:checked + .bv-toggle-knob::after { transform: translateX(16px); }
        .bv-toggle-label { display: flex; flex-direction: column; gap: 0.2rem; }
        .bv-toggle-label-main { font-size: 0.82rem; font-weight: 600; color: var(--charcoal); font-family: var(--font-body); }
        .bv-toggle-label-sub { font-size: 0.7rem; color: var(--warm-grey); font-family: var(--font-body); line-height: 1.5; }

        /* ════════════════════════
           SHARED MODAL STYLES
        ════════════════════════ */
        .bv-modal-backdrop { display: none; position: fixed; inset: 0; background: rgba(30,27,24,0.52); z-index: 200; align-items: center; justify-content: center; padding: 1.5rem; backdrop-filter: blur(3px); }
        .bv-modal-backdrop.open { display: flex; }
        .bv-modal { background: var(--white); border-radius: 4px; width: 600px; max-width: 100%; border-top: 2px solid var(--gold); max-height: calc(100vh - 3rem); display: flex; flex-direction: column; overflow: hidden; margin: auto; flex-shrink: 0; box-shadow: 0 20px 60px rgba(30,27,24,0.22); animation: bvSlide .22s ease; }
        @keyframes bvSlide { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: translateY(0); } }
        .bv-modal-header { flex-shrink: 0; display: flex; align-items: center; justify-content: space-between; padding: 1.1rem 1.5rem; border-bottom: 1px solid var(--border); background: var(--white); }
        .bv-modal-title { font-family: var(--font-display); font-size: 1.1rem; font-weight: 600; color: var(--charcoal); }
        .bv-modal-title em { font-style: italic; color: var(--gold-dark); }
        .bv-modal-close { width: 28px; height: 28px; border: 1px solid var(--border); background: var(--ivory); border-radius: 3px; cursor: pointer; font-size: 15px; color: var(--warm-grey); display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: border-color 0.18s, color 0.18s; }
        .bv-modal-close:hover { border-color: var(--gold); color: var(--gold-dark); }
        .bv-modal-body { padding: 1.4rem 1.5rem; overflow-y: auto; flex: 1; min-height: 0; background: var(--white); }
        .bv-modal-body::-webkit-scrollbar { width: 4px; }
        .bv-modal-body::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 99px; }
        .bv-field { margin-bottom: 1rem; }
        .bv-field:last-child { margin-bottom: 0; }
        .bv-field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem; }
        @media (max-width: 480px) { .bv-field-row { grid-template-columns: 1fr; } }
        .bv-label { display: flex; align-items: center; justify-content: space-between; font-size: 0.65rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--warm-grey); margin-bottom: 0.4rem; font-family: var(--font-body); }
        .bv-label-req { font-size: 0.6rem; color: #C0392B; font-weight: 500; text-transform: none; letter-spacing: 0; }
        .bv-label-opt { font-size: 0.6rem; color: #C0B8B0; font-weight: 400; text-transform: none; letter-spacing: 0; }
        .bv-input-wrap { position: relative; }
        .bv-input-icon { position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); width: 13px; height: 13px; color: #C0B8B0; pointer-events: none; transition: color 0.2s; }
        .bv-input-wrap:focus-within .bv-input-icon { color: var(--gold-dark); }
        .bv-input, .bv-select, .bv-textarea { width: 100%; border: 1.5px solid var(--border); border-radius: 6px; font-family: var(--font-body); font-size: 0.84rem; color: var(--charcoal); background: var(--ivory); outline: none; transition: border-color 0.2s, box-shadow 0.2s, background 0.2s; appearance: none; display: block; }
        .bv-input { padding: 0.65rem 0.85rem 0.65rem 2.4rem; }
        .bv-input.no-icon { padding-left: 0.85rem; }
        .bv-input:focus, .bv-select:focus, .bv-textarea:focus { border-color: var(--gold); background: var(--white); box-shadow: 0 0 0 3px rgba(201,168,76,0.12); }
        .bv-input::placeholder, .bv-textarea::placeholder { color: #C0B8B0; }
        .bv-select { padding: 0.65rem 2.4rem 0.65rem 0.85rem; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' fill='none' stroke='%23C0B8B0' stroke-width='1.5'%3E%3Cpath d='M1 1l4 4 4-4'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 0.8rem center; }
        .bv-textarea { padding: 0.65rem 0.85rem; resize: vertical; min-height: 85px; }
        .bv-hint  { font-size: 0.65rem; color: #C0B8B0; margin-top: 0.25rem; font-family: var(--font-body); }
        .bv-error { font-size: 0.65rem; color: #C0392B; margin-top: 0.25rem; font-family: var(--font-body); }
        .bv-modal-section { font-size: 0.58rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; color: #C0B8B0; padding-bottom: 0.5rem; border-bottom: 1px solid var(--border); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.4rem; font-family: var(--font-body); }
        .bv-modal-section svg { width: 10px; height: 10px; color: var(--gold-dark); }

        /* ── INCLUSIONS ── */
        .incl-list { display: flex; flex-direction: column; gap: 0.55rem; margin-bottom: 0.65rem; }
        .incl-row { display: grid; grid-template-columns: 1fr 148px 30px; gap: 0.5rem; align-items: center; }
        @media (max-width: 480px) { .incl-row { grid-template-columns: 1fr 110px 28px; } }
        .incl-title-inp { width: 100%; padding: 0.58rem 0.8rem; border: 1.5px solid var(--border); border-radius: 5px; font-family: var(--font-body); font-size: 0.82rem; color: var(--charcoal); background: var(--ivory); outline: none; transition: border-color 0.18s, box-shadow 0.18s, background 0.18s; }
        .incl-title-inp:focus { border-color: var(--gold); background: var(--white); box-shadow: 0 0 0 3px rgba(201,168,76,0.12); }
        .incl-title-inp::placeholder { color: #C0B8B0; }
        .incl-type-sel { width: 100%; padding: 0.58rem 2rem 0.58rem 0.75rem; border: 1.5px solid var(--border); border-radius: 5px; font-family: var(--font-body); font-size: 0.78rem; color: var(--charcoal); background: var(--ivory); outline: none; appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' fill='none' stroke='%23C0B8B0' stroke-width='1.5'%3E%3Cpath d='M1 1l4 4 4-4'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 0.6rem center; transition: border-color 0.18s, box-shadow 0.18s, background 0.18s; }
        .incl-type-sel:focus { border-color: var(--gold); background: var(--white); box-shadow: 0 0 0 3px rgba(201,168,76,0.12); }
        .incl-remove { width: 30px; height: 30px; flex-shrink: 0; border: 1px solid #FCA5A5; background: transparent; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #B91C1C; transition: background 0.15s, border-color 0.15s; }
        .incl-remove:hover { background: #FEF2F2; border-color: #B91C1C; }
        .incl-remove:disabled { opacity: 0.35; cursor: not-allowed; pointer-events: none; }
        .incl-remove svg { width: 11px; height: 11px; pointer-events: none; }
        .btn-add-incl { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.42rem 0.9rem; border-radius: 3px; border: 1.5px dashed var(--border-md); background: transparent; font-size: 0.72rem; font-weight: 500; color: var(--warm-grey); cursor: pointer; font-family: var(--font-body); transition: border-color 0.18s, color 0.18s, background 0.18s; }
        .btn-add-incl:hover { border-color: var(--gold); color: var(--gold-dark); background: rgba(201,168,76,0.05); }
        .btn-add-incl svg { width: 12px; height: 12px; }

        /* ── MODAL FOOTER ── */
        .bv-modal-footer { flex-shrink: 0; padding: 0.9rem 1.5rem; border-top: 1px solid var(--border); display: flex; gap: 0.5rem; justify-content: flex-end; background: var(--white); }
        .bv-btn-cancel { padding: 0.6rem 1.1rem; border-radius: 4px; border: 1px solid var(--border-md); background: var(--white); font-size: 0.78rem; font-weight: 500; color: var(--warm-grey); cursor: pointer; font-family: var(--font-body); transition: border-color 0.18s, color 0.18s; }
        .bv-btn-cancel:hover { border-color: var(--gold); color: var(--charcoal); }
        .bv-btn-save { padding: 0.6rem 1.4rem; border-radius: 4px; border: none; background: var(--gold); color: var(--charcoal); font-size: 0.78rem; font-weight: 600; letter-spacing: 0.04em; text-transform: uppercase; cursor: pointer; font-family: var(--font-body); transition: background 0.18s, transform 0.15s; }
        .bv-btn-save:hover { background: var(--gold-light); transform: translateY(-1px); }

        /* ── VIEW INCLUSIONS MODAL ── */
        .bv-view-modal { background: var(--white); border-radius: 4px; width: 460px; max-width: 100%; border-top: 2px solid var(--gold); max-height: calc(100vh - 3rem); display: flex; flex-direction: column; overflow: hidden; margin: auto; flex-shrink: 0; box-shadow: 0 20px 60px rgba(30,27,24,0.22); animation: bvSlide .22s ease; }
        .bv-incl-view-list { display: flex; flex-direction: column; gap: 0.5rem; }
        .bv-incl-view-item { display: flex; align-items: flex-start; gap: 0.65rem; padding: 0.6rem 0.85rem; border-radius: 4px; background: var(--ivory); border: 1px solid var(--border); font-size: 0.82rem; color: var(--charcoal); font-family: var(--font-body); line-height: 1.4; }
        .bv-incl-view-num { width: 20px; height: 20px; border-radius: 50%; background: rgba(201,168,76,0.12); border: 1px solid rgba(201,168,76,0.25); display: flex; align-items: center; justify-content: center; font-size: 0.58rem; font-weight: 700; color: var(--gold-dark); flex-shrink: 0; margin-top: 1px; }
        .bv-incl-view-type { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.07em; text-transform: uppercase; color: var(--gold-dark); background: rgba(201,168,76,0.08); border: 1px solid rgba(201,168,76,0.2); padding: 1px 6px; border-radius: 2px; margin-left: auto; white-space: nowrap; flex-shrink: 0; }
        .bv-incl-view-empty { text-align: center; padding: 2rem; font-size: 0.82rem; color: #C0B8B0; font-family: var(--font-body); }

        /* ════════════════════════
           DELETE CONFIRM MODAL
        ════════════════════════ */
        .bv-delete-modal {
            background: var(--white); border-radius: 4px;
            width: 440px; max-width: 100%;
            border-top: 2px solid #B91C1C;
            display: flex; flex-direction: column; overflow: hidden;
            margin: auto; flex-shrink: 0;
            box-shadow: 0 20px 60px rgba(30,27,24,0.22);
            animation: bvSlide .22s ease;
        }

        /* Delete modal icon ring */
        .bv-del-icon-ring {
            width: 56px; height: 56px; border-radius: 50%;
            background: #FEF2F2; border: 2px solid #FCA5A5;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem; flex-shrink: 0;
            color: #B91C1C;
        }
        .bv-del-icon-ring svg { width: 24px; height: 24px; }

        .bv-del-pkg-badge {
            display: inline-flex; align-items: center; gap: 0.35rem;
            padding: 0.38rem 0.85rem; border-radius: 3px;
            background: var(--ivory); border: 1px solid var(--border-md);
            font-family: var(--font-display); font-size: 0.88rem; font-weight: 700;
            color: var(--charcoal); margin: 0.65rem 0 1.1rem;
        }
        .bv-del-pkg-badge::before {
            content: ''; width: 6px; height: 6px; border-radius: 50%;
            background: #B91C1C; flex-shrink: 0;
        }

        /* Delete confirm button */
        .bv-btn-confirm-delete {
            padding: 0.6rem 1.4rem; border-radius: 4px; border: none;
            background: #B91C1C; color: var(--white);
            font-size: 0.78rem; font-weight: 600; letter-spacing: 0.04em;
            text-transform: uppercase; cursor: pointer; font-family: var(--font-body);
            transition: background 0.18s, transform 0.15s;
            display: inline-flex; align-items: center; gap: 0.4rem;
        }
        .bv-btn-confirm-delete svg { width: 13px; height: 13px; }
        .bv-btn-confirm-delete:hover { background: #991B1B; transform: translateY(-1px); }

        @media (max-width: 700px) {
            .page-content { padding: 1.25rem 1rem 3rem; }
            .bv-alert-success { margin: 1rem 1rem 0; }
        }
    </style>

    {{-- ── SUCCESS FLASH ── --}}
    @if(session('success'))
    <div class="bv-alert-success">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Packages') }}</h2>
    </x-slot>

    <div class="page-content">

        {{-- ── PAGE HEADER ── --}}
        <div class="bv-page-header">
            <div>
                <h1 class="bv-page-title">My <em>Packages</em></h1>
                <p class="bv-page-sub">Create and manage your service packages for clients.</p>
            </div>
            <button onclick="openModal('add')" class="bv-btn-primary">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M10 4v12M4 10h12"/></svg>
                <span>Add Package</span>
            </button>
        </div>

        {{-- ── STATS ── --}}
        @if(isset($packages) && $packages->count())
        <div class="bv-stat-row reveal">
            <div class="bv-stat-card">
                <div class="bv-stat-n">{{ $packages->count() }}</div>
                <div class="bv-stat-l">Total Packages</div>
            </div>
            <div class="bv-stat-card">
                <div class="bv-stat-n">₱{{ number_format($packages->avg('price') ?? 0, 0) }}</div>
                <div class="bv-stat-l">Avg. Price</div>
            </div>
            <div class="bv-stat-card">
                <div class="bv-stat-n">{{ number_format($packages->avg('guest_capacity') ?? 0, 0) }}</div>
                <div class="bv-stat-l">Avg. Capacity</div>
            </div>
        </div>
        @endif

        {{-- ── TABLE CARD ── --}}
        <div class="bv-card reveal">
            @if(isset($packages) && $packages->count())
            <div class="bv-table-wrap">
                <table class="bv-table">
                    <thead>
                        <tr>
                            <th style="width:48px">#</th>
                            <th>Package Name</th>
                            <th>Event Type</th>
                            <th>Price</th>
                            <th>Guests</th>
                            <th>Description</th>
                            <th>Inclusions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($packages as $i => $package)
                        @php
                            $inclusions = $package->inclusions ?? collect();
                            $inclCount  = $inclusions->count();
                            $inclData   = $inclusions->map(fn($inc) => [
                                'title' => $inc->title ?? '',
                                'type'  => $inc->type  ?? '',
                            ])->values()->toArray();
                        @endphp
                        <tr>
                            <td><span class="bv-row-num">{{ $i + 1 }}</span></td>
                            <td>
                                <div class="bv-pkg-name">
                                    <span class="bv-pkg-dot"></span>
                                    <span class="bv-pkg-label">{{ $package->name }}</span>
                                </div>
                            </td>
                            <td>
                                @if($package->event_type)
                                    <span class="bv-event-chip">{{ $package->event_type }}</span>
                                @else
                                    <span style="color:#C0B8B0;font-size:0.75rem;">—</span>
                                @endif
                            </td>
                            <td>
                                @if($package->price)
                                    <span class="bv-price-badge"><span class="peso">₱</span>{{ number_format($package->price, 2) }}</span>
                                @else
                                    <span style="color:#C0B8B0;font-size:0.75rem;">—</span>
                                @endif
                            </td>
                            <td>
                                @if($package->guest_capacity)
                                    <span class="bv-cap-badge">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                                            <circle cx="9" cy="7" r="4"/>
                                            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                                        </svg>
                                        {{ number_format($package->guest_capacity) }}
                                    </span>
                                @else
                                    <span style="color:#C0B8B0;font-size:0.75rem;">—</span>
                                @endif
                            </td>
                            <td>
                                <span class="bv-pkg-desc" title="{{ $package->description }}">
                                    {{ $package->description ? Str::limit($package->description, 55) : '—' }}
                                </span>
                            </td>
                            <td>
                                @if($inclCount > 0)
                                    <button type="button" class="bv-incl-pill"
                                        data-pkg-name="{{ $package->name }}"
                                        data-inclusions="{{ json_encode($inclData) }}"
                                        onclick="openViewModal(this)">
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 5h12M2 8h8M2 11h5"/></svg>
                                        {{ $inclCount }} item{{ $inclCount !== 1 ? 's' : '' }}
                                    </button>
                                @else
                                    <span class="bv-incl-none">None</span>
                                @endif
                            </td>
                            <td>
                                <div class="bv-actions">
                                    {{-- EDIT --}}
                                    <button type="button" class="bv-btn-edit"
                                        data-id="{{ $package->id }}"
                                        data-name="{{ $package->name }}"
                                        data-description="{{ $package->description ?? '' }}"
                                        data-price="{{ $package->price ?? '' }}"
                                        data-capacity="{{ $package->guest_capacity ?? '' }}"
                                        data-event-type="{{ $package->event_type ?? '' }}"
                                        data-inclusions="{{ json_encode($inclData) }}"
                                        onclick="openEditModal(this)">
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M11.5 2.5l2 2L5 13H3v-2L11.5 2.5z"/></svg>
                                        Edit
                                    </button>

                                    {{-- DELETE — opens modal instead of confirm() ── --}}
                                    <button type="button" class="bv-btn-delete"
                                        data-id="{{ $package->id }}"
                                        data-name="{{ $package->name }}"
                                        data-action="{{ route('supplier.package.destroy', $package->id) }}"
                                        onclick="openDeleteModal(this)">
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                            <path d="M3 4h10M6 4V3h4v1M5 4v8a1 1 0 001 1h4a1 1 0 001-1V4"/>
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="bv-empty">
                <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4">
                    <rect x="8" y="10" width="32" height="30" rx="3"/>
                    <path d="M16 20h16M16 27h10M24 4v6M18 4l6 6 6-6"/>
                </svg>
                <div class="bv-empty-title">No packages yet</div>
                <p class="bv-empty-sub">Click <strong>Add Package</strong> to create your first service package.</p>
            </div>
            @endif
        </div>

    </div>{{-- /page-content --}}


    {{-- ════════════════════════════════════════
         ADD / EDIT PACKAGE MODAL
    ════════════════════════════════════════ --}}
    <div id="packageModal" class="bv-modal-backdrop">
        <div class="bv-modal">
            <div class="bv-modal-header">
                <span class="bv-modal-title" id="modal-title">Add <em>Package</em></span>
                <button class="bv-modal-close" onclick="closeModal()">✕</button>
            </div>

            <form method="POST" id="package-form" action="{{ route('supplier.package.store') }}" style="display:contents;">
                @csrf
                <span id="method-field"></span>

                <div class="bv-modal-body">

                    <div class="bv-modal-section">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="10" height="10" rx="2"/><path d="M5 7h4M7 5v4"/></svg>
                        Package Details
                    </div>

                    <div class="bv-field">
                        <label class="bv-label" for="pkg_name">Package Name <span class="bv-label-req">Required</span></label>
                        <div class="bv-input-wrap">
                            <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="5" width="14" height="11" rx="2"/><path d="M7 9h6M7 12h4"/></svg>
                            <input id="pkg_name" name="name" type="text" class="bv-input" placeholder="e.g. Gold Wedding Package, Debut Deluxe…" required>
                        </div>
                        @error('name')<div class="bv-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="bv-field">
                        <label class="bv-label" for="pkg_event_type">Event Type <span class="bv-label-req">Required</span></label>
                        <div class="bv-input-wrap">
                            <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="4" width="14" height="13" rx="2"/><path d="M7 2v4M13 2v4M3 9h14"/></svg>
                            <select id="pkg_event_type" name="event_type" class="bv-input" required style="padding-left:2.4rem;">
                                <option value="" disabled selected>Select an event type…</option>
                                @foreach($eventcategories as $ec)
                                    <option value="{{ $ec->name }}" {{ old('event_type') == $ec->name ? 'selected' : '' }}>{{ $ec->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="bv-hint">The type of event this package is designed for.</p>
                        @error('event_type')<div class="bv-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="bv-modal-section" style="margin-top:1.25rem;">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="5.5"/><path d="M7 3v8M5 5.5h3a1 1 0 010 2H5.5a1 1 0 000 2H9"/></svg>
                        Pricing & Capacity
                    </div>

                    <div class="bv-field-row">
                        <div class="bv-field" style="margin-bottom:0;">
                            <label class="bv-label" for="pkg_price">Price (₱) <span class="bv-label-opt">Optional</span></label>
                            <div class="bv-input-wrap">
                                <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><line x1="10" y1="2" x2="10" y2="18"/><path d="M14 6H8a2 2 0 000 4h4a2 2 0 010 4H6"/></svg>
                                <input id="pkg_price" name="price" type="number" step="0.01" min="0" class="bv-input" placeholder="e.g. 25000">
                            </div>
                            @error('price')<div class="bv-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="bv-field" style="margin-bottom:0;">
                            <label class="bv-label" for="pkg_capacity">Guest Capacity <span class="bv-label-opt">Optional</span></label>
                            <div class="bv-input-wrap">
                                <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M13 17v-1a4 4 0 00-4-4H5a4 4 0 00-4 4v1"/><circle cx="7" cy="7" r="4"/><path d="M18 17v-1a4 4 0 00-3-3.87M15 3.13a4 4 0 010 7.75"/></svg>
                                <input id="pkg_capacity" name="guest_capacity" type="number" min="1" class="bv-input" placeholder="e.g. 150">
                            </div>
                            @error('guest_capacity')<div class="bv-error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="bv-modal-section" style="margin-top:1.25rem;">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 4h10M2 7h8M2 10h6"/></svg>
                        Description
                    </div>

                    <div class="bv-field">
                        <label class="bv-label" for="pkg_desc">Package Description <span class="bv-label-opt">Optional</span></label>
                        <textarea id="pkg_desc" name="description" class="bv-textarea" placeholder="Describe what's included — catering, decor, hours, add-ons…" maxlength="1000" oninput="updateCount(this)"></textarea>
                        <div style="display:flex;justify-content:flex-end;margin-top:4px;">
                            <span id="desc-count" style="font-size:0.62rem;color:#C0B8B0;font-family:var(--font-body);">0 / 1000</span>
                        </div>
                        @error('description')<div class="bv-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="bv-modal-section" style="margin-top:1.25rem;">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 10l4-4 2 2 4-5"/><circle cx="12" cy="3" r="1.5"/></svg>
                        Negotiation Settings
                        <span style="font-size:0.58rem;color:#C0B8B0;margin-left:0.25rem;">— Optional</span>
                    </div>

                    <div class="bv-field-row" style="margin-bottom:0.85rem;">
                        <div class="bv-field" style="margin-bottom:0;">
                            <label class="bv-label" for="pkg_min_price">Min Price (₱) <span class="bv-label-opt">Optional</span></label>
                            <div class="bv-input-wrap">
                                <svg class="bv-input-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7"><line x1="10" y1="2" x2="10" y2="18"/><path d="M14 6H8a2 2 0 000 4h4a2 2 0 010 4H6"/></svg>
                                <input id="pkg_min_price" name="min_price" type="number" step="0.01" min="0" class="bv-input" placeholder="e.g. 15000" value="{{ old('min_price') }}">
                            </div>
                            @error('min_price')<div class="bv-error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="bv-field">
                        <label class="bv-negotiable-toggle" for="pkg_is_negotiable">
                            <div class="bv-toggle-track">
                                <input type="checkbox" id="pkg_is_negotiable" name="is_negotiable" value="1" {{ old('is_negotiable') ? 'checked' : '' }}>
                                <span class="bv-toggle-knob"></span>
                            </div>
                            <div class="bv-toggle-label">
                                <span class="bv-toggle-label-main">Allow Negotiation</span>
                                <span class="bv-toggle-label-sub">Clients can submit offers within your min–max price range (Pool System)</span>
                            </div>
                        </label>
                    </div>

                    <div class="bv-modal-section" style="margin-top:1.25rem;">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 4h10M2 7h10M2 10h10"/></svg>
                        Inclusions
                        <span style="font-size:0.58rem;color:#C0B8B0;margin-left:0.25rem;">— What's included in this package</span>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 148px 30px;gap:0.5rem;padding:0 0 0.35rem;margin-bottom:0.1rem;">
                        <span style="font-size:0.6rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#C0B8B0;font-family:var(--font-body);">Item / Title</span>
                        <span style="font-size:0.6rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#C0B8B0;font-family:var(--font-body);">Type</span>
                        <span></span>
                    </div>

                    <div id="incl-list" class="incl-list"></div>

                    <button type="button" class="btn-add-incl" onclick="addInclusionRow('incl-list')">
                        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 1v10M1 6h10"/></svg>
                        Add Inclusion
                    </button>

                </div>{{-- /modal-body --}}

                <div class="bv-modal-footer">
                    <button type="button" class="bv-btn-cancel" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="bv-btn-save">Save Package</button>
                </div>
            </form>
        </div>
    </div>


    {{-- ════════════════════════════════════════
         VIEW INCLUSIONS MODAL
    ════════════════════════════════════════ --}}
    <div id="viewInclModal" class="bv-modal-backdrop">
        <div class="bv-view-modal">
            <div class="bv-modal-header">
                <span class="bv-modal-title"><em id="view-pkg-name">Package</em> — Inclusions</span>
                <button class="bv-modal-close" onclick="closeViewModal()">✕</button>
            </div>
            <div class="bv-modal-body">
                <div id="view-incl-list" class="bv-incl-view-list"></div>
            </div>
            <div class="bv-modal-footer">
                <button type="button" class="bv-btn-cancel" onclick="closeViewModal()">Close</button>
            </div>
        </div>
    </div>


    {{-- ════════════════════════════════════════
         DELETE CONFIRMATION MODAL
    ════════════════════════════════════════ --}}
    <div id="deleteModal" class="bv-modal-backdrop">
        <div class="bv-delete-modal">

            {{-- Header --}}
            <div class="bv-modal-header" style="border-top-color:#B91C1C;">
                <span class="bv-modal-title" style="color:#B91C1C;">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" style="display:inline;vertical-align:-3px;margin-right:6px;">
                        <circle cx="10" cy="10" r="8"/>
                        <path d="M10 6v4M10 13.5v.5"/>
                    </svg>
                    Delete Package
                </span>
                <button class="bv-modal-close" onclick="closeDeleteModal()">✕</button>
            </div>

            {{-- Body --}}
            <div class="bv-modal-body" style="text-align:center;padding:1.75rem 1.5rem;">

                <div class="bv-del-icon-ring">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path d="M3 6h18M8 6V4h8v2M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                        <path d="M10 11v6M14 11v6"/>
                    </svg>
                </div>

                <p style="font-size:0.9rem;color:var(--warm-grey);line-height:1.6;font-family:var(--font-body);">
                    Are you sure you want to delete
                </p>
                <div class="bv-del-pkg-badge" id="del-pkg-badge">Package Name</div>
                <p style="font-size:0.78rem;color:#C0B8B0;line-height:1.55;font-family:var(--font-body);">
                    This action <strong style="color:#B91C1C;">cannot be undone</strong>. All inclusions and associated data will be permanently removed.
                </p>

            </div>

            {{-- Footer --}}
            <div class="bv-modal-footer" style="border-top:1px solid #FEE2E2;background:#FFFBFB;">
                <button type="button" class="bv-btn-cancel" onclick="closeDeleteModal()">
                    Cancel
                </button>
                <form id="delete-form" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bv-btn-confirm-delete">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M3 4h10M6 4V3h4v1M5 4v8a1 1 0 001 1h4a1 1 0 001-1V4"/>
                        </svg>
                        Yes, Delete Package
                    </button>
                </form>
            </div>

        </div>
    </div>


    <script>
    /* ══════════════════════════════════════════
       INCLUSION HELPERS
    ══════════════════════════════════════════ */
    var INCL_TYPES = [
        { value: '',          label: '— Type —' },
        { value: 'photo',     label: 'Photography' },
        { value: 'video',     label: 'Videography' },
        { value: 'styling',   label: 'Styling / Decor' },
        { value: 'audio',     label: 'Sound System' },
        { value: 'lighting',  label: 'Lighting' },
        { value: 'catering',  label: 'Catering' },
        { value: 'venue',     label: 'Venue' },
        { value: 'transport', label: 'Transportation' },
        { value: 'other',     label: 'Other' },
    ];

    function buildTypeOptions(selected) {
        return INCL_TYPES.map(function(o) {
            return '<option value="' + o.value + '"' + (o.value === selected ? ' selected' : '') + '>' + o.label + '</option>';
        }).join('');
    }

    function makeInclRow(listId, titleVal, typeVal) {
        titleVal = titleVal || ''; typeVal = typeVal || '';
        var row = document.createElement('div');
        row.className = 'incl-row';
        row.innerHTML =
            '<input type="text" name="inclusions[]" class="incl-title-inp"' +
                ' placeholder="e.g. Floral centrepiece, 8-hr venue rental…"' +
                ' value="' + escAttr(titleVal) + '">' +
            '<select name="inclusion_types[]" class="incl-type-sel">' + buildTypeOptions(typeVal) + '</select>' +
            '<button type="button" class="incl-remove" title="Remove" onclick="removeInclRow(this)">' +
                '<svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 1l10 10M11 1L1 11"/></svg>' +
            '</button>';
        return row;
    }

    function addInclusionRow(listId) {
        var list = document.getElementById(listId);
        var row  = makeInclRow(listId, '', '');
        list.appendChild(row);
        syncRemoveBtns(listId);
        row.querySelector('.incl-title-inp').focus();
    }

    function removeInclRow(btn) {
        var row    = btn.closest('.incl-row');
        var listId = row.parentElement.id;
        row.remove();
        syncRemoveBtns(listId);
    }

    function syncRemoveBtns(listId) {
        var rows = document.querySelectorAll('#' + listId + ' .incl-row');
        rows.forEach(function(r) { r.querySelector('.incl-remove').disabled = (rows.length === 1); });
    }

    function resetInclList(listId) {
        var list = document.getElementById(listId);
        list.innerHTML = '';
        list.appendChild(makeInclRow(listId, '', ''));
        syncRemoveBtns(listId);
    }

    function populateInclList(listId, items) {
        var list = document.getElementById(listId);
        list.innerHTML = '';
        if (!items || items.length === 0) {
            list.appendChild(makeInclRow(listId, '', ''));
        } else {
            items.forEach(function(item) {
                var t  = (typeof item === 'string') ? item : (item.title || '');
                var tp = (typeof item === 'object') ? (item.type  || '') : '';
                list.appendChild(makeInclRow(listId, t, tp));
            });
        }
        syncRemoveBtns(listId);
    }

    function escAttr(str) {
        return String(str).replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/'/g,'&#39;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    }
    function escHtml(str) {
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#039;');
    }

    /* ══════════════════════════════════════════
       ADD / EDIT MODAL
    ══════════════════════════════════════════ */
    function openModal() {
        var form = document.getElementById('package-form');
        document.getElementById('modal-title').innerHTML = 'Add <em>Package</em>';
        document.getElementById('method-field').innerHTML = '';
        form.action = '{{ route('supplier.package.store') }}';
        form.reset();
        document.getElementById('desc-count').textContent = '0 / 1000';
        resetInclList('incl-list');
        document.getElementById('packageModal').classList.add('open');
        document.body.style.overflow = 'hidden';
        setTimeout(function() { document.getElementById('pkg_name').focus(); }, 80);
    }

    function openEditModal(btn) {
        var inclusions = [];
        try { inclusions = JSON.parse(btn.dataset.inclusions || '[]'); } catch(e) {}

        var form = document.getElementById('package-form');
        form.action = '/supplier/packages/' + btn.dataset.id;
        document.getElementById('method-field').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('modal-title').innerHTML = 'Edit <em>Package</em>';

        document.getElementById('pkg_name').value       = btn.dataset.name        || '';
        document.getElementById('pkg_desc').value       = btn.dataset.description || '';
        document.getElementById('pkg_price').value      = btn.dataset.price       || '';
        document.getElementById('pkg_capacity').value   = btn.dataset.capacity    || '';
        document.getElementById('pkg_event_type').value = btn.dataset.eventType   || '';
        document.getElementById('desc-count').textContent = (btn.dataset.description || '').length + ' / 1000';

        populateInclList('incl-list', inclusions);

        document.getElementById('packageModal').classList.add('open');
        document.body.style.overflow = 'hidden';
        setTimeout(function() { document.getElementById('pkg_name').focus(); }, 80);
    }

    function closeModal() {
        document.getElementById('packageModal').classList.remove('open');
        document.body.style.overflow = '';
    }

    document.getElementById('packageModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    /* ══════════════════════════════════════════
       VIEW INCLUSIONS MODAL
    ══════════════════════════════════════════ */
    function openViewModal(btn) {
        var pkgName = btn.dataset.pkgName || 'Package';
        var inclusions = [];
        try { inclusions = JSON.parse(btn.dataset.inclusions || '[]'); } catch(e) {}

        document.getElementById('view-pkg-name').textContent = pkgName;

        var list  = document.getElementById('view-incl-list');
        list.innerHTML = '';
        var items = inclusions.filter(function(i) { return i && (i.title || i); });

        if (items.length === 0) {
            list.innerHTML = '<div class="bv-incl-view-empty">No inclusions listed for this package.</div>';
        } else {
            items.forEach(function(item, idx) {
                var title = (typeof item === 'string') ? item : (item.title || '');
                var type  = (typeof item === 'object') ? (item.type  || '') : '';
                var el = document.createElement('div');
                el.className = 'bv-incl-view-item';
                el.innerHTML =
                    '<span class="bv-incl-view-num">' + (idx + 1) + '</span>' +
                    '<span style="flex:1;">' + escHtml(title) + '</span>' +
                    (type ? '<span class="bv-incl-view-type">' + escHtml(type) + '</span>' : '');
                list.appendChild(el);
            });
        }

        document.getElementById('viewInclModal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeViewModal() {
        document.getElementById('viewInclModal').classList.remove('open');
        document.body.style.overflow = '';
    }

    document.getElementById('viewInclModal').addEventListener('click', function(e) {
        if (e.target === this) closeViewModal();
    });

    /* ══════════════════════════════════════════
       DELETE CONFIRMATION MODAL
    ══════════════════════════════════════════ */
    function openDeleteModal(btn) {
        var name   = btn.dataset.name   || 'this package';
        var action = btn.dataset.action || '#';

        /* Show package name in the modal body */
        document.getElementById('del-pkg-badge').textContent = name;

        /* Point the hidden form to the right destroy route */
        document.getElementById('delete-form').action = action;

        document.getElementById('deleteModal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('open');
        document.body.style.overflow = '';
    }

    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });

    /* ══════════════════════════════════════════
       MISC
    ══════════════════════════════════════════ */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') { closeModal(); closeViewModal(); closeDeleteModal(); }
    });

    function updateCount(el) {
        document.getElementById('desc-count').textContent = el.value.length + ' / 1000';
    }

    document.addEventListener('DOMContentLoaded', function() {
        resetInclList('incl-list');
    });

    /* Auto-open on validation error */
    @if($errors->has('name') || $errors->has('description') || $errors->has('price') || $errors->has('guest_capacity') || $errors->has('event_type'))
        document.addEventListener('DOMContentLoaded', function() {
            openModal();
            document.getElementById('pkg_name').value       = '{{ addslashes(old('name', '')) }}';
            document.getElementById('pkg_desc').value       = '{{ addslashes(old('description', '')) }}';
            document.getElementById('pkg_price').value      = '{{ old('price', '') }}';
            document.getElementById('pkg_capacity').value   = '{{ old('guest_capacity', '') }}';
            document.getElementById('pkg_event_type').value = '{{ addslashes(old('event_type', '')) }}';
            var ta = document.getElementById('pkg_desc');
            document.getElementById('desc-count').textContent = ta.value.length + ' / 1000';
            @if(old('inclusions'))
                var oldIncl  = @json(old('inclusions', []));
                var oldTypes = @json(old('inclusion_types', []));
                var combined = oldIncl.map(function(t, i) { return { title: t, type: oldTypes[i] || '' }; });
                populateInclList('incl-list', combined);
            @endif
        });
    @endif

    /* Scroll reveal */
    var io = new IntersectionObserver(function(entries) {
        entries.forEach(function(e, i) {
            if (e.isIntersecting) {
                setTimeout(function() { e.target.classList.add('visible'); }, i * 60);
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.07 });
    document.querySelectorAll('.reveal').forEach(function(el) { io.observe(el); });
    </script>

</x-supplier-layout>