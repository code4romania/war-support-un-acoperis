<div class="card-body py-5">
    <!-- please leave this outside the form -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="required font-weight-600" for="host_type">{{ __("Host type") }}:</label>
                <select name="host_type" id="host_type" class="custom-select form-control @error('host_type') is-invalid @enderror">
                    <option value="person" {{ old('host_type') == 'person' ? ' selected' : '' }}>{{ __("Person") }}</option>
                    <option value="company" {{ old('host_type') == 'company' ? ' selected' : '' }}>{{ __("Company") }}</option>
                </select>
            </div>
        </div>
    </div>
</div>

@include('partials.forms.host-signup-person', ['formRoute' => route('create-host-person-account')])
@include('partials.forms.host-signup-company', ['formRoute' => route('create-host-company-account')])
