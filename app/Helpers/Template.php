<?php 
namespace App\Helpers;
use Config;
class Template{
    public static function showAreaSearch($controllerName,$paramSearch){
        $tmplSearch = Config::get('myconf.template.search');
        $fieldInController=Config::get('myconf.config.search');
        $controllerName = array_key_exists($controllerName,$fieldInController) ? $controllerName : 'default';
        $xhtmlField='';
        foreach($fieldInController[$controllerName] as $field){
            
            $xhtmlField.= sprintf('<li><a href="#"
                                    class="select-field" data-field="%s">%s</a></li>',$field,$tmplSearch[$field]['name']);
        }

        $searchField = in_array($paramSearch['field'],$fieldInController[$controllerName]) ? $paramSearch['field'] : 'all';
        $xhtml=sprintf('<div class="input-group">
                    <div class="input-group-btn">
                        <button type="button"
                                class="btn btn-default dropdown-toggle btn-active-field"
                                data-toggle="dropdown" aria-expanded="false">
                            %s <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            %s
                        </ul>
                    </div>
                    <input type="text" class="form-control" name="search_value" value="%s">
                    <span class="input-group-btn">
                        <button id="btn-clear" type="button" class="btn btn-success"
                            style="margin-right: 0px">Xóa tìm kiếm</button>
                        <button id="btn-search" type="button" class="btn btn-primary">Tìm kiếm</button>
                    </span>
                <input type="hidden" name="search_field" value="%s">
            </div>',$tmplSearch[$searchField]['name'],$xhtmlField,$paramSearch['value'],$searchField);
        
        return $xhtml;    
    }
    public static function showBtnDisplayFilter(){
        
    }
    public static function showBtnFilter($controllerName,$itemsStatusCount,$currentFilterStatus,$paramSearch){
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
                if($paramSearch['value'] !==''){
                    $link.='&search_field='.$paramSearch['field'].'&search_value='.$paramSearch['value'];
                }
                $xhtml.=sprintf('<a href="%s" type="button" class="btn %s">
                    %s <span class="badge bg-white">%s</span></a>',$link,$class,$currentStatus['name'],$item['count']);
            }
        }
        return $xhtml;    
    }

    public static function showItemHistory($by,$time){
        $xhtml = sprintf('   <p><i class="fa fa-user"></i> %s</p>
                            <p><i class="fa fa-clock-o"></i> %s </p>',$by, date(Config::get('myconf.format.long_time'),strtotime($time)));
        return $xhtml;
    }
    public static function showItemStatus($controllerName,$id,$statusValue){
        $tmplStatus = Config::get('myconf.template.status');
        $statudValue= array_key_exists($statusValue,$tmplStatus)?$statusValue:'default';
        $class = $tmplStatus[$statudValue]['class']; 
        $name = $tmplStatus[$statudValue]['name'];
        $link = route("$controllerName/status",['id'=>$id,'status'=>$statudValue]);
        $xhtml=sprintf('<a href="%s"
                        type="button" class="btn btn-round %s">%s</a>',$link,$class,$name); 
        return $xhtml;    
    }
    public static function showItemIsHome($controllerName,$id,$statusValue){
        $tmplStatus = Config::get('myconf.template.is_home');
        $statudValue= array_key_exists($statusValue,$tmplStatus)?$statusValue:'1';
        $class = $tmplStatus[$statudValue]['class']; 
        $name = $tmplStatus[$statudValue]['name'];
        $link = route("$controllerName/isHome",['id'=>$id,'isHome'=>$statudValue]);
        $xhtml=sprintf('<a href="%s"
                        type="button" class="btn btn-round %s">%s</a>',$link,$class,$name); 
        return $xhtml;    
    }
    public static function showItemSelect($controllerName,$id,$statusValue){
        $link = route("$controllerName/display",['id'=>$id,'display'=>'current_temp_display']);
        $tmplDisplay  =Config::get('myconf.template.display');
        $xhtml = sprintf('<select name="select_change_attr" class="form-control"  data-url="%s" >',$link);
        foreach ($tmplDisplay as $key=>$val){
            $selected = $statusValue == $key ? ' selected="selected"' : '';
            $xhtml.=sprintf('<option value="%s" %s>%s</option>',$key,$selected,$val);
        }
        $xhtml.='</select>';
        return $xhtml;
    }
    public static function showItemThumb($controllerName,$thumbName,$alt)
    {
        $xhtml = sprintf('<img src="%s" alt="%s" class="zvn-thumb">',asset("images/$controllerName/$thumbName"), $alt );
        return $xhtml;
        // return "123";
    }
    public static function showItemAction($controllerName,$id){
        $typeBtn=Config::get('myconf.template.button');
        $typeController =Config::get('myconf.config.button');
        $controllerName = array_key_exists($controllerName,$typeController) ? $controllerName :'default';
        $listBtn = $typeController[$controllerName];
        $xhtml='<div class="zvn-box-btn-filter">';
        foreach($listBtn as $btn){
            $currentBtn = $typeBtn[$btn];
            $link = route($controllerName. $currentBtn['route-name'],['id'=>$id]);
            $xhtml.= sprintf('<a href="%s" type="button" class="btn btn-icon %s" data-toggle="tooltip"
                            data-placement="top" data-original-title="%s">
                            <i class="fa %s"></i>
                            </a>',$link,$currentBtn['class'],$currentBtn['title'],$currentBtn['icon']);
        }
        $xhtml.= '</div>';
        return $xhtml;
    }
}