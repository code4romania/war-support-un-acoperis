@extends('layouts.admin')

@section('content')
    <section class="mb-5 row">
        <div class="col-md-6">
            <h1 class="page-title font-weight-600 mb-0">{{ __('Users') }}</h1>
        </div>

        <div class="col-md-6 d-md-flex justify-content-end">
            <a class="btn btn-secondary m-2" href="{{ route('admin.host-add') }}">{{ __('Add host user') }}</a>
            @if (Auth::user()->isAdministrator())
                <a class="btn btn-secondary m-2"
                    href="{{ route('admin.trusted-user-add') }}">{{ __('Add trusted user') }}</a>
            @endif
            @if (Auth::user()->isAdministrator())
                <a class="btn btn-secondary m-2"
                    href="{{ route('admin.admin-user-add') }}">{{ __('Add admin user') }}</a>
            @endif
        </div>
    </section>

    <section class="mb-5">
        <p class="mb-sm-0">{{ __('Filter users') }}</p>
        <div class="card p-3 mt-4 shadow-sm">
            <form action="" class="">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="approvalStatus">{{ __('Status') }}</label>
                        <select name="approvalStatus" id="approvalStatus" class="custom-select form-control">
                            <option value="0" {{ $approvalStatus == 0 ? ' selected' : '' }}>{{ __('All') }}</option>
                            <option value="1" {{ $approvalStatus == 1 ? ' selected' : '' }}>{{ __('Approved') }}</option>
                            <option value="2" {{ $approvalStatus == 2 ? ' selected' : '' }}>{{ __('Disapproved') }}</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section>
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
                        <label class="mr-3">{{ __('Results per page') }}</label>
                        <select class="custom-select form-control form-control-sm resultsPerPage">
                            <option value="1">1</option>
                            <option value="15">15</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive  shadow-sm mb-4">
            <table class="table table-striped w-100 mb-0">
                <thead class="thead-dark">
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('User name') }}</th>
                    <th>{{ __('User email') }}</th>
                    <th>{{ __('Company name') }}</th>
                    <th>{{ __('City') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Created at') }}</th>
                    <th class="text-center">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody id="tableBody">
                </tbody>
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
                        <label for="" class="mr-3">{{ __('Results per page') }}</label>
                        <select name="" id="" class="custom-select form-control form-control-sm resultsPerPage">
                            <option value="1">1</option>
                            <option value="15">15</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
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
        class UserRenderer extends TableDataRenderer {
            renderTable(responseData) {
                this.emptyTable();

                let translations = {!! json_encode(\App\HelpRequest::statusList()) !!};
                $.each(responseData, function(key, value) {
                    let row = '<tr>\n' +
                        '    <td><a href="/admin/user/' + value.id + '">#' + value.id + '</a></td>\n' +
                        '    <td>' + value.name + '</td>\n' +
                        '    <td>' + value.email + '</td>\n' +
                        '    <td>' + value.company_name + '</td>\n' +
                        '    <td>' + value.city + '</td>\n' +
                        '    <td>' + value.status + '</td>\n' +
                        '    <td>' + moment(value.created_at).locale('ro').format('LLL') + '</td>\n' +
                        '    <td class="text-right">\n' +
                        '        <a href="/admin/user/' + value.id + '" class="btn btn-info btn-icon btn-sm" data-original-title="{{ __('Details') }}" title="{{ __('Details') }}">\n' +
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
            pageState.status = null;

            if (undefined !== $.QueryString.status) {
                pageState.status = $.QueryString.status;
            }

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

            let renderer = new UserRenderer('{{ route('ajax.user-list') }}');
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

            $('#approvalStatus').on('change', function (event) {
                pageState.status = this.value;
                $.SetQueryStringParameter('status', pageState.status);
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
