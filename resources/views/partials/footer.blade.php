<!-- Footer -->
<div class="container d-flex items-center justify-content-end py-3 layout">
   <span class="mx-4">{{ __('A project by') }}</span>
   <a href="https://www.commitglobal.org/en">
       <img src="/images/commitglobal.svg" class="inline-block h-5" alt="Commit Global">
   </a>
</div>

<footer class="footer text-white pt-5">
    <div class="container row justify-content-between p-2 mx-auto">
        <div class="d-flex justify-content-between col-12 col-sm-6 ">
            <ul class="list-unstyled px-2">
                <p class="text-white font-weight-bold mb-3">
                    {{ __('Useful links') }}
                </p>
                <li>
                    <a class="nav-link text-white mb-1"
                    href="{{ route('static.pages', ['locale' => app()->getLocale(), 'slug' => $footerNavigation[0]->getSlug()]) }}">{{ __('About the project') }}</a>
                </li>
                <li>
                    <a class="nav-link text-white mb-1" href="https://dopomoha.ro/" target="_blank" rel="noopener">{{ __('Dopomoha.ro') }}</a>
                </li>
                <li>
                    <a class="nav-link text-white mb-1" href="https://sprijindeurgenta.ro/" target="_blank" rel="noopener">{{ __('Sprijin de urgență') }}</a>
                </li>
                <li>
                    <a class="nav-link text-white mb-1" href="#" target="_blank" rel="noopener">{{ __('Source code') }}</a>
                </li>
            </ul>
            <ul class="list-unstyled px-2">
                <p class="text-white font-weight-bold mb-3">
                    {{ __('Legal informations') }}
                </p>
                <li>
                    <a class="nav-link text-white mb-1"
                    href="{{ route('static.pages', ['locale' => app()->getLocale(), 'slug' => $footerNavigation[3]->getSlug()]) }}">{{ __('Confidentiality policy') }}</a>
                </li>
                <li>
                    <a class="nav-link text-white mb-1"
                    href="{{ route('static.pages', ['locale' => app()->getLocale(), 'slug' => $footerNavigation[4]->getSlug()]) }}">{{ __('Terms and conditions') }}</a>
                </li>
            </ul>
        </div>

        <div class="d-flex flex-column align-items-end col-12 col-sm-6 mt-5 pl-2">
            <img src="/images/commitglobal.svg" class="inline-block h-5" alt="">
            <p class="m-0">&copy {{ __('Copyright') }}</p>
            <p> {{ __('An independent, non-partisan, non-political, non-govermental organization.') }}</p>
        </div>
    </div>
</footer>
