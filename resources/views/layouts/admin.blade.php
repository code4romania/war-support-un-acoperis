@include('layouts.partials.head')
<body>
<div id="app" class="admin-area">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="/images/logo.png" height="30" alt="{{ config('app.name', 'Împreună pentru sănătate') }}">
            </a>
            <div class="inline-flex items-center justify-content-between py-4">
                <div class="grid items-center">
                    <a href="http://www.dsu.mai.gov.ro/" target="_blank" rel="noopener" class="inline-block ml-4">
                        <img src="{{ url('/images/dsu.png') }}" class="inline-block h-5" alt="">
                    </a>
                    <a href="https://code4.ro" target="_blank" rel="noopener" class="inline-block ml-4">
                        <img src="{{ url('/images/code4romania.svg') }}" class="inline-block h-5" alt="">
                    </a>
                </div>
            </div>
            <!-- Right Side Of Navbar -->
            <button class="navbar-toggler ml-4" type="button" id="sidebar-collapse"
                    aria-label="{{ __('Toggle navigation') }}">
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
                @include(\App\Services\Helper::getSidebar())
            </div>
            <!-- New buttons, routes need to be added, and also active checks, like for Dashboard -->
            <div class="list-group list-group-flush list-group-bottom mt-2 mt-sm-4 pb-5">
                    <span class="list-group-item list-group-header">
                        {{ Auth::user()->name }}
                    </span>
                <a href="#" class="list-group-item list-group-item-action ">
                    <i class="fa fa-user mr-3"></i>{{__('My account')}}
                </a>

                <a class="list-group-item list-group-item-action " href="{{ route('2fa.form') }}">
                    <i class="fa fa-mobile mr-3"></i> {{ __('2FA') }}
                </a>
                <a href="{{ route('logout', ['locale' => app()->getLocale()]) }}" class="list-group-item list-group-item-action "
                   onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <i class="fa fa-power-off mr-3"></i>{{__('Logout')}}
                </a>

                <form id="logout-form" action="{{ route('logout', ['locale' => app()->getLocale()]) }}" method="POST" style="display: none;">
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
