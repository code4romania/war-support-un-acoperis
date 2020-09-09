@extends('layouts.app')
@section('content')
    <div class="container pt-sm-6 pb-sm-5 py-3">
        <div class="row justify-content-md-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header text-center">
                        <h1 class="title display-4 mb-0">{{ __('Verify two-factor authentication code') }}</h1>
                    </div>
                    <div class="card-body">
                        {{ __('Enter the pin from Google Authenticator app') }}<br/><br/>
                        <form class="form-horizontal" action="{{ route('2faVerify') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('one_time_password-code') ? ' has-error' : '' }}">
                                <input id="one_time_password" name="one_time_password"  class="form-control col-md-4 @if ($errors->any()) is-invalid @endif"  type="text" required/>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                                @if ($errors->any())
                                    <span class="invalid-feedback" role="alert">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </span>
                                @endif
                            </div>
                            <button class="btn btn-primary" type="submit">{{ __('Authenticate') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
