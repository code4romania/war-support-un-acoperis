@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h1 class="page-title font-weight-600 mb-0">{{ __('Add admin user') }}</h1>
    </section>

    @include('partials.forms.host-signup-base', [
        'formRoutePerson' => route('admin.store-admin-person'),
        'formRouteCompany' => route('admin.store-admin-company'),
    ])
@endsection
