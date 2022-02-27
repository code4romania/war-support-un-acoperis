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
                                <label class="required font-weight-600" for="name">{{ __("Institution/Organisation name") }}:</label>
                                <input type="text" placeholder="{{ __('Institution/Organisation name placeholder') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" />

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
                                <label class="required font-weight-600" for="type">{{ __("Type: Institution / NGO") }}:</label>
                                <!-- <input type="text" placeholder="{{ __('Institution/Organisation name placeholder') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" /> -->
                                <select class="form-control @error('name') is-invalid @enderror" name="type" id="type" value="{{ old('type') }}" >
                                    <option>{{ __("Public institution option") }}</option>
                                    <option>{{ __("NGO option") }}</option>
                                </select>
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
                                <label class="required font-weight-600" for="contact">{{ __("Contact person") }}:</label>
                                <input type="text" placeholder="{{ __('Contact person placeholder') }}" class="form-control @error('contact') is-invalid @enderror" name="contact" id="contact" value="{{ old('contact') }}" />

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
                                <label class="required font-weight-600" for="email">{{ __("E-Mail Address") }}:</label>
                                <input type="email" placeholder="{{ __('Email placeholder') }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" />

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
                                <label class="required font-weight-600" for="phone">{{ __("Phone Number") }}:</label>
                                <input type="tel" placeholder="0742000000" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}" />
                            
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
                                <label class="required font-weight-600" for="legrep">{{ __("Legal representative name") }}:</label>
                                <input type="text" placeholder="{{ __('Legal representative name placeholder') }}" class="form-control @error('legrep') is-invalid @enderror" name="legrep" id="legrep" value="{{ old('legrep') }}" />

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
                                <label class="required font-weight-600" for="idno">{{ __("Identification no") }}:</label>
                                <input type="text" placeholder="CUI 1234567" class="form-control @error('idno') is-invalid @enderror" name="idno" id="idno" value="{{ old('idno') }}" />

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
                                <label class="required font-weight-600" for="address">{{ __("Physical address") }}:</label>
                                <input type="text" placeholder="{{ __('Physical address placeholder') }}" class="form-control @error('address') is-invalid @enderror" name="address" id="address" value="{{ old('address') }}" />

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
                                <label class="required font-weight-600" for="support_type">{{ __("Type of support: Offer housing / Request housing for refugees") }}:</label>
                                <select multiple="multiple" class="form-control @error('support_type') is-invalid @enderror" name="support_type" id="support_type" value="{{ old('support_type') }}" >
                                    <option>{{ __("Offer housing") }}</option>
                                    <option>{{ __("Request housing for refugees") }}</option>
                                </select>
                                @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="border-top pt-5 mt-3 clearfix">
                        @error('g-recaptcha-response')
                        <span class="invalid-feedback d-flex" role="alert">{{ $errors->first('g-recaptcha-response') }}</span>
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
