<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/images/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/images/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#00b0ea">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('/css/nucleo-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/css/nucleo-svg.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/css/font-awesome.css') }}" rel="stylesheet"/>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ mix('/css/argon-design-system.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/jquery.fileuploader.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/fonts/font-fileuploader.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-201038828-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-201038828-1');
    </script>

</head>
<body>
    <div id="app" class="admin-area">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/logo.png" height="30" alt="{{ config('app.name', 'Împreună pentru sănătate') }}">
                </a>
                <h5 class="ml-4 font-weight-600 text-muted d-none d-sm-block">Help for Health Administration</h5>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item align-self-md-center">
                            <a class="btn btn-primary btn-sm" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->isAdministrator())
                                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                        {{ __('My Profile') }}
                                    </a>
                                @elseif (Auth::user()->isHost())
                                    <a class="dropdown-item" href="{{ route('host.profile') }}">
                                        {{ __('My Profile') }}
                                    </a>
                                @endif

                                <a class="dropdown-item" href="{{ route('2fa.form') }}">
                                    {{ __('2FA') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                @endguest
                </ul>
                <button class="navbar-toggler ml-4" type="button" id="sidebar-collapse" aria-label="{{ __('Toggle navigation') }}">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar top-bar"></span>
                    <span class="icon-bar middle-bar"></span>
                    <span class="icon-bar bottom-bar"></span>
                </button>
            </div>
        </nav>
        <div class="d-flex">
            <div class="sidebar border-right">
                <div class="list-group list-group-flush mt-2 mt-sm-4">
                @if (Auth::user()->isAdministrator(App\User::ROLE_ADMINISTRATOR))
                    <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
                        <i class="fa fa-bar-chart mr-3"></i>Dashboard
                    </a>
                    <!-- New buttons, routes need to be added, and also active checks, like for Dashboard -->
                    <a href="#" class="list-group-item list-group-item-action ">
                        <i class="fa fa-bed mr-3"></i>Oferte cazări
                    </a>
                        <a href="#" class="list-group-item list-group-item-action sub-list ">
                            <i class="fa fa-minus mx-3"></i>Aprobate
                        </a>
                        <a href="#" class="list-group-item list-group-item-action sub-list ">
                            <i class="fa fa-minus mx-3"></i>În curs de aprobare
                        </a>
                    <a href="#" class="list-group-item list-group-item-action ">
                        <img src="/images/hand-icon.svg" class="mr-3">Solicitări cazări
                    </a>
                    <a href="#" class="list-group-item list-group-item-action ">
                        <i class="fa fa-users mr-3"></i>Utilizatori
                    </a>
                    <a href="#" class="list-group-item list-group-item-action ">
                        <i class="fa fa-bell mr-3"></i>Notificări
                    </a>
                    <!-- New buttons end -->
                @elseif (Auth::user()->isHost())
                    <a href="{{ route('host.profile') }}" class="list-group-item list-group-item-action {{ in_array(Route::currentRouteName(), ['host.profile', 'host.edit-profile', 'host.reset-password']) ? 'active' : '' }}">
                        <i class="fa fa-user mr-3"></i>Profilul meu
                    </a>
                    <a href="{{ route('host.accommodation') }}" class="list-group-item list-group-item-action {{ in_array(Route::currentRouteName(), ['host.accommodation', 'host.add-accommodation', 'host.view-accommodation', 'host.edit-accommodation']) ? 'active' : '' }}">
                        <i class="fa fa-user mr-3"></i>Cazare
                    </a>
                @endif
                </div>
                <!-- New buttons, routes need to be added, and also active checks, like for Dashboard -->
                <div class="list-group list-group-flush list-group-bottom mt-2 mt-sm-4 pb-5">
                    <span class="list-group-item list-group-header">
                        {{ Auth::user()->name }}
                    </span>
                    <a href="#" class="list-group-item list-group-item-action ">
                        <i class="fa fa-user mr-3"></i>Contul meu
                    </a>
                    <a href="{{ route('logout') }}" class="list-group-item list-group-item-action "
                        onclick="event.preventDefault(); 
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-power-off mr-3"></i>Ieși din cont
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                <!-- New buttons end -->
            </div>
            <div class="page-wrapper">
                <main class="pt-4 p-sm-5">
                    @if(Session::has('success'))
                    <div class="alert alert-secondary d-flex align-items-center">
                        <i class="fa fa-check text-white mr-3"></i>
                        <h6 class="mb-0 font-weight-600 text-white">
                            {{ Session::get('success') }}
                        </h6>
                    </div>
                    @elseif(Session::has('fail'))
                        <div class="alert alert-danger d-flex align-items-center">
                            <i class="fa fa-check text-white mr-3"></i>
                            <h6 class="mb-0 font-weight-600 text-white">
                                {{ Session::get('fail') }}
                            </h6>
                        </div>
                    @endif

                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/moment-with-locales.min.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ mix('js/admin.js') }}" defer></script>
    <script src="{{ mix('js/argon-design-system.js')}}"></script>
    <script src="{{ asset('js/jquery.fileuploader.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.sticky-sidebar.min.js') }}" defer></script>
    @yield('scripts')

    @yield('templates')
</body>
</html>
