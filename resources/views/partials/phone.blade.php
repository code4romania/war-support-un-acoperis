<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <select name="{{ $controlName }}Prefix" id="{{ $controlName }}Prefix" class="custom-select form-control @error($controlName.'Prefix') is-invalid @enderror">
                @foreach ($prefixes as $country)
                    @if (!empty($country->phone_prefix))
                        <option value="{{ $country->code }}"{{ old($controlName.'Prefix', 'RO') == $country->code ? ' selected' : '' }}>
                            {{ $country->name }} (+{{ $country->phone_prefix }})
                        </option>
                    @endif
                @endforeach
            </select>

            @error($controlName.'Prefix')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group">

            <input type="tel" placeholder="" class="form-control @error($controlName) is-invalid @enderror" name="{{ $controlName }}Local" id="{{ $controlName }}Local" value="{{ old($controlName . 'Local') }}" />
            <input type="hidden" name="{{ $controlName }}" id="{{ $controlName }}" value="{{ old($controlName, $controlDefault) }}" />

            @error($controlName)
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>


@section('scripts')
    <script>
        const updatePhone = function () {
            let countryCode = $("#{{ $controlName }}Prefix").val();
            let phoneNumber = $("#{{ $controlName }}Local").val();

            axios.post('{{ @route('ajax.phone') }}', {
                _token: "{{ csrf_token() }}",
                countryCode: countryCode,
                phoneNumber: phoneNumber
            }).then(response => {
                $("#{{ $controlName }}Local").attr("placeholder", response.data.data.mask);
                if (response.data.data.localPhone) {
                    $("#{{ $controlName }}Local").val(response.data.data.localPhone);
                }
                $("#{{ $controlName }}").val(response.data.data.intlPhone);

                if (countryCode !== response.data.data.countryCode) {
                    $("#{{ $controlName }}Prefix").val(response.data.data.countryCode);
                }

            }).catch(error => {
                console.log(error);
            });
        }

        $(document).ready(function () {
            updatePhone();

            $( "#{{ $controlName }}Local" ).keyup(updatePhone);
            $( "#{{ $controlName }}Prefix" ).change(updatePhone);

        });
    </script>
    @parent
@endsection
