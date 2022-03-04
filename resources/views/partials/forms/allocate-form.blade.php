<div class="card shadow">
    <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
        <h6 class="font-weight-600 text-white mb-0">
            {{ __('Allocate user to host') }}
        </h6>
        <a class="btn btn-white text-danger btn-sm px-4 delete-accommodation" href="#">{{ __('Delete') }}</a>
    </div>
    <div class="card-body">
        @if (!$accommodation->isAlreadyFull() && $accommodation->isApproved() )
            <form action="{{route('admin.allocate.user.to.host', ['id' => $accommodation->id])}}" method="post">
                {{ csrf_field() }}
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="form-group">
                    <label class="form-check-label" for="capacity">{{ __('Occupied') }} / {{ __('Capacity') }}</label>
                    <p>{{ $accommodation->getOccupiedSpace() }} / {{$accommodation->max_guests}}</p>
                </div>
                <div class="form-row">
                    <div class="col">
                        <input class="form-control @error('help_request_id') is-invalid @enderror" id="helpRequestID"
                               name="help_request_id"
                               placeholder="{{__('Help request number')}}" value="">
                        @error('help_request_id')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <input class="form-control  @error('guests_number') is-invalid @enderror" id="helpRequestID"
                               name="guests_number"
                               placeholder="{{__('Number of guests')}}" value="">
                        @error('guests_number')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">{{__('Allocate')}}</button>
                    </div>
                </div>
            </form>
        @else
            <h5 class="font-weight-600 text-primary mb-4">
                @if(!$accommodation->isApproved())
                    {{ __('This accommodation is not approved') }}
                    <a class="btn btn-primary"
                       href="{{ route('admin.accommodation-approve',['id'=>$accommodation->id])}}">{{__('Approve')}}</a>
                @else
                    {{ __('This accommodation is already full') }}
                @endif
            </h5>
        @endif
    </div>
</div>
