@extends('layouts.admin')

@section('content')
    @include('partials.info-box', [
        'title' => __('Terms and conditions'),
        'text' => $termsAndConditionsForRefugees
    ])
@endsection
