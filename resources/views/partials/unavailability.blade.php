<template id="unavailability_interval">

    <div class="row" id="unavailability_interval_##index##">
        <div class="col-xl-5 col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input
                        placeholder="{{ __('Unavailable from') }}"
                        name="unavailable[##index##][from]"
                        class="unavailable_from_##index## unavailable_##index## flatpickr flatpickr-input form-control"
                        type="text"
                        value="##from##"
                    />

                </div>
                <span class="unavailable_from_error_##index## invalid-feedback d-flex" role="alert"></span>
            </div>
        </div>
        <div class="col-xl-5 col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input
                        placeholder="{{ __('Unavailable to') }}"
                        name="unavailable[##index##][to]"
                        class="unavailable_to_##index## unavailable_##index## flatpickr flatpickr-input form-control"
                        type="text"
                        value="##to##"
                    />

                </div>
                <span class="unavailable_to_error_##index## invalid-feedback d-flex" role="alert"></span>
            </div>
        </div>
        <div class="col-xl-2 col-md-12 delete-period-col">
            <div class="form-group">
                <div class="input-group">
                    <button type="button" class="btn btn-danger btn-md text-nowrap delete-period btn-block" data-index-number="##index##">
                        <span class="btn-inner--text" >Sterge</span>
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
            @if (strpos($key, 'unavailable.') == 0 && strpos($key, '.from') > -1)
                errorFrom['{{ $key }}'] = '{{ $error[0] }}'.replace('{{ $key }} ', '');
            @endif
            @if (strpos($key, 'unavailable.') == 0 && strpos($key, '.to') > -1)
                errorTo['{{ $key }}'] = '{{ $error[0] }}'.replace('{{ $key }} ', '').replace(/unavailable.(\d)+.from/, '{{ __("interval start") }}');
            @endif
        @endforeach

        @if (old('unavailable'))
            @foreach (old('unavailable') as $key => $unavailable)
                addInterval(
                    '{{ $unavailable['from'] }}',
                    '{{ $unavailable['to'] }}',
                    errorFrom.hasOwnProperty('unavailable.' + maxValue + '.from') ? errorFrom['unavailable.' + maxValue + '.from'] : null,
                    errorTo.hasOwnProperty('unavailable.' + maxValue + '.to') ? errorTo['unavailable.' + maxValue + '.to'] : null
                );
            @endforeach
        @else
            @isset ($unavailableIntervals)
                @foreach($unavailableIntervals as $unavailableInterval)
                addInterval(
                    '{{ $unavailableInterval->from_date }}',
                    '{{ $unavailableInterval->to_date }}'
                );
                @endforeach
            @endisset
        @endif
    });

    let maxValue = 0;

    const deleteInterval = function(object) {
        $("#unavailability_interval_" + object.dataset.indexNumber).remove();
    }

    const addInterval = function(from, to, errorFrom, errorTo) {
        from = typeof from !== 'undefined' ? from : '';
        to = typeof to !== 'undefined' ? to : '';
        errorFrom = typeof errorFrom !== 'undefined' ? errorFrom : null;
        errorTo = typeof errorTo !== 'undefined' ? errorTo : null;

        $("#unavailability_container").append(
            $("#unavailability_interval").html()
                .replace(/##index##/g, maxValue)
                .replace(/##from##/g, from)
                .replace(/##to##/g, to)
        );

        flatpickr('.unavailable_' + maxValue);

        if (errorFrom) {
            $('.unavailable_from_error_' + maxValue).text(errorFrom);
            $('.unavailable_from_' + maxValue).addClass('is-invalid');
        } else {
            $('.unavailable_from_error_' + maxValue).remove();
        }

        if (errorTo) {
            $('.unavailable_to_error_' + maxValue).text(errorTo);
            $('.unavailable_to_' + maxValue).addClass('is-invalid');
        } else {
            $('.unavailable_to_error_' + maxValue).remove();
        }

        $('.delete-period').on('click', function() {
            deleteInterval(this);
        });

        maxValue++
    };
</script>
