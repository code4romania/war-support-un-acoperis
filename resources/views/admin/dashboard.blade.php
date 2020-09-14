@extends('layouts.admin')

@section('content')
    <section class="">
        <h6 class="page-title font-weight-600">Dashboard</h6>
    </section>

    <div class="row" id="main-content">
        <div id="content" class="col-sm-9">
            @include('partials.aria-graph')

            <div class="card shadow-sm">
                <div class="card-header d-sm-flex align-items-center justify-content-between">
                    <h6 class="mb-0">
                        Numar solicitari de ajutor inregistrate pe platforma
                    </h6>
                    <div class="actions text-sm-right w-50">
                        <div class="form-group d-inline-block mr-2 mb-sm-0">
                            <select name="" id="" class="custom-select form-control form-control-sm">
                                <option value="" selected>12 luni</option>
                                <option value="">1 an</option>
                                <option value="">1 deceniu</option>
                            </select>
                        </div>
                        <a href="" class="btn btn-sm btn-primary">Export Raport</a>
                    </div>
                </div>
                <div class="card-body">
                    <img src="/images/graph.png" alt="" class="img-fluid">
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header d-sm-flex align-items-center justify-content-between">
                    <h6 class="mb-0">
                        Numarul de persoane care au beneficiat de cazare
                    </h6>
                    <div class="actions text-sm-right w-50">
                        <div class="form-group d-inline-block mr-2 mb-sm-0">
                            <select name="" id="" class="custom-select form-control form-control-sm">
                                <option value="" selected>12 luni</option>
                                <option value="">1 an</option>
                                <option value="">1 deceniu</option>
                            </select>
                        </div>
                        <a href="" class="btn btn-sm btn-primary">Export Raport</a>
                    </div>
                </div>
                <div class="card-body">
                    <img src="/images/graph.png" alt="" class="img-fluid">
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header d-sm-flex align-items-center justify-content-between">
                    <h6 class="mb-0">
                        Numarul de persoane care au beneficiat de consultanta strangere fonduri
                    </h6>
                    <div class="actions text-sm-right w-50">
                        <div class="form-group d-inline-block mr-2 mb-sm-0">
                            <select name="" id="" class="custom-select form-control form-control-sm">
                                <option value="" selected>12 luni</option>
                                <option value="">1 an</option>
                                <option value="">1 deceniu</option>
                            </select>
                        </div>
                        <a href="" class="btn btn-sm btn-primary">Export Raport</a>
                    </div>
                </div>
                <div class="card-body">
                    <img src="/images/graph.png" alt="" class="img-fluid">
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header d-sm-flex align-items-center justify-content-between">
                    <h6 class="mb-0">
                        Numarul de persoane care au beneficiat de informare si indrumare medicala
                    </h6>
                    <div class="actions text-sm-right w-50">
                        <div class="form-group d-inline-block mr-2 mb-sm-0">
                            <select name="" id="" class="custom-select form-control form-control-sm">
                                <option value="" selected>12 luni</option>
                                <option value="">1 an</option>
                                <option value="">1 deceniu</option>
                            </select>
                        </div>
                        <a href="" class="btn btn-sm btn-primary">Export Raport</a>
                    </div>
                </div>
                <div class="card-body">
                    <img src="/images/graph.png" alt="" class="img-fluid">
                </div>
            </div>

            <div class="card shadow-sm mb-0">
                <div class="card-header d-sm-flex align-items-center justify-content-between">
                    <h6 class="mb-0">
                        Numarul de persoane care au beneficiat de alte servicii
                    </h6>
                    <div class="actions text-sm-right w-50">
                        <div class="form-group d-inline-block mr-2 mb-sm-0">
                            <select name="" id="" class="custom-select form-control form-control-sm">
                                <option value="" selected>12 luni</option>
                                <option value="">1 an</option>
                                <option value="">1 deceniu</option>
                            </select>
                        </div>
                        <a href="" class="btn btn-sm btn-primary">Export Raport</a>
                    </div>
                </div>
                <div class="card-body">
                    <img src="/images/graph.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div id="sidebar" class="sidebar-dash" >
                <div class="sidebar__inner">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h1 class="text-primary font-weight-600">
                                <span class="count">56</span>
                                <i class="ni ni-badge"></i>
                            </h1>
                            <small class="text-muted">Numar total gazde</small>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h1 class="text-primary font-weight-600">
                                <span class="count">344</span>
                                <i class="ni ni-archive-2"></i>
                            </h1>
                            <small class="text-muted">Numar total solicitari</small>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h1 class="text-primary font-weight-600">
                                <span class="count">87</span>
                                <i class="ni ni-single-02"></i>
                            </h1>
                            <small class="text-muted">Numar total beneficiari de cazare</small>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h1 class="text-primary font-weight-600">
                                <span class="count">422</span>
                                <i class="ni ni-single-02"></i>
                            </h1>
                            <small class="text-muted">Numar total beneficiari de consultanta strangere fonduri</small>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h1 class="text-primary font-weight-600">
                                <span class="count">322</span>
                                <i class="ni ni-single-02"></i>
                            </h1>
                            <small class="text-muted">Numar total beneficiari de informare si indrumare medicala</small>
                        </div>
                    </div>
                    <div class="card shadow-sm mb-0">
                        <div class="card-body">
                            <h1 class="text-primary font-weight-600">
                                <span class="count">124</span>
                                <i class="ni ni-single-02"></i>
                            </h1>
                            <small class="text-muted">Numar total beneficiari de alte servicii</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#sidebar').stickySidebar({
                containerSelector: '#main-content',
                innerWrapperSelector: '.sidebar__inner',
                topSpacing: 20,
                bottomSpacing: 20
            });

            $('.count').each(function () {
                $(this).prop('Counter',0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            })
        });
    </script>
@endsection
