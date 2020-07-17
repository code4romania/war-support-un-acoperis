@extends('layouts.app')

@section('content')
    <div class="container pt-sm-6 pb-sm-5 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="display-3 title mb-4 text-primary">{{ __('Request Services') }}</h1>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.
        </p>
    </div>
    <div class="alert bg-light-green alert-general alert-secondary font-weight-600 mb-0" role="alert">
        <div class="container">
            <span class="alert-inner--icon mr-3"><i class="fa fa-info-circle"></i></span>
            <span class="alert-inner--text">Toate informatiile furnizate cu ajutorul formularului de solicitare sunt confidentiale</span>
        </div>
    </div>
    <section class="py-5 bg-light-blue">
        <div class="container">
            <div class="accordion-1 request-services">
                <form method="POST" action="{{ route('request-services-submit') }}">
                @csrf
                <input type="hidden" id="has-sms" name="has-sms" value="false" />
                <input type="hidden" id="has-accommodation" name="has-accommodation" value="false" />
                <div class="row">
                    <div class="col-md-12 ml-auto">
                        <div class="accordion my-3" id="accordionExample">

                            <div class="card shadow mb-4">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link w-100 text-left d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Informatii generale
                                            <i class="ni ni-bold-down align-self-center ml-4"></i>
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body py-5">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="patient-name">Numele si prenumele pacientului:</label>
                                                        <input type="text" placeholder="Ana-Maria Vasile" class="form-control @error('patient-name') is-invalid @enderror" name="patient-name" id="patient-name" value="{{ old('patient-name') }}" />

                                                        @error('patient-name')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="caretaker-name">Numele si prenumele persoanei care completeaza formularul:</label>
                                                        <input type="text" placeholder="Ioan Vasile" class="form-control @error('caretaker-name') is-invalid @enderror" name="caretaker-name" id="caretaker-name" value="{{ old('caretaker-name') }}" />

                                                        @error('caretaker-name')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="patient-phone">Telefonul pacientului:</label>
                                                        <input type="tel" placeholder="0700000000" class="form-control @error('patient-phone') is-invalid @enderror" name="patient-phone" id="patient-phone" value="{{ old('patient-phone') }}" />

                                                        @error('patient-phone')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="caretaker-phone">Telefonul persoanei care completeaza formularul:</label>
                                                        <input type="tel" placeholder="0700000001" class="form-control @error('caretaker-phone') is-invalid @enderror" name="caretaker-phone" id="caretaker-phone" value="{{ old('caretaker-phone') }}" />

                                                        @error('caretaker-phone')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="caretaker-name">E-mailul pacientului:</label>
                                                        <input type="email" placeholder="anamaria.vasile@provider.tld" class="form-control @error('patient-email') is-invalid @enderror" name="patient-email" id="patient-email" value="{{ old('patient-email') }}" />

                                                        @error('patient-email')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="caretaker-email">E-mailul persoanei care completeaza formularul:</label>
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
                                                                <label class="required font-weight-600" for="patient-county">Judet:</label>
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
                                                                <label class="required font-weight-600" for="patient-city">Localitate:</label>
                                                                <select name="patient-city" id="patient-city" class="custom-select form-control @error('patient-city') is-invalid @enderror">
                                                                    <option value="">Selectati Judetul</option>
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
                                                                <label  class="required font-weight-600" for="caretaker-name">Diagnostic:</label>
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
                                                        <label for="extra-details" class="font-weight-600">Te rugam sa ne oferi mai multe detalii referitoare la cazul pe care il supui atentiei noastre!</label>
                                                        <textarea name="extra-details" id="extra-details" rows="5" class="form-control" placeholder="Detalii caz">{{ old('extra-details') }}</textarea>

                                                        @error('extra-details')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label for="" class="font-weight-600 mb-3">Cu ce putem să te ajutăm?</label>
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
                                                        </div>
                                                    </div>
                                                    <div class="border-top pt-5 mt-3 clearfix">
                                                        <button type="submit" id="submit-button-1" class="btn btn-secondary pull-right btn-lg px-6">
                                                            <span class="btn-inner--text">Trimite solicitare</span>
                                                            <span class="btn-inner--icon ml-2"><i class="fa fa-arrow-right"></i></span>
                                                        </button>

                                                        <button style="display: none;" type="button" id="next-step-button-1" class="btn btn-secondary pull-right btn-lg px-6 hide" data-toggle="collapse" data-target="#smsDetails" aria-expanded="false">
                                                            <span class="btn-inner--text">Pasul urmator</span>
                                                            <span class="btn-inner--icon ml-2"><i class="fa fa-arrow-right"></i></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4 shadow invisible" id="sms-details">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link w-100 text-left collapsed d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#smsDetails" aria-expanded="false" aria-controls="smsDetails">
                                            Date necesare pentru alocarea unui numar de SMS pentru strangerea de fonduri
                                            <i class="ni ni-bold-down align-self-center ml-4"></i>
                                        </button>
                                    </h5>
                                </div>
                                <div id="smsDetails" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body py-5">
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="required font-weight-600" for="sms-estimated-amount">Suma estimativa necesara pentru tratament/interventie chirurgicala:</label>
                                                    <input type="text" placeholder="9800 EUR" class="form-control @error('sms-estimated-amount') is-invalid @enderror" id="sms-estimated-amount" name="sms-estimated-amount" value="{{ old('sms-estimated-amount') }}" />

                                                    @error('sms-estimated-amount')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="required font-weight-600" for="sms-purpose">Destinatie fonduri stranse in campanie SMS</label>
                                                    <input type="text" placeholder="Destinatia fondurilor" class="form-control @error('sms-purpose') is-invalid @enderror" id="sms-purpose" name="sms-purpose" value="{{ old('sms-purpose') }}" />

                                                    @error('sms-purpose')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="required font-weight-600" for="sms-clinic-name">Denumire clinica/spital unde este acceptat pacientul:</label>
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
                                                            <label class="required font-weight-600" for="sms-clinic-country">Tara:</label>
                                                            <select name="sms-clinic-country" id="sms-clinic-country" class="custom-select form-control @error('sms-clinic-country') is-invalid @enderror">
                                                                <option></option>
                                                                @foreach ($countries as $country)
                                                                    @if (old('sms-clinic-country'))
                                                                        <option value="{{ $country->id }}" {{ (old('sms-clinic-country') == $country->id ? 'selected' : '') }}>{{ $country->name }}</option>
                                                                    @else
                                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
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
                                                            <label class="required font-weight-600" for="sms-clinic-city">Localitate:</label>
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
                                            <button type="submit" id="submit-button-2" class="btn btn-secondary pull-right btn-lg px-6">
                                                <span class="btn-inner--text">Trimite solicitare</span>
                                                <span class="btn-inner--icon ml-2"><i class="fa fa-arrow-right"></i></span>
                                            </button>

                                            <button style="display: none;" id="next-step-button-2" type="button" class="btn btn-secondary pull-right btn-lg px-6" data-toggle="collapse" data-target="#accommodationDetails" aria-expanded="false" aria-controls="accommodationDetails">
                                                <span class="btn-inner--text">Pasul urmator</span>
                                                <span class="btn-inner--icon ml-2"><i class="fa fa-arrow-right"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4 shadow invisible" id="accommodation-details">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link w-100 text-left collapsed d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#accommodationDetails" aria-expanded="false" aria-controls="accommodationDetails">
                                            Cerere pentru a gasi optiuni de cazare langa spital
                                            <i class="ni ni-bold-down align-self-center ml-4"></i>
                                        </button>
                                    </h5>
                                </div>
                                <div id="accommodationDetails" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body py-5">
                                        <h5 class="mb-5">Te rugam sa completezi campurile de mai jos pentru a te ajuta sa gasesti cea mai buna optiune de cazare langa spital!</h5>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="font-weight-600" for="accommodation-clinic-name">La ce spital urmeaza sa fie efectuate investigatiile medicale / tratamentul?</label>
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
                                                    <label class="required font-weight-600" for="accommodation-country">Tara:</label>
                                                    <select name="accommodation-country" id="accommodation-country" class="custom-select form-control @error('accommodation-country') is-invalid @enderror">
                                                        <option></option>
                                                        @foreach ($countries as $country)
                                                            @if (old('accommodation-country'))
                                                                <option value="{{ $country->id }}" {{ (old('accommodation-country') == $country->id ? 'selected' : '') }}>{{ $country->name }}</option>
                                                            @else
                                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
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
                                                    <label class="required font-weight-600" for="accommodation-city">Oras:</label>
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
                                                    <label class="required font-weight-600" for="accommodation-guests-number">Pentru câte persoane ai nevoie de cazare?</label>
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
                                                    <label class="required font-weight-600" for="accommodation-start-date">Incepand cu ce data ai nevoie de cazare?</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                        </div>
                                                        <input class="flatpickr flatpickr-input form-control  @error('accommodation-start-date') is-invalid @enderror" type="text" placeholder="Selectati data" id="accommodation-start-date" name="accommodation-start-date" value="{{ old('accommodation-start-date') }}" />

                                                        @error('accommodation-start-date')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="required font-weight-600" for="accommodation-end-date">Până când ai nevoie de cazare?</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                        </div>
                                                        <input class="flatpickr flatpickr-input form-control @error('accommodation-end-date') is-invalid @enderror" type="text" placeholder="Selectati data" id="accommodation-end-date" name="accommodation-end-date" value="{{ old('accommodation-end-date') }}" />

                                                        @error('accommodation-start-date')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="accommodation-special-request" class="font-weight-600">Detaliază aici dacă ai nevoie de condiții speciale de cazare:</label>
                                            <textarea id="accommodation-special-request" name="accommodation-special-request" rows="5" class="form-control" placeholder="">{{ old('accommodation-special-request') }}</textarea>
                                        </div>
                                        <div class="pt-5 clearfix">
                                            <button type="submit" class="btn btn-secondary pull-right btn-lg px-6">
                                                <span class="btn-inner--text">Trimite solicitare</span>
                                                <span class="btn-inner--icon ml-2"><i class="fa fa-arrow-right"></i></span>
                                            </button>
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
                    $('#sms-details').removeClass('invisible');
                    $('#has-sms').val('true');
                } else {
                    $('#sms-details').addClass('invisible');
                    $('#has-sms').val('false');
                }

                toggleFlowSteps();
                toggleSubmitButtons();
            });

            $('#help-type-6').on('change', function() {
                if ($('#help-type-6').is(':checked')) {
                    $('#accommodation-details').removeClass('invisible');
                    $('#has-accommodation').val('true');
                } else {
                    $('#accommodation-details').addClass('invisible');
                    $('#has-accommodation').val('false');
                }

                toggleFlowSteps();
                toggleSubmitButtons();
            });

            function toggleSubmitButtons() {
                if (
                    false === $('#help-type-5').is(':checked') &&
                    false === $('#help-type-6').is(':checked')
                ) {
                    $('#submit-button-1').show();
                    $('#next-step-button-1').hide();
                } else {
                    $('#submit-button-1').hide();
                    $('#next-step-button-1').show();
                }

                if (
                    true === $('#help-type-5').is(':checked') &&
                    true === $('#help-type-6').is(':checked')
                ) {
                    $('#submit-button-2').hide();
                    $('#next-step-button-2').show();
                } else {
                    $('#submit-button-2').show();
                    $('#next-step-button-2').hide();
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
        });
    </script>
@endsection
