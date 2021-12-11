<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderModel extends Model
{
    protected $table='slider';
    protected $primaryKey='id';
    public function listItems($param,$options){
        $re= null;
        if ($options['task']=='admin-list-items'){
            $re= SliderModel::select('id','name','description','link','thumb','created','created_by','modified','modified_by','status')
                ->where('id','>','5')
                ->get();
        }
        return $re;
    }
}
