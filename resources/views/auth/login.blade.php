{{-- resources/views/auth/login.blade.php --}}
{{-- Works with both Laravel Breeze and standalone --}}

<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div style="
            background: rgba(100,200,140,0.12);
            border: 1px solid rgba(100,200,140,0.35);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.82rem;
            color: #2E7D52;
            margin-bottom: 1.2rem;
        ">
            {{ session('status') }}
        </div>
    @endif

    <style>
        /* Override Breeze defaults inside this form */
        .field-group { display: flex; flex-direction: column; gap: 0.9rem; margin-bottom: 1rem; }

        .lf-field { position: relative; margin-bottom: 0; }
        .lf-label {
            display: block;
            font-size: 0.72rem; font-weight: 500;
            letter-spacing: 0.05em; text-transform: uppercase;
            color: #706B65; margin-bottom: 0.4rem;
            font-family: 'DM Sans', sans-serif;
        }
        .lf-input {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.75rem;
            border: 1.5px solid #E5DDD5;
            border-radius: 8px;
            font-size: 0.9rem;
            color: #1E1B18;
            background: #FAF7F2;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            outline: none;
            font-family: 'DM Sans', sans-serif;
        }
        .lf-input::placeholder { color: #C0B8B0; }
        .lf-input:focus {
            border-color: #C9A84C;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(201,168,76,0.12);
        }
        .lf-icon {
            position: absolute;
            left: 0.85rem;
            top: 50%; transform: translateY(-50%);
            width: 17px; height: 17px;
            color: #C0B8B0; pointer-events: none;
            transition: color 0.2s;
        }
        .lf-field:focus-within .lf-icon { color: #8A6A1F; }
        .lf-error {
            font-size: 0.74rem; color: #C0392B;
            margin-top: 0.3rem; display: block;
            font-family: 'DM Sans', sans-serif;
        }

        .lf-remember {
            display: flex; align-items: center; gap: 0.5rem;
            margin-bottom: 1.4rem;
        }
        .lf-remember input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: #C9A84C; cursor: pointer;
        }
        .lf-remember label {
            font-size: 0.82rem; color: #706B65;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
        }

        .lf-forgot-row {
            display: flex; justify-content: flex-end;
            margin-bottom: 1.2rem;
        }
        .lf-forgot {
            font-size: 0.8rem; color: #706B65;
            text-decoration: none;
            font-family: 'DM Sans', sans-serif;
            transition: color 0.2s;
        }
        .lf-forgot:hover { color: #8A6A1F; text-decoration: underline; }

        .lf-btn-login {
            width: 100%; padding: 0.95rem;
            background: linear-gradient(135deg, #1E1B18 0%, #3a2e20 100%);
            color: #fff;
            border: none; border-radius: 8px;
            font-size: 0.9rem; font-weight: 500;
            letter-spacing: 0.04em;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
            position: relative; overflow: hidden;
            font-family: 'DM Sans', sans-serif;
        }
        .lf-btn-login::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, #8A6A1F, #C9A84C);
            opacity: 0; transition: opacity 0.3s;
        }
        .lf-btn-login:hover::after { opacity: 1; }
        .lf-btn-login:hover { transform: translateY(-1px); box-shadow: 0 8px 24px rgba(138,106,31,0.25); }
        .lf-btn-login span { position: relative; z-index: 1; }
    </style>

    <form method="POST" action="{{ route('login') }}">
        @csrf
    
    <!-- Heading -->
    <div class="form-heading">
        <h2>Welcome back</h2>
        <p>Sign in to your Bikol'sCraft account</p>
    </div>


        <div class="field-group">
            <!-- Email -->
            <div class="lf-field">
                <label class="lf-label" for="email">Email address</label>
                <div style="position:relative;">
                    <input
                        id="email" name="email" type="email"
                        class="lf-input"
                        value="{{ old('email') }}"
                        placeholder="you@example.com"
                        required autocomplete="username"
                    />
                    <svg class="lf-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path d="M3 5h14l-7 7L3 5z"/><rect x="1" y="4" width="18" height="13" rx="2"/>
                    </svg>
                </div>
                @error('email')
                    <span class="lf-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="lf-field">
                <label class="lf-label" for="password">Password</label>
                <div style="position:relative;">
                    <input
                        id="password" name="password" type="password"
                        class="lf-input"
                        placeholder="••••••••"
                        required autocomplete="current-password"
                    />
                    <svg class="lf-icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6">
                        <rect x="4" y="9" width="12" height="9" rx="2"/>
                        <path d="M7 9V7a3 3 0 116 0v2"/>
                    </svg>
                </div>
                @error('password')
                    <span class="lf-error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Remember + Forgot -->
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.4rem;">
            <label class="lf-remember">
                <input type="checkbox" name="remember" id="remember_me">
                <span style="font-size:0.82rem; color:#706B65; font-family:'DM Sans',sans-serif;">Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a class="lf-forgot" href="{{ route('password.request') }}">Forgot password?</a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="lf-btn-login">
            <span>Log in</span>
        </button>
    </form>

     <!-- Divider + Register -->
    @if (Route::has('register'))
        <div class="divider"><span>or</span></div>
        <a href="{{ route('register') }}" class="btn-register">Create new account</a>
    @endif
</x-guest-layout>