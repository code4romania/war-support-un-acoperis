@extends('frontend.request-services.layout')
@section('form-content')
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
                        {!! $termsAndConditionsForRefugees !!}

                        {!! NoCaptcha::displaySubmit('sendGetInvolved', '' . __('I agree') . " <i class=\"fa fa-arrow-right\"></i>", ['type' => 'submit', 'id' => 'submit-button-2', 'class' => 'btn btn-secondary btn-h4h-offer-help-submit pull-right btn-lg px-6']) !!}
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
