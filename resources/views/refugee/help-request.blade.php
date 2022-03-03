@extends('layouts.admin')

@section('content')
    <div class="card-deck accomodation-list row rows-2">
        @foreach($helpRequests as $item)
            @include('common.help-request',['item'=>$item])
        @endforeach
    </div>
@endsection
