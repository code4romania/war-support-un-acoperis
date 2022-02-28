@extends('layouts.app')

@section('content')
    <div class="container pt-sm-6 pb-sm-5 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="display-3 title mb-4 text-secondary">{{ __('Offer Help with accommodation') }}</h1>
        <p>
            {!! $description !!}
        </p>
    </div>
    <section class="bg-h4h-form py-5">
        <div class="container">

            <div class="card shadow mb-4">

                <div class="card-header bg-primary">
                    <h6 class="mb-0 text-white font-weight-600">
                        2. {{ __('Create an account') }}
                    </h6>
                </div>

                @include('frontend.host.signup-form-base')

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    {!! NoCaptcha::renderJs(request()->route()->parameters['locale']) !!}
@endsection


