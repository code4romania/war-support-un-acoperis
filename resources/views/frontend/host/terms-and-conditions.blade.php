@extends('layouts.app')

@section('content')
    <div class="container pt-sm-6 pb-sm-5 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="display-3 title mb-4 text-secondary">{{ __('Offer accommodation') }}</h1>
        <div>
            {!! $description !!}
        </div>
    </div>

    <section class="bg-h4h-form py-5">
        <div class="container">
            <form method="POST" action="{{ route('store-hosts-terms-agreed') }}" id="sendGetInvolved">
                @csrf
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary">
                        <h6 class="mb-0 text-white font-weight-600">
                            1. {{ __('Terms and conditions') }}
                        </h6>
                    </div>
                    <div class="card-body py-5">
                        {!! $termsAndConditionsForHosts !!}

                        {!! NoCaptcha::displaySubmit('sendGetInvolved', '' . __('I agree') . " <i class=\"fa fa-arrow-right\"></i>", ['type' => 'submit', 'id' => 'submit-button-2', 'class' => 'btn btn-secondary btn-h4h-offer-help-submit pull-right btn-lg px-6']) !!}
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
