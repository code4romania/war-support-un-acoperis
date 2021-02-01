@extends('layouts.app')

@section('content')
    <div class="container py-sm-6 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="d-flex align-items-sm-center flex-column flex-sm-row">
            <img src="/images/banner-homepage-new.png" alt="Help for Health" srcset="/images/banner-homepage-new@2x.png 2x" class="w-100">
            <div class="banner-content ml-sm-5 mt-3 mt-sm-0">
                <h1 class="text-primary font-weight-600 mb-sm-4 mb-2">{{ $welcomeTitle }}</h1>
                <p class="mb-sm-5 mb-3">{!! $welcomeBody !!}</p>
                <a href="{{ route('request-services') }}" class="btn btn-lg btn-primary mr-3 px-sm-5">{{ __('Request Help') }}</a>
                <a href="{{ route('get-involved') }}" class="btn btn-lg btn-secondary px-sm-5">{{ __('Offer Help') }}</a>
            </div>
        </div>
    </div>
    <div class="bg-homepage-section-1 mt-2 py-5">
        <div class="container">
            <h2 class="text-center font-weight-600 mb-5" style="color: #2574B8">{{ $helpTitle }}</h2>
            <div class="card-deck how-can-we-help">
                <div class="card text-center shadow-sm">
                    <img src="/images/homepage-icon-4.png"  class="card-img-top mt-4 w-75 mx-auto" alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-600">{{ $helpBlock1Title }}</h5>
                        <p class="card-text mb-3">{!! $helpBlock1Body !!}</p>
                    </div>
                </div>
                <div class="card text-center shadow-sm">
                    <img src="/images/homepage-icon-3.png"  class="card-img-top mt-4 w-75 mx-auto" alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-600">{{ $helpBlock2Title }}</h5>
                        <p class="card-text mb-3">{!! $helpBlock2Body !!}</p>
                    </div>
                </div>
                <div class="card text-center shadow-sm">
                    <img src="/images/homepage-icon-1.png"  class="card-img-top mt-4 w-75 mx-auto" alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-600">{{ $helpBlock3Title }}</h5>
                        <p class="card-text mb-3">{!! $helpBlock3Body !!}</p>
                    </div>
                </div>
                <div class="card text-center shadow-sm">
                    <img src="/images/homepage-icon-2.png"  class="card-img-top mt-4 w-75 mx-auto" alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-600">{{ $helpBlock4Title }}</h5>
                        <p class="card-text mb-3">{!! $helpBlock4Body !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5 d-none">
        <div class="container">
            <h2 class="text-primary font-weight-600 mb-5">{{ $aboutTitle }}</h2>
            <div class="row">
                <div class="col-sm-8">
                    <p>{!! $aboutBody !!}</p>
                </div>
                <div class="col-sm-4 px-sm-5 homepage-logo">
                    <img src="/images/logo-icon-h4h.png" class="w-100" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="container-holder">
        <div class="container text-white">
            <div class="row d-flex align-items-stretch">
                <div class="col-sm-6">
                    <div class="strech-bg py-5 pr-sm-6">
                        <h2 class="text-white font-weight-600 mb-4">{{ $askServicesTitle }}</h2>
                        <p>
                            {!! $askServicesBody !!}
                        </p>
                        <a href="{{ $askServicesLink }}" class="btn btn-white text-secondary btn-lg px-6 mt-4">{{ __('Read More') }}</a>
                    </div>
                </div>
                <div class="col-sm-6 py-5 pl-sm-6">
                    <h2 class="text-white font-weight-600 mb-4">{{ $becomeHostTitle }}</h2>
                    <p>
                        {!! $becomeHostBody !!}
                    </p>
                    <a href="{{ $becomeHostLink }}" class="btn btn-white text-primary btn-lg px-6 mt-4">{{ __('Partners List') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="text-primary font-weight-600 mb-4">{{ $footerBlock1Title }}</h2>
                <p>
                    {!! $footerBlock1Body !!}
                </p>
            </div>
            <div class="col-sm-6">
                <h2 class="text-primary font-weight-600 mb-4">{{ $footerBlock2Title }}</h2>
                <p>
                    {!! $footerBlock2Body !!}
                </p>
            </div>
        </div>
    </div>
@endsection
