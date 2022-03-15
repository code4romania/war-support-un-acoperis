@extends('layouts.admin')

@section('content')
    <section class="mb-5 row">
        <div class="col-md-6">
            <h1 class="page-title font-weight-600 mb-0">{{ __('My requests') }}</h1>
        </div>
        <div class="col-md-6 d-md-flex justify-content-end">
            <a class="btn btn-secondary m-2"
                href="{{ route('request-services-step3') }}">{{ __('Add help request') }}</a>
        </div>
    </section>

    <div class="card-deck accomodation-list row rows-2">
        @foreach ($helpRequests as $item)
            @include('common.help-request', ['item' => $item])
        @endforeach
    </div>
@endsection
