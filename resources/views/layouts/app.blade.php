<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Boolbnb</title>

    <!-- TomTom -->
	<script src='https://npmcdn.com/@turf/turf/turf.min.js'></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header>
            <div class="container">

                <div class="row">
                    <nav class="navbar nav d-flex justify-content-between align-items-center">
                        {{-- LOGO --}}
                        <a class="navbar-brand" href="{{ route('guest.homepage') }}">
                            <img src="{{ asset('img/logo-boolbnb.svg') }}" alt="Boolbnb-logo">
                        </a>

                        <div class="nav-right">

                            <!-- Right Side Of Navbar -->
                            <ul class="nav-desktop">
                                <!-- Authentication Links -->
                                @guest
                            {{-- GUEST DESKTOP --}}
                                    <li class="nav-item header-login">
                                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item header-signup">
                                            <a href="{{ route('register') }}">{{ __('Sign up') }}</a>
                                        </li>
                                    @endif
                            {{-- END GUEST DESKTOP --}}

                                @else

                            {{-- UPR DESKTOP --}}
                                    <li class="nav-item active menu-my-home">
                                        <a href="{{ route('upr.houses.index') }}"> MY HOMES </a>
                                    </li>

                                    <li class="nav-item menu-messages">
                                        <a href="{{ route('upr.messages.index') }}"> MESSAGES </a>
                                    </li>
                            {{-- LOGOUT Copiato e incollato dallo scaffolding Auth di Laravel --}}
                                    <li class="nav-item header-logout">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                            {{-- END UPR DESKTOP --}}

                                @endguest

                            </ul>



                            <a class="open-hamburger-menu" href="#">
                                <i class="fas fa-bars"></i> {{-- * * * ICONA PER HAMBURGER MENU * * * --}}
                            </a>

{{-- HAMBUNGER MENU --}}
                            <ul class="hamburger-menu">

                            {{-- LOGO --}}
                                <li>
                                    <a class="navbar-brand" href="{{ route('guest.homepage') }}">
                                        <img src="{{ asset('img/logo-boolbnb.svg') }}" alt="Boolbnb-logo">
                                    </a>
                                </li>

                            {{-- HEADER GUEST MOBILE --}}
                                @guest
                                    <li class="menu-item header-login">
                                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="menu-item header-signup">
                                            <a href="{{ route('register') }}">{{ __('Sign up') }}</a>
                                        </li>
                                    @endif
                            {{-- END HEADER GUEST MOBILE --}}

                                    <li class="close-hamburger-menu">
                                        <i class="fas fa-times"></i> {{-- * * * ICONA "X" PER CHIUDERE HAMBURGER MENU * * * --}}
                                    </li>

                                @else

                                {{-- HEADER UPR MOBILE --}}
                                    <li class="nav-item active menu-my-home">
                                        <a href="{{ route('upr.houses.index') }}"> MY HOMES </a>
                                    </li>

                                    <li class="nav-item menu-messages">
                                        <a href="{{ route('upr.messages.index') }}"> MESSAGES </a>
                                    </li>
                                {{-- LOGOUT Copiato e incollato dallo scaffolding Auth di Laravel --}}
                                    <li class="nav-item header-logout">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                {{-- END HEADER UPR MOBILE --}}

                                    <li class="close-hamburger-menu">
                                        <i class="fas fa-times"></i> {{-- * * * ICONA "X" PER CHIUDERE HAMBURGER MENU * * * --}}
                                    </li>

                                @endguest
                            </ul>

                        </div> {{-- END NAV-RIGHT --}}
                    </nav>
                </div> {{-- END MY-ROW --}}
            </div> {{-- END CONTAINER --}}
        </header>

        <main class="py-4">
            @yield('content')
        </main>

        @include('partials.footer.footer')

    </div>
</body>
</html>
