@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600">Edit Profile</h6>
    </section>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                Informatii Personale
            </h6>
        </div>
        <div class="card-body pt-4">
            <form action="">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="required font-weight-600">Nume si prenume</label>
                            <input type="text" class="form-control" placeholder="Nume si prenume">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
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
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="required font-weight-600" for="sms-clinic-city">{{ __('City') }}:</label>
                            <input type="text" placeholder="Viena" class="form-control @error('sms-clinic-city') is-invalid @enderror" id="sms-clinic-city" name="sms-clinic-city" value="{{ old('sms-clinic-city') }}" />

                            @error('sms-clinic-city')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
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
                            <label class="required font-weight-600" for="email">Email:</label>
                            <input type="email" placeholder="ana.iordache@gmail.com" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" />

                            @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="border-top pt-4 pb-3 mt-5 clearfix">
                    <button type="submit" id="submit-button-2" class="btn btn-secondary pull-right btn-lg px-6">
                        <span class="btn-inner--text">Salveaza</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

