    <section class="py-5 bg-h4h-form">
        <div class="container">
            <div class="accordion-1 request-services">
                <form method="POST" action="{{ $formRoute }}" id="sendRequest">
                    <input type="hidden" name="request_services_step" value="{{\App\Http\Requests\ServiceRequest::SERVICE}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 ml-auto">
                            <div class="accordion my-3" id="requestForm">

                                <div class="card shadow mb-4" id="generatData">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link w-100 text-left d-flex justify-content-between"
                                                    type="button" data-toggle="collapse"
                                                    data-target="#generalInformation" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                3. {{ __('Request accommodation') }}
                                                <i class="ni ni-bold-down align-self-center ml-4"></i>
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="generalInformation" class="collapse show"
                                         aria-labelledby="generalInformation" data-parent="#requestForm">
                                        <div class="card-body py-5">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600"
                                                               for="current_location">{{ __("Current approximate location") }}
                                                            :</label>
                                                        <input type="text"
                                                               placeholder="@lang("current_location_placeholder")"
                                                               class="form-control @error('current_location') is-invalid @enderror"
                                                               name="current_location" id="current_location"
                                                               value="{{ old('current_location') }}" required/>

                                                        @error('current_location')
                                                        <span class="invalid-feedback"
                                                              role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">

                                                </div>       
                                                                                         <div class="col-sm-6 mt-4">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600"
                                                               for="known_languages">{{ __("Known languages") }}
                                                            :</label>
                                                        <select name="known_languages[]" id="known_languages"
                                                                class="custom-select form-control @error('known_languages') is-invalid @enderror"
                                                                required multiple>
                                                            @foreach ($languages as $language)
                                                                <option value="{{ $language->endonym }}">
                                                                    {{ __($language->endonym) }}</option>
                                                            @endforeach
                                                        </select>

                                                        @error('known_languages')
                                                        <span class="invalid-feedback"
                                                              role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 mt-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" id="special_needs"
                                                               name="special_needs"
                                                               type="checkbox" {{ !empty(old('special_needs')) ? 'checked' : '' }}>
                                                        <label class="custom-control-label font-weight-600"
                                                               for="special_needs">{{ __("Special needs") }}</label>
                                                    </div>
                                                </div>

                                                <div
                                                    class="col-sm-12  mt-4 @if(empty(old('special_needs'))) d-none @endif"
                                                    id="special_request_div">
                                                    <div class="form-group">
                                                        <label class="required font-weight-600"
                                                               for="special_request">{{ __("Special needs detailing") }}
                                                            :</label>
                                                        <input type="text"
                                                               placeholder="@lang("special_request_placeholder")"
                                                               class="form-control @error('special_request') is-invalid @enderror"
                                                               name="special_request" id="special_request"
                                                               value="{{ old('special_request') }}" data-required="1"/>
                                                        @error('special_request')
                                                        <span class="invalid-feedback"
                                                              role="alert">{{ $message }}</span>
                                                        @enderror
                                                    <small>@lang("Special needs detailing expl")</small>

                                                    </div>
                                                </div>

                                                <div class="col-sm-12 mt-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" id="has_dependants_family"
                                                               name="has_dependants_family"
                                                               type="checkbox" {{ !empty(old('has_dependants_family')) ? 'checked' : '' }}>
                                                        <label class="custom-control-label font-weight-600"
                                                               for="has_dependants_family">{{ __("I have dependants or I am with family") }}</label>
                                                    </div>
                                                    <small>@lang("I have dependants expl")</small>
                                                </div>

                                                <div
                                                    class="col-sm-12 mt-4 @if(empty(old('has_dependants_family'))) d-none @endif"
                                                    id="dependants_family_details_div">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="required font-weight-600"
                                                                       for="person_in_care_count">{{ __("Number of persons in care") }}
                                                                    :</label>
                                                                <input type="number" placeholder="1"
                                                                       class="form-control @error('person_in_care_count') is-invalid @enderror"
                                                                       name="person_in_care_count"
                                                                       id="person_in_care_count"
                                                                       value="{{ old('person_in_care_count') }}"
                                                                       min="1"
                                                                       data-required="1"/>

                                                                @error('person_in_care_count')
                                                                <span class="invalid-feedback"
                                                                      role="alert">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="persons_in_care">
                                                        <div class="row person_in_care" data-index="1">
                                                            <div class="col-12 col-sm-6 col-md-3">
                                                                <div class="form-group">
                                                                    <label class="required font-weight-600"
                                                                           for="person_in_care_name_1">{{ __("Full Name") }}</label>
                                                                    <input type="text"
                                                                           class="form-control @error('person_in_care_name.1') is-invalid @enderror "
                                                                           name="person_in_care_name[1]"
                                                                           id="person_in_care_name_1"
                                                                           value="{{ old('person_in_care_name.1') }}"
                                                                           data-required="1"/>

                                                                    @error('person_in_care_name.0')
                                                                    <span class="invalid-feedback"
                                                                          role="alert">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6 col-md-3">
                                                                <div class="form-group">
                                                                    <label class="required font-weight-600"
                                                                           for="person_in_care_age_1">{{ __("Age") }}</label>
                                                                    <input type="text"
                                                                           class="form-control @error('person_in_care_age.1') is-invalid @enderror"
                                                                           name="person_in_care_age[1]"
                                                                           id="person_in_care_age_1"
                                                                           value="{{ old('person_in_care_age.1') }}"
                                                                           data-required="1"/>

                                                                    @error('person_in_care_age.0')
                                                                    <span class="invalid-feedback"
                                                                          role="alert">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label class="font-weight-600"
                                                                           for="person_in_care_mentions_1">{{ __("Mentions/Special needs") }}</label>
                                                                    <input type="text"
                                                                           class="form-control @error('person_in_care_mentions.1') is-invalid @enderror"
                                                                           name="person_in_care_mentions[1]"
                                                                           id="person_in_care_mentions_1"
                                                                           value="{{ old('person_in_care_mentions.1') }}"/>

                                                                    @error('person_in_care_mentions.0')
                                                                    <span class="invalid-feedback"
                                                                          role="alert">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 mt-4">
                                                    <div class="form-group">
                                                        <label class="font-weight-600"
                                                               for="more_details">{{ __("Please give us more details about the case you are bringing to our attention") }}</label>
                                                        <textarea name="more_details" id="more_details"
                                                                  class="form-control @error('more_details') is-invalid @enderror"
                                                                  rows="4">{!! old('more_details') !!}</textarea>

                                                        @error('more_details')
                                                        <span class="invalid-feedback"
                                                              role="alert">{{ $message }}</span>
                                                        @enderror
                                                        <small>{!! __("You can mention details such as ... and other information you consider relevant") !!}</small>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-4">
                                                    <div class="border-top pt-5 mt-3 clearfix">
                                                        <label
                                                            class=" font-weight-600">{{ __("resource_types.transport") }}</label>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="need_transport"
                                                                   name="need_transport"
                                                                   type="checkbox" {{ !empty(old('need_transport')) ? 'checked' : '' }}>
                                                            <label class="custom-control-label"
                                                                   for="need_transport">{{ __("I need transport") }}</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="dont_need_transport"
                                                                   name="dont_need_transport"
                                                                   type="checkbox" {{ !empty(old('dont_need_transport')) ? 'checked' : '' }}>
                                                            <label class="custom-control-label"
                                                                   for="dont_need_transport">{{ __("I don't need transport - I have my own vehicle") }}</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input"
                                                                   id="need_special_transport"
                                                                   name="need_special_transport"
                                                                   type="checkbox" {{ !empty(old('need_special_transport')) ? 'checked' : '' }}>
                                                            <label class="custom-control-label"
                                                                   for="need_special_transport">{{ __("I need special transport (e.g. car with wheelchair space)") }}</label>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-12 mt-4">
                                                    <div class="border-top pt-5 mt-3 clearfix">
                                                        <button type="submit" id="next-step-button-1"
                                                                class="btn btn-secondary pull-right btn-lg px-6 hide">
                                                            <span class="btn-inner--text">{{ __("Finalize") }}</span>
                                                            <span class="btn-inner--icon ml-2"><i
                                                                    class="fa fa-check"></i></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            const personInCareCount                = $("#person_in_care_count"),
                  personFieldSet                   = $('.person_in_care[data-index="1"]'),
                  hasDependantsFamily              = $("#has_dependants_family"),
                  dependantsFamilyDetailsContainer = $("#dependants_family_details_div"),
                  rewriteCloneIndexes              = function (target, label, i) {
                          target.find(`[for="${label}_1"]`).attr('for', `${label}_${i}`);
                          target.find(`[name="${label}[1]"]`).attr('name', `${label}[${i}]`).attr('id', `${label}_${i}`);
                          target.find('input').val('');
                  },
                  showFamilyDependents             = function () {
                      dependantsFamilyDetailsContainer.removeClass("d-none");
                      $("input[data-required='1']", dependantsFamilyDetailsContainer).attr("required", true);
                      $(".person_in_care input").removeAttr('disabled');
                  },
                  hideFamilyDependents             = function () {
                      $("#dependants_family_details_div").addClass("d-none");
                      $("input[required]", $("#dependants_family_details_div")).attr('required', false);
                      $(".person_in_care input").attr('disabled', true);
                  },
                  toggleFamilyDependentsState      = (checkboxState) => checkboxState ? showFamilyDependents() : hideFamilyDependents(),
                  renderFields                     = function (q, fieldSet) {
                      for (let i = 2; i <= q; i++) {
                          const newSet = fieldSet.clone();
                          newSet.attr('data-index', i);

                          rewriteCloneIndexes(newSet, 'person_in_care_name', i);
                          rewriteCloneIndexes(newSet, 'person_in_care_age', i);
                          rewriteCloneIndexes(newSet, 'person_in_care_mentions', i);

                          newSet.appendTo($('#persons_in_care'));
                      }
                  },
                  cleanupFields                    = function () {
                      $(".person_in_care:not([data-index='1'])").remove();
                  };


            let trackTimeoutId;

            $('#known_languages').select2({
                allowClear       : true,
                theme            : "classic",
                tokenSeparators  : [,],
                scrollAfterSelect: true,
                selectionCssClass: "form-control",
                tags             : true
            });

            $("#special_needs").click(function () {
                let checked = $(this).is(":checked");

                if (checked) {
                    $("#special_request_div").removeClass("d-none");
                    $("input[data-required='1']", $("#special_request_div")).attr("required", true);
                } else {
                    $("#special_request_div").addClass("d-none");
                    $("input[required]", $("#special_request_div")).attr('required', false);
                }
            });

            toggleFamilyDependentsState(hasDependantsFamily.is(':checked'));
            hasDependantsFamily.click(function () {
                toggleFamilyDependentsState($(this).is(":checked"));
            });

            renderFields(personInCareCount.val(), personFieldSet)
            personInCareCount.keyup(function (e) {
                if (!e.target.value) {
                    return;
                }

                clearTimeout(trackTimeoutId);

                const timeoutId = setTimeout(() => {
                    cleanupFields();
                    renderFields(e.target.value, personFieldSet);
                }, 250);

                trackTimeoutId = timeoutId;
            });
            personInCareCount.on('blur', function (e) {
                if (!e.target.value) {
                    cleanupFields();
                    renderFields(e.target.value, personFieldSet);
                }
            })

            $("#need_transport, #need_special_transport").on('change', function (e) {
                if (this.checked) {
                    $("#dont_need_transport").attr("disabled", true);
                } else {
                    $("#dont_need_transport").removeAttr("disabled");
                }
            })
            $("#dont_need_transport").on('change', function (e) {
                if (this.checked) {
                    $("#need_transport, #need_special_transport").attr("disabled", true);
                } else {
                    $("#need_transport, #need_special_transport").removeAttr("disabled");
                }
            })
        });
    </script>
@endsection
