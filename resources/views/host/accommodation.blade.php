@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600 mb-3">{{ __('Accommodation') }}</h6>
    </section>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center rounded">
            <h6 class="font-weight-600 text-white mb-0">
                {{ trans_choice('Accommodation places', $accommodations->count(), ['value' => $accommodations->count()]) }}
            </h6>
            <a class="btn btn-secondary btn-sm px-4" href="{{ route('host.add-accommodation') }}">{{ __('Add accommodation') }}</a>
        </div>
    </div>

    <div class="alert bg-white text-dark d-flex align-items-center shadow-sm mb-4">
        <span class="alert-inner--icon mr-3"><i class="fa fa-info-circle"></i></span>
        <span class="alert-inner--text font-weight-600">{{ __('You can add one or more accommodation to offer to people who need help!') }}</span>
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

{{--    <div class="mt-4">--}}
{{--        <nav aria-label="...">--}}
{{--            <ul class="pagination justify-content-center mb-0">--}}
{{--                <li class="page-item disabled">--}}
{{--                    <a class="page-link" href="#" tabindex="-1">--}}
{{--                        <i class="fa fa-angle-left"></i>--}}
{{--                        <span class="sr-only">Previous</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                <li class="page-item active">--}}
{{--                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>--}}
{{--                </li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                <li class="page-item">--}}
{{--                    <a class="page-link" href="#">--}}
{{--                        <i class="fa fa-angle-right"></i>--}}
{{--                        <span class="sr-only">Next</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </nav>--}}
{{--    </div>--}}
@endsection

