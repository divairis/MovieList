<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        {{-- <a href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" alt=""></a> --}}
                        <a class="h3 font-weight-bold" href="{{ route('home') }}">
                            <b class="text-light">Movie</b><b class="text-danger">List</b>
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li><a href="{{ route('home') }}">Homepage</a></li>
                                <li><a href="{{ route('home') }}">Movies</a></li>
                                <li><a href="{{ route('actor') }}">Actors</a></li>
                                @can('user')
                                <li><a href="{{ route('user_watchlist') }}">My Watchlist</a></li>
                                @endcan
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="header__right">
                        @auth
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" style="text-decoration:none;color:white">
                                <img id="img-logo-nav"
                                    src="{{ session('url')!=null ? session('url') : asset('img/avatar-2.png') }}">

                            </button>

                            <div class="dropdown-menu dropdown-menu-lg-right" style="background-color: black
                                ;max-width: 10px;">
                                <a class="dropdown-item" href="{{ route('user_profile') }}">Profile</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="post" id="logout">
                                    @csrf
                                    <a class="dropdown-item" href="#"
                                        onclick="document.getElementById('logout').submit()">Logout</a>
                                </form>
                            </div>
                        </div>
                        @endauth
                        @guest
                        <a class="font-weight-bold" href="{{ route('login_page') }}">Login</a>
                        @endguest
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header End -->
