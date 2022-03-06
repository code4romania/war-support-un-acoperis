@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="{{ route('host.accommodation') }}">{{ __('Accommodation') }}</a>
                </li>
                <li class="breadcrumb-item active text-dark" aria-current="page">
                    {{ __($accommodation->accommodationtype->name) }},
                    {{ $accommodation->addresscountry->name }},
                    {{ $accommodation->address_city }}
                </li>
            </ol>
        </nav>
    </section>
    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ ucwords(__('Accommodation details')) }}
            </h6>
            @if($accommodation->canBeEdited())
                <a class="btn btn-secondary btn-sm px-4"
                   href="{{ route('host.edit-accommodation', $accommodation->id) }}">{{ __('Edit accommodation') }}</a>
            @endif
        </div>
        <div class="card-body pt-4">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="font-weight-600 text-primary mb-4">{{ __('Hosting details') }}</h5>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Accommodation Type') }}</h6>
                        <p>{{ __($accommodation->accommodationtype->name) }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Ownership regime') }}</h6>
                        <p>{{ \App\Accommodation::getOwnershipTypes()[$accommodation->ownership_type] }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Hosting regime') }}</h6>
                        <p>{{ $accommodation->is_fully_available ? __('Full accommodation for guests') : __('The accommodation is independent or part of your home') }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Maximum guests number') }}</h6>
                        <p>{{ $accommodation->max_guests }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Available rooms') }}</h6>
                        <p>{{ $accommodation->available_rooms }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Available beds') }}</h6>
                        <p>{{ $accommodation->available_beds }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Available bathrooms') }}</h6>
                        <p>{{ $accommodation->available_bathrooms }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Allow the use of the kitchen of the accommodated guests') }}
                            ?</h6>
                        <p>{{ $accommodation->is_kitchen_available ? __('Yes') : __('No') }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('The hosts can benefit from a parking space') }}?</h6>
                        <p>{{ $accommodation->is_parking_available ? __('Yes') : __('No') }}</p>
                    </div>
                    <h5 class="font-weight-600 text-primary mb-4 mt-4">{{ __('House rules') }}</h5>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Smoking is allowed in the house') }}?</h6>
                        <p>{{ $accommodation->is_smoking_allowed ? __('Yes') : __('No') }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Pets are allowed in the house') }}?</h6>
                        <p>{{ $accommodation->is_pet_allowed ? __('Yes') : __('No') }}</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h5 class="font-weight-600 text-primary mb-4">{{ __('Accommodation photos') }}</h5>
                    @if(!empty($photos))
                        <div class="gallery d-flex flex-wrap mb-4">
                            @foreach($photos as $photo)
                                <a href="{{ $photo }}" data-toggle="lightbox"><img src="{{ $photo }}" alt="photo"
                                                                                   class="img-fluid"></a>
                            @endforeach
                        </div>
                    @else
                        N/A
                    @endif
                    <h5 class="font-weight-600 text-primary mb-4">{{ __('Available facilities') }}</h5>
                    @if (!empty($generalFacilities->count()))
                        <div class="kv">
                            <h6 class="font-weight-600 mb-2">{{ __('What facilities does the accommodation have') }}
                                ?</h6>
                            <ul class="list-unstyled list-custom gray-bullets">
                                @foreach($generalFacilities as $generalFacility)
                                    <li>{{ __($generalFacility->name) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (!empty($specialFacilities->count()))
                        <div class="kv">
                            <h6 class="font-weight-600 mb-2">{{ __('What special facilities does the accommodation space have') }}
                                ?</h6>
                            <ul class="list-unstyled list-custom gray-bullets">
                                @foreach($specialFacilities as $specialFacility)
                                    <li>{{ __($specialFacility->name) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (!empty($otherFacilities))
                        <div class="kv">
                            <h6 class="font-weight-600 mb-2">{{ __('What other facilities does the accommodation have') }}
                                ?</h6>
                            <ul class="list-unstyled list-custom gray-bullets">
                                <li>{{ __('test') }}</li>
                            </ul>
                        </div>
                    @endif
                    <h5 class="font-weight-600 text-primary mb-4 mt-4">{{ __('Accommodation address') }}</h5>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Accommodation exact address') }}</h6>
                        <p>{{ $accommodation->getDisplayedAddress() }}</p>
                    </div>
                    <h5 class="font-weight-600 text-primary mb-4 mt-4">{{ __('Transport accessibility (distance in meters)') }}</h5>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('The nearest metro station') }}:</h6>
                        <p>{{ $accommodation->transport_subway_distance ?? 'N/A' }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('The nearest bus stop') }}:</h6>
                        <p>{{ $accommodation->transport_bus_distance ?? 'N/A' }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Nearest train station') }}:</h6>
                        <p>{{ $accommodation->transport_railway_distance ?? 'N/A' }}</p>
                    </div>
                    <div class="kv">
                        <h6 class="font-weight-600 mb-1">{{ __('Other transport specifications') }}:</h6>
                        <p>{{ $accommodation->transport_other_details ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <h5 class="font-weight-600 text-primary mb-4 mt-4">{{ __('Description') }}</h5>
                    <p>{!! $accommodation->description ?? 'N/A' !!}</p>
                </div>
            </div>

            <div class="border-top pt-3 mt-4">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="font-weight-600 text-primary mb-4 mt-4">{{ __('Accommodation availability') }}</h5>
                        <div class="kv">
                            <h6 class="font-weight-600 mb-1">{{ __('Availability') }}</h6>
                            @forelse ($availabilityIntervals as $interval)
                                <p>
                                    {{ substr($interval->from_date, 0, 10) . ' - ' . substr($interval->to_date, 0, 10) }}
                                </p>
                            @empty
                                <p>N/A</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ ucwords(__('Leave a rating')) }}
            </h6>
        </div>

        @if ($accommodation->reviewedByUser())
            <div class="card-body pt-4 no-review">
                <div class="row">
                    <h5>{{__('A review has already been submitted. Thank you!')}}</h5>
                </div>
            </div>
        @else
            <div class="card-body pt-4">
                <div class="row">
                    <h3>{{__('Leave a review')}}</h3>
                    <form method="POST" action="{{route('refugee.accommodation.review', ['accommodation' => $accommodation])}}" class="submit_review">
                        @csrf
                        <div class="form-section">
                        <textarea name="review"
                                  id="review"
                                  class="form-control"
                                  minlength="5"
                                  maxlength="65000"
                        ></textarea>
                            @error('review')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-section rating-wrapper">
                            <input type="number" hidden  name="rating" id="rating" value=0>
                            <div class="rating"></div>
                            @error('rating')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-section cta">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </section>
@endsection

@section('styles')
    <style>
        .submit_review {
            width: 100%;
        }

        .submit_review .cta {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .submit_review .cta .btn {
            flex: 1;
            align-content: center;
            max-width: 300px;
            margin-top: 15px;
        }

        .rating {
            padding: 15px 0 5px;
        }

        .form-section textarea {
            width: 100%;
            min-width: 50px;
            max-width: 100%;
            min-height: 150px;
        }

        .invalid-feedback {
            display: block;
        }

        .rating-wrapper {
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .rating-wrapper .invalid-feedback {
            flex: 1;
            text-align: center;
        }

        .card-body.no-review .row h5{
            width: 100%;
            text-align: center;;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{ mix('js/star-rating.js')}}"></script>

    <script>
        const rating      = $('.rating'),
              ratingInput = $('#rating');

        rating.starRating({
            starIconEmpty : 'fa fa-star',
            starIconFull  : 'fa fa-star',
            starColorEmpty: 'lightgray',
            starColorFull : 'orange',
            starSize      : 25,
            stars         : 5,
            showInfo      : false,
            wrapperClasses: ''
        });

        rating.change(function (e, stars, index) {
            ratingInput.val(stars)
        })
    </script>
@endsection
