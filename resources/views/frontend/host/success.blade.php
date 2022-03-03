@extends('layouts.app')

@section('content')
    <section class="bg-h4h-form py-5">
        <div class="container">
            <h1>{{ __('You have successfully registered') }}!</h1>
            <p>{{ __('You will be contacted') }}</p>
            <p>{{__('Thank you for your generosity')}}!</p>
        </div>
    </section>
@endsection
