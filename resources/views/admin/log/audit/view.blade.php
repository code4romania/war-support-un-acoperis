@extends('layouts.admin')

@section('content')
    <section class="">
        <h6 class="page-title font-weight-600">{{ __('Audit log') }}</h6>
    </section>
    <div class="card shadow">
        <form method="post">
            @csrf
            <div class="card-header bg-admin-blue py-3">
                <h6 class="font-weight-600 text-white mb-0">
                    Informații log
                </h6>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="user" class="col-md-4 col-form-label text-md-right">{{ __('User') }}</label>

                    <div class="col-md-6">
                        <input id="user" type="text" class="form-control form-control-alternative" name="user" value="{{ $log->user ? $log->user->name : '' }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                    <div class="col-md-6">
                        <input id="role" type="text" class="form-control form-control-alternative" name="role" value="{{ $log->user ? $log->user->roles->pluck('name')->implode(', ') : '' }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="event" class="col-md-4 col-form-label text-md-right">{{ __('Event') }}</label>

                    <div class="col-md-6">
                        <input id="event" type="text" class="form-control form-control-alternative" name="event" value="{{ $log->event }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="entity" class="col-md-4 col-form-label text-md-right">{{ __('Entity') }}</label>

                    <div class="col-md-6">
                        <input id="entity" type="text" class="form-control form-control-alternative" name="entity" value="{{ $log->auditable_type }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('URL') }}</label>

                    <div class="col-md-6">
                        <input id="url" type="text" class="form-control form-control-alternative" name="url" value="{{ $log->url }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ip" class="col-md-4 col-form-label text-md-right">{{ __('IP') }}</label>

                    <div class="col-md-6">
                        <input id="ip" type="text" class="form-control form-control-alternative" name="ip" value="{{ $log->ip_address }}" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="userAgent" class="col-md-4 col-form-label text-md-right">{{ __('User agent') }}</label>

                    <div class="col-md-6">
                        <input id="userAgent" type="text" class="form-control form-control-alternative" name="user_agent" value="{{ $log->user_agent }}" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                    <div class="col-md-6">
                        <input id="date" type="text" class="form-control form-control-alternative" name="url" value="{{ $log->created_at->toDateTimeString() }}" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="old_values" class="col-md-4 col-form-label text-md-right">{{ __('Old values') }}</label>

                    <div class="col-md-6">
                        @if (! empty($log->old_values))
                            <table class="table table-striped">
                                <thead>
                                <th>{{ __('Column') }}</th>
                                <th>{{ __('Value') }}</th>
                                </thead>
                                <tbody>
                                @foreach ($log->old_values as $column => $value)
                                    <tr>
                                        <td>{{ $column }}</td>
                                        <td>{{ $value }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="new_values" class="col-md-4 col-form-label text-md-right">{{ __('New values') }}</label>

                    <div class="col-md-6">
                        @if (! empty($log->new_values))
                            <table class="table table-striped">
                                <thead>
                                <th>{{ __('Column') }}</th>
                                <th>{{ __('Value') }}</th>
                                </thead>
                                <tbody>
                                @foreach ($log->new_values as $column => $value)
                                    <tr>
                                        <td>{{ $column }}</td>
                                        <td>{{ $value }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
