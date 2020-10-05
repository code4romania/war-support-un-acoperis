<h2 class="font-weight-600 mb-5">{{ $block->translatedinput('title') }}</h2>
<div class="row">
    @php
        $partners = \App\Models\Partner::whereIn('id', $block->browserIds('partners'))->get();
    @endphp
    @foreach ($partners as $partner)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card shadow-lg--hover">
                <div class="card-header logo-container">
                    <a href="{{ $partner->url }}" class="d-flex" style="height: 100px;">
                        <img src="{{ $partner->image('logo', 'desktop') }}" class="mx-auto my-auto" alt="{{ $partner->title }}" style="max-height: 115px;">
                    </a>
                </div>
                <div class="card-footer py-2 px-4" style="background-color: #22B0E5;">
                    <h6 class="card-title font-weight-600 m-0">
                        <a href="{{ $partner->url }}" class="text-white">{{ $partner->title }}</a>
                    </h6>
                </div>
            </div>
        </div>
    @endforeach
</div>
