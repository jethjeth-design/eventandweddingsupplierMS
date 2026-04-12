<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Homepage Banners') }}
            </h2>
            @if($banner)
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                    Live
                </span>
            @else
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                    Not configured
                </span>
            @endif
        </div>
    </x-slot>

    <style>
        /* ── Base ── */
        .bm-card {
            background: #fff;
            border: 0.5px solid #e5e7eb;
            border-radius: 14px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .bm-section-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #9ca3af;
            margin-bottom: 1rem;
        }
        .bm-label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: #6b7280;
            margin-bottom: 5px;
        }
        .bm-input {
            width: 100%;
            padding: 8px 12px;
            border: 0.5px solid #d1d5db;
            border-radius: 8px;
            font-size: 13px;
            color: #111827;
            background: #fff;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }
        .bm-input:focus {
            border-color: #6b7280;
            box-shadow: 0 0 0 3px rgba(0,0,0,0.06);
        }
        textarea.bm-input { resize: vertical; min-height: 72px; }

        /* ── Slide grid ── */
        .slide-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 12px;
        }
        .slide-slot {
            position: relative;
            aspect-ratio: 16 / 9;
            border: 1.5px dashed #d1d5db;
            border-radius: 10px;
            overflow: hidden;
            background: #f9fafb;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: border-color 0.15s;
        }
        .slide-slot:hover { border-color: #9ca3af; }
        .slide-slot.has-img { border-style: solid; border-color: #e5e7eb; }
        .slide-slot img {
            position: absolute; inset: 0;
            width: 100%; height: 100%;
            object-fit: cover;
        }
        .slide-overlay {
            position: absolute; inset: 0;
            background: rgba(0,0,0,0.48);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
            opacity: 0;
            transition: opacity 0.15s;
        }
        .slide-slot:hover .slide-overlay { opacity: 1; }
        .slide-badge {
            position: absolute;
            top: 6px; left: 8px;
            font-size: 10px; font-weight: 500;
            color: #fff;
            background: rgba(0,0,0,0.4);
            padding: 2px 7px;
            border-radius: 99px;
            pointer-events: none;
        }
        .slide-pending-badge {
            position: absolute;
            top: 6px; right: 8px;
            font-size: 9px; font-weight: 600;
            color: #fff;
            background: #f59e0b;
            padding: 2px 7px;
            border-radius: 99px;
            pointer-events: none;
            display: none;
        }
        .slide-slot.pending .slide-pending-badge { display: block; }
        .slide-replace-btn {
            font-size: 11px;
            color: #fff;
            background: rgba(255,255,255,0.2);
            border: 0.5px solid rgba(255,255,255,0.5);
            border-radius: 6px;
            padding: 4px 10px;
        }
        .slide-placeholder-icon { opacity: 0.2; margin-bottom: 4px; }
        .slide-num-label { font-size: 11px; font-weight: 500; color: #9ca3af; }

        /* ── Buttons ── */
        .btn-primary {
            padding: 8px 18px;
            background: #111827; color: #fff;
            border: none; border-radius: 8px;
            font-size: 13px; font-weight: 500;
            cursor: pointer;
            transition: opacity 0.15s;
            text-decoration: none; display: inline-block;
        }
        .btn-primary:hover { opacity: 0.8; }
        .btn-outline {
            padding: 8px 18px;
            background: transparent; color: #374151;
            border: 0.5px solid #d1d5db; border-radius: 8px;
            font-size: 13px; font-weight: 500;
            cursor: pointer;
            transition: background 0.15s;
            text-decoration: none; display: inline-block;
        }
        .btn-outline:hover { background: #f3f4f6; }
        .btn-danger {
            padding: 8px 18px;
            background: transparent; color: #dc2626;
            border: 0.5px solid #fca5a5; border-radius: 8px;
            font-size: 13px; font-weight: 500;
            cursor: pointer;
            text-decoration: none; display: inline-block;
        }

        /* ── Modal ── */
        .modal-backdrop {
            position: fixed; inset: 0;
            background: rgba(30,27,24,0.5);
            backdrop-filter: blur(4px);
            z-index: 500;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .modal-box {
            background: #fff;
            border-radius: 16px;
            width: 560px; max-width: 100%;
            border: 0.5px solid #e5e7eb;
            max-height: 92vh;
            display: flex;
            flex-direction: column;
            margin: auto;
            flex-shrink: 0;
        }
        .modal-header {
            flex-shrink: 0;
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.25rem 1.5rem;
            border-bottom: 0.5px solid #e5e7eb;
        }
        .modal-title { font-size: 15px; font-weight: 500; color: #111827; }
        .modal-close {
            width: 28px; height: 28px;
            border: none; background: #f3f4f6; border-radius: 50%;
            cursor: pointer; font-size: 18px; color: #6b7280;
            display: flex; align-items: center; justify-content: center;
            line-height: 1; flex-shrink: 0;
        }
        .modal-body {
            padding: 1.5rem;
            overflow-y: auto;
            flex: 1;
            min-height: 0;
        }
        .modal-footer {
            flex-shrink: 0;
            padding: 1rem 1.5rem;
            border-top: 0.5px solid #e5e7eb;
            display: flex; gap: 10px; justify-content: flex-end;
        }

        /* ── Misc ── */
        .form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-field { display: flex; flex-direction: column; gap: 5px; margin-bottom: 1rem; }
        .form-field:last-child { margin-bottom: 0; }
        .error-msg { color: #dc2626; font-size: 12px; margin-top: 3px; }
        .alert-success {
            background: #f0fdf4; color: #15803d;
            border: 0.5px solid #bbf7d0; border-radius: 8px;
            padding: 10px 14px; font-size: 13px; margin-bottom: 1.5rem;
        }
        .empty-state { text-align: center; padding: 5rem 2rem; }
        .page-actions { display: flex; gap: 10px; align-items: center; }
        .form-actions {
            display: flex; gap: 10px; justify-content: flex-end;
            padding-top: 1.25rem;
            border-top: 0.5px solid #e5e7eb;
            margin-top: 1.5rem;
        }
        .feat-section-divider {
            border: none;
            border-top: 0.5px solid #e5e7eb;
            margin: 1.25rem 0;
        }
        .feat-heading {
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 0.75rem;
        }

        /* ══════════════════════════════════════════
           FEATURE STEPPER
        ══════════════════════════════════════════ */
        .feat-stepper-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.1rem;
        }
        .feat-step-label {
            font-size: 13px;
            font-weight: 500;
            color: #111827;
        }
        .feat-step-label span {
            font-size: 11px;
            font-weight: 400;
            color: #9ca3af;
            margin-left: 6px;
        }
        .feat-step-nav {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .feat-step-btn {
            width: 30px; height: 30px;
            border: 0.5px solid #d1d5db;
            border-radius: 7px;
            background: #fff;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: #374151;
            font-size: 15px;
            transition: background 0.15s, border-color 0.15s;
        }
        .feat-step-btn:hover { background: #f3f4f6; border-color: #9ca3af; }
        .feat-step-btn:disabled { opacity: 0.35; cursor: default; }
        .feat-step-dots {
            display: flex; gap: 5px; align-items: center;
        }
        .feat-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #e5e7eb;
            cursor: pointer;
            transition: background 0.15s, transform 0.15s;
        }
        .feat-dot.active {
            background: #111827;
            transform: scale(1.25);
        }

        /* Each feature "page" */
        .feat-page { display: none; }
        .feat-page.active { display: block; }

        /* Progress bar */
        .feat-progress-bar {
            height: 2px;
            background: #e5e7eb;
            border-radius: 1px;
            margin-bottom: 1.25rem;
            overflow: hidden;
        }
        .feat-progress-fill {
            height: 100%;
            background: #111827;
            border-radius: 1px;
            transition: width 0.25s ease;
        }
    </style>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($banner)
            {{-- ===================== EDIT FORM ===================== --}}

                <div class="flex items-center justify-between mb-6">
                    <p class="text-sm text-gray-500">Manage your homepage hero section content and slide images.</p>
                    <div class="page-actions">
                        <form action="{{ route('banners.destroy', $banner->id) }}" method="POST"
                              onsubmit="return confirm('Delete this banner? This cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">Delete Banner</button>
                        </form>
                        <button type="submit" form="edit-banner-form" class="btn-primary">Save Changes</button>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert-success">{{ session('success') }}</div>
                @endif

                <form id="edit-banner-form"
                      action="{{ route('banners.update', $banner->id) }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- ── Hero Text ── --}}
                    <p class="bm-section-label">Text content</p>
                    <div class="bm-card">
                        <div class="form-grid-2" style="margin-bottom:1rem;">
                            <div class="form-field" style="margin-bottom:0;">
                                <label class="bm-label" for="hero_tag">Hero tag</label>
                                <input class="bm-input @error('hero_tag') border-red-400 @enderror"
                                       type="text" name="hero_tag" id="hero_tag"
                                       value="{{ old('hero_tag', $banner->hero_tag) }}"
                                       placeholder="e.g. New collection">
                                @error('hero_tag')<p class="error-msg">{{ $message }}</p>@enderror
                            </div>
                            <div class="form-field" style="margin-bottom:0;">
                                <label class="bm-label" for="hero_subtitle">Hero subtitle</label>
                                <input class="bm-input @error('hero_subtitle') border-red-400 @enderror"
                                       type="text" name="hero_subtitle" id="hero_subtitle"
                                       value="{{ old('hero_subtitle', $banner->hero_subtitle) }}"
                                       placeholder="Short tagline below the title">
                                @error('hero_subtitle')<p class="error-msg">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="form-grid-2" style="margin-bottom:1rem;">
                            <div class="form-field" style="margin-bottom:0;">
                                <label class="bm-label" for="hero_title_1">Hero title 1</label>
                                <input class="bm-input @error('hero_title_1') border-red-400 @enderror"
                                       type="text" name="hero_title_1" id="hero_title_1"
                                       value="{{ old('hero_title_1', $banner->hero_title_1) }}"
                                       placeholder="e.g. Style">
                                @error('hero_title_1')<p class="error-msg">{{ $message }}</p>@enderror
                            </div>
                            <div class="form-field" style="margin-bottom:0;">
                                <label class="bm-label" for="hero_title_2">Hero title 2</label>
                                <input class="bm-input @error('hero_title_2') border-red-400 @enderror"
                                       type="text" name="hero_title_2" id="hero_title_2"
                                       value="{{ old('hero_title_2', $banner->hero_title_2) }}"
                                       placeholder="e.g. Redefined">
                                @error('hero_title_2')<p class="error-msg">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <hr class="feat-section-divider">

                        {{-- ── Section Title / Subtitle ── --}}
                        <div class="form-grid-2">
                            <div class="form-field" style="margin-bottom:0;">
                                <label class="bm-label" for="section_title">Section title</label>
                                <input class="bm-input @error('section_title') border-red-400 @enderror"
                                       type="text" name="section_title" id="section_title"
                                       value="{{ old('section_title', $section->section_title ?? '') }}"
                                       placeholder="e.g. Why choose us">
                                @error('section_title')<p class="error-msg">{{ $message }}</p>@enderror
                            </div>
                            <div class="form-field" style="margin-bottom:0;">
                                <label class="bm-label" for="section_subtitle">Section subtitle</label>
                                <input class="bm-input @error('section_subtitle') border-red-400 @enderror"
                                       type="text" name="section_subtitle" id="section_subtitle"
                                       value="{{ old('section_subtitle', $section->section_subtitle ?? '' ) }}"
                                       placeholder="Short tagline">
                                @error('section_subtitle')<p class="error-msg">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- ── Features stepper (edit form) ── --}}
                    <p class="bm-section-label">Features</p>
                    <div class="bm-card">

                        {{-- Stepper header --}}
                        <div class="feat-stepper-header">
                            <div>
                                <span class="feat-step-label" id="e-step-label">Feature 1</span>
                                <span id="e-step-sub" style="font-size:11px;color:#9ca3af;margin-left:6px;"></span>
                            </div>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div class="feat-step-dots" id="e-dots"></div>
                                <div class="feat-step-nav">
                                    <button type="button" class="feat-step-btn" id="e-prev-btn" onclick="eStepper(-1)" disabled>&#8249;</button>
                                    <button type="button" class="feat-step-btn" id="e-next-btn" onclick="eStepper(1)">&#8250;</button>
                                </div>
                            </div>
                        </div>

                        {{-- Progress bar --}}
                        <div class="feat-progress-bar">
                            <div class="feat-progress-fill" id="e-progress" style="width:14.28%;"></div>
                        </div>

                        {{-- Feature pages --}}
                        @for ($f = 1; $f <= 7; $f++)
                            @php
                                $titleKey = $f === 1 ? 'feature_title'  : 'feature_title'.$f;
                                $descKey  = $f === 1 ? 'feature_desc'   : 'feature_desc'.$f;
                            @endphp
                            <div class="feat-page {{ $f === 1 ? 'active' : '' }}" id="e-feat-{{ $f }}">
                                <div class="form-grid-2">
                                    <div class="form-field" style="margin-bottom:0;">
                                        <label class="bm-label">Title</label>
                                        <input class="bm-input @error($titleKey) border-red-400 @enderror"
                                               type="text" name="{{ $titleKey }}"
                                               value="{{ old($titleKey, $section->$titleKey ?? '') }}"
                                               placeholder="Feature {{ $f }} title">
                                        @error($titleKey)<p class="error-msg">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="form-field" style="margin-bottom:0;">
                                        <label class="bm-label">Description</label>
                                        <textarea class="bm-input @error($descKey) border-red-400 @enderror"
                                                  name="{{ $descKey }}"
                                                  placeholder="Short description">{{ old($descKey, $section->$descKey ?? '') }}</textarea>
                                        @error($descKey)<p class="error-msg">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>
                        @endfor

                        {{-- Bottom nav buttons --}}
                        <div style="display:flex;justify-content:space-between;margin-top:1.1rem;padding-top:1rem;border-top:0.5px solid #e5e7eb;">
                            <button type="button" class="btn-outline" id="e-prev-bot" onclick="eStepper(-1)" disabled>&#8249; Previous</button>
                            <button type="button" class="btn-outline" id="e-next-bot" onclick="eStepper(1)">Next &#8250;</button>
                        </div>
                    </div>

                    {{-- ── Slide Images ── --}}
                    <p class="bm-section-label">Slide images</p>
                    <div class="bm-card">
                        <div class="slide-grid">
                            @for ($i = 1; $i <= 5; $i++)
                                <div>
                                    <div id="slot_{{ $i }}"
                                         class="slide-slot {{ $banner['slide_'.$i] ? 'has-img' : '' }}"
                                         onclick="document.getElementById('file_{{ $i }}').click()">

                                        <img id="preview_{{ $i }}"
                                             src="{{ $banner['slide_'.$i] ? asset('storage/'.$banner['slide_'.$i]) : '' }}"
                                             alt="Slide {{ $i }}"
                                             style="{{ $banner['slide_'.$i] ? '' : 'display:none;' }}">

                                        <svg id="ph_icon_{{ $i }}" class="slide-placeholder-icon"
                                             width="28" height="28" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="1.5"
                                             style="{{ $banner['slide_'.$i] ? 'display:none;' : '' }}">
                                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                                            <circle cx="8.5" cy="8.5" r="1.5"/>
                                            <path d="M21 15l-5-5L5 21"/>
                                        </svg>
                                        <span id="ph_label_{{ $i }}" class="slide-num-label"
                                              style="{{ $banner['slide_'.$i] ? 'display:none;' : '' }}">
                                            Slide {{ $i }}
                                        </span>

                                        <div class="slide-overlay">
                                            <svg width="16" height="16" viewBox="0 0 24 24"
                                                 fill="none" stroke="#fff" stroke-width="2.5">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                                <polyline points="17 8 12 3 7 8"/>
                                                <line x1="12" y1="3" x2="12" y2="15"/>
                                            </svg>
                                            <span class="slide-replace-btn">
                                                {{ $banner['slide_'.$i] ? 'Replace' : 'Upload' }}
                                            </span>
                                        </div>

                                        <span class="slide-badge">Slide {{ $i }}</span>
                                        <span class="slide-pending-badge">Unsaved</span>
                                    </div>

                                    <input type="file" id="file_{{ $i }}" name="slide_{{ $i }}"
                                           accept="image/*" class="hidden"
                                           onchange="previewSlide(this, {{ $i }})">

                                    @error('slide_'.$i)
                                        <p class="error-msg">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endfor
                        </div>
                        <p style="font-size:11px; color:#9ca3af; margin-top:12px;">
                            Click any slide to upload or replace. Recommended: 1920×1080px JPG or PNG.
                        </p>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Save Changes</button>
                    </div>
                </form>

            @else
            {{-- ===================== EMPTY STATE ===================== --}}

                <div class="bm-card">
                    <div class="empty-state">
                        <svg width="52" height="52" viewBox="0 0 48 48" fill="none" stroke="currentColor"
                             stroke-width="1" style="opacity:0.18; margin:0 auto 1.25rem;"
                             xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="10" width="40" height="28" rx="3"/>
                            <circle cx="16" cy="21" r="3"/>
                            <path d="M44 32L32 20 18 36"/>
                            <path d="M20 36L26 30"/>
                        </svg>
                        <p style="font-size:16px; font-weight:500; color:#111827; margin-bottom:6px;">No banner configured</p>
                        <p style="font-size:13px; color:#6b7280; margin-bottom:1.5rem; max-width:340px; margin-left:auto; margin-right:auto;">
                            Set up your homepage hero section with titles, a subtitle tag, and up to 5 slide images.
                        </p>
                        <button class="btn-primary" onclick="openCreateModal()">Create banner</button>
                    </div>
                </div>
            @endif

        </div>
    </div>

    {{-- ===================== CREATE MODAL (no-banner only) ===================== --}}
    @if(!$banner)
    <div id="create-modal" class="modal-backdrop" style="display:none;">
        <div class="modal-box">

            <div class="modal-header">
                <span class="modal-title">Create banner</span>
                <button type="button" class="modal-close" onclick="closeCreateModal()">&#215;</button>
            </div>

            <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data"
                  style="display:contents;">
                @csrf

                <div class="modal-body">
                    @if($errors->any())
                        <div style="background:#fef2f2; border:0.5px solid #fca5a5; border-radius:8px;
                                    padding:10px 14px; margin-bottom:1rem; font-size:12px; color:#dc2626;">
                            Please fix the errors below and try again.
                        </div>
                    @endif

                    {{-- ── Hero Fields ── --}}
                    <div class="form-field">
                        <label class="bm-label" for="m_hero_tag">Hero tag</label>
                        <input class="bm-input @error('hero_tag') border-red-400 @enderror"
                               type="text" name="hero_tag" id="m_hero_tag"
                               value="{{ old('hero_tag') }}" placeholder="e.g. New collection">
                        @error('hero_tag')<p class="error-msg">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-grid-2">
                        <div class="form-field">
                            <label class="bm-label" for="m_hero_title_1">Hero title 1</label>
                            <input class="bm-input @error('hero_title_1') border-red-400 @enderror"
                                   type="text" name="hero_title_1" id="m_hero_title_1"
                                   value="{{ old('hero_title_1') }}" placeholder="e.g. Style">
                            @error('hero_title_1')<p class="error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-field">
                            <label class="bm-label" for="m_hero_title_2">Hero title 2</label>
                            <input class="bm-input @error('hero_title_2') border-red-400 @enderror"
                                   type="text" name="hero_title_2" id="m_hero_title_2"
                                   value="{{ old('hero_title_2') }}" placeholder="e.g. Redefined">
                            @error('hero_title_2')<p class="error-msg">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="form-field">
                        <label class="bm-label" for="m_hero_subtitle">Hero subtitle</label>
                        <input class="bm-input @error('hero_subtitle') border-red-400 @enderror"
                               type="text" name="hero_subtitle" id="m_hero_subtitle"
                               value="{{ old('hero_subtitle') }}" placeholder="Short description below the title">
                        @error('hero_subtitle')<p class="error-msg">{{ $message }}</p>@enderror
                    </div>

                    {{-- ── Slide Images ── --}}
                    <div class="form-field">
                        <label class="bm-label">
                            Slide images
                            <span style="font-weight:400; color:#9ca3af;">(optional, up to 5)</span>
                        </label>
                        <div style="display:grid; grid-template-columns:repeat(5,minmax(0,1fr)); gap:8px; margin-top:6px;">
                            @for ($i = 1; $i <= 5; $i++)
                                <div>
                                    <div id="m_slot_{{ $i }}"
                                         class="slide-slot"
                                         style="aspect-ratio:1;"
                                         onclick="document.getElementById('m_file_{{ $i }}').click()">

                                        <img id="m_preview_{{ $i }}" src="" alt=""
                                             style="display:none; position:absolute; inset:0; width:100%; height:100%; object-fit:cover;">

                                        <svg id="m_icon_{{ $i }}" class="slide-placeholder-icon"
                                             width="18" height="18" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="1.5">
                                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                                            <circle cx="8.5" cy="8.5" r="1.5"/>
                                            <path d="M21 15l-5-5L5 21"/>
                                        </svg>
                                        <span id="m_label_{{ $i }}" class="slide-num-label"
                                              style="font-size:10px;">{{ $i }}</span>

                                        <div class="slide-overlay">
                                            <span class="slide-replace-btn" style="font-size:10px; padding:3px 8px;">Upload</span>
                                        </div>
                                        <span class="slide-pending-badge">New</span>
                                    </div>
                                    <input type="file" id="m_file_{{ $i }}" name="slide_{{ $i }}"
                                           accept="image/*" class="hidden"
                                           onchange="previewModalSlide(this, {{ $i }})">
                                    @error('slide_'.$i)<p class="error-msg">{{ $message }}</p>@enderror
                                </div>
                            @endfor
                        </div>
                        <p style="font-size:11px; color:#9ca3af; margin-top:8px;">
                            Click a slot to pick an image. You can also add them after creation.
                        </p>
                    </div>

                    <hr class="feat-section-divider">

                    {{-- ── Section Title / Subtitle ── --}}
                    <div class="form-grid-2">
                        <div class="form-field">
                            <label class="bm-label" for="m_section_title">Section title</label>
                            <input class="bm-input @error('section_title') border-red-400 @enderror"
                                   type="text" name="section_title" id="m_section_title"
                                   value="{{ old('section_title') }}" placeholder="e.g. Why choose us">
                            @error('section_title')<p class="error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-field">
                            <label class="bm-label" for="m_section_subtitle">Section subtitle</label>
                            <input class="bm-input @error('section_subtitle') border-red-400 @enderror"
                                   type="text" name="section_subtitle" id="m_section_subtitle"
                                   value="{{ old('section_subtitle') }}" placeholder="Short tagline">
                            @error('section_subtitle')<p class="error-msg">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <hr class="feat-section-divider">

                    {{-- ── Features stepper (modal) ── --}}
                    <div style="margin-bottom:0.5rem;">
                        <div class="feat-stepper-header">
                            <div>
                                <span class="feat-step-label" id="m-step-label">Feature 1</span>
                                <span id="m-step-sub" style="font-size:11px;color:#9ca3af;margin-left:6px;"></span>
                            </div>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div class="feat-step-dots" id="m-dots"></div>
                                <div class="feat-step-nav">
                                    <button type="button" class="feat-step-btn" id="m-prev-btn" onclick="mStepper(-1)" disabled>&#8249;</button>
                                    <button type="button" class="feat-step-btn" id="m-next-btn" onclick="mStepper(1)">&#8250;</button>
                                </div>
                            </div>
                        </div>

                        <div class="feat-progress-bar">
                            <div class="feat-progress-fill" id="m-progress" style="width:14.28%;"></div>
                        </div>

                        @for ($f = 1; $f <= 7; $f++)
                            @php
                                $titleKey = $f === 1 ? 'feature_title'  : 'feature_title'.$f;
                                $descKey  = $f === 1 ? 'feature_desc'   : 'feature_desc'.$f;
                            @endphp
                            <div class="feat-page {{ $f === 1 ? 'active' : '' }}" id="m-feat-{{ $f }}">
                                <div class="form-grid-2">
                                    <div class="form-field" style="margin-bottom:0;">
                                        <label class="bm-label">Title</label>
                                        <input class="bm-input @error($titleKey) border-red-400 @enderror"
                                               type="text" name="{{ $titleKey }}"
                                               value="{{ old($titleKey) }}"
                                               placeholder="Feature {{ $f }} title">
                                        @error($titleKey)<p class="error-msg">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="form-field" style="margin-bottom:0;">
                                        <label class="bm-label">Description</label>
                                        <textarea class="bm-input @error($descKey) border-red-400 @enderror"
                                                  name="{{ $descKey }}"
                                                  placeholder="Short description">{{ old($descKey) }}</textarea>
                                        @error($descKey)<p class="error-msg">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>
                        @endfor

                        <div style="display:flex;justify-content:space-between;margin-top:1rem;padding-top:1rem;border-top:0.5px solid #e5e7eb;">
                            <button type="button" class="btn-outline" id="m-prev-bot" onclick="mStepper(-1)" disabled>&#8249; Previous</button>
                            <button type="button" class="btn-outline" id="m-next-bot" onclick="mStepper(1)">Next &#8250;</button>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-outline" onclick="closeCreateModal()">Cancel</button>
                    <button type="submit" class="btn-primary">Create banner</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        /* ── Modal open / close ── */
        function openCreateModal() {
            document.getElementById('create-modal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        function closeCreateModal() {
            document.getElementById('create-modal').style.display = 'none';
            document.body.style.overflow = '';
        }
        document.getElementById('create-modal').addEventListener('click', function (e) {
            if (e.target === this) closeCreateModal();
        });
        @if($errors->any())
            openCreateModal();
        @endif

        /* ── Modal slide preview ── */
        function previewModalSlide(input, i) {
            if (!input.files || !input.files[0]) return;
            const reader = new FileReader();
            reader.onload = function (e) {
                const slot    = document.getElementById('m_slot_'    + i);
                const preview = document.getElementById('m_preview_' + i);
                const icon    = document.getElementById('m_icon_'    + i);
                const lbl     = document.getElementById('m_label_'   + i);
                preview.src           = e.target.result;
                preview.style.display = '';
                icon.style.display    = 'none';
                lbl.style.display     = 'none';
                slot.classList.add('has-img', 'pending');
            };
            reader.readAsDataURL(input.files[0]);
        }

        /* ── Modal feature stepper ── */
        const TOTAL = 7;
        var mStep = 1;

        function buildDots(containerId, step, stepperFn) {
            const c = document.getElementById(containerId);
            c.innerHTML = '';
            for (let i = 1; i <= TOTAL; i++) {
                const d = document.createElement('div');
                d.className = 'feat-dot' + (i === step ? ' active' : '');
                d.title = 'Feature ' + i;
                d.onclick = (function(n){ return function(){ stepperFn(null, n); }; })(i);
                c.appendChild(d);
            }
        }

        function mStepper(dir, jumpTo) {
            const next = jumpTo !== undefined ? jumpTo : mStep + dir;
            if (next < 1 || next > TOTAL) return;
            document.getElementById('m-feat-' + mStep).classList.remove('active');
            mStep = next;
            document.getElementById('m-feat-' + mStep).classList.add('active');
            document.getElementById('m-step-label').textContent = 'Feature ' + mStep;
            document.getElementById('m-step-sub').textContent   = mStep + ' of ' + TOTAL;
            document.getElementById('m-progress').style.width   = (mStep / TOTAL * 100).toFixed(2) + '%';
            document.getElementById('m-prev-btn').disabled      = mStep === 1;
            document.getElementById('m-next-btn').disabled      = mStep === TOTAL;
            document.getElementById('m-prev-bot').disabled      = mStep === 1;
            document.getElementById('m-next-bot').disabled      = mStep === TOTAL;
            buildDots('m-dots', mStep, mStepper);
        }
        buildDots('m-dots', 1, mStepper);
        document.getElementById('m-step-sub').textContent = '1 of ' + TOTAL;
    </script>
    @endif

    {{-- ── Edit-form slide preview + stepper ── --}}
    @if($banner)
    <script>
        function previewSlide(input, i) {
            if (!input.files || !input.files[0]) return;
            const reader = new FileReader();
            reader.onload = function (e) {
                const slot    = document.getElementById('slot_'     + i);
                const preview = document.getElementById('preview_'  + i);
                const icon    = document.getElementById('ph_icon_'  + i);
                const lbl     = document.getElementById('ph_label_' + i);
                preview.src           = e.target.result;
                preview.style.display = '';
                if (icon) icon.style.display = 'none';
                if (lbl)  lbl.style.display  = 'none';
                slot.classList.add('has-img', 'pending');
            };
            reader.readAsDataURL(input.files[0]);
        }

        /* ── Edit feature stepper ── */
        const ETOTAL = 7;
        var eStep = 1;

        function buildEDots(step) {
            const c = document.getElementById('e-dots');
            c.innerHTML = '';
            for (let i = 1; i <= ETOTAL; i++) {
                const d = document.createElement('div');
                d.className = 'feat-dot' + (i === step ? ' active' : '');
                d.title = 'Feature ' + i;
                d.onclick = (function(n){ return function(){ eStepper(null, n); }; })(i);
                c.appendChild(d);
            }
        }

        function eStepper(dir, jumpTo) {
            const next = jumpTo !== undefined ? jumpTo : eStep + dir;
            if (next < 1 || next > ETOTAL) return;
            document.getElementById('e-feat-' + eStep).classList.remove('active');
            eStep = next;
            document.getElementById('e-feat-' + eStep).classList.add('active');
            document.getElementById('e-step-label').textContent = 'Feature ' + eStep;
            document.getElementById('e-step-sub').textContent   = eStep + ' of ' + ETOTAL;
            document.getElementById('e-progress').style.width   = (eStep / ETOTAL * 100).toFixed(2) + '%';
            document.getElementById('e-prev-btn').disabled      = eStep === 1;
            document.getElementById('e-next-btn').disabled      = eStep === ETOTAL;
            document.getElementById('e-prev-bot').disabled      = eStep === 1;
            document.getElementById('e-next-bot').disabled      = eStep === ETOTAL;
            buildEDots(eStep);
        }
        buildEDots(1);
        document.getElementById('e-step-sub').textContent = '1 of ' + ETOTAL;
    </script>
    @endif

</x-app-layout>