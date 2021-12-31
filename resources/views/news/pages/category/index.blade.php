

@extends('news.main')
@section('content')
<!-- Content Container -->
<div class="section-category">
        @include('news.block.breadcrumb')
        <div class="content_container container_category">
            <div class="featured_title">
                <div class="container">
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-lg-9">
                            <div class="posts">
                                @include('news.pages.category.child-index.category',['item'=>$itemCategory])
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