@if(count($page->blocks))
    @foreach($page->blocks as $block)
        <div class="grid grid-with-row-margin stackable center-vertical-and-horizontal layout-{{ $block->layout }}">
            @if($block->layout == 'left')
                <div class="col-desk-5 text-center">
                    @if (isset($block->image_url))
                        <img src="https://admin.ecomobilis.be/storage/{{ $block->image_url }}" class="size-90 rounded" style="margin-top:10px; margin-right: 15%;">
                    @endif
                </div>
            @endif

            <div class="col-desk-7 @if($block->layout == 'none') center-the-column @endif">
                <div class="center-next-to-photo">
                    <h2>
                        {!! $block->title !!}
                    </h2>
                    {!! $block->body !!}
                </div>
            </div>

            @if($block->layout == 'right' )
                <div class="col-desk-5  text-center">
                    @if (isset($block->image_url))
                        <img src="https://admin.ecomobilis.be/storage/{{ $block->image_url }}" class="size-90 rounded" style="margin-top:10px; margin-left: 15%;">
                    @endif
                </div>
            @endif
        </div>
    @endforeach
@endif
