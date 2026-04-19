@if(auth()->user()->isAdmin())
            <div class="topbar-right">
                <!-- Search -->
                <div class="topbar-search">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="9" cy="9" r="6"/><path d="M15 15l3 3"/>
                    </svg>
                    <input type="text" placeholder="Search suppliers, events…">
                </div>

                <!-- Notifications -->
                <a href="#" class="icon-btn" aria-label="Notifications">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M10 2a6 6 0 016 6v3l2 3H2l2-3V8a6 6 0 016-6zM8 16a2 2 0 004 0"/>
                    </svg>
                    <span class="notif-badge"></span>
                </a>

                <!-- Messages -->
                <a href="#" class="icon-btn" aria-label="Messages">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/>
                    </svg>
                </a>

                <!-- User pill + dropdown -->
                <div class="user-pill" tabindex="0">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->role ?? 'U', 0, 2)) }}
                    </div>
                    <span class="user-role">{{ Auth::user()->role ?? 'Guest' }}</span>
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 4l4 4 4-4"/>
                    </svg>

                    <!-- Dropdown -->
                    <div class="user-dropdown">
                        <a href="{{ route('admin.profile') ?? '#' }}" class="dropdown-item">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <circle cx="8" cy="6" r="3"/><path d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6"/>
                            </svg>
                            My Profile
                        </a>
                        <a href="#" class="dropdown-item">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <circle cx="8" cy="8" r="2.5"/><path d="M8 1v2M8 13v2M1 8h2M13 8h2M3.1 3.1l1.4 1.4M11.5 11.5l1.4 1.4M3.1 12.9l1.4-1.4M11.5 4.5l1.4-1.4"/>
                            </svg>
                            Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item danger">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M11 5l4 3-4 3M7 8h8M7 2H3a1 1 0 00-1 1v10a1 1 0 001 1h4"/>
                                </svg>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
@elseif(auth()->user()->isSupplier())
            <div class="topbar-right">
                <!-- Search -->
                <div class="topbar-search">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="9" cy="9" r="6"/><path d="M15 15l3 3"/>
                    </svg>
                    <input type="text" placeholder="Search suppliers, events…">
                </div>

                <!-- Notifications -->
                <a href="#" class="icon-btn" aria-label="Notifications">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M10 2a6 6 0 016 6v3l2 3H2l2-3V8a6 6 0 016-6zM8 16a2 2 0 004 0"/>
                    </svg>
                    <span class="notif-badge"></span>
                </a>

                <!-- Messages 
                <a href="#" class="icon-btn" aria-label="Messages">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/>
                    </svg>
                </a>-->

                <!-- User pill + dropdown -->
                <div class="user-pill" tabindex="0">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->role ?? 'U', 0, 2)) }}
                    </div>
                    <span class="user-role">{{ Auth::user()->role ?? 'Guest' }}</span>
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 4l4 4 4-4"/>
                    </svg>

                    <!-- Dropdown -->
                    <div class="user-dropdown">
                        <a href="{{ route('supplier.profile') ?? '#' }}" class="dropdown-item">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <circle cx="8" cy="6" r="3"/><path d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6"/>
                            </svg>
                            My Profile
                        </a>
                        <a href="#" class="dropdown-item">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <circle cx="8" cy="8" r="2.5"/><path d="M8 1v2M8 13v2M1 8h2M13 8h2M3.1 3.1l1.4 1.4M11.5 11.5l1.4 1.4M3.1 12.9l1.4-1.4M11.5 4.5l1.4-1.4"/>
                            </svg>
                            Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item danger">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M11 5l4 3-4 3M7 8h8M7 2H3a1 1 0 00-1 1v10a1 1 0 001 1h4"/>
                                </svg>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
@else
            <div class="topbar-right">
                <!-- Search -->
                <div class="topbar-search">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="9" cy="9" r="6"/><path d="M15 15l3 3"/>
                    </svg>
                    <input type="text" placeholder="Search suppliers, events…">
                </div>

                <!-- Notifications -->
                <a href="#" class="icon-btn" aria-label="Notifications">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M10 2a6 6 0 016 6v3l2 3H2l2-3V8a6 6 0 016-6zM8 16a2 2 0 004 0"/>
                    </svg>
                    <span class="notif-badge"></span>
                </a>

                <!-- Messages 
                <a href="#" class="icon-btn" aria-label="Messages">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M4 4h12a2 2 0 012 2v7a2 2 0 01-2 2H6l-4 3V6a2 2 0 012-2z"/>
                    </svg>
                </a>-->

                <!-- User pill + dropdown -->
                <div class="user-pill" tabindex="0">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->role ?? 'U', 0, 2)) }}
                    </div>
                    <span class="user-role">{{ Auth::user()->role ?? 'Guest' }}</span>
                    <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 4l4 4 4-4"/>
                    </svg>

                    <!-- Dropdown -->
                    <div class="user-dropdown">
                        <a href="{{ route('client.profile') ?? '#' }}" class="dropdown-item">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <circle cx="8" cy="6" r="3"/><path d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6"/>
                            </svg>
                            My Profile
                        </a>
                        <a href="#" class="dropdown-item">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                <circle cx="8" cy="8" r="2.5"/><path d="M8 1v2M8 13v2M1 8h2M13 8h2M3.1 3.1l1.4 1.4M11.5 11.5l1.4 1.4M3.1 12.9l1.4-1.4M11.5 4.5l1.4-1.4"/>
                            </svg>
                            Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item danger">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M11 5l4 3-4 3M7 8h8M7 2H3a1 1 0 00-1 1v10a1 1 0 001 1h4"/>
                                </svg>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
@endif            
            
            
