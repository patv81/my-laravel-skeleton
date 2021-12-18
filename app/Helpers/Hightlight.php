<?php 
namespace App\Helpers;
class Hightlight
{
    public static function show($input,$paramSearch,$field){
        echo '<pre>' ;
        print_r(preg_quote($paramSearch['value'])); 
        echo'</pre>';
        if($paramSearch['value']=='') {return $input;}
        if ($paramSearch['field']=='all'||$paramSearch['field']==$field){
            return preg_replace("/".preg_quote($paramSearch['value'],"/")."/i","<span class='highlight>$0</span>",$input);
        }
        return $input;
    }
}