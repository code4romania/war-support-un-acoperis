<section class="page-title  d-flex align-items-center" style="background: url({{ $item->image('cover', 'desktop') }})  no-repeat cover center center;">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="container">
        <h1 class="text-white font-weight-600 text-center">{{ $item->title  }}</h1>
    </div>
</section>
<section class="partners py-5">
    <div class="container">
        {!! $item->renderBlocks() !!}
    </div>
</section>
