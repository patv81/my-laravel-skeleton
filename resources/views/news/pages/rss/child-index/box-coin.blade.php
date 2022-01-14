<h3>Giá vàng</h3>
<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Tên</th>
            <th>Giá hiện tại</th>
            <th>Biến động 24h</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($itemsCoin as $item)
            @php
                $price = number_format($item['price'],2);
                $percent_change_24h = number_format($item['percent_change_24h'],5);
                $class='text-danger';
                if($percent_change_24h>=0){
                    $class='text-success';
                }
                $percent_change_24h= sprintf('<span class="%s">%s</span>',$class,$percent_change_24h);
            @endphp
        <tr>
            <th>{{ $item['name'] }}</th>
            <th>{{ $price }}</th>
            <th>{!! $percent_change_24h !!}</th>
        </tr>

        @endforeach
    </tbody>
</table>
