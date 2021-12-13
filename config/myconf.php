<?php 
return [
    'url'=>[
        'prefixAdmin' => 'admin123',
        'prefixNews' => 'news',
    ],
    'format'=>[
        'long_time' =>'H:m:s d/m/Y', 
        'short_time'=>'d/m/Y',
    ],
    'template'=>[
        'status'=>[
            'default'=>['name'=>'Chưa xác định','class'=>'btn-success'],
            'all'=>['name'=>'Tất cả','class'=>'btn-success'],
            'active'=>['name'=>'Kích hoạt','class'=>'btn-success'],
            'inactive'=>['name'=>'Chưa kích hoạt','class'=>'btn-info']
        ]
    ],
];