<div class="col-12 col-sm-6 mb-4">
    <div class="card h-100">
        <div class="card-body">
            <div class="media">
                @if (!empty($accommodation->photos()->count()))
                    <img src="{{ $accommodation->photos()->first()->getPhotoUrl() }}" alt="" class="w-50 mr-4">
                @endif
                <div class="media-body">
                    <h6 class="text-primary font-weight-600 mb-1">
                        <a href="{{ route("$context.view-accommodation", $accommodation->id) }}" class="text-underline">{{ __($accommodation->accommodationtype->name) }}</a>
                    </h6>
                    <p>{{ $accommodation->address_city }}, {{ $accommodation->addresscountry->name }}</p>
                    <p>{{ trans_choice('Maximum accommodated rooms', $accommodation->available_rooms, ['value' => $accommodation->available_rooms]) }}</p>

                    @if (!empty($accommodation->unavailable_from_date) && !empty($accommodation->unavailable_to_date))
                        <div class="kv mb-2">
                            <p>{{ __('Unavailability') }}</p>
                            <p>{{ formatDate($accommodation->unavailable_from_date) }} - {{ formatDate($accommodation->unavailable_to_date) }}</p>
                        </div>
                    @endif
                    <div class="kv d-flex mb-0">
                        <p class="mr-3">{{ __('Maximum') }}</p>
                        <p class="text-admin-blue">{{ trans_choice('Maximum accommodated persons', $accommodation->max_guests, ['value' => $accommodation->max_guests]) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route("$context.view-accommodation", $accommodation->id) }}" class="btn btn-sm btn-secondary mb-2 mb-sm-0">{{ __('See details') }}</a>
            @if($accommodation->canBeEdited())
                <a href="{{ route("$context.edit-accommodation", $accommodation->id) }}" class="btn btn-sm btn-outline-primary mb-2 mb-sm-0">{{ __('Edit') }}</a>
            @endif
            @if($accommodation->canBeDeleted())
                <a href="#" class="btn btn-sm btn-outline-danger mb-2 mb-sm-0 delete-accommodation" data-id="{{ $accommodation->id }}">{{ __('Delete') }}</a>
            @endif
        </div>
    </div>
</div>
