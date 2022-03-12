
<div class="card shadow">
    <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
        <h6 class="font-weight-600 text-white mb-0">
            {{ __("Personal information") }}
        </h6>

        <div>
            <a href="#" class="btn btn-sm btn-danger px-4 delete-host" data-id="{{ $user->id }}">{{ __('Delete') }}</a>
            <a class="btn btn-secondary btn-sm px-4" href="{{ route('admin.host-edit', ['id' => $user->id]) }}">{{ __("Profile edit") }}</a>
        </div>
    </div>
    <div class="card-body pt-4">
        <div class="kv d-flex">
            <b class="mr-3">
                {{ __("Full Name") }}:
            </b>
            <p>
                @if ($user->name) {{ $user->name }} @else - @endif
            </p>
        </div>
        <div class="kv d-flex">
            <b class="mr-3">
                {{ __("Country") }}:
            </b>
            <p>
                @if ($user->country) {{ $user->country->name }} @else - @endif
            </p>
        </div>
        <div class="kv d-flex">
            <b class="mr-3">
                {{ __("City") }}:
            </b>
            <p>
                @if ($user->city) {{ $user->city }} @else - @endif
            </p>
        </div>
        <div class="kv d-flex">
            <b class="mr-3">
                {{ __("Address") }}:
            </b>
            <p>
                @if ($user->address) {{ $user->address }} @else - @endif
            </p>
        </div>
        <div class="kv d-flex">
            <b class="mr-3">
                {{ __("Phone Number") }}:
            </b>
            <p>
                @if ($user->phone_number) {{ $user->phone_number }} @else - @endif
            </p>
        </div>
        <div class="kv d-flex">
            <b class="mr-3">
                {{ __("E-Mail Address") }}:
            </b>
            <p>
                {{ $user->email }}
            </p>
        </div>
        @if ($user->isHost())
            <div class="kv d-flex">
                <b class="mr-3">
                    {{ __('Host ID') }}
                </b>
                <div class="gallery d-flex flex-wrap mb-4">
                    @if ($host_id_url)
                        <a href="{{ $host_id_url }}" data-toggle="lightbox">
                            <img src="{{ $host_id_url }}" alt="photo" class="img-fluid">
                        </a>
                    @else
                        &mdash;
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Confirmare activare si resetare parola host -->
<div class="modal fade bd-example-modal-sm" id="activateHostAndResetPassword" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __("Approve user") }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __("Are you sure?") }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-dark" data-dismiss="modal" id="cancel">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-danger" id="proceedActivateHostAndResetPassword">{{ __('Yes') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirmare activare si resetare parola host -->
<div class="modal fade bd-example-modal-sm" id="resetPassword" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __("Reset host password") }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __("Reset password in case you forgot it") }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-dark" data-dismiss="modal" id="cancel">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-danger" id="proceedResetPassword">{{ __('Yes') }}</button>
            </div>
        </div>
    </div>
</div>


@if (!$user->approved_at)
    <div class="alert alert-secondary d-flex justify-content-between align-items-center">
        <h6 class="mb-0 font-weight-600 text-white">
            {{ __("Approve user") }}
        </h6>
        <a class="btn btn-white text-secondary px-4 ml-3" id="validateAccount" href="{{ route('admin.user-approve', ['id' => $user->id]) }}">{{ __("Send") }}</a>
    </div>
@else
    <div class="alert alert-white d-flex justify-content-between align-items-center">
        <h6 class="mb-0 font-weight-600 text-dark">
            {{ __("Reset password in case you forgot it") }}
        </h6>
        <a class="btn btn-secondary px-4 ml-3" id="resetAccount" href="{{ route('admin.user-password-reset', ['id' => $user->id]) }}">{{ __("Send") }}</a>
    </div>
@endif
