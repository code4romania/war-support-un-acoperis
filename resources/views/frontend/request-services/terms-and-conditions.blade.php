@extends('layouts.app')

@section('content')
    <div class="container pt-sm-6 pb-sm-5 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="display-3 title mb-4 text-primary">{{ __('Request Help') }}</h1>
        <p>
            {!! $description !!}
        </p>
    </div>
    <div class="alert bg-h4h-blue alert-general white font-weight-600 mb-0" role="alert">
        <div class="container">
            <span class="alert-inner--icon mr-3"><i class="fa fa-info-circle"></i></span>
            <span class="alert-inner--text">{{ $info }}</span>
        </div>
    </div>
    <section class="bg-h4h-form py-5">
        <div class="container">
            <form method="POST" action="{{ route('request-services-submit-agreement') }}" id="sendAgree">
                @csrf
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary">
                        <h6 class="mb-0 text-white font-weight-600">
                            1. {{ __('Terms and conditions') }}
                        </h6>
                    </div>
                    <div class="card-body py-5">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>
                                    {!! $termsAndConditionsForSeekers !!}
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">

                                {!! NoCaptcha::displaySubmit('sendGetInvolved', "" . __('I agree') . "
                                <i class=\"fa fa-arrow-right\"></i>", ['type' => 'submit',  "id" => "submit-button-2", 'class' => 'btn btn-secondary btn-h4h-offer-help-submit pull-right btn-lg px-6']) !!}
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    {{--{!! NoCaptcha::renderJs(request()->route()->parameters['locale']) !!}--}}
@endsection
