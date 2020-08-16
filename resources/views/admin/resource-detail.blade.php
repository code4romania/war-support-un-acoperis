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
    <div class="card shadow" style="opacity:.3">
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
                <div class="note p-3" id="note-container-{{ /* $helpRequestNote->id */ }}">
                    <div class="row align-items-sm-center">
                        <div class="col-sm-9 mb-4 mb-sm-0">
                            <p class="mb-1">Acest beneficiar nu ne-a mai cerut ajutor in trecut</p>
                            <div class="meta">
                                <span>Added by <b>Grigore Minulescu</b></span>
                                <span class="text-dot-left">12 Jun, 2020 - 13:43 PM</span>
                            </div>
                        </div>
                        <div class="col-sm-3 text-sm-right">
                            <button class="btn btn-sm btn-info">Editeaza</button>
                            <button class="btn btn-sm btn-danger">Sterge</button>
                        </div>
                    </div>
                </div>
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
    });
</script>
@endsection

