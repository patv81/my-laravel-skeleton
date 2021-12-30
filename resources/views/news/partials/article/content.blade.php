@php
    use App\Helpers\Template;
    $category_name = $item['category_name'];
    $name = $item['name'];
    $linkCategory='#';
    $linkArticle = '#';
    $author = 'patv';
    $created = Template::showDatetimeFrontend($item['created']);
    $content = Template::showContent($item['content'],$lengthContent);
@endphp
<div class="post_content">
    <div class="post_category cat_technology ">
        <a href="{{ $linkCategory }}">{{ $category_name }}</a>
    </div>
    <div class="post_title"><a
            href="{{ $linkArticle }}">
        {{ $name }}</a></div>
    <div class="post_info d-flex flex-row align-items-center justify-content-start">
        <div class="post_author d-flex flex-row align-items-center justify-content-start">
            <div class="post_author_name"><a href="#">{{ $author }}</a>
            </div>
        </div>
        <div class="post_date"><a href="#">{{ $created }}</a></div>
    </div>
    @if ($lengthContent > 0)
        <div class="post_text">
            <p>{{ $content }}
            </p>
        </div>
    @endif
</div>