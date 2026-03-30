<x-app-layout>
   <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Theme') }}
        </h2>
    </x-slot>
<style>
    .bv-page-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }
    .bv-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 0.9rem;
        border-radius: 6px;
        border: 1.5px solid #E5DDD5;
        background: var(--white);
        font-family: var(--font-body);
        font-size: 0.78rem;
        font-weight: 500;
        color: var(--warm-grey);
        text-decoration: none;
        transition: border-color 0.2s, color 0.2s;
        cursor: pointer;
    }
    .bv-back-btn svg { width: 13px; height: 13px; }
    .bv-back-btn:hover { border-color: var(--gold); color: var(--charcoal); }

    .bv-page-title {
        font-family: var(--font-display);
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--charcoal);
        line-height: 1.1;
    }
    .bv-page-title em { font-style: italic; color: var(--gold-dark); }
    .bv-page-sub {
        font-size: 0.8rem;
        color: var(--warm-grey);
        margin-top: 0.3rem;
        letter-spacing: 0.02em;
    }

    /* ── Form card ── */
    .bv-form-layout {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 1.5rem;
        align-items: start;
    }
    @media (max-width: 860px) {
        .bv-form-layout { grid-template-columns: 1fr; }
    }

    .bv-card {
        background: var(--white);
        border-radius: 12px;
        border: 1px solid #F0EBE5;
        box-shadow: 0 1px 4px rgba(30,27,24,0.05);
        overflow: hidden;
    }
    .bv-card-header {
        padding: 1.2rem 1.6rem;
        border-bottom: 1px solid #F7F3EF;
        display: flex;
        align-items: center;
        gap: 0.65rem;
    }
    .bv-card-header-icon {
        width: 32px; height: 32px;
        border-radius: 8px;
        background: rgba(201,168,76,0.1);
        display: flex; align-items: center; justify-content: center;
        color: var(--gold-dark);
        flex-shrink: 0;
    }
    .bv-card-header-icon svg { width: 16px; height: 16px; }
    .bv-card-header-title {
        font-family: var(--font-display);
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--charcoal);
    }
    .bv-card-header-sub {
        font-size: 0.72rem;
        color: var(--warm-grey);
        margin-top: 0.1rem;
    }
    .bv-card-body { padding: 1.6rem; }

    /* ── Form fields ── */
    .bv-field { margin-bottom: 1.25rem; }
    .bv-field:last-child { margin-bottom: 0; }

    .bv-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--warm-grey);
        margin-bottom: 0.45rem;
    }
    .bv-label-required {
        font-size: 0.65rem;
        color: var(--gold-dark);
        letter-spacing: 0.04em;
        font-weight: 500;
        text-transform: none;
    }

    .bv-input,
    .bv-textarea {
        width: 100%;
        padding: 0.7rem 0.95rem;
        background: var(--ivory);
        border: 1.5px solid #E5DDD5;
        border-radius: 8px;
        font-family: var(--font-body);
        font-size: 0.85rem;
        color: var(--charcoal);
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }
    .bv-input:focus,
    .bv-textarea:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(201,168,76,0.12);
        background: var(--white);
    }
    .bv-input::placeholder,
    .bv-textarea::placeholder { color: #C0B8B0; }
    .bv-textarea { resize: vertical; min-height: 110px; }

    .bv-input-hint {
        font-size: 0.72rem;
        color: #C0B8B0;
        margin-top: 0.35rem;
    }

    /* Validation error */
    .bv-input.error { border-color: #C0392B; }
    .bv-error-msg {
        font-size: 0.72rem;
        color: #C0392B;
        margin-top: 0.35rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    .bv-error-msg svg { width: 11px; height: 11px; flex-shrink: 0; }

    /* ── Form footer actions ── */
    .bv-form-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        padding: 1.1rem 1.6rem;
        border-top: 1px solid #F7F3EF;
        flex-wrap: wrap;
    }
    .bv-form-actions-right {
        display: flex;
        align-items: center;
        gap: 0.65rem;
    }

    .bv-btn-cancel {
        padding: 0.62rem 1.2rem;
        border-radius: 6px;
        border: 1.5px solid #E5DDD5;
        background: var(--white);
        font-family: var(--font-body);
        font-size: 0.82rem;
        font-weight: 500;
        color: var(--warm-grey);
        cursor: pointer;
        text-decoration: none;
        display: inline-flex; align-items: center; gap: 0.4rem;
        transition: border-color 0.2s, color 0.2s;
    }
    .bv-btn-cancel:hover { border-color: var(--gold); color: var(--charcoal); }
    .bv-btn-cancel svg { width: 13px; height: 13px; }

    .bv-btn-save {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.62rem 1.5rem;
        border-radius: 6px;
        border: none;
        background: var(--charcoal);
        font-family: var(--font-body);
        font-size: 0.82rem;
        font-weight: 500;
        letter-spacing: 0.03em;
        color: var(--white);
        cursor: pointer;
        transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
    }
    .bv-btn-save svg { width: 14px; height: 14px; }
    .bv-btn-save:hover {
        background: var(--gold-dark);
        box-shadow: 0 4px 12px rgba(201,168,76,0.2);
        transform: translateY(-1px);
    }

    /* ── Danger zone card ── */
    .bv-danger-card {
        background: var(--white);
        border-radius: 12px;
        border: 1px solid #FADBD8;
        box-shadow: 0 1px 4px rgba(30,27,24,0.04);
        overflow: hidden;
    }
    .bv-danger-header {
        padding: 1rem 1.4rem;
        border-bottom: 1px solid #FADBD8;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }
    .bv-danger-header svg { width: 15px; height: 15px; color: #C0392B; flex-shrink: 0; }
    .bv-danger-header span {
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        color: #C0392B;
    }
    .bv-danger-body { padding: 1.2rem 1.4rem; }
    .bv-danger-desc {
        font-size: 0.8rem;
        color: var(--warm-grey);
        line-height: 1.6;
        margin-bottom: 1rem;
    }
    .bv-btn-delete {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.2rem;
        border-radius: 6px;
        border: 1.5px solid #C0392B;
        background: var(--white);
        font-family: var(--font-body);
        font-size: 0.8rem;
        font-weight: 500;
        color: #C0392B;
        cursor: pointer;
        width: 100%;
        justify-content: center;
        transition: background 0.2s, color 0.2s;
    }
    .bv-btn-delete svg { width: 14px; height: 14px; }
    .bv-btn-delete:hover { background: #C0392B; color: var(--white); }

    /* ── Meta card ── */
    .bv-meta-card {
        background: var(--white);
        border-radius: 12px;
        border: 1px solid #F0EBE5;
        box-shadow: 0 1px 4px rgba(30,27,24,0.05);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    .bv-meta-header {
        padding: 0.9rem 1.4rem;
        border-bottom: 1px solid #F7F3EF;
    }
    .bv-meta-header span {
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--warm-grey);
    }
    .bv-meta-body { padding: 1rem 1.4rem; }
    .bv-meta-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.45rem 0;
        border-bottom: 1px solid #F7F3EF;
        font-size: 0.78rem;
    }
    .bv-meta-row:last-child { border-bottom: none; }
    .bv-meta-key { color: var(--warm-grey); }
    .bv-meta-val { color: var(--charcoal); font-weight: 500; }
    .bv-meta-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.18rem 0.6rem;
        border-radius: 999px;
        background: rgba(201,168,76,0.1);
        color: var(--gold-dark);
        font-size: 0.68rem;
        font-weight: 600;
    }
    .bv-meta-badge::before {
        content: '';
        width: 5px; height: 5px;
        border-radius: 50%;
        background: var(--gold);
        display: inline-block;
    }

    /* Success alert */
    .bv-alert-success {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        background: #F0FDF4;
        border: 1px solid #A7F3D0;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 0.82rem;
        color: #065F46;
        margin-bottom: 1.5rem;
    }
    .bv-alert-success svg { width: 16px; height: 16px; color: #10B981; flex-shrink: 0; }
</style>

<div class="page-content">

    {{-- Page header --}}
    <div class="bv-page-header">
        <a href="{{ route('admin.themes.list') }}" class="bv-back-btn">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M10 3L5 8l5 5"/>
            </svg>
            Back
        </a>
        <div>
            <h1 class="bv-page-title">Edit <em>Theme</em></h1>
            <p class="bv-page-sub">Update theme details for {{ $theme->name }}</p>
        </div>
    </div>

    {{-- Success message --}}
    @if(session('success'))
    <div class="bv-alert-success">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M5 10l4 4 6-6"/>
            <circle cx="10" cy="10" r="8"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="bv-form-layout">

        {{-- ── LEFT: Main form ── --}}
        <div>
            <form method="POST" action="{{ route('admin.themes.update', $theme->id) }}">
                @csrf
                @method('PUT')

                <div class="bv-card">
                    <div class="bv-card-header">
                        <div class="bv-card-header-icon">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M14.5 3.5l2 2L7 15H5v-2L14.5 3.5z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="bv-card-header-title">Theme Details</div>
                            <div class="bv-card-header-sub">Basic information about this event theme</div>
                        </div>
                    </div>

                    <div class="bv-card-body">

                        {{-- Name --}}
                        <div class="bv-field">
                            <label class="bv-label" for="themeName">
                                Theme Name
                                <span class="bv-label-required">Required</span>
                            </label>
                            <input
                                id="themeName"
                                name="name"
                                type="text"
                                class="bv-input @error('name') error @enderror"
                                value="{{ old('name', $theme->name) }}"
                                placeholder="e.g. Garden Wedding, Corporate Gala…"
                                required
                            >
                            @error('name')
                                <div class="bv-error-msg">
                                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="6" cy="6" r="5"/>
                                        <path d="M6 4v2.5M6 8.5v.5"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                            <p class="bv-input-hint">Keep it short and descriptive — this shows on event listing pages.</p>
                        </div>

                        {{-- Description --}}
                        <div class="bv-field">
                            <label class="bv-label" for="themeDesc">
                                Description
                                <span class="bv-label-required" style="color:var(--warm-grey)">Optional</span>
                            </label>
                            <textarea
                                id="themeDesc"
                                name="description"
                                class="bv-textarea @error('description') error @enderror"
                                placeholder="Briefly describe this theme — mood, style, typical décor…"
                            >{{ old('description', $theme->description) }}</textarea>
                            @error('description')
                                <div class="bv-error-msg">
                                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="6" cy="6" r="5"/>
                                        <path d="M6 4v2.5M6 8.5v.5"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                            <p class="bv-input-hint">Max 300 characters recommended.</p>
                        </div>

                    </div>

                    <div class="bv-form-actions">
                        <span style="font-size:0.72rem;color:#C0B8B0;">
                            Last updated: {{ $theme->updated_at->diffForHumans() }}
                        </span>
                        <div class="bv-form-actions-right">
                            <a href="{{ route('admin.themes.list') }}" class="bv-btn-cancel">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4l8 8M12 4L4 12"/>
                                </svg>
                                Cancel
                            </a>
                            <button type="submit" class="bv-btn-save">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 8l4 4 6-6"/>
                                </svg>
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        {{-- ── RIGHT: Meta + Danger zone ── --}}
        <div>

            {{-- Meta info --}}
            <div class="bv-meta-card">
                <div class="bv-meta-header">
                    <span>Theme Info</span>
                </div>
                <div class="bv-meta-body">
                    <div class="bv-meta-row">
                        <span class="bv-meta-key">Status</span>
                        <span class="bv-meta-badge">Active</span>
                    </div>
                    <div class="bv-meta-row">
                        <span class="bv-meta-key">Theme ID</span>
                        <span class="bv-meta-val">#{{ $theme->id }}</span>
                    </div>
                    <div class="bv-meta-row">
                        <span class="bv-meta-key">Created</span>
                        <span class="bv-meta-val">{{ $theme->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="bv-meta-row">
                        <span class="bv-meta-key">Last Modified</span>
                        <span class="bv-meta-val">{{ $theme->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            {{-- Danger zone --}}
            <div class="bv-danger-card">
                <div class="bv-danger-header">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M10 3l8 14H2L10 3zM10 9v4M10 15v.5"/>
                    </svg>
                    <span>Danger Zone</span>
                </div>
                <div class="bv-danger-body">
                    <p class="bv-danger-desc">
                        Permanently deletes <strong>{{ $theme->name }}</strong> and removes it from all associated events. This action cannot be undone.
                    </p>
                    <form method="POST" action="{{ route('admin.themes.destroy', $theme->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bv-btn-delete"
                            onclick="return confirm('Delete {{ addslashes($theme->name) }}? This cannot be undone.')">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M3 4h10M6 4V3h4v1M5 4v8a1 1 0 001 1h4a1 1 0 001-1V4"/>
                            </svg>
                            Delete this Theme
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
</x-app-layout>