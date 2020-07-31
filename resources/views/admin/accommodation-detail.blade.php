@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title mb-3 font-weight-600">Resurse cazare</h6>
        <a href="{{ route('admin.resource-list') }}" class="btn btn-sm btn-outline-primary mr-3">Inapoi</a>
    </section>
    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                Ajutor Cazare - Dan Vintu
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
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                Cazare
            </h6>
        </div>
        <div class="card-body pt-4">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="font-weight-600 text-primary mb-4">Detalii gazduire</h5>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">Tip de cazare</h6>
                        <p>Garsoniera</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">Regimul proprietatii</h6>
                        <p>Proprietate personala</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">Regimul de cazare</h6>
                        <p>Cazare integral pentru oaspeți</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">Numar maxim de persoane</h6>
                        <p>3</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">Numar paturi</h6>
                        <p>3</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">Numar bai</h6>
                        <p>1</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">Se permite folosirea bucatariei persoanelor cazate?</h6>
                        <p>Da</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">Persoanele cazate beneficiaza de loc de parcare?</h6>
                        <p>Da</p>
                    </div>
                    <h5 class="font-weight-600 text-primary mb-4 mt-4">Regulile casei</h5>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">Este permis fumatul in locuinta?</h6>
                        <p>Nu</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">Se accepta animale in locuinta?</h6>
                        <p>Nu</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h5 class="font-weight-600 text-primary mb-4">Poze locuinta</h5>
                    <div class="gallery d-flex flex-wrap mb-4">
                        <a href="https://img2.imonet.ro/XAG0/AG000JTPP5C/apartament-de-vanzare-2-camere-bucuresti-drumul-taberei-135356032.jpg" data-toggle="lightbox" data-gallery="example-gallery">
                            <img src="https://img2.imonet.ro/XAG0/AG000JTPP5C/apartament-de-vanzare-2-camere-bucuresti-drumul-taberei-135356032_330x248.jpg" alt="">
                        </a>
                        <a href="https://img3.imonet.ro/XAG0/AG000JTPP5C/apartament-de-vanzare-2-camere-bucuresti-drumul-taberei-135356042.jpg" data-toggle="lightbox" data-gallery="example-gallery">
                            <img src="https://img3.imonet.ro/XAG0/AG000JTPP5C/apartament-de-vanzare-2-camere-bucuresti-drumul-taberei-135356042_330x248.jpg" alt="">
                        </a>
                        <a href="https://img2.imonet.ro/XAG0/AG000JTPP5C/apartament-de-vanzare-2-camere-bucuresti-drumul-taberei-135356038.jpg" data-toggle="lightbox" data-gallery="example-gallery">
                            <img src="https://img2.imonet.ro/XAG0/AG000JTPP5C/apartament-de-vanzare-2-camere-bucuresti-drumul-taberei-135356038_330x248.jpg" alt="">
                        </a>
                    </div>
                    <h5 class="font-weight-600 text-primary mb-4">Dotari cazare</h5>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-2">Ce dotari are spatiul de cazare?</h6>
                        <ul class="list-unstyled list-custom gray-bullets">
                            <li>
                                Dotari esentiale (prosoape, lenjerie de pat, sapun, hartie igienica, perne)
                            </li>
                            <li>
                                Aer conditionat
                            </li>
                            <li>
                                Dulapuri/sertare
                            </li>
                        </ul>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-2">Ce dotari speciale are spatiul de cazare?</h6>
                        <ul class="list-unstyled list-custom gray-bullets">
                            <li>Detector de fum</li>
                            <li>Detector de gaze</li>
                            <li>Incuietoare la usa dormitorului</li>
                        </ul>
                    </div>
                    <h5 class="font-weight-600 text-primary mb-4 mt-4">Adresa locuintei</h5>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">Adresa exacta</h6>
                        <p>Str. St. Fernando, Bl. C19, Sc. B, Ap. 88, Etaj 9, Madrid, Spania, Cod postal 28010</p>
                    </div>
                    <h5 class="font-weight-600 text-primary mb-4 mt-4">Accesibilitate transport (distanta in metri)</h5>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">Cea mai apropiata statie de metrou:</h6>
                        <p>500 m</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">Cea mai apropiata statie de autobuz:</h6>
                        <p>200 m</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">Cea mai apropiata gara de trenuri:</h6>
                        <p>2500 m</p>
                    </div>
                </div>
            </div>
            <div class="border-top pt-3 mt-4">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="font-weight-600 text-primary mb-4 mt-4">Regulile casei</h5>
                        <div class="kv">
                            <h6 class="font-weight-600 mb-1">Cazarea se face dupa ora:</h6>
                            <p>18:00</p>
                        </div>
                        <div class="kv">
                            <h6 class="font-weight-600 mb-1">Decazarea se face inainte de ora:</h6>
                            <p>09:00</p>
                        </div>
                        <div class="kv">
                            <h6 class="font-weight-600 mb-1">Indisponibilitate</h6>
                            <p>20.10.2015 - 28.10.2015</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h5 class="font-weight-600 text-primary mb-4 mt-4">Costuri</h5>
                        <div class="kv">
                            <h6 class="font-weight-600 mb-1">Care sunt costurile de cazare?</h6>
                            <p>Totul este gratuit</p>
                        </div>
                        <div class="kv">
                            <h6 class="font-weight-600 mb-1">Suma estimata</h6>
                            <p>0 Lei</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <h5 class="text-primary font-weight-600 mb-0">
                Note si recenzii
            </h5>
            <div class="border-bottom py-4">
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

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <script>
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                //props
            });
        });
    </script>
@endsection

