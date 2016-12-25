<nav class="navbar navbar-light bg-faded navbar-main">
    <div class="container">
        <div class="hidden-sm-up">
            <button class="navbar-toggler float-xs-right hidden-sm-up"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navigation-main"
                    aria-controls="navigation-main"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                &#9776;
            </button>
            <a class="navbar-brand" href="{{ route('homepage') }}">Finance</a>
            <div class="clearfix"></div>
        </div>
        <div class="collapse navbar-toggleable-xs" id="navigation-main">
            <a class="navbar-brand hidden-xs-down" href="{{ route('homepage') }}">Finance</a>

            <ul class="nav navbar-nav">
                <li class="nav-item {{ $page=='homepage'?'active':'' }}">
                    <a class="nav-link" href="{{ route('homepage') }}">Home</a>
                </li>
                @if(!Auth::guest())
                    <li class="nav-item {{ $page=='profile.dashboard'?'active':'' }}">
                        <a class="nav-link" href="{{ route('dashboard') }}">Balances</a>
                    </li>
                @endif
            </ul>

            <ul class="nav navbar-nav float-sm-right">
                @if (Auth::guest())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Sign in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register') }}">Sign up</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                           id="login-dropdown"
                           href="#"
                           data-toggle="dropdown"
                           aria-haspopup="true"
                           aria-expanded="false">
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
                            <form action="{{ url('/logout') }}" method="POST">
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