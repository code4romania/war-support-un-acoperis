@extends('layouts.admin')

@section('content')
    <section class="shadow-sm">
        <div class="container py-4">
            <div class="row align-items-end">
                <div class="col-sm-8">
                    <h4 class="font-weight-600">Cereri de ajutor</h4>
                    <p class="mb-sm-0">{{ __('Search for a help request using the search field or filter the list of requests using the present options.') }}</p>
                </div>
            </div>
            <form action="">
                <div class="row mt-5">
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
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="" for="approveStatus">Nivel aprobare</label>
                            <select name="approveStatus" id="approveStatus" class="custom-select form-control">
                                <option value="">Neaprobata</option>
                                <option value="">Aprobata partial</option>
                                <option value="">Total aprobata</option>
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
                <h6 class="font-weight-600 mb-0">Total rezultate: 142</h6>
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
                        <label for="" class="mr-3">rezultate pe pagina</label>
                        <select name="" id="" class="custom-select form-control form-control-sm">
                            <option value="15">15</option>
                            <option value="15">50</option>
                            <option value="15">100</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive shadow-sm mb-4">
            <table class="table table-striped w-100 mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Nr. cerere</th>
                        <th>Nume beneficiar</th>
                        <th>Diagnostic</th>
                        <th>Status cerere</th>
                        <th>Nivel aprobare</th>
                        <th>Data</th>
                        <th>Actiuni</th>
                        <th class="text-right"></th>
                    </tr>
                </thead>
                <tbody id="tableBody">
{{--                    <tr>--}}
{{--                        <td><a href="#">1</a></td>--}}
{{--                        <td>Ioana Petrescu</td>--}}
{{--                        <td>Cancer de col uterin</td>--}}
{{--                        <td>Noua</td>--}}
{{--                        <td>Neaprobat</td>--}}
{{--                        <td>23.10.2019</td>--}}
{{--                        <td class="td-actions">--}}
{{--                            <a href="#" class="btn btn-info btn-icon btn-sm" data-original-title="{{ __('Delete') }}" title="{{ __('Delete') }}">--}}
{{--                                {{ __('Delete') }}--}}
{{--                            </a>--}}
{{--                        </td>--}}
{{--                        <td class="text-right">--}}
{{--                            <a href="#" class="btn btn-info btn-icon btn-sm" data-original-title="{{ __('Details') }}" title="{{ __('Details') }}">--}}
{{--                                {{ __('See details') }}--}}
{{--                            </a>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                </tbody>
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
                        <label for="" class="mr-3">rezultate pe pagina</label>
                        <select name="" id="" class="custom-select form-control form-control-sm">
                            <option value="15">15</option>
                            <option value="15">50</option>
                            <option value="15">100</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            let render = new HelpRequestRenderer();

            render.renderHelpRequests(1);
        });

        class HelpRequestRenderer {
            renderHelpRequests(page, status, startDate, endDate) {

                // TODO: pass parameters to request
                axios.get('{{ route('ajax.help-requests') }}')
                    .then(res => {
                        this.renderPagination(res.data);
                        this.renderTable(res.data.data);
                    });
            }

            renderTable(responseData) {
                console.log('rendering table');

                $.each(responseData, function(key, value) {
                    let row = '<tr>\n' +
                        '    <td><a href="#">' + value.id + '</a></td>\n' +
                        '    <td>' + value.patient_full_name + '</td>\n' +
                        '    <td>' + value.diagnostic + '</td>\n' +
                        '    <td>Noua</td>\n' +
                        '    <td>Neaprobat</td>\n' +
                        '    <td>23.10.2019</td>\n' +
                        '    <td class="td-actions">\n' +
                        '        <a href="#" class="btn btn-info btn-icon btn-sm" data-original-title="{{ __('Delete') }}" title="{{ __('Delete') }}">\n' +
                        '            {{ __('Delete') }}\n' +
                        '        </a>\n' +
                        '    </td>\n' +
                        '    <td class="text-right">\n' +
                        '        <a href="#" class="btn btn-info btn-icon btn-sm" data-original-title="{{ __('Details') }}" title="{{ __('Details') }}">\n' +
                        '            {{ __('See details') }}\n' +
                        '        </a>\n' +
                        '    </td>\n' +
                        '</tr>';

                    $('#tableBody').after(row);
                });
            }

            renderPagination(response) {
                console.log('rendering pagination');
            }
        }
    </script>
@endsection
