<script type="text/javascript">
    window.calendar_config = {
        max_guests: {{$accommodation->max_guests}},
        bookedDays: '{!! json_encode($bookedDays)  !!}',
        availableDays: '{!! json_encode(array_unique($availableDays)) !!}',
        slotName: "{{__('Available slots')}}"
    }
</script>
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

                        @if(session()->has('errors'))
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <div class="form-group">
                            <label class="" for="helpRequestID">{{ __('Help request number') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-tag"></i></span>
                                </div>
                                <input class="form-control @error('help_request_id') is-invalid @enderror"
                                       id="helpRequestID" name="help_request_id" placeholder="e.g. 12"
                                       value="{{ old('help_request_id') }}">
                                @error('help_request_id')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="" for="startDateFilter">{{ __('Starting with') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input
                                    class="flatpickr flatpickr-input form-control @error('startDate') is-invalid @enderror"
                                    type="text" id="startDate" name="startDate" value="{{ old('startDate') }}" />
                                @error('startDate') <span class="invalid-feedback"
                                                          role="alert">{{ $message }}</span> @enderror
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="" for="startDateFilter">{{ __('Until') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input
                                    class="flatpickr flatpickr-input form-control @error('endDate') is-invalid @enderror"
                                    type="text" id="endDate" name="endDate" value="{{ old('startDate') }}" />
                                @error('endDate') <span class="invalid-feedback"
                                                        role="alert">{{ $message }}</span> @enderror
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

@section('scripts')
    @parent
    <script type="application/javascript">
        $(document).ready(() => {

            //fcallendar for allocation form

            var fc_today = moment();
            var fcalendar = $('#calendar');

            console.log(fcalendar)

            if (fcalendar !== undefined) {
                var availableDays = JSON.parse(window.calendar_config.availableDays);
                var bookedDays = JSON.parse(window.calendar_config.bookedDays);
                var max_guests = window.calendar_config.max_guests;
                var slotName = window.calendar_config.slotName;


                // console.log(availableDays,bookedDays,max_guests);

                fcalendar.fullCalendar({
                    header: {
                        right: 'prev,next today',
                        left: 'title',
                    },
                    height: 550,
                    showNonCurrentDates: false,
                    fixedWeekCount: false,
                    validRange: {"start": fc_today.format('YYYY-MM-DD')},
                    defaultView: 'month',
                    dayRender: function (date, cell) {
                        let current_date = date.format('DD-MM-YYYY');

                        if (!availableDays.includes(current_date)) {
                            cell.addClass('disabled');
                        } else {
                            cell.addClass('available');

                            if (bookedDays[current_date] !== undefined) {
                                (max_guests > bookedDays[current_date]) ? cell.addClass('warning') : cell.addClass('danger');
                                let spots_left = max_guests - bookedDays[current_date];
                                cell.append('<span class="nr-badge" data-toggle="tooltip" data-placement="top" title="' + spots_left + ' ' + slotName + '">' + spots_left + '</span>');
                            } else {
                                cell.append('<span class="nr-badge" data-toggle="tooltip" data-placement="top" title="' + max_guests + ' ' + slotName + '">' + max_guests + '</span>');
                            }

                        }
                        // if (current_date === fc_today.format('DD-MM-YYYY')) {
                        //     cell.css("background-color", "red");
                        // }

                    }
                });
            }
        })
    </script>
@endsection
