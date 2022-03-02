<!-- Right Side Of Navbar -->
<ul class="navbar-nav ml-md-4">
    <!-- Authentication Links -->
    @guest
        <li class="nav-item align-self-md-center">
            <a class="btn btn-secondary mr-sm-2" href="{{ route('login') }}">{{ __('Login host') }}</a>
        </li>
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                @if (Auth::user()->isAuthorized(\App\User::ROLE_ADMINISTRATOR))
                    <a class="dropdown-item" href="{{ route('admin.dashboard', ['locale' => app()->getLocale()]) }}">
                        <i class="fa fa-wrench"></i> {{ __('Administration Panel') }}
                    </a>
                @endif
                    <a class="dropdown-item" href="{{ route(\App\Services\Helper::getProfileRouteName()) }}">
                        {{ __('My Profile') }}
                    </a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
@endguest
