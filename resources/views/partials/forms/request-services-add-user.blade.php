
            <form method="POST" action="{{ $formRoute }}" id="sendRequest">
                <input type="hidden" name="request_services_step" value="{{\App\Http\Requests\ServiceRequest::REGISTER}}">
                @csrf
                <div class="row">
                    <div class="col-md-12 ml-auto">
                        <div class="accordion my-3" id="requestForm">

                            <div class="card shadow mb-4" id="generatData">
                                @if($showFormHeader)
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link w-100 text-left d-flex justify-content-between" type="button" data-toggle="collapse" data-target="#generalInformation" aria-expanded="true" aria-controls="collapseOne">
                                            2. {{ __('Create account') }}
                                            <i class="ni ni-bold-down align-self-center ml-4"></i>
                                        </button>
                                    </h5>
                                </div>
                                @endif

                                <div id="generalInformation" class="collapse show" aria-labelledby="generalInformation" data-parent="#requestForm">
                                    <div class="card-body py-5">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="required font-weight-600" for="patient-name">{{ __("Applicant's full name") }}:</label>
                                                    <input type="text" placeholder="Ana-Maria Vasile" class="form-control @error('name') is-invalid @enderror" name="name" id="patient-name" value="{{ old('name') }}" required />

                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="required font-weight-600" for="caretaker-name">{{ __("Applicant's e-mail") }}:</label>
                                                    <input type="email" placeholder="anamaria.vasile@provider.tld" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required />

                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="required font-weight-600" for="phone">{{ __("Applicant's phone number") }}:</label>
                                                    <input type="tel" placeholder="0742000000" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}" required />
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="required font-weight-600" for="patient-county">{{ __('Region of origin') }}:</label>
                                                            <select name="county_id" id="county_id" class="custom-select form-control @error('county_id') is-invalid @enderror" required >
                                                                <option></option>
                                                                @foreach ($counties as $county)
                                                                    <option value="{{ $county->id }}"  {{ (old('county_id') == $county->id  ? 'selected' : '') }} >{{ $county->region }}</option>
                                                                @endforeach
                                                            </select>

                                                            @error('county_id')
                                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="required font-weight-600" for="city">{{ __("City of origin") }}:</label>
                                                            <input name="city" id="city" value="{{ old('city') }}" class="form-control @error('city') is-invalid @enderror" required>

                                                            @error('city')
                                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="border-top pt-5 mt-3 clearfix">

                                                    @error('g-recaptcha-response')
                                                    <span class="invalid-feedback d-flex" role="alert">{{ $errors->first('g-recaptcha-response') }}</span>
                                                    @enderror

                                                    <div id="submit-button-container-1">
                                                    </div>

                                                    <button type="submit" id="next-step-button-1" class="btn btn-secondary pull-right btn-lg px-6 hide" >
                                                        <span class="btn-inner--text">{{ __("Continue") }}</span>
                                                        <span class="btn-inner--icon ml-2"><i class="fa fa-arrow-right"></i></span>
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

