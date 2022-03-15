<<<<<<< HEAD
<div class="col-12 col-sm-4 mb-4">
    <div class="card m-0 equal-height">
        <div class="card-body p-3">
            <table class="w-100 info-table">
                <tr>
                    <td class="label">{{__('Request ID')}}</td>
                    <td class="text-right">
                        <span class="badge badge-dark">#{{$item->id}}</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">{{__('Status')}} :</td>
                    <td class="text-right">
                        @switch($item->status)
                            @case(\App\HelpRequest::STATUS_NEW)
                            <span class="badge badge-new"> {{__('New')}}</span>
                            @break
                            @case(\App\HelpRequest::STATUS_IN_PROGRESS)
                            <span class="badge badge-warning"> {{__('In progress')}}</span>
                            @break
                            @case(\App\HelpRequest::STATUS_PARTIAL_ALLOCATED)
                            <span class="badge badge-danger"> {{__('Partial allocated')}}</span>
                            @break
                            @case(\App\HelpRequest::STATUS_COMPLETED)
                            <span class="badge badge-success"> {{__('Completed')}}</span>
                            @break
                        @endswitch
                    </td>
                </tr>
                <tr>
                    <td class="label">{{__('Guest number')}} :</td>
                    <td class="text-right">{{$item->guests_number}}</td>
                </tr>
                <tr>
                    <td class="label">{{__('Special needs')}} :</td>
                    <td class="text-right">{{$item->special_needs}}</td>
                </tr>
                <tr>
                    <td class="label">{{__('Created at')}}</td>
                    <td class="text-right">{{ \Carbon\Carbon::parse($item->created_at)->subSecond()->format('d F Y H:i') }}</td>
                </tr>
            </table>
            @if($item->isAllocated())
=======
<div class="col-12 col-sm-3 mb-1">
    <div class="card">
        <div class="card-body">
            <p>{{ __('Status') }} : @switch($item->status)
                    @case(\App\HelpRequest::STATUS_NEW)
                        <span class="alert alert-info"> {{ __('New') }}</span>
                    @break

                    @case(\App\HelpRequest::STATUS_IN_PROGRESS)
                        <span class="alert alert-warning"> {{ __('In progress') }}</span>
                    @break

                    @case(\App\HelpRequest::STATUS_PARTIAL_ALLOCATED)
                        <span class="alert alert-danger"> {{ __('Partial allocated') }}</span>
                    @break

                    @case(\App\HelpRequest::STATUS_COMPLETED)
                        <span class="alert alert-success"> {{ __('Completed') }}</span>
                    @break
                @endswitch
            </p>
            <p>{{ __('Guest number') }} : {{ $item->guests_number }}</p>
            <p>{{ __('Special needs') }} : {{ $item->special_needs }}</p>
            <p>{{ __('Created at') }} : {{ $item->created_at }}</p>
            @if ($item->isAllocated())
>>>>>>> development
                @include('common.help-request-accommodation-view', [
                    'accommodation' => $item->accommodation()->get()->last(),
                ])
            @endif
        </div>
    </div>
</div>
