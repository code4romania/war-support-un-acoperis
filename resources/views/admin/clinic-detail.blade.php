@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title mb-3 font-weight-600">{{ __('Clinic details') }}</h6>
        <a href="{{ route('admin.clinic-list') }}" class="btn btn-sm btn-outline-primary mr-3">Înapoi</a>
    </section>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ $clinic->name }}
            </h6>
        </div>
        <div class="card-body">
            <div>
                {!! $clinic->description !!}
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __('Clinic details') }}
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6">
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
                <div class="col-12 col-lg-6">
                    <ul class="list-custom">
                        @foreach($clinic->specialities as $speciality)
                            <li>{{ $speciality->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>



        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __('Clinic contact person') }}
            </h6>
        </div>
        <div class="card-body">
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

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __('Clinic additional informations') }}
            </h6>
        </div>
        <div class="card-body">
            <div>
                {!! $clinic->additional_information !!}
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __('Clinic transport') }}
            </h6>
        </div>
        <div class="card-body">
            <div>
                {!! $clinic->transport_details !!}
            </div>
        </div>
    </div>
@endsection
