@extends('layouts.admin')

@section('content')
    <section class="mb-5">
        <h6 class="page-title font-weight-600 mb-3">{{ __('Accommodation') }}</h6>
    </section>

    <div class="card shadow">
        <div class="card-header bg-admin-blue py-3 d-flex justify-content-between align-content-center rounded">
            <h6 class="font-weight-600 text-white mb-0">
                {{ trans_choice('Accommodation places', $accommodations->total(), ['value' => $accommodations->total()]) }}
            </h6>
            <a class="btn btn-secondary btn-sm px-4" href="{{ route('host.add-accommodation') }}">{{ __('Add accommodation') }}</a>
        </div>
    </div>

    <div class="alert bg-white text-dark d-flex align-items-center shadow-sm mb-4">
        <span class="alert-inner--icon mr-3"><i class="fa fa-info-circle"></i></span>
        <span class="alert-inner--text font-weight-600">{{ __('You can add one or more accommodation to offer to people who need help!') }}</span>
    </div>

    <div class="card-deck accomodation-list row rows-2">
        @foreach($accommodations->items() as $accommodation)
            @include('common.accommodation.accommodation-list-item')
        @endforeach
    </div>

    <div class="mt-4">
        <nav aria-label="...">
            <ul class="pagination justify-content-center mb-0"></ul>
        </nav>
    </div>

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
                    <button type="button" class="btn btn-secondary" id="proceedDeleteAccommodation">{{ __('Yes') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        class AccommodationRenderer {
            renderPagination(response) {
                $('.pagination li').remove();

                if (1 === response.last_page) {
                    return;
                }

                let morePages = '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';

                let currentPage = '<li class="page-item active"><a class="page-link" data-page="' + response.current_page + '" href="{{ route('host.accommodation') }}/'+response.current_page+'">' + response.current_page + ' <span class="sr-only">(current)</span></a></li>';

                let firstPage = '';
                if (response.current_page > 1) {
                    firstPage = '<li class="page-item"><a class="page-link" data-page="1" href="{{ route('host.accommodation') }}/1">1</a></li>';
                }

                let step = response.current_page
                let counter = 0;

                let previousPages = '';
                while(step > 2 && 2 > counter) {
                    counter++;
                    step--;
                    previousPages = '<li class="page-item"><a class="page-link" data-page="' + step + '" href="{{ route('host.accommodation') }}/'+ step +'">' + step + '</a></li>' + previousPages;
                }

                if (response.current_page > 4) {
                    previousPages = morePages + previousPages;
                }

                step = response.current_page;
                counter = 0;

                let nextPages = '';
                while(step < response.last_page - 1 && 2 > counter) {
                    counter++;
                    step++;
                    nextPages += '<li class="page-item"><a class="page-link" data-page="' + step + '" href="{{ route('host.accommodation') }}/'+ step +'">' + step + '</a></li>';
                }

                if ((response.last_page - response.current_page) > 3) {
                    nextPages += morePages;
                }

                let lastPage = '';
                if (response.current_page < response.last_page) {
                    lastPage = '<li class="page-item"><a class="page-link" data-page="' + response.last_page + '" href="{{ route('host.accommodation') }}/'+response.last_page+'">' + response.last_page + '</a></li>';
                }

                $('.pagination').append(firstPage).append(previousPages).append(currentPage).append(nextPages).append(lastPage);
            }
        }

        $(document).ready(function () {
            renderer = new AccommodationRenderer;
            renderer.renderPagination({!! json_encode($accommodations->toArray()) !!});

            let selectedAccommodation = null;

            $('.delete-accommodation').on('click', function(event) {
                event.preventDefault();
                selectedAccommodation = $(this).data('id');
                $('#deleteAccommodationModal').modal('show');
            });

            $('#proceedDeleteAccommodation').on('click', function() {
                $('#deleteAccommodationModal').modal('hide');
                window.location.href = '/host/accommodation/'+selectedAccommodation+'/delete';
            });
        });
    </script>
@endsection
