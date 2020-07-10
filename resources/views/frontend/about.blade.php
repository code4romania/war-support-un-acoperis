@extends('layouts.app')

@section('content')
    <div class="container py-sm-6 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
            <div class="d-flex align-items-sm-center flex-column flex-sm-row">
                <img src="/images/featured-about.png" alt="Help for Health" srcset="/images/featured-about@2x.png 2x">
                <div class="banner-content ml-sm-6 mt-3 mt-sm-0">
                    <h1 class="text-primary font-weight-600 mb-4">Ce este Help for Health?</h1>
                    <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>
                    <p>Ridiculus facilisis curabitur bibendum ultricies lacus, sollicitudin id massa augue. Consequat ullamcorper semper nisl tristique habitant eu et ac. Auctor magna tellus cursus viverra tortor. Porttitor consequat.  Auctor magna tellus cursus viverra tortor. Porttitor consequat. </p>
                </div>
            </div>
    </div>
    <section class="bg-light-blue my-2 py-5">
        <div class="container">
            <h2 class="font-weight-600 mb-5">Care sunt tipurile de servicii cu care te putem ajuta</h2>
            <div class="media mb-5">
                <img src="/images/about-icon-1.svg" height="140" class="mr-5 align-self-center" alt="...">
                <div class="media-body align-self-center">
                    <h5 class="mt-0 font-weight-600">Consultanta in strangerea de fonduri</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus. Pellentesque sed netus.</p>
                </div>
            </div>
            <div class="media mb-5">
                <img src="/images/about-icon-2.svg" height="140" class="mr-5 align-self-center" alt="...">
                <div class="media-body align-self-center">
                    <h5 class="mt-0 font-weight-600">Accesarea serviciilor medicale potrivite</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus. Pellentesque sed netus.</p>
                </div>
            </div>
            <div class="media mb-5">
                <img src="/images/about-icon-3.svg" height="140" class="mr-5 align-self-center" alt="...">
                <div class="media-body align-self-center">
                    <h5 class="mt-0 font-weight-600">Solutionarea altor nevoi</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus. Pellentesque sed netus.</p>
                </div>
            </div>
            <div class="media">
                <img src="/images/about-icon-4.svg" height="140" class="mr-5 align-self-center" alt="...">
                <div class="media-body align-self-center">
                    <h5 class="mt-0 font-weight-600">Sprijin pentru a găsi cazare</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus. Pellentesque sed netus.</p>
                </div>
            </div>
        </div>
    </section>
    <div class="py-5">
        <div class="container">
            <h2 class="text-primary font-weight-600 mb-5">Despre Asociația MAME</h2>
            <div class="row mb-6">
                <div class="col-sm-8">
                    <p class="mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nunc vitae egestas fames risus. Tempus arcu, quis nec commodo habitasse dignissim donec mi. Cras viverra bibendum in tincidunt id ornare. Mi tincidunt euismod id lorem dictum. Morbi sit diam accumsan et convallis ut tellus ipsum nam. Neque pellentesque et orci, scelerisque tristique vulputate. Viverra pellentesque id dolor turpis platea sed.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nunc vitae egestas fames risus. Tempus arcu, quis nec commodo habitasse dignissim donec mi. Cras viverra bibendum in tincidunt id ornare. Mi tincidunt euismod id lorem dictum.
                    </p>
                </div>
                <div class="col-sm-4 px-sm-5 align-self-center">
                    <img src="/images/logo-asociatia-mame.svg" class="w-100" alt="">
                </div>
            </div>
            <h2 class="text-primary font-weight-600 mb-5">Despre Fundația Vodafone România</h2>
            <div class="row">
                <div class="col-sm-8">
                    <p class="mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nunc vitae egestas fames risus. Tempus arcu, quis nec commodo habitasse dignissim donec mi. Cras viverra bibendum in tincidunt id ornare. Mi tincidunt euismod id lorem dictum. Morbi sit diam accumsan et convallis ut tellus ipsum nam. Neque pellentesque et orci, scelerisque tristique vulputate. Viverra pellentesque id dolor turpis platea sed.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nunc vitae egestas fames risus. Tempus arcu, quis nec commodo habitasse dignissim donec mi. Cras viverra bibendum in tincidunt id ornare. Mi tincidunt euismod id lorem dictum.
                    </p>
                </div>
                <div class="col-sm-4 px-sm-5">
                    <img src="/images/logo-fvr.svg" class="w-100" alt="">
                </div>
            </div>
        </div>
    </div>
    <section class="bg-light-blue py-5">
        <div class="container">
            <h2 class="font-weight-600 mb-4">FAQs</h2>
            <! -- FAQs -->
            <div class="accordion-1">
                <div class="row">
                    <div class="col-md-12 ml-auto">
                        <div class="accordion my-3 shadow-sm" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link w-100 text-left collapsed d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            How do I order?
                                            <i class="ni ni-bold-down align-self-center ml-4"></i>
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body opacity-8">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link w-100 text-left collapsed d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            How can i make the payment?
                                            <i class="ni ni-bold-down align-self-center ml-4"></i>

                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body opacity-8">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link w-100 text-left collapsed d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            How much time does it take to receive the order?
                                            <i class="ni ni-bold-down align-self-center ml-4"></i>

                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body opacity-8">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link w-100 text-left collapsed d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#collapseFour" aria-controls="collapseFour">
                                            Can I resell the products?
                                            <i class="ni ni-bold-down align-self-center ml-4"></i>
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                    <div class="card-body opacity-8">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFifth">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link w-100 text-left collapsed d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#collapseFifth" aria-controls="collapseFifth">
                                            Where do I find the shipping details?
                                            <i class="ni ni-bold-down align-self-center ml-4"></i>

                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseFifth" class="collapse" aria-labelledby="headingFifth" data-parent="#accordionExample">
                                    <div class="card-body opacity-8">
                                        <p>
                                            Pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </p>
                                        <p>
                                            Pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
