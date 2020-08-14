@extends('layouts.app')

@section('content')
    <div class="container pt-sm-6 pb-sm-5 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="display-3 title mb-4 text-primary">{{ __('Get Involved') }}</h1>
        <p>{{ __('Get Involved Description') }}</p>
    </div>
    <section class="bg-light-green py-5">
        <div class="container">
            <form method="POST" action="{{ route('store-get-involved') }}">
            @csrf
            <div class="card shadow mb-4">
                <div class="card-header bg-primary">
                    <h6 class="mb-0 text-white font-weight-600">
                        {{ __('General info') }}
                    </h6>
                </div>
                <div class="card-body py-5">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="required font-weight-600" for="name">{{ __("Name and surname") }}:</label>
                                <input type="text" placeholder="{{ __('Full name placeholder') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" />

                                @error('full-name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6">
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
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="required font-weight-600" for="sms-clinic-city">{{ __('City') }}:</label>
                                        <input type="text" placeholder="{{ __("City placeholder") }}" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" />

                                        @error('city')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
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
                                <input type="tel" placeholder="{{ __('Phone placeholder') }}" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}" />

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
                    <div clas="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="" class="font-weight-600 mb-3 mt-3 d-block required">{{ __('Help type') }}</label>
                                <div class="form-check form-check-inline mb-3">
                                    @foreach ($resourceTypes as $resourceType)
                                        <div class="custom-control custom-checkbox mr-4 mb-3">
                                            <input {{ in_array($resourceType->id, (array)old('help')) ? 'checked' : '' }} class="custom-control-input @error('help') is-invalid @enderror" id="help{{ $loop->iteration }}" name="help[]" type="checkbox" value="{{ $resourceType->id }}">
                                            <label class="custom-control-label" for="help{{ $loop->iteration }}">{{ __('resource_types.' . $resourceType->name) }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Other help type -->
                    <div class="row d-none" id="other-help">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">{{ __('Other type') }}</label>
                                <input type="text" class="form-control" name="other" placeholder="{{ __('Other type placeholder') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Accomodation sign in alert -->
                    <div class="alert bg-light-green alert-general alert-secondary mb-0  align-items-sm-center d-none" role="alert" id="accomodation-alert">
                        <span class="alert-inner--icon mr-3"><i class="fa fa-info-circle"></i></span>
                        <span class="alert-inner--text">{!! __('Help type message') !!}</span>
                    </div>

                    <div class="border-top pt-5 mt-3 clearfix">
                        <button type="submit" id="submit-button-2" class="btn btn-secondary pull-right btn-lg px-6">
                            <span class="btn-inner--text">{{ __('Send request') }}</span>
                            <span class="btn-inner--icon ml-2"><i class="fa fa-arrow-right"></i></span>
                        </button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            @foreach ($resourceTypes as $resourceType)

            @if ($resourceType->options & \App\ResourceType::OPTION_ALERT || $resourceType->options & \App\ResourceType::OPTION_MESSAGE)
            $('#help{{ $loop->iteration }}').on('change', function() {

                @if ($resourceType->options & \App\ResourceType::OPTION_ALERT)
                if ($('#help{{ $loop->iteration }}').is(':checked')) {
                    $('#accomodation-alert').removeClass('d-none').addClass('d-flex');
                } else {
                    $('#accomodation-alert').addClass('d-none').removeClass('d-flex');
                }
                @endif

                @if ($resourceType->options & \App\ResourceType::OPTION_MESSAGE)
                if ($('#help{{ $loop->iteration }}').is(':checked')) {
                    $('#other-help').removeClass('d-none');
                } else {
                    $('#other-help').addClass('d-none');
                }
                @endif
            });
            @endif

            @endforeach
        });
    </script>
@endsection
