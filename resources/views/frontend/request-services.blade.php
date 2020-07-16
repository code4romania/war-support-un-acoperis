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
                <div class="row">
                    <div class="col-md-12 ml-auto">
                        <div class="accordion my-3" id="accordionExample">

                            <div class="card shadow mb-4">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link w-100 text-left d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            1. Informatii generale
                                            <i class="ni ni-bold-down align-self-center ml-4"></i>
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body py-5">
                                        <form method="POST" action="{{ route('request-services-submit') }}">
                                            @csrf
                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="pacient-name">Numele si prenumele pacientului:</label>
                                                        <input type="text" placeholder="Ana-Maria Vasile" class="form-control @error('pacient-name') is-invalid @enderror" name="pacient-name" id="pacient-name" value="{{ old('pacient-name') }}" required />

                                                        @error('pacient-name')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="caretaker-name">Numele si prenumele persoanei care completeaza formularul:</label>
                                                        <input type="text" placeholder="Ioan Vasile" class="form-control @error('caretaker-name') is-invalid @enderror" name="caretaker-name" id="caretaker-name" value="{{ old('caretaker-name') }}" required />

                                                        @error('caretaker-name')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="pacient-phone">Telefonul pacientului:</label>
                                                        <input type="tel" placeholder="0700000000" class="form-control @error('pacient-phone') is-invalid @enderror" name="pacient-phone" id="pacient-phone" value="{{ old('pacient-phone') }}" required />

                                                        @error('pacient-phone')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="caretaker-phone">Telefonul persoanei care completeaza formularul:</label>
                                                        <input type="tel" placeholder="0700000001" class="form-control @error('caretaker-phone') is-invalid @enderror" name="caretaker-phone" id="caretaker-phone" value="{{ old('caretaker-phone') }}" required />

                                                        @error('caretaker-phone')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="caretaker-name">E-mailul pacientului:</label>
                                                        <input type="email" placeholder="anamaria.vasile@provider.tld" class="form-control @error('pacient-email') is-invalid @enderror" name="pacient-email" id="pacient-email" value="{{ old('pacient-email') }}" required />

                                                        @error('pacient-email')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="caretaker-email">E-mailul persoanei care completeaza formularul:</label>
                                                        <input type="email" placeholder="ioan.vasile@provider.tld" class="form-control @error('caretaker-email') is-invalid @enderror" name="caretaker-email" id="caretaker-email" value="{{ old('caretaker-email') }}" required />

                                                        @error('caretaker-email')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="required font-weight-600" for="patient-county">Judet:</label>
                                                                <select name="patient-county" id="patient-county" class="custom-select form-control @error('county') is-invalid @enderror" required>
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
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="required font-weight-600" for="patient-city">Localitate:</label>
                                                                <select name="patient-city" id="patient-city" class="custom-select form-control @error('patient-city') is-invalid @enderror" required>
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
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label  class="required font-weight-600" for="caretaker-name">Diagnostic:</label>
                                                                <input type="text" placeholder="Diagnostic" class="form-control @error('pacient-diagnostic') is-invalid @enderror" name="pacient-diagnostic" id="pacient-diagnostic" value="{{ old('pacient-diagnostic') }}" required />

                                                                @error('pacient-diagnostic')
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
                                                        <div class="col">
                                                            <div class="custom-control custom-checkbox mb-3">
                                                                <input class="custom-control-input" id="customCheck1" type="checkbox">
                                                                <label class="custom-control-label" for="customCheck1">Informare si indrumare catre spitale din tara</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox mb-3">
                                                                <input class="custom-control-input" id="customCheck2" type="checkbox">
                                                                <label class="custom-control-label" for="customCheck2">Informare si indrumare catre spitale din strainatate</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox mb-3">
                                                                <input class="custom-control-input" id="customCheck3" type="checkbox">
                                                                <label class="custom-control-label" for="customCheck3">Traduceri ale documentelor medicale</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox mb-3">
                                                                <input class="custom-control-input" id="customCheck4" type="checkbox">
                                                                <label class="custom-control-label" for="customCheck4">Consultanta privind strangerea de fonduri necesare pentru plata tratamentelor</label>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="custom-control custom-checkbox mb-3">
                                                                <input class="custom-control-input" id="customCheck5" type="checkbox">
                                                                <label class="custom-control-label" for="customCheck5">Alocarea unui numar de SMS pentru strangerea de fonduri</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox mb-3">
                                                                <input class="custom-control-input" id="customCheck6" type="checkbox">
                                                                <label class="custom-control-label" for="customCheck6">Sprijin pentru a gasi optiuni de cazare langa spital</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox mb-3">
                                                                <input class="custom-control-input" id="customCheck7" type="checkbox">
                                                                <label class="custom-control-label" for="customCheck7">Sprijin pentru a gasi medicamentele de care ai nevoie</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox mb-3">
                                                                <input class="custom-control-input" id="customCheck8" type="checkbox">
                                                                <label class="custom-control-label" for="customCheck8">Solutionarea altor nevoi</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-top pt-5 mt-3 clearfix">
                                                        <button type="submit" class="btn btn-secondary pull-right btn-lg px-6" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            <span class="btn-inner--text">Pasul urmator</span>
                                                            <span class="btn-inner--icon ml-2"><i class="fa fa-arrow-right"></i></span>
                                                        </button>
{{--                                                        <button type="submit" class="btn btn-secondary pull-right btn-lg px-6" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">--}}
{{--                                                            <span class="btn-inner--text">Pasul urmator</span>--}}
{{--                                                            <span class="btn-inner--icon ml-2"><i class="fa fa-arrow-right"></i></span>--}}
{{--                                                        </button>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4 shadow invisible">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link w-100 text-left collapsed d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            2. Date necesare pentru alocarea unui numar de SMS pentru strangerea de fonduri
                                            <i class="ni ni-bold-down align-self-center ml-4"></i>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body py-5">
                                        <form action="">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="estimate-sum">Suma estimativa necesara pentru tratament/interventie chirurgicala:</label>
                                                        <input type="text" placeholder="Placeholder text here..." class="form-control" id="estimate-sum" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="destination-sms">Destinatie fonduri stranse in campanie SMS</label>
                                                        <input type="text" placeholder="Placeholder text here..." class="form-control" id="destination-sms" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="clinic-name">Denumire clinica/spital unde este acceptat pacientul:</label>
                                                        <input type="text" placeholder="Placeholder text here..." class="form-control" id="clinic-name" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="required font-weight-600" for="caretaker-name">Tara:</label>
                                                                <select name="" id="" class="custom-select form-control">
                                                                    <option value="">Tara 1</option>
                                                                    <option value="">Tara 2</option>
                                                                    <option value="">Tara 3</option>
                                                                    <option value="">Tara 4</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="required font-weight-600" for="localitate">Localitate:</label>
                                                                <input type="text" placeholder="Placeholder text here..." class="form-control" id="localitate" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border-top pt-5 mt-3 clearfix">
                                                <button type="button" class="btn btn-secondary pull-right btn-lg px-6" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    <span class="btn-inner--text">Pasul urmator</span>
                                                    <span class="btn-inner--icon ml-2"><i class="fa fa-arrow-right"></i></span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4 shadow invisible">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link w-100 text-left collapsed d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            3. Cerere pentru a gasi optiuni de cazare langa spital
                                            <i class="ni ni-bold-down align-self-center ml-4"></i>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body py-5">
                                        <h5 class="mb-5">Te rugam sa completezi campurile de mai jos pentru a te ajuta sa gasesti cea mai buna optiune de cazare langa spital!</h5>
                                        <form action="">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="font-weight-600" for="estimate-sum">La ce spital urmeaza sa fie efectuate investigatiile medicale / tratamentul?</label>
                                                        <input type="text" placeholder="Placeholder text here..." class="form-control" id="estimate-sum" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="caretaker-name">Tara:</label>
                                                        <select name="" id="" class="custom-select form-control">
                                                            <option value="">Tara 1</option>
                                                            <option value="">Tara 2</option>
                                                            <option value="">Tara 3</option>
                                                            <option value="">Tara 4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="caretaker-name">Oras:</label>
                                                        <input type="text" placeholder="Placeholder text here..." class="form-control" id="city" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="caretaker-name">Pentru câte persoane ai nevoie de cazare?</label>
                                                        <input type="text" placeholder="Placeholder text here..." class="form-control" id="no-of-persons" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="date-start">Incepand cu ce data ai nevoie de cazare?</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                            </div>
                                                            <input class="flatpickr flatpickr-input form-control" type="text" placeholder="Select Date..">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600" for="date-end">Până când ai nevoie de cazare?</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                            </div>
                                                            <input class="flatpickr flatpickr-input form-control" type="text" placeholder="Select Date..">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="font-weight-600">Detaliază aici dacă ai nevoie de condiții speciale de cazare:</label>
                                                <textarea name="" id="" rows="5" class="form-control" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."></textarea>
                                            </div>
                                            <div class="pt-5 clearfix">
                                                <button type="button" class="btn btn-secondary pull-right btn-lg px-6" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    <span class="btn-inner--text">Finalizare</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        });
    </script>
@endsection
