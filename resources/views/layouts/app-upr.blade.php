<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- TOM-TOM --}}
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.37.2/maps/maps.css'/>
    <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.37.2/maps/maps-web.min.js'></script>

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
                    <nav class="navbar navbar-expand-lg navbar-light">
                        {{-- LOGO --}}
                        <a class="navbar-brand" href="#">
                            <img src="{{ asset('img/logo-boolbnb.svg') }}" alt="Boolbnb-logo">
                        </a>
                        {{-- BOTTONE MENU CHE APPARE NEL MOBILE --}}
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
                            <ul class="navbar-nav d-flex justify-content-between">

                                <li class="nav-item active">
                                    <a href="#">My Homes<span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#">Messages</a>
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

                            </ul>
                        </div>
                    </nav>
			    </div>
            </div>
		</header>

        <main class="py-4">
            @yield('content')
        </main>

        @include('partials.footer.footer')
    </div>




        {{-- <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-between">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/logo-boolbnb.svg') }}" alt="">
            </a>
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">My Homes <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Messages</a>
                    </li>
                    <li class="nav-item dropdown"> {{-- Copiato e incollato dallo scaffolding Auth di Laravel --}}
                        {{-- <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </li>
                </ul>
            </div>
        </nav> --}} --}}
</body>
</html>
