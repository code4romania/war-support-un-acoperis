@extends('layouts.admin')

@section('content')
    @include('partials.info-box', [
        'title' => __('Terms and conditions'),
        'text' => __('trusted.general.terms.text'),
        'buttonText' => __('View Terms And Conditions'),
        'buttonUrl' => route('terms-trusted')
    ])
@endsection
