@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600">{{ __('Accommodations') }}</h6>
        <p class="mb-sm-0">{{ __('Search for accommodations using the search field or filter the list of resources using the options available') }}</p>
        <div class="card p-3 mt-4 shadow-sm">
            <form action="" class="">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="searchFilter">{{ __('Search') }}</label>
                        <div class="form-group mb-0">
                            <div class="input-group">
                                <input id="searchFilter" name="searchFilter" class="form-control" placeholder="{{ __('Search') }}" type="text" value="">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="accommodationType">{{ __('Accommodation Type') }}</label>
                            <select name="accommodationType" id="accommodationType" class="custom-select form-control">
                                <option value="" selected>{{ __('Select accommodation type') }}</option>
                                @foreach($types as $key => $value)
                                    <option value="{{ $key }}">{{ __($value) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="accommodationCountry">{{ __('Country') }}</label>
                            <select name="accommodationCountry" id="accommodationCountry" class="custom-select form-control">
                                <option value="" selected>{{ __('Select country') }}</option>
                                @foreach($countries as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="accommodationCity">{{ __('City') }}</label>
                            <select name="accommodationCity" id="accommodationCity" class="custom-select form-control">
                                <option value="" selected>{{ __('Select city') }}</option>
                                @foreach($cities as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="shadow-sm">
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
                        <th>{{ __('Accommodation Type') }}</th>
                        <th>{{ __('Owner') }}</th>
                        <th>{{ __('Country') }}</th>
                        <th>{{ __('City') }}</th>
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

    <!-- Confirmare stergere cazare -->
    <div class="modal fade bd-example-modal-sm" id="deleteAccommodationModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">{{ __('Delete accommodation') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this accommodation') }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-dismiss="modal" id="cancel">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-secondary" id="proceedDeleteAccommodation">{{ __('Yes') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        class AccommodationRenderer {
            constructor(ajaxUrl) {
                this.ajaxUrl = ajaxUrl;
            }

            renderAccommodations(pageState) {
                axios.get(this.ajaxUrl, {params: pageState})
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

                if (0 === count) {
                    $('.no-results').removeClass('d-none').addClass('d-flex');
                    $('.details').addClass('d-none');
                } else {
                    $('.no-results').removeClass('d-flex').addClass('d-none');
                    $('.details').removeClass('d-none');
                }
            }

            renderTable(responseData) {
                this.emptyTable();

                $.each(responseData, function(key, value) {
                    let row = '<tr id="accommodation-container-' + value.id + '">\n' +
                        '    <td><a href="/admin/accommodation/' + value.id + '">' + $.TranslateRequestStatus(value.type) + '</a></td>\n' +
                        '    <td>' + value.owner + '</td>\n' +
                        '    <td>' + value.country + '</td>\n' +
                        '    <td>' + value.city + '</td>\n' +
                        '    <td class="text-right">\n' +
                        '        <a href="#" class="btn btn-sm btn-danger mb-2 mb-sm-0 delete-accommodation" data-id=' + value.id + '>{{ __('Delete') }}</a>\n' +
                        '        <a href="/admin/accommodation/' + value.id + '" class="btn btn-sm btn-info mb-2 mb-sm-0">{{ __('Accommodation details') }}</a>\n' +
                        '    </td>\n' +
                        '</tr>';
                    $('#tableBody').append(row);
                });
            }

            renderPagination(response) {
                $('.pagination li').remove();

                if (1 === response.last_page) {
                    return;
                }

                let morePages = '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';

                let currentPage = '<li class="page-item active"><a class="page-link" data-page="' + response.current_page + '" href="#">' + response.current_page + ' <span class="sr-only">(current)</span></a></li>';

                let firstPage = '';
                if (response.current_page > 1) {
                    firstPage = '<li class="page-item"><a class="page-link" data-page="1" href="#">1</a></li>';
                }

                let step = response.current_page
                let counter = 0;

                let previousPages = '';
                while(step > 2 && 2 > counter) {
                    counter++;
                    step--;
                    previousPages = '<li class="page-item"><a class="page-link" data-page="' + step + '" href="#">' + step + '</a></li>' + previousPages;
                }

                if (response.current_page > 4) {
                    previousPages = morePages + previousPages;
                }

                step = response.current_page;
                counter = 0;

                let nextPages = '';
                while(step < response.last_page - 1 && 2 > counter) {
                    counter++;
                    step++;
                    nextPages += '<li class="page-item"><a class="page-link" data-page="' + step + '" href="#">' + step + '</a></li>';
                }

                if ((response.last_page - response.current_page) > 3) {
                    nextPages += morePages;
                }

                let lastPage = '';
                if (response.current_page < response.last_page) {
                    lastPage = '<li class="page-item"><a class="page-link" data-page="' + response.last_page + '" href="#">' + response.last_page + '</a></li>';
                }

                $('.pagination').append(firstPage).append(previousPages).append(currentPage).append(nextPages).append(lastPage);
            }
        }

        let selectCountry = function(country, selectedCity) {
            axios.get('/admin/ajax/accommodation/cities/' + country)
                .then(response => {
                    let citySelector = $('#accommodationCity');

                    citySelector.find("option").remove();
                    citySelector.append("<option value=\"\">{{ __('Select city') }}</option>");

                    response.data.cities.forEach(function(entry) {
                        citySelector.append("<option value=\"" + entry + "\">" + entry + "</option>")
                    });

                    citySelector.val(selectedCity);
                });
        }

        $(document).ready(function () {
            let pageState = {};
            pageState.page = 1;
            pageState.perPage = 15;
            pageState.type = null;
            pageState.country = null;
            pageState.city = null;

            let selectedAccommodation = null;

            if (undefined !== $.QueryString.type) {
                pageState.type = $.QueryString.type;
                $('#accommodationType').val(pageState.type);
            }

            if (undefined !== $.QueryString.city) {
                pageState.city = $.QueryString.city;
                $('#accommodationCity').val(pageState.city);
            }

            if (undefined !== $.QueryString.country) {
                pageState.country = $.QueryString.country;
                selectCountry(pageState.country, pageState.city);
                $('#accommodationCountry').val(pageState.country);
            }

            if (undefined !== $.QueryString.page) {
                pageState.page = $.QueryString.page;
            }

            if (undefined !== $.QueryString.perPage && -1 !== $.inArray($.QueryString.perPage, ["1", "15", "50", "100"])) {
                pageState.perPage = $.QueryString.perPage;
            }

            $('.resultsPerPage').val(pageState.perPage);

            let render = new AccommodationRenderer('{{ route('ajax.accommodation-list') }}');
            render.renderAccommodations(pageState);

            $('.resultsPerPage').on('change', function () {
                $('.resultsPerPage').val(this.value);
                pageState.perPage = this.value;
                $.SetQueryStringParameter('perPage', pageState.perPage);
                pageState.page = 1;
                $.SetQueryStringParameter('page', pageState.page);

                render.renderAccommodations(pageState);
            });

            $('body').on('click', 'a.page-link', function(event) {
                event.preventDefault();
                pageState.page = $(this).data('page');
                $.SetQueryStringParameter('page', pageState.page);
                render.renderAccommodations(pageState);
            });

            $('body').on('click', '.delete-accommodation', function(event) {
                event.preventDefault();
                selectedAccommodation = $(this).data('id');
                $('#deleteAccommodationModal').modal('show');
            });

            $('#proceedDeleteAccommodation').on('click', function() {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';

                axios
                .delete('/admin/ajax/accommodation/' + selectedAccommodation)
                .then(response => {
                    $('#accommodation-container-' + selectedAccommodation).remove();
                    $('#deleteAccommodationModal').modal('hide');
                })
                .catch(error => {
                    console.log(error);
                });
            });

            $('#accommodationType').on('change', function (event) {
                pageState.type = this.value;
                $.SetQueryStringParameter('type', pageState.type);
                render.renderAccommodations(pageState);
            });

            $('#accommodationCountry').on('change', function (event) {
                pageState.country = this.value;
                $.SetQueryStringParameter('country', pageState.country);
                render.renderAccommodations(pageState);

                selectCountry(pageState.country);
            });

            $('#accommodationCity').on('change', function (event) {
                pageState.city = this.value;
                $.SetQueryStringParameter('city', pageState.city);
                render.renderAccommodations(pageState);
            });
        });
    </script>
@endsection
