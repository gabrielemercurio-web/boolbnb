<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Boolbnb</title>

    {{-- TOM-TOM --}}
        <!-- TomTom -->
	<script src='https://npmcdn.com/@turf/turf/turf.min.js'></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- CHARTJS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    {{-- MOMENTJS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
</head>
<body>
    <div id="app">
        <header>
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-between">
                        {{-- LOGO --}}
                        <a class="navbar-brand" href="{{ route('upr.houses.homepage') }}">
                            <img src="{{ asset('img/logo-boolbnb.svg') }}" alt="Boolbnb-logo">
                        </a>
                        {{-- BOTTONE MENU CHE APPARE NEL MOBILE --}}
                        <button class="nav-button-menu navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav d-flex justify-content-between">

                                <li class="nav-item active">
                                    <a href="{{ route('upr.houses.index') }}">My Homes<span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('upr.messages.index') }}">Messages</a>
                                </li>
                                {{-- LOGOUT Copiato e incollato dallo scaffolding Auth di Laravel --}}
                                <li class="nav-item">
                                    <a class="header-logout" href="{{ route('logout') }}"
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
</body>
</html>
