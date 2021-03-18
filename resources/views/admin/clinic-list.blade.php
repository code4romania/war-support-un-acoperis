@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600">{{ __('Clinic list') }}</h6>
        <div class="row align-items-sm-center">
            <div class="col-sm-8">
                <p class="mb-sm-0">{{ __('Clinic list description') }}</p>
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
            <form action="">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="categoryFilter">{{ __('Speciality') }}</label>
                            <div>
                                <select class="form-control" data-trigger name="categoryFilter[]" id="categoryFilter" placeholder="{{ __('All specialities') }}" multiple>

                                    @foreach($specialityList as $speciality)
                                        <option value="{{ $speciality->id }}" {{ in_array($speciality->id, explode("|", request()->get('categories'))) ? 'selected' : '' }}>{{ $speciality->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                    <th>{{ __('Clinic name') }}</th>
                    <th>{{ __('Country') }}</th>
                    <th colspan="2">{{ __('City') }}</th>
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

    <!-- Confirmare stergere clinica -->
    <div class="modal fade bd-example-modal-sm" id="deleteClinicModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">{{ __('Delete clinic') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this clinic') }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-dismiss="modal" id="cancel">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-secondary" id="proceedDeleteClinic">{{ __('Yes') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script type="text/javascript" src="{{ mix('js/table-data-renderer.js') }}"></script>
    <script type="text/javascript">
        class ClinicsRenderer extends TableDataRenderer {
            constructor(ajaxUrl, editText, deleteText, detailsText) {
                super(ajaxUrl); // call parent constructor

                this.editText = editText;
                this.deleteText = deleteText;
                this.detailsText = detailsText;
            }

            renderTable(responseData) {
                this.emptyTable();

                const _this = this
                $.each(responseData, function(key, value) {
                    let row = '<tr id="clinic-container-' + value.id + '">\n' +
                        '    <td><a href="/admin/clinic/' + value.id + '">' + value.name + '</a></td>\n' +
                        '    <td>' + value.country + '</td>\n' +
                        '    <td>' + value.city + '</td>\n' +
                        '    <td class="text-right">\n' +
                        '        <a href="/admin/clinic/edit/' + value.id + '" class="btn btn-secondary btn-icon btn-sm" data-original-title="' + _this.editText + '" title="' + _this.editText + '">\n' +
                        '            ' + _this.editText + '\n' +
                        '        </a>\n' +
                        '        <a href="#" class="btn btn-sm btn-danger mb-2 mb-sm-0 delete-clinic" data-id=' + value.id + '>' + _this.deleteText + '</a>\n' +
                        '        <a href="/admin/clinic/' + value.id + '" class="btn btn-sm btn-info mb-2 mb-sm-0">' + _this.detailsText + '</a>\n' +
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

            @if (request()->get('categories'))
            pageState.categories = '{{ request()->get('categories') }}'
            @endif

            @if (request()->get('country'))
                pageState.country = '{{ request()->get('country') }}'
            @endif

            @if (request()->get('city'))
                pageState.city = '{{ request()->get('city') }}'
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

            $('.resultsPerPage').val(pageState.perPage);

            let deleteClinicId = null;
            let renderer = new ClinicsRenderer('{{ route('ajax.clinic-list') }}', '{{ __('Edit') }}', '{{ __('Delete') }}', '{{ __('See details') }}');
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


            $( "#categoryFilter" ).change(function() {
                const selectedCategories = $(this).children("option:selected").map(function(){ return this.value }).get().join("|");
                pageState.categories = selectedCategories;
                $.SetQueryStringParameter('categories', pageState.categories);
                pageState.page = 1;
                $.SetQueryStringParameter('page', 1);
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

                let route = '{{ @route('ajax.clinics-cities-by-country', [':::d-_-b:::']) }}';

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
                pageState.page = 1;
                $.SetQueryStringParameter('page', 1);
                renderer.renderData(pageState);
            });

            $( "#cityFilter" ).change(function() {
                pageState.city = $(this).val();
                $.SetQueryStringParameter('city', pageState.city);
                pageState.page = 1;
                $.SetQueryStringParameter('page', 1);
                renderer.renderData(pageState);
            });

            new Choices('#categoryFilter', {
                search: false,
                delimiter: ',',
                editItems: false,
                removeItemButton: true,
                placeholder: true,
                placeholderValue: '{{ __('All specialities') }}'
            });

            $('body').on('click', '.delete-clinic', function() {
                deleteClinicId = $(this).data('id');
                $('#deleteClinicModal').modal('show');
            });

            $('#proceedDeleteClinic').on('click', function() {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';

                axios
                    .delete('/admin/ajax/clinic/' + deleteClinicId)
                    .then(response => {
                        $('#clinic-container-' + deleteClinicId).remove();
                        $('#deleteClinicModal').modal('hide');
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
