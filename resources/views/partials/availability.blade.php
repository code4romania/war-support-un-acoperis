<template id="availability_interval">

    <div class="row" id="availability_interval_##index##">
        <div class="col-xl-5 col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input
                        placeholder="{{ __('Availability start date') }}"
                        name="available[##index##][from]"
                        class="available_from_##index## available_##index## flatpickr flatpickr-input form-control"
                        type="text"
                        value="##from##"
                    />

                </div>
                <span class="available_from_error_##index## invalid-feedback d-flex" role="alert"></span>
            </div>
        </div>
        <div class="col-xl-5 col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input
                        placeholder="{{ __('Availability end date') }}"
                        name="available[##index##][to]"
                        class="available_to_##index## available_##index## flatpickr flatpickr-input form-control"
                        type="text"
                        value="##to##"
                    />

                </div>
                <span class="available_to_error_##index## invalid-feedback d-flex" role="alert"></span>
            </div>
        </div>
        <div class="col-xl-2 col-md-12 delete-period-col">
            <div class="form-group">
                <div class="input-group">
                    <button type="button" class="btn btn-danger btn-md text-nowrap delete-period btn-block" data-index-number="##index##">
                        <span class="btn-inner--text" >{{ __('Delete') }}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    $(document).ready(function () {
        $("#add-interval").on('click', function() {
            addInterval();
        });

        let errorFrom = {};
        let errorTo = {};

        @foreach ($errors->getMessages() as $key => $error)
            @if (strpos($key, 'available.') == 0 && strpos($key, '.from') > -1)
                errorFrom['{{ $key }}'] = '{{ $error[0] }}'.replace('{{ $key }} ', '');
            @endif
            @if (strpos($key, 'available.') == 0 && strpos($key, '.to') > -1)
                errorTo['{{ $key }}'] = '{{ $error[0] }}'.replace('{{ $key }} ', '').replace(/available.(\d)+.from/, '{{ __("interval start") }}');
            @endif
            @if ($key === 'available')
                errorFrom['available.0.from'] = '{{ $error[0] }}';
            @endif
        @endforeach

        @if (old('available'))
            @foreach (old('available') as $key => $available)
                addInterval(
                    '{{ $available['from'] }}',
                    '{{ $available['to'] }}',
                    errorFrom.hasOwnProperty('available.' + maxValue + '.from') ? errorFrom['available.' + maxValue + '.from'] : null,
                    errorTo.hasOwnProperty('available.' + maxValue + '.to') ? errorTo['available.' + maxValue + '.to'] : null
                );
            @endforeach
        @else
            @isset ($availabilityIntervals)
                @foreach($availabilityIntervals as $availableInterval)
                addInterval(
                    '{{ $availableInterval->from_date }}',
                    '{{ $availableInterval->to_date }}'
                );
                @endforeach
            @endisset
        @endif
    });

    let maxValue = 0;

    const deleteInterval = function(object) {
        $("#availability_interval_" + object.dataset.indexNumber).remove();
    }

    const addInterval = function(from, to, errorFrom, errorTo) {
        from = typeof from !== 'undefined' ? from : '';
        to = typeof to !== 'undefined' ? to : '';
        errorFrom = typeof errorFrom !== 'undefined' ? errorFrom : null;
        errorTo = typeof errorTo !== 'undefined' ? errorTo : null;

        $("#availability_container").append(
            $("#availability_interval").html()
                .replace(/##index##/g, maxValue)
                .replace(/##from##/g, from)
                .replace(/##to##/g, to)
        );

        flatpickr('.available_' + maxValue);

        if (errorFrom) {
            $('.available_from_error_' + maxValue).text(errorFrom);
            $('.available_from_' + maxValue).addClass('is-invalid');
        } else {
            $('.available_from_error_' + maxValue).remove();
        }

        if (errorTo) {
            $('.available_to_error_' + maxValue).text(errorTo);
            $('.available_to_' + maxValue).addClass('is-invalid');
        } else {
            $('.available_to_error_' + maxValue).remove();
        }

        $('.delete-period').on('click', function() {
            deleteInterval(this);
        });

        maxValue++
    };
</script>
