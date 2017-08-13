

<nav class="navbar navbar-expand-lg navbar-light bg-faded">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right"
                type="button"
                data-toggle="collapse"
                data-target="#navigation-main"
                aria-controls="navigation-main"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="{{ route('homepage') }}">Finance</a>

        <div class="collapse navbar-collapse" id="navigation-main">
            <ul class="navbar-nav mr-auto mt-2 mt-md-0">
                <li class="nav-item {{ $page=='homepage'?'active':'' }}">
                    <a class="nav-link" href="{{ route('homepage') }}">
                        Home
                        @if($page=='homepage')
                            <span class="sr-only">(current)</span>
                        @endif
                    </a>
                </li>
                @if(!Auth::guest())
                    <li class="nav-item {{ $page=='profile.dashboard'?'active':'' }}">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            Balances
                            @if($page=='profile.dashboard')
                                <span class="sr-only">(current)</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item {{ $page=='profile.index'?'active':'' }}">
                        <a class="nav-link" href="{{ route('profile') }}">
                            Profile
                            @if($page=='profile.index')
                                <span class="sr-only">(current)</span>
                            @endif
                        </a>
                    </li>
                @endif
                <li class="nav-item {{ $page=='help'?'active':'' }}">
                    <a class="nav-link" href="{{ route('help') }}">
                        Help
                        @if($page=='help')
                            <span class="sr-only">(current)</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item {{ $page=='about'?'active':'' }}">
                    <a class="nav-link" href="{{ route('about') }}">
                        About
                        @if($page=='about')
                            <span class="sr-only">(current)</span>
                        @endif
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                @if (Auth::guest())
                    <li class="nav-item {{ $page == 'login' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('login') }}">Sign in</a>
                    </li>
                    <li class="nav-item {{ $page == 'register' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('register') }}">Sign up</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                           id="login-dropdown"
                           href="#"
                           data-toggle="dropdown"
                           aria-haspopup="true"
                           aria-expanded="false">
                            <span class="profile-image-container rounded-circle nav-image">
                                <img src="{{ Auth::user()->image }}" alt="{{ Auth::user()->full_name }}">
                            </span>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="login-dropdown">
                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                Dashboard
                            </a>
                            <a class="dropdown-item" href="{{ route('balance.create') }}">
                                New balance
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('profile.settings') }}">
                                Setting
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                {{ csrf_field() }}
                                <button class="dropdown-item" href="#">Sign out</button>
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>