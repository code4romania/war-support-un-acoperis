@extends('layouts.admin')

@section('content')
    Hello, {{ $user->name }} ({{ $user->email }})!
    <h1>Host Accommodation Page</h1>
@endsection

