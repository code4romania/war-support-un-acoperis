@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600">{{ __('Login logs') }}</h6>
    </section>
    <section class="details">
        <div class="table-responsive shadow-sm mb-4 bg-white p-4">
            <table id="auditLogsTable" class="table table-striped w-100 mb-0 p-5">
                <thead>
                <tr>
                    <th>{{ __('User ID') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Failed login attempts') }}</th>
                    <th>{{ __('Last login') }}</th>
                </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                <tr>
                    <th>{{ __('User ID') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Failed login attempts') }}</th>
                    <th>{{ __('Last login') }}</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#auditLogsTable').DataTable( {
                "ajax": '{{ route('admin.loginLogs.search') }}'
            } );
        } );
    </script>
@endsection
