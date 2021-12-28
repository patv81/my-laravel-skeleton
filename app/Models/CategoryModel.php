<?php

namespace App\Models;

use App\Models\AdminModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class CategoryModel extends AdminModel
{
    public function __construct(){
        $this->table = 'category';
        $this->folderUpload = 'category';
        $this->fieldSearchAccepted=['id','name'];
        $this->crudNotAccepted=['_token'];
        
    }
    public function listItems($params,$options){
        $re= null;
        if ($options['task']=='admin-list-items'){
            $query= $this->select('id','name','is_home','display','created','created_by','modified','modified_by','status');
                
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
        if ($options['task']=='news-category-list-items'){
            $query = $this->select('id','name','created','created_by','modified','modified_by','status')
                    ->where('status','=','active')
                    ->limit(8);
            $re = $query->get()->toArray();
        }
        if ($options['task']=='news-list-items-is-home'){
            $query = $this->select('id','name','display')
                    ->where('is_home','=','1')
                    ->where('status','=','active');
            $re = $query->get()->toArray();
        }
        if ($options['task']=='admin-list-items-in-selectbox'){
            $query=$this->select('id','name')
                    ->orderBy('name','asc')
                    ->where('status','=','active');
            $re = $query->pluck('name','id')->toArray();
        }
        return $re;
    }
    public function getItem($params,$options){
        $result=null;
        if ($options['task']=='get-item'){
            $result=self::select('id','name','display','is_home','status')->where('id',$params['id'])
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
        if($options['task']=='change-is-home'){
            $is_home=$params['currentIsHome']=='1'?'0':'1';
            self::where('id', $params['id'])
            ->update(['is_home' => $is_home]);
        }
        if ($options['task']=='change-display'){
            self::where('id', $params['id'])
            ->update(['display' => $params['currentDisplay']]);
        }
    }
    public function deleteItem($params,$options){
        if($options['task']=='delete-item'){
            self::where('id', $params['id'])
            ->delete();
        }
    }
    
}
