@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600">Cerere #{{ $helpRequest->id }} - {{ $helpRequest->patient_full_name }}</h6>
    </section>
    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                Detalii Cerere
            </h6>
            <button class="btn btn-white btn-sm text-danger px-4">Șterge</button>
        </div>
        <div class="card-body pt-4">
            <h4 class="font-weight-600 text-primary mb-5">{{ $helpRequest->patient_full_name }}</h4>
            <div class="row">
                <div class="col-sm-6">
                    <ul class="details-wrapper list-unstyled mb-4">
                        <li class="d-flex align-items-start">
                            <i class="fa fa-map-marker"></i>
                            <span>
                            Locatie: <b>{{ $helpRequest->county->name }}, {{ $helpRequest->city->name }}</b>
                            </span>
                        </li>
                        <li class="d-flex">
                            <i class="fa fa-phone"></i>
                            <span>
                            Telefon: <b>{{ $helpRequest->patient_phone_number }}</b>
                        </span>
                        </li>
                        <li class="d-flex">
                            <i class="fa fa-at"></i>
                            <span>
                            Email:  <a href="mailto:{{ $helpRequest->patient_email }}" target="_blank">{{ $helpRequest->patient_email }}</a>
                        </span>
                        </li>
                    </ul>
                    <ul class="details-wrapper list-unstyled">
                        <li class="d-flex align-items-start">
                            <i class="fa fa-dot-circle-o"></i>
                            <span>
                            Responsabil: <b>{{ $helpRequest->caretaker_full_name }}</b>
                            </span>
                        </li>
                        <li class="d-flex">
                            <i class="fa fa-phone"></i>
                            <span>
                            Telefon responsabil: <b>{{ $helpRequest->caretaker_phone_number }}</b>
                        </span>
                        </li>
                        <li class="d-flex">
                            <i class="fa fa-at"></i>
                            <span>
                            Email responsabil:  <a href="mailto:{{ $helpRequest->caretaker_email }}" target="_blank">{{ $helpRequest->caretaker_email }}</a>
                        </span>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <div class="kv">
                        <p>Data:</p>
                        <b>{{ $helpRequest->created_at->setTimezone(Config::get('app.frontend_timezone'))->format(Config::get('app.frontend_datetime_format')) }}</b>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="kv">
                        <h6 class="mb-0">Status cerere</h6>
                        @if (\App\HelpRequest::STATUS_NEW === $helpRequest->status)
                            <span class="badge badge-danger">Neaprobată</span>
                        @elseif (\App\HelpRequest::STATUS_IN_PROGRESS === $helpRequest->status)
                            <span class="badge badge-warning">În așteptare</span>
                        @elseif (\App\HelpRequest::STATUS_COMPLETED === $helpRequest->status)
                            <span class="badge badge-success">Aprobată</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="border-top border-bottom py-4 mt-4">
                <h6 class="font-weight-600">Diagnostic</h6>
                <p class="mb-0">{{ $helpRequest->diagnostic }}</p>
            </div>
            <div class="border-bottom py-4">
                <h6 class="font-weight-600">Alte informații:</h6>
                <p class="mb-0">
                    <i>
                        {{ $helpRequest->extra_details }}
                    </i>
                </p>
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
    @foreach($helpRequest->helptypes as $helpType)
        <div class="card">
            <div class="card-body">
                <h5 class="font-weight-600 text-primary mb-4">{{ __($helpType->name) }}</h5>
                <div class="row">
                    <div class="col-sm-5">
                        @if (\App\HelpType::TYPE_SMS === $helpType->id)
                            <div class="kv">
                                <p>{{ __('Estimated amount required for treatment / surgery') }}:</p>
                                <b>{{ $helpRequest->helprequestsmsdetail()->first()->amount }}</b>
                            </div>
                            <div class="kv">
                                <p>{{ __('Clinic / hospital name where the patient is accepted') }}:</p>
                                <b>{{ $helpRequest->helprequestsmsdetail()->first()->clinic }}</b>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <div class="kv">
                                        <p>{{ __('Country') }}:</p>
                                        <b>{{ $helpRequest->helprequestsmsdetail()->first()->country->name }}</b>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="kv">
                                        <p>{{ __('City') }}:</p>
                                        <b>{{ $helpRequest->helprequestsmsdetail()->first()->city }}</b>
                                    </div>
                                </div>
                            </div>
                        @elseif (\App\HelpType::TYPE_ACCOMMODATION === $helpType->id)
                            <div class="kv">
                                <p>{{ __('At which hospital will the medical investigations / treatment be performed') }}?</p>
                                <b>{{ $helpRequest->helprequestaccommodationdetail()->first()->clinic }}</b>
                            </div>
                            <div class="kv">
                                <p>{{ __('Starting with what date you need accommodation') }}?</p>
                                <b>{{ $helpRequest->helprequestaccommodationdetail()->first()->start_date->setTimezone(Config::get('app.frontend_timezone'))->format(Config::get('app.frontend_date_format')) }}</b>
                            </div>
                            <div class="kv">
                                <p>{{ __('Detail here if you need special accommodation conditions') }}:</p>
                                <b>{{ $helpRequest->helprequestaccommodationdetail()->first()->special_request }}</b>
                            </div>
                        @elseif (\App\HelpType::TYPE_OTHER_NEEDS === $helpType->id)
                            <div class="kv">
                                <b>{{ $helpType->pivot->message }}</b>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        @if (\App\HelpType::TYPE_SMS === $helpType->id)
                            <div class="kv">
                                <p>{{ __('Fund destination') }}:</p>
                                <b>{{ $helpRequest->helprequestsmsdetail()->first()->purpose }}</b>
                            </div>
                        @elseif (\App\HelpType::TYPE_ACCOMMODATION === $helpType->id)
                            <div class="kv">
                                <p>{{ __('For how many people do you need accommodation') }}?</p>
                                <b>{{ $helpRequest->helprequestaccommodationdetail()->first()->guests_number }}</b>
                            </div>
                            <div class="kv">
                                <p>{{ __('Until when do you need accommodation') }}?</p>
                                <b>{{ $helpRequest->helprequestaccommodationdetail()->first()->end_date->setTimezone(Config::get('app.frontend_timezone'))->format(Config::get('app.frontend_date_format')) }}</b>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">Nivel de aprobare:</label>
                            <select name="" id="" class="custom-select form-control bg-danger text-white font-weight-600 border-danger">
                                <option value="noua">Neaprobata</option>
                                <option value="aprobata">Aprobata</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

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
                    <textarea name="addNote" id="addNote" cols="30" rows="20"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-gray-dark" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Adauga nota</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation modal -->
    <div class="modal fade bd-example-modal-sm" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Aprobare cerere</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Sigur vrei sa aprobi aceasta cerere?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Inchide</button>
                    <button type="button" class="btn btn-secondary">Aproba</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.tiny.cloud/1/bgsado4b682dgf10owt5ns07i6jh5vcf36tc06nntxc08asr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#addNote'
        });
        $(document).ready(function(){
            $('.custom-select').change(function(){
                $('#confirmationModal').modal('show')
            });
        });
    </script>
@endsection
