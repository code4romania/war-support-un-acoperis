@extends('layouts.admin')
@section('content')
    <section class="mb-5">
        <h6 class="page-title mb-3 font-weight-600">{{ __("2FA") }}</h6>
        <a href="{{ route('host.profile') }}" class="btn btn-sm btn-outline-primary mr-3">{{ __("Back") }}</a>
    </section>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __('Verify two-factor authentication code') }}
            </h6>
        </div>
        <div class="card-body pt-4">
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

@endsection
