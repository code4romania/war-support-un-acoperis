@extends('layouts.admin')

@section('content')
    Hello, {{ $user->name }} ({{ $user->email }})!
    <h1>Host Accommodation Page</h1>

    <a class="btn btn-success" href="{{ route('host.create-accommodation') }}">Adauga cazare</a>
    <a class="btn btn-warning" href="{{ route('host.edit-accommodation') }}">Editeaza cazare</a>
@endsection

