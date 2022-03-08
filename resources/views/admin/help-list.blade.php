@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600">Cereri de ajutor</h6>
        <p class="mb-sm-0">{{ __('Search for a help request using the search field or filter the list of requests using the present options.') }}</p>
        <div class="card p-3 mt-4 shadow-sm">
            <form action="" class="">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="searchFilter">{{ __('Search') }}</label>
                        <div class="form-group mb-0">
                            <div class="input-group">
                                <input id="searchFilter" name="searchFilter" class="form-control" placeholder="{{ __('Search') }}" type="text" value="{{ request()->get('searchFilter') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="" for="status">Status</label>
                            <select name="statusFilter" id="statusFilter" class="custom-select form-control">
                                    <option value="" selected>{{ __('All statuses') }}</option>
                                @foreach(\App\HelpRequest::statusList() as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="" for="startDateFilter">{{ __('Starting with') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="flatpickr flatpickr-input form-control" type="text" placeholder="2020-08-01" id="startDateFilter" name="startDateFilter" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="" for="endDateFilter">{{ __('Until') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="flatpickr flatpickr-input form-control" type="text" placeholder="2020-08-31" id="endDateFilter" name="endDateFilter" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="details">
        <div class="row align-items-center mb-4">
            <div class="col">
                <h6 class="font-weight-600 mb-0">{{ __('Total Results') }}: <span id="totalResults"></span></h6>
            </div>
            <div class="col d-none d-sm-block">
                <nav aria-label="...">
                    <ul class="pagination justify-content-center mb-0"></ul>
                </nav>
            </div>
            <div class="col d-none d-sm-block">
                <div class="form-inline justify-content-end">
                    <div class="form-group">
                        <label for="resultsPerPage" class="mr-3">{{ __('Results per page') }}</label>
                        <select name="resultsPerPage" class="custom-select form-control form-control-sm bg-white resultsPerPage">
                            <option value="1">1</option>
                            <option value="3">3</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive shadow-sm mb-4 bg-white">
            <table class="table table-striped w-100 mb-0">
                <thead class="thead-dark">
                <tr>
                    <th>{{ __('Request ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Special Needs') }}</th>
                    <th>{{ __('People') }}</th>
                    <th>{{ __('Transport') }}</th>
                    <th>{{ __('Request Status') }}</th>
                    <th>{{ __('Request Date') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>
        <div class="row align-items-center mb-4 flex-column flex-sm-row text-center text-sm-left">
            <div class="col offset-sm-4 mb-4 mb-sm-0">
                <nav aria-label="...">
                    <ul class="pagination justify-content-center mb-0"></ul>
                </nav>
            </div>
            <div class="col">
                <div class="form-inline justify-content-center justify-content-sm-end">
                    <div class="form-group">
                        <label for="resultsPerPage" class="mr-3">{{ __('Results per page') }}</label>
                        <select name="resultsPerPage" class="custom-select form-control form-control-sm bg-white resultsPerPage">
                            <option value="1">1</option>
                            <option value="3">3</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="no-results d-none align-content-center mb-4">
        <img src="/images/no-results.svg" height="120" alt="" class="mr-4"/>
        <div class="no-results-description align-self-center">
            <h4 class="font-weight-600 mb-1">{{ __('No results found') }}</h4>
            <p class="mb-0 text-muted">{{ __('Try clearing some filters or perform another search.') }}</p>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('js/table-data-renderer.js') }}"></script>
    <script>
        class HelpRequestRenderer extends TableDataRenderer {
            renderTable(responseData) {
                this.emptyTable();

                let translations = {!! json_encode(\App\HelpRequest::statusList()) !!};
                $.each(responseData, function(key, value) {
                    let transportType = value.need_special_transport ? '{{ __('Special transport') }}' : value.need_car ? '{{ __('Car') }}' : '{{ __('Not Needed') }}';
                    let specialNeeds =  value.special_needs ? '{{ __('Yes') }}' : '{{ __('No') }}';
                    let row = '<tr>\n' +
                        '    <td><a href="/{{ $area }}/help-request/' + value.id + '">#' + value.id + '</a></td>\n' +
                        '    <td>' + value.name + '</td>\n' +
                        '    <td>' + specialNeeds + '</td>\n' +
                        '    <td>' + value.guests_number + '</td>\n' +
                        '    <td>' + transportType + '</td>\n' +
                        '    <td>' + translations[value.status] + '</td>\n' +
                        '    <td>' + moment(value.created_at).locale('ro').format('LLL') + '</td>\n' +
                        '    <td class="text-right">\n' +
                        '        <a href="/{{ $area }}/help-request/' + value.id + '" class="btn btn-info btn-icon btn-sm" data-original-title="{{ __('Details') }}" title="{{ __('Details') }}">\n' +
                        '            {{ __('See details') }}\n' +
                        '        </a>\n' +
                        '    </td>\n' +
                        '</tr>';

                    $('#tableBody').append(row);
                });
            }
        }

        $(document).ready(function () {
            let pageState = {};
            pageState.page = 1;
            pageState.perPage = 10;

            if (undefined !== $.QueryString.searchFilter) {
                pageState.searchFilter = $.QueryString.searchFilter;
            }

            if (undefined !== $.QueryString.page) {
                pageState.page = $.QueryString.page;
            }

            if (undefined !== $.QueryString.perPage && -1 !== $.inArray($.QueryString.perPage, ["1", "3", "10", "25", "50"])) {
                pageState.perPage = $.QueryString.perPage;
            }

            $('.resultsPerPage').val(pageState.perPage);

            if (undefined !== $.QueryString.status) {
                pageState.status = $.QueryString.status;
                $('#statusFilter').val(pageState.status);
            }

            if (undefined !== $.QueryString.startDate) {
                pageState.startDate = $.QueryString.startDate;
                $('#startDateFilter').val(pageState.startDate);
            }

            if (undefined !== $.QueryString.endDate) {
                pageState.endDate = $.QueryString.endDate;
                $('#endDateFilter').val(pageState.endDate);
            }

            let renderer = new HelpRequestRenderer('{{ auth()->user()->isTrusted() ? route('share.ajax.help-requests') : route('ajax.help-requests') }}');
            renderer.renderData(pageState);

            $('#searchFilter').on('keyup', e => {
                delay(() => {
                    let searchQuery = e.target.value;

                    if (searchQuery.length > 1 || searchQuery.length === 0) {
                        pageState.searchFilter = searchQuery;
                        $.SetQueryStringParameter('query', pageState.searchFilter);
                        renderer.renderData(pageState);
                    }
                }, 500);
            });

            $('#statusFilter').on('change', function () {
                pageState.status = this.value;
                $.SetQueryStringParameter('status', pageState.status);
                renderer.renderData(pageState);
            });

            $('#startDateFilter').on('change', function() {
                pageState.startDate = $('#startDateFilter').val();
                $.SetQueryStringParameter('startDate', pageState.startDate);
                renderer.renderData(pageState);
            });

            $('#endDateFilter').on('change', function() {
                pageState.endDate = $('#endDateFilter').val();
                $.SetQueryStringParameter('endDate', pageState.endDate);
                renderer.renderData(pageState);
            });

            $('.resultsPerPage').on('change', function () {
                $('.resultsPerPage').val(this.value);
                pageState.perPage = this.value;
                $.SetQueryStringParameter('perPage', pageState.perPage);
                pageState.page = 1;
                $.SetQueryStringParameter('page', pageState.page);

                renderer.renderData(pageState);
            });

            $('body').on('click', 'a.page-link', function(event) {
                event.preventDefault();
                pageState.page = $(this).data('page');
                $.SetQueryStringParameter('page', pageState.page);
                renderer.renderData(pageState);
            });
        });

        let delay = (function(){
            let timer = 0;
            return function(callback, ms){
                clearTimeout (timer);
                timer = setTimeout(callback, ms);
            };
        })();
    </script>
@endsection
