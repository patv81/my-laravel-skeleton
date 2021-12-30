@php
    $thumb = $item['thumb'];
    $name = $item['name'];
@endphp
<div class="post_image"><img src="{{ asset('images/article/'.$thumb) }}"
                                alt="{{ $name }}"
                                class="img-fluid w-100"></div>