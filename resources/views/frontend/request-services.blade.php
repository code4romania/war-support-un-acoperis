@extends('layouts.app')

@section('content')
    <div class="container py-sm-25">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="display-3 title mb-4 form-header">{{ __('Request Accommodation') }}</h1>
        <div class="form-description">
            {!! $description !!}
        </div>
    </div>
    <div class="alert form-info-stripe alert-general white font-weight-600 mb-0 py-4" role="alert">
        <div class="container">
            <img class="alert-inner--icon mr-3" src="/images/info-icon.svg" >
            <span class="alert-inner--text">{{ $info }}</span>
        </div>
    </div>
    <section class="py-5 bg-h4h-form">
        <div class="container">
            <div class="accordion-1 request-services">
                <form method="POST" action="{{ route('request-services-submit') }}" id="sendRequest">
                @csrf
                <div class="row">
                    <div class="col-md-12 ml-auto">
                        <div class="accordion my-3" id="requestForm">
                            {!! NoCaptcha::displaySubmit(
                                'sendRequest',
                                "<span class=\"btn-inner--text\">" . __('Send request') . "</span><span class=\"btn-inner--icon ml-2\"><i class=\"fa fa-arrow-right\"></i></span>",
                                ['type' => 'submit',  "id" => "submit-button", 'class' => 'btn btn-secondary pull-right btn-lg px-6']
                            ) !!}
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link w-100 text-left d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#generalInformation" aria-expanded="true" aria-controls="collapseOne">
                                            {{ __('General information') }}
                                            <i class="ni ni-bold-down align-self-center ml-4"></i>
                                        </button>
                                    </h5>
                                </div>

                                <div id="generalInformation" class="collapse show" aria-labelledby="generalInformation" data-parent="#requestForm">
                                    <div class="card-body py-5">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="patient-name">{{ __("Patient's full name") }}:</label>
                                                        <input type="text" placeholder="Ana-Maria Vasile" class="form-control @error('patient-name') is-invalid @enderror" name="patient-name" id="patient-name" value="{{ old('patient-name') }}" />

                                                        @error('patient-name')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="font-weight-600" for="caretaker-name">{{ __("Caretaker full name") }}:</label>
                                                        <input type="text" placeholder="Ioan Vasile" class="form-control @error('caretaker-name') is-invalid @enderror" name="caretaker-name" id="caretaker-name" value="{{ old('caretaker-name') }}" />

                                                        @error('caretaker-name')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div><label class="required font-weight-600" for="phone">{{ __("Patient's phone number") }}:</label></div>
                                                    <input type="tel" placeholder="0742000000" class="form-control @error('patient-phone') is-invalid @enderror" name="patient-phone" id="patient-phone" value="{{ old('patient-phone') }}" />
                                                    @error('patient-phone')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-sm-6">
                                                    <div><label class="font-weight-600" for="phone">{{ __("Caretaker phone") }}:</label></div>
                                                    <input type="tel" placeholder="0742000000" class="form-control @error('caretaker-phone') is-invalid @enderror" name="caretaker-phone" id="caretaker-phone" value="{{ old('patient-phone') }}" />
                                                    @error('caretaker-phone')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="caretaker-name">{{ __("Patient's e-mail") }}:</label>
                                                        <input type="email" placeholder="anamaria.vasile@provider.tld" class="form-control @error('patient-email') is-invalid @enderror" name="patient-email" id="patient-email" value="{{ old('patient-email') }}" />

                                                        @error('patient-email')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="font-weight-600" for="caretaker-email">{{ __("Caretaker email") }}:</label>
                                                        <input type="email" placeholder="ioan.vasile@provider.tld" class="form-control @error('caretaker-email') is-invalid @enderror" name="caretaker-email" id="caretaker-email" value="{{ old('caretaker-email') }}" />

                                                        @error('caretaker-email')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="required font-weight-600" for="patient-county">{{ __('County') }}:</label>
                                                                <select name="patient-county" id="patient-county" class="custom-select form-control @error('patient-county') is-invalid @enderror">
                                                                    <option></option>
                                                                    @foreach ($counties as $county)
                                                                        @if (old('patient-county'))
                                                                            <option value="{{ $county->id }}" {{ (old('patient-county') == $county->id ? 'selected' : '') }}>{{ $county->name }}</option>
                                                                        @else
                                                                            <option value="{{ $county->id }}">{{ $county->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>

                                                                @error('patient-county')
                                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="required font-weight-600" for="patient-city">{{ __('City') }}:</label>
                                                                <select name="patient-city" id="patient-city" class="custom-select form-control @error('patient-city') is-invalid @enderror">
                                                                    <option value="">{{( __('Select County')) }}</option>
                                                                    @foreach ($cities as $cities)
                                                                        @if (old('patient-city'))
                                                                            <option value="{{ $cities->id }}" {{ (old('patient-city') == $cities->id ? 'selected' : '') }}>{{ $cities->name }}</option>
                                                                        @else
                                                                            <option value="{{ $cities->id }}">{{ $cities->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>

                                                                @error('patient-city')
                                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label  class="required font-weight-600" for="caretaker-name">{{ __('Diagnostic') }}:</label>
                                                                <input type="text" placeholder="Diagnostic" class="form-control @error('patient-diagnostic') is-invalid @enderror" name="patient-diagnostic" id="patient-diagnostic" value="{{ old('patient-diagnostic') }}" />

                                                                @error('patient-diagnostic')
                                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-4">
                                                    <div class="form-group">
                                                        <label for="extra-details" class="font-weight-600">{{ __('Please provide us with more details regarding the case you are bringing to our attention') }}</label>
                                                        <textarea name="extra-details" id="extra-details" rows="5" class="form-control" placeholder="Detalii caz">{{ old('extra-details') }}</textarea>

                                                        @error('extra-details')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label for="" class="font-weight-600 mb-3">{{ __('How can we help you') }}?</label>
                                                        @if ($errors->has('help-type-*'))
                                                        <span class="invalid-feedback d-block mb-3" role="alert">
                                                            {{ __('Please select at least one option.') }}
                                                        </span>
                                                        @endif
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            @foreach($helpTypesLeft as $helpType)
                                                                <div class="custom-control custom-checkbox mb-3">
                                                                    <input class="custom-control-input" id="help-type-{{ $helpType['id'] }}" name="help-type-{{ $helpType['id'] }}" type="checkbox" {{ !empty(old('help-type-' . $helpType['id'])) ? 'checked' : '' }}>
                                                                    <label class="custom-control-label" for="help-type-{{ $helpType['id'] }}">{{ __($helpType['name']) }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-sm-6">
                                                            @foreach($helpTypesRight as $helpType)
                                                                <div class="custom-control custom-checkbox mb-3">
                                                                    <input class="custom-control-input" id="help-type-{{ $helpType['id'] }}" name="help-type-{{ $helpType['id'] }}" type="checkbox" {{ !empty(old('help-type-' . $helpType['id'])) ? 'checked' : '' }}>
                                                                    <label class="custom-control-label" for="help-type-{{ $helpType['id'] }}">{{ __($helpType['name']) }}</label>
                                                                </div>
                                                            @endforeach

                                                                <div style="display: none;" id="request-other-message-control" class="custom-control mb-3">
                                                                    <textarea id="request-other-message" name="request-other-message" rows="3" class="form-control" placeholder="Mesajul tau aici">{{ old('request-other-message') }}</textarea>

                                                                    @error('request-other-message')
                                                                    <span class="invalid-feedback d-flex" role="alert">
                                                                        {{ $message }}
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                        </div>
                                                    </div>

                                                    <div class="border-top pt-5 mt-3 clearfix">

                                                        @error('g-recaptcha-response')
                                                        <span class="invalid-feedback d-flex" role="alert">{{ $errors->first('g-recaptcha-response') }}</span>
                                                        @enderror

                                                        <div id="submit-button-container-1">
                                                        </div>

                                                        <button style="display: none;" type="button" id="next-step-button-1" class="btn btn-secondary pull-right btn-lg px-6 hide" data-toggle="collapse" data-target="#smsDetails" aria-expanded="false">
                                                            <span class="btn-inner--text">{{ __('Next step') }}</span>
                                                            <span class="btn-inner--icon ml-2"><i class="fa fa-arrow-right"></i></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4 shadow d-none" id="sms-details">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link w-100 text-left collapsed d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#smsDetails" aria-expanded="false" aria-controls="smsDetails">
                                            {{ __('Data required for the allocation of an SMS fundraising number') }}
                                            <i class="ni ni-bold-down align-self-center ml-4"></i>
                                        </button>
                                    </h5>
                                </div>
                                <div id="smsDetails" class="collapse" aria-labelledby="smsDetails" data-parent="#requestForm">
                                    <div class="card-body py-5">
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="required font-weight-600" for="sms-estimated-amount">{{ __('Estimated amount required for treatment / surgery') }}:</label>
                                                    <input type="text" placeholder="9800 EUR" class="form-control @error('sms-estimated-amount') is-invalid @enderror" id="sms-estimated-amount" name="sms-estimated-amount" value="{{ old('sms-estimated-amount') }}" />

                                                    @error('sms-estimated-amount')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="required font-weight-600" for="sms-purpose">{{ __('Destination of funds raised in the SMS campaign') }}</label>
                                                    <input type="text" placeholder="{{ __('Fund destination') }}" class="form-control @error('sms-purpose') is-invalid @enderror" id="sms-purpose" name="sms-purpose" value="{{ old('sms-purpose') }}" />

                                                    @error('sms-purpose')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="required font-weight-600" for="sms-clinic-name">{{ __('Clinic / hospital name where the patient is accepted') }}:</label>
                                                    <input type="text" placeholder="VIENNA GENERAL HOSPITAL" class="form-control @error('sms-clinic-name') is-invalid @enderror" id="sms-clinic-name" name="sms-clinic-name" value="{{ old('sms-clinic-name') }}" />

                                                    @error('sms-clinic-name')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="required font-weight-600" for="sms-clinic-country">{{ __('Country') }}:</label>
                                                            <select name="sms-clinic-country" id="sms-clinic-country" class="custom-select form-control @error('sms-clinic-country') is-invalid @enderror">
                                                                <option></option>
                                                                @foreach ($countries as $country)
                                                                    @if (old('sms-clinic-country'))
                                                                        <option value="{{ $country->id }}" {{ (old('sms-clinic-country') == $country->id ? 'selected' : '') }}>{{ __('countries.' . $country->name) }}</option>
                                                                    @else
                                                                        <option value="{{ $country->id }}">{{ __('countries.' . $country->name) }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>

                                                            @error('sms-clinic-country')
                                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="required font-weight-600" for="sms-clinic-city">{{ __('City') }}:</label>
                                                            <input type="text" placeholder="Viena" class="form-control @error('sms-clinic-city') is-invalid @enderror" id="sms-clinic-city" name="sms-clinic-city" value="{{ old('sms-clinic-city') }}" />

                                                            @error('sms-clinic-city')
                                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top pt-5 mt-3 clearfix">

                                            @error('g-recaptcha-response')
                                            <span class="invalid-feedback d-flex" role="alert">{{ $errors->first('g-recaptcha-response') }}</span>
                                            @enderror

                                            <div id="submit-button-container-2">
                                            </div>

                                            <button style="display: none;" id="next-step-button-2" type="button" class="btn btn-secondary pull-right btn-lg px-6" data-toggle="collapse" data-target="#accommodationDetails" aria-expanded="false" aria-controls="accommodationDetails">
                                                <span class="btn-inner--text">{{ __('Next step') }}</span>
                                                <span class="btn-inner--icon ml-2"><i class="fa fa-arrow-right"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4 shadow d-none" id="accommodation-details">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link w-100 text-left collapsed d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#accommodationDetails" aria-expanded="false" aria-controls="accommodationDetails">
                                            {{ __('Application to find accommodation options near the hospital') }}
                                            <i class="ni ni-bold-down align-self-center ml-4"></i>
                                        </button>
                                    </h5>
                                </div>
                                <div id="accommodationDetails" class="collapse" aria-labelledby="accommodationDetails" data-parent="#requestForm">
                                    <div class="card-body py-5">
                                        <h5 class="mb-5">{{ __('Please fill in the fields below to help you find the best accommodation near hospital') }}!</h5>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="font-weight-600 required" for="accommodation-clinic-name">{{ __('At which hospital will the medical investigations / treatment be performed') }}?</label>
                                                    <input type="text" placeholder="VIENNA GENERAL HOSPITAL" class="form-control @error('accommodation-clinic-name') is-invalid @enderror" id="accommodation-clinic-name" name="accommodation-clinic-name" value="{{ old('accommodation-clinic-name') }}" />

                                                    @error('accommodation-clinic-name')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="required font-weight-600" for="accommodation-country">{{ __('Country') }}:</label>
                                                    <select name="accommodation-country" id="accommodation-country" class="custom-select form-control @error('accommodation-country') is-invalid @enderror">
                                                        <option></option>
                                                        @foreach ($countries as $country)
                                                            @if (old('accommodation-country'))
                                                                <option value="{{ $country->id }}" {{ (old('accommodation-country') == $country->id ? 'selected' : '') }}>{{ __('countries.' . $country->name) }}</option>
                                                            @else
                                                                <option value="{{ $country->id }}">{{ __('countries.' . $country->name) }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>

                                                    @error('accommodation-country')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="required font-weight-600" for="accommodation-city">{{ __('City') }}:</label>
                                                    <input type="text" placeholder="Viena" class="form-control @error('accommodation-city') is-invalid @enderror" id="accommodation-city" name="accommodation-city" value="{{ old('accommodation-city') }}" />

                                                    @error('accommodation-city')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="required font-weight-600" for="accommodation-guests-number">{{ __('For how many people do you need accommodation') }}?</label>
                                                    <input type="number" placeholder="2" class="form-control @error('accommodation-guests-number') is-invalid @enderror" id="accommodation-guests-number" name="accommodation-guests-number" value="{{ old('accommodation-guests-number') }}" />

                                                    @error('accommodation-guests-number')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="required font-weight-600" for="accommodation-start-date">{{ __('Starting with what date you need accommodation') }}?</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                        </div>
                                                        <input class="flatpickr flatpickr-input form-control  @error('accommodation-start-date') is-invalid @enderror" type="text" placeholder="{{ __('Select Date') }}" id="accommodation-start-date" name="accommodation-start-date" value="{{ old('accommodation-start-date') }}" />

                                                        @error('accommodation-start-date')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="required font-weight-600" for="accommodation-end-date">{{ __('Until when do you need accommodation') }}?</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                        </div>
                                                        <input class="flatpickr flatpickr-input form-control @error('accommodation-end-date') is-invalid @enderror" type="text" placeholder="{{ __('Select Date') }}" id="accommodation-end-date" name="accommodation-end-date" value="{{ old('accommodation-end-date') }}" />

                                                        @error('accommodation-start-date')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="accommodation-special-request" class="font-weight-600">{{ __('Detail here if you need special accommodation conditions') }}:</label>
                                            <textarea id="accommodation-special-request" name="accommodation-special-request" rows="5" class="form-control" placeholder="">{{ old('accommodation-special-request') }}</textarea>
                                        </div>
                                        <div class="pt-5 clearfix">
                                            @error('g-recaptcha-response')
                                            <span class="invalid-feedback d-flex" role="alert">{{ $errors->first('g-recaptcha-response') }}</span>
                                            @enderror

                                            <div id="submit-button-container-3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    {!! NoCaptcha::renderJs(request()->route()->parameters['locale']) !!}
    <script>
        $(document).ready(function () {
            $('select[name=patient-county]').on('change', function () {
                var cities = $('select[name=patient-city]');

                cities.empty().append(new Option('-', null));

                axios.get('/ajax/county/' + this.value + '/city')
                    .then(res => {
                        cities.empty().append(new Option('-', null));
                        $.each(res.data, function(key, value) {
                            cities.append(new Option(value, key));
                        });
                    });
            });

            $('#help-type-5').on('change', function() {
                if ($('#help-type-5').is(':checked')) {
                    $('#sms-details').removeClass('d-none');
                } else {
                    $('#sms-details').addClass('d-none');
                }

                toggleFlowSteps();
                toggleSubmitButtons();
            });

            $('#help-type-8').on('change', function() {
                if ($('#help-type-8').is(':checked')) {
                    $('#request-other-message-control').show();
                } else {
                    $('#request-other-message-control').hide();
                }
            });

            $('#help-type-6').on('change', function() {
                if ($('#help-type-6').is(':checked')) {
                    $('#accommodation-details').removeClass('d-none');
                } else {
                    $('#accommodation-details').addClass('d-none');
                }

                toggleFlowSteps();
                toggleSubmitButtons();
            });

            let prev = null;
            let submitButton = null;

            function toggleSubmitButtons() {
                if (
                    false === $('#help-type-5').is(':checked') &&
                    false === $('#help-type-6').is(':checked')
                ) {
                    prev = $('#submit-button').prev().detach();
                    submitButton = $('#submit-button').detach();
                    prev.appendTo('#submit-button-container-1')
                    submitButton.appendTo('#submit-button-container-1')
                    $('#next-step-button-1').hide();
                    $('#next-step-button-2').hide();
                } else if (
                    true === $('#help-type-5').is(':checked') &&
                    false === $('#help-type-6').is(':checked')
                ){
                    prev = $('#submit-button').prev().detach();
                    submitButton = $('#submit-button').detach();
                    prev.appendTo('#submit-button-container-2')
                    submitButton.appendTo('#submit-button-container-2')
                    $('#next-step-button-1').show();
                    $('#next-step-button-2').hide();
                } else {
                    prev = $('#submit-button').prev().detach();
                    submitButton = $('#submit-button').detach();
                    prev.appendTo('#submit-button-container-3')
                    submitButton.appendTo('#submit-button-container-3')
                    $('#next-step-button-1').show();
                    $('#next-step-button-2').show();
                }
            }

            function toggleFlowSteps() {
                if ($('#help-type-5').is(':checked')) {
                    $('#next-step-button-1').attr('data-target', '#smsDetails');
                } else if ($('#help-type-6').is(':checked')) {
                    $('#next-step-button-1').attr('data-target', '#accommodationDetails');
                }
            }

            $('#help-type-5').trigger('change');
            $('#help-type-6').trigger('change');
            $('#help-type-8').trigger('change');

            @if ($errors->has('patient-*') || $errors->has('caretaker-*'))
                $('#generalInformation.collapse').collapse('show');
            @elseif ($errors->has('sms-*'))
                $('#smsDetails.collapse').collapse('show');
            @elseif ($errors->has('accommodation-*'))
                $('#accommodationDetails.collapse').collapse('show');
            @endif
        });
    </script>
@endsection
