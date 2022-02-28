@extends('layouts.app')

@section('content')
    <section class="bg-h4h-form py-5">
        <div class="container">
            <h1>{{ __('You have registered successfully') }}! {{ __('Please check your email address') }}.</h1>
            <p>{{ __('Check your email address so you can setup a password and get access to your account') }}.</p>
        </div>
    </section>
@endsection
