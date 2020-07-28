@extends('layouts.admin')

@section('content')
    Hello, {{ $user->name }} ({{ $user->email }})!
    <h6 class="page-title font-weight-600">Host Profile Page</h6>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                Informatii Personale
            </h6>
            <a class="btn btn-secondary btn-sm px-4" href="{{ route('host.edit-profile') }}">Editeaza profil</a>
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
    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                Date de logare in cont
            </h6>
            <a class="btn btn-secondary btn-sm px-4" href="{{ route('host.reset-password') }}">Reseteaza parola</a>
        </div>
        <div class="card-body pt-4">
            <div class="kv d-flex">
                <b class="mr-3">
                    Email:
                </b>
                <p>
                    teodora.munteanu@gmail.com
                </p>
            </div>
            <div class="kv d-flex">
                <b class="mr-3">
                    Parola
                </b>
                <p>
                    ************
                </p>
            </div>
        </div>
    </div>
@endsection

