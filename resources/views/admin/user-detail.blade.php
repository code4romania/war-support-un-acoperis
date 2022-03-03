@extends('layouts.admin')

@section('content')
    @include('partials.user-detail')

    <!-- Confirmare stergere gazda -->
    <div class="modal fade bd-example-modal-sm" id="deleteHostModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Delete host') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this host?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-dismiss="modal" id="cancel">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-secondary" id="proceedDeleteHost">{{ __('Yes') }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        let selectedHost = null;

        $('.delete-host').on('click', function(event) {
            event.preventDefault();
            selectedHost = $(this).data('id');
            $('#deleteHostModal').modal('show');
        });

        $('#proceedDeleteHost').on('click', function() {
            $('#deleteHostModal').modal('hide');
            window.location.href = '/admin/host/'+selectedHost+'/delete';
        });

        $(document).ready(function () {

            $('#validateAccount').on('click', function (event) {
                event.preventDefault();
                $('#activateHostAndResetPassword').modal('show');
                const url = this.href;
                $('#proceedActivateHostAndResetPassword').on('click', function () {
                    window.location.href = url;
                });
            });

            $('#resetAccount').on('click', function (event) {
                event.preventDefault();
                $('#resetPassword').modal('show');
                const url = this.href;
                $('#proceedResetPassword').on('click', function () {
                    window.location.href = url;
                });
            });
        });
    </script>
@endsection
