<div class="col-12 col-sm-3 mb-1">
    <div class="card h-50">
        <div class="card-body">
            <p>{{__('Status')}} : @switch($item->status)
                    @case(\App\HelpRequest::STATUS_NEW)
                    <span class="alert alert-info"> {{__('New')}}</span>
                    @break
                    @case(\App\HelpRequest::STATUS_IN_PROGRESS)
                    <span class="alert alert-warning"> {{__('In progress')}}</span>
                    @break
                    @case(\App\HelpRequest::STATUS_PARTIAL_ALLOCATED)
                    <span class="alert alert-danger"> {{__('Partial allocated')}}</span>
                    @break
                    @case(\App\HelpRequest::STATUS_COMPLETED)
                    <span class="alert alert-success"> {{__('Completed')}}</span>
                    @break
                @endswitch
            </p>
            <p>{{__('Guest number')}} : {{$item->guests_number}}</p>
            <p>{{__('Special needs')}} : {{$item->special_needs}}</p>
            <p>{{__('Created at')}} : {{$item->created_at}}</p>
            @if($item->isAllocated())
                @include('common.help-request-accommodation-view')
            @endif
        </div>
    </div>
</div>
