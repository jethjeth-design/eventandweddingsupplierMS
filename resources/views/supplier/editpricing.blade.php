{{-- resources/views/supplier/pricing/edit.blade.php --}}
<x-supplier-layout>

<style>
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

@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=DM+Sans:wght@300;400;500;600&display=swap');

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: var(--font-body); color: var(--charcoal); background: #F4F0EA; }

/* PAGE WRAPPER */
.page-content { max-width: 700px; margin: 0 auto; padding: 2rem 1.25rem 4rem; }

.bv-page-header {
    display: flex; align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;
}
.bv-page-title {
    font-family: var(--font-display);
    font-size: 2rem; font-weight: 700;
    color: var(--charcoal); line-height: 1.1;
}
.bv-page-title em { font-style: italic; color: var(--gold-dark); }
.bv-page-sub { font-size: .8rem; color: var(--warm-grey); margin-top: .35rem; letter-spacing: .02em; }

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

/* SECTION CARD */
.bv-sc {
    background: var(--white);
    border-radius: var(--radius-md);
    border: 1px solid var(--border);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
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
.bv-sc-title { font-family: var(--font-display); font-size: .98rem; font-weight: 700; color: var(--charcoal); }
.bv-sc-desc  { font-size: .7rem; color: var(--warm-grey); margin-top: .05rem; }
.bv-sc-body  { padding: 1.75rem 1.5rem; display: flex; flex-direction: column; gap: 1.35rem; }

/* FIELDS */
.bv-f { display: flex; flex-direction: column; }
.bv-lbl {
    display: flex; align-items: center; justify-content: space-between;
    font-size: .68rem; font-weight: 600;
    letter-spacing: .08em; text-transform: uppercase;
    color: var(--warm-grey); margin-bottom: .4rem;
}
.bv-req { font-size: .58rem; color: var(--danger); font-weight: 500; text-transform: none; letter-spacing: 0; }
.bv-opt { font-size: .58rem; color: #C0B0A8; font-weight: 400; text-transform: none; letter-spacing: 0; }
.bv-inp {
    width: 100%; padding: .72rem 1rem;
    background: var(--ivory); border: 1.5px solid var(--border);
    border-radius: var(--radius-sm);
    font-family: var(--font-body); font-size: .85rem; color: var(--charcoal);
    outline: none; appearance: none; display: block;
    transition: border-color .2s, box-shadow .2s, background .2s;
}
.bv-inp:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(201,168,76,.14);
    background: var(--white);
}
.bv-inp::placeholder { color: #C5BCBA; }
.bv-err { font-size: .68rem; color: var(--danger); margin-top: .3rem; }
.bv-hnt { font-size: .68rem; color: #C0B0A8; margin-top: .3rem; line-height: 1.5; }

/* Currency prefix wrapper */
.bv-pw { position: relative; }
.bv-pw .bv-pfx {
    position: absolute; left: 0; top: 0; bottom: 0;
    display: flex; align-items: center; justify-content: center;
    width: 2.8rem;
    font-size: .82rem; font-weight: 700; color: var(--warm-grey);
    border-right: 1.5px solid var(--border);
    pointer-events: none;
    transition: color .2s, border-color .2s;
    z-index: 1;
}
.bv-pw:focus-within .bv-pfx { color: var(--gold-dark); border-color: var(--gold); }
.bv-pw .bv-inp { padding-left: 3.25rem; font-size: .95rem; font-weight: 600; }

/* LIVE PREVIEW CARD */
.bv-price-card {
    border-radius: var(--radius-sm);
    border: 1.5px solid rgba(201,168,76,.25);
    background: linear-gradient(135deg, rgba(201,168,76,.07) 0%, rgba(201,168,76,.02) 100%);
    padding: 1.1rem 1.25rem;
    display: flex; align-items: center; gap: .9rem;
    transition: all .3s;
}
.bv-price-card.empty {
    border-color: var(--border);
    background: var(--ivory);
}
.bv-price-card-icon {
    width: 42px; height: 42px; border-radius: 10px; flex-shrink: 0;
    background: rgba(201,168,76,.14);
    display: flex; align-items: center; justify-content: center;
    color: var(--gold-dark);
    transition: background .3s;
}
.bv-price-card.empty .bv-price-card-icon { background: rgba(140,129,120,.08); color: var(--warm-grey); }
.bv-price-card-icon svg { width: 18px; height: 18px; }
.bv-price-card-info { flex: 1; min-width: 0; }
.bv-price-card-label {
    font-size: .64rem; font-weight: 600; letter-spacing: .07em;
    text-transform: uppercase; color: var(--warm-grey); margin-bottom: .2rem;
}
.bv-price-card-value {
    font-family: var(--font-display);
    font-size: 1.4rem; font-weight: 700; color: var(--charcoal);
    line-height: 1.1; transition: color .2s;
}
.bv-price-card:not(.empty) .bv-price-card-value { color: var(--gold-dark); }
.bv-price-card-sub { font-size: .68rem; color: var(--warm-grey); margin-top: .18rem; }

/* INFO STRIP */
.bv-info-strip {
    display: flex; gap: .7rem; flex-wrap: wrap;
    padding: .9rem 1.5rem;
    border-top: 1px solid var(--border-soft);
    background: rgba(201,168,76,.025);
}
.bv-info-pill {
    display: flex; align-items: flex-start; gap: .45rem;
    font-size: .7rem; color: var(--warm-grey); line-height: 1.45;
    flex: 1; min-width: 175px;
}
.bv-info-pill::before {
    content: ''; width: 5px; height: 5px; border-radius: 50%;
    background: var(--gold); flex-shrink: 0; margin-top: .42rem;
}

/* FOOTER */
.bv-sc-foot {
    display: flex; align-items: center; justify-content: space-between;
    gap: .6rem; padding: 1rem 1.5rem;
    border-top: 1px solid var(--border-soft);
    background: rgba(201,168,76,.02);
}
.bv-btn-save {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: .68rem 1.65rem; border-radius: var(--radius-sm); border: none;
    background: var(--charcoal);
    font-family: var(--font-body); font-size: .84rem; font-weight: 600;
    color: var(--white); cursor: pointer;
    transition: background .22s, box-shadow .22s, transform .15s;
    letter-spacing: .02em;
}
.bv-btn-save svg { width: 14px; height: 14px; }
.bv-btn-save:hover { background: var(--gold-dark); box-shadow: 0 4px 14px rgba(168,132,42,.3); transform: translateY(-1px); }
.bv-btn-back {
    display: inline-flex; align-items: center; gap: .42rem;
    padding: .68rem 1.2rem; border-radius: var(--radius-sm);
    border: 1.5px solid var(--border); background: var(--white);
    font-family: var(--font-body); font-size: .84rem; font-weight: 500;
    color: var(--warm-grey); text-decoration: none;
    transition: border-color .2s, color .2s, background .2s;
}
.bv-btn-back svg { width: 13px; height: 13px; }
.bv-btn-back:hover { border-color: var(--gold); color: var(--charcoal); background: var(--ivory); }

@media (max-width: 480px) {
    .bv-page-title { font-size: 1.6rem; }
    .bv-sc-body    { padding: 1.25rem; }
    .bv-sc-foot    { padding: .9rem 1.25rem; flex-direction: column; }
    .bv-btn-save, .bv-btn-back { width: 100%; justify-content: center; }
}
</style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pricing') }}
        </h2>
    </x-slot>

<div class="page-content">

    {{-- PAGE HEADER --}}
    <div class="bv-page-header">
        <div>
            <h1 class="bv-page-title">Service <em>Pricing</em></h1>
            <p class="bv-page-sub">Set your rate so clients know what to expect</p>
        </div>
        <a href="{{ route('supplier.supplierprofile', $supplier->id) }}" class="bv-btn-back">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 2L4 7l5 5"/>
            </svg>
            Back to Profile
        </a>
    </div>

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

    <form action="{{ route('supplier.pricing.update', $supplier->id) }}"
          method="POST" id="pricingForm">
        @csrf
        @method('PUT')

        <div class="bv-sc">

            {{-- Section head --}}
            <div class="bv-sc-head">
                <div class="bv-sc-head-l">
                    <div class="bv-sc-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="10" cy="10" r="8"/>
                            <path d="M10 5.5v1.2M10 13.3v1.2M7.2 8a2.8 2.8 0 015.6 0c0 1.6-1.4 2.1-2.8 2.1S7.2 10.6 7.2 12a2.8 2.8 0 005.6 0"/>
                        </svg>
                    </div>
                    <div>
                        <div class="bv-sc-title">Set Your Price</div>
                        <div class="bv-sc-desc">This is the rate clients will see on your profile</div>
                    </div>
                </div>
            </div>

            <div class="bv-sc-body">

                {{-- Price input --}}
                <div class="bv-f">
                    <label class="bv-lbl" for="fi_price">
                        Service Price <span class="bv-req">Required</span>
                    </label>
                    <div class="bv-pw">
                        <span class="bv-pfx">₱</span>
                        <input id="fi_price"
                               name="starting_price"
                               type="number"
                               class="bv-inp"
                               min="0"
                               step="0.01"
                               value="{{ old('starting_price', $supplier->starting_price) }}"
                               placeholder="e.g. 15000"
                               oninput="updatePreview()"
                               required>
                    </div>
                    <p class="bv-hnt">The price clients will see on your listing. You can update this anytime.</p>
                    @error('starting_price')
                        <div class="bv-err">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Live preview --}}
                <div class="bv-price-card empty" id="priceCard">
                    <div class="bv-price-card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M12 6v1.5M12 16.5V18M9 9a3 3 0 016 0c0 1.8-1.5 2.4-3 2.4s-3 .6-3 2.4a3 3 0 006 0"/>
                        </svg>
                    </div>
                    <div class="bv-price-card-info">
                        <div class="bv-price-card-label">Client Preview</div>
                        <div class="bv-price-card-value" id="previewValue">—</div>
                        <div class="bv-price-card-sub"  id="previewSub">Enter your price above to see how it appears</div>
                    </div>
                </div>

            </div>{{-- /bv-sc-body --}}

            {{-- Info strip --}}
            <div class="bv-info-strip">
                <div class="bv-info-pill">Transparent pricing increases booking conversion by up to 35%.</div>
                <div class="bv-info-pill">Clear rates reduce back-and-forth with potential clients.</div>
                <div class="bv-info-pill">You can update your price anytime from your supplier profile.</div>
            </div>

            {{-- Footer --}}
            <div class="bv-sc-foot">
                <a href="{{ route('supplier.supplierprofile', $supplier->id) }}" class="bv-btn-back">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 2L4 7l5 5"/>
                    </svg>
                    Cancel
                </a>
                <button type="submit" class="bv-btn-save">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 8l4 4 6-6"/>
                    </svg>
                    Save Pricing
                </button>
            </div>

        </div>{{-- /bv-sc --}}

    </form>

</div>{{-- /page-content --}}

<script>
function updatePreview() {
    const input = document.getElementById('fi_price');
    const card  = document.getElementById('priceCard');
    const val   = document.getElementById('previewValue');
    const sub   = document.getElementById('previewSub');

    const raw = parseFloat(input?.value);
    const hasValue = !isNaN(raw) && raw > 0;

    card.classList.toggle('empty', !hasValue);

    if (hasValue) {
        val.textContent = '₱' + raw.toLocaleString('en-PH', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
        sub.textContent = 'This is the price shown on your listing';
    } else {
        val.textContent = '—';
        sub.textContent = 'Enter your price above to see how it appears';
    }
}

// Populate preview on page load from existing value
document.addEventListener('DOMContentLoaded', updatePreview);
</script>

</x-supplier-layout>