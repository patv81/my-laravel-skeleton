
<div class="row posts">
    <div class="col-lg-12">
        <div class="row">
            @foreach($items as $item)
            <div class="col-lg-6">
                <div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
                    @php
                        $name = $item['title'];
                        $thumb = $item['thumb'];
                        $linkArticle = $item['link'];
                        $created = $item['pubDate'];
                        $content = $item['description'];
                    @endphp
                    <div class="post_image"><img src="{{ $thumb }}"
                                alt="{{ $name }}"
                                class="img-fluid w-100"></div>
                    
                    <div class="post_content">
                        <div class="post_title"><a
                                href="{{ $linkArticle }}">
                            {{ $name }}</a></div>
                        <div class="post_info d-flex flex-row align-items-center justify-content-start">
                            <div class="post_date"><a href="#">{{ $created }}</a></div>
                        </div>
                        <div class="post_text">
                            <p>
                                {!! $content !!}
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            @endforeach
        </div>
        <div class="row">
            <div class="home_button mx-auto text-center"><a href="the-loai/so-hoa-6.html">Xem
                thêm</a></div>
        </div>
    </div>
</div>
