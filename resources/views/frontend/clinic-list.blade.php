@extends('layouts.app')

@section('content')
    <div class="container py-sm-5 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="display-3 title mb-0 text-primary">{{ __('Clinic List') }}</h1>
    </div>
    <section class="bg-light-blue py-4">
        <div class="container">
            {{ __("Clinics list front description") }}
            <a href="{{ route('request-services') }}">{{ __("this form") }}</a>.
        </div>
    </section>
    <section class="shadow-sm">
        <div class="container py-4">
            <div class="row align-items-end">
                <div class="col-sm-8">
                    <h4 class="font-weight-600">{{ __("Clinics") }}</h4>
                    <p class="mb-sm-0">{{ __("Clinics subtitle") }}</p>
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
            <form action="">
                <div class="row mt-5">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="categoryFilter">{{ __('Speciality') }}</label>
                            <div id="categoryFilterButton">{{ __('Add') }}</div>
                            <div>
                                <select class="form-control" data-trigger name="categoryFilter[]" id="categoryFilter" placeholder="{{ __('All specialities') }}" multiple>
                                    @foreach($specialities as $speciality)
                                        @foreach($speciality->children as $child)
                                            <option value="{{ $child->id }}" {{ in_array($child->id, explode("|", request()->get('categories'))) ? 'selected' : '' }}>{{ $child->name }}</option>
                                        @endforeach
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
    <div class="container py-5">
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
                    <th>{{ __('Clinic name') }}</th>
                    <th>{{ __('Country') }}</th>
                    <th>{{ __('City') }}</th>
                    <th class="text-right"></th>
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
    </div>

    <!-- Popup afectiuni -->
    <div class="modal fade bd-example-modal-xl" tabindex="-1" id="selectSpeciality" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-600" id="exampleModalScrollableTitle">Selecteaza specialitatea de care esti interesat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <div class="row mb-4">
                       @foreach($specialities as $speciality)
                           <div class="col-sm-6 mb-4">
                               <h6 class="font-weight-600">{{ $speciality->name }}</h6>
                               <div>{!! $speciality->description !!}</div>
                               @foreach($speciality->children as $child)
                               <div class="custom-control custom-checkbox mb-3">
                                   <input class="custom-control-input customCheck" id="customCheck{{ $child->id }}" type="checkbox" value="{{ $child->id }}">
                                   <label class="custom-control-label" for="customCheck{{ $child->id }}">{{ $child->name }}</label>
                               </div>
                               @endforeach
                           </div>
                       @endforeach
                    </div>
                </div>
                <div class="modal-footer">
{{--                    <button type="button" class="btn btn-link text-gray-dark" data-dismiss="modal">Close</button>--}}
                    <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('Filter') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script type="text/javascript" src="{{ mix('js/table-data-renderer.js') }}"></script>
    <script type="text/javascript">
        class ClinicsFrontRenderer extends TableDataRenderer {
            constructor(ajaxUrl, detailsText, locale) {
                super(ajaxUrl);

                this.ajaxUrl = ajaxUrl;
                this.detailsText = detailsText;
                this.locale = locale;
            }

            renderTable(responseData) {
                this.emptyTable();
                const _this = this
                $.each(responseData, function(key, value) {
                    let row = '<tr id="clinic-container-' + value.id + '">\n' +
                        '    <td><a href="/' + _this.locale + '/clinics/' + value.slug + '">' + value.name + '</a></td>\n' +
                        '    <td>' + value.country + '</td>\n' +
                        '    <td>' + value.city + '</td>\n' +
                        '    <td class="text-right">\n' +
                        '        <a href="/' + _this.locale + '/clinics/' + value.slug + '" class="btn btn-sm btn-info mb-2 mb-sm-0">' + _this.detailsText + '</a>\n' +
                        '    </td>\n' +
                        '</tr>';
                    $('#tableBody').append(row);
                });
            }
        }

        $(document).ready(function () {
            let pageState = {};
            pageState.page = 1;
            pageState.perPage = 15;

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

            if (undefined !== $.QueryString.perPage && -1 !== $.inArray($.QueryString.perPage, ["1", "15", "50", "100"])) {
                pageState.perPage = $.QueryString.perPage;
            }

            $('.resultsPerPage').val(pageState.perPage);

            let renderer = new ClinicsFrontRenderer('{{ route('ajax.clinic-list') }}', '{{ __('See details') }}', '{{ $locale }}');
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

            var choices = new Choices('#categoryFilter', {
                search: false,
                delimiter: ',',
                editItems: false,
                removeItemButton: true,
                placeholder: true,
                placeholderValue: '{{ __('All specialities') }}'
            });

            $('.choices').on('click', function () {
                _this = this;
                delay(() => {
                    $('.customCheck').prop("checked", false);
                    choices.getValue().forEach(function(choice) {
                        $('#customCheck' + choice.value).prop( "checked", true );
                    })
                    $('.choices__list--dropdown').removeClass('is-active');
                    $('#selectSpeciality').modal('show');
                }, 10);
            });

            $('#categoryFilterButton').on('click', function () {
                $('.choices').click();
            });

            $('.customCheck').on('click', function () {
                const element = $(this);
                if (element.prop('checked')) {
                    choices.setChoiceByValue(element.val());
                } else {
                    choices.removeActiveItemsByValue(element.val());
                }
                console.table(choices.getValue());
                categoryFilter(choices.getValue().map(value => value.value).join("|"));
            })

            const categoryFilter = (selectedOptions) => {
                pageState.categories = selectedOptions;
                $.SetQueryStringParameter('categories', pageState.categories);
                renderer.renderData(pageState);
            }

            $( "#categoryFilter" ).change(function() {
                categoryFilter($(this).children("option:selected").map(function(){ return this.value }).get().join("|"));
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
                renderer.renderData(pageState);
            });

            $( "#cityFilter" ).change(function() {
                pageState.city = $(this).val();
                $.SetQueryStringParameter('city', pageState.city);
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
