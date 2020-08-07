@extends('layouts.app')

@section('content')
    <div class="container py-sm-5 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="display-3 title mb-0 text-primary">{{ $clinic->name }}</h1>
    </div>
    <section class="bg-light-blue py-4">
        <div class="container">
            Dacă ai nevoie de sprijin în a lua legătura cu această clinică, sau ai nevoie de cazare în Londra te rugăm să ne scrii un mesaj folosind
            <a href="#">acest formular</a>.
        </div>
    </section>
    <div class="container py-5">
        <div class="row mb-6">
            <div class="col-sm-6 pr-lg-5 mb-4 mb-0">
                <h4 class="text-primary mb-4 font-weight-600">{{ __('Clinic details') }}</h4>
                <ul class="details-wrapper bordered-left list-unstyled">
                    <li class="d-flex align-items-start">
                        <i class="fa fa-map-marker"></i>
                        <span>
                            {{ $clinic->address }}<br>{{ $clinic->city }}<br> {{ $clinic->country->name }}
                        </span>
                    </li>
                    <li class="d-flex">
                        <i class="fa fa-phone"></i>
                        <span>
                            {{ $clinic->phone_number }}
                        </span>
                    </li>
                    <li class="d-flex">
                        <i class="fa fa-globe"></i>
                        <span>
                            <a href="{{ $clinic->website }}">{{ $clinic->website }}</a>
                        </span>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6 pl-lg-5">
                <h4 class="text-primary mb-4 font-weight-600">{{ __('Clinic contact person') }}</h4>
                <ul class="details-wrapper bordered-left list-unstyled">
                    <li class="d-flex">
                        <i class="fa fa-user-circle"></i>
                        <span>
                            {{ $clinic->contact_person_name }}
                        </span>
                    </li>
                    <li class="d-flex">
                        <i class="fa fa-phone"></i>
                        <span>
                            {{ $clinic->contact_person_phone }}
                        </span>
                    </li>
                    <li class="d-flex">
                        <i class="fa fa-envelope"></i>
                        <span>
                            {{ $clinic->contact_person_email }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 pr-lg-5">
                <div class="description mb-6">
                    <h4 class="text-primary mb-4 font-weight-600">{{ __('Description') }}</h4>
                    <div>
                        {!! $clinic->description !!}
                    </div>
                </div>
                <div class="extra-info">
                    <h4 class="text-primary mb-4 font-weight-600">{{ __('Clinic additional informations') }}</h4>
                    <div>
                        {!! $clinic->additional_information !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-6 pl-lg-5">
                <div class="mb-5">
                    <h4 class="text-primary mb-4 font-weight-600">{{ __('Clinic details') }}</h4>
                    <ul class="list-custom">
                        @foreach($clinic->specialities as $speciality)
                            <li>{{ $speciality->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <h4 class="text-primary mb-4 font-weight-600">{{ __('Clinic transport') }}</h4>
                <div>
                    {!! $clinic->transport_details !!}
                </div>
            </div>
        </div>
    </div>
    <section class="mb-0 clinic-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2488.2498838455936!2d0.08075301555663382!3d51.41683622514207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8abf1c408865d%3A0x5d04cbb01d3fa10c!2sUniversity%20College%20London%20Chislehurst%20Sports%20Ground%2C%20Chislehurst%2C%20Regatul%20Unit!5e0!3m2!1sro!2sro!4v1594827735342!5m2!1sro!2sro" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </section>
@endsection
