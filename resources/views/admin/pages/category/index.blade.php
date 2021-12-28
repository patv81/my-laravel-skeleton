
@extends('admin.main')


<?php 
        echo '<pre>' ;
        print_r($params); 
        echo'</pre>';
use App\Helpers\Template;
$filterStatusBtns = Template::showBtnFilter($controllerName,$itemsStatusCount,$params['filter']['status'],$params['search']);
$areaSearch = Template::showAreaSearch($controllerName,$params['search']);
?>
@section('content')
    @include('admin.template.page_header',['pageIndex'=>true])
    @include('admin.template.zvn_notify')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.template.x_title',['title'=>'Bộ lọc'])
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-6">
                        {!! $filterStatusBtns !!}
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
                @include('admin.pages.category.list')
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