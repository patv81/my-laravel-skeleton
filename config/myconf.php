<?php 
return [
    'url'=>[
        'prefixAdmin' => 'admin123',
        'prefixNews' => 'news321',
    ],
    'format'=>[
        'long_time' =>'H:m:s d/m/Y', 
        'short_time'=>'d/m/Y',
    ],
    'template'=>[
        'form_ckeditor'=>[
            'class'=>'form-control col-md-6 col-xs-12 ckeditor'
        ],
        'form_input' => [
            'class'=>'form-control col-md-6 col-xs-12'
        ],
        'form_label'=>[
            'class'=>'control-label col-md-3 col-sm-3 col-xs-12'
        ],
        'status'=>[
            'default'=>['name'=>'Chưa xác định','class'=>'btn-success'],
            'all'=>['name'=>'Tất cả','class'=>'btn-success'],
            'active'=>['name'=>'Kích hoạt','class'=>'btn-success'],
            'inactive'=>['name'=>'Chưa kích hoạt','class'=>'btn-info']
        ],
        'is_home'=>[
            '1'=>['name'=>'Hiển thị',                 'class'=>'btn-primary'],
            '0'=> ['name'=>'Không hiển thị',           'class'=>'btn-warning'],
        ],
        'display'=>[
            'list'=>['name'=>'1 cột'],
            'grid'=>['name'=>'2 cột'],
        ],
        'level'=>[
            'admin'=>['name'=>'quản trị viên'],
            'member'=>['name'=>'thành viên'],
        ],
        'type'=>[
            'feature'=>['name'=>'nổi bật'],
            'normal'=>['name'=>'bình thường'],
        ],
        'rss_source'=>[
            'tuoitre'=>['name'=>'Tuổi trẻ'],
            'vnexpress'=>['name'=>'VNExpress'],
            'thanhnien' =>['name'=>'Thanh niên'],
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
            'level'       => ['name' => 'Search by Level'],
            
        ],
        'button'=>[
            'delete'=>['class'=>'btn-danger btn-delete','icon'=>'fa-trash','title'=>'Delete','route-name'=>"/delete"],
            'edit'=>['class'=>'btn-success','icon'=>'fa-pencil','title'=>'Edit','route-name'=>"/form"],
        ],
    ],
    'config'=>[
        'search'=>[
            'default'   =>['all','id'],
            'slider'    =>['all','id','description','link','name'],
            'category'    =>['all','id'],
            'article'    =>['all','name','content'],
            'user'    => ['all', 'username', 'email','level','fullname'],
            'rss'    => ['all', 'name','link'],
        ],
        'button'=>[
            'slider'=>['delete','edit'],
            'default'=>['delete','edit'],
            'category'=>['delete','edit'],
            'article'=>['delete','edit'],
            'user' => ['delete', 'edit'],
            'rss' => ['delete', 'edit'],
        ],
    ],
];