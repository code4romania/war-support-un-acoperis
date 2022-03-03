<form action="{{route('share.accommodation.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <h5 class="font-weight-600 mb-3">{{ __('Accommodation details') }}</h5>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label for="ownership" class="font-weight-600 required">
                    {{ __('Ownership regime') }}
                </label>
                <select class="form-control custom-select @error('ownership')is-invalid @enderror" name="ownership" id="ownership">
                    <option value="">{{ __("Select property type") }}</option>

                    @foreach($ownershipTypes as $ownershipTypeId => $ownershipTypeValue)
                        <option value="{{ $ownershipTypeId }}" {{ (old('ownership') == $ownershipTypeId) ? 'selected' : '' }}>{{ __($ownershipTypeValue) }}</option>
                    @endforeach
                </select>

                @error('ownership')
                <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label for="type" class="font-weight-600 required">{{ __('Accommodation type') }}?</label>
                <select class="form-control custom-select @error('type')is-invalid @enderror" name="type" id="type">
                    <option value="">{{ __("Select accomodation type") }}</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ (old('type') == $type->id) ? 'selected' : '' }}>{{ __($type->name) }}</option>
                    @endforeach
                </select>

                @error('type')
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

        <div class="col-sm-3">
            <div class="form-group">
                <label for="max_guests" class="font-weight-600 required">
                    {{ __('Maximum guests number') }}?
                </label>
                <input type="number" min="1" max="127" class="form-control @error('max_guests')is-invalid @enderror" name="max_guests" id="max_guests" placeholder="ex. 3" value="{{ old('max_guests') }}">

                @error('max_guests')
                <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                <label for="available_rooms" class="font-weight-600 required">
                    {{ __('Number of rooms for sleep') }}?
                </label>
                <input type="number" min="1" max="127" class="form-control @error('available_rooms')is-invalid @enderror" placeholder="ex. 1" name="available_rooms" id="available_rooms" value="{{ old('available_rooms') }}">

                @error('available_rooms')
                <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                <label for="available_beds" class="font-weight-600 required">
                    {{ __('Number of beds') }}?
                </label>
                <input type="number" min="1" max="127" class="form-control @error('available_beds')is-invalid @enderror" placeholder="ex. 1" name="available_beds" id="available_beds" value="{{ old('available_beds') }}">

                @error('available_beds')
                <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-sm-3">
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
        <div class="col-sm-12">
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

        <div class="col-sm-12">
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

    <h5 class="font-weight-600 mb-3">{{ __('Accomodation facilities') }}</h5>
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
        <h5 class="font-weight-600 mb-3">{{ __('Accommodation address') }}</h5>
        <div class="row">
            {{--                        <div class="col-6 col-sm-3">--}}
            {{--                            <div class="form-group">--}}
            {{--                                <label for="country" class="font-weight-600 required">{{ __('Country') }}</label>--}}
            {{--                                <select class="form-control custom-select @error('country')is-invalid @enderror" name="country" id="country">--}}
            {{--                                    <option value="">{{ __("Select country") }}</option>--}}
            {{--                                    @foreach($countries as $country)--}}
            {{--                                    <option value="{{ $country->id }}" {{ (old('country') == $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>--}}
            {{--                                    @endforeach--}}
            {{--                                </select>--}}

            {{--                                @error('country')--}}
            {{--                                <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>--}}
            {{--                                @enderror--}}
            {{--                            </div>--}}
            {{--                        </div>--}}

            {{-- @TODO: duplicate code, see signup-form.blade.php. Someone with more Blade knowledge maybe knows how to do this better --}}
            <div class="col-12 col-sm-6 col-md-3">
                <div class="form-group">
                    <label class="required font-weight-600" for="county_id">{{ __('County') }}:</label>

                    <select name="county_id" id="county_id" class="custom-select form-control @error('county') is-invalid @enderror">
                        <option>{{ __("Select County") }}</option>
                        @foreach ($counties as $county)
                            <option value="{{ $county->id }}"{{ old('county_id') == $county->id ? ' selected' : '' }}>{{ $county->name }}</option>
                        @endforeach
                    </select>

                    @error('county_id')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- end duplicate --}}


            <div class="col-12 col-sm-6 col-md-3">
                <div class="form-group">
                    <label for="city" class="font-weight-600 required">{{ __('City') }}</label>
                    <input type="text" class="form-control @error('city')is-invalid @enderror" name="city" id="city" placeholder="ex. Bucuresti" value="{{ old('city') }}">

                    @error('city')
                    <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
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
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-6 col-md-3">
                        <div class="form-group">
                            <label for="building" class="font-weight-600">{{ __('Building') }}</label>
                            <input type="text" class="form-control @error('building')is-invalid @enderror" name="building" id="building" placeholder="ex. 1A" value="{{ old('building') }}">

                            @error('building')
                            <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="form-group">
                            <label for="entrance" class="font-weight-600">{{ __('Entrance') }}</label>
                            <input type="text" class="form-control @error('entrance')is-invalid @enderror" name="entrance" id="entrance" placeholder="ex. 2" value="{{ old('entrance') }}">

                            @error('entrance')
                            <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="form-group">
                            <label for="apartment" class="font-weight-600">{{ __('Apartment') }}</label>
                            <input type="text" class="form-control @error('apartment')is-invalid @enderror" name="apartment" id="apartment" placeholder="ex. 6C" value="{{ old('apartment') }}">

                            @error('apartment')
                            <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
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
            <div class="col-12 col-sm-6 col-md-3">
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
        <h5 class="font-weight-600 mb-3">{{ __('Accommodation photos') }} ({{ __('at least one phone required') }})</h5>
        <input type="file" name="photos" id="photos">

        @error('photos')
        <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
        @enderror
    </div>
    <div class="rules py-4 border-bottom">
        <h5 class="font-weight-600 mb-3">{{ __('House rules') }}</h5>
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
        <h5 class="font-weight-600 mb-3">{{ __('Transport accessibility (distance in meters)') }}</h5>
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
        <h5 class="font-weight-600 mb-3">{{ __('Accommodation availability') }}</h5>
        <div class="alert bg-light-blue text-dark d-flex align-items-center mb-3 mt-3">
            <span class="alert-inner--icon mr-3"><i class="fa fa-info-circle"></i></span>
            <span class="alert-inner--text">{{ __('Please mention if the availability is limited') }}</span>
        </div>

        <div id="availability_container"></div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <div class="input-group">
                        <button type="button" id="add-interval" class="btn btn-secondary btn-lg text-nowra">
                            <span class="btn-inner--text">{{ __('Add interval') }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix pt-4">
        <button type="submit" id="submit-button-2" class="btn btn-secondary pull-right btn-lg px-6">
            <span class="btn-inner--text">{{ __('Save') }}</span>
        </button>
    </div>
</form>
