<!-- Footer -->
<footer class="footer pt-0 bg-brand-blue text-white">
    <div class="container pt-4">
        <ul class="d-flex list-unstyled flex-column flex-sm-row justify-content-center align-items-center mt-3 mb-6">
            <li class="mx-5">
                <a href="#" class="nav-link text-white d-flex align-items-center mb-4 mb-sm-0">
                   {{ __("project released by") }}
                    <img src="/images/logo-mame-white.svg" height="34" alt="" class="ml-3 align-middle">
                </a>
            </li>
            <li class="mx-5">
                <a href="#" class="nav-link text-white d-flex align-items-center mb-4 mb-sm-0">
                    {{ __("project incubated in") }}
                    <img src="/images/logo-civiclabs-white.svg" height="20" alt="" class="ml-3 align-middle">
                </a>
            </li>
            <li class="mx-5">
                <a href="#" class="nav-link text-white d-flex align-items-center mb-4 mb-sm-0">
                    {{ __("project financed by") }}
                    <img src="/images/logo-fvr-white.svg" height="40" alt="" class="ml-3 align-middle">
                </a>
            </li>
        </ul>

        <ul class="d-flex justify-content-around list-unstyled align-items-center flex-column flex-sm-row pb-4 border-bottom border-white">
            <li>
                <a class="nav-link text-white  mb-2 mb-sm-0" href="{{ route('partners') }}">{{ __('Partners') }}</a>
            </li>
            <li>
                <a class="nav-link text-white  mb-2 mb-sm-0" href="{{ route('about') }}">{{ __('About Help For Health') }}</a>
            </li>
            <li>
                <a class="nav-link text-white  mb-2 mb-sm-0" href="{{ route('media') }}">{{ __('Media') }}</a>
            </li>
            <li>
                <a class="nav-link text-white  mb-2 mb-sm-0" href="{{ route('news') }}">{{ __('News') }}</a>
            </li>
            <li>
                <a class="nav-link text-white  mb-2 mb-sm-0" href="{{ route('privacy-policy') }}">{{ __('Confidentiality policy') }}</a>
            </li>
            <li>
                <a class="nav-link text-white  mb-2 mb-sm-0" href="{{ route('terms-and-conditions') }}">{{ __('Terms and conditions') }}</a>
            </li>
            <li>
                <a class="text-white btn btn-secondary" href="https://asociatiamame.ro/crowdfunding/doneaza/" target="_blank" rel="noopener">{{ __('Support this project') }}</a>
            </li>
        </ul>
        <ul class="d-flex justify-content-around list-unstyled align-items-center flex-column flex-sm-row mb-3 small">
            <li>
                <span class="nav-link text-white-50">
                  {{ __('If you need help please contact Asociația MAME') }}
                </span>
            </li>
            <li>
                <span class="nav-link text-white-50">
                   {{ __('Phone Number') }}: <a class="text-white-50" href="tel: (+40) 734.949.281">(+40) 734.949.281</a>
                </span>
            </li>
            <li>
                <span class="nav-link text-white-50">
                    {{ __('Email') }}: <a class="text-white-50" href="mailto:ajutor@asociatiamame.com">ajutor@asociatiamame.com</a>
                </span>
            </li>
            <li>
                <span class="nav-link text-white-50">
                    {{ __('Website') }}: <a class="text-white-50" href="https://asociatiamame.ro" target="_blank" rel="noopener">www.asociatiamame.ro</a>
                </span>
            </li>
        </ul>
        <ul class="d-flex justify-content-center list-unstyled align-items-center flex-sm-row mt-5 mb-3 social-buttons">
            <li class="mx-3">
                <a href="https://www.facebook.com/AsocMAME" target="_blank" rel="noopener"><i class="fa fa-facebook text-white"></i></a>
            </li>
            <li class="mx-3">
                <a href="https://www.instagram.com/asociatiamame/" target="_blank" rel="noopener"><i class="fa fa-instagram text-white"></i></a>
            </li>
            <li class="mx-3">
                <a href="https://www.youtube.com/channel/UCqFuHLZSiMR4_BTEZveMPXg" target="_blank" rel="noopener"><i class="fa fa-youtube text-white"></i></a>
            </li>
            <li class="mx-3">
                <a href="https://github.com/code4romania/help-for-health" target="_blank" rel="noopener"><i class="fa fa-github text-white"></i></a>
            </li>
        </ul>
    </div>
</footer>
