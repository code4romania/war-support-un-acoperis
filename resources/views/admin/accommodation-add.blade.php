@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600 mb-3">{{ __('Add accommodation') }}</h6>
        <a href="{{ route('admin.host-detail', $user->id) }}" class="btn btn-sm btn-outline-primary mr-3">{{ __('Back') }}</a>
    </section>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __('Accommodation details') }}
            </h6>
        </div>
        <div class="card-body pt-4">
            <form action="{{ route('admin.accommodation-create', ['userId' => $user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <h6 class="font-weight-600 text-primary mb-3">{{ __('Hosting details') }}</h6>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="type" class="font-weight-600 required">{{ __('Accommodation type') }}?</label>
                            <select class="form-control custom-select @error('type')is-invalid @enderror" name="type" id="type">
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ (old('type') == $type->id) ? 'selected' : '' }}>{{ __($type->name) }}</option>
                            @endforeach
                            </select>

                            @error('type')
                            <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="ownership" class="font-weight-600 required">
                                {{ __('Ownership regime') }}
                            </label>
                            <select class="form-control custom-select @error('ownership')is-invalid @enderror" name="ownership" id="ownership">
                            @foreach($ownershipTypes as $ownershipTypeId => $ownershipTypeValue)
                                <option value="{{ $ownershipTypeId }}" {{ (old('ownership') == $ownershipTypeId) ? 'selected' : '' }}>{{ __($ownershipTypeValue) }}</option>
                            @endforeach
                            </select>

                            @error('ownership')
                            <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 mb-3">
                        <label for="" class="font-weight-600 mt-3 mb-3 required">{{ __('The accommodation is independent or part of your home') }}?</label>
                        <div class="custom-control custom-radio mb-2">
                            <input name="property_availability" class="custom-control-input" id="fully" value="fully" type="radio" {{ (in_array(old('property_availability'), [null, 'fully'])) ? 'checked="checked"' : '' }}>
                            <label class="custom-control-label" for="fully">{{ __('Full accommodation for guests') }}</label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                            <input name="property_availability" class="custom-control-input" id="partially" value="partially" type="radio" {{ ('partially' == old('property_availability')) ? 'checked="checked"' : '' }}>
                            <label class="custom-control-label" for="partially">{{ __('Accommodation with owner in the same premises') }}</label>
                        </div>

                        @error('property_availability')
                        <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="max_guests" class="font-weight-600 required">
                                {{ __('What is the maximum number of guests') }}?
                            </label>
                            <input type="number" min="1" max="127" class="form-control @error('max_guests')is-invalid @enderror" name="max_guests" id="max_guests" placeholder="ex. 3" value="{{ old('max_guests') }}">

                            @error('max_guests')
                            <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="available_rooms" class="font-weight-600 required">
                                {{ __('How many rooms can the hosts use') }}?
                            </label>
                            <input type="number" min="1" max="127" class="form-control @error('available_rooms')is-invalid @enderror" placeholder="ex. 1" name="available_rooms" id="available_rooms" value="{{ old('available_rooms') }}">

                            @error('available_rooms')
                            <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="available_bathrooms" class="font-weight-600 required">
                                {{ __('How many bathrooms does the place have') }}?
                            </label>
                            <input type="number" min="1" max="127" class="form-control @error('available_bathrooms')is-invalid @enderror" placeholder="ex. 1" name="available_bathrooms" id="available_bathrooms" value="{{ old('available_bathrooms') }}">

                            @error('available_bathrooms')
                            <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-sm-6">
                        <label for="allow_kitchen" class="font-weight-600 mb-3 required">{{ __('Allow the use of the kitchen of the accommodated guests') }}?</label>
                        <div class="custom-control custom-radio mb-2">
                            <input name="allow_kitchen" class="custom-control-input" id="disallow_kitchen" value="yes" type="radio" {{ (in_array(old('allow_kitchen'), [null, 'yes'])) ? 'checked="checked"' : '' }}>
                            <label class="custom-control-label" for="disallow_kitchen">{{ __('Yes, it is ready for guests') }}</label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                            <input name="allow_kitchen" class="custom-control-input" id="allow_kitchen" value="no" type="radio" {{ ('no' == old('allow_kitchen')) ? 'checked="checked"' : '' }}>
                            <label class="custom-control-label" for="allow_kitchen">{{ __('No, the kitchen is not accessible') }}</label>
                        </div>

                        @error('allow_kitchen')
                        <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-6">
                        <label for="" class="font-weight-600 mb-3 required">{{ __('The hosts can benefit from a parking space') }}?</label>
                        <div class="custom-control custom-radio mb-2">
                            <input name="allow_parking" class="custom-control-input" id="allow_parking_yes" value="yes" type="radio" {{ (in_array(old('allow_parking'), [null, 'yes'])) ? 'checked="checked"' : '' }}>
                            <label class="custom-control-label" for="allow_parking_yes">{{ __('Yes') }}</label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                            <input name="allow_parking" class="custom-control-input" id="allow_parking_no" value="no" type="radio" {{ ('no' == old('allow_parking')) ? 'checked="checked"' : '' }}>
                            <label class="custom-control-label" for="allow_parking_no">{{ __('No') }}</label>
                        </div>

                        @error('allow_parking')
                        <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="description border-bottom pb-4 mb-4">
                    <label for="description" class="font-weight-600 mb-3">{{ __('Add a property description') }}</label>
                    <textarea id="description" class="form-control" name="description" cols="30" rows="10">{{ old('description') }}</textarea>
                </div>

                <h6 class="font-weight-600 text-primary mb-3">{{ __('Available facilities') }}</h6>
                <div class="row my-3">
                    <div class="col-sm-6">
                        <label for="" class="font-weight-600 mb-3">{{ __('What facilities does the accommodation have') }}?</label>
                        @foreach($generalFacilities as $generalFacility)
                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="general_facility[{{ $generalFacility->id }}]" name="general_facility[{{ $generalFacility->id }}]" value="{{ $generalFacility->id }}" {{ !empty(old('general_facility')[$generalFacility->id]) ? 'checked="checked"' : '' }} type="checkbox">
                                <label class="custom-control-label" for="general_facility[{{ $generalFacility->id }}]">{{ __($generalFacility->name) }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-sm-6">
                        <label for="" class="font-weight-600 mb-3">{{ __('What special facilities does the accommodation space have') }}?</label>

                        @foreach($specialFacilities as $specialFacility)
                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="special_facility[{{ $specialFacility->id }}]" name="special_facility[{{ $specialFacility->id }}]" value="{{ $specialFacility->id }}" {{ !empty(old('special_facility')[$specialFacility->id]) ? 'checked="checked"' : '' }} type="checkbox">
                                <label class="custom-control-label" for="special_facility[{{ $specialFacility->id }}]">{{ __($specialFacility->name) }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="other_facilities" class="font-weight-600">{{ __($otherFacilities->name) }}</label>
                            <input type="text" name="other_facilities" id="other_facilities" value="{{ old('other_facilities') }}" class="form-control @error('other_facilities')is-invalid @enderror" placeholder="{{ __('What other facilities does the accommodation have') }}?">

                            @error('other_facilities')
                            <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="address py-4 border-top border-bottom">
                    <h6 class="font-weight-600 text-primary mb-3">{{ __('Accommodation address') }}</h6>
                    <div class="row">
                        <div class="col-6 col-sm-3">
                            <div class="form-group">
                                <label for="country" class="font-weight-600 required">{{ __('Country') }}</label>
                                <select class="form-control custom-select @error('country')is-invalid @enderror" name="country" id="country">
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ (old('country', 178) == $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>

                                @error('country')
                                <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6 col-sm-3">
                            <div class="form-group">
                                <label for="city" class="font-weight-600 required">{{ __('City') }}</label>
                                <input type="text" class="form-control @error('city')is-invalid @enderror" name="city" id="city" placeholder="ex. Bucuresti" value="{{ old('city') }}">

                                @error('city')
                                <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="street" class="font-weight-600">{{ __('Street') }}</label>
                                <input type="text" class="form-control @error('street')is-invalid @enderror" name="street" id="street" placeholder="ex. Postei 114B" value="{{ old('street') }}">

                                @error('street')
                                <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="building" class="font-weight-600">{{ __('Building') }}</label>
                                        <input type="text" class="form-control @error('building')is-invalid @enderror" name="building" id="building" placeholder="ex. 1A" value="{{ old('building') }}">

                                        @error('building')
                                        <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="entrance" class="font-weight-600">{{ __('Entrance') }}</label>
                                        <input type="text" class="form-control @error('entrance')is-invalid @enderror" name="entrance" id="entrance" placeholder="ex. 2" value="{{ old('entrance') }}">

                                        @error('entrance')
                                        <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="apartment" class="font-weight-600">{{ __('Apartment') }}</label>
                                        <input type="text" class="form-control @error('apartment')is-invalid @enderror" name="apartment" id="apartment" placeholder="ex. 6C" value="{{ old('apartment') }}">

                                        @error('apartment')
                                        <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="floor" class="font-weight-600">{{ __('Floor') }}</label>
                                        <input type="text" class="form-control @error('floor')is-invalid @enderror" name="floor" id="floor" placeholder="ex. Parter" value="{{ old('floor') }}">

                                        @error('floor')
                                        <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="postal_code" class="font-weight-600">{{ __('Postal code') }}</label>
                                <input type="text" class="form-control @error('postal_code')is-invalid @enderror" name="postal_code" id="postal_code" placeholder="ex. 062132" value="{{ old('postal_code') }}">

                                @error('postal_code')
                                <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gallery py-4 border-bottom">
                    <h6 class="font-weight-600 text-primary mb-3">{{ __('Accommodation photos') }}</h6>
                    <input type="file" name="photos" id="photos">

                    @error('photos')
                    <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="rules py-4 border-bottom">
                    <h6 class="font-weight-600 text-primary mb-3">{{ __('House rules') }}</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="font-weight-600 mb-3">{{ __('Smoking is allowed in the house') }}?</label>

                            <div class="custom-control custom-radio mb-2">
                                <input name="allow_smoking" class="custom-control-input" id="allow_smoking_yes" value="yes" type="radio" {{ (in_array(old('allow_smoking'), [null, 'yes'])) ? 'checked="checked"' : '' }}>
                                <label class="custom-control-label" for="allow_smoking_yes">{{ __('Yes') }}</label>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input name="allow_smoking" class="custom-control-input" id="allow_smoking_no" value="no" type="radio" {{ ('no' == old('allow_smoking')) ? 'checked="checked"' : '' }}>
                                <label class="custom-control-label" for="allow_smoking_no">{{ __('No') }}</label>
                            </div>

                            @error('allow_smoking')
                            <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <label for="" class="font-weight-600 mb-3">{{ __('Pets are allowed in the house') }}?</label>

                            <div class="custom-control custom-radio mb-2">
                                <input name="allow_pets" class="custom-control-input" id="allow_pets_yes" value="yes" type="radio" {{ (in_array(old('allow_pets'), [null, 'yes'])) ? 'checked="checked"' : '' }}>
                                <label class="custom-control-label" for="allow_pets_yes">{{ __('Yes') }}</label>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input name="allow_pets" class="custom-control-input" id="allow_pets_no" value="no" type="radio" {{ ('no' == old('allow_pets')) ? 'checked="checked"' : '' }}>
                                <label class="custom-control-label" for="allow_pets_no">{{ __('No') }}</label>
                            </div>

                            @error('allow_pets')
                            <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="other_rules" class="font-weight-600">{{ __('Other house rules') }}</label>
                                <input type="text" name="other_rules" id="other_rules" class="form-control @error('other_rules')is-invalid @enderror" placeholder="{{ __('What other rules are for accommodation') }}?" value="{{ old('other_rules') }}">

                                @error('other_rules')
                                <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="transport py-4 border-bottom">
                    <h6 class="font-weight-600 text-primary mb-3">{{ __('Transport accessibility (distance in meters)') }}</h6>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="transport_subway_distance" class="font-weight-600">{{ __('The nearest metro station') }}:</label>
                                <input type="text" name="transport_subway_distance" id="transport_subway_distance" class="form-control @error('transport_subway_distance')is-invalid @enderror" placeholder="ex. 500 metri" value="{{ old('transport_subway_distance') }}">

                                @error('transport_subway_distance')
                                <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="transport_bus_distance" class="font-weight-600">{{ __('The nearest bus stop') }}:</label>
                                <input type="text" name="transport_bus_distance" id="transport_bus_distance" class="form-control @error('transport_bus_distance')is-invalid @enderror" placeholder="ex. 500 metri" value="{{ old('transport_bus_distance') }}">

                                @error('transport_bus_distance')
                                <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="transport_railway_distance" class="font-weight-600">{{ __('Nearest train station') }}:</label>
                                <input type="text" name="transport_railway_distance" id="transport_railway_distance" class="form-control @error('transport_railway_distance')is-invalid @enderror" placeholder="ex. 500 metri" value="{{ old('transport_railway_distance') }}">

                                @error('transport_railway_distance')
                                <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="transport_other_details" class="font-weight-600">{{ __('Other transport specifications') }}:</label>
                                <input type="text" name="transport_other_details" id="transport_other_details" class="form-control @error('transport_other_details')is-invalid @enderror" placeholder="ex. în proximitatea spitalului" value="{{ old('transport_other_details') }}">

                                @error('transport_other_details')
                                <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="availability py-4 border-bottom">
                    <h6 class="font-weight-600 text-primary mb-3">{{ __('Accommodation availability') }}</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="checkin_time" class="font-weight-600 required">{{ __('Checkin time') }}:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                    <input id="checkin_time" name="checkin_time" class="flatpickr flatpickr-input form-control @error('checkin_time')is-invalid @enderror" type="text" placeholder="{{ __('Select Time') }}" value="{{ old('checkin_time') }}" />
                                </div>

                                @error('checkin_time')
                                <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="checkout_time" class="font-weight-600 required">{{ __('Checkout time') }}:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                    <input id="checkout_time" name="checkout_time" class="flatpickr flatpickr-input form-control @error('checkout_time')is-invalid @enderror" type="text" placeholder="{{ __('Select Time') }}" value="{{ old('checkout_time') }}" />
                                </div>

                                @error('checkout_time')
                                <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="alert bg-light-blue text-dark d-flex align-items-center mb-3 mt-3">
                        <span class="alert-inner--icon mr-3"><i class="fa fa-info-circle"></i></span>
                        <span class="alert-inner--text">Este important să știm dacă în următoarea perioadă sunt și intervale de timp în care cazarea este complet indisponibilă pentru a nu te deranja cu solicitări și pentru a ne ajuta și pe noi să găsim soluții pentru pacienți cât mai rapid.</span>
                    </div>
                    <div id="unavailability_container"></div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="input-group">
                                    <button type="button" id="add-interval" class="btn btn-secondary btn-lg text-nowra">
                                        <span class="btn-inner--text">Adauga perioada</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cost py-4 border-bottom">
                    <h6 class="font-weight-600 text-primary mb-3">{{ __('Fees') }}</h6>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="" class="font-weight-600 mt-3 mb-3 required">{{ __('What are the accommodation costs') }}?</label>
                            <div class="custom-control custom-radio mb-2">
                                <input name="accommodation_fee" class="custom-control-input" id="free" value="free" type="radio" {{ (in_array(old('accommodation_fee'), [null, 'free'])) ? 'checked="checked"' : '' }}>
                                <label class="custom-control-label" for="free">{{ __('Free') }}</label>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input name="accommodation_fee" class="custom-control-input" id="paid" value="paid" type="radio" {{ ('paid' == old('accommodation_fee')) ? 'checked="checked"' : '' }}>
                                <label class="custom-control-label" for="paid">{{ __('Paid') }}</label>
                            </div>

                            @error('property_availability')
                            <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-8 d-none" id="feeSection">
                            <div class="form-group">
                                <label for="general_fee" class="font-weight-600">{{ __('Estimated amount charged per day / week / month if you apply for a financial benefit') }}:</label>
                                <input type="text" name="general_fee" id="general_fee" class="form-control @error('general_fee')is-invalid @enderror" placeholder="ex. 100 RON" value="{{ old('general_fee') }}">

                                @error('general_fee')
                                <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix pt-4">
                    <button type="submit" id="submit-button-2" class="btn btn-secondary pull-right btn-lg px-6">
                        <span class="btn-inner--text">Salveaza</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.tiny.cloud/1/bgsado4b682dgf10owt5ns07i6jh5vcf36tc06nntxc08asr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#description'
        });
        $(document).ready(function () {
            $('input[name=accommodation_fee]').on('change', function() {
                if ('free' === this.value) {
                    $('#feeSection').addClass('d-none');
                } else {
                    $('#feeSection').removeClass('d-none');
                }
            });

            flatpickr("#checkin_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                defaultDate: "{{ old('checkin_time', '15:00') }}",
                time_24hr: true
            });
            flatpickr("#checkout_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                defaultDate: "{{ old('checkout_time', '12:00') }}",
                time_24hr: true
            });
            $('input[name="photos"]').fileuploader({
                captions: $('html').attr('lang'),
                limit: 20,
                maxSize: 50,

                extensions: ['png', 'jpg', 'jpeg'],
                changeInput: ' ',
                theme: 'thumbnails',
                enableApi: true,
                addMore: true,
                thumbnails: {
                    box: '<div class="fileuploader-items">' +
                        '<ul class="fileuploader-items-list">' +
                        '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner"><i>+</i></div></li>' +
                        '</ul>' +
                        '</div>',
                    item: '<li class="fileuploader-item">' +
                        '<div class="fileuploader-item-inner">' +
                        '<div class="type-holder">${extension}</div>' +
                        '<div class="actions-holder">' +
                        '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></button>' +
                        '</div>' +
                        '<div class="thumbnail-holder">' +
                        '${image}' +
                        '<span class="fileuploader-action-popup"></span>' +
                        '</div>' +
                        '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                        '<div class="progress-holder">${progressBar}</div>' +
                        '</div>' +
                        '</li>',
                    item2: '<li class="fileuploader-item">' +
                        '<div class="fileuploader-item-inner">' +
                        '<div class="type-holder">${extension}</div>' +
                        '<div class="actions-holder">' +
                        '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download><i class="fileuploader-icon-download"></i></a>' +
                        '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></button>' +
                        '</div>' +
                        '<div class="thumbnail-holder">' +
                        '${image}' +
                        '<span class="fileuploader-action-popup"></span>' +
                        '</div>' +
                        '<div class="content-holder"><h5 title="${name}">${name}</h5><span>${size2}</span></div>' +
                        '<div class="progress-holder">${progressBar}</div>' +
                        '</div>' +
                        '</li>',
                    startImageRenderer: true,
                    canvasImage: false,
                    _selectors: {
                        list: '.fileuploader-items-list',
                        item: '.fileuploader-item',
                        start: '.fileuploader-action-start',
                        retry: '.fileuploader-action-retry',
                        remove: '.fileuploader-action-remove'
                    },
                    onItemShow: function(item, listEl, parentEl, newInputEl, inputEl) {
                        var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                            api = $.fileuploader.getInstance(inputEl.get(0));

                        plusInput.insertAfter(item.html)[api.getOptions().limit && api.getChoosedFiles().length >= api.getOptions().limit ? 'hide' : 'show']();

                        if(item.format == 'image') {
                            item.html.find('.fileuploader-item-icon').hide();
                        }
                    },
                    onItemRemove: function(html, listEl, parentEl, newInputEl, inputEl) {
                        var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                            api = $.fileuploader.getInstance(inputEl.get(0));

                        html.children().animate({'opacity': 0}, 200, function() {
                            html.remove();

                            if (api.getOptions().limit && api.getChoosedFiles().length - 1 < api.getOptions().limit)
                                plusInput.show();
                        });
                    }
                },
                dragDrop: {
                    container: '.fileuploader-thumbnails-input'
                },
                afterRender: function(listEl, parentEl, newInputEl, inputEl) {
                    var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                        api = $.fileuploader.getInstance(inputEl.get(0));

                    plusInput.on('click', function() {
                        api.open();
                    });

                    api.getOptions().dragDrop.container = plusInput;
                },

                /*
                // while using upload option, please set
                // startImageRenderer: false
                // for a better effect
                upload: {
                    url: './php/upload_file.php',
                    data: null,
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    start: true,
                    synchron: true,
                    beforeSend: null,
                    onSuccess: function(result, item) {
                        var data = {};

                        if (result && result.files)
                            data = result;
                        else
                            data.hasWarnings = true;

                        // if success
                        if (data.isSuccess && data.files.length) {
                            item.name = data.files[0].name;
                            item.html.find('.content-holder > h5').text(item.name).attr('title', item.name);
                        }

                        // if warnings
                        if (data.hasWarnings) {
                            for (var warning in data.warnings) {
                                alert(data.warnings[warning]);
                            }

                            item.html.removeClass('upload-successful').addClass('upload-failed');
                            return this.onError ? this.onError(item) : null;
                        }

                        item.html.find('.fileuploader-action-remove').addClass('fileuploader-action-success');

                        setTimeout(function() {
                            item.html.find('.progress-holder').hide();
                            item.renderThumbnail();

                            item.html.find('.fileuploader-action-popup, .fileuploader-item-image').show();
                        }, 400);
                    },
                    onError: function(item) {
                        item.html.find('.progress-holder, .fileuploader-action-popup, .fileuploader-item-image').hide();
                    },
                    onProgress: function(data, item) {
                        var progressBar = item.html.find('.progress-holder');

                        if(progressBar.length > 0) {
                            progressBar.show();
                            progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                        }

                        item.html.find('.fileuploader-action-popup, .fileuploader-item-image').hide();
                    }
                },
                onRemove: function(item) {
                    $.post('php/upload_remove.php', {
                        file: item.name
                    });
                }
                */
            });
        });
    </script>
@endsection

@section('templates')
    @include('partials.unavailability')
@endsection

