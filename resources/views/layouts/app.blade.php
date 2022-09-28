@include('layouts.partials.head')
<body>
    <div id="app">
        @include('partials.banner')

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    @if (in_array(app()->getLocale(), ['uk', 'ru']))
                        <img src="/images/logo-lang-ua.svg" alt="Prytulok u rumunii">
                    @else
                        <img src="/images/logo-lang-ro.svg" alt="Un acoperiș">
                    @endif
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="navbar-collapse-header">
                        <div class="row">
                            <div class="col-6 collapse-brand">
                                <a href="{{ url('/') }}">
                                    @if (app()->getLocale() === 'ua' || app()->getLocale() === 'ru')
                                        <img src="/images/logo-lang-ua.svg" alt="Prytulok u rumunii">
                                    @else
                                        <img src="/images/logo-lang-ro.svg" alt="Un acoperiș">
                                    @endif
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
                            <a class="nav-link {{ Route::current()->parameter('slug') == $navigation->getSlug() ? 'active' : '' }}" href="{{ route('static.pages', ['locale' => app()->getLocale(), 'slug' => $navigation->getSlug()]) }}">{{ $navigation->title }}</a>
                        </li>
                        @endforeach

                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'request-services' ? 'active' : '' }}" href="{{ route('request-services') }}">
                                {{ __('Request Accommodation') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'get-involved' ? 'active' : '' }}" href="{{ route('get-involved') }}">
                                {{ __('Offer Accommodation') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'contact' ? 'active' : '' }}" href="{{ route('contact') }}">
                                {{ __('Contact') }}
                            </a>
                        </li>

                    </ul>
                    @include('partials.auth')
                        {{--
                        <li class="nav-item">
                            <a class="nav-link{{ Route::currentRouteName() == 'contact' ? ' active' : '' }}" href="{{ route('contact') }}">
                                {{ __('Contact') }}
                            </a>
                        </li>
                        --}}

                        <!-- Language switcher -->
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle language-switch" href="#" id="navbar-default_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="lang-icon"></i>
                                <span>{{ config('translatable.locales_name')[app()->getLocale()] ?? strtoupper(app()->getLocale()) }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
                                @foreach(config('translatable.locales') as $locale)
                                    <a class="dropdown-item {{ $locale }}-language" href="{{
                                        route(Route::currentRouteName(), array_merge(
                                            Arr::wrap(request()->route()->parameters()),
                                            \App\Helpers\RouteHelper::translateCurrentSlug([
                                                'locale' => $locale,
                                                'slug' => Route::getCurrentRoute()->parameter("slug")
                                            ])
                                        ))
                                        }}">
                                        {{ config('translatable.locales_name')[$locale] ?? strtoupper($locale) }}
                                    </a>
                                @endforeach
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <div class="container">
            @include('partials.partners')
        </div>

        <main>
            @yield('content')
        </main>

        @include('partials.footer')
    </div>
    <div class="modal fade" id="ie11Modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title mb-5">
                        {{ __('IE11') }}
                    </h5>

                    <div class="card-columns">
                        <div class="card shadow-none mb-0">
                            <img class="card-img-top w-50 mx-auto d-block" src="/images/browsers/e.png" alt="Microsoft Edge">
                            <div class="card-body">
                                <h5 class="card-title text-center">Edge</h5>
                                <p class="card-text small text-center">Microsoft</p>
                                <a href="https://www.microsoft.com/edge" rel="noopener noreferrer" target="_blank" class="btn btn-primary mx-auto d-block">{{ __('Download') }}</a>
                            </div>
                        </div>
                        <div class="card shadow-none mb-0">
                            <img class="card-img-top w-50 mx-auto d-block" src="/images/browsers/c.png" alt="Microsoft Edge">
                            <div class="card-body">
                                <h5 class="card-title text-center">Chrome</h5>
                                <p class="card-text small text-center">Google</p>
                                <a href="https://www.google.com/chrome/browser/desktop/" rel="noopener noreferrer" target="_blank" class="btn btn-primary mx-auto d-block">{{ __('Download') }}</a>
                            </div>
                        </div>
                        <div class="card shadow-none mb-0">
                            <img class="card-img-top w-50 mx-auto d-block" src="/images/browsers/f.png" alt="Microsoft Edge">
                            <div class="card-body">
                                <h5 class="card-title text-center">Firefox</h5>
                                <p class="card-text small text-center">Mozilla</p>
                                <a href="https://www.mozilla.org/firefox/new" rel="noopener noreferrer" target="_blank" class="btn btn-primary mx-auto d-block">{{ __('Download') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ mix('js/browser-detect.umd.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const browser = browserDetect();
            if (browser.name === 'ie' && browser.version.substring(0, 2) === '11') {
                let modal = document.getElementById('ie11Modal');
                modal.classList.add('show');
                modal.style.display = 'block';
            }
        });
    </script>
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/moment-with-locales.min.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/argon-design-system.js') }}"></script>
    <script src="{{ asset('js/jquery.fileuploader.min.js') }}" defer></script>

    @yield('scripts')
    @yield('templates')
    @include('cookieConsent::index')
</body>

</html>
