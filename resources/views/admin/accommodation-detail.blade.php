@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title mb-3 font-weight-600">{{ __('Accommodation resource') }}</h6>
        <a href="{{ route('admin.accommodation-list') }}"
           class="btn btn-sm btn-outline-primary mr-3">{{ __('Back') }}</a>
    </section>
    @if(@auth()->user()->isAdministrator())
        @include('partials.forms.allocate-form')
    @endif
    <div class="card shadow">
        <div class="card-header bg-ad   min-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __('Accommodation resource') }} - {{ $user->name }}
            </h6>
            <a class="btn btn-white text-danger btn-sm px-4 delete-accommodation" href="#">{{ __('Delete') }}</a>
        </div>
        <div class="card-body">
            <h5 class="text-primary font-weight-600 mb-4">
                <a href="{{ route('admin.host-detail', ['id' => $user->id]) }}">{{ $user->name }}</a>
            </h5>
            <div class="row pb-3">
                <div class="col-sm">
                    <p class="mb-0">
                        <i class="fa fa-map-marker mr-2"></i> {{ __('Location') }}: <span
                            class="font-weight-600">{{ $accommodation->getDisplayedAddress() }}</span>
                    </p>
                </div>
                <div class="col-sm">
                    <p class="mb-0">
                        <i class="fa fa-phone mr-2"></i> {{ __('Phone Number') }}: <span
                            class="font-weight-600">{{ $user->phone_number ?? 'N/A' }}</span>
                    </p>
                </div>
                <div class="col-sm">
                    <p class="mb-0">
                        <i class="fa fa-envelope mr-2"></i> {{ __('Email') }}: <a href="mailto:dan.vintu@gmail.com"
                                                                                  class="font-weight-600">{{ $user->email ?? 'N/A' }}</a>
                    </p>
                </div>
                <div class="col-sm">
                    <p class="mb-0 text-sm-right">
                        <i class="fa fa-calendar mr-2"></i> {{ __('Date') }}: <span
                            class="font-weight-600">{{ $user->created_at->format('d.m.Y') }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                {{ __('Accommodation') }}
            </h6>
            @if(!$accommodation->isApproved())
                <a class="btn btn-primary"
                   href="{{ route('admin.accommodation-approve',['id'=>$accommodation->id])}}">{{__('Approve')}}</a>
            @else
                <a class="btn btn-primary"
                   href="{{ route('admin.accommodation-disapprove',['id'=>$accommodation->id])}}">{{__('Disprove')}}</a>
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

    <div class="card shadow">
        @include('partials.notes', [
            'notes' => $accommodation->notes,
            'entityType' => \App\Note::TYPE_HELP_ACCOMMODATION,
            'entityId' => $accommodation->id
        ])
    </div>

    <div class="card shadow">
        <div class="card-body">
            <h5 class="font-weight-600 text-primary mb-4">Rezervari</h5>
            <div class="row align-items-center mb-4">
                <div class="col">
                    <h6 class="font-weight-600 mb-0">{{ __('Total Results') }}: <span id="totalResults"></span></h6>
                </div>
                <div class="col d-none d-sm-block">
                    <nav aria-label="...">
                        <ul class="pagination justify-content-center mb-0"></ul>
                    </nav>
                </div>
                <div class="col d-none d-sm-block">
                    <div class="form-inline justify-content-end">
                        <div class="form-group">
                            <label class="mr-3">{{ __('Results per page') }}</label>
                            <select class="custom-select form-control form-control-sm resultsPerPage">
                                <option value="1">1</option>
                                <option value="15">15</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive shadow-sm mb-4">
                <table class="table table-striped w-100 mb-0">
                    <thead class="thead-dark">
                    <tr>
                        <th>{{ __('Refugee name') }}</th>
                        <th>{{ __('Number of quests') }}</th>
                        <th>{{ __('Allocation date') }}</th>
                        <th>{{ __('Updated at') }}</th>
                        <th class="text-right">{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody id="tableBody">
                    </tbody>
                </table>
            </div>
            <div class="row align-items-center mb-4 flex-column flex-sm-row text-center text-sm-left">
                <div class="col offset-sm-4 mb-4 mb-sm-0">
                    <nav aria-label="...">
                        <ul class="pagination justify-content-center mb-0"></ul>
                    </nav>
                </div>
                <div class="col">
                    <div class="form-inline justify-content-center justify-content-sm-end">
                        <div class="form-group">
                            <label for="" class="mr-3">{{ __('Results per page') }}</label>
                            <select name="" id="" class="custom-select form-control form-control-sm resultsPerPage">
                                <option value="1">1</option>
                                <option value="15">15</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmare stergere cazare -->
    <div class="modal fade bd-example-modal-sm" id="deleteAccommodationModal" tabindex="-1" role="dialog"
         aria-hidden="true">
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
                    <button type="button" class="btn btn-link text-dark" data-dismiss="modal"
                            id="cancel">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-secondary"
                            id="proceedDeleteAccommodation">{{ __('Yes') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('js/table-data-renderer.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <script>
        class AccommodationRenderer extends TableDataRenderer {
            renderTable(responseData) {
                this.emptyTable();

                $.each(responseData, function (key, value) {
                    let row = '<tr>\n' +
                        '    <td>' + value.name + '</td>\n' +
                        '    <td>' + value.number_of_guest + '</td>\n' +
                        '    <td>' + value.created_at + '</td>\n' +
                        '    <td>' + value.updated_at + '</td>\n' +
                        '    <td class="text-right">\n' +
                        '        <a href="/admin/help-request/' + value.id + '#helpTypeCard{{ \App\HelpType::TYPE_ACCOMMODATION }}" class="btn btn-sm btn-info mb-2 mb-sm-0" >Detalii cerere de ajutor</a>\n' +
                        '    </td>\n' +
                        '</tr>';
                    $('#tableBody').append(row);
                });
            }
        }

        $(document).ready(function () {
            let pageState = {};
            pageState.page = 1;
            pageState.perPage = 15;

            if (undefined !== $.QueryString.page) {
                pageState.page = $.QueryString.page;
            }

            if (undefined !== $.QueryString.perPage && -1 !== $.inArray($.QueryString.perPage, ["1", "15", "50", "100"])) {
                pageState.perPage = $.QueryString.perPage;
            }

            $('.resultsPerPage').val(pageState.perPage);

            let renderer = new AccommodationRenderer('{{ route('ajax.accommodation-requests', [ 'id' => $accommodation->id ]) }}');
            renderer.renderData(pageState);

            $('.resultsPerPage').on('change', function () {
                $('.resultsPerPage').val(this.value);
                pageState.perPage = this.value;
                $.SetQueryStringParameter('perPage', pageState.perPage);
                pageState.page = 1;
                $.SetQueryStringParameter('page', pageState.page);

                renderer.renderData(pageState);
            });

            $('body').on('click', 'a.page-link', function (event) {
                event.preventDefault();
                pageState.page = $(this).data('page');
                $.SetQueryStringParameter('page', pageState.page);
                renderer.renderData(pageState);
            });

            $(document).on('click', '[data-toggle="lightbox"]', function (event) {
                event.preventDefault();
                $(this).ekkoLightbox({});
            });

            $('.delete-accommodation').on('click', function (event) {
                event.preventDefault();
                $('#deleteAccommodationModal').modal('show');
            });

            $('#proceedDeleteAccommodation').on('click', function () {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';

                axios
                    .delete('/admin/ajax/accommodation/{{ $accommodation->id }}')
                    .then(response => {
                        $('#deleteAccommodationModal').modal('hide');

                        window.location.replace('{{ route('admin.accommodation-list') }}');
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });
        });
    </script>
@endsection
