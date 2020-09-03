@if ($partnersBlock)
<div class="d-flex justify-content-center align-items-center partners-logos justify-content-around flex-wrap flex-sm-nowrap">
    @php
        $partners = \App\Models\Partner::whereIn('id', $partnersBlock->browserIds('partners'))->orderBy('position')->get();
    @endphp
    @foreach ($partners as $partner)
        <div class="homepage-partner-card">
            <h5 class="homepage-partner-title" >{{ $partner->homepage_title }}</h5>
            <a href="{{ $partner->url }}" title="{{ $partner->title }}" target="_blank"><img class="fvr-logo" src="{{ $partner->image('logo', 'desktop') }}" alt="{{ $partner->title }}"></a>
        </div>
    @endforeach
</div>
@endif
