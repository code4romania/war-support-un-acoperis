@if ($partnersBlock)
<ul class="d-flex list-unstyled flex-column flex-sm-row justify-content-center align-items-center mt-3 mb-6">
    @php
        $partners = \App\Models\Partner::whereIn('id', $partnersBlock->browserIds('partners'))->orderBy('position')->get();
    @endphp
    @foreach ($partners as $partner)
    <li class="mx-5">
        <a href="{{ $partner->url }}" class="nav-link text-white d-flex align-items-center mb-4 mb-sm-0" title="{{ $partner->title }}">
            {{ $partner->homepage_title }}
            <img src="{{ $partner->image('logo', 'desktop') }}" height="@if($partner->id == 1 ) 36 @endif @if($partner->id == 2) 28 @endif @if($partner->id == 3) 36 @endif" alt="{{ $partner->title }}" class="ml-5 align-middle">
        </a>
    </li>
    @endforeach

</ul>
@endif
