@extends('layouts.admin')

@section('content')

@include('partials.forms.host-signup-base',
            ['formRoutePerson' => route('admin.store-admin-person'),
            'formRouteCompany' => route('admin.store-admin-company')]
            )

@endsection
