<?php 
namespace App\Helpers;
use Config;
class Template{
    public static function showBtnFilter($controllerName,$itemsStatusCount,$currentFilterStatus){
        $xhtml='';
        $tmplStatus=Config::get('myconf.template.status');
        if (count($itemsStatusCount)>0){
            array_unshift($itemsStatusCount,[
                'status'=>'all',
                'count' => array_sum(array_column($itemsStatusCount,'count'))
            ]);
            foreach($itemsStatusCount as $item){
                $statusValue = $item['status'];
                $statusValue = array_key_exists($statusValue,$tmplStatus) ? $statusValue : 'default';
                $currentStatus = $tmplStatus[$statusValue];

                $class = $currentFilterStatus == $statusValue ? 'btn-primary' : 'btn-info';
                $link = route($controllerName).'?filter_status='.$statusValue;
                $xhtml.=sprintf('<a href="%s" type="button" class="btn %s">
                    %s <span class="badge bg-white">%s</span></a>',$link,$class,$currentStatus['name'],$item['count']);
            }
        }
    
        return $xhtml;    
    }
            // <a href="?filter_status=all" type="button" class="btn btn-primary">
            //     All <span class="badge bg-white">4</span>
            // </a>
            // <a href="?filter_status=active" type="button" class="btn btn-success">
            //     Active <span class="badge bg-white">2</span>
            // </a>
            // <a href="?filter_status=inactive" type="button" class="btn btn-success">
            //     Inactive <span class="badge bg-white">2</span>
            // </a>
    public static function showItemHistory($by,$time){
        $xhtml = sprintf('   <p><i class="fa fa-user"></i> %s</p>
                            <p><i class="fa fa-clock-o"></i> %s </p>',$by, date(Config::get('myconf.format.long_time'),strtotime($time)));
        return $xhtml;
    }
    public static function showItemStatus($controllerName,$id,$status){
        $link = route("$controllerName/status",['id'=>$id,'status'=>$status]);
        $tmplStatus = Config::get('myconf.template.status');
        // $tmplStatus=[
        //     'active'    =>['class'  =>'btn-success',    'name'=>'Active'],
        //     'inactive'  =>['class'  =>'btn-danger',     'name'=>'Inactive'],
        // ];
        $class = $tmplStatus[$status]['class']; 
        $name = $tmplStatus[$status]['name'];
        $xhtml=sprintf('<a href="%s"
                        type="button" class="btn btn-round %s">%s</a>',$link,$class,$name); 
        return $xhtml;    
    }
    public static function showItemThumb($controllerName,$thumbName,$alt)
    {
        $xhtml = sprintf('<img src="%s" alt="%s" class="zvn-thumb">',asset("images/$controllerName/$thumbName"), $alt );
        return $xhtml;
        // return "123";
    }
    public static function showItemAction($controllerName,$id){
        $typeBtn=[
            'delete'=>['class'=>'btn-danger btn-delete','icon'=>'fa-trash','title'=>'Delete','route-name'=>"$controllerName/delete"],
            'edit'=>['class'=>'btn-success','icon'=>'fa-pencil','title'=>'Edit','route-name'=>"$controllerName/form"],
        ];
        $typeController =[
            'slider'=>['delete','edit'],
            'default'=>['delete','edit'],
        ];
        $controllerName = array_key_exists($controllerName,$typeController) ? $controllerName :'default';
        $listBtn = $typeController[$controllerName];
        $xhtml='<div class="zvn-box-btn-filter">';
        foreach($listBtn as $btn){
            $currentBtn = $typeBtn[$btn];
            $link = route($currentBtn['route-name'],['id'=>$id]);
            $xhtml.= sprintf('<a href="%s" type="button" class="btn btn-icon %s" data-toggle="tooltip"
                            data-placement="top" data-original-title="%s">
                            <i class="fa %s"></i>
                            </a>',$link,$currentBtn['class'],$currentBtn['title'],$currentBtn['icon']);
        }
        $xhtml.= '</div>';
        return $xhtml;
    }

// <div class="zvn-box-btn-filter"><a
//         href="/form/1"
//         type="button" class="btn btn-icon btn-success" data-toggle="tooltip"
//         data-placement="top" data-original-title="Edit">
//     <i class="fa fa-pencil"></i>
// </a><a href="/delete/1"
//         type="button" class="btn btn-icon btn-danger btn-delete"
//         data-toggle="tooltip" data-placement="top"
//         data-original-title="Delete">
//     <i class="fa fa-trash"></i>
// </a>
// </div>
}