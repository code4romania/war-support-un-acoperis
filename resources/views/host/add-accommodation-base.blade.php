@section('content')

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __('Accommodation details') }}
            </h6>
        </div>
        <div class="card-body pt-4">
            @include('partials.forms.accommodation-add')
        </div>
    </div>
@endsection

@include('partials.forms.accommodation-add-scripts')
