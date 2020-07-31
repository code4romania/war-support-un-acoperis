@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600">Resurse ajutor</h6>
        <p class="mb-sm-0">Caută resurse folosind câmpul de căutare sau filtrează lista resursele cu ajutorul opțiunilor prezente</p>
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
                            <label class="" for="status">Tip ajutor</label>
                            <select name="statusFilter" id="statusFilter" class="custom-select form-control">
                                <option value="" selected>Tipul de ajutor</option>
                                <option value="">Cazare</option>
                                <option value="">Transport</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="" for="status">Oras</label>
                            <select name="statusFilter" id="statusFilter" class="custom-select form-control">
                                <option value="" selected>Selecteaza oras</option>
                                <option value="">Oradea</option>
                                <option value="">Baia Mare</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="" for="endDateFilter">Data</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="flatpickr flatpickr-input form-control" type="text" placeholder="Selecteaza Data" id="endDateFilter" name="endDateFilter" />
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
                    <th>Localitate</th>
                    <th>Data</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody id="tableBody">
                    <tr>
                        <td>
                            <a href="">
                                Dan Vintu
                            </a>
                        </td>
                        <td>Transport</td>
                        <td>Bacau</td>
                        <td>23.10.2015</td>
                        <td>
                            <a href="" class="btn btn-sm btn-danger">{{ __('Delete') }}</a>
                            <a href="{{ route('admin.resource-detail') }}" class="btn btn-sm btn-info">{{ __('See details') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="">
                                Dan Vintu
                            </a>
                        </td>
                        <td>Cazare</td>
                        <td>Bacau</td>
                        <td>23.10.2015</td>
                        <td>
                            <a href="" class="btn btn-sm btn-danger">{{ __('Delete') }}</a>
                            <a href="{{ route('admin.accommodation-detail') }}" class="btn btn-sm btn-info">{{ __('See details') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="">
                                Dan Vintu
                            </a>
                        </td>
                        <td>Cazare</td>
                        <td>Bacau</td>
                        <td>23.10.2015</td>
                        <td>
                            <a href="" class="btn btn-sm btn-danger">{{ __('Delete') }}</a>
                            <a href="{{ route('admin.accommodation-detail') }}" class="btn btn-sm btn-info">{{ __('See details') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="">
                                Dan Vintu
                            </a>
                        </td>
                        <td>Cazare</td>
                        <td>Bacau</td>
                        <td>23.10.2015</td>
                        <td>
                            <a href="" class="btn btn-sm btn-danger">{{ __('Delete') }}</a>
                            <a href="{{ route('admin.accommodation-detail') }}" class="btn btn-sm btn-info">{{ __('See details') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="">
                                Dan Vintu
                            </a>
                        </td>
                        <td>Cazare</td>
                        <td>Bacau</td>
                        <td>23.10.2015</td>
                        <td>
                            <a href="" class="btn btn-sm btn-danger">{{ __('Delete') }}</a>
                            <a href="{{ route('admin.accommodation-detail') }}" class="btn btn-sm btn-info">{{ __('See details') }}</a>
                        </td>
                    </tr>
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
@endsection
