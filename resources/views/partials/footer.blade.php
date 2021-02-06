<!-- Footer -->
<footer class="footer pt-0 bg-brand-blue text-white">
    <div class="container pt-4">
        @include('site.blocks.homepage-partners')

        <ul class="d-flex justify-content-around list-unstyled align-items-center flex-column flex-sm-row pb-4 border-bottom border-bottom-dark">
            <li>
                <a class="nav-link text-white mb-2 mb-sm-0"
                   href="{{ route('static.pages', ['locale' => app()->getLocale(), 'slug' => $footerNavigation[1]->getSlug()]) }}">{{ __('About the project') }}</a>
            </li>
            <li>
                <a class="nav-link text-white mb-2 mb-sm-0"
                   href="{{ route('static.pages', ['locale' => app()->getLocale(), 'slug' => $footerNavigation[6]->getSlug()]) }}">{{ __('FAQ') }}</a>
            </li>
            <li>
                <a class="nav-link text-white mb-2 mb-sm-0"
                   href="{{ route('static.pages', ['locale' => app()->getLocale(), 'slug' => $footerNavigation[2]->getSlug()]) }}">{{ __('Media') }}</a>
            </li>
            <li>
                <a class="nav-link text-white mb-2 mb-sm-0"
                   href="{{ route('static.pages', ['locale' => app()->getLocale(), 'slug' => $footerNavigation[3]->getSlug()]) }}">{{ __('News') }}</a>
            </li>
            <li>
                <a class="nav-link text-white mb-2 mb-sm-0"
                   href="{{ route('static.pages', ['locale' => app()->getLocale(), 'slug' => $footerNavigation[4]->getSlug()]) }}">{{ __('Confidentiality policy') }}</a>
            </li>
            <li>
                <a class="nav-link text-white mb-2 mb-sm-0"
                   href="{{ route('static.pages', ['locale' => app()->getLocale(), 'slug' => $footerNavigation[5]->getSlug()]) }}">{{ __('Terms and conditions') }}</a>
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
