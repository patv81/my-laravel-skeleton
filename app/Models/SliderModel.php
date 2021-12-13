<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class SliderModel extends Model
{
    protected $table='slider';
    protected $primaryKey='id';
    public function listItems($params,$options){
        $re= null;
        if ($options['task']=='admin-list-items'){
            $query= $this->select('id','name','description','link','thumb','created','created_by','modified','modified_by','status');
                
            if(isset($params['filter']['status']) && $params['filter']['status']!='all'){
                $query->where('status','=',$params['filter']['status']);
            }
            $re=$query->orderBy('id')->paginate($params['pagination']['totalItemPerPage']);
        }
        return $re;
    }
    public function countItems($params,$options){
        $re= null;
        if ($options['task']=='admin-count-items-group-by-status'){
            $re= SliderModel::select('status', DB::raw('count(*) as count'))
                 ->groupBy('status')
                // ->paginate($params['pagination']['totalItemPerPage'])->toArray();
                ->get()->toArray();
        }
        return $re;
    }
}
