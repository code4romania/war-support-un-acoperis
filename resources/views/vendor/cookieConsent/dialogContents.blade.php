<div class="js-cookie-consent cookie-consent fixed-bottom p-2 bg-primary text-white text-center">

    <span class="cookie-consent__message">
        {!! trans('cookieConsent::texts.message') !!}
    </span>

    <a href="{{ route('static.pages', ['locale' => app()->getLocale(), 'slug' => $footerNavigation[4]->getSlug()]) }}">{{ __('Află detalii aici.') }}</a>

    <button class="js-cookie-consent-agree cookie-consent__agree btn btn-success">
        {{ trans('cookieConsent::texts.agree') }}
    </button>

</div>
