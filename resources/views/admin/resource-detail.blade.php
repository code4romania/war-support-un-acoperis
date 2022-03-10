@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title mb-3 font-weight-600">Resurse ajutor</h6>
        <a href="{{ route('admin.resource-list') }}" class="btn btn-sm btn-outline-primary mr-3">Inapoi</a>
    </section>
    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ $typeTranslation }}
                @if ($helpResourceType->resourcetype->options == \App\ResourceType::OPTION_MESSAGE) ({{ $helpResourceType->helpresource->message }}) @endif
                -
                {{ $helpResourceType->helpresource->full_name }}
            </h6>
            <a class="btn btn-white text-danger btn-sm px-4" href="#" id="delete-request-button">{{ __('Delete') }}</a>
        </div>
        <div class="card-body">
            <h5 class="text-primary font-weight-600 mb-4">
                {{ $helpResourceType->helpresource->full_name }}
            </h5>
            <div class="row  pb-3">
                <div class="col-sm">
                    <p class="mb-0">
                        <i class="fa fa-map-marker mr-2"></i> Locatie: <span class="font-weight-600">{{ $helpResourceType->helpresource->city }}, {{ $helpResourceType->helpresource->country->name }}</span>
                    </p>
                </div>
                <div class="col-sm">
                    <p class="mb-0">
                        <i class="fa fa-phone mr-2"></i> Telefon: <span class="font-weight-600">{{ $helpResourceType->helpresource->phone_number }}</span>
                    </p>
                </div>
                <div class="col-sm">
                    <p class="mb-0">
                        <i class="fa fa-envelope mr-2"></i> Email: <a href="mailto:dan.vintu@gmail.com" class="font-weight-600">{{ $helpResourceType->helpresource->email }}</a>
                    </p>
                </div>
                <div class="col-sm">
                    <p class="mb-0 text-sm-right">
                        <i class="fa fa-calendar mr-2"></i> Data: <span class="font-weight-600">{{ formatDateTime($helpResourceType->helpresource->created_at) }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <h5 class="text-primary font-weight-600 mb-4">
                Ajutor
            </h5>
            <div class="kv border-bottom pb-4 mb-0">
                <p>Tip de ajutor oferit</p>
                <b>{{ $typeTranslation }} @if ($helpResourceType->resourcetype->options == \App\ResourceType::OPTION_MESSAGE) ({{ $helpResourceType->helpresource->message }}) @endif</b>
            </div>
        </div>
    </div>

    <div class="card shadow">
    @include('partials.notes', [
        'notes' => $helpResourceType->notes,
        'entityType' => \App\Note::TYPE_HELP_RESOURCE,
        'entityId' => $helpResourceType->id
    ])
    </div>

    @if ($isAccomodation)
        <div class="card shadow">
            <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center rounded">
                <h6 class="font-weight-600 text-white mb-0">
                    {{ trans_choice('Accommodation places', $accommodations->total(), ['value' => $accommodations->total()]) }}
                </h6>
                <a class="btn btn-secondary btn-sm px-4" href="{{ route('admin.accommodation-add', ['userId' => $user->id]) }}">{{ __('Add accommodation') }}</a>
            </div>
        </div>

        <div class="card-deck accomodation-list row rows-2">
            @foreach($accommodations->items() as $accommodation)
                <div class="col-12 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="media">
                                @if (!empty($accommodation->photos()->count()))
                                    <img src="{{ $accommodation->photos()->first()->getPhotoUrl() }}" alt="" class="w-50 mr-4">
                                @endif
                                <div class="media-body">
                                    <h6 class="text-primary font-weight-600 mb-1">
                                        <a href="{{ route('admin.accommodation-detail', $accommodation->id) }}" class="text-underline">{{ __($accommodation->accommodationtype->name) }}</a>
                                    </h6>
                                    <p>{{ $accommodation->address_city }}, {{ $accommodation->addresscountry->name }}</p>
                                    <p>{{ trans_choice('Maximum accommodated rooms', $accommodation->available_rooms, ['value' => $accommodation->available_rooms]) }}</p>

                                    <div class="kv d-flex mb-0">
                                        <p class="mr-3">{{ __('Maximum') }}</p>
                                        <p class="text-admin-blue">{{ trans_choice('Maximum accommodated persons', $accommodation->max_guests, ['value' => $accommodation->max_guests]) }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.accommodation-detail', $accommodation->id) }}" class="btn btn-sm btn-secondary mb-2 mb-sm-0">{{ __('See details') }}</a>
                            <a href="{{ route('admin.accommodation-edit', $accommodation->id) }}" class="btn btn-sm btn-outline-primary mb-2 mb-sm-0">{{ __('Edit') }}</a>
                            <a href="#" class="btn btn-sm btn-outline-danger mb-2 mb-sm-0 delete-accommodation" data-id="{{ $accommodation->id }}">{{ __('Delete') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <nav aria-label="...">
                <ul class="pagination justify-content-center mb-0"></ul>
            </nav>
        </div>

    @endif

    <!-- Confirmare stergere cazare -->
    <div class="modal fade bd-example-modal-sm" id="deleteAccommodationModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">{{ __('Delete accommodation') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this accommodation') }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-dismiss="modal" id="cancel">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-secondary" id="proceedDeleteAccommodation">{{ __('Yes') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmare stergere cerere -->
    <div class="modal fade bd-example-modal-sm" id="deleteRequestModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">{{ __('Delete resource') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this resource') }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-dismiss="modal" id="cancel">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-secondary" id="proceedDeleteRequest">{{ __('Yes') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $('#delete-request-button').on('click', function() {
            $('#deleteRequestModal').modal('show');
        });

        $('#proceedDeleteRequest').on('click', function() {
            axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';

            axios
                .delete('/admin/ajax/resources/{{ $helpResourceType->id }}')
                .then(response => {
                    $('#deleteRequestModal').modal('hide');
                    window.location.replace('{{ route('admin.resource-list') }}');
                })
                .catch(error => {
                    console.log(error);
                });
        });

        let selectedAccommodation = null;

        $('.delete-accommodation').on('click', function(event) {
            event.preventDefault();
            selectedAccommodation = $(this).data('id');
            $('#deleteAccommodationModal').modal('show');
        });

        $('#proceedDeleteAccommodation').on('click', function() {
            $('#deleteAccommodationModal').modal('hide');
            window.location.href = '/admin/accommodation/'+selectedAccommodation+'/delete';
        });
    });
</script>
@endsection

