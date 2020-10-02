@extends('layouts.app')

@section('content')
    @if ($item->featured)
        @include('site.page.featured')
    @else
        @include('site.page.default')
    @endif
@endsection
