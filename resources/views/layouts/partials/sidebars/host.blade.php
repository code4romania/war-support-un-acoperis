<a href="{{ route('host.profile') }}" class="list-group-item list-group-item-action {{ in_array(Route::currentRouteName(), ['host.profile', 'host.edit-profile', 'host.reset-password']) ? 'active' : '' }}">
    <i class="fa fa-user mr-3"></i>Profilul meu
</a>
<a href="{{ route('host.accommodation') }}" class="list-group-item list-group-item-action {{ in_array(Route::currentRouteName(), ['host.accommodation', 'host.add-accommodation', 'host.view-accommodation', 'host.edit-accommodation']) ? 'active' : '' }}">
    <i class="fa fa-user mr-3"></i>Cazare
</a>
