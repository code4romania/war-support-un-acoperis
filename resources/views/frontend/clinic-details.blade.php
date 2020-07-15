@extends('layouts.app')

@section('content')
    <div class="container py-sm-5 py-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="display-3 title mb-0 text-primary">{{ __('Spitalul University College') }}</h1>
    </div>
    <section class="bg-light-blue py-4">
        <div class="container">
            Dacă ai nevoie de sprijin în a lua legătura cu această clinică, sau ai nevoie de cazare în Londra te rugăm să ne scrii un mesaj folosind
            <a href="#">acest formular</a>.
        </div>
    </section>
    <div class="container py-5">
        <div class="row mb-6">
            <div class="col pr-lg-5">
                <h4 class="text-primary mb-4 font-weight-600">Detalii despre clinica</h4>
                <ul class="details-wrapper list-unstyled">
                    <li class="d-flex align-items-start">
                        <i class="fa fa-map-marker"></i>
                        <span>
                            Str. Euston, Nr. 235, Cod postal: NW1 2BU<br>Londra<br> Marea Britanie
                        </span>
                    </li>
                    <li class="d-flex">
                        <i class="fa fa-phone"></i>
                        <span>
                            004408451555000, 004402034567890
                        </span>
                    </li>
                    <li class="d-flex">
                        <i class="fa fa-globe"></i>
                        <span>
                            <a href="#">http://www.uclh.nhs.uk/</a>
                        </span>
                    </li>
                </ul>
            </div>
            <div class="col pl-lg-5">
                <h4 class="text-primary mb-4 font-weight-600">Persoana de contact</h4>
                <ul class="details-wrapper list-unstyled">
                    <li class="d-flex">
                        <i class="fa fa-user-circle"></i>
                        <span>
                            Dr. Rakesh Popat
                        </span>
                    </li>
                    <li class="d-flex">
                        <i class="fa fa-phone"></i>
                        <span>
                            004402034479456
                        </span>
                    </li>
                    <li class="d-flex">
                        <i class="fa fa-envelope"></i>
                        <span>
                            lucia.geoffery@uclh.nhs.uk
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col pr-lg-5">
                <div class="description mb-6">
                    <h4 class="text-primary mb-4 font-weight-600">Descriere</h4>
                    <p>In cadrul spitalului se ofera ingrijire si tratament copiilor si tinerilor diagnosticati cu leucemie limfoblastica acuta, leucemie mieloida acuta, sarcom Ewing, tumori cu celule germinale, boala Hodgkin, limfom non-Hodgkin de osteosarcom si tumori ale sistemului nervos central.</p>
                </div>
                <div class="extra-info">
                    <h4 class="text-primary mb-4 font-weight-600">Informatii suplimentare</h4>
                    <p>Spitalul University College este situat in inima Londrei si ofera servicii de specialitate in sase spitale:</p>
                    <ul class="list-custom">
                        <li>Spitalul University College (care incorporeaza Aripa Elizabeth Garrett Anderson, Spitalul University College</li>
                        <li>Centrul Oncologic Macmillan si Institutul de Sport)</li>
                        <li>Spitalul Royal National ORL</li>
                        <li>Spitalul de Medicina Integrata Royal London</li>
                        <li>Spitalul National de Neurologie si Neurochirurgie</li>
                        <li>Spitalul de Cardiologie</li>
                        <li>Spitalul de Stomatologie</li>
                    </ul>
                    <p>Pentru Centrul Oncologic Macmillan, din cadrul Spitalului University College, adresa este Str. Huntley nr. WC1E 6AG, si puteti obtine informatii suplimentare la telefon: 004402034567016.</p>
                </div>
            </div>
            <div class="col pl-lg-5">
                <div class="mb-5">
                    <h4 class="text-primary mb-4 font-weight-600">Detalii despre clinica</h4>
                    <ul class="list-custom">
                        <li>Oncologie adulti</li>
                        <li>Oncologie pediatrie</li>
                    </ul>
                </div>
                <h4 class="text-primary mb-4 font-weight-600">Modalitati de transport</h4>
                <p>Exista diferite modalitati de a ajunge la Spitalul University College, situat pe Str. Euston, Nr. 235, NW1 2BU:</p>
                <h6><i class="fa fa-train mr-2"></i>Cu trenul</h6>
                <ul class="list-custom">
                    <li>Spitalul University College se afla la doar cativa pasi de Gara Euston. </li>
                </ul>
                <h6><i class="fa fa-bus mr-2"></i>Cu autobuzul</h6>
                <ul class="list-custom">
                    <li>
                        Statia Tottenham Court Road - Northbound (Warren Station Street), liniile: 10, 73, 24, 29, 134.
                    </li>
                    <li>
                        Statia Gower Street - Southbound (University Street), liniile: 10, 24, 29, 73, 134.
                    </li>
                    <li>
                        Statia Euston Road, liniile: 18, 27, 30, 88.
                    </li>
                </ul>
                <h6><i class="fa fa-subway mr-2"></i>Cu metroul</h6>
                <ul class="list-custom">
                    <li>
                        Spitalul University College este situat pe Euston Road, aproape de statiile de metrou Warren Street (linia Nord/Victoria) si Euston Square (linia Circle/Hammersmith si linia Oras/Metropolitan).
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <section class="mb-0 clinic-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2488.2498838455936!2d0.08075301555663382!3d51.41683622514207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8abf1c408865d%3A0x5d04cbb01d3fa10c!2sUniversity%20College%20London%20Chislehurst%20Sports%20Ground%2C%20Chislehurst%2C%20Regatul%20Unit!5e0!3m2!1sro!2sro!4v1594827735342!5m2!1sro!2sro" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </section>
@endsection
