<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class AdminModel extends Model
{
    public $timestamps=false;
    protected $table='';
    protected $folderUpload = '';
    protected $primaryKey='';
    protected $fieldSearchAccepted=['id'];
    protected $crudNotAccepted=['_token','thumb_current'];
    const UPDATED_AT = 'modified';
    const CREATED_AT = 'created';

    protected function uploadThumb($thumbObj){
        $thumbName =Str::random(10).'.'.$thumbObj->clientExtension();

        $thumbObj->storeAs($this->folderUpload, $thumbName,'zvn_storage_img');
        return $thumbName;
    }
    protected function deleteThumb($thumbName){
        Storage::disk('zvn_storage_img')->delete($this->folderUpload.'/'.$thumbName);
    }
    protected function prepareParams($params){
        return array_diff_key($params,array_flip($this->crudNotAccepted));
    }
}
