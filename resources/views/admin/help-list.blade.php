@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600">Cereri de ajutor</h6>
        <p class="mb-sm-0">{{ __('Search for a help request using the search field or filter the list of requests using the present options.') }}</p>
        <div class="card p-3 mt-4 shadow-sm">
            <form action="" class="">
                <div class="row">
                    <div class="col-sm-8">
                        <label for="search">{{ __('Search') }}</label>
                        <div class="form-group mb-0">
                            <div class="input-group">
                                <input id="search" name="search" class="form-control" placeholder="{{ __('Search') }}" type="text" value="">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="" for="status">Status</label>
                            <select name="status" id="status" class="custom-select form-control">
                                @foreach(\App\HelpRequest::statusList() as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <div class="row align-items-center mb-4">
        <div class="col">
            <h6 class="font-weight-600 mb-0">{{ __('Total Results') }}: <span id="totalResults"></span></h6>
        </div>
        <div class="col d-none d-sm-block">
            <nav aria-label="...">
                <ul class="pagination justify-content-center mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">
                            <i class="fa fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active">
                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="fa fa-angle-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col d-none d-sm-block">
            <div class="form-inline justify-content-end">
                <div class="form-group">
                    <label for="resultsPerPage" class="mr-3">{{ __('Results per page') }}</label>
                    <select name="resultsPerPage" class="custom-select form-control form-control-sm bg-white resultsPerPage">
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
                    <th>{{ __('Patient Name') }}</th>
                    <th>{{ __('Caretaker Name') }}</th>
                    <th>{{ __('Diagnostic') }}</th>
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
                <ul class="pagination justify-content-center mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">
                            <i class="fa fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active">
                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="fa fa-angle-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col">
            <div class="form-inline justify-content-center justify-content-sm-end">
                <div class="form-group">
                    <label for="resultsPerPage" class="mr-3">{{ __('Results per page') }}</label>
                    <select name="resultsPerPage" class="custom-select form-control form-control-sm bg-white resultsPerPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            let pageState = {};
            pageState.page = 1;
            pageState.perPage = 10;

            let render = new HelpRequestRenderer();
            render.renderHelpRequests(pageState);


            $('.resultsPerPage').on('change', function () {
                $('.resultsPerPage').val(this.value); // keep both selectors in sync

                pageState.perPage = this.value;
                render.renderHelpRequests(pageState);
            });
        });

        class HelpRequestRenderer {
            renderHelpRequests(pageState) {
                axios.get('{{ route('ajax.help-requests') }}', {params: pageState})
                    .then(res => {
                        this.updateResultsCount(res.data.total);
                        this.renderTable(res.data.data);
                        this.renderPagination(res.data);
                    });
            }

            emptyTable() {
                $('#tableBody tr').remove();
            }

            updateResultsCount(count) {
                $('#totalResults').text(count);
            }

            renderTable(responseData) {
                this.emptyTable();

                $.each(responseData, function(key, value) {
                    let row = '<tr>\n' +
                        '    <td><a href="/admin/help/' + value.id + '">#' + value.id + '</a></td>\n' +
                        '    <td>' + value.patient_full_name + '</td>\n' +
                        '    <td>' + value.caretaker_full_name + '</td>\n' +
                        '    <td>' + value.diagnostic + '</td>\n' +
                        '    <td>' + value.status + '</td>\n' +
                        '    <td>' + moment(value.created_at).lang('ro').format('LLL') + '</td>\n' +
                        '    <td class="text-right">\n' +
                        '        <a href="/admin/help/' + value.id + '" class="btn btn-info btn-icon btn-sm" data-original-title="{{ __('Details') }}" title="{{ __('Details') }}">\n' +
                        '            {{ __('See details') }}\n' +
                        '        </a>\n' +
                        '    </td>\n' +
                        '</tr>';

                    $('#tableBody').append(row);
                });
            }

            renderPagination(response) {
                console.log('rendering pagination');
            }
        }
    </script>
@endsection
