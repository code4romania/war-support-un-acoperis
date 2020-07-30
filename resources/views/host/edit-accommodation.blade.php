@extends('layouts.admin')

@section('content')
    Hello, {{ $user->name }} ({{ $user->email }})!
    <h1>Edit Accommodation Page</h1>
@endsection

