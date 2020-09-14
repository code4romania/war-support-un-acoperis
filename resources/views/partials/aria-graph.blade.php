<div class="card shadow-sm">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="mb-0">
            Numarul de gazde inregistrate pe platforma
        </h6>
        <div class="actions text-sm-right w-50">
            <div class="form-group d-inline-block mr-2 mb-sm-0">
                <select name="" id="" class="custom-select form-control form-control-sm">
                    <option value="" selected>last days</option>
                    <option value="">last weeks</option>
                    <option value="">last years</option>
                </select>
            </div>
            <a href="" class="btn btn-sm btn-primary">Export Raport</a>
        </div>
    </div>
    <div class="card-body">
        <canvas id="myChart" width="100%"></canvas>
    </div>
</div>

@section('scripts')
    @parent
    <script type="text/javascript">

        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['label 1', 'label 2', 'label 3', 'label 4', 'label 5', 'label 1', 'label 2', 'label 3', 'label 4', 'label 5', 'label 1', 'label 2'],
                datasets: [{
                    data: [11, 3, 7, 1, 4, 15, 5, 11, 8, 12, 4, 8 ],
                    backgroundColor: [ 'rgba(40, 174, 228, .3)' ],
                    label: 'CEVA',
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
                            autoSkip: false,
                            maxRotation: 0
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: false
                }
            }
        });
    </script>
@endsection
