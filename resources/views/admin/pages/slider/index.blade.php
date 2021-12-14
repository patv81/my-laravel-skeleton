
@extends('admin.main')


<?php 
use App\Helpers\Template;
$filterBtns = Template::showBtnFilter($controllerName,$itemsStatusCount,$params['filter']['status'],$params['search']);
$areaSearch = Template::showAreaSearch($controllerName,$params['search']);
?>
@section('content')
<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>Danh sách User</h3>
    </div>
    <div class="zvn-add-new pull-right">
        <a href="/form" class="btn btn-success"><i
                class="fa fa-plus-circle"></i> Thêm mới</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.template.x_title',['title'=>'Bộ lọc'])
            <div class="x_content">
                <div class="row">
                    <div class="col-md-6">
                       {!! $filterBtns !!}
                    </div>
                    <div class="col-md-6">
                        {!! $areaSearch !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.template.x_title',['title'=>'Danh sách'])
            @include('admin.pages.slider.list')
        </div>
    </div>
</div>
@if (count($items) > 0)
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.template.x_title',['title'=>'Phân trang'])
            @include('admin.template.pagination')
        </div>
    </div>
</div>
@endif
@endsection