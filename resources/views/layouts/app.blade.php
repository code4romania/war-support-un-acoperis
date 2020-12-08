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
    <link rel="manifest" href=/images/favicon/manifest.json">
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
    @yield('head-scripts')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/logo-h4h.png" height="75" alt="{{ config('app.name', 'Împreună pentru sănătate') }}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="navbar-collapse-header">
                        <div class="row">
                            <div class="col-6 collapse-brand">
                                <a href="{{ url('/') }}">
                                    <img src="/images/logo-h4h.svg" alt="{{ config('app.name') }}">
                                </a>
                            </div>
                            <div class="col-6 collapse-close">
                                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @foreach ($headerNavigation as $navigation)
                            <li class="nav-item">
                                <a class="nav-link {{ Route::current()->parameter('slug') == $navigation->getSlug() ? 'active' : '' }}"
                                   href="{{ route('static.pages', ['locale' => app()->getLocale(), 'slug' => $navigation->getSlug()]) }}">{{ $navigation->title }}</a>
                            </li>
                        @endforeach

                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'request-services' ? 'active' : '' }}" href="{{ route('request-services') }}">
                                {{ __('Request Services') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'get-involved' ? 'active' : '' }}" href="{{ route('get-involved') }}">
                                {{ __('Get Involved') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ in_array(Route::currentRouteName(), ['clinic-list', 'clinic-details']) ? 'active' : '' }}" href="{{ route('clinic-list') }}">
                                {{ __('Clinic List') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-secondary text-underline {{ Route::currentRouteName() == 'donate' ? 'active' : '' }}" href="https://asociatiamame.ro/crowdfunding/doneaza/" target="_blank" rel="noopener">
                                {{ __('Donate') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link{{ Route::currentRouteName() == 'contact' ? ' active' : '' }}" href="{{ route('contact') }}">
                                {{ __('Contact') }}
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-md-4">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item align-self-md-center">
                                <a class="btn btn-primary btn-sm mr-sm-2" href="{{ route('login') }}">{{ __('Login host') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->isAdministrator())
                                        <a class="dropdown-item" href="{{ route('admin.dashboard', ['locale' => app()->getLocale()]) }}">
                                            <i class="fa fa-wrench"></i> {{ __('Administration Panel') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                            {{ __('My Profile') }}
                                        </a>
                                    @elseif (Auth::user()->isHost())
                                        <a class="dropdown-item" href="{{ route('host.profile', ['locale' => app()->getLocale()]) }}">
                                            <i class="fa fa-wrench"></i> {{ __('Administration Panel') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('host.profile') }}">
                                            {{ __('My Profile') }}
                                        </a>
                                    @endif


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

                        <!-- Language switcher -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle language-switch" href="#" id="navbar-default_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>{{ strtoupper(str_replace('_', '-', app()->getLocale())) }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
                                @php
                                    $params = request()->route()->parameters();
                                    $ro = $en = $params;
                                    $ro['locale'] = 'ro';
                                    $en['locale'] = 'en';
                                @endphp
                                <a class="dropdown-item ro-language" href="{{ route(Route::currentRouteName(), \App\Helpers\RouteHelper::translateCurrentSlug($ro)) }}">RO</a>
                                <a class="dropdown-item en-language" href="{{ route(Route::currentRouteName(), \App\Helpers\RouteHelper::translateCurrentSlug($en)) }}">EN</a>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        @include('partials.footer')
    </div>
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/moment-with-locales.min.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/argon-design-system.js')}}"></script>
    @yield('scripts')
    @include('cookieConsent::index')
</body>
</html>
