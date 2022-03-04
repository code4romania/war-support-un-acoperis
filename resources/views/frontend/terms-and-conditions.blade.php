@extends('layouts.app')

@section('content')
    <div class="container pt-sm-6 pb-sm-5 py-3">
        <h1 class="display-3 title mb-4 text-secondary">{{ __('Terms And Conditions') }}</h1>
    </div>

    <section class="bg-h4h-form py-5">
        <div class="container">
            <div class="card shadow mb-4">
                <div class="card-body py-5">
                    {!! $termsAndConditions !!}
                 </div>
            </div>
        </div>
    </section>
@endsection
