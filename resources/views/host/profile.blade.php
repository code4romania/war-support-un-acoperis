@extends('layouts.admin')

@section('content')
    Hello, {{ $user->name }} ({{ $user->email }})!
    <h1>Host Profile Page</h1>

    <a class="btn btn-success" href="{{ route('host.edit-profile') }}">Editeaza profil</a>
    <a class="btn btn-warning" href="{{ route('host.reset-password') }}">Reseteaza parola</a>
@endsection

