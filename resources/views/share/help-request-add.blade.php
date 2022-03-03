@extends('layouts.admin')
@section("head-scripts")
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    @include('share.partials.add-user-help-request-modal')

    @include('partials.forms.request-services-step3', [
        'description' => $description,
        'info'  => $info,
        'languages' => $languages,
        'formRoute' => route('share.help.request.store')
    ])
@endsection
