<div class="info-box col-12">
    <h6 class="font-weight-600 mb-4">{!! $title !!}</h6>
    <p>{!! $text !!}</p>
    @if (isset($buttonText))
        <a class="btn btn-lg btn-secondary text-capitalize mt-3"
           href="{!! $buttonUrl !!}">{{ $buttonText }}</a>
    @endif
</div>
