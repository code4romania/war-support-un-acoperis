@extends('frontend.request-services.layout')

@section('form-content')
    @include('partials.forms.request-services-step3', [
        'description' => $description,
        'info' => $info,
        'languages' => $languages,
        'counties' => $counties,
        'formRoute' => route('request-services-submit-step3'),
    ])
@endsection
