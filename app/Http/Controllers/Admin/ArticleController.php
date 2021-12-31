<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleModel as MainModel;
use App\Models\CategoryModel;
use App\Http\Requests\ArticleRequest as MainRequest;
class ArticleController extends Controller
{
    private $pathViewController='admin.pages.article.';
    private $controllerName='article';
    private $model;
    private $params=[];
    public function __construct(){
        $this->model = new MainModel();
        $this->params['pagination']['totalItemPerPage'] = 5;
        view()->share('controllerName',$this->controllerName);
    }

    public function index(Request $request){ 
        $this->params['filter']['status'] = $request->get('filter_status','all');
        $this->params['search']['field'] = $request->get('search_field','all');
        $this->params['search']['value'] = $request->get('search_value','');

        $items = $this->model->listItems($this->params,['task'=> 'admin-list-items' ]);

        $itemsStatusCount = $this->model->countItems($this->params,['task'=> 'admin-count-items-group-by-status']);
        return view($this->pathViewController.'index',[
            'items'=>$items,
            'itemsStatusCount'=>$itemsStatusCount,
            'params'=>$this->params,
        ]);
        
    }
    public function type(Request $request){
        $params['currentType'] = $request->type;
        $params['id']=$request->id;
        $this->model->saveItem($params,['task'=>'change-type']);
        return redirect()->route('article')->with('zvn_notify','cập nhập kiểu bài viết thành công');
    }
    public function status(Request $request){
        $params["currentStatus"]=$request->status;
        $params["id"] =$request->id;
        $this->model->saveItem($params,['task'=>'change-status']);
        return redirect()->route('article')->with('zvn_notify','cập nhập thành công');
    }
    public function delete(Request $request){
        $params["id"] =$request->id;
        $this->model->deleteItem($params,['task'=>'delete-item']);
        return redirect()->route('article')->with('zvn_notify','xóa phần tử '.$params['id'].' thành công');
    }
    public function form(Request $request){
        if($request->id!=null){
            $params['id']=$request->id;
            $item =$this->model->getItem($params,['task'=>'get-item']);
        }
        $categorymodel = new CategoryModel();
        $itemsCategory = $categorymodel->listItems(null,['task'=>'admin-list-items-in-selectbox']);

        return view($this->pathViewController.'form',[
            'item'=>$item??null,
            'itemsCategory'=>$itemsCategory,
        ]);
    }
    public function save(MainRequest $request){
        if ($request->method() == 'POST'){            
            $params = $request->all();
            $task ='add-item';
            $notify= 'Thêm mới thành công';
            if ($params['id']!=null){
                $task ='edit-item';
                $notify= 'Cập nhật thành công';
            }
            $this->model->saveItem($params,['task'=>$task]);
            return redirect()->route($this->controllerName)->with("zvn_notify",$notify);
        }
        echo "nothing ";
        die();
    }
}
