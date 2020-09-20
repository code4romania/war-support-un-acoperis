@extends('layouts.app')

@section('content')
<section class="py-6 bg-light-blue">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0 font-weight-600">
                            {{ __('Login') }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf

                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user-circle text-primary"></i></span>
                                    </div>
                                    <input id="email" type="email" class="form-control pl-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="ex. ionescudiana@gmail.com">
                                    @error('email')
                                    <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-unlock-alt text-primary"></i></span>
                                    </div>
                                    <input id="password" type="password" class="form-control pl-2 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __("Choose a password") }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="custom-control-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group mb-0 @if ($errors->has('g-recaptcha-response')) is-invalid @endif">
                                @error('g-recaptcha-response')
                                    <span class="invalid-feedback d-flex" role="alert">{{ $errors->first('g-recaptcha-response') }}</span>
                                @enderror

                                {!! NoCaptcha::displaySubmit('loginForm', __('Login'), ['type' => 'submit', 'class' => 'btn btn-primary btn-block w-100 mb-3']) !!}

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link btn-block w-100" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    {!! NoCaptcha::renderJs(request()->route()->parameters['locale']) !!}
@endsection

