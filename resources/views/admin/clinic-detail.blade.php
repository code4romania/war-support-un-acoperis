@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title mb-3 font-weight-600">{{ __('Clinic details') }}</h6>
        <a href="{{ route('admin.clinic-list') }}" class="btn btn-sm btn-outline-primary mr-3">Înapoi</a>
    </section>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ $clinic->name }}
            </h6>
            <div>
                <a class="btn btn-white text-default btn-sm px-4" href="{{ route('admin.clinic-update', $clinic->id) }}">{{ __('Edit') }}</a>
                <a class="btn btn-white text-danger btn-sm px-4" href="#" id="delete-clinic-button">{{ __('Delete') }}</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h4 class="font-weight-600 text-primary mb-5">Detalii despre clinica</h4>
                    <ul class="details-wrapper bordered-left list-unstyled">
                        <li class="d-flex align-items-start">
                            <i class="fa fa-map-marker"></i>
                            <span>
                            {{ $clinic->address }}<br>{{ $clinic->city }}<br> {{ $clinic->country->name }}
                        </span>
                        </li>
                        <li class="d-flex">
                            <i class="fa fa-phone"></i>
                            <span>
                            {{ $clinic->phone_number }}
                        </span>
                        </li>
                        <li class="d-flex">
                            <i class="fa fa-globe"></i>
                            <span>
                            <a href="{{ $clinic->website }}">{{ $clinic->website }}</a>
                        </span>
                        </li>
                    </ul>
                </div>
                <div class="col-6">
                    <h4 class="font-weight-600 text-primary mb-5">{{ __('Clinic contact person') }}</h4>
                    <ul class="details-wrapper bordered-left list-unstyled">
                        <li class="d-flex">
                            <i class="fa fa-user-circle"></i>
                            <span>
                            {{ $clinic->contact_person_name }}
                        </span>
                        </li>
                        <li class="d-flex">
                            <i class="fa fa-phone"></i>
                            <span>
                            {{ $clinic->contact_person_phone }}
                        </span>
                        </li>
                        <li class="d-flex">
                            <i class="fa fa-envelope"></i>
                            <span>
                            {{ $clinic->contact_person_email }}
                        </span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <h4 class="font-weight-600 text-primary mt-5">Descriere</h4>
                    <div>
                        {!! $clinic->description !!}
                    </div>
                    <h4 class="font-weight-600 text-primary mt-5">{{ __('Clinic additional informations') }}</h4>
                    <div>
                        {!! $clinic->additional_information !!}
                    </div>
                </div>
                <div class="col-6">
                    <h4 class="font-weight-600 text-primary mt-5">Specializare</h4>
                    <ul class="list-custom">
                        @foreach($clinic->specialities as $speciality)
                            <li>{{ $speciality->name }}</li>
                        @endforeach
                    </ul>
                    <h4 class="font-weight-600 text-primary mt-5">{{ __('Clinic transport') }}</h4>
                    <div>
                        {!! $clinic->transport_details !!}
                    </div>
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

            $('#delete-clinic-button').on('click', function() {
                $('#deleteRequestModal').modal('show');
            });

            $('#proceedDeleteRequest').on('click', function() {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';

                axios
                    .delete('{{ route('ajax.delete-clinic', $clinic->id) }}')
                    .then(response => {
                        $('#deleteRequestModal').modal('hide');
                        window.location.replace('{{ route('admin.clinic-list') }}');
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });
        });
    </script>
@endsection
