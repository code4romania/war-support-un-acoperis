<!-- Footer -->
<footer class="footer pt-0 bg-brand-blue text-white">
    <div class="container pt-4">
        @yield('homepage-partners')
        <ul class="d-flex justify-content-around list-unstyled align-items-center flex-column flex-sm-row pb-4 border-bottom border-bottom-dark">
            <li>
                <a class="nav-link text-white mb-2 mb-sm-0"
                   href="{{ route('static.pages', ['locale' => app()->getLocale(), 'slug' => $footerNavigation[5]->getSlug()]) }}">{{ __('FAQ') }}</a>
            </li>
            <li>
                <a class="nav-link text-white mb-2 mb-sm-0"
                   href="{{ route('static.pages', ['locale' => app()->getLocale(), 'slug' => $footerNavigation[1]->getSlug()]) }}">{{ __('Media') }}</a>
            </li>
            <li>
                <a class="nav-link text-white mb-2 mb-sm-0"
                   href="{{ route('static.pages', ['locale' => app()->getLocale(), 'slug' => $footerNavigation[2]->getSlug()]) }}">{{ __('News') }}</a>
            </li>
            <li>
                <a class="nav-link text-white mb-2 mb-sm-0"
                   href="{{ route('static.pages', ['locale' => app()->getLocale(), 'slug' => $footerNavigation[3]->getSlug()]) }}">{{ __('Confidentiality policy') }}</a>
            </li>
            <li>
                <a class="nav-link text-white mb-2 mb-sm-0"
                   href="{{ route('static.pages', ['locale' => app()->getLocale(), 'slug' => $footerNavigation[4]->getSlug()]) }}">{{ __('Terms and conditions') }}</a>
            </li>
            <li>
                <a class="text-white btn btn-primary" href="https://asociatiamame.ro/crowdfunding/doneaza/" target="_blank" rel="noopener">{{ __('Support this project') }}</a>
            </li>
        </ul>
        <ul class="d-flex justify-content-around list-unstyled align-items-center flex-column flex-sm-row mb-3 small">
            <li>
                <span class="nav-link text-white">
                  {{ __('For more details, contact Asociația MAME') }}
                </span>
            </li>
            <li>
                <span class="nav-link text-white">
                   {{ __('Phone Number') }}: <a class="text-white" href="tel: (+40) 734.949.281">(+40) 734.949.281</a>
                </span>
            </li>
            <li>
                <span class="nav-link text-white">
                    {{ __('Email') }}: <a class="text-white" href="mailto:ajutor@asociatiamame.com">ajutor@asociatiamame.com</a>
                </span>
            </li>
            <li>
                <span class="nav-link text-white">
                    {{ __('Website') }}: <a class="text-white" href="https://asociatiamame.ro" target="_blank" rel="noopener">www.asociatiamame.ro</a>
                </span>
            </li>
        </ul>
        <div class="container m-auto">
            <div class="row align-items-center pt-3">
        @if(\Request::route()->getName() == 'home')
                    <div class="col-md-12">
                        <ul class="d-flex justify-content-center list-unstyled align-items-center flex-sm-row social-buttons">
                            @include('frontend.social')
                        </ul>
                    </div>
        @else
            <div class="col-md-6 ">
                <ul class="d-flex justify-content-left list-unstyled align-items-center flex-sm-row social-buttons">
                    @include('frontend.social')
                </ul>
            </div>
            <div class="col-md-6 text-sm-right text-left d-flex justify-content-sm-end footer-logos">
                <a href="https://fundatia-vodafone.ro/" class="ml-0">
                    <img src="/images/logo-fvr-white.svg" height="32" alt="Fundația Vodafone România" title="Fundația Vodafone România">
                </a>
                <a href="https://www.asociatiamame.ro/" class="ml-5">
                    <img src="/images/asociatia-mame-white-logo.png" height="38" alt="Asociatia Mame" title="Asociatia Mame">
                </a>
                <a href="https://code4.ro/ro/" class="ml-5">
                    <img src="/images/LogoCode4RO.png" height="30" alt="Code for Romania" title="Code for Romania">
                </a>
            </div>
        @endif
            </div>
        </div>
    </div>
</footer>
