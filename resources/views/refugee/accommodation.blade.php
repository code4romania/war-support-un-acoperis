@extends('layouts.admin')

@section('content')
    <h1>Available Accommodations?</h1>

    <div class="card-deck accomodation-list row rows-2">
        @foreach($accommodations->items() as $accommodation)
            @include('common.accommodation.accomodation-list-item')
        @endforeach
    </div>
@endsection
