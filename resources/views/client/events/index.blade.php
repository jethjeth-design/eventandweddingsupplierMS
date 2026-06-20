<x-client-layout>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=DM+Sans:wght@300;400;500&display=swap');

        :root {
            --gold: #C9A84C;
            --gold-dark: #8A6A1F;
            --gold-light: rgba(201, 168, 76, 0.12);
            --ivory: #FAF7F2;
            --charcoal: #1E1B18;
            --warm-grey: #706B65;
            --border: #E5DDD5;
            --border-md: #E0D8D0;
            --white: #FFFFFF;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body: 'DM Sans', sans-serif;
            --radius-card: 14px;
            --radius-btn: 8px;
            --shadow-card: 0 2px 16px rgba(30, 27, 24, .07);
            --shadow-hover: 0 6px 28px rgba(30, 27, 24, .13);
            --shadow-modal: 0 8px 40px rgba(30, 27, 24, .2);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* ── PAGE ── */
        .cal-page {
            max-width: 1300px;
            margin: auto;
            padding: 1.75rem 1.5rem 3rem;
        }

        .cal-page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 1.75rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .cal-page-title {
            font-family: var(--font-display);
            font-size: 1.65rem;
            font-weight: 700;
            color: var(--charcoal);
            line-height: 1.15;
        }

        .cal-page-title em {
            font-style: italic;
            color: var(--gold-dark);
        }

        .cal-page-sub {
            font-size: .76rem;
            color: var(--warm-grey);
            margin-top: .2rem;
            font-family: var(--font-body);
        }

        .cal-btn-add {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .6rem 1.3rem;
            border-radius: var(--radius-btn);
            border: none;
            background: var(--charcoal);
            font-family: var(--font-body);
            font-size: .8rem;
            font-weight: 600;
            color: var(--white);
            cursor: pointer;
            transition: background .2s, box-shadow .2s, transform .15s;
            white-space: nowrap;
        }

        .cal-btn-add svg {
            width: 13px;
            height: 13px;
            flex-shrink: 0;
        }

        .cal-btn-add:hover {
            background: var(--gold-dark);
            box-shadow: 0 4px 12px rgba(201, 168, 76, .25);
            transform: translateY(-1px);
        }

        /* ── OUTER LAYOUT ── */
        .cal-outer {
            display: grid;
            grid-template-columns: 1fr 310px;
            gap: 1.5rem;
            align-items: start;
        }

        @media(max-width:960px) {
            .cal-outer {
                grid-template-columns: 1fr;
            }
        }

        /* ── CALENDAR CARD ── */
        .cal-card {
            background: var(--white);
            border-radius: var(--radius-card);
            border: 1.5px solid var(--border);
            box-shadow: var(--shadow-card);
            overflow: hidden;
        }

        .cal-card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.4rem;
            border-bottom: 1px solid #F5EFE8;
            flex-wrap: wrap;
            gap: .65rem;
        }

        .cal-card-head-l {
            display: flex;
            align-items: center;
            gap: .65rem;
        }

        .cal-card-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--gold-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-dark);
            flex-shrink: 0;
        }

        .cal-card-icon svg {
            width: 15px;
            height: 15px;
        }

        .cal-card-title {
            font-family: var(--font-display);
            font-size: .92rem;
            font-weight: 700;
            color: var(--charcoal);
        }

        .cal-card-desc {
            font-size: .68rem;
            color: var(--warm-grey);
            margin-top: .04rem;
            font-family: var(--font-body);
        }

        .cal-card-body {
            padding: 1.25rem 1.4rem;
        }

        /* ── FULLCALENDAR OVERRIDES ── */
        .fc {
            font-family: var(--font-body) !important;
        }

        .fc .fc-toolbar-title {
            font-family: var(--font-display) !important;
            font-size: 1.1rem !important;
            font-weight: 700 !important;
            color: var(--charcoal) !important;
        }

        .fc .fc-button {
            font-family: var(--font-body) !important;
            font-size: .75rem !important;
            font-weight: 600 !important;
            background: var(--white) !important;
            color: var(--warm-grey) !important;
            border: 1.5px solid var(--border) !important;
            border-radius: 6px !important;
            padding: .35rem .75rem !important;
            box-shadow: none !important;
            transition: border-color .18s, color .18s, background .18s !important;
        }

        .fc .fc-button:hover {
            border-color: var(--gold) !important;
            color: var(--gold-dark) !important;
            background: var(--gold-light) !important;
        }

        .fc .fc-button-primary:not(.fc-button-active):focus {
            box-shadow: none !important;
        }

        .fc .fc-button-active,
        .fc .fc-button-primary:not(:disabled).fc-button-active {
            background: var(--charcoal) !important;
            color: var(--white) !important;
            border-color: var(--charcoal) !important;
        }

        .fc .fc-col-header-cell {
            background: var(--ivory) !important;
        }

        .fc .fc-col-header-cell-cushion {
            font-family: var(--font-body) !important;
            font-size: .68rem !important;
            font-weight: 700 !important;
            letter-spacing: .06em !important;
            text-transform: uppercase !important;
            color: var(--warm-grey) !important;
            text-decoration: none !important;
            padding: .55rem 0 !important;
        }

        .fc .fc-daygrid-day-number {
            font-family: var(--font-body) !important;
            font-size: .78rem !important;
            font-weight: 500 !important;
            color: var(--warm-grey) !important;
            text-decoration: none !important;
            padding: .45rem .6rem !important;
        }

        .fc .fc-day-today {
            background: rgba(201, 168, 76, .06) !important;
        }

        .fc .fc-day-today .fc-daygrid-day-number {
            color: var(--gold-dark) !important;
            font-weight: 700 !important;
        }

        .fc .fc-daygrid-day:hover {
            background: rgba(201, 168, 76, .04) !important;
            cursor: pointer;
        }

        .fc .fc-daygrid-day.fc-day-selected-custom {
            background: rgba(59, 111, 240, .07) !important;
        }

        .fc .fc-daygrid-day.fc-day-selected-custom .fc-daygrid-day-number {
            background: linear-gradient(145deg, #3B6FF0, #2554D4) !important;
            color: #fff !important;
            font-weight: 700 !important;
            border-radius: 50% !important;
            width: 26px !important;
            height: 26px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 0 !important;
            margin: .35rem .45rem !important;
        }

        .fc .fc-day-today.fc-day-selected-custom .fc-daygrid-day-number {
            background: linear-gradient(145deg, var(--gold), var(--gold-dark)) !important;
        }

        .fc .fc-event {
            background: var(--charcoal) !important;
            border: none !important;
            border-radius: 5px !important;
            font-size: .7rem !important;
            font-weight: 600 !important;
            font-family: var(--font-body) !important;
            padding: .16rem .42rem !important;
            cursor: pointer !important;
            transition: opacity .15s !important;
        }

        .fc .fc-event:hover {
            opacity: .82 !important;
        }

        .fc .fc-event-title {
            color: var(--white) !important;
        }

        .fc .fc-event.holiday-event {
            background: rgba(239, 68, 68, .1) !important;
            border: 1px solid rgba(239, 68, 68, .25) !important;
            border-radius: 4px !important;
        }

        .fc .fc-event.holiday-event .fc-event-title {
            color: #B91C1C !important;
            font-weight: 600 !important;
        }

        /* Cancelled events on calendar — red muted strikethrough */
        .fc .fc-event.cancelled-event {
            background: rgba(185, 28, 28, .12) !important;
            border: 1px solid rgba(185, 28, 28, .25) !important;
            border-radius: 4px !important;
            opacity: .65 !important;
        }

        .fc .fc-event.cancelled-event .fc-event-title {
            color: #991B1B !important;
            font-weight: 600 !important;
            text-decoration: line-through !important;
        }

        /* Completed events on calendar — teal muted strikethrough */
        .fc .fc-event.completed-event {
            background: rgba(14, 116, 144, .1) !important;
            border: 1px solid rgba(14, 116, 144, .3) !important;
            border-radius: 4px !important;
            opacity: .7 !important;
        }

        .fc .fc-event.completed-event .fc-event-title {
            color: #0E7490 !important;
            font-weight: 600 !important;
            text-decoration: line-through !important;
        }

        .fc .fc-daygrid-event-dot {
            border-color: var(--gold) !important;
        }

        .fc .fc-list-event:hover td {
            background: var(--gold-light) !important;
        }

        .fc-theme-standard td,
        .fc-theme-standard th,
        .fc-theme-standard .fc-scrollgrid {
            border-color: #F0EBE5 !important;
        }

        /* ══ DATE HERO CARD ══ */
        .date-hero {
            border-radius: var(--radius-card);
            background: linear-gradient(145deg, #3B6FF0 0%, #2554D4 55%, #1a3fa8 100%);
            padding: 1.4rem 1.3rem 1.2rem;
            position: relative;
            overflow: hidden;
        }

        .date-hero::before {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .07);
            pointer-events: none;
        }

        .date-hero::after {
            content: '';
            position: absolute;
            bottom: -40px;
            left: -20px;
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .05);
            pointer-events: none;
        }

        .date-hero-month {
            font-family: var(--font-body);
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .15em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .65);
            margin-bottom: .35rem;
        }

        .date-hero-day-num {
            font-family: var(--font-display);
            font-size: 3.2rem;
            font-weight: 700;
            color: var(--white);
            line-height: 1;
            margin-bottom: .1rem;
        }

        .date-hero-day-name {
            font-family: var(--font-body);
            font-size: 1.05rem;
            font-weight: 500;
            color: rgba(255, 255, 255, .85);
            margin-bottom: .9rem;
        }

        .date-hero-chips {
            display: flex;
            flex-wrap: wrap;
            gap: .4rem;
            min-height: .1rem;
        }

        .date-hero-chip {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .28rem .75rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .2);
            font-family: var(--font-body);
            font-size: .68rem;
            font-weight: 500;
            color: rgba(255, 255, 255, .9);
        }

        .date-hero-chip svg {
            width: 11px;
            height: 11px;
            opacity: .8;
        }

        .date-hero-chip.holiday-chip {
            background: rgba(239, 68, 68, .25);
            border-color: rgba(239, 68, 68, .35);
        }

        .date-hero-add {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            margin-top: 1rem;
            padding: .62rem 1rem;
            border-radius: 10px;
            border: 1.5px solid rgba(255, 255, 255, .25);
            background: rgba(255, 255, 255, .12);
            backdrop-filter: blur(4px);
            font-family: var(--font-body);
            font-size: .8rem;
            font-weight: 600;
            color: var(--white);
            cursor: pointer;
            transition: background .2s, border-color .2s, transform .15s;
        }

        .date-hero-add svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }

        .date-hero-add:hover {
            background: rgba(255, 255, 255, .22);
            border-color: rgba(255, 255, 255, .4);
            transform: translateY(-1px);
        }

        /* ── SIDEBAR ── */
        .cal-sidebar {
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
        }

        /* ══ MY EVENTS TABLE CARD ══ */
        .ev-table-card {
            background: var(--white);
            border-radius: var(--radius-card);
            border: 1.5px solid var(--border);
            box-shadow: var(--shadow-card);
            overflow: hidden;
        }

        .ev-table-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .85rem 1.1rem;
            border-bottom: 1px solid #F5EFE8;
            flex-wrap: wrap;
            gap: .5rem;
        }

        .ev-table-head-l {
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .ev-table-icon {
            width: 26px;
            height: 26px;
            border-radius: 6px;
            background: var(--gold-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-dark);
            flex-shrink: 0;
        }

        .ev-table-icon svg {
            width: 12px;
            height: 12px;
        }

        .ev-table-title {
            font-family: var(--font-display);
            font-size: .82rem;
            font-weight: 700;
            color: var(--charcoal);
        }

        .ev-table-count {
            padding: .12rem .5rem;
            border-radius: 999px;
            background: var(--gold-light);
            color: var(--gold-dark);
            font-family: var(--font-body);
            font-size: .6rem;
            font-weight: 700;
        }

        .ev-table-toolbar {
            display: flex;
            align-items: center;
            gap: .5rem;
            padding: .55rem .9rem;
            border-bottom: 1px solid #F5EFE8;
        }

        .ev-search-wrap {
            position: relative;
            flex: 1;
        }

        .ev-search-ico {
            position: absolute;
            left: .62rem;
            top: 50%;
            transform: translateY(-50%);
            width: 11px;
            height: 11px;
            color: #C0B8B0;
            pointer-events: none;
        }

        .ev-search-inp {
            width: 100%;
            padding: .4rem .7rem .4rem 1.85rem;
            background: var(--ivory);
            border: 1.5px solid var(--border);
            border-radius: 6px;
            font-family: var(--font-body);
            font-size: .73rem;
            color: var(--charcoal);
            outline: none;
            transition: border-color .18s;
        }

        .ev-search-inp:focus {
            border-color: var(--gold);
        }

        .ev-search-inp::placeholder {
            color: #C0B8B0;
        }

        .ev-table-wrap {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            max-height: 400px;
            overflow-y: auto;
        }

        .ev-table-wrap::-webkit-scrollbar {
            width: 3px;
            height: 3px;
        }

        .ev-table-wrap::-webkit-scrollbar-thumb {
            background: var(--border-md);
            border-radius: 99px;
        }

        .ev-tbl {
            width: 100%;
            border-collapse: collapse;
        }

        .ev-tbl thead {
            position: sticky;
            top: 0;
            z-index: 2;
        }

        .ev-tbl thead tr {
            background: var(--ivory);
            border-bottom: 1px solid var(--border);
        }

        .ev-tbl th {
            padding: .55rem .85rem;
            font-family: var(--font-body);
            font-size: .57rem;
            font-weight: 700;
            letter-spacing: .09em;
            text-transform: uppercase;
            color: #C0B8B0;
            text-align: left;
            white-space: nowrap;
        }

        .ev-tbl tbody tr {
            border-bottom: 1px solid #F7F3EF;
            transition: background .15s;
            cursor: pointer;
        }

        .ev-tbl tbody tr:last-child {
            border-bottom: none;
        }

        .ev-tbl tbody tr:hover {
            background: rgba(201, 168, 76, .04);
        }

        .ev-tbl tbody tr.row-active {
            background: rgba(59, 111, 240, .05) !important;
            border-left: 2px solid #3B6FF0;
        }

        /* Cancelled rows — red muted strikethrough */
        .ev-tbl tbody tr.row-cancelled {
            opacity: .6;
        }

        .ev-tbl tbody tr.row-cancelled .ev-name-cell {
            text-decoration: line-through;
            color: #991B1B;
        }

        /* Completed rows — teal muted strikethrough */
        .ev-tbl tbody tr.row-completed {
            opacity: .65;
        }

        .ev-tbl tbody tr.row-completed .ev-name-cell {
            text-decoration: line-through;
            color: #0E7490;
        }

        .ev-tbl td {
            padding: .62rem .85rem;
            font-family: var(--font-body);
            font-size: .74rem;
            color: var(--charcoal);
            vertical-align: middle;
        }

        .ev-name-cell {
            font-weight: 600;
            max-width: 130px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ev-date-cell {
            font-size: .68rem;
            color: var(--warm-grey);
            white-space: nowrap;
        }

        /* Status badges */
        .ev-sb {
            display: inline-flex;
            align-items: center;
            gap: .22rem;
            padding: .13rem .48rem;
            border-radius: 999px;
            font-family: var(--font-body);
            font-size: .58rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .ev-sb::before {
            content: '';
            width: 4px;
            height: 4px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .ev-sb.pending {
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            color: #92400E;
        }

        .ev-sb.pending::before {
            background: #F59E0B;
        }

        .ev-sb.upcoming {
            background: var(--gold-light);
            border: 1px solid rgba(201, 168, 76, .3);
            color: var(--gold-dark);
        }

        .ev-sb.upcoming::before {
            background: var(--gold);
        }

        .ev-sb.confirmed {
            background: #F0FDF4;
            border: 1px solid #A7F3D0;
            color: #065F46;
        }

        .ev-sb.confirmed::before {
            background: #10B981;
        }

        .ev-sb.cancelled {
            background: #FEF2F2;
            border: 1px solid #FCA5A5;
            color: #991B1B;
        }

        .ev-sb.cancelled::before {
            background: #EF4444;
        }

        .ev-sb.completed {
            background: #ECFEFF;
            border: 1px solid #A5F3FC;
            color: #0E7490;
        }

        .ev-sb.completed::before {
            background: #06B6D4;
        }

        .ev-sb.ongoing {
            background: #F3E8FF;
            border: 1px solid #D8B4FE;
            color: #6B21A8;
        }

        .ev-sb.ongoing::before {
            background: #A855F7;
        }

        .ev-empty {
            text-align: center;
            padding: 2.5rem 1rem;
        }

        .ev-empty-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--gold-light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto .6rem;
            color: var(--gold-dark);
        }

        .ev-empty-icon svg {
            width: 17px;
            height: 17px;
        }

        .ev-empty p {
            font-family: var(--font-body);
            font-size: .76rem;
            color: var(--warm-grey);
            line-height: 1.5;
        }

        /* ══ CANCELLED EVENT NOTICE BANNER ══ */
        .vm-cancelled-notice {
            display: flex;
            align-items: flex-start;
            gap: .75rem;
            padding: .85rem 1rem;
            margin-bottom: 1rem;
            background: #FEF2F2;
            border-radius: 10px;
            border: 1px solid #FECACA;
        }

        .vm-cancelled-notice-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #FEE2E2;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #C0392B;
            flex-shrink: 0;
        }

        .vm-cancelled-notice-icon svg {
            width: 16px;
            height: 16px;
        }

        .vm-cancelled-notice-body h4 {
            font-family: var(--font-display);
            font-size: .84rem;
            font-weight: 700;
            color: var(--charcoal);
            margin-bottom: .2rem;
        }

        .vm-cancelled-notice-body p {
            font-size: .74rem;
            color: var(--warm-grey);
            line-height: 1.55;
        }

        /* ══ COMPLETED EVENT NOTICE BANNER ══ */
        .vm-completed-notice {
            display: flex;
            align-items: flex-start;
            gap: .75rem;
            padding: .85rem 1rem;
            margin-bottom: 1rem;
            background: #ECFEFF;
            border-radius: 10px;
            border: 1px solid #A5F3FC;
        }

        .vm-completed-notice-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #CFFAFE;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0E7490;
            flex-shrink: 0;
        }

        .vm-completed-notice-icon svg {
            width: 16px;
            height: 16px;
        }

        .vm-completed-notice-body h4 {
            font-family: var(--font-display);
            font-size: .84rem;
            font-weight: 700;
            color: var(--charcoal);
            margin-bottom: .2rem;
        }

        .vm-completed-notice-body p {
            font-size: .74rem;
            color: var(--warm-grey);
            line-height: 1.55;
        }

        /* ══ SHARED MODAL ══ */
        .mo-overlay {
            position: fixed;
            inset: 0;
            z-index: 8000;
            background: rgba(30, 27, 24, .55);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            backdrop-filter: blur(3px);
            overflow-y: auto;
        }

        .mo-overlay.open {
            display: flex;
        }

        .mo-box {
            background: var(--white);
            border-radius: var(--radius-card);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-modal);
            width: 100%;
            max-width: 520px;
            margin: auto;
            flex-shrink: 0;
            animation: moSlide .22s ease;
            display: flex;
            flex-direction: column;
            max-height: calc(100vh - 2rem);
            overflow: hidden;
        }

        @keyframes moSlide {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .mo-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.1rem 1.4rem;
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
        }

        .mo-head-l {
            display: flex;
            align-items: center;
            gap: .65rem;
        }

        .mo-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--gold-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-dark);
            flex-shrink: 0;
        }

        .mo-icon svg {
            width: 15px;
            height: 15px;
        }

        .mo-title {
            font-family: var(--font-display);
            font-size: .95rem;
            font-weight: 700;
            color: var(--charcoal);
        }

        .mo-close {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 1.5px solid var(--border);
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--warm-grey);
            transition: border-color .15s, color .15s;
        }

        .mo-close:hover {
            border-color: var(--gold);
            color: var(--gold-dark);
        }

        .mo-close svg {
            width: 12px;
            height: 12px;
        }

        .mo-body {
            padding: 1.35rem 1.4rem;
            overflow-y: auto;
            flex: 1;
            min-height: 0;
        }

        .mo-body::-webkit-scrollbar {
            width: 3px;
        }

        .mo-body::-webkit-scrollbar-thumb {
            background: var(--border-md);
            border-radius: 99px;
        }

        .mo-foot {
            padding: .85rem 1.4rem;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: .55rem;
            flex-shrink: 0;
            background: var(--white);
        }

        .mo-field {
            margin-bottom: .85rem;
        }

        .mo-field:last-child {
            margin-bottom: 0;
        }

        .mo-fg {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: .85rem;
        }

        @media(max-width:480px) {
            .mo-fg {
                grid-template-columns: 1fr;
            }
        }

        .mo-lbl {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: .68rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--warm-grey);
            margin-bottom: .35rem;
            font-family: var(--font-body);
        }

        .mo-req {
            font-size: .58rem;
            color: #C0392B;
            font-weight: 500;
            text-transform: none;
            letter-spacing: 0;
        }

        .mo-opt {
            font-size: .58rem;
            color: #C0B8B0;
            font-weight: 400;
            text-transform: none;
            letter-spacing: 0;
        }

        .mo-inp,
        .mo-sel,
        .mo-ta {
            width: 100%;
            padding: .65rem .9rem;
            background: var(--ivory);
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-family: var(--font-body);
            font-size: .84rem;
            color: var(--charcoal);
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
            appearance: none;
            display: block;
        }

        .mo-inp:focus,
        .mo-sel:focus,
        .mo-ta:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, .12);
            background: var(--white);
        }

        .mo-inp::placeholder,
        .mo-ta::placeholder {
            color: #C0B8B0;
        }

        .mo-ta {
            resize: vertical;
            min-height: 80px;
        }

        .mo-sw {
            position: relative;
        }

        .mo-sw::after {
            content: '';
            position: absolute;
            right: .85rem;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 5px solid #C0B8B0;
            pointer-events: none;
        }

        .mo-sw .mo-sel {
            padding-right: 2rem;
        }

        .mo-btn-save {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .62rem 1.5rem;
            border-radius: var(--radius-btn);
            border: none;
            background: var(--charcoal);
            font-family: var(--font-body);
            font-size: .82rem;
            font-weight: 600;
            color: var(--white);
            cursor: pointer;
            text-decoration: none;
            transition: background .2s, box-shadow .2s, transform .15s;
        }

        .mo-btn-save svg {
            width: 13px;
            height: 13px;
        }

        .mo-btn-save:hover {
            background: var(--gold-dark);
            box-shadow: 0 4px 12px rgba(201, 168, 76, .22);
            transform: translateY(-1px);
        }

        .mo-btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .62rem 1.1rem;
            border-radius: var(--radius-btn);
            border: 1.5px solid var(--border);
            background: var(--white);
            font-family: var(--font-body);
            font-size: .82rem;
            font-weight: 500;
            color: var(--warm-grey);
            cursor: pointer;
            transition: border-color .2s, color .2s;
        }

        .mo-btn-cancel:hover {
            border-color: var(--gold);
            color: var(--charcoal);
        }

        .mo-date-chip {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .32rem .85rem;
            border-radius: 999px;
            background: var(--gold-light);
            border: 1px solid rgba(201, 168, 76, .3);
            font-family: var(--font-body);
            font-size: .75rem;
            font-weight: 600;
            color: var(--gold-dark);
            margin-bottom: 1.1rem;
        }

        .mo-date-chip svg {
            width: 12px;
            height: 12px;
        }

        /* VIEW MODAL detail rows */
        .mv-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .65rem 1.25rem;
            margin-bottom: .5rem;
        }

        @media(max-width:480px) {
            .mv-grid {
                grid-template-columns: 1fr;
            }
        }

        .mv-full {
            grid-column: 1/-1;
        }

        .mv-field {
            padding: .7rem .85rem;
            background: var(--ivory);
            border-radius: 10px;
            border: 1px solid #F0EBE5;
        }

        .mv-key {
            font-family: var(--font-body);
            font-size: .58rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: #C0B8B0;
            margin-bottom: .25rem;
        }

        .mv-val {
            font-family: var(--font-body);
            font-size: .83rem;
            color: var(--charcoal);
            line-height: 1.5;
        }

        .mv-val.nil {
            color: #C0B8B0;
            font-style: italic;
        }

        /* Muted look for cancelled & completed detail fields */
        .view-modal-cancelled .mv-field,
        .view-modal-completed .mv-field {
            opacity: .7;
        }

        .view-modal-cancelled .mv-val,
        .view-modal-completed .mv-val {
            color: var(--warm-grey);
        }

        /* Status badges in view modal */
        .mv-badge {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            padding: .22rem .75rem;
            border-radius: 999px;
            font-family: var(--font-body);
            font-size: .7rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .mv-badge::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .mv-pending {
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            color: #92400E;
        }

        .mv-pending::before {
            background: #F59E0B;
        }

        .mv-upcoming {
            background: var(--gold-light);
            border: 1px solid rgba(201, 168, 76, .3);
            color: var(--gold-dark);
        }

        .mv-upcoming::before {
            background: var(--gold);
        }

        .mv-confirmed {
            background: #F0FDF4;
            border: 1px solid #A7F3D0;
            color: #065F46;
        }

        .mv-confirmed::before {
            background: #10B981;
        }

        .mv-cancelled {
            background: #FEF2F2;
            border: 1px solid #FCA5A5;
            color: #991B1B;
        }

        .mv-cancelled::before {
            background: #EF4444;
        }

        .mv-completed {
            background: #ECFEFF;
            border: 1px solid #A5F3FC;
            color: #0E7490;
        }

        .mv-completed::before {
            background: #06B6D4;
        }

        .mv-ongoing {
            background: #F3E8FF;
            border: 1px solid #D8B4FE;
            color: #6B21A8;
        }

        .mv-ongoing::before {
            background: #A855F7;
        }

        /* Action buttons in view modal */
        .mv-action-danger {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .55rem 1.1rem;
            border-radius: var(--radius-btn);
            border: 1.5px solid #FCA5A5;
            background: #FEF2F2;
            font-family: var(--font-body);
            font-size: .78rem;
            font-weight: 600;
            color: #991B1B;
            cursor: pointer;
            transition: background .18s, border-color .18s;
        }

        .mv-action-danger:hover {
            background: #FEE2E2;
            border-color: #EF4444;
        }

        .mv-action-danger svg {
            width: 12px;
            height: 12px;
        }

        .mv-action-success {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .55rem 1.1rem;
            border-radius: var(--radius-btn);
            border: 1.5px solid #A7F3D0;
            background: #F0FDF4;
            font-family: var(--font-body);
            font-size: .78rem;
            font-weight: 600;
            color: #065F46;
            cursor: pointer;
            transition: background .18s, border-color .18s;
        }

        .mv-action-success:hover {
            background: #DCFCE7;
            border-color: #10B981;
        }

        .mv-action-success svg {
            width: 12px;
            height: 12px;
        }

        /* Confirm mini-modal */
        .mo-confirm-box {
            display: flex;
            gap: .85rem;
            align-items: flex-start;
            padding: .85rem 1rem;
            background: #FEF2F2;
            border-radius: 10px;
            border: 1px solid #FECACA;
            margin-bottom: 1rem;
        }

        .mo-confirm-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #FEE2E2;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #C0392B;
            flex-shrink: 0;
        }

        .mo-confirm-icon svg {
            width: 18px;
            height: 18px;
        }

        .mo-confirm-text h4 {
            font-family: var(--font-display);
            font-size: .88rem;
            font-weight: 700;
            color: var(--charcoal);
            margin-bottom: .25rem;
        }

        .mo-confirm-text p {
            font-size: .78rem;
            color: var(--warm-grey);
            line-height: 1.55;
        }

        .mo-btn-danger {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .62rem 1.4rem;
            border-radius: var(--radius-btn);
            border: none;
            background: #C0392B;
            font-family: var(--font-body);
            font-size: .82rem;
            font-weight: 600;
            color: var(--white);
            cursor: pointer;
            transition: background .2s, box-shadow .2s;
        }

        .mo-btn-danger:hover {
            background: #9B2335;
            box-shadow: 0 4px 12px rgba(192, 57, 43, .25);
        }

        .mo-btn-complete {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .62rem 1.4rem;
            border-radius: var(--radius-btn);
            border: none;
            background: #10B981;
            font-family: var(--font-body);
            font-size: .82rem;
            font-weight: 600;
            color: var(--white);
            cursor: pointer;
            transition: background .2s, box-shadow .2s;
        }

        .mo-btn-complete:hover {
            background: #059669;
            box-shadow: 0 4px 12px rgba(16, 185, 129, .25);
        }

        /* ALERTS */
        .bv-alert {
            display: flex; align-items: center; gap: .65rem;
            padding: .9rem 1.15rem; border-radius: 10px;
            font-size: .8rem; font-weight: 500;
            margin-bottom: 1.5rem; border: 1.5px solid;
            animation: bvFade .3s ease;
        }
        @keyframes bvFade { from{opacity:0;transform:translateY(-6px);}to{opacity:1;transform:translateY(0);} }
        .bv-alert svg { width: 15px; height: 15px; flex-shrink: 0; }
        .bv-alert.success { background:#F0FBF4; border-color:#A8D5B5; color:#1E6B3C; }
        .bv-alert.error   { background:#FFF5F5; border-color:#FADBD8; color:var(--danger); }
    </style>

    {{-- ALERTS --}}
    @if(session('success'))
    <div class="bv-alert success">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="2 8 6 12 14 4"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bv-alert error">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="8" cy="8" r="6"/>
            <line x1="8" y1="5" x2="8" y2="8"/>
            <circle cx="8" cy="11" r=".6" fill="currentColor" stroke="none"/>
        </svg>
        {{ session('error') }}
    </div>
    @endif
    <div class="cal-page">

        <div class="cal-page-header">
            <div>
                <h1 class="cal-page-title">Event <em>Calendar</em></h1>
                <p class="cal-page-sub">Plan, track, and manage your upcoming events</p>
            </div>
        </div>

        <div class="cal-outer">

            {{-- ── MAIN CALENDAR ── --}}
            <div class="cal-card">
                <div class="cal-card-head">
                    <div class="cal-card-head-l">
                        <div class="cal-card-icon">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <rect x="2" y="4" width="16" height="13" rx="2" />
                                <path d="M2 8h16M6 2v3M14 2v3" />
                            </svg>
                        </div>
                        <div>
                            <div class="cal-card-title">Monthly View</div>
                            <div class="cal-card-desc">Click a date to select · Click an event to view details</div>
                        </div>
                    </div>
                    <button type="button" class="cal-btn-add" style="padding:.45rem 1rem;font-size:.76rem;"
                        onclick="openCreate(null)">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M7 2v10M2 7h10" />
                        </svg>
                        New Event
                    </button>
                </div>
                <div class="cal-card-body">
                    <div id="mainCalendar"></div>
                </div>
            </div>

            {{-- ── SIDEBAR ── --}}
            <div class="cal-sidebar">

                {{-- DATE HERO --}}
                <div class="date-hero">
                    <div class="date-hero-month" id="heroMonth"></div>
                    <div class="date-hero-day-num" id="heroDayNum"></div>
                    <div class="date-hero-day-name" id="heroDayName"></div>
                    <div class="date-hero-chips" id="heroChips"></div>
                    <button type="button" class="date-hero-add" id="heroAddBtn" onclick="openCreate(null)">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="7" cy="7" r="6" stroke-width="1.5" />
                            <path d="M7 4v6M4 7h6" />
                        </svg>
                        Add New Event
                    </button>
                </div>

                {{-- MY EVENTS TABLE --}}
                <div class="ev-table-card">
                    <div class="ev-table-head">
                        <div class="ev-table-head-l">
                            <div class="ev-table-icon">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <rect x="2" y="4" width="16" height="13" rx="2" />
                                    <path d="M2 8h16M6 2v3M14 2v3" />
                                </svg>
                            </div>
                            <div class="ev-table-title">My Events</div>
                        </div>
                        <span class="ev-table-count">{{ count($events) }}</span>
                    </div>

                    <div class="ev-table-toolbar">
                        <div class="ev-search-wrap">
                            <svg class="ev-search-ico" viewBox="0 0 14 14" fill="none" stroke="currentColor"
                                stroke-width="1.8">
                                <circle cx="6" cy="6" r="4" />
                                <path d="M10 10l2.5 2.5" />
                            </svg>
                            <input type="text" class="ev-search-inp" id="evSearch" placeholder="Search events…"
                                oninput="filterTable()">
                        </div>
                    </div>

                    @if (count($events))
                        <div class="ev-table-wrap">
                            <table class="ev-tbl" id="evTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Event</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $i => $ev)
                                        @php
                                            $status = $ev->status ?? 'pending';
                                            $isCancelled = $status === 'cancelled';
                                            $isCompleted = $status === 'completed';
                                            $evtDate = \Carbon\Carbon::parse($ev->event_date)->format('M d, Y');
                                            $isPast = \Carbon\Carbon::parse($ev->event_date)->isPast();
                                            $canComplete =
                                                !$isCancelled &&
                                                !$isCompleted &&
                                                ($isPast || in_array($status, ['confirmed', 'ongoing']));
                                            $canCancel = !$isCancelled && !$isCompleted;
                                            $payload = json_encode([
                                                'id' => $ev->id,
                                                'title' => $ev->event_name,
                                                'type' => $ev->event_type,
                                                'date' => $ev->event_date,
                                                'time' => $ev->event_time,
                                                'budget' => $ev->budget,
                                                'guests' => $ev->guest_count,
                                                'venue' => $ev->venue,
                                                'description' => $ev->description,
                                                'status' => $status,
                                                'canComplete' => $canComplete,
                                                'canCancel' => $canCancel,
                                                'cancelUrl' => route('client.events.cancel', $ev->id),
                                                'completeUrl' => route('client.events.complete', $ev->id),
                                                /*
                                                 * showUrl is hidden for both cancelled AND completed events.
                                                 * Cancelled → page is gone / bookings cancelled.
                                                 * Completed → event is finished, full page no longer relevant.
                                                 */
                                                'showUrl' => ($isCancelled || $isCompleted) ? null : route('client.show', $ev->id),
                                            ]);
                                        @endphp
                                        <tr class="ev-tbl-row
                                                {{ $isCancelled ? 'row-cancelled' : '' }}
                                                {{ $isCompleted ? 'row-completed' : '' }}"
                                            data-name="{{ strtolower($ev->event_name) }}"
                                            data-type="{{ strtolower($ev->event_type) }}"
                                            data-date="{{ $ev->event_date }}"
                                            onclick="openViewModal({{ $payload }})">
                                            <td style="color:var(--warm-grey);font-size:.68rem;">{{ $i + 1 }}</td>
                                            <td class="ev-name-cell" title="{{ $ev->event_name }}">{{ $ev->event_name }}</td>
                                            <td class="ev-date-cell">{{ $evtDate }}</td>
                                            <td><span class="ev-sb {{ $status }}">{{ ucfirst($status) }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="ev-empty">
                            <div class="ev-empty-icon">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <rect x="2" y="4" width="16" height="13" rx="2" />
                                    <path d="M2 8h16M6 2v3M14 2v3" />
                                </svg>
                            </div>
                            <p>No events yet.<br>Click <strong>Add Event</strong> to start planning!</p>
                        </div>
                    @endif
                </div>

            </div>{{-- /sidebar --}}
        </div>
    </div>

    {{-- ══ CREATE MODAL ══ --}}
    <div class="mo-overlay" id="createOverlay" onclick="if(event.target===this)closeCreate()">
        <div class="mo-box">
            <div class="mo-head">
                <div class="mo-head-l">
                    <div class="mo-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="2" y="4" width="16" height="13" rx="2" />
                            <path d="M2 8h16M6 2v3M14 2v3M10 11v4M8 13h4" />
                        </svg>
                    </div>
                    <div class="mo-title">Create New Event</div>
                </div>
                <button type="button" class="mo-close" onclick="closeCreate()">
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M1 1l10 10M11 1L1 11" />
                    </svg>
                </button>
            </div>
            <form method="POST" action="{{ route('client.events.store') }}" style="display:contents;">
                @csrf
                <div class="mo-body">
                    <div class="mo-date-chip" id="createDateChip" style="display:none;">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="1" y="2.5" width="12" height="10" rx="1.5" />
                            <path d="M1 6h12M4.5 1v2.5M9.5 1v2.5" />
                        </svg>
                        <span id="createDateChipText"></span>
                    </div>
                    <div class="mo-field">
                        <label class="mo-lbl">Event Name <span class="mo-req">Required</span></label>
                        <input type="text" name="event_name" id="cr_name" class="mo-inp"
                            placeholder="e.g. Grand Wedding Reception" required>
                    </div>
                    <div class="mo-fg" style="margin-bottom:.85rem;">
                        <div>
                            @php
                                $eventcategories = App\Models\Eventcategory::all()
                            @endphp
                            <label class="mo-lbl">Event Type <span class="mo-req">Required</span></label>
                            <div class="mo-sw">
                                <select name="event_type" class="mo-sel" required>
                                    <option value="" disabled selected>Select type…</option>
                                    @foreach ($eventcategories as $ec)
                                        <option value="{{ $ec->name }}"
                                            {{ old('event_type') == $ec->name ? 'selected' : '' }}>{{ $ec->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="mo-lbl">Date <span class="mo-req">Required</span></label>
                            <input type="date" name="event_date" id="cr_date" class="mo-inp" required>
                        </div>
                    </div>
                    <div class="mo-fg" style="margin-bottom:.85rem;">
                        <div>
                            <label class="mo-lbl">Event Time <span class="mo-opt">Optional</span></label>
                            <input type="time" name="event_time" class="mo-inp">
                        </div>
                        <div>
                            <label class="mo-lbl">Venue <span class="mo-opt">Optional</span></label>
                            <input type="text" name="venue" class="mo-inp" placeholder="e.g. Cebu City">
                        </div>
                    </div>
                    <div class="mo-fg" style="margin-bottom:.85rem;">
                        <div>
                            <label class="mo-lbl">Budget <span class="mo-req">Required</span></label>
                            <input type="number" name="budget" class="mo-inp" placeholder="e.g. 150000"
                                min="0" step="0.01" required>
                        </div>
                        <div>
                            <label class="mo-lbl">Guests <span class="mo-opt">Optional</span></label>
                            <input type="number" name="guest_count" class="mo-inp" placeholder="e.g. 200"
                                min="1">
                        </div>
                    </div>
                    <div class="mo-field">
                        <label class="mo-lbl">Description <span class="mo-opt">Optional</span></label>
                        <textarea name="description" class="mo-ta" placeholder="Any extra details about your event…"></textarea>
                    </div>
                </div>
                <div class="mo-foot">
                    <button type="button" class="mo-btn-cancel" onclick="closeCreate()">Cancel</button>
                    <button type="submit" class="mo-btn-save">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 7l4 4 6-6" />
                        </svg>
                        Save Event
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ══ VIEW EVENT MODAL ══ --}}
    <div class="mo-overlay" id="viewOverlay" onclick="if(event.target===this)closeView()">
        <div class="mo-box" style="max-width:500px;" id="viewModalBox">
            <div class="mo-head">
                <div class="mo-head-l">
                    <div class="mo-icon" id="vm_icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="2" y="4" width="16" height="13" rx="2" />
                            <path d="M2 8h16M6 2v3M14 2v3" />
                        </svg>
                    </div>
                    <div class="mo-title" id="vm_title">Event Details</div>
                </div>
                <button type="button" class="mo-close" onclick="closeView()">
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M1 1l10 10M11 1L1 11" />
                    </svg>
                </button>
            </div>

            <div class="mo-body" id="vm_body">

                {{-- Cancelled notice banner (hidden by default) --}}
                <div class="vm-cancelled-notice" id="vm_cancelled_notice" style="display:none;">
                    <div class="vm-cancelled-notice-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="10" cy="10" r="7" />
                            <path d="M7 7l6 6M13 7l-6 6" />
                        </svg>
                    </div>
                    <div class="vm-cancelled-notice-body">
                        <h4>This event has been cancelled</h4>
                        <p>The full event page is no longer accessible. All associated bookings have been cancelled.</p>
                    </div>
                </div>

                {{-- Completed notice banner (hidden by default) --}}
                <div class="vm-completed-notice" id="vm_completed_notice" style="display:none;">
                    <div class="vm-completed-notice-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="10" cy="10" r="7" />
                            <path d="M6 10l3 3 5-5" />
                        </svg>
                    </div>
                    <div class="vm-completed-notice-body">
                        <h4>This event has been completed</h4>
                        <p>This event is finished. The full event page is no longer available to view.</p>
                    </div>
                </div>

                {{-- Status badge --}}
                <span class="mv-badge" id="vm_badge">Pending</span>

                {{-- Detail grid --}}
                <div class="mv-grid" id="vm_detail_grid">
                    <div class="mv-field">
                        <div class="mv-key">Event Name</div>
                        <div class="mv-val" id="vm_name">—</div>
                    </div>
                    <div class="mv-field">
                        <div class="mv-key">Event Type</div>
                        <div class="mv-val" id="vm_type">—</div>
                    </div>
                    <div class="mv-field">
                        <div class="mv-key">Date</div>
                        <div class="mv-val" id="vm_date">—</div>
                    </div>
                    <div class="mv-field">
                        <div class="mv-key">Event Time</div>
                        <div class="mv-val" id="vm_time">—</div>
                    </div>
                    <div class="mv-field">
                        <div class="mv-key">Budget</div>
                        <div class="mv-val" id="vm_budget">—</div>
                    </div>
                    <div class="mv-field">
                        <div class="mv-key">Guest Count</div>
                        <div class="mv-val" id="vm_guests">—</div>
                    </div>
                    <div class="mv-field mv-full">
                        <div class="mv-key">Venue</div>
                        <div class="mv-val" id="vm_venue">—</div>
                    </div>
                    <div class="mv-field mv-full" id="vm_desc_wrap" style="display:none;">
                        <div class="mv-key">Description</div>
                        <div class="mv-val" id="vm_desc"
                            style="font-size:.8rem;color:var(--warm-grey);line-height:1.6;white-space:pre-wrap;"></div>
                    </div>
                </div>

                {{-- Action buttons (cancel / complete) --}}
                <div id="vm_actions"
                    style="display:none;gap:.55rem;flex-wrap:wrap;margin-top:.85rem;padding-top:.85rem;border-top:1px dashed var(--border);">
                </div>
            </div>

            {{-- Footer: "View Full Page" hidden for cancelled AND completed events --}}
            <div class="mo-foot">
                <button type="button" class="mo-btn-cancel" onclick="closeView()">Close</button>
                <a id="vm_show_link" href="#" class="mo-btn-save" style="text-decoration:none;display:none;">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 7h10M7 2l5 5-5 5" />
                    </svg>
                    View Suggest Packages
                </a>
            </div>
        </div>
    </div>

    {{-- ══ CANCEL CONFIRM MODAL ══ --}}
    <div class="mo-overlay" id="cancelOverlay" onclick="if(event.target===this)closeCancelModal()">
        <div class="mo-box" style="max-width:420px;">
            <div class="mo-head">
                <div class="mo-head-l">
                    <div class="mo-icon" style="background:#FEF2F2;color:#C0392B;">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="10" cy="10" r="7" />
                            <path d="M7 7l6 6M13 7l-6 6" />
                        </svg>
                    </div>
                    <div class="mo-title">Cancel Event</div>
                </div>
                <button type="button" class="mo-close" onclick="closeCancelModal()">
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M1 1l10 10M11 1L1 11" />
                    </svg>
                </button>
            </div>
            <div class="mo-body">
                <div class="mo-confirm-box">
                    <div class="mo-confirm-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path
                                d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                            <line x1="12" y1="9" x2="12" y2="13" />
                            <line x1="12" y1="17" x2="12.01" y2="17" />
                        </svg>
                    </div>
                    <div class="mo-confirm-text">
                        <h4>Are you sure?</h4>
                        <p>You're about to cancel <strong id="cancel_name"></strong>. This will also cancel all active
                            bookings and cannot be undone.</p>
                    </div>
                </div>
            </div>
            <div class="mo-foot">
                <button type="button" class="mo-btn-cancel" onclick="closeCancelModal()">Keep Event</button>
                <form id="cancelForm" method="POST" style="display:contents;">
                    @csrf @method('PATCH')
                    <button type="submit" class="mo-btn-danger">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="7" cy="7" r="5.5" />
                            <path d="M4.5 4.5l5 5M9.5 4.5l-5 5" />
                        </svg>
                        Yes, Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ══ COMPLETE CONFIRM MODAL ══ --}}
    <div class="mo-overlay" id="completeOverlay" onclick="if(event.target===this)closeCompleteModal()">
        <div class="mo-box" style="max-width:420px;">
            <div class="mo-head">
                <div class="mo-head-l">
                    <div class="mo-icon" style="background:#F0FDF4;color:#065F46;">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M5 10l4 4 6-6" />
                            <circle cx="10" cy="10" r="7" />
                        </svg>
                    </div>
                    <div class="mo-title">Mark as Completed</div>
                </div>
                <button type="button" class="mo-close" onclick="closeCompleteModal()">
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M1 1l10 10M11 1L1 11" />
                    </svg>
                </button>
            </div>
            <div class="mo-body">
                <div class="mo-confirm-box" style="background:#F0FDF4;border-color:#A7F3D0;">
                    <div class="mo-confirm-icon" style="background:#DCFCE7;color:#065F46;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="mo-confirm-text">
                        <h4>Mark as Completed?</h4>
                        <p>You're marking <strong id="complete_name"></strong> as completed. Pending bookings will be
                            cancelled. This action cannot be undone.</p>
                    </div>
                </div>
            </div>
            <div class="mo-foot">
                <button type="button" class="mo-btn-cancel" onclick="closeCompleteModal()">Not Yet</button>
                <form id="completeForm" method="POST" style="display:contents;">
                    @csrf @method('PATCH')
                    <button type="submit" class="mo-btn-complete">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 7l4 4 6-6" />
                        </svg>
                        Yes, Complete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

    <script>
        /* ═══ PH HOLIDAYS ═══ */
        var PH_FIXED = {
            '01-01': "New Year's Day",
            '02-25': 'EDSA Revolution',
            '04-09': 'Araw ng Kagitingan',
            '05-01': 'Labor Day',
            '06-12': 'Independence Day',
            '08-21': 'Ninoy Aquino Day',
            '11-01': "All Saints' Day",
            '11-02': "All Souls' Day",
            '11-30': 'Bonifacio Day',
            '12-08': 'Immaculate Conception',
            '12-24': 'Christmas Eve',
            '12-25': 'Christmas Day',
            '12-30': 'Rizal Day',
            '12-31': "New Year's Eve"
        };
        var PH_MOVABLE = {
            '2025-01-29': 'Chinese New Year',
            '2025-04-17': 'Maundy Thursday',
            '2025-04-18': 'Good Friday',
            '2025-04-19': 'Black Saturday',
            '2025-08-25': 'National Heroes Day',
            '2026-01-29': 'Chinese New Year',
            '2026-04-02': 'Maundy Thursday',
            '2026-04-03': 'Good Friday',
            '2026-04-04': 'Black Saturday',
            '2026-08-31': 'National Heroes Day'
        };
        var holidaySet = {};
        (function () {
            var yr = new Date().getFullYear();
            for (var y = yr - 1; y <= yr + 3; y++) {
                Object.keys(PH_FIXED).forEach(function (md) {
                    holidaySet[y + '-' + md] = PH_FIXED[md];
                });
            }
            Object.keys(PH_MOVABLE).forEach(function (ds) {
                holidaySet[ds] = PH_MOVABLE[ds];
            });
        })();

        function getHoliday(ds) { return holidaySet[ds] || null; }

        function buildHolidayFCEvents(yr) {
            var evs = [];
            for (var y = yr - 1; y <= yr + 3; y++) {
                Object.keys(PH_FIXED).forEach(function (md) {
                    evs.push({
                        id: 'h-' + y + md,
                        title: PH_FIXED[md],
                        start: y + '-' + md,
                        allDay: true,
                        display: 'block',
                        classNames: ['holiday-event'],
                        extendedProps: { isHoliday: true }
                    });
                });
            }
            Object.keys(PH_MOVABLE).forEach(function (ds) {
                if (!evs.find(function (e) { return e.start === ds && e.extendedProps.isHoliday; }))
                    evs.push({
                        id: 'h-' + ds,
                        title: PH_MOVABLE[ds],
                        start: ds,
                        allDay: true,
                        display: 'block',
                        classNames: ['holiday-event'],
                        extendedProps: { isHoliday: true }
                    });
            });
            return evs;
        }

        /* ═══ STATE ═══ */
        var allUserEvents = [], mainCal = null, selectedDate = null;
        var now = new Date();
        var MONTHS = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        var DAYS_FULL = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

        /* ═══ DATE HERO ═══ */
        function updateHero(dateStr) {
            var d = dateStr ? new Date(dateStr + 'T00:00:00') : new Date();
            var ds = pad4(d.getFullYear()) + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate());
            selectedDate = ds;
            document.getElementById('heroMonth').textContent = MONTHS[d.getMonth()].substring(0, 3).toUpperCase() + ' ' + d.getFullYear();
            document.getElementById('heroDayNum').textContent = d.getDate();
            document.getElementById('heroDayName').textContent = DAYS_FULL[d.getDay()];
            var chips = document.getElementById('heroChips');
            chips.innerHTML = '';
            var hol = getHoliday(ds);
            if (hol) {
                var c = document.createElement('div');
                c.className = 'date-hero-chip holiday-chip';
                c.innerHTML = '<svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 1l1.5 3.5L12 5l-2.5 2.5.6 3.5L7 9.5l-3.1 1.5.6-3.5L2 5l3.5-.5z"/></svg>' + escHtml(hol);
                chips.appendChild(c);
            }
            allUserEvents.filter(function (e) { return e.start && e.start.substring(0, 10) === ds; }).slice(0, 2).forEach(function (e) {
                var c = document.createElement('div');
                c.className = 'date-hero-chip';
                c.innerHTML = '<svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="2.5" width="12" height="10" rx="1.5"/><path d="M1 6h12"/></svg>' + escHtml(e.title);
                chips.appendChild(c);
            });
            document.getElementById('heroAddBtn').onclick = function () { openCreate(ds); };
        }

        /* ═══ DAY HIGHLIGHT ═══ */
        function applyDayHighlight(dateStr) {
            document.querySelectorAll('.fc-day-selected-custom').forEach(function (el) { el.classList.remove('fc-day-selected-custom'); });
            if (!dateStr) return;
            var cell = document.querySelector('.fc-daygrid-day[data-date="' + dateStr + '"]');
            if (cell) cell.classList.add('fc-day-selected-custom');
        }

        /* ═══ MAIN CALENDAR ═══ */
        document.addEventListener('DOMContentLoaded', function () {
            var holidays = buildHolidayFCEvents(now.getFullYear());
            mainCal = new FullCalendar.Calendar(document.getElementById('mainCalendar'), {
                initialView: 'dayGridMonth',
                height: 640,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listMonth'
                },
                buttonText: { today: 'Today', month: 'Month', week: 'Week', list: 'List' },
                events: function (fetchInfo, successCb, failureCb) {
                    fetch("{{ route('client.calendar.data') }}")
                        .then(function (r) { return r.json(); })
                        .then(function (raw) {
                            var userEvs = raw.map(function (e) {
                                var ep = e.extendedProps || {};
                                var status = (ep.status || e.status || 'pending').toLowerCase();
                                var isCancelled = status === 'cancelled';
                                var isCompleted = status === 'completed';
                                var classes = [];
                                if (isCancelled) classes.push('cancelled-event');
                                if (isCompleted) classes.push('completed-event');
                                return {
                                    id: e.id,
                                    title: e.title,
                                    start: e.start,
                                    classNames: classes,
                                    extendedProps: {
                                        type: ep.type || e.type || '',
                                        time: ep.time || e.time || '',
                                        budget: ep.budget || e.budget || '',
                                        guests: ep.guests || e.guests || '',
                                        venue: ep.venue || e.venue || '',
                                        description: ep.description || e.description || '',
                                        status: status,
                                        isHoliday: false
                                    }
                                };
                            });
                            allUserEvents = userEvs.map(function (e) {
                                return {
                                    id: e.id,
                                    title: e.title,
                                    start: typeof e.start === 'string' ? e.start : '',
                                    type: e.extendedProps.type,
                                    time: e.extendedProps.time,
                                    budget: e.extendedProps.budget,
                                    guests: e.extendedProps.guests,
                                    venue: e.extendedProps.venue,
                                    description: e.extendedProps.description,
                                    status: e.extendedProps.status
                                };
                            });
                            updateHero(null);
                            setTimeout(function () { applyDayHighlight(selectedDate); }, 100);
                            successCb(userEvs.concat(holidays));
                        })
                        .catch(function () {
                            updateHero(null);
                            successCb(holidays);
                        });
                },
                dateClick: function (info) {
                    selectedDate = info.dateStr;
                    updateHero(info.dateStr);
                    applyDayHighlight(info.dateStr);
                },
                datesSet: function () {
                    setTimeout(function () { applyDayHighlight(selectedDate); }, 50);
                },
                eventClick: function (info) {
                    var e = info.event, ep = e.extendedProps;
                    if (ep.isHoliday) {
                        updateHero(e.startStr);
                        applyDayHighlight(e.startStr);
                        return;
                    }
                    selectedDate = e.startStr ? e.startStr.substring(0, 10) : selectedDate;
                    updateHero(selectedDate);
                    applyDayHighlight(selectedDate);
                },
            });
            mainCal.render();
            updateHero(null);
            setTimeout(function () {
                var ts = toDateStr(new Date());
                applyDayHighlight(ts);
                selectedDate = ts;
            }, 200);
        });

        /* ═══ TABLE SEARCH ═══ */
        function filterTable() {
            var q = document.getElementById('evSearch').value.toLowerCase().trim();
            document.querySelectorAll('.ev-tbl-row').forEach(function (row) {
                var name = row.dataset.name || '';
                var type = row.dataset.type || '';
                row.style.display = (!q || name.includes(q) || type.includes(q)) ? '' : 'none';
            });
        }

        /* ═══════════════════════════════════════════════
           VIEW MODAL
           STATUS   | Banner          | View Full Page | Actions
           ─────────┼─────────────────┼────────────────┼────────
           cancelled | red cancelled  | HIDDEN         | NONE
           completed | teal completed | HIDDEN         | NONE
           others    | —              | SHOWN          | if applicable
        ════════════════════════════════════════════════ */
        function openViewModal(ev) {
            var s = (ev.status || 'pending').toLowerCase();
            var isCancelled = s === 'cancelled';
            var isCompleted = s === 'completed';
            var isFinished  = isCancelled || isCompleted;

            /* Modal box class for muted styling */
            var box = document.getElementById('viewModalBox');
            box.classList.remove('view-modal-cancelled', 'view-modal-completed');
            if (isCancelled) box.classList.add('view-modal-cancelled');
            if (isCompleted) box.classList.add('view-modal-completed');

            /* Header icon tint */
            var icon = document.getElementById('vm_icon');
            if (isCancelled) {
                icon.style.background = '#FEF2F2';
                icon.style.color = '#C0392B';
            } else if (isCompleted) {
                icon.style.background = '#ECFEFF';
                icon.style.color = '#0E7490';
            } else {
                icon.style.background = '';
                icon.style.color = '';
            }

            /* Banners */
            document.getElementById('vm_cancelled_notice').style.display = isCancelled ? 'flex' : 'none';
            document.getElementById('vm_completed_notice').style.display = isCompleted ? 'flex' : 'none';

            /* Title */
            document.getElementById('vm_title').innerText = ev.title || 'Event Details';

            /* Detail fields */
            document.getElementById('vm_name').innerText = ev.title || '—';
            document.getElementById('vm_type').innerText = ev.type || '—';
            document.getElementById('vm_date').innerText = ev.date ? fmtDate(ev.date) : '—';
            document.getElementById('vm_time').innerText = ev.time ? fmtTime(ev.time) : '—';
            document.getElementById('vm_budget').innerText = ev.budget ? '₱' + Number(ev.budget).toLocaleString('en-PH', { minimumFractionDigits: 2 }) : '—';
            document.getElementById('vm_guests').innerText = ev.guests ? Number(ev.guests).toLocaleString('en-PH') + ' guests' : '—';
            document.getElementById('vm_venue').innerText = ev.venue || '—';

            var dw = document.getElementById('vm_desc_wrap');
            if (ev.description) {
                document.getElementById('vm_desc').innerText = ev.description;
                dw.style.display = '';
            } else {
                dw.style.display = 'none';
            }

            /* Status badge */
            var badgeMap = {
                pending: 'mv-pending', upcoming: 'mv-upcoming', confirmed: 'mv-confirmed',
                cancelled: 'mv-cancelled', completed: 'mv-completed', ongoing: 'mv-ongoing'
            };
            var badge = document.getElementById('vm_badge');
            badge.className = 'mv-badge ' + (badgeMap[s] || 'mv-upcoming');
            badge.textContent = ucFirst(s);

            /* "View Full Page" button — hidden for cancelled AND completed */
            var lnk = document.getElementById('vm_show_link');
            if (isFinished || !ev.showUrl) {
                lnk.style.display = 'none';
                lnk.removeAttribute('href');
            } else {
                lnk.style.display = '';
                lnk.href = ev.showUrl;
            }

            /* Action buttons — only for active (non-finished) events */
            var actions = document.getElementById('vm_actions');
            actions.innerHTML = '';

            if (!isFinished) {
                if (ev.canComplete) {
                    var btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'mv-action-success';
                    btn.innerHTML = '<svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 7l4 4 6-6"/></svg> Mark Complete';
                    btn.onclick = function () { closeView(); openCompleteModal(ev.id, ev.title, ev.completeUrl); };
                    actions.appendChild(btn);
                }
                if (ev.canCancel) {
                    var btn2 = document.createElement('button');
                    btn2.type = 'button';
                    btn2.className = 'mv-action-danger';
                    btn2.innerHTML = '<svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="7" cy="7" r="5.5"/><path d="M4.5 4.5l5 5M9.5 4.5l-5 5"/></svg> Cancel Event';
                    btn2.onclick = function () { closeView(); openCancelModal(ev.id, ev.title, ev.cancelUrl); };
                    actions.appendChild(btn2);
                }
            }

            actions.style.display = (actions.children.length > 0) ? 'flex' : 'none';

            /* Navigate calendar & highlight table row */
            if (mainCal && ev.date) mainCal.gotoDate(ev.date.substring(0, 10));
            selectedDate = ev.date ? ev.date.substring(0, 10) : selectedDate;
            updateHero(selectedDate);
            setTimeout(function () { applyDayHighlight(selectedDate); }, 80);

            document.querySelectorAll('.ev-tbl-row').forEach(function (r) { r.classList.remove('row-active'); });
            var activeRow = document.querySelector('.ev-tbl-row[data-date="' + ev.date + '"]');
            if (activeRow) activeRow.classList.add('row-active');

            openView();
        }

        /* ═══ CANCEL CONFIRM MODAL ═══ */
        function openCancelModal(id, name, url) {
            document.getElementById('cancel_name').innerText = '"' + name + '"';
            document.getElementById('cancelForm').action = url;
            document.getElementById('cancelOverlay').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeCancelModal() {
            document.getElementById('cancelOverlay').classList.remove('open');
            document.body.style.overflow = '';
        }

        /* ═══ COMPLETE CONFIRM MODAL ═══ */
        function openCompleteModal(id, name, url) {
            document.getElementById('complete_name').innerText = '"' + name + '"';
            document.getElementById('completeForm').action = url;
            document.getElementById('completeOverlay').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeCompleteModal() {
            document.getElementById('completeOverlay').classList.remove('open');
            document.body.style.overflow = '';
        }

        /* ═══ CREATE MODAL ═══ */
        function openCreate(dateStr) {
            var chip = document.getElementById('createDateChip');
            var chipTxt = document.getElementById('createDateChipText');
            var inp = document.getElementById('cr_date');
            if (dateStr) {
                inp.value = dateStr;
                chipTxt.textContent = fmtDate(dateStr);
                chip.style.display = 'inline-flex';
            } else {
                chip.style.display = 'none';
            }
            document.getElementById('createOverlay').classList.add('open');
            document.body.style.overflow = 'hidden';
            setTimeout(function () { document.getElementById('cr_name').focus(); }, 80);
        }

        function closeCreate() {
            document.getElementById('createOverlay').classList.remove('open');
            document.body.style.overflow = '';
        }

        function openView() {
            document.getElementById('viewOverlay').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeView() {
            document.getElementById('viewOverlay').classList.remove('open');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', function (e) {
            if (e.key !== 'Escape') return;
            closeCreate();
            closeView();
            closeCancelModal();
            closeCompleteModal();
        });

        /* ═══ HELPERS ═══ */
        function fmtDate(s) {
            if (!s) return '—';
            var d = new Date(s.substring(0, 10) + 'T00:00:00');
            return d.toLocaleDateString('en-PH', { year: 'numeric', month: 'long', day: 'numeric' });
        }

        function fmtTime(t) {
            if (!t) return '—';
            var parts = t.split(':');
            var h = parseInt(parts[0], 10);
            var m = parts[1] || '00';
            var ampm = h >= 12 ? 'PM' : 'AM';
            h = h % 12 || 12;
            return h + ':' + m + ' ' + ampm;
        }

        function toDateStr(d) { return pad4(d.getFullYear()) + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate()); }
        function pad(n) { return String(n).padStart(2, '0'); }
        function pad4(n) { return String(n).padStart(4, '0'); }
        function ucFirst(s) { return s ? s.charAt(0).toUpperCase() + s.slice(1) : s; }
        function escHtml(s) { return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;'); }
    </script>

</x-client-layout>