@extends('layouts.admin')

@section('content')

@include('partials.forms.host-signup-base',
            ['formRoutePerson' => route('admin.store-host-person'),
            'formRouteCompany' => route('admin.store-host-company')]
            )

@endsection
