<a href="{{ route('refugee.home') }}"
   class="list-group-item list-group-item-action {{ handleActiveClass('refugee.home*') }}">
    <i class="fa fa-home mr-3"></i>{{__('General')}}
</a>
<a href="{{ route('refugee.help.requests') }}"
   class="list-group-item list-group-item-action {{ handleActiveClass('refugee.accommodation*') }}">
    <i class="fa fa-bed mr-3"></i>{{__('My Requests')}}
</a>
<a href="{{route('refugee.information')}}"
   class="list-group-item list-group-item-action {{ handleActiveClass('refugee.information*') }}">
    <i class="fa fa-question-circle mr-3"></i>{{__('Ask for Information')}}
</a>
