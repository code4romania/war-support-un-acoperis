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
            {!! $description !!}
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
                    @if($clinic->phone_number)
                    <li class="d-flex">
                        <i class="fa fa-phone"></i>
                        <span>
                            {{ $clinic->phone_number }}
                        </span>
                    </li>
                    @if($clinic->website)
                    <li class="d-flex">
                        <i class="fa fa-globe"></i>
                        <span>
                            <a href="{{ $clinic->website }}" rel="noopener">Website</a>
                            <i class="fa fa-external-link ml-1" style="font-size: 0.9rem;"></i>
                        </span>
                    </li>
                    @endif
                    @if ($clinic->office_email)
                    <li class="d-flex">
                        <i class="fa fa-envelope"></i>
                        <span>
                            <a href="mailto:{{ $clinic->office_email }}" rel="noopener">{{ $clinic->office_email }}</a>
                        </span>
                    </li>
                    @endif
                </ul>
            </div>
            @if ($clinic->contact_person_name || $clinic->contact_person_phone || $clinic->contact_person_email)
            <div class="col-sm-6 pl-lg-5">
                <h4 class="text-primary mb-4 font-weight-600">{{ __('Clinic contact person') }}</h4>
                <ul class="details-wrapper bordered-left list-unstyled">
                    @if ($clinic->contact_person_name)
                    <li class="d-flex">
                        <i class="fa fa-user-circle"></i>
                        <span>
                            {{ $clinic->contact_person_name }}
                        </span>
                    </li>
                    @endif
                    @if ($clinic->contact_person_phone)
                    <li class="d-flex">
                        <i class="fa fa-phone"></i>
                        <span>
                            {{ $clinic->contact_person_phone }}
                        </span>
                    </li>
                    @endif
                    @if ($clinic->contact_person_email)
                    <li class="d-flex">
                        <i class="fa fa-envelope"></i>
                        <span>
                            {{ $clinic->contact_person_email }}
                        </span>
                    </li>
                    @endif
                </ul>
            </div>
            @endif
        </div>
        <div class="row">
            @if ($clinic->description || $clinic->additional_information)
            <div class="col-sm-6 pr-lg-5">
                @if ($clinic->description)
                <div class="description mb-6">
                    <h4 class="text-primary mb-4 font-weight-600">{{ __('Description') }}</h4>
                    <div>
                        {!! $clinic->description !!}
                    </div>
                </div>
                @endif
                @if ($clinic->additional_information)
                <div class="extra-info">
                    <h4 class="text-primary mb-4 font-weight-600">{{ __('Clinic additional information') }}</h4>
                    <div>
                        {!! $clinic->additional_information !!}
                    </div>
                </div>
                @endif
            </div>
            @endif
            @if ($clinic->specialities || $clinic->transport_details)
            <div class="col-sm-6 pl-lg-5">
                @if ($clinic->specialities)
                <div class="mb-5">
                    <h4 class="text-primary mb-4 font-weight-600">{{ __('Clinic specialization') }}</h4>
                    <ul class="list-custom">
                        @foreach($clinic->specialities as $speciality)
                            <li>{{ $speciality->name }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if ($clinic->transport_details)
                <h4 class="text-primary mb-4 font-weight-600">{{ __('Clinic transport') }}</h4>
                <div>
                    {!! $clinic->transport_details !!}
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
    <section class="mb-0 clinic-map">
        <div id="map" style="width:100%; height:450px;"></div>
    </section>
@endsection

@section('head-scripts')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('maps.api_key') }}&callback=initMap&libraries=&v=weekly"
        defer
    ></script>
    <script>
        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: { lat: 0, lng: 0 },
            });
            const geocoder = new google.maps.Geocoder();
            geocodeAddress(geocoder, map);
        }

        function geocodeAddress(geocoder, resultsMap) {
            const address = '{{ $clinic->country->name }}, {{ $clinic->city }}, {{ $clinic->address }}';

            geocoder.geocode({ address: address }, (results, status) => {
                if (status === "OK") {
                    resultsMap.setCenter(results[0].geometry.location);
                    new google.maps.Marker({
                        map: resultsMap,
                        position: results[0].geometry.location,
                    });
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });
        }
    </script>
@endsection
