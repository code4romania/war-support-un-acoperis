@extends('layouts.admin')

@section('content')
    <div class="row mb-4 items-center">
        <div class="col-12 col-md-6 text-md-left text-center">
            <h1>{{ __('Requests List') }}</h1>
        </div>
        <div class="col-12 col-md-6 text-md-right text-center">
            <a class="btn btn-secondary" href="{{ route('request-services-step3') }}">{{ __('Add help request') }}</a>
        </div>
    </div>

    <div class="card-deck accomodation-list row rows-2">
        @foreach($helpRequests as $item)
            @include('common.help-request',['item'=>$item])
        @endforeach
    </div>
@endsection
