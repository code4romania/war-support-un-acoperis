<a href="{{ route('trusted.home') }}"
   class="list-group-item list-group-item-action {{ handleActiveClass('trusted.home*') }}">
    <i class="fa fa-home mr-3"></i>{{__('General')}}
</a>
<a href="{{ route('share.accommodation.list') }}" class="list-group-item list-group-item-action ">
    <i class="fa fa-bed mr-3"></i>{{__('Offer host')}}
</a>
<a href="{{ route('share.accommodation.create', ['status' => 1]) }}" class="list-group-item list-group-item-action sub-list ">
    <i class="fa fa-minus mx-3"></i>{{__('Add host')}}
</a>
<a href="{{ route('share.help.request.list') }}" class="list-group-item list-group-item-action ">
    <i class="fa fa-bed mr-3"></i>{{__('Help request')}}
</a>
<a href="{{ route('share.help.request.create', ['status' => 1]) }}" class="list-group-item list-group-item-action sub-list ">
    <i class="fa fa-minus mx-3"></i>{{__('Add help request')}}
</a>
