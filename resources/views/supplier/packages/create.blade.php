<x-supplier-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Team') }}
        </h2>
    </x-slot>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap');
    :root {
        --gold:#C9A84C; --gold-dark:#8A6A1F; --gold-light:rgba(201,168,76,0.10);
        --ivory:#FAF7F2; --charcoal:#1E1B18; --warm-grey:#706B65;
        --border:#E5DDD5; --border-md:#E0D8D0; --white:#FFFFFF;
        --danger:#DC2626;
        --font-display:'Playfair Display',Georgia,serif;
        --font-body:'DM Sans',sans-serif;
    }
    *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }

    .at-page { padding:1.5rem; max-width:720px; margin:0 auto; }

    /* ── Top row ── */
    .at-top { display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:.75rem; margin-bottom:1.4rem; }
    .at-title { font-family:var(--font-display); font-size:1.65rem; font-weight:700; color:var(--charcoal); line-height:1.15; }
    .at-title em { font-style:italic; color:var(--gold-dark); }
    .at-subtitle { font-size:.76rem; color:var(--warm-grey); margin-top:.2rem; font-family:var(--font-body); }
    .at-pkg-chip {
        display:inline-flex; align-items:center; gap:.4rem;
        font-size:.68rem; font-weight:500; letter-spacing:.04em;
        color:var(--gold-dark); background:var(--gold-light);
        border:1px solid rgba(201,168,76,.3); padding:.3rem .85rem;
        border-radius:20px; font-family:var(--font-body); white-space:nowrap;
    }
    .at-pkg-chip svg { width:11px; height:11px; }

    /* ── Alert ── */
    .at-alert { display:flex; align-items:center; gap:.6rem; background:#F0FDF4; border:1px solid #BBF7D0; border-radius:8px; padding:.7rem 1rem; font-size:.8rem; color:#065F46; margin-bottom:1.25rem; font-family:var(--font-body); }
    .at-alert svg { width:15px; height:15px; color:#10B981; flex-shrink:0; }

    /* ── Card ── */
    .at-card {
        background:var(--white); border:1.5px solid var(--border); border-radius:14px;
        overflow:hidden; box-shadow:0 2px 14px rgba(30,27,24,.06);
    }
    .at-card-bar { height:4px; background:linear-gradient(90deg,var(--gold-dark),var(--gold),rgba(201,168,76,.25)); }

    .at-card-head {
        display:flex; align-items:center; gap:.5rem;
        padding:.85rem 1.25rem;
        border-bottom:1px solid var(--border);
        background:rgba(201,168,76,.03);
    }
    .at-card-head-title {
        font-size:.6rem; font-weight:700; letter-spacing:.16em; text-transform:uppercase;
        color:var(--gold-dark); font-family:var(--font-body);
        display:flex; align-items:center; gap:.45rem;
    }
    .at-card-head-title svg { width:12px; height:12px; flex-shrink:0; }
    .at-card-head-title::after { content:''; flex:1; height:1px; background:linear-gradient(90deg,rgba(201,168,76,.4),transparent); }

    .at-card-body { padding:1.1rem 1.25rem; }

    /* ── Intro info ── */
    .at-intro {
        display:flex; align-items:flex-start; gap:.55rem;
        background:var(--gold-light); border:1px solid rgba(201,168,76,.2);
        border-radius:8px; padding:.75rem .9rem; margin-bottom:1.1rem;
        font-size:.78rem; color:var(--warm-grey); line-height:1.5; font-family:var(--font-body);
    }
    .at-intro svg { width:14px; height:14px; flex-shrink:0; color:var(--gold-dark); opacity:.8; margin-top:1px; }
    .at-intro strong { color:var(--charcoal); }

    /* ── Team member row ── */
    .at-member-list { display:flex; flex-direction:column; gap:.6rem; }

    .at-member-row {
        display:flex; align-items:center; gap:.9rem;
        padding:.85rem 1rem; border-radius:9px;
        border:1.5px solid var(--border); background:var(--ivory);
        transition:border-color .18s, background .18s;
        flex-wrap:wrap;
    }
    .at-member-row:hover { border-color:rgba(201,168,76,.35); background:rgba(201,168,76,.04); }
    .at-member-row.is-checked { border-color:var(--gold); background:rgba(201,168,76,.07); box-shadow:0 0 0 2px rgba(201,168,76,.14); }

    /* Hidden native checkbox */
    .at-check-native { display:none; }

    /* Custom checkbox */
    .at-check-box {
        width:20px; height:20px; border-radius:5px; flex-shrink:0;
        border:2px solid var(--border-md); background:var(--white);
        display:flex; align-items:center; justify-content:center;
        cursor:pointer; transition:border-color .18s, background .18s;
        position:relative;
    }
    .at-check-box svg { width:11px; height:11px; color:var(--white); opacity:0; transition:opacity .15s; }
    .at-check-native:checked ~ .at-check-label .at-check-box,
    .at-member-row.is-checked .at-check-box {
        border-color:var(--gold); background:var(--gold);
    }
    .at-member-row.is-checked .at-check-box svg { opacity:1; }

    /* Avatar initials */
    .at-member-avatar {
        width:38px; height:38px; border-radius:9px; flex-shrink:0;
        background:rgba(201,168,76,.12); border:1.5px solid rgba(201,168,76,.25);
        display:flex; align-items:center; justify-content:center;
        font-family:var(--font-display); font-size:.82rem; font-weight:700; color:var(--gold-dark);
    }

    /* Member info */
    .at-member-info { flex:1; min-width:0; }
    .at-member-name { font-family:var(--font-display); font-size:.9rem; font-weight:700; color:var(--charcoal); }
    .at-member-role-chip {
        display:inline-flex; align-items:center; gap:.25rem;
        padding:.15rem .5rem; border-radius:20px; font-size:.6rem; font-weight:600;
        background:var(--gold-light); color:var(--gold-dark);
        border:1px solid rgba(201,168,76,.22); font-family:var(--font-body);
        margin-top:.18rem;
    }

    /* Role in package input */
    .at-role-wrap { flex-shrink:0; width:180px; }
    @media(max-width:560px) { .at-role-wrap { width:100%; } }
    .at-role-label { font-size:.58rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:var(--warm-grey); margin-bottom:.25rem; font-family:var(--font-body); }
    .at-role-input {
        width:100%; padding:.52rem .75rem;
        border:1.5px solid var(--border); border-radius:6px;
        font-family:var(--font-body); font-size:.8rem; color:var(--charcoal);
        background:var(--white); outline:none;
        transition:border-color .2s, box-shadow .2s, background .2s;
    }
    .at-role-input:focus { border-color:var(--gold); background:var(--white); box-shadow:0 0 0 3px rgba(201,168,76,.12); }
    .at-role-input::placeholder { color:#C0B8B0; }
    .at-member-row.is-checked .at-role-input { border-color:rgba(201,168,76,.4); }

    /* ── Empty state ── */
    .at-empty { text-align:center; padding:3rem 1rem; color:var(--warm-grey); font-size:.82rem; font-family:var(--font-body); }
    .at-empty svg { width:40px; height:40px; color:#DDD4C8; margin:0 auto .7rem; display:block; }
    .at-empty-title { font-family:var(--font-display); font-size:1rem; font-weight:700; color:var(--charcoal); margin-bottom:.25rem; }

    /* ── Footer actions ── */
    .at-footer {
        display:flex; align-items:center; justify-content:space-between;
        flex-wrap:wrap; gap:.65rem;
        padding:.9rem 1.25rem;
        border-top:1px solid var(--border);
        background:rgba(201,168,76,.02);
    }
    .at-footer-left { font-size:.72rem; color:var(--warm-grey); font-family:var(--font-body); }
    .at-footer-left strong { color:var(--charcoal); font-weight:600; }
    .at-footer-right { display:flex; gap:.55rem; }

    .btn-back {
        display:inline-flex; align-items:center; gap:.38rem;
        padding:.55rem 1.1rem; border-radius:7px;
        border:1.5px solid var(--border-md); background:var(--white);
        font-size:.74rem; font-weight:500; letter-spacing:.03em; text-transform:uppercase;
        color:var(--warm-grey); cursor:pointer; font-family:var(--font-body);
        text-decoration:none; transition:border-color .18s, color .18s;
    }
    .btn-back svg { width:13px; height:13px; }
    .btn-back:hover { border-color:var(--gold); color:var(--gold-dark); }

    .btn-save {
        display:inline-flex; align-items:center; gap:.4rem;
        padding:.58rem 1.35rem; border-radius:7px; border:none;
        background:var(--charcoal); color:var(--white);
        font-size:.74rem; font-weight:700; letter-spacing:.05em; text-transform:uppercase;
        cursor:pointer; font-family:var(--font-body);
        transition:background .18s; position:relative; overflow:hidden;
    }
    .btn-save::before { content:''; position:absolute; inset:0; background:linear-gradient(135deg,rgba(201,168,76,.18),transparent); }
    .btn-save:hover { background:#2e2a26; }
    .btn-save svg, .btn-save span { position:relative; z-index:1; }
    .btn-save svg { width:13px; height:13px; }
    </style>

    @if(session('success'))
    <div style="padding:0 1.5rem 0;">
        <div class="at-alert">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M5 10l4 4 6-6"/><circle cx="10" cy="10" r="8"/>
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    <div class="at-page">

        {{-- ── Top row ── --}}
        <div class="at-top">
            <div>
                <h1 class="at-title">Assign <em>Team</em></h1>
                <p class="at-subtitle">Select team members and define their roles for this package</p>
            </div>
            @if(isset($package))
            <span class="at-pkg-chip">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="2" y="6" width="10" height="7" rx="1"/><path d="M4 6V4a3 3 0 016 0v2"/>
                </svg>
                {{ $package->name }}
            </span>
            @endif
        </div>

        {{-- ── Main card ── --}}
        <div class="at-card">
            <div class="at-card-bar"></div>

            <div class="at-card-head">
                <div class="at-card-head-title">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="5" cy="4" r="2.5"/>
                        <path d="M1 12c0-2.5 1.8-4 4-4"/>
                        <circle cx="10" cy="4" r="2.5"/>
                        <path d="M7 12c0-2.5 1.8-4 4-4"/>
                    </svg>
                    Team Members
                </div>
            </div>

            <form method="POST" action="{{ route('supplier.package.assignTeams', $package->id) }}" id="assign-form">
                @csrf

                <div class="at-card-body">

                    <div class="at-intro">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                            <circle cx="8" cy="8" r="6"/><path d="M8 7v5M8 5h.01"/>
                        </svg>
                        <span>Check each team member to include them in <strong>{{ $package->name ?? 'this package' }}</strong>. Optionally assign a specific role for each member in this package.</span>
                    </div>

                    <div class="at-member-list" id="member-list">

                        @forelse($teams as $team)
                        @php
                            $isChecked = isset($package) && $package->teams->contains($team->id);
                            $pivotRole = data_get($package->teams->find($team->id), 'pivot.role_in_package', '');
                            $initials  = strtoupper(substr($team->name, 0, 1) . (str_contains($team->name, ' ') ? substr(strrchr($team->name, ' '), 1, 1) : ''));
                        @endphp

                        <div class="at-member-row {{ $isChecked ? 'is-checked' : '' }}"
                             id="row-{{ $team->id }}"
                             onclick="toggleMember({{ $team->id }}, event)">

                            {{-- Hidden native checkbox --}}
                            <input class="at-check-native"
                                   type="checkbox"
                                   name="teams[]"
                                   id="team-{{ $team->id }}"
                                   value="{{ $team->id }}"
                                   {{ $isChecked ? 'checked' : '' }}>

                            {{-- Custom checkbox visual --}}
                            <div class="at-check-box" id="chkbox-{{ $team->id }}">
                                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M2 6l3 3 5-5"/>
                                </svg>
                            </div>

                            {{-- Avatar --}}
                            <div class="at-member-avatar">{{ $initials }}</div>

                            {{-- Info --}}
                            <div class="at-member-info">
                                <div class="at-member-name">{{ $team->name }}</div>
                                @if($team->role)
                                <div class="at-member-role-chip">{{ $team->role }}</div>
                                @endif
                            </div>

                            {{-- Role in package input --}}
                            <div class="at-role-wrap" onclick="event.stopPropagation()">
                                <div class="at-role-label">Role in Package</div>
                                <input type="text"
                                       name="roles[{{ $team->id }}]"
                                       id="role-{{ $team->id }}"
                                       class="at-role-input"
                                       placeholder="e.g. Lead Coordinator"
                                       value="{{ old('roles.' . $team->id, $pivotRole) }}">
                            </div>

                        </div>
                        @empty
                        <div class="at-empty">
                            <svg viewBox="0 0 40 40" fill="none" stroke="currentColor" stroke-width="1.3">
                                <circle cx="14" cy="13" r="6"/>
                                <path d="M4 32c0-5.5 4.5-10 10-10"/>
                                <circle cx="26" cy="13" r="6"/>
                                <path d="M16 32c0-5.5 4.5-10 10-10s10 4.5 10 10"/>
                            </svg>
                            <div class="at-empty-title">No team members found</div>
                            <p>Add team members first before assigning them to packages.</p>
                        </div>
                        @endforelse

                    </div>

                </div>

                {{-- ── Footer ── --}}
                <div class="at-footer">
                    <div class="at-footer-left">
                        <strong id="checked-count">{{ isset($package) ? $package->teams->count() : 0 }}</strong>
                        member{{ (isset($package) && $package->teams->count() === 1) ? '' : 's' }} selected
                    </div>
                    <div class="at-footer-right">
                        <a href="#" class="btn-back">
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 3L5 7l4 4"/>
                            </svg>
                            Back
                        </a>
                        <button type="submit" class="btn-save">
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M2 7l4 4 6-6"/>
                            </svg>
                            <span>Save Team</span>
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>

    <script>
    /* Toggle checked state on row click */
    function toggleMember(id, e) {
        // Don't toggle when clicking the role input directly
        if (e.target.tagName === 'INPUT' && e.target.type === 'text') return;

        var checkbox = document.getElementById('team-' + id);
        var row      = document.getElementById('row-' + id);
        var chkbox   = document.getElementById('chkbox-' + id);

        checkbox.checked = !checkbox.checked;

        if (checkbox.checked) {
            row.classList.add('is-checked');
        } else {
            row.classList.remove('is-checked');
        }

        updateCount();
    }

    /* Update "X members selected" counter */
    function updateCount() {
        var checked = document.querySelectorAll('.at-check-native:checked').length;
        var el = document.getElementById('checked-count');
        if (el) el.textContent = checked;
    }

    /* Sync counter on page load */
    document.addEventListener('DOMContentLoaded', function() {
        updateCount();
    });
    </script>

</x-supplier-layout>