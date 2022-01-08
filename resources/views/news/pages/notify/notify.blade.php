





@extends('news.main')
@section('content')
<!-- Content Container -->
<div class="section-category">
        <div class="content_container container_category">
            <div class="featured_title">
                <div class="container">
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-lg-9">
                            <div class="single_post">
                                <h2>Bạn không có quyền truy cập</h2>
                            </div>
                        </div>
                        <!-- Sidebar -->
                        <div class="col-lg-3">
                            <div class="sidebar">
                                <!-- Latest Posts -->
                                @include('news.block.lasted_post',['items'=>$itemsLatest])
                                <!-- Advertisement -->
                                <!-- Extra -->
                                @include('news.block.advertisement')
                                <!-- Most Viewed -->
                                @include('news.block.most_views')
                                <!-- Tags -->
                                @include('news.block.tags')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection