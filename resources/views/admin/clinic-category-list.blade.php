@extends('layouts.admin')

@section('content')
    <section class=" mb-5">
        <h6 class="page-title font-weight-600">Clinic category list</h6>
    </section>
    <div class="card shadow-sm rounded">
        <div class="card-header rounded bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                Categorii
            </h6>
            <a href="{{ route('admin.clinic-category-add') }}" class="btn btn-success btn-sm text-white px-4">Adauga categorie</a>
        </div>
    </div>
    <div class="row row-cols-2">
        <div class="col-12 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-header border-bottom py-3">
                    <h5 class="font-weight-600 mb-0 text-admin-blue">Oncologie</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group custom-list-group mb-4">
                        <li class="list-group-item py-2 d-flex justify-content-between align-content-center">
                            <span>Oncologie Adulti</span>
                            <div class="actions">
                                <a href="#" class="btn btn-sm btn-link text-primary">Editeaza</a>
                                <a href="#" class="btn btn-sm btn-link text-danger">Sterge</a>
                            </div>
                        </li>
                        <li class="list-group-item py-2 d-flex justify-content-between align-content-center">
                            <span>Oncologie Pediatrie</span>
                            <div class="actions">
                                <a href="#" class="btn btn-sm btn-link text-primary">Editeaza</a>
                                <a href="#" class="btn btn-sm btn-link text-danger">Sterge</a>
                            </div>
                        </li>
                    </ul>
                    <p class="mb-0 smaller">
                        Centre, clinici si spitale care trateaza cancerul renal, cancerul pulmonar, cancerul pancreatic, cancerul uterin, cancerul-ovarian, cancerul vezicii urinare, cancerul esofagian, cancerul colorectal, cancerul prostatei, cancerul hepatic,cancerul gastric, cancerul cutanat, sarcomul osos, sarcomul tesuturilor moi, tumorile sistemului nervos (retinoblastoame, neuroblastoame, tumori cerebrale, meduloblastoame).
                    </p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-sm btn-outline-primary mb-2 mb-sm-0">Editeaza Categoria</a>
                    <a href="#" class="btn btn-sm btn-outline-danger mb-2 mb-sm-0">Sterge Categoria</a>
                    <a href="#" class="btn btn-sm btn-secondary mb-2 mb-sm-0">Adauga Subcategorie</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-header border-bottom py-3">
                    <h5 class="font-weight-600 mb-0 text-admin-blue">Hematologie</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group custom-list-group mb-4">
                        <li class="list-group-item py-2 d-flex justify-content-between align-content-center">
                            <span>Hematologie Adulti</span>
                            <div class="actions">
                                <a href="#" class="btn btn-sm btn-link text-primary">Editeaza</a>
                                <a href="#" class="btn btn-sm btn-link text-danger">Sterge</a>
                            </div>
                        </li>
                        <li class="list-group-item py-2 d-flex justify-content-between align-content-center">
                            <span>Hematologie Pediatrie</span>
                            <div class="actions">
                                <a href="#" class="btn btn-sm btn-link text-primary">Editeaza</a>
                                <a href="#" class="btn btn-sm btn-link text-danger">Sterge</a>
                            </div>
                        </li>
                    </ul>
                    <p class="mb-0 smaller">
                        Centre, clinici si spitale care trateaza anemiile aplastice, leucemiile acute, leucemiile cronice, limfoamele maligne Hodgkin, limfoamele non-Hodgkin, mielomul multiplu si alte tipuri de afectiuni grave ale sangelui.
                    </p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-sm btn-outline-primary mb-2 mb-sm-0">Editeaza Categoria</a>
                    <a href="#" class="btn btn-sm btn-outline-danger mb-2 mb-sm-0">Sterge Categoria</a>
                    <a href="#" class="btn btn-sm btn-secondary mb-0 mb-sm-0">Adauga Subcategorie</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-header border-bottom py-3">
                    <h5 class="font-weight-600 mb-0 text-admin-blue">Oncologie</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group custom-list-group mb-4">
                        <li class="list-group-item py-2 d-flex justify-content-between align-content-center">
                            <span>Oncologie Adulti</span>
                            <div class="actions">
                                <a href="#" class="btn btn-sm btn-link text-primary">Editeaza</a>
                                <a href="#" class="btn btn-sm btn-link text-danger">Sterge</a>
                            </div>
                        </li>
                        <li class="list-group-item py-2 d-flex justify-content-between align-content-center">
                            <span>Oncologie Pediatrie</span>
                            <div class="actions">
                                <a href="#" class="btn btn-sm btn-link text-primary">Editeaza</a>
                                <a href="#" class="btn btn-sm btn-link text-danger">Sterge</a>
                            </div>
                        </li>
                    </ul>
                    <p class="mb-0 smaller">
                        Centre, clinici si spitale care trateaza cancerul renal, cancerul pulmonar, cancerul pancreatic, cancerul uterin, cancerul-ovarian, cancerul vezicii urinare, cancerul esofagian, cancerul colorectal, cancerul prostatei, cancerul hepatic,cancerul gastric, cancerul cutanat, sarcomul osos, sarcomul tesuturilor moi, tumorile sistemului nervos (retinoblastoame, neuroblastoame, tumori cerebrale, meduloblastoame).
                    </p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-sm btn-outline-primary mb-2 mb-sm-0">Editeaza Categoria</a>
                    <a href="#" class="btn btn-sm btn-outline-danger mb-2 mb-sm-0">Sterge Categoria</a>
                    <a href="#" class="btn btn-sm btn-secondary mb-0 mb-sm-0">Adauga Subcategorie</a>
                </div>
            </div>
        </div>
    </div>
@endsection
