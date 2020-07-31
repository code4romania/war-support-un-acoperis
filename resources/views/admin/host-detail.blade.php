@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600 mb-3">Dan Vintu</h6>
    </section>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                Informatii Personale
            </h6>
            <a class="btn btn-secondary btn-sm px-4" href="{{ route('host.edit-profile') }}">Editeaza</a>
        </div>
        <div class="card-body pt-4">
            <div class="kv d-flex">
                <b class="mr-3">
                    Nume si prenume:
                </b>
                <p>
                    Teodora Munteanu
                </p>
            </div>
            <div class="kv d-flex">
                <b class="mr-3">
                    Tara:
                </b>
                <p>
                    Spania
                </p>
            </div>
            <div class="kv d-flex">
                <b class="mr-3">
                    Oras:
                </b>
                <p>
                    Madrid
                </p>
            </div>
            <div class="kv d-flex">
                <b class="mr-3">
                    Adresa:
                </b>
                <p>
                    Strada Fernando Astoria
                </p>
            </div>
            <div class="kv d-flex">
                <b class="mr-3">
                    Telefon:
                </b>
                <p>
                    0762 567 976
                </p>
            </div>
            <div class="kv d-flex">
                <b class="mr-3">
                    Email:
                </b>
                <p>
                    teodora.munteanu@gmail.com
                </p>
            </div>
        </div>
    </div>

    <div class="alert alert-secondary d-flex justify-content-between align-items-center">
        <h6 class="mb-0 font-weight-600 text-white">
            Valideaza gazda si trimite optiunea de a reseta parola Contului
        </h6>
        <a class="btn btn-white text-secondary px-4 ml-3" href="#">Trimite</a>
    </div>

    <div class="alert alert-secondary d-flex align-items-center">
        <i class="fa fa-check text-white mr-3"></i>
        <h6 class="mb-0 font-weight-600 text-white">
            Optiunea de resetare a parolei a fost trimisa cu succes
        </h6>
    </div>

    <div class="alert alert-white d-flex justify-content-between align-items-center">
        <h6 class="mb-0 font-weight-600 text-dark">
            Trimite optiune de resetare parola in cazul in care a uitat parola initiala
        </h6>
        <a class="btn btn-secondary px-4 ml-3" href="#">Trimite</a>
    </div>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center rounded">
            <h6 class="font-weight-600 text-white mb-0">
                2 spatii de cazare
            </h6>
            <a class="btn btn-secondary btn-sm px-4" href="{{ route('host.create-accommodation') }}">Adauga cazare</a>
        </div>
    </div>

    <div class="card-deck accomodation-list">
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <img src="https://img3.imonet.ro/XAG0/AG000JTPP5C/apartament-de-vanzare-2-camere-bucuresti-drumul-taberei-135356042_330x248.jpg" alt="" class="w-50 mr-4">
                    <div class="media-body">
                        <h6 class="text-primary font-weight-600 mb-1">
                            <a href="" class="text-underline">Garsoniera</a>
                        </h6>
                        <p>Spania, Madrid</p>
                        <p>1 camera</p>
                        <div class="kv mb-2">
                            <p>Indisponibilitate</p>
                            <p>18.08.2019 - 20.08.2019</p>
                        </div>
                        <div class="kv d-flex mb-0">
                            <p class="mr-3">Maxim</p>
                            <p class="text-admin-blue">3 persoane</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('host.edit-accommodation') }}" class="btn btn-sm btn-outline-primary mb-2 mb-sm-0">Editeaza Cazare</a>
                <a href="#" class="btn btn-sm btn-outline-danger mb-2 mb-sm-0">Sterge Cazare</a>
                <a href="{{ route('host.view-accommodation') }}" class="btn btn-sm btn-secondary mb-2 mb-sm-0">Vizualizeaza</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <img src="https://img2.imonet.ro/XAG0/AG000JTPP5C/apartament-de-vanzare-2-camere-bucuresti-drumul-taberei-135356038_330x248.jpg" alt="" class="w-50 mr-4">
                    <div class="media-body">
                        <h6 class="text-primary font-weight-600 mb-1">
                            <a href="" class="text-underline">Garsoniera</a>
                        </h6>
                        <p>Spania, Madrid</p>
                        <p>1 camera</p>
                        <div class="kv mb-2">
                            <p>Indisponibilitate</p>
                            <p>18.08.2019 - 20.08.2019</p>
                        </div>
                        <div class="kv d-flex mb-0">
                            <p class="mr-3">Maxim</p>
                            <p class="text-admin-blue">3 persoane</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('host.edit-accommodation') }}" class="btn btn-sm btn-outline-primary mb-2 mb-sm-0">Editeaza Cazare</a>
                <a href="#" class="btn btn-sm btn-outline-danger mb-2 mb-sm-0">Sterge Cazare</a>
                <a href="{{ route('host.view-accommodation') }}" class="btn btn-sm btn-secondary mb-2 mb-sm-0">Vizualizeaza</a>
            </div>
        </div>
    </div>

@endsection
