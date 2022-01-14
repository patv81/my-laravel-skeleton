

@extends('news.main')
@section('content')
<!-- Content Container -->
<div class="section-category">
        @include('news.block.breadcrumb',['item'=>['name'=>$title]])
        <div class="content_container container_category">
            <div class="featured_title">
                <div class="container">
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-lg-8">
                            <div class="posts">
                                @include('news.pages.rss.child-index.list',['item'=>$items])
                            </div>
                        </div>
                        <!-- Sidebar -->
                        <div class="col-lg-4">
                            <div class="sidebar">
                                <!--GOld Box -->
                                @include('news.pages.rss.child-index.box-gold',['items'=>$itemsGold])
                                <!--Coin Box -->
                                @include('news.pages.rss.child-index.box-coin',['items'=>$itemsGold])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection