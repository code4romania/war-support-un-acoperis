@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title mb-3 font-weight-600">Adaugare gazda</h6>
    </section>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __("Personal information") }}
            </h6>
        </div>
        <div class="card-body pt-4">
            <form action="{{ @route('admin.host-store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="required font-weight-600" for="name">{{ __("Name and surname") }}:</label>
                            <input type="text" placeholder="{{ __('Full name placeholder') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" />

                            @error('name')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="required font-weight-600" for="sms-clinic-country">{{ __('Country') }}:</label>
                            <select name="country" id="country" class="custom-select form-control @error('country') is-invalid @enderror">
                                <option>{{ __("Select country") }}</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"{{ old('country') == $country->id ? ' selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>

                            @error('country')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="required font-weight-600" for="sms-clinic-city">{{ __('City') }}:</label>
                            <input type="text" placeholder="{{ __("City placeholder") }}" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" />

                            @error('city')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="font-weight-600" for="address">{{ __('Address') }}:</label>
                            <input type="text" placeholder="{{ __('Address placeholder') }}" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" />

                            @error('address')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="required font-weight-600" for="phone">{{ __("Phone Number") }}:</label>
                            @include('partials.phone', ['controlName' => 'phone', 'controlDefault' => '', 'prefixes' => $countries, 'prefixCode' => 'ro', 'prefixValue' => ''])
                            @error('phone')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="required font-weight-600" for="email">{{ __("E-Mail Address") }}:</label>
                            <input type="email" placeholder="{{ __('Email placeholder') }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" />

                            @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="border-top pt-4 pb-3 mt-5 clearfix">
                    <input name="help" type="hidden" value="{{ $resourceType->id }}">
                    <button type="submit" id="submit-button-2" class="btn btn-secondary pull-right btn-lg px-6">
                        <span class="btn-inner--text">Salveaza</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
