@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600 mb-3">{{ __('Edit accommodation') }}</h6>
        <a href="{{ route('host.accommodation') }}" class="btn btn-sm btn-outline-primary mr-3">{{ __('Back') }}</a>
    </section>

    <div class="card shadow">
        <div class="card-header bg-primary py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __('Accommodation details') }}
            </h6>
        </div>
        <div class="card-body pt-4">
            @include('partials.forms.accommodation-edit', ['formRoute' => route('host.update-accommodation', $accommodation->id)])
        </div>
    </div>
@endsection

@include('partials.forms.accommodation-edit-scripts')
