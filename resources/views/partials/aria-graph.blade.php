<div class="card shadow-sm{{ !empty($last) ? ' mb-0' : '' }}" id="Chart{{ $id }}">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="mb-0">
            {{ $title }}
        </h6>
        <div class="actions text-sm-right w-50">
            <div class="form-group d-inline-block mr-2 mb-sm-0">
                <select class="interval-select custom-select form-control form-control-sm">
                    <option value="days" selected>last days</option>
                    <option value="weeks">last weeks</option>
                    <option value="months">last months</option>
                    <option value="years">last years</option>
                </select>
            </div>
{{--            <a href="" class="btn btn-sm btn-primary">Export Raport</a>--}}
        </div>
    </div>
    <div class="card-body">
        <canvas id="myChart" width="100%" height="20"></canvas>
    </div>
</div>

@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            const initChart = function () {
                var ctx = $('#Chart{{ $id }} #myChart');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        datasets: [{
                            backgroundColor: [ 'rgba(40, 174, 228, .3)' ],
                            borderColor: [ 'rgb(40, 174, 228)' ],
                            fill: 'start'
                        }]
                    },
                    options: {
                        maintainAspectRatio: true,
                        spanGaps: false,
                        elements: {
                            line: {
                                tension: 0.000001
                            }
                        },
                        plugins: {
                            filler: {
                                propagate: false
                            }
                        },
                        scales: {
                            xAxes: [{
                                ticks: {
                                    autoSkip: false
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    userCallback: function(label, index, labels) {
                                        // when the floored value is the same as the value we have a whole number
                                        if (Math.floor(label) === label) {
                                            return label;
                                        }

                                    },
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });

                return myChart;
            };

            const updateChart = function (chart, labels, values) {
                chart.data.labels = labels;
                chart.data.datasets[0].data = values;
                chart.update();
            }

            let theChart = initChart();

            $('#Chart{{ $id }} .interval-select').on('change', function() {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';

                axios
                    .get('{{ @route('ajax.chart') }}', { params: { type: '{{ $type }}', interval: $(this).val() } })
                    .then(response => {
                        updateChart(theChart, response.data.labels, response.data.values)
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });

            $('#Chart{{ $id }} .interval-select').trigger('change');
        });
    </script>
@endsection
