@extends('layouts.app')

@section('content')
    <div class="container pt-sm-6 pb-sm-5 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="display-3 title mb-4 text-primary">{{ __('Request Help') }}</h1>
        <p>
            {!! $description !!}
        </p>
    </div>
    <div class="alert bg-h4h-blue alert-general white font-weight-600 mb-0" role="alert">
        <div class="container">
            <span class="alert-inner--icon mr-3"><i class="fa fa-info-circle"></i></span>
            <span class="alert-inner--text">{{ $info }}</span>
        </div>
    </div>
    <section class="py-5 bg-h4h-form">
        <div class="container">
            <div class="accordion-1 request-services">
                <form method="POST" action="{{ route('request-services-submit-step2') }}" id="sendRequest">
                    <input type="hidden" name="request_services_step" value="2">
                @csrf
                <div class="row">
                    <div class="col-md-12 ml-auto">
                        <div class="accordion my-3" id="requestForm">

                            <div class="card shadow mb-4" id="generatData">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link w-100 text-left d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#generalInformation" aria-expanded="true" aria-controls="collapseOne">
                                            2. {{ __('Create account') }}
                                            <i class="ni ni-bold-down align-self-center ml-4"></i>
                                        </button>
                                    </h5>
                                </div>

                                <div id="generalInformation" class="collapse show" aria-labelledby="generalInformation" data-parent="#requestForm">
                                    <div class="card-body py-5">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="patient-name">{{ __("Applicant's full name") }}:</label>
                                                        <input type="text" placeholder="Ana-Maria Vasile" class="form-control @error('patient-name') is-invalid @enderror" name="patient-name" id="patient-name" value="{{ old('patient-name') }}" required />

                                                        @error('patient-name')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="caretaker-name">{{ __("Applicant's e-mail") }}:</label>
                                                        <input type="email" placeholder="anamaria.vasile@provider.tld" class="form-control @error('patient-email') is-invalid @enderror" name="patient-email" id="patient-email" value="{{ old('patient-email') }}" required />

                                                        @error('patient-email')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div><label class="required font-weight-600" for="phone">{{ __("Applicant's phone number") }}:</label></div>
                                                    <input type="tel" placeholder="0742000000" class="form-control @error('patient-phone') is-invalid @enderror" name="patient-phone" id="patient-phone" value="{{ old('patient-phone') }}" required />
                                                </div>

                                                <div class="col-sm-6">
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="required font-weight-600" for="patient-county">{{ __('Region of origin') }}:</label>
                                                                <select name="patient-county" id="patient-county" class="custom-select form-control @error('patient-county') is-invalid @enderror" required >
                                                                    <option></option>
                                                                    @foreach ($counties as $county)
                                                                        @if (old('patient-county'))
                                                                            <option value="{{ $county->id }}" {{ (old('patient-county') == $county->id  ? 'selected' : '') }}>{{ $county->region_uk }}</option>
                                                                        @else
                                                                            <option value="{{ $county->id }}" >{{ $county->region_uk }}</option>
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
                                                                <label class="required font-weight-600" for="patient-city">{{ __("City of origin") }}:</label>
                                                                <input name="patient-city" id="patient-city" value="{{ old('patient-city') }}" class="form-control @error('patient-city') is-invalid @enderror" required>

                                                                @error('patient-city')
                                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="border-top pt-5 mt-3 clearfix">

                                                        @error('g-recaptcha-response')
                                                        <span class="invalid-feedback d-flex" role="alert">{{ $errors->first('g-recaptcha-response') }}</span>
                                                        @enderror

                                                        <div id="submit-button-container-1">
                                                        </div>

                                                        <button type="submit" id="next-step-button-1" class="btn btn-secondary pull-right btn-lg px-6 hide" >
                                                            <span class="btn-inner--text">{{ __("Continue") }}</span>
                                                            <span class="btn-inner--icon ml-2"><i class="fa fa-arrow-right"></i></span>
                                                        </button>
                                                    </div>
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
