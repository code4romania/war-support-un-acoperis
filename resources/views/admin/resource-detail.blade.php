@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title mb-3 font-weight-600">Resurse ajutor</h6>
        <a href="{{ route('admin.resource-list') }}" class="btn btn-sm btn-outline-primary mr-3">Inapoi</a>
    </section>
    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ $helpResourceType->resourcetype->name }}
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
                <b>{{ $helpResourceType->resourcetype->name }} @if ($helpResourceType->resourcetype->options == \App\ResourceType::OPTION_MESSAGE) ({{ $helpResourceType->helpresource->message }}) @endif</b>
            </div>
            <div class="border-bottom py-4" id="noteContainer">
                <h6 class="font-weight-600 mb-3">{{ __('Notes') }}</h6>
                @foreach($helpResourceType->notes as $note)
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
@endsection


@section('scripts')
    <script src="https://cdn.tiny.cloud/1/bgsado4b682dgf10owt5ns07i6jh5vcf36tc06nntxc08asr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
    $(document).ready(function() {

        tinymce.init({
            selector: '.tinymce'
        });

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

        let addNote = function (id, message, user, date) {
            console.log('Adding note');
            console.log(message);
            console.log(user);
            console.log(date);

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
            axios.post('{{ @route('ajax.create-note', ['entityType' => \App\Note::TYPE_HELP_RESOURCE, 'entityId' => $helpResourceType->id]) }}', {
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
    });
</script>
@endsection

