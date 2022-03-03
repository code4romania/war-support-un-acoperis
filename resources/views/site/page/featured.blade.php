@section('content')
    <section class="py-5">
        <div class="container">
            <div class="accordion-1 request-services">
                {!! $item->renderBlocks() !!}
            </div>
        </div>
    </section>
@endsection


