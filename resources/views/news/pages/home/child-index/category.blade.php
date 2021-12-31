@foreach ( $itemsCategory as $item)
    @if ($item['display'] == 'list')
        @include('news.pages.home.child-index.category_list',['item'=>$item])
    @elseif ($item['display'] == 'grid')
        @include('news.pages.home.child-index.category_grid',['item'=>$item])
    @endif
@endforeach