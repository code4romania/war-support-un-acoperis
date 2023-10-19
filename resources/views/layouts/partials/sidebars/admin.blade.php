<a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
    <i class="fa fa-bar-chart mr-3"></i>Dashboard
</a>
<!-- New buttons, routes need to be added, and also active checks, like for Dashboard -->
<a href="{{ route('admin.accommodation-list') }}" class="list-group-item list-group-item-action ">
    <i class="fa fa-bed mr-3"></i>Oferte cazări
</a>
<a href="{{ route('admin.accommodation-list', ['status' => 1]) }}" class="list-group-item list-group-item-action sub-list ">
    <i class="fa fa-minus mx-3"></i>Aprobate
</a>
<a href="{{ route('admin.accommodation-list', ['status' => 2]) }}" class="list-group-item list-group-item-action sub-list ">
    <i class="fa fa-minus mx-3"></i>Neaprobate
</a>
<a href="{{ route('share.accommodation.create', ['status' => 1]) }}" class="list-group-item list-group-item-action sub-list ">
    <i class="fa fa-minus mx-3"></i>Adauga cazare
</a>
<a href="{{ route('admin.help.request.list') }}" class="list-group-item list-group-item-action ">
    <img src="/images/hand-icon.svg" class="mr-3">Solicitări cazări
</a>

<a href="{{ route('admin.allocation.list') }}" class="list-group-item list-group-item-action sub-list ">
    <i class="fa fa-minus mx-3"></i>Ultima zi de cazare
</a>
<a href="{{ route('share.help.request.create', ['status' => 1]) }}" class="list-group-item list-group-item-action sub-list ">
    <i class="fa fa-minus mx-3"></i>{{__('Add help request')}}
</a>

<a href="{{ route('admin.user-list') }}" class="list-group-item list-group-item-action ">
    <i class="fa fa-users mr-3"></i>Utilizatori
</a>
<a href="{{ route('admin.reports.index') }}" class="list-group-item list-group-item-action ">
    <i class="fa fa-table mr-3"></i>Rapoarte
</a>
<!-- New buttons end -->
