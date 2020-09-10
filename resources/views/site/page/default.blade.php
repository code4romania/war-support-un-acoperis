<div class="container my-5">
    <h1 class="display-3 title mb-4">{{ $item->title }}</h1>
    <div>
        {!! $item->renderBlocks() !!}
    </div>
</div>
