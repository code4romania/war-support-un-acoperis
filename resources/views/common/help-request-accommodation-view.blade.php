<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-block mt-4 btn-round" data-toggle="modal" data-target="#hostDetailModal">
    {{__('See your host')}}
</button>

<!-- Modal -->
<div class="modal fade" id="hostDetailModal" tabindex="-1" role="dialog" aria-labelledby="hostDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hostDetailModalLabel">{{__('Host Detail')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('common.accommodation.accommodation-list-item', ['smcol' => 12 ])
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
