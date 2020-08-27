@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600">Resurse ajutor</h6>
        <div class="row align-items-sm-center">
            <div class="col-sm-8">
                <p class="mb-sm-0">Caută resurse folosind câmpul de căutare sau filtrează lista resursele cu ajutorul opțiunilor prezente</p>
            </div>
            <div class="col-sm-4">
                <div class="form-group mb-0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                        <input id="searchFilter" name="searchFilter" class="form-control" placeholder="Search" type="text" value="{{ request()->get('searchFilter') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-3 mt-4 shadow-sm">
            <form action="" class="">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="" for="status">Tip ajutor</label>
                            <select name="statusFilter" id="statusFilter" class="custom-select form-control">
                                <option value="" selected>Tipul de ajutor</option>
                                @foreach ($resourceTypeList as $resourceType)
                                    <option value="{{ $resourceType->id }}"{{ request()->get('statusFilter') == $resourceType->id ? ' selected' : '' }}>{{ __('resource_types.' . $resourceType->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="countryFilter">{{ __('Country') }}</label>
                            <select name="countryFilter" id="countryFilter" class="custom-select form-control">
                                <option value="">{{ __('All countries') }}</option>
                                @foreach ($countryList as $country)
                                    <option value="{{ $country->id }}"{{ request()->get('country') == $country->id ? ' selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="" for="cityFilter">{{ __('City') }}</label>
                            <select name="cityFilter" id="cityFilter" class="custom-select form-control">
                                <option value="">{{ __('All cities') }}</option>
                                @foreach ($cityList as $city)
                                    <option value="{{ $city }}"{{ request()->get('city') == $city ? ' selected' : '' }}>{{ $city }}</option>
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
                    <th>Nume persoana implicata</th>
                    <th>Tip ajutor</th>
                    <th>{{ __('Country') }}</th>
                    <th>{{ __('City') }}</th>
                    <th>Data</th>
                    <th></th>
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

    <!-- Confirmare stergere clinica -->
    <div class="modal fade bd-example-modal-sm" id="deleteResourceModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">{{ __('Delete resource') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this resource') }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-dismiss="modal" id="cancel">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-secondary" id="proceedDeleteResource">{{ __('Yes') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('js/table-data-renderer.js') }}"></script>
    <script type="text/javascript">
        class ResourcesRenderer extends TableDataRenderer {
            constructor(ajaxUrl, deleteText, detailsText, typeTranslations) {
                super(ajaxUrl); // call parent constructor

                this.deleteText = deleteText;
                this.detailsText = detailsText;
                this.typeTranslations = typeTranslations;
            }

            renderTable(responseData) {
                this.emptyTable();
                const _this = this;
                $.each(responseData, function(key, value) {
                    let row = '<tr id="clinic-container-' + value.id + '">\n' +
                        '    <td><a href="/admin/resources/' + value.id + '">' + value.full_name + '</a></td>\n' +
                        '    <td>' + _this.typeTranslations[value.type] + '</td>\n' +
                        '    <td>' + value.country + '</td>\n' +
                        '    <td>' + value.city + '</td>\n' +
                        '    <td>' + moment(value.created_at).locale('ro').format('LLL') + '</td>\n' +
                        '    <td class="text-right">\n' +
                        '        <a href="#" class="btn btn-sm btn-danger mb-2 mb-sm-0 delete-resource" data-id=' + value.id + '>' + _this.deleteText + '</a>\n' +
                        '        <a href="/admin/resources/' + value.id + '" class="btn btn-sm btn-info mb-2 mb-sm-0">' + _this.detailsText + '</a>\n' +
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


            @if (request()->get('country'))
                pageState.country = '{{ request()->get('country') }}'
            @endif

            @if (request()->get('city'))
                pageState.city = '{{ request()->get('city') }}'
            @endif

            @if (request()->get('statusFilter'))
                pageState.statusFilter = '{{ request()->get('statusFilter') }}'
            @endif

            @if (request()->get('searchFilter'))
                pageState.searchFilter = '{{ request()->get('searchFilter') }}'
            @endif

            if (undefined !== $.QueryString.page) {
                pageState.page = $.QueryString.page;
            }

            if (undefined !== $.QueryString.perPage && -1 !== $.inArray($.QueryString.perPage, ["1", "3", "10", "25", "50"])) {
                pageState.perPage = $.QueryString.perPage;
            }

            if (undefined !== $.QueryString.startDate) {
                pageState.startDate = $.QueryString.startDate;
                $('#startDateFilter').val(pageState.startDate);
            }

            if (undefined !== $.QueryString.endDate) {
                pageState.endDate = $.QueryString.endDate;
                $('#endDateFilter').val(pageState.endDate);
            }

            $('.resultsPerPage').val(pageState.perPage);

            let renderer = new ResourcesRenderer('{{ route('ajax.resources') }}', '{{ __('Delete') }}', '{{ __('See details') }}', {!! $typeTranslations !!});
            renderer.renderData(pageState);

            $('#searchFilter').on('keyup', e => {
                delay(() => {
                    let searchQuery = e.target.value;

                    if (searchQuery.length > 1 || searchQuery.length === 0) {
                        pageState.searchFilter = searchQuery;
                        $.SetQueryStringParameter('searchFilter', pageState.searchFilter);
                        renderer.renderData(pageState);
                    }
                }, 500);
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

            let getCitiesByCountry = function () {
                let country = $("#countryFilter");
                let city = $("#cityFilter");
                let selectedCountry = country.val();
                let selectedCity = city.val();

                if (!selectedCountry.length) {
                    selectedCountry = 0;
                }

                let route = '{{ @route('ajax.resources-cities-by-country', [':::d-_-b:::']) }}';

                axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';
                axios
                    .get(route.replace(':::d-_-b:::', selectedCountry))
                    .then(response => {
                        city.find("option").remove();
                        city.append("<option value=\"\">{{ __('All cities') }}</option>")

                        response.data.cities.forEach(function(entry) {
                            city.append("<option value=\"" + entry + "\">" + entry + "</option>")
                        });

                        if (response.data.cities.indexOf(selectedCity) > -1) {
                            city.val(selectedCity);
                        }
                        pageState.city = city.val();
                        $.SetQueryStringParameter('city', pageState.city);
                        renderer.renderData(pageState);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }

            getCitiesByCountry();

            $( "#countryFilter" ).change(function() {
                getCitiesByCountry();
                pageState.country = $(this).val();
                $.SetQueryStringParameter('country', pageState.country);
                renderer.renderData(pageState);
            });

            $( "#cityFilter" ).change(function() {
                pageState.city = $(this).val();
                $.SetQueryStringParameter('city', pageState.city);
                renderer.renderData(pageState);
            });

            $( "#statusFilter" ).change(function() {
                pageState.statusFilter = $(this).val();
                $.SetQueryStringParameter('statusFilter', pageState.statusFilter);
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

            $('body').on('click', '.delete-resource', function() {
                deleteResourceId = $(this).data('id');
                $('#deleteResourceModal').modal('show');
            });

            $('#proceedDeleteResource').on('click', function() {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';

                axios
                    .delete('/admin/ajax/resources/' + deleteResourceId)
                    .then(response => {
                        $('#clinic-container-' + deleteResourceId).remove();
                        $('#deleteResourceModal').modal('hide');
                    })
                    .catch(error => {
                        console.log(error);
                    });
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
