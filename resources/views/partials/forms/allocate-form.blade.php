<div class="card shadow">
    <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
        <h6 class="font-weight-600 text-white mb-0">
            {{ __('Allocate user to host') }}
        </h6>
        <a class="btn btn-white text-danger btn-sm px-4 delete-accommodation" href="#">{{ __('Delete') }}</a>
    </div>
    <div class="card-body">
        <form action="{{route('admin.allocate.user.to.host')}}" method="post">
            <div class="form-group">
                <label class="form-check-label" for="capacity">{{ __('Capacity') }}</label>
                <p>{{$accommodation->max_guests}}</p>
            </div>
            <div class="form-row">
                <div class="col">
                    <input class="form-control" id="helpRequestID" name="help_request_id"
                           placeholder="{{__('Help request number')}}" value="">
                </div>
                <div class="col">
                    <input class="form-control" id="helpRequestID" name="help_request_id"
                           placeholder="{{__('Number of guests')}}" value="">
                </div>
                <div class="col">
                    <submit class="btn btn-primary">{{__('Allocate')}}</submit>
                </div>
            </div>
        </form>
    </div>
</div>
