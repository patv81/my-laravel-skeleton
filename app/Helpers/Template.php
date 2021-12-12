<?php 
namespace App\Helpers;
use Config;
class Template{
    public static function showItemHistory($by,$time){
        $xhtml = sprintf('   <p><i class="fa fa-user"></i> %s</p>
                            <p><i class="fa fa-clock-o"></i> %s </p>',$by, date(Config::get('myconf.format.long_time'),strtotime($time)));
        return $xhtml;
    }
    public static function showItemStatus($controllerName,$id,$status){
        $link = route("$controllerName/status",['id'=>$id,'status'=>$status]);
        $tempStatus=[
            'active'    =>['class'  =>'btn-success',    'name'=>'Active'],
            'inactive'  =>['class'  =>'btn-danger',     'name'=>'Inactive'],
        ];
        $class = $tempStatus[$status]['class']; 
        $name = $tempStatus[$status]['name'];
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