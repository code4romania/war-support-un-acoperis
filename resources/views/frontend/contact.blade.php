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
                                <label class="required font-weight-600" for="name">{{ __("Name and surname") }}:</label>
                                <input type="text" placeholder="{{ __('Full name placeholder') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" />

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
                            <div><label class="required font-weight-600" for="phone">{{ __("Phone Number") }}:</label></div>
                            @include('partials.phone', ['controlName' => 'phone', 'controlDefault' => '', 'prefixes' => $countries, 'prefixCode' => 'RO', 'prefixValue' => ''])

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label class="required font-weight-600" for="email">{{ __("Your message") }}:</label>
                                <textarea name="message" rows="5" class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>

                                @error('message')
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
