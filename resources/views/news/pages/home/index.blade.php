

@extends('news.main')
@section('content')

@include('news.block.slider')
<!-- Content Container -->
<div class="content_container">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="main_content">
                    <!-- Featured -->
                    @include('news.block.featured')
                    <!-- Category -->
                    @include('news.pages.home.child-index.category')
                </div>
            </div>
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="sidebar">
                    <!-- Latest Posts -->
                    @include('news.block.lasted_post')
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

@endsection