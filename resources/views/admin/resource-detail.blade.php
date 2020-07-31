@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title mb-3 font-weight-600">Resurse ajutor</h6>
        <a href="{{ route('admin.resource-list') }}" class="btn btn-sm btn-outline-primary mr-3">Inapoi</a>
    </section>
    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
               Ajutor transport - Dan Vintu
            </h6>
            <a class="btn btn-white text-danger btn-sm px-4" href="#">Delete</a>
        </div>
        <div class="card-body">
            <h5 class="text-primary font-weight-600 mb-4">
                Dan Vintu
            </h5>
            <div class="row  pb-3">
                <div class="col-sm">
                    <p class="mb-0">
                        <i class="fa fa-map-marker mr-2"></i> Locatie: <span class="font-weight-600">Bucuresti, Romania</span>
                    </p>
                </div>
                <div class="col-sm">
                    <p class="mb-0">
                        <i class="fa fa-phone mr-2"></i> Telefon: <span class="font-weight-600">0762 560 816</span>
                    </p>
                </div>
                <div class="col-sm">
                    <p class="mb-0">
                        <i class="fa fa-envelope mr-2"></i> Email: <a href="mailto:dan.vintu@gmail.com" class="font-weight-600">dan.vintu@gmail.com</a>
                    </p>
                </div>
                <div class="col-sm">
                    <p class="mb-0 text-sm-right">
                        <i class="fa fa-calendar mr-2"></i> Data: <span class="font-weight-600">23.10 2015</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <h5 class="text-primary font-weight-600 mb-4">
                Ajutor
            </h5>
            <div class="kv border-bottom pb-4 mb-0">
                <p>Tip de ajutor oferit</p>
                <b>Transport</b>
            </div>
            <div class="border-bottom py-4">
                <h6 class="font-weight-600 mb-3">Note</h6>
                <div class="note p-3">
                    <div class="row align-items-sm-center">
                        <div class="col-sm-9 mb-4 mb-sm-0">
                            <p class="mb-1">Acest beneficiar nu ne-a mai cerut ajutor in trecut</p>
                            <div class="meta">
                                <span>Added by <b>Grigore Minulescu</b></span>
                                <span class="text-dot-left">12 Jun, 2020 - 13:43 PM</span>
                            </div>
                        </div>
                        <div class="col-sm-3 text-sm-right">
                            <button class="btn btn-sm btn-info">Editeaza</button>
                            <button class="btn btn-sm btn-danger">Sterge</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-3 pb-3 mt-3 clearfix">
                <button type="submit" id="submit-button-2" class="btn btn-secondary pull-right btn-lg px-6" data-toggle="modal" data-target=".bd-example-modal-lg">
                    <span class="btn-inner--icon mr-2"><i class="fa fa-comment"></i></span>
                    <span class="btn-inner--text">{{ __('Add note') }}</span>
                </button>
            </div>
        </div>
    </div>
@endsection
