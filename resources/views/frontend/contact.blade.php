@extends('layouts.app')

@section('content')
    <div class="container pt-sm-6 pb-sm-5 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="display-3 title mb-4 text-primary">{{ __('Contact') }}</h1>
        <p>{!! $description !!}</p>
    </div>
    <section class="bg-light-green py-5">
        <div class="container">
            <form method="POST" action="{{ route('send-contact') }}" id="sendContact">
                @csrf
                <div class="card shadow mb-4">
                    <div class="card-body py-5">
                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="required font-weight-600"
                                           for="name">{{ __("Institution/Organisation name") }}:</label>
                                    <input type="text"
                                           placeholder="{{ __('Institution/Organisation name placeholder') }}"
                                           class="form-control @error('institution') is-invalid @enderror"
                                           name="institution" id="institution" value="{{ old('institution') }}"/>
                                    @error('institution')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="required font-weight-600"
                                           for="type">{{ __("Type: Institution / NGO") }}:</label>
                                    <select class="form-control @error('institution_type') is-invalid @enderror" name='institution_type' id="type" >
                                    @foreach($institutionTypes as $type => $value)
                                        <option value="{{ $type }}" @if(old('institution_type') == $type ) selected @endif>{{ $value }}</option>
                                    @endforeach
                                    </select>
                                    @error('institution_type')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="required font-weight-600" for="contact">
                                        {{ __("Contact person") }}:
                                    </label>
                                    <input type="text" placeholder="{{ __('Contact person placeholder') }}"
                                           class="form-control @error('contact_person_name') is-invalid @enderror"
                                           name="contact_person_name" id="contact"
                                           value="{{ old('contact_person_name') }}"/>
                                    @error('contact_person_name')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="required font-weight-600" for="email">{{ __("E-Mail Address") }}
                                        :</label>
                                    <input type="email" placeholder="{{ __('Email placeholder') }}"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           id="email" value="{{ old('email') }}"/>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="required font-weight-600" for="phone">{{ __("Phone Number") }}
                                        :</label>
                                    <input type="tel" placeholder="0742000000"
                                           class="form-control @error('phone') is-invalid @enderror" name="phone"
                                           id="phone" value="{{ old('phone') }}"/>

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="required font-weight-600"
                                           for="legrep">{{ __("Legal representative name") }}:</label>
                                    <input type="text" placeholder="{{ __('Legal representative name placeholder') }}"
                                           class="form-control @error('legally_represented') is-invalid @enderror"
                                           name="legally_represented" id="legrep"
                                           value="{{ old('legally_represented') }}"/>

                                    @error('legally_represented')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="required font-weight-600" for="idno">
                                        {{ __("Identification no") }}:</label>
                                    <input type="text" placeholder="CUI 1234567"
                                           class="form-control @error('company_identifier') is-invalid @enderror"
                                           name="company_identifier" id="idno" value="{{ old('company_identifier') }}"/>

                                    @error('company_identifier')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="required font-weight-600" for="address">
                                        {{ __("Physical address") }}:
                                    </label>
                                    <input type="text" placeholder="{{ __('Physical address placeholder') }}"
                                           class="form-control @error('address') is-invalid @enderror" name="address"
                                           id="address" value="{{ old('address') }}"/>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="required font-weight-600" for="support_type">
                                        {{ __("Type of support: Offer housing / Request housing for refugees") }}:
                                    </label>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="support_type"
                                               value="offer_housing" id="offer_housing">
                                        <label class="form-check-label" for="offer_housing">
                                            {{ __("Offer housing") }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="support_type"
                                               value="request_housing_for_refugees" id="request_housing_for_refugees">
                                        <label class="form-check-label" for="request_housing_for_refugees">
                                            {{ __("Request housing for refugees") }}
                                        </label>
                                        @error('support_type')
                                        <input class="form-control d-none @error('support_type') is-invalid @enderror"/>
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="gdpr" id="gdpr">
                                    <label class="form-check-label" for="gdpr">
                                        {!! __('I agree with <a href=":url">GDPR</a> terms.',['url'=>'#']) !!}
                                    </label>

                                    @error('gdpr')
                                    <input class="form-control d-none @error('gdpr') is-invalid @enderror"/>
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-5 mt-3 clearfix">
                            @error('g-recaptcha-response')
                            <span class="invalid-feedback d-flex" role="alert">
                                {{ $errors->first('g-recaptcha-response') }}
                            </span>
                            @enderror
                            {!! NoCaptcha::displaySubmit('sendContact', "<span class=\"btn-inner--text\">" . __('Send request') . "</span>
                                <span class=\"btn-inner--icon ml-2\"><i class=\"fa fa-arrow-right\"></i></span>", ['type' => 'submit',  "id" => "submit-button-2", 'class' => 'btn btn-secondary pull-right btn-lg px-6']) !!}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    {!! NoCaptcha::renderJs(request()->route()->parameters['locale']) !!}
@endsection
