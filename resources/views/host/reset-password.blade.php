@extends('layouts.admin')

@section('content')
    <section class="mb-5 d-flex align-items-center">
        <a href="{{ route('host.profile') }}" class="btn btn-sm btn-outline-primary mr-3">Inapoi</a>
        <h6 class="page-title mb-0 font-weight-600">Reset password</h6>
    </section>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                Date de logare in cont
            </h6>
        </div>
        <div class="card-body pt-4">
            <form action="">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="required font-weight-600">Parola curenta:</label>
                            <div class="pwd-container">
                                <input type="password" id="currentPwd" class="form-control" placeholder="Introdu parola curenta">
                                <i class="fa fa-eye" id="revealCurrentPass"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="required font-weight-600">Parola noua:</label>
                            <div class="pwd-container">
                                <input type="password" id="newPwd" class="form-control" placeholder="Introdu parola noua">
                                <i class="fa fa-eye" id="revealNewPass"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top pt-4 pb-3 mt-5 clearfix">
                    <button type="submit" id="submit-button-2" class="btn btn-secondary pull-right btn-lg px-6">
                        <span class="btn-inner--text">Salveaza</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

