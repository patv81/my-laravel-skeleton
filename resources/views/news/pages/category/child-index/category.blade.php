
@if ($item['display'] == 'list')
    @include('news.pages.category.child-index.category_list',['item'=>$item])
@elseif ($item['display'] == 'grid')
    @include('news.pages.category.child-index.category_grid',['item'=>$item])
@endif
