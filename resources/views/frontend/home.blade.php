@extends('layouts.app')

@section('content')
    <div class="container py-sm-6 py-3">
        @if (session('status'))
            <div
                class="alert alert-success"
                role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="d-flex align-items-sm-center flex-column flex-sm-row">
            <img
                src="/images/banner-homepage.png"
                class="w-100">
            <div class="banner-content ml-sm-5 mt-3 mt-sm-0">
                <h1 class="text-secondary font-weight-600 mb-sm-4 mb-2">{{ $welcomeTitle }}</h1>
                <p class="mb-sm-5 mb-3">{!! $welcomeBody !!}</p>
                <a
                    href="{{ route('request-services') }}"
                    class="btn btn-lg btn-primary mr-3 px-sm-5">{{ __('Request Accommodation') }}</a>
                <a
                    href="{{ route('get-involved') }}"
                    class="btn btn-lg btn-secondary px-sm-5">{{ __('Offer Accommodation') }}</a>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row text-center">
            <div class="col-sm">
                <div class="p-4">
                    <img
                        src="/images/helpRequests.png"
                        class="card-img-top w-25 mt-4 mb-2 mx-auto"
                        alt="Help requests">
                    <p class="h4">
                        <b> {{ $helpRequests }} </b> {{ __('Accommodation requests' )}}
                    </p>
                </div>
            </div>
            <div class="col-sm">
                <div class="p-4">
                    <img
                        src="/images/freeAccommodations.png"
                        class="card-img-top w-25 mt-4 mb-2 mx-auto"
                        alt="Available accommodations">
                    <p class="h4">
                        <b> {{ $freeAccommodations }}</b> {{ __('Available accommodations') }}
                    </p>
                </div>
            </div>
            <div class="col-sm">
                <div class="p-4">
                    <img
                        src="/images/providedAccommodations.png"
                        class="card-img-top w-25 mt-4 mb-2  mx-auto"
                        alt="Fulfilled accommodations">
                    <p class="h4">
                        <b> {{ $providedAccommodations }}</b> {{ __('Fulfilled accommodations') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-holder">
        <div class="container text-white">
            <div class="row d-flex align-items-stretch">
                <div class="col-sm-6">
                    <div class="strech-bg py-5 pr-sm-6 h-100">
                        <h2 class="text-white font-weight-600 mb-4">{{ $askServicesTitle }}</h2>
                        <p>
                            {!! $askServicesBody !!}
                        </p>
                        <a
                            href="{{ route('request-services') }}"
                            class="btn btn-white text-secondary btn-lg px-6 mt-4">{{ __('Request Accommodation') }}</a>
                    </div>
                </div>
                <div class="col-sm-6 py-5 pl-sm-6">
                    <div class="h-100">
                        <h2 class="text-white font-weight-600 mb-4">{{ $becomeHostTitle }}</h2>
                        <p>
                            {!! $becomeHostBody !!}
                        </p>
                        <a
                            href="{{ route('get-involved') }}"
                            class="btn btn-white text-primary btn-lg px-6 mt-4">{{ __('Offer Accommodation') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-homepage-section-1 mt-2 py-5">
        <div class="container">
            <h2
                class="text-center font-weight-600 mb-5"
                style="color: $primary">{{ $helpTitle }}</h2>

            <div class="card-deck how-can-we-help">
                <div class="card">
                    <div class="card-header">
                        <img src="/images/projects/dopomoha.svg" alt="">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title font-weight-600">{{ $helpBlock1Title }}</h5>
                        <p class="card-text mb-3">{!! $helpBlock1Body !!}</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <img src="/images/projects/sprijin-de-urgenta.svg" alt="">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title font-weight-600">{{ $helpBlock2Title }}</h5>
                        <p class="card-text mb-3">{!! $helpBlock2Body !!}</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <img src="/images/projects/un-acoperis.svg" alt="">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title font-weight-600">{{ $helpBlock3Title }}</h5>
                        <p class="card-text mb-3">{!! $helpBlock3Body !!}</p>
                    </div>
                </div>
                {{-- <div class="card">
                    <img
                        src="/images/homepage-icon-2-1.png"
                        class="card-img-top mt-4 w-75 mx-auto"
                        alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-600">{{ $helpBlock4Title }}</h5>
                        <p class="card-text mb-3">{!! $helpBlock4Body !!}</p>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    {{-- <div class="py-5">
        <div class="container">
            <h2 class="text-primary font-weight-600 mb-5">{{ $aboutTitle }}</h2>
            <div class="row">
                <div class="col-sm-8">
                    <p>{!! $aboutBody !!}</p>
                </div>
                <div class="col-sm-4 px-sm-5 homepage-logo">
                    <img
                        src="/images/logo-icon-h4h.png"
                        class="w-100"
                        alt="">
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="container py-5">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="text-secondary font-weight-600 mb-4">{{ $footerBlock1Title }}</h2>
                <p>
                    {!! $footerBlock1Body !!}
                </p>
            </div>
            <div class="col-sm-6">
                <h2 class="text-secondary font-weight-600 mb-4">{{ $footerBlock2Title }}</h2>
                <p>
                    {!! $footerBlock2Body !!}
                </p>
            </div>
        </div>
    </div> --}}
@endsection

@section('homepage-partners')
    @include('site.blocks.homepage-partners')
@endsection
