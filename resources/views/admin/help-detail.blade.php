@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600">Cerere 001233 - Ioana Petrescu</h6>
    </section>
    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                Detalii Cerere
            </h6>
            <button class="btn btn-white btn-sm text-danger px-4">Delete</button>
        </div>
        <div class="card-body pt-4">
            <h4 class="font-weight-600 text-primary mb-5">Ioana Petrescu</h4>
            <div class="row">
                <div class="col-sm-5">
                    <ul class="details-wrapper list-unstyled mb-4">
                        <li class="d-flex align-items-start">
                            <i class="fa fa-map-marker"></i>
                            <span>
                            Locatie: <b>Romania, Bacau, Bacau</b>
                            </span>
                        </li>
                        <li class="d-flex">
                            <i class="fa fa-phone"></i>
                            <span>
                            Telefon: <b>0725659585</b>
                        </span>
                        </li>
                        <li class="d-flex">
                            <i class="fa fa-at"></i>
                            <span>
                            Email:  <a href="mailto:diana.soreanu@gmail.com" target="_blank">ioana.petrescu@gmail.com</a>
                        </span>
                        </li>
                    </ul>
                    <ul class="details-wrapper list-unstyled">
                        <li class="d-flex align-items-start">
                            <i class="fa fa-dot-circle-o"></i>
                            <span>
                            Responsabil: <b>Diana Sorescu</b>
                            </span>
                        </li>
                        <li class="d-flex">
                            <i class="fa fa-phone"></i>
                            <span>
                            Telefon responsabil: <b>0725659585</b>
                        </span>
                        </li>
                        <li class="d-flex">
                            <i class="fa fa-at"></i>
                            <span>
                            Email responsabil:  <a href="mailto:diana.soreanu@gmail.com" target="_blank">diana.soreanu@gmail.com</a>
                        </span>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <div class="kv">
                        <p>Data:</p>
                        <b>23.10.2015</b>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="">Status cerere:</label>
                        <select name="" id="" class="custom-select form-control">
                            <option value="noua">Noua</option>
                            <option value="aprobata">Aprobata</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="border-top border-bottom py-4 mt-4">
                <h6 class="font-weight-600">Diagnostic</h6>
                <p class="mb-0">Cancer de col uterin</p>
            </div>
            <div class="border-bottom py-4">
                <h6 class="font-weight-600">Alte informații:</h6>
                <p>Un text care să cuprindă evoluţia bolii de la diagnosticare până în prezent, simptome şi/sau alte detalii privind starea pacientului</p>
                <p class="mb-0">
                    <i>
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
                    </i>
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
            <div class="pt-4 pb-3 mt-3 clearfix">
                <button type="submit" id="submit-button-2" class="btn btn-secondary pull-right btn-lg px-6" data-toggle="modal" data-target=".bd-example-modal-lg">
                    <span class="btn-inner--icon mr-2"><i class="fa fa-comment"></i></span>
                    <span class="btn-inner--text">Adauga nota</span>
                </button>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="font-weight-600 text-primary mb-4">Date necesare pentru alocarea unui numar de SMS pentru strangerea de fonduri</h5>
            <div class="row">
                <div class="col-sm-5">
                    <div class="kv">
                        <p>Suma estimata necesara pentru tratament/interventie chirurgicala</p>
                        <b>25 000 EUR</b>
                    </div>
                    <div class="kv">
                        <p>Denumire clinica/spital unde este acceptat pacientul:</p>
                        <b>Centrul de Oncologie Robert Janker</b>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <div class="kv">
                                <p>Tara:</p>
                                <b>Spania</b>
                            </div>
                        </div>
                        <div class="col">
                            <div class="kv">
                                <p>Oras:</p>
                                <b>Madrid</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="kv">
                        <p>Destinatie fonduri stranse in campanie SMS (cont bancar)</p>
                        <b>RO49AAAA1B3100759384234B</b>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="">Nivel de aprobare:</label>
                        <select name="" id="" class="custom-select form-control bg-danger text-white font-weight-600">
                            <option value="noua">Neaprobata</option>
                            <option value="aprobata">Aprobata</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="font-weight-600 text-primary mb-4">Cerere pentru a gasi optiuni de cazare langa spital</h5>
            <div class="row">
                <div class="col-sm-5">
                    <div class="kv">
                        <p>La ce spital se află internat pacientul?</p>
                        <b>CHC - Clinica Sf. Joseph</b>
                    </div>
                    <div class="kv">
                        <p>
                            Începând cu ce dată ai nevoie de cazare?
                        </p>
                        <b>12.02.2020</b>
                    </div>
                    <div class="kv">
                        <p>Detaliază aici dacă ai nevoie de condiții speciale de cazare:</p>
                        <b>Nu este cazul</b>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="kv">
                        <p>Pentru câte persoane ai nevoie de cazare?</p>
                        <b>2</b>
                    </div>
                    <div class="kv">
                        <p>Până când ai nevoie de cazare?</p>
                        <b>25.02.2020</b>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="">Nivel de aprobare:</label>
                        <select name="" id="" class="custom-select form-control bg-danger text-white font-weight-600">
                            <option value="noua">Neaprobata</option>
                            <option value="aprobata">Aprobata</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup nota -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-600" id="exampleModalScrollableTitle">Adauga o nota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-4">Introduceti o nota explicativa pentru aceasta solicitare</p>
                    <textarea name="" id="mytextarea" cols="30" rows="20"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-gray-dark" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Adauga nota</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.tiny.cloud/1/bgsado4b682dgf10owt5ns07i6jh5vcf36tc06nntxc08asr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
@endsection
