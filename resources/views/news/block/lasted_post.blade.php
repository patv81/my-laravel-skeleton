@php
    use App\Helpers\Template;
    use App\Helpers\URL;

@endphp
<div class="sidebar_latest">
    <div class="sidebar_title">Bài viết gần đây</div>
    <div class="latest_posts">
        @foreach($items as $item)
            <!-- Latest Post -->
            @php
                $thumb = $item['thumb'];
                $category_name = $item['category_name'];
                $name = $item['name'];
                $linkCategory=URL::linkCategory($item['category_id'],$item['category_name']);
                $linkArticle = '#';
                $author = 'patv';
                $created = Template::showDatetimeFrontend($item['created']);
            @endphp
            <div class="latest_post d-flex flex-row align-items-start justify-content-start">
                <div>
                    <div class="latest_post_image"><img src="{{ asset('images/article/'.$thumb) }}"
                                                        alt="{{ $name }}">
                    </div>
                </div>
                <div class="latest_post_content">
                    <div class="post_category_small cat_video"><a href="{{ $linkCategory }}">
                        {{ $category_name }}</a></div>
                    <div class="latest_post_title"><a
                            href="{{ $linkArticle }}"> 
                        {{ $name }}</a></div>
                    <div class="latest_post_date">$created</div>
                </div>
            </div>
        @endforeach
    </div>
</div>