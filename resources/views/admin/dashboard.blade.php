@extends('layouts.admin')

@section('content')
    <section class="">
        <h6 class="page-title font-weight-600">Dashboard</h6>
    </section>

    <div class="row" id="main-content">
        <div id="content" class="col-sm-9">
            @include('partials.aria-graph', ['id' => 1, 'type' => 'registredHosts', 'title' => 'Numarul de gazde inregistrate pe platforma'])
            @include('partials.aria-graph', ['id' => 2, 'type' => 'registredHelpRequest', 'title' => 'Numar solicitari de ajutor inregistrate pe platforma'])
            @include('partials.aria-graph', ['id' => 3, 'type' => 'accomodationsApproved', 'title' => 'Numarul de persoane care au beneficiat de cazare'])
            @include('partials.aria-graph', ['id' => 4, 'type' => 'fundRaisingApproved', 'title' => 'Numarul de persoane care au beneficiat de consultanta strangere fonduri'])
            @include('partials.aria-graph', ['id' => 5, 'type' => 'infosApproved', 'title' => 'Numarul de persoane care au beneficiat de informare si indrumare medicala'])
            @include('partials.aria-graph', ['id' => 6, 'type' => 'othersApproved', 'title' => 'Numarul de persoane care au beneficiat de alte servicii', 'last' => true])
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
