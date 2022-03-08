@extends('layouts.admin')

@section('content')
    <div class="col-md-6 d-md-flex justify-content-end">
        <a class="btn btn-secondary m-2" href="{{ route('request-services-step3') }}">{{ __('Add help request') }}</a>
    </div>
    <div class="card-deck accomodation-list row rows-2">
        @foreach($helpRequests as $item)
            @include('common.help-request',['item'=>$item])
        @endforeach
    </div>
@endsection
