<a href="{{ route('refugee.home') }}"
   class="list-group-item list-group-item-action {{ handleActiveClass('refugee.home*') }}">
    <i class="fa fa-user mr-3"></i>{{__('General')}}
</a>
<a href="{{ route('refugee.accommodation') }}"
   class="list-group-item list-group-item-action {{ handleActiveClass('refugee.accommodation*') }}">
    <i class="fa fa-bed mr-3"></i>{{__('My Accomodations')}}
</a>
<a href="{{route('refugee.information')}}"
   class="list-group-item list-group-item-action {{ handleActiveClass('refugee.information*') }}">
    <i class="fa fa-question-circle mr-3"></i>{{__('Ask for Information')}}
</a>
