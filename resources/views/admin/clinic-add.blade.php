@extends('layouts.admin')

@section('content')
    <section class="">
        <h6 class="page-title font-weight-600">Adaugă Clinică</h6>
    </section>
    <div class="card shadow">
        <form method="post" action="{{ route('admin.clinic-create') }}">
            @csrf
            <div class="card-header bg-admin-blue py-3">
                <h6 class="font-weight-600 text-white mb-0">
                    Informații clinică
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="required font-weight-600" for="name">Nume clinică:</label>
                            <input type="text" placeholder="Vienna General Hospital" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" />

                            @error('name')
                            <span class="invalid-feedback d-flex" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="font-weight-600" for="name_english">Nume clinică engleză:</label>
                            <input type="text" placeholder="Vienna General Hospital" class="form-control @error('name_english') is-invalid @enderror" name="name_english" id="name_english" value="{{ old('name_english') }}" />

                            @error('name_english')
                            <span class="invalid-feedback d-flex" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="font-weight-600 required" for="categories">Categorii:</label>
                            <div class="@error('categories') is-invalid @enderror">
                                <select class="form-control" data-trigger name="categories[]" id="categories" multiple>
                                    @foreach($specialities as $speciality)
                                        <option value="{{ $speciality->id }}" {{ in_array($speciality->id, (array)old('categories')) ? 'selected' : '' }}>{{ $speciality->parent->name . ' > ' . $speciality->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('categories')
                            <span class="invalid-feedback d-flex" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="required font-weight-600" for="country">Țara</label>
                                    <select name="country" id="country" class="custom-select form-control @error('country') is-invalid @enderror">
                                        <option>Selectati Țara</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('country') == $country->id ? 'selected="selected"' : '' }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('country')
                                    <span class="invalid-feedback d-flex" role="alert">
                                    {{ $message }}
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="required font-weight-600" for="city">Localitatea:</label>
                                    <input type="text" placeholder="Viena" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" />

                                    @error('city')
                                    <span class="invalid-feedback d-flex" role="alert">
                                    {{ $message }}
                                </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="font-weight-600 required" for="address">Adresa:</label>
                            <input type="text" placeholder="Strada, numarul, etc." class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" />

                            @error('address')
                            <span class="invalid-feedback d-flex" role="alert">
                            {{ $message }}
                        </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="required font-weight-600" for="phone">Număr de telefon:</label>
                            <input type="tel" placeholder="0742000000" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}" />

                            @error('phone')
                            <span class="invalid-feedback d-flex" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="font-weight-600 required" for="website">Website:</label>
                            <input type="url" placeholder="https://www.domain.tld" class="form-control @error('website') is-invalid @enderror" name="website" id="website" value="{{ old('website') }}" />

                            @error('website')
                            <span class="invalid-feedback d-flex" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="font-weight-600" for="website">Adresă e-mail:</label>
                            <input type="email" placeholder="office@clinic.com" class="form-control @error('office_email') is-invalid @enderror" name="office_email" id="website" value="{{ old('office_email') }}" />

                            @error('office_email')
                            <span class="invalid-feedback d-flex" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="py-3 mt-4 mb-4 border-top border-bottom">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="font-weight-600" for="contact_name">Nume persoană de contact:</label>
                                <input type="text" placeholder="Johan Donald" class="form-control @error('contact_name') is-invalid @enderror" name="contact_name" id="contact_name" value="{{ old('contact_name') }}" />

                                @error('contact_name')
                                <span class="invalid-feedback d-flex" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="font-weight-600" for="contact_name_english">Nume persoană de contact engleză:</label>
                                <input type="text" placeholder="Johan Donald" class="form-control @error('contact_name_english') is-invalid @enderror" name="contact_name_english" id="contact_name_english" value="{{ old('contact_name_english') }}" />

                                @error('contact_name_english')
                                <span class="invalid-feedback d-flex" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="font-weight-600" for="contact_phone">Telefon persoană de contact:</label>
                                <input type="tel" placeholder="0742000000" class="form-control @error('contact_phone') is-invalid @enderror" name="contact_phone" id="contact_phone" value="{{ old('contact_phone') }}" />

                                @error('contact_phone')
                                <span class="invalid-feedback d-flex" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="font-weight-600" for="contact_email">Email persoană de contact:</label>
                                <input type="email" placeholder="johan.donald@gmail.com" class="form-control @error('contact_email') is-invalid @enderror" name="contact_email" id="contact_email" value="{{ old('contact_email') }}" />

                                @error('contact_email')
                                <span class="invalid-feedback d-flex" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="description mb-5">
                    <div class="form-group">
                        <label for="description" class="font-weight-600">Descriere:</label>
                        <textarea name="description" id="description" class="form-control" rows="6">{{ old('description') }}</textarea>

                        @error('description')
                        <span class="invalid-feedback d-flex" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="description mb-5">
                    <div class="form-group">
                        <label for="description_english" class="font-weight-600">Descriere engleză:</label>
                        <textarea name="description_english" id="description_english" class="form-control" rows="6">{{ old('description_english') }}</textarea>

                        @error('description_english')
                        <span class="invalid-feedback d-flex" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="extra-info mb-5">
                    <div class="form-group">
                        <label for="extra_details" class="font-weight-600">Informații suplimentare:</label>
                        <textarea name="extra_details" id="extra_details" class="form-control" rows="6">{{ old('extra_details') }}</textarea>

                        @error('extra_details')
                        <span class="invalid-feedback d-flex" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="extra-info mb-5">
                    <div class="form-group">
                        <label for="extra_details_english" class="font-weight-600">Informații suplimentare engleză:</label>
                        <textarea name="extra_details_english" id="extra_details_english" class="form-control" rows="6">{{ old('extra_details_english') }}</textarea>

                        @error('extra_details_english')
                        <span class="invalid-feedback d-flex" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="transportation">
                    <div class="form-group">
                        <label for="transport_details" class="font-weight-600">Modalități de transport:</label>
                        <textarea name="transport_details" id="transport_details" class="form-control" rows="6">{{ old('transport_details') }}</textarea>

                        @error('transport_details')
                        <span class="invalid-feedback d-flex" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="transportation">
                    <div class="form-group">
                        <label for="transport_details_english" class="font-weight-600">Modalități de transport engleză:</label>
                        <textarea name="transport_details_english" id="transport_details_english" class="form-control" rows="6">{{ old('transport_details_english') }}</textarea>

                        @error('transport_details_english')
                        <span class="invalid-feedback d-flex" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="border-top pt-4 pb-3 mt-5 clearfix">
                    <button type="submit" id="submit-button-2" class="btn btn-secondary pull-right btn-lg px-6">
                            <span class="btn-inner--text">Salvează</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{config('tiny.url')}}" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        tinymce.init({selector: '#description', menubar: false });
        tinymce.init({selector: '#extra_details', menubar: false });
        tinymce.init({selector: '#transport_details', menubar: false });

        tinymce.init({selector: '#description_english', menubar: false });
        tinymce.init({selector: '#extra_details_english', menubar: false });
        tinymce.init({selector: '#transport_details_english', menubar: false });

        new Choices('#categories', {
            search: false,
            delimiter: ',',
            editItems: true,
            removeItemButton: true,
            placeholder: true,
            placeholderValue: 'Selectați o categorie'
        });
    </script>
@endsection
