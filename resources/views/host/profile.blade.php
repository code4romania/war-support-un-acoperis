@extends('layouts.admin')

@section('content')
    Hello, {{ $user->name }} ({{ $user->email }})!
    <h1>Host Profile Page</h1>
@endsection

