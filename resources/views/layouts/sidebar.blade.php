<nav class="navbar-vertical navbar">
    <div class="nav-scroller">

        <!-- Brand logo -->
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('/images/logo.png') }}" alt="logo app" class="img-fluid" style="height: 50px;" />
            <span class="ps-3 text-light fw-bold "
                style="letter-spacing: 1px; text-transform: uppercase;">{{ Auth::user()->role->role_name }}</span>
        </a>

        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                @if (Auth::user()->role_id == 1)
                    <a class="nav-link has-arrow {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }} ">
                        <i data-feather="home" class="nav-icon icon-xs me-2"></i> Dashboard
                    </a>
                @elseif (Auth::user()->role_id == 2)
                    <a class="nav-link has-arrow {{ request()->routeIs('pengelola.dashboard') ? 'active' : '' }}"
                        href="{{ route('pengelola.dashboard') }}">
                        <i data-feather="home" class="nav-icon icon-xs me-2"></i> Dashboard
                    </a>
                @endif

            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <div class="navbar-heading">MESSAGES</div>
            </li>


            <!-- Sub Nav-item -->
            <li class="nav-item">
                <a class="nav-link has-arrow collapsed {{ request()->routeIs('inbox*') || request()->routeIs('disposition.*') ? 'active' : '' }}"
                    href="#!" data-bs-toggle="collapse" data-bs-target="#navPages" aria-expanded="false"
                    aria-controls="navPages">
                    <i data-feather="mail" class="nav-icon icon-xs me-2">
                    </i> Inbox
                </a>

                <div id="navPages"
                    class="collapse {{ request()->routeIs('inbox*') || request()->routeIs('disposition.*') ? 'show' : '' }}"
                    data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('inbox.*') && !request()->routeIs('disposition.index') ? 'active' : '' }}"
                                href="{{ route('inbox.index') }}">
                                <i data-feather="mail" class="nav-icon icon-xs me-2"> </i>
                                All Inboxes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('disposition.index') ? 'active' : '' }}"
                                href="{{ route('disposition.index') }}">
                                <i data-feather="git-branch" class="nav-icon icon-xs me-2"> </i>
                                Dispositions
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="#">
                    <i data-feather="send" class="nav-icon icon-xs me-2">
                    </i>
                    Sent
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="#">
                    <i data-feather="file-text" class="nav-icon icon-xs me-2">
                    </i>
                    Another Mail
                </a>
            </li>

            <!-- Nav item -->
            @if (Auth::user()->role_id == 1)
                <li class="nav-item">
                    <div class="navbar-heading">Users</div>
                </li>

                {{-- Sub Item --}}
                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <i data-feather="users" class="nav-icon icon-xs me-2">
                        </i>
                        Manage Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <i data-feather="tag" class="nav-icon icon-xs me-2">
                        </i>
                        Grades
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <i data-feather="git-merge" class="nav-icon icon-xs me-2">
                        </i>
                        Roles
                    </a>
                </li>
            @endif

            {{-- @if (Auth::User()->role_id === 1) --}}

            {{-- @endif --}}

            <!-- Nav item -->
            <li class="nav-item">
                <div class="navbar-heading">Account Settings</div>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow collapsed" href="#!" data-bs-toggle="collapse" data-bs-target="#settings"
                    aria-expanded="false" aria-controls="navPages">
                    <i data-feather="settings" class="nav-icon icon-xs me-2">
                    </i> Settings
                </a>

                <div id="settings" class="collapse" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="#">
                                Edit Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#">
                                Account settings
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="nav-link " href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        <i data-feather="log-out" class="nav-icon icon-xs me-2" style="transform: scaleX(-1);">
                        </i>
                        Sign Out
                    </a>
                </form>
            </li>

        </ul>

    </div>
</nav>
