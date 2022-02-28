@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="container my-5">
        <div class="row flex-column-reverse flex-sm-row align-items-sm-center">
            <div class="col-sm-6">
                <h1 class="font-weight-600 text-primary mb-5">
                    {{ __('Thank you!') }}
                </h1>
                <p>
                    {{ __('Your form has been submitted to the M.A.M.E Association. As soon as possible you will be contacted by someone from the organization to discuss details about how you can get involved.') }}
                </p>
                <p>
                    {{ __('If you want to communicate other information that has not already been sent through the form, you can contact us at') }}
                    <a href="mailto:ajutor@asociatiamame.com" target="_blank">ajutor@asociatiamame.com</a>
                </p>
                <p class="d-none">
                    {{ __('You will also receive the confirmation of sending the request form to the email address entered!') }}
                </p>
            </div>
            <div class="col-sm-6">
                <img src="/images/thanks.svg" alt="" class="w-100 mb-5 mb-sm-0">
            </div>
        </div>
    </div>
@endsection

