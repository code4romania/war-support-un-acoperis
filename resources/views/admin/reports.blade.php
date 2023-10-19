@extends('layouts.admin')

@section('content')
    <section class="mb-5">

        <h6 class="page-title font-weight-600">{{ __("Generate reports") }}</h6>
        <div class="card p-3 mt-4 shadow-sm">
            <span><b>{{ __("Daily created help requests and offers report")  }}</b></span>
            <br>
            <div class="row">
                <div class="mb-4 mx-sm-3">
                    <form class="form" id="offers-report" method="POST" action="{{ route('admin.reports.offers') }}">
                    @csrf <!-- {{ csrf_field() }} -->
                        <div class="form-group">
                            <label class="" for="startDate">{{ __('Starting with') }}</label>

                            <input
                                class="flatpickr flatpickr-input form-control @error('startDate') is-invalid @enderror"
                                type="text" id="startDate" name="startDate" value="{{ old('startDate') }}" />
                            @error('startDate') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="" for="endDate">{{ __('Until') }}</label>
                            <input
                                class="flatpickr flatpickr-input form-control @error('endDate') is-invalid @enderror"
                                type="text" id="endDate" name="endDate" value="{{ old('endDate') }}" />
                            @error('endDate') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror

                        </div>
                        <button type="submit" class="btn btn-primary mb-2">{{ __("Generate") }}</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <dl class="row mx-sm-3">
                    <dt class="col-md-2">Zi</dt>
                    <dd class="col-md-9">Ziua pentru care s-au calculat informatiile</dd>
                    <dt class="col-md-2">Nr. Cereri</dt>
                    <dd class="col-md-9">Numarul de cereri de cazare create in ziua curenta, mai putin cele care au fost sterse, indiferent de statusul in care se afla la momentul actual.</dd>
                    <dt class="col-md-2">Nr. Persoane</dt>
                    <dd class="col-md-9">Numarul de persoane inregistrate pe cererile de cazare din ziua curenta.</dd>
                    <dt class="col-md-2">Nevoie de masina</dt>
                    <dd class="col-md-9">Numarul de cereri de cazare in care s-a solicitat deplasare cu masina din ziua curenta.</dd>
                    <dt class="col-md-2">Nevoie de transport special</dt>
                    <dd class="col-md-9">Numarul de cereri de cazare in care s-a solicitat deplasare cu transport spcecial din ziua curenta.</dd>
                    <dt class="col-md-2">Nevoi speciale</dt>
                    <dd class="col-md-9">Numarul de cereri de cazare in care s-au mentionat nevoi speciale din ziua curenta.</dd>
                    <dt class="col-md-2">Oferte cazare</dt>
                    <dd class="col-md-9">Numarul de oferte de cazare adaugate in ziua curenta, mai putin cele care au fost sterse, indiferent de statusl in care se afla la momentul actual.</dd>
                </dl>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @parent
    <script type="application/javascript">
        $("#offers-report #startDate").flatpickr({
            defaultDate: new Date().fp_incr(-30)
        });
        $("#offers-report #endDate").flatpickr({
            defaultDate: "today",
            maxDate: "today"
        })
    </script>
@endsection
