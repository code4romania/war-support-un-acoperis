@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600 mb-3">{{ __('Add accommodation') }}</h6>
        <a href="{{ route('host.accommodation') }}" class="btn btn-sm btn-outline-primary mr-3">{{ __('Back') }}</a>
    </section>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __('Accommodation details') }}
            </h6>
        </div>
        <div class="card-body pt-4">
            <form action="{{ route('host.create-accommodation') }}" method="post">
                @csrf
                <h6 class="font-weight-600 text-primary mb-3">{{ __('Hostinf details') }}</h6>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="type" class="font-weight-600 required">{{ __('Accommodation type') }}?</label>
                            <select class="form-control custom-select" name="type" id="type">
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ (old('type') === $type->id) ? 'selected' : '' }}>{{ __($type->name) }}</option>
                            @endforeach
                            </select>

                            @error('type')
                            <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="owenership" class="font-weight-600 required">
                                {{ __('Ownership regime') }}
                            </label>
                            <select class="form-control custom-select" name="owenership" id="owenership">
                            @foreach($ownershipTypes as $ownershipTypeId => $ownershipTypeValue)
                                <option value="{{ $ownershipTypeId }}" {{ (old('owenership') === $ownershipTypeId) ? 'selected' : '' }}>{{ __($ownershipTypeValue) }}</option>
                            @endforeach
                            </select>

                            @error('owenership')
                            <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 mb-3">
                        <label for="" class="font-weight-600 mt-3 mb-3 required">{{ __('The accommodation is independent or part of your home') }}?</label>
                        <div class="custom-control custom-radio mb-2">
                            <input name="property_availability" class="custom-control-input" id="fully" value="fully" type="radio" {{ (in_array(old('property_availability'), [null, 'fully'])) ? 'checked="checked"' : '' }}>
                            <label class="custom-control-label" for="fully">{{ __('Full accommodation for guests') }}</label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                            <input name="property_availability" class="custom-control-input" id="partially" value="partially" type="radio" {{ ('partially' === old('property_availability')) ? 'checked="checked"' : '' }}>
                            <label class="custom-control-label" for="partially">{{ __('Accommodation with owner in the same premises') }}</label>
                        </div>

                        @error('property_availability')
                        <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="max_guests" class="font-weight-600 required">
                                {{ __('What is the maximum number of guests') }}?
                            </label>
                            <input type="text" class="form-control" name="max_guests" id="max_guests" placeholder="ex. 3" value="{{ old('max_guests') }}">

                            @error('max_guests')
                            <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="available_rooms" class="font-weight-600 required">
                                {{ __('How many rooms can the hosts use') }}?
                            </label>
                            <input type="text" class="form-control" placeholder="ex. 1" name="available_rooms" id="available_rooms" value="{{ old('available_rooms') }}">

                            @error('available_rooms')
                            <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="available_bathrooms" class="font-weight-600 required">
                                {{ __('How many bathrooms does the place have') }}?
                            </label>
                            <select class="form-control custom-select" name="available_bathrooms" id="available_bathrooms">
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ ($i === old('available_bathrooms')) ? 'selected': '' }}> {{ $i }}</option>
                                @endfor
                            </select>

                            @error('available_bathrooms')
                            <span class="invalid-feedback d-flex" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-sm-6">
                        <label for="" class="font-weight-600 mb-3 required">Permiteti folosirea bucatariei persoanelor cazate?</label>
                        <div class="custom-control custom-radio mb-2">
                            <input name="custom-radio-2" class="custom-control-input" id="customRadio3" checked="" type="radio">
                            <label class="custom-control-label" for="customRadio3">Da, este pregatita pentru oaspeti</label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                            <input name="custom-radio-2" class="custom-control-input" id="customRadio4" type="radio">
                            <label class="custom-control-label" for="customRadio4">Nu, bucataria nu este accesibila</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="" class="font-weight-600 mb-3 required">Persoanele cazate beneficiaza de loc de parcare?</label>
                        <div class="custom-control custom-radio mb-2">
                            <input name="custom-radio-3" class="custom-control-input" id="customRadio5" checked="" type="radio">
                            <label class="custom-control-label" for="customRadio5">Da</label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                            <input name="custom-radio-3" class="custom-control-input" id="customRadio6" type="radio">
                            <label class="custom-control-label" for="customRadio6">Nu</label>
                        </div>
                    </div>
                </div>
                <div class="description border-bottom pb-4 mb-4">
                    <label for="" class="font-weight-600 mb-3">Adauga o descriere locuintei</label>
                    <textarea id="mytextarea" class="form-control" name="" id="" cols="30" rows="10"></textarea>
                </div>

                <h6 class="font-weight-600 text-primary mb-3">Dotari cazare</h6>
                <div class="row my-3">
                    <div class="col-sm-6">
                        <label for="" class="font-weight-600 mb-3 required">Ce dotari are spatiul de cazare?</label>
                        <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" id="customCheck1" type="checkbox">
                            <label class="custom-control-label" for="customCheck1">Dotari esentiale (prosoape, lenjerie de pat, sapun, hartie igienica, perne)</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" id="customCheck1" type="checkbox">
                            <label class="custom-control-label" for="customCheck1">Wi-fi</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" id="customCheck1" type="checkbox">
                            <label class="custom-control-label" for="customCheck1">Televizor</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" id="customCheck1" type="checkbox">
                            <label class="custom-control-label" for="customCheck1">Incalzire</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" id="customCheck1" type="checkbox">
                            <label class="custom-control-label" for="customCheck1">Aer conditionat</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" id="customCheck1" type="checkbox">
                            <label class="custom-control-label" for="customCheck1">Dulapuri/Sertare</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="" class="font-weight-600 mb-3 required">Ce dotari speciale are spatiul de cazare?</label>
                        <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" id="customCheck1" type="checkbox">
                            <label class="custom-control-label" for="customCheck1">Detector de fum</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" id="customCheck1" type="checkbox">
                            <label class="custom-control-label" for="customCheck1">Detector de gaze</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" id="customCheck1" type="checkbox">
                            <label class="custom-control-label" for="customCheck1">Trusa de prim ajutor</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" id="customCheck1" type="checkbox">
                            <label class="custom-control-label" for="customCheck1">Extinctor</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" id="customCheck1" type="checkbox">
                            <label class="custom-control-label" for="customCheck1">Incuietoare la usa dormitorului</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" id="customCheck1" type="checkbox">
                            <label class="custom-control-label" for="customCheck1">Lift pentru persoane cu dizabilitati</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="font-weight-600">Alte dotari</label>
                            <input type="text" class="form-control" placeholder="Ce alte dotari are spatiul de cazare?">
                        </div>
                    </div>
                </div>
                <div class="address py-4 border-top border-bottom">
                    <h6 class="font-weight-600 text-primary mb-3">Adresa locuintei</h6>
                    <div class="row">
                        <div class="col-6 col-sm-3">
                            <div class="form-group">
                                <label for="" class="font-weight-600 required">
                                    Tara
                                </label>
                                <select class="form-control custom-select" name="" id="">
                                    <option value="Garsoniera">Romania</option>
                                    <option value="Apartament">Spania</option>
                                    <option value="Casa">Italia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="form-group">
                                <label for="" class="font-weight-600 required">
                                    Oras
                                </label>
                                <select class="form-control custom-select" name="" id="">
                                    <option value="Garsoniera">Bucuresti</option>
                                    <option value="Apartament">Bacau</option>
                                    <option value="Casa">Slobozia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="" class="font-weight-600">Strada</label>
                                <input type="text" class="form-control" placeholder="ex. Rasaritului">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="font-weight-600">Bloc</label>
                                        <input type="text" class="form-control" placeholder="ex. B3">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="font-weight-600">Scara</label>
                                        <input type="text" class="form-control" placeholder="ex. B">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="font-weight-600">Ap.</label>
                                        <input type="text" class="form-control" placeholder="ex. 51">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="font-weight-600 required">
                                            Etaj
                                        </label>
                                        <select class="form-control custom-select" name="" id="">
                                            <option value="Garsoniera">1</option>
                                            <option value="Apartament">2</option>
                                            <option value="Casa">3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="" class="font-weight-600">Cod postal</label>
                                <input type="text" class="form-control" placeholder="ex. 060522">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gallery py-4 border-bottom">
                    <h6 class="font-weight-600 text-primary mb-3">Poze locuinta</h6>
                    <input type="file" name="files">
                </div>
                <div class="rules py-4 border-bottom">
                    <h6 class="font-weight-600 text-primary mb-3">Regulile casi</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="" class="font-weight-600 mb-3">Este permis fumatul in locuinta?</label>
                            <div class="custom-control custom-radio mb-2">
                                <input name="custom-radio-4" class="custom-control-input" id="customRadio7" checked="" type="radio">
                                <label class="custom-control-label" for="customRadio7">Da</label>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input name="custom-radio-4" class="custom-control-input" id="customRadio8" type="radio">
                                <label class="custom-control-label" for="customRadio8">Nu</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="" class="font-weight-600 mb-3">Se accepta animale in locuinta?</label>
                            <div class="custom-control custom-radio mb-2">
                                <input name="custom-radio-5" class="custom-control-input" id="customRadio9" checked="" type="radio">
                                <label class="custom-control-label" for="customRadio9">Da</label>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input name="custom-radio-5" class="custom-control-input" id="customRadio10" type="radio">
                                <label class="custom-control-label" for="customRadio10">Nu</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="" class="font-weight-600">Alte reguli</label>
                                <input type="text" class="form-control" placeholder="Ce alte reguli sunt pentru spatiul de cazare?">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="transport py-4 border-bottom">
                    <h6 class="font-weight-600 text-primary mb-3">Accesibilitate transport (distanta in metri)</h6>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="" class="font-weight-600">Cea mai apropiata statie de metrou:</label>
                                <input type="text" class="form-control" placeholder="ex. 500 metri">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="" class="font-weight-600">Cea mai apropiata statie de autobuz:</label>
                                <input type="text" class="form-control" placeholder="ex. 500 metri">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="" class="font-weight-600">Cea mai apropiata gara de trenuri:</label>
                                <input type="text" class="form-control" placeholder="ex. 1000 metri">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="font-weight-600">Alte specificatii referitoare la transport</label>
                                <input type="text" class="form-control" placeholder="Cum se mai poate ajunge la spatiul de cazare?">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="availability py-4 border-bottom">
                    <h6 class="font-weight-600 text-primary mb-3">Accesibilitate transport (distanta in metri)</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="" class="font-weight-600">Cazarea se face dupa ora:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                    <input id="timeStart" class="flatpickr flatpickr-input form-control" type="text" placeholder="{{ __('Select Date') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="" class="font-weight-600">Decazarea se face inainte de ora:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                    <input id="timeEnd" class="flatpickr flatpickr-input form-control" type="text" placeholder="{{ __('Select Date') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="alert bg-light-blue text-dark d-flex align-items-center mb-3 mt-3">
                        <span class="alert-inner--icon mr-3"><i class="fa fa-info-circle"></i></span>
                        <span class="alert-inner--text">Este important să știm dacă în următoarea perioadă sunt și intervale de timp în care cazarea este complet indisponibilă pentru a nu te deranja cu solicitări și pentru a ne ajuta și pe noi să găsim soluții pentru pacienți cât mai rapid.</span>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="" class="font-weight-600">Data start:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input class="flatpickr flatpickr-input form-control" type="text" placeholder="{{ __('Select Date') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="" class="font-weight-600">Data end:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input class="flatpickr flatpickr-input form-control" type="text" placeholder="{{ __('Select Date') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cost py-4 border-bottom">
                    <h6 class="font-weight-600 text-primary mb-3">Costuri</h6>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="" class="font-weight-600 mb-3 required">Ce dotari speciale are spatiul de cazare?</label>
                            <div class="custom-control custom-radio mb-2">
                                <input name="custom-radio-6" class="custom-control-input" id="customRadio11" checked="" type="radio">
                                <label class="custom-control-label" for="customRadio11">Gratuit</label>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input name="custom-radio-6" class="custom-control-input" id="customRadio12" type="radio">
                                <label class="custom-control-label" for="customRadio12">Contracost</label>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="" class="font-weight-600">Suma estimativă percepută pe zi/săptămână/lună în cazul în care soliciți un beneficiu financiar:</label>
                                <input type="text" class="form-control" placeholder="ex. 100 lei">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix pt-4">
                    <button type="submit" id="submit-button-2" class="btn btn-secondary pull-right btn-lg px-6">
                        <span class="btn-inner--text">Salveaza</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.tiny.cloud/1/bgsado4b682dgf10owt5ns07i6jh5vcf36tc06nntxc08asr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
        $(document).ready(function () {
            flatpickr("#timeStart", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                defaultDate: "00:00"
            });
            flatpickr("#timeEnd", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                defaultDate: "00:00"
            });
            // enable fileuploader plugin
            $('input[name="files"]').fileuploader({
                limit: 20,
                maxSize: 50,

                extensions: null,
                changeInput: ' ',
                theme: 'thumbnails',
                enableApi: true,
                addMore: true,
                thumbnails: {
                    box: '<div class="fileuploader-items">' +
                        '<ul class="fileuploader-items-list">' +
                        '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner"><i>+</i></div></li>' +
                        '</ul>' +
                        '</div>',
                    item: '<li class="fileuploader-item">' +
                        '<div class="fileuploader-item-inner">' +
                        '<div class="type-holder">${extension}</div>' +
                        '<div class="actions-holder">' +
                        '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></button>' +
                        '</div>' +
                        '<div class="thumbnail-holder">' +
                        '${image}' +
                        '<span class="fileuploader-action-popup"></span>' +
                        '</div>' +
                        '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                        '<div class="progress-holder">${progressBar}</div>' +
                        '</div>' +
                        '</li>',
                    item2: '<li class="fileuploader-item">' +
                        '<div class="fileuploader-item-inner">' +
                        '<div class="type-holder">${extension}</div>' +
                        '<div class="actions-holder">' +
                        '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download><i class="fileuploader-icon-download"></i></a>' +
                        '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></button>' +
                        '</div>' +
                        '<div class="thumbnail-holder">' +
                        '${image}' +
                        '<span class="fileuploader-action-popup"></span>' +
                        '</div>' +
                        '<div class="content-holder"><h5 title="${name}">${name}</h5><span>${size2}</span></div>' +
                        '<div class="progress-holder">${progressBar}</div>' +
                        '</div>' +
                        '</li>',
                    startImageRenderer: true,
                    canvasImage: false,
                    _selectors: {
                        list: '.fileuploader-items-list',
                        item: '.fileuploader-item',
                        start: '.fileuploader-action-start',
                        retry: '.fileuploader-action-retry',
                        remove: '.fileuploader-action-remove'
                    },
                    onItemShow: function(item, listEl, parentEl, newInputEl, inputEl) {
                        var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                            api = $.fileuploader.getInstance(inputEl.get(0));

                        plusInput.insertAfter(item.html)[api.getOptions().limit && api.getChoosedFiles().length >= api.getOptions().limit ? 'hide' : 'show']();

                        if(item.format == 'image') {
                            item.html.find('.fileuploader-item-icon').hide();
                        }
                    },
                    onItemRemove: function(html, listEl, parentEl, newInputEl, inputEl) {
                        var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                            api = $.fileuploader.getInstance(inputEl.get(0));

                        html.children().animate({'opacity': 0}, 200, function() {
                            html.remove();

                            if (api.getOptions().limit && api.getChoosedFiles().length - 1 < api.getOptions().limit)
                                plusInput.show();
                        });
                    }
                },
                dragDrop: {
                    container: '.fileuploader-thumbnails-input'
                },
                afterRender: function(listEl, parentEl, newInputEl, inputEl) {
                    var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                        api = $.fileuploader.getInstance(inputEl.get(0));

                    plusInput.on('click', function() {
                        api.open();
                    });

                    api.getOptions().dragDrop.container = plusInput;
                },

                /*
                // while using upload option, please set
                // startImageRenderer: false
                // for a better effect
                upload: {
                    url: './php/upload_file.php',
                    data: null,
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    start: true,
                    synchron: true,
                    beforeSend: null,
                    onSuccess: function(result, item) {
                        var data = {};

                        if (result && result.files)
                            data = result;
                        else
                            data.hasWarnings = true;

                        // if success
                        if (data.isSuccess && data.files.length) {
                            item.name = data.files[0].name;
                            item.html.find('.content-holder > h5').text(item.name).attr('title', item.name);
                        }

                        // if warnings
                        if (data.hasWarnings) {
                            for (var warning in data.warnings) {
                                alert(data.warnings[warning]);
                            }

                            item.html.removeClass('upload-successful').addClass('upload-failed');
                            return this.onError ? this.onError(item) : null;
                        }

                        item.html.find('.fileuploader-action-remove').addClass('fileuploader-action-success');

                        setTimeout(function() {
                            item.html.find('.progress-holder').hide();
                            item.renderThumbnail();

                            item.html.find('.fileuploader-action-popup, .fileuploader-item-image').show();
                        }, 400);
                    },
                    onError: function(item) {
                        item.html.find('.progress-holder, .fileuploader-action-popup, .fileuploader-item-image').hide();
                    },
                    onProgress: function(data, item) {
                        var progressBar = item.html.find('.progress-holder');

                        if(progressBar.length > 0) {
                            progressBar.show();
                            progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                        }

                        item.html.find('.fileuploader-action-popup, .fileuploader-item-image').hide();
                    }
                },
                onRemove: function(item) {
                    $.post('php/upload_remove.php', {
                        file: item.name
                    });
                }
                */
            });
        });
    </script>
@endsection
