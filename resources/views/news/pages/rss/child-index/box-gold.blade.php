<h3>Giá vàng</h3>
<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Loại vàng</th>
            <th>Mua vào</th>
            <th>Bán ra</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($itemsGold as $item)
        <tr>
            <th>{{ $item['type'] }}</th>
            <th>{{ $item['buy'] }}</th>
            <th>{{ $item['sell'] }}</th>
        </tr>

        @endforeach
    </tbody>
</table>
