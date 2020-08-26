@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title mb-3 font-weight-600">{{ __('Accommodation resource') }}</h6>
        <a href="{{ route('admin.accommodation-list') }}" class="btn btn-sm btn-outline-primary mr-3">{{ __('Back') }}</a>
    </section>
    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __('Accommodation resource') }} - {{ $user->name }}
            </h6>
            <a class="btn btn-white text-danger btn-sm px-4 delete-accommodation" href="#">{{ __('Delete') }}</a>
        </div>
        <div class="card-body">
            <h5 class="text-primary font-weight-600 mb-4">
                {{ $user->name }}
            </h5>
            <div class="row  pb-3">
                <div class="col-sm">
                    <p class="mb-0">
                        <i class="fa fa-map-marker mr-2"></i> {{ __('Location') }}: <span class="font-weight-600">{{ implode(', ', array_filter([$user->country->name, $user->city])) }}</span>
                    </p>
                </div>
                <div class="col-sm">
                    <p class="mb-0">
                        <i class="fa fa-phone mr-2"></i> {{ __('Phone Number') }}: <span class="font-weight-600">{{ $user->phone_number }}</span>
                    </p>
                </div>
                <div class="col-sm">
                    <p class="mb-0">
                        <i class="fa fa-envelope mr-2"></i> {{ __('Email') }}: <a href="mailto:dan.vintu@gmail.com" class="font-weight-600">{{ $user->email }}</a>
                    </p>
                </div>
                <div class="col-sm">
                    <p class="mb-0 text-sm-right">
                        <i class="fa fa-calendar mr-2"></i> {{ __('Date') }}: <span class="font-weight-600">{{ $user->created_at->format('d.m.Y') }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __('Accommodation') }}
            </h6>
        </div>
        <div class="card-body pt-4">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="font-weight-600 text-primary mb-4">{{ __('Hosting details') }}</h5>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Accommodation Type') }}</h6>
                        <p>{{ __($accommodation->accommodationtype->name) }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Ownership regime') }}</h6>
                        <p>{{ \App\Accommodation::getOwnershipTypes()[$accommodation->ownership_type] }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Hosting regime') }}</h6>
                        <p>{{ $accommodation->is_fully_available ? __('Full accommodation for guests') : __('The accommodation is independent or part of your home') }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Maximum guests number') }}</h6>
                        <p>{{ $accommodation->max_guests }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Available rooms') }}</h6>
                        <p>{{ $accommodation->available_rooms }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Available bathrooms') }}</h6>
                        <p>{{ $accommodation->available_bathrooms }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Allow the use of the kitchen of the accommodated guests') }}?</h6>
                        <p>{{ $accommodation->is_kitchen_available ? __('Yes') : __('No') }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('The hosts can benefit from a parking space') }}?</h6>
                        <p>{{ $accommodation->is_parking_available ? __('Yes') : __('No') }}</p>
                    </div>
                    <h5 class="font-weight-600 text-primary mb-4 mt-4">{{ __('House rules') }}</h5>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Smoking is allowed in the house') }}?</h6>
                        <p>{{ $accommodation->is_smoking_allowed ? __('Yes') : __('No') }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Pets are allowed in the house') }}?</h6>
                        <p>{{ $accommodation->is_pet_allowed ? __('Yes') : __('No') }}</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h5 class="font-weight-600 text-primary mb-4">{{ __('Accommodation photos') }}</h5>
                    @if(!empty($photos))
                        <div class="gallery d-flex flex-wrap mb-4">
                        @foreach($photos as $photo)
                            <a href="{{ $photo }}" data-toggle="lightbox"><img src="{{ $photo }}" alt="photo" class="img-fluid"></a>
                        @endforeach
                        </div>
                    @else
                        N/A
                    @endif
                    <h5 class="font-weight-600 text-primary mb-4">{{ __('Available facilities') }}</h5>
                    @if (!empty($generalFacilities->count()))
                        <div class="kv">
                            <h6 class="font-weight-600 mb-2">{{ __('What facilities does the accommodation have') }}?</h6>
                            <ul class="list-unstyled list-custom gray-bullets">
                                @foreach($generalFacilities as $generalFacility)
                                    <li>{{ __($generalFacility->name) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (!empty($specialFacilities->count()))
                        <div class="kv">
                            <h6 class="font-weight-600 mb-2">{{ __('What special facilities does the accommodation space have') }}?</h6>
                            <ul class="list-unstyled list-custom gray-bullets">
                                @foreach($specialFacilities as $specialFacility)
                                    <li>{{ __($specialFacility->name) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (!empty($otherFacilities))
                        <div class="kv">
                            <h6 class="font-weight-600 mb-2">{{ __('What other facilities does the accommodation have') }}?</h6>
                            <ul class="list-unstyled list-custom gray-bullets">
                                <li>{{ __('test') }}</li>
                            </ul>
                        </div>
                    @endif
                    <h5 class="font-weight-600 text-primary mb-4 mt-4">{{ __('Accommodation address') }}</h5>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Accommodation exact address') }}</h6>
                        <p>{{ $composedAddress }}</p>
                    </div>
                    <h5 class="font-weight-600 text-primary mb-4 mt-4">{{ __('Transport accessibility (distance in meters)') }}</h5>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('The nearest metro station') }}:</h6>
                        <p>{{ $accommodation->transport_subway_distance ?? 'N/A' }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('The nearest bus stop') }}:</h6>
                        <p>{{ $accommodation->transport_bus_distance ?? 'N/A' }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Nearest train station') }}:</h6>
                        <p>{{ $accommodation->transport_railway_distance ?? 'N/A' }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Other transport specifications') }}:</h6>
                        <p>{{ $accommodation->transport_other_details ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <h5 class="font-weight-600 text-primary mb-4 mt-4">{{ __('Description') }}</h5>
                    <p>{!! $accommodation->description ?? 'N/A' !!}</p>
                </div>
            </div>

            <div class="border-top pt-3 mt-4">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="font-weight-600 text-primary mb-4 mt-4">{{ __('Accommodation availability') }}</h5>
                        <div class="kv">
                            <h6 class="font-weight-600 mb-1">{{ __('Checkin time') }}:</h6>
                            <p>{{ substr($accommodation->checkin_time, 0, 5) }}</p>
                        </div>
                        <div class="kv">
                            <h6 class="font-weight-600 mb-1">{{ __('Checkout time') }}:</h6>
                            <p>{{ substr($accommodation->checkout_time, 0, 5) }}</p>
                        </div>
                        <div class="kv">
                            <h6 class="font-weight-600 mb-1">{{ __('Unavailability') }}</h6>
                            <p>
                                {{ !empty($accommodation->unavailable_from_date) ? ($accommodation->unavailable_from_date->format('Y-m-d') . ' - ' . $accommodation->unavailable_to_date->format('Y-m-d')) : 'N/A' }}
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h5 class="font-weight-600 text-primary mb-4 mt-4">{{ __('Fees') }}</h5>
                        <div class="kv">
                            <h6 class="font-weight-600 mb-1">{{ __('What are the accommodation costs') }}?</h6>
                            <p>{{ $accommodation->is_free ? __('Free') : __('Paid') }}</p>
                        </div>
                        <div class="kv">
                            <h6 class="font-weight-600 mb-1">{{ __('Estimated amount charged per day / week / month if you apply for a financial benefit') }}</h6>
                            <p>{{ $accommodation->general_fee ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <h5 class="text-primary font-weight-600 mb-4">
                {{ __('Notes and reviews') }}
            </h5>
            <div class="border-bottom py-4" id="noteContainer">
                @foreach($accommodation->notes as $note)
                    <div class="note p-3" id="note-container-{{ $note->id }}">
                        <div class="row align-items-sm-center">
                            <div class="col-sm-9 mb-4 mb-sm-0">
                                <div id="note-body-{{ $note->id }}">
                                    {!! $note->message !!}
                                </div>

                                <div class="meta">
                                    @if (!empty($note))
                                        <span>{{ __('Added by') }} <b>{{ $note->user->name }}</b></span>
                                    @endif
                                    <span class="text-dot-left">{{ formatDateTime($note->created_at) }}</span>
                                </div>

                            </div>
                            @if (Auth::user()->id === $note->user_id)
                                <div class="col-sm-3 text-sm-right">
                                    <button class="edit-note btn btn-sm btn-info" data-note-id="{{ $note->id }}">{{ __('Edit') }}</button>
                                    <button class="delete-note btn btn-sm btn-danger" data-note-id="{{ $note->id }}">{{ __('Delete') }}</button>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pt-3 pb-3 mt-3 clearfix">
                <button type="submit" id="submit-button-2" class="btn btn-secondary pull-right btn-lg px-6" data-toggle="modal" data-target=".bd-example-modal-lg">
                    <span class="btn-inner--icon mr-2"><i class="fa fa-comment"></i></span>
                    <span class="btn-inner--text">{{ __('Add note') }}</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Popup notă -->
    <div id="addNoteModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-600" id="exampleModalScrollableTitle">{{ __('Add note') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-4">Introduceți o notă explicativă pentru această solicitare</p>
                    <textarea class="tinymce" name="note-message" id="note-message" cols="30" rows="20"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-gray-dark" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="addNote">{{ __('Add note') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup editare notă -->
    <div id="editNoteModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-600">{{ __('Delete note') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-4">Introduceți o notă explicativă pentru această solicitare</p>
                    <textarea class="tinymce" name="edit-note-message" id="edit-note-message" cols="30" rows="20"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-gray-dark" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="editNote" data-note-id="">{{ __('Edit note') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmare stergere nota -->
    <div class="modal fade bd-example-modal-sm" id="deleteNoteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">{{ __('Delete note') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this note') }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-dismiss="modal" id="cancel">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-secondary" id="proceedDeleteNote">{{ __('Yes') }}</button>
                </div>
            </div>
        </div>
    </div>

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
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/bgsado4b682dgf10owt5ns07i6jh5vcf36tc06nntxc08asr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    //props
                });
            });

            tinymce.init({
                selector: '.tinymce'
            });


            let addNote = function (id, message, user, date) {
                let addNoteElement = '<div class="note p-3" id="note-container-'+id+'">\n' +
                    '                    <div class="row align-items-sm-center">\n' +
                    '                        <div class="col-sm-9 mb-4 mb-sm-0">\n' +
                    '                            <div id="note-body-'+id+'">\n' +
                    '                                '+message+'\n' +
                    '                            </div>\n' +
                    '\n' +
                    '                            <div class="meta">\n' +
                    '                                <span>{{ __('Added by') }} <b>'+user+'</b></span>\n' +
                    '                                <span class="text-dot-left">'+date+'</span>\n' +
                    '                            </div>\n' +
                    '\n' +
                    '                        </div>\n' +
                    '                        <div class="col-sm-3 text-sm-right">\n' +
                    '                            <button class="edit-note btn btn-sm btn-info" data-note-id="'+id+'">{{ __('Edit') }}</button>\n' +
                    '                            <button class="delete-note btn btn-sm btn-danger" data-note-id="'+id+'">{{ __('Delete') }}</button>\n' +
                    '                        </div>\n' +
                    '                    </div>\n' +
                    '                </div>';

                $('#noteContainer').append(addNoteElement);
            };

            $('#addNote').on('click', function() {
                console.log('dadadada');
                axios.post('{{ @route('ajax.create-note', ['entityType' => \App\Note::TYPE_HELP_ACCOMMODATION, 'entityId' => $accommodation->id]) }}', {
                    _token: "{{ csrf_token() }}",
                    message: tinymce.get('note-message').getContent()
                }).then(response => {
                    addNote(
                        response.data.noteId,
                        tinymce.get('note-message').getContent(),
                        response.data.noteUser,
                        response.data.noteDate,
                    );

                    tinymce.get('note-message').setContent('');
                    $('#addNoteModal').modal('hide');
                })
                    .catch(error => {
                        console.log(error);
                    });
            });

            $('body').on('click', '.edit-note', function() {
                let noteId = $(this).data('note-id');

                tinymce.get('edit-note-message').setContent(
                    $('#note-body-' + noteId).html()
                );

                $('#editNote').data('note-id', noteId);
                $('#editNoteModal').modal('show');
            });

            $('body').on('click', '#editNote', function() {
                let noteId = $(this).data('note-id');
                let noteMessage = tinymce.get('edit-note-message').getContent();
                let route = '{{ @route('ajax.update-note', ['id' => ':::d-_-b:::']) }}';
                axios
                    .put(route.replace(':::d-_-b:::', noteId), {
                        _token: "{{ csrf_token() }}",
                        message: noteMessage
                    })
                    .then(response => {
                        $('#note-body-' + noteId).html(noteMessage);
                        $('#editNoteModal').modal('hide');
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });

            $('#proceedDeleteNote').on('click', function() {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';

                let route = '{{ @route('ajax.delete-note', ['id' => ':::d-_-b:::']) }}';

                axios
                    .delete(route.replace(':::d-_-b:::', deleteNoteId))
                    .then(response => {
                        $('#note-container-' + deleteNoteId).remove();
                        $('#deleteNoteModal').modal('hide');
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });

            $('body').on('click', '.delete-note', function() {
                deleteNoteId = $(this).data('note-id');
                $('#deleteNoteModal').modal('show');
            });

            $('.delete-accommodation').on('click', function (event) {
                event.preventDefault();
                $('#deleteAccommodationModal').modal('show');
            });

            $('#proceedDeleteAccommodation').on('click', function() {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';

                axios
                .delete('/admin/ajax/accommodation/{{ $accommodation->id }}')
                .then(response => {
                    $('#deleteAccommodationModal').modal('hide');

                    window.location.replace('{{ route('admin.accommodation-list') }}');
                })
                .catch(error => {
                    console.log(error);
                });
            });
        });
    </script>
@endsection

