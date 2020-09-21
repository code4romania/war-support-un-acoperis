<div class="card shadow-sm{{ !empty($last) ? ' mb-0' : '' }}" id="Chart{{ $id }}">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="mb-0">
            {{ $title }}
        </h6>
        <div class="actions text-sm-right w-50">
            <div class="form-group d-inline-block mr-2 mb-sm-0">
                <select class="interval-select custom-select form-control form-control-sm">
                    <option value="days" selected>ultimele 14 zile</option>
                    <option value="mixed">anul curent (YTD)</option>
                    <option value="months">ultimele 12 luni</option>
                </select>
            </div>
{{--            <a href="" class="btn btn-sm btn-primary">Export Raport</a>--}}
        </div>
    </div>
    <div class="card-body">
        <canvas id="myChart" width="100%" height="25" class="img-fluid"></canvas>
    </div>
</div>

@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            let theChart = initChart('{{ $id }}');

            $('#Chart{{ $id }} .interval-select').on('change', function() {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';

                axios
                    .get('{{ @route('ajax.chart') }}', { params: { type: '{{ $type }}', interval: $(this).val() } })
                    .then(response => {
                        updateChart(theChart, response.data.labels, response.data.values)
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });

            $('#Chart{{ $id }} .interval-select').trigger('change');
        });
    </script>
@endsection
