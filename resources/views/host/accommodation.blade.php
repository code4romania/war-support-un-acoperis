@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600 mb-3">{{ __('Accommodation') }}</h6>
    </section>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center rounded">
            <h6 class="font-weight-600 text-white mb-0">
                {{ trans_choice('Accommodation places', $accommodations->count(), ['value' => $accommodations->count()]) }}
            </h6>
            <a class="btn btn-secondary btn-sm px-4" href="{{ route('host.add-accommodation') }}">{{ __('Add accommodation') }}</a>
        </div>
    </div>

    <div class="alert bg-white text-dark d-flex align-items-center shadow-sm mb-4">
        <span class="alert-inner--icon mr-3"><i class="fa fa-info-circle"></i></span>
        <span class="alert-inner--text font-weight-600">{{ __('You can add one or more accommodation to offer to people who need help!') }}</span>
    </div>

    <div class="card-deck accomodation-list row rows-2">
        @foreach($accommodations->get() as $accommodation)
        <div class="col-12 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="media">
                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('private')->temporaryUrl($accommodation->photos()->first()->path, now()->addMinutes(1)) }}" alt="" class="w-50 mr-4">
                        <div class="media-body">
                            <h6 class="text-primary font-weight-600 mb-1">
                                <a href="{{ route('host.view-accommodation', $accommodation->id) }}" class="text-underline">{{ __($accommodation->accommodationtype->name) }}</a>
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
                    <a href="{{ route('host.view-accommodation', $accommodation->id) }}" class="btn btn-sm btn-secondary mb-2 mb-sm-0">{{ __('See details') }}</a>
                    <a href="{{ route('host.edit-accommodation', $accommodation->id) }}" class="btn btn-sm btn-outline-primary mb-2 mb-sm-0">{{ __('Edit') }}</a>
                    <a href="#" class="btn btn-sm btn-outline-danger mb-2 mb-sm-0">{{ __('Delete') }}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

{{--    <div class="mt-4">--}}
{{--        <nav aria-label="...">--}}
{{--            <ul class="pagination justify-content-center mb-0">--}}
{{--                <li class="page-item disabled">--}}
{{--                    <a class="page-link" href="#" tabindex="-1">--}}
{{--                        <i class="fa fa-angle-left"></i>--}}
{{--                        <span class="sr-only">Previous</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                <li class="page-item active">--}}
{{--                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>--}}
{{--                </li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                <li class="page-item">--}}
{{--                    <a class="page-link" href="#">--}}
{{--                        <i class="fa fa-angle-right"></i>--}}
{{--                        <span class="sr-only">Next</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </nav>--}}
{{--    </div>--}}

    <!-- Confirmare stergere cazare -->
    <div class="modal fade bd-example-modal-sm" id="deleteAccommodationModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">{{ __('Delete accommodation') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this accommodation') }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-dismiss="modal" id="cancel">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-secondary" id="proceedDeleteRequest">{{ __('Yes') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
