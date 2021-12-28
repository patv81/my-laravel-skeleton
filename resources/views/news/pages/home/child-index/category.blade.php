@foreach ( $itemsCategory as $item)
    @if ($val['display'] == 'list')
        @include('news.pages.home.child-index.category_list')
    @elseif ($val['display'] == 'grid')
        @include('news.pages.home.child-index.category_grid')
    @endif
@endforeach