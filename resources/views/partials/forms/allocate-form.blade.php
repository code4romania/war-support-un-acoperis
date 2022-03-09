@php

    $availableIntervals =  $accommodation->availabilityIntervals()->get(); // from_date - to_date
    $bookedIntervals = $accommodation->helpRequests;

    $bookedDays = [];

    foreach ($bookedIntervals as $bookedInterval) {

        $start_interval = new DateTime($bookedInterval->pivot->start_date);
        $end_interval = new DateTime($bookedInterval->pivot->end_date);

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start_interval, $interval, $end_interval);

        foreach ($period as $dt) {
            $day = $dt->format("d-m-Y");
            if(isset($bookedDays[$day])) {
                $bookedDays[$day] += $bookedInterval->guests_number;
            }
            else {
                $bookedDays[$day] = $bookedInterval->guests_number;
            }
        }
    }

    // accomodation avem un max capacity
    // allocation => nr guest / start date si end date


    //dd($bookedDays);

@endphp

<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-6">
        <div class="card shadow">
            <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
                <h6 class="font-weight-600 text-white mb-0">
                    {{ __('Availabillity Accomodation') }}
                </h6>
                <span class="btn btn-sm badge-warning">{{ __('Capacity') }}: {{$accommodation->max_guests}}</span>
            </div>
            <div class="card-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-12 col-lg-6">
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
                            <label class="" for="helpRequestID">{{ __('Help request number') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-tag"></i></span>
                                </div>
                                <input class="form-control @error('help_request_id') is-invalid @enderror" id="helpRequestID" name="help_request_id" placeholder="e.g. 12" value="">
                                @error('help_request_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="" for="guestNumber">{{__('Number of guests')}}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-tag"></i></span>
                                </div>
                                <input class="form-control  @error('guests_number') is-invalid @enderror" id="guestNumber" name="guests_number" type="number" value="1">
                                @error('guests_number') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="" for="startDateFilter">{{ __('Starting with') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="flatpickr flatpickr-input form-control" type="text" id="startDate" name="startDate" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="" for="startDateFilter">{{ __('Until') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="flatpickr flatpickr-input form-control" type="text" id="endDate" name="endDate" />
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">{{__('Allocate')}}</button>
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
    </div>
</div>

