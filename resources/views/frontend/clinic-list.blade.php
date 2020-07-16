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
            Caută clinica de care ai nevoie pentru diagnosticul tău și ia legătura cu ei pentru a putea beneficia de serviciile lor. Dacă ai nevoie de sprijin în a identifica o clinică potrivită și/sau în relația cu o clinică sau alta, te rugăm să ne scrii un mesaj folosind
            <a href="#">acest formular</a>.
        </div>
    </section>
    <section class="shadow-sm">
        <div class="container py-4">
            <div class="row align-items-end">
                <div class="col-sm-8">
                    <h4 class="font-weight-600">Clinici</h4>
                    <p class="mb-sm-0">Caută o clinică folosind câmpul de căutare sau filtrează lista clinicilor cu ajutorul opțiunilor prezente</p>
                </div>
                <div class="col-sm-4">
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                            </div>
                            <input id="resourceSearch" name="query" class="form-control" placeholder="Search" type="text" value="">
                        </div>
                    </div>
                </div>
            </div>
            <form action="">
                <div class="row mt-5">
                    <div class="col-sm-8">
                        <label for="">Specialitate</label>
                        <div class="input-group">
                            <input type="text" placeholder="Placeholder text here..." class="form-control" id="pacient-name" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target=".bd-example-modal-xl">
                                    Adauga
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="" for="completer-name">Tara</label>
                            <select name="" id="" class="custom-select form-control">
                                <option value="">Tara 1</option>
                                <option value="">Tara 2</option>
                                <option value="">Tara 3</option>
                                <option value="">Tara 4</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="" for="completer-name">Oras</label>
                            <select name="" id="" class="custom-select form-control">
                                <option value="">Oras 1</option>
                                <option value="">Oras 2</option>
                                <option value="">Oras 3</option>
                                <option value="">Oras 4</option>
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
        <div class="table-responsive  shadow-sm mb-4">
            <table class="table table-striped w-100 mb-0">
                <thead class="thead-dark">
                <tr>
                    <th>Nume spital</th>
                    <th>Tara</th>
                    <th>Oras</th>
                    <th class="text-right"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <a href="#">Spitalul University College</a>
                    </td>
                    <td>Marea Britanie</td>
                    <td>Londra</td>
                    <td class="td-actions text-right">
                        <a href="{{ route('clinic-details', 'demo-clinic') }}"  class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                            Vezi detalii
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#">Spitalul Intercontinental Hisar</a>
                    </td>
                    <td>Turcia</td>
                    <td>Istanbul </td>
                    <td class="td-actions text-right">
                        <a href="{{ route('clinic-details', 'demo-clinic') }}"  class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                            Vezi detalii
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#">Institutul International de Neurostiinte</a>
                    </td>
                    <td>Germania</td>
                    <td>Hanovra </td>
                    <td class="td-actions text-right">
                        <a href="{{ route('clinic-details', 'demo-clinic') }}"  class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                            Vezi detalii
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#">The Royal Marsden NHS Trust</a>
                    </td>
                    <td>Marea Britanie</td>
                    <td>Londra</td>
                    <td class="td-actions text-right">
                        <a href="{{ route('clinic-details', 'demo-clinic') }}"  class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                            Vezi detalii
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#">Clinica Pediatrica St. Anna</a>
                    </td>
                    <td>Austria</td>
                    <td>Viena</td>
                    <td class="td-actions text-right">
                        <a href="{{ route('clinic-details', 'demo-clinic') }}"  class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                            Vezi detalii
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#">Spitalul Universitar Charité, Campus Virchow</a>
                    </td>
                    <td>Germania</td>
                    <td>Berlin </td>
                    <td class="td-actions text-right">
                        <a href="{{ route('clinic-details', 'demo-clinic') }}"  class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                            Vezi detalii
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#">Spitalul Cantonal St. Gallen</a>
                    </td>
                    <td>Elveția</td>
                    <td>St Gallen</td>
                    <td class="td-actions text-right">
                        <a href="{{ route('clinic-details', 'demo-clinic') }}"  class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                            Vezi detalii
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#">Spitalul Universitar Basel</a>
                    </td>
                    <td>Elveția</td>
                    <td>Basel</td>
                    <td class="td-actions text-right">
                        <a href="{{ route('clinic-details', 'demo-clinic') }}"  class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                            Vezi detalii
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#">Centrul Medical Hirslanden</a>
                    </td>
                    <td>Elveția</td>
                    <td>Aarau</td>
                    <td class="td-actions text-right">
                        <a href="{{ route('clinic-details', 'demo-clinic') }}"  class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                            Vezi detalii
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#">Centrul Medical Atena</a>
                    </td>
                    <td>Marea Britanie</td>
                    <td>Londra</td>
                    <td class="td-actions text-right">
                        <a href="{{ route('clinic-details', 'demo-clinic') }}"  class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                            Vezi detalii
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#">Spitalul de Copii Sant Joan de Déu-Barcelona</a>
                    </td>
                    <td>Grecia</td>
                    <td>Atena</td>
                    <td class="td-actions text-right">
                        <a href="{{ route('clinic-details', 'demo-clinic') }}"  class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                            Vezi detalii
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#">Spitalul International Beijing Puhua</a>
                    </td>
                    <td>Spania</td>
                    <td>Barcelona</td>
                    <td class="td-actions text-right">
                        <a href="{{ route('clinic-details', 'demo-clinic') }}"  class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                            Vezi detalii
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#">Centrul Medical Hirslanden</a>
                    </td>
                    <td>China</td>
                    <td>Beijing</td>
                    <td class="td-actions text-right">
                        <a href="{{ route('clinic-details', 'demo-clinic') }}"  class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                            Vezi detalii
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#">Centrul Medical Atena</a>
                    </td>
                    <td>Elveția</td>
                    <td>Aarau</td>
                    <td class="td-actions text-right">
                        <a href="{{ route('clinic-details', 'demo-clinic') }}"  class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                            Vezi detalii
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#">Spitalul de Copii Sant Joan de Déu-Barcelona</a>
                    </td>
                    <td>Grecia</td>
                    <td>Atena</td>
                    <td class="td-actions text-right">
                        <a href="{{ route('clinic-details', 'demo-clinic') }}"  class="btn btn-info btn-icon btn-sm " data-original-title="" title="">
                            Vezi detalii
                        </a>
                    </td>
                </tr>
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
                       <div class="col">
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
                       <div class="col">
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
                        <div class="col">
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
                        <div class="col">
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
