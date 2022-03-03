@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600 mb-3">{{ __('My Profile') }}</h6>
    </section>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __("Personal information") }}
            </h6>
            <a class="btn btn-secondary btn-sm px-4" href="{{ route('host.edit-profile') }}">{{ __("Profile edit") }}</a>
        </div>
        <div class="card-body pt-4">
            <div class="kv d-flex">
                <b class="mr-3">
                    {{ __("Full Name") }}:
                </b>
                <p>
                    @if ($user->name) {{ $user->name }} @else - @endif
                </p>
            </div>
            <div class="kv d-flex">
                <b class="mr-3">
                    {{ __("Country") }}:
                </b>
                <p>
                    @if ($user->country) {{ $user->country->name }} @else - @endif
                </p>
            </div>
            <div class="kv d-flex">
                <b class="mr-3">
                    {{ __("City") }}:
                </b>
                <p>
                    @if ($user->city) {{ $user->city }} @else - @endif
                </p>
            </div>
            <div class="kv d-flex">
                <b class="mr-3">
                    {{ __("Address") }}:
                </b>
                <p>
                    @if ($user->address) {{ $user->address }} @else - @endif
                </p>
            </div>
            <div class="kv d-flex">
                <b class="mr-3">
                    {{ __("Phone Number") }}:
                </b>
                <p>
                    @if ($user->phone_number) {{ $user->phone_number }} @else - @endif
                </p>
            </div>
            <div class="kv d-flex">
                <b class="mr-3">
                    {{ __("E-Mail Address") }}:
                </b>
                <p>
                    {{ $user->email }}
                </p>
            </div>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __("Account information") }}
            </h6>
            <a class="btn btn-secondary btn-sm px-4" href="{{ route('host.reset-password') }}">{{ __("Reset password") }}</a>
        </div>
        <div class="card-body pt-4">
            <div class="kv d-flex">
                <b class="mr-3">
                    {{ __("E-Mail Address") }}:
                </b>
                <p>
                    {{ $user->email }}
                </p>
            </div>
            <div class="kv d-flex">
                <b class="mr-3">
                    {{ __("Password") }}:
                </b>
                <p>
                    ************
                </p>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __("2FA") }}
            </h6>
            <a class="btn btn-secondary btn-sm px-4" href="{{ route('2fa.form') }}">{{ ! $user->has2faActivated() ? __("Enable 2FA") : __('Disable 2FA') }}</a>
        </div>
        <div class="card-body pt-4">
            <div class="kv d-flex">
                <b class="mr-3">
                    {{ __("Status") }}:
                </b>
                <p>
                    {{ ! $user->has2faActivated() ? __('Enabled') : __('Disabled') }}
                </p>
            </div>
        </div>
    </div>
@endsection

