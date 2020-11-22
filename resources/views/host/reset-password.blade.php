@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title mb-3 font-weight-600">{{ __("Reset password") }}</h6>
        <a href="{{ route('host.profile') }}" class="btn btn-sm btn-outline-primary mr-3">{{ __("Back") }}</a>
    </section>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __("Account information") }}
            </h6>
        </div>
        <div class="card-body pt-4">
            <form action="{{ @route('host.save-reset-password') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="required font-weight-600">{{ __("Current password") }}:</label>
                            <div class="pwd-container">
                                <input type="password" name="currentPassword" id="currentPassword" class="form-control @error('currentPassword') is-invalid @enderror" placeholder="{{ __("Current password placeholder") }}">
                                @error('currentPassword')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="required font-weight-600">{{ __("New password") }}:</label>
                            <div class="pwd-container">
                                <input type="password" name="password" id="newPassword" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __("New password placeholder") }}">
                                @include('partials.password-help')
                                @error('password')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="required font-weight-600">{{ __("Retype new password") }}:</label>
                            <div class="pwd-container">
                                <input type="password" name="password_confirmation" id="retypeNewPassword" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="{{ __("Retype new password placeholder") }}">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top pt-4 pb-3 mt-5 clearfix">
                    <button type="submit" id="submit-button-2" class="btn btn-secondary pull-right btn-lg px-6">
                        <span class="btn-inner--text">{{ __("Save") }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

