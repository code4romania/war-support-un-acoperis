@extends('layouts.app')

@section('content')
    <div class="container py-sm-6 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="d-flex align-items-sm-center flex-column flex-sm-row">
            <img src="/images/banner-homepage.png" alt="Help for Health" srcset="/images/banner-homepage@2x.png 2x">
            <div class="banner-content ml-sm-5 mt-3 mt-sm-0">
                <h1 class="text-primary font-weight-600 mb-4">Bine ai venit!</h1>
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci. Ridiculus facilisis curabitur bibendum ultricies lacus, sollicitudin id massa augue. Consequat ullamcorper semper nisl tristique habitant eu et ac. Auctor magna tellus cursus viverra tortor. Porttitor consequat.</p>
                <button class="btn btn-lg btn-primary mr-3 px-5">Solicita servicii</button>
                <button class="btn btn-lg btn-secondary px-5">Implica-te</button>
            </div>
        </div>
    </div>
    <div class="bg-homepage-section-1 my-2 py-5">
        <div class="container">
            <h2 class="text-center font-weight-600 mb-5">Cu ce te putem ajuta</h2>
            <div class="card-deck how-can-we-help">
                <div class="card text-center shadow-sm">
                    <img src="/images/homepage-icon-1.svg" height="100" class="card-img-top mt-4" alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-600">Consultanta in strangerea de fonduri</h5>
                        <p class="card-text mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>
                    </div>
                </div>
                <div class="card text-center shadow-sm">
                    <img src="/images/homepage-icon-2.svg" height="100" class="card-img-top mt-4" alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-600">Accesarea serviciilor medicale potrivite</h5>
                        <p class="card-text mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>
                    </div>
                </div>
                <div class="card text-center shadow-sm">
                    <img src="/images/homepage-icon-3.svg" height="100" class="card-img-top mt-4" alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-600">Solutionarea altor nevoi</h5>
                        <p class="card-text mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>
                    </div>
                </div>
                <div class="card text-center shadow-sm">
                    <img src="/images/homepage-icon-4.svg" height="100" class="card-img-top mt-4" alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-600">Sprijin pentru a găsi cazare</h5>
                        <p class="card-text mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <h2 class="text-primary font-weight-600 mb-5">Despre proiect</h2>
            <div class="row">
                <div class="col-sm-8">
                    <p class="mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nunc vitae egestas fames risus. Tempus arcu, quis nec commodo habitasse dignissim donec mi. Cras viverra bibendum in tincidunt id ornare. Mi tincidunt euismod id lorem dictum. Morbi sit diam accumsan et convallis ut tellus ipsum nam. Neque pellentesque et orci, scelerisque tristique vulputate. Viverra pellentesque id dolor turpis platea sed.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nunc vitae egestas fames risus. Tempus arcu, quis nec commodo habitasse dignissim donec mi. Cras viverra bibendum in tincidunt id ornare. Mi tincidunt euismod id lorem dictum. Morbi sit diam accumsan et convallis ut tellus ipsum nam. Neque pellentesque et orci, scelerisque tristique vulputate. Viverra pellentesque id dolor turpis platea sed.
                    </p>
                </div>
                <div class="col-sm-4 px-sm-5">
                    <img src="/images/logo-hfh.svg" class="w-100" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="container-holder">
        <div class="container text-white">
            <div class="row d-flex align-items-stretch">
                <div class="col-sm-6">
                    <div class="strech-bg py-5 pr-sm-6">
                        <h2 class="text-white font-weight-600 mb-4">Solicita servicii</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.
                        </p>
                        <button class="btn btn-white text-secondary btn-lg px-6 mt-4">Solicita aici</button>
                    </div>
                </div>
                <div class="col-sm-6 py-5 pl-sm-6">
                    <h2 class="text-white font-weight-600 mb-4">Devino gazda</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.
                    </p>
                    <button class="btn btn-white text-primary btn-lg px-6 mt-4">Implica-te</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="text-primary font-weight-600 mb-4">Lorem ipsum</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nunc vitae egestas fames risus. Tempus arcu, quis nec commodo habitasse dignissim donec mi. Cras viverra bibendum in tincidunt id ornare. Mi tincidunt euismod id lorem dictum. Morbi sit diam accumsan et convallis ut tellus ipsum nam. Neque pellentesque et orci, scelerisque tristique vulputate. Viverra pellentesque id dolor turpis platea sed.
                </p>
            </div>
            <div class="col-sm-6">
                <h2 class="text-primary font-weight-600 mb-4">Lorem ipsum</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nunc vitae egestas fames risus. Tempus arcu, quis nec commodo habitasse dignissim donec mi. Cras viverra bibendum in tincidunt id ornare. Mi tincidunt euismod id lorem dictum. Morbi sit diam accumsan et convallis ut tellus ipsum nam. Neque pellentesque et orci, scelerisque tristique vulputate. Viverra pellentesque id dolor turpis platea sed.
                </p>
            </div>
        </div>
    </div>
@endsection
