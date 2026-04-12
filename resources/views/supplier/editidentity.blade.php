<x-supplier-layout>
    <style>
        .bv-page-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;}
        .bv-page-title{font-family:var(--font-display);font-size:1.75rem;font-weight:700;color:var(--charcoal);line-height:1.1;}
        .bv-page-title em{font-style:italic;color:var(--gold-dark);}
        .bv-page-sub{font-size:0.8rem;color:var(--warm-grey);margin-top:0.3rem;}

        /* ══ FULL-WIDTH IDENTITY CARD ══ */
        .bv-id-card{
            background:var(--white);
            border-radius:14px;
            border:1px solid #F0EBE5;
            overflow:hidden;
            box-shadow:0 2px 8px rgba(30,27,24,0.06);
            margin-bottom:1.5rem;
        }
        .bv-id-banner{
            height:110px;
            background:linear-gradient(135deg,var(--charcoal) 0%,#2a2016 60%,#3d2f14 100%);
            position:relative;
        }

        /* ── Card inner: avatar left, info middle, tips right ── */
        .bv-id-inner{
            display:flex;
            align-items:flex-start;
            gap:1.75rem;
            padding:0 2rem 1.75rem;
        }

        /* ── BIG Avatar (110px, pulled up over banner) ── */
        .bv-id-avatar-wrap{
            position:relative;
            width:110px;
            height:110px;
            margin-top:-55px;
            flex-shrink:0;
            z-index:2;
        }
        .bv-id-avatar{
            width:110px;height:110px;
            border-radius:50%;
            background:linear-gradient(135deg,var(--gold) 0%,var(--gold-dark) 100%);
            display:flex;align-items:center;justify-content:center;
            font-family:var(--font-display);font-size:2.4rem;font-weight:700;
            color:var(--white);overflow:hidden;
            border:4px solid var(--white);
            box-shadow:0 4px 16px rgba(30,27,24,0.18);
        }
        .bv-id-avatar img{width:100%;height:100%;object-fit:cover;display:none;}
        .bv-id-avatar.has-photo img{display:block;}
        .bv-id-avatar.has-photo span{display:none;}

        .bv-id-photo-badge{
            position:absolute;bottom:4px;right:4px;
            width:28px;height:28px;border-radius:50%;
            background:var(--gold);border:2.5px solid var(--white);
            display:flex;align-items:center;justify-content:center;
            cursor:pointer;transition:background 0.2s;
            box-shadow:0 2px 6px rgba(30,27,24,0.15);
        }
        .bv-id-photo-badge:hover{background:var(--gold-dark);}
        .bv-id-photo-badge svg{width:11px;height:11px;color:var(--charcoal);}

        /* ── Info block ── */
        .bv-id-info{flex:1;min-width:0;padding-top:0.85rem;}
        .bv-id-name{font-family:var(--font-display);font-size:1.3rem;font-weight:700;color:var(--charcoal);margin-bottom:0.15rem;line-height:1.2;}
        .bv-id-category{font-size:0.7rem;color:var(--gold-dark);letter-spacing:0.05em;font-weight:600;text-transform:uppercase;margin-bottom:0.6rem;}
        .bv-id-badge{
            display:inline-flex;align-items:center;gap:0.35rem;
            padding:0.22rem 0.75rem;border-radius:999px;
            background:rgba(201,168,76,0.1);color:var(--gold-dark);
            font-size:0.65rem;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;
        }
        .bv-id-badge::before{content:'';width:5px;height:5px;border-radius:50%;background:var(--gold);}

        /* ── Photo upload zone in card ── */
        .bv-id-photo-zone{
            display:flex;align-items:center;gap:0.9rem;
            padding:0.85rem 1rem;
            background:rgba(201,168,76,0.04);
            border-radius:10px;border:1px dashed rgba(201,168,76,0.3);
            margin-top:1rem;
            min-width:240px;
            align-self:flex-end;
            flex-shrink:0;
        }
        .bv-pez-thumb{
            width:56px;height:56px;border-radius:50%;flex-shrink:0;overflow:hidden;
            border:2px solid rgba(201,168,76,0.25);
            background:linear-gradient(135deg,var(--gold),var(--gold-dark));
            display:flex;align-items:center;justify-content:center;
            font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--white);
        }
        .bv-pez-thumb img{width:100%;height:100%;object-fit:cover;display:none;}
        .bv-pez-thumb.has-photo img{display:block;}
        .bv-pez-thumb.has-photo span{display:none;}
        .bv-pez-info p{font-size:0.68rem;color:var(--warm-grey);margin-bottom:0.4rem;line-height:1.4;}
        .bv-ul-btn{display:inline-flex;align-items:center;gap:0.35rem;padding:0.38rem 0.8rem;border-radius:6px;border:1.5px solid #E5DDD5;background:var(--white);font-family:var(--font-body);font-size:0.72rem;font-weight:500;color:var(--charcoal);cursor:pointer;transition:border-color 0.2s,color 0.2s,background 0.2s;}
        .bv-ul-btn svg{width:11px;height:11px;}
        .bv-ul-btn:hover{border-color:var(--gold);color:var(--gold-dark);background:rgba(201,168,76,0.05);}

        /* ── Tips strip inside card ── */
        .bv-id-tips-strip{
            display:flex;gap:0.6rem;flex-wrap:wrap;
            padding:0.85rem 2rem;
            border-top:1px solid #F7F3EF;
            background:rgba(201,168,76,0.02);
        }
        .bv-id-tip-pill{
            display:flex;align-items:flex-start;gap:0.4rem;
            font-size:0.7rem;color:var(--warm-grey);line-height:1.4;
            flex:1;min-width:180px;
        }
        .bv-id-tip-pill::before{content:'';width:4px;height:4px;border-radius:50%;background:var(--gold);flex-shrink:0;margin-top:0.45rem;}

        /* ══ FORM SECTION CARDS ══ */
        .bv-main-stack{display:flex;flex-direction:column;gap:1.25rem;}
        .bv-sc{background:var(--white);border-radius:12px;border:1px solid #F0EBE5;overflow:hidden;box-shadow:0 1px 4px rgba(30,27,24,0.04);}
        .bv-sc-head{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.4rem;border-bottom:1px solid #F7F3EF;}
        .bv-sc-head-l{display:flex;align-items:center;gap:0.65rem;}
        .bv-sc-icon{width:32px;height:32px;border-radius:8px;background:rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;color:var(--gold-dark);flex-shrink:0;}
        .bv-sc-icon svg{width:15px;height:15px;}
        .bv-sc-title{font-family:var(--font-display);font-size:0.9rem;font-weight:700;color:var(--charcoal);}
        .bv-sc-desc{font-size:0.7rem;color:var(--warm-grey);margin-top:0.06rem;}
        .bv-sc-body{padding:1.35rem 1.4rem;}
        .bv-sc-foot{padding:0.85rem 1.4rem;border-top:1px solid #F7F3EF;display:flex;align-items:center;justify-content:space-between;gap:0.55rem;}

        /* ── Fields ── */
        .bv-fg{display:grid;grid-template-columns:repeat(2,1fr);gap:0.9rem;}
        .bv-fg-3{display:grid;grid-template-columns:repeat(3,1fr);gap:0.9rem;}
        .bv-fg-full{grid-column:1/-1;}
        @media(max-width:640px){.bv-fg,.bv-fg-3{grid-template-columns:1fr;}}
        .bv-f{margin-bottom:0;}
        .bv-lbl{display:flex;align-items:center;justify-content:space-between;font-size:0.68rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:var(--warm-grey);margin-bottom:0.38rem;}
        .bv-req{font-size:0.58rem;color:#C0392B;font-weight:500;text-transform:none;letter-spacing:0;}
        .bv-opt{font-size:0.58rem;color:#C0B8B0;font-weight:400;text-transform:none;letter-spacing:0;}
        .bv-inp,.bv-ta,.bv-sel{width:100%;padding:0.68rem 0.9rem;background:var(--ivory);border:1.5px solid #E5DDD5;border-radius:8px;font-family:var(--font-body);font-size:0.84rem;color:var(--charcoal);outline:none;transition:border-color 0.2s,box-shadow 0.2s,background 0.2s;appearance:none;display:block;}
        .bv-inp:focus,.bv-ta:focus,.bv-sel:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,0.12);background:var(--white);}
        .bv-inp::placeholder,.bv-ta::placeholder{color:#C0B8B0;}
        .bv-ta{resize:vertical;min-height:90px;}
        .bv-iw{position:relative;}
        .bv-ico{position:absolute;left:0.8rem;top:50%;transform:translateY(-50%);width:14px;height:14px;color:#C0B8B0;pointer-events:none;}
        .bv-iw:focus-within .bv-ico{color:var(--gold-dark);}
        .bv-iw .bv-inp{padding-left:2.35rem;}
        .bv-sw{position:relative;}
        .bv-sw::after{content:'';position:absolute;right:0.85rem;top:50%;transform:translateY(-50%);width:0;height:0;border-left:4px solid transparent;border-right:4px solid transparent;border-top:5px solid #C0B8B0;pointer-events:none;}
        .bv-err{font-size:0.68rem;color:#C0392B;margin-top:0.28rem;}
        .bv-hnt{font-size:0.68rem;color:#C0B8B0;margin-top:0.28rem;}

        /* ══ CATEGORY CHIPS ══ */
        .cat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:0.55rem;margin-top:0.25rem;}
        @media(max-width:720px){.cat-grid{grid-template-columns:repeat(3,1fr);}}
        @media(max-width:480px){.cat-grid{grid-template-columns:repeat(2,1fr);}}
        .cat-chip{
            position:relative;display:flex;align-items:center;gap:0.45rem;
            padding:0.52rem 0.75rem;border:1.5px solid #E5DDD5;
            border-radius:8px;background:var(--ivory);cursor:pointer;user-select:none;
            transition:border-color 0.18s,background 0.18s,box-shadow 0.18s;
        }
        .cat-chip input[type="checkbox"]{position:absolute;opacity:0;width:0;height:0;pointer-events:none;}
        .cat-chip:hover{border-color:rgba(201,168,76,0.5);background:rgba(201,168,76,0.04);}
        .cat-chip-icon{width:26px;height:26px;border-radius:6px;flex-shrink:0;background:rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;transition:background 0.18s;}
        .cat-chip-icon svg{width:13px;height:13px;color:var(--gold-dark);}
        .cat-chip-name{font-size:0.75rem;font-weight:500;color:var(--charcoal);line-height:1.2;flex:1;min-width:0;}
        .cat-chip-check{position:absolute;top:5px;right:6px;width:14px;height:14px;border-radius:50%;border:1.5px solid #E5DDD5;background:var(--white);display:flex;align-items:center;justify-content:center;transition:all 0.18s;}
        .cat-chip-check svg{width:7px;height:7px;color:var(--white);opacity:0;transition:opacity 0.15s;}
        .cat-chip.selected{border-color:var(--gold);background:rgba(201,168,76,0.08);box-shadow:0 0 0 3px rgba(201,168,76,0.12);}
        .cat-chip.selected .cat-chip-icon{background:rgba(201,168,76,0.2);}
        .cat-chip.selected .cat-chip-check{background:var(--gold);border-color:var(--gold);}
        .cat-chip.selected .cat-chip-check svg{opacity:1;}
        .cat-chip.selected .cat-chip-name{color:var(--gold-dark);font-weight:600;}
        .cat-selected-count{font-size:0.65rem;color:var(--gold-dark);margin-top:0.5rem;display:none;}
        .cat-selected-count.show{display:block;}

        /* ── Buttons ── */
        .bv-btn-save{display:inline-flex;align-items:center;gap:0.45rem;padding:0.62rem 1.5rem;border-radius:6px;border:none;background:var(--charcoal);font-family:var(--font-body);font-size:0.82rem;font-weight:500;color:var(--white);cursor:pointer;transition:background 0.2s,box-shadow 0.2s,transform 0.15s;}
        .bv-btn-save svg{width:13px;height:13px;}
        .bv-btn-save:hover{background:var(--gold-dark);box-shadow:0 4px 12px rgba(201,168,76,0.2);transform:translateY(-1px);}
        .bv-btn-back{display:inline-flex;align-items:center;gap:0.4rem;padding:0.62rem 1.1rem;border-radius:6px;border:1.5px solid #E5DDD5;background:var(--white);font-family:var(--font-body);font-size:0.82rem;font-weight:500;color:var(--warm-grey);text-decoration:none;transition:border-color 0.2s,color 0.2s;}
        .bv-btn-back svg{width:12px;height:12px;}
        .bv-btn-back:hover{border-color:var(--gold);color:var(--charcoal);}

        @media(max-width:680px){
            .bv-id-inner{flex-wrap:wrap;gap:1rem;padding:0 1.25rem 1.25rem;}
            .bv-id-photo-zone{min-width:unset;width:100%;align-self:auto;}
            .bv-id-tips-strip{padding:0.85rem 1.25rem;}
        }
    </style>

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
                        ?: trim(($supplierProfile->first_name ?? '').' '.($supplierProfile->last_name ?? ''))
                        ?: Auth::user()->name;

            $previewCat = '';
            if (!empty($supplierProfile->category)) {
                $previewCat = is_object($supplierProfile->category)
                    ? ($supplierProfile->category->name ?? '')
                    : $supplierProfile->category;
            }
        @endphp

        {{-- ══ FULL-WIDTH IDENTITY CARD ══ --}}
        <div class="bv-id-card">
            <div class="bv-id-banner"></div>

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

            {{-- Tips strip at the bottom of the card --}}
            <div class="bv-id-tips-strip">
                <div class="bv-id-tip-pill">A real business name helps clients find you in search.</div>
                <div class="bv-id-tip-pill">A strong tagline boosts profile clicks by up to 40%.</div>
                <div class="bv-id-tip-pill">Detailed descriptions win more booking inquiries.</div>
                <div class="bv-id-tip-pill">Suppliers with photos get 3× more bookings.</div>
            </div>
        </div>{{-- /bv-id-card --}}

        {{-- ══ EDIT FORM ══ --}}
        <div class="bv-main-stack">
            <form method="POST"
                  action="{{ route('supplier.updateidentity', $supplierProfile->id) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

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

                            {{-- Experience --}}
                            <div class="bv-f bv-fg-full">
                                <label class="bv-lbl" for="fi_exp">Experience Level <span class="bv-opt">Optional</span></label>
                                <div class="bv-sw">
                                    <select id="fi_exp" name="experience" class="bv-sel">
                                        <option value="" disabled {{ !old('experience', $supplierProfile->experience) ? 'selected' : '' }}>Select level...</option>
                                        @foreach(['less_than_1'=>'Less than 1 year','1_2'=>'1–2 years','3_5'=>'3–5 years','6_10'=>'6–10 years','10_plus'=>'10+ years'] as $val=>$lbl)
                                            <option value="{{ $val }}" {{ old('experience', $supplierProfile->experience) == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('experience')<div class="bv-err">{{ $message }}</div>@enderror
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
        </div>{{-- /bv-main-stack --}}

    </div>{{-- /page-content --}}

<script>
/* ── LIVE PREVIEW ── */
function updatePreview() {
    const fn   = (document.getElementById('fi_fn')?.value || '').trim();
    const ln   = (document.getElementById('fi_ln')?.value || '').trim();
    const bn   = (document.getElementById('fi_bn')?.value || '').trim();
    const name = bn || ([fn, ln].filter(Boolean).join(' ')) || '{{ addslashes(Auth::user()->name) }}';
    const nameEl = document.getElementById('previewName');
    const initEl = document.getElementById('sideAvatarInitials');
    if (nameEl) nameEl.textContent = name;
    if (initEl && !document.getElementById('sideAvatar').classList.contains('has-photo')) {
        initEl.textContent = ((fn[0] || '') + (ln[0] || '')).toUpperCase() || '?';
    }
}

/* ── CATEGORY PREVIEW ── */
function updateCatPreview() {
    const selected = Array.from(document.querySelectorAll('.cat-chip.selected .cat-chip-name'))
                          .map(el => el.textContent.trim());
    const catEl = document.getElementById('previewCategory');
    if (catEl) catEl.textContent = selected.length ? selected.join(', ') : 'No Category Set';
}

/* ── CATEGORY CHIP TOGGLE via event delegation ── */
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

/* ── SYNC PHOTO from camera badge ── */
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

/* ── PHOTO PREVIEW from upload button ── */
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

/* ── CHAR COUNTER ── */
function bvCt(id, el, max) {
    document.getElementById(id).textContent = el.value.length + ' / ' + max;
}
</script>

</x-supplier-layout>