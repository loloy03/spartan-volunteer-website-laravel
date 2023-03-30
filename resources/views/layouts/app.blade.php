<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Spartan Volunteer | Become a Volunteer Now</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Montserrat:wght@700&display=swap" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('/images/spartan-logo-favicon.png') }}" type="image/x-icon">

    <!--Font Awesome CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />

    <!--Css files-->
    <link rel="stylesheet" href="{{ asset('/css/navbar.css') }}">
    @yield('import-css')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md bg-black sticky-top">
            <div class="container">
                <a class="navbar-brand  href="{{ url('/') }}">
                    <img class="navbar-spartan-logo-size" src="{{ asset('/images/spartan-logo-with-word.png') }}"
                        alt="Logo Image">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item bottom-transition">
                                    <a class="nav-link text-light" href="{{ route('login') }}">{{ __('LOGIN') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item bottom-transition">
                                    <a class="nav-link text-light" href="{{ route('register') }}">{{ __('REGISTER') }}</a>
                                </li>
                            @endif
                        @else
                            @if (Route::has('event'))
                                <li class="nav-item bottom-transition mx-1">
                                    <a class="nav-link text-light" href="{{ route('home') }}">{{ __('HOME') }}</a>
                                </li>
                                <li class="nav-item bottom-transition mx-1">
                                    <a class="nav-link text-light" href="{{ route('event') }}">{{ __('EVENTS') }}</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown bottom-transition">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ strtoupper(Auth::user()->first_name . ' ' . Auth::user()->last_name) }}

                                </a>
                                <div class="dropdown-menu dropdown-menu-end bg-dark" aria-labelledby="navbarDropdown">
                                    @auth
                                        <a class="dropdown-item text-white" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Profile') }}
                                        </a>
                                    @endauth

                                    <a class="dropdown-item text-white" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            @yield('content')
        </main>
        <div class="bg-black py-5 px-5">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-lg-6 text-center my-auto">
                        <i class="fa-brands fa-facebook text-light mx-4 fa-xl"></i>
                        <i class="fa-brands fa-twitter text-light mx-4 fa-xl"></i>
                        <i class="fa-brands fa-instagram text-light mx-4 fa-xl"></i>
                        <i class="fa-brands fa-youtube text-light mx-4 fa-xl"></i>
                    </div>
                    <div class="col-lg-6 opacity-25 text-center ">
                        <img src="{{ asset('/images/spartan-logo-with-word.png') }} " width="250px" alt="">
                    </div>
                </div>
                <div class="row text-light mx-auto f-montserrat my-5">
                    <div class="col-lg-3 col-xs-6 my-1">
                        JOIN AS A RACER
                    </div>
                    <div class="col-lg-3 col-xs-6 my-1">
                        SHOP
                    </div>
                    <div class="col-lg-3 col-xs-6 my-1">
                        BLOG
                    </div>
                    <div class="col-lg-3 col-xs-6 my-1">
                        HELP
                    </div>
                </div>
                <div class="row text-light f-lato">
                    <div class="col-lg-6">
                        © 2022 Spartan Race Inc. Established 2010 - Vermont
                    </div>
                    <div class="col-lg-6 text-center">
                        <div class="d-inline-block mx-3">Privacy</div>
                        <div class="d-inline-block mx-3">Terms And Condition</div>
                        <div class="d-inline-block mx-3">Cookies</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
