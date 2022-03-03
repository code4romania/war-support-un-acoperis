@section('content')
    <div class="container py-sm-5 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="display-3 title mb-0 text-secondary">{{ __('I want to help') }} - {{ __('I offer accommodation') }}</h1>

    </div>

    <section class="bg-h4h-form py-5">
        <div class="container">
            <div class="card shadow">
                <div class="card-header bg-primary py-3 d-flex justify-content-between align-content-center">
                    <h6 class="font-weight-600 text-white mb-0">
                        3. {{ __('Add an accommodation unit') }}
                    </h6>
                </div>
                <div class="card-body pt-4">
                    @include('partials.forms.accommodation-add')
                </div>
            </div>
        </div>
    </section>
    
@endsection

@include('partials.forms.accommodation-add-scripts')
