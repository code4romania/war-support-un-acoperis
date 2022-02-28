                    <form method="POST" action="{{ $formRoute }}" id="sendGetInvolved">
                        @csrf
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
                                <div class="col-sm-6">
                                    <div><label class="required font-weight-600" for="phone">{{ __("Phone Number") }}:</label></div>
                                    <input type="tel" placeholder="0742000000" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}" />
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
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

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        {{--                                <div class="col-sm-6">--}}
                                        {{--                                    <div class="form-group">--}}
                                        {{--                                        <label class="required font-weight-600" for="sms-clinic-country">{{ __('Country') }}:</label>--}}
                                        {{--                                        <select name="country" id="country" class="custom-select form-control @error('country') is-invalid @enderror">--}}
                                        {{--                                            <option>{{ __("Select country") }}</option>--}}
                                        {{--                                            @foreach ($countries as $country)--}}
                                        {{--                                                <option value="{{ $country->id }}"{{ old('country') == $country->id ? ' selected' : '' }}>{{ __('countries.' . $country->name) }}</option>--}}
                                        {{--                                            @endforeach--}}
                                        {{--                                        </select>--}}

                                        {{--                                        @error('country')--}}
                                        {{--                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>--}}
                                        {{--                                        @enderror--}}
                                        {{--                                    </div>--}}
                                        {{--                                </div>--}}

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="required font-weight-600" for="county_id">{{ __('County') }}:</label>
                                                <select name="county_id" id="county_id" class="custom-select form-control @error('county_id') is-invalid @enderror">
                                                    <option>{{ __("Select county") }}</option>
                                                    @foreach ($counties as $county)
                                                        <option value="{{ $county->id }}"{{ old('county_id') == $county->id ? ' selected' : '' }}>{{ $county->name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('county_id')
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
                                @error('g-recaptcha-response')
                                <span class="invalid-feedback d-flex" role="alert">{{ $errors->first('g-recaptcha-response') }}</span>
                                @enderror

                                {!! NoCaptcha::displaySubmit('sendGetInvolved', "" . __('Continue') . "
                                    <i class=\"fa fa-arrow-right\"></i>", ['type' => 'submit',  "id" => "submit-button-2", 'class' => 'btn btn-secondary btn-h4h-offer-help-submit pull-right btn-lg px-6']) !!}
                            </div>
                        </div>
                    </form>
