<?php

namespace App\Models;

use App\Models\AdminModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class RssModel extends AdminModel
{
    public function __construct(){
        $this->table = 'rss';
        $this->fieldSearchAccepted=['id','name','link'];
        $this->crudNotAccepted=['_token'];
        
    }
    // public $timestamps=false;
    // protected $primaryKey='id';
    // const UPDATED_AT = 'modified';
    public function listItems($params,$options){
        $re= null;
        if ($options['task']=='admin-list-items'){
            $query= $this->select('id','name','status','link','ordering','source','created','created_by','modified','modified_by');
            if( $params['filter']['status']!=='all'){
                $query->where('status','=',$params['filter']['status']);
            }
            if ($params['search']['value']!==''){
                if($params['search']['field']=='all'){
                    $query->where(function($qr) use ($params){
                        foreach($this->fieldSearchAccepted as $col){
                            $qr->orwhere($col,'LIKE',"%{$params['search']['value']}%");
                        }
                    });
                }else if (in_array($params['search']['field'],$this->fieldSearchAccepted)){
                    $query->where($params['search']['field'],'LIKE',"%{$params['search']['value']}%");
                }
            }
            $re=$query->orderBy('ordering','asc')->paginate($params['pagination']['totalItemPerPage']);
        }
        if ($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'name', 'status', 'link', 'ordering', 'source', 'created', 'created_by', 'modified', 'modified_by')
                ->where('status', '=', 'active')
                ->limit(5);
            $re = $query->get()->toArray();
        }
        return $re;
    }
    public function getItem($params,$options){
        $result=null;
        if ($options['task']=='get-item'){
            $result=self::select('id', 'name', 'status', 'link', 'ordering', 'source', 'created', 'created_by', 'modified', 'modified_by')->where('id',$params['id'])
            ->first()
            ->toArray();
        }
        return $result;

    }
    public function countItems($params,$options){
        $re= null;
        if ($options['task']=='admin-count-items-group-by-status'){
            $query= $this->select('status', DB::raw('count(*) as count'));
            if ($params['search']['value']!==''){
                if($params['search']['field']=='all'){
                    $query->where(function($qr) use ($params){
                        foreach($this->fieldSearchAccepted as $col){
                            $qr->orwhere($col,'LIKE',"%{$params['search']['value']}%");
                        }
                    });
                }else if (in_array($params['search']['field'],$this->fieldSearchAccepted)){
                    $query->where($params['search']['field'],'LIKE',"%{$params['search']['value']}%");
                }
            }

            $re=$query->groupBy('status')->get()->toArray();
        }
        return $re;
    }
    public function saveItem($params,$options){
        if($options['task']=='change-status'){
            $status=$params['currentStatus']=='active'?'inactive':'active';
            self::where('id', $params['id'])
            ->update(['status' => $status]);
        }
        if($options['task']=='edit-item'){

            $params['modified'] = date('Y-m-d');
            $params['modified_by']= 'phamhoa';
            self::where('id',$params['id'])->update($this->prepareParams($params)); 
        }
        if($options['task']=='add-item'){
            
            $params['created'] = date('Y-m-d');
            $params['created_by']= 'phamhoa';
            self::insert($this->prepareParams($params));
        }
    }
    public function deleteItem($params,$options){
        if($options['task']=='delete-item'){
            self::where('id', $params['id'])
            ->delete();
        }
    }
}
