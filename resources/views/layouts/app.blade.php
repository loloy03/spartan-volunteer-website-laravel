<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Spartan Volunteer | Become a Volunteer Now</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
        
    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Montserrat:wght@700&display=swap" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('/images/spartan-logo-favicon.png') }}" type="image/x-icon">

    <!--Font Awesome CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />

    <link href="//db.onlinewebfonts.com/c/2206d6cc490084998d531e8c1b2cbb4a?family=Druk+Wide+Bold" rel="stylesheet"
        type="text/css" />

    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />

    <!--Css files-->
    <link rel="stylesheet" href="{{ asset('/css/navbar.css') }}">
    @yield('import-css')

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!-- jQuery UI library -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md bg-black sticky-top">
            <div class="container">
                <a class="navbar-brand  href="{{ url('/') }}">
                    <img class="navbar-spartan-logo-size" src="{{ asset('/images/spartan-logo-with-word.png') }}"
                        alt="Logo Image">
                </a>
                <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse"
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

                        @visitor
                            @if (Route::has('login') && !Auth::guard('staff')->check() && !Auth::guard('admin')->check())
                                <li class="nav-item bottom-transition mt-2">
                                    <a class="nav-link text-light" href="{{ route('login') }}">{{ __('LOGIN') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register') && !Auth::guard('staff')->check() && !Auth::guard('admin')->check())
                                <li class="nav-item bottom-transition mt-2">
                                    <a class="nav-link text-light" href="{{ route('register') }}">{{ __('REGISTER') }}</a>
                                </li>
                            @endif

                            @if (Route::has('login') && !Auth::guard('staff')->check() && !Auth::guard('admin')->check())
                                <li class="nav-item bottom-transition">
                                    @include('partials.admin-staff-auth')
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
                                        <a class="dropdown-item text-white" href="{{ route('profile.show') }}">
                                            {{ __('PROFILE') }} </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-white" href="{{ route('history.show') }}">
                                            {{ __('HISTORY') }} </a>
                                        <div class="dropdown-divider"></div>
                                    @else
                                        <a class="dropdown-item text-white" href="{{ route('login') }}">
                                            {{ __('Login') }} </a>
                                        <div class="dropdown-divider"></div>
                                    @endauth

                                    <a class="dropdown-item text-white" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('LOGOUT') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>

                            </li>
                        @endvisitor
                        @admin
                            @include('admin.partials.navbar-admin')
                        @endadmin
                        @staff
                            @include('staff.partials.navbar-staff')
                        @endstaff
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
                        <a href="https://www.facebook.com/spartanracePhilippines/" target="_blank">
                            <i class="fa-brands fa-facebook text-light mx-4 fa-xl"></i>
                        </a>
                        <a href="https://twitter.com/spartanphi" target="_blank"><i
                                class="fa-brands fa-twitter text-light mx-4 fa-xl"></i>
                        </a>

                        <a href="https://www.instagram.com/spartanraceph/?hl=en" target="_blank"><i
                                class="fa-brands fa-instagram text-light mx-4 fa-xl"></i></a>

                        <a href="https://www.youtube.com/channel/UCfvYMyK4HA4YJJLV8WvxQsg" target="_blank"><i
                                class="fa-brands fa-youtube text-light mx-4 fa-xl"></i></a>

                    </div>
                    <div class="col-lg-6 opacity-25 text-center ">
                        <img src="{{ asset('/images/spartan-logo-with-word.png') }} " width="250px" alt="">
                    </div>
                </div>
                <div class="row text-light mx-auto f-montserrat my-5">
                    <div class="col-lg-3 col-xs-6 my-1">
                        <a href="https://ph.spartan.com/en" target="_blank"> JOIN AS A RACER</a>
                    </div>
                    <div class="col-lg-3 col-xs-6 my-1">
                        <a href="https://www.spartan.com/pages/global-shop" target="_blank"> SHOP </a>
                    </div>
                    <div class="col-lg-3 col-xs-6 my-1">
                        <a
                            href="https://prettyhuge.com.ph/fitness/blog/a-quick-guide-to-spartan-race-philippines-67/view" target="_blank">
                            BLOG </a>
                    </div>
                    <div class="col-lg-3 col-xs-6 my-1">
                        <a href="https://spartanphilippines.zendesk.com/hc/en-us" target="_blank"> HELP </a>
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