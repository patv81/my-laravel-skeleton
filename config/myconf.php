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
        ],
        'search'=>[
            'all'           =>['name'=>'Search by All'],
            'id'            =>['name'=>'Search by Id'],
            'name'          =>['name'=>'Search by Name'],
            'username'      =>['name'=>'Search by Username'],
            'fullname'      =>['name'=>'Search by Fullname'],
            'email'         =>['name'=>'Search by Email'],
            'description'   =>['name'=>'Search by Description'],
            'link'          =>['name'=>'Search by Link'],
            'content'       =>['name'=>'Search by Content'],
            
        ],
        'button'=>[
            'delete'=>['class'=>'btn-danger btn-delete','icon'=>'fa-trash','title'=>'Delete','route-name'=>"/delete"],
            'edit'=>['class'=>'btn-success','icon'=>'fa-pencil','title'=>'Edit','route-name'=>"/form"],
        ],
    ],
    'config'=>[
        'search'=>[
            'default'   =>['all','id'],
            'slider'    =>['all','id','description','link','name']
        ],
        'button'=>[
            'slider'=>['delete','edit'],
            'default'=>['delete','edit'],
        ],
    ],
];