@extends('layouts.app')

@section('content')
    <div class="container pt-sm-6 pb-sm-5 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="display-3 title mb-4 text-primary">{{ __('Get Involved') }}</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>
    </div>
    <section class="bg-light-green py-5">
        <div class="container">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary">
                    <h5 class="mb-0 text-white">
                        Informatii generale
                    </h5>
                </div>
                <div class="card-body py-5">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="required font-weight-600" for="full-name">{{ __("Name and surname") }}:</label>
                                <input type="text" placeholder="Ana-Maria Vasile" class="form-control @error('name') is-invalid @enderror" name="full-name" id="full-name" value="{{ old('full-name') }}" />

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
                                        <select name="patient-country" id="patient-county" class="custom-select form-control @error('patient-county') is-invalid @enderror">
                                            <option>Select country</option>
                                            <option value="Tara 1">Tara 1</option>
                                        </select>

                                        @error('patient-county')
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
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="font-weight-600" for="address">{{ __('Address') }}:</label>
                                <input type="text" placeholder="Street name, no, etc" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" />

                                @error('sms-clinic-city')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="required font-weight-600" for="phone">{{ __("Phone Number") }}:</label>
                                <input type="tel" placeholder="+40 760 000 000" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" />

                                @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="required font-weight-600" for="email">{{ __("E-Mail Address") }}:</label>
                                <input type="email" placeholder="ana.iordache@gmail.com" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" />

                                @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <label for="" class="font-weight-600 mb-3 mt-3 d-block required">Ce tip de ajutor doresti sa oferi?</label>
                    <div class="form-check form-check-inline mb-3">
                        <div class="custom-control custom-checkbox mr-3 mb-3">
                            <input class="custom-control-input" id="help1" name="help1" type="checkbox">
                            <label class="custom-control-label" for="help1">Cazare</label>
                        </div>
                        <div class="custom-control custom-checkbox mr-3 mb-3">
                            <input class="custom-control-input" id="help2" name="help2" type="checkbox">
                            <label class="custom-control-label" for="help2">Transport</label>
                        </div>
                        <div class="custom-control custom-checkbox mr-3 mb-3">
                            <input class="custom-control-input" id="help3" name="help3" type="checkbox">
                            <label class="custom-control-label" for="help3">Medicamente</label>
                        </div>
                        <div class="custom-control custom-checkbox mr-3 mb-3">
                            <input class="custom-control-input" id="help4" name="help4" type="checkbox">
                            <label class="custom-control-label" for="help4">Bunuri</label>
                        </div>
                        <div class="custom-control custom-checkbox mr-3 mb-3">
                            <input class="custom-control-input" id="help5" name="help5" type="checkbox">
                            <label class="custom-control-label" for="help5">Traduceri acte medicale</label>
                        </div>
                        <div class="custom-control custom-checkbox mr-3 mb-3">
                            <input class="custom-control-input" id="help6" name="help6" type="checkbox">
                            <label class="custom-control-label" for="help6">Servicii</label>
                        </div>
                        <div class="custom-control custom-checkbox mr-3 mb-3">
                            <input class="custom-control-input" id="help7" name="help7" type="checkbox">
                            <label class="custom-control-label" for="help7">Alte tipuri de ajutor</label>
                        </div>
                    </div>

                    <!-- Other help type -->
                    <div class="row d-none" id="other-help">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Alt tip de ajutor</label>
                                <input type="text" class="form-control" placeholder="Scrie aici ce tip de ajutor vrei sa oferi">
                            </div>
                        </div>
                    </div>

                    <!-- Accomodation sign in alert -->
                    <div class="alert bg-light-green alert-general alert-secondary mb-0  align-items-sm-center d-none" role="alert" id="accomodation-alert">
                        <span class="alert-inner--icon mr-3"><i class="fa fa-info-circle"></i></span>
                        <span class="alert-inner--text"><b>Ajutorul de cazare</b> poate fi gestionat prin intermediul unui cont pe platforma. In urma inregistrarii veti primi pe adresa dumneavoastra de email datele de logare si informatii suplimentare!</span>
                    </div>

                    <div class="border-top pt-5 mt-3 clearfix">
                        <button type="submit" id="submit-button-2" class="btn btn-secondary pull-right btn-lg px-6">
                            <span class="btn-inner--text">{{ __('Send request') }}</span>
                            <span class="btn-inner--icon ml-2"><i class="fa fa-arrow-right"></i></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#help1').on('change', function() {
                if ($('#help1').is(':checked')) {
                    $('#accomodation-alert').removeClass('d-none').addClass('d-flex');
                } else {
                    $('#accomodation-alert').addClass('d-none').removeClass('d-flex');
                }
            });
            $('#help7').on('change', function() {
                if ($('#help7').is(':checked')) {
                    $('#other-help').removeClass('d-none');
                } else {
                    $('#other-help').addClass('d-none');
                }
            });
        });
    </script>
@endsection
