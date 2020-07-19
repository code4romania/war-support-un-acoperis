@extends('layouts.app')

@section('content')
    <div class="container pt-sm-6 pb-sm-5 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="display-3 title mb-4 text-primary">{{ __('Partners') }}</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>
    </div>
    <section class="py-5 bg-light-blue">
        <div class="container">
            <h2 class="font-weight-600 mb-4">Parteneri</h2>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-lg--hover">
                        <div class="logo-container">
                            <a href="">
                                <img src="/images/logo-FVR.svg" class="w-100">
                            </a>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title font-weight-600">
                                <a href="">Fundatia Vodafone Romania</a>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-lg--hover">
                        <div class="logo-container">
                            <a href="">
                                <img src="/images/logo-FVR.svg" class="w-100">
                            </a>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title font-weight-600">
                                <a href="">Fundatia Vodafone Romania</a>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-lg--hover">
                        <div class="logo-container">
                            <a href="">
                                <img src="/images/logo-FVR.svg" class="w-100">
                            </a>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title font-weight-600">
                                <a href="">Fundatia Vodafone Romania</a>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-lg--hover">
                        <div class="logo-container">
                            <a href="">
                                <img src="/images/logo-FVR.svg" class="w-100">
                            </a>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title font-weight-600">
                                <a href="">Fundatia Vodafone Romania</a>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="font-weight-600 mb-4 mt-6">Parteneri media</h2>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-lg--hover">
                        <div class="logo-container">
                            <a href="">
                                <img src="/images/logo-FVR.svg" class="w-100">
                            </a>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title font-weight-600">
                                <a href="">Fundatia Vodafone Romania</a>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-lg--hover">
                        <div class="logo-container">
                            <a href="">
                                <img src="/images/logo-FVR.svg" class="w-100">
                            </a>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title font-weight-600">
                                <a href="">Fundatia Vodafone Romania</a>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-lg--hover">
                        <div class="logo-container">
                            <a href="">
                                <img src="/images/logo-FVR.svg" class="w-100">
                            </a>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title font-weight-600">
                                <a href="">Fundatia Vodafone Romania</a>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-lg--hover">
                        <div class="logo-container">
                            <a href="">
                                <img src="/images/logo-FVR.svg" class="w-100">
                            </a>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title font-weight-600">
                                <a href="">Fundatia Vodafone Romania</a>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
