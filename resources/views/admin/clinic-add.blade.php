@extends('layouts.admin')

@section('content')
    <section class="">
        <h6 class="page-title font-weight-600">Add Clinic</h6>
    </section>
    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3">
            <h6 class="font-weight-600 text-white mb-0">
                Informatii clinica
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="required font-weight-600" for="full-name">Nume clinica:</label>
                        <input type="text" placeholder="Clinica x" class="form-control @error('name') is-invalid @enderror" name="full-name" id="full-name" value="{{ old('full-name') }}" />

                        @error('full-name')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="font-weight-600" for="full-name">Categorie:</label>
                        <select class="form-control" data-trigger name="choices-multiple-default" id="choices-multiple-default" multiple >
                            <option value="Selectati o categorie" disabled>Selectati o categorie</option>
                            <option value="2">Paris </option>
                            <option value="3">Bucharest</option>
                            <option value="4">Rome</option>
                            <option value="5">New York</option>
                            <option value="6">Miami </option>
                            <option value="7">Los Santos</option>
                            <option value="8">Sydney</option>
                            <option value="9">Piatra Neamt</option>
                        </select>

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
                        <label class="required font-weight-600" for="email">Website:</label>
                        <input type="url" placeholder="ana.iordache@gmail.com" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" />

                        @error('email')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="py-3 mt-4 mb-4 border-top border-bottom">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="required font-weight-600" for="phone">Nume persoana de contact:</label>
                            <input type="tel" placeholder="+40 760 000 000" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" />

                            @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="required font-weight-600" for="phone">Telefon persoana de contact:</label>
                            <input type="tel" placeholder="+40 760 000 000" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" />

                            @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="required font-weight-600" for="email">Email persoana de contact:</label>
                            <input type="email" placeholder="ana.iordache@gmail.com" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" />

                            @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="description mb-5">
                <div class="form-group">
                    <label for="" class="font-weight-600">Descriere</label>
                    <textarea name="" id="mytextarea2" class="form-control" rows="6"></textarea>
                </div>
            </div>
            <div class="extra-info mb-5">
                <div class="form-group">
                    <label for="" class="font-weight-600">Informatii suplimentare:</label>
                    <textarea name="" id="mytextarea" class="form-control" rows="6"></textarea>
                </div>
            </div>
            <div class="transportation">
                <div class="form-group">
                    <label for="" class="font-weight-600">Modalitati de transport</label>
                    <textarea name="" id="mytextarea3" class="form-control" rows="6"></textarea>
                </div>
            </div>
            <div class="border-top pt-4 pb-3 mt-5 clearfix">
                <button type="submit" id="submit-button-2" class="btn btn-secondary pull-right btn-lg px-6">
                    <span class="btn-inner--icon mr-2"><i class="fa fa-plus"></i></span>
                    <span class="btn-inner--text">Adauga</span>
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.tiny.cloud/1/bgsado4b682dgf10owt5ns07i6jh5vcf36tc06nntxc08asr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
        tinymce.init({
            selector: '#mytextarea2'
        });
        tinymce.init({
            selector: '#mytextarea3'
        });
        new Choices('#choices-multiple-default', {
            search: false,
            delimiter: ',',
            editItems: true,
            removeItemButton: true,
            placeholder: true,
            placeholderValue: 'Selectati o categorie'
        });
    </script>
@endsection
