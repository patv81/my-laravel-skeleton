<?php

namespace App\Models;

use App\Models\AdminModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class UserModel extends AdminModel
{
    public function __construct(){
        $this->table = 'user';
        $this->folderUpload = 'user';
        $this->fieldSearchAccepted=['id','username','email','fullname'];
        $this->crudNotAccepted=['_token','avatar_current', 'password_confirmation','task'];
        
    }
    // public $timestamps=false;
    // protected $primaryKey='id';
    // const UPDATED_AT = 'modified';
    public function listItems($params,$options){
        $re= null;
        if ($options['task']=='admin-list-items'){
            $query= $this->select('id','username','email','fullname','password','avatar','level','created','created_by','modified','modified_by','status');
            //'id','username','email','fullname','password','avatar','level','created','created_by','modified','modified_by','status'
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
        return $re;
    }
    public function getItem($params,$options){
        $result=null;
        if ($options['task']=='get-item'){
            $result=self::select('id', 'username', 'email', 'fullname', 'avatar', 'level', 'created', 'created_by', 'modified', 'modified_by', 'status')->where('id',$params['id'])
            ->first()
            ->toArray();
        }
        if ($options['task']=='get-avatar'){
            $result=self::select('id','avatar')->where('id',$params['id'])
            ->first()
            ->toArray();
        }
        if ($options['task'] == 'auth-login') {
            $result = self::select('username', 'email', 'avatar', 'level', 'status')
                ->where('status','active')
                ->where('email',$params['email'])
                ->where('password', md5($params['password']))
                ->first();
            if($result) {
                $result=$result->toArray();
            }
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
            if (!empty($params['avatar'])){
                $this->deleteThumb($params['avatar_current']);
                $params['avatar']= $this->uploadThumb($params['avatar']);
            }
            $params['modified'] = date('Y-m-d');
            $params['modified_by']= 'phamhoa';
            self::where('id',$params['id'])->update($this->prepareParams($params)); 
        }
        if($options['task']=='add-item'){
            $params['created'] = date('Y-m-d');
            $params['created_by']= 'phamhoa';
            $params['avatar']= $this->uploadThumb($params['avatar']);
            $params['password'] = md5($params['password']);
            self::insert($this->prepareParams($params));
        }
        if ($options['task'] == 'change-level') {
            $level = $params['currentLevel'] ;
            self::where('id', $params['id'])
                ->update(['level' => $level]);
        }
        if ($options['task'] == 'change-password') {
            $password = $params['password'];
            self::where('id', $params['id'])
                ->update(['password' => md5($password)]);
        }
        if ($options['task'] == 'change-level-post') {
            $level = $params['level'];
            self::where('id', $params['id'])
                ->update(['level' => $level]);
        }
    }
    public function deleteItem($params,$options){
        if($options['task']=='delete-item'){
            $item=self::getItem($params,['task'=>'get-avatar']);
            $this->deleteThumb($item['avatar']);
            self::where('id', $params['id'])
            ->delete();
        }
    }
}
