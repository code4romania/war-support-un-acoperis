@extends('layouts.admin')

@section('content')
    @include('partials.user-detail')

    @if($user->isRefugee())
        <div class="card shadow">
            <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center rounded">
                <h6 class="font-weight-600 text-white mb-0">
                    {{ __('Hosts') }}
                </h6>
            </div>
            <div class="card-body pre-scrollable">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Host') }}</th>
                        <th>{{ __('Accommodation') }}</th>
                        <th>{{ __('Guests number') }}</th>
                        <th>{{ __('Time') }}</th>
                        <th>{{ __('From') }}</th>
                        <th>{{ __('To') }}</th>
                        <th>{{ __('Status') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($details->refugeeAllocatedHistory as $key => $detail)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="{{ route('admin.user-detail', $detail->host_id) }}">{{ $detail->host->name }}</a></td>
                        <td><a href="{{ route('admin.accommodation-detail', $detail->accommodation_id) }}">{{ $detail->accommodation->accommodationtype->name }}</a></td>
                        <td>{{ $detail->number_of_guest }}</td>
                        <td>{{ $detail->accommodationTime }} zile</td>
                        <td>{{ $detail->from }}</td>
                        <td>{{ $detail->to }}</td>
                        <td>{{ $detail->deallocated_at ? __('Deallocated at: ') . $detail->deallocated_at : __('Allocated') }}</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5">{{ $user->name }} {{ __('has not been in any accommodation.') }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

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
