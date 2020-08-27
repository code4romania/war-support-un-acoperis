@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600">{{ __('Request #') }}{{ $helpRequest->id }} - {{ $helpRequest->patient_full_name }}</h6>
    </section>
    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __('Request Details') }}
            </h6>
            <button class="btn btn-white btn-sm text-danger px-4" id="delete-request-button">{{ __('Delete') }}</button>
        </div>
        <div class="card-body pt-4">
            <h4 class="font-weight-600 text-primary mb-5">{{ $helpRequest->patient_full_name }}</h4>
            <div class="row">
                <div class="col-sm-6">
                    <ul class="details-wrapper list-unstyled mb-4">
                        <li class="d-flex align-items-start">
                            <i class="fa fa-map-marker"></i>
                            <span>
                            Locatie: <b>{{ $helpRequest->county->name }}, {{ $helpRequest->city->name }}</b>
                            </span>
                        </li>
                        <li class="d-flex">
                            <i class="fa fa-phone"></i>
                            <span>
                            Telefon: <b>{{ $helpRequest->patient_phone_number }}</b>
                        </span>
                        </li>
                        <li class="d-flex">
                            <i class="fa fa-at"></i>
                            <span>
                            Email:  <a href="mailto:{{ $helpRequest->patient_email }}" target="_blank">{{ $helpRequest->patient_email }}</a>
                        </span>
                        </li>
                    </ul>
                    <ul class="details-wrapper list-unstyled">
                        <li class="d-flex align-items-start">
                            <i class="fa fa-dot-circle-o"></i>
                            <span>
                            Responsabil: <b>{{ $helpRequest->caretaker_full_name }}</b>
                            </span>
                        </li>
                        <li class="d-flex">
                            <i class="fa fa-phone"></i>
                            <span>
                            Telefon responsabil: <b>{{ $helpRequest->caretaker_phone_number }}</b>
                        </span>
                        </li>
                        <li class="d-flex">
                            <i class="fa fa-at"></i>
                            <span>
                            Email responsabil:  <a href="mailto:{{ $helpRequest->caretaker_email }}" target="_blank">{{ $helpRequest->caretaker_email }}</a>
                        </span>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <div class="kv">
                        <p>Data:</p>
                        <b>{{ formatDateTime($helpRequest->created_at) }}</b>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="kv">
                        <h6 class="mb-0">{{ __('Request status') }}</h6>
                        <div id="requestStatus"></div>
                    </div>
                </div>
            </div>
            <div class="border-top border-bottom py-4 mt-4">
                <h6 class="font-weight-600">{{ __('Diagnostic') }}</h6>
                <p class="mb-0">{{ $helpRequest->diagnostic }}</p>
            </div>
            <div class="border-bottom py-4">
                <h6 class="font-weight-600">{{ __('Extra details') }}:</h6>
                <p class="mb-0">
                    <i>
                        {{ $helpRequest->extra_details ?? 'N/A' }}
                    </i>
                </p>
            </div>
        </div>

    @include('partials.notes', [
        'notes' => $helpRequest->helprequestnotes,
        'entityType' => \App\Note::TYPE_HELP_REQUEST,
        'entityId' => $helpRequest->id
    ])

    </div>
    @foreach($helpRequest->helptypes as $helpType)
        <div class="card">
            <div class="card-body">
                <h5 class="font-weight-600 text-primary mb-4">{{ __($helpType->name) }}</h5>
                <div class="row">
                    <div class="col-sm-5">
                        @if (\App\HelpType::TYPE_SMS === $helpType->id)
                            <div class="kv">
                                <p>{{ __('Estimated amount required for treatment / surgery') }}:</p>
                                <b>{{ $helpRequest->helprequestsmsdetail()->first()->amount }}</b>
                            </div>
                            <div class="kv">
                                <p>{{ __('Clinic / hospital name where the patient is accepted') }}:</p>
                                <b>{{ $helpRequest->helprequestsmsdetail()->first()->clinic }}</b>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <div class="kv">
                                        <p>{{ __('Country') }}:</p>
                                        <b>{{ $helpRequest->helprequestsmsdetail()->first()->country->name }}</b>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="kv">
                                        <p>{{ __('City') }}:</p>
                                        <b>{{ $helpRequest->helprequestsmsdetail()->first()->city }}</b>
                                    </div>
                                </div>
                            </div>
                        @elseif (\App\HelpType::TYPE_ACCOMMODATION === $helpType->id)
                            <div class="kv">
                                <p>{{ __('At which hospital will the medical investigations / treatment be performed') }}?</p>
                                <b>{{ $helpRequest->helprequestaccommodationdetail()->first()->clinic }}</b>
                            </div>
                            <div class="kv">
                                <p>{{ __('Starting with what date you need accommodation') }}?</p>
                                <b>{{ formatDate($helpRequest->helprequestaccommodationdetail()->first()->start_date) }}</b>
                            </div>
                            <div class="kv">
                                <p>{{ __('Detail here if you need special accommodation conditions') }}:</p>
                                <b>{{ $helpRequest->helprequestaccommodationdetail()->first()->special_request }}</b>
                            </div>
                        @elseif (\App\HelpType::TYPE_OTHER_NEEDS === $helpType->id)
                            <div class="kv">
                                <b>{{ $helpType->pivot->message }}</b>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        @if (\App\HelpType::TYPE_SMS === $helpType->id)
                            <div class="kv">
                                <p>{{ __('Fund destination') }}:</p>
                                <b>{{ $helpRequest->helprequestsmsdetail()->first()->purpose }}</b>
                            </div>
                        @elseif (\App\HelpType::TYPE_ACCOMMODATION === $helpType->id)
                            <div class="kv">
                                <p>{{ __('For how many people do you need accommodation') }}?</p>
                                <b>{{ $helpRequest->helprequestaccommodationdetail()->first()->guests_number }}</b>
                            </div>
                            <div class="kv">
                                <p>{{ __('Until when do you need accommodation') }}?</p>
                                <b>{{ formatDate($helpRequest->helprequestaccommodationdetail()->first()->end_date) }}</b>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="change-approval-{{ $helpType->id }}">Nivel de aprobare:</label>
                            @php
                                $newClass = '';

                                if ('pending' === $helpType->pivot->approve_status) {
                                    $newClass = 'bg-warning border-warning';
                                } else if ('approved' === $helpType->pivot->approve_status) {
                                    $newClass = 'bg-success border-success';
                                } else if ('denied' === $helpType->pivot->approve_status) {
                                    $newClass = 'bg-danger border-danger';
                                }
                            @endphp
                            <select name="change-approval-{{ $helpType->id }}" id="change-approval-{{ $helpType->id }}" data-type-id="{{ $helpType->id }}" data-identifier="{{ $helpType->pivot->id }}" class="change-approval-status custom-select form-control text-white font-weight-600 {{ $newClass }}">
                                @foreach(\App\HelpRequestType::approveStatusList() as $key => $value)
                                    @if (!(\App\HelpRequestType::APPROVE_STATUS_PENDING === $key && \App\HelpRequestType::APPROVE_STATUS_PENDING !== $helpType->pivot->approve_status))
                                    <option value="{{ $key }}" {{ ($key == $helpType->pivot->approve_status) ? 'selected' : '' }}>{{ __($value) }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Confirmation modal -->
    <div class="modal fade bd-example-modal-sm" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Schimbare nivel de aprobare</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Sigur vrei sa schimbi nivelul de aprobare pentru aceasta cerere?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-dismiss="modal" id="cancel">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-secondary" id="proceed">{{ __('Yes') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmare stergere cerere -->
    <div class="modal fade bd-example-modal-sm" id="deleteRequestModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">{{ __('Delete note') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this request') }}?
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
    <script>
        let setRequestStatus = function(status) {
            let badgeColor = 'badge-success';

            if ('new' === status) {
                badgeColor = 'badge-danger';
            } else if ('in-progress' === status) {
                badgeColor = 'badge-warning';
            } else if ('completed' === status) {
                badgeColor = 'badge-success';
            }

            $('#requestStatus span').remove();
            $('#requestStatus').append('<span class="badge ' + badgeColor + '">' + $.TranslateRequestStatus(status) + '</span>');
        };

        let setRequestTypeStatus = function(id, status) {
            let newClass = '';

            if ('pending' === status) {
                newClass = 'bg-warning border-warning';
            } else if ('approved' === status) {
                newClass = 'bg-success border-success';
            } else if ('denied' === status) {
                newClass = 'bg-danger border-danger';
            }

            $('#change-approval-' + id)
                .removeClass('bg-danger border-danger bg-warning border-warning bg-success border-warning')
                .addClass(newClass);
        };

        $(document).ready(function() {
            setRequestStatus('{{ $helpRequest->status }}');

            let selectedHelpTypeIdentifier = null;
            let selectedHelpTypeId = null;
            let selectedHelpTypeStatus = null;
            let selectedHelpTypePreviousStatus = null;
            let deleteNoteId = null;

            $('.change-approval-status')
                .on('focusin', function() {
                    $(this).data('val', $(this).val());
                })
                .on('change', function() {
                    selectedHelpTypeIdentifier = $(this).data('identifier');
                    selectedHelpTypeId = $(this).data('type-id');
                    selectedHelpTypeStatus = $(this).val();
                    selectedHelpTypePreviousStatus = $(this).data('val');

                    setRequestTypeStatus(selectedHelpTypeId, selectedHelpTypeStatus);

                    $('#confirmationModal').modal('show');
                });

            $('#confirmationModal').on('hide.bs.modal', function () {
                if (selectedHelpTypePreviousStatus !== selectedHelpTypeStatus) {
                    setRequestTypeStatus(selectedHelpTypeId, selectedHelpTypePreviousStatus);
                    $('#change-approval-' + selectedHelpTypeId).val(selectedHelpTypePreviousStatus);
                }
            });

            $('#proceed').on('click', function() {
                axios.put('/admin/ajax/help-type/' + selectedHelpTypeIdentifier, {
                    _token: "{{ csrf_token() }}",
                    approvalStatus: selectedHelpTypeStatus
                }).then(response => {
                    if ('approved' === selectedHelpTypeStatus || 'denied' === selectedHelpTypeStatus) {
                        $('#change-approval-' + selectedHelpTypeId + ' option[value=pending]').remove();
                    }
                    selectedHelpTypePreviousStatus = selectedHelpTypeStatus;
                    setRequestStatus(response.data.requestStatus);
                    $('#confirmationModal').modal('hide');
                })
                .catch(error => {
                    console.log(error);
                });
            });

            $('#addNote').on('click', function() {
                axios.post('{{ @route('ajax.create-note', ['entityType' => \App\Note::TYPE_HELP_REQUEST, 'entityId' => $helpRequest->id]) }}', {
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

            $('#delete-request-button').on('click', function() {
                $('#deleteRequestModal').modal('show');
            });

            $('#proceedDeleteRequest').on('click', function() {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';

                axios
                .delete('/admin/ajax/help-request/{{ $helpRequest->id }}')
                .then(response => {
                    $('#deleteRequestModal').modal('hide');
                    window.location.replace('{{ route('admin.help-list') }}');
                })
                .catch(error => {
                    console.log(error);
                });
            });
        });
    </script>
@endsection
