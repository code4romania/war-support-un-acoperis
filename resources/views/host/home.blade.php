@extends('layouts.admin')

@section('content')
    @include('partials.info-box', [
        'title' => __('Terms and conditions'),
        'text' => __('host.general.terms.text'),
        'buttonText' => __('View Terms And Conditions'),
        'buttonUrl' => route('terms-host')
    ])
@endsection
