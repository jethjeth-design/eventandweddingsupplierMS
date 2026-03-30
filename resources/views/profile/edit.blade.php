 <style>
    /* ── Page header ── */
    .bv-page-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .bv-btn-back{
        display:inline-flex;
        align-items:center;
        gap:0.4rem;
        padding:0.58rem 1.1rem;
        border-radius:6px;
        border:1.5px solid #E5DDD5;
        background:var(--white);
        font-family:var(--font-body);
        font-size:0.8rem;
        font-weight:500;
        color:var(--warm-grey);
        text-decoration:none;
        transition:border-color 0.2s,color 0.2s;
    }
    .bv-btn-back svg{width:12px;height:12px;}
    .bv-btn-back:hover{border-color:var(--gold);color:var(--charcoal);}

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
    }

    /* ── Two-column layout ── */
    .bv-profile-layout {
        display: grid;
        grid-template-columns: 240px 1fr;
        gap: 1.5rem;
        align-items: start;
    }
    @media (max-width: 860px) {
        .bv-profile-layout { grid-template-columns: 1fr; }
        .bv-profile-sidebar { display: flex; flex-direction: row; gap: 0.5rem; flex-wrap: wrap; }
    }

    /* ── Sidebar nav tabs ── */
    .bv-profile-sidebar {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }
    .bv-tab {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        padding: 0.7rem 1rem;
        border-radius: 8px;
        font-size: 0.83rem;
        font-weight: 400;
        color: var(--warm-grey);
        cursor: pointer;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        font-family: var(--font-body);
        transition: background 0.15s, color 0.15s;
    }
    .bv-tab svg { width: 16px; height: 16px; flex-shrink: 0; }
    .bv-tab:hover { background: rgba(201,168,76,0.07); color: var(--charcoal); }
    .bv-tab.active {
        background: rgba(201,168,76,0.1);
        color: var(--gold-dark);
        font-weight: 600;
        position: relative;
    }
    .bv-tab.active::before {
        content: '';
        position: absolute;
        left: 0; top: 20%; bottom: 20%;
        width: 3px;
        background: var(--gold);
        border-radius: 0 2px 2px 0;
    }

    /* ── Cards ── */
    .bv-card {
        background: var(--white);
        border-radius: 12px;
        border: 1px solid #F0EBE5;
        box-shadow: 0 1px 4px rgba(30,27,24,0.05);
        overflow: hidden;
        display: none;
    }
    .bv-card.active { display: block; }

    .bv-card-header {
        padding: 1.25rem 1.75rem;
        border-bottom: 1px solid #F7F3EF;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .bv-card-icon {
        width: 36px; height: 36px;
        border-radius: 9px;
        background: rgba(201,168,76,0.1);
        display: flex; align-items: center; justify-content: center;
        color: var(--gold-dark);
        flex-shrink: 0;
    }
    .bv-card-icon svg { width: 17px; height: 17px; }
    .bv-card-title {
        font-family: var(--font-display);
        font-size: 1rem;
        font-weight: 700;
        color: var(--charcoal);
    }
    .bv-card-desc { font-size: 0.75rem; color: var(--warm-grey); margin-top: 0.1rem; }
    .bv-card-body { padding: 1.75rem; }

    /* ── Form fields ── */
    .bv-field { margin-bottom: 1.25rem; }
    .bv-field:last-child { margin-bottom: 0; }
    .bv-field-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    @media (max-width: 560px) { .bv-field-row { grid-template-columns: 1fr; } }

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
    .bv-label-opt {
        font-size: 0.65rem;
        color: #C0B8B0;
        letter-spacing: 0.03em;
        font-weight: 400;
        text-transform: none;
    }
    .bv-input {
        width: 100%;
        padding: 0.68rem 0.95rem;
        background: var(--ivory);
        border: 1.5px solid #E5DDD5;
        border-radius: 8px;
        font-family: var(--font-body);
        font-size: 0.85rem;
        color: var(--charcoal);
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }
    .bv-input:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(201,168,76,0.12);
        background: var(--white);
    }
    .bv-input::placeholder { color: #C0B8B0; }
    .bv-input:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    .bv-input-hint {
        font-size: 0.72rem;
        color: #C0B8B0;
        margin-top: 0.35rem;
    }
    .bv-error {
        font-size: 0.72rem;
        color: #C0392B;
        margin-top: 0.35rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* ── Form footer ── */
    .bv-card-footer {
        padding: 1rem 1.75rem;
        border-top: 1px solid #F7F3EF;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.75rem;
    }
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

    /* ── Avatar section ── */
    .bv-avatar-row {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        padding: 1.5rem 1.75rem;
        border-bottom: 1px solid #F7F3EF;
    }
    .bv-avatar-circle {
        width: 64px; height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--gold), var(--gold-dark));
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-display);
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--white);
        flex-shrink: 0;
        border: 3px solid rgba(201,168,76,0.2);
    }
    .bv-avatar-info { flex: 1; }
    .bv-avatar-name {
        font-family: var(--font-display);
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--charcoal);
    }
    .bv-avatar-email { font-size: 0.78rem; color: var(--warm-grey); margin-top: 0.15rem; }
    .bv-avatar-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.2rem 0.65rem;
        border-radius: 999px;
        background: rgba(201,168,76,0.1);
        color: var(--gold-dark);
        font-size: 0.68rem;
        font-weight: 600;
        margin-top: 0.35rem;
    }
    .bv-avatar-badge::before {
        content: '';
        width: 5px; height: 5px;
        border-radius: 50%;
        background: var(--gold);
    }

    /* Success flash */
    .bv-alert {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        font-size: 0.82rem;
        margin-bottom: 1.25rem;
    }
    .bv-alert svg { width: 15px; height: 15px; flex-shrink: 0; }
    .bv-alert-success { background: #F0FDF4; border: 1px solid #A7F3D0; color: #065F46; }
    .bv-alert-success svg { color: #10B981; }

    /* ── Danger zone ── */
    .bv-danger-banner {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        background: #FFF5F5;
        border: 1px solid #FADBD8;
        border-radius: 10px;
        padding: 1.2rem 1.4rem;
        margin-bottom: 1.5rem;
    }
    .bv-danger-banner svg { width: 20px; height: 20px; color: #C0392B; flex-shrink: 0; margin-top: 0.1rem; }
    .bv-danger-banner-title { font-size: 0.85rem; font-weight: 600; color: #922B21; margin-bottom: 0.3rem; }
    .bv-danger-banner-desc { font-size: 0.78rem; color: #C0392B; line-height: 1.6; }

    .bv-btn-danger {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.62rem 1.4rem;
        border-radius: 6px;
        border: 1.5px solid #C0392B;
        background: var(--white);
        font-family: var(--font-body);
        font-size: 0.82rem;
        font-weight: 500;
        color: #C0392B;
        cursor: pointer;
        transition: background 0.2s, color 0.2s;
    }
    .bv-btn-danger svg { width: 14px; height: 14px; }
    .bv-btn-danger:hover { background: #C0392B; color: var(--white); }

    /* Password strength meter */
    .bv-strength { margin-top: 0.5rem; }
    .bv-strength-bar {
        display: flex; gap: 4px; margin-bottom: 0.3rem;
    }
    .bv-strength-seg {
        flex: 1; height: 3px; border-radius: 2px;
        background: #E5DDD5;
        transition: background 0.3s;
    }
    .bv-strength-label { font-size: 0.68rem; color: #C0B8B0; }

    /* Confirm delete modal */
    .bv-modal-backdrop {
        position: fixed; inset: 0;
        background: rgba(30,27,24,0.5);
        backdrop-filter: blur(4px);
        z-index: 500;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }
    .bv-modal-backdrop.open { display: flex; animation: bvFade 0.2s ease; }
    .bv-modal {
        background: var(--white);
        border-radius: 14px;
        width: 100%; max-width: 420px;
        box-shadow: 0 24px 64px rgba(30,27,24,0.2);
        animation: bvSlide 0.25s ease;
        overflow: hidden;
    }
    .bv-modal-head {
        padding: 1.3rem 1.5rem 1.1rem;
        border-bottom: 1px solid #F0EBE5;
        display: flex; align-items: center; gap: 0.65rem;
    }
    .bv-modal-head-icon {
        width: 32px; height: 32px; border-radius: 8px;
        background: #FFF5F5; display: flex; align-items: center; justify-content: center;
    }
    .bv-modal-head-icon svg { width: 15px; height: 15px; color: #C0392B; }
    .bv-modal-head-title { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--charcoal); }
    .bv-modal-body { padding: 1.3rem 1.5rem; font-size: 0.83rem; color: var(--warm-grey); line-height: 1.65; }
    .bv-modal-footer {
        padding: 0.9rem 1.5rem 1.2rem;
        display: flex; gap: 0.65rem; justify-content: flex-end;
    }
    .bv-btn-ghost {
        padding: 0.6rem 1.1rem; border-radius: 6px;
        border: 1.5px solid #E5DDD5; background: var(--white);
        font-family: var(--font-body); font-size: 0.82rem; font-weight: 500;
        color: var(--warm-grey); cursor: pointer;
        transition: border-color 0.2s, color 0.2s;
    }
    .bv-btn-ghost:hover { border-color: var(--gold); color: var(--charcoal); }

    @keyframes bvFade { from { opacity: 0; } to { opacity: 1; } }
    @keyframes bvSlide { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: translateY(0); } }
</style>

@if(auth()->user()->isAdmin())
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>   
    <div class="page-content">

        {{-- Page header --}}
        <div class="bv-page-header">
            <div>
                <h1 class="bv-page-title">My <em>Profile</em></h1>
                <p class="bv-page-sub">Manage your account information and security settings</p>
            </div>
        </div>

        <div class="bv-profile-layout">

            {{-- ── LEFT: Tab sidebar ── --}}
            <div class="bv-profile-sidebar">
                <button class="bv-tab active" onclick="switchTab('info', this)">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="7" r="4"/>
                        <path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    Profile Info
                </button>
                <button class="bv-tab" onclick="switchTab('password', this)">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="5" y="9" width="10" height="8" rx="2"/>
                        <path d="M7 9V6a3 3 0 016 0v3"/>
                        <circle cx="10" cy="13" r="1"/>
                    </svg>
                    Password
                </button>
                <button class="bv-tab" onclick="switchTab('danger', this)">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M10 3l8 14H2L10 3zM10 9v4M10 15v.5"/>
                    </svg>
                    Danger Zone
                </button>
            </div>

            {{-- ── RIGHT: Tab panels ── --}}
            <div>

                {{-- ── TAB 1: Profile Info ── --}}
                <div id="tab-info" class="bv-card active">

                    {{-- Avatar row --}}
                    <div class="bv-avatar-row">
                        <div class="bv-avatar-circle">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="bv-avatar-info">
                            <div class="bv-avatar-name">{{ Auth::user()->name }}</div>
                            <div class="bv-avatar-email">{{ Auth::user()->email }}</div>
                            <div class="bv-avatar-badge">Active Account</div>
                        </div>
                    </div>

                    <div class="bv-card-header">
                        <div class="bv-card-icon">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M14.5 3.5l2 2L7 15H5v-2L14.5 3.5z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="bv-card-title">Personal Information</div>
                            <div class="bv-card-desc">Update your name, email and public profile</div>
                        </div>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="bv-card-body">

                            @if(session('status') === 'profile-updated')
                            <div class="bv-alert bv-alert-success">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/>
                                </svg>
                                Profile updated successfully.
                            </div>
                            @endif

                            <div class="bv-field">
                                <label class="bv-label" for="name">
                                    Full Name
                                    <span class="bv-label-opt">Required</span>
                                </label>
                                <input id="name" name="name" type="text"
                                    class="bv-input"
                                    value="{{ old('name', $user->name) }}"
                                    required autocomplete="name">
                                @error('name')
                                    <div class="bv-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="bv-field">
                                <label class="bv-label" for="email">
                                    Email Address
                                    <span class="bv-label-opt">Required</span>
                                </label>
                                <input id="email" name="email" type="email"
                                    class="bv-input"
                                    value="{{ old('email', $user->email) }}"
                                    required autocomplete="username">
                                @error('email')
                                    <div class="bv-error">{{ $message }}</div>
                                @enderror
                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <p class="bv-input-hint" style="color:#B7770D;">
                                    Your email is unverified.
                                    <a href="{{ route('verification.send') }}" style="color:var(--gold-dark);text-decoration:underline;">Resend verification</a>
                                </p>
                                @endif
                            </div>

                        </div>

                        <div class="bv-card-footer">
                            <button type="submit" class="bv-btn-save">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 8l4 4 6-6"/>
                                </svg>
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                {{-- ── TAB 2: Password ── --}}
                <div id="tab-password" class="bv-card">
                    <div class="bv-card-header">
                        <div class="bv-card-icon">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <rect x="5" y="9" width="10" height="8" rx="2"/>
                                <path d="M7 9V6a3 3 0 016 0v3"/>
                                <circle cx="10" cy="13" r="1"/>
                            </svg>
                        </div>
                        <div>
                            <div class="bv-card-title">Update Password</div>
                            <div class="bv-card-desc">Use a long, random password to stay secure</div>
                        </div>
                    </div>

                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="bv-card-body">

                            @if(session('status') === 'password-updated')
                            <div class="bv-alert bv-alert-success">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/>
                                </svg>
                                Password updated successfully.
                            </div>
                            @endif

                            <div class="bv-field">
                                <label class="bv-label" for="current_password">Current Password</label>
                                <input id="current_password" name="current_password"
                                    type="password" class="bv-input"
                                    autocomplete="current-password"
                                    placeholder="Enter current password">
                                @error('current_password')
                                    <div class="bv-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="bv-field">
                                <label class="bv-label" for="password">New Password</label>
                                <input id="password" name="password"
                                    type="password" class="bv-input"
                                    autocomplete="new-password"
                                    placeholder="Enter new password"
                                    oninput="checkStrength(this.value)">
                                <div class="bv-strength">
                                    <div class="bv-strength-bar">
                                        <div class="bv-strength-seg" id="seg1"></div>
                                        <div class="bv-strength-seg" id="seg2"></div>
                                        <div class="bv-strength-seg" id="seg3"></div>
                                        <div class="bv-strength-seg" id="seg4"></div>
                                    </div>
                                    <div class="bv-strength-label" id="strengthLabel">Enter a password</div>
                                </div>
                                @error('password')
                                    <div class="bv-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="bv-field">
                                <label class="bv-label" for="password_confirmation">Confirm New Password</label>
                                <input id="password_confirmation" name="password_confirmation"
                                    type="password" class="bv-input"
                                    autocomplete="new-password"
                                    placeholder="Repeat new password">
                                @error('password_confirmation')
                                    <div class="bv-error">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="bv-card-footer">
                            <button type="submit" class="bv-btn-save">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 8l4 4 6-6"/>
                                </svg>
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>

                {{-- ── TAB 3: Danger Zone ── --}}
                <div id="tab-danger" class="bv-card">
                    <div class="bv-card-header">
                        <div class="bv-card-icon" style="background:#FFF5F5; color:#C0392B;">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M10 3l8 14H2L10 3zM10 9v4M10 15v.5"/>
                            </svg>
                        </div>
                        <div>
                            <div class="bv-card-title">Danger Zone</div>
                            <div class="bv-card-desc">Irreversible actions — proceed with caution</div>
                        </div>
                    </div>

                    <div class="bv-card-body">
                        <div class="bv-danger-banner">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M10 3l8 14H2L10 3zM10 9v4M10 15v.5"/>
                            </svg>
                            <div>
                                <div class="bv-danger-banner-title">Delete Account</div>
                                <div class="bv-danger-banner-desc">
                                    Once your account is deleted, all of its resources and data will be permanently deleted.
                                    Before deleting your account, please download any data or information that you wish to retain.
                                </div>
                            </div>
                        </div>

                        <button type="button" class="bv-btn-danger" onclick="openDeleteModal()">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M3 4h10M6 4V3h4v1M5 4v8a1 1 0 001 1h4a1 1 0 001-1V4"/>
                            </svg>
                            Delete My Account
                        </button>
                    </div>
                </div>

            </div>{{-- end right --}}
        </div>{{-- end layout --}}
    </div>

    {{-- ── Delete Confirm Modal ── --}}
    <div id="deleteModal" class="bv-modal-backdrop">
        <div class="bv-modal">
            <div class="bv-modal-head">
                <div class="bv-modal-head-icon">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M3 4h10M6 4V3h4v1M5 4v8a1 1 0 001 1h4a1 1 0 001-1V4"/>
                    </svg>
                </div>
                <span class="bv-modal-head-title">Delete Account</span>
            </div>

            <div class="bv-modal-body">
                <p style="margin-bottom:1rem;">Are you sure you want to delete your account? This action <strong>cannot be undone</strong> — all your data will be permanently removed.</p>
                <label class="bv-label" for="delete_password" style="margin-bottom:0.45rem;">Confirm your password</label>
                <form id="deleteForm" method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <input id="delete_password" name="password"
                        type="password" class="bv-input"
                        placeholder="Enter your password to confirm">
                    @error('password', 'userDeletion')
                        <div class="bv-error">{{ $message }}</div>
                    @enderror
                </form>
            </div>

            <div class="bv-modal-footer">
                <button type="button" class="bv-btn-ghost" onclick="closeDeleteModal()">Cancel</button>
                <button type="submit" form="deleteForm" class="bv-btn-danger">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M3 4h10M6 4V3h4v1M5 4v8a1 1 0 001 1h4a1 1 0 001-1V4"/>
                    </svg>
                    Yes, Delete Account
                </button>
            </div>
        </div>
    </div>


</x-app-layout>
@elseif(auth()->user()->isSupplier())
    <x-supplier-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="page-content">

        {{-- Page header --}}
        <div class="bv-page-header">
            <div>
                <h1 class="bv-page-title">Account <em>Settings</em></h1>
                <p class="bv-page-sub">Manage your login credentials and account security</p>
            </div>
            <a href="{{ route('supplier.supplierprofile') }}" class="bv-btn-back">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 2L4 7l5 5"/></svg>
                Back to Profile
            </a>
        </div>


        <div class="bv-profile-layout">

            {{-- ── LEFT: Tab sidebar ── --}}
            <div class="bv-profile-sidebar">
                
                <button class="bv-tab active" onclick="switchTab('info', this)">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="7" r="4"/>
                        <path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    Profile Info
                </button>
                <button class="bv-tab" onclick="switchTab('password', this)">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="5" y="9" width="10" height="8" rx="2"/>
                        <path d="M7 9V6a3 3 0 016 0v3"/>
                        <circle cx="10" cy="13" r="1"/>
                    </svg>
                    Password
                </button>
                <button class="bv-tab" onclick="switchTab('danger', this)">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M10 3l8 14H2L10 3zM10 9v4M10 15v.5"/>
                    </svg>
                    Danger Zone
                </button>
            </div>

            
            {{-- ── RIGHT: Tab panels ── --}}
            <div>

                {{-- ── TAB 1: Profile Info ── --}}
                <div id="tab-info" class="bv-card active">

                    {{-- Avatar row --}}
                    <div class="bv-avatar-row">
                        <div class="bv-avatar-circle">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="bv-avatar-info">
                            <div class="bv-avatar-name">{{ Auth::user()->name }}</div>
                            <div class="bv-avatar-email">{{ Auth::user()->email }}</div>
                            <div class="bv-avatar-badge">Active Account</div>
                        </div>
                    </div>

                    <div class="bv-card-header">
                        <div class="bv-card-icon">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M14.5 3.5l2 2L7 15H5v-2L14.5 3.5z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="bv-card-title">Personal Information</div>
                            <div class="bv-card-desc">Update your name, email and public profile</div>
                        </div>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="bv-card-body">

                            @if(session('status') === 'profile-updated')
                            <div class="bv-alert bv-alert-success">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/>
                                </svg>
                                Profile updated successfully.
                            </div>
                            @endif

                            <div class="bv-field">
                                <label class="bv-label" for="name">
                                    Full Name
                                    <span class="bv-label-opt">Required</span>
                                </label>
                                <input id="name" name="name" type="text"
                                    class="bv-input"
                                    value="{{ old('name', $user->name) }}"
                                    required autocomplete="name">
                                @error('name')
                                    <div class="bv-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="bv-field">
                                <label class="bv-label" for="email">
                                    Email Address
                                    <span class="bv-label-opt">Required</span>
                                </label>
                                <input id="email" name="email" type="email"
                                    class="bv-input"
                                    value="{{ old('email', $user->email) }}"
                                    required autocomplete="username">
                                @error('email')
                                    <div class="bv-error">{{ $message }}</div>
                                @enderror
                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <p class="bv-input-hint" style="color:#B7770D;">
                                    Your email is unverified.
                                    <a href="{{ route('verification.send') }}" style="color:var(--gold-dark);text-decoration:underline;">Resend verification</a>
                                </p>
                                @endif
                            </div>

                        </div>

                        <div class="bv-card-footer">
                            <button type="submit" class="bv-btn-save">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 8l4 4 6-6"/>
                                </svg>
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                {{-- ── TAB 2: Password ── --}}
                <div id="tab-password" class="bv-card">
                    <div class="bv-card-header">
                        <div class="bv-card-icon">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <rect x="5" y="9" width="10" height="8" rx="2"/>
                                <path d="M7 9V6a3 3 0 016 0v3"/>
                                <circle cx="10" cy="13" r="1"/>
                            </svg>
                        </div>
                        <div>
                            <div class="bv-card-title">Update Password</div>
                            <div class="bv-card-desc">Use a long, random password to stay secure</div>
                        </div>
                    </div>

                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="bv-card-body">

                            @if(session('status') === 'password-updated')
                            <div class="bv-alert bv-alert-success">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/>
                                </svg>
                                Password updated successfully.
                            </div>
                            @endif

                            <div class="bv-field">
                                <label class="bv-label" for="current_password">Current Password</label>
                                <input id="current_password" name="current_password"
                                    type="password" class="bv-input"
                                    autocomplete="current-password"
                                    placeholder="Enter current password">
                                @error('current_password')
                                    <div class="bv-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="bv-field">
                                <label class="bv-label" for="password">New Password</label>
                                <input id="password" name="password"
                                    type="password" class="bv-input"
                                    autocomplete="new-password"
                                    placeholder="Enter new password"
                                    oninput="checkStrength(this.value)">
                                <div class="bv-strength">
                                    <div class="bv-strength-bar">
                                        <div class="bv-strength-seg" id="seg1"></div>
                                        <div class="bv-strength-seg" id="seg2"></div>
                                        <div class="bv-strength-seg" id="seg3"></div>
                                        <div class="bv-strength-seg" id="seg4"></div>
                                    </div>
                                    <div class="bv-strength-label" id="strengthLabel">Enter a password</div>
                                </div>
                                @error('password')
                                    <div class="bv-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="bv-field">
                                <label class="bv-label" for="password_confirmation">Confirm New Password</label>
                                <input id="password_confirmation" name="password_confirmation"
                                    type="password" class="bv-input"
                                    autocomplete="new-password"
                                    placeholder="Repeat new password">
                                @error('password_confirmation')
                                    <div class="bv-error">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="bv-card-footer">
                            <button type="submit" class="bv-btn-save">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 8l4 4 6-6"/>
                                </svg>
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>

                {{-- ── TAB 3: Danger Zone ── --}}
                <div id="tab-danger" class="bv-card">
                    <div class="bv-card-header">
                        <div class="bv-card-icon" style="background:#FFF5F5; color:#C0392B;">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M10 3l8 14H2L10 3zM10 9v4M10 15v.5"/>
                            </svg>
                        </div>
                        <div>
                            <div class="bv-card-title">Danger Zone</div>
                            <div class="bv-card-desc">Irreversible actions — proceed with caution</div>
                        </div>
                    </div>

                    <div class="bv-card-body">
                        <div class="bv-danger-banner">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M10 3l8 14H2L10 3zM10 9v4M10 15v.5"/>
                            </svg>
                            <div>
                                <div class="bv-danger-banner-title">Delete Account</div>
                                <div class="bv-danger-banner-desc">
                                    Once your account is deleted, all of its resources and data will be permanently deleted.
                                    Before deleting your account, please download any data or information that you wish to retain.
                                </div>
                            </div>
                        </div>

                        <button type="button" class="bv-btn-danger" onclick="openDeleteModal()">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M3 4h10M6 4V3h4v1M5 4v8a1 1 0 001 1h4a1 1 0 001-1V4"/>
                            </svg>
                            Delete My Account
                        </button>
                    </div>
                </div>

            </div>{{-- end right --}}
        </div>{{-- end layout --}}
    </div>

    {{-- ── Delete Confirm Modal ── --}}
    <div id="deleteModal" class="bv-modal-backdrop">
        <div class="bv-modal">
            <div class="bv-modal-head">
                <div class="bv-modal-head-icon">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M3 4h10M6 4V3h4v1M5 4v8a1 1 0 001 1h4a1 1 0 001-1V4"/>
                    </svg>
                </div>
                <span class="bv-modal-head-title">Delete Account</span>
            </div>

            <div class="bv-modal-body">
                <p style="margin-bottom:1rem;">Are you sure you want to delete your account? This action <strong>cannot be undone</strong> — all your data will be permanently removed.</p>
                <label class="bv-label" for="delete_password" style="margin-bottom:0.45rem;">Confirm your password</label>
                <form id="deleteForm" method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <input id="delete_password" name="password"
                        type="password" class="bv-input"
                        placeholder="Enter your password to confirm">
                    @error('password', 'userDeletion')
                        <div class="bv-error">{{ $message }}</div>
                    @enderror
                </form>
            </div>

            <div class="bv-modal-footer">
                <button type="button" class="bv-btn-ghost" onclick="closeDeleteModal()">Cancel</button>
                <button type="submit" form="deleteForm" class="bv-btn-danger">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M3 4h10M6 4V3h4v1M5 4v8a1 1 0 001 1h4a1 1 0 001-1V4"/>
                    </svg>
                    Yes, Delete Account
                </button>
            </div>
        </div>
    </div>
</x-supplier-layout>
@else
    <x-client-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

        <div class="page-content">

        {{-- Page header --}}
        <div class="bv-page-header">
            <div>
                <h1 class="bv-page-title">My <em>Profile</em></h1>
                <p class="bv-page-sub">Manage your account information and security settings</p>
            </div>
        </div>

        <div class="bv-profile-layout">

            {{-- ── LEFT: Tab sidebar ── --}}
            <div class="bv-profile-sidebar">
                <button class="bv-tab active" onclick="switchTab('info', this)">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="10" cy="7" r="4"/>
                        <path d="M2 17c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    Profile Info
                </button>
                <button class="bv-tab" onclick="switchTab('password', this)">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="5" y="9" width="10" height="8" rx="2"/>
                        <path d="M7 9V6a3 3 0 016 0v3"/>
                        <circle cx="10" cy="13" r="1"/>
                    </svg>
                    Password
                </button>
                <button class="bv-tab" onclick="switchTab('danger', this)">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M10 3l8 14H2L10 3zM10 9v4M10 15v.5"/>
                    </svg>
                    Danger Zone
                </button>
            </div>

            {{-- ── RIGHT: Tab panels ── --}}
            <div>

                {{-- ── TAB 1: Profile Info ── --}}
                <div id="tab-info" class="bv-card active">

                    {{-- Avatar row --}}
                    <div class="bv-avatar-row">
                        <div class="bv-avatar-circle">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="bv-avatar-info">
                            <div class="bv-avatar-name">{{ Auth::user()->name }}</div>
                            <div class="bv-avatar-email">{{ Auth::user()->email }}</div>
                            <div class="bv-avatar-badge">Active Account</div>
                        </div>
                    </div>

                    <div class="bv-card-header">
                        <div class="bv-card-icon">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M14.5 3.5l2 2L7 15H5v-2L14.5 3.5z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="bv-card-title">Personal Information</div>
                            <div class="bv-card-desc">Update your name, email and public profile</div>
                        </div>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="bv-card-body">

                            @if(session('status') === 'profile-updated')
                            <div class="bv-alert bv-alert-success">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/>
                                </svg>
                                Profile updated successfully.
                            </div>
                            @endif

                            <div class="bv-field">
                                <label class="bv-label" for="name">
                                    Full Name
                                    <span class="bv-label-opt">Required</span>
                                </label>
                                <input id="name" name="name" type="text"
                                    class="bv-input"
                                    value="{{ old('name', $user->name) }}"
                                    required autocomplete="name">
                                @error('name')
                                    <div class="bv-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="bv-field">
                                <label class="bv-label" for="email">
                                    Email Address
                                    <span class="bv-label-opt">Required</span>
                                </label>
                                <input id="email" name="email" type="email"
                                    class="bv-input"
                                    value="{{ old('email', $user->email) }}"
                                    required autocomplete="username">
                                @error('email')
                                    <div class="bv-error">{{ $message }}</div>
                                @enderror
                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <p class="bv-input-hint" style="color:#B7770D;">
                                    Your email is unverified.
                                    <a href="{{ route('verification.send') }}" style="color:var(--gold-dark);text-decoration:underline;">Resend verification</a>
                                </p>
                                @endif
                            </div>

                        </div>

                        <div class="bv-card-footer">
                            <button type="submit" class="bv-btn-save">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 8l4 4 6-6"/>
                                </svg>
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                {{-- ── TAB 2: Password ── --}}
                <div id="tab-password" class="bv-card">
                    <div class="bv-card-header">
                        <div class="bv-card-icon">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <rect x="5" y="9" width="10" height="8" rx="2"/>
                                <path d="M7 9V6a3 3 0 016 0v3"/>
                                <circle cx="10" cy="13" r="1"/>
                            </svg>
                        </div>
                        <div>
                            <div class="bv-card-title">Update Password</div>
                            <div class="bv-card-desc">Use a long, random password to stay secure</div>
                        </div>
                    </div>

                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="bv-card-body">

                            @if(session('status') === 'password-updated')
                            <div class="bv-alert bv-alert-success">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/>
                                </svg>
                                Password updated successfully.
                            </div>
                            @endif

                            <div class="bv-field">
                                <label class="bv-label" for="current_password">Current Password</label>
                                <input id="current_password" name="current_password"
                                    type="password" class="bv-input"
                                    autocomplete="current-password"
                                    placeholder="Enter current password">
                                @error('current_password')
                                    <div class="bv-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="bv-field">
                                <label class="bv-label" for="password">New Password</label>
                                <input id="password" name="password"
                                    type="password" class="bv-input"
                                    autocomplete="new-password"
                                    placeholder="Enter new password"
                                    oninput="checkStrength(this.value)">
                                <div class="bv-strength">
                                    <div class="bv-strength-bar">
                                        <div class="bv-strength-seg" id="seg1"></div>
                                        <div class="bv-strength-seg" id="seg2"></div>
                                        <div class="bv-strength-seg" id="seg3"></div>
                                        <div class="bv-strength-seg" id="seg4"></div>
                                    </div>
                                    <div class="bv-strength-label" id="strengthLabel">Enter a password</div>
                                </div>
                                @error('password')
                                    <div class="bv-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="bv-field">
                                <label class="bv-label" for="password_confirmation">Confirm New Password</label>
                                <input id="password_confirmation" name="password_confirmation"
                                    type="password" class="bv-input"
                                    autocomplete="new-password"
                                    placeholder="Repeat new password">
                                @error('password_confirmation')
                                    <div class="bv-error">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="bv-card-footer">
                            <button type="submit" class="bv-btn-save">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 8l4 4 6-6"/>
                                </svg>
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>

                {{-- ── TAB 3: Danger Zone ── --}}
                <div id="tab-danger" class="bv-card">
                    <div class="bv-card-header">
                        <div class="bv-card-icon" style="background:#FFF5F5; color:#C0392B;">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M10 3l8 14H2L10 3zM10 9v4M10 15v.5"/>
                            </svg>
                        </div>
                        <div>
                            <div class="bv-card-title">Danger Zone</div>
                            <div class="bv-card-desc">Irreversible actions — proceed with caution</div>
                        </div>
                    </div>

                    <div class="bv-card-body">
                        <div class="bv-danger-banner">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M10 3l8 14H2L10 3zM10 9v4M10 15v.5"/>
                            </svg>
                            <div>
                                <div class="bv-danger-banner-title">Delete Account</div>
                                <div class="bv-danger-banner-desc">
                                    Once your account is deleted, all of its resources and data will be permanently deleted.
                                    Before deleting your account, please download any data or information that you wish to retain.
                                </div>
                            </div>
                        </div>

                        <button type="button" class="bv-btn-danger" onclick="openDeleteModal()">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M3 4h10M6 4V3h4v1M5 4v8a1 1 0 001 1h4a1 1 0 001-1V4"/>
                            </svg>
                            Delete My Account
                        </button>
                    </div>
                </div>

            </div>{{-- end right --}}
        </div>{{-- end layout --}}
    </div>

    {{-- ── Delete Confirm Modal ── --}}
    <div id="deleteModal" class="bv-modal-backdrop">
        <div class="bv-modal">
            <div class="bv-modal-head">
                <div class="bv-modal-head-icon">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M3 4h10M6 4V3h4v1M5 4v8a1 1 0 001 1h4a1 1 0 001-1V4"/>
                    </svg>
                </div>
                <span class="bv-modal-head-title">Delete Account</span>
            </div>

            <div class="bv-modal-body">
                <p style="margin-bottom:1rem;">Are you sure you want to delete your account? This action <strong>cannot be undone</strong> — all your data will be permanently removed.</p>
                <label class="bv-label" for="delete_password" style="margin-bottom:0.45rem;">Confirm your password</label>
                <form id="deleteForm" method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <input id="delete_password" name="password"
                        type="password" class="bv-input"
                        placeholder="Enter your password to confirm">
                    @error('password', 'userDeletion')
                        <div class="bv-error">{{ $message }}</div>
                    @enderror
                </form>
            </div>

            <div class="bv-modal-footer">
                <button type="button" class="bv-btn-ghost" onclick="closeDeleteModal()">Cancel</button>
                <button type="submit" form="deleteForm" class="bv-btn-danger">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M3 4h10M6 4V3h4v1M5 4v8a1 1 0 001 1h4a1 1 0 001-1V4"/>
                    </svg>
                    Yes, Delete Account
                </button>
            </div>
        </div>
    </div>
</x-client-layout>
@endif

<script>
    /* ── Tab switching ── */
    function switchTab(name, btn) {
        document.querySelectorAll('.bv-card').forEach(c => c.classList.remove('active'));
        document.querySelectorAll('.bv-tab').forEach(t => t.classList.remove('active'));
        document.getElementById('tab-' + name).classList.add('active');
        btn.classList.add('active');
    }

    /* ── Delete modal ── */
    function openDeleteModal() {
        document.getElementById('deleteModal').classList.add('open');
        document.body.style.overflow = 'hidden';
        setTimeout(() => document.getElementById('delete_password').focus(), 100);
    }
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('open');
        document.body.style.overflow = '';
    }
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeDeleteModal(); });

    /* ── Password strength ── */
    function checkStrength(val) {
        const segs = [document.getElementById('seg1'), document.getElementById('seg2'),
                      document.getElementById('seg3'), document.getElementById('seg4')];
        const label = document.getElementById('strengthLabel');
        const colors = { 0:'#E5DDD5', 1:'#E74C3C', 2:'#E67E22', 3:'#F1C40F', 4:'#27AE60' };
        const labels = { 0:'Enter a password', 1:'Too weak', 2:'Fair', 3:'Good', 4:'Strong' };

        let score = 0;
        if (val.length >= 8)  score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        segs.forEach((s, i) => {
            s.style.background = i < score ? colors[score] : '#E5DDD5';
        });
        label.textContent = val.length ? labels[score] : labels[0];
        label.style.color = score > 2 ? colors[score] : '#C0B8B0';
    }

    /* ── Auto-open correct tab if there are errors ── */
    @if($errors->has('current_password') || $errors->has('password') || $errors->has('password_confirmation'))
        switchTab('password', document.querySelector('.bv-tab:nth-child(2)'));
    @endif
    @if($errors->updateProfileInformation->any() || $errors->has('name') || $errors->has('email'))
        switchTab('info', document.querySelector('.bv-tab:nth-child(1)'));
    @endif
</script>