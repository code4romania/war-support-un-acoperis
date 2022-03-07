<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
    {{__('Create user')}}
</button>
@if(!empty($user))<h2>User: {{$user->name}} </h2>@endif

<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">{{__('Add user')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('partials.forms.request-services-add-user', [
                    'formRoute'         => route('share.help.request.create.refugee'),
                    'showFormHeader'    => false
                ])
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
            </div>
        </div>
    </div>
</div>

@if ($errors->has('new_user.*'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('button[data-target="#addUserModal"]').click();
        });
    </script>
@endif
