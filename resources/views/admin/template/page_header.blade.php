@php
    $pageTile='Quản lý '. $controllerName;
    $link=route($controllerName);
    $pageButton=sprintf('<a href="%s" class="btn btn-success"><i
                class="fa fa-arrow-left"></i> Quay về</a>',$link);
    if ($pageIndex==true){
        $link=route($controllerName).'\form';
        $pageButton=sprintf('<a href="%s" class="btn btn-success"><i
                class="fa fa-plus-circle"></i> Thêm mới</a>',$link);
    }
@endphp
<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>{{ $pageTile }}</h3>
    </div>
    <div class="zvn-add-new pull-right">
        {!! $pageButton !!}
    </div>  
</div>