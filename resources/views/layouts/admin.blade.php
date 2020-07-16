<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('/css/nucleo-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/css/nucleo-svg.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/css/font-awesome.css') }}" rel="stylesheet"/>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ mix('/css/argon-design-system.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/logo-hfh.svg" height="75" alt="{{ config('app.name', 'Laravel') }}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'about' ? 'active' : '' }}" href="{{ route('about') }}">
                                {{ __('About') }}
                            </a>
                        </li>

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
                            <a class="nav-link {{ Route::currentRouteName() == 'clinic-list' ? 'active' : '' }}" href="{{ route('clinic-list') }}">
                                {{ __('Clinic List') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'donate' ? 'active' : '' }}" href="{{ route('donate') }}">
                                {{ __('Donate') }}
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-md-4">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                                    $ro = $en = $de = $hu = $params;
                                    $ro['locale'] = 'ro';
                                    $de['locale'] = 'de';
                                    $en['locale'] = 'en';
                                    $hu['locale'] = 'hu';
                                @endphp
                                <a class="dropdown-item ro-language" href="{{ route(Route::currentRouteName(), $ro) }}">RO</a>
                                <a class="dropdown-item en-language" href="{{ route(Route::currentRouteName(), $en) }}">EN</a>
                                <a class="dropdown-item de-language" href="{{ route(Route::currentRouteName(), $de) }}">DE</a>
                                <a class="dropdown-item hu-language" href="{{ route(Route::currentRouteName(), $hu) }}">HU</a>
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
    <script src="{{ mix('/js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
