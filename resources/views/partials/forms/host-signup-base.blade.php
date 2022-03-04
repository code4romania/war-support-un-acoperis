<!-- please leave this outside the form -->
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="required font-weight-600" for="host_type">{{ __("Host type") }}:</label>
            <select name="host_type" id="host_type" class="custom-select form-control @error('host_type') is-invalid @enderror">
                <option value="person" {{ $hostType == 'person' ? ' selected' : '' }}>{{ __("Host type person") }}</option>
                <option value="company" {{ $hostType == 'company' ? ' selected' : '' }}>{{ __("Host type company") }}</option>
            </select>
        </div>
    </div>
</div>

@include('partials.forms.host-signup-person')
@include('partials.forms.host-signup-company')

@section('scripts')
<script>
    function showHideHostForms()
    {
        let hostType = $('#host_type').val();

        //we need this in case there is an error and the user is redirected back
        //the host_type field is not part of any form
        $('input[name="host_type_copy"]').val(hostType);

        if (hostType == 'person')
        {
            $('#hostSignupPersonForm').show();
            $('#hostSignupCompanyForm').hide();
        }
        else
        {
            $('#hostSignupPersonForm').hide();
            $('#hostSignupCompanyForm').show();
        }
    }

    $(document).ready(function(){
        showHideHostForms();

        $('#host_type').on('change', function (){
            showHideHostForms();
        });
    });
</script>
@endsection
