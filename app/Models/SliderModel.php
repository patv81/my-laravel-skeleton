<?php

namespace App\Models;

use App\Models\AdminModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class SliderModel extends AdminModel
{
    public function __construct(){
        $this->table = 'slider';
        $this->folderUpload = 'slider';
        $this->fieldSearchAccepted=['id','name','description','link'];
        $this->crudNotAccepted=['_token','thumb_current'];
        
    }
    // public $timestamps=false;
    // protected $primaryKey='id';
    // const UPDATED_AT = 'modified';
    public function listItems($params,$options){
        $re= null;
        if ($options['task']=='admin-list-items'){
            $query= $this->select('id','name','description','link','thumb','created','created_by','modified','modified_by','status');
                
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
            $re=$query->orderBy('id')->paginate($params['pagination']['totalItemPerPage']);
        }
        if ($options['task']=='news-list-items'){
            $query = $this->select('id','name','description','link','thumb','created','created_by','modified','modified_by','status')
                    ->where('status','=','active')
                    ->limit(5);
            $re = $query->get()->toArray();
        }
        return $re;
    }
    public function getItem($params,$options){
        $result=null;
        if ($options['task']=='get-item'){
            $result=self::select('id','name','description','link','thumb','status')->where('id',$params['id'])
            ->first()
            ->toArray();
        }
        if ($options['task']=='get-thumb'){
            $result=self::select('id','thumb')->where('id',$params['id'])
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
            if (!empty($params['thumb'])){
                $this->deleteThumb($params['thumb_current']);
                $params['thumb']= $this->uploadThumb($params['thumb']);
            }
            $params['modified'] = date('Y-m-d');
            $params['modified_by']= 'phamhoa';
            self::where('id',$params['id'])->update($this->prepareParams($params)); 
        }
        if($options['task']=='add-item'){
            
            $params['created'] = date('Y-m-d');
            $params['created_by']= 'phamhoa';
            $params['thumb']= $this->uploadThumb($params['thumb']);
            self::insert($this->prepareParams($params));
        }
    }
    public function deleteItem($params,$options){
        if($options['task']=='delete-item'){
            $item=self::getItem($params,['task'=>'get-thumb']);
            $this->deleteThumb($item['thumb']);
            self::where('id', $params['id'])
            ->delete();
        }
    }
}
