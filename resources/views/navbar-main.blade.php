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
                    <a class="nav-link" href="#">Home</a>
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
                        <a class="nav-link" href="{{ url('/login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>

    </div>
</nav>