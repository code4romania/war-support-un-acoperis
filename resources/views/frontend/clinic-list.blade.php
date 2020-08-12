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
    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
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
                       <div class="col-sm-6">
                            <h6 class="font-weight-600">Oncologie</h6>
                            <p>Centre, clinici si spitale care trateaza cancerul renal, cancerul pulmonar, cancerul pancreatic, cancerul uterin, cancerul-ovarian, cancerul vezicii urinare, cancerul esofagian, cancerul colorectal, cancerul prostatei, cancerul hepatic,cancerul gastric, cancerul cutanat, sarcomul osos, sarcomul tesuturilor moi, tumorile sistemului nervos (retinoblastoame, neuroblastoame, tumori cerebrale, meduloblastoame).</p>
                           <div class="custom-control custom-checkbox mb-3">
                               <input class="custom-control-input" id="customCheck1" type="checkbox">
                               <label class="custom-control-label" for="customCheck1">Oncologie Adulți</label>
                           </div>
                           <div class="custom-control custom-checkbox mb-3">
                               <input class="custom-control-input" id="customCheck2" type="checkbox">
                               <label class="custom-control-label" for="customCheck2">Oncologie Pediatrie</label>
                           </div>
                       </div>
                       <div class="col-sm-6">
                           <h6 class="font-weight-600">Hematologie</h6>
                           <p>Centre, clinici si spitale care trateaza anemiile aplastice, leucemiile acute, leucemiile cronice, limfoamele maligne Hodgkin, limfoamele non-Hodgkin, mielomul multiplu si alte tipuri de afectiuni grave ale sangelui.</p>
                           <div class="custom-control custom-checkbox mb-3">
                               <input class="custom-control-input" id="customCheck1" type="checkbox">
                               <label class="custom-control-label" for="customCheck1">Hematologie Adulți</label>
                           </div>
                           <div class="custom-control custom-checkbox mb-3">
                               <input class="custom-control-input" id="customCheck2" type="checkbox">
                               <label class="custom-control-label" for="customCheck2">Hematologie Pediatrie</label>
                           </div>
                       </div>
                   </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="font-weight-600">Radiografie</h6>
                            <p>Centre, clinici si spitale care trateaza afectiunile oncologice si hematologice prin utilizarea radiatiilor ionizante in scop curativ, neoadjuvant, adjuvant, paliativ.</p>
                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="customCheck1" type="checkbox">
                                <label class="custom-control-label" for="customCheck1">Radioterapie Adulți</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="customCheck2" type="checkbox">
                                <label class="custom-control-label" for="customCheck2"> Radioterapie Pediatrie</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h6 class="font-weight-600">Transplant medular</h6>
                            <p>Centre, clinici si spitale care trateaza neoplaziile hematologice, bolile maligne ale ganglionilor limfatici si ale maduvei (mielom multiplu, limfom, leucemie) sau tumori solide, ca alternativa de tratament.</p>
                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="customCheck1" type="checkbox">
                                <label class="custom-control-label" for="customCheck1">Transplant Adulți</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="customCheck2" type="checkbox">
                                <label class="custom-control-label" for="customCheck2">Transplant Pediatrie</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-gray-dark" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Filtreaza</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script type="text/javascript" src="{{ mix('js/clinics-front-renderer.min.js') }}"></script>
    <script type="text/javascript">
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

            let render = new ClinicsFrontRenderer('{{ route('ajax.clinic-list') }}', '{{ __('See details') }}', '{{ $locale }}');
            render.renderHelpRequests(pageState);

            $('#searchFilter').on('keyup', e => {
                delay(() => {
                    let searchQuery = e.target.value;

                    if (searchQuery.length > 1 || searchQuery.length === 0) {
                        pageState.searchFilter = searchQuery;
                        $.SetQueryStringParameter('searchFilter', pageState.searchFilter);
                        render.renderHelpRequests(pageState);
                    }
                }, 500);
            });

            $('.resultsPerPage').on('change', function () {
                $('.resultsPerPage').val(this.value);
                pageState.perPage = this.value;
                $.SetQueryStringParameter('perPage', pageState.perPage);
                pageState.page = 1;
                $.SetQueryStringParameter('page', pageState.page);

                render.renderHelpRequests(pageState);
            });

            $('body').on('click', 'a.page-link', function(event) {
                event.preventDefault();
                pageState.page = $(this).data('page');
                $.SetQueryStringParameter('page', pageState.page);
                render.renderHelpRequests(pageState);
            });

            new Choices('#categoryFilter', {
                search: false,
                delimiter: ',',
                editItems: false,
                removeItemButton: true,
                placeholder: true,
                placeholderValue: '{{ __('All specialities') }}'
            });

            $( "#categoryFilter" ).change(function() {
                const selectedCategories = $(this).children("option:selected").map(function(){ return this.value }).get().join("|");
                pageState.categories = selectedCategories;
                $.SetQueryStringParameter('categories', pageState.categories);
                render.renderHelpRequests(pageState);
            });

            $( "#countryFilter" ).change(function() {
                pageState.country = $(this).val();
                $.SetQueryStringParameter('country', pageState.country);
                render.renderHelpRequests(pageState);
            });

            $( "#cityFilter" ).change(function() {
                pageState.city = $(this).val();
                $.SetQueryStringParameter('city', pageState.city);
                render.renderHelpRequests(pageState);
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
