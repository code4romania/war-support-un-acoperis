@extends('layouts.admin')

@section('content')
    <div class="row">
        <a class="btn btn-secondary" href="{{ route('admin.host-add') }}">{{ __('Add host user') }}</a>
        @if(Auth::user()->isAdministrator())
            <a class="btn btn-secondary" href="{{ route('admin.trusted-user-add') }}">{{ __('Add trusted user') }}</a>
        @endif
    </div>
@endsection
