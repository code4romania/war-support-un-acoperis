@extends('layouts.admin')

@section('content')

@include('partials.forms.host-signup-base',
            ['formRoutePerson' => route('admin.store-trusted-person'),
            'formRouteCompany' => route('admin.store-trusted-company')]
            )

@endsection
