@extends('frontend.request-services.layout')
@section('form-content')
    <section class="py-5 bg-h4h-form">
        <div class="container">
            <div class="accordion-1 request-services">
                @include('partials.forms.request-services-add-user',[
                    'formRoute' => route('request-services-submit-step2'),
                    'showFormHeader'    => true
                ])
            </div>
        </div>
    </section>
@endsection
