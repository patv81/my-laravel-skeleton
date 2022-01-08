@php
    use App\Helpers\URL;
    $linkCategory = URL::linkCategory($item['category_id'],$item['category_name']);
@endphp
<div class="home">
    <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('images/footer.jpg') }}" data-speed="0.8"></div>
    <div class="home_content_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="home_content">
                        <div class="home_title">{{ $item['name'] }}</div>
                        <div class="breadcrumbs">
                            <ul class="d-flex flex-row align-items-start justify-content-start">
                                <li><a href="{!! route('home') !!}">Trang chủ</a></li>
                                <li><a href="{!! $linkCategory !!}">{{ $item['category_name'] }}</a></li>
                                <li>{{ $item['name'] }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>