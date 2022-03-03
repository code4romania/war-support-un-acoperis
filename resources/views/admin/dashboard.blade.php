@extends('layouts.admin')

@section('content')
    <section class="">
        <h6 class="page-title font-weight-600">Dashboard</h6>
    </section>

    <div class="row" id="main-content">
        <div id="content" class="col-sm-9">
            @include('partials.aria-graph', ['id' => 1, 'type' => 'registredHosts', 'title' => 'Numarul de gazde inregistrate pe platforma'])
            @include('partials.aria-graph', ['id' => 2, 'type' => 'registredHelpRequest', 'title' => 'Numar solicitari de ajutor inregistrate pe platforma'])
            @include('partials.aria-graph', ['id' => 3, 'type' => 'accomodationsApproved', 'title' => 'Numarul de persoane care au beneficiat de cazare'])
        </div>
        <div class="col-sm-3">
            <div id="sidebar" class="sidebar-dash" >
                <div class="sidebar__inner">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h1 class="text-primary font-weight-600">
                                <span class="count">{{ $dashboardStats["hostsNumber"] }}</span>
                                <i class="ni ni-badge"></i>
                            </h1>
                            <small class="text-muted">{{ __('Accommodations number') }}</small>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h1 class="text-primary font-weight-600">
                                <span class="count">{{ $dashboardStats["requestsNumber"] }}</span>
                                <i class="ni ni-archive-2"></i>
                            </h1>
                            <small class="text-muted">{{ __('Help requests number') }}</small>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h1 class="text-primary font-weight-600">
                                <span class="count">{{ $dashboardStats["allocatedNumber"] }}</span>
                                <i class="ni ni-single-02"></i>
                            </h1>
                            <small class="text-muted">{{ __('Solved requests number') }}</small>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h1 class="text-primary font-weight-600">
                                <span class="count">{{ $dashboardStats["approvedAccommodations"] }}</span>
                                <i class="ni ni-single-02"></i>
                            </h1>
                            <small class="text-muted">{{ __('Verified hosts') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            setTimeout(function(){
                $('#sidebar').stickySidebar({
                    containerSelector: '#main-content',
                    innerWrapperSelector: '.sidebar__inner',
                    topSpacing: 20,
                    bottomSpacing: 20
                });
            }, 300);

            $('.count').each(function () {
                $(this).prop('Counter',0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            })
        });

        const initChart = function (id) {
            var ctx = $('#Chart' + id + ' #myChart');
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
        };
    </script>
@endsection
