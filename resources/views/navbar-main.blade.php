<nav class="navbar navbar-light bg-faded navbar-main">
    <div class="container">
        <div class="hidden-sm-up">
            <button class="navbar-toggler pull-right hidden-sm-up"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navigation-main"
                    aria-controls="navigation-main"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                &#9776;
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">Finance</a>
            <div class="clearfix"></div>
        </div>
        <div class="collapse navbar-toggleable-xs" id="navigation-main">
            <a class="navbar-brand hidden-xs-down" href="{{ url('/') }}">Finance</a>

            <ul class="nav navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
            </ul>

            <ul class="nav navbar-nav pull-sm-right">
                @if (Auth::guest())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">Sign-in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register') }}">Sign-up</a>
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
                            <a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a>
                            <form action="{{ url('/logout') }}" method="POST">
                                {{ csrf_field() }}
                                <button class="dropdown-item" href="#">Logout</button>
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>

    </div>
</nav>