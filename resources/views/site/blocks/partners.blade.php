<h2 class="font-weight-600 mb-5">{{ $block->input('title') }}</h2>
<div class="row">
    @php
        $partners = \App\Models\Partner::whereIn('id', $block->browserIds('partners'))->get();
    @endphp
    @foreach ($partners as $partner)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-lg--hover">
                <div class="logo-container">
                    <a href="">
                        <img src="{{ $partner->image('logo', 'desktop') }}">
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-title font-weight-600">
                        <a href="{{ $partner->url }}">{{ $partner->title }}</a>
                    </h6>
                    <p class="mb-0 text-muted">{!! $partner->description !!}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
