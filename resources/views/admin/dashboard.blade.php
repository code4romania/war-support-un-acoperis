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
            <div id="sidebar" class="sidebar-dash">
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
    <div class="mt-4 card">
        <div class="card-header">
            <h3>{{ __('Refugees Due Tomorrow') }}</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th>{{ __('Refugee name') }}</th>
                    <th>{{ __('Host') }}</th>
                    <th>{{ __('Accommodation') }}</th>
                    <th>{{ __('Guests number') }}</th>
                    <th>{{ __('Due date') }}</th>
                    <th>{{ __('To') }}</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                @forelse($refugeesDueTomorrow as $key => $refugeeDueTomorrow)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <a href="{{ route('admin.user-detail', $refugeeDueTomorrow->helpRequest->user->id) }}">{{ $refugeeDueTomorrow->helpRequest->user->name }}</a>
                        </td>
                        <td>
                            <a href="{{ route('admin.user-detail', $refugeeDueTomorrow->accomodation->user->id) }}">{{ $refugeeDueTomorrow->accomodation->user->name }}</a>
                        </td>
                        <td>{{ $refugeeDueTomorrow->accomodation->accommodationtype->name }}</td>
                        <td>{{ $refugeeDueTomorrow->number_of_guest }}</td>
                        <td>{{ $refugeeDueTomorrow->dueTomorrow }}</td>
                        <td>{{ \Carbon\Carbon::parse($refugeeDueTomorrow->end_date)->format('d m Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">There are no refugees due tomorrow.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $('#sidebar').stickySidebar({
                    containerSelector: '#main-content',
                    innerWrapperSelector: '.sidebar__inner',
                    topSpacing: 20,
                    bottomSpacing: 20
                });
            }, 300);

            $('.count').each(function () {
                $(this).prop('Counter', 0).animate({
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
                        backgroundColor: ['rgba(40, 174, 228, .3)'],
                        borderColor: ['rgb(40, 174, 228)'],
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
                                userCallback: function (label, index, labels) {
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
