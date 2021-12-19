<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as MainModel;
class SliderController extends Controller
{
    private $pathViewController='admin.pages.slider.';
    private $controllerName='slider';
    private $model;
    private $params=[];
    public function __construct(){
        $this->model = new MainModel();
        $this->params['pagination']['totalItemPerPage'] = 3;
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
    public function status(Request $request){
        $params["currentStatus"]=$request->status;
        $params["id"] =$request->id;
        $this->model->saveItem($params,['task'=>'change-status']);
        return redirect()->route('slider')->with('zvn_notify','cập nhập thành công');
    }
    public function delete(Request $request){
        $params["id"] =$request->id;
        $this->model->deleteItem($params,['task'=>'delete-item']);
        return redirect()->route('slider')->with('zvn_notify','xóa phần tử '.$params['id'].' thành công');
    }
    public function form(Request $request){
        if($request->id!=null){
            $params['id']=$request->id;
            $item =$this->model->getItem($params,['task'=>'get-item']);
        }
        return view($this->pathViewController.'form',[
            'item'=>$item??null
        ]);
    }
}
