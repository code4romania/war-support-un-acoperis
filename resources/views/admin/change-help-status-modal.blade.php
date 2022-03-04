<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changeStatusModal">
    {{ __('Change status') }}
</button>

<!-- Modal -->
<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
    <form action="" method="post" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeStatusModalLabel">{{ __('Change status') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="">
                    <div class="form-group">
                        <label class="" for="status">Status</label>
                        <select name="status" id="status" class="custom-select form-control">
                            @foreach (\App\HelpRequest::statusList() as $key => $value)
                                <option value="{{ $key }}" {{ $helpRequest->status === $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="changeStatusSubmit">Save changes</button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        $('#changeStatusSubmit').on('click', function() {
            axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';

            axios
                .post('{{ route('ajax.update-help-requests-status', $helpRequest->id) }}', {
                    status: $('#changeStatusModal select').val()
                })
                .then(response => {
                    $('#changeStatusModal').modal('hide');
                    window.location.reload();
                })
                .catch(error => {
                    console.log(error);
                });
        });
    });
</script>
