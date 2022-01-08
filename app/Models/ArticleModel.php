<?php

namespace App\Models;

use App\Models\AdminModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleModel extends AdminModel
{
    public function __construct()
    {
        $this->table = 'article as a';
        $this->folderUpload = 'article';
        $this->fieldSearchAccepted = ['id', 'name', 'content'];
        $this->crudNotAccepted = ['_token', 'thumb_current'];
    }
    // public $timestamps=false;
    // protected $primaryKey='id';
    // const UPDATED_AT = 'modified';
    public function listItems($params, $options)
    {
        $re = null;
        if ($options['task'] == 'admin-list-items') {
            $query = $this->select('a.type', 'a.category_id', 'a.id', 'a.name', 'a.content', 'a.thumb', 'a.created', 'a.created_by', 'a.modified', 'a.modified_by', 'a.status', 'c.name as category_name')
                ->join('category as c', 'a.category_id', '=', 'c.id');

            if ($params['filter']['status'] !== 'all') {
                $query->where('a.status', '=', $params['filter']['status']);
            }
            if ($params['search']['value'] !== '') {
                if ($params['search']['field'] == 'all') {
                    $query->where(function ($qr) use ($params) {
                        foreach ($this->fieldSearchAccepted as $col) {
                            $qr->orwhere('a.' . $col, 'LIKE', "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where('a.' . $params['search']['field'], 'LIKE', "%{$params['search']['value']}%");
                }
            }
            $re = $query->orderBy('a.id', 'DESC')->paginate($params['pagination']['totalItemPerPage']);
        }
        if ($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'name', 'content', 'thumb', 'a.category_id', 'created', 'created_by', 'modified', 'modified_by', 'status')
                ->where('status', '=', 'active')
                ->limit(5);
            $re = $query->get()->toArray();
        }
        if ($options['task'] == 'news-list-items-featured') {
            $query = $this->select('a.type', 'a.id', 'a.name', 'a.content', 'a.thumb', 'a.created', 'a.category_id', 'a.created_by', 'a.modified', 'a.modified_by', 'a.status', 'c.name as category_name')
                ->join('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.status', '=', 'active')
                ->where('a.type', '=', 'feature')
                ->orderBy('a.id', 'desc')
                ->take(3);
            $re = $query->get()->toArray();
        }
        if ($options['task'] == 'news-list-items-latest') {
            $query = $this->select('a.type', 'a.id', 'a.name', 'a.thumb', 'a.created', 'a.category_id', 'a.created_by', 'a.category_id', 'a.modified', 'a.modified_by', 'a.status', 'c.name as category_name')
                ->join('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.status', '=', 'active')
                ->orderBy('a.id', 'desc')
                ->take(4);
            $re = $query->get()->toArray();
        }
        if ($options['task'] == 'news-list-items-in-category') {

            $query = $this->select('a.content', 'a.category_id', 'a.id', 'a.name', 'a.thumb', 'a.created', 'a.created_by')
                ->where('a.status', '=', 'active')
                ->where('a.category_id', '=', $params['id'])
                ->orderBy('a.id', 'desc')
                ->take(4);
            $re = $query->get()->toArray();
        }
        if ($options['task'] == 'news-get-items-related-in-category') {

            $query = $this->select('id', 'name', 'content', 'thumb', 'created', 'created_by')
                ->where('status', '=', 'active')
                ->where('a.id', '!=', $params['article_id'])
                ->where('a.category_id', '=', $params['category_id'])
                ->take(4);
            $re = $query->get()->toArray();
        }
        return $re;
    }
    public function getItem($params, $options)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'name', 'category_id', 'content', 'thumb', 'status')->where('id', $params['id'])
                ->first();
        }
        if ($options['task'] == 'get-thumb') {
            $result = self::select('id', 'thumb', 'a.category_id')->where('id', $params['id'])
                ->first();
        }
        if ($options['task'] == 'news-get-item') {
            $query = $this->select(
                'a.type',
                'a.id',
                'a.name',
                'a.thumb',
                'a.created',
                'a.content',
                'a.category_id',
                'a.created_by',
                'a.category_id',
                'a.modified',
                'a.modified_by',
                'a.status',
                'c.name as category_name',
                'c.id as category_id',
                'c.display'
            )
                ->join('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.id', '=', $params['article_id']);
            $result = $query->first();
        }
        if ($result) $result = $result->toArray();
        return $result;
    }
    public function countItems($params, $options)
    {
        $re = null;
        if ($options['task'] == 'admin-count-items-group-by-status') {
            $query = $this->select('status', DB::raw('count(*) as count'));
            if ($params['search']['value'] !== '') {
                if ($params['search']['field'] == 'all') {
                    $query->where(function ($qr) use ($params) {
                        foreach ($this->fieldSearchAccepted as $col) {
                            $qr->orwhere($col, 'LIKE', "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE', "%{$params['search']['value']}%");
                }
            }

            $re = $query->groupBy('status')->get()->toArray();
        }
        return $re;
    }
    public function saveItem($params, $options)
    {
        if ($options['task'] == 'change-status') {
            $status = $params['currentStatus'] == 'active' ? 'inactive' : 'active';
            self::where('id', $params['id'])
                ->update(['status' => $status]);
        }
        if ($options['task'] == 'edit-item') {
            if (!empty($params['thumb'])) {
                $this->deleteThumb($params['thumb_current']);
                $params['thumb'] = $this->uploadThumb($params['thumb']);
            }
            $params['modified'] = date('Y-m-d');
            $params['modified_by'] = 'phamhoa';
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
        if ($options['task'] == 'add-item') {

            $params['created'] = date('Y-m-d');
            $params['created_by'] = 'phamhoa';
            $params['thumb'] = $this->uploadThumb($params['thumb']);
            self::insert($this->prepareParams($params));
        }
        if ($options['task'] == 'change-type') {
            self::where('id', $params['id'])
                ->update(['type' => $params['currentType']]);
        }
    }
    public function deleteItem($params, $options)
    {
        if ($options['task'] == 'delete-item') {
            $item = self::getItem($params, ['task' => 'get-thumb']);
            $this->deleteThumb($item['thumb']);
            self::where('id', $params['id'])
                ->delete();
        }
    }
}
